<? if( !AJAX ) $this->load->view("common/header") ?>
<? $colors = $this->model->ListColors(); ?>
<? $stock = $this->model->ListStores(); ?>
<div class="widget-app-element" id="main">
<form class="widget-app-element-form" id="widget-form-<?= $wgetId ?>" method="post" action="<?= base_url() . ($idItem ? "{$appController}/{$appFunction}/element/{$idItem}" . ($quickOpen ? "/quick" : "") : "{$appController}/{$appFunction}/element/new") ?>" role="form">
  <input type="hidden" value="0" name="goback" class="form-post-goback" />
  <div class="row page-title-row">
        
    <div class="col-xs-12 col-sm-10 col-md-10 col-lg-10">
      <h1 class="page-title txt-color-blueDark"><i class="page-title-ico <?= $appTitleIco ?>"></i> <?= prep_app_title($appTitle) ?></h1>
    </div>
      </div>
  <section class="widget-form-content">
    <div class="row">
          <div class="col-xs-12 col-sm-12 col-md-5 col-lg-5">
        <div class="onoffswitch-container">
          <span class="onoffswitch-title"><?= $this->lang->line("Estado") ?></span> 
          <span class="onoffswitch">
            <input name="active" value="1" type="checkbox" <? if($dataItem['active'] == 1 || (!$idItem && !$this->input->post())): ?>checked="checked"<? endif ?> class="onoffswitch-checkbox" id="activeForm<?= $wgetId ?>">
            <label class="onoffswitch-label" for="activeForm<?= $wgetId ?>"> 
              <span class="onoffswitch-inner" data-swchon-text="ON" data-swchoff-text="OFF"></span> 
              <span class="onoffswitch-switch"></span>
            </label> 
          </span>
        </div>
      </div>
      <? $this->load->view("app/element/buttons-header") ?>   
          </div>
    <div class="clear-sm"></div>
    <div class="well-white smart-form">
      <fieldset>
        <div class="row">
        
<? $field = 'code'; $this->load->view('app/form', array('item' => array(
    'columns' => 3,
    'form' => $wgetId,
    'name' => $field,
    'label' => $this->lang->line('Código'),
    'value' => $dataItem[$field],
    'error' => $this->validation->error($field),
    'class' => $this->validation->error_class($field),
    'placeholder' => ''
  ))) ?>
<? $field = 'name'; $this->load->view('app/form', array('item' => array(
    'columns' => 6,
    'form' => $wgetId,
    'name' => $field,
    'label' => $this->lang->line('Nombre'),
    'value' => $dataItem[$field],
    'error' => $this->validation->error($field),
    'class' => $this->validation->error_class($field),
    'placeholder' => ''
  ))) ?>
  
<? $field = 'id_state'; $this->load->view('app/form', array('item' => array(
    'type' => 'select',
    'columns' => 3,
    'form' => $wgetId,
    'name' => $field,
    'data' => $select['SelectProductState'],
    'label' => $this->lang->line('Disponibilidad'),
    'error' => $this->validation->error($field),
    'class' => $this->validation->error_class($field),
    'value' => $dataItem[$field],
    'placeholder' => ''
  ))) ?>
<? $field = 'id_category'; $this->load->view('app/form', array('item' => array(
    'type' => 'select',
    'columns' => 3,
    'form' => $wgetId,
    'name' => $field,
    'data' => $select['SelectProductCategory'],
    'label' => $this->lang->line('Categoría'),
    'error' => $this->validation->error($field),
    'class' => $this->validation->error_class($field),
    'value' => $dataItem[$field],
    'placeholder' => ''
  ))) ?>
  
