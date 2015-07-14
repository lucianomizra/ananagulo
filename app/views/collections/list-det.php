<? $itemUriName = prep_word_url($item->name);
    $itemCost2 = prep_cost($item->cost2, true, false);
    $itemCost = prep_cost($item->cost, true, false);
?><div class="cover style3 product-preview" style="background-image:url('<?= (isset($szx) && $szx)? thumb($item->file, 590, 620) : thumb($item->file, 285, 300) ?>')">
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