<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Auth;

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


// AuthController
Route::get('/register', [AuthController::class, 'index'])->name('register');
Route::post('register', [AuthController::class, 'store'])->name('register');

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


Route::post('/images', [ImageController::class, 'store'])->name('images.store');


Route::get('/signin', [AuthController::class, 'signin']);
Route::get('/recovery', [AuthController::class, 'recovery']);




// Route Model Bainding -> Un modelo esta asociado a una ruta