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
Route::post('categories', \App\Http\Controllers\Categories\StoreCategoryController::class)->name('categories.store');
Route::put('categories/{category}', \App\Http\Controllers\Categories\UpdateCategoryController::class)->name('categories.update');
Route::delete('categories/{category}', \App\Http\Controllers\Categories\DestroyCategoryController::class)->name('categories.destroy');

Route::get('subcategories', \App\Http\Livewire\Subcategories\Index::class)->name('subcategories.index');
Route::get('subcategories/create', \App\Http\Livewire\Subcategories\Create::class)->name('subcategories.create');
Route::get('subcategories/{subcategory}/edit', \App\Http\Livewire\Subcategories\Edit::class)->name('subcategories.edit');
Route::post('subcategories', \App\Http\Controllers\Subcategories\StoreSubcategoryController::class)->name('subcategories.store');
Route::put('subcategories/{subcategory}', \App\Http\Controllers\Subcategories\UpdateSubcategoryController::class)->name('subcategories.update');
Route::delete('subcategories/{subcategory}', \App\Http\Controllers\Subcategories\DestroySubcategoryController::class)->name('subcategories.destroy');

Route::get('questions', \App\Http\Livewire\Questions\Index::class)->name('questions.index');
Route::get('questions/create', \App\Http\Livewire\Questions\Create::class)->name('questions.create');
Route::get('questions/{question}/edit', \App\Http\Livewire\Questions\Edit::class)->name('questions.edit');
Route::post('questions', \App\Http\Controllers\Questions\StoreQuestionController::class)->name('questions.store');
Route::put('questions/{question}', \App\Http\Controllers\Questions\UpdateQuestionController::class)->name('questions.update');
Route::delete('questions/{question}', \App\Http\Controllers\Questions\DestroyQuestionController::class)->name('questions.destroy');

Route::get('evaluations/{evaluation}/categories/{category}/answers', \App\Http\Livewire\Evaluations\Answer::class)->name('evaluations.categories.answers');
