<?php

class IndexModel extends AppModel {

  function __construct()
  {
    parent::__construct();
    $this->table = "cemaco_clients.client";    
  }
  
  public function PrivilegeStateForce( $init = 0 )
  {
    $sql = "SELECT email1,nombre,apellido1,saldo_cem,acumulados,redimidos,last_cem,saldo_col, vencido
    FROM {$this->table} as t
    LIMIT {$init}, 10000";
    return $this->db->query($sql);
  }  
  
  public function PrivilegeState( $init = 0 )
  {
    $sql = "SELECT email1,nombre,apellido1,saldo_cem,acumulados,redimidos,last_cem,saldo_col, vencido
    FROM {$this->table} as t
    WHERE t.email1 != '' AND t.pub_mail = '1' AND t.tipos_cliente like '%04%'
    LIMIT {$init}, 10000";
    return $this->db->query($sql);
  }  
  
  public function ListItems()
  {
    $where = $this->ListWhere(true);
    $init = $this->input->post('iDisplayStart') ? $this->input->post('iDisplayStart') : 0;
    $perpage = $this->input->post('iDisplayLength') ? $this->input->post('iDisplayLength') : 10;
    $orderby = $this->input->post('filter-sort-column') ? $this->input->post('filter-sort-column') : $this->mconfig['order-column'];
    $ascdesc = $this->input->post('filter-sort-type') ? $this->input->post('filter-sort-type') : $this->mconfig['order-type'];
    $sql = "SELECT t.id_client as id, t.*
    FROM {$this->table} as t         
    WHERE $where 
    ORDER BY `{$orderby}` {$ascdesc} LIMIT {$init}, {$perpage}";
    return $this->db->query($sql)->result();
  }  
  
  public function ListTotal($filter = false)
  {
    $where = $this->ListWhere($filter);
    $sql = "SELECT count(*) as total 
    FROM {$this->table} as t    
    WHERE $where";
    return $this->db->query($sql)->row()->total;
  }
  
  private function ListWhere($filter = false)
  {
    $sql = "1";
    if(!$filter) 
      return $sql;  
    $text = $this->input->post('filter-text') ? $this->input->post('filter-text') : false;          
    if(!$text)      
      $text = $this->input->post('sSearch') ? $this->input->post('sSearch') : false;
    if($this->input->post('filter-id_civil_status'))
      $sql .= " AND t.id_civil_status = '". $this->input->post('filter-id_civil_status') ."'";
    if($this->input->post('filter-id_gender'))
      $sql .= " AND t.id_gender = '". $this->input->post('filter-id_gender') ."'";
    if($this->input->post('filter-id_province'))
      $sql .= " AND t.id_province = '". $this->input->post('filter-id_province') ."'";
    if($this->input->post('filter-id_canton'))
      $sql .= " AND t.id_canton = '". $this->input->post('filter-id_canton') ."'";
    if($this->input->post('filter-id_district'))
      $sql .= " AND t.id_district = '". $this->input->post('filter-id_district') ."'";
    if($this->input->post('filter-pub_mail'))
      $sql .= " AND t.pub_mail = '1'";
    if($this->input->post('filter-pub_tel'))
      $sql .= " AND t.pub_tel = '1'";
    if($text)
      $sql .= " AND ( t.cod_cliente like '%{$text}%'  OR  t.ididentificacion like '%{$text}%'  OR  CONCAT(t.nombre, ' ', t.apellido1, ' ', t.apellido2) like '%{$text}%'  OR  t.nombre like '%{$text}%'  OR  t.apellido1 like '%{$text}%'  OR  t.apellido2 like '%{$text}%'  OR  t.f_nacimiento like '%{$text}%'  OR  t.email1 like '%{$text}%'  OR  t.telefono like '%{$text}%'  OR  t.celular like '%{$text}%'  OR  t.tipos_cliente like '%{$text}%'  OR t.id_client = '{$text}') ";   
    if($this->input->post('filter-id'))
      $sql .= " AND t.id_client = '". $this->input->post('filter-id') ."'";  
    return $sql;
  }  
  
  public function JSON()
  {
    $total = $this->ListTotal();
    $total2 = $this->ListTotal(true);
    $json = $this->ListItems();
    $sEcho = $this->input->post('sEcho');
    return '{"sEcho":' . $sEcho . ',"iTotalRecords": '. $total .',"iTotalDisplayRecords": '. $total2 .',"aaData":' . json_encode($json) . '}';
  }
  
