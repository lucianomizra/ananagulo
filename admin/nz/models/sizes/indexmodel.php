<?php

class IndexModel extends AppModel {

  function __construct()
  {
    parent::__construct();
    $this->table = "size";    
  }
  
  public function ListItems()
  {
    $where = $this->ListWhere(true);
    $init = $this->input->post('iDisplayStart') ? $this->input->post('iDisplayStart') : 0;
    $perpage = $this->input->post('iDisplayLength') ? $this->input->post('iDisplayLength') : 10;
    $orderby = $this->input->post('filter-sort-column') ? $this->input->post('filter-sort-column') : $this->mconfig['order-column'];
    $ascdesc = $this->input->post('filter-sort-type') ? $this->input->post('filter-sort-type') : $this->mconfig['order-type'];
    $sql = "SELECT t.id_size as id, t.*, CONCAT(lj0.num, t.num) as xnum,
    lj0.type as type    
    FROM {$this->table} as t    
    LEFT JOIN size_type lj0 on t.id_type = lj0.id_type      
    WHERE $where 
    ORDER BY `{$orderby}` {$ascdesc} LIMIT {$init}, {$perpage}";
    return $this->db->query($sql)->result();
  }  
  
  public function ListTotal($filter = false)
  {
    $where = $this->ListWhere($filter);
    $sql = "SELECT count(*) as total 
    FROM {$this->table} as t    
    LEFT JOIN size_type lj0 on t.id_type = lj0.id_type 
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
    if($this->input->post('filter-id_type'))
      $sql .= " AND t.id_type = '". $this->input->post('filter-id_type') ."'";
    if($text)
      $sql .= " AND ( t.size like '%{$text}%'  OR  t.sizes like '%{$text}%'  OR t.id_size = '{$text}') ";   
    if($this->input->post('filter-id'))
      $sql .= " AND t.id_size = '". $this->input->post('filter-id') ."'";  
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
      'SelectSizeType' => $this->Data->SelectSizeType('', $this->lang->line('Selecciona una opción')),      
    );
  }
  
  public function ValidationRules()
  {
    return array(
      array(
       'field'   => 'id_type', 
       'label'   => $this->lang->line('Tipo'), 
       'rules'   => 'trim|numeric'
      ),
      array(
       'field'   => 'size', 
       'label'   => $this->lang->line('Nombre'), 
       'rules'   => 'trim'
      ),
      array(
       'field'   => 'sizes', 
       'label'   => $this->lang->line('Tallas'), 
       'rules'   => 'trim'
      ),
      array(
       'field'   => 'num', 
       'label'   => $this->lang->line('Orden'), 
       'rules'   => 'trim|numeric'
      ),
    );
  }
  
  public function Name( $id = 0 )
  {
    $id = $id ? $id : $this->id;
    $sql = "SELECT size as `name`
    FROM {$this->table}

    WHERE id_size = '{$id}'";
    $query = $this->db->query($sql);
    $row = $query->row();
    return clean_title($row->name);
  }
  
  public function Duplicate( $id = 0 )
  {    
    $sql = "select * from {$this->table} where id_size = '{$id}'";
    $row = $this->db->query($sql)->row_array();  
    if(!$row) return false;
    unset($row['id_size']);    
        
    $sql = $this->db->insert_string($this->table, $row );
    $this->db->query($sql); 
    $idn =  $this->db->insert_id();
    return $idn;
  }
  
  public function SavePost()
  {
    if(!$this->MApp->secure->edit) return;
    $data = array(
      'id_type' => $this->input->post('id_type'),
      'size' => $this->input->post('size'),
      'sizes' => $this->input->post('sizes'),
      'num' => $this->input->post('num'),
    );
    if( $this->id )
      $sql = $this->db->update_string($this->table, $data, "id_size = '{$this->id}'" );
    else
      $sql = $this->db->insert_string($this->table, $data );
    $this->db->query($sql); 
    return $this->id ? $this->id : $this->db->insert_id();
  }
  
  public function Delete( $id = 0 )
  {
    if(!$this->MApp->secure->delete) return false;
    $sql = "DELETE FROM {$this->table}
    WHERE id_size = '{$id}'";
    $this->db->query($sql);
    return true;
  }
    
  public function DataElement( $id = 0, $null = false)
  {
    $ret = array();
    if($id)
    {
      $sql = "SELECT t.id_size as id, t.*,
      lj0.type as type      
      FROM {$this->table} as t      
      LEFT JOIN size_type lj0 on t.id_type = lj0.id_type       
      WHERE t.id_size = '{$id}' 
      LIMIT 0, 1";
      $ret = $this->db->query($sql)->row_array();
      if($ret) return $ret;
      if($null) return false;
    }    
    $ret['id_type'] = $this->input->post() ? $this->input->post('id_type') : '';
    $ret['size'] = $this->input->post() ? $this->input->post('size') : '';
    $ret['sizes'] = $this->input->post() ? $this->input->post('sizes') : '';
    $ret['num'] = $this->input->post() ? $this->input->post('num') : '';
    return $ret;
  }

}