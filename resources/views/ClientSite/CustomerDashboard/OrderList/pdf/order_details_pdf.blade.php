<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Order Details Pdf</title>
</head>
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
<body>

<table style="width:100%;" cellspacing="0" cellpadding="0" >
    @php

        $pdfInfo = \App\Models\Admin\PdfInfo::where('id','1')->first();
    @endphp
    <thead>
    <tr>
        <td style="text-align: center;width:30%"></td>
        <td style="text-align: center">
            <span style="font-size:20px;font-weight: bold"><i>{{$pdfInfo->shop_title}}</i></span> <br>
            <span style="font-size: 15px">{{$pdfInfo->address}}</span> <br>
            <span style="font-size: 15px">Mobile:{{$pdfInfo->mobile}}</span>
        </td>
        <td style="text-align: center;width: 30%"></td>
    </tr>
    </thead>

</table>

<hr>


<table width="100%" cellspacing="0" cellpadding="0" style="margin-top: 40px">
    <thead>
    <tr>
        <td width="35%">
            <span style="text-decoration: underline;font-size: 19px">Customer Information:</span>

            <br>
            <br>

            <span>Name : <i>{{ $customer_info->name }}</i></span> <br>
            <span>Email : <i>{{ $customer_info->email }}</i></span> <br>
            <span>Address : <i>{{ $customer_info->address }}</i></span> <br>
            <span>Mobile : <i>{{ $customer_info->mobile }}</i></span> <br>

        </td>
        <td width="20%">


            <div class="vl"></div>


        </td>

        <td width="35%">
            <span style="text-decoration: underline;font-size: 19px">Shipping Information:</span>

            <br>
            <br>

            <span>OrderId : <i>#{{ @$order_details[0]->orders['orderId'] }}</i></span> <br>

            @if($shipping->other_shipment=='other_shipment')

                <span>Name : <i>{{ $shipping->shipping_fname }} {{ $shipping->shipping_lname }}</i></span> <br>
                <span>Mobile : <i>{{ $shipping->shipping_mobile }}</i></span> <br>
                <span>Address : <i>{{ $shipping->shipping_address }}</i></span> <br>
                <span>Country : <i>{{ $shipping->shipping_country_name }}</i></span> <br>
                <span>City : <i>{{ $shipping->shipping_city_name }}</i></span> <br>
                <span>State : <i>{{ $shipping->shipping_state_name }}</i></span> <br>
                <span>Zip : <i>{{ $shipping->shipping_zip_code }}</i></span> <br>

            @else
                <span>Name : <i>{{ $shipping->billing_fname }} {{ $shipping->billing_lname }}</i></span> <br>
                <span>Mobile : <i>{{ $shipping->billing_mobile }}</i></span> <br>
                <span>Address : <i>{{ $shipping->billing_address }}</i></span> <br>
                <span>Country : <i>{{ $shipping->billing_country_name }}</i></span> <br>
                <span>City : <i>{{ $shipping->billing_city_name }}</i></span> <br>
                <span>State : <i>{{ $shipping->billing_state_name }}</i></span> <br>
                <span>Zip : <i>{{ $shipping->billing_zip_code }}</i></span> <br>

            @endif
        </td>
    </tr>
    </thead>

</table>
<br>
<br>
<hr>

<table width="100%" border="1" cellspacing="0" cellpadding="0" style="margin-top: 40px;">
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

    <tbody>
    @forelse(@$order_details as $order)
        <tr>

            <td style="padding:7px;">{{@$order->products['product_sku']}}</td>
            <td style="padding:7px;">{{@$order->products['product_name']}}</td>
            <td style="padding:7px;">{{@$order->products['carat']}}</td>

            <td style="padding:7px;">{{@$order->qty}}</td>
            <td style="padding:7px;">${{@$order->product_price}}</td>
            <td style="padding:7px;">@if(@$order->products['discount']) {{@$order->products['discount']}} @else 0 @endif%</td>


        </tr>

    @empty

    @endforelse

    </tbody>

    <tr>
        <td colspan="4" style="padding-left:400px;padding-top:4px;padding-bottom:4px">Payment Type</td>
        <td colspan="2" style="padding-left:40px;padding-top:4px;padding-bottom:4px">@if(@$order->orders->payments['payment']!=null) {{@$order->orders->payments['payment']}} @else Null @endif</td>

    </tr>

    <tr>
        <td colspan="4" style="padding-left:400px;padding-top:4px;padding-bottom:4px">Shipping Charge</td>
        <td colspan="2" style="padding-left:40px;padding-top:4px;padding-bottom:4px">$@if(@$order->orders['shipment_amount']!=null) {{@$order->orders['shipment_amount']}} @else Null @endif</td>

    </tr>


    <tr>
        <td colspan="4" style="padding-left:400px;padding-top:4px;padding-bottom:4px">Shipping</td>
        <td colspan="2" style="padding-left:40px;padding-top:4px;padding-bottom:4px">@if(@$order->orders['shipment_name']!=null) {{@$order->orders['shipment_name']}} @else Null @endif</td>

    </tr>


    <tr>
        <td colspan="4" style="padding-left:400px;padding-top:4px;padding-bottom:4px">Total Amount</td>
        <td colspan="2" style="padding-left:40px;padding-top:4px;padding-bottom:4px">$@if(@$order->orders['total_ammount']) {{@$order->orders['total_ammount']}} @else Null @endif</td>

    </tr>


</table>



<div class="col-md-12">

    <table style="" width="100%" border="1" cellpadding="0" cellspacing="0">

    </table>

    <i style="font-size: 10px">Print Date : {{ date('d m Y') }}</i>

</div>

</body>
</html>