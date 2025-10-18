<?php

namespace App\Http\Controllers;

use App\Models\Tienda;
use Illuminate\Http\Request;

class TiendaController extends Controller
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
        return view('lista-tiendas',$data);
    }
}
