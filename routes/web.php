<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\CouponController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SizeAndColorController;
use App\Http\Controllers\SubCategoryController;
use App\Models\Coupon;
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


// Route::get('contact', [FrontendController::class, 'contact'])->name('contact');
// Route::get('about',[FrontendController::class,'about'])->name('about');

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth'])->name('dashboard');


############################ Frontend Route ############################
Route::get('/', [FrontendController::class, 'Frontend'])->name('Frontend');
Route::get('product-details/{product}/{product_name?}', [FrontendController::class, 'ProductDetails'])->name('ProductDetails');
Route::get('get/color/size/{color_id}/{product_id}', [FrontendController::class, 'GetProduct'])->name('GetProduct');

############################ Cart Route ############################
Route::get('carts/{coupon_name?}', [CartController::class, 'CartView'])->name('CartView');
Route::post('cart/', [CartController::class, 'CartPost'])->name('CartPost');
Route::get('delete-cart/{cart}', [CartController::class, 'DeleteCart'])->name('DeleteCart');


/*
########################################### Backend Start #############################################
*/
############################ Dashboard Routes ############################
Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');

############################ Category Routes ############################
Route::get('/category/trash', [CategoryController::class, 'trash'])->name('category.trash');
Route::get('/restore/categories/{id}', [CategoryController::class, 'RestoreCategory'])->name('restorecategory');
Route::get('/Permanent-delete-categories/{id}', [CategoryController::class, 'PermanentDeleteCategory'])->name('permanentdeletecategory');
Route::resource('category', CategoryController::class);

############################ Sub-Category Routes ############################
Route::get('/Subcategories', [SubCategoryController::class, 'Subcategories'])->name('Subcategories');
Route::get('/Subcategory/create', [SubCategoryController::class, 'AddSubcategories'])->name('addSubcategory');
Route::post('/post-subcategory', [SubCategoryController::class, 'PostSubcategories'])->name('postSubcategory');
Route::post('/post-delete-subcategory', [SubCategoryController::class, 'PosstDeleteAllSubcategories'])->name('PosstDeleteAllSubcategories');
Route::get('/trashed-subcategories', [SubCategoryController::class, 'TrashSubCategory'])->name('trashSubcategory');
Route::get('/edit-subcategories/{subcategory}', [SubCategoryController::class, 'editsubcategories'])->name('editsubcategories');
Route::get('/delete-subcategory/{subcategory}', [SubCategoryController::class, 'Deletesubcategories'])->name('deletesubcategory');
Route::put('/update-subcategories/{subcategory}', [SubCategoryController::class, 'updatesubcategories'])->name('updatesubcategories');
Route::get('/delete-subcategories/{slug}', [SubCategoryController::class, 'PermanentdeleteSubCategory'])->name('PermanentdeleteSubCategory');
Route::get('/restore-subcategories/{slug}', [SubCategoryController::class, 'PermanentrestoreSubCategory'])->name('PermanentrestoreSubCategory');

############################ Product Routes ############################
Route::get('/products', [ProductController::class, 'ViewProducts'])->name('products.view');
Route::get('api/get-subcat-list/{cat_id}', [ProductController::class, 'GetSubCat'])->name('GetSubCat');
Route::post('/add-products', [ProductController::class, 'AddProduct'])->name('AddProduct');
Route::get('/post-products', [ProductController::class, 'ProductForm'])->name('ProductForm');
Route::get('/edit-product/{product}', [ProductController::class, 'EditProduct'])->name('EditProduct');
Route::put('/update-product{product}', [ProductController::class, 'UpdateProduct'])->name('UpdateProduct');
Route::get('/delete-product/{product}', [ProductController::class, 'DeleteProduct'])->name('DeleteProduct');
Route::get('/deleted-product', [ProductController::class, 'TrashedProduct'])->name('TrashedProduct');
Route::get('delete-product-attribute/{id}', [ProductController::class, 'DeleteProductAttribute'])->name('DeleteProductAttribute');
Route::get('delete/permanently/{id}', [ProductController::class, 'clean'])->name('product.clean');

############################ Size And Color Route ############################
Route::get('Size/create/', [SizeAndColorController::class, 'CreateSize'])->name('CreateSize');
Route::post('Size/post/', [SizeAndColorController::class, 'PostSize'])->name('PostSize');
Route::get('Color/create/', [SizeAndColorController::class, 'CreateColor'])->name('CreateColor');
Route::post('Color/post/', [SizeAndColorController::class, 'PostColor'])->name('PostColor');
Route::get('Delete/color/{color}', [SizeAndColorController::class, 'DeleteColor'])->name('DeleteColor');
Route::get('Delete/size/{size}', [SizeAndColorController::class, 'DeleteSize'])->name('DeleteSize');

############################ Coupon Route ############################
Route::post('coupon/destroyall', [CouponController::class, 'destroyAll'])->name('coupon.destroyAll');
Route::get('coupon/trash', [CouponController::class, 'trash'])->name('coupon.trash');
Route::get('coupon/restore/{id}', [CouponController::class, 'restore'])->name('coupon.restore');
Route::get('coupon/clean/{id}', [CouponController::class, 'clean'])->name('coupon.clean');
Route::resource('coupon', CouponController::class,);

############################ Role Route ############################
Route::get('assign/user', [RoleController::class, 'assignUser'])->name('assignuser.index');
Route::post('assign/user', [RoleController::class, 'assignUserStore'])->name('assignuser.store');
Route::get('revoke/{role}/user/{user}', [RoleController::class, 'revokeuser'])->name('revokeuser');
Route::get('add/user', [RoleController::class, 'addUser'])->name('add.user.index');
Route::post('add/user', [RoleController::class, 'UserStore'])->name('add.user.store');
Route::resource('role', RoleController::class);


############################ Checkout Route ############################
Route::get('checkout', [CheckoutController::class, 'checkout'])->name('checkout.index');


require __DIR__ . '/auth.php';
