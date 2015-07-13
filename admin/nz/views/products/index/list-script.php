<script type="text/javascript">
var DataTableFn = function(){
  var colFilter = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17];
  
  <? $this->load->view("script/datatable/config.js") ?>
  iFixedColumns = 1;
  
  configDT.fnServerParams = function ( aoData ) {
    aoData.push( { "name": "filter-id_category", "value": $('#id_categoryFormSelect<?= $wgetId ?>').val() } );
    aoData.push( { "name": "filter-id_sub", "value": $('#id_subFormSelect<?= $wgetId ?>').val() } );
    aoData.push( { "name": "filter-id_sub2", "value": $('#id_sub2FormSelect<?= $wgetId ?>').val() } );
    aoData.push( { "name": "filter-id_brand", "value": $('#id_brandFormSelect<?= $wgetId ?>').val() } );
    if($('#activeFormChk<?= $wgetId ?>').prop('checked'))
      aoData.push( { "name": "filter-active", "value": 1 } );
    if($('#highlightFormChk<?= $wgetId ?>').prop('checked'))
      aoData.push( { "name": "filter-highlight", "value": 1 } );    
    if($('#reductionFormChk<?= $wgetId ?>').prop('checked'))
      aoData.push( { "name": "filter-reduction", "value": 1 } );
    aoData.push( { "name": "filter-id_state", "value": $('#id_stateFormSelect<?= $wgetId ?>').val() } );
    aoData.push( { "name": "filter-id_gallery", "value": $('#id_galleryFormSelect<?= $wgetId ?>').val() } );
    aoData.push( { "name": "filter-text", "value": $('#textFormInput<?= $wgetId ?>').val() } );
    <? $this->load->view("script/datatable/order.js") ?>
  };
  configDT.aoColumns = [
    { "sTitle": "<input class='checkbox-select-all' type='checkbox' />", "sWidth": "10px", "mData": "id", "bSortable": false, "bSearchable": false, "sType": "html", "mRender" : function( data, type, full ){ 
      return '<span class="checkbox"><input value="" name="" class="checkbox-select-row" type="checkbox"><i></i></span>';
    }},
    { "bSortable": false, "sWidth": "60px", "sClass": "text-align-center widget-filemanager", "sTitle": "<?= $this->lang->line("Imagen") ?>", "mData": "fm1file", "sType":"html", "mRender" : function( data, type, full ){ 
      var type = 0;
      if(data) type = full["fm1type"];
      return (data ? '<a class="no-propagation" href="<?= upload() ?>'+ full["fm1file"] +'" target="_blank">' : '') + '<div data-type="'+type +'" class="file-info type-'+ type +'"><div class="file-ico">' + ((data  && type == 1) ? '<img src="<?= thumb_url() ?>'+ full["id_file"] +'" />' : '' ) +'</div></div>' + (data ? '</a>' : '');
    }},
    { "bSortable": false, "sClass": "text-align-center", "sTitle": "<?= $this->lang->line("Código") ?>", "mData": "code", "sType": "string"},
    { "bSortable": false, "sTitle": "<?= $this->lang->line("Nombre") ?>", "mData": "name", "sType": "string"},
    { "bSortable": false, "sTitle": "<?= $this->lang->line("Categoría") ?>", "mData": "category", "sType": "string"},
    { "bSortable": false, "sTitle": "<?= $this->lang->line("Subcategoría") ?>", "mData": "sub", "sType": "string"},
    { "bSortable": false, "sTitle": "<?= $this->lang->line("Subcategoría 2") ?>", "mData": "sub2", "sType": "string"},
    { "bSortable": false, "sClass": "text-align-center", "sTitle": "<?= $this->lang->line("Precio") ?>", "mData": "cost", "sType": "string"},
    { "bSortable": false, "bVisible": false, "sClass": "text-align-center", "sTitle": "<?= $this->lang->line("Precio Antiguo") ?>", "mData": "cost2", "sType": "string"},
    { "sClass": "text-align-center", "sWidth": "40px", "sTitle": "<?= $this->lang->line("Activo") ?>", "mData": "active", "sType": "html", "mRender" : function( data, type, full ){ 
      if(!data || !parseInt(data)) return '<?= $this->lang->line("No") ?>';
      return '<?= $this->lang->line("Si") ?>';
    }},
    { "bSortable": false, "sClass": "text-align-center", "sWidth": "40px", "sTitle": "<?= $this->lang->line("Recomendado") ?>", "mData": "highlight", "sType": "html", "mRender" : function( data, type, full ){ 
      if(!data || !parseInt(data)) return '<?= $this->lang->line("No") ?>';
      return '<?= $this->lang->line("Si") ?>';
    }},
    { "bSortable": false, "sClass": "text-align-center", "sWidth": "40px", "sTitle": "<?= $this->lang->line("Rebaja") ?>", "mData": "reduction", "sType": "html", "mRender" : function( data, type, full ){ 
      if(!data || !parseInt(data)) return '<?= $this->lang->line("No") ?>';
      return '<?= $this->lang->line("Si") ?>';
    }},
    { "bSortable": false, "sClass": "text-align-center", "bVisible": false, "sTitle": "<?= $this->lang->line("Disponibilidad") ?>", "mData": "state", "sType": "string"},   
    { "bSortable": false, "bVisible": false, "sWidth": "30px", "sClass": "text-align-center td-gallery-items",  "sTitle": "<?= $this->lang->line("Imágenes") ?>", "mData": "fmg1", "sType": "html", "mRender" : function( data, type, full ){ 
      if(!full["id_gallery"] || !data || !parseInt(data)) return "<?= $this->lang->line("Vacía") ?>";
      if(data == 1)
        return "<?= $this->lang->line("1 elemento") ?>";
      return "<?= $this->lang->line("{1} elementos") ?>".replace('{1}', data);
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
  $('#id_subFormSelect<?= $wgetId ?>').change(function(){
    var val = $(this).val();
    if( !val )
    {
      return $('#id_sub2FormSelect<?= $wgetId ?>').empty().append( '<option value=""><?= $this->lang->line('Selecciona una opción') ?></option>').prop('disabled',true);
    }
    $.ajax({
      url: "<?= base_url()?>products/data/subs2-select",
      type: "POST",
      data: {id:val},
      dataType: "json",
      success:function(result){
        $('#id_sub2FormSelect<?= $wgetId ?>').empty();
        if(!result.length)
          return $('#id_sub2FormSelect<?= $wgetId ?>').append( '<option value=""><?= $this->lang->line('Sin elementos') ?></option>').prop('disabled',true);
        $('#id_sub2FormSelect<?= $wgetId ?>').append( '<option value=""><?= $this->lang->line('Selecciona una opción') ?></option>');
        $.each( result, function( key, val ) {
          $('#id_sub2FormSelect<?= $wgetId ?>').append( '<option value="'+ val['id'] +'">'+val['el']+'</option>').prop('disabled',true);
        });   
        $('#id_sub2FormSelect<?= $wgetId ?>').prop('disabled', false);
      }
    });
    $('#id_sub2FormSelect<?= $wgetId ?>').empty().append( '<option value=""><?= $this->lang->line('Cargando...') ?></option>').prop('disabled',true);
  });
  $('#id_categoryFormSelect<?= $wgetId ?>').change(function(){
    var val = $(this).val();
    if( !val )
    {
      $('#id_brandFormSelect<?= $wgetId ?>').empty().append( '<option value=""><?= $this->lang->line('Selecciona una opción') ?></option>').prop('disabled',true);
      $('#id_subFormSelect<?= $wgetId ?>').empty().append( '<option value=""><?= $this->lang->line('Selecciona una opción') ?></option>').prop('disabled',true);
      $('#id_sub2FormSelect<?= $wgetId ?>').empty().append( '<option value=""><?= $this->lang->line('Selecciona una categoría') ?></option>').prop('disabled',true);
      return 
    }    
    $.ajax({
      url: "<?= base_url()?>products/data/brands-select",
      type: "POST",
      data: {id:val},
      dataType: "json",
      success:function(result){
        $('#id_brandFormSelect<?= $wgetId ?>').empty();
        if(!result.length)
          return $('#id_brandFormSelect<?= $wgetId ?>').append( '<option value=""><?= $this->lang->line('Sin elementos') ?></option>').prop('disabled',true);
        $('#id_brandFormSelect<?= $wgetId ?>').append( '<option value=""><?= $this->lang->line('Selecciona una opción') ?></option>');
        $.each( result, function( key, val ) {
          $('#id_brandFormSelect<?= $wgetId ?>').append( '<option value="'+ val['id'] +'">'+val['el']+'</option>').prop('disabled',true);
        });   
        $('#id_brandFormSelect<?= $wgetId ?>').prop('disabled', false);
      }
    });
    $.ajax({
      url: "<?= base_url()?>products/data/subs-select",
      type: "POST",
      data: {id:val},
      dataType: "json",
      success:function(result){
        $('#id_subFormSelect<?= $wgetId ?>').empty();
        $('#id_sub2FormSelect<?= $wgetId ?>').empty().append( '<option value=""><?= $this->lang->line('Selecciona una categoría') ?></option>').prop('disabled',true);
        if(!result.length)
          return $('#id_subFormSelect<?= $wgetId ?>').append( '<option value=""><?= $this->lang->line('Sin elementos') ?></option>').prop('disabled',true);
        $('#id_subFormSelect<?= $wgetId ?>').append( '<option value=""><?= $this->lang->line('Selecciona una opción') ?></option>');
        $.each( result, function( key, val ) {
          $('#id_subFormSelect<?= $wgetId ?>').append( '<option value="'+ val['id'] +'">'+val['el']+'</option>').prop('disabled',true);
        });   
        $('#id_subFormSelect<?= $wgetId ?>').prop('disabled', false);
      }
    });
    $('#id_brandFormSelect<?= $wgetId ?>').empty().append( '<option value=""><?= $this->lang->line('Cargando...') ?></option>').prop('disabled',true);
    $('#id_subFormSelect<?= $wgetId ?>').empty().append( '<option value=""><?= $this->lang->line('Cargando...') ?></option>').prop('disabled',true);
  });
  setTimeout(DataTableFn, 10);
});
</script>