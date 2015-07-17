<? if( !AJAX ) $this->load->view("common/header") ?>
<div class="widget-app-element" id="main">
<form class="widget-app-element-form" id="widget-form-<?= $wgetId ?>" method="post" action="<?= base_url() . ($idItem ? "{$appController}/{$appFunction}/element/{$idItem}" . ($quickOpen ? "/quick" : "") : "{$appController}/{$appFunction}/element/new") ?>" role="form">
  <input type="hidden" value="0" name="goback" class="form-post-goback" />
  <div class="row page-title-row">
        <div class="col-xs-12 col-sm-10 col-md-10 col-lg-8">
      <h1 class="page-title txt-color-blueDark"><i class="page-title-ico <?= $appTitleIco ?>"></i> <?= prep_app_title($appTitle) ?></h1>
    </div>
    <? $jsonobj = @json_decode($dataItem['data']); if($jsonobj) $json = (array)$jsonobj; ?>
    <? $this->load->view("app/element/buttons-header", array('alt' => true)) ?>   
      </div>
  <section class="widget-form-content">
    <div class="row">
        </div>
    <div class="clear-sm"></div>
    <div class="well-white smart-form">
      <fieldset>
        <div class="row">
        
  <div class="col col-6 col-inset">
<? $field = 'id_user'; $this->load->view('app/form', array('item' => array(
    'type' => 'select',
    'columns' => 6,
    'readonly' => true,
    'form' => $wgetId,
    'name' => $field,
    'data' => $select['SelectUser'],
    'label' => $this->lang->line('Usuario'),
    'error' => $this->validation->error($field),
    'class' => $this->validation->error_class($field),
    'value' => $dataItem[$field],
    'placeholder' => ''
  ))) ?>
<? $field = 'id_state'; unset($select['SelectCartState']['']); $this->load->view('app/form', array('item' => array(
    'type' => 'select',
    'columns' => 6,
    'form' => $wgetId,
    'name' => $field,
    'data' => $select['SelectCartState'],
    'label' => $this->lang->line('Estado'),
    'error' => $this->validation->error($field),
    'class' => $this->validation->error_class($field),
    'value' => $dataItem[$field],
    'placeholder' => ''
  ))) ?>
  
<? $field = 'id_shipping'; $this->load->view('app/form', array('item' => array(
    'type' => 'select',
    'columns' => 6,
    'form' => $wgetId,
    'name' => $field,
    'data' => $select['SelectCartShipping'],
    'label' => $this->lang->line('Transporte'),
    'error' => $this->validation->error($field),
    'class' => $this->validation->error_class($field),
    'value' => $dataItem[$field],
    'placeholder' => ''
  ))) ?>
<? $field = 'id_store'; $this->load->view('app/form', array('item' => array(
    'type' => 'select',
    'columns' => 6,
    'form' => $wgetId,
    'name' => $field,
    'data' => $select['SelectStore'],
    'label' => $this->lang->line('Tienda'),
    'error' => $this->validation->error($field),
    'class' => $this->validation->error_class($field),
    'value' => $dataItem[$field],
    'placeholder' => ''
  ))) ?>
<? $field = 'id_payment'; $this->load->view('app/form', array('item' => array(
    'type' => 'select',
    'columns' => 6,
    'form' => $wgetId,
    'name' => $field,
    'data' => $select['SelectCartPayment'],
    'label' => $this->lang->line('Forma de pago'),
    'error' => $this->validation->error($field),
    'class' => $this->validation->error_class($field),
    'value' => $dataItem[$field],
    'placeholder' => ''
  ))) ?>
<? $field = 'created'; $this->load->view('app/form', array('item' => array(
    'columns' => 6,
    'form' => $wgetId,
    'name' => $field,
    'readonly' => true,
    'label' => $this->lang->line('Fecha creación'),
    'value' => date('d/m/Y H:i:s', mysql_to_unix($dataItem[$field])),
    'error' => $this->validation->error($field),
    'class' => $this->validation->error_class($field),
    'placeholder' => ''
  ))) ?>
<? $field = 'coupon_1'; $this->load->view('app/form', array('item' => array(
    'columns' => 3,
    'readonly' => true,
    'form' => $wgetId,
    'name' => $field,
    'label' => $this->lang->line('Código de descuento'),
    'value' => $dataItem[$field],
    'error' => $this->validation->error($field),
    'class' => $this->validation->error_class($field),
    'placeholder' => ''
  ))) ?>
<? $field = 'coupon_2'; $this->load->view('app/form', array('item' => array(
    'columns' => 3,
    'readonly' => true,
    'form' => $wgetId,
    'name' => $field,
    'label' => $this->lang->line('Vale de regalo'),
    'value' => $dataItem[$field],
    'error' => $this->validation->error($field),
    'class' => $this->validation->error_class($field),
    'placeholder' => ''
  ))) ?>
