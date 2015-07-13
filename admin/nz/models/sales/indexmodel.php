<?php

class IndexModel extends AppModel {

  function __construct()
  {
    parent::__construct();
    $this->table = "cart";    
  }
  
  public function ListItems()
  {
    $where = $this->ListWhere(true);
    $init = $this->input->post('iDisplayStart') ? $this->input->post('iDisplayStart') : 0;
    $perpage = $this->input->post('iDisplayLength') ? $this->input->post('iDisplayLength') : 10;
    $orderby = $this->input->post('filter-sort-column') ? $this->input->post('filter-sort-column') : $this->mconfig['order-column'];
    $ascdesc = $this->input->post('filter-sort-type') ? $this->input->post('filter-sort-type') : $this->mconfig['order-type'];
    $sql = "SELECT t.id_cart as id, t.*,
    lj0.mail as user,
    lj1.state as state,
    lj2.shipping as shipping,
    lj3.store as store,
    lj4.payment as payment    
    FROM {$this->table} as t    
    LEFT JOIN user lj0 on t.id_user = lj0.id_user      
    LEFT JOIN cart_state lj1 on t.id_state = lj1.id_state      
    LEFT JOIN cart_shipping lj2 on t.id_shipping = lj2.id_shipping      
    LEFT JOIN store lj3 on t.id_store = lj3.id_store      
    LEFT JOIN cart_payment lj4 on t.id_payment = lj4.id_payment      
    WHERE $where 
    ORDER BY `{$orderby}` {$ascdesc} LIMIT {$init}, {$perpage}";
    return $this->db->query($sql)->result();
  }  
  
  public function ListTotal($filter = false)
  {
    $where = $this->ListWhere($filter);
    $sql = "SELECT count(*) as total 
    FROM {$this->table} as t    
    LEFT JOIN user lj0 on t.id_user = lj0.id_user     
    LEFT JOIN cart_state lj1 on t.id_state = lj1.id_state     
    LEFT JOIN cart_shipping lj2 on t.id_shipping = lj2.id_shipping     
    LEFT JOIN store lj3 on t.id_store = lj3.id_store     
    LEFT JOIN cart_payment lj4 on t.id_payment = lj4.id_payment 
    WHERE $where";
    return $this->db->query($sql)->row()->total;
  }
  
