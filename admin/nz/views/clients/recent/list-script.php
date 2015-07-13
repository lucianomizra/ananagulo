<script type="text/javascript">
var DataTableFn = function(){
  var colFilter = [0, 1, 2, 3 ];
  
  <? $this->load->view("script/datatable/config.js") ?>
  configDT.iDisplayLength = iDisplayLength = 10000;
  iFixedColumns = 0;
  iFixedColumnsRight = 0;
  configDT.sDom = "<'dt-top-row'T<'filter-box'f<'smart-form filter-button'>>><'dt-wrapper't><'dt-row dt-bottom-row'<'row'<'col-sm-6'i><'col-sm-6 text-right'>>";
  configDT.fnServerParams = function ( aoData ) {
    aoData.push( { "name": "filter-date", "value": $('#dateForm<?= $wgetId ?>').val() } );
    aoData.push( { "name": "filter-text", "value": $('#textFormInput<?= $wgetId ?>').val() } );
    if($('#allclientsFormChk<?= $wgetId ?>').prop('checked'))
      aoData.push( { "name": "filter-allclients", "value": 1 } );
    <? $this->load->view("script/datatable/order.js") ?>
  };
  configDT.aoColumns = [
    { "sTitle": "<?= $this->lang->line("Código") ?>", "mData": "cod_cliente", "sType": "string"},
    { "sTitle": "<?= $this->lang->line("Nombre") ?>", "mData": "nombre", "sType": "string"},
    { "sTitle": "<?= $this->lang->line("Apellido") ?>", "mData": "apellido1", "sType": "string"},
    { "sTitle": "<?= $this->lang->line("E-mail") ?>", "mData": "email1", "sType": "string"},
    { "sClass": "text-align-center", "sTitle": "<?= $this->lang->line("Registro") ?>", "mData": "date", "sType": "html", "mRender" : function( data, type, full ){ 
      if(!data || data == '0000-00-00') return '-';
      return Date.fromMysql(data).format("dd/MM/yyyy");
    }}
  ];
  
  <? $this->load->view("script/datatable/script.js") ?>  
  
};
$(document).ready(function() {
  setTimeout(DataTableFn, 10);
});
</script>