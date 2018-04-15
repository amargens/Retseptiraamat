<?php

class Recipe extends CI_Controller {
    
    public function __construct() {
                parent::__construct();
                $this->load->model('recipes');
    }
    
    public function view($index = '1') {
        
        $data['title'] = 'recipe';
        $data['index'] = $index;
        $userid = $this->session->userdata('kasutaja_id');
        $data['favourites'] = $this->recipes->get_favourites($userid);
        $data['recipe'] = $this->recipes->get_recipes($index);

        echo '<script>';
        echo 'var title = ' . json_encode($data['title']) . ';';
        echo '</script>';
        
        $this->load->view('templates/header', $data);
        $this->load->view('recipe', $data);
        $this->load->view('templates/footer', $data);
        
        
    }
    
    public function favbtn($index = '1'){
        
        $this->recipes->set_favourite();
        
        redirect('/recipe/view/'.$index);
    }
    
    public function sendstats(){
        $this->recipes->sendstats();
    }
    
}