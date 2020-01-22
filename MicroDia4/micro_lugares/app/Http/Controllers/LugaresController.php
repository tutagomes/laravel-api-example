<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Lugar;
use Validator;

class LugaresController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $lugares = Lugar::all();
        return response()->json($lugares, 200);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->all();

        $validator = Validator::make($input, [
            'titulo' => 'required',
            'descricao' => 'required',
            'endereco' => 'required',
            'user_id' => 'required'
        ]);
   
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }

        $lugar = Lugar::create($input);
        return response()->json($lugar, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $lugar = Lugar::findOrFail($id);
        $lugar->user = $lugar->user();
        return response()->json($lugar, 200);
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        Lugar::find($id)->update($request->all());
        return response()->json($lugar, 200);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $lugar = Lugar::findOrFail($id);
        $lugar->delete();
        return response()->json('{ "success": true, "message": "Lugar successfully deleted!', 200);
    }
}
