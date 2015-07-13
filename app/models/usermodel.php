<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class UserModel extends CI_Model
{
  public 
    $idUser = 0;
    
  function Login( $mail = '', $pass = '' )
  {
    $this->idUser = 0;
    $sql = "select * from user where mail ='{$mail}'";
    $row = $this->db->query($sql)->row();
    if(!$row) return 'noexists';
    if($row->id_state != 1) return 'state';
    if($row->password != $pass) return 'password';
    $this->idUser = $row->id_user;
    return 'ok';
  }
  
  function UpdateCartActive( $cart = 0 )
  {
    $sql = "update user set id_cart_active = '{$cart}' where id_user = '{$this->idUser}'";
    return $this->db->query($sql);
  }
  
  function UpdateWishActive( $wish = 0 )
  {
    $sql = "update user set id_wish_active = '{$wish}' where id_user = '{$this->idUser}'";
    return $this->db->query($sql);
  }
  
  function DataUser()
  {
    $sql = "select * from user where id_user = '{$this->idUser}'";
    return $this->db->query($sql)->row();
  }
  
  function DataUserComplete()
  {
    $sql = "select u.*, t1.treatment as treatment1, t2.treatment as treatment2, c1.country as country1, c2.country as country2
    from user u
    left join user_treatment t1 on t1.id_treatment = u.id_treatment
    left join user_treatment t2 on t2.id_treatment = u.id_treatment_2
    left join country c1 on c1.id_country = u.id_country
    left join country c2 on c2.id_country = u.id_country_2
    where u.id_user = '{$this->idUser}'";
    return $this->db->query($sql)->row();
  }  
  
  function AddToNewsletter( $mail = '' )
  {
    $sql = "select count(*) as total from newsletter where mail ='{$mail}'";
    if($this->db->query($sql)->row()->total > 0) return;
    $sql = $this->db->insert_string('newsletter', array('mail' => $mail));
    $this->db->query($sql);    
  }
  
  function RemoveFromNewsletter( $mail = '' )
  {
    $sql = "delete from newsletter where mail ='{$mail}'";
    $this->db->query($sql);
  }
  
  function MailExists( $mail = '', $id = 0 )
  {
    $sql = "select count(*) as total from user where mail ='{$mail}' and id_user != '{$id}' and id_state = '1'";
    return ($this->db->query($sql)->row()->total > 0);
  }
  
  function SaveUserData( $data = array() )
  {
    if($this->idUser)
    {
      $sql = $this->db->update_string('user', $data,  "id_user = '{$this->idUser}'");
    }
    else
    {
      $sql = $this->db->insert_string('user', $data);
    }
    $this->db->query($sql);
    if(!$this->idUser)
    {
      $this->idUser = $this->db->insert_id();
      $this->session->set_userdata('userID', $this->idUser);
    }
    return $this->idUser;
  }  
  
}