<?php

class SubsModel extends AppModel {

  function __construct()
  {
    parent::__construct();
    $this->table = "product_sub";    
  }
  
  public function ListItems()
  {
    $where = $this->ListWhere(true);
    $init = $this->input->post('iDisplayStart') ? $this->input->post('iDisplayStart') : 0;
    $perpage = $this->input->post('iDisplayLength') ? $this->input->post('iDisplayLength') : 10;
    $orderby = $this->input->post('filter-sort-column') ? $this->input->post('filter-sort-column') : $this->mconfig['order-column'];
    $ascdesc = $this->input->post('filter-sort-type') ? $this->input->post('filter-sort-type') : $this->mconfig['order-type'];
    $sql = "SELECT t.id_sub as id, t.*,
    (select count(*) from product_sub2 where id_sub = t.id_sub) as subs2,
    (select count(*) from product where id_sub = t.id_sub) as products,
    lj0.category as category    
    FROM {$this->table} as t    
    LEFT JOIN product_category lj0 on t.id_category = lj0.id_category      
    WHERE $where 
    ORDER BY `{$orderby}` {$ascdesc} LIMIT {$init}, {$perpage}";
    return $this->db->query($sql)->result();
  }  
  
  public function ListTotal($filter = false)
  {
    $where = $this->ListWhere($filter);
    $sql = "SELECT count(*) as total 
    FROM {$this->table} as t    
    LEFT JOIN product_category lj0 on t.id_category = lj0.id_category 
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
    if($this->input->post('filter-id_category'))
      $sql .= " AND t.id_category = '". $this->input->post('filter-id_category') ."'";
    if($text)
      $sql .= " AND ( t.sub like '%{$text}%'  OR t.id_sub = '{$text}') ";   
    if($this->input->post('filter-id'))
      $sql .= " AND t.id_sub = '". $this->input->post('filter-id') ."'";  
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
      'SelectProductCategory' => $this->Data->SelectProductCategory('', $this->lang->line('Selecciona una opción')),      
    );
  }
  
  public function ValidationRules()
  {
    return array(
      array(
       'field'   => 'id_category', 
       'label'   => $this->lang->line('Departamento'), 
       'rules'   => 'trim|numeric'
      ),
      array(
       'field'   => 'sub', 
       'label'   => $this->lang->line('Categoría'), 
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
    $sql = "SELECT sub as `name`
    FROM {$this->table}

    WHERE id_sub = '{$id}'";
    $query = $this->db->query($sql);
    $row = $query->row();
    return clean_title($row->name);
  }
  
  public function Duplicate( $id = 0 )
  {    
    $sql = "select * from {$this->table} where id_sub = '{$id}'";
    $row = $this->db->query($sql)->row_array();  
    if(!$row) return false;
    unset($row['id_sub']);    
        
    $sql = $this->db->insert_string($this->table, $row );
    $this->db->query($sql); 
    $idn =  $this->db->insert_id();
    return $idn;
  }
  
  public function SavePost()
  {
    if(!$this->MApp->secure->edit) return;
    $data = array(
      'id_category' => $this->input->post('id_category'),
      'sub' => $this->input->post('sub'),
      'num' => $this->input->post('num'),
    );
    if( $this->id )
      $sql = $this->db->update_string($this->table, $data, "id_sub = '{$this->id}'" );
    else
      $sql = $this->db->insert_string($this->table, $data );
    $this->db->query($sql); 
    return $this->id ? $this->id : $this->db->insert_id();
  }
  
  public function Delete( $id = 0 )
  {
    if(!$this->MApp->secure->delete) return false;
    $sql = "DELETE FROM {$this->table}
    WHERE id_sub = '{$id}'";
    $this->db->query($sql);
    return true;
  }
    
  public function DataElement( $id = 0, $null = false)
  {
    $ret = array();
    if($id)
    {
      $sql = "SELECT t.id_sub as id, t.*,
      lj0.category as category      
      FROM {$this->table} as t      
      LEFT JOIN product_category lj0 on t.id_category = lj0.id_category       
      WHERE t.id_sub = '{$id}' 
      LIMIT 0, 1";
      $ret = $this->db->query($sql)->row_array();
      if($ret) return $ret;
      if($null) return false;
    }    
    $ret['id_category'] = $this->input->post() ? $this->input->post('id_category') : '';
    $ret['sub'] = $this->input->post() ? $this->input->post('sub') : '';
    $ret['num'] = $this->input->post() ? $this->input->post('num') : '';
    return $ret;
  }

}