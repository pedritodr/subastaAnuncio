<?php
class Correo_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }
    function sent($email, $mensaje, $asunto, $motivo)
    {
        $this->load->library('email');
        $config['protocol'] = 'smtp';
        $config['smtp_host'] = 'smtp.zoho.com';
        $config['smtp_user'] = 'info@subastanuncios.com';
        $config['smtp_pass'] = "Subasta.2020";
        $config['smtp_port'] = '465';
        //$config['smtp_timeout'] = '5';
        //$config['smtp_keepalive'] = TRUE;
        $config['smtp_crypto'] = 'ssl';
        $config['charset'] = 'utf-8';
        $config['newline'] = "\r\n";
        $config['mailtype'] = 'html';
        $config['wordwrap'] = TRUE;

        $this->email->initialize($config);

        $this->email->from('info@subastanuncios.com', $motivo);
        $this->email->to($email);
        $this->email->subject($asunto);
        $this->email->message($mensaje);
        $this->email->send();
    }
}
