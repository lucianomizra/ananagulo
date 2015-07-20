<?php if(!AJAX) $this->load->view('common/header') ?>
<? 
if(round($product->cost2) == round($product->cost)) $product->cost2 = 0;
$colors = $this->Data->ProductColors($product->id);
$cares = $this->Data->ProductCares($product->id);
$inCart = $this->Cart->ItemExists($product->id, 0, 0); 
?>
<div id="page-info" data-section="look1"></div>
<div class="container">
  <div class="page-product row-products-filter">
    <div class="page-header phb">
      <ol class="breadcrumb pull-left">
      <?/*
        <li><a href="#">Looks</a></li>
        <li><a href="#">Nombre del look</a></li>
        <li class="active">Nombre del producto</li>
      */?>
        <li><a href="<?= base_url() ?>">Ana Angulo</a></li>
        <li class="section section-base"><a href="<?= base_url() ?>productos/categoryp:<?= $product->id_category ?>_show:16"><?= $product->department ?></a></li>
        <? if($product->sub): ?>
        <li class="section section-sub"><a href="<?= base_url() ?>productos/categoryp:<?= $product->id_category ?>_category:<?= $product->id_sub ?>_show:16"><?= $product->sub ?></a></li>
        <? endif ?>
        <li class="active"><?= $product->name ?></li>
      </ol>
      <?/*
      <div class="pull-right">
        Otros looks
        Otros looks
        <a class="disabled" href="#"><span class="glyphicon glyphicon-triangle-left"></span></a>
        <a href="#"><span class="glyphicon glyphicon-triangle-right"></span></a>
      </div>
      */?>
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
                  <li><img src="<?= thumb($product->file, 509, 755) ?>" data-zoom-image="<?= thumb($product->file, 1024, 1269) ?>"  /></li>
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
                  <li><div style="background-image:url('<?= thumb($product->file, 150, 130) ?>');"></div></li>
                  <? endif ?>
                </ul>
               </div>
            </section>
        </div>
        <div class="col-sm-6 col-lg-7 col-xs-12">
          <div class="box-product">
            <div class="product-title"><h2><?= $product->name ?></h2></div>
            <? if($product->code): ?><div class="product-reference">REF. <?= $product->code ?></div><? endif ?>
            <div class="product-price">
              <? if(round($product->cost2)): ?><span class="sale"><?= prep_costF($product->cost2, true, false) ?></span><? endif ?>
              <span><?= prep_costF($product->cost, true, false) ?></span>
            </div>
            <? if($product->description): ?>
            <div class="product-description">
              <p><?= nl2br($product->description) ?></p>
            </div><? endif ?>
            <div class="product-controls margin-bottom">
              
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
              </div>
            <? if($product->details || count($cares)): ?>
              <div class="txtinfo compo-product"><a  data-toggle="collapse" href="#careandcomposition_1" aria-expanded="false" aria-controls="careandcomposition_1">Cuidados y composición</a></div>


                  <div class="careandcomposition collapse" id="careandcomposition_1">
                    <button class="btn-close" type="button" data-toggle="collapse" href="#careandcomposition_1" aria-expanded="false" aria-controls="careandcomposition_1">
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

              <a href="<?= base_url() . 'cart/add/' . $product->id ?>" class="btn btn-primary btn-block buy-item">Comprar</a>
              <div class="srow">
                <div class="col-sm-6">
                <a class="btn btn-block btn-default add-to-cart<?= $inCart ? " in-cart" : "" ?>" data-id="<?= $product->id ?>"><span class="base">Añadir al carrito</span><span class="base-alt">En carrito</span></a></div>
                <div class="col-sm-6"><button class="btn btn-default btn-block open-guide">Guía de tallas</button></div>
              </div>
              
            </div>
            <div class="clearfix"></div>
            <div class="product-socialNetworks">
              <a href="http://rest.sharethis.com/v1/share/share?destination=facebook&url=<?= base_url() . "producto/{$product->id}" ?>&api_key=q2gcgywe7466wr2ycgxmm87n" target="_blank" class="btn btn-default"><i class="fa fa-facebook"></i></a>
              <a href="http://rest.sharethis.com/v1/share/share?destination=instagram&url=<?= base_url() . "producto/{$product->id}" ?>&api_key=q2gcgywe7466wr2ycgxmm87n" target="_blank" class="btn btn-default"><i class="fa fa-instagram"></i></a>
              <a href="http://rest.sharethis.com/v1/share/share?destination=twitter&url=<?= base_url() . "producto/{$product->id}" ?>&api_key=q2gcgywe7466wr2ycgxmm87n" target="_blank" class="btn btn-default"><i class="fa fa-twitter"></i></a>
            </div>            
          </div>
        </div>
      </div>
    </div>
    <? $this->load->view('widget/sizes') ?>
    <? if(count($simil)): ?>
    <div class="page-footer">
      <div class="page-header phscroll">
        <h3>Productos relacionados</h3>
      </div>
        <div class="row prelated">
        <? foreach($simil as $s): $itemUriName = prep_word_url($s->name);?>
          <div class="col-sm-3">
            <a href="<?= base_url() ?>producto/<?= $s->id ?>/<?= $itemUriName ?>" class="thumbnail product-preview style4">
              <? if($s->file): ?><img src="<?= thumb($s->file, 285, 436) ?>"><? endif ?>
              <div class="caption">
                <h2><?= $s->name ?></h2>
                <span><?= prep_costF($s->cost, true, false) ?></span>
              </div>
            </a>
          </div>
          <? endforeach ?>
        </div>
      </div>
      <? endif ?>
      <? /*if(count($looks)): ?>
      <div class="page-header">
        <h3>Otros looks</h3>
      </div>
        <div class="row">
        <? foreach($looks as $s): $itemUriName = prep_word_url($s->name);?>
          <div class="col-sm-3">
            <a href="<?= base_url() ?>look/<?= $s->id ?>/<?= $itemUriName ?>" class="thumbnail product-preview style4">
              <? if($s->file): ?><img src="<?= thumb($s->file, 285, 436) ?>"><? endif ?>
              <div class="caption">
                <h2><?= $s->name ?></h2>
                <span><?= prep_costF($s->cost, true, false) ?></span>
              </div>
            </a>
          </div><? endforeach ?>
      </div>
      <? endif*/ ?>
      <? if(count($productVisits)>1): ?>
      <div class="pvisits">
      <div class="page-header phscroll">
        <h3>Lo último visto</h3>
      </div>
        <div class="home-second-slider last-views">
          <ul class="slides">
              <? krsort($productVisits); foreach($productVisits as $p): 
              if($p == $product->id ) continue; 
              $s = $this->Data->GetProductVisits($p); 
              if(!$s) continue;
              $itemUriName = prep_word_url($s->name);?>
              <li>
                <a href="<?= base_url() ?>producto/<?= $s->id ?>/<?= $itemUriName ?>" class="thumbnail product-preview style4">
                <? if($s->file): ?><img src="<?= thumb($s->file, 285, 285) ?>"><? endif ?>
                  <div class="caption">
                <h2><?= $s->name ?></h2>
                <span><?= prep_costF($s->cost, true, false) ?></span>
                  </div>
                </a>
              </li><? endforeach ?>
          </ul>
        </div>
        </div>
      <? endif ?>
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
  var item = $('.page-product');

  $('.open-guide').click(function(e){
    $('.widget-sizes').css('display', 'block');
    $("html, body").animate({ scrollTop: $('.widget-sizes').offset().top - 120 }, 300);
  });
  $('.phscroll').click(function(e){
    if($(window).width()<500)
      $("html, body").animate({ scrollTop: $(this).offset().top -50 }, 500);
  });
  $('.go-to-top').click(function(e){
    $("html, body").animate({ scrollTop: 0 }, 500);
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
        //App.refreshCart();
      }
    });
  });
});
</script>
<?php $this->load->view('common/footer') ?>