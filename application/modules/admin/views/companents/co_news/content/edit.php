<?php $content_news = $content_news[0]; ?>
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
		<li><a href="<?= base_url() ?>admin/co_news/content">Duyurular</a></li>
		<li class="active">Duyuru Güncelle</li>
	</ul>
	<!-- END BREADCRUMB -->

	<div class="page-title">
		<h2>Duyuru Güncelleme</h2>
	</div>

	<!-- PAGE CONTENT WRAPPER -->
	<div class="page-content-wrap">

		<?php $this->view('partical/messages'); ?>

		<div class="col-md-7">
			<div class="panel panel-default">

				<div class="panel-heading">
					<h3 class="panel-title">Duyurular</h3>
				</div>

				<div class="panel-body panel-body-table">

					<div class="table-responsive">
						<table class="table table-bordered table-striped table-actions">
							<thead>
							<tr>
								<th>Başlık</th>
								<th width="180">Eklenme Tarihi</th>
								<th width="100">Dil</th>
								<th width="120">İşlemler</th>
							</tr>
							</thead>
							<tbody>

							<?php
								if (isset($all_content) && !empty($all_content)) {

									foreach ($all_content as $content) {
										?>
										<tr id="trow_<?= $content['id'] ?>">
											<td><strong><?= $content['news_subject']; ?></strong></td>
											<td><?php echo date('d.m.Y H:i', strtotime($content['created_date'])); ?></td>
											<td><?= $content['language'] ?></td>
											<td>
												<button class="btn btn-default btn-rounded btn-condensed btn-sm">
													<a href="<?php echo base_url(); ?>admin/co_news/edit_content/<?= $content['id'] ?>"><span
															class="fa fa-pencil"></span></a>
												</button>
												<a href="<?= base_url() ?>admin/co_news/delete/<?= $content['id'] ?>"
												   class="btn btn-danger btn-rounded btn-condensed btn-sm"
												   onclick="return confirm('Bu kaydı silmek istiyor musunuz?');">
													<span class="fa fa-times"></span>
												</a>
											</td>
										</tr>
									<?php }
								} ?>
							</tbody>
						</table>
					</div>

				</div>
			</div>
		</div>

		<div class="col-md-5">
			<div class="panel panel-colorful">
				<form id="validate" role="form" action="<?php echo base_url(); ?>admin/co_news/editContentData/<?=$content_news['id']?>"
				      method="post" enctype="multipart/form-data">
					<div class="panel-body">
						<div class="form-group">
							<label>Başlık</label>
							<input name="news_subject" type="text" class="validate[required] form-control"
							       placeholder="Başlık"
							value="<?=$content_news['news_subject']?>">
						</div>
						<div class="form-group">
							<label>İçerik</label>
							<textarea name="news_content" class="summernote" placeholder="İçerik"><?=$content_news['news_content']?></textarea>
						</div>
						<?php
							if ($content_news['news_photo']) {
							$photos = explode(',', $content_news['news_photo']);
						?>
						<div class="form-group">
							<label>Eklenmiş Fotoğraflar / (<?=count($photos)?>) adet</label>
							<div class="gallery" id="links">
								<?php
									foreach ($photos as $key => $value) {
								?>
								<a class="gallery-item" href="<?=base_url()?>gallery/news/<?=$value?>" data-gallery>
									<div class="image">
										<img src="<?=base_url()?>gallery/news/<?=$value?>" alt=""/>
										<ul class="gallery-item-controls">
											<li>
												<span class="news-item-remove" id="<?=$key?>" title="Sil">
													<i class="fa fa-times"></i>
												</span>
											</li>
										</ul>
									</div>
								</a>
								<?php } ?>
							</div>
						</div>
						<?php } ?>
						<div class="form-group">
							<label>Duyuru Fotosu</label>
							<br>
							<input name="news_photo[]" type="file" id="file-simple-news"
							       accept=".jpg,.png" multiple/>
							<div class="help-block">Duyuru Fotoğrafını buraya ekleyiniz (maks 4 adet)</div>
						</div>
						<div class="form-group">
							<label>Dil</label>
							<br>
							<select name="language" class="validate[required] select" id="formStatus" data-width="fit">
								<option value="">Seçiniz</option>
								<?php get_language($content_news['language']) ?>
							</select>
						</div>
					</div>
					<div class="panel-footer">
						<button class="btn btn-success pull-right">Güncelle</button>
					</div>
				</form>
			</div>
		</div>
	</div>
	<!-- END PAGE CONTENT WRAPPER -->
</div>
<!-- END PAGE CONTENT -->