@extends('UserDashboard.master')
@section('title') Slider Edit @endsection
@section('user-content')
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        <div class="card">
            <div class="card-body">

                <h2 style="font-family: monospace;font-weight: normal;">Slider Edit:</h2>

                <form action="{{ route('UserSliderUpdate') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <input type="hidden" value="{{@$edite->id}}" name="EditeId">

                    <div class="row gutters">




                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                            <div class="form-group">
                                <label for="inputName">Image</label>
                                <input type="file" class="form-control @error('image') is-invalid @enderror" name="image" id="imgInp" placeholder="Enter  title">

                                <span style="color:red">Max Size: Width:1349px, Height:360px</span>
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
                                <img style="width: 200px;" src="{{(@$edite->image)?url('upload/Client/Slider/'.@$edite->image):''}}" alt="">

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