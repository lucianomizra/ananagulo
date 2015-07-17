<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class sales extends AppController {

  public 
    $cfg = array();

  public function __construct()
  {
    $this->safeFunctionsU = array('noficationsale', 'detailscart');
    parent::__construct();
    $this->cfg['title'] = $this->lang->line('Ventas');
  }


  public function detailscart( $id = 0 )
  {
    redirect('http://anaangulo.com/mi-cuenta/pedido/' . $id . '/' . md5($id . ' - AnaAngulo'));
  }

  public function payments()
  {
    $this->cfg['subtitle'] = $this->lang->line('Formas de pago');
    $this->cfg['folder'] = 17;
    $this->load->library("abm", $this->cfg);
  }

  public function shipping()
  {
    $this->cfg['subtitle'] = $this->lang->line('Transportes');
    $this->cfg['folder'] = 18;
    $this->load->library("abm", $this->cfg);
  }

  public function countries()
  {
    $this->cfg['subtitle'] = $this->lang->line('Países');
    $this->cfg['folder'] = 19;
    $this->cfg['duplicate'] = false;
    $this->load->library("abm", $this->cfg);
  }

  public function users()
  {
    $this->cfg['subtitle'] = $this->lang->line('Usuarios');
    $this->cfg['folder'] = 20;
    $this->load->library("abm", $this->cfg);
  }

  public function stores()
  {
    $this->cfg['subtitle'] = $this->lang->line('Tiendas');
    $this->cfg['folder'] = 21;
    $this->load->library("abm", $this->cfg);
  }

  public function coupons()
  {
    $this->cfg['subtitle'] = $this->lang->line('Cupones de descuento');
    $this->cfg['folder'] = 22;
    $this->load->library("abm", $this->cfg);
  }

  public function index()
  {
    $this->cfg['subtitle'] = $this->lang->line('Pedidos');
    $this->cfg['folder'] = 23;
    $this->cfg['new-element'] = false;
    $this->cfg['duplicate'] = false;
    $this->cfg['routes'] = array('notification' => 'index_notification');
    $this->load->library("abm", $this->cfg);
  }
  
  public function noficationsale( $id = 0 )
  {
    $users = array();
    $sql = "select id_user as id from {$this->MApp->dbglobal}user where (id_company = 2 and id_type < 3) OR (id_company = 1 and id_type < 3)";
    $result = $this->db->query($sql)->result();
    foreach($result as $row)
      $users[] = $row->id;
    $this->MApp->AddNotification($users, array(
    'id_type' => 1,
    'id_project' => $this->MApp->project,
    'data' => json_encode(array(
      'id_cart' => $id
    )),
    'text' => 'Pedido <span class="app-color">'. str_pad($id, 6, "0", STR_PAD_LEFT) .'</span> realizada vía web',
    'link' => base_url() . 'sales/index/element/' . $id
  ));
  }

  public function cards()
  {
    $this->cfg['subtitle'] = $this->lang->line('Tarjetas');
    $this->cfg['folder'] = 37;
    $this->load->library("abm", $this->cfg);
  }

}