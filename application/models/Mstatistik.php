<?php 

 class Mstatistik extends CI_Model {

    var $title   = '';
    var $content = '';
    var $date    = '';
    private $bt;
  

    function __construct()
    {        
        parent::__construct();

        $this->bt =& get_instance();
        $this->bt->load->database(); 
       // $this->db = $this->bt->load->database('29', TRUE);
        
    }

    function getThblparam($thbl="")
    {
        $sql = "SELECT DISTINCT(THBL) THBL FROM PERS_DUK_PANGKAT_HISTDUK WHERE THBL LIKE '201%' AND SUBSTR(THBL,5,2) IN ('01','02','03','04','05','06','07','08','09','10','11','12') ORDER BY THBL DESC";

        $query = $this->db->query($sql);        

        $option  = "";
        
        foreach($query->result() as $row){
            if($thbl == $row->THBL)
            {
                $option .= "<option selected value='".$row->THBL."'>".$row->THBL."</option>";
            }
            else
            {          
                $option .= "<option value='".$row->THBL."'>".$row->THBL."</option>";
            }
        }
        
        return $option;   

    }

    public function getSpmuFromThbl($thbl)
    {
        
        $sql="SELECT BKL.SPMU,B.NAMA FROM 
                (
                    SELECT DISTINCT(SPMU) SPMU FROM PERS_DUK_PANGKAT_HISTDUK A WHERE THBL='".$thbl."' ) BKL
                    LEFT JOIN PERS_TABEL_SPMU B ON BKL.SPMU = B.KODE_SPM ORDER BY BKL.SPMU ASC
            ";
            //die($sql);
        $query = $this->db->query($sql);        

        $option  = "";
        $option .= "<option selected value='-'>-</option>"; 
        foreach($query->result() as $row){
                     
                $option .= "<option value='".$row->SPMU."'>".$row->SPMU." - ".$row->NAMA."</option>";
            
        }
        
        return $option;       
    }   

    public function getUkpdFromThblSpm($thbl,$spmu)
    {
        
        $sql="SELECT BKL.KLOGAD,B.NALOKL FROM 
                (
                    SELECT DISTINCT(KLOGAD) KLOGAD FROM PERS_DUK_PANGKAT_HISTDUK A WHERE THBL='".$thbl."' AND SPMU='".$spmu."') BKL
                    LEFT JOIN PERS_LOKASI_TBL B ON BKL.KLOGAD = B.KOLOK ORDER BY BKL.KLOGAD ASC
            ";

        $query = $this->db->query($sql);        

        $option  = "";
        $option .= "<option selected value='-'>-</option>"; 
        foreach($query->result() as $row){
                     
                $option .= "<option value='".$row->KLOGAD."'>".$row->KLOGAD." - ".$row->NALOKL."</option>";
            
        }
        
        return $option;       
    } 

    function getAllStatGender()
    {
        $sql = "SELECT jenkel,count(jenkel)jml from pers_pegawai1 where klogad not like '1111111%' AND NRK < 999999
                AND NRK NOT IN (25310,199412,999000,885649,805171,666666,611722,576008,555555,537176,470045,441138,435023,412002,409579,376263,353515,
                333333,321095,317668,266407,250204,222222,217208,200558,199412
                )GROUP BY jenkel ORDER BY jenkel asc";

        $query = $this->db->query($sql);

        $result = $query->result();
        return $result;
    }

    function getStatGender($thbl,$spmu,$klogad)
    {
        if($spmu == '-' && ($klogad == '' || $klogad == '-'))
        {
            $sql = "SELECT jenkel,count(jenkel)jml from pers_duk_pangkat_histduk where thbl='".$thbl."'  GROUP BY jenkel ORDER BY jenkel asc";    
        }
        else if($spmu!='-' && $klogad =='-' )
        {
            $sql = "SELECT jenkel,count(jenkel)jml from pers_duk_pangkat_histduk where thbl='".$thbl."' and spmu='".$spmu."' GROUP BY jenkel ORDER BY jenkel asc";
        }
        else
        {
            $sql = "SELECT jenkel,count(jenkel)jml from pers_duk_pangkat_histduk where thbl='".$thbl."' and spmu='".$spmu."' AND KLOGAD='".$klogad."' GROUP BY jenkel ORDER BY jenkel asc";    
        }
        
        
        $query = $this->db->query($sql);

        $result = $query->result();
        return $result;
    }

    function getStatGenderPNS($thbl,$spmu,$klogad)
    {
        $where='';
        if($spmu == '-' && ($klogad == '' || $klogad == '-'))
        {
            $where = " AND THBL = '$thbl' ";

        }
        else if($spmu!='-' && $klogad =='-' )
        {
            $where = " AND THBL = '$thbl' AND SPMU = '$spmu' ";
        }
        else
        {
            $where = " AND THBL = '$thbl' AND SPMU = '$spmu' AND KLOGAD = '$klogad' ";
        }
        
            $sql = "SELECT DISTINCT
                        SUBSTR (A .kopang, 2, 1) GOL,
                        NVL (B.JML, 0) LAKILAKI,
                        NVL (C.JML, 0) PEREMPUAN,
                        (
                            NVL (B.JML, 0) + NVL (C.JML, 0)
                        ) JUMLAHTOTAL
                    FROM
                        PERS_DUK_PANGKAT_HISTDUK A
                    LEFT JOIN (
                        SELECT
                            SUBSTR (KOPANG, 2, 1) GOL,
                            COUNT (NRK) JML
                        FROM
                            PERS_DUK_PANGKAT_HISTDUK
                        WHERE
                            JENKEL='L' AND STAPEG = 2
                        AND thbl = '".$thbl."' $where
                        GROUP BY
                            SUBSTR (KOPANG, 2, 1)
                    ) B ON SUBSTR (A .KOPANG, 2, 1) = B.GOL
                    LEFT JOIN (
                        SELECT
                            SUBSTR (KOPANG, 2, 1) GOL,
                            COUNT (NRK) JML
                        FROM
                            PERS_DUK_PANGKAT_HISTDUK
                        WHERE
                            JENKEL='P' AND STAPEG = 2
                        AND thbl = '".$thbl."' $where
                        GROUP BY
                            SUBSTR (KOPANG, 2, 1)
                    ) C ON SUBSTR (A .KOPANG, 2, 1) = C.GOL
                    
                    WHERE
                        A .THBL = '".$thbl."'
                    ORDER BY
                        SUBSTR (A .KOPANG, 2, 1) ASC";  
                            
        
        
        $query = $this->db->query($sql);

        $result = $query->result();
        return $result;
    }

    function getStatGenderCPNS($thbl,$spmu,$klogad)
    {
        $where='';
        if($spmu == '-' && ($klogad == '' || $klogad == '-'))
        {
            $where = " AND THBL = '$thbl' ";

        }
        else if($spmu!='-' && $klogad =='-' )
        {
            $where = " AND THBL = '$thbl' AND SPMU = '$spmu' ";
        }
        else
        {
            $where = " AND THBL = '$thbl' AND SPMU = '$spmu' AND KLOGAD = '$klogad' ";
        }
        
            $sql = "SELECT DISTINCT
                        SUBSTR (A .kopang, 2, 1) GOL,
                        NVL (B.JML, 0) LAKILAKI,
                        NVL (C.JML, 0) PEREMPUAN,
                        (
                            NVL (B.JML, 0) + NVL (C.JML, 0)
                        ) JUMLAHTOTAL
                    FROM
                        PERS_DUK_PANGKAT_HISTDUK A
                    LEFT JOIN (
                        SELECT
                            SUBSTR (KOPANG, 2, 1) GOL,
                            COUNT (NRK) JML
                        FROM
                            PERS_DUK_PANGKAT_HISTDUK
                        WHERE
                            JENKEL='L' AND STAPEG = 1
                        AND thbl = '".$thbl."' $where
                        GROUP BY
                            SUBSTR (KOPANG, 2, 1)
                    ) B ON SUBSTR (A .KOPANG, 2, 1) = B.GOL
                    LEFT JOIN (
                        SELECT
                            SUBSTR (KOPANG, 2, 1) GOL,
                            COUNT (NRK) JML
                        FROM
                            PERS_DUK_PANGKAT_HISTDUK
                        WHERE
                            JENKEL='P' AND STAPEG = 1
                        AND thbl = '".$thbl."' $where
                        GROUP BY
                            SUBSTR (KOPANG, 2, 1)
                    ) C ON SUBSTR (A .KOPANG, 2, 1) = C.GOL
                    
                    WHERE
                        A .THBL = '".$thbl."'
                    ORDER BY
                        SUBSTR (A .KOPANG, 2, 1) ASC";  
                            
        
        
        $query = $this->db->query($sql);

        $result = $query->result();
        return $result;
    }



    function getStatEselon($thbl,$spmu,$klogad)
    {
        $where='';
        if($spmu == '-' && ($klogad == '' || $klogad == '-'))
        {
            $where = " AND THBL = '$thbl' ";

        }
        else if($spmu!='-' && $klogad =='-' )
        {
            $where = " AND THBL = '$thbl' AND SPMU = '$spmu' ";
        }
        else
        {
            $where = " AND THBL = '$thbl' AND SPMU = '$spmu' AND KLOGAD = '$klogad' ";
        }
        
            $sql = "SELECT DISTINCT
                SUBSTR (A .kopang, 2, 1) GOL,NVL(B.JML,0)ESELON1A,NVL(C.JML,0)ESELON1B,NVL(D.JML,0)ESELON2A,NVL(E.JML,0)ESELON2B
                ,NVL(F.JML,0)ESELON3A,NVL(G.JML,0)ESELON3B,NVL(H.JML,0)ESELON4A,NVL(I.JML,0)ESELON4B, 
                (NVL(B.JML,0) + NVL(C.JML,0) + NVL(D.JML,0) + NVL(E.JML,0) + NVL(F.JML,0) + NVL(G.JML,0) + NVL(H.JML,0) + NVL(I.JML,0)) JUMLAHTOTAL
            FROM
                PERS_DUK_PANGKAT_HISTDUK A
            LEFT JOIN (
                SELECT
                    SUBSTR (KOPANG, 2, 1) GOL,
                    COUNT (NRK) JML
                FROM
                    PERS_DUK_PANGKAT_HISTDUK
                
                WHERE ESELON = '11'  $where
                GROUP BY
                    SUBSTR (KOPANG, 2, 1)
            ) B ON SUBSTR(A.KOPANG,2,1)=B.GOL
            LEFT JOIN (
                SELECT
                    SUBSTR (KOPANG, 2, 1) GOL,
                    COUNT (NRK) JML
                FROM
                    PERS_DUK_PANGKAT_HISTDUK
                
                WHERE ESELON = '12'  $where
                GROUP BY
                    SUBSTR (KOPANG, 2, 1)
            ) C ON SUBSTR(A.KOPANG,2,1)=C.GOL
            LEFT JOIN (
                SELECT
                    SUBSTR (KOPANG, 2, 1) GOL,
                    COUNT (NRK) JML
                FROM
                    PERS_DUK_PANGKAT_HISTDUK
                
                WHERE ESELON = '21'  $where
                GROUP BY
                    SUBSTR (KOPANG, 2, 1)
            ) D ON SUBSTR(A.KOPANG,2,1)=D.GOL
            LEFT JOIN (
                SELECT
                    SUBSTR (KOPANG, 2, 1) GOL,
                    COUNT (NRK) JML
                FROM
                    PERS_DUK_PANGKAT_HISTDUK
                
                WHERE ESELON = '22'  $where
                GROUP BY
                    SUBSTR (KOPANG, 2, 1)
            ) E ON SUBSTR(A.KOPANG,2,1)=E.GOL
            LEFT JOIN (
                SELECT
                    SUBSTR (KOPANG, 2, 1) GOL,
                    COUNT (NRK) JML
                FROM
                    PERS_DUK_PANGKAT_HISTDUK
                
                WHERE ESELON = '31'  $where
                GROUP BY
                    SUBSTR (KOPANG, 2, 1)
            ) F ON SUBSTR(A.KOPANG,2,1)=F.GOL
            LEFT JOIN (
                SELECT
                    SUBSTR (KOPANG, 2, 1) GOL,
                    COUNT (NRK) JML
                FROM
                    PERS_DUK_PANGKAT_HISTDUK
                
                WHERE ESELON = '32'  $where
                GROUP BY
                    SUBSTR (KOPANG, 2, 1)
            ) G ON SUBSTR(A.KOPANG,2,1) = G.GOL
            LEFT JOIN (
                SELECT
                    SUBSTR (KOPANG, 2, 1) GOL,
                    COUNT (NRK) JML
                FROM
                    PERS_DUK_PANGKAT_HISTDUK
                
                WHERE ESELON = '41'  $where
                GROUP BY
                    SUBSTR (KOPANG, 2, 1)
            ) H ON SUBSTR(A.KOPANG,2,1) = H.GOL
            LEFT JOIN (
                SELECT
                    SUBSTR (KOPANG, 2, 1) GOL,
                    COUNT (NRK) JML
                FROM
                    PERS_DUK_PANGKAT_HISTDUK
                
                WHERE ESELON = '42'  $where
                GROUP BY
                    SUBSTR (KOPANG, 2, 1)
            ) I ON SUBSTR(A.KOPANG,2,1) = I.GOL
            WHERE
                A .THBL = '$thbl'
            ORDER BY SUBSTR(A.KOPANG,2,1) ASC";  
        
        
        
        $query = $this->db->query($sql);

        $result = $query->result();
        return $result;
    }

    function getStatNonEselon($thbl,$spmu,$klogad)
    {
        $where='';
        if($spmu == '-' && ($klogad == '' || $klogad == '-'))
        {
            $where = " AND THBL = '$thbl' ";

        }
        else if($spmu!='-' && $klogad =='-' )
        {
            $where = " AND THBL = '$thbl' AND SPMU = '$spmu' ";
        }
        else
        {
            $where = " AND THBL = '$thbl' AND SPMU = '$spmu' AND KLOGAD = '$klogad' ";
        }
        
            $sql = "SELECT DISTINCT
                SUBSTR (A .kopang, 2, 1) GOL, 
                NVL(B.JML,0) JUMLAHTOTAL
            FROM
                PERS_DUK_PANGKAT_HISTDUK A
            LEFT JOIN (
                SELECT
                    SUBSTR (KOPANG, 2, 1) GOL,
                    COUNT (NRK) JML
                FROM
                    PERS_DUK_PANGKAT_HISTDUK
                
                WHERE (ESELON = '00' OR ESELON=' ')  $where
                GROUP BY
                    SUBSTR (KOPANG, 2, 1)
            ) B ON SUBSTR(A.KOPANG,2,1)=B.GOL
            
            
            WHERE
                A .THBL = '$thbl'
            ORDER BY SUBSTR(A.KOPANG,2,1) ASC";  
        
        
        
        $query = $this->db->query($sql);

        $result = $query->result();
        return $result;
    }

    function getStatUsia($thbl,$spmu,$klogad)
    {
        $where='';
        if($spmu == '-' && ($klogad == '' || $klogad == '-'))
        {
            $where = " AND THBL = '$thbl' ";

        }
        else if($spmu!='-' && $klogad =='-' )
        {
            $where = " AND THBL = '$thbl' AND SPMU = '$spmu' ";
        }
        else
        {
            $where = " AND THBL = '$thbl' AND SPMU = '$spmu' AND KLOGAD = '$klogad' ";
        }
        
            $sql = "SELECT DISTINCT
                    SUBSTR (A .kopang, 2, 1) GOL,
                    NVL (B.JML, 0) BWAH25,
                    NVL (C.JML, 0) AN2530,
                    NVL (D .JML, 0) AN3036,
                    NVL (E .JML, 0) AN3642,
                    NVL (F.JML, 0) AN4248,
                    NVL (G .JML, 0) AN4855,
                    NVL (H .JML, 0) DIATAS55,
                    (
                        NVL (B.JML, 0) + NVL (C.JML, 0) + NVL (D .JML, 0) + NVL (E .JML, 0) + NVL (F.JML, 0) + NVL (G .JML, 0) + NVL (H .JML, 0)
                    ) JUMLAHTOTAL
                FROM
                    PERS_DUK_PANGKAT_HISTDUK A
                LEFT JOIN (
                    SELECT
                        SUBSTR (KOPANG, 2, 1) GOL,
                        COUNT (NRK) JML
                    FROM
                        PERS_DUK_PANGKAT_HISTDUK
                    WHERE
                        UMUR < 25 $where
                    AND thbl = '".$thbl."'
                    GROUP BY
                        SUBSTR (KOPANG, 2, 1)
                ) B ON SUBSTR (A .KOPANG, 2, 1) = B.GOL
                LEFT JOIN (
                    SELECT
                        SUBSTR (KOPANG, 2, 1) GOL,
                        COUNT (NRK) JML
                    FROM
                        PERS_DUK_PANGKAT_HISTDUK
                    WHERE
                        (UMUR >= 25 AND UMUR < 30) $where
                    AND thbl = '".$thbl."'
                    GROUP BY
                        SUBSTR (KOPANG, 2, 1)
                ) C ON SUBSTR (A .KOPANG, 2, 1) = C.GOL
                LEFT JOIN (
                    SELECT
                        SUBSTR (KOPANG, 2, 1) GOL,
                        COUNT (NRK) JML
                    FROM
                        PERS_DUK_PANGKAT_HISTDUK
                    WHERE
                        (UMUR >= 30 AND UMUR < 36) $where
                    AND thbl = '".$thbl."'
                    GROUP BY
                        SUBSTR (KOPANG, 2, 1)
                ) D ON SUBSTR (A .KOPANG, 2, 1) = D .GOL
                LEFT JOIN (
                    SELECT
                        SUBSTR (KOPANG, 2, 1) GOL,
                        COUNT (NRK) JML
                    FROM
                        PERS_DUK_PANGKAT_HISTDUK
                    WHERE
                        (UMUR >= 36 AND UMUR < 42) $where
                    AND thbl = '".$thbl."'
                    GROUP BY
                        SUBSTR (KOPANG, 2, 1)
                ) E ON SUBSTR (A .KOPANG, 2, 1) = E .GOL
                LEFT JOIN (
                    SELECT
                        SUBSTR (KOPANG, 2, 1) GOL,
                        COUNT (NRK) JML
                    FROM
                        PERS_DUK_PANGKAT_HISTDUK
                    WHERE
                        (UMUR >= 42 AND UMUR < 48) $where
                    AND thbl = '".$thbl."'
                    GROUP BY
                        SUBSTR (KOPANG, 2, 1)
                ) F ON SUBSTR (A .KOPANG, 2, 1) = F.GOL
                LEFT JOIN (
                    SELECT
                        SUBSTR (KOPANG, 2, 1) GOL,
                        COUNT (NRK) JML
                    FROM
                        PERS_DUK_PANGKAT_HISTDUK
                    WHERE
                        (UMUR >= 48 AND UMUR <= 55) $where
                    AND thbl = '".$thbl."'
                    GROUP BY
                        SUBSTR (KOPANG, 2, 1)
                ) G ON SUBSTR (A .KOPANG, 2, 1) = G .GOL
                LEFT JOIN (
                    SELECT
                        SUBSTR (KOPANG, 2, 1) GOL,
                        COUNT (NRK) JML
                    FROM
                        PERS_DUK_PANGKAT_HISTDUK
                    WHERE
                        UMUR > 55 $where
                    AND thbl = '".$thbl."'
                    GROUP BY
                        SUBSTR (KOPANG, 2, 1)
                ) H ON SUBSTR (A .KOPANG, 2, 1) = H .GOL
                WHERE
                    A .THBL = '".$thbl."'
                ORDER BY
                    SUBSTR (A .KOPANG, 2, 1) ASC";  
        
        
        
        $query = $this->db->query($sql);

        $result = $query->result();
        return $result;
    }

    function getStatPangkat($thbl,$spmu,$klogad)
    {
        $where='';
        if($spmu == '-' && ($klogad == '' || $klogad == '-'))
        {
            $where = " AND THBL = '$thbl' ";

        }
        else if($spmu!='-' && $klogad =='-' )
        {
            $where = " AND THBL = '$thbl' AND SPMU = '$spmu' ";
        }
        else
        {
            $where = " AND THBL = '$thbl' AND SPMU = '$spmu' AND KLOGAD = '$klogad' ";
        }
        
            $sql = "SELECT DISTINCT
                        SUBSTR (A .kopang, 2, 1) GOL,
                        COUNT(NRK) JMLGOL
                    FROM
                        PERS_DUK_PANGKAT_HISTDUK A

                    WHERE
                        A .THBL = '".$thbl."' $where
                    GROUP BY SUBSTR (A .kopang, 2, 1) 
                    ORDER BY
                        SUBSTR (A .KOPANG, 2, 1) ASC";  
                            
        
        
        $query = $this->db->query($sql);

        $result = $query->result();
        return $result;
    }

    function getStatPendidikan($thbl,$spmu,$klogad)
    {
        $where='';
        if($spmu == '-' && ($klogad == '' || $klogad == '-'))
        {
            $where = " AND THBL = '$thbl' ";

        }
        else if($spmu!='-' && $klogad =='-' )
        {
            $where = " AND THBL = '$thbl' AND SPMU = '$spmu' ";
        }
        else
        {
            $where = " AND THBL = '$thbl' AND SPMU = '$spmu' AND KLOGAD = '$klogad' ";
        }
        
            $sql = "SELECT DISTINCT
                        SUBSTR (A .kopang, 2, 1) GOL,
                        NVL (B.JML, 0) TMI,
                        NVL (C.JML, 0) SD,
                        NVL (D .JML, 0) SMP,
                        NVL (E .JML, 0) SMA,
                        NVL (F.JML, 0) D1,
                        NVL (G .JML, 0) D2,
                        NVL (H .JML, 0) D3,
                        NVL (I.JML, 0) S1,
                        NVL (J.JML, 0) S2,
                        NVL (K .JML, 0) S3,
                        (
                            NVL (B.JML, 0) + NVL (C.JML, 0) + NVL (D .JML, 0) + NVL (E .JML, 0) + NVL (F.JML, 0) + NVL (G .JML, 0) + NVL (H .JML, 0) + NVL (I.JML, 0) + NVL (J.JML, 0) + NVL (K.JML, 0)
                        ) JUMLAHTOTAL
                    FROM
                        PERS_DUK_PANGKAT_HISTDUK A
                    LEFT JOIN (
                        SELECT
                            SUBSTR (KOPANG, 2, 1) GOL,
                            COUNT (NRK) JML
                        FROM
                            PERS_DUK_PANGKAT_HISTDUK
                        WHERE
                            JENDIK = '1'
                        AND STAPEG = '2'
                        AND KODIK = '0000' --TMI
                        AND thbl = '".$thbl."' $where
                        GROUP BY
                            SUBSTR (KOPANG, 2, 1)
                    ) B ON SUBSTR (A .KOPANG, 2, 1) = B.GOL
                    LEFT JOIN (
                        SELECT
                            SUBSTR (KOPANG, 2, 1) GOL,
                            COUNT (NRK) JML
                        FROM
                            PERS_DUK_PANGKAT_HISTDUK
                        WHERE
                            JENDIK = '1'
                        AND STAPEG = '2'
                        AND KODIK LIKE '1%' 
                        AND thbl = '".$thbl."' $where
                        GROUP BY
                            SUBSTR (KOPANG, 2, 1)
                    ) C ON SUBSTR (A .KOPANG, 2, 1) = C.GOL
                    LEFT JOIN (
                        SELECT
                            SUBSTR (KOPANG, 2, 1) GOL,
                            COUNT (NRK) JML
                        FROM
                            PERS_DUK_PANGKAT_HISTDUK
                        WHERE
                            JENDIK = '1'
                        AND STAPEG = '2'
                        AND KODIK LIKE '2%' 
                        AND thbl = '".$thbl."' $where
                        GROUP BY
                            SUBSTR (KOPANG, 2, 1)
                    ) D ON SUBSTR (A .KOPANG, 2, 1) = D .GOL
                    LEFT JOIN (
                        SELECT
                            SUBSTR (KOPANG, 2, 1) GOL,
                            COUNT (NRK) JML
                        FROM
                            PERS_DUK_PANGKAT_HISTDUK
                        WHERE
                            JENDIK = '1'
                        AND STAPEG = '2'
                        AND KODIK LIKE '3%' 
                        AND thbl = '".$thbl."' $where
                        GROUP BY
                            SUBSTR (KOPANG, 2, 1)
                    ) E ON SUBSTR (A .KOPANG, 2, 1) = E .GOL
                    LEFT JOIN (
                        SELECT
                            SUBSTR (KOPANG, 2, 1) GOL,
                            COUNT (NRK) JML
                        FROM
                            PERS_DUK_PANGKAT_HISTDUK
                        WHERE
                            JENDIK = '1'
                        AND STAPEG = '2'
                        AND KODIK LIKE '40%' 
                        AND thbl = '".$thbl."' $where
                        GROUP BY
                            SUBSTR (KOPANG, 2, 1)
                    ) F ON SUBSTR (A .KOPANG, 2, 1) = F.GOL
                    LEFT JOIN (
                        SELECT
                            SUBSTR (KOPANG, 2, 1) GOL,
                            COUNT (NRK) JML
                        FROM
                            PERS_DUK_PANGKAT_HISTDUK
                        WHERE
                            JENDIK = '1'
                        AND STAPEG = '2'
                        AND (
                            KODIK LIKE '45%'
                            OR KODIK LIKE '46%'
                            OR KODIK LIKE '47%'
                        ) 
                        AND thbl = '".$thbl."' $where
                        GROUP BY
                            SUBSTR (KOPANG, 2, 1)
                    ) G ON SUBSTR (A .KOPANG, 2, 1) = G .GOL
                    LEFT JOIN (
                        SELECT
                            SUBSTR (KOPANG, 2, 1) GOL,
                            COUNT (NRK) JML
                        FROM
                            PERS_DUK_PANGKAT_HISTDUK
                        WHERE
                            JENDIK = '1'
                        AND STAPEG = '2'
                        AND KODIK LIKE '5%' 
                        AND thbl = '".$thbl."' $where
                        GROUP BY
                            SUBSTR (KOPANG, 2, 1)
                    ) H ON SUBSTR (A .KOPANG, 2, 1) = H .GOL
                    LEFT JOIN (
                        SELECT
                            SUBSTR (KOPANG, 2, 1) GOL,
                            COUNT (NRK) JML
                        FROM
                            PERS_DUK_PANGKAT_HISTDUK
                        WHERE
                            JENDIK = '1'
                        AND STAPEG = '2'
                        AND (KODIK LIKE '6%' OR KODIK LIKE '7%') --S1
                        AND thbl = '".$thbl."' $where
                        GROUP BY
                            SUBSTR (KOPANG, 2, 1)
                    ) I ON SUBSTR (A .KOPANG, 2, 1) = I.GOL
                    LEFT JOIN (
                        SELECT
                            SUBSTR (KOPANG, 2, 1) GOL,
                            COUNT (NRK) JML
                        FROM
                            PERS_DUK_PANGKAT_HISTDUK
                        WHERE
                            JENDIK = '1'
                        AND STAPEG = '2'
                        AND KODIK LIKE '8%' 
                        AND thbl = '".$thbl."' $where
                        GROUP BY
                            SUBSTR (KOPANG, 2, 1)
                    ) J ON SUBSTR (A .KOPANG, 2, 1) = J.GOL
                    LEFT JOIN (
                        SELECT
                            SUBSTR (KOPANG, 2, 1) GOL,
                            COUNT (NRK) JML
                        FROM
                            PERS_DUK_PANGKAT_HISTDUK
                        WHERE
                            JENDIK = '1'
                        AND STAPEG = '2'
                        AND KODIK LIKE '9%' 
                        AND thbl = '".$thbl."' $where
                        GROUP BY
                            SUBSTR (KOPANG, 2, 1)
                    ) K ON SUBSTR (A .KOPANG, 2, 1) = K .GOL
                    WHERE
                        A .THBL = '".$thbl."'
                    ORDER BY
                        SUBSTR (A .KOPANG, 2, 1) ASC";  
                            
        
        
        $query = $this->db->query($sql);

        $result = $query->result();
        return $result;
    }

    function getStatPendidikanCPNS($thbl,$spmu,$klogad)
    {
        $where='';
        if($spmu == '-' && ($klogad == '' || $klogad == '-'))
        {
            $where = " AND THBL = '$thbl' ";

        }
        else if($spmu!='-' && $klogad =='-' )
        {
            $where = " AND THBL = '$thbl' AND SPMU = '$spmu' ";
        }
        else
        {
            $where = " AND THBL = '$thbl' AND SPMU = '$spmu' AND KLOGAD = '$klogad' ";
        }
        
            $sql = "SELECT DISTINCT
                        SUBSTR (A .kopang, 2, 1) GOL,
                        NVL (B.JML, 0) TMI,
                        NVL (C.JML, 0) SD,
                        NVL (D .JML, 0) SMP,
                        NVL (E .JML, 0) SMA,
                        NVL (F.JML, 0) D1,
                        NVL (G .JML, 0) D2,
                        NVL (H .JML, 0) D3,
                        NVL (I.JML, 0) S1,
                        NVL (J.JML, 0) S2,
                        NVL (K .JML, 0) S3,
                        (
                            NVL (B.JML, 0) + NVL (C.JML, 0) + NVL (D .JML, 0) + NVL (E .JML, 0) + NVL (F.JML, 0) + NVL (G .JML, 0) + NVL (H .JML, 0) + NVL (I.JML, 0) + NVL (J.JML, 0) + NVL (K.JML, 0)
                        ) JUMLAHTOTAL
                    FROM
                        PERS_DUK_PANGKAT_HISTDUK A
                    LEFT JOIN (
                        SELECT
                            SUBSTR (KOPANG, 2, 1) GOL,
                            COUNT (NRK) JML
                        FROM
                            PERS_DUK_PANGKAT_HISTDUK
                        WHERE
                            JENDIK = '1'
                        AND STAPEG = '1'
                        AND KODIK = '0000' --TMI
                        AND thbl = '".$thbl."' $where
                        GROUP BY
                            SUBSTR (KOPANG, 2, 1)
                    ) B ON SUBSTR (A .KOPANG, 2, 1) = B.GOL
                    LEFT JOIN (
                        SELECT
                            SUBSTR (KOPANG, 2, 1) GOL,
                            COUNT (NRK) JML
                        FROM
                            PERS_DUK_PANGKAT_HISTDUK
                        WHERE
                            JENDIK = '1'
                        AND STAPEG = '1'
                        AND KODIK LIKE '1%' 
                        AND thbl = '".$thbl."' $where
                        GROUP BY
                            SUBSTR (KOPANG, 2, 1)
                    ) C ON SUBSTR (A .KOPANG, 2, 1) = C.GOL
                    LEFT JOIN (
                        SELECT
                            SUBSTR (KOPANG, 2, 1) GOL,
                            COUNT (NRK) JML
                        FROM
                            PERS_DUK_PANGKAT_HISTDUK
                        WHERE
                            JENDIK = '1'
                        AND STAPEG = '1'
                        AND KODIK LIKE '2%' 
                        AND thbl = '".$thbl."' $where
                        GROUP BY
                            SUBSTR (KOPANG, 2, 1)
                    ) D ON SUBSTR (A .KOPANG, 2, 1) = D .GOL
                    LEFT JOIN (
                        SELECT
                            SUBSTR (KOPANG, 2, 1) GOL,
                            COUNT (NRK) JML
                        FROM
                            PERS_DUK_PANGKAT_HISTDUK
                        WHERE
                            JENDIK = '1'
                        AND STAPEG = '1'
                        AND KODIK LIKE '3%' 
                        AND thbl = '".$thbl."' $where
                        GROUP BY
                            SUBSTR (KOPANG, 2, 1)
                    ) E ON SUBSTR (A .KOPANG, 2, 1) = E .GOL
                    LEFT JOIN (
                        SELECT
                            SUBSTR (KOPANG, 2, 1) GOL,
                            COUNT (NRK) JML
                        FROM
                            PERS_DUK_PANGKAT_HISTDUK
                        WHERE
                            JENDIK = '1'
                        AND STAPEG = '1'
                        AND KODIK LIKE '40%' 
                        AND thbl = '".$thbl."' $where
                        GROUP BY
                            SUBSTR (KOPANG, 2, 1)
                    ) F ON SUBSTR (A .KOPANG, 2, 1) = F.GOL
                    LEFT JOIN (
                        SELECT
                            SUBSTR (KOPANG, 2, 1) GOL,
                            COUNT (NRK) JML
                        FROM
                            PERS_DUK_PANGKAT_HISTDUK
                        WHERE
                            JENDIK = '1'
                        AND STAPEG = '1'
                        AND (
                            KODIK LIKE '45%'
                            OR KODIK LIKE '46%'
                            OR KODIK LIKE '47%'
                        ) 
                        AND thbl = '".$thbl."' $where
                        GROUP BY
                            SUBSTR (KOPANG, 2, 1)
                    ) G ON SUBSTR (A .KOPANG, 2, 1) = G .GOL
                    LEFT JOIN (
                        SELECT
                            SUBSTR (KOPANG, 2, 1) GOL,
                            COUNT (NRK) JML
                        FROM
                            PERS_DUK_PANGKAT_HISTDUK
                        WHERE
                            JENDIK = '1'
                        AND STAPEG = '1'
                        AND KODIK LIKE '5%' 
                        AND thbl = '".$thbl."' $where
                        GROUP BY
                            SUBSTR (KOPANG, 2, 1)
                    ) H ON SUBSTR (A .KOPANG, 2, 1) = H .GOL
                    LEFT JOIN (
                        SELECT
                            SUBSTR (KOPANG, 2, 1) GOL,
                            COUNT (NRK) JML
                        FROM
                            PERS_DUK_PANGKAT_HISTDUK
                        WHERE
                            JENDIK = '1'
                        AND STAPEG = '1'
                        AND (KODIK LIKE '6%' OR KODIK LIKE '7%') 
                        AND thbl = '".$thbl."' $where
                        GROUP BY
                            SUBSTR (KOPANG, 2, 1)
                    ) I ON SUBSTR (A .KOPANG, 2, 1) = I.GOL
                    LEFT JOIN (
                        SELECT
                            SUBSTR (KOPANG, 2, 1) GOL,
                            COUNT (NRK) JML
                        FROM
                            PERS_DUK_PANGKAT_HISTDUK
                        WHERE
                            JENDIK = '1'
                        AND STAPEG = '1'
                        AND KODIK LIKE '8%' 
                        AND thbl = '".$thbl."' $where
                        GROUP BY
                            SUBSTR (KOPANG, 2, 1)
                    ) J ON SUBSTR (A .KOPANG, 2, 1) = J.GOL
                    LEFT JOIN (
                        SELECT
                            SUBSTR (KOPANG, 2, 1) GOL,
                            COUNT (NRK) JML
                        FROM
                            PERS_DUK_PANGKAT_HISTDUK
                        WHERE
                            JENDIK = '1'
                        AND STAPEG = '1'
                        AND KODIK LIKE '9%' 
                        AND thbl = '".$thbl."' $where
                        GROUP BY
                            SUBSTR (KOPANG, 2, 1)
                    ) K ON SUBSTR (A .KOPANG, 2, 1) = K .GOL
                    WHERE
                        A .THBL = '".$thbl."'
                    ORDER BY
                        SUBSTR (A .KOPANG, 2, 1) ASC";  
                            
        
        
        $query = $this->db->query($sql);

        $result = $query->result();
        return $result;
    }

    function getStatStawin($thbl,$spmu,$klogad)
    {
        $where='';
        if($spmu == '-' && ($klogad == '' || $klogad == '-'))
        {
            $where = " AND THBL = '$thbl' ";

        }
        else if($spmu!='-' && $klogad =='-' )
        {
            $where = " AND THBL = '$thbl' AND SPMU = '$spmu' ";
        }
        else
        {
            $where = " AND THBL = '$thbl' AND SPMU = '$spmu' AND KLOGAD = '$klogad' ";
        }
        
            $sql = "SELECT DISTINCT
                        SUBSTR (A .kopang, 2, 1) GOL,
                        NVL (B.JML, 0) BELUMKAWIN,
                        NVL (C.JML, 0) KAWIN,
                        NVL (D .JML, 0) JANDA,
                        NVL (E .JML, 0) DUDA, (
                            NVL (B.JML, 0) + NVL (C.JML, 0) + NVL (D .JML, 0) + NVL (E .JML, 0)
                        ) JUMLAHTOTAL
                    FROM
                        PERS_DUK_PANGKAT_HISTDUK A
                    LEFT JOIN (
                        SELECT
                            SUBSTR (KOPANG, 2, 1) GOL,
                            COUNT (NRK) JML
                        FROM
                            PERS_DUK_PANGKAT_HISTDUK
                        WHERE
                            STAWIN = 0 AND STAPEG = 2
                        AND thbl = '".$thbl."' $where
                        GROUP BY
                            SUBSTR (KOPANG, 2, 1)
                    ) B ON SUBSTR (A .KOPANG, 2, 1) = B.GOL
                    LEFT JOIN (
                        SELECT
                            SUBSTR (KOPANG, 2, 1) GOL,
                            COUNT (NRK) JML
                        FROM
                            PERS_DUK_PANGKAT_HISTDUK
                        WHERE
                            STAWIN IN ('1', '2', '3', '4') AND STAPEG = 2
                        AND thbl = '".$thbl."' $where
                        GROUP BY
                            SUBSTR (KOPANG, 2, 1)
                    ) C ON SUBSTR (A .KOPANG, 2, 1) = C.GOL
                    LEFT JOIN (
                        SELECT
                            SUBSTR (KOPANG, 2, 1) GOL,
                            COUNT (NRK) JML
                        FROM
                            PERS_DUK_PANGKAT_HISTDUK
                        WHERE
                            STAWIN = 5 AND STAPEG = 2
                        AND thbl = '".$thbl."' $where
                        GROUP BY
                            SUBSTR (KOPANG, 2, 1)
                    ) D ON SUBSTR (A .KOPANG, 2, 1) = D .GOL
                    LEFT JOIN (
                        SELECT
                            SUBSTR (KOPANG, 2, 1) GOL,
                            COUNT (NRK) JML
                        FROM
                            PERS_DUK_PANGKAT_HISTDUK
                        WHERE
                            STAWIN = 6 AND STAPEG = 2
                        AND thbl = '".$thbl."' $where
                        GROUP BY
                            SUBSTR (KOPANG, 2, 1)
                    ) E ON SUBSTR (A .KOPANG, 2, 1) = E .GOL
                    WHERE
                        A .THBL = '".$thbl."'
                    ORDER BY
                        SUBSTR (A .KOPANG, 2, 1) ASC";  
                            
        
        
        $query = $this->db->query($sql);

        $result = $query->result();
        return $result;
    }

    function getStatStawincpns($thbl,$spmu,$klogad)
    {
        $where='';
        if($spmu == '-' && ($klogad == '' || $klogad == '-'))
        {
            $where = " AND THBL = '$thbl' ";

        }
        else if($spmu!='-' && $klogad =='-' )
        {
            $where = " AND THBL = '$thbl' AND SPMU = '$spmu' ";
        }
        else
        {
            $where = " AND THBL = '$thbl' AND SPMU = '$spmu' AND KLOGAD = '$klogad' ";
        }
        
            $sql = "SELECT DISTINCT
                        SUBSTR (A .kopang, 2, 1) GOL,
                        NVL (B.JML, 0) BELUMKAWIN,
                        NVL (C.JML, 0) KAWIN,
                        NVL (D .JML, 0) JANDA,
                        NVL (E .JML, 0) DUDA, (
                            NVL (B.JML, 0) + NVL (C.JML, 0) + NVL (D .JML, 0) + NVL (E .JML, 0)
                        ) JUMLAHTOTAL
                    FROM
                        PERS_DUK_PANGKAT_HISTDUK A
                    LEFT JOIN (
                        SELECT
                            SUBSTR (KOPANG, 2, 1) GOL,
                            COUNT (NRK) JML
                        FROM
                            PERS_DUK_PANGKAT_HISTDUK
                        WHERE
                            STAWIN = 0 AND STAPEG = 1
                        AND thbl = '".$thbl."' $where
                        GROUP BY
                            SUBSTR (KOPANG, 2, 1)
                    ) B ON SUBSTR (A .KOPANG, 2, 1) = B.GOL
                    LEFT JOIN (
                        SELECT
                            SUBSTR (KOPANG, 2, 1) GOL,
                            COUNT (NRK) JML
                        FROM
                            PERS_DUK_PANGKAT_HISTDUK
                        WHERE
                            STAWIN IN ('1', '2', '3', '4') AND STAPEG = 1
                        AND thbl = '".$thbl."' $where
                        GROUP BY
                            SUBSTR (KOPANG, 2, 1)
                    ) C ON SUBSTR (A .KOPANG, 2, 1) = C.GOL
                    LEFT JOIN (
                        SELECT
                            SUBSTR (KOPANG, 2, 1) GOL,
                            COUNT (NRK) JML
                        FROM
                            PERS_DUK_PANGKAT_HISTDUK
                        WHERE
                            STAWIN = 5 AND STAPEG = 1
                        AND thbl = '".$thbl."' $where
                        GROUP BY
                            SUBSTR (KOPANG, 2, 1)
                    ) D ON SUBSTR (A .KOPANG, 2, 1) = D .GOL
                    LEFT JOIN (
                        SELECT
                            SUBSTR (KOPANG, 2, 1) GOL,
                            COUNT (NRK) JML
                        FROM
                            PERS_DUK_PANGKAT_HISTDUK
                        WHERE
                            STAWIN = 6 AND STAPEG = 1
                        AND thbl = '".$thbl."' $where
                        GROUP BY
                            SUBSTR (KOPANG, 2, 1)
                    ) E ON SUBSTR (A .KOPANG, 2, 1) = E .GOL
                    WHERE
                        A .THBL = '".$thbl."'
                    ORDER BY
                        SUBSTR (A .KOPANG, 2, 1) ASC";  
                            
        
        
        $query = $this->db->query($sql);

        $result = $query->result();
        return $result;
    }

    function getStatMasker($thbl,$spmu,$klogad)
    {
        $where='';
        if($spmu == '-' && ($klogad == '' || $klogad == '-'))
        {
            $where = " AND THBL = '$thbl' ";

        }
        else if($spmu!='-' && $klogad =='-' )
        {
            $where = " AND THBL = '$thbl' AND SPMU = '$spmu' ";
        }
        else
        {
            $where = " AND THBL = '$thbl' AND SPMU = '$spmu' AND KLOGAD = '$klogad' ";
        }
        
            $sql = "SELECT DISTINCT
                        SUBSTR (A .kopang, 2, 1) GOL,
                        NVL (B.JML, 0) A15,
                        NVL (C.JML, 0) A610,
                        NVL (D .JML, 0) A1115,
                        NVL (E .JML, 0) A1620,
                        NVL (F.JML, 0) A2125,
                        NVL (G .JML, 0) A2530,
                        NVL (H .JML, 0) A3035,
                        NVL (H .JML, 0) A36,
                        (
                            NVL (B.JML, 0) + NVL (C.JML, 0) + NVL (D .JML, 0) + NVL (E .JML, 0) + NVL (F.JML, 0) + NVL (G .JML, 0) + NVL (H .JML, 0) + NVL (I.JML, 0)
                        ) JUMLAHTOTAL
                    FROM
                        PERS_DUK_PANGKAT_HISTDUK A
                    LEFT JOIN (
                        SELECT
                            SUBSTR (KOPANG, 2, 1) GOL,
                            COUNT (NRK) JML
                        FROM
                            PERS_DUK_PANGKAT_HISTDUK
                        WHERE
                            SUBSTR (MASKER, 1, 2) IN (
                                '00',
                                '01',
                                '02',
                                '03',
                                '04',
                                '05'
                            )
                        AND STAPEG = 2
                        AND thbl = '".$thbl."' $where
                        GROUP BY
                            SUBSTR (KOPANG, 2, 1)
                    ) B ON SUBSTR (A .KOPANG, 2, 1) = B.GOL
                    LEFT JOIN (
                        SELECT
                            SUBSTR (KOPANG, 2, 1) GOL,
                            COUNT (NRK) JML
                        FROM
                            PERS_DUK_PANGKAT_HISTDUK
                        WHERE
                            SUBSTR (MASKER, 1, 2) IN ('06', '07', '08', '09', '10')
                        AND STAPEG = 2
                        AND thbl = '".$thbl."' $where
                        GROUP BY
                            SUBSTR (KOPANG, 2, 1)
                    ) C ON SUBSTR (A .KOPANG, 2, 1) = C.GOL
                    LEFT JOIN (
                        SELECT
                            SUBSTR (KOPANG, 2, 1) GOL,
                            COUNT (NRK) JML
                        FROM
                            PERS_DUK_PANGKAT_HISTDUK
                        WHERE
                            SUBSTR (MASKER, 1, 2) IN ('11', '12', '13', '14', '15')
                        AND STAPEG = 2
                        AND thbl = '".$thbl."' $where
                        GROUP BY
                            SUBSTR (KOPANG, 2, 1)
                    ) D ON SUBSTR (A .KOPANG, 2, 1) = D .GOL
                    LEFT JOIN (
                        SELECT
                            SUBSTR (KOPANG, 2, 1) GOL,
                            COUNT (NRK) JML
                        FROM
                            PERS_DUK_PANGKAT_HISTDUK
                        WHERE
                            SUBSTR (MASKER, 1, 2) IN ('16', '17', '18', '19', '20')
                        AND STAPEG = 2
                        AND thbl = '".$thbl."' $where
                        GROUP BY
                            SUBSTR (KOPANG, 2, 1)
                    ) E ON SUBSTR (A .KOPANG, 2, 1) = E .GOL
                    LEFT JOIN (
                        SELECT
                            SUBSTR (KOPANG, 2, 1) GOL,
                            COUNT (NRK) JML
                        FROM
                            PERS_DUK_PANGKAT_HISTDUK
                        WHERE
                            SUBSTR (MASKER, 1, 2) IN ('21', '22', '23', '24', '25')
                        AND STAPEG = 2
                        AND thbl = '".$thbl."' $where
                        GROUP BY
                            SUBSTR (KOPANG, 2, 1)
                    ) F ON SUBSTR (A .KOPANG, 2, 1) = F.GOL
                    LEFT JOIN (
                        SELECT
                            SUBSTR (KOPANG, 2, 1) GOL,
                            COUNT (NRK) JML
                        FROM
                            PERS_DUK_PANGKAT_HISTDUK
                        WHERE
                            SUBSTR (MASKER, 1, 2) IN ('26', '27', '28', '29', '30')
                        AND STAPEG = 2
                        AND thbl = '".$thbl."' $where
                        GROUP BY
                            SUBSTR (KOPANG, 2, 1)
                    ) G ON SUBSTR (A .KOPANG, 2, 1) = G .GOL
                    LEFT JOIN (
                        SELECT
                            SUBSTR (KOPANG, 2, 1) GOL,
                            COUNT (NRK) JML
                        FROM
                            PERS_DUK_PANGKAT_HISTDUK
                        WHERE
                            SUBSTR (MASKER, 1, 2) IN ('31', '32', '33', '34', '35')
                        AND STAPEG = 2
                        AND thbl = '".$thbl."' $where
                        GROUP BY
                            SUBSTR (KOPANG, 2, 1)
                    ) H ON SUBSTR (A .KOPANG, 2, 1) = H .GOL
                    LEFT JOIN (
                        SELECT
                            SUBSTR (KOPANG, 2, 1) GOL,
                            COUNT (NRK) JML
                        FROM
                            PERS_DUK_PANGKAT_HISTDUK
                        WHERE
                            SUBSTR (MASKER, 1, 2) > 35
                        AND STAPEG = 2
                        AND thbl = '".$thbl."' $where
                        GROUP BY
                            SUBSTR (KOPANG, 2, 1)
                    ) I ON SUBSTR (A .KOPANG, 2, 1) = I.GOL
                    WHERE
                        A .THBL = '".$thbl."'
                    ORDER BY
                        SUBSTR (A .KOPANG, 2, 1) ASC";  
                            
        
        
        $query = $this->db->query($sql);

        $result = $query->result();
        return $result;
    }

    function getStatMaskercpns($thbl,$spmu,$klogad)
    {
        $where='';
        if($spmu == '-' && ($klogad == '' || $klogad == '-'))
        {
            $where = " AND THBL = '$thbl' ";

        }
        else if($spmu!='-' && $klogad =='-' )
        {
            $where = " AND THBL = '$thbl' AND SPMU = '$spmu' ";
        }
        else
        {
            $where = " AND THBL = '$thbl' AND SPMU = '$spmu' AND KLOGAD = '$klogad' ";
        }
        
            $sql = "SELECT DISTINCT
                        SUBSTR (A .kopang, 2, 1) GOL,
                        NVL (B.JML, 0) A15,
                        NVL (C.JML, 0) A610,
                        NVL (D .JML, 0) A1115,
                        NVL (E .JML, 0) A1620,
                        NVL (F.JML, 0) A2125,
                        NVL (G .JML, 0) A2530,
                        NVL (H .JML, 0) A3035,
                        NVL (H .JML, 0) A36,
                        (
                            NVL (B.JML, 0) + NVL (C.JML, 0) + NVL (D .JML, 0) + NVL (E .JML, 0) + NVL (F.JML, 0) + NVL (G .JML, 0) + NVL (H .JML, 0) + NVL (I.JML, 0)
                        ) JUMLAHTOTAL
                    FROM
                        PERS_DUK_PANGKAT_HISTDUK A
                    LEFT JOIN (
                        SELECT
                            SUBSTR (KOPANG, 2, 1) GOL,
                            COUNT (NRK) JML
                        FROM
                            PERS_DUK_PANGKAT_HISTDUK
                        WHERE
                            SUBSTR (MASKER, 1, 2) IN (
                                '00',
                                '01',
                                '02',
                                '03',
                                '04',
                                '05'
                            )
                        AND STAPEG = 1
                        AND thbl = '".$thbl."' $where
                        GROUP BY
                            SUBSTR (KOPANG, 2, 1)
                    ) B ON SUBSTR (A .KOPANG, 2, 1) = B.GOL
                    LEFT JOIN (
                        SELECT
                            SUBSTR (KOPANG, 2, 1) GOL,
                            COUNT (NRK) JML
                        FROM
                            PERS_DUK_PANGKAT_HISTDUK
                        WHERE
                            SUBSTR (MASKER, 1, 2) IN ('06', '07', '08', '09', '10')
                        AND STAPEG = 1
                        AND thbl = '".$thbl."' $where
                        GROUP BY
                            SUBSTR (KOPANG, 2, 1)
                    ) C ON SUBSTR (A .KOPANG, 2, 1) = C.GOL
                    LEFT JOIN (
                        SELECT
                            SUBSTR (KOPANG, 2, 1) GOL,
                            COUNT (NRK) JML
                        FROM
                            PERS_DUK_PANGKAT_HISTDUK
                        WHERE
                            SUBSTR (MASKER, 1, 2) IN ('11', '12', '13', '14', '15')
                        AND STAPEG = 1
                        AND thbl = '".$thbl."' $where
                        GROUP BY
                            SUBSTR (KOPANG, 2, 1)
                    ) D ON SUBSTR (A .KOPANG, 2, 1) = D .GOL
                    LEFT JOIN (
                        SELECT
                            SUBSTR (KOPANG, 2, 1) GOL,
                            COUNT (NRK) JML
                        FROM
                            PERS_DUK_PANGKAT_HISTDUK
                        WHERE
                            SUBSTR (MASKER, 1, 2) IN ('16', '17', '18', '19', '20')
                        AND STAPEG = 1
                        AND thbl = '".$thbl."' $where
                        GROUP BY
                            SUBSTR (KOPANG, 2, 1)
                    ) E ON SUBSTR (A .KOPANG, 2, 1) = E .GOL
                    LEFT JOIN (
                        SELECT
                            SUBSTR (KOPANG, 2, 1) GOL,
                            COUNT (NRK) JML
                        FROM
                            PERS_DUK_PANGKAT_HISTDUK
                        WHERE
                            SUBSTR (MASKER, 1, 2) IN ('21', '22', '23', '24', '25')
                        AND STAPEG = 1
                        AND thbl = '".$thbl."' $where
                        GROUP BY
                            SUBSTR (KOPANG, 2, 1)
                    ) F ON SUBSTR (A .KOPANG, 2, 1) = F.GOL
                    LEFT JOIN (
                        SELECT
                            SUBSTR (KOPANG, 2, 1) GOL,
                            COUNT (NRK) JML
                        FROM
                            PERS_DUK_PANGKAT_HISTDUK
                        WHERE
                            SUBSTR (MASKER, 1, 2) IN ('26', '27', '28', '29', '30')
                        AND STAPEG = 1
                        AND thbl = '".$thbl."' $where
                        GROUP BY
                            SUBSTR (KOPANG, 2, 1)
                    ) G ON SUBSTR (A .KOPANG, 2, 1) = G .GOL
                    LEFT JOIN (
                        SELECT
                            SUBSTR (KOPANG, 2, 1) GOL,
                            COUNT (NRK) JML
                        FROM
                            PERS_DUK_PANGKAT_HISTDUK
                        WHERE
                            SUBSTR (MASKER, 1, 2) IN ('31', '32', '33', '34', '35')
                        AND STAPEG = 1
                        AND thbl = '".$thbl."' $where
                        GROUP BY
                            SUBSTR (KOPANG, 2, 1)
                    ) H ON SUBSTR (A .KOPANG, 2, 1) = H .GOL
                    LEFT JOIN (
                        SELECT
                            SUBSTR (KOPANG, 2, 1) GOL,
                            COUNT (NRK) JML
                        FROM
                            PERS_DUK_PANGKAT_HISTDUK
                        WHERE
                            SUBSTR (MASKER, 1, 2) > 35
                        AND STAPEG = 1
                        AND thbl = '".$thbl."' $where
                        GROUP BY
                            SUBSTR (KOPANG, 2, 1)
                    ) I ON SUBSTR (A .KOPANG, 2, 1) = I.GOL
                    WHERE
                        A .THBL = '".$thbl."'
                    ORDER BY
                        SUBSTR (A .KOPANG, 2, 1) ASC";  
                            
        
        
        $query = $this->db->query($sql);

        $result = $query->result();
        return $result;
    }

    function getStatAgama($thbl,$spmu,$klogad)
    {
        $where='';
        if($spmu == '-' && ($klogad == '' || $klogad == '-'))
        {
            $where = " AND THBL = '$thbl' ";

        }
        else if($spmu!='-' && $klogad =='-' )
        {
            $where = " AND THBL = '$thbl' AND SPMU = '$spmu' ";
        }
        else
        {
            $where = " AND THBL = '$thbl' AND SPMU = '$spmu' AND KLOGAD = '$klogad' ";
        }
        
            $sql = "SELECT DISTINCT
                        SUBSTR (A .kopang, 2, 1) GOL,
                        NVL (B.JML, 0) ISLAM,
                        NVL (C.JML, 0) PROTESTAN,
                        NVL (D .JML, 0) KATOLIK,
                        NVL (E .JML, 0) HINDU,
                        NVL (F.JML, 0) BUDDHA,
                        NVL (G .JML, 0) KHONGHUCU,
                        (
                            NVL (B.JML, 0) + NVL (C.JML, 0) + NVL (D .JML, 0) + NVL (E .JML, 0) + NVL (F.JML, 0) + NVL (G .JML, 0)
                        ) JUMLAHTOTAL
                    FROM
                        PERS_DUK_PANGKAT_HISTDUK A
                    LEFT JOIN (
                        SELECT
                            SUBSTR (KOPANG, 2, 1) GOL,
                            COUNT (NRK) JML
                        FROM
                            PERS_DUK_PANGKAT_HISTDUK
                        WHERE
                            AGAMA = 1
                        AND STAPEG = 2
                        AND thbl = '".$thbl."' $where
                        GROUP BY
                            SUBSTR (KOPANG, 2, 1)
                    ) B ON SUBSTR (A .KOPANG, 2, 1) = B.GOL
                    LEFT JOIN (
                        SELECT
                            SUBSTR (KOPANG, 2, 1) GOL,
                            COUNT (NRK) JML
                        FROM
                            PERS_DUK_PANGKAT_HISTDUK
                        WHERE
                            AGAMA = 2
                        AND STAPEG = 2
                        AND thbl = '".$thbl."' $where
                        GROUP BY
                            SUBSTR (KOPANG, 2, 1)
                    ) C ON SUBSTR (A .KOPANG, 2, 1) = C.GOL
                    LEFT JOIN (
                        SELECT
                            SUBSTR (KOPANG, 2, 1) GOL,
                            COUNT (NRK) JML
                        FROM
                            PERS_DUK_PANGKAT_HISTDUK
                        WHERE
                            AGAMA = 3
                        AND STAPEG = 2
                        AND thbl = '".$thbl."' $where
                        GROUP BY
                            SUBSTR (KOPANG, 2, 1)
                    ) D ON SUBSTR (A .KOPANG, 2, 1) = D .GOL
                    LEFT JOIN (
                        SELECT
                            SUBSTR (KOPANG, 2, 1) GOL,
                            COUNT (NRK) JML
                        FROM
                            PERS_DUK_PANGKAT_HISTDUK
                        WHERE
                            AGAMA = 4
                        AND STAPEG = 2
                        AND thbl = '".$thbl."' $where
                        GROUP BY
                            SUBSTR (KOPANG, 2, 1)
                    ) E ON SUBSTR (A .KOPANG, 2, 1) = E .GOL
                    LEFT JOIN (
                        SELECT
                            SUBSTR (KOPANG, 2, 1) GOL,
                            COUNT (NRK) JML
                        FROM
                            PERS_DUK_PANGKAT_HISTDUK
                        WHERE
                            AGAMA = 5
                        AND STAPEG = 2
                        AND thbl = '".$thbl."' $where
                        GROUP BY
                            SUBSTR (KOPANG, 2, 1)
                    ) F ON SUBSTR (A .KOPANG, 2, 1) = F.GOL
                    LEFT JOIN (
                        SELECT
                            SUBSTR (KOPANG, 2, 1) GOL,
                            COUNT (NRK) JML
                        FROM
                            PERS_DUK_PANGKAT_HISTDUK
                        WHERE
                            AGAMA = 6
                        AND STAPEG = 2
                        AND thbl = '".$thbl."' $where
                        GROUP BY
                            SUBSTR (KOPANG, 2, 1)
                    ) G ON SUBSTR (A .KOPANG, 2, 1) = G .GOL
                    WHERE
                        A .THBL = '".$thbl."'
                    ORDER BY
                        SUBSTR (A .KOPANG, 2, 1) ASC";  
                            
        
        
        $query = $this->db->query($sql);

        $result = $query->result();
        return $result;
    }

    function getStatAgamacpns($thbl,$spmu,$klogad)
    {
        $where='';
        if($spmu == '-' && ($klogad == '' || $klogad == '-'))
        {
            $where = " AND THBL = '$thbl' ";

        }
        else if($spmu!='-' && $klogad =='-' )
        {
            $where = " AND THBL = '$thbl' AND SPMU = '$spmu' ";
        }
        else
        {
            $where = " AND THBL = '$thbl' AND SPMU = '$spmu' AND KLOGAD = '$klogad' ";
        }
        
            $sql = "SELECT DISTINCT
                        SUBSTR (A .kopang, 2, 1) GOL,
                        NVL (B.JML, 0) ISLAM,
                        NVL (C.JML, 0) PROTESTAN,
                        NVL (D .JML, 0) KATOLIK,
                        NVL (E .JML, 0) HINDU,
                        NVL (F.JML, 0) BUDDHA,
                        NVL (G .JML, 0) KHONGHUCU,
                        (
                            NVL (B.JML, 0) + NVL (C.JML, 0) + NVL (D .JML, 0) + NVL (E .JML, 0) + NVL (F.JML, 0) + NVL (G .JML, 0)
                        ) JUMLAHTOTAL
                    FROM
                        PERS_DUK_PANGKAT_HISTDUK A
                    LEFT JOIN (
                        SELECT
                            SUBSTR (KOPANG, 2, 1) GOL,
                            COUNT (NRK) JML
                        FROM
                            PERS_DUK_PANGKAT_HISTDUK
                        WHERE
                            AGAMA = 1
                        AND STAPEG = 1
                        AND thbl = '".$thbl."' $where
                        GROUP BY
                            SUBSTR (KOPANG, 2, 1)
                    ) B ON SUBSTR (A .KOPANG, 2, 1) = B.GOL
                    LEFT JOIN (
                        SELECT
                            SUBSTR (KOPANG, 2, 1) GOL,
                            COUNT (NRK) JML
                        FROM
                            PERS_DUK_PANGKAT_HISTDUK
                        WHERE
                            AGAMA = 2
                        AND STAPEG = 1
                        AND thbl = '".$thbl."' $where
                        GROUP BY
                            SUBSTR (KOPANG, 2, 1)
                    ) C ON SUBSTR (A .KOPANG, 2, 1) = C.GOL
                    LEFT JOIN (
                        SELECT
                            SUBSTR (KOPANG, 2, 1) GOL,
                            COUNT (NRK) JML
                        FROM
                            PERS_DUK_PANGKAT_HISTDUK
                        WHERE
                            AGAMA = 3
                        AND STAPEG = 1
                        AND thbl = '".$thbl."' $where
                        GROUP BY
                            SUBSTR (KOPANG, 2, 1)
                    ) D ON SUBSTR (A .KOPANG, 2, 1) = D .GOL
                    LEFT JOIN (
                        SELECT
                            SUBSTR (KOPANG, 2, 1) GOL,
                            COUNT (NRK) JML
                        FROM
                            PERS_DUK_PANGKAT_HISTDUK
                        WHERE
                            AGAMA = 4
                        AND STAPEG = 1
                        AND thbl = '".$thbl."' $where
                        GROUP BY
                            SUBSTR (KOPANG, 2, 1)
                    ) E ON SUBSTR (A .KOPANG, 2, 1) = E .GOL
                    LEFT JOIN (
                        SELECT
                            SUBSTR (KOPANG, 2, 1) GOL,
                            COUNT (NRK) JML
                        FROM
                            PERS_DUK_PANGKAT_HISTDUK
                        WHERE
                            AGAMA = 5
                        AND STAPEG = 1
                        AND thbl = '".$thbl."' $where
                        GROUP BY
                            SUBSTR (KOPANG, 2, 1)
                    ) F ON SUBSTR (A .KOPANG, 2, 1) = F.GOL
                    LEFT JOIN (
                        SELECT
                            SUBSTR (KOPANG, 2, 1) GOL,
                            COUNT (NRK) JML
                        FROM
                            PERS_DUK_PANGKAT_HISTDUK
                        WHERE
                            AGAMA = 6
                        AND STAPEG = 1
                        AND thbl = '".$thbl."' $where
                        GROUP BY
                            SUBSTR (KOPANG, 2, 1)
                    ) G ON SUBSTR (A .KOPANG, 2, 1) = G .GOL
                    WHERE
                        A .THBL = '".$thbl."'
                    ORDER BY
                        SUBSTR (A .KOPANG, 2, 1) ASC";  
                            
        
        
        $query = $this->db->query($sql);

        $result = $query->result();
        return $result;
    }

    public function getStatTMTPensiunYAD($thbl,$spmu,$klogad)
    {

        if($spmu == '-' && ($klogad == '' || $klogad == '-'))
        {
            $sql = "SELECT TO_CHAR(TMTPENSIUNYAD,'YYYY')TAHUNPENSIUN,COUNT(NRK)JUMLAHTOTAL FROM PERS_DUK_PANGKAT_HISTDUK
                WHERE THBL='".$thbl."' AND TO_CHAR(TMTPENSIUNYAD,'YYYY') IN (TO_CHAR(SYSDATE,'YYYY') , TO_CHAR(SYSDATE,'YYYY')+1, TO_CHAR(SYSDATE,'YYYY')+2, TO_CHAR(SYSDATE,'YYYY') +3, TO_CHAR(SYSDATE,'YYYY') +4, TO_CHAR(SYSDATE,'YYYY')+5)
                GROUP BY TO_CHAR(TMTPENSIUNYAD,'YYYY') ORDER BY TO_CHAR(TMTPENSIUNYAD,'YYYY') ASC";  
        }
        else if($spmu!='-' && ($klogad == '' || $klogad == '-') )
        {
            $sql = "SELECT TO_CHAR(TMTPENSIUNYAD,'YYYY')TAHUNPENSIUN,COUNT(NRK)JUMLAHTOTAL FROM PERS_DUK_PANGKAT_HISTDUK
                WHERE THBL='".$thbl."' AND SPMU = '".$spmu."' AND TO_CHAR(TMTPENSIUNYAD,'YYYY') IN (TO_CHAR(SYSDATE,'YYYY') , TO_CHAR(SYSDATE,'YYYY')+1, TO_CHAR(SYSDATE,'YYYY')+2, TO_CHAR(SYSDATE,'YYYY') +3, TO_CHAR(SYSDATE,'YYYY') +4, TO_CHAR(SYSDATE,'YYYY')+5)
                GROUP BY TO_CHAR(TMTPENSIUNYAD,'YYYY') ORDER BY TO_CHAR(TMTPENSIUNYAD,'YYYY') ASC";  
                
        }
        else
        {
            $sql = "SELECT TO_CHAR(TMTPENSIUNYAD,'YYYY')TAHUNPENSIUN,COUNT(NRK)JUMLAHTOTAL FROM PERS_DUK_PANGKAT_HISTDUK
                WHERE THBL='".$thbl."' AND SPMU = '".$spmu."' AND KLOGAD='".$klogad."' AND TO_CHAR(TMTPENSIUNYAD,'YYYY') IN (TO_CHAR(SYSDATE,'YYYY') , TO_CHAR(SYSDATE,'YYYY')+1, TO_CHAR(SYSDATE,'YYYY')+2, TO_CHAR(SYSDATE,'YYYY') +3, TO_CHAR(SYSDATE,'YYYY') +4, TO_CHAR(SYSDATE,'YYYY')+5)
                GROUP BY TO_CHAR(TMTPENSIUNYAD,'YYYY') ORDER BY TO_CHAR(TMTPENSIUNYAD,'YYYY') ASC";  
        }
        

        $query = $this->db->query($sql);

        $result = $query->result();
        return $result;
    }
}

?>
