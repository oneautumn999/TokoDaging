@extends('themes.ecome.layout')

@section('content')
<section class="breadcrumb-section pt-8 pb-4">
    <div class="container">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ url('products')}}">Products</a></li>
            <li class="breadcrumb-item active" aria-current="page">Product Detail</li>
        </ol>
    </div>
</section>
<section class="product-page ptb-100 pt-4 pb-90">
    <div class="container">
        {{-- {{ $product->items->id}} --}}
        <div class="row  product-detail-inner">
            <div class="col-md-12 col-lg-8 col-12">
                <div class="product-details-img-content">
                    <div class="product-details-tab mr-70">
                        <div class="product-details-large tab-content">
                            @php
                                $i = 1
                            @endphp
                            @forelse ($product->productImages as $image)
                                <div class="tab-pane fade {{ ($i == 1) ? 'active show' : '' }}" id="pro-details{{ $i}}" role="tabpanel">
                                    <img src="{{ asset('storage/'.$image->path) }}" alt="{{ $product->name }}">
                                </div>
                                @php
                                    $i++
                                @endphp
                            @empty
                                No image found!
                            @endforelse
                        </div>
                        <div class="product-details-large nav " role=tablist>
                            @php
                                $i = 1
                            @endphp
                            @forelse ($product->productImages as $image)
                                
                                <a class="{{ ($i == 1) ? 'active' : '' }} mr-12 " href="#pro-details{{ $i }}" data-toggle="tab" role="tab" aria-selected="true">
                                    <img src="{{ asset('storage/'.$image->path) }}" width="146" height="134" alt="{{ $product->name }}">
                                </a>
                                @php
                                    $i++
                                @endphp
                            @empty
                                No image found!
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-12">
                <div class="product-detail">
                    <h2>{{ $product->name }}</h2> 
                    <div class="product-price">
                        <span>{{ number_format($product->price_label()) }}</span>
                    </div>
                    <div class="product-short-desc">
                        <p>{{ $product->short_description }}</p>
                    </div>
                    {!! Form::open(['url' => 'carts']) !!}
                    {{ Form::hidden('product_id', $product->id) }}
                    <div class="product-select">
                        <form>
                            @if ($product->type == 'configurable')
                            <div class="select-option-part" style="margin-bottom: 10px">
                                <h4>Promo</h4>
                                {!! Form::select('promo', $promos , null, ['class' => 'select form-control', 'placeholder' => '- Please Select -']) !!}
                            </div>
                            @endif

                            <div class="quickview-plus-minus">
								<div class="cart-plus-minus" style="margin-bottom: 10px">
									{!! Form::number('qty', 1, ['class' => 'select form-control', 'placeholder' => 'qty']) !!}
								</div>
								<div class="col-md-12" style="margin-bottom: 10px">
                                    <button type="submit" class="submit btn btn-warning btn-block">Add to Cart</button>
                                </div>
                                <div class="col-md-4">
				                        <div class="icon-cart-furniture add-to-fav " product-slug="{{ $product->slug }}" href="">
					                        <i class="fa fa-heart-o fa-lg"></i>
				                        </div>
                                </div>
							</div>
                        </form>
                    </div>
                    {!! Form::close() !!}
                    <div class="product-categories">
                        <ul>
                            <li class="categories-title">Categories :</li>
                            @foreach ($product->categories as $category)
								<li><a href="{{ url('products/category/'. $category->slug ) }}">{{ $category->name }}</a></li>
							@endforeach
                        </ul>
                    </div>
                    <div class="product-share">
                        <ul>
                            <li class="categories-title">Share :</li>
                            <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                            <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                            <li><a href="#"><i class="fa fa-pinterest"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="product-details">
                        <div class="nav-wrapper">
                            <ul class="nav nav-pills nav-fill flex-column flex-md-row" id="tabs-icons-text" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link mb-sm-3 mb-md-0 active" id="tabs-icons-text-1-tab" data-toggle="tab" href="#tabs-icons-text-1" role="tab" aria-controls="tabs-icons-text-1" aria-selected="true">Description</a>
                                </li>
                            </ul>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <div class="tab-content" id="myTabContent">
                                    <div class="tab-pane fade show active" id="tabs-icons-text-1" role="tabpanel" aria-labelledby="tabs-icons-text-1-tab">
                                        <p>{{ $product->description }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="other-products pb-4 pt-4">
    @include('themes.ecome.partials.popular_products')
</section>
@endsection