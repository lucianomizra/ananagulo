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
  var colFilter = [1, 2, 3, 4, 5, 6, 7, 8, 9];
  
  <? $this->load->view("script/datatable/config.js") ?>
  
  configDT.fnServerParams = function ( aoData ) {
    aoData.push( { "name": "filter-id_state", "value": $('#id_stateFormSelect<?= $wgetId ?>').val() } );
    aoData.push( { "name": "filter-id_treatment", "value": $('#id_treatmentFormSelect<?= $wgetId ?>').val() } );
    aoData.push( { "name": "filter-id_country", "value": $('#id_countryFormSelect<?= $wgetId ?>').val() } );
    aoData.push( { "name": "filter-id_treatment_2", "value": $('#id_treatment_2FormSelect<?= $wgetId ?>').val() } );
    aoData.push( { "name": "filter-id_country_2", "value": $('#id_country_2FormSelect<?= $wgetId ?>').val() } );
    aoData.push( { "name": "filter-text", "value": $('#textFormInput<?= $wgetId ?>').val() } );
    aoData.push( { "name": "filter-date1", "value": $('#date1FormInput<?= $wgetId ?>').val() } );
    aoData.push( { "name": "filter-date2", "value": $('#date2FormInput<?= $wgetId ?>').val() } );
    <? $this->load->view("script/datatable/order.js") ?>
  };
  configDT.aoColumns = [
    { "sTitle": "<input class='checkbox-select-all' type='checkbox' />", "sWidth": "10px", "mData": "id", "bSortable": false, "bSearchable": false, "sType": "html", "mRender" : function( data, type, full ){ 
      return '<span class="checkbox"><input value="" name="" class="checkbox-select-row" type="checkbox"><i></i></span>';
    }},
    { "sTitle": "<?= $this->lang->line("ID") ?>", "sWidth": "40px", "mData": "id", "sType": "string"},
    { "sTitle": "<?= $this->lang->line("E-mail") ?>", "mData": "mail", "sType": "string"},
    { "sTitle": "<?= $this->lang->line("Nombre") ?>", "mData": "name", "sType": "string"},
    { "sTitle": "<?= $this->lang->line("Apellidos") ?>", "mData": "lastname", "sType": "string"},
    { "bVisible": false, "sTitle": "<?= $this->lang->line("Dirección") ?>", "mData": "dir1", "sType": "string"},
    { "sClass": "text-align-center", "bVisible": false, "sTitle": "<?= $this->lang->line("Código Postal") ?>", "mData": "cp", "sType": "string"},
    { "sClass": "text-align-center", "bVisible": false, "sTitle": "<?= $this->lang->line("Ciudad") ?>", "mData": "city", "sType": "string"},
    { "sClass": "text-align-center", "sTitle": "<?= $this->lang->line("País") ?>", "mData": "country", "sType": "string"},
    { "sClass": "text-align-center", "sWidth": "60px", "sTitle": "<?= $this->lang->line("Estado") ?>", "mData": "state", "sType": "string"},
    { "sClass": "text-align-center", "sTitle": "<?= $this->lang->line("Registro") ?>", "mData": "registro", "sType": "html", "mRender" : function( data, type, full ){ 
      if(!data || data == '0000-00-00 00:00') return '-';
      return Date.fromMysql(data).format("dd/MM/yyyy");
    }},
    { "sTitle": "<?= $this->lang->line("Acciones") ?>", "sWidth": "60px", "mData": "id", "bSortable": false, "bSearchable": false, "sType": "html", "mRender" : function( data, type, full ){ 
      return '<ul class="table-actions smart-form">' +         
      '<li><a title="<?= $this->lang->line($this->MApp->secure->edit ? "Editar" : "Ver") ?>" href="<?= base_url() . "{$appController}/{$appFunction}" ?>/element/' + data + '" class="btn btn-xs btn-default edit-button" type="button"><i class="fa fa-actions <?= $this->MApp->secure->edit ? "fa-pencil" : "fa-search" ?>"></i></a></li>' +
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