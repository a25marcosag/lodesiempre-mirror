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
                @if(session('usuario_id'))
                    <li><a href="{{route('logout_usuario')}}" aria-label="Cerrar tu sesión actual">Cerrar sesión</a></li>
                @else
                    <li><a href="{{route('inicio_sesion_usuario')}}" aria-label="Ir a inicio de sesión">Iniciar sesión</a></li>
                    <li><a href="{{route('registro_usuario')}}" aria-label="Ir a registro de usuario">Registrarse</a></li>
                @endif
            </ul>
        </nav>
    </header>
    <footer>
        <p>&copy; 2025 Marcos Asensi Goyanes</p>
        <p>Aviso legal y política de privacidad</p>
    </footer>
</body>
</html>