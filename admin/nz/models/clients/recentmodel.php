<?php

class RecentModel extends AppModel {

  function __construct()
  {
    parent::__construct();
    $this->table = "cemaco_clients.client";    
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
    ORDER BY `{$orderby}` {$ascdesc}"; 
    #LIMIT {$init}, {$perpage}";
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
    $sql .= " AND t.email1 != '' ";
    if(!$filter) 
      return $sql;  
    $text = $this->input->post('filter-text') ? $this->input->post('filter-text') : false;
    if(!$text)      
      $text = $this->input->post('sSearch') ? $this->input->post('sSearch') : false;
    if($text)
      $sql .= " AND ( t.cod_cliente like '%{$text}%'  OR  t.ididentificacion like '%{$text}%'  OR t.nombre = '{$text}' OR t.apellido1 = '{$text}' OR t.email1 = '{$text}') ";   
    
    if(!$this->input->post('filter-allclients'))
      $sql .= " AND t.tipos_cliente like '%04%'";        
  
    if($this->input->post('filter-date'))
    {
      $date = human_to_mysql($this->input->post('filter-date'));
      $sql .= " AND t.date >= '{$date}' ";  
    }
    else
    {
      $date = date('Y-m-d', time() - 60 * 60 * 24);
      $sql .= " AND t.date >= '{$date}' ";
    }
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
    );
  }
  
  public function ValidationRules()
  {
    return array(
      array(
       'field'   => 'client', 
       'label'   => $this->lang->line('Cliente'), 
       'rules'   => 'trim'
      ),
      array(
       'field'   => 'obs', 
       'label'   => $this->lang->line('Observaciones'), 
       'rules'   => 'trim'
      ),
      array(
       'field'   => 'id_file', 
       'label'   => $this->lang->line('Logo'), 
       'rules'   => 'trim'
      ),
      array(
       'field'   => 'active', 
       'label'   => $this->lang->line('Activo'), 
       'rules'   => 'trim|numeric'
      ),
    );
  }
  
  public function Name( $id = 0 )
  {
    $id = $id ? $id : $this->id;
    $sql = "SELECT client as `name`
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
    $id =  $this->db->insert_id();
    return $id;
  }
  
  public function SavePost()
  {
    if(!$this->MApp->secure->edit) return;
    $data = array(
      'client' => $this->input->post('client'),
      'mail' => $this->input->post('mail'),
      'obs' => $this->input->post('obs'),
      'id_file' => $this->input->post('id_file'),
      'active' => $this->input->post('active'),
    );
    if( $this->id )
      $sql = $this->db->update_string($this->table, $data, "id_client = '{$this->id}'" );
    else
      $sql = $this->db->insert_string($this->table, $data );
    $this->db->query($sql); 
    return $this->id ? $this->id : $this->db->insert_id();
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
      lj0.file as fm1file, lj0.id_type as fm1type, lj0.name as fm1name      
      FROM {$this->table} as t      
      LEFT JOIN {$this->dbglobal}nz_file lj0 on t.id_file = lj0.id_file      
      WHERE t.id_client = '{$id}' 
      LIMIT 0, 1";
      $ret = $this->db->query($sql)->row_array();
      if($ret) return $ret;
      if($null) return false;
    }    
    $ret['client'] = $this->input->post() ? $this->input->post('client') : '';
    $ret['mail'] = $this->input->post() ? $this->input->post('mail') : '';
    $ret['obs'] = $this->input->post() ? $this->input->post('obs') : '';
    $ret['id_file'] = $this->input->post() ? $this->input->post('id_file') : '';
    $ret['active'] = $this->input->post() ? $this->input->post('active') : 1;
    return $ret;
  }

}