<!DOCTYPE html>
<html>
<head>
    <title>Customer Order Invoice PDF</title>
</head>
<body>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <table style="width:100%;" cellspacing="0" cellpadding="0" >
                @php

                    $pdfInfo = \App\Models\Admin\PdfInfo::where('id','1')->first();
                @endphp
                <thead>
                <tr>
                    <td style="text-align: center;width:30%"></td>
                    <td style="text-align: center">
                        <span><i>{{$pdfInfo->shop_title}}</i></span> <br>
                        <span style="font-size: 12px">{{$pdfInfo->address}}</span> <br>
                        <span style="font-size: 12px">Mo:{{$pdfInfo->mobile}}</span>
                    </td>
                    <td style="text-align: center;width: 30%"></td>
                </tr>
                </thead>

            </table>



            <table width="100%" cellspacing="0" cellpadding="0" style="margin-top: 40px">
                <thead>
                <tr>
                    <td width="35%">
                        <span style="text-decoration: underline;font-size: 19px">Customer Information:</span>
                        <br>

                        <span>Name : <i>{{ $customer->name }}</i></span> <br>
                        <span>Email : <i>{{ $customer->email }}</i></span> <br>
                        <span>Address : <i>{{ $customer->address }}</i></span> <br>
                        <span>Mobile : <i>{{ $customer->mobile }}</i></span> <br>

                    </td>
                    <td width="20%">

                    </td>
                    <td width="35%">


                        <span style="text-decoration: underline;font-size: 19px">Shipping Information:</span>
                        <br>

                        <span><strong>Order Id:</strong>#{{@$order->orderId}}</span><br>

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


            <table width="100%" border="1" cellspacing="0" cellpadding="0" style="margin-top: 40px;">
                <thead>
                <tr align="center">
                    <th style="text-align: center;padding:10px">Sl</th>

                    <th style="text-align: center;padding:10px">Product Sku</th>
                    <th style="text-align: center;padding:10px">Product Name</th>

                    {{--<th style="text-align: center;padding:10px">Size Name</th>--}}
                    <th style="text-align: center;padding:10px">Old Price</th>
                    <th style="text-align: center;padding:10px">Discount</th>
                    <th style="text-align: center;padding:10px">Product price</th>
                    <th style="text-align: center;padding:10px">Qty</th>

                    <th style="text-align: center">Subtotal</th>
                </tr>
                </thead>
                <tbody>
                @php
                    $sl=1;
                    $total = 0;
                     $shipping = 0;
                    $shipping_ammount=0;
                @endphp

                @foreach($order_details as $or)
                    <tr align="center">
                        <td style="padding:7px;"> {{ @$sl++ }}</td>

                        <td style="padding:7px;"> {{ @$or->products['product_sku'] }}</td>
                        <td style="padding:7px;"> {{ @$or->products['product_name'] }}</td>
                        <td style="padding:7px">$ {{ @$or->products['product_price'] }}</td>
                        @if(@$or->products['discount'])
                            <td style="padding:7px">{{ @$or->products['discount'] }} %</td>
                        @else
                            <td>0 %</td>
                        @endif
                        <td style="padding:7px;">$ {{ @$or->product_price }}</td>
                        <td style="padding:7px;"> {{ @$or->qty }} PEC</td>
                        <td style="padding:7px;">$ {{ @$or->product_price * $or->qty }}</td>

                    </tr>


                @endforeach



                <tr>
                    <td colspan="3" align="right">Shipping Name</td>
                    <td  align="center">{{ @$order->shipment_name }}</td>
                </tr>

                <tr>
                    <td colspan="3" align="right">Shipping Amount</td>
                    <td  align="center">${{ @$order->shipment_amount }}</td>
                </tr>

                @if(@$order->coupon!=null)
                    <tr>
                        <td style="padding:9px" colspan="3" align="right">Coupon</td>
                        <td style="padding:9px"  align="center">{{@$order->coupon}}</td>
                    </tr>
                @else

                @endif

                <tr>
                    <td style="padding:9px" colspan="3" align="right">Total Amount</td>
                    <td style="padding:9px"  align="center">$ {{ @$order->total_ammount }}</td>
                </tr>



                <tr>
                    <td style="padding:9px" colspan="3" align="right">Payment</td>
                    <td style="padding:9px"  align="center" style="color:green">{{ $order->payments['payment'] }}</td>
                </tr>


                </tbody>
            </table>


            <div class="col-md-12">



                <table style="" width="100%" border="1" cellpadding="0" cellspacing="0">


                </table>

                <i style="font-size: 10px">Print Date : {{ date('d m Y') }}</i>

            </div>


        </div>
    </div>
</div>

</body>
</html>