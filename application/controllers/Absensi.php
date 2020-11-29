<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Absensi extends CI_Controller{
	function __construct(){
		parent::__construct();		
		$this->load->model('m_absensi');
        $this->model = $this->m_absensi;
        $this->load->library('mc_table');
	}

	public function printAbsensiRekap(){
		$From 		= $this->input->post('FromDone');
		$Until 		= $this->input->post('UntilDone');
		$query = $this->db->query("SELECT * FROM tbabsensi as a INNER JOIN tbaslab as b ON b.idAslab=a.idAslab where (tgl >='$From' AND tgl<='$Until')")->result();
		$data['troble'] = $query;
		$this->load->view('pdf/l_Absensi',$data);
    }

	public function proses_cek_absensi()
	{
		if(isset($_POST['send'])){

		$arr= array();
			if(isset($_POST["credential"]))
			{
				date_default_timezone_set('Asia/Jakarta');
    			$tgl 		= date('Y-m-d');
    			$waktuAbsen = date('H:i:s');
				$where = array(
					'idAslab' 	=> $_POST["credential"],
					'isActive'	=> 'Y'
				);
				$data['DoneAslabData'] = $this->m_absensi->cek_aslab("tbaslab",$where)->result();
				// echo $data['loginData'];
				foreach ($data['DoneAslabData'] as $data1) {
			 		# code...
			 		$namaAslab=$data1->nama;
			 	}
				// $cek = $this->m_absensi->cek_aslab("tbaslab",$where)->num_rows();
				if ($namaAslab == "") {
					$arr['absen'] = false;
				}else{
					$wherein = array(
						'idAslab' 	=> $_POST["credential"],
						'tgl'		=> $tgl
					);
					$cekIn = $this->m_absensi->cek_aslab("tbabsensi",$wherein)->num_rows();
					if ($cekIn > 0) {
						# absen keluar
						// $whereAbsen = array(
						// 	'idAslab' 	=> $_POST["credential"],
						// 	'tgl'		=> $tgl
						// );
						// $data = array(
						// 	'a_out'  		=> $waktuAbsen
						// );
						// $this->m_absensi->absen_keluar($whereAbsen,$data,'tbabsensi');
						$arr['absen'] = true;
						$arr['status'] = "Keluar";
						$arr['idAslab'] = $_POST["credential"];
						// $arr = array('success' => "Login Masuk");
					}else{
						# absen masuk
						// $data = array(
						// 	'idAslab'		=> $_POST["credential"],
						// 	'tgl'      		=> $tgl,
						// 	'a_in'     		=> $waktuAbsen,
						// 	'a_out'  		=> "",
						// 	'keterangan'	=> ""
						// );
						// $this->m_absensi->absen_masuk($data,'tbabsensi');
						$arr['absen'] = true;
						$arr['status'] = "Masuk";
						$arr['idAslab'] = $_POST["credential"];
					}
				}
				$arr['namaAslab']=$namaAslab;
				
				echo json_encode($arr);
			}
		}
	}

	public function proses_absensi()
	{
		date_default_timezone_set('Asia/Jakarta');
    	$tgl 		= date('Y-m-d');
    	$waktuAbsen = date('H:i:s');
    	$ID 		= $this->input->post('id_aslab');
		$Nama		= $this->input->post('nama_aslab');

		if ($_POST['insert']=="Absen Keluar") {
			// absen keluar
			$whereAbsen = array(
				'idAslab' 	=> $ID,
				'tgl'		=> $tgl
			);
			$data = array(
				'a_out'  		=> $waktuAbsen
			);
			$this->m_absensi->absen_keluar($whereAbsen,$data,'tbabsensi');
			echo '<script language="javascript">window.alert("'.$Nama.' successfully absent!");
    		window.location.href="../auth/dashboard";</script>';
		}else if ($_POST['insert']=="Absen Masuk"){
			// absen masuk
			$data = array(
				'idAslab'		=> $ID,
				'tgl'      		=> $tgl,
				'a_in'     		=> $waktuAbsen,
				'a_out'  		=> "",
				'keterangan'	=> ""
			);
			$this->m_absensi->absen_masuk($data,'tbabsensi');
			echo '<script language="javascript">window.alert("'.$Nama.' successfully absent!"), window.location.href="../auth/dashboard";</script>';
		}
		
	}

	//KABID
	public function view_absensiKabid()
	{
		if(isset($_POST['filter'])){
			$nama 			= $this->input->post('Nama');
			$tanggal 		= $this->input->post('Tanggal');
			$searchNama='';
			$searchTgl='';
			if (!empty($nama)) {
				$searchNama ="and tbaslab.nama like '%".$nama."%'";
			}
			if (!empty($tanggal)) {
				$searchTgl ="and tbabsensi.tgl = '".$tanggal."'";
			}
			$search = $searchNama.' '.$searchTgl;
		}
		else{
			$search ='';
		}
		// $data['hotspot'] = $this->m_absensi->tampil_dataKabid($search)->result();
		// $this->load->view('kabid/v_absensi',$data);
		$data['hotspot'] = $this->m_absensi->tampil_dataKabid($search);
		$this->load->view('kabid/v_absensi', $data);
	}

	public function delete_data_aslabKabid($id){
		$data = array(
			'isActive'   => 'N'
		);
		$where = array(
			'idAslab' => $id
		);
		$this->m_aslab->hapus_data_absensi($where,$data,'tbabsensi');
		redirect('absensi/view_absensiKabid');
	}
	//KABID END

	//KARYAWAN
	public function view_absensiKaryawan()
	{
		if(isset($_POST['filter'])){
			$nama 			= $this->input->post('Nama');
			$tanggal 		= $this->input->post('Tanggal');
			$searchNama='';
			$searchTgl='';
			if (!empty($nama)) {
				$searchNama ="and tbaslab.nama like '%".$nama."%'";
			}
			if (!empty($tanggal)) {
				$searchTgl ="and tbabsensi.tgl = '".$tanggal."'";
			}
			$search = $searchNama.' '.$searchTgl;
		}
		else{
			$search ='';
		}
		$data['hotspot'] = $this->m_absensi->tampil_dataKabid($search)->result();
		$this->load->view('karyawan/v_absensi',$data);
	}

	public function delete_data_aslabKaryawan($id){
		$data = array(
			'isActive'   => 'N'
		);
		$where = array(
			'idAslab' => $id
		);
		$this->m_aslab->hapus_data_absensi($where,$data,'tbabsensi');
		redirect('absensi/view_absensiKabid');
	}

	//KARYAWAN END

	//ASLAB

	public function view_absensiAslab()
	{
		$username 		= $this->session->userdata('username');
		$idAslab 		= $this->session->userdata('idLogin');
		if(isset($_POST['filter'])){
			$tanggal 		= $this->input->post('Tanggal');
			$search ="and tbabsensi.idAslab='$idAslab' and tbaslab.username ='$username' and tbabsensi.tgl = '".$tanggal."'";
		}
		else{
			$search ="and tbabsensi.idAslab='$idAslab'";
		}
		$data['hotspot'] = $this->m_absensi->tampil_dataKabid($search)->result();
		$this->load->view('aslab/v_absensi',$data);
	}

	//ASLAB END
}
?>