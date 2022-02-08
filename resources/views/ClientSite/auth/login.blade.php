@extends('ClientSite.master')

@section('title') Login Page @endsection

@section('client-content')

    <section class="section-padding bg-dark inner-header">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center">
                    <h1 class="mt-0 mb-3 text-white">Customer Login</h1>
                    <div class="breadcrumbs">
                        <p class="mb-0 text-white"><a href="#" class="text-white">Home</a> / <span class="text-success">Customer Login</span></p>
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
               <div class="tab-pane active" id="login" role="tabpanel">
                   <form action="{{route('CustomerLoginPost')}}" method="post">
                       @csrf
                       <h5 class="heading-design-h5 text-center">Login to your account</h5>
                       <fieldset class="form-group">
                           <label>Enter Email/Mobile number</label>
                           <input type="text" class="form-control" name="mobile" placeholder="+91 123 456 7890">
                       </fieldset>
                       <fieldset class="form-group">
                           <label>Enter Password</label>
                           <input type="password" name="password" class="form-control" placeholder="********">
                       </fieldset>
                       <div class="login-with-sites">
                           <p>Registration Form ->   <a href="{{route('CustomerRegistartionPage')}}" style="float: right;" class="btn btn-info btn-sm">Registration</a></p>


                       </div>
                       <fieldset class="form-group">
                           <button type="submit" class="btn btn-lg btn-secondary btn-block">Login Account</button>
                       </fieldset>

                       <div class="custom-control custom-checkbox">
                           <input type="checkbox" class="custom-control-input" id="customCheck1">
                           {{--<label class="custom-control-label" for="customCheck1">Remember me</label>--}}
                       </div>
                   </form>
               </div>
           </div>
        </div>
    </div>
    </div>
    </section>


    @endsection