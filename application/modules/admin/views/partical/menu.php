<!-- START PAGE SIDEBAR -->
<div class="page-sidebar">
	<!-- START X-NAVIGATION -->
	<ul class="x-navigation">
		<li class="xn-logo">
			<a href="<?php echo base_url()?>admin/dashboard">ADMIN</a>
			<a href="#" class="x-navigation-control"></a>
		</li>
		<li class="xn-title">Site Bileşenleri</li>
		<li>
			<a href="<?php echo base_url()?>admin/dashboard"><span class="fa fa-desktop"></span> <span class="xn-text">Dashboard</span></a>
		</li>
		<?php
			foreach (get_site_modules() as $module_menu) {
			if ($module_menu['status'] == 1) {
		?>
		<li class="xn-openable <?php echo ($this->uri->segment(2) == $module_menu['sname']) ? 'active' : ''; ?>">
			<a href="#"><span class="fa <?php echo $module_menu['module_icon'];?>"></span> <span class="xn-text"><?php echo $module_menu['module_name'];?></span></a>
			<ul>
				<?php $this->load->view('companents/'.$module_menu['sname'].'/template', TRUE); ?>
			</ul>
		</li>
			<?php } } ?>
		<li class="xn-title">Yönetim Modülleri</li>
		<li class="xn-openable <?php echo ($this->uri->segment(2) == 'settings') ? 'active' : ''; ?>">
			<a href="#"><span class="fa fa-cogs"></span> <span class="xn-text">Ayarlar</span></a>
			<ul>
				<?php
					foreach (get_modules() as $module_menu) {
						if ($module_menu['status'] == 1) {
				?>
				<li <?php echo ($this->uri->segment(3) == $module_menu['sname']) ? 'class="active"' : ''; ?>>
					<a href="<?php echo base_url(); ?>admin/settings/<?php echo $module_menu['sname']; ?>">
						<span class="fa <?php echo $module_menu['module_icon']; ?>"></span> <?php echo $module_menu['module_name']; ?>
					</a>
				</li>
				<?php } } ?>
			</ul>
		</li>
	</ul>
	<!-- END X-NAVIGATION -->
</div>
<!-- END PAGE SIDEBAR -->