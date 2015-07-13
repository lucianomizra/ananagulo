<?php if(!AJAX) $this->load->view('common/header') ?>
<div id="page-info" data-section="login"></div>
<div class="container">
	<div class="page-login row-products-filter">
		<div class="page-header">
			<ol class="breadcrumb pull-left">
        <li><a href="<?= base_url () ?>">Ana Angulo</a></li>
        <li><a href="<?= base_url () ?>cart">Cesta</a></li>
        <li><a href="<?= base_url () ?>mi-cuenta">Identificación</a></li>
			  <li class="active">Envío</li>
			</ol>
		</div>

		<ul class="checkout-steps">
      <li class="ok"><a href="<?= base_url()?>mi-cuenta">Identificación</a></li>
      <li class="ok"><a href="<?= base_url()?>mi-cuenta/step-3">Envío</a></li>
      <li class="ok"><a href="<?= base_url()?>mi-cuenta/step-4">Pago</a></li>			
		</ul>

		<div class="text-center page-footer-nm tpv-ko">
			<p>Ocurrió un problema al procesar tu pedido intenta nuevamente.</p>
			<? if(isset($error)): ?><p><?= $error ?></p><? endif ?>
		</div>

		<div class="page-footer text-center page-footer-nm">			
			<a href="<?= base_url() ?>mi-cuenta" class="btn btn-default btn-lg">Modificar mis datos</a>
			<a href="<?= base_url() ?>cart" class="btn btn-default btn-lg">Modificar cesta</a>
			<a href="<?= base_url() ?>mi-cuenta/step-4" class="btn btn-primary btn-lg">Volver atrás</a>
		</div>

	</div>
</div>
<?php $this->load->view('common/footer') ?>