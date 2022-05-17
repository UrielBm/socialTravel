<?php

use App\Http\Controllers\CategoriasViajeController;
use App\Http\Controllers\InicioController;
use App\Http\Controllers\LikesController;
use App\Http\Controllers\PerfilController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ViajeController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [InicioController::class, 'index'])->name("inicio");

// Route::get('/recetas', RecetasController::class)->name("recetas");

Auth::routes();

//Rutas publicas.
Route::get("/viajes/{viaje}", [ViajeController::class, 'show'])->name('viaje.show');
Route::get("/perfil/{perfil}", [PerfilController::class, 'show'])->name('perfil.show');
//viajes que me gustan 
Route::get("/mis_viajes_que_me_gustan", [ViajeController::class, 'indexLike'])->name('viajes.me_gustan');
//viajes por categoria
Route::get("/categorias/{categoria}", [CategoriasViajeController::class, 'show'])->name('categorias.show');
//Ruta para busqueda de viajes
Route::get("/busqueda", [ViajeController::class, 'search'])->name('busqueda.show');
//Rutas privadas.
Route::get('/mis_viajes', [ViajeController::class, 'index'])->name('viaje.index');
Route::post('/mis_viajes', [ViajeController::class, 'store'])->name('viaje.store');
Route::get('/mis_viajes/create', [ViajeController::class, 'create'])->name('viaje.create');
Route::get("/mis_viajes/{viaje}/edit", [ViajeController::class, 'edit'])->name('viaje.edit');
Route::put("/mis_viajes/{viaje}", [ViajeController::class, 'update'])->name("viaje.update");
Route::delete("/mis_viajes/{viaje}", [ViajeController::class, 'destroy'])->name("viaje.destroy");

//Rutas del perfil 
Route::get("/mi_perfil/{perfil}/edit", [PerfilController::class, 'edit'])->name('perfil.edit');
Route::put("/mi_perfil/{perfil}", [PerfilController::class, 'update'])->name("perfil.update");
//Almacena los likes de la recetas
Route::put("/viajes/{viaje}", [LikesController::class, 'update'])->name('likes.update');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//Ruta offline 

Route::get("/offline", function () {
    return view('vendor/laravelpwa/offline');
});
