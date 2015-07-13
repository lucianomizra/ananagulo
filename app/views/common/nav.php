<? 
$sizes = array(3,2,2,2);
$sizes2 = array(4,3,3,2);
$departments = $this->Data->Departments();
?><div class="row pbot">
  <div class="col-md-3 col-sm-4 hidden-sm hidden-xs">
    <h3>Novedades</h3>
    <p>Descubre los últimos productos subidos a nuestro site.</p>
    <h3>Los mejores precios</h3>
  </div>
  <? foreach($departments as $key => $d): $categories = $this->Data->Categories($d->id); ?>
  <div class="col-md-<?= isset($sizes[$key]) ? $sizes[$key] : 2 ?> col-sm-<?= isset($sizes2[$key]) ? $sizes2[$key] : 2 ?>">
    <h3 class="nav-categoryp-<?= $d->id ?>"><a href="<?= base_url() ?>categoria/<?= $d->link ?>"><?= $d->department ?></a></h3>
    <? if(count($categories)): ?>
    <ul class="list-unstyled collapse-xs" id="collapseHeaderClothes">
      <? foreach($categories as $c): $subs = $this->Data->Subcategories($c->id);?>
      <li class="nav-category-<?= $c->id ?>"><a href="<?= base_url() ?>productos/categoryp:<?= $d->id ?>_category:<?= $c->id ?>"><?= $c->category ?></a>
        <? if(count($subs)):?>
        <ul>
          <? foreach($subs as $s):?>
          <li class="nav-categorys-<?= $s->id ?>"><a href="<?= base_url() ?>productos/categoryp:<?= $d->id ?>_category:<?= $c->id ?>_sub:<?= $s->id ?>"><?= $s->sub ?></a></li>
          <? endforeach ?>
        </ul>
        <? endif ?>
       </li>
      <? endforeach ?>
    </ul>   
    <? endif ?> 
  </div>
   <? endforeach ?>
</div>