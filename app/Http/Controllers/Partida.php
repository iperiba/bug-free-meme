<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Partida extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }



    public function configuracion_inicio_partida(Request $request)
    {
        $request->session()->put('turno', '');
        $request->session()->put('inicio_partida', true);

        return view('game_table');
    }

    public function clic_jugador(Request $request)
    {   
        if($request->session()->get('turno')=='jugador_a') {
            $request->session()->put('turno', 'jugador_b');
        } else {
            $request->session()->put('turno', 'jugador_a');
        }

        $eleccion_jugador = $request->input('boton');
        $value = $request->session()->get('turno');
        $value02 = $request->session()->get('inicio_partida');
       

        echo $value;
        echo $value02;

        if($request->session()->get('inicio_partida')) {
            $tablero = array("-", "-", "-", "-", "-", "-", "-", "-");

            if($request->session()->get('turno')=='jugador_a') {
                $tablero[$eleccion_jugador] = "x";
            } else {
                $tablero[$eleccion_jugador] = "0";
            }

            $tablero_json = json_encode($tablero);

            echo $tablero_json;

            $partida = new Partida;

            $partida->id_partida = 1;
            $partida->id_movimiento = 1;
            $partida->jugador = $request->session()->get('turno');
            $partida->tablero = $tablero_json;
    
            $partida->save();

            $request->session()->put('inicio_partida', false);

        } else {

        }
    }
}
