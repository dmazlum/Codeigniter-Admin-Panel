<?php
	if (!empty($sliderById[0])) {
		$galleryData = $sliderById[0];
		$formUrl = 'editSliderData/' . $galleryData['id'];
		$buttonName = 'Güncelle';
		$validateClass = '';
		$helpText = '/ <strong>Güncelleme yoksa boş bırakınız</strong>';
	} else {
		$formUrl = 'addSliderData';
		$buttonName = 'Ekle';
		$validateClass = 'validate[required]';
		$helpText = '';
	}
?>
<!-- BLUEIMP GALLERY -->
<div id="blueimp-gallery" class="blueimp-gallery blueimp-gallery-controls">
	<div class="slides"></div>
	<h3 class="title"></h3>
	<a class="prev">‹</a>
	<a class="next">›</a>
	<a class="close">×</a>
	<a class="play-pause"></a>
	<ol class="indicator"></ol>
</div>
<!-- END BLUEIMP GALLERY -->

<!-- PAGE CONTENT -->
<div class="page-content">

	<?php vertical_menu(); ?>

	<!-- START BREADCRUMB -->
	<ul class="breadcrumb">
		<li><a href="#">Galeri</a></li>
		<li class="active">Slider Ekle</li>
	</ul>
	<!-- END BREADCRUMB -->

	<div class="page-title">
		<h2>Slider Ekle</h2>
	</div>

	<!-- PAGE CONTENT WRAPPER -->
	<div class="page-content-wrap">

		<?php $this->view('partical/messages'); ?>

		<div class="col-md-12">

			<div class="panel panel-default">
				<div class="panel-body">

					<div class="col-md-6">
						<form id="validate" role="form" class="form-horizontal"
						      action="<?php echo base_url() ?>admin/co_gallery/<?= $formUrl ?>" method="post"
						      enctype="multipart/form-data">
							<div class="form-group">
								<label class="col-md-3 control-label">Ana Başlık</label>
								<div class="col-md-9">
									<input type="text" name="section_name" class="form-control"
									       placeholder="Ana Başlık" value="<?= @$galleryData['section_name'] ?>"/>
								</div>
							</div>
							<div class="form-group">
								<label class="col-md-3 control-label">Kısa Açıklama</label>
								<div class="col-md-9">
									<textarea name="section_desc" class="form-control" rows="3"
									          placeholder="Kısa Açıklama"><?= @$galleryData['section_desc'] ?></textarea>
									<div class="help-block">(maks. 50 karakter)</div>
								</div>
							</div>
							<div class="form-group">
								<label class="col-md-3 control-label">Slider Fotosu</label>
								<div class="col-md-9">
									<input name="section_photo" type="file" class="file-simple"
									       class="<?= $validateClass ?>"
									       accept=".jpg,.png"/>
									<div class="help-block">Slider Fotoğrafını buraya ekleyiniz (maks 1
										adet) <?= $helpText ?></div>
								</div>
							</div>
							<div class="form-group">
								<label class="col-md-3 control-label">Slider Url</label>
								<div class="col-md-9">
									<input type="text" name="section_url" class="form-control"
									       placeholder="Yönlendirilecek Web Sayfası Adresi" value="<?= @$galleryData['section_url'] ?>"/>
								</div>
							</div>
							<div class="form-group">
								<label class="col-md-3 control-label">Sıralama</label>
								<div class="col-md-2">
									<input name="sorting" type="text" class="form-control" placeholder="Sıralama"
									       value="<?= @$galleryData['sorting'] ?>"/>
								</div>
							</div>
							<div class="form-group">
								<label class="col-md-3 control-label">Dil</label>
								<div class="col-md-9">
									<select name="language" class="validate[required] select" id="formStatus"
									        data-width="fit">
										<option value="">Seçiniz</option>
										<?php $language = (@$galleryData['language'] == '') ? $current_lang : @$galleryData['language']; ?>
										<?php get_language($language) ?>
									</select>
								</div>
							</div>
							<div class="form-group">
								<label class="col-md-3 control-label">Durum</label>
								<div class="col-md-9">
									<select name="status" class="validate[required] select" id="formStatus"
									        data-width="fit">
										<option value="">Seçiniz</option>
										<?php get_status(@$galleryData['status']) ?>
									</select>
								</div>
							</div>

							<div class="btn-group pull-right">
								<button class="btn btn-success" type="submit"><?= $buttonName ?></button>
							</div>
						</form>
					</div>
				</div>
			</div>

		</div>

		<div class="col-md-12">
			<!-- START CONTENT FRAME BODY -->
			<div class="content-frame-body content-frame-body-left">

				<div class="pull-left push-up-10">
					<button class="btn btn-primary" id="gallery-toggle-items">Tümünü Seç</button>
				</div>
				<div class="pull-right push-up-10">
					<div class="btn-group">
						<button class="btn btn-primary editSlider"><span class="fa fa-pencil"></span> Düzenle</button>
						<button class="btn btn-primary deleteSlider"><span class="fa fa-trash-o"></span> Sil</button>
					</div>
				</div>

				<div class="gallery" id="links">
					<?php
						foreach ($sliders as $Sgallery) {
							?>
							<a class="gallery-item"
							   href="<?= base_url() ?>gallery/sliders/<?= $Sgallery['section_photo'] ?>"
							   title="<?= $Sgallery['section_name'] ?>" data-gallery>
								<div class="image">
									<img src="<?= base_url() ?>gallery/sliders/<?= $Sgallery['section_photo'] ?>"
									     alt="<?= $Sgallery['section_name'] ?>"/>
									<ul class="gallery-item-controls">
										<li>
											<label class="check">
												<input type="checkbox" class="icheckbox"
												       value="<?= $Sgallery['id'] ?>"/>
											</label>
										</li>
										<li>
											<span class="slider-item-remove" id="<?= $Sgallery['id'] ?>"><i
													class="fa fa-times"></i></span>
										</li>
									</ul>
								</div>
								<div class="meta">
									<strong><?= $Sgallery['section_name'] ?></strong>
									<span><?= $Sgallery['section_desc'] ?></span>
								</div>
							</a>
						<?php } ?>
					<div class="clearfix"></div>
				</div>

			</div>
			<!-- END CONTENT FRAME BODY -->
		</div>
		<!-- END CONTENT FRAME -->
	</div>
</div>
<!-- END PAGE CONTENT WRAPPER -->