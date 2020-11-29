<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_register extends CI_Model {

    public function __cnstruct(){
        parent::__cnstruct();
        $this->labels = $this->_atributeLabels();
        //memuat library database
        $this->load->database();
    }
    	
    function input_data_hotspot($data,$table){
        $this->db->insert($table,$data);
    }

    public function ceknimHotspot($nim)
    {
        $query = $this->db->query("SELECT count(NIM) as nimhotspot from tbhotspot where NIM = '$nim' and isActive='active'");
        $hasil = $query->row();
        return $hasil->nimhotspot;
    }

    public function cekkodeHotspot()
    {
        $query = $this->db->query("SELECT MAX(IdDaftar_h) as kodehotspot from tbhotspot");
        $hasil = $query->row();
        return $hasil->kodehotspot;
    }	
}

?>