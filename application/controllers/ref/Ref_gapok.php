<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ref_gapok extends CI_Controller {

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
			$this->load->view('ref/ref_gapok_grid.php');
			$this->load->view('head/footer');		
	}	



	public function data()
	{		
		$requestData = $this->input->post();	

		$columns = array( 
		// datatable column index  => database column name
			0 => 'kopang',
			1 => 'gol',
			2 => 'napang',
			3 => 'ttmasker',
			4 => 'bbmasker',
			5 => 'gapok',
			6 => 'user_id',	
			7 => 'term',
			8 => 'tg_upd',						
		);

		// getting total number records without any search
		$sql = "SELECT rownum, x.* FROM (SELECT rownum as rn, 
				PERS_GAPOK_TBL.KOPANG,
				PERS_PANGKAT_TBL.GOL, 
				PERS_PANGKAT_TBL.NAPANG, 
				PERS_GAPOK_TBL.TTMASKER, 
                PERS_GAPOK_TBL.BBMASKER, 
                PERS_GAPOK_TBL.GAPOK, 
                PERS_GAPOK_TBL.USER_ID, 
                PERS_GAPOK_TBL.TERM, 
                PERS_GAPOK_TBL.TG_UPD";
		$sql .= " FROM PERS_GAPOK_TBL 
				  INNER JOIN PERS_PANGKAT_TBL ON PERS_GAPOK_TBL.KOPANG = PERS_PANGKAT_TBL.KOPANG 
				  WHERE (0=0)
				  ORDER BY 
				  PERS_GAPOK_TBL.GAPOK,
				  PERS_GAPOK_TBL.TTMASKER) X";		
		
		$query= $this->db->query($sql);
		
		$data = array();		

		foreach($query->result() as $row){
			$nestedData=array(); 

			$gapok=$row->GAPOK;
			$rupiah=number_format($gapok,0,',','.');

			$nestedData[] = $row->ROWNUM;
			$nestedData[] = $row->KOPANG;
			$nestedData[] = $row->GOL;
			$nestedData[] = $row->NAPANG;			
			$nestedData[] = $row->TTMASKER;
			$nestedData[] = $row->BBMASKER;
			$nestedData[] = $rupiah;			
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
