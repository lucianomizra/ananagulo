<div class="jarviswidget-editbox widget-datatable-filters">
  <fieldset class="smart-form">
    <div class="row">    
    <? $field = 'date'; $this->load->view('app/form', array('item' => array(
        'type' => 'date',
        'columns' => 2,
        'form' => $wgetId,
        'name' => $field,
        'label' => $this->lang->line('Desde'),
        'value' => date('d/m/Y', time() - 60 * 60 * 24),
        'placeholder' => $this->lang->line("Seleccione fecha")
      ))) ?>
      <section class="col-filter col col-4">
        <label class="label"><?= $this->lang->line("Contenido") ?></label>
        <label class="input">
          <input type="text" id="textFormInput<?= $wgetId ?>" placeholder="<?= $this->lang->line("Escriba una palabra") ?>">
        </label>
      </section>
      <section class="col-filter col col-2-5">
        <label for="allclientsFormChk<?= $wgetId ?>" class="checkbox">
          <input id='allclientsFormChk<?= $wgetId ?>' value='1' type='checkbox' class='post' name='allclients' />
          <i></i>
          <?= $this->lang->line('Incluir todos los clientes') ?>
        </label>
      </section> 
      <section class="col col-2">
        <button type="button" id="button-datatable-search<?= $wgetId ?>" class="btn btn-primary pull-left element-no-label">
          <?= $this->lang->line("Buscar") ?>
        </button>
      </section>
    </div>
  </fieldset>
</div>
<script>
$(document).ready(function(){
  var datepickerItem = $('#dateForm<?= $wgetId ?>');
  datepickerItem.datepicker({
    defaultDate: "-1w",
    changeMonth: true,
    dateFormat: "dd/mm/yy",
    numberOfMonths: 1,
    minDate: "26/08/2014",
    maxDate: "<?= date('d/m/Y') ?>",
    prevText: '<i class="fa fa-chevron-left"></i>',
    nextText: '<i class="fa fa-chevron-right"></i>',
    onClose: function (selectedDate) {}
  });  
  $('.input-group-addon', datepickerItem.parents('.input')).click(function(){
    datepickerItem.datepicker('show');
  });
})
</script>