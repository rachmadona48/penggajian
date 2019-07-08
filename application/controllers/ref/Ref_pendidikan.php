<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ref_pendidikan extends CI_Controller {

	private $user=array();

	public function __construct()
   	{
    	parent::__construct();
    	$this->load->helper('url');
    	$this->load->library('session');
    	$this->load->model('ref/v_ref_pendidikan','rpd');

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
			$sjendik = $this->rpd->getListJendik();
			$data = array(
			'sjendik' => $sjendik
			);

			$this->load->view('head/header', $this->user);
			$this->load->view('head/menu');
			$this->load->view('ref/ref_pendidikan_grid.php',$data);
			$this->load->view('head/footer');		
	}	



	public function data()
	{		
		$requestData = $this->input->post();	
		//$kolok=$requestData['KOLOK'];

		$columns = array(
		// datatable column index  => database column name
			
			0 => 'ROWNUM',
			1 => 'KODIK',
			2 => 'NADIK',
			3 => 'USER_ID',
			4 => 'TERM',
			5 => 'TG_UPD',
		);
		
			$wh_jendik = " AND PERS_PDIDIKAN_TBL.JENDIK='' ";
		
		if( !empty($requestData['JENDIK']) ){
			$wh_jendik = " AND lower(PERS_PDIDIKAN_TBL.JENDIK) LIKE lower('%".$requestData['JENDIK']."%') ";
		}

		$sql = "SELECT rownum, x.* FROM (SELECT rownum as rn, 
				PERS_PDIDIKAN_TBL.KODIK,
				PERS_PDIDIKAN_TBL.NADIK, 
				PERS_PDIDIKAN_TBL.USER_ID, 
				PERS_PDIDIKAN_TBL.TERM,
				PERS_PDIDIKAN_TBL.TG_UPD";
		$sql .= " FROM PERS_PDIDIKAN_TBL 
					LEFT OUTER JOIN PERS_JENDIK_RPT ON PERS_PDIDIKAN_TBL.JENDIK = PERS_JENDIK_RPT.JENDIK
					WHERE(
				  			1=1
				  			$wh_jendik
				  		)
				ORDER BY 
					PERS_PDIDIKAN_TBL.JENDIK, 
					PERS_PDIDIKAN_TBL.KODIK
				) X";	
		//echo $sql;
		$query= $this->db->query($sql);
		
		$data = array();		

		foreach($query->result() as $row){
			$nestedData=array(); 

			$nestedData[] = $row->ROWNUM;
			$nestedData[] = $row->KODIK;
			$nestedData[] = $row->NADIK;
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