<? $field = 'modified'; $this->load->view('app/form', array('item' => array(
    'columns' => 6,
    'form' => $wgetId,
    'name' => $field,
    'readonly' => true,
    'label' => $this->lang->line('Fecha finalización'),
    'value' => date('d/m/Y H:i:s', mysql_to_unix($dataItem[$field])),
    'error' => $this->validation->error($field),
    'class' => $this->validation->error_class($field),
    'placeholder' => ''
  ))) ?>
  
  
  </div>
  
  <div class="col col-6">
<? $field = 'comments'; $this->load->view('app/form', array('item' => array(
    'type' => 'textarea',
    'height' => 170,
    'form' => $wgetId,
    'name' => $field,
    'label' => $this->lang->line('Comentarios'),
    'value' => $dataItem[$field],
    'error' => $this->validation->error($field),
    'class' => $this->validation->error_class($field),
    'placeholder' => ''
  ))) ?>
  <div style="margin-top:10px"></div>
  </div>
  <div style="clear:both">
  </div>
  
  <? if($jsonobj): ?>
    <h3 style="margin-top:0;margin-left:15px;margin-bottom:5px">Datos de Usuario</h3>
  <? $field = 'name'; $this->load->view('app/form', array('item' => array(
    'columns' => 3,
    'readonly' => true,
    'form' => $wgetId,
    'label' => $this->lang->line('Nombre'),
    'value' => $json[$field],
    'placeholder' => ''
  ))) ?><? $field = 'lastname'; $this->load->view('app/form', array('item' => array(
    'columns' => 3,
    'readonly' => true,
    'form' => $wgetId,
    'label' => $this->lang->line('Apellido'),
    'value' => $json[$field],
    'placeholder' => ''
  ))) ?><? $field = 'mail'; $this->load->view('app/form', array('item' => array(
    'columns' => 3,
    'readonly' => true,
    'form' => $wgetId,
    'label' => $this->lang->line('E-mail'),
    'value' => $json[$field],
    'placeholder' => ''
  ))) ?>
  <? $field = 'cel'; $this->load->view('app/form', array('item' => array(
    'columns' => 3,
    'readonly' => true,
    'form' => $wgetId,
    'label' => $this->lang->line('Celular'),
    'value' => $json[$field],
    'placeholder' => ''
  ))) ?><? $field = 'dir1'; $this->load->view('app/form', array('item' => array(
    'columns' => 3,
    'readonly' => true,
    'form' => $wgetId,
    'label' => $this->lang->line('Dirección #1'),
    'value' => $json[$field],
    'placeholder' => ''
  ))) ?>
  <? $field = 'city'; $this->load->view('app/form', array('item' => array(
    'columns' => 3,
    'readonly' => true,
    'form' => $wgetId,
    'label' => $this->lang->line('Ciudad'),
    'value' => $json[$field],
    'placeholder' => ''
  ))) ?><? $field = 'dni'; $this->load->view('app/form', array('item' => array(
    'columns' => 3,
    'readonly' => true,
    'form' => $wgetId,
    'label' => $this->lang->line('DNI'),
    'value' => $json[$field],
    'placeholder' => ''
  ))) ?>
  <? /*$field = 'cp'; $this->load->view('app/form', array('item' => array(
    'columns' => 3,
    'readonly' => true,
    'form' => $wgetId,
    'label' => $this->lang->line('CP'),
    'value' => $json[$field],
    'placeholder' => ''
  )))*/  ?>
  <? if($json['name_2']): ?>
    <h3 style="clear:both;margin-left:15px;margin-bottom:5px">Datos de Envío</h3>
  <? $field = 'name_2'; $this->load->view('app/form', array('item' => array(
    'columns' => 3,
    'readonly' => true,
    'form' => $wgetId,
    'label' => $this->lang->line('Nombre'),
    'value' => $json[$field],
    'placeholder' => ''
  ))) ?><? $field = 'lastname_2'; $this->load->view('app/form', array('item' => array(
    'columns' => 3,
    'readonly' => true,
    'form' => $wgetId,
    'label' => $this->lang->line('Apellido'),
    'value' => $json[$field],
    'placeholder' => ''
  ))) ?>
  <? $field = 'cel_2'; $this->load->view('app/form', array('item' => array(
    'columns' => 6,
    'readonly' => true,
    'form' => $wgetId,
    'label' => $this->lang->line('Telefono #2'),
    'value' => $json[$field],
    'placeholder' => ''
  ))) ?>
  <? endif ?>
  <? endif ?>  
    <h3 style="clear:both;margin-left:15px;margin-bottom:5px">Detalle del pedido</h3>
    <? $this->load->view("sales/index/cart") ?>
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
      /*'id_user': 'required',
      'id_state': 'required',
      'created': 'required',
      'modified': 'required',
      'id_shipping': 'required',
      'id_store': 'required',
      'id_payment': 'required',
      'coupon_1': 'required',
      'coupon_2': 'required',
      'subtotal': 'required',
      'shipping': 'required',
      'tax': 'required',
      'desc1': 'required',
      'desc2': 'required',
      'total': 'required' */     
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