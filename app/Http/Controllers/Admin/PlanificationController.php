<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\JourFerier;
use Illuminate\Http\Request;

class PlanificationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $joursFeries = JourFerier::orderBy('date', 'asc')->get();
        return view('planification.index', compact('joursFeries'));
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
                'date' => 'required|date|unique:jour_feriers,date'
            ]);
            JourFerier::create($request->all());
            toastr()->success('Enregistrement avec success');
            return redirect()->back();
        }catch (\Exception $exception){
            toastr()->error($exception->getMessage());
            return redirect()->back()->withInput();
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
        try {
            $request->validate([
                'date' => 'required|date|unique:jour_feriers,date,' . $id
            ]);
            $jourFerie = JourFerier::findOrFail($id);
            if($jourFerie){
                $jourFerie->update($request->all());
            }
            toastr()->success('Mise a jour avec success');
            return redirect()->back();
        }catch (\Exception $exception){
            toastr()->success('Erreur de Mise a jour');
            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {

            $jourFerie = JourFerier::findOrFail($id);
            if ($jourFerie) {
                $jourFerie->delete();
                return \response()->json(['succes' => true]);
            }
            return \response()->json(["succes" => false]);
        }catch (\Exception $exception){
            return  \response()->json(["succes" => false, "msg"=> "Erreur de suppression"]);
        }
    }
}
