<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Peminjaman extends CI_Controller{
	function __construct(){
		parent::__construct();		
		$this->load->model('m_peminjaman');
        $this->model = $this->m_peminjaman;
        $this->load->library('mc_table');
	}

	public function printPinjamRekap(){
		$From 		= $this->input->post('FromDone');
		$Until 		= $this->input->post('UntilDone');
		if ($from=="" or $Until=="") {
			$query = $this->db->query("SELECT a.idPinjam, a.NIM, a.Nama_peminjam, a.tglPinjam, c.Namabrg, d.tglKembali, d.penerima, (SELECT SUM(JumlhBrg) FROM tbpeminjamandtl as b WHERE b.idPinjam=a.idPinjam) as totItem FROM tbpeminjaman as a INNER JOIN tbpengembalian AS d ON d.idPinjam=a.idPinjam INNER JOIN tbinventaris as c ON c.idbarang=d.idbarang where d.tglKembali<>''")->result();
		}else{
			$query = $this->db->query("SELECT a.idPinjam, a.NIM, a.Nama_peminjam, a.tglPinjam, c.Namabrg, d.tglKembali, d.penerima, (SELECT SUM(JumlhBrg) FROM tbpeminjamandtl as b WHERE b.idPinjam=a.idPinjam) as totItem FROM tbpeminjaman as a INNER JOIN tbpengembalian AS d ON d.idPinjam=a.idPinjam INNER JOIN tbinventaris as c ON c.idbarang=d.idbarang where (d.tglKembali >='$From' AND d.tglKembali<='$Until')")->result();
		}
		$data['troble'] = $query;
		$this->load->view('pdf/l_Peminjaman',$data);
    }

	public function addPinjam()
	{
		if ($this->session->userdata('jabatan')=="KABID") {
			$data['hotspot'] = $this->m_absensi->tampil_pinjamDtlKabid()->result();
			$this->load->view('kabid/v_peminjamanAdd',$data);
		}else if ($this->session->userdata('jabatan')=="ASLAB") {
			// $data['hotspot'] = $this->m_absensi->tampil_dataKabid($search)->result();
			$this->load->view('aslab/v_dashboard',$data);
		}
	}

	public function tampil_inventaris()
	{
		if(isset($_POST['send'])){

		$arr= array();
			if(isset($_POST["credential"]))
			{
				$where = $_POST["credential"];
				$idInventaris="";
				$data['DoneAslabData'] = $this->m_peminjaman->cek_Inventaris($where)->result();
				// echo $data['loginData'];
				foreach ($data['DoneAslabData'] as $data1) {
			 		# code...
			 		$idInventaris=$data1->idbarang;
			 		$namaInventaris=$data1->Namabrg;

			 		$stok=$data1->Stok;
			 		$diPinjam=$data1->diPinjam - $data1->diKembalikan;
			 		$dikembalikan=$data1->diKembalikan;
			 	}
				// $arr['absen'] = $this->session->userdata('idTrouble');
				if ($idInventaris=="") {
					$arr['status']=false;
				}else{
					$arr['status']=true;
					$arr['id']=$idInventaris;
					$arr['nama']=$namaInventaris;
					$arr['stok']=$stok;
					$arr['dipinjam']=$diPinjam;

				}
				echo json_encode($arr);
			}
		}
	}

	public function tampil_peminjam()
	{
		if(isset($_POST["employee_id"]))
		{
			$data['hotspot'] = $this->m_peminjaman->select_data($_POST["employee_id"])->result();
		    foreach($data as $item){
		        echo json_encode($item[0]);
		    }
		}
	}

	public function tampil_peminjamDtl()
	{
		if(isset($_POST["employee_id"]))
		{
			$data['hotspot'] = $this->m_peminjaman->select_dataDtl($_POST["employee_id"])->result();
		    foreach($data as $item){
		        echo json_encode($item[0]);
		    }
		}
	}

	public function delete_pinjam($id){
		$where = array(
				'idPinjam' => $id
			);
		//Hapus data peminjaman header
		$this->m_peminjaman->hapus_data_peminjaman($where,'tbpeminjaman');
		// Hapus data peminjaman detail items
		$this->m_peminjaman->hapus_data_peminjaman($where,'tbpeminjamandtl');

		if ($this->session->userdata('jabatan')=="KABID") {
			redirect('peminjaman/view_peminjamanKabid');
		}else if ($this->session->userdata('jabatan')=="ASLAB") {
			redirect('peminjaman/view_peminjamanAslab');
		}
	}

	public function delete_pinjam_dtl($id){
		$where = array(
				'idDtl' => $id
			);
		// Hapus data peminjaman detail items
		$this->m_peminjaman->hapus_data_peminjaman($where,'tbpeminjamandtl');
		
		if ($this->session->userdata('jabatan')=="KABID") {
			$kodePinjamSekarang = $this->session->userdata('idPinjam');
			redirect(base_url('peminjaman/add_peminjamanKabid/').$kodePinjamSekarang);
		}else if ($this->session->userdata('jabatan')=="ASLAB") {
			$kodePinjamSekarang = $this->session->userdata('idPinjam');
			redirect(base_url('peminjaman/add_peminjamanAslab/').$kodePinjamSekarang);
		}
	}
	// KABID
	public function view_peminjamanKabid()
	{
		if ($_GET)
		{
			$search="AND a.Nama_peminjam like '%".$_GET['search']."%'";
		}
		else{
			$search='';
		}
		$data['hotspot'] = $this->m_peminjaman->tampil_data($search)->result();
		$data['hotspotDone'] = $this->m_peminjaman->tampil_data_done($search)->result();
		$this->load->view('kabid/v_peminjaman',$data);
	}

	public function simpan_peminjamanKabid()
	{
		if ($_POST['insert']=="Add Barang") {
			$NIM 			= $this->input->post('NIM');
			$Nama 			= $this->input->post('Nama');
			$Keperluan		= $this->input->post('Keperluan');
				
			$dariDB = $this->m_peminjaman->cekkodePinjam();
			$nourut = substr($dariDB, 3, 4);
			$nourut = $nourut+1;
			$kodemax = str_pad($nourut, 4, "0", STR_PAD_LEFT);
        	$kodePinjamSekarang = "PIB".($kodemax);

			date_default_timezone_set('Asia/Jakarta');
    		$tgl 		= date('Y-m-d');
			    
			$data = array(
				'idPinjam'   	=> $kodePinjamSekarang,
				'Nama_peminjam' => $Nama,
				'NIM'     		=> $NIM,
				'tglPinjam'		=> $tgl,
				'keperluan'		=> $Keperluan
			);
			$this->m_peminjaman->input_data_peminjaman($data,'tbpeminjaman');
			
			redirect(base_url('peminjaman/add_peminjamanKabid/').$kodePinjamSekarang);
		}
		elseif ($_POST['insert']=="Perbarui") {
			$ID 			= $this->input->post('employee_id');
			$NIM 			= $this->input->post('NIM');
			$Nama 			= $this->input->post('Nama');
			$Keperluan		= $this->input->post('Keperluan');

			$data = array(
				'Nama_peminjam' => $Nama,
				'NIM'     		=> $NIM,
				'keperluan'		=> $Keperluan
			);

			$where = array(
				'idPinjam'   	=> $ID
			);

			$this->m_peminjaman->update_data_peminjaman($where,$data,'tbpeminjaman');
			echo '<script language="javascript">window.alert("Data peminjam berhasil diperbarui !");
    		window.location.href="../peminjaman/view_peminjamanKabid";</script>';
		}
	}

	public function add_peminjamanKabid($id)
	{
		$kodePinjamSekarang = $id;
		$data_session = array(
			'idPinjam' => $kodePinjamSekarang,
		);
		$this->session->set_userdata($data_session);
		$data['hotspot'] = $this->m_peminjaman->tampil_data_detail($kodePinjamSekarang)->result();
		$this->load->view('kabid/v_peminjamanDtl',$data);
	}

	public function pengembalianKabid($id)
	{
		$kodePinjamSekarang = $id;
		$data_session = array(
			'idPinjam' => $kodePinjamSekarang,
		);
 
		$this->session->set_userdata($data_session);
		$data['hotspotHdr'] = $this->m_peminjaman->tampil_data_header($kodePinjamSekarang)->result();
		$data['hotspot'] = $this->m_peminjaman->tampil_data_detail($kodePinjamSekarang)->result();
		$this->load->view('kabid/v_pengembalian',$data);
	}

	public function proses_pengembalian()
	{
		if(isset($_POST['send'])){

		$arr= array();
			if(isset($_POST["credential"]))
			{
				date_default_timezone_set('Asia/Jakarta');
    			$tgl 		= date('Y-m-d');
				$idbarang = $_POST["credential"];

				$data['AslabData'] = $this->m_peminjaman->cek_pinjam_dtl($idbarang)->result();
				// echo $data['loginData'];
				foreach ($data['AslabData'] as $data1) {
			 		# code...
			 		$JumlhBrg=$data1->totItem;
			 	}
				// $arr['absen'] = $this->session->userdata('idTrouble');
				if ($JumlhBrg=="") {
					$arr['status']=false;
				}else{
					// $whereKembali = array(
					// 	'idPinjam' 	=> $this->session->userdata('idPinjam')
					// );
					// $data = array(
					// 	'tglKembali'  	=> $tgl,
					// 	'penerima'		=> $_POST["credential"]
					// );
					// $this->m_peminjaman->update_data_peminjaman($whereKembali,$data,'tbpeminjaman');

					$arr['status']=true;
					$arr['userLogin']=$this->session->userdata('jabatan');
					$arr['idBarang']=$idbarang;
					$arr['jumItems']=$JumlhBrg;

				}
				echo json_encode($arr);
			}
		}
	}

	public function terima_pengembalian()
	{
		if ($_POST['insert']=="Terima") {
			$Id 			= $this->session->userdata('idPinjam');
			$id_barang 		= $this->input->post('id_barang');
			$jml 			= $this->input->post('jml');
			$penerima		= $this->input->post('Penerima');

			date_default_timezone_set('Asia/Jakarta');
    		$tgl 		= date('Y-m-d');
    		$where = array(
				'idPinjam'   	=> $Id,
				'idbarang' 		=> $id_barang,
			);
			$cek = $this->m_peminjaman->cek_pengembalian("tbpengembalian",$where)->num_rows();
			if($cek > 0)
			{
				// echo '<script language="javascript">window.alert("Items sudah di kembalikan !");
	   //  		window.location.href="../peminjaman/pengembalianKabid/'.$this->session->userdata('idPinjam').'";</script>';
	    		if ($this->session->userdata('jabatan')=="KABID") {
					echo '<script language="javascript">window.alert("Items sudah di kembalikan !");
		    		window.location.href="../peminjaman/pengembalianKabid/'.$this->session->userdata('idPinjam').'";</script>';	
				}else if ($this->session->userdata('jabatan')=="ASLAB") {
					echo '<script language="javascript">window.alert("Items sudah di kembalikan !");
		    		window.location.href="../peminjaman/pengembalianAslab/'.$this->session->userdata('idPinjam').'";</script>';	
				}
			}
			else
			{
	    		$data = array(
					'idPinjam'   	=> $Id,
					'idbarang' 		=> $id_barang,
					'JumlhBrg'     	=> $jml,
					'tglKembali'	=> $tgl,
					'penerima'     	=> $penerima
				);
				$this->m_peminjaman->input_data_peminjaman($data,'tbpengembalian');
				if ($this->session->userdata('jabatan')=="KABID") {
					echo '<script language="javascript">window.alert("Items berhasil di kembalikan !");
		    		window.location.href="../peminjaman/pengembalianKabid/'.$this->session->userdata('idPinjam').'";</script>';	
				}else if ($this->session->userdata('jabatan')=="ASLAB") {
					echo '<script language="javascript">window.alert("Items berhasil di kembalikan !");
		    		window.location.href="../peminjaman/pengembalianAslab/'.$this->session->userdata('idPinjam').'";</script>';	
				}
			}
		}
	}

	public function add_peminjamanDtlKabid()
	{
		if ($_POST['insert']=="Add Barang") {
			$Id 			= $this->input->post('Id');
			$quantity 		= $this->input->post('quantity');
			$stok 			= $this->input->post('Stokbrg');
			
			$kodePinjamSekarang = $this->session->userdata('idPinjam');

			date_default_timezone_set('Asia/Jakarta');
    		$tgl 		= date('Y-m-d');
			
    		// if ($stok=="" or $stok==null or $stok=="0") {
    		// 	echo '<script language="javascript">window.alert("Stok Items kosong !");
    		// 	window.location.href="../peminjaman/add_peminjamanKabid/'.$kodePinjamSekarang.'";</script>';
    		// }else{

				$data = array(
					'idPinjam'   	=> $kodePinjamSekarang,
					'idbarang' 		=> $Id,
					'JumlhBrg'     	=> $quantity
				);
				$this->m_peminjaman->input_data_peminjaman($data,'tbpeminjamandtl');

	    		if ($this->session->userdata('jabatan')=="KABID") {
					echo '<script language="javascript">window.alert("Items berhasil di tambahkan !");
	    		window.location.href="../peminjaman/add_peminjamanKabid/'.$kodePinjamSekarang.'";</script>';
				}else if ($this->session->userdata('jabatan')=="ASLAB") {
					echo '<script language="javascript">window.alert("Items berhasil di tambahkan !");
	    		window.location.href="../peminjaman/add_peminjamanAslab/'.$kodePinjamSekarang.'";</script>';
				}
	    	// }
			// $data['hotspot'] = $this->m_peminjaman->tampil_data_detail($kodePinjamSekarang)->result();

			// $this->load->view('kabid/v_peminjamanDtl',$data);
		}
	}

	// KABID END
	// ASLAB
	public function view_peminjamanAslab()
	{
		if ($_GET)
		{
			$search="AND a.Nama_peminjam like '%".$_GET['search']."%'";
		}
		else{
			$search='';
		}
		$data['hotspot'] = $this->m_peminjaman->tampil_data($search)->result();
		$data['hotspotDone'] = $this->m_peminjaman->tampil_data_done($search)->result();
		$this->load->view('aslab/v_peminjaman',$data);
	}

	public function simpan_peminjamanAslab()
	{
		if ($_POST['insert']=="Add Barang") {
			$NIM 			= $this->input->post('NIM');
			$Nama 			= $this->input->post('Nama');
			$Keperluan		= $this->input->post('Keperluan');
				
			$dariDB = $this->m_peminjaman->cekkodePinjam();
			$nourut = substr($dariDB, 3, 4);
			$nourut = $nourut+1;
			$kodemax = str_pad($nourut, 4, "0", STR_PAD_LEFT);
        	$kodePinjamSekarang = "PIB".($kodemax);

			date_default_timezone_set('Asia/Jakarta');
    		$tgl 		= date('Y-m-d');
			    
			$data = array(
				'idPinjam'   	=> $kodePinjamSekarang,
				'Nama_peminjam' => $Nama,
				'NIM'     		=> $NIM,
				'tglPinjam'		=> $tgl,
				'keperluan'		=> $Keperluan
			);
			$this->m_peminjaman->input_data_peminjaman($data,'tbpeminjaman');
			
			redirect(base_url('peminjaman/add_peminjamanAslab/').$kodePinjamSekarang);
		}
		elseif ($_POST['insert']=="Perbarui") {
			$ID 			= $this->input->post('employee_id');
			$NIM 			= $this->input->post('NIM');
			$Nama 			= $this->input->post('Nama');
			$Keperluan		= $this->input->post('Keperluan');

			$data = array(
				'Nama_peminjam' => $Nama,
				'NIM'     		=> $NIM,
				'keperluan'		=> $Keperluan
			);

			$where = array(
				'idPinjam'   	=> $ID
			);

			$this->m_peminjaman->update_data_peminjaman($where,$data,'tbpeminjaman');
			echo '<script language="javascript">window.alert("Data peminjam berhasil diperbarui !");
    		window.location.href="../peminjaman/view_peminjamanAslab";</script>';
		}
	}

	public function add_peminjamanAslab($id)
	{
		$kodePinjamSekarang = $id;
		$data_session = array(
			'idPinjam' => $kodePinjamSekarang,
		);
 
		$this->session->set_userdata($data_session);
		$data['hotspot'] = $this->m_peminjaman->tampil_data_detail($kodePinjamSekarang)->result();
		$this->load->view('aslab/v_peminjamanDtl',$data);
	}

	public function pengembalianAslab($id)
	{
		$kodePinjamSekarang = $id;
		$data_session = array(
			'idPinjam' => $kodePinjamSekarang,
		);
 
		$this->session->set_userdata($data_session);
		$data['hotspotHdr'] = $this->m_peminjaman->tampil_data_header($kodePinjamSekarang)->result();
		$data['hotspot'] = $this->m_peminjaman->tampil_data_detail($kodePinjamSekarang)->result();
		$this->load->view('aslab/v_pengembalian',$data);
	}
	// ASLAB END
}
?>