<!DOCTYPE html>
<html lang="tr" class="body-full-height">
<head>
	<!-- META SECTION -->
	<title>Admin Panel v16</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<meta http-equiv="X-UA-Compatible" content="IE=edge"/>
	<meta name="viewport" content="width=device-width, initial-scale=1"/>

	<link rel="icon" href="<?=base_url()?>assets/img/icons/favicon.ico" type="image/x-icon"/>
	<!-- END META SECTION -->

	<!-- CSS INCLUDE -->
	<link rel="stylesheet" type="text/css" id="theme" href="<?php echo base_url()?>assets/css/theme-default.css"/>
	<!-- EOF CSS INCLUDE -->
</head>
<body>

<div class="login-container login-v2">
	<div class="login-box animated fadeInDown">
		<div class="login-body">
			<div class="login-title"><strong>Merhaba</strong>, Lütfen giriş yapınız.</div>
			<?php $this->view('partical/messages'); ?>
			<form action="<?php echo base_url()?>admin/login/doLogin" class="form-horizontal" method="post">
				<div class="form-group">
					<div class="col-md-12">
						<div class="input-group">
							<div class="input-group-addon">
								<span class="fa fa-user"></span>
							</div>
							<input type="text" name="username" class="form-control" placeholder="Kullanıcı Adı" autofocus/>
						</div>
					</div>
				</div>
				<div class="form-group">
					<div class="col-md-12">
						<div class="input-group">
							<div class="input-group-addon">
								<span class="fa fa-lock"></span>
							</div>
							<input type="password" name="password" class="form-control" placeholder="Şifre"/>
						</div>
					</div>
				</div>
				<div class="form-group">
					<div class="col-md-6">
						<a href="<?=base_url()?>admin/forgot_password">Şifremi Unuttum?</a>
					</div>
				</div>
				<div class="form-group">
					<div class="col-md-12">
						<button class="btn btn-primary btn-lg btn-block">Giriş Yap</button>
					</div>
				</div>
			</form>
		</div>
	</div>

</div>

</body>
</html>