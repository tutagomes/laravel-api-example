<?php

namespace App;
use Log;
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
            if ($response->getStatusCode() == 200) {
                $data = json_decode($response->getBody()->getContents(), true);
                Log::debug($data);
                if (array_key_exists('discounted_price', $data['data'])) {
                    Log::debug("Tem Desconto");
                    $total += $produto->quantity * floatval($data['data']['discounted_price']);
                } else if (array_key_exists('price', $data['data'])) {
                    Log::debug("Não Tem Desconto");
                    $total += $produto->quantity * floatval($data['data']['price']);
                }
            }
            Log::debug($total);
        }
        return $total;
    }
}
