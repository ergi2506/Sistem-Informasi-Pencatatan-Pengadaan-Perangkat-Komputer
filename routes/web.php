<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
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

Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/about', [UserController::class, 'about'])->name('about');

Route::controller(AuthController::class)->group(function () {
    Route::get('register', 'register')->name('register');
    Route::post('register', 'registerSave')->name('register.save');

    Route::get('login', 'login')->name('login');
    Route::post('login', 'loginAction')->name('login.action');

    Route::get('logout', 'logout')->middleware('auth')->name('logout');
});

// Normal Users Routes List
Route::middleware(['auth', 'user-access:user'])->group(function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::get('/profile', [UserController::class, 'userprofile'])->name('profile');
    Route::get('/product', [ProductController::class, 'index'])->name('product');

});
Route::get('/search', [ProductController::class, 'search'])->name('search');
// Admin Routes List
Route::middleware(['auth', 'user-access:admin'])->group(function () {
    Route::get('/admin/home', [HomeController::class, 'adminHome'])->name('admin/home');

    // Manajemen Pengguna
    Route::get('/admin/users', [HomeController::class, 'adminUser'])->name('admin/users/index');
    Route::get('/admin/users/create', [HomeController::class, 'createUser'])->name('admin/users/create');
    Route::post('/admin/users', [HomeController::class, 'storeUser'])->name('admin/users/store');
    Route::get('/admin/users/edit/{id}', [HomeController::class, 'editUser'])->name('admin.users.edit'); 
    Route::put('/admin/users/update/{id}', [HomeController::class, 'updateUser'])->name('admin.users.update');
    Route::delete('/admin/users/delete/{id}', [HomeController::class, 'deleteUser'])->name('admin.users.delete');

    // Manajemen Produk
    Route::get('/admin/products', [ProductController::class, 'index'])->name('admin/products');
    Route::get('/admin/products/create', [ProductController::class, 'create'])->name('admin/products/create');
    Route::post('/admin/products/store', [ProductController::class, 'store'])->name('admin/products/store');
    Route::get('/admin/products/show/{id}', [ProductController::class, 'show'])->name('admin/products/show');
    Route::get('/admin/products/edit/{id}', [ProductController::class, 'edit'])->name('admin/products/edit');
    Route::put('/admin/products/edit/{id}', [ProductController::class, 'update'])->name('admin/products/update');
    Route::delete('/admin/products/destroy/{id}', [ProductController::class, 'destroy'])->name('admin/products/destroy');
    Route::get('/admin/products/cetakPdf', [ProductController::class, 'cetakPdf'])->name('cetak')->middleware('auth');
    Route::get('/search', [ProductController::class, 'search'])->name('search');
    Route::get('/admin/products', [ProductController::class, 'index'])->name('admin/products');

    // Profil Admin
    Route::get('/admin/profile', [AdminController::class, 'profilepage'])->name('admin/profile');
});
