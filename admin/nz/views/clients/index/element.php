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
        
<? $field = 'cod_cliente'; $this->load->view('app/form', array('item' => array(
    'columns' => 4,
    'form' => $wgetId,
    'name' => $field,
    'label' => $this->lang->line('Código Cliente'),
    'value' => $dataItem[$field],
    'error' => $this->validation->error($field),
    'class' => $this->validation->error_class($field),
    'placeholder' => ''
  ))) ?>
<? $field = 'ididentificacion'; $this->load->view('app/form', array('item' => array(
    'columns' => 4,
    'form' => $wgetId,
    'name' => $field,
    'label' => $this->lang->line('ID Identificación'),
    'value' => $dataItem[$field],
    'error' => $this->validation->error($field),
    'class' => $this->validation->error_class($field),
    'placeholder' => ''
  ))) ?>
<? $field = 'date'; $this->load->view('app/form', array('item' => array(
    'type' => 'date',
    'columns' => 4,
    'readonly' => true,
    'form' => $wgetId,
    'name' => $field,
    'label' => $this->lang->line('Fecha de Registro'),
    'value' => mysql_to_calendar($dataItem[$field]),
    'error' => $this->validation->error($field),
    'class' => $this->validation->error_class($field),
    'placeholder' => $this->lang->line("Seleccione fecha")
  ))) ?>
<? $field = 'nombre'; $this->load->view('app/form', array('item' => array(
    'columns' => 4,
    'form' => $wgetId,
    'name' => $field,
    'label' => $this->lang->line('Nombre'),
    'value' => $dataItem[$field],
    'error' => $this->validation->error($field),
    'class' => $this->validation->error_class($field),
    'placeholder' => ''
  ))) ?>
<? $field = 'apellido1'; $this->load->view('app/form', array('item' => array(
    'columns' => 4,
    'form' => $wgetId,
    'name' => $field,
    'label' => $this->lang->line('Apellido 1'),
    'value' => $dataItem[$field],
    'error' => $this->validation->error($field),
    'class' => $this->validation->error_class($field),
    'placeholder' => ''
  ))) ?>
<? $field = 'apellido2'; $this->load->view('app/form', array('item' => array(
    'columns' => 4,
    'form' => $wgetId,
    'name' => $field,
    'label' => $this->lang->line('Apellido 2'),
    'value' => $dataItem[$field],
    'error' => $this->validation->error($field),
    'class' => $this->validation->error_class($field),
    'placeholder' => ''
  ))) ?>
<? $field = 'email1'; $this->load->view('app/form', array('item' => array(
    'columns' => 4,
    'form' => $wgetId,
    'name' => $field,
    'label' => $this->lang->line('E-mail'),
    'value' => $dataItem[$field],
    'error' => $this->validation->error($field),
    'class' => $this->validation->error_class($field),
    'placeholder' => ''
  ))) ?>
<? $field = 'telefono'; $this->load->view('app/form', array('item' => array(
    'columns' => 4,
    'form' => $wgetId,
    'name' => $field,
    'label' => $this->lang->line('Teléfono'),
    'value' => $dataItem[$field],
    'error' => $this->validation->error($field),
    'class' => $this->validation->error_class($field),
    'placeholder' => ''
  ))) ?>
<? $field = 'celular'; $this->load->view('app/form', array('item' => array(
    'columns' => 4,
    'form' => $wgetId,
    'name' => $field,
    'label' => $this->lang->line('Celular'),
    'value' => $dataItem[$field],
    'error' => $this->validation->error($field),
    'class' => $this->validation->error_class($field),
    'placeholder' => ''
  ))) ?>
<? $field = 'id_province'; $this->load->view('app/form', array('item' => array(
    'type' => 'select',
    'columns' => 2,
    'form' => $wgetId,
    'name' => $field,
    'data' => $select['SelectGeoProvince'],
    'label' => $this->lang->line('Provincia'),
    'error' => $this->validation->error($field),
    'class' => $this->validation->error_class($field),
    'value' => $dataItem[$field],
    'placeholder' => ''
  ))) ?>
