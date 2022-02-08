@extends('ClientSite.master')
@section('title') Shopping Cart Page @endsection

@section('client-content')




    <section class="section-padding bg-dark inner-header">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center">
                    <h1 class="mt-0 mb-3 text-white">Cart</h1>
                    <div class="breadcrumbs">
                        <p class="mb-0 text-white"><a href="#" class="text-white">Home</a> / <span class="text-success">Cart</span></p>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <section class="cart-page section-padding">
        <div class="container">
            <div class="row">
                <div class="col-md-12 mx-auto">
                    <div class="card card-body cart-table">
                        <div class="table-responsive">
                            <table class="table cart_summary">
                                <thead>
                                <tr>
                                    <th class="cart_product">Product</th>
                                    <th>Description</th>
                                    <th>Avail.</th>
                                    <th>Unit price</th>
                                    <th>Qty</th>
                                    <th>Total</th>
                                    <th class="action"><i class="mdi mdi-delete-forever"></i></th>
                                </tr>
                                </thead>
                                <tbody id="showCardPage">

                                 @include('ClientSite.Card_Ajax.card')


                                </tbody>

                                <tr>
                                    <td colspan="5" class="text-right"><strong>Are you gest</strong></td>
                                    <td><input type="checkbox" value="guest" name="guest" id="guest"></td>
                                </tr>

                            </table>
                        </div>

                        @if(Session::has('customer_id'))
                        <a href="{{route('CustomerCheckoutPage')}}" id="che">
                            <button class="btn btn-secondary btn-lg btn-block text-left" type="button"><span class="float-left"><i class="mdi mdi-cart-outline"></i> Proceed to Checkout </span><span class="float-right"><strong>Click</strong> <span class="mdi mdi-chevron-right"></span></span>
                            </button>

                        </a>
                        @else
                            <a href="{{route('CustomerLoginPage')}}" id="che">
                                <button class="btn btn-secondary btn-lg btn-block text-left" type="button"><span class="float-left"><i class="mdi mdi-cart-outline"></i> Proceed to Checkout </span><span class="float-right"><strong>Click</strong> <span class="mdi mdi-chevron-right"></span></span>
                                </button>

                            </a>
                        @endif

                        <a href="{{route('CustomerCheckoutPage')}}" style="display:none;background: red" id="gestcustomer">
                            <button class="btn btn-secondary btn-lg btn-block text-left" type="button"><span class="float-left" ><i class="mdi mdi-cart-outline"></i> Proceed to Checkout </span><span class="float-right"><strong>Click</strong> <span class="mdi mdi-chevron-right"></span></span>
                            </button>

                        </a>


                    </div>


                </div>
            </div>
        </div>
    </section>



    <style>

        .popup__wrapper {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            display: none;


        }
        .popup__content {
            background-color: #fff;
            padding: 1rem;
            text-align: center;
            margin: 5% auto;
            width: 100%;
            max-width: 25rem;
            position: relative;
            border: 2px solid black;
        }
        .popup__close {
            position: absolute;
            top: 1rem;
            right: 1rem;
            border: none;
            background-color: #0c5547;
            color: #fff;
            padding: 0.2rem 0.4rem;
            cursor: pointer;
        }
        .popup__details{
            background: #f0f3f8;
            padding: 17px;
        }
        .popup__details h2 {
            font-size: 2rem;
            font-family: cursive;
            text-transform: uppercase;
            color: #080d0c;
        }
        .popup__details p {
            text-transform: uppercase;
            font-family: -webkit-pictograph;
        }
        .popup__btn {
            padding: 0.5rem 1rem;
            margin: 0 auto;
        }
    </style>


    <div class="popup__wrapper">
        <div class="popup__content">
            <button class="popup__close">x</button>
            <div class="popup__details">
                <h2>{{@$shipping_offer->header}}</h2>
                <p>{{@$shipping_offer->short}}</p>

            </div>
        </div>
    </div>

    <input type="hidden" value="{{@$shipping_offer->status}}" name="offershow_hide">


@section('client-footer')



    <script>



        $(window).on('load', function () {
            var offervalueshow = $("input[name=offershow_hide]").val();
            if(offervalueshow=='active'){
                $('.popup__wrapper').css({
                    "display":"block"
                })
            }

        });

        $('.popup__close').on('click',function () {
            $('.popup__wrapper').css({
                "display":"none"
            })
        })

    </script>



    <script>
        $('#guest').on('click',function(){
            if(this.checked){
                $('#gestcustomer').show();
                $('#che').hide();
            }else{
                $('#gestcustomer').hide();
                $('#che').show();
            }

        });
    </script>


    <!---------Axios Cart Count-------->
    <script>
        function CountCart(data) {

            $("#smallcart").html(data);
            $("#cartCount").html(data);
        }

        function CountAllCartData(){
            axios.get('axios_cart_count')
                .then(function (response) {
                    CountCart(response.data['count'])

                })
                .catch(function (error) {
                    // handle error
                    console.log('not found');
                })
        }

        CountAllCartData();
    </script>





    <script>



      function decrement(ProId) {
          var rowId = ProId;



          $.ajax({
              url:"{{ route('ShoppingCartDecrement') }}",
              type:"GET",
              data:{rowId:rowId},

              success:function(data){
                  CountAllCartData();
                  GetAllCartItem();
                  $('#showCardPage').empty().html(data);



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
                      title: 'Successfully Updated'
                  })
              }
          })
      }


      function Increment(ProId) {
          var rowId = ProId;
          $.ajax({
              url:"{{ route('ShoppingCartIncrement') }}",
              type:"GET",
              data:{rowId:rowId},

              success:function(data){

                  CountAllCartData();
                  GetAllCartItem();
                  $('#showCardPage').empty().html(data);



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
                      title: 'Successfully Updated'
                  })
              }
          })
      }


      function RemoveCard(ProId) {
          var rowId = ProId;
          $.ajax({
              url:"{{ route('ShoppingCartRemove') }}",
              type:"GET",
              data:{rowId:rowId},

              success:function(data){

                  CountAllCartData();
                  GetAllCartItem();

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
                      title: 'Successfully Remove'
                  })

                  $('#showCardPage').empty().html(data);

              }
          })
      }




    </script>
@endsection


    @endsection