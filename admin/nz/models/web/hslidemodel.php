<?php

class HslideModel extends AppModel {

  function __construct()
  {
    parent::__construct();
    $this->table = "home_slide";    
  }
  
  public function ListItems()
  {
    $where = $this->ListWhere(true);
    $init = $this->input->post('iDisplayStart') ? $this->input->post('iDisplayStart') : 0;
    $perpage = $this->input->post('iDisplayLength') ? $this->input->post('iDisplayLength') : 10;
    $orderby = $this->input->post('filter-sort-column') ? $this->input->post('filter-sort-column') : $this->mconfig['order-column'];
    $ascdesc = $this->input->post('filter-sort-type') ? $this->input->post('filter-sort-type') : $this->mconfig['order-type'];
    $sql = "SELECT t.id_home as id, t.*,
    lj0.file as fm1file, lj0.id_type as fm1type, lj0.name as fm1name    
    FROM {$this->table} as t    
    LEFT JOIN nz_file lj0 on t.id_file = lj0.id_file      
    WHERE $where 
    ORDER BY `{$orderby}` {$ascdesc} LIMIT {$init}, {$perpage}";
    return $this->db->query($sql)->result();
  }  
  
  public function ListTotal($filter = false)
  {
    $where = $this->ListWhere($filter);
    $sql = "SELECT count(*) as total 
    FROM {$this->table} as t    
    LEFT JOIN nz_file lj0 on t.id_file = lj0.id_file 
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
    if($this->input->post('filter-active'))
      $sql .= " AND t.active = '1'";
    if($text)
      $sql .= " AND ( t.title like '%{$text}%'  OR  t.text like '%{$text}%'  OR  t.link like '%{$text}%'  OR t.id_home = '{$text}') ";   
    if($this->input->post('filter-id'))
      $sql .= " AND t.id_home = '". $this->input->post('filter-id') ."'";  
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
       'field'   => 'id_file', 
       'label'   => $this->lang->line('Imagen'), 
       'rules'   => 'trim'
      ),
      array(
       'field'   => 'title', 
       'label'   => $this->lang->line('Título'), 
       'rules'   => 'trim'
      ),
      array(
       'field'   => 'text', 
       'label'   => $this->lang->line('Texto'), 
       'rules'   => 'trim'
      ),
      array(
       'field'   => 'link', 
       'label'   => $this->lang->line('Enlace'), 
       'rules'   => 'trim'
      ),
      array(
       'field'   => 'num', 
       'label'   => $this->lang->line('Orden'), 
       'rules'   => 'trim|numeric'
      ),
      array(
       'field'   => 'active', 
       'label'   => $this->lang->line('Activo'), 
       'rules'   => 'trim'
      ),
    );
  }
  
  public function Name( $id = 0 )
  {
    $id = $id ? $id : $this->id;
    $sql = "SELECT title as `name`
    FROM {$this->table}

    WHERE id_home = '{$id}'";
    $query = $this->db->query($sql);
    $row = $query->row();
    return clean_title($row->name);
  }
  
  public function Duplicate( $id = 0 )
  {    
    $sql = "select * from {$this->table} where id_home = '{$id}'";
    $row = $this->db->query($sql)->row_array();  
    if(!$row) return false;
    unset($row['id_home']);    
        
    $sql = $this->db->insert_string($this->table, $row );
    $this->db->query($sql); 
    $idn =  $this->db->insert_id();
    return $idn;
  }
  
  public function SavePost()
  {
    if(!$this->MApp->secure->edit) return;
    $data = array(
      'id_file' => $this->input->post('id_file'),
      'title' => $this->input->post('title'),
      'title2' => $this->input->post('title2'),
      'button' => $this->input->post('button'),
      'text' => $this->input->post('text'),
      'link' => $this->input->post('link'),
      'num' => $this->input->post('num'),
      'active' => $this->input->post('active') ? 1 : 0,
    );
    if( $this->id )
      $sql = $this->db->update_string($this->table, $data, "id_home = '{$this->id}'" );
    else
      $sql = $this->db->insert_string($this->table, $data );
    $this->db->query($sql); 
    return $this->id ? $this->id : $this->db->insert_id();
  }
  
  public function Delete( $id = 0 )
  {
    if(!$this->MApp->secure->delete) return false;
    $sql = "DELETE FROM {$this->table}
    WHERE id_home = '{$id}'";
    $this->db->query($sql);
    return true;
  }
    
  public function DataElement( $id = 0, $null = false)
  {
    $ret = array();
    if($id)
    {
      $sql = "SELECT t.id_home as id, t.*,
      lj0.file as fm1file, lj0.id_type as fm1type, lj0.name as fm1name      
      FROM {$this->table} as t      
      LEFT JOIN nz_file lj0 on t.id_file = lj0.id_file      
      WHERE t.id_home = '{$id}' 
      LIMIT 0, 1";
      $ret = $this->db->query($sql)->row_array();
      if($ret) return $ret;
      if($null) return false;
    }    
    $ret['id_file'] = $this->input->post() ? $this->input->post('id_file') : '';
    $ret['title'] = $this->input->post() ? $this->input->post('title') : '';
    $ret['title2'] = $this->input->post() ? $this->input->post('title2') : '';
    $ret['button'] = $this->input->post() ? $this->input->post('button') : '';
    $ret['text'] = $this->input->post() ? $this->input->post('text') : '';
    $ret['link'] = $this->input->post() ? $this->input->post('link') : '';
    $ret['num'] = $this->input->post() ? $this->input->post('num') : '';
    $ret['active'] = $this->input->post('active') ? 1 : 0;
    return $ret;
  }

}