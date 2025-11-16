<!DOCTYPE html>
<html lang="es">
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
                        <a href="{{route('listar_productos_carrito')}}" aria-label="Ir al carrito de la compra">Carrito</a>
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
        @if($tienda->icono)
            @php
                $nombreImagenTienda = asset('storage/img/' . $tienda->icono);
            @endphp
            <span class="imagen" style="background-image: url({{$nombreImagenTienda}});"></span>
        @endif
        <section class="tarjeta-titulo">
            <h2>{{$tienda->nombre}}</h2>
            @if($tienda->verif)
                <span class="verif">
                    <svg fill="#3d3846" viewBox="0 0 24.00 24.00" id="check-circle" data-name="Flat Color" xmlns="http://www.w3.org/2000/svg" class="icon flat-color" stroke="#3d3846" stroke-width="0.528"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round" stroke="#CCCCCC" stroke-width="0.192"></g><g id="SVGRepo_iconCarrier"><circle id="primary" cx="12" cy="12" r="10" style="fill: #8ff0a4;"></circle><path id="secondary" d="M11,16a1,1,0,0,1-.71-.29l-3-3a1,1,0,1,1,1.42-1.42L11,13.59l4.29-4.3a1,1,0,0,1,1.42,1.42l-5,5A1,1,0,0,1,11,16Z" style="fill: #26a269;"></path></g></svg>
                </span>
            @endif
        </section>
        <p>{{$tienda->provincia}}</p>
        <p>{{$tienda->descripcion}}</p>
        @if(session('usuario_tipo') === "vendedor" || session('usuario_tipo') === "admin")
            <a href="#" onclick="window.popupTienda.showModal();" class="btn-modal" aria-label="Abrir ventana de edición de tienda">Editar</a>
        @endif
        <dialog id="popupTienda" class="dialog">
            <a href="#" onclick="window.popupTienda.close();" class="btn-cerrar" aria-label="Cerrar ventana de edición de tienda">X</a>
            <form action="{{route('update_tienda', ['idTienda' => $tienda->id])}}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <input type="text" name="nombre" id="nombre_tienda" value="{{$tienda->nombre}}" placeholder="Nombre de la tienda" required>
                <select name="prov" id="prov_tienda" required>
                    <option value="A Coruña" {{($provincia ?? '') == 'A Coruña' ? 'selected' : ''}}>A Coruña</option>
                    <option value="Pontevedra" {{($provincia ?? '') == 'Pontevedra' ? 'selected' : ''}}>Pontevedra</option>
                </select>
                <textarea name="desc" id="desc_tienda" placeholder="Descripción de la tienda">{{$tienda->descripcion}}</textarea>
                <input type="file" name="icono" id="icono_tienda" accept="image/*">
                <button type="reset" class="btn-reset">Restablecer datos</button>
                <button type="submit" class="btn-submit">Actualizar tienda</button>
            </form>
            @if($tienda->icono)
                <form action="{{route('limpiar_icono_tienda', ['idTienda' => $tienda->id])}}" method="post">
                    @csrf
                    @method('PUT')
                    <button type="submit">Quitar imagen</button>
                </form>
            @endif
        </dialog>
        <ul class="tarjetas" title="tarjetas">
            @foreach($productos as $p)
                <li class="tarjeta" title="tarjeta">
                    <h2>{{$p->nombre}}</h2>
                    <p class="precio-tarjeta">{{$p->precio}} €</p>
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
                            data-tienda="{{$p->tienda_id}}"
                            data-imagen="{{$p->imagen}}">
                            Editar
                        </a>
                        <form action="{{route('delete_producto', ['idTienda' => $p->tienda_id, 'idProd' => $p->id])}}" method="post">
                            @csrf
                            @method('DELETE')
                            <button type="submit" onclick="return confirm('Seguro que quieres eliminar este producto?')">Eliminar</button>
                        </form>
                    @else
                        <form action="{{route('put_producto_carrito', ['idTienda' => $p->tienda_id, 'idProd' => $p->id])}}" method="post">
                            @csrf
                            @method('PUT')
                            <button type="submit" class="btn-add-carrito" aria-label="Añadir ${{$p->nombre}} al carrito">Añadir al carrito</button>
                        </form>
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
            <form method="post" id="formUpdateProd" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <input type="text" name="nombre" id="nombre_edit" placeholder="Nombre del producto" required>
                <!-- Campo del precio es de tipo texto para un comportamiento homogéneo entre navegadores a través del pattern,
                    inputmode para teclado núm. en móviles -->
                <input type="text" name="precio" id="precio_edit" inputmode="decimal" placeholder="Precio del producto"
                    title="Tiene que ser un número del 0.01 al 999.99, los decimales se escriben con punto y son opcionales"
                    pattern="^(0\.0*[1-9]|[1-9][0-9]{0,2}(\.[0-9]{1,2})?)$"required>
                <textarea name="desc" id="desc_edit" placeholder="Descripción del producto"></textarea>
                <input type="file" name="imagen" id="imagen_edit" accept="image/*">
                <button type="submit" class="btn-submit">Actualizar el producto</button>
            </form>
            <form method="post" id="formCleanImgProd">
                @csrf
                @method('PUT')
                <button type="submit">Quitar imagen</button>
            </form>
        </dialog>
        <dialog id="popupAdd" class="dialog">
            <a href="#" onclick="window.popupAdd.close();" class="btn-cerrar" aria-label="Cerrar ventana de añadir nuevo producto">X</a>
            <form action="{{route('add_producto', ['idTienda' => $tienda->id])}}" method="post" enctype="multipart/form-data">
                @csrf
                <input type="text" name="nombre" id="nombre_nuevo" placeholder="Nombre del producto" required>
                <input type="text" name="precio" id="precio_nuevo" inputmode="decimal" placeholder="Precio del producto"
                    title="Tiene que ser un número del 0.01 al 999.99, los decimales se escriben con punto y son opcionales"
                    pattern="^(0\.0*[1-9]|[1-9][0-9]{0,2}(\.[0-9]{1,2})?)$" inputmode="decimal" required>
                <textarea name="desc" id="desc_nuevo" placeholder="Descripción del producto"></textarea>
                <input type="file" name="imagen" id="imagen_nuevo" accept="image/*">
                <button type="submit" class="btn-submit">Añadir producto</button>
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