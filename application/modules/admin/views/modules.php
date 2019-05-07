<!-- PAGE CONTENT -->
<div class="page-content">

	<?php vertical_menu(); ?>

	<!-- START BREADCRUMB -->
	<ul class="breadcrumb">
		<li><a href="#">Ayarlar</a></li>
		<li class="active">Modüller</li>
	</ul>
	<!-- END BREADCRUMB -->

	<div class="page-title">
		<h2>Modüller</h2>
	</div>

	<!-- PAGE CONTENT WRAPPER -->
	<div class="page-content-wrap">

		<div class="row">
			<div class="col-md-12">
				<div class="panel panel-default">

					<div class="panel-heading">
						<h3 class="panel-title">Site Bileşenleri</h3>
					</div>

					<div class="panel-body panel-body-table">

						<div class="table-responsive">
							<table class="table table-bordered table-striped table-actions">
								<thead>
								<tr>
									<th>Bileşen Adı</th>
									<th>Klasör</th>
									<th width="100">Durum</th>
									<th width="200">Oluşturma Tarihi</th>
									<th width="120">İşlemler</th>
								</tr>
								</thead>
								<tbody>
								<?php foreach($modules_site as $m): ?>
									<tr id="trow_<?php echo $m['id']; ?>">
										<td><strong><?php echo $m['module_name']; ?></strong></td>
										<td><?php echo $m['sname']; ?></td>
										<?php
											if ($m['status'] == '1') {
										?>
										<td><span class="label label-success">Aktif</span></td>
										<?php } else { ?>
										<td><span class="label label-danger">Deaktif</span></td>
										<?php } ?>
										<td><?php echo date('d.m.Y H:i', strtotime($m['created_date'])); ?></td>
										<td>
											<?php
												if ($m['status'] == '1') {
											?>
											<a href="<?php echo base_url()?>admin/module/edit/<?php echo $m['id']; ?>/0" class="btn btn-danger btn-rounded btn-condensed btn-sm" title="Deaktif Et"><span class="fa fa-power-off"></span></a>
											<?php } else { ?>
											<a  href="<?php echo base_url()?>admin/module/edit/<?php echo $m['id']; ?>/1" class="btn btn-success btn-rounded btn-condensed btn-sm" title="Aktif Et"><span class="fa fa-check"></span></a>
											<?php } ?>
										</td>
									</tr>
								<?php endforeach; ?>
								</tbody>
							</table>
						</div>

					</div>
				</div>
			</div>

			<div class="col-md-12">
				<div class="panel panel-default">

					<div class="panel-heading">
						<h3 class="panel-title">Yönetim Modülleri</h3>
					</div>

					<div class="panel-body panel-body-table">

						<div class="table-responsive">
							<table class="table table-bordered table-striped table-actions">
								<thead>
								<tr>
									<th>Modül Adı</th>
									<th>Klasör</th>
									<th width="100">Durum</th>
									<th width="200">Oluşturma Tarihi</th>
									<th width="120">İşlemler</th>
								</tr>
								</thead>
								<tbody>
								<?php foreach($modules_admin as $m): ?>
									<tr id="trow_<?php echo $m['id']; ?>">
										<td><strong><?php echo $m['module_name']; ?></strong></td>
										<td><?php echo $m['sname']; ?></td>
										<?php
											if ($m['status'] == '1') {
												?>
												<td><span class="label label-success">Aktif</span></td>
											<?php } else { ?>
												<td><span class="label label-danger">Deaktif</span></td>
											<?php } ?>
										<td><?php echo date('d.m.Y H:i', strtotime($m['created_date'])); ?></td>
										<td>
											<?php
												//Disable Module
												if ($m['sname'] != 'modules')

												if ($m['status'] == '1') {
													?>
													<a href="<?php echo base_url()?>admin/module/edit/<?php echo $m['id']; ?>/0" class="btn btn-danger btn-rounded btn-condensed btn-sm" title="Deaktif Et"><span class="fa fa-power-off"></span></a>
												<?php } else { ?>
													<a  href="<?php echo base_url()?>admin/module/edit/<?php echo $m['id']; ?>/1" class="btn btn-success btn-rounded btn-condensed btn-sm" title="Aktif Et"><span class="fa fa-check"></span></a>
												<?php } ?>
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
	<!-- END PAGE CONTENT WRAPPER -->
</div>
<!-- END PAGE CONTENT -->