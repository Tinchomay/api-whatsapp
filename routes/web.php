<?php

use App\Http\Controllers\BitacoraController;
use App\Http\Controllers\PrincipalController;
use App\Http\Controllers\ProfileController;
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

Route::get('/', function () {
    return redirect()->route('dashboard');
});


//Aqui iran las politicas
Route::get('/politica-de-privacidad', [PrincipalController::class, 'politica']);

//rutas para el bot
Route::get('/api-whatsapp', [PrincipalController::class, 'conectar']);
Route::post('/api-whatsapp', [PrincipalController::class, 'recibirMensajes']);

//principal(muestra los documentos)
Route::get('/dashboard', [BitacoraController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');
//crear documentos
Route::get('/document/create', [BitacoraController::class, 'create'])->middleware(['auth', 'verified'])->name('createDocument');
Route::get('/document/{auto}/edit', [BitacoraController::class, 'edit'])->middleware(['auth', 'verified'])->name('editDocument');

// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });

require __DIR__.'/auth.php';
