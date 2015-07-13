<div class="jarviswidget-editbox widget-datatable-filters">
  <fieldset class="smart-form">
    <div class="row">    
      <section class="col-filter col col-3">
        <label for="id_categoryFormSelect<?= $wgetId ?>" class="label"><?= $this->lang->line('Categoría') ?></label>
        <label class="select">
          <?= form_dropdown('', $select['SelectProductCategory'], '', "id='id_categoryFormSelect{$wgetId}'") ?>
          <i></i>
        </label>
      </section>    
      <section class="col-filter col col-3">
        <label for="id_brandFormSelect<?= $wgetId ?>" class="label"><?= $this->lang->line('Marca') ?></label>
        <label class="select">
          <?= form_dropdown('', array('' => $this->lang->line('Seleccionar un departamento')), '', "id='id_brandFormSelect{$wgetId}'") ?>
          <i></i>
        </label>
      </section>  
      <section class="col-filter col col-3">
        <label for="id_subFormSelect<?= $wgetId ?>" class="label"><?= $this->lang->line('Subcategoría') ?></label>
        <label class="select">
          <?= form_dropdown('', array('' => $this->lang->line('Seleccionar un departamento')), '', "id='id_subFormSelect{$wgetId}'") ?>
          <i></i>
        </label>
      </section>    
      <section class="col-filter col col-3">
        <label for="id_sub2FormSelect<?= $wgetId ?>" class="label"><?= $this->lang->line('Subcategoría 2') ?></label>
        <label class="select">
          <?= form_dropdown('', array('' => $this->lang->line('Seleccionar una categoría')), '', "id='id_sub2FormSelect{$wgetId}'") ?>
          <i></i>
        </label>
      </section>   
    </div>
    <div class="row">
    
      <section class="col-filter col col-2">
        <label for="id_stateFormSelect<?= $wgetId ?>" class="label"><?= $this->lang->line('Disponibilidad') ?></label>
        <label class="select">
          <?= form_dropdown('', $select['SelectProductState'], '', "id='id_stateFormSelect{$wgetId}'") ?>
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
      <section class="col-filter col col-2">
        <label for="highlightFormChk<?= $wgetId ?>" class="checkbox">
          <input id='highlightFormChk<?= $wgetId ?>' value='1' type='checkbox' class='post' name='highlight' />
          <i></i>
          <?= $this->lang->line('Solo recomendados') ?>
        </label>
      </section>        
      <section class="col-filter col col-1-5">
        <label for="reductionFormChk<?= $wgetId ?>" class="checkbox">
          <input id='reductionFormChk<?= $wgetId ?>' value='1' type='checkbox' class='post' name='reduction' />
          <i></i>
          <?= $this->lang->line('Solo rebajas') ?>
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