<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Client\FontController;
use App\Http\Controllers\Admin\PageController;
use App\Http\Controllers\Client\CartController;
use App\Http\Controllers\Client\CouponApplayController;
use App\Http\Controllers\Client\CustomerRegistrationLoginController;
use App\Http\Controllers\Client\CustomerDashboardController;
use App\Http\Controllers\Client\DefaultController;
use App\Http\Controllers\Client\PaymentController;
use App\Http\Controllers\Client\SuccessPageController;
use App\Http\Controllers\Client\OrderController;


/*
|--------------------------------------------------------------------------
| Client Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/',function(){

    return view('ClientSite.single_page.add_more');

});

Route::get('/',[FontController::class,'MainIndex'])->name('MainIndex');



Route::get('/single-product/{slug}',[FontController::class,'SinglePorduct'])->name('SinglePorduct');
Route::get('/filter-auto-search/',[FontController::class,'FilterSearchProd'])->name('FilterSearchProd');

Route::get('page/{slug}',[PageController::class,'details'])->name('page.details');

//..................................Testign Axios..........................
Route::get('axios_cart_count',[FontController::class,'AxiosCartCount'])->name('AxiosCartCount');
Route::get('axios_get_cart',[FontController::class,'AxiosGetCart'])->name('AxiosGetCart');

//.................................Page Details.....................
Route::get('page/{slug}',[PageController::class,'details'])->name('page.details');
//......................Small Shopping Cart...........................
Route::get('small_shopping_cart_count',[FontController::class,'SmallShoppingCartCount'])->name('SmallShoppingCartCount');

//.........................Card Add Product.......................
Route::post('/add-cart',[CartController::class,'AddCart'])->name('AddCart');
Route::get('/shopping-cart-page',[FontController::class,'ShoppingCart'])->name('ShoppingCart');
Route::get('/shopping-ajax-cart-page',[CartController::class,'ShoppingCartAjaxPage'])->name('ShoppingCartAjaxPage');
Route::get('/ajax-checkout-button-total-price-page',[CartController::class,'AjaxCheckoutSubtotalPage'])->name('AjaxCheckoutSubtotalPage');
Route::get('/shopping-decrement',[CartController::class,'ShoppingCartDecrement'])->name('ShoppingCartDecrement');
Route::get('/shopping-increment',[CartController::class,'ShoppingCartIncrement'])->name('ShoppingCartIncrement');
Route::get('/shopping-remove',[CartController::class,'ShoppingCartRemove'])->name('ShoppingCartRemove');
//..............................Coupon Applay Controller ...................
Route::post('/coupon-applay',[CouponApplayController::class,'CouponApplay'])->name('CouponApplay');

//.......................Order Traking...................
Route::get('/OrderTraking',[FontController::class,'OrderTraking'])->name('OrderTraking');

//.........................All Product Page..........................
Route::get('/shop-page',[FontController::class,'ShopPage'])->name('ShopPage');
Route::get('/category-shop-page/{id}',[FontController::class,'CategoryShopPage'])->name('CategoryShopPage');

//....................Fitler Section.................................
Route::get('/shop-page-filer-tag',[FontController::class,'ShopPageFilterTag'])->name('ShopPageFilterTag');
Route::get('/shop-page-filer-color',[FontController::class,'ShopPageFilterColor'])->name('ShopPageFilterColor');
Route::get('/shop-page-filer-polish',[FontController::class,'ShopPageFilterPolish'])->name('ShopPageFilterPolish');
Route::get('/shop-page-filer-price',[FontController::class,'ShopPageFilterPrice'])->name('ShopPageFilterPrice');

//....................Category Shop Fitler Section.................................
Route::get('/category-shop-page-filer-tag',[FontController::class,'CategoryShopPageFilterTag'])->name('CategoryShopPageFilterTag');
Route::get('/category-shop-page-filer-color',[FontController::class,'CategoryShopPageFilterColor'])->name('CategoryShopPageFilterColor');
Route::get('/category-shop-page-filer-polish',[FontController::class,'CategoryShopPageFilterPolish'])->name('CategoryShopPageFilterPolish');
Route::get('/category-shop-page-filer-price',[FontController::class,'CategoryShopPageFilterPrice'])->name('CategoryShopPageFilterPrice');

//.............................Customer Review Section ..................
Route::post('/review-post',[FontController::class,'ReviewPost'])->name('ReviewPost');
//..............................Wishlist Section......................
Route::get('/wishlist-icon/{pro_id}',[FontController::class,'WishlistAdd'])->name('WishlistAdd');


//.........................Customer Section .........................
Route::get('Customer-login-page',[CustomerRegistrationLoginController::class,'CustomerLoginPage'])->name('CustomerLoginPage');
Route::post('Customer-login-post',[CustomerRegistrationLoginController::class,'CustomerLoginPost'])->name('CustomerLoginPost');
Route::get('Customer-Registration-page',[CustomerRegistrationLoginController::class,'CustomerRegistartionPage'])->name('CustomerRegistartionPage');
Route::post('Customer-Registration-post',[CustomerRegistrationLoginController::class,'CustomerRegistartionPost'])->name('CustomerRegistartionPost');

Route::get('checkout-page',[FontController::class,'CustomerCheckoutPage'])->name('CustomerCheckoutPage')->middleware('checkoutPageVerify');

Route::group(['middleware' => 'customer_auth'], function () {

    Route::get('customer-dashboard',[CustomerDashboardController::class,'CustomerDashboard'])->name('CustomerDashboard');
    Route::get('customer-logout/{id}',[CustomerDashboardController::class,'CustomerLogout'])->name('CustomerLogout');

    //................................Customer Profile...................
    Route::post('customer-profile',[CustomerDashboardController::class,'CustomerProfile'])->name('CustomerProfile');
    Route::get('customer-password-page',[CustomerDashboardController::class,'CustomerPasswordPage'])->name('CustomerPasswordPage');
    Route::post('customer-password-post',[CustomerDashboardController::class,'CustomerPasswordPost'])->name('CustomerPasswordPost');

    //..........................Ajax Country To State To Citi.............
    Route::get('country-to-state',[DefaultController::class,'CountryToState'])->name('CountryToState');
    Route::get('state-to-city',[DefaultController::class,'CountryToCity'])->name('CountryToCity');

    //........................Order List Controller......................
    route::get('order-list',[OrderController::class,'customerOrderList'])->name('customerOrderList');
    route::get('order-details/{id}',[OrderController::class,'customerOrderDetails'])->name('customerOrderDetails');
    route::get('order-details-pdf/{id}',[OrderController::class,'customerOrderDetailsPdf'])->name('customerOrderDetailsPdf');

    //........................Wishlist Section........................
    route::get('wishlist-list',[OrderController::class,'customerWishList'])->name('customerWishList');
    route::get('wishlist-delete/{id}',[OrderController::class,'customerWishDelete'])->name('customerWishDelete');



});

//......................Payment Controller.....................
Route::post('payment',[PaymentController::class,'PaymentStore'])->name('PaymentStore');

Route::get('success_page',[SuccessPageController::class,'SuccessPage'])->name('SuccessPage');

