<!DOCTYPE html>
<html lang="tr" class="body-full-height">
<head>
	<!-- META SECTION -->
	<title>Admin Panel - Şifremi Unuttum?</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />

	<link rel="icon" href="<?=base_url()?>assets/img/icons/favicon.ico" type="image/x-icon"/>
	<!-- END META SECTION -->

	<!-- CSS INCLUDE -->
	<link rel="stylesheet" type="text/css" id="theme" href="<?=base_url()?>assets/css/theme-default.css"/>
	<!-- EOF CSS INCLUDE -->
</head>
<body>
<div class="registration-container">
	<div class="registration-box animated fadeInDown">
		<?php $this->view('partical/messages'); ?>
		<div class="registration-body">
			<div class="registration-title"><strong>Şifremi</strong> Unuttum</div>
			<div class="registration-subtitle">Şifrenizi öğrenmek için lütfen kullanıcı adınızı ve size verilen kayıt kodunu giriniz.</div>
			<form action="<?=base_url()?>admin/login/forgot" class="form-horizontal" method="post">
				<h4>Kullanıcı Adınız</h4>
				<div class="form-group">
					<div class="col-md-12">
						<input type="text" name="username" class="form-control" placeholder="Kullanıcı Adınız"/>
					</div>
				</div>
				<h4>Kayıt Kodu</h4>
				<div class="form-group">
					<div class="col-md-12">
						<input type="text" name="reg_code" class="form-control" placeholder="Kayıt Kodu"/>
					</div>
				</div>
				<div class="form-group">
					<div class="col-md-6">
						<button class="btn btn-danger btn-block">Şifremi Gönder</button>
					</div>
				</div>
			</form>
		</div>
		<div class="registration-footer">
			<div class="pull-left">
				&copy; 2016 Admin Panel v16
			</div>
			<div class="pull-right">
				<a href="<?=base_url()?>admin">Panel'e Geri Dön</a>
			</div>
		</div>
	</div>
</div>

</body>
</html>