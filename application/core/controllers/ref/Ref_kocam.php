<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ref_kocam extends CI_Controller {

	private $user=array();

	public function __construct()
   	{
    	parent::__construct();
    	$this->load->helper('url');
    	$this->load->library('session');
    	$this->load->model('ref/v_ref_kocam','rcm');

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
			$skowil = $this->rcm->getListKowil();
			$data = array(
			'skowil' => $skowil
			);

			$this->load->view('head/header', $this->user);
			$this->load->view('head/menu');
			$this->load->view('ref/ref_kocam_grid.php',$data);
			$this->load->view('head/footer');		
	}	



	public function data()
	{		
		$requestData = $this->input->post();	
		//$kolok=$requestData['KOLOK'];

		$columns = array(
		// datatable column index  => database column name
			
			0 => 'ROWNUM',
			1 => 'KOCAM',
			2 => 'NACAM',
			3 => 'USER_ID',
			4 => 'TERM',
			5 => 'TG_UPD',		
			
		);
		
			$wh_kowil = " AND PERS_KOCAM_TBL.KOWIL='' ";
		//$wh_kolok = "";
		if( !empty($requestData['KOWIL']) ){
			$wh_kowil = " AND lower(PERS_KOCAM_TBL.KOWIL) LIKE lower('%".$requestData['KOWIL']."%') ";
		}

		$sql = "SELECT rownum, x.* FROM (SELECT rownum as rn,
				kocam,nacam,user_id,term,tg_upd";
		$sql .= " FROM PERS_KOCAM_TBL 
				  WHERE (
				  			1=1
				  			$wh_kowil
				  		)
				ORDER BY KOCAM
				) X";	
		//ECHO $sql;
		$query= $this->db->query($sql);
		
		$data = array();		

		foreach($query->result() as $row){
			$nestedData=array(); 

			$nestedData[] = $row->ROWNUM;;
			$nestedData[] = $row->KOCAM;
			$nestedData[] = $row->NACAM;
			$nestedData[] = $row->USER_ID;
			$nestedData[] = $row->TERM;
			$nestedData[] = $row->TG_UPD;							
			
			$data[] = $nestedData;
			
		}	

		$json_data = array( 
					"data"            => $data   
					);

		echo json_encode($json_data);  
	}

	
}
