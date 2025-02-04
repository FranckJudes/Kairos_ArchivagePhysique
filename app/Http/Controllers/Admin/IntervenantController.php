<?php

namespace App\Http\Controllers\Admin;

use App\Enums\SexeEnum;
use App\Http\Controllers\Controller;
use App\Models\DomaineValeur;
use App\Models\Intervenant;
use http\Client\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class IntervenantController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $activites = DomaineValeur::where('libele','Activites')->with('domaine_valeurs_elements')->first();
        $domaineValeursElements = DomaineValeur::where('libele','Fonction des intervenants')->first();
        if ($domaineValeursElements) {
            $domaineValeursElements->domaine_valeurs_elements;
        }
        $intervenants = Intervenant::all();
        foreach ($intervenants as $intervenant) {
            $intervenant->domaineElement();
        }
        return view('intervenants.index',compact('intervenants','domaineValeursElements','activites'));
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
                'matricule' => 'nullable|string|unique:intervenants,matricule',
                'firstname' => 'required|string|max:255',
                'lastname' => 'nullable|string|max:255',
                'date_of_birth' => 'nullable|date',
                'lieu_naissance' => 'nullable|string|max:255',
                'profession' => 'nullable|string|max:255',
                'fonction' => 'required|string|max:255',
                'date_integration' => 'nullable|date',
                'info_connexes' => 'nullable|string|max:255',
                'email' => 'nullable|email',
                'phone' => 'nullable|string|max:20',
//                'photo_profil' => 'nullable|string',
                'sex' => 'nullable|in:1,2',
            ]);

           $intervenant =  Intervenant::create([
                ...$request->except('sex'),
                'sex' => SexeEnum::from($request->sex)
            ]);
            if ($request->hasFile('photo')) {
//              $intervenant =
                $path = $request->photo_profil->store('images');
            }

            return redirect()->route('intervenants.index')->with('success', 'Intervenant ajouté avec succès.');
        }catch (\Exception $exception){
            return $exception->getMessage();
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
    public function edit(Intervenant $intervenant)
    {
        return view('intervenants.edit', compact('intervenant'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,  Intervenant $intervenant)
    {
        try {
            $request->validate([
                'matricule' => 'nullable|string|unique:intervenants,matricule,' . $intervenant->id,
                'firstname' => 'required|string|max:255',
                'lastname' => 'nullable|string|max:255',
                'date_of_birth' => 'required|date',
                'lieu_naissance' => 'nullable|string|max:255',
                'profession' => 'nullable|string|max:255',
                'fonction' => 'required|string|max:255',
                'date_integration' => 'nullable|date',
                'info_connexes' => 'nullable|string|max:255',
                'email' => 'nullable|email',
                'phone' => 'nullable|string|max:20',
                'photo_profil' => 'nullable|string',
                'sex' => 'required|in:1,2',
            ]);

            $intervenant->update([
                ...$request->except('sex'),
                'sex' => SexeEnum::from($request->sex)
            ]);

            return redirect()->route('intervenants.index')->with('success', 'Intervenant mis à jour.');
        }catch (\Exception $exception){
            return $exception->getMessage();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Intervenant $intervenant)
    {
        try {
            $intervenant->delete();
            return response->json(['success' => true]);
        }catch (\Exception $exception){
            return $exception->getMessage();
        }
    }
}
