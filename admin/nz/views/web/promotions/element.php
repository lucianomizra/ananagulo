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
        
<? $field = 'title'; $this->load->view('app/form', array('item' => array(
    'columns' => 12,
    'form' => $wgetId,
    'name' => $field,
    'label' => $this->lang->line('Título'),
    'value' => $dataItem[$field],
    'error' => $this->validation->error($field),
    'class' => $this->validation->error_class($field),
    'placeholder' => ''
  ))) ?>
   <div class="col col-8 element-mb">
<? $field = 'subtitle'; $this->load->view('app/form', array('item' => array(
    'form' => $wgetId,
    'type' => 'textarea',
    'name' => $field,
    'label' => $this->lang->line('Subtítulo'),
    'value' => $dataItem[$field],
    'error' => $this->validation->error($field),
    'class' => $this->validation->error_class($field),
    'placeholder' => ''
  ))) ?>
<? $field = 'link'; $this->load->view('app/form', array('item' => array(
    'form' => $wgetId,
    'name' => $field,
    'label' => $this->lang->line('Enlace Externo'),
    'value' => $dataItem[$field],
    'error' => $this->validation->error($field),
    'class' => $this->validation->error_class($field),
    'placeholder' => ''
  ))) ?>
      </div>
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
    'label' => $this->lang->line('Imagen'),
    'value' => $dataItem[$field],
    'placeholder' => ''
  ))) ?>
<? $field = 'num'; $this->load->view('app/form', array('item' => array(
    'columns' => 4,
    'type' => 'number',
    'form' => $wgetId,
    'name' => $field,
    'label' => $this->lang->line('Orden'),
    'value' => $dataItem[$field],
    'error' => $this->validation->error($field),
    'class' => $this->validation->error_class($field),
    'placeholder' => ''
  ))) ?>
  <div style="clear:both"></div>
<? $field = 'home'; $this->load->view('app/form', array('item' => array(
    'type' => 'checkbox',
    'form' => $wgetId,
    'columns' => 3,
    'name' => $field,
    'label' => $this->lang->line('Mostrar en Home'),
    'value' => $field,
    'error' => $this->validation->error($field),
    'class' => $this->validation->error_class($field),
    'checked' => ($dataItem[$field] > 0)
  ))) ?>
<? $field = 'looks'; $this->load->view('app/form', array('item' => array(
    'type' => 'checkbox',
    'form' => $wgetId,
    'columns' => 3,
    'name' => $field,
    'label' => $this->lang->line('Mostrar en Looks'),
    'value' => $field,
    'error' => $this->validation->error($field),
    'class' => $this->validation->error_class($field),
    'checked' => ($dataItem[$field] > 0)
  ))) ?>
<? $field = 'collections'; $this->load->view('app/form', array('item' => array(
    'type' => 'checkbox',
    'form' => $wgetId,
    'columns' => 3,
    'name' => $field,
    'label' => $this->lang->line('Mostrar en Colecciones'),
    'value' => $field,
    'error' => $this->validation->error($field),
    'class' => $this->validation->error_class($field),
    'checked' => ($dataItem[$field] > 0)
  ))) ?>
<? $field = 'reductions'; $this->load->view('app/form', array('item' => array(
    'type' => 'checkbox',
    'columns' => 3,
    'form' => $wgetId,
    'name' => $field,
    'label' => $this->lang->line('Mostrar en Rebajas'),
    'value' => $field,
    'error' => $this->validation->error($field),
    'class' => $this->validation->error_class($field),
    'checked' => ($dataItem[$field] > 0)
  ))) ?>
      </div>
      </fieldset>
    </div>
    <? $this->load->view("app/element/buttons-footer") ?>   
  </section>     
</form>
</div>
<? $this->load->view("script/filemanager/includes") ?>
<script>
$(document).ready(function() {
  var formGlobal = $('#widget-form-<?= $wgetId ?>');  
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
      'title': 'required'  
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
  
});
</script>
<? $this->load->view("common/footer") ?>