<? $field = 'id_brand'; $this->load->view('app/form', array('item' => array(
    'type' => 'select',
    'columns' => 3,
    'form' => $wgetId,
    'name' => $field,
    'data' => $this->Data->SelectBrand("active = '1' AND ( id_brand = '{$dataItem['id_brand']}' OR id_category = '{$dataItem['id_category']}')", $this->lang->line('Selecciona una opción')),
    'label' => $this->lang->line('Marca'),
    'error' => $this->validation->error($field),
    'class' => $this->validation->error_class($field),
    'value' => $dataItem[$field],
    'placeholder' => ''
  ))) ?>
  
<? $field = 'id_sub'; $this->load->view('app/form', array('item' => array(
    'type' => 'select',
    'columns' => 3,
    'form' => $wgetId,
    'name' => $field,
    'data' => $this->Data->SelectProductSub("id_category = '{$dataItem['id_category']}'", $this->lang->line('Selecciona una opción')),
    'label' => $this->lang->line('Subcategoría'),
    'error' => $this->validation->error($field),
    'class' => $this->validation->error_class($field),
    'value' => $dataItem[$field],
    'placeholder' => ''
  ))) ?>
<? $field = 'id_sub2'; $this->load->view('app/form', array('item' => array(
    'type' => 'select',
    'columns' => 3,
    'form' => $wgetId,
    'name' => $field,
    'data' => $this->Data->SelectProductSub2("id_sub = '{$dataItem['id_sub']}'", $this->lang->line('Selecciona una opción')),
    'label' => $this->lang->line('Subcategoría 2'),
    'error' => $this->validation->error($field),
    'class' => $this->validation->error_class($field),
    'value' => $dataItem[$field],
    'placeholder' => ''
  ))) ?>
  
<? $field = 'description'; $this->load->view('app/form', array('item' => array(
    'type' => 'textarea',
    'height' => 140,
    'columns' => 4,
    'form' => $wgetId,
    'name' => $field,
    'label' => $this->lang->line('Descripión'),
    'value' => $dataItem[$field],
    'error' => $this->validation->error($field),
    'class' => $this->validation->error_class($field),
    'placeholder' => ''
  ))) ?>
<? $field = 'details'; $this->load->view('app/form', array('item' => array(
    'type' => 'textarea',
    'height' => 140,
    'columns' => 4,
    'form' => $wgetId,
    'name' => $field,
    'label' => $this->lang->line('Composición'),
    'value' => $dataItem[$field],
    'error' => $this->validation->error($field),
    'class' => $this->validation->error_class($field),
    'placeholder' => ''
  ))) ?>
<? $field = 'id_file'; $this->load->view('app/form', array('item' => array(
    'type' => 'filemanager',
    'columns' => 4,
    'form' => $wgetId,
    'name' => $field,
    'error' => $this->validation->error($field),
    'class' => $this->validation->error_class($field),
    'allow-navigation' => isset($gallery['default'][$field]['allow-navigation']) ? $gallery['default'][$field]['allow-navigation'] : false,
    'default-location' => isset($gallery['default'][$field]['folder']) ? $gallery['default'][$field]['folder'] : ( isset($gallery['folder']) ? $gallery['folder'] : 0 ),
    'data' => $dataItem,
    'prefix' => 'fm1',
    'label' => $this->lang->line('Imagen principal'),
    'value' => $dataItem[$field],
    'placeholder' => ''
  ))) ?>
  <?/*
  <div style="clear:both;position: relative;top: -20px; margin-bottom:20px">
<? $field = 'details'; $this->load->view('app/form', array('item' => array(
    'type' => 'textarea',
    'height' => 220,
    'columns' => 9,
    'form' => $wgetId,
    'name' => $field,
    'label' => $this->lang->line('Detalles'),
    'value' => $dataItem[$field],
    'error' => $this->validation->error($field),
    'class' => $this->validation->error_class($field),
    'placeholder' => ''
  ))) ?>
    <div class="col col-3 element-mb">
<? $field = 'dimensions'; $this->load->view('app/form', array('item' => array(
    'form' => $wgetId,
    'name' => $field,
    'label' => $this->lang->line('Dimensiones'),
    'value' => $dataItem[$field],
    'error' => $this->validation->error($field),
    'class' => $this->validation->error_class($field),
    'placeholder' => ''
  ))) ?>
<? $field = 'weight'; $this->load->view('app/form', array('item' => array(
    'form' => $wgetId,
    'name' => $field,
    'label' => $this->lang->line('Peso'),
    'value' => $dataItem[$field],
    'error' => $this->validation->error($field),
    'class' => $this->validation->error_class($field),
    'placeholder' => ''
  ))) ?>
<? $field = 'sales'; $this->load->view('app/form', array('item' => array(
    'form' => $wgetId,
    'name' => $field,
    'readonly' => true,
    'label' => $this->lang->line('Ventas por web'),
    'value' => $dataItem[$field],
    'error' => $this->validation->error($field),
    'class' => $this->validation->error_class($field),
    'placeholder' => ''
  ))) ?>
<? $field = 'highlight'; $this->load->view('app/form', array('item' => array(
    'type' => 'checkbox',
    'form' => $wgetId,
    'name' => $field,
    'label' => $this->lang->line('Destacado'),
    'value' => $field,
    'error' => $this->validation->error($field),
    'class' => $this->validation->error_class($field),
    'checked' => ($dataItem[$field] > 0)
  ))) ?>
      </div>
    </div>
    */?>

  <div style="clear:both;"></div>
  <div style="padding:0;position:relative;top:-15px" class="col col-12"> 
