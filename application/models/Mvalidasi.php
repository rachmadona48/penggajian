<?php 

 class Mvalidasi extends CI_Model {

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
        //$this->prod = $this->ci->load->database('ORP1', TRUE);
        
    }


// DATA GAJI DINAS PENDIDIKAN
    function cekDataDisdik($thbl)
    {
        $sql ="SELECT COUNT(A.NRK)AS TOTAL_ORANG
                FROM PERS_DUK_PANGKAT_HISTDUK A
                WHERE thbl='".$thbl."' AND A.SPMU in ('C040','C041')";

        $query = $this->db->query($sql);
        $numrows = $query->num_rows();

        return $numrows;
    } 

    
    function qr_gajipegawai($nrk,$thbl)
    {
        $sql=   "SELECT
                (   CASE SUBSTR (A.THBL, 5, 2)
                    WHEN '01' THEN
                        'JANUARI'
                    WHEN '02' THEN
                        'FEBRUARI'
                    WHEN '03' THEN
                        'MARET'
                    WHEN '04' THEN
                        'APRIL'
                    WHEN '05' THEN
                        'MEI'
                    WHEN '06' THEN
                        'JUNI'
                    WHEN '07' THEN
                        'JULI'
                    WHEN '08' THEN
                        'AGUSTUS'
                    WHEN '09' THEN
                        'SEPTEMBER'
                    WHEN '10' THEN
                        'OKTOBER'
                    WHEN '11' THEN
                        'NOVEMBER'
                    WHEN '12' THEN
                        'DESEMBER'
                    END
                ) AS BULAN,A.THBL,
                SUBSTR (A.THBL, 1, 4) AS TAHUN,A.KLOGAD,C.NALOKL AS NAKLOGAD,A .SPMU AS SPMU,B.NAMA NAMASPM,A .NAMA AS NAMA_PEG,TO_CHAR (A.TALHIR, 'DD-MM-YYYY') AS TALHIR,A.NIP18,A.NRK,
                CASE WHEN STAPEG = 1 THEN 'CPNS' ELSE 'PNS' END AS STAPEG,
                A.KOJAB,E.GOL,E.NAPANG,
                CASE WHEN STAWIN IN (1, 2, 3, 4) THEN 1 ELSE 0 END AS STAWIN,
                JUAN, JIWA, GAPOK, NTISTRI, NTANAK, NTUNLAI, TUNJAB, TUNFUNG, NPBULAT, NTBERAS, NTPPHGAJI, NJUMKOT, NPBERAS, NTASPEN, NTHT, NASKES,
                NVL (NTASPEN, 0) + NVL (NTHT, 0) + NVL (NASKES, 0) AS IURANWJB,
                    NPPHGAJI, NPTLAIN, NJUMPOTGAJI, NJUMBERGAJI
                FROM
                    PERS_DUK_PANGKAT_HISTDUK A
                LEFT JOIN pers_tabel_spmu B ON A .SPMU = B.KODE_SPM
                LEFT JOIN pers_lokasi_tbl C ON A .KLOGAD = C.KOLOK
                LEFT JOIN PERS_ESELON_TBL D ON NVL (A .ESELON, '  ') = D .ESELON
                LEFT JOIN PERS_PANGKAT_TBL_NOW E ON A .GOL = E .KOPANG
                LEFT JOIN pers_lokasi_tbl F ON A .KOLOK = C.KOLOK
                WHERE
                    THBL = '".$thbl."' AND NRK = '".$nrk."'
                ORDER BY spmu, klogad ASC, stapeg DESC, D .CETAKAN, gol DESC, A .KODIKF, nrk ASC";

        $result = $this->db->query($sql)->row();
        return $result;
    }

    function getdataDisdik($thbl)
    {
        $sql ="SELECT 'C040,C041' AS SPMU, COUNT(A.NRK)AS TOTAL_ORANG,SUM(A.NJUMBERGAJI) AS TOTAL_GAJI
                FROM PERS_DUK_PANGKAT_HISTDUK A
                WHERE thbl='".$thbl."' AND A.SPMU in ('C040','C041')";

        $query = $this->db->query($sql)->result();

        if($query)
        {
            return $query;
        }
        else
        {
            return 0;
        }
    }

    public function qr_data_gaji($thbl,$spmu){
        $sql = "SELECT A.JML_NRK,A.SUM_GJ,B.NAMA AS SKPD
                FROM (
                    SELECT COUNT(NRK) as JML_NRK,SUM(NJUMBERGAJI) as SUM_GJ,SPMU
                    FROM PERS_DUK_PANGKAT_HISTDUK
                    WHERE THBL = '".$thbl."'
                    AND SPMU = '".$spmu."'
                    GROUP BY SPMU
                )A
                LEFT JOIN(
                    SELECT KODE_SPM,NAMA,TAHUN 
                    FROM PERS_TABEL_SPMU
                )B ON A.SPMU = B.KODE_SPM ";

        return $this->db->query($sql)->row();
    }

    public function qr_data_diskes($thbl,$klogad){
        $sql = "SELECT A.JML_NRK,A.SUM_GJ,B.NAMA AS SKPD,C.NALOK
                FROM (
                    SELECT
                        COUNT (NRK) AS JML_NRK,
                        SUM (NJUMBERGAJI) AS SUM_GJ,
                        KLOGAD,SPMU
                    FROM
                        PERS_DUK_PANGKAT_HISTDUK
                    WHERE THBL = '".$thbl."'
                    AND (SPMU = 'C030' OR SPMU = 'C031')
                    AND KLOGAD = '".$klogad."'
                    GROUP BY KLOGAD,SPMU
                )A
                LEFT JOIN(
                        SELECT KODE_SPM,NAMA,TAHUN 
                        FROM PERS_TABEL_SPMU
                )B ON A.SPMU = B.KODE_SPM 
                LEFT JOIN (
                    SELECT KOLOK,SPMU,NALOK
                    FROM PERS_KLOGAD3
                )C ON A.KLOGAD = C.KOLOK ";

        return $this->db->query($sql)->row();
    }

    public function qr_data_dikdas($thbl,$klogad){
        $sql = "SELECT A.JML_NRK,A.SUM_GJ,B.NAMA AS SKPD,C.NALOK
                FROM (
                    SELECT
                        COUNT (NRK) AS JML_NRK,
                        SUM (NJUMBERGAJI) AS SUM_GJ,
                        KLOGAD,SPMU
                    FROM
                        PERS_DUK_PANGKAT_HISTDUK
                    WHERE THBL = '".$thbl."'
                    AND (SPMU = 'C040' OR SPMU = 'C041')
                    AND KLOGAD = '".$klogad."'
                    GROUP BY KLOGAD,SPMU
                )A
                LEFT JOIN(
                        SELECT KODE_SPM,NAMA,TAHUN 
                        FROM PERS_TABEL_SPMU
                )B ON A.SPMU = B.KODE_SPM 
                LEFT JOIN (
                    SELECT KOLOK,SPMU,NALOK
                    FROM PERS_KLOGAD3
                )C ON A.KLOGAD = C.KOLOK ";

        return $this->db->query($sql)->row();
    }

    public function qr_data_gaji_spmu($thbl,$klogad,$spmu){
        $sql = "SELECT A.JML_NRK,A.SUM_GJ,B.NAMA AS SKPD,C.NALOK
                FROM (
                    SELECT
                        COUNT (NRK) AS JML_NRK,
                        SUM (NJUMBERGAJI) AS SUM_GJ,
                        KLOGAD,SPMU
                    FROM
                        PERS_DUK_PANGKAT_HISTDUK
                    WHERE THBL = '".$thbl."'
                    AND SPMU = '".$spmu."'
                    AND KLOGAD = '".$klogad."'
                    GROUP BY KLOGAD,SPMU
                )A
                LEFT JOIN(
                        SELECT KODE_SPM,NAMA,TAHUN 
                        FROM PERS_TABEL_SPMU
                )B ON A.SPMU = B.KODE_SPM 
                LEFT JOIN (
                    SELECT KOLOK,SPMU,NALOK
                    FROM PERS_KLOGAD3
                )C ON A.KLOGAD = C.KOLOK ";

        return $this->db->query($sql)->row();
    }

    public function qr_data_gaji_spmu_gab($thbl,$klogad){
        $sql = "SELECT A.JML_NRK,A.SUM_GJ,B.NAMA AS SKPD,C.NALOK
                FROM (
                    SELECT
                        COUNT (NRK) AS JML_NRK,
                        SUM (NJUMBERGAJI) AS SUM_GJ,
                        KLOGAD,SPMU
                    FROM
                        PERS_DUK_PANGKAT_HISTDUK
                    WHERE THBL = '".$thbl."'
                    AND KLOGAD = '".$klogad."'
                    GROUP BY KLOGAD,SPMU
                )A
                LEFT JOIN(
                        SELECT KODE_SPM,NAMA,TAHUN 
                        FROM PERS_TABEL_SPMU
                )B ON A.SPMU = B.KODE_SPM 
                LEFT JOIN (
                    SELECT KOLOK,SPMU,NALOK
                    FROM PERS_KLOGAD3
                )C ON A.KLOGAD = C.KOLOK ";

        return $this->db->query($sql)->row();
    }

    
    //validasi listing tkd guru 108 dan 22 disdik 
    public function tkd108dik($thbl,$klogad)
    {
        $sql = "SELECT a.*,b.nalokl FROM 
                ( SELECT klogad,count(nrk),sum(njtundabersih) 
                    FROM PROSES_TKD_GURU 
                    WHERE THBL='".$thbl."' AND KLOGAD = '".$klogad."' 
                    GROUP BY KLOGAD
                )a
                LEFT JOIN pers_lokasi_tbl b on a.klogad = b.kolok";
        return $this->db->query($sql)->row();
    }
    
    //validasi listing tkd guru 108 dan 22 disdik 
    public function tkdgurudik($thbl,$klogad)
    {
        $sql = "SELECT a.*,b.nalokl FROM 
                ( SELECT klogad,count(nrk)jumlah_pegawai,sum(njtunda)TKD,sum(njtundabersih) TKDBERSIH
                    FROM PROSES_TKD_GURU 
                    WHERE THBL='".$thbl."' AND KLOGAD = '".$klogad."'  AND NJTUNDABERSIH > 0  AND SPMU in ('C040','C041') and upload IN (1)
                    GROUP BY KLOGAD
                )a
                LEFT JOIN pers_lokasi_tbl b on a.klogad = b.kolok";
        return $this->db->query($sql)->row();
    }

    //validasi listing tkd guru 108 dan 22 gab 
    public function tkdgurugab($thbl,$klogad)
    {
        $sql = "SELECT a.*,b.nalokl FROM 
                ( SELECT klogad,count(nrk)jumlah_pegawai,sum(njtunda)TKD,sum(njtundabersih) TKD_BERSIH
                    FROM PROSES_TKD_GURU 
                    WHERE THBL='".$thbl."' AND KLOGAD = '".$klogad."'   AND NJTUNDABERSIH > 0  and upload IN (1,9)
                    GROUP BY KLOGAD
                )a
                LEFT JOIN pers_lokasi_tbl b on a.klogad = b.kolok";
        return $this->db->query($sql)->row();   
    }

    //validasi listing tkd guru 108 dan 22 spm 
    public function tkdguruspm($thbl,$klogad,$spmu)
    {
        $sql = "SELECT a.*,b.nalokl FROM 
                ( SELECT klogad,count(nrk)jumlah_pegawai,sum(njtunda)TKD,sum(njtundabersih) TKD_BERSIH
                    FROM PROSES_TKD_GURU 
                    WHERE THBL='".$thbl."' AND KLOGAD = '".$klogad."' AND SPMU = '".$spmu."'   AND NJTUNDABERSIH > 0  and upload IN (1)
                    GROUP BY KLOGAD
                )a
                LEFT JOIN pers_lokasi_tbl b on a.klogad = b.kolok";
        return $this->db->query($sql)->row();   
    }

    //rekap tkd guru disdik 108 dan 22 utk spmu C040
    public function rekaptkdguruspm0($thbl)
    {
        $sql = "SELECT A.*,B.NAMA AS NAMA_SPMU FROM (
                SELECT spmu, count(nrk)jumlah_pegawai,SUM(NJTUNDA)TKD, sum(njtundabersih)TKD_BERSIH
                    FROM PROSES_TKD_GURU 
                    WHERE THBL='".$thbl."' AND SPMU ='C040'   AND NJTUNDABERSIH > 0  and upload IN (1) GROUP BY SPMU
                )A
                LEFT JOIN PERS_TABEL_SPMU B ON A.SPMU = B.KODE_SPM";
        return $this->db->query($sql)->row();   
    }
    //rekap tkd guru disdik 108 dan 22 utk spmu C041
    public function rekaptkdguruspm1($thbl)
    {
        $sql = "SELECT A.*,B.NAMA AS NAMA_SPMU FROM (
                SELECT spmu, count(nrk)jumlah_pegawai,SUM(NJTUNDA)TKD, sum(njtundabersih)TKD_BERSIH
                    FROM PROSES_TKD_GURU 
                    WHERE THBL='".$thbl."' AND SPMU ='C041'   AND NJTUNDABERSIH > 0  and upload IN (1) GROUP BY SPMU
                )A
                LEFT JOIN PERS_TABEL_SPMU B ON A.SPMU = B.KODE_SPM";
        return $this->db->query($sql)->row();   
    }

    //rekap tkd guru disdik 108 dan 22 utk KEDUA spmu C040 C041
    public function rekaptkdguruspmtot($thbl)
    {
        $sql = "SELECT count(nrk)jumlah_pegawai,SUM(NJTUNDA)TKD,sum(njtundabersih)TKD_BERSIH
                    FROM PROSES_TKD_GURU 
                    WHERE THBL='".$thbl."' AND SPMU IN('C040','C041')   AND NJTUNDABERSIH > 0  and upload IN (1)";
        return $this->db->query($sql)->row();   
    }

    //rekap tkd guru disdik 108 dan 22 utk masing-masingspmu
    public function rekaptkdguruperspm($thbl,$spmu)
    {
        $sql = "SELECT A.*,B.NAMA AS NAMA_SPMU FROM (
                SELECT spmu, count(nrk)jumlah_pegawai,SUM(NJTUNDA)TKD, sum(njtundabersih)TKD_BERSIH
                    FROM PROSES_TKD_GURU 
                    WHERE THBL='".$thbl."' AND SPMU ='".$spmu."'   AND NJTUNDABERSIH > 0  and upload IN (1) GROUP BY SPMU
                    )A
                LEFT JOIN PERS_TABEL_SPMU B ON A.SPMU = B.KODE_SPM";
        return $this->db->query($sql)->row();   
    }

    /* ----------------------------------------------------------END TKD GURU 108 22--------------------------------------*/    

    /* ----------------------------------------------------------TKD TAHAP 2------------------------------------------------*/

    //validasi listing tkd tahap2 dinkes
    public function tkdt2kes($thbl,$klogad)
    {
        $sql = "SELECT a.*,b.nalokl FROM 
                ( SELECT klogad,count(nrk)jumlah_pegawai,sum(njtunda)TKD,sum(njtundabersih) TKDBERSIH
                    FROM PROSES_TKD_TAHAP2 
                    WHERE THBL='".$thbl."' AND KLOGAD = '".$klogad."'  AND NJTUNDABERSIH > 0  AND SPMU in ('C030','C031') and upload IN (1)
                    GROUP BY KLOGAD
                )a
                LEFT JOIN pers_lokasi_tbl b on a.klogad = b.kolok";
        return $this->db->query($sql)->row();
    }

    //validasi listing tkd tahap2 disdik
    public function tkdt2dik($thbl,$klogad)
    {
        $sql = "SELECT a.*,b.nalokl FROM 
                ( SELECT klogad,count(nrk)jumlah_pegawai,sum(njtunda)TKD,sum(njtundabersih) TKDBERSIH
                    FROM PROSES_TKD_TAHAP2 
                    WHERE THBL='".$thbl."' AND KLOGAD = '".$klogad."'  AND NJTUNDABERSIH > 0  AND SPMU in ('C040','C041') and upload IN (1)
                    GROUP BY KLOGAD
                )a
                LEFT JOIN pers_lokasi_tbl b on a.klogad = b.kolok";
        return $this->db->query($sql)->row();
    }


    //validasi listing tkd tahap2 gab
    public function tkdt2gab($thbl,$klogad)
    {
        $sql = "SELECT a.*,b.nalokl FROM 
                ( SELECT klogad,count(nrk)jumlah_pegawai,sum(njtunda)TKD,sum(njtundabersih) TKDBERSIH
                    FROM PROSES_TKD_TAHAP2 
                    WHERE THBL='".$thbl."' AND KLOGAD = '".$klogad."'  AND NJTUNDABERSIH > 0  and upload IN (1)
                    GROUP BY KLOGAD
                )a
                LEFT JOIN pers_lokasi_tbl b on a.klogad = b.kolok";
        return $this->db->query($sql)->row();
    }

    //validasi listing tkd tahap2 spmu
    public function tkdt2spm($thbl,$klogad,$spmu)
    {
        $sql = "SELECT a.*,b.nalokl FROM 
                ( SELECT klogad,count(nrk)jumlah_pegawai,sum(njtunda)TKD,sum(njtundabersih) TKDBERSIH
                    FROM PROSES_TKD_TAHAP2 
                    WHERE THBL='".$thbl."' AND SPMU = '".$spmu."' AND KLOGAD = '".$klogad."'  AND NJTUNDABERSIH > 0  and upload IN (1)
                    GROUP BY KLOGAD
                )a
                 LEFT JOIN pers_lokasi_tbl b on a.klogad = b.kolok";
        return $this->db->query($sql)->row();   
    }

    // rekap tkd tahap 2 diskes C030
    public function rekaptkdt2kes0($thbl)
    {
        $sql = "SELECT a.*,b.nama FROM 
                ( SELECT spmu,count(nrk)jumlah_pegawai,sum(njtunda)TKD,sum(njtundabersih) TKDBERSIH
                    FROM PROSES_TKD_TAHAP2 
                    WHERE THBL='".$thbl."' AND SPMU = 'C030'  AND NJTUNDABERSIH > 0  and upload IN (1)
                    GROUP BY SPMU
                )a
                LEFT JOIN PERS_TABEL_SPMU b on a.spmu = b.KODE_SPM";
        return $this->db->query($sql)->row();   
    }  

    // rekap tkd tahap 2 diskes C031
    public function rekaptkdt2kes1($thbl)
    {
        $sql = "SELECT a.*,b.nama FROM 
                ( SELECT spmu,count(nrk)jumlah_pegawai,sum(njtunda)TKD,sum(njtundabersih) TKDBERSIH
                    FROM PROSES_TKD_TAHAP2 
                    WHERE THBL='".$thbl."' AND SPMU = 'C031'  AND NJTUNDABERSIH > 0  and upload IN (1)
                    GROUP BY SPMU
                )a
                LEFT JOIN PERS_TABEL_SPMU b on a.spmu = b.KODE_SPM";
        return $this->db->query($sql)->row();   
    }   

    // rekap tkd tahap 2 disdik C040
    public function rekaptkdt2dik0($thbl)
    {
        $sql = "SELECT a.*,b.nama FROM 
                ( SELECT spmu,count(nrk)jumlah_pegawai,sum(njtunda)TKD,sum(njtundabersih) TKDBERSIH
                    FROM PROSES_TKD_TAHAP2 
                    WHERE THBL='".$thbl."' AND SPMU = 'C040'  AND NJTUNDABERSIH > 0  and upload IN (1)
                    GROUP BY SPMU
                )a
                LEFT JOIN PERS_TABEL_SPMU b on a.spmu = b.KODE_SPM";
        return $this->db->query($sql)->row();   
    }  

    // rekap tkd tahap 2 diskes C031
    public function rekaptkdt2dik1($thbl)
    {
        $sql = "SELECT a.*,b.nama FROM 
                ( SELECT spmu,count(nrk)jumlah_pegawai,sum(njtunda)TKD,sum(njtundabersih) TKDBERSIH
                    FROM PROSES_TKD_TAHAP2 
                    WHERE THBL='".$thbl."' AND SPMU = 'C041'  AND NJTUNDABERSIH > 0  and upload IN (1)
                    GROUP BY SPMU
                )a
                LEFT JOIN PERS_TABEL_SPMU b on a.spmu = b.KODE_SPM";
        return $this->db->query($sql)->row();   
    } 

    // rekap tkd tahap 2 gab
    public function rekaptkdt2gab($thbl)
    {
        $sql = "SELECT a.*,b.nama FROM 
                ( SELECT spmu,count(nrk)jumlah_pegawai,sum(njtunda)TKD,sum(njtundabersih) TKDBERSIH
                    FROM PROSES_TKD_TAHAP2 
                    WHERE THBL='".$thbl."'  AND NJTUNDABERSIH > 0  and upload IN (1)
                    GROUP BY SPMU
                )a
                LEFT JOIN PERS_TABEL_SPMU b on a.spmu = b.KODE_SPM";
        return $this->db->query($sql)->row();   
    } 

    // rekap tkd tahap 2 spm
    public function rekaptkdt2spm($thbl,$spmu)
    {
        $sql = "SELECT a.*,b.nama FROM 
                ( SELECT spmu,count(nrk)jumlah_pegawai,sum(njtunda)TKD,sum(njtundabersih) TKDBERSIH
                    FROM PROSES_TKD_TAHAP2 
                    WHERE THBL='".$thbl."' AND SPMU = '".$spmu."' AND NJTUNDABERSIH > 0  and upload IN (1)
                    GROUP BY SPMU
                )a
                LEFT JOIN PERS_TABEL_SPMU b on a.spmu = b.KODE_SPM";
        return $this->db->query($sql)->row();   
    } 

    //------------------------------------- QR listing tkd guru 108 ----------------------------------------//

    public function qr_LISTING_TKD_GURU_GAB_108($thbl,$spmu,$klogad){
        $sql = "SELECT A.JML_NRK,A.NJTUNDA,B.NAMA AS SKPD,C.NALOK
                FROM (
                        SELECT
                                COUNT (NRK) AS JML_NRK,
                                SUM (NJTUNDABERSIH) AS NJTUNDA,
                                KLOGAD,SPMU
                        FROM
                                PROSES_TKD_GURU
                        WHERE THBL = '".$thbl."'
                        AND SPMU = '".$spmu."'
                        AND KLOGAD = '".$klogad."'
                        AND NJTUNDABERSIH > 0  
                        and upload IN (1,9)
                        GROUP BY KLOGAD,SPMU
                )A
                LEFT JOIN(
                                SELECT KODE_SPM,NAMA,TAHUN 
                                FROM PERS_TABEL_SPMU
                )B ON A.SPMU = B.KODE_SPM 
                LEFT JOIN (
                        SELECT KOLOK,SPMU,NALOK
                        FROM PERS_KLOGAD3
                )C ON A.KLOGAD = C.KOLOK ";
        return $this->db->query($sql)->row();  
    }

    public function qr_LISTING_TKD_GURU_DISDIK_108($thbl,$klogad){
        $sql = "SELECT A.JML_NRK,A.NJTUNDA,B.NAMA AS SKPD,C.NALOK
                FROM (
                        SELECT
                                COUNT (NRK) AS JML_NRK,
                                SUM (NJTUNDABERSIH) AS NJTUNDA,
                                KLOGAD,SPMU
                        FROM
                                PROSES_TKD_GURU
                        WHERE THBL = '".$thbl."'
                        AND SPMU in ('C040','C041')
                        AND KLOGAD = '".$klogad."'
                        AND NJTUNDABERSIH > 0  
                        and upload IN (1)
                        GROUP BY KLOGAD,SPMU
                )A
                LEFT JOIN(
                                SELECT KODE_SPM,NAMA,TAHUN 
                                FROM PERS_TABEL_SPMU
                )B ON A.SPMU = B.KODE_SPM 
                LEFT JOIN (
                        SELECT KOLOK,SPMU,NALOK
                        FROM PERS_KLOGAD3
                )C ON A.KLOGAD = C.KOLOK ";
        return $this->db->query($sql)->row(); 
    }

    public function qr_LISTING_TKD_GURU_SPMU_108($thbl,$spmu,$klogad){
        $sql = "SELECT A.JML_NRK,A.NJTUNDA,B.NAMA AS SKPD,C.NALOK
                FROM (
                        SELECT
                                COUNT (NRK) AS JML_NRK,
                                SUM (NJTUNDABERSIH) AS NJTUNDA,
                                KLOGAD,SPMU
                        FROM
                                PROSES_TKD_GURU
                        WHERE THBL = '".$thbl."'
                        AND SPMU = '".$spmu."'
                        AND KLOGAD = '".$klogad."'
                        AND NJTUNDABERSIH > 0  
                        and upload IN (1)
                        GROUP BY KLOGAD,SPMU
                )A
                LEFT JOIN(
                                SELECT KODE_SPM,NAMA,TAHUN 
                                FROM PERS_TABEL_SPMU
                )B ON A.SPMU = B.KODE_SPM 
                LEFT JOIN (
                        SELECT KOLOK,SPMU,NALOK
                        FROM PERS_KLOGAD3
                )C ON A.KLOGAD = C.KOLOK ";
        return $this->db->query($sql)->row(); 
    }

    public function qr_REKAP_TKD_GURU_DISDIK_108($thbl,$spmu){
        $sql = "SELECT A.JML_NRK,A.NJTUNDA,B.NAMA AS SKPD
                FROM (
                        SELECT
                                COUNT (NRK) AS JML_NRK,
                                SUM (NJTUNDABERSIH) AS NJTUNDA,
                                SPMU
                        FROM
                                PROSES_TKD_GURU
                        WHERE THBL = '".$thbl."'
                        AND SPMU = '".$spmu."' 
                        and upload = 1
                        AND NJTUNDABERSIH > 0  
                        GROUP BY SPMU
                )A
                LEFT JOIN(
                                SELECT KODE_SPM,NAMA,TAHUN 
                                FROM PERS_TABEL_SPMU
                )B ON A.SPMU = B.KODE_SPM  ";
        return $this->db->query($sql)->row(); 
    }

    public function qr_REKAP_TKD_GURU_DISDIK_108_all($thbl){
        $sql = "SELECT sum(JML_NRK) as JML,SUM(NJTUNDA) as JML_NJTUNDA,'DINAS PENDIDIKAN' as SKPD
                FROM (
                    SELECT A.JML_NRK,A.NJTUNDA,B.NAMA AS SKPD
                    FROM (
                            SELECT
                                    COUNT (NRK) AS JML_NRK,
                                    SUM (NJTUNDABERSIH) AS NJTUNDA,
                                    SPMU
                            FROM
                                    PROSES_TKD_GURU
                            WHERE THBL = '".$thbl."'
                            AND SPMU IN ('C040','C041') 
                            and upload = 1
                            AND NJTUNDABERSIH > 0  
                            GROUP BY SPMU
                    )A
                    LEFT JOIN(
                                    SELECT KODE_SPM,NAMA,TAHUN 
                                    FROM PERS_TABEL_SPMU
                    )B ON A.SPMU = B.KODE_SPM 
                ) ";
        return $this->db->query($sql)->row(); 
    }

    public function qr_REKAP_TKD_GURU_GAB_108($thbl,$spmu){
        $sql = "SELECT A.JML_NRK,A.NJTUNDA,B.NAMA AS SKPD
                FROM (
                        SELECT
                                COUNT (NRK) AS JML_NRK,
                                SUM (NJTUNDABERSIH) AS NJTUNDA,
                                SPMU
                        FROM
                                PROSES_TKD_GURU
                        WHERE THBL = '".$thbl."'
                        AND SPMU = '".$spmu."' 
                        and upload = 1
                        AND NJTUNDABERSIH > 0  
                        GROUP BY SPMU
                )A
                LEFT JOIN(
                        SELECT KODE_SPM,NAMA,TAHUN 
                        FROM PERS_TABEL_SPMU
                )B ON A.SPMU = B.KODE_SPM  ";
        return $this->db->query($sql)->row(); 
    }

    public function qr_REKAP_TKD_GURU_GAB_108_all($thbl){
        $sql = "SELECT sum(JML_NRK) as JML,SUM(NJTUNDA) as JML_NJTUNDA,'SELURUH SKPD' as SKPD
                FROM (
                    SELECT A.JML_NRK,A.NJTUNDA,B.NAMA AS SKPD
                    FROM (
                            SELECT
                                    COUNT (NRK) AS JML_NRK,
                                    SUM (NJTUNDABERSIH) AS NJTUNDA,
                                    SPMU
                            FROM
                                    PROSES_TKD_GURU
                            WHERE THBL = '".$thbl."'
                            and upload = 1
                            AND NJTUNDABERSIH > 0  
                            GROUP BY SPMU
                    )A
                    LEFT JOIN(
                                    SELECT KODE_SPM,NAMA,TAHUN 
                                    FROM PERS_TABEL_SPMU
                    )B ON A.SPMU = B.KODE_SPM 
                ) ";
        return $this->db->query($sql)->row(); 
    }

    public function qr_REKAP_TKD_GURU_SPMU_108($thbl,$spmu){
        $sql = "SELECT A.JML_NRK,A.NJTUNDA,B.NAMA AS SKPD,A.JML_KLOGAD
                FROM (
                        SELECT
                                COUNT (NRK) AS JML_NRK,
                                SUM (NJTUNDABERSIH) AS NJTUNDA,
                                COUNT(KLOGAD) as JML_KLOGAD,
                                SPMU
                        FROM
                                PROSES_TKD_GURU
                        WHERE THBL = '".$thbl."'
                        AND SPMU = '".$spmu."' 
                        and upload = 1
                        AND NJTUNDABERSIH > 0  
                        GROUP BY SPMU
                )A
                LEFT JOIN(
                        SELECT KODE_SPM,NAMA,TAHUN 
                        FROM PERS_TABEL_SPMU
                )B ON A.SPMU = B.KODE_SPM  ";
        return $this->db->query($sql)->row(); 
    }

    public function qr_REKAP_TKD_GURU_SPMU_108_all($thbl,$spmu){
        $sql = "SELECT sum(JML_NRK) as JML,SUM(NJTUNDA) as JML_NJTUNDA,SKPD
                FROM (
                    SELECT A.JML_NRK,A.NJTUNDA,B.NAMA AS SKPD
                    FROM (
                            SELECT
                                    COUNT (NRK) AS JML_NRK,
                                    SUM (NJTUNDABERSIH) AS NJTUNDA,
                                    SPMU
                            FROM
                                    PROSES_TKD_GURU
                            WHERE THBL = '".$thbl."'
                            AND SPMU = '".$spmu."'
                            and upload = 1
                            AND NJTUNDABERSIH > 0  
                            GROUP BY SPMU
                    )A
                    LEFT JOIN(
                                    SELECT KODE_SPM,NAMA,TAHUN 
                                    FROM PERS_TABEL_SPMU
                    )B ON A.SPMU = B.KODE_SPM 
                )
                GROUP BY SKPD ";
        return $this->db->query($sql)->row(); 
    }

    public function qr_LISTING_TKD_TAHAP2_DINKES_108($thbl,$klogad){
        $sql = "SELECT A.JML_NRK,A.NJTUNDA,B.NAMA AS SKPD,C.NALOKL
                FROM (
                                SELECT
                                                COUNT (NRK) AS JML_NRK,
                                                SUM (NJTUNDABERSIH) AS NJTUNDA,
                                                KLOGAD,SPMU
                                FROM
                                                PROSES_TKD_TAHAP2
                                WHERE THBL = '".$thbl."'
                                AND SPMU IN ('C030','C031')
                                AND KLOGAD = '".$klogad."'
                                AND NJTUNDABERSIH > 0  
                                and upload IN (1)
                                GROUP BY KLOGAD,SPMU
                )A
                LEFT JOIN(
                                                SELECT KODE_SPM,NAMA,TAHUN 
                                                FROM PERS_TABEL_SPMU
                )B ON A.SPMU = B.KODE_SPM 
                LEFT JOIN (
                                SELECT KOLOK,NALOKL
                                FROM PERS_LOKASI_TBL
                )C ON A.KLOGAD = C.KOLOK ";
        return $this->db->query($sql)->row(); 
    }

    public function qr_LISTING_TKD_TAHAP2_DISDIK_108($thbl,$klogad){
        $sql = "SELECT A.JML_NRK,A.NJTUNDA,B.NAMA AS SKPD,C.NALOKL
                FROM (
                                SELECT
                                                COUNT (NRK) AS JML_NRK,
                                                SUM (NJTUNDABERSIH) AS NJTUNDA,
                                                KLOGAD,SPMU
                                FROM
                                                PROSES_TKD_TAHAP2
                                WHERE THBL = '".$thbl."'
                                AND SPMU IN ('C040','C041')
                                AND KLOGAD = '".$klogad."'
                                AND NJTUNDABERSIH > 0  
                                and upload IN (1)
                                GROUP BY KLOGAD,SPMU
                )A
                LEFT JOIN(
                                                SELECT KODE_SPM,NAMA,TAHUN 
                                                FROM PERS_TABEL_SPMU
                )B ON A.SPMU = B.KODE_SPM 
                LEFT JOIN (
                                SELECT KOLOK,NALOKL
                                FROM PERS_LOKASI_TBL
                )C ON A.KLOGAD = C.KOLOK ";
        return $this->db->query($sql)->row(); 
    }

    public function qr_LISTING_TKD_TAHAP2_108($thbl,$klogad,$spmu){
        $sql = "SELECT A.JML_NRK,A.NJTUNDA,B.NAMA AS SKPD,C.NALOKL
                FROM (
                                SELECT
                                                COUNT (NRK) AS JML_NRK,
                                                SUM (NJTUNDABERSIH) AS NJTUNDA,
                                                KLOGAD,SPMU
                                FROM
                                                PROSES_TKD_TAHAP2
                                WHERE THBL = '".$thbl."'
                                AND SPMU = '".$spmu."'
                                AND KLOGAD = '".$klogad."'
                                AND NJTUNDABERSIH > 0  
                                and upload IN (1)
                                GROUP BY KLOGAD,SPMU
                )A
                LEFT JOIN(
                                                SELECT KODE_SPM,NAMA,TAHUN 
                                                FROM PERS_TABEL_SPMU
                )B ON A.SPMU = B.KODE_SPM 
                LEFT JOIN (
                                SELECT KOLOK,NALOKL
                                FROM PERS_LOKASI_TBL
                )C ON A.KLOGAD = C.KOLOK ";
        return $this->db->query($sql)->row(); 
    }

    public function qr_LISTING_TKD_TAHAP2_GAB_108($thbl,$klogad,$spmu){
        $sql = "SELECT A.JML_NRK,A.NJTUNDA,B.NAMA AS SKPD,C.NALOKL
                FROM (
                                SELECT
                                                COUNT (NRK) AS JML_NRK,
                                                SUM (NJTUNDABERSIH) AS NJTUNDA,
                                                KLOGAD,SPMU
                                FROM
                                                PROSES_TKD_TAHAP2
                                WHERE THBL = '".$thbl."'
                                AND SPMU = '".$spmu."'
                                AND KLOGAD = '".$klogad."'
                                AND NJTUNDABERSIH > 0  
                                and upload IN (1)
                                GROUP BY KLOGAD,SPMU
                )A
                LEFT JOIN(
                                                SELECT KODE_SPM,NAMA,TAHUN 
                                                FROM PERS_TABEL_SPMU
                )B ON A.SPMU = B.KODE_SPM 
                LEFT JOIN (
                                SELECT KOLOK,NALOKL
                                FROM PERS_LOKASI_TBL
                )C ON A.KLOGAD = C.KOLOK ";
        return $this->db->query($sql)->row(); 
    }

    public function qr_REKAP_TKD_TAHAP2_DINKES_108($thbl,$spmu){
        $sql = "SELECT A.JML_NRK,A.NJTUNDA,B.NAMA AS SKPD
                FROM (
                    SELECT
                                    COUNT (NRK) AS JML_NRK,
                                    SUM (NJTUNDABERSIH) AS NJTUNDA,
                                    SPMU
                    FROM
                                    PROSES_TKD_TAHAP2
                    WHERE THBL = '".$thbl."'
                    AND SPMU = '".$spmu."'
                    AND NJTUNDABERSIH > 0  
                    and upload IN (1)
                    GROUP BY SPMU
                )A
                LEFT JOIN(
                    SELECT KODE_SPM,NAMA,TAHUN 
                    FROM PERS_TABEL_SPMU
                )B ON A.SPMU = B.KODE_SPM 
                 ";
        return $this->db->query($sql)->row(); 
    }

    public function qr_REKAP_TKD_TAHAP2_DINKES_108_all($thbl,$spmu){
        $sql = "SELECT SUM(JML_NRK) as JML,SUM(NJTUNDA) as JML_NJTUNDA,'DINAS KESEHATAN & DINAS KESEHATAN (PARAMEDIS)' AS SKPD
                FROM (
                    SELECT
                                    COUNT (NRK) AS JML_NRK,
                                    SUM (NJTUNDABERSIH) AS NJTUNDA,
                                    SPMU
                    FROM
                                    PROSES_TKD_TAHAP2
                    WHERE THBL = '".$thbl."'
                    AND SPMU IN ('C030','C031')
                    AND NJTUNDABERSIH > 0  
                    and upload IN (1)
                    GROUP BY SPMU
                )A
                LEFT JOIN(
                    SELECT KODE_SPM,NAMA,TAHUN 
                    FROM PERS_TABEL_SPMU
                )B ON A.SPMU = B.KODE_SPM 
                 ";
        return $this->db->query($sql)->row(); 
    }

    public function qr_REKAP_TKD_TAHAP2_DISDIK_108($thbl,$spmu){
        $sql = "SELECT A.JML_NRK,A.NJTUNDA,B.NAMA AS SKPD
                FROM (
                    SELECT
                                    COUNT (NRK) AS JML_NRK,
                                    SUM (NJTUNDABERSIH) AS NJTUNDA,
                                    SPMU
                    FROM
                                    PROSES_TKD_TAHAP2
                    WHERE THBL = '".$thbl."'
                    AND SPMU = '".$spmu."'
                    AND NJTUNDABERSIH > 0  
                    and upload IN (1)
                    GROUP BY SPMU
                )A
                LEFT JOIN(
                    SELECT KODE_SPM,NAMA,TAHUN 
                    FROM PERS_TABEL_SPMU
                )B ON A.SPMU = B.KODE_SPM 
                 ";
        return $this->db->query($sql)->row(); 
    }

    public function qr_REKAP_TKD_TAHAP2_DISDIK_108_ALL($thbl,$spmu){
        $sql = "SELECT SUM(JML_NRK) as JML,SUM(NJTUNDA) as JML_NJTUNDA,'DINAS PENDIDIKAN & DINAS PENDIDIKAN (GURU-GURU)' AS SKPD
                FROM (
                    SELECT
                                    COUNT (NRK) AS JML_NRK,
                                    SUM (NJTUNDABERSIH) AS NJTUNDA,
                                    SPMU
                    FROM
                                    PROSES_TKD_TAHAP2
                    WHERE THBL = '".$thbl."'
                    AND SPMU IN ('C040','C041')
                    AND NJTUNDABERSIH > 0  
                    and upload IN (1)
                    GROUP BY SPMU
                )A
                LEFT JOIN(
                    SELECT KODE_SPM,NAMA,TAHUN 
                    FROM PERS_TABEL_SPMU
                )B ON A.SPMU = B.KODE_SPM 
                 ";
        return $this->db->query($sql)->row(); 
    }

    public function qr_REKAP_TKD_TAHAP2_108($thbl,$spmu){
        $sql = "SELECT A.JML_NRK,A.NJTUNDA,B.NAMA AS SKPD
                FROM (
                    SELECT
                                    COUNT (NRK) AS JML_NRK,
                                    SUM (NJTUNDABERSIH) AS NJTUNDA,
                                    SPMU
                    FROM
                                    PROSES_TKD_TAHAP2
                    WHERE THBL = '".$thbl."'
                    AND SPMU = '".$spmu."'
                    AND NJTUNDABERSIH > 0  
                    and upload IN (1)
                    GROUP BY SPMU
                )A
                LEFT JOIN(
                    SELECT KODE_SPM,NAMA,TAHUN 
                    FROM PERS_TABEL_SPMU
                )B ON A.SPMU = B.KODE_SPM 
                 ";
        return $this->db->query($sql)->row(); 
    }

    public function qr_REKAP_TKD_TAHAP2_GAB_108($thbl,$spmu){
        $sql = "SELECT A.JML_NRK,A.NJTUNDA,B.NAMA AS SKPD
                FROM (
                    SELECT
                                    COUNT (NRK) AS JML_NRK,
                                    SUM (NJTUNDABERSIH) AS NJTUNDA,
                                    SPMU
                    FROM
                                    PROSES_TKD_TAHAP2
                    WHERE THBL = '".$thbl."'
                    AND SPMU = '".$spmu."'
                    AND NJTUNDABERSIH > 0  
                    and upload IN ( 1,9)
                    GROUP BY SPMU
                )A
                LEFT JOIN(
                    SELECT KODE_SPM,NAMA,TAHUN 
                    FROM PERS_TABEL_SPMU
                )B ON A.SPMU = B.KODE_SPM 
                 ";
        return $this->db->query($sql)->row(); 
    }

    public function qr_REKAP_TKD_TAHAP2_GAB_108_ALL($thbl,$spmu){
        $sql = "SELECT SUM(JML_NRK) as JML,SUM(NJTUNDA) as JML_NJTUNDA,'SELURUH SKPD' AS SKPD
                FROM (
                    SELECT
                                    COUNT (NRK) AS JML_NRK,
                                    SUM (NJTUNDABERSIH) AS NJTUNDA,
                                    SPMU
                    FROM
                                    PROSES_TKD_TAHAP2
                    WHERE THBL = '".$thbl."'
                    AND NJTUNDABERSIH > 0  
                    and upload IN ( 1,9)
                    GROUP BY SPMU
                )A
                LEFT JOIN(
                    SELECT KODE_SPM,NAMA,TAHUN 
                    FROM PERS_TABEL_SPMU
                )B ON A.SPMU = B.KODE_SPM 
                 ";
        return $this->db->query($sql)->row(); 
    }

    public function qr_rptSPMDinkes_pph15($thbl,$klogad){
        $sql = "SELECT A.JML_NRK,A.JML_PPHTUNDA,B.NAMA AS SKPD,C.NALOKL
                FROM (
                                SELECT
                                                COUNT (NRK) AS JML_NRK,
                                                SUM (NPPHTUNDA) AS JML_PPHTUNDA,
                                                KLOGAD,SPMU
                                FROM
                                                PERS_DUK_PANGKAT_HIST_PPH
                                WHERE THBL = '".$thbl."'
                                AND SPMU IN ('C030','C031')
                                AND KLOGAD = '".$klogad."' 
                                AND UPLOAD IN (1)
                                GROUP BY KLOGAD,SPMU
                )A
                LEFT JOIN(
                    SELECT KODE_SPM,NAMA,TAHUN 
                    FROM PERS_TABEL_SPMU
                )B ON A.SPMU = B.KODE_SPM 
                LEFT JOIN (
                    SELECT KOLOK,NALOKL
                    FROM PERS_LOKASI_TBL
                )C ON A.KLOGAD = C.KOLOK 
                 ";
        return $this->db->query($sql)->row(); 
    }

    public function qr_rptSPMDisdik_pph15($thbl,$klogad){
        $sql = "SELECT A.JML_NRK,A.JML_PPHTUNDA,B.NAMA AS SKPD,C.NALOKL
                FROM (
                                SELECT
                                                COUNT (NRK) AS JML_NRK,
                                                SUM (NPPHTUNDA) AS JML_PPHTUNDA,
                                                KLOGAD,SPMU
                                FROM
                                                PERS_DUK_PANGKAT_HIST_PPH
                                WHERE THBL = '".$thbl."'
                                AND SPMU IN ('C040','C041')
                                AND KLOGAD = '".$klogad."' 
                                AND UPLOAD IN (1)
                                GROUP BY KLOGAD,SPMU
                )A
                LEFT JOIN(
                    SELECT KODE_SPM,NAMA,TAHUN 
                    FROM PERS_TABEL_SPMU
                )B ON A.SPMU = B.KODE_SPM 
                LEFT JOIN (
                    SELECT KOLOK,NALOKL
                    FROM PERS_LOKASI_TBL
                )C ON A.KLOGAD = C.KOLOK 
                 ";
        return $this->db->query($sql)->row(); 
    }

    public function qr_rptSPM_pph15($thbl,$klogad,$spmu){
        $sql = "SELECT A.JML_NRK,A.JML_PPHTUNDA,B.NAMA AS SKPD,C.NALOKL
                FROM (
                                SELECT
                                                COUNT (NRK) AS JML_NRK,
                                                SUM (NPPHTUNDA) AS JML_PPHTUNDA,
                                                KLOGAD,SPMU
                                FROM
                                                PERS_DUK_PANGKAT_HIST_PPH
                                WHERE THBL = '".$thbl."'
                                AND SPMU = '".$spmu."'
                                AND KLOGAD = '".$klogad."' 
                                AND UPLOAD IN (1)
                                GROUP BY KLOGAD,SPMU
                )A
                LEFT JOIN(
                    SELECT KODE_SPM,NAMA,TAHUN 
                    FROM PERS_TABEL_SPMU
                )B ON A.SPMU = B.KODE_SPM 
                LEFT JOIN (
                    SELECT KOLOK,NALOKL
                    FROM PERS_LOKASI_TBL
                )C ON A.KLOGAD = C.KOLOK 
                 ";
        return $this->db->query($sql)->row(); 
    }

    public function qr_rptSPMGab_pph15($thbl,$klogad,$spmu){
        $sql = "SELECT A.JML_NRK,A.JML_PPHTUNDA,B.NAMA AS SKPD,C.NALOKL
                FROM (
                                SELECT
                                                COUNT (NRK) AS JML_NRK,
                                                SUM (NPPHTUNDA) AS JML_PPHTUNDA,
                                                KLOGAD,SPMU
                                FROM
                                                PERS_DUK_PANGKAT_HIST_PPH
                                WHERE THBL = '".$thbl."'
                                AND SPMU = '".$spmu."'
                                AND KLOGAD = '".$klogad."' 
                                AND UPLOAD IN (1)
                                GROUP BY KLOGAD,SPMU
                )A
                LEFT JOIN(
                    SELECT KODE_SPM,NAMA,TAHUN 
                    FROM PERS_TABEL_SPMU
                )B ON A.SPMU = B.KODE_SPM 
                LEFT JOIN (
                    SELECT KOLOK,NALOKL
                    FROM PERS_LOKASI_TBL
                )C ON A.KLOGAD = C.KOLOK 
                 ";
        return $this->db->query($sql)->row(); 
    }

    public function qr_rekapSPMDinkes_pph15($thbl,$spmu){
        $sql = "SELECT A.JML_NRK,A.JML_PPHTUNDA,B.NAMA AS SKPD
                FROM (
                                SELECT
                                                COUNT (NRK) AS JML_NRK,
                                                SUM (NPPHTUNDA) AS JML_PPHTUNDA,
                                                SPMU
                                FROM
                                                PERS_DUK_PANGKAT_HIST_PPH
                                WHERE THBL = '".$thbl."'
                                AND SPMU = '".$spmu."'
                                AND UPLOAD = 1
                                GROUP BY SPMU
                )A
                LEFT JOIN(
                    SELECT KODE_SPM,NAMA,TAHUN 
                    FROM PERS_TABEL_SPMU
                )B ON A.SPMU = B.KODE_SPM 
                
                 ";
        return $this->db->query($sql)->row(); 
    }

    public function qr_rekapSPMDinkes_pph15_all($thbl){
        $sql = "SELECT SUM(JML_NRK) as JML,SUM(JML_PPHTUNDA) as SUM_PPHTUNDA,'DINAS KESEHATAN & DINAS KESEHATAN (PARAMEDIS)' AS SKPD
                FROM (
                    SELECT
                                    COUNT (NRK) AS JML_NRK,
                                    SUM (NPPHTUNDA) AS JML_PPHTUNDA,
                                    SPMU
                    FROM
                                    PERS_DUK_PANGKAT_HIST_PPH
                    WHERE THBL = '".$thbl."'
                    AND SPMU IN ('C030','C031') 
                    and upload IN (1)
                    GROUP BY SPMU
                )A
                LEFT JOIN(
                    SELECT KODE_SPM,NAMA,TAHUN 
                    FROM PERS_TABEL_SPMU
                )B ON A.SPMU = B.KODE_SPM 
                
                 ";
        return $this->db->query($sql)->row();
    }

    public function qr_rekapSPMDisdik_pph15($thbl,$spmu){
        $sql = "SELECT A.JML_NRK,A.JML_PPHTUNDA,B.NAMA AS SKPD
                FROM (
                                SELECT
                                                COUNT (NRK) AS JML_NRK,
                                                SUM (NPPHTUNDA) AS JML_PPHTUNDA,
                                                SPMU
                                FROM
                                                PERS_DUK_PANGKAT_HIST_PPH
                                WHERE THBL = '".$thbl."'
                                AND SPMU = '".$spmu."'
                                AND NVL(NPPHTUNDA,0)>0
                                AND UPLOAD = 1
                                GROUP BY SPMU
                )A
                LEFT JOIN(
                    SELECT KODE_SPM,NAMA,TAHUN 
                    FROM PERS_TABEL_SPMU
                )B ON A.SPMU = B.KODE_SPM 
                
                 ";
        return $this->db->query($sql)->row(); 
    }

    public function qr_rekapSPMDisdik_pph15_all($thbl){
        $sql = "SELECT SUM(JML_NRK) as JML_NRK,SUM(JML_PPHTUNDA) as JML_PPHTUNDA,'DINAS PENDIDIKAN (GURU-GURU)' AS SKPD
                FROM (
                    SELECT
                                    COUNT (NRK) AS JML_NRK,
                                    SUM (NPPHTUNDA) AS JML_PPHTUNDA,
                                    SPMU
                    FROM
                                    PERS_DUK_PANGKAT_HIST_PPH
                    WHERE THBL = '".$thbl."'
                    AND SPMU IN ('C040','C041') 
                    AND NVL(NPPHTUNDA,0)>0
                    AND UPLOAD = 1
                    GROUP BY SPMU
                )A
                LEFT JOIN(
                    SELECT KODE_SPM,NAMA,TAHUN 
                    FROM PERS_TABEL_SPMU
                )B ON A.SPMU = B.KODE_SPM 
                
                 ";
        return $this->db->query($sql)->row();
    }

    public function qr_rekapSPM_pph15($thbl,$spmu){
        $sql = "SELECT A.JML_NRK,A.JML_PPHTUNDA,B.NAMA AS SKPD
                FROM (
                                SELECT
                                                COUNT (NRK) AS JML_NRK,
                                                SUM (NPPHTUNDA) AS JML_PPHTUNDA,
                                                SPMU
                                FROM
                                                PERS_DUK_PANGKAT_HIST_PPH
                                WHERE THBL = '".$thbl."'
                                AND SPMU = '".$spmu."'
                                AND NVL(NPPHTUNDA,0)>0
                                AND UPLOAD = 1
                                GROUP BY SPMU
                )A
                LEFT JOIN(
                    SELECT KODE_SPM,NAMA,TAHUN 
                    FROM PERS_TABEL_SPMU
                )B ON A.SPMU = B.KODE_SPM 
                
                 ";
        return $this->db->query($sql)->row(); 
    }

    public function qr_rekapSPMGab_pph15($thbl,$spmu){
        $sql = "SELECT A.JML_NRK,A.JML_PPHTUNDA,B.NAMA AS SKPD
                FROM (
                    SELECT
                        COUNT (NRK) AS JML_NRK,
                        SUM (NPPHTUNDA) AS JML_PPHTUNDA,
                        SPMU
                    FROM
                        PERS_DUK_PANGKAT_HIST_PPH
                    WHERE THBL = '".$thbl."'
                    AND SPMU = '".$spmu."'
                    and nvl(NPPHTUNDA,0)>0
                    AND UPLOAD = 1
                    GROUP BY SPMU
                )A
                LEFT JOIN(
                    SELECT KODE_SPM,NAMA,TAHUN 
                    FROM PERS_TABEL_SPMU
                )B ON A.SPMU = B.KODE_SPM 
                
                 ";
        return $this->db->query($sql)->row(); 
    }

    public function qr_rekapSPMGab_pph15_all($thbl){
        $sql = "SELECT SUM(JML_NRK) as JML_NRK,SUM(JML_PPHTUNDA) as JML_PPHTUNDA,'SELURUH SKPD' AS SKPD
                FROM (
                    SELECT
                                    COUNT (NRK) AS JML_NRK,
                                    SUM (NPPHTUNDA) AS JML_PPHTUNDA,
                                    SPMU
                    FROM
                                    PERS_DUK_PANGKAT_HIST_PPH
                    WHERE THBL = '".$thbl."'
                    AND NVL(NPPHTUNDA,0)>0
                    AND UPLOAD = 1
                    GROUP BY SPMU
                )A
                LEFT JOIN(
                    SELECT KODE_SPM,NAMA,TAHUN 
                    FROM PERS_TABEL_SPMU
                )B ON A.SPMU = B.KODE_SPM 
                
                 ";
        return $this->db->query($sql)->row();
    }

    public function qr_rptTransportDINKES($thbl,$klogad){
        $sql = "SELECT A.JML_NRK,A.JUMBER,B.NAMA AS SKPD,C.NALOKL
                FROM (
                    SELECT
                        COUNT (NRK) AS JML_NRK,
                        SUM (JUMBER) AS JUMBER,
                        KLOGAD,SPMU
                    FROM
                        PERS_DUK_PANGKAT_TRANSPORT
                    WHERE THBL = '".$thbl."'
                    AND SPMU IN ('C030','C031')
                    AND KLOGAD = '".$klogad."' 
                    AND UPLOAD IN (1)
                    AND STATUS = 1
                    GROUP BY KLOGAD,SPMU
                )A
                LEFT JOIN(
                    SELECT KODE_SPM,NAMA,TAHUN 
                    FROM PERS_TABEL_SPMU
                )B ON A.SPMU = B.KODE_SPM 
                LEFT JOIN (
                    SELECT KOLOK,NALOKL
                    FROM PERS_LOKASI_TBL
                )C ON A.KLOGAD = C.KOLOK 
                
                 ";
        return $this->db->query($sql)->row();
    }

    public function qr_rptTransportDISDIK($thbl,$klogad){
        $sql = "SELECT A.JML_NRK,A.JUMBER,B.NAMA AS SKPD,C.NALOKL
                FROM (
                    SELECT
                        COUNT (NRK) AS JML_NRK,
                        SUM (JUMBER) AS JUMBER,
                        KLOGAD,SPMU
                    FROM
                        PERS_DUK_PANGKAT_TRANSPORT
                    WHERE THBL = '".$thbl."'
                    AND SPMU IN ('C040','C041')
                    AND KLOGAD = '".$klogad."' 
                    AND UPLOAD IN (1)
                    AND STATUS = 1
                    GROUP BY KLOGAD,SPMU
                )A
                LEFT JOIN(
                    SELECT KODE_SPM,NAMA,TAHUN 
                    FROM PERS_TABEL_SPMU
                )B ON A.SPMU = B.KODE_SPM 
                LEFT JOIN (
                    SELECT KOLOK,NALOKL
                    FROM PERS_LOKASI_TBL
                )C ON A.KLOGAD = C.KOLOK 
                
                 ";
        return $this->db->query($sql)->row();
    }

    public function qr_rptTransportSPM($thbl,$spmu,$klogad){
        $sql = "SELECT A.JML_NRK,A.JUMBER,B.NAMA AS SKPD,C.NALOKL
                FROM (
                    SELECT
                        COUNT (NRK) AS JML_NRK,
                        SUM (JUMBER) AS JUMBER,
                        KLOGAD,SPMU
                    FROM
                        PERS_DUK_PANGKAT_TRANSPORT
                    WHERE THBL = '".$thbl."'
                    AND SPMU = '".$spmu."'
                    AND KLOGAD = '".$klogad."' 
                    AND UPLOAD IN (1)
                    AND STATUS = 1
                    GROUP BY KLOGAD,SPMU
                )A
                LEFT JOIN(
                    SELECT KODE_SPM,NAMA,TAHUN 
                    FROM PERS_TABEL_SPMU
                )B ON A.SPMU = B.KODE_SPM 
                LEFT JOIN (
                    SELECT KOLOK,NALOKL
                    FROM PERS_LOKASI_TBL
                )C ON A.KLOGAD = C.KOLOK 
                
                 ";
        return $this->db->query($sql)->row();
    }

    public function qr_rptTransportSPMGab($thbl,$spmu,$klogad){
        $sql = "SELECT A.JML_NRK,A.JUMBER,B.NAMA AS SKPD,C.NALOKL
                FROM (
                    SELECT
                        COUNT (NRK) AS JML_NRK,
                        SUM (JUMBER) AS JUMBER,
                        KLOGAD,SPMU
                    FROM
                        PERS_DUK_PANGKAT_TRANSPORT
                    WHERE THBL = '".$thbl."'
                    AND SPMU = '".$spmu."'
                    AND KLOGAD = '".$klogad."' 
                    AND UPLOAD IN (1)
                    AND STATUS = 1
                    GROUP BY KLOGAD,SPMU
                )A
                LEFT JOIN(
                    SELECT KODE_SPM,NAMA,TAHUN 
                    FROM PERS_TABEL_SPMU
                )B ON A.SPMU = B.KODE_SPM 
                LEFT JOIN (
                    SELECT KOLOK,NALOKL
                    FROM PERS_LOKASI_TBL
                )C ON A.KLOGAD = C.KOLOK 
                
                 ";
        return $this->db->query($sql)->row();
    }

    public function qr_rekapTransportDinkes($thbl,$spmu){
        $sql = "SELECT A.JML_NRK,A.JML_JUMBER,B.NAMA AS SKPD
                FROM (
                    SELECT
                        COUNT (NRK) AS JML_NRK,
                        SUM (JUMBER) AS JML_JUMBER,
                        SPMU
                    FROM
                        PERS_DUK_PANGKAT_TRANSPORT
                    WHERE THBL = '".$thbl."'
                    AND SPMU = '".$spmu."'
                    AND UPLOAD = 1
                    GROUP BY SPMU
                )A
                LEFT JOIN(
                    SELECT KODE_SPM,NAMA,TAHUN 
                    FROM PERS_TABEL_SPMU
                )B ON A.SPMU = B.KODE_SPM  
                
                 ";
        return $this->db->query($sql)->row();
    }

    public function qr_rekapTransportDinkes_all($thbl){
        $sql = "SELECT SUM(JML_NRK) as JML_NRK,SUM(JML_JUMBER) as JML_JUMBER,'DINAS KESEHATAN & DINAS KESEHATAN (PARAMEDIS)' AS SKPD
                FROM (
                    SELECT
                        COUNT (NRK) AS JML_NRK,
                        SUM (JUMBER) AS JML_JUMBER,
                        SPMU
                    FROM
                        PERS_DUK_PANGKAT_TRANSPORT
                    WHERE THBL = '".$thbl."'
                    AND SPMU IN ('C030','C031') 
                    and upload IN (1)
                    GROUP BY SPMU
                )A
                LEFT JOIN(
                    SELECT KODE_SPM,NAMA,TAHUN 
                    FROM PERS_TABEL_SPMU
                )B ON A.SPMU = B.KODE_SPM  
                
                 ";
        return $this->db->query($sql)->row();
    }

    public function qr_rekapTransportDISDIK($thbl,$spmu){
        $sql = "SELECT A.JML_NRK,A.JML_JUMBER,B.NAMA AS SKPD
                FROM (
                    SELECT
                        COUNT (NRK) AS JML_NRK,
                        SUM (JUMBER) AS JML_JUMBER,
                        SPMU
                    FROM
                        PERS_DUK_PANGKAT_TRANSPORT
                    WHERE THBL = '".$thbl."'
                    AND SPMU = '".$spmu."'
                    AND UPLOAD = 1
                    GROUP BY SPMU
                )A
                LEFT JOIN(
                    SELECT KODE_SPM,NAMA,TAHUN 
                    FROM PERS_TABEL_SPMU
                )B ON A.SPMU = B.KODE_SPM  
                
                 ";
        return $this->db->query($sql)->row();
    }

    public function qr_rekapTransportDISDIK_all($thbl){
        $sql = "SELECT SUM(JML_NRK) as JML_NRK,SUM(JML_JUMBER) as JML_JUMBER,'DINAS PENDIDIKAN & DINAS PENDIDIKAN (GURU-GURU)' AS SKPD
                FROM (
                    SELECT
                        COUNT (NRK) AS JML_NRK,
                        SUM (JUMBER) AS JML_JUMBER,
                        SPMU
                    FROM
                        PERS_DUK_PANGKAT_TRANSPORT
                    WHERE THBL = '".$thbl."'
                    AND SPMU IN ('C040','C041') 
                    and upload IN (1)
                    GROUP BY SPMU
                )A
                LEFT JOIN(
                    SELECT KODE_SPM,NAMA,TAHUN 
                    FROM PERS_TABEL_SPMU
                )B ON A.SPMU = B.KODE_SPM  
                
                 ";
        return $this->db->query($sql)->row();
    }

    public function qr_rekapTransportSPM($thbl,$spmu){
        $sql = "SELECT A.JML_NRK,A.JML_JUMBER,B.NAMA AS SKPD
                FROM (
                    SELECT
                        COUNT (NRK) AS JML_NRK,
                        SUM (JUMBER) AS JML_JUMBER,
                        SPMU
                    FROM
                        PERS_DUK_PANGKAT_TRANSPORT
                    WHERE THBL = '".$thbl."'
                    AND SPMU = '".$spmu."'
                    AND UPLOAD = 1
                    GROUP BY SPMU
                )A
                LEFT JOIN(
                    SELECT KODE_SPM,NAMA,TAHUN 
                    FROM PERS_TABEL_SPMU
                )B ON A.SPMU = B.KODE_SPM  
                
                 ";
        return $this->db->query($sql)->row();
    }

    public function qr_rekapTransportgab($thbl,$spmu){
        $sql = "SELECT A.JML_NRK,A.JML_JUMBER,B.NAMA AS SKPD
                FROM (
                    SELECT
                        COUNT (NRK) AS JML_NRK,
                        SUM (JUMBER) AS JML_JUMBER,
                        SPMU
                    FROM
                        PERS_DUK_PANGKAT_TRANSPORT
                    WHERE THBL = '".$thbl."'
                    AND SPMU = '".$spmu."'
                    and  STATUS = 1
                    and jumber > 0
                    AND UPLOAD in (1,9)
                    GROUP BY SPMU
                )A
                LEFT JOIN(
                    SELECT KODE_SPM,NAMA,TAHUN 
                    FROM PERS_TABEL_SPMU
                )B ON A.SPMU = B.KODE_SPM  
                
                 ";
        return $this->db->query($sql)->row();
    }

    public function qr_rekapTransportgab_all($thbl){
        $sql = "SELECT SUM(JML_NRK) as JML_NRK,SUM(JML_JUMBER) as JML_JUMBER,'SELURUH SKPD' AS SKPD
                FROM (
                    SELECT
                        COUNT (NRK) AS JML_NRK,
                        SUM (JUMBER) AS JML_JUMBER,
                        SPMU
                    FROM
                        PERS_DUK_PANGKAT_TRANSPORT
                    WHERE THBL = '".$thbl."'
                    and  STATUS = 1
                    and jumber > 0
                    AND UPLOAD in (1,9)
                    GROUP BY SPMU
                )A
                LEFT JOIN(
                    SELECT KODE_SPM,NAMA,TAHUN 
                    FROM PERS_TABEL_SPMU
                )B ON A.SPMU = B.KODE_SPM  
                
                 ";
        return $this->db->query($sql)->row();
    }

    public function qrbkl($thbl,$nrk){
        $sql = "SELECT A.NRK,B.NAMA,
                CONCAT(
                CASE SUBSTR(A.THBL,5,2)
                WHEN '01' THEN 'JANUARI '
                WHEN '02' THEN 'FEBRUARI '
                WHEN '03' THEN 'MARET '
                WHEN '04' THEN 'APRIL'
                WHEN '05' THEN 'MEI '
                WHEN '06' THEN 'JUNI '
                WHEN '07' THEN 'JULI '
                WHEN '08' THEN 'AGUSTUS '
                WHEN '09' THEN 'SEPTEMBER '
                WHEN '10' THEN 'OKTOBER '
                WHEN '11' THEN 'NOVEMBER '
                WHEN '12' THEN 'DESEMBER '
                END,SUBSTR(A.THBL,1,4))THBL_NOM,A.TUNFUNG AS GJBARU,KODIK AS GOLONGAN,MASKER,NAMISU AS LOKASI
                FROM PERS_DUK_PANGKAT_BKALA A LEFT JOIN PERS_PEGAWAI1 B ON A.NRK = B.NRK
                WHERE A.NRK='".$nrk."' AND A.THBL='".$thbl."'";
        return $this->db->query($sql)->row();
    }

}

?>
