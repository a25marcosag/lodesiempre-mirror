<?php

namespace App\Http\Controllers;

use App\Models\Carrito;
use App\Models\Producto;
use App\Models\Tienda;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class CarritoController extends Controller
{
    public function listarProductosCarrito(){
        $data = [];
        // $carrito = Carrito::where('usuario_id', session('usuario_id'))->first();
        // $data['productos'] = $carrito->productos()->orderBy('nombre', 'asc')->get();
        return view('lista-productos-carrito', $data);
    }

    public function mostrarJsonProductosCarrito(){
        $productos = [];

        if (session('usuario_id')) {
            $carrito = Carrito::where('usuario_id', session('usuario_id'))->first();

            $productos = $carrito->productos->map(function($prod) {
                return [
                    'id' => $prod->id,
                    'nombre' => $prod->nombre,
                    'precio' => $prod->precio,
                    'descripcion' => $prod->descripcion,
                    'imagen' => $prod->imagen,
                    'cantidad' => $prod->pivot->cantidad
                ];
            });

        } else {
            $productos = session('carrito', []);
        }

        return response()->json($productos);
    }

    public function actualizarJsonProductoCarrito(Request $r, $idProd){
        if (session('usuario_id')) {
            $carrito = Carrito::where('usuario_id', session('usuario_id'))->first();
            DB::table('carrito_producto')->where('carrito_id', $carrito->id)->where('producto_id', $idProd)->update(['cantidad' => $r->cantidad]);

        } else {
            $carrito = session('carrito', []);

            //Se le pone & al producto para operar con el original en vez de una copia
            foreach ($carrito as &$prod) {
                if ($prod['id'] == $idProd) {
                    $prod['cantidad'] = (int) $r->cantidad;
                    break;
                }
            }

            unset($prod);

            session(['carrito' => $carrito]);
        }

        return response()->json(['cantidad' => $r->cantidad]);
    }

    public function borrarJsonProductoCarrito($idProd) {
        if (session('usuario_id')) {
            $carrito = Carrito::where('usuario_id', session('usuario_id'))->first();
            DB::table('carrito_producto')->where('carrito_id', $carrito->id)->where('producto_id', $idProd)->delete();

        } else {
            $carrito = session('carrito', []);

            $carrito = array_filter($carrito, fn($prod) => $prod['id'] != $idProd);
            $carrito = array_values($carrito);

            session(['carrito' => $carrito]);
        }

        return response()->json(['ok' => true]);
    }

    public function putProductoInCarrito($idTienda, $idProd){
        $producto = Producto::find($idProd);

        if (session('usuario_id')) {
            $carrito = Carrito::where('usuario_id', session('usuario_id'))->first();

            if (!$carrito->productos()->where('producto_id', $idProd)->exists()) {
                $carrito->productos()->attach($idProd);
            }

        } else {
            $carrito = session('carrito', []);
            $existeProdEnCarrito = false;

            foreach ($carrito as $prod) {
                if ($prod['id'] == $idProd) {
                    $existeProdEnCarrito = true;
                    break;
                }
            }

            if (!$existeProdEnCarrito) {
                $carrito[] = [
                    'id' => $producto->id,
                    'nombre' => $producto->nombre,
                    'precio' => $producto->precio,
                    'descripcion' => $producto->descripcion,
                    'imagen' => $producto->imagen,
                    'cantidad' => 1
                ];
                session(['carrito' => $carrito]);
            }

        }

        $data = [];
        $data['productos'] = Producto::where('tienda_id', $idTienda)->orderBy('nombre', 'asc')->get();
        $data['tienda'] = Tienda::find($idTienda);
        return view('lista-productos', $data);
    }
}
