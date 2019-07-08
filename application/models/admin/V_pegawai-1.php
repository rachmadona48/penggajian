<?php
 class V_pegawai extends CI_Model {

    var $title   = '';
    var $content = '';
    var $date    = '';

    function __construct()
    {        
        parent::__construct();

        // Koneksi ke database
        //$this->conn = oci_connect('simpegdev', 'simpegdev', '10.15.3.74:1521/dbpemerintah');
    }

    function getAutoCom($search)
    {
        $sql = "SELECT NRK FROM PERS_PEGAWAI1
                WHERE NRK LIKE '$search%' AND nrk NOT IN (25310) AND ROWNUM < 6";
        $query = $this->db->query($sql)->result();

        return $query;
    }

    function getAutoCom2($search)
    {
        $sql = "SELECT *
                FROM
                    (
                        SELECT DISTINCT
                            RTRIM(NAMA) NAMA
                        FROM
                            PERS_PEGAWAI1
                        WHERE
                            NAMA  LIKE UPPER('$search%')
                    )
                WHERE
                    ROWNUM < 6
                ";
                
        $query = $this->db->query($sql)->result();

        return $query;
    }

    function getAutoCom3($search)
    {
        $sql = "SELECT NIP FROM PERS_PEGAWAI1
                WHERE NIP LIKE '%$search%' AND nrk NOT IN (000000000) AND ROWNUM < 6";
        $query = $this->db->query($sql)->result();

        return $query;
    }

    function getAutoCom4($search)
    {
        $sql = "SELECT NIP18 FROM PERS_PEGAWAI1
                WHERE NIP18 LIKE '%$search%' AND nrk NOT IN (000000000000000000) AND ROWNUM < 6";
        $query = $this->db->query($sql)->result();

        return $query;
    }

     function getNewNRK()
     {

         $sql = "SELECT NRK  FROM PERS_PEGAWAI1 P1
                WHERE NRK < 800000 AND ROWNUM <=1
                ORDER BY NRK DESC";
         $rs = $this->db->query($sql)->row();
         $autono=($rs)?$rs->NRK+1:1;
         $newNRK = str_pad($autono, 6, "0", STR_PAD_LEFT);

         return $newNRK;
     }

     function generateNRK()
     {
        //$sql = "SELECT max(nrk)NRKLAST from pers_pegawai1 where nrk<193366 and nrk not in(25310)";
        $sql = "SELECT MAX (NRK) NRKLAST FROM PERS_PEGAWAI1
                WHERE NRK < 999999
                AND NRK NOT IN (25310,199412,999000,885649,805171,666666,611722,576008,555555,537176,470045,441138,435023,412002,409579,376263,353515,
                333333,321095,317668,266407,250204,222222,217208,200558,199412
                )";
        $queSql = $this->db->query($sql)->row();
        $newnrk;
        if($queSql->NRKLAST == '199411' || $queSql->NRKLAST == '200557' || $queSql->NRKLAST == '217207' || $queSql->NRKLAST == '222221' || $queSql->NRKLAST == '250203' || $queSql->NRKLAST=='266406' || $queSql->NRKLAST =='317667' || $queSql->NRKLAST == '321094' || $queSql->NRKLAST == '333332' || $queSql->NRKLAST == '353514' || $queSql->NRKLAST =='376262' || $queSql->NRKLAST == '409578' || $queSql->NRKLAST == '412001' || $queSql->NRKLAST == '435022' || $queSql->NRKLAST == '441137' || $queSql->NRKLAST == '470044' || $queSql->NRKLAST == '537175' || $queSql->NRKLAST == '555554' || $queSql->NRKLAST=='576007' || $queSql->NRKLAST == '611721' || $queSql->NRKLAST =='666665' || $queSql->NRKLAST == '805170' || $queSql->NRKLAST == '885648' || $queSql->NRKLAST == '998999')
        {
            $newnrk = $queSql->NRKLAST + 2;
        }
        else 
        {
            $newnrk = $queSql->NRKLAST + 1;
        }
        $valNRK = str_pad($newnrk, 6, "0", STR_PAD_LEFT);

        return $valNRK;
     }

     public function getSpmu($klogad="")
     {
         $sql = "SELECT SPMU
                FROM PERS_KLOGAD3
                 WHERE KOLOK='$klogad'
                 AND ROWNUM <=1
                ORDER BY SPMU ASC
                ";

         $rs = $this->db->query($sql)->row();
         if ($rs){
             return $rs->SPMU;
         } else {
             return '';
         }


     }

     public function getKetSpmu($klogad="")
     {
         $sql = "SELECT B.NAMA
                 FROM PERS_KLOGAD3 A
                 LEFT JOIN PERS_TABEL_SPMU B
                 ON A.SPMU=B.KODE_SPM
                 WHERE KOLOK='$klogad'
                 AND ROWNUM <=1
                ORDER BY SPMU ASC

                ";

         $rs = $this->db->query($sql)->row();
         if ($rs){
             return $rs->NAMA;
         } else {
             return '';
         }

     }

     public function getKeteranganSpmu($spmu="")
     {
         $sql = "SELECT NAMA
                 FROM PERS_TABEL_SPMU 
                 WHERE KODE_SPM='$spmu'
                ";

         $rs = $this->db->query($sql)->row();
         if ($rs){
             return $rs->NAMA;
         } else {
             return '';
         }

     }

    function get_data($nrk) {
        $sql = "SELECT
                B.*, A.NRK,
                A .NIP,
                A .KLOGAD,
                A .NAMA,
                A .TITEL,
                A .PATHIR,
                TO_CHAR (A.TALHIR, 'DD-MM-YYYY') TALHIR,
                A .AGAMA,
                A .JENKEL,
                A .STAWIN,
                A .STAPEG,
                A .JENPEG,
                A .INDUK,
                TO_CHAR (A.MUANG, 'DD-MM-YYYY') MUANG,
                A .MPP,
                TO_CHAR (A.TMT_STAPEG, 'DD-MM-YYYY') TMT_STAPEG,
                A .USER_ID,
                A .TERM,
                TO_CHAR(A.TG_UPD,'DD-MM-YYYY HH24:MI:SS')TG_UPD,
                A .NIP18,
                TO_CHAR (A .TMTPENSIUN, 'DD-MM-YYYY') TMTPENSIUN,
                A .KDMATI,
                TO_CHAR (A .TGLAMPP, 'DD-MM-YYYY') TGLAMPP,
                TO_CHAR (A .TGLEMPP, 'DD-MM-YYYY') TGLEMPP,
                A .X_PHOTO,
                A .PINDAHAN,
                TO_CHAR (A .TMTPINDAH, 'DD-MM-YYYY') TMTPINDAH,
                A .KOLOK,
                A .KOJAB,
                A .TITELDEPAN,
                A .KD,
                A .SPMU,
                TO_CHAR (A .TGMATI, 'DD-MM-YYYY') TGMATI
            FROM
                PERS_PEGAWAI1 A
            LEFT JOIN PERS_PEGAWAI2 B ON B.NRK = A .NRK
            WHERE
                A .NRK = '$nrk'";

        $query = $this->db->query($sql);
        return $query;
    }

    function get_data_v2($nrk) {
        $sql = "SELECT B.NRK, B.NAMA, B.NIP, B.NIP18, A.KOLOK, A.NALOKL, A.KOJAB, A.NAJABL, A.KOLOK AS KLOGAD, A.KD, A.SPMU, B.JENPEG, B.AGAMA, B.STAWIN,
               B.STAPEG, C.ALAMAT, C.KOWIL, C.KOCAM, C.KOKEL, C.PROP, C.JENDIKCPS, C.KODIKCPS, C.RT, C.RW, TO_CHAR(B.TMT_STAPEG,'DD-MM-YYYY') AS TMT_STAPEG, 
               TO_CHAR(B.MUANG,'DD-MM-YYYY') AS MUANG, B.PATHIR, TO_CHAR(B.TALHIR,'DD-MM-YYYY') AS TALHIR, B.PINDAHAN, TO_CHAR(B.TMTPINDAH, 'DD-MM-YYYY') AS TMTPINDAH, 
               B.MPP, TO_CHAR(B.TGLAMPP, 'DD-MM-YYYY') AS TGLAMPP, TO_CHAR(B.TGLEMPP, 'DD-MM-YYYY') AS TGLEMPP, C.KARPEG, C.TASPEN, C.NOPPEN, C.NOKK, C.NPWP, C.NIPPASIF, 
               C.KARSU, B.JENKEL, C.DARAH, C.NOTELP, C.EMAIL, B.NOIJAZAH, B.FLAG, B.KDMATI, TO_CHAR(B.TGMATI, 'DD-MM-YYYY') AS TGMATI
               FROM PERS_PEGAWAI1 B 
               LEFT JOIN \"vw_jabatan_terakhir\" A ON B.NRK = A.NRK
               LEFT JOIN PERS_PEGAWAI2 C ON B.NRK = C.NRK
               WHERE B.NRK = '".$nrk."'";

        $query = $this->db->query($sql);
        return $query;
    }

    function getKolok()
    {
        $session_data = $this->session->userdata('logged_in');

        $wh_bkdk3 = '';
        $rs = '';
        //untuk bkd k3
        if ($session_data['user_group'] == '10')
        {
            if ($session_data['kowil'] == '1')
            {
                $wh_bkdk3 = " AND kolok LIKE '".$session_data['kowil']."%' AND SUBSTR(kolok,2,1) != '1'";
            }
            else if ($session_data['kowil'] == '11')
            {
                $wh_bkdk3 = " AND kolok LIKE '".$session_data['kowil']."%' AND SUBSTR(kolok,2,1) = '1'";
            }
            else if ($session_data['kowil'] == '')
            {
                $wh_bkdk3 = " AND 2=2";
            }
            else
            {
                $wh_bkdk3 = " AND kolok LIKE '".$session_data['kowil']."%'";
            }
            //$wh_bkdk3=" AND kolok LIKE '".$session_data['kowil']."%'";    

            $q  = "SELECT DISTINCT nalokl 
                    FROM  pers_lokasi_tbl 
                    WHERE (NALOKL != '.' AND AKTIF = '1')           
                    ".$wh_bkdk3." 
                    ORDER BY nalokl";

            $rs = $this->db->query($q)->result();
        }
        //untuk ukpd
        else if ($session_data['user_group'] == '47')
        {
            $username = $session_data['id'];
            
            $cekkolok = "SELECT a.kolok,a.nalok,a.spmu,a.kode_unit_sipkd,b.\"user_id\" 
                        from pers_klogad3 a
                        LEFT JOIN \"master_user\" b on a.kode_unit_sipkd = b.\"user_id\" 
                        where b.\"user_id\" = '$username'";

            $querycekkolok = $this->db->query($cekkolok);

            $num = $querycekkolok->num_rows();

            if ($num == '1') 
            {
                $reskolok = $querycekkolok->row()->KOLOK;
                $wh_bkdk3 = " AND kolok = '$reskolok'";   
            }
            else
            {
                $cekkoloknonsipkd = "SELECT a.kolok,a.nalok,a.spmu,a.kode_unit_sipkd,b.\"user_id\" 
                                    from pers_klogad3 a
                                    LEFT JOIN \"master_user\" b on a.kolok = b.\"user_id\" 
                                    where b.\"user_id\" ='$username'";
									
                $querycekkoloknonsipkd = $this->db->query($cekkoloknonsipkd);
                $numkolok = $querycekkoloknonsipkd->num_rows();

                if ($numkolok == '1')
                {
                    $reskolok = $querycekkoloknonsipkd->row()->KOLOK;
                    $wh_bkdk3 = " AND kolok = '$reskolok'";  
                }
                else
                {
                    $reskolok = '';
                    $wh_bkdk3 = " AND kolok ='12345'";
                }                
            }

            $q = "SELECT * FROM (SELECT DISTINCT nalokl 
                FROM  pers_lokasi_tbl 
                WHERE (NALOKL != '.' AND AKTIF='1') 
            
                ".$wh_bkdk3." 
                ORDER BY nalokl )
                UNION 
                (SELECT NALOK_SKL NALOKL FROM UNIT_DISDIK WHERE KOLOK_SUDIN ='$reskolok')
                ";

            $rs = $this->db->query($q)->result();
        }
        //untuk skpd
        else if($session_data['user_group'] == '5')
        {
            $username = $session_data['id'];

            $getspmu = "SELECT * FROM PERS_TABEL_SPMU WHERE KODE_UNIT_SIPKD ='$username'";
            
            //$querygetspmu = $this->prod->query($getspmu);
              $querygetspmu = $this->db->query($getspmu);
            $numspm = $querygetspmu->num_rows();

            
            if($numspm == '1')
            {
                $spmu = $querygetspmu->row()->KODE_SPM;

                $getukpd = "SELECT DISTINCT NALOK AS NALOKL FROM PERS_KLOGAD3 WHERE SPMU='$spmu' ORDER BY NALOKL ASC ";
                
                //$rs = $this->prod->query($getukpd)->result();
                $rs = $this->db->query($getukpd)->result();
            }
            else if($numspm >1)
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
                
                
                $getukpd = "SELECT DISTINCT NALOK AS NALOKL FROM PERS_KLOGAD3 WHERE SPMU IN (".$quewh.") ORDER BY NALOKL";
               
                //$rs = $this->prod->query($getukpd)->result();
                $rs = $this->db->query($getukpd)->result();
            }

        }
       
        else
        {
            $q="SELECT DISTINCT nalokl 
            FROM  pers_lokasi_tbl 
            WHERE (NALOKL != '.' AND AKTIF='1') 
           
            ".$wh_bkdk3." 
            ORDER BY nalokl";
            $rs = $this->db->query($q)->result();
        }
        
        


        return $rs;
    }

    function getSPMUSKP()
    {
        $sql = "SELECT A.*, B.NAMA FROM(
                select distinct P1.spmu from PERS_PEGAWAI1 P1 
                where (P1.kdmati <> 'Y' OR P1.KDMATI IS NULL) AND P1.KLOGAD NOT LIKE '1111111%' AND P1.NRK < 999999
                AND P1.NRK NOT IN (25310,199412,999000,885649,805171,666666,611722,576008,555555,537176,470045,441138,435023,412002,409579,376263,353515,
                333333,321095,317668,266407,250204,222222,217208,200558,199412
                ) AND P1.SPMU IS NOT NULL 
            )A
            INNER JOIN PERS_TABEL_SPMU B ON A.SPMU = B.KODE_SPM
            ORDER BY B.NAMA ASC";

        $query = $this->db->query($sql)->result();
        //$query = $this->prod->query($sql)->result();

        return $query;
    }

    function getKolokFromSPMU($spm)
    {
        if($spm=='C041')
        {
            $q="SELECT * FROM 
                (
                    select * from 
                    (
                        SELECT A .kolok, A .nalok FROM pers_klogad3 A
                        LEFT JOIN \"master_user\" b ON A .kode_unit_sipkd = b.\"user_id\" 
                        WHERE A.AKTIF='1' AND A.SPMU='$spm'
                    ) X
                    UNION
                    (select kolok,nalok_skl as nalok from unit_disdik)
                )
            
            ORDER BY nalok ASC";
        }
        else
        {
            $q="SELECT * FROM 
                (
                    select * from 
                    (
                        SELECT A .kolok, A .nalok FROM pers_klogad3 A
                        LEFT JOIN \"master_user\" b ON A .kode_unit_sipkd = b.\"user_id\" 
                        WHERE A.AKTIF='1' AND A.SPMU='$spm'
                    ) X
                    
                )
            
            ORDER BY nalok ASC";
        }
        
        $query = $this->db->query($q);
        //$query = $this->prod->query($q);
        $option  = "";
        $option .= "<option value='all'>-Pilih Semua-</option>";
        foreach($query->result() as $row){
                      
                $option .= "<option value='".$row->NALOK."'>".$row->NALOK."</option>";
            
        }
        return $option;

    }

    function getKolokSKP(){
        $session_data       = $this->session->userdata('logged_in');

        $wh_bkdk3='';
        $rs='';
        //untuk bkd k3
        if($session_data['user_group'] == '10')
        {
            if($session_data['kowil']=='1')
            {
                $wh_bkdk3=" AND kolok LIKE '".$session_data['kowil']."%' AND substr(kolok,2,1)!='1'";
            }
            else if($session_data['kowil']=='11')
            {
                $wh_bkdk3=" AND kolok LIKE '".$session_data['kowil']."%' and substr(kolok,2,1)='1'";
            }
            else if($session_data['kowil']=='')
            {
                $wh_bkdk3=" AND 2=2";
            }
            else
            {
                $wh_bkdk3=" AND kolok LIKE '".$session_data['kowil']."%'";
            }
            //$wh_bkdk3=" AND kolok LIKE '".$session_data['kowil']."%'";    

            $q="SELECT * FROM ( select * from ( SELECT A .kolok, A .nalok FROM pers_klogad3 A INNER JOIN \"master_user\" b ON A .kode_unit_sipkd = b.\"user_id\" ) X UNION (select kolok,nalok_skl as nalok from unit_disdik) ) WHERE 2=2
           
            ".$wh_bkdk3." 
            ORDER BY nalok";
            
            $rs = $this->db->query($q)->result();
        }
        //untuk ukpd
        else if($session_data['user_group']=='47')
        {
            $username = $session_data['id'];

            
            $cekkolok = "SELECT a.kolok,a.nalok,a.spmu,a.kode_unit_sipkd,b.\"user_id\" 
                        from pers_klogad3 a
                        LEFT JOIN \"master_user\" b on a.kode_unit_sipkd = b.\"user_id\" 
                        where b.\"user_id\" = '$username'";

            $querycekkolok = $this->db->query($cekkolok);

            $num = $querycekkolok->num_rows();

            if($num == '1') 
            {
                $reskolok=$querycekkolok->row()->KOLOK;
                $wh_bkdk3=" AND kolok = '$reskolok'";   
            }
            else
            {
                $reskolok='';
                $wh_bkdk3 =" AND kolok ='12345'";
            }

            $q="(SELECT
                    A .kolok,
                    A .nalok
                FROM
                    pers_klogad3 A
                INNER JOIN \"master_user\" b ON A .kode_unit_sipkd = b.\"user_id\"
                WHERE 2=2 
            ".$wh_bkdk3." 
            )
            UNION 
            (SELECT kolok,nalok_skl as nalok FROM UNIT_DISDIK WHERE KOLOK_SUDIN ='$reskolok')
            ORDER BY NALOK ASC
            ";

            
            $rs = $this->db->query($q)->result();
        }
        //untuk skpd
        else if($session_data['user_group'] == '5')
        {
            $username = $session_data['id'];

            $getspmu = "SELECT * FROM PERS_TABEL_SPMU WHERE KODE_UNIT_SIPKD ='$username'";
            
            //$querygetspmu = $this->prod->query($getspmu);
              $querygetspmu = $this->db->query($getspmu);
            $numspm = $querygetspmu->num_rows();

            
            if($numspm == '1')
            {
                $spmu = $querygetspmu->row()->KODE_SPM;

                $getukpd = "SELECT KOLOK,NALOK FROM PERS_KLOGAD3 WHERE SPMU='$spmu' ORDER BY NALOK ASC ";
                
                //$rs = $this->prod->query($getukpd)->result();
                $rs = $this->db->query($getukpd)->result();
            }
            else if($numspm >1)
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
                
                
                $getukpd = " SELECT KOLOK,NALOK FROM PERS_KLOGAD3 A
                                INNER JOIN \"master_user\" b ON A .kode_unit_sipkd = b.\"user_id\"
                            WHERE SPMU IN (".$quewh.")
                            UNION
                            (
                                SELECT kolok,nalok_skl AS nalok FROM unit_disdik
                            )
                            ORDER BY NALOK ASC";
               
                //$rs = $this->prod->query($getukpd)->result();
                $rs = $this->db->query($getukpd)->result();
            }

        }
        else if($session_data['user_group'] == '2' || $session_data['user_group'] == '26')
        {
            
            $q="SELECT * FROM 
                (
                    select * from 
                    (
                        SELECT A .kolok, A .nalok FROM pers_klogad3 A
                        LEFT JOIN \"master_user\" b ON A .kode_unit_sipkd = b.\"user_id\" 
                        WHERE A.AKTIF='1'
                    ) X
                    UNION
                    (select kolok,nalok_skl as nalok from unit_disdik)
                )
            
            ORDER BY nalok ASC";
            
            $rs = $this->db->query($q)->result();
        }
        
        


        return $rs;
    }

     function getAll($kolok='', $thbl=''){
         $q = "SELECT pers_kojab_tbl.najabl, pers_duk_pangkat_histduk.nrk, pers_duk_pangkat_histduk.nama,
                      pers_duk_pangkat_histduk.pathir, pers_duk_pangkat_histduk.talhir, pers_duk_pangkat_histduk.eselon,
                      pers_duk_pangkat_histduk.kopang
                  FROM  pers_duk_pangkat_histduk LEFT OUTER JOIN
                              pers_kojab_tbl ON pers_duk_pangkat_histduk.kolok = pers_kojab_tbl.kolok AND
                              pers_duk_pangkat_histduk.kojab = pers_kojab_tbl.kojab
                  WHERE     (pers_duk_pangkat_histduk.klogad = '$kolok' and pers_duk_pangkat_histduk.thbl = '$thbl')
                  ORDER BY pers_duk_pangkat_histduk.klogad, pers_duk_pangkat_histduk.kojab, pers_duk_pangkat_histduk.eselon,
                      pers_duk_pangkat_histduk.kopang, pers_duk_pangkat_histduk.thbl";
         $rs = $this->db->query($q)->result();

         return $rs;
     }

    function getListJenpeg($jenpeg="") {
        $sql = "SELECT JENPEG, KETERANGAN FROM PERS_JENPEG_RPT WHERE JENPEG = 1 OR JENPEG = 6 ORDER BY JENPEG";
        $id = $this->db->query($sql);

        $option = "";
        foreach($id->result() as $row){
            if($jenpeg == $row->JENPEG){
                $option .= "<option selected value='".$row->JENPEG."'>".$row->JENPEG." - ".$row->KETERANGAN."</option>";
            }else{
                $option .= "<option value='".$row->JENPEG."'>".$row->JENPEG." - ".$row->KETERANGAN."</option>";
            }
        }

        return $option;
    }

    function getListJenpegAll($jenpeg="") {
        $sql = "SELECT JENPEG, KETERANGAN FROM PERS_JENPEG_RPT ORDER BY JENPEG";
        $id  = $this->db->query($sql);

        $option = "";
        foreach($id->result() as $row){
            if($jenpeg == $row->JENPEG){
                $option .= "<option selected value='".$row->JENPEG."'>".$row->JENPEG." - ".$row->KETERANGAN."</option>";
            }else{
                $option .= "<option value='".$row->JENPEG."'>".$row->JENPEG." - ".$row->KETERANGAN."</option>";
            }
        }

        return $option;
    }

    function getListInduk($induk="") {
        $sql = "SELECT INDUK, NAMA_DEPT FROM PERS_INDUK_TBL";
        $id  = $this->db->query($sql);

        $option = "";
        foreach($id->result() as $row){
            if($induk == $row->INDUK){
                $option .= "<option selected value='".$row->INDUK."'>".$row->INDUK." - ".$row->NAMA_DEPT."</option>";
            }else{
                $option .= "<option value='".$row->INDUK."'>".$row->INDUK." - ".$row->NAMA_DEPT."</option>";
            }
        }

        return $option;
    }

    function getListAgama($agama="") {
        $sql = "SELECT AGAMA, KETERANGAN FROM PERS_AGAMA_RPT";
        $id  = $this->db->query($sql);

        $option = "";
        foreach($id->result() as $row){
            if($agama == $row->AGAMA){
                $option .= "<option selected value='".$row->AGAMA."'>".$row->AGAMA." - ".$row->KETERANGAN."</option>";
            }else{
                $option .= "<option value='".$row->AGAMA."'>".$row->AGAMA." - ".$row->KETERANGAN."</option>";
            }
        }

        return $option;
    }    

    function getListStawin($stawin="") {
        $sql = "SELECT STAWIN, KETERANGAN FROM PERS_STAWIN_RPT";
        $id  = $this->db->query($sql);

        $option = "";
        foreach($id->result() as $row){
            if($stawin == $row->STAWIN){
                $option .= "<option selected value='".$row->STAWIN."'>".$row->STAWIN." - ".$row->KETERANGAN."</option>";
            }else{
                $option .= "<option value='".$row->STAWIN."'>".$row->STAWIN." - ".$row->KETERANGAN."</option>";
            }
        }

        return $option;
    }

    function getListStapeg($stapeg="") {
        $sql = "SELECT STAPEG, KETERANGAN FROM PERS_STAPEG_RPT WHERE STAPEG IN ('1','2')";
        $id  = $this->db->query($sql);

        $option = "";
        foreach($id->result() as $row){
            if($stapeg == $row->STAPEG){
                $option .= "<option selected value='".$row->STAPEG."'>".$row->STAPEG." - ".$row->KETERANGAN."</option>";
            }else{
                $option .= "<option value='".$row->STAPEG."'>".$row->STAPEG." - ".$row->KETERANGAN."</option>";
            }
        }

        return $option;
    }

    function getListKowil($kowil="",$prop="") {
        $sql = "SELECT KODE AS KOWIL, NAMA AS NAWIL 
               FROM LOKASI
               WHERE KODE LIKE '".substr($prop, 0, 3)."%'";
        $id = $this->db->query($sql);

        $option = "";
        foreach($id->result() as $row){
            if($kowil == $row->KOWIL){
                $option .= "<option selected value='".$row->KOWIL."'>".$row->NAWIL."</option>";
            }else{
                $option .= "<option value='".$row->KOWIL."'>".$row->NAWIL."</option>";
            }
        }

        return $option;
    }

    function getListKocam($kocam="",$kowil="") {
        $sql = "SELECT KODE AS KOCAM, NAMA AS NACAM 
               FROM LOKASI 
               WHERE KODE LIKE '".substr($kowil,0,6)."%' ";
        $id = $this->db->query($sql);

        $option = "";
        foreach($id->result() as $row){
            if($kocam == $row->KOCAM){
                $option .= "<option selected value='".$row->KOCAM."'>".$row->NACAM."</option>";
            }else{
                $option .= "<option value='".$row->KOCAM."'>".$row->NACAM."</option>";
            }
        }

        return $option;
    }
     
    function getListKokel($kokel="",$kowil="",$kocam="") {
        $sql = "SELECT KODE AS KOKEL, NAMA AS NAKEL 
               FROM LOKASI 
               WHERE KODE LIKE '".substr($kocam,0,9)."%' ";
        $id = $this->db->query($sql);

        $option = "";
        foreach($id->result() as $row){
            if($kokel == $row->KOKEL){
                $option .= "<option selected value='".$row->KOKEL."'>".$row->KOKEL." - ".$row->NAKEL."</option>";
            }else{
                $option .= "<option value='".$row->KOKEL."'>".$row->KOKEL." - ".$row->NAKEL."</option>";
            }
        }

        return $option;
    }
     
    function getListProp($prop="") {
        $sql = "SELECT KODE AS PROP, NAMA AS KETERANGAN 
               FROM LOKASI 
               WHERE KODE LIKE '%.00.00.0000'
               ORDER BY NAMA";
        $id = $this->db->query($sql);

        $option = "";
        foreach($id->result() as $row){
            if($prop == $row->PROP){
                $option .= "<option selected value='".$row->PROP."'>".$row->KETERANGAN."</option>";
            }else{
                $option .= "<option value='".$row->PROP."'>".$row->KETERANGAN."</option>";
            }
        }

        return $option;
    }

    function getValLokasi($prop="") {
        $sql = "SELECT KODE AS PROP, NAMA AS KETERANGAN 
               FROM LOKASI 
               WHERE KODE = '$prop'
               ORDER BY NAMA";
        $row = $this->db->query($sql)->row();

        $option = "";
        if (isset($row)){
           $option .= "<option value='".$row->PROP."' selected='selected'>".$row->KETERANGAN."</option>";
        } else {
           $option .= "<option value='' selected='selected'></option>";
        }

        return $option;
    }    

    function getListJendikcps($jendikcps="") {
        $sql = "SELECT JENDIK, KETERANGAN FROM PERS_JENDIK_RPT WHERE JENDIK='1'";
        $id  = $this->db->query($sql);

        $option = "";
        foreach($id->result() as $row){
            if($jendikcps == $row->JENDIK){
                $option .= "<option selected value='".$row->JENDIK."'>".$row->JENDIK." - ".$row->KETERANGAN."</option>";
            }else if($row->JENDIK == '1') {
                $option .= "<option selected value='" . $row->JENDIK . "'>" . $row->JENDIK . " - " . $row->KETERANGAN . "</option>";
            } else {
                $option .= "<option value='".$row->JENDIK."'>".$row->JENDIK." - ".$row->KETERANGAN."</option>";
            }
        }

        return $option;
    }

    function getListKodikcps($kodikcps=""){
        $sql = "SELECT KODIK, NADIK FROM PERS_PDIDIKAN_TBL WHERE JENDIK = '1'";
        $id = $this->db->query($sql);

        $option = "";
        foreach($id->result() as $row){
            if($kodikcps == $row->KODIK){
                $option .= "<option selected value='".$row->KODIK."'>".$row->KODIK." - ".$row->NADIK."</option>";
            }else{
                $option .= "<option value='".$row->KODIK."'>".$row->KODIK." - ".$row->NADIK."</option>";
            }
        }

        return $option;
    }

    function cekAdaNRK($nrk) {
        $q = "SELECT nrk FROM pers_pegawai1 WHERE nrk='$nrk'";
        $rs = $this->db->query($q)->result();

       if ($rs) {
           return 'ada';
       } else {
           return 'tidak ada';
       }


    }

     function insertData($data,$upload){
         $nrk = $data['nrk'];

         $nip = $data['nip'];
         $nip18 = $data['nip18'];

         $tmt_stapeg = $data['tmt_stapeg'];
         //$klogad = $data['klogad'];
         $klogad = '';
         $jenpeg = $data['jenpeg'];
         $tmttitipan = $data['tmttitipan'];
         $kklogad = $data['kklogad'];

         //Induk di Hardcode saja
         //$induk = $data['induk'];
         $induk = '00';

         //$nama = $data['nama'];
         $nama = str_replace("'","`",$data['nama']);
         $muang = $data['muang'];
         $titel = $data['titel'];
         //$notunggu = $data['notunggu'];
         $notunggu = '';
         $pathir = $data['pathir'];

         //$tgtunggu = $data['tgtunggu'];
         $tgtunggu = '';
         $talhir = $data['talhir'];
         //$tgakhtung = $data['tgakhtung'];
         $tgakhtung = '';
         $agama = $data['agama'];

         //$tbhttmas = $data['tbhttmas'];
         $tbhttmas = 0;
         $jenkel = $data['jenkel'];
         //$tbhbbmas = $data['tbhbbmas'];
         $tbhbbmas = '0';
         //$stawin = $data['stawin'];
         $stawin = '0';
         //$tunda = $data['tunda'];
         $tunda = 0;
         $stapeg = $data['stapeg'];
         $pindahan = $data['pindahan'];
         $tmtpindah = $data['tmtpindah'];
         $mpp = $data['mpp'];
         $tglampp = $data['tglampp'];
         $tglempp = $data['tglempp'];
         $noijazah = $data['noijazah'];

         $flag = $data['flag'];
         $tgmati = $data['tgmati'];
         $tmtpensiun='';
         if ($tgmati==''){
             $kdmati = "T";
         } else {
             $kdmati = "Y";
             $tmtpensiun = $tgmati;
         }

//         $kolok = $data['kolok'];
//         $kojab = $data['kojab'];
//         $spmu = $data['spmu'];
         $kolok = '';
         $kojab = '';
         $spmu = '';

         $user_id = $data['user_id'];
         $term = $this->input->ip_address();

         $q = "INSERT INTO pers_pegawai1(nrk,nip,nip18,klogad,kklogad,
                  nama,titel,pathir,talhir,agama,jenkel,stawin,
                  stapeg,jenpeg,tmttitipan,induk,tmt_stapeg,muang,
                  tglampp,tglempp,
                  tbhttmas,tbhbbmas,tunda,pindahan,tmtpindah,mpp,noijazah,
                  kdmati, tgmati,tmtpensiun,kolok,kojab,spmu,
                  user_id,term,tg_upd,x_photo)
                VALUES ('$nrk','$nip','$nip18','$klogad','$kklogad',
                  UPPER('$nama'),UPPER('$titel'),UPPER('$pathir'),TO_DATE('$talhir', 'DD-MM-YYYY'),'$agama','$jenkel','$stawin',
                  '$stapeg','$jenpeg',TO_DATE('$tmttitipan', 'DD-MM-YYYY'),'$induk',TO_DATE('$tmt_stapeg', 'DD-MM-YYYY'),TO_DATE('$muang', 'DD-MM-YYYY'),
                  TO_DATE('$tglampp', 'DD-MM-YYYY'),TO_DATE('$tglempp', 'DD-MM-YYYY'),
                   '$tbhttmas','$tbhbbmas','$tunda','$pindahan',TO_DATE('$tmtpindah', 'DD-MM-YYYY'),'$mpp','$noijazah',
                   '$kdmati', TO_DATE('$tgmati', 'DD-MM-YYYY'),TO_DATE('$tmtpensiun', 'DD-MM-YYYY'),'$kolok','$kojab','$spmu',
                   '$user_id','$term', SYSDATE, '')";

         $id = $this->db->query($q);

