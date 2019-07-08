<?php 

 class Mrekap extends CI_Model {

    var $title   = '';
    var $content = '';
    var $date    = '';

    // private $ci;
    // private $ekin;

    function __construct()
    {        
        parent::__construct();

        // $this->ci =& get_instance();
        // $this->ci->load->database();     
    }

    public function getListTHBL($thbl="")
    {
        $sql="SELECT DISTINCT THBL from Pers_duk_pangkat_histduk where substr(thbl,5,2) in('01','02','03','04','05','06','07','08','09','10','11','12','13') order by thbl desc";

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

    public function getListTHBLTKD($thbl="")
    {
        $sql="SELECT DISTINCT THBL from PROSES_TKD_TAHAP2 where substr(thbl,5,2) in('01','02','03','04','05','06','07','08','09','10','11','12','13') order by thbl desc";

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

    public function getListTHBLGaji($thbl="")
    {
        $sql="SELECT DISTINCT SUBSTR (THBL, 0, 4) TAHUN FROM REKAP_DUK_GAJI ORDER BY tahun DESC";
        //$sql="SELECT DISTINCT SUBSTR (THBL, 0, 4) TAHUN FROM PERS_DUK_PANGKAT_HISTDUK ORDER BY tahun DESC";

        $query = $this->db->query($sql);        

        $option  = "";
        
        foreach($query->result() as $row){
            if($thbl == $row->TAHUN)
            {
                $option .= "<option selected value='".$row->TAHUN."'>".$row->TAHUN."</option>";
            }
            else
            {          
                $option .= "<option value='".$row->TAHUN."'>".$row->TAHUN."</option>";
            }
        }
        
        return $option;       
    }

    function getOptionKolokByThbl($thbl)
    {
        $sql= "SELECT * FROM (

        SELECT DISTINCT KOLOK FROM PERS_DUK_PANGKAT_HISTDUK WHERE THBL='".$thbl."' AND KOLOK NOT LIKE ' %' ORDER BY KOLOK ASC ) WHERE ROWNUM<10";
        $query = $this->db->query($sql)->result();

        return $query;
    }

    function getPegEselon2($thbl,$kolok)
    {
        $sql ="SELECT count(nrk)ESELON2 FROM PERS_DUK_PANGKAT_HISTDUK 
            WHERE THBL='".$thbl."' AND KOLOK ='".$kolok."' 
            AND ESELON LIKE '2%'";

        $query = $this->db->query($sql)->row();

        return $query;
    }

    function getPegEselon3($thbl,$kolok)
    {
        $sql ="SELECT count(nrk)ESELON3 FROM PERS_DUK_PANGKAT_HISTDUK 
            WHERE THBL='".$thbl."' AND KOLOK ='".$kolok."' 
            AND ESELON LIKE '3%'";

        $query = $this->db->query($sql)->row();

        return $query;
    }

    function getPegEselon4($thbl,$kolok)
    {
        $sql ="SELECT count(nrk)ESELON4 FROM PERS_DUK_PANGKAT_HISTDUK 
            WHERE THBL='".$thbl."' AND KOLOK ='".$kolok."' 
            AND ESELON LIKE '4%'";

        $query = $this->db->query($sql)->row();

        return $query;
    }

    // S - 798011
    function getPegTeknisAhli($thbl,$kolok)
    {
        $sql ="SELECT count(nrk)TEK_AHLI FROM PERS_DUK_PANGKAT_HISTDUK where THBL='".$thbl."' AND KOLOK='".$kolok."' AND KOJAB='798011'";

        $query = $this->db->query($sql)->row();

        return $query;
    }

    // S - 798012
    function getPegTeknisTerampil($thbl,$kolok)
    {
        $sql ="SELECT count(nrk)TEK_TRP FROM PERS_DUK_PANGKAT_HISTDUK where THBL='".$thbl."' AND KOLOK='".$kolok."' AND KOJAB='798012'";

        $query = $this->db->query($sql)->row();

        return $query;
    }

    // S - 798021
    function getPegAdmAhli($thbl,$kolok)
    {
        $sql ="SELECT count(nrk)ADM_AHLI FROM PERS_DUK_PANGKAT_HISTDUK where THBL='".$thbl."' AND KOLOK='".$kolok."' AND KOJAB='798021'";

        $query = $this->db->query($sql)->row();

        return $query;
    }

    // S - 798022
    function getPegAdmTerampil($thbl,$kolok)
    {
        $sql ="SELECT count(nrk)ADM_TRP FROM PERS_DUK_PANGKAT_HISTDUK where THBL='".$thbl."' AND KOLOK='".$kolok."' AND KOJAB='798022'";

        $query = $this->db->query($sql)->row();

        return $query;
    }

    // S - 798031
    function getPegOpAhli($thbl,$kolok)
    {
        $sql ="SELECT count(nrk)OP_AHLI FROM PERS_DUK_PANGKAT_HISTDUK where THBL='".$thbl."' AND KOLOK='".$kolok."' AND KOJAB='798031'";

        $query = $this->db->query($sql)->row();

        return $query;
    }

    // S - 798032
    function getPegOpTerampil($thbl,$kolok)
    {
        $sql ="SELECT count(nrk)OP_TRP FROM PERS_DUK_PANGKAT_HISTDUK where THBL='".$thbl."' AND KOLOK='".$kolok."' AND KOJAB='798032'";

        $query = $this->db->query($sql)->row();

        return $query;
    }

    // S - 798041
    function getPegLayAhli($thbl,$kolok)
    {
        $sql ="SELECT count(nrk)LAY_AHLI FROM PERS_DUK_PANGKAT_HISTDUK where THBL='".$thbl."' AND KOLOK='".$kolok."' AND KOJAB='798041'";

        $query = $this->db->query($sql)->row();

        return $query;
    }

    // S - 798042
    function getPegLayTerampil($thbl,$kolok)
    {
        $sql ="SELECT count(nrk)LAY_TRP FROM PERS_DUK_PANGKAT_HISTDUK where THBL='".$thbl."' AND KOLOK='".$kolok."' AND KOJAB='798042'";

        $query = $this->db->query($sql)->row();

        return $query;
    }

    // S
    function getPegStafNJFU($thbl,$kolok)
    {
        $sql ="SELECT count(nrk)NONJFU FROM PERS_DUK_PANGKAT_HISTDUK where THBL='".$thbl."' AND KOLOK='".$kolok."' AND KOJAB NOT IN('798011','798012','798021','798022','798031','798032','798041','798042') and KD='S'";

        $query = $this->db->query($sql)->row();

        return $query;
    }

    // F
    function getPegJFT($thbl,$kolok)
    {
        $sql ="SELECT count(nrk)JFT FROM PERS_DUK_PANGKAT_HISTDUK where THBL='".$thbl."' AND KOLOK='".$kolok."' AND KD='F'";

        $query = $this->db->query($sql)->row();

        return $query;
    }

    function getPegCPNS($thbl,$kolok)
    {

        $sql ="SELECT count(nrk)CPNS FROM PERS_DUK_PANGKAT_HISTDUK where THBL='".$thbl."' AND KOLOK='".$kolok."' AND STAPEG = 1";
        
        $query = $this->db->query($sql)->row();

        return $query;    
    }

    function getPegTotalPerLokasi($thbl,$kolok)
    {
        $sql ="SELECT count(nrk)TOTAL FROM PERS_DUK_PANGKAT_HISTDUK where THBL='".$thbl."' AND KOLOK='".$kolok."'";

        $query = $this->db->query($sql)->row();

        return $query;    
    }    

    function getResultQuery($thbl)
    {
        $sql= "SELECT
                    KLK.KOLOK_NEW,
                    NVL (ES2.JML_NRK, 0) AS ESELON2,
                    NVL (ES3.JML_NRK, 0) AS ESELON3,
                    NVL (ES4.JML_NRK, 0) AS ESELON4,
                    NVL (TA.TEK_AHLI, 0) AS TEKNIS_AHLI,
                    NVL (TT.TEK_TRP, 0) AS TEKNIS_TERAMPIL,
                    NVL (AA.ADM_AHLI, 0) AS ADMINISTRASI_AHLI,
                    NVL (ATR.ADM_TRP, 0) AS ADMINISTRASI_TERAMPIL,
                    NVL (OA.OPR_AHLI, 0) AS OPERASIONAL_AHLI,
                    NVL (OT.OPR_TRP, 0) AS OPERASIONAL_TERAMPIL,
                    NVL (LA.LAY_AHLI, 0) AS PELAYANAN_AHLI,
                    NVL (LT.LAY_TRP, 0) AS PELAYANAN_TERAMPIL,
                    NVL (NJ.NONJFU, 0) AS LAINNYA,
                    NVL (JFT.JF, 0) AS JFT,
                    NVL (TOT.TOT, 0) AS TOT
                FROM
                    (
                        SELECT KOLOK AS KOLOK_NEW FROM PERS_DUK_PANGKAT_HISTDUK A
                        WHERE THBL = '".$thbl."' GROUP BY KOLOK
                    ) KLK

                LEFT JOIN (
                    SELECT COUNT (NRK) AS JML_NRK, KOLOK FROM PERS_DUK_PANGKAT_HISTDUK
                    WHERE THBL = '".$thbl."' AND ESELON LIKE '2%' GROUP BY KOLOK
                ) ES2 ON KLK.KOLOK_NEW = ES2.KOLOK
                LEFT JOIN (
                    SELECT COUNT (NRK) AS JML_NRK,KOLOK FROM PERS_DUK_PANGKAT_HISTDUK
                    WHERE THBL = '".$thbl."' AND ESELON LIKE '3%' GROUP BY KOLOK
                ) ES3 ON KLK.KOLOK_NEW = ES3.KOLOK
                LEFT JOIN (
                    SELECT COUNT (NRK) AS JML_NRK,KOLOK FROM PERS_DUK_PANGKAT_HISTDUK
                    WHERE THBL = '".$thbl."' AND ESELON LIKE '4%' GROUP BY KOLOK
                ) ES4 ON KLK.KOLOK_NEW = ES4.KOLOK
                LEFT JOIN (
                    SELECT COUNT (nrk) TEK_AHLI, KOLOK FROM PERS_DUK_PANGKAT_HISTDUK
                    WHERE THBL = '".$thbl."' AND KOJAB = '798011'GROUP BY KOLOK
                ) TA ON KLK.KOLOK_NEW = TA.KOLOK
                LEFT JOIN (
                    SELECT COUNT (nrk) TEK_TRP,KOLOK FROM PERS_DUK_PANGKAT_HISTDUK
                    WHERE THBL = '".$thbl."' AND KOJAB = '798012'GROUP BY KOLOK
                ) TT ON KLK.KOLOK_NEW = TT.KOLOK
                LEFT JOIN (
                    SELECT COUNT (nrk) ADM_AHLI,KOLOK FROM PERS_DUK_PANGKAT_HISTDUK
                    WHERE THBL = '".$thbl."' AND KOJAB = '798021' GROUP BY KOLOK
                ) AA ON KLK.KOLOK_NEW = AA.KOLOK
                LEFT JOIN (
                    SELECT COUNT (nrk) ADM_TRP,KOLOK FROM PERS_DUK_PANGKAT_HISTDUK
                    WHERE THBL = '".$thbl."' AND KOJAB = '798022' GROUP BY KOLOK
                ) ATR ON KLK.KOLOK_NEW = ATR.KOLOK
                LEFT JOIN (
                    SELECT COUNT (nrk) OPR_AHLI, KOLOK FROM PERS_DUK_PANGKAT_HISTDUK
                    WHERE THBL = '".$thbl."' AND KOJAB = '798031' GROUP BY KOLOK
                ) OA ON KLK.KOLOK_NEW = OA.KOLOK
                LEFT JOIN (
                    SELECT COUNT (nrk) OPR_TRP,KOLOK FROM PERS_DUK_PANGKAT_HISTDUK
                    WHERE THBL = '".$thbl."' AND KOJAB = '798032' GROUP BY KOLOK
                ) OT ON KLK.KOLOK_NEW = OT.KOLOK
                LEFT JOIN (
                    SELECT COUNT (nrk) LAY_AHLI,KOLOK FROM PERS_DUK_PANGKAT_HISTDUK
                    WHERE THBL = '".$thbl."' AND KOJAB = '798041' GROUP BY KOLOK
                ) LA ON KLK.KOLOK_NEW = LA.KOLOK
                LEFT JOIN (
                    SELECT COUNT (nrk) LAY_TRP,kolok FROM PERS_DUK_PANGKAT_HISTDUK
                    WHERE THBL = '".$thbl."' AND KOJAB = '798042'
                    GROUP BY KOLOK
                ) LT ON KLK.KOLOK_NEW = LT.KOLOK
                LEFT JOIN (
                    SELECT COUNT (nrk) NONJFU,kolok FROM PERS_DUK_PANGKAT_HISTDUK
                    WHERE THBL = '".$thbl."' AND KOJAB NOT IN('798011','798012','798021','798022','798031','798032','798041','798042') AND KD='S' AND ESELON NOT LIKE '2%' AND ESELON NOT LIKE '3%' AND ESELON NOT LIKE '4%' 
                    GROUP BY KOLOK
                ) NJ ON KLK.KOLOK_NEW = NJ.KOLOK
                LEFT JOIN (
                    SELECT COUNT (nrk) JF,kolok FROM PERS_DUK_PANGKAT_HISTDUK
                    WHERE THBL = '".$thbl."' AND KD = 'F'
                    GROUP BY KOLOK
                ) JFT ON KLK.KOLOK_NEW = JFT.KOLOK
                LEFT JOIN (
                    SELECT COUNT (nrk) TOT,kolok FROM PERS_DUK_PANGKAT_HISTDUK
                    WHERE THBL = '".$thbl."' 
                    GROUP BY KOLOK
                ) TOT ON KLK.KOLOK_NEW = TOT.KOLOK";

            $query = $this->db->query($sql)->result();

        return $query;   

    }

    function getQueryUkpd($res)
    {
        $sql="SELECT ROWNUM AS rn,KOLOK_NEW,NALOKL,CPNS,ESELON2,ESELON3,ESELON4,TEKNIS_AHLI,TEKNIS_TERAMPIL,ADMINISTRASI_AHLI,ADMINISTRASI_TERAMPIL,OPERASIONAL_AHLI,OPERASIONAL_TERAMPIL,PELAYANAN_AHLI,PELAYANAN_TERAMPIL,
                LAINNYA,JFT,TOT 
                FROM
                (
                    SELECT 
                        KLK.KOLOK_NEW,
                        NVL (CPNS.JML_NRK, 0) AS CPNS,
                        NVL (ES2.JML_NRK, 0) AS ESELON2,
                        NVL (ES3.JML_NRK, 0) AS ESELON3,
                        NVL (ES4.JML_NRK, 0) AS ESELON4,
                        NVL (TA.TEK_AHLI, 0) AS TEKNIS_AHLI,
                        NVL (TT.TEK_TRP, 0) AS TEKNIS_TERAMPIL,
                        NVL (AA.ADM_AHLI, 0) AS ADMINISTRASI_AHLI,
                        NVL (ATR.ADM_TRP, 0) AS ADMINISTRASI_TERAMPIL,
                        NVL (OA.OPR_AHLI, 0) AS OPERASIONAL_AHLI,
                        NVL (OT.OPR_TRP, 0) AS OPERASIONAL_TERAMPIL,
                        NVL (LA.LAY_AHLI, 0) AS PELAYANAN_AHLI,
                        NVL (LT.LAY_TRP, 0) AS PELAYANAN_TERAMPIL,
                        NVL (NJ.NONJFU, 0) AS LAINNYA,
                        NVL (JFT.JF, 0) AS JFT,
                        NVL (TOT.TOT, 0) AS TOT
                    FROM
                        (
                            SELECT KLOGAD AS KOLOK_NEW FROM PERS_DUK_PANGKAT_HISTDUK A
                            WHERE THBL = '".$res."' GROUP BY KLOGAD
                        ) KLK
                    LEFT JOIN (
                        SELECT COUNT (nrk) AS JML_NRK,KLOGAD FROM PERS_DUK_PANGKAT_HISTDUK
                        WHERE THBL = '".$res."' AND STAPEG= 1
                        GROUP BY KLOGAD
                    ) CPNS ON KLK.KOLOK_NEW = CPNS.KLOGAD
                    LEFT JOIN (
                        SELECT COUNT (NRK) AS JML_NRK, KLOGAD FROM PERS_DUK_PANGKAT_HISTDUK
                        WHERE THBL = '".$res."' AND ESELON LIKE '2%' GROUP BY KLOGAD
                    ) ES2 ON KLK.KOLOK_NEW = ES2.KLOGAD
                    LEFT JOIN (
                        SELECT COUNT (NRK) AS JML_NRK,KLOGAD FROM PERS_DUK_PANGKAT_HISTDUK
                        WHERE THBL = '".$res."' AND ESELON LIKE '3%' GROUP BY KLOGAD
                    ) ES3 ON KLK.KOLOK_NEW = ES3.KLOGAD
                    LEFT JOIN (
                        SELECT COUNT (NRK) AS JML_NRK,KLOGAD FROM PERS_DUK_PANGKAT_HISTDUK
                        WHERE THBL = '".$res."' AND ESELON LIKE '4%' GROUP BY KLOGAD
                    ) ES4 ON KLK.KOLOK_NEW = ES4.KLOGAD
                    LEFT JOIN (
                        SELECT COUNT (nrk) TEK_AHLI, KLOGAD FROM PERS_DUK_PANGKAT_HISTDUK
                        WHERE THBL = '".$res."' AND KOJAB = '798011' GROUP BY KLOGAD
                    ) TA ON KLK.KOLOK_NEW = TA.KLOGAD
                    LEFT JOIN (
                        SELECT COUNT (nrk) TEK_TRP,KLOGAD FROM PERS_DUK_PANGKAT_HISTDUK
                        WHERE THBL = '".$res."' AND KOJAB = '798012' GROUP BY KLOGAD
                    ) TT ON KLK.KOLOK_NEW = TT.KLOGAD
                    LEFT JOIN (
                        SELECT COUNT (nrk) ADM_AHLI,KLOGAD FROM PERS_DUK_PANGKAT_HISTDUK
                        WHERE THBL = '".$res."' AND KOJAB = '798021' GROUP BY KLOGAD
                    ) AA ON KLK.KOLOK_NEW = AA.KLOGAD
                    LEFT JOIN (
                        SELECT COUNT (nrk) ADM_TRP,KLOGAD FROM PERS_DUK_PANGKAT_HISTDUK
                        WHERE THBL = '".$res."' AND KOJAB = '798022' GROUP BY KLOGAD
                    ) ATR ON KLK.KOLOK_NEW = ATR.KLOGAD
                    LEFT JOIN (
                        SELECT COUNT (nrk) OPR_AHLI, KLOGAD FROM PERS_DUK_PANGKAT_HISTDUK
                        WHERE THBL = '".$res."' AND KOJAB = '798031' GROUP BY KLOGAD
                    ) OA ON KLK.KOLOK_NEW = OA.KLOGAD
                    LEFT JOIN (
                        SELECT COUNT (nrk) OPR_TRP,KLOGAD FROM PERS_DUK_PANGKAT_HISTDUK
                        WHERE THBL = '".$res."' AND KOJAB = '798032' GROUP BY KLOGAD
                    ) OT ON KLK.KOLOK_NEW = OT.KLOGAD
                    LEFT JOIN (
                        SELECT COUNT (nrk) LAY_AHLI,KLOGAD FROM PERS_DUK_PANGKAT_HISTDUK
                        WHERE THBL = '".$res."' AND KOJAB = '798041' GROUP BY KLOGAD
                    ) LA ON KLK.KOLOK_NEW = LA.KLOGAD
                    LEFT JOIN (
                        SELECT COUNT (nrk) LAY_TRP,KLOGAD FROM PERS_DUK_PANGKAT_HISTDUK
                        WHERE THBL = '".$res."' AND KOJAB = '798042'
                        GROUP BY KLOGAD
                    ) LT ON KLK.KOLOK_NEW = LT.KLOGAD
                    LEFT JOIN (
                        SELECT COUNT (nrk) NONJFU,KLOGAD FROM PERS_DUK_PANGKAT_HISTDUK
                        WHERE THBL = '".$res."' AND KOJAB NOT IN('798011','798012','798021','798022','798031','798032','798041','798042') AND KD='S' AND ESELON NOT LIKE '2%' AND ESELON NOT LIKE '3%' AND ESELON NOT LIKE '4%' 
                        GROUP BY KLOGAD
                    ) NJ ON KLK.KOLOK_NEW = NJ.KLOGAD
                    LEFT JOIN (
                        SELECT COUNT (nrk) JF,KLOGAD FROM PERS_DUK_PANGKAT_HISTDUK
                        WHERE THBL = '".$res."' AND KD = 'F'
                        GROUP BY KLOGAD
                    ) JFT ON KLK.KOLOK_NEW = JFT.KLOGAD
                    LEFT JOIN (
                        SELECT COUNT (nrk) TOT,KLOGAD FROM PERS_DUK_PANGKAT_HISTDUK
                        WHERE THBL = '".$res."' 
                        GROUP BY KLOGAD
                    ) TOT ON KLK.KOLOK_NEW = TOT.KLOGAD
                )PEGAWAI 
                LEFT JOIN PERS_LOKASI_TBL B ON PEGAWAI.KOLOK_NEW = B.KOLOK";
        $query = $this->db->query($sql)->result();
        return $query;
    }

    function getDataPegawaiUKPD($res){
        $requestData = $this->input->post();
        
        $columns = array(
            0 => 'NO',
            1 => 'KOLOK',
            2 => 'ESELON2',
            3 => 'ESELON3',
            4 => 'ESELON4',
            5 => 'CPNS',
            6 => 'TA',
            7 => 'TP',
            8 => 'AA',
            9 => 'AP',
            10 => 'OA',
            11 => 'OP',
            12 => 'PA',
            13 => 'PT',
            14 => 'JFT',
            15 => 'LAINNYA',
            16 => 'TOTAL'
            );

        $q = "SELECT COUNT(DISTINCT KOLOK) AS jml FROM PERS_DUK_PANGKAT_HISTDUK
              WHERE THBL='".$res."'";
        $rs = $this->db->query($q)->result();
        $totalData = $rs[0]->JML;

      


       $sql=" SELECT ROWNUM, X.* FROM(SELECT ROWNUM AS rn,KOLOK_NEW,NALOKL,CPNS,ESELON2,ESELON3,ESELON4,TEKNIS_AHLI,TEKNIS_TERAMPIL,ADMINISTRASI_AHLI,ADMINISTRASI_TERAMPIL,OPERASIONAL_AHLI,OPERASIONAL_TERAMPIL,PELAYANAN_AHLI,PELAYANAN_TERAMPIL,
                LAINNYA,JFT,TOT 
                FROM
                (
                    SELECT 
                        KLK.KOLOK_NEW,
                        NVL (CPNS.JML_NRK, 0) AS CPNS,
                        NVL (ES2.JML_NRK, 0) AS ESELON2,
                        NVL (ES3.JML_NRK, 0) AS ESELON3,
                        NVL (ES4.JML_NRK, 0) AS ESELON4,
                        NVL (TA.TEK_AHLI, 0) AS TEKNIS_AHLI,
                        NVL (TT.TEK_TRP, 0) AS TEKNIS_TERAMPIL,
                        NVL (AA.ADM_AHLI, 0) AS ADMINISTRASI_AHLI,
                        NVL (ATR.ADM_TRP, 0) AS ADMINISTRASI_TERAMPIL,
                        NVL (OA.OPR_AHLI, 0) AS OPERASIONAL_AHLI,
                        NVL (OT.OPR_TRP, 0) AS OPERASIONAL_TERAMPIL,
                        NVL (LA.LAY_AHLI, 0) AS PELAYANAN_AHLI,
                        NVL (LT.LAY_TRP, 0) AS PELAYANAN_TERAMPIL,
                        NVL (NJ.NONJFU, 0) AS LAINNYA,
                        NVL (JFT.JF, 0) AS JFT,
                        NVL (TOT.TOT, 0) AS TOT
                    FROM
                        (
                            SELECT KLOGAD AS KOLOK_NEW FROM PERS_DUK_PANGKAT_HISTDUK A
                            WHERE THBL = '".$res."' GROUP BY KLOGAD
                        ) KLK
                    LEFT JOIN (
                        SELECT COUNT (nrk) AS JML_NRK,KLOGAD FROM PERS_DUK_PANGKAT_HISTDUK
                        WHERE THBL = '".$res."' AND STAPEG= 1
                        GROUP BY KLOGAD
                    ) CPNS ON KLK.KOLOK_NEW = CPNS.KLOGAD
                    LEFT JOIN (
                        SELECT COUNT (NRK) AS JML_NRK, KLOGAD FROM PERS_DUK_PANGKAT_HISTDUK
                        WHERE THBL = '".$res."' AND ESELON LIKE '2%' GROUP BY KLOGAD
                    ) ES2 ON KLK.KOLOK_NEW = ES2.KLOGAD
                    LEFT JOIN (
                        SELECT COUNT (NRK) AS JML_NRK,KLOGAD FROM PERS_DUK_PANGKAT_HISTDUK
                        WHERE THBL = '".$res."' AND ESELON LIKE '3%' GROUP BY KLOGAD
                    ) ES3 ON KLK.KOLOK_NEW = ES3.KLOGAD
                    LEFT JOIN (
                        SELECT COUNT (NRK) AS JML_NRK,KLOGAD FROM PERS_DUK_PANGKAT_HISTDUK
                        WHERE THBL = '".$res."' AND ESELON LIKE '4%' GROUP BY KLOGAD
                    ) ES4 ON KLK.KOLOK_NEW = ES4.KLOGAD
                    LEFT JOIN (
                        SELECT COUNT (nrk) TEK_AHLI, KLOGAD FROM PERS_DUK_PANGKAT_HISTDUK
                        WHERE THBL = '".$res."' AND KOJAB = '798011' GROUP BY KLOGAD
                    ) TA ON KLK.KOLOK_NEW = TA.KLOGAD
                    LEFT JOIN (
                        SELECT COUNT (nrk) TEK_TRP,KLOGAD FROM PERS_DUK_PANGKAT_HISTDUK
                        WHERE THBL = '".$res."' AND KOJAB = '798012' GROUP BY KLOGAD
                    ) TT ON KLK.KOLOK_NEW = TT.KLOGAD
                    LEFT JOIN (
                        SELECT COUNT (nrk) ADM_AHLI,KLOGAD FROM PERS_DUK_PANGKAT_HISTDUK
                        WHERE THBL = '".$res."' AND KOJAB = '798021' GROUP BY KLOGAD
                    ) AA ON KLK.KOLOK_NEW = AA.KLOGAD
                    LEFT JOIN (
                        SELECT COUNT (nrk) ADM_TRP,KLOGAD FROM PERS_DUK_PANGKAT_HISTDUK
                        WHERE THBL = '".$res."' AND KOJAB = '798022' GROUP BY KLOGAD
                    ) ATR ON KLK.KOLOK_NEW = ATR.KLOGAD
                    LEFT JOIN (
                        SELECT COUNT (nrk) OPR_AHLI, KLOGAD FROM PERS_DUK_PANGKAT_HISTDUK
                        WHERE THBL = '".$res."' AND KOJAB = '798031' GROUP BY KLOGAD
                    ) OA ON KLK.KOLOK_NEW = OA.KLOGAD
                    LEFT JOIN (
                        SELECT COUNT (nrk) OPR_TRP,KLOGAD FROM PERS_DUK_PANGKAT_HISTDUK
                        WHERE THBL = '".$res."' AND KOJAB = '798032' GROUP BY KLOGAD
                    ) OT ON KLK.KOLOK_NEW = OT.KLOGAD
                    LEFT JOIN (
                        SELECT COUNT (nrk) LAY_AHLI,KLOGAD FROM PERS_DUK_PANGKAT_HISTDUK
                        WHERE THBL = '".$res."' AND KOJAB = '798041' GROUP BY KLOGAD
                    ) LA ON KLK.KOLOK_NEW = LA.KLOGAD
                    LEFT JOIN (
                        SELECT COUNT (nrk) LAY_TRP,KLOGAD FROM PERS_DUK_PANGKAT_HISTDUK
                        WHERE THBL = '".$res."' AND KOJAB = '798042'
                        GROUP BY KLOGAD
                    ) LT ON KLK.KOLOK_NEW = LT.KLOGAD
                    LEFT JOIN (
                        SELECT COUNT (nrk) NONJFU,KLOGAD FROM PERS_DUK_PANGKAT_HISTDUK
                        WHERE THBL = '".$res."' AND KOJAB NOT IN('798011','798012','798021','798022','798031','798032','798041','798042') AND KD='S' AND ESELON NOT LIKE '2%' AND ESELON NOT LIKE '3%' AND ESELON NOT LIKE '4%' 
                        GROUP BY KLOGAD
                    ) NJ ON KLK.KOLOK_NEW = NJ.KLOGAD
                    LEFT JOIN (
                        SELECT COUNT (nrk) JF,KLOGAD FROM PERS_DUK_PANGKAT_HISTDUK
                        WHERE THBL = '".$res."' AND KD = 'F'
                        GROUP BY KLOGAD
                    ) JFT ON KLK.KOLOK_NEW = JFT.KLOGAD
                    LEFT JOIN (
                        SELECT COUNT (nrk) TOT,KLOGAD FROM PERS_DUK_PANGKAT_HISTDUK
                        WHERE THBL = '".$res."' 
                        GROUP BY KLOGAD
                    ) TOT ON KLK.KOLOK_NEW = TOT.KLOGAD
                )PEGAWAI 
                LEFT JOIN PERS_LOKASI_TBL B ON PEGAWAI.KOLOK_NEW = B.KOLOK)X
                ";
        $sql.=" WHERE 1=1"; 

        if( !empty($requestData['search']['value']) ) {   // if there is a search parameter, $requestData['search']['value'] contains search parameter
            
             $sql.=" AND ( KOLOK_NEW LIKE UPPER ('%".$requestData['search']['value']."%')";
            $sql.=" OR  NALOKL LIKE  UPPER('%".$requestData['search']['value']."%') )";
        }
        //die($sql);
        $query = $this->db->query($sql);
        $totalFiltered = $query->num_rows();

        $startrow = $requestData['start'];
        $endrow = $startrow + $requestData['length'];

        if(empty($requestData['search']['value']) ) {
        $sql.=" AND RN > ".$startrow." AND RN<= ".$endrow." AND ROWNUM <= ".$requestData['length'];
        }

        
        //ECHO $sql;
        $query = $this->db->query($sql);
        //$totalFiltered = $query->num_rows();

       
        $data = array();

    
        $no = $requestData['start']+1;
        
       
        foreach ($query->result() as $row)
        {            
            
            $nestedData=array();
            $nestedData[] = $no;
            $nestedData[] = $row->NALOKL."<br/><strong><small class='text-navy'> ( ".$row->KOLOK_NEW. " )</small></strong>";
            $nestedData[] = $row->ESELON2;
            $nestedData[] = $row->ESELON3;
            $nestedData[] = $row->ESELON4;
            $nestedData[] = $row->CPNS;
            $nestedData[] = $row->TEKNIS_AHLI;
            $nestedData[] = $row->TEKNIS_TERAMPIL;
            $nestedData[] = $row->ADMINISTRASI_AHLI;
            $nestedData[] = $row->ADMINISTRASI_TERAMPIL;
            $nestedData[] = $row->OPERASIONAL_AHLI;
            $nestedData[] = $row->OPERASIONAL_TERAMPIL;
            $nestedData[] = $row->PELAYANAN_AHLI;
            $nestedData[] = $row->PELAYANAN_TERAMPIL;
            $nestedData[] = $row->JFT;
            $nestedData[] = $row->LAINNYA;
            $nestedData[] = $row->TOT;
            
            $data[]=$nestedData;
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

    function getQuerySkpd($res)
    {
        $sql = "SELECT ROWNUM AS rn,SPMU_NEW,NAMA,CPNS,ESELON2,ESELON3,ESELON4,TEKNIS_AHLI,TEKNIS_TERAMPIL,ADMINISTRASI_AHLI,ADMINISTRASI_TERAMPIL,OPERASIONAL_AHLI,OPERASIONAL_TERAMPIL,PELAYANAN_AHLI,PELAYANAN_TERAMPIL,
                LAINNYA,JFT,TOT 
                FROM
                (
                    SELECT 
                        SPMU.SPMU_NEW,
                        NVL (CPNS.JML_NRK, 0) AS CPNS,
                        NVL (ES2.JML_NRK, 0) AS ESELON2,
                        NVL (ES3.JML_NRK, 0) AS ESELON3,
                        NVL (ES4.JML_NRK, 0) AS ESELON4,
                        NVL (TA.TEK_AHLI, 0) AS TEKNIS_AHLI,
                        NVL (TT.TEK_TRP, 0) AS TEKNIS_TERAMPIL,
                        NVL (AA.ADM_AHLI, 0) AS ADMINISTRASI_AHLI,
                        NVL (ATR.ADM_TRP, 0) AS ADMINISTRASI_TERAMPIL,
                        NVL (OA.OPR_AHLI, 0) AS OPERASIONAL_AHLI,
                        NVL (OT.OPR_TRP, 0) AS OPERASIONAL_TERAMPIL,
                        NVL (LA.LAY_AHLI, 0) AS PELAYANAN_AHLI,
                        NVL (LT.LAY_TRP, 0) AS PELAYANAN_TERAMPIL,
                        NVL (NJ.NONJFU, 0) AS LAINNYA,
                        NVL (JFT.JF, 0) AS JFT,
                        NVL (TOT.TOT, 0) AS TOT
                    FROM
                        (
                            SELECT SPMU AS SPMU_NEW FROM PERS_DUK_PANGKAT_HISTDUK A
                            WHERE THBL = '201601' GROUP BY SPMU
                        ) SPMU
                    LEFT JOIN (
                        SELECT COUNT (nrk) AS JML_NRK,SPMU FROM PERS_DUK_PANGKAT_HISTDUK
                        WHERE THBL = '".$res."' AND STAPEG= 1
                        GROUP BY SPMU
                    ) CPNS ON SPMU.SPMU_NEW = CPNS.SPMU
                    LEFT JOIN (
                        SELECT COUNT (NRK) AS JML_NRK, SPMU FROM PERS_DUK_PANGKAT_HISTDUK
                        WHERE THBL = '".$res."' AND ESELON LIKE '2%' GROUP BY SPMU
                    ) ES2 ON SPMU.SPMU_NEW = ES2.SPMU
                    LEFT JOIN (
                        SELECT COUNT (NRK) AS JML_NRK,SPMU FROM PERS_DUK_PANGKAT_HISTDUK
                        WHERE THBL = '".$res."' AND ESELON LIKE '3%' GROUP BY SPMU
                    ) ES3 ON SPMU.SPMU_NEW = ES3.SPMU
                    LEFT JOIN (
                        SELECT COUNT (NRK) AS JML_NRK,SPMU FROM PERS_DUK_PANGKAT_HISTDUK
                        WHERE THBL = '".$res."' AND ESELON LIKE '4%' GROUP BY SPMU
                    ) ES4 ON SPMU.SPMU_NEW = ES4.SPMU
                    LEFT JOIN (
                        SELECT COUNT (nrk) TEK_AHLI, SPMU FROM PERS_DUK_PANGKAT_HISTDUK
                        WHERE THBL = '".$res."' AND KOJAB = '798011' GROUP BY SPMU
                    ) TA ON SPMU.SPMU_NEW = TA.SPMU
                    LEFT JOIN (
                        SELECT COUNT (nrk) TEK_TRP,SPMU FROM PERS_DUK_PANGKAT_HISTDUK
                        WHERE THBL = '".$res."' AND KOJAB = '798012' GROUP BY SPMU
                    ) TT ON SPMU.SPMU_NEW = TT.SPMU
                    LEFT JOIN (
                        SELECT COUNT (nrk) ADM_AHLI,SPMU FROM PERS_DUK_PANGKAT_HISTDUK
                        WHERE THBL = '".$res."' AND KOJAB = '798021' GROUP BY SPMU
                    ) AA ON SPMU.SPMU_NEW = AA.SPMU
                    LEFT JOIN (
                        SELECT COUNT (nrk) ADM_TRP,SPMU FROM PERS_DUK_PANGKAT_HISTDUK
                        WHERE THBL = '".$res."' AND KOJAB = '798022' GROUP BY SPMU
                    ) ATR ON SPMU.SPMU_NEW = ATR.SPMU
                    LEFT JOIN (
                        SELECT COUNT (nrk) OPR_AHLI, SPMU FROM PERS_DUK_PANGKAT_HISTDUK
                        WHERE THBL = '".$res."' AND KOJAB = '798031' GROUP BY SPMU
                    ) OA ON SPMU.SPMU_NEW = OA.SPMU
                    LEFT JOIN (
                        SELECT COUNT (nrk) OPR_TRP,SPMU FROM PERS_DUK_PANGKAT_HISTDUK
                        WHERE THBL = '".$res."' AND KOJAB = '798032' GROUP BY SPMU
                    ) OT ON SPMU.SPMU_NEW = OT.SPMU
                    LEFT JOIN (
                        SELECT COUNT (nrk) LAY_AHLI,SPMU FROM PERS_DUK_PANGKAT_HISTDUK
                        WHERE THBL = '".$res."' AND KOJAB = '798041' GROUP BY SPMU
                    ) LA ON SPMU.SPMU_NEW = LA.SPMU
                    LEFT JOIN (
                        SELECT COUNT (nrk) LAY_TRP,SPMU FROM PERS_DUK_PANGKAT_HISTDUK
                        WHERE THBL = '".$res."' AND KOJAB = '798042'
                        GROUP BY SPMU
                    ) LT ON SPMU.SPMU_NEW = LT.SPMU
                    LEFT JOIN (
                        SELECT COUNT (nrk) NONJFU,SPMU FROM PERS_DUK_PANGKAT_HISTDUK
                        WHERE THBL = '".$res."' AND KOJAB NOT IN('798011','798012','798021','798022','798031','798032','798041','798042') AND KD='S' AND ESELON NOT LIKE '2%' AND ESELON NOT LIKE '3%' AND ESELON NOT LIKE '4%' 
                        GROUP BY SPMU
                    ) NJ ON SPMU.SPMU_NEW = NJ.SPMU
                    LEFT JOIN (
                        SELECT COUNT (nrk) JF,SPMU FROM PERS_DUK_PANGKAT_HISTDUK
                        WHERE THBL = '".$res."' AND KD = 'F'
                        GROUP BY SPMU
                    ) JFT ON SPMU.SPMU_NEW = JFT.SPMU
                    LEFT JOIN (
                        SELECT COUNT (nrk) TOT,SPMU FROM PERS_DUK_PANGKAT_HISTDUK
                        WHERE THBL = '".$res."' 
                        GROUP BY SPMU
                    ) TOT ON SPMU.SPMU_NEW = TOT.SPMU
                )PEGAWAI
                left join pers_tabel_spmu B on PEGAWAI.SPMU_NEW = B.KODE_SPM
                 ";
        $query = $this->db->query($sql)->result();
        return $query;
    }

    function getDataPegawaiSKPD($res){
        $requestData = $this->input->post();
        
        $columns = array(
            0 => 'NO',
            1 => 'KOLOK',
            2 => 'ESELON2',
            3 => 'ESELON3',
            4 => 'ESELON4',
            5 => 'CPNS',
            6 => 'TA',
            7 => 'TP',
            8 => 'AA',
            9 => 'AP',
            10 => 'OA',
            11 => 'OP',
            12 => 'PA',
            13 => 'PT',
            14 => 'JFT',
            15 => 'LAINNYA',
            16 => 'TOTAL'
            );

        $q = "SELECT COUNT(DISTINCT SPMU) AS jml FROM PERS_DUK_PANGKAT_HISTDUK
              WHERE THBL='".$res."'";
        $rs = $this->db->query($q)->result();
        $totalData = $rs[0]->JML;

       $sql = "SELECT ROWNUM, X.* FROM(SELECT ROWNUM AS rn,SPMU_NEW,NAMA,CPNS,ESELON2,ESELON3,ESELON4,TEKNIS_AHLI,TEKNIS_TERAMPIL,ADMINISTRASI_AHLI,ADMINISTRASI_TERAMPIL,OPERASIONAL_AHLI,OPERASIONAL_TERAMPIL,PELAYANAN_AHLI,PELAYANAN_TERAMPIL,
                LAINNYA,JFT,TOT 
                FROM
                (
                    SELECT 
                        SPMU.SPMU_NEW,
                        NVL (CPNS.JML_NRK, 0) AS CPNS,
                        NVL (ES2.JML_NRK, 0) AS ESELON2,
                        NVL (ES3.JML_NRK, 0) AS ESELON3,
                        NVL (ES4.JML_NRK, 0) AS ESELON4,
                        NVL (TA.TEK_AHLI, 0) AS TEKNIS_AHLI,
                        NVL (TT.TEK_TRP, 0) AS TEKNIS_TERAMPIL,
                        NVL (AA.ADM_AHLI, 0) AS ADMINISTRASI_AHLI,
                        NVL (ATR.ADM_TRP, 0) AS ADMINISTRASI_TERAMPIL,
                        NVL (OA.OPR_AHLI, 0) AS OPERASIONAL_AHLI,
                        NVL (OT.OPR_TRP, 0) AS OPERASIONAL_TERAMPIL,
                        NVL (LA.LAY_AHLI, 0) AS PELAYANAN_AHLI,
                        NVL (LT.LAY_TRP, 0) AS PELAYANAN_TERAMPIL,
                        NVL (NJ.NONJFU, 0) AS LAINNYA,
                        NVL (JFT.JF, 0) AS JFT,
                        NVL (TOT.TOT, 0) AS TOT
                    FROM
                        (
                            SELECT SPMU AS SPMU_NEW FROM PERS_DUK_PANGKAT_HISTDUK A
                            WHERE THBL = '".$res."' GROUP BY SPMU
                        ) SPMU
                    LEFT JOIN (
                        SELECT COUNT (nrk) AS JML_NRK,SPMU FROM PERS_DUK_PANGKAT_HISTDUK
                        WHERE THBL = '".$res."' AND STAPEG= 1
                        GROUP BY SPMU
                    ) CPNS ON SPMU.SPMU_NEW = CPNS.SPMU
                    LEFT JOIN (
                        SELECT COUNT (NRK) AS JML_NRK, SPMU FROM PERS_DUK_PANGKAT_HISTDUK
                        WHERE THBL = '".$res."' AND ESELON LIKE '2%' GROUP BY SPMU
                    ) ES2 ON SPMU.SPMU_NEW = ES2.SPMU
                    LEFT JOIN (
                        SELECT COUNT (NRK) AS JML_NRK,SPMU FROM PERS_DUK_PANGKAT_HISTDUK
                        WHERE THBL = '".$res."' AND ESELON LIKE '3%' GROUP BY SPMU
                    ) ES3 ON SPMU.SPMU_NEW = ES3.SPMU
                    LEFT JOIN (
                        SELECT COUNT (NRK) AS JML_NRK,SPMU FROM PERS_DUK_PANGKAT_HISTDUK
                        WHERE THBL = '".$res."' AND ESELON LIKE '4%' GROUP BY SPMU
                    ) ES4 ON SPMU.SPMU_NEW = ES4.SPMU
                    LEFT JOIN (
                        SELECT COUNT (nrk) TEK_AHLI, SPMU FROM PERS_DUK_PANGKAT_HISTDUK
                        WHERE THBL = '".$res."' AND KOJAB = '798011' GROUP BY SPMU
                    ) TA ON SPMU.SPMU_NEW = TA.SPMU
                    LEFT JOIN (
                        SELECT COUNT (nrk) TEK_TRP,SPMU FROM PERS_DUK_PANGKAT_HISTDUK
                        WHERE THBL = '".$res."' AND KOJAB = '798012' GROUP BY SPMU
                    ) TT ON SPMU.SPMU_NEW = TT.SPMU
                    LEFT JOIN (
                        SELECT COUNT (nrk) ADM_AHLI,SPMU FROM PERS_DUK_PANGKAT_HISTDUK
                        WHERE THBL = '".$res."' AND KOJAB = '798021' GROUP BY SPMU
                    ) AA ON SPMU.SPMU_NEW = AA.SPMU
                    LEFT JOIN (
                        SELECT COUNT (nrk) ADM_TRP,SPMU FROM PERS_DUK_PANGKAT_HISTDUK
                        WHERE THBL = '".$res."' AND KOJAB = '798022' GROUP BY SPMU
                    ) ATR ON SPMU.SPMU_NEW = ATR.SPMU
                    LEFT JOIN (
                        SELECT COUNT (nrk) OPR_AHLI, SPMU FROM PERS_DUK_PANGKAT_HISTDUK
                        WHERE THBL = '".$res."' AND KOJAB = '798031' GROUP BY SPMU
                    ) OA ON SPMU.SPMU_NEW = OA.SPMU
                    LEFT JOIN (
                        SELECT COUNT (nrk) OPR_TRP,SPMU FROM PERS_DUK_PANGKAT_HISTDUK
                        WHERE THBL = '".$res."' AND KOJAB = '798032' GROUP BY SPMU
                    ) OT ON SPMU.SPMU_NEW = OT.SPMU
                    LEFT JOIN (
                        SELECT COUNT (nrk) LAY_AHLI,SPMU FROM PERS_DUK_PANGKAT_HISTDUK
                        WHERE THBL = '".$res."' AND KOJAB = '798041' GROUP BY SPMU
                    ) LA ON SPMU.SPMU_NEW = LA.SPMU
                    LEFT JOIN (
                        SELECT COUNT (nrk) LAY_TRP,SPMU FROM PERS_DUK_PANGKAT_HISTDUK
                        WHERE THBL = '".$res."' AND KOJAB = '798042'
                        GROUP BY SPMU
                    ) LT ON SPMU.SPMU_NEW = LT.SPMU
                    LEFT JOIN (
                        SELECT COUNT (nrk) NONJFU,SPMU FROM PERS_DUK_PANGKAT_HISTDUK
                        WHERE THBL = '".$res."' AND KOJAB NOT IN('798011','798012','798021','798022','798031','798032','798041','798042') AND KD='S' AND ESELON NOT LIKE '2%' AND ESELON NOT LIKE '3%' AND ESELON NOT LIKE '4%' 
                        GROUP BY SPMU
                    ) NJ ON SPMU.SPMU_NEW = NJ.SPMU
                    LEFT JOIN (
                        SELECT COUNT (nrk) JF,SPMU FROM PERS_DUK_PANGKAT_HISTDUK
                        WHERE THBL = '".$res."' AND KD = 'F'
                        GROUP BY SPMU
                    ) JFT ON SPMU.SPMU_NEW = JFT.SPMU
                    LEFT JOIN (
                        SELECT COUNT (nrk) TOT,SPMU FROM PERS_DUK_PANGKAT_HISTDUK
                        WHERE THBL = '".$res."' 
                        GROUP BY SPMU
                    ) TOT ON SPMU.SPMU_NEW = TOT.SPMU
                )PEGAWAI
                left join pers_tabel_spmu B on PEGAWAI.SPMU_NEW = B.KODE_SPM)X
                 ";

        $sql.=" WHERE 1=1"; 

        if( !empty($requestData['search']['value']) ) {   // if there is a search parameter, $requestData['search']['value'] contains search parameter
            $sql.=" AND ( SPMU_NEW LIKE UPPER('%".$requestData['search']['value']."%')";
            $sql.=" OR  NAMA LIKE UPPER('%".$requestData['search']['value']."%') )";
        }
        $query = $this->db->query($sql);
        $totalFiltered = $query->num_rows();
        $startrow = $requestData['start'];
        $endrow = $startrow + $requestData['length'];

        $sql.=" AND RN > ".$startrow." AND RN<= ".$endrow." AND ROWNUM <= ".$requestData['length'];
        $query = $this->db->query($sql);
        //$totalFiltered = $query->num_rows();

        $data = array();

    
        $no = $requestData['start']+1;
        
       
        foreach ($query->result() as $row)
        {            
            
            $nestedData=array();
            $nestedData[] = $no;
            $nestedData[] = $row->NAMA."<br/><strong><small class='text-navy'> ( ".$row->SPMU_NEW. " )</small></strong>";
            $nestedData[] = $row->ESELON2;
            $nestedData[] = $row->ESELON3;
            $nestedData[] = $row->ESELON4;
            $nestedData[] = $row->CPNS;
            $nestedData[] = $row->TEKNIS_AHLI;
            $nestedData[] = $row->TEKNIS_TERAMPIL;
            $nestedData[] = $row->ADMINISTRASI_AHLI;
            $nestedData[] = $row->ADMINISTRASI_TERAMPIL;
            $nestedData[] = $row->OPERASIONAL_AHLI;
            $nestedData[] = $row->OPERASIONAL_TERAMPIL;
            $nestedData[] = $row->PELAYANAN_AHLI;
            $nestedData[] = $row->PELAYANAN_TERAMPIL;
            $nestedData[] = $row->JFT;
            $nestedData[] = $row->LAINNYA;
            $nestedData[] = $row->TOT;
            
            $data[]=$nestedData;
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

    function getQueryGol($res)
    {
         $sql="SELECT 
                        GOL.GOL_NEW,
                        NVL (CPNS.JML_NRK, 0) AS CPNS,
                        NVL (ES2.JML_NRK, 0) AS ESELON2,
                        NVL (ES3.JML_NRK, 0) AS ESELON3,
                        NVL (ES4.JML_NRK, 0) AS ESELON4,
                        NVL (TA.TEK_AHLI, 0) AS TEKNIS_AHLI,
                        NVL (TT.TEK_TRP, 0) AS TEKNIS_TERAMPIL,
                        NVL (AA.ADM_AHLI, 0) AS ADMINISTRASI_AHLI,
                        NVL (ATR.ADM_TRP, 0) AS ADMINISTRASI_TERAMPIL,
                        NVL (OA.OPR_AHLI, 0) AS OPERASIONAL_AHLI,
                        NVL (OT.OPR_TRP, 0) AS OPERASIONAL_TERAMPIL,
                        NVL (LA.LAY_AHLI, 0) AS PELAYANAN_AHLI,
                        NVL (LT.LAY_TRP, 0) AS PELAYANAN_TERAMPIL,
                        NVL (NJ.NONJFU, 0) AS LAINNYA,
                        NVL (JFT.JF, 0) AS JFT,
                        NVL (TOT.TOT, 0) AS TOT
                    FROM
                        (
                            SELECT SUBSTR(GOL,2,1) AS GOL_NEW FROM PERS_DUK_PANGKAT_HISTDUK A
                            WHERE THBL = '".$res."' GROUP BY SUBSTR(GOL, 2, 1)
                        ) GOL
                    LEFT JOIN (
                        SELECT COUNT (nrk) AS JML_NRK,SUBSTR(GOL,2,1) GOL FROM PERS_DUK_PANGKAT_HISTDUK
                        WHERE THBL = '".$res."' AND STAPEG= 1
                        GROUP BY SUBSTR(GOL, 2, 1)
                    ) CPNS ON GOL.GOL_NEW = CPNS.GOL
                    LEFT JOIN (
                        SELECT COUNT (NRK) AS JML_NRK, SUBSTR(GOL,2,1) GOL FROM PERS_DUK_PANGKAT_HISTDUK
                        WHERE THBL = '".$res."' AND ESELON LIKE '2%' GROUP BY SUBSTR(GOL, 2, 1)
                    ) ES2 ON GOL.GOL_NEW = ES2.GOL
                    LEFT JOIN (
                        SELECT COUNT (NRK) AS JML_NRK,SUBSTR(GOL,2,1) GOL FROM PERS_DUK_PANGKAT_HISTDUK
                        WHERE THBL = '".$res."' AND ESELON LIKE '3%' GROUP BY SUBSTR(GOL,2,1)
                    ) ES3 ON GOL.GOL_NEW = ES3.GOL
                    LEFT JOIN (
                        SELECT COUNT (NRK) AS JML_NRK,SUBSTR(GOL,2,1) GOL FROM PERS_DUK_PANGKAT_HISTDUK
                        WHERE THBL = '".$res."' AND ESELON LIKE '4%' GROUP BY SUBSTR(GOL,2,1)
                    ) ES4 ON GOL.GOL_NEW = ES4.GOL
                    LEFT JOIN (
                        SELECT COUNT (nrk) TEK_AHLI, SUBSTR(GOL,2,1) GOL FROM PERS_DUK_PANGKAT_HISTDUK
                        WHERE THBL = '".$res."' AND KOJAB = '798011' GROUP BY SUBSTR(GOL,2,1)
                    ) TA ON GOL.GOL_NEW = TA.GOL
                    LEFT JOIN (
                        SELECT COUNT (nrk) TEK_TRP,SUBSTR(GOL,2,1) GOL FROM PERS_DUK_PANGKAT_HISTDUK
                        WHERE THBL = '".$res."' AND KOJAB = '798012' GROUP BY SUBSTR(GOL,2,1)
                    ) TT ON GOL.GOL_NEW = TT.GOL
                    LEFT JOIN (
                        SELECT COUNT (nrk) ADM_AHLI,SUBSTR(GOL,2,1) GOL FROM PERS_DUK_PANGKAT_HISTDUK
                        WHERE THBL = '".$res."' AND KOJAB = '798021' GROUP BY SUBSTR(GOL,2,1)
                    ) AA ON GOL.GOL_NEW = AA.GOL
                    LEFT JOIN (
                        SELECT COUNT (nrk) ADM_TRP,SUBSTR(GOL,2,1) GOL FROM PERS_DUK_PANGKAT_HISTDUK
                        WHERE THBL = '".$res."' AND KOJAB = '798022' GROUP BY SUBSTR(GOL,2,1)
                    ) ATR ON GOL.GOL_NEW = ATR.GOL
                    LEFT JOIN (
                        SELECT COUNT (nrk) OPR_AHLI, SUBSTR(GOL,2,1) GOL FROM PERS_DUK_PANGKAT_HISTDUK
                        WHERE THBL = '".$res."' AND KOJAB = '798031' GROUP BY SUBSTR(GOL,2,1)
                    ) OA ON GOL.GOL_NEW = OA.GOL
                    LEFT JOIN (
                        SELECT COUNT (nrk) OPR_TRP,SUBSTR(GOL,2,1) GOL FROM PERS_DUK_PANGKAT_HISTDUK
                        WHERE THBL = '".$res."' AND KOJAB = '798032' GROUP BY SUBSTR(GOL,2,1)
                    ) OT ON GOL.GOL_NEW = OT.GOL
                    LEFT JOIN (
                        SELECT COUNT (nrk) LAY_AHLI,SUBSTR(GOL,2,1) GOL FROM PERS_DUK_PANGKAT_HISTDUK
                        WHERE THBL = '".$res."' AND KOJAB = '798041' GROUP BY SUBSTR(GOL,2,1)
                    ) LA ON GOL.GOL_NEW = LA.GOL
                    LEFT JOIN (
                        SELECT COUNT (nrk) LAY_TRP,SUBSTR(GOL,2,1) GOL FROM PERS_DUK_PANGKAT_HISTDUK
                        WHERE THBL = '".$res."' AND KOJAB = '798042' GROUP BY SUBSTR(GOL,2,1)
                    ) LT ON GOL.GOL_NEW = LT.GOL
                    LEFT JOIN (
                        SELECT COUNT (nrk) NONJFU,SUBSTR(GOL,2,1) GOL FROM PERS_DUK_PANGKAT_HISTDUK
                        WHERE THBL = '".$res."' AND KOJAB NOT IN('798011','798012','798021','798022','798031','798032','798041','798042') AND KD='S' AND ESELON NOT LIKE '2%' AND ESELON NOT LIKE '3%' AND ESELON NOT LIKE '4%' 
                        GROUP BY SUBSTR(GOL,2,1)
                    ) NJ ON GOL.GOL_NEW = NJ.GOL
                    LEFT JOIN (
                        SELECT COUNT (nrk) JF,SUBSTR(GOL,2,1) GOL FROM PERS_DUK_PANGKAT_HISTDUK
                        WHERE THBL = '".$res."' AND KD = 'F' GROUP BY SUBSTR(GOL,2,1) 
                    ) JFT ON GOL.GOL_NEW = JFT.GOL
                    LEFT JOIN (
                        SELECT COUNT (nrk) TOT,SUBSTR(GOL,2,1) GOL FROM PERS_DUK_PANGKAT_HISTDUK
                        WHERE THBL = '".$res."' GROUP BY SUBSTR(GOL,2,1) 
                    ) TOT ON GOL.GOL_NEW = TOT.GOL 
                    ORDER BY GOL_NEW ASC ";
                $query = $this->db->query($sql)->result();

        return $query; 
    }

    function getDataPegawaiGol($res){
        $requestData = $this->input->post();
        
        $columns = array(
            0 => 'NO',
            1 => 'GOL',
            2 => 'ESELON2',
            3 => 'ESELON3',
            4 => 'ESELON4',
            5 => 'CPNS',
            6 => 'TA',
            7 => 'TP',
            8 => 'AA',
            9 => 'AP',
            10 => 'OA',
            11 => 'OP',
            12 => 'PA',
            13 => 'PT',
            14 => 'JFT',
            15 => 'LAINNYA',
            16 => 'TOTAL'
            );

        $q = "SELECT COUNT(DISTINCT SUBSTR(GOL,2,1)) AS jml FROM PERS_DUK_PANGKAT_HISTDUK
              WHERE THBL='".$res."' ORDER BY GOL ASC";
        $rs = $this->db->query($q)->result();
        $totalData = $rs[0]->JML;

       $sql = "SELECT ROWNUM,X.* FROM(
       SELECT ROWNUM AS rn,GOL_NEW,CPNS,ESELON2,ESELON3,ESELON4,TEKNIS_AHLI,TEKNIS_TERAMPIL,ADMINISTRASI_AHLI,ADMINISTRASI_TERAMPIL,OPERASIONAL_AHLI,OPERASIONAL_TERAMPIL,PELAYANAN_AHLI,PELAYANAN_TERAMPIL,
                LAINNYA,JFT,TOT 
                FROM
                (
                    SELECT 
                        GOL.GOL_NEW,
                        NVL (CPNS.JML_NRK, 0) AS CPNS,
                        NVL (ES2.JML_NRK, 0) AS ESELON2,
                        NVL (ES3.JML_NRK, 0) AS ESELON3,
                        NVL (ES4.JML_NRK, 0) AS ESELON4,
                        NVL (TA.TEK_AHLI, 0) AS TEKNIS_AHLI,
                        NVL (TT.TEK_TRP, 0) AS TEKNIS_TERAMPIL,
                        NVL (AA.ADM_AHLI, 0) AS ADMINISTRASI_AHLI,
                        NVL (ATR.ADM_TRP, 0) AS ADMINISTRASI_TERAMPIL,
                        NVL (OA.OPR_AHLI, 0) AS OPERASIONAL_AHLI,
                        NVL (OT.OPR_TRP, 0) AS OPERASIONAL_TERAMPIL,
                        NVL (LA.LAY_AHLI, 0) AS PELAYANAN_AHLI,
                        NVL (LT.LAY_TRP, 0) AS PELAYANAN_TERAMPIL,
                        NVL (NJ.NONJFU, 0) AS LAINNYA,
                        NVL (JFT.JF, 0) AS JFT,
                        NVL (TOT.TOT, 0) AS TOT
                    FROM
                        (
                            SELECT SUBSTR(GOL,2,1) AS GOL_NEW FROM PERS_DUK_PANGKAT_HISTDUK A
                            WHERE THBL = '".$res."' GROUP BY SUBSTR(GOL, 2, 1)
                        ) GOL
                    LEFT JOIN (
                        SELECT COUNT (nrk) AS JML_NRK,SUBSTR(GOL,2,1) GOL FROM PERS_DUK_PANGKAT_HISTDUK
                        WHERE THBL = '".$res."' AND STAPEG= 1
                        GROUP BY SUBSTR(GOL, 2, 1)
                    ) CPNS ON GOL.GOL_NEW = CPNS.GOL
                    LEFT JOIN (
                        SELECT COUNT (NRK) AS JML_NRK, SUBSTR(GOL,2,1) GOL FROM PERS_DUK_PANGKAT_HISTDUK
                        WHERE THBL = '".$res."' AND ESELON LIKE '2%' GROUP BY SUBSTR(GOL, 2, 1)
                    ) ES2 ON GOL.GOL_NEW = ES2.GOL
                    LEFT JOIN (
                        SELECT COUNT (NRK) AS JML_NRK,SUBSTR(GOL,2,1) GOL FROM PERS_DUK_PANGKAT_HISTDUK
                        WHERE THBL = '".$res."' AND ESELON LIKE '3%' GROUP BY SUBSTR(GOL,2,1)
                    ) ES3 ON GOL.GOL_NEW = ES3.GOL
                    LEFT JOIN (
                        SELECT COUNT (NRK) AS JML_NRK,SUBSTR(GOL,2,1) GOL FROM PERS_DUK_PANGKAT_HISTDUK
                        WHERE THBL = '".$res."' AND ESELON LIKE '4%' GROUP BY SUBSTR(GOL,2,1)
                    ) ES4 ON GOL.GOL_NEW = ES4.GOL
                    LEFT JOIN (
                        SELECT COUNT (nrk) TEK_AHLI, SUBSTR(GOL,2,1) GOL FROM PERS_DUK_PANGKAT_HISTDUK
                        WHERE THBL = '".$res."' AND KOJAB = '798011' GROUP BY SUBSTR(GOL,2,1)
                    ) TA ON GOL.GOL_NEW = TA.GOL
                    LEFT JOIN (
                        SELECT COUNT (nrk) TEK_TRP,SUBSTR(GOL,2,1) GOL FROM PERS_DUK_PANGKAT_HISTDUK
                        WHERE THBL = '".$res."' AND KOJAB = '798012' GROUP BY SUBSTR(GOL,2,1)
                    ) TT ON GOL.GOL_NEW = TT.GOL
                    LEFT JOIN (
                        SELECT COUNT (nrk) ADM_AHLI,SUBSTR(GOL,2,1) GOL FROM PERS_DUK_PANGKAT_HISTDUK
                        WHERE THBL = '".$res."' AND KOJAB = '798021' GROUP BY SUBSTR(GOL,2,1)
                    ) AA ON GOL.GOL_NEW = AA.GOL
                    LEFT JOIN (
                        SELECT COUNT (nrk) ADM_TRP,SUBSTR(GOL,2,1) GOL FROM PERS_DUK_PANGKAT_HISTDUK
                        WHERE THBL = '".$res."' AND KOJAB = '798022' GROUP BY SUBSTR(GOL,2,1)
                    ) ATR ON GOL.GOL_NEW = ATR.GOL
                    LEFT JOIN (
                        SELECT COUNT (nrk) OPR_AHLI, SUBSTR(GOL,2,1) GOL FROM PERS_DUK_PANGKAT_HISTDUK
                        WHERE THBL = '".$res."' AND KOJAB = '798031' GROUP BY SUBSTR(GOL,2,1)
                    ) OA ON GOL.GOL_NEW = OA.GOL
                    LEFT JOIN (
                        SELECT COUNT (nrk) OPR_TRP,SUBSTR(GOL,2,1) GOL FROM PERS_DUK_PANGKAT_HISTDUK
                        WHERE THBL = '".$res."' AND KOJAB = '798032' GROUP BY SUBSTR(GOL,2,1)
                    ) OT ON GOL.GOL_NEW = OT.GOL
                    LEFT JOIN (
                        SELECT COUNT (nrk) LAY_AHLI,SUBSTR(GOL,2,1) GOL FROM PERS_DUK_PANGKAT_HISTDUK
                        WHERE THBL = '".$res."' AND KOJAB = '798041' GROUP BY SUBSTR(GOL,2,1)
                    ) LA ON GOL.GOL_NEW = LA.GOL
                    LEFT JOIN (
                        SELECT COUNT (nrk) LAY_TRP,SUBSTR(GOL,2,1) GOL FROM PERS_DUK_PANGKAT_HISTDUK
                        WHERE THBL = '".$res."' AND KOJAB = '798042' GROUP BY SUBSTR(GOL,2,1)
                    ) LT ON GOL.GOL_NEW = LT.GOL
                    LEFT JOIN (
                        SELECT COUNT (nrk) NONJFU,SUBSTR(GOL,2,1) GOL FROM PERS_DUK_PANGKAT_HISTDUK
                        WHERE THBL = '".$res."' AND KOJAB NOT IN('798011','798012','798021','798022','798031','798032','798041','798042') AND KD='S' AND ESELON NOT LIKE '2%' AND ESELON NOT LIKE '3%' AND ESELON NOT LIKE '4%' 
                        GROUP BY SUBSTR(GOL,2,1)
                    ) NJ ON GOL.GOL_NEW = NJ.GOL
                    LEFT JOIN (
                        SELECT COUNT (nrk) JF,SUBSTR(GOL,2,1) GOL FROM PERS_DUK_PANGKAT_HISTDUK
                        WHERE THBL = '".$res."' AND KD = 'F' GROUP BY SUBSTR(GOL,2,1) 
                    ) JFT ON GOL.GOL_NEW = JFT.GOL
                    LEFT JOIN (
                        SELECT COUNT (nrk) TOT,SUBSTR(GOL,2,1) GOL FROM PERS_DUK_PANGKAT_HISTDUK
                        WHERE THBL = '".$res."' GROUP BY SUBSTR(GOL,2,1) 
                    ) TOT ON GOL.GOL_NEW = TOT.GOL
                )PEGAWAI ORDER BY GOL_NEW ASC )X";

        $sql.=" WHERE 1=1"; 

        if( !empty($requestData['search']['value']) ) {   // if there is a search parameter, $requestData['search']['value'] contains search parameter
            $sql.=" AND ( GOL_NEW LIKE UPPER('%".$requestData['search']['value']."%') )";
            
        }
        $startrow = $requestData['start'];
        $endrow = $startrow + $requestData['length'];

        $sql.=" AND RN BETWEEN $startrow  AND $endrow";
        
        $query = $this->db->query($sql);
        $totalFiltered = $query->num_rows();

        $data = array();

    
        $no = $requestData['start']+1;
        
       
        foreach ($query->result() as $row)
        {            
            
            $nestedData=array();
            $nestedData[] = $no;
            $nestedData[] = $row->GOL_NEW;
            $nestedData[] = $row->ESELON2;
            $nestedData[] = $row->ESELON3;
            $nestedData[] = $row->ESELON4;
            $nestedData[] = $row->CPNS;
            $nestedData[] = $row->TEKNIS_AHLI;
            $nestedData[] = $row->TEKNIS_TERAMPIL;
            $nestedData[] = $row->ADMINISTRASI_AHLI;
            $nestedData[] = $row->ADMINISTRASI_TERAMPIL;
            $nestedData[] = $row->OPERASIONAL_AHLI;
            $nestedData[] = $row->OPERASIONAL_TERAMPIL;
            $nestedData[] = $row->PELAYANAN_AHLI;
            $nestedData[] = $row->PELAYANAN_TERAMPIL;
            $nestedData[] = $row->JFT;
            $nestedData[] = $row->LAINNYA;
            $nestedData[] = $row->TOT;
            
            $data[]=$nestedData;
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

    function getQueryTKD($res)
    {
        $sql="SELECT
                GOL.GOL_NEW,
                NVL (CPNS.JML_NRK, 0) AS CPNS,
                NVL (ES2.JML_NRK, 0) AS ESELON2,
                NVL (ES3.JML_NRK, 0) AS ESELON3,
                NVL (ES4.JML_NRK, 0) AS ESELON4,
                NVL (TA.TEK_AHLI, 0) AS TEKNIS_AHLI,
                NVL (TT.TEK_TRP, 0) AS TEKNIS_TERAMPIL,
                NVL (AA.ADM_AHLI, 0) AS ADMINISTRASI_AHLI,
                NVL (ATR.ADM_TRP, 0) AS ADMINISTRASI_TERAMPIL,
                NVL (OA.OPR_AHLI, 0) AS OPERASIONAL_AHLI,
                NVL (OT.OPR_TRP, 0) AS OPERASIONAL_TERAMPIL,
                NVL (LA.LAY_AHLI, 0) AS PELAYANAN_AHLI,
                NVL (LT.LAY_TRP, 0) AS PELAYANAN_TERAMPIL,
                NVL (NJ.NONJFU, 0) AS LAINNYA,
                NVL (JFT.JF, 0) AS JFT,
                NVL (TOT.TOT, 0) AS TOT
            FROM
            (   SELECT SUBSTR (GOL, 2, 1) AS GOL_NEW FROM PROSES_TKD_TAHAP2 A
                WHERE THBL = '".$res."' GROUP BY SUBSTR (GOL, 2, 1)
            ) GOL
            LEFT JOIN 
            (
                SELECT SUM (NJTUNDABERSIH) AS JML_NRK, SUBSTR (GOL, 2, 1) GOL FROM PROSES_TKD_TAHAP2
                WHERE THBL = '".$res."' AND STAPEG = 1 AND UPLOAD = 1 GROUP BY SUBSTR (GOL, 2, 1)
            ) CPNS ON GOL.GOL_NEW = CPNS.GOL
            LEFT JOIN 
            (
                SELECT SUM (NJTUNDABERSIH) AS JML_NRK, SUBSTR (GOL, 2, 1) GOL FROM PROSES_TKD_TAHAP2
                WHERE THBL = '".$res."' AND ESELON LIKE '2%' AND UPLOAD = 1 GROUP BY SUBSTR (GOL, 2, 1)
            ) ES2 ON GOL.GOL_NEW = ES2.GOL
            LEFT JOIN 
            (
                SELECT SUM (NJTUNDABERSIH) AS JML_NRK, SUBSTR (GOL, 2, 1) GOL FROM PROSES_TKD_TAHAP2
                WHERE THBL = '".$res."' AND ESELON LIKE '3%' AND UPLOAD = 1 GROUP BY SUBSTR (GOL, 2, 1)
            ) ES3 ON GOL.GOL_NEW = ES3.GOL
            LEFT JOIN 
            (
                SELECT SUM (NJTUNDABERSIH) AS JML_NRK, SUBSTR (GOL, 2, 1) GOL FROM PROSES_TKD_TAHAP2
                WHERE THBL = '".$res."' AND ESELON LIKE '4%' AND UPLOAD = 1 GROUP BY SUBSTR (GOL, 2, 1)
            ) ES4 ON GOL.GOL_NEW = ES4.GOL
            LEFT JOIN 
            (
                SELECT SUM (NJTUNDABERSIH) TEK_AHLI, SUBSTR (GOL, 2, 1) GOL FROM PROSES_TKD_TAHAP2
                WHERE THBL = '".$res."' AND KOJAB = '798011' AND UPLOAD = 1 GROUP BY SUBSTR (GOL, 2, 1)
            ) TA ON GOL.GOL_NEW = TA.GOL
            LEFT JOIN (
                SELECT SUM (NJTUNDABERSIH) TEK_TRP, SUBSTR (GOL, 2, 1) GOL FROM PROSES_TKD_TAHAP2
                WHERE THBL = '".$res."' AND KOJAB = '798012' AND UPLOAD = 1 GROUP BY SUBSTR (GOL, 2, 1)
            ) TT ON GOL.GOL_NEW = TT.GOL
            LEFT JOIN 
            (
                SELECT SUM (NJTUNDABERSIH) ADM_AHLI, SUBSTR (GOL, 2, 1) GOL FROM PROSES_TKD_TAHAP2
                WHERE THBL = '".$res."' AND KOJAB = '798021' AND UPLOAD = 1 GROUP BY SUBSTR (GOL, 2, 1)
            ) AA ON GOL.GOL_NEW = AA.GOL
            LEFT JOIN 
            (
                SELECT SUM (NJTUNDABERSIH) ADM_TRP, SUBSTR (GOL, 2, 1) GOL FROM PROSES_TKD_TAHAP2
                WHERE THBL = '".$res."' AND KOJAB = '798022' AND UPLOAD = 1 GROUP BY SUBSTR (GOL, 2, 1)
            ) ATR ON GOL.GOL_NEW = ATR.GOL
            LEFT JOIN 
            (
                SELECT SUM (NJTUNDABERSIH) OPR_AHLI, SUBSTR (GOL, 2, 1) GOL FROM PROSES_TKD_TAHAP2
                WHERE THBL = '".$res."' AND KOJAB = '798031' AND UPLOAD = 1 GROUP BY SUBSTR (GOL, 2, 1)
            ) OA ON GOL.GOL_NEW = OA.GOL
            LEFT JOIN 
            (
                SELECT SUM (NJTUNDABERSIH) OPR_TRP, SUBSTR (GOL, 2, 1) GOL FROM PROSES_TKD_TAHAP2
                WHERE THBL = '".$res."' AND KOJAB = '798032' AND UPLOAD = 1 GROUP BY SUBSTR (GOL, 2, 1)
            ) OT ON GOL.GOL_NEW = OT.GOL
            LEFT JOIN 
            (
                SELECT SUM (NJTUNDABERSIH) LAY_AHLI, SUBSTR (GOL, 2, 1) GOL FROM PROSES_TKD_TAHAP2
                WHERE THBL = '".$res."' AND KOJAB = '798041' AND UPLOAD = 1 GROUP BY SUBSTR (GOL, 2, 1)
            ) LA ON GOL.GOL_NEW = LA.GOL
            LEFT JOIN (
                SELECT SUM (NJTUNDABERSIH) LAY_TRP, SUBSTR (GOL, 2, 1) GOL FROM PROSES_TKD_TAHAP2
                WHERE THBL = '".$res."' AND KOJAB = '798042' AND UPLOAD = 1 GROUP BY SUBSTR (GOL, 2, 1)
            ) LT ON GOL.GOL_NEW = LT.GOL
            LEFT JOIN 
            (
                SELECT SUM (NJTUNDABERSIH) NONJFU, SUBSTR (GOL, 2, 1) GOL FROM PROSES_TKD_TAHAP2
                WHERE THBL = '".$res."' AND KOJAB NOT IN ('798011','798012','798021','798022','798031','798032','798041','798042')
                AND KD = 'S' AND ESELON NOT LIKE '2%' AND ESELON NOT LIKE '3%' AND ESELON NOT LIKE '4%' AND UPLOAD = 1
                GROUP BY SUBSTR (GOL, 2, 1)
            ) NJ ON GOL.GOL_NEW = NJ.GOL
            LEFT JOIN 
            (
                SELECT SUM (NJTUNDABERSIH) JF,SUBSTR (GOL, 2, 1) GOL FROM PROSES_TKD_TAHAP2
                WHERE THBL = '".$res."' AND KD = 'F' AND UPLOAD = 1 GROUP BY SUBSTR (GOL, 2, 1)
            ) JFT ON GOL.GOL_NEW = JFT.GOL
            LEFT JOIN 
            (
                SELECT SUM (NJTUNDABERSIH) TOT, SUBSTR (GOL, 2, 1) GOL FROM PROSES_TKD_TAHAP2
                WHERE THBL = '".$res ."' AND UPLOAD = 1 GROUP BY SUBSTR (GOL, 2, 1)
            ) TOT ON GOL.GOL_NEW = TOT.GOL
            ORDER BY GOL_NEW ASC";

        $query = $this->db->query($sql)->result();

        return $query; 

    }

    function getDataTKD($res){
        $requestData = $this->input->post();
        
        $columns = array(
            0 => 'NO',
            1 => 'GOL',
            2 => 'ESELON2',
            3 => 'ESELON3',
            4 => 'ESELON4',
            5 => 'CPNS',
            6 => 'TA',
            7 => 'TP',
            8 => 'AA',
            9 => 'AP',
            10 => 'OA',
            11 => 'OP',
            12 => 'PA',
            13 => 'PT',
            14 => 'JFT',
            15 => 'LAINNYA',
            16 => 'TOTAL'
            );

        $q = "SELECT COUNT(DISTINCT SUBSTR(GOL,2,1)) AS jml FROM PROSES_TKD_TAHAP2
              WHERE THBL='".$res."' ORDER BY GOL ASC";

        $rs = $this->db->query($q)->result();
        $totalData = $rs[0]->JML;

       $sql = "SELECT ROWNUM,X.* FROM(
       SELECT ROWNUM AS rn,GOL_NEW,CPNS,ESELON2,ESELON3,ESELON4,TEKNIS_AHLI,TEKNIS_TERAMPIL,ADMINISTRASI_AHLI,ADMINISTRASI_TERAMPIL,OPERASIONAL_AHLI,OPERASIONAL_TERAMPIL,PELAYANAN_AHLI,PELAYANAN_TERAMPIL,LAINNYA,JFT,TOT 
                FROM
                (
                    SELECT
                        GOL.GOL_NEW,
                        NVL (CPNS.JML_NRK, 0) AS CPNS,
                        NVL (ES2.JML_NRK, 0) AS ESELON2,
                        NVL (ES3.JML_NRK, 0) AS ESELON3,
                        NVL (ES4.JML_NRK, 0) AS ESELON4,
                        NVL (TA.TEK_AHLI, 0) AS TEKNIS_AHLI,
                        NVL (TT.TEK_TRP, 0) AS TEKNIS_TERAMPIL,
                        NVL (AA.ADM_AHLI, 0) AS ADMINISTRASI_AHLI,
                        NVL (ATR.ADM_TRP, 0) AS ADMINISTRASI_TERAMPIL,
                        NVL (OA.OPR_AHLI, 0) AS OPERASIONAL_AHLI,
                        NVL (OT.OPR_TRP, 0) AS OPERASIONAL_TERAMPIL,
                        NVL (LA.LAY_AHLI, 0) AS PELAYANAN_AHLI,
                        NVL (LT.LAY_TRP, 0) AS PELAYANAN_TERAMPIL,
                        NVL (NJ.NONJFU, 0) AS LAINNYA,
                        NVL (JFT.JF, 0) AS JFT,
                        NVL (TOT.TOT, 0) AS TOT
                    FROM
                    (   SELECT SUBSTR (GOL, 2, 1) AS GOL_NEW FROM PROSES_TKD_TAHAP2 A
                        WHERE THBL = '".$res."' AND UPLOAD = 1 GROUP BY SUBSTR (GOL, 2, 1)
                    ) GOL
                    LEFT JOIN 
                    (
                        SELECT SUM (NJTUNDABERSIH) AS JML_NRK, SUBSTR (GOL, 2, 1) GOL FROM PROSES_TKD_TAHAP2
                        WHERE THBL = '".$res."' AND STAPEG = 1 AND UPLOAD = 1 GROUP BY SUBSTR (GOL, 2, 1)
                    ) CPNS ON GOL.GOL_NEW = CPNS.GOL
                    LEFT JOIN 
                    (
                        SELECT SUM (NJTUNDABERSIH) AS JML_NRK, SUBSTR (GOL, 2, 1) GOL FROM PROSES_TKD_TAHAP2
                        WHERE THBL = '".$res."' AND ESELON LIKE '2%' AND UPLOAD = 1 GROUP BY SUBSTR (GOL, 2, 1)
                    ) ES2 ON GOL.GOL_NEW = ES2.GOL
                    LEFT JOIN 
                    (
                        SELECT SUM (NJTUNDABERSIH) AS JML_NRK, SUBSTR (GOL, 2, 1) GOL FROM PROSES_TKD_TAHAP2
                        WHERE THBL = '".$res."' AND ESELON LIKE '3%' AND UPLOAD = 1 GROUP BY SUBSTR (GOL, 2, 1)
                    ) ES3 ON GOL.GOL_NEW = ES3.GOL
                    LEFT JOIN 
                    (
                        SELECT SUM (NJTUNDABERSIH) AS JML_NRK, SUBSTR (GOL, 2, 1) GOL FROM PROSES_TKD_TAHAP2
                        WHERE THBL = '".$res."' AND ESELON LIKE '4%' AND UPLOAD = 1 GROUP BY SUBSTR (GOL, 2, 1)
                    ) ES4 ON GOL.GOL_NEW = ES4.GOL
                    LEFT JOIN 
                    (
                        SELECT SUM (NJTUNDABERSIH) TEK_AHLI, SUBSTR (GOL, 2, 1) GOL FROM PROSES_TKD_TAHAP2
                        WHERE THBL = '".$res."' AND KOJAB = '798011' AND UPLOAD = 1 GROUP BY SUBSTR (GOL, 2, 1)
                    ) TA ON GOL.GOL_NEW = TA.GOL
                    LEFT JOIN (
                        SELECT SUM (NJTUNDABERSIH) TEK_TRP, SUBSTR (GOL, 2, 1) GOL FROM PROSES_TKD_TAHAP2
                        WHERE THBL = '".$res."' AND KOJAB = '798012' AND UPLOAD = 1 GROUP BY SUBSTR (GOL, 2, 1)
                    ) TT ON GOL.GOL_NEW = TT.GOL
                    LEFT JOIN 
                    (
                        SELECT SUM (NJTUNDABERSIH) ADM_AHLI, SUBSTR (GOL, 2, 1) GOL FROM PROSES_TKD_TAHAP2
                        WHERE THBL = '".$res."' AND KOJAB = '798021' AND UPLOAD = 1 GROUP BY SUBSTR (GOL, 2, 1)
                    ) AA ON GOL.GOL_NEW = AA.GOL
                    LEFT JOIN 
                    (
                        SELECT SUM (NJTUNDABERSIH) ADM_TRP, SUBSTR (GOL, 2, 1) GOL FROM PROSES_TKD_TAHAP2
                        WHERE THBL = '".$res."' AND KOJAB = '798022' AND UPLOAD = 1 GROUP BY SUBSTR (GOL, 2, 1)
                    ) ATR ON GOL.GOL_NEW = ATR.GOL
                    LEFT JOIN 
                    (
                        SELECT SUM (NJTUNDABERSIH) OPR_AHLI, SUBSTR (GOL, 2, 1) GOL FROM PROSES_TKD_TAHAP2
                        WHERE THBL = '".$res."' AND KOJAB = '798031' AND UPLOAD = 1 GROUP BY SUBSTR (GOL, 2, 1)
                    ) OA ON GOL.GOL_NEW = OA.GOL
                    LEFT JOIN 
                    (
                        SELECT SUM (NJTUNDABERSIH) OPR_TRP, SUBSTR (GOL, 2, 1) GOL FROM PROSES_TKD_TAHAP2
                        WHERE THBL = '".$res."' AND KOJAB = '798032' AND UPLOAD = 1 GROUP BY SUBSTR (GOL, 2, 1)
                    ) OT ON GOL.GOL_NEW = OT.GOL
                    LEFT JOIN 
                    (
                        SELECT SUM (NJTUNDABERSIH) LAY_AHLI, SUBSTR (GOL, 2, 1) GOL FROM PROSES_TKD_TAHAP2
                        WHERE THBL = '".$res."' AND KOJAB = '798041' AND UPLOAD = 1 GROUP BY SUBSTR (GOL, 2, 1)
                    ) LA ON GOL.GOL_NEW = LA.GOL
                    LEFT JOIN (
                        SELECT SUM (NJTUNDABERSIH) LAY_TRP, SUBSTR (GOL, 2, 1) GOL FROM PROSES_TKD_TAHAP2
                        WHERE THBL = '".$res."' AND KOJAB = '798042' AND UPLOAD = 1 GROUP BY SUBSTR (GOL, 2, 1)
                    ) LT ON GOL.GOL_NEW = LT.GOL
                    LEFT JOIN 
                    (
                        SELECT SUM (NJTUNDABERSIH) NONJFU, SUBSTR (GOL, 2, 1) GOL FROM PROSES_TKD_TAHAP2
                        WHERE THBL = '".$res."' AND KOJAB NOT IN ('798011','798012','798021','798022','798031','798032','798041','798042')
                        AND KD = 'S' AND ESELON NOT LIKE '2%' AND ESELON NOT LIKE '3%' AND ESELON NOT LIKE '4%' AND UPLOAD = 1
                        GROUP BY SUBSTR (GOL, 2, 1)
                    ) NJ ON GOL.GOL_NEW = NJ.GOL
                    LEFT JOIN 
                    (
                        SELECT SUM (NJTUNDABERSIH) JF,SUBSTR (GOL, 2, 1) GOL FROM PROSES_TKD_TAHAP2
                        WHERE THBL = '".$res."' AND KD = 'F' AND UPLOAD = 1 GROUP BY SUBSTR (GOL, 2, 1)
                    ) JFT ON GOL.GOL_NEW = JFT.GOL
                    LEFT JOIN 
                    (
                        SELECT SUM (NJTUNDABERSIH) TOT, SUBSTR (GOL, 2, 1) GOL FROM PROSES_TKD_TAHAP2
                        WHERE THBL = '".$res ."'  AND UPLOAD = 1 GROUP BY SUBSTR (GOL, 2, 1)
                    ) TOT ON GOL.GOL_NEW = TOT.GOL
                )PEGAWAI ORDER BY GOL_NEW ASC )X";

        $sql.=" WHERE 1=1"; 

        if( !empty($requestData['search']['value']) ) {   // if there is a search parameter, $requestData['search']['value'] contains search parameter
            $sql.=" AND ( GOL_NEW LIKE UPPER('%".$requestData['search']['value']."%') )";
            
        }
        $startrow = $requestData['start'];
        $endrow = $startrow + $requestData['length'];

        $sql.=" AND RN BETWEEN $startrow  AND $endrow";
        
        $query = $this->db->query($sql);
        $totalFiltered = $query->num_rows();

        $data = array();

    
        $no = $requestData['start']+1;
        
       
        foreach ($query->result() as $row)
        {            
            
            $nestedData=array();
            $nestedData[] = $no;
            $nestedData[] = number_format($row->GOL_NEW, 0, ',', '.');
            $nestedData[] = number_format($row->ESELON2, 0, ',', '.');
            $nestedData[] = number_format($row->ESELON3, 0, ',', '.');
            $nestedData[] = number_format($row->ESELON4, 0, ',', '.');
            $nestedData[] = number_format($row->CPNS, 0, ',', '.');
            $nestedData[] = number_format($row->TEKNIS_AHLI, 0, ',', '.');
            $nestedData[] = number_format($row->TEKNIS_TERAMPIL, 0, ',', '.');
            $nestedData[] = number_format($row->ADMINISTRASI_AHLI, 0, ',', '.');
            $nestedData[] = number_format($row->ADMINISTRASI_TERAMPIL, 0, ',', '.');
            $nestedData[] = number_format($row->OPERASIONAL_AHLI, 0, ',', '.');
            $nestedData[] = number_format($row->OPERASIONAL_TERAMPIL, 0, ',', '.');
            $nestedData[] = number_format($row->PELAYANAN_AHLI, 0, ',', '.');
            $nestedData[] = number_format($row->PELAYANAN_TERAMPIL, 0, ',', '.');
            $nestedData[] = number_format($row->JFT, 0, ',', '.');
            $nestedData[] = number_format($row->LAINNYA, 0, ',', '.');
            $nestedData[] = number_format($row->TOT, 0, ',', '.');
            
            $data[]=$nestedData;
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

    function getQueryGaji($res)
    {
        $sql="SELECT
                GOL.GOL_NEW,
                NVL (CPNS.JML_NRK, 0) AS CPNS,
                NVL (ES2.JML_NRK, 0) AS ESELON2,
                NVL (ES3.JML_NRK, 0) AS ESELON3,
                NVL (ES4.JML_NRK, 0) AS ESELON4,
                NVL (TA.TEK_AHLI, 0) AS TEKNIS_AHLI,
                NVL (TT.TEK_TRP, 0) AS TEKNIS_TERAMPIL,
                NVL (AA.ADM_AHLI, 0) AS ADMINISTRASI_AHLI,
                NVL (ATR.ADM_TRP, 0) AS ADMINISTRASI_TERAMPIL,
                NVL (OA.OPR_AHLI, 0) AS OPERASIONAL_AHLI,
                NVL (OT.OPR_TRP, 0) AS OPERASIONAL_TERAMPIL,
                NVL (LA.LAY_AHLI, 0) AS PELAYANAN_AHLI,
                NVL (LT.LAY_TRP, 0) AS PELAYANAN_TERAMPIL,
                NVL (NJ.NONJFU, 0) AS LAINNYA,
                NVL (JFT.JF, 0) AS JFT,
                NVL (TOT.TOT, 0) AS TOT
            FROM
            (   SELECT SUBSTR (GOL, 2, 1) AS GOL_NEW FROM PROSES_TKD_TAHAP2 A
                WHERE THBL = '".$res."' GROUP BY SUBSTR (GOL, 2, 1)
            ) GOL
            LEFT JOIN 
            (
                SELECT SUM (NJUMBERGAJI) AS JML_NRK, SUBSTR (GOL, 2, 1) GOL FROM PERS_DUK_PANGKAT_HISTDUK
                WHERE THBL = '".$res."' AND STAPEG = 1 GROUP BY SUBSTR (GOL, 2, 1)
            ) CPNS ON GOL.GOL_NEW = CPNS.GOL
            LEFT JOIN 
            (
                SELECT SUM (NJUMBERGAJI) AS JML_NRK, SUBSTR (GOL, 2, 1) GOL FROM PERS_DUK_PANGKAT_HISTDUK
                WHERE THBL = '".$res."' AND ESELON LIKE '2%' GROUP BY SUBSTR (GOL, 2, 1)
            ) ES2 ON GOL.GOL_NEW = ES2.GOL
            LEFT JOIN 
            (
                SELECT SUM (NJUMBERGAJI) AS JML_NRK, SUBSTR (GOL, 2, 1) GOL FROM PERS_DUK_PANGKAT_HISTDUK
                WHERE THBL = '".$res."' AND ESELON LIKE '3%' GROUP BY SUBSTR (GOL, 2, 1)
            ) ES3 ON GOL.GOL_NEW = ES3.GOL
            LEFT JOIN 
            (
                SELECT SUM (NJUMBERGAJI) AS JML_NRK, SUBSTR (GOL, 2, 1) GOL FROM PERS_DUK_PANGKAT_HISTDUK
                WHERE THBL = '".$res."' AND ESELON LIKE '4%' GROUP BY SUBSTR (GOL, 2, 1)
            ) ES4 ON GOL.GOL_NEW = ES4.GOL
            LEFT JOIN 
            (
                SELECT SUM (NJUMBERGAJI) TEK_AHLI, SUBSTR (GOL, 2, 1) GOL FROM PERS_DUK_PANGKAT_HISTDUK
                WHERE THBL = '".$res."' AND KOJAB = '798011' GROUP BY SUBSTR (GOL, 2, 1)
            ) TA ON GOL.GOL_NEW = TA.GOL
            LEFT JOIN (
                SELECT SUM (NJUMBERGAJI) TEK_TRP, SUBSTR (GOL, 2, 1) GOL FROM PERS_DUK_PANGKAT_HISTDUK
                WHERE THBL = '".$res."' AND KOJAB = '798012' GROUP BY SUBSTR (GOL, 2, 1)
            ) TT ON GOL.GOL_NEW = TT.GOL
            LEFT JOIN 
            (
                SELECT SUM (NJUMBERGAJI) ADM_AHLI, SUBSTR (GOL, 2, 1) GOL FROM PERS_DUK_PANGKAT_HISTDUK
                WHERE THBL = '".$res."' AND KOJAB = '798021' GROUP BY SUBSTR (GOL, 2, 1)
            ) AA ON GOL.GOL_NEW = AA.GOL
            LEFT JOIN 
            (
                SELECT SUM (NJUMBERGAJI) ADM_TRP, SUBSTR (GOL, 2, 1) GOL FROM PERS_DUK_PANGKAT_HISTDUK
                WHERE THBL = '".$res."' AND KOJAB = '798022' GROUP BY SUBSTR (GOL, 2, 1)
            ) ATR ON GOL.GOL_NEW = ATR.GOL
            LEFT JOIN 
            (
                SELECT SUM (NJUMBERGAJI) OPR_AHLI, SUBSTR (GOL, 2, 1) GOL FROM PERS_DUK_PANGKAT_HISTDUK
                WHERE THBL = '".$res."' AND KOJAB = '798031' GROUP BY SUBSTR (GOL, 2, 1)
            ) OA ON GOL.GOL_NEW = OA.GOL
            LEFT JOIN 
            (
                SELECT SUM (NJUMBERGAJI) OPR_TRP, SUBSTR (GOL, 2, 1) GOL FROM PERS_DUK_PANGKAT_HISTDUK
                WHERE THBL = '".$res."' AND KOJAB = '798032' GROUP BY SUBSTR (GOL, 2, 1)
            ) OT ON GOL.GOL_NEW = OT.GOL
            LEFT JOIN 
            (
                SELECT SUM (NJUMBERGAJI) LAY_AHLI, SUBSTR (GOL, 2, 1) GOL FROM PERS_DUK_PANGKAT_HISTDUK
                WHERE THBL = '".$res."' AND KOJAB = '798041' GROUP BY SUBSTR (GOL, 2, 1)
            ) LA ON GOL.GOL_NEW = LA.GOL
            LEFT JOIN (
                SELECT SUM (NJUMBERGAJI) LAY_TRP, SUBSTR (GOL, 2, 1) GOL FROM PERS_DUK_PANGKAT_HISTDUK
                WHERE THBL = '".$res."' AND KOJAB = '798042' GROUP BY SUBSTR (GOL, 2, 1)
            ) LT ON GOL.GOL_NEW = LT.GOL
            LEFT JOIN 
            (
                SELECT SUM (NJUMBERGAJI) NONJFU, SUBSTR (GOL, 2, 1) GOL FROM PERS_DUK_PANGKAT_HISTDUK
                WHERE THBL = '".$res."' AND KOJAB NOT IN ('798011','798012','798021','798022','798031','798032','798041','798042')
                AND KD = 'S' AND ESELON NOT LIKE '2%' AND ESELON NOT LIKE '3%' AND ESELON NOT LIKE '4%'
                GROUP BY SUBSTR (GOL, 2, 1)
            ) NJ ON GOL.GOL_NEW = NJ.GOL
            LEFT JOIN 
            (
                SELECT SUM (NJUMBERGAJI) JF,SUBSTR (GOL, 2, 1) GOL FROM PERS_DUK_PANGKAT_HISTDUK
                WHERE THBL = '".$res."' AND KD = 'F' GROUP BY SUBSTR (GOL, 2, 1)
            ) JFT ON GOL.GOL_NEW = JFT.GOL
            LEFT JOIN 
            (
                SELECT SUM (NJUMBERGAJI) TOT, SUBSTR (GOL, 2, 1) GOL FROM PERS_DUK_PANGKAT_HISTDUK
                WHERE THBL = '".$res ."' GROUP BY SUBSTR (GOL, 2, 1)
            ) TOT ON GOL.GOL_NEW = TOT.GOL
            ORDER BY GOL_NEW ASC";

        $query = $this->db->query($sql)->result();

        return $query; 

    }

    function getDataGaji($res){
        $requestData = $this->input->post();
        
        $columns = array(
            0 => 'NO',
            1 => 'GOL',
            2 => 'ESELON2',
            3 => 'ESELON3',
            4 => 'ESELON4',
            5 => 'CPNS',
            6 => 'TA',
            7 => 'TP',
            8 => 'AA',
            9 => 'AP',
            10 => 'OA',
            11 => 'OP',
            12 => 'PA',
            13 => 'PT',
            14 => 'JFT',
            15 => 'LAINNYA',
            16 => 'TOTAL'
            );

        $q = "SELECT COUNT(DISTINCT SUBSTR(GOL,2,1)) AS jml FROM PERS_DUK_PANGKAT_HISTDUK
              WHERE THBL='".$res."' ORDER BY GOL ASC";
        $rs = $this->db->query($q)->result();
        $totalData = $rs[0]->JML;

       $sql = "SELECT ROWNUM,X.* FROM(
       SELECT ROWNUM AS rn,GOL_NEW,CPNS,ESELON2,ESELON3,ESELON4,TEKNIS_AHLI,TEKNIS_TERAMPIL,ADMINISTRASI_AHLI,ADMINISTRASI_TERAMPIL,OPERASIONAL_AHLI,OPERASIONAL_TERAMPIL,PELAYANAN_AHLI,PELAYANAN_TERAMPIL,LAINNYA,JFT,TOT 
                FROM
                (
                    SELECT
                        GOL.GOL_NEW,
                        NVL (CPNS.JML_NRK, 0) AS CPNS,
                        NVL (ES2.JML_NRK, 0) AS ESELON2,
                        NVL (ES3.JML_NRK, 0) AS ESELON3,
                        NVL (ES4.JML_NRK, 0) AS ESELON4,
                        NVL (TA.TEK_AHLI, 0) AS TEKNIS_AHLI,
                        NVL (TT.TEK_TRP, 0) AS TEKNIS_TERAMPIL,
                        NVL (AA.ADM_AHLI, 0) AS ADMINISTRASI_AHLI,
                        NVL (ATR.ADM_TRP, 0) AS ADMINISTRASI_TERAMPIL,
                        NVL (OA.OPR_AHLI, 0) AS OPERASIONAL_AHLI,
                        NVL (OT.OPR_TRP, 0) AS OPERASIONAL_TERAMPIL,
                        NVL (LA.LAY_AHLI, 0) AS PELAYANAN_AHLI,
                        NVL (LT.LAY_TRP, 0) AS PELAYANAN_TERAMPIL,
                        NVL (NJ.NONJFU, 0) AS LAINNYA,
                        NVL (JFT.JF, 0) AS JFT,
                        NVL (TOT.TOT, 0) AS TOT
                    FROM
                    (   SELECT SUBSTR (GOL, 2, 1) AS GOL_NEW FROM PROSES_TKD_TAHAP2 A
                        WHERE THBL = '".$res."' GROUP BY SUBSTR (GOL, 2, 1)
                    ) GOL
                    LEFT JOIN 
                    (
                        SELECT SUM (NJUMBERGAJI) AS JML_NRK, SUBSTR (GOL, 2, 1) GOL FROM PERS_DUK_PANGKAT_HISTDUK
                        WHERE THBL = '".$res."' AND STAPEG = 1 GROUP BY SUBSTR (GOL, 2, 1)
                    ) CPNS ON GOL.GOL_NEW = CPNS.GOL
                    LEFT JOIN 
                    (
                        SELECT SUM (NJUMBERGAJI) AS JML_NRK, SUBSTR (GOL, 2, 1) GOL FROM PERS_DUK_PANGKAT_HISTDUK
                        WHERE THBL = '".$res."' AND ESELON LIKE '2%' GROUP BY SUBSTR (GOL, 2, 1)
                    ) ES2 ON GOL.GOL_NEW = ES2.GOL
                    LEFT JOIN 
                    (
                        SELECT SUM (NJUMBERGAJI) AS JML_NRK, SUBSTR (GOL, 2, 1) GOL FROM PERS_DUK_PANGKAT_HISTDUK
                        WHERE THBL = '".$res."' AND ESELON LIKE '3%' GROUP BY SUBSTR (GOL, 2, 1)
                    ) ES3 ON GOL.GOL_NEW = ES3.GOL
                    LEFT JOIN 
                    (
                        SELECT SUM (NJUMBERGAJI) AS JML_NRK, SUBSTR (GOL, 2, 1) GOL FROM PERS_DUK_PANGKAT_HISTDUK
                        WHERE THBL = '".$res."' AND ESELON LIKE '4%' GROUP BY SUBSTR (GOL, 2, 1)
                    ) ES4 ON GOL.GOL_NEW = ES4.GOL
                    LEFT JOIN 
                    (
                        SELECT SUM (NJUMBERGAJI) TEK_AHLI, SUBSTR (GOL, 2, 1) GOL FROM PERS_DUK_PANGKAT_HISTDUK
                        WHERE THBL = '".$res."' AND KOJAB = '798011' GROUP BY SUBSTR (GOL, 2, 1)
                    ) TA ON GOL.GOL_NEW = TA.GOL
                    LEFT JOIN (
                        SELECT SUM (NJUMBERGAJI) TEK_TRP, SUBSTR (GOL, 2, 1) GOL FROM PERS_DUK_PANGKAT_HISTDUK
                        WHERE THBL = '".$res."' AND KOJAB = '798012' GROUP BY SUBSTR (GOL, 2, 1)
                    ) TT ON GOL.GOL_NEW = TT.GOL
                    LEFT JOIN 
                    (
                        SELECT SUM (NJUMBERGAJI) ADM_AHLI, SUBSTR (GOL, 2, 1) GOL FROM PERS_DUK_PANGKAT_HISTDUK
                        WHERE THBL = '".$res."' AND KOJAB = '798021' GROUP BY SUBSTR (GOL, 2, 1)
                    ) AA ON GOL.GOL_NEW = AA.GOL
                    LEFT JOIN 
                    (
                        SELECT SUM (NJUMBERGAJI) ADM_TRP, SUBSTR (GOL, 2, 1) GOL FROM PERS_DUK_PANGKAT_HISTDUK
                        WHERE THBL = '".$res."' AND KOJAB = '798022' GROUP BY SUBSTR (GOL, 2, 1)
                    ) ATR ON GOL.GOL_NEW = ATR.GOL
                    LEFT JOIN 
                    (
                        SELECT SUM (NJUMBERGAJI) OPR_AHLI, SUBSTR (GOL, 2, 1) GOL FROM PERS_DUK_PANGKAT_HISTDUK
                        WHERE THBL = '".$res."' AND KOJAB = '798031' GROUP BY SUBSTR (GOL, 2, 1)
                    ) OA ON GOL.GOL_NEW = OA.GOL
                    LEFT JOIN 
                    (
                        SELECT SUM (NJUMBERGAJI) OPR_TRP, SUBSTR (GOL, 2, 1) GOL FROM PERS_DUK_PANGKAT_HISTDUK
                        WHERE THBL = '".$res."' AND KOJAB = '798032' GROUP BY SUBSTR (GOL, 2, 1)
                    ) OT ON GOL.GOL_NEW = OT.GOL
                    LEFT JOIN 
                    (
                        SELECT SUM (NJUMBERGAJI) LAY_AHLI, SUBSTR (GOL, 2, 1) GOL FROM PERS_DUK_PANGKAT_HISTDUK
                        WHERE THBL = '".$res."' AND KOJAB = '798041' GROUP BY SUBSTR (GOL, 2, 1)
                    ) LA ON GOL.GOL_NEW = LA.GOL
                    LEFT JOIN (
                        SELECT SUM (NJUMBERGAJI) LAY_TRP, SUBSTR (GOL, 2, 1) GOL FROM PERS_DUK_PANGKAT_HISTDUK
                        WHERE THBL = '".$res."' AND KOJAB = '798042' GROUP BY SUBSTR (GOL, 2, 1)
                    ) LT ON GOL.GOL_NEW = LT.GOL
                    LEFT JOIN 
                    (
                        SELECT SUM (NJUMBERGAJI) NONJFU, SUBSTR (GOL, 2, 1) GOL FROM PERS_DUK_PANGKAT_HISTDUK
                        WHERE THBL = '".$res."' AND KOJAB NOT IN ('798011','798012','798021','798022','798031','798032','798041','798042')
                        AND KD = 'S' AND ESELON NOT LIKE '2%' AND ESELON NOT LIKE '3%' AND ESELON NOT LIKE '4%'
                        GROUP BY SUBSTR (GOL, 2, 1)
                    ) NJ ON GOL.GOL_NEW = NJ.GOL
                    LEFT JOIN 
                    (
                        SELECT SUM (NJUMBERGAJI) JF,SUBSTR (GOL, 2, 1) GOL FROM PERS_DUK_PANGKAT_HISTDUK
                        WHERE THBL = '".$res."' AND KD = 'F' GROUP BY SUBSTR (GOL, 2, 1)
                    ) JFT ON GOL.GOL_NEW = JFT.GOL
                    LEFT JOIN 
                    (
                        SELECT SUM (NJUMBERGAJI) TOT, SUBSTR (GOL, 2, 1) GOL FROM PERS_DUK_PANGKAT_HISTDUK
                        WHERE THBL = '".$res ."' GROUP BY SUBSTR (GOL, 2, 1)
                    ) TOT ON GOL.GOL_NEW = TOT.GOL
                )PEGAWAI ORDER BY GOL_NEW ASC )X";

        $sql.=" WHERE 1=1"; 

        if( !empty($requestData['search']['value']) ) {   // if there is a search parameter, $requestData['search']['value'] contains search parameter
            $sql.=" AND ( GOL_NEW LIKE UPPER('%".$requestData['search']['value']."%') )";
            
        }
        $startrow = $requestData['start'];
        $endrow = $startrow + $requestData['length'];

        $sql.=" AND RN BETWEEN $startrow  AND $endrow";
        
        $query = $this->db->query($sql);
        $totalFiltered = $query->num_rows();

        $data = array();

    
        $no = $requestData['start']+1;
        
       
        foreach ($query->result() as $row)
        {            
            
            $nestedData=array();
            $nestedData[] = $no;
            $nestedData[] = number_format($row->GOL_NEW, 0, ',', '.');
            $nestedData[] = number_format($row->ESELON2, 0, ',', '.');
            $nestedData[] = number_format($row->ESELON3, 0, ',', '.');
            $nestedData[] = number_format($row->ESELON4, 0, ',', '.');
            $nestedData[] = number_format($row->CPNS, 0, ',', '.');
            $nestedData[] = number_format($row->TEKNIS_AHLI, 0, ',', '.');
            $nestedData[] = number_format($row->TEKNIS_TERAMPIL, 0, ',', '.');
            $nestedData[] = number_format($row->ADMINISTRASI_AHLI, 0, ',', '.');
            $nestedData[] = number_format($row->ADMINISTRASI_TERAMPIL, 0, ',', '.');
            $nestedData[] = number_format($row->OPERASIONAL_AHLI, 0, ',', '.');
            $nestedData[] = number_format($row->OPERASIONAL_TERAMPIL, 0, ',', '.');
            $nestedData[] = number_format($row->PELAYANAN_AHLI, 0, ',', '.');
            $nestedData[] = number_format($row->PELAYANAN_TERAMPIL, 0, ',', '.');
            $nestedData[] = number_format($row->JFT, 0, ',', '.');
            $nestedData[] = number_format($row->LAINNYA, 0, ',', '.');
            $nestedData[] = number_format($row->TOT, 0, ',', '.');
            
            $data[]=$nestedData;
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

    function getQueryGajiPPH($res)
    {
        $sql = "SELECT * FROM REKAP_DUK_GAJI WHERE THBL LIKE '".$res."%' ORDER BY THBL DESC";

        $query = $this->db->query($sql)->result();

        return $query; 
    }

    function getDataGajiPPH($res){
        $requestData = $this->input->post();
        
        $columns = array(
            0 => 'NO',
            1 => 'THBL',
            2 => 'GOL1',
            3 => 'GOL2',
            4 => 'GOL3',
            5 => 'GOL4',
            6 => 'TOTAL',
            7 => 'GAPOK',
            8 => 'TUNKEL',
            9 => 'TUNJAB',
            10 => 'TUNFUNG',
            11 => 'TUNLAI',
            12 => 'PPHGAJI',
            13 => 'TBERAS',
            14 => 'LAIN',
            15 => 'BULAT',
            16 => 'GAJI KOTOR'
            );

        $q = "SELECT COUNT(THBL) AS jml FROM REKAP_DUK_GAJI
            WHERE THBL = '".$res."'||'%'";
            //SUBSTR(THBL,5,2) IN ('01','02','03','04','05','06','07','08','09','10','11','12','13')";
        $rs = $this->db->query($q)->result();
        $totalData = $rs[0]->JML;

       $sql = "SELECT ROWNUM,X.* FROM
                (
                    SELECT
                        ROWNUM AS RN,
                        GOL.THBL,
                        GOL.PEG_GOL1,
                        GOL.PEG_GOL2,
                        GOL.PEG_GOL3,
                        GOL.PEG_GOL4,
                        GOL.PEG_TOTAL,
                        GOL.PEG_TOTAL_GAPOK,
                        GOL.PEG_TOTAL_TUNKEL,
                        GOL.PEG_TOTAL_TUNJAB,
                        GOL.PEG_TOTAL_TUNFUNG,
                        GOL.PEG_TOTAL_TUNLAI,
                        GOL.PEG_TOTAL_TPPHGAJI,
                        GOL.PEG_TOTAL_TBERAS,
                        GOL.PEG_TOTAL_LAIN,
                        GOL.PEG_TOTAL_BULAT,
                        GOL.PEG_TOTAL_GAJI_KOTOR
                    FROM REKAP_DUK_GAJI GOL
                    where THBL LIKE '".$res."%' 
                    ORDER BY GOL.THBL DESC
                )
                X";
                
        $sql.=" WHERE 1=1"; 

        if( !empty($requestData['search']['value']) ) {   // if there is a search parameter, $requestData['search']['value'] contains search parameter
            $sql.=" AND ( THBL LIKE UPPER('%".$requestData['search']['value']."%') )";
            
        }
        $startrow = $requestData['start'];
        $endrow = $startrow + $requestData['length'];

        $sql.=" AND RN BETWEEN $startrow  AND $endrow";
        
        $query = $this->db->query($sql);
        $totalFiltered = $query->num_rows();

        $data = array();

    
        $no = $requestData['start']+1;
        
       
        foreach ($query->result() as $row)
        {            
            
            $nestedData=array();
            $nestedData[] = $no;
            $nestedData[] = $row->THBL;
            $nestedData[] = $row->PEG_GOL1;
            $nestedData[] = $row->PEG_GOL2;
            $nestedData[] = $row->PEG_GOL3;
            $nestedData[] = $row->PEG_GOL4;
            $nestedData[] = $row->PEG_TOTAL;
            $nestedData[] = number_format($row->PEG_TOTAL_GAPOK, 0, ',', '.');
            $nestedData[] = number_format($row->PEG_TOTAL_TUNKEL, 0, ',', '.');
            $nestedData[] = number_format($row->PEG_TOTAL_TUNJAB, 0, ',', '.');
            $nestedData[] = number_format($row->PEG_TOTAL_TUNFUNG, 0, ',', '.');
            $nestedData[] = number_format($row->PEG_TOTAL_TUNLAI, 0, ',', '.');
            $nestedData[] = number_format($row->PEG_TOTAL_TPPHGAJI, 0, ',', '.');
            $nestedData[] = number_format($row->PEG_TOTAL_TBERAS, 0, ',', '.');
            $nestedData[] = number_format($row->PEG_TOTAL_LAIN, 0, ',', '.');
            $nestedData[] = number_format($row->PEG_TOTAL_BULAT, 0, ',', '.');
            $nestedData[] = number_format($row->PEG_TOTAL_GAJI_KOTOR, 0, ',', '.');
            
            $data[]=$nestedData;
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
