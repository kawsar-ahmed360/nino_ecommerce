<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Admin\Setting;
use App\Models\Client\CustomerRegistration;
use App\Models\Client\Order;
use App\Models\Client\TopSallerProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class AdminDashboardController extends Controller
{


    public function AdminDashboard(){

        $data['info'] = Admin::where('id',Auth::guard('admin')->user()->id)->first();
        $data['logo'] = Setting::where('id','1')->first();

        $currentDateTime = Carbon::now();
        $data['this_month'] = Order::where('status','2')->where('shipping_status','2')->where('order_complete','2')->whereMonth('created_at',$currentDateTime)->sum('total_ammount');

        //........One Month Ago.....
        $one_month_ago = Carbon::now()->subMonths(1);
        $data['one_month_ago'] = Order::where('status','2')->where('shipping_status','2')->where('order_complete','2')->whereMonth('created_at',$one_month_ago)->sum('total_ammount');
        //........Two Month Ago.....
        $two_month_ago = Carbon::now()->subMonths(2);
        $data['two_month_ago'] = Order::where('status','2')->where('shipping_status','2')->where('order_complete','2')->whereMonth('created_at',$two_month_ago)->sum('total_ammount');

        //........Three Month Ago.....
        $three_month_ago = Carbon::now()->subMonths(3);
        $data['three_month_ago'] = Order::where('status','2')->where('shipping_status','2')->where('order_complete','2')->whereMonth('created_at',$three_month_ago)->sum('total_ammount');
        //........Four Month Ago.....
        $four_month_ago = Carbon::now()->subMonths(4);
        $data['four_month_ago'] = Order::where('status','2')->where('shipping_status','2')->where('order_complete','2')->whereMonth('created_at',$four_month_ago)->sum('total_ammount');
        //........Five Month Ago.....
        $five_month_ago = Carbon::now()->subMonths(5);
        $data['five_month_ago'] = Order::where('status','2')->where('shipping_status','2')->where('order_complete','2')->whereMonth('created_at',$five_month_ago)->sum('total_ammount');
        //........Six Month Ago.....
        $six_month_ago = Carbon::now()->subMonths(6);
        $data['six_month_ago'] = Order::where('status','2')->where('shipping_status','2')->where('order_complete','2')->whereMonth('created_at',$six_month_ago)->sum('total_ammount');
        //........Sevent Month Ago.....
        $seven_month_ago = Carbon::now()->subMonths(7);
        $data['seven_month_ago'] = Order::where('status','2')->where('shipping_status','2')->where('order_complete','2')->whereMonth('created_at',$seven_month_ago)->sum('total_ammount');
        //........Eight Month Ago.....
        $eight_month_ago = Carbon::now()->subMonths(8);
        $data['eight_month_ago'] = Order::where('status','2')->where('shipping_status','2')->where('order_complete','2')->whereMonth('created_at',$eight_month_ago)->sum('total_ammount');
        //........Nine Month Ago.....
        $nine_month_ago = Carbon::now()->subMonths(9);
        $data['nine_month_ago'] = Order::where('status','2')->where('shipping_status','2')->where('order_complete','2')->whereMonth('created_at',$nine_month_ago)->sum('total_ammount');
        //........Ten Month Ago.....
        $ten_month_ago = Carbon::now()->subMonths(10);
        $data['ten_month_ago'] = Order::where('status','2')->where('shipping_status','2')->where('order_complete','2')->whereMonth('created_at',$ten_month_ago)->sum('total_ammount');
        //........Eleven Month Ago.....
        $eleven_month_ago = Carbon::now()->subMonths(11);
        $data['eleven_month_ago'] = Order::where('status','2')->where('shipping_status','2')->where('order_complete','2')->whereMonth('created_at',$eleven_month_ago)->sum('total_ammount');


        //............................Yearliy Amount Report.................

        $thiyear = Carbon::now();
        $data['this_year'] = Order::where('status','2')->where('shipping_status','2')->where('order_complete','2')->whereYear('created_at',$thiyear)->sum('total_ammount');
        //...........One year ago..........
        $one_year_ago = Carbon::now()->subYear(1);
        $data['one_year_ago'] = Order::where('status','2')->where('shipping_status','2')->where('order_complete','2')->whereYear('created_at',$one_year_ago)->sum('total_ammount');
        //...........Two year ago..........
        $two_year_ago = Carbon::now()->subYear(2);
        $data['two_year_ago'] = Order::where('status','2')->where('shipping_status','2')->where('order_complete','2')->whereYear('created_at',$two_year_ago)->sum('total_ammount');
        //...........Three year ago..........
        $three_year_ago = Carbon::now()->subYear(3);
        $data['$three_year_ago'] = Order::where('status','2')->where('shipping_status','2')->where('order_complete','2')->whereYear('created_at',$three_year_ago)->sum('total_ammount');


        //..................days incode...............

        $today = Carbon::now();
        $data['today'] = Order::where('status','2')->where('shipping_status','2')->where('order_complete','2')->whereDate('created_at',$today)->sum('total_ammount');

        $one_day_ago = Carbon::now()->subDay(1);
        $data['one_day_ago'] = Order::where('status','2')->where('shipping_status','2')->where('order_complete','2')->whereDate('created_at',$one_day_ago)->sum('total_ammount');

        $two_day_ago = Carbon::now()->subDay(2);
        $data['two_day_ago'] = Order::where('status','2')->where('shipping_status','2')->where('order_complete','2')->whereDate('created_at',$two_day_ago)->sum('total_ammount');

        $three_day_ago = Carbon::now()->subDay(3);
        $data['three_day_ago'] = Order::where('status','2')->where('shipping_status','2')->where('order_complete','2')->whereDate('created_at',$three_day_ago)->sum('total_ammount');

        $four_day_ago = Carbon::now()->subDay(4);
        $data['four_day_ago'] = Order::where('status','2')->where('shipping_status','2')->where('order_complete','2')->whereDate('created_at',$four_day_ago)->sum('total_ammount');

        $five_day_ago = Carbon::now()->subDay(5);
        $data['five_day_ago'] = Order::where('status','2')->where('shipping_status','2')->where('order_complete','2')->whereDate('created_at',$five_day_ago)->sum('total_ammount');

        $six_day_ago = Carbon::now()->subDay(6);
        $data['six_day_ago'] = Order::where('status','2')->where('shipping_status','2')->where('order_complete','2')->whereDate('created_at',$six_day_ago)->sum('total_ammount');

        $seven_day_ago = Carbon::now()->subDay(7);
        $data['seven_day_ago'] = Order::where('status','2')->where('shipping_status','2')->where('order_complete','2')->whereDate('created_at',$seven_day_ago)->sum('total_ammount');

        $eight_day_ago = Carbon::now()->subDay(8);
        $data['eight_day_ago'] = Order::where('status','2')->where('shipping_status','2')->where('order_complete','2')->whereDate('created_at',$eight_day_ago)->sum('total_ammount');

        $nine_day_ago = Carbon::now()->subDay(9);
        $data['nine_day_ago'] = Order::where('status','2')->where('shipping_status','2')->where('order_complete','2')->whereDate('created_at',$nine_day_ago)->sum('total_ammount');

        $ten_day_ago = Carbon::now()->subDay(10);
        $data['ten_day_ago'] = Order::where('status','2')->where('shipping_status','2')->where('order_complete','2')->whereDate('created_at',$ten_day_ago)->sum('total_ammount');

        $eleven_day_ago = Carbon::now()->subDay(11);
        $data['eleven_day_ago'] = Order::where('status','2')->where('shipping_status','2')->where('order_complete','2')->whereDate('created_at',$eleven_day_ago)->sum('total_ammount');

        $twelve_day_ago = Carbon::now()->subDay(12);
        $data['twelve_day_ago'] = Order::where('status','2')->where('shipping_status','2')->where('order_complete','2')->whereDate('created_at',$twelve_day_ago)->sum('total_ammount');

        $thirteen_day_ago = Carbon::now()->subDay(13);
        $data['thirteen_day_ago'] = Order::where('status','2')->where('shipping_status','2')->where('order_complete','2')->whereDate('created_at',$thirteen_day_ago)->sum('total_ammount');

        $fourteen_day_ago = Carbon::now()->subDay(14);
        $data['fourteen_day_ago'] = Order::where('status','2')->where('shipping_status','2')->where('order_complete','2')->whereDate('created_at',$fourteen_day_ago)->sum('total_ammount');

        $fifteen_day_ago = Carbon::now()->subDay(15);
        $data['fifteen_day_ago'] = Order::where('status','2')->where('shipping_status','2')->where('order_complete','2')->whereDate('created_at',$fifteen_day_ago)->sum('total_ammount');

        $sixteen_day_ago = Carbon::now()->subDay(16);
        $data['sixteen_day_ago'] = Order::where('status','2')->where('shipping_status','2')->where('order_complete','2')->whereDate('created_at',$sixteen_day_ago)->sum('total_ammount');

        $seventeen_day_ago = Carbon::now()->subDay(17);
        $data['seventeen_day_ago'] = Order::where('status','2')->where('shipping_status','2')->where('order_complete','2')->whereDate('created_at',$seventeen_day_ago)->sum('total_ammount');

        $eighteen_day_ago = Carbon::now()->subDay(18);
        $data['eighteen_day_ago'] = Order::where('status','2')->where('shipping_status','2')->where('order_complete','2')->whereDate('created_at',$eighteen_day_ago)->sum('total_ammount');

        $nineteen_day_ago = Carbon::now()->subDay(19);
        $data['nineteen_day_ago'] = Order::where('status','2')->where('shipping_status','2')->where('order_complete','2')->whereDate('created_at',$nineteen_day_ago)->sum('total_ammount');

        $twenty_day_ago = Carbon::now()->subDay(20);
        $data['twenty_day_ago'] = Order::where('status','2')->where('shipping_status','2')->where('order_complete','2')->whereDate('created_at',$twenty_day_ago)->sum('total_ammount');

        $twenty_one_day_ago = Carbon::now()->subDay(21);
        $data['twenty_one_day_ago'] = Order::where('status','2')->where('shipping_status','2')->where('order_complete','2')->whereDate('created_at',$twenty_one_day_ago)->sum('total_ammount');

        $twenty_two_day_ago = Carbon::now()->subDay(22);
        $data['twenty_two_day_ago'] = Order::where('status','2')->where('shipping_status','2')->where('order_complete','2')->whereDate('created_at',$twenty_two_day_ago)->sum('total_ammount');


        //-------------Weekly Income------------------
        $dayOfTheWeek = Carbon::now()->subDays(7);
        $data['last_seve_day_incode'] = Order::where('status','2')->where('shipping_status','2')->where('order_complete','2')->whereDate('created_at','>=',$dayOfTheWeek)->sum('total_ammount');

        $week_fifteen_days = Carbon::now()->subDays(15);
        $data['week_fifteen_days'] = Order::where('status','2')->where('shipping_status','2')->where('order_complete','2')->whereDate('created_at','>=',$week_fifteen_days)->sum('total_ammount');


        //----------------This Week Panding And Confirm Order--------------
        $thikweekconpan = Carbon::now()->subDays(7);
        $data['this_week_confirm_order'] = Order::where('status','2')->where('shipping_status','2')->where('order_complete','2')->whereDate('created_at','>=',$thikweekconpan)->count('id');
        $data['this_week_panding_order'] = Order::where('status','1')->where('shipping_status','1')->where('order_complete','1')->whereDate('created_at','>=',$thikweekconpan)->count('id');


        //----------------This Month Panding And Confirm Order--------------
        $thismonthpandcon = Carbon::now();
        $data['this_month_confirm_order'] = Order::where('status','2')->where('shipping_status','2')->where('order_complete','2')->whereMonth('created_at','>=',$thismonthpandcon)->count('id');
        $data['this_month_panding_order'] = Order::where('status','1')->where('shipping_status','1')->where('order_complete','1')->whereMonth('created_at','>=',$thismonthpandcon)->count('id');


        //----------------This Week Purches Expence--------------
        $thikweekconpan = Carbon::now()->subDays(7);
        $data['last_seven_days_purches_expence'] = Admin\purshes::where('status','1')->whereDate('date','>=',$thikweekconpan)->sum('subtotal');
        $lastfiften_days = Carbon::now()->subDays(15);
        $data['last_fiften_days_purches_expence'] = Admin\purshes::where('status','1')->whereDate('date','>=',$lastfiften_days)->sum('subtotal');

        //----------------Monthly Purches Report----------

        $thismontPurches = Carbon::now();
        $data['this_month_purches_report'] = Admin\purshes::where('status','1')->whereMonth('date',$thismontPurches)->sum('subtotal');

        $one_month_ago_purches_report = Carbon::now()->subMonths(1);
        $data['one_month_ago_purches_report'] = Admin\purshes::where('status','1')->whereMonth('date',$one_month_ago_purches_report)->sum('subtotal');

        $two_month_ago_purches_report = Carbon::now()->subMonths(2);
        $data['two_month_ago_purches_report'] = Admin\purshes::where('status','1')->whereMonth('date',$two_month_ago_purches_report)->sum('subtotal');

        $three_month_ago_purches_report = Carbon::now()->subMonths(3);
        $data['three_month_ago_purches_report'] = Admin\purshes::where('status','1')->whereMonth('date',$three_month_ago_purches_report)->sum('subtotal');

        $four_month_ago_purches_report = Carbon::now()->subMonths(4);
        $data['four_month_ago_purches_report'] = Admin\purshes::where('status','1')->whereMonth('date',$four_month_ago_purches_report)->sum('subtotal');

        $five_month_ago_purches_report = Carbon::now()->subMonths(5);
        $data['five_month_ago_purches_report'] = Admin\purshes::where('status','1')->whereMonth('date',$five_month_ago_purches_report)->sum('subtotal');

        //-------------------Order History----------------
        $data['order']= Order::with('customer')
            ->OrderBy('id','desc')
            ->get();

        //-------------------Top Seller Product ----------------
        $data['top_seller_product'] = TopSallerProduct::with('Product')->OrderBy('qty','desc')->get();

        //..................Purches Manage...........
        $data['purches'] = Admin\purshes::OrderBy('id','desc')->where('status','1')->get();

        //................Total Panding Order...............

        $data['total_panding_order'] = Order::where('status','1')->count('id');
        $data['total_confirmed_order'] = Order::where('status','2')->where('shipping_status','2')->where('order_complete','2')->count('id');
        $data['total_sales_amount'] = Order::where('status','2')->where('shipping_status','2')->where('order_complete','2')->sum('total_ammount');
        $data['total_customer'] = CustomerRegistration::count('id');




        return view('AdminDashboard.main',$data);
    }
}
