<!-- PAGE CONTENT -->
<div class="page-content">

	<?php vertical_menu(); ?>

	<!-- START BREADCRUMB -->
	<ul class="breadcrumb">
		<li><a href="#">Ayarlar</a></li>
		<li class="active">Sosyal Medya</li>
	</ul>
	<!-- END BREADCRUMB -->

	<div class="page-title">
		<h2>Sosyal Medya</h2>
	</div>

	<!-- PAGE CONTENT WRAPPER -->
	<div class="page-content-wrap">

		<?php $this->view('partical/messages'); ?>
		
		<div class="col-md-6">
			<div class="panel panel-default">

				<div class="panel-heading">
					<h3 class="panel-title">Yeni Ekle</h3>
				</div>

				<div class="panel-body">
					<form id="validate" role="form" class="form-horizontal" action="<?php echo base_url()?>admin/social/add" method="post">
						<div class="form-group">
							<label class="col-md-3 control-label">Adı:</label>
							<div class="col-md-9">
								<input type="text" name="social_name" class="validate[required] form-control" />
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-3 control-label">Bağlantı Adresi:</label>
							<div class="col-md-9">
								<input type="text" name="social_url" class="validate[required,custom[url]] form-control" />
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-3 control-label">Icon:</label>
							<div class="col-md-3">
								<select name="icon" class="validate[required] select" id="formIcon" data-width="fit"
									<option value="">Seçiniz</option>
									<?php get_icons(NULL);?>
								</select>
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-3 control-label">Durum:</label>
							<div class="col-md-3">
								<select name="status" class="validate[required] select" id="formStatus" data-width="fit">
									<option value="">Seçiniz</option>
									<?php get_status(1)?>
								</select>
							</div>
						</div>
						<div class="btn-group pull-right">
							<button class="btn btn-success" type="submit">Ekle</button>
						</div>
					</form>

				</div>
			</div>
		</div>

		<div class="row">
			<div class="col-md-6">
				<div class="panel panel-default">

					<div class="panel-heading">
						<h3 class="panel-title">Sosyal Medya</h3>
					</div>

					<div class="panel-body panel-body-table">

						<div class="table-responsive">
							<table class="table table-bordered table-striped table-actions">
								<thead>
								<tr>
									<th>Adı</th>
									<th>Bağlantı Adresi</th>
									<th width="100">Icon</th>
									<th width="100">Durum</th>
									<th width="120">İşlemler</th>
								</tr>
								</thead>
								<tbody>
								<?php foreach($social as $sm): ?>
									<tr id="trow_<?php echo $sm['id']; ?>">
										<td><strong><?php echo $sm['social_name']; ?></strong></td>
										<td><?php echo $sm['social_url']; ?></td>
										<th><span class="fa <?php echo $sm['icon']; ?>"></span></th>
										<?php
											if ($sm['status'] == '1') {
										?>
										<td><span class="label label-success">Aktif</span></td>
										<?php } else { ?>
										<td><span class="label label-danger">Deaktif</span></td>
										<?php } ?>
										<td>
											<a href="<?php echo base_url()?>admin/social/show/<?php echo $sm['id']; ?>" class="btn btn-default btn-condensed btn-sm" title="Düzenle"><span class="fa fa-pencil"></span></a>
											<a href="<?php echo base_url()?>admin/social/delete/<?php echo $sm['id']; ?>" class="btn btn-danger btn-condensed btn-sm" title="Sil" onclick="return confirm('Bu kaydı silmek istiyor musunuz?');"><span class="fa fa-times"></span></a>
										</td>
									</tr>
								<?php endforeach; ?>
								</tbody>
							</table>
						</div>

					</div>
				</div>
			</div>
		</div>

	</div>
	<!-- END PAGE CONTENT WRAPPER -->
</div>
<!-- END PAGE CONTENT -->