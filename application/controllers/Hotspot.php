<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Hotspot extends CI_Controller{
	function __construct(){
		parent::__construct();		
		$this->load->model('m_hotspot');
        $this->model = $this->m_hotspot;
	}

	public function view_hotspotKabid()
	{
		if ($_GET)
		{
			$search="and NIM ='".$_GET['search']."'";
		}
		else{
			$search='';
		}
		$data['hotspot'] = $this->m_hotspot->tampil_data($search)->result();
		$this->load->view('kabid/v_hotspot',$data);
	}

	public function view_hotspot()
	{
		if ($_GET)
		{
			$search="and NIM ='".$_GET['search']."'";
		}
		else{
			$search='';
		}
		$data['hotspot'] = $this->m_hotspot->tampil_data($search)->result();
		$jabatanLogin = $this->session->userdata('jabatan');
		if ($jabatanLogin=='KARYAWAN') {
			$this->load->view('karyawan/v_hotspot',$data);
		}elseif($jabatanLogin=='ASLAB'){
			$this->load->view('aslab/v_hotspot',$data);
		}
	}

	public function simpan_hotspot()
	{
		if ($_GET)
		{
			redirect('hotspot/view_hotspot?search='.$_GET['search']);
		}
		else{
			if ($_POST['insert']=="Simpan") {
				$NIM = $this->input->post('NIM');
				$Nama = $this->input->post('nama');
				$password = $this->input->post('password');
				$cekNIM = $this->m_hotspot->ceknimHotspot($NIM);
				// echo $cekNIM;
				if ($cekNIM=0) {

					$dariDB = $this->m_hotspot->cekkodeHotspot();
			        // contoh JRD0004, angka 3 adalah awal pengambilan angka, dan 4 jumlah angka yang diambil
			        $kodeHotspot = $dariDB + 1;
			 
					$data = array(
						'IdDaftar_h' => $kodeHotspot,
						'NIM' => $NIM,
						'nama' => $Nama,
						'password' => $password,
						'tglldftr' => date('y-m-d'),
						'status'=>"New",
						'isActive'=>"Active"
						);
					$this->m_hotspot->input_data_hotspot($data,'tbhotspot');
		        	echo '<script>alert("NIM berhasil didaftarkan !");</script>';
					$data['hotspot'] = $this->m_hotspot->tampil_data()->result();
					$jabatanLogin = $this->session->userdata('jabatan');
					if ($jabatanLogin=='KARYAWAN') {
						$this->load->view('karyawan/v_hotspot',$data);
					}elseif($jabatanLogin=='ASLAB'){
						$this->load->view('aslab/v_hotspot',$data);
					}
				}else{
					echo '<script>alert("NIM sudah terdaftar, tidak bisa di daftarkan lagi !");</script>';
					$data['hotspot'] = $this->m_hotspot->tampil_data()->result();
					$jabatanLogin = $this->session->userdata('jabatan');
					if ($jabatanLogin=='KARYAWAN') {
						$this->load->view('karyawan/v_hotspot',$data);
					}elseif($jabatanLogin=='ASLAB'){
						$this->load->view('aslab/v_hotspot',$data);
					}
				}
			}elseif ($_POST['insert']=="Perbarui") {
				$NIM = $this->input->post('NIM');
				$password = $this->input->post('password');
				$data = array(
					'password' => $password
				);
			 
				$where = array(
					'NIM' => $NIM
				);
			 
				$this->m_hotspot->update_data_hotspot($where,$data,'tbhotspot');
				echo '<script>alert("NIM berhasil diperbarui !");</script>';
				$jabatanLogin = $this->session->userdata('jabatan');
				if ($jabatanLogin=='KARYAWAN') {
					$this->load->view('karyawan/v_hotspot',$data);
				}elseif($jabatanLogin=='ASLAB'){
					$this->load->view('aslab/v_hotspot',$data);
				}
			}
			else{
				redirect('hotspot/view_hotspot');
			}
		}

		
	}

	public function tampil_hotspot()
	{
		if(isset($_POST["employee_id"]))
		{
			$data['hotspot'] = $this->m_hotspot->select_data($_POST["employee_id"])->result();
		    foreach($data as $item){
		        echo json_encode($item[0]);
		    }
		}
	}

	public function delete_data_hotspot($id){
		$data = array(
				'isActive' => 'Non Active'
			);
		$where = array(
				'idDaftar_h' => $id
			);
		$this->m_hotspot->hapus_data_hotspot($where,$data,'tbhotspot');
		redirect('hotspot/view_hotspot');
	}

	public function update_status_hotspot($id){
		$data = array(
				'status' => 'Registered'
			);
		$where = array(
				'idDaftar_h' => $id
			);
		$this->m_hotspot->hapus_data_hotspot($where,$data,'tbhotspot');
		redirect('hotspot/view_hotspot');
	}
}
?>