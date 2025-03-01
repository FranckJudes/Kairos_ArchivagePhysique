<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TypeEntite;
use Illuminate\Http\Request;

class TypeControllerController extends Controller
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
        try{
            $libele = $request->libele;
            $desc = $request->description;
            if($libele == '' || $desc == ''){
                $resp['error'] = 'yes';
                $resp['msg'] = 'error';
                return response()->json($resp);
            }else{
                $typeentity = new TypeEntite();
                $typeentity->libele = $libele;
                $typeentity->description =  $desc;
                $typeentity->save();
                $resp['error'] = 'no';
                $resp['msg'] =  'success';
                return response()->json($resp);
            }

        }catch(\Exception $e){
            $resp['error'] = 'yes';
            $resp['msg'] = $e->getMessage();
            return response()->json($resp);
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
    // public function destroy(string $id)
    // {
    //     //
    // }
    public function destroy_entity($id){
        try{
            TypeEntite::where('id',$id)->delete();
            $resp['error'] = 'no';
            $resp['msg'] = 'success';
            return response()->json($resp);
        }catch(\Exception $e){
            $resp['error'] = 'yes';
            $resp['msg'] = 'error';
            return response()->json($resp);
        }

    }

}
