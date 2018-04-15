<?php 

class Recipes extends CI_Model {

    Public function __construct() { 
        parent::__construct(); 
    } 
      
    public function get_recipes($index = FALSE) {
        $cookie_lang = "lang";
        $lang = "ee";
        if(isset($_COOKIE[$cookie_lang])) {
            $lang = $_COOKIE[$cookie_lang];
        }
        if ($index === FALSE) {
            if ($lang == "ee") {
                $sql = "SELECT * FROM v_retseptid;";
            } else if ($lang == "en") {
                $sql = "SELECT * FROM v_retseptideng;";
            }
            $query = $this->db->query($sql);
            return $query->result_array();
        }
        if ($lang == "ee") {
            $sql = "SELECT * FROM v_retseptid_full WHERE _recipeID = ?;";
        } else if ($lang == "en") {
            $sql = "SELECT * FROM v_retseptideng_full WHERE _recipeID = ?;";
        }
        $query = $this->db->query($sql, array($index));
        
        return $query->result_array();
    }
    
    public function get_allfullrecipes() {
        $cookie_lang = "lang";
        $lang = "ee";
        if(isset($_COOKIE[$cookie_lang])) {
            $lang = $_COOKIE[$cookie_lang];
        }
        if ($lang == "ee") {
            $sql = "SELECT * FROM v_retseptid_full;";
        } else if ($lang == "en") {
            $sql = "SELECT * FROM v_retseptideng_full;";
        }
        $query = $this->db->query($sql);
        
        return $query->result_array();
    }
    
    public function get_recipes_m() {
        $cookie_lang = "lang";
        $lang = "ee";
        if(isset($_COOKIE[$cookie_lang])) {
            $lang = $_COOKIE[$cookie_lang];
        }
        if ($lang == "ee") {
            $sql = "SELECT * FROM v_location;";
        } else if ($lang == "en") {
            $sql = "SELECT * FROM v_locationeng;";
        }
        $query = $this->db->query($sql);
        return $query->result_array();
    }
    
    public function get_recipes_map() {
        $cookie_lang = "lang";
        $lang = "ee";
        if(isset($_COOKIE[$cookie_lang])) {
            $lang = $_COOKIE[$cookie_lang];
        }
        if ($lang == "ee") {
            if (!isset($_POST['inputmap'])) {
                $sql = "SELECT * FROM v_location;";
            } else {
                $inputmap = $this->input->post('inputmap');
                $sql = 'SELECT * FROM `v_location` 
                    WHERE `_recipeID` IN (' . implode(',', array_map('intval', explode(',' ,$inputmap))) . ')';
            }
            
        } else if ($lang == "en") {
            if (!isset($_POST['inputmap'])) {
                $sql = "SELECT * FROM v_locationeng;";
            } else {
                $inputmap = $this->input->post('inputmap');
                $sql = 'SELECT * FROM `v_locationeng` 
                    WHERE `_recipeID` IN (' . implode(',', array_map('intval', explode(',' ,$inputmap))) . ')';
            }
            
        }
        $query = $this->db->query($sql);
        return $query->result_array();
    }
    
    public function get_favourites($id = NULL) {
        
        if ($id === NULL) {
            return $id;
        }
        $sql = "SELECT favourites FROM v_favourites WHERE id = ?;";
        $query = $this->db->query($sql, array($id));
        
        return $query->result_array();
    }
    
    public function get_favrecipes() {
        
        $userid = $this->session->userdata('kasutaja_id');
        $cookie_lang = "lang";
        $lang = "ee";
        if(isset($_COOKIE[$cookie_lang])) {
            $lang = $_COOKIE[$cookie_lang];
        }
        $favourites = $this->recipes->get_favourites($userid);
        if ($favourites !== NULL){
            $fav = $favourites[0]['favourites'];
            if ($fav === NULL){
                return NULL;
            }
            if ($lang == "ee") {
                $sql = "SELECT * FROM v_retseptid WHERE `_recipeID` IN (" . implode(',', array_map('intval', explode(',' ,$fav))) . ")";
            } else if ($lang == "en") {
                $sql = "SELECT * FROM v_retseptideng WHERE `_recipeID` IN (" . implode(',', array_map('intval', explode(',' ,$fav))) . ")";
            }
            $query = $this->db->query($sql, array($userid));
            return $query->result_array();
        }
        else{
            return NULL;
        }
        
        
    }
    
