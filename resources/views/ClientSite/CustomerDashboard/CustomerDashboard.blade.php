@extends('ClientSite.master')
@section('title') Dashboard @endsection

@section('client-content')



    <section class="section-padding bg-dark inner-header" style="background: url(fontend/img/inner-bg.jpg) center bottom -45px rgba(0, 0, 0, 0)!important">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center">
                    <h1 class="mt-0 mb-3 text-white">My Profile</h1>
                    <div class="breadcrumbs">
                        <p class="mb-0 text-white">
                            <a href="#" class="text-white">Home</a> / <span class="text-success">My Profile</span>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>




    <section class="account-page section-padding">
        <div class="container">
            <div class="row">
                <div class="col-lg-9 mx-auto">
                    <div class="row no-gutters">
                        <div class="col-md-4">
                            <div class="card account-left">


                                @include('ClientSite.CustomerDashboard.Menu.menu')

                            </div>
                        </div>
                        <div class="col-md-8">


                            <div class="card card-body account-right">
                                <div class="widget">
                                    <div class="section-header">
                                        <h5 class="heading-design-h5"> My Profile </h5>
                                    </div>
                                    <form action="{{route('CustomerProfile')}}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <input type="hidden" value="{{Session::get('customer_id')}}" name="Customer_id">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="form-group">
                                                    <label class="control-label">Name <span class="required">*</span>
                                                    </label>
                                                    <input class="form-control border-form-control" name="name" value="{{@$customer_info->name}}" placeholder="name" type="text">
                                                </div>
                                            </div>

                                        </div>
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label class="control-label">Phone <span class="required">*</span>
                                                    </label>
                                                    <input type="text" class="form-control border-form-control" readonly  value="{{@$customer_info->mobile}}" placeholder="123 456 7890">
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label class="control-label">Email Address<span class="required">*</span>
                                                    </label>
                                                    <input class="form-control border-form-control" name="email"  value="{{@$customer_info->email}}" placeholder="iamosahan@gmail.com" type="email">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label class="control-label">Country <span class="required">*</span>
                                                    </label>
                                                    <select name="country_id" id="countryId" class="select2 form-control border-form-control">
                                                        <option selected disabled>Select Country</option>
                                                         @foreach(@$country as $country)
                                                            <option value="{{$country->id}}" {{(@$customer_info->country_id==$country->id)?'selected':''}}>{{@$country->name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>


                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label class="control-label">State <span class="required">*</span>
                                                    </label>
                                                    <select id="stateId" name="state_id" class="select2 form-control border-form-control">
                                                        @if(@$customer_info->State->name)
                                                        <option value="{{@$customer_info->State->id}}">{{@$customer_info->State->name}}</option>
                                                            @else
                                                        <option value="">Select State</option>
                                                            @endif

                                                    </select>
                                                </div>
                                            </div>


                                        </div>
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label class="control-label">City <span class="required">*</span>
                                                    </label>
                                                    <select id="CityId" name="city_id" class="select2 form-control border-form-control">
                                                        @if(@$customer_info->Citie->name)
                                                            <option value="{{@$customer_info->Citie->id}}">{{@$customer_info->Citie->name}}</option>
                                                            @else
                                                        <option >Select City</option>
                                                            @endif

                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label class="control-label">Zip Code <span class="required">*</span>
                                                    </label>
                                                    <input name="zip_code" class="form-control border-form-control" value="{{@$customer_info->zip_code}}" placeholder="123456" type="number">
                                                </div>
                                            </div>

                                        </div>
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="form-group">
                                                    <label class="control-label">Address <span class="required">*</span>
                                                    </label>
                                                    <textarea name="address" class="form-control border-form-control">{!! @$customer_info->address !!}</textarea>
                                                </div>
                                            </div>
                                        </div>


                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="form-group">
                                                    <label class="control-label">Profile <span class="required">*</span>
                                                    </label>
                                                    <input type="file" name="image" class="form-control">
                                                    <span style="color:red">Max Size: Height:100px, Width:100px</span>
                                                </div>
                                            </div>
                                        </div>


                                        <div class="row">
                                            <div class="col-sm-12 text-right">
                                                <button type="button" class="btn btn-secondary btn-lg"> Cencel </button>
                                                <button type="submit" class="btn btn-info btn-lg"> Save Changes </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>



                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    @section('client-footer')

        <script>
            $('#countryId').on('change',function () {
                var countryId = $(this).val();
                $.ajax({
                    url:"{{route('CountryToState')}}",
                    type:"GET",
                    data:{countryId:countryId},
                    success:function (data) {

                        var html = "<option>---select Once--</option>";
                        
                        $.each(data,function (k,v) {
                            html+="<option value='"+v.id+"'>"+v.name+"</option>";
                        })
                        $('#stateId').empty().html(html);

                    }
                })
            })

            $('#stateId').on('change',function () {
                var stateId = $(this).val();
                $.ajax({
                    url:"{{route('CountryToCity')}}",
                    type:"GET",
                    data:{stateId:stateId},
                    success:function (data) {

                        var html = "<option>---select Once--</option>";

                        $.each(data,function (k,v) {
                            html+="<option value='"+v.id+"'>"+v.name+"</option>";
                        })
                        $('#CityId').empty().html(html);

                    }
                })
            })


        </script>

    @endsection

@endsection