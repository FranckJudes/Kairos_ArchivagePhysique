<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Intervenant;
use App\Models\Presence;
use Exception;
use Illuminate\Http\Request;

class PresencesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $presences = Presence::with('intervenant')->get();
        $intervenants = Intervenant::all();
        return view('presences.index', compact('presences', 'intervenants'));
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
            if ($request->presentOrAbsent == '0') {
                $request->validate([
                    'intervenant_id' => 'required|exists:intervenants,id',
                    'date' => 'required|date',
                    'heure_arrivee' => 'nullable|date_format:H:i',
                    'heure_depart' => 'nullable|date_format:H:i',
                ]);
                Presence::create($request->all());
                toastr()->success('Présence enregistrée avec succès.');
                return redirect()->back();
            }elseif ($request->presentOrAbsent == '1') {
                $request->validate([
                    'intervenant_id' => 'required|exists:intervenants,id',
                    'date' => 'required|date',
                    'justification' => 'required|string',
                ]);
                Presence::create($request->all());
                toastr()->success('Présence enregistrée avec succès.');
                return redirect()->back();
            }
            toastr()->error("Erreur lors de l'enregistrement de la présence.");
            return redirect()->back();


        } catch (\Exception $th) {
            toastr()->error($th->getMessage());
            return redirect()->back();
       }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $presence = Presence::findOrFail($id);
        $users = Intervenant::all();
        return view('presences.edit', compact('presence', 'users'));
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
        $request->validate([
            'heure_arrivee' => 'nullable|date_format:H:i',
            'heure_depart' => 'nullable|date_format:H:i',
        ]);

        $presence = Presence::findOrFail($id);
        $presence->update($request->all());

        toastr()->success('Présence mise à jour avec succès.');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try{

            $user =  Presence::destroy($id);
            if ($user){
               $user->delete();
               return response()->json(['success'=> true]);

            }
            return response()->json(['success'=> false]);

         }catch(Exception $exception){

             return response()->json(['success'=> false,'message' => $exception->getMessage()]);

         }

    }
}
