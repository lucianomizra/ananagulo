<?php

class MailingModel extends AppModel {

  function __construct()
  {
    parent::__construct();
    $this->table = "cemaco_clients.mailing";    
  }
  
  public function ListItems()
  {
    $where = $this->ListWhere(true);
    $init = $this->input->post('iDisplayStart') ? $this->input->post('iDisplayStart') : 0;
    $perpage = $this->input->post('iDisplayLength') ? $this->input->post('iDisplayLength') : 10;
    $orderby = $this->input->post('filter-sort-column') ? $this->input->post('filter-sort-column') : $this->mconfig['order-column'];
    $ascdesc = $this->input->post('filter-sort-type') ? $this->input->post('filter-sort-type') : $this->mconfig['order-type'];
    $sql = "SELECT t.id_mailing as id, t.*    
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
    if($text)
      $sql .= " AND ( t.mailing like '%{$text}%'  OR  t.result like '%{$text}%'  OR  t.data like '%{$text}%'  OR t.id_mailing = '{$text}') ";   
    if($this->input->post('filter-id'))
      $sql .= " AND t.id_mailing = '". $this->input->post('filter-id') ."'";  
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
       'field'   => 'mailing', 
       'label'   => $this->lang->line('Mailing'), 
       'rules'   => 'trim'
      ),
      array(
       'field'   => 'time', 
       'label'   => $this->lang->line('Fecha'), 
       'rules'   => 'trim'
      ),
      array(
       'field'   => 'count', 
       'label'   => $this->lang->line('Envíos'), 
       'rules'   => 'trim|numeric'
      ),
      array(
       'field'   => 'result', 
       'label'   => $this->lang->line('Resultado'), 
       'rules'   => 'trim'
      ),
      array(
       'field'   => 'data', 
       'label'   => $this->lang->line('Data'), 
       'rules'   => 'trim'
      ),
    );
  }
  
  public function Name( $id = 0 )
  {
    $id = $id ? $id : $this->id;
    $sql = "SELECT mailing as `name`
    FROM {$this->table}

    WHERE id_mailing = '{$id}'";
    $query = $this->db->query($sql);
    $row = $query->row();
    return clean_title($row->name);
  }
  
  public function Duplicate( $id = 0 )
  {    
    $sql = "select * from {$this->table} where id_mailing = '{$id}'";
    $row = $this->db->query($sql)->row_array();  
    if(!$row) return false;
    unset($row['id_mailing']);    
        
    $sql = $this->db->insert_string($this->table, $row );
    $this->db->query($sql); 
    $idn =  $this->db->insert_id();
    return $idn;
  }
  
  public function SavePost()
  {
    if(!$this->MApp->secure->edit) return;
    $data = array(
      'mailing' => $this->input->post('mailing'),
      'result' => $this->input->post('result'),
      'count' => $this->input->post('count'),
      'data' => $this->input->post('data'),
    );
    if( $this->id )
      $sql = $this->db->update_string($this->table, $data, "id_mailing = '{$this->id}'" );
    else
      $sql = $this->db->insert_string($this->table, $data );
    $this->db->query($sql); 
    return $this->id ? $this->id : $this->db->insert_id();
  }
  
  public function Delete( $id = 0 )
  {
    if(!$this->MApp->secure->delete) return false;
    $sql = "DELETE FROM {$this->table}
    WHERE id_mailing = '{$id}'";
    $this->db->query($sql);
    return true;
  }
    
  public function DataElement( $id = 0, $null = false)
  {
    $ret = array();
    if($id)
    {
      $sql = "SELECT t.id_mailing as id, t.*      
      FROM {$this->table} as t      
      WHERE t.id_mailing = '{$id}' 
      LIMIT 0, 1";
      $ret = $this->db->query($sql)->row_array();
      if($ret) return $ret;
      if($null) return false;
    }    
    $ret['mailing'] = $this->input->post() ? $this->input->post('mailing') : '';
    $ret['result'] = $this->input->post() ? $this->input->post('result') : '';
    $ret['count'] = $this->input->post() ? $this->input->post('count') : '';
    $ret['data'] = $this->input->post() ? $this->input->post('data') : '';
    return $ret;
  }

}