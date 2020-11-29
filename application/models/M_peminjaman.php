<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_peminjaman extends CI_Model {

    public function __cnstruct(){
        parent::__cnstruct();
        $this->labels = $this->_atributeLabels();
        //memuat library database
        $this->load->database();
    }

    function cek_pinjam_dtl($where){
        $idPinjam = $this->session->userdata('idPinjam');
        $sql ="SELECT SUM(a.JumlhBrg) as totItem FROM tbpeminjamandtl as a WHERE a.idPinjam='$idPinjam' AND a.idbarang='$where'";  
        return $this->db->query($sql);
    }

    function tampil_data($search){
        $sql="SELECT a.*, (SELECT SUM(JumlhBrg) FROM tbpeminjamandtl as b WHERE b.idPinjam=a.idPinjam) as totItem FROM tbpeminjaman as a where a.idPinjam NOT IN(SELECT c.idPinjam FROM tbpengembalian as c WHERE c.idPinjam=a.idPinjam) $search";
        $hasil=$this->db->query($sql);
        return $hasil;
    }

    function tampil_data_done($search){
        if ($this->session->userdata('jabatan')=="KABID") {
            $sql="SELECT a.idPinjam, a.NIM, a.Nama_peminjam, a.tglPinjam, d.tglKembali, d.penerima, a.keperluan, (SELECT SUM(JumlhBrg) FROM tbpeminjamandtl as b WHERE b.idPinjam=a.idPinjam) as totItem FROM tbpeminjaman as a INNER JOIN tbpengembalian AS d ON d.idPinjam=a.idPinjam where d.tglKembali<>'' $search";
        }else if ($this->session->userdata('jabatan')=="ASLAB") {
            $kodeAslab = $this->session->userdata('nama');
            $sql="SELECT a.idPinjam, a.NIM, a.Nama_peminjam, a.tglPinjam, d.tglKembali, d.penerima, a.keperluan, (SELECT SUM(JumlhBrg) FROM tbpeminjamandtl as b WHERE b.idPinjam=a.idPinjam) as totItem FROM tbpeminjaman as a INNER JOIN tbpengembalian AS d ON d.idPinjam=a.idPinjam where d.tglKembali<>'' AND d.penerima like '%$kodeAslab%' $search";
        }
        $hasil=$this->db->query($sql);
        return $hasil;
    } 

    function tampil_data_detail($search){
        $sql="SELECT * FROM tbpeminjamandtl as a INNER JOIN tbinventaris as b ON b.idbarang=a.idbarang WHERE a.idPinjam='$search'";
        $hasil=$this->db->query($sql);
        return $hasil;
    }

    function tampil_data_header($search){
        $sql="SELECT * FROM tbpeminjaman WHERE idPinjam='$search'";
        $hasil=$this->db->query($sql);
        return $hasil;
    } 

    function select_data($id){
        $hasil=$this->db->query("SELECT * FROM tbpeminjaman where idPinjam='$id'");
        return $hasil;
    }

    function select_dataDtl($id){
        $hasil=$this->db->query("SELECT * FROM tbpeminjamandtl as a INNER JOIN tbinventaris as b ON b.idbarang=a.idbarang WHERE a.idDtl='$id'");
        return $hasil;
    }

    public function cekkodePinjam()
    {
        $query = $this->db->query("SELECT MAX(idPinjam) as kodePinjam from tbpeminjaman");
        $hasil = $query->row();
        return $hasil->kodePinjam;
    }

    function tampil_pinjamDtlKabid(){
        $sql="SELECT * FROM tbpeminjamandtl";
        $hasil=$this->db->query($sql);
        return $hasil;
    }  

    function cek_Inventaris($search){
        $sql="SELECT a.*, (SELECT SUM(b.JumlhBrg) from tbpeminjamandtl as b INNER JOIN tbpeminjaman as c ON c.idPinjam=b.idPinjam WHERE b.idbarang=a.idbarang) as diPinjam, (SELECT SUM(b.JumlhBrg) from tbpengembalian as b INNER JOIN tbpeminjaman as c ON c.idPinjam=b.idPinjam WHERE b.idbarang=a.idbarang) as diKembalikan FROM tbinventaris as a WHERE a.idbarang='$search'";
        $hasil=$this->db->query($sql);
        return $hasil;
    } 

    function cek_pengembalian($table,$where){      
        return $this->db->get_where($table,$where);
    }

    function input_data_peminjaman($data,$table){
        $this->db->insert($table,$data);
    } 

    function hapus_data_peminjaman($where,$table){
        $this->db->where($where);
        $this->db->delete($table);
    }

    function update_data_peminjaman($where,$data,$table){
        $this->db->where($where);
        $this->db->update($table,$data);
    }
    
}

?>