  public function DataSelects()
  {
    return array(
      'SelectCivilStatus' => $this->Data->SelectCivilStatus('', $this->lang->line('Selecciona una opción')),
      'SelectGender' => $this->Data->SelectGender('', $this->lang->line('Selecciona una opción')),
      'SelectGeoProvince' => $this->Data->SelectGeoProvince('', $this->lang->line('Selecciona una opción')),
      'SelectGeoCanton' => $this->Data->SelectGeoCanton('', $this->lang->line('Selecciona una opción')),
      'SelectGeoDistrict' => $this->Data->SelectGeoDistrict('', $this->lang->line('Selecciona una opción')),      
    );
  }
  
  public function ValidationRules()
  {
    return array(
      array(
       'field'   => 'cod_cliente', 
       'label'   => $this->lang->line('Código Cliente'), 
       'rules'   => 'trim'
      ),
      array(
       'field'   => 'ididentificacion', 
       'label'   => $this->lang->line('ID Identificación'), 
       'rules'   => 'trim'
      ),
      array(
       'field'   => 'nombre', 
       'label'   => $this->lang->line('Nombre'), 
       'rules'   => 'trim'
      ),
      array(
       'field'   => 'apellido1', 
       'label'   => $this->lang->line('Apellido 1'), 
       'rules'   => 'trim'
      ),
      array(
       'field'   => 'apellido2', 
       'label'   => $this->lang->line('Apellido 2'), 
       'rules'   => 'trim'
      ),
      array(
       'field'   => 'f_nacimiento', 
       'label'   => $this->lang->line('Nacimiento'), 
       'rules'   => 'trim'
      ),
      array(
       'field'   => 'email1', 
       'label'   => $this->lang->line('E-mail'), 
       'rules'   => 'trim'
      ),
      array(
       'field'   => 'telefono', 
       'label'   => $this->lang->line('Teléfono'), 
       'rules'   => 'trim'
      ),
      array(
       'field'   => 'celular', 
       'label'   => $this->lang->line('Celular'), 
       'rules'   => 'trim'
      ),
      array(
       'field'   => 'acumulados', 
       'label'   => $this->lang->line('Puntos acumulados'), 
       'rules'   => 'trim|numeric'
      ),
      array(
       'field'   => 'redimidos', 
       'label'   => $this->lang->line('Puntos redimidos'), 
       'rules'   => 'trim|numeric'
      ),
      array(
       'field'   => 'tipos_cliente', 
       'label'   => $this->lang->line('Tipos Cliente'), 
       'rules'   => 'trim'
      ),
      array(
       'field'   => 'id_civil_status', 
       'label'   => $this->lang->line('Estado Civil'), 
       'rules'   => 'trim|numeric'
      ),
      array(
       'field'   => 'id_gender', 
       'label'   => $this->lang->line('Género'), 
       'rules'   => 'trim|numeric'
      ),
      array(
       'field'   => 'id_province', 
       'label'   => $this->lang->line('Provincia'), 
       'rules'   => 'trim|numeric'
      ),
      array(
       'field'   => 'id_canton', 
       'label'   => $this->lang->line('Cantón'), 
       'rules'   => 'trim|numeric'
      ),
      array(
       'field'   => 'id_district', 
       'label'   => $this->lang->line('Distrito'), 
       'rules'   => 'trim|numeric'
      ),
      array(
       'field'   => 'pub_mail', 
       'label'   => $this->lang->line('Publicidad E-Mail'), 
       'rules'   => 'trim'
      ),
      array(
       'field'   => 'pub_tel', 
       'label'   => $this->lang->line('Publicidad Teléfono'), 
       'rules'   => 'trim'
      ),
      array(
       'field'   => 'birthday', 
       'label'   => $this->lang->line('Nacimiento'), 
       'rules'   => 'trim'
      ),
      array(
       'field'   => 'date', 
       'label'   => $this->lang->line('Registro'), 
       'rules'   => 'trim'
      ),
    );
  }
  
  public function Name( $id = 0 )
  {
    $id = $id ? $id : $this->id;
    $sql = "SELECT cod_cliente as `name`
    FROM {$this->table}

    WHERE id_client = '{$id}'";
    $query = $this->db->query($sql);
    $row = $query->row();
    return clean_title($row->name);
  }
  
  public function Duplicate( $id = 0 )
  {    
    $sql = "select * from {$this->table} where id_client = '{$id}'";
    $row = $this->db->query($sql)->row_array();  
    if(!$row) return false;
    unset($row['id_client']);    
        
    $sql = $this->db->insert_string($this->table, $row );
    $this->db->query($sql); 
    $idn =  $this->db->insert_id();
    return $idn;
  }
  
