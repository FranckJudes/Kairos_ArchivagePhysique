<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DomaineValeur;
use App\Models\Objects;
use Illuminate\Http\Request;

class ObjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $Objects = Objects::all();
        return view('objects.index',compact('Objects'));
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
                'libele' => 'required|unique:objects,libele|string|max:255',
                'description' => 'nullable|string',
            ]);

            Objects::create($request->all());

            return redirect()->route('Objects.index')
                ->with('success', 'Objects de valeur créé avec succès.');
        } catch (\Exception $exception) {
            dd($exception);
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

            $object = Objects::find($id);
            if ($object) {
                $object->libele =  $request->libele;
                $object->description =  $request->description;
                $object->save();
                return response()->json(['success' => 'succes','error'=>'no']);

            }
            return response()->json(['error'=>'yes']);

        }catch (\Exception $exception){
            return response()->json(['error'=>'yes','message'=>$exception->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $object = Objects::find($id);
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
