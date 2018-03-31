<?php

class Users extends CI_Controller{
    public function register(){
        $data['title'] = 'Registreerimine';

        $this->form_validation->set_rules('nimi', 'Nimi', 'required');
        $this->form_validation->set_rules('kasutajanimi', 'Kasutajanimi', 'required|callback_check_username_exists');
        $this->form_validation->set_rules('email', 'Email', 'required|callback_check_email_exists');
        $this->form_validation->set_rules('parool', 'Parool', 'required');
        $this->form_validation->set_rules('parool2', 'Parooli kordus', 'matches[parool]');

        if($this->form_validation-> run() == FALSE){
            $this->load->view('templates/header', $data);
            $this->load->view('users/register', $data);
            $this->load->view('templates/footer', $data);
        }
        else{
            //Parooli enkrüpteerimine
            $enc_parool = md5($this->input->post('parool'));
            $this->user_model->register($enc_parool);
            $reg_email = $this->input->post('email');
            $config = Array(
                'protocol' => 'smtp',
                'smtp_host' => 'ssl://smtp.googlemail.com',
                'smtp_port' => 465,
                'smtp_user' => 'retseptikas@gmail.com',
                'smtp_pass' => 'Retseptiraamat123',
                'mailtype' => 'html',
                'charset' => 'utf-8',
                'wordwrap' => TRUE
            );
            $this->load->library('email', $config);
            $this->email->initialize($config);
            $this->email->from('retseptikas@gmail.com', 'Retseptiraamat');
            $this->email->to($reg_email);
            $this->email->subject('Retseptiraamatu teade');
            $this->email->message("Tere, registreerumine retseptiraamatusse õnnestus! Meeldivat külastust!");
            $this->email->set_newline("\r\n");
            $this->email->send();
            $this->session->set_flashdata('kasutaja_registreeritud', 'Kasutaja registreeritud, võid logida sisse!');
            redirect('/home/index');
        }
    }

    public function login(){
        $data['title'] = 'Sisselogimine';

        $this->form_validation->set_rules('kasutajanimi', 'Kasutajanimi', 'required');
        $this->form_validation->set_rules('parool', 'Parool', 'required');

        if($this->form_validation-> run() == FALSE){
            $this->load->view('templates/header', $data);
            $this->load->view('users/login', $data);
            $this->load->view('templates/footer', $data);
        }
        else{
            $kasutajanimi = $this->input->post('kasutajanimi');
            $parool = md5($this->input->post('parool'));
            $kasutaja_id = $this->user_model->login($kasutajanimi, $parool);

            if($kasutaja_id){
                $kasutaja_data = array(
                    'kasutaja_id' => $kasutaja_id,
                    'kasutajanimi' => $kasutajanimi,
                    'sisselogitud' => true
                );
                $this->session->set_userdata($kasutaja_data);

                $this->session->set_flashdata('kasutaja_sisselogitud', 'Kasutaja sisselogimine õnnestus!');
                redirect('/home/index');
            }
            else {
                $this->session->set_flashdata('kasutaja_fail', 'Kasutaja sisselogimine ebaõnnestus!');
                redirect('/users/login');
            }
        }
    }

    public function logivalja(){
        $this->session->unset_userdata('sisselogitud');
        $this->session->unset_userdata('kasutaja_id');
        $this->session->unset_userdata('kasutajanimi');

        $this->session->set_flashdata('kasutaja_valjalogitud', 'Kasutaja väljalogimine õnnestus!');
        redirect('/users/login');
    }

    function check_username_exists($kasutajanimi){
        $this->form_validation->set_message('check_username_exists', 'Kasutajanimi on võetud. Mõtle välja mõni teine kasutajanimi');
        if($this->user_model->check_username_exists($kasutajanimi)){
            return true;
        }
        else{
            return false;
        }
    }

    function check_email_exists($email){
        $this->form_validation->set_message('check_email_exists', 'Email on võetud. Kasuta mõnda teist emaili.');
        if($this->user_model->check_email_exists($email)){
            return true;
        }
        else{
            return false;
        }
    }
}