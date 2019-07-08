
<?php
defined('BASEPATH') OR exit('No direct script access allowed');
header("Cache-Control: no-cache, must-revalidate");
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");

class Skp extends CI_Controller {
	private $ci;
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
		
		$this->ci =& get_instance();
       

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

		$spmu = $this->mdl->getSPMUSKP();
		if($this->user['user_group']!='2')
		{
			$koloks = $this->mdl->getKolokSKP();	
		}
		else
		{
			$koloks = '';		
		}
		
		

		$namasrc = $this->input->post('namasrc');
		$nrksrc = $this->input->post('nrksrc');
		$koloksrc = $this->input->post('koloksrc');
		

		$hak_akses = $this->infopegawai->hakAksesModul('23628',$this->user['user_group']);
		$data = array(
			'tgl' => $tgl,
			'tglproses' => $tglproses,
			'koloks' => $koloks,
			'koloksrc' => $koloksrc,
			'nrksrc' => $nrksrc,
			'namasrc' => $namasrc,
			'param_cari'=> $this->user['param_cari'],
			'hak_akses'=>$hak_akses,
			'spmu'=>$spmu
			);

		


		$datam['activemn'] = $this->infopegawai->initialMenu($this->user['user_group'],'skp',0);
		$datam['inisial'] = 'skp';

		$menuid='23628';  
        $cekaksesmenu = $this->infopegawai->cekaksesmenu($menuid,$this->user['user_group']);

