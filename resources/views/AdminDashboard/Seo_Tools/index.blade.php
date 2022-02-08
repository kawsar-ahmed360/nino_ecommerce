@extends('AdminDashboard.master')
@section('title') AllPage Seo Tools @endsection
@section('admin-content')

    <div class="table-container">
        <div class="t-header">AllPage Seo Tools </div>
        <div class="table-responsive" style="padding: 35px;">
          @if(!empty($seo->home_meta_title) OR !empty($seo->home_meta_des) OR !empty($seo->home_header_code))
                <table class="table table-striped">

                    <h4>Home Page</h4>
                    <tr>
                        <td colspan="2"><a href="#" class="btn btn-info" data-toggle="modal" data-target="#HomeSeo">Edite</a></td>
                    </tr>
                    <hr>
                    <tr>
                        <th>Meta Title</th>
                        <td>{{@$seo->home_meta_title}}</td>
                    </tr>

                    <tr>
                        <th>Meta Description</th>
                        <td>{{@$seo->home_meta_des}}</td>
                    </tr>


                    <tr>
                        <th>Header Code</th>
                        <td>{{@$seo->home_header_code}}</td>
                    </tr>

                </table>
              @else
              nai
            @endif



              @if(!empty($seo->shop_meta_title) OR !empty($seo->shop_meta_des) OR !empty($seo->shop_header_code))
                  <table class="table table-striped">
                      <h4>Shop Page</h4>
                      <tr>
                          <td colspan="2"><a href="#" class="btn btn-info" data-toggle="modal" data-target="#ShopSeo">Edite</a></td>
                      </tr>
                      <hr>
                      <tr>
                          <th>Meta Title</th>
                          <td>{{@$seo->shop_meta_title}}</td>
                      </tr>

                      <tr>
                          <th>Meta Description</th>
                          <td>{{@$seo->shop_meta_des}}</td>
                      </tr>


                      <tr>
                          <th>Header Code</th>
                          <td>{{@$seo->shop_header_code}}</td>
                      </tr>

                  </table>
              @else
                  nai
              @endif



              @if(!empty($seo->contact_meta_title) OR !empty($seo->contact_meta_des) OR !empty($seo->contact_header_code))
                  <table class="table table-striped">
                      <h4>Contact Page</h4>
                      <tr>
                          <td colspan="2"><a href="" class="btn btn-info" data-toggle="modal" data-target="#ContactSeo">Edite</a></td>
                      </tr>
                      <hr>
                      <tr>
                          <th>Meta Title</th>
                          <td>{{@$seo->contact_meta_title}}</td>
                      </tr>

                      <tr>
                          <th>Meta Description</th>
                          <td>{{@$seo->contact_meta_des}}</td>
                      </tr>


                      <tr>
                          <th>Header Code</th>
                          <td>{{@$seo->contact_header_code}}</td>
                      </tr>

                  </table>
              @else
                  nai
              @endif
        </div>
    </div>


    <!-- Home page Seo Modal -->
    <div class="modal" id="HomeSeo">
        <div class="modal-dialog">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Home Page Seo</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <form action="{{route('SeoToolsHomeEdite')}}" method="POST">
                        @csrf
                    <div class="row">
                        <div class="col-md-12">
                            <label for="">Meta Title</label>
                            <input type="text" class="form-control" name="home_meta_title" value="{{@$seo->home_meta_title}}" placeholder="Enter meta title">
                        </div>


                        <div class="col-md-12">
                            <label for="">Header Code</label>
                            <input type="text" class="form-control" name="home_header_code" value="{{@$seo->home_header_code}}" placeholder="Enter Header Code">
                        </div>

                        <div class="col-md-12">
                            <label for="">Meta Description</label>
                            <textarea type="text" class="form-control" name="home_meta_des" placeholder="Enter meta title">{{@$seo->home_meta_des}}</textarea>
                        </div>
                    </div>

                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-info" >sbumit</button>
                    </div>
                    </form>
                </div>



            </div>
        </div>
    </div>


    <!-- Shop page Seo Modal -->

    <div class="modal" id="ShopSeo">
        <div class="modal-dialog">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Shop Page Seo</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <form action="{{route('SeoToolsShopEdite')}}" method="POST">
                        @csrf
                    <div class="row">
                        <div class="col-md-12">
                            <label for="">Meta Title</label>
                            <input type="text" class="form-control" name="shop_meta_title" value="{{@$seo->shop_meta_title}}" placeholder="Enter meta title">
                        </div>


                        <div class="col-md-12">
                            <label for="">Header Code</label>
                            <input type="text" class="form-control" name="shop_header_code" value="{{@$seo->shop_header_code}}" placeholder="Enter Header Code">
                        </div>

                        <div class="col-md-12">
                            <label for="">Meta Description</label>
                            <textarea type="text" class="form-control" name="shop_meta_des" placeholder="Enter meta title">{{@$seo->shop_meta_des}}</textarea>
                        </div>
                    </div>

                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-info" >sbumit</button>
                    </div>
                    </form>
                </div>



            </div>
        </div>
    </div>


    <!-- Contact page Seo Modal -->

    <div class="modal" id="ContactSeo">
        <div class="modal-dialog">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Contact Page Seo</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <form action="{{route('SeoToolsContactEdite')}}" method="POST">
                        @csrf
                    <div class="row">
                        <div class="col-md-12">
                            <label for="">Meta Title</label>
                            <input type="text" class="form-control" name="contact_meta_title" value="{{@$seo->contact_meta_title}}" placeholder="Enter meta title">
                        </div>


                        <div class="col-md-12">
                            <label for="">Header Code</label>
                            <input type="text" class="form-control" name="contact_header_code" value="{{@$seo->contact_header_code}}" placeholder="Enter Header Code">
                        </div>

                        <div class="col-md-12">
                            <label for="">Meta Description</label>
                            <textarea type="text" class="form-control" name="contact_meta_des" placeholder="Enter meta title">{{@$seo->contact_meta_des}}</textarea>
                        </div>
                    </div>

                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-info" >sbumit</button>
                    </div>

                    </form>
                </div>



            </div>
        </div>
    </div>

@endsection