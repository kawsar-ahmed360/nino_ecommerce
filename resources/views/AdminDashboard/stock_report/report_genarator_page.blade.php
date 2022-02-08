@extends('AdminDashboard.master')
@section('title') Stock Report Genarate Page @endsection
@section('admin-content')

<style type="text/css">
  
</style>

<div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">

                                        {{--<h3 style="" class="title">Stock Report Genarate Page :</h3>--}}
                                        <h3 style="text-align: center;background: none;color: #ef5252;padding: 7px;border-radius: 3px; border: 2px dotted black;font-family: cursive;">Stock Report Genarate Page <span style="float: right;"></span></h3>


                                        <div class="row" style="margin-top: 20px">
                                           <div class="col-md-6" style="">
                                             <label>Category Wise Stock Report</label>
                                             <input style="margin-left: 10px;margin-top: 12px;size: 20px;" type="radio" name="stock_report" id="stock_report" value="Cat_wise">

                                            <img style="height: 30px;width: 30px;border-radius: 4px;" src="{{asset('fontend/report.png')}}">
                                           </div>

                                           <div class="col-md-6">
                                              <label>Product Wise Stock Report</label>
                                             <input style="margin-left: 10px;margin-top: 12px;size: 20px" type="radio" name="stock_report" id="stock_report" value="product_wise">
                                             <img style="height: 30px;width: 30px;border-radius: 4px;" src="{{asset('fontend/report.png')}}">
                                           </div>
                                        </div>



                                        <div class="category_wise" style="display: none">
                                          {{-- <h5>Category Wise Stock Report</h5> --}}

                                          <form action="{{ route('CategoryWiseStock') }}" method="POST">
                                            @csrf

                                               <div class="row">

                                                  <div class="col-md-7">
                                                    <label>Category Name</label>
                                                    <select class="form-control" name="cate_wise_report">
                                                      <option disabled="" selected="">----Select Category----</option>
                                                      @foreach($categorys as $cate)
                                                         <option value="{{ @$cate->id }}">{{ @$cate->category_name }}</option>
                                                      @endforeach
                                                    </select>
                                                  </div>

                                                   

                                                  <div class="col-2" style="margin-top: 30px">
                                                     <button class="btn btn-success"><i class="fa fa-search"></i></button>
                                                  </div>


                                               </div>
                                            
                                          </form>
                                           
                                        </div>

                                        <div class="product_wise" style="display: none">
                                          {{-- <h5>Product Wise Stock Report</h5> --}}

                                          <form action="{{ route('ProductWiseStockGenare') }}" method="POST">
                                            @csrf

                                               <div class="row">
                                                  <div class="col-md-5">
                                                    <label>Category Name</label>
                                                    <select class="form-control" name="cate_wise_report" id="cate_wise_report">
                                                      <option disabled="" selected="">----Select Category----</option>
                                                      @foreach($categorys as $cate)
                                                         <option value="{{ @$cate->id }}">{{ @$cate->category_name }}</option>
                                                      @endforeach
                                                    </select>
                                                  </div>

                                                   <div class="col-md-5">
                                                    <label>Product Name</label>
                                                   <select class="form-control" name="product_name" id="product_name">
                                                      <option disabled="" selected="">----Select Product----</option>
                                                      
                                                    </select>
                                                  </div>

                                                  <div class="col-2" style="margin-top: 30px">
                                                     <button class="btn btn-success"><i class="fa fa-search"></i></button>
                                                  </div>


                                               </div>
                                            
                                          </form>
                                           
                                        </div>


                                      

                                        
                                    </div>
                                </div>
                            </div> <!-- end col -->
                        </div> <!-- end row -->

                      

@endsection




@section('footer')
<script type="text/javascript">
  $(document).on('click','#stock_report',function(){
     var value = $(this).val();

     if (value=='Cat_wise') {
       $('.category_wise').show();
     }else{
       // $('.product_wise').hide();
        $('.category_wise').hide(); 
     }

     if (value=='product_wise') {
      $('.product_wise').show();
     }else{

      $('.product_wise').hide();
     }
  });
</script>

<script type="text/javascript">
  $(document).on('change','#cate_wise_report',function(){
    var cat_id = $(this).val();

    $.ajax({
      url:"{{ route('StockGenaratorProductAjax') }}",
      type:"GET",
      data:{cat_id:cat_id},

      success:function(data){

            var html ='<option value="">Select Product</option>';
          $.each(data,function(key,v){

              html +='<option value="'+v.id+'">'+v.product_name+'</option>';
             });

             $('#product_name').html(html);
      }

    });
  });
</script>

@endsection