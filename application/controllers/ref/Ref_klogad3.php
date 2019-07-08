<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ref_klogad3 extends CI_Controller {

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
			$this->load->view('ref/ref_klogad3_grid.php');
			$this->load->view('head/footer');		
	}	



	public function data()
	{		
		$requestData = $this->input->post();	

		$columns = array( 
		// datatable column index  => database column name
			0 => 'kolok',
			1 => 'nalok',
			2 => 'spmu',
			3 => 'kode_unit_sipkd',
			4 => 'tahun',
			5 => 'aktif',			
		);

		// getting total number records without any search
		$sql = "SELECT rownum, x.* FROM (SELECT rownum as rn, kolok, nalok, spmu, kode_unit_sipkd, tahun,aktif";
		$sql .= " FROM pers_klogad3
				WHERE (0=0)) X";		
		
		$query= $this->db->query($sql);
		
		$data = array();		

		foreach($query->result() as $row){
			$nestedData=array(); 

			$nestedData[] = $row->ROWNUM;
			$nestedData[] = $row->KOLOK;
			$nestedData[] = $row->NALOK;
			$nestedData[] = $row->SPMU;			
			$nestedData[] = $row->KODE_UNIT_SIPKD;
			$nestedData[] = $row->TAHUN;
			$nestedData[] = $row->AKTIF;							
			
			$data[] = $nestedData;
			
		}	

		$json_data = array(
					"data" => $data   
					);

		echo json_encode($json_data);  
	}
}
