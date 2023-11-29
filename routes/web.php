<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {return view('welcome');})->name('welcome');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

/*FAVORITOS*/
//Route:: get('dashboard',[App\Http\Controllers\PostController::class, 'index'])->name('dashboard');

Route::post('/like', [App\Http\Controllers\PostController::class,'like'])->name('like');

/*CARRITO*/
Route:: get('dashboard',[App\Http\Controllers\FrontController::class, 'index'])->name('dashboard');
Route:: post('cart/add', [App\Http\Controllers\CartController::class, 'add'])->name('add');
Route:: get('cart/chekout', [App\Http\Controllers\CartController::class, 'chekout'])->name('chekout');
Route:: get('cart/clear', [App\Http\Controllers\CartController::class, 'clear'])->name('clear');
Route:: post('cart/removeitem', [App\Http\Controllers\CartController::class, 'removeItem'])->name('removeItem');


/*administrador*/
Route::get('administrador/Index',[App\Http\Controllers\AdminController::class, 'index'])->name('administrador.index');

/*TIPO*/
Route::get('tipos/Index',[App\Http\Controllers\TiposController::class, 'index'])->name('tipos.index');
Route::get('tipos/create',[App\Http\Controllers\TiposController::class,'create'])->name('tipos.create');
Route::post('tipos/guardar',[App\Http\Controllers\TiposController::class,'store'])->name('tipos.store');
Route::get('tipos/{tipos}/eliminar',[App\Http\Controllers\TiposController::class, 'destroy'])->name('tipos.destroy');
Route::get('tipos',function (){return view('tipos/index');});

/*MARCA*/
Route::get('marcas/Index','App\Http\Controllers\MarcasController@index')->name('marcas.index');
Route::get('marcas/create',[App\Http\Controllers\MarcasController::class,'create'])->name('marcas.create');
Route::post('marcas/guardar',[App\Http\Controllers\MarcasController::class,'store'])->name('marcas.store');
Route::get('marcas',function (){return view('marcas/index');});

/*PRODUCTOS*/
Route::get('productos/Index',[App\Http\Controllers\ProductosController::class, 'index'])->name('productos.index');
Route::get('productos/create',[App\Http\Controllers\ProductosController::class,'create'])->name('productos.create');
Route::post('productos/guardar',[App\Http\Controllers\ProductosController::class,'store'])->name('productos.store');
Route::get('productos/{productos}/editar',[App\Http\Controllers\ProductosController::class, 'edit'])->name('productos.edit');
Route::get('productos/{productos}/actualizar',[App\Http\Controllers\ProductosController::class, 'update'])->name('productos.update');
Route::get('productos',function (){return view('productos/index');});
