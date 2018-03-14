<?php 

class Recipes extends CI_Model {

    Public function __construct() { 
        parent::__construct(); 
    } 
      
    public function get_recipes($index = FALSE) {
        if ($index === FALSE) {
            
            $sql = "SELECT * FROM retseptid;";
            $query = $this->db->query($sql);
            return $query->result_array();
        }
        
        $select = "SELECT retseptid._recipeID, retseptid._title, retseptid._imgpath, retseptid._text, 
            toiduained._ingredient, toiduained._amount, toiduained._unit FROM retseptid";
        $join = "INNER JOIN toiduained ON retseptid._recipeID=toiduained._recipeID
            WHERE retseptid._recipeID = '$index' ;";
            
        $sql = $select." ".$join;
        $query = $this->db->query($sql);
        return $query->result_array();
    }
    
    public function set_recipe() {
        
        $imgname = $this->genRandString();
        
        while (in_array($imgname, array_column($this->get_recipes(), '_imgpath'))) {
            $imgname = $this->genRandString();
        }
        
        $title = $this->input->post('title');
        $text = $this->input->post('text');
        $ingredients = $this->input->post('ingredient');
        $amounts = $this->input->post('amount');
        $units = $this->input->post('unit');
        
        if ($this->setfile($imgname)) {
            $filename = $imgname.".".pathinfo($_FILES['imageUpload']['name'])['extension'];
            $insert = "INSERT INTO retseptid (_title, _imgpath, _text)";
            $values = "VALUES ('$title', '$filename', '$text');";
        
            $sql = $insert." ".$values;
            $this->db->query($sql);
            
            $sql = "SELECT _recipeID FROM retseptid WHERE _imgpath = '$filename';";
            $recipeID = $this->db->query($sql)->result_array();
            
            $length = sizeof($ingredients);
            $id = $recipeID[0]['_recipeID'];
            
            for ($i = 0; $i < $length; $i++) {
                $insert = "INSERT INTO toiduained (_recipeID, _ingredient, _amount, _unit)";
                $values = "VALUES ('$id', '$ingredients[$i]', '$amounts[$i]', '$units[$i]');";
                $sql = $insert." ".$values;
                $this->db->query($sql);
            }

            return true;
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