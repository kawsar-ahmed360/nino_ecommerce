@extends('UserDashboard.master')
@section('title') All Customer List @endsection
@section('user-content')

    <div class="table-container">
        <div class="t-header">All Customer List <a href="#" class="btn btn-outline-info btn-sm" data-toggle="modal" data-target="#myModal12">Mail Text</a></div>
        <div class="table-responsive">
            <table id="copy-print-csv" class="table custom-table">
                <thead>
                <tr>
                    <th class="">Send Email</th>
                    <th>SL.</th>
                    <th>Name</th>
                    <th>Mobile</th>
                    <th>Email</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach($index as $key=>$index)
                    <tr class="odd gradeX">
                        <td><input type="checkbox" class="" id="send_mail[{{@$index->id}}]"  value="{{@$index->id}}"name="send_mail[]"></td>
                        <td>{{ @$key + 1 }}</td>
                        <td>{{ @$index->name }}</td>
                        <td>{{ @$index->mobile }}</td>
                        <td>{{ @$index->email }}</td>
                        <td>
                            @if(@$index->password==null)
                                <span class="badge badge-success">Guest</span>
                            @else
                                <span class="badge badge-danger">Register</span>
                            @endif
                        </td>

                        {{--                        <td><img src="{{ asset('upload/Client/Category/'.$category->image) }}" class="img-thumbnail" width="100" height="100" /></td>--}}
                        <td style="text-align: center;">

                            <a  href="{{route('UserCustomerView',$index->id)}}" class="btn btn-info btn-sm"><i class="fa fa-eye"></i> View</a>
                            <a  href="{{route('UserCustomerDelete',$index->id)}}" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i> Delete</a>

                        </td>
                    </tr>

                @endforeach


                </tbody>
            </table>
        </div>
    </div>


    <!-- The Modal -->
    <div class="modal" id="myModal12">
        <div class="modal-dialog">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Mail Text</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <textarea class="form-control" id="mailtext" id="" cols="30" rows="10"></textarea>
                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" id="clicks" class="btn btn-danger" data-dismiss="modal">Send</button>
                </div>

            </div>
        </div>
    </div>



@section('footer')
    <script>
        var send_mail = [];
        $('#clicks').on('click', function (e) {
            e.preventDefault();
            send_mail = [];
            $('input[name="send_mail[]"]:checked').each(function()
            {
                send_mail.push($(this).val());
            });

            var textmail= $('#mailtext').val();

            $.ajax({

                headers: {'X-CSRF-TOKEN': '{{ csrf_token() }}' },
                type:'POST',

                url: '{{route("UserMultipleCustomerSendMail")}}',

                data:{send_mail:send_mail,textmail:textmail},

                success:function(data){


                    $('#mailtext').val('');
                    const Toast = Swal.mixin({
                            toast: true,
                            position: 'top-end',
                            showConfirmButton: false,
                            timer: 3000,
                            timerProgressBar: true,
                            didOpen: (toast) => {
                            toast.addEventListener('mouseenter', Swal.stopTimer)
                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                }
                })

                    Toast.fire({
                        icon: 'success',
                        title: 'Successfully Mail Send'
                    })

//                        $('#newproduct').empty().html(data)

                }

            });
        });
    </script>
@endsection



@endsection