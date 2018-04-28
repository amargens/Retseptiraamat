<?php

class Contact extends CI_Controller {

    public function __construct() {
        parent::__construct();
    }

    public function index() {
        ob_start();
        $data['title'] = 'contact';
        
        echo '<script>';
        echo 'var title = ' . json_encode($data['title']) . ';';
        echo '</script>';
        
        $this->load->view('templates/header', $data);
        $this->load->view('contact', $data);
        $this->load->view('templates/footer', $data);
    }
    
    public function sendstats(){
        $this->recipes->sendstats();
    }
}