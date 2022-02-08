@extends('AdminDashboard.master')
@section('title') Product Discount @endsection
@section('admin-content')

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            @if(Session::has('message'))
                                <div class="alert alert-danger">
                                    {{ Session::get('message') }}
                                </div>
                            @endif

                            @if(Session::has('success'))
                                <div class="alert alert-success">
                                    {{ Session::get('success') }}
                                </div>
                            @endif

                            <h3 class="" style="text-align: center;padding: 11px;border: 1px dotted red;font-family: monospace;">Product Discount Form</h3>
                                <br>


                                    <form action="{{ route('DiscountProductStore') }}" method="post" class="custom-validation" accept-charset="utf-8" enctype="multipart/form-data">


                                        @csrf

                                        <input type="hidden" value="{{@$product->id}}" name="productId">


                                        <div class="form-group row">
                                            <label for="example-text-input" class="col-sm-2 col-form-label">Old Price</label>
                                            <div class="col-sm-8">
                                                <input class="form-control" readonly  type="text" value="{{@$product->product_price}}" placeholder="Enter your Product Name..." id="OldPrice">
                                            </div>
                                        </div>


                                        <div class="form-group row">
                                            <label for="example-text-input" class="col-sm-2 col-form-label">Discount Price</label>
                                            <div class="col-sm-8">
                                                <input class="form-control" readonly type="text" value="{{@$product->new_price}}" placeholder="Enter your Product Name..." id="DicountPrice">
                                            </div>
                                        </div>


                                        <div class="form-group row">
                                            <label for="example-text-input" class="col-sm-2 col-form-label">Discount %</label>
                                            <div class="col-sm-8">
                                                <input class="form-control" type="text" value="{{@$product->discount}}" name="discount" placeholder="%..." id="discount">
                                            </div>
                                        </div>



                                        <div class="form-group row">
                                            <label for="example-text-input" class="col-sm-2 col-form-label">New Price</label>
                                            <div class="col-sm-8">
                                                <input class="form-control" type="text" readonly name="new_price" placeholder="New Price..." id="newPrice">
                                            </div>
                                        </div>





                                        <div class="form-group row">
                                            <label for="example-text-input" class="col-sm-2 col-form-label"></label>
                                            <div class="col-sm-10">
                                                <button type="" class="btn btn-success btn-sm">Submit Product</button>
                                            </div>
                                        </div>


                                    </form>

                                </div>


                        </div>
                    </div>
                </div> <!-- end col -->
            </div> <!-- end row -->


    @section('footer')



    <script type="text/javascript">
        $(document).on("change keyup blur", "#discount", function() {
            var main = $('#OldPrice').val();
            var Discountmain = $('#DicountPrice').val();

            if (main) {

                var disc = $('#discount').val();
                var dec = (disc/100).toFixed(2); //its convert 10 into 0.10
                var mult = main*dec; // gives the value for subtract from main value
                var discont = main-mult;
            }else{

                var disc = $('#discount').val();
                var dec = (disc/100).toFixed(2); //its convert 10 into 0.10
                var mult = Discountmain*dec; // gives the value for subtract from main value
                var discont = Discountmain-mult;


            }



            $('#newPrice').val(discont);
        });
    </script>

        @endsection


@endsection