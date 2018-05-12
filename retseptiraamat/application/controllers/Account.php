<?php

class Account extends CI_Controller {
    
    public function __construct() {
                parent::__construct();
                require_once APPPATH.'third_party/src/Google_Client.php';
                require_once APPPATH.'third_party/src/contrib/Google_Oauth2Service.php';
                $this->load->model('recipes');
                $this->load->model('user_model');
    }
    //menu - savedrec, ownrec, account. kui tahab kindla alammenüü avada
    public function index($menu = 'savedrec') {
        ob_start();
        
        $data['title'] = 'account';
        $data['menu'] = $menu;
        $data['favrecipes'] = $this->recipes->get_favrecipes();
        $data['userrecipes'] = $this->recipes->get_userrecipe();
        $data['gnum'] = $this->user_model->getgnum();

        echo '<script>';
        echo 'var title = ' . json_encode($data['title']) . ';';
        echo 'var gnum = ' . json_encode($data['gnum']) . ';';
        echo '</script>';
        
        $this->load->view('templates/header', $data);
        $this->load->view('account', $data);
        $this->load->view('templates/footer', $data);
        
        
    }
    
    public function favbtn($index = FALSE){
        $this->recipes->set_favourite($index);
        
        redirect('/account/index');
    }
    
    public function sendstats(){
        $this->recipes->sendstats();
    }
    
    
    public function linkGoogle(){
        ob_start();
        
        $checkgnum = $this->user_model->getgnum();
        $kasutajanimi = $this->input->post('kasutajanimi');

        $clientId = '1009717608289-dav4cdacvm4vpdoq7oaqjhejueghhsho.apps.googleusercontent.com'; //Google client ID
        $clientSecret = 'UtxO7d-VWK5gtQm3yIM5_6ED'; //Google client secret
        $redirectURL = base_url() . 'index.php/Account/linkGoogle/';
            
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
            $gnum = md5($userProfile['id']);
                
            $cookie_lang = "lang";
            $lang = "ee";
            if(isset($_COOKIE[$cookie_lang])) {
                $lang = $_COOKIE[$cookie_lang];
            }

            $this->user_model->savegnum($gnum);
            
            $cookie_lang = "lang";
            $lang = "ee";
            if(isset($_COOKIE[$cookie_lang])) {
                $lang = $_COOKIE[$cookie_lang];
            }
            if ($lang == "ee") {
                $this->session->set_flashdata('changesuccess', 'Kasutaja muutus edukas.');
            } else if ($lang == "en") {
                $this->session->set_flashdata('changesuccess', 'User change successful.');
            }
            redirect('/account/account');
            
        } 
        else 
        {
            $url = $gClient->createAuthUrl();
            header("Location: $url");
            $cookie_lang = "lang";
            $lang = "ee";
            if(isset($_COOKIE[$cookie_lang])) {
                $lang = $_COOKIE[$cookie_lang];
            }
            if ($lang == "ee") {
                $this->session->set_flashdata('changeerror', 'Midagi läks valesti, muutus ei olnud edukas.');
            } else if ($lang == "en") {
                $this->session->set_flashdata('changeerror', 'Something went wrong, change unsuccessful.');
            }
            //redirect('/account/account');
        }
    }
    
    public function unlinkGoogle(){
        ob_start();
        $this->session->unset_userdata('token');
        $this->user_model->savegnum(NULL);
        
        $cookie_lang = "lang";
        $lang = "ee";
        if(isset($_COOKIE[$cookie_lang])) {
            $lang = $_COOKIE[$cookie_lang];
        }
        if ($lang == "ee") {
            $this->session->set_flashdata('changesuccess', 'Kasutaja muutus edukas.');
        } else if ($lang == "en") {
            $this->session->set_flashdata('changesuccess', 'User change successful.');
        }
        redirect('/account/account');
    }
}