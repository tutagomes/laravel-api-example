<?php

namespace App;
use Log;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Lugar extends Model
{
    protected $table = 'lugares';
    use SoftDeletes;
    protected $fillable = [
        'titulo', 'descricao', 'user_id', 'price', 'endereco'
    ];
    public function user()
    {
        $client = new \GuzzleHttp\Client();
            try {
                $response = $client->request('GET', env('USER_API', 'http://localhost:8000').'/api/users/'.$this->user_id);
            if ($response->getStatusCode() == 200) {
                $data = json_decode($response->getBody()->getContents(), true);
                return $data;
            }}
            catch (Exception $e) {
                return 'Not Found';
            } 
    }
}