    public function get_userrecipe() {
        
        $userid = $this->session->userdata('kasutaja_id');
        $cookie_lang = "lang";
        $lang = "ee";
        if(isset($_COOKIE[$cookie_lang])) {
            $lang = $_COOKIE[$cookie_lang];
        }
        if ($lang == "ee") {
            $sql = "SELECT * FROM v_retseptid WHERE _userID = ?;";
        } else if ($lang == "en") {
            $sql = "SELECT * FROM v_retseptideng WHERE _userID = ?;";
        }
        $query = $this->db->query($sql, array($userid));
        $qarray = $query->result_array();
        if (sizeof($qarray) === 0){
            return NULL;
        }
        return $qarray;
    }
   
    
    public function set_recipe() {
        
        $imgname = $this->genRandString();
        
        while (in_array($imgname, array_column($this->get_recipes(), '_imgpath'))) {
            $imgname = $this->genRandString();
        }
        $userid = $this->session->userdata('kasutaja_id');
        $title_ee = $this->input->post('title_ee');
        $text_ee = $this->input->post('text_ee');
        $ingredients_ee = $this->input->post('ingredient_ee');
        $amounts_ee = $this->input->post('amount_ee');
        $units_ee = $this->input->post('unit_ee');
        $title_eng = $this->input->post('title_eng');
        $text_eng = $this->input->post('text_eng');
        $ingredients_eng = $this->input->post('ingredient_eng');
        $amounts_eng = $this->input->post('amount_eng');
        $units_eng = $this->input->post('unit_eng');
        $locationBox = $this->input->post('locationBox');
        
        if ($this->setfile($imgname)) {
            $filename = $imgname.".".pathinfo($_FILES['imageUpload']['name'])['extension'];
            
            $sql = "CALL p_retseptid(?, ?, ?, ?, ?, ?, ?)";
            if ($locationBox === "") $locationBox = NULL;
            if (isset($_POST['insert_Eng'])){
                $this->db->query($sql, array($userid, $title_ee, $title_eng, $filename, $locationBox, $text_ee, $text_eng));
            } else {
                $this->db->query($sql, array($userid, $title_ee, NULL, $filename, $locationBox, $text_ee, NULL));
            }
            
            $sql = "SELECT _recipeID FROM v_retseptid WHERE _imgpath=?;";
            $recipeID = $this->db->query($sql, array($filename))->result_array();
            
            $length = sizeof($ingredients_ee);
            $id = $recipeID[0]['_recipeID'];
            
            for ($i = 0; $i < $length; $i++) {
                $sql = "CALL p_toiduained(?, ?, ?, ?, ?, ?, ?)";
                if (isset($_POST['insert_Eng'])){
                    $this->db->query($sql, array($id, $ingredients_ee[$i], $ingredients_eng[$i], $amounts_ee[$i], $amounts_eng[$i], $units_ee[$i], $units_eng[$i]));
                } else {
                    $this->db->query($sql, array($id, $ingredients_ee[$i], NULL, $amounts_ee[$i], NULL, $units_ee[$i], NULL));
                }
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
    
    public function keysearch($key) {
        $cookie_lang = "lang";
        $lang = "ee";
        if(isset($_COOKIE[$cookie_lang])) {
            $lang = $_COOKIE[$cookie_lang];
        }
        
        $this->db->select('*');
        if ($lang == "ee") {
            $this->db->from('v_retseptid');
        } else if ($lang == "en") {
            $this->db->from('v_retseptideng');
        }
        $this->db->like('_title', $key);
        $query = $this->db->get();
        if($query ->num_rows() > 0) {
            return $query->result_array();
        }
        else { //Kasutame siin else's sama asja, et errorit ei tuleks.
            return $query->result_array();
        }
    }
	
	
	public function ingredientsearch($ingredients) {
        $cookie_lang = "lang";
        $lang = "ee";
        if(isset($_COOKIE[$cookie_lang])) {
            $lang = $_COOKIE[$cookie_lang];
        }
		
		if ($lang == "ee") {
            $dbs = "v_retseptid_full";
        } 
		else if ($lang == "en") {
            $dbs = "v_retseptideng_full";
        }
		$size = sizeof($ingredients);
		$sql = "SELECT _recipeID, _title, _imgpath, _text FROM ".$dbs." WHERE _ingredient IN ('".implode("', '", $ingredients)."') GROUP BY _recipeID HAVING COUNT(*)=".$size;
		$query = $this->db->query($sql);
        return $query->result_array();
    }
    
    public function set_favourite($accIndex = FALSE){
        
        $userid = $this->session->userdata('kasutaja_id');
        if ($accIndex === FALSE){
            $index = $this->input->post('index');
            $addrem = $this->input->post('favbtn');
        }
        else{
            $index = $accIndex;
            $addrem = "on";
        }
        $favourites = $this->recipes->get_favourites($userid);
        if ($favourites !== FALSE){
            $fav = $favourites[0]['favourites'];
        }
        else{
            $fav = "";
        }
        if ($addrem === "off"){
            if ($fav === "" || $fav === NULL) {
                $fav = $index;
            } else {
                $fav = $fav.",".$index;
            }
            $sql = "CALL p_favourites(?, ?)";
            $this->db->query($sql, array($userid, $fav));
        } else if ($addrem === "on"){
            if ($fav !== ""){
                if ($fav === $index){
                    $fav = NULL;
                } else {
                    $fav = explode(',' ,$favourites[0]['favourites']);
                    $key = array_search ($index, $fav);
                    
                    unset($fav[$key]);
                    
                    $fav = implode(',', $fav);
                }
                $sql = "CALL p_favourites(?, ?)";
                $this->db->query($sql, array($userid, $fav));
            }
            
        }
        
    }
    
    public function sendstats(){
        
        $checkBrowser = $this->input->post('checkBrowser');
        $getTime = $this->input->post('getTime');
        $title = $this->input->post('title');
        echo $checkBrowser;
        echo $getTime;
        echo $title;
        $sql = "CALL p_stats(?, ?, ?)";
        $this->db->query($sql, array($checkBrowser, $getTime, $title));
    }
    
    public function get_statsbrowser() {
        
        $sql = "SELECT * FROM v_statsbrowser;";
        $query = $this->db->query($sql);
        $qarray = $query->result_array();
        if (sizeof($qarray) === 0){
            return NULL;
        }
        return $qarray;
    }
    
    public function get_statspage() {
        
        $sql = "SELECT * FROM v_statspage;";
        $query = $this->db->query($sql);
        $qarray = $query->result_array();
        if (sizeof($qarray) === 0){
            return NULL;
        }
        return $qarray;
    }
    
    public function get_statstime() {
        
        $sql = "SELECT * FROM v_statstime;";
        $query = $this->db->query($sql);
        $qarray = $query->result_array();
        if (sizeof($qarray) === 0){
            return NULL;
        }
        return $qarray;
    }
}
?>