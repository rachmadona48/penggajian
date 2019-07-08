<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Datapokok extends CI_Controller {

	private $user=array();
	public function __construct()
   	{
    	parent::__construct();
    	$this->load->helper('url');
    	$this->load->library('session');
    	$this->load->library('infopegawai');
    	$this->load->model('hist/v_datapokok','mdl');

    	if ($this->session->userdata('logged_in')) {            

            $session_data       = $this->session->userdata('logged_in');
            $this->user['id']     	= $session_data['id'];
            $this->user['username']  	= $session_data['username'];
			$this->user['user_group']     = $session_data['user_group'];
		}else{
			redirect(base_url().'index.php/login', 'refresh');
		}	
   	}

	public function index()
	{
		$tgl_sekarang = date("Y-m-d");
		$tgl = date('Y-m-d', strtotime($tgl_sekarang));
		$tglproses = date('Y-m-d', strtotime($tgl_sekarang));
		// $koloks = $this->mdl->getKolok();
		$spmu = $this->infopegawai->getMasterSPM();
		//var_dump($koloks);
		
		// START GET NRK                
	        if(isset($_POST['nrk'])){
	            $nrk = $_POST['nrk'];
	        }elseif(isset($_POST['nrkP'])){ //Pencarian NRK Untuk Admin/BKD
	            $nrk = $_POST['nrkP'];                    
	        }else{
	            $nrk = $this->user['id'];
	            
	            if($this->user['user_group'] > 1){
	                $nrk = "";
	            }
	        }                                            
	    // END GET NRK

	    // START Inisial Active Menu
        $datam['activeMenu'] = "296";
        $datam['activemn']=$this->infopegawai->initialMenu($this->user['user_group'],'datapokok',0);
        // END Inisial Active Menu


		$data = array(
			'tgl' => $tgl,
			'tglproses' => $tglproses,
			'spmu' => $spmu,
			'nrk' => $nrk
		);

		$datam['nrk'] = $nrk;
		$datam['user_group'] = $this->user['user_group'];

		$this->load->view('head/header',$this->user);
		$this->load->view('head/menu',$datam);
		$this->load->view('hist/datapokok_grid.php',$data);
		$this->load->view('head/footer');
	}

	public function data()
	{
		$requestData = $this->input->post();

		$columns = array(
			// datatable column index  => database column name
			0 => 'ROWNUM',
			1 => 'NRK',
			2 => 'NAMA',
			3 => 'NAJABL',
			4 => 'PATHIR',
			5 => 'TALHIR',
		);

		// getting records as per search parameters
		$wh_spmu = " AND pers_duk_pangkat_histduk.spmu='' ";
		//$wh_spmu = "";
		if( !empty($requestData['spmu']) ){
			$wh_spmu = " AND lower(pers_duk_pangkat_histduk.spmu) LIKE lower('%".$requestData['spmu']."%') ";
		}

		//$wh_thbl = "AND pers_duk_pangkat_histduk.thbl = '201508'";
		$wh_thbl =" AND pers_duk_pangkat_histduk.thbl = '' ";
		if( !empty($requestData['tglpilih']) ){
			$time = strtotime($requestData['tglpilih']);
			$thbl = date('Ym',$time);
			$wh_thbl = " AND pers_duk_pangkat_histduk.thbl = '".$thbl."' ";
		}

		$sql = "SELECT rownum, X.* FROM (SELECT rownum as rn,
				pers_kojab_tbl.najabl, pers_duk_pangkat_histduk.nrk, pers_duk_pangkat_histduk.nama,
                      pers_duk_pangkat_histduk.pathir, pers_duk_pangkat_histduk.talhir, pers_duk_pangkat_histduk.eselon,
                      pers_duk_pangkat_histduk.kopang ";
		$sql .= " FROM pers_duk_pangkat_histduk LEFT OUTER JOIN
							  pers_kojab_tbl ON pers_duk_pangkat_histduk.kolok = pers_kojab_tbl.kolok AND
							  pers_duk_pangkat_histduk.kojab = pers_kojab_tbl.kojab
                  WHERE
						(
							1=1
							$wh_spmu
							$wh_thbl
						)
					ORDER BY
						pers_duk_pangkat_histduk.klogad,
						pers_duk_pangkat_histduk.kojab,
						pers_duk_pangkat_histduk.eselon,
						pers_duk_pangkat_histduk.kopang,
						pers_duk_pangkat_histduk.thbl
				) X";
		//echo $sql;
		$query= $this->db->query($sql);

		$data = array();
		foreach($query->result() as $row){
			$nestedData=array();
			$nestedData[] = $row->ROWNUM;
			$nestedData[] = $row->NRK;
			$nestedData[] = $row->NAMA;
			$nestedData[] = $row->NAJABL;
			$nestedData[] = $row->PATHIR;
			$nestedData[] = $row->TALHIR;
			$nestedData[] = '<form method="POST" action="'.base_url().'index.php/home" id="form_'.$row->NRK.'">
								<input type="hidden" name="nrk" value="'.$row->NRK.'" id="nrk_'.$row->NRK.'">
								<input type="hidden" name="thbl" value="'.$requestData['tglpilih'].'" id="thbl_'.$row->NRK.'">
								<input type="hidden" name="spmu" value="'.$requestData['spmu'].'" id="spmu_'.$row->NRK.'">
								<input type="hidden" name="datapokok" value="datapokok" id="datapokok">
							</form>							
							<a data-toggle="tooltip" data-placement="left" title="Lihat Profile '.$row->NAMA.'" onclick="getProfile(\''.$row->NRK.'\')"><i class="fa fa-folder-open"> </i></a>
							';

			$data[] = $nestedData;
		}

		$json_data = array(
			"data"            => $data
		);

		echo json_encode($json_data);
	}

}
		

