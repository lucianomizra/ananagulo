<?php if(!AJAX) $this->load->view('common/header') ?>
<div id="page-info" data-section="look1"></div>
<div class="container">
  <div class="page-look1 row-products-filter">
    <div class="page-header phb">
      <ol class="breadcrumb pull-left">
        <li><a href="<?= base_url() ?>">Ana Angulo</a></li>
        <li><a href="<?= base_url() ?>looks">Looks</a></li>
        <li class="active"><?= $look->name ?></li>
      </ol>

      <div class="pull-right">
        Otros looks
        <? if($lookPrev): ?><a href="<?= base_url() ?>look/<?= $lookPrev->id ?>/<?= prep_word_url($lookPrev->name) ?>"><span class="glyphicon glyphicon-triangle-left"></span></a><? else: ?><a class="disabled"><span class="glyphicon glyphicon-triangle-left"></span></a><? endif ?>
        <? if($lookNext): ?><a href="<?= base_url() ?>look/<?= $lookNext->id ?>/<?= prep_word_url($lookNext->name) ?>"><span class="glyphicon glyphicon-triangle-right"></span></a><? else: ?><a class="disabled"><span class="glyphicon glyphicon-triangle-right"></span></a><? endif ?>
      </div>
      <div class="clearfix"></div>
    </div>
    <div class="page-body">
      <div class="row">
        <div class="col-sm-6 col-lg-5 col-xs-12">
           <section class="product-gallery">
              <div class="flexslider" id="slider">
                <ul class="slides">
                  <? if(count($gallery)): ?>
                  <? foreach($gallery as $g):?>
                  <li><img src="<?= thumb($g->file, 509, 755) ?>" data-zoom-image="<?= thumb($g->file, 1024, 1269) ?>" /></li>
                  <? endforeach ?>        
                  <? else: ?>
                  <li><img src="<?= thumb($look->file, 509, 755) ?>" data-zoom-image="<?= thumb($look->file, 1024, 1269) ?>"  /></li>
                  <? endif ?>
                </ul>
              </div>
              <div class="flexslider" id="carousel">
                <ul class="slides">
                  <? if(count($gallery)): ?>
                  <? foreach($gallery as $g):?>
                  <li><div style="background-image:url('<?= thumb($g->file, 150, 130) ?>');"></div></li>
                  <? endforeach ?>        
                  <? else: ?>
                  <li><div style="background-image:url('<?= thumb($look->file, 150, 130) ?>');"></div></li>
                  <? endif ?>
                </ul>
               </div>
            </section>
        </div>
        <div class="col-sm-6 col-lg-7 col-xs-12">
          <div class="box-product">
            <div class="product-title"><h2><?= $look->name ?></h2></div>
            <div class="product-reference"><?= $look->code ?></div>
            <div class="product-price">
              <span><?= prep_costF($look->cost, true, false) ?></span>
            </div>
            <div class="product-description">
              <p><?= nl2br($look->description) ?></p>
            </div>
            <div class="product-controls margin-bottom">
              
              <button class="btn btn-primary btn-block" data-toggle="collapse" href="#collapseCustomLook" aria-expanded="false" aria-controls="collapseCustomLook">Quiero todo el look</button>
              <button class="btn btn-default btn-block one-product">Quiero un solo producto</button>
            </div>
            <div class="product-socialNetworks">
              <a href="http://rest.sharethis.com/v1/share/share?destination=facebook&url=<?= base_url() . "look/{$look->id}" ?>&api_key=q2gcgywe7466wr2ycgxmm87n" target="_blank" class="btn btn-default"><i class="fa fa-facebook"></i></a>
              <a href="http://rest.sharethis.com/v1/share/share?destination=instagram&url=<?= base_url() . "look/{$look->id}" ?>&api_key=q2gcgywe7466wr2ycgxmm87n" target="_blank" class="btn btn-default"><i class="fa fa-instagram"></i></a>
              <a href="http://rest.sharethis.com/v1/share/share?destination=twitter&url=<?= base_url() . "look/{$look->id}" ?>&api_key=q2gcgywe7466wr2ycgxmm87n" target="_blank" class="btn btn-default"><i class="fa fa-twitter"></i></a>
            </div>            

          <div class="the-look collapse" id="collapseCustomLook">
            <button class="btn-close" type="button" data-toggle="collapse" href="#collapseCustomLook" aria-expanded="false" aria-controls="collapseCustomLook">
              <span aria-hidden="true">&times;</span>
            </button>
            <div class="product-title"><h2>Tu Look completo</h2></div>
            <div class="panel-group" id="accordionCustomLooks" role="tablist" aria-multiselectable="true">
            <? $first = true; foreach($products as $product): 
            $colors = $this->Data->ProductColors($product->id);
            $cares = $this->Data->ProductCares($product->id);
            ?>
              <div data-id="<?= $product->id ?>" data-value="<?= prep_cost($product->cost, false, false) ?>" class="panel panel-default product-item">
                <div class="panel-heading" role="tab" id="heading-<?= $product->id ?>">
                  <h4 class="panel-title">
                    <a data-toggle="collapse" data-parent="#accordionCustomLooks" href="#accordion_<?= $product->id ?>" aria-expanded="<?= $first ? "true" : "false"?>" class="<?= $first ? "" : "collapsed"?>" aria-controls="accordion_<?= $product->id ?>">
                      <?= $product->name ?>
                    </a>
                  </h4>
                </div>
                <div id="accordion_<?= $product->id ?>" class="panel-collapse collapse<?= $first ? " in" : "" ?>" role="tabpanel" aria-labelledby="heading-<?= $product->id ?>">
                  <div class="panel-body">
                    <div class="row">
                      <div class="col-xs-3">
                    <div class="figure">
                      <img src="<?= thumb($product->file2 ? $product->file2 : $product->file, 123, 152) ?>" />
                    </div>
                      </div>
                      <div class="col-xs-9">
                      <div class="pull-right"><a class="txtinfo remove-item">Quitar del look</a></div>
                      <div class="product-selects">
                        <? if(count($colors)): ?>
                        <div class="btn-group colorpiker-btngroup margin-bottom" role="group">
                          <? $first = true; foreach($colors as $c):?>
                          <button type="button" data-value="<?= $c->id ?>" style="background-color:<?= $c->value?>" class="btn btn-default<?= $first ? " active" : "" ?>"></button>
                          <? $first = false; endforeach ?>
                        </div>
                        <? endif ?>
                        <div class="clearfix"></div>

                        <div class="btn-group margin-bottom sizes product-sizes" role="group">
                          <? $sizes = explode(',', $product->sizes) ?>
                          <? $first = true; foreach($sizes as $size): $size = mb_strtoupper(str_replace(' ', '', $size), 'UTF-8'); if(!$size) continue; ?>
                          <button type="button" data-value="<?= $size ?>" class="btn btn-default<?= $first ? " active" : "" ?>"><?= $size ?></button>
                          <? $first = false; endforeach ?>
                        </div>

                        <div class="product-price">
                          <span><?= prep_costF($product->cost, true, false) ?></span>
                        </div>
                      </div>
               <? if($product->details || count($cares)): ?>
              <div class="txtinfo compo-product"><a  data-toggle="collapse" href="#careandcomposition_<?= $product->id ?>" aria-expanded="false" aria-controls="careandcomposition_<?= $product->id ?>">Cuidados y composición</a></div>


                  <div class="careandcomposition collapse" id="careandcomposition_<?= $product->id ?>">
                    <button class="btn-close" type="button" data-toggle="collapse" href="#careandcomposition_<?= $product->id ?>" aria-expanded="false" aria-controls="careandcomposition_<?= $product->id ?>">
                  <span aria-hidden="true">&times;</span>
                </button>
                    <div class="row">
                      <? if($product->details): ?>
                      <div class="col-xs-5">
                        <h3>Composción</h3>
                        <p><?= nl2br($product->details) ?></p>
                      </div>
                      <? endif ?>

                      <? if(count($cares)): ?>
                      <div class="col-xs-7">
                        <h3>Cuidados</h3>
                        <? foreach($cares as $c):?>
                        <p><?= img(upload($c->file)) ?><?= $c->care ?></p>
                        <? endforeach ?>
                      </div> 
                      <? endif ?>
                    </div>
                  </div>
                  <? endif ?>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <? $first = false; endforeach ?>
     
            </div>

            <div class="row">
                <div class="col-xs-12">
                  <div class="product-price"><span>Total: <span id="totalLook"><?= prep_cost($look->cost, false, false) ?></span>€</span></div>
                  <div class="col-sm-offset-3 col-sm-6" style="margin-top: 40px;">
                    <button class="btn btn-block btn-default open-guide">Guía de tallas</button>
                    <button class="btn btn-block btn-primary button-buy">Comprar</button>
                  </div>
                </div>
              </div>
            </div>


          </div>
        </div>
      </div>
    </div>
    
    <? $this->load->view('widget/sizes') ?>

    <?php $this->load->view('looks/list') ?>

