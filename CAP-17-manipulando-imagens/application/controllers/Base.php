<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Base extends CI_Controller {

	public function index()
	{
		$this->load->view('home');
	}

	public function Upload()
	{
		if (!$this->upload->do_upload('image'))
		{
			$data['info'] = $this->upload->display_errors();			
		}
		else
		{
			$data['info'] = "Imagem enviada com sucesso!";
			$data['info_upload'] = $this->upload->data();
		}
		$this->load->view('home', $data);
	}
}
