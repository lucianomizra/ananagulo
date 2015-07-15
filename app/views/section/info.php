<?php if(!AJAX) $this->load->view('common/header') ?>
<div id="page-info" data-section="info"></div>
<div class="container">
	<div class="page-info row-products-filter">
		<div class="page-header">
			<ol class="breadcrumb pull-left">
			  <li><a href="<?= base_url() ?>">Ana Angulo</a></li>
			  <li class="active">Información</li>
			</ol>
		</div>
		<div class="clearfix"></div>

	<div class="page-body page-body-info">
		<div class="row">
			<div class="col-sm-6 col-lg-4 col-xs-12">
				<div class="info-menu">
					<h3>Información y ayuda</h3>
					<ul>
						<? foreach($infos as $i): ?>
						<? if($i->link == 'contacto'): ?>
						<li class="<?= ($i->link == $info->link) ? "active" : ""?>"><a href="<?= base_url() . $i->link ?>"><?= $i->title ?></a></li>
						<? else: ?>
						<li class="<?= ($i->link == $info->link) ? "active" : ""?>"><a href="<?= base_url() . "informacion/". $i->link ?>"><?= $i->title ?></a></li>
						<? endif ?>
						<? endforeach ?>
					</ul>
				</div>
			</div>
			<div class="col-sm-6 col-lg-8 col-xs-12 col-data-text">
				<div class="info">
					<h1><?= $info->subtitle ?></h1>					
					<div class="article">
						<?= $info->text ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

</div>

<div class="text-center go-top margin-bottomXL">
	<a class="fa-stack fa-lg go-to-top">
	  <i class="fa fa-circle-thin fa-stack-2x"></i>
	  <i class="fa fa-angle-up fa-stack-1x"></i>
	</a>
</div>
<script>
$(document).ready(function() {
  $('.go-to-top').click(function(e){
    $("html, body").animate({ scrollTop: 0 }, 500);
  });
  if($(window).width()<=1199)
  {      
    $("html, body").animate({ scrollTop: $('.col-data-text').offset().top - 10 }, 0);
  }
});
</script>
<?php $this->load->view('common/footer') ?>