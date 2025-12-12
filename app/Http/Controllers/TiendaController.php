<?php

namespace App\Http\Controllers;

use App\Mail\SolicitudVerif;
use App\Models\Producto;
use App\Models\Tienda;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

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
        $data = [];
        $tienda = Tienda::find($idTienda);

        $validacion = Validator::make($r->all(), [
            'nombre' => 'unique:tiendas,nombre,' . $idTienda,
        ]);

        if ($validacion->fails()) {
            $data['error'] = 'No se pudo actualizar: El nombre ya existe.';

        } else {
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
        }

        $data['productos'] = Producto::where('tienda_id', $idTienda)->orderBy('nombre', 'asc')->get();
        $data['tienda'] = $tienda;
        return view('lista-productos', $data);
    }

    public function updateVerifTienda($idTienda){
        $data = [];
        $tienda = Tienda::find($idTienda);

        if ($tienda->verif == 1) {
            $tienda->verif = 0;
        } else {
            $tienda->verif = 1;
        }

        $tienda->save();

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

    public function solicitarVerifTienda($idTienda){
        $tienda = Tienda::find($idTienda);

        $msj = "<h1>LoDeSiempre</h1>";
        $msj .= "<p>La tienda " . $tienda->nombre . " ha solicitado la validación.</p>";

        $destinatario = "a25marcosag@iessanclemente.net";

        Mail::to($destinatario)->send(new SolicitudVerif($msj));

        $data = [];
        $data['productos'] = Producto::where('tienda_id', $idTienda)->orderBy('nombre', 'asc')->get();
        $data['tienda'] = $tienda;
        $data['solicitud'] = "Solicitud de verificación enviada correctamente.";
        return view('lista-productos', $data);
    }
}