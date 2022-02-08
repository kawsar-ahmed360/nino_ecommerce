@extends('UserDashboard.master')
@section('title') All Color @endsection
@section('user-content')

    <div class="table-container">
        <div class="t-header">All Color  <a href="{{route('ColorCreate')}}"><span style="float: right;cursor:pointer" class="btn btn-success btn-sm">Add Color</span></a></div>
        <div class="table-responsive">
            <table id="copy-print-csv" class="table custom-table">
                <thead>
                <tr>
                    <th>SL.</th>
                    <th>Color Name</th>
                    <th>Status</th>
                    <th>Created By</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach($index as $key=>$index)
                    <tr class="odd gradeX">
                        <td>{{ @$key + 1 }}</td>
                        <td>{{ @$index->color_name }}</td>
                        <td>
                            @if(@$index->status=='1')
                                <span class="badge badge-success">Active</span>
                            @else
                                <span class="badge badge-danger">Deactive</span>
                            @endif
                        </td>

                        <td class="center">
                            @if(@$index->user_id=='')
                                <span class="badge badge-success">SuperAdmin</span>
                            @else
                                <span class="badge badge-warning">{{@$info->Role->role_name}} ({{@$info->name}})</span>
                            @endif
                        </td>

{{--                        <td><img src="{{ asset('upload/Client/Category/'.$category->image) }}" class="img-thumbnail" width="100" height="100" /></td>--}}
                        <td style="text-align: center;">


                            <a href="{{route('UserColorEdite',$index->id)}}" class="btn btn-info btn-sm"><i class="fa fa-edit"></i> Edit</a>
                            <a  href="{{route('UserColorDelete',$index->id)}}" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i> Delete</a>

                        </td>
                    </tr>

                @endforeach


                </tbody>
            </table>
        </div>
    </div>


@endsection