<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Trobleshoot extends CI_Controller{
	function __construct(){
		parent::__construct();		
		$this->load->model('m_troble');
        $this->model = $this->m_troble;
        $this->load->library('mc_table');
	}	

	public function total_troble()
	{
		if(isset($_POST["employee_id"]))
		{
			$data['hotspot'] = $this->m_troble->total_troble($_POST["employee_id"])->result();
		    foreach($data as $item){
		        echo json_encode($item[0]);
		    }
		}
	}

	public function tampil_troble()
	{
		if(isset($_POST["employee_id"]))
		{
			$data['hotspot'] = $this->m_troble->select_data($_POST["employee_id"])->result();
		    foreach($data as $item){
		        echo json_encode($item[0]);
		    }
		}
	}

	public function view_trobleDone($id)
	{
		$data_session = array(
			'idTrouble' => $id
		);
		$this->session->set_userdata($data_session);
		if ($this->session->userdata('jabatan')=="KABID") {
			$this->load->view('kabid/v_trobleDone');
		}else if ($this->session->userdata('jabatan')=="KARYAWAN") {
			$this->load->view('kabid/v_trobleDone');
		}else if ($this->session->userdata('jabatan')=="ASLAB") {
			$this->load->view('aslab/v_trobleDone');
		}
	}

	public function proses_trouble_done()
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

				$data['DoneAslabData'] = $this->m_troble->cek_Aslab("tbaslab",$where)->result();
				// echo $data['loginData'];
				foreach ($data['DoneAslabData'] as $data1) {
			 		# code...
			 		$namaAslab=$data1->nama;
			 	}
				// $arr['absen'] = $this->session->userdata('idTrouble');
				if ($namaAslab=="") {
					$arr['status']=false;
				}else{
					$whereDone = array(
						'idPenanganan' 	=> $this->session->userdata('idTrouble')
					);
					$data = array(
						'Teknisi'  		=> $namaAslab,
						'tgperbaikan'	=> $tgl,
						'solusi'		=> $_POST["solusi"],
						'status'		=> 'Done'
					);
					$this->m_troble->update_data_troble($whereDone,$data,'tbtroubleshooting');
					$arr['userLogin']=$this->session->userdata('jabatan');
					$arr['status']=true;
					$arr['namaDone']=$namaAslab;
					$arr['solusi']=$_POST["solusi"];

				}
				echo json_encode($arr);
			}
		}
	}

	//KABID

	public function view_trobleKabid()
	{
		if ($_GET)
		{
			$search="and Deskripsi like '%".$_GET['search']."%'";
		}
		else{
			$search='';
		}
		$data['hotspot'] = $this->m_troble->tampil_data($search)->result();
		$data['hotspotDone'] = $this->m_troble->tampil_data_done($search)->result();
		$this->load->view('kabid/v_trobleshoot',$data);
	}

	public function simpan_trobleKabid()
	{
		if ($_GET)
		{
			redirect('trobleshoot/view_trobleKabid?search='.$_GET['search']);
		}
		else{
			if ($_POST['insert']=="Simpan") {
				$Jenis 			= $this->input->post('Jenis');
				$Pelapor 		= $this->input->post('Pelapor');
				$Lapor 			= $this->input->post('Lapor');
				// $Perbaikan 		= $this->input->post('Perbaikan');
				// $Teknisi 		= $this->input->post('Teknisi');
				$Description 	= $this->input->post('Description');
				
				$dariDB = $this->m_troble->cekkodeTroble();
			    $kodeTroble = $dariDB + 1;
			 
				$data = array(
					'idPenanganan' => $kodeTroble,
					'Jenismslh'    => $Jenis,
					'Pelapor'      => $Pelapor,
					'tgllapor'     => $Lapor,
					'tgperbaikan'  => '',
					'Teknisi'      => '',
					'Deskripsi'    => $Description,
					'status'	   => 'New'
						);
				$this->m_troble->input_data_troble($data,'tbtroubleshooting');
		        	echo '<script>alert("Troubleshooting berhasil ditambahkan !");</script>';
		        	$search='';
					$data['hotspot'] = $this->m_troble->tampil_data($search)->result();
					$data['hotspotDone'] = $this->m_troble->tampil_data_done($search)->result();
					$this->load->view('kabid/v_trobleshoot',$data);

			}elseif ($_POST['insert']=="Perbarui") {
				$ID 			= $this->input->post('employee_id');
				$Jenis 			= $this->input->post('Jenis');
				$Pelapor 		= $this->input->post('Pelapor');
				$Lapor 			= $this->input->post('Lapor');
				// $Perbaikan 		= $this->input->post('Perbaikan');
				// $Teknisi 		= $this->input->post('Teknisi');
				$Description 	= $this->input->post('Description');

				$data = array(
					'Jenismslh'    => $Jenis,
					'Pelapor'      => $Pelapor,
					'tgllapor'     => $Lapor,
					// 'tgperbaikan'  => $Perbaikan,
					// 'Teknisi'      => $Teknisi,
					'Deskripsi'    => $Description
				);
			 
				$where = array(
					'idPenanganan' => $ID
				);
			 
				$this->m_troble->update_data_troble($where,$data,'tbtroubleshooting');
				echo '<script>alert("Troubleshooting berhasil diperbarui !");</script>';
				$search='';
				$data['hotspot'] = $this->m_troble->tampil_data($search)->result();
				$data['hotspotDone'] = $this->m_troble->tampil_data_done($search)->result();
				$this->load->view('kabid/v_trobleshoot',$data);
			}else{
				redirect('trobleshoot/view_trobleKabid');
			}
		}
	}

	public function delete_data_trobleKabid($id){
		$where = array(
				'idPenanganan' => $id
			);
		$this->m_troble->hapus_data_troble($where,'tbtroubleshooting');
		redirect('trobleshoot/view_trobleKabid');
	}

	public function printTroubleNew(){
		$From 		= $this->input->post('From');
		$Until 		= $this->input->post('Until');
		$query = $this->db->query("SELECT * from tbtroubleshooting where status='New' and (tgllapor>='$From' or tgllapor<='$Until')")->result();
		$data['troble'] = $query;
		$this->load->view('pdf/l_Troubleshoot',$data);
    }

    public function printTroubleDone(){
		$From 		= $this->input->post('FromDone');
		$Until 		= $this->input->post('UntilDone');
		$query = $this->db->query("SELECT * from tbtroubleshooting where status='Done' and (tgperbaikan>='$From' AND tgperbaikan<='$Until')")->result();
		$data['troble'] = $query;
		$this->load->view('pdf/l_Troubleshoot',$data);
    }

	//KABID END
    //KARYAWAN END
	public function view_troble()
	{
		if ($_GET)
		{
			$search="where Deskripsi like '%".$_GET['search']."%'";
		}
		else{
			$search='';
		}
		$data['hotspot'] = $this->m_troble->tampil_data($search)->result();
		$data['hotspotDone'] = $this->m_troble->tampil_data_done($search)->result();
		$this->load->view('karyawan/v_trobleshoot',$data);
	}

	public function simpan_troble()
	{
		if ($_GET)
		{
			redirect('trobleshoot/view_troble?search='.$_GET['search']);
		}
		else{
			if(isset($_POST['insert'])){
				if ($_POST['insert']=="Simpan") {
					$Jenis 			= $this->input->post('Jenis');
					$Pelapor 		= $this->input->post('Pelapor');
					$Lapor 			= $this->input->post('Lapor');
					// $Perbaikan 		= $this->input->post('Perbaikan');
					// $Teknisi 		= $this->input->post('Teknisi');
					$Description 	= $this->input->post('Description');
					
					$dariDB = $this->m_troble->cekkodeTroble();
				    $kodeTroble = $dariDB + 1;
				 
					$data = array(
						'idPenanganan' => $kodeTroble,
						'Jenismslh'    => $Jenis,
						'Pelapor'      => $Pelapor,
						'tgllapor'     => $Lapor,
						'tgperbaikan'  => '',
						'Teknisi'      => '',
						'Deskripsi'    => $Description,
						'status'	   => 'New'
							);
					$this->m_troble->input_data_troble($data,'tbtroubleshooting');
			        	echo '<script>alert("Troubleshooting berhasil ditambahkan !");</script>';
			        	$search='';
						$data['hotspot'] = $this->m_troble->tampil_data($search)->result();
						$data['hotspotDone'] = $this->m_troble->tampil_data_done($search)->result();
						$this->load->view('karyawan/v_trobleshoot',$data);

				}elseif ($_POST['insert']=="Perbarui") {
					$ID 			= $this->input->post('employee_id');
					$Jenis 			= $this->input->post('Jenis');
					$Pelapor 		= $this->input->post('Pelapor');
					$Lapor 			= $this->input->post('Lapor');
					// $Perbaikan 		= $this->input->post('Perbaikan');
					// $Teknisi 		= $this->input->post('Teknisi');
					$Description 	= $this->input->post('Description');

					$data = array(
						'Jenismslh'    => $Jenis,
						'Pelapor'      => $Pelapor,
						'tgllapor'     => $Lapor,
						// 'tgperbaikan'  =>$Perbaikan,
						// 'Teknisi'      => $Teknisi,
						'Deskripsi'    =>$Description
					);
				 
					$where = array(
						'idPenanganan' => $ID
					);
				 
					$this->m_troble->update_data_troble($where,$data,'tbtroubleshooting');
					echo '<script>alert("Troubleshooting berhasil diperbarui !");</script>';
					$search='';
					$data['hotspot'] = $this->m_troble->tampil_data($search)->result();
					$data['hotspotDone'] = $this->m_troble->tampil_data_done($search)->result();
					$this->load->view('karyawan/v_trobleshoot',$data);
				}
			}
			elseif(isset($_POST['done'])){
				if ($_POST['done']=="Done") {
					$ID 			= $this->input->post('employee_id');
					$data = array(
						'status'    => 'Done'
					);
				 
					$where = array(
						'idPenanganan' => $ID
					);
				 
					$this->m_troble->update_data_troble($where,$data,'tbtroubleshooting');
					echo '<script>alert("Troubleshooting selesai di perbaiki !");</script>';
					$search='';
					$data['hotspot'] = $this->m_troble->tampil_data($search)->result();
					$data['hotspotDone'] = $this->m_troble->tampil_data_done($search)->result();
					$this->load->view('karyawan/v_trobleshoot',$data);
				}
			}
			else{
				redirect('trobleshoot/view_troble');
			}
		}
	}

	public function delete_data_troble($id){
		$where = array(
				'idPenanganan' => $id
			);
		$this->m_troble->hapus_data_troble($where,'tbtroubleshooting');
		redirect('trobleshoot/view_troble');
	}
	//KARYAWAN END

	//ASLAB
	public function view_trobleAslab()
	{
		if ($_GET)
		{
			$search="and Deskripsi like '%".$_GET['search']."%'";
		}
		else{
			$search='';
		}
		$data['hotspot'] = $this->m_troble->tampil_data($search)->result();
		$data['hotspotDone'] = $this->m_troble->tampil_data_done($search)->result();
		$this->load->view('aslab/v_trobleshoot',$data);
	}

	public function simpan_trobleAslab()
	{
		if ($_GET)
		{
			redirect('trobleshoot/view_trobleAslab?search='.$_GET['search']);
		}
		else{
			if(isset($_POST['insert'])){
				if ($_POST['insert']=="Simpan") {
					$Jenis 			= $this->input->post('Jenis');
					$Pelapor 		= $this->input->post('Pelapor');
					$Lapor 			= $this->input->post('Lapor');
					// $Perbaikan 		= $this->input->post('Perbaikan');
					// $Teknisi 		= $this->input->post('Teknisi');
					$Description 	= $this->input->post('Description');
					
					$dariDB = $this->m_troble->cekkodeTroble();
				    $kodeTroble = $dariDB + 1;
				 
					$data = array(
						'idPenanganan' => $kodeTroble,
						'Jenismslh'    => $Jenis,
						'Pelapor'      => $Pelapor,
						'tgllapor'     => $Lapor,
						'tgperbaikan'  => '',
						'Teknisi'      => '',
						'Deskripsi'    => $Description,
						'status'	   => 'New'
							);
					$this->m_troble->input_data_troble($data,'tbtroubleshooting');
			        	echo '<script>alert("Troubleshooting berhasil ditambahkan !");</script>';
			        	$search='';
						$data['hotspot'] = $this->m_troble->tampil_data($search)->result();
						$data['hotspotDone'] = $this->m_troble->tampil_data_done($search)->result();
						$this->load->view('aslab/v_trobleshoot',$data);

				}elseif ($_POST['insert']=="Perbarui") {
					$ID 			= $this->input->post('employee_id');
					$Jenis 			= $this->input->post('Jenis');
					$Pelapor 		= $this->input->post('Pelapor');
					$Lapor 			= $this->input->post('Lapor');
					// $Perbaikan 		= $this->input->post('Perbaikan');
					// $Teknisi 		= $this->input->post('Teknisi');
					$Description 	= $this->input->post('Description');

					$data = array(
						'Jenismslh'    => $Jenis,
						'Pelapor'      => $Pelapor,
						'tgllapor'     => $Lapor,
						// 'tgperbaikan'  =>$Perbaikan,
						// 'Teknisi'      => $Teknisi,
						'Deskripsi'    =>$Description
					);
				 
					$where = array(
						'idPenanganan' => $ID
					);
				 
					$this->m_troble->update_data_troble($where,$data,'tbtroubleshooting');
					echo '<script>alert("Troubleshooting berhasil diperbarui !");</script>';
					$search='';
					$data['hotspot'] = $this->m_troble->tampil_data($search)->result();
					$data['hotspotDone'] = $this->m_troble->tampil_data_done($search)->result();
					$this->load->view('aslab/v_trobleshoot',$data);
				}
			}
			elseif(isset($_POST['done'])){
				if ($_POST['done']=="Done") {

					$data = array(
						'status'    => 'Done'
					);
				 
					$where = array(
						'idPenanganan' => $ID
					);
				 
					$this->m_troble->update_data_troble($where,$data,'tbtroubleshooting');
					echo '<script>alert("Troubleshooting selesai di perbaiki !");</script>';
					$search='';
					$data['hotspot'] = $this->m_troble->tampil_data($search)->result();
					$data['hotspotDone'] = $this->m_troble->tampil_data_done($search)->result();
					$this->load->view('aslab/v_trobleshoot',$data);
				}
			}else{
				redirect('trobleshoot/view_trobleAslab');
			}
		}
	}

	public function delete_data_trobleAslab($id){
		$where = array(
				'idPenanganan' => $id
			);
		$this->m_troble->hapus_data_troble($where,'tbtroubleshooting');
		redirect('trobleshoot/view_trobleAslab');
	}
	//ASLAB END
}
?>