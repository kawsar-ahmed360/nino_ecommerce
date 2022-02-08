@extends('UserDashboard.master')
@section('title') Logo Edit @endsection
@section('user-content')
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        <div class="card">
            <div class="card-body">

                <h2 style="font-family: monospace;font-weight: normal;">Logo Edit:</h2>

                <form  action="{{ route('UserLogoUpdate',$edite->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="row gutters">


                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-6">
                            <div class="form-group">
                                <label for="inputName">Logo</label>
                                <input type="file" class="form-control @error('logo') is-invalid @enderror" name="logo" id="imgInp" placeholder="Enter  title">
                                <span style="color:red">Max Size: Width:120px, Height:60px</span>
                                @error('logo')
                                <span class="invalid-feedback" role="alert">
                                               	 <strong style="color:red">{{$message}}</strong>
                                               </span>
                                @enderror
                            </div>
                        </div>


                        @if($edite->logo)
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-6">
                            <div class="form-group">
                                <label for="inputName">Old Image</label>
                                <img src="{{(@$edite->logo)?url('upload/Client/Logo/'.@$edite->logo):''}}" alt="">

                            </div>
                        </div>
                        @else

                            @endif





                        {{--<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">--}}
                            {{--<h4>Seo Tools:  <button style="background: none;--}}
                                            {{--border: 1px solid burlywood;--}}
                                            {{--padding: 3px;" type="button" class="" data-toggle="collapse" data-target="#demo"><span class="glyphicon glyphicon-sort"></span></button><h4>--}}

                                    {{--<div id="demo" class="collapse">--}}
                                        {{--<div class="row">--}}
                                            {{--<div class="col-md-12">--}}
                                                {{--<label for="" style="display: inline-block; max-width: 100%;--}}
                                            {{--margin-bottom: 5px;font-weight: normal;">Meta Title</label>--}}
                                                {{--<input type="text" class="form-control" name="meta_title" value="{{@$page->meta_title}}" id="meta_title" placeholder="Enter meta title">--}}
                                            {{--</div>--}}
                                        {{--</div>--}}
                                        {{--<div class="row">--}}
                                            {{--<div class="col-md-12">--}}
                                                {{--<label for="" style="display: inline-block; max-width: 100%;--}}
                                            {{--margin-bottom: 5px;font-weight: normal;">Meta Description</label>--}}
                                                {{--<textarea class="form-control" name="meta_des" id="meta_des" cols="20" rows="6">{!!@$page->meta_des!!}</textarea>--}}
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