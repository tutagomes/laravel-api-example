<?php

namespace App;
use Log;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Redis;
class Avaliacao extends Model
{
    protected $table = 'avaliacoes';
    protected $fillable = [
        'rating', 'descricao', 'user_id', 'lugar_id'
    ];
    public function lugar()
    {

        try {
        $client = new \GuzzleHttp\Client();
            $response = $client->request('GET', env('LUGAR_API', 'http://localhost:8001').'/api/lugares/'.$this->lugar_id);
            if ($response->getStatusCode() == 200) {
                $data = json_decode($response->getBody()->getContents(), true);
                return $data;
            }
        } catch (Exception $e) {
            return 'Not Found';
        }
    }
  public function user()
    {
        try {
        $client = new \GuzzleHttp\Client();
            $response = $client->request('GET', env('USER_API', 'http://localhost:8000').'/api/users/'.$this->user_id);
            if ($response->getStatusCode() == 200) {
                $data = json_decode($response->getBody()->getContents(), true);
                return $data;
            }
        }
            catch (Exception $e) {
                return 'Not Found';
            }
    }
    public function calculaTotal () {
        $todas = \app\Avaliacao::where('lugar_id', $this->lugar_id)->get();
        $total = 0;
        $numero = 0;
        foreach($todas as $avaliacao) {
            $total += $avaliacao->rating;
            $numero++;
        }

        Redis::publish('alteraRating/1', json_encode(['lugar_id' => $this->lugar_id, 'rating' => ($total / $numero)]));
    }
}

