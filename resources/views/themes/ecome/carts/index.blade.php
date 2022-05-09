@extends('themes.ecome.layout')

@section('content')
<section class="breadcrumb-section pb-4 pt-8">
    <div class="container">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">cart page</li>
        </ol>
    </div>
</section>
<!-- shopping-cart-area start -->
<section class="cart-main-area pt-95 pb-100">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <h1 class="cart-heading">Cart</h1>
                {!! Form::open(['url' => 'carts/update']) !!}
                    <div class="table-content table-responsive">
                        <table>
                            <thead>
                                <tr>
                                    <th>remove</th>
                                    <th>images</th>
                                    <th>Product</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($items as $item)
                                    @php
                                        $product = isset($item->associatedModel->parent) ? $item->associatedModel->parent : $item->associatedModel;
                                        $image = !empty($product->productImages->first()) ? asset('storage/'.$product->productImages->first()->path) : asset('themes/ecome/assets/img/cart/3.jpg')
                                    @endphp
                                    <tr>
                                        <td class="product-remove">
                                            <a href="{{ url('carts/remove/'. $item->id)}}" class="delete"><i class="ni ni-fat-delete"></i></a>
                                        </td>
                                        <td class="product-thumbnail">
                                            <a href="{{ url('product/'. $product->slug) }}"><img src="{{ $image }}" alt="{{ $product->name }}" style="width:100px"></a>
                                        </td>
                                        <td class="product-name"><a href="{{ url('product/'. $product->slug) }}">{{ $item->name }}</a></td>
                                        <td class="product-price-cart"><span class="amount">{{ number_format($item->price) }}</span></td>
                                        <td class="product-quantity">
                                            {{-- <input name="" value="{{ $item->quantity }}" type="number" min="1"> --}}
                                            {!! Form::number('items['. $item->id .'][quantity]', $item->quantity, ['min' => 1, 'required' => true]) !!}
                                        </td>
                                        <td class="product-subtotal">{{ number_format($item->price * $item->quantity)}}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6">The cart is empty!</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="coupon-all">
                                <div class="coupon2">
                                    <input class="button" name="update_cart" value="Update cart" type="submit">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-5 ml-auto">
                            <div class="cart-page-total">
                                <h2>Cart totals</h2>
                                <ul>
                                    <li>Subtotal<span>{{ number_format(\Cart::getSubTotal()) }}</span></li>
                                    <li>Total<span>{{ number_format(\Cart::getTotal()) }}</span></li>
                                </ul>
                                <a href="{{ url('orders/checkout') }}">Proceed to checkout</a>
                            </div>
                        </div>
                    </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</section>
<!-- shopping-cart-area end -->
@endsection