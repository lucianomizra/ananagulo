<div class="jarviswidget-editbox widget-datatable-filters">
  <fieldset class="smart-form">
    <div class="row">    
      <section class="col-filter col col-2">
        <label for="id_categoryFormSelect<?= $wgetId ?>" class="label"><?= $this->lang->line('Departamento') ?></label>
        <label class="select">
          <?= form_dropdown('', $select['SelectProductCategory'], '', "id='id_categoryFormSelect{$wgetId}'") ?>
          <i></i>
        </label>
      </section>    
      <section class="col-filter col col-2">
        <label for="id_subFormSelect<?= $wgetId ?>" class="label"><?= $this->lang->line('Categoría') ?></label>
        <label class="select">
          <?= form_dropdown('', array('' => $this->lang->line('Seleccionar un deparamento')), '', "id='id_subFormSelect{$wgetId}'") ?>
          <i></i>
        </label>
      </section>          <section class="col col-4">
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