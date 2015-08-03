<?
$cartItems = $this->model->ListItemsCart()
?>
<section style="margin:0 16px" class="checkout">
    <? if(!count($cartItems)) : ?>
    <div class="checkout-no-elements">No hay productos agregados a la lista de compras</div>
    <? else : ?>
    <table style="margin-top:0" id="checkout" class="table-checkout">
      <thead>
        <tr>
          <th style="max-width:300px;text-align:left">Producto</th>
          <th>Código</th>
          <th>Color</th>
          <th>Precio unitario</th>
          <th>Cantidad</th>
          <th>Subtotal</th>
        </tr>
      </thead>
      <tbody>
    <? 
      $subtotal =  0; 
      $shipping =  0; 
      foreach($cartItems as $item) : 
      $itemUriName = prep_word_url($item->name);
      $itemCost = $this->model->prep_cost($item->cost, true, true);
      $itemCostST = $this->model->prep_cost($item->cost * round($item->items), true, false);
      if( $item->id_state == 1 )
        $subtotal += $item->cost * round($item->items);
      $pcolors = $this->model->ProductColors( $item->id );
      ?>
        <tr data-id="<?= $item->iditem ?>" class="tr-item <? if($item->id_state != 1): ?>no-stock<? endif ?>">
          <td style="max-width:300px;text-align:left">
            <div class="item-product">
              <? if($item->file):?><a href="<?= base_url() ?>products/index/element/<?= $item->id ?>" target="_blank"><img src="<?= thumb($item->file, 150, 120) ?>"/></a><? endif ?>
              <p><?= $item->name ?><span><?= nl2br($item->description) ?></span><? if($item->dimensions): ?><span><?= $item->dimensions ?></span><? endif ?><? if($item->weight): ?><span><?= $item->weight ?></span><? endif ?></p>                  
            </div>
          </td>
          <td><?= $item->code ?></td>
          <td class="td-colors"><? if( count($pcolors) ): ?>
          <span class="colors-container"><? $first = true; foreach($pcolors as $color): if($item->id_color == $color->id):?><span data-color-id="<?= $color->id ?>" data-action="color" class="color-item-c <?= ($item->id_color == $color->id || (!$item->id_color && $first ) ) ? "selectedxx" : "" ?>"><span class="color-item tooltip-nz-app ttactive" style="background:<?= $color->value ?>" data-title="<?= $color->color ?>"><i class="fa fa-chevron-right"></i></span></span><? $first = false; endif; endforeach ?></span>          
        <? else: ?>-<? endif ?></td>
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
    <div class="checkout-total">
      <? 
        $this->load->view('sales/index/cart-summary', array(
        'subtotal' => $dataItem['subtotal'],
        'shipping' => $dataItem['shipping'],
        'tax' => $dataItem['tax'],
        'desc1' => $dataItem['desc1'],
        'desc2' => $dataItem['desc2'],
        'total' => $dataItem['total']
      ));?>
    </div>
    <? endif ?>

</section>