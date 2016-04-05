<?php
if(!defined('BASEPATH')) exit('No direct script access allowed');

class User_model extends CI_Model{

  function __construct()
  {
    parent::__construct();
  }

  function Save($data)
  {
    $data['passw'] = password_hash($data['passw'], PASSWORD_DEFAULT);
    $this->db->insert('users',$data);
    $userID = $this->db->insert_id();
    if($userID)
    {
      return $this->GetUser($userID);
    }
    else
    {
      return false;
    }
  }

  function Update($data)
  {
    $data['passw'] = password_hash($data['passw'], PASSWORD_DEFAULT);
    $this->db->where('id', $this->session->userdata('id'));
    $this->db->update('users', $data);
  }

  function Login($data)
  {
    $this->db->select('*')->from('users')->where('email',$data['email']);
    $results = $this->db->get()->result();

    return $results;
  }

  public function GetUser($id)
  {
    $this->db->select('*')->from('users')->where('id',$id);
    $result = $this->db->get()->result();

    if($result)
    {
      return $result[0];
    }
    else
    {
      return false;
    }
  }
}