</div>

<div class="text-center go-top margin-bottomXL">
  <a class="fa-stack fa-lg go-to-top">
    <i class="fa fa-circle-thin fa-stack-2x"></i>
    <i class="fa fa-angle-up fa-stack-1x"></i>
  </a>
</div>
<script>
$(document).ready(function() {
  var fnTotal = function(){
    var total = 0;
    $('#accordionCustomLooks .product-item').each(function(index, item) {
      if($(item).hasClass('removed')) return;
      total += parseFloat($(item).attr('data-value'));
    });
    $('#totalLook').html(total.toFixed(2));
  }
  $('#accordionCustomLooks .product-item').each(function(index, item) {
    $('.remove-item', item).click(function(){
      if($(item).hasClass('removed'))
      {
        $(item).removeClass('removed');
        $('.remove-item', item).html('Quitar del look');
        fnTotal();
        return;
      }
      $(item).addClass('removed');
      $('.remove-item', item).html('Agregar al look');
      fnTotal();
    });
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
  });
  $('.button-buy').click(function(e){
    var max = $('#accordionCustomLooks .product-item:not(.removed)').length;
    if(!max) return;
    $('#accordionCustomLooks .product-item:not(.removed)').each(function(index, item) {
      var $ths = $(this);
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
          if(index == max - 1)
          {
            window.location.href = "<?= base_url()  ?>cart";
          }
        }
      });
    });
  });  

  $('.open-guide').click(function(e){
    $('.widget-sizes').css('display', 'block');
    $("html, body").animate({ scrollTop: $('.widget-sizes').offset().top - 120 }, 300);
  });
  $('.go-to-top').click(function(e){
    $("html, body").animate({ scrollTop: 0 }, 500);
  });  
  $('.one-product').click(function(e){
    $("html, body").animate({ scrollTop: $('.page-footer').offset().top - 120 }, 500);
  });  
});
</script>
<?php $this->load->view('common/footer') ?>