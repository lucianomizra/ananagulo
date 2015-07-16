<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class User extends AppController
{
  
  public 
    $keyGG = 'tNN94nFSfRpK3nErD3gA769u3a2Z5Y4x';
    
  public function index( $section = '' )
  {
    $this->load->model('UserModel', 'UserM');
    $this->UserM->idUser = $this->Data->idUser;
    if($section == 'logout')
    {
      $this->session->unset_userdata('userID');
      $this->session->unset_userdata('cartId');
      $this->session->unset_userdata('register-action');
      redirect(base_url());
    }    
    if($section == 'newsletter')
    {
      if(!AJAX) redirect(base_url());
      $this->load->helper('email');
      if( $this->input->post('mail') && valid_email($this->input->post('mail')) )
      {
        $this->session->set_userdata('user-newsletter', true);
        $this->UserM->AddToNewsletter($this->input->post('mail'));
        die('<p>Suscripción exitosa.</p>');
      }
      die('<p>Ha ocurrido un problema, intente nuevamente.</p>');
    }

    if($section == 'pedido')
    {
      if(!$this->Data->idUser)
        return redirect('mi-cuenta');
      $idc = $this->uri->segment(3);
      $this->data['cdata'] = $this->Cart->DataCartComplete($idc);
      if($this->Data->idUser != $this->data['cdata']->id_user)
        return redirect('mi-cuenta');
      $this->data['cartItems'] = $this->Cart->ListItems($idc);  
      $this->data['fdata'] = $this->Cart->DataJsonCart($idc);
      $this->load->helper('date');
      return $this->load->view('user/cart', $this->data);
    }
    
    if($section == 'step-2')
    {

      if($this->Data->idUser)
        return redirect('mi-cuenta');

      if(!$this->session->userdata('register-action') && !$this->Data->idUser)
        return redirect('mi-cuenta');
      if( $this->input->post('level') == 2 )
        $this->_userStep2();
      $fdata = $this->Cart->DataJsonCart($this->Cart->GetCart());
      if( $this->input->post('level') == 2 )
      {
        foreach($fdata as $key => $value)
        {
          if(isset($_POST[$key]))
            $fdata[$key] = $this->input->post($key);
        }
        if(!isset($_POST['newsletter'])) $fdata['newsletter'] = 0; 
        if(!isset($_POST['dextra'])) $fdata['dextra'] = 0;         
      }
      #die(print_r($fdata));
      $this->data['fdata'] = $fdata;
      return $this->load->view('user/step-2', $this->data); 
    }
    if($section == 'step-3')
    {
      if(!$this->Data->idUser)
        return redirect('mi-cuenta/step-2');
      if( $this->input->post('level') == 3 )
        $this->_userStep3(); 
      $this->data['fdata'] = $this->Cart->DataJsonCart($this->Cart->id);
      $this->data['cdata'] = $this->Cart->DataCart($this->Cart->id);
      return $this->load->view('user/step-3', $this->data); 
    }
    if($section == 'step-4')
    {
      if(!$this->Data->idUser)
        return redirect('mi-cuenta/step-2');
      if(!$this->session->userdata('cartId'))
        return redirect('mi-cuenta/step-2');
      $this->Cart->RefreshCartTotals();
      $this->data['cartItems'] = $this->Cart->ListItems();  
      $this->data['cdata'] = $this->Cart->DataCart($this->Cart->id);
      $this->data['fdata'] = $this->Cart->DataJsonCart($this->Cart->id);
      if($this->data['cdata']->coupon_1)
        $this->data['coupon1'] = $this->Data->GetCoupon($this->data['cdata']->coupon_1, 1);
      if( !$this->data['cdata']->id_payment || !$this->data['cdata']->id_shipping)
        return redirect('mi-cuenta/step-3');
      $this->data['cartItems'] = $this->Cart->ListItems();   
      /*if($this->data['cdata']->coupon_1)
        $this->data['coupon1'] = $this->Data->GetCoupon($this->data['cdata']->coupon_1, 1);
      if($this->data['cdata']->coupon_2)
        $this->data['coupon2'] = $this->Data->GetCoupon($this->data['cdata']->coupon_2, 2);*/
      return $this->load->view('user/step-4', $this->data); 
    }
    
    if($section == 'registro')
    {
      if($this->Data->idUser)
        return redirect('mi-cuenta/step-2');
      $this->session->set_userdata('register-action', $this->input->post('action'));
      return redirect('mi-cuenta/step-2');
    }
    if($section == 'login')
    {
      if($this->Data->idUser) 
        return redirect('mi-cuenta/step-2');
      $this->_userLogin();
    }
    if( $this->Data->idUser ) 
    {
      return $this->_userAccount();
    }
    $this->load->view('user/step-1', $this->data);
  }
  
  
  private function _userAccountDataXX()
  {
    if( !count($_POST)) return;
    $fieldsOB = true;
    $fieldsO = array('name_2', 'lastname_2', 'cel_2', 'dir1', 'city', 'cp');

    foreach($fieldsO as $f)
    {
      if( !$this->input->post($f) ) 
        $fieldsOB = false;
    }
    if( !$fieldsOB )
    {
      $this->data['openForm'] = true;
      return $this->data['error'] = 'fields';
    }

    $fdata = (object) $this->Cart->DataJsonCart($this->Cart->GetCart());

    $data = array(
      'name' => $fdata->name,
      'lastname' => $fdata->lastname,
      'name_2' => $this->input->post('name_2'),
      'lastname_2' => $this->input->post('lastname_2'),
      'cel_2' => $this->input->post('cel_2'),
      'mail' => $fdata->mail,
      'dni' => $fdata->dni,
      'cel' => $fdata->cel,
      'dir1' => $this->input->post('dir1'),
      'city' => $this->input->post('city'),
      'cp' => $this->input->post('cp'),
    );
    $this->UserM->SaveUserData($data);
    $data['privacy'] = $fdata->privacy;
    $data['newsletter'] = $fdata->newsletter;
    $this->Cart->SaveCartJsonData($data);
  }

  private function _userAccountDataXY()
  {
    if( !count($_POST)) return;
    $fieldsOB = true;
    $fieldsO = array('mail', 'name', 'lastname', 'dni');

    foreach($fieldsO as $f)
    {
      if( !$this->input->post($f) ) 
        $fieldsOB = false;
    }
    if( !$fieldsOB )
    {
      $this->data['openFormY'] = true;
      return $this->data['errorY'] = 'fields';
    }

    $this->load->helper('email');
    if( !valid_email($this->input->post('mail')) )
    {
      $this->data['openFormY'] = true;
      return $this->data['errorY'] = 'mail';
    }

    if($this->UserM->MailExists($this->input->post('mail'), $this->Data->idUser))
    {
      $this->data['openFormY'] = true;
      return $this->data['errorY'] = 'mail2';
    }

    $fdata = (object) $this->Cart->DataJsonCart($this->Cart->GetCart());

    $data = array(
      'name' => $this->input->post('name'),
      'lastname' => $this->input->post('lastname'),
      'name_2' => isset($fdata->name_2) ? $fdata->name_2 : $this->input->post('name'),
      'lastname_2' => isset($fdata->lastname_2) ? $fdata->lastname_2 : $this->input->post('lastname'),
      'cel_2' => isset($fdata->cel_2) ? $fdata->cel_2 : $this->input->post('cel'),
      'mail' => $this->input->post('mail'),
      'dni' => $this->input->post('dni'),
      'cel' => $fdata->cel,
      'dir1' => $fdata->dir1,
      'city' => $fdata->city,
      'cp' => $fdata->cp,
    );
    $this->UserM->SaveUserData($data);
    $data['privacy'] = $fdata->privacy;
    $data['newsletter'] = $fdata->newsletter;
    $this->Cart->SaveCartJsonData($data);
  }

  private function _userAccountData()
  {
    if( !count($_POST)) return;
    $fieldsOB = true;
    $fieldsO = array('mail', 'name', 'lastname', 'mail', 'cel', 'dir1', 'city', 'cp', 'dni');

    foreach($fieldsO as $f)
    {
      if( !$this->input->post($f) ) 
        $fieldsOB = false;
    }
    if( !$fieldsOB )
      return $this->data['error'] = 'fields';

    if(!$this->input->post('privacy'))
      return $this->data['error'] = 'privacy';

    $this->load->helper('email');
    if( !valid_email($this->input->post('mail')) )
      return $this->data['error'] = 'mail';

    if($this->UserM->MailExists($this->input->post('mail'), $this->Data->idUser))
      return $this->data['error'] = 'mail2';

    $fdata = (object) $this->Cart->DataJsonCart($this->Cart->GetCart());
    $data = array(
      'name' => $this->input->post('name'),
      'lastname' => $this->input->post('lastname'),
      'name_2' => isset($fdata->name_2) ? $fdata->name_2 : $this->input->post('name'),
      'lastname_2' => isset($fdata->lastname_2) ? $fdata->lastname_2 : $this->input->post('lastname'),
      'cel_2' => isset($fdata->cel_2) ? $fdata->cel_2 : $this->input->post('cel'),
      'mail' => $this->input->post('mail'),
      'dni' => $this->input->post('dni'),
      'cel' => $this->input->post('cel'),
      'dir1' => $this->input->post('dir1'),
      'city' => $this->input->post('city'),
      'cp' => $this->input->post('cp'),
    );
    $this->UserM->SaveUserData($data);
    $data['privacy'] = $this->input->post('privacy');
    $data['newsletter'] = $this->input->post('newsletter');
    $this->Cart->SaveCartJsonData($data);
  }

  private function _userAccountPassword()
  {
    if(!$this->input->post('old_password') || !$this->input->post('password') || !$this->input->post('password2'))
      return $this->data['errorP'] = 'fields';
    if($this->input->post('password') != $this->input->post('password2'))
      return $this->data['errorP'] = 'password';
    $data = $this->UserM->DataUser();
    if($this->input->post('old_password') != $data->password)
      return $this->data['errorP'] = 'password_old';
    $this->UserM->SaveUserData(array('password' => $this->input->post('password')));
    unset($_POST);
    $this->data['errorP'] = 'password_ok';
  }

  private function _userAccount()
  {
    if($this->input->post('action') == 'password')
    {
      $this->_userAccountPassword();
    }
    $fdata = $this->Cart->DataJsonCart($this->Cart->GetCart());
    if( $this->input->post('action') == 'data' )
    {
      $this->_userAccountData();
      foreach($fdata as $key => $value)
      {
        if(isset($_POST[$key]))
          $fdata[$key] = $this->input->post($key);
      }
      if(!isset($_POST['newsletter'])) $fdata['newsletter'] = 0; 
      if(!isset($_POST['dextra'])) $fdata['dextra'] = 0;       
    }
    if( $this->input->post('action') == 'dataxx' )
    {
      $this->_userAccountDataXX();
      foreach($fdata as $key => $value)
      {
        if(isset($_POST[$key]))
          $fdata[$key] = $this->input->post($key);
      }         
      $this->data['fdata'] = $fdata;
      $this->data['cdata'] = $this->Cart->DataCart($this->Cart->id);
      return $this->load->view('user/step-3', $this->data); 
    }
    if( $this->input->post('action') == 'dataxy' )
    {
      $this->_userAccountDataXY();
      foreach($fdata as $key => $value)
      {
        if(isset($_POST[$key]))
          $fdata[$key] = $this->input->post($key);
      }         
      $this->data['fdata'] = $fdata;
      $this->data['cdata'] = $this->Cart->DataCart($this->Cart->id);
      return $this->load->view('user/step-3', $this->data); 
    }
    $this->load->helper('date');
    $this->data['carts'] = $this->Cart->GetCarts();
    $this->data['fdata'] = $fdata;
    $this->load->view('user/account', $this->data);
  }

  private function _userPayment()
  {
    #die(print_r($this->input->get()));
    if($this->input->get('response') != 1)
      return $this->data['error'] = 'process';
    $hash = md5( $this->input->get('orderid') ."|". $this->input->get('amount') ."|". $this->input->get('response')."|". $this->input->get('transactionid')."|". $this->input->get('avsresponse')."|". $this->input->get('cvvresponse')."|". $this->input->get('time')."|{$this->keyGG}");
    if($this->input->get('hash') != $hash)
      return $this->data['error'] = 'security';
    $fdata = $this->Cart->DataJsonCart($this->Cart->GetCart());
    $fdata['payment_authcode'] = $this->input->get('authcode');
    $this->Cart->SaveCartJsonData($fdata);
    $this->session->unset_userdata('cartCCPayment');
    $data = array();
    $data['id_state'] = 3;
    $this->Cart->SaveCartData($data);
    $this->_mailCart();
    $list = $this->session->userdata('wedding-list');
    $this->Cart->EndCart();
    if($list)
      $this->weddingws($this->Cart->id);
    redirect('mi-cuenta/finish');
  }
  
  private function _userStep3()
  {
    if(!count($_POST)) return;
    $fieldsOB = true;
    $fieldsO = array('shipping', 'payment');
    foreach($fieldsO as $f)
    {
      if( !$this->input->post($f) ) 
        $fieldsOB = false;
    }
    if( !$fieldsOB )
      return $this->data['error'] = 'fields';


    if($this->input->post('coupon_1'))
    {
      $status =  $this->Data->GetStatusCoupon($this->input->post('coupon_1'), 1);
      if($status == 0)
        return $this->data['error2'] = 'coupon_1_invalid';
      if($status == 1)
        return $this->data['error2'] = 'coupon_1_inactive';
      if($status == 2)
        return $this->data['error2'] = 'coupon_1_empty';
    }
    /*
    if($this->input->post('coupon_1'))
    {
      $status =  $this->Data->GetStatusCoupon($this->input->post('coupon_1'), 1);
      if($status == 0)
        return $this->data['error2'] = 'coupon_1_invalid';
      if($status == 1)
        return $this->data['error2'] = 'coupon_1_inactive';
      if($status == 2)
        return $this->data['error2'] = 'coupon_1_empty';
    }
    if($this->input->post('coupon_2'))
    {
      $status =  $this->Data->GetStatusCoupon($this->input->post('coupon_2'), 2);
      if($status == 0)
        return $this->data['error2'] = 'coupon_2_invalid';
      if($status == 1)
        return $this->data['error2'] = 'coupon_2_inactive';
      if($status == 2)
        return $this->data['error2'] = 'coupon_2_empty';
    }*/
    $data = array();
    /*foreach($fieldsO as $f)
      $data[$f] = $this->input->post($f);*/
    $data['id_shipping'] = $this->input->post('shipping');
    $data['id_payment'] = $this->input->post('payment');
    /*$data['id_store'] = ($this->input->post('id_shipping') == 2 ) ? $this->input->post('id_store') : 0;
    $data['coupon_1'] = $this->input->post('coupon_1');
    $data['coupon_2'] = $this->input->post('coupon_2');*/

    $data['coupon_1'] = $this->input->post('coupon_1');
    $data['comments'] = $this->input->post('comments');
    $this->Cart->SaveCartData($data);
    $this->Cart->RefreshCartTotals();
    redirect('mi-cuenta/step-4');
  }
  
  private function _userStep2()
  {
    if( !count($_POST)) return;
    $fieldsOB = true;
    $fieldsO = array('mail', 'name', 'lastname', 'mail', 'cel', 'dir1', 'city', 'cp', 'dni');
    if(!$this->Data->idUser && $this->session->userdata('register-action') == 2)
    {
      $fieldsO[] = 'password';
      $fieldsO[] = 'password2';
    }
    foreach($fieldsO as $f)
    {
      if( !$this->input->post($f) ) 
        $fieldsOB = false;
    }
    if( !$fieldsOB )
      return $this->data['error'] = 'fields';

    /*if(!$this->input->post('privacy'))
      return $this->data['error'] = 'privacy';
      */
    if(!$this->Data->idUser)
    {
      if($this->input->post('password') != $this->input->post('password2'))
        return $this->data['error'] = 'password';
    }
      
    $this->load->helper('email');
    if( !valid_email($this->input->post('mail')) )
      return $this->data['error'] = 'mail';
    if($this->session->userdata('register-action') != 1)
    {
      if($this->UserM->MailExists($this->input->post('mail'), $this->Data->idUser))
        return $this->data['error'] = 'mail2';
    }
    
    $data = array(
      'name' => $this->input->post('name'),
      'lastname' => $this->input->post('lastname'),
      'mail' => $this->input->post('mail'),
      'cel' => $this->input->post('cel'),
      'dir1' => $this->input->post('dir1'),
      'city' => $this->input->post('city'),
      'cp' => $this->input->post('cp'),
      'dni' => $this->input->post('dni'),
    );

    if(!$this->Data->idUser)
    {
      if($this->session->userdata('register-action') == 2)
      {
        $data['password'] = $this->input->post('password');
        $data['id_state'] = 1;
        /*$html = $this->load->view("mail/register", array('data' => $data), true);
        $this->load->library('PHPMailer');
        $mail = new PHPMailer();
        $mail->IsSMTP();
        $mail->SMTPAuth   = true;
        $mail->SMTPSecure   = "tls";
        $mail->Host       = "smtp.gmail.com";
        $mail->Port       = 587;
        $mail->Username   = $this->config->item('client-mail', 'app');
        $mail->Password   = $this->config->item('client-mail-password', 'app');  
        $mail->From = $this->config->item('client-mail', 'app');
        $mail->FromName = $this->config->item('client', 'app');
        $mail->AddAddress($data['mail']);
        $mail->Subject = "Registro de cuenta";
        $mail->IsHTML(true);
        $mail->Body = $html;
        @$mail->Send();*/
      }
      else
      {
        $data['id_state'] = 3;
      }      
    }
    $this->UserM->SaveUserData($data);
    $this->Cart->UpdateCartUser();
    $data['password2'] = $this->input->post('password2');
    $data['privacy'] = $this->input->post('privacy');
    $data['dextra'] = $this->input->post('dextra');
    $data['newsletter'] = $this->input->post('newsletter');
    /*if($this->input->post('dextra'))
    {
      $data['name_2'] = 
      $data['lastname_2'] = 
      $data['dir1_2'] = 
      $data['dir2_2'] = 
#      $data['cp_2'] = 
      $data['city_2'] = '';
    }*/
    /*
    if($this->input->post('newsletter'))
      $this->UserM->AddToNewsletter($this->input->post('mail'));
    else
      $this->UserM->RemoveFromNewsletter($this->input->post('mail'));*/
    $this->Cart->SaveCartJsonData($data);
    $this->UserM->UpdateCartActive( $this->Cart->id );
    redirect('mi-cuenta/step-3');
  }  
  
  private function _userLogin()
  {
    if( !count($_POST)) return;
    if( !$this->input->post('mail') || !$this->input->post('password') )
      return $this->data['error'] = 'fields';
    $this->load->helper('email');
    if( !valid_email($this->input->post('mail')) )
      return $this->data['error'] = 'mail';
    $loginRet = $this->UserM->Login($this->input->post('mail'), $this->input->post('password'));
    if($loginRet != 'ok')
      return $this->data['error'] = $loginRet;
    $this->session->set_userdata('userID', $this->UserM->idUser);
    $this->Cart->idu = $this->Data->userID = $this->UserM->idUser;
    $data = $this->UserM->DataUser(); 
    if( $this->session->userdata('cartId') )
    {
      //$this->Cart->JoinCarts();
      $this->Cart->UpdateCartUser(); 
      $this->UserM->UpdateCartActive( $this->session->userdata('cartId') ); 
    }
    elseif( $data->id_cart_active )
    {
      $dc = $this->Cart->DataCart($data->id_cart_active);
      if( $dc->id_state == 1 )
      {
        $this->session->set_userdata('cartId', $data->id_cart_active);
        $this->Cart->id = $data->id_cart_active;
        //$this->Cart->JoinCarts();      
        $this->Cart->UpdateCartUser(); 
        $this->UserM->UpdateCartActive( $this->session->userdata('cartId') ); 
      }
    }/*
    if( $this->session->userdata('wishId') )
    {
      $this->Wish->JoinWish();
      $this->Wish->UpdateWishUser(); 
      $this->UserM->UpdateWishActive( $this->session->userdata('wishId') ); 
    }
    elseif( $data->id_wish_active )
    {
      $dc = $this->Wish->DataWish($data->id_wish_active);
      $this->session->set_userdata('wishId', $data->id_wish_active);
      $this->Wish->id = $data->id_wish_active;
      $this->Wish->JoinWish();      
      $this->Wish->UpdateWishUser(); 
      $this->UserM->UpdateWishActive( $this->session->userdata('wishId') ); 
    }*/
    redirect('mi-cuenta/step-3');
  }
  
}