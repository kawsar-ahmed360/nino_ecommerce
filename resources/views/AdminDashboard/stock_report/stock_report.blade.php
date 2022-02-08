@extends('AdminDashboard.master')
@section('title')Category Wise Stock Reports @endsection
@section('admin-content')

    <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">

                                        <h3 style="" class="card-title">Category Wise Stock Reports </h3>




                                         <div class="Reprot-Genarate" style="margin-left: 80%">
                                          <form action="{{route('CategoryWiseSameStockpdf')}}" method="post">
                                            @csrf

                                            <input type="hidden" value="{{@$cat_id}}" name="category_id">


                                            <button style="color:none;background: #f5f9fb;
                                            padding: 10px 15px;
                                            /* font-size: 15px; */
                                            border-radius: 5px;
                                            border: none;"  type="submit"><i style="font-size:15px" class="fa fa-print fa-3x"></i></button>
                                          </form>


                                         {{-- <a href="{{ route('pdfview',['download'=>'pdf']) }}">Download PDF</a> --}}

                                        </div>

                                        <h5>{{ @$category->category_name}}</h5>


                                        <table id="copy-print-csv" class="table custom-table">
                                            <thead>
                                            <tr align="center">
                                                <th>SL</th>
                                                <th>Product Sku</th>
                                                <th>Product</th>
                                                <th>Price</th>
                                                <th>Purchas Qty</th>
                                                <th>Purchas Amount</th>
                                                <th>Sold Qty</th>
                                                <th>Sold Amount</th>
                                                <th>Current Qty</th>
                                                <th>Current Amount</th>




                                            </tr>
                                            </thead>
                                            <tbody>

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
                                            <tr>

                                                <td colspan="4"></td>

                                                <td colspan="2" style="text-align:center"><span style="color:red">Total</span> : &nbsp;&nbsp; {{ @$FinalTotalPurchesAmount }} Taka</td>
                                                <td colspan="2" style="text-align:center"><span style="color:red">Total</span> : &nbsp;&nbsp; {{ @$FinalTotalSoldAmount }} Taka</td>
                                                <td colspan="2" style="text-align:center"><span style="color:red">Total</span> : &nbsp;&nbsp; {{ @$FinalTotalCurrentAmount }} Taka</td>

                                            </tr>
                                        </table>

                                    </div>
                                </div>
                            </div> <!-- end col -->
                        </div> <!-- end row -->



@endsection


