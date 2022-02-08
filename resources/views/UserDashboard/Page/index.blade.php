@extends('UserDashboard.master')
@section('title') All Page @endsection
@section('user-content')

    <div class="table-container">
        <div class="t-header">All Page  <a href="{{route('UserPageCreate')}}"><span style="float: right;cursor:pointer" class="btn btn-success btn-sm">Add Page</span></a></div>
        <div class="table-responsive">
            <table id="copy-print-csv" class="table custom-table">
                <thead>
                <tr>
                    <th>SL.</th>
                    <th>Title</th>
                    <th>URI</th>
                    <th>Created</th>
                    <th>Image</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach($page as $key=>$page)
                    <tr class="odd gradeX">
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $page->title }}</td>
                        <td>{{ $page->title_uri }}</td>

                        <td class="center">
                            @if(@$page->user_id=='')
                                <span class="badge badge-success">SuperAdmin</span>
                            @else
                                <span class="badge badge-warning">{{@$info->Role->role_name}} ({{@$info->name}})</span>
                            @endif
                        </td>
                        <td><img src="{{ asset('upload/Admin/page/'.$page->image) }}" class="img-thumbnail" width="100" height="100" /></td>
                        <td style="text-align: center;">


                            <a href="{{route('UserPageEdite',$page->id)}}" class="btn btn-info btn-sm"><i class="fa fa-edit"></i> Edit</a>
                            <a  href="{{route('UserPageDelete',$page->id)}}" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i> Delete</a>

                        </td>
                    </tr>

                @endforeach


                </tbody>
            </table>
        </div>
    </div>


@endsection