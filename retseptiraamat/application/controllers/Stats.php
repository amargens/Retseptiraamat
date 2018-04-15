<?php

class Stats extends CI_Controller {
    
    public function index() {

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
}