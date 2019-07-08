<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Riwayat extends CI_Controller {

	private $user=array();

	public function __construct()
   	{
    	parent::__construct();
        $this->load->helper(array('form', 'url'));    	
    	$this->load->library('session');
    	$this->load->model('mhome','home');
        $this->load->model('mreferensi','referensi');
        $this->load->model('admin/m_admin');
        $this->load->model('admin/v_pegawai','mdl');
        $this->load->library('infopegawai');
        $this->load->library('convert');

    	if ($this->session->userdata('logged_in')) {            

            $session_data       = $this->session->userdata('logged_in');
            $this->user['id']     	= $session_data['id'];
            $this->user['username']  	= $session_data['username'];
            $this->user['user_group']     = $session_data['user_group'];
            $this->user['kowil']     = $session_data['kowil'];
        }else{
			redirect(base_url().'index.php/login', 'refresh');
		}	    
   	}

	public function index_old()
	{  
		    
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
                //$datam['li']=$this->home->showMenu();
                $datam['activeMenu'] = "416";
                $datam['activemn']=$this->infopegawai->initialMenu($this->user['user_group'],'riwayat_v',0);
                
            // START THBL
            if(isset($_POST['thbl'])){
                $bulantahun = $_POST['thbl'];
            }else{
                $bulantahun = date('M Y');
            }
            $thbl = $this->convert->convertNamaBulanTahun($bulantahun);
            // END THBL

            // START MEMUNCULKAN TOMBOL BACK KE ATASAN            
            $data['thbl'] = $bulantahun;
            if($nrk == $this->user['id']){
                $data['showBack'] = 'none';
                $data['nrkatasan'] = '';
            }else{
                $data['showBack'] = '';
                $data['nrkatasan'] = $this->infopegawai->getAtasanPegawai($nrk,$thbl);   
                

                if($data['nrkatasan'] == ""){                    
                    $data['nrkatasan'] = $this->user['id'];
                }
            }
            // END MEMUNCULKAN TOMBOL BACK KE ATASAN

            // START MEMUNCULKAN TOMBOL BACK KE DATAPOKOK (HISDUK)            
            if(isset($_POST['datapokok'])){
                $data['showBackPokok'] = '';
                $data['spmu'] = $_POST['spmu'];
            }
            // END MEMUNCULKAN TOMBOL BACK KE DATAPOKOK (HISDUK)



            // START Inisial Active Menu
            
            // END Inisial Active Menu


            $data['menu_select'] = $this->infopegawai->getMenuSelectHistNew($this->user['user_group']);
            $data['nrk'] = $nrk;
           // var_dump( $data['nrk']);
            $datam['nrk'] = $nrk;
            $datam['user_group'] = $this->user['user_group'];
            $data['user_id'] = $this->user['id'];
            $data['user_group'] = $this->user['user_group'];
            $infoUser = $this->home->getUserInfo2($nrk);
            $infoUser3 = $this->home->getuserInfo3($nrk);
            $infoUserJabatan = $this->home->getUserInfoJabatanS($nrk);
            $data['infoUser'] = $infoUser;  
            $data['infoUser3'] = $infoUser3;
            $data['infoUserJabatan'] = $infoUserJabatan;
            
            $data['bawahan'] = $this->infopegawai->getStrukturPegawai($nrk,$thbl);
            
            if ($data['bawahan'] == "") {
                
                    $date = strtotime('-1 months');
                    $thbl = date('Ym',$date);
                    $bulantahun = date('M Y',$date);
                    $data['thbl'] = $bulantahun;
                $data['bawahan'] = $this->infopegawai->getStrukturPegawai($nrk,$thbl);
            }

            $data['uraian'] = $this->infopegawai->getShowTupoksi($nrk);
            
           
            /*$uraian= "<ol>";
            foreach($data['uraian']->result() as $row)
            {    
                
               $uraian.= "<li>".$row->uraian."</li>";
            }
            $uraian.= "</ol>";*/
           // echo $uraian;
            

			$this->load->view('head/header',$this->user);
			$this->load->view('head/menu',$datam);
			$this->load->view('riwayat_v',$data);
            //$this->load->view('admin/pegawai_list',$data);
			$this->load->view('head/footer');

	}

    public function index()
    {  
                
            // START GET NRK                
                /*if(isset($_GET['nrk']))
                {
                    $nrk = $_GET['nrk'];    
                }
                else*/ 
                if(isset($_POST['nrk']))
                {
                    $nrk = $_POST['nrk'];    

                    if ($this->session->userdata('logged_in'))
                    {
                        $_SESSION['logged_in']['nrktemp']=$nrk;
                        //var_dump($_SESSION['logged_in']['nrktemp']);
                    }
                }
                elseif(isset($_POST['nrkP'])){ //Pencarian NRK Untuk Admin/BKD
                    $nrk = $_POST['nrkP'];                    
                }else{
                    /*$nrk = $this->user['id'];

                    if($this->user['user_group'] > 1){
                        $nrk = "";

                    }*/
                    $nrk = $_SESSION['logged_in']['nrktemp'];

                }   
                
                if(isset($_POST['akt']))
                {
                    $akt= $_POST['akt'];

                }   
                
            // END GET NRK
                //$datam['li']=$this->home->showMenu();
                //$datam['activeMenu'] = "416";
                //$datam['activemn']=$this->infopegawai->initialMenu($this->user['user_group'],'riwayat_v',0);
                $datam['activemn'] = $this->infopegawai->initialMenu($this->user['user_group'],'datapokok',0);
                
            // START THBL
            if(isset($_POST['thbl'])){
                $bulantahun = $_POST['thbl'];
            }else{
                $bulantahun = date('M Y');
            }
            $thbl = $this->convert->convertNamaBulanTahun($bulantahun);
            // END THBL

            // START MEMUNCULKAN TOMBOL BACK KE ATASAN            
            $data['thbl'] = $bulantahun;
            if($nrk == $this->user['id']){
                $data['showBack'] = 'none';
                $data['nrkatasan'] = '';
            }else{
                $data['showBack'] = '';
                $data['nrkatasan'] = $this->infopegawai->getAtasanPegawai($nrk,$thbl);   
                

                if($data['nrkatasan'] == ""){                    
                    $data['nrkatasan'] = $this->user['id'];
                }
            }
            // END MEMUNCULKAN TOMBOL BACK KE ATASAN

            // START MEMUNCULKAN TOMBOL BACK KE DATAPOKOK (HISDUK)            
            if(isset($_POST['datapokok'])){
                $data['showBackPokok'] = '';
                $data['spmu'] = $_POST['spmu'];
            }
            // END MEMUNCULKAN TOMBOL BACK KE DATAPOKOK (HISDUK)



            // START Inisial Active Menu
            
            // END Inisial Active Menu


            $data['menu_select'] = $this->infopegawai->getMenuSelectHistNew($this->user['user_group']);
            $data['nrk'] = $nrk;
           // var_dump( $data['nrk']);
            $datam['nrk'] = $nrk;
            $datam['user_group'] = $this->user['user_group'];
            $data['user_id'] = $this->user['id'];
            $data['user_group'] = $this->user['user_group'];
            $infoUser = $this->home->getUserInfo2($nrk);
            //~var_dump($infoUser);
            if($infoUser == null)
            {
                $this->load->view('viewnulldata');
            }
            $infoUser3 = $this->home->getuserInfo3($nrk);
            $infoUserJabatan = $this->home->getUserInfoJabatanS($nrk);
            $data['infoUser'] = $infoUser;  
            $data['infoUser3'] = $infoUser3;
            $data['infoUserJabatan'] = $infoUserJabatan;
            
            $data['bawahan'] = $this->infopegawai->getStrukturPegawai($nrk,$thbl);
            
            if ($data['bawahan'] == "") {
                
                    $date = strtotime('-1 months');
                    $thbl = date('Ym',$date);
                    $bulantahun = date('M Y',$date);
                    $data['thbl'] = $bulantahun;
                $data['bawahan'] = $this->infopegawai->getStrukturPegawai($nrk,$thbl);
            }

            $data['uraian'] = $this->infopegawai->getShowTupoksi($nrk);
            
           
            /*$uraian= "<ol>";
            foreach($data['uraian']->result() as $row)
            {    
                
               $uraian.= "<li>".$row->uraian."</li>";
            }
            $uraian.= "</ol>";*/
           // echo $uraian;
            

            $this->load->view('head/header',$this->user);
            $this->load->view('head/menu',$datam);
            $this->load->view('riwayat_v2',$data);
            //$this->load->view('admin/pegawai_list',$data);
            $this->load->view('head/footer');

    }


    public function listPegawai()
    {
        $tgl_sekarang = date("Y-m-d");
        $tgl = date('Y-m-d', strtotime($tgl_sekarang));
        $tglproses = date('Y-m-d', strtotime($tgl_sekarang));
        $koloks = $this->mdl->getKolok();
        //var_dump($koloks);
        $data = array(
            'tgl' => $tgl,
            'tglproses' => $tglproses,
            'koloks' => $koloks,
            'nrk' => $this->input->post('nrkP')
        );

        // START Inisial Active Menu
        $datam['activemn'] = $this->infopegawai->initialMenu($this->user['user_group'],'riwayat_v',0);
        // END Inisial Active Menu
        $datam['nrk'] = $data['nrk'];
        $datam['inisial'] = "riwayat";

        $this->load->view('head/header',$this->user);
        $this->load->view('head/menu',$datam);
        $this->load->view('admin/pegawai_list_riwayat.php',$data);
        //$this->load->view('admin/pegawai_list.php',$data);
        $this->load->view('head/footer');
    }

    

    /*public function dataList()
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

        // getting total number records without any search
        $q = "SELECT
					COUNT(NRK) AS jml
				FROM
					PERS_PEGAWAI1";

        $rs = $this->db->query($q)->result();
        $totalData = $rs[0]->JML;




        //$wh_nrk = " AND PERS_PEGAWAI1.nrk='' ";
        $wh_nrkp = "";
        if( !empty($requestData['nrkp']) ){
            $wh_nrkp = " AND (
						lower(PERS_PEGAWAI1.nrk) LIKE lower('%".$requestData['nrkp']."%')
						OR lower(PERS_PEGAWAI1.nama) LIKE lower('%".$requestData['nrkp']."%')
					)";
        }


        $sql = "SELECT rownum, X.* FROM (
                SELECT rownum as rn,pers_kojab_tbl.najabl, PERS_PEGAWAI1.nrk, PERS_PEGAWAI1.nama,
                      PERS_PEGAWAI1.pathir, TO_CHAR(PERS_PEGAWAI1.talhir,'DD-MM-YYYY')AS TGL ";
        $sql .= " FROM PERS_PEGAWAI1 LEFT OUTER JOIN
							  pers_kojab_tbl ON PERS_PEGAWAI1.kolok = pers_kojab_tbl.kolok AND
							  PERS_PEGAWAI1.kojab = pers_kojab_tbl.kojab
                  WHERE
                            (PERS_PEGAWAI1.KDMATI <> 'Y' OR (PERS_PEGAWAI1.TMTPENSIUN > SYSDATE OR PERS_PEGAWAI1.TMTPENSIUN IS NULL)) AND PERS_PEGAWAI1.FLAG = '1' AND
							1=1
							$wh_nrkp
					ORDER BY
						PERS_PEGAWAI1.klogad,
						PERS_PEGAWAI1.kojab
				) X";
        //echo $sql;
        $query= $this->db->query($sql);
        $totalFiltered = $query->num_rows();
        $temp =$requestData['start']+$requestData['length'];

        $sql.=" WHERE RN > ".$requestData['start']." AND RN <= ".$temp." AND ROWNUM <= ".$requestData['length']."";
        $sql.=" ORDER BY ". $columns[$requestData['order'][0]['column']]."   ".$requestData['order'][0]['dir']." ";  // adding length
      //  echo $sql;
        $query= $this->db->query($sql);

        $data = array();

        $no_urut = $requestData['start']+1;
        foreach($query->result() as $row){
            $nestedData=array();
            $nestedData[] = $no_urut;
//            if ($row->X_PHOTO){
//                $nestedData[] = "<div class='form-group'>
//								<div class='col-sm-12'>
//									<div class='row'>
//										<div class='col-sm-4' align='center'>
//											<img id='blah2' src='".site_url('pegawai/tampilPhoto/'.$row->NRK)."' width='120' height='150'/>
//										</div>
//									</div>
//								</div>
//							</div>
//							";
//            } else {
//                $nestedData[] = "";
//            }

            $nestedData[] = $row->NRK;
            $nestedData[] = $row->NAMA;
            $nestedData[] = $row->NAJABL;
            $nestedData[] = $row->PATHIR;
            $nestedData[] = $row->TGL;
            $nestedData[] = "<div class='form-group'>
								<div class='col-sm-12'>
									<div class='row'>
										<div class='col-sm-4' align='center'>
											<form method='post' action='".site_url('riwayat')."'>
												<input type='hidden' name='nrkP' id='nrkP' value='".$row->NRK."'>
												<button class='btn btn-outline btn-xs btn-primary' data-toggle='tool-tip' data-placement='bottom' title='riwayat pegawai' type='submit' pull-right><i class='fa fa-bars'></i></button>
											</form>
										</div>
									</div>
								</div>
							</div>
							";

            $data[] = $nestedData;
            $no_urut++;
        }

        $json_data = array(
            "draw"            => intval( $requestData['draw'] ),
            "recordsTotal"    => intval( $totalData ),
            "recordsFiltered" => intval( $totalFiltered ),
            "data"            => $data
        );

        echo json_encode($json_data);
    }
    */

    public function dataListRiwayat()
    {
        $requestData = $this->input->post();

        $columns = array(
            // datatable column index  => database column name
//            0 => 'ROWNUM',
            0 => 'NRK',
            1 => 'NIP',
            2 => 'NIP18',
            3 => 'NAMA',
            4 => 'NAJABL',
            5 => 'NALOKL'
        );

        // getting total number records without any search
        $q = "SELECT
                    COUNT(NRK) AS jml
                FROM
                    PERS_PEGAWAI1";

        $rs = $this->db->query($q)->result();
        $totalData = $rs[0]->JML;

        //$wh_nrk = " AND PERS_PEGAWAI1.nrk='' ";
        //$wh_nrkp = "";
         $wh_filter="";
        if( !empty($requestData['nrkp']) ){
          /*  $wh_nrkp = " AND (
                        lower(PERS_PEGAWAI1.nrk) LIKE lower('%".$requestData['nrkp']."%')
                        OR lower(PERS_PEGAWAI1.nama) LIKE lower('%".$requestData['nrkp']."%')
                    )";*/

            if($requestData['akt'] == 2)
            {
                $wh_filter="AND (
                        PERS_PEGAWAI1.nrk = '".$requestData['nrkp']."'
                        OR lower (PERS_PEGAWAI1.nama) LIKE lower('%".$requestData['nrkp']."%')
                        OR (PERS_PEGAWAI1.NIP) ='".$requestData['nrkp']."'
                        OR (PERS_PEGAWAI1.NIP18) = '".$requestData['nrkp']."'
                    )";
            }
            else if($requestData['akt']==1)
            {
                $wh_filter="AND (PERS_PEGAWAI1.KDMATI <> 'Y' OR (PERS_PEGAWAI1.TMTPENSIUN > SYSDATE OR PERS_PEGAWAI1.TMTPENSIUN IS NULL)) AND PERS_PEGAWAI1.FLAG = '1' AND (
                        PERS_PEGAWAI1.nrk ='".$requestData['nrkp']."'
                        OR lower (PERS_PEGAWAI1.nama) LIKE lower('%".$requestData['nrkp']."%')
                        OR (PERS_PEGAWAI1.NIP) ='".$requestData['nrkp']."'
                        OR (PERS_PEGAWAI1.NIP18) = '".$requestData['nrkp']."'
                    )";
            }
            else if($requestData['akt']==0)
            {
                $wh_filter="AND (PERS_PEGAWAI1.KDMATI = 'Y' OR PERS_PEGAWAI1.FLAG <> '1' OR PERS_PEGAWAI1.TMTPENSIUN <= SYSDATE) AND (
                        PERS_PEGAWAI1.nrk ='".$requestData['nrkp']."'
                        OR lower (PERS_PEGAWAI1.nama) LIKE lower('%".$requestData['nrkp']."%')
                        OR (PERS_PEGAWAI1.NIP) ='".$requestData['nrkp']."'
                        OR (PERS_PEGAWAI1.NIP18) = '".$requestData['nrkp']."'
                    )";
            }
            if($requestData['akt']=="") {
                $wh_filter = "AND (
                        PERS_PEGAWAI1.nrk ='" . $requestData['nrkp'] . "'
                        OR lower (PERS_PEGAWAI1.nama) LIKE lower('%" . $requestData['nrkp'] . "%')
                        OR (PERS_PEGAWAI1.NIP) ='" . $requestData['nrkp'] . "'
                        OR (PERS_PEGAWAI1.NIP18) = '" . $requestData['nrkp'] . "'
                    )";
            }
            $wh0 = "1=1";
        }
        else
        {
            if($requestData['akt'] == 2)
            {
                $wh_filter="";
            }
            else if($requestData['akt']==1)
            {
                $wh_filter="AND (PERS_PEGAWAI1.KDMATI <> 'Y' OR (PERS_PEGAWAI1.TMTPENSIUN > SYSDATE OR PERS_PEGAWAI1.TMTPENSIUN IS NULL)) AND PERS_PEGAWAI1.FLAG = '1' ";
            }
            else if($requestData['akt']==0)
            {
                $wh_filter="AND (PERS_PEGAWAI1.KDMATI = 'Y' OR PERS_PEGAWAI1.FLAG <> '1' OR PERS_PEGAWAI1.TMTPENSIUN <= SYSDATE)";
            }

            if ($requestData['akt']==""){
                $wh0 = "1=2";
            } else {
                $wh0 = "1=1";
            }
        }


        $sql = "SELECT rownum, X.* FROM (SELECT rownum as rn,
                pers_kojab_tbl.najabl, PERS_PEGAWAI1.nrk, PERS_PEGAWAI1.nama, PERS_PEGAWAI1.nip18,PERS_PEGAWAI1.nip,
                      PERS_PEGAWAI1.pathir, PERS_LOKASI_TBL.NALOKL,TO_CHAR(PERS_PEGAWAI1.talhir,'DD-MM-YYYY') AS TGL";
        $sql .= " FROM PERS_PEGAWAI1 
                  LEFT OUTER JOIN
                              pers_kojab_tbl ON PERS_PEGAWAI1.kolok = pers_kojab_tbl.kolok AND
                              PERS_PEGAWAI1.kojab = pers_kojab_tbl.kojab
                  LEFT JOIN PERS_LOKASI_TBL ON PERS_PEGAWAI1.KLOGAD = PERS_LOKASI_TBL.KOLOK
                  WHERE
                        (
                            $wh0
                            $wh_filter
                        )
                    ORDER BY
                        PERS_PEGAWAI1.klogad,
                        PERS_PEGAWAI1.kojab
                ) X";
