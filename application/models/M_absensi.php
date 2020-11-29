<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_absensi extends CI_Model {

    public function __cnstruct(){
        parent::__cnstruct();
        $this->labels = $this->_atributeLabels();
        //memuat library database
        $this->load->database();
    }

    function tampil_dataKabid($search){

        $this->load->library('pagination');

        $sql="SELECT * FROM tbabsensi INNER JOIN tbaslab ON tbaslab.idAslab = tbabsensi.idAslab where tbaslab.isActive='Y' AND tbaslab.jabatan ='ASLAB' $search";

        $config['base_url'] = base_url('/index.php/absensi/view_absensiKabid');
        $config['total_rows'] = $this->db->query($sql)->num_rows();
        $config['per_page'] = 5;
        $config['uri_segment'] = 3;
        $config['num_links'] = 3;
        
        // Membuat Style pagination untuk BootStrap v4
        $config['first_link']       = 'First';
        $config['last_link']        = 'Last';
        $config['next_link']        = 'Next';
        $config['prev_link']        = 'Prev';
        $config['full_tag_open']    = '<div class="pagging text-center"><nav><ul class="pagination justify-content-center">';
        $config['full_tag_close']   = '</ul></nav></div>';
        $config['num_tag_open']     = '<li class="page-item"><span class="page-link">';
        $config['num_tag_close']    = '</span></li>';
        $config['cur_tag_open']     = '<li class="page-item active"><span class="page-link">';
        $config['cur_tag_close']    = '<span class="sr-only">(current)</span></span></li>';
        $config['next_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['next_tagl_close']  = '<span aria-hidden="true">&raquo;</span></span></li>';
        $config['prev_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['prev_tagl_close']  = '</span>Next</li>';
        $config['first_tag_open']   = '<li class="page-item"><span class="page-link">';
        $config['first_tagl_close'] = '</span></li>';
        $config['last_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['last_tagl_close']  = '</span></li>';
        
        $this->pagination->initialize($config); // Set konfigurasi paginationnya
        
        $page = ($this->uri->segment($config['uri_segment'])) ? $this->uri->segment($config['uri_segment']) : 0;
        $sql .= " LIMIT ".$page.", ".$config['per_page'];
        
        $data['limit'] = $config['per_page'];
        $data['total_rows'] = $config['total_rows'];
        $data['pagination'] = $this->pagination->create_links(); // Generate link pagination nya sesuai config diatas
        $data['rows'] = $this->db->query($sql)->result();
        
        return $data;
        // $hasil=$this->db->query($sql);
        // return $hasil;
    }

    function select_aslab($search){
        $sql="SELECT * FROM tbaslab where tbaslab.idAslab='$search'";
        $hasil=$this->db->query($sql);
        return $hasil;
    }

    function cek_aslab($table,$where){      
        return $this->db->get_where($table,$where);
    }

    function absen_masuk($data,$table){
        $this->db->insert($table,$data);
    }

    function absen_keluar($where,$data,$table){
        $this->db->where($where);
        $this->db->update($table,$data);
    }

    function hapus_data_absensi($where,$data,$table){
        $this->db->where($where);
        $this->db->update($table,$data);
    }
    
}

?>