<?php

class IndexModel extends AppModel {

  function __construct()
  {
    parent::__construct();
    $this->table = "product";    
  }
  
  public function ListItems()
  {
    $where = $this->ListWhere(true);
    $init = $this->input->post('iDisplayStart') ? $this->input->post('iDisplayStart') : 0;
    $perpage = $this->input->post('iDisplayLength') ? $this->input->post('iDisplayLength') : 10;
    $orderby = $this->input->post('filter-sort-column') ? $this->input->post('filter-sort-column') : $this->mconfig['order-column'];
    $ascdesc = $this->input->post('filter-sort-type') ? $this->input->post('filter-sort-type') : $this->mconfig['order-type'];
    $sql = "SELECT t.id_product as id, t.*,
    lj0.file as fm1file, lj0.id_type as fm1type, lj0.name as fm1name,
    (select SUM(stock) from product_stock where id_product = t.id_product) as stock,
    lj1.category as category,
    lj2.sub as sub,
    lj3.sub2 as sub2,
    lj4.brand as brand,
    lj5.state as state, 
    (select count(*) as total from nz_gallery_file gf where gf.id_gallery  = t.id_gallery) as fmg1    
    FROM {$this->table} as t    
    LEFT JOIN nz_file lj0 on t.id_file = lj0.id_file      
    LEFT JOIN product_category lj1 on t.id_category = lj1.id_category      
    LEFT JOIN product_sub lj2 on t.id_sub = lj2.id_sub      
    LEFT JOIN product_sub2 lj3 on t.id_sub2 = lj3.id_sub2      
    LEFT JOIN brand lj4 on t.id_brand = lj4.id_brand      
    LEFT JOIN product_state lj5 on t.id_state = lj5.id_state      
    WHERE $where ";
    
    #$sql .= "ORDER BY `{$orderby}` {$ascdesc} "
    $sql .= "LIMIT {$init}, {$perpage}";

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
    if($this->input->post('filter-id_category'))
      $sql .= " AND t.id_category = '". $this->input->post('filter-id_category') ."'";
    if($this->input->post('filter-id_sub'))
      $sql .= " AND t.id_sub = '". $this->input->post('filter-id_sub') ."'";
    if($this->input->post('filter-id_sub2'))
      $sql .= " AND t.id_sub2 = '". $this->input->post('filter-id_sub2') ."'";
    if($this->input->post('filter-id_brand'))
      $sql .= " AND t.id_brand = '". $this->input->post('filter-id_brand') ."'";
    if($this->input->post('filter-reduction'))
      $sql .= " AND t.reduction = '1'";
    if($this->input->post('filter-id_state'))
      $sql .= " AND t.id_state = '". $this->input->post('filter-id_state') ."'";
    if($this->input->post('filter-id_gallery'))
      $sql .= " AND t.id_gallery = '". $this->input->post('filter-id_gallery') ."'";
    if($text)
      $sql .= " AND ( t.code like '%{$text}%'  OR  t.name like '%{$text}%'  OR  t.description like '%{$text}%'  OR  t.details like '%{$text}%'  OR  t.dimensions like '%{$text}%'  OR  t.weight like '%{$text}%'  OR t.id_product = '{$text}') ";   
    if($this->input->post('filter-id'))
      $sql .= " AND t.id_product = '". $this->input->post('filter-id') ."'";  
    if($this->input->post('filter-active'))
      $sql = " AND t.active = '1'";
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
      'SelectProductState' => $this->Data->SelectProductState('', $this->lang->line('Selecciona una opción')),      
      'SelectCollection' => $this->Data->SelectCollection('', $this->lang->line('Selecciona una opción')),      
      'SelectProductCares' => $this->Data->SelectProductCares('', $this->lang->line('Selecciona una opción')),      
    );
  }
  
  public function ValidationRules()
  {
    return array(
      array(
       'field'   => 'id_file', 
       'label'   => $this->lang->line('Miniatura'), 
       'rules'   => 'trim'
      ),
      array(
       'field'   => 'code', 
       'label'   => $this->lang->line('Código'), 
       'rules'   => 'trim'
      ),
      array(
       'field'   => 'name', 
       'label'   => $this->lang->line('Nombre'), 
       'rules'   => 'trim'
      ),
      array(
       'field'   => 'description', 
       'label'   => $this->lang->line('Descripión'), 
       'rules'   => 'trim'
      ),
      array(
       'field'   => 'id_category', 
       'label'   => $this->lang->line('Deparamento'), 
       'rules'   => 'trim|numeric'
      ),
      array(
       'field'   => 'id_sub', 
       'label'   => $this->lang->line('Categoría'), 
       'rules'   => 'trim|numeric'
      ),
      array(
       'field'   => 'id_sub2', 
       'label'   => $this->lang->line('Subcategoría'), 
       'rules'   => 'trim|numeric'
      ),
      array(
       'field'   => 'id_brand', 
       'label'   => $this->lang->line('Marca'), 
       'rules'   => 'trim|numeric'
      ),
      array(
       'field'   => 'id_collection', 
       'label'   => $this->lang->line('Colección'), 
       'rules'   => 'trim|numeric'
      ),
      array(
       'field'   => 'details', 
       'label'   => $this->lang->line('Detalles'), 
       'rules'   => 'trim'
      ),
      array(
       'field'   => 'sizes', 
       'label'   => $this->lang->line('Tallas'), 
       'rules'   => 'trim'
      ),
      array(
       'field'   => 'dimensions', 
       'label'   => $this->lang->line('Dimensiones'), 
       'rules'   => 'trim'
      ),
      array(
       'field'   => 'weight', 
       'label'   => $this->lang->line('Peso'), 
       'rules'   => 'trim'
      ),
      array(
       'field'   => 'cost', 
       'label'   => $this->lang->line('Precio'), 
       'rules'   => 'trim|numeric'
      ),
      array(
       'field'   => 'cost2', 
       'label'   => $this->lang->line('Precio Antiguo'), 
       'rules'   => 'trim|numeric'
      ),
      array(
       'field'   => 'active', 
       'label'   => $this->lang->line('Activo'), 
       'rules'   => 'trim'
      ),
      array(
       'field'   => 'highlight', 
       'label'   => $this->lang->line('Destacado'), 
       'rules'   => 'trim'
      ),
      array(
       'field'   => 'id_state', 
       'label'   => $this->lang->line('Disponibilidad'), 
       'rules'   => 'trim|numeric'
      ),
      array(
       'field'   => 'votes', 
       'label'   => $this->lang->line('Votos'), 
       'rules'   => 'trim|numeric'
      ),
      array(
       'field'   => 'rating', 
       'label'   => $this->lang->line('Rating'), 
       'rules'   => 'trim|numeric'
      ),
      array(
       'field'   => 'id_gallery', 
       'label'   => $this->lang->line('Imágenes'), 
       'rules'   => 'trim'
      ),
    );
  }
  
  public function Name( $id = 0 )
  {
    $id = $id ? $id : $this->id;
    $sql = "SELECT name as `name`
    FROM {$this->table}

    WHERE id_product = '{$id}'";
    $query = $this->db->query($sql);
    $row = $query->row();
    return clean_title($row->name);
  }
  
  public function Duplicate( $id = 0 )
  {    
    $sql = "select * from {$this->table} where id_product = '{$id}'";
    $row = $this->db->query($sql)->row_array();  
    if(!$row) return false;
    unset($row['id_product']);    
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
      'id_file' => $this->input->post('id_file'),
      'id_file_2' => $this->input->post('id_file_2'),
      'code' => $this->input->post('code'),
      'name' => $this->input->post('name'),
      'description' => $this->input->post('description'),
      'details' => $this->input->post('details'),
      'id_category' => $this->input->post('id_category'),
      'id_sub' => $this->input->post('id_sub'),
      'id_sub2' => $this->input->post('id_sub2'),
      'id_brand' => $this->input->post('id_brand'),      
      'id_collection' => $this->input->post('id_collection'),          
      'cost' => $this->input->post('cost'),
      'cost2' => $this->input->post('cost2'),
      'sizes' => rtrim($this->input->post('sizes') , ',') ? str_replace(' ', '', rtrim($this->input->post('sizes') , ',') . ',') : '',
      'active' => $this->input->post('active') ? 1 : 0,
      'highlight' => $this->input->post('highlight') ? 1 : 0,
      'reduction' => $this->input->post('reduction') ? 1 : 0,
      'id_state' => $this->input->post('id_state'),
      'id_gallery' => $this->input->post('id_gallery'),
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
      $sql = $this->db->update_string($this->table, $data, "id_product = '{$this->id}'" );
    else
      $sql = $this->db->insert_string($this->table, $data );
    $this->db->query($sql); 
    $this->id = $this->id ? $this->id : $this->db->insert_id();
    $sql = "delete from product_color_assign where id_product = '{$this->id}'";
    $this->db->query($sql); 
    $colors = $this->input->post('colors') ? explode(',', $this->input->post('colors')) : array();
    foreach($colors as $color)
    {
      $sql = $this->db->insert_string('product_color_assign', array( 'id_product' => $this->id, 'id_color' => $color ));
      $this->db->query($sql); 
    }
    /*$sql = "delete from product_stock where id_product = '{$this->id}'";
    $this->db->query($sql); 
    $stock = $this->input->post('stock') ? $this->input->post('stock') : array();
    foreach($stock as $key => $s)
    {
      $s = abs(round($s));
      if(!$s) break;
      $sql = $this->db->insert_string('product_stock', array( 'id_product' => $this->id, 'id_store' => $key, 'stock' => $s ));
      $this->db->query($sql); 
    }
    $this->CheckStock($this->id);*/


    $sql = "delete from product_care_item where id_product = '{$this->id}'";
    $this->db->query($sql); 
    $cares = $this->input->post('cares') ? $this->input->post('cares') : array();
    foreach($cares as $index => $care)
    {
      $sql = $this->db->insert_string('product_care_item', array( 'id_product' => $this->id, 'id_care' => $care, 'num' => $index ));
      $this->db->query($sql); 
    }
    return $this->id;
  }

  public function ListCares()
  {
    $sql = "SELECT p.id_care as id, p.name
    from product_care_item pc
    left join product_care p on p.id_care = pc.id_care
    where pc.id_product = '{$this->id}'
    ORDER by pc.num";
    return $this->db->query($sql)->result();
  }  
  
  public function CheckStock( $id = 0 )
  {
    $sql = "select SUM(stock) as total from product_stock where id_product = '{$id}'";
    $total = $this->db->query($sql)->row()->total;
    $data = $this->DataElement($id, true);
    if($total)
    {
      if($data['id_state'] == 1) return;
      $sql = $this->db->update_string($this->table, array('id_state' => 1), "id_product = '{$id}'" );
      return $this->db->query($sql); 
    }
    if($data['id_state'] > 1) return;
    $sql = $this->db->update_string($this->table, array('id_state' => 2), "id_product = '{$id}'" );
    $this->db->query($sql); 
  }  
    
  public function ListColors()
  {
    $sql = "SELECT pc.id_color as id, pc.color, pc.value, pa.id_color as selected
    from product_color pc
    left join product_color_assign pa on pc.id_color = pa.id_color and pa.id_product = {$this->id}
    ORDER by pc.color";
    return $this->db->query($sql)->result();
  }  
    
  public function ListStores()
  {
    $sql = "SELECT ps.id_store as id, ps.store, ps.code, pa.stock, ps.active
    from store ps
    left join product_stock pa on ps.id_store = pa.id_store and pa.id_product = {$this->id}
    ORDER by ps.active desc, ps.code asc";
    return $this->db->query($sql)->result();
  }  
  
  public function Delete( $id = 0 )
  {
    if(!$this->MApp->secure->delete) return false;
    $sql = "DELETE FROM {$this->table}
    WHERE id_product = '{$id}'";
    $this->db->query($sql);
    $this->MApp->DeleteGallery($data['id_gallery']);
    return true;
  }
    
  public function DataElement( $id = 0, $null = false)
  {
    $ret = array();
    if($id)
    {
      $sql = "SELECT t.id_product as id, t.*,
      lj0.file as fm1file, lj0.id_type as fm1type, lj0.name as fm1name,
      ljx.file as fm2file, ljx.id_type as fm2type, ljx.name as fm2name,
      lj1.category as category,
      lj2.sub as sub,
      lj3.sub2 as sub2,
      lj4.brand as brand,
      lj5.state as state      
      FROM {$this->table} as t      
      LEFT JOIN nz_file lj0 on t.id_file = lj0.id_file      
      LEFT JOIN nz_file ljx on t.id_file_2 = ljx.id_file      
      LEFT JOIN product_category lj1 on t.id_category = lj1.id_category       
      LEFT JOIN product_sub lj2 on t.id_sub = lj2.id_sub       
      LEFT JOIN product_sub2 lj3 on t.id_sub2 = lj3.id_sub2       
      LEFT JOIN brand lj4 on t.id_brand = lj4.id_brand       
      LEFT JOIN product_state lj5 on t.id_state = lj5.id_state       
      WHERE t.id_product = '{$id}' 
      LIMIT 0, 1";
      $ret = $this->db->query($sql)->row_array();
      if($ret) return $ret;
      if($null) return false;
    }    
    $ret['id_file'] = $this->input->post() ? $this->input->post('id_file') : '';
    $ret['id_file_2'] = $this->input->post() ? $this->input->post('id_file_2') : '';
    $ret['code'] = $this->input->post() ? $this->input->post('code') : '';
    $ret['name'] = $this->input->post() ? $this->input->post('name') : '';
    $ret['description'] = $this->input->post() ? $this->input->post('description') : '';
    $ret['id_category'] = $this->input->post() ? $this->input->post('id_category') : '';
    $ret['id_sub'] = $this->input->post() ? $this->input->post('id_sub') : '';
    $ret['id_sub2'] = $this->input->post() ? $this->input->post('id_sub2') : '';
    $ret['id_brand'] = $this->input->post() ? $this->input->post('id_brand') : '';
    $ret['id_collection'] = $this->input->post() ? $this->input->post('id_collection') : '';
    $ret['details'] = $this->input->post() ? $this->input->post('details') : '';
    $ret['dimensions'] = $this->input->post() ? $this->input->post('dimensions') : '';
    $ret['sizes'] = $this->input->post() ? $this->input->post('sizes') : '';
    $ret['weight'] = $this->input->post() ? $this->input->post('weight') : '';
    $ret['cost'] = $this->input->post() ? $this->input->post('cost') : "0.00";
    $ret['cost2'] = $this->input->post() ? $this->input->post('cost2') : "0.00";
    $ret['sales'] = $this->input->post('sales') ? 1 : 0;
    $ret['active'] = $this->input->post('active') ? 1 : 0;
    $ret['highlight'] = $this->input->post('highlight') ? 1 : 0;
    $ret['reduction'] = $this->input->post('reduction') ? 1 : 0;
    $ret['id_state'] = $this->input->post() ? $this->input->post('id_state') : '';
    $ret['votes'] = $this->input->post() ? $this->input->post('votes') : '';
    $ret['rating'] = $this->input->post() ? $this->input->post('rating') : 1;
    $ret['id_gallery'] = $this->input->post() ? $this->input->post('id_gallery') : '';
    return $ret;
  }

}