//        echo $sql;
        $query= $this->db->query($sql);
        $totalFiltered = $query->num_rows();
        $temp =$requestData['start']+$requestData['length'];

        $sql.=" WHERE RN > ".$requestData['start']." AND RN <= ".$temp." AND ROWNUM <= ".$requestData['length']."";
        // $sql.=" ORDER BY ". $columns[$requestData['order'][0]['column']]."   ".$requestData['order'][0]['dir']." ";  // adding length
//       echo $sql;
        $query= $this->db->query($sql);

        $data = array();

        $no_urut = $requestData['start']+1;
        foreach($query->result() as $row){
            $nestedData=array();
//            $nestedData[] = $no_urut;
//            if ($row->X_PHOTO){
//                $nestedData[] = "<div class='form-group'>
//                              <div class='col-sm-12'>
//                                  <div class='row'>
//                                      <div class='col-sm-4' align='center'>
//                                          <img id='blah2' src='".site_url('pegawai/tampilPhoto/'.$row->NRK)."' width='120' height='150'/>
//                                      </div>
//                                  </div>
//                              </div>
//                          </div>
//                          ";
//            } else {
//                $nestedData[] = "";
//            }
            $nestedData[] = $row->NRK;
            $nestedData[] = $row->NIP;
            $nestedData[] = $row->NIP18;
            $nestedData[] = $row->NAMA;
            $nestedData[] = $row->NAJABL;
            $nestedData[] = $row->NALOKL;
            //$nestedData[] = $row->PATHIR;
            //$nestedData[] = $row->TGL;
            $nestedData[] = "<div class='form-group'>
                                <div class='col-sm-12'>
                                    <div class='row'>
                                        <div class='col-sm-4' align='center'>
                                            <form method='post' action='".site_url('riwayat')."'>
                                                <input type='hidden' name='nrkP' id='nrkP' value='".$row->NRK."'>
                                                
                                                <button class='btn btn-outline btn-xs btn-primary' type='submit' data-toggle='tool-tip' data-placement='bottom' title='riwayat pegawai' pull-right><i class='fa fa-bars'></i></button>
                                            </form>

                                            <form method='post' action='".site_url('profile/topdf')."'>
                                                <input type='hidden' name='nrkP' id='nrkP' value='".$row->NRK."'>
                                                <button class='btn btn-outline btn-xs btn-danger' data-toggle='tool-tip' data-placement='bottom' title='print cv' type='submit' pull-right><i class='fa fa-file-pdf-o'></i></button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            ";

            $data[] = $nestedData;
            $no_urut++;
        }

        $json_data = array(
            "draw"            => intval( $requestData['draw'] ),
            "recordsTotal"    => intval( $totalData ),
            "recordsFiltered" => intval( $totalFiltered ),
            "data"            => $data
        );

        echo json_encode($json_data);
    }

    public function convertThbl($param){
        $tahun = substr($param, 0,4);
        $bulan = substr($param, 4,2);

        if($bulan=='01'){
            $blnT="Jan ".$tahun;
        }elseif ($bulan=='02') {
            $blnT="Feb ".$tahun;
        }elseif ($bulan=='03') {
            $blnT="Mar ".$tahun;
        }elseif ($bulan=='04') {
            $blnT="Apr ".$tahun;
        }elseif ($bulan=='05') {
            $blnT="May ".$tahun;
        }elseif ($bulan=='06') {
            $blnT="Jun ".$tahun;
        }elseif ($bulan=='07') {
            $blnT="Jul ".$tahun;
        }elseif ($bulan=='08') {
            $blnT="Aug ".$tahun;
        }elseif ($bulan=='09') {
            $blnT="Sep ".$tahun;
        }elseif ($bulan=='10') {
            $blnT="Oct ".$tahun;
        }elseif ($bulan=='11') {
            $blnT="Nov ".$tahun;
        }elseif ($bulan=='12') {
            $blnT="Dec ".$tahun;
        }else{
            $blnT = "";
        }

        return $blnT;
    }

    public function generateStrukturPegawai(){
        $nrk = ""; $thbl = "";
        if(isset($_POST['nrk'])){
            $nrk = $_POST['nrk'];
        }else{
            $return = array('response' => 'GAGAL', 'err' => 'No NRK');
            echo json_encode($return);
            exit();
        }

        if(isset($_POST['thbl'])){
            $thbl = $_POST['thbl'];
        }else{
            $return = array('response' => 'GAGAL', 'err' => 'No THBL');
            echo json_encode($return);
            exit();
        }

        $thbl = $this->convert->convertNamaBulanTahun($thbl);
        $bawahan = $this->infopegawai->getStrukturPegawai($nrk,$thbl);

        $return = array('response' => 'SUKSES', 'result' => $bawahan);
        echo json_encode($return);
    }

    public function generateRiwayat(){
        $ug = $this->user['user_group'];

        // START REQUEST RIwAYAT
        if(isset($_POST['id_riwayat'])){
            $id = $_POST['id_riwayat'];
        }else{
            $id = 1;
        }
        // END REQUEST RIwAYAT

        // START GET NRK
        if(isset($_POST['nrk'])){
            $nrk = $_POST['nrk'];
        }else{
            $nrk = $this->user['id'];
        }

        // END GET NRK
        if($ug == 11 || $ug == 4)
        {
            switch ($id) {
            case 'jabstruk': //Jabatan Struktural
                $hasil = $this->infopegawai->getRiwayatJabatanStrukturalPeg($nrk,$ug,$id);
                break;
            case 'jabfung': //Jabatan Fungsional
                $hasil = $this->infopegawai->getRiwayatJabatanFungsionalPeg($nrk,$ug,$id);
                break;
            case 'penform': //Pendidikan Formal
                $hasil = $this->infopegawai->getRiwayatPendidikanFormal($nrk,$ug,$id);
                break;
            case 'pennform': //Pendidikan Non Formal
                $hasil = $this->infopegawai->getRiwayatPendidikanNonFormal($nrk,$ug,$id);
                break;
            case 'pang': //Pangkat
                $hasil = $this->infopegawai->getRiwayatPangkatPeg($nrk,$ug,$id);
                break;
            case 'gapok': //Gaji Pokok
                $hasil = $this->infopegawai->getRiwayatGapokPeg($nrk,$ug,$id); //TAMBAHKAN JENRUB
                break;
            case 'hukdis': //Hukuman Disiplin
                $hasil = $this->infopegawai->getHukumanDisiplinPeg($nrk,$ug,$id);
                break;
            case 'hukadm': //Hukuman Administrasi
                $hasil = $this->infopegawai->getHukumanAdministrasiPeg($nrk,$ug,$id);
                break;
            case 'dp3': //DP3
                $hasil = $this->infopegawai->getRiwayatDP3($nrk,$ug,$id);
                break;
            case 'abs': //Absensi
                $hasil = $this->infopegawai->getRiwayatAbsensi($nrk,$ug,$id);
                break;
            case 'cuti': //Cuti
                $hasil = $this->infopegawai->getRiwayatCutiPeg($nrk,$ug,$id);
                break;
            case 'pemb': //Pembatasan
                $hasil = $this->infopegawai->getRiwayatPembatasan($nrk,$ug,$id);
                break;
            case 'sem': //Seminar
                $hasil = $this->infopegawai->getRiwayatSeminar($nrk,$ug,$id);
                break;
            case 'tul': //Tulisan
                $hasil = $this->infopegawai->getRiwayatTulisan($nrk,$ug,$id);
                break;
            case 'ala': //Alamat
                $hasil = $this->infopegawai->getRiwayatAlamatPeg3($nrk,$ug,$id);
                break;
            case 'hrg': //Penghargaan
                $hasil = $this->infopegawai->getRiwayatPenghargaanPeg($nrk,$ug,$id);
                break;
            case 'fas': //Fasilitas
                $hasil = $this->infopegawai->getRiwayatFasilitas($nrk,$ug,$id);
                break;
            case 'org': //Organisasi
                $hasil = $this->infopegawai->getRiwayatOrganisasi($nrk,$ug,$id);
                break;
            case 'kel': //Keluarga
                $hasil = $this->infopegawai->getRiwayatHubunganKeluarga($nrk,$ug,$id);
                break;
            case 'lp2p': //LP2P
                $hasil = $this->infopegawai->getRiwayatLp2p($nrk,$ug,$id);
                break;
            case 'lit': //Litsus
                $hasil = $this->infopegawai->getRiwayatLitsus($nrk,$ug,$id);
                break;
            case 'tpa': //Test TPA
                $hasil = $this->infopegawai->getRiwayatTpa($nrk,$ug,$id);
                break;
            case 'tp': //Test TP
                $hasil = $this->infopegawai->getRiwayatTp($nrk,$ug,$id);
                break;
            case 'mak': //Makalah
                $hasil = $this->infopegawai->getRiwayatMakalah($nrk,$ug,$id);
                break;
            case 'gab': //Test Gabungan
                // $hasil = $this->infopegawai->getRiwayatGapok($nrk);
                break;
            case 'tupoksi': //TUPOKSI
                $hasil = $this->infopegawai->getRefTupoksi($nrk,$ug,$id);
                break;
            default:
                $hasil = "<small class='text-danger'>Tidak Ada Riwayat Yang Ditampilkan</small>";
                break;
            }
        }
        else
        {
            switch ($id) {
            case 'jabstruk': //Jabatan Struktural
                $hasil = $this->infopegawai->getRiwayatJabatanStruktural($nrk,$ug,$id);
                break;
            case 'jabfung': //Jabatan Fungsional
                $hasil = $this->infopegawai->getRiwayatJabatanFungsional($nrk,$ug,$id);
                break;
            case 'penform': //Pendidikan Formal
                $hasil = $this->infopegawai->getRiwayatPendidikanFormal2($nrk,$ug,$id);
                break;
            case 'pennform': //Pendidikan Non Formal
                $hasil = $this->infopegawai->getRiwayatPendidikanNonFormal2($nrk,$ug,$id);
                break;
            case 'pang': //Pangkat
                $hasil = $this->infopegawai->getRiwayatPangkat($nrk,$ug,$id);
                break;
            case 'gapok': //Gaji Pokok
                $hasil = $this->infopegawai->getRiwayatGapok($nrk,$ug,$id); //TAMBAHKAN JENRUB
                break;
            case 'hukdis': //Hukuman Disiplin
                $hasil = $this->infopegawai->getHukumanDisiplin($nrk,$ug,$id);
                break;
            case 'hukadm': //Hukuman Administrasi
                $hasil = $this->infopegawai->getHukumanAdministrasi($nrk,$ug,$id);
                break;
            case 'dp3': //DP3
                $hasil = $this->infopegawai->getRiwayatDP3($nrk,$ug,$id);
                break;
            case 'abs': //Absensi
                $hasil = $this->infopegawai->getRiwayatAbsensi($nrk,$ug,$id);
                break;
            case 'cuti': //Cuti
                $hasil = $this->infopegawai->getRiwayatCuti($nrk,$ug,$id);
                break;
            case 'pemb': //Pembatasan
                $hasil = $this->infopegawai->getRiwayatPembatasan($nrk,$ug,$id);
                break;
            case 'sem': //Seminar
                $hasil = $this->infopegawai->getRiwayatSeminar($nrk,$ug,$id);
                break;
            case 'tul': //Tulisan
                $hasil = $this->infopegawai->getRiwayatTulisan($nrk,$ug,$id);
                break;
            case 'ala': //Alamat
                //$hasil = $this->infopegawai->getRiwayatAlamatPeg2($nrk,$ug,$id);
                $session_data='';
                if($this->user){
                    $session_data=$this->user;
                }
                $hasil = $this->infopegawai->getRiwayatAlamatPeg2($nrk,$ug,$id,$this->user);
                break;
            case 'hrg': //Penghargaan
                $hasil = $this->infopegawai->getRiwayatPenghargaan($nrk,$ug,$id);
                break;
            case 'fas': //Fasilitas
                $hasil = $this->infopegawai->getRiwayatFasilitas($nrk,$ug,$id);
                break;
            case 'org': //Organisasi
                $hasil = $this->infopegawai->getRiwayatOrganisasi($nrk,$ug,$id);
                break;
            case 'kel': //Keluarga
                $session_data='';
                if($this->user){
                    $session_data=$this->user;
                }
                $hasil = $this->infopegawai->getRiwayatHubunganKeluarga2($nrk,$ug,$id,$this->user);
                break;
            case 'lp2p': //LP2P
                $hasil = $this->infopegawai->getRiwayatLp2p($nrk,$ug,$id);
                break;
            case 'lit': //Litsus
                $hasil = $this->infopegawai->getRiwayatLitsus($nrk,$ug,$id);
                break;
            case 'tpa': //Test TPA
                $hasil = $this->infopegawai->getRiwayatTpa($nrk,$ug,$id);
                break;
            case 'tp': //Test TP
                $hasil = $this->infopegawai->getRiwayatTp($nrk,$ug,$id);
                break;
            case 'mak': //Makalah
                $hasil = $this->infopegawai->getRiwayatMakalah($nrk,$ug,$id);
                break;
            case 'gab': //Test Gabungan
                // $hasil = $this->infopegawai->getRiwayatGapok($nrk);
                break;
            case 'tupoksi': //TUPOKSI
                $hasil = $this->infopegawai->getRefTupoksi($nrk,$ug,$id);
                break;
            /*case 'on':
                $hasil='';
                break;*/
            default:
                $hasil = "<small class='text-danger'>Tidak Ada Riwayat Yang Ditampilkan</small>";
                break;
            }
        }
        


        $param = array('response' => 'SUKSES', 'result' => $hasil);

        echo json_encode($param);
    }

    public function generateForm(){
        
        if(isset($_POST['form'])){
            $form = $_POST['form'];
            // var_dump($form);

            $nrk = $_POST['nrk'];
        }else{
            $return = array('response' => 'GAGAL', 'err' => 'No Form');
            echo json_encode($return);
            exit();
        }

        $data = $this->generateDataForm($form);
        $widthForm = $data['widthForm'];
        // var_dump($data);exit;
        $data['nrk'] = $nrk;

        //Dapatkan TMT Mutasi dan TMT CPNS
        $listdata = $this->mdl->get_data($nrk)->row();
        if ($listdata->TMTPINDAH != NULL){
            $data['tmtpindah'] = date('Y-m-d',strtotime($listdata->TMTPINDAH));
        } else {
            $data['tmtpindah'] = '';
        }

        if ($listdata->MUANG != NULL){
            $data['muang'] = date('Y-m-d',strtotime($listdata->MUANG));
        } else {
            $data['muang'] = '';
        }


        $msg = $this->load->view('admin/form_hist/form_'.$form, $data, true);
//        var_dump($msg);exit;
        $return = array('response' => 'SUKSES', 'result' => $msg, 'widthForm' => $widthForm);
        echo json_encode($return);
    }
    
    public function test_form()
    {
        $this->load->view('admin/form_hist/form_keluarga_2');
    }
    
    public function getCurrentInformation(){
        $post = $this->input->post();
        $result = $this->home->currentInformation($post['nrk']);
        echo json_encode($result);
    }

    public function generateDataForm($form){
        $data['empty'] = ""; $data['widthForm'] = "two";
        switch ($form) {
            case 'jabatan_hist':

                $action = $this->input->post('action');//action
                $nrk = $this->input->post('nrk');//nrk
                $nrk2 = $this->input->post('key1');//nrk
                $tmt = $this->input->post('key2');//tmt
                $kolok = $this->input->post('key3');//kolok


                
                $kojab = $this->input->post('key4');//kojab
                $kopang = "";$eselon = ""; $pejtt = "";$klogad="";$spmu="";$tmtpensiun="";

                $data['action'] = $action;
                
                if($action != null && $action == 'tambah'){
                    
                    $dtpgw1 = $this->home->getDataPeg1($nrk);
                    $klopeg1 = $dtpgw1->KLOGAD;
                    $kolpeg1 = $dtpgw1->KOLOK;


                    $data['listKolok']  = $this->infopegawai->getKolokAktifJoin($kolpeg1);
                    $data['listKlogad'] = $this->infopegawai->getKolokAktifJoin($klopeg1);

                    $data['listEselon'] = $this->infopegawai->getHistEselonAdd($eselon);
                    $data['listjensk'] = $this->infopegawai->getJenSKAdd();

                    $data['lastPangkat'] = $this->infopegawai->getLastPangkat($nrk,$kopang);
                    //var_dump($data['lastPangkat']);

                    if($data['lastPangkat']!=null)
                    {
                        
                        $data['listKopang'] = $this->infopegawai->getMasterPangkat2($data['lastPangkat']->KOPANG);    
                        
                    }
                    else
                    {
                        $data['listKopang'] = $this->infopegawai->getMasterPangkat2();    
                    }  
                    
                }

                else if($action != null && $action == 'update'){                    
                    $data['infoJabatan'] = $this->infopegawai->getKojabHistBy($nrk2,$tmt,$kolok,$kojab);
                    // var_dump($data['infoJabatan']);exit;
                    $data['listKojab'] = $this->infopegawai->getMasterKojab($kolok,$kojab);

                    $kopang = $data['infoJabatan']->KOPANG;
                    $eselon = $data['infoJabatan']->ESELON;
                    $pejtt = $data['infoJabatan']->PEJTT;
                    $klogad = $data['infoJabatan']->KLOGAD;
                    $spmu = $data['infoJabatan']->SPMU;
                    $tmtpensiun = $data['infoJabatan']->TMTPENSIUN;
                    $jenis_sk = $data['infoJabatan']->JENIS_SK;

                    $cekAktif = $this->infopegawai->cekAktifKolok($kolok);
                    $resaktif = $cekAktif->AKTIF;

                    if($resaktif == 1)
                    {
                        $data['listKolok']  = $this->infopegawai->getKolokAktifJoin($kolok); 
                    }
                    else
                    {
                        $data['listKolok']  = $this->infopegawai->getMasterKolokAll($kolok); 
                    }
                   // var_dump($data['infoJabatan']);
                    $data['listKlogad'] = $this->infopegawai->getKolokAktifJoin($klogad); 
                    $data['nmSPMU'] = $this->mdl->getKeteranganSPMU($spmu);
                    $data['listEselon'] = $this->infopegawai->getHistEselon($eselon);
                    $data['listjensk'] = $this->infopegawai->getJenSK($jenis_sk);

                    $data['kolok'] = $kolok;
                    $data['kojab'] = $kojab;
                    $data['listKopang'] = $this->infopegawai->getMasterPangkat2($kopang);
                }
                //var_dump($data['listKolok']);exit;

                $data['listPejtt'] = $this->infopegawai->getMasterPejtt($pejtt);
                break;

            case 'jabatanf_hist':
                $action = $this->input->post('action');//action
                $nrk = $this->input->post('nrk');//nrk
                $nrk2 = $this->input->post('key1');//nrk
                $tmt = $this->input->post('key2');//tmt
                $kojab = $this->input->post('key3');//kojab                
                $kopang = ""; $pejtt = ""; $kolok = ""; $klogad="";$spmu="";$tmtpensiun="";

                $data['action'] = $action;

                if($action != null && $action == 'update'){                    
                    $data['infoJabatan'] = $this->infopegawai->getKojabfHistBy($nrk2,$tmt,$kojab);                    
                    $kopang = $data['infoJabatan']->KOPANG;                    
                    $pejtt = $data['infoJabatan']->PEJTT;
                    $kolok = $data['infoJabatan']->KOLOK;
                    $klogad = $data['infoJabatan']->KLOGAD;
                    $spmu = $data['infoJabatan']->SPMU;
                    $tmtpensiun = $data['infoJabatan']->TMTPENSIUN;
                    $jenis_sk = $data['infoJabatan']->JENIS_SK;

                    $cekAktif = $this->infopegawai->cekAktifKolok($kolok);
                    $resaktif = $cekAktif->AKTIF;

                    if($resaktif == 1)
                    {
                        $data['listKolok']  = $this->infopegawai->getKolokAktifJoin($kolok); 
                    }
                    else
                    {
                        $data['listKolok']  = $this->infopegawai->getMasterKolokAll($kolok); 
                    }
                    $data['listKlogad'] = $this->infopegawai->getKolokAktifJoin($klogad);
                    $data['listjensk'] = $this->infopegawai->getJenSK($jenis_sk);

                    $data['nmSPMU'] = $this->mdl->getKeteranganSPMU($spmu);
                    $data['kojab'] = $kojab;

                    $data['listKopang'] = $this->infopegawai->getMasterPangkat2($kopang);
                }
                else if($action == 'tambah')
                {   
                     $data['listKolok'] = $this->infopegawai->getKolokAktifJoin($kolok);
                    //$data['listKolok']  = $this->infopegawai->getKolokAktifJoin($kolok);
                    $data['listKlogad'] = $this->infopegawai->getKolokAktifJoin($klogad);
                    $data['listjensk'] = $this->infopegawai->getJenSKAdd();

                     $data['lastPangkat'] = $this->infopegawai->getLastPangkat($nrk,$kopang);
                         
                    $data['listKopang'] = $this->infopegawai->getMasterPangkat2($data['lastPangkat']->KOPANG);
                }
                $data['listKojabf'] = $this->infopegawai->getMasterKojabf($kojab);
                //$data['lastPangkat'] = $this->infopegawai->getLastPangkat($nrk,$kopang);
                $data['listPejtt'] = $this->infopegawai->getMasterPejtt($pejtt);
                break;

            case 'pendidikan_formal_2':
                $data['widthForm'] = "one";
                $action = $this->input->post('action');//action
                $nrk = $this->input->post('nrk');//nrk
                $nrk2 = $this->input->post('key1');//nrk
                $jendik = $this->input->post('key2');//jendik
                $kodik = $this->input->post('key3');//kodik
                $jenpdk="";   
                $univer = "";
                $titeldepan="";
                $titelbelakang="";
                $stat="";

                $data['action']=$action;

                if($action != null && $action == 'update'){                    
                    $data['infoPendidikan'] = $this->infopegawai->getPendidikanHistBy($nrk2,$jendik,$kodik);                    
                    $univer = $data['infoPendidikan']->UNIVER;
                    $titeldepan = $data['infoPendidikan']->TITELDEPAN;
                    $titelbelakang = $data['infoPendidikan']->TITELBELAKANG;
                    $stat=$data['infoPendidikan']->STAT_APP;

                    $data['listKodik'] = $this->infopegawai->getMasterKodik($jendik,$kodik);
                    //$data['listStatus']=$this->infopegawai->getStatApp($stat);
                    //$data['listUniver'] = $this->infopegawai->getMasterUniver($univer);
                }
                /*else if($action == 'tambah')
                {
                    
                    $data['listUniver'] = $this->infopegawai->getMasterUniverDikti($univer);   
                }*/
                
                $data['listPdk'] = $this->infopegawai->getJenjangPendidikan($jenpdk);
                $data['listKodik'] = $this->infopegawai->getMasterKodikByJenjang(1,$jenpdk,$kodik);    
                $data['listStatus'] = $this->infopegawai->getStatApp($stat);
                $data['listJendik'] = $this->infopegawai->getMasterJendikForm($jendik);
                
                $data['listUniver'] = $this->infopegawai->getMasterUniver($univer);
                break;

            case 'pendidikan_nonformal_2':
                $action = $this->input->post('action');//action
                $nrk = $this->input->post('nrk');//nrk
                $nrk2 = $this->input->post('key1');//nrk
                $jendik = $this->input->post('key2');//jendik
                $kodik = $this->input->post('key3');//kodik   
                $univer = "";
                $stat="";

                $data['action'] = $action;

                if($action != null && $action == 'update'){                    
                    $data['infoPendidikan'] = $this->infopegawai->getPendidikanHistBy($nrk2,$jendik,$kodik);                    
                    $univer = $data['infoPendidikan']->UNIVER;
                    $data['listKodik'] = $this->infopegawai->getMasterKodik($jendik,$kodik);
                    $stat=$data['infoPendidikan']->STAT_APP;
                }

                $data['listStatus'] = $this->infopegawai->getStatApp($stat);
                $data['listJendik'] = $this->infopegawai->getMasterJendikNonForm($jendik);
                $data['listUniver'] = $this->infopegawai->getMasterUniver($univer);
                break;

            case 'pangkat':
                $action = $this->input->post('action');//action
                $id1 = $this->input->post('key1');//nrk
                $id2 = $this->input->post('key2');//tmt
                $id3 = $this->input->post('key3');//kopang
             
                $id4 = "";//kolok
                $id5 = "";//pejtt
                $id6 = "";//ttmasker
                $klogad="";
                $spmu="";
                $jenrub="";

                $data['action'] = $action;

                $nrk = $this->input->post('nrk');
                
                
                if($action == 'tambah')
                {

                    $data['infopeg'] = $this->home->getDataPeg1($nrk);
                    $id4 = $data['infopeg']->KOLOK;
                    $kolok = $data['infopeg']->KOLOK;
                    $klogad = $data['infopeg']->KLOGAD;
                    $spmu = $data['infopeg']->SPMU;
                    $data['listjensk'] = $this->infopegawai->getJenSKAdd();
                    //$data['listKolok']  = $this->infopegawai->getKolokAktifJoin($kolok);
                    $data['listKolok'] = $this->infopegawai->getKolokAktifJoin($kolok);
                    $data['listKlogad']  = $this->infopegawai->getKolokAktifJoin($klogad);
                    $data['listJenrub'] = $this->infopegawai->getMasterJenrubPangkat($jenrub);

                    $maxtahun = $this->infopegawai->getMaxTahunRefGaji();

                    $data['listthref'] = $this->infopegawai->getMasterTahunRefGaji($maxtahun->TAHUN);  

                }
                else if($id1 != null && $id2 != null  && $id3 != null && $action == 'update'){
                    $data['infoPangkat'] = $this->home->getPangkatById($id1,$id2,$id3);
                    
                    $id4 = $data['infoPangkat']->KOLOK;
                    $id5 = $data['infoPangkat']->PEJTT;
                    $id6 = $data['infoPangkat']->TTMASKER;
                    $gapok = $data['infoPangkat']->GAPOK;
                    $jenrub = $data['infoPangkat']->JENRUB;
                    $threfgaji = $data['infoPangkat']->TAHUN_REFGAJI;
                    $data['infopeg'] = $this->home->getDataPeg1($id1);
                    $kolok = $data['infopeg']->KOLOK;
                    $klogad = $data['infopeg']->KLOGAD;
                    $spmu = $data['infopeg']->SPMU;

                    $id2 = date('Y-m-d',strtotime($id2));
                    
                   

                    //$data['infoGapok'] = $this->infopegawai->getGapokHistBy($id1,$id2,$gapok);
                    //$data['listKolok'] = $this->infopegawai->getMasterKolokAll($id4);

                    $cekAktif = $this->infopegawai->cekAktifKolok($kolok);
                    $resaktif = $cekAktif->AKTIF;

                    if($resaktif == 1)
                    {
                        $data['listKolok']  = $this->infopegawai->getKolokAktifJoin($id4); 
                    }
                    else
                    {
                        $data['listKolok']  = $this->infopegawai->getMasterKolokAll($id4); 
                    }

                    $data['listKlogad'] = $this->infopegawai->getKolokAktifJoin($klogad);
                    $data['listJenrub'] = $this->infopegawai->getMasterJenrubPangkat($jenrub);
                    //$data['listJenrub'] = $this->infopegawai->getMasterJenrubPangkat($data['infoGapok']->JENRUB);

                    $data['listthref'] = $this->infopegawai->getMasterTahunRefGaji($threfgaji);  
      
                }
                $data['ttbb'] = $this->home->getTTBBNowPg($nrk);
                $data['nmSPMU'] = $this->mdl->getKeteranganSPMU($spmu);
                
                
                
                $data['listKopang'] = $this->infopegawai->getMasterPangkat2($id3);
                $data['listPejtt'] = $this->infopegawai->getMasterPejtt($id5);
                break;

            case 'gapok':
                $action = $this->input->post('action');//action
                $nrk = $this->input->post('nrk');//nrk
                $nrk2 = $this->input->post('key1');//nrk
                $tmt = $this->input->post('key2');//tmt
                $gapok = $this->input->post('key3');//gapok 

                $gapokF= $this->input->post('gapokF');               
                $kopang = "";$kolok = ""; $jenrub = ""; $klogad=""; $spmu="";
                $ttnow="";

                $data['action'] = $action;
                $data['infopeg'] = $this->home->getDataPeg1($nrk);
                $data['stapeg'] = $this->home->getUserInfo2($nrk);
                $data['ttbb'] = $this->home->getTTBBNowPg($nrk);
                //var_dump($data['ttbb']); 
                
                $data['cekWaktu'] = $this->home->cekWaktuHukdis($nrk);
                //$tgakhir = $data['cekWaktu']->TGAKHIR;

                if($action != null && $action == 'tambah')
                {
                    
                    $kolok = $data['infopeg']->KOLOK;
                    $klogad = $data['infopeg']->KLOGAD;
                    $spmu = $data['infopeg']->SPMU;
                    $stpg=$data['stapeg']->STAPEG;
                    $kojab=$data['stapeg']->KOJAB;
                    $data['listjensk'] = $this->infopegawai->getJenSKAdd();
                    //$data['listKolok'] = $this->infopegawai->getKolokAktifJoin($kolok); 
                    $data['listKolok'] = $this->infopegawai->getKolokAktifJoin($kolok);
                     $data['listKlogad'] = $this->infopegawai->getKolokAktifJoin($klogad); 
                    
                    $maxtahun = $this->infopegawai->getMaxTahunRefGaji();

                    $pgktakhir = $this->infopegawai->getPangkatTerakhir($nrk);
                    if($pgktakhir == null)
                    {
                        $data['listKopang'] = $this->infopegawai->getMasterPangkat2();
                    }
                    else
                    {
                        $data['listKopang'] = $this->infopegawai->getMasterPangkat2($pgktakhir->KOPANG);       
                    }
                    

                    $data['listthref'] = $this->infopegawai->getMasterTahunRefGaji($maxtahun->TAHUN);  

                    $data['listJenrub'] = $this->infopegawai->getMasterJenrubGapok($jenrub);

                }
                else if($action != null && $action == 'update'){                    
                    $data['infoGapok'] = $this->infopegawai->getGapokHistBy($nrk2,$tmt,$gapok);                    
                    $kopang = $data['infoGapok']->KOPANG;
                    $kolok = $data['infoGapok']->KOLOK;
                    $jenrub = $data['infoGapok']->JENRUB; 
                    $jenis_sk = $data['infoGapok']->JENIS_SK;
                    $threfgaji = $data['infoGapok']->TAHUN_REFGAJI;


                    
                    $kolok = $data['infopeg']->KOLOK;
                    $klogad = $data['infopeg']->KLOGAD;
                    $spmu = $data['infopeg']->SPMU;
                    $stpg=$data['stapeg']->STAPEG;
                    $kojab=$data['stapeg']->KOJAB;
                    $data['listjensk'] = $this->infopegawai->getJenSK($jenis_sk);
                    $cekAktif = $this->infopegawai->cekAktifKolok($kolok);
                    $resaktif = $cekAktif->AKTIF;

                    if($resaktif == 1)
                    {
                        $data['listKolok']  = $this->infopegawai->getKolokAktifJoin($kolok); 
                    }
                    else
                    {
                        $data['listKolok']  = $this->infopegawai->getMasterKolokAll($kolok); 
                    }

                    $data['listKlogad'] = $this->infopegawai->getKolokAktifJoin($klogad);
                    $data['listthref'] = $this->infopegawai->getMasterTahunRefGaji($threfgaji);  
                    $data['listJenrub'] = $this->infopegawai->getMasterJenrub($jenrub);
                    $data['listKopang'] = $this->infopegawai->getMasterPangkat2($kopang);                
                }
                $data['nmSPMU'] = $this->mdl->getKeteranganSPMU($spmu);
                
                
                //$data['listJenrub'] = $this->infopegawai->getMasterJenrub($jenrub);
                
                
                
                break;

            case 'hukdis':
              
                $action = $this->input->post('action');//action
                $nrk = $this->input->post('nrk');//nrk
                $nrk2 = $this->input->post('key1');//nrk
                $tgsk = $this->input->post('key2');//tgsk   
                $jenhukdis = ""; $pejtt = "";

                $data['action'] = $action;



                if($action != null && $action == 'update'){                    
                    $data['infoHukdis'] = $this->infopegawai->getHukdisHistBy($nrk2,$tgsk);
                    //var_dump($data['infoHukdis']);exit;
                    $jenhukdis = $data['infoHukdis']->JENHUKDIS;
                    $pejtt = $data['infoHukdis']->PEJTT;
                    $tmtmulai_stoptkd = $data['infoHukdis']->TMTMULAI_STOPTKD;
                    $tmtakhir_stoptkd = $data['infoHukdis']->TMTAKHIR_STOPTKD;
                    $jmlbln_stoptkd = $data['infoHukdis']->JMLBLN_STOPTKD;
                    $ket = $data['infoHukdis']->KET;
                    $jenis_sk = $data['infoHukdis']->JENIS_SK;
                    $data['listjenishukdis'] = $this->infopegawai->getJenisHukdisAll($jenhukdis);
                   // $data['listjensk'] = $this->infopegawai->getJenSK($jenis_sk);
                }
                else if($action != null && $action == 'tambah')
                {
                    $data['listjenishukdis'] = $this->infopegawai->getJenisHukdis($jenhukdis);
                   // $data['listjensk'] = $this->infopegawai->getJenSKAdd();
                }
                
                $data['listPejtt'] = $this->infopegawai->getMasterPejtt($pejtt);
                break;

            case 'hukadmin':
            //$data['widthForm'] = "one";
                $action = $this->input->post('action');//action
                $nrk = $this->input->post('nrk');//nrk
                $nrk2 = $this->input->post('key1');//nrk
                $tgsk = $this->input->post('key2');//tgsk   
                $jenhukadm = ""; $pejtt = "";

                $data['action']=$action;

                if($action != null && $action == 'update'){                    
                    $data['infoHukadm'] = $this->infopegawai->getHukadmHistBy($nrk2,$tgsk);
                    $jenhukadm = $data['infoHukadm']->JENHUKADM;
                    $pejtt = $data['infoHukadm']->PEJTT;
                    /*$tmtmulai_stoptkd = $data['infoHukadm']->TMTMULAI_STOPTKD;
                    $tmtakhir_stoptkd = $data['infoHukadm']->TMTAKHIR_STOPTKD;
                    $jmlbln_stoptkd = $data['infoHukadm']->JMLBLN_STOPTKD;
                    $ket = $data['infoHukadm']->KET;*/
                }

                $data['listjenishukadm'] = $this->infopegawai->getJenisHukadmin($jenhukadm);
                $data['listPejtt'] = $this->infopegawai->getMasterPejtt($pejtt);
                
                break;

            case 'dp3':                
                $action = $this->input->post('action');//action
                $nrk = $this->input->post('nrk');//nrk
                $nrk2 = $this->input->post('key1');//nrk
                $tahun = $this->input->post('key2');//tahun 

                $data['action'] = $action;                  

                if($action != null && $action == 'update'){                    
                    $data['infoDp3'] = $this->infopegawai->getDp3HistBy($nrk2,$tahun);                    
                }
                
                break;

            case 'absensi':              
                $action = $this->input->post('action');//action
                $nrk = $this->input->post('nrk');//nrk
                $nrk2 = $this->input->post('key1');//nrk
                $thbl = $this->input->post('key2');//thbl
                
                if($action != null && $action == 'tambah'){                    
                    $data['infoUser'] = $this->home->getUserInfo2($nrk);
                }

                if($action != null && $action == 'update'){       
                    $data['bulantahun'] = $this->convertThbl($thbl);             
                    $data['infoUser'] = $this->infopegawai->getAbsensiHistBy($nrk2,$thbl);                    
                }

                break;

            case 'cuti':                
                $data['widthForm'] = "one";
                $action = $this->input->post('action');//action
                $nrk = $this->input->post('nrk');//nrk
                $nrk2 = $this->input->post('key1');//nrk
                $tmt = $this->input->post('key2');//tmt
                $pejtt = ""; $jencuti = "";

                $data['action'] = $action;
                
                if($action != null && $action == 'update'){                    
                    $data['infoCuti'] = $this->infopegawai->getCutiHistBy($nrk2,$tmt);  
                    $pejtt = $data['infoCuti']->PEJTT;
                    $jencuti = $data['infoCuti']->JENCUTI;
                    $jenis_sk = $data['infoCuti']->JENIS_SK;
                    $data['listjensk'] = $this->infopegawai->getJenSK($jenis_sk);
                }else{
                    $data['listjensk'] = $this->infopegawai->getJenSKAdd();

                }

                $data['listJenCuti'] = $this->infopegawai->getJenisCuti($jencuti);
                $data['listPejtt'] = $this->infopegawai->getMasterPejtt($pejtt);
                break;

            case 'pembatasan':
                $data['widthForm'] = "one";
                $action = $this->input->post('action');//action
                $nrk = $this->input->post('nrk');//nrk
                $nrk2 = $this->input->post('key1');//nrk
                $tmt = $this->input->post('key2');//tmt
                $pejtt = ""; $jenusaha = "";

                $data['action'] = $action;

                if($action != null && $action == 'update'){                    
                    $data['infoPembatasan'] = $this->infopegawai->getPembatasanHistBy($nrk2,$tmt);  
                    $pejtt = $data['infoPembatasan']->PEJTT;
                    $jenusaha = $data['infoPembatasan']->JENUSAHA;
                }

                $data['listJenisUsaha'] = $this->infopegawai->getJenisUsaha($jenusaha);
                $data['listPejtt'] = $this->infopegawai->getMasterPejtt($pejtt);
                break;

            case 'seminar':
                $data['widthForm'] = "one";
                $action = $this->input->post('action');//action
                $nrk = $this->input->post('nrk');//nrk
                $nrk2 = $this->input->post('key1');//nrk
                $tgmulai = $this->input->post('key2');//tgmulai
                $kdsemi = ""; $kdtema = ""; $kdperan = "";
                $data['action'] = $action;

                if($action != null && $action == 'update'){                    
                    $data['infoSeminar'] = $this->infopegawai->getSeminarHistBy($nrk2,$tgmulai);  
                    $kdsemi = $data['infoSeminar']->KDSEMI;
                    $kdtema = $data['infoSeminar']->KDTEMA;
                    $kdperan = $data['infoSeminar']->KDPERAN;
                }

                $data['listKdSemi'] = $this->infopegawai->getKodeSeminar($kdsemi);
                $data['listKdTema'] = $this->infopegawai->getKodeTemaSeminardanTulisan($kdtema);
                $data['listKdPeran'] = $this->infopegawai->getKodePeranSeminar($kdperan);
                break;

            case 'tulisan':
                $data['widthForm'] = "one";
                $action = $this->input->post('action');//action
                $nrk = $this->input->post('nrk');//nrk
                $nrk2 = $this->input->post('key1');//nrk
                $tgpublish = $this->input->post('key2');//tgpublish
                $kdsifat = ""; $kdtema = ""; $kdperan = ""; $kdlingkup = ""; $kdjlhkata = "";
                $data['action'] = $action;

                if($action != null && $action == 'update'){                    
                    $data['infoTulisan'] = $this->infopegawai->getTulisanHistBy($nrk2,$tgpublish);  
                    $kdtema = $data['infoTulisan']->KDTEMA;
                    $kdsifat = $data['infoTulisan']->KDSIFAT;                    
                    $kdlingkup = $data['infoTulisan']->KDLINGKUP;
                    $kdjlhkata = $data['infoTulisan']->KDJUMKATA;
                    $kdperan = $data['infoTulisan']->KDPERAN;
                }

                $data['listKdTema'] = $this->infopegawai->getKodeTemaSeminardanTulisan($kdtema);
                $data['listKdSifat'] = $this->infopegawai->getKodeSifatTulisan($kdsifat);                
                $data['listKdLingkup'] = $this->infopegawai->getKodeLingkupTulisan($kdlingkup);
                $data['listKdJumKata'] = $this->infopegawai->getKodeJumlahKataTulisan($kdjlhkata);
                $data['listKdPeran'] = $this->infopegawai->getKodePeranTulisan($kdperan);

                break;

            case 'alamat':             
                $action = $this->input->post('action');//action
                $nrk = $this->input->post('nrk');//nrk
                $nrk2 = $this->input->post('key1');//nrk
                $tgmulai = $this->input->post('key2');//tgmulai
                $kowil = ""; $kokec = ""; $kokel = ""; $prop = "";
                $kowil_ktp = ""; $kokec_ktp = ""; $kokel_ktp = ""; $prop_ktp = "";
                $stat="";

                $data['action'] = $action;

                if($action != null && $action == 'update'){                    
                    $data['infoAlamat'] = $this->infopegawai->getAlamatHistBy($nrk2,$tgmulai);  
                    $kowil = $data['infoAlamat']->KOWIL;
                    $kokec = $data['infoAlamat']->KOCAM;
                    $kokel = $data['infoAlamat']->KOKEL;
                    $prop = $data['infoAlamat']->PROP;

                    $kowil_ktp = $data['infoAlamat']->KOWIL_KTP;
                    $kokec_ktp = $data['infoAlamat']->KOCAM_KTP;
                    $kokel_ktp = $data['infoAlamat']->KOKEL_KTP;
                    $prop_ktp = $data['infoAlamat']->PROP_KTP;

                    $stat = $data['infoAlamat']->STAT_APP;
                }

                
                $data['listPropinsi'] = $this->infopegawai->getPropinsiNew2($prop);
                $data['listWilayah'] = $this->infopegawai->getWilayahNew2($prop,$kowil);
                $data['listKecamatan'] = $this->infopegawai->getKecamatanNew2($kowil,$kokec);                
                $data['listKelurahan'] = $this->infopegawai->getKelurahanNew2($kokec,$kokel);

                $data['listPropinsiKtp'] = $this->infopegawai->getPropinsiNew2($prop_ktp);
                $data['listWilayahKtp'] = $this->infopegawai->getWilayahNew2($prop_ktp,$kowil_ktp);
                $data['listKecamatanKtp'] = $this->infopegawai->getKecamatanNew2($kowil_ktp,$kokec_ktp);
                $data['listKelurahanKtp'] = $this->infopegawai->getKelurahanNew2($kokec_ktp,$kokel_ktp);

                $data['listStatus']=$this->infopegawai->getStatApp($stat);

                break;
                
            case 'alamat_2':
                               
                $action = $this->input->post('action');//action
                $nrk = $this->input->post('nrk');//nrk
                $nrk2 = $this->input->post('key1');//nrk
                $tgmulai = $this->input->post('key2');//tgmulai
                $kowil = ""; $kokec = ""; $kokel = ""; $prop = "";
                $kowil_ktp = ""; $kokec_ktp = ""; $kokel_ktp = ""; $prop_ktp = "";
                $stat="";

                $data['action'] = $action;

                if($action != null && $action == 'update'){                    
                    $data['infoAlamat'] = $this->infopegawai->getAlamatHistBy($nrk2,$tgmulai);  
                    $kowil = $data['infoAlamat']->KOWIL;
                    $kokec = $data['infoAlamat']->KOCAM;
                    $kokel = $data['infoAlamat']->KOKEL;
                    $prop = $data['infoAlamat']->PROP;

                    $kowil_ktp = $data['infoAlamat']->KOWIL_KTP;
                    $kokec_ktp = $data['infoAlamat']->KOCAM_KTP;
                    $kokel_ktp = $data['infoAlamat']->KOKEL_KTP;
                    $prop_ktp = $data['infoAlamat']->PROP_KTP;

                    $stat = $data['infoAlamat']->STAT_APP;
                }

                $data['listPropinsi'] = $this->infopegawai->getPropinsiNew2($prop);
                $data['listWilayah'] = $this->infopegawai->getWilayahNew2($prop,$kowil);
                $data['listKecamatan'] = $this->infopegawai->getKecamatanNew2($kowil,$kokec);                
                $data['listKelurahan'] = $this->infopegawai->getKelurahanNew2($kokec,$kokel);

                $data['listPropinsiKtp'] = $this->infopegawai->getPropinsiNew2($prop_ktp);
                $data['listWilayahKtp'] = $this->infopegawai->getWilayahNew2($prop,$kowil_ktp);
                $data['listKecamatanKtp'] = $this->infopegawai->getKecamatanNew2($kowil_ktp,$kokec_ktp);
                $data['listKelurahanKtp'] = $this->infopegawai->getKelurahanNew2($kokec_ktp,$kokel_ktp);

                $data['listStatus']=$this->infopegawai->getStatApp($stat);
                break;

            case 'penghargaan':
                $data['widthForm'] = "one";                
                $action = $this->input->post('action');//action
                $nrk = $this->input->post('nrk');//nrk
                $nrk2 = $this->input->post('key1');//nrk
                $kdharga = $this->input->post('key2');//kdharga

                $data['action'] = $action;                

                if($action != null && $action == 'update'){                    
                    $data['infoPenghargaan'] = $this->infopegawai->getPenghargaanHistBy($nrk2,$kdharga); 
                                      
                }else{
                    
                }

                $data['listJenisPenghargaan'] = $this->infopegawai->getJenisPenghargaan($kdharga);                
                break;

            case 'fasilitas':
                $data['widthForm'] = "one";
                $action = $this->input->post('action');//action
                $nrk = $this->input->post('key1');//nrk
                $nrk2 = $this->input->post('nrk');//nrk
                $jenfas = $this->input->post('key2');//jenfas                
                $thdapat = $this->input->post('key3');//jenfas
                
                $instansi="";
                $klogad="";
                $spmu="";
                $kowil="";
                $kocam="";
                $kokel="";

                $data['action'] = $action;
                if($action != null && $action == 'update'){                    
                    $data['infoFasilitas'] = $this->infopegawai->getFasilitasHistBy($nrk2,$jenfas,$thdapat);                    
                    $instansi = $data['infoFasilitas']->INSTANSI;
                    $klogad = $data['infoFasilitas']->KLOGAD;
                    $spmu = $data['infoFasilitas']->SPMU;
                    $kowil = $data['infoFasilitas']->KOWIL;
                    $kocam = $data['infoFasilitas']->KOCAM; 
                    $kokel = $data['infoFasilitas']->KOKEL;
                    $data['listFasilitas'] = $this->infopegawai->getMasterFasilitas($jenfas);
                    
                }
                $data['nmSPMU'] = $this->mdl->getKeteranganSPMU($spmu);
                $data['listInstansi'] = $this->infopegawai->getMasterInstansi2($instansi);
                $data['listFasilitas'] = $this->infopegawai->getMasterFasilitas($jenfas);

                $data['listKlogad'] = $this->infopegawai->getMasterKolok($klogad);
                $data['SPMU'] = $spmu;

                $data['listKowil'] = $this->infopegawai->getWilayah($kowil);
                $data['listKocam'] = $this->infopegawai->getKecamatan($kowil,$kocam);                
                $data['listKokel'] = $this->infopegawai->getKelurahan($kowil,$kocam,$kokel);  
                break;

            case 'organisasi':
                $data['widthForm'] = "one";
                $action = $this->input->post('action');//action
                $nrk = $this->input->post('nrk');//nrk
                $nrk2 = $this->input->post('key1');//nrk
                $dari = $this->input->post('key2');//dari                
                $kdduduk = "";

                $data['action'] = $action;

                if($action != null && $action == 'update'){                    
                    $data['infoOrganisasi'] = $this->infopegawai->getOrganisasiHistBy($nrk2,$dari);                    
                    $kdduduk = $data['infoOrganisasi']->KDDUDUK;
                }

                $data['listKdKedudukan'] = $this->infopegawai->getKodeKedudukan($kdduduk);                
                break;

            case 'keluarga_2':
                
                $action = $this->input->post('action');//action
                $nrk = $this->input->post('nrk');//nrk
                $nrk2 = $this->input->post('key1');//nrk
                //$hubkel = $this->input->post('key2');//dari 
                $hubkel="";
                $stattun="";
                $kdkerja="";
                $uangduka="";
                $stat="";
                $data['action'] = $action;
                if($action != null && $action == 'update')
                {  
                    $hubkel = $this->input->post('key2');//dari                   
                    $data['infoKeluarga'] = $this->infopegawai->getKeluargaHistBy($nrk2,$hubkel); 
                    
                    $hubkel = $data['infoKeluarga']->HUBKEL;
                    $stattun = $data['infoKeluarga']->STATTUN;
                    $kdkerja = $data['infoKeluarga']->KDKERJA;
                    $uangduka = $data['infoKeluarga']->UANGDUKA;
                    $stat = $data['infoKeluarga']->STAT_APP;
                    $umur = $data['infoKeluarga']->UMUR;
                    $talhir = $data['infoKeluarga']->TALHIR;
                    
                    $data['listKdHubkel'] = $this->infopegawai->getKodeHubkelAll($hubkel);
                    //$data['listStatusTunjangan'] = $this->infopegawai->getKodeStattun($stattun);
                    // var_dump($stattun);


                    //cek jumlah anak
                    $cekAnak = "SELECT * from PERS_KELUARGA 
                            WHERE HUBKEL IN(11,12,13,14,15,16,17,18,19,21,22,23,24,25,26,27,28,29,31,32,33,34,35,36,37,38,39,41,42,43,44,45,46,47,48,49,58) AND NRK='".$nrk."'";
               
                    $queryCekAnak = $this->db->query($cekAnak);
                    $numAnak = $queryCekAnak->num_rows();


                    //cek anak kena tunjang
                    $cek = "SELECT * from PERS_KELUARGA 
                            WHERE (STATTUN = 1 OR STATTUN = 3) AND 
                            HUBKEL IN(11,12,13,14,15,16,17,18,19,21,22,23,24,25,26,27,28,29,31,32,33,34,35,36,37,38,39,41,42,43,44,45,46,47,48,49,58) AND NRK='".$nrk."'";
               
                    $queryCek = $this->db->query($cek);
                    $num = $queryCek->num_rows();

                    //cek istri
                    $cekIstri1 = "SELECT * FROM PERS_KELUARGA WHERE (HUBKEL = 10 OR HUBKEL = 20 OR HUBKEL =30 OR HUBKEL =40) AND STATTUN = 1 AND NRK ='".$nrk."'";
                    $queryCekIstri1 = $this->db->query($cekIstri1);
                    $numIstri = $queryCekIstri1->num_rows();


                    if($hubkel == 11||$hubkel == 12||$hubkel == 13||$hubkel == 14||$hubkel == 15||$hubkel == 16||$hubkel == 17||$hubkel == 18||$hubkel == 19||
                       $hubkel == 21||$hubkel == 22||$hubkel == 23||$hubkel == 24||$hubkel == 25||$hubkel == 26||$hubkel == 27||$hubkel == 28||$hubkel == 29|| 
                       $hubkel == 31||$hubkel == 32||$hubkel == 33||$hubkel == 34||$hubkel == 35||$hubkel == 36||$hubkel == 37||$hubkel == 38||$hubkel == 39||
                       $hubkel == 41||$hubkel == 42||$hubkel == 43||$hubkel == 44||$hubkel == 45||$hubkel == 46||$hubkel == 47||$hubkel == 48||$hubkel == 49||
                       $hubkel == 58)
                    {
                        if($numAnak<=2)
                        {       
                                if($num<2)
                                {

                                    if($stattun !=2)
                                    {

                                        if($umur>=21 && $umur <25)
                                        {
                                            $data['listStatusTunjangan'] = $this->infopegawai->getKodeStattunAll($stattun);
                                        }
                                        else
                                        {
                                            $data['listStatusTunjangan'] = $this->infopegawai->getKodeStattun($stattun);    
                                        }    
                                    }
                                    else
                                    {
                                        if($umur>=21 && $umur <25)
                                        {
                                            $data['listStatusTunjangan'] = $this->infopegawai->getKodeStattunTanpa1($stattun);
                                        }
                                        else
                                        {
                                            $data['listStatusTunjangan'] = $this->infopegawai->getKodeStattun($stattun);  
                                        }
                                    }
                                }
                                else if($num == 2)
                                {
                                    if($stattun == 1)
                                    {
                                        $data['listStatusTunjangan'] = $this->infopegawai->getKodeStattun($stattun);
                                    }
                                    else if($stattun == 3)
                                    {
                                        $data['listStatusTunjangan'] = $this->infopegawai->getKodeStattunTanpa1($stattun);
                                    }
                                    else
                                    {
                                        $data['listStatusTunjangan'] = $this->infopegawai->getKodeStattunHanya2($stattun);
                                    }
                                }
                                else
                                {
                                    if($stattun == 1)
                                    {
                                        $data['listStatusTunjangan'] = $this->infopegawai->getKodeStattun($stattun);
                                    }
                                    else if($stattun == 3)
                                    {
                                        $data['listStatusTunjangan'] = $this->infopegawai->getKodeStattunTanpa1($stattun);
                                    }
                                    else
                                    {
                                        $data['listStatusTunjangan'] = $this->infopegawai->getKodeStattunHanya2($stattun);
                                    }
                                }
                        }
                        else
                        {
                            
                            if($num==2)
                            {
                                if($stattun == 1)
                                {
                                    $data['listStatusTunjangan'] = $this->infopegawai->getKodeStattun($stattun);
                                }
                                else if($stattun == 3)
                                {
                                    $data['listStatusTunjangan'] = $this->infopegawai->getKodeStattunTanpa1($stattun);
                                }
                                else
                                {
                                    $data['listStatusTunjangan'] = $this->infopegawai->getKodeStattunHanya2($stattun);
                                }
                                
                            }
                            else if($num<2)
                            {
                                if($umur>=21 && $umur <25)
                                {
                                    $data['listStatusTunjangan'] = $this->infopegawai->getKodeStattunAll($stattun);
                                }
                                else
                                {
                                    $data['listStatusTunjangan'] = $this->infopegawai->getKodeStattun($stattun);    
                                }
                            }
                            else
                            {
                                $data['listStatusTunjangan'] = $this->infopegawai->getKodeStattunHanya2($stattun);
                            }
                        }
                    }
                    else if($hubkel == 10 ||$hubkel == 20 ||$hubkel == 30 ||$hubkel == 40)
                    {

                        $data['istritun'] = $numIstri;

                        if($numIstri == 1 || $numIstri == 0)
                        {
                            $data['listStatusTunjangan'] = $this->infopegawai->getKodeStattun($stattun); 
                        }
                        else
                        {
                            $data['listStatusTunjangan'] = $this->infopegawai->getKodeStattunHanya2($stattun);  
                        }
                    }
                    else
                    {
                        $data['listStatusTunjangan'] = $this->infopegawai->getKodeStattunHanya2($stattun); 
                    }

                    

                    /*if($stattun !=2)
                    {
                        if($umur>=21 && $umur <25)
                        {

                            $data['listStatusTunjangan'] = $this->infopegawai->getKodeStattunAll($stattun);
                        }
                        else
                        {
                            $data['listStatusTunjangan'] = $this->infopegawai->getKodeStattun($stattun);    
                        }    
                    }
                    else 
                    {
                        if($umur>=21 && $umur <25)
                        {

                            $data['listStatusTunjangan'] = $this->infopegawai->getKodeStattunTanpa1($stattun);
                        }
                        else
                        {
                            

                            
                             
                        }   

                        
                    }*/
                    
                }
                else if($action != null && $action == 'tambah')
                {
                   $cek = "SELECT * from PERS_KELUARGA WHERE (STATTUN = 1 OR STATTUN =3) AND HUBKEL IN(11,12,13,14,15,16,17,18,19,21,22,23,24,25,26,27,28,29,31,32,33,34,35,36,37,38,39,41,42,43,44,45,46,47,48,49,58) AND NRK='".$nrk."'";
                   
                    $queryCek = $this->db->query($cek);
                    $num = $queryCek->num_rows();

                    $cekIstri1 = "SELECT * FROM PERS_KELUARGA WHERE (HUBKEL = 10 OR HUBKEL = 20 OR HUBKEL =30 OR HUBKEL =40) AND STATTUN = 1 AND NRK ='".$nrk."'";
                    $queryCekIstri1 = $this->db->query($cekIstri1);
                    $numIstri = $queryCekIstri1->num_rows();

                    $data['istritun'] = $numIstri;
                    
                    /*if($hubkel == 11 || $hubkel == 12 || $hubkel == 13 || $hubkel == 14 || $hubkel == 15 || $hubkel == 16 || $hubkel == 17 || $hubkel == 18 || $hubkel == 19 || $hubkel == 21 || $hubkel == 22 || $hubkel == 23 || $hubkel == 24 || $hubkel == 25 || $hubkel == 26 || $hubkel == 27 || $hubkel == 28 || $hubkel == 29 || $hubkel == 31 || $hubkel == 32 || $hubkel == 33 || $hubkel == 34 || $hubkel == 35 || $hubkel == 36 || $hubkel == 37 || $hubkel == 38 || $hubkel == 39 || $hubkel == 41 || $hubkel == 42 || $hubkel == 43 || $hubkel == 44 || $hubkel == 45 || $hubkel == 46 || $hubkel == 47 || $hubkel == 48 || $hubkel == 49 || $hubkel == 50 || $hubkel == 51 || $hubkel == 52 || $hubkel == 53 || $hubkel == 54 || $hubkel == 55 || $hubkel == 56 || $hubkel == 57 || $hubkel == 58 )
                    {
                        if($num>=2)
                        {
                           $data['listStatusTunjangan'] = $this->infopegawai->getKodeStattunHanya2($stattun);
                        }
                        else
                        {
                            $data['listStatusTunjangan'] = $this->infopegawai->getKodeStattun($stattun);    
                        }
                    }
                    else if($hubkel == 20)
                    {
                        if($numIstri>0)
                        {
                            $data['listStatusTunjangan'] = $this->infopegawai->getKodeStattunHanya2($stattun);
                        }
                        else
                        {
                            $data['listStatusTunjangan'] = $this->infopegawai->getKodeStattun($stattun);
                        }
                    } 
                    else
                    {
                        $data['listStatusTunjangan'] = $this->infopegawai->getKodeStattun($stattun);    
                    }                       */ 
                    $data['listStatusTunjangan'] = $this->infopegawai->getKodeStattun($stattun);   
                    $data['listKdHubkel'] = $this->infopegawai->getKodeHubkel($hubkel);    
                    $data['jumIsSu'] = $numIstri;
                    $data['jumAnak'] =$num;
                }
                $listdata = $this->mdl->get_data($nrk)->row();
                $data['listStawin'] = $this->mdl->getListStawin($listdata->STAWIN);
                $data['NOKK'] = $listdata->NOKK;
                
                
                $data['listJenisPekerjaan'] = $this->infopegawai->getKodeKerja($kdkerja);
                $data['listUangDuka'] = $this->infopegawai->getUangDuka($uangduka);
                $data['listStatus']=$this->infopegawai->getStatApp($stat);
                
                break;

            case 'lp2p':
                $action = $this->input->post('action');//action
                $nrk = $this->input->post('key2');
                $thpajak = $this->input->post('key1');

                $stawin="";
                $eselon="";
                $data['action'] = $action;
                if($action != null && $action == 'update')
                {
                    
                    $data['infoLP2P'] = $this->infopegawai->getLP2PHistBy($thpajak,$nrk);
                    
                    $eselon = $data['infoLP2P']->ESELON;

                    $data['listEselon'] = $this->infopegawai->getHistEselon($eselon);
                }
                else if($action != null && $action == 'tambah')
                {
                    $data['listEselon'] = $this->infopegawai->getHistEselonAdd($eselon);
                }
               // $data['listStawin'] = $this->infopegawai->getListStawin($stawin);
                
                break;

            case 'litsus':
                $action = $this->input->post('action');//action
                $tgl = $this->input->post('key2');
                $nrk = $this->input->post('key1');
                $kopang="";

                $data['action']=$action;

                if($action != null && $action == 'update')
                {
                    
                    $data['infoLitsus'] = $this->infopegawai->getLitsusHistBy($nrk,$tgl);
                    $kopang= $data['infoLitsus']->KOPANG_PEMERIKSA;
             
                }
                $data['listKopang'] = $this->infopegawai->getMasterPangkat($kopang); 
                break;

            case 'testtpa':
                $nrk = $this->input->post('key1');
                $noserta = $this->input->post('key2');


                
                break;

            case 'testtp':
                $nrk = $this->input->post('key1');
                $noserta = $this->input->post('key2');

                break;

            case 'makalah':
                $nrk = $this->input->post('key1');
                $noserta = $this->input->post('key2');
                
                break;

            case 'testgabungan':
                
                break;

            case 'tupoksi':
                  $action = $this->input->post('action');//action
                 $nrk = $this->input->post('key1');//nrk
                 $tupoksi_id = $this->input->post('key2');//tupoksi id

                 $data['infoTupoksi'] = $this->infopegawai->getTupoksi($nrk);   
                 //var_dump($nrk);
                 if($action != null && $action == 'update'){                    
                    $data['infoTupoksi'] = $this->infopegawai->getTupoksiBy($nrk,$tupoksi_id);   
                    $tupoksi_id=$data['infoTupoksi']->tupoksi_id;                 
                }
                break;    

            default:
                $data['empty'] = "";
                break;
        }

        return $data;
    }    

    public function hapusHist(){
        $dest = $this->input->post('destination');
        $action = $this->input->post('action');
        $key1 = $this->input->post('key1');
        $key2 = $this->input->post('key2');
        $key3 = $this->input->post('key3');
        $key4 = $this->input->post('key4');

        $result = array('response' => 'GAGAL', 'act' => 'No Delete');
        switch ($dest) {
            case 'pangkat':
                if ($action == 'hapus_flag') {
                    $return = $this->home->delete_flag_pangkat($key1,$key2,$key3);
                    if($return){
                        $result = array('response' => 'SUKSES');                    
                    }
                } else if ($action == 'hapus'){
                    $return = $this->home->delete_pangkat($key1,$key2,$key3);                    
                    if($return){
                        $result = array('response' => 'SUKSES');                    
                    }
                }
                break;

            case 'jabatan_hist':
                if ($action == 'hapus_flag') {
                    $return = $this->home->delete_flag_jabStruk($key1,$key2,$key3,$key4);
                    // echo 1; exit;
                } else if ($action == 'hapus'){
                    $return = $this->home->delete_jabStruk($key1,$key2,$key3,$key4);
                    // echo 2; exit;
                }
                
                if($return){
                    $result = array('response' => 'SUKSES');                    
                }
                break;

            case 'jabatanf_hist':
                if ($action == 'hapus_flag') {
                    $return = $this->home->delete_flag_jabFgs($key1,$key2,$key3);
                } else if ($action == 'hapus'){
                    $return = $this->home->delete_jabFgs($key1,$key2,$key3);
                }
                
                if($return){
                    $result = array('response' => 'SUKSES');                    
                }
                break;

            case 'pendidikan_formal':
                if ($action == 'hapus_flag') {
                    $return = $this->home->delete_flag_pdFormal($key1,$key2,$key3);
                } else if ($action == 'hapus'){
                    $return = $this->home->delete_pdFormal($key1,$key2,$key3);
                }
                
                if($return){
                    $result = array('response' => 'SUKSES');                    
                }
                break;

            case 'pendidikan_nonformal':
                if ($action == 'hapus_flag') {
                    $return = $this->home->delete_flag_pdNonFormal($key1,$key2,$key3);
                } else if ($action == 'hapus'){
                    $return = $this->home->delete_pdNonFormal($key1,$key2,$key3);
                }
                
                if($return){
                    $result = array('response' => 'SUKSES');                    
                }
                break;

            case 'gapok':
                if ($action == 'hapus_flag') {
                    $return = $this->home->delete_flag_gapok($key1,$key2,$key3);
                } else if ($action == 'hapus'){
                    $return = $this->home->delete_gapok($key1,$key2,$key3);
                }
                
                if($return){
                    $result = array('response' => 'SUKSES');                    
                }
                break;

            case 'hukdis':
                if ($action == 'hapus_flag') {
                    $return = $this->home->delete_flag_hukdis($key1,$key2);
                } else if ($action == 'hapus'){
                    $return = $this->home->delete_hukdis($key1,$key2);
                }
                
                if($return){
                    $result = array('response' => 'SUKSES');                    
                }
                break;

            case 'hukadmin':
                if ($action == 'hapus_flag') {
                    $return = $this->home->delete_flag_hukadmin($key1,$key2);
                } else if ($action == 'hapus'){
                    $return = $this->home->delete_hukadmin($key1,$key2);
                }
                
                if($return){
                    $result = array('response' => 'SUKSES');                    
                }
                break;

            case 'dp3':
                if ($action == 'hapus_flag') {
                    $return = $this->home->delete_flag_dp3($key1,$key2);
                } else if ($action == 'hapus'){
                    $return = $this->home->delete_dp3($key1,$key2);
                }
                
                if($return){
                    $result = array('response' => 'SUKSES');                    
                }
                break;

            case 'absensi':
                if ($action == 'hapus_flag') {
                    $return = $this->home->delete_flag_absensi($key1,$key2);
                } else if ($action == 'hapus'){
                    $return = $this->home->delete_absensi($key1,$key2);
                }
                
                if($return){
                    $result = array('response' => 'SUKSES');                    
                }
                break;

            case 'cuti':
                if ($action == 'hapus_flag') {
                    $return = $this->home->delete_flag_cuti($key1,$key2);
                } else if ($action == 'hapus'){
                    $return = $this->home->delete_cuti($key1,$key2);
                }
                
                if($return){
                    $result = array('response' => 'SUKSES');                    
                }
                break;

            case 'pembatasan':
                if ($action == 'hapus_flag') {
                    $return = $this->home->delete_flag_batasan($key1,$key2);
                } else if ($action == 'hapus'){
                    $return = $this->home->delete_batasan($key1,$key2);
                }
                
                if($return){
                    $result = array('response' => 'SUKSES');                    
                }
                break;

            case 'seminar':
                if ($action == 'hapus_flag') {
                    $return = $this->home->delete_flag_seminar($key1,$key2);
                } else if ($action == 'hapus'){
                    $return = $this->home->delete_seminar($key1,$key2);
                }
                
                if($return){
                    $result = array('response' => 'SUKSES');                    
                }
                break;

            case 'tulisan':
                if ($action == 'hapus_flag') {
                    $return = $this->home->delete_flag_tulisan($key1,$key2);
                } else if ($action == 'hapus'){
                    $return = $this->home->delete_tulisan($key1,$key2);
                }
                
                if($return){
                    $result = array('response' => 'SUKSES');                    
                }
                break;

            case 'alamat':
                if ($action == 'hapus_flag') {
                    $return = $this->home->delete_flag_alamat($key1,$key2);
                } else if ($action == 'hapus'){
                    $return = $this->home->delete_alamat($key1,$key2);
                }
                
                if($return){
                    $result = array('response' => 'SUKSES');                    
                }
                break;

            case 'penghargaan':
                if ($action == 'hapus_flag') {
                    $return = $this->home->delete_flag_penghargaan($key1,$key2);
                } else if ($action == 'hapus'){
                    $return = $this->home->delete_penghargaan($key1,$key2);
                }
                
                if($return){
                    $result = array('response' => 'SUKSES');                    
                }
                break;

            case 'fasilitas':
                if ($action == 'hapus_flag') {
                    $return = $this->home->delete_flag_fasilitas($key1,$key2,$key3);
                } else if ($action == 'hapus'){
                    $return = $this->home->delete_fasilitas($key1,$key2,$key3);
                }
                
                if($return){
                    $result = array('response' => 'SUKSES');                    
                }
                break;

            case 'organisasi':
                if ($action == 'hapus_flag') {
                    $return = $this->home->delete_flag_organisasi($key1,$key2);
                } else if ($action == 'hapus'){
                    $return = $this->home->delete_organisasi($key1,$key2);
                }
                
                if($return){
                    $result = array('response' => 'SUKSES');                    
                }
                break;

            case 'keluarga':
                if ($action == 'hapus_flag') {
                    $return = $this->home->delete_flag_keluarga($key1,$key2);
                } else if ($action == 'hapus'){
                    $return = $this->home->delete_keluarga($key1,$key2);
                }
                
                if($return){
                    $result = array('response' => 'SUKSES');                    
                }
                break;

            case 'lp2p':
                 if ($action == 'hapus_flag') {
                    $return = $this->home->delete_flag_lp2p($key1,$key2);
                } else if ($action == 'hapus'){
                    $return = $this->home->delete_lp2p($key1,$key2);
                }
                 
                 if($return){
                     $result = array('response' => 'SUKSES');                    
                 }
                break;

            case 'litsus':
                // $return = $this->home->delete_litsus($key1,$key2);
                // if($return){
                //     $result = array('response' => 'SUKSES');                    
                // }
                break;

            case 'testtpa':
                // $return = $this->home->delete_testtpa($key1,$key2);
                // if($return){
                //     $result = array('response' => 'SUKSES');                    
                // }
                break;

            case 'testtp':
                // $return = $this->home->delete_testtp($key1,$key2);
                // if($return){
                //     $result = array('response' => 'SUKSES');                    
                // }
                break;

            case 'makalah':
                // $return = $this->home->delete_makalah($key1,$key2);
                // if($return){
                //     $result = array('response' => 'SUKSES');                    
                // }
                break;

            case 'testgabungan':
                // $return = $this->home->delete_testgabungan($key1,$key2);
                // if($return){
                //     $result = array('response' => 'SUKSES');                    
                // }
                break;

            case 'tupoksi':
                if ($action == 'hapus_flag') {
                    $return = $this->home->delete_flag_tupoksi($key2);
                } else if ($action == 'hapus'){
                    $return = $this->home->delete_tupoksi($key2);
                }           

                if($return){
                 $result = array('response' => 'SUKSES');                    
                }
                break;    
            
            default:
                $result = array('response' => 'GAGAL', 'act' => 'No Delete');                
                break;
        }

        echo json_encode($result);

    }

