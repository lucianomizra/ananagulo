<?php if(!AJAX) $this->load->view('common/header') ?>
<div id="page-info" data-section="login"></div>
<div class="container">
	<div class="page-login row-products-filter">
		<div class="page-header">
			<ol class="breadcrumb">
        <li><a href="<?= base_url () ?>">Ana Angulo</a></li>
        <li><a href="<?= base_url () ?>cart">Cesta</a></li>
			  <li class="active">Finalizada</li>
			</ol>
		</div>
            <div class="clearboth"></div>

		<div class="text-center page-footer-nm tpv-ok">
      <p>Tú pedido se ha realizado con éxito, hemos enviado un email a tu cuenta de correo con todos los datos de tu compra ¡Muchas gracias!</p>
      <p>Si necesitas una factura de tu pedido no dudes en solicitarla enviando un email a <a href="mailto:hola@anaangulo.com" target="_blank">hola@anaangulo.com</a> con el número de pedido.</p>
		</div>

		<div class="page-footer text-center page-footer-nm">			
			<a href="<?= base_url() ?>productos" class="btn btn-primary btn-lg">Seguir comprando</a>
		</div>

	</div>
</div>
<?php $this->load->view('common/footer') ?>