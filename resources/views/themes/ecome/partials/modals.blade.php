<!-- modal -->
<div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-hidden="true">
	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
		<span class="pe-7s-close" aria-hidden="true" style="cursor: pointer;"></span>
	</button>
	<div class="modal-dialog" role="document" style="margin: 150px auto;">
		<div class="modal-content">
			<div class="modal-body">
				<div class="login">
					<div class="login-form-container" style="width:400px">
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
												<a href="{{ route('password.request') }}">{{ __('Forgot Password?') }}</a>
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
</div>