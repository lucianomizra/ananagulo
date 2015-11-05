<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class App extends AppController
{

  public function index( $section = '' )
  {
    $this->load->view('section/home', $this->data);
  }

  public function contact()
  { 

    if( $this->input->post('level') == 2)
    {
      $this->load->helper('email');
      if( $this->input->post('name') && $this->input->post('subject') && valid_email($this->input->post('mail')) )
      {
        $this->load->library('PHPMailer');
        $mail = new PHPMailer();
        $mail->From = $this->config->item('client-mail', 'app');
        $mail->FromName = $this->config->item('client', 'app');
        $mail->AddAddress($this->config->item('client-mail', 'app'));
        $mail->AddBcc("juanazareno@gmail.com");
        $mail->IsHTML(true);
        $mensaje = $this->load->view('widget/contact-mail', $this->data, true);    
        $mail->Subject  = 'Formulario de contacto';
        $mail->Body  =  $mensaje;
        @$mail->Send();
        $this->data['formSOK'] = 1;   
      }
      else
      {
        $this->data['formError'] = 1;           
      }
      return $this->load->view('widget/form-contact', $this->data); 
    }
    $this->data['stores'] = $this->Data->Stores();
    $this->load->view('section/contact', $this->data);
  }

  public function looks()
  { 
    $this->data['looks'] = $this->Data->GetLooksList();
    $this->data['sectionMenu'] = 'looks'; 
    $this->load->view('looks/index', $this->data);
  }

  public function suscripcion( $section = '' )
  {
    $this->load->helper('email');
    if( $this->input->post('level') == 2 && $this->input->post('quit'))
    {
      $this->session->set_userdata('joinaltform', true);
      return;
    }
    if( !AJAX || $this->input->post('level') != 2 )
    {
      return redirect('home');
    }
    if( valid_email($this->input->post('mail')) )
    {
      if($section == 'cc')
      {
        if(!$this->input->post('privacy'))
          return $this->load->view('widget/form-join-alt', $this->data);    
      }
      /*$this->load->library('PHPMailer');
      $mail = new PHPMailer();
      $mail->From = $this->config->item('client-mail', 'app');
      $mail->FromName = $this->config->item('client', 'app');
      $mail->AddBcc("juanazareno@gmail.com");
      $mail->AddBcc($this->config->item('client-mail', 'app'));
      $mail->IsHTML(true);
      $mensaje = $this->load->view('widget/suscripcion-mail', $this->data, true);    
      $mail->Subject  = 'Formulario de suscripción';
      $mail->Body  =  $mensaje;
      @$mail->Send();*/
	    $this->Data->SaveNewsLetter($this->input->post('mail'), $this->input->post('name'));
      $this->data['formSOK'] = 1;   
    }      
    if($section == 'cc')
    {
      $this->session->set_userdata('joinaltform', true);
      return $this->load->view('widget/form-join-alt', $this->data);    
    }
    return $this->load->view('widget/form-join', $this->data);    
  }
  
  public function department( $section = '' )
  {    
    if(!$section) return $this->error();
    $info = $this->Data->Department($section);
    if(!$info) return $this->error();
    //$this->session->unset_userdata('wedding-list');
    $this->products("categoryp:{$info->id}");
  }
  
  public function reductions( $uri = '', $init = 0 )
  {  
    $this->load->library('Quest');
    $quest = new Quest();
    $init = round($init);
    if( count( $_POST) )
    {
      $quest->updateFilters( $this->input->post(NULL, true) );
      if(!AJAX) 
      {
        redirect('rebajas/' . $quest->generateURI());
      }
    }
    $quest->loadURI($uri);
    if($quest->filter->cost1>0 || $quest->filter->cost2>0)
    {
      if($quest->filter->cost1>$quest->filter->cost2)
      {
        $c1 = $quest->filter->cost1;
        $quest->filter->cost1 = $quest->filter->cost2;
        $quest->filter->cost2 = $c1;
      }
    }  
    if(!$quest->filter->show || $quest->filter->show == 16) $quest->filter->show = 15;
    $this->Data->quest = $quest;
    $this->Data->quest->filter->reductions = true;
    $this->Data->init = $init;
    $total = $this->Data->SearchCount();
    $this->data['costValues'] = $this->Data->SearchCost();
    if($quest->filter->cost2 >= round($this->data['costValues']->max)*.99)
    {
      $quest->filter->cost2 = 0;      
      $this->Data->quest = $quest;
    }
    $this->data['sectionMenu'] = 'rebajas'; 
    $this->data['noChangeURI'] = true; 
    $this->data['totalProducts'] = $total; 
    $this->data['questURI'] = $quest->generateURI();    
    $this->data['search'] = $quest;    
    $this->data['productsSearch'] = $this->Data->Search();
    $this->load->driver('cache');
    $this->load->helper('date');
    $this->load->helper('form');
    $this->load->helper('string');
    /*if ( !$bestsellers = $this->cache->file->get('bestsellers'))
    {
      $bestsellers = $this->load->view('products/bestsellers', array('bestsellers' => $this->Data->ProductBestsellers()), true) ;
      $this->cache->file->save('bestsellers', $bestsellers, 300);
    }
    $this->data['bestsellersView'] = $bestsellers;*/
    $this->data['rnd'] = random_string();
    $config['base_url'] = base_url() . "rebajas/" . ($this->data['questURI'] ? $this->data['questURI'] : "order:1") . "/";
    $config['total_rows'] = $total;
    $config['per_page'] = $this->Data->quest->filter->show; 
    $config['uri_segment'] = 3;
    $this->load->library('pagination');
    $this->pagination->initialize($config); 
    $this->data['pagination'] = $this->pagination->create_links();    
    $this->load->view('reductions/products', $this->data);
  }

  public function collections( $uri = '', $init = 0 )
  {  
    $this->load->library('Quest');
    $quest = new Quest();
    $init = round($init);
    if( count( $_POST) )
    {
      $quest->updateFilters( $this->input->post(NULL, true) );
      if(!AJAX) 
      {
        redirect('colecciones/' . $quest->generateURI());
      }
    }
    $collection = $this->Data->Collection();
    if(!$collection)
      return $this->error();
    $quest->loadURI($uri);
    if($quest->filter->cost1>0 || $quest->filter->cost2>0)
    {
      if($quest->filter->cost1>$quest->filter->cost2)
      {
        $c1 = $quest->filter->cost1;
        $quest->filter->cost1 = $quest->filter->cost2;
        $quest->filter->cost2 = $c1;
      }
    }  
    if(!$quest->filter->show || $quest->filter->show == 16) $quest->filter->show = 15;
    $this->Data->quest = $quest;
    $this->Data->quest->filter->collection = $collection->id_collection;
    $this->Data->init = $init;
    $total = $this->Data->SearchCount();
    $this->data['collection'] = $collection;
    $this->data['costValues'] = $this->Data->SearchCost();
    if($quest->filter->cost2 >= round($this->data['costValues']->max)*.99)
    {
      $quest->filter->cost2 = 0;      
      $this->Data->quest = $quest;
    }
    $this->data['sectionMenu'] = 'colecciones'; 
    $this->data['noChangeURI'] = true; 
    $this->data['totalProducts'] = $total; 
    $this->data['questURI'] = $quest->generateURI();    
    $this->data['search'] = $quest;    
    $this->data['productsSearch'] = $this->Data->Search();
    $this->load->driver('cache');
    $this->load->helper('date');
    $this->load->helper('form');
    $this->load->helper('string');
    /*if ( !$bestsellers = $this->cache->file->get('bestsellers'))
    {
      $bestsellers = $this->load->view('products/bestsellers', array('bestsellers' => $this->Data->ProductBestsellers()), true) ;
      $this->cache->file->save('bestsellers', $bestsellers, 300);
    }
    $this->data['bestsellersView'] = $bestsellers;*/
    $this->data['rnd'] = random_string();
    $config['base_url'] = base_url() . "colecciones/" . ($this->data['questURI'] ? $this->data['questURI'] : "order:1") . "/";
    $config['total_rows'] = $total;
    $config['per_page'] = $this->Data->quest->filter->show; 
    $config['uri_segment'] = 3;
    $this->load->library('pagination');
    $this->pagination->initialize($config); 
    $this->data['pagination'] = $this->pagination->create_links();    
    $this->load->view('collections/products', $this->data);
  }
  
  public function products( $uri = '', $init = 0 )
  {  
    $this->load->library('Quest');
    $quest = new Quest();
    $init = round($init);
    if( count( $_POST) )
    {
      $quest->updateFilters( $this->input->post(NULL, true) );
      if(!AJAX) 
      {
        redirect('productos/' . $quest->generateURI());
      }
    }
    $quest->loadURI($uri);
    if($quest->filter->cost1>0 || $quest->filter->cost2>0)
    {
      if($quest->filter->cost1>$quest->filter->cost2)
      {
        $c1 = $quest->filter->cost1;
        $quest->filter->cost1 = $quest->filter->cost2;
        $quest->filter->cost2 = $c1;
      }
    }  
    $this->Data->quest = $quest;
    $this->Data->init = $init;
    $total = $this->Data->SearchCount();
    $this->data['costValues'] = $this->Data->SearchCost();
    if($quest->filter->cost2 >= round($this->data['costValues']->max)*.99)
    {
      $quest->filter->cost2 = 0;      
      $this->Data->quest = $quest;
    }
    $this->data['sectionMenu'] = 'productos'; 
    $this->data['noChangeURI'] = true; 
    $this->data['totalProducts'] = $total; 
    $this->data['questURI'] = $quest->generateURI();    
    $this->data['search'] = $quest;    
    $this->data['productsSearch'] = $this->Data->Search();
    $this->load->driver('cache');
    $this->load->helper('date');
    $this->load->helper('form');
    $this->load->helper('string');
    /*if ( !$bestsellers = $this->cache->file->get('bestsellers'))
    {
      $bestsellers = $this->load->view('products/bestsellers', array('bestsellers' => $this->Data->ProductBestsellers()), true) ;
      $this->cache->file->save('bestsellers', $bestsellers, 300);
    }
    $this->data['bestsellersView'] = $bestsellers;*/
    $this->data['rnd'] = random_string();
    $config['base_url'] = base_url() . "productos/" . ($this->data['questURI'] ? $this->data['questURI'] : "order:1") . "/";
    $config['total_rows'] = $total;
    $config['per_page'] = $this->Data->quest->filter->show; 
    $config['uri_segment'] = 3;
    $this->load->library('pagination');
    $this->pagination->initialize($config); 
    $this->data['pagination'] = $this->pagination->create_links();    
    $this->load->view('products/products', $this->data);
  }
  
  public function look( $id = 0 )
  {
    //if($this->session->userdata('wedding-list')) redirect('weddings/products');
    $id = round($id);
    if( !$id ) return $this->error();

    $this->data['look'] = $this->Data->Look( $id );
    if( !$this->data['look'] ) return $this->error(); 
    $this->data['lookNext'] = $this->Data->LookIndex($this->data['look']->num+1, $id, '<');
    $this->data['lookPrev'] = $this->Data->LookIndex($this->data['look']->num-1, $id, '>');
    $this->data['products'] = $this->Data->LookProducts( $id );
    $this->load->helper('date');
    $headers = array();
    $this->data['gallery'] = $this->Data->Gallery($this->data['look']->gallery);
    $headers['head-title'] = $this->data['look']->name . ' | ' . $this->data['look']->description;    
    $headers['title'] = $this->data['look']->name;    
    $headers['description'] = $headers['keywords'] = $this->data['look']->description;    
    $headers['og:image'] = thumb($this->data['look']->file, 650, 498);    
    $this->data['headers'] = $headers;    
    $this->load->view('looks/look', $this->data);
  }

  public function product( $id = 0 )
  {
    //if($this->session->userdata('wedding-list')) redirect('weddings/products');
    $id = round($id);
    if( !$id ) return $this->error();

    $this->data['product'] = $this->Data->Product( $id );
    if( !$this->data['product'] ) return $this->error();         

    $productVisits = $this->session->userdata('productVisits');
    if(is_array($productVisits) && in_array($id, $productVisits))
    {      
      $idd = array_search($id, $productVisits);
      unset($productVisits[$idd]);
    }
    $productVisits[] = $id;
    $productVisits = array_slice($productVisits, -13);
    $this->session->set_userdata('productVisits', $productVisits);
    $this->load->helper('date');
    $this->data['productVisits'] = $productVisits;
    $this->data['looks'] = $this->Data->GetLooks();
    $this->data['simil'] = $this->Data->ProductSimil($this->data['product']->id_category, $id);
    $this->data['colors'] = $this->Data->ProductColors($id);
    $this->data['gallery'] = $this->Data->Gallery($this->data['product']->gallery);
    $headers = array();
    $headers['head-title'] = $this->data['product']->name . ' | ' . $this->data['product']->department;    
    $headers['title'] = $this->data['product']->name;    
    $headers['description'] = $headers['keywords'] = $this->data['product']->description;    
    $headers['og:image'] = thumb($this->data['product']->file, 650, 498);    
    $this->data['headers'] = $headers;    
    $this->load->view('products/product', $this->data);
  }
  
  public function info( $section = '' )
  {    
    $section = $section ? $section : 'information';
    $info = $this->Data->Information($section);
    if(!$info) return $this->error();
    $this->data['info'] = $info;
    $this->data['infos'] = $this->Data->Informations();
    $this->load->view('section/info', $this->data);
  }
  
  public function error()
  {
    $this->data['sectionMenu'] = 'error';
    $this->load->view('section/error', $this->data);
  }

  public function facebook()
  {
  	if(isset($_POST['name']) && isset($_POST['lastname']) && isset($_POST['privacy']) && isset($_POST['mail']) 
  		&& strlen($_POST['name']) > 3 && strlen($_POST['lastname']) > 3 && strlen($_POST['mail']) > 3)
  	{
      $this->load->library('PHPMailer');
	    $date = date('d-m-Y H:i:s');
	    $mail = new PHPMailer();
	    $mail->From = 'hola@anaangulo.com';
	    $mail->FromName = 'Ana Angulo';
	    $mail->AddAddress($_POST['mail']);
	    $mail->AddBcc('hola@anaangulo.com');
	    $mail->AddBcc('antonio@identty.com');
	    $mail->AddBcc('juan@identty.com');
	    $mail->IsHTML(true);
	    $mail->Subject  = 'Suscripción Ana Angulo';
	    $mail->Body  =  $this->load->view('widget/facebook-mail', $this->data, true);
	    @$mail->Send(); 
	    $this->Data->SaveNewsLetter($_POST['mail'], $_POST['name'], $_POST['lastname']);
  		$this->data['formOk'] = true;
		}
    $this->load->view('section/facebook', $this->data);
  }

  public function instagram()
  {
    $id = '1600192808';
    set_time_limit(0);
    ini_set('memory_limit', '-1');
    ini_set('max_execution_time', '999999');
    require  APPPATH . 'third_party/Instagram/Instagram.php';
    require  APPPATH . 'third_party/Instagram/InstagramException.php';
    $config = '2440e15f188a41439c6edcd698ff081f';
    $instagram = new Instagram($config);
    $response = $instagram->getUserMedia($id);
    while($response && count($response->data))
    {
      if($response->meta->code != 200)
      {
        print_r($response);
        exit;        
      }
      $items = $response->data;
      foreach($items as $item)
      {
        if(!isset($item->images->standard_resolution->url)) continue;
        $link = $item->link;
        $sql = "select * from instagram where link = '{$link}'";
        $row = $this->db->query($sql)->row();
        if($row)
        {
          die('FINISH');
        }
        $file = str_replace(array('https://instagram.com/p/', '/'), '', $link) . '.jpg';
        $folder = 'instagram/';
        $url = $item->images->low_resolution->url;
        copy($url, FCPATH . 'files/' . $folder . $file );
        $this->db->insert('nz_file', array(
          'id_folder' => 28,
          'id_type' => 1,
          'file' => $folder . $file,
          'name' => $file,
          'alt' => '',
          'id_user' => 1,
          'deleted' => 0,
          'date' => date('Y-m-d H:i:s')
        ));
        $idf = $this->db->insert_id();
        $this->db->insert('instagram', array(
          'id_file' => $idf,
          'link' => $link         
        ));
      }
      $response = $instagram->pagination($response);
    }
  }

}