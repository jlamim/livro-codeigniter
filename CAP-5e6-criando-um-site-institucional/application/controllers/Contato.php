<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Contato extends CI_Controller {

    function __construct()
    {
        parent::__construct();
        $this->load->library(array('form_validation','session'));
    }

    public function FaleConosco()
    {
        $data['title'] = "LCI | Fale Conosco";
        $data['description'] = "Exercício de exemplo do capítulo 5 do livro Codeigniter";
        $data['formErrors'] = null;

        $this->form_validation->set_rules('nome', 'Nome', 'trim|required|min_length[3]');
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
        $this->form_validation->set_rules('assunto', 'Assunto', 'trim|required|min_length[5]');
        $this->form_validation->set_rules('mensagem', 'Mensagem', 'trim|required|min_length[30]');

        if($this->form_validation->run() == FALSE)
        {
            $data['formErrors'] = validation_errors();
        }
        else
        {
            $formData = $this->input->post();
            $emailStatus = $this->SendEmailToAdmin($formData['email'],$formData['nome'],"to@domain.com","To Name", $formData['assunto'], $formData['mensagem'],$formData['email'],$formData['nome']);

            if($emailStatus)
            {
                $this->session->set_flashdata('success_msg', 'Contato recebido com sucesso!');
            }
            else
            {
                $data['formErrors'] = "Desculpe! Não foi possível enviar o seu contato. tente novamente mais tarde.";
            }
        }

        $this->load->view('fale-conosco',$data);
    }

    public function TrabalheConosco()
    {
        $data['title'] = "LCI | Trabalhe Conosco";
        $data['description'] = "Exercício de exemplo do capítulo 5 do livro Codeigniter";
        $data['formErrors'] = null;     

        $this->form_validation->set_rules('nome', 'Nome', 'trim|required|min_length[3]');
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
        $this->form_validation->set_rules('telefone', 'Telefone', 'trim|required|min_length[5]');
        $this->form_validation->set_rules('mensagem', 'Mensagem', 'trim|required|min_length[30]');

        if($this->form_validation->run() == FALSE)
        {
            $data['formErrors'] = validation_errors();
        }
        else
        {
            $uploadCurriculo = $this->UploadFile('curriculo');

            if($uploadCurriculo['error'])
            {
                $data['formErrors'] = $uploadCurriculo['message'];
            }
            else
            {
                $formData = $this->input->post();
                $emailStatus = $this->SendEmailToAdmin($formData['email'],$formData['nome'],"to@domain.com","To Name", "Trabalhe Conosco", $formData['mensagem'],$formData['email'],$formData['nome'],$uploadCurriculo['fileData']['full_path']);

                if($emailStatus)
                {
                    $this->session->set_flashdata('success_msg', 'Contato recebido com sucesso!');
                }
                else
                {
                    $data['formErrors'] = "Desculpe! Não foi possível enviar o seu contato. tente novamente mais tarde.";
                }
            }
        }

        $this->load->view('trabalhe-conosco',$data);
    }

    private function SendEmailToAdmin($from, $fromName, $to, $toName, $subject, $message, $reply = null, $replyName = null, $attach = null)
    {
        $this->load->library('email');

        $config['charset'] = 'utf-8';
        $config['wordwrap'] = TRUE;
        $config['mailtype'] = 'html';
        $config['protocol'] = 'smtp';
        $config['smtp_host'] = 'smtp.seudominio.com.br';
        $config['smtp_user'] = 'user@seudominio.com.br';
        $config['smtp_pass'] = 'suasenha';
        $config['newline'] = '\r\n';

        $this->email->initialize($config);

        $this->email->from($from, $fromName);
        $this->email->to($to, $toName);

        if($reply)
        $this->email->reply_to($reply, $replyName);

        if($attach)
        $this->email->attach($attach);

        $this->email->subject($subject);
        $this->email->message($message);

        if($this->email->send())
        return true;
        else
        return false;
    }

    private function UploadFile($inputFileName)
    {
        $this->load->library('upload');

        $path = "../curriculos";

        $config['upload_path'] = $path;
        $config['allowed_types'] = 'doc|docx|pdf|zip|rar';
        $config['max_size'] = '5120';
        $config['encrypt_name'] = TRUE;

        if (!is_dir($path))
        mkdir($path, 0777, $recursive = true);

        $this->upload->initialize($config);

        if (!$this->upload->do_upload($inputFileName))
        {
            $data['error'] = true;
            $data['message'] = $this->upload->display_errors();
        }
        else
        {
            $data['error'] = false;
            $data['fileData'] = $this->upload->data();
        }

        return $data;
    }

}

?>
