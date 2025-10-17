<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\GoogleAuthController;
use App\Http\Controllers\AIController;
use App\Http\Controllers\Comment;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\LikeController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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
Route::get('/ai/chat', [AIController::class, 'showForm'])->name('ai.chat');
Route::post('/ai/chat', [AIController::class, 'generateText'])->name('ai.generate');

Route::get('auth/google', [GoogleAuthController::class, 'redirectToGoogle'])->name('access.google');
Route::get('auth/google/callback', [GoogleAuthController::class, 'handleGoogleCallback']);

Route::get('/login', [AuthController::class, 'showLogin'])->name('show.login');
Route::get('/register', [AuthController::class, 'showRegister'])->name('show.register');

Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/register', [AuthController::class, 'register'])->name('register');

Route::get('/profile/edit/{id}', [AuthController::class, 'showEdit'])->name('show.editProfile')->middleware('auth');
Route::put('/profile/edit/{id}', [AuthController::class, 'edit'])->name('edit.profile')->middleware('auth');

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/profile/{id}', [AuthController::class, 'showProfile'])->name('show.profile')->middleware('auth');

Route::get('/', [PostController::class, 'homepage'])->name('show.home');
Route::get('/homepage/{id}', [PostController::class, 'showPost'])->name('show.post')->middleware('auth');

Route::post('/post/{id}/{userId}/comment', [CommentController::class, 'comment'])->name('comment');
Route::post('/post/{id}/like', [LikeController::class, 'like'])->name('like');


Route::delete('/homepage/{post}', [PostController::class, 'delete'])->name('post.delete')->middleware('auth');

Route::get('homepage/create/{id}', [PostController::class, 'showCreatePost'])->name('show.createPost')->middleware('auth');
Route::post('homepage/post/{id}', [PostController::class, 'createPost'])->name('create.post')->middleware('auth');

Route::get('/homepage/manage/{id}', [PostController::class, 'manage'])->name('show.manage')->middleware('auth');

Route::get('/homepage/edit/{id}', [PostController::class, 'editPost'])->name('show.edit')->middleware('auth');
Route::put('/homepage/edit/{id}', [PostController::class, 'edit'])->name('edit')->middleware('auth');

Route::get('/blog', [AuthController::class, 'blogUsers'])->name('blog.info');

Route::get('/settings', function(){
    return view('blog.settings');
})->name('show.settings')->middleware('auth');

Route::get('/chat', [AuthController::class, 'showChatUsers'])->name('chat');
Route::get('/chat/{id}', [AuthController::class, 'userChat'])->name('chat.user');

