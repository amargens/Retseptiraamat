<?php

class Home extends CI_Controller {
    
    public function index() {

        $data['title'] = 'home';
        
        echo '<script>';
        echo 'var title = ' . json_encode($data['title']) . ';';
        echo '</script>';

        $this->load->view('templates/header', $data);
        $this->load->view('home', $data);
        $this->load->view('templates/footer', $data);
	}
    
    public function sendstats(){
        $this->recipes->sendstats();
    }
}