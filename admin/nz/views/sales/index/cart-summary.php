<div class="checkout-total-box">

  <? if( round($desc1,2) || round($desc2,2) ): ?>
  <div class="checkout-total-row">
    <div class="checkout-total-col">                  
      Subtotal
    </div>
    <div class="checkout-total-col">         
      <?= $this->model->prep_cost($subtotal, true, false); ?>
    </div>
  </div>
  <? endif ?>
  <?/*
  <div class="checkout-total-row">
    <div class="checkout-total-col">                  
      Transporte
    </div>
    <div class="checkout-total-col">                  
      <?= $this->model->prep_cost($shipping, true, false); ?>              
    </div>
  </div>
  <div class="checkout-total-row">
    <div class="checkout-total-col">                  
      TAX
    </div>
    <div class="checkout-total-col">                  
    <?= $this->model->prep_cost($tax, true, false); ?>
    </div>
  </div>
  */?>
  <? ?>
  <? if( round($desc1,2) ): ?>
  <div class="checkout-total-row">
    <div class="checkout-total-col">                  
      Cupon
    </div>
    <div style="color:#1AA8C4" class="checkout-total-col">                  
     - <?= $this->model->prep_cost($desc1, true, false); ?>
    </div>
  </div>
  <? endif ?>
  <? if(round($desc2,2)): ?>
  <div class="checkout-total-row">
    <div class="checkout-total-col">                  
      Vale de regalo
    </div>
    <div style="color:#1AA8C4" class="checkout-total-col">                  
     - <?= $this->model->prep_cost($desc2, true, false); ?>
    </div>
  </div>
  <? endif ?>
  <div class="checkout-total-row row-total">
    <div class="checkout-total-col">                  
      Total:
    </div>
    <div class="checkout-total-col">
      <?= $this->model->prep_cost($total, true, false); ?>              
    </div>
  </div>
</div>