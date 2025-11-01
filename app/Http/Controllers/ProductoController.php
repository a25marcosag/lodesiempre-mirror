<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Models\Tienda;
use Illuminate\Http\Request;

class ProductoController extends Controller
{
    public function listarProductos($idTienda){
        $data = [];
        $data['productos'] = Producto::where('tienda_id', $idTienda)->orderBy('nombre', 'asc')->get();
        $data['tienda'] = Tienda::find($idTienda);
        return view('lista-productos',$data);
    }

    public function addProducto(Request $r, $idTienda){
        $producto = new Producto();
        $producto->nombre = $r->get('nombre');
        $producto->precio = $r->get('precio');
        $producto->descripcion = $r->get('desc');
        $producto->imagen = $r->get('imagen');
        $producto->tienda_id = $idTienda;

        $producto->save();

        return $this->listarProductos($idTienda);
    }

    public function updateProducto(Request $r, $idTienda, $idProd){
        $producto = Producto::find($idProd);
        $producto->nombre = $r->get('nombre');
        $producto->precio = $r->get('precio');
        $producto->descripcion = $r->get('desc');
        $producto->imagen = $r->get('imagen');

        $producto->save();

        return $this->listarProductos($idTienda);
    }

    public function deleteProducto($idTienda, $idProd){
        $producto = Producto::find($idProd);
        $producto->delete();

        return $this->listarProductos($idTienda);
    }
}
