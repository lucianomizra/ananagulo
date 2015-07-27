<script type="text/javascript">

  var datepickerItem = $('#date1FormInput<?= $wgetId ?>');
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
  var datepickerItem2 = $('#date2FormInput<?= $wgetId ?>');
  datepickerItem2.datepicker({
    defaultDate: "-1w",
    changeMonth: true,
    changeYear: true,
    dateFormat: "dd/mm/yy",
    numberOfMonths: 2,
    prevText: '<i class="fa fa-chevron-left"></i>',
    nextText: '<i class="fa fa-chevron-right"></i>',
    onClose: function (selectedDate) {}
  });
  $('.input-group-addon', datepickerItem2.parents('.input')).click(function(){
    datepickerItem2.datepicker('show');
  });

var DataTableFn = function(){
  var colFilter = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16.17,18,19,20,21,22];
  
  <? $this->load->view("script/datatable/config.js") ?>
  
  configDT.fnServerParams = function ( aoData ) {
    aoData.push( { "name": "filter-id_user", "value": $('#id_userFormSelect<?= $wgetId ?>').val() } );
    aoData.push( { "name": "filter-id_state", "value": $('#id_stateFormSelect<?= $wgetId ?>').val() } );
    aoData.push( { "name": "filter-id_shipping", "value": $('#id_shippingFormSelect<?= $wgetId ?>').val() } );
    aoData.push( { "name": "filter-id_store", "value": $('#id_storeFormSelect<?= $wgetId ?>').val() } );
    aoData.push( { "name": "filter-id_payment", "value": $('#id_paymentFormSelect<?= $wgetId ?>').val() } );
    aoData.push( { "name": "filter-date1", "value": $('#date1FormInput<?= $wgetId ?>').val() } );
    aoData.push( { "name": "filter-date2", "value": $('#date2FormInput<?= $wgetId ?>').val() } );
    <? $this->load->view("script/datatable/order.js") ?>
  };
  configDT.aoColumns = [
    { "sTitle": "<input class='checkbox-select-all' type='checkbox' />", "sWidth": "10px", "mData": "id", "bSortable": false, "bSearchable": false, "sType": "html", "mRender" : function( data, type, full ){ 
      return '<span class="checkbox"><input value="" name="" class="checkbox-select-row" type="checkbox"><i></i></span>';
    }},    
    { "sWidth": "40px", "sTitle": "<?= $this->lang->line("Código") ?>", "mData": "code", "sType": "html", "mRender" : function( data, type, full ){  
      return 'P' + ('000000' + data).slice(-5);
    }},
    { "sClass": "text-align-center", "sTitle": "<?= $this->lang->line("Fecha") ?>", "mData": "modified", "sType": "html", "mRender" : function( data, type, full ){ 
      if(!data || data == '0000-00-00 00:00') return '-';
      return Date.fromMysql(data).format("dd/MM/yyyy hh:mm:ss");
    }},
    { "sTitle": "<?= $this->lang->line("E-mail") ?>", "mData": "user", "sType": "string"},
    { "sTitle": "<?= $this->lang->line("Nombre") ?>", "mData": "data", "sType": "html", "mRender" : function( data, type, full ){ 
      var json = JSON.parse(data);
      if(!json || !json.name) return "";
      return json.name;
    }},
    { "sTitle": "<?= $this->lang->line("Apellido") ?>", "mData": "data", "sType": "html", "mRender" : function( data, type, full ){ 
      var json = JSON.parse(data);
      if(!json || !json.lastname) return "";
      return json.lastname;
    }},
    { "bVisible": false, "sTitle": "<?= $this->lang->line("Dirección") ?>", "mData": "data", "sType": "html", "mRender" : function( data, type, full ){ 
      var json = JSON.parse(data);
      if(!json || !json.dir1) return "";
      return json.dir1;
    }},
    { "bVisible": false, "sTitle": "<?= $this->lang->line("Ciudad") ?>", "mData": "data", "sType": "html", "mRender" : function( data, type, full ){ 
      var json = JSON.parse(data);
      if(!json || !json.city) return "";
      return json.city;
    }},
    { "bVisible": false, "sTitle": "<?= $this->lang->line("CP") ?>", "mData": "data", "sType": "html", "mRender" : function( data, type, full ){ 
      var json = JSON.parse(data);
      if(!json || !json.cp) return "";
      return json.cp;
    }},
    { "bVisible": false, "sTitle": "<?= $this->lang->line("DNI") ?>", "mData": "data", "sType": "html", "mRender" : function( data, type, full ){ 
      var json = JSON.parse(data);
      if(!json || !json.dni) return "";
      return json.dni;
    }},
    { "bVisible": false, "sTitle": "<?= $this->lang->line("Teléfono") ?>", "mData": "data", "sType": "html", "mRender" : function( data, type, full ){ 
      var json = JSON.parse(data);
      if(!json || !json.cel) return "";
      return json.cel;
    }},
    { "bVisible": false, "sTitle": "<?= $this->lang->line("Nombre (envío)") ?>", "mData": "data", "sType": "html", "mRender" : function( data, type, full ){ 
      var json = JSON.parse(data);
      if(!json || !json.name) return "";
      return (json.name_2 != undefined ) ? json.name_2 : json.name;
    }},
    { "bVisible": false, "sTitle": "<?= $this->lang->line("Apellido (envío)") ?>", "mData": "data", "sType": "html", "mRender" : function( data, type, full ){ 
      var json = JSON.parse(data);
      if(!json || !json.lastname) return "";
      return (json.lastname_2 != undefined ) ? json.lastname_2 : json.lastname;
    }},
    { "bVisible": false, "sTitle": "<?= $this->lang->line("Teléfono (envío)") ?>", "mData": "data", "sType": "html", "mRender" : function( data, type, full ){ 
      var json = JSON.parse(data);
      if(!json || !json.cel) return "";
      return (json.cel_2 != undefined ) ? json.cel_2 : json.cel;
    }},
    { "sTitle": "<?= $this->lang->line("Estado") ?>", "mData": "state", "sType": "string"},
    { "sTitle": "<?= $this->lang->line("Transporte") ?>", "mData": "shippingx", "sType": "string"},
    { "sTitle": "<?= $this->lang->line("Forma de pago") ?>", "mData": "payment", "sType": "string"},
    { "bVisible": false, "sClass": "text-align-center", "sTitle": "<?= $this->lang->line("Subtotal") ?>", "mData": "subtotal", "sType": "string"},
    { "bVisible": false, "sClass": "text-align-center", "sTitle": "<?= $this->lang->line("Portes") ?>", "mData": "shipping", "sType": "string"},
    { "bVisible": false, "sClass": "text-align-center", "sTitle": "<?= $this->lang->line("TAX") ?>", "mData": "tax", "sType": "string"},
    { "bVisible": false, "sClass": "text-align-center", "sTitle": "<?= $this->lang->line("Descuento") ?>", "mData": "desc1", "sType": "string"},
    { "bVisible": false, "sClass": "text-align-center", "sTitle": "<?= $this->lang->line("Data Extra") ?>", "mData": "payment_data", "sType": "string"},
    { "sClass": "text-align-center", "sTitle": "<?= $this->lang->line("Total") ?>", "mData": "total", "sType": "string"},
    { "sTitle": "<?= $this->lang->line("Acciones") ?>", "sWidth": "60px", "mData": "id", "bSortable": false, "bSearchable": false, "sType": "html", "mRender" : function( data, type, full ){ 
      return '<ul class="table-actions smart-form">' +        
      '<li><a target="_blank" title="<?= $this->lang->line("Revisar") ?>" href="<?= base_url() . "{$appController}" ?>/detailscart/' + data + '" class="btn btn-xs btn-default" type="button"><i class="fa fa-actions fa-search"></i></a></li>' +      
      <? if($this->model->mconfig['duplicate']): ?>'<li><a title="<?= $this->lang->line("Duplicar") ?>" href="<?= base_url() . "{$appController}/{$appFunction}" ?>/duplicate/' + data + '" class="btn btn-xs btn-default duplicate-button<?= ($this->model->mconfig['new-element'] && $this->MApp->secure->edit) ? "" : " disabled" ?>" type="button"><i class="fa fa-actions fa-copy"></i></a></li>' + <? endif ?>
      '<li><a title="<?= $this->lang->line("Eliminar") ?>" href="<?= base_url() . "{$appController}/{$appFunction}" ?>/delete/' + data + '" class="btn btn-xs btn-default delete-button<?= $this->MApp->secure->delete ? "" : " disabled" ?>" type="button"><i class="fa fa-actions fa-trash-o"></i></a></li>' + 
      '</ul>';
    }}
  ];
  
  <? $this->load->view("script/datatable/script.js") ?>  
  
};
$(document).ready(function() {
  setTimeout(DataTableFn, 10);
});
</script>