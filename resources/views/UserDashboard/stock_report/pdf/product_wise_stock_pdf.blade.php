<!DOCTYPE html>
<html>
<head>
    <title>Category Wise Stock report</title>
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



<h3>Category Wise Stock report</h3>

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


                                            </tr>
                                            </thead>


                                            <tbody id="sizeshow">

                                                @php
                                                $sl=1;
                                                $FinalTotalPurchesAmount = 0;
                                                $FinalTotalSoldAmount = 0;
                                                $FinalTotalCurrentAmount =0;
                                               @endphp

                                               @foreach($push as $pro)

                                                @php
                                                    $avageprice = $pro->sumprice / $pro->totalQty;
                                                      $round_price = floor($avageprice);
                                                @endphp

                                                 <tr align="center">
                                                     <td>{{ @$sl++ }}</td>
                                                     <td>@foreach(App\Models\Admin\ProductManage::where('id',$pro->product_id)->get() as $name) {{@$name->product_sku}} @endforeach</td>
                                                     <td>@foreach(App\Models\Admin\ProductManage::where('id',$pro->product_id)->get() as $name) {{@$name->product_name}} @endforeach</td>
                                                     <td>{{ @$round_price }} Taka</td>
                                                     <td>@foreach(App\Models\Admin\ProductManage::where('id',$pro->product_id)->get() as $name) {{@$name->total_qty}} @endforeach Piece</td>
                                                     <td>@foreach(App\Models\Admin\ProductManage::where('id',$pro->product_id)->get() as $name) @php $pushceTotal = @$round_price*$name->total_qty @endphp {{@$round_price*$name->total_qty}} @endforeach Taka</td>
                                                     <td>@foreach(App\Models\Admin\ProductManage::where('id',$pro->product_id)->get() as $name) {{@$name->total_qty-$name->product_qty}} @endforeach Piece</td>
                                                     <td>@foreach(App\Models\Admin\ProductManage::where('id',$pro->product_id)->get() as $name) @php $SoldOutAmount=@$round_price*(@$name->total_qty-$name->product_qty) @endphp {{@$round_price*(@$name->total_qty-$name->product_qty)}} @endforeach Taka</td>
                                                     <td>@foreach(App\Models\Admin\ProductManage::where('id',$pro->product_id)->get() as $name) {{@$name->product_qty}} @endforeach Piece</td>
                                                     <td>@foreach(App\Models\Admin\ProductManage::where('id',$pro->product_id)->get() as $name) @php $totalCurrentAmount=@$round_price*@$name->product_qty  @endphp {{@$round_price*@$name->product_qty}} @endforeach Taka</td>



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
