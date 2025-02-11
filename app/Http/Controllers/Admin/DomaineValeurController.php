<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DomaineValeur;
use Illuminate\Http\Request;
use PhpParser\Node\Scalar\String_;

class DomaineValeurController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $domaineValeurs = DomaineValeur::all();
        return view('Domaine.index',compact('domaineValeurs'));
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
                'libele' => 'required|unique|string|max:255',
                'description' => 'nullable',
                'type' => 'nullable',
            ]);

            DomaineValeur::create($request->all(),
                'type' => '1'
            );

            toastr()->success('Domaine de valeur créé avec succès.');
            return redirect()->back();
        }catch (\Exception $exception){
            toastr()->error($exception->getMessage());
            return  redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $domaineValeur)
    {
        $domaineValeursElements =  DomaineValeur::find($domaineValeur);
        if ($domaineValeursElements) {
           $domaineValeursElements->domaine_valeurs_elements;
        }
        return view('Domaine.show',compact('domaineValeur','domaineValeursElements'));
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
    public function update(Request $request, DomaineValeur $domaineValeur)
    {
        $request->validate([
            'libele' => 'required|string|max:255',
            'description' => 'nullable|string',
            'type' => 'required|in:0,1,2',
        ]);

        $domaineValeur->update($request->all());

        return redirect()->route('domaine-valeurs.index')
            ->with('success', 'Domaine de valeur mis à jour avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DomaineValeur $domaineValeur)
    {
        try {
            if ($domaineValeur->type !== '1' ) {
                $domaineValeur->delete();
                return redirect()->route('domaine-valeurs.index')
                    ->with('success', 'Domaine de valeur supprimé avec succès.');
            }
            return redirect()->route('domaine-valeurs.index')
                ->with('error ', 'Cette ressource ne peut pas etre supprime');
        }catch (\Exception $exception){
            return redirect()->route('domaine-valeurs.index')->with('error', $exception->getMessage());
        }
    }
}
