<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Rekap_penghasilan extends CI_Controller {

	public function __construct()
  	{
		parent::__construct();
		$this->load->library('format_uang');
        $this->load->helper('url');    
        

        
		$this->load->library('session');
		$this->load->library('infopegawai');
		$this->load->model('mreferensi','referensi');
		$this->load->model('admin/v_pegawai','mdl');
		$this->load->model('hist/v_jabatanf_hist');
		$this->load->model('admin/m_batch','m_batch');

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

		$datam['activemn'] = $this->infopegawai->initialMenu($this->user['user_group'],'rekap_penghasilan',0);
		
		$cekaksesmenu = $this->infopegawai->getMenuAccessBy($this->user['user_group'],'27309');
		$valakses = $cekaksesmenu->act_view;
		$datam['inisial'] = 'Batching';

		
		
		

		if($valakses == 'Y')
		{
			$this->load->view('head/header',$this->user);
			$this->load->view('head/menu',$datam);
			$this->load->view('rekap_penghasilan');
			$this->load->view('head/footer');
		}
		else
		{
			$this->load->view('403');
		}
		



		// $this->load->view('admin/navigation/header');
		// $this->load->view('admin/navigation/menu');
		// $this->load->view('admin/batch');
		// $this->load->view('admin/navigation/footer');
	}

	public function cekrevisi()
	{
		$tgl_batch = $this->input->post('tgl_batch');

		$this->m_batch->pindahkehist($tgl_batch);
	}

	public function exc_rekaphasiltglpub(){
		$tgl_batch = $this->input->post('tgl_batch');

		
			$cek = $this->m_batch->ceksudah($tgl_batch);


			if($cek == 0)
			{
				$eksekusi = $this->m_batch->exc_rekap_hasil_tglpub($tgl_batch);	
				$respone = 'sukses';
				
			}
			else
			{
				$respone = 'sukses';
			}	
		


		
	

		

		$data['data1']= $this->m_batch->showDataRekap1();
		
			
		$id_cek = $data['data1']->ID_CEK;

		$data['data2']='';
			$VJUMLAHREKAP = $data['data1']->VJUMLAHREKAP;
			if($VJUMLAHREKAP >0 )
			{
				$VJUMLAHRUTIN = $data['data1']->VJUMLAHRUTIN;
				if($VJUMLAHRUTIN > 0)
				{
					$data['data2'] = $this->m_batch->showdataRutinLebih($id_cek);	
				}
				
			}
		$data['data3'] = $this->m_batch->showCekSelisih($id_cek);
		$data['data4'] = $this->m_batch->showdetailRekap($id_cek);	
		$data['data5'] = $this->m_batch->showjumlahSIPKD($id_cek);
		$data['data6'] = $this->m_batch->cekVerror($id_cek);
		$data['data7'] = $this->m_batch->getwaktuAkhir($id_cek);
		//echo $respone;
		$return = array('respone' => $respone, 'laporan'=>$data);
		echo json_encode($return);
	}

	public function exc_rekaphasilhariini(){
		
		$tgl_batch = $this->input->post('tgl_batch');
		
		//$eksekusi = $this->m_batch->exc_rekap_hasil_hariini();
        $respone;
			$cek = $this->m_batch->ceksudah($tgl_batch);
			

			if($cek == 0)
			{
				$eksekusi = $this->m_batch->exc_rekap_hasil_hariini();
				$respone = 'sukses';
			}
			else
			{
				$this->cekrevisi($tgl_batch);
				$eksekusi = $this->m_batch->exc_rekap_hasil_hariini();
				$respone = 'sukses';
			}	

		//$respone='sukses';

		$data['data1']= $this->m_batch->showDataRekap1();
		
			
		$id_cek = $data['data1']->ID_CEK;

		$data['data2']='';
			$VJUMLAHREKAP = $data['data1']->VJUMLAHREKAP;
			if($VJUMLAHREKAP >0 )
			{
				$VJUMLAHRUTIN = $data['data1']->VJUMLAHRUTIN;
				if($VJUMLAHRUTIN > 0)
				{
					$data['data2'] = $this->m_batch->showdataRutinLebih($id_cek);	
				}
				
			}
		$data['data3'] = $this->m_batch->showCekSelisih($id_cek);
		$data['data4'] = $this->m_batch->showdetailRekap($id_cek);	
		$data['data5'] = $this->m_batch->showjumlahSIPKD($id_cek);
		$data['data6'] = $this->m_batch->cekVerror($id_cek);
		$data['data7'] = $this->m_batch->getwaktuAkhir($id_cek);
		//echo $respone;
		$return = array('respone' => $respone,'laporan' =>$data );
		echo json_encode($return);
	}
	

	
}