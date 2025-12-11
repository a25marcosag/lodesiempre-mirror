<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" {{asset('favicon.ico')}}>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    <link rel="stylesheet" href="{{asset('css/main.css')}}">
    <style>
        :root {
            --gradiente-fondo: linear-gradient(
                to bottom left,
                var(--color-principal) 0%,
                var(--color-principal) 30%,
                rgb(168, 212, 241) 50%,
                var(--color-principal) 70%,
                var(--color-principal) 100%
            );
        }
    </style>
    <script src="{{asset('js/updateProdModal.js')}}" defer></script>
    <title>LoDeSiempre</title>
</head>
<body>
    <header>
        <h1>LoDeSiempre</h1>
        <a class="logo"
        @if(session('usuario_tipo') !== "vendedor")
            href="{{route('listar_tiendas')}}"
        @endif
        >
            <img src="{{asset('storage/img/logo.png')}}" alt="LoDeSiempre">
        </a>
        <form action="{{route('listar_productos', $tienda->id)}}" method="get" class="form-busq">
            @csrf
            <input type="text" name="busqueda" id="busqueda" value="{{$busqueda ?? ''}}" placeholder="Buscar producto...">
            <select name="orden" id="orden">
                <option value="Alfabéticamente" {{($orden ?? '') == 'Alfabéticamente' ? 'selected' : ''}}>Alfabéticamente</option>
                <option value="Precio (asc.)" {{($orden ?? '') == 'Precio (asc.)' ? 'selected' : ''}}>Precio (asc.)</option>
                <option value="Precio (desc.)" {{($orden ?? '') == 'Precio (desc.)' ? 'selected' : ''}}>Precio (desc.)</option>
            </select>
            <button type="submit">
                <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M11 6C13.7614 6 16 8.23858 16 11M16.6588 16.6549L21 21M19 11C19 15.4183 15.4183 19 11 19C6.58172 19 3 15.4183 3 11C3 6.58172 6.58172 3 11 3C15.4183 3 19 6.58172 19 11Z" stroke="rgb(67, 122, 97)" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path> </g></svg>
            </button>
        </form>
        <nav>
            <ul class="menu">
                <li>
                    @if(session('usuario_tipo') === "admin")
                        <a href="{{route('listar_usuarios')}}" aria-label="Ir a panel de usuarios">Usuarios</a>
                    @elseif(session('usuario_tipo') !== "vendedor")
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
    <main class="main animate__animated animate__fadeIn">
        @if($tienda->icono)
            @php
                $nombreImagenTienda = asset('storage/img/' . $tienda->icono);
            @endphp
            <span class="imagen imagen-principal" style="background-image: url({{$nombreImagenTienda}});"></span>
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
            @if(session('usuario_tipo') === "vendedor")
                <form class="form-verif" action="{{route('update_verif_tienda', ['idTienda' => $tienda->id])}}" method="post">
                    @csrf
                    @method('PUT')
                    <button type="submit" class="btn-submit btn-verif"
                    @if($tienda->verif)
                        onclick="return confirm('¿Seguro que quieres cancelar tu verificación?')">
                        Cancelar
                    @else
                        onclick="return confirm('¿Seguro que quieres apuntarte?')">
                        Apuntarse a la
                    @endif
                    verificación</button>
                </form>
            @endif
        @endif
        <dialog id="popupTienda" class="dialog">
            <a href="#" onclick="window.popupTienda.close();" class="btn-cerrar" aria-label="Cerrar ventana de edición de tienda">X</a>
            <form action="{{route('update_tienda', ['idTienda' => $tienda->id])}}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <input type="text" name="nombre" id="nombre_tienda" value="{{$tienda->nombre}}" placeholder="Nombre de la tienda"  maxlength="30" required>
                <select name="prov" id="prov_tienda" required>
                    <option value="A Coruña" {{$tienda->provincia == 'A Coruña' ? 'selected' : ''}}>A Coruña</option>
                    <option value="Pontevedra" {{$tienda->provincia == 'Pontevedra' ? 'selected' : ''}}>Pontevedra</option>
                </select>
                <textarea name="desc" id="desc_tienda" placeholder="Descripción de la tienda"  maxlength="100">{{$tienda->descripcion}}</textarea>
                <p class="edicion-img">
                    <label class="file-label">
                        Añadir imagen
                        <input type="file" name="icono" id="icono_tienda" accept="image/*">
                    </label>
                    @php
                        $nombreImagenTienda = asset('storage/img/' . $tienda->icono);
                    @endphp
                    <span class="imagen" style="background-image: url({{$nombreImagenTienda}});"></span>
                    @if($tienda->icono)
                        <button type="submit" form="formCleanImgTienda">Quitar imagen</button>
                    @endif
                </p>
                <button type="reset" class="btn-reset">Restablecer datos</button>
                <button type="submit" class="btn-submit">Actualizar tienda</button>
            </form>
            @if($tienda->icono)
                <form action="{{route('limpiar_icono_tienda', ['idTienda' => $tienda->id])}}" method="post" id="formCleanImgTienda">
                    @csrf
                    @method('PUT')
                </form>
            @endif
        </dialog>
        <ul class="tarjetas" title="tarjetas">
            @foreach($productos as $p)
                <li class="tarjeta" title="tarjeta">
                    <p>
                        @if(session('usuario_tipo') === "vendedor" || session('usuario_tipo') === "admin")
                            <form action="{{route('delete_producto', ['idTienda' => $p->tienda_id, 'idProd' => $p->id])}}" method="post" class="btn-borrar">
                                @csrf
                                @method('DELETE')
                                <button type="submit" onclick="return confirm('¿Seguro que quieres eliminar este producto?')" aria-label="Borrar {{$p->nombre}} del carrito">
                                    <svg class="bin-closed" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 512 512" xml:space="preserve" fill="#000000"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <rect x="104.923" y="191.732" style="fill:#f08080;" width="302.163" height="304.524"></rect> <g> <path style="fill:#556b2f;" d="M180.066,413.377c-8.69,0-15.738-7.047-15.738-15.738V296.918c0-8.69,7.047-15.738,15.738-15.738 s15.738,7.047,15.738,15.738v100.721C195.803,406.329,188.756,413.377,180.066,413.377z"></path> <path style="fill:#556b2f;" d="M256,413.377c-8.69,0-15.738-7.047-15.738-15.738V296.918c0-8.69,7.047-15.738,15.738-15.738 c8.69,0,15.738,7.047,15.738,15.738v100.721C271.738,406.329,264.69,413.377,256,413.377z"></path> <path style="fill:#556b2f;" d="M331.934,413.377c-8.69,0-15.738-7.047-15.738-15.738V296.918c0-8.69,7.047-15.738,15.738-15.738 s15.738,7.047,15.738,15.738v100.721C347.672,406.329,340.625,413.377,331.934,413.377z"></path> <path style="fill:#556b2f;" d="M395.935,73.706c-8.69,0-15.738,7.047-15.738,15.738s7.047,15.738,15.738,15.738 c18.295,0,33.18,14.885,33.18,33.18v37.64H407.08H104.92H82.886v-37.64c0-18.295,14.885-33.18,33.18-33.18h163.541 c8.69,0,15.738-7.047,15.738-15.738s-7.047-15.738-15.738-15.738h-92.852v-42.23h138.492v57.968c0,8.69,7.047,15.738,15.738,15.738 s15.738-7.047,15.738-15.738V15.738c0-8.69-7.047-15.738-15.738-15.738H171.017c-8.69,0-15.738,7.047-15.738,15.738v57.968h-39.214 c-35.651,0-64.655,29.005-64.655,64.655v53.377c0,8.69,7.047,15.738,15.738,15.738h22.034v288.786 c0,8.69,7.047,15.738,15.738,15.738h302.16c8.69,0,15.738-7.047,15.738-15.738V207.476h22.034c8.69,0,15.738-7.047,15.738-15.738 v-53.377C460.59,102.71,431.585,73.706,395.935,73.706z M391.342,480.525H120.658V207.476h270.685V480.525z"></path> </g> </g></svg>
                                    <svg class="bin-open" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 512 512" xml:space="preserve" fill="#000000"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <rect x="114.402" y="220.724" style="fill:rgb(67, 122, 97);" width="274.813" height="276.96"></rect> <g> <path style="fill:#556b2f;" d="M182.746,422.305c-7.905,0-14.313-6.409-14.313-14.313v-91.604c0-7.904,6.408-14.313,14.313-14.313 c7.905,0,14.313,6.409,14.313,14.313v91.604C197.06,415.895,190.652,422.305,182.746,422.305z"></path> <path style="fill:#556b2f;" d="M251.808,422.305c-7.905,0-14.313-6.409-14.313-14.313v-91.604c0-7.904,6.408-14.313,14.313-14.313 c7.905,0,14.313,6.409,14.313,14.313v91.604C266.121,415.895,259.713,422.305,251.808,422.305z"></path> <path style="fill:#556b2f;" d="M320.869,422.305c-7.905,0-14.313-6.409-14.313-14.313v-91.604c0-7.904,6.408-14.313,14.313-14.313 c7.905,0,14.313,6.409,14.313,14.313v91.604C335.182,415.895,328.774,422.305,320.869,422.305z"></path> <path style="fill:#556b2f;" d="M434.571,135.961c-8.435-13.251-21.524-22.423-36.856-25.828 c-7.712-1.722-15.362,3.152-17.076,10.869c-1.713,7.718,3.153,15.361,10.869,17.076c7.869,1.749,14.585,6.455,18.913,13.255 c4.328,6.8,5.75,14.879,4.002,22.748l-7.423,33.418L99.603,139.224l7.423-33.42c3.608-16.243,19.754-26.519,36.002-22.917 l145.2,32.249c7.713,1.713,15.361-3.153,17.076-10.869c1.713-7.718-3.153-15.361-10.869-17.076l-82.44-18.309l8.327-37.493 l122.96,27.308l-11.431,51.467c-1.713,7.718,3.153,15.361,10.869,17.076c1.045,0.232,2.088,0.344,3.116,0.344 c6.563,0,12.478-4.542,13.96-11.213l14.534-65.44c0.823-3.706,0.14-7.587-1.898-10.789c-2.038-3.202-5.266-5.463-8.972-6.286 L212.555,0.342c-7.713-1.709-15.362,3.152-17.076,10.869l-11.43,51.466l-34.815-7.732C117.579,47.909,86.11,67.948,79.079,99.6 l-10.526,47.391c-1.713,7.718,3.153,15.361,10.869,17.076l190.666,42.347H114.402c-7.905,0-14.313,6.409-14.313,14.313v276.96 c0,7.904,6.408,14.313,14.313,14.313h274.81c7.905,0,14.313-6.409,14.313-14.313V236.049l11.243,2.498 c1.026,0.229,2.067,0.341,3.103,0.341c2.701,0,5.37-0.764,7.686-2.239c3.202-2.038,5.463-5.266,6.288-8.972l10.526-47.391 C445.776,164.954,443.006,149.212,434.571,135.961z M374.9,483.374H128.716V235.04H374.9V483.374z"></path> </g> </g></svg>
                                </button>
                            </form>
                        @endif
                        <h2>{{$p->nombre}}</h2>
                    </p>
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
                            data-imagen="{{$p->imagen}}"
                            data-ruta-quitar-img="{{route('limpiar_imagen_producto', ['idTienda' => 'ID_TIENDA', 'idProd' => 'ID_PROD'])}}">
                            Editar
                        </a>
                    @else
                        <form action="{{route('put_producto_carrito', ['idTienda' => $p->tienda_id, 'idProd' => $p->id])}}" method="post">
                            @csrf
                            @method('PUT')
                            <button type="submit" class="btn-add-carrito" aria-label="Añadir {{$p->nombre}} al carrito">Añadir al carrito</button>
                        </form>
                    @endif
                </li>
            @endforeach
            @if(session('usuario_tipo') === "vendedor" || session('usuario_tipo') === "admin")
                <li class="tarjeta" title="tarjeta">
                    <a href="#" onclick="window.popupAdd.showModal();" class="btn-modal btn-mas" aria-label="Abrir ventana de añadir nuevo producto">+</a>
                </li>
            @endif
        </ul>
        <dialog id="popupUpdate" class="dialog">
            <a href="#" onclick="window.popupUpdate.close();" class="btn-cerrar" aria-label="Cerrar ventana de edición del producto">X</a>
            <form method="post" id="formUpdateProd" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <input type="text" name="nombre" id="nombre_edit" placeholder="Nombre del producto" maxlength="30" required>
                <!-- Campo del precio es de tipo texto para un comportamiento homogéneo entre navegadores a través del pattern,
                    inputmode para teclado núm. en móviles -->
                <input type="text" name="precio" id="precio_edit" inputmode="decimal" placeholder="Precio del producto"
                    title="Tiene que ser un número del 0.01 al 999.99, los decimales se escriben con punto y son opcionales"
                    pattern="^(0\.(0[1-9]|[1-9][0-9]?)|[1-9][0-9]{0,2}(\.[0-9]{1,2})?)$" required>
                <textarea name="desc" id="desc_edit" placeholder="Descripción del producto" maxlength="100"></textarea>
                <p class="edicion-img">
                    <label class="file-label">
                        Añadir imagen
                        <input type="file" name="imagen" id="imagen_edit" accept="image/*">
                    </label>
                    <span class="imagen"></span>
                    <button type="submit" form="formCleanImgProd" class="btn-quitar-img-prod">Quitar imagen</button>
                </p>
                <button type="submit" class="btn-submit">Actualizar el producto</button>
            </form>
            <form method="post" id="formCleanImgProd">
                @csrf
                @method('PUT')
            </form>
        </dialog>
        <dialog id="popupAdd" class="dialog">
            <a href="#" onclick="window.popupAdd.close();" class="btn-cerrar" aria-label="Cerrar ventana de añadir nuevo producto">X</a>
            <form action="{{route('add_producto', ['idTienda' => $tienda->id])}}" method="post" enctype="multipart/form-data">
                @csrf
                <input type="text" name="nombre" id="nombre_nuevo" placeholder="Nombre del producto" maxlength="30" required>
                <input type="text" name="precio" id="precio_nuevo" inputmode="decimal" placeholder="Precio del producto"
                    title="Tiene que ser un número del 0.01 al 999.99, los decimales se escriben con punto y son opcionales"
                    pattern="^(0\.(0[1-9]|[1-9][0-9]?)|[1-9][0-9]{0,2}(\.[0-9]{1,2})?)$" inputmode="decimal" required>
                <textarea name="desc" id="desc_nuevo" placeholder="Descripción del producto" maxlength="100"></textarea>
                <p class="edicion-img">
                    <label class="file-label">
                        Añadir imagen
                        <input type="file" name="imagen" id="imagen_nuevo" accept="image/*">
                    </label>
                    <span class="imagen"></span>
                </p>
                <button type="submit" class="btn-submit">Añadir producto</button>
            </form>
        </dialog>
        <dialog id="popupAviso" class="dialog">
            <a href="#" onclick="window.popupAviso.close();" class="btn-cerrar" aria-label="Cerrar ventana del aviso legal">X</a>
            <h2>Aviso legal y política de privacidad</h2>
            <p>
                Los usuarios aceptan las condiciones generales y política de privacidad
                de forma expresa al registrarse. Otorgan consentimiento para
                emplear los datos exclusivamente en la respuesta a las consultas y
                mantenerse informados de los servicios de LoDeSiempre. Los datos
                son tratados de forma leal y lícita, no se utilizan con finalidades
                incompatibles con aquellas para las que han sido solicitados. Los datos
                no se almacenan ni se comparten con terceros ajenos al servicio prestado,
                salvo obligación legal. Una vez se hayan empleado para la finalidad para
                la que se han solicitado o durante el tiempo que disponga la ley, se
                destruirá cualquier soporte o documento teniendo en cuenta las características
                de los servicios contratados. La destrucción de la información se realizará
                sin necesidad de emitir comunicación formal o certificado alguno en el
                que se ponga de manifiesto que la misma ha sido llevada a cabo. Este
                sitio web no utiliza cookies ni servicios de análisis. Está alojado en
                Render que puede recopilar algunos datos técnicos mínimos (como la
                dirección IP o navegador web) por motivos de seguridad y rendimiento.
                LoDeSiempre no tiene acceso a estos datos. Podrá ejercer los
                derechos de acceso, rectificación, supresión, oposición y limitación
                dirigiéndose a LoDeSiempre mediante escrito remitido a
                <a href="mailto:a25marcosag@iessanclemente.net">a25marcosag@iessanclemente.net</a>,
                indicando en la línea de asunto el derecho que desea ejercer.
            </p>
            <p>Responsable del tratamiento: Marcos Asensi Goyanes</p>
            <p>Nombre comercial: LoDeSiempre</p>
            <p>Dirección: Rúa da Estrada 33, 2°G 36004 Pontevedra (Pontevedra)</p>
            <p>NIF: 39495006G</p>
            <p>
              Dirección de correo para el ejercicio de los derechos:
              <a href="mailto:a25marcosag@iessanclemente.net">a25marcosag@iessanclemente.net</a>
            </p>
        </dialog>
    </main>
    <footer>
        <p>&copy; 2025 Marcos Asensi Goyanes</p>
        <a href="#" onclick="window.popupAviso.showModal();" aria-label="Abrir ventana del aviso legal">Aviso legal y política de privacidad</a>
        @if(session('usuario_id'))
            <form action="{{route('delete_usuario', ['id' => session('usuario_id')])}}" method="post">
                @csrf
                @method('DELETE')
                <button type="submit" onclick="return confirm('¿Seguro que quieres eliminar tu cuenta permanentemente?')">Borrar mi cuenta</button>
            </form>
        @endif
    </footer>
    @if(isset($error))
        <script>
            alert("{{$error}}");
        </script>
    @endif
</body>
</html>