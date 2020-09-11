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
Route::get('users/{user}/edit', \App\Http\Livewire\Users\Edit::class)->name('users.edit');
Route::post('users', \App\Http\Controllers\Users\StoreUserController::class)->name('users.store');
Route::put('users/{user}', \App\Http\Controllers\Users\UpdateUserController::class)->name('users.update');
Route::delete('users/{user}', \App\Http\Controllers\Users\DestroyUserController::class)->name('users.destroy');

Route::get('categories', \App\Http\Livewire\Categories\Index::class)->name('categories.index');
Route::get('categories/create', \App\Http\Livewire\Categories\Create::class)->name('categories.create');
Route::get('categories/{category}/edit', \App\Http\Livewire\Categories\Edit::class)->name('categories.edit');
Route::delete('categories/{category}', \App\Http\Controllers\Categories\DestroyCategoryController::class)->name('categories.destroy');
Route::post('categories', \App\Http\Controllers\Categories\StoreCategoryController::class)->name('categories.store');
Route::put('categories/{category}', \App\Http\Controllers\Categories\UpdateCategoryController::class)->name('categories.update');

Route::get('evaluations/{evaluation}/categories/{category}/answers', \App\Http\Livewire\Evaluations\Answer::class)->name('evaluations.categories.answers');
