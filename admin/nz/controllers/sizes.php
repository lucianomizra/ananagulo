<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class sizes extends AppController {

  public 
    $cfg = array();

  public function __construct()
  {
    parent::__construct();
    $this->cfg['title'] = $this->lang->line('Tallas');
  }


  public function types()
  {
    $this->cfg['order-column'] = "num";
    $this->cfg['order-type'] = "asc";
    $this->cfg['subtitle'] = $this->lang->line('Clasificaciones');
    $this->cfg['folder'] = 34;
    $this->load->library("abm", $this->cfg);
  }

  public function index()
  {
    $this->cfg['order-column'] = "xnum";
    $this->cfg['order-type'] = "asc";
    $this->cfg['subtitle'] = $this->lang->line('Medidas');
    $this->cfg['folder'] = 35;
    $this->load->library("abm", $this->cfg);
  }

}