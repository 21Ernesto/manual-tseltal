<?php

use App\Http\Controllers\CapitulosController;
use App\Http\Controllers\PalabrasController;
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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [CapitulosController::class, 'index'])->name('capitulos');
Route::get('/capitulos/{capitulo}', [CapitulosController::class, 'mostrarPalabras'])->name('mostrar_palabras');

Route::get('/dashboard', [CapitulosController::class, 'mostrarCount'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::post('/capitulos/store', [CapitulosController::class, 'store'])
    ->middleware(['auth', 'verified'])
    ->name('capitulos.store');

Route::get('/palabras', [PalabrasController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('palabras');

Route::post('/importar-palabras', [PalabrasController::class, 'importPalabras'])
    ->middleware(['auth', 'verified'])
    ->name('importar.palabras');

Route::post('/importar-audio', [PalabrasController::class, 'importarAudio'])
    ->middleware(['auth', 'verified'])
    ->name('importarAudio');



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
