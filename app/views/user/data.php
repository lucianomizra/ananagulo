<div class="row checkout-center rowoffxdt">
  <div class="col-sm-5 offxdty">
    <div class="form-title">Datos de facturación</div>

    <div class="col-xs-offset-1 col-xs-10 text-right data-address data-addressy">
      <a class="lnk" href="<?= base_url() ?>mi-cuenta#form-data">> Modificar los datos de facturación</a>
      <p><strong><?= $fdata['name'] ?> <?= $fdata['lastname'] ?></strong> <br>
      <?= $fdata['dni'] ?><br>
      <?= $fdata['dir1'] ?><br>
      <?= $fdata['cp'] ?> <?= $fdata['city'] ?><br>
      Teléfono: <?= $fdata['cel'] ?></p>
    </div>

  </div>
  <div class="col-sm-5 col-sm-offset-2 offxdt">
  <div class="clearfix"></div>
    <div class="form-title">Datos de envío</div>
    <div class="col-xs-offset-1 col-xs-10 text-right data-address data-addressx ">
      <a class="lnk" href="<?= base_url() ?>mi-cuenta#form-data">> Modificar los datos de envío</a>
      <p><strong><?= isset($fdata['name_2']) ? $fdata['name_2'] : $fdata['name'] ?><?= isset($fdata['lastname_2']) ? $fdata['lastname_2'] : $fdata['lastname'] ?></strong> <br>
      <?= $fdata['dni'] ?><br>
      <?= $fdata['dir1'] ?><br>
      <?= $fdata['cp'] ?> <?= $fdata['city'] ?><br>
      Teléfono: <?= isset($fdata['cel_2']) ? $fdata['cel_2'] : $fdata['cel'] ?></p>
    </div>
  </div>
</div>