<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mission;
use App\Models\Rapport;
use App\Models\Utilisateur;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Dompdf\Dompdf;
use Dompdf\Options;

class RapportController extends Controller
{
    /**
     * Génère un rapport de missions
     */
    public function rapportMissions(Request $request)
    {
        try {
            $userId = Auth::id();
            $format = $request->input('format', 'pdf');
            $dateDebut = $request->input('dateDebut');
            $dateFin = $request->input('dateFin');

            // Récupérer les missions de l'utilisateur
            $query = Mission::whereHas('utilisateurs', function($q) use ($userId) {
                $q->where('utilisateur_id', $userId);
            })->with(['utilisateurs.role', 'equipements']);

            // Filtrer par dates si fournies
            if ($dateDebut) {
                $query->where('date_debut', '>=', $dateDebut);
            }
            if ($dateFin) {
                $query->where('date_fin', '<=', $dateFin);
            }

            $missions = $query->get();

            // Créer le titre du rapport
            $titre = 'Rapport Missions - ' . date('d/m/Y');
            if ($dateDebut && $dateFin) {
                $titre .= ' (' . $dateDebut . ' au ' . $dateFin . ')';
            }

            // Générer le fichier
            if ($format === 'excel') {
                $fichierPath = $this->genererExcelMissions($missions, $titre);
            } else {
                $fichierPath = $this->genererPdfMissions($missions, $titre);
            }

            // Enregistrer le rapport en base
            $rapport = Rapport::create([
                'utilisateur_id' => $userId,
                'type' => 'missions',
                'titre' => $titre,
                'format' => $format,
                'fichier_path' => $fichierPath
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Rapport généré avec succès',
                'rapport' => $rapport
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Erreur lors de la génération du rapport',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Génère un rapport d'activité personnel
     */
    public function rapportActivite(Request $request)
    {
        try {
            $userId = Auth::id();
            $format = $request->input('format', 'pdf');
            $dateDebut = $request->input('dateDebut');
            $dateFin = $request->input('dateFin');

            // Récupérer les données d'activité
            $query = Mission::whereHas('utilisateurs', function($q) use ($userId) {
                $q->where('utilisateur_id', $userId);
            })->with(['utilisateurs.role', 'equipements']);

            if ($dateDebut) {
                $query->where('date_debut', '>=', $dateDebut);
            }
            if ($dateFin) {
                $query->where('date_fin', '<=', $dateFin);
            }

            $missions = $query->get();

            // Calculer les statistiques
            $stats = [
                'total_missions' => $missions->count(),
                'missions_terminees' => $missions->where('date_fin', '<', now())->count(),
                'missions_en_cours' => $missions->where('date_debut', '<=', now())
                    ->where('date_fin', '>=', now())->count(),
                'missions_en_attente' => $missions->where('date_debut', '>', now())->count(),
            ];

            // Créer le titre du rapport
            $titre = 'Rapport Activité - ' . date('d/m/Y');
            if ($dateDebut && $dateFin) {
                $titre .= ' (' . $dateDebut . ' au ' . $dateFin . ')';
            }

            // Générer le fichier
            if ($format === 'excel') {
                $fichierPath = $this->genererExcelActivite($missions, $stats, $titre);
            } else {
                $fichierPath = $this->genererPdfActivite($missions, $stats, $titre);
            }

            // Enregistrer le rapport en base
            $rapport = Rapport::create([
                'utilisateur_id' => $userId,
                'type' => 'activite',
                'titre' => $titre,
                'format' => $format,
                'fichier_path' => $fichierPath
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Rapport généré avec succès',
                'rapport' => $rapport
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Erreur lors de la génération du rapport',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Récupère la liste des rapports de l'utilisateur
     */
    public function mesRapports(Request $request)
    {
        try {
            $userId = Auth::id();
            $rapports = Rapport::where('utilisateur_id', $userId)
                ->with('utilisateur')
                ->orderBy('created_at', 'desc')
                ->get();

            return response()->json($rapports);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Erreur lors du chargement des rapports',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Télécharge un rapport
     */
    public function telechargerRapport($id)
    {
        try {
            $userId = Auth::id();
            $rapport = Rapport::where('id', $id)
                ->where('utilisateur_id', $userId)
                ->first();

            if (!$rapport) {
                return response()->json(['error' => 'Rapport non trouvé'], 404);
            }

            if (!Storage::exists($rapport->fichier_path)) {
                return response()->json(['error' => 'Fichier non trouvé'], 404);
            }

            $extension = $rapport->format === 'pdf' ? 'pdf' : 'xlsx';
            $nomFichier = $rapport->titre . '.' . $extension;

            return Storage::download($rapport->fichier_path, $nomFichier);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Erreur lors du téléchargement',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Génère un fichier Excel pour les missions
     */
    private function genererExcelMissions($missions, $titre)
    {
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // En-têtes
        $sheet->setCellValue('A1', 'ID Mission');
        $sheet->setCellValue('B1', 'Titre');
        $sheet->setCellValue('C1', 'Description');
        $sheet->setCellValue('D1', 'Date Début');
        $sheet->setCellValue('E1', 'Date Fin');
        $sheet->setCellValue('F1', 'Statut');
        $sheet->setCellValue('G1', 'Équipements');

        // Données
        $row = 2;
        foreach ($missions as $mission) {
            $sheet->setCellValue('A' . $row, $mission->id);
            $sheet->setCellValue('B' . $row, $mission->titre);
            $sheet->setCellValue('C' . $row, $mission->description);
            $sheet->setCellValue('D' . $row, $mission->date_debut);
            $sheet->setCellValue('E' . $row, $mission->date_fin);
            $sheet->setCellValue('F' . $row, $this->getStatutMission($mission));
            $sheet->setCellValue('G' . $row, $mission->equipements->pluck('nom')->implode(', '));
            $row++;
        }

        // Auto-dimensionner les colonnes
        foreach (range('A', 'G') as $col) {
            $sheet->getColumnDimension($col)->setAutoSize(true);
        }

        $writer = new Xlsx($spreadsheet);
        $filename = 'rapport_missions_' . date('Y-m-d_H-i-s') . '.xlsx';
        $path = 'rapports/' . $filename;
        
        Storage::put($path, '');
        $writer->save(Storage::path($path));
        
        return $path;
    }

    /**
     * Génère un fichier PDF pour les missions
     */
    private function genererPdfMissions($missions, $titre)
    {
        $html = $this->genererHtmlMissions($missions, $titre);
        
        $options = new Options();
        $options->set('isHtml5ParserEnabled', true);
        $options->set('isPhpEnabled', true);

        $dompdf = new Dompdf($options);
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();

        $filename = 'rapport_missions_' . date('Y-m-d_H-i-s') . '.pdf';
        $path = 'rapports/' . $filename;
        
        Storage::put($path, $dompdf->output());
        
        return $path;
    }

    /**
     * Génère un fichier Excel pour l'activité
     */
    private function genererExcelActivite($missions, $stats, $titre)
    {
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Statistiques
        $sheet->setCellValue('A1', 'Statistiques d\'activité');
        $sheet->setCellValue('A2', 'Total missions: ' . $stats['total_missions']);
        $sheet->setCellValue('A3', 'Missions terminées: ' . $stats['missions_terminees']);
        $sheet->setCellValue('A4', 'Missions en cours: ' . $stats['missions_en_cours']);
        $sheet->setCellValue('A5', 'Missions en attente: ' . $stats['missions_en_attente']);

        // En-têtes des missions
        $sheet->setCellValue('A7', 'ID Mission');
        $sheet->setCellValue('B7', 'Titre');
        $sheet->setCellValue('C7', 'Date Début');
        $sheet->setCellValue('D7', 'Date Fin');
        $sheet->setCellValue('E7', 'Statut');

        // Données des missions
        $row = 8;
        foreach ($missions as $mission) {
            $sheet->setCellValue('A' . $row, $mission->id);
            $sheet->setCellValue('B' . $row, $mission->titre);
            $sheet->setCellValue('C' . $row, $mission->date_debut);
            $sheet->setCellValue('D' . $row, $mission->date_fin);
            $sheet->setCellValue('E' . $row, $this->getStatutMission($mission));
            $row++;
        }

        // Auto-dimensionner
        foreach (range('A', 'E') as $col) {
            $sheet->getColumnDimension($col)->setAutoSize(true);
        }

        $writer = new Xlsx($spreadsheet);
        $filename = 'rapport_activite_' . date('Y-m-d_H-i-s') . '.xlsx';
        $path = 'rapports/' . $filename;
        
        Storage::put($path, '');
        $writer->save(Storage::path($path));
        
        return $path;
    }

    /**
     * Génère un fichier PDF pour l'activité
     */
    private function genererPdfActivite($missions, $stats, $titre)
    {
        $html = $this->genererHtmlActivite($missions, $stats, $titre);
        
        $options = new Options();
        $options->set('isHtml5ParserEnabled', true);
        $options->set('isPhpEnabled', true);

        $dompdf = new Dompdf($options);
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();

        $filename = 'rapport_activite_' . date('Y-m-d_H-i-s') . '.pdf';
        $path = 'rapports/' . $filename;
        
        Storage::put($path, $dompdf->output());
        
        return $path;
    }

    /**
     * Génère le HTML pour le PDF des missions
     */
    private function genererHtmlMissions($missions, $titre)
    {
        $html = '
        <html>
        <head>
            <style>
                body { font-family: Arial, sans-serif; margin: 20px; }
                h1 { color: #333; text-align: center; }
                table { width: 100%; border-collapse: collapse; margin-top: 20px; }
                th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
                th { background-color: #f2f2f2; }
                .header { text-align: center; margin-bottom: 30px; }
            </style>
        </head>
        <body>
            <div class="header">
                <h1>' . htmlspecialchars($titre) . '</h1>
                <p>Généré le: ' . date('d/m/Y H:i') . '</p>
            </div>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Titre</th>
                        <th>Description</th>
                        <th>Date Début</th>
                        <th>Date Fin</th>
                        <th>Statut</th>
                    </tr>
                </thead>
                <tbody>';

        foreach ($missions as $mission) {
            $html .= '
                <tr>
                    <td>' . $mission->id . '</td>
                    <td>' . htmlspecialchars($mission->titre) . '</td>
                    <td>' . htmlspecialchars($mission->description) . '</td>
                    <td>' . $mission->date_debut . '</td>
                    <td>' . $mission->date_fin . '</td>
                    <td>' . $this->getStatutMission($mission) . '</td>
                </tr>';
        }

        $html .= '
                </tbody>
            </table>
        </body>
        </html>';

        return $html;
    }

    /**
     * Génère le HTML pour le PDF de l'activité
     */
    private function genererHtmlActivite($missions, $stats, $titre)
    {
        $html = '
        <html>
        <head>
            <style>
                body { font-family: Arial, sans-serif; margin: 20px; }
                h1, h2 { color: #333; }
                .stats { margin: 20px 0; }
                .stat-item { margin: 10px 0; }
                table { width: 100%; border-collapse: collapse; margin-top: 20px; }
                th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
                th { background-color: #f2f2f2; }
                .header { text-align: center; margin-bottom: 30px; }
            </style>
        </head>
        <body>
            <div class="header">
                <h1>' . htmlspecialchars($titre) . '</h1>
                <p>Généré le: ' . date('d/m/Y H:i') . '</p>
            </div>
            
            <div class="stats">
                <h2>Statistiques</h2>
                <div class="stat-item">Total missions: ' . $stats['total_missions'] . '</div>
                <div class="stat-item">Missions terminées: ' . $stats['missions_terminees'] . '</div>
                <div class="stat-item">Missions en cours: ' . $stats['missions_en_cours'] . '</div>
                <div class="stat-item">Missions en attente: ' . $stats['missions_en_attente'] . '</div>
            </div>
            
            <h2>Détail des Missions</h2>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Titre</th>
                        <th>Date Début</th>
                        <th>Date Fin</th>
                        <th>Statut</th>
                    </tr>
                </thead>
                <tbody>';

        foreach ($missions as $mission) {
            $html .= '
                <tr>
                    <td>' . $mission->id . '</td>
                    <td>' . htmlspecialchars($mission->titre) . '</td>
                    <td>' . $mission->date_debut . '</td>
                    <td>' . $mission->date_fin . '</td>
                    <td>' . $this->getStatutMission($mission) . '</td>
                </tr>';
        }

        $html .= '
                </tbody>
            </table>
        </body>
        </html>';

        return $html;
    }

    /**
     * Détermine le statut d'une mission
     */
    private function getStatutMission($mission)
    {
        $now = now();
        $dateDebut = \Carbon\Carbon::parse($mission->date_debut);
        $dateFin = \Carbon\Carbon::parse($mission->date_fin);

        if ($now < $dateDebut) {
            return 'En attente';
        } elseif ($now >= $dateDebut && $now <= $dateFin) {
            return 'En cours';
        } else {
            return 'Terminée';
        }
    }
} 