<? $field = 'id_canton'; $this->load->view('app/form', array('item' => array(
    'type' => 'select',
    'columns' => 2,
    'form' => $wgetId,
    'name' => $field,
    'data' => $select['SelectGeoCanton'],
    'label' => $this->lang->line('Cantón'),
    'error' => $this->validation->error($field),
    'class' => $this->validation->error_class($field),
    'value' => $dataItem[$field],
    'placeholder' => ''
  ))) ?>
<? $field = 'id_district'; $this->load->view('app/form', array('item' => array(
    'type' => 'select',
    'columns' => 2,
    'form' => $wgetId,
    'name' => $field,
    'data' => $select['SelectGeoDistrict'],
    'label' => $this->lang->line('Distrito'),
    'error' => $this->validation->error($field),
    'class' => $this->validation->error_class($field),
    'value' => $dataItem[$field],
    'placeholder' => ''
  ))) ?>
<? $field = 'id_civil_status'; $this->load->view('app/form', array('item' => array(
    'type' => 'select',
    'columns' => 2,
    'form' => $wgetId,
    'name' => $field,
    'data' => $select['SelectCivilStatus'],
    'label' => $this->lang->line('Estado Civil'),
    'error' => $this->validation->error($field),
    'class' => $this->validation->error_class($field),
    'value' => $dataItem[$field],
    'placeholder' => ''
  ))) ?>
<? $field = 'id_gender'; $this->load->view('app/form', array('item' => array(
    'type' => 'select',
    'columns' => 2,
    'form' => $wgetId,
    'name' => $field,
    'data' => $select['SelectGender'],
    'label' => $this->lang->line('Género'),
    'error' => $this->validation->error($field),
    'class' => $this->validation->error_class($field),
    'value' => $dataItem[$field],
    'placeholder' => ''
  ))) ?>
<? $field = 'birthday'; $this->load->view('app/form', array('item' => array(
    'type' => 'date',
    'columns' => 2,
    'form' => $wgetId,
    'name' => $field,
    'label' => $this->lang->line('Nacimiento'),
    'value' => mysql_to_calendar($dataItem[$field]),
    'error' => $this->validation->error($field),
    'class' => $this->validation->error_class($field),
    'placeholder' => $this->lang->line("Seleccione fecha")
  ))) ?>
<? $field = 'acumulados'; $this->load->view('app/form', array('item' => array(
    'type' => 'number',
    'columns' => 2,
    'form' => $wgetId,
    'name' => $field,
    'label' => $this->lang->line('Puntos acumulados'),
    'value' => $dataItem[$field],
    'error' => $this->validation->error($field),
    'class' => $this->validation->error_class($field),
    'placeholder' => ''
  ))) ?>
<? $field = 'redimidos'; $this->load->view('app/form', array('item' => array(
    'type' => 'number',
    'columns' => 2,
    'form' => $wgetId,
    'name' => $field,
    'label' => $this->lang->line('Puntos redimidos'),
    'value' => $dataItem[$field],
    'error' => $this->validation->error($field),
    'class' => $this->validation->error_class($field),
    'placeholder' => ''
  ))) ?>
<? $field = 'saldo_cem'; $this->load->view('app/form', array('item' => array(
    'type' => 'number',
    'columns' => 2,
    'form' => $wgetId,
    'name' => $field,
    'label' => $this->lang->line('Saldo de puntos'),
    'value' => $dataItem[$field],
    'error' => $this->validation->error($field),
    'class' => $this->validation->error_class($field),
    'placeholder' => ''
  ))) ?>
<? $field = 'acumulados_col'; $this->load->view('app/form', array('item' => array(
    'type' => 'number',
    'columns' => 2,
    'form' => $wgetId,
    'name' => $field,
    'label' => $this->lang->line('Colones acumulados'),
    'value' => $dataItem[$field],
    'error' => $this->validation->error($field),
    'class' => $this->validation->error_class($field),
    'placeholder' => ''
  ))) ?>
