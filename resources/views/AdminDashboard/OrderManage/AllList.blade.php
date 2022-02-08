@extends('AdminDashboard.master')
@section('title') All Order List @endsection
@section('admin-content')

 <div class="row">
     <div class="col-md-12">
         <div class="table-container">
             <div class="t-header">All Order List </div>
             <div class="table-responsive">
                 <form action="{{route('MultiOrderPront')}}" method="POST" id="form">
                     @csrf
                 <table id="copy-print-csv"  class="table table-striped table-bordered dt-responsive nowrap">

                     <input type="checkbox" name="types" value="color_print" style="margin-left: 399px;margin-top: 10px;position: absolute;border: 1px solid red;height: 28px;width: 30px;" title="color_print">
                         <button style="margin-left: 293px;margin-top: 7px;position: absolute;border: 1px solid red;" class="btn btn-outline-dark" type="submit" id="subm">Multi-Print</button>
                     <thead>
                     <tr>
                         <th> All</th>
                         <th>SL.</th>
                         <th>Order Id</th>
                         <th>Customer Status</th>
                         <th>Name</th>
                         <th>Mobile</th>
                         <th>Payment</th>
                         <th>Total Amount</th>
                         <th>Status</th>
                         <th>Shipping</th>
                         <th>Complete</th>
                         <th>View</th>
                     </tr>
                     </thead>
                     <tbody id="show_item_all">

                     @include('AdminDashboard.OrderManage.OrderListAjax.order')

                     </tbody>

                 </table>


                 </form>
             </div>
         </div>

     </div>
 </div>


@section('footer')


    <script>
        function Approve(id){
            var alerm =  confirm("Are you sure!");
            if(alerm){


                var id = id;
                $.ajax({
                    url:"{{route('AllCustomerApprove')}}",
                    type:"GET",
                    data:{id:id},
                    success:function (data) {
                        $('#show_item_all').empty().html(data);

                        window.location.reload();

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
        function NotApprove(id){

            var alerm =  confirm("Are you sure!");
            if(alerm){

                var id = id;
                $.ajax({
                    url:"{{route('AllCustomerNotApprove')}}",
                    type:"GET",
                    data:{id:id},
                    success:function (data) {
                        $('#show_item_all').empty().html(data);

                        window.location.reload();
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
        function AdminShipApprove(id) {
            var alerm = confirm("Are you sure!");
            if(alerm){
                var id = id;
                $.ajax({
                    url:"{{route('AllCustomerShippingApprove')}}",
                    type: "get",
                    data:{id:id},
                    success:function (data) {
                        window.location.reload();
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
                    });

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
        function AdminShipNotApprove(id) {

            var alerm = confirm("Are you sure!");
            if (alerm) {
                var id = id;
                $.ajax({
                    url: "{{route('AllCustomerShippingNotApprove')}}",
                    type: "GET",
                    data: {id: id},
                    success: function (data) {
                        $('#show_item_all').empty().html(data);
                        window.location.reload();

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
                    });

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


        function CompleteOrder(id) {

            var alerm = confirm("Are you sure!");
            if (alerm) {
                var id = id;
                $.ajax({
                    url: "{{route('AllCustomerOrderComplete')}}",
                    type: "GET",
                    data: {id:id},
                    success: function (data) {
                        $('#show_item_all').empty().html(data);
                        window.location.reload();

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
                    });

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


@endsection

