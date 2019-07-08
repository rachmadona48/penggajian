<?php 

 class M_proses_gubernur extends CI_Model {  

    var $today = '';

    private $bt;

    function __construct()
    {        
        parent::__construct();
        $this->today = date('Y-m-d');

        $this->bt =& get_instance();
        $this->bt->load->database(); 
        $this->prod = $this->bt->load->database('batch', TRUE);
    }   

    /*START SETTING MENU*/
    // function getnextvalMenuPostgre(){
    //     $sql = "SELECT nextval('menu_master_id_menu_seq')";
    //     $query = $this->db->query($sql)->row();
    //     return $query->nextval;
    // } 


    public function get_Tgl_Batch()
    {
        $sql = " SELECT TGL_BATCH,ID
                FROM PERSJP_TGLBATCH ";
        // var_dump($sql);exit;
        return $this->prod->query($sql)->row();
    }

    public function get_hari_kerja()
    {
        $sql = " SELECT HARI_KERJA
                FROM PERSJP_HARI_KERJA
                WHERE ID = 1 ";
        // var_dump($sql);exit;
        return $this->prod->query($sql)->row();
    }

    public function proses_delete_data()
    {
        $NRK = $this->input->post('nrk');
        $THBL = $this->input->post('thbl');

        $sql = " DELETE FROM GAJI_GUBERNUR
                 WHERE NRK = '".$NRK."'
                 AND THBL = '".$THBL."' ";
                 // echo $sql; exit();
        return $this->prod->query($sql);

    }

    public function CekNrk()
    {
        $NRK = $this->input->post('nrk');
        $THBL = $this->input->post('thbl');
        $sql = " SELECT COUNT (*) AS jumlah
                FROM GAJI_GUBERNUR
                WHERE NRK = '".$NRK."'
                AND THBL = '".$THBL."' ";
        // echo $sql;exit;
        return $this->prod->query($sql)->row();
    }

    public function inputDataGubernur()
    {
        $NRK = $this->input->post('nrk');
        $THBL = $this->input->post('thbl');
        $NAMA = $this->input->post('nama');
        $KOLOK = $this->input->post('kolok');
        $KLOGAD = $this->input->post('klogad');
        $SPMU = $this->input->post('spmu');
        $GAPOK = $this->input->post('gapok');
        $TISTRI = $this->input->post('tistri');
        $TANAK = $this->input->post('tanak');
        $TBERAS = $this->input->post('tberas');
        $PPH_GAJI = $this->input->post('pph_gaji');
        $JUMKOTOR = $this->input->post('jumkotor');
        $GAJI_BERSIH = $this->input->post('gaji_bersih');
        $TUNJAB = $this->input->post('tunjab');
        $PPH_TUNJAB = $this->input->post('pph_tunjab');
        $TUNJAB_BERSIH = $this->input->post('tunjab_bersih');
        $IWP = $this->input->post('iwp');
        $JNETTPPH = $this->input->post('jnettpph');
        $NTASPEN = $this->input->post('ntaspen');
        $NASKES = $this->input->post('naskes');
        $BIAYAJABATAN = $this->input->post('biayajabatan');
        $NTHT = $this->input->post('ntht');
        $JUAN = $this->input->post('juan');
        $JIWA = $this->input->post('jiwa');
        $JIWAAWAL = $this->input->post('jiwaawal');
        $JENKEL = $this->input->post('jenkel');
        $KDKERJA = $this->input->post('kdkerja');
        $STAWIN = $this->input->post('stawin');
        $NPBULAT = $this->input->post('npbulat');
        $TUNFUNG = $this->input->post('tunfung');
        $NTUNLAI = $this->input->post('ntunlai');

        $sql = " INSERT INTO GAJI_GUBERNUR (
                        NRK, THBL, NAMA, KOLOK, KLOGAD, SPMU, GAPOK, TISTRI, TANAK, TBERAS, PPH_GAJI, JUMKOTOR, GAJI_BERSIH, TUNJAB, PPH_TUNJAB, TUNJAB_BERSIH, IWP, JNETTPPH, NTASPEN, NASKES, NTHT, BIAYAJABATAN, JUAN, JIWA, JIWAAWAL, JENKEL, KDKERJA, STAWIN,
                        NPBULAT, TUNFUNG, NTUNLAI
                 )VALUES(
                 '".$NRK."', '".$THBL."', '".$NAMA."', '".$KOLOK."', '".$KLOGAD."', '".$SPMU."', '".$GAPOK."', '".$TISTRI."', '".$TANAK."', '".$TBERAS."',
                 '".$PPH_GAJI."', '".$JUMKOTOR."', '".$GAJI_BERSIH."', '".$TUNJAB."', '".$PPH_TUNJAB."', '".$TUNJAB_BERSIH."', '".$IWP."',
                 '".$JNETTPPH."', '".$NTASPEN."', '".$NASKES."', '".$NTHT."', '".$BIAYAJABATAN."', '".$JUAN."', '".$JIWA."', '".$JIWAAWAL."', '".$JENKEL."',
                 '".$KDKERJA."', '".$STAWIN."', '".$NPBULAT."', '".$TUNFUNG."', '".$NTUNLAI."'
                 )";

        return $this->prod->query($sql);
    }

    public function getGaji()
    {
        $requestData = $this->input->post(); 
        $tgl_batch3 = $requestData['tgl_batch3'];
        // echo $tgl_batch3;

        $columns = array( 
        // datatable column index  => database column name
            0 => 'THBL',
            1 => 'THBL',
            2 => 'THBL', 
            3 => 'THBL',
            4 => 'THBL',
            5 => 'THBL',
            6 => 'THBL',
            7 => 'THBL',

        );

        // getting total number records without any search
        $sql = "SELECT * FROM (
                SELECT ROWNUM AS RN,NRK,THBL,NAMA,GAPOK,GAJI_BERSIH,TUNJAB_BERSIH
                FROM GAJI_GUBERNUR
                WHERE THBL = '".$tgl_batch3."'
                )A";

         $sql.=" ORDER BY A.RN DESC "; 
         // echo $sql;
         // exit();
        
        $query = $this->prod->query($sql);
        $totalData = $query->num_rows();
        $totalFiltered = $totalData;  // when there is no search parameter then total number rows = total number filtered rows.

        $sql = "SELECT * FROM (
                SELECT ROWNUM AS RN,NRK,THBL,NAMA,GAPOK,GAJI_BERSIH,TUNJAB_BERSIH
                FROM GAJI_GUBERNUR
                WHERE THBL = '".$tgl_batch3."'
                )A  WHERE 1 = 1  ";

        
        // getting records as per search parameters
        if( !empty($requestData['search']['value']) ){   //kode nptt
            $sql.=" AND lower(NAMA) LIKE lower('%".$requestData['search']['value']."%') ";
            // echo $sql;
        }
        
        
        
        $query= $this->prod->query($sql);
        $totalFiltered = $query->num_rows();    
        
        $sql.=" AND RN > ".$requestData['start']." AND  ROWNUM <= ".$requestData['length']." "; 
        // $sql.=" ORDER BY \"".$columns[$requestData['order'][0]['column']]."\"   ".$requestData['order'][0]['dir']." ";  // adding length
        $sql.=" ORDER BY A.RN DESC "; 
        
        // ECHO $sql;exit;
        // var_dump($sql);exit;
         // echo $sql;  
        $query= $this->prod->query($sql);
        $n = $_POST['start'];
        $no = $n+1;
        $data = array();        

        foreach($query->result() as $row){
            $nestedData=array(); 
            $nestedData[] = $no;
            $nestedData[] = $row->THBL;
            $nestedData[] = $row->NAMA;
            $nestedData[] = $this->format_uang->rp_format($row->GAPOK);
            $nestedData[] = $this->format_uang->rp_format($row->GAJI_BERSIH);
            $nestedData[] = $this->format_uang->rp_format($row->TUNJAB_BERSIH);
            
            // // $nestedData[] = $row->TABELID;
            // if($row->TABELID == 1){
            //     $nestedData[] = "<div align='center'>Gaji</div> ";
            // }else if($row->TABELID == 2){
            //     $nestedData[] = "<div align='center'>TKD Pegawai</div> ";
            // }else{
            //     $nestedData[] = "<div align='center'>TKD Guru</div> ";
            // }

            // $nestedData[] = $row->BULANPLAIN;
            if($row->NRK == 111111){
                $nestedData[] = "<div align='center'>Gubernur</div> ";
            }else if($row->NRK == 222222){
                $nestedData[] = "<div align='center'>Wakil Gubernur</div> ";
            }else{
                $nestedData[] = "<div align='center'>Deputi</div> ";
            }
            
            $nestedData[] = '<td><button onclick="get_nrk_edit(\''.$row->NRK.'\','.$row->THBL.')" class="btn-link"><span class="glyphicon glyphicon-pencil"></span></button><button onclick="get_nrk_delete(\''.$row->NRK.'\','.$row->THBL.')" class="btn-link"><span class="glyphicon glyphicon-trash"></span></button> &nbsp; </td>';
            
            // 
           
            
            
            $data[] = $nestedData;
            $no++;
        }   

        $json_data = array(
                    "draw"            => intval( $requestData['draw'] ),   
                    "recordsTotal"    => intval( $totalData ),  
                    "recordsFiltered" => intval( $totalFiltered ), 
                    "data"            => $data   
                    );

        echo json_encode($json_data); 
    }

    public function cek_data_sebelum_update(){
        $nrk = $this->input->post('nrk');
        $thbl = $this->input->post('thbl');
        // return $this->db->get_where('pegawai',array('NIK'=>$nik));
        $sql = "SELECT * FROM GAJI_GUBERNUR WHERE NRK = '".$nrk."' AND THBL = '".$thbl."' ";
        // echo $sql; exit();
        return $this->prod->query($sql)->row();
    }

    public function proses_simpan_update(){

        $NRK = $this->input->post('nrk');
        $THBL = $this->input->post('thbl');
        $NAMA = $this->input->post('nama');
        $KOLOK = $this->input->post('kolok');
        $KLOGAD = $this->input->post('klogad');
        $SPMU = $this->input->post('spmu');
        $GAPOK = $this->input->post('gapok');
        $TISTRI = $this->input->post('tistri');
        $TANAK = $this->input->post('tanak');
        $TBERAS = $this->input->post('tberas');
        $PPH_GAJI = $this->input->post('pph_gaji');
        $JUMKOTOR = $this->input->post('jumkotor');
        $GAJI_BERSIH = $this->input->post('gaji_bersih');
        $TUNJAB = $this->input->post('tunjab');
        $PPH_TUNJAB = $this->input->post('pph_tunjab');
        $TUNJAB_BERSIH = $this->input->post('tunjab_bersih');
        $IWP = $this->input->post('iwp');
        $JNETTPPH = $this->input->post('jnettpph');
        $NTASPEN = $this->input->post('ntaspen');
        $NASKES = $this->input->post('naskes');
        $BIAYAJABATAN = $this->input->post('biayajabatan');
        $NTHT = $this->input->post('ntht');
        $JUAN = $this->input->post('juan');
        $JIWA = $this->input->post('jiwa');
        $JIWAAWAL = $this->input->post('jiwaawal');
        $JENKEL = $this->input->post('jenkel');
        $KDKERJA = $this->input->post('kdkerja');
        $STAWIN = $this->input->post('stawin');
        $NPBULAT = $this->input->post('npbulat');
        $TUNFUNG = $this->input->post('tunfung');
        $NTUNLAI = $this->input->post('ntunlai');

        $sql = " UPDATE GAJI_GUBERNUR SET
                        NAMA = '".$NAMA."', KOLOK = '".$KOLOK."', KLOGAD = '".$KLOGAD."', SPMU = '".$SPMU."', GAPOK = '".$GAPOK."',
                        TISTRI = '".$TISTRI."', TANAK = '".$TANAK."', TBERAS = '".$TBERAS."', PPH_GAJI = '".$PPH_GAJI."', JUMKOTOR = '".$JUMKOTOR."',
                        GAJI_BERSIH = '".$GAJI_BERSIH."', TUNJAB = '".$TUNJAB."', PPH_TUNJAB = '".$PPH_TUNJAB."',
                        TUNJAB_BERSIH = '".$TUNJAB_BERSIH."', IWP = '".$IWP."', JNETTPPH = '".$JNETTPPH."', NTASPEN = '".$NTASPEN."',
                        NASKES = '".$NASKES."', NTHT = '".$NTHT."', BIAYAJABATAN ='".$BIAYAJABATAN."', JUAN = '".$JUAN."',
                        JIWA = '".$JIWA."', JIWAAWAL = '".$JIWAAWAL."', JENKEL = '".$JENKEL."', KDKERJA = '".$KDKERJA."', STAWIN = '".$STAWIN."',
                        NPBULAT = '".$NPBULAT."', TUNFUNG = '".$TUNFUNG."', NTUNLAI = '".$NTUNLAI."'
                 WHERE NRK = '".$NRK."' AND THBL = '".$THBL."' ";

        return $this->prod->query($sql);
    }

    // public function getPPH(){
    //     $requestData = $this->input->post(); 
    //     $tgl_batch2 = $requestData['tgl_batch2'];
    //     // echo $tgl_batch2;

    //     $columns = array( 
    //     // datatable column index  => database column name
    //         0 => 'THBL',
    //         1 => 'THBL',
    //         2 => 'THBL', 
    //         3 => 'THBL',
    //         4 => 'THBL',

    //     );

    //     // getting total number records without any search
    //     $sql = "SELECT * FROM (
    //             SELECT ROWNUM AS RN,THBL,NRK,NAMA,PPH_BULAN
    //             FROM PERSJP_DUK_PANGKAT_PPH
    //             WHERE THBL = '".$tgl_batch2."'
    //             )A";
        
        
    //     $query = $this->prod->query($sql);
    //     $totalData = $query->num_rows();
    //     $totalFiltered = $totalData;  // when there is no search parameter then total number rows = total number filtered rows.

    //     $sql = "SELECT * FROM (
    //             SELECT ROWNUM AS RN,THBL,NRK,NAMA,PPH_BULAN
    //             FROM PERSJP_DUK_PANGKAT_PPH
    //             WHERE THBL = '".$tgl_batch2."'
    //             )A  WHERE 1 = 1  ";

        
    //     // getting records as per search parameters
    //     if( !empty($requestData['search']['value']) ){   //kode nptt
    //         $sql.=" AND lower(NRK) LIKE lower('%".$requestData['search']['value']."%') ";
    //         // echo $sql;
    //     }
        
        
        
    //     $query= $this->prod->query($sql);
    //     $totalFiltered = $query->num_rows();    
        
    //     $sql.=" AND RN > ".$requestData['start']." AND  ROWNUM <= ".$requestData['length']." "; 
    //     $sql.=" ORDER BY \"".$columns[$requestData['order'][0]['column']]."\"   ".$requestData['order'][0]['dir']." ";  // adding length
        
    //     // ECHO $sql;exit;
    //     // var_dump($sql);exit;
    //      // echo $sql;  
    //     $query= $this->prod->query($sql);
    //     $n = $_POST['start'];
    //     $no = $n+1;
    //     $data = array();        

    //     foreach($query->result() as $row){
    //         $nestedData=array(); 
    //         $nestedData[] = $no;
    //         $nestedData[] = $row->THBL;
    //         $nestedData[] = $row->NRK;
    //         $nestedData[] = $row->NAMA;
    //         $nestedData[] = $this->format_uang->rp_format($row->PPH_BULAN);
            
    //         $data[] = $nestedData;
    //         $no++;
    //     }   

    //     $json_data = array(
    //                 "draw"            => intval( $requestData['draw'] ),   
    //                 "recordsTotal"    => intval( $totalData ),  
    //                 "recordsFiltered" => intval( $totalFiltered ), 
    //                 "data"            => $data   
    //                 );

    //     echo json_encode($json_data); 
    // }

    public function cekLain($thbl,$bulanplain,$tabelid){
        $sql = "SELECT COUNT(\"NO\") AS JML FROM PERSJP_TGL_PLAIN
                WHERE THBL ='".$thbl."'
                AND BULANPLAIN ='".$bulanplain."'
                AND TABELID = '".$tabelid."' ";

        $query= $this->prod->query($sql)->row();
        return $query;

    }

    // public function CekPPH($tgl_batch2){
    //     $sql = "SELECT COUNT(*) AS JML_PPH
    //             FROM PERSJP_DUK_PANGKAT_PPH
    //             WHERE THBL = '".$tgl_batch2."' ";
    //     return $this->prod->query($sql)->row();
    // }

    public function CekGajiToPPH($tgl_batch2){
        $sql = "SELECT COUNT(*) AS JML_GAJI
                FROM GAJI_GUBERNUR
                WHERE THBL = '".$tgl_batch2."' ";
        // echo $sql;exit;
        return $this->prod->query($sql)->row();
    }

    public function updateBatch($tgl_batch2,$idt2){
        $tahun = substr($tgl_batch2, 0,4);
        $bulan = substr($tgl_batch2, 4,2);
        $tglSave = $tahun.'-'.$bulan.'-01';
        // echo $tglSave;exit;
        $sql = " UPDATE PERSJP_TGLBATCH SET TGL_BATCH = '".$tglSave."' WHERE \"ID\" = '".$idt2."' ";
         
        return $this->prod->query($sql);

    }

    public function updateBatchprint($thbl){
        $tahun = substr($thbl, 0,4);
        $bulan = substr($thbl, 4,2);
        $tglSave = $tahun.'-'.$bulan.'-01';
        // echo $tglSave;exit;
        $sql = " UPDATE PERSJP_TGLBATCH SET TGL_BATCH = '".$tglSave."' WHERE \"ID\" = '1' ";
         
        return $this->prod->query($sql);

    }

    public function updateHariKerja($hr_krja){
        $sql = "UPDATE PERSJP_HARI_KERJA
                SET HARI_KERJA = ".$hr_krja." WHERE \"ID\" = '1' ";
         
        return $this->prod->query($sql);

    }

    public function hapus_tgl($thbl){
        $sql = "CALL HAPUS_PLAIN('".$thbl."') ";

        return $this->prod->query($sql);
    }

    // public function hapus_Lain($thbl){
    //     $sql = "DELETE FROM PERSJP_PENGHASILAN_LAIN WHERE THBL = '".$thbl."' ";

    //     return $this->prod->query($sql);
    // }

    public function pengLain($tgl_batch){
        $sql = "SELECT COUNT(*) AS JML
                FROM PERSJP_PENGHASILAN_LAIN
                WHERE THBL = '".$tgl_batch."' ";
        return $this->prod->query($sql)->row();
    }

    public function ubahDate_format(){
    	$sql = "alter session set nls_date_format = 'DD-MM-YYYY' ";
    	echo $sql;
        return $this->prod->query($sql);
    }

    public function ambil_gj_sebelum($tgl_batch_min){
    	// $sql1 = "alter session set nls_date_format = 'DD-MM-YYYY' ";
        // $tgl_batch_sblumnya = $tgl_batch2-1;

        $sql = "SELECT
                NRK, THBL, NAMA, KOLOK, KLOGAD, SPMU, GAPOK, TISTRI, TANAK, TBERAS, PPH_GAJI, JUMKOTOR,
                GAJI_BERSIH, TUNJAB, PPH_TUNJAB, TUNJAB_BERSIH, IWP, JNETTPPH, NTASPEN, NASKES, NTHT,
                BIAYAJABATAN, JUAN, JIWA, JIWAAWAL, JENKEL, KDKERJA, STAWIN, NPBULAT, TUNFUNG, NTUNLAI
                FROM GAJI_GUBERNUR 
                WHERE THBL = '".$tgl_batch_min."'
                "; //select data dari bulan sebelumnya, lalu insert ketable yang sama dgn thbl skrg
        
        //echo $sql1;echo $sql;
        return $this->prod->query($sql)->result();
    }

    public function gaji_sesudah_diambil($nrk,$tgl_batch2,$nama,$kolok,$klogad,$spmu,$gapok,$tistri,$tanak,$tberas,$pph_gaji,$jumkotor,$gaji_bersih,$tunjab,$pph_tunjab,$tunjab_bersih,$iwp,$jnettpph,$ntaspen,$naskes,$ntht,$biayajabatan,$juan,$jiwa,$jiwaawal,$jenkel,$kdkerja,$stawin,$npbulat,$tunfung,$ntunlai){
        // $sql1 = "alter session set nls_date_format = 'DD-MM-YYYY' ";
        // $tgl_batch_sblumnya = $tgl_batch2-1;

        $sql = "INSERT INTO GAJI_GUBERNUR
                VALUES
                    (
                        '".$nrk."',
                        '".$tgl_batch2."',
                        '".$nama."',
                        '".$kolok."',
                        '".$klogad."',
                        '".$spmu."',
                        '".$gapok."',
                        '".$tistri."',
                        '".$tanak."',
                        '".$tberas."',
                        '".$pph_gaji."',
                        '".$jumkotor."',
                        '".$gaji_bersih."',
                        '".$tunjab."',
                        '".$pph_tunjab."',
                        '".$tunjab_bersih."',
                        '".$iwp."',
                        '".$jnettpph."',
                        '".$ntaspen."',
                        '".$naskes."',
                        '".$ntht."',
                        '".$biayajabatan."',
                        '".$juan."',
                        '".$jiwa."',
                        '".$jiwaawal."',
                        '".$jenkel."',
                        '".$kdkerja."',
                        '".$stawin."',
                        '".$npbulat."',
                        '".$tunfung."',
                        '".$ntunlai."'
                    )"; //select data dari bulan sebelumnya, lalu insert ketable yang sama dgn thbl skrg
        
        //echo $sql1;echo $sql;
        return $this->prod->query($sql);
    }

    // public function execute_pph(){
    //     $sql = "CALL JPGAJI_PPH_BULAN_CURSOR.main() ";
    //     return $this->prod->query($sql);
    // }

    public function get_gaji(){
        $sql = "SELECT * FROM DN_VW_GAJI ";
        $query = $this->prod->query($sql);

        $option  = "";
        
        foreach($query->result() as $row){
            
                $option .= "<option value='".$row->THBLA."'>Gaji ".$row->THBLA."</option>";
        }
        
        return $option;
    }

    public function printGaji(){
        $sql = "SELECT NRK,NIP,NIP18,NAMA,GOL,SPMU,KLOGAD,NALOKS,NJUMBERGAJI,THBL FROM DN_GAJI_TXT";
        return $this->prod->query($sql)->result();
    }
}

?>