/*START UPLOAD PHOTO*/
    public function upload_file(){

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
 
        $this->load->library('upload', $config);        
 
        if ( ! $this->upload->do_upload())
        {
            $hasil = $this->upload->display_errors();            
        }
        else
        {
            $config['source_image'] = $this->upload->upload_path.$this->upload->file_name;
            $config['maintain_ratio'] = FALSE;
            $config['width'] = 85; //40
            $config['height'] = 85; //40

            $this->load->library('image_lib', $config);

            if ( ! $this->image_lib->resize()){                
                $result = $this->image_lib->display_errors('', '');
            }else{
                $result = 'SUKSES';
            }

            // $hasil = $this->upload->data();
            $hasil = array('result' => $result);
        }

        echo json_encode($hasil);
    }
/*END UPLOAD PHOTO*/

	public function gantiPassword()
    {
         
        $insert = $this->home->save_userData($this->user['id']);
        
        if($insert){
            echo json_encode(array("response" => 'SUKSES', 'act' => "add"));
        }else{
            echo json_encode(array("response" => 'GAGAL', 'act' => "add"));
        }
    }

/*START JABATAN STRUKTURAL*/
    public function ajax_add_jab_hist()
    {
        $data['user_id'] = $this->user['id'];        
        $insert = $this->home->save_jabStruk($data);
        
        if($insert == 'SUCCESS'){
            echo json_encode(array("response" => 'SUKSES', 'act' => "add"));
        }
        else if($insert == 'FAILED')
        {
            echo json_encode(array("response" => 'WARNING', 'act' => "add"));
        }
        else{
            echo json_encode(array("response" => 'GAGAL', 'act' => "add"));
        }
    }

    public function ajax_update_jab_hist()
    {
        $data['user_id'] = $this->user['id'];
        $update = $this->home->update_jabStruk($data);

        if($update){
            echo json_encode(array("response" => 'SUKSES', 'act' => "upd"));
        }else{
            echo json_encode(array("response" => 'GAGAL', 'act' => "upd"));
        }

    }

