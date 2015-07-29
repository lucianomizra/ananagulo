<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Cart extends AppController
{

  public function index( $action = '' )
  {
    if($action == 'add')
    {
      $product = round($this->input->post('id'));
      if(!$product)
        $product = round($this->uri->segment(3,0)); 
      if( !$product ) 
      {
        if(AJAX) exit;
        return redirect("cart");
      }
      $this->session->unset_userdata('checkout');
      $color = round($this->input->post('color'));
      $items = round($this->input->post('items'));
      $size = $this->input->post('size');
      $result = $this->Cart->AddItem($product, $items, $color, $size);  
      $return = $this->input->post('return');      
      if($return && $result) 
      {
        return redirect('cart/items/' . $result);
      }
      if(AJAX && !$return) exit;
      return redirect("cart");
    }
    
    if($action == 'tpv-ok')
    {
      if(!$this->input->get('Ds_Response') || !$this->input->get('Ds_Signature'))
        return $this->index('tpv-ko');

      $response = $this->input->get('Ds_Response');
      $ss = $this->input->get('Ds_Signature');
      $amount = $this->input->get('Ds_Amount');
      $code = '333647345';
      $order = $this->input->get('Ds_Order');
      $currency = '978';
      $transactionType = 0;
      $terminal = '001';
      $clave = '4Q86OG5PN99QS567';
      $message = $amount.$order.$code.$currency.$response.$clave;
      $signature = strtoupper(sha1($message));

      if($ss != $signature)
      {        
        return $this->index('tpv-ko');
      }

      $data = array(
        'modified' => date('Y-m-d H:i:s'),
        'code' => $this->Cart->GetMaxCode(),
        'payment_data' => json_encode($_GET)
      );
      $this->Cart->SaveCartData($data);
      $this->session->set_userdata('cart-ok-amout', $amount);
      return $this->cartClose();
    } 

    if($action == 'contrareembolso')
    {
      $this->data['cdata'] = $this->Cart->DataCart($this->Cart->id);
      if($this->data['cdata']->id_payment != 5)
      {
        $this->data['error'] = 'El pedido no tiene seleccionado forma de pago contrareembolso';
        return $this->index('tpv-ko');
      }
      $data = array(
        'modified' => date('Y-m-d H:i:s'),
        'code' => $this->Cart->GetMaxCode()
      );
      $this->Cart->SaveCartData($data);
      return $this->cartClose();
    } 

    if($action == 'tpv')
    {
      return redirect('mi-cuenta/step-4');      
    } 

    if($action == 'nzfinish')
    {
      return $this->cartClose();
    } 

    if($action == 'tpv-ko')
    {      
      if(!$this->Cart->id)
        return redirect('mi-cuenta/step-2');
      if(!$this->Data->idUser)
        return redirect('mi-cuenta/step-2');
      if(!$this->session->userdata('cartId'))
        return redirect('mi-cuenta/step-2');

    $this->load->model('UserModel', 'UserM');
    $this->UserM->idUser = $this->Data->idUser;
      $this->data['cdata'] = $this->Cart->DataCart($this->Cart->id);
      $this->data['fdata'] = $this->Cart->DataJsonCart($this->Cart->id);
      if( !$this->data['cdata']->id_payment || !$this->data['cdata']->id_shipping)
        return redirect('mi-cuenta/step-3');
      return $this->load->view('user/tpv-ko', $this->data);
    }

    if($action == 'finalizado')
    {      
      /*if(!$this->Cart->id)
        return redirect('mi-cuenta/step-2');*/
      return $this->load->view('user/end', $this->data);
    }

    if($action == 'session')
    {
      if(AJAX)
      {
        return $this->load->view('cart/session', $this->data);
      }
      return redirect("cart");
    }
    
    if($action == 'remove')
    {
      $iditem = round($this->input->post('id'));
      if(!$iditem)
        $iditem = round($this->uri->segment(3,0)); 
      $this->Cart->RemoveItem($iditem); 
      return redirect("cart");
    }
    /*if($action == 'more')
    {
      $iditem = round($this->input->post('id'));
      if(!$iditem)
        $iditem = round($this->uri->segment(3,0)); 
      $this->Cart->MoreItem($iditem); 
      return redirect("cart/items/{$iditem}");
    }*/
    
    if($action == 'change-items')
    {
      $iditem = round($this->input->post('id'));
      $count = round($this->input->post('items'));
      if(!$count)
        $count = 1;
      if(!$iditem)
        $iditem = round($this->uri->segment(3,0)); 
      $this->Cart->ItemsItem($iditem, $count); 
      return;
      return redirect("cart/items/{$iditem}");
    }
    
    if($action == 'color')
    {
      $iditem = round($this->input->post('id'));
      $color = round($this->input->post('color'));
      $result = $this->Cart->ChangeColor($iditem, $color); 
      return;
      if(!$result) return redirect("cart");
      return redirect("cart/items/{$iditem}");
    }
    if($action == 'size')
    {
      $iditem = round($this->input->post('id'));
      $size = $this->input->post('size');
      $result = $this->Cart->ChangeSize($iditem, $size); 
      return;
      if(!$result) return redirect("cart");
      return redirect("cart/items/{$iditem}");
    }
    
    $this->cartList();
  }
  
  private function cartClose()
  {
    $this->load->model('UserModel', 'UserM');
    $this->UserM->idUser = $this->Data->idUser;
    if(!$this->cartShipping()) return;
    $this->session->unset_userdata('cart-ok-amout');
    $this->load->library('PHPMailer');
    $this->session->unset_userdata('cart-ok');
    $mail = new PHPMailer();
    $mail->From = $this->config->item('client-mail', 'app');
    $mail->FromName = $this->config->item('client', 'app');

    $this->data['fdata'] = $this->Cart->DataJsonCart($this->Cart->id);
    $this->data['cdata'] = $this->Cart->DataCartComplete($this->Cart->id);
    $this->data['cartItems'] = $this->Cart->ListItems();
    $mail->AddAddress($this->data['fdata']['mail']);
    $mail->IsHTML(true);
    $this->load->helper('date');
    $mensaje = $this->load->view('cart/mail', $this->data, true);  
    $mail->Subject  = 'Pedido ' . str_pad($this->data['cdata']->code, 6, "0", STR_PAD_LEFT);
    $mail->Body  =  $mensaje;
    @$mail->Send();    
    $mail = new PHPMailer();
    $mail->From = $this->config->item('client-mail', 'app');
    $mail->FromName = $this->config->item('client', 'app');
    $mail->AddAddress('hola@anaangulo.com');
    $mail->AddBcc('juan@identty.com');
    $mail->AddBcc('antonio@identty.com');
    $mail->IsHTML(true);
    $this->load->helper('date');
    $mail->Subject  = 'Pedido ' . str_pad($this->data['cdata']->code, 6, "0", STR_PAD_LEFT);
    $mail->Body  =  $mensaje;
    $mail->AddAttachment(FCPATH . "pdf/{$this->Cart->id}.pdf", 'Etiquetas_Zeleris.pdf');
    @$mail->Send();
    $this->Cart->EndCart();
    return redirect('cart/finalizado');
  }

  private function cartTag( $expedicion = '' )
  {
    $requestParams = array(
      'usuario' => 'takezo_p', #takezo_t
      'clave' => 'hBXlqzCvV8', #lRaFrOyoc8
      'origen' => '008',
      'expedicion' => $expedicion,
      'bulto' => '',
      'formato' => 'PDF'
    );
    $client = new SoapClient('https://wscli.zeleris.com/EXPDatos.asmx?wsdl', array('cache_wsdl' => 0, 'soap_version' => SOAP_1_1, 'trace' => 1));
    $response = $client->EtiquetaEXP($requestParams);
    $xml = simplexml_load_string($response->EtiquetaEXPResult);
    file_put_contents(FCPATH . "pdf/{$this->Cart->id}.pdf" , base64_decode($xml->expedicion->datos_etiqueta->label_data));
  }

  private function cartShipping()
  {    

    $dataf = $this->Cart->DataJsonCart($this->Cart->id);
    $data = $this->Cart->DataCart($this->Cart->id);

    #if( $data->id_shipping != 1 &&  $data->id_shipping != 2 ) return true;
    #$items = $this->Cart->ListItems();
    
    $ccdata = $this->Cart->DataCart($this->Cart->id);
    $total = $ccdata->total;
    /*$cost = 0;
    foreach($items as $item)
    {
      $cost = $item->items * $item->cost;
      $total += $item->items;
    }*/
    $reembolso = 0;
    if( $data->id_payment == 5 )
    {
      $reembolso = number_format($total,2,',','');   
    }
    $requestParams = array(
      'usuario' => 'takezo_p', #takezo_t
      'clave' => 'hBXlqzCvV8', #lRaFrOyoc8
      'codigo_rte' => '000802467',
      'nombre_rte' => 'Ana Angulo',
      'direccion_rte' => 'C/ROSELLON 222',
      'poblacion_rte' => 'BARCELONA',
      'codpos_rte' => '08008',
      'nifdni_rte' => '',
      'contacto_rte' => '',
      'telefono_rte' => '',
      'nombre_cons' => $dataf['name'] . ' ' . $dataf['lastname'],
      'direccion_cons' => $dataf['dir1'],
      'poblacion_cons' => $dataf['city'],
      'pais_cons' => '',
      'codpos_cons' => substr($dataf['cp'], 0, 7),
      'nifdni_cons' => substr($dataf['dni'], 0, 20),
      'contacto_cons' => '',
      'telefono1_cons' => $dataf['cel'],
      'telefono2_cons' => '',
      'observ_cons' => $data->comments,
      'mercan' => '',
      'referencia' => '',
      'bultos' => 1,
      'kilos' => '1',
      'volumen' => '0',
      'ml' => '',
      'servicio' => '3',
      'codigo_fac' => '',
      'tipo_portes' => 'P',
      'tipo_reemb' => 'P',
      'reembolso' => $reembolso,
      'valor_seguro' => 0,
    );    
    $client = new SoapClient('https://wscli.zeleris.com/EXPPeticion.asmx?wsdl', array('cache_wsdl' => 0, 'soap_version' => SOAP_1_1, 'trace' => 1));
    $response = $client->DocumentarExpedicion($requestParams);
    if( !$response || !isset($response->DocumentarExpedicionResult))
      $response = false;
    else
      $response = simplexml_load_string($response->DocumentarExpedicionResult);
    if( !$response || !isset($response->resultado) || $response->resultado != 'OK')
    {
      if(isset($response->mensaje))
        $this->data['error'] = utf8_decode($response->mensaje);
      return $this->index('tpv-ko');
    }

    $data = array(
      'modified' => date('Y-m-d H:i:s'),
      'shipping_data' => json_encode($response)
    );
    $this->Cart->SaveCartData($data);
    $this->cartTag($response->expedicion);
    return true;
  }

  public function cartList()
  {
    $total = $this->Cart->Items();
    $this->load->helper('form');
    $this->load->helper('string');
    $this->data['totalProducts'] = $total;
    $this->data['highlight'] = round($this->uri->segment(3,0));  
    $this->data['cartItems'] = $this->Cart->ListItems();   
    $this->load->view('cart/list', $this->data);
  }  
  
}