<? $field = 'redimidos_col'; $this->load->view('app/form', array('item' => array(
    'type' => 'number',
    'columns' => 2,
    'form' => $wgetId,
    'name' => $field,
    'label' => $this->lang->line('Colones redimidos'),
    'value' => $dataItem[$field],
    'error' => $this->validation->error($field),
    'class' => $this->validation->error_class($field),
    'placeholder' => ''
  ))) ?>
<? $field = 'saldo_col'; $this->load->view('app/form', array('item' => array(
    'type' => 'number',
    'columns' => 2,
    'form' => $wgetId,
    'name' => $field,
    'label' => $this->lang->line('Saldo de Colones'),
    'value' => $dataItem[$field],
    'error' => $this->validation->error($field),
    'class' => $this->validation->error_class($field),
    'placeholder' => ''
  ))) ?>
<? $field = 'last_cem'; $this->load->view('app/form', array('item' => array(
    'type' => 'number',
    'columns' => 2,
    'form' => $wgetId,
    'name' => $field,
    'label' => $this->lang->line('Puntos última compra'),
    'value' => $dataItem[$field],
    'error' => $this->validation->error($field),
    'class' => $this->validation->error_class($field),
    'placeholder' => ''
  ))) ?>
<? $field = 'tipos_cliente'; $this->load->view('app/form', array('item' => array(
    'columns' => 4,
    'form' => $wgetId,
    'name' => $field,
    'label' => $this->lang->line('Tipos Cliente'),
    'value' => $dataItem[$field],
    'error' => $this->validation->error($field),
    'class' => $this->validation->error_class($field),
    'placeholder' => ''
  ))) ?>
<? $field = 'pub_mail'; $this->load->view('app/form', array('item' => array(
    'columns' => 2,
    'type' => 'checkbox',
    'form' => $wgetId,
    'name' => $field,
    'label' => $this->lang->line('Publicidad E-Mail'),
    'value' => $field,
    'error' => $this->validation->error($field),
    'class' => $this->validation->error_class($field),
    'checked' => ($dataItem[$field] > 0)
  ))) ?>
<? $field = 'pub_tel'; $this->load->view('app/form', array('item' => array(
    'columns' => 2,
    'type' => 'checkbox',
    'form' => $wgetId,
    'name' => $field,
    'label' => $this->lang->line('Publicidad Teléfono'),
    'value' => $field,
    'error' => $this->validation->error($field),
    'class' => $this->validation->error_class($field),
    'checked' => ($dataItem[$field] > 0)
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
      /*'cod_cliente': 'required',
      'ididentificacion': 'required',
      'nombre': 'required',
      'apellido1': 'required',
      'apellido2': 'required',
      'f_nacimiento': 'required',
      'email1': 'required',
      'telefono': 'required',
      'celular': 'required',
      'acumulados': 'required',
      'redimidos': 'required',
      'tipos_cliente': 'required',
      'id_civil_status': 'required',
      'id_gender': 'required',
      'id_province': 'required',
      'id_canton': 'required',
      'id_district': 'required',
      'birthday': 'required',
      'date': 'required' */     
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
    var datepickerItem = $('.form-calendar.form-post-birthday', formGlobal);
  datepickerItem.datepicker({
    defaultDate: "-1w",
    changeMonth: true,
    changeYear: true,
    dateFormat: "dd/mm/yy",
    numberOfMonths: 2,
    prevText: '<i class="fa fa-chevron-left"></i>',
    nextText: '<i class="fa fa-chevron-right"></i>',
    onClose: function (selectedDate) {}
  });
  $('.input-group-addon', datepickerItem.parents('.input')).click(function(){
    datepickerItem.datepicker('show');
  });
  
});
</script>
<? $this->load->view("common/footer") ?>