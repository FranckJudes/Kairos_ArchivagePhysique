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
        $intervenants =  Intervenant::with('activites')->get();
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

            toastr()->success('Intervenant a ete cree avec success.');
            return redirect()->back();
        }catch (\Exception $exception){
            toastr()->error('Erreur de mise a jour');
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

            toastr()->success('Intervenant mis à jour.');
            return redirect()->back();
        }catch (\Exception $exception){
            toastr()->error('Erreur de mise a jour');
            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $intervenant = Intervenant::find($id);
            if ($intervenant) {
                $intervenant->delete();
                return response()->json(['success' => true]);
            }
            return response()->json(['success' => false]);

        }catch (\Exception $exception){
            return  response()->json(['success' => false,'message' => $exception->getMessage()]);
        }
    }
}
