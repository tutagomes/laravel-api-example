<?php
   
namespace App\Http\Controllers\API;
   
use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Produto;
use Validator;
use Log;
use App\Http\Resources\Produto as ProdutoResource;
use App\Http\Resources\ProdutoCollection as ProdutoCollectionResource;
use App\Pedido;
use App\Http\Resources\Pedido as PedidoResource;
class PedidoController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pedidos = Pedido::with(['user', 'produtos'])->get();
    
        return $pedidos;
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
            'produtos' => 'required',
            'user_id' => 'required'
        ]);
   
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }
   
        $pedido = new Pedido;
        $pedido->status = 0;
        $pedido->user_id = $input['user_id'];
        $pedido->save();
        foreach($input['produtos'] as $pdt) {
            Log::debug($pdt);
            $produto = new Produto;
            $produto->produto_id = $pdt['produto_id'];
            $produto->quantity = $pdt['quantity'];
            $produto->pedido_id = $pedido->id;
            $produto->save();
        }
        $pedido->save();
        return $this->sendResponse(new PedidoResource($pedido), 201);
    } 
   
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $pedido = Pedido::with('produtos')->find($id);
  
        if (is_null($pedido)) {
            return $this->sendError('Pedido not found.');
        }
   
        return $this->sendResponse(new PedidoResource($pedido), 200);
    }
}