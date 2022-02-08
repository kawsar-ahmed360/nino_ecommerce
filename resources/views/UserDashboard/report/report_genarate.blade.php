@extends('UserDashboard.master')
@section('title') Report Genarate Page @endsection
@section('user-content')
<div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">

                                        <h3 style="" class="card-title">Report Genarate Page :</h3>


                                          <form action="{{route('UserFinal_Report_Genarator')}}" method="POST">
                                            @csrf

                                               <div class="row">

                                                  <div class="col-md-5">
                                                    <label>Start Date</label>
                                                   <input type="date" class="form-control" name="s_date" id="s_date" >
                                                  </div>

                                                   <div class="col-md-5">
                                                    <label>End Date</label>
                                                   <input type="date" class="form-control" name="e_date" id="d_date" >
                                                  </div>

                                                  <div class="col-2" style="margin-top: 30px">
                                                     <button class="btn btn-success"><i class="fa fa-search"></i></button>
                                                  </div>


                                               </div>
                                            
                                          </form>
                                      

                                        
                                    </div>
                                </div>
                            </div> <!-- end col -->
                        </div> <!-- end row -->
                  
                      

@endsection




@section('footer')




@endsection