        if($cekaksesmenu == '1')
        {
			$this->load->view('head/header',$this->user);
			$this->load->view('head/menu',$datam);
			$this->load->view('admin/skp_grid.php',$data);
			$this->load->view('head/footer');
		}
        else
        {
            $this->load->view('403');
        } 
	}



	

	
	public function data()
	{

		$hak_akses = $this->infopegawai->hakAksesModul('16870',$this->user['user_group']);
		
		$requestData = $this->input->post();


		$pjg_input=strlen($requestData['nrk']);

		$columns = array(
			// datatable column index  => database column name
//			0 => 'ROWNUM',
			0 => 'NRK',
			1 => 'NAMA',
			2 => 'TAHUN',
			3 => 'PELAYANAN',
			4 => 'INTEGRITAS',
			5 => 'KOMITMEN',
			6 => 'DISIPLIN',
			7 => 'KERJASAMA',
			8 => 'KEPEMIMPINAN',
			9 => 'NILAI_SKP',
			10 => 'NILAI_PERILAKU',
			11 => 'NILAI_PRESTASI'
			
		);

		// getting total number records without any search
		$q = "SELECT
					COUNT(*) AS jml
				FROM PERS_PEGAWAI1 P1 
						
						INNER JOIN PERS_KLOGAD3 KL ON P1.KLOGAD = KL.KOLOK
						
						 where (P1.kdmati <> 'Y' OR P1.KDMATI IS NULL) AND P1.KLOGAD NOT LIKE '11111111%' AND P1.NRK < 999999
                AND P1.NRK NOT IN (25310,199412,999000,885649,805171,666666,611722,576008,555555,537176,470045,441138,435023,412002,409579,376263,353515,
                333333,321095,317668,266407,250204,222222,217208,200558,199412)
				 ";
		// WHERE NOT EXISTS (SELECT NRK FROM PERS_PEGAWAI1 B WHERE DELETED ='Y' AND P1.NRK=B.NRK)
		$rs = $this->db->query($q)->result();
		$totalData = $rs[0]->JML;

		$wh_statval = "";

		if( !empty($requestData['opsi']) ){
			
			if($requestData['opsi'] == '-')
			{
				$wh_statval = " AND (A .STATUS_VALIDASI) = '0' ";	
			}
			else if($requestData['opsi'] == '1')
			{
				$wh_statval = " AND (A .STATUS_VALIDASI) = '".$requestData['opsi']."' ";	
			}
			
		}

		
		$whkoloksearch = "";

		if($this->user['user_group'] == "2" || $this->user['user_group'] == "26")
		{
			if(!empty($requestData['spmu']))
			{
				if( !empty($requestData['kolok']) )
				{
					if($requestData['kolok'] == "all")
					{
						$whkoloksearch = " AND P1.SPMU = '".$requestData['spmu']."' AND 5=5 ";
					}
					else
					{
						$whkoloksearch = " AND P1.SPMU = '".$requestData['spmu']."' AND KL.NALOK = '".$requestData['kolok']."'";	
					}
					
				}		
				
			}
			else
			{
				$whkoloksearch = " AND 5=5 ";
			}	
		}
		else
		{
			if( !empty($requestData['kolok']) )
			{
				if($requestData['kolok'] == "-" || $requestData['kolok'] == "all" )
				{
					$whkoloksearch = " AND 5=5 ";
				}
				else
				{
					$whkoloksearch = " AND KL.NALOK = '".$requestData['kolok']."'";	
				}
				
			}	
		}
		
		



		
		
	

		//$wh_nrk = " AND PERS_PEGAWAI1.nrk='' ";
		$wh_nrk = "";
		$wh_ukpd="";
		$whspmu="";
		$wh_k3="";
		$spmu_arr=array();

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
            	if($querycekkolok) 
            	{
                	$reskolok=$querycekkolok->row()->KOLOK;
                	$wh_ukpd=" AND (P1.KLOGAD = '$reskolok' OR P1.KOLOK IN (SELECT KOLOK FROM UNIT_DISDIK WHERE KOLOK_SUDIN='$reskolok'))";   
            	}
            	else
            	{
            		$wh_ukpd=" AND 2=2";	
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

	                $whspmu = " AND P1.SPMU='$spmu' ";
	                $spmu_arr[0] = $spmu;
	                

	            }
	            else 
	            {
	                $arrayspmu = $querygetspmu->result();
	                

	                foreach ($arrayspmu  as $value) {
	                    # code...
	                    
	                    $spmu[] = $value->KODE_SPM;
	                    $spmu_arr = $value->KODE_SPM;
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
	                
	                $whspmu = " AND P1.SPMU IN (".$quewh.") ";
	                
	               
	                
	            }

            	if( !empty($requestData['nrk']) )
				{
					$nrk_status = "WHERE NRK =('".$requestData['nrk']."')";
					

					if($pjg_input==6)
					{
						$wh_nrk=" AND (
		                        P1.nrk =('".$requestData['nrk']."')
		                        OR (P1.nama) LIKE UPPER('%".$requestData['nrk']."%')
		                        
		                    )";
					}
					else
					{
						$wh_nrk=" AND (
		                       	(P1.nrk) LIKE UPPER('%".$requestData['nrk']."%')
		                        OR (P1.nama) LIKE UPPER('%".$requestData['nrk']."%')
		                        OR (P1.NIP) LIKE UPPER('%".$requestData['nrk']."%')
		                        OR (P1.NIP18) LIKE UPPER('%".$requestData['nrk']."%')
		                    )";	
					}
				
				}
				
			}
			else if($this->session->userdata('logged_in')['user_group']=='10')
			{
				$wil = $this->user['kowil'];

				if ($wil == '1')
				{
					$wh_k3 = " AND P1.KOLOK IS NOT NULL AND (P1.KOLOK LIKE '$wil%' AND SUBSTR(P1.KOLOK,2,1)!='1') ";
				}
				else if($wil == '11')
				{
					$wh_k3 = " AND P1.KOLOK IS NOT NULL AND (P1.KOLOK LIKE '$wil%' AND SUBSTR(P1.KOLOK,2,1)='1') ";
				}
				else
				{
					$wh_k3 = " AND P1.KOLOK IS NOT NULL AND P1.KOLOK LIKE '$wil%' ";
				}

				if( !empty($requestData['nrk']) )
				{
					$nrk_status = "WHERE NRK =('".$requestData['nrk']."')";
					

					if($pjg_input==6)
					{
						$wh_nrk=" AND (
		                        P1.nrk =('".$requestData['nrk']."')
		                        OR (P1.nama) LIKE UPPER('%".$requestData['nrk']."%')
		                        
		                    )";
					}
					else
					{
						$wh_nrk=" AND (
		                       	(P1.nrk) LIKE UPPER('%".$requestData['nrk']."%')
		                        OR (P1.nama) LIKE UPPER('%".$requestData['nrk']."%')
		                        OR (P1.NIP) LIKE UPPER('%".$requestData['nrk']."%')
		                        OR (P1.NIP18) LIKE UPPER('%".$requestData['nrk']."%')
		                    )";	
					}
				
				}
			}

			else
			{

				if( !empty($requestData['nrk']) )
				{
					$nrk_status = "WHERE P1.NRK =('".$requestData['nrk']."')";
					

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
				
			}

			
		} else {

			$wh_nrk = " AND P1.nrk = '".$this->session->userdata('logged_in')['nrk']."' ";
		}



		if($requestData['opsi'] == '2' || $requestData['opsi'] == '3')
		{
			if($requestData['opsi'] == '2')
			{
				$tahunOPT = date('Y')-1;	
			}
			else
			{
				$tahunOPT = date('Y')-2;
			}
			
			if($this->session->userdata('logged_in')['user_group']=='47')
			{
				$sql ="SELECT rownum, X.* FROM 
					(
						SELECT 
						rownum as rn, 
						P1.NRK,
						 ' ' AS TAHUN, 
						 ' ' AS PELAYANAN,
						 ' ' AS INTEGRITAS,
						 ' ' AS KOMITMEN,
						 ' ' AS DISIPLIN,
						 ' ' AS KERJASAMA,
						 ' ' AS KEPEMIMPINAN,     
						 ' ' AS NILAI_SKP,
						 ' ' AS NILAI_PERILAKU,
						 ' ' AS NILAI_PRESTASI,
						 ' ' AS STATUS_VALIDASI, 
						 ' ' AS USERID_INPUT, 
						 ' ' AS TGUPD_INPUT,
						 ' ' AS RATA2,
						 ' ' AS INPUT_SKP,
						 P1.KLOGAD,
						 P1.NIP,
						 P1.NAMA,
						 P1.NIP18,
						 KL.NALOK AS NALOKL,
						P1.SPMU    
						 FROM PERS_PEGAWAI1 P1 
						
						INNER JOIN PERS_KLOGAD3 KL ON P1.KLOGAD = KL.KOLOK
						
						 where (P1.kdmati <> 'Y' OR P1.KDMATI IS NULL) AND P1.KLOGAD NOT LIKE '11111111%' AND P1.NRK < 999999
                AND P1.NRK NOT IN (25310,199412,999000,885649,805171,666666,611722,576008,555555,537176,470045,441138,435023,412002,409579,376263,353515,
                333333,321095,317668,266407,250204,222222,217208,200558,199412)
                  
			and not exists (select s.nrk from pers_skp s where s.tahun='$tahunOPT' and P1.nrk =s.nrk ) $wh_ukpd $whspmu $wh_k3 $wh_nrk 
			$whkoloksearch";


			}
			else
			{
				$sql ="SELECT rownum, X.* FROM 
					(
						SELECT 
						rownum as rn, 
						P1.NRK,
						 ' ' AS TAHUN, 
						 ' ' AS PELAYANAN,
						 ' ' AS INTEGRITAS,
						 ' ' AS KOMITMEN,
						 ' ' AS DISIPLIN,
						 ' ' AS KERJASAMA,
						 ' ' AS KEPEMIMPINAN,     
						 ' ' AS NILAI_SKP,
						 ' ' AS NILAI_PERILAKU,
						 ' ' AS NILAI_PRESTASI,
						 ' ' AS STATUS_VALIDASI, 
						 ' ' AS USERID_INPUT, 
						 ' ' AS TGUPD_INPUT,
						 ' ' AS RATA2,
						 ' ' AS INPUT_SKP,
						 P1.KLOGAD,
						 P1.NIP,
						 P1.NAMA,
						 P1.NIP18,
						 KL.NALOK AS NALOKL,
						P1.SPMU    
						 FROM PERS_PEGAWAI1 P1 
						
						INNER JOIN PERS_KLOGAD3 KL ON P1.KLOGAD = KL.KOLOK
						
						 where (P1.kdmati <> 'Y' OR P1.KDMATI IS NULL) AND P1.KLOGAD NOT LIKE '11111111%' AND P1.NRK < 999999
                AND P1.NRK NOT IN (25310,199412,999000,885649,805171,666666,611722,576008,555555,537176,470045,441138,435023,412002,409579,376263,353515,
                333333,321095,317668,266407,250204,222222,217208,200558,199412)
                  
			and not exists (select s.nrk from pers_skp s where s.tahun='$tahunOPT' and P1.nrk =s.nrk ) $wh_ukpd $whspmu $wh_k3 $wh_nrk $whkoloksearch";
			}

			
		}
		else if($requestData['opsi'] == '-' || $requestData['opsi'] == '1')
		{
			$tahunlalu = date('Y')-1;	
			
			if($this->session->userdata('logged_in')['user_group']=='47')
			{
				$sql = "SELECT rownum, X.* FROM 
						(
							SELECT
							rownum as rn,
							P1 .NRK,
							A .TAHUN,
							A .PELAYANAN,
							A .INTEGRITAS,
							A .KOMITMEN,
							A .DISIPLIN,
							A .KERJASAMA,
							A .KEPEMIMPINAN,
							A .NILAI_SKP,
							A .NILAI_PERILAKU,
							A .NILAI_PRESTASI,
							A .STATUS_VALIDASI,
							A .USERID_INPUT,
							TO_CHAR (
								A .TGUPD_INPUT,
								'DD-MM-YYYY HH24:MI:SS'
							) TGUPD_INPUT,
							A.RATA2,
						 	A.INPUT_SKP,
							P1.KLOGAD,
							P1.NIP,
							P1.NAMA,
							P1.NIP18,
							KL.NALOK AS NALOKL,
							P1.SPMU
						FROM
							PERS_PEGAWAI1 P1
						inner JOIN PERS_SKP A ON A.NRK = P1.NRK 
						
						INNER JOIN PERS_KLOGAD3 KL ON P1.KLOGAD = KL.KOLOK
						


                  WHERE (P1.kdmati <> 'Y' OR P1.KDMATI IS NULL) AND P1.KLOGAD NOT LIKE '11111111%' AND P1.NRK < 999999
                AND P1.NRK NOT IN (25310,199412,999000,885649,805171,666666,611722,576008,555555,537176,470045,441138,435023,412002,409579,376263,353515,
                333333,321095,317668,266407,250204,222222,217208,200558,199412)
                  AND A.TAHUN = '$tahunlalu' 
                  AND
                  			2=2
							$wh_statval
							$wh_nrk
							$wh_k3
							$wh_ukpd
							$whspmu
							$whkoloksearch
							";
			}
			else
			{
				$sql = "SELECT rownum, X.* FROM 
						(
							SELECT
							rownum as rn,
							P1 .NRK,
							A .TAHUN,
							A .PELAYANAN,
							A .INTEGRITAS,
							A .KOMITMEN,
							A .DISIPLIN,
							A .KERJASAMA,
							A .KEPEMIMPINAN,
							A .NILAI_SKP,
							A .NILAI_PERILAKU,
							A .NILAI_PRESTASI,
							A .STATUS_VALIDASI,
							A .USERID_INPUT,
							TO_CHAR (
								A .TGUPD_INPUT,
								'DD-MM-YYYY HH24:MI:SS'
							) TGUPD_INPUT,
							A.RATA2,
						 	A.INPUT_SKP,
							P1.KLOGAD,
							P1.NIP,
							P1.NAMA,
							P1.NIP18,
							KL.NALOK AS NALOKL,
							P1.SPMU
						FROM
							PERS_PEGAWAI1 P1
						inner JOIN PERS_SKP A ON A.NRK = P1.NRK 
						
						INNER JOIN PERS_KLOGAD3 KL ON P1.KLOGAD = KL.KOLOK
						


                  WHERE (P1.kdmati <> 'Y' OR P1.KDMATI IS NULL) AND P1.KLOGAD NOT LIKE '11111111%' AND P1.NRK < 999999
                AND P1.NRK NOT IN (25310,199412,999000,885649,805171,666666,611722,576008,555555,537176,470045,441138,435023,412002,409579,376263,353515,
                333333,321095,317668,266407,250204,222222,217208,200558,199412)
                  AND A.TAHUN = '$tahunlalu' 
                  AND
                  			2=2
							$wh_statval
							$wh_nrk
							$wh_k3
							$wh_ukpd
							$whspmu
							$whkoloksearch
							";
			}	
				
		}




	
							
		if( !empty($requestData['search']['value']) ) {   // if there is a search parameter, $requestData['search']['value'] contains search parameter
            $sql.=" AND ( P1.NRK = ('".$requestData['search']['value']."') ";    
            $sql.=" OR P1.NAMA LIKE UPPER ('%".$requestData['search']['value']."%') ";
            $sql.=" OR P1.NIP LIKE ('%".$requestData['search']['value']."%') ";
            $sql.=" OR P1.NIP18 LIKE ('%".$requestData['search']['value']."%') ";
            $sql.=" OR KL.NALOK LIKE ('%".$requestData['search']['value']."%') )";
            
		}



		$sql .= " ORDER BY
					P1.NRK ASC,
					TAHUN DESC
				) X";
		//die($sql);
		 $sql.=" WHERE 1=1";	
		 
		
		$query= $this->db->query($sql);

		$totalFiltered = $query->num_rows();
		$startrow = $requestData['start'];
		$endrow = $startrow + $requestData['length'];

		$sql.=" AND RN BETWEEN $startrow  AND $endrow";
	
		
		$query= $this->db->query($sql);


		$data = array();

		$no_urut = $requestData['start']+1;
		foreach($query->result() as $row){
			$nestedData=array();


			
				$nestedData[] = $row->NRK;
				$nestedData[] = $row->NAMA;
				$nestedData[] = $row->TAHUN;
				$nestedData[] = $row->PELAYANAN;
				$nestedData[] = $row->INTEGRITAS;
				$nestedData[] = $row->KOMITMEN;
				$nestedData[] = $row->DISIPLIN;
				$nestedData[] = $row->KERJASAMA;
				$nestedData[] = $row->KEPEMIMPINAN;
				$nestedData[] = $row->INPUT_SKP;
				$nestedData[] = $row->RATA2;
				$nestedData[] = $row->NILAI_PRESTASI;
				$nestedData[] = $row->USERID_INPUT."<br/>( ".$row->TGUPD_INPUT." )";
			

			
			$peg1=$this->infopegawai->getPegawai1($row->NRK);
			$penginput = $this->user['id'];
			$html_reset_pass="";
			if ($this->user['user_group']=='2' || $this->user['user_group']=='3' || $this->user['user_group']=='5' || $this->user['user_group']=='47' || $this->user['user_group']=='26')
			{

				

				$htmledit="<div class='col-sm-3' align='center'><button type='button' class='btn btn-outline btn-xs btn-success' title='Edit' onClick='getForm(\"skp\",\"update\",\"".$row->NRK."\",\"".$row->TAHUN."\",\"".$this->user['id']."\");'><i class='fa fa-pencil-square'></i></button> &nbsp;</div>";


				$htmlval="<div class='col-sm-3' align='center'>
										<button class='btn btn-outline btn-xs btn-danger' data-toggle='tool-tip' title='Validasi skp' pull-right onclick='validasiskp(&#39;".$row->NRK."&#39;,&#39;".$row->TAHUN."&#39;)'><i class='fa fa-check'></i></button>
								</div>";
			

				

				if($requestData['opsi'] == '-'  || $requestData['opsi'] == '1')
				{
					$nestedData[] = "<div class='form-group'>
								<div class='col-sm-12'>
									<div class='row'>
										
										
										$htmledit
										$htmlval
										
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
										
										
										$htmledit
										
										
									</div>
								</div>
							</div>
							
                            <script>
                                $('#tbl-grid_filter > label > input.form-control').val('');
                            </script>
                            ";
				}
				

				
			} 
			
			
			else if ($this->user['user_group']=='10')
			{
					$wil = $this->user['kowil'];	
					$htmledit="<div class='col-sm-3' align='center'><button type='button' class='btn btn-outline btn-xs btn-success' title='Edit' onClick='getForm(\"skp\",\"update\",\"".$row->NRK."\",\"".$row->TAHUN."\",\"".$this->user['id']."\");'><i class='fa fa-pencil-square'></i></button> &nbsp;</div>";


					$htmlval="<div class='col-sm-3' align='center'>
										<button class='btn btn-outline btn-xs btn-danger' data-toggle='tool-tip' title='Validasi skp' pull-right onclick='validasiskp(&#39;".$row->NRK."&#39;,&#39;".$row->TAHUN."&#39;)'><i class='fa fa-check'></i></button>
								</div>";


					if($wil == '1')
					{
						if(substr($peg1->KOLOK,0,1) == 1 && substr($peg1->KOLOK,1,1) != 1)
						{
							if($requestData['opsi'] == '-'  || $requestData['opsi'] == '1')
							{
								$nestedData[] = "<div class='form-group'>
											<div class='col-sm-12'>
												<div class='row'>
													
													
													$htmledit
													$htmlval
													
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
													
													
													$htmledit
													
													
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
							$nestedData[] = "<div class='form-group'>
											<div class='col-sm-12'>
												<div class='row'>
													
												</div>
											</div>
										</div>
										
			                            <script>
			                                $('#tbl-grid_filter > label > input.form-control').val('');
			                            </script>
			                            ";
							
						}
					}
					else if($wil == '11')
					{
						if(substr($peg1->KOLOK,0,1) == 1 && substr($peg1->KOLOK,1,1) == 1)
						{
							if($requestData['opsi'] == '-'  || $requestData['opsi'] == '1')
							{
								$nestedData[] = "<div class='form-group'>
											<div class='col-sm-12'>
												<div class='row'>
													
													
													$htmledit
													$htmlval
													
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
													
													
													$htmledit
													
													
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
							$nestedData[] = "<div class='form-group'>
											<div class='col-sm-12'>
												<div class='row'>
													
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
						if(substr($peg1->KOLOK,0,1) != 1 && $wil = substr($peg1->KOLOK,0,1) && $wil!=1)
						{
							if($requestData['opsi'] == '-'  || $requestData['opsi'] == '1')
							{
								$nestedData[] = "<div class='form-group'>
											<div class='col-sm-12'>
												<div class='row'>
													
													
													$htmledit
													$htmlval
													
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
													
													
													$htmledit
													
													
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
							$nestedData[] = "<div class='form-group'>
											<div class='col-sm-12'>
												<div class='row'>
													
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
			else
			{
				$nestedData[] = "<div class='form-group'>
											<div class='col-sm-12'>
												<div class='row'>
													
												</div>
											</div>
										</div>
										
			                            <script>
			                                $('#tbl-grid_filter > label > input.form-control').val('');
			                            </script>
			                            ";
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



	 public function generateForm(){
        
        if(isset($_POST['form'])){
            $form = $_POST['form'];
            // var_dump($form);

            $nrk = $_POST['key1'];
            $tahun = $_POST['key2'];
            $validator = $_POST['key3'];

        }else{
            $return = array('response' => 'GAGAL', 'err' => 'No Form');
            echo json_encode($return);
            exit();
        }

        $data = $this->generateDataForm($form);
        $widthForm = $data['widthForm'];
        // var_dump($data);exit;
        $data['nrk'] = $nrk;
        $data['validator'] = $validator;
        

   
        $msg = $this->load->view('admin/form_hist/form_'.$form, $data, true);
//        var_dump($msg);exit;
        $return = array('response' => 'SUKSES', 'result' => $msg, 'widthForm' => $widthForm);
        echo json_encode($return);
    }

    public function getSessionData()
	{
		$post = $this->input->post();
		$nrkpost = $post['nrk'];
		$kolokpost = $post['kolok'];
		$opsipost = $post['opsi'];
		$spmupost = $post['spmu'];
		//var_dump($nrkpost);
		$session_data = $this->session->userdata('logged_in');
		
		if($nrkpost!="" || $kolokpost !="" || $opsipost !="" || $spmupost !="")
		{

			if($session_data)
			{
				// array_push($session_data['param_cari'], $kolokpost , $nrkpost);
				$new_param = array ($kolokpost , $nrkpost, $opsipost, $spmupost);
				$this->session->set_userdata('param_cari', $new_param);
								
				// var_dump($session_data['param_cari']);
				//$session_data['param_cari'][0]);
			}
		}

		
	}

    public function generateDataForm($form){
        $data['empty'] = ""; $data['widthForm'] = "two";
        switch ($form) {
           

            case 'skp':                
                $action = $this->input->post('action');//action
                $nrk = $this->input->post('nrk');//nrk
                $nrk2 = $this->input->post('key1');//nrk
                $tahun = $this->input->post('key2');//tahun 
                $yrnw = date('Y');
                $data['yrnw'] = $yrnw;
                $data['action'] = $action;                  

                if($action != null && $action == 'update'){                    
                    $data['infoSKP'] = $this->infopegawai->getSKPHistBy($nrk2,$tahun);  
                     
                    if($data['infoSKP']->KEPEMIMPINAN == '0')
                    {
                    	$data['infoSKP']->KETKEPEMIMPINAN ='';
                    }
                    else
                    {
                    	$data['infoSKP']->KETKEPEMIMPINAN = $data['infoSKP']->KETKEPEMIMPINAN;
                    }
                }
                
                break;

            default:
                $data['empty'] = "";
                break;
        }

        return $data;
    }    









    function updatevalidasi()
	{
		
		$data = $this->input->post();
		
		
		$result = $this->mdl->updatevalidasi($data);
		

		$return = array('resp' => $result['resp']);

        echo json_encode($return);
	}




	
	function validasiskp()
	{
		$id = $this->input->post();

		$nrk = $id['NRK'];
		$tahun = $id['TAHUN'];
		
		
		echo '
			<div class="modal-dialog" role="document" id="pesan">
		        <form class="form-horizontal" id="formPass" action="javascript:validasi();" method="POST">                
		            <div class="modal-content">
		            <div class="modal-header">
		                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		                
		                <input type="hidden" id="NRK" name="NRK" value="' ; echo $nrk;	
		                echo'"><input type="hidden" id="TAHUN" name="TAHUN" value="'; echo $tahun;
						echo'"><input type="hidden" id="VALIDATOR" name="VALIDATOR" value="';echo $this->user['id'] ;
						echo'">

		            </div>
		            <div class="modal-body">
		                    
		                

		                <div class="form-group">
		                    <h2>Anda Yakin akan validasi data skp ini??</h2>

		                </div>

		                
		    
		            </div>
		                <div class="modal-footer">
		                    <button type="button" class="btn btn-default dim" data-dismiss="modal" id="tutupModal">Batalkan</button>
		                    <button type="submit" class="btn btn-primary dim">Validasi</button>
		                </div>
		            </div>
		        </form>
		    </div>

		    <script type="text/javascript" language="javascript" >
		    	
			    function validasi(){
			        var url = "'.site_url("skp/updatevalidasi").'";
			        $.ajax({
			            url: url,
			            type: "POST",
			            data: $("#formPass").serialize(),
			            dataType: "json",
			           
			            success: function(data) {                               
			                
			                if(data.resp == "0"){
			                    swal("Error!", "Gagal Validasi", "error");                    
			                    
			                }
			                else if(data.resp == "1"){
			                  
			                    swal("Sukses!", "Validasi Berhasil", "success"); 
			                   $("#modalPassword").modal("hide");
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

	

	public function cekDataSKP()
	{

		$val_select = $this->input->post('val');
		$kolok = $this->input->post('kolok');
		$spmu = $this->input->post('spmu');
 		

 		if($kolok=="all")
 		{
 			$kolok = '';
 		}
		
			if($val_select == "-")
	 		{
	 			$th1 = date('Y')-1;

	 			if($this->user['user_group'] == "2" || $this->user['user_group'] == "26")
	 			{
	 				if($spmu == "")
	 				{
	 					$query = $this->mdl->getCtDataSKPBelumValidasi($th1,$kolok);	
	 				}
	 				else
	 				{
	 					$query = $this->mdl->getCtDataSKPBelumValidasi($th1,$kolok,$spmu);	
	 				}
	 			}
	 			else
	 			{
	 				$query = $this->mdl->getCtDataSKPBelumValidasi($th1,$kolok);		
	 			}
				
				
				
	 		}
	 		else if($val_select == "1")
	 		{
	 			$th1 = date('Y')-1;
				
				if($this->user['user_group'] == "2" || $this->user['user_group'] == "26")
	 			{
	 				if($spmu == "")
	 				{
	 					$query = $this->mdl->getCtDataSKPSudahValidasi($th1,$kolok);	
	 				}
	 				else
	 				{
	 					$query = $this->mdl->getCtDataSKPSudahValidasi($th1,$kolok,$spmu);	
	 				}
	 			}
	 			else
	 			{
	 				$query = $this->mdl->getCtDataSKPSudahValidasi($th1,$kolok);		
	 			}
				
	 		}
	 		else if($val_select == "2")
	 		{
	 			$th1 = date('Y')-1;
				
				if($this->user['user_group'] == "2" || $this->user['user_group'] == "26")
	 			{

	 				if($spmu == "")
	 				{
	 					$query = $this->mdl->getCtDataSKPBelumInput($th1,$kolok);	
	 				}
	 				else
	 				{
	 					
	 					$query = $this->mdl->getCtDataSKPBelumInput($th1,$kolok,$spmu);	
	 				}
	 			}
	 			else
	 			{
	 				$query = $this->mdl->getCtDataSKPBelumInput($th1,$kolok);		
	 			}
				
	 		}
			else if($val_select == "3")
	 		{
	 			$th1 = date('Y')-2;
				
				if($this->user['user_group'] == "2" || $this->user['user_group'] == "26")
	 			{

	 				if($spmu == "")
	 				{
	 					$query = $this->mdl->getCtDataSKPBelumInput($th1,$kolok);	
	 				}
	 				else
	 				{
	 					$query = $this->mdl->getCtDataSKPBelumInput($th1,$kolok,$spmu);	
	 				}
	 			}
	 			else
	 			{
	 				$query = $this->mdl->getCtDataSKPBelumInput($th1,$kolok);		
	 			}
				
	 		}	
		

 		

 		$hasilcekdata = $query[0]->CT;
 		
 		$response =  array(
		        'jml' => $hasilcekdata
		        
		    ); 

		echo json_encode($response);
 		
	}


	public function export_excel_skp()
 	{
 		
 		$val_select = $this->input->post('val');
 		$kolok = $this->input->post('kolok');
 		$spmu = $this->input->post('spmu');

 		if($kolok=='all')
 		{
 			$kolok ='';
 		}
 		else
 		{
 			$kolok = $kolok;
 		}
 		
 		if($val_select == "-")
 		{
 			$th1 = date('Y')-1;

			//$query = $this->mdl->getDataSKPBelumValidasi($th1,$kolok);	
			if($this->user['user_group'] == "2" || $this->user['user_group'] == "26")
			{
				if($spmu == "")
				{
					$query = $this->mdl->getDataSKPBelumValidasi($th1,$kolok);	
				}
				else
				{
					$query = $this->mdl->getDataSKPBelumValidasi($th1,$kolok,$spmu);	
				}
			}
			else
			{
				$query = $this->mdl->getDataSKPBelumValidasi($th1,$kolok);		
			}
			
			$filename = 'Laporan SKP Belum Validasi Tahun '.$th1.".csv";
 		}
 		else if($val_select == "1")
 		{
 			$th1 = date('Y')-1;
			//$query = $this->mdl->getDataSKPSudahValidasi($th1,$kolok);	
			if($this->user['user_group'] == "2" || $this->user['user_group'] == "26")
			{
				if($spmu == "")
				{
					$query = $this->mdl->getDataSKPSudahValidasi($th1,$kolok);	
				}
				else
				{
					$query = $this->mdl->getDataSKPSudahValidasi($th1,$kolok,$spmu);	
				}
			}
			else
			{
				$query = $this->mdl->getDataSKPSudahValidasi($th1,$kolok);		
			}

			$filename = 'Laporan SKP Sudah Validasi Tahun '.$th1.".csv";
 		}
 		else if($val_select == "2")
 		{
 			$th1 = date('Y')-1;
			//$query = $this->mdl->getDataSKPBelumInput($th1,$kolok);
			if($this->user['user_group'] == "2" || $this->user['user_group'] == "26")
			{
				if($spmu == "")
				{
					$query = $this->mdl->getDataSKPBelumInput($th1,$kolok);	
				}
				else
				{
					$query = $this->mdl->getDataSKPBelumInput($th1,$kolok,$spmu);	
				}
			}
			else
			{
				$query = $this->mdl->getDataSKPBelumInput($th1,$kolok);		
			}

			$filename = 'Laporan SKP Belum Input Tahun '.$th1.".csv";
 		}
		else if($val_select == "3")
 		{
 			$th1 = date('Y')-2;

			//$query = $this->mdl->getDataSKPBelumInput($th1,$kolok);	

			if($this->user['user_group'] == "2" || $this->user['user_group'] == "26")
			{
				if($spmu == "")
				{
					$query = $this->mdl->getDataSKPBelumInput($th1,$kolok);	
				}
				else
				{
					$query = $this->mdl->getDataSKPBelumInput($th1,$kolok,$spmu);	
				}
			}
			else
			{
				$query = $this->mdl->getDataSKPBelumInput($th1,$kolok);		
			}
			$filename = 'Laporan SKP Belum Input Tahun '.$th1.".csv";
 		}


 		$this->load->library("phpexcel/PHPExcel");

		// Create new PHPExcel object
		$objPHPExcel = new PHPExcel();

		// Set document properties
		$objPHPExcel->getProperties()->setCreator("Penilaian Prestasi Kerja PNS - Provinsi DKI Jakarta")
									 ->setLastModifiedBy("BKD - Provinsi DKI Jakarta")
									 ->setTitle("Laporan Penilaian Prestasi Kerja PNS")
									 ->setSubject("Laporan SKP")
									 ->setDescription("Laporan Penilaian Prestasi Kerja PNS DKI Provinsi DKI Jakarta.")
									 ->setKeywords("SKP")
									 ->setCategory("SKP")
									 ->setCompany("BKD Provinsi DKI Jakarta");

		$arrMonth = array('01' => 'Januari', '02' => 'Februari', '03' => 'Maret', '04' => 'April', '05' => 'Mei', '06' => 'Juni', '07' => 'Juli', '08' => 'Agustus', '09' => 'September', '10' => 'Oktober', '11' => 'November', '12' => 'Desember');
		$objPHPExcel->setActiveSheetIndex(0);
        
		$objPHPExcel->getActiveSheet()->setCellValue('A1', 'No');
		$objPHPExcel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$objPHPExcel->getActiveSheet()->setCellValue('B1', 'NRK');
		$objPHPExcel->getActiveSheet()->getStyle('B1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$objPHPExcel->getActiveSheet()->setCellValue('C1', 'NAMA');
		$objPHPExcel->getActiveSheet()->getStyle('C1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$objPHPExcel->getActiveSheet()->setCellValue('D1', 'TAHUN');
		$objPHPExcel->getActiveSheet()->getStyle('D1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$objPHPExcel->getActiveSheet()->setCellValue('E1', 'PELAYANAN');
		$objPHPExcel->getActiveSheet()->getStyle('E1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$objPHPExcel->getActiveSheet()->setCellValue('F1', 'INTEGRITAS');
		$objPHPExcel->getActiveSheet()->getStyle('F1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$objPHPExcel->getActiveSheet()->setCellValue('G1', 'KOMITMEN');
		$objPHPExcel->getActiveSheet()->getStyle('G1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$objPHPExcel->getActiveSheet()->setCellValue('H1', 'DISIPLIN');
		$objPHPExcel->getActiveSheet()->getStyle('H1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$objPHPExcel->getActiveSheet()->setCellValue('I1', 'KERJASAMA');
		$objPHPExcel->getActiveSheet()->getStyle('I1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$objPHPExcel->getActiveSheet()->setCellValue('J1', 'KEPEMIMPINAN');
		$objPHPExcel->getActiveSheet()->getStyle('J1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$objPHPExcel->getActiveSheet()->setCellValue('K1', 'INPUT_SKP');
		$objPHPExcel->getActiveSheet()->getStyle('K1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$objPHPExcel->getActiveSheet()->setCellValue('L1', 'RATA2');
		$objPHPExcel->getActiveSheet()->getStyle('L1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$objPHPExcel->getActiveSheet()->setCellValue('M1', 'NILAI PRESTASI');
		$objPHPExcel->getActiveSheet()->getStyle('M1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$objPHPExcel->getActiveSheet()->setCellValue('N1', 'LOKASI GAJI');
		$objPHPExcel->getActiveSheet()->getStyle('N1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

		// Set column widths
		$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(10);
		$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(20);
		$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(50);
		$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(15);		
		$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(15);
		$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(15);
		$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(15);
		$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(15);
		$objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(15);
		$objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(15);
		$objPHPExcel->getActiveSheet()->getColumnDimension('K')->setWidth(15);
		$objPHPExcel->getActiveSheet()->getColumnDimension('L')->setWidth(15);
		$objPHPExcel->getActiveSheet()->getColumnDimension('M')->setWidth(15);
		$objPHPExcel->getActiveSheet()->getColumnDimension('N')->setWidth(70);

		$i=2;
		
		$no=1;
		foreach($query as $row){
			


			$objPHPExcel->getActiveSheet()->setCellValue('A'.$i, $no);									
			$objPHPExcel->getActiveSheet()->setCellValue('B'.$i, '`'.$row->NRK);
			$objPHPExcel->getActiveSheet()->setCellValue('C'.$i, $row->NAMA);
			$objPHPExcel->getActiveSheet()->setCellValue('D'.$i, $row->TAHUN);
			$objPHPExcel->getActiveSheet()->setCellValue('E'.$i, $row->PELAYANAN);
			$objPHPExcel->getActiveSheet()->setCellValue('F'.$i, $row->INTEGRITAS);
			$objPHPExcel->getActiveSheet()->setCellValue('G'.$i, $row->KOMITMEN);	
			$objPHPExcel->getActiveSheet()->setCellValue('H'.$i, $row->DISIPLIN);
			$objPHPExcel->getActiveSheet()->setCellValue('I'.$i, $row->KERJASAMA);
			$objPHPExcel->getActiveSheet()->setCellValue('J'.$i, $row->KEPEMIMPINAN);
			$objPHPExcel->getActiveSheet()->setCellValue('K'.$i, $row->INPUT_SKP);
			$objPHPExcel->getActiveSheet()->setCellValue('L'.$i, $row->RATA2);
			$objPHPExcel->getActiveSheet()->setCellValue('M'.$i, $row->NILAI_PRESTASI);
			$objPHPExcel->getActiveSheet()->setCellValue('N'.$i, $row->NALOKL);

			$i++;			$no++;
			
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


	public function export_excel_skp1()
 	{
 		
 		$val_select = $this->input->post('val');
 		$kolok = $this->input->post('kolok');
 		$spmu = $this->input->post('spmu');

 		if($kolok=='all')
 		{
 			$kolok ='';
 		}
 		else
 		{
 			$kolok = $kolok;
 		}
 		
 		
 		if($val_select == "-")
 		{
 			$th1 = date('Y')-1;
			//$query = $this->mdl->getDataSKPBelumValidasi1($th1,$kolok);	
			if($this->user['user_group'] == "2" || $this->user['user_group'] == "26")
			{
				if($spmu == "")
				{
					$query = $this->mdl->getDataSKPBelumValidasi1($th1,$kolok);	
				}
				else
				{
					$query = $this->mdl->getDataSKPBelumValidasi1($th1,$kolok,$spmu);	
				}
			}
			else
			{
				$query = $this->mdl->getDataSKPBelumValidasi1($th1,$kolok);		
			}
			
			$filename = 'Laporan SKP Belum Validasi Tahun '.$th1.".csv";
 		}
 		else if($val_select == "1")
 		{
 			$th1 = date('Y')-1;
			//$query = $this->mdl->getDataSKPSudahValidasi1($th1,$kolok);	

			if($this->user['user_group'] == "2")
			{
				if($spmu == "")
				{
					$query = $this->mdl->getDataSKPSudahValidasi1($th1,$kolok);	
				}
				else
				{
					$query = $this->mdl->getDataSKPSudahValidasi1($th1,$kolok,$spmu);	
				}
			}
			else
			{
				$query = $this->mdl->getDataSKPSudahValidasi1($th1,$kolok);		
			}
			$filename = 'Laporan SKP Sudah Validasi Tahun '.$th1.".csv";
 		}
 		else if($val_select == "2")
 		{
 			$th1 = date('Y')-1;
			//$query = $this->mdl->getDataSKPBelumInput1($th1,$kolok);	
			if($this->user['user_group'] == "2")
			{
				if($spmu == "")
				{
					$query = $this->mdl->getDataSKPBelumInput1($th1,$kolok);	
				}
				else
				{
					$query = $this->mdl->getDataSKPBelumInput1($th1,$kolok,$spmu);	
				}
			}
			else
			{
				$query = $this->mdl->getDataSKPBelumInput1($th1,$kolok);		
			}

			$filename = 'Laporan SKP(1) Belum Input Tahun '.$th1.".csv";
 		}
		else if($val_select == "3")
 		{
 			$th1 = date('Y')-2;
			//$query = $this->mdl->getDataSKPBelumInput1($th1,$kolok);	
			if($this->user['user_group'] == "2")
			{
				if($spmu == "")
				{
					$query = $this->mdl->getDataSKPBelumInput1($th1,$kolok);	
				}
				else
				{
					$query = $this->mdl->getDataSKPBelumInput1($th1,$kolok,$spmu);	
				}
			}
			else
			{
				$query = $this->mdl->getDataSKPBelumInput1($th1,$kolok);		
			}
			$filename = 'Laporan SKP(1) Belum Input Tahun '.$th1.".csv";
 		}


 		$this->load->library("phpexcel/PHPExcel");

		// Create new PHPExcel object
		$objPHPExcel = new PHPExcel();

		// Set document properties
		$objPHPExcel->getProperties()->setCreator("Penilaian Prestasi Kerja PNS - Provinsi DKI Jakarta")
									 ->setLastModifiedBy("BKD - Provinsi DKI Jakarta")
									 ->setTitle("Laporan Penilaian Prestasi Kerja PNS")
									 ->setSubject("Laporan SKP")
									 ->setDescription("Laporan Penilaian Prestasi Kerja PNS DKI Provinsi DKI Jakarta.")
									 ->setKeywords("SKP")
									 ->setCategory("SKP")
									 ->setCompany("BKD Provinsi DKI Jakarta");

		$arrMonth = array('01' => 'Januari', '02' => 'Februari', '03' => 'Maret', '04' => 'April', '05' => 'Mei', '06' => 'Juni', '07' => 'Juli', '08' => 'Agustus', '09' => 'September', '10' => 'Oktober', '11' => 'November', '12' => 'Desember');
		$objPHPExcel->setActiveSheetIndex(0);
        
		$objPHPExcel->getActiveSheet()->setCellValue('A1', 'No');
		$objPHPExcel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$objPHPExcel->getActiveSheet()->setCellValue('B1', 'NRK');
		$objPHPExcel->getActiveSheet()->getStyle('B1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$objPHPExcel->getActiveSheet()->setCellValue('C1', 'NAMA');
		$objPHPExcel->getActiveSheet()->getStyle('C1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$objPHPExcel->getActiveSheet()->setCellValue('D1', 'TAHUN');
		$objPHPExcel->getActiveSheet()->getStyle('D1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$objPHPExcel->getActiveSheet()->setCellValue('E1', 'PELAYANAN');
		$objPHPExcel->getActiveSheet()->getStyle('E1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$objPHPExcel->getActiveSheet()->setCellValue('F1', 'INTEGRITAS');
		$objPHPExcel->getActiveSheet()->getStyle('F1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$objPHPExcel->getActiveSheet()->setCellValue('G1', 'KOMITMEN');
		$objPHPExcel->getActiveSheet()->getStyle('G1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$objPHPExcel->getActiveSheet()->setCellValue('H1', 'DISIPLIN');
		$objPHPExcel->getActiveSheet()->getStyle('H1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$objPHPExcel->getActiveSheet()->setCellValue('I1', 'KERJASAMA');
		$objPHPExcel->getActiveSheet()->getStyle('I1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$objPHPExcel->getActiveSheet()->setCellValue('J1', 'KEPEMIMPINAN');
		$objPHPExcel->getActiveSheet()->getStyle('J1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$objPHPExcel->getActiveSheet()->setCellValue('K1', 'INPUT_SKP');
		$objPHPExcel->getActiveSheet()->getStyle('K1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$objPHPExcel->getActiveSheet()->setCellValue('L1', 'RATA2');
		$objPHPExcel->getActiveSheet()->getStyle('L1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$objPHPExcel->getActiveSheet()->setCellValue('M1', 'NILAI PRESTASI');
		$objPHPExcel->getActiveSheet()->getStyle('M1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$objPHPExcel->getActiveSheet()->setCellValue('N1', 'LOKASI GAJI');
		$objPHPExcel->getActiveSheet()->getStyle('N1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

		// Set column widths
		$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(10);
		$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(20);
		$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(50);
		$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(15);		
		$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(15);
		$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(15);
		$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(15);
		$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(15);
		$objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(15);
		$objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(15);
		$objPHPExcel->getActiveSheet()->getColumnDimension('K')->setWidth(15);
		$objPHPExcel->getActiveSheet()->getColumnDimension('L')->setWidth(15);
		$objPHPExcel->getActiveSheet()->getColumnDimension('M')->setWidth(15);
		$objPHPExcel->getActiveSheet()->getColumnDimension('N')->setWidth(70);

		$i=2;
		
		$no=1;
		foreach($query as $row){
			


			$objPHPExcel->getActiveSheet()->setCellValue('A'.$i, $no);									
			$objPHPExcel->getActiveSheet()->setCellValue('B'.$i, '`'.$row->NRK);
			$objPHPExcel->getActiveSheet()->setCellValue('C'.$i, $row->NAMA);
			$objPHPExcel->getActiveSheet()->setCellValue('D'.$i, $row->TAHUN);
			$objPHPExcel->getActiveSheet()->setCellValue('E'.$i, $row->PELAYANAN);
			$objPHPExcel->getActiveSheet()->setCellValue('F'.$i, $row->INTEGRITAS);
			$objPHPExcel->getActiveSheet()->setCellValue('G'.$i, $row->KOMITMEN);	
			$objPHPExcel->getActiveSheet()->setCellValue('H'.$i, $row->DISIPLIN);
			$objPHPExcel->getActiveSheet()->setCellValue('I'.$i, $row->KERJASAMA);
			$objPHPExcel->getActiveSheet()->setCellValue('J'.$i, $row->KEPEMIMPINAN);
			$objPHPExcel->getActiveSheet()->setCellValue('K'.$i, $row->INPUT_SKP);
			$objPHPExcel->getActiveSheet()->setCellValue('L'.$i, $row->RATA2);
			$objPHPExcel->getActiveSheet()->setCellValue('M'.$i, $row->NILAI_PRESTASI);
			$objPHPExcel->getActiveSheet()->setCellValue('N'.$i, $row->NALOKL);

			$i++;			$no++;
			
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

	public function export_excel_skp2()
 	{
 		
 		$val_select = $this->input->post('val');
 		$kolok = $this->input->post('kolok');
 		$spmu = $this->input->post('spmu');

 		if($kolok=='all')
 		{
 			$kolok ='';
 		}
 		else
 		{
 			$kolok = $kolok;
 		}
 		
 		
 		if($val_select == "-")
 		{
 			$th1 = date('Y')-1;
			//$query = $this->mdl->getDataSKPBelumValidasi2($th1,$kolok);	

			if($this->user['user_group'] == "2" || $this->user['user_group'] == "26")
			{
				if($spmu == "")
				{
					$query = $this->mdl->getDataSKPBelumValidasi2($th1,$kolok);	
				}
				else
				{
					$query = $this->mdl->getDataSKPBelumValidasi2($th1,$kolok,$spmu);	
				}
			}
			else
			{
				$query = $this->mdl->getDataSKPBelumValidasi2($th1,$kolok);		
			}
			
			$filename = 'Laporan SKP Belum Validasi Tahun '.$th1.".csv";
 		}
 		else if($val_select == "1")
 		{
 			$th1 = date('Y')-1;
			//$query = $this->mdl->getDataSKPSudahValidasi2($th1,$kolok);	

			if($this->user['user_group'] == "2")
			{
				if($spmu == "")
				{
					$query = $this->mdl->getDataSKPSudahValidasi2($th1,$kolok);	
				}
				else
				{
					$query = $this->mdl->getDataSKPSudahValidasi2($th1,$kolok,$spmu);	
				}
			}
			else
			{
				$query = $this->mdl->getDataSKPSudahValidasi2($th1,$kolok);		
			}

			$filename = 'Laporan SKP Sudah Validasi Tahun '.$th1.".csv";
 		}
 		else if($val_select == "2")
 		{
 			$th1 = date('Y')-1;
			//$query = $this->mdl->getDataSKPBelumInput2($th1,$kolok);	

			if($this->user['user_group'] == "2")
			{
				if($spmu == "")
				{
					$query = $this->mdl->getDataSKPBelumInput2($th1,$kolok);	
				}
				else
				{
					$query = $this->mdl->getDataSKPBelumInput2($th1,$kolok,$spmu);	
				}
			}
			else
			{
				$query = $this->mdl->getDataSKPBelumInput2($th1,$kolok);		
			}
			$filename = 'Laporan SKP(2) Belum Input Tahun '.$th1.".csv";
 		}
		else if($val_select == "3")
 		{
 			$th1 = date('Y')-2;
			$query = $this->mdl->getDataSKPBelumInput2($th1,$kolok);	

			if($this->user['user_group'] == "2")
			{
				if($spmu == "")
				{
					$query = $this->mdl->getDataSKPBelumValidasi2($th1,$kolok);	
				}
				else
				{
					$query = $this->mdl->getDataSKPBelumValidasi2($th1,$kolok,$spmu);	
				}
			}
			else
			{
				$query = $this->mdl->getDataSKPBelumValidasi2($th1,$kolok);		
			}
			$filename = 'Laporan SKP(2) Belum Input Tahun '.$th1.".csv";
 		}


 		$this->load->library("phpexcel/PHPExcel");

		// Create new PHPExcel object
		$objPHPExcel = new PHPExcel();

		// Set document properties
		$objPHPExcel->getProperties()->setCreator("Penilaian Prestasi Kerja PNS - Provinsi DKI Jakarta")
									 ->setLastModifiedBy("BKD - Provinsi DKI Jakarta")
									 ->setTitle("Laporan Penilaian Prestasi Kerja PNS")
									 ->setSubject("Laporan SKP")
									 ->setDescription("Laporan Penilaian Prestasi Kerja PNS DKI Provinsi DKI Jakarta.")
									 ->setKeywords("SKP")
									 ->setCategory("SKP")
									 ->setCompany("BKD Provinsi DKI Jakarta");

		$arrMonth = array('01' => 'Januari', '02' => 'Februari', '03' => 'Maret', '04' => 'April', '05' => 'Mei', '06' => 'Juni', '07' => 'Juli', '08' => 'Agustus', '09' => 'September', '10' => 'Oktober', '11' => 'November', '12' => 'Desember');
		$objPHPExcel->setActiveSheetIndex(0);
        
		$objPHPExcel->getActiveSheet()->setCellValue('A1', 'No');
		$objPHPExcel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$objPHPExcel->getActiveSheet()->setCellValue('B1', 'NRK');
		$objPHPExcel->getActiveSheet()->getStyle('B1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$objPHPExcel->getActiveSheet()->setCellValue('C1', 'NAMA');
		$objPHPExcel->getActiveSheet()->getStyle('C1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$objPHPExcel->getActiveSheet()->setCellValue('D1', 'TAHUN');
		$objPHPExcel->getActiveSheet()->getStyle('D1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$objPHPExcel->getActiveSheet()->setCellValue('E1', 'PELAYANAN');
		$objPHPExcel->getActiveSheet()->getStyle('E1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$objPHPExcel->getActiveSheet()->setCellValue('F1', 'INTEGRITAS');
		$objPHPExcel->getActiveSheet()->getStyle('F1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$objPHPExcel->getActiveSheet()->setCellValue('G1', 'KOMITMEN');
		$objPHPExcel->getActiveSheet()->getStyle('G1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$objPHPExcel->getActiveSheet()->setCellValue('H1', 'DISIPLIN');
		$objPHPExcel->getActiveSheet()->getStyle('H1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$objPHPExcel->getActiveSheet()->setCellValue('I1', 'KERJASAMA');
		$objPHPExcel->getActiveSheet()->getStyle('I1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$objPHPExcel->getActiveSheet()->setCellValue('J1', 'KEPEMIMPINAN');
		$objPHPExcel->getActiveSheet()->getStyle('J1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$objPHPExcel->getActiveSheet()->setCellValue('K1', 'INPUT_SKP');
		$objPHPExcel->getActiveSheet()->getStyle('K1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$objPHPExcel->getActiveSheet()->setCellValue('L1', 'RATA2');
		$objPHPExcel->getActiveSheet()->getStyle('L1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$objPHPExcel->getActiveSheet()->setCellValue('M1', 'NILAI PRESTASI');
		$objPHPExcel->getActiveSheet()->getStyle('M1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$objPHPExcel->getActiveSheet()->setCellValue('N1', 'LOKASI GAJI');
		$objPHPExcel->getActiveSheet()->getStyle('N1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

		// Set column widths
		$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(10);
		$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(20);
		$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(50);
		$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(15);		
		$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(15);
		$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(15);
		$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(15);
		$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(15);
		$objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(15);
		$objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(15);
		$objPHPExcel->getActiveSheet()->getColumnDimension('K')->setWidth(15);
		$objPHPExcel->getActiveSheet()->getColumnDimension('L')->setWidth(15);
		$objPHPExcel->getActiveSheet()->getColumnDimension('M')->setWidth(15);
		$objPHPExcel->getActiveSheet()->getColumnDimension('N')->setWidth(70);

		$i=2;
		
		$no=1;
		foreach($query as $row){
			


			$objPHPExcel->getActiveSheet()->setCellValue('A'.$i, $no);									
			$objPHPExcel->getActiveSheet()->setCellValue('B'.$i, '`'.$row->NRK);
			$objPHPExcel->getActiveSheet()->setCellValue('C'.$i, $row->NAMA);
			$objPHPExcel->getActiveSheet()->setCellValue('D'.$i, $row->TAHUN);
			$objPHPExcel->getActiveSheet()->setCellValue('E'.$i, $row->PELAYANAN);
			$objPHPExcel->getActiveSheet()->setCellValue('F'.$i, $row->INTEGRITAS);
			$objPHPExcel->getActiveSheet()->setCellValue('G'.$i, $row->KOMITMEN);	
			$objPHPExcel->getActiveSheet()->setCellValue('H'.$i, $row->DISIPLIN);
			$objPHPExcel->getActiveSheet()->setCellValue('I'.$i, $row->KERJASAMA);
			$objPHPExcel->getActiveSheet()->setCellValue('J'.$i, $row->KEPEMIMPINAN);
			$objPHPExcel->getActiveSheet()->setCellValue('K'.$i, $row->INPUT_SKP);
			$objPHPExcel->getActiveSheet()->setCellValue('L'.$i, $row->RATA2);
			$objPHPExcel->getActiveSheet()->setCellValue('M'.$i, $row->NILAI_PRESTASI);
			$objPHPExcel->getActiveSheet()->setCellValue('N'.$i, $row->NALOKL);

			$i++;			$no++;
			
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

	public function getKolok()
    {
        $spmu = $this->input->post('spmu');

        
            $koloks = $this->mdl->getKolokFromSPMU($spmu);
        
        $arr = array('response' => 'SUKSES', 'koloks' => $koloks);
        echo json_encode($arr);
    }

}
		

