@extends('UserDashboard.master')
@section('title') Fontend Section Edit @endsection
@section('user-content')
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        <div class="card">
            <div class="card-body">

                <h2 style="font-family: monospace;font-weight: normal;">Fontend Section Edit:</h2>

                <form action="{{ route('UserSectionUpdate') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <input type="hidden" value="{{@$edite->id}}" name="EditeId">

                    <div class="row gutters">


                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-6">
                            <div class="form-group">
                                <label for="inputName">Section Name</label>
                                <input type="text" class="form-control @error('section_name') is-invalid @enderror" value="{{@$edite->section_name}}" name="section_name" id="imgInp" placeholder="Enter section_name">
                                @error('section_name')
                                <span class="invalid-feedback" role="alert">
                                               	 <strong style="color:red">{{$message}}</strong>
                                               </span>
                                @enderror
                            </div>
                        </div>


                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-6">
                            <div class="form-group">
                                <label for="inputName">Highlight</label>
                                <select name="highlight" class="form-control" id="highlight">
                                    <option disabled selected>----Select Once------</option>
                                    <option value="1" {{(@$edite->highlight=='1')?'selected':''}}>Yes</option>
                                    <option value="2" {{(@$edite->highlight=='2')?'selected':''}}>No</option>
                                </select>
                            </div>
                        </div>


                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-6">
                            <div class="form-group">
                                <label for="inputName">Add Image(1)</label>
                                <input type="file" class="form-control ckeditor @error('first_add_image') is-invalid @enderror" name="first_add_image" id="imgInp" placeholder="Enter  title">

                                <span style="color:red">Max Size: Width:540px, Height:174px</span>
                                @error('first_add_image')
                                <span class="invalid-feedback" role="alert">
                                               	 <strong style="color:red">{{$message}}</strong>
                                               </span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-6">
                            <div class="form-group">
                                <label for="inputName">Add(1) Url</label>
                                <input type="text" class="form-control @error('first_add_url') is-invalid @enderror" name="first_add_url" value="{{@$edite->first_add_url}}" id="imgInp" placeholder="Enter first_add_url">


                                @error('first_add_image')
                                <span class="invalid-feedback" role="alert">
                                               	 <strong style="color:red">{{$message}}</strong>
                                               </span>
                                @enderror
                            </div>
                        </div>


                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-6">
                            <div class="form-group">
                                <label for="inputName">Add Image(2)</label>
                                <input type="file" class="form-control ckeditor @error('second_add_image') is-invalid @enderror" name="second_add_image" id="imgInp" placeholder="Enter  title">

                                <span style="color:red">Max Size: Width:540px, Height:174px</span>
                                @error('second_add_image')
                                <span class="invalid-feedback" role="alert">
                                               	 <strong style="color:red">{{$message}}</strong>
                                               </span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-6">
                            <div class="form-group">
                                <label for="inputName">Add(2) Url</label>
                                <input type="text" class="form-control @error('second_add_url') is-invalid @enderror" value="{{@$edite->second_add_url}}" name="second_add_url" id="imgInp" placeholder="Enter second_add_url">


                                @error('second_add_url')
                                <span class="invalid-feedback" role="alert">
                                               	 <strong style="color:red">{{$message}}</strong>
                                               </span>
                                @enderror
                            </div>
                        </div>


                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-6">
                            <div class="form-group">
                                <label for="inputName">Old Add Image(1)</label> <br>
                                <img width="150px" src="{{(@$edite->first_add_image)?url('upload/Client/first_add_image/'.@$edite->first_add_image):''}}" alt="">

                            </div>
                        </div>


                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-6">
                            <div class="form-group">
                                <label for="inputName">Old Add Image(2)</label> <br>
                                <img width="150px" src="{{(@$edite->second_add_image)?url('upload/Client/second_add_image/'.@$edite->second_add_image):''}}" alt="">

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