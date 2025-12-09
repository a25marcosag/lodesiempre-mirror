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
                <li><a href="{{route('inicio_sesion_usuario')}}" aria-label="Ir a inicio de sesión">Iniciar sesión</a></li>
            </ul>
        </nav>
    </header>
    <main class="main animate__animated animate__slideInUp">
        <form class="form-session" action="{{route('add_usuario_registro')}}" method="post">
            @csrf
            <label for="nombre">Nombre</label>
            <input type="text" name="nombre" id="nombre" required>
            <label for="contrasena">Contraseña</label>
            <input type="password" name="contrasena" id="contrasena" required>
            <label for="contrasena_confirmation">Confirmación de contraseña</label>
            <input type="password" name="contrasena_confirmation" id="contrasena_confirmation" required>
            <label for="tipos">Elegir tipo de cuenta</label>
            <select name="tipo" id="tipo">
                <option value="consumidor">Cliente</option>
                <option value="vendedor">Tienda</option>
            </select>
            <label for="correo">Email</label>
            <input type="email" name="correo" id="correo" required>
            <button type="submit" class="btn-login">Registrarse</button>
        </form>
        @if($errors->any())
            <p>{{$errors->first()}}</p>
        @endif
        @if(isset($error))
            <p>{{$error}}</p>
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
    </footer>
</body>
</html>