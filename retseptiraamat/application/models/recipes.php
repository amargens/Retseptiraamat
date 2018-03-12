<?php 

class Recipes extends CI_Model {

    Public function __construct() { 
        parent::__construct(); 
    } 
      
    public function get_recipes($slug = FALSE) {
        if ($slug === FALSE) {
            
            $select = "SELECT * FROM retseptid;";
            $sql = $select;
            $query = $this->db->query($sql);
            return $query->result_array();
        }

        $query = $this->db->get_where('news', array('slug' => $slug));
        return $query->row_array();
    }
    
    public function set_recipe() {
        
        $select = "SELECT _imgpath FROM retseptid;";
        $sql = $select;
        $query = $this->db->query($sql);
        
        $imgname = $this->genRandString();
        
        while (in_array($imgname, array_column($this->get_recipes(), '_imgpath'))) {
            $imgname = $this->genRandString();
        }
        
        $title = $this->input->post('title');
        $text = $this->input->post('text');
        
        if ($this->setfile($imgname)) {
            $filename = $imgname.".".pathinfo($_FILES['imageUpload']['name'])['extension'];
            $insert = "INSERT INTO retseptid (_title, _imgpath, _text)";
            $values = "VALUES ('$title', '$filename', '$text');";
        
            $sql = $insert." ".$values;

            return $this->db->query($sql);
        }

        return false;
    }
    
    function genRandString($length = 10) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
    
    function setfile($filenewname) {
        $info = pathinfo($_FILES['imageUpload']['name']);
        $ext = $info['extension']; // get the extension of the file
        $newname = $filenewname.".".$ext; 
        $destination = 'application'. DIRECTORY_SEPARATOR .'assets'. DIRECTORY_SEPARATOR .'recipe_img'. DIRECTORY_SEPARATOR;
        $target = $destination.$newname;
        if(!file_exists($destination)) {
            mkdir($destination, 0755, true);
        }
        
        return move_uploaded_file( $_FILES['imageUpload']['tmp_name'], $target);
        
    }
    
}
 
?>