<?php


use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\CommentaryController;
use App\Http\Controllers\FollowerController;
use App\Http\Controllers\ProfileController;

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

// Rutas para la edicion del perfil
Route::get('/editar-perfil', [ProfileController::class, 'index'])->name('perfil.index');
Route::post('/editar-perfil', [ProfileController::class, 'store'])->name('perfil.store');



// AuthController
Route::get('/register', [AuthController::class, 'index'])->name('register');
Route::post('/register', [AuthController::class, 'store'])->name('register');

// LoginController
Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'store'])->name('login');
// Route::get('/logout', [LogoutController::class, 'store'])->name('logout');
Route::post('/logout', [LogoutController::class, 'store'])->name('logout');



// Route::get('/', function () {
//     // view toma como parametro el nombre de la vista que queremos mostrar
//     return view('home');
// });


// PostController
//{user:username} -> No solo podemos acceder a username, sino a cualquier campo del model User
Route::get('/{user:username}', [PostController::class, 'index'])->name('posts.index');
Route::get('/posts/create', [PostController::class, 'create'])->name('posts.create');
Route::post('/posts', [PostController::class, 'store'])->name('posts.store');
Route::get('/{user:username}/post/{post}', [PostController::class, 'show'])->name('posts.show');
Route::delete('/posts/{post}', [PostController::class, 'destroy'])->name('posts.destroy');

Route::post('/{user:username}/post/{post}', [CommentaryController::class, 'store'])->name('commentaries.store');

Route::post('/images', [ImageController::class, 'store'])->name('images.store');


Route::get('/signin', [AuthController::class, 'signin']);
Route::get('/recovery', [AuthController::class, 'recovery']);

// Route a las photos
Route::post('/posts/{post}/likes', [LikeController::class, 'store'])->name('posts.likes.store');

Route::delete('/posts/{post}/likes', [LikeController::class, 'destroy'])->name('posts.likes.destroy');

// Siguiendo usuarios
// Agregar un usuario a nuestros follows
Route::post('{user:username}/follow', [FollowerController::class, 'store'])->name('users.follow');
// Eliminar un usuario de nuestros follows
Route::delete('{user:username}/unfollow', [FollowerController::class, 'destroy'])->name('users.unfollow');
// Route Model Bainding -> Un modelo esta asociado a una ruta