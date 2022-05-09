{{-- <div class="col-lg-4 col-md-6 col-12">
    <div class="single-product">
        <div class="product-img">
            <a href="product-detail.html">
                <img src="./assets/img/products/p2.jpg" class="img-fluid" />
            </a>
        </div>
        <div class="product-content">
            <h3><a href="product-detail.html">Cool &amp; Awesome Item</a></h3>
            <div class="product-price">
                <span>$57.00</span>
            </div>
        </div>
    </div>
</div>
</div> --}}



{{-- <div class="col-lg-8">
    <div class="product-wrapper mb-30 single-product-list product-list-right-pr mb-60">
        <div class="product-img list-img-width">
            <a href="{{ url('product/'. $product->slug) }}">
                @if ($product->productImages->first())
					<img src="{{ asset('storage/'.$product->productImages->first()->path) }}" alt="{{ $product->name }}">
				@else
					<img src="{{ asset('themes/ecome/assets/img/product/fashion-colorful/1.jpg') }}" alt="{{ $product->name }}">
				@endif
            </a>
            <span>hot</span>
            <div class="product-action-list-style">
                <a class="animate-right" title="Quick View" data-toggle="modal" data-target="#exampleModal" href="#">
                    <i class="pe-7s-look"></i>
                </a>
            </div>
        </div>
        <div class="product-content-list">
            <div class="product-list-info">
                <h4><a href="{{ url('product/'. $product->slug) }}">{{ $product->name }}</a></h4>
                <span>{{ number_format($product->price_label()) }}</span>
                <p>{!! $product->short_description !!}</p>
            </div>
            <div class="product-list-cart-wishlist">
                <div class="product-list-cart">
                    <a class="btn-hover list-btn-style" href="#">add to cart</a>
                </div>
                <div class="product-list-wishlist">
                    <a class="btn-hover list-btn-wishlist" href="#">
                        <i class="pe-7s-like"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div> --}}