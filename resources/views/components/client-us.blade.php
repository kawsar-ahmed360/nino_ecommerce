<section class="instagram-items">
    <div class="section-title text-center mb-5">
        <h2>WHAT OUR CLIENTS THINK OF US</h2>
        <!-- <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p> -->
    </div>
    <div class="portfolio-content">

        @foreach(@$ourclient as $key=>$cli)
        <div class="box-hover">
            <div class="hover-box">
                <div class="hover-img">
                    <img src="{{(@$cli->image)?url('upload/Client/ClientThink/'.$cli->image):''}}" alt="Image"/>
                    <div class="over-layer">
                        <ul class="links">
                            <li><a href="{{@$cli->url}}"><i class="mdi mdi-instagram"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        @endforeach




    </div>
</section>