/*END JABATAN STRUKTURAL*/

/*START JABATAN FUNGSIONAL*/
    public function ajax_add_jabf_hist()
    {
        $data['user_id'] = $this->user['id'];        
        $insert = $this->home->save_jabFgs($data);
        
        if($insert=='SUCCESS'){
            echo json_encode(array("response" => 'SUKSES', 'act' => "upd"));
        }
        else if($insert == 'FAILED')
        {
            echo json_encode(array("response" => 'WARNING', 'act' => "add"));
        }
        else
        {
            echo json_encode(array("response" => 'GAGAL', 'act' => "upd"));
        }
    }

    public function ajax_update_jabf_hist()
    {
        $data['user_id'] = $this->user['id'];
        $update = $this->home->update_jabFgs($data);

        if($update){
            echo json_encode(array("response" => 'SUKSES', 'act' => "upd"));
        }else{
            echo json_encode(array("response" => 'GAGAL', 'act' => "upd"));
        }
    }

/*START JABATAN FUNGSIONAL*/

/*START PENDIDIKAN FORMAL*/
    public function ajax_add_pend_formal()
    {        
        $data['user_id'] = $this->user['id'];
        $insert = $this->home->save_pdFormal($data);
        
        if($insert){
            echo json_encode(array("response" => 'SUKSES', 'act' => "upd"));
        }else{
            echo json_encode(array("response" => 'GAGAL', 'act' => "upd"));
        }
    }

    public function ajax_update_pend_formal()
    {
        $data['user_id'] = $this->user['id'];
        $update = $this->home->update_pdFormal($data);

        if($update){
            echo json_encode(array("response" => 'SUKSES', 'act' => "upd"));
        }else{
            echo json_encode(array("response" => 'GAGAL', 'act' => "upd"));
        }
    }

