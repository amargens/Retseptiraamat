<?php

class Contact extends CI_Controller {

    public function __construct() {
        parent::__construct();
    }

    public function index() {
        $data['title'] = 'contact';
        $this->load->view('templates/header', $data);
        $this->load->view('Contact', $data);
        $this->load->view('templates/footer', $data);
    }
}