<?php

class UsersModel extends AppModel {

  function __construct()
  {
    parent::__construct();
    $this->table = "user";    
  }
  
  public function ListItems()
  {
    $where = $this->ListWhere(true);
    $init = $this->input->post('iDisplayStart') ? $this->input->post('iDisplayStart') : 0;
    $perpage = $this->input->post('iDisplayLength') ? $this->input->post('iDisplayLength') : 10;
    $orderby = $this->input->post('filter-sort-column') ? $this->input->post('filter-sort-column') : $this->mconfig['order-column'];
    $ascdesc = $this->input->post('filter-sort-type') ? $this->input->post('filter-sort-type') : $this->mconfig['order-type'];
    $sql = "SELECT t.id_user as id, t.*,
    lj0.state as state,
    lj1.treatment as treatment,
    lj2.country as country,
    lj3.treatment as treatment_2,
    lj4.country as country_2    
    FROM {$this->table} as t    
    LEFT JOIN user_state lj0 on t.id_state = lj0.id_state      
    LEFT JOIN user_treatment lj1 on t.id_treatment = lj1.id_treatment      
    LEFT JOIN country lj2 on t.id_country = lj2.id_country      
    LEFT JOIN user_treatment lj3 on t.id_treatment_2 = lj3.id_treatment      
    LEFT JOIN country lj4 on t.id_country_2 = lj4.id_country      
    WHERE $where 
    ORDER BY `{$orderby}` {$ascdesc} LIMIT {$init}, {$perpage}";
    return $this->db->query($sql)->result();
  }  
  
