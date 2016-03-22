<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	public function index()
	{
		$mail = new PHPMailer;

		$mail->setFrom('from@example.com', 'Mailer');
		$mail->addAddress('joe@example.net', 'Joe User'); 

		$mail->isHTML(true);

		$mail->Subject = 'Livro CodeIgniter';
		$mail->Body    = 'Estou estudando o <b>capítulo 18!</b>';

		if(!$mail->send()) {
		    echo 'Email não enviado.';
		    echo 'Erro: ' . $mail->ErrorInfo;
		} else {
		    echo 'Email enviado';
		}
	}
}
