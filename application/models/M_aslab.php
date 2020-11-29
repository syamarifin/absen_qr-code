<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_aslab extends CI_Model {

    public function __cnstruct(){
        parent::__cnstruct();
        $this->labels = $this->_atributeLabels();
        //memuat library database
        $this->load->database();
    }

    function cek_nim($table,$where){      
        return $this->db->get_where($table,$where);
    }

    function tampil_dataKabid($search){
        $this->load->library('pagination');
        
        $sql="SELECT * FROM tbaslab where isActive='Y' and jabatan='ASLAB' $search";

        $config['base_url'] = base_url('/index.php/aslab/view_aslabKabid');
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
    }

    function select_data($id){
        $hasil=$this->db->query("SELECT * FROM tbaslab where idAslab='$id'");
        return $hasil;
    }

    function input_data_aslab($data,$table){
        $this->db->insert($table,$data);
    }

    function update_data_aslab($where,$data,$table){
        $this->db->where($where);
        $this->db->update($table,$data);
    }

    function hapus_data_aslab($where,$data,$table){
        $this->db->where($where);
        $this->db->update($table,$data);
    }

    public function cekkodeAslab()
    {
        $query = $this->db->query("SELECT MAX(idAslab) as kodeAslab from tbaslab");
        $hasil = $query->row();
        return $hasil->kodeAslab;
    }
    
}

?>