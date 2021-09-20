<?php

namespace App\Http\Controllers;

use App\Models\Business;
use App\Http\Resources\BusinessResource;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class BusinessController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $business =  Business::all();
        return response()->json([
            'business' => BusinessResource::collection($business),
            'messahg' => 'Retrieveds successfully'
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
            'name' => 'required|string|min:max',
            'direction' => 'required|string|max:255',
            'cp' => 'required|integer|min:5',
            'contact' => 'required|string|max:255',
            'phone' => 'required|string|max:10|min:10',
            'email' => 'required|string|max:30',
            'rfc' => 'max:13|min:13',
            'id_aplication' => 'required'
        ]);

        if($validator->fails()){
            return response()->json([
                'error' => $validator->errors(),
                'message' => 'Fail validation'
            ],400);
        }
        $business = Business::create($data);

        return response()->json([
            'business' => new BusinessResource($business),
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
        $business = Business::find($id);
        if(empty($business)){
            return response()->json([
                'message' => 'Business not exists'
            ],400);
        }
        return response()->json([
            'business' => new BusinessResource($business),
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
        $business = Business::find($id);
        if(empty($business)){
            return response()->json([
                'message' => 'Business not exists'
            ],400);
        }
        $business->update($request->all());
            return response()->json([
                'business' => new BusinessResource($business),
                'message' => 'Update successfully'
            ],200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  @id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $business = Business::find($id);
        if(empty($business)){
            return response()->json([
                'message' => 'Business not found'
            ],400);
        }
        $business->delete($id);
        return response()->json([
            'message' => 'Delete successfully'
        ],200);
    }
}
