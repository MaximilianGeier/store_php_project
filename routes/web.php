<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\ProductAddController;
use App\Images;
use App\Products;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $products = Products::join('Products_images', 'Products_images.product_id', '=', 'Products.id')
        ->join('Images', 'Images.id', '=', 'Products_images.image_id')
        ->paginate(5);

    $categories = \App\Categories::limit(8)->get('name');
    return view('home', compact('products', 'categories'));
})->name('home');

//catalog
Route::get('/catalog', function () {
    $categories = \App\Categories::get();
    $products = Products::join('Products_images', 'Products_images.product_id', '=', 'Products.id')
        ->join('Images', 'Images.id', '=', 'Products_images.image_id')
        ->get(['Products.*', 'Images.path']);
    return view('catalog', compact('products', 'categories'));
})->name('catalog');

Route::post('/catalog', 'ProductAddController@setFilters')
    ->name('catalog');

Route::post('/search', 'ProductAddController@search')
    ->name('search');

Route::get('/orders', function () {
    $orders = \App\Orders::join('Products', 'Products.id', '=', 'Orders.product_id')
        ->join('Products_images', 'Products_images.product_id', '=', 'Products.id')
        ->join('Images', 'Images.id', '=', 'Products_images.image_id')
        ->where('Orders.user_id', '=', Auth::id())
        ->get(['Orders.*', 'Images.path', 'Products.price', 'Products.name']);
    return view('orders', compact('orders'));
})
    ->middleware('auth')
    ->name('orders');

Route::post('/orders/cancel', 'ProductAddController@cancelOrder')
    ->name('orders.cancel');

//cart
Route::get('/cart', function () {
    $products = \App\Shopping_cart::join('Products', 'Products.id', '=', 'Shopping_cart.product_id')
        ->join('Products_images', 'Products_images.product_id', '=', 'Products.id')
        ->join('Images', 'Images.id', '=', 'Products_images.image_id')
        ->where('Shopping_cart.user_id', '=', Auth::id())
        ->get(['Shopping_cart.id', 'Shopping_cart.ordered_count', 'Products.name', 'Products.price', 'Images.path']);
    return view('shoppingCart', compact('products'));
})
    ->middleware('auth')
    ->name('cart');

//order
Route::post('/order/add', 'ProductAddController@getOrder')
    ->middleware('auth')
    ->name('order.add');

Route::get('/order/add', function () {
    return view('ordering');
})
    ->middleware('auth')
    ->name('order.add');

Route::post('/order/make', 'ProductAddController@makeOrder')
    ->middleware('auth')
    ->name('order.make');

//store page
Route::get('/storegoods', function () {
    $categories = \App\Categories::get();
    $products = Products::join('Products_images', 'Products_images.product_id', '=', 'Products.id')
        ->join('Images', 'Images.id', '=', 'Products_images.image_id')
        ->get(['Products.*', 'Images.path']);
    return view('store', compact('categories', 'products'));
})
    ->name('storegoods');


//product page
Route::get('/product/{id}', 'ProductAddController@getProduct')
    ->name('product');

Route::post('/product/add', 'ProductAddController@addToCart')
    ->middleware('auth')
    ->name('product.add');

//adding product page
Route::get('/store', function () {
    $categories = \App\Categories::get();
    return view('productadd', compact('categories'));
})
    ->middleware('isseller')
    ->name('store');

Route::post('/store/add', 'ProductAddController@upload')
    ->middleware('auth')
    ->name('store.add');

//sign up
Route::get('/register', [RegisterController::class, 'createAccount'])
    ->middleware('guest')
    ->name('register');

Route::post('/register', [RegisterController::class, 'storeAccount'])
    ->middleware('guest');

//log in
Route::get('/login', [LoginController::class, 'createAccount'])
    ->middleware('guest')
    ->name('login');

Route::post('/login', [LoginController::class, 'storeAccount'])
    ->middleware('guest');

Route::get('/logout', function(){
    Auth::logout();
    return Redirect::to('login');
})->name('logout');

//admin panel
Route::get('/admin', function(){
    return view('adminPanel');
})->name('admin');

Route::post('/admin', 'AdminController@changeStatus')
    ->middleware('isadmin')
    ->name('admin');

//profile
Route::get('/profile', function(){
    $user = Auth::user();
    return view('profile', compact('user'));
})->name('profile');

Route::post('/profile', 'UserController@changeData')
    ->middleware('auth')
    ->name('profile');
