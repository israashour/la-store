<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Front\CartController;
use App\Http\Controllers\Front\CheckoutController;
use App\Http\Controllers\Front\FrontProductsController;
use App\Http\Controllers\Front\HomeController;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;
use Ramsey\Uuid\Codec\OrderedTimeCodec;

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

Route::group(['middleware' => ['auth', 'auth.type:admin,super-admin'], 'prefix' => 'dashboard'], function () {

    Route::get('/', [DashboardController::class, 'index'])->name('index');
    Route::get('profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('profile', [ProfileController::class, 'update'])->name('profile.update');

    Route::get('/categories/trash', [CategoryController::class, 'trash'])->name('categories.trash');
    Route::put('/categories/{category}/restore', [CategoryController::class, 'restore'])->name('categories.restore');
    Route::delete('/categories/{category}/force-delete', [CategoryController::class, 'forceDelete'])->name('categories.force-delete');

    Route::resource('/categories', CategoryController::class);

    Route::get('/products/trash', [ProductController::class, 'trash'])->name('products.trash');
    Route::put('/products/{product}/restore', [ProductController::class, 'restore'])->name('products.restore');
    Route::delete('/products/{product}/force-delete', [ProductController::class, 'forceDelete'])->name('products.force-delete');

    Route::resource('/products', ProductController::class);

    Route::get('/stores/trash', [StoreController::class, 'trash'])->name('stores.trash');
    Route::put('/stores/{store}/restore', [StoreController::class, 'restore'])->name('stores.restore');
    Route::delete('/stores/{store}/force-delete', [StoreController::class, 'forceDelete'])->name('stores.force-delete');

    Route::resource('/stores', StoreController::class);

    Route::resource('/users', UserController::class);

    // Route::patch('/orders/{orderId}/update-status', [OrderController::class, 'updateStatus'])->name('orders.updateStatus');
    Route::resource('/orders', OrderController::class);


});

// Route::get('/dashboard', function () {
//     return view('dashboard.index');
// })->middleware(['auth'])->name('dashboard');
//, 'verified'
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/', [HomeController::class, 'index'])
->name('home');

Route::get('/products', [FrontProductsController::class, 'index'])
->name('products.index');
Route::get('/products/{product:slug}', [FrontProductsController::class, 'show'])
->name('products.show');

Route::post('cart/remove/{id}', [CartController::class, 'removeCartItem'])->name('cart.remove');
Route::resource('cart', CartController::class);

Route::get('checkout', [CheckoutController::class, 'create'])->name('checkout');
Route::post('checkout', [CheckoutController::class, 'store']);

require __DIR__.'/auth.php';

Route::fallback(function () {
    return view('errors/error404');
})->name('404');
Route::get('/error/500', function () {
    return view('errors/error500');
})->name('500');

Route::get('/go-home', function () {
    $previousUrl = request()->query('previous');
    $homeUrl = url('home');
    $dashboardUrl = route('index');

    if ($previousUrl === route('index')) {
        return Redirect::to($dashboardUrl);
    } else {
        return Redirect::to($homeUrl);
    }

    return Redirect::to($previousUrl);
})->name('go-home');
