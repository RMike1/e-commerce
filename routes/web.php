<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AgentController;
use App\Http\Controllers\AdminController;


Route::get('/', function () {
    return view('welcome');
});

Auth::routes();


//=====================================user Routes============================================

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::post('products', [HomeController::class, 'Product_Category'])->name('product.category');

Route::get('products', [HomeController::class, 'Product_Category'])->name('product.category');

Route::get('product/{id}', [HomeController::class, 'Check_Product'])->name('user.product');

Route::get('cart',[HomeController::class,'ProductCart'])->name('cart')->middleware('auth');

Route::post('add/cart',[HomeController::class,'Add_Cart'])->name('add.cart')->middleware('auth');

Route::post('update/cart',[HomeController::class,'Update_Cart'])->name('update.cart')->middleware('auth');

Route::get('cart/data',[HomeController::class,'Cart_Data'])->name('alldata.cart')->middleware('auth');

Route::get('remove/cart',[HomeController::class,'Remove_Cart'])->name('remove.cart')->middleware('auth');

Route::get('load/more',[HomeController::class,'Load_More_Products'])->name('load.more');

Route::get('less/product',[HomeController::class,'Less_Products'])->name('less.product');

Route::get('sort/category',[HomeController::class,'Sort_By_Category'])->name('sort.category');

Route::get('reset_sort/category',[HomeController::class,'Reset_Sort_By_Category'])->name('reset.sort_by_category');

Route::get('search',[HomeController::class,'Search_Product'])->name('search.product');

Route::get('checkout',[HomeController::class,'Checkout'])->name('checkout');

Route::post('shipping',[HomeController::class,'Shipping'])->name('shipping');


//=====================================Agent Routes============================================

Route::prefix('agent')->middleware(['auth','Agent'])->group(function () {

Route::get('agent/create',[AgentController::class,'create']);

Route::get('agent-dashboard', [AgentController::class, 'index'])->name('agent-dashboard');

});
//=====================================Admin Routes============================================

Route::prefix('admin')->middleware(['auth','Admin'])->group(function () {

Route::get('admin-dashboard', [AdminController::class, 'index'])->name('admin-dashboard');

Route::get('products', [AdminController::class, 'Products'])->name('products');

Route::get('category', [AdminController::class, 'category'])->name('category');

Route::post('store/category', [AdminController::class, 'Store_Category'])->name('store.category');

Route::post('udpate/category', [AdminController::class, 'Update_Category'])->name('update.category');

Route::get('delete/{id}/category', [AdminController::class, 'Delete_Category'])->name('delete.category');

Route::get('edit-category', [AdminController::class, 'Edit_Category'])->name('edit.category');

Route::get('add-product', [AdminController::class, 'Add_Products'])->name('add.product');

Route::post('upload', [AdminController::class, 'ProductDescription'])->name('upload');

Route::post('store/product', [AdminController::class, 'Store_Product'])->name('store.product');

Route::get('edit/{id}/product', [AdminController::class, 'Edit_Product'])->name('edit.product');

Route::post('update/product', [AdminController::class, 'Update_Product'])->name('update.product');

Route::get('delete/{id}/product', [AdminController::class, 'Delete_Product'])->name('delete.product');

Route::get('view/{id}/product', [AdminController::class, 'View_Product'])->name('view.product');

Route::get('delete/related_images/{id}', [AdminController::class, 'Delete_Related_image'])->name('delete.related_images');
});
