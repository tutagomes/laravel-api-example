<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Avaliacao;
use Validator;

class AvaliacoesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $rating = Avaliacao::all();
        return response()->json($rating, 200);
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
            'user_id' => 'required',
            'lugar_id' => 'required',
            'rating' => 'required',
            'descricao' => 'required'
        ]);
   
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }

        $rating = Avaliacao::create($input);
        $rating->calculaTotal();
        return response()->json($rating, 201);
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
        $rating = Avaliacao::findOrFail($id);
        $rating->user = $rating->user();
        $rating->lugar = $rating->lugar();
        return response()->json($rating, 200);
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
        Avaliacao::find($id)->update($request->all());
        $rating = Avaliacao::find($id);
        $rating->calculaTotal();
        return response()->json($rating, 200);

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
        $rating = Avaliacao::findOrFail($id);
        $rating->delete();
        return response()->json('{ "success": true, "message": "Lugar successfully deleted!', 200);
    }
}