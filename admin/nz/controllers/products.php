<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class products extends AppController {

  public 
    $cfg = array();

  public function __construct()
  {
    $this->safeFunctionsU = array();
    $this->safeFunctions = array('data');
    parent::__construct();
    $this->cfg['title'] = $this->lang->line('Productos');
  }
  
  public function data( $section = '' )
  {
    header('Content-Type: application/json');
    if($section == 'subs-select')
    {
      $datos = $this->Data->ResultProductSub("id_category = '" . $this->input->post('id') . "'");
      die(json_encode($datos));
    }
    if($section == 'brands-select')
    {
      $datos = $this->Data->ResultBrands("active = 1 AND id_category = '" . $this->input->post('id') . "'");
      die(json_encode($datos));
    }
    if($section == 'subs2-select')
    {
      $datos = $this->Data->ResultProductSub2("id_sub = '" . $this->input->post('id') . "'");
      die(json_encode($datos));
    }
  }
  
  public function categories()
  {
    $this->cfg['subtitle'] = $this->lang->line('Categorías');
    $this->cfg['folder'] = 8;
    $this->load->library("abm", $this->cfg);
  }

  public function subs()
  {
    $this->cfg['subtitle'] = $this->lang->line('Subcategorías');
    $this->cfg['folder'] = 9;
    $this->load->library("abm", $this->cfg);
  }

  public function subs2()
  {
    $this->cfg['subtitle'] = $this->lang->line('Subcategorías 2');
    $this->cfg['folder'] = 10;
    $this->load->library("abm", $this->cfg);
  }

  public function brands()
  {
    $this->cfg['subtitle'] = $this->lang->line('Marcas');
    $this->cfg['folder'] = 11;
    $this->load->library("abm", $this->cfg);
  }

  public function colors()
  {
    $this->cfg['subtitle'] = $this->lang->line('Colores y Estampados');
    $this->cfg['folder'] = 12;
    $this->load->library("abm", $this->cfg);
  }

  public function index()
  {
    $this->cfg['folder'] = 13;
    $this->load->library("abm", $this->cfg);
  }

  public function cares()
  {
    $this->cfg['subtitle'] = $this->lang->line('Cuidados');
    $this->cfg['folder'] = 30;
    $this->load->library("abm", $this->cfg);
  }

  public function collections()
  {
    $this->cfg['subtitle'] = $this->lang->line('Colecciones');
    $this->cfg['folder'] = 31;
    $this->load->library("abm", $this->cfg);
  }

  public function looks()
  {
    $this->cfg['subtitle'] = $this->lang->line('Looks');
    $this->cfg['folder'] = 32;
    $this->load->library("abm", $this->cfg);
  }

}