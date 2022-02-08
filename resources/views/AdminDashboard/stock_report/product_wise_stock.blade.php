@extends('AdminDashboard.master')
@section('title')Product Wise Stock Report  @endsection
@section('admin-content')
<div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">

                                        <h3 style="" class="card-title">Product Wise Stock Report </h3>


                                        <div class="Reprot-Genarate" style="margin-left: 80%">
                                          <form action="{{route('ProductWiseSameStockpdf')}}" method="post">
                                            @csrf

                                            <input type="hidden" value="{{@$category_id}}" name="category_id">
                                            <input type="hidden" value="{{@$product_id}}" name="product_id">


                                            <button style="color:none;background: #f5f9fb;
                                            padding: 10px 15px;
                                            /* font-size: 15px; */
                                            border-radius: 5px;
                                            border: none;"  type="submit"><i style="font-size: 16px;" class="fa fa-print fa-3x"></i></button>
                                          </form>


                                         {{-- <a href="{{ route('pdfview',['download'=>'pdf']) }}">Download PDF</a> --}}

                                        </div>

                                        <br>


                                        <table id="copy-print-csv" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
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


                                                {{--$pushceTotal = @$pro->discount?$pro->new_price*$pro->total_qty:$pro->product_price*$pro->total_qty;--}}
                                                {{--$soldOut = ($pro->total_qty - $pro->product_qty);--}}
                                                {{--$SoldOutAmount =@$pro->discount?$pro->new_price * $soldOut:$pro->product_price * $soldOut;--}}
                                                {{--$totalCurrentAmount =@$pro->discount?$pro->new_price * $pro->product_qty:$pro->product_price * $pro->product_qty;--}}
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
                                                   <td>{{ @$sl++ }}</td>
                                                   <td>
                                                       
                                                       @if(empty($pro->product_sku))
                                                       null
                                                       @else
                                                        {{@$pro->product_sku}}
                                                       @endif
                                                       
                                                   </td>
                                                   <td>{{ $pro->product_name }}</td>
                                                   <td>{{ @$round_price }} Taka</td>
                                                   <td>{{ $pro->total_qty }} Piece</td>
                                                   <td>{{ $pushceTotal }} Taka</td>
                                                   <td>{{ @$soldOut }} Piece</td>
                                                   <td>{{ @$SoldOutAmount }} Taka</td>
                                                   <td>{{ @$pro->product_qty }} Piece</td>
                                                   <td>{{ @$totalCurrentAmount }} Taka</td>


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
                                               
                                               
                                                <tr>
                                                 
                                                    <td></td>
                                                     <td></td>
                                                      <td></td>
                                                       <td></td>
                                                    <td colspan="2" style="text-align:center"><span style="color:red">Total</span> : &nbsp;&nbsp; {{ @$FinalTotalPurchesAmount }} Taka</td>
                                                    <td colspan="2" style="text-align:center"><span style="color:red">Total</span> : &nbsp;&nbsp; {{ @$FinalTotalSoldAmount }} Taka</td>
                                                    <td colspan="2" style="text-align:center"><span style="color:red">Total</span> : &nbsp;&nbsp; {{ @$FinalTotalCurrentAmount }} Taka</td>
                                                   
                                                </tr>


                                            </tbody>
                                        </table>
                                        
                                         

                                        <!--<table class="table table-bordered table-striped" style="width: 300px;display:block;margin:0 auto;backeground:black;color:#A8B2BC">-->
                                        <!--    <tr>-->
                                        <!--        <td style="background: black;">Total Purchas Amount</td>-->
                                        <!--        <td style="background:black;color:red;font-weight:bold">{{ @$FinalTotalPurchesAmount }} Taka</td>-->
                                        <!--    </tr>-->
                                        <!--    <tr>-->
                                        <!--        <td style="background: black;">Total Sold Amount</td>-->
                                        <!--        <td style="background:black;color:red;font-weight:bold">{{ @$FinalTotalSoldAmount }} Taka</td>-->
                                        <!--    </tr>-->
                                        <!--    <tr>-->
                                        <!--        <td style="background: black;">Total Current Amount</td>-->
                                        <!--        <td style="background:black;color:red;font-weight:bold">{{ @$FinalTotalCurrentAmount }} Taka</td>-->
                                        <!--    </tr>-->
                                        <!--</table>-->
                                    </div>
                                </div>
                            </div> <!-- end col -->
                        </div> <!-- end row -->



@endsection


