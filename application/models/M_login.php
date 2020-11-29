<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_login extends CI_Model {

    public function __cnstruct(){
        parent::__cnstruct();
        $this->labels = $this->_atributeLabels();
        //memuat library database
        $this->load->database();
    }
    	
    function cek_login($table,$where){		
		return $this->db->get_where($table,$where);
	}

    function tampil_profil_user($where){
        $sql="SELECT * FROM tbaslab where username = '$where'";
        $hasil=$this->db->query($sql);
        return $hasil;
    }

    function update_data_profil($where,$data,$table){
        $this->db->where($where);
        $this->db->update($table,$data);
    }

    function update_pass($where,$data,$table){
        $this->db->where($where);
        $this->db->update($table,$data);
    }

    public function getById($id,$table)
    {
        return $this->db->get_where($table, ["idAslab" => $id])->row();
    }
}

?>