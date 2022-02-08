@extends('AdminDashboard.master')
@section('title') Page Edit @endsection
@section('admin-content')
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        <div class="card">
            <div class="card-body">

                <h2 style="font-family: monospace;font-weight: normal;">Page Edit:</h2>

                <form  action="{{ route('PageUpdate',$page->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="row gutters">


                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-6">
                            <div class="form-group">
                                <label for="inputName">Title</label>
                                <input type="text" class="form-control @error('title') is-invalid @enderror" value="{{ $page->title }}" name="title" id="imgInp" placeholder="Enter  title">
                                @error('title')
                                <span class="invalid-feedback" role="alert">
                                               	 <strong style="color:red">{{$message}}</strong>
                                               </span>
                                @enderror
                            </div>
                        </div>


                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-6">
                            <div class="form-group">
                                <label for="inputName">Menu Name</label>
                                <select name="title_uri" class="form-control @error('title_uri') is-invalid @enderror">


                                    @if (!(empty($page->title_uri)))
                                        <option value="{{$parent_id_for->slug}}">{{$parent_id_for->menu_name}}</option>

                                    @else
                                        <option value="NULL">Select Menu</option>

                                    @endif



                                    @foreach($menu_all as $main_menu)

                                        <option value="{{$main_menu->slug}}">{{$main_menu->menu_name}}</option>

                                    @endforeach
                                </select>
                                @error('title_uri')
                                <span class="invalid-feedback" role="alert">
                                               	 <strong style="color:red">{{$message}}</strong>
                                               </span>
                                @enderror
                            </div>
                        </div>



                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                            <div class="form-group">
                                <label for="inputName">Descrption</label>
                                <textarea type="text" class="form-control ckeditor @error('description') is-invalid @enderror" name="description" id="imgInp" placeholder="Enter  title">{!! $page->description !!}</textarea>
                                @error('description')
                                <span class="invalid-feedback" role="alert">
                                               	 <strong style="color:red">{{$message}}</strong>
                                               </span>
                                @enderror
                            </div>
                        </div>



                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                            <div class="form-group">
                                <label for="inputName">Descrption</label>
                                <input type="file" class="form-control ckeditor @error('description') is-invalid @enderror" name="image" id="imgInp" placeholder="Enter  title">

                                <img src="{{ asset('upload/Admin/page/'.$page->image) }}" class="img-thumbnail" width="100" height="100" />
                                @error('image')
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
                                                <input type="text" class="form-control" name="meta_title" value="{{@$page->meta_title}}" id="meta_title" placeholder="Enter meta title">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <label for="" style="display: inline-block; max-width: 100%;
                                            margin-bottom: 5px;font-weight: normal;">Meta Description</label>
                                                <textarea class="form-control" name="meta_des" id="meta_des" cols="20" rows="6">{!!@$page->meta_des!!}</textarea>
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