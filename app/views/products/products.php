<?php if(!AJAX) $this->load->view('common/header') ?>
<div id="page-info" data-section="products"></div>
<div class="container">
  <div class="page-login">
    <div class="row row-products-filter">
      <? $this->load->view('products/filters') ?>
    </div>
    <div class="base-product-list">
    <? $this->load->view('products/list') ?>
    </div>
    <? if($totalProducts>$this->Data->init+$search->filter->show && $search->filter->show != 100):?>
    <div class="text-center go-top load-more-items">
      <a href="<?= base_url() ?>productos/<?= $questURI ? $questURI : 'show:16' ?>/<?= $this->Data->init + $search->filter->show ?>">
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
var prepareProducts = function(){
  $('.products-list .product-list-item:not(.rendered)').each(function(index,item){
    $(item).addClass('rendered');
    if($(window).width()<=1199)
    {      
      $('a', item).click(function(event) {
        if($(item).hasClass('hhover')) return;
        event.preventDefault();
        $('.products-list .product-list-item.hhover').removeClass('hhover');
        $(item).addClass('hhover');
      });
    }
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
      if($('.colorpiker-btngroup .btn.active', item).length)
        data.color = $('.colorpiker-btngroup .btn.active', item).attr('data-value');
      if($('.sizes .btn.active', item).length)
        data.size = $('.sizes .btn.active', item).attr('data-value');
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
      $('.products-list .product-list-item', html).appendTo($('.base-product-list .products-list'));
      if(!$('.load-more-items', html).length || !$('.products-list .product-list-item', html).length)
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