<?php

use App\Http\Controllers\ProfileController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return redirect('invoice/create');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

// invoice route
Route::get('invoice/create', 'App\Http\Controllers\InvoiceController@create');
Route::post('invoice/store', 'App\Http\Controllers\InvoiceController@store');
Route::get('invoice/index', 'App\Http\Controllers\InvoiceController@index');
Route::get('invoice/edit/{id}', 'App\Http\Controllers\InvoiceController@edit');
Route::get('invoice/delete/{id}', 'App\Http\Controllers\InvoiceController@delete');
Route::post('invoice/update', 'App\Http\Controllers\InvoiceController@update');

// Route::get('/preview-invoice', function () {
//     return view('emails.invoice_created');
// });