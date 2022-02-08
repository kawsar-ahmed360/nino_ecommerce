<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
     @yield('seo')
    <meta name="author" content="">
    <title>@yield('title')</title>
     <link rel="icon" type="image/png" href="img/favicon.png">
    <link href="{{asset('fontend/vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('fontend/vendor/icons/css/materialdesignicons.min.css')}}" media="all" rel="stylesheet" type="text/css" />
    <link href="{{asset('fontend/vendor/select2/css/select2-bootstrap.css')}}" />
    <link href="{{asset('fontend/vendor/select2/css/select2.min.css')}}" rel="stylesheet" />

    <link rel="stylesheet" href="{{asset('fontend/vendor/owl-carousel/owl.carousel.css')}}">
    <link rel="stylesheet" href="{{asset('fontend/vendor/owl-carousel/owl.theme.css')}}">
    <link rel='stylesheet' href='https://sachinchoolur.github.io/lightslider/dist/css/lightslider.css'>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.0.1/css/buttons.dataTables.min.css">
    <link rel="stylesheet" href="{{asset('fontend/toastr.min.css')}}">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.24.0/axios.min.js" integrity="sha512-u9akINsQsAkG9xjc1cnGF4zw5TFDwkxuc9vUp5dltDWYCSmyd0meygbvgXrlc/z7/o4a19Fb5V0OUE58J7dcyw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/owl-carousel/1.3.3/owl.carousel.min.css">
 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/owl-carousel/1.3.3/owl.theme.min.css"> -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.2.0/css/font-awesome.min.css">

    <link rel="stylesheet" href="{{asset('fontend/gallery/css/main.css')}}">
    <link href="{{asset('fontend/css/osahan.min.css')}}" rel="stylesheet">
</head>
<body>



@include('ClientSite.component_base.header')

<!-- Start: Slider -->

@yield('Slider')
<!-- End: Slider -->

<!-- Start: Category -->
@yield('category_section')
<!-- End: Category -->

<!-- Start: About Us -->
<!-- font-family: "Dancing Script",cursive; -->
{{--@yield('about')--}}
<!--End: About us -->

<!-- Start: Product Item -->
@yield('product')

@yield('client-content')

@yield('content')



<!-- Instagram -->
@yield('client-us')
<!-- Instagram -->




@include('ClientSite.component_base.footer')



{{--<script src='https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js'></script>--}}
<script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha384-tsQFqpEReu7ZLhBV2VZlAu7zcOV+rXbYlF2cqB8txI/8aZajjp4Bqd+V6D5IgvKT" crossorigin="anonymous"></script>
<script src="{{asset('fontend/vendor/jquery/jquery.min.js')}}" type="f9db3ece8e744cd9d5415a68-text/javascript"></script>
<script src="{{asset('fontend/vendor/bootstrap/js/bootstrap.bundle.min.js')}}" type="f9db3ece8e744cd9d5415a68-text/javascript"></script>
<script src="{{asset('fontend/vendor/select2/js/select2.min.js')}}" type="f9db3ece8e744cd9d5415a68-text/javascript"></script>
<script src="{{asset('fontend/vendor/owl-carousel/owl.carousel.js')}}" type="f9db3ece8e744cd9d5415a68-text/javascript"></script>
<script src="{{asset('fontend/js/custom.min.js')}}" type="f9db3ece8e744cd9d5415a68-text/javascript"></script>
<script src="{{asset('fontend/js/rocket-loader.min.js')}}" data-cf-settings="f9db3ece8e744cd9d5415a68-|49" defer=""></script>
<script defer src="{{asset('fontend/js/beacon.min.js')}}" data-cf-beacon='{"rayId":"692aec9eb8cf45fb","version":"2021.8.1","r":1,"token":"dd471ab1978346bbb991feaa79e6ce5c","si":10}'></script>
<script data-cfasync="false" src="{{asset('fontend/js/email-decode.min.js')}}"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>

<script src="{{asset('fontend/gallery/scripts/zoom-image.js')}}"></script>
<script src="{{asset('fontend/gallery/scripts/main.js')}}"></script>

<script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.0.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/2.0.1/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.0.1/js/buttons.print.min.js"></script>


<!-- End: Java Script -->
<script src='https://sachinchoolur.github.io/lightslider/dist/js/lightslider.js'></script>
<script src="{{asset('fontend/toastr.min.js')}}"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/owl-carousel/1.3.3/owl.carousel.min.js"></script>

<script>
    $("body").on("keyup","#searchs",function(){

        let Searchval = $(this).val();
        if(Searchval.length >0){

            $.ajax({
                url:"{{route('FilterSearchProd')}}",
                type:"get",
                data:{Searchval:Searchval},
                success:function(data){

                    $('#filterProductShow').empty().html(data);

                }
            })
        }

        if(Searchval.length <1){
            $('#filterProductShow').empty().html("");
        }
        //  console.log(val);
    })
</script>



<script>
    function ShowSearchResult(){
        $('#filterProductShow').fadeIn();
    }


    function HideSearchResult(){
        $('#filterProductShow').fadeOut();
    }
</script>

<!-------------Order Traking js---------------->

