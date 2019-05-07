<?php if ($this->input->get('action') == 'success') { ?>
	<!-- Success Message  -->
	<div class="col-md-12">
		<div class="alert alert-success" role="alert">
			<button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">×</span><span
					class="sr-only">Close</span></button>
			<strong>Başarılı!</strong> İşlem başarıyla tamamlanmıştır.
		</div>
	</div>
	<!-- // Success Message  -->
<?php } ?>
<?php if ($this->input->get('action') == 'error') { ?>
	<!-- Error Message  -->
	<div class="col-md-12">
		<div class="alert alert-danger" role="alert">
			<button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">×</span><span
					class="sr-only">Close</span></button>
			<strong>Hata!</strong> Yapılan işlemde hata oluştu. Lütfen tekrar deneyiniz.
		</div>
	</div>
	<!-- // Error Message  -->
<?php } ?>
<?php if ($this->input->get('login') == 'first_time') { ?>
	<!-- First time Admin Message  -->
	<div class="col-md-12">
		<div class="alert alert-danger" role="alert">
			<button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">×</span><span
					class="sr-only">Close</span></button>
			<strong>Dikkat!</strong> İlk kullanımda güvenliğiniz için <strong>Admin</strong> şifrenizi değiştirmeniz
			gerekmektedir.
		</div>
	</div>
	<!-- Firsttime Admin Message  -->
<?php } ?>
<?php if ($this->input->get('login') == 'false') { ?>
	<!-- Username Password Blank Error Message  -->
	<div class="alert alert-danger" role="alert">
		<button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">×</span><span
				class="sr-only">Kapat</span></button>
		<strong>HATA!</strong> Lütfen kullanıcı adı ve şifrenizi giriniz.
	</div>
	<!-- // Username Password Blank Error Message  -->
<?php } ?>
<?php if ($this->input->get('login') == 'incorrect') { ?>
	<!-- Username Password Error Message  -->
	<div class="alert alert-danger" role="alert">
		<button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">×</span><span
				class="sr-only">Kapat</span></button>
		<strong>HATA!</strong> Lütfen kullanıcı adı ve şifrenizi kontrol ediniz.
	</div>
	<!-- // Username Password Error Message  -->
<?php } ?>
<?php if ($this->input->get('action') == 'senduser') { ?>
	<!-- Forgot Password Success Message  -->
	<div class="col-md-12">
		<div class="alert alert-success" role="alert">
			<button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">×</span><span
					class="sr-only">Close</span></button>
			<strong>Başarılı!</strong> Sisteme Kayıtlı Olan Şifreniz Gönderilmiştir.
		</div>
	</div>
	<!-- // Forgot Password Error Message  -->
<?php } ?>
<?php if ($this->input->get('action') == 'notfound') { ?>
	<!-- Forgot Password Error Message  -->
	<div class="alert alert-danger" role="alert">
		<button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">×</span><span
				class="sr-only">Kapat</span></button>
		<strong>HATA!</strong> Kullanıcı Adınızı veya Kayıt Kodunuzu Kontrol Ediniz.
	</div>
	<!-- // Forgot Password Error Message  -->
<?php } ?>
<?php if ($this->input->get('action') == 'notdelete') { ?>
	<!-- Forgot Password Error Message  -->
	<div class="col-md-12">
		<div class="alert alert-danger" role="alert">
			<button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">×</span><span
					class="sr-only">Kapat</span></button>
			<strong>HATA!</strong> Silmek istediğiniz bazı bölümler fotoğraf içermektedir. Lütfen fotoğrafları silip tekrar deneyiniz.
		</div>
	</div>
	<!-- // Forgot Password Error Message  -->
<?php } ?>
