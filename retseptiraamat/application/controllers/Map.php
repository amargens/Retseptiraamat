<?php

class Map extends CI_Controller {
    
    public function __construct() {
                parent::__construct();
                $this->load->model('recipes');
    }
    
    public function index() {
        ob_start();
        $data['title'] = 'map';
        $data['recipes'] = $this->recipes->get_recipes_map();
        $data['recipesjs'] = $this->recipes->get_recipes_m();
        
        echo '<script>';
        echo 'var title = ' . json_encode($data['title']) . ';';
        echo 'var data = ' . json_encode($data['recipesjs']) . ';';
        echo '</script>';

        $this->load->view('templates/header', $data);
        $this->load->view('map', $data);
        $this->load->view('templates/footer', $data);
	}
    
    public function sendstats(){
        $this->recipes->sendstats();
    }
}