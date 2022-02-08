@extends('AdminDashboard.master')
@section('title') Mothly/Yearly Genarate Report @endsection
@section('admin-content')
<div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
                                       <h3>Mothly/Yearly Genarate Report:</h3>

                                        <h4 style="" class="card-title">{{@$s_date}} <font style="color:green">To</font> {{@$e_date}} </h4>

                                        <div class="Reprot-Genarate" style="margin-left: 80%">
                                          <form action="{{route('PdfFinal_Report_Genarator')}}" method="post">
                                            @csrf

                                            <input type="hidden" value="{{@$s_date}}" name="s_date">
                                            <input type="hidden" value="{{@$e_date}}" name="e_date">

                                            <button style="color:none;background: #f5f9fb;
                                                padding: 10px 15px;
                                                /* font-size: 15px; */
                                                border-radius: 5px;
                                                border: none;"  type="submit">
                                                <i style="font-size:17px" class="fa fa-print fa-3x"></i></button>
                                          </form>


                                         {{-- <a href="{{ route('pdfview',['download'=>'pdf']) }}">Download PDF</a> --}}

                                        </div>


                                         <table id="copy-print-csv" class="table table-striped " style="margin-top: 30px">
                                           <thead>
                                             <tr>
                                               <th style="text-align: center">Sl</th>
                                               <th style="text-align: center">Order Id</th>
                                               <th style="text-align: center">Customer Name</th>
                                               <!--<th style="text-align: center">Customer Address</th>-->
                                               <!--<th style="text-align: center">Customer Mobile</th>-->
                                               <th style="text-align: center">Date</th>
                                               <th style="text-align: center">Payment</th>
                                               <th style="text-align: center">Price</th>
                                             </tr>
                                           </thead>
                                           <tbody>
                                            @php
                                            $sl=1;
                                            $total=0;
                                            @endphp
                                             @foreach(@$Report as $report)
                                            @php
                                              $total+=$report->total_ammount;


                                             @endphp
                                              <tr>
                                                <td style="text-align: center">{{@$sl++}}</td>
                                                
                                                <td style="text-align:center">#{{@$report->orderId}}</td>
                                                
                                                <td style="text-align: center">{{@$report->customer['name']}}</td>
                                                <!--<td style="text-align: center">{{@$report->customer['address']}}</td>-->
                                                <!--<td style="text-align: center">{{@$report->customer['mobile']}}</td>-->
                                                <td style="text-align: center">{{date('d-m-Y',strtotime($report->created_at))}}</td>
                                                <td style="text-align: center">{{@$report->payments['payment']}}</td>
                                                <td style="text-align: center">${{@$report->total_ammount}}</td>
                                              </tr>
                                             @endforeach


                                            {{--  <tr>

                                               <td colspan="5" style="text-align: right;font-weight: bold;color:green;font-size: 15px">Payment Type :-</td>
                                               <td colspan="5" style="font-weight: bold;color:green;font-size: 15px">{{@$Payment}} Taka</td>
                                             </tr> --}}


                                           </tbody>

                                             <tr>

                                                 <td colspan="6" style="text-align: right;color:black;font-size: 20px;font-weight: bold;">Total Amount :- ${{ @$total }}</td>
                                                 <td colspan="6" style="font-weight: bold;color:green;font-size: 20px"></td>
                                             </tr>
                                         </table>





                                    </div>
                                </div>
                            </div> <!-- end col -->
                        </div> <!-- end row -->



@endsection




@section('footer')




@endsection
