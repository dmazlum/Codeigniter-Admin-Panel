<!-- PAGE CONTENT -->
<div class="page-content">
	<?php vertical_menu(); ?>
	<!-- START BREADCRUMB -->
	<ul class="breadcrumb">
		<li><a href="#">Ayarlar</a></li>
		<li class="active">Yedekleme</li>
	</ul>
	<!-- END BREADCRUMB -->
	<div class="page-title">
		<h2>Yedekleme İşlemleri</h2>
	</div>
	<!-- PAGE CONTENT WRAPPER -->
	<div class="page-content-wrap">

		<div class="row">
			<div class="col-md-7 pull-right">
				<div class="panel panel-default">
					<div class="panel-body">
						<p>Bu bölümde sitenin veritabanı yedeğini alabilirsiniz. Yedek işlemleri sorumluluğu tamamen kullanıcıya aittir. Dilediğiniz her zaman yedek alabilirsiniz.</p>
						<form action="<?php echo base_url()?>admin/backup" method="post">
							<input type="hidden" name="backup_type" value="1">
							<input type="hidden" name="file_type" value="1">
							<input type="hidden" name="backup" value="do_backup">
							<button class="btn btn-success pull-right">Yedek Al <i class="fa fa-arrow-down"></i></button>
						</form>
					</div>
				</div>
			</div>
			<?php if($backups) { ?>
			<div class="col-md-12">
				<div class="panel panel-default">
					<div class="panel-heading">
						<h3 class="panel-title">Yedeklenen Dosyalar</h3>
					</div>
					<div class="panel-body panel-body-table">
						<div class="table-responsive">
							<table class="table table-bordered table-striped table-actions">
								<thead>
								<tr>
									<th width="50">Id</th>
									<th>Yedek Adı</th>
									<th>Konum</th>
									<th>Oluşturma Tarihi</th>
									<th width="120">İşlemler</th>
								</tr>
								</thead>
								<tbody>
								<?php foreach($backups as $b): ?>
									<tr id="trow_<?php echo $b['id']; ?>">
										<td class="text-center"><?php echo $b['id']; ?></td>
										<td><strong><a href="<?php echo base_url().$b['backup_location']."/".$b['backup_name']?>"><?php echo $b['backup_name']; ?></a></strong></td>
										<td><?php echo $b['backup_location']; ?></td>
										<td><?php echo date('d.m.Y H:i', strtotime($b['created_date'])); ?></td>
										<td>
											<a href="<?php echo base_url()?>admin/backup/delete/<?php echo $b['id']?>" class="btn btn-danger btn-rounded btn-condensed btn-sm" title="Sil" onclick="return confirm('Bu kaydı silmek istiyor musunuz?');"><span class="fa fa-times"></span></a>
										</td>
									</tr>
								<?php endforeach; ?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
			<?php } ?>
		</div>
	</div>
	<!-- END PAGE CONTENT WRAPPER -->
</div>
<!-- END PAGE CONTENT -->