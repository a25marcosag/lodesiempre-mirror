<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{asset('css/main.css')}}">
    <script src="{{asset('js/updateProdModal.js')}}" defer></script>
    <title>LoDeSiempre</title>
</head>
<body>
    <header>
        <h1>LoDeSiempre</h1>
        <nav>
            <ul class="menu">
                @if(session('usuario_tipo') !== "vendedor")
                    <li><a href="{{route('listar_tiendas')}}"><--</a></li>
                @endif
                <li>
                    @if(session('usuario_tipo') === "admin")
                        <a href="{{route('listar_usuarios')}}" aria-label="Ir a panel de usuarios">Usuarios</a>
                    @else
                        <a href="#" aria-label="Ir al carrito de la compra">Carrito</a>
                    @endif
                </li>
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
        @if($tienda->verif)
            <span class="verif">
                <svg fill="#3d3846" viewBox="0 0 24.00 24.00" id="check-circle" data-name="Flat Color" xmlns="http://www.w3.org/2000/svg" class="icon flat-color" stroke="#3d3846" stroke-width="0.528"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round" stroke="#CCCCCC" stroke-width="0.192"></g><g id="SVGRepo_iconCarrier"><circle id="primary" cx="12" cy="12" r="10" style="fill: #8ff0a4;"></circle><path id="secondary" d="M11,16a1,1,0,0,1-.71-.29l-3-3a1,1,0,1,1,1.42-1.42L11,13.59l4.29-4.3a1,1,0,0,1,1.42,1.42l-5,5A1,1,0,0,1,11,16Z" style="fill: #26a269;"></path></g></svg>
            </span>
        @endif
        @if($tienda->icono)
            @php
                $nombreImagenTienda = asset('storage/img/' . $tienda->icono);
            @endphp
            <span class="imagen" style="background-image: url({{$nombreImagenTienda}});"></span>
        @endif
        <h2>{{$tienda->nombre}}</h2>
        <p>{{$tienda->provincia}}</p>
        <p>{{$tienda->descripcion}}</p>
        @if(session('usuario_tipo') === "vendedor" || session('usuario_tipo') === "admin")
            <a href="#" onclick="window.popupTienda.showModal();" class="btn-modal" aria-label="Abrir ventana de edición de tienda">Editar</a>
        @endif
        <dialog id="popupTienda" class="dialog">
            <a href="#" onclick="window.popupTienda.close();" class="btn-cerrar" aria-label="Cerrar ventana de edición de tienda">X</a>
            <form action="{{route('update_tienda', ['idTienda' => $tienda->id])}}" method="post">
                @csrf
                @method('PUT')
                <input type="text" name="nombre" id="nombre_tienda" value="{{$tienda->nombre}}" placeholder="Nombre de la tienda" required>
                <select name="prov" id="prov_tienda" required>
                    <option value="A Coruña" {{($provincia ?? '') == 'A Coruña' ? 'selected' : ''}}>A Coruña</option>
                    <option value="Pontevedra" {{($provincia ?? '') == 'Pontevedra' ? 'selected' : ''}}>Pontevedra</option>
                </select>
                <input type="text" name="desc" id="desc_tienda" value="{{$tienda->descripcion}}" placeholder="Desc. de la tienda">
                <input type="text" name="icono" id="icono_tienda" value="{{$tienda->icono}}" placeholder="Imagen de la tienda">
                <button type="reset" class="btn-reset">Restablecer datos</button>
                <button type="submit" class="btn-submit">Actualizar tienda</button>
            </form>
        </dialog>
        <ul class="tarjetas" title="tarjetas">
            @foreach($productos as $p)
                <li class="tarjeta" title="tarjeta">
                    <h2>{{$p->nombre}}</h2>
                    <p>{{$p->precio}} €</p>
                    <p>{{$p->descripcion}}</p>
                    @if($p->imagen)
                        @php
                            $nombreImagenProd = asset('storage/img/' . $p->imagen);
                        @endphp
                        <span class="imagen" style="background-image: url({{$nombreImagenProd}});"></span>
                    @endif
                    @if(session('usuario_tipo') === "vendedor" || session('usuario_tipo') === "admin")
                        <a href="#" class="btn-modal btn-update" aria-label="Abrir ventana de edición de ${{$p->nombre}}"
                            data-id="{{$p->id}}"
                            data-nombre="{{$p->nombre}}"
                            data-precio="{{$p->precio}}"
                            data-desc="{{$p->descripcion}}"
                            data-imagen="{{$p->imagen}}"
                            data-tienda="{{$p->tienda_id}}">
                            Editar
                        </a>
                    @else
                        <a href="#" class="btn-add-carrito" aria-label="Añadir ${{$p->nombre}} al carrito">Añadir al carrito</a>
                    @endif
                </li>
            @endforeach
            @if(session('usuario_tipo') === "vendedor" || session('usuario_tipo') === "admin")
                <li class="tarjeta" title="tarjeta">
                    <a href="#" onclick="window.popupAdd.showModal();" class="btn-modal" aria-label="Abrir ventana de añadir nuevo producto">+</a>
                </li>
            @endif
        </ul>
        <dialog id="popupUpdate" class="dialog">
            <a href="#" onclick="window.popupUpdate.close();" class="btn-cerrar" aria-label="Cerrar ventana de edición del producto">X</a>
            <form method="post" id="formUpdateProd">
                @csrf
                @method('PUT')
                <input type="text" name="nombre" id="nombre_edit" placeholder="Nombre del producto" required>
                <!-- Campo del precio es de tipo texto para un comportamiento homogéneo entre navegadores a través del pattern,
                    inputmode para teclado núm. en móviles -->
                <input type="text" name="precio" id="precio_edit" inputmode="decimal" placeholder="Precio del producto"
                    title="Tiene que ser un número del 0.01 al 999.99, los decimales se escriben con punto y son opcionales"
                    pattern="^(0\.0*[1-9]|[1-9][0-9]{0,2}(\.[0-9]{1,2})?)$"required>
                <input type="text" name="desc" id="desc_edit" placeholder="Desc. del producto">
                <input type="text" name="imagen" id="imagen_edit" placeholder="Imagen del producto">
                <button type="submit" class="btn-submit">Actualizar el producto</button>
            </form>
            <form method="post" id="formDeleteProd">
                @csrf
                @method('DELETE')
                <button type="submit" onclick="return confirm('Seguro que quieres eliminar este producto?')">Eliminar</button>
            </form>
        </dialog>
        <dialog id="popupAdd" class="dialog">
            <a href="#" onclick="window.popupAdd.close();" class="btn-cerrar" aria-label="Cerrar ventana de añadir nuevo producto">X</a>
            <form action="{{route('add_producto', ['idTienda' => $tienda->id])}}" method="post">
                @csrf
                <input type="text" name="nombre" id="nombre_nuevo" placeholder="Nombre del producto" required>
                <input type="text" name="precio" id="precio_nuevo" inputmode="decimal" placeholder="Precio del producto"
                    title="Tiene que ser un número del 0.01 al 999.99, los decimales se escriben con punto y son opcionales"
                    pattern="^(0\.0*[1-9]|[1-9][0-9]{0,2}(\.[0-9]{1,2})?)$" inputmode="decimal" required>
                <input type="text" name="desc" id="desc_nuevo" placeholder="Desc. del producto">
                <input type="text" name="imagen" id="imagen_nuevo" placeholder="Imagen del producto">
                <button type="submit" class="btn-submit">Añadir producto</button>
            </form>
        </dialog>
    </main>
    <footer>
        <p>&copy; 2025 Marcos Asensi Goyanes</p>
        <p>Aviso legal y política de privacidad</p>
    </footer>
</body>
</html>
