<!-- PAGE CONTENT -->
<div class="page-content">

	<?php vertical_menu(); ?>

	<!-- START BREADCRUMB -->
	<ul class="breadcrumb">
		<li><a href="<?=base_url()?>admin/co_pages/sections">Kategoriler</a></li>
		<li class="active">Bölüm Ekle</li>
	</ul>
	<!-- END BREADCRUMB -->

	<div class="page-title">
		<h2>Bölüm Ekleme</h2>
	</div>

	<!-- PAGE CONTENT WRAPPER -->
	<div class="page-content-wrap">
		<?php $this->view('partical/messages'); ?>

        <div class="col-md-4">
            <div class="panel panel-colorful">
                <div class="panel-heading">
                    <h3 class="panel-title">Kategoriler</h3>
                </div>
                <div class="panel-body">
                    <div id="categories">
                        <ul>
							<?php echo $all_section; ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

		<div class="col-md-8">
			<div class="panel panel-colorful">
				<form id="validate" role="form" action="<?php echo base_url();?>admin/co_pages/addSectionData" method="post" enctype="multipart/form-data">
					<div class="panel-body">
						<div class="form-group">
							<label>Ana Kategori</label>
							<br>
							<p class="baseSection"></p>
                            <input type="hidden" name="sub_category_id" id="sub_category_id">
							<span class="help-block">Ana bölüm yoksa boş bırakınız</span>
						</div>
						<div class="form-group">
							<label>Kategori</label>
							<input name="section_name" type="text" class="validate[required] form-control" placeholder="Kategori Adı">
						</div>
						<div class="form-group">
							<label>Harici Url</label>
							<input name="section_url" type="text" class="form-control" placeholder="Site içi veya dış url">
						</div>
						<div class="form-group">
							<label>Sıralama</label>
							<input name="sorting" type="text" class="form-control" placeholder="Sıra No">
						</div>
						<div class="form-group">
							<label>Durum</label>
							<br>
							<select name="status" class="validate[required] select" id="formStatus" data-width="fit">
								<option value="">Seçiniz</option>
								<?php get_status(1) ?>
							</select>
						</div>
					</div>
					<div class="panel-footer">
						<button class="btn btn-success pull-right">Ekle</button>
					</div>
				</form>
			</div>
		</div>

	</div>
	<!-- END PAGE CONTENT WRAPPER -->
</div>
<!-- END PAGE CONTENT -->