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
        <div class="slide-inside">
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
      </div>
    <ul class="slides">
      <? foreach($lines as $items): ?>        
      <li>
        <div class="slide-inside">
        <? $count = 0; foreach($items as $item): $itemCost = prep_cost($item->cost, true, false); $itemUriName = prep_word_url($item->name); if($count == 3) :?><div class="col-md-20p col-sm-4"><div class="height2"></div></div><? endif ?>
        <div class="col-md-20p col-sm-4 col-items">
          <div class="cover style3 height2 product-preview" style="background-image:url('<?= thumb($item->file, 370,572) ?>')">
            <div class="pimg">
              <img src="<?= thumb($item->file,300,460) ?>" class="ttb">
              <div class="more-info"><a href="<?= base_url() ?>producto/<?= $item->id ?>/<?= $itemUriName ?>" class="more-info-bb">+ INFO </a></div>
            </div>
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
        </div>
      </li>
      <? endforeach ?>
    </ul>
  </div>
</div>
<script>
$(document).ready(function(){
  if($(window).width()>1199 || $(window).width()<500) return;
  $('.home-second-slider .slides li a').click(function(event) {
    if($(this).hasClass('hhover')) return;
    event.preventDefault();
    $('.home-second-slider .slides li a').removeClass('hhover');
    $(this).addClass('hhover');
  });
})
</script>