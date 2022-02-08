@extends('UserDashboard.master')
@section('title') Add Purchase @endsection
@section('user-content')

<div class="row">
                            <div class="col-12">

                            </div>



                            <!DOCTYPE html>
<div lang="en">
<head>
  <title></title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

</head>

    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        <div class="card">
            <div class="card-body" style="min-width: 1035px">

 {{--<div class="container">--}}
	 {{--<div class="container-fluid">--}}

     @if(Session::has('update'))

            <div class="alert alert-success">{{Session::get('update')}}</div>
     @endif

      <h2 style="text-align: center;background: none;color: #ef5252;padding: 7px;border-radius: 3px; border: 2px dotted black;">Purchase Add <span style="float: right;"></span></h2>

       <div class="row">

            <div class="col-md-2">
                <label class="" style="font-size: 15px">Purchase Date</label>
                <input type="date" class="form-control" name="date" id="date" placeholder="dd-mm-yy">

             </div>


              <div class="col-md-2">
                <label class="" style="font-size: 15px">Purchase No</label>
                <input type="text" class="form-control" name="purshes_no" id="purshes_no"  placeholder="purshes_no">

             </div>
              {{--
              <div class="col-md-2">
                <label class="" style="font-size: 15px">Supliar</label>
                <select name="supliar_id" class="form-control" id="supliar_id">
                  <option disabled="" selected="">Select Once</option>
                 @foreach($supliar as $sup)
                  <option value="{{ $sup->id }}">{{ $sup->name }}</option>
                  @endforeach
                </select>

             </div> --}}


              <div class="col-md-2">
                <label class="" style="font-size: 15px">Category</label>
                <select name="cat_id" class="form-control" id="cat_id">
                  <option disabled="" selected="">Select Once</option>
                  @foreach($category as $cat)
                  <option value="{{ $cat->id }}">{{ $cat->category_name }}</option>
                  @endforeach
                </select>

             </div>

              <div class="col-md-3">
                <label class="" style="font-size: 15px">Product</label>
                <select name="product_id" class="form-control" id="product_id">
                <option disable="" selected="">--Select Once--</option>
                </select>

             </div>

               <div class="col-md-1">

                 <a style="margin-top: 30px" href="#" class="btn btn-success addmore" id="addmore"><i class="fa fa-plus"></i></a>

             </div>



           </div>

           <form action="{{ route('Userpurshesadd_store') }}" method="POST">
            @csrf

           <table id="copy-print-csv" class="table-hover" style="width: 100%" border="1">


              <h3 style="text-align: center;">Purchase View</h3>

              <thead>
                <tr style="text-align: center;">
                  <th>Category</th>
                  <th>product Name</th>
                  <th>product qty</th>
                  <th>product price</th>
                  <th>product descriprion</th>
                  <th>product subtotal</th>
                  <th>Action</th>
                </tr>
              </thead>

              <tbody id="rowId" class="rowId" style="text-align: center;">


              </tbody>

              <tbody>
                <tr>
                  <td style="text-align: right;" colspan="5"><strong>Estimate Amount</strong></td>
                  <td style="text-align: center;"><input style="background: #D8FDBA" type="text" name="estimated_ammount" id="estimated_ammount" readonly></td>
                  <td></td>
                </tr>
              </tbody>

           </table>

           <button style="margin:10px" type="submit" class="btn btn-success btn-sm">Submit</button>
           </form>

        </div>
    </div>

{{--</div>--}}
{{--</div>--}}
</div>


    </body>
    </html>

 </div>
</div>



@endsection

@section('footer')


<script id="full_html" type="text/x-handlebars-template">

   <tr id="full_Tr" class="full_tr">
      <input type="hidden" value="@{{ date }}" name="date[]" id='date'>
      <input type="hidden" value="@{{ purshes_no }}" name="purshes_no[]" id='purshes_no'>
      <input type="hidden" value="@{{ supliar_id }}" name="supliar_id[]" id='supliar_id'>


      <td><input type="hidden" value="@{{ cat_id }}" name="cat_id[]">@{{ category_name }}</td>

      <td><input type="hidden" value="@{{ product_id }}" name="product_id[]">@{{ product_name }}</td>
      <td><input type="number" name="bying_qty[]" value="1" min="1" class="bying_qty"></td>
      <td><input type="number" name="bying_price[]" value="" min="" class="bying_price"></td>
      <td><input type="text" name="des[]" value="" min="" class="des"></td>
      <td><input type="text" name="subtotal[]" class="subtotal" readonly></td>
      <td><i class="fa fa-window-close btn btn-danger removeover"></i></td>

   </tr>


</script>



<script type="text/javascript">


   $(document).ready(function(){

       $(document).on('click','#addmore',function(){

         var date = $('#date').val();
         var purshes_no = $('#purshes_no').val();
         var supliar_id = $('#supliar_id').val();
         var supliar_name = $('#supliar_id').find('option:selected').text();

         var cat_id = $('#cat_id').val();
         var category_name = $('#cat_id').find('option:selected').text();
         var product_id = $('#product_id').val();
         var product_name = $('#product_id').find('option:selected').text();

         var soucrce = $('#full_html').html();
         var template = Handlebars.compile(soucrce);

         var data = {

          date:date,
          purshes_no:purshes_no,
          supliar_id:supliar_id,
          supliar_name:supliar_name,
          cat_id:cat_id,
          category_name:category_name,
          product_id:product_id,
          product_name:product_name,


         };

        var html = template(data);

        $('#rowId').append(html);


       });

       $(document).on('click','.removeover',function(){

           $(this).closest('#full_Tr').remove();

           total_ammount();

       });

       $(document).on('keyup click','.bying_qty,.bying_price',function(){

         var qty = $(this).closest('tr').find('input.bying_qty').val();
         var price = $(this).closest('tr').find('input.bying_price').val();

         var total = price*qty;

         $(this).closest('tr').find('input.subtotal').val(total);

         total_ammount();

       });

       function total_ammount(){

        var sum = 0;

        $('.subtotal').each(function(){
         var value = $(this).val();
        if (!isNaN(value) && value.length != 0) {
          sum += parseFloat(value);
        }

        });

        $('#estimated_ammount').val(sum);
       }

   });

</script>






 <script type="text/javascript">


    $(function(){

        // $(document).on('change','#supliar_id',function(){

        //     var supliar_id =$(this).val();

        //     $.ajax({
          {{--url:"{{ route('category_id') }}",--}}
        //      type:"GET",

        //      data:{supliar_id:supliar_id},

        //       success:function(data) {
        //          var html = '<option value="">Select Category</option>';

        //          $.each(data,function(key,v){

        //            html += '<option value="'+v.cat_id+'">'+v.categorys['name']+'</option>';

        //          });

        //          $('#cat_id').html(html);
        //       }
        //     });

        // });


        $(document).on('change','#cat_id',function(){

          var cat_id = $(this).val();

          $.ajax({

            url:"{{ route('getPorudct') }}",
            type:"GET",

            data:{cat_id:cat_id},
            success:function(data){
              var html = '';
              $.each(data,function(key,v){
                html+='<option value="'+v.id+'">'+v.product_name+'</option>';
              });

              $('#product_id').html(html);
            }
          });
        });

    });





 </script>


@endsection