//         $qBlob = "INSERT INTO pers_pegawai1(nrk,nip,nip18,klogad,kklogad,
//                  nama,titel,pathir,talhir,agama,jenkel,stawin,
//                  stapeg,jenpeg,induk,tmt_stapeg,muang,
//                  tglampp,tglempp,
//                  tbhttmas,tbhbbmas,tunda,pindahan,tmtpindah,mpp,noijazah,
//                  kdmati, flag, tgmati,kolok,kojab,spmu,
//                  user_id,term,tg_upd,x_photo)
//                VALUES (:nrk,:nip,:nip18,:klogad,:kklogad,
//                  :nama,:titel,:pathir,TO_DATE(:talhir, 'DD-MM-YYYY'),:agama,:jenkel,:stawin,
//                  :stapeg,:jenpeg,:induk,TO_DATE(:tmt_stapeg, 'DD-MM-YYYY'),TO_DATE(:muang, 'DD-MM-YYYY'),
//                  TO_DATE(:tglampp, 'DD-MM-YYYY'),TO_DATE(:tglempp, 'DD-MM-YYYY'),
//                  :tbhttmas,:tbhbbmas,:tunda,:pindahan,TO_DATE(:tmtpindah, 'DD-MM-YYYY'),:mpp,:noijazah,
//                  :kdmati,:flag,TO_DATE(:tgmati, 'DD-MM-YYYY'),:kolok,:kojab,:spmu,
//                  :user_id,:term,SYSDATE,:x_photo)";
//            //echo $qBlob;
//         $s = oci_parse($this->conn, $qBlob);
//         $lob = oci_new_descriptor($this->conn, OCI_D_LOB);
//         //pegawai 1
//         oci_bind_by_name($s, ':nrk', $nrk);
//         oci_bind_by_name($s, ':nip', $nip);
//         oci_bind_by_name($s, ':nip18', $nip18);
//         oci_bind_by_name($s, ':klogad', $klogad);
//         oci_bind_by_name($s, ':kklogad', $kklogad);
//         oci_bind_by_name($s, ':nama', $nama);
//         oci_bind_by_name($s, ':titel', $titel);
//         oci_bind_by_name($s, ':pathir', $pathir);
//         oci_bind_by_name($s, ':talhir', $talhir);
//         oci_bind_by_name($s, ':agama', $agama);
//         oci_bind_by_name($s, ':jenkel', $jenkel);
//         oci_bind_by_name($s, ':stawin', $stawin);
//         oci_bind_by_name($s, ':stapeg', $stapeg);
//         oci_bind_by_name($s, ':jenpeg', $jenpeg);
//         oci_bind_by_name($s, ':induk', $induk);
//         oci_bind_by_name($s, ':tmt_stapeg', $tmt_stapeg);
//         oci_bind_by_name($s, ':muang', $muang);
//         oci_bind_by_name($s, ':tglampp', $tglampp);
//         oci_bind_by_name($s, ':tglempp', $tglempp);
//         oci_bind_by_name($s, ':tbhttmas', $tbhttmas);
//         oci_bind_by_name($s, ':tbhbbmas', $tbhbbmas);
//         oci_bind_by_name($s, ':tunda', $tunda);
//         oci_bind_by_name($s, ':pindahan', $pindahan);
//         oci_bind_by_name($s, ':tmtpindah', $tmtpindah);
//         oci_bind_by_name($s, ':mpp', $mpp);
//         oci_bind_by_name($s, ':noijazah', $noijazah);
//         oci_bind_by_name($s, ':kdmati', $kdmati);
//         oci_bind_by_name($s, ':flag', $flag);
//         oci_bind_by_name($s, ':tgmati', $tgmati);
//         oci_bind_by_name($s, ':kolok', $kolok);
//         oci_bind_by_name($s, ':kojab', $kojab);
//         oci_bind_by_name($s, ':spmu', $spmu);
//         oci_bind_by_name($s, ':user_id', $user_id);
//         oci_bind_by_name($s, ':term', $term);
//
//
//         if (!empty($_FILES['x_photo']['tmp_name'])){
//             oci_bind_by_name($s, ':x_photo', $lob, -1, OCI_B_BLOB);
//             $myv = file_get_contents($_FILES['x_photo']['tmp_name']);
//             //get the content of the image using its path
//             //$myv = file_get_contents($upload['full_path']);
//             $lob->writeTemporary($myv, OCI_TEMP_BLOB);
//         } else {
//             $myv = '';
//             oci_bind_by_name($s, ':x_photo', $x_photo);
//         }
//         oci_execute($s, OCI_NO_AUTO_COMMIT);
//         $id = oci_num_rows($s);
//
//         oci_commit($this->conn);
//         $lob->close();
//
//         // Read and insert the BLOB from PHP's temporary upload area
//         $lob = oci_new_descriptor($this->conn, OCI_D_LOB);
//         $sql = 'insert into "mybtab" ("blobid", "blobdata2", "blobdata") values(:myblobid, :blobdata2, :blobdata)';
//         $s = oci_parse($this->conn, $sql);
//         oci_bind_by_name($s, ':myblobid', $nrk);
//         $tes= "kikin";
//         oci_bind_by_name($s, ':blobdata2', $tes);
//         oci_bind_by_name($s, ':blobdata', $lob, -1, OCI_B_BLOB);
//         $myv = file_get_contents($_FILES['x_photo']['tmp_name']);
//         $lob->writeTemporary($myv, OCI_TEMP_BLOB);
//         oci_execute($s, OCI_NO_AUTO_COMMIT);
//         oci_commit($this->conn);
//         $lob->close();


         if ($id > 0){
             //pegawai2
             $karpeg = $data['karpeg'];
             $taspen = $data['taspen'];
             $alamat = $data['alamat'];
             $rt = $data['rt'];
             $rw = $data['rw'];
             $prop = $data['prop'];
             $kowil = $data['kowil'];
             $kocam = $data['kocam'];
             $kokel = $data['kokel'];

             
             $sama_almt = $data['sama_almt'];
             if ($sama_almt == '1'){
                 $alamat_ktp = '';
                 $rt_ktp = '';
                 $rw_ktp = '';
                 $kowil_ktp = '';
                 $kocam_ktp = '';
                 $kokel_ktp = '';
                 $prop_ktp = '';
             } else {
                 $sama_almt="";
                 $alamat_ktp = $data['alamat_ktp'];
                 $rt_ktp = $data['rt_ktp'];
                 $rw_ktp = $data['rw_ktp'];
                 $kowil_ktp = $data['kowil_ktp'];
                 $kocam_ktp = $data['kocam_ktp'];
                 $kokel_ktp = $data['kokel_ktp'];
                 $prop_ktp = $data['prop_ktp'];
             }
             //$aliran = $data['aliran'];
             $aliran = '';
             $husbakti = '';
             $noppen = $data['noppen'];
             $simpeda = $data['simpeda'];
             $darah = $data['darah'];
             $karsu = $data['karsu'];
             $npwp = $data['npwp'];
             $jendikcps = $data['jendikcps'];
             $kodikcps = $data['kodikcps'];
             $nippasif = $data['nippasif'];
             //$forpusat = $data['forpusat'];
             //$thforpus = $data['thforpus'];
             //$fordaerah = $data['fordaerah'];
             //$thfordrh = $data['thfordrh'];
             $forpusat = '';
             $thforpus = '';
             $fordaerah = '';
             $thfordrh = '';
             $nohp = $data['nohp'];
             $nokk = $data['nokk'];
             $email = $data['email'];
             $notelp = $data['notelp'];

             $tinggi = '';
             $berat = '';
             $rambut = '';
             $muka = '';
             $kulit = '';
             $cacat = '';
             $kidal = '';

             //pegawai 3
//             $xxx = ($data['xxx']!='')?$data['xxx']:'2';
//             $tinggi = $data['tinggi'];
//             $berat = $data['berat'];
//             $rambut = $data['rambut'];
//             $muka = $data['muka'];
//             $kulit = $data['kulit'];
//             $cacat = $data['cacat'];
//             $kidal = $data['kidal'];
//             $olah1 = $data['olah1'];
//             $olah2 = $data['olah2'];
//             $olah3 = $data['olah3'];
//             $seni1 = $data['seni1'];
//             $seni2 = $data['seni2'];
//             $seni3 = $data['seni3'];
//             $hobi1 = $data['hobi1'];
//             $hobi2 = $data['hobi2'];
//             $hobi3 = $data['hobi3'];
//             $ciri = $data['ciri'];


             $q2 = "INSERT INTO pers_pegawai2(nrk, karpeg, taspen,
                    alamat, rt, rw, kowil, kocam, kokel, prop,
                    alamat_ktp, rt_ktp, rw_ktp, kowil_ktp, kocam_ktp, kokel_ktp, prop_ktp,
                    aliran, noppen,
                    simpeda, darah, karsu, npwp, jendikcps, kodikcps, nippasif,
                    forpusat, thforpus, fordaerah, thfordrh,
                    nohp, nokk, email, notelp,
                    tinggi, berat, rambut,muka, kulit, cacat, kidal,
                    user_id,term,tg_upd)
                    VALUES ('$nrk', '$karpeg', '$taspen',
                    UPPER('$alamat'), '$rt','$rw', '$kowil', '$kocam', '$kokel', '$prop',
                    UPPER('$alamat_ktp'), '$rt_ktp','$rw_ktp', '$kowil_ktp', '$kocam_ktp', '$kokel_ktp', '$prop_ktp',
                    '$aliran', '$noppen',
                    '$simpeda', '$darah', '$karsu', '$npwp', '$jendikcps', '$kodikcps', '$nippasif',
                    '$forpusat', '$thforpus','$fordaerah','$thfordrh',
                    '$nohp', '$nokk', '$email', '$notelp',
                    '$tinggi', '$berat', '$rambut', '$muka', '$kulit', '$cacat', '$kidal',
                    '$user_id','$term', SYSDATE)";
             //echo $q2;
             $id2 = $this->db->query($q2);

             $qa = "INSERT INTO pers_alamat_hist(nrk, tgmulai,
                    alamat, rt, rw, kowil, kocam, kokel, prop,
                    alamat_ktp, rt_ktp, rw_ktp, kowil_ktp, kocam_ktp, kokel_ktp, prop_ktp,
                    user_id,term,tg_upd)
                    VALUES ('$nrk', TO_CHAR(TO_DATE(SYSDATE, 'DD-MM-YYYY')),
                    UPPER('$alamat'), '$rt','$rw', '$kowil', '$kocam', '$kokel', '$prop',
                    UPPER('$alamat_ktp'), '$rt_ktp','$rw_ktp', '$kowil_ktp', '$kocam_ktp', '$kokel_ktp', '$prop_ktp',
                    '$user_id','$term', SYSDATE)";
             //echo $qa;
             $ida = $this->db->query($qa);

