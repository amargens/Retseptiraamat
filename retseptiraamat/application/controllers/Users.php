<?php

class Users extends CI_Controller{
    
    public function __construct()
    {
        parent::__construct();
        require_once APPPATH.'third_party/src/Google_Client.php';
        require_once APPPATH.'third_party/src/contrib/Google_Oauth2Service.php';
        $this->load->model('user_model');
        $this->load->model('recipes');
    }
    
    
    public function register(){
        ob_start();
        $data['title'] = 'register';
        
        echo '<script>';
        echo 'var title = ' . json_encode($data['title']) . ';';
        echo '</script>';

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
            $cookie_lang = "lang";
            $lang = "ee";
            if(isset($_COOKIE[$cookie_lang])) {
                $lang = $_COOKIE[$cookie_lang];
            }
            if ($lang == "ee") {
                $this->session->set_flashdata('kasutaja_registreeritud', 'Kasutaja registreeritud, võid logida sisse!');
            } else if ($lang == "en") {
                $this->session->set_flashdata('kasutaja_registreeritud', 'User registered, you can login!');
            }
            redirect('/home/index');
        }
    }

    public function login(){
        ob_start();
        $data['title'] = 'login';
        
        echo '<script>';
        echo 'var title = ' . json_encode($data['title']) . ';';
        echo '</script>';

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
            
            $cookie_lang = "lang";
            $lang = "ee";
            if(isset($_COOKIE[$cookie_lang])) {
                $lang = $_COOKIE[$cookie_lang];
            }

            if($kasutaja_id){
                $kasutaja_data = array(
                    'kasutaja_id' => $kasutaja_id,
                    'kasutajanimi' => $kasutajanimi,
                    'sisselogitud' => true
                );
                $this->session->set_userdata($kasutaja_data);

                if ($lang == "ee") {
                    $this->session->set_flashdata('kasutaja_sisselogitud', 'Kasutaja sisselogimine õnnestus!');
                } else if ($lang == "en") {
                    $this->session->set_flashdata('kasutaja_sisselogitud', 'Login success!');
                }
                redirect('/home/index');
            }
            else {
                if ($lang == "ee") {
                    $this->session->set_flashdata('kasutaja_fail', 'Kasutaja sisselogimine ebaõnnestus!');
                } else if ($lang == "en") {
                    $this->session->set_flashdata('kasutaja_fail', 'Login failed!');
                }
                redirect('/users/login');
            }
        }
    }
    
    
    public function loginGoogle(){
        ob_start();
            
        $kasutajanimi = $this->input->post('kasutajanimi');

        if(strlen($kasutajanimi)!==0){
            $kasutaja_data = array(
                'kasutajanimi' => $kasutajanimi
            );
            $this->session->set_userdata($kasutaja_data);
        }
        
        $clientId = '1009717608289-dav4cdacvm4vpdoq7oaqjhejueghhsho.apps.googleusercontent.com'; //Google client ID
        $clientSecret = 'UtxO7d-VWK5gtQm3yIM5_6ED'; //Google client secret
        $redirectURL = base_url() . 'index.php/Users/loginGoogle/';
            
        //Call Google API
        $gClient = new Google_Client();
        $gClient->setApplicationName('Login');
        $gClient->setClientId($clientId);
        $gClient->setClientSecret($clientSecret);
        $gClient->setRedirectUri($redirectURL);
        $google_oauthV2 = new Google_Oauth2Service($gClient);
            
        if(isset($_GET['code']))
        {
            $gClient->authenticate($_GET['code']);
            $_SESSION['token'] = $gClient->getAccessToken();
            header('Location: ' . filter_var($redirectURL, FILTER_SANITIZE_URL));
        }
    
        if (isset($_SESSION['token'])) 
        {
            $gClient->setAccessToken($_SESSION['token']);
        }
		
        if ($gClient->getAccessToken()) {
            $userProfile = $google_oauthV2->userinfo->get();
            $kasutajanimi = $this->input->post('kasutajanimi');
            if (strlen($kasutajanimi)===0) {
                $kasutajanimi = $this->session->userdata('kasutajanimi');
            }
            $gnum = md5($userProfile['id']);
            $kasutaja_id = $this->user_model->loginGoogle($kasutajanimi, $gnum);
                
            $cookie_lang = "lang";
            $lang = "ee";
            if(isset($_COOKIE[$cookie_lang])) {
                $lang = $_COOKIE[$cookie_lang];
            }

            if((int)$kasutaja_id !== -1){
                $kasutaja_data = array(
                    'kasutaja_id' => $kasutaja_id,
                    'kasutajanimi' => $kasutajanimi,
                    'sisselogitud' => true
                );
                $this->session->set_userdata($kasutaja_data);

                if ($lang == "ee") {
                    $this->session->set_flashdata('kasutaja_sisselogitud', 'Kasutaja sisselogimine õnnestus!');
                } else if ($lang == "en") {
                    $this->session->set_flashdata('kasutaja_sisselogitud', 'Login success!');
                }
                redirect('/home/index');
                exit();
            } else {
                
                //delete google user info from session (deletes all session info)
                $this->session->unset_userdata('token');
                if ($lang == "ee") {
                    $this->session->set_flashdata('kasutaja_fail', 'Kasutaja sisselogimine ebaõnnestus!');
                } else if ($lang == "en") {
                    $this->session->set_flashdata('kasutaja_fail', 'Login failed!');
                }
                redirect('/users/login');
                exit();
            }
            
        } else {   
            
            $checkgnum = $this->user_model->checkgnum();
            $kasutajanimi = $this->input->post('kasutajanimi');

            if(!$checkgnum || $kasutajanimi === ""){
                $cookie_lang = "lang";
                $lang = "ee";
                if(isset($_COOKIE[$cookie_lang])) {
                    $lang = $_COOKIE[$cookie_lang];
                }
                if ($lang == "ee") {
                    $this->session->set_flashdata('kasutaja_google', 'Selle kasutajaga ei ole Google kontot seotud!');
                } else if ($lang == "en") {
                    $this->session->set_flashdata('kasutaja_google', 'Google account not linked with this account!');
                }
                redirect('/users/login');
                exit;
            }
            
            $url = $gClient->createAuthUrl();
            header("Location: $url");
            exit();
        }
    
    }
    
    public function logivalja(){
        $this->session->unset_userdata('sisselogitud');
        $this->session->unset_userdata('kasutaja_id');
        $this->session->unset_userdata('kasutajanimi');
        $this->session->unset_userdata('token');
        
        $cookie_lang = "lang";
        $lang = "ee";
        if(isset($_COOKIE[$cookie_lang])) {
            $lang = $_COOKIE[$cookie_lang];
        }
        if ($lang == "ee") {
            $this->session->set_flashdata('kasutaja_valjalogitud', 'Kasutaja väljalogimine õnnestus!');
        } else if ($lang == "en") {
            $this->session->set_flashdata('kasutaja_valjalogitud', 'Logout success!');
        }
        redirect('/users/login');
    }

    function check_username_exists($kasutajanimi){
        $cookie_lang = "lang";
        $lang = "ee";
        if(isset($_COOKIE[$cookie_lang])) {
            $lang = $_COOKIE[$cookie_lang];
        }
        if ($lang == "ee") {
            $this->form_validation->set_message('check_username_exists', 'Kasutajanimi on võetud. Mõtle välja mõni teine kasutajanimi.');
        } else if ($lang == "en") {
            $this->form_validation->set_message('check_username_exists', 'Username taken, use another username.');
        }
        if($this->user_model->check_username_exists($kasutajanimi)){
            return true;
        }
        else{
            return false;
        }
    }

    function check_email_exists($email){
        $cookie_lang = "lang";
        $lang = "ee";
        if(isset($_COOKIE[$cookie_lang])) {
            $lang = $_COOKIE[$cookie_lang];
        }
        if ($lang == "ee") {
            $this->form_validation->set_message('check_email_exists', 'Email on võetud. Kasuta mõnda teist emaili.');
        } else if ($lang == "en") {
            $this->form_validation->set_message('check_email_exists', 'Email taken, use another email.');
        }
        if($this->user_model->check_email_exists($email)){
            return true;
        }
        else{
            return false;
        }
    }
    
    public function sendstats(){
        $this->recipes->sendstats();
    }

}