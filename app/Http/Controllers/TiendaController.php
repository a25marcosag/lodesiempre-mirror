<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Models\Tienda;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TiendaController
{
    public function listarTiendas(Request $r){
        $busqueda = $r->get('busqueda');
        $provincia = $r->get('provincia');

        // Nota: Tienda::all() == Tienda::query()->get()
        $tiendas = Tienda::query()->orderBy('verif', 'desc')->orderBy('nombre', 'asc');

        if($busqueda) {
            $tiendas = $tiendas->where('nombre', 'LIKE', "%{$busqueda}%");
        }

        if($provincia && $provincia !== 'Todas') {
            $tiendas = $tiendas->where('provincia', $provincia);
        }

        $data = [];
        $data['tiendas'] = $tiendas->get();
        $data['busqueda'] = $busqueda;
        $data['provincia'] = $provincia;
        return view('lista-tiendas', $data);
    }

    public function updateTienda(Request $r, $idTienda){
        $tienda = Tienda::find($idTienda);
        $tienda->nombre = $r->get('nombre');
        $tienda->provincia = $r->get('prov');
        $tienda->descripcion = $r->get('desc');

        if($r->hasFile('icono')) {
            $icono = $r->file('icono');
            $nombreIcono = $icono->getClientOriginalName();

            Storage::disk('public')->putFileAs('img', $icono, $nombreIcono);

            $tienda->icono = $nombreIcono;
        }

        $tienda->save();

        $data = [];
        $data['productos'] = Producto::where('tienda_id', $idTienda)->orderBy('nombre', 'asc')->get();
        $data['tienda'] = $tienda;
        return view('lista-productos', $data);
    }

    public function cleanIconoFromTienda($idTienda){
        $tienda = Tienda::find($idTienda);
        $tienda->icono = null;

        $tienda->save();

        $data = [];
        $data['productos'] = Producto::where('tienda_id', $idTienda)->orderBy('nombre', 'asc')->get();
        $data['tienda'] = $tienda;
        return view('lista-productos', $data);
    }
}