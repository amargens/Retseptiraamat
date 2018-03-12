<?php

class Home extends CI_Controller {
    
    public function __construct() {
                parent::__construct();
                $this->load->model('recipes');
    }
    
    public function index() {

        $data['title'] = 'home';
        $data['recipes'] = $this->recipes->get_recipes();

        $this->load->view('templates/header', $data);
        $this->load->view('home', $data);
        $this->load->view('templates/footer', $data);
	}
    
    
    
}