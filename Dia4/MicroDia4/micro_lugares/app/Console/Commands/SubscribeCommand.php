<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Redis;
use Log;
use App\Lugar;
class SubscribeCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'redis:subscribeCommand';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Recebe informacoes do Redis';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        //
        Redis::psubscribe(['alteraRating/*'], function ($message, $channel) {
            // $message é a mensagem recebida, obviamente
            // $channel é o canal o qual foi enviada a publicação
            Log::debug("\nMensagem: ".$message."\n\nCanal: ".json_encode(explode('/', $channel))."\n");
            $resultado = json_decode($message, true);
            Log::debug($resultado);
            $lugar = Lugar::findOrFail($resultado['lugar_id']);
            $lugar->rating = $resultado['rating'];
            $lugar->save();
        });
    }
}