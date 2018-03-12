<?php

class Pages extends CI_Controller {
    
    
    public function view($page = 'home') {
        if ( ! file_exists(APPPATH.'views/'.$page.'.php'))
        {
                // Whoops, we don't have a page for that!
                show_404();
        }
        
        redirect('/'.$page.'/index');
        
    }
    
}