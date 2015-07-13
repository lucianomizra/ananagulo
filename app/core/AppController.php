<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class AppController extends CI_Controller
{

  var
    $data = array();

  function __construct()
  {
    parent::__construct();
    $this->load->config('app', TRUE);
    $this->load->library('Session');
    $this->lang->load('web');
    $this->load->library('Encryption');
    $this->encryption->key($this->config->item('encryption_key', 'app'));
    $this->load->model('DataModel', 'Data');
    $this->load->model('CartModel', 'Cart');
    if( $this->session->userdata('cartId') )
      $this->Cart->id = $this->session->userdata('cartId');
    if( $this->session->userdata('userID') )
    {
      $this->Data->idUser = $this->Cart->idu = $this->session->userdata('userID');
    }
    $this->Data->activeW = false;
    if($this->session->userdata('activeW'))
      $this->Data->activeW = true;
    $this->data['sectionMenu'] = '';
    if(!AJAX)
    {
      $this->load->driver('cache');
      if ( TRUE || !$nav = $this->cache->file->get('common-nav'))
      {
        $nav = $this->load->view('common/nav', null, true) ;
        $this->cache->file->save('common-nav', $nav, 300);
      }
      $this->data['navWidget'] = $nav;
    }
  }

}