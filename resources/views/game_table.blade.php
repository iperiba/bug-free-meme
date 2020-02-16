<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <title>Tres en raya</title>
    <link rel="stylesheet" href="/css/bootstrap.css">
    <link rel="stylesheet" href="/css/app.css">
</head>
<body>
    <div class="area_ganador alert alert-primary" role="alert">
        <h2>
            @if (!empty($jugador_ganador))
                Enhorabuena, jugador {{ strtoupper($jugador_ganador) }}, ¡has ganado!</div>
            @else
                ¡Que comience el juego!
            @endif
        </h2>
    </div>

    <div class="area_formulario">
        <form method="post" action="/">
            @csrf
            @for ($i = 0; $i < 9; $i++)
                <button name="boton" type="submit" value="{{$i}}" class="btn btn-primary"
                @if (isset($posiciones_X) && isset($posiciones_O))
                    @if (in_array($i, json_decode($posiciones_X)) || in_array($i, json_decode($posiciones_O)) || !empty($jugador_ganador))
                        disabled
                    @endif
                @endif
                >
                    @if (isset($posiciones_X) && isset($posiciones_O))
                        @if (in_array($i, json_decode($posiciones_X)))
                            X
                        @elseif (in_array($i, json_decode($posiciones_O)))
                            O
                        @else
                            -
                        @endif
                    @else
                        -
                    @endif
                </button>
                @if ($i == 2 || $i == 5 || $i == 8)
                    <br>
                @endif
            @endfor
        </form>
    </div>
    <div class="area_botonReiniciar">
        <form method="get" action="/">
            <button type="submit" class="btn btn-outline-info">Reiniciar partida</button>
        </form>
    </div>
</body>
</html>