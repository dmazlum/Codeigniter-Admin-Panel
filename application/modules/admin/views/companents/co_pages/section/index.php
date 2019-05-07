<!-- PAGE CONTENT -->
<div class="page-content">

	<?php vertical_menu(); ?>

	<!-- START BREADCRUMB -->
	<ul class="breadcrumb">
		<li><a href="#">Sayfalar</a></li>
		<li class="active">Kategori & İçerik Ekle</li>
	</ul>
	<!-- END BREADCRUMB -->

	<div class="page-title">
		<h2> Kategoriler & İçerikler</h2>
	</div>

	<!-- PAGE CONTENT WRAPPER -->
	<div class="page-content-wrap">

		<?php $this->view('partical/messages'); ?>

        <div class="col-md-12" style="margin-bottom: 20px;">
        <div class="btn-group pull-right">
            <a href="#" data-toggle="dropdown" class="btn btn-success dropdown-toggle" aria-expanded="false">İçerik Menüsü <span class="caret"></span></a>
            <ul class="dropdown-menu" role="menu">
                <li><a href="<?php echo base_url(); ?>admin/co_pages/add_section">Yeni Kategori Ekle</a></li>
                <li><a href="<?php echo base_url(); ?>admin/co_pages/add_content">Yeni İçerik Ekle</a></li>
            </ul>
        </div>
        </div>

		<div class="col-md-12">
			<div class="panel panel-default">

				<div class="panel-heading">
					<h3 class="panel-title">Kategoriler</h3>
				</div>

				<div class="panel-body panel-body-table">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-actions">
                            <thead>
                            <tr>
                                <th>Bölüm</th>
                                <th width="180">Tarih</th>
                                <th width="100">Durum</th>
                                <th width="100">Sıra No</th>
                                <th width="120">İşlemler</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php echo $section_table; ?>
                            </tbody>
                        </table>

                    </div>
			</div>
		</div>

	</div>
	<!-- END PAGE CONTENT WRAPPER -->
</div>
<!-- END PAGE CONTENT -->