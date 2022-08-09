<x-admin-guest-layout>
	<div class="authentication-forgot d-flex flex-column align-items-center justify-content-center">
		<div class="mb-4 text-center d-flex justify-content-center">
			<x-jet-authentication-card-logo />
		</div>
		<div class="card forgot-box">
			<div class="card-body">
				<div class="p-4 rounded border">
					<div class="text-center mb-4">
						<img src="{{ asset('assets/images/icons/forgot-2.png') }}" width="80" alt="" />
					</div>
					<h4 class="font-weight-bold">Forgot Password?</h4>
					<p class="text-muted">Enter your registered email ID to reset the password</p>

					<div class="login-separater text-center">
						<span>ENTER YOUR EMAIL</span>
					</div>

					@if (session('status'))
						<div class="mb-4 font-medium text-sm text-success">
							{{ session('status') }}
						</div>
					@endif

        			<x-jet-validation-errors class="mb-4 text-danger" />

					<form action="{{ route('admin.password.email') }}" method="post">
						@csrf
						<div class="my-3">
							<label class="form-label">Email id</label>
							<input type="text" name="email" class="form-control form-control" placeholder="example@user.com" required autofocus />
						</div>
						<div class="d-grid gap-2">
							<button type="submit" class="btn btn-primary">Send</button>
						</div>
					</form>
					<div class="text-center my-2">
						<a href="{{ route('admin.loginForm') }}" class="btn btn-light"><i class='bx bx-arrow-back mr-1'></i>Back to Login</a>
					</div>
				</div>
			</div>
		</div>
	</div>
</x-admin-guest-layout>