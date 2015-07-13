<script type="text/javascript">
var DataTableFn = function(){
  var colFilter = [1, 2, 5, 6, 7];
  
  <? $this->load->view("script/datatable/config.js") ?>
  iFixedColumns = 1;
  configDT.fnServerParams = function ( aoData ) {
    aoData.push( { "name": "filter-id_gallery", "value": $('#id_galleryFormSelect<?= $wgetId ?>').val() } );
    aoData.push( { "name": "filter-text", "value": $('#textFormInput<?= $wgetId ?>').val() } );
    <? $this->load->view("script/datatable/order.js") ?>
  };
  configDT.aoColumns = [
    { "sTitle": "<input class='checkbox-select-all' type='checkbox' />", "sWidth": "10px", "mData": "id", "bSortable": false, "bSearchable": false, "sType": "html", "mRender" : function( data, type, full ){ 
      return '<span class="checkbox"><input value="" name="" class="checkbox-select-row" type="checkbox"><i></i></span>';
    }},
    { "sWidth": "150px", "sTitle": "<?= $this->lang->line("Elemento") ?>", "mData": "grid", "sType": "string"},
    { "sTitle": "<?= $this->lang->line("Título") ?>", "mData": "title", "sType": "string"},
    { "sTitle": "<?= $this->lang->line("Subtítulo") ?>", "mData": "subtitle", "sType": "string"},
    { "bVisible":false, "sWidth": "150px", "sTitle": "<?= $this->lang->line("Subtítulo 2") ?>", "mData": "button", "sType": "string"},
    { "bVisible":false, "sClass": "text-align-center", "sTitle": "<?= $this->lang->line("Enlace") ?>", "mData": "link", "sType": "string"},
    { "sWidth": "30px", "sClass": "text-align-center td-gallery-items",  "sTitle": "<?= $this->lang->line("Imágenes") ?>", "mData": "fmg1", "sType": "html", "mRender" : function( data, type, full ){ 
      if(!full["id_gallery"] || !data || !parseInt(data)) return "<?= $this->lang->line("Sin imágenes") ?>";
      if(data == 1)
        return "<?= $this->lang->line("1 elemento") ?>";
      return "<?= $this->lang->line("{1} elementos") ?>".replace('{1}', data);
    }},
    { "sTitle": "<?= $this->lang->line("Acciones") ?>", "sWidth": "40px", "mData": "id", "bSortable": false, "bSearchable": false, "sType": "html", "mRender" : function( data, type, full ){ 
      return '<ul class="table-actions smart-form">' +         
      '<li><a title="<?= $this->lang->line($this->MApp->secure->edit ? "Editar" : "Ver") ?>" href="<?= base_url() . "{$appController}/{$appFunction}" ?>/element/' + data + '" class="btn btn-xs btn-default edit-button" type="button"><i class="fa fa-actions <?= $this->MApp->secure->edit ? "fa-pencil" : "fa-search" ?>"></i></a></li>' +
      <? if($this->model->mconfig['duplicate']): ?>'<li><a title="<?= $this->lang->line("Duplicar") ?>" href="<?= base_url() . "{$appController}/{$appFunction}" ?>/duplicate/' + data + '" class="btn btn-xs btn-default duplicate-button<?= ($this->model->mconfig['new-element'] && $this->MApp->secure->edit) ? "" : " disabled" ?>" type="button"><i class="fa fa-actions fa-copy"></i></a></li>' + <? endif ?>
      <?/*
      '<li><a title="<?= $this->lang->line("Eliminar") ?>" href="<?= base_url() . "{$appController}/{$appFunction}" ?>/delete/' + data + '" class="btn btn-xs btn-default delete-button<?= $this->MApp->secure->delete ? "" : " disabled" ?>" type="button"><i class="fa fa-actions fa-trash-o"></i></a></li>' + 
      */?>
      '</ul>';
    }}
  ];
  
  <? $this->load->view("script/datatable/script.js") ?>  
  
};
$(document).ready(function() {
  setTimeout(DataTableFn, 10);
});
</script>