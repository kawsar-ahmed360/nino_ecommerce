@extends('AdminDashboard.master')
@section('title') Product Add @endsection
@section('admin-content')
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        <div class="card">
            <div class="card-body">

                <h2 style="font-family: monospace;font-weight: normal;">Product Add :</h2>

                <form action="{{ route('ProductStore') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="row gutters">


                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-6">
                            <div class="form-group">
                                <label for="inputName">Product Name</label>
                                <input type="text" class="form-control @error('product_name') is-invalid @enderror" name="product_name" id="imgInp" placeholder="Enter product_name">
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
                                        <option value="{{@$se->id}}">{{@$se->section_name}}</option>
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
                                        <option value="{{@$cat->id}}">{{@$cat->category_name}}</option>
                                        @endforeach
                                </select>
                            </div>
                        </div>




                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-6">
                            <div class="form-group">
                                <label for="inputName">Color Name</label>
                                <select name="color_id[]" class="form-control js-example-basic-multiple" multiple id="highlight">

                                    @foreach(@$color as $color)
                                        <option value="{{@$color->id}}">{{@$color->color_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>


                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-6">
                            <div class="form-group">
                                <label for="inputName">Tag Name</label>
                                <select name="tag_id[]" class="form-control js-example-basic-multiple" multiple id="highlight">

                                    @foreach(@$tag as $tag)
                                        <option value="{{@$tag->id}}">{{@$tag->tag_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-6">
                            <div class="form-group">
                                <label for="inputName">Plation/Polish</label>
                                <select name="plation_id[]" class="form-control js-example-basic-multiple" multiple id="highlight">

                                    @foreach(@$plation as $plo)
                                        <option value="{{@$plo->id}}">{{@$plo->plating_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>


                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-6">
                            <div class="form-group">
                                <label for="inputName">Carat Title</label>
                                <input type="text" class="form-control @error('carat') is-invalid @enderror" name="carat" id="imgInp" placeholder="Enter carat">
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
                                <input type="text" class="form-control @error('product_price') is-invalid @enderror" name="product_price" id="imgInp" placeholder="Enter product_price">
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
                                <input type="text" class="form-control @error('product_sku') is-invalid @enderror" name="product_sku" id="imgInp" placeholder="Enter product_sku">
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
                                <textarea type="text" class="form-control ckeditor @error('summary') is-invalid @enderror" name="summary" id="imgInp" placeholder="Enter summary"></textarea>
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
                                    <option value="1">Active</option>
                                    <option value="2">Deactive</option>
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



                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                            <h4>Seo Tools:  <button style="background: none;
                                            border: 1px solid burlywood;
                                            padding: 3px;" type="button" class="" data-toggle="collapse" data-target="#demo"><span class="glyphicon glyphicon-sort"></span></button><h4>

                                    <div id="demo" class="collapse">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <label for="" style="display: inline-block; max-width: 100%;
                                            margin-bottom: 5px;font-weight: normal;">Meta Title</label>
                                                <input type="text" class="form-control" name="meta_title" id="meta_title" placeholder="Enter meta title">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <label for="" style="display: inline-block; max-width: 100%;
                                            margin-bottom: 5px;font-weight: normal;">Meta Description</label>
                                                <textarea class="form-control" name="meta_des" id="meta_des" cols="20" rows="6"></textarea>
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