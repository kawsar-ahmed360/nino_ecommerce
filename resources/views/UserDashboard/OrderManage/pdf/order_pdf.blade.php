<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Order Details Pdf</title>
</head>

<body>

<table style="width:100%;background:#AD0A40;padding: 20px;border-radius: 20px 10px 10px 0px" cellspacing="0" cellpadding="0" >
    @php

        $pdfInfo = \App\Models\Admin\PdfInfo::where('id','1')->first();
    @endphp
    <thead>
    <tr>
        {{--<img style="width:100px" src="{{asset('backend/login.png')}}" alt="">--}}
        <td style="text-align: center;width:30%"></td>
        <td style="text-align: center">
            <span style="font-size:20px;font-weight: bold;color:white"><i>{{$pdfInfo->shop_title}}</i></span> <br>
            <span style="font-size: 15px;color:white">{{$pdfInfo->address}}</span> <br>
            <span style="font-size: 15px;color:white"><strong>Mobile</strong>:{{$pdfInfo->mobile}}</span>
        </td>
        <td style="text-align: center;width: 30%"></td>
    </tr>
    </thead>

</table>

<hr>

@foreach(@$Order as $key=>$pri)
    <h2>Sl :{{$key+1}}</h2>

    <style>
        .vl {
            border-left: 2px solid silver;
            height: 300px;
            position: absolute;
            left: 50%;

            margin-left: -3px;
            top: 12%;
        }
    </style>

 <div class="fullname" >

<table width="100%" cellspacing="0" cellpadding="0" style="margin-top: 40px">
    <thead>
    <tr>

        <td width="35%">

            <span style="text-decoration: underline;font-size: 19px">Customer Information:</span>

            <br>
            <br>

            <span>Name : <i>{{ $pri->customer['name'] }}</i></span> <br>
            <span>Email : <i>{{ $pri->customer['email'] }}</i></span> <br>
            <span>Address : <i>{{ $pri->customer['address'] }}</i></span> <br>
            <span>Mobile : <i>{{ $pri->customer['mobile'] }}</i></span> <br>

        </td>
        <td width="20%">


            <div class="vl"></div>


        </td>

        <td width="35%">
            <span style="text-decoration: underline;font-size: 19px">Shipping Information:</span>

            <br>
            <br>

            <span>OrderId : <i>#{{ @$pri->orderId }}</i></span> <br>

            @if(@$pri->BillingInfo->other_shipment=='other_shipment')

                <span>Name : <i>{{ @$pri->BillingInfo->shipping_fname }} {{ @$pri->BillingInfo->shipping_lname }}</i></span> <br>
                <span>Mobile : <i>{{ @$pri->BillingInfo->shipping_mobile }}</i></span> <br>
                <span>Address : <i>{{ @$pri->BillingInfo->shipping_address }}</i></span> <br>
                <span>Country : <i>{{ @$pri->BillingInfo->shipping_country_name }}</i></span> <br>
                <span>City : <i>{{ @$pri->BillingInfo->shipping_city_name }}</i></span> <br>
                <span>State : <i>{{ @$pri->BillingInfo->shipping_state_name }}</i></span> <br>
                <span>Zip : <i>{{ @$pri->BillingInfo->shipping_zip_code }}</i></span> <br>

            @else
                <span>Name : <i>{{ @$pri->BillingInfo->billing_fname }} {{ @$pri->BillingInfo->billing_lname }}</i></span> <br>
                <span>Mobile : <i>{{ @$pri->BillingInfo->billing_mobile }}</i></span> <br>
                <span>Address : <i>{{ @$pri->BillingInfo->billing_address }}</i></span> <br>
                <span>Country : <i>{{ @$pri->BillingInfo->billing_country_name }}</i></span> <br>
                <span>City : <i>{{ @$pri->BillingInfo->billing_city_name }}</i></span> <br>
                <span>State : <i>{{ @$pri->BillingInfo->billing_state_name }}</i></span> <br>
                <span>Zip : <i>{{ @$pri->BillingInfo->billing_zip_code }}</i></span> <br>


                @endif
        </td>
    </tr>
    </thead>

</table>
<br>
<br>
<hr>

<table width="100%" border="1" cellspacing="0" cellpadding="0" style="margin-top: 40px;padding:10px">
    <thead>
    <tr align="center">
        <th  style="text-align: center;padding:10px">SQU</th>
        <th  style="text-align: center;padding:10px">Product Name</th>
        <th  style="text-align: center;padding:10px">Carat</th>
        <th  style="text-align: center;padding:10px">Qty</th>
        <th  style="text-align: center;padding:10px">Price</th>
        <th  style="text-align: center;padding:10px">Discount</th>
    </tr>
    </thead>

    @php
      $oderDetai = \App\Models\Client\OrderDetail::where('order_id',$pri->id)->where('user_id',$pri->user_id)->get();
      $payment= \App\Models\Client\Payment::where('id',$pri->payment_id)->where('user_id',$pri->user_id)->first();
      $order= \App\Models\Client\Order::where('id',$pri->id)->where('user_id',$pri->user_id)->first();
    @endphp
    <tbody>
    @forelse($oderDetai as $pri)
        <tr>

            <td style="padding:7px;">{{@$pri->products['product_sku']}}</td>
            <td style="padding:7px;">{{@$pri->products['product_name']}}</td>
            <td style="padding:7px;">{{@$pri->products['carat']}}</td>

            <td style="padding:7px;">{{@$pri->qty}}</td>
            <td style="padding:7px;">${{@$pri->product_price}}</td>
            <td style="padding:7px;">@if(@$pri->products['discount']) {{@$pri->products['discount']}} @else 0 @endif%</td>


        </tr>

    @empty

    @endforelse

    </tbody>

    <tr>
        <td colspan="4" style="padding-left:400px;padding-top:4px;padding-bottom:4px">Payment Type</td>
        <td colspan="2" style="padding-left:40px;padding-top:4px;padding-bottom:4px">@if(@$payment!=null) {{@$payment->payment}} @else Null @endif</td>

    </tr>


    @if(@$order->coupon!=null)
        <tr>
            <td style="padding:9px" colspan="3" align="right">Coupon</td>
            <td style="padding:9px"  align="center">{{@$order->coupon}}</td>
        </tr>
    @else

    @endif


    <tr>
        <td colspan="4" style="padding-left:400px;padding-top:4px;padding-bottom:4px">Shipping Charge</td>
        <td colspan="2" style="padding-left:40px;padding-top:4px;padding-bottom:4px">@if(@$order->shipment_amount!=null) ${{@$order->shipment_amount}} @else Null @endif</td>

    </tr>


    <tr>
        <td colspan="4" style="padding-left:400px;padding-top:4px;padding-bottom:4px">Shipping Name</td>
        <td colspan="2" style="padding-left:40px;padding-top:4px;padding-bottom:4px">@if(@$order->shipment_name!=null) {{@$order->shipment_name}} @else Null @endif</td>

    </tr>



    <tr>
        <td colspan="4" style="padding-left:400px;padding-top:4px;padding-bottom:4px">Total Amount</td>
        <td colspan="2" style="padding-left:40px;padding-top:4px;padding-bottom:4px">${{$order->total_ammount}}</td>
    </tr>


</table>

 </div>

    <div class="col-md-12">

        <table style="" width="100%" border="1" cellpadding="0" cellspacing="0">

        </table>

        <i style="font-size: 10px">Print Date : {{ date('d m Y') }}</i>

    </div>

    <div style="margin-top: 400px;"></div>
@endforeach


</body>
</html>