<?php if(!AJAX) $this->load->view('common/header') ?>
<div id="main-content">
  <div class="container widget-user">
    <ul class="breadcrums b-brown-cat">
      <li><a class="app-loader" href="<?= base_url() ?>">Home</a></li>
      <li class="divider">|</li>
      <li><a class="app-loader" href="<?= base_url() ?>user">Checkout</a></li>
    </ul>
    <div class="head-breadcrumb">
      <div class="container">
        <h1>COMPRA FINALIZADA</h1>
      </div>
    </div>    
    <section class="widget-user-finish">
      <div class="container">
        <div class="checkout-finish">Muchas gracias por tu orden, en unos instantes recibirás un correo con la información del pedido.</div>
      </div>
    </section>
  </div>
</div>
<script>
$(document).ready(function() {
  $("html, body").animate({ scrollTop: $('#main-content').offset().top }, 0);
  $('#nav .nav-menu li').removeClass('active');
  <? if(AJAX): ?> 
  App.refreshCart();  
  <? endif ?> 
});
</script>
<?php $this->load->view('common/footer') ?>
