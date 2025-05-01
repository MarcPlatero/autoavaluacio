<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CiclesController;
use App\Http\Controllers\ModulsController;
use App\Http\Controllers\UsuarisController;

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
    return view('layouts.principalLogin');
});

Route::get('/login', [UsuarisController::class, 'showLogin'])->name('login');
Route::post('/login', [UsuarisController::class, 'login']);
Route::get('/logout', [UsuarisController::class, 'logout']);

Route::middleware(['auth'])->group(function () {
    Route::get('/home', function () {
        $user = Auth::user();

        return view('layouts.principalLogin', compact('user'));
    });

    Route::resource('cicles', CiclesController::class);
    Route::resource('moduls', ModulsController::class);
    //Creen rutes per a les accions index, create, store, show, edit, update, i destroy per al controlador UsuarisController
    Route::resource('usuaris', UsuarisController::class);
    //En canvi aquí he de posar les rutes per canviar només la contrasenya, ja que no està dins de les accions nombrades adalt i és una nova
    Route::get('usuaris/{usuari}/edit-password', [UsuarisController::class, 'editPassword'])->name('usuaris.editPassword');
    Route::put('usuaris/{usuari}/update-password', [UsuarisController::class, 'updatePassword'])->name('usuaris.updatePassword');

    Route::get("recuperarIdUsuari",[UsuarisController::class,"recuperarIdUsuari"]);
    Route::get("recuperarTipusUsuari",[UsuarisController::class,"recuperarTipusUsuari"]);

    Route::get('/resultatsAprenentatge', function () {
        return view('resultatsAprenentatge.index');
    });

    Route::get('/veureAutoavaluacions', function () {
        return view('veureAutoavaluacions.index');
    });

});

// Route::get('moduls', function() {
//     return view('moduls.index');
// });

