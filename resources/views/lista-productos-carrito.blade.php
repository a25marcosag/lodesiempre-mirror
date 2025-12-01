<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{csrf_token()}}">
    <link rel="icon" {{asset('favicon.ico')}}>
    <link rel="stylesheet" href="{{asset('css/main.css')}}">
    <title>LoDeSiempre</title>
    <script src="{{asset('js/ajaxProdCarrito.js')}}" defer></script>
    <style>
        :root {
            --gradiente-fondo: linear-gradient(
                to bottom left,
                rgb(227, 248, 255) 0%,
                rgb(227, 248, 255) 30%,
                rgb(168, 202, 241) 50%,
                rgb(227, 248, 255) 70%,
                rgb(227, 248, 255) 100%
            );
        }
    </style>
</head>
<body>
    <header>
        <h1>LoDeSiempre</h1>
        <a class="logo" href="{{route('listar_tiendas')}}"><img src="{{asset('storage/img/logo.png')}}" alt="LoDeSiempre"></a>
        <nav>
            <ul class="menu">
                @if(session('usuario_id'))
                    <li><a href="{{route('logout_usuario')}}" aria-label="Cerrar tu sesión actual">Cerrar sesión</a></li>
                @else
                    <li><a href="{{route('inicio_sesion_usuario')}}" aria-label="Ir a inicio de sesión">Iniciar sesión</a></li>
                    <li><a href="{{route('registro_usuario')}}" aria-label="Ir a registro de usuario">Registrarse</a></li>
                @endif
            </ul>
        </nav>
    </header>
    <main class="main">
        <h2>Carrito{{session('usuario_nombre') ? ' de '.session('usuario_nombre') : ''}}</h2>
        @if(session('success'))
            <p class="sin-prod">{{session('success')}}</p>
        @else
            <ul class="tarjetas" title="tarjetas">
            </ul>
            <p class="total-compra">Total de la compra: <span class="precio-total">0</span> €</p>
            <button onclick="borrarProductos()" class="btn-vaciar" aria-label="Borrar el carrito entero">
                Vaciar carrito
            </button>
            <a href="{{session('usuario_id') ? route('procesar_compra') : route('inicio_sesion_usuario')}}" class="btn-comprar" aria-label="Ir a pago de la compra"
                    @if( session('usuario_id') === null )
                        onclick="return confirm('Para realizar la compra es necesario iniciar sesión.')"
                    @else
                        onclick="return confirm('¿Confirmar compra?')"
                    @endif
                    >
                Comprar
            </a>
        @endif
    </main>
    <footer>
        <p>&copy; 2025 Marcos Asensi Goyanes</p>
        <p>Aviso legal y política de privacidad</p>
        @if(session('usuario_id'))
            <form action="{{route('delete_usuario', ['id' => session('usuario_id')])}}" method="post">
                @csrf
                @method('DELETE')
                <button type="submit" onclick="return confirm('Seguro que quieres eliminar tu cuenta permanentemente?')">Borrar mi cuenta</button>
            </form>
        @endif
    </footer>
</body>
</html>