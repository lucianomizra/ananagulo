<script type="text/javascript">
var DataTableFn = function(){
  var colFilter = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22];
  
  <? $this->load->view("script/datatable/config.js") ?>
  iFixedColumns = 1;
  
  configDT.fnServerParams = function ( aoData ) {
    aoData.push( { "name": "filter-id_civil_status", "value": $('#id_civil_statusFormSelect<?= $wgetId ?>').val() } );
    aoData.push( { "name": "filter-id_gender", "value": $('#id_genderFormSelect<?= $wgetId ?>').val() } );
    aoData.push( { "name": "filter-id_province", "value": $('#id_provinceFormSelect<?= $wgetId ?>').val() } );
    aoData.push( { "name": "filter-id_canton", "value": $('#id_cantonFormSelect<?= $wgetId ?>').val() } );
    aoData.push( { "name": "filter-id_district", "value": $('#id_districtFormSelect<?= $wgetId ?>').val() } );
    if($('#pub_mailFormChk<?= $wgetId ?>').prop('checked'))
      aoData.push( { "name": "filter-pub_mail", "value": 1 } );
    if($('#pub_telFormChk<?= $wgetId ?>').prop('checked'))
      aoData.push( { "name": "filter-pub_tel", "value": 1 } );
    aoData.push( { "name": "filter-text", "value": $('#textFormInput<?= $wgetId ?>').val() } );
    <? $this->load->view("script/datatable/order.js") ?>
  };
  configDT.aoColumns = [
    { "sTitle": "<input class='checkbox-select-all' type='checkbox' />", "sWidth": "10px", "mData": "id", "bSortable": false, "bSearchable": false, "sType": "html", "mRender" : function( data, type, full ){ 
      return '<span class="checkbox"><input value="" name="" class="checkbox-select-row" type="checkbox"><i></i></span>';
    }},
    { "sWidth": "70px", "sTitle": "<?= $this->lang->line("Código Cliente") ?>", "mData": "cod_cliente", "sType": "string"},
    { "sWidth": "70px", "sTitle": "<?= $this->lang->line("ID Identificación") ?>", "mData": "ididentificacion", "sType": "string"},
    { "bSortable": false, "sTitle": "<?= $this->lang->line("Nombre") ?>", "mData": "nombre", "sType": "html", "mRender" : function( data, type, full ){ 
      return full['nombre'] + ' ' + full['apellido1'] + ' ' + full['apellido2'];
    }},
    { "sWidth": "100px", "sTitle": "<?= $this->lang->line("E-mail") ?>", "mData": "email1", "sType": "string"},
    { "sClass": "text-align-center", "sWidth": "40px", "sTitle": "<?= $this->lang->line("Pub. E-Mail") ?>", "mData": "pub_mail", "sType": "html", "mRender" : function( data, type, full ){ 
      if(!data || !parseInt(data)) return '<?= $this->lang->line("No") ?>';
      return '<?= $this->lang->line("Si") ?>';
    }},
    { "sWidth": "70px", "sClass": "text-align-center", "sWidth": "40px", "sTitle": "<?= $this->lang->line("Pub. Tel") ?>", "mData": "pub_tel", "sType": "html", "mRender" : function( data, type, full ){ 
      if(!data || !parseInt(data)) return '<?= $this->lang->line("No") ?>';
      return '<?= $this->lang->line("Si") ?>';
    }},
    { "sWidth": "60px", "sClass": "text-align-center", "sTitle": "<?= $this->lang->line("Registro") ?>", "mData": "date", "sType": "html", "mRender" : function( data, type, full ){ 
      if(!data || data == '0000-00-00') return '-';
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