<?php
   
namespace App\Http\Controllers\API;
   
use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Produto;
use Validator;
use Log;
use App\Http\Resources\Produto as ProdutoResource;
use App\Http\Resources\ProdutoCollection as ProdutoCollectionResource;
class ProdutoController extends BaseController
{
    public function historico($id) {
        return Produto::findOrFail($id)->audits;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Produto::all();
    
        return new ProdutoCollectionResource($products);
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
            'title' => 'required',
            'short_description' => 'required',
          	'long_description' => 'required',
            'price' => 'required',
            'discount' => 'required',  
          	'inventory' => 'required'
        ]);
   
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }
   
        $product = Produto::create($input);
   
        return $this->sendResponse(new ProdutoResource($product), 201);
    } 
   
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Produto::find($id);
  
        if (is_null($product)) {
            return $this->sendError('Product not found.');
        }
   
        return $this->sendResponse(new ProdutoResource($product), 200);
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
        $input = $request->all();
   
        $validator = Validator::make($input, [
            'title' => 'required',
            'short_description' => 'required',
          	'long_description' => 'required',
              'price' => 'required',
              'discount' => 'required',
          	'inventory' => 'required'
        ]);
   
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }
        Produto::find($id)->update($request->all());
        
        return $this->sendResponse(new ProdutoResource(Produto::findOrFail($id)), 200);
    }
   
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Produto::findOrFail($id)->delete();
   
        return $this->sendResponse([], 'Product deleted successfully.', 200);
    }
}