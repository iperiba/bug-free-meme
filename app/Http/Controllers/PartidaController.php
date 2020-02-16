<?php

namespace App\Http\Controllers;
use App\Http\Controllers\ExternalMethodsPartida;
use Illuminate\Http\Request;

class PartidaController extends Controller
{
    public function configuracion_inicio_partida(Request $request)
    {
        $request->session()->put('turno_jugador', 'a');
        ExternalMethodsPartida::asignar_id_partida($request);
        $request->session()->put('id_jugada', 1);

        return view('game_table');
    }

    public function clic_jugador(Request $request)
    {   
        $eleccion_jugador = $request->input('boton');
        $turno_jugador = $request->session()->get('turno_jugador');
        $id_partida = $request->session()->get('id_partida');
        $id_jugada = $request->session()->get('id_jugada');
        $tablero = ExternalMethodsPartida::mover_ficha($eleccion_jugador, $id_jugada, $turno_jugador);

        ExternalMethodsPartida::guardar_jugada_baseDatos($id_partida, $id_jugada, $turno_jugador, $tablero);

        $posiciones_X = array_keys($tablero, 'X');
        $posiciones_O = array_keys($tablero, 'O');
        $jugador_ganador = ExternalMethodsPartida::comprobar_ganador($request, $posiciones_X, $posiciones_O);

        ExternalMethodsPartida::cambiar_turno($request, $turno_jugador);
        $request->session()->put('id_jugada', ++$id_jugada);

        return view('game_table', ['posiciones_X' => json_encode($posiciones_X), 
        'posiciones_O' => json_encode($posiciones_O), 'jugador_ganador' => $jugador_ganador]);
    }
}