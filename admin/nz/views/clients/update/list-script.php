<script type="text/javascript">
var DataTableFn = function(){
  var colFilter = [1, 2, 3, 4];
  
  <? $this->load->view("script/datatable/config.js") ?>
  iFixedColumnsLeft = 1;
  iFixedColumnsRight = 0;
  
  configDT.fnServerParams = function ( aoData ) {
    aoData.push( { "name": "filter-text", "value": $('#textFormInput<?= $wgetId ?>').val() } );
    <? $this->load->view("script/datatable/order.js") ?>
  };
  configDT.aoColumns = [
    { "sTitle": "<?= $this->lang->line("ID") ?>", "sWidth": "40px", "mData": "id", "sType": "string"},
    { "sClass": "text-align-center", "sTitle": "<?= $this->lang->line("Fecha") ?>", "mData": "date", "sType": "html", "mRender" : function( data, type, full ){ 
      if(!data || data == '0000-00-00 00:00') return '-';
      return Date.fromMysql(data).format("dd/MM/yyyy hh:mm:ss");
    }},
    { "sClass": "text-align-center", "sTitle": "<?= $this->lang->line("Registros") ?>", "mData": "items", "sType": "string"},
    { "sClass": "text-align-center", "sTitle": "<?= $this->lang->line("Modificaciones") ?>", "mData": "items2", "sType": "string"},
  ];
  
  <? $this->load->view("script/datatable/script.js") ?>  
  
};
$(document).ready(function() {
  setTimeout(DataTableFn, 10);
});
</script>