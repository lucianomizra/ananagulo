<?php if(!AJAX) $this->load->view('common/header') ?>
<? $slide = $this->Data->SlideReductions(); ?>
<div id="page-info" data-section="home"></div>
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
<div id="page-info" data-section="products"></div>
<div class="container">
  <div class="page-header style3 page-header-ttt ttt-reductions">
    <h2>Nuestras rebajas</h2>
  </div>
  <div class="page-login">
    <div class="row row-products-filter">
      <? $this->load->view('reductions/filters') ?>
    </div>
    <div class="base-product-list">
    <? $this->load->view('reductions/list') ?>
    </div>
    <? if($totalProducts>$this->Data->init+$search->filter->show && $search->filter->show != 100):?>
    <div class="text-center go-top load-more-items">
      <a href="<?= base_url() ?>rebajas/<?= $questURI ? $questURI : 'show:16' ?>/<?= $this->Data->init + $search->filter->show ?>">
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
<script>
$(document).ready(function() {
  <? if(str_replace('reductions:1_show:15','',$questURI)): ?>
  setTimeout(function(){
    $("html, body").animate({ scrollTop: $('.row-products-filter').offset().top - 150 }, 300);
  },1000);    
  <? endif ?>
});
var prepareProducts = function(){
  $('.products-listx .product-list-item:not(.rendered)').each(function(index,item){
    $(item).addClass('rendered');
    $('.sizes .btn', item).click(function(e){
      if($(this).hasClass('active'))
      {
        $('.sizes .btn', item).removeClass('active');
        return;        
      }
      $('.sizes .btn', item).removeClass('active');
      $(this).addClass('active');
    });
    $('.colorpiker-btngroup .btn', item).click(function(e){
      if($(this).hasClass('active'))
      {
        $('.colorpiker-btngroup .btn', item).removeClass('active');
        return;        
      }
      $('.colorpiker-btngroup .btn', item).removeClass('active');
      $(this).addClass('active');
    });
    $('.add-to-cart', item).click(function(e){
      var $ths = $(this);
      e.preventDefault();
      if($ths.hasClass('in-cart')) return;
      $ths.addClass('in-cart');
      var data = {};
      data.id = $ths.attr('data-id');
      $.ajax({
        dataType: "html",
        type: "POST",
        url: '<?= base_url() ?>cart/add',
        data: data,
        success: function(html){
          App.refreshCart();
        }
      });
    }); 
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
  prepareProducts();
});
</script>
<?php $this->load->view('common/footer') ?>