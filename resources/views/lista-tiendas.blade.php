<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="{{asset('favicon.ico')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    <link rel="stylesheet" href="{{asset('css/main.css')}}">
    <title>LoDeSiempre</title>
</head>
<body>
    <header>
        <h1>LoDeSiempre</h1>
        <a class="logo" href="{{route('listar_tiendas')}}"><img src="{{asset('storage/img/logo.png')}}" alt="LoDeSiempre"></a>
        <form action="{{route('listar_tiendas')}}" method="get" class="form-busq">
            @csrf
            <input type="text" name="busqueda" id="busqueda" value="{{$busqueda ?? ''}}" placeholder="Buscar tienda...">
            <select name="provincia" id="provincia">
                <option value="Todas" {{($provincia ?? '') == 'Todas' ? 'selected' : ''}}>Todas las provincias</option>
                <option value="A Coruña" {{($provincia ?? '') == 'A Coruña' ? 'selected' : ''}}>A Coruña</option>
                <option value="Pontevedra" {{($provincia ?? '') == 'Pontevedra' ? 'selected' : ''}}>Pontevedra</option>
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
        <ul class="tarjetas" title="tarjetas">
            @foreach($tiendas as $t)
                <a href="{{route('listar_productos', $t->id)}}" aria-label="Ir a la tienda {{$t->nombre}}"><li class="tarjeta" title="tarjeta">
                    @if($t->icono)
                        @php
                            $nombreImagen = asset('storage/img/' . $t->icono);
                        @endphp
                        <span class="imagen" style="background-image: url({{$nombreImagen}});"></span>
                    @endif
                    <section class="tarjeta-titulo">
                        <h2>{{$t->nombre}}</h2>
                        @if($t->verif)
                            <span class="verif">
                                <svg fill="#3d3846" viewBox="0 0 24.00 24.00" id="check-circle" data-name="Flat Color" xmlns="http://www.w3.org/2000/svg" class="icon flat-color" stroke="#3d3846" stroke-width="0.528"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round" stroke="#CCCCCC" stroke-width="0.192"></g><g id="SVGRepo_iconCarrier"><circle id="primary" cx="12" cy="12" r="10" style="fill: #8ff0a4;"></circle><path id="secondary" d="M11,16a1,1,0,0,1-.71-.29l-3-3a1,1,0,1,1,1.42-1.42L11,13.59l4.29-4.3a1,1,0,0,1,1.42,1.42l-5,5A1,1,0,0,1,11,16Z" style="fill: #26a269;"></path></g></svg>
                            </span>
                        @endif
                    </section>
                </li></a>
            @endforeach
        </ul>
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
                <button type="submit" onclick="return confirm('Seguro que quieres eliminar tu cuenta permanentemente?')">Borrar mi cuenta</button>
            </form>
        @endif
    </footer>
</body>
</html>