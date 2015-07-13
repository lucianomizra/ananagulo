<? if(!AJAX) $this->load->view("common/header") ?>
<div id="main">
  <div class="widget-app-form widget-manager-auto">
    <div class="well no-padding">
      <form method="post" class="smart-form" autocomplete='off'>
        <header class="title-form"><?= prep_app_title($appTitle) ?></header>
        <fieldset>        
          <section>
            <div style="margin-top:10px" class="no-break">Presione comenzar para iniciar el proceso de actualización manual.</div>
          </section>
        </fieldset>        
        <footer>
          <div class="action-return pull-left">
            <a href="<?= base_url() ?>" class="app-loader"><i class="fa fa-arrow-left"></i><?= $this->lang->line("Cerrar") ?></a>
          </div> 
          <a href="<?= base_url() ?>clients/updatei" class="app-loader btn btn-primary"><?= $this->lang->line("Comenzar") ?></a>
        </footer>
      </form>
    </div>
  </div>
</div>
<script type="text/javascript">
$(function() {
  
});
</script>
<?php $this->load->view("common/footer") ?>