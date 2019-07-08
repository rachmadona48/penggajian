<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ref_lokker extends CI_Controller {

	private $user=array();

	public function __construct()
   	{
    	parent::__construct();
    	$this->load->helper('url');
    	$this->load->library('session');
    	

    	if ($this->session->userdata('logged_in')) {            

            $session_data       = $this->session->userdata('logged_in');
            $this->user['id']     	= $session_data['id'];
            $this->user['username']  	= $session_data['username'];
        }else{
			redirect(base_url().'index.php/login', 'refresh');
		}	    
   	}

	public function index()
	{	
			$this->load->view('head/header', $this->user);
			$this->load->view('head/menu');
			$this->load->view('ref/ref_lokker_grid.php');
			$this->load->view('head/footer');		
	}	



	public function data()
	{		
		$requestData = $this->input->post();	

		$columns = array( 
		// datatable column index  => database column name
			0 => 'kolok',
			1 => 'naloks',
			2 => 'nalokl',
			3 => 'koras',
			4 => 'makan_ins',
			5 => 'tahun',
			6 => 'aktif',
			7 => 'kode_unit_sipkd',
			8 => 'user_id',
			9 => 'term',
			10 => 'tg_upd',		
		);

		// getting total number records without any search
		$sql = "SELECT rownum, x.* FROM (SELECT rownum as kolok, naloks, nalokl, koras, makan_ins, user_id, term, tg_upd,tahun, aktif , kode_unit_sipkd";
		$sql .= " FROM pers_lokasi_tbl
				WHERE (0=0)) X";		
		
		$query= $this->db->query($sql);
		
		$data = array();		

		foreach($query->result() as $row){
			$nestedData=array(); 

			$nestedData[] = $row->ROWNUM;
			$nestedData[] = $row->KOLOK;
			$nestedData[] = $row->NALOKS;
			$nestedData[] = $row->NALOKL;
			$nestedData[] = $row->KORAS;
			$nestedData[] = $row->MAKAN_INS;
			$nestedData[] = $row->TAHUN;
			$nestedData[] = $row->AKTIF;
			$nestedData[] = $row->KODE_UNIT_SIPKD;
			$nestedData[] = $row->USER_ID;
			$nestedData[] = $row->TERM;
			$nestedData[] = $row->TG_UPD;							
			
			$data[] = $nestedData;
			
		}	

		$json_data = array(
					"data" => $data   
					);

		echo json_encode($json_data);  
	}
}
