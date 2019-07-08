<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Master_ptt extends CI_Controller {

	public function __construct()
	{
		 /*header('Access-Control-Allow-Origin: http://10.15.32.31');
    header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");*/
		parent::__construct();
		$this->load->helper('url');
		$this->load->library('session');
		$this->load->library('format_uang');
		$this->load->library('infopegawai');
		$this->load->model('mreferensi','referensi');
		$this->load->model('admin/v_pegawai','mdl');
		$this->load->model('admin/v_ptt','mdl_ptt');
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

	

	public function ptt()
	{
		$tgl_sekarang = date("Y-m-d");
		$tgl = date('Y-m-d', strtotime($tgl_sekarang));
		$tglproses = date('Y-m-d', strtotime($tgl_sekarang));
		$koloks = $this->mdl_ptt->get_Kolok();

		// print_r($koloks);exit();
		
		$namasrc = $this->input->post('namasrc');
		$pttsrc = $this->input->post('pttsrc');
		$koloksrc = $this->input->post('koloksrc');
		

		$hak_akses = $this->infopegawai->hakAksesModul('28809',$this->user['user_group']);
		$data = array(
			'tgl' => $tgl,
			'tglproses' => $tglproses,
			'koloks' => $koloks,
			'koloksrc' => $koloksrc,
			'pttsrc' => $pttsrc,
			'namasrc' => $namasrc,
			'param_cari'=> $this->user['param_cari'],
			'hak_akses'=>$hak_akses
			);

		$datam['user_group'] = $this->user['user_group'];
		$datam['activemn'] = $this->infopegawai->initialMenu($this->user['user_group'],'master_ptt',0);
		$datam['inisial'] = 'master_ptt';

		$this->load->view('head/header',$this->user);
		$this->load->view('head/menu',$datam);
		$this->load->view('admin/ptt_grid.php',$data);
		$this->load->view('head/footer');
	}



	public function data(){
		$this->mdl_ptt->get_data_ptt();
	}

	public function doedit()	{

		$data['aksi'] = 'edit';
		$data['nptt'] = $this->input->post('nptt');

		$listdata = $this->mdl_ptt->get_data($data['nptt'])->row();
		// echo $listdata->NAMA;exit();
		$data['nama'] = $listdata->NAMA;
		$data['tgllahir'] = $listdata->TGLLAHIR;
		$data['jabat'] = $listdata->JABAT;

		$data['list_spmu'] = $this->mdl_ptt->get_list_spmu($listdata->SPMU);
		$data['list_lokasi'] = $this->mdl_ptt->get_list_klog($listdata->KLOG);

		$data['gti'] = $listdata->GTI;
		$data['kodel'] = $listdata->KODEL;
		$data['status'] = $listdata->STATUS;

		$datam['activemn'] = $this->infopegawai->initialMenu($this->user['user_group'],'master_ptt',0);

		$data['linkaction'] = site_url('master_ptt/doeditaction');

		// print_r($this->user);exit();

		$this->load->view('head/header', $this->user);
		$this->load->view('head/menu',$datam);
		$this->load->view('admin/ptt_form',$data);
		$this->load->view('head/footer');
	}

	public function doeditaction(){
		$nptt = $_POST['nptt'];
		$nama = $_POST['nama'];
		$jabat = $_POST['jabat'];
		$spmu = $_POST['spmu'];
		$klog = $_POST['klog'];
		$gti = $_POST['gti'];
		$kodel = $_POST['kodel'];
		$status = $_POST['status'];

		$update = $this->mdl_ptt->update_data($nptt,$nama,$jabat,$spmu,$klog,$gti,$kodel,$status);

		$linkback = site_url('master_ptt/ptt');
		$a = array('response' => 'SUKSES', 'hasil' => $hasil, 'linkback' => $linkback);

		
		//$this->session->set_userdata('referred_from', 5);

		$this->session->set_flashdata('msg', $a);
		redirect(site_url('master_ptt/ptt'));

	}


	


	// ==========================================================================================================




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

	public function data2()
	{
		$hak_akses = $this->infopegawai->hakAksesModul('394',$this->user['user_group']);
		$requestData = $this->input->post();
		
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
			$wh_kolok = " AND (LK.NALOKL) = '".$requestData['kolok']."' ";
		}
		else if( !empty($requestData['koloksrc']) ){
			$nrk_status = "";
			$wh_kolok = " AND (LK.NALOKL) = '".$requestData['koloksrc']."' ";
		}

		//$wh_nrk = " AND PERS_PEGAWAI1.nrk='' ";
		$wh_nrk = "";
		$wh_ukpd="";
		$whspmu="";
		$whklogadaktif = "";
		

		if ($this->session->userdata('logged_in')['user_group']!='1')
		{

			if($this->session->userdata('logged_in')['user_group']=='47')
			{
				$idukpd = $this->user['id'];
				 $cekkolok = "SELECT a.kolok,a.nalok,a.spmu,a.kode_unit_sipkd,b.\"user_id\" 
                        from pers_klogad3 a
                        LEFT JOIN \"master_user\" b on a.kode_unit_sipkd = b.\"user_id\" 
                        where b.\"user_id\" = '$idukpd'";
                        //die($cekkolok);
            	$querycekkolok = $this->db->query($cekkolok);
				$num = $querycekkolok->num_rows();
            	if($num =='1') 
            	{
                	$reskolok=$querycekkolok->row()->KOLOK;
                	$wh_ukpd=" AND P1.KLOGAD = '$reskolok'";   
            	}
            	else
            	{
					$cekkoloknonsipkd="SELECT a.kolok,a.nalok,a.spmu,a.kode_unit_sipkd,b.\"user_id\" 
									from pers_klogad3 a
									LEFT JOIN \"master_user\" b on a.kolok = b.\"user_id\" 
									where b.\"user_id\" ='$idukpd'";
									
					$querycekkoloknonsipkd = $this->db->query($cekkoloknonsipkd);
					$numkolok = $querycekkoloknonsipkd->num_rows();

					if($numkolok=='1')
					{
						$reskolok = $querycekkoloknonsipkd->row()->KOLOK;
						$wh_ukpd=" AND P1.KLOGAD = '$reskolok'";  
					}
					else
					{
						$reskolok = '';
						$wh_ukpd=" AND 2=2";	
					}
            		
            	}

            	if( !empty($requestData['nrk']) )
				{
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
				else if( !empty($requestData['nrksrc']) )
				{
					$nrk_status = "WHERE NRK =('".$requestData['nrksrc']."')";
				

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

				$whklogadaktif =" AND (P1.kdmati <> 'Y' OR P1.KDMATI IS NULL) AND P1.KLOGAD NOT LIKE '1111111%' AND P1.NRK NOT IN (25310,199412,999000,885649,805171,666666,611722,576008,555555,537176,470045,441138,435023,412002,409579,376263,353515,
                333333,321095,317668,266407,250204,222222,217208,200558,199412
                ) ";
			}
			else if($this->session->userdata('logged_in')['user_group']=='5')
			{
				$username = $this->user['id'] ;

            	$getspmu = "SELECT * FROM PERS_TABEL_SPMU WHERE KODE_UNIT_SIPKD ='$username'";
            	$querygetspmu = $this->db->query($getspmu);
            	$numspm = $querygetspmu->num_rows();

            	if($numspm == 0)
            	{
            		$whspmu = " AND 3=3 ";
            	}
	            else if($numspm == 1)
	            {
	                $spmu = $querygetspmu->row()->KODE_SPM;

	                $whspmu = " AND KL.SPMU='$spmu' ";
	                

	            }
	            else 
	            {
	                $arrayspmu = $querygetspmu->result();
	                

	                foreach ($arrayspmu  as $value) {
	                    # code...
	                    
	                    $spmu[] = $value->KODE_SPM;
	                }
	                $quewh="";
	                for($i=0;$i<$numspm;$i++)
	                {

	                    $quewh.= "'".$spmu[$i]."'";
	                    if($i<$numspm-1)
	                    {
	                        $quewh.=",";
	                    }
	                }
	                
	                $whspmu = " AND KL.SPMU IN (".$quewh.") ";
	                
	               
	                
	            }

            	if( !empty($requestData['nrk']) )
				{
					$nrk_status = "WHERE NRK =('".$requestData['nrk']."')";
					

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
				else if( !empty($requestData['nrksrc']) )
				{
					$nrk_status = "WHERE NRK =('".$requestData['nrksrc']."')";
				

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

				$whklogadaktif =" AND (P1.kdmati <> 'Y' OR P1.KDMATI IS NULL) AND P1.KLOGAD NOT LIKE '1111111%' AND P1.NRK NOT IN (25310,199412,999000,885649,805171,666666,611722,576008,555555,537176,470045,441138,435023,412002,409579,376263,353515,
                333333,321095,317668,266407,250204,222222,217208,200558,199412
                ) ";
			}
			else
			{

				if( !empty($requestData['nrk']) )
				{
					$nrk_status = "WHERE NRK =('".$requestData['nrk']."')";
					

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
				else if( !empty($requestData['nrksrc']) )
				{
					$nrk_status = "WHERE NRK =('".$requestData['nrksrc']."')";
				

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
				$whklogadaktif =" AND 6=6 ";
			}

			
		} else {

			$wh_nrk = " AND P1.nrk = '".$this->session->userdata('logged_in')['nrk']."' ";
			$whklogadaktif =" AND 6=6 ";
		}

		/*$wh_nama = "";
		if( !empty($requestData['nama']) ){
			$wh_nama = " AND lower(PERS_PEGAWAI1.nama) LIKE lower('%".$requestData['nama']."%') ";
		}
		else if( !empty($requestData['namasrc']) ){
			$wh_nama = " AND lower(PERS_PEGAWAI1.nama) LIKE lower('%".$requestData['namasrc']."%') ";
		}*/

		if($this->session->userdata('logged_in')['user_group']=='5')
		{
			
			$wh0 = "1=1";
			$nrk_status = "";
		}
		else
		{
			$whc=$wh_kolok.$wh_nrk;

			if ($whc==""){
				$nrk_status = "";
				$wh0 = "1=2";
			} else {
				$wh0 = "1=1";
			}	
		}

		$sql = "SELECT ROWNUM,X.* FROM(

		SELECT rownum as rn,
				vw.najabl, P1.nrk, P1.nama, P1.nip18,P1.nip,TO_CHAR(P1.TG_UPD,'DD-MM-YYYY HH24:MI:SS')TG_UPD,P1.USER_ID,
				vw.kolok,vw.kopang,vw.kojab,vw.eselon,PG.GOL,HD.STATUS_AKTIF,P1.KLOGAD,
                P1.pathir, vw.NALOKL,LK.NALOKL AS NAKLOGAD,TO_CHAR(P1.talhir,'DD-MM-YYYY') AS TGL, KL.NALOK";
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
				  LEFT JOIN PERS_KLOGAD3 KL on P1.KLOGAD = KL.KOLOK
                  WHERE 1=1	
                  AND
                  			$wh0
							$wh_kolok
							$wh_nrk
							$whklogadaktif
							$whspmu
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
				if($this->user['user_group'] =='47' || $this->user['user_group'] =='5' )
				{
					
				}
				else
				{
					$nestedData[] = "<span class='text-danger'>".$row->USER_ID.".<br/>( ".$row->TG_UPD." )</span>";	
				}
			}else{
				$nestedData[] = $row->NRK;
				$nestedData[] = $row->NIP;
				$nestedData[] = $row->NIP18;
				$nestedData[] = $row->NAMA;
				$nestedData[] = $row->NALOKL."<br/> <strong><small class='text-navy'>( ".$row->KOLOK." ) </small></strong>";
				$nestedData[] = $row->NAJABL."<br/> <strong><small class='text-navy'>( ".$row->KOJAB." ) </small></strong>";
				$nestedData[] = $row->NAKLOGAD."<br/> <strong><small class='text-navy'>( ".$row->KLOGAD." ) </small></strong>";
				$nestedData[] = $row->GOL;
				if($this->user['user_group'] =='47' || $this->user['user_group'] =='5' )
				{
					
				}
				else
				{
						$nestedData[] = $row->USER_ID."<br/>( ".$row->TG_UPD." )";
				}
			}

			//$nestedData[] = $row->PATHIR;
			//$nestedData[] = $row->TGL;
			$peg1=$this->infopegawai->getPegawai1($row->NRK);
			$penginput = $this->user['id'];
			$kolokpeg = substr($peg1->KOLOK, 0,1);
			$kowillogin = $this->user['kowil'];

			

			$html_reset_pass="";
			if ($this->user['user_group']=='2' || $this->user['user_group']=='3' ){
				if ($hak_akses->act_resetpass == 'Y'){
				$html_reset_pass="<div class='col-sm-3' align='center'>
										<button class='btn btn-outline btn-xs btn-warning' data-toggle='tool-tip' title='Reset password pegawai' pull-right onclick='ResetPassword(&#39;".$row->NRK."&#39;)'><i class='fa fa-key'></i></button>
								</div>";
								
				$htmladduser="<div class='col-sm-3' align='center'>
										<button class='btn btn-outline btn-xs btn-info' data-toggle='tool-tip' title='tambah user akun pegawai' pull-right onclick='TambahUser(&#39;".$row->NRK."&#39;)'><i class='fa fa-flag-checkered'></i></button>
										</div>";	
				$html_formmati="<div class='col-sm-3' align='center'>
										<button class='btn btn-outline btn-xs btn-danger' data-toggle='tool-tip' title='Form Kematian ' pull-right onclick='FormKematian(&#39;".$row->NRK."&#39;,&#39;".$penginput."&#39;)'><i class='fa fa-times'></i></button>
								</div>";

				$html_batalformmati="<div class='col-sm-3' align='center'>
										<button class='btn btn-outline btn-xs btn-success' data-toggle='tool-tip' title='Form Batalkan Kematian ' pull-right onclick='FormBatalkanKematian(&#39;".$row->NRK."&#39;)'><i class='fa fa-check'></i></button>
								</div>";	

				$html_formmpp="<div class='col-sm-3' align='center'>
										<button class='btn btn-outline btn-xs btn-primary' data-toggle='tool-tip' title='Form MPP ' pull-right onclick='FormMPP(&#39;".$row->NRK."&#39;,&#39;".$penginput."&#39;)'><i class='fa fa-home'></i></button>
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
										$html_formmati
										$html_batalformmati
										$html_formmpp
									</div>
								</div>
							</div>
							
                            <script>
                                $('#tbl-grid_filter > label > input.form-control').val('');
                            </script>
                            ";
			} 


			elseif ($this->user['user_group']=='5' ){
				if ($hak_akses->act_resetpass == 'Y'){
					
				$html_formmati="<div class='col-sm-3' align='center'>
										<button class='btn btn-outline btn-xs btn-danger' data-toggle='tool-tip' title='Form Kematian ' pull-right onclick='FormKematian(&#39;".$row->NRK."&#39;,&#39;".$penginput."&#39;)'><i class='fa fa-times'></i></button>
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
										
										$html_formmati
										
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
			else if($this->user['user_group']>='13' && $this->user['user_group']<'45')
			{
				if($this->user['user_group']=='30')
				{
					$html_formmati="<div class='col-sm-3' align='center'>
										<button class='btn btn-outline btn-xs btn-danger' data-toggle='tool-tip' title='Form Kematian ' pull-right onclick='FormKematian(&#39;".$row->NRK."&#39;,&#39;".$penginput."&#39;)'><i class='fa fa-times'></i></button>
								</div>";

					$html_formmpp="<div class='col-sm-3' align='center'>
										<button class='btn btn-outline btn-xs btn-primary' data-toggle='tool-tip' title='Form MPP ' pull-right onclick='FormMPP(&#39;".$row->NRK."&#39;,&#39;".$penginput."&#39;)'><i class='fa fa-home'></i></button>
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
										$html_formmati
										$html_formmpp
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
			else if($this->user['user_group']=='45')
			{
				$html_drh="<div class='col-sm-4' align='center'>
											<form method='post' target='_blank' action='".site_url('profile/cv')."' >
												<input type='hidden' name='nrkpr' id='nrkpr' value='".$row->NRK."'>
												<button class='btn btn-outline btn-xs btn-danger' data-toggle='tool-tip' data-placement='bottom' title='DRH pegawai' pull-right><i class='fa fa-file-pdf-o'></i></button>
											</form>
										</div>";

				$nestedData[] = "$html_drh";
			}
			else if($this->user['user_group'] == '10')
			{
				$kowil = $this->user['kowil'];
					$getkodekolok2 = substr($peg1->KOLOK,0,2);
					$getkodekolok1 = substr($peg1->KOLOK,0,1);
					$getkodekolok3 = substr($peg1->KOLOK,1,1);


					$html_reset_pass="<div class='col-sm-4' align='center'>
											<button class='btn btn-outline btn-xs btn-warning' data-toggle='tool-tip' title='Reset password pegawai' pull-right onclick='ResetPassword(&#39;".$row->NRK."&#39;)'><i class='fa fa-key'></i></button>
									</div>";
					$htmladduser="<div class='col-sm-3' align='center'>
										<button class='btn btn-outline btn-xs btn-info' data-toggle='tool-tip' title='tambah user akun pegawai' pull-right onclick='TambahUser(&#39;".$row->NRK."&#39;)'><i class='fa fa-flag-checkered'></i></button>
										</div>";	
					$html_formmati="<div class='col-sm-3' align='center'>
										<button class='btn btn-outline btn-xs btn-danger' data-toggle='tool-tip' title='Form Kematian ' pull-right onclick='FormKematian(&#39;".$row->NRK."&#39;,&#39;".$penginput."&#39;)'><i class='fa fa-times'></i></button>
								</div>";

					if($kowil == '11') //untuk kepseribu
					{
						if($getkodekolok2 == '11') //compare dengan kolok pegawai
						{
							//lengkap	
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
										$htmladduser
										$html_formmati
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
							//tidak lengkap
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
					else if($kowil =='1')//untuk jakpus
					{
						if($getkodekolok1=='1' && $getkodekolok3 =='1') // jadi kep seribu
						{
							//tidak lengkap
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
						else if($getkodekolok1 == '1' && $getkodekolok3 !='1') //jadi jakpus
						{
							//lengkap
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
										$htmladduser
										$html_formmati
									</div>
								</div>
							</div>
							
                            <script>
                                $('#tbl-grid_filter > label > input.form-control').val('');
                            </script>
                            ";
						}
					}
					else
					{
						if($kowil == $getkodekolok1)
						{
							//lengkap
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
										$htmladduser
										$html_formmati
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
							//tidak lengkap
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
			else {
				
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
				/*if ($this->user['user_group']=='10' && substr($peg1->KOLOK,0,1) == $this->user['kowil']){
					
					

					$html_reset_pass="<div class='col-sm-4' align='center'>
											<button class='btn btn-outline btn-xs btn-warning' data-toggle='tool-tip' title='Reset password pegawai' pull-right onclick='ResetPassword(&#39;".$row->NRK."&#39;)'><i class='fa fa-key'></i></button>
									</div>";

					$htmladduser="<div class='col-sm-3' align='center'>
										<button class='btn btn-outline btn-xs btn-info' data-toggle='tool-tip' title='tambah user akun pegawai' pull-right onclick='TambahUser(&#39;".$row->NRK."&#39;)'><i class='fa fa-flag-checkered'></i></button>
										</div>";	
					$html_formmati="<div class='col-sm-3' align='center'>
										<button class='btn btn-outline btn-xs btn-danger' data-toggle='tool-tip' title='Form Kematian ' pull-right onclick='FormKematian(&#39;".$row->NRK."&#39;,&#39;".$penginput."&#39;)'><i class='fa fa-times'></i></button>
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
										$htmladduser
										$html_formmati
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

						$htmladduser="<div class='col-sm-3' align='center'>
										<button class='btn btn-outline btn-xs btn-info' data-toggle='tool-tip' title='tambah user akun pegawai' pull-right onclick='TambahUser(&#39;".$row->NRK."&#39;)'><i class='fa fa-flag-checkered'></i></button>
										</div>";	
						$html_formmati="<div class='col-sm-3' align='center'>
										<button class='btn btn-outline btn-xs btn-danger' data-toggle='tool-tip' title='Form Kematian ' pull-right onclick='FormKematian(&#39;".$row->NRK."&#39;,&#39;".$penginput."&#39;)'><i class='fa fa-times'></i></button>
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
										$htmladduser
										$html_formmati
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
					
				}*/
					
			}
			
			

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

	

	

	public function doeditaction2(){
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


	function form_kematian(){
		 
		      
		$id = $this->input->post('NRK');
		$penginput = $this->input->post('penginput');
		$data = $this->mdl->cekDataMatiPegawai($id);
		$lastdata = $this->mdl->getDataTerakhirPegawai($id);

		
			echo '
			<div class="modal-dialog" role="document" id="pesan">
		        <form class="form-horizontal" id="formPass" action="javascript:updateDataPeg();" method="POST">                
		            <div class="modal-content">
		            <div class="modal-header">
		                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		                <h4 class="modal-title" id="modalUmumTitle">Form Data Kematian<i> '; 
		                echo $data->NRK; echo '-';
		                echo $data->NAMA;	echo '</i></h4>
		                <input type="hidden" id="NRK" name="NRK" value="' ; echo $id; echo'">
		                <input type="hidden" id="penginput" name="penginput" value="' ; echo $penginput; echo'">
		            </div>
		            <div class="modal-body">
		                


		                <div class="form-group" id="data_2">
                        	<label class="col-sm-4 control-label">Tgl. Mati</label>
                        	<div class="input-group col-sm-7 date">
                            	<span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" id="tgmati" name="tgmati" placeholder="Tgl. Mati" value="';echo $data->TGMATI; echo
                            	  '" class="form-control" readonly="readonly">
                       	 	</div>
                    	</div>

		                <div class="form-group" id="data_3">
                        	<label class="col-sm-4 control-label">Tgl. Surat Mati</label>
                        	<div class="input-group col-sm-7 date">
                            	<span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" id="tgsuratmati" name="tgsuratmati" placeholder="Tgl. Surat Mati" value="';echo $data->TGSURATMATI; echo
                            	  '" class="form-control" readonly="readonly">
                       	 	</div>
                    	</div>

                    	<div class="form-group">
                        	<label class="col-sm-4 control-label">No. Surat Mati</label>
                        	<div class="input-group col-sm-7">
                            	<input class="form-control" maxlength="50" type="text" id="nosuratmati" placeholder="No. Surat Mati" name="nosuratmati" value="';echo $data->NOSURATMATI; echo'">
                       	 	</div>
                    	</div>

                    	<div class="form-group">
                        	<label class="col-sm-4 control-label">Asal Surat Mati (Dikeluarkan Oleh)</label>
                        	<div class="input-group col-sm-7">
                            	<input class="form-control" maxlength="200" type="text" id="asalsuratmati" placeholder="Asal Surat Mati" name="asalsuratmati" value="';echo $data->ASALSURATMATI; echo'">
                       	 	</div>
                    	</div>

		                <span class="text-danger" id="warning"></span>
		                   
		    
		            </div>
		                <div class="modal-footer">
		                    <button type="button" class="btn btn-default dim" data-dismiss="modal" id="tutupModal">Tutup</button>
		                    <button type="submit" class="btn btn-primary dim">Simpan</button>
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
                    endDate: new Date()
                });

            	$("#data_3 .input-group.date").datepicker({
                    todayBtn: "linked",
                    keyboardNavigation: false,
                    forceParse: false,
                    calendarWeeks: true,
                    autoclose: true,
                    format: "dd-mm-yyyy",
                    endDate: new Date()
                });
            });

		    	

			    function updateDataPeg(){
			        var url = "'.site_url("pegawai/UpdateDapeg").'";
			        $.ajax({
			            url: url,
			            type: "POST",
			            data: $("#formPass").serialize(),
			            dataType: "json",
			            beforeSend: function() {                
			                var tgmati = $("#tgmati").val();
			                var tgsuratmati = $("#tgsuratmati").val();
			                var nosuratmati = $("#nosuratmati").val();
			                if(tgmati == ""){
			                    $("#warning").html("Tanggal Mati Wajib Diisi");
			                    return false;
			                }
			                else if(tgsuratmati=="")
			                {
			                	$("#warning").html("Tanggal Surat Mati Wajib Diisi");
			                    return false;
			                }
			                else if(nosuratmati=="")
			                {
			                	$("#warning").html("No Surat Mati Wajib Diisi");
			                    return false;
			                }
			                else{
			                    $("#warning").html();     
			                                 
			                }

			                
			               
			            },
			            success: function(data) {                               
			                
			                if(data.responupd == "SUKSES"){
			                    swal("Sukses!", "Perbarui Data Pegawai berhasil", "success");                    
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

	function UpdateDapeg(){
		$nrk = $this->input->post('NRK');
		$penginput = $this->input->post('penginput');

		//format tgmati
		$tgmati = $this->input->post('tgmati');
		$tgsuratmati = $this->input->post('tgsuratmati');
		$nosuratmati = $this->input->post('nosuratmati');
		$asalsuratmati = $this->input->post('asalsuratmati');
		$today = Date('m-Y');

		// format tanggal mati
		$tahunmati = substr($tgmati,6,4);
		$bulanmati = substr($tgmati,3,2);
		
		//format tanggal sekarang
		$tahunnow = substr($today,3,4);
		$bulannow = substr($today,0,2);

		
		$bulanmatitemp;
		$bulannowtemp;

		//cek bulan
		//get digit bulan mati tanpa 0
		if(substr($bulanmati,0,1)=='0')
		{
			$bulanmatitemp = substr($bulanmati,1,1);
			// ct : 04 => 4 
		}
		else
		{
			$bulanmatitemp = $bulanmati;
			//ct : 10 => 10
		}

		//get digit bulan sekarang tanpa 0
		if(substr($bulannow,0,1)=='0')
		{
			$bulannowtemp = substr($bulannow,1,1);
			// ct : 04 => 4 
		}
		else
		{
			$bulannowtemp = $bulannow;
			//ct : 10 => 10
		}


		//cek tahun
		$selisihbulan=0;
		$selisihtahun=0;

		//jika tahun sama maka cek selisih bulan
		if($tahunnow == $tahunmati)
		{
			$selisihbulan = $bulannowtemp - $bulanmatitemp;
		}
		//jika tahun beda,hitung selisih tahun kemudian selisih bulan
		else
		{
			$selisihtahun = $tahunnow - $tahunmati;
			
			$selisihbulan = ($selisihtahun * 12)+$bulannowtemp-$bulanmatitemp;
		}

		$respon;
		
		if($selisihbulan<=4)
		{
			//hanya update tgmati,tgsuratmati,nosuratmati,dan useridmati
			$query  = $this->mdl->updatepeg1blm4bulan($nrk,$tgmati,$tgsuratmati,$nosuratmati,$penginput,$asalsuratmati);
			if($query)
			{
				$respon = "SUKSES";
			}
			else
			{
				$respon = "GAGAL";
			}
		}
		else
		{
			$query  = $this->mdl->updatepeg1sdh4bulan($nrk,$tgmati,$tgsuratmati,$nosuratmati,$penginput,$asalsuratmati);
			if($query)
			{
				$respon = "SUKSES";
			}
			else
			{
				$respon = "GAGAL";
			}

		}
		
		$return = array('responupd' => $respon);

        echo json_encode($return);
	}

	public function cekJumlahDapeg()
	{
		$wh_ukpd="";
 		$whspmu="";
 		$wh_bkdk3="";
 		if($this->session->userdata('logged_in')['user_group']=='5')
		{
			$username = $this->user['id'] ;

            	$getspmu = "SELECT * FROM PERS_TABEL_SPMU WHERE KODE_UNIT_SIPKD ='$username'";
            	$querygetspmu = $this->db->query($getspmu);
            	$numspm = $querygetspmu->num_rows();

            	if($numspm == 0)
            	{
            		$whspmu = " AND 3=3 ";
            	}
	            else if($numspm == 1)
	            {
	                $spmu = $querygetspmu->row()->KODE_SPM;

	                $whspmu = " AND A.SPMU='$spmu' ";
	                

	            }
	            else 
	            {
	                $arrayspmu = $querygetspmu->result();
	                

	                foreach ($arrayspmu  as $value) {
	                    # code...
	                    
	                    $spmu[] = $value->KODE_SPM;
	                }
	                $quewh="";
	                for($i=0;$i<$numspm;$i++)
	                {

	                    $quewh.= "'".$spmu[$i]."'";
	                    if($i<$numspm-1)
	                    {
	                        $quewh.=",";
	                    }
	                }
	                
	                $whspmu = " AND A.SPMU IN (".$quewh.") ";
	                
	            }
	    }
	    else if($this->session->userdata('logged_in')['user_group']=='47')
		{
				$idukpd = $this->user['id'];
				 $cekkolok = "SELECT a.kolok,a.nalok,a.spmu,a.kode_unit_sipkd,b.\"user_id\" 
                        from pers_klogad3 a
                        LEFT JOIN \"master_user\" b on a.kode_unit_sipkd = b.\"user_id\" 
                        where b.\"user_id\" = '$idukpd'";
                        //die($cekkolok);
            	$querycekkolok = $this->db->query($cekkolok);
            	if($querycekkolok) 
            	{
                	$reskolok=$querycekkolok->row()->KOLOK;
                	$wh_ukpd=" AND A.KLOGAD = '$reskolok'";   
            	}
            	else
            	{
            		$wh_ukpd=" AND 2=2";	
            	}

            	
		}
		else if($this->session->userdata('logged_in')['user_group']=='10')
		{
			if($this->user['kowil'] =='1')
            {
                $wh_bkdk3=" AND kolok LIKE '".$this->user['kowil']."%' AND substr(kolok,2,1)!='1'";
            }
            else if($this->user['kowil']=='11')
            {
                $wh_bkdk3=" AND kolok LIKE '".$this->user['kowil']."%' and substr(kolok,2,1)='1'";
            }
            else if($this->user['kowil']=='')
            {
                $wh_bkdk3=" AND 2=2";
            }
            else
            {
                $wh_bkdk3=" AND kolok LIKE '".$this->user['kowil']."%'";
            }
		}
 		 
		
		$sqlquery = "SELECT count(*) CT FROM VW_DATAPEG_PERSKPD A where 1=1
			$whspmu
			$wh_ukpd
			$wh_bkdk3
		";
		
 		$queryex = $this->db->query($sqlquery)->result();
 		//$queryex = $this->prod->query($sqlquery)->result();

 		$hasilcekdata = $queryex[0]->CT;

 		$response =  array(
		        'jml' => $hasilcekdata
		        
		    ); 

		echo json_encode($response);
	}

	public function export_excel_dapeg()
 	{
 		$wh_ukpd="";
 		$whspmu="";
 		if($this->session->userdata('logged_in')['user_group']=='5')
		{
			$username = $this->user['id'] ;

            	$getspmu = "SELECT * FROM PERS_TABEL_SPMU WHERE KODE_UNIT_SIPKD ='$username'";
            	$querygetspmu = $this->db->query($getspmu);
            	$numspm = $querygetspmu->num_rows();

            	if($numspm == 0)
            	{
            		$whspmu = " AND 3=3 ";
            	}
	            else if($numspm == 1)
	            {
	                $spmu = $querygetspmu->row()->KODE_SPM;

	                $whspmu = " AND A.SPMU='$spmu' ";
	                

	            }
	            else 
	            {
	                $arrayspmu = $querygetspmu->result();
	                

	                foreach ($arrayspmu  as $value) {
	                    # code...
	                    
	                    $spmu[] = $value->KODE_SPM;
	                }
	                $quewh="";
	                for($i=0;$i<$numspm;$i++)
	                {

	                    $quewh.= "'".$spmu[$i]."'";
	                    if($i<$numspm-1)
	                    {
	                        $quewh.=",";
	                    }
	                }
	                
	                $whspmu = " AND A.SPMU IN (".$quewh.") ";
	                
	            }
	    }
	    else if($this->session->userdata('logged_in')['user_group']=='47')
		{
				$idukpd = $this->user['id'];
				 $cekkolok = "SELECT a.kolok,a.nalok,a.spmu,a.kode_unit_sipkd,b.\"user_id\" 
                        from pers_klogad3 a
                        LEFT JOIN \"master_user\" b on a.kode_unit_sipkd = b.\"user_id\" 
                        where b.\"user_id\" = '$idukpd'";
                        //die($cekkolok);
            	$querycekkolok = $this->db->query($cekkolok);
            	if($querycekkolok) 
            	{
                	$reskolok=$querycekkolok->row()->KOLOK;
                	$wh_ukpd=" AND (A.KLOGAD = '$reskolok' OR A.KOLOK IN (SELECT KOLOK FROM UNIT_DISDIK WHERE KOLOK_SUDIN='$reskolok'))";   
            	}
            	else
            	{
            		$wh_ukpd=" AND 2=2";	
            	}

            	
		}
 		     
		/*if($this->session->userdata('logged_in')['user_group']=='47')
		{
			$sqlquery = "SELECT ROWNUM AS RN,A.* FROM VW_DATAPEG_PERSKPD A 
						where 1=1
			$whspmu
			$wh_ukpd
		";
		}
		else
		{*/
			$sqlquery = "SELECT ROWNUM AS RN,A.* FROM VW_DATAPEG_PERSKPD A where 1=1
			$whspmu
			$wh_ukpd
		";
		//}
		
 		$queryex = $this->db->query($sqlquery)->result();
 		//$queryex = $this->prod->query($sqlquery)->result();
 		$filename = "DATA PEGAWAI.csv";
 		


 		$this->load->library("phpexcel/PHPExcel");

		// Create new PHPExcel object
		$objPHPExcel = new PHPExcel();

		// Set document properties
		$objPHPExcel->getProperties()->setCreator("Data Pegawai Per Wilayah - Provinsi DKI Jakarta")
									 ->setLastModifiedBy("BKD - Provinsi DKI Jakarta")
									 ->setTitle("Laporan Data Pegawai Per Wilayah")
									 ->setSubject("Laporan Data Pegawai")
									 ->setDescription("Laporan Data Pegawai Per Wilayah DKI Provinsi DKI Jakarta.")
									 ->setKeywords("Data Pegawai")
									 ->setCategory("Data Pegawai")
									 ->setCompany("BKD Provinsi DKI Jakarta");

		$arrMonth = array('01' => 'Januari', '02' => 'Februari', '03' => 'Maret', '04' => 'April', '05' => 'Mei', '06' => 'Juni', '07' => 'Juli', '08' => 'Agustus', '09' => 'September', '10' => 'Oktober', '11' => 'November', '12' => 'Desember');
		$objPHPExcel->setActiveSheetIndex(0);
        
		$objPHPExcel->getActiveSheet()->setCellValue('A1', 'No');
		$objPHPExcel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$objPHPExcel->getActiveSheet()->setCellValue('B1', 'NRK');
		$objPHPExcel->getActiveSheet()->getStyle('B1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$objPHPExcel->getActiveSheet()->setCellValue('C1', 'NAMA');
		$objPHPExcel->getActiveSheet()->getStyle('C1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$objPHPExcel->getActiveSheet()->setCellValue('D1', 'NIP');
		$objPHPExcel->getActiveSheet()->getStyle('D1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$objPHPExcel->getActiveSheet()->setCellValue('E1', 'NIP18');
		$objPHPExcel->getActiveSheet()->getStyle('E1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$objPHPExcel->getActiveSheet()->setCellValue('F1', 'GOL');
		$objPHPExcel->getActiveSheet()->getStyle('F1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$objPHPExcel->getActiveSheet()->setCellValue('G1', 'TMT PANGKAT');
		$objPHPExcel->getActiveSheet()->getStyle('G1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$objPHPExcel->getActiveSheet()->setCellValue('H1', 'ESELON');
		$objPHPExcel->getActiveSheet()->getStyle('H1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$objPHPExcel->getActiveSheet()->setCellValue('I1', 'JABATAN');
		$objPHPExcel->getActiveSheet()->getStyle('I1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$objPHPExcel->getActiveSheet()->setCellValue('J1', 'TMT ESELON');
		$objPHPExcel->getActiveSheet()->getStyle('J1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$objPHPExcel->getActiveSheet()->setCellValue('K1', 'TMT CPNS');
		$objPHPExcel->getActiveSheet()->getStyle('K1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$objPHPExcel->getActiveSheet()->setCellValue('L1', 'TANGGAL LAHIR');
		$objPHPExcel->getActiveSheet()->getStyle('L1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$objPHPExcel->getActiveSheet()->setCellValue('M1', 'TEMPAT LAHIR');
		$objPHPExcel->getActiveSheet()->getStyle('M1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$objPHPExcel->getActiveSheet()->setCellValue('N1', 'MASA KERJA');
		$objPHPExcel->getActiveSheet()->getStyle('N1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$objPHPExcel->getActiveSheet()->setCellValue('O1', 'STATUS PEGAWAI');
		$objPHPExcel->getActiveSheet()->getStyle('O1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$objPHPExcel->getActiveSheet()->setCellValue('P1', 'JENIS KELAMIN');
		$objPHPExcel->getActiveSheet()->getStyle('P1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$objPHPExcel->getActiveSheet()->setCellValue('Q1', 'AGAMA');
		$objPHPExcel->getActiveSheet()->getStyle('Q1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$objPHPExcel->getActiveSheet()->setCellValue('R1', 'LOKASI GAJI');
		$objPHPExcel->getActiveSheet()->getStyle('R1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$objPHPExcel->getActiveSheet()->setCellValue('S1', 'SKPD');
		$objPHPExcel->getActiveSheet()->getStyle('S1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$objPHPExcel->getActiveSheet()->setCellValue('T1', 'UMUR');
		$objPHPExcel->getActiveSheet()->getStyle('T1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$objPHPExcel->getActiveSheet()->setCellValue('U1', 'KODE JABATAN');
		$objPHPExcel->getActiveSheet()->getStyle('U1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	

		// Set column widths
		$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(10);
		$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(15);
		$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(50);
		$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(15);		
		$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(25);
		$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(15);
		$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(15);
		$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(25);
		$objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(50);
		$objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(15);
		$objPHPExcel->getActiveSheet()->getColumnDimension('K')->setWidth(15);
		$objPHPExcel->getActiveSheet()->getColumnDimension('L')->setWidth(15);
		$objPHPExcel->getActiveSheet()->getColumnDimension('M')->setWidth(30);
		$objPHPExcel->getActiveSheet()->getColumnDimension('N')->setWidth(15);
		$objPHPExcel->getActiveSheet()->getColumnDimension('O')->setWidth(15);
		$objPHPExcel->getActiveSheet()->getColumnDimension('P')->setWidth(25);
		$objPHPExcel->getActiveSheet()->getColumnDimension('Q')->setWidth(20);
		$objPHPExcel->getActiveSheet()->getColumnDimension('R')->setWidth(70);
		$objPHPExcel->getActiveSheet()->getColumnDimension('S')->setWidth(70);
		$objPHPExcel->getActiveSheet()->getColumnDimension('T')->setWidth(15);
		$objPHPExcel->getActiveSheet()->getColumnDimension('U')->setWidth(15);
	
		$i=2;
		
		
		foreach($queryex as $row){
			


			$objPHPExcel->getActiveSheet()->setCellValue('A'.$i, $row->RN);									
			$objPHPExcel->getActiveSheet()->setCellValue('B'.$i, '`'.$row->NRK);
			$objPHPExcel->getActiveSheet()->setCellValue('C'.$i, $row->NAMA);
			$objPHPExcel->getActiveSheet()->setCellValue('D'.$i, '`'.$row->NIP);
			$objPHPExcel->getActiveSheet()->setCellValue('E'.$i, '`'.$row->NIP18);
			$objPHPExcel->getActiveSheet()->setCellValue('F'.$i, $row->GOL);
			$objPHPExcel->getActiveSheet()->setCellValue('G'.$i, $row->TMTPANGKAT);	
			$objPHPExcel->getActiveSheet()->setCellValue('H'.$i, $row->ESELON);
			$objPHPExcel->getActiveSheet()->setCellValue('I'.$i, $row->NAJABL);
			$objPHPExcel->getActiveSheet()->setCellValue('J'.$i, $row->TMTESELON);
			$objPHPExcel->getActiveSheet()->setCellValue('K'.$i, $row->MUANG);
			$objPHPExcel->getActiveSheet()->setCellValue('L'.$i, $row->TALHIR);
			$objPHPExcel->getActiveSheet()->setCellValue('M'.$i, $row->PATHIR);
			$objPHPExcel->getActiveSheet()->setCellValue('N'.$i, $row->MASKER);
			$objPHPExcel->getActiveSheet()->setCellValue('O'.$i, $row->STAPEG);
			$objPHPExcel->getActiveSheet()->setCellValue('P'.$i, $row->JENKEL);
			$objPHPExcel->getActiveSheet()->setCellValue('Q'.$i, $row->AGAMA);
			$objPHPExcel->getActiveSheet()->setCellValue('R'.$i, $row->LOKASI_GAJI);
			$objPHPExcel->getActiveSheet()->setCellValue('S'.$i, $row->SKPD);
			$objPHPExcel->getActiveSheet()->setCellValue('T'.$i, $row->UMUR);
			$objPHPExcel->getActiveSheet()->setCellValue('U'.$i, $row->KD);
			

			$i++;			
			
		}
		// $objPHPExcel->getActiveSheet()->getStyle('A5:K'.($totalData+1))->applyFromArray($styleThinBlackBorderOutline);

	

		// =======================================================================================================

		// Set header and footer. When no different headers for odd/even are used, odd header is assumed.		
		$objPHPExcel->getActiveSheet()->getHeaderFooter()->setOddHeader('&L&B '. $objPHPExcel->getProperties()->getTitle() .' &RPrinted on &D');
		$objPHPExcel->getActiveSheet()->getHeaderFooter()->setOddFooter('&L&B' . $objPHPExcel->getProperties()->getTitle() . '&RPage &P of &N');

		// Set page orientation and size		
		$objPHPExcel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);
		$objPHPExcel->getActiveSheet()->getPageSetup()->setPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_A4);

		$objPHPExcel->getActiveSheet()->getTabColor()->setARGB('FF0094FF');

		// Rename worksheet
		$objPHPExcel->getActiveSheet()->setTitle('sheet1');		

		// Set active sheet index to the first sheet, so Excel opens this as the first sheet
		
		$objPHPExcel->getActiveSheet()->getSheetView()->setZoomScale(80);		
		
		//UNTUK CREATE ANOTHER SHEET IN SAME FILE		
		//$objPHPExcel->createSheet(1);	
		//$objPHPExcel->setActiveSheetIndex(1);
        

		// =======================================================================================================

		// Set header and footer. When no different headers for odd/even are used, odd header is assumed.		
		$objPHPExcel->getActiveSheet()->getHeaderFooter()->setOddHeader('&L&B '. $objPHPExcel->getProperties()->getTitle() .' &RPrinted on &D');
		$objPHPExcel->getActiveSheet()->getHeaderFooter()->setOddFooter('&L&B' . $objPHPExcel->getProperties()->getTitle() . '&RPage &P of &N');

		// Set page orientation and size		
		$objPHPExcel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);
		$objPHPExcel->getActiveSheet()->getPageSetup()->setPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_A4);

		$objPHPExcel->getActiveSheet()->getTabColor()->setARGB('FF0094FF');

	

	
		
		$objPHPExcel->getActiveSheet()->getSheetView()->setZoomScale(80);	


		// Redirect output to a client’s web browser (Excel2007)
		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment;filename="Laporan_SKP"');
		header('Cache-Control: max-age=0');
		// If you're serving to IE 9, then the following may be needed
		header('Cache-Control: max-age=1');

		// If you're serving to IE over SSL, then the following may be needed
		header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
		header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
		header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
		header ('Pragma: public'); // HTTP/1.0

		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
		
		ob_start();
		$objWriter->save('php://output');
		
		$xlsData = ob_get_contents();
		ob_end_clean();

		$response =  array(
		        'op' => 'ok',
		        'file' => "data:application/vnd.ms-excel;base64,".base64_encode($xlsData),
		        'filename' => $filename
		    ); 

		echo json_encode($response);
	}

	public function export_excel_dapeg1()
 	{
 		$wh_ukpd="";
 		$whspmu="";
 		$wh_bkdk3="";
 		if($this->session->userdata('logged_in')['user_group']=='5')
		{
			$username = $this->user['id'] ;

            	$getspmu = "SELECT * FROM PERS_TABEL_SPMU WHERE KODE_UNIT_SIPKD ='$username'";
            	$querygetspmu = $this->db->query($getspmu);
            	$numspm = $querygetspmu->num_rows();

            	if($numspm == 0)
            	{
            		$whspmu = " AND 3=3 ";
            	}
	            else if($numspm == 1)
	            {
	                $spmu = $querygetspmu->row()->KODE_SPM;

	                $whspmu = " AND A.SPMU='$spmu' ";
	                

	            }
	            else 
	            {
	                $arrayspmu = $querygetspmu->result();
	                

	                foreach ($arrayspmu  as $value) {
	                    # code...
	                    
	                    $spmu[] = $value->KODE_SPM;
	                }
	                $quewh="";
	                for($i=0;$i<$numspm;$i++)
	                {

	                    $quewh.= "'".$spmu[$i]."'";
	                    if($i<$numspm-1)
	                    {
	                        $quewh.=",";
	                    }
	                }
	                
	                $whspmu = " AND A.SPMU IN (".$quewh.") ";
	                
	            }
	    }
	    else if($this->session->userdata('logged_in')['user_group']=='47')
		{
				$idukpd = $this->user['id'];
				 $cekkolok = "SELECT a.kolok,a.nalok,a.spmu,a.kode_unit_sipkd,b.\"user_id\" 
                        from pers_klogad3 a
                        LEFT JOIN \"master_user\" b on a.kode_unit_sipkd = b.\"user_id\" 
                        where b.\"user_id\" = '$idukpd'";
                        //die($cekkolok);
            	$querycekkolok = $this->db->query($cekkolok);
            	if($querycekkolok) 
            	{
                	$reskolok=$querycekkolok->row()->KOLOK;
                	$wh_ukpd=" AND A.KLOGAD = '$reskolok'";   
            	}
            	else
            	{
            		$wh_ukpd=" AND 2=2";	
            	}

            	
		}
		else if($this->session->userdata('logged_in')['user_group']=='10')
		{
			if($this->user['kowil'] =='1')
            {
                $wh_bkdk3=" AND kolok LIKE '".$this->user['kowil']."%' AND substr(kolok,2,1)!='1'";
            }
            else if($this->user['kowil']=='11')
            {
                $wh_bkdk3=" AND kolok LIKE '".$this->user['kowil']."%' and substr(kolok,2,1)='1'";
            }
            else if($this->user['kowil']=='')
            {
                $wh_bkdk3=" AND 2=2";
            }
            else
            {
                $wh_bkdk3=" AND kolok LIKE '".$this->user['kowil']."%'";
            }
		}
 		 
	/*	if($this->session->userdata('logged_in')['user_group']=='47')
		{
			$sqlquery = "SELECT ROWNUM AS RN,A.* FROM VW_DATAPEG_PERSKPD A 
						LEFT JOIN UNIT_DISDIK UD ON A.KLOGAD = UD.KOLOK_SUDIN where 1=1
			$whspmu
			$wh_ukpd
		";
		}
		else
		{
			$sqlquery = "SELECT ROWNUM AS RN,A.* FROM VW_DATAPEG_PERSKPD A where 1=1
			$whspmu
			$wh_ukpd
			$wh_bkdk3
		";
		}*/

		$sqlquery = "SELECT ROWNUM AS RN,A.* FROM VW_DATAPEG_PERSKPD A where 1=1
			$whspmu
			$wh_ukpd
			$wh_bkdk3
		";

		$sqlquery.=" AND NRK <= 170000 ORDER BY NRK ASC";
		
 		$queryex = $this->db->query($sqlquery)->result();
 		//$queryex = $this->prod->query($sqlquery)->result();
 		$filename = "DATA PEGAWAI part1.csv";
 		


 		$this->load->library("phpexcel/PHPExcel");

		// Create new PHPExcel object
		$objPHPExcel = new PHPExcel();

		// Set document properties
		$objPHPExcel->getProperties()->setCreator("Data Pegawai Per Wilayah - Provinsi DKI Jakarta")
									 ->setLastModifiedBy("BKD - Provinsi DKI Jakarta")
									 ->setTitle("Laporan Data Pegawai Per Wilayah")
									 ->setSubject("Laporan Data Pegawai")
									 ->setDescription("Laporan Data Pegawai Per Wilayah DKI Provinsi DKI Jakarta.")
									 ->setKeywords("Data Pegawai")
									 ->setCategory("Data Pegawai")
									 ->setCompany("BKD Provinsi DKI Jakarta");

		$arrMonth = array('01' => 'Januari', '02' => 'Februari', '03' => 'Maret', '04' => 'April', '05' => 'Mei', '06' => 'Juni', '07' => 'Juli', '08' => 'Agustus', '09' => 'September', '10' => 'Oktober', '11' => 'November', '12' => 'Desember');
		$objPHPExcel->setActiveSheetIndex(0);
        
		$objPHPExcel->getActiveSheet()->setCellValue('A1', 'No');
		$objPHPExcel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$objPHPExcel->getActiveSheet()->setCellValue('B1', 'NRK');
		$objPHPExcel->getActiveSheet()->getStyle('B1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$objPHPExcel->getActiveSheet()->setCellValue('C1', 'NAMA');
		$objPHPExcel->getActiveSheet()->getStyle('C1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$objPHPExcel->getActiveSheet()->setCellValue('D1', 'NIP');
		$objPHPExcel->getActiveSheet()->getStyle('D1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$objPHPExcel->getActiveSheet()->setCellValue('E1', 'NIP18');
		$objPHPExcel->getActiveSheet()->getStyle('E1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$objPHPExcel->getActiveSheet()->setCellValue('F1', 'GOL');
		$objPHPExcel->getActiveSheet()->getStyle('F1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$objPHPExcel->getActiveSheet()->setCellValue('G1', 'TMT PANGKAT');
		$objPHPExcel->getActiveSheet()->getStyle('G1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$objPHPExcel->getActiveSheet()->setCellValue('H1', 'ESELON');
		$objPHPExcel->getActiveSheet()->getStyle('H1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$objPHPExcel->getActiveSheet()->setCellValue('I1', 'JABATAN');
		$objPHPExcel->getActiveSheet()->getStyle('I1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$objPHPExcel->getActiveSheet()->setCellValue('J1', 'TMT ESELON');
		$objPHPExcel->getActiveSheet()->getStyle('J1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$objPHPExcel->getActiveSheet()->setCellValue('K1', 'TMT CPNS');
		$objPHPExcel->getActiveSheet()->getStyle('K1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$objPHPExcel->getActiveSheet()->setCellValue('L1', 'TANGGAL LAHIR');
		$objPHPExcel->getActiveSheet()->getStyle('L1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$objPHPExcel->getActiveSheet()->setCellValue('M1', 'TEMPAT LAHIR');
		$objPHPExcel->getActiveSheet()->getStyle('M1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$objPHPExcel->getActiveSheet()->setCellValue('N1', 'MASA KERJA');
		$objPHPExcel->getActiveSheet()->getStyle('N1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$objPHPExcel->getActiveSheet()->setCellValue('O1', 'STATUS PEGAWAI');
		$objPHPExcel->getActiveSheet()->getStyle('O1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$objPHPExcel->getActiveSheet()->setCellValue('P1', 'JENIS KELAMIN');
		$objPHPExcel->getActiveSheet()->getStyle('P1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$objPHPExcel->getActiveSheet()->setCellValue('Q1', 'AGAMA');
		$objPHPExcel->getActiveSheet()->getStyle('Q1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		
		$objPHPExcel->getActiveSheet()->setCellValue('R1', 'LOKASI GAJI');
		$objPHPExcel->getActiveSheet()->getStyle('R1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$objPHPExcel->getActiveSheet()->setCellValue('S1', 'SKPD');
		$objPHPExcel->getActiveSheet()->getStyle('S1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$objPHPExcel->getActiveSheet()->setCellValue('T1', 'UMUR');
		$objPHPExcel->getActiveSheet()->getStyle('T1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$objPHPExcel->getActiveSheet()->setCellValue('U1', 'KODE JABATAN');
		$objPHPExcel->getActiveSheet()->getStyle('U1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	

		// Set column widths
		$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(10);
		$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(15);
		$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(50);
		$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(15);		
		$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(25);
		$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(15);
		$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(15);
		$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(25);
		$objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(50);
		$objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(15);
		$objPHPExcel->getActiveSheet()->getColumnDimension('K')->setWidth(15);
		$objPHPExcel->getActiveSheet()->getColumnDimension('L')->setWidth(15);
		$objPHPExcel->getActiveSheet()->getColumnDimension('M')->setWidth(30);
		$objPHPExcel->getActiveSheet()->getColumnDimension('N')->setWidth(15);
		$objPHPExcel->getActiveSheet()->getColumnDimension('O')->setWidth(15);
		$objPHPExcel->getActiveSheet()->getColumnDimension('P')->setWidth(25);
		$objPHPExcel->getActiveSheet()->getColumnDimension('Q')->setWidth(20);
		$objPHPExcel->getActiveSheet()->getColumnDimension('R')->setWidth(70);
		$objPHPExcel->getActiveSheet()->getColumnDimension('S')->setWidth(70);
		$objPHPExcel->getActiveSheet()->getColumnDimension('T')->setWidth(15);
		$objPHPExcel->getActiveSheet()->getColumnDimension('U')->setWidth(15);
		
	
		$i=2;
		
		
		foreach($queryex as $row){
			


			$objPHPExcel->getActiveSheet()->setCellValue('A'.$i, $row->RN);									
			$objPHPExcel->getActiveSheet()->setCellValue('B'.$i, '`'.$row->NRK);
			$objPHPExcel->getActiveSheet()->setCellValue('C'.$i, $row->NAMA);
			$objPHPExcel->getActiveSheet()->setCellValue('D'.$i, '`'.$row->NIP);
			$objPHPExcel->getActiveSheet()->setCellValue('E'.$i, '`'.$row->NIP18);
			$objPHPExcel->getActiveSheet()->setCellValue('F'.$i, $row->GOL);
			$objPHPExcel->getActiveSheet()->setCellValue('G'.$i, $row->TMTPANGKAT);	
			$objPHPExcel->getActiveSheet()->setCellValue('H'.$i, $row->ESELON);
			$objPHPExcel->getActiveSheet()->setCellValue('I'.$i, $row->NAJABL);
			$objPHPExcel->getActiveSheet()->setCellValue('J'.$i, $row->TMTESELON);
			$objPHPExcel->getActiveSheet()->setCellValue('K'.$i, $row->MUANG);
			$objPHPExcel->getActiveSheet()->setCellValue('L'.$i, $row->TALHIR);
			$objPHPExcel->getActiveSheet()->setCellValue('M'.$i, $row->PATHIR);
			$objPHPExcel->getActiveSheet()->setCellValue('N'.$i, $row->MASKER);
			$objPHPExcel->getActiveSheet()->setCellValue('O'.$i, $row->STAPEG);
			$objPHPExcel->getActiveSheet()->setCellValue('P'.$i, $row->JENKEL);
			$objPHPExcel->getActiveSheet()->setCellValue('Q'.$i, $row->AGAMA);
			
			$objPHPExcel->getActiveSheet()->setCellValue('R'.$i, $row->LOKASI_GAJI);
			$objPHPExcel->getActiveSheet()->setCellValue('S'.$i, $row->SKPD);
			$objPHPExcel->getActiveSheet()->setCellValue('T'.$i, $row->UMUR);
			$objPHPExcel->getActiveSheet()->setCellValue('U'.$i, $row->KD);
			

			$i++;			
			
		}
		// $objPHPExcel->getActiveSheet()->getStyle('A5:K'.($totalData+1))->applyFromArray($styleThinBlackBorderOutline);

	

		// =======================================================================================================

		// Set header and footer. When no different headers for odd/even are used, odd header is assumed.		
		$objPHPExcel->getActiveSheet()->getHeaderFooter()->setOddHeader('&L&B '. $objPHPExcel->getProperties()->getTitle() .' &RPrinted on &D');
		$objPHPExcel->getActiveSheet()->getHeaderFooter()->setOddFooter('&L&B' . $objPHPExcel->getProperties()->getTitle() . '&RPage &P of &N');

		// Set page orientation and size		
		$objPHPExcel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);
		$objPHPExcel->getActiveSheet()->getPageSetup()->setPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_A4);

		$objPHPExcel->getActiveSheet()->getTabColor()->setARGB('FF0094FF');

		// Rename worksheet
		$objPHPExcel->getActiveSheet()->setTitle('sheet1');		

		// Set active sheet index to the first sheet, so Excel opens this as the first sheet
		
		$objPHPExcel->getActiveSheet()->getSheetView()->setZoomScale(80);		
		
		//UNTUK CREATE ANOTHER SHEET IN SAME FILE		
		//$objPHPExcel->createSheet(1);	
		//$objPHPExcel->setActiveSheetIndex(1);
        

		// =======================================================================================================

		// Set header and footer. When no different headers for odd/even are used, odd header is assumed.		
		$objPHPExcel->getActiveSheet()->getHeaderFooter()->setOddHeader('&L&B '. $objPHPExcel->getProperties()->getTitle() .' &RPrinted on &D');
		$objPHPExcel->getActiveSheet()->getHeaderFooter()->setOddFooter('&L&B' . $objPHPExcel->getProperties()->getTitle() . '&RPage &P of &N');

		// Set page orientation and size		
		$objPHPExcel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);
		$objPHPExcel->getActiveSheet()->getPageSetup()->setPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_A4);

		$objPHPExcel->getActiveSheet()->getTabColor()->setARGB('FF0094FF');

	

	
		
		$objPHPExcel->getActiveSheet()->getSheetView()->setZoomScale(80);	


		// Redirect output to a client’s web browser (Excel2007)
		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment;filename="Laporan_SKP"');
		header('Cache-Control: max-age=0');
		// If you're serving to IE 9, then the following may be needed
		header('Cache-Control: max-age=1');

		// If you're serving to IE over SSL, then the following may be needed
		header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
		header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
		header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
		header ('Pragma: public'); // HTTP/1.0

		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
		
		ob_start();
		$objWriter->save('php://output');
		
		$xlsData = ob_get_contents();
		ob_end_clean();

		$response =  array(
		        'op' => 'ok',
		        'file' => "data:application/vnd.ms-excel;base64,".base64_encode($xlsData),
		        'filename' => $filename
		    ); 

		echo json_encode($response);
	}

	public function export_excel_dapeg2()
 	{
 		$wh_ukpd="";
 		$whspmu="";
 		$wh_bkdk3="";
 		if($this->session->userdata('logged_in')['user_group']=='5')
		{
			$username = $this->user['id'] ;

            	$getspmu = "SELECT * FROM PERS_TABEL_SPMU WHERE KODE_UNIT_SIPKD ='$username'";
            	$querygetspmu = $this->db->query($getspmu);
            	$numspm = $querygetspmu->num_rows();

            	if($numspm == 0)
            	{
            		$whspmu = " AND 3=3 ";
            	}
	            else if($numspm == 1)
	            {
	                $spmu = $querygetspmu->row()->KODE_SPM;

	                $whspmu = " AND A.SPMU='$spmu' ";
	                

	            }
	            else 
	            {
	                $arrayspmu = $querygetspmu->result();
	                

	                foreach ($arrayspmu  as $value) {
	                    # code...
	                    
	                    $spmu[] = $value->KODE_SPM;
	                }
	                $quewh="";
	                for($i=0;$i<$numspm;$i++)
	                {

	                    $quewh.= "'".$spmu[$i]."'";
	                    if($i<$numspm-1)
	                    {
	                        $quewh.=",";
	                    }
	                }
	                
	                $whspmu = " AND A.SPMU IN (".$quewh.") ";
	                
	            }
	    }
	    else if($this->session->userdata('logged_in')['user_group']=='47')
		{
				$idukpd = $this->user['id'];
				 $cekkolok = "SELECT a.kolok,a.nalok,a.spmu,a.kode_unit_sipkd,b.\"user_id\" 
                        from pers_klogad3 a
                        LEFT JOIN \"master_user\" b on a.kode_unit_sipkd = b.\"user_id\" 
                        where b.\"user_id\" = '$idukpd'";
                        //die($cekkolok);
            	$querycekkolok = $this->db->query($cekkolok);
            	if($querycekkolok) 
            	{
                	$reskolok=$querycekkolok->row()->KOLOK;
                	$wh_ukpd=" AND A.KLOGAD = '$reskolok'";   
            	}
            	else
            	{
            		$wh_ukpd=" AND 2=2";	
            	}

            	
		}
		else if($this->session->userdata('logged_in')['user_group']=='10')
		{
			if($this->user['kowil'] =='1')
            {
                $wh_bkdk3=" AND kolok LIKE '".$this->user['kowil']."%' AND substr(kolok,2,1)!='1'";
            }
            else if($this->user['kowil']=='11')
            {
                $wh_bkdk3=" AND kolok LIKE '".$this->user['kowil']."%' and substr(kolok,2,1)='1'";
            }
            else if($this->user['kowil']=='')
            {
                $wh_bkdk3=" AND 2=2";
            }
            else
            {
                $wh_bkdk3=" AND kolok LIKE '".$this->user['kowil']."%'";
            }
		}
 		 
	/*	if($this->session->userdata('logged_in')['user_group']=='47')
		{
			$sqlquery = "SELECT ROWNUM AS RN,A.* FROM VW_DATAPEG_PERSKPD A 
						LEFT JOIN UNIT_DISDIK UD ON A.KLOGAD = UD.KOLOK_SUDIN where 1=1
			$whspmu
			$wh_ukpd
		";
		}
		else
		{
			$sqlquery = "SELECT ROWNUM AS RN,A.* FROM VW_DATAPEG_PERSKPD A where 1=1
			$whspmu
			$wh_ukpd
			$wh_bkdk3
		";
		}*/

		$sqlquery = "SELECT ROWNUM AS RN,A.* FROM VW_DATAPEG_PERSKPD A where 1=1
			$whspmu
			$wh_ukpd
			$wh_bkdk3
		";

		$sqlquery.=" AND NRK > 170000 ORDER BY NRK ASC";
		
 		$queryex = $this->db->query($sqlquery)->result();
 		//$queryex = $this->prod->query($sqlquery)->result();
 		$filename = "DATA PEGAWAI part2.csv";
 		


 		$this->load->library("phpexcel/PHPExcel");

		// Create new PHPExcel object
		$objPHPExcel = new PHPExcel();

		// Set document properties
		$objPHPExcel->getProperties()->setCreator("Data Pegawai Per Wilayah - Provinsi DKI Jakarta")
									 ->setLastModifiedBy("BKD - Provinsi DKI Jakarta")
									 ->setTitle("Laporan Data Pegawai Per Wilayah")
									 ->setSubject("Laporan Data Pegawai")
									 ->setDescription("Laporan Data Pegawai Per Wilayah DKI Provinsi DKI Jakarta.")
									 ->setKeywords("Data Pegawai")
									 ->setCategory("Data Pegawai")
									 ->setCompany("BKD Provinsi DKI Jakarta");

		$arrMonth = array('01' => 'Januari', '02' => 'Februari', '03' => 'Maret', '04' => 'April', '05' => 'Mei', '06' => 'Juni', '07' => 'Juli', '08' => 'Agustus', '09' => 'September', '10' => 'Oktober', '11' => 'November', '12' => 'Desember');
		$objPHPExcel->setActiveSheetIndex(0);
        
		$objPHPExcel->getActiveSheet()->setCellValue('A1', 'No');
		$objPHPExcel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$objPHPExcel->getActiveSheet()->setCellValue('B1', 'NRK');
		$objPHPExcel->getActiveSheet()->getStyle('B1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$objPHPExcel->getActiveSheet()->setCellValue('C1', 'NAMA');
		$objPHPExcel->getActiveSheet()->getStyle('C1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$objPHPExcel->getActiveSheet()->setCellValue('D1', 'NIP');
		$objPHPExcel->getActiveSheet()->getStyle('D1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$objPHPExcel->getActiveSheet()->setCellValue('E1', 'NIP18');
		$objPHPExcel->getActiveSheet()->getStyle('E1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$objPHPExcel->getActiveSheet()->setCellValue('F1', 'GOL');
		$objPHPExcel->getActiveSheet()->getStyle('F1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$objPHPExcel->getActiveSheet()->setCellValue('G1', 'TMT PANGKAT');
		$objPHPExcel->getActiveSheet()->getStyle('G1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$objPHPExcel->getActiveSheet()->setCellValue('H1', 'ESELON');
		$objPHPExcel->getActiveSheet()->getStyle('H1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$objPHPExcel->getActiveSheet()->setCellValue('I1', 'JABATAN');
		$objPHPExcel->getActiveSheet()->getStyle('I1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$objPHPExcel->getActiveSheet()->setCellValue('J1', 'TMT ESELON');
		$objPHPExcel->getActiveSheet()->getStyle('J1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$objPHPExcel->getActiveSheet()->setCellValue('K1', 'TMT CPNS');
		$objPHPExcel->getActiveSheet()->getStyle('K1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$objPHPExcel->getActiveSheet()->setCellValue('L1', 'TANGGAL LAHIR');
		$objPHPExcel->getActiveSheet()->getStyle('L1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$objPHPExcel->getActiveSheet()->setCellValue('M1', 'TEMPAT LAHIR');
		$objPHPExcel->getActiveSheet()->getStyle('M1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$objPHPExcel->getActiveSheet()->setCellValue('N1', 'MASA KERJA');
		$objPHPExcel->getActiveSheet()->getStyle('N1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$objPHPExcel->getActiveSheet()->setCellValue('O1', 'STATUS PEGAWAI');
		$objPHPExcel->getActiveSheet()->getStyle('O1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$objPHPExcel->getActiveSheet()->setCellValue('P1', 'JENIS KELAMIN');
		$objPHPExcel->getActiveSheet()->getStyle('P1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$objPHPExcel->getActiveSheet()->setCellValue('Q1', 'AGAMA');
		$objPHPExcel->getActiveSheet()->getStyle('Q1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		
		$objPHPExcel->getActiveSheet()->setCellValue('R1', 'LOKASI GAJI');
		$objPHPExcel->getActiveSheet()->getStyle('R1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$objPHPExcel->getActiveSheet()->setCellValue('S1', 'SKPD');
		$objPHPExcel->getActiveSheet()->getStyle('S1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$objPHPExcel->getActiveSheet()->setCellValue('T1', 'UMUR');
		$objPHPExcel->getActiveSheet()->getStyle('T1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$objPHPExcel->getActiveSheet()->setCellValue('U1', 'KODE JABATAN');
		$objPHPExcel->getActiveSheet()->getStyle('U1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	

		// Set column widths
		$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(10);
		$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(15);
		$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(50);
		$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(15);		
		$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(25);
		$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(15);
		$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(15);
		$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(25);
		$objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(50);
		$objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(15);
		$objPHPExcel->getActiveSheet()->getColumnDimension('K')->setWidth(15);
		$objPHPExcel->getActiveSheet()->getColumnDimension('L')->setWidth(15);
		$objPHPExcel->getActiveSheet()->getColumnDimension('M')->setWidth(30);
		$objPHPExcel->getActiveSheet()->getColumnDimension('N')->setWidth(15);
		$objPHPExcel->getActiveSheet()->getColumnDimension('O')->setWidth(15);
		$objPHPExcel->getActiveSheet()->getColumnDimension('P')->setWidth(25);
		$objPHPExcel->getActiveSheet()->getColumnDimension('Q')->setWidth(20);
		$objPHPExcel->getActiveSheet()->getColumnDimension('R')->setWidth(70);
		$objPHPExcel->getActiveSheet()->getColumnDimension('S')->setWidth(70);
		$objPHPExcel->getActiveSheet()->getColumnDimension('T')->setWidth(15);
		$objPHPExcel->getActiveSheet()->getColumnDimension('U')->setWidth(15);
		
	
		$i=2;
		
		
		foreach($queryex as $row){
			


			$objPHPExcel->getActiveSheet()->setCellValue('A'.$i, $row->RN);									
			$objPHPExcel->getActiveSheet()->setCellValue('B'.$i, '`'.$row->NRK);
			$objPHPExcel->getActiveSheet()->setCellValue('C'.$i, $row->NAMA);
			$objPHPExcel->getActiveSheet()->setCellValue('D'.$i, '`'.$row->NIP);
			$objPHPExcel->getActiveSheet()->setCellValue('E'.$i, '`'.$row->NIP18);
			$objPHPExcel->getActiveSheet()->setCellValue('F'.$i, $row->GOL);
			$objPHPExcel->getActiveSheet()->setCellValue('G'.$i, $row->TMTPANGKAT);	
			$objPHPExcel->getActiveSheet()->setCellValue('H'.$i, $row->ESELON);
			$objPHPExcel->getActiveSheet()->setCellValue('I'.$i, $row->NAJABL);
			$objPHPExcel->getActiveSheet()->setCellValue('J'.$i, $row->TMTESELON);
			$objPHPExcel->getActiveSheet()->setCellValue('K'.$i, $row->MUANG);
			$objPHPExcel->getActiveSheet()->setCellValue('L'.$i, $row->TALHIR);
			$objPHPExcel->getActiveSheet()->setCellValue('M'.$i, $row->PATHIR);
			$objPHPExcel->getActiveSheet()->setCellValue('N'.$i, $row->MASKER);
			$objPHPExcel->getActiveSheet()->setCellValue('O'.$i, $row->STAPEG);
			$objPHPExcel->getActiveSheet()->setCellValue('P'.$i, $row->JENKEL);
			$objPHPExcel->getActiveSheet()->setCellValue('Q'.$i, $row->AGAMA);
			
			$objPHPExcel->getActiveSheet()->setCellValue('R'.$i, $row->LOKASI_GAJI);
			$objPHPExcel->getActiveSheet()->setCellValue('S'.$i, $row->SKPD);
			$objPHPExcel->getActiveSheet()->setCellValue('T'.$i, $row->UMUR);
			$objPHPExcel->getActiveSheet()->setCellValue('U'.$i, $row->KD);
			

			$i++;			
			
		}
		// $objPHPExcel->getActiveSheet()->getStyle('A5:K'.($totalData+1))->applyFromArray($styleThinBlackBorderOutline);

	

		// =======================================================================================================

		// Set header and footer. When no different headers for odd/even are used, odd header is assumed.		
		$objPHPExcel->getActiveSheet()->getHeaderFooter()->setOddHeader('&L&B '. $objPHPExcel->getProperties()->getTitle() .' &RPrinted on &D');
		$objPHPExcel->getActiveSheet()->getHeaderFooter()->setOddFooter('&L&B' . $objPHPExcel->getProperties()->getTitle() . '&RPage &P of &N');

		// Set page orientation and size		
		$objPHPExcel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);
		$objPHPExcel->getActiveSheet()->getPageSetup()->setPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_A4);

		$objPHPExcel->getActiveSheet()->getTabColor()->setARGB('FF0094FF');

		// Rename worksheet
		$objPHPExcel->getActiveSheet()->setTitle('sheet1');		

		// Set active sheet index to the first sheet, so Excel opens this as the first sheet
		
		$objPHPExcel->getActiveSheet()->getSheetView()->setZoomScale(80);		
		
		//UNTUK CREATE ANOTHER SHEET IN SAME FILE		
		//$objPHPExcel->createSheet(1);	
		//$objPHPExcel->setActiveSheetIndex(1);
        

		// =======================================================================================================

		// Set header and footer. When no different headers for odd/even are used, odd header is assumed.		
		$objPHPExcel->getActiveSheet()->getHeaderFooter()->setOddHeader('&L&B '. $objPHPExcel->getProperties()->getTitle() .' &RPrinted on &D');
		$objPHPExcel->getActiveSheet()->getHeaderFooter()->setOddFooter('&L&B' . $objPHPExcel->getProperties()->getTitle() . '&RPage &P of &N');

		// Set page orientation and size		
		$objPHPExcel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);
		$objPHPExcel->getActiveSheet()->getPageSetup()->setPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_A4);

		$objPHPExcel->getActiveSheet()->getTabColor()->setARGB('FF0094FF');

	

	
		
		$objPHPExcel->getActiveSheet()->getSheetView()->setZoomScale(80);	


		// Redirect output to a client’s web browser (Excel2007)
		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment;filename="Laporan_SKP"');
		header('Cache-Control: max-age=0');
		// If you're serving to IE 9, then the following may be needed
		header('Cache-Control: max-age=1');

		// If you're serving to IE over SSL, then the following may be needed
		header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
		header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
		header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
		header ('Pragma: public'); // HTTP/1.0

		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
		
		ob_start();
		$objWriter->save('php://output');
		
		$xlsData = ob_get_contents();
		ob_end_clean();

		$response =  array(
		        'op' => 'ok',
		        'file' => "data:application/vnd.ms-excel;base64,".base64_encode($xlsData),
		        'filename' => $filename
		    ); 

		echo json_encode($response);
	}

	//MPP

	function formmpp(){
		 
		      
		$id = $this->input->post('NRK');
		$penginput = $this->input->post('penginput');
		
		$data2 = $this->mdl->get_data($id)->row();
		$datampp = $this->mdl->getDataMPP($id)->row();
		
		if($datampp == NULL)
		{
			$data = $data2;
			$pejtt="";
		}
		else
		{
			$data = $datampp;
			$pejtt=$data->PEJTT;
		}
		
		$listPejtt= $this->infopegawai->getMasterPejtt($pejtt);

		
			echo '
			<div class="modal-dialog" role="document" id="pesan">
		        <form class="form-horizontal" id="formPass" action="javascript:updateDataPeg();" method="POST">                
		            <div class="modal-content">
		            <div class="modal-header">
		                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		                <h4 class="modal-title" id="modalUmumTitle">Form Masa Persiapan Pensiun<i> '; 
		                echo $data->NRK; echo '-';
		                echo $data->NAMA;	echo '</i></h4>
		                <input type="hidden" id="NRK" name="NRK" value="' ; echo $id; echo'">
		                <input type="hidden" id="penginput" name="penginput" value="' ; echo $penginput; echo'">
		            </div>
		            <div class="modal-body">
		                


		                <div class="form-group" id="data_2">
                        	<label class="col-sm-4 control-label">Tgl. Awal MPP</label>';
                        	
                        		if($data->TGLAMPP == null){
                        			echo '<div class="input-group col-sm-7 date"> 
                        					<span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" id="TGLAMPP" name="TGLAMPP" placeholder="Tgl. Awal MPP" value="'; echo $data->TGLAMPP; echo '" class="form-control" readonly="readonly">';
                        		}
                        		else
                        		{
                        			echo '<div class="input-group col-sm-7 "><input type="text" id="TGLAMPP" name="TGLAMPP" placeholder="Tgl. Awal MPP" value="';echo $data->TGLAMPP; echo
                            	  '" class="form-control" readonly="readonly">';
                        		}

                            	
                       	 	echo '</div>
                    	</div>

		                <div class="form-group" id="data_3">
                        	<label class="col-sm-4 control-label">Tgl. Akhir MPP</label>';
                        	if($data->TGLEMPP == null){
                        			echo '<div class="input-group col-sm-7 date"> 
                        					<span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" id="TGLEMPP" name="TGLEMPP" placeholder="Tgl. Akhir MPP" value="'; echo $data->TGLEMPP; echo '" class="form-control" readonly="readonly">';
                        		}
                        		else
                        		{
                        			echo '<div class="input-group col-sm-7 "><input type="text" id="TGLEMPP" name="TGLEMPP" placeholder="Tgl. Awal MPP" value="';echo $data->TGLEMPP; echo
                            	  '" class="form-control" readonly="readonly">';
                        		}
                    	echo '</div></div>

                    	<div class="form-group" id="data_5">
                        	<label class="col-sm-4 control-label">Tgl. SK</label>
                        	<div class="input-group col-sm-7 date">
                            	<span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" id="TGLSK" name="TGLSK" placeholder="Tgl. SK" value="'; if(isset($data->TGSK)){echo $data->TGSK; }else{ echo ""; } echo
                            	  '" class="form-control" readonly="readonly">
                       	 	</div>
                    	</div>

                    	<div class="form-group">
                        	<label class="col-sm-4 control-label">No. SK</label>
                        	<div class="input-group col-sm-7">
                            	<input class="form-control" maxlength="50" type="text" id="NOSK" placeholder="Nomor SK" name="NOSK" value="';if(isset($data->NOSK)){echo $data->NOSK; }else{ echo ""; } echo'">
                       	 	</div>
                    	</div>

                    	<div class="form-group">
                        <label class="col-sm-4 control-label">Pejabat Penanda Tangan</label>
                        <div class="col-sm-8">
                            <select class="form-control chosen-pejtt" name="PEJTT" id="PEJTT"  data-placeholder="Pilih Pejabat Penanda Tangan...">
                                <option></option>';
                                echo $listPejtt; echo' 
                            </select>
                        </div>
                    </div>

		                <span class="text-danger" id="warning"></span>
		                   
		    
		            </div>
		                <div class="modal-footer">
		                    <button type="button" class="btn btn-default dim" data-dismiss="modal" id="tutupModal">Tutup</button>
		                    <button type="submit" class="btn btn-primary dim">Simpan</button>
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

	function UpdateMPP(){
		
		$data = $this->input->post();
		

		$respon;
		
		
			$query  = $this->mdl->inputDataMPP($data);
			if($query == 1)
			{
				$respon = "SUKSES";
			}
			else
			{
				$respon = "GAGAL";
			}
		
		
		
		$return = array('responupd' => $respon);

        echo json_encode($return);
	}

	function form_batal_kematian(){
		 
		      
		$id = $this->input->post('NRK');
		
		$data = $this->mdl->cekDataMatiPegawai($id);
		$lastdata = $this->mdl->getDataTerakhirPegawai($id);

		
			echo '
			<div class="modal-dialog" role="document" id="pesan2">
		        <form class="form-horizontal" id="formPass2" action="javascript:updateBatalDataPeg();" method="POST">                
		            <div class="modal-content">
		            <div class="modal-header">
		                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		                <h4 class="modal-title" id="modalUmumTitle">Form Batalkan Data Kematian<i> '; 
		                echo $data->NRK; echo '-';
		                echo $data->NAMA;	echo '</i></h4>
		                <input type="hidden" id="NRK" name="NRK" value="' ; echo $id; echo'">
		          
		            </div>
		            <div class="modal-body">
		                


		                <div class="form-group" id="data_2">
                        	<label class="col-sm-4 control-label">Tgl. Mati</label>
                        	<div class="input-group col-sm-7 ">
                            	
                            	  <input class="form-control" maxlength="50" type="text" id="nosuratmati" placeholder="No. Surat Mati" name="nosuratmati" value="';echo $data->TGMATI; echo'" readonly>
                       	 	</div>
                    	</div>

		                <div class="form-group" id="data_3">
                        	<label class="col-sm-4 control-label">Tgl. Surat Mati</label>
                        	<div class="input-group col-sm-7">
                            
                            	  <input class="form-control" maxlength="50" type="text" id="nosuratmati" placeholder="No. Surat Mati" name="nosuratmati" value="';echo $data->TGSURATMATI; echo'" readonly>
                       	 	</div>
                    	</div>

                    	<div class="form-group">
                        	<label class="col-sm-4 control-label">No. Surat Mati</label>
                        	<div class="input-group col-sm-7">
                            	<input class="form-control" maxlength="50" type="text" id="nosuratmati" placeholder="No. Surat Mati" name="nosuratmati" value="';echo $data->NOSURATMATI; echo'" readonly>
                       	 	</div>
                    	</div>

                    	<div class="form-group">
                        	<label class="col-sm-4 control-label">Asal Surat Mati (Dikeluarkan Oleh)</label>
                        	<div class="input-group col-sm-7">
                            	<input class="form-control" maxlength="200" type="text" id="asalsuratmati" placeholder="Asal Surat Mati" name="asalsuratmati" value="';echo $data->ASALSURATMATI; echo'" readonly>
                       	 	</div>
                    	</div>

		                <span class="text-danger" id="warning"></span>
		                   
		    
		            </div>
		                <div class="modal-footer">
		                    <button type="button" class="btn btn-default dim" data-dismiss="modal" id="tutupModal2">Tutup</button>
		                    <button type="submit" class="btn btn-primary dim">Simpan</button>
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
                    endDate: new Date()
                });

            	$("#data_3 .input-group.date").datepicker({
                    todayBtn: "linked",
                    keyboardNavigation: false,
                    forceParse: false,
                    calendarWeeks: true,
                    autoclose: true,
                    format: "dd-mm-yyyy",
                    endDate: new Date()
                });
            });

		    	

			    function updateBatalDataPeg(){
			        var url = "'.site_url("pegawai/UpdateBatalDapeg").'";
			        $.ajax({
			            url: url,
			            type: "POST",
			            data: $("#formPass2").serialize(),
			            dataType: "json",
			            beforeSend: function() {                
			                var tgmati = $("#tgmati").val();
			                var tgsuratmati = $("#tgsuratmati").val();
			                var nosuratmati = $("#nosuratmati").val();
			                

			                
			               
			            },
			            success: function(data) {                               
			                
			                if(data.responupd == "SUKSES"){
			                    swal("Sukses!", "Perbarui Data Pegawai berhasil", "success");                    
			                    $("#tutupModal2").click();
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

	function UpdateBatalDapeg(){
		$nrk = $this->input->post('NRK');
		
			$query  = $this->mdl->updatebataldapeg($nrk);
			if($query)
			{
				$respon = "SUKSES";
			}
			else
			{
				$respon = "GAGAL";
			}

		
		
		$return = array('responupd' => $respon);

        echo json_encode($return);
	}

}
		

