@extends('themes.ecome.layout')

@section('content')
<section class="breadcrumb-area breadcrumb-section pt-8 pb-4">
	<div class="container">
		<h2>My Favorites</h2>
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="{{ url('/') }}">home</a></li>
			<li class="breadcrumb-item active" aria-current="page">my favorites</li>
		</ol>
	</div>
</section>
	<div class="shop-page-wrapper shop-page-padding ptb-100">
		<div class="container-fluid">
			<div class="row">
				<div class="col-lg-3">
					@include('themes.ecome.partials.user_menu')
				</div>
				<div class="col-lg-9">
					@include('admin.partials.flash')
					<div class="shop-product-wrapper res-xl">
						<div class="table-content table-responsive">
							<table class="table table-bordered table-striped">
								<thead>
									<th>Order ID</th>
									<th>Grand Total</th>
									<th>Status</th>
									<th>Payment</th>
									<th>Action</th>
								</thead>
								<tbody>
									@forelse ($orders as $order)
										<tr>    
											<td>
												{{ $order->code }}<br>
												<span style="font-size: 12px; font-weight: normal"> {{\General::datetimeFormat($order->order_date) }}</span>
											</td>
											<td>{{\General::priceFormat($order->grand_total) }}</td>
											<td>{{ $order->status }}</td>
											<td>{{ $order->payment_status }}</td>
											<td>
												<a href="{{ url('orders/'. $order->id) }}" class="btn btn-info btn-sm">details</a>
											</td>
										</tr>
									@empty
										<tr>
											<td colspan="5">No records found</td>
										</tr>
									@endforelse
								</tbody>
							</table>
							{{ $orders->links() }}
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection