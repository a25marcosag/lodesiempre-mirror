<?php

use App\Http\Controllers\ProductoController;
use App\Http\Controllers\TiendaController;
use App\Http\Controllers\UsuarioController;
use Illuminate\Support\Facades\Route;

Route::get('/',[TiendaController::class, 'listarTiendas'])->name('listar_tiendas');

Route::get('producto/listar/{id}',[ProductoController::class, 'listarProductos'])->name('listar_productos');

Route::get('usuario/listar',[UsuarioController::class, 'listarUsuarios'])->name('listar_usuarios');
Route::get('usuario/registro',[UsuarioController::class, 'registroUsuario'])->name('registro_usuario');
Route::post('usuario/registrar',[UsuarioController::class, 'addUsuario'])->name('add_usuario');
Route::put('usuario/actualizar/{id}',[UsuarioController::class, 'updateUsuario'])->name('update_usuario');
Route::delete('usuario/eliminar/{id}',[UsuarioController::class, 'deleteUsuario'])->name('delete_usuario');