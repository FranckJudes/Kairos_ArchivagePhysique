<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DomaineValeur;
use App\Models\FicheTravail;
use App\Models\PostTravail;
use Illuminate\Http\Request;

class FichePostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
            $request->validate([
                'intitule' => 'required|string|max:255',
                'mission' => 'nullable|exists:domaine_valeur_elements,id',
                'lieu_du_poste' => 'required|string|max:255',
                'condition' => 'required|string|max:255',
                'post_travail_id' => 'nullable|exists:post_travails,id',
                'competence' => 'required|string|max:255',
            ]);

            FicheTravail::create($request->all());
            toastr()->success('Fiche créée avec succès !');
            return redirect()->back();
       } catch (\Throwable $th) {
            toastr()->error($th->getMessage());
            return redirect()->back();
       }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $fiche = PostTravail::findOrFail($id);
        $domaine_elments = DomaineValeur::where('libele','Activites')->with('domaine_valeurs_elements')->first();
        $domaine_valeurs_elements = $domaine_elments->domaine_valeurs_elements;
        $post = FicheTravail::where('post_travail_id',$id)->first();
        return view('Org.fiche_post',compact('post','fiche','domaine_valeurs_elements'));

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id){

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $request->validate([
                'intitule' => 'required|string|max:255',
                'mission' => 'nullable|exists:domaine_valeur_elements,id',
                'lieu_du_poste' => 'required|string|max:255',
                'condition' => 'required|string|max:255',
                'post_travail_id' => 'nullable|exists:post_travails,id',
                'competence' => 'required|string|max:255',
            ]);

            FicheTravail::where('id', $id)->update($request->all());
            toastr()->success('Fiche modifiée avec succès !');
            return redirect()->back();

        } catch (\Throwable $th) {
            toastr()->error($th->getMessage());
            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            FicheTravail::where('id', $id)->delete();
            toastr()->success('Fiche supprimée avec succès !');
            return redirect()->back();
        } catch (\Throwable $th) {
            toastr()->error($th->getMessage());
            return redirect()->back();
        }
    }


    public function store_fiche(Request $request){
        return $request;
        try {




        } catch (\Exception $th) {
            toastr()->error($th->getMessage());
            return redirect()->back();
        }
    }
}
