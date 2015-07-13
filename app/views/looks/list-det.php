<? $itemUriName = prep_word_url($item->name);
    $itemCost = prep_cost($item->cost, true, false);
?><div class="cover style3 product-preview" style="background-image:url('<?= thumb($item->file2 ? $item->file2 : $item->file, $szx, $szy) ?>')">
  <a href="<?= base_url() ?>producto/<?= $item->id ?>/<?= $itemUriName ?>" class="middle">
  <span class="center">
    <span class="linebox bigpadding">
      <h2><?= $item->name ?></h2>
      <small><?= $itemCost ?></small>
    </span>
  </span>
  </a>
</div>