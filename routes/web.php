<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\Employee\EmployeeOrderController;
use App\Http\Controllers\Admin\AdminAdminController;
use App\Http\Controllers\Admin\AdminAuthorController;
use App\Http\Controllers\Admin\AdminBookController;
use App\Http\Controllers\Admin\AdminUserController;
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
/*

Route::get('/', function () {
    return view('welcome');
});
*/
Route::get('/', [HomeController::class, 'index']);


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/book/{id}', [BookController::class, 'show'])->name('book.show');
Route::get('/author/{id}', [AuthorController::class, 'show'])->name('author.show');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/admin', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/employee', [EmployeeController::class, 'dashboard'])->name('employee.dashboard');
    Route::get('/client', [ClientController::class, 'dashboard'])->name('client.dashboard');
    Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/update', [CartController::class, 'update'])->name('cart.update');
    Route::post('/cart/remove', [CartController::class, 'remove'])->name('cart.remove');
    Route::post('/orders/store', [OrderController::class, 'store'])->name('orders.store');
    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
    Route::post('/orders/{order}/pay', [OrderController::class, 'pay'])->name('orders.pay');
    Route::post('/orders/{order}/delete', [OrderController::class, 'delete'])->name('orders.delete');
});
Route::prefix('employee')->middleware(['auth'])->group(function () {
    Route::get('/', [EmployeeOrderController::class, 'index'])->name('employee.dashboard');

    // Trasy zarządzania zamówieniami
    Route::get('/orders', [EmployeeOrderController::class, 'index'])->name('employee.orders.index');
    Route::get('/orders/{order}/edit', [EmployeeOrderController::class, 'edit'])->name('employee.orders.edit');
    Route::post('/orders/{order}', [EmployeeOrderController::class, 'update'])->name('employee.orders.update');
    Route::get('/orders/{order}/details', [EmployeeOrderController::class, 'details'])->name('employee.orders.details');
    Route::post('/orders/{order}/delete', [EmployeeOrderController::class, 'delete'])->name('employee.orders.delete');

});

Route::prefix('admin')->middleware(['auth'])->group(function () {
    Route::get('/', [AdminAdminController::class, 'index'])->name('admin.dashboard');

    // Zarządzanie autorami
    Route::resource('authors', AdminAuthorController::class);

    // Zarządzanie książkami
    Route::resource('books', AdminBookController::class);

    // Zarządzanie użytkownikami
    Route::resource('users', AdminUserController::class);
    Route::get('/authors/{author}', [AdminAuthorController::class, 'show'])->name('authors.show');
    Route::get('/books/{book}', [AdminBookController::class, 'show'])->name('books.show');
    Route::get('/users/{user}', [AdminUserController::class, 'show'])->name('users.show');

});

require __DIR__.'/auth.php';
