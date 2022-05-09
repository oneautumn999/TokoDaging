@extends('themes.ecome.layout')

@section('content')
<section class="breadcrumb-section pt-8 pb-4">
    <div class="container">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Products</li>
        </ol>
    </div>
</section>
<section class="products-grid pb-4 pt-4">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-4 col-12">
                @include('themes.ecome.products.sidebar')
            </div>
            <div class="col-lg-9 col-md-8 col-12" >
                <div class="row">
                    <div class="col-12">
                        <div class="products-top">
                            <div class="products-top-inner">
                                <div class="products-found">
                                    <p><span>{{ count($products) }}</span> Product Found of <span>{{ $products->total() }}</span></p>
                                </div>
                                <div class="products-sort">
                                    <span>Sort By : </span>
                                    {{ Form::select('sort', $sorts , $selectedSort ,array('onChange' => 'this.options[this.selectedIndex].value && (window.location = this.options[this.selectedIndex].value);')) }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                @forelse ($products as $product)
                <div class="col-lg-4 col-md-6 col-12"> 
                        <div class="single-product">
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
                                @if ($product->diskon == 'diskon')
                                <span><p style="text-decoration: line-through red">Rp{{ number_format($product->price_label2()) }}</p></span>
                                <span><p >Rp{{ number_format($product->price_label()) }}</p></span>
                                @else
                                <span><p >Rp{{ number_format($product->price_label()) }}</p></span>
                                @endif
                            </div>
                        </div>
                    </div>
                    @empty
                        No product found!
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</section>
@endsection