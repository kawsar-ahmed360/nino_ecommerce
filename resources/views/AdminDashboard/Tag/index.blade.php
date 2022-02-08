@extends('AdminDashboard.master')
@section('title') All Tag @endsection
@section('admin-content')

    <div class="table-container">
        <div class="t-header">All Tag </div>
        <div class="">

            <div class="row gutters">


                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-6">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                        <div class="card">
                            <div class="card-body">

                                <h3 style="font-family: monospace;font-weight: normal;">Tag @if(@$edite) Edit: @else Create: @endif</h3>

                                <form action="@if(@$edite){{ route('TagUpdate') }} @else{{ route('TagStore') }}@endif" method="POST" enctype="multipart/form-data">
                                    @csrf

                                    @if(@$edite)
                                        <input type="hidden" value="{{@$edite->id}}"name="EditeId">
                                        @else

                                        @endif

                                    <div class="row gutters">


                                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                            <div class="form-group">
                                                <label for="inputName">Tag Name</label>
                                                <input type="text" class="form-control @error('tag_name') is-invalid @enderror" @if(@$edite->tag_name) value="{{@$edite->tag_name}}" @else @endif name="tag_name" id="imgInp" placeholder="Enter tag_name">
                                                @error('tag_name')
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


                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-6">



                    <table id="copy-print-csv" class="table custom-table">
                        <thead>
                        <tr>
                            <th>SL.</th>
                            <th>Tag Name</th>
                            {{--<th>Status</th>--}}
                            {{--<th>Image</th>--}}
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($index as $key=>$index)
                            <tr class="odd gradeX">
                                <td>{{ @$key + 1 }}</td>
                                <td>{{ @$index->tag_name }}</td>
                                {{--<td>--}}
                                    {{--@if(@$index->status=='1')--}}
                                        {{--<span class="badge badge-success">Active</span>--}}
                                    {{--@else--}}
                                        {{--<span class="badge badge-danger">Deactive</span>--}}
                                    {{--@endif--}}
                                {{--</td>--}}

                                {{--                        <td><img src="{{ asset('upload/Client/Category/'.$category->image) }}" class="img-thumbnail" width="100" height="100" /></td>--}}
                                <td style="text-align: center;">


                                    <a href="{{route('TagEdite',$index->id)}}" class="btn btn-info btn-sm"><i class="fa fa-edit"></i> Edit</a>
                                    <a  href="{{route('TagDelete',$index->id)}}" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i> Delete</a>

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