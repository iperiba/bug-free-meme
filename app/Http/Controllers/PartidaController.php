<?php

namespace App\Http\Controllers;
use App\Partida;
use Illuminate\Http\Request;

class PartidaController extends Controller
{
    public function configuracion_inicio_partida(Request $request)
    {
        $request->session()->put('turno', '');
        $request->session()->put('inicio_partida', true);

        $posiciones_X = json_encode(array());
        $posiciones_O = json_encode(array());

        return view('game_table', ['posiciones_X' =>  $posiciones_X, 'posiciones_O' => $posiciones_O]);
    }

    public function clic_jugador(Request $request)
    {   
        if($request->session()->get('turno')=='a') {
            $request->session()->put('turno', 'b');
        } else {
            $request->session()->put('turno', 'a');
        }

        $eleccion_jugador = $request->input('boton');
        $value = $request->session()->get('turno');
        $value02 = $request->session()->get('inicio_partida');
       

        echo $value;
        echo $value02;

        if($request->session()->get('inicio_partida')) {
            $tablero = array("-", "-", "-", "-", "-", "-", "-", "-");

            if($request->session()->get('turno')=='a') {
                $tablero[$eleccion_jugador] = "X";
            } else {
                $tablero[$eleccion_jugador] = "O";
            }

            $tablero_json = json_encode($tablero);

            echo $tablero_json;

            $partida = new Partida;

            $partida->partida = 1;
            $partida->movimiento = 1;
            $partida->jugador = $request->session()->get('turno');
            $partida->tablero = $tablero_json;
    
            $partida->save();

            $request->session()->put('inicio_partida', false);

            $posiciones_X =array_keys($tablero, 'X');
            $posiciones_O = array_keys($tablero, 'X');

            /*echo $posiciones_X;
            echo $posiciones_O;*/

            return view('game_table', ['posiciones_X' => json_encode($posiciones_X), 
            'posiciones_O' => json_encode($posiciones_O)]);

        } else {



        }
    }
}