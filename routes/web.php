<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\UserController;
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

Route::get('/', [PostController::class, 'index'])->name("posts.index");

Route::prefix('/posts')->name('posts.')->controller(PostController::class)->group(function (){
    Route::get('/{post}', 'show')->where(["post"=> "[0-9]+"])->name("show");
    Route::get('/create', 'create')->name("create")->middleware(['auth']);
    Route::post('/create', 'store')->name("store")->middleware(['auth']);
    Route::get('/{post}/edite', 'edite')->where(["post"=> "[0-9]+"])->name("edite")->middleware(['auth', 'post.owner']);
    Route::put('/{post}/edite', 'update')->where(["post"=> "[0-9]+"])->name("update")->middleware(['auth', 'post.owner']);
    Route::delete('/{post}', 'destroy')->where(["post"=> "[0-9]+"])->name("destroy")->middleware(['auth', 'post.owner']);
});

Route::prefix('/categories')->name('categories.')->middleware(['admin'])->controller(CategoryController::class)->group(function (){
    Route::get('', 'index')->name("index");
    Route::get('/create', 'create')->name("create");
    Route::post('/create', 'store')->name("store");
    Route::get('/{category}/edite', 'edite')->where(["category"=> "[0-9]+"])->name("edite");
    Route::put('/{category}/edite', 'update')->where(["category"=> "[0-9]+"])->name("update");
    Route::delete('/{category}', 'destroy')->where(["category"=> "[0-9]+"])->name("destroy");
    Route::put('/{category}/reassign-posts', 'reassignPosts')->name('reassign-posts');
});

Route::prefix('/tags')->name('tags.')->middleware(['admin'])->controller(TagController::class)->group(function (){
    Route::get('', 'index')->name("index");
    Route::get('/create', 'create')->name("create");
    Route::post('/create', 'store')->name("store");
    Route::get('/{tag}/edite', 'edite')->where(["tag"=> "[0-9]+"])->name("edite");
    Route::put('/{tag}/edite', 'update')->where(["tag"=> "[0-9]+"])->name("update");
    Route::delete('/{tag}', 'destroy')->where(["tag"=> "[0-9]+"])->name("destroy");
});

Route::prefix('/users')->name('users.')->controller(UserController::class)->group(function (){
    Route::get('', 'index')->name("index")->middleware(['admin']);
    Route::get('/{user}', 'show')->where(["user"=> "[0-9]+"])->name("show");
    Route::get('/create', 'create')->name("create");
    Route::post('/create', 'store')->name("store");
    Route::get('/{user}/edite', 'edite')->where(["user"=> "[0-9]+"])->name("edite")->middleware(['auth', 'user.owner']);
    Route::put('/{user}/edite', 'update')->where(["user"=> "[0-9]+"])->name("update")->middleware(['auth', 'user.owner']);
    Route::delete('/{user}', 'destroy')->where(["user"=> "[0-9]+"])->name("destroy")->middleware(['auth', 'user.owner']);
});

Route::prefix("/auth")->name("auth.")->controller(AuthController::class)->group(function () {
    Route::get('/login', 'login')->name("login");
    Route::post('/login', 'doLogin');
    Route::post('/logout', 'logout')->name("logout")->middleware(['auth']);
});

