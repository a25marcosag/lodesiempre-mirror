<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LoDeSiempre</title>
</head>
<body>
    <h1>LoDeSiempre</h1>
    @foreach($usuarios as $u)
        <form action="{{route('delete_usuario', ['id' => $u->id])}}" method="post">
            @csrf
            @method('DELETE')
            <button type="submit" onclick="return confirm('Seguro que quieres eliminar a {{$u->nombre}}?')">X</button>
        </form>
        <form action="{{route('update_usuario', ['id' => $u->id])}}" method="post">
            @csrf
            @method('PUT')
            <label for="nombre">Nombre</label>
            <input type="text" name="nombre" id="nombre_{{$u->id}}" value="{{$u->nombre}}">
            <p>Contraseña {{$u->contrasena}}</p>
            <p>Tipo {{$u->tipo}}</p>
            <label for="correo">Email</label>
            <input type="email" name="correo" id="correo_{{$u->id}}" value="{{$u->email}}"><br><br>
            <button type="submit">Actualizar</button><br><br><br>
        </form>
    @endforeach
</body>
</html>