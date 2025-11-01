<?php

use App\Http\Controllers\ProductoController;
use App\Http\Controllers\TiendaController;
use App\Http\Controllers\UsuarioController;
use Illuminate\Support\Facades\Route;

Route::get('/',[TiendaController::class, 'listarTiendas'])->name('listar_tiendas');
Route::put('producto/actualizar/{idTienda}',[TiendaController::class, 'updateTienda'])->name('update_tienda');

Route::get('producto/listar/{idTienda}',[ProductoController::class, 'listarProductos'])->name('listar_productos');
Route::post('producto/add/{idTienda}',[ProductoController::class, 'addProducto'])->name('add_producto');
Route::put('producto/actualizar/{idTienda}/{idProd}',[ProductoController::class, 'updateProducto'])->name('update_producto');
Route::delete('producto/eliminar/{idTienda}/{idProd}',[ProductoController::class, 'deleteProducto'])->name('delete_producto');

Route::get('usuario/listar',[UsuarioController::class, 'listarUsuarios'])->name('listar_usuarios');
Route::get('usuario/registro',[UsuarioController::class, 'registroUsuario'])->name('registro_usuario');
Route::post('usuario/registrar',[UsuarioController::class, 'addUsuario'])->name('add_usuario');
Route::post('usuario/registrar/login',[UsuarioController::class, 'addUsuario'])->name('add_usuario_registro')->defaults('desdeRegistro', true);
Route::get('usuario/login',[UsuarioController::class, 'inicioSesionUsuario'])->name('inicio_sesion_usuario');
Route::post('usuario/loggedin',[UsuarioController::class, 'iniciarSesionUsuario'])->name('iniciar_sesion_usuario');
Route::get('usuario/logout',[UsuarioController::class, 'logoutUsuario'])->name('logout_usuario');
Route::put('usuario/actualizar/{id}',[UsuarioController::class, 'updateUsuario'])->name('update_usuario');
Route::delete('usuario/eliminar/{id}',[UsuarioController::class, 'deleteUsuario'])->name('delete_usuario');