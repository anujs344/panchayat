<x-admin-guest-layout>
	<div class="authentication-reset-password d-flex flex-column align-items-center justify-content-center">
		<div class="d-flex justify-content-center pb-3">
			<x-jet-authentication-card-logo />
		</div>
		<div class="card">
			<div class="card-body">
				<div class="p-4 rounded border">
					<h4 class="font-weight-bold">Genrate New Password</h4>
					<p class="text-muted">We received your reset password request. Please enter your new password!</p>

					<div class="login-separater text-center">
						<span>CREATE NEW PASSWORD</span>
					</div>

					<x-jet-validation-errors class="mb-4 text-danger" />

					<form method="POST" action="{{ route('admin.password.update') }}">
						@csrf
						<input type="hidden" name="token" value="{{ request()->token }}">
						<div class="mb-3">
							<label class="form-label">Email</label>
							<input type="email" name="email" class="form-control" placeholder="Enter new password" value="{{request()->email}}" />
						</div>
						<div class="mb-3">
							<label class="form-label">New Password</label>
							<div class="input-group" id="show_hide_password">
								<input type="password" name="password" class="form-control border-end-0" id="password" placeholder="Enter new password" required autofocus>
								<a href="javascript:void(0);" class="input-group-text bg-transparent">
									<i class='bx bx-hide'></i>
								</a>
							</div>
						</div>
						<div class="mb-3">
							<label class="form-label">Confirm Password</label>
							<input type="password" name="password_confirmation" class="form-control" placeholder="Confirm password" required />
						</div>
						<div class="d-grid gap-2">
							<button type="submit" class="btn btn-primary">Change Password</button>
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