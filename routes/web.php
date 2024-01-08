<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\Logincontroller;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategroyController;
use App\Http\Controllers\DiscountController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\subscriptionController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VeriantController;
use App\Http\Controllers\WebHooksController;
use Illuminate\Support\Facades\Route;
use Stripe\Service\SubscriptionItemService;

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

Route::get('/', [Logincontroller::class, 'welcome']);

Route::get('/login', [Logincontroller::class, 'login_form'])->name('login');
Route::get('/register', [Logincontroller::class, 'register_form'])->name('register');

Route::post('/login', [Logincontroller::class, 'login'])->name('user.login');
Route::post('/register', [Logincontroller::class, 'register'])->name('user.register');

Route::group(['middleware' => ["auth"]], function () {
    Route::group(['middleware' => ["admin"]], function () {

        Route::group(['prefix' => 'categroy'], function () {
            Route::get('create', [CategroyController::class, 'create'])->name('categroy.create');
            Route::post('store', [CategroyController::class, 'store'])->name('categroy.store');
            Route::get('list', [CategroyController::class, 'index'])->name('categroy.list');
            Route::get('edit/{id}', [CategroyController::class, 'edit'])->name('categroy.edit');
            Route::post('update', [CategroyController::class, 'update'])->name('categroy.update');
            Route::get('delete/{id}', [CategroyController::class, 'destroy'])->name('categroy.delete');
        });
        Route::group(['prefix' => 'service'], function () {
            Route::get('create', [ServiceController::class, 'create'])->name('service.create');
            Route::post('store', [ServiceController::class, 'store'])->name('service.store');
            Route::get('list', [ServiceController::class, 'index'])->name('service.list');
            Route::get('edit/{id}', [ServiceController::class, 'edit'])->name('service.edit');
            Route::post('update', [ServiceController::class, 'update'])->name('service.update');
            Route::get('delete/{id}', [ServiceController::class, 'destroy'])->name('service.delete');
        });

        Route::group(['prefix' => 'product'], function () {
            Route::get('create', [ProductController::class, 'create'])->name('product.create');
            Route::post('store', [ProductController::class, 'store'])->name('product.store');
            Route::get('list', [ProductController::class, 'index'])->name('product.list');
            Route::get('edit/{id}', [ProductController::class, 'edit'])->name('product.edit');
            Route::post('update', [ProductController::class, 'update'])->name('product.update');
            Route::get('delete/{id}', [ProductController::class, 'destroy'])->name('product.delete');
        });

        Route::group(['prefix' => 'discount'], function () {
            Route::get('create', [DiscountController::class, 'create'])->name('discount.create');
            Route::post('store', [DiscountController::class, 'store'])->name('discount.store');
            Route::get('list', [DiscountController::class, 'index'])->name('discount.list');
            Route::get('edit/{id}', [DiscountController::class, 'edit'])->name('discount.edit');
            Route::post('update', [DiscountController::class, 'update'])->name('discount.update');
            Route::get('delete/{id}', [DiscountController::class, 'destroy'])->name('discount.delete');
            Route::post('/amount', [DiscountController::class, 'discountAmount'])->name('discount.amount');
        });

        Route::group(['prefix' => 'user'], function () {
            Route::get('create', [UserController::class, 'create'])->name('user.create');
            Route::post('store', [UserController::class, 'store'])->name('user.store');
            Route::get('list', [UserController::class, 'index'])->name('user.list');
            Route::get('edit/{id}', [UserController::class, 'edit'])->name('user.edit');
            Route::post('update', [UserController::class, 'update'])->name('user.update');
            Route::get('delete/{id}', [UserController::class, 'destroy'])->name('user.delete');
            Route::get('details', [UserController::class, 'deatils'])->name('user.details');
            Route::post('update/details', [UserController::class, 'updateDeatils'])->name('update.details');
        });

        Route::group(['prefix' => 'subscription'], function () {
            Route::get('', [subscriptionController::class, 'showpage'])->name('subscription');
            Route::get('/payment', [subscriptionController::class, 'payment'])->name('subscription.payment');
            Route::get('/payment/success', [subscriptionController::class, 'paymentSuccess'])->name('subscription.payment.success');
            Route::get('/payment/cancel', [subscriptionController::class, 'paymentCancel'])->name('subscription.payment.cancel');
            
        });
        Route::get('dashboard/edit', [AdminController::class, 'dashboardEdit'])->name('dashboard.edit');
        Route::post('dashboard/edit', [AdminController::class, 'titleNameChange'])->name('title.change');

        Route::get('admin/index', [Logincontroller::class, 'adminIndex'])->name('admin.index');
        Route::get('user/index', [Logincontroller::class, 'userIndex'])->name('user.index');

        Route::get('logout', [Logincontroller::class, 'logout'])->name('logout');
        Route::get('/feedback', [Logincontroller::class, 'feedback']);

        Route::get('add/cart/{id}', [CartController::class, 'addToCart'])->name('cart.add');
        Route::get('add/to/cart', [CartController::class, 'addToCartPage'])->name('add.cart.page');
        Route::post('update/cart', [CartController::class, 'updateCart'])->name('cart.update');
        Route::get('delete/cart', [CartController::class, 'deleteCart'])->name('cart.delete');
        
        Route::get('delivery/fee', [AdminController::class, 'deliveryFee'])->name('delivery.fee');
        Route::post('delivery/fee', [AdminController::class, 'deliveryFeeStore'])->name('delivery.fee.store');
        Route::get('delivery/fee/delete', [AdminController::class, 'deliveryFeeDelete'])->name('delivery.fee.delete');
        Route::get('order/summery', [AdminController::class, 'orderSummery'])->name('order.summery');
        Route::get('single/product', [ProductController::class, 'singleProduct'])->name('single.product');

    });
    Route::get('all/product', [ProductController::class, 'allProduct'])->name('product.all');
    Route::get('category/product', [ProductController::class, 'categoryProduct'])->name('category.product');
    Route::get('check/out', [PaymentController::class, 'checkOut'])->name('check.out');
    Route::get('stripe/pay',[PaymentController::class,'index'])->name('stripe');
    Route::get('/success',[PaymentController::class,'success'])->name('success');
    Route::get('/cancel',[PaymentController::class,'cancel'])->name('cancel');
    Route::get('/order/success',[ProductController::class,'orderSuccess'])->name('order.success');
    Route::get('/order/details',[ProductController::class,'orderSuccess'])->name('order.success');
    Route::post('/success/razorpay',[PaymentController::class,'store'])->name('success.razorpay');
    
    Route::get('variant/list',[VeriantController::class,'index'])->name('veriant.index');
    Route::get('variant/create',[VeriantController::class,'create'])->name('veriant.create');
    Route::post('variant/store',[VeriantController::class,'store'])->name('veriant.store');
    Route::get('variant/edit',[VeriantController::class,'edit'])->name('veriant.edit');
    Route::post('variant/update',[VeriantController::class,'update'])->name('veriant.update');
    Route::get('variant/delete',[VeriantController::class,'destroy'])->name('veriant.delete');
    
    Route::get('variant/value/create',[VeriantController::class,'valuecreate'])->name('veriant.value.add');
    Route::post('variant/value/store',[VeriantController::class,'valuestore'])->name('variant.value.store');
    Route::post('variant/value/delete',[VeriantController::class,'valuedelete'])->name('variant.value.delete');
    Route::get('variant/value',[VeriantController::class,'valueview'])->name('veriant.value');
    Route::post('product/variant/store',[VeriantController::class,'Productstvaore'])->name('product.variant.store');
    Route::get('variant/value/data',[ProductController::class,'variantValue'])->name('variant.value.data');
    Route::get('Product/value/data',[ProductController::class,'productVariantValue'])->name('product.variant.value');
    Route::get('Product/value/delete',[ProductController::class,'productVariantDelete'])->name('product.variant.delete');
    
});
Route::post('stripe/webhook', [WebHooksController::class, 'handleWebhook']);
Route::get('sub_cancel', [subscriptionController::class, 'sub_cancel'])->name('sub.cancel');
Route::get('stop/cancel', [subscriptionController::class, 'stopCancel'])->name('stop.cancel');

Route::get('forget/password', [Logincontroller::class, 'forgetPasswordpage'])->name('forget.password.page');
Route::post('forget/password', [Logincontroller::class, 'forgetPassword'])->name('forget.password');
Route::get('change/password', [Logincontroller::class, 'changePasswordPage'])->name('change.password.page');
Route::post('change/password', [Logincontroller::class, 'changePassword'])->name('change.password');

   