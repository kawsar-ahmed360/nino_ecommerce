@extends('AdminDashboard.master')
@section('title') Product Edit @endsection
@section('admin-content')
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        <div class="card">
            <div class="card-body">

                <h2 style="font-family: monospace;font-weight: normal;">Product Edit :</h2>

                <form action="{{ route('ProductUpdate') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <input type="hidden" value="{{@$edite->id}}" name="EditeId">

                    <div class="row gutters">


                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-6">
                            <div class="form-group">
                                <label for="inputName">Product Name</label>
                                <input type="text" class="form-control @error('product_name') is-invalid @enderror" value="{{@$edite->product_name}}" name="product_name" id="imgInp" placeholder="Enter product_name">
                                @error('product_name')
                                <span class="invalid-feedback" role="alert">
                                               	 <strong style="color:red">{{$message}}</strong>
                                               </span>
                                @enderror
                            </div>
                        </div>



                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-6">
                            <div class="form-group">
                                <label for="inputName">Section</label>
                                <select name="section_id[]" class="form-control js-example-basic-multiple" multiple id="highlight">

                                    @foreach(@$section as $se)
                                        <option value="{{@$se->id}}" @foreach(@$section_edite as $set) {{(@$se->id==$set->id)?'selected':''}} @endforeach>{{@$se->section_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>


                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-6">
                            <div class="form-group">
                                <label for="inputName">Category_name</label>
                                <select name="cat_id" class="form-control" id="highlight">
                                    <option disabled selected>----Select Once------</option>
                                    @foreach(@$category as $cat)
                                        <option value="{{@$cat->id}}" {{(@$cat->id==$edite->cat_id)?'selected':''}}>{{@$cat->category_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>




                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-6">
                            <div class="form-group">
                                <label for="inputName">Color Name</label>
                                <select name="color_id[]" class="form-control js-example-basic-multiple" multiple id="highlight">

                                    @foreach(@$color as $color)
                                        <option value="{{@$color->id}}" @foreach(@$color_edite as $col) {{(@$color->id==$col->id)?'selected':''}} @endforeach>{{@$color->color_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>


                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-6">
                            <div class="form-group">
                                <label for="inputName">Tag Name</label>
                                <select name="tag_id[]" class="form-control js-example-basic-multiple" multiple id="highlight">
                                    
                                      

                                    @foreach(@$tag as $tag)
                                    
                                     @if(@$tag_verify!=null)
                                        <option value="{{@$tag->id}}" @foreach(@$tag_edite as $tage) {{(@$tag->id==@$tage->id)?'selected':''}} @endforeach>{{@$tag->tag_name}}</option>
                                         @else
                                            <option value="{{@$tag->id}}" >{{@$tag->tag_name}}</option>
                                         @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-6">
                            <div class="form-group">
                                <label for="inputName">Plation/Polish</label>
                                <select name="plation_id[]" class="form-control js-example-basic-multiple" multiple id="highlight">

                                    @foreach(@$plation as $plo)
                                        <option value="{{@$plo->id}}" @foreach(@$plating_edite as $plati) {{(@$plo->id==$plati->id)?'selected':''}} @endforeach>{{@$plo->plating_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>


                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-6">
                            <div class="form-group">
                                <label for="inputName">Carat Title</label>
                                <input type="text" class="form-control @error('carat') is-invalid @enderror" name="carat" value="{{@$edite->carat}}" id="imgInp" placeholder="Enter carat">
                                @error('carat')
                                <span class="invalid-feedback" role="alert">
                                               	 <strong style="color:red">{{$message}}</strong>
                                               </span>
                                @enderror
                            </div>
                        </div>


                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-6">
                            <div class="form-group">
                                <label for="inputName">Product Price</label>
                                <input type="text" class="form-control @error('product_price') is-invalid @enderror" value="{{@$edite->product_price}}" name="product_price" id="imgInp" placeholder="Enter product_price">
                                @error('product_price')
                                <span class="invalid-feedback" role="alert">
                                               	 <strong style="color:red">{{$message}}</strong>
                                               </span>
                                @enderror
                            </div>
                        </div>


                        <div class="col-xl-12 col-lg-12-md-12 col-sm-12 col-12">
                            <div class="form-group">
                                <label for="inputName">Product SKU</label>
                                <input type="text" class="form-control @error('product_sku') is-invalid @enderror" value="{{@$edite->product_sku}}" name="product_sku" id="imgInp" placeholder="Enter product_sku">
                                @error('product_sku')
                                <span class="invalid-feedback" role="alert">
                                               	 <strong style="color:red">{{$message}}</strong>
                                               </span>
                                @enderror
                            </div>
                        </div>


                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                            <div class="form-group">
                                <label for="inputName">Summary</label>
                                <textarea type="text" class="form-control ckeditor @error('summary') is-invalid @enderror" name="summary" id="imgInp" placeholder="Enter summary">{!! @$edite->summary !!}</textarea>
                                @error('summary')
                                <span class="invalid-feedback" role="alert">
                                               	 <strong style="color:red">{{$message}}</strong>
                                               </span>
                                @enderror
                            </div>
                        </div>




                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                            <div class="form-group">
                                <label for="inputName">Status</label>
                                <select name="status" class="form-control" id="status">
                                    <option disabled selected>----Select Once------</option>
                                    <option value="1" {{(@$edite->status=='1')?'selected':''}}>Active</option>
                                    <option value="2" {{(@$edite->status=='2')?'selected':''}}>Deactive</option>
                                </select>
                            </div>
                        </div>




                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-6">
                            <div class="form-group">
                                <label for="inputName">Image</label>
                                <input type="file" class="form-control ckeditor @error('image') is-invalid @enderror" name="image" id="imgInp" placeholder="Enter  title">

                                <span style="color:red">Max Size: Width:440px, Height:440px</span>
                                @error('image')
                                <span class="invalid-feedback" role="alert">
                                               	 <strong style="color:red">{{$message}}</strong>
                                               </span>
                                @enderror
                            </div>
                        </div>



                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-6">
                            <div class="form-group">
                                <label for="inputName">Gallery</label>
                                <input type="file" class="form-control  @error('product_gallery') is-invalid @enderror" name="product_gallery[]" multiple id="imgInp" placeholder="Enter  title">

                                <span style="color:red">Max Size: Width:515px, Height:515px</span>
                                @error('product_gallery')
                                <span class="invalid-feedback" role="alert">
                                               	 <strong style="color:red">{{$message}}</strong>
                                               </span>
                                @enderror
                            </div>
                        </div>



                        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-4">
                            <div class="form-group">
                                <label for="inputName">Old Image</label> <br>
                                <img style="width: 100px;" src="{{(@$edite->image)?url('upload/Client/Product/'.@$edite->image):''}}" alt="">

                            </div>
                        </div>



                        <div class="col-xl-8 col-lg-8 col-md-8 col-sm-8 col-8">
                            <div class="form-group">
                                <label for="inputName">Old Gallery</label> <br>

                                 @foreach(@$gallery as $gall)
                                    <img style="width: 100px;" src="{{(@$gall->product_gallery)?url('upload/Client/ProductGallery/'.@$gall->product_gallery):''}}" alt="">
                                     @endforeach

                            </div>
                        </div>



                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                            <h4>Seo Tools:  <button style="background: none;
                                            border: 1px solid burlywood;
                                            padding: 3px;" type="button" class="" data-toggle="collapse" data-target="#demo"><span class="glyphicon glyphicon-sort"></span></button><h4>

                                    <div id="demo" class="collapse">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <label for="" style="display: inline-block; max-width: 100%;
                                            margin-bottom: 5px;font-weight: normal;">Meta Title</label>
                                                <input type="text" class="form-control" name="meta_title" value="{{@$edite->meta_title}}" id="meta_title" placeholder="Enter meta title">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <label for="" style="display: inline-block; max-width: 100%;
                                            margin-bottom: 5px;font-weight: normal;">Meta Description</label>
                                                <textarea class="form-control" name="meta_des" id="meta_des" cols="20" rows="6">{!! @$edite->meta_des !!}</textarea>
                                            </div>
                                        </div>
                                    </div>







                                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                        <div class="text-right">
                                            <button type="button" id="submit" name="submit" class="btn btn-white">Cancel</button>
                                            <button type="submit" id="submit" name="submit" class="btn btn-primary">Submit Form</button>
                                        </div>
                                    </div>



                        </div>

                    </div>
                </form>
            </div>
        </div>

@endsection