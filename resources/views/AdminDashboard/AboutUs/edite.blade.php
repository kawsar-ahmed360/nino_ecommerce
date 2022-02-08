@extends('AdminDashboard.master')
@section('title') AboutUs Edit @endsection
@section('admin-content')
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        <div class="card">
            <div class="card-body">

                <h2 style="font-family: monospace;font-weight: normal;">AboutUs Edit:</h2>

                <form action="{{ route('AboutUsUpdate') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <input type="hidden" value="{{@$edite->id}}" name="EditeId">

                    <div class="row gutters">


                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                            <div class="form-group">
                                <label for="inputName">Title</label>
                                <input type="text" class="form-control @error('title') is-invalid @enderror" value="{{@$edite->title}}" name="title" id="imgInp" placeholder="Enter title">
                                @error('title')
                                <span class="invalid-feedback" role="alert">
                                               	 <strong style="color:red">{{$message}}</strong>
                                               </span>
                                @enderror
                            </div>
                        </div>


                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                            <div class="form-group">
                                <label for="inputName">Short Title</label>
                                <textarea type="text" class="form-control ckeditor @error('short_title') is-invalid @enderror" name="short_title" id="imgInp" placeholder="Enter short_title">{!! @$edite->short_title !!}</textarea>
                                @error('short_title')
                                <span class="invalid-feedback" role="alert">
                                               	 <strong style="color:red">{{$message}}</strong>
                                               </span>
                                @enderror
                            </div>
                        </div>




                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                            <div class="form-group">
                                <label for="inputName">Image</label>
                                <input type="file" class="form-control ckeditor @error('image') is-invalid @enderror" name="image" id="imgInp" placeholder="Enter  title">

                                <span style="color:red">Max Size: Width:640px, Height:640px</span>
                                @error('image')
                                <span class="invalid-feedback" role="alert">
                                               	 <strong style="color:red">{{$message}}</strong>
                                               </span>
                                @enderror
                            </div>
                        </div>



                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                            <div class="form-group">
                                <label for="inputName">Old Image</label> <br>

                                <img style="width: 100px;" src="{{(@$edite->image)?url('upload/Client/About/'.@$edite->image):''}}" alt="">

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

@endsection