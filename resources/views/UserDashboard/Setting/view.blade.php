@extends('UserDashboard.master')

@section('title')  Profile View @endsection

@section('user-content')

    <div class="row gutters">
        <div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 col-12">
            <div class="card h-100">
                <div class="card-body">
                    <div class="account-settings">
                        <div class="user-profile">
                            <div class="user-avatar">
                                <img src="{{(@$info->profile)?url('upload/User/Profile/'.$info->profile):asset('backend/img/user.png')}}" alt="Le Rouge Admin" />
                            </div>
                            <h5 class="user-name">{{$info->name??''}}</h5>
                            <h6 class="user-email">{{$info->email??''}}</h6>
                        </div>
                        <table class="table">
                            <tr>
                                <th>Name</th>
                                <td>{{@$info->name}}</td>
                            </tr>



                            <tr>
                                <th>Mobile</th>
                                <td>{{$info->mobile??''}}</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-9 col-lg-9 col-md-12 col-sm-12 col-12">
            <div class="card h-100">
                <div class="card-header">
                    <div class="card-title">Update Profile</div>
                </div>


                <form action="{{route('UserSettingUpdate')}}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <input type="hidden" value="{{Auth::user()->id}}" name="EditeId">
                    <div class="card-body">
                        <div class="row gutters">
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                <div class="form-group">
                                    <label for="fullName">Full Name</label>
                                    <input type="text" class="form-control" id="fullName" value="{{$info->name??''}}" name="name" placeholder="Enter full name">
                                </div>


                            </div>


                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                <div class="form-group">
                                    <label for="phone">Phone</label>
                                    <input type="text" class="form-control" id="phone" value="{{$info->mobile??''}}" name="mobile" placeholder="Enter phone number">
                                </div>

                            </div>

                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                <div class="form-group">
                                    <label for="addRess">Image</label>
                                    <input type="file" class="form-control" id="imgInp" name="profile" placeholder="Enter Address">
                                    <span style="color:red">Max Size: Width:500px,Height:500px</span>
                                </div>
                            </div>

                            @if(@$info->profile)

                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                    <div class="form-group">
                                        <label for="addRess">Old Image</label> <br>
                                        <img style="width: 100px;" src="{{(@$info->profile)?url('upload/User/Profile/'.$info->profile):''}}" alt="your image" />
                                    </div>
                                </div>

                            @else
                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                    <div class="form-group">
                                        <label for="addRess">Preview Image</label> <br>
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
    </div>
    <!-- Row end -->


@endsection