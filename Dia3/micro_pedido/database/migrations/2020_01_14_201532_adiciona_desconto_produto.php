<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AdicionaDescontoProduto extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        if (!Schema::hasColumn('produtos', 'discount')) {
            //
            Schema::table('produtos', function (Blueprint $table) {
                $table->integer('discount')->default(0);	
            });
        }
    }
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        if (Schema::hasColumn('produtos', 'discount')) {
            Schema::table('produtos', function (Blueprint $table) {
                $table->dropColumn('discount');
            });
        }
    }
}
