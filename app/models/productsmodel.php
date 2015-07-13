<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class DataModel extends CI_Model
{
   public 
    $quest = null,
    $relevancia = "",
    $nocost = false,
    $nocolor = false,
    $idUser = 0,
    $init = 0,
    $limit = 0,
    $error = 0;
  
  public function Department( $link = '' )
  {
    $sql = "select id_category as id, category as department, link from product_category where link = '{$link}'";
    return $this->db->query($sql)->row();
  }
  
  function ProductSimil( $category = 0, $id = 0 )
  {
    $sql = "select p.id_product as id, p.date, p.name, p.cost, 0 as wish, p.id_state as idstate, f.file, st.state
    from product p    
    left join product_state st on st.id_state = p.id_state
    left join nz_file f on f.id_file = p.id_file
    where p.active = '1' and p.id_category = {$category} and p.id_product != {$id} and p.id_state = '1'
    order by RAND() 
    limit 0,4";
    return $this->db->query($sql)->result();
  }
  
  function Product( $id )
  {
    $sql = "select p.id_product as id, p.*, f.file, pc.category as department, pc.link as departmentlink, 
    ps.sub, ps2.sub2, p.id_gallery as gallery, 0 as wish, st.state, pb.brand
    from product p
    left join product_state st on st.id_state = p.id_state
    left join brand pb on pb.id_brand = p.id_brand
    left join product_category pc on pc.id_category = p.id_category
    left join product_sub ps on ps.id_sub = p.id_sub
    left join product_sub2 ps2 on ps2.id_sub2 = p.id_sub2
    left join nz_file f on f.id_file = p.id_file
    where p.active = '1' and p.id_product = {$id} and p.id_state = '1'";
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
  
  public function Departments()
  {
    $sql = "select id_category as id, category as department, link from product_category order by num";
    return $this->db->query($sql)->result();
  }

  
  public function Categories( $id = 0 )
  {
    $sql = "select id_sub as id, sub as category from product_sub where id_category = '{$id}' order by num";
    return $this->db->query($sql)->result();
  }
  
  public function Subcategories( $id = 0 )
  {
    $sql = "select id_sub2 as id, sub2 as sub from product_sub2 where id_sub = '{$id}' order by num";
    return $this->db->query($sql)->result();
  }
  
  public function Brands( $id = 0 )
  {
    $sql = "select id_brand as id, brand as brand from brand where id_category = '{$id}' and active = '1' order by num";
    return $this->db->query($sql)->result();
  }
  
  public function SlideHome()
  {
    $sql = "select s.title, s.text, s.link, f.file
    from home_slide s
    left join nz_file f on f.id_file = s.id_file
    where s.active = '1'
    order by s.num";
    return $this->db->query($sql)->result();
  }
  
  public function PromotionsHome()
  {
    $sql = "select s.title, s.subtitle, s.link, f.file
    from promotion s
    left join nz_file f on f.id_file = s.id_file
    where s.id_state = '2' AND s.home = '1'
    order by RAND()";
    return $this->db->query($sql)->result();
  }
  
  public function GridHome( $id = 0 )
  {
    $sql = "select s.title, s.subtitle, s.text, s.link, s.button, s.id_gallery as gallery
    from home_grid s
    where id_grid = '{$id}'";
    return $this->db->query($sql)->row();
  }
  
  public function Gallery( $id = 0 )
  {
    $sql = "select f.file
    from nz_gallery_file s
    left join nz_file f on f.id_file = s.id_file
    where s.id_gallery = '{$id}'
    order by s.num";
    return $this->db->query($sql)->result();
  }
  
  public function Information( $link = '' )
  {
    $sql = "select s.title, s.subtitle, s.text, s.link, s.link, s.id_gallery as gallery, s.id_style as style
    from information s
    where link = '{$link}'";
    return $this->db->query($sql)->row();
  }
  
}