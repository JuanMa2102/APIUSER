<?php

namespace App\Http\Controllers;

use App\Models\UnitBusiness;
use Illuminate\Http\Request;
use App\Http\Resources\BusinessUnitResource;
use App\Models\Business;

use Illuminate\Support\Facades\Validator;


class BusinessUnitController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $business_unit = UnitBusiness::all();
        return response()->json([
            'business_unit' => BusinessUnitResource::collection($business_unit),
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
            'id_business' => 'reuquired'
        ]);
        if($validator->fails()){
            return response()->json([
                'error' => $validator->errors(),
                'message' => 'Fail validation'
            ],400);
        }

        $business = Business::where('id', '=', $data['id_business']);
        if($business == null){
            response()->json([
                'message' => 'No existe un negocio con este identificador, porfavor registra un negocio primero'
            ],400);
        }

        $business_unit = UnitBusiness::create($data);
        return response()->json([
            'business_unit' => new BusinessUnitResource($business_unit),
            'message' => 'Successfully create'
        ],200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\UnitBusiness  $unitBusiness
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $business_unit = UnitBusiness::find($id);
        if(empty($business_unit)){
            return response()->json([
                'message' => 'Business Unit not exists'
            ],400);
        }

        return response()->json([
            'business_unit' => new BusinessUnitResource($business_unit),
            'message' => 'Retrieveds successfully'
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\UnitBusiness  $unitBusiness
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $business_unit = UnitBusiness::find($id);
        if(empty($business_unit)){
            return response()->json([
                'message' => 'Business Unit not found'
            ],400);
        }

        $business_unit->update($request->all());
        return response()->json([
            'business_unit' => new BusinessUnitResource($business_unit),
            'message' => 'Update successfully'
        ],200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\UnitBusiness  $unitBusiness
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $business_unit = UnitBusiness::find($id);
        if(empty($business_unit)){
            return response()->json([
                'message' => 'Business Unit not found'
            ],400);
            $business_unit->delete($id);
            return response()->json([
                'message' => 'Delete successfully'
            ],200);
        }
    }
}
