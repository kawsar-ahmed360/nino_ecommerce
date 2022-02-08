@extends('ClientSite.master')

@section('title') Registration Page @endsection

@section('client-content')

    <section class="section-padding bg-dark inner-header">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center">
                    <h1 class="mt-0 mb-3 text-white">Customer Registration</h1>
                    <div class="breadcrumbs">
                        <p class="mb-0 text-white"><a href="#" class="text-white">Home</a> / <span class="text-success">Customer Registration</span></p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="shop-single section-padding">
        <div class="container">
            <div class="row">

                <div class="col-md-3">

                </div>


                <div class="col-md-5">
                    <div class="tab-pane" >
                        <h5 class="heading-design-h5 text-center">Registration account</h5>
                        <form action="{{route('CustomerRegistartionPost')}}" method="post">
                            @csrf
                            <fieldset class="form-group">
                                <label>Enter Email/Mobile number</label>
                                <input type="text" name="mobile" id="regis_mobile" class="form-control @error('mobile') is-invalid @enderror" placeholder="+91 123 456 7890">
                                @error('mobile')
                                <span class="invalid-feedback" role="alert">
                                                  <strong>{{ $message }}</strong>
                                               </span>
                                @enderror
                            </fieldset>
                            <fieldset class="form-group">
                                <label>Enter Password</label>
                                <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="********">

                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                                  <strong>{{ $message }}</strong>
                                               </span>
                                @enderror

                            </fieldset>
                            <fieldset class="form-group">
                                <label>Enter Confirm Password </label>
                                <input type="password" name="password_confirmation" class="form-control @error('password_confirmation') is-invalid @enderror" placeholder="********">

                                @error('password_confirmation')
                                <span class="invalid-feedback" role="alert">
                                                  <strong>{{ $message }}</strong>
                                               </span>
                                @enderror
                            </fieldset>

                            <div class="login-with-sites">
                                <p>Login Form ->   <a href="{{route('CustomerLoginPage')}}" style="float: right;" class="btn btn-info btn-sm">Login</a></p>


                            </div>
                            <fieldset class="form-group">
                                <button type="submit" class="btn btn-lg btn-secondary btn-block">Create Your Account</button>
                            </fieldset>
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="" id="">
                                <label class="" for="customCheck2">I Agree with <a href="#">Term and Conditions</a></label>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </section>

@endsection