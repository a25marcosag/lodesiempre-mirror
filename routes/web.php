<?php

use App\Http\Controllers\CarritoController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\TiendaController;
use App\Http\Controllers\UsuarioController;
use Illuminate\Support\Facades\Route;

Route::get('/',[TiendaController::class, 'listarTiendas'])->name('listar_tiendas');
Route::put('tienda/actualizar/{idTienda}',[TiendaController::class, 'updateTienda'])->name('update_tienda');
Route::put('tienda/limpiar/icono/{idTienda}',[TiendaController::class, 'cleanIconoFromTienda'])->name('limpiar_icono_tienda');

Route::get('producto/listar/{idTienda}',[ProductoController::class, 'listarProductos'])->name('listar_productos');
Route::post('producto/add/{idTienda}',[ProductoController::class, 'addProducto'])->name('add_producto');
Route::put('producto/actualizar/{idTienda}/{idProd}',[ProductoController::class, 'updateProducto'])->name('update_producto');
Route::put('producto/limpiar/imagen/{idTienda}/{idProd}',[ProductoController::class, 'cleanImagenFromProducto'])->name('limpiar_imagen_producto');
Route::delete('producto/eliminar/{idTienda}/{idProd}',[ProductoController::class, 'deleteProducto'])->name('delete_producto');

Route::get('carrito/listar',[CarritoController::class, 'listarProductosCarrito'])->name('listar_productos_carrito');
Route::put('carrito/add/{idTienda}/{idProd}',[CarritoController::class, 'putProductoInCarrito'])->name('put_producto_carrito');
Route::get('carrito/listar/json',[CarritoController::class, 'mostrarJsonProductosCarrito']);
Route::patch('carrito/listar/json/actualizar/{idProd}',[CarritoController::class, 'actualizarJsonProductoCarrito']);
Route::delete('carrito/listar/json/eliminar/{idProd}',[CarritoController::class, 'borrarJsonProductoCarrito']);
Route::delete('carrito/listar/json/eliminar',[CarritoController::class, 'borrarJsonAllProductosCarrito']);
Route::get('carrito/comprado',[CarritoController::class, 'procesarCompra'])->name('procesar_compra');

Route::get('usuario/listar',[UsuarioController::class, 'listarUsuarios'])->name('listar_usuarios');
Route::get('usuario/registro',[UsuarioController::class, 'registroUsuario'])->name('registro_usuario');
Route::post('usuario/registrar',[UsuarioController::class, 'addUsuario'])->name('add_usuario');
Route::post('usuario/registrar/login',[UsuarioController::class, 'addUsuario'])->name('add_usuario_registro')->defaults('desdeRegistro', true);
Route::get('usuario/login',[UsuarioController::class, 'inicioSesionUsuario'])->name('inicio_sesion_usuario');
Route::post('usuario/loggedin',[UsuarioController::class, 'iniciarSesionUsuario'])->name('iniciar_sesion_usuario');
Route::get('usuario/logout',[UsuarioController::class, 'logoutUsuario'])->name('logout_usuario');
Route::put('usuario/actualizar/{id}',[UsuarioController::class, 'updateUsuario'])->name('update_usuario');
Route::delete('usuario/eliminar/{id}',[UsuarioController::class, 'deleteUsuario'])->name('delete_usuario');