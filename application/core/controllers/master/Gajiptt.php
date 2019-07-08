<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Gajiptt extends CI_Controller {

	private $user=array();

	public function __construct()
   	{
    	parent::__construct();
    	$this->load->helper('url');
    	$this->load->library('session');
    	$this->load->model('master/v_gajiptt');

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
		$this->load->view('master/pers_gaji_ptt_grid.php');
		$this->load->view('head/footer');		
	}	

	public function data()
	{		
		$requestData = $this->input->post();	

		$columns = array( 
		// datatable column index  => database column name
			0 => 'NPTT',
			1 => 'THBL',
			2 => 'NAMA',
			3 => 'KODEPDIDIK',
			4 => 'KLOGAD',
			5 => 'KEAHLIAN',
			6 => 'GAJI',
			7 => 'TUNJANGAN',
			8 => 'GAJIKOTOR',
			9 => 'PPH',
			10 => 'GAJIBERSIH',
			11 => 'TGLLAHIR',
			12 => 'SPMU'

		);

		// getting total number records without any search
		$sql = "SELECT rownum, X.* FROM (SELECT rownum as rn, nptt, thbl, nama, kodepdidik, klogad, keahlian, gaji, tunjangan, gajikotor, pph, gajibersih, tgllahir,spmu";
		$sql .= " FROM pers_gaji_ptt) X";		
		$query = $this->db->query($sql);
		$totalData = $query->num_rows();
		$totalFiltered = $totalData;  // when there is no search parameter then total number rows = total number filtered rows.

		$sql = "SELECT rownum, X.* FROM (SELECT rownum as rn, nptt, thbl, nama, kodepdidik, klogad, keahlian, gaji, tunjangan, gajikotor, pph, gajibersih, tgllahir,spmu";
		$sql .= " FROM pers_gaji_ptt) X";

		$sql .= " WHERE 1 = 1";

		// getting records as per search parameters
		if( !empty($requestData['columns'][0]['search']['value']) ){   //kode nptt
			$sql.=" AND lower(nptt) LIKE lower('%".$requestData['columns'][0]['search']['value']."%') ";
		}
		if( !empty($requestData['columns'][1]['search']['value']) ){   //kode thbl
			$sql.=" AND lower(thbl) LIKE lower('%".$requestData['columns'][1]['search']['value']."%') ";
		}
		if( !empty($requestData['columns'][2]['search']['value']) ){   //nama
			$sql.=" AND lower(nama) LIKE lower('%".$requestData['columns'][2]['search']['value']."%') ";
		}
		if( !empty($requestData['columns'][3]['search']['value']) ){   //kode pendidik
			$sql.=" AND lower(kodepdidik) LIKE lower('%".$requestData['columns'][3]['search']['value']."%') ";
		}
		if( !empty($requestData['columns'][4]['search']['value']) ){   //klogad
			$sql.=" AND lower(klogad) LIKE lower('%".$requestData['columns'][4]['search']['value']."%') ";
		}
		if( !empty($requestData['columns'][5]['search']['value']) ){   //keahlian
			$sql.=" AND lower(keahlian) LIKE lower('%".$requestData['columns'][5]['search']['value']."%') ";
		}
		if( !empty($requestData['columns'][6]['search']['value']) ){   //gaji
			$sql.=" AND lower(gaji) LIKE lower('%".$requestData['columns'][6]['search']['value']."%') ";
		}
		if( !empty($requestData['columns'][7]['search']['value']) ){   //tunjangan
			$sql.=" AND lower(tunjangan) LIKE lower('%".$requestData['columns'][7]['search']['value']."%') ";
		}
		if( !empty($requestData['columns'][8]['search']['value']) ){   //gajikotor
			$sql.=" AND lower(gajikotor) LIKE lower('%".$requestData['columns'][8]['search']['value']."%') ";
		}
		if( !empty($requestData['columns'][9]['search']['value']) ){   //pph
			$sql.=" AND lower(pph) LIKE lower('%".$requestData['columns'][9]['search']['value']."%') ";
		}
		if( !empty($requestData['columns'][10]['search']['value']) ){   //gajibersih
			$sql.=" AND lower(gajibersih) LIKE lower('%".$requestData['columns'][10]['search']['value']."%') ";
		}
		if( !empty($requestData['columns'][11]['search']['value']) ){   //tgllahir
			$sql.=" AND lower(tgllahir) LIKE lower('%".$requestData['columns'][11]['search']['value']."%') ";
		}
		if( !empty($requestData['columns'][12]['search']['value']) ){   //spmu
			$sql.=" AND lower(spmu) LIKE lower('%".$requestData['columns'][12]['search']['value']."%') ";
		}		

		
		$query= $this->db->query($sql);
		$totalFiltered = $query->num_rows();	
		
		$sql.=" AND RN > ".$requestData['start']." AND  ROWNUM <= ".$requestData['length'].""; 
		$sql.=" ORDER BY ". $columns[$requestData['order'][0]['column']]."   ".$requestData['order'][0]['dir']." ";  // adding length
		
		$query= $this->db->query($sql);
		
		$data = array();		

		foreach($query->result() as $row){
			$nestedData=array(); 

			$nestedData[] = $row->NPTT;
			$nestedData[] = $row->THBL;
			$nestedData[] = $row->NAMA;
			$nestedData[] = $row->KODEPDIDIK;
			$nestedData[] = $row->KLOGAD;
			$nestedData[] = $row->KEAHLIAN;
			$nestedData[] = $row->GAJI;
			$nestedData[] = $row->TUNJANGAN;
			$nestedData[] = $row->GAJIKOTOR;
			$nestedData[] = $row->PPH;
			$nestedData[] = $row->GAJIBERSIH;
			$nestedData[] = $row->TGLLAHIR;
			$nestedData[] = $row->SPMU;			
			$nestedData[] = "<div class='form-group'>
								<div class='col-sm-12'>	
									<div class='row'>
										<div class='col-sm-4'>	
											<form method='post' action='".base_url()."/index.php/master/gajiptt/doedit'>
												<input type='hidden' name='nptt' id='nptt' value='".$row->NPTT."'>
												<input type='hidden' name='thbl' id='thbl' value='".$row->THBL."'>
												<button class='btn btn-success btn-xs' type='submit' pull-right>edit</button>								
											</form>
										</div>
										<div class='col-sm-4'>	
											<button class='btn btn-danger btn-xs' 
											onClick=hapusData('".$row->NPTT."','".$row->THBL."','".base_url()."/index.php/master/gajiptt/dohapusaction') >hapus</button>
										</div>										
									</div>
								</div>
							</div>
							";			
			
			$data[] = $nestedData;
		}	

		$json_data = array(
					"draw"            => intval( $requestData['draw'] ),   
					"recordsTotal"    => intval( $totalData ),  
					"recordsFiltered" => intval( $totalFiltered ), 
					"data"            => $data   
					);

		echo json_encode($json_data);  
	}

	public function doadd()
	{			
		$data['aksi'] = 'add';
		$data['linkaction'] = base_url().'index.php/master/gajiptt/doaddaction';
		
            $session_data       = $this->session->userdata('logged_in');
            $this->user['id']     	= $session_data['id'];
            $this->user['username']  	= $session_data['username'];   

			$this->load->view('head/header',$this->user);
			$this->load->view('head/menu');
			$this->load->view('master/pers_gaji_ptt_form.php',$data);
			$this->load->view('head/footer');		
	}

	public function doaddaction(){
		$data = $this->input->post();
		
		$hsl = $this->v_agama->insertData($data);	

		$linkback = base_url().'index.php/master/gajiptt/';
		$a = array('response' => 'SUKSES', 'hasil' => $hsl, 'linkback' => $linkback);
		echo json_encode($a);
	}

	public function doedit($id='')
	{	

		$data['aksi'] = 'edit';
		if($this->input->post('nptt')){
			$id = $this->input->post('nptt');
			$id2 = $this->input->post('thbl');
		}else{
			return $this->index();
		}

		$listdata = $this->v_gajiptt->get_data($id,$id2)->row();
		$count = count($listdata);
		$data['count'] = $count;
		if($count){
			foreach ($listdata as $key => $value) {
			
				$data[$key] = $value;
			
			}
		}
		
		$data['linkaction'] = base_url().'index.php/master/gajiptt/doeditaction';
		

            $session_data       = $this->session->userdata('logged_in');
            $user['id']     	= $session_data['id'];
            $user['username']  	= $session_data['username'];   

			$this->load->view('head/header',$this->user);
			$this->load->view('head/menu');
			$this->load->view('master/pers_gaji_ptt_form.php',$data);
			$this->load->view('head/footer');	
	
	}

	public function doeditaction(){
		$data = $this->input->post();
		
		$hsl = $this->v_gajiptt->updateData($data);	

		$linkback = base_url().'index.php/master/gajiptt/';
		$a = array('response' => 'SUKSES', 'hasil' => $hsl, 'linkback' => $linkback);
		echo json_encode($a);
	}

	public function dohapusaction($id='')
	{	

		if($this->input->post('id')){
			$id = $this->input->post('id');
		}else{
			return $this->index();
		}

		$hsl = $this->v_gajiptt->hapusData($id);
		
		$linkback = base_url().'index.php/master/gajiptt/';
		if($hsl){
			$a = array('response' => 'SUKSES', 'hasil' => $hsl, 'linkback' => $linkback);
		}else{
			$a = array('response' => 'GAGAL', 'hasil' => $hsl, 'linkback' => $linkback);
		}

		echo json_encode($a);
	}
		
}
