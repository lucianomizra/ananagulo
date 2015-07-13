<div class="row checkout-center">
  <div class="col-sm-5">
    <div class="form-title">Datos de facturación</div>

    <div class="col-xs-offset-1 col-xs-10 text-right data-address">
      <a class="lnk" href="<?= base_url() ?>mi-cuenta">> Modificar los datos de facturación</a>
      <p><strong><?= $fdata['name'] ?> <?= $fdata['lastname'] ?></strong> <br>
      <?= $fdata['dni'] ?><br>
      <?= $fdata['dir1'] ?><br>
      <?= $fdata['cp'] ?> <?= $fdata['city'] ?><br>
      Teléfono: <?= $fdata['cel'] ?></p>
    </div>

  </div>
  <div class="col-sm-5 col-sm-offset-2">
  <div class="clearfix"></div>
    <div class="form-title">Dirección de envío</div>
    <div class="col-xs-offset-1 col-xs-10 text-right data-address">
      <a class="lnk" href="<?= base_url() ?>mi-cuenta">> Modificar los datos de envío</a>
      <p><strong><?= $fdata['name'] ?> <?= $fdata['lastname'] ?></strong> <br>
      <?= $fdata['dni'] ?><br>
      <?= $fdata['dir1'] ?><br>
      <?= $fdata['cp'] ?> <?= $fdata['city'] ?><br>
      Teléfono: <?= $fdata['cel'] ?></p>
    </div>
  </div>
</div>