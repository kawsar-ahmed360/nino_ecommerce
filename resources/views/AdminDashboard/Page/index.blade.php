@extends('AdminDashboard.master')
@section('title') All Page @endsection
@section('admin-content')

    <div class="table-container">
        <div class="t-header">All Page  <a href="{{route('PageCreate')}}"><span style="float: right;cursor:pointer" class="btn btn-success btn-sm">Add Page</span></a></div>
        <div class="table-responsive">
            <table id="copy-print-csv" class="table custom-table">
                <thead>
                <tr>
                    <th>SL.</th>
                    <th>Title</th>
                    <th>URI</th>
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

                        <td><img src="{{ asset('upload/Admin/page/'.$page->image) }}" class="img-thumbnail" width="100" height="100" /></td>
                        <td style="text-align: center;">


                            <a href="{{route('PageEdite',$page->id)}}" class="btn btn-info btn-sm"><i class="fa fa-edit"></i> Edit</a>
                            <a  href="{{route('PageDelete',$page->id)}}" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i> Delete</a>

                        </td>
                    </tr>

                @endforeach


                </tbody>
            </table>
        </div>
    </div>


@endsection