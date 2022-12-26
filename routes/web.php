<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\VehicleController;
use App\Http\Controllers\auth\LoginController;
use App\Http\Controllers\MaintenanceController;
use App\Http\Controllers\auth\RegisterController;

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

//Route::get('/', function () {
//    return view('welcome');
//});
Route::get('/login', [LoginController::class, 'index'])->name('admin.login');
Route::get('/registrar', [RegisterController::class, 'index'])->name('admin.register');
Route::post('/registrar/create', [RegisterController::class, 'create'])->name('admin.create');
Route::post('/login/authenticate', [LoginController::class, 'authenticate'])->name('admin.authenticate');

Route::middleware('auth')->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('home.index');

    Route::get('/cadastrar-veiculo', [VehicleController::class, 'register'])->name('vehicle.register');
    Route::post('/cadastrar-veiculo/create', [VehicleController::class, 'create'])->name('vehicle.create');
    Route::get('/cadastrar-manutencao', [MaintenanceController::class, 'register'])->name('manintence.register');
    Route::get('editar-veiculo/{id}', [VehicleController::class, 'show'])->name('vehicle.show');
    Route::Post('editar-veiculo/{id}', [VehicleController::class, 'edit'])->name('vehicle.edit');
    Route::get('editar-manutencao/{id}', [MaintenanceController::class, 'show'])->name('maintenance.show');
    Route::post('/cadastrar-manutencao/create', [MaintenanceController::class, 'create'])->name('manintence.create');
    Route::get('/lista-veiculos', [VehicleController::class, 'index'])->name('vehicle.index');
    Route::get('/lista-manutencoes', [MaintenanceController::class, 'index'])->name('maintenance.index');
    Route::get('/manutencoes/finalizar/{id}', [MaintenanceController::class, 'finalize'])->name('maintenance.finalize');
    Route::post('/manutencao/edit/{id}', [MaintenanceController::class, 'edit'])->name('maintenance.edit');
    Route::get('/manutencao/finalizar/{id}', [MaintenanceController::class, 'finalize'])->name('maintenance.finalize');
    Route::get('/manutencao/delete/{id}', [MaintenanceController::class, 'delete'])->name('maintenance.delete');
    Route::get('/veiculo/delete/{id}', [VehicleController::class, 'delete'])->name('vehicle.delete');
    Route::get('/logout', [LoginController::class, 'destroy'])->name('admin.logout');
});

Route::get('/teste', function () {
    return view('admin.home');
});
