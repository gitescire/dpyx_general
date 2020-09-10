<?php

use Illuminate\Support\Facades\Route;

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

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::get('users', \App\Http\Livewire\Users\Index::class)->name('users.index');
Route::get('users/create', \App\Http\Livewire\Users\Create::class)->name('users.create');
Route::post('users', \App\Http\Controllers\Users\StoreUserController::class)->name('users.store');

Route::get('evaluations/{evaluation}/categories/{category}/answers', \App\Http\Livewire\Evaluations\Answer::class)->name('evaluations.categories.answers');
