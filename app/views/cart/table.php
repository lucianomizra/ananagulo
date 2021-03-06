
        <? if(!count($cartItems)) : ?>
        <div class="checkout-no-elements">No hay productos agregados a la cesta de compras</div> 
      <? else: ?>
      <table class="table table-list-cart table-list-cart-section">
                <thead>
                    <tr>
                        <th></th>
                        <th></th>
                        <th>Ref.</th>
                        <th>Tallas</th>
                        <th>Color</th>
                        <th>Unidades</th>
                        <th>Precio</th>
                        <? if(!isset($cartDisabled)): ?>
                        <th>Eliminar</th>
                        <? endif ?>
                    </tr>
                </thead>
                <? 
          $subtotal =  0; 
          $shipping =  0; 
          foreach($cartItems as $item) : 
          $itemUriName = prep_word_url($item->name);
          $itemCost = prep_cost($item->cost, true, false);
          $itemCostST = prep_cost($item->cost * round($item->items), true, false);
          if( $item->id_state == 1 )
            $subtotal += $item->cost * round($item->items);
          if( $item->id_state != 1 && isset($cartDisabled))
            continue;
          $inCart = $this->Cart->ItemExists($item->id, 0, 0); 
          $colors = $this->Data->ProductColors( $item->id );

          if(round($item->cost2) == round($item->cost)) $item->cost2 = 0;
          ?>
                    <tr data-value="<?= ($item->id_state == 1) ? $item->cost : 0 ?>" data-id="<?= $item->iditem ?>">
                        <th><img src="<?= thumb($item->file, 125, 125) ?>" /></th>
                        <th class="name"><a href="<?= base_url() . 'producto/' . $item->id . '/' . $itemUriName ?>"><?= $item->name ?></a><?/*<br><span class="desc"><?= nl2br($item->description) ?></span>*/?>
                        <div class="options-global options"></div>
                        </th>
                        <th class="cost"><div class="cc-move cc-move-nf"><?= $item->code ?> <?= ($item->id_state == 1) ?'<i class="success block">Disponible</i>' : '<i class="danger block">No disponible</i>' ?></div></th>
                        <th class="options">
                <div class="cc-move">
                <? $sizes = explode(',', $item->sizes) ?>
                <? if(count($sizes)> 1 || (count($sizes) == 1 && str_replace(' ', '', $sizes[0]))): ?>
             <select <?= isset($cartDisabled) ? "disabled='disabled' " : "" ?>class="item-size selectpicker" data-style="select-default" name="sizes" data-width="70px">
                <? foreach($sizes as $size): $size = mb_strtoupper(str_replace(' ', '', $size), 'UTF-8'); if(!$size) continue; ?>
                <option value="<?= $size ?>" <? if($size == $item->size): ?>selected="selected"<? endif ?>><?= $size ?></option>
                <? endforeach ?>
              </select>
                <? endif ?>
                </div>
            </th>
                        <th class="options options-colors">
                <div class="cc-move">
                <? if(count($colors)): ?>
                <select <?= isset($cartDisabled) ? "disabled='disabled' " : "" ?>class="item-color selectpicker" data-style="select-default" name="colors" data-showContent="true" data-width="70px">
                  <? foreach($colors as $c):?>
                  <option value="<?= $c->id ?>" data-content="<span class='btn circle' style='border:1px solid #CCC; background-color: <?= $c->value ?>;''></span>"<? if($c->id == $item->id_color): ?>selected="selected"<? endif ?>></option>
                  <? endforeach ?>
                </select>
                <? endif ?>
                </div>
                        </th>
                        <th class="options hidden-xs"><div class="cc-move"><input <?= isset($cartDisabled) ? "disabled='disabled' " : "" ?>class="form-control item-num" type="number" min="1" value="<?= round($item->items) ?>"></div></th>
                        <th class="cost"><?= $itemCost ?></th>
                        <? if(!isset($cartDisabled)): ?>
                        <th class="delete"><a href="<?= base_url() ?>cart/remove/<?= $item->iditem ?>"><i class="fa fa-times"></i></a></th>
                      <? endif ?>
                    </tr>


            <? endforeach ?>  
                 
                </tbody>
            </table> 
            <? 
            if(isset($cartDisabled) && isset($coupon1)) 
            {
              $cuponST = $subtotal * ($coupon1->value/100);
              $subtotal -= $cuponST; 
            } ?>
            <div class="total">
              <div class="pull-right">
                <p><span class="txt_total hsub">Subtotal_</span><span class="ff" id="subtotal"><?= prep_cost($subtotal/1.21, true, false); ?></span></p>
                <p><span class="txt_total hsub">IVA_</span><span class="ff" id="iva"><?= prep_cost($subtotal*.21/1.21, true, false); ?></span></p>
                <? if(isset($cartDisabled) && isset($coupon1)): ?>
                <p><span class="txt_total hsub">Cupon (<?= $coupon1->value ?>%)_</span><span class="ff" id="cupon">- <?= prep_cost($cuponST, true, false); ?></span></p>
                <? endif ?>
                <p><span class="txt_total hstyle1">Total_</span><span class="ff bb" id="total"><?= prep_cost($subtotal, true, false); ?></span></p>
                <div class="clearboth"></div>
              </div> 
            </div> 
            <div class="clearboth"></div>

      <? endif ?>
