<div class="jarviswidget-editbox widget-datatable-filters">
  <fieldset class="smart-form">
    <div class="row">    
      <section class="col-filter col col-2">
        <label for="id_typeFormSelect<?= $wgetId ?>" class="label"><?= $this->lang->line('Tipo') ?></label>
        <label class="select">
          <?= form_dropdown('', $select['SelectCouponType'], '', "id='id_typeFormSelect{$wgetId}'") ?>
          <i></i>
        </label>
      </section>
      <section class="col col-4">
        <label class="label"><?= $this->lang->line("Contenido") ?></label>
        <label class="input">
          <input type="text" id="textFormInput<?= $wgetId ?>" placeholder="<?= $this->lang->line("Escriba una palabra") ?>">
        </label>
      </section>
      <section class="col-filter col col-1-5">
        <label for="activeFormChk<?= $wgetId ?>" class="checkbox">
          <input id='activeFormChk<?= $wgetId ?>' value='1' type='checkbox' class='post' name='active' />
          <i></i>
          <?= $this->lang->line('Solo activos') ?>
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