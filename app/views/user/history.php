<?php if(!AJAX) $this->load->view('common/header') ?>
<div id="main-content">
  <div class="container widget-user">
    <ul class="breadcrums b-brown-cat">
      <li><a class="app-loader" href="<?= base_url() ?>">Home</a></li>
      <li class="divider">|</li>
      <li><a class="app-loader" href="<?= base_url() ?>user">Mi cuenta</a></li>
      <li class="divider">|</li>
      <li><a class="app-loader" href="<?= base_url() ?>user/history">Historial de pedidos</a></li>
    </ul>
    <div class="head-breadcrumb">
      <div class="container">
        <h1><a class="app-loader" href="<?= base_url() ?>user/history">HISTORIAL DE PEDIDOS</a></h1>
      </div>
    </div>
    <section class="widget-user-history">
      <div class="container">
        <p class="labelx">Esta es la lista de pedidos (ordenados por fecha) que has realizado en los últimos 90 días. Hacé click en el número de pedido para verlo o realizar modificaciones si el pedido se encuentra en estado “Pendiente de pago” o en “Pago confirmado”.</p>
        <div class="list-carts">
          <div class="list-carts-head">
            <div class="col date">FECHA</div>
            <div class="col">Nº PEDIDO</div>
            <div class="col">ESTADO</div>
            <div class="col">TOTAL</div>
          </div>
          <? $carts = $this->Cart->GetCarts(); ?>
          <? if(!count($carts)):?>
          <div class="list-carts-no-items">No tenés pedidos realizados</div>
          <? else: ?>
          <? foreach($carts as $c): 
          $dataC = $this->Cart->ListItemsX($c->id_cart);  
          ?>
          <div class="list-carts-items">
            <div class="col date"><?= date('d/m/Y H:i:s', mysql_to_unix($c->modified)) ?></div>
            <div class="col code"><span><?= str_pad($c->id_cart, 6, "0", STR_PAD_LEFT) ?></span></div>
            <div class="col"><?= $c->state ?></div>
            <div class="col"><?= prep_cost($c->total, true, false); ?></div>
            <div style="clear:both"></div>
            <div class="close-button"><a class="bt">CERRAR DETALLE</a></div>
            <table class="table-checkout">
              <thead>
                <tr>
                  <th style="text-align:left">Producto seleccionado</th>
                  <th>Código</th>
                  <th>Precio unitario</th>
                  <th>Cantidad</th>
                  <th>Subtotal</th>
                </tr>
              </thead>
              <tbody>
            <? 
              $subtotal =  0; 
              $shipping =  0; 
              foreach($dataC as $item) : 
              $itemUriName = prep_word_url($item->name);
              $itemCost = prep_cost($item->cost, true, true);
              $itemCostST = prep_cost($item->cost * round($item->items), true, false);
              if( $item->id_state == 1 )
                $subtotal += $item->cost * round($item->items);
              $inCart = $this->Cart->ItemExists($item->id, 0, 0); 
              $inWish = $this->Wish->ItemExists($item->id); 
              $pcolors = $this->Data->ProductColors( $item->id );
              ?>
                <tr data-id="<?= $item->iditem ?>" class="tr-item <? if($item->id_state != 1): ?>no-stock<? endif ?>">
                  <td>
                    <div class="item-product">
                      <p><?= $item->name ?><span><?= nl2br($item->description) ?></span><? if($item->dimensions): ?><span><?= $item->dimensions ?></span><? endif ?><? if($item->weight): ?><span><?= $item->weight ?></span><? endif ?></p>                  
                    </div>
                  </td>
                  <td><?= $item->code ?></td>
                  <td style="max-width:150px">
                    <div class="price">
                      <?= $itemCost ?>
                    </div>
                  </td>
                  <td class="td-quantity">
                    <span class="items-num"><?= round($item->items) ?></span>
                  </td>
                  <td style="max-width:150px"><? if($item->id_state != 1): ?>
                    <span class="price"><?= $item->state ?></span>
                    <span class="obs">En cuanto esté disponible su producto nos pondremos en contacto.</span>              
                    <? else: ?>
                    <span class="price"><?= $itemCostST ?></span>
                    <? endif ?>
                  </td>
                </tr>
                <? endforeach ?>  
              </tbody>
            </table>  
            <div class="checkout">
              <div class="checkout-total">
                <div class="checkout-total-box">
                  <? if(round($c->desc1 + $c->desc2) > 0): ?>
                  <div class="checkout-total-row">
                    <div class="checkout-total-col">                  
                      Subtotal
                    </div>
                    <div class="checkout-total-col">         
                      <?= prep_cost($c->subtotal, true, false); ?>
                    </div>
                  </div>
                  <div class="checkout-total-row">
                    <div class="checkout-total-col">                  
                      Descuento
                    </div>
                    <div style="color:#1AA8C4" class="checkout-total-col">                  
                     - <?= prep_cost($c->desc1 + $c->desc2, true, false); ?>
                    </div>
                  </div>
                  <? endif ?>
                  <div class="checkout-total-row row-total">
                    <div class="checkout-total-col">                  
                      Total:
                    </div>
                    <div class="checkout-total-col">
                      <?= prep_cost($c->total, true, false); ?>              
                    </div>
                  </div>
                </div>            
              </div>            
            </div>            
          </div>
          <? endforeach ?>
          <? endif ?>
        </div>
      </div>
    </section>
  </div>
</div>
<script>
$(document).ready(function() {
  $("html, body").animate({ scrollTop: $('.widget-user-history').offset().top - 50 }, 0);

  $('.widget-user-history .list-carts .list-carts-items').each(function(index,item){
    $('.close-button', item).click(function(){
      $(item).removeClass('active');      
    });
    $('.col.code', item).click(function(){
      $(item).addClass('active');      
    });    
  });  
  $('#nav .nav-menu li').removeClass('active');
});
</script>
<?php $this->load->view('common/footer') ?>
