@extends('ClientSite.master')
@section('title') Password Change @endsection

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
                                        <h5 class="heading-design-h5"> Password Change </h5>
                                    </div>
                                    <form action="{{route('CustomerPasswordPost')}}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <input type="hidden" value="{{Session::get('customer_id')}}" name="Customer_id">


                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="form-group">
                                                    <label class="control-label">Old Password <span class="required">*</span>
                                                    </label>
                                                    <input class="form-control border-form-control" name="old_password"  placeholder="Old Password" type="text">
                                                </div>
                                            </div>

                                            <div class="col-sm-12">
                                                <div class="form-group">
                                                    <label class="control-label">New Password <span class="required">*</span>
                                                    </label>
                                                    <input class="form-control border-form-control" name="password"  placeholder="Password" type="text">
                                                </div>
                                            </div>


                                            <div class="col-sm-12">
                                                <div class="form-group">
                                                    <label class="control-label">New Password <span class="required">*</span>
                                                    </label>
                                                    <input class="form-control border-form-control" name="Confirm_password"  placeholder="Confirm_password" type="text">
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



@endsection