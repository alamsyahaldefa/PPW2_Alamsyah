<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MencobaController;
use App\Http\Controllers\BukuController;
use App\Http\Controllers\Auth\LoginRegisterController;
use App\Http\Controllers\SendEmailController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\UserController;



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

Route::get('/about', function () {
    return view('about', [
        "name" => "lulu",
        "email" => "lulu@gmail.com"
    ]);
});

Route::get('/halo', function () {
    return view('halo', [
        "name" => "lulu lala",
        "" => "lululala@gmail.com"
    ]);
});

Route::get('/boom', [MencobaController::class,'boomsport']);

Route::get('/perumahan', [MencobaController::class, 'daftarPerumahan']); 



// Route::get('/buku', [BukuController::class, 'index']);

// Route::get('/buku','BukuController@index');
// Route::get('/buku/create', 'BukuController@create')->name('buku.create');
// Route::get('/buku','BukuController@store')->name('buku.store');

// Route::post('/buku/delete/{id}', 'BukuController@destroy')->name('buku.destroy');

Route::controller(LoginRegisterController::class)->group(function() {
    Route::get('/register', 'register')->name('register');
    Route::post('/store', 'store')->name('store');
    Route::get('/login', 'login')->name('login');
    Route::post('/authenticate', 'authenticate')->name('authenticate');
    Route::get('/dashboard', 'dashboard')->name('dashboard');
    Route::post('/logout', 'logout')->name('logout');
});


Route::get('/send-mail', [SendEmailController::class,'index'])->name('kirim-email');

Route::post('/post-email', [SendEmailController::class, 'store'])->name('post-email');

Route::middleware('auth')->group(function () {
    Route::post('/update-photo', [LoginRegisterController::class, 'updatePhoto'])->name('update-photo');
});


Route::resource('gallery', GalleryController::class);
Route::get('/gallery/{id}/edit', 'GalleryController@edit')->name('gallery.edit');
Route::delete('/gallery/{id}', 'GalleryController@destroy')->name('gallery.destroy');

