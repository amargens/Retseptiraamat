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
    }