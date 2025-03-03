<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PostTravail;
use Exception;
use Illuminate\Http\Request;

class PostWorController extends Controller
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
                'code' => 'required|unique:post_travails,code',
                'intitule' => 'required',
                'entite_id' => 'required|exists:entite_organisations,id',
            ]);
                PostTravail::create($request->all());
                toastr()->sucess("Poste de travail ajouté avec succès");
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
                'code' => 'required|unique:post_travails,code,' . $id,
                'intitule' => 'required',
                'entite_id' => 'required|exists:entite_organisations,id',
            ]);

            $postTravail = PostTravail::findOrFail($id);

            $postTravail->update($request->all());
            toastr()->success("Poste de travail mis à jour avec succès");

            return redirect()->back();

        } catch (\Illuminate\Validation\ValidationException $e) {
            toastr()->error("Erreur de validation : " . $e->validator->errors()->first());
            return redirect()->back()->withErrors($e->validator->errors())->withInput();

        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            toastr()->error("Poste de travail non trouvé.");
            return redirect()->back();

        } catch (\Exception $th) {
            toastr()->error("Une erreur s'est produite : " . $th->getMessage());
            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try{

            $user =  PostTravail::find($id);
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
