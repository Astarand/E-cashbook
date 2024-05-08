<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="csrf-token" content="{{ csrf_token() }}" />
        <title>Laravel</title>
		
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
		
		<link rel="stylesheet" href="/css/app.css">
		<!--<link href="/home-assets/css/bootstrap.css" rel="stylesheet" type="text/css">-->
		<link href="/home-assets/css/style.css" rel="stylesheet" type="text/css">
		<link href="/home-assets/css/font-awesome.css" rel="stylesheet" type="text/css">
		
		
        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a href="{{ url('/home') }}">Home</a>
                    @else
                        <a href="{{ route('login') }}">Login</a> | <a href="javascript:void(0);" onClick="openLoginModal();">Login To</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}">Register</a>
                        @endif
                    @endauth
                </div>
            @endif

            <div class="content">
                <div class="title m-b-md">
                    Laravel
                </div>

                <div class="links">
                    <a href="https://laravel.com/docs">Docs</a>
                    <a href="https://laracasts.com">Laracasts</a>
                    <a href="https://laravel-news.com">News</a>
                    <a href="https://blog.laravel.com">Blog</a>
                    <a href="https://nova.laravel.com">Nova</a>
                    <a href="https://forge.laravel.com">Forge</a>
                    <a href="https://vapor.laravel.com">Vapor</a>
                    <a href="https://github.com/laravel/laravel">GitHub</a>
                </div>
            </div>
        </div>
		
		
		
		<!-----------------------------------------------Login Modal----------------------------------------------->
			<div class="modal fade" id="logModal">
					<div class="modal-dialog loginDialog">
						<div class="modal-content loginContent p-5 modalLoginMd">

							<!-- Modal Header -->
							<div class="loginHeadr">
								<h4 class="modal-title pb-2">Sign In</h4>
								<p>New user? <a href="javascript:void(0)" id="registerModalBtn">Create</a> a new account</p>
								<p>Having problem in logging in? <a href="javascript:void(0)" id="forgotPassModalBtn">Click here</a></p>
								<button type="button" class="close" data-dismiss="modal"><i class="fa fa-times"></i></button>
							</div>

							<div class="message-container"></div>

							<!-- Modal body -->
							<div class="loginBody pt-4">                    
								<form name="loginform" id="loginform" method="post">
									<input type="hidden" name="redirect" id="redirect" value="" />
									<div class="login_pnl pb-4">
										<div class="message-container"></div>
										<input type="text" placeholder="Email Address" class="required" name="username" id="username">
										<i class="fa fa-envelope"></i>
									</div>
									<div class="login_pnl pb-4">
										<input type="password" placeholder="Password" name="password" class="required" id="password">
										<i class="fa fa-key"></i>
                                    </div>
                                    <div class="text-center w-100">
                                        <button type="submit" class="btn-login mt-2 mb-4">
                                            <span class="spinner"><i class="fa fa-spinner-third"></i></span>
                                            Login<i class="fa fa-arrow-right"></i>
                                        </button>
                                    </div>
									
									
								</form>
							</div>
						</div>
					</div>
			</div>
			<!-----------------------------------------------Signup Modal----------------------------------------------->
			<div class="modal fade" id="registerModal">
				<div class="modal-dialog loginDialog">
					<div class="modal-content loginContent p-5 modalLoginMd">

						<!-- Modal Header -->
						<div class="loginHeadr">
							<h4 class="modal-title pb-2">Sign Up</h4>
							<p>Existing User? <a href="javascript:void(0)" id="signInBtn">Sign in</a> to Your Account</p>
							<button type="button" class="close" data-dismiss="modal"><i class="fa fa-times"></i></button>
						</div>

						<div class="message-container"></div>
						 @if (Session::has('errors'))
							<div class="alert alert-danger alert-dismissible fade show" role="alert">
								<h4 class="alert-heading">Error!</h4>
								<p>
									<ul>
										@foreach ($errors->all() as $error)
											<li>{{ $error }}</li>
										@endforeach
									</ul>
								</p>

								<button type="button" class="close" data-dismiss="alert" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
						@endif

						<!-- Modal body -->
						<div class="loginBody pt-4">                
							<form action="javascript:void(0)" name="signupform" id="signupform" method="post">
								<input type="hidden" name="redirect_signup" id="redirect_signup" value="" />
								<div class="message-container"></div>
								<div class="row no-gutters">
									<div class="col-12">
										<div class="login_pnl pb-4">
											<input type="text" class="required" placeholder="Your Full Name" name="name" id="full_name" >
											<i class="fa fa-user"></i>
										</div>
									</div>
									
									<div class="col-12">
										<div class="login_pnl pb-4">
											<input type="text" class="required" placeholder="Mobile" name="phone" id="phone">
											<i class="fa fa-phone"></i>
										</div>
									</div>

									<div class="col-12">
										<div class="login_pnl pb-4">
											<input type="text" class="required email" placeholder="Email Address" name="email" id="email_address">
											<i class="fa fa-envelope"></i>
										</div>
									</div>

									<div class="col-12">
										<div class="login_pnl pb-4">
											<input type="password" placeholder="Password" name="Password" id="Password">
											<i class="fa fa-key"></i>
										</div>
									</div>
									<div class="col-12">
										<div class="login_pnl pb-4">
											<input type="password" placeholder="Confirm Password" name="Confirm_Password" id="Confirm_Password">
											<i class="fa fa-key"></i>
										</div>
									</div>
									<div class="col-12">
										<div class="login_pnl pb-4">
											<select name="u_type" id="u_type">
											<option value="">--select--</option>
											<option value="2">Buyer</option>
											<option value="3">Seller</option>
											</select>
											
										</div>
									</div>
									   
									<div class="col-12 text-center">
										<button type="submit" class="btn-login mt-2">
											<span class="spinner"><i class="fa fa-spinner-third"></i></span>
											Sign Up<i class="fa fa-arrow-right"></i>
										</button>
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
			
			 <!-----------------------------------------------Forgot Password Modal----------------------------------------------->
				<div class="modal fade" id="forgotPassModal">
					<div class="modal-dialog loginDialog">
						<div class="modal-content loginContent p-5 modalLoginMd">

							<!-- Modal Header -->
							<div class="loginHeadr">
								<h4 class="modal-title pb-2">Forgot Password?</h4>
								<p>Enter email address to reset the password</p>
								<button type="button" class="close" data-dismiss="modal"><i class="fa fa-times"></i></button>
							</div>

							<!-- Modal body -->
							<div class="loginBody pt-4">
								<form name="forgot_password" id="forgot_password">
									<div class="login_pnl pb-4">
										<div class="message-container"></div>
										<input type="email" id="forget_email" name="forget_email" class="required email" placeholder="Your Email Address">
										<i class="fa fa-envelope"></i>
                                    </div>
                                    <div class="text-center w-100">
                                    <button type="submit" class="btn-login mt-2">
										<span class="spinner"><i class="fa fa-spinner-third"></i></span>
										Reset<i class="fa fa-arrow-right"></i>
									</button>
                                    </div>
									
								</form>
							</div>
						</div>
					</div>
				</div>
				
			
    
				<input type="hidden" id="base_url" value="">
		
		
		
		
		
		
    </body>
</html>

		<!--<script src="/js/app.js"></script>-->
		<script src="/home-assets/js/jquery-3.3.1.min.js"></script>
		<script src="/js/app.js"></script>
		 <!--<script src="/home-assets/js/bootstrap.js"></script>-->
		 <script src="/home-assets/js/jquery.validate.js"></script>
		 <script src="/home-assets/js/custom.js"></script>
		 
 <script>
 
 </script>
