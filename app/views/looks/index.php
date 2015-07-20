<?php if(!AJAX) $this->load->view('common/header') ?>
<? $slide = $this->Data->SlideLooks(); ?>
<div id="page-info" data-section="home"></div>
<div class="home-container">
  <? if(count($slide)): ?>
  <div class="col-md-12 no-padding inside-menu">
    <div class="full-container">
      <div class="home-open-slider slider">
        <ul class="slides">
          <? foreach($slide as $b):?>
          <li>
            <div class="slide-content">
              <? if($b->link):?><a href="<?= prep_url($b->link) ?>"><? endif ?>
              <div class="pull-right">
                <? if($b->title):?>
                <h2><?= $b->title ?></h2>
                <? endif ?>
                <? if($b->subtitle):?>
                <div>
                <p><?= nl2br($b->subtitle) ?></p>
                </div>
                <? endif ?>
              </div>
              <? if($b->link):?></a><? endif ?>
            </div>
            <img src="<?= upload($b->file) ?>" />
          </li>
          <? endforeach ?>
        </ul>
      </div>  
    </div>
  </div>
  <? endif ?>
  <? $info = $this->Data->Information('name-looks'); ?>
	<div class="container">
		<div class="page-header style2 style2bb">
		  <h3>Descubre <?= (count($looks)<2) ? "el look" : "los ". count($looks). " looks" ?><?= ($info && $info->title) ? " by {$info->title}" : "" ?></h3>
		</div>

			<? $count = 0; ?>
		<div class="row looks">
			<div class="col-sm-4 height5">
				<div class="style4">
					<? if( isset($looks[$count])): $look = $looks[$count]; ?>
					<div class="cover style3 product-preview" style="background-image:url(<?= thumb($look->file, 370,572) ?>);">
						<a href="<?= base_url() . 'look/' . $look->id_look . '/' .prep_word_url($look->name) ?>">
							<span class="top">
								<span class="center">
									<span class="linebox bigpadding">
										<h2><?= $look->name ?></h2>
										<small><?= prep_cost($look->cost, true, false) ?></small>
									</span>
								</span>
							</span>
						</a>
					</div>
					<? endif ?>
						<span class="center text-no-mobile">
							<span class="linebox bigpadding">
								<h2 class='ggltp'>Bienvenida a <br>Ana Angulo</h2>
								<small>Descubre los 15 looks que tenemos preparados para ti y ven a visitarnos a nuestras tiendas donde encontraras lo último para vestir tu armario.</small>
							</span>
						</span>
				</div>
			</div>
			<? if( isset($looks[++$count])): $look = $looks[$count]; ?>
			<div class="col-sm-8 height1">
				<div class="cover style3 product-preview" style="background-image:url(<?= thumb($look->file, 794,300) ?>);">
					<a href="<?= base_url() . 'look/' . $look->id_look . '/' .prep_word_url($look->name) ?>" class="right">
						<span class="center">
							<span class="linebox bigpadding">
								<h2><?= $look->name ?></h2>
								<small><?= prep_cost($look->cost, true, false) ?></small>
							</span>
						</span>
					</a>
				</div>
			</div>
			<? endif ?>
			<? if( isset($looks[++$count])): $look = $looks[$count]; ?>
			<div class="col-sm-4 height3">
				<div class="cover style3 product-preview" style="background-image:url(<?= thumb($look->file, 370,572) ?>);">
					<a href="<?= base_url() . 'look/' . $look->id_look . '/' .prep_word_url($look->name) ?>">
						<span class="bottom">
							<span class="center">
								<span class="linebox bigpadding">
										<h2><?= $look->name ?></h2>
										<small><?= prep_cost($look->cost, true, false) ?></small>
								</span>
							</span>
						</span>
					</a>
				</div>
			</div>
			<? endif ?>
			<div class="col-sm-4 height1 text-no-mobile">
				<div class="cover style1 sepia">
					<a href="<?= base_url() ?>contacto/tiendas">
						<span class="middle">
							<span class="center">
								<span class="linebox bigpadding">
								<h2>Conoce</h2>
								<small>Nuestras</small>
								<h2>Tiendas</h2>
								</span>
							</span>
						</span>
					</a>
				</div>
			</div>
			<? if( isset($looks[++$count])): $look = $looks[$count]; ?>
			<div class="col-sm-4 height3">
				<div class="cover style3 product-preview" style="background-image:url(<?= thumb($look->file, 370,572) ?>);">
					<a href="<?= base_url() . 'look/' . $look->id_look . '/' .prep_word_url($look->name) ?>">
						<span class="bottom">
							<span class="center">
								<span class="linebox bigpadding">
										<h2><?= $look->name ?></h2>
										<small><?= prep_cost($look->cost, true, false) ?></small>
								</span>
							</span>
						</span>
					</a>
				</div>
			</div>
			<? endif ?>
			<? if( isset($looks[++$count])): $look = $looks[$count]; ?>
			<div class="col-sm-8 height1 magicclear1">
				<div class="cover style3 product-preview" style="background-image:url(<?= thumb($look->file, 794,300) ?>);">
					<a href="<?= base_url() . 'look/' . $look->id_look . '/' .prep_word_url($look->name) ?>">
						<span class="right">
							<span class="center">
								<span class="linebox bigpadding">
											<h2><?= $look->name ?></h2>
										<small><?= prep_cost($look->cost, true, false) ?></small>
								</span>
							</span>
						</span>
					</a>
				</div>
			</div>
			<? endif ?>
			<? if( isset($looks[++$count])): $look = $looks[$count]; ?>
			<div class="col-sm-4 height3">
				<div class="cover style3 product-preview" style="background-image:url(<?= thumb($look->file, 370,572) ?>);">
					<a href="<?= base_url() . 'look/' . $look->id_look . '/' .prep_word_url($look->name) ?>">
						<span class="bottom">
							<span class="center">
								<span class="linebox bigpadding">
										<h2><?= $look->name ?></h2>
										<small><?= prep_cost($look->cost, true, false) ?></small>
								</span>
							</span>
						</span>
					</a>
				</div>
			</div>
			<? endif ?>
			<? if( isset($looks[++$count])): $look = $looks[$count]; ?>
			<div class="col-sm-8 height1">
				<div class="cover style3 product-preview" style="background-image:url(<?= thumb($look->file, 794,300) ?>);">
					<a href="<?= base_url() . 'look/' . $look->id_look . '/' .prep_word_url($look->name) ?>">
						<span class="right">
							<span class="center">
								<span class="linebox bigpadding">
										<h2><?= $look->name ?></h2>
										<small><?= prep_cost($look->cost, true, false) ?></small>
								</span>
							</span>
						</span>
					</a>
				</div>
			</div>
			<? endif ?>

			<? if( isset($looks[++$count])): $look = $looks[$count]; ?>

			<div class="col-sm-4 height1 hidden-xs">
			</div>
			<div class="col-sm-4 height3">
				<div class="cover style3 product-preview" style="background-image:url(<?= thumb($look->file, 370,572) ?>);">
					<a href="<?= base_url() . 'look/' . $look->id_look . '/' .prep_word_url($look->name) ?>">
						<span class="bottom">
							<span class="center">
								<span class="linebox bigpadding">
											<h2><?= $look->name ?></h2>
										<small><?= prep_cost($look->cost, true, false) ?></small>
								</span>
							</span>
						</span>
					</a>
				</div>
			</div>
			<? endif ?>
			<? if( isset($looks[++$count])): $look = $looks[$count]; ?>
			<div class="col-sm-4 height3 magicclear1">
				<div class="cover style3 product-preview" style="background-image:url(<?= thumb($look->file, 370,572) ?>);">
					<a href="<?= base_url() . 'look/' . $look->id_look . '/' .prep_word_url($look->name) ?>">
						<span class="bottom">
							<span class="center">
								<span class="linebox bigpadding">
												<h2><?= $look->name ?></h2>
										<small><?= prep_cost($look->cost, true, false) ?></small>
								</span>
							</span>
						</span>
					</a>
				</div>
			</div>
			<div class="col-sm-4 height1 magicclear1 text-no-mobile">
				<div class="sepia style1">
					<a href="https://www.facebook.com/tiendasanaangulo" target="_blank">
						<span class="middle">
							<span class="center">
									<small>Síguenos en</small>
									<h2 class="mbot10">Facebook</h2>
								<span class="btn btn-line">
									<i class="fa fa-facebook"></i>
								</span>
							</span>
						</span>
					</a>
				</div>
			</div>
			<? endif ?>
			<? if( isset($looks[++$count])): $look = $looks[$count]; ?>
			<div class="col-sm-8 height1">
				<div class="cover style3 product-preview" style="background-image:url(<?= thumb($look->file, 794,300) ?>);">
					<a href="<?= base_url() . 'look/' . $look->id_look . '/' .prep_word_url($look->name) ?>">
						<span class="right">
							<span class="center">
								<span class="linebox bigpadding">
										<h2><?= $look->name ?></h2>
										<small><?= prep_cost($look->cost, true, false) ?></small>
								</span>
							</span>
						</span>
					</a>
				</div>
			</div>
			<? endif ?>
			<? if( isset($looks[++$count])): $look = $looks[$count]; ?>
			<div class="col-sm-4 height3">
				<div class="cover style3 product-preview" style="background-image:url(<?= thumb($look->file, 370,572) ?>);">
					<a href="<?= base_url() . 'look/' . $look->id_look . '/' .prep_word_url($look->name) ?>">
						<span class="bottom">
							<span class="center">
								<span class="linebox bigpadding">
										<h2><?= $look->name ?></h2>
										<small><?= prep_cost($look->cost, true, false) ?></small>
								</span>
							</span>
						</span>
					</a>
				</div>
			</div>
			<? endif ?>
			<? if( isset($looks[++$count])): $look = $looks[$count]; ?>
			<div class="col-sm-8 height1">
				<div class="cover style3 product-preview" style="background-image:url(<?= thumb($look->file, 794,300) ?>);">
					<a href="<?= base_url() . 'look/' . $look->id_look . '/' .prep_word_url($look->name) ?>">
						<span class="right">
							<span class="center">
								<span class="linebox bigpadding">
										<h2><?= $look->name ?></h2>
										<small><?= prep_cost($look->cost, true, false) ?></small>
								</span>
							</span>
						</span>
					</a>
				</div>
			</div>
			<? endif ?>
			<? if( isset($looks[++$count])): $look = $looks[$count]; ?>
			<div class="col-sm-4 height3">
				<div class="cover style3 product-preview" style="background-image:url(<?= thumb($look->file, 370,572) ?>);">
					<a href="<?= base_url() . 'look/' . $look->id_look . '/' .prep_word_url($look->name) ?>">
						<span class="middle">
							<span class="center">
								<span class="linebox bigpadding">
										<h2><?= $look->name ?></h2>
										<small><?= prep_cost($look->cost, true, false) ?></small>
								</span>
							</span>
						</span>
					</a>
				</div>
			</div>
			<div class="col-sm-4 height3 xs-height1 text-no-mobile">
				<div class="sepia style1">
					<a href="https://instagram.com/anaanguloboutique" target="_blank">
						<span class="middle">
							<span class="center">
									<small>Síguenos en</small>
									<h2 class="mbot10">Instagram</h2>
								<span class="btn btn-line">
									<i class="fa fa-instagram"></i>
								</span>
							</span>
						</span>
					</a>
				</div>
			</div>
			<? endif ?>

			<? if( isset($looks[++$count])): $look = $looks[$count]; ?>
			<div class="col-sm-4 height3 magicclear1">
				<div class="cover style3 product-preview" style="background-image:url(<?= thumb($look->file, 370,572) ?>);">
					<a href="<?= base_url() . 'look/' . $look->id_look . '/' .prep_word_url($look->name) ?>">
						<span class="middle">
							<span class="center">
								<span class="linebox bigpadding">
										<h2><?= $look->name ?></h2>
										<small><?= prep_cost($look->cost, true, false) ?></small>
								</span>
							</span>
						</span>
					</a>
				</div>
			</div>
			<? endif ?>
			<? if( isset($looks[++$count])): $look = $looks[$count]; ?>
			<div class="col-sm-8 height1">
				<div class="cover style3 product-preview" style="background-image:url(<?= thumb($look->file, 794,300) ?>);">
					<a href="<?= base_url() . 'look/' . $look->id_look . '/' .prep_word_url($look->name) ?>">
						<span class="right">
							<span class="center">
								<span class="linebox bigpadding">
										<h2><?= $look->name ?></h2>
										<small><?= prep_cost($look->cost, true, false) ?></small>
								</span>
							</span>
						</span>
					</a>
				</div>
			</div>
			<? endif ?>

			

		</div>
		<div class="clearfix"></div>
	</div>

</div>
<? if(count($looks)>8): ?>
<div class="text-center go-top margin-bottomXL">
  <a class="fa-stack fa-lg go-to-top">
    <i class="fa fa-circle-thin fa-stack-2x"></i>
    <i class="fa fa-angle-up fa-stack-1x"></i>
  </a>
</div>
<? endif ?>

<script>
$(document).ready(function(){
  $('.go-to-top').click(function(e){
    $("html, body").animate({ scrollTop: 0 }, 500);
  });  
	if($(window).width()>1199) return;
	$('.row.looks .product-preview').click(function(event) {
		if($(this).hasClass('hhover')) return;
	  event.preventDefault();
	  $('.row.looks .product-preview.hhover').removeClass('hhover');
	  $(this).addClass('hhover');
	});
})
</script>
<?php $this->load->view('common/footer') ?>