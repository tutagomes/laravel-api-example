<?php

use Illuminate\Database\Seeder;
use App\Lugar;
class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $lugar = Lugar::firstOrNew(['id' => 1]);
        $lugar->fill([
            'titulo' => "Anuncio 1",
            'descricao' => "Primeiro anuncio da plataforma",
            'endereco' => 'Rua 1',
            'user_id' => 1,
            'price' => 300.00
        ])->save();

        $lugar = Lugar::firstOrNew(['id' => 2]);
        $lugar->fill([
            'titulo' => "Anuncio 2",
            'descricao' => "Segundo anuncio da plataforma",
            'endereco' => 'Rua 2',
            'user_id' => 1,
            'price' => 200.00
        ])->save();

        $lugar = Lugar::firstOrNew(['id' => 3]);
        $lugar->fill([
            'titulo' => "Anuncio 3",
            'descricao' => "Terceiro anuncio da plataforma",
            'endereco' => 'Rua 2',
            'user_id' => 2,
            'price' => 500.00
        ])->save();

    }
}
