<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Jadwal extends CI_Controller{
	function __construct(){
		parent::__construct();		
		$this->load->model('m_jadwal');
        $this->model = $this->m_jadwal;
	}
	//KABID
	public function view_jadwalKabid()
	{
		if ($_GET)
		{
			$search="where Nama like '%".$_GET['search']."%'";
			$data['dd_aslab'] = $this->m_jadwal->getAslab();
			$data['hotspot'] = $this->m_jadwal->tampil_data($search);
			$this->load->view('kabid/v_jadwal',$data);
		}
		else{
			$search='';
			if(isset($_POST['insert'])){
				if ($_POST['insert']=="Simpan Jadwal") {
					$Aslab 			= $this->input->post('Aslab');
					$Jadwal 		= $this->input->post('Jadwal');
					$Sift	 		= $this->input->post('Sift');
					$Lokasi	 		= $this->input->post('lokasi');
					
					$dariDB = $this->m_jadwal->cekkodejadwal();
				    $nourut = substr($dariDB, 3, 4);
				    $nourut = $nourut+1;
				    $kodemax = str_pad($nourut, 4, "0", STR_PAD_LEFT);
	        		$kodeBarangSekarang = "JDW".($kodemax);
				 
				    $data = array(
						'idjadwal'   	=> $kodeBarangSekarang,
						'idAslab'      	=> $Aslab,
						'Jadwal'     	=> $Jadwal,
						'shift'		  	=> $Sift,
						'lokasi'		=> $Lokasi
					);
					$this->m_jadwal->input_data_jadwal($data,'tbjadwal');
			       	echo '<script>alert("Jadwal baru berhasil ditambahkan !");</script>';
			       	$data['dd_aslab'] = $this->m_jadwal->getAslab();
					$data['hotspot'] = $this->m_jadwal->tampil_data($search);
					$this->load->view('kabid/v_jadwal',$data);

				}elseif ($_POST['insert']=="Perbarui Jadwal") {
					$ID 			= $this->input->post('employee_id');
					$Aslab 			= $this->input->post('Aslab');
					$Jadwal 		= $this->input->post('Jadwal');
					$Sift	 		= $this->input->post('Sift');
					$Lokasi	 		= $this->input->post('lokasi');

					$data = array(
						'idAslab'      	=> $Aslab,
						'Jadwal'     	=> $Jadwal,
						'shift'		  	=> $Sift,
						'lokasi'		=> $Lokasi
					);
				 
					$where = array(
						'idjadwal' => $ID
					);
				 
					$this->m_jadwal->update_data_jadwal($where,$data,'tbjadwal');
					echo '<script>alert("Data jadwal berhasil diperbarui !");</script>';
					$search='';
					$data['dd_aslab'] = $this->m_jadwal->getAslab();
					$data['hotspot'] = $this->m_jadwal->tampil_data($search);
					$this->load->view('kabid/v_jadwal',$data);
				}
			}
			else{
				$data['dd_aslab'] = $this->m_jadwal->getAslab();
				$data['hotspot'] = $this->m_jadwal->tampil_data($search);
				$this->load->view('kabid/v_jadwal',$data);
			}
		}
		
	}
	//KABID END
	//KARYAWAN
	public function view_jadwal()
	{
		if ($_GET)
		{
			$search="where Nama like '%".$_GET['search']."%'";
			$data['dd_aslab'] = $this->m_jadwal->getAslab();
			$data['hotspot'] = $this->m_jadwal->tampil_data($search)->result();
			$this->load->view('karyawan/v_jadwal',$data);
		}
		else{
			$search='';
			if(isset($_POST['insert'])){
				if ($_POST['insert']=="Simpan Jadwal") {
					$Aslab 			= $this->input->post('Aslab');
					$Jadwal 		= $this->input->post('Jadwal');
					$Sift	 		= $this->input->post('Sift');
					$Lokasi	 		= $this->input->post('lokasi');
					
					$dariDB = $this->m_jadwal->cekkodejadwal();
				    $nourut = substr($dariDB, 3, 4);
				    $nourut = $nourut+1;
				    $kodemax = str_pad($nourut, 4, "0", STR_PAD_LEFT);
	        		$kodeBarangSekarang = "JDW".($kodemax);
				 
				    $data = array(
						'idjadwal'   	=> $kodeBarangSekarang,
						'idAslab'      	=> $Aslab,
						'Jadwal'     	=> $Jadwal,
						'shift'		  	=> $Sift,
						'lokasi'		=> $Lokasi
					);
					$this->m_jadwal->input_data_jadwal($data,'tbjadwal');
			       	echo '<script>alert("Jadwal baru berhasil ditambahkan !");</script>';
			       	$data['dd_aslab'] = $this->m_jadwal->getAslab();
					$data['hotspot'] = $this->m_jadwal->tampil_data($search)->result();
					$this->load->view('karyawan/v_jadwal',$data);

				}elseif ($_POST['insert']=="Perbarui Jadwal") {
					$ID 			= $this->input->post('employee_id');
					$Aslab 			= $this->input->post('Aslab');
					$Jadwal 		= $this->input->post('Jadwal');
					$Sift	 		= $this->input->post('Sift');
					$Lokasi	 		= $this->input->post('lokasi');

					$data = array(
						'idAslab'      	=> $Aslab,
						'Jadwal'     	=> $Jadwal,
						'shift'		  	=> $Sift,
						'lokasi'		=> $Lokasi
					);
				 
					$where = array(
						'idjadwal' => $ID
					);
				 
					$this->m_jadwal->update_data_jadwal($where,$data,'tbjadwal');
					echo '<script>alert("Data jadwal berhasil diperbarui !");</script>';
					$search='';
					$data['dd_aslab'] = $this->m_jadwal->getAslab();
					$data['hotspot'] = $this->m_jadwal->tampil_data($search)->result();
					$this->load->view('karyawan/v_jadwal',$data);
				}
			}
			else{
				$data['dd_aslab'] = $this->m_jadwal->getAslab();
				$data['hotspot'] = $this->m_jadwal->tampil_data($search)->result();
				$this->load->view('karyawan/v_jadwal',$data);
			}
		}
		
	}

	public function tampil_jadwal()
	{
		if(isset($_POST["employee_id"]))
		{
			$data['hotspot'] = $this->m_jadwal->select_data($_POST["employee_id"])->result();
		    foreach($data as $item){
		        echo json_encode($item[0]);
		    }
		}
	}

	public function delete_data_jadwal($id){
		$where = array(
				'idjadwal' => $id
			);
		$this->m_jadwal->hapus_data_jadwal($where,'tbjadwal');
		redirect('jadwal/view_jadwal');
	}
	//KARYAWAN END
	//ASLAB
	public function view_jadwalAslab()
	{
		if ($_GET)
		{
			$id=$this->session->userdata('idLogin');
			$search="where tbjadwal.idAslab='$id'";
			$data['dd_aslab'] = $this->m_jadwal->getAslab();
			$data['hotspot'] = $this->m_jadwal->tampil_data($search);
			$this->load->view('aslab/v_jadwal',$data);
		}
		else{
			$search='';
			if(isset($_POST['insert'])){
				if ($_POST['insert']=="Simpan Jadwal") {
					$Aslab 			= $this->input->post('Aslab');
					$Jadwal 		= $this->input->post('Jadwal');
					$Sift	 		= $this->input->post('Sift');
					
					$dariDB = $this->m_jadwal->cekkodejadwal();
				    $nourut = substr($dariDB, 3, 4);
				    $nourut = $nourut+1;
				    $kodemax = str_pad($nourut, 4, "0", STR_PAD_LEFT);
	        		$kodeBarangSekarang = "JDW".($kodemax);
				 
				    $data = array(
						'idjadwal'   	=> $kodeBarangSekarang,
						'idAslab'      	=> $Aslab,
						'Jadwal'     	=> $Jadwal,
						'shift'		  	=> $Sift
					);
					$this->m_jadwal->input_data_jadwal($data,'tbjadwal');
			       	echo '<script>alert("Jadwal baru berhasil ditambahkan !");</script>';
			       	$id=$this->session->userdata('idLogin');
					$search="where tbjadwal.idAslab='$id'";
			       	$data['dd_aslab'] = $this->m_jadwal->getAslab();
					$data['hotspot'] = $this->m_jadwal->tampil_data($search);
					$this->load->view('aslab/v_jadwal',$data);

				}elseif ($_POST['insert']=="Perbarui Jadwal") {
					$ID 			= $this->input->post('employee_id');
					$Aslab 			= $this->input->post('Aslab');
					$Jadwal 		= $this->input->post('Jadwal');
					$Sift	 		= $this->input->post('Sift');

					$data = array(
						'idAslab'      	=> $Aslab,
						'Jadwal'     	=> $Jadwal,
						'shift'		  	=> $Sift
					);
				 
					$where = array(
						'idjadwal' => $ID
					);
				 
					$this->m_jadwal->update_data_jadwal($where,$data,'tbjadwal');
					echo '<script>alert("Data jadwal berhasil diperbarui !");</script>';
					$id=$this->session->userdata('idLogin');
					$search="where tbjadwal.idAslab='$id'";
					$data['dd_aslab'] = $this->m_jadwal->getAslab();
					$data['hotspot'] = $this->m_jadwal->tampil_data($search);
					$this->load->view('aslab/v_jadwal',$data);
				}
			}
			else{
				$id=$this->session->userdata('idLogin');
				$search="where tbjadwal.idAslab='$id'";
				$data['dd_aslab'] = $this->m_jadwal->getAslab();
				$data['hotspot'] = $this->m_jadwal->tampil_data($search);
				$this->load->view('aslab/v_jadwal',$data);
			}
		}
		
	}
	
	public function delete_data_jadwalAslab($id){
		$where = array(
				'idjadwal' => $id
			);
		$this->m_jadwal->hapus_data_jadwal($where,'tbjadwal');
		redirect('jadwal/view_jadwalAslab');
	}
	//ASLAB END
}
?>