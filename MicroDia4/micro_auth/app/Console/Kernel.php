<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use App\Produto;
use App\Pedido;
use Log;
class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        //
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->call(function () {
            Log::debug("Iniciando calculo de estoque");
            $pedidos = Pedido::with(['produtos'])->where('status', 0)->get();
            foreach($pedidos as $ped) {
                foreach($ped->produtos as $pdt) {
                    $pdt->inventory -= $pdt->pivot->quantity;
                    $pdt->save();
                }
                $ped->status = 1;
                $ped->save();
            }
            
        })->cron('* * * * *');
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