/*END PENDIDIKAN FORMAL*/

/*START PENDIDIKAN NON FORMAL*/
    public function ajax_add_pend_nonformal()
    {        
        $data['user_id'] = $this->user['id'];
        $insert = $this->home->save_pdNonFormal($data);
        
        if($insert){
            echo json_encode(array("response" => 'SUKSES', 'act' => "upd"));
        }else{
            echo json_encode(array("response" => 'GAGAL', 'act' => "upd"));
        }
    }

    public function ajax_update_pend_nonformal()
    {
        $data['user_id'] = $this->user['id'];
        $update = $this->home->update_pdNonFormal($data);

        if($update){
            echo json_encode(array("response" => 'SUKSES', 'act' => "upd"));
        }else{
            echo json_encode(array("response" => 'GAGAL', 'act' => "upd"));
        }
    }

/*END PENDIDIKAN NON FORMAL*/


/*START PANGKAT*/
    public function getMasaKerjaByKopang(){
        if(isset($_POST['kopang'])){
            $kopang = $_POST['kopang'];
            $tahun = $_POST['tahun_refgaji'];
        }else{
            $return = array('response' => 'GAGAL', 'err' => 'No Kopang');
            echo json_encode($return);
            exit();
        }

        //$listttmasker = $this->home->getMasaKerjaByKopang($kopang);
        $maxmasker = $this->home->getMaxTtmasker($kopang);
        
        $arr = array('response' => 'SUKSES', 'maxmasker' => $maxmasker);
        echo json_encode($arr);
    }

    public function getGapokByKopang(){
        if(isset($_POST['kopang'])){
            $kopang = $_POST['kopang'];
            $ttmasker = $_POST['ttmasker'];
            //$maxmasker = $_POST['maxmasker'];
            $maxmasker =  $this->home->getMaxTtmasker($kopang);
        }else{
            $return = array('response' => 'GAGAL', 'err' => 'No Gapok');
            echo json_encode($return);
            exit();
        }

        if($ttmasker <= $maxmasker)
        {
            $ttmasker=$ttmasker;
        }
        else
        {
            $ttmasker=$maxmasker;
        }
        $list = $this->home->getGapokByKopang($kopang,$ttmasker);
        if($list==null)
        {
            $gapok=0;
        }
        else
        {
            $gapok = number_format($list->GAPOK,0,',','.');    
        }
        

        $arr = array('response' => 'SUKSES',  'gapok' => $gapok);
        echo json_encode($arr);
    }

    public function ajax_add_pangkat()
    {
        $data['user_id'] = $this->user['id'];
        $insert = $this->home->save_pangkat($data);

        if($insert){
            echo json_encode(array("response" => 'SUKSES', 'act' => "add"));
        }else{
            echo json_encode(array("response" => 'GAGAL', 'act' => "add"));
        }
        
    }

    public function ajax_update_pangkat()
    {
        $data['user_id'] = $this->user['id'];
        $update = $this->home->update_pangkat($data);

        if($update){
            echo json_encode(array("response" => 'SUKSES', 'act' => "upd"));
        }else{
            echo json_encode(array("response" => 'GAGAL', 'act' => "upd"));
        }
    }

    public function getKopang()
    {
        $kopang = $this->input->post('kopang');

        $listKopang = $this->infopegawai->getMasterPangkat($kopang);
        $arr = array('response' => 'SUKSES', 'listKopang' => $listKopang);
        echo json_encode($arr);
    }    
