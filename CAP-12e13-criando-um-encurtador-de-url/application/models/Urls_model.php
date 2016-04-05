<?php
if(!defined('BASEPATH')) exit('No direct script access allowed');

class Urls_model extends CI_Model{

  function __construct()
  {
    parent::__construct();
  }

  function GenerateUniqueCode()
  {
    do
    {
      $code = random_string('alnum',8);
      $this->db->from('urls')->where('code',$code);
      $num = $this->db->count_all_results();
    }
    while($num >= 1);

    return $code;
  }

  function Save($data)
  {
    $data['code'] = $this->GenerateUniqueCode();
    $this->db->insert('urls',$data);

    if($this->db->insert_id())
    {
      return $data['code'];
    }
    else
    {
      return false;
    }
  }

  function Fetch($url_code)
  {
    $this->db->select('*')->from('urls')->where('code',$url_code)->limit(1);
    $result = $this->db->get()->result();

    if($result)
    {
      return $result[0]->address;
    }
    else
    {
      return false;
    }
  }

  function GetAllByUser($user_id)
  {
    $this->db->select('*')->from('urls')->where('user_id',$user_id);
    $result = $this->db->get()->result();
    if($result)
    {
      return $result;
    }
    else
    {
      return false;
    }
  }
}
