<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="https://docraptor.com/docraptor-1.0.0.js"></script>
    <script>
        var downloadPDF = function() {
            DocRaptor.createAndDownloadDoc("YOUR_API_KEY_HERE", {
                test: true,
                type: "pdf",

                document_content: document.querySelector('#to').innerHTML,

            })
        }
    </script>

    <style>
        @media print {
            #pdf-button {
                display: none;
            }
        }
    </style>

</head>
<body id="content">


<div class=" text-center">
    <h1 class="display-3">Thank You! Your Order Successfully Completes</h1>
    <p class="lead"><strong>Please check your email</strong> for further instructions on how to complete your account setup.</p>
    <hr>

    <div id="contents">
        <div class="invoice">

        </div>

        <input style="background:red;color:white;border:none;border-radius:4px;cursor:pointer" id="pdf-button" type="button" value="Download PDF" onclick="downloadPDF()" />

        <div class="container" id="to">
            <div class="row">
                <div class="col-md-12">
                    <table style="width:100%;" cellspacing="0" cellpadding="0" >
                        <thead>
                        @php

                            $pdfInfo = \App\Models\Admin\PdfInfo::where('id','1')->first();
                        @endphp
                        <tr>
                            <td style="text-align: center;width:30%"></td>
                            <td style="text-align: center">
                                <span><i>{{$pdfInfo->shop_title}}</i></span> <br>
                                <span style="font-size: 12px">{{$pdfInfo->address}}</span> <br>
                                <span style="font-size: 12px">Mo: {{$pdfInfo->mobile}}</span>
                            </td>
                            <td style="text-align: center;width: 30%"></td>
                        </tr>
                        </thead>

                    </table>







                    <table width="100%" class="" cellspacing="0" cellpadding="0" style="margin-top: 40px" id="news">
                        <thead>
                        <tr>
                            <td width="35%">
                                <span style="text-decoration: underline;font-size: 19px">Customer Information:</span>
                                <br>

                                <span style=""><strong style="">Name</strong> : <i>{{ @$CustomerInfo->name }} {{@$CustomerInfo->lname}}</i></span> <br>
                                <span style=""><strong style="">Email</strong> : <i>{{ @$CustomerInfo->email }}</i></span> <br>
                                <span style=""><strong style="">Address</strong> : <i>@if(@$CustomerInfo->address) {{ @$CustomerInfo->address }} @else Your Address Not Found!! Reason Your Are Guest  @endif</i></span> <br>
                                <span style=""><strong style="">Mobile</strong> : <i>{{ @$CustomerInfo->mobile }}</i></span> <br>

                            </td>
                            <td width="15%">

                            </td>

                            <td width="40%">


                                <span style="text-decoration: underline;font-size: 19px">Shipping Information:</span>
                                <br>


                                <p style="padding:0px;margin:0px"> <span><strong>Order Id:</strong>#{{@$order->orderId}}</span></p>



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
                                <td style="padding:7px;"> {{ $sl++ }}</td>
                                <td style="padding:7px;"> {{ @$or->products['product_sku'] }}</td>
                                <td style="padding:7px;"> {{ @$or->products['product_name'] }}</td>

                                <td style="padding:7px">$ {{ @$or->products['product_price'] }}</td>
                                @if(@$or->products['discount'])
                                    <td style="padding:7px">{{ @$or->products['discount'] }} %</td>
                                @else
                                    <td>0 %</td>
                                @endif
                                <td style="padding:7px;"> $ {{ @$or->product_price }}</td>
                                <td style="padding:7px;"> {{ @$or->qty }} PCS</td>
                                <td style="padding:7px;">$ {{ @$or->product_price * $or->qty }}</td>

                            </tr>

                        @endforeach

                        <tr>

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

                        <td style="padding:9px" colspan="3" align="right">Total Amount</td>
                        <td style="padding:9px"  align="center">$ {{ @$order->total_ammount }}</td>
                        </tr>



                        <tr>
                            <td style="padding:9px" colspan="3" align="right">Payment</td>
                            <td style="padding:9px"  align="center" style="color:green">{{ @$order->payments['payment'] }}</td>
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
    </div>




    <p class="lead">
        <a class="btn btn-primary btn-sm" href="{{route('MainIndex')}}" role="button">Continue to homepage</a>
    </p>
</div>










<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.2.61/jspdf.min.js"></script>

{{-- <script type="text/javascript" src="news.js"></script> --}}
{{-- <script type="text/javascript">
  var doc = new jsPDF();
var specialElementHandlers = {
    '#editor': function (element, renderer) {
        return true;
    }
};

$('#cmd').click(function () {
    doc.fromHTML($('#contents').html(), 15, 15, {
        'width': 170,
            'elementHandlers': specialElementHandlers
    });
    doc.save('sample-file.pdf');
});

</script> --}}


</body>
</html>
