<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\UserController;

Route::get('/',function(){
    return redirect('/posts');
});
Route::get('/home',function(){
    return redirect('/posts');
});



Route::get('/posts', [PostController::class, 'index']);
Route::view('/posts/create', 'posts.create');
Route::post('/posts/create',[PostController::class, 'store']);

Route::get('/posts/myPosts',[PostController::class,'userPosts']);

Route::get('/posts/{id}', [PostController::class, 'show'])->name('post');
Route::post('/comments',[CommentController::class,'store']);

Route::delete('/posts/{id}',[PostController::class,'destroy'])->name('post');

Route::post('/users/{user}',[UserController::class,'update'])->name('update');





Route::delete('/users/{user}',[UserController::class,'destroy'])->name('user.delete');


Route::get('/users',[UserController::class,'index']);
Auth::routes();


    Route::get(
        '/home', 
        [App\Http\Controllers\PostController::class, 'index'])->name('home');

    Route::get(
        '/today', 
        [App\Http\Controllers\PostController::class, 'today'])->name('today');
    