<?php

namespace App\Providers;

use App\Models\Admin\ContactInfo;
use App\Models\Admin\LogoManage;
use App\Models\Admin\Menu;
use App\Models\Admin\SocialIcon;
use App\Models\Client\CustomerRegistration;
use App\Models\ShippingOffer;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Cart;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer('*', function ($view) {
            $view->with('Logo', LogoManage::where('id','1')->first());
            $view->with('ContactInfo', ContactInfo::where('id','1')->first());
            $view->with('main', Menu::orderBy('sequence','ASC')->where('display',1)->get());
            $view->with('information', Menu::orderBy('sequence','ASC')->where('important_link','important_link')->get());
            $view->with('MyAccount', Menu::orderBy('sequence','ASC')->where('my_account','my_account')->get());
            $view->with('CustomerSer', Menu::orderBy('sequence','ASC')->where('customer_service','customer_service')->get());
            $view->with('social',SocialIcon::get());
            $view->with('custo_info',CustomerRegistration::where('id',Session::get('customer_id'))->first());
            $view->with('count',Cart::count());
            $view->with('shipping_offer',ShippingOffer::where('id','1')->first());


        });
    }
}
