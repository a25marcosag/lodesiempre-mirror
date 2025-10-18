<?php

namespace App\Http\Controllers;

use App\Models\Tienda;
use App\Models\Usuario;
use Illuminate\Http\Request;

class UsuarioController extends Controller
{
    public function listarUsuarios(){
        $data = [];
        $data['usuarios'] = Usuario::all();
        return view('lista-usuarios',$data);
    }

    public function registroUsuario(){
        return view('registro-usuario');
    }

    public function addUsuario(Request $r){
        $usuario = new Usuario();
        $usuario->nombre = $r->get('nombre');
        $usuario->contrasena = $r->get('password');
        $usuario->tipo = $r->get('tipo');
        $usuario->email = $r->get('correo');

        $usuario->save();

        return view('lista-tiendas', ['tiendas' =>Tienda::all()]);
    }

    public function updateUsuario(Request $r, $id){
        $usuario = Usuario::find($id);
        $usuario->nombre = $r->get('nombre');
        $usuario->email = $r->get('correo');

        $usuario->save();

        return $this->listarUsuarios();
    }

    public function deleteUsuario($id){
        $usuario = Usuario::find($id);
        $usuario->delete();

        return $this->listarUsuarios();
    }
}
