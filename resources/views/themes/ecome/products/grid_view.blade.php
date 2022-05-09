<div class="col-lg-4 col-md-6 col-12"> 
    @forelse ($products as $product)
        @include('themes.ecome.products.grid_box')
    @empty
        No product found!
    @endforelse
</div>
