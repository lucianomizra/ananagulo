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
        
<? $field = 'id_state'; $this->load->view('app/form', array('item' => array(
    'type' => 'select',
    'columns' => 4,
    'form' => $wgetId,
    'name' => $field,
    'data' => $select['SelectUserState'],
    'label' => $this->lang->line('Estado'),
    'error' => $this->validation->error($field),
    'class' => $this->validation->error_class($field),
    'value' => $dataItem[$field],
    'placeholder' => ''
  ))) ?>
<? $field = 'mail'; $this->load->view('app/form', array('item' => array(
    'columns' => 4,
    'form' => $wgetId,
    'name' => $field,
    'label' => $this->lang->line('E-mail'),
    'value' => $dataItem[$field],
    'error' => $this->validation->error($field),
    'class' => $this->validation->error_class($field),
    'placeholder' => ''
  ))) ?>
<? $field = 'password'; $this->load->view('app/form', array('item' => array(
    'columns' => 4,
    'form' => $wgetId,
    'name' => $field,
    'label' => $this->lang->line('Contraseña'),
    'value' => $dataItem[$field],
    'error' => $this->validation->error($field),
    'class' => $this->validation->error_class($field),
    'placeholder' => ''
  ))) ?>
  
<? $field = 'id_treatment'; $this->load->view('app/form', array('item' => array(
    'type' => 'select',
    'columns' => 2,
    'form' => $wgetId,
    'name' => $field,
    'data' => $select['SelectUserTreatment'],
    'label' => $this->lang->line('Tratamiento'),
    'error' => $this->validation->error($field),
    'class' => $this->validation->error_class($field),
    'value' => $dataItem[$field],
    'placeholder' => ''
  ))) ?>
<? $field = 'name'; $this->load->view('app/form', array('item' => array(
    'columns' => 3,
    'form' => $wgetId,
    'name' => $field,
    'label' => $this->lang->line('Nombre'),
    'value' => $dataItem[$field],
    'error' => $this->validation->error($field),
    'class' => $this->validation->error_class($field),
    'placeholder' => ''
  ))) ?>
<? $field = 'lastname'; $this->load->view('app/form', array('item' => array(
    'columns' => 3,
    'form' => $wgetId,
    'name' => $field,
    'label' => $this->lang->line('Apellidos'),
    'value' => $dataItem[$field],
    'error' => $this->validation->error($field),
    'class' => $this->validation->error_class($field),
    'placeholder' => ''
  ))) ?>
<? $field = 'id_country'; $this->load->view('app/form', array('item' => array(
    'type' => 'select',
    'columns' => 4,
    'form' => $wgetId,
    'name' => $field,
    'data' => $select['SelectCountry'],
    'label' => $this->lang->line('País'),
    'error' => $this->validation->error($field),
    'class' => $this->validation->error_class($field),
    'value' => $dataItem[$field],
    'placeholder' => ''
  ))) ?>
<? $field = 'dir1'; $this->load->view('app/form', array('item' => array(
    'columns' => 4,
    'form' => $wgetId,
    'name' => $field,
    'label' => $this->lang->line('Dirección'),
    'value' => $dataItem[$field],
    'error' => $this->validation->error($field),
    'class' => $this->validation->error_class($field),
    'placeholder' => ''
  ))) ?>
<? $field = 'dir2'; $this->load->view('app/form', array('item' => array(
    'columns' => 4,
    'form' => $wgetId,
    'name' => $field,
    'label' => $this->lang->line('Dirección 2'),
    'value' => $dataItem[$field],
    'error' => $this->validation->error($field),
    'class' => $this->validation->error_class($field),
    'placeholder' => ''
  ))) ?>
<? $field = 'city'; $this->load->view('app/form', array('item' => array(
    'columns' => 3,
    'form' => $wgetId,
    'name' => $field,
    'label' => $this->lang->line('Ciudad'),
    'value' => $dataItem[$field],
    'error' => $this->validation->error($field),
    'class' => $this->validation->error_class($field),
    'placeholder' => ''
  ))) ?>
