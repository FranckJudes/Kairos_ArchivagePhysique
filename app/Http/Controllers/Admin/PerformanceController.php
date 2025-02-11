<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DomaineValeurElement;
use App\Models\Intervenant;
use App\Models\Objectif;
use App\Models\Performance;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;
use App\Models\JourFerier;
class PerformanceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $intervenants = Intervenant::with('activites')->whereHas('performances')->get();
        $intervenant = Intervenant::with('activites')->get();
        return view('Performances.index',compact('intervenants','intervenant'));
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
        try {
            // Vérifier si les données existent
            if (!$request->has('intervenants') || !$request->has('activites')) {
                toastr()->error('Données incomplètes');
                return redirect()->back();
            }

            $intervenants = $request->intervenants;
            $activites = $request->activites;
            $existant = [];

            foreach ($intervenants as $intervenantId) {
                $intervenant = Intervenant::findOrFail($intervenantId);

                $activitesExistantes = $intervenant->activites()->pluck('activite_id')->toArray();
                $activitesAjout = array_diff($activites, $activitesExistantes);

                if (!empty($activitesAjout)) {
                    $intervenant->activites()->attach($activitesAjout);
                } else {
                    $existant[] = $intervenant->id;
                }
            }

            if (!empty($existant)) {
                toastr()->warning('Certains intervenants ont déjà ces activités assignées.');
                return redirect()->back();

            }

            toastr()->success('Intervenants associés aux activités avec succès..');
            return redirect()->back();
        } catch (\Exception $exception) {
            toastr()->error("Une erreur est survenu");
            return redirect()->back();
        }
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

    /**
     * A commenter
     *
     */
    public function intervenant_activites(Request $request)
    {
        try {
            // Validate request data
            if (!$request->has('intervenants') || !$request->has('activites')) {
                toastr()->error('Données incomplètes');
                return redirect()->back();
            }

            $intervenants = $request->intervenants;
            $activites = $request->activites;

            // Validate that all activites exist
            $validActivites = DomaineValeurElement::whereIn('id', $activites)->pluck('id')->toArray();
            if (count($validActivites) !== count($activites)) {
                toastr()->error('Certaines activités sélectionnées sont invalides');
                return redirect()->back();
            }

            $existant = [];

            DB::beginTransaction();

            foreach ($intervenants as $intervenantId) {
                // Check if intervenant exists
                $intervenant = Intervenant::find($intervenantId);
                if (!$intervenant) {
                    DB::rollBack();
                    toastr()->error("L'intervenant #$intervenantId n'existe pas");
                    return redirect()->back();
                }

                $activitesExistantes = $intervenant->activites()
                    ->pluck('domaine_valeur_element_id')
                    ->toArray();

                $activitesAjout = array_diff($activites, $activitesExistantes);
                if (!empty($activitesAjout)) {
                    try {
                        $intervenant->activites()->attach($activitesAjout);
                    } catch (\Exception $e) {
                        DB::rollBack();
                        toastr()->error("Erreur lors de l'association des activités");
                        return redirect()->back();
                    }
                } else {
                    $existant[] = $intervenant->id;
                }
            }

            DB::commit();

            if (!empty($existant)) {
                toastr()->warning('Certains intervenants ont déjà ces activités assignées.');
                return redirect()->back();
            }

            toastr()->success('Intervenants associés aux activités avec succès.');
            return redirect()->back();

        } catch (\Exception $exception) {
            DB::rollBack();
            toastr()->error("Une erreur est survenue: " . $exception->getMessage());
            return redirect()->back();
        }

    }

    /**
     * A commenter
     *
     */
    public function intervenant_activites_detach(Request $request)
    {
        try {
            // Vérifier la présence des données
            if (!$request->has('intervenants') || !$request->has('activites')) {
                return response()->json(['success' => false, 'message' => 'Données incomplètes'], 400);
            }

            $intervenants = $request->intervenants;
            $activites = $request->activites;

            // Vérifier que toutes les activités existent
            $validActivites = DomaineValeurElement::whereIn('id', $activites)->pluck('id')->toArray();
            if (count($validActivites) !== count($activites)) {
                return response()->json(['success' => false, 'message' => 'Certaines activités sélectionnées sont invalides'], 400);
            }

            $nonAssignes = [];

            DB::beginTransaction();

            foreach ($intervenants as $intervenantId) {
                // Vérifier si l'intervenant existe
                $intervenant = Intervenant::find($intervenantId);
                if (!$intervenant) {
                    DB::rollBack();
                    return response()->json(['success' => false, 'message' => "L'intervenant #$intervenantId n'existe pas"], 404);
                }

                // Vérifier les activités actuellement assignées
                $activitesExistantes = $intervenant->activites()
                    ->whereIn('domaine_valeur_element_id', $activites)
                    ->pluck('domaine_valeur_element_id')
                    ->toArray();

                if (!empty($activitesExistantes)) {
                    try {
                        $intervenant->activites()->detach($activites);
                    } catch (\Exception $e) {
                        DB::rollBack();
                        return response()->json(['success' => false, 'message' => 'Erreur lors de la dissociation des activités'], 500);
                    }
                } else {
                    $nonAssignes[] = $intervenant->id;
                }
            }

            DB::commit();

            if (!empty($nonAssignes)) {
                return response()->json([
                    'success' => true,
                    'message' => 'Certaines activités n\'étaient pas assignées à ces intervenants.',
                    'non_assignes' => $nonAssignes
                ], 200);
            }

            return response()->json(['success' => true, 'message' => 'Activités dissociées avec succès.'], 200);

        } catch (\Exception $exception) {
            DB::rollBack();
            return response()->json(['success' => false, 'message' => "Une erreur est survenue: " . $exception->getMessage()], 500);
        }
    }

    /**
     * A commenter
     *
     */
    public function get_activite_for_single_intervenant($id){
        try {
            $intervenant =  Intervenant::with('activites')->find($id);
            if ($intervenant){
                return response()->json(['success' => true, 'data' => $intervenant->activites]);
            }
            return response()->json(['success' => false]);
        }catch (\Exception $exception){
            return response()->json(['success' => false,'message' => $exception->getMessage()]);

        }
    }

    public function get_objectifi_activities($id){

        try {
            $intervenant  =  Objectif::with('typologies','periodicites','unite')->where('activite',$id)->get();
            if ($intervenant){
                return response()->json(['success' => true, 'data' => $intervenant]);
            }
            return response()->json(['success' => false]);
        }catch (\Exception $exception){
            return response()->json(['success' => false,'message' => $exception->getMessage()]);
        }
    }

    public function get_activitites_domaine_valeurs($id){
        try {

        }catch (\Exception $exception){
            return response()->json(['success' => false,'message' => $exception->getMessage()]);
        }
    }

    public function get_objection_value($id){
        try {
            $span = '';
            $object = Objectif::where('id',$id)->with('activites','typologies','unite','periodicites')->first();
            if ($object){
                $span .= "Objectif Cible : " . $object->valeur_cible .' '. optional($object->unite)->libele.'/'. optional($object->periodicites)->libele;
                return response()->json(['success' => true, 'html' => $span]);
            }
            return response()->json(['success' => false]);
        }catch (\Exception $exception){
            return response()->json(['success' => false,'message' => $exception->getMessage()]);
        }
    }

    public function store_performance_intervenants(Request $request){

        try {
            $request->validate([
                'intervenant' => 'required',
                'date_performance' => 'required',
                'activites' => 'required',
                'object' => 'required',
                'performance_value' => 'required',
            ]);
            $performance = new Performance();
            $performance->intervenant = $request->intervenant;
            $performance->date_performance = $request->date_performance;
            $performance->activites = $request->activites;
            $performance->objects = $request->object;
            $performance->performance_value = $request->performance_value;
            $performance->save();

            toastr()->success('Performances cree avec succès.');
            return redirect()->back();
        }catch (\Exception $exception){
            toastr()->error($exception->getMessage());
            return redirect()->back();
        }
    }




    public function get_peformance_user_folders(Request $request)
    {
        try {
            $dateDebut = Carbon::now();
            $dateFin = Carbon::now();
            $periode =  $request->input('periode','journaliere');

            switch ($periode) {
                case 'journaliere':
                    $dateDebut = $dateFin = Carbon::today()->toDateString();;
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

            // Récupérer et totaliser les performances par intervenant et activité
            $performances = Performance::whereBetween('date_performance', [$dateDebut, $dateFin])
                ->selectRaw('intervenant, activites, SUM(performance_value) as total_performance')
                ->groupBy('intervenant', 'activites')
                ->get();

            // Structurer les résultats pour DataTables
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

            // Transformer en liste plate pour DataTables
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

            return DataTables::of($formattedData)->make(true);
        } catch (\Exception $exception) {
            return response()->json(['error' => $exception->getMessage()], 500);
        }
    }





}
