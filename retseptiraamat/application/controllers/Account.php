<?php

class Account extends CI_Controller {
    
    public function __construct() {
                parent::__construct();
                $this->load->model('recipes');
    }
    
    public function index() {
        
        $data['title'] = 'account';
        $data['favrecipes'] = $this->recipes->get_favrecipes();
        $data['userrecipes'] = $this->recipes->get_userrecipe();

        echo '<script>';
        echo 'var title = ' . json_encode($data['title']) . ';';
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
}