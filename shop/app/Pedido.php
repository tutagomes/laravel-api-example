<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
class Pedido extends Model
{
    protected $table = 'pedidos';
    public function produtos()
    {
        return $this->belongsToMany('App\Produto')->withPivot('quantity');
    }
    public function user()
    {
        return $this->belongsTo('App\User');
    }
    public function total() {

        $total = 0;
        foreach($this->produtos as $produto) {
            if($produto->discount) {
                $total += ($produto->price - $produto->price*($produto->discount/100))*$produto->pivot->quantity;
            }
            else {
                $total += $produto->price*$produto->pivot->quantity;
            }
        }
        return $total;
    }
}
