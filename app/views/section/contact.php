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

	<div class="page-body">
				<div class="info-menu text-left">
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
						<? foreach($stores as $s): ?>
						<div class="col-md-3 col-sm-6 article">
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
						<? endforeach ?>
					</div>					
				<? endif ?>
				</div>
			</div>
		</div>
	</div>
</div>
<?php $this->load->view('common/footer') ?>