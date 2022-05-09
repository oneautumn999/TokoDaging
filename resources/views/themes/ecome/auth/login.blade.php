@extends('themes.ecome.layout')

@section('content')
<section class="breadcrumb-section pb-4 pt-8">
    <div class="container">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Login</li>
        </ol>
    </div>
</section>
<!-- login-area start -->
<section class="register-area ptb-100">
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-12 col-12 col-lg-12 col-xl-6 ml-auto mr-auto">
				<div class="login">
					<div class="login-form-container">
						<div class="login-form">
							<form method="POST" action="{{ route('login') }}">
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
								<div class="form-group row">
									<div class="col-md-12">
										<input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="{{ __('Password') }}">
										@error('password')
											<span class="invalid-feedback" role="alert">
												<strong>{{ $message }}</strong>
											</span>
										@enderror
									</div>
								</div>
								<div class="form-group row mb-0">
									<div class="col-md-12">
										<div class="button-box">
                                            <div class="login-toggle-btn">
                                                <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                                <label for="remember">{{ __('Remember Me') }}</label>
                                                <a href="{{ route('password.request') }}">{{ __('Forgot Your Password?') }}</a>
                                            </div>
                                            <button type="submit" class="default-btn floatright">Login</button>
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
</section>
<!-- login-area end -->
@endsection