<?php

namespace App\Http\Controllers;
use App\Http\Resources\AplicationResource;
use Illuminate\Support\Facades\Validator;
use App\Models\Aplication;
use Illuminate\Http\Request;

class AplicationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Obtenemos toda la collección de Apliciones
        $aplication = Aplication::all();
        return response()->json([
            'aplication' => AplicationResource::collection($aplication),
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
       // Creamos una nueva aplicación
       $data = $request->all();
       $validator = Validator::make($data, [
        'name' => 'required|string|max:45',
        'description' => 'required|string|max:255',
        'url' => 'required|string|max:255',
       ]);

       if($validator->fails()){
           return response()->json([
            'error' => $validator->errors(),
            'message' => 'Fail validation'
           ], 400);
       }
       $aplication = Aplication::create($data);

       return response()->json([
        'aplication' => new AplicationResource($aplication),
        'message' => 'Successfully create'
       ],200);
    }

    /**
     * Display the specified Aplication.
     *
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // Obtener una Aplicación en especifico
        $aplication = Aplication::find($id);
        if(empty($aplication)){
            return response()->json([
                'message' => 'Aplication not exists'
            ],400);
        }
        return response()->json([
            'aplication' => new AplicationResource($aplication),
            'message' => 'Retrieveds successfully'
        ],200);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Aplication  $aplication
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $aplication = Aplication::find($id);
        if(empty($aplication)){
            return response()->json([
                'message' => 'Aplication not exist'
            ],400);
        }
        $aplication->update($request->all());
            return response()->json([
            'aplication' => new AplicationResource($aplication),
            'message' => 'Update successfully'
        ],200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $aplication = Aplication::find($id);
        if(empty($aplication)){
            return response([
                'message' => 'Aplication not found'
            ]);
        }
        $aplication->delete($id);
        return response([
            'message' => 'Delete successfully'
        ]);
    }
}
