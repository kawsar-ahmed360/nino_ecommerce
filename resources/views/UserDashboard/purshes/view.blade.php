@extends('UserDashboard.master')

@section('title') View Purchase @endsection
@section('user-content')

<div class="row">
                            <div class="col-12">

                            </div>



                            <!DOCTYPE html>
<html lang="en">
<head>
  <!--<title>Bootstrap Example</title>-->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

</head>
<body>
<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
    <div class="card">
        <div class="card-body" style="min-width: 1035px">

         @if(Session::has('update'))

                <div class="alert alert-success">{{Session::get('update')}}</div>
         @endif

             <h2 style="text-align: center;background: none;color: #ef5252;padding: 7px;border-radius: 3px; border: 2px dotted black;font-family: cursive;">Purchase View <span style="float: right;"></span></h2>

          <table id="copy-print-csv" class="table table-hover" style="">
          	<thead>
          		<tr style="text-align: center;">
          			<th>purshes_no</th>
                <th>date</th>
                {{-- <th>supliar_id</th> --}}
                <th>cat_id</th>
                <th>product_id</th>
                <th>buying_qty</th>
                <th>buying_price</th>
                <th>subtotal</th>
                <th>status</th>



                <th>Action</th>
          		</tr>

                <tbody>

                	@foreach($all as $it)



                	<tr style="text-align: center;">
                		<td>{{@$it->purshes_no}}</td>
                    <td>{{@$it->date}}</td>
                    {{-- <td>{{$it->supliars['name']}}</td> --}}
                    <td>{{@$it->categorys['category_name']}}</td>
                    <td>{{@$it->products['product_name']}}</td>
                    <td>
                      {{@$it->bying_qty}}
                      {{-- {{ $it->products->units['name'] }} --}}
                    </td>
                    <td>${{@$it->bying_price}}</td>
                    <td>${{@$it->subtotal}}</td>
                    <td>
                      @if(@$it->status=='0')
                        <span class="badge badge-danger">panding</span>

                        @else

                        <span class="badge badge-success">Approve</span>

                      @endif
                    </td>



                    <td>



                      @if($it->status=='0')
                      <a href="{{ route('Userpurshesadd_delete',$it->id) }}" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>
                      @else

                      @endif
                    </td>
                	</tr>

                	@endforeach
                </tbody>

          	</thead>
          </table>

        </div>

    </div>
    </div>

    </body>
    </html>

    </div>
</div>



@endsection
