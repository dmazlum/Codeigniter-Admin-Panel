</div>
<!-- END PAGE CONTAINER -->

<!-- MESSAGE BOX-->
<div class="message-box animated fadeIn" data-sound="alert" id="mb-signout">
	<div class="mb-container">
		<div class="mb-middle">
			<div class="mb-title"><span class="fa fa-sign-out"></span> Çıkış <strong>Yap</strong> ?</div>
			<div class="mb-content">
				<p>Çıkış yapmak istiyor musunuz?</p>
			</div>
			<div class="mb-footer">
				<div class="pull-right">
					<a href="<?php echo base_url() ?>admin/login/logout" class="btn btn-success btn-lg">Evet</a>
					<button class="btn btn-default btn-lg mb-control-close">Hayır</button>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- END MESSAGE BOX-->

<!-- START PRELOADS -->
<audio id="audio-alert" src="<?php echo base_url() ?>assets/audio/alert.mp3" preload="auto"></audio>
<audio id="audio-fail" src="<?php echo base_url() ?>assets/audio/fail.mp3" preload="auto"></audio>
<!-- END PRELOADS -->

<!-- START SCRIPTS -->
<!-- START PLUGINS -->
<script type="text/javascript" src="<?php echo base_url() ?>assets/js/plugins/jquery/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>assets/js/plugins/jquery/jquery-ui.min.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>assets/js/plugins/bootstrap/bootstrap.min.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>assets/js/plugins/mcustomscrollbar/jquery.mCustomScrollbar.min.js"></script>
<!-- END PLUGINS -->

<!-- THIS PAGE PLUGINS -->
<?php
	if(isset($scripts) || !empty($scripts)) {
		foreach ($scripts as $script) {
?>
<script type="text/javascript" src="<?php echo base_url() ?>assets/js/<?php echo $script?>"></script>
<?php
		}
	}
?>
<!-- END PAGE PLUGINS -->

<!-- START TEMPLATE -->
<script type="text/javascript" src="<?php echo base_url() ?>assets/js/plugins.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>assets/js/actions.js"></script>
<!-- END TEMPLATE -->

<!-- END SCRIPTS -->
</body>
</html>