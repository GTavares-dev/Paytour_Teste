<?php

use App\Models\Curriculo;
use Illuminate\Support\Facades\Route;


use App\Http\Controllers\CurriculoController;


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

Route::get('/curriculo', [CurriculoController::class, 'index'])->name('index');

Route::post('/curriculo', [CurriculoController::class, 'form'])->name('send');

Route::get('envio-email', function () {

    $curriculo = new Curriculo();
    $curriculo->name = 'Gabriel Tavares';
    $curriculo->email  = 'gabrieldvt@hotmail.com';
    return new \App\Mail\CurriculoMail($curriculo);
});
