<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller{
	function __construct(){
		parent::__construct();
		$this->load->model('m_login');		
		$this->load->model('m_register');
        $this->model = $this->m_login;	
		$this->load->model('m_absensi');
        $this->model = $this->m_absensi;
	}

	public function dashboard()
	{
		if ($this->session->userdata('status')=="login") {
			if ($this->session->userdata('jabatan')=="KABID") {
				// $this->load->view('kabid/v_dashboard');
				redirect(base_url('absensi/view_absensiKabid'));
			// }else if ($this->session->userdata('jabatan')=="KARYAWAN") {
			// 	$this->load->view('karyawan/v_dashboard');
			}else if ($this->session->userdata('jabatan')=="ASLAB") {
				$username 		= $this->session->userdata('username');
				$idAslab 		= $this->session->userdata('idLogin');
				// if(isset($_POST['filter'])){
				// 	$tanggal 		= $this->input->post('Tanggal');
				// 	$search ="and tbabsensi.idAslab='$idAslab' and tbaslab.username ='$username' and tbabsensi.tgl = ".$tanggal."'";
				// }
				// else{
				// 	$search ="and tbabsensi.idAslab='$idAslab'";
				// }

				if ($_GET)
				{
					$search ="and tbabsensi.idAslab='$idAslab' and tbaslab.username ='$username' and tbabsensi.tgl = '".$_GET['search']."'";
				}
				else{
					$search ="and tbabsensi.idAslab='$idAslab'";
				}

				$data['hotspot'] = $this->m_absensi->tampil_dataKabid($search);
				$this->load->view('aslab/v_dashboard',$data);
			}
		}else{
			//$this->load->view('landingPages');
			$this->load->view('loginPages/v_login');
		}
	}

	public function login()
	{
		$this->load->view('loginPages/v_login');
	}

	public function ProfilUser(){
		if(isset($_POST['Simpan'])){
			$nama 			= $this->input->post('Nama');
			$tanggal 		= $this->input->post('Tanggal');
			$tempat 		= $this->input->post('Tempat');
			$jk 			= $this->input->post('jk');
			$notelp 		= $this->input->post('NoTelp');
			$idUser			= $this->session->userdata('idLogin');
			if ($_FILES["imgProfil"]["name"]=='') {
				$profilImg  		= "noimage.jpg";
				$data = array(
					'nama'      	=> $nama,
					'tglLahir'     	=> $tanggal,
					'tempatLahir'  	=> $tempat,
					'jk'     		=> $jk,
					'noTelp'  		=> $notelp
				);
			}else{
				$profilImg  		= $_FILES["imgProfil"]["name"];
				$data = array(
					'nama'      	=> $nama,
					'tglLahir'     	=> $tanggal,
					'tempatLahir'  	=> $tempat,
					'jk'     		=> $jk,
					'noTelp'  		=> $notelp,
					'profileImg' 	=> $profilImg
				);
				$this->_deleteImage($idUser);
			}
			// echo $profilImg;

			$config['upload_path']          = './assets/imgProffile/';
		    $config['allowed_types']        = 'gif|jpg|png';
		    $config['file_name']            = $profilImg;
		    $config['overwrite']			= true;
		    $config['max_size']             = 1024; // 1MB
		    // $config['max_width']            = 1024;
		    // $config['max_height']           = 768;
		    // $this->_deleteImage($idUser);

		 //    $data = array(
			// 	'nama'      	=> $nama,
			// 	'tglLahir'     	=> $tanggal,
			// 	'tempatLahir'  	=> $tempat,
			// 	'jk'     		=> $jk,
			// 	'noTelp'  		=> $notelp,
			// 	'profileImg' 	=> $profilImg
			// );
					 
			$where = array(
				'username' => $this->session->userdata('username')
			);
			

		    $this->load->library('upload', $config);

		    if ($this->upload->do_upload('imgProfil')) {
				$this->m_login->update_data_profil($where,$data,'tbaslab');
				// echo '<script>alert("Data berhasil diperbarui !");</script>';
				$data_session = array(
					'nama' => $nama
					);
				$this->session->set_userdata($data_session);
		    	$where = $this->session->userdata('username');
				$data['profile'] = $this->m_login->tampil_profil_user($where)->result();
				$this->load->view('v_Profile',$data);
		        return $this->upload->data("file_name");
		    }else{

				$this->m_login->update_data_profil($where,$data,'tbaslab');
				// echo '<script>alert("Data berhasil diperbarui !");</script>';
				$data_session = array(
					'nama' => $nama
					);
				$this->session->set_userdata($data_session);
		    }

		}
		$where = $this->session->userdata('username');
		$data['profile'] = $this->m_login->tampil_profil_user($where)->result();
		$this->load->view('v_Profile',$data);
	}

	public function simpan_pass()
	{
		if(isset($_POST['settingPass'])){
			$username 		= $this->session->userdata('username');
			$password 		= $this->input->post('passOld');
			$passwordNew1 	= $this->input->post('passNew');
			$passwordNew2 	= $this->input->post('passNew2');
			$whereSetting = array(
				'username' 	=> $username,
				'pass' 		=> $password,
				'isActive'  => 'Y'
				);
			$cek = $this->m_login->cek_login("tbaslab",$whereSetting)->num_rows();
			if($cek > 0){
				if ($passwordNew1==$passwordNew2) {
					# code...
					// redirect(base_url('auth/ProfilUser'));
					$whereSimpan = array(
						'username' 	=> $username
					);
					$data = array(
						'pass' 		=> $passwordNew1
					);
					$this->m_login->update_pass($whereSimpan,$data,'tbaslab');
					$this->session->sess_destroy();
					echo '<script language="javascript">window.alert("Password berhasil di update, Silahkan login ulang untuk verifikasi !"), window.location.href="../welcome";</script>';
				}else{
					echo '<script language="javascript">window.alert("Password Baru Tidak Sama!"), window.location.href="../auth/ProfilUser";</script>';
				}
			}else{
				// echo '<script>alert("Password Lama Salah");</script>';
				echo '<script language="javascript">window.alert("Password Lama Salah!"), window.location.href="../auth/ProfilUser";</script>';
			}
		}
	}

	private function _deleteImage($id)
	{
	    $product = $this->m_login->getById($id,'tbaslab');
	    if ($product->profileImg != "noimage.jpg") {
		    $filename = explode(".", $product->profileImg)[0];
			return array_map('unlink', glob(FCPATH."assets/imgProffile/$filename.*"));
	    }
	}

	public function aksi_login(){
		$username = $this->input->post('username');
		$password = $this->input->post('password');
		$where = array(
			'username' 	=> $username,
			'pass' 	=> $password,
			'isActive'   => 'Y'
			);
		$cek = $this->m_login->cek_login("tbaslab",$where)->num_rows();
		if($cek > 0){
			$data['loginData'] = $this->m_login->cek_login("tbaslab",$where)->result();
			// echo $data['loginData'];
			foreach ($data['loginData'] as $data1) {
		 			# code...
		 			$namaLogin=$data1->nama;
		 			$idLogin=$data1->idAslab;
		 			$jabatan=$data1->jabatan;
		 			$profileImg=$data1->profileImg;
		 		}
			$data_session = array(
				'nama' => $namaLogin,
				'username'=>$username,
				'jabatan'=>$jabatan,
				'idLogin'=>$idLogin,
				'imgProfile'=>$profileImg,
				'status' => "login"
				);
 
			$this->session->set_userdata($data_session);
 			
			redirect(base_url('auth/dashboard'));
	 
		}else{
			echo '<script>alert("Gagal login");</script>';
			$this->load->view('loginPages/login');
		}
	}

	function tambah_user_hotspot(){

		$NIM = $this->input->post('NIM');
		$nama = $this->input->post('nama');
		$password = $this->input->post('password');
		
		$cekNIM = $this->m_register->ceknimHotspot($NIM);
		// echo $cekNIM;
		if ($cekNIM==0) {

			$dariDB = $this->m_register->cekkodeHotspot();
	        // contoh JRD0004, angka 3 adalah awal pengambilan angka, dan 4 jumlah angka yang diambil
	        $kodeHotspot = $dariDB + 1;
	 
			$data = array(
				'IdDaftar_h' => $kodeHotspot,
				'NIM' => $NIM,
				'nama' => $nama,
				'password' => $password,
				'tglldftr' => date('y-m-d'),
				'status'=>"New",
				'isActive'=>"active"
				);
			$this->m_register->input_data_hotspot($data,'tbhotspot');
			echo '<script>alert("NIM berhasil didaftarkan");</script>';
			$this->load->view('landingPages');
		}else{
			echo '<script>alert("NIM sudah terdaftar, tidak bisa di daftarkan lagi !");</script>';
			$this->load->view('landingPages');
		}
	}

	public function logout(){
		$this->session->sess_destroy();
		redirect(base_url('welcome'));
	}

	public function hotspot()
	{
		$this->load->view('loginPages/registerHotspot');
	}
}
?>