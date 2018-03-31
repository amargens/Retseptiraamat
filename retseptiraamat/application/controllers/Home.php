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

    public function keysearch() {
        $data['title'] = 'Otsing';
        $this->load->model('recipes');
        $key = $this->input->post('search');

        if(isset($key) and !empty($key)){
            $data['recipes'] = $this->recipes->keysearch($key);
            if (empty($data['recipes'])) {
                $this->session->set_flashdata('eba_otsing', 'Sellise nimega retsepte ei ole!');
                redirect('/home/index');
            }
            else {
                $this->load->view('templates/header', $data);
                $this->load->view('home', $data);
                $this->load->view('templates/footer', $data);
            }
        }
        else {
            $this->session->set_flashdata('eba_otsing', 'Sellise nimega retsepte ei ole!');
            redirect('/home/index');
        }
    }
}