@extends('layouts.login-layout')

@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="">
				<div class="">
					@if (count($errors) > 0)
						<div class="alert alert-danger">
							<ul>
								@foreach ($errors->all() as $error)
									<!-- <li>User email and Password doesn't match.</li> -->

									<center><h4>Email or Password isn't correct.</h4></center>
									<!-- <p>
										It looks like you entered a slight misspelling of your email or username. We've corrected it for you, but ask that you re-enter your password for added security.
									</p> -->
								@endforeach
							</ul>
						</div>
					@endif

					<form class="form-horizontal" role="form" method="POST" action="{{ Route('login') }}">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">

						<div class="form-group">
							<label class="col-md-4 control-label">{{ trans('others.enter_email_address') }}</label>
							<div class="col-md-6">
								<input type="email" class="form-control" name="email" value="{{ old('email') }}">
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label">{{ trans('others.enter_password') }}</label>
							<div class="col-md-6">
								<input type="password" class="form-control" name="password">
							</div>
						</div>

						<div class="form-group">
							<div class="col-md-6 col-md-offset-4">
								<div class="checkbox">
									<label>
										<input type="checkbox" name="remember">
										{{ trans('others.login_rememberme_label') }}
									</label>
								</div>
							</div>
						</div>

						<div class="col-md-6 col-md-offset-4 text-center">
			                <button type="submit" class="btn btn-danger btn-block btn-flat">{{ trans('others.login_label') }}
			                </button>
			            </div>
						
					{{-- 	<div class="form-group">
							<div class="col-md-8 col-md-offset-4">
								<button type="submit" class="btn btn-primary" style="margin-right: 15px;">
									{{ trans('others.login_label') }}
								</button>

								<!-- <a href="/password/email">{{ trans('others.forgot_your_password') }}</a> -->
							</div>
						</div> --}}
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
