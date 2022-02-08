@extends('AdminDashboard.master')
@section('title') Custom User Edit @endsection
@section('admin-content')

    <div class="table-container">
        <div class="t-header">Custom User Edit </div>
        <div class="">

            <div class="row gutters">


                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                    <div class="card">
                        <div class="card-body">

                            <h3 style="font-family: monospace;font-weight: normal;">User Edit:</h3>

                            <form action="{{ route('CustomUserUpdate') }}" method="POST" enctype="multipart/form-data">
                                @csrf

                                <input type="hidden" value="{{@$edite->id}}" name="EditeId">



                                <div class="row gutters">

                                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-6">
                                        <div class="form-group">
                                            <label for="inputName">Role</label>
                                            <select name="role" class="form-control" id="">
                                                <option disabled selected>----Select Once------</option>
                                                @foreach(@$role as $role)
                                                    <option value="{{$role->id}}" {{(@$edite->role==$role->id)?'selected':''}}>{{@$role->role_name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-6">
                                        <div class="form-group">
                                            <label for="inputName">Name</label>
                                            <input type="text" class="form-control @error('name') is-invalid @enderror" value="{{@$edite->name}}"  name="name" id="imgInp" placeholder="Enter name">
                                            @error('name')
                                            <span class="invalid-feedback" role="alert">
                                               	 <strong style="color:red">{{$message}}</strong>
                                               </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-6">
                                        <div class="form-group">
                                            <label for="inputName">Email</label>
                                            <input type="text" class="form-control @error('email') is-invalid @enderror" value="{{@$edite->email}}"  name="email" id="imgInp" placeholder="Enter email">
                                            @error('email')
                                            <span class="invalid-feedback" role="alert">
                                               	 <strong style="color:red">{{$message}}</strong>
                                               </span>
                                            @enderror
                                        </div>
                                    </div>


                                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-6">
                                        <div class="form-group">
                                            <label for="inputName">Password</label>
                                            <input type="password" class="form-control @error('password') is-invalid @enderror" value="{{@$edite->after_hash_passowrd}}" name="password" id="imgInp" placeholder="Enter password">
                                            @error('password')
                                            <span class="invalid-feedback" role="alert">
                                               	 <strong style="color:red">{{$message}}</strong>
                                               </span>
                                            @enderror
                                        </div>
                                    </div>


                                    <div class="col-xl-5 col-lg-12 col-md-12 col-sm-12 col-12">
                                        <h5 style="font-family: cursive;">Permission:</h5>

                                        @foreach(@$permission as $per)

                                            <div class="form-check form-check-inline" style="width:150px">
                                                <input class="form-check-input" type="checkbox" id="inlineCheckbox1" name="permission[]" @if(@$edite->Menu_Builder==$per->permissin_name) checked="" @else @endif @if(@$edite->Slider_Manage==$per->permissin_name) checked @else  @endif @if(@$edite->Section_Manage==$per->permissin_name) checked="" @endif  @if(@$edite->Color_Manage==$per->permissin_name) checked="" @endif  @if(@$edite->Plating_Manage==$per->permissin_name) checked="" @endif  @if(@$edite->Purchase_Section==$per->permissin_name) checked="" @endif  @if(@$edite->Stock_Report==$per->permissin_name) checked="" @endif  @if(@$edite->Pdf_Information==$per->permissin_name) checked="" @endif   @if(@$edite->Page_Builder==$per->permissin_name) checked="" @endif  @if(@$edite->Logo_Manage==$per->permissin_name) checked="" @endif  @if(@$edite->Category_Manage==$per->permissin_name) checked="" @endif  @if(@$edite->Tag_Manage==$per->permissin_name) checked="" @endif   @if(@$edite->Product_Manage==$per->permissin_name) checked="" @endif   @if(@$edite->Sale_Report==$per->permissin_name) checked="" @endif    @if(@$edite->Shipment_Charge==$per->permissin_name) checked="" @endif   @if(@$edite->Order_Manage==$per->permissin_name) checked="" @endif  @if(@$edite->Coupon_Manage==$per->permissin_name) checked="" @endif  @if(@$edite->Contact_Information==$per->permissin_name) checked="" @endif   @if(@$edite->About_Us==$per->permissin_name) checked="" @endif   @if(@$edite->Social_Icon==$per->permissin_name) checked="" @endif @if(@$edite->Our_Client_Think_Of==$per->permissin_name) checked="" @endif @if(@$edite->Customer_Manage==$per->permissin_name) checked="" @endif  value="{{@$per->permissin_name}}">
                                                <label class="form-check-label" for="inlineCheckbox1">{{@$per->permissin_name}}</label>
                                            </div>


                                        @endforeach

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
            </div>
        </div>
    </div>
    </div>

@endsection