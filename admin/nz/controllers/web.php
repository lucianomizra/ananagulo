<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class web extends AppController {

  public 
    $cfg = array();

  public function __construct()
  {
    parent::__construct();
    $this->cfg['title'] = $this->lang->line('Sitio Web');
  }

  public function promotions()
  {
    $this->cfg['subtitle'] = $this->lang->line('Slides');
    $this->cfg['folder'] = 3;
    $this->load->library("abm", $this->cfg);
  }
  
  public function promotions2()
  {
    $this->cfg['subtitle'] = $this->lang->line('Promociones Buscador');
    $this->cfg['folder'] = 2;
    $this->load->library("abm", $this->cfg);
  }

  public function grid()
  {
    $this->cfg['subtitle'] = $this->lang->line('Home Grilla');
    $this->cfg['folder'] = 4;
    $this->cfg['order-column'] = "id";
    $this->cfg['order-type'] = "asc";
    $this->cfg['duplicate'] = false;
    $this->cfg['new-element'] = false;
    $this->load->library("abm", $this->cfg);
  }
  
  public function ckeditorstyles()
  {
    header('Content-Type: application/javascript');
    $this->load->view('web/ckeditor/styles');
  }
  
  public function ckeditorcss()
  {
    header('Content-Type: text/css');
    $this->load->view('web/ckeditor/css');
  }

  public function newsletter()
  {
    $this->cfg['subtitle'] = $this->lang->line('Newsletter');
    $this->cfg['folder'] = 5;
    $this->cfg['order-column'] = "date";
    $this->cfg['order-type'] = "desc";
    $this->cfg['duplicate'] = false;
    $this->cfg['new-element'] = false;
    $this->load->library("abm", $this->cfg);
  }

  public function info()
  {
    $this->cfg['subtitle'] = $this->lang->line('Secciones Informativas');
    $this->cfg['folder'] = 6;
    $this->load->library("abm", $this->cfg);
  }

  public function instagram()
  {
    $this->cfg['subtitle'] = $this->lang->line('Instagram');
    $this->cfg['folder'] = 36;
    $this->load->library("abm", $this->cfg);
  }

  public function seo()
  {
    $this->cfg['subtitle'] = $this->lang->line('SEO');
    $this->cfg['folder'] = 33;
    $this->load->library("abm", $this->cfg);
  }

}