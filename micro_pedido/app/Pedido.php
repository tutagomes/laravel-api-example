<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
class Pedido extends Model
{
    protected $table = 'pedidos';
    public function produtos()
    {
        return $this->hasMany('App\Produto');
    }
    public function user()
    {
        return $this->belongsTo('App\User');
    }
    public function total() {

        $total = 0;
        foreach($this->produtos as $produto) {
            // Fazer implementação
            $client = new \GuzzleHttp\Client();
            $response = $client->request('GET', 'http://localhost:8002/api/produtos/'.$produto->produto_id);
            $response->getStatusCode(); // 200
            if ($response->getStatusCode == 200) {
                $data = $response->getBody(); // '{"id": 1420053, "name": "guzzle", ...}'
                Log::debug($response->getBody());
                if ($data['discountedPrice']) {
                    $total += $produto->quantity * $data['discountedPrice'];
                } else {
                    $total += $produto->price;
                }
            }
        }
        return $total;
    }
}
