<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Anggota extends CI_Controller{
	function __construct(){
		parent::__construct();		
		$this->load->model('m_anggota');
        $this->model = $this->m_anggota;
	}

	public function tampil_anggota()
	{
		if(isset($_POST["employee_id"]))
		{
			$data['hotspot'] = $this->m_anggota->select_data($_POST["employee_id"])->result();
		    foreach($data as $item){
		        echo json_encode($item[0]);
		    }
		}
	}

	//KABID

	public function view_anggotaKabid()
	{
		if ($_GET)
		{
			$search=" Nama like '%".$_GET['search']."%'";
		}
		else{
			$search='';
		}
		$data['hotspot'] = $this->m_anggota->tampil_data($search)->result();
		$this->load->view('kabid/v_anggota',$data);
	}

	public function simpan_anggotaKabid()
	{
		if ($_GET)
		{
			redirect('anggota/view_anggotaKabid?search='.$_GET['search']);
		}
		else{

			if ($_POST['insert']=="Simpan") {
				$NIM 			= $this->input->post('NIM');
				$Nama 			= $this->input->post('Nama');
				$Semester 		= $this->input->post('Semester');
				$Tempat 		= $this->input->post('Tempat');
				$Tanggal 		= $this->input->post('Lahir');
				$JK 			= $this->input->post('jk');
				$Alamat 		= $this->input->post('Alamat');
				
				$dariDB = $this->m_anggota->cekkodeTroble();
			    $kodeAnggota = $dariDB + 1;
			 
				$data = array(
					'IdDaftar_a'   	=> $kodeAnggota,
					'NIM'    		=> $NIM,
					'Nama'      	=> $Nama,
					'Semester'     	=> $Semester,
					'tmptlahir'  	=> $Tempat,
					'tgllahir'      => $Tanggal,
					'jk'    		=> $JK,
					'Alamat'    	=> $Alamat
				);
				$this->m_anggota->input_data_anggota($data,'tbanggota');
		       	echo '<script>alert("Anggota baru berhasil ditambahkan !");</script>';
		       	$search='';
				$data['hotspot'] = $this->m_anggota->tampil_data($search)->result();
				$this->load->view('kabid/v_anggota',$data);

			}elseif ($_POST['insert']=="Perbarui") {
				$ID 			= $this->input->post('employee_id');
				$NIM 			= $this->input->post('NIM');
				$Nama 			= $this->input->post('Nama');
				$Semester 		= $this->input->post('Semester');
				$Tempat 		= $this->input->post('Tempat');
				$Tanggal 		= $this->input->post('Lahir');
				$JK 			= $this->input->post('jk');
				$Alamat 		= $this->input->post('Alamat');

				$data = array(
					'NIM'    		=> $NIM,
					'Nama'      	=> $Nama,
					'Semester'     	=> $Semester,
					'tmptlahir'  	=> $Tempat,
					'tgllahir'      => $Tanggal,
					'jk'    		=> $JK,
					'Alamat'    	=> $Alamat
				);
			 
				$where = array(
					'IdDaftar_a' => $ID
				);
			 
				$this->m_anggota->update_data_anggota($where,$data,'tbanggota');
				echo '<script>alert("Data anggota berhasil diperbarui !");</script>';
				$search='';
				$data['hotspot'] = $this->m_anggota->tampil_data($search)->result();
				$this->load->view('kabid/v_anggota',$data);
			}
			else{
				redirect('anggota/view_anggotaKabid');
			}
		}
	}

	public function delete_data_anggotaKabid($id){
		$where = array(
				'IdDaftar_a' => $id
			);
		$this->m_anggota->hapus_data_anggota($where,'tbanggota');
		redirect('anggota/view_anggotaKabid');
	}

	public function jadikanAslabKabid($id){
		$dariDB = $this->m_anggota->cekkodeAslab();
        // contoh IK0004, angka 3 adalah awal pengambilan angka, dan 4 jumlah angka yang diambil
        $nourut = substr($dariDB, 2, 4);
        $kodeAslabSekarang = $nourut + 1;
        $kodemax = str_pad($kodeAslabSekarang, 4, "0", STR_PAD_LEFT); // angka 4 menunjukkan jumlah digit angka 0
		$kodejadi = "IK".$kodemax;    // hasilnya ODJ-9921-0001 dst.

		$this->load->library('ciqrcode'); //pemanggilan library QR CODE
 
		$config['cacheable']    = true; //boolean, the default is true
		$config['cachedir']     = './assets/'; //string, the default is application/cache/
		$config['errorlog']     = './assets/'; //string, the default is application/logs/
		$config['imagedir']     = './assets/QR_Code/'; //direktori penyimpanan qr code
		$config['quality']      = true; //boolean, the default is true
		$config['size']         = '1024'; //interger, the default is 1024
		$config['black']        = array(224,255,255); // array, default is array(255,255,255)
		$config['white']        = array(70,130,180); // array, default is array(0,0,0)
		$this->ciqrcode->initialize($config);
		 
		$image_name=$kodejadi.'.png'; //buat name dari qr code sesuai dengan id barang
		 
		$params['data'] = $kodejadi; //data yang akan di jadikan QR CODE
		$params['level'] = 'H'; //H=High
		$params['size'] = 10;
		$params['savename'] = FCPATH.$config['imagedir'].$image_name; //simpan image QR CODE ke folder assets/images/
		$this->ciqrcode->generate($params); // fungsi untuk generate QR CODE

		$this->m_anggota->input_aslab($id,$kodejadi,$image_name);
		redirect('aslab/view_aslabKabid');
	}

	//KABID END
	//KARYAWAN
	public function view_anggota()
	{
		if ($_GET)
		{
			$search="and Nama like '%".$_GET['search']."%'";
		}
		else{
			$search='';
		}
		$data['hotspot'] = $this->m_anggota->tampil_data($search)->result();
		$this->load->view('karyawan/v_anggota',$data);
	}

	public function simpan_anggota()
	{
		if ($_GET)
		{
			redirect('anggota/view_anggota?search='.$_GET['search']);
		}
		else{

			if ($_POST['insert']=="Simpan") {
				$NIM 			= $this->input->post('NIM');
				$Nama 			= $this->input->post('Nama');
				$Semester 		= $this->input->post('Semester');
				$Tempat 		= $this->input->post('Tempat');
				$Tanggal 		= $this->input->post('Lahir');
				$JK 			= $this->input->post('jk');
				$Email 			= $this->input->post('email');
				$Alamat 		= $this->input->post('Alamat');
				if ($_FILES["imgProfil"]["name"]=='') {
					$profilImg  	= "noimage.jpg";
				}else{
					$profilImg  	= $NIM.$_FILES["imgProfil"]["name"];
				}

				$config['upload_path']          = './assets/imgProffile/';
			    $config['allowed_types']        = 'gif|jpg|png';
			    $config['file_name']            = $profilImg;
			    $config['overwrite']			= true;
			    $config['max_size']             = 1024;
				
				$dariDB = $this->m_anggota->cekkodeTroble();
			    $kodeAnggota = $dariDB + 1;
			 
				$data = array(
					'IdDaftar_a'   	=> $kodeAnggota,
					'NIM'    		=> $NIM,
					'Nama'      	=> $Nama,
					'Semester'     	=> $Semester,
					'tmptlahir'  	=> $Tempat,
					'tgllahir'      => $Tanggal,
					'jk'    		=> $JK,
					'Alamat'    	=> $Alamat,
					'email'    		=> $Email,
					'img' 			=> $profilImg
				);
				$this->load->library('upload', $config);
				if ($this->upload->do_upload('imgProfil')) {
					$this->m_anggota->input_data_anggota($data,'tbanggota');
			       	echo '<script>alert("Anggota baru berhasil ditambahkan !");</script>';
			       	$search='';
					$data['hotspot'] = $this->m_anggota->tampil_data($search)->result();
					$this->load->view('karyawan/v_anggota',$data);
			        return $this->upload->data("file_name");

		        	// $data = array('upload_data' => $this->upload->data());
			    }else{
			    	$this->m_anggota->input_data_anggota($data,'tbanggota');
			       	echo '<script>alert("Anggota baru berhasil ditambahkan !");</script>';
			       	$search='';
					$data['hotspot'] = $this->m_anggota->tampil_data($search)->result();
					$this->load->view('karyawan/v_anggota',$data);
			    }

			}elseif ($_POST['insert']=="Perbarui") {
				$ID 			= $this->input->post('employee_id');
				$NIM 			= $this->input->post('NIM');
				$Nama 			= $this->input->post('Nama');
				$Semester 		= $this->input->post('Semester');
				$Tempat 		= $this->input->post('Tempat');
				$Tanggal 		= $this->input->post('Lahir');
				$JK 			= $this->input->post('jk');
				$Email 			= $this->input->post('email');
				$Alamat 		= $this->input->post('Alamat');
				if ($_FILES["imgProfil"]["name"]=='') {
					$profilImg  	= "noimage.jpg";

					$data = array(
						'NIM'    		=> $NIM,
						'Nama'      	=> $Nama,
						'Semester'     	=> $Semester,
						'tmptlahir'  	=> $Tempat,
						'tgllahir'      => $Tanggal,
						'jk'    		=> $JK,
						'Alamat'    	=> $Alamat,
						'email'    		=> $Email
					);
				 
					$where = array(
						'IdDaftar_a' => $ID
					);
				}else{
					$profilImg  	= $NIM.$_FILES["imgProfil"]["name"];

					$data = array(
						'NIM'    		=> $NIM,
						'Nama'      	=> $Nama,
						'Semester'     	=> $Semester,
						'tmptlahir'  	=> $Tempat,
						'tgllahir'      => $Tanggal,
						'jk'    		=> $JK,
						'Alamat'    	=> $Alamat,
						'email'    		=> $Email,
						'img' 			=> $profilImg
					);
				 
					$where = array(
						'IdDaftar_a' => $ID
					);
				 	$this->_deleteImage($ID);
				}

				$config['upload_path']          = './assets/imgProffile/';
			    $config['allowed_types']        = 'gif|jpg|png';
			    $config['file_name']            = $profilImg;
			    $config['overwrite']			= true;
			    $config['max_size']             = 1024;

				
			 	$this->load->library('upload', $config);
			 	if ($this->upload->do_upload('imgProfil')) {
					$this->m_anggota->update_data_anggota($where,$data,'tbanggota');
					echo '<script>alert("Data anggota berhasil diperbarui !");</script>';
					$search='';
					$data['hotspot'] = $this->m_anggota->tampil_data($search)->result();
					$this->load->view('karyawan/v_anggota',$data);
			        return $this->upload->data("file_name");
			    }
			    else{
			    	$this->m_anggota->update_data_anggota($where,$data,'tbanggota');
					echo '<script>alert("Data anggota berhasil diperbarui !");</script>';
					$search='';
					$data['hotspot'] = $this->m_anggota->tampil_data($search)->result();
					$this->load->view('karyawan/v_anggota',$data);
			    }
					
			}
			else{
				redirect('anggota/view_anggota');
			}
		}
	}

	private function _deleteImage($id)
	{
	    $product = $this->m_anggota->getById($id,'tbanggota');
	    // echo $product->img;
	    if ($product->img != "noimage.jpg") {
		    $filename = explode(".", $product->img)[0];
			return array_map('unlink', glob(FCPATH."assets/imgProffile/$filename.*"));
	    }
	}

	public function delete_data_anggota($id){
		$where = array(
				'IdDaftar_a' => $id
			);
		$this->m_anggota->hapus_data_anggota($where,'tbanggota');
		redirect('anggota/view_anggota');
	}
	//KARYAWAN END
	//ASLAB
	public function view_anggotaAslab()
	{
		if ($_GET)
		{
			$search="and Nama like '%".$_GET['search']."%'";
		}
		else{
			$search='';
		}
		$data['hotspot'] = $this->m_anggota->tampil_data($search)->result();
		$this->load->view('aslab/v_anggota',$data);
	}

	public function simpan_anggotaAslab()
	{
		if ($_GET)
		{
			redirect('anggota/view_anggotaAslab?search='.$_GET['search']);
		}
		else{

			if ($_POST['insert']=="Simpan") {
				$NIM 			= $this->input->post('NIM');
				$Nama 			= $this->input->post('Nama');
				$Semester 		= $this->input->post('Semester');
				$Tempat 		= $this->input->post('Tempat');
				$Tanggal 		= $this->input->post('Lahir');
				$JK 			= $this->input->post('jk');
				$Email 			= $this->input->post('email');
				$Alamat 		= $this->input->post('Alamat');
				//cek input file ada yang di upload atau tidak
				if ($_FILES["imgProfil"]["name"]=='') {
					//jika tidak ada profil image akan di isi denga file niimage.jpg
					$profilImg  	= "noimage.jpg";
				}else{
					//jika ada file akan di isi dengan perpaduan NIM & namafile 
					$profilImg  	= $NIM.$_FILES["imgProfil"]["name"];
				}

				$config['upload_path']          = './assets/imgProffile/';
			    $config['allowed_types']        = 'gif|jpg|png';
			    $config['file_name']            = $profilImg;
			    $config['overwrite']			= true;
			    $config['max_size']             = 1024;
				
				$dariDB = $this->m_anggota->cekkodeTroble();
			    $kodeAnggota = $dariDB + 1;
			 
				$data = array(
					'IdDaftar_a'   	=> $kodeAnggota,
					'NIM'    		=> $NIM,
					'Nama'      	=> $Nama,
					'Semester'     	=> $Semester,
					'tmptlahir'  	=> $Tempat,
					'tgllahir'      => $Tanggal,
					'jk'    		=> $JK,
					'Alamat'    	=> $Alamat,
					'email'    		=> $Email,
					'img' 			=> $profilImg
				);
				$this->load->library('upload', $config);
				//proses upload file
				if ($this->upload->do_upload('imgProfil')) {
					$this->m_anggota->input_data_anggota($data,'tbanggota');
			       	echo '<script>alert("Anggota baru berhasil ditambahkan !");</script>';
			       	$search='';
					$data['hotspot'] = $this->m_anggota->tampil_data($search)->result();
					$this->load->view('aslab/v_anggota',$data);
			        return $this->upload->data("file_name");

		        	// $data = array('upload_data' => $this->upload->data());
			    }else{
			    	$this->m_anggota->input_data_anggota($data,'tbanggota');
			       	echo '<script>alert("Anggota baru berhasil ditambahkan !");</script>';
			       	$search='';
					$data['hotspot'] = $this->m_anggota->tampil_data($search)->result();
					$this->load->view('aslab/v_anggota',$data);
			    }

			}elseif ($_POST['insert']=="Perbarui") {
				$ID 			= $this->input->post('employee_id');
				$NIM 			= $this->input->post('NIM');
				$Nama 			= $this->input->post('Nama');
				$Semester 		= $this->input->post('Semester');
				$Tempat 		= $this->input->post('Tempat');
				$Tanggal 		= $this->input->post('Lahir');
				$JK 			= $this->input->post('jk');
				$Email 			= $this->input->post('email');
				$Alamat 		= $this->input->post('Alamat');
				if ($_FILES["imgProfil"]["name"]=='') {
					//jika tidak ada file yang di upload saat proses edit maka gambar tidak di update
					$profilImg  	= "noimage.jpg";

					$data = array(
						'NIM'    		=> $NIM,
						'Nama'      	=> $Nama,
						'Semester'     	=> $Semester,
						'tmptlahir'  	=> $Tempat,
						'tgllahir'      => $Tanggal,
						'jk'    		=> $JK,
						'Alamat'    	=> $Alamat,
						'email'    		=> $Email
					);
				 
					$where = array(
						'IdDaftar_a' => $ID
					);
				}else{
					//jika ada file yang d upload maka file yang baru akan d upload mengganti file yang lama
					$profilImg  	= $NIM.$_FILES["imgProfil"]["name"];

					$data = array(
						'NIM'    		=> $NIM,
						'Nama'      	=> $Nama,
						'Semester'     	=> $Semester,
						'tmptlahir'  	=> $Tempat,
						'tgllahir'      => $Tanggal,
						'jk'    		=> $JK,
						'Alamat'    	=> $Alamat,
						'email'    		=> $Email,
						'img' 			=> $profilImg
					);
				 
					$where = array(
						'IdDaftar_a' => $ID
					);
				 	$this->_deleteImage($ID);
				}

				$config['upload_path']          = './assets/imgProffile/';
			    $config['allowed_types']        = 'gif|jpg|png';
			    $config['file_name']            = $profilImg;
			    $config['overwrite']			= true;
			    $config['max_size']             = 1024;

				
			 	$this->load->library('upload', $config);
			 	if ($this->upload->do_upload('imgProfil')) {
					$this->m_anggota->update_data_anggota($where,$data,'tbanggota');
					echo '<script>alert("Data anggota berhasil diperbarui !");</script>';
					$search='';
					$data['hotspot'] = $this->m_anggota->tampil_data($search)->result();
					$this->load->view('aslab/v_anggota',$data);
			        return $this->upload->data("file_name");
			    }
			    else{
			    	$this->m_anggota->update_data_anggota($where,$data,'tbanggota');
					echo '<script>alert("Data anggota berhasil diperbarui !");</script>';
					$search='';
					$data['hotspot'] = $this->m_anggota->tampil_data($search)->result();
					$this->load->view('aslab/v_anggota',$data);
			    }
					
			}
			else{
				redirect('anggota/view_anggotaAslab');
			}
		}
	}

	public function delete_data_anggotaAslab($id){
		$where = array(
				'IdDaftar_a' => $id
			);
		$this->m_anggota->hapus_data_anggota($where,'tbanggota');
		redirect('anggota/view_anggotaAslab');
	}
	//ASLAB END
}
?>