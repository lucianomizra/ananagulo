<?php if(!AJAX) $this->load->view('common/header') ?>
<div id="page-info" data-section="info"></div>
<div class="container" style="padding-bottom:60px;">
	<div class="page-myaccount row-products-filter">
		<div class="page-header">
		<?/*
			<ol class="breadcrumb pull-left">
			  <li><a href="<?= base_url() ?>">Ana Angulo</a></li>
			  <li><a href="<?= base_url() ?>mi-cuenta">Mi cuenta</a></li>
			  <li class="active">Mis pedidos</li>
			</ol>
		*/?>
		</div>
		<div class="clearfix"></div>

		<div class="page-body">
			<div class="row mailx">
				<? $this->load->view('cart/mailx'); ?>
				<div class="clearfix"></div>
			</div>
		</div>
	</div>
</div>
<?php $this->load->view('common/footer') ?>