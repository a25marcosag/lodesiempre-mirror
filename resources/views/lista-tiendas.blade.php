<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{asset('css/main.css')}}">
    <title>LoDeSiempre</title>
</head>
<body>
    <h1>LoDeSiempre</h1>
    <a href="{{route('listar_usuarios')}}">Usuarios</a><br><br>
    <a href="">Carrito</a><br><br>
    <form action="{{route('listar_tiendas')}}" method="get">
        @csrf
        <input type="text" name="busqueda" id="busqueda" value="{{$busqueda ?? ''}}" placeholder="Buscar tienda...">
        <select name="provincia" id="provincia">
            <option value="Todas" {{($provincia ?? '') == 'Todas' ? 'selected' : ''}}>Todas las provincias</option>
            <option value="A Coruña" {{($provincia ?? '') == 'A Coruña' ? 'selected' : ''}}>A Coruña</option>
            <option value="Pontevedra" {{($provincia ?? '') == 'Pontevedra' ? 'selected' : ''}}>Pontevedra</option>
        </select>
        <button type="submit">Buscar</button>
    </form><br>
    <a href="">Iniciar sesión</a>
    <a href="{{route('registro_usuario')}}">Registrarse</a><br><br>
    @foreach($tiendas as $t)
        @if($t->verif)
            <svg fill="#3d3846" viewBox="0 0 24.00 24.00" id="check-circle" data-name="Flat Color" xmlns="http://www.w3.org/2000/svg" class="icon flat-color" stroke="#3d3846" stroke-width="0.528"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round" stroke="#CCCCCC" stroke-width="0.192"></g><g id="SVGRepo_iconCarrier"><circle id="primary" cx="12" cy="12" r="10" style="fill: #8ff0a4;"></circle><path id="secondary" d="M11,16a1,1,0,0,1-.71-.29l-3-3a1,1,0,1,1,1.42-1.42L11,13.59l4.29-4.3a1,1,0,0,1,1.42,1.42l-5,5A1,1,0,0,1,11,16Z" style="fill: #26a269;"></path></g></svg>
        @endif
        @if($t->icono)
            <img src="{{asset('storage/img/' . $t->icono)}}" alt="{{$t->nombre}}">
        @endif
        <a href="{{route('listar_productos', $t->id)}}">{{$t->nombre}}</a><br><br>
    @endforeach
</body>
</html>