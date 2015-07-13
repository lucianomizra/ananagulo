<script type="text/javascript">
var DataTableFn = function(){
  var colFilter = [1, 2, 3, 4, 5];
  
  <? $this->load->view("script/datatable/config.js") ?>
  
  configDT.fnServerParams = function ( aoData ) {
    aoData.push( { "name": "filter-id_category", "value": $('#id_categoryFormSelect<?= $wgetId ?>').val() } );
    aoData.push( { "name": "filter-id_sub", "value": $('#id_subFormSelect<?= $wgetId ?>').val() } );
    aoData.push( { "name": "filter-text", "value": $('#textFormInput<?= $wgetId ?>').val() } );
    <? $this->load->view("script/datatable/order.js") ?>
  };
  configDT.aoColumns = [
    { "sTitle": "<input class='checkbox-select-all' type='checkbox' />", "sWidth": "10px", "mData": "id", "bSortable": false, "bSearchable": false, "sType": "html", "mRender" : function( data, type, full ){ 
      return '<span class="checkbox"><input value="" name="" class="checkbox-select-row" type="checkbox"><i></i></span>';
    }},
    { "sTitle": "<?= $this->lang->line("ID") ?>", "sWidth": "40px", "mData": "id", "sType": "string"},
    { "sTitle": "<?= $this->lang->line("Departamento") ?>", "mData": "category", "sType": "string"},
    { "sTitle": "<?= $this->lang->line("Categoría") ?>", "mData": "sub", "sType": "string"},
    { "sTitle": "<?= $this->lang->line("Subcategoría") ?>", "mData": "sub2", "sType": "string"},    
    { "sWidth": "60px", "sClass": "text-align-center", "sTitle": "<?= $this->lang->line("Productos") ?>", "mData": "products", "sType": "string"},
    { "sWidth": "60px", "sClass": "text-align-center", "sTitle": "<?= $this->lang->line("Orden") ?>", "mData": "num", "sType": "string"},
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
  $('#id_categoryFormSelect<?= $wgetId ?>').change(function(){
    var val = $(this).val();
    if( !val )
    {
      return $('#id_subFormSelect<?= $wgetId ?>').empty().append( '<option value=""><?= $this->lang->line('Selecciona una opción') ?></option>').prop('disabled',true);
    }
    $.ajax({
      url: "<?= base_url()?>products/data/subs-select",
      type: "POST",
      data: {id:val},
      dataType: "json",
      success:function(result){
        $('#id_subFormSelect<?= $wgetId ?>').empty();
        if(!result.length)
          return $('#id_subFormSelect<?= $wgetId ?>').append( '<option value=""><?= $this->lang->line('Sin elementos') ?></option>').prop('disabled',true);
        $('#id_subFormSelect<?= $wgetId ?>').append( '<option value=""><?= $this->lang->line('Selecciona una opción') ?></option>');
        $.each( result, function( key, val ) {
          $('#id_subFormSelect<?= $wgetId ?>').append( '<option value="'+ val['id'] +'">'+val['el']+'</option>').prop('disabled',true);
        });   
        $('#id_subFormSelect<?= $wgetId ?>').prop('disabled', false);
      }
    });
    $('#id_subFormSelect<?= $wgetId ?>').empty().append( '<option value=""><?= $this->lang->line('Cargando...') ?></option>').prop('disabled',true);
  });
  setTimeout(DataTableFn, 10);
});
</script>