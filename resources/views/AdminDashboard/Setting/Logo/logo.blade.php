@extends('AdminDashboard.master')

@section('admin-content')
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        <div class="card">
            <div class="card-body">

                 <h2 style="font-family: monospace;font-weight: normal;">Logo Manage:</h2>

                <form action="{{route('SettingLogoUpdate')}}" method="POST" enctype="multipart/form-data">
                    @csrf

                <div class="row gutters">
                    <div class="col-xl-12 col-lglg-12 col-md-12 col-sm-12 col-12">
                        <div class="form-group">
                            <label for="inputName">Logo</label>
                            <input type="file" class="form-control" name="logo" id="imgInp" placeholder="Enter full name">
                            <span style="color:red">Max size: Width:160px,height:42px</span>
                        </div>
                    </div>


                 @if(@$logo->logo)

                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                            <div class="form-group">
                                <label for="inputName">Old Image</label> <br>
                                <img  style="width: 100px;" src="{{(@$logo->logo)?url('upload/Admin/Logo/'.@$logo->logo):''}}" alt="your image" />
                            </div>
                        </div>

                     @else

                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                            <div class="form-group">
                                <label for="inputName">Preview Image</label> <br>
                                <img id="blah" style="width: 100px;" src="#" alt="your image" />
                            </div>
                        </div>

                        <script>
                            imgInp.onchange = evt => {
                                const [file] = imgInp.files
                                if (file) {
                                    blah.src = URL.createObjectURL(file)
                                }
                            }
                        </script>

                    @endif


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