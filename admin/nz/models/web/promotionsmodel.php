<?php

class PromotionsModel extends AppModel {

  function __construct()
  {
    parent::__construct();
    $this->table = "promotion";    
  }
  
  public function ListItems()
  {
    $where = $this->ListWhere(true);
    $init = $this->input->post('iDisplayStart') ? $this->input->post('iDisplayStart') : 0;
    $perpage = $this->input->post('iDisplayLength') ? $this->input->post('iDisplayLength') : 10;
    $orderby = $this->input->post('filter-sort-column') ? $this->input->post('filter-sort-column') : $this->mconfig['order-column'];
    $ascdesc = $this->input->post('filter-sort-type') ? $this->input->post('filter-sort-type') : $this->mconfig['order-type'];
    $sql = "SELECT t.id_promotion as id, t.*,
    lj0.state as state,
    lj1.file as fm1file, lj1.id_type as fm1type, lj1.name as fm1name    
    FROM {$this->table} as t    
    LEFT JOIN promotion_state lj0 on t.id_state = lj0.id_state      
    LEFT JOIN nz_file lj1 on t.id_file = lj1.id_file      
    WHERE $where 
    ORDER BY `{$orderby}` {$ascdesc} LIMIT {$init}, {$perpage}";
    return $this->db->query($sql)->result();
  }  
  
  public function ListTotal($filter = false)
  {
    $where = $this->ListWhere($filter);
    $sql = "SELECT count(*) as total 
    FROM {$this->table} as t    
    LEFT JOIN promotion_state lj0 on t.id_state = lj0.id_state     
    LEFT JOIN nz_file lj1 on t.id_file = lj1.id_file 
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
    if($this->input->post('filter-id_state'))
      $sql .= " AND t.id_state = '". $this->input->post('filter-id_state') ."'";
    if($this->input->post('filter-home'))
      $sql .= " AND t.home = '1'";
    if($text)
      $sql .= " AND ( t.title like '%{$text}%'  OR  t.subtitle like '%{$text}%'  OR  t.link like '%{$text}%'  OR t.id_promotion = '{$text}') ";   
    if($this->input->post('filter-id'))
      $sql .= " AND t.id_promotion = '". $this->input->post('filter-id') ."'";  
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
      'SelectPromotionState' => $this->Data->SelectPromotionState('', $this->lang->line('Selecciona una opción')),      
    );
  }
  
  public function ValidationRules()
  {
    return array(
      array(
       'field'   => 'id_state', 
       'label'   => $this->lang->line('Estado'), 
       'rules'   => 'trim|numeric'
      ),
      array(
       'field'   => 'title', 
       'label'   => $this->lang->line('Título'), 
       'rules'   => 'trim'
      ),
      array(
       'field'   => 'subtitle', 
       'label'   => $this->lang->line('Subtítulo'), 
       'rules'   => 'trim'
      ),
      array(
       'field'   => 'id_file', 
       'label'   => $this->lang->line('Imagen'), 
       'rules'   => 'trim'
      ),
      array(
       'field'   => 'link', 
       'label'   => $this->lang->line('Enlace Externo'), 
       'rules'   => 'trim'
      ),
      array(
       'field'   => 'home', 
       'label'   => $this->lang->line('Mostrar en Home'), 
       'rules'   => 'trim'
      ),
      array(
       'field'   => 'looks', 
       'label'   => $this->lang->line('Mostrar en Looks'), 
       'rules'   => 'trim'
      ),
      array(
       'field'   => 'collections', 
       'label'   => $this->lang->line('Mostrar en Colecciones'), 
       'rules'   => 'trim'
      ),
      array(
       'field'   => 'reductions', 
       'label'   => $this->lang->line('Mostrar en Rebajas'), 
       'rules'   => 'trim'
      ),
    );
  }
  
  public function Name( $id = 0 )
  {
    $id = $id ? $id : $this->id;
    $sql = "SELECT title as `name`
    FROM {$this->table}

    WHERE id_promotion = '{$id}'";
    $query = $this->db->query($sql);
    $row = $query->row();
    return clean_title($row->name);
  }
  
  public function Duplicate( $id = 0 )
  {    
    $sql = "select * from {$this->table} where id_promotion = '{$id}'";
    $row = $this->db->query($sql)->row_array();  
    if(!$row) return false;
    unset($row['id_promotion']);    
        
    $sql = $this->db->insert_string($this->table, $row );
    $this->db->query($sql); 
    $idn =  $this->db->insert_id();
    return $idn;
  }
  
  public function SavePost()
  {
    if(!$this->MApp->secure->edit) return;
    $data = array(
      'id_state' => $this->input->post('id_state'),
      'title' => $this->input->post('title'),
      'subtitle' => $this->input->post('subtitle'),
      'id_file' => $this->input->post('id_file'),
      'link' => $this->input->post('link'),
      'num' => $this->input->post('num'),
      'home' => $this->input->post('home') ? 1 : 0,
      'looks' => $this->input->post('looks') ? 1 : 0,
      'collections' => $this->input->post('collections') ? 1 : 0,
      'reductions' => $this->input->post('reductions') ? 1 : 0,
    );
    if( $this->id )
      $sql = $this->db->update_string($this->table, $data, "id_promotion = '{$this->id}'" );
    else
      $sql = $this->db->insert_string($this->table, $data );
    $this->db->query($sql); 
    return $this->id ? $this->id : $this->db->insert_id();
  }
  
  public function Delete( $id = 0 )
  {
    if(!$this->MApp->secure->delete) return false;
    $sql = "DELETE FROM {$this->table}
    WHERE id_promotion = '{$id}'";
    $this->db->query($sql);
    return true;
  }
    
  public function DataElement( $id = 0, $null = false)
  {
    $ret = array();
    if($id)
    {
      $sql = "SELECT t.id_promotion as id, t.*,
      lj0.state as state,
      lj1.file as fm1file, lj1.id_type as fm1type, lj1.name as fm1name      
      FROM {$this->table} as t      
      LEFT JOIN promotion_state lj0 on t.id_state = lj0.id_state       
      LEFT JOIN nz_file lj1 on t.id_file = lj1.id_file      
      WHERE t.id_promotion = '{$id}' 
      LIMIT 0, 1";
      $ret = $this->db->query($sql)->row_array();
      if($ret) return $ret;
      if($null) return false;
    }    
    $ret['id_state'] = $this->input->post() ? $this->input->post('id_state') : '';
    $ret['title'] = $this->input->post() ? $this->input->post('title') : '';
    $ret['subtitle'] = $this->input->post() ? $this->input->post('subtitle') : '';
    $ret['id_file'] = $this->input->post() ? $this->input->post('id_file') : '';
    $ret['link'] = $this->input->post() ? $this->input->post('link') : '';
    $ret['num'] = $this->input->post() ? $this->input->post('num') : '';
    $ret['home'] = $this->input->post('home') ? 1 : 0;
    $ret['looks'] = $this->input->post('looks') ? 1 : 0;
    $ret['collections'] = $this->input->post('collections') ? 1 : 0;
    $ret['reductions'] = $this->input->post('reductions') ? 1 : 0;
    return $ret;
  }

}