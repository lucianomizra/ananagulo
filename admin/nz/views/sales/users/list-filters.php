<div class="jarviswidget-editbox widget-datatable-filters">
  <fieldset class="smart-form">
    <div class="row">    
      <section class="col-filter col col-2">
        <label for="id_stateFormSelect<?= $wgetId ?>" class="label"><?= $this->lang->line('Estado') ?></label>
        <label class="select">
          <?= form_dropdown('', $select['SelectUserState'], '', "id='id_stateFormSelect{$wgetId}'") ?>
          <i></i>
        </label>
      </section>    
      <section class="col-filter col col-3">
        <label for="id_countryFormSelect<?= $wgetId ?>" class="label"><?= $this->lang->line('País') ?></label>
        <label class="select">
          <?= form_dropdown('', $select['SelectCountry'], '', "id='id_countryFormSelect{$wgetId}'") ?>
          <i></i>
        </label>
      </section>
      <section class="col col-4">
        <label class="label"><?= $this->lang->line("Contenido") ?></label>
        <label class="input">
          <input type="text" id="textFormInput<?= $wgetId ?>" placeholder="<?= $this->lang->line("Escriba una palabra") ?>">
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