<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Inventaris extends CI_Controller{
	function __construct(){
		parent::__construct();		
		$this->load->model('m_inventaris');
        $this->model = $this->m_inventaris;
        $this->load->helper(array('url','download'));
        $this->load->library('mc_table');
	}

	public function download_qr_code($qr){				
		force_download('./assets/QR_Code/'.$qr.'.png',NULL);
	}

	public function printInventarisRekap(){
		$query = $this->db->query("SELECT * FROM tbinventaris")->result();
		$data['troble'] = $query;
		$this->load->view('pdf/l_Inventaris',$data);
    }

	//KABID
	public function view_inventarisKabid()
	{
		if ($_GET)
		{
			$search="where a.Namabrg like '%".$_GET['search']."%'";
		}
		else{
			$search='';
		}
		$data['hotspot'] = $this->m_inventaris->tampil_data($search);
		$this->load->view('kabid/v_inventaris',$data);
	}
	public function simpan_inventarisKabid()
	{
		if ($_GET)
		{
			redirect('inventaris/view_inventarisKabid?search='.$_GET['search']);
		}
		else{

			if ($_POST['insert']=="Simpan") {
				$Nama 			= $this->input->post('Nama');
				$Lokasi 		= $this->input->post('lokasi');
				$Jumlah 		= $this->input->post('Jumlah');
				$Stok	 		= $this->input->post('Stok');
				$Desc	 		= $this->input->post('Desc');
				
				$dariDB = $this->m_inventaris->cekkodeinventaris();
			    $nourut = substr($dariDB, 3, 4);
			    $nourut = $nourut+1;
			    $kodemax = str_pad($nourut, 4, "0", STR_PAD_LEFT);
        		$kodeBarangSekarang = "BRG".($kodemax);
			 
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
		 
		        $image_name=$kodeBarangSekarang.'.png'; //buat name dari qr code sesuai dengan id barang
		 
		        $params['data'] = $kodeBarangSekarang; //data yang akan di jadikan QR CODE
		        $params['level'] = 'H'; //H=High
		        $params['size'] = 10;
		        $params['savename'] = FCPATH.$config['imagedir'].$image_name; //simpan image QR CODE ke folder assets/images/
		        $this->ciqrcode->generate($params); // fungsi untuk generate QR CODE

				$data = array(
					'idbarang'   	=> $kodeBarangSekarang,
					'Namabrg'      	=> $Nama,
					'Jumlhbrg'     	=> $Jumlah,
					'Stok'		  	=> $Stok,
					'lokasi'	  	=> $Lokasi,
					'Deskripsi'     => $Desc,
					'Qr_Code'    	=> $image_name
				);
				$this->m_inventaris->input_data_inventaris($data,'tbinventaris');
		       	echo '<script>alert("Barang baru berhasil ditambahkan !");</script>';
		       	$search='';
				$data['hotspot'] = $this->m_inventaris->tampil_data($search);
				$this->load->view('kabid/v_inventaris',$data);

			}elseif ($_POST['insert']=="Perbarui") {
				$ID 			= $this->input->post('employee_id');
				$Nama 			= $this->input->post('Nama');
				$Lokasi 		= $this->input->post('lokasi');
				$Jumlah 		= $this->input->post('Jumlah');
				$Stok	 		= $this->input->post('Stok');
				$Desc	 		= $this->input->post('Desc');

				$data = array(
					'Namabrg'      	=> $Nama,
					'Jumlhbrg'     	=> $Jumlah,
					'Stok'		  	=> $Stok,
					'lokasi'	  	=> $Lokasi,
					'Deskripsi'     => $Desc
				);
			 
				$where = array(
					'idbarang' => $ID
				);
			 
				$this->m_inventaris->update_data_inventaris($where,$data,'tbinventaris');
				echo '<script>alert("Data barang berhasil diperbarui !");</script>';
				$search='';
				$data['hotspot'] = $this->m_inventaris->tampil_data($search);
				$this->load->view('kabid/v_inventaris',$data);
			}
			else{
				redirect('inventaris/view_inventarisKabid');
			}
		}
	}
	//KABID END
	//KARYAWAN
	public function view_inventaris()
	{
		if ($_GET)
		{
			$search="where Nama like '%".$_GET['search']."%'";
		}
		else{
			$search='';
		}
		$data['hotspot'] = $this->m_inventaris->tampil_data($search)->result();
		$this->load->view('karyawan/v_inventaris',$data);
	}

	public function tampil_inventaris()
	{
		if(isset($_POST["employee_id"]))
		{
			$data['hotspot'] = $this->m_inventaris->select_data($_POST["employee_id"])->result();
		    foreach($data as $item){
		        echo json_encode($item[0]);
		    }
		}
	}

	public function simpan_inventaris()
	{
		if ($_GET)
		{
			redirect('inventaris/view_inventaris?search='.$_GET['search']);
		}
		else{

			if ($_POST['insert']=="Simpan") {
				$Nama 			= $this->input->post('Nama');
				$Jumlah 		= $this->input->post('Jumlah');
				$Stok	 		= $this->input->post('Stok');
				$Desc	 		= $this->input->post('Desc');
				
				$dariDB = $this->m_inventaris->cekkodeinventaris();
			    $nourut = substr($dariDB, 3, 4);
			    $nourut = $nourut+1;
			    $kodemax = str_pad($nourut, 4, "0", STR_PAD_LEFT);
        		$kodeBarangSekarang = "BRG".($kodemax);
			 
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
		 
		        $image_name=$kodeBarangSekarang.'.png'; //buat name dari qr code sesuai dengan id barang
		 
		        $params['data'] = $kodeBarangSekarang; //data yang akan di jadikan QR CODE
		        $params['level'] = 'H'; //H=High
		        $params['size'] = 10;
		        $params['savename'] = FCPATH.$config['imagedir'].$image_name; //simpan image QR CODE ke folder assets/images/
		        $this->ciqrcode->generate($params); // fungsi untuk generate QR CODE

				$data = array(
					'idbarang'   	=> $kodeBarangSekarang,
					'Namabrg'      	=> $Nama,
					'Jumlhbrg'     	=> $Jumlah,
					'Stok'		  	=> $Stok,
					'Deskripsi'     => $Desc,
					'Qr_Code'    	=> $image_name
				);
				$this->m_inventaris->input_data_inventaris($data,'tbinventaris');
		       	echo '<script>alert("Barang baru berhasil ditambahkan !");</script>';
		       	$search='';
				$data['hotspot'] = $this->m_inventaris->tampil_data($search)->result();
				$this->load->view('karyawan/v_inventaris',$data);

			}elseif ($_POST['insert']=="Perbarui") {
				$ID 			= $this->input->post('employee_id');
				$Nama 			= $this->input->post('Nama');
				$Jumlah 		= $this->input->post('Jumlah');
				$Stok	 		= $this->input->post('Stok');
				$Desc	 		= $this->input->post('Desc');

				$data = array(
					'Namabrg'      	=> $Nama,
					'Jumlhbrg'     	=> $Jumlah,
					'Stok'		  	=> $Stok,
					'Deskripsi'     => $Desc
				);
			 
				$where = array(
					'idbarang' => $ID
				);
			 
				$this->m_inventaris->update_data_inventaris($where,$data,'tbinventaris');
				echo '<script>alert("Data barang berhasil diperbarui !");</script>';
				$search='';
				$data['hotspot'] = $this->m_inventaris->tampil_data($search)->result();
				$this->load->view('karyawan/v_inventaris',$data);
			}
			else{
				redirect('inventaris/view_inventaris');
			}
		}
	}

	public function delete_data_inventaris($id){
		$where = array(
				'idbarang' => $id
			);
		$this->m_inventaris->hapus_data_inventaris($where,'tbinventaris');
		redirect('inventaris/view_inventarisKabid');
	}
	//KARYAWAN END

	//ASLAB
	public function view_inventarisAslab()
	{
		if ($_GET)
		{
			$search="where a.Namabrg like '%".$_GET['search']."%'";
		}
		else{
			$search='';
		}
		$data['hotspot'] = $this->m_inventaris->tampil_data($search);
		$this->load->view('aslab/v_inventaris',$data);
	}

	public function simpan_inventarisAslab()
	{
		if ($_GET)
		{
			redirect('inventaris/view_inventarisAslab?search='.$_GET['search']);
		}
		else{

			if ($_POST['insert']=="Simpan") {
				$Nama 			= $this->input->post('Nama');
				$Jumlah 		= $this->input->post('Jumlah');
				$Stok	 		= $this->input->post('Stok');
				$Desc	 		= $this->input->post('Desc');
				
				$dariDB = $this->m_inventaris->cekkodeinventaris();
			    $nourut = substr($dariDB, 3, 4);
			    $nourut = $nourut+1;
			    $kodemax = str_pad($nourut, 4, "0", STR_PAD_LEFT);
        		$kodeBarangSekarang = "BRG".($kodemax);
			 
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
		 
		        $image_name=$kodeBarangSekarang.'.png'; //buat name dari qr code sesuai dengan id barang
		 
		        $params['data'] = $kodeBarangSekarang; //data yang akan di jadikan QR CODE
		        $params['level'] = 'H'; //H=High
		        $params['size'] = 10;
		        $params['savename'] = FCPATH.$config['imagedir'].$image_name; //simpan image QR CODE ke folder assets/images/
		        $this->ciqrcode->generate($params); // fungsi untuk generate QR CODE

				$data = array(
					'idbarang'   	=> $kodeBarangSekarang,
					'Namabrg'      	=> $Nama,
					'Jumlhbrg'     	=> $Jumlah,
					'Stok'		  	=> $Stok,
					'Deskripsi'     => $Desc,
					'Qr_Code'    	=> $image_name
				);
				$this->m_inventaris->input_data_inventaris($data,'tbinventaris');
		       	echo '<script>alert("Barang baru berhasil ditambahkan !");</script>';
		       	$search='';
				$data['hotspot'] = $this->m_inventaris->tampil_data($search);
				$this->load->view('aslab/v_inventaris',$data);

			}elseif ($_POST['insert']=="Perbarui") {
				$ID 			= $this->input->post('employee_id');
				$Nama 			= $this->input->post('Nama');
				$Jumlah 		= $this->input->post('Jumlah');
				$Stok	 		= $this->input->post('Stok');
				$Desc	 		= $this->input->post('Desc');

				$data = array(
					'Namabrg'      	=> $Nama,
					'Jumlhbrg'     	=> $Jumlah,
					'Stok'		  	=> $Stok,
					'Deskripsi'     => $Desc
				);
			 
				$where = array(
					'idbarang' => $ID
				);
			 
				$this->m_inventaris->update_data_inventaris($where,$data,'tbinventaris');
				echo '<script>alert("Data barang berhasil diperbarui !");</script>';
				$search='';
				$data['hotspot'] = $this->m_inventaris->tampil_data($search);
				$this->load->view('aslab/v_inventaris',$data);
			}
			else{
				redirect('inventaris/view_inventarisAslab');
			}
		}
	}

	public function delete_data_inventarisAslab($id){
		$where = array(
				'idbarang' => $id
			);
		$this->m_inventaris->hapus_data_inventaris($where,'tbinventaris');
		redirect('inventaris/view_inventarisAslab');
	}
	//ASLAB END
}
?>