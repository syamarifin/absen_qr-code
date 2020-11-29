<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_anggota extends CI_Model {

    public function __cnstruct(){
        parent::__cnstruct();
        $this->labels = $this->_atributeLabels();
        //memuat library database
        $this->load->database();
    }

    function tampil_data($search){
        $sql="SELECT * FROM tbanggota where NIM not in (select NIM from tbaslab where isActive='Y') $search";
        $hasil=$this->db->query($sql);
        return $hasil;
    }

    function select_data($id){
        $hasil=$this->db->query("SELECT * FROM tbanggota where IdDaftar_a='$id'");
        return $hasil;
    }

    public function cekkodeTroble()
    {
        $query = $this->db->query("SELECT MAX(IdDaftar_a) as kodeAnggota from tbanggota");
        $hasil = $query->row();
        return $hasil->kodeAnggota;
    }

    function input_data_anggota($data,$table){
        $this->db->insert($table,$data);
    }

    function update_data_anggota($where,$data,$table){
        $this->db->where($where);
        $this->db->update($table,$data);
    }

    function hapus_data_anggota($where,$table){
        $this->db->where($where);
        $this->db->delete($table);
    }

    public function getById($id,$table)
    {
        return $this->db->get_where($table, ["IdDaftar_a" => $id])->row();
    }


    public function input_aslab($idAnggota,$kodeAslab,$Qr){
        $query="INSERT INTO tbaslab SELECT '$kodeAslab', NIM, Nama, tmptlahir, tgllahir, Jk, '', 'ASLAB', email, NIM, img, '$Qr', 'Y' FROM tbanggota WHERE IdDaftar_a = '$idAnggota'";
        $sql = $this->db->query($query);
        // echo $query;
        if($sql)
            return true;
        return false;
    }
    
}

?>