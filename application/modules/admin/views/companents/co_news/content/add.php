<!-- PAGE CONTENT -->
<div class="page-content">

	<?php vertical_menu(); ?>

	<!-- START BREADCRUMB -->
	<ul class="breadcrumb">
		<li><a href="<?= base_url() ?>admin/co_news/content">Duyurular</a></li>
		<li class="active">Duyuru Ekle</li>
	</ul>
	<!-- END BREADCRUMB -->

	<div class="page-title">
		<h2>Duyuru Ekleme</h2>
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
										<tr id="trow_<?=$content['id']?>">
											<td><strong><?=$content['news_subject'];?></strong></td>
											<td><?php echo date('d.m.Y H:i', strtotime($content['created_date'])); ?></td>
											<td><?=$content['language']?></td>
											<td>
												<button class="btn btn-default btn-rounded btn-condensed btn-sm">
													<a href="<?php echo base_url(); ?>admin/co_news/edit_content/<?=$content['id']?>"><span class="fa fa-pencil"></span></a>
												</button>
												<a href="<?=base_url()?>admin/co_news/delete/<?=$content['id']?>"
												   class="btn btn-danger btn-rounded btn-condensed btn-sm"
												   onclick="return confirm('Bu kaydı silmek istiyor musunuz?');">
													<span class="fa fa-times"></span>
												</a>
											</td>
										</tr>
									<?php } } ?>
							</tbody>
						</table>
					</div>

				</div>
			</div>
		</div>
		<div class="col-md-5">
			<div class="panel panel-colorful">
				<form id="validate" role="form" action="<?php echo base_url(); ?>admin/co_news/addContentData"
				      method="post" enctype="multipart/form-data">
					<div class="panel-body">
						<div class="form-group">
							<label>Başlık</label>
							<input name="news_subject" type="text" class="validate[required] form-control"
							       placeholder="Başlık">
						</div>
						<div class="form-group">
							<label>İçerik</label>
							<textarea name="news_content" class="summernote" placeholder="İçerik"></textarea>
						</div>
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
								<?php get_language($current_lang) ?>
							</select>
						</div>
					</div>
					<div class="panel-footer">
						<button class="btn btn-success pull-right">Ekle</button>
					</div>
				</form>
			</div>
		</div>
	</div>
	<!-- END PAGE CONTENT WRAPPER -->
</div>
<!-- END PAGE CONTENT -->