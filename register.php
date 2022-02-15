<!DOCTYPE html>
<html lang="en">

<head>

	<title>Greeting Card</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<!-- Favicon icon -->
	<link rel="icon" href="./assets/images/favicon.ico" type="image/x-icon">
	<!-- fontawesome icon -->
	<link rel="stylesheet" href="./assets/fonts/fontawesome/css/fontawesome-all.min.css">
	<!-- animation css -->
	<link rel="stylesheet" href="./assets/plugins/animation/css/animate.min.css">
	<!-- vendor css -->
	<link rel="stylesheet" href="./assets/css/style.css">

</head>

<!-- [ auth-signup ] start -->
<div class="auth-wrapper">
	<div class="auth-content container">
		<div class="card">
			<div class="row align-items-center">
				<div class="col-md-6">
					<div class="card-body">
						<h4 class="mb-3 f-w-400">Sign up into your account</h4>
						<form id="register_form">
                            <div class="input-group mb-2">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="feather icon-inbox"></i></span>
                                </div>
                                <input type="text" name="username" class="form-control" placeholder="Username">
                            </div>
                            <div class="input-group mb-2">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="feather icon-lock"></i></span>
                                </div>
                                <input type="password" name="password" class="form-control" placeholder="Password">
                            </div>
                            <div class="input-group mb-2">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="feather icon-user"></i></span>
                                </div>
                                <input type="text" name="displayName" class="form-control" placeholder="Fullname">
                            </div>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="feather icon-mail"></i></span>
                                </div>
                                <input type="email" name="email" class="form-control" placeholder="Email address">
                            </div>
                            
                            <button id="register" class="btn btn-primary mb-4 w-100">Sign up</button>
                        </form>
						<p class="mb-2">Already have an account? <a href="login.php" class="f-w-400">Log in</a></p>
					</div>
				</div>
				<div class="col-md-6 d-none d-md-block">
					<img src="./assets/images/bg_login.webp" alt="" class="img-fluid">
				</div>
			</div>
		</div>
	</div>
</div>
<!-- [ auth-signup ] end -->

<!-- Required Js -->
<script src="./assets/js/vendor-all.min.js"></script>
<script src="./assets/plugins/bootstrap/js/bootstrap.min.js"></script>
<script src="./assets/js/index.js"></script>

<div class="footer-fab">
    <div class="b-bg">
        <i class="fas fa-question"></i>
    </div>
    <div class="fab-hover">
        <ul class="list-unstyled">
            <li><a href="./doc/index-bc-package.html" target="_blank" data-text="UI Kit" class="btn btn-icon btn-rounded btn-info m-0"><i class="feather icon-layers"></i></a></li>
            <li><a href="./doc/index.html" target="_blank" data-text="Document" class="btn btn-icon btn-rounded btn-primary m-0"><i class="feather icon feather icon-book"></i></a></li>
        </ul>
    </div>
</div>

</body>
</html>
