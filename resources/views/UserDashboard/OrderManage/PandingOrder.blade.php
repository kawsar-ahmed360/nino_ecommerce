@extends('UserDashboard.master')
@section('title') Order Panding List @endsection
@section('user-content')

    <div class="row">
        <div class="col-md-12">
            <div class="table-container">
                <div class="t-header">Order Panding List </div>
                <div class="table-responsive">
                    <table id="copy-print-csv"  class="table table-striped table-bordered dt-responsive nowrap">
                        <thead>
                        <tr>
                            <th>SL.</th>
                            <th>Order Id</th>
                            <th>Customer Status</th>
                            <th>Name</th>
                            <th>Mobile</th>
                            <th>Payment</th>
                            <th>Total Amount</th>
                            <th>Status</th>
                            <th>Shipping</th>
                            <th>Order Complete</th>
                            {{--<th>Action</th>--}}
                        </tr>
                        </thead>
                        <tbody id="show_item_all">

                        @include('UserDashboard.OrderManage.OrderListAjax.panding_order')

                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>



@endsection

@section('footer')
    <script>
        function PandingApprove(id){
            var alerm =  confirm("Are you sure!");
            if(alerm){


                var id = id;
                $.ajax({
                    url:"{{route('UserAllCustomerPandingApprove')}}",
                    type:"GET",
                    data:{id:id},
                    success:function (data) {
                        $('#show_item_all').empty().html(data);


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
                            title: 'Successfully Approve'
                        })
                    }
                })
            }
        }
    </script>


    <script>
        function PandingNotApprove(id){

            var alerm =  confirm("Are you sure!");
            if(alerm){

                var id = id;
                $.ajax({
                    url:"{{route('UserAllCustomerPandingNotApprove')}}",
                    type:"GET",
                    data:{id:id},
                    success:function (data) {
                        $('#show_item_all').empty().html(data);


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
                            title: 'Successfully Deactive'
                        })
                    }
                })
            }
        }
    </script>


    <!---------------Shipping Status------------------>

    <script>
        function PandingShipApprove(id) {


            var alerm = confirm("Are you sure!");
            if (alerm) {
                var id = id;
                $.ajax({
                    url: "{{route('UserAllCustomerPandingShippingApprove')}}",
                    type: "GET",
                    data: {id: id},
                    success: function (data) {
                        $('#show_item_all').empty().html(data);


                        const Toast = Swal.mixin({
                                toast: true,
                                position: 'top-end',
                                showConfirmButton: false,
                                timer: 3000,
                                timerProgressBar: true,
                                didOpen: (toast) = > {
                                toast.addEventListener('mouseenter', Swal.stopTimer)
                        toast.addEventListener('mouseleave', Swal.resumeTimer)
                    }
                    })

                        Toast.fire({
                            icon: 'success',
                            title: 'Successfully Shipment Approve'
                        })
                    }
                })
            }
        }
    </script>


    <script>
        function PandingShipNotApprove(id) {

            var alerm = confirm("Are you sure!");
            if (alerm) {
                var id = id;
                $.ajax({
                    url: "{{route('UserAllCustomerPandingShippingNotApprove')}}",
                    type: "GET",
                    data: {id: id},
                    success: function (data) {
                        $('#show_item_all').empty().html(data);


                        const Toast = Swal.mixin({
                                toast: true,
                                position: 'top-end',
                                showConfirmButton: false,
                                timer: 3000,
                                timerProgressBar: true,
                                didOpen: (toast) = > {
                                toast.addEventListener('mouseenter', Swal.stopTimer)
                        toast.addEventListener('mouseleave', Swal.resumeTimer)
                    }
                    })

                        Toast.fire({
                            icon: 'success',
                            title: 'Successfully Shipment Deactive'
                        })
                    }
                })
            }
        }
    </script>


    <script>
        function PandingCompleteOrder(id) {

            var alerm = confirm("Are you sure!");
            if (alerm) {
                var id = id;
                $.ajax({
                    url: "{{route('UserAllCustomerPandingOrderComplete')}}",
                    type: "GET",
                    data: {id: id},
                    success: function (data) {
                        $('#show_item_all').empty().html(data);


                        const Toast = Swal.mixin({
                                toast: true,
                                position: 'top-end',
                                showConfirmButton: false,
                                timer: 3000,
                                timerProgressBar: true,
                                didOpen: (toast) = > {
                                toast.addEventListener('mouseenter', Swal.stopTimer)
                        toast.addEventListener('mouseleave', Swal.resumeTimer)
                    }
                    })

                        Toast.fire({
                            icon: 'success',
                            title: 'Successfully Shipment Deactive'
                        })
                    }
                })
            }
        }
    </script>
@endsection