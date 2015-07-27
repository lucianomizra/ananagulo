<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class CartModel extends CI_Model
{
  public 
    $idu = 0,
    $id = 0;
    
  public function GetCart()
  {
    if( $this->session->userdata('cartId') )
    {
      return $this->id = $this->session->userdata('cartId');
    }
    $this->id = $this->Create();    
    $this->session->set_userdata('cartId', $this->id);
    return $this->id;
  }
  
  public function BasicDataCart()
  {
    $ret = array(
      'name' => '' , 'lastname' => '' , 'mail' => '' , 'cel' => '','city' => '',
      'dir1' => '' , 'cp' => '' , 'dni' => '' , 
    );
    if($this->idu)
    {
      $user = $this->UserM->DataUser($this->idu);
      if($user)
      {
        foreach($ret as $key => $value)
        {
          $ret[$key] = $user->$key;
        }
      }
    }
    $ret['password'] = '';
    $ret['password2'] = '';
    $ret['newsletter'] = 1;
    $ret['dextra'] = 1;
    $ret['privacy'] = 0;
    return $ret;
  }
  
  public function DataJsonCart( $cart = 0 )
  {
    $cart = $this->Cart->DataCart($cart);
    if(!count($cart))
    {
      $this->session->unset_userdata('cartId');
      $cart = $this->GetCart();
      $cart = $this->Cart->DataCart($cart);
    }      
    if($cart->data)
      $fdata = (array)json_decode($cart->data);
    else
      $fdata = $this->Cart->BasicDataCart();
    return $fdata;
  }
  
  public function GetCarts()
  {
    $sql = "select c.*, s.state from cart c
    
    LEFT JOIN cart_state s on c.id_state = s.id_state   
    where c.id_state > 1 and c.id_user = '{$this->idu}' 
    
    order by c.modified desc";
    return $this->db->query($sql)->result();
  }
  
  public function GetMaxCode()
  {
    $sql = "select MAX(code) as max from cart";
    $row = $this->db->query($sql)->row();
    if($row && $row->max)
    {
      return round($row->max)+1;
    }
    return 1;
  }

  public function DataCart( $cart = 0 )
  {
    $sql = "select * from cart where id_cart = '{$cart}'";
    $cart = $this->db->query($sql)->row();
    if(!$cart)
    {
      $this->session->unset_userdata('cartId');
      return $this->DataCart($this->GetCart());
    }
    return $cart;
  }
  
  public function DataCartComplete( $cart = 0 )
  {
    $sql = "select c.*, cp.payment, cp.comments as paymentcomments, cs.shipping, cs.cost as shippingcost
    from cart c
    left join cart_payment cp on cp.id_payment = c.id_payment
    left join cart_shipping cs on cs.id_shipping = c.id_shipping
    where c.id_cart = '{$cart}'";
    return $this->db->query($sql)->row();
  }
  
  function EndCart()
  {
    $sql = $this->db->update_string('cart', array('id_state' => 3, 'id_user' => $this->idu, 'modified' => date('Y-m-d H:i:s')) ,  "id_cart = '{$this->id}' AND id_user = '{$this->idu}'");
    $this->db->query($sql);
    $sql = $this->db->update_string('user', array('id_cart_active' => 0) ,  "id_user = '{$this->idu}'");
    $this->db->query($sql);
    file_get_contents( base_url() . 'admin/sales/noficationsale/' . $this->id );
    $items = $this->ListItems();
    foreach($items as $item)
    {
      if(!$item->active) continue;
      $sql = "update product set sales = sales + '{$item->items}' where id_product = '{$item->id}'";
      $this->db->query($sql);
    }
    $this->session->unset_userdata('cartId');
    $this->session->set_userdata('cartEnd', $this->id);
  }
  
  function SaveCartData( $data = array() )
  {
    $sql = $this->db->update_string('cart', $data,  "id_cart = '{$this->id}'");
    $this->db->query($sql);
  }
  
  public function CheckItemsCart()
  {
    $sql = "select ca.*, p.active as statep 
    from cart_item ca
    left join product p on p.id_product = ca.id_product
    where id_cart = '{$this->id}' order by ca.id_product, ca.id_color";
    $result = $this->db->query($sql)->result();
    $product = 0;
    $color = 0;
    foreach($result as $row)
    {
      if($row->statep != 1)
      {
        $this->RemoveItem($row->id_item);
      }
      else
      {
        if( $product == $row->id_product && $color == $row->id_color)
        {
          $this->RemoveItem($row->id_item);
        }
        $product = $row->id_product;
        $color = $row->id_color;
      }
    }
  }
  
  public function UpdateCartUser()
  {
    if(!$this->idu) return false;
    $sql = "update cart set id_user = '{$this->idu}' where id_cart = '{$this->id}'";
    $this->db->query($sql);
  }
  
  public function SaveCartJsonData( $data = array() )
  {
    if(!$this->idu) return false;
    $json = json_encode($data);
    $sql = $this->db->update_string('cart', array('data' => $json), "id_cart = '{$this->id}'");
    $this->db->query($sql);
  }
  
  public function JoinCarts()
  {
    if(!$this->idu) return false;
    $sql = "update cart_item set id_cart = '{$this->id}' where id_cart in (select id_cart from cart where id_user = '{$this->idu}' and id_state = '1') ";
    $this->db->query($sql);
    $sql = "delete from cart where id_user = '{$this->idu}' and id_state = '1' and id_cart != '{$this->id}' ";
    $this->db->query($sql);
    $this->CheckItemsCart();
    return true;
  }
  
  public function Create()
  {
    $data = array(
      'created' => date('Y-m-d H:i:s'),
      'id_state' => 1
    );
    if( $this->idu )
      $data['id_user'] = $this->idu;
    $sql = $this->db->insert_string('cart', $data);
    $this->db->query($sql);
    return $this->db->insert_id();
  }
  
  public function ItemExistsId( $product = 0, $color = 0, $checkcolor = true )
  {
    if( $checkcolor )
      $sql = "select ci.id_item from cart_item ci where ci.id_cart = '{$this->id}' and ci.id_product = '{$product}' and ci.id_color = '{$color}'";
    else
      $sql = "select ci.id_item from cart_item ci where ci.id_cart = '{$this->id}' and ci.id_product = '{$product}'";
    $row = $this->db->query($sql)->row();
    return $row ? $row->id_item : 0;
  }
  
  public function ItemExists( $product = 0, $color = 0, $checkcolor = true )
  {
    if( $checkcolor )
      $sql = "select count(*) as total from cart_item ci where ci.id_cart = '{$this->id}' and ci.id_product = '{$product}' and ci.id_color = '{$color}'";
    else
      $sql = "select count(*) as total from cart_item ci where ci.id_cart = '{$this->id}' and ci.id_product = '{$product}'";
    return ($this->db->query($sql)->row()->total>0);
  }
  
  public function RefreshCartTotals()
  {
    $data = array();
    $subtotal =  0; 
    $shipping =  4.99; 
    $items = $this->ListItems();
    foreach($items as $item)
    {
      $active = 0;
      if( $item->id_state == 1 )
      {
        $subtotal += $item->cost * round($item->items);
        $active = 1;
      }
      $sql = "update cart_item set active = '{$active}' where id_item = '{$item->iditem}'";
      $this->db->query($sql);
    }
    $data['subtotal'] = $subtotal;
    $data['shipping'] = $shipping;
    #$data['tax'] = $subtotal * round($this->Data->ProjectConfig('tax-percent'), 2) / 100;
    $data['tax'] = 0;
    $desc1 = 0; 
    $desc2 = 0; 
    $total = $subtotal + $data['tax'];
    $cart = $this->DataCart($this->id); 
    if(!$cart) return;
    if($cart->coupon_1)
    {
      $c1 = $this->Data->GetCoupon($cart->coupon_1, 1);
      if($c1) $desc1 = $total * round($c1->value, 2) / 100; 
    }
    /*if($cart->coupon_2)
    {
      $c2 = $this->Data->GetCoupon($cart->coupon_2, 2);
      if($c2)
        $desc2 = $total * round($c2->value, 2) / 100;
    }  */  
    $data['desc1'] = $desc1;
    $data['desc2'] = $desc2;
    $data['total'] = $total - $desc1 - $desc2;
    $data['tax'] = $data['total']  * .21 / 1.21;
    $data['subtotal'] = $data['total']  / 1.21;
    $this->SaveCartData($data);
  }
  
  public function RemoveWeddingsItems()
  {
    if( !$this->id ) 
      return;
    $sql = "delete ci from cart_item ci left join 
    product p on p.id_product = ci.id_product
    where ci.id_cart = '{$this->id}' and p.id_category = '9'";
    return $this->db->query($sql);
  }
  
  public function RemoveItem( $iditem = 0 )
  {
    if( !$this->id ) 
      return;
    $sql = "delete from cart_item where id_item = '{$iditem}' and id_cart = '{$this->id}'";
    return $this->db->query($sql);
  }
  
  public function ChangeColor( $iditem = 0, $color = 0 )
  {
    if( !$this->id ) return false;
    $item = $this->GetItem($iditem);
    if(!$item) return false;
    if($item->id_color  == $color) return true;    
    if( $this->ItemExists($item->id_product, $color) )
    {
      $this->RemoveItem($iditem);
      return false;
    }
    if( !$this->ProductColor( $item->id_product, $color) ) 
      return false;
    $sql = "update cart_item set id_color = '{$color}' where id_item = '{$iditem}' and id_cart = '{$this->id}'";
    $this->db->query($sql);
    return true;
  }
  
  public function ChangeSize( $iditem = 0, $size = 0 )
  {
    $sql = "update cart_item set size = '{$size}' where id_item = '{$iditem}' and id_cart = '{$this->id}'";
    $this->db->query($sql);
    return true;
  }
  
  public function ItemsItem( $iditem = 0, $count = 1 )
  {
    if( !$this->id ) 
      return;
    $sql = "update cart_item set items = '{$count}' where id_item = '{$iditem}' and id_cart = '{$this->id}'";
    return $this->db->query($sql);
  }

  public function LessItem( $iditem = 0 )
  {
    if( !$this->id ) 
      return;
    $sql = "update cart_item set items = IF(items - 1<1,1,items-1) where id_item = '{$iditem}' and id_cart = '{$this->id}'";
    return $this->db->query($sql);
  }
  
  public function MoreItem( $iditem = 0 )
  {
    if( !$this->id ) 
      return;
    $sql = "update cart_item set items = IF(items + 1>100,100,items+1) where id_item = '{$iditem}' and id_cart = '{$this->id}'";
    return $this->db->query($sql);
  }
  
  public function AddItem( $product = 0, $items = 1, $color = 0, $size = '' )
  {
    if( !$this->id ) $this->GetCart();
    $info = $this->ProductInfo($product);
    if(!$info) return false;
    if( $color )
    {
      if( !$this->ProductColor( $product, $color) ) 
        $color = 0;
    }    
    if( !$color )
      $color = $this->ProductFirstColor( $product );
    $items = round($items);
    if( $items < 1 ) $items = 1;
    if( $items > 100 ) $items = 100;
    if( $itemret = $this->ItemExistsId($product, $color) )
    {
      $sql = "update cart_item ci 
      set ci.items = '{$items}', ci.cost = '{$info->cost}'
      where ci.id_cart = '{$this->id}' and ci.id_product = '{$product}' and ci.id_color = '{$color}'";
      $this->db->query($sql);
      return $itemret;
    }    
    $sql = $this->db->insert_string('cart_item', array(
      'id_cart' => $this->id,
      'id_product' => $product,
      'id_color' => $color,
      'items' => $items,
      'size' => $size,
      'cost' => $info->cost
    ));
    $this->db->query($sql);
    return $this->db->insert_id();
  }
  
  function ProductInfo( $id = 0 )
  {
    $sql = "select * from product p where p.active = '1' and p.id_product = '{$id}'";
    return $this->db->query($sql)->row();
  }
  
  function ProductColor( $id = 0, $color = 0 )
  {
    $sql = "select count(*) as total from product_color_assign p where p.id_product = '{$id}' and p.id_color = '{$color}'";
    return ($this->db->query($sql)->row()->total>0);
  }
  
  function ProductFirstColor( $id = 0 )
  {
    $sql = "select p.id_color as id from product_color_assign p where p.id_product = '{$id}' order by p.id_color asc Limit 0,1";
    $row = $this->db->query($sql)->row();
    return $row ? $row->id : 0;
  }
  
  public function ListItems( $id = 0 )
  {
    if( !$id ) $id = $this->id;
    if( !$id ) 
      return array();
    $sql = "select ci.id_item as iditem, n.id_product as id, ci.id_color, n.id_state, n.name, ps.state as state, n.id_category, n.sizes,
    n.code, n.cost, n.dimensions,n.weight, n.cost2, n.description, f.file, ci.items, pc.color, pc.value as cvalue, ci.active, ci.size
    from cart_item ci
    left join product n on n.id_product = ci.id_product
    left join product_color pc on pc.id_color = ci.id_color
    left join product_state ps on ps.id_state = n.id_state
    left join nz_file f on f.id_file = n.id_file
    where 
    ci.id_cart = '{$id}' AND
    n.active = '1'
    order by ci.id_item asc";
    return $this->db->query($sql)->result();
  }
  
  public function ListItemsX( $id = 0 )
  {
    if( !$id ) $id = $this->id;
    if( !$id ) 
      return array();
    $sql = "select ci.id_item as iditem, n.id_product as id, ci.id_color, n.id_state, n.name, ps.state as state, n.id_category,
    n.code, ci.cost, n.dimensions,n.weight, n.description, f.file, ci.items, ci.active
    from cart_item ci
    left join product n on n.id_product = ci.id_product
    left join product_state ps on ps.id_state = n.id_state
    left join nz_file f on f.id_file = n.id_file
    
    where 
    ci.id_cart = '{$id}' AND
    n.active = '1'
    order by ci.id_item asc";
    return $this->db->query($sql)->result();
  }
  
  public function GetItem( $iditem = 0 )
  {
    if( !$this->id ) 
      return 0;
    $sql = "select * from cart_item ci where ci.id_item = '{$iditem}' AND ci.id_cart = '{$this->id}'";
    return $this->db->query($sql)->row();
  }
  
  public function Items()
  {
    if( !$this->id ) 
      return 0;
    $sql = "select count(*) as total 
    from cart_item ci 
    left join product p on p.id_product = ci.id_product
    where ci.id_cart = '{$this->id}' and p.active = '1'";
    return $this->db->query($sql)->row()->total;
  }
  
  public function Total( $symbol = true )
  {
    $total = 0;
    if( $this->id ) 
    {
      $sql = "select SUM(ci.cost * ci.items) as total 
      from cart_item ci 
      left join product p on p.id_product = ci.id_product
      where ci.id_cart = '{$this->id}'";
      $total = $this->db->query($sql)->row()->total;
    }    
    if(!$symbol) return $total;
    return $this->ItemCost($total);
  }
  
  public function TotalItems()
  {
    $sql = "select count(*) as total from cart_item ci where ci.id_cart = '{$this->id}' and ci.active = '1'";
    return $this->db->query($sql)->row()->total;
  }
  
  public function ItemCost( $cost = 0, $symbol = true )
  {
    return prep_cost($cost, $symbol, false);
  }  

  public function ItemCostNoDec( $cost = 0, $symbol = true )
  {
    return number_format(ceil($cost),0,',','.') . ( $symbol ? ' €' : '' );
  }  

}