<? $field = 'cp'; $this->load->view('app/form', array('item' => array(
    'columns' => 1,
    'form' => $wgetId,
    'name' => $field,
    'label' => $this->lang->line('Código Postal'),
    'value' => $dataItem[$field],
    'error' => $this->validation->error($field),
    'class' => $this->validation->error_class($field),
    'placeholder' => ''
  ))) ?>
  <div class="col col-12" style="clear:both;margin-bottom:5px;font-size:14px;color:#000"><?= $this->lang->line('Datos de envío') ?></div>
<? $field = 'id_treatment_2'; $this->load->view('app/form', array('item' => array(
    'type' => 'select',
    'columns' => 2,
    'form' => $wgetId,
    'name' => $field,
    'data' => $select['SelectUserTreatment'],
    'label' => $this->lang->line('Tratamiento'),
    'error' => $this->validation->error($field),
    'class' => $this->validation->error_class($field),
    'value' => $dataItem[$field],
    'placeholder' => ''
  ))) ?>
<? $field = 'name_2'; $this->load->view('app/form', array('item' => array(
    'columns' => 3,
    'form' => $wgetId,
    'name' => $field,
    'label' => $this->lang->line('Nombre'),
    'value' => $dataItem[$field],
    'error' => $this->validation->error($field),
    'class' => $this->validation->error_class($field),
    'placeholder' => ''
  ))) ?>
<? $field = 'lastname_2'; $this->load->view('app/form', array('item' => array(
    'columns' => 3,
    'form' => $wgetId,
    'name' => $field,
    'label' => $this->lang->line('Apellidos'),
    'value' => $dataItem[$field],
    'error' => $this->validation->error($field),
    'class' => $this->validation->error_class($field),
    'placeholder' => ''
  ))) ?>
<? $field = 'mail_2'; $this->load->view('app/form', array('item' => array(
    'columns' => 4,
    'form' => $wgetId,
    'name' => $field,
    'label' => $this->lang->line('E-mail'),
    'value' => $dataItem[$field],
    'error' => $this->validation->error($field),
    'class' => $this->validation->error_class($field),
    'placeholder' => ''
  ))) ?>
<? $field = 'id_country_2'; $this->load->view('app/form', array('item' => array(
    'type' => 'select',
    'columns' => 2,
    'form' => $wgetId,
    'name' => $field,
    'data' => $select['SelectCountry'],
    'label' => $this->lang->line('País'),
    'error' => $this->validation->error($field),
    'class' => $this->validation->error_class($field),
    'value' => $dataItem[$field],
    'placeholder' => ''
  ))) ?>
<? $field = 'dir1_2'; $this->load->view('app/form', array('item' => array(
    'columns' => 3,
    'form' => $wgetId,
    'name' => $field,
    'label' => $this->lang->line('Dirección 1'),
    'value' => $dataItem[$field],
    'error' => $this->validation->error($field),
    'class' => $this->validation->error_class($field),
    'placeholder' => ''
  ))) ?>
<? $field = 'dir2_2'; $this->load->view('app/form', array('item' => array(
    'columns' => 3,
    'form' => $wgetId,
    'name' => $field,
    'label' => $this->lang->line('Dirección 2'),
    'value' => $dataItem[$field],
    'error' => $this->validation->error($field),
    'class' => $this->validation->error_class($field),
    'placeholder' => ''
  ))) ?>
<? $field = 'city_2'; $this->load->view('app/form', array('item' => array(
    'columns' => 3,
    'form' => $wgetId,
    'name' => $field,
    'label' => $this->lang->line('Ciudad'),
    'value' => $dataItem[$field],
    'error' => $this->validation->error($field),
    'class' => $this->validation->error_class($field),
    'placeholder' => ''
  ))) ?>
<? $field = 'cp_2'; $this->load->view('app/form', array('item' => array(
    'columns' => 1,
    'form' => $wgetId,
    'name' => $field,
    'label' => $this->lang->line('Código Postal'),
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
      /*'id_state': 'required',
      'name': 'required',
      'lastname': 'required',
      'dir1': 'required',
      'dir2': 'required',
      'city': 'required',
      'cp': 'required',
      'id_country': 'required',
      'mail': 'required',
      'password': 'required',
      'name_2': 'required',
      'lastname_2': 'required',
      'dir1_2': 'required',
      'dir2_2': 'required',
      'city_2': 'required',
      'cp_2': 'required',
      'id_country_2': 'required',
      'mail_2': 'required' */     
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