/*END PANGKAT*/

/*START GAPOK*/
    public function ajax_add_gapok()
    {        
        $data['user_id'] = $this->user['id'];
        $insert = $this->home->save_gapok($data);
        
        if($insert){
            echo json_encode(array("response" => 'SUKSES', 'act' => "add"));
        }else{
            echo json_encode(array("response" => 'GAGAL', 'act' => "add"));
        }
    }

    public function ajax_update_gapok()
    {
        $data['user_id'] = $this->user['id'];
        $update = $this->home->update_gapok($data);

        if($update){
            echo json_encode(array("response" => 'SUKSES', 'act' => "upd"));
        }else{
            echo json_encode(array("response" => 'GAGAL', 'act' => "upd"));
        }
    }

/*END GAPOK*/

/*START HUKUMAN DISIPLIN*/
    public function ajax_add_hukdis()
    {        
        $data['user_id'] = $this->user['id'];
        $insert = $this->home->save_hukdis($data);
        
        if($insert){
            echo json_encode(array("response" => 'SUKSES', 'act' => "add"));
        }else{
            echo json_encode(array("response" => 'GAGAL', 'act' => "add"));
        }
    }

    public function ajax_update_hukdis()
    {
        $data['user_id'] = $this->user['id'];
        $update = $this->home->update_hukdis($data);

        if($update){
            echo json_encode(array("response" => 'SUKSES', 'act' => "upd"));
        }else{
            echo json_encode(array("response" => 'GAGAL', 'act' => "upd"));
        }
    }

