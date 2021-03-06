<? if( !AJAX ) $this->load->view("common/header") ?>
<div class="widget-app-element" id="main">
<form class="widget-app-element-form" id="widget-form-<?= $wgetId ?>" method="post" action="<?= base_url() . ($idItem ? "{$appController}/{$appFunction}/element/{$idItem}" . ($quickOpen ? "/quick" : "") : "{$appController}/{$appFunction}/element/new") ?>" role="form">
  <input type="hidden" value="0" name="goback" class="form-post-goback" />
  <div class="row page-title-row">
        <div class="col-xs-12 col-sm-10 col-md-10 col-lg-8">
      <h1 class="page-title txt-color-blueDark"><i class="page-title-ico <?= $appTitleIco ?>"></i> <?= prep_app_title($appTitle) ?></h1>
    </div>
    <? $this->load->view("app/element/buttons-header", array('alt' => true)) ?>   
      </div>
  <section class="widget-form-content">
    <div class="row">
        </div>
    <div class="clear-sm"></div>
    <div class="well-white smart-form">
      <fieldset>
        <div class="row">
        
<? $field = 'id_category'; $this->load->view('app/form', array('item' => array(
    'type' => 'select',
    'columns' => 3,
    'form' => $wgetId,
    'name' => $field,
    'data' => $select['SelectProductCategory'],
    'label' => $this->lang->line('Departamento'),
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
    'label' => $this->lang->line('Categoría'),
    'error' => $this->validation->error($field),
    'class' => $this->validation->error_class($field),
    'value' => $dataItem[$field],
    'placeholder' => ''
  ))) ?>
<? $field = 'sub2'; $this->load->view('app/form', array('item' => array(
    'columns' => 4,
    'form' => $wgetId,
    'name' => $field,
    'label' => $this->lang->line('Subcategoría'),
    'value' => $dataItem[$field],
    'error' => $this->validation->error($field),
    'class' => $this->validation->error_class($field),
    'placeholder' => ''
  ))) ?>
<? $field = 'num'; $this->load->view('app/form', array('item' => array(
    'type' => 'number',
    'columns' => 2,
    'form' => $wgetId,
    'name' => $field,
    'label' => $this->lang->line('Orden'),
    'value' => $dataItem[$field],
    'error' => $this->validation->error($field),
    'class' => $this->validation->error_class($field),
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
<script>
$(document).ready(function() {
  var formGlobal = $('#widget-form-<?= $wgetId ?>');  
  $('.form-post-id_category', formGlobal).change(function(){
        var val = $(this).val();
    if( !val )
    {
      return $('.form-post-id_sub', formGlobal).empty().append( '<option value=""><?= $this->lang->line('Seleccionar un deparamento') ?></option>').prop('disabled',true);
    }
    $.ajax({
      url: "<?= base_url()?>products/data/subs-select",
      type: "POST",
      data: {id:val},
      dataType: "json",
      success:function(result){
        $('.form-post-id_sub', formGlobal).empty();
        if(!result.length)
          return $('.form-post-id_sub', formGlobal).append( '<option value=""><?= $this->lang->line('Sin categorías') ?></option>').prop('disabled',true);
        $('.form-post-id_sub', formGlobal).append( '<option value=""><?= $this->lang->line('Selecciona una categoría') ?></option>');
        $.each( result, function( key, val ) {
          $('.form-post-id_sub', formGlobal).append( '<option value="'+ val['id'] +'">'+val['el']+'</option>').prop('disabled',true);
        });   
        $('.form-post-id_sub', formGlobal).prop('disabled', false);
      }
    });
    $('.form-post-id_sub', formGlobal).empty().append( '<option value=""><?= $this->lang->line('Cargando...') ?></option>').prop('disabled',true);
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
    rules : {
      'id_category': 'required',
      'sub2': 'required',
      'num': 'required'
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
    
});
</script>
<? $this->load->view("common/footer") ?>