//             $q3 = "INSERT INTO pers_pegawai3(nrk, xxx,
//                    tinggi, berat, rambut,muka, kulit, cacat, kidal,
//                    olah1, olah2, olah3,
//                    seni1, seni2, seni3, hobi1, hobi2, hobi3, ciri,
//                    user_id,term,tg_upd)
//                    VALUES ('$nrk', '$xxx',
//                    '$tinggi', '$berat', '$rambut', '$muka', '$kulit', '$cacat', '$kidal',
//                    '$olah1', '$olah2', '$olah3',
//                    '$seni1', '$seni2', '$seni3', '$hobi1', '$hobi2', '$hobi3', '$ciri',
//                    '$user_id','$term', SYSDATE)";
//             echo $q3;
//             $id3 = $this->db->query($q3);
             $password = md5('123456');
             $userac = "INSERT INTO \"master_user\"(\"user_id\",\"user_password\",\"user_name\",\"user_level\",\"user_enable\",\"user_group_id\",KOWIL)
                        VALUES('$nrk','$password',UPPER('$nama'),'','t',1,'')";

                $uac = $this->db->query($userac);

         }

         return $id;
     }
	 
	 function addUserAccount($nrkp)
     {
        $nrk = $nrkp['NRK'];
        
        $cek = "SELECT * FROM \"master_user\" WHERE \"user_id\" = '".$nrk."' ";
         
        $query= $this->db->query($cek);

        $num = $query->num_rows();
        
        $res;

        if($num == 0)
        {
            $getData= "SELECT NAMA FROM PERS_PEGAWAI1 WHERE NRK='".$nrk."'";
            $exgetData = $this->db->query($getData)->row();
            $getNama = $exgetData->NAMA;

            $password = md5('123456');
            $sql = "INSERT INTO \"master_user\"(\"user_id\",\"user_password\",\"user_name\",\"user_level\",\"user_enable\",\"user_group_id\",KOWIL)
                        VALUES('$nrk','$password',UPPER('$getNama'),'','t',1,'')";

            $query = $this->db->query($sql);

            if($query)
            {
                $res='1';
            }
            else
            {
                $res='0';
            }
        }
        else
        {
            $res='2';
        }

        return $res;
     }

     function updateData($data){
        //var_dump($data);
         $nrk = $data['nrk'];

         $nip = $data['nip'];
         $nip18 = $data['nip18'];

         $tmt_stapeg = $data['tmt_stapeg'];
         //$kolok = $data['kolok'];
         $klogad = $data['klogad'];
         $spmu = $data['spmu'];
         // $klogad = '';
         $jenpeg = $data['jenpeg'];
         $tmttitipan = $data['tmttitipan'];
         $kklogad = $data['kklogad'];

         //Induk di Hardcode saja
         //$induk = $data['induk'];
         $induk = '00';

         //$nama = $data['nama'];
         $nama = str_replace("'","`",$data['nama']);
         $muang = $data['muang'];
         $titel = $data['titel'];
         //$notunggu = $data['notunggu'];
         $notunggu = '';
         $pathir = $data['pathir'];

         //$tgtunggu = $data['tgtunggu'];
         $tgtunggu = '';
         $talhir = $data['talhir'];
         //$tgakhtung = $data['tgakhtung'];
         $tgakhtung = '';
         $agama = $data['agama'];
         //$tbhttmas = $data['tbhttmas'];
         $tbhttmas = 0;
         $jenkel = $data['jenkel'];
         //$tbhbbmas = $data['tbhbbmas'];
         $tbhbbmas = '0';
         //$stawin = $data['stawin'];
         $stawin = '0';
         //$tunda = $data['tunda'];
         $tunda = 0;
         $stapeg = $data['stapeg'];
         $pindahan = $data['pindahan'];
         $tmtpindah = $data['tmtpindah'];
         $mpp = $data['mpp'];
         $tglampp = $data['tglampp'];
         $tglempp = $data['tglempp'];
         $noijazah = $data['noijazah'];

         $flag = $data['flag'];
         $tgmati = $data['tgmati'];
         $tmtpensiun='';
         if ($tgmati==''){
             $kdmati = "T";
             $tgmati_a = "";
             // $tmtpensiun = "";
         } else {
             $kdmati = "Y";
             $tmtpensiun = $tgmati;
             $tgmati_a = "tgmati = TO_DATE(:tgmati, 'DD-MM-YYYY'),";
             // $tmtpensiun = "tmtpensiun = TO_DATE(:tmtpensiun, 'DD-MM-YYYY'),";
         }

        // $kolok = $data['kolok'];
        // $kojab = $data['kojab'];
        // $spmu = $data['spmu'];
         // $kolok = '';
         // $kojab = '';
         // $spmu = '';

         $user_id = $data['user_id'];
         $term = $this->input->ip_address();

        // klogad = '$klogad',
         
           if($kdmati == "Y")
            {
                 $sql = "UPDATE pers_pegawai1 SET
                        nip = '".$nip."',
                        nip18 = '".$nip18."',
                        tmt_stapeg = TO_DATE('".$tmt_stapeg."', 'DD-MM-YYYY'),
                        jenpeg = '$jenpeg',
                        tmttitipan = TO_DATE('".$tmttitipan."', 'DD-MM-YYYY'),
                        kklogad = '$kklogad',
                        klogad='".$klogad."',
                        induk = '$induk',
                        nama = UPPER('$nama'),
                        muang = TO_DATE('".$muang."', 'DD-MM-YYYY'),
                        titel = '$titel',
                        notunggu = '$notunggu',
                        pathir = UPPER('$pathir'),
                        tgtunggu = TO_DATE('".$tgtunggu."', 'DD-MM-YYYY'),
                        talhir = TO_DATE('".$talhir."', 'DD-MM-YYYY'),
                        tgakhtung = TO_DATE('".$tgakhtung."', 'DD-MM-YYYY'),
                        agama = '$agama',
                        tbhttmas = '$tbhttmas',
                        jenkel = '$jenkel',
                        tbhbbmas = '$tbhbbmas',
                        stawin = '$stawin',
                        tunda = '$tunda',
                        stapeg = '$stapeg',
                        pindahan = '$pindahan',
                        mpp = '$mpp',
                        tglampp = TO_DATE('".$tglampp."', 'DD-MM-YYYY'),
                        tglempp = TO_DATE('".$tglempp."', 'DD-MM-YYYY'),
                        user_id = '".$user_id."',
                        term = '".$term."',
                        tg_upd = SYSDATE,
                        noijazah = '".$noijazah."',
                        kdmati = '$kdmati',
                        tgmati = TO_DATE('".$tgmati."', 'DD-MM-YYYY'),
                        TMTPENSIUN = TO_DATE('".$tmtpensiun."', 'DD-MM-YYYY')
                 WHERE nrk = '".$nrk."'";
            }
            else
            {
                 $sql = "UPDATE pers_pegawai1 SET
                        nip = '".$nip."',
                        nip18 = '".$nip18."',
                        tmt_stapeg = TO_DATE('".$tmt_stapeg."', 'DD-MM-YYYY'),
                        jenpeg = '$jenpeg',
                        tmttitipan = TO_DATE('".$tmttitipan."', 'DD-MM-YYYY'),
                        kklogad = '$kklogad',
                        klogad='".$klogad."',
                        induk = '$induk',
                        nama = UPPER('$nama'),
                        muang = TO_DATE('".$muang."', 'DD-MM-YYYY'),
                        titel = '$titel',
                        notunggu = '$notunggu',
                        pathir = UPPER('$pathir'),
                        tgtunggu = TO_DATE('".$tgtunggu."', 'DD-MM-YYYY'),
                        talhir = TO_DATE('".$talhir."', 'DD-MM-YYYY'),
                        tgakhtung = TO_DATE('".$tgakhtung."', 'DD-MM-YYYY'),
                        agama = '$agama',
                        tbhttmas = '$tbhttmas',
                        jenkel = '$jenkel',
                        tbhbbmas = '$tbhbbmas',
                        stawin = '$stawin',
                        tunda = '$tunda',
                        stapeg = '$stapeg',
                        pindahan = '$pindahan',
                        mpp = '$mpp',
                        tglampp = TO_DATE('".$tglampp."', 'DD-MM-YYYY'),
                        tglempp = TO_DATE('".$tglempp."', 'DD-MM-YYYY'),
                        user_id = '".$user_id."',
                        term = '".$term."',
                        tg_upd = SYSDATE,
                        noijazah = '".$noijazah."',
                        kdmati = '$kdmati',
                        tgmati = TO_DATE('".$tgmati."', 'DD-MM-YYYY'),
                        nosuratmati = '',
                        tgsuratmati ='',
                        user_id_mati='',
                        tg_upd_mati='',
                        TMTPENSIUN = TO_DATE('".$tmtpensiun."', 'DD-MM-YYYY')
                 WHERE nrk = '".$nrk."'";
            }
         
            $id = $this->db->query($sql);
         

//         $qBlob = "UPDATE pers_pegawai1 SET
//                        nip = :nip,
//                        nip18 = :nip18,
//                        tmt_stapeg = TO_DATE(:tmt_stapeg, 'DD-MM-YYYY'),
//                        klogad = :klogad,
//                        jenpeg = :jenpeg,
//                        kklogad = :kklogad,
//                        induk = :induk,
//                        nama = :nama,
//                        muang = TO_DATE(:muang, 'DD-MM-YYYY'),
//                        titel = :titel,
//                        notunggu = :notunggu,
//                        pathir = :pathir,
//                        tgtunggu = TO_DATE(:tgtunggu, 'DD-MM-YYYY'),
//                        talhir = TO_DATE(:talhir, 'DD-MM-YYYY'),
//                        tgakhtung = TO_DATE(:tgakhtung, 'DD-MM-YYYY'),
//                        agama = :agama,
//                        tbhttmas = :tbhttmas,
//                        jenkel = :jenkel,
//                        tbhbbmas = :tbhbbmas,
//                        stawin = :stawin,
//                        tunda = :tunda,
//                        stapeg = :stapeg,
//                        pindahan = :pindahan,
//                        tmtpindah = TO_DATE(:tmtpindah, 'DD-MM-YYYY'),
//                        mpp = :mpp,
//                        tglampp = TO_DATE(:tglampp, 'DD-MM-YYYY'),
//                        tglempp = TO_DATE(:tglempp, 'DD-MM-YYYY'),
//                        user_id = :user_id,
//                        term = :term,
//                        tg_upd = SYSDATE,
//                        noijazah = :noijazah,
//                        kdmati = :kdmati,
//                        flag = :flag,
//                        $tgmati_a
//                         kolok = :kolok,
//                         kojab = :kojab,
//                         spmu = :spmu,
//                         x_photo = :x_photo
//                 WHERE nrk = :nrk";
//         //echo $qBlob;
//         $s = oci_parse($this->conn, $qBlob);
//         $lob = oci_new_descriptor($this->conn, OCI_D_LOB);
//         //pegawai 1
//         oci_bind_by_name($s, ':nrk', $nrk);
//         oci_bind_by_name($s, ':nip', $nip);
//         oci_bind_by_name($s, ':nip18', $nip18);
//         oci_bind_by_name($s, ':klogad', $klogad);
//         oci_bind_by_name($s, ':kklogad', $kklogad);
//         oci_bind_by_name($s, ':nama', $nama);
//         oci_bind_by_name($s, ':titel', $titel);
//         oci_bind_by_name($s, ':notunggu', $notunggu);
//         oci_bind_by_name($s, ':tgtunggu', $tgtunggu);
//         oci_bind_by_name($s, ':tgakhtung', $tgakhtung);
//         oci_bind_by_name($s, ':pathir', $pathir);
//         oci_bind_by_name($s, ':talhir', $talhir);
//         oci_bind_by_name($s, ':agama', $agama);
//         oci_bind_by_name($s, ':jenkel', $jenkel);
//         oci_bind_by_name($s, ':stawin', $stawin);
//         oci_bind_by_name($s, ':tunda', $tunda);
//         oci_bind_by_name($s, ':stapeg', $stapeg);
//         oci_bind_by_name($s, ':jenpeg', $jenpeg);
//         oci_bind_by_name($s, ':induk', $induk);
//         oci_bind_by_name($s, ':tmt_stapeg', $tmt_stapeg);
//         oci_bind_by_name($s, ':muang', $muang);
//         oci_bind_by_name($s, ':tglampp', $tglampp);
//         oci_bind_by_name($s, ':tglempp', $tglempp);
//         oci_bind_by_name($s, ':tbhttmas', $tbhttmas);
//         oci_bind_by_name($s, ':tbhbbmas', $tbhbbmas);
//         oci_bind_by_name($s, ':tunda', $tunda);
//         oci_bind_by_name($s, ':pindahan', $pindahan);
//         oci_bind_by_name($s, ':tmtpindah', $tmtpindah);
//         oci_bind_by_name($s, ':mpp', $mpp);
//         oci_bind_by_name($s, ':noijazah', $noijazah);
//         oci_bind_by_name($s, ':flag', $flag);
//         oci_bind_by_name($s, ':kdmati', $kdmati);
//         if ($tgmati!=''){
//             oci_bind_by_name($s, ':tgmati', $tgmati);
//         }
//
//         oci_bind_by_name($s, ':kolok', $kolok);
//         oci_bind_by_name($s, ':kojab', $kojab);
//         oci_bind_by_name($s, ':spmu', $spmu);
//         oci_bind_by_name($s, ':user_id', $user_id);
//         oci_bind_by_name($s, ':term', $term);
//
//
//         if ($data['namafile2']!=''){
//             oci_bind_by_name($s, ':x_photo', $lob, -1, OCI_B_BLOB);
//             $myv = file_get_contents($_FILES['x_photo']['tmp_name']);
//             $lob->writeTemporary($myv, OCI_TEMP_BLOB);
//         } else {
//             $myv = '';
//             oci_bind_by_name($s, ':x_photo', $x_photo);
//         }
//         oci_execute($s, OCI_NO_AUTO_COMMIT);
//         $id = oci_num_rows($s);
//
//         oci_commit($this->conn);
//         $lob->close();


         //pegawai2
         $karpeg = $data['karpeg'];
         $taspen = $data['taspen'];
         
         $alamat = $data['alamat'];
         $rt = $data['rt'];
         $rw = $data['rw'];
         $kowil = $data['kowil'];
         $kocam = $data['kocam'];
         $kokel = $data['kokel'];
         $prop = $data['prop'];

         // $sama_almt = $data['sama_almt'];
         if (isset($data['sama_almt'])){
             $alamat_ktp = '';
             $rt_ktp = '';
             $rw_ktp = '';
             $kowil_ktp = '';
             $kocam_ktp = '';
             $kokel_ktp = '';
             $prop_ktp = '';
         } else {
             // $sama_almt="";
             $alamat_ktp = $data['alamat_ktp'];
             $rt_ktp = $data['rt_ktp'];
             $rw_ktp = $data['rw_ktp'];
             $kowil_ktp = $data['kowil_ktp'];
             $kocam_ktp = $data['kocam_ktp'];
             $kokel_ktp = $data['kokel_ktp'];
             $prop_ktp = $data['prop_ktp'];
         }
         
         //$aliran = $data['aliran'];
         $aliran = '';
         $husbakti = '';
         $noppen = $data['noppen'];
         $simpeda = $data['simpeda'];
         $darah = $data['darah'];
         $karsu = $data['karsu'];
         $npwp = $data['npwp'];
         $jendikcps = $data['jendikcps'];
         $kodikcps = $data['kodikcps'];
         $nippasif = $data['nippasif'];

         //$forpusat = $data['forpusat'];
         //$thforpus = $data['thforpus'];
         //$fordaerah = $data['fordaerah'];
         //$thfordrh = $data['thfordrh'];
         $forpusat = '';
         $thforpus = '';
         $fordaerah = '';
         $thfordrh = '';
         $nohp = $data['nohp'];
         $nokk = $data['nokk'];
         $email = $data['email'];
         $notelp = $data['notelp'];
         $tinggi = '';
         $berat = '';
         $rambut = '';
         $muka = '';
         $kulit = '';
         $cacat = '';
         $kidal = '';

         //pegawai 3
//         $xxx = ($data['xxx']!='')?$data['xxx']:'2';
//         $tinggi = $data['tinggi'];
//         $berat = $data['berat'];
//         $rambut = $data['rambut'];
//         $muka = $data['muka'];
//         $kulit = $data['kulit'];
//         $cacat = $data['cacat'];
//         $kidal = $data['kidal'];
//         $olah1 = $data['olah1'];
//         $olah2 = $data['olah2'];
//         $olah3 = $data['olah3'];
//         $seni1 = $data['seni1'];
//         $seni2 = $data['seni2'];
//         $seni3 = $data['seni3'];
//         $hobi1 = $data['hobi1'];
//         $hobi2 = $data['hobi2'];
//         $hobi3 = $data['hobi3'];
//         $ciri = $data['ciri'];

         $qPeg="SELECT NRK FROM PERS_PEGAWAI2 WHERE NRK='$nrk'";
         $row = $this->db->query($qPeg)->row();

         if (!$row){
             $q2 = "INSERT INTO pers_pegawai2(nrk, karpeg, taspen,
                        alamat, rt, rw, kowil, kocam, kokel, prop,
                        alamat_ktp, rt_ktp, rw_ktp, kowil_ktp, kocam_ktp, kokel_ktp, prop_ktp,
                        aliran, noppen,
                        simpeda, darah, karsu, npwp, jendikcps, kodikcps, nippasif,
                        forpusat, thforpus, fordaerah, thfordrh,
                        nohp, nokk, email, notelp,
                        tinggi, berat, rambut,muka, kulit, cacat, kidal,
                        user_id,term,tg_upd)
                        VALUES ('$nrk', '$karpeg', '$taspen',
                        UPPER('$alamat'), '$rt','$rw', '$kowil', '$kocam', '$kokel', '$prop',
                        UPPER('$alamat_ktp'), '$rt_ktp','$rw_ktp', '$kowil_ktp', '$kocam_ktp', '$kokel_ktp', '$prop_ktp',
                        '$aliran', '$noppen',
                        '$simpeda', '$darah', '$karsu', '$npwp', '$jendikcps', '$kodikcps', '$nippasif',
                        '$forpusat', '$thforpus','$fordaerah','$thfordrh',
                        '$nohp', '$nokk', '$email', '$notelp',
                        '$tinggi', '$berat', '$rambut', '$muka', '$kulit', '$cacat', '$kidal',
                        '$user_id','$term', SYSDATE)";
                 //echo $q2;
             $id2 = $this->db->query($q2);
         } else {    
            $sql2 = "UPDATE pers_pegawai2 SET
                    karpeg = '$karpeg',
                    taspen = '$taspen',
                    alamat = UPPER('$alamat'),
                    rt = '$rt',
                    rw = '$rw',
                    kowil = '$kowil',
                    kocam = '$kocam',
                    kokel = '$kokel',
                    prop = '$prop',
                    alamat_ktp = UPPER('$alamat_ktp'),
                    rt_ktp = '$rt_ktp',
                    rw_ktp = '$rw_ktp',
                    kowil_ktp = '$kowil_ktp',
                    kocam_ktp = '$kocam_ktp',
                    kokel_ktp = '$kokel_ktp',
                    prop_ktp = '$prop_ktp',
                    aliran = '$aliran',
                    noppen = '$noppen',
                    simpeda = '$simpeda',
                    darah = '$darah',
                    karsu = '$karsu',
                    npwp = '$npwp',
                    jendikcps = '$jendikcps',
                    kodikcps = '$kodikcps',
                    nippasif = '$nippasif',
                    forpusat = '$forpusat',
                    thforpus = '$thforpus',
                    fordaerah = '$fordaerah',
                    thfordrh = '$thfordrh',
                    nohp = '$nohp',
                    email = '$email',
                    nokk = '$nokk',
                    notelp = '$notelp',
                    tinggi = '$tinggi',
                     berat = '$berat',
                     rambut = '$rambut',
                     muka = '$muka',
                     kulit = '$kulit',
                     cacat = '$cacat',
                     kidal = '$kidal',

                        user_id = '".$user_id."',
                        term = '".$term."',
                        tg_upd = SYSDATE
                 WHERE nrk = '".$nrk."'";
            $id2 = $this->db->query($sql2);
        }

         $q="SELECT ALAMAT, TO_CHAR(TGMULAI,'YYYY-MM-DD')TGMULAI, RT, RW FROM pers_alamat_hist WHERE nrk='$nrk' ORDER BY TGMULAI DESC";
         
         $ra = $this->db->query($q)->row();

         if ($ra){
            $qa = "UPDATE pers_alamat_hist SET
                    alamat = UPPER('$alamat'), 
                    rt = '$rt', 
                    rw = '$rw', 
                    kowil = '$kowil', 
                    kocam = '$kocam', 
                    kokel = '$kokel', 
                    prop = '$prop',
                    alamat_ktp = UPPER('$alamat_ktp'), 
                    rt_ktp = '$rt_ktp', 
                    rw_ktp = '$rw_ktp', 
                    kowil_ktp = '$kowil_ktp', 
                    kocam_ktp = '$kocam_ktp', 
                    kokel_ktp = '$kokel_ktp', 
                    prop_ktp = '$prop_ktp',
                    user_id = '$user_id',
                    term = '$term',
                    tg_upd = SYSDATE
                    WHERE nrk ='$nrk' AND TGMULAI = TO_DATE('".$ra->TGMULAI."', 'YYYY-MM-DD')";
                }
         else {
            $qa = "INSERT INTO pers_alamat_hist(nrk, tgmulai,
                    alamat, rt, rw, kowil, kocam, kokel, prop,
                    alamat_ktp, rt_ktp, rw_ktp, kowil_ktp, kocam_ktp, kokel_ktp, prop_ktp,
                    user_id,term,tg_upd)
                    VALUES ('$nrk', TO_CHAR(TO_DATE(SYSDATE, 'DD-MM-YYYY')),
                    UPPER('$alamat'), '$rt','$rw', '$kowil', '$kocam', '$kokel', '$prop',
                    UPPER('$alamat_ktp'), '$rt_ktp','$rw_ktp', '$kowil_ktp', '$kocam_ktp', '$kokel_ktp', '$prop_ktp',
                    '$user_id','$term', SYSDATE)";
        }            
         
         $ida = $this->db->query($qa);

