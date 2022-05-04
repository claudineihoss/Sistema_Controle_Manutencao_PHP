<!DOCTYPE html>
<html lang="en">
<head>
	<title>Manutenção Reafrio</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	
	<head>
		<link rel="icon" href="<?php echo base_url('img/logo.png');?>" type="image/x-icon">
	</head>

	<link href="<?php echo base_url('login/vendor/bootstrap/css/bootstrap.min.css');?>" rel="stylesheet">
	<link href="<?php echo base_url('login/fonts/font-awesome-4.7.0/css/font-awesome.min.css');?>" rel="stylesheet">
	<link href="<?php echo base_url('login/fonts/iconic/css/material-design-iconic-font.min.css');?>" rel="stylesheet">
	<link href="<?php echo base_url('login/vendor/animate/animate.css');?>" rel="stylesheet">
	<link href="<?php echo base_url('login/vendor/css-hamburgers/hamburgers.min.css');?>" rel="stylesheet">
	<link href="<?php echo base_url('login/vendor/animsition/css/animsition.min.css');?>" rel="stylesheet">
	<link href="<?php echo base_url('login/vendor/select2/select2.min.css');?>" rel="stylesheet">	
	<link href="<?php echo base_url('login/vendor/daterangepicker/daterangepicker.css');?>" rel="stylesheet">
	<link href="<?php echo base_url('login/css/util.css');?>" rel="stylesheet">	
	<link href="<?php echo base_url('login/css/main.css');?>" rel="stylesheet">	
</head>
<body>
	
	<div class="limiter">
		<div class="container-login100" style="background-image: url(<?php echo base_url('img/bg-login.png'); ?>); background-color: transparent;
		position: inherit;">
		<div class="wrap-login100">
			<form class="login100-form validate-form" action="<?php echo site_url("autenticar/autentica") ?>" method="POST">
				<img id="profile-img"  src="<?php echo base_url('img/logo.png'); ?>" style="width: 50%;transform: translate(50%, 0px);left: -50%;">
			</span>
			<span class="login100-form-title p-b-34 p-t-15"></span>
			<div class="wrap-input100 validate-input" data-validate = "Informe seu Usuario">
				<input class="input100" type="text" name="login" placeholder="Usuario" required autofocus>
				<!-- <span class="focus-input100" data-placeholder="&#xf207;"></span> -->
				<span class="focus-input100"><img src="img/user.svg" style="width: auto; max-width: 25px; max-height: 25px;"></span>				
			</div>

			<div class="wrap-input100 validate-input" data-validate="Informe sua Senha">
				<input class="input100" type="password" name="senha" placeholder="Senha" required>
				<!-- <span class="focus-input100" data-placeholder="&#xf191;"></span> -->
				<span class="focus-input100"><img src="img/password.png" style="margin-left: 7px;width: auto; max-width: 25px; max-height: 25px;"></span>				
			</div>

			<div class="contact100-form-checkbox">
				<input class="input-checkbox100" id="ckb1" type="checkbox" name="remember-me">
				<label class="label-checkbox100" for="ckb1">
					Me lembre
				</label>
			</div>
			<div class="container-login100-form-btn">
				<button class="login100-form-btn" type="submit">
					Acessar
				</button>
			</div>

			<div class="text-center p-t-90">
			</div>
		</form>
	</div>

	

</div>
</div>


<div id="dropDownSelect1"></div>

<script src="<? echo base_url('login/vendor/jquery/jquery-3.2.1.min.js') ?>"></script>
<script src="<? echo base_url('login/vendor/animsition/js/animsition.min.js') ?>"></script>
<script src="<? echo base_url('login/vendor/bootstrap/js/popper.js') ?>"></script>
<script src="<? echo base_url('login/vendor/bootstrap/js/bootstrap.min.js') ?>"></script>
<script src="<? echo base_url('login/vendor/select2/select2.min.js') ?>"></script>
<script src="<? echo base_url('login/vendor/daterangepicker/moment.min.js') ?>"></script>
<script src="<? echo base_url('login/vendor/daterangepicker/daterangepicker.js') ?>"></script>
<script src="<? echo base_url('login/vendor/countdowntime/countdowntime.js') ?>"></script>
<script src="<? echo base_url('login/js/main.js') ?>"></script>

</body>
</html>