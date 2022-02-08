@extends('UserDashboard.master')
@section('title') Product Details Add @endsection
@section('user-content')
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        <div class="card">
            <div class="card-body">

                <h3 style="font-family: monospace;font-weight: normal;" class="">{{@$product->product_name}}  Details Add :</h3>

                <form action="{{ route('UserProductDetailsPost') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <input type="hidden" value="{{@$product->id}}" name="product_id">



                    <div class="document_edite">

                        @forelse(@$product_details as $prodeti)
                            <div class="remove_more_edite">
                            <div class="row">
                                <h3 style=" padding-left: 15px;font-family: cursive;color: burlywood;">Edite New Section</h3>

                                <input type="hidden" value="Edite" name="EditeId">

                                <div class="col-md-12 mb-3">
                                    <label for="">Title</label>
                                    <input type="text" class="form-control" name="title[]" value="{{@$prodeti->title}}" placeholder="Enter title">
                                </div>


                                <div class="col-md-12 mb-3">
                                    <label for="">Description</label>
                                    <textarea name="description[]" class="form-control ckeditor" id="addeditor" cols="30" rows="10">{!! @$prodeti->description !!}</textarea>
                                </div>

                                <div class="col-md-12 mb-3">
                                    <label for=""></label>
                                    <h3 style="text-align: center">
                                        <a href="#"  class="btn btn-success addmore_edite"><i style="font-size: 20px;padding: 3px;" class="fa fa-plus"></i></a>
                                        <a href="#"  class="btn btn-danger removemore_edite"><i style="font-size: 20px;padding: 3px;" class="fa fa-minus"></i></a></h3>
                                </div>

                            </div>
                            </div>
                        @empty

                        @endforelse

                        </div>



                    @forelse(@$product_details as $prodeti)

                        @empty

                        <div class="document">
                            <div class="remove_more">
                                <div class="row">

                                    <div class="col-md-12 mb-3">
                                        <label for="">Title</label>
                                        <input type="text" class="form-control" name="title[]" placeholder="Enter title">
                                    </div>


                                    <div class="col-md-12 mb-3">
                                        <label for="">Description</label>
                                        <textarea name="description[]" class="form-control ckeditor" id="addeditor" cols="30" rows="10"></textarea>
                                    </div>

                                    <div class="col-md-12 mb-3">
                                        <label for=""></label>
                                        <h3 style="text-align: center">
                                            <a href="#"  class="btn btn-success addmore"><i style="font-size: 20px;padding: 3px;" class="fa fa-plus"></i></a>
                                            <a href="#"  class="btn btn-danger removemore"><i style="font-size: 20px;padding: 3px;" class="fa fa-minus"></i></a></h3>
                                    </div>

                                </div>
                            </div>
                            </div>

                            @endforelse




                                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                        <div class="text-right">
                                            <button type="button" id="submit" name="submit" class="btn btn-white">Cancel</button>
                                            <button type="submit" id="submit" name="submit" class="btn btn-primary">Submit Form</button>
                                        </div>
                                    </div>



                        </div>
                        </div>

                    </div>
                </form>
            </div>
        </div>




    <!--------------------Edite More-------------->

    <div class="documentesdsf_edite" style="display: none">
        <div class="whole_html_edite">
            <div class="remove_more_edite">
                <div class="row">

                    <h3 style=" padding-left: 15px;font-family: cursive;color: burlywood;">Add New Section</h3>

                    <div class="col-md-12 mb-3">
                        <label for="">Title</label>
                        <input type="text" class="form-control" name="title[]" placeholder="Enter title">
                    </div>


                    <div class="col-md-12 mb-3">
                        <label class="" for="">Description</label>
                        <textarea name="description[]" class="form-control" id="addeditor" cols="30" rows="10" placeholder="Enter Details"></textarea>
                    </div>

                    <div class="col-md-12 mb-3">
                        <label for=""></label>
                        <h3 style="text-align: center">
                            <a href="#"  class="btn btn-success addmore_edite"><i style="font-size: 20px;padding: 3px;" class="fa fa-plus"></i></a>
                            <a href="#"  class="btn btn-danger removemore_edite"><i style="font-size: 20px;padding: 3px;" class="fa fa-minus"></i></a></h3>
                    </div>

                </div>
            </div>
        </div>
    </div>



<!----------------------Add More Section------------------>
    <div class="documentes" style="display: none">
    <div class="whole_html">
    <div class="remove_more">
        <div class="row">

            <h3 style=" padding-left: 15px;font-family: cursive;color: burlywood;">Add New Section</h3>

            <div class="col-md-12 mb-3">
                <label for="">Title</label>
                <input type="text" class="form-control" name="title[]" placeholder="Enter title">
            </div>


            <div class="col-md-12 mb-3">
                <label class="" for="">Description</label>
                <textarea name="description[]" class="form-control" id="addeditor" cols="30" rows="10" placeholder="Enter Details"></textarea>
            </div>

            <div class="col-md-12 mb-3">
                <label for=""></label>
                <h3 style="text-align: center">
                    <a href="#"  class="btn btn-success addmore"><i style="font-size: 20px;padding: 3px;" class="fa fa-plus"></i></a>
                    <a href="#"  class="btn btn-danger removemore"><i style="font-size: 20px;padding: 3px;" class="fa fa-minus"></i></a></h3>
            </div>

        </div>
        </div>
        </div>
    </div>



@section('footer')

    <!--------Edite More--------->

    <script>
        var countedite=0;
        $(document).on('click','.addmore_edite',function(){

            var whole_htmlEd = $('.whole_html_edite').html();
            $('.document_edite').append(whole_htmlEd);

            countedite++;

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
                title:'Successfully Section Add',
            })

        });


        var countedite=0;
        $(document).on('click','.removemore_edite',function(){

            $(this).closest('.remove_more_edite').remove();
            countedite--;
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
                title:'Successfully Section Remove',
            })
        });


    </script>







     <!--------------Add More-------->
        <script>
            var count=0;
            $(document).on('click','.addmore',function(){

               var whole_html = $('.whole_html').html();
                $('.document').append(whole_html);

               count++;

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
                    title:'Successfully Section Add',
                })

           });
            var count=0;
            $(document).on('click','.removemore',function(){

                $(this).closest('.remove_more').remove();
                count--;
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
                    title:'Successfully Section Remove',
                })
            });


        </script>
        @endsection
@endsection