/*END HUKUMAN DISIPLIN*/

/*START HUKUMAN ADMINISTRASI*/
    public function ajax_add_hukadm()
    {        
        $data['user_id'] = $this->user['id'];
        $insert = $this->home->save_hukadmin($data);
        
        if($insert){
            echo json_encode(array("response" => 'SUKSES', 'act' => "add"));
        }else{
            echo json_encode(array("response" => 'GAGAL', 'act' => "add"));
        }
    }

    public function ajax_update_hukadm()
    {
        $data['user_id'] = $this->user['id'];
        $update = $this->home->update_hukadmin($data);

        if($update){
            echo json_encode(array("response" => 'SUKSES', 'act' => "upd"));
        }else{
            echo json_encode(array("response" => 'GAGAL', 'act' => "upd"));
        }
    }

/*END HUKUMAN ADMINISTRASI*/

/*START DP3*/
    public function ajax_add_dp3()
    {        
        $data['user_id'] = $this->user['id'];
        $insert = $this->home->save_dp3($data);
        
        if($insert){
            echo json_encode(array("response" => 'SUKSES', 'act' => "add"));
        }else{
            echo json_encode(array("response" => 'GAGAL', 'act' => "add"));
        }
    }

    public function ajax_update_dp3()
    {
        $data['user_id'] = $this->user['id'];
        $update = $this->home->update_dp3($data);

        if($update){
            echo json_encode(array("response" => 'SUKSES', 'act' => "upd"));
        }else{
            echo json_encode(array("response" => 'GAGAL', 'act' => "upd"));
        }
    }

/*END DP3*/

/*START ABSENSI*/
    public function ajax_add_absensi()
    {        
        $data['user_id'] = $this->user['id'];
        $insert = $this->home->save_absensi($data);
        
        if($insert){
            echo json_encode(array("response" => 'SUKSES', 'act' => "add"));
        }else{
            echo json_encode(array("response" => 'GAGAL', 'act' => "add"));
        }
    }

    public function ajax_update_absensi()
    {
        $data['user_id'] = $this->user['id'];
        $update = $this->home->update_absensi($data);

        if($update){
            echo json_encode(array("response" => 'SUKSES', 'act' => "upd"));
        }else{
            echo json_encode(array("response" => 'GAGAL', 'act' => "upd"));
        }
    }

/*END ABSENSI*/

/*START CUTI*/
    public function ajax_add_cuti()
    {        
        $data['user_id'] = $this->user['id'];
        $insert = $this->home->save_cuti($data);
        
        if($insert){
            echo json_encode(array("response" => 'SUKSES', 'act' => "add"));
        }else{
            echo json_encode(array("response" => 'GAGAL', 'act' => "add"));
        }
    }

    public function ajax_update_cuti()
    {
        $data['user_id'] = $this->user['id'];
        $update = $this->home->update_cuti($data);

        if($update){
            echo json_encode(array("response" => 'SUKSES', 'act' => "upd"));
        }else{
            echo json_encode(array("response" => 'GAGAL', 'act' => "upd"));
        }
    }

/*END CUTI*/

/*START PEMBATASAN*/
    public function ajax_add_pembatasan()
    {        
        $data['user_id'] = $this->user['id'];
        $insert = $this->home->save_batasan($data);
        
        if($insert){
            echo json_encode(array("response" => 'SUKSES', 'act' => "add"));
        }else{
            echo json_encode(array("response" => 'GAGAL', 'act' => "add"));
        }
    }

    public function ajax_update_pembatasan()
    {
        $data['user_id'] = $this->user['id'];
        $update = $this->home->update_batasan($data);

        if($update){
            echo json_encode(array("response" => 'SUKSES', 'act' => "upd"));
        }else{
            echo json_encode(array("response" => 'GAGAL', 'act' => "upd"));
        }
    }

/*END PEMBATASAN*/

/*START SEMINAR*/
    public function ajax_add_seminar()
    {        
        $data['user_id'] = $this->user['id'];
        $insert = $this->home->save_seminar($data);
        
        if($insert){
            echo json_encode(array("response" => 'SUKSES', 'act' => "add"));
        }else{
            echo json_encode(array("response" => 'GAGAL', 'act' => "add"));
        }
    }

    public function ajax_update_seminar()
    {
        $data['user_id'] = $this->user['id'];
        $update = $this->home->update_seminar($data);

        if($update){
            echo json_encode(array("response" => 'SUKSES', 'act' => "upd"));
        }else{
            echo json_encode(array("response" => 'GAGAL', 'act' => "upd"));
        }
    }

/*END SEMINAR*/

/*START TULISAN*/
    public function ajax_add_tulisan()
    {        
        $data['user_id'] = $this->user['id'];
        $insert = $this->home->save_tulisan($data);
        
        if($insert){
            echo json_encode(array("response" => 'SUKSES', 'act' => "add"));
        }else{
            echo json_encode(array("response" => 'GAGAL', 'act' => "add"));
        }
    }

    public function ajax_update_tulisan()
    {
        $data['user_id'] = $this->user['id'];
        $update = $this->home->update_tulisan($data);

        if($update){
            echo json_encode(array("response" => 'SUKSES', 'act' => "upd"));
        }else{
            echo json_encode(array("response" => 'GAGAL', 'act' => "upd"));
        }
    }

/*END TULISAN*/

/*START ALAMAT*/
    public function ajax_add_alamat()
    {        
        $data['user_id'] = $this->user['id'];
        $insert = $this->home->save_alamat($data);
        
        if($insert){
            echo json_encode(array("response" => 'SUKSES', 'act' => "add"));
        }else{
            echo json_encode(array("response" => 'GAGAL', 'act' => "add"));
        }
    }

    public function ajax_update_alamat()
    {
        $data['user_id'] = $this->user['id'];
        $update = $this->home->update_alamat($data);

        if($update){
            echo json_encode(array("response" => 'SUKSES', 'act' => "upd"));
        }else{
            echo json_encode(array("response" => 'GAGAL', 'act' => "upd"));
        }
    }

/*END ALAMAT*/

/*START PENGHARGAAN*/
    public function ajax_add_penghargaan()
    {        
        $data['user_id'] = $this->user['id'];
        $insert = $this->home->save_penghargaan($data);
        
        if($insert){
            echo json_encode(array("response" => 'SUKSES', 'act' => "add"));
        }else{
            echo json_encode(array("response" => 'GAGAL', 'act' => "add"));
        }
    }

    public function ajax_update_penghargaan()
    {
        $data['user_id'] = $this->user['id'];
        $update = $this->home->update_penghargaan($data);

        if($update){
            echo json_encode(array("response" => 'SUKSES', 'act' => "upd"));
        }else{
            echo json_encode(array("response" => 'GAGAL', 'act' => "upd"));
        }
    }

/*END PENGHARGAAN*/

