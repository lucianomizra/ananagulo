<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once APPPATH . 'third_party/Paypal/bootstrap.php';

use PayPal\Rest\ApiContext;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Api\Amount;
use PayPal\Api\Details;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\RedirectUrls;
use PayPal\Api\Transaction;
use PayPal\Api\PaymentExecution;

class PaypalModel extends CI_Model
{
  public 
    $error = '';

  public function  getApiContext() 
  {
    $apiContext = new ApiContext(new OAuthTokenCredential(
      'AZoYUpdWPTAnYseIyuDKCcKir-Gvx5E8aOrpkrolkLLnAs1PeBuei7m3c2srPaJJ-zcyy6dcCfUc3YnO',
      'EAsgWFSkbwx0hoXfAnTPjEBKRbfdCtmDubTcVtFfmpu_f2g0mXkR0xQBE8PZB1ZtSyzusapWJNoSyQJS'
    ));

    $apiContext->setConfig(array(
      'http.ConnectionTimeOut' => 30,
      'http.Retry' => 1,
      'mode' => 'sandbox',
      'log.LogEnabled' => true,
      'log.FileName' => '../PayPal.log',
      'log.LogLevel' => 'INFO'    
    ));

    return $apiContext;
  }

  public function ExecutePayment( $paymentId = 0, $payerId = 0 )
  {
    $apiContext = $this->getApiContext();
    try{
      $payment = Payment::get($paymentId, $apiContext);      
    }
    catch (Exception $ex) {
      $this->error =  $ex->getMessage();
      return false;
    }
    $dataP = json_decode($payment->toJSON());
    if($dataP->payer->payer_info->payer_id != $payerId)
    {
      $this->error = 'Los datos son inválidos';
      return false;
    }
    if($dataP->state == 'approved')
    {
      $this->error = 'El pedido ya fue pagado';
      return false;
    }
    if(!$dataP->state == 'created')
    {
      $this->error = 'El pedido no ya fue aprobado';
      return false;
    }
    try{
      $paymentExecution = new PaymentExecution();
      $paymentExecution->setPayerId($payerId);  
      $payment = $payment->execute($paymentExecution, $apiContext); 
    }
    catch (Exception $ex) {
      $this->error =  $ex->getMessage();
      return false;
    }
    return $payment->toJSON();
  }
  
  public function CreatePayment( $items = false, $data = false)
  {    
    $apiContext = $this->getApiContext();
    #die(print_r($data));
    // ### Payer
    // A resource representing a Payer that funds a payment
    // For paypal account payments, set payment method
    // to 'paypal'.
    $payer = new Payer();
    $payer->setPaymentMethod("paypal");

    // ### Itemized information
    // (Optional) Lets you specify item wise
    // information
    $cart = array();
    $total = 0;
    /*foreach($items as $item)
    {
      $itemC = new Item();
      $itemC->setName($item->name)
          ->setCurrency('EUR')
          ->setQuantity($item->items)
          ->setSku($item->code ? $item->code : $item->id)
          ->setPrice(round($item->cost,2));
      $cart[] = $itemC;
      $total += $item->items * $item->cost;
    }

    $itemList = new ItemList();
    $itemList->setItems($cart);*/

    // ### Additional payment details
    // Use this optional field to set additional
    // payment information such as tax, shipping
    // charges etc.
    $details = new Details();
    $details
        ->setTax(round($data->tax,2))
        ->setSubtotal(round($data->subtotal,2));

    // ### Amount
    // Lets you specify a payment amount.
    // You can also specify additional details
    // such as shipping, tax.
    $amount = new Amount();
    $amount->setCurrency("EUR")
        ->setTotal(round($data->total,2))
        ->setDetails($details);

    // ### Transaction
    // A transaction defines the contract of a
    // payment - what is the payment for and who
    // is fulfilling it. 
    $transaction = new Transaction();
    $transaction->setAmount($amount)
        #->setItemList($itemList)
        ->setDescription("Compra actual - ". round($data->total,2) . " EUR")
        ->setInvoiceNumber(uniqid());

    // ### Redirect urls
    // Set the urls that the buyer must be redirected to after 
    // payment approval/ cancellation.
    $baseUrl = base_url();
    $redirectUrls = new RedirectUrls();
    $redirectUrls->setReturnUrl("{$baseUrl}cart/paypal?success=true")
        ->setCancelUrl("{$baseUrl}cart/paypal-ko");

    // ### Payment
    // A Payment Resource; create one using
    // the above types and intent set to 'sale'
    $payment = new Payment();
    $payment->setIntent("sale")
        ->setPayer($payer)
        ->setRedirectUrls($redirectUrls)
        ->setTransactions(array($transaction));


    // ### Create Payment
    // Create a payment by calling the 'create' method
    // passing it a valid apiContext.
    // (See bootstrap.php for more on `ApiContext`)
    // The return object contains the state and the
    // url to which the buyer must be redirected to
    // for payment approval
    try {
        $payment->create($apiContext);
    } catch (Exception $ex) {
        // NOTE: PLEASE DO NOT USE RESULTPRINTER CLASS IN YOUR ORIGINAL CODE. FOR SAMPLE ONLY
        die(print_r($ex->getData()));
        exit(1);
    }

    // ### Get redirect url
    // The API response provides the url that you must redirect
    // the buyer to. Retrieve the url from the $payment->getApprovalLink()
    // method
    $approvalUrl = $payment->getApprovalLink();

    // NOTE: PLEASE DO NOT USE RESULTPRINTER CLASS IN YOUR ORIGINAL CODE. FOR SAMPLE ONLY
    redirect($approvalUrl);

    return $payment;

  }
    
}