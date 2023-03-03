<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{AdminController, ReportesController, CuponController, HomeController, PasswordController};

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

Route::get('/', function () {
    return view('welcome');
});


Route::post('/importar', [AdminController::class, 'import'])->name('import.excel');
Route::post('/importCupon', [AdminController::class, 'importCupon'])->name('importCupon.excel');



Auth::routes();

// Route::get('/recuperar-contraseña', Auth\ForgotPasswordController::class, 'showLinkRequestForm')->name('password.reset');

Route::get('/home', [HomeController::class, 'index'])->name('home');


Route::middleware(['admin'])->group(function () {
    Route::get('/editar/cupon', [CuponController::class, 'showEdit'])->name('cupon.edit.get');
    Route::get('/cupon', [CuponController::class, 'index'])->name('cupon.view.edit');
    Route::put('/editar/cupon/admin', [CuponController::class, 'edit'])->name('cupon.edit.put');
    Route::post('/editar/cupon', [CuponController::class, 'showEdit'])->name('show.edit.admin');
    Route::get('/registrar/admin', [AdminController::class, 'index'])->name('create.user');
    Route::post('/registrar/admin', [AdminController::class, 'create'])->name('register.admin');
    Route::get('/resetear/contraseña', [PasswordController::class, 'reset'])->name('reset.password');
    Route::post('/resetear/contraseña/admin', [PasswordController::class, 'resetPassword'])->name('resetear.contraseña');

});




Route::get('/reportes', [ReportesController::class, 'index'])->name('reportes');
Route::post('/reportes', [ReportesController::class, 'mostrar'])->name('mostrarConcesionario');
Route::get('/reportes/exportar', [ReportesController::class, 'exportar'])->name('exportar');

Route::post('/lector', [CuponController::class, 'store'])->name('cupon.store');

Route::get('/cambiar/contraseña', [PasswordController::class, 'index'])->name('change.password');
Route::post('/cambiar/contraseña', [PasswordController::class, 'change'])->name('change.password');





