<!-- START X-NAVIGATION VERTICAL -->
<ul class="x-navigation x-navigation-horizontal x-navigation-panel">
	<!-- TOGGLE NAVIGATION -->
	<li class="xn-icon-button">
		<a href="#" class="x-navigation-minimize"><span class="fa fa-dedent"></span></a>
	</li>
	<!-- END TOGGLE NAVIGATION -->
	<!-- POWER OFF -->
	<li class="xn-icon-button pull-right last">
		<a href="#"><span class="fa fa-power-off"></span></a>
		<ul class="xn-drop-left animated zoomIn">
			<li><a href="#" class="mb-control" data-box="#mb-signout"><span class="fa fa-sign-out"></span> Çıkış Yap</a></li>
		</ul>
	</li>
	<!-- END POWER OFF -->

	<?php if($site_closed) { ?>
	<!-- MESSAGES -->
	<li class="xn-icon-button pull-right">
		<a href="#"><span class="fa fa-comments"></span></a>
		<div class="informer informer-danger">1</div>
		<div class="panel panel-primary animated zoomIn xn-drop-left xn-panel-dragging">
			<div class="panel-heading">
				<h3 class="panel-title"><span class="fa fa-comments"></span> Sistem Mesajı</h3>
				<div class="pull-right">
					<span class="label label-danger">1 yeni</span>
				</div>
			</div>
			<div class="panel-body list-group list-group-contacts scroll" style="height: 200px;">
				<a href="<?=base_url()?>admin/settings/setup" class="list-group-item">
					<div class="list-group-status status-online"></div>
					<img src="<?=base_url()?>assets/img/icons/no-image.jpg" class="pull-left" alt="Sistem Admin"/>
					<span class="contacts-title">Admin</span>
					<p><strong>Bilgi:</strong> Site kullanıma kapatılmıştır. Açmak için tıklayın.</p>
				</a>
			</div>
		</div>
	</li>
	<!-- END MESSAGES -->
	<?php } ?>
	<!-- LANG BAR -->
	<li class="xn-icon-button pull-right">
		<a href="#"><span class="flag flag-<?=$current_lang?>"></span></a>
		<ul class="xn-drop-left xn-drop-white animated zoomIn">
			<?php
				foreach ($language as $lang) {
			?>
			<li>
				<a href="<?=base_url()?>admin/change_language/<?=$lang['iso_code']?>"><span class="flag flag-<?=$lang['iso_code']?>"></span> <?=$lang['language']?></a>
			</li>
			<?php } ?>
		</ul>
	</li>
	<!-- END LANG BAR -->
</ul>
<!-- END X-NAVIGATION VERTICAL -->