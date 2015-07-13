<?php if(!AJAX) $this->load->view('common/header') ?>
<div id="page-info" data-section="cart"></div>
<div class="container">
  <div class="page-cart row-products-filter">
    <div class="page-cart-header">
      <ol class="breadcrumb pull-left">
        <li><a href="<?= base_url() ?>">Ana Angulo</a></li>
        <li class="active">Cesta</li>
      </ol>

      <div class="clearfix"></div>

      <h1 class="hstyle1 bgcut">Tu cesta de compra</h1>
    </div>
    <div class="page-cart-body">
      <? $this->load->view('cart/table') ?>        
    </div>
<? /* 
    <div class="page-header style2">
      <div class="container">
          
        <div class="row">
          <h3><a data-toggle="collapse" href="#collapseCuppon" aria-expanded="false" aria-controls="collapseCuppon">¿Tienes algun código de descuento?</a></h3>
  
          <div class="collapse text-center" id="collapseCuppon" role="tabpanel">
            <div class="box-cupon">
              <p>
              Aplica tu codigo y lorem ipsum dolara amet.<br>
              Aplica tu codigo y lorem ipsum dolara amet:
              </p>

              <div class="form-group">
                <label for="cupon"></label>
                <input type="text" name="cupon" id="cupon" class="form-control btn-block">
              </div>
              <button class="btn btn-block btn-gold">
                Aplicar cambio
              </button>
            </div>

            <div id="CupponError">*Su código no es correcto. <br> Vuelva a intentar o póngase en contacto con nosotros <a href="">aquí</a>.</div>
          </div>
          

        </div>
      </div>
    </div>*/?>
    

    <div class="row sale-box">
      <? if(!count($cartItems)) : ?>
      <div class="col-sm-offset-4 col-sm-4 text-center">
        <a href="<?= base_url() ?>productos" class="btn btn-block btn-default">Seguir comprando</a>
      </div>
      <? else : ?>
      <div class="col-sm-offset-2 col-sm-4">
        <a href="<?= base_url() ?>productos" class="btn btn-block btn-default">Seguir comprando</a>
      </div>
      <div class="col-sm-4">
        <a href="<?= base_url() ?>mi-cuenta/step-3"  class="btn btn-block btn-primary">Realizar pedido</a>
      </div>
      <? endif ?>
    </div>
  </div>  
</div>

<?php $this->load->view('common/footer') ?>
