@extends('UserDashboard.master')
@section('title') Daily Repport @endsection
@section('user-content')

<div class="row">
                            <div class="col-12">

                            </div>



                            <!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
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

     <h2 style="text-align: center;background: none;color: #ef5252;padding: 7px;border-radius: 3px; border: 2px dotted black;font-family: cursive;">Purchase Daily Report View <span style="float: right;"></span></h2>

       <form action="{{ route('Userpurshesadd_dailyreport_genarate') }}" method="GET">


          <div class="row">

            <div class="col-md-4">
              <label>First Date</label>
              <input type="date" class="form-control" name="fdate" placeholder="DD-MM-YY">
            </div>

            <div class="col-md-4">
              <label>Last Date</label>
              <input type="date" class="form-control" name="ldate" placeholder="DD-MM-YY">
            </div>

            <div class="col-md-4" style="margin-top: 30px">
             <button type="submit" class="btn btn-success">Submit</button>
            </div>


          </div>

       </form>

	</div>
	</div>

</body>
</html>

                        </div>
                        </div>



@endsection
