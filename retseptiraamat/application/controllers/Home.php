<?php

class Home extends CI_Controller {
    
    public function index() {

        $data['title'] = 'home';

        $this->load->view('templates/header', $data);
        $this->load->view('home', $data);
        $this->load->view('templates/footer', $data);
	}
}