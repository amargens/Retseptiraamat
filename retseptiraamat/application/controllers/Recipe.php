<?php

class Recipe extends CI_Controller {
    
    public function __construct() {
                parent::__construct();
                $this->load->model('recipes');
    }
    
    public function view($index = '1') {
        
        $data['title'] = 'recipe';
        $data['recipe'] = $this->recipes->get_recipes($index);

        $this->load->view('templates/header', $data);
        $this->load->view('recipe', $data);
        $this->load->view('templates/footer', $data);
        
        
    }
    
}