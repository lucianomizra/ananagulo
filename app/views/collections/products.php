<?php if(!AJAX) $this->load->view('common/header') ?>
<? $slide = $this->Data->SlideCollections(); ?>
<div id="page-info" data-section="home"></div>
<? if($collection): ?>
<div class="page-header phb header-basic">
  <ol class="breadcrumb pull-left"> 
    <li class="section"><?= $collection->collection ?></li>
  </ol>
  <div class="clearfix"></div>
</div>
<? endif ?>
<? if(count($slide)): ?>
<div class="col-md-12 no-padding inside-menu collections-slide">
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
<? if($collection): ?>
<div id="page-info" data-section="products"></div>
<div class="container">
  <div class="page-header style3 page-header-ttt phmoved">
    <h2><?= $collection->collection ?></h2>
    <p><?= nl2br($collection->description) ?></p>
  </div>
  <div class="page-login">
    <div class="row row-products-filter base-list">
      <? $this->load->view('collections/filters') ?>
    </div>
    <div class="header-new-post"></div>
    <div class="base-product-list">
    <? $this->load->view('collections/list') ?>
    </div>
    <div class="go-top go-top-fixed"><img src="<?= layout('imgs/ico/subir.png') ?>"></div>
    <? if($totalProducts>$this->Data->init+$search->filter->show && $search->filter->show != 100):?>
    <div class="text-center go-top load-more-items">
      <a href="<?= base_url() ?>colecciones/<?= $questURI ? $questURI : 'show:15' ?>/<?= $this->Data->init + $search->filter->show ?>">
        <span>Ver más</span>
        <div class="fa-stack fa-lg">
          <i class="fa fa-circle-thin fa-stack-2x"></i>
          <i class="fa fa-plus-square-o fa-stack-1x"></i>
        </div>
      </a>
    </div>
    <? endif ?>
  </div>  
</div>
<? endif ?>
<script>
$(document).ready(function() {
  <? if(str_replace('collection:'. $collection->id_collection . '_show:15', '', $questURI)): ?>
  setTimeout(function(){
    $("html, body").animate({ scrollTop: $('.row-products-filter').offset().top - 150 }, 300);
  },1000);    
  <? endif ?>
  if($(window).width()<500)
  {
    $('.phmoved').appendTo('.header-new-post');
  }
});
var prepareProducts = function(){
  $('.products-listx .product-list-itemx .product-preview:not(.rendered)').each(function(index,item){
    if($(window).width()<=1199)
    {      
      $('a', item).click(function(event) {
        if($(item).hasClass('hhover')) return;
        event.preventDefault();
        $('.products-listx .product-list-itemx .product-preview.hhover').removeClass('hhover');
        $(item).addClass('hhover');
      });
    }
    $(item).addClass('rendered');
  });
};
$('.load-more-items a').click(function(e){
  var ths = $(this);
  e.preventDefault();
  $.ajax({
    dataType: "html",
    type: "POST",
    url: ths.attr('href'),
    success: function(html){
      $('.products-listx .product-list-itemx', html).appendTo($('.base-product-list .products-listx'));
      if(!$('.load-more-items', html).length || !$('.products-listx .product-list-itemx', html).length)
      {
        $('.load-more-items').css('display','none');
      }
      else
      {
        ths.attr('href', $('.load-more-items a', html).attr("href"));        
      }      
      prepareProducts();
    }
  });
  return false;
});
$(document).ready(function($) {
  $('.go-top-fixed').click(function(event) {    
    $("html, body").animate({ scrollTop: 0 }, 500);
  });
  prepareProducts();
});
</script>
<?php $this->load->view('common/footer') ?>