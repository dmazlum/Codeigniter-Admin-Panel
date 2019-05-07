<!-- PAGE CONTENT -->
<div class="page-content">

	<?php vertical_menu(); ?>

	<!-- START BREADCRUMB -->
	<ul class="breadcrumb">
		<li><a href="#">Ayarlar</a></li>
		<li class="active">Kullanıcılar</li>
	</ul>
	<!-- END BREADCRUMB -->

	<div class="page-title">
		<h2>Kullanıcılar</h2>
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
					<form id="validate" role="form" class="form-horizontal" action="<?php echo base_url()?>admin/user/add" method="post">
						<div class="form-group">
							<label class="col-md-3 control-label">Adı Soyadı:</label>
							<div class="col-md-9">
								<input type="text" name="name_surname" class="form-control" />
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-3 control-label">Kullanıcı Adı:</label>
							<div class="col-md-9">
								<input type="text" name="username" class="validate[required] form-control" />
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-3 control-label">Şifre: </label>
							<div class="col-md-9">
								<input type="password" name="password" class="validate[required] form-control" />
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-3 control-label">E-Mail Adresi: </label>
							<div class="col-md-9">
								<input type="text" name="email" class="validate[required] form-control" />
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-3 control-label">Rolü:</label>
							<div class="col-md-3">
								<select name="role" class="validate[required] select" id="formIcon" data-width="fit">
									<option value="">Seçiniz</option>
									<?php get_role(NULL);?>
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
						<h3 class="panel-title">Kullanıcılar</h3>
					</div>

					<div class="panel-body panel-body-table">

						<div class="table-responsive">
							<table class="table table-bordered table-striped table-actions">
								<thead>
								<tr>
									<th>Adı Soyadı</th>
									<th>Kullanıcı Adı</th>
									<th>Kullanıcı Rolü</th>
									<th width="120">İşlemler</th>
								</tr>
								</thead>
								<tbody>
								<?php foreach($users as $sm): ?>
									<tr id="trow_<?php echo $sm['id']; ?>">
										<td><strong><?php echo $sm['name_surname']; ?></strong></td>
										<td><strong><?php echo $sm['username']; ?></strong></td>
										<?php
											if ($sm['role'] == 'admin') {
										?>
										<td><span class="label label-success">Yönetici</span></td>
										<?php } else { ?>
										<td><span class="label label-warning">Kullanıcı</span></td>
										<?php } ?>
										<td>
											<a href="<?php echo base_url()?>admin/user/show/<?php echo $sm['id']; ?>" class="btn btn-default btn-condensed btn-sm" title="Düzenle"><span class="fa fa-pencil"></span></a>
											<a href="<?php echo base_url()?>admin/user/delete/<?php echo $sm['id']; ?>" class="btn btn-danger btn-condensed btn-sm" title="Sil" onclick="return confirm('Bu kaydı silmek istiyor musunuz?');"><span class="fa fa-times"></span></a>
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