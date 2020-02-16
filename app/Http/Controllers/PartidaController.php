<?php

namespace App\Http\Controllers;
use App\Partida;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class PartidaController extends Controller
{
    public function configuracion_inicio_partida(Request $request)
    {
        $request->session()->put('jugador', 'a');
        $request->session()->put('inicio_partida', true);
        PartidaController::asignar_id_partida($request);
        $request->session()->put('id_jugada', 1);
        
        return view('game_table');
    }

    public function clic_jugador(Request $request)
    {   
        $eleccion_jugador = $request->input('boton');
        $id_jugada = $request->session()->get('id_jugada');

        $mostrarjugador = $request->session()->get('jugador');
        $mostrarInicioPartida = $request->session()->get('inicio_partida');
       
        echo $mostrarjugador;
        echo $mostrarInicioPartida;

        if($request->session()->get('inicio_partida')) {

            $tablero = array('-','-','-','-','-','-','-','-');
           
            if($request->session()->get('jugador')=='a') {
                $tablero[$eleccion_jugador] = "X";
            } else {
                $tablero[$eleccion_jugador] = "O";
            }

            $tablero_json = json_encode($tablero);

            echo $tablero_json;

            $partida = new Partida;

            $partida->partida = $request->session()->get('id_partida');
            $partida->movimiento = $id_jugada;
            $partida->jugador = $request->session()->get('jugador');
            $partida->tablero = $tablero_json;
    
            $partida->save();

            $request->session()->put('inicio_partida', false);

            $posiciones_X =json_encode(array_keys($tablero, 'X'));
            $posiciones_O = json_encode(array_keys($tablero, 'O'));

            if($request->session()->get('jugador')=='a') {
                $request->session()->put('jugador', 'b');
            } else {
                $request->session()->put('jugador', 'a');
            }

            $request->session()->put('inicio_partida', false);
            $request->session()->put('id_jugada', ++$id_jugada);
            echo $id_jugada;

            return view('game_table', ['posiciones_X' => $posiciones_X, 'posiciones_O' => $posiciones_O]);

        } else {

            $jugada_anterior = DB::table('partidas')->orderBy('fecha', 'desc')->first();
            $tablero = json_decode( $jugada_anterior->tablero);

            if($request->session()->get('jugador')=='a') {
                $tablero[$eleccion_jugador] = "X";
            } else {
                $tablero[$eleccion_jugador] = "O";
            }

            $tablero_json = json_encode($tablero);

            echo $tablero_json;

            $partida = new Partida;

            $partida->partida =  $request->session()->get('id_partida');
            $partida->movimiento = $request->session()->get('id_jugada');
            $partida->jugador = $request->session()->get('jugador');
            $partida->tablero = $tablero_json;
    
            $partida->save();

            $posiciones_X = array_keys($tablero, 'X');
            $posiciones_O = array_keys($tablero, 'O');
            
            /* posibles combinaciones ganadoras */

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

            $jugador_ganador="";

            if($request->session()->get('jugador')=='a') {
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

            if($request->session()->get('jugador')=='a') {
                $request->session()->put('jugador', 'b');
            } else {
                $request->session()->put('jugador', 'a');
            }

            $request->session()->put('id_jugada', ++$id_jugada);

            return view('game_table', ['posiciones_X' => json_encode($posiciones_X), 
            'posiciones_O' => json_encode($posiciones_O), 'jugador_ganador' => $jugador_ganador]);
        }
    }

    private function asignar_id_partida(Request $request) {
        $last_id_partida = DB::table('partidas')->max('partida');

        if (isset($last_id_partida)) {
            $id_partida = ++$last_id_partida;
        } else {
            $id_partida = 1;
        }
        $request->session()->put('id_partida', $id_partida);
    }
}