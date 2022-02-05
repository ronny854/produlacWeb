<!DOCTYPE html>
<html lang="en">
<head>
	<title>Login</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
<link rel="shortcut icon" href="<?php echo base_url()."/public/logo.png" ?>">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href=<?php echo base_url()."/public/assets/vendor/bootstrap/css/bootstrap.min.css"?>>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href=<?php echo base_url()."/public/assets/fonts/font-awesome-4.7.0/css/font-awesome.min.css"?>>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href=<?php echo base_url()."/public/assets/fonts/iconic/css/material-design-iconic-font.min.css"?>>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href=<?php echo base_url()."/public/assets/vendor/animate/animate.css"?>>
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href=<?php echo base_url()."/public/assets/vendor/css-hamburgers/hamburgers.min.css"?>>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href=<?php echo base_url()."/public/assets/vendor/animsition/css/animsition.min.css"?>>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href=<?php echo base_url()."/public/assets/vendor/select2/select2.min.css"?>>
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href=<?php echo base_url()."/public/assets/vendor/daterangepicker/daterangepicker.css"?>>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href=<?php echo base_url()."/public/assets/css/util.css"?>>
	<link rel="stylesheet" type="text/css" href=<?php echo base_url()."/public/assets/css/main.css"?>>
<!--===============================================================================================-->
</head>
<body>
	
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				<form class="login100-form validate-form" action="<?php echo base_url('/DashboardController') ?>" method="POST">
					<span class="login100-form-title p-b-26">
						Bienvenido a 
					</span>
<!-- 					<span class="login100-form-title p-b-48">
						<i class="zmdi zmdi-font"></i>
					</span> -->
                    <img src=<?php echo base_url()."/public/assets/images/produlac.png"?> width="300" height="150" class="login100-form-title p-b-48">
					<div class="wrap-input100 validate-input" data-validate = "Valid email is: a@b.c">
						<input class="input100" type="text" name="usuario" id="usuario">
						<span class="focus-input100" data-placeholder="Usuario"></span>
					</div>

					<div class="wrap-input100 validate-input" data-validate="Enter password">
						<span class="btn-show-pass">
							<i class="zmdi zmdi-eye"></i>
						</span>
						<input class="input100" type="password" name="pass" id="pass">
						<span class="focus-input100" data-placeholder="Contraseña"></span>
					</div>

					<div class="container-login100-form-btn">
						<div class="wrap-login100-form-btn">
							<div class="login100-form-bgbtn"></div>
							<button class="login100-form-btn" type="submit">
								Iniciar Sesión
							</button>
							<!-- <input type="submit" value="Iniciar Sesión" onclick = "location= '<?php echo base_url()?>/dashboard'"/> -->
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
	

	<div id="dropDownSelect1"></div>
	
<!--===============================================================================================-->
	<script src=<?php echo base_url()."/public/assets/vendor/jquery/jquery-3.2.1.min.js"?>></script>
<!--===============================================================================================-->
	<script src=<?php echo base_url()."/public/assets/vendor/animsition/js/animsition.min.js"?>></script>
<!--===============================================================================================-->
	<script src=<?php echo base_url()."/public/vendor/bootstrap/js/popper.js"?>></script>
	<script src=<?php echo base_url()."/public/assets/vendor/bootstrap/js/bootstrap.min.js"?>></script>
<!--===============================================================================================-->
	<script src=<?php echo base_url()."/public/assets/vendor/select2/select2.min.js"?>></script>
<!--===============================================================================================-->
	<script src=<?php echo base_url()."/public/assets/vendor/daterangepicker/moment.min.js"?>></script>
	<script src=<?php echo base_url()."/public/assets/vendor/daterangepicker/daterangepicker.js"?>></script>
<!--===============================================================================================-->
	<script src=<?php echo base_url()."/public/assets/vendor/countdowntime/countdowntime.js"?>></script>
<!--===============================================================================================-->
	<script src=<?php echo base_url()."/public/assets/js/main.js"?>></script>

</body>
</html>