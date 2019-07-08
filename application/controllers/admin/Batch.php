<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Batch extends CI_Controller {

	public function __construct()
  	{
		parent::__construct();
		$this->load->library('format_uang');
        $this->load->helper('url');    
        $this->load->model('admin/m_batch');
	}

	public function index()
	{
		// $data['temp'] = "";cek_gj_ptt

		$this->load->view('batch/navigation/header');
		$this->load->view('batch/navigation/menu');
		$this->load->view('batch/pph');
		$this->load->view('batch/navigation/footer');
	}

	public function dataGaji()
	{
		$this->m_batch->getGaji();
	}

	public function dataGaji_ssl()
	{
		$this->m_batch->getGaji_ssl();
	}

	public function dataPPH()
	{
		$this->m_batch->getPPH();
	}

	public function dataPTT()
	{
		$this->m_batch->getPTT();
	}

	public function dataPTT13()
	{
		$this->m_batch->getPTT13();
	}

	public function dataPTTRes()
	{
		$this->m_batch->getPTTRes();
	}

	public function dataTPP()
	{
		$this->m_batch->getTPP();
	}

	public function dataTPP13()
	{
		$this->m_batch->getTPP13();
	}

	public function cek_tpp1()
	{
		$thbl = $this->input->post('thbltpp');

		$cek = $this->m_batch->cek_data_tpp1($thbl);
		if($cek->JML <= 0){
			$respone = 'sukses';
		}else{
			$respone = 'gagal';
		}
		
		$return =  array('respone' => $respone );
		echo json_encode($return);
	}

	public function cek_tpp13()
	{
		$th = $this->input->post('th');
		$thbl = $th.'13';
		// echo $thbl;die();

		$cek = $this->m_batch->cek_data_tpp13($thbl);
		if($cek->JML <= 0){
			$respone = 'sukses';
		}else{
			$respone = 'gagal';
		}
		
		$return =  array('respone' => $respone );
		echo json_encode($return);
	}

	public function execute_tpp1(){
		$thbl = $this->input->post('thbltpp');

		$this->m_batch->updateBatchprint($thbl);

		$exc = $this->m_batch->exc_tpp1();
		if($exc){
			$respone = 'sukses';
		}else{
			$respone = 'gagal';
		}
		$return =  array('respone' => $respone );
		echo json_encode($return);
	}

	public function execute_tpp13(){
		$thbltpp13 = $this->input->post('thbltpp13');
		$th = $this->input->post('th');

		$this->m_batch->updateBatchprint($thbltpp13);

		$exc = $this->m_batch->exc_tpp13($th);
		if($exc){
			$respone = 'sukses';
		}else{
			$respone = 'gagal';
		}
		$return =  array('respone' => $respone );
		echo json_encode($return);
	}

	public function execute_tpp2()
	{
		$thbl = $this->input->post('thbltpp');
		$this->m_batch->updateBatchprint($thbl);
		
		$exc = $this->m_batch->exc_tpp2();
		if($exc){
			$respone = 'sukses';
		}else{
			$respone = 'gagal';
		}
		$return =  array('respone' => $respone );
		echo json_encode($return);
	}

	public function dataGaji13()
	{
		$this->m_batch->getGaji13();
	}

	public function dataGaji14()
	{
		$this->m_batch->getGaji14();
	}

	public function dataKrimi()
	{
		$this->m_batch->getKrimi();
	}

	public function datatkd2()
	{
		$this->m_batch->getTKD2();
	}

	public function datatkdguru()
	{
		$this->m_batch->getTKDGuru();
	}

	public function datatkdtransp()
	{
		$this->m_batch->getTKDTransp();	
	}

	public function tgl_batch()
	{
		$getTglBAtch = $this->m_batch->get_Tgl_Batch();
		$id = $getTglBAtch->ID;
		$tgl = $getTglBAtch->TGL_BATCH;
		$tahun = substr($tgl, 0,4);
		$bulan = substr($tgl, 5,2);
		$tglBatch = $tahun.$bulan;
		/*echo $tahun; exit();*/
		// var_dump($tglBatch);exit;

		$return =  array('tglBatch' => $tglBatch, 'idt' => $id, 'tgl' => $tgl, 'tahun' => $tahun );
		echo json_encode($return);
	}

	public function jml_hari_kerja(){
		$cek = $this->m_batch->get_hari_kerja();
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

	public function getDataPTT($nptt)
	{
		$dt = $this->m_batch->getDataPTTbyNPTT($nptt);

		return $dt;
	}

	public function data_plain()
	{
		$this->m_batch->getPlain();
	}

	public function data_gajiLain()
	{
		$this->m_batch->getGaji_Lain();
	}

	public function data_nrk_ssl()
	{
		$this->m_batch->get_data_nrk_ssl();
	}

	public function simpan_nrk_ssl(){
		$nrk_ssl = $this->input->post('nrk_ssl');
		// echo $nrk_ssl; exit();
		$insert = $this->m_batch->input_nrk($nrk_ssl);
		if($insert){
			$respone = 'sukses';
		}
		$return =  array('respone' => $respone );
		echo json_encode($return);
	}

	public function truncate_nrk_ssl(){
		$exc = $this->m_batch->exc_truncate_nrk_ssl();
		if($exc){
			$respone = 'sukses';
		}
		$return =  array('respone' => $respone );
		echo json_encode($return);
	}

	public function save_pengLain(){
		$tgl_batch2 = $this->input->post('thbl');
		$idt2 = $this->input->post('idt');

		
		// echo $cek_tgl;exit;

		$thbl = $this->input->post('thbl');
		$bulanplain = $this->input->post('bulanplain');
		$tabelid = $this->input->post('tabelid');

		// var_dump($thbl);exit;

		$cek_tgl = strlen($tgl_batch2);
		$cek_thbl = strlen($thbl);

		$cek_data = $this->m_batch->cekLain($thbl,$bulanplain,$tabelid);

		$hsl_cek = $cek_data->JML;
		

		if($hsl_cek >= 1){
			$respone = 'ada data';
		}else if($cek_tgl != 6 OR $cek_thbl != 6){
			$respone = 'tidak cocok';
		}else if($tgl_batch2 != $thbl){
			$respone = 'tgl != thbl';
		}else{
			
			$simpan = $this->m_batch->updateBatch($tgl_batch2,$idt2);
			$save = $this->m_batch->saveLain($thbl,$bulanplain,$tabelid);

			if($save){
				$respone = 'belum ada data';
			}
			
		}
		
		$return =  array('respone' => $respone );
		echo json_encode($return);
	}

	

	public function savepph(){
		$tgl_batch2 = $this->input->post('tgl_batch2');
		$idt2 = $this->input->post('idt2');

		$simpan = $this->m_batch->updateBatch($tgl_batch2,$idt2);

		if($simpan){
			$respone = 'sukses';
			$return =  array('respone' => $respone,'tgl_batch2' => $tgl_batch2  );
		}else{
			$respone = 'gagal';
			$return =  array('respone' => $respone );
		}
		echo json_encode($return);
	}

	public function hps_plain(){
		$thbl = $this->input->post('thbl');
		// echo $thbl;
		$hps_tgl = $this->m_batch->hapus_tgl($thbl);
		// $hps_pengLain = $this->m_batch->hapus_Lain($thbl);
		if($hps_tgl){
			$respone = 'sukses';
		}

		$return = array('respone' => $respone );
		echo json_encode($return);

	}

	public function cek_gaji(){
		$tgl_batch = $this->input->post('tgl_batch3');
		$th = substr($tgl_batch, 0,4);
        $bln= substr($tgl_batch, 5,2);
        $tgl_batch2 = $th.$bln;
		$idt2 = $this->input->post('idt3');

		$cek_gaji = $this->m_batch->CekGajiToPPH($tgl_batch2);
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
		$idt2 = $this->input->post('idt3');

		
			$this->m_batch->updateBatchprint_gj($tgl_batch2);
			// $this->m_batch->ubahDate_format();
			$gaji = $this->m_batch->execute_gaji();

			$respone = 'sukses';
		

		// echo $respone;
		$return = array('respone' => $respone );
		echo json_encode($return);

	}

	public function exc_gaji_ssl(){
		$thbl_ssl = $this->input->post('thbl_ssl');
		// echo $thbl_ssl; exit();
		$this->m_batch->updateBatchprint_gj($thbl_ssl);
		
		$gaji_ssl = $this->m_batch->execute_gaji_ssl();
		$respone = 'sukses';
		
		// echo $respone;
		$return = array('respone' => $respone);
		/*$return = array('respone' => $respone, 'pesan_error' => $pesan);*/
		echo json_encode($return);

	}

	public function exc_pph(){
		$tgl_batch2 = $this->input->post('tgl_batch2');
		$idt2 = $this->input->post('idt2');

		// $simpan = $this->m_batch->updateBatch($tgl_batch2,$idt2);
		
		//cek pph
		$cek_pph = $this->m_batch->CekPPH($tgl_batch2);
		$hsl_pph = $cek_pph->JML_PPH;

		//cek gaji
		$cek_gaji = $this->m_batch->CekGajiToPPH($tgl_batch2);
		$hsl_gaji = $cek_gaji->JML_GAJI;
		// echo $hsl_gaji;
		
		if ($hsl_pph == 0 && $hsl_gaji >= 1) {
			$this->m_batch->updateBatch($tgl_batch2,$idt2);
			$this->m_batch->execute_pph();
			$respone = 'sukses';
			
		}else if($hsl_gaji == 0){
			$respone = 'belum gaji';
		}else{
			$respone = 'gagal';
		}
		// echo $respone;
		$return = array('respone' => $respone );
		echo json_encode($return);
	}

	public function exc_ptt(){
		$thbl_ptt = $this->input->post('thbl_ptt');
		$idt4 = $this->input->post('idt4');

		$this->m_batch->updateBatch($thbl_ptt,$idt4);
		$p = $this->m_batch->execute_ptt();
		$respon="";

		
		if($p)
		{
			if($p == 1)
			{
				$respon ="SUKSES";
			}
			else if($p == 0)
			{
				$respon ="DATA KOSONG";
			}
			else if($p == -1)
			{
				$respon ="DATA SUDAH ADA";	
			}
		}
		else
		{
			$respon ="GAGAL";
		}
	
		
		$return = array('respone' => $respon);
		
		echo json_encode($return);
	}

	public function exc_ptt_13(){
		$th13 = $this->input->post('th13');
		$thblptt13 = $this->input->post('thblptt13');

		$cek_gaji_ptt = $this->m_batch->cek_gaji_ptt($thblptt13);
		if($cek_gaji_ptt->JML <= 0){
			$respone = 'GAGAL';
		}else{
			$cek_gaji_13 = $this->m_batch->cek_gaji_13($th13);
			if($cek_gaji_13->JML > 0){
				$respone = 'ADA';
			}else{
				$this->m_batch->updateBatchprint_gj($thblptt13);
				$this->m_batch->execute_ptt_13($th13);
				$respone = 'SUKSES';
			}
		}
		
		// echo $respone;die();
		$return = array('respone' => $respone );
		echo json_encode($return);

	}

	public function exc_pengLain(){
		$tgl_batch = $this->input->post('tgl_batch');
		// echo $tgl_batch;exit;

		//cek penghasilanlain
		$cek_tblLain = $this->m_batch->pengLain($tgl_batch);
		$hsl = $cek_tblLain->JML;

		//cek tabel plain
		$cek_plain = $this->m_batch->tbl_plain($tgl_batch);
		$hsl_plain = $cek_plain->JML_PLAIN;

		// echo $hsl;exit;


		if($hsl >= 1){
			$respone = 'ada';
		}elseif ($hsl_plain == 0) {
			$respone = 'tgl plain kosong';
		// }elseif($hsl == 0 && $hsl_plain != 0){
		}else{
			$respone = 'sukses';
			$this->m_batch->exc_penghasilanLain();
			
		}
		// echo $respone;
		$return = array('respone' => $respone );
		echo json_encode($return);
	}

	public function exc_gaji13(){
		$thbl  = $this->input->post('thbl');
		$tahun = $this->input->post('tahun');
        $bln= '13';
        $thbl13 = $tahun.$bln;

		/*echo $thbl.' - '.$thbl13 ; exit();*/
		$cek = $this->m_batch->cek_gaji13($thbl13);
		$hsl = $cek->JML_GAJI;

		/*echo $hsl;exit();*/

		if($hsl >= 1){
			$respone = 'gagal';
		}else{
			$this->m_batch->updateBatchprint($thbl);
			$this->m_batch->exc_gaji13($tahun);

			$respone = 'sukses';
			
		}
		//echo $respone;
		$return = array('respone' => $respone );
		echo json_encode($return);
	}

	public function exc_gaji14(){
		$thbl  = $this->input->post('thbl');
		$tahun = $this->input->post('tahun');
        $bln= '14';
        $thbl14 = $tahun.$bln;

		/*echo $thbl.' - '.$thbl14 ; exit();
*/		$cek = $this->m_batch->cek_gaji14($thbl14);
		$hsl = $cek->JML_GAJI;

		// echo $hsl;exit();

		if($hsl >= 1){
			$respone = 'gagal';
		}else{
			$this->m_batch->updateBatchprint($thbl);
			$this->m_batch->exc_gaji14($tahun);

			$respone = 'sukses';
			
		}
		//echo $respone;
		$return = array('respone' => $respone );
		echo json_encode($return);
	}

	public function exc_krimiTKD(){
		$tgl_batch = $this->input->post('tgl_batch');

		$th = substr($tgl_batch, 0,4);
        $bln= substr($tgl_batch, 5,2);
        $tgl_batch_cek_krimi = $th.$bln;

		// echo $tgl_batch; exit();
		$cek = $this->m_batch->krimiTKD($tgl_batch_cek_krimi);
		$hsl = $cek->JML;


		// $this->m_batch->updateBatchprint_tkd($tgl_batch); exit();

		// echo $hsl;exit();

		if($hsl >= 1){
			$respone = 'gagal';
		}else{
			$this->m_batch->updateBatchprint_tkd($tgl_batch);
			$this->m_batch->exc_krimi_TKD();

			$respone = 'sukses';
			
		}
		//echo $respone;
		$return = array('respone' => $respone );
		echo json_encode($return);
	}

	public function exc_TKD2(){
		$tgl_batch = $this->input->post('tgl_batch');
		$hr_krja = $this->input->post('hr_krja');

		//echo $tgl_batch; echo " - "; echo $hr_krja;
		
		$cek = $this->m_batch->TKD2($tgl_batch);
		$hsl = $cek->JML;

		// echo $hsl;exit();

		if($hsl >= 1){
			$respone = 'gagal';
		}else{
			$thbl = $tgl_batch;
			$this->m_batch->updateBatchprint($thbl);
			$this->m_batch->updateHariKerja($hr_krja);
			$this->m_batch->exc_TKD_Tahap2();

			$respone = 'sukses';
		}
		// echo $respone;
		$return = array('respone' => $respone );
		echo json_encode($return);
	}

	public function exc_Transport(){
		$tgl_batch = $this->input->post('tgl_batch');

		//echo $tgl_batch; echo " - "; echo $hr_krja;
		
		$cek = $this->m_batch->Transport($tgl_batch);
		$hsl = $cek->JML;

		//echo $hsl;exit();

		if($hsl >= 1){
			$respone = 'gagal';
		}else{
			$thbl = $tgl_batch;
			$this->m_batch->updateBatchprint($thbl);
			$this->m_batch->excTransport();

			$respone = 'sukses';
		}
		//echo $respone;
		$return = array('respone' => $respone );
		echo json_encode($return);
	}

	public function view_gaji(){
		$gaji =  $this->m_batch->get_gaji();
		$return = array('response' => 'SUKSES', 'gaji' => $gaji);
		echo json_encode($return);

	}

	public function view_tkd(){
		$tkd =  $this->m_batch->get_tkd();
		$return = array('response' => 'SUKSES', 'tkd' => $tkd);
		echo json_encode($return);
	}

	public function view_guru(){
		$tkd_guru =  $this->m_batch->get_tkd_guru();
		$return = array('response' => 'SUKSES', 'tkd_guru' => $tkd_guru);
		echo json_encode($return);
	}

	function simpanData()
	{
		$data = $this->input->post();
		$response = $this->m_batch->updatePTT($data);

		if($response){
            $return =array('response' => 'SUKSES');
        }else{
            $return =array('response' => 'GAGAL', 'hasil' => 'Key Sudah digunakan');
        }

        
        echo json_encode($return);
	}

	public function cek_gj(){
		$tgl_batch2 = $this->input->post('tgl_batch3');
		// $th = substr($tgl_batch, 0,4);
  //       $bln= substr($tgl_batch, 5,2);
        // $tgl_batch2 = $th.$bln;
		$idt2 = $this->input->post('idt3');

		$cek_gaji = $this->m_batch->CekGajiToPPH($tgl_batch2);
		$hsl_gaji = $cek_gaji->JML_GAJI;

		if($hsl_gaji > 0){
			// $thbl = $tgl_batch2;
			// echo $thbl; exit();
			$simpan = $this->m_batch->updateBatchprint_gj($tgl_batch2);
			$respone = "sukses";
		}else{
			$respone = "gagal";
		}

		$return = array('respone' => $respone, );
		echo json_encode($return);
	}

	public function printGAJI(){

		$getTglBAtch = $this->m_batch->get_Tgl_Batch();
		$id = $getTglBAtch->ID;
		$tgl = $getTglBAtch->TGL_BATCH;
		$tahun = substr($tgl, 0,4);
		$bulan = substr($tgl, 5,2);
		$tglBatch = $tahun.$bulan;
		// echo $tglBatch; exit();

		/*$test='1234567890';
		echo substr($test, 0, 8);exit();*/
		
		$namaFile = "data_gaji_".$tglBatch.".prn";
		//$separator = "\t"; 
		$separator = "";

		header("Content-type: prn/plain");
		header("Content-Disposition: attachment; filename=".$namaFile);
		$printGJ = $this->m_batch->printGaji();
		foreach ($printGJ as $key) {
			$nrk 		= str_pad($key->NRK, 6," ",STR_PAD_RIGHT);
			$nip 		= str_pad($key->NIP, 9," ",STR_PAD_RIGHT);
			$nip18 		= str_pad($key->NIP18, 18," ",STR_PAD_RIGHT);
			$nama 		= str_pad(substr($key->NAMA, 0, 25), 25," ",STR_PAD_RIGHT);
			$gol 		= str_pad($key->GOL, 5," ",STR_PAD_RIGHT);
			$spmu 		= str_pad($key->SPMU, 4," ",STR_PAD_RIGHT);
			$klogad 	= str_pad($key->KLOGAD, 9," ",STR_PAD_RIGHT);
			$naloks 	= str_pad(substr($key->NALOKS, 0, 50), 50," ",STR_PAD_RIGHT);
			$njumbergaji= str_pad($key->NJUMBERGAJI, 8," ",STR_PAD_LEFT);
			$thbl 		= str_pad($key->THBL, 6," ",STR_PAD_RIGHT);
			
			echo $nrk.$separator.$nip.$separator.$nip18.$separator.$nama.$separator.$gol.$separator.$spmu.$separator.$klogad.$separator.$naloks.$separator.$njumbergaji.$separator.$thbl."\r\n";
		}
	}

	public function cek_tkd(){
		$tgl_batch = $this->input->post('tgl_batch');

		$cek_tkd2 = $this->m_batch->CekTKD2($tgl_batch);
		$hsl = $cek_tkd2->JML_TKD2;

		if($hsl > 0){
			$thbl = $tgl_batch;
			$simpan = $this->m_batch->updateBatchprint($thbl);
			$respone = "sukses";
		}else{
			$respone = "gagal";
		}

		$return = array('respone' => $respone, );
		echo json_encode($return);
	}

	public function printTKD2()
	{
		$getTglBAtch = $this->m_batch->get_Tgl_Batch();
		$id = $getTglBAtch->ID;
		$tgl = $getTglBAtch->TGL_BATCH;
		$tahun = substr($tgl, 0,4);
		$bulan = substr($tgl, 5,2);
		$tglBatch = $tahun.$bulan;

		$namaFile = "data_TKD_tahap2_".$tglBatch.".prn";
		// $separator = "\t";
		$separator = "";

		header("Content-type: prn/plain");
		header("Content-Disposition: attachment; filename=".$namaFile);
		$printTKD2 = $this->m_batch->printGaji_TKD2();
		foreach ($printTKD2 as $key) {
			$nrk 			= str_pad($key->NRK, 6," ",STR_PAD_RIGHT);
			$nip18 			= str_pad($key->NIP18, 18," ",STR_PAD_RIGHT);
			$nama 			= str_pad(substr($key->NAMA, 0, 25), 25," ",STR_PAD_RIGHT);
			$spmu 			= str_pad($key->SPMU, 4," ",STR_PAD_RIGHT);
			$klogad 		= str_pad($key->KLOGAD, 9," ",STR_PAD_RIGHT);
			$nalokl 		= str_pad(substr($key->NALOKL, 0, 50), 50," ",STR_PAD_RIGHT);
			$njtundabersih 	= str_pad($key->NJTUNDABERSIH, 9," ",STR_PAD_LEFT);
			$thbl 			= str_pad($key->THBL, 6," ",STR_PAD_RIGHT);
			$kdesel 		= str_pad($key->KDESEL, 6," ",STR_PAD_RIGHT);

			echo $nrk.$separator.$nip18.$separator.$nama.$separator.$spmu.$separator.$klogad.$separator.$nalokl.$separator.$njtundabersih.$separator.$thbl.$separator.$kdesel."\r\n";
		}
	}

	public function cek_transport(){
		$tgl_batch = $this->input->post('tgl_batch');

		$cek_trans = $this->m_batch->CekTransport($tgl_batch);
		$hsl = $cek_trans->JML_TRANS;

		if($hsl > 0){
			$thbl = $tgl_batch;
			$simpan = $this->m_batch->updateBatchprint($thbl);
			$respone = "sukses";
		}else{
			$respone = "gagal";
		}

		//ECHO "ada"; exit();

		$return = array('respone' => $respone, );
		echo json_encode($return);
	}

	public function printTransport()
	{
		$getTglBAtch = $this->m_batch->get_Tgl_Batch();
		$id = $getTglBAtch->ID;
		$tgl = $getTglBAtch->TGL_BATCH;
		$tahun = substr($tgl, 0,4);
		$bulan = substr($tgl, 5,2);
		$tglBatch = $tahun.$bulan;

		$namaFile = "data_tkd_transport_".$tglBatch.".prn";
		// $separator = "\t";
		$separator = "";

		header("Content-type: prn/plain");
		header("Content-Disposition: attachment; filename=".$namaFile);
		$printTrans = $this->m_batch->print_Transport();
		foreach ($printTrans as $key) {
			$nrk 			= str_pad($key->NRK, 6," ",STR_PAD_RIGHT);
			$nip18 			= str_pad($key->NIP18, 18," ",STR_PAD_RIGHT);
			$nama 			= str_pad(substr($key->NAMA, 0, 25), 25," ",STR_PAD_RIGHT);
			$spmu 			= str_pad($key->SPMU, 4," ",STR_PAD_RIGHT);
			$klogad 		= str_pad($key->KLOGAD, 9," ",STR_PAD_RIGHT);
			$nalokl 		= str_pad(substr($key->NALOKL, 0, 50), 50," ",STR_PAD_RIGHT);
			$jumber 		= str_pad($key->JUMBER, 9," ",STR_PAD_LEFT);
			$thbl 			= str_pad($key->THBL, 6," ",STR_PAD_RIGHT);
			$kdesel 		= str_pad($key->KDESEL, 6," ",STR_PAD_RIGHT);

			echo $nrk.$separator.$nip18.$separator.$nama.$separator.$spmu.$separator.$klogad.$separator.$nalokl.$separator.$jumber.$separator.$thbl.$separator.$kdesel."\r\n";
		}
	}

	public function cek_gj_ptt(){
		$thbl_ptt = $this->input->post('thbl_ptt');
		// $idt2 = $this->input->post('idt3');

		$cek_gaji = $this->m_batch->cekGaji_ptt($thbl_ptt);
		$hsl_gaji = $cek_gaji->JML_GAJI;

		if($hsl_gaji > 0){
			$thbl = $thbl_ptt;
			$simpan = $this->m_batch->updateBatchprint($thbl);
			$respone = "sukses";
		}else{
			$respone = "gagal";
		}

		$return = array('respone' => $respone, );
		echo json_encode($return);
	}

	public function printGAJI_ptt(){

		$getTglBAtch = $this->m_batch->get_Tgl_Batch();
		$id = $getTglBAtch->ID;
		$tgl = $getTglBAtch->TGL_BATCH;
		$tahun = substr($tgl, 0,4);
		$bulan = substr($tgl, 5,2);
		$tglBatch = $tahun.$bulan;

		if($bulan=='01'){
			$nm_bln = 'JANUARI';
		}elseif($bulan=='02'){
			$nm_bln = 'FEBRUARI';
		}elseif($bulan=='03'){
			$nm_bln = 'MARET';
		}elseif($bulan=='04'){
			$nm_bln = 'APRIL';
		}elseif($bulan=='05'){
			$nm_bln = 'MEI';
		}elseif($bulan=='06'){
			$nm_bln = 'JUNI';
		}elseif($bulan=='07'){
			$nm_bln = 'JULI';
		}elseif($bulan=='08'){
			$nm_bln = 'AGUSTUS';
		}elseif($bulan=='09'){
			$nm_bln = 'SEPTEMBER';
		}elseif($bulan=='10'){
			$nm_bln = 'OKTOBER';
		}elseif($bulan=='11'){
			$nm_bln = 'NOVEMBER';
		}elseif($bulan=='12'){
			$nm_bln = 'DESEMBER';
		}
		
		$namaFile = "data_gaji_ptt_".$tglBatch.".prn";
		// $separator = "\t";
		$separator = "";

		header("Content-type: prn/plain");
		header("Content-Disposition: attachment; filename=".$namaFile);
		$printGJ = $this->m_batch->printGAJI_ptt($tglBatch);
		foreach ($printGJ as $key) {
			$nama 		= str_pad(substr($key->NAMA, 0, 25), 25," ",STR_PAD_RIGHT);
			$nptt 		= str_pad($key->NPTT, 9," ",STR_PAD_RIGHT);
			$tgllahir 	= str_pad($key->TGLLAHIR, 10," ",STR_PAD_RIGHT);
			$klogad 	= str_pad($key->KLOGAD, 9," ",STR_PAD_RIGHT);
			$naloks 	= str_pad(substr($key->NALOKS, 0, 50), 50," ",STR_PAD_RIGHT);
			$gajibersih = str_pad($key->GAJIBERSIH, 8," ",STR_PAD_LEFT);
			
			echo $nama.$nptt.$tgllahir.$klogad.$naloks.$gajibersih.$nm_bln.' '.$tahun."\r\n";
		}
	}

	public function cek_TPP_PTT(){
		$thbltpp = $this->input->post('thbltpp');
		// $idt2 = $this->input->post('idt3');

		$cek_gaji = $this->m_batch->cek_TPP_ptt($thbltpp);
		$hsl_gaji = $cek_gaji->JML_GAJI;

		if($hsl_gaji > 0){
			$thbl = $thbltpp;
			$simpan = $this->m_batch->updateBatchprint($thbl);
			$respone = "sukses";
		}else{
			$respone = "gagal";
		}

		$return = array('respone' => $respone, );
		echo json_encode($return);
	}

	public function print_TPP_PTT(){

		$getTglBAtch = $this->m_batch->get_Tgl_Batch();
		$id = $getTglBAtch->ID;
		$tgl = $getTglBAtch->TGL_BATCH;
		$tahun = substr($tgl, 0,4);
		$bulan = substr($tgl, 5,2);
		$tglBatch = $tahun.$bulan;

		if($bulan=='01'){
			$nm_bln = 'JANUARI';
		}elseif($bulan=='02'){
			$nm_bln = 'FEBRUARI';
		}elseif($bulan=='03'){
			$nm_bln = 'MARET';
		}elseif($bulan=='04'){
			$nm_bln = 'APRIL';
		}elseif($bulan=='05'){
			$nm_bln = 'MEI';
		}elseif($bulan=='06'){
			$nm_bln = 'JUNI';
		}elseif($bulan=='07'){
			$nm_bln = 'JULI';
		}elseif($bulan=='08'){
			$nm_bln = 'AGUSTUS';
		}elseif($bulan=='09'){
			$nm_bln = 'SEPTEMBER';
		}elseif($bulan=='10'){
			$nm_bln = 'OKTOBER';
		}elseif($bulan=='11'){
			$nm_bln = 'NOVEMBER';
		}elseif($bulan=='12'){
			$nm_bln = 'DESEMBER';
		}
		
		$namaFile = "data_tpp_ptt_".$tglBatch.".prn";
		// $separator = "\t";
		$separator = "";

		header("Content-type: prn/plain");
		header("Content-Disposition: attachment; filename=".$namaFile);
		$printGJ = $this->m_batch->print_TPP_PTT($tglBatch);
		foreach ($printGJ as $key) {
			$nptt 		= str_pad($key->NPTT, 15," ",STR_PAD_RIGHT);
			$nama 		= str_pad(substr($key->NAMA, 0, 25), 25," ",STR_PAD_RIGHT);
			$klogad 	= str_pad($key->KLOGAD, 9," ",STR_PAD_RIGHT);
			$naloks 	= str_pad(substr($key->NALOKS, 0, 50), 50," ",STR_PAD_RIGHT);
			$tppbersih  = str_pad($key->TPPBERSIH, 15," ",STR_PAD_LEFT);
			
			echo $nptt.$nama.$klogad.$naloks.$tppbersih.$nm_bln.' '.$tahun."\r\n";
		}
	}

	public function upload_nrk_ssl(){
		$file = $_FILES['fFile']['tmp_name'];

        //load the excel library
        $this->load->library('excel');
        //read file from path
        $objPHPExcel = PHPExcel_IOFactory::load($file);

        $countworksheet = $objPHPExcel->getSheetCount();

        $isiExcel = array();

        $titleworksheet = array();

        $jmlpeg1=0; $ctpeg1=0; $errpeg1=0; $arrErPeg1 = array();
        $jmljabhist=0; $ctjabhist=0; 
        $dupjabhist=0; $arrDupJabHist=array();$errjabhist=0; $arrErJabHist = array();
       
        

        for($i=0;$i<$countworksheet;$i++)
        {
             $worksheet = $objPHPExcel->setActiveSheetIndex($i);

             $worksheetTitle=$worksheet->getTitle();
             $titleworksheet[$i] = $worksheetTitle;
             $highestRow=$worksheet->getHighestRow();
            
             //PERS_PEGAWAI1
             if($i == 0)
             {
                $jmlpeg1 = $highestRow-1;
                $highestColumn=PHPExcel_Cell::columnIndexFromString('C');
             }
             else if($i == 1)
             {
                $jmljabhist = $highestRow-1;
                $highestColumn=PHPExcel_Cell::columnIndexFromString('P');
             }
             $isiExcel[$i] = array($worksheetTitle,$highestRow,$highestColumn);
             $dataperrow;

                for($r=3 ;$r<=$highestRow;$r++ )
                {
                    $dataperrow= array();
                    for($c =0;$c<$highestColumn;$c++)
                    {
                        
                        $dataperrow[$c] = $worksheet->getCellByColumnAndRow($c, $r)->getValue();

                        if($c == $highestColumn - 1)
                        {
                            if($highestColumn == count($dataperrow))
                            {
                                if($i == 0)
                                {
                                    
                                    $nrk_ssl = $dataperrow[0];
                                    
                                    
                                    // $sql_cek="SELECT * FROM PERS_PEGAWAI1 WHERE NRK='".$nrk_ssl."'";
                                    // $query_cek = $this->prod->query($sql_cek);
                                    $query_cek = $this->m_batch->cek_nrk_ssl_pegawai1($nrk_ssl);

                                    if($query_cek)
                                    {
                                        $value_cek = $query_cek->num_rows();

                                        if($value_cek == 1)
                                        {
                                            if($nrk_ssl != null)
                                            {
                                                // $sql_insert = "INSERT INTO PERSJP_NRK_SSL(NRK_SSL)VALUES('".$nrk_ssl."')";
                                                  
                                                // $query_insert = $this->prod->query($sql_insert); 
                                                $query_insert = $this->m_batch->upload_nrk_ssl($nrk_ssl); 

                                                if($query_insert)
                                                {
                                                    // $ctpeg1++;
                                                    $hasilsukses= 'sukses' ;
                                                }
                                                else
                                                {
                                                    // $arrErPeg1[$errpeg1] = $r;
                                                    // $errpeg1++;
                                                    $hasilsukses= 'gagal' ;
                                                }
                                            }
                                            else
                                            {
                                                // $arrErPeg1[$errpeg1] = $r;
                                                // $errpeg1++;
                                                $hasilsukses= 'gagal' ;
                                            }
                                            
                                        }
                                        else
                                        {
                                            // $arrErPeg1[$errpeg1] = $r;
                                            // $errpeg1++;
                                            $hasilsukses= 'gagal' ;
                                        }
                                    }
                                    else
                                    {
                                        // $arrErPeg1[$errpeg1] = $r;
                                        // $errpeg1++;
                                        
                                    }
                                }

                            }
                        }
                    }//end looping col
                }// end looping row

       }

        
        // $x ;

        // var_dump($ctpeg1);
        // var_dump($jmlpeg1);
        // var_dump($ctjabhist);
        // var_dump($jmljabhist);
        // var_dump($ctpg);
        // var_dump($jmlpg);
        // var_dump($ctgp);
        // var_dump($jmlgp);exit();
        // if($ctpeg1 == $jmlpeg1 && $ctjabhist == $jmljabhist && $errpeg1 == 0 && $errjabhist == 0 && $dupjabhist == 0)
        // {
        //     $hasilsukses =1;
        //     $x = 'ha';
        // }
        // else if( $errpeg1 > 0 || $errjabhist > 0)
        // {
        //     $hasilsukses = -1;
        //     $x = 'hi';
        // }
        // else if($dupjabhist>0 )
        // {
        //     $hasilsukses = 0;
        //     $x = 'hu';
        // }
        // else
        // {
        //     $hasilsukses =-1;   
        //     $x = 'he';
        // }
        

        echo json_encode(array('response' => $hasilsukses, 'peg1sukses' => $ctpeg1, 'peg1error' => count($arrErPeg1), 'jabhistsukses' => $ctjabhist, 'jabhisterror' => count($arrErJabHist), 'jabhistdup' => $dupjabhist));
      
        //echo $hasilsukses;
	}
	
}