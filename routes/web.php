<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\SubCategoryController;
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

Route::get('contact', [FrontendController::class, 'contact'])->name('contact');
// Route::get('about',[FrontendController::class,'about'])->name('about');


Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');
Route::get('/categories', [CategoryController::class, 'Category'])->name('categories');
Route::get('/add-categories', [CategoryController::class, 'CategoryForm'])->name('categoryform');
Route::post('/post-category', [CategoryController::class, 'PostCategory'])->name('postCategory');

Route::get('/delete-category/{data}', [CategoryController::class, 'DeleteCategory'])->name('deletecategory');
Route::get('/edit-category/{data}', [CategoryController::class, 'EditCategory'])->name('editcategory');
Route::post('/update-category', [CategoryController::class, 'UpdateCategory'])->name('updatecategory');
Route::get('/trashed-categories', [CategoryController::class, 'TrashCategory'])->name('trashcategory');
Route::get('/restore-categories/{data}', [CategoryController::class, 'RestoreCategory'])->name('restorecategory');
Route::get('/Permanent-delete-categories/{data}', [CategoryController::class, 'PermanentDeleteCategory'])->name('permanentdeletecategory');

Route::get('/subcategories', [SubCategoryController::class, 'Subcategories'])->name('Subcategories');
Route::get('/add-subcategory', [SubCategoryController::class, 'AddSubcategories'])->name('addSubcategory');
Route::post('/post-subcategory', [SubCategoryController::class, 'PostSubcategories'])->name('postSubcategory');


require __DIR__ . '/auth.php';
