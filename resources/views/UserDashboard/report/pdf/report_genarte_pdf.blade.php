<!DOCTYPE html>
<html>
<head>
    <title>Monthly Yearly Invoice</title>
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
                                <span style="font-size: 12px">Mo: {{$pdfInfo->mobile}}</span>
                            </td>
                            <td style="text-align: center;width: 30%"></td>
                        </tr>
                    </thead>
                  
                  </table>

                <hr>

                  <h3>Monthly Yearly Invoice</h3>

                     <h4 style="" class="card-title">{{@$s_date}} <font style="color:green">To</font> {{@$e_date}} </h4>



                  <table width="100%" border="1" cellspacing="0" cellpadding="0" style="margin-top: 40px;">
                   <thead>
                                      <tr>
                                            <th style="text-align: center;padding:5px;">Sl</th>
                                               <th style="text-align: center;padding:5px;">Customer Name</th>
                                               <!--<th style="text-align: center;padding:5px;">Customer Address</th>-->
                                               <!--<th style="text-align: center;padding:5px;">Customer Mobile</th>-->
                                               <th style="text-align: center;padding:5px;">Date</th>
                                               <th style="text-align: center;padding:5px;">Payment</th>
                                               <th style="text-align: center;padding:5px;">Price</th>
                                             </tr>
                                  </thead>


                                <tbody>

                                             @php
                                            $sl=1;
                                            $total=0;
                                            @endphp
                                             @foreach(@$Report as $report)
                                             
                                             @php
                                              @$total+=$report->total_ammount;
                                              
                                             @endphp
                                              <tr>
                                                <td style="text-align: center;padding: 5px">{{@$sl++}}</td>
                                                <td style="text-align: center;padding: 5px">{{@$report->customer['name']}}</td>
                                                <!--<td style="text-align: center;padding: 5px">{{@$report->customer['address']}}</td>-->
                                                <!--<td style="text-align: center;padding: 5px">{{@$report->customer['mobile']}}</td>-->
                                                <td style="text-align: center;padding: 5px">{{date('D-M-Y',strtotime($report->created_at))}}</td>
                                                <td style="text-align: center;padding: 5px">{{@$report->payments['payment']}}</td>
                                                <td style="text-align: center;padding: 5px">${{@$report->total_ammount}}</td>
                                              </tr>
                                             @endforeach

{{-- 
                                             <tr>
                                               
                                               <td colspan="4" style="text-align: right;font-weight: bold;color:green;font-size: 15px">Payment Type :-</td>
                                               <td colspan="5" style="font-weight: bold;color:green;font-size: 15px">{{@$Payment}} Taka</td>
                                             </tr> --}}

                                             <tr>
                                               
                                               <td colspan="4" style="text-align: right;font-weight: bold;color:green;font-size: 15px;padding:5px">Total Ammount :-</td>
                                               <td colspan="4" style="font-weight: bold;color:green;font-size: 15px;padding:5px">${{@$total}}</td>
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