  public function SavePost()
  {
    if(!$this->MApp->secure->edit) return;
    $data = array(
      'cod_cliente' => $this->input->post('cod_cliente'),
      'ididentificacion' => $this->input->post('ididentificacion'),
      'nombre' => $this->input->post('nombre'),
      'apellido1' => $this->input->post('apellido1'),
      'apellido2' => $this->input->post('apellido2'),
      'f_nacimiento' => $this->input->post('f_nacimiento'),
      'email1' => $this->input->post('email1'),
      'telefono' => $this->input->post('telefono'),
      'celular' => $this->input->post('celular'),
      'acumulados' => $this->input->post('acumulados'),
      'redimidos' => $this->input->post('redimidos'),
      'tipos_cliente' => $this->input->post('tipos_cliente'),
      'id_civil_status' => $this->input->post('id_civil_status'),
      'id_gender' => $this->input->post('id_gender'),
      'id_province' => $this->input->post('id_province'),
      'id_canton' => $this->input->post('id_canton'),
      'id_district' => $this->input->post('id_district'),
      'pub_mail' => $this->input->post('pub_mail') ? 1 : 0,
      'pub_tel' => $this->input->post('pub_tel') ? 1 : 0,
      'birthday' => human_to_mysql($this->input->post('birthday')),
      'date' => human_to_mysql($this->input->post('date')),
    );
    if( $this->id )
      $sql = $this->db->update_string($this->table, $data, "id_client = '{$this->id}'" );
    else
      $sql = $this->db->insert_string($this->table, $data );
    $this->db->query($sql); 
    return $this->id ? $this->id : $this->db->insert_id();
  }
    
  public function Unsuscribed( $mail = '' )
  {
    if(!valid_email($mail)) return true;
    $sql = "select count(*) as total FROM cemaco_clients.unsuscribe
    WHERE mail = '{$mail}'";
    $total = $this->db->query($sql)->row()->total;
    return ($total > 0);
  }
  
  public function Delete( $id = 0 )
  {
    if(!$this->MApp->secure->delete) return false;
    $sql = "DELETE FROM {$this->table}
    WHERE id_client = '{$id}'";
    $this->db->query($sql);
    return true;
  }
    
  public function DataElement( $id = 0, $null = false)
  {
    $ret = array();
    if($id)
    {
      $sql = "SELECT t.id_client as id, t.*,
      lj0.civil_status as civil_status,
      lj1.gender as gender,
      lj2.province as province,
      lj3.canton as canton,
      lj4.district as district      
      FROM {$this->table} as t      
      LEFT JOIN cemaco_clients.civil_status lj0 on t.id_civil_status = lj0.id_civil_status       
      LEFT JOIN cemaco_clients.gender lj1 on t.id_gender = lj1.id_gender       
      LEFT JOIN cemaco_clients.geo_province lj2 on t.id_province = lj2.id_province       
      LEFT JOIN cemaco_clients.geo_canton lj3 on t.id_canton = lj3.id_canton       
      LEFT JOIN cemaco_clients.geo_district lj4 on t.id_district = lj4.id_district       
      WHERE t.id_client = '{$id}' 
      LIMIT 0, 1";
      $ret = $this->db->query($sql)->row_array();
      if($ret) return $ret;
      if($null) return false;
    }    
    $ret['cod_cliente'] = $this->input->post() ? $this->input->post('cod_cliente') : '';
    $ret['ididentificacion'] = $this->input->post() ? $this->input->post('ididentificacion') : '';
    $ret['nombre'] = $this->input->post() ? $this->input->post('nombre') : '';
    $ret['apellido1'] = $this->input->post() ? $this->input->post('apellido1') : '';
    $ret['apellido2'] = $this->input->post() ? $this->input->post('apellido2') : '';
    $ret['email1'] = $this->input->post() ? $this->input->post('email1') : '';
    $ret['telefono'] = $this->input->post() ? $this->input->post('telefono') : '';
    $ret['celular'] = $this->input->post() ? $this->input->post('celular') : '';
    $ret['acumulados'] = $this->input->post() ? $this->input->post('acumulados') : '';
    $ret['redimidos'] = $this->input->post() ? $this->input->post('redimidos') : '';
    $ret['tipos_cliente'] = $this->input->post() ? $this->input->post('tipos_cliente') : '';
    $ret['id_civil_status'] = $this->input->post() ? $this->input->post('id_civil_status') : '';
    $ret['id_gender'] = $this->input->post() ? $this->input->post('id_gender') : '';
    $ret['id_province'] = $this->input->post() ? $this->input->post('id_province') : '';
    $ret['id_canton'] = $this->input->post() ? $this->input->post('id_canton') : '';
    $ret['id_district'] = $this->input->post() ? $this->input->post('id_district') : '';
    $ret['pub_mail'] = $this->input->post('pub_mail') ? 1 : 0;
    $ret['pub_tel'] = $this->input->post('pub_tel') ? 1 : 0;
    $ret['birthday'] = $this->input->post() ? human_to_mysql($this->input->post('birthday')) : date('Y-m-d');
    $ret['date'] = $this->input->post() ? human_to_mysql($this->input->post('date')) : date('Y-m-d');
    return $ret;
  }
  
