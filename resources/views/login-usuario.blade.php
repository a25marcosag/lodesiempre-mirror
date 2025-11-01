<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{asset('css/main.css')}}">
    <title>LoDeSiempre</title>
</head>
<body>
    <header>
        <h1>LoDeSiempre</h1>
        <nav>
            <ul class="menu">
                <li><a href="{{route('listar_tiendas')}}"><--</a></li>
            </ul>
        </nav>
    </header>
    <main class="main">
        <form action="{{route('iniciar_sesion_usuario')}}" method="post">
            @csrf
            <label for="nombre">Nombre</label>
            <input type="text" name="nombre" id="nombre" required>
            <label for="password">Contraseña</label>
            <input type="text" name="password" id="password" required>
            <label for="correo">Email</label>
            <input type="email" name="correo" id="correo">
            <button type="submit">Iniciar sesión</button>
        </form>
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