<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AgentController;
use App\Http\Controllers\StripeController;

// Auth::routes(['verify' => true]);
Auth::routes();

//=====================================user Routes============================================

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::post('products', [HomeController::class, 'Product_Category'])->name('product.category');

Route::get('products', [HomeController::class, 'Product_Category'])->name('user.products');

Route::get('product/{id}', [HomeController::class, 'Check_Product'])->name('user.product');

Route::get('load/more',[HomeController::class,'Load_More_Products'])->name('load.more');

Route::get('less/product',[HomeController::class,'Less_Products'])->name('less.product');

Route::get('sort/category',[HomeController::class,'Sort_By_Category'])->name('sort.category');

Route::get('reset_sort/category',[HomeController::class,'Reset_Sort_By_Category'])->name('reset.sort_by_category');

Route::get('search',[HomeController::class,'Search_Product'])->name('search.product');

Route::post('shipping',[HomeController::class,'Shipping'])->name('shipping');

Route::post('order_by_cash',[HomeController::class,'Order_by_Cash'])->name('order_by_cash');

Route::get('sortby',[HomeController::class,'Sortby'])->name('sortby');

Route::get('change/currency',[HomeController::class,'Change_Currency'])->name('change.currency');

Route::get('change/currency_h',[HomeController::class,'Change_Currency_h'])->name('change.currency_h');

Route::get('change/currency_s',[HomeController::class,'Change_Currency_s'])->name('change.currency_s');

// Route::get('stripe',[StripeController::class,'Stripe'])->name('stripe');

//====

Route::get('cart',[HomeController::class,'ProductCart'])->name('cart')->middleware('auth');

Route::post('add/cart',[HomeController::class,'Add_Cart'])->name('add.cart')->middleware('auth');

Route::post('update/cart',[HomeController::class,'Update_Cart'])->name('update.cart')->middleware('auth');

Route::get('cart/data',[HomeController::class,'Cart_Data'])->name('alldata.cart')->middleware('auth');

Route::get('remove/cart',[HomeController::class,'Remove_Cart'])->name('remove.cart')->middleware('auth');

Route::get('checkout',[HomeController::class,'Checkout'])->name('checkout')->middleware('auth');


//=====================================Agent Routes============================================

Route::prefix('agent')->middleware(['auth','Agent'])->group(function () {

Route::get('products', [AgentController::class, 'Agent_Products'])->name('agent-products');

Route::get('view-product/{id}', [AgentController::class, 'View_Product_Details'])->name('view-product');

Route::get('agent-category', [AgentController::class, 'Agent_Category'])->name('agent.category');

Route::get('purchase/order', [AgentController::class, 'Purchase_Order'])->name('purchase.order');

Route::get('add/purchase-order', [AgentController::class, 'Add_Purchase_Order'])->name('add.purchase-order');

Route::post('store/purchase-order', [AgentController::class, 'Store_Purchase_Order'])->name('store.purchase-order');

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

Route::get('users', [AdminController::class, 'Users'])->name('users');

Route::post('update/user', [AdminController::class, 'Update_User'])->name('update.user');

Route::get('edit/user/{id}', [AdminController::class, 'Edit_User'])->name('edit.user');

Route::post('add/user', [AdminController::class, 'Add_User'])->name('add.user');

Route::get('delete/user/{id}', [AdminController::class, 'Delete_User'])->name('delete.user');

Route::get('orders', [AdminController::class, 'Orders'])->name('orders');

Route::get('view/order/{id}', [AdminController::class, 'View_Order'])->name('view.order');

Route::get('download-invoice/{id}', [AdminController::class, 'Download_Invoice'])->name('download.invoice');

Route::get('view/invoice/{id}', [AdminController::class, 'View_Invoice'])->name('view.invoice');

Route::get('cancel/order/{id}', [AdminController::class, 'Cancel_Order'])->name('cancel.order');

Route::get('approve/order/{id}', [AdminController::class, 'Approve_Order'])->name('approve.order');

Route::get('undo/order/{id}', [AdminController::class, 'Undo_Order'])->name('undo.order');

Route::get('mail/{id}', [AdminController::class, 'Send_Mail'])->name('send.mail');

Route::post('send/mail/{id}', [AdminController::class, 'Send_Mail_Notification'])->name('send.mail_notification');

Route::get('supplier', [AdminController::class, 'View_Supplier'])->name('view.supplier');

Route::post('store/supplier', [AdminController::class, 'Store_Supplier'])->name('store.supplier');

Route::get('edit/supplier', [AdminController::class, 'Edit_Supplier'])->name('edit.supplier');

Route::post('update/supplier', [AdminController::class, 'Update_Supplier'])->name('update.supplier');

Route::get('delete/supplier/{id}', [AdminController::class, 'Delete_Supplier'])->name('delete.supplier');

Route::get('currency', [AdminController::class, 'Currency'])->name('currency');

Route::post('store/currency', [AdminController::class, 'Store_Currency'])->name('store.currency');

Route::get('edit/currency', [AdminController::class, 'Edit_Currency'])->name('edit.currency');

Route::post('update/currency', [AdminController::class, 'Update_Currency'])->name('update.currency');

Route::post('update/currency_status', [AdminController::class, 'Update_Currency_Status'])->name('update.currency_status');

Route::get('delete/currency/{id}', [AdminController::class, 'Delete_Currency'])->name('delete.currency');

});

Route::post('stripe', [StripeController::class, 'stripePost'])->name('stripe.post');
Route::get('stripe', [StripeController::class, 'stripe']);

 