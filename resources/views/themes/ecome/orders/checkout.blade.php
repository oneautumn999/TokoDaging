@extends('themes.ecome.layout')

@section('content')
<section class="breadcrumb-section pt-8 pb-4">
    <div class="container">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Checkout Page</li>
        </ol>
    </div>
</section>
<!-- checkout-area start -->
<section class="checkout-area ptb-100">
    <div class="container">
        {!! Form::model($user, ['url' => 'orders/checkout']) !!}
        <div class="row">
            <div class="col-lg-6 col-md-12 col-12">
                <div class="checkbox-form">						
                    <h3>Billing Details</h3>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="checkout-form-list">
                                <label>First Name <span class="required">*</span></label>										
                                {!! Form::text('first_name', null, ['required' => true]) !!}
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="checkout-form-list">
                                <label>Last Name <span class="required">*</span></label>										
                                {!! Form::text('last_name', null, ['required' => true]) !!}
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="checkout-form-list">
                                <label>Company Name</label>
                                {!! Form::text('company') !!}
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="checkout-form-list">
                                <label>Address/Alamat <span class="required">*</span></label>
                                {!! Form::text('address1', null, ['required' => true, 'placeholder' => 'Home number and street name']) !!}
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="checkout-form-list">
                                {!! Form::text('address2', null, ['placeholder' => 'Apartment, suite, unit etc. (optional)']) !!}
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="checkout-form-list">
                                <label>Provinsi<span class="required">*</span></label>
                                {!! Form::select('province_id', $provinces, Auth::user()->province_id, ['id' => 'province-id','class' => 'select form-control', 'placeholder' => '- Please Select - ', 'required' => true]) !!}
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="checkout-form-list">
                                <label>Kota<span class="required">*</span></label>
                                {!! Form::select('city_id', $cities, null, ['id' => 'city-id','class' => 'select form-control', 'placeholder' => '- Please Select -', 'required' => true])!!}
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="checkout-form-list">
                                <label>Postcode / Kodepos <span class="required">*</span></label>										
                                {!! Form::number('postcode', null, ['required' => true,'class' => 'select form-control', 'placeholder' => 'Postcode']) !!}
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="checkout-form-list">
                                <label>Phone/NomorTelp  <span class="required">*</span></label>										
                                {!! Form::text('phone', null, ['required' => true, 'placeholder' => 'Phone']) !!}
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="checkout-form-list">
                                <label>Email Address </label>										
                                {!! Form::text('email', null, ['placeholder' => 'Email', 'readonly' => true]) !!}
                            </div>
                        </div>							
                    </div>
                    <div class="different-address">
                        <div class="ship-different-title">
                            <h3>
                                <label>Ship to a different address?</label>
                                <input id="ship-box" type="checkbox" name="ship_to"/>
                            </h3>
                        </div>
                        <div id="ship-box-info">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="checkout-form-list">
                                        <label>First Name <span class="required">*</span></label>										
                                        {!! Form::text('shipping_first_name') !!}
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="checkout-form-list">
                                        <label>Last Name <span class="required">*</span></label>										
                                        {!! Form::text('shipping_last_name') !!}
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="checkout-form-list">
                                        <label>Company Name</label>
                                        {!! Form::text('shipping_company') !!}
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="checkout-form-list">
                                        <label>Address <span class="required">*</span></label>
                                        {!! Form::text('shipping_address1', null, ['placeholder' => 'Home number and street name']) !!}
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="checkout-form-list">
                                        {!! Form::text('shipping_address2', null, ['placeholder' => 'Apartment, suite, unit etc. (optional)']) !!}
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="checkout-form-list">
                                        <label>Province<span class="required">*</span></label>
                                        {!! Form::select('shipping_province_id', $provinces, null, ['id' => 'shipping-province', 'placeholder' => '- Please Select - ']) !!}
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="checkout-form-list">
                                        <label>City<span class="required">*</span></label>
                                        {!! Form::select('shipping_city_id', [], null, ['id' => 'shipping-city','placeholder' => '- Please Select -'])!!}
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="checkout-form-list">
                                        <label>Postcode / Zip <span class="required">*</span></label>										
                                        {!! Form::number('shipping_postcode', null, ['placeholder' => 'Postcode']) !!}
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="checkout-form-list">
                                        <label>Phone  <span class="required">*</span></label>										
                                        {!! Form::text('shipping_phone', null, ['placeholder' => 'Phone']) !!}
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="checkout-form-list">
                                        <label>Email </label>										
                                        {!! Form::text('shipping_email', null, ['placeholder' => 'Email']) !!}
                                    </div>
                                </div>	
                            </div>					
                        </div>
                        <div class="order-notes">
                            <div class="checkout-form-list mrg-nn">
                                <label>Order Notes</label>
                                {!! Form::textarea('note', null, ['cols' => 30, 'rows' => 10,'placeholder' => 'Notes about your order, e.g. special notes for delivery.']) !!}
                            </div>									
                        </div>
                    </div>													
                </div>
            </div>	
            <div class="col-lg-6 col-md-12 col-12">
                <div class="your-order">
                    <h3>Your order</h3>
                    <div class="your-order-table table-responsive">
                        <table>
                            <thead>
                                <tr>
                                    <th class="product-name">Product</th>
                                    <th class="product-total">Total</th>
                                </tr>							
                            </thead>
                            <tbody>
                                @forelse ($items as $item)
                                    @php
                                        $product = isset($item->associatedModel->parent) ? $item->associatedModel->parent : $item->associatedModel;
                                        $image = !empty($product->productImages->first()) ? asset('storage/'.$product->productImages->first()->path) : asset('themes/ezone/assets/img/cart/3.jpg')
                                    @endphp
                                    <tr class="cart_item">
                                        <td class="product-name">
                                            {{ $item->name }}	<strong class="product-quantity"> × {{ $item->quantity }}</strong>
                                        </td>
                                        <td class="product-total">
                                            <span class="amount">{{ number_format(\Cart::get($item->id)->getPriceSum()) }}</span>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="2">The cart is empty! </td>
                                    </tr>
                                @endforelse
                            </tbody>
                            <tfoot>
                                <tr class="cart-subtotal">
                                    <th>Subtotal</th>
                                    <td><span class="amount">{{ number_format(\Cart::getSubTotal()) }}</span></td>
                                </tr>
                                <tr class="cart-subtotal">
                                    <th>Shipping Cost Gojek/Grab</th>
                                    <td><span class="amount">{{ number_format(\Cart::getCondition('DISKON')->getCalculatedValue(\Cart::getSubTotal())) }}</span></td>
                                </tr>
                                <tr class="order-total">
                                    <th>Order Total</th>
                                    <td><strong><span class="total-amount">{{ number_format(\Cart::getTotal()) }}</span></strong>
                                    </td>
                                </tr>								 
                            </tfoot>
                        </table>
                    </div>
                    <div class="payment-method">
                        <div class="payment-accordion">
                            <div class="panel-group" id="faq">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h5 class="panel-title"><a data-toggle="collapse" aria-expanded="true" data-parent="#faq">Direct Bank Transfer.</a></h5>
                                    </div>
                                    <div id="payment-1" class="panel-collapse collapse show">
                                        <div class="panel-body">
                                            <p>Lanjutkan Pembayaran Untuk Dapat Dilakukan Pengiriman</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="order-button-payment">
                                <input type="submit" value="Place order" />
                            </div>								
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {!! Form::close() !!}
    </div>
</section>
<!-- checkout-area end -->	
@endsection