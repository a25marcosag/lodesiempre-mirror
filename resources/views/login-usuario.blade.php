<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" {{asset('favicon.ico')}}>
    <link rel="stylesheet" href="{{asset('css/main.css')}}">
    <style>
        :root {
            --gradiente-fondo: linear-gradient(
                to bottom left,
                rgb(168, 223, 241) 0%,
                rgb(168, 223, 241) 30%,
                rgb(227, 248, 255) 50%,
                rgb(168, 223, 241) 70%,
                rgb(168, 223, 241) 100%
            );
        }
    </style>
    <title>LoDeSiempre</title>
</head>
<body>
    <header>
        <h1>LoDeSiempre</h1>
        <a class="logo" href="{{route('listar_tiendas')}}"><img src="{{asset('storage/img/logo.png')}}" alt="LoDeSiempre"></a>
        <nav>
            <ul class="menu">
                <li><a href="{{route('registro_usuario')}}" aria-label="Ir a registro de usuario">Registrarse</a></li>
            </ul>
        </nav>
    </header>
    <main class="main">
        <form class="form-session" action="{{route('iniciar_sesion_usuario')}}" method="post">
            @csrf
            <label for="nombre">Nombre</label>
            <input type="text" name="nombre" id="nombre">
            <label for="contrasena">Contraseña</label>
            <input type="password" name="contrasena" id="contrasena" required>
            <button type="submit">Iniciar sesión</button>
        </form>
        @if($errors->any())
            <p>{{$errors->first()}}</p>
        @endif
        @if(isset($error))
            <p>{{$error}}</p>
        @endif
    </main>
    <footer>
        <p>&copy; 2025 Marcos Asensi Goyanes</p>
        <p>Aviso legal y política de privacidad</p>
    </footer>
</body>
</html>