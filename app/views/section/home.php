<?php if(!AJAX) $this->load->view('common/header') ?>
<? $slide = $this->Data->SlideHome(); ?>
<div id="page-info" data-section="home"></div>
<div class="home-container">

  <? if(!$this->session->userdata('joinaltform')) $this->load->view('widget/form-join-alt') ?>

  <? if(count($slide)): ?>
  <div class="col-md-12 no-padding inside-menu">
    <div class="full-container">
      <div class="home-open-slider slider">
        <ul class="slides">
          <? foreach($slide as $b):?>
          <li>
            <div class="slide-content">
              <? if($b->link):?><a href="<?= prep_url($b->link) ?>"><? endif ?>
              <div class="pull-right">
                <? if($b->title):?>
                <h2><?= $b->title ?></h2>
                <? endif ?>
                <? if($b->subtitle):?>
                <div>
                <p><?= nl2br($b->subtitle) ?></p>
                </div>
                <? endif ?>
              </div>
              <? if($b->link):?></a><? endif ?>
            </div>
            <img src="<?= upload($b->file) ?>" />
          </li>
          <? endforeach ?>
        </ul>
      </div>  
    </div>
  </div>
  <? endif ?>
  <div class="clearfixh10"></div>
  <? $grid = $this->Data->GridHome(1); 
  $image = '';
  $gallery = $this->Data->Gallery($grid->gallery); 
  if( isset($gallery[0]->file))
    $image = $gallery[0]->file;
  ?>
  <div class="col-lg-5 no-padding col-sm-4">
    <div class="height1 cover style1" style="background-image:url(<?= upload($image) ?>);">
      <? if($grid->link):?><a href="<?= prep_url($grid->link) ?>"><? endif ?>
        <span class="middle">
          <span class="center">
            <span class="linebox bigpadding">
              <small><?= $grid->title ?></small>
              <h2><?= $grid->subtitle ?></h2>
              <small><?= $grid->subtitle2 ?></small>
            </span>
          </span>
        </span>
      <? if($grid->link):?></a><? endif ?>
    </div>
  </div>
  <div class="col-lg-2 no-padding-w col-sm-4">
    <div class="height1 black style1">
      <a href="https://www.facebook.com/tiendasanaangulo" target="_blank">
        <span class="middle">
          <span class="center">
              <small>Síguenos en</small>
              <h2 class="mbot10">Facebook</h2>
              <span class="btn btn-line">
              <i class="fa fa-facebook"></i>
            </span>
          </span>
        </span>
      </a>
    </div>
  </div>
  <? $grid = $this->Data->GridHome(3); 
  $image = '';
  $gallery = $this->Data->Gallery($grid->gallery); 
  if( isset($gallery[0]->file))
    $image = $gallery[0]->file;
  ?>
  <div class="col-lg-5 no-padding col-sm-4">
    <div class="height1 cover style2" style="background-image:url(<?= upload($image) ?>);">
     <? if($grid->link):?><a href="<?= prep_url($grid->link) ?>"><? endif ?>
        <span class="middle">
          <div class="center">
            <span class="linebox bigpadding">
              <small><?= $grid->title ?></small>
              <h2><?= $grid->subtitle ?></h2>
              <small><?= $grid->subtitle2 ?></small>
            </span>
          </div>
        </span>
      <? if($grid->link):?></a><? endif ?>
    </div>
  </div>
  <div class="clearfix"></div>
  <div class="clearfixh10"></div>
  <? $this->load->view('widget/highlight') ?>
  <div class="clearfixh10"></div>
  <? $grid = $this->Data->GridHome(4); 
  $image = '';
  $gallery = $this->Data->Gallery($grid->gallery); 
  if( isset($gallery[0]->file))
    $image = $gallery[0]->file;
  ?>
  <div class="col-lg-5 no-padding col-sm-4">
    <div class="height1 cover style2" style="background-image:url(<?= upload($image) ?>);">
      <? if($grid->link):?><a href="<?= prep_url($grid->link) ?>"><? endif ?>
        <span class="middle">
          <span class="center">
            <span class="linebox bigpadding">
              <small><?= $grid->title ?></small>
              <h2><?= $grid->subtitle ?></h2>
              <small><?= $grid->subtitle2 ?></small>
            </span>
          </span>
        </span>
      <? if($grid->link):?></a><? endif ?>
    </div>
  </div>
  <div class="col-lg-2 no-padding-w col-sm-4">
    <div class="height1 black style1">
      <a target="_blank" href="https://instagram.com/anaanguloboutique">
        <span class="middle">
          <span class="center">
              <small>Síguenos en</small>
              <h2 class="mbot10">Instagram</h2>
              <span class="btn btn-line">
              <i class="fa fa-instagram"></i>
            </span>
          </span>
        </span>
      </a>
    </div>
  </div>
  <? $grid = $this->Data->GridHome(6); 
  $image = '';
  $gallery = $this->Data->Gallery($grid->gallery); 
  if( isset($gallery[0]->file))
    $image = $gallery[0]->file;
  ?>
  <div class="col-lg-5 no-padding col-sm-4">
    <div class="height1 cover style1" style="background-image:url(<?= upload($image) ?>);">
      <? if($grid->link):?><a href="<?= prep_url($grid->link) ?>"><? endif ?>
        <span class="middle">
          <div class="center">
            <span class="linebox bigpadding width90">
              <h2><?= $grid->title ?></h2>
              <small><?= $grid->subtitle ?></small>
            </span>
          </div>
        </span>
      <? if($grid->link):?></a><? endif ?>
    </div>
  </div>
  <div class="clearfix"></div>

</div>
</div>
<?php $this->load->view('common/footer') ?>