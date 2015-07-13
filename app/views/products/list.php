<div class="row products-list">
  <? foreach($productsSearch as $item) : 
    $itemUriName = prep_word_url($item->name);
    $inCart = $this->Cart->ItemExists($item->id, 0, 0); 
    $itemCost = prep_cost($item->cost, true, false);
    if(round($item->cost2) == round($item->cost))
      $item->cost2 = 0;
    $colors = $this->Data->ProductColors($item->id);
    ?>
  <div class="col-sm-3 product-list-item">
      <div class="cover style3 product-preview" style="background-image:url('<?= thumb($item->file, 386, 450) ?>')">
      <? if($item->id_state != 1): ?>
      <span class="badge badge-outstock"><?= $item->state ?></span>
      <? elseif(round($item->cost2) && ($perc = round(($item->cost2-$item->cost)/$item->cost2*100)) >= 5): ?>        
      <span class="badge badge-discount rbadge-discount"><?= $perc ?>%</span>
      <? elseif(time() - mysql_to_unix($item->date) < 60 * 60 * 24 * 30): ?>
      <span class="badge badge-new">NUEVO</span>
      <? endif ?>
      <div class="bottom">
      <span class="center">
        <p class="name"><?= $item->name ?></p>
        <span class="linebox bigpadding">
          <div class="btn-group sizes" role="group">
            <? $sizes = explode(',', $item->sizes) ?>
            <? foreach($sizes as $size): $size = mb_strtoupper(str_replace(' ', '', $size), 'UTF-8'); if(!$size) continue; ?>
            <button type="button" data-value="<?= $size ?>" class="btn btn-default<? if(isset($search->filter->size) && $search->filter->size == $size): ?> active<? endif ?>"><?= $size ?></button>
            <? endforeach ?>
          </div>
          <? if(count($colors)): ?>
          <div class="btn-group colorpiker-btngroup margin-top margin-bottom" role="group">
            <? foreach($colors as $c):?>
            <button type="button" data-value="<?= $c->id ?>" style="background-color:<?= $c->value?>" class="btn btn-default<? if(isset($search->filter->color) && $search->filter->color ==$c->id): ?> active<? endif ?>"></button>
            <? endforeach ?>
          </div>
          <? endif ?>
          <a class="btn btn-block btn-default add-to-cart<?= $inCart ? " in-cart" : "" ?>" data-id="<?= $item->id ?>"><span class="base">Comprar</span><span class="base-alt">En carrito</span></a>
          <a href="<?= base_url() ?>producto/<?= $item->id ?>/<?= $itemUriName ?>" class="btn btn-block btn-default">Ver detalles</a>
        </span>
      </span>
      </div>
      <a href="<?= base_url() ?>producto/<?= $item->id ?>/<?= $itemUriName ?>" class="full-button"></a>
    </div>
  </div>
  <? endforeach ?>
</div>