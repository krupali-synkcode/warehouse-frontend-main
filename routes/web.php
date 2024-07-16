<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\App;

// Language switch routes
Route::get('language/{locale}', function ($locale) {
    // app()->setLocale($locale);
    App::setLocale($locale);
    session()->put('locale', $locale);

    return redirect()->back();
})->name('language');


// Basic auth routes
Auth::routes();

// Homepage route
Route::get('/', [\App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/warehouse/{id}', [\App\Http\Controllers\WarehouseController::class, 'show'])->name('warehouse.show');

Route::group(['middleware' => ['auth']], function () {

    // User account routes
    Route::group(['prefix' => 'account'], function () {
        Route::get('/', [\App\Http\Controllers\UserController::class, 'profile'])->name('account.profile');
        Route::post('/', [\App\Http\Controllers\UserController::class, 'updateProfile'])->name('account.updateProfile');
        Route::post('/update-password', [\App\Http\Controllers\UserController::class, 'updatePassword'])->name('account.updatePassword');

        // User order routes
        Route::group(['prefix' => 'orders'], function () {
            Route::controller(OrderController::class)->group(function () {
                Route::get('/', 'index')->name('order.index');
                Route::get('/{id}', 'show')->name('order.show');
                Route::post('/{id}/cancel', 'cancelOrder')->name('order.cancel');
            });
        });
    });

    // Cart routes
    Route::group(['prefix' => 'cart'], function () {
        Route::controller(CartController::class)->group(function () {
            Route::post('cart-addons', 'addToCartAddons')->name('cart.addons');
            Route::post('place-order/{cartId}', 'placeOrder')->name('order.confirm');

            Route::get('{id}/review', 'reviewCart')->name('cart.review');
            Route::get('{id}/final-review', 'finalReviewCart')->name('cart.finalReview');
            Route::get('{id}/checkout', 'checkoutView')->name('cart.checkout');
        });
    });
});

// Cart routes
Route::group(['prefix' => 'cart'], function () {
    Route::controller(CartController::class)->group(function () {
        Route::post('add-to-cart', 'addToCart')->name('cart.add');
    });
});
