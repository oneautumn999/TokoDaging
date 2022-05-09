<div class="sidebar ">
    <div class="sidebar-widget bg-yul">
        <div class="widget-title">
            <h3>Shop by Price</h3>
        </div>
        <div class="widget-content shop-by-price">
            <form method="GET" action="{{ url('products')}}">
                <div class="sidebar-widget bg-yul mb-40">
                    <h3 class="sidebar-title">Filter by Price</h3>
                    <div class="price_filter ">
                        <div id="slider-range"></div>
                        <div class="price_slider_amount">
                            <div class="label-input">
                                <label>price : </label>
                                <input type="text" id="amount" name="price"  placeholder="Add Your Price" style="width:170px" />
                                <input type="hidden" id="productMinPrice" value="{{ $minPrice }}"/>
                                <input type="hidden" id="productMaxPrice" value="{{ $maxPrice }}"/>
                            </div>
                            <button type="submit">Filter</button> 
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    @if ($categories)
		<div class="sidebar-widget bg-yul mb-45">
			<h3 class="sidebar-title ">Categories</h3>
			<div class="sidebar-categories">
				<ul>
					@foreach ($categories as $category)
						<li><a style="color: rgb(153, 62, 2)" href="{{ url('products?category='. $category->slug) }}">{{ $category->name }}</a></li>
					@endforeach
				</ul>
			</div>
		</div>
	@endif
    
    @if ($promos)
		<div class="sidebar-widget bg-yul sidebar-overflow mb-45">
			<h3 class="sidebar-title">Promo</h3>
			<div class="sidebar-categories">
				<ul>
					@foreach ($promos as $promo)
						<li><a style="color: rgb(153, 62, 2)" href="{{ url('products?option='. $promo->id) }}">{{ $promo->name }}</a></li>
					@endforeach
				</ul>
			</div>
		</div>
    @endif
</div>