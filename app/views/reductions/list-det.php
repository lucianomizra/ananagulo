<? $itemUriName = prep_word_url($item->name);
    $inCart = $this->Cart->ItemExists($item->id, 0, 0); 
    $itemCost2 = prep_cost($item->cost2, true, false);
    $itemCost = prep_cost($item->cost, true, false);
?><div class="cover style3 product-preview" style="background-image:url('<?= (isset($szx) && $szx)? thumb($item->file, 590, 620) : thumb($item->file, 285, 300) ?>')">
    <? if(round($item->cost2) && ($perc = round(($item->cost2-$item->cost)/$item->cost2*100)) >= 5): ?>        
      <span class="badge badge-discount rbadge-discount"><?= $perc ?>%</span>
    <? endif ?>
<a href="<?= base_url() ?>producto/<?= $item->id ?>/<?= $itemUriName ?>" class="full-button"></a>
  <a href="<?= base_url() ?>producto/<?= $item->id ?>/<?= $itemUriName ?>" class="middle">
  <span class="center">
    <span class="linebox bigpadding">
      <h2><?= $item->name ?></h2>
      <? if(round($item->cost2) && round($item->cost) != round($item->cost2)): ?><small class="sx"><?= $itemCost2 ?></small><? endif ?>
      <small><?= $itemCost ?></small>
    </span>
  </span>
  </a>
</div>