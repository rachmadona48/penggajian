<?php 

 class Model_riwayat extends CI_Model {

    var $title   = '';
    var $content = '';
    var $date    = '';

    private $ci;
    private $ekin;

    function __construct()
    {        
        parent::__construct();

         $this->ci =& get_instance();
        $this->ci->load->database(); 
        // $this->prod = $this->ci->load->database('ORP1', TRUE);
        
    } 

    function get_info_tkd_pg($nrk){
        /*$sql = "SELECT KOLOK, KLOGAD FROM \"vw_jabatan_terakhir\" WHERE NRK = {$nrk}";*/

        $sql = "SELECT COUNT(*) as JML_PGW FROM PROSES_TKD_TAHAP2 WHERE NRK = '$nrk'
                AND SUBSTR (THBL, 5, 2) < '15'
                AND THBL >= '201605'
                AND UPLOAD = '1'";

        $result = $this->db->query($sql)->row();
        // echo $result->JML_PGW;exit();
        return $result;
    }

    function get_info_tkd_gr($nrk){
        /*$sql = "SELECT KOLOK, KLOGAD FROM \"vw_jabatan_terakhir\" WHERE NRK = {$nrk}";*/

        $sql = "SELECT COUNT(*) as JML_GR FROM PROSES_TKD_GURU WHERE NRK = '$nrk'
                AND SUBSTR (THBL, 5, 2) < '15'
                AND THBL >= '201605'
                AND UPLOAD = '1'";

        $result = $this->db->query($sql)->row();
        // echo $result->JML_PGW;exit();
        return $result;
    }

    function get_info_gaji($nrk){
        /*$sql = "SELECT KOLOK, KLOGAD FROM \"vw_jabatan_terakhir\" WHERE NRK = {$nrk}";*/

        $sql = "SELECT COUNT(*) as JML FROM PERS_DUK_PANGKAT_HISTDUK WHERE NRK = '$nrk'
                AND SUBSTR (THBL, 5, 2) < '15'
                AND THBL >= '201605'
                AND UPLOAD = '1'";

        $result = $this->db->query($sql)->row();
        // echo $result->JML_PGW;exit();
        return $result;
    }

    public function get_data_tkd_guru($nrk)
    {
        $requestData = $this->input->post(); 

        $columns = array( 
        // datatable column index  => database column name
            0 => 'THBL',
            1 => 'THBL',
            2 => 'NRK', 
            3 => 'JABATAN',
            4 => 'SPMU',
            5 => 'LOKASI',
            6 => 'KINERJA',
            7 => 'NJTUNDA',
            8 => 'NPOTTKD',
            9 => 'NJTUNDABERSIH'

        );

        // getting total number records without any search
        $sql = "SELECT * FROM (
                SELECT ROWNUM AS RN,A.THBL, A.NRK,A.NAMA,A.KOLOK,A.KOJAB, A.KD,A.NJTUNDA,A.KINERJA,A.TKD_EKIN,A.NPOTTKD,A.NJTUNDABERSIH,A.KET,
                        (
                            CASE
                            WHEN A .KD = 'S' THEN
                                (
                                    SELECT
                                        NAJABL
                                    FROM
                                        PERS_KOJAB_TBL
                                    WHERE
                                        KOLOK = A .KOLOK
                                    AND KOJAB = A .KOJAB
                                )
                            ELSE
                                (
                                    SELECT
                                        NAJABL
                                    FROM
                                        PERS_KOJABF_TBL
                                    WHERE
                                        KOJAB = A .KOJAB
                                )
                            END
                        ) AS JABATAN,
                        B.NAMA AS SPMU,
                        C.NALOKL AS LOKASI
                    FROM
                        PROSES_TKD_GURU A
                    LEFT JOIN PERS_TABEL_SPMU B ON A.SPMU = B.KODE_SPM
                    LEFT JOIN PERS_LOKASI_TBL C ON A.KOLOK = C.KOLOK
                    WHERE
                        A.NRK = '".$nrk."'
                    AND SUBSTR (A .THBL, 5, 2) < '15'
                    AND A.THBL >= '201605'
                    AND A.UPLOAD = '1'
                )A";
        // echo $sql;exit();
        
        $query = $this->db->query($sql);
        $totalData = $query->num_rows();
        $totalFiltered = $totalData;  // when there is no search parameter then total number rows = total number filtered rows.

        $sql = "SELECT * FROM (
                SELECT ROWNUM AS RN,A.THBL, A.NRK,A.NAMA,A.KOLOK,A.KOJAB, A.KD,A.NJTUNDA,A.KINERJA,A.TKD_EKIN,A.NPOTTKD,A.NJTUNDABERSIH,A.KET,
                        (
                            CASE
                            WHEN A .KD = 'S' THEN
                                (
                                    SELECT
                                        NAJABL
                                    FROM
                                        PERS_KOJAB_TBL
                                    WHERE
                                        KOLOK = A .KOLOK
                                    AND KOJAB = A .KOJAB
                                )
                            ELSE
                                (
                                    SELECT
                                        NAJABL
                                    FROM
                                        PERS_KOJABF_TBL
                                    WHERE
                                        KOJAB = A .KOJAB
                                )
                            END
                        ) AS JABATAN,
                        B.NAMA AS SPMU,
                        C.NALOKL AS LOKASI
                    FROM
                        PROSES_TKD_GURU A
                    LEFT JOIN PERS_TABEL_SPMU B ON A.SPMU = B.KODE_SPM
                    LEFT JOIN PERS_LOKASI_TBL C ON A.KOLOK = C.KOLOK
                    WHERE
                        A.NRK = '".$nrk."'
                    AND SUBSTR (A .THBL, 5, 2) < '15'
                    AND A.THBL >= '201605'
                    AND A.UPLOAD = '1'
                )A  WHERE 1 = 1  ";

        
        // getting records as per search parameters
        if( !empty($requestData['search']['value']) ){   //kode nptt
            $sql.=" AND lower(THBL) LIKE lower('%".$requestData['search']['value']."%') ";
            // echo $sql;
        }
        
        
        
        $query= $this->db->query($sql);
        $totalFiltered = $query->num_rows();    
        
        $sql.=" AND RN > ".$requestData['start']." AND  ROWNUM <= ".$requestData['length']." "; 
        $sql.=" ORDER BY \"".$columns[$requestData['order'][0]['column']]."\"   ".$requestData['order'][0]['dir']." ";  // adding length
        
        // ECHO $sql;exit;
        // var_dump($sql);exit;
         // echo $sql;  
        $query= $this->db->query($sql);
        $n = $_POST['start'];
        $no = $n+1;
        $data = array();        

        foreach($query->result() as $row){
            $nestedData=array(); 
            $nestedData[] = $no;
            $nestedData[] = $row->THBL;
            $nestedData[] = $row->NRK;
            $nestedData[] = $row->JABATAN;
            $nestedData[] = $row->SPMU;
            $nestedData[] = $row->LOKASI;
            $nestedData[] = $row->KINERJA;
            $nestedData[] = $this->format_uang->rp_format($row->NJTUNDA);
            $nestedData[] = $this->format_uang->rp_format($row->NPOTTKD);
            $nestedData[] = $this->format_uang->rp_format($row->NJTUNDABERSIH);

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

    public function get_data_tkd_pg($nrk)
    {
        $requestData = $this->input->post(); 

        $columns = array( 
        // datatable column index  => database column name
            0 => 'THBL',
            1 => 'THBL',
            2 => 'NRK', 
            3 => 'JABATAN',
            4 => 'SPMU',
            5 => 'LOKASI',
            6 => 'KINERJA',
            7 => 'NJTUNDA',
            8 => 'NPOTTKD',
            9 => 'NJTUNDABERSIH'

        );

        // getting total number records without any search
        $sql = "SELECT * FROM (
                SELECT ROWNUM AS RN,A.THBL, A.NRK,A.NAMA,A.KOLOK,A.KOJAB, A.KD,A.NJTUNDA,A.KINERJA,A.TKD_EKIN,A.NPOTTKD,A.NJTUNDABERSIH,A.KET,
                        (
                            CASE
                            WHEN A .KD = 'S' THEN
                                (
                                    SELECT
                                        NAJABL
                                    FROM
                                        PERS_KOJAB_TBL
                                    WHERE
                                        KOLOK = A .KOLOK
                                    AND KOJAB = A .KOJAB
                                )
                            ELSE
                                (
                                    SELECT
                                        NAJABL
                                    FROM
                                        PERS_KOJABF_TBL
                                    WHERE
                                        KOJAB = A .KOJAB
                                )
                            END
                        ) AS JABATAN,
                        B.NAMA AS SPMU,
                        C.NALOKL AS LOKASI
                    FROM
                        PROSES_TKD_TAHAP2 A
                    LEFT JOIN PERS_TABEL_SPMU B ON A.SPMU = B.KODE_SPM
                    LEFT JOIN PERS_LOKASI_TBL C ON A.KOLOK = C.KOLOK
                    WHERE
                        A.NRK = '".$nrk."'
                    AND SUBSTR (A .THBL, 5, 2) < '15'
                    AND A.THBL >= '201605'
                    AND A.UPLOAD = '1'
                )A";
        // echo $sql;exit();
        
        $query = $this->db->query($sql);
        $totalData = $query->num_rows();
        $totalFiltered = $totalData;  // when there is no search parameter then total number rows = total number filtered rows.

        $sql = "SELECT * FROM (
                SELECT ROWNUM AS RN,A.THBL, A.NRK,A.NAMA,A.KOLOK,A.KOJAB, A.KD,A.NJTUNDA,A.KINERJA,A.TKD_EKIN,A.NPOTTKD,A.NJTUNDABERSIH,A.KET,
                        (
                            CASE
                            WHEN A .KD = 'S' THEN
                                (
                                    SELECT
                                        NAJABL
                                    FROM
                                        PERS_KOJAB_TBL
                                    WHERE
                                        KOLOK = A .KOLOK
                                    AND KOJAB = A .KOJAB
                                )
                            ELSE
                                (
                                    SELECT
                                        NAJABL
                                    FROM
                                        PERS_KOJABF_TBL
                                    WHERE
                                        KOJAB = A .KOJAB
                                )
                            END
                        ) AS JABATAN,
                        B.NAMA AS SPMU,
                        C.NALOKL AS LOKASI
                    FROM
                        PROSES_TKD_TAHAP2 A
                    LEFT JOIN PERS_TABEL_SPMU B ON A.SPMU = B.KODE_SPM
                    LEFT JOIN PERS_LOKASI_TBL C ON A.KOLOK = C.KOLOK
                    WHERE
                        A.NRK = '".$nrk."'
                    AND SUBSTR (A .THBL, 5, 2) < '15'
                    AND A.THBL >= '201605'
                    AND A.UPLOAD = '1'
                )A  WHERE 1 = 1  ";

        
        // getting records as per search parameters
        if( !empty($requestData['search']['value']) ){   //kode nptt
            $sql.=" AND lower(THBL) LIKE lower('%".$requestData['search']['value']."%') ";
            // echo $sql;
        }
        
        
        
        $query= $this->db->query($sql);
        $totalFiltered = $query->num_rows();    
        
        $sql.=" AND RN > ".$requestData['start']." AND  ROWNUM <= ".$requestData['length']." "; 
        $sql.=" ORDER BY \"".$columns[$requestData['order'][0]['column']]."\"   ".$requestData['order'][0]['dir']." ";  // adding length
        
        // ECHO $sql;exit;
        // var_dump($sql);exit;
         // echo $sql;  
        $query= $this->db->query($sql);
        $n = $_POST['start'];
        $no = $n+1;
        $data = array();        

        foreach($query->result() as $row){
            $nestedData=array(); 
            $nestedData[] = $no;
            $nestedData[] = $row->THBL;
            $nestedData[] = $row->NRK;
            $nestedData[] = $row->JABATAN;
            $nestedData[] = $row->SPMU;
            $nestedData[] = $row->LOKASI;
            $nestedData[] = $row->KINERJA;
            $nestedData[] = $this->format_uang->rp_format($row->NJTUNDA);
            $nestedData[] = $this->format_uang->rp_format($row->NPOTTKD);
            $nestedData[] = $this->format_uang->rp_format($row->NJTUNDABERSIH);
                        
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

    public function get_data_gaji($nrk)
    {
        $requestData = $this->input->post(); 

        $columns = array( 
        // datatable column index  => database column name
            0 => 'THBL',
            1 => 'THBL',
            2 => 'NRK', 
            3 => 'JABATAN',
            4 => 'SPMU',
            5 => 'LOKASI',
            6 => 'NJUMKOT',
            7 => 'NJUMPOTGAJI',
            8 => 'NJUMBERGAJI'

        );

        // getting total number records without any search
        $sql = "SELECT * FROM (
                    SELECT ROWNUM AS RN,A.THBL,A.NRK,A.NAMA,A.KOLOK,A.KOJAB,A.NJUMKOT,A.NJUMPOTGAJI,A.NJUMBERGAJI,A.KD,
                    (
                        CASE
                        WHEN A .KD = 'S' THEN
                            (
                                SELECT
                                    NAJABL
                                FROM
                                    PERS_KOJAB_TBL
                                WHERE
                                    KOLOK = A.KOLOK
                                AND KOJAB = A.KOJAB
                            )
                        ELSE
                            (
                                SELECT
                                    NAJABL
                                FROM
                                    PERS_KOJABF_TBL
                                WHERE
                                    KOJAB = A.KOJAB
                            )
                        END
                    ) AS JABATAN,
                    B.NAMA AS SPMU,
                    C.NALOKL AS LOKASI,
                    A.UPLOAD
                    FROM
                        PERS_DUK_PANGKAT_HISTDUK A
                    LEFT JOIN PERS_TABEL_SPMU B ON A .SPMU = B.KODE_SPM
                    LEFT JOIN PERS_LOKASI_TBL C ON A .KOLOK = C.KOLOK
                    WHERE
                        A .NRK = '".$nrk."'
                    AND SUBSTR (A.THBL, 5, 2) < '15'
                    AND A. THBL >= '201605'
                    AND A .UPLOAD = '1'
                )A";
        // echo $sql;exit();
        
        $query = $this->db->query($sql);
        $totalData = $query->num_rows();
        $totalFiltered = $totalData;  // when there is no search parameter then total number rows = total number filtered rows.

        $sql = "SELECT * FROM (
                    SELECT ROWNUM AS RN,A.THBL,A.NRK,A.NAMA,A.KOLOK,A.KOJAB,A.NJUMKOT,A.NJUMPOTGAJI,A.NJUMBERGAJI,A.KD,
                    (
                        CASE
                        WHEN A .KD = 'S' THEN
                            (
                                SELECT
                                    NAJABL
                                FROM
                                    PERS_KOJAB_TBL
                                WHERE
                                    KOLOK = A.KOLOK
                                AND KOJAB = A.KOJAB
                            )
                        ELSE
                            (
                                SELECT
                                    NAJABL
                                FROM
                                    PERS_KOJABF_TBL
                                WHERE
                                    KOJAB = A.KOJAB
                            )
                        END
                    ) AS JABATAN,
                    B.NAMA AS SPMU,
                    C.NALOKL AS LOKASI,
                    A.UPLOAD
                    FROM
                        PERS_DUK_PANGKAT_HISTDUK A
                    LEFT JOIN PERS_TABEL_SPMU B ON A .SPMU = B.KODE_SPM
                    LEFT JOIN PERS_LOKASI_TBL C ON A .KOLOK = C.KOLOK
                    WHERE
                        A .NRK = '".$nrk."'
                    AND SUBSTR (A.THBL, 5, 2) < '15'
                    AND A. THBL >= '201605'
                    AND A .UPLOAD = '1'
                )A  WHERE 1 = 1  ";

        
        // getting records as per search parameters
        if( !empty($requestData['search']['value']) ){   //kode nptt
            $sql.=" AND lower(THBL) LIKE lower('%".$requestData['search']['value']."%') ";
            // echo $sql; exit();
        }
        
        
        
        $query= $this->db->query($sql);
        $totalFiltered = $query->num_rows();    
        
        $sql.=" AND RN > ".$requestData['start']." AND  ROWNUM <= ".$requestData['length']." "; 
        $sql.=" ORDER BY \"".$columns[$requestData['order'][0]['column']]."\"   ".$requestData['order'][0]['dir']." ";  // adding length
        
        // ECHO $sql;exit;
        // var_dump($sql);exit;
         // echo $sql;  
        $query= $this->db->query($sql);
        $n = $_POST['start'];
        $no = $n+1;
        $data = array();        

        foreach($query->result() as $row){
            $nestedData=array(); 
            $nestedData[] = $no;
            $nestedData[] = $row->THBL;
            $nestedData[] = $row->NRK;
            $nestedData[] = $row->JABATAN;
            $nestedData[] = $row->SPMU;
            $nestedData[] = $row->LOKASI;
            $nestedData[] = $this->format_uang->rp_format($row->NJUMKOT);
            $nestedData[] = $this->format_uang->rp_format($row->NJUMPOTGAJI);
            $nestedData[] = $this->format_uang->rp_format($row->NJUMBERGAJI);
                        
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

   
    
}

?>
