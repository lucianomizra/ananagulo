<footer>
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
                <li><a target="_blank" href="https://pinterest.com/">Pinterest</a></li>
                <li><a target="_blank" href="https://instagram.com/anaanguloboutique">Instagram</a></li>
              </ul>            
            </div>
          </div>

        </div>
        <? $this->load->view('widget/form-join') ?>


        <div class="footer-body-footer">
          <div class="pull-left">
            <small>© <?= date('Y') ?> All Rights Reserved. Designed &amp; Powered by <?= img(layout().'imgs/footer/logo-identty.png'); ?></small>
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
<script src="<?= layout() ?>js/app.js"></script>
<script type="text/javascript" src="<?= layout() ?>js/bootstrap-select.min.js"></script>
<script type="text/javascript" src="<?= layout() ?>js/jquery.scrollTo.min.js"></script>
<script type="text/javascript" src="<?= layout() ?>js/jquery.verticalslider.js"></script>
<script type="text/javascript">
  App.Init({url:'<?= base_url() ?>', layout:'<?= layout() ?>'});
</script>
</body>
</html>