  private function ListWhere($filter = false)
  {
    $sql = "1";
    $sql .= " AND t.id_state > 1 ";
    if(!$filter) 
      return $sql;  
    $text = $this->input->post('filter-text') ? $this->input->post('filter-text') : false;          
    if(!$text)      
      $text = $this->input->post('sSearch') ? $this->input->post('sSearch') : false;
    if($this->input->post('filter-id_shipping'))
      $sql .= " AND t.id_shipping = '". $this->input->post('filter-id_shipping') ."'";
    if($this->input->post('filter-id_store'))
      $sql .= " AND t.id_store = '". $this->input->post('filter-id_store') ."'";
    if($this->input->post('filter-id_payment'))
      $sql .= " AND t.id_payment = '". $this->input->post('filter-id_payment') ."'";
    if($this->input->post('filter-id_state'))
      $sql .= " AND t.id_state = '". $this->input->post('filter-id_state') ."'";
    if($this->input->post('filter-date1'))
    {
      $sql .= " AND date(t.modified) >= '". human_to_mysql($this->input->post('filter-date1')) ."'";
    }
    if($this->input->post('filter-date2'))
    {
      $sql .= " AND date(t.modified) <= '". human_to_mysql($this->input->post('filter-date2')) ."'";
    }
    if($text)
      $sql .= " AND ( t.comments like '%{$text}%'  OR  lj0.mail like '%{$text}%'  OR  t.data like '%{$text}%'  OR  t.coupon_1 like '%{$text}%'  OR  t.coupon_2 like '%{$text}%'  OR t.id_cart = '{$text}') ";   
    if($this->input->post('filter-id'))
      $sql .= " AND t.id_cart = '". $this->input->post('filter-id') ."'";  
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
      'SelectUser' => $this->Data->SelectUser('', $this->lang->line('Selecciona una opción')),
      'SelectCartState' => $this->Data->SelectCartState('', $this->lang->line('Selecciona una opción')),
      'SelectCartShipping' => $this->Data->SelectCartShipping('', $this->lang->line('Selecciona una opción')),
      'SelectStore' => $this->Data->SelectStore('', $this->lang->line('Selecciona una opción')),
      'SelectCartPayment' => $this->Data->SelectCartPayment('', $this->lang->line('Selecciona una opción')),      
    );
  }
  
  public function ValidationRules()
  {
    return array(
      array(
       'field'   => 'id_user', 
       'label'   => $this->lang->line('Usuario'), 
       'rules'   => 'trim|numeric'
      ),
      array(
       'field'   => 'id_state', 
       'label'   => $this->lang->line('Estado'), 
       'rules'   => 'trim|numeric'
      ),
      array(
       'field'   => 'created', 
       'label'   => $this->lang->line('Fecha creación'), 
       'rules'   => 'trim'
      ),
      array(
       'field'   => 'modified', 
       'label'   => $this->lang->line('Fecha modificación'), 
       'rules'   => 'trim'
      ),
      array(
       'field'   => 'id_shipping', 
       'label'   => $this->lang->line('Transporte'), 
       'rules'   => 'trim|numeric'
      ),
      array(
       'field'   => 'id_store', 
       'label'   => $this->lang->line('Tienda'), 
       'rules'   => 'trim|numeric'
      ),
      array(
       'field'   => 'id_payment', 
       'label'   => $this->lang->line('Forma de pago'), 
       'rules'   => 'trim|numeric'
      ),
      array(
       'field'   => 'comments', 
       'label'   => $this->lang->line('Comentarios'), 
       'rules'   => 'trim'
      ),
      array(
       'field'   => 'data', 
       'label'   => $this->lang->line('Data'), 
       'rules'   => 'trim'
      ),
      array(
       'field'   => 'coupon_1', 
       'label'   => $this->lang->line('Descuento 1'), 
       'rules'   => 'trim'
      ),
      array(
       'field'   => 'coupon_2', 
       'label'   => $this->lang->line('Descuento 2'), 
       'rules'   => 'trim'
      ),
      array(
       'field'   => 'subtotal', 
       'label'   => $this->lang->line('Subtotal'), 
       'rules'   => 'trim|numeric'
      ),
      array(
       'field'   => 'shipping', 
       'label'   => $this->lang->line('Portes'), 
       'rules'   => 'trim|numeric'
      ),
      array(
       'field'   => 'tax', 
       'label'   => $this->lang->line('TAX'), 
       'rules'   => 'trim|numeric'
      ),
      array(
       'field'   => 'desc1', 
       'label'   => $this->lang->line('Descuento 1'), 
       'rules'   => 'trim|numeric'
      ),
      array(
       'field'   => 'desc2', 
       'label'   => $this->lang->line('Descuento 2'), 
       'rules'   => 'trim|numeric'
      ),
      array(
       'field'   => 'total', 
       'label'   => $this->lang->line('Total'), 
       'rules'   => 'trim|numeric'
      ),
    );
  }
  
  public function Name( $id = 0 )
  {
    $id = $id ? $id : $this->id;
    $sql = "SELECT id_cart as `name`
    FROM {$this->table}
    WHERE id_cart = '{$id}'";
    $query = $this->db->query($sql);
    $row = $query->row();
    return clean_title(str_pad($row->name, 6, "0", STR_PAD_LEFT));
  }
  
  public function Duplicate( $id = 0 )
  {    
    $sql = "select * from {$this->table} where id_cart = '{$id}'";
    $row = $this->db->query($sql)->row_array();  
    if(!$row) return false;
    unset($row['id_cart']);    
        
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
      'id_shipping' => $this->input->post('id_shipping'),
      'id_store' => $this->input->post('id_store'),
      'id_payment' => $this->input->post('id_payment'),
      'comments' => $this->input->post('comments'),
    );
    if( $this->id )
      $sql = $this->db->update_string($this->table, $data, "id_cart = '{$this->id}'" );
    else
      $sql = $this->db->insert_string($this->table, $data );
    $this->db->query($sql); 
    return $this->id ? $this->id : $this->db->insert_id();
  }
  
  public function prep_cost( $cost = 0, $currency = true, $ivi = true )
  {
    return ($currency ? "¢ " : "") . number_format(round($cost, 2), 2, ',', '.') . ($ivi ? " i.v.i." : "");
  } 
  
  public function GetCoupon( $code = '' )
  {
    $sql = "select * from coupon where code = '{$code}'";
    return $this->db->query($sql)->row();
  }
  
  public function ProductColors( $id = 0 )
  {
    $sql = "SELECT pc.id_color as id, pc.color, pc.value, pa.id_color as selected
    from product_color_assign pa
    left join product_color pc on pc.id_color = pa.id_color 
    where pa.id_product = '{$id}' and pc.id_color is not null
    ORDER by pc.color";
    return $this->db->query($sql)->result();
  }
  
  public function ListItemsCart()
  {
    if( !$this->id ) 
      return array();
    $sql = "select ci.id_item as iditem, n.id_product as id, ci.id_color, n.id_state, n.name, ps.state as state,
    n.code, ci.cost as cost, n.dimensions,n.weight, n.description, f.file, ci.items, pc.color, pc.value as cvalue
    from cart_item ci
    left join product n on n.id_product = ci.id_product
    left join product_color pc on pc.id_color = ci.id_color
    left join product_state ps on ps.id_state = n.id_state
    left join nz_file f on f.id_file = n.id_file
    where 
    ci.id_cart = '{$this->id}' AND
    n.active = '1'
    order by ci.id_item asc";
    return $this->db->query($sql)->result();
  }
  
  public function Delete( $id = 0 )
  {
    if(!$this->MApp->secure->delete) return false;
    $sql = "DELETE FROM {$this->table}
    WHERE id_cart = '{$id}'";
    $this->db->query($sql);
    return true;
  }
    
  public function DataElement( $id = 0, $null = false)
  {
    $ret = array();
    if($id)
    {
      $sql = "SELECT t.id_cart as id, t.*,
      lj0.mail as user,
      lj1.state as state,
      lj2.shipping as shipping,
      lj3.store as store,
      lj4.payment as payment      
      FROM {$this->table} as t      
      LEFT JOIN user lj0 on t.id_user = lj0.id_user       
      LEFT JOIN cart_state lj1 on t.id_state = lj1.id_state       
      LEFT JOIN cart_shipping lj2 on t.id_shipping = lj2.id_shipping       
      LEFT JOIN store lj3 on t.id_store = lj3.id_store       
      LEFT JOIN cart_payment lj4 on t.id_payment = lj4.id_payment       
      WHERE t.id_cart = '{$id}' 
      LIMIT 0, 1";
      $ret = $this->db->query($sql)->row_array();
      if($ret) return $ret;
      if($null) return false;
    }    
    $ret['id_user'] = $this->input->post() ? $this->input->post('id_user') : '';
    $ret['id_state'] = $this->input->post() ? $this->input->post('id_state') : '';
    $ret['created'] = $this->input->post() ? $this->input->post('created') : '';
    $ret['modified'] = $this->input->post() ? $this->input->post('modified') : '';
    $ret['id_shipping'] = $this->input->post() ? $this->input->post('id_shipping') : '';
    $ret['id_store'] = $this->input->post() ? $this->input->post('id_store') : '';
    $ret['id_payment'] = $this->input->post() ? $this->input->post('id_payment') : '';
    $ret['comments'] = $this->input->post() ? $this->input->post('comments') : '';
    $ret['data'] = $this->input->post() ? $this->input->post('data') : '';
    $ret['coupon_1'] = $this->input->post() ? $this->input->post('coupon_1') : '';
    $ret['coupon_2'] = $this->input->post() ? $this->input->post('coupon_2') : '';
    $ret['subtotal'] = $this->input->post() ? $this->input->post('subtotal') : '';
    $ret['shipping'] = $this->input->post() ? $this->input->post('shipping') : '';
    $ret['tax'] = $this->input->post() ? $this->input->post('tax') : '';
    $ret['desc1'] = $this->input->post() ? $this->input->post('desc1') : '';
    $ret['desc2'] = $this->input->post() ? $this->input->post('desc2') : '';
    $ret['total'] = $this->input->post() ? $this->input->post('total') : '';
    return $ret;
  }

}