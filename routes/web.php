<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ExerciseController;

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

Route::get('/clear-cache', function() {
    $exitCode = Artisan::call('cache:clear');
    return '<h1>Cache facade value cleared</h1>';
});
//Reoptimized class loader:
Route::get('/optimize', function() {
    $exitCode = Artisan::call('optimize');
    return '<h1>Reoptimized class loader</h1>';
});
//Route cache:
Route::get('/route-cache', function() {
    $exitCode = Artisan::call('route:cache');
    return '<h1>Routes cached</h1>';
});
//Clear Route cache:
Route::get('/route-clear', function() {
    $exitCode = Artisan::call('route:clear');
    return '<h1>Route cache cleared</h1>';
});
//Clear View cache:
Route::get('/view-clear', function() {
    $exitCode = Artisan::call('view:clear');
    return '<h1>View cache cleared</h1>';
});
//Clear Config cache:
Route::get('/config-cache', function() {
    $exitCode = Artisan::call('config:cache');
    return '<h1>Clear Config cleared</h1>';
});

Route::get('/prueba', function() {
    $exitCode = Artisan::call('enviar:mail');
    return '<h1>Enviado</h1>';
});


Route::get('/', function () {
    return view('auth.login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';

Route::group(['middleware' => 'auth'], function () {

Route::resource('product', App\Http\Controllers\ProductController::class);
Route::resource('maker', App\Http\Controllers\MakerController::class);
Route::resource('brand', App\Http\Controllers\BrandController::class);
Route::resource('presentation', App\Http\Controllers\PresentationController::class);
Route::resource('client', App\Http\Controllers\ClientController::class);
Route::resource('exercise', App\Http\Controllers\ExerciseController::class);


Route::get('consultacomercial/export', [ProductController::class, 'export'])->name('consultacomercial');
Route::get('geolocalizacion/export', [ExerciseController::class, 'export'])->name('geolocalizacion');

});


