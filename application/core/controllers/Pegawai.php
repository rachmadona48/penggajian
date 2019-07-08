<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pegawai extends CI_Controller {

	public function __construct()
	{
		 /*header('Access-Control-Allow-Origin: http://10.15.32.31');
    header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");*/
		parent::__construct();
		$this->load->helper('url');
		$this->load->library('session');
		$this->load->library('infopegawai');
		$this->load->model('mreferensi','referensi');
		$this->load->model('admin/v_pegawai','mdl');
		$this->load->model('hist/v_jabatanf_hist');

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
		$tgl_sekarang = date("Y-m-d");
		$tgl = date('Y-m-d', strtotime($tgl_sekarang));
		$tglproses = date('Y-m-d', strtotime($tgl_sekarang));
		$koloks = $this->mdl->getKolok();
		
		$namasrc = $this->input->post('namasrc');
		$nrksrc = $this->input->post('nrksrc');
		$koloksrc = $this->input->post('koloksrc');
		//var_dump($koloks);
		/*$data = array(
			'tgl' => $tgl,
			'tglproses' => $tglproses,
			'koloks' => $koloks,
			'koloksrc' => $koloksrc,
			'nrksrc' => $nrksrc,
			'namasrc' => $namasrc,
			'param_cari'=> $this->user['param_cari']
		);*/

		$hak_akses = $this->infopegawai->hakAksesModul('394',$this->user['user_group']);
		$data = array(
			'tgl' => $tgl,
			'tglproses' => $tglproses,
			'koloks' => $koloks,
			'koloksrc' => $koloksrc,
			'nrksrc' => $nrksrc,
			'namasrc' => $namasrc,
			'param_cari'=> $this->user['param_cari'],
			'hak_akses'=>$hak_akses
			);

		// echo $data['param_cari'][1];
		/*if(count($this->user['param_cari'])==0)
		{

			$data = array(
			'tgl' => $tgl,
			'tglproses' => $tglproses,
			'koloks' => $koloks,
			'koloksrc' => $koloksrc,
			'nrksrc' => $nrksrc,
			'namasrc' => $namasrc
			);
		}
		else
		{
			


		}*/


		$datam['activemn'] = $this->infopegawai->initialMenu($this->user['user_group'],'datapokok',0);
		$datam['inisial'] = 'pegawai';

		$this->load->view('head/header',$this->user);
		$this->load->view('head/menu',$datam);
		$this->load->view('admin/pegawai_grid.php',$data);
		$this->load->view('head/footer');
	}

	public function idxback()
	{
		$tgl_sekarang = date("Y-m-d");
		$tgl = date('Y-m-d', strtotime($tgl_sekarang));
		$tglproses = date('Y-m-d', strtotime($tgl_sekarang));
		$koloks = $this->mdl->getKolok();
		
		$data = array(
			'tgl' => $tgl,
			'tglproses' => $tglproses,
			'koloks' => $koloks,
			
		);

		$datam['activemn'] = $this->infopegawai->initialMenu($this->user['user_group'],'datapokok',0);

		$this->load->view('head/header',$this->user);
		$this->load->view('head/menu',$datam);
		$this->load->view('admin/pegawai_grid.php',$data);
		$this->load->view('head/footer');
	}

	public function view()
	{
		$datam['activemn'] = $this->infopegawai->initialMenu($this->user['user_group'],'datapokok',0);

		$this->load->view('head/header',$this->user);
		$this->load->view('head/menu',$datam);
		$this->load->view('admin/pegawai_detail.php');
		$this->load->view('head/footer');
	}

	function getSpmuByKlogad(){
		$klogad = $this->input->post('klogad');

		$rs=$this->mdl->getSpmu($klogad);

		echo $rs;
	}

	function getKetSpmuByKlogad(){
		$klogad = $this->input->post('klogad');

		$rs=$this->mdl->getKetSpmu($klogad);

		echo $rs;
	}

	function getKetSpmuBySpmu()
	{
		$spmu=$this->input->post('spmu');

		$rs=$this->mdl->getKeteranganSpmu($spmu);

		echo $rs;
	}

	function autocom()
	{
		$searchTerm = $_GET['term'];
		$a = $this->mdl->getAutoCom($searchTerm);

		$pjg = count($a);
		$b='';
		for($i=0;$i<$pjg;$i++)
		{
			$b[$i] = $a[$i]->NRK ;	
		}
		
		echo json_encode($b);

	}

	function autocom2()
	{
		$searchTerm = $_GET['term'];

		$a = $this->mdl->getAutoCom2($searchTerm);

		$pjg = count($a);

		$b='';
		for($i=0;$i<$pjg;$i++)
		{
			$b[$i] = $a[$i]->NAMA ;	
			
		}
		
		echo json_encode($b);

	}

	function autocom3()
	{
		$searchTerm = $_GET['term'];
		$a = $this->mdl->getAutoCom3($searchTerm);

		$pjg = count($a);
		$b='';
		for($i=0;$i<$pjg;$i++)
		{
			$b[$i] = $a[$i]->NIP ;	
		}
		
		echo json_encode($b);

	}

	function autocom4()
	{
		$searchTerm = $_GET['term'];
		$a = $this->mdl->getAutoCom4($searchTerm);

		$pjg = count($a);
		$b='';
		for($i=0;$i<$pjg;$i++)
		{
			$b[$i] = $a[$i]->NIP18 ;	
		}
		
		echo json_encode($b);

	}

	public function data()
	{
		$hak_akses = $this->infopegawai->hakAksesModul('394',$this->user['user_group']);
		$requestData = $this->input->post();
		//var_dump($requestData);
		$pjg_input=strlen($requestData['nrk']);

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
		$q = "SELECT
					COUNT(NRK) AS jml
				FROM
					PERS_PEGAWAI1 P1
				 ";
		// WHERE NOT EXISTS (SELECT NRK FROM PERS_PEGAWAI1 B WHERE DELETED ='Y' AND P1.NRK=B.NRK)
		$rs = $this->db->query($q)->result();
		$totalData = $rs[0]->JML;

		// getting records as per search parameters
		//$wh_kolok = " AND PERS_PEGAWAI1.kolok='' ";
		$wh_kolok = "";
		if( !empty($requestData['kolok']) ){
			$nrk_status = "";
			$wh_kolok = " AND (vw.nalokl) = '".$requestData['kolok']."' ";
		}
		else if( !empty($requestData['koloksrc']) ){
			$nrk_status = "";
			$wh_kolok = " AND (vw.nalokl) = '".$requestData['koloksrc']."' ";
		}

		//$wh_nrk = " AND PERS_PEGAWAI1.nrk='' ";
		$wh_nrk = "";
		if ($this->session->userdata('logged_in')['user_group']!='1'){
			if( !empty($requestData['nrk']) ){
				$nrk_status = "WHERE NRK =('".$requestData['nrk']."')";
				//$wh_nrk = " AND lower(PERS_PEGAWAI1.nrk) LIKE lower('%".$requestData['nrk']."%') ";

				if($pjg_input==6)
				{
					$wh_nrk="AND (
	                        P1.nrk =('".$requestData['nrk']."')
	                        OR (P1.nama) LIKE UPPER('%".$requestData['nrk']."%')
	                        
	                    )";
				}
				else
				{
					$wh_nrk="AND (
	                       	(P1.nrk) LIKE UPPER('%".$requestData['nrk']."%')
	                        OR (P1.nama) LIKE UPPER('%".$requestData['nrk']."%')
	                        OR (P1.NIP) LIKE UPPER('%".$requestData['nrk']."%')
	                        OR (P1.NIP18) LIKE UPPER('%".$requestData['nrk']."%')
	                    )";	
				}
				
			}
			else if( !empty($requestData['nrksrc']) ){
				$nrk_status = "WHERE NRK =('".$requestData['nrksrc']."')";
				//$wh_nrk = " AND lower(PERS_PEGAWAI1.nrk) LIKE lower('%".$requestData['nrksrc']."%') ";
				/*$wh_nrk="AND (
	                        P1.nrk =('".$requestData['nrksrc']."')
	                        OR (P1.nama) LIKE UPPER('%".$requestData['nrksrc']."%')
	                        OR (P1.NIP) LIKE UPPER('%".$requestData['nrksrc']."%')
	                        OR (P1.NIP18) LIKE UPPER('%".$requestData['nrksrc']."%')
	                    )";*/

	            if($pjg_input==6)
				{
					$wh_nrk="AND (
	                        P1.nrk =('".$requestData['nrk']."')
	                        OR (P1.nama) LIKE UPPER('%".$requestData['nrk']."%')
	                        
	                    )";
				}
				else
				{
					$wh_nrk="AND (
	                       	(P1.nrk) LIKE UPPER('%".$requestData['nrk']."%')
	                        OR (P1.nama) LIKE UPPER('%".$requestData['nrk']."%')
	                        OR (P1.NIP) LIKE UPPER('%".$requestData['nrk']."%')
	                        OR (P1.NIP18) LIKE UPPER('%".$requestData['nrk']."%')
	                    )";	
				}
			}
		} else {

			$wh_nrk = " AND P1.nrk = '".$this->session->userdata('logged_in')['nrk']."' ";
		}

		/*$wh_nama = "";
		if( !empty($requestData['nama']) ){
			$wh_nama = " AND lower(PERS_PEGAWAI1.nama) LIKE lower('%".$requestData['nama']."%') ";
		}
		else if( !empty($requestData['namasrc']) ){
			$wh_nama = " AND lower(PERS_PEGAWAI1.nama) LIKE lower('%".$requestData['namasrc']."%') ";
		}*/

		$whc=$wh_kolok.$wh_nrk;

		if ($whc==""){
			$nrk_status = "";
			$wh0 = "1=2";
		} else {
			$wh0 = "1=1";
		}

		$sql = "SELECT ROWNUM,X.* FROM(

		SELECT rownum as rn,
				vw.najabl, P1.nrk, P1.nama, P1.nip18,P1.nip,TO_CHAR(P1.TG_UPD,'DD-MM-YYYY HH24:MI:SS')TG_UPD,P1.USER_ID,
				vw.kolok,vw.kopang,vw.kojab,vw.eselon,PG.GOL,HD.STATUS_AKTIF,P1.KLOGAD,
                P1.pathir, vw.NALOKL,LK.NALOKL AS NAKLOGAD,TO_CHAR(P1.talhir,'DD-MM-YYYY') AS TGL";
		$sql .= " FROM PERS_PEGAWAI1 P1
				  LEFT JOIN 
						(
							SELECT * 
							FROM
							(
								SELECT * 
								FROM PERS_DISIPLIN_HIST
								$nrk_status
								ORDER BY TG_UPD DESC
							)WHERE ROWNUM =1
					)HD ON P1.NRK = HD.NRK
				  LEFT JOIN \"vw_jabatan_terakhir\" vw ON P1.NRK = vw.NRK 
				  LEFT JOIN VW_PANGKAT_TERAKHIR PG ON P1.NRK = PG.NRK
				  LEFT JOIN PERS_LOKASI_TBL LK on P1.KLOGAD = LK.KOLOK
                  WHERE 1=1	
                  AND
                  			$wh0
							$wh_kolok
							$wh_nrk
							";
							// NOT EXISTS (SELECT NRK FROM PERS_PEGAWAI1 B WHERE DELETED ='Y' AND P1.NRK=B.NRK)
		if( !empty($requestData['search']['value']) ) {   // if there is a search parameter, $requestData['search']['value'] contains search parameter
            $sql.=" AND ( P1.NRK = ('".$requestData['search']['value']."') ";    
            $sql.=" OR P1.NAMA LIKE UPPER ('%".$requestData['search']['value']."%') ";
            $sql.=" OR vw.NAJABL LIKE UPPER ('%".$requestData['search']['value']."%') ";
            $sql.=" OR P1.NIP LIKE ('%".$requestData['search']['value']."%') ";
            $sql.=" OR P1.NIP18 LIKE ('%".$requestData['search']['value']."%') ";
            $sql.=" OR PG.GOL LIKE ('%".$requestData['search']['value']."%') ";
            $sql.=" OR LK.NALOKL LIKE ('%".$requestData['search']['value']."%') ";
            $sql.=" OR vw.NALOKL LIKE UPPER('%".$requestData['search']['value']."%') )";
		}

		$sql.=" )X ";
		
		$query= $this->db->query($sql);
		$totalFiltered = $query->num_rows();
		$startrow = $requestData['start'];
		$endrow = $startrow + $requestData['length'];
		if($endrow>10)
		{
			$startrow =$startrow+1;
		}
		$sql.=" WHERE RN BETWEEN $startrow  AND $endrow";
		// $sql.=" AND RN > ".$requestData['start']."  AND ROWNUM <= ".$requestData['length']."";
	//	$sql.=" ORDER BY ". $columns[$requestData['order'][0]['column']]."   ".$requestData['order'][0]['dir']." ";  // adding length
		
		//echo $sql;
		$query= $this->db->query($sql);

		$data = array();

		$no_urut = $requestData['start']+1;
		foreach($query->result() as $row){
			$nestedData=array();
//			$nestedData[] = $no_urut;

			if($row->STATUS_AKTIF == 'AKTIF'){
				$nestedData[] = "<span class='text-danger'>".$row->NRK."</span>";
				$nestedData[] = "<span class='text-danger'>".$row->NIP."</span>";
				$nestedData[] = "<span class='text-danger'>".$row->NIP18."</span>";
				$nestedData[] = "<span class='text-danger'>".$row->NAMA."</span>";
				
				$nestedData[] = "<span class='text-danger'>".$row->NALOKL." <br/><strong><small class='text-navy'>( ".$row->KOLOK." )</small></strong></span>";
				
				$nestedData[] = "<span class='text-danger'>".$row->NAJABL." <br/><strong><small class='text-navy'>( ".$row->KOJAB." )</small></strong></span>";
				$nestedData[] = "<span class='text-danger'>".$row->NAKLOGAD." <br/><strong><small class='text-navy'>( ".$row->KLOGAD." )</small></strong></span>";
				$nestedData[] = "<span class='text-danger'>".$row->GOL."</span>";
				$nestedData[] = "<span class='text-danger'>".$row->USER_ID.".<br/>( ".$row->TG_UPD." )</span>";
			}else{
				$nestedData[] = $row->NRK;
				$nestedData[] = $row->NIP;
				$nestedData[] = $row->NIP18;
				$nestedData[] = $row->NAMA;
				$nestedData[] = $row->NALOKL."<br/> <strong><small class='text-navy'>( ".$row->KOLOK." ) </small></strong>";
				$nestedData[] = $row->NAJABL."<br/> <strong><small class='text-navy'>( ".$row->KOJAB." ) </small></strong>";
				$nestedData[] = $row->NAKLOGAD."<br/> <strong><small class='text-navy'>( ".$row->KLOGAD." ) </small></strong>";
				$nestedData[] = $row->GOL;
				$nestedData[] = $row->USER_ID."<br/>( ".$row->TG_UPD." )";
			}

			//$nestedData[] = $row->PATHIR;
			//$nestedData[] = $row->TGL;
			$peg1=$this->infopegawai->getPegawai1($row->NRK);

			$kolokpeg = substr($peg1->KOLOK, 0,1);
			$kowillogin = $this->user['kowil'];

			

			$html_reset_pass="";
			if ($this->user['user_group']=='2' || $this->user['user_group']=='3'){
				if ($hak_akses->act_resetpass == 'Y'){
				$html_reset_pass="<div class='col-sm-3' align='center'>
										<button class='btn btn-outline btn-xs btn-warning' data-toggle='tool-tip' title='Reset password pegawai' pull-right onclick='ResetPassword(&#39;".$row->NRK."&#39;)'><i class='fa fa-key'></i></button>
								</div>";
								
				$htmladduser="<div class='col-sm-3' align='center'>
										<button class='btn btn-outline btn-xs btn-info' data-toggle='tool-tip' title='tambah user akun pegawai' pull-right onclick='TambahUser(&#39;".$row->NRK."&#39;)'><i class='fa fa-flag-checkered'></i></button>
										</div>";				
				}
				$ubah='';
				if ($hak_akses->act_update == 'Y'){
					$ubah = "<div class='col-sm-2' align='center'>
											<form method='post' action='".site_url('pegawai/doedit')."' >
												<input type='hidden' name='nrk' id='nrk' value='".$row->NRK."'>
												<input type='hidden' name='ses' id='ses' value='1'>
												<button class='btn btn-outline btn-xs btn-warning' data-toggle='tool-tip' data-placement='bottom' title='edit pegawai' type='submit' pull-right><i class='fa fa-pencil-square'></i></button>
											</form>
										</div>";				
				}

				// $hapus_flag='';
				// if ($hak_akses->act_delete_flag == 'Y'){
				// 	$hapus_flag = "<div class='col-sm-2' align='center'>
				// 					<button class='btn btn-outline btn-xs btn-danger' data-toggle='tool-tip' data-placement='bottom' title='hapus pegawai' pull-right onclick='confirmHapusDataPegawaiFlag(\"".$row->NRK."\")'><i class='fa fa-trash'></i></button>
				// 			</div>";				
				// }

				$hapus='';
				if ($hak_akses->act_delete == 'Y'){
					$hapus = "<div class='col-sm-2' align='center'>
									<button class='btn btn-outline btn-xs btn-danger' data-toggle='tool-tip' data-placement='bottom' title='hapus' pull-right onclick='confirmHapusDataPegawai(\"".$row->NRK."\")'><i class='fa fa-trash'></i></button>
							</div>";				
				} 
				

				$nestedData[] = "<div class='form-group'>
								<div class='col-sm-12'>
									<div class='row'>
										<div class='col-sm-2' align='center'>
											<form method='post' action='".site_url('pegawai/doview')."' >
												<input type='hidden' name='nrk' id='nrk' value='".$row->NRK."'>
												<input type='hidden' name='koloksrc' id='koloksrc' value='".$row->KOLOK."'>
												<input type='hidden' name='nrksrc' id='nrkksrc' value='".$row->NRK."'>
												
												
												 <button class='btn btn-outline btn-xs btn-primary' data-toggle='tool-tip' data-placement='bottom' title='detail pegawai' type='submit' pull-right><i class='fa fa-user'></i></button>
											</form>
										</div>
										
										<div class='col-sm-2' align='center'>
											<form method='post' action='".site_url('riwayat')."'>
												<input type='hidden' name='nrk' id='nrk' value='".$row->NRK."'>
												<button class='btn btn-outline btn-xs btn-success' data-toggle='tool-tip' data-placement='bottom' title='riwayat pegawai' type='submit' pull-right><i class='fa fa-history'></i></button>
											</form>
										</div>
										$ubah
										$hapus
										$html_reset_pass
										$htmladduser
									</div>
								</div>
							</div>
							
                            <script>
                                $('#tbl-grid_filter > label > input.form-control').val('');
                            </script>
                            ";
			} 
			else if($this->user['user_group']=='11')
			{
				$nestedData[] = "<div class='form-group'>
								<div class='col-sm-12'>
									<div class='row'>
										<div class='col-sm-4' align='center'>
											<form method='post' action='".site_url('pegawai/doview')."' >
												<input type='hidden' name='nrk' id='nrk' value='".$row->NRK."'>
												<input type='hidden' name='koloksrc' id='koloksrc' value='".$row->KOLOK."'>
												<input type='hidden' name='nrksrc' id='nrkksrc' value='".$row->NRK."'>
												 <button class='btn btn-outline btn-xs btn-primary' data-toggle='tool-tip' data-placement='bottom' title='detail pegawai' type='submit' pull-right><i class='fa fa-user'></i></button>
											</form>
										</div>

										
										<div class='col-sm-4' align='center'>
											<form method='post' action='".site_url('riwayat')."' >
												<input type='hidden' name='nrk' id='nrk' value='".$row->NRK."'>
												<button class='btn btn-outline btn-xs btn-success' data-toggle='tool-tip' data-placement='bottom' title='riwayat pegawai' type='submit' pull-right><i class='fa fa-history'></i></button>
											</form>
										</div>


										

										$html_reset_pass
									</div>
								</div>
							</div>
							
                            <script>
                                $('#tbl-grid_filter > label > input.form-control').val('');
                            </script>
                            ";
			}
			else if($this->user['user_group']=='12')
			{
				$html_reset_pass="<div class='col-sm-4' align='center'>
											<button class='btn btn-outline btn-xs btn-warning' data-toggle='tool-tip' title='Reset password pegawai' pull-right onclick='ResetPassword( &#39;".$row->NRK."&#39;)'><i class='fa fa-key'></i></button>
									</div>";

				$nestedData[] = "$html_reset_pass";
			}
			else if($this->user['user_group']>='13')
			{
				$nestedData[] = "<div class='form-group'>
								<div class='col-sm-12'>
									<div class='row'>
										<div class='col-sm-4' align='center'>
											<form method='post' action='".site_url('pegawai/doview')."' >
												<input type='hidden' name='nrk' id='nrk' value='".$row->NRK."'>
												<input type='hidden' name='koloksrc' id='koloksrc' value='".$row->KOLOK."'>
												<input type='hidden' name='nrksrc' id='nrkksrc' value='".$row->NRK."'>
												 <button class='btn btn-outline btn-xs btn-primary' data-toggle='tool-tip' data-placement='bottom' title='detail pegawai' type='submit' pull-right><i class='fa fa-user'></i></button>
											</form>
										</div>

										
										<div class='col-sm-4' align='center'>
											<form method='post' action='".site_url('riwayat')."' >
												<input type='hidden' name='nrk' id='nrk' value='".$row->NRK."'>
												<button class='btn btn-outline btn-xs btn-success' data-toggle='tool-tip' data-placement='bottom' title='riwayat pegawai' type='submit' pull-right><i class='fa fa-history'></i></button>
											</form>
										</div>

									</div>
								</div>
							</div>
							
                            <script>
                                $('#tbl-grid_filter > label > input.form-control').val('');
                            </script>
                            ";
			}
			else {
				
			//=='10' &&  == 11 &&  == 11
					//COMPARE KOLOK PEGAWAI DIGIT PERTAMA DENGAN KOWIL
				if ($this->user['user_group']=='10' && substr($peg1->KOLOK,0,1) == $this->user['kowil']){
					
					

					$html_reset_pass="<div class='col-sm-4' align='center'>
											<button class='btn btn-outline btn-xs btn-warning' data-toggle='tool-tip' title='Reset password pegawai' pull-right onclick='ResetPassword(&#39;".$row->NRK."&#39;)'><i class='fa fa-key'></i></button>
									</div>";
						if( substr($peg1->KOLOK,1,1) != 1)
						{
							$nestedData[] = "<div class='form-group'>
								<div class='col-sm-12'>
									<div class='row'>
										<div class='col-sm-4' align='center'>
											<form method='post' action='".site_url('pegawai/doview')."' >
												<input type='hidden' name='nrk' id='nrk' value='".$row->NRK."'>
												<input type='hidden' name='koloksrc' id='koloksrc' value='".$row->KOLOK."'>
												<input type='hidden' name='nrksrc' id='nrkksrc' value='".$row->NRK."'>
												
												
												 <button class='btn btn-outline btn-xs btn-primary' data-toggle='tool-tip' data-placement='bottom' title='detail pegawai' type='submit' pull-right><i class='fa fa-user'></i></button>
											</form>
										</div>

										
										<div class='col-sm-4' align='center'>
											<form method='post' action='".site_url('riwayat')."' >
												<input type='hidden' name='nrk' id='nrk' value='".$row->NRK."'>
												<button class='btn btn-outline btn-xs btn-success' data-toggle='tool-tip' data-placement='bottom' title='riwayat pegawai' type='submit' pull-right><i class='fa fa-history'></i></button>
											</form>
										</div>


										

										$html_reset_pass
									</div>
								</div>
							</div>
							
                            <script>
                                $('#tbl-grid_filter > label > input.form-control').val('');
                            </script>
                            ";
						}
						else
						{
							$nestedData[] = "<div class='form-group'>
								<div class='col-sm-12'>
									<div class='row'>
										<div class='col-sm-4' align='center'>
											<form method='post' action='".site_url('pegawai/doview')."' >
												<input type='hidden' name='nrk' id='nrk' value='".$row->NRK."'>
												<input type='hidden' name='koloksrc' id='koloksrc' value='".$row->KOLOK."'>
												<input type='hidden' name='nrksrc' id='nrkksrc' value='".$row->NRK."'>
												
												
												 <button class='btn btn-outline btn-xs btn-primary' data-toggle='tool-tip' data-placement='bottom' title='detail pegawai' type='submit' pull-right><i class='fa fa-user'></i></button>
											</form>
										</div>

										
										<div class='col-sm-4' align='center'>
											<form method='post' action='".site_url('riwayat')."' >
												<input type='hidden' name='nrk' id='nrk' value='".$row->NRK."'>
												<button class='btn btn-outline btn-xs btn-success' data-toggle='tool-tip' data-placement='bottom' title='riwayat pegawai' type='submit' pull-right><i class='fa fa-history'></i></button>
											</form>
										</div>


										

										
									</div>
								</div>
							</div>
							
                            <script>
                                $('#tbl-grid_filter > label > input.form-control').val('');
                            </script>
                            ";
						}
					
					
				}
				else if($this->user['user_group']=='10' && substr($peg1->KOLOK,0,1) != $this->user['kowil'])
				{
					if(substr($peg1->KOLOK,0,2) == 11 && $this->user['kowil'] == 11)
					{
						$html_reset_pass="<div class='col-sm-4' align='center'>
											<button class='btn btn-outline btn-xs btn-warning' data-toggle='tool-tip' title='Reset password pegawai' pull-right onclick='ResetPassword(&#39;".$row->NRK."&#39;)'><i class='fa fa-key'></i></button>
									</div>";

						$nestedData[] = "<div class='form-group'>
								<div class='col-sm-12'>
									<div class='row'>
										<div class='col-sm-4' align='center'>
											<form method='post' action='".site_url('pegawai/doview')."' >
												<input type='hidden' name='nrk' id='nrk' value='".$row->NRK."'>
												<input type='hidden' name='koloksrc' id='koloksrc' value='".$row->KOLOK."'>
												<input type='hidden' name='nrksrc' id='nrkksrc' value='".$row->NRK."'>
												
												
												 <button class='btn btn-outline btn-xs btn-primary' data-toggle='tool-tip' data-placement='bottom' title='detail pegawai' type='submit' pull-right><i class='fa fa-user'></i></button>
											</form>
										</div>

										
										<div class='col-sm-4' align='center'>
											<form method='post' action='".site_url('riwayat')."' >
												<input type='hidden' name='nrk' id='nrk' value='".$row->NRK."'>
												<button class='btn btn-outline btn-xs btn-success' data-toggle='tool-tip' data-placement='bottom' title='riwayat pegawai' type='submit' pull-right><i class='fa fa-history'></i></button>
											</form>
										</div>


										

										$html_reset_pass
									</div>
								</div>
							</div>
							
                            <script>
                                $('#tbl-grid_filter > label > input.form-control').val('');
                            </script>
                            ";
					}
					else
					{
						$nestedData[] = "<div class='form-group'>
								<div class='col-sm-12'>
									<div class='row'>
										<div class='col-sm-4' align='center'>
											<form method='post' action='".site_url('pegawai/doview')."' >
												<input type='hidden' name='nrk' id='nrk' value='".$row->NRK."'>
												<input type='hidden' name='koloksrc' id='koloksrc' value='".$row->KOLOK."'>
												<input type='hidden' name='nrksrc' id='nrkksrc' value='".$row->NRK."'>
												
												
												 <button class='btn btn-outline btn-xs btn-primary' data-toggle='tool-tip' data-placement='bottom' title='detail pegawai' type='submit' pull-right><i class='fa fa-user'></i></button>
											</form>
										</div>

										
										<div class='col-sm-4' align='center'>
											<form method='post' action='".site_url('riwayat')."' >
												<input type='hidden' name='nrk' id='nrk' value='".$row->NRK."'>
												<button class='btn btn-outline btn-xs btn-success' data-toggle='tool-tip' data-placement='bottom' title='riwayat pegawai' type='submit' pull-right><i class='fa fa-history'></i></button>
											</form>
										</div>
									</div>
								</div>
							</div>
							
                            <script>
                                $('#tbl-grid_filter > label > input.form-control').val('');
                            </script>
                            ";
					}
					
				}
					
			}
			//var_dump($nestedData);exit;
			

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

	public function doadd()
	{
		$data['aksi'] = 'add';
		$data['linkaction'] = site_url('pegawai/doaddaction');

		//pegawai 1
		//$data['NRK'] = $this->mdl->getNewNRK();
		$data['NRK'] = $this->mdl->generateNRK();
		$data['listKolok'] = $this->infopegawai->getKolokAktifJoin('');
		$data['listKlogad'] = $this->infopegawai->getKolokAktifJoin('');
		$data['listKojab'] = $this->infopegawai->getMasterKojabSF('','');
		$data['listSpmu'] = $this->referensi->getDataSpmu('');
		$data['listJenpeg'] = $this->mdl->getListJenpeg();
		$data['listInduk'] = $this->mdl->getListInduk();
		$data['listAgama'] = $this->mdl->getListAgama();
		$data['listStawin'] = $this->mdl->getListStawin();
		$data['listStapeg'] = $this->mdl->getListStapeg();

		//pegawai 2
		$data['listKowil'] = $this->mdl->getListKowil();
		$data['listKocam'] = $this->mdl->getListKocam();
		$data['listKokel'] = $this->mdl->getListKokel();
		$data['listProp'] = $this->mdl->getListProp();

		$data['listKowilKtp'] = $this->mdl->getListKowil();
		$data['listKocamKtp'] = $this->mdl->getListKocam();
		$data['listKokelKtp'] = $this->mdl->getListKokel();
		$data['listPropKtp'] = $this->mdl->getListProp();

		$data['listJendikcps'] = $this->mdl->getListJendikcps();
		$data['listKodikcps'] = $this->mdl->getListKodikcps();

		$datam['activemn'] = $this->infopegawai->initialMenu($this->user['user_group'],'datapokok',0);


		$this->load->view('head/header', $this->user);
		$this->load->view('head/menu',$datam);
		$this->load->view('admin/pegawai_form.php',$data);
		$this->load->view('head/footer');

	}


	public function doaddaction(){
		if(isset($_POST['nrk'])){
			$nrk = $_POST['nrk'];
		}else{
			$nrk = "empty";
		}

		$config = array(
			'upload_path' => 'assets/img/photo/',
			'allowed_types' => 'jpeg|jpg|png',
			'file_name' => ''.$nrk.'.jpg',
			'file_ext_tolower' => TRUE,
			'overwrite' => TRUE,
			'max_size' => 1024,
			// 'max_width' => 1024,
			// 'max_height' => 768,
			// 'min_width' => 10,
			// 'min_height' => 7,
			'max_filename' => 0,
			'remove_spaces' => TRUE
		);
		//load library utk upload
		$this->load->library('upload', $config);

		$data = $this->input->post();
		$linkback = base_url() . 'index.php/pegawai/';
		$cek = $this->mdl->cekAdaNRK($data['nrk']);
		if ($cek=='tidak ada') {
			//untuk upload file ke direktori
			if ( ! $this->upload->do_upload('x_photo'))
			{
				$upload = '';
				$hasil = $this->upload->display_errors();
			}
			else
			{
				$config['image_library'] = 'gd2';
				$config['source_image'] = $this->upload->upload_path.$this->upload->file_name;
				$config['create_thumb'] = TRUE;
				$config['maintain_ratio'] = TRUE;
				$config['width']         = 240;
				$config['height']       = 300;

				$this->load->library('image_lib', $config);

				if ( ! $this->image_lib->resize()){
					$upl_data = "";
					$result = $this->image_lib->display_errors('', '');
				}else{
					$upl_data = $this->image_lib->resize();
					$result = 'SUKSES';
				}

				//$this->upload->data();

				$hasil = array('result' => $result);
			}
			$data['user_id']= $this->user['id'];

			$hsl = $this->mdl->insertData($data,$this->upload->data());

			if ($hsl > 0){
				$a = array('response' => 'SUKSES', 'hasil' => $hsl, 'linkback' => $linkback);
				$this->session->set_flashdata('msg', $a);

				redirect(site_url('pegawai'));
			} else {
				$a = array('response' => 'GAGAL', 'hasil' => $hsl, 'linkback' => $linkback);
				$this->session->set_flashdata('errmsg', $hsl);

				echo '<script type="text/javascript">history.back();</script>';
				//redirect(site_url('pegawai/doadd'));
			}



		} else {
			$a = array('response' => 'GAGAL', 'hasil' => 'NRK Sudah ada', 'linkback' => '');
			$this->session->set_flashdata('errmsg', 'NRK Sudah ada');

			echo '<script type="text/javascript">history.back();</script>';

			//redirect(site_url('pegawai/doadd'));
				//echo "Terjadi Kesalahan.<br> Data tidak dapat disimpan.<br>";
		}
		//echo json_encode($a);

	}

	public function doedit()	{

		$data['aksi'] = 'edit';
		$ses = $this->input->post('ses');
		if($this->input->post('nrk') ){
			$id1 = $this->input->post('nrk');
		}else{
			return $this->index();
		}

		$listdata = $this->mdl->get_data($id1)->row();
		
		$count = count($listdata);
		$data['count'] = $count;
		if($count){
			foreach ($listdata as $key => $value) {

				$data[$key] = $value;

			}
		}

		
		$data['ses']=$ses;
		//pegawai 1
		$data['NRK'] = $id1;

		

		$data['listKolok'] = $this->infopegawai->getMasterKolokAll($data['KOLOK']);
		$data['listKolokMati'] = $this->infopegawai->getMasterKolokAll($data['KOLOK']);
		
		
		
		$data['listKlogad'] = $this->infopegawai->getKolokAktifJoin($data['KLOGAD']);
		$data['listKlogadMati'] = $this->infopegawai->getKolokAktifJoin('111111118');
		
		// $data['listKojab'] = $this->infopegawai->getMasterKojabSF($data['KOLOK'],$data['KOJAB']);
		if (substr($listdata->KD, 0,1) == 'S'){
			$data['listKojab'] = $this->infopegawai->getMasterKojab($data['KOLOK'],$data['KOJAB']);
		} else {
			$data['listKojab'] = $this->infopegawai->getMasterKojabF($data['KOLOK'],$data['KOJAB']);
		}

		if($data['SPMU'] != "" || $data['SPMU'] != null){
			$data['listSpmu'] = $this->referensi->getDataSpmu($data['SPMU']);
		}
		$data['listJenpeg'] = $this->mdl->getListJenpegAll($data['JENPEG']);
		///$data['listInduk'] = $this->mdl->getListInduk();
		$data['listAgama'] = $this->mdl->getListAgama($data['AGAMA']);
		$data['listStawin'] = $this->mdl->getListStawin($data['STAWIN']);
		$data['listStapeg'] = $this->mdl->getListStapeg($data['STAPEG']);


		//pegawai 2
		$data['valProp'] = $this->mdl->getValLokasi($data['PROP']);
		$data['valKowil'] = $this->mdl->getValLokasi($data['KOWIL']);
		$data['valKocam'] = $this->mdl->getValLokasi($data['KOCAM']);
		$data['valKokel'] = $this->mdl->getValLokasi($data['KOKEL']);

		$data['listProp'] = $this->mdl->getListProp($data['PROP']);
		
		$data['listKowil'] = $this->mdl->getListKowil($data['KOWIL'],$data['PROP']);
		$data['listKocam'] = $this->mdl->getListKocam($data['KOCAM'],$data['KOWIL']);
		$data['listKokel'] = $this->mdl->getListKokel($data['KOKEL'],$data['KOWIL'],$data['KOCAM']);

		$data['valPropKtp'] = $this->mdl->getValLokasi($data['PROP_KTP']);
		$data['valKowilKtp'] = $this->mdl->getValLokasi($data['KOWIL_KTP']);
		$data['valKocamKtp'] = $this->mdl->getValLokasi($data['KOCAM_KTP']);
		$data['valKokelKtp'] = $this->mdl->getValLokasi($data['KOKEL_KTP']);

		$data['listPropKtp'] = $this->mdl->getListProp($data['PROP_KTP']);
		$data['listKowilKtp'] = $this->mdl->getListKowil($data['KOWIL_KTP'],$data['PROP_KTP']);
		$data['listKocamKtp'] = $this->mdl->getListKocam($data['KOCAM_KTP'],$data['KOWIL_KTP']);
		$data['listKokelKtp'] = $this->mdl->getListKokel($data['KOKEL_KTP'],$data['KOWIL_KTP'],$data['KOCAM_KTP']);

		$data['listJendikcps'] = $this->mdl->getListJendikcps($data['JENDIKCPS']);
		$data['listKodikcps'] = $this->mdl->getListKodikcps($data['KODIKCPS']);

		$datam['activemn'] = $this->infopegawai->initialMenu($this->user['user_group'],'datapokok',0);

		$data['linkaction'] = site_url('pegawai/doeditaction');

		$this->load->view('head/header', $this->user);
		$this->load->view('head/menu',$datam);
		$this->load->view('admin/pegawai_form',$data);
		$this->load->view('head/footer');
	}

	

	public function doeditaction(){
		if(isset($_POST['nrk'])){
			$nrk = $_POST['nrk'];
		}else{
			$nrk = "empty";
		}
		//var_dump($_POST); exit;
		$ses = $_POST['ses'];
		$config = array(
			'upload_path' => 'assets/img/photo/',
			'allowed_types' => 'jpeg|jpg|png',
			'file_name' => ''.$nrk.'.jpg',
			'file_ext_tolower' => TRUE,
			'overwrite' => TRUE,
			'max_size' => 512,
			// 'max_width' => 1024,
			// 'max_height' => 768,
			// 'min_width' => 10,
			// 'min_height' => 7,
			'max_filename' => 0,
			'remove_spaces' => TRUE
		);
		//load library utk upload
		$this->load->library('upload', $config);

		$data = $this->input->post();
		//print_r($data);
		//untuk upload file ke direktori
		if ( ! $this->upload->do_upload('x_photo'))
		{
			$upload = '';
			$hasil = $this->upload->display_errors();
		}
		else
		{
			$config['image_library'] = 'gd2';
			$config['source_image'] = $this->upload->upload_path.$this->upload->file_name;
			$config['create_thumb'] = TRUE;
			$config['maintain_ratio'] = TRUE;
			$config['width']         = 240;
			$config['height']       = 300;

			$this->load->library('image_lib', $config);

			if ( ! $this->image_lib->resize()){
				$upl_data = "";
				$result = $this->image_lib->display_errors('', '');
			}else{
				$upl_data = $this->image_lib->resize();
				$result = 'SUKSES';
			}

			//$this->upload->data();

			$hasil = array('result' => $result);
		}
		//print_r($data);exit;
		$data['user_id']= $this->user['id'];
		$hsl = $this->mdl->updateData($data);
		//print_r($hsl);
		//var_dump($hsl);
		$linkback = site_url('pegawai');
		$a = array('response' => 'SUKSES', 'hasil' => $hasil, 'linkback' => $linkback);

		$linkback2 = site_url('riwayat');
		$b = array('response' => 'SUKSES', 'hasil' => $hasil, 'linkback' => $linkback2);
		
		//$this->session->set_userdata('referred_from', 5);

		//var_dump($ses);
		if($ses==1)
		{	
			$this->session->set_flashdata('msg', $a);
			redirect(site_url('pegawai'));
		}
		else if($ses == 2)
		{
			$this->session->set_flashdata('msg', $b);
			//redirect(site_url('riwayat/?nrk='.$nrk));	
			redirect(site_url('riwayat'));	

		}
			
	}

	public function dohapusaction($id='')
	{	

		if($this->input->post('id')){
			$id = $this->input->post('id');
		}else{
			return $this->index();
		}

		$hsl = $this->mdl->hapusDataP($id);
		
		$linkback = base_url().'index.php/pegawai/';
		if($hsl){
			$a = array('response' => 'SUKSES', 'hasil' => $hsl, 'linkback' => $linkback);
		}else{
			$a = array('response' => 'GAGAL', 'hasil' => $hsl, 'linkback' => $linkback);
		}

		echo json_encode($a);
	}

	public function dodelete($id='')
	{	

		if($this->input->post('id')){
			$id = $this->input->post('id');
		}else{
			return $this->index();
		}

		$hsl = $this->mdl->hapusData($id);
		
		$linkback = base_url().'index.php/pegawai/';
		if($hsl){
			$a = array('response' => 'SUKSES', 'hasil' => $hsl, 'linkback' => $linkback);
		}else{
			$a = array('response' => 'GAGAL', 'hasil' => $hsl, 'linkback' => $linkback);
		}

		echo json_encode($a);
	}

	public function tes(){
		$this->mdl->tesSelect();

	}

	public function doview3()	{

		//$data['aksi'] = 'edit';
		if($this->input->post('nrk') ){
			$id1 = $this->input->post('nrk');
		}else{
			return $this->index();
		}

		$listdata = $this->mdl->get_data($id1)->row();
		$count = count($listdata);
		$data['count'] = $count;
		if($count){
			foreach ($listdata as $key => $value) {

				$data[$key] = $value;

			}
		}

		//var_dump($id1);

		//pegawai 1
		$data['NRK'] = $id1;
		
		$data['listKolok'] = $this->infopegawai->getMasterKolokAllValue($data['KOLOK'],$data['NRK']);
		$data['listKlogad'] = $this->infopegawai->getMasterKlogadAllValue($data['KLOGAD']);
		$data['listKojab'] = $this->infopegawai->getMasterKojabSFValue($data['KOLOK'],$data['KOJAB']);
		if($data['SPMU'] != "" || $data['SPMU'] != null){
			$data['listSpmu'] = $this->referensi->getDataSpmu($data['SPMU']);
		}
		$data['listJenpeg'] = $this->infopegawai->getListJenpegValue($data['JENPEG']);
		///$data['listInduk'] = $this->mdl->getListInduk();
		$data['listAgama'] = $this->infopegawai->getListAgamaValue($data['AGAMA']);
		$data['listStawin'] = $this->infopegawai->getListStawinValue($data['STAWIN']);
		$data['listStapeg'] = $this->infopegawai->getListStapegValue($data['STAPEG']);


		//pegawai 2

		$data['listProp'] = $this->infopegawai->getListPropValue($data['PROP']);
		$data['listKowil'] = $this->infopegawai->getListKowilValue($data['KOWIL'],$data['PROP']);
		$data['listKocam'] = $this->infopegawai->getListKocamValue($data['KOCAM'],$data['KOWIL']);
		$data['listKokel'] = $this->infopegawai->getListKokelValue($data['KOKEL'],$data['KOWIL'],$data['KOCAM']);
		$data['listJendikcps'] = $this->infopegawai->getListJendikcpsValue($data['JENDIKCPS']);
		$data['listKodikcps'] = $this->infopegawai->getListKodikcps($data['KODIKCPS']);

		$datam['activemn'] = $this->infopegawai->initialMenu($this->user['user_group'],'datapokok',0);


		$this->load->view('head/header', $this->user);
		$this->load->view('head/menu',$datam);
		$this->load->view('admin/pegawai_detail.php',$data);
		$this->load->view('head/footer');
	}

	public function doview()	{
		if($this->input->post('nrk') ){
			$id1 = $this->input->post('nrk');
			$nrksrc = $this->input->post('nrksrc');
			$namasrc = $this->input->post('namasrc');
			$koloksrc = $this->input->post('koloksrc');
		}else{
			return $this->index();
		}


		$listdata = $this->mdl->get_data_v2($id1)->row();
		// print_r($listdata);
		$count = count($listdata);
		$data['count'] = $count;
		if($count){
			foreach ($listdata as $key => $value) {

				$data[$key] = $value;

			}
		}

		//pegawai 1
		$data['NRK'] = $id1;
		$data['nrksrc'] = $nrksrc;
		$data['namasrc'] = $namasrc;
		$data['koloksrc'] = $koloksrc;

		$data['listKolok'] = $this->infopegawai->getMasterKolokAllValue2($data['KOLOK'],$data['NRK']);
		$data['listKlogad'] = $this->infopegawai->getMasterKlogadNama($data['KLOGAD']);
		$data['listKojab'] = $this->infopegawai->getMasterKojabSFNama($data['KOLOK'],$data['KOJAB'],$data['KD']);
		if($data['SPMU'] != "" || $data['SPMU'] != null){
			$data['listSpmu'] = $this->referensi->getDataSpmu($data['SPMU']);
		}
		$data['listJenpeg'] = $this->infopegawai->getListJenpegValue($data['JENPEG']);
		///$data['listInduk'] = $this->mdl->getListInduk();
		$data['listAgama'] = $this->infopegawai->getListAgamaValue($data['AGAMA']);
		$data['listStawin'] = $this->infopegawai->getListStawinValue($data['STAWIN']);
		$data['listStapeg'] = $this->infopegawai->getListStapegValue($data['STAPEG']);


		//pegawai 2

		$data['listProp'] = $this->infopegawai->getListPropValue($data['PROP']);
		$data['listKowil'] = $this->infopegawai->getListKowilValue($data['KOWIL'],$data['PROP']);
		$data['listKocam'] = $this->infopegawai->getListKocamValue($data['KOCAM'],$data['KOWIL']);
		$data['listKokel'] = $this->infopegawai->getListKokelValue($data['KOKEL'],$data['KOWIL'],$data['KOCAM']);
		$data['listJendikcps'] = $this->infopegawai->getListJendikcpsValue2($data['JENDIKCPS']);
		$data['listKodikcps'] = $this->infopegawai->getListKodikcps2($data['KODIKCPS']);
		// var_dump($data['KODIKCPS']);exit;

		$datam['activemn'] = $this->infopegawai->initialMenu($this->user['user_group'],'datapokok',0);


		$this->load->view('head/header', $this->user);
		$this->load->view('head/menu',$datam);
		$this->load->view('admin/pegawai_detail2',$data);
		$this->load->view('head/footer');
	}

	public function doview2()	{
		if($this->input->post('nrk') ){
			$id1 = $this->input->post('nrk');
			$nrksrc = $this->input->post('nrksrc');
			$namasrc = $this->input->post('namasrc');
			$koloksrc = $this->input->post('koloksrc');
		}else{
			return $this->index();
		}


		$listdata = $this->mdl->get_data_v2($id1)->row();
		$count = count($listdata);
		$data['count'] = $count;
		if($count){
			foreach ($listdata as $key => $value) {

				$data[$key] = $value;

			}
		}

		//var_dump($id1);

		//pegawai 1
		$data['NRK'] = $id1;
		$data['nrksrc'] = $nrksrc;
		$data['namasrc'] = $namasrc;
		$data['koloksrc'] = $koloksrc;

		$data['listKolok'] = $this->infopegawai->getMasterKolokAllValue2($data['KOLOK'],$data['NRK']);
		$data['listKlogad'] = $this->infopegawai->getMasterKlogadNama($data['KLOGAD']);
		$data['listKojab'] = $this->infopegawai->getMasterKojabSFNama($data['KOLOK'],$data['KOJAB'],$data['KD']);
		if($data['SPMU'] != "" || $data['SPMU'] != null){
			$data['listSpmu'] = $this->referensi->getDataSpmu($data['SPMU']);
		}
		$data['listJenpeg'] = $this->infopegawai->getListJenpegValue($data['JENPEG']);
		///$data['listInduk'] = $this->mdl->getListInduk();
		$data['listAgama'] = $this->infopegawai->getListAgamaValue($data['AGAMA']);
		$data['listStawin'] = $this->infopegawai->getListStawinValue($data['STAWIN']);
		$data['listStapeg'] = $this->infopegawai->getListStapegValue($data['STAPEG']);


		//pegawai 2

		$data['listProp'] = $this->infopegawai->getListPropValue($data['PROP']);
		$data['listKowil'] = $this->infopegawai->getListKowilValue($data['KOWIL'],$data['PROP']);
		$data['listKocam'] = $this->infopegawai->getListKocamValue($data['KOCAM'],$data['KOWIL']);
		$data['listKokel'] = $this->infopegawai->getListKokelValue($data['KOKEL'],$data['KOWIL'],$data['KOCAM']);
		$data['listJendikcps'] = $this->infopegawai->getListJendikcpsValue($data['JENDIKCPS']);
		$data['listKodikcps'] = $this->infopegawai->getListKodikcps($data['KODIKCPS']);

		$datam['activemn'] = $this->infopegawai->initialMenu($this->user['user_group'],'datapokok',0);


		$this->load->view('head/header', $this->user);
		$this->load->view('head/menu',$datam);
		$this->load->view('admin/pegawai_detail2',$data);
		$this->load->view('head/footer');
	}
	
	function tambahuser()
	{
		$id = $this->input->post();
		//$id = $this->input->post('nrk');
		$nrk=$id['NRK'];
		echo '
			<div class="modal-dialog" role="document" id="pesan">
		        <form class="form-horizontal" id="formPass" action="javascript:setuser();" method="POST">                
		            <div class="modal-content">
		            <div class="modal-header">
		                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		                
		                <input type="hidden" id="NRK" name="NRK" value="' ; echo $nrk;	
		                
		                echo'">
		            </div>
		            <div class="modal-body">
		                    
		                

		                <div class="form-group">
		                    <h2>Anda Yakin akan membuat akun pegawai ini??</h2>

		                </div>

		                
		    
		            </div>
		                <div class="modal-footer">
		                    <button type="button" class="btn btn-default dim" data-dismiss="modal" id="tutupModal">Batalkan</button>
		                    <button type="submit" class="btn btn-primary dim">Buat</button>
		                </div>
		            </div>
		        </form>
		    </div>

		    <script type="text/javascript" language="javascript" >
		    	
			    function setuser(){
			        var url = "'.site_url("pegawai/AddUserAccount").'";
			        $.ajax({
			            url: url,
			            type: "POST",
			            data: $("#formPass").serialize(),
			            dataType: "json",
			           
			            success: function(data) {                               
			                
			                if(data.resp == "0"){
			                    swal("Error!", "Akun Pegawai Gagal Dibuat", "error");                    
			                    
			                }
			                else if(data.resp == "1"){
			                  
			                   swal({type:"success",title:"Akun Pegawai Berhasil Dibuat",text:"User ID = '; echo $nrk; echo', Password = 123456"});
			                   $("#tutupModal").click();
			                    $("#tbl-grid").DataTable().ajax.reload();
			                }
			                else
			                {
			                	 swal("Warning!", "Akun Pegawai Sudah Ada.", "warning");

			                   	$("#tutupModal").click();
			                    $("#tbl-grid").DataTable().ajax.reload();
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

	function AddUserAccount()
	{
		$nrk = $this->input->post();
		
		$result = $this->mdl->addUserAccount($nrk);
		

		$return = array('resp' => $result);

        echo json_encode($return);
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

}
		

