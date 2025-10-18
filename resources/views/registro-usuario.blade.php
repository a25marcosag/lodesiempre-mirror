<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LoDeSiempre</title>
</head>
<body>
    <h1>LoDeSiempre</h1>
    <form action="{{route('add_usuario')}}" method="post">
        @csrf
        <label for="nombre">Nombre</label>
        <input type="text" name="nombre" id="nombre" required>
        <label for="password">Contraseña</label>
        <input type="text" name="password" id="password" required>
        <label for="tipos">Elegir tipo de cuenta</label>
        <select name="tipo" id="tipo">
            <option value="consumidor">Cliente</option>
            <option value="vendedor">Tienda</option>
        </select>
        <label for="correo">Email</label>
        <input type="email" name="correo" id="correo" required><br><br>
        <button type="submit">Registrarse</button>
    </form>
</body>
</html>