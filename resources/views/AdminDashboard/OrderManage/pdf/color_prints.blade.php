<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Invoice</title>
    <style>
        @import url(https://fonts.googleapis.com/css?family=Roboto:100,300,400,900,700,500,300,100);
        *{
            margin: 0;
            box-sizing: border-box;
            -webkit-print-color-adjust: exact;
        }
        body{
            background: #E0E0E0;
            font-family: 'Roboto', sans-serif;
        }
        ::selection {background: #f31544; color: #FFF;}
        ::moz-selection {background: #f31544; color: #FFF;}
        .clearfix::after {
            content: "";
            clear: both;
            display: table;
        }
        .col-left {
            float: left;
        }
        .col-right {
            float: right;
        }
        h1{
            font-size: 1.5em;
            color: #444;
        }
        h2{font-size: .9em;}
        h3{
            font-size: 1.2em;
            font-weight: 300;
            line-height: 2em;
        }
        p{
            font-size: .75em;
            color: #666;
            line-height: 1.2em;
        }
        a {
            text-decoration: none;
            color: #00a63f;
        }

        #invoiceholder{
            width:100%;
            height: 100%;
            padding: 50px 0;
        }
        #invoice{
            position: relative;
            margin: 0 auto;
            width: 700px;
            background: #FFF;
        }

        [id*='invoice-']{ /* Targets all id with 'col-' */
            /*  border-bottom: 1px solid #EEE;*/
            padding: 20px;
        }

        #invoice-top{border-bottom: 2px solid #00a63f;}
        #invoice-mid{min-height: 110px;}
        #invoice-bot{ min-height: 240px;    margin-top: 17px;}

        .logo{
            display: inline-block;
            vertical-align: middle;
            width: 110px;
            overflow: hidden;
        }
        .info{
            display: inline-block;
            vertical-align: middle;
            margin-left: 20px;
        }
        .logo img,
        .clientlogo img {
            width: 100%;
        }
        .clientlogo{
            display: inline-block;
            vertical-align: middle;
            width: 50px;
        }
        .clientinfo {
            display: inline-block;
            vertical-align: middle;
            margin-left: 20px
        }
        .title{
            float: right;
        }
        .title p{text-align: right;}
        #message{margin-bottom: 30px; display: block;}
        h2 {
            margin-bottom: 5px;
            color: #444;
        }
        .col-right td {
            color: #666;
            padding: 5px 8px;
            border: 0;
            font-size: 0.75em;
            border-bottom: 1px solid #eeeeee;
        }
        .col-right td label {
            margin-left: 5px;
            font-weight: 600;
            color: #444;
        }
        .cta-group a {
            display: inline-block;
            padding: 7px;
            border-radius: 4px;
            background: rgb(196, 57, 10);
            margin-right: 10px;
            min-width: 100px;
            text-align: center;
            color: #fff;
            font-size: 0.75em;
        }
        .cta-group .btn-primary {
            background: #00a63f;
        }
        .cta-group.mobile-btn-group {
            display: none;
        }
        table{
            width: 100%;
            border-collapse: collapse;
        }
        td{
            padding: 10px;
            border-bottom: 1px solid #cccaca;
            font-size: 0.70em;
            text-align: left;
        }

        .tabletitle th {
            border-bottom: 2px solid #ddd;
            text-align: right;
        }
        .tabletitle th:nth-child(2) {
            text-align: left;
        }
        th {
            font-size: 0.7em;
            text-align: left;
            padding: 5px 10px;
        }
        .item{width: 50%;}
        .list-item td {
            text-align: right;
        }
        .list-item td:nth-child(2) {
            text-align: left;
        }
        .total-row th,
        .total-row td {
            text-align: right;
            font-weight: 700;
            font-size: .75em;
            border: 0 none;
        }
        .table-main {

        }
        footer {
            border-top: 1px solid #eeeeee;;
            padding: 15px 20px;
        }
        .effect2
        {
            position: relative;
        }
        .effect2:before, .effect2:after
        {
            z-index: -1;
            position: absolute;
            content: "";
            bottom: 15px;
            left: 10px;
            width: 50%;
            top: 80%;
            max-width:300px;
            background: #777;
            -webkit-box-shadow: 0 15px 10px #777;
            -moz-box-shadow: 0 15px 10px #777;
            box-shadow: 0 15px 10px #777;
            -webkit-transform: rotate(-3deg);
            -moz-transform: rotate(-3deg);
            -o-transform: rotate(-3deg);
            -ms-transform: rotate(-3deg);
            transform: rotate(-3deg);
        }
        .effect2:after
        {
            -webkit-transform: rotate(3deg);
            -moz-transform: rotate(3deg);
            -o-transform: rotate(3deg);
            -ms-transform: rotate(3deg);
            transform: rotate(3deg);
            right: 10px;
            left: auto;
        }
        @media screen and (max-width: 767px) {
            h1 {
                font-size: .9em;
            }
            #invoice {
                width: 100%;
            }
            #message {
                margin-bottom: 20px;
            }
            [id*='invoice-'] {
                padding: 20px 10px;
            }
            .logo {
                width: 140px;
            }
            .title {
                float: none;
                display: inline-block;
                vertical-align: middle;
                margin-left: 40px;
            }
            .title p {
                text-align: left;
            }
            .col-left,
            .col-right {
                width: 100%;
            }
            .table {
                margin-top: 20px;
            }
            #table {
                white-space: nowrap;
                overflow: auto;
            }
            td {
                white-space: normal;
            }
            .cta-group {
                text-align: center;
            }
            .cta-group.mobile-btn-group {
                display: block;
                margin-bottom: 20px;
            }
            /*==================== Table ====================*/
            .table-main {
                border: 0 none;
            }
            .table-main thead {
                border: none;
                clip: rect(0 0 0 0);
                height: 1px;
                margin: -1px;
                overflow: hidden;
                padding: 0;
                position: absolute;
                width: 1px;
            }
            .table-main tr {
                border-bottom: 2px solid #eee;
                display: block;
                margin-bottom: 20px;
            }
            .table-main td {
                font-weight: 700;
                display: block;
                padding-left: 40%;
                max-width: none;
                position: relative;
                border: 1px solid #cccaca;
                text-align: left;
            }
            .table-main td:before {
                /*
                * aria-label has no advantage, it won't be read inside a table
                content: attr(aria-label);
                */
                content: attr(data-label);
                position: absolute;
                left: 10px;
                font-weight: normal;
                text-transform: uppercase;
            }
            .total-row th {
                display: none;
            }
            .total-row td {
                text-align: left;
            }
            footer {text-align: center;}
        }

        .print_button{
            background: red;
            border: 0px;
            padding: 6px;
            border-radius: 3px;
            color: white;
            margin-left: 10px;
        }

        .page {
            min-height:874px;

        }

    </style>
