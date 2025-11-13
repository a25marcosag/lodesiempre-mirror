<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{asset('css/main.css')}}">
    <script src="{{asset('js/updateUsuarioModal.js')}}" defer></script>
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
    <main class="main">
        <ul class="tarjetas" title="tarjetas">
            @foreach($usuarios as $u)
                <li class="tarjeta" title="tarjeta">
                    <h2>{{$u->nombre}}</h2>
                    <p>{{$u->tipo}}</p>
                    <p>{{$u->email}}</p>
                    <a href="#" class="btn-modal" aria-label="Abrir ventana de gestión de ${{$u->nombre}}"
                        data-id="{{$u->id}}"
                        data-nombre="{{$u->nombre}}"
                        data-correo="{{$u->email}}">
                        Editar
                    </a>
                    <form action="{{route('delete_usuario', ['id' => $u->id])}}" method="post">
                        @csrf
                        @method('DELETE')
                        <button type="submit" onclick="return confirm('Seguro que quieres eliminar a este usuario junto con su tienda?')">Eliminar</button>
                    </form>
                </li>
            @endforeach
        </ul>
        <dialog id="popup" class="dialog">
            <a href="#" onclick="window.popup.close();" class="btn-cerrar" aria-label="Cerrar ventana de gestión de usuario">X</a>
            <form method="post" id="formUpdate">
                @csrf
                @method('PUT')
                <input type="text" name="nombre" id="nombre_edit" placeholder="Nombre">
                <input type="email" name="correo" id="correo_edit" placeholder="Correo electrónico">
                <button type="submit">Actualizar</button>
            </form>
        </dialog>
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