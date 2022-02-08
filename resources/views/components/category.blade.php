<section class="top-category section-padding">
    <div class="container">
        <div class="owl-carousel owl-carousel-category">

            @foreach(@$category as $cat)
                @php
                 $procot = App\Models\Admin\ProductManage::where('cat_id',$cat->id)->count();
                @endphp
            <div class="item">
                <div class="category-item">
                    <a href="{{route('CategoryShopPage',base64_encode($cat->id))}}">
                        <img class="img-fluid" src="{{(@$cat->image)?url('upload/Client/Category/'.$cat->image):''}}" alt="">
                        <h6>{{@$cat->category_name}}</h6>
                        <p>{{@$procot}} Items</p>
                    </a>
                </div>
            </div>


                @endforeach
        </div>
    </div>
</section>