<? $field = 'cost'; $this->load->view('app/form', array('item' => array(
    'type' => 'number',
    'columns' => 3,
    'form' => $wgetId,
    'name' => $field,
    'label' => $this->lang->line('Precio'),
    'value' => $dataItem[$field],
    'error' => $this->validation->error($field),
    'class' => $this->validation->error_class($field),
    'placeholder' => ''
  ))) ?>
<? $field = 'cost2'; $this->load->view('app/form', array('item' => array(
    'type' => 'number',
    'columns' => 3,
    'form' => $wgetId,
    'name' => $field,
    'label' => $this->lang->line('Precio Antiguo'),
    'value' => $dataItem[$field],
    'error' => $this->validation->error($field),
    'class' => $this->validation->error_class($field),
    'placeholder' => ''
  ))) ?>
  <?/*
<? $field = 'votes'; $this->load->view('app/form', array('item' => array(
    'type' => 'number',
    'columns' => 2,
    'form' => $wgetId,
    'name' => $field,
    'label' => $this->lang->line('Votos'),
    'value' => $dataItem[$field],
    'error' => $this->validation->error($field),
    'class' => $this->validation->error_class($field),
    'placeholder' => ''
  ))) ?>
  */?>
<? $field = 'reduction'; $this->load->view('app/form', array('item' => array(
    'type' => 'checkbox',
    'columns' => 2,
    'form' => $wgetId,
    'name' => $field,
    'label' => $this->lang->line('Rebaja'),
    'value' => $field,
    'error' => $this->validation->error($field),
    'class' => $this->validation->error_class($field),
    'checked' => ($dataItem[$field] > 0)
  ))) ?>  
<? $field = 'highlight'; $this->load->view('app/form', array('item' => array(
    'type' => 'checkbox',
    'form' => $wgetId,
    'columns' => 3,
    'name' => $field,
    'label' => $this->lang->line('Recomendado del mes'),
    'value' => $field,
    'error' => $this->validation->error($field),
    'class' => $this->validation->error_class($field),
    'checked' => ($dataItem[$field] > 0)
  ))) ?>
  <div style="clear:both;"></div>
  
<? $field = 'id_collection'; $this->load->view('app/form', array('item' => array(
    'type' => 'select',
    'columns' => 3,
    'form' => $wgetId,
    'name' => $field,
    'data' => $select['SelectCollection'],
    'label' => $this->lang->line('Colección'),
    'error' => $this->validation->error($field),
    'class' => $this->validation->error_class($field),
    'value' => $dataItem[$field],
    'placeholder' => ''
  ))) ?> 