</head>
<body>


    <button class="btn btn-success btn-sm print_button" onclick="print()">Print</button>



        @foreach(@$Order as $key=>$pri)
            <div id="invoiceholder" class="page">
        <div id="invoice" class="effect2">

            <div id="invoice-top">
                <div class="logo"><img src="https://nino.co.nz/upload/Client/Logo/1635138698.png" alt="Logo" />

                </div>




                <div class="title">
                    <h1>Invoice</h1>
                    <p>Invoice Date: <span id="invoice_date">{{date('d M Y')}}</span><br>
                        GL Date: <span id="gl_date">{{date('d M Y')}}</span>
                    </p>
                </div><!--End Title-->
            </div><!--End InvoiceTop-->


        <div id="invoice-mid">
            <strong>OrderId: <font style="color: red;"><span><i>#{{ @$pri->orderId }}</i></span></font></strong>
            <div id="message" style="margin-bottom: 20px;">
             <table class="table table-striped" style="width: 100%;">

                  <table class="table" style="width:40%;float: left;line-height: 1px;">
                      <tbody>
                      <tr>
                          <th colspan="2"><h3 style="font-weight:bold;text-align: center;text-decoration: underline">Coustomer Information</h3></th>
                      </tr>
                      <tr>
                          <th>Name:</th>
                          <td>{{ @$pri->customer['name'] }}</td>
                      </tr>

                      <tr>
                          <th>Email:</th>
                          <td>{{ @$pri->customer['email'] }}</td>
                      </tr>

                      <tr>
                          <th>Address:</th>
                          <td style="line-height: normal;">{{ @$pri->customer['address'] }}</td>
                      </tr>

                      <tr>
                          <th>Mobile:</th>
                          <td>{{ @$pri->customer['mobile'] }}</td>
                      </tr>
                      </tbody>
                  </table>

                  <table class="table" style="width:40%;float: right;line-height: 1px;">
                      <tbody>
                      <tr>
                          <th colspan="2"><h3 style="font-weight:bold;text-align: center;text-decoration: underline">Shipping Information</h3></th>
                      </tr>
                      @if(@$pri->BillingInfo->other_shipment=='other_shipment')
                      <tr>
                          <th>Name:</th>
                          <td>{{ @$pri->BillingInfo->shipping_fname }} {{ @$pri->BillingInfo->shipping_lname }}</td>
                      </tr>

                      <tr>
                          <th>Mobile:</th>
                          <td>{{ @$pri->BillingInfo->shipping_mobile }}</td>
                      </tr>

                      <tr>
                          <th>Address:</th>
                          <td style="line-height: normal;">{{ @$pri->BillingInfo->shipping_address }}</td>
                      </tr>

                      <tr>
                          <th>Country:</th>
                          <td>{{ @$pri->BillingInfo->shipping_country_name }}</td>
                      </tr>


                      <tr>
                          <th>City:</th>
                          <td>{{ @$pri->BillingInfo->shipping_city_name }}</td>
                      </tr>

                      <tr>
                          <th>State:</th>
                          <td>{{ @$pri->BillingInfo->shipping_state_name }}</td>
                      </tr>

                      <tr>
                          <th>Zip:</th>
                          <td>{{ @$pri->BillingInfo->shipping_zip_code }}</td>
                      </tr>

                      @else
                          <tr>
                              <th>Name:</th>
                              <td>{{ @$pri->BillingInfo->billing_fname }} {{ @$pri->BillingInfo->billing_lname }}</td>
                          </tr>

                          <tr>
                              <th>Email:</th>
                              <td>{{ @$pri->BillingInfo->billing_mobile }}</td>
                          </tr>

                          <tr>
                              <th>Address:</th>
                              <td style="line-height: normal;">{{ @$pri->BillingInfo->billing_address }}</td>
                          </tr>

                          <tr>
                              <th>Country:</th>
                              <td>{{ @$pri->BillingInfo->billing_country_name }}</td>
                          </tr>

                          <tr>
                              <th>City:</th>
                              <td>{{ @$pri->BillingInfo->billing_city_name }}</td>
                          </tr>

                          <tr>
                              <th>State:</th>
                              <td>{{ @$pri->BillingInfo->billing_state_name }}</td>
                          </tr>


                          <tr>
                              <th>Zip:</th>
                              <td>{{ @$pri->BillingInfo->billing_zip_code }}</td>
                          </tr>

                      @endif

                      </tbody>
                  </table>

             </table>
            </div>




        </div><!--End Invoice Mid-->
        <br>
        <br>
        <br>
        <hr style="margin-top: 100px;">
        <div id="invoice-bot">
             <h3 style="text-decoration: underline">Order List</h3>
            <div id="table">
                <table class="table-main table" border="1">
                    <thead>
                    <tr class="tabletitle">
                        <th>SQU</th>
                        <th>Product Name </th>
                        <th>Qty</th>
                        <th>Price</th>
                        <th>Discount</th>

                        <th>Total</th>
                    </tr>
                    </thead>
                    @php
                        $oderDetai = \App\Models\Client\OrderDetail::where('order_id',$pri->id)->where('user_id',$pri->user_id)->get();
                        $payment= \App\Models\Client\Payment::where('id',$pri->payment_id)->where('user_id',$pri->user_id)->first();
                        $order= \App\Models\Client\Order::where('id',$pri->id)->where('user_id',$pri->user_id)->first();
                    @endphp

                    @forelse($oderDetai as $pri)
                    <tr class="list-item">
                        <td data-label="Type" class="tableitem">{{@$pri->products['product_sku']}}</td>
                        <td data-label="Description" class="tableitem">{{@$pri->products['product_name']}}</td>
                        <td data-label="Quantity" class="tableitem">{{@$pri->products['carat']}}</td>
                        <td data-label="Unit Price" class="tableitem">{{@$pri->qty}}</td>
                        <td data-label="Taxable Amount" class="tableitem">${{@$pri->product_price}}</td>
                        <td data-label="Tax Code" class="tableitem">@if(@$pri->products['discount']) {{@$pri->products['discount']}} @else 0 @endif%</td>


                    </tr>

                    @empty

                    @endforelse

                    <tr class="">
                        <th colspan="5" style="text-align: right;" class="tableitem">Payment Type</th>
                        <td data-label="Grand Total" class="tableitem">@if(@$payment!=null) {{@$payment->payment}} @else Null @endif</td>
                    </tr>

                    <tr class="list-item ">
                        <th colspan="5" style="text-align: right;" class="tableitem">Coupon</th>
                        <td data-label="Grand Total" class="tableitem">{{@$order->coupon}}</td>
                    </tr>

                    <tr class="list-item ">
                        <th colspan="5" style="text-align: right;" class="tableitem">Shipping Charge </th>
                        <td data-label="Grand Total" class="tableitem">@if(@$order->shipment_amount!=null) ${{@$order->shipment_amount}} @else Null @endif</td>
                    </tr>

                    <tr class="list-item ">
                        <th colspan="5" style="text-align: right;" class="tableitem">Shipping Name  </th>
                        <td data-label="Grand Total" class="tableitem">@if(@$order->shipment_name!=null) {{@$order->shipment_name}} @else Null @endif</td>
                    </tr>

                    <tr class="list-item ">
                        <th colspan="5" style="text-align: right;" class="tableitem">Total Amount</th>
                        <td data-label="Grand Total" class="tableitem">${{$order->total_ammount}}</td>
                    </tr>
                </table>
            </div><!--End Table-->


        </div><!--End InvoiceBot-->


        <footer>
            <div id="legalcopy" class="clearfix">
                <p class="col-right">Our mailing address is:
                    <span class="email"><a href="iamosahan@gmail.com"> iamosahan@gmail.com</a></span>
                </p>
            </div>
        </footer>
    </div><!--End Invoice-->
            </div><!-- End Invoice Holder-->
    @endforeach




</body>
</html>