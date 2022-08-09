<x-admin-guest-layout>
	<div class="section-authentication-signin d-flex align-items-center justify-content-center my-5 my-lg-0">
		<div class="container-fluid">
			<div class="row row-cols-1 row-cols-lg-2 row-cols-xl-3">
				<div class="col mx-auto">
					<div class="mb-4 text-center d-flex justify-content-center">
						<x-jet-authentication-card-logo />
					</div>
					<div class="card">
						<div class="card-body">
							<div class="border p-4 rounded">
								<div class="text-center">
									<h3 class="">Sign in</h3>
								</div>
								<div class="login-separater text-center">
									<span>SIGN IN WITH EMAIL</span>
								</div>

								<x-jet-validation-errors class="mb-4 text-danger" />

								@if (session('status'))
									<div class="mb-4 font-medium text-sm text-success">
										{{ session('status') }}
									</div>
								@endif
								
								<div class="form-body">
									<form class="row g-3" method="POST" action="{{ route('admin.login') }}">
										@csrf
										<div class="col-12">
											<label for="email" class="form-label">Email Address</label>
											<input type="email" class="form-control" id="email" name="email" value="{{old('email')}}" placeholder="Email Address" required autofocus>
										</div>
										<div class="col-12">
											<label for="password" class="form-label">Enter Password</label>
											<div class="input-group" id="show_hide_password">
												<input type="password" name="password" class="form-control border-end-0" id="password" placeholder="Enter Password" required> <a href="javascript:void(0);" class="input-group-text bg-transparent"><i class='bx bx-hide'></i></a>
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-check form-switch">
												<input name="remember" class="form-check-input" type="checkbox" id="flexSwitchCheckChecked">
												<label class="form-check-label" for="flexSwitchCheckChecked">Remember Me</label>
											</div>
										</div>
										<div class="col-md-6 text-end">	<a href="{{ route('admin.password.request') }}">Forgot Password ?</a>
										</div>
										<div class="col-12">
											<div class="d-grid">
												<button type="submit" class="btn btn-primary"><i class="bx bxs-lock-open"></i>Sign in</button>
											</div>
										</div>
									</form>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!--end row-->
		</div>
	</div>
</x-admin-guest-layout>