<?php

use App\Http\Controllers\BookController;
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

Route::get('/', \App\Http\Controllers\MainPageController::class)->name('mainPage');


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/books' , function (){
    return view('books.index');
});

//Route::group(['middleware' => ['auth']] , function (){
//    Route::resource('/users' , \App\Http\Controllers\UserController::class);
//    Route::resource('/roles' , \App\Http\Controllers\UserController::class);
//    Route::resource('/permissions' , \App\Http\Controllers\UserController::class);
//    Route::resource('/books' , \App\Http\Controllers\UserController::class);
//    Route::resource('/authors' , \App\Http\Controllers\UserController::class);
//    Route::resource('/publishers' , \App\Http\Controllers\UserController::class);
//});

Route::resource('/users' , \App\Http\Controllers\UserController::class)->except('create');
Route::resource('/roles' , \App\Http\Controllers\RoleController::class);
Route::resource('/permissions' , \App\Http\Controllers\PermissionController::class);

Route::resource('/authors' , \App\Http\Controllers\AuthorController::class);
Route::resource('/publishers' , \App\Http\Controllers\PublisherController::class);

Route::get('/activities' , \App\Http\Controllers\ActivityController::class)->name('activities.index');

Route::get('/search' , \App\Http\Controllers\SearchController::class)->name('search');
Route::post('images/upload', [\App\Http\Controllers\images\ImageController::class , 'upload'])->name('ckeditor.image-upload');

//Route::get('/deleted' , [BookController::class , 'viewDeleted'])
//    ->name('books.deleted');
//Route::get('books/restore' , [BookController::class , 'restore'])
//    ->name('books.restore');
//
//Route::post('/books/store-time', [BookController::class , 'storeTime'])
//    ->name('books.store-time');
//Route::resource('/books' , \App\Http\Controllers\BookController::class);

Route::prefix('/books')->name('books.')->group(function (){
    Route::get('' ,[BookController::class , 'index'])->name('index');
    Route::post('' , [BookController::class , 'store'])->name('store');
    Route::get('/create' , [BookController::class , 'create'])->name('create');
    Route::get('/books/{book}' , [BookController::class , 'show'])->name('show');
    Route::delete('/books/{book}' , [BookController::class , 'destroy'])->name('destroy');
    Route::put('/books/{book}' , [BookController::class , 'update'])->name('update');
    Route::patch('/books/{book}' , [BookController::class , 'update'])->name('update');
    Route::get('/books/{book}/edit' , [BookController::class , 'edit'])->name('edit');


    Route::get('/deleted' , [BookController::class , 'viewDeleted'])->name('deleted');
    Route::get('/restore/{book}' , [BookController::class , 'restore'])->name('restore');
    Route::post('/store-time/{book}' , [BookController::class , 'storeTime'])->name('store-time');
    Route::delete('/delete-time/{book}' , [BookController::class , 'deleteTime'])->name('delete-time');
});
