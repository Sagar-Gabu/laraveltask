<?php

    use App\Http\Controllers\SiteController;
    use Illuminate\Support\Facades\Route;

    Route::get('/', [SiteController::class, 'index'])->name('site.index');
    Route::get('shop', [SiteController::class, 'shop'])->name('site.shop');
    Route::get('{category}/{slug}', [SiteController::class, 'productDetail'])->name('site.productdetail');
    Route::get('shop/category/{slug}', [SiteController::class, 'showProductsByCategory'])->name('site.shop.category');
   
   
    Route::get('add_cart/{id}', [SiteController::class, 'add_cart'])->middleware(['auth', 'verified'])->name('site.add_cart');    


 