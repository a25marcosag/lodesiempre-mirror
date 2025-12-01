<?php

namespace App\Http\Controllers;

use App\Mail\ResumenCompra;
use App\Models\Carrito;
use App\Models\Producto;
use App\Models\Tienda;
use App\Models\Usuario;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;


class CarritoController
{
    public function listarProductosCarrito(){
        $data = [];
        // $carrito = Carrito::where('usuario_id', session('usuario_id'))->first();
        // $data['productos'] = $carrito->productos()->orderBy('nombre', 'asc')->get();
        return view('lista-productos-carrito', $data);
    }

    public function procesarCompra(){
        $carrito = Carrito::where('usuario_id', session('usuario_id'))->first();

        $total = $carrito->productos->sum(function($prod) {
            return $prod->precio * $prod->pivot->cantidad;
        });

        $msj = "<h1>LoDeSiempre</h1>";
        $msj .= "<h2>Extracto de compra de " . session('usuario_nombre') . "</h2>";
        $msj .= "<table border='1'>";
        $msj .= "<tr><th>Producto</th><th>Cantidad</th><th>Precio Ud.</th><th>Subtotal</th></tr>";

        foreach ($carrito->productos as $prod) {
            $subtotal = $prod->precio * $prod->pivot->cantidad;
            $msj .= "<tr>
                <td>{$prod->nombre}</td>
                <td>{$prod->pivot->cantidad} uds.</td>
                <td>{$prod->precio} €</td>
                <td>{$subtotal} €</td>
                </tr>";
        }

        $msj .= "</table>";
        $msj .= "<p><strong>Total de compra: {$total} €</strong></p>";

        // $usuario = Usuario::find(session('usuario_id'));
        // $destinatario = "{{$usuario->email}}"
        $destinatario = "a25marcosag@iessanclemente.net";

        Mail::to($destinatario)->send(new ResumenCompra($msj));

        DB::table('carrito_producto')->where('carrito_id', $carrito->id)->delete();

        session()->flash('success', 'Compra realizada con éxito. Mensaje de confirmación enviado al correo.');

        return $this->listarProductosCarrito();
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

    public function borrarJsonAllProductosCarrito() {
        if (session('usuario_id')) {
            $carrito = Carrito::where('usuario_id', session('usuario_id'))->first();
            DB::table('carrito_producto')->where('carrito_id', $carrito->id)->delete();

        } else {
            session(['carrito' => []]);

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