<script>
    $('#orderTrack').submit(function(e){
        e.preventDefault();

        var url = $(this).attr('action');
        var method = $(this).attr('method');
        var data = $(this).serialize();


        var a = document.forms["orderTrack"]["OrderId"].value;

        if (a == null || a == "") {
            alert('null');
        }else{


            $.ajax({
                url:url,
                type:method,
                data:data,

                success:function(data){

                    $('#showallinfo').css({
                        "display":"block"
                    })
                    $('#OrderNumber').empty().html(data['order'].orderId);
                    $('#customerNameAjax').empty().html(data['customer_info'].name);
                    $('#customerEmailAjax').empty().html(data['customer_info'].email);
                    $('#customerMobileAjax').empty().html(data['customer_info'].mobile);

                    //----------------- Order Status ---------------
                    $('#order_confirm').val(data['order'].status);
                    var confi = $('.order_confirm').val();

                    if(confi==2){
                        $('#orderst').addClass('active');
                    }else if(confi==1){
                        $('#orderst').removeClass('active');
                    }

                    //----------------- Shipping Status ---------------
                    $('#shipping_status').val(data['order'].shipping_status);
                    var shi_confi = $('.shipping_status').val();

                    if(shi_confi==2){
                        $('#shipping_st').addClass('active');
                    }else if(shi_confi==1){
                        $('#shipping_st').removeClass('active');
                    }


                    //----------------- Final Status ---------------
                    $('#final_step').val(data['order'].order_complete);
                    var final_step = $('.final_step').val();

                    if(final_step==2){
                        $('#final_oder').addClass('active');
                    }else if(final_step==1){
                        $('#final_oder').removeClass('active');
                    }



                }
            });

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

        $.ajax({
            url:"{{route('AxiosCartCount')}}",
            type:"GET",

            success:function(data){
                // console.log(data['count']);
                CountCart(data['count']);
            }
        });



        // axios.get('axios_cart_count')
        //     .then(function (response) {
        //         CountCart(response.data['count'])

        //     })
        //     .catch(function (error) {
        //         // handle error
        //         console.log('not found');
        //     })
    }

    CountAllCartData();
</script>

<!--------End Cart Count---------->


<!---------Axios Cart GET-------->
<script>
    function GetAllCart(data) {

        var	rows = '';
        var i = 0;
        $.each( data, function( key, value ) {

            rows = rows + '<tr>';
            rows = rows + '<td><img src="upload/Client/Product/'+value.options.image+'" alt="" width="50px" height="50px"></td>';
            rows = rows + '<td>'+value.qty+'</td>';
            rows = rows + '<td>'+value.name+'</td>';
            rows = rows + '<td>$'+value.price*value.qty+'</td>';
            rows = rows + '<td class="text-center">';
            rows = rows + '<a class="btn btn-sm btn-danger text-light" id="editRow" data-id="'+value.id+'"><i class="fa fa-times"></i></a>';
            rows = rows + '</td>';

            rows = rows + '</tr>';
        });
        $("#cardmini").html(rows);

    }

    function GetAllCartItem(){
        axios.get('axios_get_cart')
            .then(function (response) {
                GetAllCart(response.data['cart'])

            })
            .catch(function (error) {
                // handle error
                console.log('not found');
            })
    }

    GetAllCartItem();
</script>

<!--------End Cart Count---------->






@yield('client-footer')

<script>
    $(document).on('click','#delete',function(e){
        e.preventDefault();
        var link = $(this).attr('href');


        Swal.fire({
            title: 'Are you sure?',
            text: "You want to Delete This Item!",
            icon: 'warning',
            width: '400px',
            height:'400px',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {


            Swal.fire(
                'Deleted!',
                'Your file has been deleted.',
                'success'
            )
            window.location.href = link;
        }else{
            Swal('Safe Data');
        }
    })

    })
</script>

<!-------------Data table --->

<script>
    $(document).ready(function() {
        $('#example').DataTable( {
            dom: 'Bfrtip',
            buttons: [
                'copy', 'csv', 'excel', 'pdf', 'print'
            ]
        } );
    } );
</script>





<script type="text/javascript">
            @if(Session::has('message'))

    var type ="{{ Session::get('alert-type','success') }}";

    switch(type){
        case "success":
            toastr.success("{{ Session::get('message') }}");
            break;
        case "error":
            toastr.error("{{ Session::get('message') }}");
            break;
    }

    @endif
</script>

<script>
    $('#lightSlider').lightSlider({
        gallery: true,
        item: 1,
        loop: true,
        slideMargin: 0,
        thumbItem: 6
    });
</script>

<script>
    $(document).ready(function(){
        $("#testimonial-slider").owlCarousel({
            items:2,
            itemsDesktop:[1000,2],
            itemsDesktopSmall:[990,2],
            itemsTablet:[768,1],
            pagination:true,
            navigation:false,
            navigationText:["",""],
            slideSpeed:1000,
            autoPlay:true')}}
        });
    });
</script>


<script type="text/javascript">

    $(document).ready(function () {
        $('.picZoomer').picZoomer();
        $('.piclist li').on('click', function (event) {
            var $pic = $(this).find('img');
            $('.picZoomer-pic').attr('src', $pic.attr('src'));
        });



        $('.decrease_').click(function () {
            decreaseValue(this);
        });
        $('.increase_').click(function () {
            increaseValue(this);
        });
        function increaseValue(_this) {
            var value = parseInt($(_this).siblings('input#number').val(), 10);
            value = isNaN(value) ? 0 : value;
            value++;
            $(_this).siblings('input#number').val(value);
        }

        function decreaseValue(_this) {
            var value = parseInt($(_this).siblings('input#number').val(), 10);
            value = isNaN(value) ? 0 : value;
            value < 1 ? value = 1 : '';
            value--;
            $(_this).siblings('input#number').val(value);
        }
    });

</script>
<!--  -->


</body>

</html>