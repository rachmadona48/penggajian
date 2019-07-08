
<?php
defined('BASEPATH') OR exit('No direct script access allowed');
header("Cache-Control: no-cache, must-revalidate");
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");

class DetPegawai extends CI_Controller {
	private $ci;
	public function __construct()
	{
		 /*header('Access-Control-Allow-Origin: http://10.15.32.31');
    header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");*/
		parent::__construct();
		$this->load->helper('url');
		$this->load->library('session');
		$this->load->library('infopegawai');
		$this->load->model('mdetpegawai','mdl');
		
		
		$this->ci =& get_instance();
        //$this->db = $this->ci->load->database('29', TRUE);

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

	public function index($jenis,$thblpr,$gol,$skpdpr=null,$ukpdpr=null)
	{

		

		$tgl_sekarang = date("Y-m-d");
	
		//$koloks = $this->mdl->getKolok();
		
	

		//$hak_akses = $this->infopegawai->hakAksesModul('394',$this->user['user_group']);
		$data = array(
			'jenisparam' =>$jenis,
			'thblparam' => $thblpr,
			'golparam' => $gol,
			'skpdparam' => $skpdpr,
			'ukpdparam' => $ukpdpr,
			'param_cari'=> $this->user['param_cari'],
		
			);

		


		$datam['activemn'] = '';
		$datam['inisial'] = 'pegawai';

		$this->load->view('head/header',$this->user);
		$this->load->view('head/menu',$datam);
		$this->load->view('admin/detpegawai_grid.php',$data);
		$this->load->view('head/footer');
	}

	public function index2($jenis,$thblpr,$gol,$idwh,$skpdpr=null,$ukpdpr=null)
	{

		

		$tgl_sekarang = date("Y-m-d");
	
		//$koloks = $this->mdl->getKolok();
		
	

		//$hak_akses = $this->infopegawai->hakAksesModul('394',$this->user['user_group']);
		$data = array(
			'jenisparam' =>$jenis,
			'thblparam' => $thblpr,
			'golparam' => $gol,
			'idwh' => $idwh,
			'skpdparam' => $skpdpr,
			'ukpdparam' => $ukpdpr,
			'param_cari'=> $this->user['param_cari'],
		
			);

		


		$datam['activemn'] = '';
		$datam['inisial'] = 'pegawai';

		$this->load->view('head/header',$this->user);
		$this->load->view('head/menu',$datam);
		$this->load->view('admin/detpegawai_grid.php',$data);
		$this->load->view('head/footer');
	}


	public function index3($jenis,$thblpr,$gol,$idwh,$stapeg,$skpdpr=null,$ukpdpr=null)
	{

		

		$tgl_sekarang = date("Y-m-d");
	
		//$koloks = $this->mdl->getKolok();
		
	

		//$hak_akses = $this->infopegawai->hakAksesModul('394',$this->user['user_group']);
		$data = array(
			'jenisparam' =>$jenis,
			'thblparam' => $thblpr,
			'golparam' => $gol,
			'idwh' => $idwh,
			'stapeg' => $stapeg,
			'skpdparam' => $skpdpr,
			'ukpdparam' => $ukpdpr,
			'param_cari'=> $this->user['param_cari'],
		
			);

		


		$datam['activemn'] = '';
		$datam['inisial'] = 'pegawai';

		$this->load->view('head/header',$this->user);
		$this->load->view('head/menu',$datam);
		$this->load->view('admin/detpegawai_grid.php',$data);
		$this->load->view('head/footer');
	}

	public function index4($jenis,$thblpr,$thpns,$skpdpr=null,$ukpdpr=null)
	{

		

		$tgl_sekarang = date("Y-m-d");
	
		//$koloks = $this->mdl->getKolok();
		
	

		//$hak_akses = $this->infopegawai->hakAksesModul('394',$this->user['user_group']);
		$data = array(
			'jenisparam' =>$jenis,
			'thblparam' => $thblpr,
			'thpns' => $thpns,
			'skpdparam' => $skpdpr,
			'ukpdparam' => $ukpdpr,
			'param_cari'=> $this->user['param_cari'],
		
			);

		


		$datam['activemn'] = '';
		$datam['inisial'] = 'pegawai';

		$this->load->view('head/header',$this->user);
		$this->load->view('head/menu',$datam);
		$this->load->view('admin/detpegawai_grid.php',$data);
		$this->load->view('head/footer');
	}
	

	public function data()
	{

		
		$requestData = $this->input->post();
		
		$jenisparam = $requestData['jenisparam'];
		$thblparam = $requestData['thblparam'];
		$golparam = $requestData['golparam'];
		$skpdparam = $requestData['skpdparam'];
		$ukpdparam = $requestData['ukpdparam'];
		$idwh = $requestData['idwh'];
		$thpns = $requestData['thpns'];
		$stapeg = $requestData['stapeg'];
		
		$golasli = $golparam +1;

		$whprm="";
		if($skpdparam != "")
		{
			if($ukpdparam == "")
			{
				$whprm = " AND SPMU = '$skpdparam' ";
			}
			else
			{
				$whprm =" AND SPMU = '$skpdparam' AND KLOGAD = '$ukpdparam' ";
			}
		}
		else
		{
			$whprm = " AND 5=5 ";
		}

		$whkond="";

		if($jenisparam == 1)
		{

			if($stapeg == 1)
			{
				if($idwh == 1)
				{
					$whkond = " AND JENKEL='L' AND STAPEG=1 ";
				}
				else if($idwh == 2)
				{
					$whkond = " AND JENKEL='P' AND STAPEG=1 ";
				}
				else
				{
					$whkond = " AND 6=7 ";
				}
			}
			else if($stapeg == 2)
			{
				if($idwh == 1)
				{
					$whkond = " AND JENKEL='L' AND STAPEG=2 ";
				}
				else if($idwh == 2)
				{
					$whkond = " AND JENKEL='P' AND STAPEG=2 ";
				}
				else
				{
					$whkond = " AND 6=7 ";
				}	
			}
			else
			{
				$whkond = " AND 6=7 ";
			}
			
		}
		else if($jenisparam == 2)
		{
			if($idwh=='99')
			{
				$whkond=" AND (ESELON = '00' OR ESELON = ' ') ";
			}
			else
			{
				$whkond=" AND ESELON = '$idwh' ";	
			}
			
		}
		else if($jenisparam == 3)
		{
			if($idwh == 1)
			{
				$whkond=" AND UMUR<25 ";
			}
			else if($idwh == 2)
			{
				$whkond=" AND (UMUR >= 25 AND UMUR < 30) ";
			}
			else if($idwh == 3)
			{
				$whkond=" AND (UMUR >= 30 AND UMUR < 36) ";
			}
			else if($idwh == 4)
			{
				$whkond=" AND (UMUR >= 36 AND UMUR < 42) ";
			}
			else if($idwh == 5)
			{
				$whkond=" AND (UMUR >= 42 AND UMUR < 48) ";
			}
			else if($idwh == 6)
			{
				$whkond=" AND (UMUR >= 48 AND UMUR <= 55) ";
			}
			else if($idwh == 7)
			{
				$whkond=" AND UMUR > 55 ";
			}
			else
			{
				$whkond=" AND 7=7 ";
			}
		}
		else if($jenisparam == 4)
		{
			$whkond=" AND 8=8 ";
		}
		else if($jenisparam == 5)
		{
			if($stapeg == '1')
			{
				if($idwh == 1)
				{
					$whkond=" AND JENDIK = '1' AND STAPEG = '1' AND KODIK = '0000' ";
				}
				else if($idwh == 2)
				{
					$whkond=" AND JENDIK = '1' AND STAPEG = '1' AND KODIK LIKE '1%' ";
				}
				else if($idwh == 3)
				{
					$whkond=" AND JENDIK = '1' AND STAPEG = '1' AND KODIK LIKE '2%' ";
				}
				else if($idwh == 4)
				{
					$whkond=" AND JENDIK = '1' AND STAPEG = '1' AND KODIK LIKE '3%' ";
				}
				else if($idwh == 5)
				{
					$whkond=" AND  JENDIK = '1' AND STAPEG = '1' AND KODIK LIKE '40%' ";
				}
				else if($idwh == 6)
				{
					$whkond=" AND JENDIK = '1' AND STAPEG = '1' AND ( KODIK LIKE '45%' OR KODIK LIKE '46%' OR KODIK LIKE '47%') ";
				}
				else if($idwh == 7)
				{
					$whkond=" AND JENDIK = '1' AND STAPEG = '1' AND KODIK LIKE '5%' ";
				}
				else if($idwh == 8)
				{
					$whkond=" AND JENDIK = '1' AND STAPEG = '1' AND (KODIK LIKE '6%' OR KODIK LIKE '7%') ";
				}
				else if($idwh == 9)
				{
					$whkond=" AND JENDIK = '1' AND STAPEG = '1' AND KODIK LIKE '8%' ";
				}
				else if($idwh == 10)
				{
					$whkond=" JENDIK = '1' AND STAPEG = '1' AND KODIK LIKE '9%' ";
				}
				else
				{
					$whkond=" AND 8=7 ";
				}
			}
			else if($stapeg == '2')
			{
				if($idwh == 1)
				{
					$whkond=" AND JENDIK = '1' AND STAPEG = '2' AND KODIK = '0000' ";
				}
				else if($idwh == 2)
				{
					$whkond=" AND JENDIK = '1' AND STAPEG = '2' AND KODIK LIKE '1%' ";
				}
				else if($idwh == 3)
				{
					$whkond=" AND JENDIK = '1' AND STAPEG = '2' AND KODIK LIKE '2%' ";
				}
				else if($idwh == 4)
				{
					$whkond=" AND JENDIK = '1' AND STAPEG = '2' AND KODIK LIKE '3%' ";
				}
				else if($idwh == 5)
				{
					$whkond=" AND  JENDIK = '1' AND STAPEG = '2' AND KODIK LIKE '40%' ";
				}
				else if($idwh == 6)
				{
					$whkond=" AND JENDIK = '1' AND STAPEG = '2' AND ( KODIK LIKE '45%' OR KODIK LIKE '46%' OR KODIK LIKE '47%') ";
				}
				else if($idwh == 7)
				{
					$whkond=" AND JENDIK = '1' AND STAPEG = '2' AND KODIK LIKE '5%' ";
				}
				else if($idwh == 8)
				{
					$whkond=" AND JENDIK = '1' AND STAPEG = '2' AND (KODIK LIKE '6%' OR KODIK LIKE '7%') ";
				}
				else if($idwh == 9)
				{
					$whkond=" AND JENDIK = '1' AND STAPEG = '2' AND KODIK LIKE '8%' ";
				}
				else if($idwh == 10)
				{
					$whkond=" JENDIK = '1' AND STAPEG = '2' AND KODIK LIKE '9%' ";
				}
				else
				{
					$whkond=" AND 8=7 ";
				}
			}
			else
			{
				$whkond=" AND 6=7 ";
			}
			
		}
		else if($jenisparam == 6)
		{
			if($stapeg == 1)
			{
				if($idwh == 1)
				{
					$whkond=" AND STAWIN = 0 AND STAPEG = 1 ";
				}
				else if($idwh == 2)
				{
					$whkond=" AND STAWIN IN ('1', '2', '3', '4') AND STAPEG = 1 ";	
				}
				else if($idwh == 3)
				{
					$whkond=" AND STAWIN = 5 AND STAPEG = 1 ";
				}
				else if($idwh == 4)
				{
					$whkond=" AND STAWIN = 6 AND STAPEG = 1 ";
				}
				else
				{
					$whkond=" AND 6=7 ";		
				}
			}
			else if($stapeg == 2)
			{
				if($idwh == 1)
				{
					$whkond=" AND STAWIN = 0 AND STAPEG = 2 ";
				}
				else if($idwh == 2)
				{
					$whkond=" AND STAWIN IN ('1', '2', '3', '4') AND STAPEG = 2 ";	
				}
				else if($idwh == 3)
				{
					$whkond=" AND STAWIN = 5 AND STAPEG = 2 ";
				}
				else if($idwh == 4)
				{
					$whkond=" AND STAWIN = 6 AND STAPEG = 2 ";
				}
				else
				{
					$whkond=" AND 6=7 ";		
				}
			}
			else
			{
				$whkond=" AND 6=7 ";	
			}

		}
		else if($jenisparam == 7)
		{
			if($stapeg == 1)
			{
				if($idwh == 1)
				{
					$whkond = " AND SUBSTR (MASKER, 1, 2) IN ('00','01','02','03','04','05') AND STAPEG = 1 ";
				}
				else if($idwh == 2)
				{
					$whkond = " AND SUBSTR (MASKER, 1, 2) IN ('06','07','08','09','10') AND STAPEG = 1 ";
				}
				else if($idwh == 3)
				{
					$whkond = " AND SUBSTR (MASKER, 1, 2) IN ('11','12','13','14','15') AND STAPEG = 1 ";	
				}
				else if($idwh == 4)
				{
					$whkond = " AND SUBSTR (MASKER, 1, 2) IN ('16','17','18','19','20') AND STAPEG = 1 ";
				}
				else if($idwh == 5)
				{
					$whkond = " AND SUBSTR (MASKER, 1, 2) IN ('21','22','23','24','25') AND STAPEG = 1 ";
				}
				else if($idwh == 6)
				{
					$whkond = " AND SUBSTR (MASKER, 1, 2) IN ('26','27','28','29','30') AND STAPEG = 1 ";
				}
				else if($idwh == 7)
				{
					$whkond = " AND SUBSTR (MASKER, 1, 2) IN ('31','32','33','34','35') AND STAPEG = 1 ";
				}
				else if($idwh == 8)
				{
					$whkond = " AND SUBSTR (MASKER, 1, 2) > 35 AND STAPEG = 1 ";
				}
				else
				{
					$whkond=" AND 6=7 ";
				}
			}
			else if($stapeg == 2)
			{
				if($idwh == 1)
				{
					$whkond = " AND SUBSTR (MASKER, 1, 2) IN ('00','01','02','03','04','05') AND STAPEG = 2 ";
				}
				else if($idwh == 2)
				{
					$whkond = " AND SUBSTR (MASKER, 1, 2) IN ('06','07','08','09','10') AND STAPEG = 2 ";
				}
				else if($idwh == 3)
				{
					$whkond = " AND SUBSTR (MASKER, 1, 2) IN ('11','12','13','14','15') AND STAPEG = 2 ";	
				}
				else if($idwh == 4)
				{
					$whkond = " AND SUBSTR (MASKER, 1, 2) IN ('16','17','18','19','20') AND STAPEG = 2 ";
				}
				else if($idwh == 5)
				{
					$whkond = " AND SUBSTR (MASKER, 1, 2) IN ('21','22','23','24','25') AND STAPEG = 2 ";
				}
				else if($idwh == 6)
				{
					$whkond = " AND SUBSTR (MASKER, 1, 2) IN ('26','27','28','29','30') AND STAPEG = 2 ";
				}
				else if($idwh == 7)
				{
					$whkond = " AND SUBSTR (MASKER, 1, 2) IN ('31','32','33','34','35') AND STAPEG = 2 ";
				}
				else if($idwh == 8)
				{
					$whkond = " AND SUBSTR (MASKER, 1, 2) > 35 AND STAPEG = 1 ";
				}
				else
				{
					$whkond=" AND 6=7 ";
				}
			}
			else
			{
				$whkond=" AND 6=7 ";		
			}
		}
		else if($jenisparam == 8)
		{
			if($stapeg == 1)
			{
				if($idwh == 1)
				{ 
					$whkond = " AND AGAMA = 1 AND STAPEG = 1 ";
				}
				else if($idwh == 2)
				{
					$whkond = " AND AGAMA = 2 AND STAPEG = 1 ";
				}
				else if($idwh == 3)
				{
					$whkond = " AND AGAMA = 3 AND STAPEG = 1 ";
				}
				else if($idwh == 4)
				{
					$whkond = " AND AGAMA = 4 AND STAPEG = 1 ";
				}
				else if($idwh == 5)
				{
					$whkond = " AND AGAMA = 5 AND STAPEG = 1 ";
				}
				else if($idwh == 6)
				{
					$whkond = " AND AGAMA = 6 AND STAPEG = 1 ";
				}
				else
				{
					$whkond=" AND 6=7 ";
				}
			}
			else if($stapeg == 2)
			{
				if($idwh == 1)
				{ 
					$whkond = " AND AGAMA = 1 AND STAPEG = 2 ";
				}
				else if($idwh == 2)
				{
					$whkond = " AND AGAMA = 2 AND STAPEG = 2 ";
				}
				else if($idwh == 3)
				{
					$whkond = " AND AGAMA = 3 AND STAPEG = 2 ";
				}
				else if($idwh == 4)
				{
					$whkond = " AND AGAMA = 4 AND STAPEG = 2 ";
				}
				else if($idwh == 5)
				{
					$whkond = " AND AGAMA = 5 AND STAPEG = 2 ";
				}
				else if($idwh == 6)
				{
					$whkond = " AND AGAMA = 6 AND STAPEG = 2 ";
				}
				else
				{
					$whkond=" AND 6=7 ";
				}
			}
			else
			{
				$whkond=" AND 6=7 ";			
			}
		}
		else if($jenisparam == 9)
		{
			$whkond = " AND TO_CHAR(TMTPENSIUNYAD,'YYYY') = '".$thpns."'";
		}



		$columns = array(
			// datatable column index  => database column name
//			0 => 'ROWNUM',
			0 => 'NRK',
			1 => 'NIP',
			2 => 'NIP18',
			3 => 'NAMA',
			4 => 'NALOKL',
			5 => 'NAJABL',
			6 => 'NAKLOGAD',
			7 => 'GOL',
			8 => 'USER_ID'
		);

		// getting total number records without any search

		if($jenisparam !=9)
		{
			$q = "	SELECT
					COUNT(NRK) AS jml
				FROM
					PERS_DUK_PANGKAT_HISTDUK P1

				WHERE THBL = '$thblparam' AND SUBSTR(KOPANG,2,1)='$golasli' $whprm $whkond
				 ";	
		}
		else
		{
			$q = "	SELECT
					COUNT(NRK) AS jml
				FROM
					PERS_DUK_PANGKAT_HISTDUK P1

				WHERE THBL = '$thblparam'  $whprm $whkond
				 ";
		}
		
		
		$rs = $this->db->query($q)->result();
		$totalData = $rs[0]->JML;

		

		if($jenisparam !=9)
		{
			$sql = "SELECT rownum, X.* FROM 
				( SELECT ROWNUM AS RN,NRK,NIP,NIP18,NAMA,KOLOK,F_GET_NALOK(KOLOK)NALOK,KOJAB,F_GET_NAJAB(KOLOK,KOJAB,KD)NAJABL,KLOGAD,F_GET_NALOK(KLOGAD)NAKLOGAD,F_GET_GOL_BYKOPANG(KOPANG)GOL FROM PERS_DUK_PANGKAT_HISTDUK P1
				WHERE THBL = '$thblparam' AND SUBSTR(KOPANG,2,1)='$golasli' $whprm $whkond ";

		}
		else
		{
			$sql = "SELECT rownum, X.* FROM 
				( SELECT ROWNUM AS RN,NRK,NIP,NIP18,NAMA,KOLOK,F_GET_NALOK(KOLOK)NALOK,KOJAB,F_GET_NAJAB(KOLOK,KOJAB,KD)NAJABL,KLOGAD,F_GET_NALOK(KLOGAD)NAKLOGAD,F_GET_GOL_BYKOPANG(KOPANG)GOL FROM PERS_DUK_PANGKAT_HISTDUK P1
				WHERE THBL = '$thblparam'  $whprm $whkond ";

		}

		
				
		if( !empty($requestData['search']['value']) ) {   // if there is a search parameter, $requestData['search']['value'] contains search parameter
            $sql.=" AND ( P1.NRK = ('".$requestData['search']['value']."') ";    
            $sql.=" OR P1.NAMA LIKE UPPER ('%".$requestData['search']['value']."%') ";
            //$sql.=" OR NAJABL LIKE UPPER ('%".$requestData['search']['value']."%') ";
            $sql.=" OR P1.NIP LIKE ('%".$requestData['search']['value']."%') ";
            //$sql.=" OR P1.NIP18 LIKE ('%".$requestData['search']['value']."%') ";
            
            $sql.=" OR NIP18 LIKE UPPER('%".$requestData['search']['value']."%') )";
		}

		$sql .= " ORDER BY
					P1.KLOGAD,
					P1.KOJAB,
					P1.NAMA
				) X";
		//die($sql);
		 $sql.=" WHERE 1=1";	
		
		
		//$query= $this->db->query($sql);
		$query= $this->db->query($sql);
		$totalFiltered = $query->num_rows();
		$startrow = $requestData['start'];
		$endrow = $startrow + $requestData['length'];

		$sql.=" AND RN BETWEEN $startrow  AND $endrow";
		
	
		
		//$query= $this->db->query($sql);
		$query= $this->db->query($sql);

		$data = array();

		$no_urut = $requestData['start']+1;
		foreach($query->result() as $row){
			$nestedData=array();
//			$nestedData[] = $no_urut;

			
				$nestedData[] = $row->NRK;
				$nestedData[] = $row->NIP;
				$nestedData[] = $row->NIP18;
				$nestedData[] = $row->NAMA;
				$nestedData[] = $row->NALOK."<br/> <strong><small class='text-navy'>( ".$row->KOLOK." ) </small></strong>";
				$nestedData[] = $row->NAJABL."<br/> <strong><small class='text-navy'>( ".$row->KOJAB." ) </small></strong>";
				$nestedData[] = $row->NAKLOGAD."<br/> <strong><small class='text-navy'>( ".$row->KLOGAD." ) </small></strong>";
				$nestedData[] = $row->GOL;
				
			

			//$nestedData[] = $row->PATHIR;
			//$nestedData[] = $row->TGL;
			$peg1=$this->infopegawai->getPegawai1($row->NRK);
			$penginput = $this->user['id'];
			$html_reset_pass="";



			$nestedData[] = "<div class='form-group'>
								<div class='col-sm-12'>
									<div class='row'>
										<div class='col-sm-4' align='center'>
											<button class='btn btn-outline btn-xs btn-success' data-toggle='tool-tip' title='Detail pegawai' pull-right onclick='DetailPegawai( &#39;".$row->NRK."&#39;,&#39;".$thblparam."&#39;)'><i class='fa fa-user'></i></button>
										</div>
										
										
									</div>
								</div>
							</div>
							
                            <script>
                                $('#tbl-grid_filter > label > input.form-control').val('');
                            </script>
                            ";








			
			

			$data[] = $nestedData;
			$no_urut++;
		}

		// <button type='button' class='btn btn-danger btn-xs' onclick='tolakHdr('".$row->NRK."')'>Tolak</button>
		//<div class='col-sm-4' align='center'><button class='btn btn-outline btn-xs btn-danger' data-toggle='tool-tip' data-placement='bottom' title='hapus pegawai' onClick=confirmHapusDataPegawai('".$row->NRK."') ><i class='fa fa-trash'></i></button></div>
			
		$json_data = array(
			"draw"            => intval( $requestData['draw'] ),
			"recordsTotal"    => intval( $totalData ),
			"recordsFiltered" => intval( $totalFiltered ),
			"data"            => $data
		);

		echo json_encode($json_data);
	}


	public function getSessionData()
	{
		$post = $this->input->post();
		$nrkpost = $post['nrk'];
		$kolokpost = $post['kolok'];
		
		//var_dump($nrkpost);
		$session_data = $this->session->userdata('logged_in');
		
		if($nrkpost!="" || $kolokpost !="")
		{

			if($session_data)
			{
				// array_push($session_data['param_cari'], $kolokpost , $nrkpost);
				$new_param = array ($kolokpost , $nrkpost);
				$this->session->set_userdata('param_cari', $new_param);
								
				// var_dump($session_data['param_cari']);
				//$session_data['param_cari'][0]);
			}
		}

		
	}



	function tampilPhoto($nrk='989898'){
		// Now query back the uploaded BLOB and display it
		$rs=$this->mdl->get_data($nrk)->row();
		$result = $rs->X_PHOTO->load();
		// If any text (or whitespace!) is printed before this header is sent,
		// the text won't be displayed and the image won't display properly.
		// Comment out this line to see the text and debug such a problem.
		header("Content-type: image/JPEG");
		echo $result;
	}

	function reset_password(){
		 // <img src="'.base_url("assets/img/eye.png").';" onmouseover="mouseoverPass(old_pass);" onmouseout="mouseoutPass(old_pass);">
		                 
		$id = $this->input->post('NRK');
		$nama = $this->infopegawai->getDataUser($id);

		if(isset($nama))
		{
			echo '
			<div class="modal-dialog" role="document" id="pesan">
		        <form class="form-horizontal" id="formPass" action="javascript:updatePassword();" method="POST">                
		            <div class="modal-content">
		            <div class="modal-header">
		                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		                <h4 class="modal-title" id="modalUmumTitle">Edit Password<i> '; 
		                echo $id; echo '-';
		                echo $nama->user_name;	echo '</i></h4>
		                <input type="hidden" id="NRK" name="NRK" value="' ; echo $id;	
		                
		                echo'">
		            </div>
		            <div class="modal-body">
		                    
		                <div class="form-group">
		                    <label for="username" class="col-sm-3 control-label">Password Baru</label>
		                    <div class="col-sm-9">

		                    <input type="password" class="form-control" id="old_pass" name="old_pass" Placeholder="Password Baru">
		                   	<img src="'.base_url("assets/img/eye.png").'" onmouseover="mouseoverPass(old_pass);" onmouseout="mouseoutPass(old_pass);">
		                   	</div>
		                </div>

		                <div class="form-group">
		                    <label for="username" class="col-sm-3 control-label">Password Konfirmasi</label>
		                    <div class="col-sm-9">
		                    <input type="password" class="form-control" id="new_pass" name="new_pass" Placeholder="Password Konfirmasi">
		                    <span class="text-danger" id="errnew_pass"></span>
		                    </div>
		                </div>

		                <div class="form-group">
		                    <label for="username" class="col-sm-3 control-label"></label>
		                    <div class="col-sm-9">
		                    <i>( Harap ganti Password secara berkala untuk menjaga kerahasiaan data pribadi anda ! )</i>
		                    </div>
		                </div>
		    
		            </div>
		                <div class="modal-footer">
		                    <button type="button" class="btn btn-default dim" data-dismiss="modal" id="tutupModal">Tutup</button>
		                    <button type="submit" class="btn btn-primary dim">Simpan</button>
		                </div>
		            </div>
		        </form>
		    </div>

		    <script type="text/javascript" language="javascript" >
		    	function mouseoverPass(obj) {
		  			//var obj = document.getElementById("myPassword");
		  			obj.type = "text";
				}

				function mouseoutPass(obj) {
		  			//var obj = document.getElementById("myPassword");
				  	obj.type = "password";
				}

			    function updatePassword(){
			        var url = "'.site_url("pegawai/UpdatePass").'";
			        $.ajax({
			            url: url,
			            type: "POST",
			            data: $("#formPass").serialize(),
			            dataType: "json",
			            beforeSend: function() {                
			                var old_pass = $("#old_pass").val();
			                if(old_pass == ""){
			                    $("#errold_pass").html("Passwor Lama Wajib diisi!!!");
			                    return false;
			                }else{
			                    $("#errold_pass").html();                    
			                }

			                var new_pass = $("#new_pass").val();
			                if(new_pass == ""){
			                    $("#errnew_pass").html("Password Baru Wajib diisi!!!");
			                    return false;
			                }else{
			                    $("#errnew_pass").html();                    
			                }

			               
			            },
			            success: function(data) {                               
			                
			                if(data.responeinsert == "SUKSES"){
			                    swal("Sukses!", "Reset password berhasil", "success");                    
			                    $("#tutupModal").click();
			                    $("#tbl-grid").DataTable().ajax.reload();
			                }else{
			                   swal("Gagal!", "Password konfirmasi tidak sesuai.", "error");
			                }
			            },
			            error: function(xhr) {                              
			                
			            },
			            complete: function() {              
			                
			            }
			        });
			    }

			</script>
		';
		}
		else
		{
			echo '
			<div class="modal-dialog" role="document" id="pesan">
		        <form class="form-horizontal" id="formPass" action="javascript:updatePassword();" method="POST">                
		            <div class="modal-content">
		            <div class="modal-header">
		                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		                <h4 class="modal-title" id="modalUmumTitle">Edit Password<i> ';

		                echo $id;

		                echo '
		                </i></h4>
		                <input type="hidden" id="NRK" name="NRK" value="">
		            </div>
		            <div class="modal-body">
		                    
		                <h2>USER <i>'; echo $id; echo '</i> BELUM MEMILIKI AKUN UNTUK MENGAKSES WEBSITE INI </h2>
		    
		            </div>
		                <div class="modal-footer">
		                    <button type="button" class="btn btn-default dim" data-dismiss="modal" id="tutupModal">Tutup</button>
		                    <button type="submit" class="btn btn-primary dim" style="display:none">Simpan</button>
		                </div>
		            </div>
		        </form>
		    </div>

		    
		';
		}
		
	}

	function UpdatePass(){
		$nrk = $this->input->post('NRK');
		$old_pass = $this->input->post('old_pass');
		$new_pass = $this->input->post('new_pass');
		$pass_old = md5($old_pass);
        $pass_new = md5($new_pass);
        // echo $nrk;
        // echo "pass lama"; var_dump($pass_old);

        // $cek_pass = $this->mdl->get_pass($nrk);
        // echo "pass db"; var_dump($cek_pass->user_password);

        // echo "pass db"; var_dump($cek_pass->user_id);
        
        if($pass_new  ==  $pass_old){
            $this->mdl->ubah_password($nrk,$pass_new);
            $respone = "SUKSES";
        }else{
            $respone = "GAGAL";
        }

        $return = array('responeinsert' => $respone);

        echo json_encode($return);
	}

	
	function detail_pegawai(){
		 
		      
		$nrk = $this->input->post('NRK');
		$thbl = $this->input->post('THBL');
		
		$data = $this->mdl->get_datahistduk($nrk,$thbl)->row();
		
		
		

		
			echo '
			<div class="modal-dialog modal-lg" role="document" id="pesan">
		        <form class="form-horizontal" id="formPass" action="#" method="POST">                
		            <div class="modal-content">
		            <div class="modal-header">
		                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		                <h4 class="modal-title" id="modalUmumTitle">Detail Pegawai<i> '; 
		                echo $data->NRK; echo '-';
		                echo $data->NAMA;	echo '</i></h4>
		                
		            </div>
		            <div class="modal-body">
		                
		            	<div class="row">
		            		<div class="col-md-4">';
                            if (file_exists(FCPATH.'assets/img/photo/'.$data->NRK.'_thumb.jpg')){
                                echo '<img alt="image" class="img-circle" src="'.base_url('assets/img/photo/'.$data->NRK.'_thumb.jpg').'" style="padding:5px;float:left;margin-right: 13px;height:96px;width:96px;"><br/><br/><br/><br/><br/><br/>';
                            } else {
                                echo '<img alt="image"  class="img-circle" src="'.base_url('assets/img/photo/profile_small.jpg').'" style="padding:5px;float:left;margin-right: 13px;height:96px;width:96px;"><br/><br/><br/><br/><br/><br/>';
                            }
                            echo '<small><b>NRK</b> <br/>';  echo $data->NRK; echo '<br/><br/></small>';
                            echo '<small><b>Nama</b> <br/>';  echo $data->NAMA; echo '<br/><br/></small>';
		            		echo '<small><b>Masa Kerja</b> <br/>';  echo substr($data->MASKER,0,2).' TAHUN  &nbsp;'.substr($data->MASKER,2,2).' BULAN'; echo '<br/><br/></small>';
                            
                            echo '
		            		</div>

		            		<div class="col-md-4"><small>';
                            

                            echo '<b>Lokasi Kerja</b> <br/>'; echo $data->NALOKL.' ('.$data->KOLOK.')'; echo '<br/><br/>';
                            echo '<b>Lokasi Gaji</b> <br/>'; echo $data->NAKLOGAD.' ('.$data->KLOGAD.')'; echo '<br/><br/>';
                            echo '<b>Jabatan</b> <br/>';  echo $data->NAJABL.' ('.$data->KOJAB.')'; echo '<br/><br/>';
                            echo '<b>SPMU</b> <br/>'; echo $data->NAMA_SPMU.' ('.$data->SPMU.')'; echo '<br/><br/>';
                            
                            echo '</small>
		            		</div>

		            		<div class="col-md-4"><small>';

		            		
                            echo '<b>Eselon</b> <br/>'; echo $data->NESELON; echo '<br/><br/>';
                            echo '<b>Status Pegawai</b> <br/>'; echo $data->KET_STAPEG; echo '<br/><br/>';
                            echo '<b>Pangkat</b> <br/>';  echo $data->NAPANG; echo '<br/><br/>';
                            echo '<b>Golongan</b> <br/>';  echo $data->GOLKOPANG; echo '<br/><br/>';

                            
                            echo '</small>
		            		</div>';
		            	echo'	
		            	</div><div class="hr-line-dashed"></div>';

		            	echo 
		            	'<div class="row">
		            		<div class="col-md-4"><small>';

		                 	echo '<b>NIP</b> <br/>'; echo $data->NIP; echo '<br/><br/>';
                            echo '<b>NIP18</b> <br/>'; echo $data->NIP18; echo '<br/><br/>';
                            
                            echo '</small>
		            		</div>

		            		<div class="col-md-4"><small>';
                            

                            echo '<b>Tempat / Tanggal Lahir</b> <br/>';  echo $data->PATHIR.' / '.$data->TALHIR; echo '<br/><br/>';
                            echo '<b>Umur</b> <br/>'; echo $data->UMUR.' TAHUN'; echo '<br/><br/>';
                            

                            
                            echo '</small>
		            		</div>

		            		<div class="col-md-4"><small>';

		            		echo '<b>Agama</b> <br/>'; echo $data->KET_AGAMA; echo '<br/><br/>';
                            echo '<b>Status Pernikahan</b> <br/>'; echo $data->KET_STAWIN; echo '<br/><br/>';
                            

                            
                            echo '</small>
		            		</div>';
		            	echo'	
		            	</div>';
		    		echo '
		            </div>
		                <div class="modal-footer">
		                    <button type="button" class="btn btn-default dim" data-dismiss="modal" id="tutupModal">Tutup</button>
		                    
		                </div>
		            </div>
		        </form>
		    </div>

		    <script type="text/javascript" language="javascript" >

		    $(document).ready(function(){
		    	$("#data_2 .input-group.date").datepicker({
                    todayBtn: "linked",
                    keyboardNavigation: false,
                    forceParse: false,
                    calendarWeeks: true,
                    autoclose: true,
                    format: "dd-mm-yyyy",
                    
                });

            	$("#data_3 .input-group.date").datepicker({
                    todayBtn: "linked",
                    keyboardNavigation: false,
                    forceParse: false,
                    calendarWeeks: true,
                    autoclose: true,
                    format: "dd-mm-yyyy",
                    
                });

                $("#data_5 .input-group.date").datepicker({
                    todayBtn: "linked",
                    keyboardNavigation: false,
                    forceParse: false,
                    calendarWeeks: true,
                    autoclose: true,
                    format: "dd-mm-yyyy",
                    endDate: new Date()
                });
            });

		    	 
                var config = {
                  
                  ".chosen-pejtt"           : {search_contains:true,no_results_text:"Oops, Data Tidak Ditemukan",width: "300px"},
                  
                }
                for (var selector in config) {
                  $(selector).chosen(config[selector]);
                }

			    function updateDataPeg(){
			        var url = "'.site_url("pegawai/UpdateMPP").'";
			        $.ajax({
			            url: url,
			            type: "POST",
			            data: $("#formPass").serialize(),
			            dataType: "json",
			            beforeSend: function() {                
			                var TGLAMPP = $("#TGLAMPP").val();
			                var TGLEMPP = $("#TGLEMPP").val();
			                var TGLSK = $("#TGLSK").val();
			                var NOSK = $("#NOSK").val();
			                var PEJTT = $("#PEJTT").val();
			    
			                if(TGLAMPP == ""){
			                    $("#warning").html("Tanggal Awal MPP Wajib Diisi");
			                    return false;
			                }
			                else if(TGLEMPP=="")
			                {
			                	$("#warning").html("Tanggal Akhir MPP Wajib Diisi");
			                    return false;
			                }
			                else if(TGLSK=="")
			                {
			                	$("#warning").html("Tanggal SK Wajib Diisi");
			                    return false;
			                }
			                else if(NOSK=="")
			                {
			                	$("#warning").html("Nomor SK Wajib Diisi");
			                    return false;
			                }
			                else if(PEJTT=="")
			                {
			                	$("#warning").html("PEJTT Wajib Diisi");
			                    return false;
			                }
			                else{
			                    $("#warning").html();     
			                                 
			                }

			                
			               
			            },
			            success: function(data) {                               
			                
			                if(data.responupd == "SUKSES"){
			                    swal("Sukses!", "Input berhasil", "success");                    
			                    $("#tutupModal").click();
			                    $("#tbl-grid").DataTable().ajax.reload();
			                }else{
			                   swal("Gagal!", "Gagal Perbarui Data Pegawai.", "error");
			                }
			            },
			            error: function(xhr) {                              
			                
			            },
			            complete: function() {              
			                
			            }
			        });
			    }

			</script>
		';
		
		
	}
	




}
		

