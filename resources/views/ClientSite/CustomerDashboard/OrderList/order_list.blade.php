@extends('ClientSite.master')
@section('title') Order List @endsection

@section('client-content')



    <section class="section-padding bg-dark inner-header" style="background: url(fontend/img/inner-bg.jpg) center bottom -45px rgba(0, 0, 0, 0)!important">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center">
                    <h1 class="mt-0 mb-3 text-white">Order List</h1>
                    <div class="breadcrumbs">
                        <p class="mb-0 text-white">
                            <a href="#" class="text-white">Home</a> / <span class="text-success">Order List</span>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>




    <section class="account-page section-padding">
        <div class="container">
            <div class="row">
                <div class="col-lg-9 mx-auto">
                    <div class="row no-gutters">
                        <div class="col-md-4">
                            <div class="card account-left">


                                @include('ClientSite.CustomerDashboard.Menu.menu')

                            </div>
                        </div>


                        <div class="col-md-8">

                            <div class="card card-body account-right">
                                <div class="widget">
                                    <div class="section-header">
                                        <h5 class="heading-design-h5"> Order List </h5>
                                    </div>
                                    <div class="order-list-tabel-main table-responsive">
                                        <table id="example" class="datatabel table table-striped table-bordered order-list-tabel" width="100%" cellspacing="0">
                                            <thead>
                                            <tr>
                                                <th>Order #</th>
                                                <th>Date Purchased</th>
                                                <th>Status</th>
                                                <th>Total</th>
                                                <th>Action</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @forelse(@$order as $order)
                                            <tr>
                                                <td>#{{@$order->orderId}}</td>
                                                <td>{{ $order->created_at->format('F d,Y') }}</td>
                                                <td>
                                                    @if($order->status==2)
                                                    <span class="badge badge-success">Approve</span>
                                                        @elseif($order->shipping_status==2)
                                                        <span class="badge badge-success">Shiped</span>
                                                       @elseif($order->order_complete==2)
                                                        <span class="badge badge-success">Order Complete</span>
                                                        @else
                                                        <span class="badge badge-info">In Progress</span>
                                                     @endif


                                                </td>
                                                <td>${{$order->total_ammount}}</td>
                                                <td>
                                                    <a data-toggle="tooltip" data-placement="top" title="" href="{{route('customerOrderDetails',base64_encode($order->id))}}" data-original-title="View Detail" class="btn btn-info btn-sm">
                                                        <i class="mdi mdi-eye"></i>
                                                    </a>

                                                    <a data-toggle="tooltip" data-placement="top" title="" href="{{route('customerOrderDetailsPdf',base64_encode($order->id))}}" data-original-title="View Detail" class="btn btn-primary btn-sm">
                                                        <i class="mdi mdi-printer"></i>
                                                    </a>
                                                </td>
                                            </tr>

                                                @empty

                                                @endforelse


                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>



@endsection