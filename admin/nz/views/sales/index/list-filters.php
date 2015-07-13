<div class="jarviswidget-editbox widget-datatable-filters">
  <fieldset class="smart-form">
    <div class="row">
      <section class="col-filter col col-2">
        <label for="id_stateFormSelect<?= $wgetId ?>" class="label"><?= $this->lang->line('Estado') ?></label>
        <label class="select">
          <?= form_dropdown('', $select['SelectCartState'], '', "id='id_stateFormSelect{$wgetId}'") ?>
          <i></i>
        </label>
      </section>    
      <section class="col-filter col col-2">
        <label for="id_shippingFormSelect<?= $wgetId ?>" class="label"><?= $this->lang->line('Transporte') ?></label>
        <label class="select">
          <?= form_dropdown('', $select['SelectCartShipping'], '', "id='id_shippingFormSelect{$wgetId}'") ?>
          <i></i>
        </label>
      </section>    
      <section class="col-filter col col-2">
        <label for="id_storeFormSelect<?= $wgetId ?>" class="label"><?= $this->lang->line('Tienda') ?></label>
        <label class="select">
          <?= form_dropdown('', $select['SelectStore'], '', "id='id_storeFormSelect{$wgetId}'") ?>
          <i></i>
        </label>
      </section>     
      <section class="col-filter col col-2">
        <label for="id_storeFormSelect<?= $wgetId ?>" class="label"><?= $this->lang->line('Fecha') ?></label>
        <label class="input input-calendar">
          <span class="input-group">
            <input type="text" id="date1FormInput<?= $wgetId ?>" placeholder="<?= $this->lang->line("Inicio") ?>">
            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
          </span>
        </label>
      </section>     
      <section class="col-filter col col-2">
        <label for="id_storeFormSelect<?= $wgetId ?>" class="label">&nbsp;</label>
        <label class="input input-calendar">
          <span class="input-group">
            <input type="text" id="date2FormInput<?= $wgetId ?>" placeholder="<?= $this->lang->line("Fin") ?>">
            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
          </span>
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