<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	public function index()
	{
		$data = array(
			'page_title'   => 'Usando template parser',
			'content_title' => 'Nomes e Emails',
			'list_entries' => array(
				array('name' => 'User 1', 'email' => 'user@mail.com'),
				array('name' => 'User 2', 'email' => 'user_2@mail.com'),
				array('name' => 'User 3', 'email' => 'user_3@mail.com'),
				array('name' => 'User 4', 'email' => 'user_4@mail.com')
			)
		);

		$nouser_list_template = "<li>{name} - {email}</li>";
		$nousers = array(
			array('name' => 'No User 1', 'email' => 'no_user@mail.com'),
			array('name' => 'No User 2', 'email' => 'no_user_2@mail.com'),
			array('name' => 'No User 3', 'email' => 'no_user_3@mail.com'),
			array('name' => 'No User 4', 'email' => 'no_user_4@mail.com')
		);

		$base_list = "<ul>";
		foreach ($nousers as $user)
		{
			$base_list .= $this->parser->parse_string($nouser_list_template, $user, TRUE);
		}
		$base_list .= "</ul>";

		$data["no_users"] = $base_list;
		$data["no_users_title"] = 'Não Usuários';

		$this->parser->parse('welcome_message',$data);
	}
}