/*START FASILITAS*/
    public function ajax_add_fasilitas()
    {        
        $data['user_id'] = $this->user['id'];
        $insert = $this->home->save_fasilitas($data);
        
        if($insert){
            echo json_encode(array("response" => 'SUKSES', 'act' => "add"));
        }else{
            echo json_encode(array("response" => 'GAGAL', 'act' => "add"));
        }
    }

    public function ajax_update_fasilitas()
    {
        $data['user_id'] = $this->user['id'];
        $update = $this->home->update_fasilitas($data);

        if($update){
            echo json_encode(array("response" => 'SUKSES', 'act' => "upd"));
        }else{
            echo json_encode(array("response" => 'GAGAL', 'act' => "upd"));
        }
    }

/*END FASILITAS*/

/*START ORGANISASI*/
    public function ajax_add_organisasi()
    {        
        $data['user_id'] = $this->user['id'];
        $insert = $this->home->save_organisasi($data);
        
        if($insert){
            echo json_encode(array("response" => 'SUKSES', 'act' => "add"));
        }else{
            echo json_encode(array("response" => 'GAGAL', 'act' => "add"));
        }
    }

    public function ajax_update_organisasi()
    {
        $data['user_id'] = $this->user['id'];
        $update = $this->home->update_organisasi($data);

        if($update){
            echo json_encode(array("response" => 'SUKSES', 'act' => "upd"));
        }else{
            echo json_encode(array("response" => 'GAGAL', 'act' => "upd"));
        }
    }

/*END ORGANISASI*/

/*START KELUARGA*/
    public function ajax_add_keluarga()
    {        
        $data['user_id'] = $this->user['id'];
        $insert = $this->home->save_keluarga($data);
       

        if($insert){
            echo json_encode(array("response" => 'SUKSES', 'act' => "add"));
        }
        else if($insert==false) {
            echo json_encode(array("response" => 'WARN', 'act' => "add"));
        }
        else{
            echo json_encode(array("response" => 'GAGAL', 'act' => "add"));
        }
    }

    public function ajax_update_keluarga()
    {
        $data['user_id'] = $this->user['id'];
        $update = $this->home->update_keluarga($data);

        if($update){
            echo json_encode(array("response" => 'SUKSES', 'act' => "upd"));
        }else{
            echo json_encode(array("response" => 'GAGAL', 'act' => "upd"));
        }
    }

/*END KELUARGA*/

/*START LP2P*/

    public function ajax_add_lp2p()
    {        
        $data['user_id'] = $this->user['id'];
        $insert = $this->home->save_lp2p($data);
        
        if($insert){
            echo json_encode(array("response" => 'SUKSES', 'act' => "add"));
        }else{
            echo json_encode(array("response" => 'GAGAL', 'act' => "add"));
        }
    }

    public function ajax_update_lp2p()
    {
        $data['user_id'] = $this->user['id'];
        $update = $this->home->update_lp2p($data);

        if($update){
            echo json_encode(array("response" => 'SUKSES', 'act' => "upd"));
        }else{
            echo json_encode(array("response" => 'GAGAL', 'act' => "upd"));
        }
    }

/*END LP2P*/

/*START LITSUS*/
    public function ajax_add_litsus()
    {        
        $data['user_id'] = $this->user['id'];
        $insert = $this->home->save_litsus($data);
        
        if($insert){
            echo json_encode(array("response" => 'SUKSES', 'act' => "add"));
        }else{
            echo json_encode(array("response" => 'GAGAL', 'act' => "add"));
        }
    }

    public function ajax_update_litsus()
    {
        $data['user_id'] = $this->user['id'];
        $update = $this->home->update_litsus($data);

        if($update){
            echo json_encode(array("response" => 'SUKSES', 'act' => "upd"));
        }else{
            echo json_encode(array("response" => 'GAGAL', 'act' => "upd"));
        }
    }

/*END LITSUS*/

/*START TEST TPA*/
    public function ajax_add_testtpa()
    {        
        $data['user_id'] = $this->user['id'];
        $insert = $this->home->save_testtpa($data);
        
        if($insert){
            echo json_encode(array("response" => 'SUKSES', 'act' => "add"));
        }else{
            echo json_encode(array("response" => 'GAGAL', 'act' => "add"));
        }
    }

    public function ajax_update_testtpa()
    {
        $data['user_id'] = $this->user['id'];
        $update = $this->home->update_testtpa($data);

        if($update){
            echo json_encode(array("response" => 'SUKSES', 'act' => "upd"));
        }else{
            echo json_encode(array("response" => 'GAGAL', 'act' => "upd"));
        }
    }

/*END TEST TPA*/

/*START TEST TP*/
    public function ajax_add_testtp()
    {        
        $data['user_id'] = $this->user['id'];
        $insert = $this->home->save_testtp($data);
        
        if($insert){
            echo json_encode(array("response" => 'SUKSES', 'act' => "add"));
        }else{
            echo json_encode(array("response" => 'GAGAL', 'act' => "add"));
        }
    }

    public function ajax_update_testtp()
    {
        $data['user_id'] = $this->user['id'];
        $update = $this->home->update_testtp($data);

        if($update){
            echo json_encode(array("response" => 'SUKSES', 'act' => "upd"));
        }else{
            echo json_encode(array("response" => 'GAGAL', 'act' => "upd"));
        }
    }

/*END TEST TP*/

/*START MAKALAH*/
    public function ajax_add_makalah()
    {        
        $data['user_id'] = $this->user['id'];
        $insert = $this->home->save_makalah($data);
        
        if($insert){
            echo json_encode(array("response" => 'SUKSES', 'act' => "add"));
        }else{
            echo json_encode(array("response" => 'GAGAL', 'act' => "add"));
        }
    }

    public function ajax_update_makalah()
    {
        $data['user_id'] = $this->user['id'];
        $update = $this->home->update_makalah($data);

        if($update){
            echo json_encode(array("response" => 'SUKSES', 'act' => "upd"));
        }else{
            echo json_encode(array("response" => 'GAGAL', 'act' => "upd"));
        }
    }

/*END MAKALAH*/

/*START TEST GABUNGAN*/
    public function ajax_add_gabungan()
    {        
        $data['user_id'] = $this->user['id'];
        $insert = $this->home->save_gabungan($data);
        
        if($insert){
            echo json_encode(array("response" => 'SUKSES', 'act' => "add"));
        }else{
            echo json_encode(array("response" => 'GAGAL', 'act' => "add"));
        }
    }

    public function ajax_update_gabungan()
    {
        $data['user_id'] = $this->user['id'];
        $update = $this->home->update_gabungan($data);

        if($update){
            echo json_encode(array("response" => 'SUKSES', 'act' => "upd"));
        }else{
            echo json_encode(array("response" => 'GAGAL', 'act' => "upd"));
        }
    }

/*END GABUNGAN*/

/*START TUPOKSI*/
    public function ajax_add_tupoksi()
    {        
        $data['user_id'] = $this->user['id'];
        $insert = $this->home->save_tupoksi($data);
        
        if($insert){
            echo json_encode(array("response" => 'SUKSES', 'act' => "add"));
        }else{
            echo json_encode(array("response" => 'GAGAL', 'act' => "add"));
        }
    }

    public function ajax_update_tupoksi()
    {
        $data['user_id'] = $this->user['id'];
        $update = $this->home->update_tupoksi($data);

        if($update){
            echo json_encode(array("response" => 'SUKSES', 'act' => "upd"));
        }else{
            echo json_encode(array("response" => 'GAGAL', 'act' => "upd"));
        }
    }

/*END TUPOKSI*/

/*START REFERENSI*/
    public function getKojabStruktural(){
        if(isset($_POST['kolok'])){
            $kolok = $_POST['kolok'];
        }else{
            $return = array('response' => 'GAGAL', 'err' => 'No Kolok');
            echo json_encode($return);
            exit();
        }
        
        $listKojab = $this->infopegawai->getMasterKojab($kolok);
        
        $arr = array('response' => 'SUKSES', 'listKojab' => $listKojab);
        echo json_encode($arr);
    }

    public function getKodikFormal(){
        if(isset($_POST['jendik'])){
            $jendik = $_POST['jendik'];
        }else{
            $return = array('response' => 'GAGAL', 'err' => 'No Jendik');
            echo json_encode($return);
            exit();
        }
        
        $listKodik = $this->infopegawai->getMasterKodik($jendik);
        $arr = array('response' => 'SUKSES', 'listKodik' => $listKodik);
        echo json_encode($arr);
    }

    public function getKodikNonFormal(){
        if(isset($_POST['jendik'])){
            $jendik = $_POST['jendik'];
        }else{
            $return = array('response' => 'GAGAL', 'err' => 'No Jendik');
            echo json_encode($return);
            exit();
        }
        
        $listKodik = $this->infopegawai->getMasterKodik($jendik);
        $arr = array('response' => 'SUKSES', 'listKodik' => $listKodik);
        echo json_encode($arr);
    }

    public function getKolok()
    {
        $kolok = $this->input->post('kolok');

        $listKolok = $this->infopegawai->getMasterKolok($kolok);
        $arr = array('response' => 'SUKSES', 'listKolok' => $listKolok);
        echo json_encode($arr);
    }

    public function getPejtt()
    {
        $pejtt = $this->input->post('pejtt');

        $listKopang = $this->infopegawai->getMasterPejtt($pejtt);
        $arr = array('response' => 'SUKSES', 'listPejtt' => $listPejtt);
        echo json_encode($arr);
    }

    public function getKecamatan()
    {
        $kowil = $this->input->post('kowil');

        $list = $this->infopegawai->getKecamatan($kowil);
        $arr = array('response' => 'SUKSES', 'list' => $list);
        echo json_encode($arr);
    }

    public function getKelurahan()
    {
        $kowil = $this->input->post('kowil');
        $kocam = $this->input->post('kocam');

        $list = $this->infopegawai->getKelurahan($kowil,$kocam);
        $arr = array('response' => 'SUKSES', 'list' => $list);
        echo json_encode($arr);
    }

    public function getKodikJenjang()
    {
        $jendik = $this->input->post('jendik');
        $jenpdk = $this->input->post('jenpdk');

        $list = $this->infopegawai->getMasterKodikByJenjang($jendik,$jenpdk);
        $arr = array('response' => 'SUKSES', 'list' => $list);
        echo json_encode($arr);
    }

    public function getStattunDariIsSu()
    {
        $jumIsSu = $this->input->post('jumIsSu');
        $jumAnak = $this->input->post('jumAnak');
        $hubkel = $this->input->post('hubkel');
        $kdkerja = $this->input->post('kdkerja');
        $stnikah = $this->input->post('stnikah');


        $list="";
       /* if($hubkel == 10 || $hubkel == 20 || $hubkel == 30 || $hubkel ==40)
        {
            if($jumIsSu == 0)
            {
                if($stnikah == 2)
                {
                    $list = $this->infopegawai->getKodeStattunHanya2(2);    
                }
                else
                {
                    $list = $this->infopegawai->getKodeStattunHanya1(1);    
                }
                
            }
            else
            {
            
                $list = $this->infopegawai->getKodeStattunHanya2(2);
            }    
        }
        else if($hubkel == 11 || $hubkel == 12 || $hubkel == 13 || $hubkel == 14 || $hubkel ==15 || $hubkel ==16 || $hubkel ==17 || $hubkel ==18 || $hubkel ==19 || $hubkel ==21 || $hubkel ==22 || $hubkel ==23 || $hubkel ==24 || $hubkel ==25 || $hubkel ==26 || $hubkel ==27 || $hubkel ==28 || $hubkel ==29 || $hubkel ==31 || $hubkel ==32 || $hubkel ==33 || $hubkel ==34 || $hubkel ==35 || $hubkel ==36 || $hubkel ==37 || $hubkel ==38 || $hubkel ==39 || $hubkel ==41 || $hubkel ==42 || $hubkel ==43 || $hubkel ==44 || $hubkel ==45 || $hubkel ==46 || $hubkel ==47 || $hubkel ==48 || $hubkel ==49 )
        {
            if($jumAnak>=2)
            {
                $list = $this->infopegawai->getKodeStattunHanya2(2);
            }
            else
            {
                $list = $this->infopegawai->getKodeStattunHanya1(1);
            }
        }
        else
        {
            $list = $this->infopegawai->getKodeStattun();
        }*/
        if($hubkel !=null)
        {
            if($hubkel == 10 || $hubkel == 20 || $hubkel == 30 || $hubkel ==40)
            {   
                        if($jumIsSu == 0)
                        {
                            if($stnikah == 2)
                            {
                                $list = $this->infopegawai->getKodeStattun(2);    
                            }
                            else if($stnikah == 1)
                            {
                                if($kdkerja == 2||$kdkerja == 6||$kdkerja == 7)
                                {
                                     $list = $this->infopegawai->getKodeStattun(1); 
                                }
                                else
                                {
                                    $list = $this->infopegawai->getKodeStattun(1);       
                                }
                            }
                            else
                            {
                                $list = $this->infopegawai->getKodeStattun(2);    
                            }
                            
                        }
                        else
                        {
                        
                            $list = $this->infopegawai->getKodeStattunHanya2(2);
                        }    
            }
            else if($hubkel == 11 || $hubkel == 12 || $hubkel == 13 || $hubkel == 14 || $hubkel ==15 || $hubkel ==16 || $hubkel ==17 || $hubkel ==18 || $hubkel ==19 || $hubkel ==21 || $hubkel ==22 || $hubkel ==23 || $hubkel ==24 || $hubkel ==25 || $hubkel ==26 || $hubkel ==27 || $hubkel ==28 || $hubkel ==29 || $hubkel ==31 || $hubkel ==32 || $hubkel ==33 || $hubkel ==34 || $hubkel ==35 || $hubkel ==36 || $hubkel ==37 || $hubkel ==38 || $hubkel ==39 || $hubkel ==41 || $hubkel ==42 || $hubkel ==43 || $hubkel ==44 || $hubkel ==45 || $hubkel ==46 || $hubkel ==47 || $hubkel ==48 || $hubkel ==49 || $hubkel ==58 )
            {
                        if($jumAnak>=2)
                        {
                            $list = $this->infopegawai->getKodeStattunHanya2(2);
                        }
                        else
                        {
                            $list = $this->infopegawai->getKodeStattunHanya1(1);
                        }
            }
            else
            {
                        $list = $this->infopegawai->getKodeStattun();
            }

        }
        
        else if($hubkel == null)
        {
            if($stnikah == 2)
            {
                $list = $this->infopegawai->getKodeStattunHanya2(2);
            }
            else
            {
                 $list = $this->infopegawai->getKodeStattun();
            }
        }        
        
        $arr = array('response' => 'SUKSES', 'list' => $list);
        echo json_encode($arr);
    }
/*END REFERENSI*/

    public function updateKolokJab()
    {
        $this->home->updateKolokKojab();
    }

    function tampilPhoto($nrk=''){
        // Now query back the uploaded BLOB and display it
        $rs=$this->mdl->get_data($nrk)->row();
        $result = $rs->X_PHOTO->load();
// If any text (or whitespace!) is printed before this header is sent,
// the text won't be displayed and the image won't display properly.
// Comment out this line to see the text and debug such a problem.
        header("Content-type: image/JPEG");
        echo $result;
    }

}
