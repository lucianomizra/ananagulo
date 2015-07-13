<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Clients extends AppController {

  public 
    $cfg = array();

  public function __construct()
  {
    $this->safeFunctionsU = array('updatei', 'send_birthday', 'send_recent', 'send_state');
    $this->safeFunctions = array('updatem', 'parsetxt');
    parent::__construct();
    $this->load->helper('email');
    $this->cfg['title'] = $this->lang->line('Clientes');
  }

  public function index()
  {
    $this->cfg['subtitle'] = $this->lang->line('Listado');
    $this->cfg['folder'] = 25; 
    $this->cfg['order-column'] = "date";
    $this->cfg['order-type'] = "desc";
    $this->load->library("abm", $this->cfg);
  }
    
  public function send_birthday_mail( $data = false )
  {
    require_once APPPATH . 'libraries/Mandrill.php';
    try {
      $mandrill = new Mandrill('q4ZvWAwppHKZftjcxu15Hw');
      $to = array();
      $merge = array();
      foreach($data as $d)
      {
        if($this->model->Unsuscribed($d->email1)) continue;
        $to[] = array('email' => $d->email1, 'name' => "{$d->nombre} {$d->apellido1}");
        $merge[] = array('rcpt' => $d->email1, 'vars' => array(
          array(
            'name' => 'UNAME',
            'content' => $d->nombre
          ),
          array(
            'name' => 'ULASTNAME',
            'content' => $d->apellido1
          )
        ));
      }
      $message = array(
        'subject' => '¡Feliz Cumpleaños!',
        'from_name' => 'Cemaco',
        'from_email' => 'info@cemaco.co.cr',
        'track_opens' => true,
        'track_clicks' => true,
        'inline_css' => true,
        'subaccount' => 'cemaco-birthday',
        'preserve_recipients' => false,
        'html' => $this->load->view('clients/birthdays/mail', array('data' => $data), true),
        'text' => $this->load->view('clients/birthdays/mail-alt', array('data' => $data), true),        
        'merge' => true,
        'merge_vars' => $merge,
        'to' => $to
      );
      $result = $mandrill->messages->send($message);
      $sql = $this->db->insert_string('cemaco_clients.mailing',array('mailing' => 'Cemaco - Cumpleaños', 'count' => count($to), 'result' => 'Enviado', 'data' => print_r($result,true)));
      $this->db->query($sql);
      print_r($result);
    } catch(Mandrill_Error $e) {
      $sql = $this->db->insert_string('cemaco_clients.mailing',array('mailing' => 'Cemaco - Cumpleaños', 'count' => 0, 'result' => 'Mandrill Error', 'data' => $e->getMessage()));
      $this->db->query($sql);
      echo 'A mandrill error occurred: ' . get_class($e) . ' - ' . $e->getMessage();
      throw $e;
    }
  }
  
  public function send_state_mail( $data = false, $force = false, $textMail = false )
  {
    require_once APPPATH . 'libraries/Mandrill.php';
    try {
      $mandrill = new Mandrill('q4ZvWAwppHKZftjcxu15Hw');
      $to = array();
      $merge = array();
      foreach($data as $d)
      {
        if(!$force && $this->model->Unsuscribed($d->email1)) continue;
        
        if($textMail)
          $to[] = array('email' => $textMail, 'name' => "TEST ** {$d->nombre} {$d->apellido1}");
        else
          $to[] = array('email' => $d->email1, 'name' => "{$d->nombre} {$d->apellido1}");
        
        $merge[] = array('rcpt' => $textMail ? $textMail : $d->email1, 'vars' => array(
          array(
            'name' => 'UNAME',
            'content' => $d->nombre
          ),
          array(
            'name' => 'ULASTNAME',
            'content' => $d->apellido1
          ),
          array(
            'name' => 'UBALANCE',
            'content' => number_format($d->saldo_cem, 0, '', '.')
          ),
          array(
            'name' => 'UACCUMULATED',
            'content' => number_format($d->acumulados, 0, '', '.')
          ),
          array(
            'name' => 'UREDEEMED',
            'content' => number_format($d->redimidos, 0, '', '.')
          ),
          array(
            'name' => 'ULAST',
            'content' => number_format($d->last_cem, 0, '', '.')
          ),
          array(
            'name' => 'CBALANCE',
            'content' => number_format($d->saldo_col, 0, '', '.')
          ),
          array(
            'name' => 'VENCIDO',
            'content' => number_format($d->vencido, 0, '', '.')
          )
        ));
      }
      $message = array(
        'subject' => 'Su cuenta Privilegio',
        'from_name' => 'Cemaco',
        'from_email' => 'info@cemaco.co.cr',
        'track_opens' => true,
        'track_clicks' => true,
        'inline_css' => true,
        'subaccount' => 'cemaco-privilege-state',
        'preserve_recipients' => false,
        'html' => $this->load->view('clients/state/mail', array('data' => $data), true),
        'text' => $this->load->view('clients/state/mail-alt', array('data' => $data), true),        
        'merge' => true,
        'merge_vars' => $merge,
        'to' => $to
      );
      $result = $mandrill->messages->send($message);
      $total = count($to);
      $sql = $this->db->insert_string('cemaco_clients.mailing',array('mailing' => 'Cemaco - Privilegio - Estado mensual', 'count' => $total, 'result' => 'Enviado', 'data' => print_r($result,true)));
      $this->db->query($sql);
      return $total;
      //print_r($result);
    } catch(Mandrill_Error $e) {
      $sql = $this->db->insert_string('cemaco_clients.mailing',array('mailing' => 'Cemaco - Privilegio - Estado mensual', 'count' => 0, 'result' => 'Mandrill Error', 'data' => $e->getMessage()));
      $this->db->query($sql);
      echo 'A mandrill error occurred: ' . get_class($e) . ' - ' . $e->getMessage();
      throw $e;
    }
    return 0;
  }
  
  public function send_state($init = 0)
  {
    ignore_user_abort();
    set_time_limit(0);   
    

   /*
    $this->send_state_mail( 
      array(
        (object) array('nombre' => 'Juan', 'apellido1' => 'Forlizzi', 'email1' => 'juan@identty.com', 'saldo_cem' => 1490, 'acumulados' => 1423, 'redimidos' => 0, 'last_cem' => 67, 'saldo_col' => 500, 'vencido' => 65),
        (object) array('nombre' => 'Test', 'apellido1' => 'Identty', 'email1' => 'identtypruebas@hotmail.com', 'saldo_cem' => 1490, 'acumulados' => 1423, 'redimidos' => 0, 'last_cem' => 67, 'saldo_col' => 500, 'vencido' => 65),
        (object) array('nombre' => 'Test', 'apellido1' => 'Identty', 'email1' => 'identtypruebas@gmail.com', 'saldo_cem' => 1490, 'acumulados' => 1423, 'redimidos' => 0, 'last_cem' => 67, 'saldo_col' => 500, 'vencido' => 65),
        (object) array('nombre' => 'Test', 'apellido1' => 'Identty', 'email1' => 'identtypruebas@yahoo.com', 'saldo_cem' => 1490, 'acumulados' => 1423, 'redimidos' => 0, 'last_cem' => 67, 'saldo_col' => 500, 'vencido' => 65),
      )
    );
    return;
    
    exit; */

    #FORCE   
    /*$this->model->table = "cemaco_clients.client_060215";
    $query = $this->model->PrivilegeStateForce($init);
    $list = $query->result();
    if(!count($list)) die('END');
    foreach($list as $test)
      $this->send_state_mail(array($test), true, 'ameltzer@cemaco.co.cr');  
    exit;
*/
    $this->model->table = "cemaco_clients.client";
    $query = $this->model->PrivilegeState($init);
    $list = $query->result();
    if(!count($list)) die('END');
    $total = $this->send_state_mail($list);
    $out = ($init / 10000) + 1;
    echo "PrivilegeState - Sending {$out} - {$total}/" . count($list) ."<br/>";
    $init += 10000;    
    echo "<a href='".base_url()."clients/send_state/{$init}' target='_blank'>Siguiente</a>";
    
    //echo "<script>setTimeout(function(){ window.open('".base_url()."clients/send_state/{$init}'); }, 1000); </script>";
    exit;

    do
    {
      $out++;
      $query = $this->model->PrivilegeState($init);
      $list = $query->result();
      if(!count($list)) break;
      $total = $this->send_state_mail($list);
      echo "PrivilegeState - Sending {$out} - {$total}/" . count($list) ."<br/>";
      /*foreach($list as $item)
      {
        echo "{$item->nombre} {$item->apellido1} - {$item->email1} - {$item->saldo_cem} - " . time() . "<br/>";
        exit;
      }*/
      $query->free_result();
      sleep(1); 
      $init += 10000;
    } while(1);
    
    return;
  
    $this->send_state_mail( 
      array(
        (object) array('nombre' => 'Juan', 'apellido1' => 'Forlizzi', 'email1' => 'juan@identty.com', 'saldo_cem' => 990, 'acumulados' => 1490, 'redimidos' => 500, 'last_cem' => 67, 'saldo_col' => 500),
        /*(object) array('nombre' => 'Rafael', 'apellido1' => 'Llinares', 'email1' => 'rafael@identty.com', 'saldo_cem' => 990, 'acumulados' => 1490, 'redimidos' => 500, 'last_cem' => 67, 'saldo_col' => 500),
        (object) array('nombre' => 'Fernando', 'apellido1' => 'Horcajo', 'email1' => 'fernando@identty.com', 'saldo_cem' => 990, 'acumulados' => 1490, 'redimidos' => 500, 'last_cem' => 67, 'saldo_col' => 500),
        (object) array('nombre' => 'Antonio', 'apellido1' => 'Horcajo', 'email1' => 'antonio@identty.com', 'saldo_cem' => 990, 'acumulados' => 1490, 'redimidos' => 500, 'last_cem' => 67, 'saldo_col' => 500),
        (object) array('nombre' => 'David', 'apellido1' => 'Hornillos', 'email1' => 'david@identty.com', 'saldo_cem' => 990, 'acumulados' => 1490, 'redimidos' => 500, 'last_cem' => 67, 'saldo_col' => 500)*/
      )
    );
    return;
    
    
  }
  
  public function send_birthday()
  {
    ignore_user_abort();
    set_time_limit(0);
    /*$this->send_birthday_mail( 
      array(
        (object) array('nombre' => 'Juan', 'apellido1' => 'Forlizzi', 'email1' => 'juan@identty.com'),
        (object) array('nombre' => 'Juan', 'apellido1' => 'Forlizzi', 'email1' => 'juanazareno@hotmail.com'),
        (object) array('nombre' => 'Test', 'apellido1' => 'Identty', 'email1' => 'identtypruebas@hotmail.com'),
        (object) array('nombre' => 'Test', 'apellido1' => 'Identty', 'email1' => 'identtypruebas@gmail.com'),
        (object) array('nombre' => 'Test', 'apellido1' => 'Identty', 'email1' => 'identtypruebas@yahoo.com'),
      )
    );
    return;*/
    
    $this->load->model('clients/birthdaysmodel','modelm');
    $this->modelm->mconfig = array(
      'order-column' => 'id_client',
      'order-type' => 'asc'
    );
    $list = $this->modelm->ListItems();
    $this->send_birthday_mail($list);
    return;
    
    foreach($list as $item)
    {
      echo "{$item->nombre} {$item->apellido1} - {$item->email1} - " . time() . "<br/>";
    }
    $this->send_birthday_mail( 
      array(
        (object) array('nombre' => 'Juan', 'apellido1' => 'Forlizzi', 'email1' => 'juan@identty.com'),
        (object) array('nombre' => 'Fernando', 'apellido1' => 'Horcajo', 'email1' => 'fernando@identty.com'),
        (object) array('nombre' => 'Antonio', 'apellido1' => 'Horcajo', 'email1' => 'antonio@identty.com'),
        (object) array('nombre' => 'David', 'apellido1' => 'Hornillos', 'email1' => 'david@identty.com'),
        (object) array('nombre' => 'Rafael', 'apellido1' => 'Llinares ', 'email1' => 'rafael@identty.com'),
      )
    );
    return;
  }
  
  public function send_recent()
  {
    ignore_user_abort();
    set_time_limit(0);
    /*$this->send_recent_mail( 
      array(
        (object) array('nombre' => 'Juan', 'apellido1' => 'Forlizzi', 'email1' => 'juan@identty.com'),
        (object) array('nombre' => 'Juan', 'apellido1' => 'Forlizzi', 'email1' => 'juanazareno@hotmail.com'),
        (object) array('nombre' => 'Test', 'apellido1' => 'Identty', 'email1' => 'identtypruebas@hotmail.com'),
        (object) array('nombre' => 'Test', 'apellido1' => 'Identty', 'email1' => 'identtypruebas@gmail.com'),
        (object) array('nombre' => 'Test', 'apellido1' => 'Identty', 'email1' => 'identtypruebas@yahoo.com'),
      )
    );
    return;*/
    $this->load->model('clients/recentmodel','modelm');
    $this->modelm->mconfig = array(
      'order-column' => 'id_client',
      'order-type' => 'asc'
    );
    $list = $this->modelm->ListItems();
    $this->send_recent_mail($list);
    return;
    
    foreach($list as $item)
    {
      echo "{$item->nombre} {$item->apellido1} - {$item->email1} - " . time() . "<br/>";
    }
    $this->send_recent_mail( 
      array(
        (object) array('nombre' => 'Juan', 'apellido1' => 'Forlizzi', 'email1' => 'juan@identty.com'),
        (object) array('nombre' => 'Fernando', 'apellido1' => 'Horcajo', 'email1' => 'fernando@identty.com'),
        (object) array('nombre' => 'Antonio', 'apellido1' => 'Horcajo', 'email1' => 'antonio@identty.com'),
        (object) array('nombre' => 'David', 'apellido1' => 'Hornillos', 'email1' => 'david@identty.com'),
        (object) array('nombre' => 'Rafael', 'apellido1' => 'Llinares ', 'email1' => 'rafael@identty.com'),
      )
    );
  }
  
  public function send_recent_mail( $data = false )
  {
    require_once APPPATH . 'libraries/Mandrill.php';
    try {
      $mandrill = new Mandrill('q4ZvWAwppHKZftjcxu15Hw');
      $to = array();
      $merge = array();
      foreach($data as $d)
      {
        if($this->model->Unsuscribed($d->email1)) continue;
        $to[] = array('email' => $d->email1, 'name' => "{$d->nombre} {$d->apellido1}");
        $merge[] = array('rcpt' => $d->email1, 'vars' => array(
          array(
            'name' => 'UNAME',
            'content' => $d->nombre
          ),
          array(
            'name' => 'ULASTNAME',
            'content' => $d->apellido1
          )
        ));
      }
      $message = array(
        'subject' => 'Gracias por elegirnos',
        'from_name' => 'Cemaco',
        'from_email' => 'info@cemaco.co.cr',
        'track_opens' => true,
        'track_clicks' => true,
        'inline_css' => true,
        'preserve_recipients' => false,
        'subaccount' => 'cemaco-privilege-new',
        'html' => $this->load->view('clients/recent/mail', array('data' => $data), true),
        'text' => $this->load->view('clients/recent/mail-alt', array('data' => $data), true),        
        'merge' => true,
        'merge_vars' => $merge,
        'to' => $to
      );
      $result = $mandrill->messages->send($message);
      $sql = $this->db->insert_string('cemaco_clients.mailing',array('mailing' => 'Cemaco - Privilegio - Nuevos registros', 'count' => count($to), 'result' => 'Enviado', 'data' => print_r($result,true)));
      $this->db->query($sql);
      print_r($result);
    } catch(Mandrill_Error $e) {
      $sql = $this->db->insert_string('cemaco_clients.mailing',array('mailing' => 'Cemaco - Privilegio - Nuevos registros', 'count' => 0, 'result' => 'Mandrill Error', 'data' => $e->getMessage()));
      $this->db->query($sql);
      echo 'A mandrill error occurred: ' . get_class($e) . ' - ' . $e->getMessage();
      throw $e;
    }
  }
  
  public function birthdays()
  {
    $this->cfg['subtitle'] = $this->lang->line('Cumpleaños');
    $this->cfg['new-element'] = false;
    $this->cfg['duplicate'] = false;
    $this->cfg['folder'] = 25;
    $this->load->library("abm", $this->cfg);
  }

  public function recent()
  {
    $this->cfg['subtitle'] = $this->lang->line('Nuevos registros');
    $this->cfg['new-element'] = false;    
    $this->cfg['order-column'] = "date";
    $this->cfg['order-type'] = "desc";
    $this->cfg['duplicate'] = false;
    $this->cfg['folder'] = 25;
    $this->load->library("abm", $this->cfg);
  }

  public function gender()
  {
    $this->cfg['subtitle'] = $this->lang->line('Géneros');
    $this->cfg['duplicate'] = false;
    $this->load->library("abm", $this->cfg);
  }

  public function civilstatus()
  {
    $this->cfg['subtitle'] = $this->lang->line('Estados civiles');
    $this->cfg['duplicate'] = false;
    $this->load->library("abm", $this->cfg);
  }

  public function provinces()
  {
    $this->cfg['subtitle'] = $this->lang->line('Provincias');
    $this->cfg['duplicate'] = false;
    $this->load->library("abm", $this->cfg);
  }

  public function cantons()
  {
    $this->cfg['subtitle'] = $this->lang->line('Cantones');
    $this->cfg['duplicate'] = false;
    $this->load->library("abm", $this->cfg);
  }

  public function districts()
  {
    $this->cfg['subtitle'] = $this->lang->line('Distritos');
    $this->cfg['duplicate'] = false;
    $this->load->library("abm", $this->cfg);
  }

  public function update()
  {
    $this->cfg['subtitle'] = $this->lang->line('Actualizaciones');
    $this->cfg['new-element'] = false;
    $this->cfg['duplicate'] = false; 
    $this->cfg['order-column'] = "date";
    $this->cfg['order-type'] = "desc";
    $this->MApp->secure->edit = false;
    $this->load->library("abm", $this->cfg);
  }
  
  public function updatem()
  {    
    $this->data['appTitle'] = array($this->lang->line('Clientes'), $this->lang->line('Actualización'), $this->lang->line('Manual'));
    $this->load->view('clients/update/manual', $this->data);
  }
  
  public function parsetxt()
  {
    exit;
    ignore_user_abort();
    set_time_limit(0);
    ini_set('max_execution_time', '9999');
    $this->load->model('clients/indexmodel','modelIndex');
    $this->load->helper('email');
    $file = 'list.txt';
    $fileE = 'errores.txt';
    $errors = "";
    $arr = explode("\r\n", file_get_contents($file));
    $line = 1;
    foreach($arr as $a)
    {
      $data = explode(",", $a);
      if($line>1 && count($data) >= 25)
      {
        $id_gender = $this->modelIndex->get_gender($data[6]);
        $id_civil_status = $this->modelIndex->get_civil_status($data[8]);
        $birthday = $this->modelIndex->get_birthday($data[7]);
        $pub_mail = $this->modelIndex->get_pub_mail($data[10]);
        $pub_tel = $this->modelIndex->get_pub_tel($data[13]);
        
        $id_province = $this->modelIndex->get_province($data[21]);
        $id_canton = $this->modelIndex->get_canton($data[22]);
        $id_district = $this->modelIndex->get_district($data[23]);
        $str = str_replace('-',',',$data[24]);
        $types = $this->modelIndex->get_types($str);
        $mail = mb_strtolower($data[9], 'UTF-8');
        if(!valid_email($mail)) 
          $mail = "";
        $client = array(
          'cod_cliente' => $data[1],
          'ididentificacion' => $data[2],
          'nombre' => mb_ucfirstword($data[3]),
          'apellido1' => mb_ucfirstword($data[4]),
          'apellido2' => mb_ucfirstword($data[5]),
          'id_gender' => $id_gender,
          'f_nacimiento' => $data[7],
          'birthday' => $birthday,
          'id_civil_status' => $id_civil_status,
          'email1' => $mail,
          'pub_mail' => $pub_mail,
          'telefono' => $data[11],
          'celular' => $data[12],
          'pub_tel' => $pub_tel,
          'acumulados' => abs(round($data[14],2)),
          'redimidos' => abs(round($data[15],2)),
          'saldo_cem' => abs(round($data[16],2)),
          'acumulados_col' => abs(round($data[17],2)),
          'redimidos_col' => abs(round($data[18],2)),
          'saldo_col' => abs(round($data[19],2)),
          'last_cem' => abs(round($data[20],2)),
          'tipos_cliente' => $types,
          'id_province' => $id_province,
          'id_canton' => $id_canton,
          'id_district' => $id_district,
          'date' => date('Y-m-d'),
        );
        $sql = $this->db->insert_string('cemaco_clients.client', $client);  
        $this->db->query($sql);
      }
      else
      {
        $errors .= "{$line} || {$a}\n\r";
      }
      $line++;
    }
    if($errors)
      file_put_contents($fileE, $errors);
    exit;
  }
  
  public function updatei()
  {
    ini_set('max_execution_time', '9999');   
    ini_set('memory_limit', '-1');
    $this->load->model('clients/indexmodel','modelIndex');
    $this->load->helper('email');
    $sql = 'select DATE(u.date) as date from cemaco_clients.client_update u order by u.date desc LIMIT 0,1';

    $row = $this->db->query($sql)->row();
    if($row)
      $dateSoap = str_replace('-','',$row->date);
    else
      $dateSoap = '20140320';
    $sql = $this->db->insert_string('cemaco_clients.client_update',array('items' => 0, 'items2' => 0));
    $this->db->query($sql);
    $idact = $this->db->insert_id();    
    $msg = 'La actualización <span class="bold">' . str_pad($idact, 5, "0", STR_PAD_LEFT) . '</span> se realizó <span class="underline">correctamente</span>.';
    $requestParams = array(
      'sFecha_YYYYMMDD' => $dateSoap,
      'sAnoSaldo' => substr($dateSoap,0,4),
      'sMesSaldo' => round(substr($dateSoap,4,2))
    );
    $client = new SoapClient('http://190.171.26.19:82/wsbodas/listabodas.asmx?WSDL', array('soap_version' => SOAP_1_2, 'trace' => 1));
    $response = $client->ObtenerClientes($requestParams);
    $string = $response->ObtenerClientesResult->any;
    $xml = simplexml_load_string($string); 
    if(empty($xml->NewDataSet->Table))
    {
      $this->session->set_flashdata('returnMessage', $msg);      
      redirect('clients/updatem');
    }
    $count = 0;
    $count2 = 0;
    $sqlTxt = "";
    foreach($xml->NewDataSet->Table as $row)
    {
      $id = 0;
      if($row->COD_CLIENTE)
      {
        $sql = "select id_client as id from cemaco_clients.client where cod_cliente = '{$row->COD_CLIENTE}' LIMIT 0,1";
        $client = $this->db->query($sql)->row();
        if($client) $id = $client->id;
      }     
      $id_gender = $this->modelIndex->get_gender((string) $row->GENERO);
      $id_civil_status = $this->modelIndex->get_civil_status((string) $row->ESTADO_CIVIL);
      $id_province = $this->modelIndex->get_province((string) $row->PROVINCIA);
      $id_canton = $this->modelIndex->get_canton((string) $row->CANTON);
      $id_district = $this->modelIndex->get_district((string) $row->DISTRITO);
      $birthday = $this->modelIndex->get_birthday2((string) $row->F_NACIMIENTO);
      $pub_tel = $this->modelIndex->get_pub_tel((string) $row->IND_ENV_PUB_TELEF);
      $pub_mail = $this->modelIndex->get_pub_mail((string) $row->IND_ENV_PUB_EMAIL);
      $types = $this->modelIndex->get_types((string) $row->TIPOS_CLIENTE);
      $data = array(
        'cod_cliente' => (string) $row->COD_CLIENTE,
        'ididentificacion' => (string) $row->ID_IDENTIFICACION,
        'nombre' => mb_ucfirstword((string) $row->NOMBRE),
        'apellido1' => mb_ucfirstword((string) $row->APELLIDO1),
        'telefono' => (string) $row->TELEFONO,
        'celular' => (string) $row->CELULAR,
        'acumulados' => abs(round((string) $row->ACUMULADOS,2)),
        'redimidos' => abs(round((string) $row->REDIMIDOS,2)),
        'saldo_cem' => abs(round((string) $row->SALDO_CEM,2)),
        'vencido' => abs(round((string) $row->VENCIDO,2)),
        'acumulados_col' => abs(round((string) $row->ACUMULADOS_COL,2)),
        'redimidos_col' => abs(round((string) $row->REDIMIDOS_COL,2)),
        'saldo_col' => abs(round((string) $row->SALDO_COL,2)),
        'last_cem' => abs(round((string) $row->CEMACOLONES_GEN_ULTIMA_COMPRA,2)),
        'tipos_cliente' => $types,
        'f_nacimiento' => (string) $row->F_NACIMIENTO,
        'pub_mail' => $pub_mail,
        'pub_tel' => $pub_tel,
        'birthday' => $birthday,
        'id_gender' => $id_gender,
        'id_civil_status' => $id_civil_status,
        'id_province' => $id_province,
        'id_canton' => $id_canton,
        'id_district' => $id_district,
        'date' => date('Y-m-d'),
      );
      
      if( isset($row->APELLIDO2) )
        $data['apellido2'] = mb_ucfirstword((string) $row->APELLIDO2);
      if( isset($row->EMAIL1) )
      {
        $mail = (string) $row->EMAIL1;
        if(valid_email($mail))
          $data['email1'] = strtolower($mail);
      }      
      if($id)
      {
        unset($data['date']);
        $sql = $this->db->update_string('cemaco_clients.client', $data, "id_client = '{$id}'");
      }
      else
        $sql = $this->db->insert_string('cemaco_clients.client', $data);      
      $sqlTxt .= "{$sql}\n";
      $this->db->query($sql);
      if(mysql_affected_rows())
        $count2++;
      $count++;
      
      if(!$pub_mail && isset($data['email1']))
      {
        $sql = "INSERT IGNORE INTO cemaco_clients.unsuscribe (mail) values('{$data['email1']}') ";
        $this->db->query($sql);
      }
      
    }
    $sql = $this->db->update_string('cemaco_clients.client_update', array('items' => $count, 'items2' => $count2, 'log' => $sqlTxt), "id_update = '{$idact}'");
    $this->db->query($sql);
    $this->session->set_flashdata('returnMessage', $msg);  
    redirect('clients/updatem');
  }

  public function unsuscribes()
  {
    $this->cfg['subtitle'] = $this->lang->line('Desuscripciones');
    $this->cfg['folder'] = 31;
    $this->cfg['order-column'] = "date";
    $this->cfg['order-type'] = "desc";
    $this->load->library("abm", $this->cfg);
  }

  public function mailing()
  {
    $this->cfg['subtitle'] = $this->lang->line('Mailing');
    $this->cfg['folder'] = 32;
    $this->cfg['order-column'] = "time";
    $this->cfg['order-type'] = "desc";
    $this->cfg['new-element'] = false;
    $this->cfg['duplicate'] = false;
    $this->MApp->secure->edit = false;
    $this->MApp->secure->delete = false;
    $this->load->library("abm", $this->cfg);
  }

}