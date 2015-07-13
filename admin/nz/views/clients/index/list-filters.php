<div class="jarviswidget-editbox widget-datatable-filters">
  <fieldset class="smart-form">
    <div class="row">    
      <section class="col-filter col col-3">
        <label for="id_civil_statusFormSelect<?= $wgetId ?>" class="label"><?= $this->lang->line('Estado Civil') ?></label>
        <label class="select">
          <?= form_dropdown('', $select['SelectCivilStatus'], '', "id='id_civil_statusFormSelect{$wgetId}'") ?>
          <i></i>
        </label>
      </section>    
      <section class="col-filter col col-3">
        <label for="id_genderFormSelect<?= $wgetId ?>" class="label"><?= $this->lang->line('Género') ?></label>
        <label class="select">
          <?= form_dropdown('', $select['SelectGender'], '', "id='id_genderFormSelect{$wgetId}'") ?>
          <i></i>
        </label>
      </section>    
      <section class="col-filter col col-2">
        <label for="id_provinceFormSelect<?= $wgetId ?>" class="label"><?= $this->lang->line('Provincia') ?></label>
        <label class="select">
          <?= form_dropdown('', $select['SelectGeoProvince'], '', "id='id_provinceFormSelect{$wgetId}'") ?>
          <i></i>
        </label>
      </section>    
      <section class="col-filter col col-2">
        <label for="id_cantonFormSelect<?= $wgetId ?>" class="label"><?= $this->lang->line('Cantón') ?></label>
        <label class="select">
          <?= form_dropdown('', $select['SelectGeoCanton'], '', "id='id_cantonFormSelect{$wgetId}'") ?>
          <i></i>
        </label>
      </section>    
      <section class="col-filter col col-2">
        <label for="id_districtFormSelect<?= $wgetId ?>" class="label"><?= $this->lang->line('Distrito') ?></label>
        <label class="select">
          <?= form_dropdown('', $select['SelectGeoDistrict'], '', "id='id_districtFormSelect{$wgetId}'") ?>
          <i></i>
        </label>
      </section>   
    </div>
    <div class="row">
      <section class="col col-4">
        <label class="label"><?= $this->lang->line("Contenido") ?></label>
        <label class="input">
          <input type="text" id="textFormInput<?= $wgetId ?>" placeholder="<?= $this->lang->line("Escriba una palabra") ?>">
        </label>
      </section>
      <section class="col-filter col col-2-5">
        <label for="pub_mailFormChk<?= $wgetId ?>" class="checkbox">
          <input id='pub_mailFormChk<?= $wgetId ?>' value='1' type='checkbox' class='post' name='pub_mail' />
          <i></i>
          <?= $this->lang->line('Solo publicidad e-mails') ?>
        </label>
      </section>
      <section class="col-filter col col-2-5">
        <label for="pub_telFormChk<?= $wgetId ?>" class="checkbox">
          <input id='pub_telFormChk<?= $wgetId ?>' value='1' type='checkbox' class='post' name='pub_tel' />
          <i></i>
          <?= $this->lang->line('Solo publicidad teléfonos') ?>
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