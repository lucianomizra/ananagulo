<div class="jarviswidget-editbox widget-datatable-filters">
  <fieldset class="smart-form">
    <div class="row">
      <section class="col-filter col col-1-5">
        <label for="show_nameFormChk<?= $wgetId ?>" class="checkbox">
          <input id='show_nameFormChk<?= $wgetId ?>' value='1' type='checkbox' class='post' name='show_name' />
          <i></i>
          <?= $this->lang->line('Solo mostrar nombres') ?>
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