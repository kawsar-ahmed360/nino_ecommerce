@extends('UserDashboard.master')
@section('title') Our Client Think Of Us @endsection
@section('user-content')

    <div class="table-container">
        <div class="t-header">Our Client Think Of Us</div>
        <div class="">

            <div class="row gutters">


                <div class="col-xl-5 col-lg-5 col-md-5 col-sm-5 col-5">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                        <div class="card">
                            <div class="card-body">

                                <h4 style="font-family: monospace;font-weight: normal;"> Our Client Think Of Us @if(@$edite) Edit: @else Create: @endif</h4>

                                <form action="@if(@$edite){{ route('UserOurClientThinkUsUpdate') }} @else{{ route('UserOurClientThinkUsStore') }}@endif" method="POST" enctype="multipart/form-data">
                                    @csrf

                                    @if(@$edite)
                                        <input type="hidden" value="{{@$edite->id}}"name="EditeId">
                                    @else

                                    @endif

                                    <div class="row gutters">


                                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                            <div class="form-group">
                                                <label for="inputName">Url </label>
                                                <input type="text" class="form-control @error('url') is-invalid @enderror" @if(@$edite->url) value="{{@$edite->url}}" @else @endif name="url" id="imgInp" placeholder="Enter url">
                                                @error('url')
                                                <span class="invalid-feedback" role="alert">
                                               	 <strong style="color:red">{{$message}}</strong>
                                               </span>
                                                @enderror
                                            </div>
                                        </div>



                                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                            <div class="form-group">
                                                <label for="inputName">Image </label>
                                                <input type="file" class="form-control @error('image') is-invalid @enderror" name="image" id="imgInp" placeholder="Enter image">
                                                @error('image')
                                                <span class="invalid-feedback" role="alert">
                                               	 <strong style="color:red">{{$message}}</strong>
                                               </span>
                                                @enderror
                                            </div>
                                        </div>

                                        @if(@$edite->image)

                                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                                <div class="form-group">
                                                    <label for="inputName">Old Image </label> <br>
                                                    <img src="{{ asset('upload/Client/ClientThink/'.$edite->image) }}" class="img-thumbnail" width="100" height="100" />

                                                </div>
                                            </div>

                                            @else

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


                <div class="col-xl-7 col-lg-7 col-md-7 col-sm-7 col-7">



                    <table id="copy-print-csv" class="table custom-table">
                        <thead>
                        <tr>
                            <th>SL.</th>
                            <th>Url</th>
                            {{--<th>Status</th>--}}
                            <th>Image</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($index as $key=>$index)
                            <tr class="odd gradeX">
                                <td>{{ @$key + 1 }}</td>
                                <td>{{ @$index->url }}</td>
                                <td><img src="{{ asset('upload/Client/ClientThink/'.$index->image) }}" class="img-thumbnail" width="100" height="100" /></td>
                                {{--<td>--}}
                                {{--@if(@$index->status=='1')--}}
                                {{--<span class="badge badge-success">Active</span>--}}
                                {{--@else--}}
                                {{--<span class="badge badge-danger">Deactive</span>--}}
                                {{--@endif--}}
                                {{--</td>--}}

                                {{--                        <td><img src="{{ asset('upload/Client/Category/'.$category->image) }}" class="img-thumbnail" width="100" height="100" /></td>--}}
                                <td style="text-align: center;">


                                    <a href="{{route('UserOurClientThinkUsEdite',$index->id)}}" class="btn btn-info btn-sm"><i class="fa fa-edit"></i> Edit</a>
                                    <a  href="{{route('UserOurClientThinkUsDelete',$index->id)}}" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i> Delete</a>

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