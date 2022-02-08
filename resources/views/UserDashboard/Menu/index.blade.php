@extends('UserDashboard.master')
@section('title')All Menu @endsection
@section('user-content')

    <div class="table-container">
        <div class="t-header">All Menu  <a href="{{route('MenuCreateUser')}}"><span style="float: right;cursor:pointer" class="btn btn-success btn-sm">Add Menu</span></a></div>
        <div class="table-responsive">
            <table id="copy-print-csv" class="table custom-table">
                <thead>
                <tr>
                    <th>SL</th>
                    <th>Name</th>
                    <th>Publish</th>
                    <th>Created</th>
                    <th>Display Sequence</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach($menu as $key=>$menu)
                <tr class="odd gradeX">
                    <td>{{ $key + 1 }}</td>
                    <td>{{ $menu->menu_name }}</td>
                    <td>Publish</td>
                    <td class="center">
                        @if(@$menu->user_id=='')
                            <span class="badge badge-success">SuperAdmin</span>
                            @else
                            <span class="badge badge-warning">{{@$info->Role->role_name}} ({{@$info->name}})</span>
                        @endif
                    </td>
                    <td class="center">Sequence</td>
                    <td style="text-align: center;">


                        <a href="{{route('MenuEditeUser',$menu->id)}}" class="btn btn-info btn-sm"><i class="fa fa-edit"></i> Edit</a>
                        <a href="{{route('MenuDeleteUser',$menu->id)}}" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i> Delete</a>

                    </td>
                </tr>

                    @endforeach


                </tbody>
            </table>
        </div>
    </div>


@endsection