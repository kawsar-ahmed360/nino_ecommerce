<!DOCTYPE html>
<html>
<head>
    <title>Product Wise Stock Report</title>
</head>
<body>

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                  <table style="width:100%;" cellspacing="0" cellpadding="0" >
                    @php

                        $pdfInfo = App\Models\Admin\PdfInfo::where('id','1')->first();
                 @endphp
                    <thead>
                        <tr>
                            <td style="text-align: center;width:30%"></td>
                            <td style="text-align: center">
                                <span><i>{{@$pdfInfo->shop_title}}</i></span> <br>
                                <span style="font-size: 12px">{{@$pdfInfo->address}}</span> <br>
                                <span style="font-size: 12px">Mo: {{@$pdfInfo->mobile}}</span>
                            </td>
                            <td style="text-align: center;width: 30%"></td>
                        </tr>
                    </thead>

                  </table>

  <h3>{{@$product_name->product_name}} Wise Stock Report</h3>

  <table width="100%" border="1" cellspacing="0" cellpadding="0" style="margin-top: 40px;">
                                            <thead>
                                                <tr align="center">
                                                    <th style="padding:5px">SL</th>
                                                <th style="padding:5px">Product Sku</th>    
                                                    <th style="padding:5px">Product</th>
                                                    <th style="padding:5px">Price</th>
                                                    <th style="padding:5px">Purchase Qty</th>
                                                    <th style="padding:5px">Purchase Amount</th>
                                                    <th style="padding:5px">Sold Qty</th>
                                                    <th style="padding:5px">Sold Amount</th>
                                                    <th style="padding:5px">Current Qty</th>
                                                    <th style="padding:5px">Current Amount</th>

                                                    {{-- <th style="background-color: black;color:white;font-weight: bold">Stock</th> --}}



                                                </tr>
                                            </thead>


                                            <tbody id="sizeshow">

                                                @php
                                                $sl=1;
                                                $FinalTotalPurchesAmount = 0;
                                                $FinalTotalSoldAmount = 0;
                                                $FinalTotalCurrentAmount =0;
                                               @endphp

                                               @foreach($cat_wise_stock as $pro)

                                               @php
                                                   $pushceTotal = @$round_price*$pro->total_qty;
                                                  $soldOut = ($pro->total_qty - $pro->product_qty);
                                                   $SoldOutAmount =@$round_price*$soldOut;
                                                   $totalCurrentAmount =@$round_price * $pro->product_qty;
                                            @endphp

                                                 <tr align="center">
                                                   <td style="padding:5px">{{ @$sl++ }}</td>
                                                     <td style="padding:5px">
                                                       @if(empty($pro->product_sku))
                                                       null
                                                       @else
                                                       {{ $pro->product_sku }}
                                                       @endif
                                                    </td>
                                                   <td style="padding:5px">{{ $pro->product_name }}</td>
                                                   <td style="padding:5px">{{ @$round_price }} Taka</td>
                                                   <td style="padding:5px">{{ $pro->total_qty }} Piece</td>
                                                   <td style="padding:5px">{{ $pushceTotal }} Taka</td>
                                                   <td style="padding:5px">{{ @$soldOut }} Piece</td>
                                                   <td style="padding:5px">{{ @$SoldOutAmount }} Taka</td>
                                                   <td style="padding:5px">{{ @$pro->product_qty }} Piece</td>
                                                   <td style="padding:5px">{{ @$totalCurrentAmount }} Taka</td>


                                                   <!--------ALL In Calculator------->

                                                   @php

                                                   @$FinalTotalPurchesAmount+=$pushceTotal;
                                                   @$FinalTotalSoldAmount+=$SoldOutAmount;
                                                   @$FinalTotalCurrentAmount+=$totalCurrentAmount;


                                                   @endphp


                                                   @if($pro->product_qty)
                                                    {{-- <td style="color:tomato;background-color: black;font-weight: bold">{{ $pro->product_qty }} PEC</td> --}}
                                                   @else
                                                    {{-- <td style="color:tomato;background-color: black;font-weight: bold">0 PEC</td> --}}
                                                   @endif

                                                 </tr>

                                               @endforeach


                                            </tbody>
                                        </table>

                                        <table class="table table-bordered table-striped" style="width: 300px;display:block;margin:0 auto;backeground:black;color:#A8B2BC;margin-top:20px">
                                            <tr>
                                                <td style="background: black;padding:6px">Total Purchase Amount</td>
                                                <td style="background:black;color:red;font-weight:bold;padding:6px">{{ @$FinalTotalPurchesAmount }} Taka</td>
                                            </tr>
                                            <tr>
                                                <td style="background: black;padding:6px">Total Sold Amount</td>
                                                <td style="background:black;color:red;font-weight:bold;padding:6px">{{ @$FinalTotalSoldAmount }} Taka</td>
                                            </tr>
                                            <tr>
                                                <td style="background: black;padding:6px">Total Current Amount</td>
                                                <td style="background:black;color:red;font-weight:bold;padding:6px">{{ @$FinalTotalCurrentAmount }} Taka</td>
                                            </tr>
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
