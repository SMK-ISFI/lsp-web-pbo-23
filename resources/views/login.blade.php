<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" type="text/css" href="/assets/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="/assets/css/util.css">
	<link rel="stylesheet" type="text/css" href="/assets/css/main.css">
</head>
<body style="background-color: #666666;">

  <div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				<form action="/login-proses" method="POST" class="login100-form validate-form">
					@csrf
					<span class="login100-form-title p-b-43">
						Login Member
					</span>
					
					@if (session()->has('loginError'))
					<div class="alert alert-danger alert-dismissible fade show" role="alert">
						{{ session('loginError') }}
						<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
					</div>
					@endif
					
					<div class="wrap-input100 validate-input" data-validate = "Valid email is required: ex@abc.xyz">
						<input class="input100" type="text" id="email" name="email" required>
						<span class="focus-input100"></span>
						<span class="label-input100">Email</span>
					</div>
					@error('email')
            <small class="text-danger"> {{ $message }} </small>
          @enderror
					
					<div class="wrap-input100 validate-input" data-validate="Password is required">
						<input class="input100" type="password" id="password" name="password" required>
						<span class="focus-input100"></span>
						<span class="label-input100">Password</span>
          </div>
					@error('password')
            <small class="text-danger"> {{ $message }} </small>
          @enderror

					<div class="container-login100-form-btn">
						<button class="login100-form-btn" type="submit">
							Login
						</button>
					</div>
					
					<div class="text-center p-t-46 p-b-20">
						<span class="txt2">
							Belum punya akun? <a href="/register">Daftar</a>
						</span>
					</div>
				</form>

				<div class="login100-more" style="background-image: url('/assets/images/bg-01.jpg');">
				</div>
			</div>
		</div>
	</div>

  <script src="/assets/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="/assetsjs/main.js"></script>
</body>
</html>