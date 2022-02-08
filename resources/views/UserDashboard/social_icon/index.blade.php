@extends('UserDashboard.master')
@section('title') All SocialIcon @endsection
@section('user-content')

    <div class="table-container">
        <div class="t-header">All Social Icon </div>
        <div class="">

            <div class="row gutters">


                <div class="col-xl-5 col-lg-5 col-md-5 col-sm-5 col-5">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                        <div class="card">
                            <div class="card-body">

                                <h3 style="font-family: monospace;font-weight: normal;">Social Icon @if(@$edite) Edit: @else Create: @endif</h3>

                                <form action="@if(@$edite){{ route('UserSocialIconUpdate') }} @else{{ route('UserSocialIconStore') }}@endif" method="POST" enctype="multipart/form-data">
                                    @csrf

                                    @if(@$edite)
                                        <input type="hidden" value="{{@$edite->id}}"name="EditeId">
                                    @else

                                    @endif

                                    <div class="row gutters">


                                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                            <div class="form-group">
                                                <label for="inputName">Icon Name</label>
                                                <input type="text" class="form-control @error('icon') is-invalid @enderror" @if(@$edite->icon) value="{{@$edite->icon}}" @else @endif name="icon" id="imgInp" placeholder="Enter icon name">
                                                @error('icon')
                                                <span class="invalid-feedback" role="alert">
                                               	 <strong style="color:red">{{$message}}</strong>
                                               </span>
                                                @enderror
                                            </div>
                                        </div>


                                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                            <div class="form-group">
                                                <label for="inputName">Link</label>
                                                <input type="text" class="form-control @error('link') is-invalid @enderror" @if(@$edite->link) value="{{@$edite->link}}" @else @endif name="link" id="imgInp" placeholder="Enter link">
                                                @error('link')
                                                <span class="invalid-feedback" role="alert">
                                               	 <strong style="color:red">{{$message}}</strong>
                                               </span>
                                                @enderror
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

                </div>


                <div class="col-xl-7 col-lg-7 col-md-7 col-sm-7 col-7">



                    <table id="copy-print-csv" class="table custom-table">
                        <thead>
                        <tr>
                            <th>SL.</th>
                            <th>Icon</th>
                            <th>Link</th>
                            {{--<th>Image</th>--}}
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($index as $key=>$index)
                            <tr class="odd gradeX">
                                <td>{{ @$key + 1 }}</td>
                                <td>{{ @$index->icon }}</td>
                                <td>{{ @$index->link }}</td>
                                {{--<td>--}}
                                {{--@if(@$index->status=='1')--}}
                                {{--<span class="badge badge-success">Active</span>--}}
                                {{--@else--}}
                                {{--<span class="badge badge-danger">Deactive</span>--}}
                                {{--@endif--}}
                                {{--</td>--}}

                                {{--                        <td><img src="{{ asset('upload/Client/Category/'.$category->image) }}" class="img-thumbnail" width="100" height="100" /></td>--}}
                                <td style="text-align: center;width:150px">


                                    <a href="{{route('UserSocialIconEdite',$index->id)}}" class="btn btn-info btn-sm"><i class="fa fa-edit"></i> Edit</a>
                                    <a  href="{{route('UserSocialIconDelete',$index->id)}}" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i> Delete</a>

                                </td>
                            </tr>

                        @endforeach


                        </tbody>
                    </table>
                </div>

            </div>






        </div>
    </div>


@endsection