@extends('AdminDashboard.master')

@section('title') Nino SuperAdmin Dashboard @endsection

@section('admin-content')



    <!-- Row start -->
    <div class="row gutters">
        <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6 col-12">
            <div class="info-stats4">
                <div class="info-icon">
                    <i class="icon-shopping-cart1"></i>
                </div>
                <div class="sale-num">
                    @if(@$total_panding_order<10)
                    <h3>0{{@$total_panding_order}}</h3>
                    @else
                        <h3>{{@$total_panding_order}}</h3>
                    @endif
                    <p>Panding Order</p>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6 col-12">
            <div class="info-stats4">
                <div class="info-icon">
                    <i class="icon-shopping-cart1"></i>
                </div>
                <div class="sale-num">

                    @if(@$total_confirmed_order<10)
                        <h3>0{{@$total_confirmed_order}}</h3>
                    @else
                        <h3>{{@$total_confirmed_order}}</h3>
                    @endif

                    <p>Compled Orders</p>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6 col-12">
            <div class="info-stats4">
                <div class="info-icon">
                    <i class="icon-shopping-bag1"></i>
                </div>
                <div class="sale-num">
                    <h3>${{@$total_sales_amount}}</h3>
                    <p>Total Sales</p>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6 col-12">
            <div class="info-stats4">
                <div class="info-icon">
                    <i class="icon-activity"></i>
                </div>
                <div class="sale-num">

                    @if(@$total_customer<10)
                        <h3>0{{@$total_customer}}</h3>
                    @else
                        <h3>{{@$total_customer}}</h3>
                    @endif

                    <p>Total Customer</p>
                </div>
            </div>
        </div>
    </div>
    <!-- Row end -->



    <!---------Days And Weekly Income--------->

    <div class="row gutters">
        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-6">

            <div class="card" >
                {{--<a href="#" id="downloadPdf">Download PDF</a>--}}
                <div class="card-header" id="reportPage">
                    <div class="card-title" style="font-family: cursive;">Daily Income

                </div>
                <div class="card-body pt-0">
                    <canvas id="DaysIncome"></canvas>
                </div>
            </div>
        </div>
        </div>

        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-6">
            <div class="card">
                <div class="card-header">
                    <div class="card-title" style="font-family: cursive;">Weekly Income</div>
                </div>
                <div class="card-body pt-0">
                    <canvas id="weeklyincome"></canvas>
                </div>
            </div>
        </div>
    </div>




   <!---------Monthly And Yearly Income--------->
    <div class="row gutters">
        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-6">
            <div class="card">
                <div class="card-header">
                    <div class="card-title" style="font-family: cursive;">Monthly Income</div>
                </div>
                  <div class="card-body pt-0">
                      <canvas id="myChart"></canvas>
                  </div>
             </div>
        </div>

        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-6">
            <div class="card">
                <div class="card-header">
                    <div class="card-title" style="font-family: cursive;">Yearly Income</div>
                </div>
                <div class="card-body pt-0">
                    <canvas id="YearlyChart"></canvas>
                </div>
            </div>
        </div>
    </div>



   <!---------Last 10 Days And Last 20 Dasy Income------------>
    <div class="row gutters">
        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-6">
            <div class="card">
                <div class="card-header">
                    <div class="card-title" style="font-family: cursive;">This week Panding And Confirm Order</div>
                </div>
                <div class="card-body pt-0">
                    <canvas id="weeklyPandingConfirmOrder"></canvas>
                </div>
            </div>
        </div>

        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-6">
            <div class="card">
                <div class="card-header">
                    <div class="card-title" style="font-family: cursive;">This Month Panding && Confirm Order</div>
                </div>
                <div class="card-body pt-0">
                    <canvas id="MontlyPandingConfirmOrder"></canvas>
                </div>
            </div>
        </div>
    </div>



    <!---------Purches Report------------>
    <div class="row gutters">
        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-6">
            <div class="card">
                <div class="card-header">
                    <div class="card-title" style="font-family: cursive;">Last 7 days And Last 15 Days Purches </div>
                </div>
                <div class="card-body pt-0">
                    <canvas id="weeklyPurchesReport"></canvas>
                </div>
            </div>
        </div>

        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-6">
            <div class="card">
                <div class="card-header">
                    <div class="card-title" style="font-family: cursive;">Monthly Puches Report</div>
                </div>
                <div class="card-body pt-0">
                    <canvas id="MontlyPurchesReport"></canvas>
                </div>
            </div>
        </div>
    </div>


    {{--<div class="row gutters">--}}
        {{--<div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-6">--}}
            {{--<div class="card">--}}
                {{--<div class="card-header">--}}
                    {{--<div class="card-title" style="font-family: cursive;">Yearly Income</div>--}}
                {{--</div>--}}
                {{--<div class="card-body pt-0">--}}
                    {{--<canvas id="YearlyChart"></canvas>--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</div>--}}


    {{--</div>--}}




    <!-- Row start -->
    {{--<div class="row gutters">--}}
        {{--<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">--}}
            {{--<div class="card">--}}
                {{--<div class="card-header">--}}
                    {{--<div class="card-title">Visitors</div>--}}
                {{--</div>--}}
                {{--<div class="card-body pt-0">--}}
                    {{--<div id="visitors"></div>--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</div>--}}
    {{--</div>--}}
    <!-- Row end -->


    <!-- Row start -->
    {{--<div class="row gutters">--}}
        {{--<div class="col-xl-4 col-lg-6 col-md-6 col-sm-12 col-12">--}}
            {{--<div class="card">--}}
                {{--<div class="card-header">--}}
                    {{--<div class="card-title">Customers</div>--}}
                {{--</div>--}}
                {{--<div class="card-body">--}}
                    {{--<div id="customers"></div>--}}
                    {{--<!-- Row starts -->--}}
                    {{--<div class="row gutters">--}}
                        {{--<div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-6">--}}
                            {{--<div class="info-stats3 shade-one-a">--}}
                                {{--<i class="icon-opacity"></i>--}}
                                {{--<h6>New</h6>--}}
                                {{--<h3>450</h3>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                        {{--<div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-6">--}}
                            {{--<div class="info-stats3 shade-one-b">--}}
                                {{--<i class="icon-opacity"></i>--}}
                                {{--<h6>Returned</h6>--}}
                                {{--<h3>900</h3>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                    {{--<!-- Row end -->--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</div>--}}
        {{--<div class="col-xl-4 col-lg-6 col-md-6 col-sm-12 col-12">--}}
            {{--<div class="card">--}}
                {{--<div class="card-header">--}}
                    {{--<div class="card-title">Deals</div>--}}
                {{--</div>--}}
                {{--<div class="card-body pt-0 pb-0">--}}
                    {{--<div id="deals"></div>--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</div>--}}
        {{--<div class="col-xl-4 col-lg-12 col-md-12 col-sm-12 col-12">--}}
            {{--<div class="card">--}}
                {{--<div class="card-header">--}}
                    {{--<div class="card-title">Logs</div>--}}
                {{--</div>--}}
                {{--<div class="card-body">--}}
                    {{--<div class="customScroll5">--}}
                        {{--<div class="activity-logs">--}}
                            {{--<div class="activity-log-list">--}}
                                {{--<div class="sts"></div>--}}
                                {{--<div class="log">New item sold</div>--}}
                                {{--<div class="log-time">10:10</div>--}}
                            {{--</div>--}}
                            {{--<div class="activity-log-list">--}}
                                {{--<div class="sts"></div>--}}
                                {{--<div class="log">Notification from bank</div>--}}
                                {{--<div class="log-time">05:25</div>--}}
                            {{--</div>--}}
                            {{--<div class="activity-log-list">--}}
                                {{--<div class="sts red"></div>--}}
                                {{--<div class="log">Transaction success alert</div>--}}
                                {{--<div class="log-time">09:45</div>--}}
                            {{--</div>--}}
                            {{--<div class="activity-log-list">--}}
                                {{--<div class="sts orange"></div>--}}
                                {{--<div class="log">Your item has been updated</div>--}}
                                {{--<div class="log-time">06:50</div>--}}
                            {{--</div>--}}
                            {{--<div class="activity-log-list">--}}
                                {{--<div class="sts"></div>--}}
                                {{--<div class="log">New fffer</div>--}}
                                {{--<div class="log-time">12:30</div>--}}
                            {{--</div>--}}
                            {{--<div class="activity-log-list">--}}
                                {{--<div class="sts orange"></div>--}}
                                {{--<div class="log">Item bought</div>--}}
                                {{--<div class="log-time">04:22</div>--}}
                            {{--</div>--}}
                            {{--<div class="activity-log-list">--}}
                                {{--<div class="sts"></div>--}}
                                {{--<div class="log">New sale: Zyan Ferris</div>--}}
                                {{--<div class="log-time">10:10</div>--}}
                            {{--</div>--}}
                            {{--<div class="activity-log-list">--}}
                                {{--<div class="sts orange"></div>--}}
                                {{--<div class="log">Order Received</div>--}}
                                {{--<div class="log-time">12:55</div>--}}
                            {{--</div>--}}
                            {{--<div class="activity-log-list">--}}
                                {{--<div class="sts"></div>--}}
                                {{--<div class="log">Service information</div>--}}
                                {{--<div class="log-time">09:12</div>--}}
                            {{--</div>--}}
                            {{--<div class="activity-log-list">--}}
                                {{--<div class="sts"></div>--}}
                                {{--<div class="log">Message from Reisnz</div>--}}
                                {{--<div class="log-time">09:27</div>--}}
                            {{--</div>--}}
                            {{--<div class="activity-log-list">--}}
                                {{--<div class="sts red"></div>--}}
                                {{--<div class="log">New item sale: Ali Sayed</div>--}}
                                {{--<div class="log-time">02:39</div>--}}
                            {{--</div>--}}
                            {{--<div class="activity-log-list">--}}
                                {{--<div class="sts orange"></div>--}}
                                {{--<div class="log">Product update</div>--}}
                                {{--<div class="log-time">08:22</div>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</div>--}}
    {{--</div>--}}
    <!-- Row end -->





    <!-- Row start -->
    {{--<div class="row gutters">--}}
        {{--<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">--}}
            {{--<div class="card">--}}
                {{--<div class="card-header">--}}
                    {{--<div class="card-title">Overall Income</div>--}}
                {{--</div>--}}
                {{--<div class="card-body pt-0 pb-0">--}}
                    {{--<div id="income"></div>--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</div>--}}
    {{--</div>--}}
    <!-- Row end -->





    <!-- Row start -->
    <div class="row gutters">
        <div class="col-xl-4 col-lg-6 col-md-6 col-sm-6 col-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">Top Seller Product</div>
                </div>
                <div class="card-body">
                    <div class="customScroll5">
                        <div class="quick-analytics">
                            @foreach(@$top_seller_product as $pro)
                            <a href="#">
                                <img style="width: 50px" src="{{(@$pro->Product->image)?url('upload/Client/Product/'.@$pro->Product->image):''}}" alt="">  &nbsp;&nbsp; &nbsp; <span style="font-size: 19px;font-family: cursive;">{{@$pro->Product->product_name}}</span> <span style="background: red;padding:3px;color:white;border-radius: 50%;margin-bottom: 21px;">{{@$pro->qty}}</span>
                            </a>
                                <hr>
                            @endforeach

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-4 col-lg-6 col-md-6 col-sm-6 col-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">Purches Report</div>
                </div>
                <div class="card-body">
                    <div class="customScroll5">
                        <ul class="project-activity">

                            @foreach(@$purches as $pur)
                            <li class="activity-list">
                                <div class="detail-info">
                                    <p class="date">{{date('d M Y',strtotime(@$pur->date))}}</p>
                                    <p class="info">Subtotal: ${{@$pur->subtotal}}</p>
                                </div>
                            </li>

                                @endforeach

                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-4 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">Order History</div>
                </div>
                <div class="card-body">
                    <div class="customScroll5">
                        <ul class="user-messages">


                            @foreach(@$order as $order)
                            <li class="clearfix">
                                <div class="customer">{{str_limit(@$order->customer->name,2)}}</div>
                                <div class="delivery-details">
                                    @if(@$order->status==2 && @$order->shipping_status==2 && @$order->order_complete==2)
                                    <span class="badge badge-primary">Order Complete</span>
                                        @elseif(@$order->status==2 && @$order->shipping_status==2)
                                        <span class="badge badge-primary">Order Shiped</span>
                                       @elseif(@$order->status==2)
                                         <span class="badge badge-primary">Order Approved</span>
                                        @else
                                        <span class="badge badge-primary">Order Panding</span>
                                        @endif
                                    <h5>{{@$order->customer->name}}</h5>
                                    <p>Mobile: {{@$order->customer->mobile}}</p>
                                </div>
                            </li>

                            @endforeach

                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Row end -->





    @section('footer')

            <script>
            const ctx = document.getElementById('myChart').getContext('2d');
            const myChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: ['This Month', '1 Month ago', '2 Month Ago', '3 Month Ago', '4 Month Ago', '5 Month Ago','6 Month Ago','7 Month Ago','8 Month Ago','9 Month Ago','10 Month Ago','11 Month Ago'],
                    datasets: [{
                        label: '# Month Income',
                        data: [{{$this_month}}, {{$one_month_ago}},{{$two_month_ago}},{{@$three_month_ago}},{{$four_month_ago}},{{$five_month_ago}},{{@$six_month_ago}},{{@$seven_month_ago}},{{@$eight_month_ago}},{{@$nine_month_ago}},'{{@$ten_month_ago}}',{{@$eleven_month_ago}}],
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.2)',
                            'rgba(54, 162, 235, 0.2)',
                            'rgba(255, 206, 86, 0.2)',
                            'rgba(75, 192, 192, 0.2)',
                            'rgba(153, 102, 255, 0.2)',
                            'rgba(255, 159, 64, 0.2)',
                            'rgba(255, 159, 64, 0.2)',
                            'rgba(255, 159, 64, 0.2)',
                            'rgba(255, 159, 64, 0.2)',
                            'rgba(255, 159, 64, 0.2)',
                            'rgba(255, 159, 64, 0.2)',
                            'rgba(255, 159, 64, 0.2)',
                        ],
                        borderColor: [
                            'rgba(255, 99, 132, 1)',
                            'rgba(54, 162, 235, 1)',
                            'rgba(255, 206, 86, 1)',
                            'rgba(75, 192, 192, 1)',
                            'rgba(153, 102, 255, 1)',
                            'rgba(255, 159, 64, 1)',
                            'rgba(75, 192, 192, 1)',
                            'rgba(54, 162, 235, 1)',
                            'rgba(75, 192, 192, 1)',
                            'rgba(255, 99, 132, 1)',
                            'rgba(255, 99, 132, 1)',
                            'rgba(54, 162, 235, 1)',
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        </script>


            <script>
            const ctxyearly = document.getElementById('YearlyChart').getContext('2d');
            const YearlyChart = new Chart(ctxyearly, {
                type: 'bar',
                data: {
                    labels: ['This Year', '1 Year ago', '2 Year Ago', '3 Year Ago'],
                    datasets: [{
                        label: '# Yearly Income',
                        data: [{{$this_year}}, {{$one_year_ago}},{{$two_year_ago}},{{@$three_year_ago}}],
                        backgroundColor: [
                            'rgba(54, 162, 235, 0.2)',
                            'rgba(255, 206, 86, 0.2)',
                            'rgba(75, 192, 192, 0.2)',
                            'rgba(153, 102, 255, 0.2)',

                        ],
                        borderColor: [
                            'rgba(255, 99, 132, 1)',
                            'rgba(54, 162, 235, 1)',
                            'rgba(255, 206, 86, 1)',
                            'rgba(75, 192, 192, 1)',
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        </script>

            <!------Days And Weekly Income ChartjsJs---------->

            <script>
                const Daysinc = document.getElementById('DaysIncome').getContext('2d');
                const DaysIncome = new Chart(Daysinc, {
                    type: 'bar',
                    data: {
                        labels: ['Today','1 day ago','2 day ago','3 day ago','4 day ago','5 day ago','6 day ago','7 day ago','8 day ago','9 day ago','10 day ago','11 day ago','12 day ago','13 day ago','15 day ago','16 day ago','17 day ago','18 day ago','19 day ago','20 day ago','21 day ago','22 day ago'],
                        datasets: [{
                            label: '# Month Income',



                            data: [{{$today}},{{$one_day_ago}},{{$two_day_ago}},{{$three_day_ago}},{{$four_day_ago}},{{$five_day_ago}},{{$six_day_ago}},{{$seven_day_ago}},{{$eight_day_ago}},{{$nine_day_ago}},{{$ten_day_ago}},{{$eleven_day_ago}},{{$twelve_day_ago}},{{$thirteen_day_ago}},{{$fourteen_day_ago}},{{$fifteen_day_ago}},{{$sixteen_day_ago}},{{$seventeen_day_ago}},{{$eighteen_day_ago}},{{$nineteen_day_ago}},{{$twenty_day_ago}},{{$twenty_one_day_ago}},{{$twenty_two_day_ago}}],
                            backgroundColor: [
                                'rgba(255, 99, 132, 0.2)',
                                'rgba(54, 162, 235, 0.2)',
                                'rgba(255, 206, 86, 0.2)',
                                'rgba(75, 192, 192, 0.2)',
                                'rgba(153, 102, 255, 0.2)',
                                'rgba(255, 159, 64, 0.2)',
                                'rgba(255, 159, 64, 0.2)',
                                'rgba(255, 159, 64, 0.2)',
                                'rgba(255, 159, 64, 0.2)',
                                'rgba(255, 159, 64, 0.2)',
                                'rgba(255, 159, 64, 0.2)',
                                'rgba(255, 159, 64, 0.2)',
                                'rgba(255, 99, 132, 0.2)',
                                'rgba(54, 162, 235, 0.2)',
                                'rgba(255, 206, 86, 0.2)',
                                'rgba(75, 192, 192, 0.2)',
                                'rgba(153, 102, 255, 0.2)',
                                'rgba(255, 159, 64, 0.2)',
                                'rgba(255, 159, 64, 0.2)',
                                'rgba(255, 159, 64, 0.2)',
                                'rgba(255, 159, 64, 0.2)',
                                'rgba(255, 159, 64, 0.2)',
                                'rgba(255, 159, 64, 0.2)',
                            ],
                            borderColor: [
                                'rgba(255, 99, 132, 1)',
                                'rgba(54, 162, 235, 1)',
                                'rgba(255, 206, 86, 1)',
                                'rgba(75, 192, 192, 1)',
                                'rgba(153, 102, 255, 1)',
                                'rgba(255, 159, 64, 1)',
                                'rgba(75, 192, 192, 1)',
                                'rgba(54, 162, 235, 1)',
                                'rgba(75, 192, 192, 1)',
                                'rgba(255, 99, 132, 1)',
                                'rgba(255, 99, 132, 1)',
                                'rgba(54, 162, 235, 1)',
                                'rgba(255, 99, 132, 1)',
                                'rgba(54, 162, 235, 1)',
                                'rgba(255, 206, 86, 1)',
                                'rgba(75, 192, 192, 1)',
                                'rgba(153, 102, 255, 1)',
                                'rgba(255, 159, 64, 1)',
                                'rgba(75, 192, 192, 1)',
                                'rgba(54, 162, 235, 1)',
                                'rgba(75, 192, 192, 1)',
                                'rgba(255, 99, 132, 1)',
                                'rgba(255, 99, 132, 1)',
                            ],
                            borderWidth: 1
                        }]
                    },
                    options: {
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        }
                    }
                });
            </script>



            <script>
                const weeklyinc = document.getElementById('weeklyincome').getContext('2d');
                const weeklyincome = new Chart(weeklyinc, {
                    type: 'bar',
                    data: {
                        labels: ['Last 7 Days Income','Last 15 days income'],
                        datasets: [{
                            label: '# Weekly Income',
                            data: [{{$last_seve_day_incode}},{{$week_fifteen_days}}],
                            backgroundColor: [
                                'rgba(54, 162, 235, 0.2)',
                                'rgba(255, 206, 86, 0.2)',
                                'rgba(75, 192, 192, 0.2)',
                                'rgba(153, 102, 255, 0.2)',

                            ],
                            borderColor: [
                                'rgba(255, 99, 132, 1)',
                                'rgba(54, 162, 235, 1)',
                                'rgba(255, 206, 86, 1)',
                                'rgba(75, 192, 192, 1)',
                            ],
                            borderWidth: 1
                        }]
                    },
                    options: {
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        }
                    }
                });
            </script>



            <!--------Another Chatrs--------->

            <script>
                const ctxjs = document.getElementById('weeklyPandingConfirmOrder').getContext('2d');
                const weeklyPandingConfirmOrder = new Chart(ctxjs, {
                    type: 'doughnut',
                    data: {
                        labels: ['panding Order','Confirm Order'],
                        datasets: [{
                            label: '# Panding && Confirm Order',
                            data: [{{$this_week_panding_order}}, {{$this_week_confirm_order}}],
                            backgroundColor: [
                                'rgba(255, 99, 132, 0.2)',
                                'rgba(215, 236, 251)',

                            ],
                            borderColor: [
                                'rgba(255, 99, 132, 1)',
                                'rgba(54, 162, 235, 1)',

                            ],
                            borderWidth: 1
                        }]
                    },
                    options: {
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        }
                    }
                });
            </script>

            <script>
                const monthpandcon = document.getElementById('MontlyPandingConfirmOrder').getContext('2d');
                const MontlyPandingConfirmOrder = new Chart(monthpandcon, {
                    type: 'doughnut',
                    data: {
                        labels: ['panding Order','Confirm Order'],
                        datasets: [{
                            label: '# Panding && Confirm Order',
                            data: [{{$this_month_panding_order}},{{$this_month_confirm_order}}],
                            backgroundColor: [
                                'rgba(255, 99, 132, 0.2)',
                                'rgba(215, 236, 251)',

                            ],
                            borderColor: [
                                'rgba(255, 99, 132, 1)',
                                'rgba(54, 162, 235, 1)',

                            ],
                            borderWidth: 1
                        }]
                    },
                    options: {
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        }
                    }
                });
            </script>


           <script>
                const weeklyPurchesRep = document.getElementById('weeklyPurchesReport').getContext('2d');
                const weeklyPurchesReport = new Chart(weeklyPurchesRep, {
                    type: 'polarArea',

                    data: {
                        labels: ['Last 7 Days Expense','Last 15 Days Expense'],
                        datasets: [{
                            label: '#Purches Expense',
                            data: [{{$last_seven_days_purches_expence}},{{$last_fiften_days_purches_expence}}],
                            backgroundColor: [
                                'rgb(255, 99, 132)',
                                'rgb(75, 192, 192)',
                                'rgb(255, 205, 86)',
                                'rgb(201, 203, 207)',
                                'rgb(54, 162, 235)'
                            ],
                            borderColor: [
                                'rgb(255, 99, 132)',
                                'rgb(75, 192, 192)',
                                'rgb(255, 205, 86)',
                                'rgb(201, 203, 207)',
                                'rgb(54, 162, 235)'

                            ],
                            borderWidth: 1
                        }]
                    },

                });
            </script>



            <script>
                const MontlyPurchesRep = document.getElementById('MontlyPurchesReport').getContext('2d');
                const MontlyPurchesReport = new Chart(MontlyPurchesRep, {
                    type:'polarArea',

                    data: {
                        labels: ['This Month','1 Month Ago','2 Month Ago','3 Month Ago','4 Month Ago','5 Month Ago'],
                        datasets: [{
                            label: '#Purches Expense',
                            data: [{{$this_month_purches_report}},{{$one_month_ago_purches_report}},{{$two_month_ago_purches_report}},{{$three_month_ago_purches_report}},{{$four_month_ago_purches_report}},{{$five_month_ago_purches_report}}],
                            backgroundColor: [
                                'rgb(255, 99, 132)',
                                'rgb(75, 192, 192)',
                                'rgb(255, 205, 86)',
                                'rgb(201, 203, 207)',
                                'rgb(54, 162, 235)'
                            ],
                            borderColor: [
                                'rgb(255, 99, 132)',
                                'rgb(75, 192, 192)',
                                'rgb(255, 205, 86)',
                                'rgb(201, 203, 207)',
                                'rgb(54, 162, 235)'

                            ],
                            borderWidth: 1
                        }]
                    },

                });
            </script>


            <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.3/jspdf.debug.js"></script>


            <script>
                $('#downloadPdf').click(function(event) {

                    // get size of report page
                    var reportPageHeight = $('#reportPage').innerHeight();
                    var reportPageWidth = $('#reportPage').innerWidth();

                    // create a new canvas object that we will populate with all other canvas objects
                    var pdfCanvas = $('<canvas />').attr({
                        id: "canvaspdf",
                        width: reportPageWidth,
                        height: reportPageHeight
                    });

                    // keep track canvas position
                    var pdfctx = $(pdfCanvas)[0].getContext('2d');
                    var pdfctxX = 0;
                    var pdfctxY = 0;
                    var buffer = 100;

                    // for each chart.js chart
                    $("canvas").each(function(index) {
                        // get the chart height/width
                        var canvasHeight = $(this).innerHeight();
                        var canvasWidth = $(this).innerWidth();

                        // draw the chart into the new canvas
                        pdfctx.drawImage($(this)[0], pdfctxX, pdfctxY, canvasWidth, canvasHeight);
                        pdfctxX += canvasWidth + buffer;

                        // our report page is in a grid pattern so replicate that in the new canvas
                        if (index % 2 === 1) {
                            pdfctxX = 0;
                            pdfctxY += canvasHeight + buffer;
                        }
                    });

                    // create new pdf and add our new canvas as an image
                    var pdf = new jsPDF('l', 'pt', [reportPageWidth, reportPageHeight]);
                    pdf.addImage($(pdfCanvas)[0], 'PNG', 0, 0);

                    // download the pdf
                    pdf.save('filename.pdf');
                });
            </script>


    @endsection

@endsection

