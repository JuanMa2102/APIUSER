<?php

namespace App\Http\Controllers;

use App\Models\Module;
use App\Models\Aplication;
use App\Http\Resources\ModuleResource;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class ModuleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $module = Module::all();
        return response()->json([
            'module' => ModuleResource::collection($module),
            'message' => 'Retrieveds successfully'
        ],200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $data = $request->all();
        $validator = Validator::make($data,[
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'id_aplication' => 'required'
        ]);
        
        
        if($validator->fails()){
            return response()->json([
                'error' => $validator->errors(),
                'message' => 'Fail validation'
            ],400);
        }

        /**
         * Identifica si existe la apliciación
         * ante de hacer el registro 
        */
        $aplication = Aplication::where('id', '=', $data['id_aplication'])->first();
        if($aplication==null){
            return response()->json([
                'message' => 'No existe está aplicación con este identificador, porfavor registra una aplicación primero'
            ],400);
        }

        $module = Module::create($data);
        return response()->json([
            'mudule' => new ModuleResource($module),
            'message' => 'Successfully create'
        ],200);
    }

    /**
     * Display the specified resource.
     *
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $module = Module::find($id);
        if(empty($module)){
            return response()->json([
                'message' => 'Module not exists'
            ], 400);
        }
        return response()->json([
            'module' => new ModuleResource($module),
            'message' => 'Retrieveds successfully'
        ],200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $module = Module::find($id);
        if(empty($module)){
            return response()->json([
                'message' => 'Business not exists'
            ],400);
        }
        $module->update($request->all());
        return response()->json([
            'module' => new ModuleResource($module),
            'message' => 'Update successfully'
        ],200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $module = Module::find($id);
        if(empty($module)){
            return response()->json([
                'message' => 'Module not found'
            ],400);
        }
        $module->delete($id);
        return response()->json([
            'message' => 'Delete successfully'
        ],200);
    }

}
