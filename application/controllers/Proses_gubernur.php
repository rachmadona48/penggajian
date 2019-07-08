<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Proses_gubernur extends CI_Controller {

	public function __construct()
  	{
		parent::__construct();
		$this->load->library('format_uang');
        $this->load->helper('url');    
        $this->load->model('M_proses_gubernur');

        $this->load->helper('url');
		$this->load->library('session');
		$this->load->library('infopegawai');
		$this->load->model('mreferensi','referensi');
		$this->load->model('admin/v_pegawai','mdl');
		$this->load->model('hist/v_jabatanf_hist');

		if ($this->session->userdata('logged_in')) {

			$session_data       = $this->session->userdata('logged_in');
			// var_dump($session_data);
			$this->user['id']     	= $session_data['id'];
			$this->user['username']  	= $session_data['username'];
			$this->user['user_group']     = $session_data['user_group'];
			$this->user['kowil']     = $session_data['kowil'];
			$this->user['param_cari'] = $this->session->userdata('param_cari');
			// var_dump($this->user['kowil']);
		}else{
			redirect(base_url().'login', 'refresh');
		}
	}

	public function index()
	{
		// $data['temp'] = "";

		$datam['activemn'] = $this->infopegawai->initialMenu($this->user['user_group'],'prosesgubernur',0);
		$datam['inisial'] = 'Batching';

		if($this->user['user_group'] == '46' || $this->user['user_group'] == '2')
		{
			$this->load->view('head/header',$this->user);
			$this->load->view('head/menu',$datam);
			$this->load->view('proses_gubernur');
			$this->load->view('head/footer');
		}
		else
		{
			$this->load->view('403');
		}

	}

	public function dataGaji()
	{
		$this->M_proses_gubernur->getGaji();
	}

	// public function dataPPH()
	// {
	// 	$this->M_proses_gubernur->getPPH();
	// }

	public function cek_nrk_input()
	{
		$d = $this->M_proses_gubernur->CekNrk();
		$hasil_CekNrk = $d->JUMLAH;
		// var_dump($d); exit();

		if($hasil_CekNrk > 0){
			$respon = 'gagal';
		} else {	
			$respon = 'sukses';
		}
		$return = array('respon' => $respon);
		// untuk mengembalikan nilai dalam json. dan json wajib
		echo json_encode($return);
	}

	public function input_data_gubernur(){
		$this->M_proses_gubernur->inputDataGubernur();

		$respon = 'sukses';

		$return = array('respon' => $respon);

		echo json_encode($return);
	}

	public function tgl_batch()
	{
		$getTglBAtch = $this->M_proses_gubernur->get_Tgl_Batch();
		$id = $getTglBAtch->ID;
		$tgl = $getTglBAtch->TGL_BATCH;
		$tahun = substr($tgl, 0,4);
		$bulan = substr($tgl, 5,2);
		$tglBatch = $tahun.$bulan;
		// var_dump($tglBatch);exit;

		$return =  array('tglBatch' => $tglBatch, 'idt' => $id  );
		echo json_encode($return);
	}

	public function jml_hari_kerja(){
		$cek = $this->M_proses_gubernur->get_hari_kerja();
		$jml_hr_kerja = $cek->HARI_KERJA;
		//echo $jml_hr_kerja;
		$kembali = array('jml_hr_kerja' => $jml_hr_kerja);
		echo json_encode($kembali);
	}

	public function openModal()
	{
		$nptt;
		 if(isset($_POST['key1'])){
            $nptt = $_POST['key1'];
            // var_dump($form);

            
        }else{
            $return = array('response' => 'GAGAL', 'err' => 'Tidak ada NPTT');
            echo json_encode($return);
            exit();
        }

        $dataptt = $this->getDataPTT($nptt);
        
        $data['dataptt'] = $dataptt;

        $msg = $this->load->view('admin/form_ptt', $data, true);

        $return = array('response' => 'SUKSES', 'result' => $msg,'widthForm' => 'one');
        echo json_encode($return);
	}

	public function data_plain()
	{
		$this->M_proses_gubernur->getPlain();
	}

	public function data_gajiLain()
	{
		$this->M_proses_gubernur->getGaji_Lain();
	}

	// public function savepph(){
	// 	$tgl_batch2 = $this->input->post('tgl_batch2');
	// 	$idt2 = $this->input->post('idt2');

	// 	$simpan = $this->M_proses_gubernur->updateBatch($tgl_batch2,$idt2);

	// 	if($simpan){
	// 		$respone = 'sukses';
	// 		$return =  array('respone' => $respone,'tgl_batch2' => $tgl_batch2  );
	// 	}else{
	// 		$respone = 'gagal';
	// 		$return =  array('respone' => $respone );
	// 	}
	// 	echo json_encode($return);
	// }

	public function hps_plain(){
		$thbl = $this->input->post('thbl');
		// echo $thbl;
		$hps_tgl = $this->M_proses_gubernur->hapus_tgl($thbl);
		// $hps_pengLain = $this->M_proses_gubernur->hapus_Lain($thbl);
		if($hps_tgl){
			$respone = 'sukses';
		}

		$return = array('respone' => $respone );
		echo json_encode($return);

	}

	public function cek_gaji(){
		$tgl_batch2 = $this->input->post('tgl_batch3');
		$idt2 = $this->input->post('idt3');

		$cek_gaji = $this->M_proses_gubernur->CekGajiToPPH($tgl_batch2);
		$hsl_gaji = $cek_gaji->JML_GAJI;

		if($hsl_gaji == 0){
			$respone = "sukses";
		}else{
			$respone = "gagal";
		}

		$return = array('respone' => $respone, );
		echo json_encode($return);
	}

	public function exc_gaji(){
		$tgl_batch2 = $this->input->post('tgl_batch3');
		$tgl_batch_min = $tgl_batch2-1;
		// echo $tgl_batch2; exit();

		$idt2 = $this->input->post('idt3');

		
			$this->M_proses_gubernur->updateBatch($tgl_batch2,$idt2);
			$data_sebelumnya = $this->M_proses_gubernur->ambil_gj_sebelum($tgl_batch_min);

			if($data_sebelumnya){
				foreach ($data_sebelumnya as $key ) {
					$nrk = $key->NRK;
					$nama = $key->NAMA;
					$kolok = $key->KOLOK;
					$klogad = $key->KLOGAD;
					$spmu = $key->SPMU;
					$gapok = $key->GAPOK;
					$tistri = $key->TISTRI;
					$tanak = $key->TANAK;
					$tberas = $key->TBERAS;
					$pph_gaji = $key->PPH_GAJI;
					$jumkotor = $key->JUMKOTOR;
					$gaji_bersih = $key->GAJI_BERSIH;
					$tunjab = $key->TUNJAB;
					$pph_tunjab = $key->PPH_TUNJAB;
					$tunjab_bersih = $key->TUNJAB_BERSIH;
					$iwp = $key->IWP;
					$jnettpph = $key->JNETTPPH;
					$ntaspen = $key->NTASPEN;
					$naskes = $key->NASKES;
					$ntht = $key->NTHT;
					$biayajabatan = $key->BIAYAJABATAN;
					$juan = $key->JUAN;
					$jiwa = $key->JIWA;
					$jiwaawal = $key->JIWAAWAL;
					$jenkel = $key->JENKEL;
					$kdkerja = $key->KDKERJA;
					$stawin = $key->STAWIN;
					$npbulat = $key->NPBULAT;
					$tunfung = $key->TUNFUNG;
					$ntunlai = $key->NTUNLAI;

					$this->M_proses_gubernur->gaji_sesudah_diambil($nrk,$tgl_batch2,$nama,$kolok,$klogad,$spmu,$gapok,$tistri,$tanak,$tberas,$pph_gaji,$jumkotor,$gaji_bersih,$tunjab,$pph_tunjab,$tunjab_bersih,$iwp,$jnettpph,$ntaspen,$naskes,$ntht,$biayajabatan,$juan,$jiwa,$jiwaawal,$jenkel,$kdkerja,$stawin,$npbulat,$tunfung,$ntunlai);




				}
				$respone = 'sukses';
			}else{
				$respone = 'gagal';
			}
			
		

		// echo $respone;
		$return = array('respone' => $respone );
		echo json_encode($return);

	}

	// public function exc_pph(){
	// 	$tgl_batch2 = $this->input->post('tgl_batch2');
	// 	$idt2 = $this->input->post('idt2');

	// 	// $simpan = $this->M_proses_gubernur->updateBatch($tgl_batch2,$idt2);
		
	// 	//cek pph
	// 	$cek_pph = $this->M_proses_gubernur->CekPPH($tgl_batch2);
	// 	$hsl_pph = $cek_pph->JML_PPH;

	// 	//cek gaji
	// 	$cek_gaji = $this->M_proses_gubernur->CekGajiToPPH($tgl_batch2);
	// 	$hsl_gaji = $cek_gaji->JML_GAJI;
	// 	// echo $hsl_gaji;
		
	// 	if ($hsl_pph == 0 && $hsl_gaji >= 1) {
	// 		$this->M_proses_gubernur->updateBatch($tgl_batch2,$idt2);
	// 		$this->M_proses_gubernur->execute_pph();
	// 		$respone = 'sukses';
			
	// 	}else if($hsl_gaji == 0){
	// 		$respone = 'belum gaji';
	// 	}else{
	// 		$respone = 'gagal';
	// 	}
	// 	// echo $respone;
	// 	$return = array('respone' => $respone );
	// 	echo json_encode($return);
	// }

	public function view_gaji(){
		$gaji =  $this->M_proses_gubernur->get_gaji();
		$return = array('response' => 'SUKSES', 'gaji' => $gaji);
		echo json_encode($return);

	}

	function simpanData()
	{
		$data = $this->input->post();
		$response = $this->M_proses_gubernur->updatePTT($data);

		if($response){
            $return =array('response' => 'SUKSES');
        }else{
            $return =array('response' => 'GAGAL', 'hasil' => 'Key Sudah digunakan');
        }

        
        echo json_encode($return);
	}

	public function cek_gj(){
		$tgl_batch2 = $this->input->post('tgl_batch3');
		$idt2 = $this->input->post('idt3');

		$cek_gaji = $this->M_proses_gubernur->CekGajiToPPH($tgl_batch2);
		$hsl_gaji = $cek_gaji->JML_GAJI;

		if($hsl_gaji > 0){
			$thbl = $tgl_batch2;
			$simpan = $this->M_proses_gubernur->updateBatchprint($thbl);
			$respone = "sukses";
		}else{
			$respone = "gagal";
		}

		$return = array('respone' => $respone, );
		echo json_encode($return);
	}

	public function printGAJI(){

		$getTglBAtch = $this->M_proses_gubernur->get_Tgl_Batch();
		$id = $getTglBAtch->ID;
		$tgl = $getTglBAtch->TGL_BATCH;
		$tahun = substr($tgl, 0,4);
		$bulan = substr($tgl, 5,2);
		$tglBatch = $tahun.$bulan;
		
		$namaFile = "data_gaji_".$tglBatch.".prn";
		$separator = "\t";

		header("Content-type: prn/plain");
		header("Content-Disposition: attachment; filename=".$namaFile);
		$printGJ = $this->M_proses_gubernur->printGaji();
		foreach ($printGJ as $key) {
			$nrk 		= str_pad($key->NRK, 6," ",STR_PAD_RIGHT);
			$nip 		= str_pad($key->NIP, 20," ",STR_PAD_RIGHT);
			$nip18 		= str_pad($key->NIP18, 20," ",STR_PAD_RIGHT);
			$nama 		= str_pad($key->NAMA, 50," ",STR_PAD_RIGHT);
			$gol 		= str_pad($key->GOL, 10," ",STR_PAD_RIGHT);
			$spmu 		= str_pad($key->SPMU, 5," ",STR_PAD_RIGHT);
			$klogad 	= str_pad($key->KLOGAD, 10," ",STR_PAD_RIGHT);
			$naloks 	= str_pad($key->NALOKS, 10," ",STR_PAD_RIGHT);
			$njumbergaji= str_pad($key->NJUMBERGAJI, 10," ",STR_PAD_RIGHT);
			$thbl 		= str_pad($key->THBL, 6," ",STR_PAD_RIGHT);
			
			echo $nrk.$separator.$nip.$separator.$nip18.$separator.$nama.$separator.$gol.$separator.$spmu.$separator.$klogad.$separator.$naloks.$separator.$njumbergaji.$separator.$thbl."\r\n";
		}
	}

	public function cek_nrk_edit(){
		$hasil1 = $this->M_proses_gubernur->cek_data_sebelum_update();
		// var_dump($hasil1);
		$nrk = $hasil1->NRK;
		$nama = $hasil1->NAMA;
		$kolok = $hasil1->KOLOK;
		$klogad = $hasil1->KLOGAD;
		$spmu = $hasil1->SPMU;
		$gapok = $hasil1->GAPOK;
		$tistri = $hasil1->TISTRI;
		$tanak = $hasil1->TANAK;
		$tberas = $hasil1->TBERAS;
		$pph_gaji = $hasil1->PPH_GAJI;
		$jumkotor = $hasil1->JUMKOTOR;
		$gaji_bersih = $hasil1->GAJI_BERSIH;
		$tunjab = $hasil1->TUNJAB;
		$pph_tunjab = $hasil1->PPH_TUNJAB;
		$tunjab_bersih = $hasil1->TUNJAB_BERSIH;
		$iwp = $hasil1->IWP;
		$jnettpph = $hasil1->JNETTPPH;
		$ntaspen = $hasil1->NTASPEN;
		$naskes = $hasil1->NASKES;
		$ntht = $hasil1->NTHT;
		$biayajabatan = $hasil1->BIAYAJABATAN;
		$juan = $hasil1->JUAN;
		$jiwa = $hasil1->JIWA;
		$jiwaawal = $hasil1->JIWAAWAL;
		$jenkel = $hasil1->JENKEL;
		$kdkerja = $hasil1->KDKERJA;
		$stawin = $hasil1->STAWIN;
		$npbulat = $hasil1->NPBULAT;
		$tunfung = $hasil1->TUNFUNG;
		$ntunlai = $hasil1->NTUNLAI;

		$respon = 'sukses';

		$return = array('respon' => $respon, 'nrk' => $nrk, 'nama' => $nama, 'kolok' => $kolok, 'klogad' => $klogad, 'spmu' => $spmu, 'gapok' => $gapok, 'tistri' => $tistri, 'tanak' => $tanak, 'tberas' => $tberas, 'pph_gaji' => $pph_gaji, 'jumkotor' => $jumkotor, 'gaji_bersih' => $gaji_bersih, 'tunjab' => $tunjab, 'pph_tunjab' => $pph_tunjab, 'tunjab_bersih' => $tunjab_bersih, 'iwp' => $iwp, 'jnettpph' => $jnettpph, 'ntaspen' => $ntaspen, 'naskes' => $naskes, 'ntht' => $ntht, 'biayajabatan' => $biayajabatan, 'juan' => $juan, 'jiwa' => $jiwa, 'jiwaawal' => $jiwaawal, 'jenkel' => $jenkel, 'kdkerja' => $kdkerja, 'stawin' => $stawin, 'npbulat' => $npbulat, 'tunfung'=> $tunfung, 'ntunlai' => $ntunlai );
		echo json_encode($return);
	}

	public function simpan_update(){
		$this->M_proses_gubernur->proses_simpan_update();

		$respon = 'sukses';

		$return = array('respon' => $respon);

		echo json_encode($return);
	}

	public function cek_nrk_delete(){
		$this->M_proses_gubernur->proses_delete_data();

		$respon = 'sukses';

		$return = array('respon' => $respon);

		echo json_encode($return);
	}

}

/* End of file proses_gubernur.php */
/* Location: ./application/controllers/proses_gubernur.php */