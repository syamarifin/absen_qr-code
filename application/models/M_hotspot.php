<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_hotspot extends CI_Model {

    public function __cnstruct(){
        parent::__cnstruct();
        $this->labels = $this->_atributeLabels();
        //memuat library database
        $this->load->database();
    }

    function tampil_data($search){
        $sql="SELECT * FROM tbhotspot where isActive='Active' $search";
        $hasil=$this->db->query($sql);
        return $hasil;
    }

    function select_data($id){
        $hasil=$this->db->query("SELECT * FROM tbhotspot where IdDaftar_h='$id'");
        return $hasil;
    }	
        
    function input_data_hotspot($data,$table){
        $this->db->insert($table,$data);
    }

    function update_data_hotspot($where,$data,$table){
        $this->db->where($where);
        $this->db->update($table,$data);
    }

    function hapus_data_hotspot($where,$data,$table){
        $this->db->where($where);
        $this->db->update($table,$data);
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