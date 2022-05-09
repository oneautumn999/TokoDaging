@extends('themes.ecome.layout')

@section('content')
<section class="breadcrumb-section pt-8 pb-4">
    <div class="container">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Received Page</li>
        </ol>
    </div>
</section>
<!-- received-area start -->
<section class="cart-main-area  ptb-100">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                @include('admin.partials.flash', ['$errors' => $errors])
                <h1 class="cart-heading">Your Order:</h4>
                <div class="row">
                    <div class="col-xl-3 col-lg-4">
                        <p class="text-dark mb-2" style="font-weight: normal; font-size:16px; text-transform: uppercase;">Billing Address</p>
                        <address>
                            {{ $order->customer_first_name }} {{ $order->customer_last_name }}
                            <br> {{ $order->customer_address1 }}
                            <br> {{ $order->customer_address2 }}
                            <br> Email: {{ $order->customer_email }}
                            <br> Phone: {{ $order->customer_phone }}
                            <br> Postcode: {{ $order->customer_postcode }}
                        </address>
                    </div>
                    <div class="col-xl-3 col-lg-4">
                        <p class="text-dark mb-2" style="font-weight: normal; font-size:16px; text-transform: uppercase;">Shipment Address</p>
                        <address>
                            {{ $order->shipment->first_name }} {{ $order->shipment->last_name }}
                            <br> {{ $order->shipment->address1 }}
                            <br> {{ $order->shipment->address2 }}
                            <br> Email: {{ $order->shipment->email }}
                            <br> Phone: {{ $order->shipment->phone }}
                            <br> Postcode: {{ $order->shipment->postcode }}
                        </address>
                    </div>
                    <div class="col-xl-3 col-lg-4">
                        <p class="text-dark mb-2" style="font-weight: normal; font-size:16px; text-transform: uppercase;">Details</p>
                        <address>
                            Invoice ID:
                            <span class="text-dark">#{{ $order->code }}</span>
                            <br> {{ \General::datetimeFormat($order->order_date) }}
                        </address>
                    </div>
                </div>
                <div class="table-content table-responsive">
                    <table>
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Item</th>
                                <th>Description</th>
                                <th>Quantity</th>
                                <th>Unit Cost</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($order->orderItems as $item)
                                <tr>
                                    <td>{{ $item->sku }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>{!! \General::showAttributes($item->attributes) !!}</td>
                                    <td>{{ $item->qty }}</td>
                                    <td>{{ \General::priceFormat($item->base_total) }}</td>
                                    <td>{{ \General::priceFormat($item->sub_total) }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6">Order item not found!</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="row">
                    <div class="col-md-5 ml-auto">
                        <div class="cart-page-total">
                            <ul>
                                <li> Subtotal
                                    <span>{{ \General::priceFormat($order->base_total_price) }}</span>
                                </li>
                                {{-- <li>Tax (10%)
                                    <span>{{ \General::priceFormat($order->tax_amount) }}</span>
                                </li> --}}
                                <li>Shipping Cost
                                    <span>{{ \General::priceFormat($order->discount_amount) }}</span>
                                </li>
                                <li>Total
                                    <span>{{ \General::priceFormat($order->grand_total) }}</span>
                                </li>
                            </ul>
                            @if (!$order->isPaid())
								<a href="{{ $order->payment_url }}">Proceed to payment</a>
							@endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- received-area end -->	
@endsection