<?
$maxCost = ceil($costValues->max/10)*10 + 20;
$colors = $this->Data->SearchColors();
$left = (($search->filter->cost1 > 0) ? $search->filter->cost1 : 0) / $maxCost * 100;
$right = (($search->filter->cost2 > 0)  ? $search->filter->cost2 : $maxCost) / $maxCost * 100;
?>
<div class="col-xs-12 dropdowns-menu">
  <form id="global-search-form" method="post" action="<?= base_url() ?>rebajas">
  <input class="post search-filter-text" type="hidden" value="<?= $search->filter->text ?>" name="text" />
  <input id="search-filter-size-<?= $rnd ?>" class="post search-filter-size" type="hidden" value="<?= $search->filter->size ?>" name="size" />
  <input id="search-filter-order-<?= $rnd ?>" class="post search-filter-order" type="hidden" value="<?= $search->filter->order ?>" name="order" />
  <input id="search-filter-category-<?= $rnd ?>" class="post search-filter-category" type="hidden" value="<?= $search->filter->category ?>" name="category" />
  <input id="search-filter-sub-<?= $rnd ?>" class="post search-filter-sub" type="hidden" value="<?= $search->filter->sub ?>" name="sub" />
   <div class="button-group">
    <ul class="row" data-toggle="collapse" href="#collapseFilters" aria-expanded="false" aria-controls="collapseFilters">
      <li class="col-sm-3">
          <button type="button" class="btn btn-default dropdown-toggle" >
            Prenda <span class="caret"></span>
          </button>
      </li>
      <li class="col-sm-3">
          <button type="button" class="btn btn-default dropdown-toggle" >
            Precio <span class="caret"></span>
          </button>
      </li>
      <li class="col-sm-3">
          <button type="button" class="btn btn-default dropdown-toggle" >
            Talla <span class="caret"></span>
          </button>
      </li>
      <li class="col-sm-3">
          <button type="button" class="btn btn-default dropdown-toggle" >
            Productos a mostrar <span class="caret"></span>
          </button>
      </li>
    </ul>

      <div class="col-xs-12 collapse" id="collapseFilters">
      <button class="btn-close" type="button" data-toggle="collapse" href="#collapseFilters" aria-expanded="false"  aria-controls="collapseFilters">
        <span aria-hidden="true">&times;</span>
      </button>
        <div class="col-sm-3">
          <? $departments = $this->Data->Departments(); ?>
          <ul>
            <li><input id="check-d-0" type="radio" <? if(!$search->filter->categoryp): ?>checked="checked" <? endif ?>name="categoryp" value="0" /><label for="check-d-0">Todas las prendas</label></li>
            <? foreach($departments as $key => $d): ?>
            <li><input id="check-d-<?= $d->id ?>" type="radio" <? if($search->filter->categoryp == $d->id): ?>checked="checked" <? endif ?>name="categoryp" value="<?= $d->id ?>" /><label for="check-d-<?= $d->id ?>"><?= $d->department ?></label></li>
            <? endforeach ?>
          </ul>
        </div>            
        <div class="col-sm-3">
        <div class="row">
          <div class="col-xs-2">
            <label for="from">De: </label>
          </div>
          <div class="col-xs-10">
            <input id="from" type="text" class="forms-control" name="cost1" value="<?= prep_cost(round(($search->filter->cost1 > 0) ? $search->filter->cost1 : 0), false, false) ?>" >
          </div>
        </div>
        <div class="row">
          <div class="col-xs-2">
            <label for="to">A: </label>
          </div>
          <div class="col-xs-10">
            <input id="to" name="cost2" value="<?= prep_cost(round(($search->filter->cost2 > 0)  ? $search->filter->cost2 : $maxCost), false, false) ?>" type="text" class="forms-control">
          </div>
        </div>
        </div>            
        <div class="col-sm-3 sizes text-center">
          <div class="btn-group margin-bottom" role="group">
            <button type="button" data-value="XS" class="btn btn-default<? if($search->filter->size == 'XS'): ?> active<? endif ?>">XS</button>
            <button type="button" data-value="S" class="btn btn-default<? if($search->filter->size == 'S'): ?> active<? endif ?>">S</button>
            <button type="button" data-value="M" class="btn btn-default<? if($search->filter->size == 'M'): ?> active<? endif ?>">M</button>
            <button type="button" data-value="L" class="btn btn-default<? if($search->filter->size == 'L'): ?> active<? endif ?>">L</button>
            <button type="button" data-value="XL" class="btn btn-default<? if($search->filter->size == 'XL'): ?> active<? endif ?>">XL</button>
          </div>
        </div>            
        <div class="col-sm-3">              
          <ul>
          <li><input id="show-15" type="radio" <? if(!$search->filter->show || $search->filter->show == 15): ?>checked="checked" <? endif ?>name="show" value="15"/><label for="show-15">Mostrar 15</label></li>
          <li><input id="show-30" type="radio" <? if($search->filter->color == 30): ?>checked="checked" <? endif ?>name="show" value="30"/><label for="show-30">Mostrar 30</label></li>
          <li><input id="show-all" type="radio" <? if($search->filter->color == 100): ?>checked="checked" <? endif ?>name="show" value="100" /><label for="show-all">Mostrar todos</label></li>
          </ul>
        </div>
        <div class="col-xs-12 text-center">
          <button class="btn btn-primary btn-xs" type="submit">Filtrar</button>
          <a href="<?= base_url() ?>colecciones" class="btn btn-primary btn-xs reset-button" type="reset">Reiniciar</a>
        </div>
      </div>
    </div>
  </form>
</div>
<script>
$(document).ready(function() {
  <? /*if(str_replace('reductions:1_show:15','',$questURI)): ?>
  $('#collapseFilters').collapse('show');
  <? endif*/ ?>
  $('#global-search-form .sizes .btn').click(function(){
    var ths = $(this);
    if(ths.hasClass('active'))
    {
      ths.removeClass('active');
      $('#search-filter-size-<?= $rnd ?>').val('');
      return;
    }
    $('#global-search-form .sizes .btn').removeClass('active');
    ths.addClass('active')
    $('#search-filter-size-<?= $rnd ?>').val(ths.attr('data-value'));
  });
  <? if($search->filter->categoryp): ?>
  $('header .nav-categoryp-<?= $search->filter->categoryp ?>').addClass('active');
  <? if($search->filter->category): ?>
  $('header .nav-category-<?= $search->filter->category ?>').addClass('active');  
  <? if($search->filter->sub): ?>
  $('header .nav-categorys-<?= $search->filter->sub ?>').addClass('active');
  <? endif ?>
  <? endif ?>
  <? endif ?>
});
</script>