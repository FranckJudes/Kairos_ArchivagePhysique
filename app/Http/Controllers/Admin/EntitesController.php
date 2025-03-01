<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\EntiteOrganisation;
use App\Models\PostTravail;
use App\Models\TypeEntite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EntitesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
            // $entite = Entite_organisation::where([
            //     ['organisation_id', '=', $id]
            // ])->get();
            $num = EntiteOrganisation::count();
            $type = TypeEntite::all();
        return view('Org.index',compact('num','type'));
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

            $code = $request->code;
            $libele = $request->libele;
            $desc = $request->description;
            $type = $request->type;

            if($type == '' || $libele == '' || $desc == '' || $code == ''){

                $resp['error'] = 'yes';
                $resp['msg'] = 'error';
                return response()->json($resp);
            }else{
                $enty_org = new EntiteOrganisation();
                $enty_org->code = $code;
                $enty_org->libele = $libele;
                $enty_org->description =  $desc;
                $enty_org->type_entity_id = $type;
                $enty_org->fonction = $request->fonction_archive;
                $enty_org->save();
                $resp['error'] = 'no';
                $resp['msg'] = 'success';

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
        $act = EntiteOrganisation::where('id',$id)->first();
        if(empty($act)){
            return response()->json('off');
        }else{
            return response()->json($act);
        }
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
        try{
            EntiteOrganisation::where('id',$id)->delete();
            $resp['error'] = 'no';
            $resp['msg'] = 'success';
            return response()->json($resp);
        }catch(\Exception $e){
            $resp['error'] = 'yes';
            $resp['msg'] = 'error';
            return response()->json($resp);
        }

    }
    public function load_entity_for_js()
    {
        // Récupérer tous les types d'entités
        $types = TypeEntite::all();

        $data = [];
        foreach ($types as $key => $type) {
            $data[] = [
                'id' => $type->id,
                'nb' => $key+1,
                'libele' => $type->libele,
                'description' => $type->description,
            ];
        }


        return response()->json([
            'data' => $data,
        ]);
    }

    public function get_type_entity_api()
    {
        $entiteOrganisations = DB::table('entite_organisations')->select('id','code', 'libele','description','parent_id')->get();
        $image_path_1 = asset('assets/css/ztree/zTreeStyle/img/diy/1_open.png');
        $image_path_2 = asset('assets/css/ztree/zTreeStyle/img/diy/1_close.png');
        $result = [];
        foreach ($entiteOrganisations as $entite) {
            $id = $entite->id;
            $parent_id = $entite->parent_id;
            $libele = $entite->libele;
            $code = $entite->code;
            $description = $entite->description;

            $node = [
                "id" => $id,
                "pId" => $parent_id,
                "name" => $libele,
                "code" =>  $code,
                "description" =>  $description,
                "isParent" => "true",
                "click" => "true",
                "iconOpen"=> $image_path_1,
                "iconClose"=> $image_path_2

            ];

            array_push($result, $node);
        }

        return response()->json($result);
    }

    public function store_subentity(Request $request)
    {
        try{

            $code = $request->code;
            $libele = $request->libele;
            $desc = $request->description;
            $parent_id = $request->input('parent_for_sub_entity');
            $type = $request->type;
            $ge = [
                'code'=>$code,
                'libele'=>$libele,
                'desc'=>$desc,
                'parent_id'=>$parent_id,
                'type'=>$type,

            ];
            //dd($ge);
            if($libele == '' || $desc == '' || $code == '' || $parent_id == ''){

                $resp['error'] = 'yes';
                $resp['msg'] = 'error';
                return response()->json($resp);
            }else{
                $enty_org = new EntiteOrganisation();
                $enty_org->code = $code;
                $enty_org->libele = $libele;
                $enty_org->description =  $desc;
                $enty_org->type_entity_id = $type;
                $enty_org->parent_id = $parent_id;
                $enty_org->fonction = $request->fonction_archive;
                $enty_org->save();
                $resp['error'] = 'no';
                $resp['msg'] = 'success';
                return response()->json($resp);
            }

        }catch(\Exception $e){

            $resp['error'] = 'yes';
            $resp['msg'] = $e->getMessage();
            return response()->json($resp);
        }
    }

    public function go_to_view_add_post_job($id){

        $entite = EntiteOrganisation::where('id',$id)->first();
        $posts = PostTravail::where('entite_id',$id)->get();
        return view('Org.post_work',compact('entite','posts'));

    }

}