  public function ListTotal($filter = false)
  {
    $where = $this->ListWhere($filter);
    $sql = "SELECT count(*) as total 
    FROM {$this->table} as t    
    LEFT JOIN user_state lj0 on t.id_state = lj0.id_state     
    LEFT JOIN user_treatment lj1 on t.id_treatment = lj1.id_treatment     
    LEFT JOIN country lj2 on t.id_country = lj2.id_country     
    LEFT JOIN user_treatment lj3 on t.id_treatment_2 = lj3.id_treatment     
    LEFT JOIN country lj4 on t.id_country_2 = lj4.id_country 
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
    if($this->input->post('filter-id_treatment'))
      $sql .= " AND t.id_treatment = '". $this->input->post('filter-id_treatment') ."'";
    if($this->input->post('filter-id_country'))
      $sql .= " AND t.id_country = '". $this->input->post('filter-id_country') ."'";
    if($this->input->post('filter-id_treatment_2'))
      $sql .= " AND t.id_treatment_2 = '". $this->input->post('filter-id_treatment_2') ."'";
    if($this->input->post('filter-id_country_2'))
      $sql .= " AND t.id_country_2 = '". $this->input->post('filter-id_country_2') ."'";
    if($this->input->post('filter-date1'))
    {
      $sql .= " AND date(t.registro) >= '". human_to_mysql($this->input->post('filter-date1')) ."'";
    }
    if($this->input->post('filter-date2'))
    {
      $sql .= " AND date(t.registro) <= '". human_to_mysql($this->input->post('filter-date2')) ."'";
    }
    if($text)
      $sql .= " AND ( t.name like '%{$text}%'  OR  t.lastname like '%{$text}%'  OR  t.dir1 like '%{$text}%'  OR  t.dir2 like '%{$text}%'  OR  t.city like '%{$text}%'  OR  t.cp like '%{$text}%'  OR  t.mail like '%{$text}%'  OR  t.password like '%{$text}%'  OR  t.name_2 like '%{$text}%'  OR  t.lastname_2 like '%{$text}%'  OR  t.dir1_2 like '%{$text}%'  OR  t.dir2_2 like '%{$text}%'  OR  t.city_2 like '%{$text}%'  OR  t.cp_2 like '%{$text}%'  OR  t.mail_2 like '%{$text}%'  OR t.id_user = '{$text}') ";   
    if($this->input->post('filter-id'))
      $sql .= " AND t.id_user = '". $this->input->post('filter-id') ."'";  
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
      'SelectUserState' => $this->Data->SelectUserState('', $this->lang->line('Selecciona una opción')),
      'SelectUserTreatment' => $this->Data->SelectUserTreatment('', $this->lang->line('Selecciona una opción')),
      'SelectCountry' => $this->Data->SelectCountry('', $this->lang->line('Selecciona una opción')),
      'SelectUserTreatment' => $this->Data->SelectUserTreatment('', $this->lang->line('Selecciona una opción')),
      'SelectCountry' => $this->Data->SelectCountry('', $this->lang->line('Selecciona una opción')),      
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
       'field'   => 'id_treatment', 
       'label'   => $this->lang->line('Tratamiento'), 
       'rules'   => 'trim'
      ),
      array(
       'field'   => 'name', 
       'label'   => $this->lang->line('Nombre'), 
       'rules'   => 'trim'
      ),
      array(
       'field'   => 'lastname', 
       'label'   => $this->lang->line('Apellidos'), 
       'rules'   => 'trim'
      ),
      array(
       'field'   => 'dir1', 
       'label'   => $this->lang->line('Dirección 1'), 
       'rules'   => 'trim'
      ),
      array(
       'field'   => 'dir2', 
       'label'   => $this->lang->line('Dirección 2'), 
       'rules'   => 'trim'
      ),
      array(
       'field'   => 'city', 
       'label'   => $this->lang->line('Ciudad'), 
       'rules'   => 'trim'
      ),
      array(
       'field'   => 'cp', 
       'label'   => $this->lang->line('Código Postal'), 
       'rules'   => 'trim'
      ),
      array(
       'field'   => 'id_country', 
       'label'   => $this->lang->line('País'), 
       'rules'   => 'trim|numeric'
      ),
      array(
       'field'   => 'mail', 
       'label'   => $this->lang->line('E-mail'), 
       'rules'   => 'trim'
      ),
      array(
       'field'   => 'password', 
       'label'   => $this->lang->line('Contraseña'), 
       'rules'   => 'trim'
      ),
      array(
       'field'   => 'id_treatment_2', 
       'label'   => $this->lang->line('Tratamiento'), 
       'rules'   => 'trim'
      ),
      array(
       'field'   => 'name_2', 
       'label'   => $this->lang->line('Nombre'), 
       'rules'   => 'trim'
      ),
      array(
       'field'   => 'lastname_2', 
       'label'   => $this->lang->line('Apellidos'), 
       'rules'   => 'trim'
      ),
      array(
       'field'   => 'dir1_2', 
       'label'   => $this->lang->line('Dirección 1'), 
       'rules'   => 'trim'
      ),
      array(
       'field'   => 'dir2_2', 
       'label'   => $this->lang->line('Dirección 2'), 
       'rules'   => 'trim'
      ),
      array(
       'field'   => 'city_2', 
       'label'   => $this->lang->line('Ciudad'), 
       'rules'   => 'trim'
      ),
      array(
       'field'   => 'cp_2', 
       'label'   => $this->lang->line('Código Postal'), 
       'rules'   => 'trim'
      ),
      array(
       'field'   => 'id_country_2', 
       'label'   => $this->lang->line('País'), 
       'rules'   => 'trim|numeric'
      ),
      array(
       'field'   => 'mail_2', 
       'label'   => $this->lang->line('E-mail'), 
       'rules'   => 'trim'
      ),
    );
  }
  
  public function Name( $id = 0 )
  {
    $id = $id ? $id : $this->id;
    $sql = "SELECT name as `name`
    FROM {$this->table}

    WHERE id_user = '{$id}'";
    $query = $this->db->query($sql);
    $row = $query->row();
    return clean_title($row->name);
  }
  
  public function Duplicate( $id = 0 )
  {    
    $sql = "select * from {$this->table} where id_user = '{$id}'";
    $row = $this->db->query($sql)->row_array();  
    if(!$row) return false;
    unset($row['id_user']);    
        
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
      'id_treatment' => $this->input->post('id_treatment'),
      'name' => $this->input->post('name'),
      'lastname' => $this->input->post('lastname'),
      'dir1' => $this->input->post('dir1'),
      'dir2' => $this->input->post('dir2'),
      'city' => $this->input->post('city'),
      'cp' => $this->input->post('cp'),
      'id_country' => $this->input->post('id_country'),
      'mail' => $this->input->post('mail'),
      'password' => $this->input->post('password'),
      'id_treatment_2' => $this->input->post('id_treatment_2'),
      'name_2' => $this->input->post('name_2'),
      'lastname_2' => $this->input->post('lastname_2'),
      'dir1_2' => $this->input->post('dir1_2'),
      'dir2_2' => $this->input->post('dir2_2'),
      'city_2' => $this->input->post('city_2'),
      'cp_2' => $this->input->post('cp_2'),
      'id_country_2' => $this->input->post('id_country_2'),
      'mail_2' => $this->input->post('mail_2'),
    );
    if( $this->id )
      $sql = $this->db->update_string($this->table, $data, "id_user = '{$this->id}'" );
    else
      $sql = $this->db->insert_string($this->table, $data );
    $this->db->query($sql); 
    return $this->id ? $this->id : $this->db->insert_id();
  }
  
  public function Delete( $id = 0 )
  {
    if(!$this->MApp->secure->delete) return false;
    $sql = "DELETE FROM {$this->table}
    WHERE id_user = '{$id}'";
    $this->db->query($sql);
    return true;
  }
    
  public function DataElement( $id = 0, $null = false)
  {
    $ret = array();
    if($id)
    {
      $sql = "SELECT t.id_user as id, t.*,
      lj0.state as state,
      lj1.treatment as treatment,
      lj2.country as country,
      lj3.treatment as treatment_2,
      lj4.country as country_2      
      FROM {$this->table} as t      
      LEFT JOIN user_state lj0 on t.id_state = lj0.id_state       
      LEFT JOIN user_treatment lj1 on t.id_treatment = lj1.id_treatment       
      LEFT JOIN country lj2 on t.id_country = lj2.id_country       
      LEFT JOIN user_treatment lj3 on t.id_treatment_2 = lj3.id_treatment       
      LEFT JOIN country lj4 on t.id_country_2 = lj4.id_country       
      WHERE t.id_user = '{$id}' 
      LIMIT 0, 1";
      $ret = $this->db->query($sql)->row_array();
      if($ret) return $ret;
      if($null) return false;
    }    
    $ret['id_state'] = $this->input->post() ? $this->input->post('id_state') : '';
    $ret['id_treatment'] = $this->input->post() ? $this->input->post('id_treatment') : '';
    $ret['name'] = $this->input->post() ? $this->input->post('name') : '';
    $ret['lastname'] = $this->input->post() ? $this->input->post('lastname') : '';
    $ret['dir1'] = $this->input->post() ? $this->input->post('dir1') : '';
    $ret['dir2'] = $this->input->post() ? $this->input->post('dir2') : '';
    $ret['city'] = $this->input->post() ? $this->input->post('city') : '';
    $ret['cp'] = $this->input->post() ? $this->input->post('cp') : '';
    $ret['id_country'] = $this->input->post() ? $this->input->post('id_country') : '';
    $ret['mail'] = $this->input->post() ? $this->input->post('mail') : '';
    $ret['password'] = $this->input->post() ? $this->input->post('password') : '';
    $ret['id_treatment_2'] = $this->input->post() ? $this->input->post('id_treatment_2') : '';
    $ret['name_2'] = $this->input->post() ? $this->input->post('name_2') : '';
    $ret['lastname_2'] = $this->input->post() ? $this->input->post('lastname_2') : '';
    $ret['dir1_2'] = $this->input->post() ? $this->input->post('dir1_2') : '';
    $ret['dir2_2'] = $this->input->post() ? $this->input->post('dir2_2') : '';
    $ret['city_2'] = $this->input->post() ? $this->input->post('city_2') : '';
    $ret['cp_2'] = $this->input->post() ? $this->input->post('cp_2') : '';
    $ret['id_country_2'] = $this->input->post() ? $this->input->post('id_country_2') : '';
    $ret['mail_2'] = $this->input->post() ? $this->input->post('mail_2') : '';
    return $ret;
  }

}