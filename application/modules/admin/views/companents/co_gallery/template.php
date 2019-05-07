<li <?php echo ($this->uri->segment(3) == 'sections') ? 'class="active"' : ''; ?>>
	<a href="<?php echo base_url(); ?>admin/co_gallery/sections">
		<span class="fa fa-file-text-o"></span> Kategoriler
	</a>
</li>
<li <?php echo ($this->uri->segment(3) == 'content') ? 'class="active"' : ''; ?>>
	<a href="<?php echo base_url(); ?>admin/co_gallery/content">
		<span class="fa fa-picture-o"></span> Fotoğraf Ekle
	</a>
</li>
<li <?php echo ($this->uri->segment(3) == 'slider') ? 'class="active"' : ''; ?>>
	<a href="<?php echo base_url(); ?>admin/co_gallery/slider">
		<span class="fa fa-file-image-o"></span> Slider Ekle
	</a>
</li>