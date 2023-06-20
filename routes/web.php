<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BooksController;
use App\Http\Controllers\BorrowController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PDFController;
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


Route::middleware(['auth'])->group(function(){
    Route::get('/', function(){
        return redirect()->route('books.index');
    });
    Route::resource("/books", BooksController::class)->scoped([
        'book' => 'slug',
    ]);
    Route::resource("/category", CategoryController::class)->scoped([
        'category' => 'slug',
    ]);
    Route::resource('/borrow', BorrowController::class)->scoped([
        'borrow' => 'kode_peminjaman',
    ]);

    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/generate-pdf/{id}', [PDFController::class, 'generatePDF']);
});
Route::middleware(['guest'])->group(function(){
    Route::get('/login', function () {
        return view('login', [
            'title' => 'Login',
        ]);
    })->name('login');
    Route::post('/login', [AuthController::class, 'login']);

    Route::get('/register', function () {
        return view('register', [
            'title' => 'Register',
        ]);
    })->name('register');
    Route::post('/register', [AuthController::class,'register']);
});
