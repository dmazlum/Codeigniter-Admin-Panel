<!-- PAGE CONTENT -->
<div class="page-content">

	<?php vertical_menu(); ?>

	<!-- START BREADCRUMB -->
	<ul class="breadcrumb">
		<li><a href="#">Ayarlar</a></li>
		<li class="active">Genel Site Ayarları</li>
	</ul>
	<!-- END BREADCRUMB -->

	<div class="page-title">
		<h2>Genel Site Ayarları</h2>
	</div>

	<!-- PAGE CONTENT WRAPPER -->
	<div class="page-content-wrap">
		<?php $this->view('partical/messages'); ?>

		<div class="row">
		<div class="col-md-12">

			<form role="form" class="form-horizontal" action="<?php echo base_url()?>admin/setup/update" method="post">
				<div class="panel panel-default tabs">
					<ul class="nav nav-tabs" role="tablist">
						<li class="active"><a href="#tab-first" role="tab" data-toggle="tab">Site Ayarları</a></li>
						<li><a href="#tab-second" role="tab" data-toggle="tab">İletişim Bilgileri</a></li>
						<li><a href="#tab-third" role="tab" data-toggle="tab">Analiz Verileri</a></li>
						<li><a href="#tab-fourth" role="tab" data-toggle="tab">E-Mail Gönderim Ayarları</a></li>
					</ul>
					<div class="panel-body tab-content">
						<div class="tab-pane active" id="tab-first">
							<p>Burada site genel ayarlarını yapabilirsiniz. <strong>Site Kayıt Kodu</strong>'nu şifre sıfırlama isteği durumunda kullanabilirsiniz.</p>
								<?php
									foreach ($site_config as $config) {
									if ($config['config_section'] == 's' && $config['config_name'] != 'site_close') {
								?>
								<div class="form-group">
									<label class="col-md-3 control-label"><?=$config['config_label']?></label>
									<div class="col-md-4">
										<input type="<?=$config['config_input_type'];?>"
										       name="<?=$config['config_name']?>"
										       class="form-control"
										       value="<?=$config['config_value']?>"
										       placeholder="<?php echo ($config['config_help_text'] == '') ? $config['config_label'] : $config['config_help_text'];?>"
											<?php echo ($config['config_name'] == 'site_reg_code') ? 'disabled="disabled"' : '';?>"/>
									</div>
								</div>
							   <?php } ?>
								<?php if($config['config_name'] == 'site_close') { ?>
											<div class="form-group">
												<label class="col-md-3 control-label">Siteyi Kapat </label>
												<div class="col-md-1">
													<label class="switch">
														<input type="checkbox"
														       id="site_close"
														       name="<?=$config['config_name']?>"
														       value="<?=$config['config_value']?>"
														<?=($config['config_value'] == '1') ? 'checked': '';?>>
														<span></span>
													</label>
												</div>
											</div>
								<?php } } ?>
						</div>
						<div class="tab-pane" id="tab-second">
							<p>Site iletişim bilgilerini güncelleyebilirsiniz.</p>
							<?php
								foreach ($site_config as $config) {
								if ($config['config_section'] == 'c') {
							?>
								<div class="form-group">
									<label class="col-md-3 control-label"><?=$config['config_label']?></label>
									<div class="col-md-4">
										<?php if ($config['config_input_type'] == 'textarea') { ?>
										<textarea
											name="<?=$config['config_name']?>"
											class="form-control"
											rows="5"
											placeholder="<?php echo ($config['config_help_text'] == '') ? $config['config_label'] : $config['config_help_text'];?>"><?=$config['config_value']?></textarea>
										<?php } else { ?>
										<input type="<?=$config['config_input_type'];?>"
										       name="<?=$config['config_name']?>"
										       class="form-control"
										       value="<?=$config['config_value']?>"
										       placeholder="<?php echo ($config['config_help_text'] == '') ? $config['config_label'] : $config['config_help_text'];?>"/>
										<?php } ?>
									</div>
								</div>
							<?php } } ?>
								<!--<div class="btn-group">
									<button class="btn btn-danger" type="submit">Yeni Adres Ekle</button>
								</div>-->
						</div>
						<div class="tab-pane" id="tab-third">
							<p>Site analiz bilgilerini buradan güncelleyebilirsiniz.</p>
							<?php
								foreach ($site_config as $config) {
									if ($config['config_section'] == 'a') {
										?>
										<div class="form-group">
											<label class="col-md-3 control-label"><?=$config['config_label']?></label>
											<div class="col-md-4">
												<?php if ($config['config_input_type'] == 'textarea') { ?>
													<textarea name="<?=$config['config_name']?>"
													          class="form-control"
													          rows="5"
													          placeholder="<?php echo ($config['config_help_text'] == '') ? $config['config_label'] : $config['config_help_text'];?>"><?=$config['config_value']?></textarea>
												<?php } else { ?>
													<input type="<?=$config['config_input_type'];?>"
													       name="<?=$config['config_name']?>"
													       class="form-control"
													       value="<?=$config['config_value']?>"
													       placeholder="<?php echo ($config['config_help_text'] == '') ? $config['config_label'] : $config['config_help_text'];?>"/>
												<?php } ?>
											</div>
										</div>
									<?php } } ?>
						</div>
						<div class="tab-pane" id="tab-fourth">
							<p>Site E-mail gönderim ayarlarını buradan güncelleyebilirsiniz.</p>
							<?php
								foreach ($site_config as $config) {
									if ($config['config_section'] == 'm') {
										?>
										<div class="form-group">
											<label class="col-md-3 control-label"><?=$config['config_label']?></label>
											<div class="col-md-4">
												<?php if ($config['config_input_type'] == 'textarea') { ?>
													<textarea name="<?=$config['config_name']?>"
													          class="form-control"
													          rows="5"
													          placeholder="<?php echo ($config['config_help_text'] == '') ? $config['config_label'] : $config['config_help_text'];?>"><?=$config['config_value']?></textarea>
												<?php } else { ?>
													<input type="<?=$config['config_input_type'];?>"
													       name="<?=$config['config_name']?>"
													       class="form-control"
													       value="<?=$config['config_value']?>"
													       placeholder="<?php echo ($config['config_help_text'] == '') ? $config['config_label'] : $config['config_help_text'];?>"/>
												<?php } ?>
											</div>
										</div>
									<?php } } ?>
						</div>
					</div>
					<div class="panel-footer">
						<button class="btn btn-primary pull-right">Ayarları Kaydet <span class="fa fa-floppy-o fa-right"></span></button>
					</div>
				</div>

			</form>

		</div>
	</div>

		</div>
	</div>
	<!-- END PAGE CONTENT WRAPPER -->
</div>
<!-- END PAGE CONTENT -->