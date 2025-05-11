<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


/* Route::get('/registrar_empresa', function () {
    return view('auth.registerEmpresa');
})->name("registrarEmpresa");
 */
//Rutas Empresas
Route::get('/registrar_empresa', [App\Http\Controllers\EmpresaController::class, 'index'])->name('registrar_empresa');
Route::post('/registra_empresa', [App\Http\Controllers\EmpresaController::class, 'create'])->name('registra_empresa');

Auth::routes();
Route::middleware('auth')->group(function () {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('/', function () {
        return view('welcome');
    });
});
Route::middleware(['auth', 'is_admin'])->prefix('admin')->group(function () {
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    });

    Route::get('/users', function () {
        return view('admin.users');
    });
});
Auth::routes(['verify' => true]);

//Para rutas con usuarios verificados
Route::get('/prueba', function () {
    dd("Usuario Verificado correctamente");
})->middleware('verified');