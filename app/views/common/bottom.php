</div>
<div class="widget-cookies">
  <div class="widget-cookies-close"><i class="fa fa-times"></i></div>
  <div class="widget-cookies-inside">
    <h3>USO DE COOKIES</h3>
    <p>Utilizamos cookies propias y de terceros para mejorar su esperiencia y nuestros servicios, analizando la navegación en nuestro sitio web. Si continúas navegando, consideramos que aceptas su uso.</p>
  </div>
</div>
<footer>
  <div class="ftexts">
    <div class="ftexts-item">
      <div class="ftexts-item-image"><img src="<?= layout('imgs/footer/sello.png') ?>" /></div>
      <div class="ftexts-item-text">
        <p class="app-bold">GARANTÍA DE CALIDAD</p>
        <p>Todos los productos de nuestra tienda online son producidos en exclusiva por Takezo para Ana Angulo y los revisamos minuciosamente antes de ponerlos a la venta.</p>
      </div>
    </div>
    <div class="ftexts-item">
      <div class="ftexts-item-image"><img src="<?= layout('imgs/footer/candado.png') ?>" /></div>
      <div class="ftexts-item-text">
        <p class="app-bold">COMPRA SEGURA</p>
        <p>Todos los datos solicitados durante la compra están protegidos mediante plataforma de pago de CaixaBank.</p>
      </div>
    </div>
    <div class="ftexts-item">
      <div class="ftexts-item-image"><img src="<?= layout('imgs/footer/camion.png') ?>" /></div>
      <div class="ftexts-item-text">
        <p>Nuestras piezas <span class="app-bold">se envían en un plazo de 24/48h</span> en días hábiles. El envío es gratuito para compras realizadas dentro del territorio peninsular. Actualmente no realizamos envíos a Ceuta, Melilla o Canarias.</p>
      </div>
    </div>
    <div class="ftexts-item">
      <div class="ftexts-item-image"><img src="<?= layout('imgs/footer/flecha.png') ?>" /></div>
      <div class="ftexts-item-text">
        <p><span class="app-bold">Devoluciones.</span> Desde el día de su recepción, el cliente podrá cambiar o devolver el producto en un plazo de 15 días. Siempre y cuando se encuentre en perfectas condiciones junto con su etiquetado original.</p>
      </div>
    </div>
  </div>
  <div class="footer">
    <div class="footer-header text-center">
      <span>Síguenos en instagram</span>
    </div>
    <div class="collapse" id="collapseInstaApi">
      <ul class="slides">
        <? $this->load->view('widget/instagram') ?>
      </ul>
    </div>    
    <div class="footer-body">
      <div class="container">
        <div class="api-instagram" data-toggle="collapse" href="#collapseInstaApi" aria-expanded="false">
          <a class="btn btn-gray">
            <i class="fa fa-instagram"></i> ANANGULO
          </a
          ><button class="btn-arrowsInstaApi fa fa-angle-up btnInstaApiUp"></button
          ><button class="btn-arrowsInstaApi fa fa-angle-down btnInstaApiDown"></button>            
        </div>
        <?/*
        <div class="api-instagram">
          <a class="btn btn-gray" target="_blank" href="https://instagram.com/anaanguloboutique" >
            <i class="fa fa-instagram"></i> ANANGULO
          </a>        
        </div>
        */?>
        <div class="row">
          <h3 class="visible-xs" data-toggle-xs="collapse" href="#collapseFooter" aria-expanded="false" aria-controls="collapseFooter">Información útil</h3>
          
          <div id="collapseFooter" class="collapse-xs">
            
            <div class="col-sm-4">
              <h3 data-toggle-xs="collapse" href="#collapseFooterMyAccout" aria-expanded="false" aria-controls="collapseFooterMyAccout">Atención al cliente</h3>
              <ul class="list-unstyled collapse-xs" id="collapseFooterMyAccout">
                <li><a href="<?= base_url()?>mi-cuenta" >Mi cuenta</a></li>
                <li><a href="<?= base_url()?>contacto" >Contacta con nosotros</a></li>
                <li><a href="<?= base_url()?>informacion/envio" >Información de envío</a></li>
                <li><a href="<?= base_url()?>informacion/devoluciones" >Devoluciones</a></li>
              </ul>
            </div>
            <div class="col-sm-4">
              <h3 data-toggle-xs="collapse" href="#collapseFooterAbout" aria-expanded="false" aria-controls="collapseFooterAbout">Sobre nosotros</h3>
              <ul class="list-unstyled collapse-xs" id="collapseFooterAbout">
                <li><a href="<?= base_url()?>informacion/ana-angulo">Ana Angulo</a></li>
                <li><a href="<?= base_url()?>informacion/terminos-y-condiciones">Términos y condiciones</a></li>
                <li><a href="<?= base_url()?>informacion/politica-de-datos">Política de datos</a></li>
              </ul>
            </div>
            <div class="col-sm-4">
              <h3 data-toggle-xs="collapse" href="#collapseFooterFallowon" aria-expanded="false" aria-controls="collapseFooterFallowon">Síguenos en</h3>
              <ul class="list-unstyled collapse-xs" id="collapseFooterFallowon">
                <li><a target="_blank" href="https://www.facebook.com/tiendasanaangulo">Facebook</a></li>
                <li><a target="_blank" href="http://twitter.com">Twitter</a></li>
                <li><a target="_blank" href="https://instagram.com/anaanguloboutique">Instagram</a></li>
              </ul>            
            </div>
          </div>

        </div>
        <? $this->load->view('widget/form-join') ?>


        <div class="footer-body-footer">
          <div class="pull-left">
            <small>© <?= date('Y') ?> All Rights Reserved. Designed &amp; Powered by <a href="http://identty.com" target="_blank"><?= img(layout().'imgs/footer/logo-identty.png'); ?></a></small>
          </div>
          <div class="pull-right">
              
            <ul class="list-inline"><? $cards = $this->Data->Cards();foreach( $cards as $i): ?>
              <li><img src="<?= upload($i->file) ?>" alt=""></li>
              <? endforeach ?>
            </ul>
          </div>
          <div class="clearfix"></div>
        </div>
      </div>
    </div>
  </div>
</footer>
<?php $this->load->view('common/analytics') ?>
<script src="<?= layout() ?>js/app.js"></script>
<script type="text/javascript" src="<?= layout() ?>js/bootstrap-select.min.js"></script>
<script type="text/javascript" src="<?= layout() ?>js/jquery.scrollTo.min.js"></script>
<script type="text/javascript" src="<?= layout() ?>js/jquery.verticalslider.js"></script>
<script type="text/javascript">
  App.Init({url:'<?= base_url() ?>', layout:'<?= layout() ?>'});
  function getCookie(cname) {
    var name = cname + "=";
    var ca = document.cookie.split(';');
    for(var i=0; i<ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0)==' ') c = c.substring(1);
        if (c.indexOf(name) == 0) return c.substring(name.length,c.length);
    }
    return "";
  }
  $(window).resize(function(){
    $('#app').css('min-height', $(window).height()  - $('header .navbar').height() - $('footer').height() )
  }).resize();
  if(!getCookie('AACookies'))
  {
    $('.widget-cookies').addClass('active');
    $('.widget-cookies').click(function(){
      document.cookie="AACookies=true; expires=Thu, 18 Dec 2020 12:00:00 UTC; path=/";
      $('.widget-cookies').fadeOut('400');
    });
  }
</script>
</body>
</html>