<script>

$(document).ready(function() {
  <? if(!isset($cartDisabled)): ?>
  $('.table-list-cart-section tr').each(function(index, item){
    var dataId = $(this).attr('data-id');
    if($(window).width()<500)
        $('.cc-move', item).appendTo($('.options-global', item));
    /*$('.cart-action', item).click(function(e){
      e.preventDefault();    
      var data = {}, action = $(this).attr('data-action');
      data.id = $(item).attr('data-id');
      if(action == 'color')
      {
        if($(this).hasClass('selected')) return false;
        data.color = $(this).attr('data-color-id');
      }
      $.ajax({
        dataType: "html",
        type: "POST",
        url: '<?= base_url() ?>cart/' + action,
        data: data,
        success: function(html){
          App.replaceHTML(html);
          App.refreshCart();
        }
      });
    });*/
    $('.item-num', item).change(function(e){  
      var data = {};
      data.id = dataId;
      data.items = $(this).val();
      $.ajax({
        dataType: "html",
        type: "POST",
        url: '<?= base_url() ?>cart/change-items',
        data: data,
        success: function(html){
          //App.replaceHTML(html);
          //App.refreshCart();
          var total = 0;
          $('.table-list-cart-section tbody tr').each(function(index, item){
            total += parseFloat($(item).attr('data-value')) * parseFloat($('.item-num', item).val());
          });
          $('#subtotal').html((total/1.21).toFixed(2) + '€');
          $('#iva').html((total*.21/1.21).toFixed(2) + '€');
          $('#total').html(total.toFixed(2) + '€');
        }
      });
    });
    $('.item-color', item).change(function(e){      
      var data = {};
      data.id = dataId;
      data.color = $(this).val();
      $.ajax({
        dataType: "html",
        type: "POST",
        url: '<?= base_url() ?>cart/color',
        data: data,
        success: function(html){
          //App.replaceHTML(html);
          //App.refreshCart();
        }
      });
    });
    $('.item-size', item).change(function(e){      
      var data = {};
      data.id = dataId;
      data.size = $(this).val();
      $.ajax({
        dataType: "html",
        type: "POST",
        url: '<?= base_url() ?>cart/size',
        data: data,
        success: function(html){
          //App.replaceHTML(html);
          //App.refreshCart();
        }
      });
    });
  });
  <? else: ?>
  
  $('.table-list-cart-section tr').each(function(index, item){
    var dataId = $(this).attr('data-id');
    if($(window).width()<500)
        $('.cc-move', item).appendTo($('.options-global', item));
  });
  <? endif ?>
});   
</script>