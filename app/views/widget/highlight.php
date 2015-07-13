<?
$itemsT = $this->Data->GetHighlights();
$lines = array();
$c = 1;
$cc = 1;
foreach($itemsT as $item){
  $lines[$c][] = $item;
  $cc++;
  if($cc>4)
  {
    $cc = 1;
    $c++;
  }
}
?><div class="md-col-12">
  <div class="home-second-slider flexslider">
      <div class="slide-fix">
        <div class="col-md-20p col-sm-4">
        </div>
        <div class="col-md-20p col-sm-4">
        </div>
        <div class="col-md-20p col-sm-4">
        </div>
        <div class="col-md-20p col-sm-4 reccc">
          <div class="height2 cover sepia style2">
            <span class="middle">
            <span class="center">
              <span class="linebox">
                <h2>Recomendaciones</h2>
                <small>Del mes</small>
              </span>
            </span>
            </span>
          </div>
        </div>
        <div class="col-md-20p col-xs-4">
        </div>
      </div>
    <ul class="slides">
      <? foreach($lines as $items): ?>        
      <li>
        <? $count = 0; foreach($items as $item): $itemCost = prep_cost($item->cost, true, false); $itemUriName = prep_word_url($item->name); if($count == 3) :?><div class="col-md-20p col-sm-4"><div class="height2"></div></div><? endif ?>
        <div class="col-md-20p col-sm-4 col-items">
          <div class="cover style3 height2 product-preview" style="background-image:url('<?= thumb($item->file, 370,572) ?>')">
            <img src="<?= thumb($item->file,300,460) ?>" class="ttb">
            <a href="<?= base_url() ?>producto/<?= $item->id ?>/<?= $itemUriName ?>" class="middle">
            <span class="center">
              <span class="linebox bigpadding">
                <h2><?= $item->name ?></h2>
                <small><?= $itemCost ?></small>
              </span>
            </span>
            </a>
          </div>
        </div>
        <? $count++; endforeach ?>
      </li>
      <? endforeach ?>
    </ul>
  </div>
</div>