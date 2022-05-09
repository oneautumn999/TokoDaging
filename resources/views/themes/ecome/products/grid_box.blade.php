{{-- <div class="col-lg-4 col-md-6 col-12">  --}}
	{{-- <div class="single-product">
		<div class="product-img ">
			<a href="{{ url('product/'. $product->slug) }}">
				@if ($product->productImages->first())
					<img src="{{ asset('storage/'.$product->productImages->first()->path) }}" alt="{{ $product->name }}" class="img-fluid">
				@else
					<img src="{{ asset('themes/ecome/assets/img/product/fashion-colorful/1.jpg') }}" alt="{{ $product->name }}">
				@endif
			</a>
		</div>
		<div class="product-content">
			<h4>
				<a href="{{ url('product/'. $product->slug) }}">{{ $product->name }}</a>
				<div class="pull-right icon-cart-furniture add-to-fav" product-slug="{{ $product->slug }}" href="">
					<i class="fa fa-heart-o"></i>
				</div>
			</h4>
			<span><p>Rp{{ number_format($product->price_label()) }}</p></span>
			<span><p>Rp{{ number_format($product->price_label()) }}</p></span>
		</div>
	</div> --}}
{{-- </div> --}}