<? $field = 'sizes'; $this->load->view('app/form', array('item' => array(
    'columns' => 3,
    'form' => $wgetId,
    'name' => $field,
    'label' => $this->lang->line('Talles disponibles (separados por comas)'),
    'value' => rtrim($dataItem[$field], ','),
    'error' => $this->validation->error($field),
    'class' => $this->validation->error_class($field),
    'placeholder' => ''
  ))) ?>
        <div class="col col-6">      
          <div style="padding-left: 5px;margin-left:0;float:none;clear:both;line-height: 19px;font-weight: 400;font-size: 13px;margin-bottom: 2px;color: #333;"><?= $this->lang->line('Disponibilidad de colores') ?></div>      
          <div id="widget-colors<?= $wgetId ?>" class="widget-colors">
          <input type="hidden" class="form-post-colors" value="" />
          <? foreach($colors as $color): ?>
            <div class="color-item tooltip-nz-app ttactive <?= ($color->selected) ? "color-selectedxx" : "" ?>" title="<?= $color->color ?>" data-id-color="<?= $color->id ?>" style="background:<?= $color->value ?>"></div>
          <? endforeach ?>
          </div> 
        </div> 
      <div style="clear:both"></div>
        <? $field = 'id_care'; $this->load->view('app/form', array('item' => array(
    'type' => 'select',
    'columns' => 6,
    'form' => $wgetId,
    'name' => $field,
    'data' => $select['SelectProductCares'],
    'label' => $this->lang->line('Cuidados'),
    'error' => $this->validation->error($field),
    'class' => $this->validation->error_class($field),
    'placeholder' => ''
  ))) ?> 
      <div class="col col-2">
         <span style="margin-top:20px" class="btn btn-primary add-care"><i class="glyphicon glyphicon-plus"></i> Agregar</span>
      </div>
      <div style="clear:both"></div>
        <ul class="cares-list">
        </ul>
      </div>

<? $field = 'id_file_2'; $this->load->view('app/form', array('item' => array(
    'type' => 'filemanager',
    'columns' => 4,
    'form' => $wgetId,
    'name' => $field,
    'error' => $this->validation->error($field),
    'class' => $this->validation->error_class($field),
    'allow-navigation' => isset($gallery['default'][$field]['allow-navigation']) ? $gallery['default'][$field]['allow-navigation'] : false,
    'default-location' => isset($gallery['default'][$field]['folder']) ? $gallery['default'][$field]['folder'] : ( isset($gallery['folder']) ? $gallery['folder'] : 0 ),
    'data' => $dataItem,
    'prefix' => 'fm2',
    'label' => $this->lang->line('Imagen producto'),
    'value' => $dataItem[$field],
    'placeholder' => ''
  ))) ?>
<? $field = 'id_gallery'; $this->load->view('app/form', array('item' => array(
    'type' => 'gallery',
    'columns' => 8,
    'form' => $wgetId,
    'name' => $field,
    'error' => $this->validation->error($field),
    'class' => $this->validation->error_class($field),
    'allow-navigation' => isset($gallery['default'][$field]['allow-navigation']) ? $gallery['default'][$field]['allow-navigation'] : false,
    'default-location' => isset($gallery['default'][$field]['folder']) ? $gallery['default'][$field]['folder'] : ( isset($gallery['folder']) ? $gallery['folder'] : 0 ),
    'data' => $dataItem,
    'prefix' => 'fmg1',
    'label' => $this->lang->line('Imágenes'),
    'value' => $dataItem[$field],
    'placeholder' => ''
  ))) ?>

      </div>           
      </fieldset>
      <div class="clear-sm"></div>
    </div>
    <? $this->load->view("app/element/buttons-footer") ?>   
  </section>     
