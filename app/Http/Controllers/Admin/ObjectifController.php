<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DomaineValeur;
use App\Models\Objectif;
use App\Models\Objects;
use Illuminate\Http\Request;

class ObjectifController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $Objectifs = Objectif::with('activites','typologies','unite','periodicites')->get();
        $activites = DomaineValeur::where('libele','Activites')->with('domaine_valeurs_elements')->first();
        $typologie = DomaineValeur::where('libele','Typologie documentaire')->with('domaine_valeurs_elements')->first();
        $periodicites = DomaineValeur::where('libele','Periodicite')->with('domaine_valeurs_elements')->first();
        $unites = DomaineValeur::where('libele','unites')->with('domaine_valeurs_elements')->first();
//        return $unites->domaine_valeurs_elements;
        return view('Objectifs.index',compact('activites','typologie','periodicites','unites','Objectifs'));
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
                'code' => 'nullable|string|unique:objectifs,code',
                'activite' => 'required|int|max:255',
                // 'typologie' => 'required|int|max:255',
                'unites' => 'required|int',
                'periodicite' => 'required|int|max:255',
                'valeur_cible' => 'required|int|max:255',
                'commentaires' => 'nullable|string|max:255',

            ]);

            $existingObjectif = Objectif::where('activite', $request->activite)
                ->where('typologie', $request->typologie)
                ->exists();

            if ($existingObjectif) {
                toastr()->error('An Objectif with this Activité and Typologie already exists.');
                return redirect()->back();
            }

            Objectif::create($request->all());
            toastr()->success('Enregistrement avec success');
            return redirect()->back();
        }catch (\Exception $exception){
//            return $exception->getMessage();
            toastr()->error("Erreur d'enregistrement ");
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
        try {
            $object = Objectif::find($id);
            if ($object) {
                $object->delete();
                return response()->json(['success' => 'succes','error'=>'no']);
            }
            return response()->json(['error'=>'yes']);

        }catch (\Exception $exception){
            return response()->json(['error'=>'yes','message'=>$exception->getMessage()]);
        }
    }
}
