@extends('UserDashboard.master')
@section('title') All Order List @endsection
@section('user-content')

 <div class="row">
     <div class="col-md-12">
         <div class="table-container">
             <div class="t-header">All Order List </div>
             <div class="table-responsive">
                 <form action="{{route('UserMultiOrderPront')}}" method="POST" id="form">
                     @csrf
                     <button style="margin-left: 293px;margin-top: 7px;position: absolute;border: 1px solid red;" class="btn btn-outline-dark" type="submit" id="subm">Multi-Print</button>
                 <table id="copy-print-csv"  class="table table-striped table-bordered dt-responsive nowrap">
                     <thead>
                     <tr>
                         <th>Print</th>
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
                         <th>View</th>
                         {{--<th>Action</th>--}}
                     </tr>
                     </thead>
                     <tbody id="show_item_all">

                     @include('UserDashboard.OrderManage.OrderListAjax.order')

                     </tbody>
                 </table>
                 </form>
             </div>
         </div>

     </div>
 </div>



@endsection

@section('footer')
    <script>
        function Approve(id){
           var alerm =  confirm("Are you sure!");
           if(alerm){

            var id = id;
            $.ajax({
                url:"{{route('UserAllCustomerApprove')}}",
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
        function NotApprove(id){

            var alerm =  confirm("Are you sure!");
            if(alerm){

            var id = id;
            $.ajax({
                url:"{{route('UserAllCustomerNotApprove')}}",
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
        function ShipApprove(id){
            var alerm =  confirm("Are you sure!");
            if(alerm){

                var id = id;
                $.ajax({
                    url: "{{route('UserAllCustomerShippingApprove')}}",
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
        function ShipNotApprove(id){
            var alerm =  confirm("Are you sure!");
            if(alerm){

                var id = id;
                $.ajax({
                    url: "{{route('UserAllCustomerShippingNotApprove')}}",
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
        function CompleteOrder(id){
            var alerm =  confirm("Are you sure!");
            if(alerm){

                var id = id;
                $.ajax({
                    url: "{{route('UserAllCustomerOrderComplete')}}",
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


@endsection