<?php

class Create extends CI_Controller {
    
    public function __construct() {
                parent::__construct();
                $this->load->model('recipes');
    }
    
    public function index() {
        if(!$this->session->userdata('sisselogitud')){
            redirect('/users/login');
        }
    
        $this->load->helper('form');
        $this->load->library('form_validation');

        $data['title'] = 'create';

        $this->form_validation->set_rules('title', 'Title', 'required');
        //$this->form_validation->set_rules('imageUpload', 'Image', 'required');
        $this->form_validation->set_rules('text', 'Text', 'required');

        if ($this->form_validation->run() === FALSE) {
            $this->load->view('templates/header', $data);
            $this->load->view('create', $data);
            $this->load->view('templates/footer', $data);
        }
        else {
            $this->recipes->set_recipe();
            redirect('/home/index');
            //redirect('/pages/view');
        }
    } 
}