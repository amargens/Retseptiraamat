<?php

class Advsearch extends CI_Controller {
    
    public function __construct() {
                parent::__construct();
                $this->load->model('recipes');
    }
    
    public function index() {
		$data['title'] = 'advsearch';
		$data['recipes'] = $this->recipes->get_recipes();
		
        $this->load->view('templates/header', $data);
        $this->load->view('advsearch', $data);
        $this->load->view('templates/footer', $data);
	}
	
	public function keysearch() {
        $data['title'] = 'advsearch';
        $this->load->model('recipes');
        $key = $this->input->post('search');
        
        $cookie_lang = "lang";
        $lang = "ee";
        if(isset($_COOKIE[$cookie_lang])) {
            $lang = $_COOKIE[$cookie_lang];
        }

        if(isset($key) and !empty($key)){
            $data['recipes'] = $this->recipes->keysearch($key);
            if (empty($data['recipes'])) {
                if ($lang == "ee") {
                    $this->session->set_flashdata('eba_otsing', 'Sellise nimega retsepte ei ole!');
                } else if ($lang == "en") {
                    $this->session->set_flashdata('eba_otsing', 'No recipes with that name!');
                }
                redirect('/advsearch/index');
            }
            else {
                $this->load->view('templates/header', $data);
                $this->load->view('advsearch', $data);
                $this->load->view('templates/footer', $data);
            }
        }
        else {
            if ($lang == "ee") {
                $this->session->set_flashdata('eba_otsing', 'Sellise nimega retsepte ei ole!');
            } else if ($lang == "en") {
                $this->session->set_flashdata('eba_otsing', 'No recipes with that name!');
            }
            
            redirect('/advsearch/index');
        }
    }

	public function ingredientsearch() {
		
		$data['title'] = 'advsearch';
        $this->load->model('recipes');
        $ingredients = $this->input->post('ingredient_ee');		
		
		$cookie_lang = "lang";
        $lang = "ee";
        if(isset($_COOKIE[$cookie_lang])) {
            $lang = $_COOKIE[$cookie_lang];
        }

        if(isset($ingredients) and !empty($ingredients)){
            $data['recipes'] = $this->recipes->ingredientsearch($ingredients);
            if (empty($data['recipes'])) {
                if ($lang == "ee") {
                    $this->session->set_flashdata('eba_otsing', 'Selliste koostisosadega retsepte ei leitud.');
                } else if ($lang == "en") {
                    $this->session->set_flashdata('eba_otsing', 'No recipes found with these ingredients.');
                }
                redirect('/advsearch/index');
            }
            else {
                $this->load->view('templates/header', $data);
                $this->load->view('advsearch', $data);
                $this->load->view('templates/footer', $data);
            }
        }
        else {
            if ($lang == "ee") {
                $this->session->set_flashdata('eba_otsing', 'Selliste koostisosadega retsepte ei leitud.');
            } else if ($lang == "en") {
                $this->session->set_flashdata('eba_otsing', 'No recipes found with these ingredients.');
            }
            
            redirect('/advsearch/index');
        }
    }
}
