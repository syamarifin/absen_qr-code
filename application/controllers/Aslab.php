<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Aslab extends CI_Controller{
	function __construct(){
		parent::__construct();		
		$this->load->model('m_aslab');
        $this->model = $this->m_aslab;
        $this->load->helper(array('url','download'));
	}

	public function tampil_aslab()
	{
		if(isset($_POST["employee_id"]))
		{
			$data['hotspot'] = $this->m_aslab->select_data($_POST["employee_id"])->result();
		    foreach($data as $item){
		        echo json_encode($item[0]);
		    }
		}
	}

	public function view_aslabKabid()
	{
		if ($_GET)
		{
			$search="and nama like '%".$_GET['search']."%'";
		}
		else{
			$search='';
		}
		$data['hotspot'] = $this->m_aslab->tampil_dataKabid($search);
		$this->load->view('kabid/v_aslab',$data);
		// $data['hotspot'] = $this->m_absensi->tampil_dataKabid($search);
		// $this->load->view('kabid/v_aslab', $data);
	}

	public function simpan_aslab()
	{
		if ($_GET)
		{
			redirect('aslab/view_aslabKabid?search='.$_GET['search']);
		}
		else{

			if ($_POST['insert']=="Simpan") {
				$NIM 			= $this->input->post('NIM');
				$Nama 			= $this->input->post('Nama');
				$Telp 			= $this->input->post('Telp');
				$Tempat 		= $this->input->post('Tempat');
				$Tanggal 		= $this->input->post('Lahir');
				$JK 			= $this->input->post('jk');
				$Email 			= $this->input->post('email');
				$whereNIM = array(
					'NIM' 	=> $NIM,
					'isActive'   => 'Y'
					);
				$cek = $this->m_aslab->cek_nim("tbaslab",$whereNIM)->num_rows();
				if($cek > 0){
					echo '<script language="javascript">window.alert("NIM '.$NIM.' is already registered!"), window.location.href="../aslab/view_aslabKabid";</script>';
				}
				else{

					$dariDB = $this->m_aslab->cekkodeAslab();
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
				 	
				 	//simpan gambar profile
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

					$data = array(
						'idAslab'   	=> $kodejadi,
						'NIM'    		=> $NIM,
						'Nama'      	=> $Nama,
						'tempatLahir'  	=> $Tempat,
						'tglLahir'      => $Tanggal,
						'jk'    		=> $JK,
						'noTelp'     	=> $Telp,
						'jabatan'    	=> "ASLAB",
						'username'		=> $Email,
						'pass'			=> $NIM,
						'profileImg'	=> $profilImg,
						'QrCode'		=> $image_name,
						'isActive'		=> 'Y'

					);

					$this->load->library('upload', $config);
					if ($this->upload->do_upload('imgProfil')) {
						$this->m_aslab->input_data_aslab($data,'tbaslab');
				       	echo '<script>alert("Aslab baru berhasil ditambahkan !");</script>';
				       	$search='';
						$data['hotspot'] = $this->m_aslab->tampil_dataKabid($search)->result();
						$this->load->view('kabid/v_aslab',$data);
				        return $this->upload->data("file_name");

			        	// $data = array('upload_data' => $this->upload->data());
				    }else{
				    	$this->m_aslab->input_data_aslab($data,'tbaslab');
				       	echo '<script>alert("Aslab baru berhasil ditambahkan !");</script>';
				       	$search='';
						$data['hotspot'] = $this->m_aslab->tampil_dataKabid($search)->result();
						$this->load->view('kabid/v_aslab',$data);
				    }
				}

			}elseif ($_POST['insert']=="Perbarui") {
				$ID 			= $this->input->post('employee_id');
				$NIM 			= $this->input->post('NIM');
				$Nama 			= $this->input->post('Nama');
				$Telp 			= $this->input->post('Telp');
				$Tempat 		= $this->input->post('Tempat');
				$Tanggal 		= $this->input->post('Lahir');
				$JK 			= $this->input->post('jk');
				$Email 			= $this->input->post('email');

				//simpan gambar profile
			 	if ($_FILES["imgProfil"]["name"]=='') {
					// $profilImg  	= "noimage.jpg";

					$data = array(
						'NIM'    		=> $NIM,
						'Nama'      	=> $Nama,
						'tempatLahir'  	=> $Tempat,
						'tglLahir'      => $Tanggal,
						'jk'    		=> $JK,
						'noTelp'     	=> $Telp,
						'username'		=> $Email
					);

					$where = array(
						'idAslab' => $ID
					);

					
				    $this->m_aslab->update_data_aslab($where,$data,'tbaslab');
					echo '<script>alert("Data anggota berhasil diperbarui !");</script>';
				    $search='';
					$data['hotspot'] = $this->m_aslab->tampil_dataKabid($search)->result();
					$this->load->view('kabid/v_aslab',$data);
					
				}else{
					$profilImg  	= $NIM.$_FILES["imgProfil"]["name"];

					$config['upload_path']          = './assets/imgProffile/';
				    $config['allowed_types']        = 'gif|jpg|png';
				    $config['file_name']            = $profilImg;
				    $config['overwrite']			= true;
				    $config['max_size']             = 1024;

					$data = array(
						'NIM'    		=> $NIM,
						'Nama'      	=> $Nama,
						'tempatLahir'  	=> $Tempat,
						'tglLahir'      => $Tanggal,
						'jk'    		=> $JK,
						'noTelp'     	=> $Telp,
						'profileImg'	=> $profilImg
					);
					$where = array(
						'idAslab' => $ID
					);

					$this->load->library('upload', $config);
					if ($this->upload->do_upload('imgProfil')) {
						$this->m_aslab->update_data_aslab($where,$data,'tbaslab');
						echo '<script>alert("Data anggota berhasil diperbarui !");</script>';
				       	$search='';
						$data['hotspot'] = $this->m_aslab->tampil_dataKabid($search)->result();
						$this->load->view('kabid/v_aslab',$data);
				        return $this->upload->data("file_name");

			        	// $data = array('upload_data' => $this->upload->data());
				    }else{
				    	$this->m_aslab->update_data_aslab($where,$data,'tbaslab');
						echo '<script>alert("Data anggota berhasil diperbarui !");</script>';
				       	$search='';
						$data['hotspot'] = $this->m_aslab->tampil_dataKabid($search)->result();
						$this->load->view('kabid/v_aslab',$data);
				    }
				}
			 
				
			}
			else{
				redirect('anggota/view_anggotaKabid');
			}
		}
	}

	public function delete_data_aslabKabid($id){
		$data = array(
			'isActive'   => 'N'
		);
		$where = array(
			'idAslab' => $id
		);
		$this->m_aslab->hapus_data_aslab($where,$data,'tbaslab');
		redirect('aslab/view_aslabKabid');
	}

	public function download_qr_code($qr){				
		force_download('./assets/QR_Code/'.$qr.'.png',NULL);
	}
}
?>