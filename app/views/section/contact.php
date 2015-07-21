<?php if(!AJAX) $this->load->view('common/header') ?>
<div id="page-info" data-section="contact"></div>
<div class="container">
	<div class="page-info row-products-filter">
		<div class="page-header">
			<ol class="breadcrumb pull-left">
			  <li><a href="<?= base_url() ?>">Ana Angulo</a></li>
			  <li class="active">Informacíon</li>
			</ol>
		</div>
		<div class="clearfix"></div>
	</div>

	<div class="page-body contact-body">
				<div class="info-menu text-left text-contact-infom">
					<h3>Atención al cliente</h3>
				</div>
		<div class="row">

			<div class="col-md-12">
				<div class="info padding-contact">
					
					<div class="row">
						<div class="col-md-12">
							<h2>Contacta con nosotros</h2>
						</div>
						<div class="col-md-6">
							<p>Rellena el formulario si quieres ponerte en contacto con nosotros por cualquier duda o problema</p>
							
							<p>Si prefieres llamarnos hazlo al <strong class="text-sepia">678 345 456</strong></p>
						</div>
						
					</div>

					<?= $this->load->view('widget/form-contact') ?>
					
					<div class="clearfix"></div>
					<? if(count($stores)): ?>
					<div class="row shops">
						<div class="col-md-12">
							<h2>Nuestras tiendas</h2>
						</div>
						<div class="col-md-6">
							<p>Rellena el formulario si quieres ponerte en contacto con nosotros por cualquier duda o problema.</p>
						</div>
						<div class="clearfix"></div>
						<div class="stores-list">
						<? foreach($stores as $s): ?>
						<div class="stores-item-cc">
						<h3 class="store-title visible-xs collapsed" data-toggle-xs="collapse" href="#collapseCC<?= $s->id_store ?>" aria-expanded="false" aria-controls="collapseFooter"><?= $s->store ?></h3>
						<div id="collapseCC<?= $s->id_store ?>" class="col-md-3 col-sm-6 article store-item collapse">
						<div class="hextra">
							<p><?= $s->address ?></p>
							<p><?= $s->tel ?></p>
							</div>
							<a href="<?= $s->map_link ?>" target="_blank">
							<?/*
							<div class="map" data-location="<?= $s->address ?>" data-icon="<?= layout().'imgs/maker.png'; ?>"></div>
							*/?>
								<?= img(thumb($s->file,238,149)) ?>
							</a>
							<h2><?= $s->store ?></h2>
							<p><?= $s->address ?></p>
							<p><?= $s->tel ?></p>
						</div>
						</div>
						<? endforeach ?>
						</div>					
					</div>					
				<? endif ?>
				</div>
			</div>
		</div>
	</div>
</div>
<script>
	$(document).ready(function() {
		if($(window).width()>500)
		$('.store-item').removeClass('collapse');
	});
</script>
<?php $this->load->view('common/footer') ?>