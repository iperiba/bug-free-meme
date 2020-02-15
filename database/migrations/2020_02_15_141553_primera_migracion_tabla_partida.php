<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class PrimeraMigracionTablaPartida extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('partidas', function (Blueprint $table) {
            $table->bigInteger('id_partida');
            $table->bigInteger('id_movimiento');
            $table->json('tablero');
            $table->dateTime('fecha')->useCurrent();
            $table->primary(['id_partida', 'id_movimiento']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
    }
}
