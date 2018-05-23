<?php

class Stats extends CI_Controller {
    
    public function __construct() {
                parent::__construct();
                $this->load->model('recipes');
    }
    
    public function index() {
        ob_start();
        $data['title'] = 'stats';
        $data['checkBrowser'] = $this->recipes->get_statsbrowser();
        $data['getTime'] = $this->recipes->get_statstime();
        $data['getpage'] = $this->recipes->get_statspage();
        
        echo '<script>';
        echo 'var title = ' . json_encode($data['title']) . ';';
        echo 'var dataBrowser = ' . json_encode($data['checkBrowser']) . ';';
        echo 'var dataTime = ' . json_encode($data['getTime']) . ';';
        echo 'var datapage = ' . json_encode($data['getpage']) . ';';
        echo '</script>';

        $this->load->view('templates/header', $data);
        $this->load->view('stats', $data);
        $this->load->view('templates/footer', $data);
	}
    
    public function sendstats(){
        $this->recipes->sendstats();
    }
    
    public function pushstats(){
        $data['checkBrowser'] = $this->recipes->get_statsbrowser();
        $data['getTime'] = $this->recipes->get_statstime();
        $data['getpage'] = $this->recipes->get_statspage();
        //echo '<script>';
        //echo 'dataBrowser = ' . json_encode($data['checkBrowser']) . ';';
        //echo 'dataTime = ' . json_encode($data['getTime']) . ';';
        //echo 'datapage = ' . json_encode($data['getpage']) . ';';
        //echo '</script>';
        
        echo json_encode( array('data1' => $data['checkBrowser'], 'data2' => $data['getTime'], 'data3' => $data['getpage']) );
        
    }
}