</form>
</div>
<? $this->load->view("script/filemanager/includes") ?>
<script>
$(document).ready(function() {
  var formGlobal = $('#widget-form-<?= $wgetId ?>');  
  $('.widget-colors .color-item', formGlobal).on('click',function(){
    var $th = $(this);
    if($th.hasClass('color-selectedxx')) 
      $th.removeClass('color-selectedxx');
    else
      $th.addClass('color-selectedxx');
  });

  $('.form-post-id_product', formGlobal).attr('name', '');
  var createItem = function(id, text){
    var li = $('<li/>');
    li.html(text + '<span class="delete-item" style="cursor:pointer;margin-left:20px"><i class="glyphicon glyphicon-trash"></i></span><input type="hidden" value="' + id + '" name="cares[]">')
    li.css('margin-bottom', '5px');
    $('.delete-item', li).click(function(){
      li.remove();
    })
    $('.cares-list').append(li);
  };
  $('.add-care', formGlobal).click(function(){
    if(!$('.form-post-id_care', formGlobal).val())
      return;
    createItem($('.form-post-id_care', formGlobal).val(), $('.form-post-id_care option:selected').text());
  });
  <?
    $cares = $this->model->ListCares();
    foreach($cares as $p):
  ?>
    createItem('<?= $p->id ?>','<?= $p->name ?>');
  <? endforeach; ?>

  $('.form-post-id_sub', formGlobal).change(function(){
    var val = $(this).val();
    if( !val )
    {
      return $('.form-post-id_sub2', formGlobal).empty().append( '<option value=""><?= $this->lang->line('Seleccionar un categoría') ?></option>').prop('disabled',true);
    }
    $.ajax({
      url: "<?= base_url()?>products/data/subs2-select",
      type: "POST",
      data: {id:val},
      dataType: "json",
      success:function(result){
        $('.form-post-id_sub2', formGlobal).empty();
        if(!result.length)
          return $('.form-post-id_sub2', formGlobal).append( '<option value=""><?= $this->lang->line('Sin subcategorías') ?></option>').prop('disabled',true);
        $('.form-post-id_sub2', formGlobal).append( '<option value=""><?= $this->lang->line('Selecciona una subcategoría') ?></option>');
        $.each( result, function( key, val ) {
          $('.form-post-id_sub2', formGlobal).append( '<option value="'+ val['id'] +'">'+val['el']+'</option>').prop('disabled',true);
        });   
        $('.form-post-id_sub2', formGlobal).prop('disabled', false);
      }
    });
    $('.form-post-id_sub2', formGlobal).empty().append( '<option value=""><?= $this->lang->line('Cargando...') ?></option>').prop('disabled',true);
  });
  
  $('.form-post-id_category', formGlobal).change(function(){
    var val = $(this).val();
    if( !val )
    {
      $('.form-post-id_sub', formGlobal).empty().append( '<option value=""><?= $this->lang->line('Seleccionar un categoría') ?></option>').prop('disabled',true);
      $('.form-post-id_brand', formGlobal).empty().append( '<option value=""><?= $this->lang->line('Seleccionar un categoría') ?></option>').prop('disabled',true);
      $('.form-post-id_sub2', formGlobal).empty().append( '<option value=""><?= $this->lang->line('Seleccionar una categoría') ?></option>').prop('disabled',true);
      return 
    }
    $.ajax({
      url: "<?= base_url()?>products/data/subs-select",
      type: "POST",
      data: {id:val},
      dataType: "json",
      success:function(result){
        $('.form-post-id_sub', formGlobal).empty();
        $('.form-post-id_sub2', formGlobal).empty().append( '<option value=""><?= $this->lang->line('Seleccionar una subcategoría') ?></option>').prop('disabled',true);
        if(!result.length)
          return $('.form-post-id_sub', formGlobal).append( '<option value=""><?= $this->lang->line('Sin subcategorías') ?></option>').prop('disabled',true);
        $('.form-post-id_sub', formGlobal).append( '<option value=""><?= $this->lang->line('Selecciona una subcategoría') ?></option>');
        $.each( result, function( key, val ) {
          $('.form-post-id_sub', formGlobal).append( '<option value="'+ val['id'] +'">'+val['el']+'</option>').prop('disabled',true);
        });   
        $('.form-post-id_sub', formGlobal).prop('disabled', false);
      }
    });
    $.ajax({
      url: "<?= base_url()?>products/data/brands-select",
      type: "POST",
      data: {id:val},
      dataType: "json",
      success:function(result){
        $('.form-post-id_brand', formGlobal).empty();
        if(!result.length)
          return $('.form-post-id_brand', formGlobal).append( '<option value=""><?= $this->lang->line('Sin marcas') ?></option>').prop('disabled',true);
        $('.form-post-id_brand', formGlobal).append( '<option value=""><?= $this->lang->line('Selecciona una marca') ?></option>');
        $.each( result, function( key, val ) {
          $('.form-post-id_brand', formGlobal).append( '<option value="'+ val['id'] +'">'+val['el']+'</option>').prop('disabled',true);
        });   
        $('.form-post-id_brand', formGlobal).prop('disabled', false);
      }
    });
    $('.form-post-id_sub', formGlobal).empty().append( '<option value=""><?= $this->lang->line('Cargando...') ?></option>').prop('disabled',true);
    $('.form-post-id_sub2', formGlobal).empty().append( '<option value=""><?= $this->lang->line('Cargando...') ?></option>').prop('disabled',true);
    $('.form-post-id_brand', formGlobal).empty().append( '<option value=""><?= $this->lang->line('Cargando...') ?></option>').prop('disabled',true);
  });
  
<? if(!$this->MApp->secure->edit):?>
  formGlobal.addClass('form-disabled');
  formGlobal.submit(function(e){
    e.preventDefault();
    e.stopPropagation();
    return false;
  });
<? else: ?>
  <? if($idItem && !$quickOpen): ?>
  App.changeURI('<?= base_url() . "{$appController}/{$appFunction}/element/{$idItem}" ?>');
  <? endif ?>
  formGlobal.validate({     
    submitHandler: function(form) {      
      var ids = [];
      $('.widget-colors .color-item.color-selectedxx', formGlobal).each(function(index, item){
        ids.push($(item).attr('data-id-color'));
      })
      $('.form-post-colors', formGlobal).attr('name', 'colors').val(ids.join(','));
      App.postForm(form);
    },
    rules : {
      'code': 'required',
      'name': 'required',
      'id_category': 'required',
      'cost': 'required',
      'id_state': 'required',
      'rating': 'required'   
    },
    messages : {
    }
  });  
  
  $('.btn.save-action',formGlobal).click(function(){
    $('.form-post-goback', formGlobal).val('0');
    formGlobal.submit();
  });
  $('.btn.save-action-close', formGlobal).click(function(){
    $('.form-post-goback', formGlobal).val('1');
    formGlobal.submit();
  });
  <? endif ?>  
  <? if($quickOpen): ?>
  $('.action-close', formGlobal).click(function(e){
    e.preventDefault();
    window.close();
    return false;
  });
  <? endif ?>
      <? $field = 'id_file'; $this->load->view('script/filemanager/file.js', array('item' => array(
    'form' => $wgetId,
    'name' => $field
  ))) ?>
  <? $field = 'id_file_2'; $this->load->view('script/filemanager/file.js', array('item' => array(
    'form' => $wgetId,
    'name' => $field
  ))) ?>
    <? $field = 'id_gallery'; $this->load->view('script/filemanager/gallery.js', array('item' => array(
    'form' => $wgetId,
    'name' => $field
  ))) ?>
  
});
</script>
<? $this->load->view("common/footer") ?>