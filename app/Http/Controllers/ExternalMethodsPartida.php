<?php

namespace App\Http\Controllers;
use App\Partida;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class ExternalMethodsPartida extends Controller
{
    public static function asignar_id_partida(Request $request) {
        $last_id_partida = DB::table('partidas')->max('numero_partida');

        if (isset($last_id_partida)) {
            $id_partida = ++$last_id_partida;
        } else {
            $id_partida = 1;
        }
        $request->session()->put('id_partida', $id_partida);
    }

    public static function mover_ficha($eleccion_jugador, $id_jugada, $turno_jugador) {

        $tablero = array();
        if($id_jugada==1) {
            $tablero = array('-','-','-','-','-','-','-','-');
        } else {
            $jugada_anterior = DB::table('partidas')->orderBy('fecha', 'desc')->first();
            $tablero = json_decode( $jugada_anterior->tablero);
        }

        if($turno_jugador=='a') {
            $tablero[$eleccion_jugador] = "X";
        } else {
            $tablero[$eleccion_jugador] = "O";
        }

        return $tablero;
    }

    public static function guardar_jugada_baseDatos($id_partida, $id_jugada, $turno_jugador, $tablero) {
        $partida = new Partida;
        $partida->numero_partida =  $id_partida;
        $partida->numero_movimiento = $id_jugada;
        $partida->jugador = $turno_jugador;
        $partida->tablero = json_encode($tablero);
        $partida->save();
    }

    public static function comprobar_ganador($request, $posiciones_X, $posiciones_O) {
        $jugador_ganador="";
        $combinaciones_conjunto = array(
            array(0, 1, 2),
            array(3, 4, 5),
            array(6, 7, 8),
            array(0, 3, 6),
            array(1, 4, 7),
            array(2, 5, 8),
            array(0, 4, 8),
            array(6, 4, 2)
        );

        if($request->session()->get('turno_jugador')=='a') {
            foreach ($combinaciones_conjunto as $combinaciones_individual) {
                if(count(array_intersect($posiciones_X, $combinaciones_individual))==3) {
                    $jugador_ganador = 'a';
                }
            }
        } else {
            foreach ($combinaciones_conjunto as $combinaciones_individual) {
                if(count(array_intersect($posiciones_O, $combinaciones_individual))==3) {
                    $jugador_ganador = 'b';
                }
            }
        }

        return $jugador_ganador;
    }

    public static function cambiar_turno($request, $turno_jugador) {
        if($turno_jugador=='a') {
            $request->session()->put('turno_jugador', 'b');
        } else {
            $request->session()->put('turno_jugador', 'a');
        }
    }
}