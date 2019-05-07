<!-- PAGE CONTENT -->
<div class="page-content">

	<?php vertical_menu(); ?>

	<!-- START BREADCRUMB -->
	<ul class="breadcrumb">
		<li><a href="#">Admin Panel</a></li>
		<li class="active">Dashboard</li>
	</ul>
	<!-- END BREADCRUMB -->

	<!-- PAGE CONTENT WRAPPER -->
	<div class="page-content-wrap">

		<!-- START WIDGETS -->
		<div class="row">
			<div class="col-md-3">

				<!-- START WIDGET SLIDER -->
				<div class="widget widget-default widget-carousel">
					<div class="owl-carousel" id="owl-example">
						<div>
							<div class="widget-title">Toplam Duyuru</div>
							<div class="widget-subtitle"><?=date('d.m.Y')?> tarihi itibariyle</div>
							<div class="widget-int"><?=$news_count?></div>
						</div>
						<div>
							<div class="widget-title">Galeri Bölümü</div>
							<div class="widget-int"><?=$gallery_count?></div>
						</div>
						<div>
							<div class="widget-title">New</div>
							<div class="widget-subtitle">Visitors</div>
							<div class="widget-int">1,977</div>
						</div>
					</div>
				</div>
				<!-- END WIDGET SLIDER -->

			</div>
			<div class="col-md-3">

				<!-- START WIDGET MESSAGES -->
				<div class="widget widget-default widget-item-icon" onclick="location.href='<?=base_url()?>admin/settings/backup';">
					<div class="widget-item-left">
						<span class="fa fa-cloud-download"></span>
					</div>
					<div class="widget-data">
						<div class="widget-int num-count"><?=$backup_count?></div>
						<div class="widget-title">Toplam Site Yedeği</div>
						<div class="widget-subtitle">Yedek almak için <strong><a href="<?=base_url()?>admin/settings/backup">tıklayınız</a></strong></div>
					</div>
				</div>
				<!-- END WIDGET MESSAGES -->

			</div>
			<div class="col-md-3">

				<!-- START WIDGET REGISTRED -->
				<div class="widget widget-default widget-item-icon" onclick="location.href='<?=base_url()?>admin/settings/users';">
					<div class="widget-item-left">
						<span class="fa fa-user"></span>
					</div>
					<div class="widget-data">
						<div class="widget-int num-count"><?= $user_count ?></div>
						<div class="widget-title">Kayıtlı kullanıcı</div>
					</div>
				</div>
				<!-- END WIDGET REGISTRED -->

			</div>
			<div class="col-md-3">

				<!-- START WIDGET CLOCK -->
				<div class="widget widget-danger widget-padding-sm">
					<div class="widget-big-int plugin-clock">00:00</div>
					<div class="widget-subtitle plugin-date">Yükleniyor...</div>
					<div class="widget-buttons widget-c3">
						<div class="col">
							<a href="#"><span class="fa fa-clock-o"></span></a>
						</div>
						<div class="col">
							<a href="#"><span class="fa fa-bell"></span></a>
						</div>
						<div class="col">
							<a href="#"><span class="fa fa-calendar"></span></a>
						</div>
					</div>
				</div>
				<!-- END WIDGET CLOCK -->

			</div>
		</div>
		<!-- END WIDGETS -->

	</div>
	<!-- END PAGE CONTENT WRAPPER -->
</div>
<!-- END PAGE CONTENT -->