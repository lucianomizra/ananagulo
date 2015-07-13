<?php if(!AJAX) $this->load->view('common/header') ?>
<div id="main-content">
  <div class="container">
    <ul class="breadcrums b-brown-cat">
      <li><a class="app-loader" href="<?= base_url() ?>">Home</a></li>
      <li class="divider">|</li>
      <li><a class="app-loader" href="<?= base_url() ?>info/<?= $info->link ?>"><?= $info->title ?></a></li>
    </ul>
    <div class="widget-static style-<?= $info->style ?>">
      <div class="widget-static-inside">
        <div class="widget-static-content">
          <div class="widget-static-title"><?= $info->subtitle ?></div>
          <div class="widget-static-text"><?= $info->text ?></div>
        </div>
        <div class="widget-static-gallery">
          <div id="section-slide" class="slidesjs">
            <ul>
              <? foreach($gallery as $g):?>
              <li class="slide">
                <div class="bg-slide wimg" style="background-image:url(<?= upload($g->file) ?>)"></div>
              </li>
              <? endforeach ?>
              <a class="slidesjs-previous slidesjs-navigation"><i class="fa fa-chevron-left"></i></a>
              <a class="slidesjs-next slidesjs-navigation"><i class="fa fa-chevron-right"></i></a>
            </ul>
          </div> 
        </div>
      </div>
    </div>
  </div>
</div>
<script>
$(document).ready(function() {
  <? if(AJAX):?>$("html, body").animate({ scrollTop: 0 }, 500);<? endif ?>
  $('#section-slide ul').slidesjs({
    width:800,
    height: 600,
    navigation: false
  });
  if($('#section-slide ul li.slide').length == 1)
    $('#section-slide').addClass('single');
});
</script>
<?php $this->load->view('common/footer') ?>