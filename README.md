# laravel-api-example

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
            
        })->everyMinute();
