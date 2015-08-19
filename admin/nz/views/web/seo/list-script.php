<script type="text/javascript">
var DataTableFn = function(){
  var colFilter = [1, 2, 3, 4];
  
  <? $this->load->view("script/datatable/config.js") ?>
  
  configDT.fnServerParams = function ( aoData ) {
    aoData.push( { "name": "filter-text", "value": $('#textFormInput<?= $wgetId ?>').val() } );
    <? $this->load->view("script/datatable/order.js") ?>
  };
  configDT.aoColumns = [
    { "sTitle": "<input class='checkbox-select-all' type='checkbox' />", "sWidth": "10px", "mData": "id", "bSortable": false, "bSearchable": false, "sType": "html", "mRender" : function( data, type, full ){ 
      return '<span class="checkbox"><input value="" name="" class="checkbox-select-row" type="checkbox"><i></i></span>';
    }},
    { "sWidth": "60px", "sClass": "text-align-center widget-filemanager", "sTitle": "<?= $this->lang->line("Imagen") ?>", "mData": "fm1file", "sType":"html", "mRender" : function( data, type, full ){ 
      var type = 0;
      if(data) type = full["fm1type"];
      return (data ? '<a class="no-propagation" href="<?= upload() ?>'+ full["fm1file"] +'<?= thumb_version() ?>" target="_blank">' : '') + '<div data-type="'+type +'" class="file-info type-'+ type +'"><div class="file-ico">' + ((data  && type == 1) ? '<img src="<?= thumb_url() ?>'+ full["id_file"] +'<?= thumb_version() ?>" />' : '' ) +'</div></div>' + (data ? '</a>' : '');
    }},
    { "sWidth": "100px", "sClass": "text-align-center2", "sTitle": "<?= $this->lang->line("URL") ?>", "mData": "url", "sType": "string"},
    { "sClass": "text-align-center", "sTitle": "<?= $this->lang->line("Título") ?>", "mData": "title", "sType": "string"},
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