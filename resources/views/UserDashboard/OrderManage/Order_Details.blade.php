@extends('UserDashboard.master')
@section('title') Order Details @endsection
@section('user-content')

    <div class="row">



        <div class="col-md-12">
            <div class="table-container">



              <div class="row">
                  <div class="col-md-6">
                      <div class="t-header" style="font-size: 19px">Customer Information </div>
                      <table class="table-striped">
                          <tr>
                              <th style="padding: 10px;">Name</th>
                              <td style="padding: 10px;">{{@$order->customer->name}}</td>
                          </tr>
                          <tr>
                              <th style="padding: 10px;">Email</th>
                              <td style="padding: 10px;">{{@$order->customer->email}}</td>
                          </tr>

                          <tr>
                              <th style="padding: 10px;">Email</th>
                              <td style="padding: 10px;">{{@$order->customer->mobile}}</td>
                          </tr>

                          <tr>
                              <th style="padding: 10px;">Address</th>
                              <td style="padding: 10px;">{{@$order->customer->address}}</td>
                          </tr>

                          <tr>
                              <th style="padding: 10px;">Zip</th>
                              <td style="padding: 10px;">{{@$order->customer->zip_code}}</td>
                          </tr>

                      </table>
                  </div>

                  <div class="col-md-6">
                      <div class="t-header" style="font-size: 19px">Shipping Information </div>


                      @if(@$order->BillingInfo->other_shipment=='other_shipment')
                      <table class="table-striped" style="width: 100%;">
                          <tr>
                              <th style="padding: 10px;">OrderId</th>
                              <td style="padding: 10px;">#{{@$order->orderId}}</td>
                          </tr>
                          <tr>
                              <th style="padding: 10px;">Name</th>
                              <td style="padding: 10px;">{{@$order->BillingInfo->shipping_fname }} {{@$order->BillingInfo->shipping_lname }} </td>
                          </tr>

                          <tr>
                              <th style="padding: 10px;">Mobile</th>
                              <td style="padding: 10px;">{{@$order->BillingInfo->shipping_mobile}}</td>
                          </tr>

                          <tr>
                              <th style="padding: 10px;">Address</th>
                              <td style="padding: 10px;">{{@$order->BillingInfo->shipping_address}}</td>
                          </tr>

                          <tr>
                              <th style="padding: 10px;">City</th>
                              <td style="padding: 10px;">{{@$order->BillingInfo->shipping_city_name}}</td>
                          </tr>

                          <tr>
                              <th style="padding: 10px;">Country</th>
                              <td style="padding: 10px;">{{@$order->BillingInfo->billing_country_name}}</td>
                          </tr>

                          <tr>
                              <th style="padding: 10px;">State</th>
                              <td style="padding: 10px;">{{@$order->BillingInfo->shipping_state_name}}</td>
                          </tr>

                          <tr>
                              <th style="padding: 10px;">Zip</th>
                              <td style="padding: 10px;">{{@$order->BillingInfo->shipping_zip_code}}</td>
                          </tr>

                      </table>

                          @else

                          <table class="table-striped" style="width: 100%;">
                              <tr>
                                  <th style="padding: 10px;">OrderId</th>
                                  <td style="padding: 10px;">#{{@$order->orderId}}</td>
                              </tr>
                              <tr>
                                  <th style="padding: 10px;">Name</th>
                                  <td style="padding: 10px;">{{@$order->BillingInfo->billing_fname}} {{@$order->BillingInfo->billing_lname}}</td>
                              </tr>

                              <tr>
                                  <th style="padding: 10px;">Mobile</th>
                                  <td style="padding: 10px;">{{@$order->BillingInfo->billing_mobile}}</td>
                              </tr>

                              <tr>
                                  <th style="padding: 10px;">Address</th>
                                  <td style="padding: 10px;">{{@$order->BillingInfo->billing_address}}</td>
                              </tr>

                              <tr>
                                  <th style="padding: 10px;">City</th>
                                  <td style="padding: 10px;">{{@$order->BillingInfo->billing_city_name}}</td>
                              </tr>

                              <tr>
                                  <th style="padding: 10px;">Country</th>
                                  <td style="padding: 10px;">{{@$order->BillingInfo->billing_country_name}}</td>
                              </tr>

                              <tr>
                                  <th style="padding: 10px;">State</th>
                                  <td style="padding: 10px;">{{@$order->BillingInfo->billing_state_name}}</td>
                              </tr>

                              <tr>
                                  <th style="padding: 10px;">Zip</th>
                                  <td style="padding: 10px;">{{@$order->BillingInfo->billing_zip_code}}</td>
                              </tr>


                          </table>

                      @endif
                  </div>
              </div>

                <hr>
                <hr>

                <div class="t-header">Order Details </div>
                <div class="table-responsive">

                        <table id="copy-print-csv"  class="table table-striped table-bordered dt-responsive nowrap">
                            <thead>
                            <tr>
                                <th>sl</th>
                                <th>SQU</th>
                                <th>Product Name</th>
                                <th>Carat</th>
                                <th>Qty</th>
                                <th>Price</th>
                                <th>Discount</th>
                            </tr>
                            </thead>
                            <tbody id="">

                             @foreach(@$order->order_details as $key=>$order)
                                  <tr>
                                      <td>{{@$key+1}}</td>
                                      <td>#{{@$order->products->product_sku}}</td>
                                      <td>{{@$order->products->product_name}}</td>
                                      <td>{{@$order->products->carat}}</td>
                                      <td>{{@$order->qty}}</td>
                                      <td>{{@$order->product_price}}</td>
                                      <td>%{{@$order->orders->discount}}</td>
                                  </tr>
                             @endforeach

                            </tbody>

                            <tr>
                                <td colspan="6" class="text-right">Payment Type</td>
                                <td colspan="4">@if(@$order->orders->payments['payment']!=null) {{@$order->orders->payments['payment']}} @else Null @endif</td>

                            </tr>

                            <tr>
                                <td colspan="6" class="text-right">Shipping Charge </td>
                                <td colspan="4">$@if(@$order->orders['shipment_amount']!=null) {{@$order->orders['shipment_amount']}} @else Null @endif</td>

                            </tr>

                            <tr>
                                <td colspan="6" class="text-right">Shipping </td>
                                <td colspan="4">@if(@$order->orders['shipment_name']!=null) {{@$order->orders['shipment_name']}} @else Null @endif</td>

                            </tr>

                            <tr>
                                <td colspan="6" class="text-right">Coupon </td>
                                <td colspan="4">@if(@$order->orders['coupon']!=null) {{@$order->orders['coupon']}} @else Null @endif</td>

                            </tr>


                            <tr>
                                <td colspan="6" class="text-right">Total Amount</td>
                                <td colspan="4">$@if(@$order->orders['total_ammount']) {{@$order->orders['total_ammount']}} @else Null @endif</td>

                            </tr>

                        </table>


                </div>
            </div>

        </div>
    </div>


@endsection

