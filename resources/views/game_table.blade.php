<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <title>Tres en raya</title>
</head>
<body>
    <h1>Bienvenido al juego del tres en raya</h1>
    <div>
        <form method="post" action="/">
            @csrf
                <button name="boton" type="submit" value="0">-</button>
                <button name="boton" type="submit" value="1">-</button>
                <button name="boton" type="submit" value="2">-</button>
            <br/>
                <button name="boton" type="submit" value="3">-</button>
                <button name="boton" type="submit" value="4">-</button>
                <button name="boton" type="submit" value="5">-</button>
            <br/>
                <button name="boton" type="submit" value="6">-</button>
                <button name="boton" type="submit" value="7">-</button>
                <button name="boton" type="submit" value="8">-</button>
            <br/>
            <br/>
            <input class="especial" name="reset" type="submit" value="Reiniciar partida">
        </form>
    </div>
</body>
</html>