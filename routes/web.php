<?php

use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TagController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SearchController;

// Route::get('/', [HomeController::class, '__invoke']);  //laravel 8 routing controller -> invokable method
Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('search', [SearchController::class, 'post'])->name('search.posts'); //search bar

Route::prefix('posts')->middleware('auth')->group(function(){ //CREATE Route Group for PostController with Auth
    //READ DATA 
    Route::get('/', [PostController::class, 'index'])->name('posts.index')->withoutMiddleware('auth'); //->name('') memberikan penamaan ketika ingin memanggil halaman route yg bersangkutan
    //CREATE DATA
    Route::get('create', [PostController::class, 'create'])->name('posts.create'); //menampilkan UI create data
    Route::post('store', [PostController::class, 'store']); //method menyimpan data ke db
    //UPDATE DATA //REST API : //put -> update seluruh field data //patch -> update sebagian data
    Route::get('{post:slug}/edit', [PostController::class, 'edit']); //menampilkan UI edit data
    Route::patch('{post:slug}/edit', [PostController::class, 'update']); //method update data di db
    //DELETE
    Route::delete('{post:slug}/delete', [PostController::class, 'destroy']);
    //SHOW READ MORE CONTENT
    Route::get('{post:slug}', [PostController::class, 'show'])->name('posts.show')->withoutMiddleware('auth');


});

//SHOW BASED ON CATEGORY
Route::get('categories/{category:slug}', [CategoryController::class, "show"])->name('categories.show'); 

//SHOW BASED ON TAG
Route::get('tags/{tag:slug}', [TagController::class, "show"])->name('tags.show');
    

Route::view('contact', 'contact');
Route::view('about', 'about');
Route::view('login', 'login');



Auth::routes();