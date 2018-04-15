<?php

class Create extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('recipes');
    }

    public function index()
    {
        if (!$this->session->userdata('sisselogitud')) {
            redirect('/users/login');
        }

        $this->load->helper('form');
        $this->load->library('form_validation');

        $data['title'] = 'create';

        echo '<script>';
        echo 'var title = ' . json_encode($data['title']) . ';';
        echo '</script>';
        
        $this->form_validation->set_rules('title_ee', 'Title', 'required');
        //$this->form_validation->set_rules('imageUpload', 'Image', 'required');
        //$this->form_validation->set_rules('imageUpload', 'Image', 'callback_image_upload');
        $this->form_validation->set_rules('text_ee', 'Text', 'required');

        if ($this->form_validation->run() === FALSE) {
            $this->load->view('templates/header', $data);
            $this->load->view('create', $data);
            $this->load->view('templates/footer', $data);
        } else {
            ob_start();
            $this->recipes->set_recipe();
            redirect('/home/index');
            //redirect('/pages/view');
        }
    }

    /*function image_upload()
    {
        if ($_FILES['imageUpload']['size'] != 0) {
            $upload_dir = './images/';
            if (!is_dir($upload_dir)) {
                mkdir($upload_dir);
            }
            $config['upload_path'] = $upload_dir;
            $config['allowed_types'] = 'jpg|png|jpeg';
            $config['overwrite'] = false;
            $config['max_size'] = '5120';
            $this->load->library('upload', $config);
            if (!$this->upload->do_upload('imageUpload')) {
                $this->form_validation->set_message('image_upload', $this->upload->display_errors());
                return false;
            } else {
                return true;
            }
        } else {
            $this->form_validation->set_message('image_upload', "The Image field is required");
            return false;
        }
    }*/
    
    public function error(){
        
        if(!$this->session->userdata('sisselogitud')){
            redirect('/users/login');
        }
        
        $cookie_lang = "lang";
        $lang = "ee";
        if(isset($_COOKIE[$cookie_lang])) {
            $lang = $_COOKIE[$cookie_lang];
        }
    
        $this->load->helper('form');
        $this->load->library('form_validation');

        $data['title'] = 'create';

        $this->form_validation->set_rules('title_ee', 'Title', 'required');
        //$this->form_validation->set_rules('imageUpload', 'Image', 'required');
        $this->form_validation->set_rules('text_ee', 'Text', 'required');
        
        if ($lang == "ee") {
            $this->session->set_flashdata('lisa_error', 'Mõned väljad on täitmata!');
        } else if ($lang == "en") {
            $this->session->set_flashdata('lisa_error', 'Some fields are not complete!');
        }

        $this->load->view('templates/header', $data);
        $this->load->view('create', $data);
        $this->load->view('templates/footer', $data);
        
    }
    
    public function sendstats(){
        $this->recipes->sendstats();
    }
}


