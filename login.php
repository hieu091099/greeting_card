<?php 
    require("function.php");
	if(checkLogin()){
		header('Location: index.php');	
	}
?>
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

<!-- [ auth-signin ] start -->
<div class="auth-wrapper">
	<div class="auth-content container">
		<div class="card">
			<div class="row align-items-center">
				<div class="col-md-6">
					<div class="card-body">
						<h4 class="mb-3 f-w-400">Login into your account</h4>
						<form  id="login_form">
						<div class="input-group mb-2">
							<div class="input-group-prepend">
								<span class="input-group-text"><i class="feather icon-server"></i></span>
							</div>
							<input type="text" name="username"  class="form-control" placeholder="Username">
						</div>
						<div class="input-group mb-3">
							<div class="input-group-prepend">
								<span class="input-group-text"><i class="feather icon-lock"></i></span>
							</div>
							<input type="password" name="password" style="display:block" class="form-control" placeholder="Password">
						</div>
						
						<div class="form-group text-left mt-2">
							<div class="checkbox checkbox-primary d-inline">
								<input type="checkbox"  name="checkbox-fill-1" id="checkbox-fill-a1" checked="">
								<label for="checkbox-fill-a1" class="cr"> Save credentials</label>
							</div>
						</div>
						<p class="mb-0 text-muted">Don’t have an account? <a href="register.php" class="f-w-400">Signup</a></p>
						<button id="login" class="btn btn-primary mb-4 w-100">Login</button>
						</form>
					</div>
				</div>
				<div class="col-md-6 d-none d-md-block">
					<img src="./assets/images/bg_login.webp" alt="" class="img-fluid">
				</div>
			</div>
		</div>
	</div>
</div>
<!-- [ auth-signin ] end -->

<!-- Required Js -->
<script src="./assets/js/vendor-all.min.js"></script>
<script src="assets/DataTables/datatables.min.js"></script>
<script src="./assets/plugins/bootstrap/js/bootstrap.min.js"></script>
<script src="./assets/js/index.js"></script>
<script src="./assets/js/jquery.validate.min.js"></script>
<div class="footer-fab">
    <div class="b-bg">
        <i class="fas fa-question"></i>
    </div>
    <div class="fab-hover">
        <ul class="list-unstyled">
            <!-- <li><a href="./doc/index-bc-package.html" target="_blank" data-text="UI Kit" class="btn btn-icon btn-rounded btn-info m-0"><i class="feather icon-layers"></i></a></li> -->
            <li><a href="./doc/index.html" target="_blank" data-text="Document" class="btn btn-icon btn-rounded btn-primary m-0"><i class="feather icon feather icon-book"></i></a></li>
        </ul>
    </div>
</div>


</body>

</html>
