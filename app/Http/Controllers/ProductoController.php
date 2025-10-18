<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Models\Tienda;
use Illuminate\Http\Request;

class ProductoController extends Controller
{
    public function listarProductos($id){
        $data = [];
        $data['productos'] = Producto::where('tienda_id', $id)->orderBy('nombre', 'asc')->get();
        $data['tienda'] = Tienda::find($id);
        return view('lista-productos',$data);
    }
}