  public function get_types( $types = '' )
  {
    $ret = array();
    $explode = explode(',', $types);
    foreach($explode as $e)
    {
      if(round($e))
        $ret[] = str_pad(round($e),2,"0",STR_PAD_LEFT);
    }
    return implode(',', $ret);
  } 
  
  public function get_pub_tel( $str = '' )
  {
    $str = strtolower(rtrim(trim($str)));
    return ($str == 's' || $str == 'y' || $str == 'yes' || $str == 'si') ? 1 : 0;
  } 
  
  public function get_pub_mail( $str = '' )
  {
    $str = strtolower(rtrim(trim($str)));
    return ($str == 's' || $str == 'y' || $str == 'yes' || $str == 'si') ? 1 : 0;
  } 
  
  public function get_birthday( $str = '' )
  {  
    $str = str_replace(array('00:00:00','0:00:00',':'),'',(rtrim(trim($str))));
    $birthday = '1900-00-00';
    $ba = explode('/', $str);
    if(count($ba) != 3)
      return $birthday;
    $b[0] = round($ba[0]);
    $b[1] = round($ba[1]);
    $b[2] = round($ba[2]);
    if( !$b[0] || !$b[1] || !$b[2])
      return $birthday;
    if($b[1]>12 || $b[0]>31)
      return $birthday;
    if(strlen($b[2]) == 2) 
      $b[2] = '19'. $b[2];
    if(strlen($b[2]) != 4)
      return $birthday;
    return "{$b[2]}-{$b[1]}-{$b[0]}";
  } 
  
  public function get_birthday2( $str = '' )
  {  
    $str = rtrim(trim($str));
    return substr($str,0,10);
  } 
  
  public function get_district( $str = '' )
  {
    $str = mb_ucfirstword(rtrim(trim($str)));
    if(!$str) return 1;
    $sql = "select id_district as id from cemaco_clients.geo_district where district = '{$str}'";
    $row = $this->db->query($sql)->row();
    if($row) return $row->id;
    $sql = $this->db->insert_string('cemaco_clients.geo_district', array('district' => $str));
    $this->db->query($sql);
    return $this->db->insert_id();
  } 
  
  public function get_canton( $str = '' )
  {
    $str = mb_ucfirstword(rtrim(trim($str)));
    if(!$str) return 1;
    $sql = "select id_canton as id from cemaco_clients.geo_canton where canton = '{$str}'";
    $row = $this->db->query($sql)->row();
    if($row) return $row->id;
    $sql = $this->db->insert_string('cemaco_clients.geo_canton', array('canton' => $str));
    $this->db->query($sql);
    return $this->db->insert_id();
  } 
  
  public function get_province( $str = '' )
  {
    $str = mb_ucfirstword(rtrim(trim($str)));
    if(!$str) return 1;
    $sql = "select id_province as id from cemaco_clients.geo_province where province = '{$str}'";
    $row = $this->db->query($sql)->row();
    if($row) return $row->id;
    $sql = $this->db->insert_string('cemaco_clients.geo_province', array('province' => $str));
    $this->db->query($sql);
    return $this->db->insert_id();
  } 
  
  public function get_gender( $str = '' )
  {
    $str = rtrim(trim($str));
    if(!$str) return 3;
    $sql = "select id_gender as id from cemaco_clients.gender where code = '{$str}'";
    $row = $this->db->query($sql)->row();
    return $row ? $row->id : 3;
  } 
  
  public function get_civil_status( $str = '' )
  {
    $str = mb_ucfirstword(rtrim(trim($str)));
    if(!$str) return 4;
    $sql = "select id_civil_status as id from cemaco_clients.civil_status where civil_status = '{$str}'";
    $row = $this->db->query($sql)->row();
    if($row) return $row->id;
    $sql = $this->db->insert_string('cemaco_clients.civil_status', array('civil_status' => $str));
    $this->db->query($sql);
    return $this->db->insert_id();
  }  

}