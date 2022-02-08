@extends('AdminDashboard.master')
@section('title') Single Customer View @endsection
@section('admin-content')

    <div class="row gutters">
        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-6 offset-3">
            <div class="t-header"><h2 style="font-family: cursive;font-weight: normal;">Profile:</h2> </div>
            <div class="card-deck">

                <div class="card">

                      <table class="table table-striped">
                          <tr>

                              <td colspan="2"> <img class="card-img-top" style="width: 100px;height: 100px;margin:0 auto;display: block" src="{{(@$customer->image)?url('upload/Client/Customer_Profile/'.$customer->image):url('upload/Client/default_pro.png')}}" alt="Card image cap"></td>
                          </tr>

                          <tr>
                               <th>Name</th>
                                <td>{{@$customer->name}}</td>
                          </tr>

                          <tr>
                              <th>Email</th>
                              <td>{{@$customer->email}}</td>
                          </tr>

                          <tr>
                              <th>Mobile</th>
                              <td>{{@$customer->mobile}}</td>
                          </tr>

                          <tr>
                              <th>Address</th>
                              <td>{{@$customer->address}}</td>
                          </tr>

                          <tr>
                              <th>Zip Code</th>
                              <td>{{@$customer->zip_code}}</td>
                          </tr>
                      </table>
                    {{--<div class="card-body">--}}
                        {{--<h5 class="card-title">{{@$customer->name}}</h5>--}}
                        {{--<p class=""><strong>Email:</strong> {{@$customer->email}}</p>--}}
                        {{--<p class=""><strong>Mobile:</strong> {{@$customer->mobile}}</p>--}}
                        {{--<p class=""><strong>Mobile:</strong> {{@$customer->mobile}}</p>--}}
                        {{--<p class=""><strong>Address:</strong> {{@$customer->address}}</p>--}}


                    {{--</div>--}}
                </div>

            </div>
        </div>
    </div>

@endsection