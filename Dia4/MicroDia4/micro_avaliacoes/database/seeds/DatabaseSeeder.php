<?php

use Illuminate\Database\Seeder;
use App\Avaliacao;
class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $rating = Avaliacao::firstOrNew(['id' => 1]);
        $rating->fill([
            'user_id' => 1,
            'lugar_id' => 1,
            'rating' => 3,
            'descricao' => 'Lugar bonito, limpeza pessima'
        ])->save();

        $rating = Avaliacao::firstOrNew(['id' => 2]);
        $rating->fill([
            'user_id' => 2,
            'lugar_id' => 1,
            'rating' => 5,
            'descricao' => 'Otimo lugar'
        ])->save();

        $rating = Avaliacao::firstOrNew(['id' => 3]);
        $rating->fill([
            'user_id' => 3,
            'lugar_id' => 2,
            'rating' => 4,
            'descricao' => 'Faltou piscina'
        ])->save();

    }
}