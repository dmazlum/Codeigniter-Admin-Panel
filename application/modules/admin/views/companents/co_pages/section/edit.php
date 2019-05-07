<?php $get_data = $edit_data;?>
<!-- PAGE CONTENT -->
<div class="page-content">
	<?php vertical_menu(); ?>
	<!-- START BREADCRUMB -->
	<ul class="breadcrumb">
		<li><a href="<?=base_url()?>admin/co_pages/sections">Kategoriler</a></li>
		<li class="active">Kategori Güncelle</li>
	</ul>
	<!-- END BREADCRUMB -->
	<div class="page-title">
		<h2>Kategori Güncelleme</h2>
	</div>
	<!-- PAGE CONTENT WRAPPER -->
	<div class="page-content-wrap">
		<?php $this->view('partical/messages'); ?>
		<div class="col-md-5">
			<div class="panel panel-colorful">
				<form id="validate"
				      role="form"
				      action="<?php echo base_url();?>admin/co_pages/editSectionData/<?=$get_data['id'];?>"
				      method="post"
                      enctype="multipart/form-data">
					<input type="hidden" name="section_type" value="0">
					<div class="panel-body">
						<div class="form-group">
							<label>Ana Bölüm</label>
							<br>
							<?php if ($get_data['sub_category_id'] == 0) { $selected = "selected"; }?>
							<select name="sub_category_id"
							        class="select show-tick"
							        data-width="fit">
								<option value="" <?=$selected?>>Seçiniz</option>
								<?php foreach ($categories as $cat): ?>
									<?php if ($cat['children']) { ?>
										<option value="<?=$cat['id']?>"
										        style="font-weight: bold;"
											<?php if ($cat['id'] == $get_data['id'] && $get_data['sub_category_id'] != 0) { echo "selected"; } ?>>
											<?php echo $cat['section_name']; ?>
										</option>
										<?php foreach ($cat['children'] as $alt_cat) { ?>
											<option value="<?php echo $alt_cat['id']; ?>" <?php if ($alt_cat['id'] == $get_data['id'] && $get_data['sub_category_id'] != 0) { echo "selected"; } ?>>&nbsp;&nbsp;- <?php echo stripslashes($alt_cat['section_name']); ?></option>
											<?php if($alt_cat['children']) {?>
												<?php foreach ($alt_cat['children'] as $alt_cat2) { ?>
													<option value="<?php echo $alt_cat2['id']; ?>" <?php if ($alt_cat2['id'] == $get_data['id'] && $get_data['sub_category_id'] != 0) { echo "selected"; } ?>>&nbsp;&nbsp;&nbsp;-- <?php echo stripslashes($alt_cat2['section_name']); ?></option>
												<?php } ?>
											<?php } ?>
										<?php } ?>
									<?php } else { ?>
										<?php if($cat['section_url'] != '/') {?>
											<option value="<?php echo $cat['id']; ?>" <?php if ($cat['id'] == $get_data['id']) { echo "selected"; } ?>>
												<?php echo stripslashes($cat['section_name']); ?>
											</option>
										<?php } ?>
									<?php } ?>
								<?php endforeach; ?>
							</select>
							<span class="help-block">Ana bölüm yoksa boş bırakınız</span>
						</div>
						<div class="form-group">
							<label>Bölüm</label>
							<input name="section_name" type="text" class="validate[required] form-control" placeholder="Bölüm Adı" value="<?=$get_data['section_name'];?>">
						</div>
						<div class="form-group">
							<label>Harici Url</label>
							<input name="section_url" type="text" class="form-control" placeholder="Site içi veya dış url" value="<?=$get_data['section_url'];?>">
						</div>
						<div class="form-group">
							<label>Sıralama</label>
							<input name="sorting" type="text" class="form-control" placeholder="Sıra No" value="<?=$get_data['sorting'];?>">
						</div>
						<div class="form-group">
							<label>Durum</label>
							<br>
							<select name="status" class="validate[required] select" id="formStatus" data-width="fit">
								<option value="">Seçiniz</option>
								<?php get_status($get_data['status']) ?>
							</select>
						</div>
					</div>
					<div class="panel-footer">
						<a href="<?=base_url()?>admin/co_pages/sections" class="btn btn-danger pull-right">İptal</a>
						<button class="btn btn-success pull-right">Güncelle</button>
					</div>
				</form>
			</div>
		</div>

	</div>
	<!-- END PAGE CONTENT WRAPPER -->
</div>
<!-- END PAGE CONTENT -->