<?php

namespace App\Http\Controllers;

use App\Models\Tienda;
use App\Models\Producto;
use App\Models\Usuario;
use Illuminate\Http\Request;

class UsuarioController extends Controller
{
    public function listarUsuarios(){
        $vista = 'lista-tiendas';
        $data = ['tiendas' => Tienda::all()];

        if (session('usuario_tipo') === 'admin') {
            $vista = 'lista-usuarios';
            $data = ['usuarios' => Usuario::all()];
        }

        return view($vista, $data);
    }

    public function inicioSesionUsuario(){
        return view('login-usuario');
    }

    public function iniciarSesionUsuario(Request $r){
        $vista = 'lista-tiendas';
        $data = ['tiendas' => Tienda::all()];

        $usuario = Usuario::where('nombre', $r->get('nombre'))->where('contrasena', $r->get('password'))->where('email', $r->get('correo'))->first();

        if ($usuario) {
            session(['usuario_id' => $usuario->id, 'usuario_nombre' => $usuario->nombre, 'usuario_tipo' => $usuario->tipo]);

            if (session('usuario_tipo') === 'vendedor') {
                $vista = 'lista-productos';
                $tienda = Tienda::where('usuario_id', session('usuario_id'))->first();
                $data = ['productos' => Producto::where('tienda_id', $tienda->id)->orderBy('nombre', 'asc')->get(),
                 'tienda' => $tienda];
            }
        } else {
            $vista = 'login-usuario';
            $data = ['error' => 'No se ha encontrado ese usuario. Inténtelo de nuevo.'];
        }

        return view($vista, $data);
    }

    public function logoutUsuario(){
        session()->flush();

        return view('lista-tiendas', ['tiendas' => Tienda::query()->orderBy('verif', 'desc')->orderBy('nombre', 'asc')->get()]);
    }

    public function registroUsuario(){
        return view('registro-usuario');
    }

    public function addUsuario(Request $r, $desdeRegistro = false){
        $usuario = new Usuario();
        $usuario->nombre = $r->get('nombre');
        $usuario->contrasena = $r->get('password');
        $usuario->tipo = $r->get('tipo');
        $usuario->email = $r->get('correo');

        $usuario->save();

        if($desdeRegistro) {
            return $this->iniciarSesionUsuario($r);
        } else {
            return $this->listarUsuarios();
        }
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
