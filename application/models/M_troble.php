<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_troble extends CI_Model {

    public function __cnstruct(){
        parent::__cnstruct();
        $this->labels = $this->_atributeLabels();
        //memuat library database
        $this->load->database();
    }

    function cek_Aslab($table,$where){      
        return $this->db->get_where($table,$where);
    }

    function tampil_data($search){
        $sql="SELECT * FROM tbtroubleshooting where status='New' $search";
        $hasil=$this->db->query($sql);
        return $hasil;
    }

    function tampil_data_done($search){
        $sql="SELECT * FROM tbtroubleshooting where status='Done' $search";
        $hasil=$this->db->query($sql);
        return $hasil;
    }

    function select_data($id){
        $hasil=$this->db->query("SELECT * FROM tbtroubleshooting where idPenanganan='$id'");
        return $hasil;
    }

    function total_troble($status){
        $hasil=$this->db->query("SELECT COUNT(*) as total FROM tbtroubleshooting where status='$status'");
        return $hasil;
    }

    public function cekkodeTroble()
    {
        $query = $this->db->query("SELECT MAX(idPenanganan) as kodeTroble from tbtroubleshooting");
        $hasil = $query->row();
        return $hasil->kodeTroble;
    }

    function input_data_troble($data,$table){
        $this->db->insert($table,$data);
    }

    function update_data_troble($where,$data,$table){
        $this->db->where($where);
        $this->db->update($table,$data);
    }

    function hapus_data_troble($where,$table){
        $this->db->where($where);
        $this->db->delete($table);
    }
    
}

?>