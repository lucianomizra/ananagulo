<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class DataModel extends CI_Model
{
   public 
    $pconfig = false,
    $quest = null,
    $relevancia = "",
    $nocost = false,
    $nocolor = false,
    $idUser = 0,
    $init = 0,
    $limit = 0,
    $error = 0;
  
  public function LoadProjectConfig()
  {
    if($this->pconfig) return;
    $id = $this->config->item('project-id', 'app') ;
    $db = $this->config->item('db-global', 'app') ;
    if(!$id) return;
    $sql = "select data from {$db}project where id_project = '{$id}'";
    $row = $this->db->query($sql)->row();
    if(!$row || !$row->data) return;
    $this->pconfig = json_decode($row->data);
  }
  
  public function ProjectConfig( $key = '' )
  {
    $ret = '';
    $this->LoadProjectConfig();
    if(!$this->pconfig || !count($this->pconfig)) return $ret;
    foreach($this->pconfig as $item)
    {
      if(isset($item->key) && $item->key == $key)
      {
        $ret = $item->value;
        break;
      }
    }
    return $ret;
  }
  
  public function SaveWeddingsList()
  {
    $data = array(
      'id_state' => 1,
      'created' => date('Y-m-d H:i:s'),
      'modified' => date('Y-m-d H:i:s'),
      'bride' => $this->input->post('bride'),
      'bridegroom' => $this->input->post('bridegroom'),
      'mail' => $this->input->post('mail'),
      'tel' => $this->input->post('tel'),
    );
    $sql = $this->db->insert_string('weddings_list', $data);
    $this->db->query($sql);    
    $id = $this->db->insert_id();
  }
  
  public function Department( $link = '' )
  {
    $sql = "select id_category as id, category as department, link from product_category where link = '{$link}'";
    return $this->db->query($sql)->row();
  }
  
  public function DepartmentId( $id = 0 )
  {
    $sql = "select id_category as id, category as department, link, id_gallery from product_category where id_category = '{$id}'";
    return $this->db->query($sql)->row();
  }
  
  function GetSizeTypes()
  {
    $sql = "select * from size_type order by num";
    return $this->db->query($sql)->result();
  }

  function GetSizeDD( $id = 0 )
  {
    $sql = "select * from size where id_type = '{$id}' order by num";
    return $this->db->query($sql)->result();
  }

  function ProductBestsellers( $category = 0 )
  {
    $sql = "select p.id_product as id, p.date, p.description, p.name, p.cost, p.id_state as idstate, f.file, st.state
    from product p    
    left join product_state st on st.id_state = p.id_state
    left join nz_file f on f.id_file = p.id_file
    where p.active = '1' and p.id_category != '9' " . ( $category ? "and p.id_category = {$category}" : "") .
    " order by p.id_state, p.sales desc
    limit 0,3";
    return $this->db->query($sql)->result();
  }
  
  function LookProducts( $id = 0 )
  {
    $sql = "select p.id_product as id, p.date, p.name, p.cost, p.id_state as idstate, f.file, f2.file as file2, st.state, p.details,p.sizes
    from look_product px
    left join product p on px.id_product = p.id_product   
    left join product_state st on st.id_state = p.id_state
    left join nz_file f on f.id_file = p.id_file
    left join nz_file f2 on f2.id_file = p.id_file_2
    where p.active = '1' and px.id_look = {$id} and p.id_state = '1'
    order by px.num";
    return $this->db->query($sql)->result();
  }
  
  function ProductSimil( $category = 0, $id = 0 )
  {
    $sql = "select p.id_product as id, p.date, p.name, p.cost, p.id_state as idstate, f.file, st.state
    from product p    
    left join product_state st on st.id_state = p.id_state
    left join nz_file f on f.id_file = p.id_file
    where p.active = '1' and p.id_category = {$category} and p.id_product != {$id} and p.id_state = '1'
    order by p.id_state, RAND() 
    limit 0,4";
    return $this->db->query($sql)->result();
  }

  function GetProductVisits($id = 0 )
  {
    $sql = "select p.id_product as id, p.date, p.name, p.cost, p.id_state as idstate, f.file, st.state
    from product p    
    left join product_state st on st.id_state = p.id_state
    left join nz_file f on f.id_file = p.id_file
    where p.active = '1' and p.id_product = {$id} and p.id_state = '1'";
    return $this->db->query($sql)->row();
  }
  
  function GetHighlights()
  {
    $sql = "select p.id_product as id, p.*, f.file
    from product p
    left join nz_file f on f.id_file = p.id_file
    where p.active = '1' and p.highlight = '1' order by RAND()";
    return $this->db->query($sql)->result();
  }
  
  function GetHighlight( $id = 0 )
  {
    $sql = "select p.id_product as id, p.*, f.file
    from product p
    left join nz_file f on f.id_file = p.id_file
    where p.active = '1' AND p.id_category = '{$id}' and p.highlight = '1' order by RAND()";
    return $this->db->query($sql)->row();
  }
  
  function Product( $id = 0 )
  {
    $sql = "select p.id_product as id, p.*, f.file, pc.category as department, pc.link as departmentlink, 
    ps.sub, ps2.sub2, p.id_gallery as gallery, st.state, pb.brand
    from product p
    left join product_state st on st.id_state = p.id_state
    left join brand pb on pb.id_brand = p.id_brand
    left join product_category pc on pc.id_category = p.id_category
    left join product_sub ps on ps.id_sub = p.id_sub
    left join product_sub2 ps2 on ps2.id_sub2 = p.id_sub2
    left join nz_file f on f.id_file = p.id_file
    where p.active = '1' and p.id_product = {$id}";
    return $this->db->query($sql)->row();
  }
  
  public function Colors()
  {
    $sql = "SELECT * from product_color";
    return $this->db->query($sql)->result();
  }
  
  public function ProductCares( $id = 0 )
  {
    $sql = "SELECT pc.id_care as id, pc.name as care, f.file
    from product_care_item pa
    left join product_care pc on pc.id_care = pa.id_care 
    left join nz_file f on f.id_file = pc.id_file
    where pa.id_product = '{$id}' and pc.id_care is not null
    ORDER by pa.num";
    return $this->db->query($sql)->result();
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
  
  public function Instagram()
  {
    $sql = "select s.* , lj0.file
    from instagram s     
    LEFT JOIN nz_file lj0 on s.id_file = lj0.id_file  
    order by RAND()";
    return $this->db->query($sql)->result();
  }

  public function Cards()
  {
    $sql = "select s.* , lj0.file
    from card s     
    LEFT JOIN nz_file lj0 on s.id_file = lj0.id_file  
    order by s.num";
    return $this->db->query($sql)->result();
  }

  public function GetLooksList()
  {
    $sql = "select s.id_look as id, s.* , lj0.file, (
      select sum(p.cost) from look_product lp
      left join product p on p.id_product = lp.id_product
      where lp.id_look = s.id_look and p.active = 1
      ) as cost
    from look s     
    LEFT JOIN nz_file lj0 on s.id_file = lj0.id_file  
    where s.active = '1'
    order by s.num";
    return $this->db->query($sql)->result();
  }

  public function LookIndex( $index = 0, $id = 0, $type = '' )
  {
    $sql = "select s.id_look as id, s.* 
    from look s      
    where s.active = '1' and id_look != '{$id}' and num {$type}= '{$index}'";
    return $this->db->query($sql)->row();
  }

  public function Look( $id = 0 )
  {
    $sql = "select s.id_look as id, s.* , s.id_gallery as gallery, lj0.file, (
      select sum(p.cost) from look_product lp
      left join product p on p.id_product = lp.id_product
      where lp.id_look = s.id_look and p.active = 1
      ) as cost
    from look s     
    LEFT JOIN nz_file lj0 on s.id_file = lj0.id_file  
    where s.active = '1' and id_look = '{$id}'";
    return $this->db->query($sql)->row();
  }

  public function GetLooks( $id = 0 )
  {
    $sql = "select s.id_look as id, s.* , lj0.file, (
      select sum(p.cost) from look_product lp
      left join product p on p.id_product = lp.id_product
      where lp.id_look = s.id_look and p.active = 1
      ) as cost
    from look s     
    LEFT JOIN nz_file lj0 on s.id_file = lj0.id_file  
    where s.active = '1' and id_look != '{$id}'
    order by RAND() limit 0,4";
    return $this->db->query($sql)->result();
  }
  
  public function Stores()
  {
    $sql = "select s.id_store as id, s.* , lj0.file
    from store s     
    LEFT JOIN nz_file lj0 on s.id_file = lj0.id_file  
    where s.active = '1' order by s.num";
    return $this->db->query($sql)->result();
  }
  
  public function PrepareIdWeddingList( $id = '' )
  {
    return 'CBL' . str_pad(round($id), 6, "0", STR_PAD_LEFT);
  }
  
  public function ValidWeddingList( $id = '' )
  {
    $id = round(str_replace('CBL','',$id));
    $sql = "select count(*) as total from weddings_list where code = '{$id}' AND id_state = 3";
    return ($this->db->query($sql)->row()->total> 0);
  }
  
  public function ItemInWeddingsList($list = 0, $id = 0 )
  {
    $sql = "select id_item from weddings_list_item where id_list = '{$list}' AND id_product = '{$id}' AND purchased = '0'";
    return $this->db->query($sql)->result();
  }
  
  public function GetWeddingsList( $id = 0 )
  {
    $sql = "select * from weddings_list where code = '{$id}' AND id_state = 3";
    return $this->db->query($sql)->row();
  }
  
  public function SearchWeddingsList( $bride = '', $bridegroom = '' )
  {
    $sql = "select * from weddings_list where id_state = 3 AND ( bride like '%{$bride}%' OR bridegroom like '%{$bridegroom}%' )";
    if(!$bridegroom)
      $sql = "select * from weddings_list where id_state = 3 AND ( bride like '%{$bride}%' )";
    if(!$bride)
      $sql = "select * from weddings_list where id_state = 3 AND ( bridegroom like '%{$bridegroom}%' )";
    return $this->db->query($sql)->result();
  }
  
  public function GetStatusCoupon( $code = '', $type = 1 )
  {
    $sql = "select * from coupon where code = '{$code}' AND id_type = '{$type}'";
    $row = $this->db->query($sql)->row();
    if(!$row) return 0;
    if(!$row->active) return 1;
    if($row->used >= $row->total) return 2;
    return 3;
  }
  
  public function GetCoupon( $code = '', $type = 1 )
  {
    $sql = "select * from coupon where code = '{$code}' AND id_type = '{$type}' and active = '1' and total > used";
    return $this->db->query($sql)->row();
  }
  
  public function Departments()
  {
    $sql = "select id_category as id, category as department, link from product_category where num > 0 order by num";
    return $this->db->query($sql)->result();
  }
  
  public function Categories( $id = 0 )
  {
    $sql = "select id_sub as id, sub as category from product_sub where id_category = '{$id}' and num > 0  order by num";
    return $this->db->query($sql)->result();
  }
  
  public function Subcategories( $id = 0 )
  {
    $sql = "select id_sub2 as id, sub2 as sub from product_sub2 where id_sub = '{$id}' and num > 0 order by num";
    return $this->db->query($sql)->result();
  }
  
  public function Brands( $id = 0 )
  {
    $sql = "select id_brand as id, brand as brand from brand where id_category = '{$id}' and active = '1' order by num";
    return $this->db->query($sql)->result();
  }
  
  public function BrandsSelect( $id = 0, $all =  '' )
  {    
    if($id)
      $sql = "select id_brand as id, brand as el from brand where id_category = '{$id}' and active = '1' order by el";
    else
      $sql = "select id_brand as id, brand as el from brand where active = '1' order by el";
    return create_select_options($this->db->query($sql), $all);
  }
  
  public function WeddingsAdvices()
  {
    $sql = "select * from weddings_advice  order by num";
    return $this->db->query($sql)->result();
  }
  
  public function OthersWeddings()
  {
    $sql = "select g.*, f2.file as winners, f1.file as guidelines 
    from weddings_other g 
    left join nz_file f1 on f1.id_file = g.id_file_1
    left join nz_file f2 on f2.id_file = g.id_file_2
    where id_other = '1'";
    return $this->db->query($sql)->row();
  }
  
  public function WeddingsSponsors()
  {
    $sql = "select g.*, f.file 
    from weddings_sponsor g 
    left join nz_file f on f.id_file = g.id_file
    where g.active = '1'
    order by g.num";
    return $this->db->query($sql)->result();
  }
  
  public function WeddingsGuides()
  {
    $sql = "select g.*, f.file 
    from weddings_guide g 
    left join nz_file f on f.id_file = g.id_file
    order by g.num";
    return $this->db->query($sql)->result();
  }
  
  public function SlideWeddings()
  {
    $sql = "select s.title, s.text, s.link, f.file, s.title2, s.button
    from weddings_slide s
    left join nz_file f on f.id_file = s.id_file
    where s.active = '1'
    order by s.num";
    return $this->db->query($sql)->result();
  }
  
  public function SlideHome()
  {
    $sql = "select s.title, s.subtitle, s.link, f.file
    from promotion s
    left join nz_file f on f.id_file = s.id_file
    where s.home = '1'
    order by num";
    return $this->db->query($sql)->result();
  }
  
  public function SlideCollections()
  {
    $sql = "select s.title, s.subtitle, s.link, f.file
    from promotion s
    left join nz_file f on f.id_file = s.id_file
    where s.looks = '1'
    order by num";
    return $this->db->query($sql)->result();
  }
  
  public function SlideLooks()
  {
    $sql = "select s.title, s.subtitle, s.link, f.file
    from promotion s
    left join nz_file f on f.id_file = s.id_file
    where s.looks = '1'
    order by num";
    return $this->db->query($sql)->result();
  }

  public function SlideReductions()
  {
    $sql = "select s.title, s.subtitle, s.link, f.file
    from promotion s
    left join nz_file f on f.id_file = s.id_file
    where s.reductions = '1'
    order by num";
    return $this->db->query($sql)->result();
  }
  
  public function PromotionsSearch()
  {
    $sql = "select s.title, s.subtitle, s.link, f.file
    from promotion2 s
    left join nz_file f on f.id_file = s.id_file
    where s.id_state = '2'
    order by RAND()";
    return $this->db->query($sql)->result();
  }
  
  public function GridHome( $id = 0 )
  {
    $sql = "select s.title, s.subtitle, s.button as subtitle2, s.link, s.id_gallery as gallery
    from home_grid s
    where id_grid = '{$id}'";
    $row = $this->db->query($sql)->row();
    if(!$row) return false;
    return $row;
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
  
  public function Collection()
  {
    $sql = "select * from collection c where active = 1 order by c.date desc";
    return $this->db->query($sql)->row();
  }
  
  public function Information( $link = '' )
  {
    $sql = "select s.title, s.subtitle, s.text, s.link, s.link, s.id_gallery as gallery, s.id_style as style
    from information s
    where link = '{$link}'";
    return $this->db->query($sql)->row();
  }
  
  public function Informations()
  {
    $sql = "select s.title , s.link
    from information s
    where num != 0
    order by num";
    return $this->db->query($sql)->result();
  }
  
  
  function Search()
	{    
    $where = $this->SearchWhere();
		$sql = "SELECT p.id_product as id, p.*, s.state as state, f.file
    " .( $this->relevancia ? $this->relevancia : "")."
    from product p
    left join product_state s on s.id_state = p.id_state
    left join nz_file f on f.id_file = p.id_file
    where 1 $where";
    $orderrel = $this->relevancia ? " relevancia desc, " : "";
    if( $this->quest->filter->order == 2 )
      $sql .=  " order by p.cost asc ";
    elseif( $this->quest->filter->order == 3 )
      $sql .=  " order by p.cost desc ";
    elseif( $this->quest->filter->order == 4 )
      $sql .=  " order by p.date desc ";
    elseif( $this->quest->filter->order == 5 )
      $sql .=  " order by p.sales desc ";
    else
      $sql .=  " order by $orderrel p.highlight desc ";
    if($this->quest->filter->show != 100)
      $sql .= "LIMIT " .round($this->init) .", ". (($this->quest->filter->show) ? $this->quest->filter->show : 16); 
		$consulta = $this->db->query($sql);
    return $consulta->result();
	}
  
  
  function SearchWhere( $where = "" )
  {
    if($this->quest->filter->text)
    {
      $txtx = str_replace(array(',',';',"'") ,' ',$this->quest->filter->text);      
      $this->quest->filter->text = "";
      $txt = explode(" ", $txtx);
      $orida = array();
      $orid = "";
      $matchnstr = "";
      $matchstr = "";
      $this->relevancia = "";

      if( count($txt) )
      {
        foreach( $txt as $t )
          if( $tid = round($t) )
            $orida[] = $tid;
        if( count($orida) )
          $orid = ' p.id_product IN ('. implode(',',$orida).') OR p.code IN ('. implode(',',$orida).') OR ';
        
        $i = 1;
        foreach( $txt as $t )
        {
          if( strlen($t) > 2 )  
          {
            if( $i > 8 )
              break;
            $matchstr .=  $t.'* ';
            $this->quest->filter->text .= ( $this->quest->filter->text ? " " : "") . $t;
            $i++;
          }
        }
        if( $matchstr )
        {
          $matchstr = rtrim($matchstr);
          $matchstr = "+({$matchstr})";
        }
      }

      if($matchstr || $matchnstr)
      {
        $where .= " AND ( {$orid} MATCH (p.name, p.description) AGAINST ('{$matchstr} {$matchnstr}' IN BOOLEAN MODE) )";              
        $this->relevancia = ", ( IF( {$orid} 0,2,0) + MATCH (p.name, p.description) AGAINST ('{$matchstr}  {$matchnstr}' IN BOOLEAN MODE) )  as relevancia ";
      }
    }
    /*
    if($this->quest->filter->wedding)
    {
      $list = $this->GetWeddingsList($this->quest->filter->wedding);
      $where .= " AND (select count(*) from weddings_list_item wli where wli.id_list = '{$list->id_list}' and wli.id_product = p.id_product and wli.items > wli.purchased) > 0 ";
    }
    else
    {
      $where .= " AND p.id_state = '1'";
    }*/
      
    if($this->quest->filter->reductions)
      $where .= " AND p.reduction = '1'";

    if($this->quest->filter->collection)
      $where .= " AND p.id_collection = '".$this->quest->filter->collection."'";

    if($this->quest->filter->categoryp)
      $where .= " AND p.id_category = '".$this->quest->filter->categoryp."'";

    if($this->quest->filter->size)
      $where .= " AND p.sizes like '%".$this->quest->filter->size.",%'";
 
    if($this->quest->filter->category)
      $where .= " AND p.id_sub = '".$this->quest->filter->category."'";
 
    if($this->quest->filter->sub)
      $where .= " AND p.id_sub2 = '".$this->quest->filter->sub."'";
    
    if($this->quest->filter->brand)
      $where .= " AND p.id_brand = '".$this->quest->filter->brand."'";
    
    if( !$this->nocost )
    {
      if( $this->quest->filter->cost1>0 )
        $where .= " AND p.cost >= '{$this->quest->filter->cost1}' ";
      if( $this->quest->filter->cost2>0 )
        $where .= " AND p.cost <= '{$this->quest->filter->cost2}' ";        
    }
  
    if( !$this->nocolor )
    {
      if( $this->quest->filter->color>0 )
      $where .= " AND (select count(*) as total from product_color_assign pcolor where pcolor.id_product = p.id_product AND pcolor.id_color = '{$this->quest->filter->color}') > 0";
    }
  
    $where .= " AND p.active = '1'" ;
    
    return $where;
    
  }
  
  function SearchOrder()
  {
    return array(
      1 => 'Más relevantes',
      2 => 'Menor precio',
      3 => 'Mayor precio',
      4 => 'Nuevos productos',
      5 => 'Los más vendidos'
    );
  }
  
  function SearchCost()
	{  
    $this->nocost = true;
    $where = $this->SearchWhere();     
    $this->nocost = false;
    $sql = "SELECT max(cost) as max, min(cost) as min 
    from product p
    where 1 $where";
		$consulta = $this->db->query($sql);
    return $consulta->row();   
	}
  
  function SearchColors()
	{  
    $this->nocolor = true;
    $where = $this->SearchWhere();     
    $this->nocolor = false;
    $sql = "select pc.id_color as id, pc.color, pc.value, ca.total as total
    from
    (SELECT pca.id_color as id, count(*) as total
    from product p
    left join product_color_assign pca on pca.id_product = p.id_product
    where 1 $where
    group by pca.id_color) as ca
    left join product_color pc on pc.id_color = ca.id
    where pc.id_color is not null AND pc.id_color > 0
    ORDER by ca.total, pc.color";
		$consulta = $this->db->query($sql);
    return $consulta->result();   
	}
  
  function SearchCount()
	{  
    $where = $this->SearchWhere();     
    $sql = "SELECT count(*) as total from product p
    where 1 $where";
		$consulta = $this->db->query($sql);
    $k = $consulta->row();    
    return $k->total;
	}	  
  
}