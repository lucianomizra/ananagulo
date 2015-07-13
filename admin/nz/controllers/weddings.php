<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class weddings extends AppController {

  public 
    $cfg = array();

  public function __construct()
  {
    $this->safeFunctions = array('others');
    parent::__construct();
    $this->cfg['title'] = $this->lang->line('Bodas');
  }

  public function hslide()
  {
    $this->cfg['subtitle'] = $this->lang->line('Slide');
    $this->cfg['folder'] = 2;
    $this->load->library("abm", $this->cfg);
  }

  public function grid()
  {
    $this->cfg['subtitle'] = $this->lang->line('Grilla');
    $this->cfg['folder'] = 4;
    $this->cfg['order-column'] = "id";
    $this->cfg['order-type'] = "asc";
    $this->cfg['duplicate'] = false;
    $this->cfg['new-element'] = false;
    $this->load->library("abm", $this->cfg);
  }
  public function sponsors()
  {
    $this->cfg['subtitle'] = $this->lang->line('Patrocinadores');
    $this->cfg['folder'] = 25;
    $this->load->library("abm", $this->cfg);
  }

  public function advices()
  {
    $this->cfg['subtitle'] = $this->lang->line('Consejos');
    $this->cfg['folder'] = 26;
    $this->cfg['order-column'] = "num";
    $this->cfg['order-type'] = "asc";
    $this->load->library("abm", $this->cfg);
  }

  public function lists_active()
  {
    $id = round($this->uri->segment(4,0));
    $this->session->set_userdata('weddingsListActive', $id);
    redirect('weddings/lists');
  }
  
  public function products_remove()
  {
    $list = round($this->uri->segment(4,0));
    if(!$list)
      die('{"result": false}');
    $id = round($this->uri->segment(5,0));
    if(!$id)
      die('{"result": false}');
    $this->model->RemoveItemList($list, $id);
    die('{"result": true}');
  }
  
  public function products_save()
  {
    $list = round($this->uri->segment(4,0));
    if(!$list)
      die('{"result": false}');
    $id = round($this->uri->segment(5,0));
    if(!$id)
      die('{"result": false}');
    $this->model->SaveItemList($list, $id, $_POST);
    die('{"result": true}');
  }
  
  public function products_less()
  {
    $list = round($this->uri->segment(4,0));
    if(!$list)
      die('{"result": false}');
    $id = round($this->uri->segment(5,0));
    if(!$id)
      die('{"result": false}');
    $total = $this->model->LessItemList($list, $id);
    die('{"result": true, "items": "'.$total.'"}');
  }
  
  public function products_more()
  {
    $list = round($this->uri->segment(4,0));
    if(!$list)
      die('{"result": false}');
    $id = round($this->uri->segment(5,0));
    if(!$id)
      die('{"result": false}');
    $total = $this->model->MoreItemList($list, $id);
    die('{"result": true, "items": "'.$total.'"}');
  }
  
  public function products_add()
  {
    $list = round($this->uri->segment(4,0));
    if(!$list)
      die('{"result": false}');
    $id = round($this->uri->segment(5,0));
    if(!$id)
      die('{"result": false}');
    $this->model->AddItemList($list, $id, 1);
    die('{"result": true}');
  }
  
  public function products()
  {
    $this->cfg['title'] = 'Lista CXX' . str_pad($this->session->userdata('weddingsListActive'), 6, "0", STR_PAD_LEFT);
    $this->cfg['subtitle'] = $this->lang->line('Selección de productos');
    $this->cfg['folder'] = 13;
    $this->cfg['duplicate'] = false;
    $this->cfg['new-element'] = false;
    $this->cfg['routes'] = array('add' => 'products_add', 'remove' => 'products_remove', 'more' => 'products_more', 'less' => 'products_less', 'save' => 'products_save');
    $this->load->library("abm", $this->cfg);
  }
  
  public function lists()
  {
    $this->cfg['subtitle'] = $this->lang->line('Listas');
    $this->cfg['folder'] = 27;
    $this->cfg['duplicate'] = false;
    $this->cfg['routes'] = array('active' => 'lists_active');
    $this->load->library("abm", $this->cfg);
  }

  public function guides()
  {
    $this->cfg['subtitle'] = $this->lang->line('Guía');
    $this->cfg['folder'] = 28;
    $this->cfg['order-column'] = "num";
    $this->cfg['order-type'] = "desc";
    $this->load->library("abm", $this->cfg);
  }

  public function other()
  {
    redirect('weddings/others/element/1');
  }
  
  public function others()
  {
    $this->cfg['subtitle'] = $this->lang->line('Pautas y Ganadores');
    $this->cfg['folder'] = 29;
    $this->cfg['duplicate'] = false;
    $this->cfg['new-element'] = false;
    $this->load->library("abm", $this->cfg);
  }

}