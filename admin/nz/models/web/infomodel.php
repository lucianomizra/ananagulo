<?php

class InfoModel extends AppModel {

  function __construct()
  {
    parent::__construct();
    $this->table = "information";    
  }
  
  public function ListItems()
  {
    $where = $this->ListWhere(true);
    $init = $this->input->post('iDisplayStart') ? $this->input->post('iDisplayStart') : 0;
    $perpage = $this->input->post('iDisplayLength') ? $this->input->post('iDisplayLength') : 10;
    $orderby = $this->input->post('filter-sort-column') ? $this->input->post('filter-sort-column') : $this->mconfig['order-column'];
    $ascdesc = $this->input->post('filter-sort-type') ? $this->input->post('filter-sort-type') : $this->mconfig['order-type'];
    $sql = "SELECT t.id_information as id, t.*, 
    (select count(*) as total from nz_gallery_file gf where gf.id_gallery  = t.id_gallery) as fmg1,
    lj0.style as style    
    FROM {$this->table} as t    
    LEFT JOIN information_style lj0 on t.id_style = lj0.id_style      
    WHERE $where 
    ORDER BY `{$orderby}` {$ascdesc} LIMIT {$init}, {$perpage}";
    return $this->db->query($sql)->result();
  }  
  
  public function ListTotal($filter = false)
  {
    $where = $this->ListWhere($filter);
    $sql = "SELECT count(*) as total 
    FROM {$this->table} as t    
    LEFT JOIN information_style lj0 on t.id_style = lj0.id_style 
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
    if($this->input->post('filter-id_gallery'))
      $sql .= " AND t.id_gallery = '". $this->input->post('filter-id_gallery') ."'";
    if($this->input->post('filter-id_style'))
      $sql .= " AND t.id_style = '". $this->input->post('filter-id_style') ."'";
    if($text)
      $sql .= " AND ( t.information like '%{$text}%'  OR  t.link like '%{$text}%'  OR  t.title like '%{$text}%'  OR  t.subtitle like '%{$text}%'  OR  t.text like '%{$text}%'  OR t.id_information = '{$text}') ";   
    if($this->input->post('filter-id'))
      $sql .= " AND t.id_information = '". $this->input->post('filter-id') ."'";  
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
      'Select' => $this->Data->SelectInformationStyle('', $this->lang->line('Selecciona una opción')),      
    );
  }
  
  public function ValidationRules()
  {
    return array(
      array(
       'field'   => 'information', 
       'label'   => $this->lang->line('Sección'), 
       'rules'   => 'trim'
      ),
      array(
       'field'   => 'link', 
       'label'   => $this->lang->line('Nombre URL'), 
       'rules'   => 'trim'
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
       'field'   => 'text', 
       'label'   => $this->lang->line('Contenido'), 
       'rules'   => 'trim'
      ),
      array(
       'field'   => 'id_gallery', 
       'label'   => $this->lang->line('Imágenes'), 
       'rules'   => 'trim'
      ),
      array(
       'field'   => 'id_style', 
       'label'   => $this->lang->line('Estilo'), 
       'rules'   => 'trim|numeric'
      ),
    );
  }
  
  public function Name( $id = 0 )
  {
    $id = $id ? $id : $this->id;
    $sql = "SELECT information as `name`
    FROM {$this->table}

    WHERE id_information = '{$id}'";
    $query = $this->db->query($sql);
    $row = $query->row();
    return clean_title($row->name);
  }
  
  public function Duplicate( $id = 0 )
  {    
    $sql = "select * from {$this->table} where id_information = '{$id}'";
    $row = $this->db->query($sql)->row_array();  
    if(!$row) return false;
    unset($row['id_information']);    
        if($row['id_gallery'])
    {
      $oldID = $row['id_gallery'];
      $row['id_gallery'] = $this->MApp->CreateGallery();
      $this->MApp->DuplicateGallery($oldID,$row['id_gallery']);
    }    
        
    $sql = $this->db->insert_string($this->table, $row );
    $this->db->query($sql); 
    $idn =  $this->db->insert_id();
    return $idn;
  }
  
  public function SavePost()
  {
    if(!$this->MApp->secure->edit) return;
    $data = array(
      'information' => $this->input->post('information'),
      'link' => $this->input->post('link'),
      'title' => $this->input->post('title'),
      'subtitle' => $this->input->post('subtitle'),
      'text' => $this->input->post('text'),
      'id_gallery' => $this->input->post('id_gallery'),
      'id_style' => $this->input->post('id_style'),
      'num' => $this->input->post('num'),
    );
    $gitems = explode(',', $this->input->post('id_gallery-items'));
    if($data['id_gallery'])
      $this->MApp->EmptyGallery($data['id_gallery']);
    if(count($gitems))
    {
      if(!$this->input->post('id_gallery'))
        $data['id_gallery'] = $this->MApp->CreateGallery();
      $this->MApp->AddGalleryItems($data['id_gallery'], $gitems);
    }    
    if( $this->id )
      $sql = $this->db->update_string($this->table, $data, "id_information = '{$this->id}'" );
    else
      $sql = $this->db->insert_string($this->table, $data );
    $this->db->query($sql); 
    return $this->id ? $this->id : $this->db->insert_id();
  }
  
  public function Delete( $id = 0 )
  {
    if(!$this->MApp->secure->delete) return false;
    $sql = "DELETE FROM {$this->table}
    WHERE id_information = '{$id}'";
    $this->db->query($sql);
    $this->MApp->DeleteGallery($data['id_gallery']);
    return true;
  }
    
  public function DataElement( $id = 0, $null = false)
  {
    $ret = array();
    if($id)
    {
      $sql = "SELECT t.id_information as id, t.*,
      lj0.style as style      
      FROM {$this->table} as t      
      LEFT JOIN information_style lj0 on t.id_style = lj0.id_style       
      WHERE t.id_information = '{$id}' 
      LIMIT 0, 1";
      $ret = $this->db->query($sql)->row_array();
      if($ret) return $ret;
      if($null) return false;
    }    
    $ret['information'] = $this->input->post() ? $this->input->post('information') : '';
    $ret['link'] = $this->input->post() ? $this->input->post('link') : '';
    $ret['title'] = $this->input->post() ? $this->input->post('title') : '';
    $ret['subtitle'] = $this->input->post() ? $this->input->post('subtitle') : '';
    $ret['text'] = $this->input->post() ? $this->input->post('text') : '';
    $ret['id_gallery'] = $this->input->post() ? $this->input->post('id_gallery') : '';
    $ret['id_style'] = $this->input->post() ? $this->input->post('id_style') : '';
    $ret['num'] = $this->input->post() ? $this->input->post('num') : '';
    return $ret;
  }

}