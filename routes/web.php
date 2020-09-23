<?php

use Illuminate\Support\Facades\Auth;
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
    if (Auth::check()) {
        return redirect()->route('/dashboard');
    }
    return redirect()->route('login');
})->name('welcome');

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::prefix('users')->group(function () {
    Route::get('/', \App\Http\Livewire\Users\Index::class)->name('users.index');
    Route::get('create', \App\Http\Livewire\Users\Create::class)->name('users.create');
    Route::get('{user}/edit', \App\Http\Livewire\Users\Edit::class)->name('users.edit');
    Route::get('{user}/account', \App\Http\Livewire\Users\Account::class)->name('users.account');
    Route::post('/', \App\Http\Controllers\Users\StoreUserController::class)->name('users.store');
    Route::put('{user}', \App\Http\Controllers\Users\UpdateUserController::class)->name('users.update');
    Route::delete('{user}', \App\Http\Controllers\Users\DestroyUserController::class)->name('users.destroy');
});

Route::prefix('categories')->group(function () {
    Route::get('/', \App\Http\Livewire\Categories\Index::class)->name('categories.index');
    Route::get('create', \App\Http\Livewire\Categories\Create::class)->name('categories.create');
    Route::get('{category}/edit', \App\Http\Livewire\Categories\Edit::class)->name('categories.edit');
    Route::post('/', \App\Http\Controllers\Categories\StoreCategoryController::class)->name('categories.store');
    Route::put('{category}', \App\Http\Controllers\Categories\UpdateCategoryController::class)->name('categories.update');
    Route::delete('{category}', \App\Http\Controllers\Categories\DestroyCategoryController::class)->name('categories.destroy');
});

Route::prefix('subcategories')->group(function () {
    Route::get('/', \App\Http\Livewire\Subcategories\Index::class)->name('subcategories.index');
    Route::get('create', \App\Http\Livewire\Subcategories\Create::class)->name('subcategories.create');
    Route::get('{subcategory}/edit', \App\Http\Livewire\Subcategories\Edit::class)->name('subcategories.edit');
    Route::post('/', \App\Http\Controllers\Subcategories\StoreSubcategoryController::class)->name('subcategories.store');
    Route::put('{subcategory}', \App\Http\Controllers\Subcategories\UpdateSubcategoryController::class)->name('subcategories.update');
    Route::delete('{subcategory}', \App\Http\Controllers\Subcategories\DestroySubcategoryController::class)->name('subcategories.destroy');
});

Route::prefix('questions')->group(function () {
    Route::get('/', \App\Http\Livewire\Questions\Index::class)->name('questions.index');
    Route::get('create', \App\Http\Livewire\Questions\Create::class)->name('questions.create');
    Route::get('{question}/edit', \App\Http\Livewire\Questions\Edit::class)->name('questions.edit');
    Route::post('/', \App\Http\Controllers\Questions\StoreQuestionController::class)->name('questions.store');
    Route::put('{question}', \App\Http\Controllers\Questions\UpdateQuestionController::class)->name('questions.update');
    Route::delete('{question}', \App\Http\Controllers\Questions\DestroyQuestionController::class)->name('questions.destroy');
});

Route::prefix('answers')->group(function () {
    Route::get('{answer}/show', \App\Http\Livewire\Answers\Show::class)->name('answers.show');
});

Route::prefix('observations')->group(function(){
    Route::post('store', \App\Http\Controllers\Observations\StoreObservationController::class)->name('observations.store');
});

Route::prefix('announcements')->group(function () {
    Route::get('/', \App\Http\Livewire\Announcements\Index::class)->name('announcements.index');
    Route::get('create', \App\Http\Livewire\Announcements\Create::class)->name('announcements.create');
    Route::get('{announcement}/edit', \App\Http\Livewire\Announcements\Edit::class)->name('announcements.edit');
    Route::post('/', \App\Http\Controllers\Announcements\StoreAnnouncementController::class)->name('announcements.store');
    Route::put('{announcement}', \App\Http\Controllers\Announcements\UpdateAnnouncementController::class)->name('announcements.update');
    Route::delete('{announcement}', \App\Http\Controllers\Announcements\DestroyAnnouncementController::class)->name('announcements.destroy');
});

Route::prefix('repositories')->group(function () {
    Route::get('/', \App\Http\Livewire\Repositories\Index::class)->name('repositories.index');
    Route::get('{repository}/statistics', \App\Http\Livewire\Repositories\Statistics\Show::class)->name('repositories.statistics.show');
    Route::get('{repository}/send', \App\Http\Controllers\Repositories\SendRepositoryController::class)->name('repositories.send');
});

Route::prefix('evaluations')->group(function(){
    Route::get('{evaluation}/categories/{category}/questions', \App\Http\Livewire\Evaluations\Categories\Questions\Index::class)->name('evaluations.categories.questions.index');
    Route::get('{evaluationEncoded}/user/{evaluatorEncoded}/assign', \App\Http\Livewire\Evaluations\Assign::class)->name('evaluations.assign');
    Route::post('{evaluation}/categories/{category}/questions', \App\Http\Controllers\Evaluations\Categories\Questions\StoreQuestionController::class)->name('evaluations.categories.questions.store');
});