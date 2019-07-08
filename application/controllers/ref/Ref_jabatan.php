<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ref_jabatan extends CI_Controller {

	private $user=array();

	public function __construct()
   	{
    	parent::__construct();
    	$this->load->helper('url');
    	$this->load->library('session');
    	$this->load->model('ref/v_ref_jabatan','rjb');

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
			$skolok = $this->rjb->getListKolok();
			$data = array(
			'skolok' => $skolok
			);

			$this->load->view('head/header', $this->user);
			$this->load->view('head/menu');
			$this->load->view('ref/ref_jabatan_grid.php',$data);
			$this->load->view('head/footer');		
	}	



	public function data()
	{		
		$requestData = $this->input->post();	
		//$kolok=$requestData['KOLOK'];

		$columns = array(
		// datatable column index  => database column name
			
			0 => 'ROWNUM',
			1 => 'NAJABS',
			2 => 'NAJABL',
			3 => 'ESELON',
			4 => 'PERINGKAT',
			5 => 'KOLOK_SEKTORAL',		
			6 => 'TUNJAB',
			7 => 'TRANSPORT',
			8 => 'JOB_CLASS1',
			9 => 'JOB_CLASS2',
			10 => 'POINT',
			11 => 'POINT_207',
			12 => 'TAHAP1',
			13 => 'TAHAP2',
			14 => 'TAHUN',
			15 => 'AKTIF',
			16 => 'USER_ID',
			17 => 'TERM',
			18 => 'TG_UPD',
		);
		
			$wh_kolok = " AND PERS_KOJAB_TBL.KOLOK='' ";
		//$wh_kolok = "";
		if( !empty($requestData['KOLOK']) ){
			$wh_kolok = " AND lower(PERS_KOJAB_TBL.KOLOK) LIKE lower('%".$requestData['KOLOK']."%') ";
		}

		$sql = "SELECT rownum, x.* FROM (SELECT rownum as rn,
				PERS_KOJAB_TBL.NAJABS, 
				PERS_KOJAB_TBL.NAJABL, 
				PERS_ESELON_TBL.NESELON AS NAMA_ESELON, 
				PERS_KOJAB_TBL.PERINGKAT, 
				PERS_KOJAB_TBL.KOLOK_SEKTORAL,
				PERS_KOJAB_TBL.TUNJAB, 
				PERS_KOJAB_TBL.TRANSPORT, 
				PERS_KOJAB_TBL.JOB_CLASS1, 
				PERS_KOJAB_TBL.JOB_CLASS2, 
				PERS_KOJAB_TBL.POINT, 
				PERS_KOJAB_TBL.POINT_207,
				PERS_KOJAB_TBL.TAHAP1,
				PERS_KOJAB_TBL.TAHAP2,
				PERS_KOJAB_TBL.TAHUN, 
				PERS_KOJAB_TBL.AKTIF,
				PERS_KOJAB_TBL.USER_ID,
				PERS_KOJAB_TBL.TERM,
				PERS_KOJAB_TBL.TG_UPD";
		$sql .= " FROM PERS_KOJAB_TBL 
					LEFT JOIN PERS_LOKASI_TBL ON PERS_KOJAB_TBL.KOLOK = PERS_LOKASI_TBL.KOLOK
					LEFT JOIN PERS_ESELON_TBL ON PERS_KOJAB_TBL.ESELON = PERS_ESELON_TBL.ESELON
				  WHERE (
				  			1=1
				  			$wh_kolok
				  		)
				ORDER BY PERS_KOJAB_TBL.KOLOK, 
						 PERS_KOJAB_TBL.KOJAB, 
						 PERS_KOJAB_TBL.ESELON
				) X";	
		//ECHO $sql;
		$query= $this->db->query($sql);
		
		$data = array();		

		foreach($query->result() as $row){
			$nestedData=array(); 

			$nestedData[] = $row->ROWNUM;;
			$nestedData[] = $row->NAJABS;
			$nestedData[] = $row->NAJABL;
			$nestedData[] = $row->NAMA_ESELON;
			$nestedData[] = $row->PERINGKAT;
			$nestedData[] = $row->KOLOK_SEKTORAL;
			$nestedData[] = $row->TUNJAB;
			$nestedData[] = $row->TRANSPORT;
			$nestedData[] = $row->JOB_CLASS1;
			$nestedData[] = $row->JOB_CLASS2;
			$nestedData[] = $row->POINT;
			$nestedData[] = $row->POINT_207;
			$nestedData[] = $row->TAHAP1;
			$nestedData[] = $row->TAHAP2;
			$nestedData[] = $row->TAHUN;
			$nestedData[] = $row->AKTIF;
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
