<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{csrf_token()}}">
    <link rel="icon" {{asset('favicon.ico')}}>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
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
    <main class="main animate__animated animate__fadeIn">
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
            <form class="form-comprar" action="{{session('usuario_id') ? route('procesar_compra') : route('inicio_sesion_usuario')}}" method="post">
                @csrf
                @method('GET')
                <p>
                    <label for="envio">Método de envío: </label>
                    <select name="envio" id="envio" required>
                        <option value="recogida en tienda">Recogida en tienda</option>
                        <option value="entrega a domicilio">Entrega a domicilio</option>
                    </select>
                </p>
                <button type="submit" class="btn-comprar"
                    @if( session('usuario_id') === null )
                        onclick="return confirm('Para realizar la compra es necesario iniciar sesión.')"
                    @else
                        onclick="return confirm('¿Confirmar compra?')"
                    @endif
                    >
                    Comprar
                </button>
            </form>
        @endif
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