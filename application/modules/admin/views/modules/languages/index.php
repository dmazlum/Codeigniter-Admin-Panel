<!-- PAGE CONTENT -->
<div class="page-content">

	<?php vertical_menu(); ?>

	<!-- START BREADCRUMB -->
	<ul class="breadcrumb">
		<li><a href="#">Ayarlar</a></li>
		<li class="active">Diller</li>
	</ul>
	<!-- END BREADCRUMB -->

	<div class="page-title">
		<h2>Diller</h2>
	</div>

	<!-- PAGE CONTENT WRAPPER -->
	<div class="page-content-wrap">

		<div class="row">
			<div class="col-md-12">
				<div class="panel panel-default">

					<div class="panel-heading">
						<h3 class="panel-title">Dil Listesi</h3>
					</div>

					<div class="panel-body panel-body-table">

						<div class="table-responsive">
							<table class="table table-bordered table-striped table-actions">
								<thead>
								<tr>
									<th>Dil</th>
									<th>Iso Kodu</th>
									<th width="100">Durum</th>
									<th width="120">İşlemler</th>
								</tr>
								</thead>
								<tbody>
								<?php foreach($languages as $l): ?>
									<tr id="trow_<?php echo $l['id']; ?>">
										<td><strong><?php echo $l['language']; ?></strong></td>
										<td><?php echo $l['iso_code']; ?></td>
										<?php
											if ($l['status'] == '1') {
										?>
										<td><span class="label label-success">Aktif</span></td>
										<?php } else { ?>
										<td><span class="label label-danger">Deaktif</span></td>
										<?php } ?>
										<td>
											<?php
												if ($l['status'] == '1') {
											?>
											<a href="<?php echo base_url()?>admin/language/edit/<?php echo $l['id']?>/0" class="btn btn-danger btn-rounded btn-condensed btn-sm" title="Deaktif Et"><span class="fa fa-power-off"></span></a>
											<?php } else { ?>
											<a href="<?php echo base_url()?>admin/language/edit/<?php echo $l['id']?>/1" class="btn btn-success btn-rounded btn-condensed btn-sm" title="Aktif Et"><span class="fa fa-check"></span></a>
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

	</div>
	<!-- END PAGE CONTENT WRAPPER -->
</div>
<!-- END PAGE CONTENT -->