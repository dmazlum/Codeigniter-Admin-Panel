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
		<li class="active">Foto Ekle</li>
	</ul>
	<!-- END BREADCRUMB -->

	<!-- START CONTENT FRAME -->
	<div class="content-frame">

		<?php $this->view('partical/messages'); ?>

		<!-- START CONTENT FRAME TOP -->
		<div class="content-frame-top">
			<div class="page-title">
				<h2><span class="fa fa-image"></span> Galeri</h2>
			</div>
			<div class="pull-right">
				<button class="btn btn-primary" id="act-on-upload"><span class="fa fa-upload"></span> Galeriye Ekle</button>
				<button class="btn btn-default content-frame-right-toggle"><span class="fa fa-bars"></span></button>
			</div>
		</div>

		<!-- START CONTENT FRAME RIGHT -->
		<div class="content-frame-right">
			<?php
				if ($this->uri->segment(4)) {
			?>
			<div class="block push-up-10">
				<p>Seçilen Galeriye Fotoğraf Ekleme</p>
				<form action="<?=base_url()?>admin/co_gallery/addPhoto/<?=$this->uri->segment(4)?>" class="dropzone dropzone-mini"></form>
			</div>
			<?php } ?>
			<h4>Bölümler :</h4>
			<div class="list-group border-bottom push-down-20">
				<a href="#" class="list-group-item active">Tümü <span class="badge badge-primary"><?=count($section_gallery)?></span></a>
				<?php foreach ($section_gallery as $sgallery) { ?>
				<a href="<?=base_url()?>admin/co_gallery/content/<?=$sgallery['id']?>"
				   class="list-group-item <?php if($this->uri->segment(4) == $sgallery['id'] ) { ?>active<?php } ?>">
					<strong><?=$sgallery['section_name']?></strong> <span class="badge badge-success"><?=$sgallery['count']?></span>
				</a>
				<?php } ?>
			</div>
		</div>
		<!-- END CONTENT FRAME RIGHT -->

		<!-- START CONTENT FRAME BODY -->
		<div class="content-frame-body content-frame-body-left">
			<?php
				if (isset($show_photos) && !empty($show_photos)) {
			?>
			<div class="pull-left push-up-10">
				<button class="btn btn-primary" id="gallery-toggle-items">Tümünü Seç</button>
			</div>
			<div class="pull-right push-up-10">
				<div class="btn-group">
					<button class="btn btn-primary deleteGallery"><span class="fa fa-trash-o"></span> Sil</button>
				</div>
			</div>

			<div class="gallery" id="links">
				<?php
					foreach ($show_photos as $show_photo) {
				?>
				<a class="gallery-item" href="<?= base_url() ?>gallery/<?=$show_photo['photo_name']?>" data-gallery>
					<div class="image">
						<img src="<?= base_url() ?>gallery/<?=$show_photo['photo_name']?>" alt=""/>
						<ul class="gallery-item-controls">
							<li><label class="check"><input type="checkbox" class="icheckbox" value="<?=$show_photo['id']?>"/></label></li>
							<li><span class="gallery-item-remove" id="<?=$show_photo['id'] ?>"><i class="fa fa-times"></i></span></li>
						</ul>
					</div>
				</a>
				<?php } ?>
			</div>
			<ul class="pagination pagination-sm pull-right push-down-20 push-up-20">
				<?=$pagination?>
			</ul>
			<?php } else { ?>
					<h4>Lütfen bir fotoğraf galerisi seçiniz...</h4>
			<?php } ?>
		</div>
		<!-- END CONTENT FRAME BODY -->
	</div>
	<!-- END CONTENT FRAME -->
</div>
<!-- END PAGE CONTENT WRAPPER -->
</div>
<!-- END PAGE CONTENT -->