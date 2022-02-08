@extends('UserDashboard.master')
@section('title') Color Create @endsection
@section('user-content')
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        <div class="card">
            <div class="card-body">

                <h2 style="font-family: monospace;font-weight: normal;">Color Create:</h2>

                <form action="{{ route('UserColorStore') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="row gutters">


                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-6">
                            <div class="form-group">
                                <label for="inputName">Color Name</label>
                                <input type="text" class="form-control @error('color_name') is-invalid @enderror" name="color_name" id="imgInp" placeholder="Enter color_name">
                                @error('color_name')
                                <span class="invalid-feedback" role="alert">
                                               	 <strong style="color:red">{{$message}}</strong>
                                               </span>
                                @enderror
                            </div>
                        </div>


                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-6">
                            <div class="form-group">
                                <label for="inputName">Status</label>
                                <select name="status" class="form-control" id="status">
                                    <option disabled selected>----Select Once------</option>
                                    <option value="1">Active</option>
                                    <option value="2">Deactive</option>
                                </select>
                            </div>
                        </div>








                        {{--<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">--}}
                            {{--<h4>Seo Tools:  <button style="background: none;--}}
                                            {{--border: 1px solid burlywood;--}}
                                            {{--padding: 3px;" type="button" class="" data-toggle="collapse" data-target="#demo"><span class="glyphicon glyphicon-sort"></span></button><h4>--}}

                                    {{--<div id="demo" class="collapse">--}}
                                        {{--<div class="row">--}}
                                            {{--<div class="col-md-12">--}}
                                                {{--<label for="" style="display: inline-block; max-width: 100%;--}}
                                            {{--margin-bottom: 5px;font-weight: normal;">Meta Title</label>--}}
                                                {{--<input type="text" class="form-control" name="meta_title" id="meta_title" placeholder="Enter meta title">--}}
                                            {{--</div>--}}
                                        {{--</div>--}}
                                        {{--<div class="row">--}}
                                            {{--<div class="col-md-12">--}}
                                                {{--<label for="" style="display: inline-block; max-width: 100%;--}}
                                            {{--margin-bottom: 5px;font-weight: normal;">Meta Description</label>--}}
                                                {{--<textarea class="form-control" name="meta_des" id="meta_des" cols="20" rows="6"></textarea>--}}
                                            {{--</div>--}}
                                        {{--</div>--}}
                                    {{--</div>--}}







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

@endsection