//         $sql3 = "UPDATE pers_pegawai3 SET
//                     xxx = '$xxx',
//                     tinggi = '$tinggi',
//                     berat = '$berat',
//                     rambut = '$rambut',
//                     muka = '$muka',
//                     kulit = '$kulit',
//                     cacat = '$cacat',
//                     kidal = '$kidal',
//                     olah1 = '$olah1',
//                     olah2 = '$olah2',
//                     olah3 = '$olah3',
//                     seni1 = '$seni1',
//                     seni2 = '$seni2',
//                     seni3 = '$seni3',
//                     hobi1 = '$hobi1',
//                     hobi2 = '$hobi2',
//                     hobi3 = '$hobi3',
//                     ciri = '$ciri',
//                        user_id = '".$user_id."',
//                        term = '".$term."',
//                        tg_upd = SYSDATE
//                 WHERE nrk = '".$nrk."'";
//
//         $id3 = $this->db->query($sql3);

         return $id;
         //return $q;
     }


     function hapusData($id){

         $q1 = "UPDATE pers_pegawai1 SET DELETED='Y' WHERE nrk = '".$id."'";


         $que1 = $this->db->query($q1);
         if($que1)
         {

             $q2a="UPDATE pers_alamat_hist SET DELETED='Y' WHERE nrk = '".$id."'";
             $que2a=$this->db->query($q2a);

             $q2="UPDATE pers_pegawai2 SET DELETED='Y' WHERE nrk = '".$id."'";
             $que2=$this->db->query($q2);

//             $q3="DELETE FROM pers_pegawai3 WHERE nrk = '".$id."'";
//             $que3=$this->db->query($q3);
         }

         return $que1;
     }

     function hapusDataP($id){
        $user_id = $this->session->userdata('logged_in')['id'];
        // $qi="INSERT INTO DEL_PERS_ALAMAT_HIST A
        //     (
        //     SELECT 
        //         NRK,
        //         TGMULAI,
        //         ALAMAT,
        //         RT,
        //         RW,
        //         USER_ID,
        //         TERM,
        //         TG_UPD,
        //         ALAMAT_KTP,
        //         STAT_APP,
        //         RT_KTP,
        //         RW_KTP,
        //         PROP_KTP,
        //         KOWIL_KTP,
        //         KOCAM_KTP,
        //         KOKEL_KTP,
        //         SAMA_ALMT,
        //         PROP,
        //         KOWIL,
        //         KOCAM,
        //         KOKEL,
        //         SYSDATE AS DELETE_DATE,
        //         'BKD' AS DELETE_BY
        //     FROM PERS_ALAMAT_HIST D
        //     WHERE D.NRK = '".$id."'
        //     AND D.TGMULAI = TO_DATE('2016-07-26 00:00:00','YYYY-MM-DD HH24:MI:SS')
        //     )";
        // $rsi=$this->db->query($qi);

        // $q2a="DELETE FROM pers_alamat_hist WHERE nrk = '".$id."'";
        // $que2a=$this->db->query($q2a);

        $qi="INSERT INTO DEL_PERS_PEGAWAI2 A
            (
            SELECT 
                NRK,
                KARPEG,
                TASPEN,
                SIMPEDA,
                ALIRAN,
                ALAMAT,
                RT,
                RW,
                NOPPEN,
                DARAH,
                HUSBAKTI,
                KARSU,
                NPWP,
                JENDIKCPS,
                KODIKCPS,
                NIPPASIF,
                THFORPUS,
                NOINPRES,
                TGSUMPAH,
                NOSUMPAH,
                PEJTTSUM,
                TINGGI,
                BERAT,
                RAMBUT,
                MUKA,
                KULIT,
                CACAT,
                KIDAL,
                USER_ID,
                TERM,
                TG_UPD,
                EMAIL,
                NOHP,
                NOTELP,
                NOKK,
                FORPUSAT,
                FORDAERAH,
                THFORDRH,
                PROP,
                KOWIL,
                KOCAM,
                KOKEL,
                ALAMAT_KTP,
                RT_KTP,
                RW_KTP,
                PROP_KTP,
                KOWIL_KTP,
                KOCAM_KTP,
                KOKEL_KTP,
                SYSDATE AS DELETE_DATE,
                '$user_id' AS DELETE_BY
            FROM PERS_PEGAWAI2 D
            WHERE D.NRK = '".$id."'
            )";
        $rsi=$this->db->query($qi);

        $q2="DELETE FROM PERS_PEGAWAI2 WHERE NRK = '".$id."'";
        $que2=$this->db->query($q2);

        $qi="INSERT INTO DEL_PERS_PEGAWAI3 A
            (
            SELECT 
                XXX,
                NRK,
                TINGGI,
                BERAT,
                RAMBUT,
                MUKA,
                KULIT,
                CACAT,
                KIDAL,
                OLAH1,
                OLAH2,
                OLAH3,
                SENI1,
                SENI2,
                SENI3,
                HOBI1,
                HOBI2,
                HOBI3,
                CIRI,
                USER_ID,
                TERM,
                TG_UPD,
                SYSDATE AS DELETE_DATE,
                '$user_id' AS DELETE_BY
            FROM PERS_PEGAWAI3 D
            WHERE D.NRK = '".$id."'
            )";
        $rsi=$this->db->query($qi);

        $q3="DELETE FROM PERS_PEGAWAI3 WHERE NRK = '".$id."'";
        $que3=$this->db->query($q3);

        // $q4="DELETE FROM PERS_RB_GAPOK_HIST WHERE NRK = '".$id."'";
        // $que4=$this->db->query($q4);
        
         // if($que2a && $que2){
        $qi="INSERT INTO DEL_PERS_PEGAWAI1 A
            (
            SELECT 
                NRK,
                NIP,
                KLOGAD,
                KKLOGAD,
                NAMA,
                TITEL,
                PATHIR,
                TALHIR,
                AGAMA,
                JENKEL,
                STAWIN,
                STAPEG,
                JENPEG,
                INDUK,
                MUANG,
                NOTUNGGU,
                TGTUNGGU,
                TGAKHTUNG,
                TBHTTMAS,
                TBHBBMAS,
                TUNDA,
                MPP,
                TMT_STAPEG,
                USER_ID,
                TERM,
                TG_UPD,
                NIP18,
                TMTPENSIUN,
                KDMATI,
                TGLAMPP,
                TGLEMPP,
                X_PHOTO,
                PINDAHAN,
                TMTPINDAH,
                KOLOK,
                KOJAB,
                TITELDEPAN,
                KD,
                SPMU,
                NOIJAZAH,
                FLAG,
                TGMATI,
                TMTTITIPAN,
                SYSDATE AS DELETE_DATE,
                '$user_id' AS DELETE_BY,
                NOSURATMATI,
                TGSURATMATI,
                USER_ID_MATI,
                TG_UPD_MATI,
                ASALSURATMATI
            FROM PERS_PEGAWAI1 D
            WHERE D.NRK = '".$id."'
            )";
        $rsi=$this->db->query($qi);

        $q1 = "DELETE FROM PERS_PEGAWAI1 WHERE NRK = '".$id."'";
        $que1 = $this->db->query($q1);
         //}

         return $que1;
     }

    /* function tesSelect(){
         if (!$this->conn) {
             $e = oci_error();
             trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
         }

         $stid = oci_parse($this->conn, "SELECT * FROM \"mybtab\"");
         oci_execute($stid);

         echo "<table border='1'>\n";
         while ($row = oci_fetch_array($stid, OCI_ASSOC+OCI_RETURN_NULLS)) {
             echo "<tr>\n";
             foreach ($row as $item) {
                 echo "    <td>" . ($item !== null ? htmlentities($item, ENT_QUOTES) : "&nbsp;") . "</td>\n";
             }
             echo "</tr>\n";
         }
         echo "</table>\n";

     }*/

    function get_pass($nrk) {
        $sql = "SELECT *
               FROM \"master_user\"
               WHERE \"user_id\" = '".$nrk."' ";
        return $this->db->query($sql)->row();
    }

    function ubah_password($nrk,$pass_new) {
        $sql = "UPDATE \"master_user\" SET \"user_password\" = '".$pass_new."' WHERE \"user_id\" = '".$nrk."' ";
        return $this->db->query($sql);
    }

    function cekDataMatiPegawai($nrk) {
        $sql = "SELECT NRK,NAMA,KOLOK,KOJAB,KLOGAD,KDMATI, TO_CHAR(TGMATI,'DD-MM-YYYY')TGMATI,TO_CHAR(TGSURATMATI,'DD-MM-YYYY')TGSURATMATI,NOSURATMATI,ASALSURATMATI
                FROM PERS_PEGAWAI1 
                WHERE NRK='$nrk'";

        $query = $this->db->query($sql)->row();
        return $query;
    }

    //sebelum meninggal
    function getDataTerakhirPegawai($nrk) {
        $sql = "SELECT * FROM
                (
                    SELECT NRK,TMT,KOLOK,KLOGAD,KOJAB
                    FROM
                    (
                        SELECT NRK,TMT,KOLOK,KLOGAD,KOJAB FROM PERS_JABATAN_HIST WHERE NRK='".$nrk."'
                        UNION
                        SELECT NRK,TMT,KOLOK,KLOGAD,KOJAB FROM PERS_JABATANF_HIST WHERE NRK='".$nrk."'
                    )
                    WHERE KOLOK<>'111111118' AND KOJAB<>'999918' 
                    ORDER BY TMT DESC
                )
                WHERE ROWNUM = 1";
        
        $query = $this->db->query($sql)->row();
        return $query;
    }

    function updatepeg1blm4bulan($nrk,$tgmati,$tgsuratmati, $nosuratmati, $penginput,$asalsuratmati)
    {
        $sqlcek = "SELECT NRK,THBL,KLOGAD FROM PERS_DUK_PANGKAT_HISTDUK
                    WHERE THBL = (SELECT MAX(THBL) FROM PERS_DUK_PANGKAT_HISTDUK WHERE SUBSTR(THBL,0,1)='2' AND SUBSTR(THBL,5,2)IN('01','02','03','04','05','06','07','08','09','10','11','12') AND NRK='".$nrk."')
                    AND NRK='".$nrk."'";
        $querycek = $this->db->query($sqlcek);
        $numcek = $querycek->num_rows();

        if($numcek>0)
        {
            $klogad = $querycek->row()->KLOGAD;
            $sql = "UPDATE PERS_PEGAWAI1 SET KDMATI='Y', TGMATI = TO_DATE('".$tgmati."', 'DD-MM-YYYY'),TMTPENSIUN = TO_DATE('".$tgmati."', 'DD-MM-YYYY'), TGSURATMATI = TO_DATE('".$tgsuratmati."', 'DD-MM-YYYY'),NOSURATMATI = '".$nosuratmati."',  ASALSURATMATI = '".$asalsuratmati."',KLOGAD='".$klogad."',USER_ID_MATI = '".$penginput."',TG_UPD_MATI = SYSDATE WHERE NRK = '".$nrk."'";
            
        }
        else
        {
            $sql = "UPDATE PERS_PEGAWAI1 SET KDMATI='Y', TGMATI = TO_DATE('".$tgmati."', 'DD-MM-YYYY'),TMTPENSIUN = TO_DATE('".$tgmati."', 'DD-MM-YYYY'), TGSURATMATI = TO_DATE('".$tgsuratmati."', 'DD-MM-YYYY'),NOSURATMATI = '".$nosuratmati."',  ASALSURATMATI = '".$asalsuratmati."',USER_ID_MATI = '".$penginput."',TG_UPD_MATI = SYSDATE WHERE NRK = '".$nrk."'";
        }

        
        
         return $this->db->query($sql);
    }

    function updatepeg1sdh4bulan($nrk,$tgmati,$tgsuratmati, $nosuratmati, $penginput,$asalsuratmati)
    {
        $sql = "UPDATE PERS_PEGAWAI1 SET KDMATI='Y', TGMATI = TO_DATE('".$tgmati."', 'DD-MM-YYYY'),TMTPENSIUN = TO_DATE('".$tgmati."', 'DD-MM-YYYY'), TGSURATMATI = TO_DATE('".$tgsuratmati."', 'DD-MM-YYYY'),NOSURATMATI = '".$nosuratmati."', ASALSURATMATI = '".$asalsuratmati."',USER_ID_MATI = '".$penginput."',TG_UPD_MATI = SYSDATE,KLOGAD='111111118' WHERE NRK = '".$nrk."'";
        
         return $this->db->query($sql);
    }

    function updatebataldapeg($nrk)
    {
        $sqlgetdata = "SELECT NRK,THBL,KLOGAD FROM PERS_DUK_PANGKAT_HISTDUK
                    WHERE THBL = (SELECT MAX(THBL) FROM PERS_DUK_PANGKAT_HISTDUK WHERE SUBSTR(THBL,0,1)='2' AND SUBSTR(THBL,5,2)IN('01','02','03','04','05','06','07','08','09','10','11','12') AND NRK='".$nrk."')
                    AND NRK='".$nrk."'";
        $querycek = $this->db->query($sqlgetdata);
        $numcek = $querycek->num_rows();

        if($numcek>0)
        {
            $klogad = $querycek->row()->KLOGAD;

            $sql = "UPDATE PERS_PEGAWAI1 SET KDMATI='T', TGMATI = '',TMTPENSIUN = '', TGSURATMATI = '',NOSURATMATI = '',  ASALSURATMATI = '',USER_ID_MATI = '',TG_UPD_MATI = '',KLOGAD='".$klogad."' WHERE NRK = '".$nrk."'";
        }

        
        
         return $this->db->query($sql);
    }

    function getDataSekunderPegawai($nrk) {
        $sql = "SELECT A.NRK,A.NAMA,B.TASPEN,B.NOPPEN,B.DARAH,B.JENDIKCPS,B.KODIKCPS,B.USER_ID,B.TERM,B.TG_UPD,B.NOTELP,B.NOHP,B.USERID_DASEK,B.TGLUPD_DASEK,B.EMAIL,A.AGAMA,A.JENKEL,B.KARPEG,B.KARSU,B.NOKK,B.SIMPEDA,B.NPWP,B.BPJS 
                FROM PERS_PEGAWAI1 A
                LEFT JOIN PERS_PEGAWAI2 B ON A.NRK = B.NRK WHERE A.NRK='$nrk'";

        $query = $this->db->query($sql);

        if($query)
        {
            $res = $query->row();
        }
        else
        {
            $res = 0;
        }

        return $res;
    }

    function updateDasekPegawai($nrk,$agama,$jenkel,$taspen,$noppen,$nokk,$simpeda,$npwp,$darah,$notelp,$nohp,$jendikcps,$kodikcps,$karpeg,$bpjs,$email,$karsu)

    /*
    peg1 => nrk,agama,jenkel
    peg2 => nrk,taspen,noppen,nokk,simpeda,npwp,darah,notelp,nohp,jendikcps,kodikcps,karpeg,bpjs,email,karsu
    */
    {
        $sql = "SELECT * FROM PERS_PEGAWAI2 WHERE NRK = '$nrk'";
        $query = $this->db->query($sql);

        $num = $query->num_rows();
        $res=0;

        //jika belum ada data di pegawai2
        if($num == 0)
        {

            $sqlinsert = "INSERT INTO pers_pegawai2(nrk,taspen,noppen,darah,jendikcps,kodikcps,user_id,term,tg_upd,notelp,nohp,email,userid_dasek,tglupd_dasek,jendikcps,kodikcps)
                        VALUES ('$nrk', '$taspen', '$noppen',UPPER('$darah'), 'jendikcps','$kodikcps', $user_id','$term', SYSDATE,$notelp,$nohp,LOWER($email),$nrk,SYSDATE,$jendikcps,$kodikcps)";
            $query = $this->db->query($sqlinsert);

            //update data di pegawai 1

            $sqlpeg1 = "UPDATE PERS_PEGAWAI1 SET JENKEL='$jenkel', AGAMA = '$agama' WHERE NRK = '$nrk'";

            $quepeg1 = $this->db->query($sqlpeg1);

            if($query)
            {
                $res = 1;
            }
            else
            {
                $res = -1;
            }
        }
        else if($num == 1)
        {
            $sqlupdate = "UPDATE PERS_PEGAWAI2 SET TASPEN='$taspen', NOPPEN = '$noppen',NOKK = '$nokk', SIMPEDA = '$simpeda',NPWP = '$npwp', DARAH = '$darah', NOTELP='$notelp', NOHP='$nohp',EMAIL= LOWER('$email'),USERID_DASEK = '$nrk',TGLUPD_DASEK = SYSDATE , JENDIKCPS = '$jendikcps', KODIKCPS = '$kodikcps', KARPEG= '$karpeg', BPJS='$bpjs',KARSU='$karsu' WHERE NRK = '".$nrk."'";
            
            $queryupd = $this->db->query($sqlupdate);

            $sqlpeg1 = "UPDATE PERS_PEGAWAI1 SET JENKEL='$jenkel', AGAMA = '$agama' WHERE NRK = '$nrk'";

            $quepeg1 = $this->db->query($sqlpeg1);

            if($queryupd)
            {
                $res = 2;
            }
            else
            {
                $res = -2;
            }
        }
        else
        {
            $res = 0;
        }

        return $res;
    }

    function updatevalidasi($data)
    {   
        
        $NRK = $data['NRK'];
        $TAHUN = $data['TAHUN'];
        $validator = $data['VALIDATOR'];
        
        $sql = "UPDATE PERS_SKP SET  STATUS_VALIDASI = '1',USERID_VALIDASI = '".$validator."',TGUPD_VALIDASI=SYSDATE
                WHERE NRK = '".$NRK."' AND TAHUN = '".$TAHUN."'
                ";     
            
            $queryupdate  = $this->db->query($sql);

            if($queryupdate)
            {
                $resp = "1";
            }
            else
            {
                $resp = "0";
            }
        
        $result = array('resp'=>$resp,'id'=>$validator);
        return $result;

    }

    function getCtDataSKPBelumValidasi($tahun,$kolok,$spmu=null)
    {
        $session_data       = $this->session->userdata('logged_in');

        $wh="";
        if($session_data['user_group'] == '2' || $session_data['user_group'] == '26')
        {
            if($spmu!=null)
            {
                if($kolok=="" || $kolok =="all")
                {
                    $wh = " AND LOK.SPMU = '$spmu'";
                }
                else
                {
                    $wh = " AND LOK.SPMU = 'spmu' AND LOK.NALOK = '$kolok'";
                }
            }
            else
            {
                $wh = " AND 3=3";   
            }
            
            
        }
        else if($session_data['user_group'] == '5')
        {
                $username =$session_data['id'];

                $getspmu = "SELECT * FROM PERS_TABEL_SPMU WHERE KODE_UNIT_SIPKD ='$username'";
                $querygetspmu = $this->db->query($getspmu);
                $numspm = $querygetspmu->num_rows();

                if($numspm == 0)
                {
                    $wh = " AND 1=1 ";
                }
                else if($numspm == 1)
                {
                    $spmu = $querygetspmu->row()->KODE_SPM;

                    if($kolok == "")
                    {
                        $wh = " AND P1.SPMU='$spmu' ";    
                    }
                    else
                    {
                        $wh = " AND P1.SPMU='$spmu' AND LOK.NALOK = '$kolok'";
                    }
                    
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
                    
                    if($kolok=="")
                    {
                        $wh = " AND P1.SPMU IN (".$quewh.") ";    
                    }
                    else
                    {
                        $wh = " AND P1.SPMU IN (".$quewh.") AND LOK.NALOK = '$kolok'";
                    }
                    
                    
                   
                    
                }
        }
        else if($session_data['user_group'] == '10')
        {
            $wil = $session_data['kowil'];

                if ($wil == '1')
                {
                    $wh = " AND P1.KOLOK IS NOT NULL AND (P1.KOLOK LIKE '$wil%' AND SUBSTR(P1.KOLOK,2,1)!='1') ";
                }
                else if($wil == '11')
                {
                    $wh = " AND P1.KOLOK IS NOT NULL AND (P1.KOLOK LIKE '$wil%' AND SUBSTR(P1.KOLOK,2,1)='1') ";
                }
                else
                {
                    $wh = " AND P1.KOLOK IS NOT NULL AND P1.KOLOK LIKE '$wil%' ";
                }
        }
        else if($session_data['user_group'] == '47')
        {
            $idukpd = $session_data['id'];
                 $cekkolok = "SELECT a.kolok,a.nalok,a.spmu,a.kode_unit_sipkd,b.\"user_id\" 
                        from pers_klogad3 a
                        LEFT JOIN \"master_user\" b on a.kode_unit_sipkd = b.\"user_id\" 
                        where b.\"user_id\" = '$idukpd'";
                        //die($cekkolok);
                $querycekkolok = $this->db->query($cekkolok);
                if($querycekkolok) 
                {
                    $reskolok=$querycekkolok->row()->KOLOK;
                    $wh=" AND (P1.KLOGAD = '$reskolok' OR P1.KOLOK IN (SELECT KOLOK FROM UNIT_DISDIK WHERE KOLOK_SUDIN='$reskolok'))";   
                }
                else
                {
                    $wh=" AND 5=5";    
                }
        }
        else
        {
            $wh = " AND 2=2";
        }
        
        $sql = "SELECT  
                        count(*) ct
                        FROM
                            PERS_PEGAWAI1 P1
                        INNER JOIN PERS_SKP A ON A.NRK = P1.NRK 
                        INNER JOIN PERS_KLOGAD3 LOK ON P1.KLOGAD = LOK.KOLOK
                        
                        WHERE A.TAHUN = '$tahun' AND A.STATUS_VALIDASI = 0 AND (P1.kdmati <> 'Y' OR P1.KDMATI IS NULL) AND P1.KLOGAD NOT LIKE '1111111%' AND P1.NRK < 999999
                AND P1.NRK NOT IN (25310,199412,999000,885649,805171,666666,611722,576008,555555,537176,470045,441138,435023,412002,409579,376263,353515,
                333333,321095,317668,266407,250204,222222,217208,200558,199412
                ) $wh ORDER BY P1.NRK";

        
        $query = $this->db->query($sql);

        return $query->result();
    }

    function getDataSKPBelumValidasi($tahun,$kolok,$spmu=null)
    {
        $session_data       = $this->session->userdata('logged_in');

        $wh="";
        if($session_data['user_group'] == '2' || $session_data['user_group'] == '26')
        {
            if($spmu!=null)
            {
                if($kolok=="" || $kolok =="all")
                {
                    $wh = " AND LOK.SPMU = '$spmu'";
                }
                else
                {
                    $wh = " AND LOK.SPMU = '$spmu' AND LOK.NALOK = '$kolok'";
                }
            }
            else
            {
                $wh = " AND 3=3";   
            }
            
        }
        else if($session_data['user_group'] == '5')
        {
                $username =$session_data['id'];

                $getspmu = "SELECT * FROM PERS_TABEL_SPMU WHERE KODE_UNIT_SIPKD ='$username'";
                $querygetspmu = $this->db->query($getspmu);
                $numspm = $querygetspmu->num_rows();

                if($numspm == 0)
                {
                    $wh = " AND 1=1 ";
                }
                else if($numspm == 1)
                {
                    $spmu = $querygetspmu->row()->KODE_SPM;

                    if($kolok == "")
                    {
                        $wh = " AND P1.SPMU='$spmu' ";    
                    }
                    else
                    {
                        $wh = " AND P1.SPMU='$spmu' AND LOK.NALOK = '$kolok'";
                    }
                    
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
                    
                    if($kolok == "")
                    {
                        $wh = " AND P1.SPMU IN (".$quewh.") ";
                    }
                    else
                    {
                        $wh = " AND P1.SPMU IN (".$quewh.") AND LOK.NALOK ='$kolok' ";
                    }
                    
                    
                   
                    
                }
        }
        else if($session_data['user_group'] == '10')
        {
            $wil = $session_data['kowil'];

                if ($wil == '1')
                {
                    $wh = " AND P1.KOLOK IS NOT NULL AND (P1.KOLOK LIKE '$wil%' AND SUBSTR(P1.KOLOK,2,1)!='1') ";
                }
                else if($wil == '11')
                {
                    $wh = " AND P1.KOLOK IS NOT NULL AND (P1.KOLOK LIKE '$wil%' AND SUBSTR(P1.KOLOK,2,1)='1') ";
                }
                else
                {
                    $wh = " AND P1.KOLOK IS NOT NULL AND P1.KOLOK LIKE '$wil%' ";
                }
        }
        else if($session_data['user_group'] == '47')
        {
            $idukpd = $session_data['id'];
                 $cekkolok = "SELECT a.kolok,a.nalok,a.spmu,a.kode_unit_sipkd,b.\"user_id\" 
                        from pers_klogad3 a
                        LEFT JOIN \"master_user\" b on a.kode_unit_sipkd = b.\"user_id\" 
                        where b.\"user_id\" = '$idukpd'";
                        //die($cekkolok);
                $querycekkolok = $this->db->query($cekkolok);
                if($querycekkolok) 
                {
                    $reskolok=$querycekkolok->row()->KOLOK;
                    $wh=" AND (P1.KLOGAD = '$reskolok' OR P1.KOLOK IN (SELECT KOLOK FROM UNIT_DISDIK WHERE KOLOK_SUDIN='$reskolok'))";   
                }
                else
                {
                    $wh=" AND 5=5";    
                }
        }
        else
        {
            $wh = " AND 2=2";
        }
        
        $sql = "SELECT  
                        P1 .NRK,
                        P1. NAMA,
                        P1. KLOGAD,
                        LOK.NALOK AS NALOKL,
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
                        A. INPUT_SKP,
                        A. RATA2
                        FROM
                            PERS_PEGAWAI1 P1
                        INNER JOIN PERS_SKP A ON A.NRK = P1.NRK 
                        INNER JOIN PERS_KLOGAD3 LOK ON P1.KLOGAD = LOK.KOLOK
                        
                        WHERE A.TAHUN = '$tahun' AND A.STATUS_VALIDASI = 0 AND (P1.kdmati <> 'Y' OR P1.KDMATI IS NULL) AND P1.KLOGAD NOT LIKE '1111111%' AND P1.NRK < 999999
                AND P1.NRK NOT IN (25310,199412,999000,885649,805171,666666,611722,576008,555555,537176,470045,441138,435023,412002,409579,376263,353515,
                333333,321095,317668,266407,250204,222222,217208,200558,199412
                ) $wh ORDER BY P1.NRK";

        //die($sql);
        $query = $this->db->query($sql);

        return $query->result();
    }

    function getCtDataSKPSudahValidasi($tahun,$kolok,$spmu=null)
    {
        $session_data       = $this->session->userdata('logged_in');

        $wh="";
        if($session_data['user_group'] == '2' || $session_data['user_group'] == '26')
        {
            if($spmu!=null)
            {
                if($kolok=="" || $kolok =="all")
                {
                    $wh = " AND LOK.SPMU = '$spmu'";
                }
                else
                {
                    $wh = " AND LOK.SPMU = '$spmu' AND LOK.NALOK = '$kolok'";
                }
            }
            else
            {
                $wh = " AND 3=3";   
            }
            
        }
        else if($session_data['user_group'] == '5')
        {
                $username =$session_data['id'];

                $getspmu = "SELECT * FROM PERS_TABEL_SPMU WHERE KODE_UNIT_SIPKD ='$username'";
                $querygetspmu = $this->db->query($getspmu);
                $numspm = $querygetspmu->num_rows();

                if($numspm == 0)
                {
                    $wh = " AND 1=1 ";
                }
                else if($numspm == 1)
                {
                    $spmu = $querygetspmu->row()->KODE_SPM;

                    if($kolok == "")
                    {
                        $wh = " AND P1.SPMU='$spmu' ";    
                    }
                    else
                    {
                        $wh = " AND P1.SPMU='$spmu' AND LOK.NALOK = '$kolok'";
                    }
                    
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
                    
                    if($kolok == "")
                    {
                        $wh = " AND P1.SPMU IN (".$quewh.") ";
                    }
                    else
                    {
                        $wh = " AND P1.SPMU IN (".$quewh.") AND LOK.NALOK = '$kolok'";
                    }
                    
                    
                   
                    
                }
        }
        else if($session_data['user_group'] == '10')
        {
            $wil = $session_data['kowil'];

                if ($wil == '1')
                {
                    $wh = " AND P1.KOLOK IS NOT NULL AND (P1.KOLOK LIKE '$wil%' AND SUBSTR(P1.KOLOK,2,1)!='1') ";
                }
                else if($wil == '11')
                {
                    $wh = " AND P1.KOLOK IS NOT NULL AND (P1.KOLOK LIKE '$wil%' AND SUBSTR(P1.KOLOK,2,1)='1') ";
                }
                else
                {
                    $wh = " AND P1.KOLOK IS NOT NULL AND P1.KOLOK LIKE '$wil%' ";
                }
        }
        else if($session_data['user_group'] == '47')
        {
            $idukpd = $session_data['id'];
                 $cekkolok = "SELECT a.kolok,a.nalok,a.spmu,a.kode_unit_sipkd,b.\"user_id\" 
                        from pers_klogad3 a
                        LEFT JOIN \"master_user\" b on a.kode_unit_sipkd = b.\"user_id\" 
                        where b.\"user_id\" = '$idukpd'";
                        //die($cekkolok);
                $querycekkolok = $this->db->query($cekkolok);
                if($querycekkolok) 
                {
                    $reskolok=$querycekkolok->row()->KOLOK;
                    $wh=" AND (P1.KLOGAD = '$reskolok' OR P1.KOLOK IN (SELECT KOLOK FROM UNIT_DISDIK WHERE KOLOK_SUDIN='$reskolok'))";   
                }
                else
                {
                    $wh=" AND 5=5";    
                }
        }
        else
        {
            $wh = " AND 2=2";
        }

       $sql = "SELECT  count(*) ct
                        FROM
                            PERS_PEGAWAI1 P1
                        INNER JOIN PERS_SKP A ON A.NRK = P1.NRK 
                        INNER JOIN PERS_KLOGAD3 LOK ON P1.KLOGAD = LOK.KOLOK
                        
                        WHERE (P1.kdmati <> 'Y' OR P1.KDMATI IS NULL) AND P1.KLOGAD NOT LIKE '1111111%' AND P1.NRK < 999999
                AND P1.NRK NOT IN (25310,199412,999000,885649,805171,666666,611722,576008,555555,537176,470045,441138,435023,412002,409579,376263,353515,
                333333,321095,317668,266407,250204,222222,217208,200558,199412
                )
                        AND A.TAHUN = '$tahun' AND A.STATUS_VALIDASI = 1 $wh ORDER BY P1.NRK";

        

        $query = $this->db->query($sql);

        return $query->result();
    }

    function getDataSKPSudahValidasi($tahun,$kolok,$spmu=null)
    {
        $session_data       = $this->session->userdata('logged_in');

        $wh="";
        if($session_data['user_group'] == '2' || $session_data['user_group'] == '26')
        {
            if($spmu!=null)
            {
                if($kolok=="" || $kolok =="all")
                {
                    $wh = " AND LOK.SPMU = '$spmu'";
                }
                else
                {
                    $wh = " AND LOK.SPMU = '$spmu' AND LOK.NALOK = '$kolok'";
                }
            }
            else
            {
                $wh = " AND 3=3";   
            }
        }
        else if($session_data['user_group'] == '5')
        {
                $username =$session_data['id'];

                $getspmu = "SELECT * FROM PERS_TABEL_SPMU WHERE KODE_UNIT_SIPKD ='$username'";
                $querygetspmu = $this->db->query($getspmu);
                $numspm = $querygetspmu->num_rows();

                if($numspm == 0)
                {
                    $wh = " AND 1=1 ";
                }
                else if($numspm == 1)
                {
                    $spmu = $querygetspmu->row()->KODE_SPM;

                    if($kolok == "")
                    {
                        $wh = " AND P1.SPMU='$spmu' ";
                    }
                    else
                    {
                        $wh = " AND P1.SPMU='$spmu' AND LOK.NALOK = '$kolok'";
                    }
                    
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
                    

                    if($kolok == "")
                    {
                        $wh = " AND P1.SPMU IN (".$quewh.") ";
                    }
                    else
                    {
                        $wh = " AND P1.SPMU IN (".$quewh.") AND LOK.NALOK = '$kolok'";   
                    }
                    
                    
                   
                    
                }
        }
        else if($session_data['user_group'] == '10')
        {
            $wil = $session_data['kowil'];

                if ($wil == '1')
                {
                    $wh = " AND P1.KOLOK IS NOT NULL AND (P1.KOLOK LIKE '$wil%' AND SUBSTR(P1.KOLOK,2,1)!='1') ";
                }
                else if($wil == '11')
                {
                    $wh = " AND P1.KOLOK IS NOT NULL AND (P1.KOLOK LIKE '$wil%' AND SUBSTR(P1.KOLOK,2,1)='1') ";
                }
                else
                {
                    $wh = " AND P1.KOLOK IS NOT NULL AND P1.KOLOK LIKE '$wil%' ";
                }
        }
        else if($session_data['user_group'] == '47')
        {
            $idukpd = $session_data['id'];
                 $cekkolok = "SELECT a.kolok,a.nalok,a.spmu,a.kode_unit_sipkd,b.\"user_id\" 
                        from pers_klogad3 a
                        LEFT JOIN \"master_user\" b on a.kode_unit_sipkd = b.\"user_id\" 
                        where b.\"user_id\" = '$idukpd'";
                        //die($cekkolok);
                $querycekkolok = $this->db->query($cekkolok);
                if($querycekkolok) 
                {
                    $reskolok=$querycekkolok->row()->KOLOK;
                    $wh=" AND (P1.KLOGAD = '$reskolok' OR P1.KOLOK IN (SELECT KOLOK FROM UNIT_DISDIK WHERE KOLOK_SUDIN='$reskolok'))";   
                }
                else
                {
                    $wh=" AND 5=5";    
                }
        }
        else
        {
            $wh = " AND 2=2";
        }

       $sql = "SELECT  
                        P1 .NRK,
                        P1. NAMA,
                        P1. KLOGAD,
                        LOK.NALOK AS NALOKL,
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
                        A. RATA2,
                        A. INPUT_SKP
                        FROM
                            PERS_PEGAWAI1 P1
                        INNER JOIN PERS_SKP A ON A.NRK = P1.NRK 
                        INNER JOIN PERS_KLOGAD3 LOK ON P1.KLOGAD = LOK.KOLOK
                        
                        WHERE (P1.kdmati <> 'Y' OR P1.KDMATI IS NULL) AND P1.KLOGAD NOT LIKE '1111111%' AND P1.NRK < 999999
                AND P1.NRK NOT IN (25310,199412,999000,885649,805171,666666,611722,576008,555555,537176,470045,441138,435023,412002,409579,376263,353515,
                333333,321095,317668,266407,250204,222222,217208,200558,199412
                )
                        AND A.TAHUN = '$tahun' AND A.STATUS_VALIDASI = 1 $wh ORDER BY P1.NRK";

        

        $query = $this->db->query($sql);

        return $query->result();
    }

    function getCtDataSKPBelumInput($tahun,$kolok,$spmu=null)
    {
        $session_data       = $this->session->userdata('logged_in');


        $wh="";
        if($session_data['user_group'] == '2' || $session_data['user_group'] == '26')
        {
            if($spmu!=null)
            {
                if($kolok=="" || $kolok =="all")
                {
                    $wh = " AND LOK.SPMU = '$spmu'";
                }
                else
                {
                    $wh = " AND LOK.SPMU = '$spmu' AND LOK.NALOK = '$kolok'";
                }
            }
            else
            {
                $wh = " AND 3=3";   
            }
            
        }
        else if($session_data['user_group'] == '5')
        {
                $username =$session_data['id'];

                $getspmu = "SELECT * FROM PERS_TABEL_SPMU WHERE KODE_UNIT_SIPKD ='$username'";
                $querygetspmu = $this->db->query($getspmu);
                $numspm = $querygetspmu->num_rows();

                if($numspm == 0)
                {
                    $wh = " AND 1=1 ";
                }
                else if($numspm == 1)
                {
                    $spmu = $querygetspmu->row()->KODE_SPM;

                    if($kolok == "")
                    {
                        $wh = " AND P1.SPMU='$spmu' ";
                    }
                    else
                    {
                        $wh = " AND P1.SPMU='$spmu' AND LOK.NALOK ='$kolok' ";
                    }
                    
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
                    
                    if($kolok == "")
                    {
                        $wh = " AND P1.SPMU IN (".$quewh.") ";
                    }
                    else
                    {
                        $wh = " AND P1.SPMU IN (".$quewh.") AND LOK.NALOK = '$kolok' ";
                    }
                    
                    
                   
                    
                }
        }
        else if($session_data['user_group'] == '10')
        {
            $wil = $session_data['kowil'];

                if ($wil == '1')
                {
                    $wh = " AND P1.KOLOK IS NOT NULL AND (P1.KOLOK LIKE '$wil%' AND SUBSTR(P1.KOLOK,2,1)!='1') ";
                }
                else if($wil == '11')
                {
                    $wh = " AND P1.KOLOK IS NOT NULL AND (P1.KOLOK LIKE '$wil%' AND SUBSTR(P1.KOLOK,2,1)='1') ";
                }
                else
                {
                    $wh = " AND P1.KOLOK IS NOT NULL AND P1.KOLOK LIKE '$wil%' ";
                }
        }
        else if($session_data['user_group'] == '47')
        {
            $idukpd = $session_data['id'];
                 $cekkolok = "SELECT a.kolok,a.nalok,a.spmu,a.kode_unit_sipkd,b.\"user_id\" 
                        from pers_klogad3 a
                        LEFT JOIN \"master_user\" b on a.kode_unit_sipkd = b.\"user_id\" 
                        where b.\"user_id\" = '$idukpd'";
                        //die($cekkolok);
                $querycekkolok = $this->db->query($cekkolok);
                if($querycekkolok) 
                {
                    $reskolok=$querycekkolok->row()->KOLOK;
                    $wh=" AND (P1.KLOGAD = '$reskolok' OR P1.KOLOK IN (SELECT KOLOK FROM UNIT_DISDIK WHERE KOLOK_SUDIN='$reskolok'))";   
                }
                else
                {
                    $wh=" AND 5=5";    
                }
        }
        else
        {
            $wh = " AND 2=2";
        }

         $sql = "SELECT   
                        count(*) ct
                        FROM PERS_PEGAWAI1 P1 
                        INNER JOIN PERS_KLOGAD3 LOK ON P1.KLOGAD = LOK.KOLOK
                        
                        where (P1.kdmati <> 'Y' OR P1.KDMATI IS NULL) AND P1.KLOGAD NOT LIKE '1111111%'
            and not exists (select s.nrk from pers_skp s where s.tahun='$tahun' and P1.nrk =s.nrk ) AND P1.NRK < 999999
                AND P1.NRK NOT IN (25310,199412,999000,885649,805171,666666,611722,576008,555555,537176,470045,441138,435023,412002,409579,376263,353515,
                333333,321095,317668,266407,250204,222222,217208,200558,199412
                ) $wh ORDER BY P1.NRK";

        
        
        $query = $this->db->query($sql);

        return $query->result();
    }

    function getDataSKPBelumInput($tahun,$kolok,$spmu=null)
    {
        $session_data       = $this->session->userdata('logged_in');

        $wh="";
        if($session_data['user_group'] == '2' || $session_data['user_group'] == '26')
        {
            if($spmu!=null)
            {
                if($kolok=="" || $kolok =="all")
                {
                    $wh = " AND LOK.SPMU = '$spmu'";
                }
                else
                {
                    $wh = " AND LOK.SPMU = '$spmu' AND LOK.NALOK = '$kolok'";
                }
            }
            else
            {
                $wh = " AND 3=3";   
            }
            
        }
        else if($session_data['user_group'] == '5')
        {
                $username =$session_data['id'];

                $getspmu = "SELECT * FROM PERS_TABEL_SPMU WHERE KODE_UNIT_SIPKD ='$username'";
                $querygetspmu = $this->db->query($getspmu);
                $numspm = $querygetspmu->num_rows();

                if($numspm == 0)
                {
                    $wh = " AND 1=1 ";
                }
                else if($numspm == 1)
                {
                    $spmu = $querygetspmu->row()->KODE_SPM;

                    if($kolok == "")
                    {
                        $wh = " AND P1.SPMU='$spmu' ";
                    }
                    else
                    {
                        $wh = " AND P1.SPMU='$spmu' AND LOK.NALOK = '$kolok'";
                    }
                    
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
                    
                    if($kolok == "")
                    {
                        $wh = " AND P1.SPMU IN (".$quewh.") ";
                    }
                    else
                    {
                        $wh = " AND P1.SPMU IN (".$quewh.") AND LOK.NALOK = '$kolok'";
                    }
                    
                    
                   
                    
                }
        }
        else if($session_data['user_group'] == '10')
        {
            $wil = $session_data['kowil'];

                if ($wil == '1')
                {
                    $wh = " AND P1.KOLOK IS NOT NULL AND (P1.KOLOK LIKE '$wil%' AND SUBSTR(P1.KOLOK,2,1)!='1') ";
                }
                else if($wil == '11')
                {
                    $wh = " AND P1.KOLOK IS NOT NULL AND (P1.KOLOK LIKE '$wil%' AND SUBSTR(P1.KOLOK,2,1)='1') ";
                }
                else
                {
                    $wh = " AND P1.KOLOK IS NOT NULL AND P1.KOLOK LIKE '$wil%' ";
                }
        }
        else if($session_data['user_group'] == '47')
        {
            $idukpd = $session_data['id'];
                 $cekkolok = "SELECT a.kolok,a.nalok,a.spmu,a.kode_unit_sipkd,b.\"user_id\" 
                        from pers_klogad3 a
                        LEFT JOIN \"master_user\" b on a.kode_unit_sipkd = b.\"user_id\" 
                        where b.\"user_id\" = '$idukpd'";
                        //die($cekkolok);
                $querycekkolok = $this->db->query($cekkolok);
                if($querycekkolok) 
                {
                    $reskolok=$querycekkolok->row()->KOLOK;
                    $wh=" AND (P1.KLOGAD = '$reskolok' OR P1.KOLOK IN (SELECT KOLOK FROM UNIT_DISDIK WHERE KOLOK_SUDIN='$reskolok'))";   
                }
                else
                {
                    $wh=" AND 5=5";    
                }
        }
        else
        {
            $wh = " AND 2=2";
        }

         $sql = "SELECT   
                        P1.NRK,
                        P1.NAMA,
                        P1. KLOGAD,
                        LOK.NALOK AS NALOKL,
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
                         ' ' AS INPUT_SKP
                        FROM PERS_PEGAWAI1 P1 
                        INNER JOIN PERS_KLOGAD3 LOK ON P1.KLOGAD = LOK.KOLOK
                        
                        where (P1.kdmati <> 'Y' OR P1.KDMATI IS NULL) AND P1.KLOGAD NOT LIKE '1111111%'
            and not exists (select s.nrk from pers_skp s where s.tahun='$tahun' and P1.nrk =s.nrk ) AND P1.NRK < 999999
                AND P1.NRK NOT IN (25310,199412,999000,885649,805171,666666,611722,576008,555555,537176,470045,441138,435023,412002,409579,376263,353515,
                333333,321095,317668,266407,250204,222222,217208,200558,199412
                ) $wh  ORDER BY P1.NRK";

        
        
        $query = $this->db->query($sql);

        return $query->result();
    }

   

    public function generateSPMUAktifFromPeg1()
    {
        $sql ="SELECT X.*,B.NAMA from (
                select distinct spmu from pers_pegawai1 P1 
                where (P1.kdmati <> 'Y' OR P1.KDMATI IS NULL) AND P1.KLOGAD NOT LIKE '1111111%'
                AND P1.NRK NOT IN (25310,199412,999000,885649,805171,666666,611722,576008,555555,537176,470045,441138,435023,412002,409579,376263,353515,
                                333333,321095,317668,266407,250204,222222,217208,200558,199412
                                ) ) X
                LEFT JOIN PERS_TABEL_SPMU B ON X.SPMU = B.KODE_SPM
                ORDER BY X.SPMU ASC";
        $query = $this->db->query($sql);

        return $query->result();
    }

    function getDataSKPBelumValidasi1($tahun,$kolok,$spmu=null)
    {
        $session_data       = $this->session->userdata('logged_in');

        $wh="";
        if($session_data['user_group'] == '2' || $session_data['user_group'] == '26')
        {
            if($spmu!=null)
            {
                if($kolok=="" || $kolok =="all")
                {
                    $wh = " AND LOK.SPMU = '$spmu'";
                }
                else
                {
                    $wh = " AND LOK.SPMU = '$spmu' AND LOK.NALOK = '$kolok'";
                }
            }
            else
            {
                $wh = " AND 3=3";   
            }
        }
        else if($session_data['user_group'] == '5')
        {
                $username =$session_data['id'];

                $getspmu = "SELECT * FROM PERS_TABEL_SPMU WHERE KODE_UNIT_SIPKD ='$username'";
                $querygetspmu = $this->db->query($getspmu);
                $numspm = $querygetspmu->num_rows();

                if($numspm == 0)
                {
                    $wh = " AND 1=1 ";
                }
                else if($numspm == 1)
                {
                    $spmu = $querygetspmu->row()->KODE_SPM;

                    if($kolok == '')
                    {
                        $wh = " AND P1.SPMU='$spmu' ";
                    }
                    else
                    {
                        $wh = " AND P1.SPMU='$spmu' AND LOK.NALOK = '$kolok' ";
                    }
                    
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
                    
                    if($kolok == '')
                    {
                        $wh = " AND P1.SPMU IN (".$quewh.") ";
                    }
                    else
                    {
                        $wh = " AND P1.SPMU IN (".$quewh.") AND LOK.NALOK = '$kolok' ";
                    }
                    
                    
                   
                    
                }
        }
        else if($session_data['user_group'] == '10')
        {
            $wil = $session_data['kowil'];

                if ($wil == '1')
                {
                    $wh = " AND P1.KOLOK IS NOT NULL AND (P1.KOLOK LIKE '$wil%' AND SUBSTR(P1.KOLOK,2,1)!='1') ";
                }
                else if($wil == '11')
                {
                    $wh = " AND P1.KOLOK IS NOT NULL AND (P1.KOLOK LIKE '$wil%' AND SUBSTR(P1.KOLOK,2,1)='1') ";
                }
                else
                {
                    $wh = " AND P1.KOLOK IS NOT NULL AND P1.KOLOK LIKE '$wil%' ";
                }
        }
        else if($session_data['user_group'] == '47')
        {
            $idukpd = $session_data['id'];
                 $cekkolok = "SELECT a.kolok,a.nalok,a.spmu,a.kode_unit_sipkd,b.\"user_id\" 
                        from pers_klogad3 a
                        LEFT JOIN \"master_user\" b on a.kode_unit_sipkd = b.\"user_id\" 
                        where b.\"user_id\" = '$idukpd'";
                        //die($cekkolok);
                $querycekkolok = $this->db->query($cekkolok);
                if($querycekkolok) 
                {
                    $reskolok=$querycekkolok->row()->KOLOK;
                    $wh=" AND (P1.KLOGAD = '$reskolok' OR P1.KOLOK IN (SELECT KOLOK FROM UNIT_DISDIK WHERE KOLOK_SUDIN='$reskolok'))";   
                }
                else
                {
                    $wh=" AND 5=5";    
                }
        }
        else
        {
            $wh = " AND 2=2";
        }
        
        $sql = "SELECT  
                        P1 .NRK,
                        P1. NAMA,
                        P1. KLOGAD,
                        LOK.NALOK AS NALOKL,
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
                        A. INPUT_SKP,
                        A. RATA2
                        FROM
                            PERS_PEGAWAI1 P1
                        INNER JOIN PERS_SKP A ON A.NRK = P1.NRK 
                        INNER JOIN PERS_KLOGAD3 LOK ON P1.KLOGAD = LOK.KOLOK
                        
                        WHERE A.TAHUN = '$tahun' AND A.STATUS_VALIDASI = 0 AND (P1.kdmati <> 'Y' OR P1.KDMATI IS NULL) AND P1.KLOGAD NOT LIKE '1111111%' AND P1.NRK < 178500
                AND P1.NRK NOT IN (25310,199412,999000,885649,805171,666666,611722,576008,555555,537176,470045,441138,435023,412002,409579,376263,353515,
                333333,321095,317668,266407,250204,222222,217208,200558,199412
                ) $wh ORDER BY P1.NRK";

        
        $query = $this->db->query($sql);

        return $query->result();
    }

    function getDataSKPBelumValidasi2($tahun,$kolok,$spmu=null)
    {
        $session_data       = $this->session->userdata('logged_in');

        $wh="";
        if($session_data['user_group'] == '2' || $session_data['user_group'] == '26')
        {
            if($spmu!=null)
            {
                if($kolok=="" || $kolok =="all")
                {
                    $wh = " AND LOK.SPMU = '$spmu'";
                }
                else
                {
                    $wh = " AND LOK.SPMU = '$spmu' AND LOK.NALOK = '$kolok'";
                }
            }
            else
            {
                $wh = " AND 3=3";   
            }
            
        }
        else if($session_data['user_group'] == '5')
        {
                $username =$session_data['id'];

                $getspmu = "SELECT * FROM PERS_TABEL_SPMU WHERE KODE_UNIT_SIPKD ='$username'";
                $querygetspmu = $this->db->query($getspmu);
                $numspm = $querygetspmu->num_rows();

                if($numspm == 0)
                {
                    $wh = " AND 1=1 ";
                }
                else if($numspm == 1)
                {
                    $spmu = $querygetspmu->row()->KODE_SPM;
                    if($kolok == "")
                    {
                        $wh = " AND P1.SPMU='$spmu' ";
                    }
                    else
                    {
                        $wh = " AND P1.SPMU='$spmu' AND LOK.NALOK ='$kolok' ";
                    }
                    

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
                    if($kolok == '')
                    {
                        $wh = " AND P1.SPMU IN (".$quewh.") ";
                    }
                    else
                    {
                        $wh = " AND P1.SPMU IN (".$quewh.") and LOK.NALOK = '$kolok'";
                    }
                    
                    
                   
                    
                }
        }
        else if($session_data['user_group'] == '10')
        {
            $wil = $session_data['kowil'];

                if ($wil == '1')
                {
                    $wh = " AND P1.KOLOK IS NOT NULL AND (P1.KOLOK LIKE '$wil%' AND SUBSTR(P1.KOLOK,2,1)!='1') ";
                }
                else if($wil == '11')
                {
                    $wh = " AND P1.KOLOK IS NOT NULL AND (P1.KOLOK LIKE '$wil%' AND SUBSTR(P1.KOLOK,2,1)='1') ";
                }
                else
                {
                    $wh = " AND P1.KOLOK IS NOT NULL AND P1.KOLOK LIKE '$wil%' ";
                }
        }
        else if($session_data['user_group'] == '47')
        {
            $idukpd = $session_data['id'];
                 $cekkolok = "SELECT a.kolok,a.nalok,a.spmu,a.kode_unit_sipkd,b.\"user_id\" 
                        from pers_klogad3 a
                        LEFT JOIN \"master_user\" b on a.kode_unit_sipkd = b.\"user_id\" 
                        where b.\"user_id\" = '$idukpd'";
                        //die($cekkolok);
                $querycekkolok = $this->db->query($cekkolok);
                if($querycekkolok) 
                {
                    $reskolok=$querycekkolok->row()->KOLOK;
                    $wh=" AND (P1.KLOGAD = '$reskolok' OR P1.KOLOK IN (SELECT KOLOK FROM UNIT_DISDIK WHERE KOLOK_SUDIN='$reskolok'))";   
                }
                else
                {
                    $wh=" AND 5=5";    
                }
        }
        else
        {
            $wh = " AND 2=2";
        }
        
        $sql = "SELECT  
                        P1 .NRK,
                        P1. NAMA,
                        P1. KLOGAD,
                        LOK.NALOK AS NALOKL,
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
                        A. INPUT_SKP,
                        A. RATA2
                        FROM
                            PERS_PEGAWAI1 P1
                        INNER JOIN PERS_SKP A ON A.NRK = P1.NRK 
                        INNER JOIN PERS_KLOGAD3 LOK ON P1.KLOGAD = LOK.KOLOK
                        
                        WHERE A.TAHUN = '$tahun' AND A.STATUS_VALIDASI = 0 AND (P1.kdmati <> 'Y' OR P1.KDMATI IS NULL) AND P1.KLOGAD NOT LIKE '1111111%' AND P1.NRK >= 178500
                AND P1.NRK NOT IN (25310,199412,999000,885649,805171,666666,611722,576008,555555,537176,470045,441138,435023,412002,409579,376263,353515,
                333333,321095,317668,266407,250204,222222,217208,200558,199412
                ) $wh ORDER BY P1.NRK";

        
        $query = $this->db->query($sql);

        return $query->result();
    }

    function getDataSKPSudahValidasi1($tahun,$kolok,$spmu=null)
    {
        $session_data       = $this->session->userdata('logged_in');

        $wh="";
        if($session_data['user_group'] == '2' || $session_data['user_group'] == '26')
        {
            if($spmu!=null)
            {
                if($kolok=="" || $kolok =="all")
                {
                    $wh = " AND LOK.SPMU = '$spmu'";
                }
                else
                {
                    $wh = " AND LOK.SPMU = '$spmu' AND LOK.NALOK = '$kolok'";
                }
            }
            else
            {
                $wh = " AND 3=3";   
            }
            
        }
        else if($session_data['user_group'] == '5')
        {
                $username =$session_data['id'];

                $getspmu = "SELECT * FROM PERS_TABEL_SPMU WHERE KODE_UNIT_SIPKD ='$username'";
                $querygetspmu = $this->db->query($getspmu);
                $numspm = $querygetspmu->num_rows();

                if($numspm == 0)
                {
                    $wh = " AND 1=1 ";
                }
                else if($numspm == 1)
                {
                    $spmu = $querygetspmu->row()->KODE_SPM;

                    if($kolok == "")
                    {
                        $wh = " AND P1.SPMU='$spmu' ";
                    }
                    else
                    {
                        $wh = " AND P1.SPMU='$spmu' AND LOK.NALOK = '$kolok'";
                    }
                    
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
                    if($kolok == "")
                    {
                        $wh = " AND P1.SPMU IN (".$quewh.") ";
                    }
                    else
                    {
                        $wh = " AND P1.SPMU IN (".$quewh.") AND LOK.NALOK = '$kolok'";
                    }
                    
                    
                   
                    
                }
        }
        else if($session_data['user_group'] == '10' )
        {
            $wil = $session_data['kowil'];

                if ($wil == '1')
                {
                    $wh = " AND P1.KOLOK IS NOT NULL AND (P1.KOLOK LIKE '$wil%' AND SUBSTR(P1.KOLOK,2,1)!='1') ";
                }
                else if($wil == '11')
                {
                    $wh = " AND P1.KOLOK IS NOT NULL AND (P1.KOLOK LIKE '$wil%' AND SUBSTR(P1.KOLOK,2,1)='1') ";
                }
                else
                {
                    $wh = " AND P1.KOLOK IS NOT NULL AND P1.KOLOK LIKE '$wil%' ";
                }
        }
        else if($session_data['user_group'] == '47')
        {
            $idukpd = $session_data['id'];
                 $cekkolok = "SELECT a.kolok,a.nalok,a.spmu,a.kode_unit_sipkd,b.\"user_id\" 
                        from pers_klogad3 a
                        LEFT JOIN \"master_user\" b on a.kode_unit_sipkd = b.\"user_id\" 
                        where b.\"user_id\" = '$idukpd'";
                        //die($cekkolok);
                $querycekkolok = $this->db->query($cekkolok);
                if($querycekkolok) 
                {
                    $reskolok=$querycekkolok->row()->KOLOK;
                    $wh=" AND (P1.KLOGAD = '$reskolok' OR P1.KOLOK IN (SELECT KOLOK FROM UNIT_DISDIK WHERE KOLOK_SUDIN='$reskolok'))";   
                }
                else
                {
                    $wh=" AND 5=5";    
                }
        }
        else
        {
            $wh = " AND 2=2";
        }

       $sql = "SELECT  
                        P1 .NRK,
                        P1. NAMA,
                        P1. KLOGAD,
                        LOK.NALOK AS NALOKL,
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
                        A. RATA2,
                        A. INPUT_SKP
                        FROM
                            PERS_PEGAWAI1 P1
                        INNER JOIN PERS_SKP A ON A.NRK = P1.NRK 
                        INNER JOIN PERS_KLOGAD3 LOK ON P1.KLOGAD = LOK.KOLOK
                        
                        WHERE (P1.kdmati <> 'Y' OR P1.KDMATI IS NULL) AND P1.KLOGAD NOT LIKE '1111111%' AND P1.NRK < 178500
                AND P1.NRK NOT IN (25310,199412,999000,885649,805171,666666,611722,576008,555555,537176,470045,441138,435023,412002,409579,376263,353515,
                333333,321095,317668,266407,250204,222222,217208,200558,199412
                )
                        AND A.TAHUN = '$tahun' AND A.STATUS_VALIDASI = 1 $wh ORDER BY P1.NRK";

        

        $query = $this->db->query($sql);

        return $query->result();
    }

    function getDataSKPSudahValidasi2($tahun,$kolok,$spmu=null)
    {
        $session_data       = $this->session->userdata('logged_in');

        $wh="";
        if($session_data['user_group'] == '2' || $session_data['user_group'] == '26')
        {
            if($spmu!=null)
            {
                if($kolok=="" || $kolok =="all")
                {
                    $wh = " AND LOK.SPMU = '$spmu'";
                }
                else
                {
                    $wh = " AND LOK.SPMU = '$spmu' AND LOK.NALOK = '$kolok'";
                }
            }
            else
            {
                $wh = " AND 3=3";   
            }
            
        }
        else if($session_data['user_group'] == '5')
        {
                $username =$session_data['id'];

                $getspmu = "SELECT * FROM PERS_TABEL_SPMU WHERE KODE_UNIT_SIPKD ='$username'";
                $querygetspmu = $this->db->query($getspmu);
                $numspm = $querygetspmu->num_rows();

                if($numspm == 0)
                {
                    $wh = " AND 1=1 ";
                }
                else if($numspm == 1)
                {
                    $spmu = $querygetspmu->row()->KODE_SPM;

                    if($kolok == "")
                    {
                        $wh = " AND P1.SPMU='$spmu' ";
                    }
                    else
                    {
                        $wh = " AND P1.SPMU='$spmu' AND LOK.NALOK = '$kolok'";
                    }
                    
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
                    
                    $wh = " AND P1.SPMU IN (".$quewh.") ";
                    
                   
                    
                }
        }
        else if($session_data['user_group'] == '10')
        {
            $wil = $session_data['kowil'];

                if ($wil == '1')
                {
                    $wh = " AND P1.KOLOK IS NOT NULL AND (P1.KOLOK LIKE '$wil%' AND SUBSTR(P1.KOLOK,2,1)!='1') ";
                }
                else if($wil == '11')
                {
                    $wh = " AND P1.KOLOK IS NOT NULL AND (P1.KOLOK LIKE '$wil%' AND SUBSTR(P1.KOLOK,2,1)='1') ";
                }
                else
                {
                    $wh = " AND P1.KOLOK IS NOT NULL AND P1.KOLOK LIKE '$wil%' ";
                }
        }
        else if($session_data['user_group'] == '47')
        {
            $idukpd = $session_data['id'];
                 $cekkolok = "SELECT a.kolok,a.nalok,a.spmu,a.kode_unit_sipkd,b.\"user_id\" 
                        from pers_klogad3 a
                        LEFT JOIN \"master_user\" b on a.kode_unit_sipkd = b.\"user_id\" 
                        where b.\"user_id\" = '$idukpd'";
                        //die($cekkolok);
                $querycekkolok = $this->db->query($cekkolok);
                if($querycekkolok) 
                {
                    $reskolok=$querycekkolok->row()->KOLOK;
                    $wh=" AND (P1.KLOGAD = '$reskolok' OR P1.KOLOK IN (SELECT KOLOK FROM UNIT_DISDIK WHERE KOLOK_SUDIN='$reskolok'))";   
                }
                else
                {
                    $wh=" AND 5=5";    
                }
        }
        else
        {
            $wh = " AND 2=2";
        }

       $sql = "SELECT  
                        P1 .NRK,
                        P1. NAMA,
                        P1. KLOGAD,
                        LOK.NALOK AS NALOKL,
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
                        A. RATA2,
                        A. INPUT_SKP
                        FROM
                            PERS_PEGAWAI1 P1
                        INNER JOIN PERS_SKP A ON A.NRK = P1.NRK 
                        INNER JOIN PERS_KLOGAD3 LOK ON P1.KLOGAD = LOK.KOLOK
                        
                        WHERE (P1.kdmati <> 'Y' OR P1.KDMATI IS NULL) AND P1.KLOGAD NOT LIKE '1111111%' AND P1.NRK >= 178500
                AND P1.NRK NOT IN (25310,199412,999000,885649,805171,666666,611722,576008,555555,537176,470045,441138,435023,412002,409579,376263,353515,
                333333,321095,317668,266407,250204,222222,217208,200558,199412
                )
                        AND A.TAHUN = '$tahun' AND A.STATUS_VALIDASI = 1 $wh ORDER BY P1.NRK";

        

        $query = $this->db->query($sql);

        return $query->result();
    }


    function getDataSKPBelumInput1($tahun,$kolok,$spmu=null)
    {
        $session_data       = $this->session->userdata('logged_in');

        $wh="";
        if($session_data['user_group'] == '2' || $session_data['user_group'] == '26')
        {
            if($spmu!=null)
            {
                if($kolok=="" || $kolok =="all")
                {
                    $wh = " AND LOK.SPMU = '$spmu'";
                }
                else
                {
                    $wh = " AND LOK.SPMU = '$spmu' AND LOK.NALOK = '$kolok'";
                }
            }
            else
            {
                $wh = " AND 3=3";   
            }
            
        }
        else if($session_data['user_group'] == '5')
        {
                $username =$session_data['id'];

                $getspmu = "SELECT * FROM PERS_TABEL_SPMU WHERE KODE_UNIT_SIPKD ='$username'";
                $querygetspmu = $this->db->query($getspmu);
                $numspm = $querygetspmu->num_rows();

                if($numspm == 0)
                {
                    $wh = " AND 1=1 ";
                }
                else if($numspm == 1)
                {
                    $spmu = $querygetspmu->row()->KODE_SPM;

                    if($kolok == "")
                    {
                        $wh = " AND P1.SPMU='$spmu' ";
                    }
                    else
                    {
                        $wh = " AND P1.SPMU='$spmu' AND LOK.NALOK = '$kolok'";
                    }
                    
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
                    
                    if($kolok == "")
                    {
                        $wh = " AND P1.SPMU IN (".$quewh.") ";    
                    }
                    else
                    {
                        $wh = " AND P1.SPMU IN (".$quewh.") and LOK.NALOK = '$kolok' ";
                    }
                    
                    
                   
                    
                }
        }
        else if($session_data['user_group'] == '10')
        {
            $wil = $session_data['kowil'];

                if ($wil == '1')
                {
                    $wh = " AND P1.KOLOK IS NOT NULL AND (P1.KOLOK LIKE '$wil%' AND SUBSTR(P1.KOLOK,2,1)!='1') ";
                }
                else if($wil == '11')
                {
                    $wh = " AND P1.KOLOK IS NOT NULL AND (P1.KOLOK LIKE '$wil%' AND SUBSTR(P1.KOLOK,2,1)='1') ";
                }
                else
                {
                    $wh = " AND P1.KOLOK IS NOT NULL AND P1.KOLOK LIKE '$wil%' ";
                }
        }
        else if($session_data['user_group'] == '47')
        {
            $idukpd = $session_data['id'];
                 $cekkolok = "SELECT a.kolok,a.nalok,a.spmu,a.kode_unit_sipkd,b.\"user_id\" 
                        from pers_klogad3 a
                        LEFT JOIN \"master_user\" b on a.kode_unit_sipkd = b.\"user_id\" 
                        where b.\"user_id\" = '$idukpd'";
                        //die($cekkolok);
                $querycekkolok = $this->db->query($cekkolok);
                if($querycekkolok) 
                {
                    $reskolok=$querycekkolok->row()->KOLOK;
                    $wh=" AND (P1.KLOGAD = '$reskolok' OR P1.KOLOK IN (SELECT KOLOK FROM UNIT_DISDIK WHERE KOLOK_SUDIN='$reskolok'))";   
                }
                else
                {
                    $wh=" AND 5=5";    
                }
        }
        else
        {
            $wh = " AND 2=2";
        }

         $sql = "SELECT   
                        P1.NRK,
                        P1.NAMA,
                        P1. KLOGAD,
                        LOK.NALOK AS NALOKL,
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
                         ' ' AS INPUT_SKP
                        FROM PERS_PEGAWAI1 P1 
                       INNER JOIN PERS_KLOGAD3 LOK ON P1.KLOGAD = LOK.KOLOK
                        
                        where (P1.kdmati <> 'Y' OR P1.KDMATI IS NULL) AND P1.KLOGAD NOT LIKE '1111111%'
            and not exists (select s.nrk from pers_skp s where s.tahun='$tahun' and P1.nrk =s.nrk ) AND P1.NRK < 178500
                AND P1.NRK NOT IN (25310,199412,999000,885649,805171,666666,611722,576008,555555,537176,470045,441138,435023,412002,409579,376263,353515,
                333333,321095,317668,266407,250204,222222,217208,200558,199412
                ) $wh and ROWNUM<50000  ORDER BY P1.NRK";

        
        
        $query = $this->db->query($sql);

        return $query->result();
    }

    function getDataSKPBelumInput2($tahun,$kolok,$spmu=null)
    {
        $session_data       = $this->session->userdata('logged_in');

        $wh="";
        if($session_data['user_group'] == '2' || $session_data['user_group'] == '26')
        {
            if($spmu!=null)
            {
                if($kolok=="" || $kolok =="all")
                {
                    $wh = " AND LOK.SPMU = '$spmu'";
                }
                else
                {
                    $wh = " AND LOK.SPMU = '$spmu' AND LOK.NALOK = '$kolok'";
                }
            }
            else
            {
                $wh = " AND 3=3";   
            }
            
        }
        else if($session_data['user_group'] == '5')
        {
                $username =$session_data['id'];

                $getspmu = "SELECT * FROM PERS_TABEL_SPMU WHERE KODE_UNIT_SIPKD ='$username'";
                $querygetspmu = $this->db->query($getspmu);
                $numspm = $querygetspmu->num_rows();

                if($numspm == 0)
                {
                    $wh = " AND 1=1 ";
                }
                else if($numspm == 1)
                {
                    $spmu = $querygetspmu->row()->KODE_SPM;

                    if($kolok == "")
                    {
                        $wh = " AND P1.SPMU='$spmu' ";
                    }
                    else
                    {
                        $wh = " AND P1.SPMU='$spmu' AND LOK.NALOK = '$kolok' ";
                    }
                    
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
                    
                    if($kolok == "")
                    {
                        $wh = " AND P1.SPMU IN (".$quewh.") ";
                    }
                    else
                    {
                        $wh = " AND P1.SPMU IN (".$quewh.") AND LOK.NALOK = '$kolok'";
                    }
                    
                    
                   
                    
                }
        }
        else if($session_data['user_group'] == '10')
        {
            $wil = $session_data['kowil'];

                if ($wil == '1')
                {
                    $wh = " AND P1.KOLOK IS NOT NULL AND (P1.KOLOK LIKE '$wil%' AND SUBSTR(P1.KOLOK,2,1)!='1') ";
                }
                else if($wil == '11')
                {
                    $wh = " AND P1.KOLOK IS NOT NULL AND (P1.KOLOK LIKE '$wil%' AND SUBSTR(P1.KOLOK,2,1)='1') ";
                }
                else
                {
                    $wh = " AND P1.KOLOK IS NOT NULL AND P1.KOLOK LIKE '$wil%' ";
                }
        }
        else if($session_data['user_group'] == '47')
        {
            $idukpd = $session_data['id'];
                 $cekkolok = "SELECT a.kolok,a.nalok,a.spmu,a.kode_unit_sipkd,b.\"user_id\" 
                        from pers_klogad3 a
                        LEFT JOIN \"master_user\" b on a.kode_unit_sipkd = b.\"user_id\" 
                        where b.\"user_id\" = '$idukpd'";
                        //die($cekkolok);
                $querycekkolok = $this->db->query($cekkolok);
                if($querycekkolok) 
                {
                    $reskolok=$querycekkolok->row()->KOLOK;
                    $wh=" AND (P1.KLOGAD = '$reskolok' OR P1.KOLOK IN (SELECT KOLOK FROM UNIT_DISDIK WHERE KOLOK_SUDIN='$reskolok'))";   
                }
                else
                {
                    $wh=" AND 5=5";    
                }
        }
        else
        {
            $wh = " AND 2=2";
        }

         $sql = "SELECT   
                        P1.NRK,
                        P1.NAMA,
                        P1. KLOGAD,
                        LOK.NALOK AS NALOKL,
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
                         ' ' AS INPUT_SKP
                        FROM PERS_PEGAWAI1 P1 
                        INNER JOIN PERS_KLOGAD3 LOK ON P1.KLOGAD = LOK.KOLOK
                        
                        where (P1.kdmati <> 'Y' OR P1.KDMATI IS NULL) AND P1.KLOGAD NOT LIKE '1111111%'
            and not exists (select s.nrk from pers_skp s where s.tahun='$tahun' and P1.nrk =s.nrk ) AND P1.NRK >=178500 and P1.NRK<999999
                AND P1.NRK NOT IN (25310,199412,999000,885649,805171,666666,611722,576008,555555,537176,470045,441138,435023,412002,409579,376263,353515,
                333333,321095,317668,266407,250204,222222,217208,200558,199412
                ) $wh and ROWNUM<50000  ORDER BY P1.NRK";

        
        
        $query = $this->db->query($sql);

        return $query->result();
    }

     //MPP

    function getDataMPP($nrk)
    {
        $sql ="SELECT
                A .NRK,
                A. NAMA,
                A .MPP,
                TO_CHAR (A .TGLAMPP, 'DD-MM-YYYY') TGLAMPP,
                TO_CHAR (A .TGLEMPP, 'DD-MM-YYYY') TGLEMPP,
                TO_CHAR(B.TGSK, 'DD-MM-YYYY')TGSK,
                B.NOSK,
                B.PEJTT
            FROM
                PERS_PEGAWAI1 A
            LEFT JOIN PERS_JABATAN_HIST B ON A .NRK = B.NRK
            WHERE A.NRK = '$nrk' AND B.JENIS_SK = '25'
            ORDER BY B.TMT DESC";
        $query = $this->db->query($sql);

        return $query;
    }

    function inputDataMPP($data)
    {
        
        $NRK = $data['NRK'];
        $PENGINPUT = $data['penginput'];
        $TGLAMPP = $data['TGLAMPP'];
        $TGLEMPP = $data['TGLEMPP'];
        $TGLSK = $data['TGLSK'];
        $NOSK = $data['NOSK'];
        $PEJTT = $data['PEJTT'];
         $term=$this->input->ip_address(); 

        $sqlpeg1 = "UPDATE PERS_PEGAWAI1 SET TGLAMPP = TO_DATE('$TGLAMPP','DD-MM-YYYY'), TGLEMPP = TO_DATE('$TGLEMPP','DD-MM-YYYY'),MPP='Y' WHERE NRK = '$NRK'";
        
        $querypeg1 = $this->db->query($sqlpeg1);

        $sqlpegawai = "SELECT a.KOLOK,a.KLOGAD,a.SPMU, b.KOPANG
                        from PERS_PEGAWAI1 a
                        LEFT JOIN \"vw_jabatan_terakhir\" b on a.NRK = b.nrk
                        WHERE a.NRK = '$NRK'";
        $querypegawai = $this->db->query($sqlpegawai)->row();
        $KOLOK = $querypegawai->KOLOK;
        $KLOGAD = $querypegawai->KLOGAD;
        $SPMU = $querypegawai->SPMU;
        $KOPANG = $querypegawai->KOPANG;


        $sqlcekjabmpp = "SELECT * FROM PERS_JABATAN_HIST WHERE NRK = '$NRK' AND JENIS_SK='25'";
        $querycekjabmpp = $this->db->query($sqlcekjabmpp);
        $num = $querycekjabmpp->num_rows();

        $result=0;
        if($num == 0)
        {
            $sqljab = "INSERT INTO PERS_JABATAN_HIST (NRK,TMT,KOLOK,KOJAB,KDSORT,KOPANG,ESELON,PEJTT,NOSK,TGSK,KREDIT,STATUS,USER_ID,TERM,TG_UPD,KLOGAD,SPMU,JENIS_SK) VALUES ('$NRK',TO_DATE('$TGLAMPP','DD-MM-YYYY'),'$KOLOK','798981','0','$KOPANG','00','$PEJTT','$NOSK',TO_DATE('$TGLSK','DD-MM-YYYY'),'0','0','$PENGINPUT','$term',SYSDATE,'$KLOGAD','$SPMU','25')";
            
            $queryjab = $this->db->query($sqljab);

            if($queryjab)
            {
                $result =1;
            }
            else
            {
                $result = 0;
            }
        }
        else if($num == 1)
        {
            $sqljab = "UPDATE PERS_JABATAN_HIST SET TGSK = TO_DATE('$TGLSK','DD-MM-YYYY'),NOSK = '$NOSK',PEJTT = '$PEJTT' WHERE NRK ='$NRK' AND TMT = TO_DATE('".$TGLAMPP."', 'DD-MM-YYYY')";

            $queryjab = $this->db->query($sqljab);

            if($queryjab)
            {
                $result = 1;
            }
            else
            {
                $result = 0;
            }
        }
        else
        {
            $result = 0;
        }

        return $result;

    }

}

?>