<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DomaineValeurElement;
use App\Models\Intervenant;
use App\Models\Objectif;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PerformanceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $intervenants =  Intervenant::with('activites')->get();
        return view('Performances.index',compact('intervenants'));
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
            // Valider les données de la requête
            if (!$request->has('intervenants') || !$request->has('activites')) {
                toastr()->error('Données incomplètes');
                return redirect()->back();
            }

            $intervenants = $request->intervenants;
            $activites = $request->activites;

            // Valider que toutes les activités existent
            $validActivites = DomaineValeurElement::whereIn('id', $activites)->pluck('id')->toArray();
            if (count($validActivites) !== count($activites)) {
                toastr()->error('Certaines activités sélectionnées sont invalides');
                return redirect()->back();
            }

            $nonAssignes = [];

            DB::beginTransaction();

            foreach ($intervenants as $intervenantId) {
                // Vérifier si l'intervenant existe
                $intervenant = Intervenant::find($intervenantId);
                if (!$intervenant) {
                    DB::rollBack();
                    toastr()->error("L'intervenant #$intervenantId n'existe pas");
                    return redirect()->back();
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
                        toastr()->error("Erreur lors de la dissociation des activités");
                        return redirect()->back();
                    }
                } else {
                    $nonAssignes[] = $intervenant->id;
                }
            }

            DB::commit();

            if (!empty($nonAssignes)) {
                toastr()->warning('Certains intervenants n\'avaient pas ces activités assignées.');
                return redirect()->back();
            }

            toastr()->success('Activités dissociées des intervenants avec succès.');
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
}
