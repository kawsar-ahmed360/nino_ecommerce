@extends('AdminDashboard.master')
@section('title') Coupon Page  @endsection

@section('admin-content')
    <div class="table-container">
        <div class="t-header">All Coupon </div>
        <div class="">

            <div class="row gutters">


                <div class="col-xl-5 col-lg-5 col-md-5 col-sm-5 col-5">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                        <div class="card">
                            <div class="card-body">

                                <h3 style="font-family: monospace;font-weight: normal;">Coupon @if(@$edite) Edit: @else Create: @endif</h3>

                                <form action="@if(@$edite){{ route('CouponUpdate') }} @else{{ route('CouponStore') }}@endif" method="POST" enctype="multipart/form-data">
                                    @csrf

                                    @if(@$edite)
                                        <input type="hidden" value="{{@$edite->id}}"name="EditeId">
                                    @else

                                    @endif

                                    <div class="row gutters">


                                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                            <div class="form-group">
                                                <label for="inputName">Coupon Name</label>
                                                <input type="text" class="form-control @error('coupon_name') is-invalid @enderror" @if(@$edite->coupon_name) value="{{@$edite->coupon_name}}" @else @endif name="coupon_name" id="imgInp" placeholder="Enter coupon name">
                                                @error('coupon_name')
                                                <span class="invalid-feedback" role="alert">
                                               	 <strong style="color:red">{{$message}}</strong>
                                               </span>
                                                @enderror
                                            </div>
                                        </div>



                                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                            <div class="form-group">
                                                <label for="inputName">Amount</label>
                                                <input type="text" class="form-control @error('amount') is-invalid @enderror" @if(@$edite->amount) value="{{@$edite->amount}}" @else @endif name="amount" id="imgInp" placeholder="Enter amount">
                                                @error('amount')
                                                <span class="invalid-feedback" role="alert">
                                               	 <strong style="color:red">{{$message}}</strong>
                                               </span>
                                                @enderror
                                            </div>
                                        </div>




                                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                            <div class="form-group">
                                                <label for="inputName">Status</label>
                                                <select name="status" class="form-control" id="">
                                                    <option selected disabled>-----Select Once-----</option>
                                                    <option value="1" {{(@$edite->status==1)?'selected':''}}>Active</option>
                                                    <option value="2" {{(@$edite->status==2)?'selected':''}}>Deactive</option>
                                                </select>
                                                @error('status')
                                                <span class="invalid-feedback" role="alert">
                                               	 <strong style="color:red">{{$message}}</strong>
                                               </span>
                                                @enderror
                                            </div>
                                        </div>




                                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                            <div class="text-right">
                                                <button type="button" id="submit" name="submit" class="btn btn-white">Cancel</button>
                                                <button type="submit" id="submit" name="submit" class="btn btn-primary">Submit Form</button>
                                            </div>
                                        </div>



                                    </div>

                            </div>
                            </form>
                        </div>
                    </div>

                </div>


                <div class="col-xl-7 col-lg-7 col-md-7 col-sm-7 col-7">



                    <table id="copy-print-csv" class="table custom-table">
                        <thead>
                        <tr>
                            <th>SL.</th>
                            <th>Coupon Name</th>
                            <th>Amount</th>
                            <th>Status</th>
                            {{--<th>Image</th>--}}
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($index as $key=>$index)
                            <tr class="odd gradeX">
                                <td>{{ @$key + 1 }}</td>
                                <td>{{ @$index->coupon_name }}</td>
                                <td>{{ @$index->amount }}</td>
                                <td>
                                @if(@$index->status=='1')
                                <span class="badge badge-success">Active</span>
                                @else
                                <span class="badge badge-danger">Deactive</span>
                                @endif
                                </td>

                                {{--                        <td><img src="{{ asset('upload/Client/Category/'.$category->image) }}" class="img-thumbnail" width="100" height="100" /></td>--}}
                                <td style="text-align: center;">


                                    <a href="{{route('CouponEdite',$index->id)}}" class="btn btn-info btn-sm"><i class="fa fa-edit"></i> Edit</a>
                                    <a  href="{{route('CouponDelete',$index->id)}}" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i> Delete</a>

                                </td>
                            </tr>

                        @endforeach


                        </tbody>
                    </table>
                </div>

            </div>






        </div>
    </div>



@endsection