<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Models\Tienda;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductoController
{
    public function listarProductos($idTienda){
        $data = [];
        $data['productos'] = Producto::where('tienda_id', $idTienda)->orderBy('nombre', 'asc')->get();
        $data['tienda'] = Tienda::find($idTienda);
        return view('lista-productos', $data);
    }

    public function addProducto(Request $r, $idTienda){
        $producto = new Producto();
        $producto->nombre = $r->get('nombre');
        $producto->precio = $r->get('precio');
        $producto->descripcion = $r->get('desc');
        $producto->tienda_id = $idTienda;

        if($r->hasFile('imagen')) {
            $imagen = $r->file('imagen');
            $nombreImagen = $imagen->getClientOriginalName();

            Storage::disk('public')->putFileAs('img', $imagen, $nombreImagen);

            $producto->imagen = $nombreImagen;
        }

        $producto->save();

        return $this->listarProductos($idTienda);
    }

    public function updateProducto(Request $r, $idTienda, $idProd){
        $producto = Producto::find($idProd);
        $producto->nombre = $r->get('nombre');
        $producto->precio = $r->get('precio');
        $producto->descripcion = $r->get('desc');

        if($r->hasFile('imagen')) {
            $imagen = $r->file('imagen');
            $nombreImagen = $imagen->getClientOriginalName();

            Storage::disk('public')->putFileAs('img', $imagen, $nombreImagen);

            $producto->imagen = $nombreImagen;
        }

        $producto->save();

        return $this->listarProductos($idTienda);
    }

    public function cleanImagenFromProducto($idTienda, $idProd){
        $producto = Producto::find($idProd);
        $producto->imagen = null;

        $producto->save();

        $data = [];
        $data['productos'] = Producto::where('tienda_id', $idTienda)->orderBy('nombre', 'asc')->get();
        $tienda = Tienda::find($idTienda);
        $data['tienda'] = $tienda;
        return view('lista-productos', $data);
    }

    public function deleteProducto($idTienda, $idProd){
        $producto = Producto::find($idProd);
        $producto->delete();

        return $this->listarProductos($idTienda);
    }
}
