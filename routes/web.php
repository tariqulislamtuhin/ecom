<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FrontendController;
use Faker\Guesser\Name;
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

Route::get('/', function () {
    return view('welcome');
});

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth'])->name('dashboard');

Route::get('contact',[FrontendController::class,'contact'])->name('contact');
// Route::get('about',[FrontendController::class,'about'])->name('about');


Route::get('/dashboard',[DashboardController::class,'dashboard'])->name('dashboard');
Route::get('/categories',[CategoryController::class,'Category'])->name('categories');
Route::get('/add-categories',[CategoryController::class,'CategoryForm'])->name('categoryform');
Route::post('/post-category',[CategoryController::class,'PostCategory'])->name('postCategory');


require __DIR__.'/auth.php';
