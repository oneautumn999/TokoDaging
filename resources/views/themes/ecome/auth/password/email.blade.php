@extends('themes.ecome.layout')

@section('content')
<section class="breadcrumb-section pb-4 pt-8">
    <div class="container">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Forgot Password</li>
        </ol>
    </div>
</section>
<!-- forgot password -area start -->
<div class="register-area ptb-100">
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-12 col-12 col-lg-12 col-xl-6 ml-auto mr-auto">
				<div class="login">
					<div class="login-form-container">
						<div class="login-form">
							@if (session('status'))
								<div class="alert alert-success" role="alert">
									{{ session('status') }}
								</div>
							@endif

							<form method="POST" action="{{ route('password.email') }}">
								@csrf
								<div class="form-group row">
									<div class="col-md-12">
										<input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="{{ __('E-Mail Address') }}">

										@error('email')
											<span class="invalid-feedback" role="alert">
												<strong>{{ $message }}</strong>
											</span>
										@enderror
									</div>
								</div>
								<div class="form-group row mb-0">
									<div class="col-md-12">
										<div class="button-box">
											<button type="submit" class="default-btn floatright">{{ __('Send Password Reset Link') }}</button>
										</div>
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- forgot password -area end -->
@endsection