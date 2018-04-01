<?php

class Map extends CI_Controller {
    
    public function __construct() {
                parent::__construct();
                $this->load->model('recipes');
    }
    
    public function index() {

        $data['title'] = 'map';
        $data['recipes'] = $this->recipes->get_recipes_map();
        $data['recipesjs'] = $this->recipes->get_recipes_m();
        
        echo '<script>';
        echo 'var data = ' . json_encode($data['recipesjs']) . ';';
        echo '</script>';

        $this->load->view('templates/header', $data);
        $this->load->view('map', $data);
        $this->load->view('templates/footer', $data);
	}
    
}