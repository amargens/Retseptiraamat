<?php
    class User_model extends CI_Model{
        public function register($enc_parool){
            $data = array('nimi' => $this->input->post('nimi'), 'email' => $this->input->post('email'),
                'kasutajanimi' => $this->input->post('kasutajanimi'), 'parool' => $enc_parool);

            return $this->db->insert('kasutajad', $data);
        }

        public function login($kasutajanimi, $parool){
            $this->db->where('kasutajanimi', $kasutajanimi);
            $this->db->where('parool', $parool);

            $result = $this->db->get('kasutajad');
            if($result->num_rows() == 1){
                return $result->row(0)->id;
            }
            else{
                return false;
            }
        }
        
        public function loginGoogle($kasutajanimi, $gnum){
            $this->db->where('kasutajanimi', $kasutajanimi);
            $this->db->where('gnum', $gnum);

            $result = $this->db->get('kasutajad');
            if($result->num_rows() == 1){
                return $result->row(0)->id;
            }
            else{
                return false;
            }
        }

        public function check_username_exists($kasutajanimi){
            $query = $this->db->get_where('kasutajad', array('kasutajanimi' => $kasutajanimi));
            if(empty($query->row_array())){
                return true;
            }
            else {
                return false;
            }
        }

        public function check_email_exists($email){
            $query = $this->db->get_where('kasutajad', array('email' => $email));
            if(empty($query->row_array())){
                return true;
            }
            else {
                return false;
            }
        }
        
        public function savenewpass($pass){
            $userid = $this->session->userdata('kasutaja_id');
            $sql = "UPDATE kasutajad SET parool = ? WHERE id = ?;";
            $this->db->query($sql, array($pass, $userid));
        }
        
        public function getoldpass(){
            $userid = $this->session->userdata('kasutaja_id');
            $sql = "SELECT parool from v_kasutajad where id = ?";
            $query = $this->db->query($sql, array($userid));
            if($query->num_rows() == 1){
                $res = $query->result_array();
                return $res[0]['parool'];
            }
            else{
                return false;
            }
        }
        
        public function savegnum($gnum = NULL){
            $userid = $this->session->userdata('kasutaja_id');
            $sql = "CALL p_gnum(?, ?)";
            $this->db->query($sql, array($userid, $gnum));
        }
        
        public function getgnum(){
            $userid = $this->session->userdata('kasutaja_id');
            $sql = "SELECT gnum FROM v_kasutajad WHERE id = ?;";
        
            $query = $this->db->query($sql, array($userid));
            if($query->num_rows() == 1){
                $res = $query->result_array();
                return $res[0]['gnum'] !== NULL;
            }
            else{
                return false;
            }
        }
        
        public function checkgnum(){
            $username = $this->input->post('kasutajanimi');
            $sql = "SELECT gnum FROM v_kasutajad WHERE nimi = ?;";
        
            $query = $this->db->query($sql, array($username));
            if($query->num_rows() == 1){
                $res = $query->result_array();
                return $res[0]['gnum'] !== NULL;
            }
            else{
                return false;
            }
        }
        
        public function drop_user() {
            
            $userid = $this->session->userdata('kasutaja_id');
            $sql = "DELETE FROM kasutajad WHERE id = ?;";
            $query = $this->db->query($sql, array($userid));
        
        }
    }