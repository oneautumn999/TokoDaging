@if ($products)
<section class="products-grids trending pb-4">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="section-title">
                    <h2>Trending Items</h2>
                </div>
            </div>
        </div>
        <div class="row mt-2">
            @foreach ($products as $product)
            <div class="single-product">
                <div class="col-lg-4 col-md-6 col-12">
						@php
							$product = $product->parent ?: $product;	
						@endphp
							<div class="product-img">
								<a href="{{ url('product/'. $product->slug) }}">
									@if ($product->productImages->first())
										<img src="{{ asset('storage/'.$product->productImages->first()->path) }}" alt="{{ $product->name }}" class="img-fluid">
									@else
										<img src="{{ asset('themes/ecome/assets/img/product/fashion-colorful/1.jpg') }}" alt="{{ $product->name }}">
									@endif
								</a>
							</div>
							<div class="funiture-product-content text-center">
								<h4><a href="{{ url('product/'. $product->slug) }}">{{ $product->name }}</a></h4>
								<span><p>Rp{{ number_format($product->price_label()) }}</p></span>
							</div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
@endif