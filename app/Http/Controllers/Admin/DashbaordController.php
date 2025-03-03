<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DomaineValeur;
use App\Models\DomaineValeurElement;
use App\Models\Intervenant;
use App\Models\Objectif;
use App\Models\Performance;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashbaordController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $breIntervenant = Intervenant::all();
        $brActivites = DomaineValeur::where('libele','Activites')->with('domaine_valeurs_elements')->first();
        $brObjectifs = Objectif::count();
        $Objects = DomaineValeur::where('libele','Typologie documentaire')->with('domaine_valeurs_elements')->first();




        return view('Dashboard.index',compact('breIntervenant','brActivites','brObjectifs','Objects'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function get_peformance_user_chart(Request $request)
    {
        try {
            $dateDebut = Carbon::now();
            $dateFin = Carbon::now();
            $periode = $request->input('periode', 'journaliere');

            switch ($periode) {
                case 'journaliere':
                    $dateDebut = $dateFin = Carbon::today()->toDateString();
                    break;
                case 'Semaine':
                    $dateDebut = Carbon::now()->startOfWeek();
                    $dateFin = Carbon::now()->endOfWeek();
                    break;
                case 'Mensuelle':
                    $dateDebut = Carbon::now()->startOfMonth();
                    $dateFin = Carbon::now()->endOfMonth();
                    break;
                case 'Trimestre':
                    $dateDebut = Carbon::now()->subMonths(3)->startOfMonth();
                    $dateFin = Carbon::now()->endOfMonth();
                    break;
                case 'Semestre':
                    $dateDebut = Carbon::now()->subMonths(6)->startOfMonth();
                    $dateFin = Carbon::now()->endOfMonth();
                    break;
                case 'Annuelle':
                    $dateDebut = Carbon::now()->subMonths(12)->startOfMonth();
                    $dateFin = Carbon::now()->addMonths(12)->endOfMonth();
                    break;
                default:
                    return response()->json(['error' => 'Période invalide'], 400);
            }

            $performances = Performance::whereBetween('date_performance', [$dateDebut, $dateFin])
                ->selectRaw('intervenant, activites, SUM(performance_value) as total_performance')
                ->groupBy('intervenant', 'activites')
                ->get();

            $resultats = [];

            foreach ($performances as $performance) {
                $intervenantId = $performance->intervenant;
                $activiteId = $performance->activites;

                if (!isset($resultats[$intervenantId])) {
                    $resultats[$intervenantId] = [
                        'intervenant' => $performance->intervenantInfo->firstname . ' ' . $performance->intervenantInfo->lastname,
                        'email' => $performance->intervenantInfo->email,
                        'performances' => []
                    ];
                }

                $resultats[$intervenantId]['performances'][] = [
                    'activite' => $performance->activiteObjectif->libele ?? 'N/A',
                    'total_performance' => $performance->total_performance,
                    'objectif_cible' => $performance->activiteObjectif->objectif->valeur_cible ?? 'N/A'
                ];
            }

            // Transformer en liste plate pour le graphique
            $formattedData = [];
            foreach ($resultats as $intervenant) {
                foreach ($intervenant['performances'] as $performance) {
                    $formattedData[] = [
                        'intervenant' => $intervenant['intervenant'],
                        'activite' => $performance['activite'],
                        'total_performance' => $performance['total_performance'],
                        'objectif_cible' => $performance['objectif_cible']
                    ];
                }
            }

            return response()->json($formattedData);
        } catch (\Exception $exception) {
            return response()->json(['error' => $exception->getMessage()], 500);
        }
    }

}
