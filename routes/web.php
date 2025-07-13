<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Auth;
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
    return view('pages.welcome');
});

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::get('/wa', function () {
    $fonnte = new \App\Services\FonnteService;

    $userPhone = '6282282432437'; // pastikan nomor aktif & terdaftar
    $message = 'WOIIIIIIIIIIIIIIIII Halo! Ini adalah pesan tes dari sistem Laravel.';
    $fonnte->send($userPhone, $message);

});
