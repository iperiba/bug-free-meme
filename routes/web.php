<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/*Route::get('/', function () {
    return view('game_table');
});*/

Route::get('/', 'PartidaController@configuracion_inicio_partida');

Route::post('/', 'PartidaController@clic_jugador');
