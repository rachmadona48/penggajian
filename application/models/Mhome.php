<?php 

 class Mhome extends CI_Model {

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

    function currentInformation($nrk){
        $sql = "SELECT KOLOK, KLOGAD FROM \"vw_jabatan_terakhir\" WHERE NRK = {$nrk}";
        $result = $this->db->query($sql)->row();
        return $result;
    }

    function getDataUser($id)
    {
        $sql="SELECT \"user_password\" FROM \"master_user\" WHERE \"user_id\"='".$id."'  ";
        $query = $this->db->query($sql)->row();
        return $query;
    }

    function save_userData($id)
    {
        
        $pass = $this->input->post('cnewpass');
        $md5pass=md5($pass);
        
        $sql = "UPDATE \"master_user\" SET \"user_password\" = '".$md5pass."' WHERE \"user_id\" = '".$id."'"; 
        $id = $this->db->query($sql);

        return $id;
    }

    function getPropCetakLaporan($prop)
    {
        $sql = "SELECT PROP,KETERANGAN FROM PERS_PROP_RPT where PROP = ".$prop."";

        $query = $this->db->query($sql)->row();

        return $query;
    }

    function getInfoPembayaranLaporan($kolok)
    {
        $sql = "SELECT * FROM PERS_KLOGAD3 WHERE KOLOK = '".$kolok."' AND AKTIF='1'";

        $query = $this->db->query($sql)->row();

        return $query;

    }
    //untuk laporan
    function getMinGol($nrk)
    {
        $sql = "SELECT A .NRK, TO_CHAR(A.TMT,'DD-MM-YYYY') TMT1, SUBSTR(A .KOPANG, 2, 1)GOL1,A.TTMASKER TTMASKER1,A.BBMASKER BBMASKER1,
                TO_CHAR(B.TMT,'DD-MM-YYYY') TMT2,SUBSTR(B .KOPANG, 2, 1)GOL2, B.TTMASKER TTMASKER2,B.BBMASKER BBMASKER2
                FROM
                    PERS_PANGKAT_HIST A
                LEFT JOIN 
                    PERS_RB_GAPOK_HIST B ON A.NRK=B.NRK
                WHERE
                    A .NRK = '".$nrk."' 
                AND
                    A .TMT = (SELECT MIN(TMT) FROM PERS_PANGKAT_HIST WHERE NRK = '".$nrk."')
                AND 
                    B. TMT = (SELECT MIN(TMT) FROM PERS_RB_GAPOK_HIST WHERE NRK = '".$nrk."')
                ";

        $query = $this->db->query($sql)->row();

        return $query;
    }

    //untuk laporan
    function getMaxGol($nrk)
    {
        $sql = "SELECT A .NRK, TO_CHAR(A.TMT,'DD-MM-YYYY') TMT1, SUBSTR(A .KOPANG, 2, 1)GOL1,A.TTMASKER TTMASKER1,A.BBMASKER BBMASKER1,
                TO_CHAR(B.TMT,'DD-MM-YYYY') TMT2,SUBSTR(B .KOPANG, 2, 1)GOL2, B.TTMASKER TTMASKER2,B.BBMASKER BBMASKER2
                FROM
                    PERS_PANGKAT_HIST A
                LEFT JOIN 
                    PERS_RB_GAPOK_HIST B ON A.NRK=B.NRK
                WHERE
                    A .NRK = '".$nrk."' 
                AND
                    A .TMT = (SELECT MAX(TMT) FROM PERS_PANGKAT_HIST WHERE NRK = '".$nrk."')
                AND 
                    B. TMT = (SELECT MAX(TMT) FROM PERS_RB_GAPOK_HIST WHERE NRK = '".$nrk."')
                ";

        $query = $this->db->query($sql)->row();

        return $query;
    }

    function showMenu()
    {
        $sql= " SELECT \"id_menu\", \"nama_menu\",\"link_menu\"
                FROM \"menu_master\" 
                WHERE \"status_aktif\"='Y' AND \"jenis_menu\"=0 
                ORDER BY \"id_menu\" ASC";
        $query = $this->db->query($sql)->result();
       
        return $query;
    }  

    function getUserInfo($username)
    {
        
        $sql = "SELECT  N.*, LOKASI.NALOKL, LOKASI.NALOKS, 
                (CASE WHEN N.KD = 'S' THEN (SELECT NAJABL FROM PERS_KOJAB_TBL WHERE KOLOK = N.KOLOK AND KOJAB = N.KOJAB) 
                    ELSE (SELECT NAJABL FROM PERS_KOJABF_TBL WHERE KOJAB = N.KOJAB) END) NAJABL 
                FROM (
                SELECT ROWNUM AS nomor, a.* FROM PERS_DUK_PANGKAT_HISTDUK a WHERE a.NRK = '".$username."' ORDER BY nomor DESC
                ) N 
                LEFT JOIN PERS_LOKASI_TBL LOKASI ON N.KOLOK = LOKASI.KOLOK
                WHERE ROWNUM <= 1   ";                  
        $query = $this->db->query($sql);
        return $query->row();
    }

    function getUserCuti($username)
    {
        $sql="SELECT A.NRK,TO_CHAR(A.tmt, 'DD-MM-YYYY')TMT, A.NOSK, TO_CHAR(A.TGSK,'DD-MM-YYYY')TGSK,B.KETERANGAN
                FROM pers_cuti_hist A
                LEFT JOIN PERS_JENCUTI_RPT B ON A.JENCUTI=B.JENCUTI
                where A. NRK='".$username."'";

        $query = $this->db->query($sql);
        return $query->result();   
    }

    function getUserDisiplin($username)
    {
        $sql ="SELECT
                    A .NRK,
                    TO_CHAR (A .TGSK, 'DD-MM-YYYY') TGSK,
                    A .NOSK,
                    A .JENHUKDIS,
                    TO_CHAR (A .TGMULAI, 'DD-MM-YYYY') TGMULAI,
                    TO_CHAR (A .TGAKHIR, 'DD-MM-YYYY') TGAKHIR, B.KETERANGAN
                FROM
                    PERS_DISIPLIN_HIST A
                LEFT JOIN PERS_JENHUKDIS_RPT B ON A.JENHUKDIS = B.JENHUKDIS
                WHERE
                    NRK = '".$username."'";

        $query = $this->db->query($sql);
        return $query->result(); 
    }

    function getUserInfo2($nrk)
    {
        
      
            /*$sql = "SELECT *
                    FROM (
                        SELECT A.NRK, B.TITEL, B.TITELDEPAN, B.NIP18, B.KLOGAD, B.PATHIR, TO_CHAR(B.TALHIR,'DD-MM-YYYY')TLHR, B.JENKEL, A.KD, TO_CHAR(B.MUANG,'DD-MM-YYYY')MUANG,B.STAPEG, TO_CHAR(B.TMT_STAPEG,'DD-MM-YYYY')TMT_STAPEG, A.KOJAB, C.KETERANGAN AS AGAMA, D.KETERANGAN AS STATUS_PEGAWAI, B.NAMA AS NAMA_ABS,
                        G.NALOKL AS NAKLOGAD, H.NALOKL AS NALOKL, A.NAJABL,E.GOL,E.NAPANG,A.ESELON,F.NESELON2
                        FROM \"vw_jabatan_terakhir\" A
                        INNER JOIN PERS_PEGAWAI1 B ON A.NRK = B.NRK
                        LEFT JOIN PERS_AGAMA_RPT C ON B.AGAMA = C.AGAMA
                        LEFT JOIN PERS_STAPEG_RPT D ON B.STAPEG = D.STAPEG
                        --LEFT JOIN PERS_PANGKAT_TBL E ON A.KOPANG = E.KOPANG
                        LEFT JOIN VW_PANGKAT_TERAKHIR E ON B.NRK = E.NRK
                        LEFT JOIN PERS_ESELON_TBL F ON A.ESELON = F.ESELON
                                                LEFT JOIN PERS_LOKASI_TBL G ON B.KLOGAD =G.KOLOK
                                                LEFT JOIN PERS_LOKASI_TBL H ON B.KOLOK = H.KOLOK
                        WHERE A.NRK = '".$nrk."'
                    ) PEGAWAI";*/

            $sql="SELECT
                        *
                    FROM
                        (
                            SELECT
                                B .NRK,
                                B.TITEL,
                                B.TITELDEPAN,
                                B.NIP18,
                                B.KLOGAD,
                                B.PATHIR,
                                TO_CHAR (B.TALHIR, 'DD-MM-YYYY') TLHR,
                                B.JENKEL,
                                A .KD,
                                TO_CHAR (B.MUANG, 'DD-MM-YYYY') MUANG,
                                B.STAPEG,
                                TO_CHAR (B.TMT_STAPEG, 'DD-MM-YYYY') TMT_STAPEG,
                                A .KOJAB,
                                C.KETERANGAN AS AGAMA,
                                D .KETERANGAN AS STATUS_PEGAWAI,
                                B.NAMA AS NAMA_ABS,
                                G .NALOKL AS NAKLOGAD,
                                H .NALOKL AS NALOKL,
                                A .NAJABL,
                                E .GOL,
                                E .NAPANG,
                                A .ESELON,
                                F.NESELON2,
                                P2.EMAIL,
                                P2.NOHP
                            FROM
                                PERS_PEGAWAI1 B
                                LEFT JOIN \"vw_jabatan_terakhir\" A ON A.NRK=B.NRK
                            LEFT JOIN PERS_AGAMA_RPT C ON B.AGAMA = C.AGAMA
                            LEFT JOIN PERS_STAPEG_RPT D ON B.STAPEG = D .STAPEG 
                            LEFT JOIN VW_PANGKAT_TERAKHIR E ON B.NRK = E .NRK
                            LEFT JOIN PERS_ESELON_TBL F ON A .ESELON = F.ESELON
                            LEFT JOIN PERS_LOKASI_TBL G ON B.KLOGAD = G .KOLOK
                            LEFT JOIN PERS_LOKASI_TBL H ON B.KOLOK = H .KOLOK
                            LEFT JOIN PERS_PEGAWAI2 P2 ON B.NRK = P2.NRK
                            WHERE
                               B .NRK = '".$nrk."'
                        ) PEGAWAI";

        $query = $this->db->query($sql);
        //$query = $this->prod->query($sql);

        return $query->row();
    }

    function cekDataPeg1($nrk)
    {
        $sql = "SELECT * FROM PERS_PEGAWAI1 WHERE NRK='".$nrk."'";

        $query = $this->db->query($sql);

        return $query->row();
    }

    function getUserInfoORP($nrk)
    {
        $sql = "SELECT A.NRK,A.NIP18,A.NAMA,TO_CHAR(A.TALHIR,'DD-MM-YYYY')TLHR,A.PATHIR,A.TITEL,RIWJAB.NALOKL,RIWJAB.NAJABL
                FROM
                    PERS_PEGAWAI1 A
                LEFT JOIN 
                (
                    SELECT PEG.* FROM
                    (
                            SELECT JAB.TMT,JAB.KOLOK,JAB.KOJAB,JAB.NAJABL, JAB.NALOKL,JAB.NRK,JAB.GOL FROM 
                            (
                                SELECT JS.NRK,JS.TMT,JS.KOLOK,JS.KOJAB,KJS.NAJABL,LOK.NALOKL,PG.GOL
                                FROM PERS_JABATAN_HIST JS
                                LEFT JOIN PERS_LOKASI_TBL LOK ON LOK.KOLOK = JS.KOLOK
                                LEFT JOIN PERS_KOJAB_TBL KJS ON JS.KOLOK = KJS.KOLOK AND JS.KOJAB = KJS.KOJAB
                                LEFT JOIN PERS_PANGKAT_TBL PG ON JS.KOPANG = PG.KOPANG
                                WHERE JS.NRK = '".$nrk."' AND JS.TMT = (SELECT MAX(TMT) FROM PERS_JABATAN_HIST WHERE NRK = '".$nrk."' AND KOLOK != '8888888888')

                                UNION

                                SELECT  JF.NRK,JF.TMT,JF.KOLOK,JF.KOJAB,KJF.NAJABL,LOK.NALOKL,PG.GOL
                                FROM PERS_JABATANF_HIST JF 
                                LEFT JOIN PERS_KOJABF_TBL KJF ON JF.KOJAB = KJF.KOJAB
                                LEFT JOIN PERS_LOKASI_TBL LOK ON LOK.KOLOK = JF.KOLOK
                                LEFT JOIN PERS_PANGKAT_TBL PG ON JS.KOPANG = PG.KOPANG
                                WHERE JF.NRK = '".$nrk."' AND JF.TMT = (SELECT MAX(TMT) FROM PERS_JABATANF_HIST WHERE NRK = '".$nrk."' AND KOLOK != '8888888888')
                            ) JAB
                            ORDER BY (JAB.TMT) DESC
                    )PEG WHERE ROWNUM = 1 
                ) RIWJAB ON RIWJAB.NRK = A.NRK 
                WHERE
                    A.NRK = '".$nrk."'";
        // $query = $this->prod->query($sql);
        $query = $this->db->query($sql);
        
        return $query->row();
    }

    function getUserInfo3($nrk)
    {
        // $sql="SELECT A.NRK, A.NOTELP, A.NOHP, A.ALAMAT, A.RT, A.RW, A.EMAIL, B.NAWIL, C.NACAM, D.NAKEL, E.KETERANGAN AS PROPINSI
        //     FROM PERS_PEGAWAI2 A
        //     LEFT JOIN PERS_KOWIL_TBL B ON A.KOWIL = B.KOWIL
        //     LEFT JOIN PERS_KOCAM_TBL C ON A.KOCAM = C.KOCAM AND B.KOWIL = C.KOWIL
        //     LEFT JOIN PERS_KOKEL_TBL D ON A.KOKEL = D.KOKEL AND C.KOCAM = D.KOCAM AND B.KOWIL = D.KOWIL
        //     LEFT JOIN PERS_PROP_RPT E ON A.PROP = E.PROP
        //     WHERE A.NRK ='".$nrk."' ";

        $sql="SELECT A.NRK, A.NOTELP, A.NOHP, A.ALAMAT, A.RT, A.RW, A.EMAIL, B.NAMA AS NAWIL, C.NAMA AS NACAM, D.NAMA AS NAKEL, E.NAMA AS PROPINSI
            FROM PERS_PEGAWAI2 A
            LEFT JOIN LOKASI B ON A.KOWIL = B.KODE
            LEFT JOIN LOKASI C ON A.KOCAM = C.KODE
            LEFT JOIN LOKASI D ON A.KOKEL = D.KODE
            LEFT JOIN LOKASI E ON A.PROP = E.KODE
            WHERE A.NRK ='".$nrk."' ";
            // echo $sql;exit;
        
        $query = $this->db->query($sql);
        //$query = $this->prod->query($sql);
        return $query->row();
    }


    function getRiwayatKerjaPegawai($nrk)
    {
        $sql = "SELECT A.NRK,TO_CHAR(A.TMT,'DD-MM-YYYY')TMT,A.JENRUB,A.KOPANG,A.GAPOK,A.TTMASKER,A.BBMASKER,A.KOLOK,B.GOL, B.NAPANG
                FROM PERS_RB_GAPOK_HIST A
                LEFT JOIN PERS_PANGKAT_TBL B ON A.KOPANG=B.KOPANG 
                WHERE NRK = '".$nrk."' AND TMT = (SELECT MAX(TMT) FROM PERS_RB_GAPOK_HIST WHERE NRK='".$nrk."')";

        $query = $this->db->query($sql);

        return $query->row();
    }

    function getIstriSuami($nrk)
    {
        $sql = "SELECT A.HUBKEL, A.NAMA,A.TEMHIR,TO_CHAR (A.TALHIR, 'DD-MM-YYYY') TALHIR,TO_CHAR (A.TGNIKAH, 'DD-MM-YYYY') TGNIKAH,B.NAHUBKEL
                FROM PERS_KELUARGA A
                LEFT JOIN PERS_HUBKEL_TBL B ON A.HUBKEL = B.HUBKEL 
                WHERE
                    A.NRK = '".$nrk."'
                AND (
                    A.HUBKEL = 10
                    OR A.HUBKEL = 20
                    OR A.HUBKEL = 30
                    OR A.HUBKEL = 40
                ) 
                ";

        $query = $this->db->query($sql);

        return $query;
    }

    function getAnakKandung($nrk)
    {
        $sql="SELECT A.HUBKEL, A.NAMA,TO_CHAR (A.TALHIR, 'DD-MM-YYYY') TALHIR,B.NAHUBKEL
                FROM PERS_KELUARGA A
                LEFT JOIN PERS_HUBKEL_TBL B ON A.HUBKEL = B.HUBKEL 
                WHERE
                    A.NRK = '".$nrk."'
                AND (
                    (A.HUBKEL >= 11 AND A.HUBKEL <= 19)
                    OR (A.HUBKEL >= 21 AND A.HUBKEL <= 29)
                    OR (A.HUBKEL >= 31 AND A.HUBKEL <= 39)
                    OR (A.HUBKEL >= 41 AND A.HUBKEL <= 49)
                )

            ";
        $query = $this->db->query($sql);

        return $query;
    }

    

    function updateKolokKojab($nrk)
    {
        $sql="SELECT NRK FROM PERS_PEGAWAI1 WHERE NRK = '".$nrk."'";
        $peg = $this->db->query($sql)->row();
        $i=1;
        
        $sql2=" SELECT
                        A.NRK,
                        S.KODE_SPM,
                        JAB.KOLOK,
                        JAB.KOJAB,
                        JAB.TMT,
                        JAB.KD
                    FROM
                        PERS_PEGAWAI1 A
                    LEFT JOIN (
                        SELECT
                            N.NRK,
                            N.KOLOK,
                            N.KOJAB,
                            N.TMT,
                            'S' AS KD
                        FROM
                            PERS_JABATAN_HIST N
                        UNION
                            SELECT
                                F.NRK,
                                F.KOLOK,
                                F.KOJAB,
                                F.TMT,
                                'F' AS KD
                            FROM
                                PERS_JABATANF_HIST F
                    ) JAB ON A .NRK = JAB.NRK
                    LEFT JOIN PERS_TABEL_SPMU S ON JAB.KOLOK = S.KLOGAD_INDUK
                    WHERE
                        A .NRK = '".$peg->NRK."'
                    ORDER BY
                        JAB.TMT DESC";

            $query2= $this->db->query($sql2)->row();
            

            $sql3= "UPDATE PERS_PEGAWAI1 SET KOLOK ='".$query2->KOLOK."', KOJAB='".$query2->KOJAB."', SPMU='".$query2->KODE_SPM."', KD='".$query2->KD."' 
                WHERE NRK='".$peg->NRK."'";

            $query3= $this->db->query($sql3);   
            //echo $i." : ".$key->NRK." : ".$query2->KOLOK." : ". $query2->KOJAB." : ".$query2->KODE_SPM."<br/>";
            //$i++; 
    }

    function getUserInfoAlamat($nrk)
    {
        // $sql="SELECT a.NRK, a.ALAMAT, a.RT, a.RW, b.NAWIL, c.NACAM, d.NAKEL, e.KETERANGAN PROP
        //         FROM PERS_PEGAWAI2 a
        //         LEFT JOIN PERS_KOWIL_TBL b ON a.KOWIL = b.KOWIL
        //         LEFT JOIN PERS_KOCAM_TBL c ON a.KOCAM = c.KOCAM AND b.KOWIL = c.KOWIL
        //         LEFT JOIN PERS_KOKEL_TBL d ON a.KOKEL = d.KOKEL AND c.KOCAM = d.KOCAM AND b.KOWIL = d.KOWIL
        //         LEFT JOIN PERS_PROP_RPT e ON a.PROP = e.PROP
        //         WHERE a.NRK = '".$nrk."'";
        $sql="SELECT a.NRK, a.ALAMAT, a.RT, a.RW, b.NAMA AS NAWIL, c.NAMA AS NACAM, d.NAMA AS NAKEL, e.NAMA AS PROP
                FROM PERS_PEGAWAI2 a
                LEFT JOIN LOKASI b ON a.KOWIL = b.KODE
                LEFT JOIN LOKASI c ON a.KOCAM = c.KODE
                LEFT JOIN LOKASI d ON a.KOKEL = d.KODE
                LEFT JOIN LOKASI e ON a.PROP = e.KODE
                WHERE a.NRK = '".$nrk."'";
        //$query = $this->prod->query($sql);
        $query = $this->db->query($sql);
        return $query->row();        
    }

    function getUserInfoAlamat2($nrk)
    {
        $sql="SELECT a.NRK, a.ALAMAT, a.RT, a.RW, b.NAMA AS NAWIL, c.NAMA AS NACAM, d.NAMA AS NAKEL, e.NAMA AS PROP
                FROM PERS_PEGAWAI2 a
                LEFT JOIN LOKASI b ON a.KOWIL = b.KODE
                LEFT JOIN LOKASI c ON a.KOCAM = c.KODE
                LEFT JOIN LOKASI d ON a.KOKEL = d.KODE
                LEFT JOIN LOKASI e ON a.PROP = e.KODE
                WHERE a.NRK = '".$nrk."'";
        // echo $sql;exit;                
        $query = $this->db->query($sql);
        //$query = $this->db->query($sql);
        return $query->row();        
    }

    function getUserInfoPendFormal($nrk)
    {             
        $sql = "SELECT A.NRK, A.TGIJAZAH, A.NASEK,A.KOTSEK, A.JENDIK,A.UNIVER,B.NAUNIVER,A.NOIJAZAH
                FROM PERS_PENDIDIKAN A
                                LEFT JOIN PERS_UNIVER_TBL B ON A.UNIVER = B.KDUNIVER
                WHERE A.NRK = '".$nrk."' AND A.JENDIK = 1 ORDER BY A.NRK,A.JENDIK,A.TGIJAZAH DESC" ;
        //$query = $this->prod->query($sql);
        $query = $this->db->query($sql);
        return $query->result();
    }

    function getUserInfoPendNonFormal($nrk)
    {             
        $sql = "SELECT NRK, to_char(TGIJAZAH, 'YYYY-MM-DD') TGIJAZAH, NASEK,KOTSEK, JENDIK,NOIJAZAH
                FROM PERS_PENDIDIKAN
                WHERE NRK = '".$nrk."' AND JENDIK <> 1 ORDER BY TGIJAZAH DESC" ;
        //$query = $this->prod->query($sql);
        $query = $this->db->query($sql);
        return $query->result();
    }

    function getUserHargaan($nrk)
    {
        $sql ="SELECT a.NRK, a.KDHARGA, b.NAHARGA, to_char(a.TGSK, 'YYYY-MM-DD') TGSK, a.NOSK, a.ASAL_HRG
                FROM PERS_PENGHARGAAN a
                LEFT JOIN PERS_HARGAAN_TBL b ON a.KDHARGA = b.KDHARGA
                WHERE a.NRK = '".$nrk."' ORDER BY a.TGSK DESC";
        //$query = $this->prod->query($sql);
        $query = $this->db->query($sql);
        return $query->result();        
    }

    function getUserGapok($nrk)
    {
        $sql ="SELECT A.NRK,A.TMT,A.JENRUB,A.KOPANG,A.NOSK,TO_CHAR(A.TGSK,'DD-MM-YYYY')TGSK,A.GAPOK,A.TTMASKER,A.BBMASKER,A.KOLOK,B.GOL, B.NAPANG
                FROM PERS_RB_GAPOK_HIST A
                LEFT JOIN PERS_PANGKAT_TBL B ON A.KOPANG=B.KOPANG 
                WHERE NRK = '".$nrk."' AND ROWNUM <=5 ORDER BY TMT DESC";
        //$query = $this->prod->query($sql);

        $query = $this->db->query($sql);
        return $query->result();        
    }

    function getUserOrgan($nrk)
    {
        $sql ="SELECT a.NRK, COALESCE(to_char(a.DARI, 'YYYY-MM-DD'),'-') DARI, COALESCE(to_char(a.SAMPAI, 'YYYY-MM-DD'),'-') SAMPAI, a.NAORGANI, b.KETERANGAN, a.KOTA
                FROM PERS_ORGAN_HIST a
                LEFT JOIN PERS_KDDUDUK_RPT b ON a.KDDUDUK = b.KDDUDUK
                WHERE a.NRK = '".$nrk."' ORDER BY a.DARI DESC
                ";

        $query = $this->db->query($sql);
        return $query->result();        
    }

    function getUserHubkel($nrk)
    {
        //dev 74
        /*$sql="SELECT a.NRK, a.NIK, a.HUBKEL, b.NAHUBKEL, a.NAMA, a.TEMHIR, to_char(a.TALHIR, 'YYYY-MM-DD') TALHIR, to_char(a.TGNIKAH, 'YYYY-MM-DD') TGNIKAH, a.TEMNIKAH, c.KETERANGAN TUNJANGAN, d.KETERANGAN KERJAAN, a.JENKEL, to_char(a.MATI, 'YYYY-MM-DD') MATI, a.UANGDUKA
                FROM PERS_KELUARGA a
                LEFT JOIN PERS_HUBKEL_TBL b ON a.HUBKEL = b.HUBKEL
                LEFT JOIN PERS_STATTUN_RPT c ON a.STATTUN = c.STATTUN
                LEFT JOIN PERS_KDKERJA_RPT d ON a.KDKERJA = d.KDKERJA
                WHERE a.NRK = '".$nrk."' ORDER BY a.TALHIR ASC";*/

        $sql="SELECT a.NRK, a.NIK, a.HUBKEL, b.NAHUBKEL, a.NAMA, a.TEMHIR, to_char(a.TALHIR, 'YYYY-MM-DD') TALHIR, to_char(a.TGNIKAH, 'YYYY-MM-DD') TGNIKAH, a.TEMNIKAH, c.KETERANGAN TUNJANGAN, d.KETERANGAN KERJAAN, a.JENKEL, to_char(a.MATI, 'YYYY-MM-DD') MATI, a.UANGDUKA
                FROM PERS_KELUARGA a
                LEFT JOIN PERS_HUBKEL_TBL b ON a.HUBKEL = b.HUBKEL
                LEFT JOIN PERS_STATTUN_RPT c ON a.STATTUN = c.STATTUN
                LEFT JOIN PERS_KDKERJA_RPT d ON a.KDKERJA = d.KDKERJA
                WHERE a.HUBKEL > = 10 AND a.HUBKEL<=49 and a.NRK = '$nrk' ORDER BY a.HUBKEL ASC";

        $query = $this->db->query($sql);


        //orp 1
        /*$sql="SELECT a.NRK, a.HUBKEL, b.NAHUBKEL, a.NAMA, a.TEMHIR, to_char(a.TALHIR, 'YYYY-MM-DD') TALHIR, to_char(a.TGNIKAH, 'YYYY-MM-DD') TGNIKAH, a.TEMNIKAH, c.KETERANGAN TUNJANGAN, d.KETERANGAN KERJAAN, a.JENKEL, to_char(a.MATI, 'YYYY-MM-DD') MATI, a.UANGDUKA
                FROM PERS_KELUARGA a
                LEFT JOIN PERS_HUBKEL_TBL b ON a.HUBKEL = b.HUBKEL
                LEFT JOIN PERS_STATTUN_RPT c ON a.STATTUN = c.STATTUN
                LEFT JOIN PERS_KDKERJA_RPT d ON a.KDKERJA = d.KDKERJA
                WHERE a.NRK = '".$nrk."' ORDER BY a.TALHIR ASC";
        $query = $this->prod->query($sql); */ 
        return $query->result();       
    }

    function getUserPangkat($nrk)
    {
        $sql = "SELECT KO.NRK,to_char(KO.TMT, 'YYYY-MM-DD') TMT, KO.NOSK, to_char(KO.TGSK, 'YYYY-MM-DD') TGSK, KO.KOPANG, TB.GOL, TB.NAPANG, KO.KOLOK, LO.NALOKL, KO.GAPOK
                FROM PERS_PANGKAT_HIST KO
                LEFT JOIN PERS_PANGKAT_TBL TB ON KO.KOPANG = TB.KOPANG
                LEFT JOIN PERS_LOKASI_TBL LO ON KO.KOLOK = LO.KOLOK
                WHERE KO.NRK = '".$nrk."' 
                ORDER BY KO.TMT DESC";

        //$query = $this->prod->query($sql);
        $query = $this->db->query($sql);
        return $query->result();   
    }

    function getFirstPangkat($nrk)
    {
        $sql = "SELECT NRK,TO_CHAR(TMT,'DD-MM-YYYY') TMT,GAPOK,JENRUB,KOPANG,TTMASKER,BBMASKER
                FROM PERS_RB_GAPOK_HIST
                WHERE NRK = '".$nrk."'
                AND TMT = (
                    SELECT
                        MIN (TMT)
                    FROM
                        PERS_RB_GAPOK_HIST
                    WHERE
                        nrk = '".$nrk."'
                )";
        
        $query = $this->db->query($sql)->row();
        return $query;
    }

    function getUserInfoJabatanS($nrk)
    {
        $sql = "SELECT JH.NRK, JH.TMT, ES.NESELON2
                FROM PERS_JABATAN_HIST JH
                LEFT JOIN PERS_ESELON_TBL ES ON JH.ESELON = ES.ESELON
                WHERE NRK = '".$nrk."' AND ROWNUM = 1
                ORDER BY TMT DESC";

         $query = $this->db->query($sql);
        return $query->row();   
    }

    function getUserJabatanS($nrk)
    {
        /*$sql = "SELECT JH.NRK, JH.TMT, JH.KOLOK, JH.TGSK, JH.NOSK, JH.KOJAB, KO.NAJABL,PG.NAPANG,PG.GOL, LO.NALOKL,JH.ESELON
                FROM PERS_JABATAN_HIST JH
                LEFT JOIN PERS_KOJAB_TBL KO ON JH.KOLOK = KO.KOLOK AND JH.KOJAB = KO.KOJAB
                LEFT JOIN PERS_PANGKAT_TBL PG ON JH.KOPANG = PG.KOPANG
                LEFT JOIN PERS_LOKASI_TBL LO ON JH.KOLOK = LO.KOLOK
                WHERE JH.NRK = '".$nrk."' AND ROWNUM < 4
                ORDER BY JH.TMT DESC";*/

        $sql = "SELECT JH.NRK, JH.TMT, JH.KOLOK, JH.TGSK, JH.NOSK, JH.KOJAB, KO.NAJABL,PG.NAPANG,PG.GOL, LO.NALOKL,JH.ESELON
                FROM PERS_JABATAN_HIST JH
                LEFT JOIN PERS_KOJAB_TBL KO ON JH.KOLOK = KO.KOLOK AND JH.KOJAB = KO.KOJAB
                LEFT JOIN PERS_PANGKAT_TBL PG ON JH.KOPANG = PG.KOPANG
                LEFT JOIN PERS_LOKASI_TBL LO ON JH.KOLOK = LO.KOLOK
                WHERE JH.NRK = '".$nrk."'
                ORDER BY JH.TMT DESC";

        //$query = $this->prod->query($sql);
         $query = $this->db->query($sql);
        return $query->result();   
    }

    function getUserJabatanF($nrk)
    {
        /*$sql = "SELECT JH.NRK, JH.TMT, JH.TGSK, JH.NOSK,JH.KOJAB, KO.NAJABL,PG.NAPANG,PG.GOL,LO.NALOKL
                FROM PERS_JABATANF_HIST JH
                LEFT JOIN PERS_KOJABF_TBL KO ON JH.KOJAB = KO.KOJAB
                LEFT JOIN PERS_PANGKAT_TBL PG ON JH.KOPANG = PG.KOPANG
                LEFT JOIN PERS_LOKASI_TBL LO ON JH.KOLOK = LO.KOLOK
                WHERE JH.NRK = '".$nrk."' AND ROWNUM < 4
                ORDER BY JH.TMT DESC";*/

        $sql = "SELECT JH.NRK, JH.TMT, JH.TGSK, JH.NOSK,JH.KOJAB, KO.NAJABL,PG.NAPANG,PG.GOL,LO.NALOKL
                FROM PERS_JABATANF_HIST JH
                LEFT JOIN PERS_KOJABF_TBL KO ON JH.KOJAB = KO.KOJAB
                LEFT JOIN PERS_PANGKAT_TBL PG ON JH.KOPANG = PG.KOPANG
                LEFT JOIN PERS_LOKASI_TBL LO ON JH.KOLOK = LO.KOLOK
                WHERE JH.NRK = '".$nrk."'
                ORDER BY JH.TMT DESC";

        //$query = $this->prod->query($sql);
        $query = $this->db->query($sql);
        return $query->result();   
    }

     function getUserSKP($nrk)
    {
        $sql ="SELECT NRK,TAHUN,PELAYANAN,INTEGRITAS,KOMITMEN,DISIPLIN,KERJASAMA,KEPEMIMPINAN,JUMLAH,RATA2,NILAI_SKP,NILAI_PERILAKU,NILAI_PRESTASI,F_GET_NAMA(NRK_PEJABAT_PENILAI)NAMA_PEJABAT_PENILAI, F_GET_NAMA(NRK_ATASAN_PEJABAT_PENILAI)NAMA_ATASAN_PEJABAT_PENILAI,INPUT_SKP,F_KET_SKP(NILAI_PRESTASI)KET_PRESTASI
                FROM PERS_skp A
                WHERE NRK = '$nrk' and status_validasi = '1' AND ROWNUM <=5 ORDER BY Tahun DESC";
        //$query = $this->prod->query($sql);

        $query = $this->db->query($sql);
        return $query->result();        
    }

/*START JABATAN STRUKTURAL*/
    public function save_jabStruk($data)
    {

        $NRK = $this->input->post('nrk');
        $TMT = $this->input->post('tmt');
        $KOLOK = $this->input->post('kolok');
        $KOJAB = $this->input->post('kojab');
        $KLOGAD = $this->input->post('klogad');
        $SPMU = $this->input->post('spmu');
        $KDSORT = '0';
        $TGAKHIR = $this->input->post('tgakhir');
        $KOPANG = $this->input->post('kopang');
        $ESELON = $this->input->post('eselon');
        $PEJTT = $this->input->post('pejtt');
        $JENSK = $this->input->post('jensk');
        $NOSK = $this->input->post('nosk');
        $TGSK = $this->input->post('tgsk');
        $KREDIT = $this->input->post('kredit');
        if($KREDIT=='')
        {
            $KREDIT = 0;
        }
        $TMTPENSIUN = $this->input->post('tmtpensiun');
        $KD='S';

        $STATUS = 0;
        $CKOJABF = ' ';
        $USER_ID = $data['user_id'];
       
        $term=$this->input->ip_address();
        if($term == '0.0.0.0') {
            $ip = explode(',', $_SERVER['REMOTE_ADDR']);
            $term = $ip[0];
        }

        $cekTmt="SELECT * FROM(

                SELECT TO_CHAR(A.TMT, 'DD-MM-YYYY')TMT FROM PERS_JABATAN_HIST A WHERE A.NRK='".$NRK."'
                UNION
                SELECT TO_CHAR(B.TMT,'DD-MM-YYYY')TMT FROM PERS_JABATANF_HIST B WHERE B.NRK='".$NRK."'
                )";
                
        $queryCekTMT = $this->db->query($cekTmt);

        $count=0;

        foreach ($queryCekTMT->result() as $row) 
        {
            //var_dump($TMT);
            $tempTMT = date('d-m-Y',strtotime($row->TMT));
            $inputTMT = date('d-m-Y', strtotime($TMT));
            $countTMT = 0;
            if($tempTMT == $TMT)
            {
                $count++;
            }
            
        }            
        
        if($count == 0)
        {
            $sql = "INSERT INTO PERS_JABATAN_HIST(NRK,TMT,KOLOK,KOJAB,KDSORT,TGAKHIR,KOPANG,ESELON,PEJTT,NOSK,TGSK,KREDIT,STATUS,USER_ID,TERM,TG_UPD,CKOJABF,KLOGAD,SPMU,TMTPENSIUN,JENIS_SK) 
                VALUES ('".$NRK."',TO_DATE('".$TMT."', 'DD-MM-YYYY'),'".$KOLOK."','".$KOJAB."','".$KDSORT."',TO_DATE('".$TGAKHIR."', 'DD-MM-YY'),'".$KOPANG."','".$ESELON."',".$PEJTT.",UPPER(
                  '".$NOSK."'),TO_DATE('".$TGSK."', 'DD-MM-YYYY'),".$KREDIT.",".$STATUS.",'".$USER_ID."','".$term."', SYSDATE,'".$CKOJABF."','".$KLOGAD."','".$SPMU."',TO_DATE('".$TMTPENSIUN."', 'DD-MM-YYYY'),'".$JENSK."')
            "; 

            $idx = $this->db->query($sql);

            if($idx){
                $peg['kd']=$KD;
                $peg['kolok'] = $KOLOK;
                $peg['kojab'] = $KOJAB;
                $peg['klogad'] = $KLOGAD;
                $peg['tmt'] = $TMT;
                $peg['user_id'] = $USER_ID;
                $peg['term'] =$term;
                
                $this->updatePegawai1($NRK, $peg);

                if($KLOGAD == '111111112' || $KLOGAD == '111111113' || $KLOGAD == '111111114'  || $KLOGAD == '111111118')
                {
                    $up['tmt'] = $TMT;
                    $up['klogad'] = $KLOGAD;
                    $this->updatePeg1PensiunMati($NRK,$up);
                   
                }
            }
            $id ='SUCCESS';
        }
        else
        {
            $id = 'FAILED';
        }

        return $id;
    }

    public function update_jabStruk($data)
    {            
        $NRK = $this->input->post('nrk');
        $TMT = $this->input->post('tmt');
        $KOLOK_PK = $this->input->post('kolok_pk');
        $KOJAB_PK = $this->input->post('kojab_pk');

        $KOLOK = $this->input->post('kolok');
        $KOJAB = $this->input->post('kojab');
        $KLOGAD = $this->input->post('klogad');
        $SPMU = $this->input->post('spmu');
        $KDSORT = '0';
        $TGAKHIR = $this->input->post('tgakhir');
        $KOPANG = $this->input->post('kopang');
        $ESELON = $this->input->post('eselon');
        $PEJTT = $this->input->post('pejtt');
        $JENSK = $this->input->post('jensk');
        $NOSK = $this->input->post('nosk');
        $TGSK = $this->input->post('tgsk');
        $KREDIT = $this->input->post('kredit');
        if($KREDIT=='')
        {
            $KREDIT = 0;
        }
        $TMTPENSIUN = $this->input->post('tmtpensiun');
        $STATUS = 0;
        $CKOJABF = ' ';
        $USER_ID = $data['user_id'];
        
        $term=$this->input->ip_address();
        if($term == '0.0.0.0') {
            $ip = explode(',', $_SERVER['REMOTE_ADDR']);
            $term = $ip[0];
        }
        $KD='S';    
      
        $sql = "UPDATE PERS_JABATAN_HIST 
                SET 
                    KDSORT = '".$KDSORT."',  TGAKHIR = TO_DATE('".$TGAKHIR."', 'DD-MM-YY'),  
                    KOPANG = '".$KOPANG."',  
                    KOLOK = '".$KOLOK."',  
                    KOJAB = '".$KOJAB."',  
                    KLOGAD = '".$KLOGAD."',  SPMU = '".$SPMU."',
                    ESELON = '".$ESELON."',  PEJTT = '".$PEJTT."',
                    JENIS_SK = '".$JENSK."', 
                    NOSK = UPPER('".$NOSK."'), TGSK = TO_DATE('".$TGSK."', 'DD-MM-YYYY'), KREDIT = '".$KREDIT."', STATUS = '".$STATUS."', USER_ID = '".$USER_ID."', TERM = '".$term."',TG_UPD=SYSDATE,
                    CKOJABF = '".$CKOJABF."' 
                WHERE NRK = '".$NRK."' 
                AND TMT = TO_DATE('".$TMT."', 'DD-MM-YY') 
                AND KOLOK = '".$KOLOK_PK."' 
                AND KOJAB = '".$KOJAB_PK."'"; 
         // echo $sql;exit;       
        $id = $this->db->query($sql);

        if ($id){
            $peg['kd'] = $KD;
            $peg['kolok'] = $KOLOK;
            $peg['kojab'] = $KOJAB;
            $peg['klogad'] = $KLOGAD;
            $peg['user_id'] = $USER_ID;
            $peg['term'] =$term;
            $peg['tmt'] = $TMT;
            
            $this->updatePegawai1($NRK, $peg);

            if($KLOGAD == '111111112' || $KLOGAD == '111111113' || $KLOGAD == '111111114'  || $KLOGAD == '111111118')
            {
                $up['tmt'] = $TMT;
                $up['klogad'] = $KLOGAD;
                $this->updatePeg1PensiunMati($NRK,$up);
               
            }
        }

        return $id;
    }

    public function delete_flag_jabStruk($NRK,$TMT,$KOLOK,$KOJAB){     
               
        $sql = "UPDATE PERS_JABATAN_HIST SET DELETED='Y' WHERE NRK = '".$NRK."' AND TMT = TO_DATE('".$TMT."', 'DD-MM-YY') AND KOLOK = '".$KOLOK."' AND KOJAB = '".$KOJAB."'"; 
        // echo $sql;exit;
        $id = $this->db->query($sql);
        if ($id){
            $this->updateKolokKojab($NRK);    
        }
        return $id;
    }

    public function delete_jabStruk($NRK,$TMT,$KOLOK,$KOJAB){                
        $user_id       = $this->session->userdata('logged_in')['id'];
        $qi="INSERT INTO DEL_PERS_JABATAN_HIST A
            (
            SELECT 
                NRK,
                TMT,
                KOLOK,
                KOJAB,
                KDSORT,
                TGAKHIR,
                KOPANG,
                ESELON,
                PEJTT,
                NOSK,
                TGSK,
                KREDIT,
                STATUS,
                USER_ID,
                TERM,
                TG_UPD,
                CKOJABF,
                TMTPENSIUN,
                KLOGAD,
                SPMU,
                NESELON2,
                JENIS_SK,
                SYSDATE AS DELETE_DATE,
                '$user_id' AS DELETE_BY
            FROM PERS_JABATAN_HIST D
            WHERE D.NRK = '".$NRK."' AND D.TMT =TO_DATE('".$TMT."', 'DD-MM-YY') AND D.KOLOK = '".$KOLOK."' AND D.KOJAB = '".$KOJAB."'
            )";
        $rsi=$this->db->query($qi);

        $sql = "DELETE FROM PERS_JABATAN_HIST WHERE NRK = '".$NRK."' AND TMT = TO_DATE('".$TMT."', 'DD-MM-YY') AND KOLOK = '".$KOLOK."' AND KOJAB = '".$KOJAB."'"; 

        $id = $this->db->query($sql);
        if ($id){
            $this->updateKolokKojab($NRK);    
        }
        return $id;
    }
/*END JABATAN STRUKTURAL*/

/*START JABATAN FUNGSIONAL*/
    public function save_jabFgs($data)
    {    
        $NRK = $this->input->post('nrk');
        $TMT = $this->input->post('tmt');
        $KOLOK = $this->input->post('kolok');
        $KOJAB = $this->input->post('kojab');
        $KLOGAD = $this->input->post('klogad');
        $SPMU = $this->input->post('spmu');
        $KDSORT = '0';
        $TGAKHIR = $this->input->post('tgakhir');
        $KOPANG = $this->input->post('kopang');
        $PEJTT = $this->input->post('pejtt');
        $JENSK = $this->input->post('jensk');
        $NOSK = $this->input->post('nosk');
        $TGSK = $this->input->post('tgsk');
        $KREDIT = $this->input->post('kredit');
        $TMTPENSIUN = $this->input->post('tmtpensiun');
        $STATUS = 0;
        $USER_ID = $data['user_id'];
       
        $term=$this->input->ip_address();
        if($term == '0.0.0.0') {
            $ip = explode(',', $_SERVER['REMOTE_ADDR']);
            $term = $ip[0];
        }
        $KD='F';      

        $cekTmt="SELECT * FROM(

                SELECT TO_CHAR(A.TMT, 'DD-MM-YYYY')TMT FROM PERS_JABATAN_HIST A WHERE A.NRK='".$NRK."'
                UNION
                SELECT TO_CHAR(B.TMT,'DD-MM-YYYY')TMT FROM PERS_JABATANF_HIST B WHERE B.NRK='".$NRK."'
                )";
        $queryCekTMT = $this->db->query($cekTmt);

        $count=0;

        foreach ($queryCekTMT->result() as $row) 
        {
            //var_dump($TMT);
            $tempTMT = date('d-m-Y',strtotime($row->TMT));
            $inputTMT = date('d-m-Y', strtotime($TMT));
            $countTMT = 0;
            if($tempTMT == $TMT)
            {
                $count++;
            }
            
        }  

        if($count == 0)
        {
            $sql = "INSERT INTO PERS_JABATANF_HIST(NRK,TMT,KOLOK,KOJAB,KDSORT,TGAKHIR,KOPANG,PEJTT,NOSK,TGSK,KREDIT,STATUS,USER_ID,TERM,TG_UPD, KLOGAD, SPMU, TMTPENSIUN, JENIS_SK) 
                VALUES ('".$NRK."',TO_DATE('".$TMT."', 'DD-MM-YYYY'),'".$KOLOK."','".$KOJAB."','".$KDSORT."',TO_DATE('".$TGAKHIR."', 'DD-MM-YYYY'),'".$KOPANG."',".$PEJTT.",
                UPPER('".$NOSK."'),TO_DATE('".$TGSK."', 'DD-MM-YYYY'),".$KREDIT.",".$STATUS.",'".$USER_ID."','".$term."', SYSDATE, '".$KLOGAD."', '".$SPMU."',TO_DATE('".$TMTPENSIUN."', 'DD-MM-YYYY'),'".$JENSK."')"; 
            // echo $sql; exit;
            $idx = $this->db->query($sql);

            if($idx){
                $peg['kd'] = $KD;
                $peg['kolok'] = $KOLOK;
                $peg['kojab'] = $KOJAB;
                $peg['klogad'] = $KLOGAD;
                $peg['tmt'] = $TMT;
                $peg['user_id'] = $USER_ID;
                $peg['term'] =$term;
                $this->updatePegawai1($NRK, $peg);
            }
            $id="SUCCESS";
        }
        else
        {
            $id="FAILED";
        }
    
        

        return $id;
    }

    public function update_jabFgs($data)
    {            
        $NRK = $this->input->post('nrk');
        $TMT = $this->input->post('tmt');
        $KOJAB_PK = $this->input->post('kojab_pk');

        $KOLOK = $this->input->post('kolok');
        $KOJAB = $this->input->post('kojab');
        $KLOGAD = $this->input->post('klogad');
        $SPMU = $this->input->post('spmu');
        $KDSORT = '0';
        $TGAKHIR = $this->input->post('tgakhir');
        $KOPANG = $this->input->post('kopang');
        $PEJTT = $this->input->post('pejtt');
        $JENSK = $this->input->post('jensk');
        $NOSK = $this->input->post('nosk');
        $TGSK = $this->input->post('tgsk');
        $KREDIT = $this->input->post('kredit');
        $TMTPENSIUN = $this->input->post('tmtpensiun');
        $STATUS = 0;
        $USER_ID = $data['user_id'];

       
        $term=$this->input->ip_address();
        if($term == '0.0.0.0') {
            $ip = explode(',', $_SERVER['REMOTE_ADDR']);
            $term = $ip[0];
        }
        $KD='F';     
        
        $sql = "UPDATE PERS_JABATANF_HIST 
            SET KDSORT = '".$KDSORT."',  TGAKHIR = TO_DATE('".$TGAKHIR."', 'DD-MM-YY'),  
                KOPANG = '".$KOPANG."',  
                KOJAB = '".$KOJAB."',  
                PEJTT = '".$PEJTT."', KOLOK = '".$KOLOK."',
                NOSK = UPPER('".$NOSK."'), TGSK = TO_DATE('".$TGSK."', 'DD-MM-YYYY'), KREDIT = '".$KREDIT."', STATUS = '".$STATUS."', USER_ID = '".$USER_ID."', TERM = '".$term."', TG_UPD=SYSDATE, KLOGAD = '".$KLOGAD."', SPMU ='".$SPMU."', TMTPENSIUN = TO_DATE('".$TMTPENSIUN."', 'DD-MM-YYYY'),
                JENIS_SK = '".$JENSK."'
                WHERE NRK = '".$NRK."' 
                AND TMT = TO_DATE('".$TMT."', 'DD-MM-YY') 
                AND KOJAB = '".$KOJAB_PK."'"; 
        // echo $sql;exit;
        $id = $this->db->query($sql);

        if($id){
            $peg['kd'] = $KD;
            $peg['kolok'] = $KOLOK;
            $peg['kojab'] = $KOJAB;
            $peg['klogad'] = $KLOGAD;
            $peg['tmt'] = $TMT;
            $peg['user_id'] = $USER_ID;
            $peg['term'] =$term;
            $this->updatePegawai1($NRK, $peg);
        }

        return $id;
    }

    public function delete_flag_jabFgs($NRK,$TMT,$KOJAB){                
        $sql = "UPDATE PERS_JABATANF_HIST SET DELETED='Y' WHERE NRK = '".$NRK."' AND TMT = TO_DATE('".$TMT."', 'DD-MM-YY') AND KOJAB = '".$KOJAB."'"; 

        $id = $this->db->query($sql);
        if ($id){
            $this->updateKolokKojab($NRK);    
        }        
        return $id;
    }

    public function delete_jabFgs($NRK,$TMT,$KOJAB){                
        $user_id       = $this->session->userdata('logged_in')['id'];
        $qi="INSERT INTO DEL_PERS_JABATANF_HIST A
            (
            SELECT 
                NRK,
                TMT,
                KOLOK,
                KOJAB,
                KDSORT,
                TGAKHIR,
                KOPANG,
                PEJTT,
                NOSK,
                TGSK,
                KREDIT,
                STATUS,
                USER_ID,
                TERM,
                TG_UPD,
                TMTPENSIUN,
                SPMU,
                KLOGAD,
                JENIS_SK,
                SYSDATE AS DELETE_DATE,
                '$user_id' AS DELETE_BY
            FROM PERS_JABATANF_HIST D
            WHERE D.NRK = '".$NRK."' AND D.TMT = TO_DATE('".$TMT."', 'DD-MM-YY') AND D.KOJAB = '".$KOJAB."'
            )";
        $rsi=$this->db->query($qi);

        $sql = "DELETE FROM PERS_JABATANF_HIST WHERE NRK = '".$NRK."' AND TMT = TO_DATE('".$TMT."', 'DD-MM-YY') AND KOJAB = '".$KOJAB."'"; 

        $id = $this->db->query($sql);
        if ($id){
            $this->updateKolokKojab($NRK);    
        }        
        return $id;
    }
/*END JABATAN FUNGSIONAL*/

/*START PENDIDIKAN FORMAL*/

    function getDataPendidikan($id1,$id2,$id3)
    {
        $sql = "SELECT * FROM PERS_PENDIDIKAN WHERE NRK ='".$id1."' AND JENDIK = ".$id2." AND KODIK = '".$id3."'";

        $query = $this->db->query($sql)->row();            

        return $query;
    }

    public function save_pdFormal($data)
    {    
        $NRK = $this->input->post('nrk');
        $JENDIK = $this->input->post('jendik');
        $KODIK = $this->input->post('kodik');
        
        $NASEK = $this->input->post('nasek');
        if($NASEK == null)
        {
            $NASEK=' ';
        }
        $UNIVER = $this->input->post('univer');
        if($UNIVER == null)
        {
            $UNIVER='00000';
        }
        $KOTSEK = $this->input->post('kotsek');
        $TGIJAZAH = $this->input->post('tgijazah');
        $NOIJAZAH = $this->input->post('noijazah');
        $TGSTLU = $this->input->post('tgstlu');
        $NOSTLU = $this->input->post('nostlu');

        if($TGSTLU != null && $NOSTLU !=null)
        {
            $KDSTLU = 'Y';
        }
        else
        {
            $KDSTLU = 'N';
        }
        //$TGACCKOP = $this->input->post('tgacckop');
        $TGACCKOP = '';
        //$NOACCKOP = $this->input->post('noacckop');
        $NOACCKOP = '';
        //$TGMULAI = $this->input->post('tgmulai');
        $TGMULAI = '';
        //$TGAKHIR = $this->input->post('tgakhir');
        $TGAKHIR = '';
        /*$JUMJAM = $this->input->post('jumjam');
        if($JUMJAM==null)
        {
            $JUMJAM = 0;
        }*/
        $JUMJAM = 0;    
        //$SELENGGARA = $this->input->post('selenggara');
        $SELENGGARA = '';
        //$ANGKATAN = $this->input->post('angkatan');
        $ANGKATAN = '';
        $TITEL = $this->input->post('titel');
        $TITELDEPAN = $this->input->post('titeldepan');
        $USER_ID = $data['user_id'];
        $STAT = $this->input->post('stat_app');
      
        $term = $this->input->ip_address();
        if($term == '0.0.0.0') {
            $ip = explode(',', $_SERVER['REMOTE_ADDR']);
            $term = $ip[0];
        }

        if(substr($KODIK,0,1) == '0' || substr($KODIK,0,1) == '1' || substr($KODIK,0,1) == '2' || substr($KODIK,0,1) == '4')
        {
            $KDSTLU = 'N';
            $TGSTLU = '';
            $NOSTLU = '';
        }

        $cek=$this->getDataPendidikan($NRK,$JENDIK,$KODIK);
        if($cek!=null)
        {
            $id=false;
        }
        else if($cek==null)
        {
            //$sql = "INSERT INTO PERS_PENDIDIKAN(NRK,JENDIK,KODIK,NASEK,UNIVER,KOTSEK,TGIJAZAH,NOIJAZAH,TGACCKOP,NOACCKOP,TGMULAI,TGAKHIR,JUMJAM,SELENGGARA,USER_ID,TERM,TG_UPD,ANGKATAN,TITELDEPAN,TITELBELAKANG,STAT_APP) VALUES ('".$NRK."',".$JENDIK.",'".$KODIK."','".$NASEK."','".$UNIVER."',UPPER('".$KOTSEK."'),TO_DATE('".$TGIJAZAH."', 'DD-MM-YYYY'),UPPER('".$NOIJAZAH."'),TO_DATE('".$TGACCKOP."', 'DD-MM-YYYY'),UPPER('".$NOACCKOP."'),TO_DATE('".$TGMULAI."', 'DD-MM-YYYY'),TO_DATE('".$TGAKHIR."', 'DD-MM-YYYY'),".$JUMJAM.",'".$SELENGGARA."','".$USER_ID."','".$term."', SYSDATE,'".$ANGKATAN."','".$TITELDEPAN."','".$TITEL."','".$STAT."')"; 

             $sql = "INSERT INTO PERS_PENDIDIKAN(NRK,JENDIK,KODIK,NASEK,UNIVER,KOTSEK,TGIJAZAH,NOIJAZAH,TGACCKOP,NOACCKOP,TGMULAI,TGAKHIR,JUMJAM,SELENGGARA,USER_ID,TERM,TG_UPD,ANGKATAN,TITELDEPAN,TITELBELAKANG,STAT_APP,KD_STLU,TG_STLU,NO_STLU) VALUES ('".$NRK."',".$JENDIK.",'".$KODIK."','".$NASEK."','".$UNIVER."',UPPER('".$KOTSEK."'),TO_DATE('".$TGIJAZAH."', 'DD-MM-YYYY'),UPPER('".$NOIJAZAH."'),TO_DATE('".$TGACCKOP."', 'DD-MM-YYYY'),UPPER('".$NOACCKOP."'),TO_DATE('".$TGMULAI."', 'DD-MM-YYYY'),TO_DATE('".$TGAKHIR."', 'DD-MM-YYYY'),".$JUMJAM.",'".$SELENGGARA."','".$USER_ID."','".$term."', SYSDATE,'".$ANGKATAN."','".$TITELDEPAN."','".$TITEL."','".$STAT."','$KDSTLU',TO_DATE('".$TGSTLU."', 'DD-MM-YYYY'),UPPER('".$NOSTLU."'))"; 
            $id = $this->db->query($sql);

            if($id){
                if($STAT==1)
                {
                    if($TITEL != null || $TITELDEPAN != null)
                    {
                        $peg['titeldepan'] = $TITELDEPAN;
                        $peg['titel'] = $TITEL;
            
                        $this->updateTitelPegawai($NRK, $peg);      
                    }
                    
                    
                }
            
            }

        }
     
        return $id;
    }

    public function update_pdFormal($data)
    {    
        $NRK = $this->input->post('nrk');
        $JENDIK = $this->input->post('jendik');
        $KODIK = $this->input->post('kodik');
        $UNIVER = $this->input->post('univer');
        
        if($UNIVER == null)
        {
            $UNIVER='00000';
            $NASEK = $this->input->post('nasek');
        }

        if($UNIVER == '00000')
        {
            $NASEK = $this->input->post('nasek');
        }
        else
        {
            $NASEK=' ';            
        }
        
        
        $KOTSEK = $this->input->post('kotsek');
        $TGIJAZAH = $this->input->post('tgijazah');
        if($TGIJAZAH !=null)
        {
            $TI=date('d-M-y',strtotime($TGIJAZAH)); 
        }
        else
        {
            $TI = $TGIJAZAH;
        }

        $NOIJAZAH = $this->input->post('noijazah');

        $TGSTLU = $this->input->post('tgstlu');
        $NOSTLU = $this->input->post('nostlu');



        if($TGSTLU !=null)
        {
            $TS=date('d-M-y',strtotime($TGSTLU)); 
        }
        else
        {
            $TS = $TGSTLU;
        }

        if($TGSTLU != null && $NOSTLU !=null)
        {
            $KDSTLU = 'Y';
        }
        else
        {
            $KDSTLU = 'N';
        }

        if(substr($KODIK,0,1) == '0' || substr($KODIK,0,1) == '1' || substr($KODIK,0,1) == '2' || substr($KODIK,0,1) == '4')
        {
            $KDSTLU = 'N';
            $TGSTLU = '';
            $NOSTLU = '';
        }

        //$TGACCKOP = $this->input->post('tgacckop');
        $TGACCKOP = '';
        if($TGACCKOP !=null)
        {
            $TAK=date('d-M-y',strtotime($TGACCKOP));    
        }
        else
        {
            $TAK = $TGACCKOP;
        }
        //$NOACCKOP = $this->input->post('noacckop');
        $NOACCKOP = '';
        //$TGMULAI = $this->input->post('tgmulai');
        $TGMULAI = '';
        if($TGMULAI !=null)
        {
            $TM=date('d-M-y',strtotime($TGMULAI));  
        }
        else
        {
            $TM = $TGMULAI;
        }
        //$TGAKHIR = $this->input->post('tgakhir');

        $TGAKHIR = '';
        if($TGAKHIR !=null)
        {
            $TA=date('d-M-y',strtotime($TGAKHIR));  
        }
        else
        {
            $TA = $TGAKHIR;
        }
        /*$JUMJAM = $this->input->post('jumjam');
        if($JUMJAM==null)
        {
            $JUMJAM = 0;
        }*/
        $JUMJAM = 0;    
        //$SELENGGARA = $this->input->post('selenggara');
        $SELENGGARA = '';
        //$ANGKATAN = $this->input->post('angkatan');
        $ANGKATAN = '';
        $TITEL = $this->input->post('titel');
        $TITELDEPAN = $this->input->post('titeldepan');
        $USER_ID = $data['user_id'];
        $STAT=$this->input->post('stat_app');
        $term = $this->input->ip_address();
        if($term == '0.0.0.0') {
            $ip = explode(',', $_SERVER['REMOTE_ADDR']);
            $term = $ip[0];
        }

        $cek="SELECT * FROM PERS_PENDIDIKAN WHERE NRK = '".$NRK."' AND JENDIK = '".$JENDIK."' AND KODIK = '".$KODIK."'";
        $exCek = $this->db->query($cek)->row();

        if($exCek->TGIJAZAH !=null)
        {
            $DBTI = date('d-M-y',strtotime($exCek->TGIJAZAH));  
        }
        else
        {
            $DBTI = $exCek->TGIJAZAH;
        }
        
        if($exCek->TGACCKOP !=null)
        {
            $DBTAK = date('d-M-y',strtotime($exCek->TGACCKOP)); 
        }
        else
        {
            $DBTAK = $exCek->TGACCKOP;
        }        
   
        if($exCek->TGMULAI !=null)
        {
            $DBTM = date('d-M-y',strtotime($exCek->TGMULAI));   
        }
        else
        {
            $DBTM = $exCek->TGMULAI;
        }
            
        if($exCek->TGAKHIR !=null)
        {
            $DBTA = date('d-M-y',strtotime($exCek->TGAKHIR));   
        }
        else
        {
            $DBTA = $exCek->TGAKHIR;
        }

        if($exCek->TG_STLU !=null)
        {
            $DBTS = date('d-M-y',strtotime($exCek->TG_STLU));   
        }
        else
        {
            $DBTS = $exCek->TG_STLU;
        }

        if(//tidak ada perubahan
                
                $exCek->UNIVER == $UNIVER 
                && $exCek->NASEK == $NASEK 
                && $exCek->KOTSEK == $KOTSEK
                && $DBTI == $TI 
                && $exCek->NOIJAZAH == $NOIJAZAH 
                && $DBTAK == $TAK 
                && $exCek->NOACCKOP == $NOACCKOP 
                && $DBTM == $TM 
                && $DBTA == $TA 
                && $exCek->NO_STLU == $NOSTLU 
                && $DBTS == $TS 
                && $exCek->JUMJAM == $JUMJAM 
                && $exCek->SELENGGARA == $SELENGGARA 
                && $exCek->ANGKATAN == $ANGKATAN  
                && $exCek->TITELBELAKANG == $TITEL 
                && $exCek->TITELDEPAN == $TITELDEPAN 
           ) 
        {
            if($exCek->STAT_APP == 1 && $STAT == 2)
            {
                $STAT=1;
            }

            $sql = "UPDATE PERS_PENDIDIKAN SET NASEK = '".$NASEK."', UNIVER = '".$UNIVER."', KOTSEK = UPPER('".$KOTSEK."'), TGIJAZAH = TO_DATE('".$TGIJAZAH."', 'DD-MM-YYYY'), NOIJAZAH = UPPER('".$NOIJAZAH."'), 
                TGACCKOP = TO_DATE('".$TGACCKOP."', 'DD-MM-YYYY'),  NOACCKOP = UPPER('".$NOACCKOP."'), TGMULAI = TO_DATE('".$TGMULAI."', 'DD-MM-YYYY'), TGAKHIR = TO_DATE('".$TGAKHIR."', 'DD-MM-YYYY'), KD_STLU = '$KDSTLU', TG_STLU = TO_DATE('".$TGSTLU."', 'DD-MM-YYYY'), NO_STLU = '$NOSTLU',
                JUMJAM = '".$JUMJAM."', SELENGGARA = '".$SELENGGARA."', USER_ID = '".$USER_ID."', TERM = '".$term."', TG_UPD = SYSDATE, ANGKATAN = '".$ANGKATAN."',TITELDEPAN='".$TITELDEPAN."',TITELBELAKANG='".$TITEL."',STAT_APP = '".$STAT."'
                WHERE NRK = '".$NRK."' AND JENDIK = '".$JENDIK."' AND KODIK = '".$KODIK."'";    
        }
        else
        {
            $sql = "UPDATE PERS_PENDIDIKAN SET NASEK = '".$NASEK."', UNIVER = '".$UNIVER."', KOTSEK = UPPER('".$KOTSEK."'), TGIJAZAH = TO_DATE('".$TGIJAZAH."', 'DD-MM-YYYY'), NOIJAZAH = UPPER('".$NOIJAZAH."'), 
                TGACCKOP = TO_DATE('".$TGACCKOP."', 'DD-MM-YYYY'),  NOACCKOP = UPPER('".$NOACCKOP."'), TGMULAI = TO_DATE('".$TGMULAI."', 'DD-MM-YYYY'), TGAKHIR = TO_DATE('".$TGAKHIR."', 'DD-MM-YYYY'), KD_STLU = '$KDSTLU', TG_STLU = TO_DATE('".$TGSTLU."', 'DD-MM-YYYY'), NO_STLU = '$NOSTLU',
                JUMJAM = '".$JUMJAM."', SELENGGARA = '".$SELENGGARA."', USER_ID = '".$USER_ID."', TERM = '".$term."', TG_UPD = SYSDATE, ANGKATAN = '".$ANGKATAN."',TITELDEPAN='".$TITELDEPAN."',TITELBELAKANG='".$TITEL."',STAT_APP = '".$STAT."'
                WHERE NRK = '".$NRK."' AND JENDIK = '".$JENDIK."' AND KODIK = '".$KODIK."'"; 
        }
     
        $id = $this->db->query($sql);
        if($id){
            if($STAT == 1)
            {
                if($TITEL != null || $TITELDEPAN != null)
                    {
                        $peg['titeldepan'] = $TITELDEPAN;
                        $peg['titel'] = $TITEL;
            
                        $this->updateTitelPegawai($NRK, $peg);      
                    }
            }
            
        }
        return $id;
    }

    public function delete_flag_pdFormal($NRK,$JENDIK,$KODIK){ 
        $cek = "SELECT TITELDEPAN,TITELBELAKANG FROM PERS_PENDIDIKAN WHERE NRK='".$NRK."' AND JENDIK='".$JENDIK."' AND KODIK='".$KODIK."' AND DELETED IS NULL";
        $execek = $this->db->query($cek)->row();

        $td = $execek->TITELDEPAN;
        $tb = $execek->TITELBELAKANG;


        $sql = "UPDATE PERS_PENDIDIKAN SET DELETED='Y' WHERE NRK = '".$NRK."' AND JENDIK = '".$JENDIK."' AND KODIK = '".$KODIK."'"; 

        if($td==null && $tb==null)
        {
            $id = $this->db->query($sql);
        }
        else if($td != null || $tb !=null)
        {
            $titeldepan="";
            $titelbelakang="";

            $peg['titeldepan'] = $titeldepan;
            $peg['titel'] = $titelbelakang;
            $peg['kodik'] = $KODIK;

            $this->deleteTitelPegawai($NRK, $peg);
            $id = $this->db->query($sql);
        }
    
        return $id;
    }

    public function delete_pdFormal($NRK,$JENDIK,$KODIK){ 
        $cek = "SELECT TITELDEPAN,TITELBELAKANG FROM PERS_PENDIDIKAN WHERE NRK='".$NRK."' AND JENDIK='".$JENDIK."' AND KODIK='".$KODIK."'";
        $execek = $this->db->query($cek)->row();

        $td = $execek->TITELDEPAN;
        $tb = $execek->TITELBELAKANG;

        $user_id       = $this->session->userdata('logged_in')['id'];
        $qi="INSERT INTO DEL_PERS_PENDIDIKAN A
            (
            SELECT 
                NRK,
                JENDIK,
                KODIK,
                NASEK,
                UNIVER,
                KOTSEK,
                TGIJAZAH,
                NOIJAZAH,
                TGACCKOP,
                NOACCKOP,
                TGMULAI,
                TGAKHIR,
                JUMJAM,
                SELENGGARA,
                USER_ID,
                TERM,
                TG_UPD,
                ANGKATAN,
                TITELBELAKANG,
                TITELDEPAN,
                STAT_APP,
                FLAG_CPS,
                SYSDATE AS DELETE_DATE,
                '$user_id' AS DELETE_BY
            FROM PERS_PENDIDIKAN D
            WHERE D.NRK = '".$NRK."' AND D.JENDIK = '".$JENDIK."' AND D.KODIK = '".$KODIK."'
            )";
        $rsi=$this->db->query($qi);

        $sql = "DELETE FROM PERS_PENDIDIKAN WHERE NRK = '".$NRK."' AND JENDIK = '".$JENDIK."' AND KODIK = '".$KODIK."'"; 

        if($td==null && $tb==null)
        {
            $id = $this->db->query($sql);
        }
        else if($td != null || $tb !=null)
        {
            $titeldepan="";
            $titelbelakang="";

            $peg['titeldepan'] = $titeldepan;
            $peg['titel'] = $titelbelakang;
            $peg['kodik'] = $KODIK;

            $this->deleteTitelPegawai($NRK, $peg);
            $id = $this->db->query($sql);
        }
    
        return $id;
    }
/*END PENDIDIKAN FORMAL*/

/*START PENDIDIKAN NON FORMAL*/
    public function save_pdNonFormal($data)
    {    
        $NRK = $this->input->post('nrk');
        $JENDIK = $this->input->post('jendik');
        $KODIK = $this->input->post('kodik');
        $NASEK = $this->input->post('nasek');
        $UNIVER = '00000';
        $KOTSEK = $this->input->post('kotsek');
        $TGIJAZAH = $this->input->post('tgijazah');
        $NOIJAZAH = $this->input->post('noijazah');
        $TGACCKOP = '';
        $NOACCKOP = '';
        $TGMULAI = $this->input->post('tgmulai');
        $TGAKHIR = $this->input->post('tgakhir');
        $JUMJAM = $this->input->post('jumjam');
        if($JUMJAM==null)
        {
            $JUMJAM = 0;
        }   
        $SELENGGARA = $this->input->post('selenggara');
/*
        $TMTMULAI_STOPTKD = $this->input->post('mulaistoptkd');
        $TMTAKHIR_STOPTKD = $this->input->post('akhirstoptkd');
        $JMLBLN_STOPTKD = ($this->input->post('blnstoptkd')=="")?0:$this->input->post('blnstoptkd');
        $KET = $this->input->post('ket');*/

        /*$ang1 = $this->input->post('ang1');
        $ang2 = $this->input->post('ang2');
        $ANGKATAN = $ang1."/".$ang2;*/

        $ANGKATAN = $this->input->post('angkatan');
        $STAT= $this->input->post('stat_app');
        $USER_ID = $data['user_id'];
      
        $term = $this->input->ip_address();
        if($term == '0.0.0.0') {
            $ip = explode(',', $_SERVER['REMOTE_ADDR']);
            $term = $ip[0];
        }
        
        $cek=$this->getDataPendidikan($NRK,$JENDIK,$KODIK);

        
        if($cek!=null)
        {
            $id=false;
        }
        else if($cek == null)
        {
            $sql = "INSERT INTO PERS_PENDIDIKAN(NRK,JENDIK,KODIK,NASEK,UNIVER,KOTSEK,TGIJAZAH,NOIJAZAH,TGACCKOP,NOACCKOP,TGMULAI,TGAKHIR,JUMJAM,SELENGGARA,
                USER_ID,TERM,TG_UPD,ANGKATAN,STAT_APP) 
                VALUES ('".$NRK."',".$JENDIK.",'".$KODIK."','".$NASEK."','".$UNIVER."',UPPER('".$KOTSEK."'),TO_DATE('".$TGIJAZAH."', 'DD-MM-YYYY'),UPPER('".$NOIJAZAH."'),
                TO_DATE('".$TGACCKOP."', 'DD-MM-YYYY'),UPPER('".$NOACCKOP."'),TO_DATE('".$TGMULAI."', 'DD-MM-YYYY'),TO_DATE('".$TGAKHIR."', 'DD-MM-YYYY'),".$JUMJAM.",UPPER('".$SELENGGARA."'),
               
                '".$USER_ID."','".$term."', SYSDATE,UPPER('".$ANGKATAN."'),'".$STAT."')"; 
            
            $id = $this->db->query($sql);
        }
        
        return $id;
    }

    public function update_pdNonFormal($data)
    {    
        $NRK = $this->input->post('nrk');
        $JENDIK = $this->input->post('jendik');
        $KODIK = $this->input->post('kodik');
        $NASEK = $this->input->post('nasek');
        $UNIVER = '00000';
        $KOTSEK = $this->input->post('kotsek');
        $TGIJAZAH = $this->input->post('tgijazah');
        if($TGIJAZAH !=null)
        {
            $TI=date('d-M-y',strtotime($TGIJAZAH)); 
        }
        else
        {
            $TI = $TGIJAZAH;
        }
        $NOIJAZAH = $this->input->post('noijazah');
        $TGACCKOP = '';
        if($TGACCKOP !=null)
        {
            $TAK=date('d-M-y',strtotime($TGACCKOP));    
        }
        else
        {
            $TAK = $TGACCKOP;
        }
        $NOACCKOP = '';
        $TGMULAI = $this->input->post('tgmulai');
        if($TGMULAI !=null)
        {
            $TM=date('d-M-y',strtotime($TGMULAI));  
        }
        else
        {
            $TM = $TGMULAI;
        }
        $TGAKHIR = $this->input->post('tgakhir');
        if($TGAKHIR !=null)
        {
            $TA=date('d-M-y',strtotime($TGAKHIR));  
        }
        else
        {
            $TA = $TGAKHIR;
        }
        $JUMJAM = $this->input->post('jumjam');
        if($JUMJAM==null)
        {
            $JUMJAM = 0;
        }   
        $SELENGGARA = $this->input->post('selenggara');

        /*$TMTMULAI_STOPTKD = $this->input->post('mulaistoptkd');
        $TMTAKHIR_STOPTKD = $this->input->post('akhirstoptkd');
        $JMLBLN_STOPTKD = $this->input->post('blnstoptkd');
        $KET = $this->input->post('ket');*/
        /*$ang1 = $this->input->post('ang1');
        $ang2 = $this->input->post('ang2');
        $ANGKATAN = $ang1."/".$ang2;*/

        $ANGKATAN = $this->input->post('angkatan');
        $USER_ID = $data['user_id'];
       
        $term = $this->input->ip_address();
        if($term == '0.0.0.0') {
            $ip = explode(',', $_SERVER['REMOTE_ADDR']);
            $term = $ip[0];
        }
        $STAT = $this->input->post('stat_app');

        $cek="SELECT * FROM PERS_PENDIDIKAN WHERE NRK = '".$NRK."' AND JENDIK = '".$JENDIK."' AND KODIK = '".$KODIK."'";
        $exCek = $this->db->query($cek)->row();

        if($exCek->TGIJAZAH !=null)
        {
            $DBTI = date('d-M-y',strtotime($exCek->TGIJAZAH));  
        }
        else
        {
            $DBTI = $exCek->TGIJAZAH;
        }
        
        if($exCek->TGACCKOP !=null)
        {
            $DBTAK = date('d-M-y',strtotime($exCek->TGACCKOP)); 
        }
        else
        {
            $DBTAK = $exCek->TGACCKOP;
        }        
   
        if($exCek->TGMULAI !=null)
        {
            $DBTM = date('d-M-y',strtotime($exCek->TGMULAI));   
        }
        else
        {
            $DBTM = $exCek->TGMULAI;
        }
            
        if($exCek->TGAKHIR !=null)
        {
            $DBTA = date('d-M-y',strtotime($exCek->TGAKHIR));   
        }
        else
        {
            $DBTA = $exCek->TGAKHIR;
        }

        if(//tidak ada perubahan
                
                $exCek->UNIVER == $UNIVER 
                && $exCek->NASEK == $NASEK 
                && $exCek->KOTSEK == $KOTSEK
                && $DBTI == $TI 
                && $exCek->NOIJAZAH == $NOIJAZAH 
                && $DBTAK == $TAK 
                && $exCek->NOACCKOP == $NOACCKOP 
                && $DBTM == $TM 
                && $DBTA == $TA 
                && $exCek->JUMJAM == $JUMJAM 
                && $exCek->SELENGGARA == $SELENGGARA 
                && $exCek->ANGKATAN == $ANGKATAN  
                
           ) 
        {
            if($exCek->STAT_APP == 1 && $STAT == 2)
            {
                $STAT=1;
            }
            $sql = "UPDATE PERS_PENDIDIKAN SET NASEK = '".$NASEK."', UNIVER = '".$UNIVER."', KOTSEK = UPPER('".$KOTSEK."'), TGIJAZAH = TO_DATE('".$TGIJAZAH."', 'DD-MM-YYYY'), NOIJAZAH = UPPER('".$NOIJAZAH."'), 
                            TGACCKOP = TO_DATE('".$TGACCKOP."', 'DD-MM-YYYY'),  NOACCKOP = UPPER('".$NOACCKOP."'), TGMULAI = TO_DATE('".$TGMULAI."', 'DD-MM-YYYY'), TGAKHIR = TO_DATE('".$TGAKHIR."', 'DD-MM-YYYY'), 
                            JUMJAM = '".$JUMJAM."', SELENGGARA = UPPER('".$SELENGGARA."'), 
                            USER_ID = '".$USER_ID."', TERM = '".$term."', TG_UPD=SYSDATE, ANGKATAN = UPPER('".$ANGKATAN."'), STAT_APP = '".$STAT."'
                            WHERE NRK = '".$NRK."' AND JENDIK = '".$JENDIK."' AND KODIK = '".$KODIK."'";         
        }
        else
        {
            $sql = "UPDATE PERS_PENDIDIKAN SET NASEK = '".$NASEK."', UNIVER = '".$UNIVER."', KOTSEK = UPPER('".$KOTSEK."'), TGIJAZAH = TO_DATE('".$TGIJAZAH."', 'DD-MM-YYYY'), NOIJAZAH = UPPER('".$NOIJAZAH."'), 
                            TGACCKOP = TO_DATE('".$TGACCKOP."', 'DD-MM-YYYY'),  NOACCKOP = UPPER('".$NOACCKOP."'), TGMULAI = TO_DATE('".$TGMULAI."', 'DD-MM-YYYY'), TGAKHIR = TO_DATE('".$TGAKHIR."', 'DD-MM-YYYY'), 
                            JUMJAM = '".$JUMJAM."', SELENGGARA = UPPER('".$SELENGGARA."'), USER_ID = '".$USER_ID."', TERM = '".$term."', TG_UPD=SYSDATE, ANGKATAN = UPPER('".$ANGKATAN."'), STAT_APP = '".$STAT."'
                            WHERE NRK = '".$NRK."' AND JENDIK = '".$JENDIK."' AND KODIK = '".$KODIK."'";    
        }
    
        
        
        $id = $this->db->query($sql);
        return $id;
    }

    public function delete_flag_pdNonFormal($NRK,$JENDIK,$KODIK){                
        $sql = "UPDATE PERS_PENDIDIKAN SET DELETED='Y' WHERE NRK = '".$NRK."' AND JENDIK = '".$JENDIK."' AND KODIK = '".$KODIK."'"; 

        $id = $this->db->query($sql);
        return $id;
    }

    public function delete_pdNonFormal($NRK,$JENDIK,$KODIK){                
        $user_id       = $this->session->userdata('logged_in')['id'];
        $qi="INSERT INTO DEL_PERS_PENDIDIKAN A
            (
            SELECT 
                NRK,
                JENDIK,
                KODIK,
                NASEK,
                UNIVER,
                KOTSEK,
                TGIJAZAH,
                NOIJAZAH,
                TGACCKOP,
                NOACCKOP,
                TGMULAI,
                TGAKHIR,
                JUMJAM,
                SELENGGARA,
                USER_ID,
                TERM,
                TG_UPD,
                ANGKATAN,
                TITELBELAKANG,
                TITELDEPAN,
                STAT_APP,
                FLAG_CPS,
                SYSDATE AS DELETE_DATE,
                '$user_id' AS DELETE_BY
            FROM PERS_PENDIDIKAN D
            WHERE D.NRK = '".$NRK."' AND D.JENDIK = '".$JENDIK."' AND D.KODIK = '".$KODIK."'
            )";
        $rsi=$this->db->query($qi);
        
        $sql = "DELETE FROM PERS_PENDIDIKAN WHERE NRK = '".$NRK."' AND JENDIK = '".$JENDIK."' AND KODIK = '".$KODIK."'"; 

        $id = $this->db->query($sql);
        return $id;
    }
/*END PENDIDIKAN NON FORMAL*/


/*START PANGKAT*/
    /*public function getMasaKerjaByKopang($kopang){
        $sql = "SELECT KOPANG, TTMASKER FROM PERS_GAPOK_TBL WHERE KOPANG = '".$kopang."' ORDER BY TTMASKER ASC";

         $query = $this->db->query($sql);   


         $option  = "<option value=''></option>";
        
        if($query->result() == null)
        {
            $option .= "<option value='0'>0</option>";       
        }
        else
        {
            foreach($query->result() as $row){    
             
             $option .= "<option value='".$row->TTMASKER."'>".$row->TTMASKER."</option>";
            }
        }
         
        
         return $option;
    }*/

    public function getMasker($nrk,$tmt,$year,$mon)
    {
        $sql="SELECT
                (TTMASKER + '".$year."' - TO_CHAR (TMT, 'YYYY')) AS TTMSKNOW,
                (BBMASKER + '".$mon."' - TO_CHAR (TMT, 'MM')) AS BBMSKNOW
               
             FROM
                PERS_PANGKAT_HIST
            WHERE
                TMT=(SELECT MAX(TMT) FROM PERS_PANGKAT_HIST WHERE NRK='".$nrk."')
            AND NRK='".$nrk."'";


        //$query = $this->db->query($sql)->row();
            $query = $this->db->query($sql);


        return $query; 
    }

    public function getMasaKerjaByKopang($kopang,$tahun){
        $sql = "SELECT KOPANG, TTMASKER FROM PERS_GAPOK_TBL_HIST WHERE KOPANG = '".$kopang."' AND TAHUN='".$tahun."' ORDER BY TTMASKER ASC";

         $query = $this->db->query($sql);   


         $option  = "<option value=''></option>";
        
        if($query->result() == null)
        {
            $option .= "<option value='0'>0</option>";       
        }
        else
        {
            foreach($query->result() as $row){    
             
             $option .= "<option value='".$row->TTMASKER."'>".$row->TTMASKER."</option>";
            }
        }
         
        
         return $option;
    }

    public function getGapokByKopang($tahun, $kopang, $ttmasker){
        $sql = "SELECT KOPANG, TTMASKER, BBMASKER, GAPOK FROM PERS_GAPOK_TBL_HIST WHERE TAHUN = '".$tahun."' AND KOPANG = '".$kopang."' AND TTMASKER = '".$ttmasker."'";
        
        $query = $this->db->query($sql)->row();
        
        return $query;
    }

    public function getMaxTtmasker($kopang)
    {
        $sql="SELECT MAX(TTMASKER) as MAXTTMASK FROM PERS_GAPOK_TBL WHERE KOPANG = '".$kopang."'";

        $query = $this->db->query($sql)->row();
        
        return $query->MAXTTMASK;
    }

    function getDataPangkatHist($id,$id2,$id3){
        $sql = "SELECT NRK FROM PERS_PANGKAT_HIST WHERE 
                NRK = '".$id."' AND 
                TMT = TO_DATE('".$id2."', 'DD-MM-YYYY') AND
                KOPANG = ".$id3." ";        

        $query = $this->db->query($sql);            
   
        return $query;
    }

    

     public function getDataPeg($id){
         //$q = "SELECT KOLOK, KLOGAD,SPMU FROM PERS_PEGAWAI1 WHERE NRK='$id'";
         $q = "SELECT KOLOK, KLOGAD,SPMU FROM PERS_PEGAWAI1 WHERE NRK='".$id."'";
         //$q = "SELECT KOLOK, KLOGAD,SPMU FROM \"vw_jabatan_terakhir\" WHERE NRK='".$id."'";
         $query = $this->db->query($q)->row();
         
         return $query;
     }

     public function getDataPeg1($id){
         //$q = "SELECT KOLOK, KLOGAD,SPMU FROM PERS_PEGAWAI1 WHERE NRK='$id'";
         //$q = "SELECT KOLOK, KLOGAD,SPMU FROM PERS_PEGAWAI1 WHERE NRK='".$id."'";
         $q = "SELECT KOLOK, KLOGAD,SPMU FROM PERS_PEGAWAI1 WHERE NRK='".$id."'";
         $query = $this->db->query($q)->row();
         
         return $query;
     }

    public function save_pangkat($data)
    {            

        $NRK = $this->input->post('nrk');
        $TMT = $this->input->post('tmt');
        $KOPANG = $this->input->post('kopang');
        $TTMASKER = $this->input->post('ttmasker');
        $BBMASKER = $this->input->post('bbmasker');
        $TTMASYAD = $this->input->post('ttmasyad');
        $BBMASYAD = $this->input->post('bbmasyad');
        $KOLOK = $this->input->post('kolok');
        $KLOGAD = $this->input->post('klogad');
        $SPMU = $this->input->post('spmu');
        $TEMPGAPOK = $this->input->post('gapok');
        $GAPOK = str_replace('.', '', $TEMPGAPOK);
        $PEJTT = $this->input->post('pejtt');
        $JENSK = $this->input->post('jensk');
        $NOSK = $this->input->post('nosk');
        $TGSK = $this->input->post('tgsk');
        $USER_ID = $data['user_id'];
       
        $term = $this->input->ip_address();
        if($term == '0.0.0.0') {
            $ip = explode(',', $_SERVER['REMOTE_ADDR']);
            $term = $ip[0];
        } 
        $TAHUN_REFGAJI = $this->input->post('tahun_refgaji');
        $JENRUB = $this->input->post('jenrub');

         $cek = $this->getDataPangkatHist($NRK, $TMT, $KOPANG)->num_rows();
         
        if($cek!=0)
        {
            $insert = false;
        }
        else
        {
           /* $cekData = "SELECT * FROM PERS_PANGKAT_HIST where NRK='".$NRK."' AND TMT=TO_DATE('".$TMT."','DD-MM-YYYY') AND KOPANG='".$KOPANG."'";
            $qc = $this->db->query($cekData);
            $nr= $qc->num_rows();

            if($nr == 0)
            {

            }*/

            $sql = "INSERT INTO PERS_PANGKAT_HIST(NRK,TMT,KOPANG,TTMASKER,BBMASKER,KOLOK,GAPOK,PEJTT,NOSK,TGSK,USER_ID,TERM,TG_UPD, KLOGAD, SPMU,TAHUN_REFGAJI,JENIS_SK,JENRUB) 
                VALUES ('".$NRK."',TO_DATE('".$TMT."', 'DD-MM-YYYY'),'".$KOPANG."',".$TTMASKER.",".$BBMASKER.",'".$KOLOK."',".$GAPOK.",".$PEJTT.",UPPER('".$NOSK."'),TO_DATE('".$TGSK."', 'DD-MM-YYYY'),'".$USER_ID."','".$term."', SYSDATE,'".$KLOGAD."','".$SPMU."','".$TAHUN_REFGAJI."','".$JENSK."',".$JENRUB.")"; 

            $insert = $this->db->query($sql);

            if($insert){
                $gpk['tmt'] = $TMT;
                $gpk['kopang'] = $KOPANG;
                $gpk['ttmasker'] = $TTMASKER;
                $gpk['bbmasker'] = $BBMASKER;
                $gpk['kolok'] = $KOLOK;
                $gpk['klogad'] = $KLOGAD;
                $gpk['spmu'] = $SPMU;
                $gpk['nosk'] = $NOSK;
                $gpk['tgsk'] = $TGSK;
                $gpk['gapok'] = $GAPOK;
                $gpk['user_id'] = $USER_ID;
                $gpk['term'] = $term;
            
                $gpk['ttmasyad'] = $TTMASYAD;
                $gpk['bbmasyad'] = $BBMASYAD;
                $gpk['jenrub'] = $JENRUB;
                $gpk['tahun_refgaji'] = $TAHUN_REFGAJI;
                $this->saveGapokFromPangkat($NRK, $TMT, $GAPOK, $gpk);
                $this->updateToPeg1($NRK,$KOLOK,$KLOGAD,$SPMU);

                if($JENRUB == '1')
                {
                    $this->updateToPeg1Muang($NRK, $TMT);
                }
               


                //Jika jenis perubahan 1=PENGANGKATAN PNS (100%) maka status pegawai jadi PNS
                if ($JENRUB == '12'){
                    $q1 = "UPDATE PERS_PEGAWAI1 SET STAPEG='2' WHERE NRK='$NRK'";
                    $this->db->query($q1);

                    $this->updateToPeg1TmtStapeg($NRK, $TMT);
                }
            }
        }
          
        
        return $insert;
    }

    public function cekStapegPegawai($nrk)
    {
        $sql =  "SELECT STAPEG FROM PERS_PEGAWAI1 WHERE NRK='$nrk'";
        $query = $this->db->query($sql);

        return $query;
    }

    public function saveGapokFromPangkat($nrk,$tmt,$gapok,$data)
    {
        $NRK = $nrk;
        $TMT = $tmt;
        $GAPOK = $gapok;


        $JENRUB = $data['jenrub'];
        $KOPANG = $data['kopang'];
        $TTMASKER = $data['ttmasker'];
        $BBMASKER = $data['bbmasker'];
        $KOLOK = $data['kolok'];
        $KLOGAD = $data['klogad'];
        $SPMU = $data['spmu'];
        $NOSK = $data['nosk'];
        $TGSK = $data['tgsk'];
        $TTMASYAD = $data['ttmasyad'];
        $BBMASYAD = $data['bbmasyad'];
        $USER_ID = $data['user_id'];
        
        $term = $data['term'];
        $TAHUN_REFGAJI = $data['tahun_refgaji'];

        $sql="SELECT NRK  FROM PERS_RB_GAPOK_HIST WHERE NRK='".$nrk."' AND TMT = TO_DATE('".$TMT."', 'DD-MM-YY') AND GAPOK=".$GAPOK." AND ROWNUM <1";
        $gpk = $this->db->query($sql);
        
            if ($gpk->num_rows() == 0) {
                
                $sql2 = "INSERT INTO PERS_RB_GAPOK_HIST(
                    NRK,TMT,GAPOK,JENRUB,KOPANG,TTMASKER,BBMASKER,KOLOK,NOSK,TGSK,TTMASYAD,BBMASYAD,USER_ID,TERM,TG_UPD,KLOGAD,SPMU,TAHUN_REFGAJI
                    ) VALUES (
                    '".$NRK."',TO_DATE('".$TMT."', 'DD-MM-YYYY'),".$GAPOK.",".$JENRUB.",'".$KOPANG."',".$TTMASKER.",".$BBMASKER.",'".$KOLOK."',UPPER('".$NOSK."'),TO_DATE('".$TGSK."', 'DD-MM-YYYY'),".$TTMASYAD.",".$BBMASYAD.",'".$USER_ID."','".$term."', SYSDATE,'".$KLOGAD."','".$SPMU."','".$TAHUN_REFGAJI."')"; 
                               //echo $sql2;exit;
                $id = $this->db->query($sql2);
                return $id;
            } 

        //ECHO $sql2;
    }

    public function updateGapokFromPangkat($nrk,$tmt,$gapok,$data)
    {
       
        $NRK = $nrk;
        $TMT = $data['tmt'];
        $GAPOK = $data['gapok'];
        $JENRUB = $data['jenrub'];
        $KOPANG = $data['kopang'];
        $TTMASKER = $data['ttmasker'];
        $BBMASKER = $data['bbmasker'];
        $KOLOK = $data['kolok'];
        $KLOGAD = $data['klogad'];
        $SPMU = $data['spmu'];
        $NOSK = $data['nosk'];
        $TGSK = $data['tgsk'];
        $USER_ID = $data['user_id'];
        
        $term = $data['term'];
        $TAHUN_REFGAJI = $data['tahun_refgaji'];

        $sql="SELECT NRK  FROM PERS_RB_GAPOK_HIST WHERE NRK='".$nrk."' AND TMT = TO_DATE('".$TMT."', 'DD-MM-YY') AND GAPOK=".$GAPOK." AND ROWNUM <1";
        $gpk = $this->db->query($sql);

            if ($gpk->num_rows() == 0) {
                
               /*$sql = "UPDATE PERS_RB_GAPOK_HIST SET JENRUB = ".$JENRUB.", KOPANG = '".$KOPANG."', TTMASKER = ".$TTMASKER.", BBMASKER = ".$BBMASKER.", KOLOK = '".$KOLOK."', NOSK = UPPER('".$NOSK."'),TGSK = TO_DATE('".$TGSK."', 'DD-MM-YYYY'),  USER_ID = '".$USER_ID."', TERM = '".$term."', TG_UPD = SYSDATE, KLOGAD = '".$KLOGAD."', SPMU = '".$SPMU."', TAHUN_REFGAJI='".$TAHUN_REFGAJI."'
                WHERE NRK = '".$nrk."' AND TMT = TO_DATE('".$tmt."', 'DD-MM-YY') AND GAPOK=".$gapok."";*/
                if($JENRUB == null)
                {
                    $sql = "UPDATE PERS_RB_GAPOK_HIST SET  KOPANG = '".$KOPANG."', TTMASKER = ".$TTMASKER.", BBMASKER = ".$BBMASKER.", KOLOK = '".$KOLOK."', NOSK = UPPER('".$NOSK."'),TGSK = TO_DATE('".$TGSK."', 'DD-MM-YYYY'),  USER_ID = '".$USER_ID."', TERM = '".$term."', TG_UPD = SYSDATE, KLOGAD = '".$KLOGAD."', SPMU = '".$SPMU."', TAHUN_REFGAJI='".$TAHUN_REFGAJI."'
                    WHERE NRK = '".$nrk."' AND TMT = TO_DATE('".$tmt."', 'DD-MM-YY') AND GAPOK=".$gapok."";
                }
                else
                {
                   $sql = "UPDATE PERS_RB_GAPOK_HIST SET JENRUB = ".$JENRUB.", KOPANG = '".$KOPANG."', TTMASKER = ".$TTMASKER.", BBMASKER = ".$BBMASKER.", KOLOK = '".$KOLOK."', NOSK = UPPER('".$NOSK."'),TGSK = TO_DATE('".$TGSK."', 'DD-MM-YYYY'),  USER_ID = '".$USER_ID."', TERM = '".$term."', TG_UPD = SYSDATE, KLOGAD = '".$KLOGAD."', SPMU = '".$SPMU."', TAHUN_REFGAJI='".$TAHUN_REFGAJI."'
                    WHERE NRK = '".$nrk."' AND TMT = TO_DATE('".$tmt."', 'DD-MM-YY') AND GAPOK=".$gapok.""; 
                }
         
                $id = $this->db->query($sql);
                return $id;
            } 
    }

    public function update_pangkat($data)
    {
        $NRK = $this->input->post('nrk');
        $TMT = $this->input->post('tmt');
        $KOPANG = $this->input->post('kopang');
        $TTMASKER = $this->input->post('ttmasker');
        $BBMASKER = $this->input->post('bbmasker');
        $KOLOK = $this->input->post('kolok');
        $KLOGAD = $this->input->post('klogad');
        $SPMU = $this->input->post('spmu');
        $TEMPGAPOK = $this->input->post('gapok');
        $GAPOK = str_replace('.', '', $TEMPGAPOK);
        $PEJTT = $this->input->post('pejtt');
        $NOSK = $this->input->post('nosk');
        $TGSK = $this->input->post('tgsk');
        $USER_ID = $data['user_id'];

        $TTMASYAD = $this->input->post('ttmasyad');
        $BBMASYAD = $this->input->post('bbmasyad');
        $JENRUB = $this->input->post('jenrub');
        
        
       
        $term = $this->input->ip_address();
        if($term == '0.0.0.0') {
            $ip = explode(',', $_SERVER['REMOTE_ADDR']);
            $term = $ip[0];
        } 
        $TAHUN_REFGAJI = $this->input->post('tahun_refgaji');


        $cek = $this->getDataPangkatHist($NRK, $TMT, $KOPANG)->num_rows();
        if($cek==1)
        {
            
    
            $sql = "UPDATE PERS_PANGKAT_HIST SET TTMASKER=".$TTMASKER.",BBMASKER = ".$BBMASKER.",KOLOK = '".$KOLOK."', GAPOK = ".$GAPOK.",PEJTT = ".$PEJTT.",
                    NOSK = UPPER('".$NOSK."'),TGSK = TO_DATE('".$TGSK."', 'DD-MM-YY'),user_id='".$USER_ID."',term='".$term."', TG_UPD = SYSDATE, KLOGAD = '".$KLOGAD."', SPMU = '".$SPMU."',TAHUN_REFGAJI = '".$TAHUN_REFGAJI."',JENRUB = ".$JENRUB."
                    WHERE NRK = '".$NRK."' AND TMT =TO_DATE('".$TMT."', 'DD-MM-YY') AND KOPANG='".$KOPANG."'"; 
                   
            $id = $this->db->query($sql);

            if ($id){
                //Jika jenis perubahan 1=PENGANGKATAN PNS (100%) maka status pegawai jadi PNS
                

                    $gpk['tmt'] = $TMT;
                    $gpk['kopang'] = $KOPANG;
                    $gpk['ttmasker'] = $TTMASKER;
                    $gpk['bbmasker'] = $BBMASKER;
                    $gpk['kolok'] = $KOLOK;
                    $gpk['klogad'] = $KLOGAD;
                    $gpk['spmu'] = $SPMU;
                    $gpk['nosk'] = $NOSK;
                    $gpk['tgsk'] = $TGSK;
                    $gpk['gapok'] = $GAPOK;
                    $gpk['user_id'] = $USER_ID;
                    $gpk['term'] = $term;
                
                    $gpk['ttmasyad'] = $TTMASYAD;
                    $gpk['bbmasyad'] = $BBMASYAD;
                    $gpk['jenrub'] = $JENRUB;
                    $gpk['tahun_refgaji'] = $TAHUN_REFGAJI;
                    $this->updateGapokFromPangkat($NRK, $TMT, $GAPOK, $gpk);
                    $this->updateToPeg1($NRK,$KOLOK,$KLOGAD,$SPMU);

                    //$q1 = "UPDATE PERS_PEGAWAI1 SET STAPEG='2' WHERE NRK='$NRK'";
                    //$this->db->query($q1);

                if($JENRUB == '1')
                {
                    $this->updateToPeg1Muang($NRK, $TMT);
                }
               


                //Jika jenis perubahan 1=PENGANGKATAN PNS (100%) maka status pegawai jadi PNS
                if ($JENRUB == '12'){
                    $q1 = "UPDATE PERS_PEGAWAI1 SET STAPEG='2' WHERE NRK='$NRK'";
                    $this->db->query($q1);

                    $this->updateToPeg1TmtStapeg($NRK, $TMT);
                }
                
            }
        }

        else
        {
            $insert = false;
        }
        return $id;
    }

    public function updatePensiunPeg1($nrk,$tmtpensiun)
    {
        $sql = "UPDATE PERS_PEGAWAI1 SET TMTPENSIUN=TO_DATE('".$tmtpensiun."','DD-MM-YYYY') WHERE NRK='".$nrk."'";

        $query = $this->db->query($sql);
    }

    public function updatekepeg1($nrk,$kolok,$klogad,$kojab)
    {
        $sql = "UPDATE PERS_PEGAWAI1 SET KD='S',KOLOK='".$kolok."', KLOGAD='".$klogad."', KOJAB='".$kojab."',SPMU='' WHERE NRK='".$nrk."'";

        $query = $this->db->query($sql);
    }

    public function updateToPeg1($nrk,$kolok,$klogad,$spmu)
    {
        $sql = "UPDATE PERS_PEGAWAI1 SET KOLOK='".$kolok."', KLOGAD='".$klogad."', SPMU='".$spmu."' WHERE NRK='".$nrk."'";

        $query = $this->db->query($sql);
    }

    public function updateToPeg1Muang($nrk,$tmt)
    {
        $sql = "UPDATE PERS_PEGAWAI1 SET MUANG=TO_DATE('".$tmt."','DD-MM-YYYY') WHERE NRK='".$nrk."'";

        $query = $this->db->query($sql);
    }

    public function updateToPeg1TmtStapeg($nrk,$tmt)
    {
        $sql = "UPDATE PERS_PEGAWAI1 SET TMT_STAPEG=TO_DATE('".$tmt."','DD-MM-YYYY') WHERE NRK='".$nrk."'";

        $query = $this->db->query($sql);
    }

    public function delete_flag_pangkat($NRK,$TMT,$KOPANG){                
        $sql = "UPDATE PERS_PANGKAT_HIST SET DELETED='Y' WHERE NRK = '".$NRK."' AND TMT =TO_DATE('".$TMT."', 'DD-MM-YY') AND KOPANG='".$KOPANG."'"; 

        $id = $this->db->query($sql);
        return $id;
    }

    public function delete_pangkat($NRK,$TMT,$KOPANG){                
        $user_id       = $this->session->userdata('logged_in')['id'];
        $qi="INSERT INTO DEL_PERS_PANGKAT_HIST A
            (
            SELECT 
                NRK,
                TMT,
                KOPANG,
                TTMASKER,
                BBMASKER,
                KOLOK,
                GAPOK,
                PEJTT,
                NOSK,
                TGSK,
                USER_ID,
                TERM,
                TG_UPD,
                KLOGAD,
                SPMU,
                TAHUN_REFGAJI,
                JENIS_SK,
                SYSDATE AS DELETE_DATE,
                '$user_id' AS DELETE_BY
            FROM PERS_PANGKAT_HIST D
            WHERE D.NRK = '".$NRK."' AND D.TMT =TO_DATE('".$TMT."', 'DD-MM-YY') AND D.KOPANG='".$KOPANG."'
            )";
        $rsi=$this->db->query($qi);

        $sql = "DELETE FROM PERS_PANGKAT_HIST WHERE NRK = '".$NRK."' AND TMT =TO_DATE('".$TMT."', 'DD-MM-YY') AND KOPANG='".$KOPANG."'"; 

        $id = $this->db->query($sql);
        return $id;
    }

    public function getPangkatById($id1,$id2,$id3)
    {
        $sql = "SELECT NRK, TMT, KOPANG, TTMASKER, BBMASKER, KOLOK, GAPOK, PEJTT, NOSK, TGSK, KLOGAD, SPMU, TAHUN_REFGAJI,JENRUB FROM PERS_PANGKAT_HIST
                WHERE NRK = '".$id1."' AND TMT= TO_DATE('".$id2."','DD-MM-YYYY') AND KOPANG='".$id3."'";
        //var_dump($sql);
        $id = $this->db->query($sql)->row();

        return $id;
    }


    /*public function getPangkatById($id1)
    {
        $sql = "SELECT NRK, TMT, KOPANG, TTMASKER, BBMASKER, KOLOK, GAPOK, PEJTT, NOSK, TGSK FROM PERS_PANGKAT_HIST
                WHERE NRK = '".$id1."'";
        
        $id = $this->db->query($sql)->row();

        return $id;
    }*/


/*END PANGKAT*/

    function getDataGapokHist($id,$id2,$id3)
    {
        $sql = "SELECT NRK FROM PERS_RB_GAPOK_HIST WHERE 
                NRK = '".$id."' AND 
                TMT = TO_DATE('".$id2."', 'DD-MM-YYYY') AND
                GAPOK = ".$id3." ";        

        $query = $this->db->query($sql);            
   
        return $query;
    }

/*START GAPOK*/
    public function save_gapok($data)
    {
        
        $NRK = $this->input->post('nrk');
        $TMT = $this->input->post('tmt');
        $TEMPGAPOK = $this->input->post('gapok');
        $GAPOK = str_replace('.', '', $TEMPGAPOK);

        $JENRUB = $this->input->post('jenrub');
        $KOPANG = $this->input->post('kopang');
        $TTMASKER = $this->input->post('ttmasker');
      
        $BBMASKER = $this->input->post('bbmasker');
        if($BBMASKER == null)
        {
            $BBMASKER = 0;
        }
        $KOLOK = $this->input->post('kolok');
        $KLOGAD = $this->input->post('klogad');
        $SPMU = $this->input->post('spmu');
        $JENSK = $this->input->post('jensk');
        $NOSK = $this->input->post('nosk');
        $TGSK = $this->input->post('tgsk');
        $TTMASYAD = $this->input->post('ttmasyad');
        $BBMASYAD = $this->input->post('bbmasyad');
        $USER_ID = $data['user_id'];
        
        $term = $this->input->ip_address();
        if($term == '0.0.0.0') {
            $ip = explode(',', $_SERVER['REMOTE_ADDR']);
            $term = $ip[0];
        }

        $TAHUN_REFGAJI = $this->input->post('tahun_refgaji');

        $cek= $this->getDataGapokHist($NRK,$TMT,$GAPOK)->num_rows();

        if($cek==0)
        {

            $sql = "INSERT INTO PERS_RB_GAPOK_HIST(NRK,TMT,GAPOK,JENRUB,KOPANG,TTMASKER,BBMASKER,KOLOK,NOSK,TGSK,TTMASYAD,BBMASYAD,USER_ID,TERM,TG_UPD, KLOGAD, SPMU,TAHUN_REFGAJI,JENIS_SK) 
            VALUES ('".$NRK."',TO_DATE('".$TMT."', 'DD-MM-YYYY'),".$GAPOK.",".$JENRUB.",'".$KOPANG."',".$TTMASKER.",".$BBMASKER.",'".$KOLOK."',UPPER('".$NOSK."'),TO_DATE('".$TGSK."', 'DD-MM-YYYY'),".$TTMASYAD.",".$BBMASYAD.",'".$USER_ID."','".$term."', SYSDATE,'".$KLOGAD."','".$SPMU."','".$TAHUN_REFGAJI."','".$JENSK."')";
            
            $id = $this->db->query($sql);

            if ($id){
                //Jika jenis perubahan 1=PENGANGKATAN PNS (100%) maka status pegawai jadi PNS
                if ($JENRUB == '12'){
                    $q1 = "UPDATE PERS_PEGAWAI1 SET STAPEG='2' WHERE NRK='$NRK'";
                    $this->db->query($q1);
                }
                $this->updateToPeg1($NRK,$KOLOK,$KLOGAD,$SPMU);
            }
        }
        else
        {
            $id=false;
        }
        

        return $id;
    }

    public function update_gapok($data)
    {
        $NRK = $this->input->post('nrk');
        $TMT = $this->input->post('tmt');
        //$ = $this->input->post('tmt');
        $TEMPGAPOK_PK = $this->input->post('gapokPK');
        $GAPOK_PK = str_replace('.', '', $TEMPGAPOK_PK);  
        $TEMPGAPOK = $this->input->post('gapok');
        $x = strpos($TEMPGAPOK,'.');
        if($x)
        {
            $GAPOK = str_replace('.', '', $TEMPGAPOK);
        }
        else
        {
            $GAPOK = str_replace(',', '', $TEMPGAPOK);
        }
        
        
        
        $JENRUB = $this->input->post('jenrub');
        $KOPANG = $this->input->post('kopang');
        $TTMASKER = $this->input->post('ttmasker');
        $BBMASKER = $this->input->post('bbmasker');
        $KOLOK = $this->input->post('kolok');
        $KLOGAD = $this->input->post('klogad');
        $SPMU = $this->input->post('spmu');
        $JENSK = $this->input->post('jensk');
        $NOSK = $this->input->post('nosk');
        $TGSK = $this->input->post('tgsk');
        $TTMASYAD = $this->input->post('ttmasyad');
        $BBMASYAD = $this->input->post('bbmasyad');
        $USER_ID = $data['user_id'];
       
        $term = $this->input->ip_address();
        if($term == '0.0.0.0') {
            $ip = explode(',', $_SERVER['REMOTE_ADDR']);
            $term = $ip[0];
        }

        $TAHUN_REFGAJI = $this->input->post('tahun_refgaji');

        $cek= $this->getDataGapokHist($NRK,$TMT,$GAPOK_PK)->num_rows();

        if($cek==1)
        {
    
            $sql = "UPDATE PERS_RB_GAPOK_HIST SET GAPOK = ".$GAPOK.",JENRUB = ".$JENRUB.", KOPANG = '".$KOPANG."', TTMASKER = ".$TTMASKER.", BBMASKER = ".$BBMASKER.", KOLOK = '".$KOLOK."', NOSK = UPPER('".$NOSK."'),TGSK = TO_DATE('".$TGSK."', 'DD-MM-YYYY'), TTMASYAD = ".$TTMASYAD.", BBMASYAD = ".$BBMASYAD.", USER_ID = '".$USER_ID."', TERM = '".$term."', TG_UPD = SYSDATE, KLOGAD = '".$KLOGAD."', SPMU = '".$SPMU."', TAHUN_REFGAJI='".$TAHUN_REFGAJI."', JENIS_SK='".$JENSK."'
                    WHERE NRK = '".$NRK."' AND TMT = TO_DATE('".$TMT."', 'DD-MM-YY') AND GAPOK=".$GAPOK_PK."";
            
            $id = $this->db->query($sql);
            if ($id){
                //Jika jenis perubahan 1=PENGANGKATAN PNS (100%) maka status pegawai jadi PNS
                if ($JENRUB == '12'){
                    $q1 = "UPDATE PERS_PEGAWAI1 SET STAPEG='2' WHERE NRK='$NRK'";
                    $this->db->query($q1);
                }
                $this->updateToPeg1($NRK,$KOLOK,$KLOGAD,$SPMU);
            }
        }
        else
        {
            $id=false;
        }
        return $id;
    }

    public function delete_flag_gapok($NRK, $TMT, $GAPOK)
    {   
        $sql = "UPDATE PERS_RB_GAPOK_HIST SET DELETED='Y'  WHERE NRK = '".$NRK."' AND TMT = TO_DATE('".$TMT."', 'YY-MM-DD') AND GAPOK='".$GAPOK."'";        
            
        $id = $this->db->query($sql);

        return $id;
    }

    public function delete_gapok($NRK, $TMT, $GAPOK)
    {            
               
        $user_id       = $this->session->userdata('logged_in')['id'];
        $qi="INSERT INTO DEL_PERS_RB_GAPOK_HIST A
            (
            SELECT 
                NRK,
                TMT,
                GAPOK,
                JENRUB,
                KOPANG,
                TTMASKER,
                BBMASKER,
                KOLOK,
                NOSK,
                TGSK,
                TTMASYAD,
                BBMASYAD,
                USER_ID,
                TERM,
                TG_UPD,
                KLOGAD,
                SPMU,
                TAHUN_REFGAJI,
                JENIS_SK,
                SYSDATE AS DELETE_DATE,
                '$user_id' AS DELETE_BY
            FROM PERS_RB_GAPOK_HIST D
            WHERE D.NRK = '".$NRK."' AND D.TMT = TO_DATE('".$TMT."', 'YY-MM-DD') AND D.GAPOK='".$GAPOK."'
            )";

        $rsi=$this->db->query($qi);
        
        $sql = "DELETE FROM PERS_RB_GAPOK_HIST WHERE NRK = '".$NRK."' AND TMT = TO_DATE('".$TMT."', 'YY-MM-DD') AND GAPOK='".$GAPOK."'";        
            
        $id = $this->db->query($sql);

        return $id;
    }

    public function cekNextBerkala($kopang, $ttmasker, $gapok)
    {
        $sql="  SELECT MIN(KOPANG) MINKOPANG, MIN(TTMASKER) MINTTMASKER,MIN(BBMASKER) MINBBMASKER, GAPOK 
                FROM PERS_GAPOK_TBL
                WHERE KOPANG='".$kopang."' AND TTMASKER>".$ttmasker." AND GAPOK>".$gapok." AND ROWNUM=1
                GROUP BY GAPOK 
                ORDER BY MIN(KOPANG), MIN(TTMASKER), MIN(BBMASKER) ASC
            ";
        
        $query = $this->db->query($sql)->row();

        return $query;
    }

    
    function cekMasa($kopang, $ttmasker)
    {
        $sql="  SELECT * FROM
                (
                    SELECT MIN (KOPANG), MIN (TTMASKER) AS MINTT, MIN (BBMASKER) AS MINBB, GAPOK
                    FROM PERS_GAPOK_TBL
                    WHERE KOPANG = '".$kopang."' AND TTMASKER <= ".$ttmasker."
                    GROUP BY GAPOK
                    ORDER BY MIN (TTMASKER) DESC
                )
                WHERE ROWNUM = 1
            ";

        $query = $this->db->query($sql)->row();
        return $query;
    }

    function cekMasaMin($kopang)
    {
        $sql="  SELECT MIN(KOPANG), MIN(TTMASKER) AS MINTTMASK ,MIN(BBMASKER) AS MINBBMASK, GAPOK 
                FROM PERS_GAPOK_TBL
                WHERE KOPANG='".$kopang."' AND ROWNUM=1
                GROUP BY GAPOK 
                ORDER BY MIN(KOPANG), MIN(TTMASKER), MIN(BBMASKER) ASC
            ";

        $query = $this->db->query($sql)->row();
        return $query;
    }

/*END GAPOK*/

/*START HUKDIS*/
    public function cekMasaTblBaru($thn,$kopang,$ttmasker)
    {

        $sql = "SELECT * FROM
                (
                    SELECT MIN (KOPANG), MIN (TTMASKER) AS MINTT, MIN (BBMASKER) AS MINBB, GAPOK
                    FROM PERS_GAPOK_TBL_hist
                    WHERE TAHUN='".$thn."' AND KOPANG = '".$kopang."' AND TTMASKER <= ".$ttmasker."
                    GROUP BY GAPOK
                    ORDER BY MIN (TTMASKER) DESC
                )
                WHERE ROWNUM = 1";
        
        $query = $this->db->query($sql)->row();
        return $query;
    }

    function getDataHukdis($id,$id2)
    {
        $sql = "SELECT NRK FROM PERS_DISIPLIN_HIST WHERE 
                NRK = '".$id."' AND 
                TGSK = TO_DATE('".$id2."', 'DD-MM-YYYY') ";        

        $query = $this->db->query($sql);            
   
        return $query;
    }

    public function save_hukdis($data)
    {
            $NRK = $this->input->post('nrk');
            $TGSK = $this->input->post('tgsk');
           
            $NOSK = $this->input->post('nosk');
            $JENHUKDIS = $this->input->post('jenhukdis');
            $TGMULAI = $this->input->post('tgmulai');
            $TGAKHIR = $this->input->post('tgakhir');
            $PEJTT = $this->input->post('pejtt');
            $TMTMULAI_STOPTKD = $this->input->post('mulaistoptkd');
            $TMTAKHIR_STOPTKD = $this->input->post('akhirstoptkd');
            $JMLBLN_STOPTKD = ($this->input->post('blnstoptkd')=="")?0:$this->input->post('blnstoptkd');
            $KET = $this->input->post('ket');
            
            $USER_ID = $data['user_id'];
            $term = $this->input->ip_address();
            if($term == '0.0.0.0') {
            $ip = explode(',', $_SERVER['REMOTE_ADDR']);
            $term = $ip[0];
        }

            $cek = $this->getDataHukdis($NRK,$TGSK)->num_rows();

            if($cek == 0)
            {
            
                $sql = "INSERT INTO PERS_DISIPLIN_HIST(NRK,TGSK,NOSK,JENHUKDIS,TGMULAI,TGAKHIR,PEJTT,USER_ID,TERM,TG_UPD, TMTMULAI_STOPTKD, TMTAKHIR_STOPTKD,JMLBLN_STOPTKD,KET,STATUS_AKTIF) 
                    VALUES ('".$NRK."',TO_DATE('".$TGSK."', 'DD-MM-YYYY'),UPPER('".$NOSK."'),".$JENHUKDIS.",TO_DATE('".$TGMULAI."', 'DD-MM-YYYY'),TO_DATE('".$TGAKHIR."', 'DD-MM-YYYY'),".$PEJTT.",'".$USER_ID."','".$term."', SYSDATE, TO_DATE('".$TMTMULAI_STOPTKD."', 'DD-MM-YYYY'),TO_DATE('".$TMTAKHIR_STOPTKD."', 'DD-MM-YYYY'),".$JMLBLN_STOPTKD.",UPPER('".$KET."'),'AKTIF')"; 
                // $this->db->query($sql);
                // var_dump($sql);
                //     exit;

                if($JENHUKDIS == 9 || $JENHUKDIS == 13)
                {
                    //AMBIL KOPANG SEKARANG
                    $getLastHist = "SELECT * FROM
                                    (
                                        SELECT
                                            *
                                        FROM
                                            PERS_RB_GAPOK_HIST
                                        WHERE
                                            NRK = '".$NRK."'
                                        AND TMT = (
                                            SELECT
                                                MAX (TMT) MAXTMT
                                            FROM
                                                PERS_RB_GAPOK_HIST
                                            WHERE
                                                NRK = '".$NRK."'
                                        )
                                        ORDER BY
                                            GAPOK DESC 
                                    )
                                    WHERE ROWNUM = 1";
                    //var_dump($getLastHist);
                    $exGetLastHist = $this->db->query($getLastHist)->row();


                    //AMBIL KOPANG 1 DI BAWAH SEKARANG
                    $getKopangTurun = "SELECT * FROM
                                        (
                                            SELECT 
                                                KOPANG 
                                            FROM PERS_PANGKAT_TBL 
                                            WHERE KOPANG < '".$exGetLastHist->KOPANG."' ORDER BY KOPANG DESC
                                        )
                                        WHERE ROWNUM = 1";
                    $exGetKopangTurun = $this->db->query($getKopangTurun)->row();
                   
                    $ttbbnow = $this->getTTBBNowPg($NRK);
                    

                    //$getThnRef = "SELECT TO_CHAR(SYSDATE,'YYYY')SKRG FROM DUAL";
                    $getThnRef = "SELECT max(tahun) TAHUN from PERS_GAPOK_TBL_HIST";
                    $exGetThnRef = $this->db->query($getThnRef)->row();

                    //data yang akan dikirim
                    $kopangTurun = $exGetKopangTurun->KOPANG;
                    //var_dump($kopangTurun);
                    $kopang_skrg = $exGetLastHist->KOPANG;
                    $ttTurun = $ttbbnow->TTMSKNOW;
                    $bbTurun = $ttbbnow->BBMSKNOW;
                    $kolokTurun = $exGetLastHist->KOLOK;
                    $pejttTurun = $PEJTT;
                    $tahun_refgajiTurun = $exGetThnRef->TAHUN;

                    $subKopangTurun = substr($kopangTurun, 1,1);
                    $subKopang_skrg = substr($kopang_skrg, 1,1);



                    /*if($exGetGapokTurun == null)
                    {
                        $querynul = "SELECT * FROM PERS_GAPOK_TBL_HIST WHERE KOPANG = '".$kopangTurun."'  AND TAHUN ='".$tahun_refgajiTurun."' and TTMASKER = (SELECT MIN(TTMASKER) FROM PERS_GAPOK_TBL_HIST WHERE KOPANG = '".$kopangTurun."' AND TAHUN='".$tahun_refgajiTurun."') ";
                        $exGetGapokTurun = $this->db->query($querynul)->row();
                    }*/

                   
                    
                
                    $ttbbtmt = $this->getTTBBPgbyTMT($NRK,$TGSK);

                    $ttbytmt = $ttbbtmt->TTMSKTMT;
                    $bbbytmt = $ttbbtmt->BBMSKTMT;

                    $ttakhir;$bbakhir;
                    
                    if($bbbytmt<0)
                    {
                        $ttakhir = $ttbytmt - 1;
                        $bbakhir = 12+$bbbytmt;
                    }
                    else if($bbbytmt>12)
                    {
                    	$ttakhir = $ttbytmt+1;
                        $bbakhir = $bbbytmt-12;	
                    }
                    else
                    {
                        $ttakhir = $ttbytmt;
                        $bbakhir = $bbbytmt;
                    }

                    // CEK TTMASKER SAAT PENURUNAN JABATAN BERDASARKAN KODE JABATAN SEKARANG DAN KODE JABATAN TURUN

                    if($subKopang_skrg == 4 && $subKopangTurun == 3){
                        //$ttTurun1 = ($ttTurun + 0);
                        $ttTurun1 = ($ttakhir + 0);
                    }elseif($subKopang_skrg == 3 && $subKopangTurun == 2){
                        //$ttTurun1 = ($ttTurun + 5);
                        $ttTurun1 = ($ttakhir + 5);
                    }elseif($subKopang_skrg == 2 && $subKopangTurun == 1) {                    
                        //$ttTurun1 = ($ttTurun + 6);
                        $ttTurun1 = ($ttakhir + 6);
                    }else{
                        //$ttTurun1 = $ttTurun;
                        $ttTurun1 = $ttakhir;
                    }
                   
                    $getGapokTurun = "SELECT * FROM PERS_GAPOK_TBL_HIST WHERE KOPANG = '".$kopangTurun."' AND TTMASKER = ".$ttTurun1." AND TAHUN ='".$tahun_refgajiTurun."'";
                    
                    $exGetGapokTurun = $this->db->query($getGapokTurun)->row();

                    if($exGetGapokTurun == null)
                    {
                        $getMaksimumTahun = "SELECT MAX(TTMASKER)TTMASKER FROM PERS_GAPOK_TBL_HIST where kopang = '".$kopangTurun."' and tahun ='".$tahun_refgajiTurun."'";

                        $tahunMaks=$this->db->query($getMaksimumTahun)->row();
                        $ttTurun1 = $tahunMaks->TTMASKER;

                         $getGapokTurun = "SELECT * FROM PERS_GAPOK_TBL_HIST WHERE KOPANG = '".$kopangTurun."' AND TTMASKER = ".$ttTurun1." AND TAHUN ='".$tahun_refgajiTurun."'";
                         
                        $exGetGapokTurun = $this->db->query($getGapokTurun)->row();
                            
                    }
                   
                     $gapokTurun = $exGetGapokTurun->GAPOK;
                     

                    //untuk TTMASYAD SAAT TURUN PANGKAT
                    $getTTBerkalaSebelum = $this->cekMasaTblBaru($tahun_refgajiTurun,$kopangTurun,$ttTurun1);
                    
                    $getTT = $getTTBerkalaSebelum->MINTT;

                    //ambil kolok,klogad,spmu terakhir di peg1
                    $getpeg1 = "SELECT KOLOK,KLOGAD,SPMU FROM PERS_PEGAWAI1 WHERE NRK='".$NRK."'";
                    $expeg1 = $this->db->query($getpeg1)->row();

                    $pegkolok = $expeg1->KOLOK;
                    $pegklogad = $expeg1->KLOGAD;
                    $pegspmu = $expeg1->SPMU;

            
                    //INSERT KE PERS_PANGKAT_HIST DARI DATA TERAKHIR RIWAYAT DARI PERS_RB_GAPOK_HIST
                    $insertPgkt = "INSERT INTO PERS_PANGKAT_HIST(NRK,TMT,KOPANG,TTMASKER,BBMASKER,KOLOK,GAPOK,PEJTT,NOSK,TGSK,USER_ID,TERM,TG_UPD,KLOGAD,SPMU,TAHUN_REFGAJI,JENRUB) 
                    VALUES('".$NRK."',TO_DATE('".$TGMULAI."','DD-MM-YYYY'),'".$kopangTurun."',".$ttTurun1.",".$bbakhir.",'".$pegkolok."',
                        ".$gapokTurun.",".$pejttTurun.",UPPER('".$NOSK."'),TO_DATE('".$TGSK."','DD-MM-YYYY'),'".$USER_ID."',
                        '".$term."',SYSDATE,'".$pegklogad."','".$pegspmu."','".$tahun_refgajiTurun."',4)";

                        
                    $exInsert = $this->db->query($insertPgkt);


                    $getmasyadbaru = $this->cekNextBerkala($kopangTurun,$ttTurun1,$gapokTurun);
                    if($getmasyadbaru == null)
                    {
                        $ttmasyadbaru = 0;   
                    }
                    else
                    {
                        $maskernext = $getmasyadbaru->MINTTMASKER;
                        $ttmasyadbaru = $maskernext - $ttTurun1;
                        if($ttmasyadbaru == 2)
                        {
                            $ttmasyadbaru = 0;
                        }    
                    }
                    

                    //INSERT KE PERS_RB_GAPOK_HIST DARI DATA TERAKHIR RIWAYAT DARI PERS_RB_GAPOK_HIST
                    $insertGapok = "INSERT INTO PERS_RB_GAPOK_HIST(NRK,TMT,GAPOK,JENRUB,KOPANG,TTMASKER, BBMASKER, KOLOK, NOSK,TGSK, TTMASYAD,BBMASYAD,USER_ID, TERM, TG_UPD, TAHUN_REFGAJI, KLOGAD, SPMU) VALUES('".$NRK."',TO_DATE('".$TGMULAI."','DD-MM-YYYY'),".$gapokTurun.",4,'".$kopangTurun."',".$ttTurun1.",".$bbakhir.",'".$pegkolok."',UPPER('".$NOSK."'),TO_DATE('".$TGSK."','DD-MM-YYYY'),".$ttmasyadbaru.",".$bbakhir.",'".$USER_ID."','".$term."',SYSDATE,'".$tahun_refgajiTurun."','".$pegklogad."','".$pegspmu."')";
                    
                    $exGapok = $this->db->query($insertGapok);

                }
                else if($JENHUKDIS == 10)
                {
                    $getDataJabTerakhir = "SELECT * FROM
                                            (
                                                SELECT * FROM
                                                (
                                                    SELECT TMT,KOPANG,KOLOK,KLOGAD,SPMU
                                                    FROM PERS_JABATAN_HIST
                                                    WHERE NRK = '".$NRK."'
                                                    AND TMT = ( SELECT MAX (TMT) FROM PERS_JABATAN_HIST WHERE NRK = '".$NRK."' )
                                                UNION
                                                    SELECT TMT,KOPANG,KOLOK,KLOGAD,SPMU
                                                    FROM PERS_JABATANF_HIST 
                                                    WHERE NRK = '".$NRK."'
                                                    AND TMT = ( SELECT MAX (TMT) FROM PERS_JABATANF_HIST WHERE NRK = '".$NRK."' )
                                                ) A
                                                ORDER BY A .TMT DESC
                                            )
                                        WHERE
                                            ROWNUM = 1";

                    $queJab = $this->db->query($getDataJabTerakhir);

                    //cek apakah punya data riwayat jabatan
                    if($queJab->num_rows()>0)
                    {
                        $isijab=$queJab->row();

                        $insertJabHist = "INSERT INTO PERS_JABATAN_HIST(NRK,TMT,KOLOK,KOJAB,KDSORT,TGAKHIR,KOPANG,ESELON,PEJTT,NOSK,TGSK,KREDIT,STATUS,USER_ID,
                                            TERM,TG_UPD,CKOJABF,KLOGAD,SPMU,TMTPENSIUN,NESELON2,JENIS_SK) 
                                        VALUES ('".$NRK."',TO_DATE('".$TGMULAI."', 'DD-MM-YYYY'),'".$isijab->KOLOK."','798981','0','','".$isijab->KOPANG."','00',".$PEJTT.",UPPER('".$NOSK."'),TO_DATE('".$TGSK."', 'DD-MM-YYYY'),0,0,'".$USER_ID."','".$term."', SYSDATE,'','".$isijab->KLOGAD."','".$isijab->SPMU."','','','')";
                       
                        $exInsert = $this->db->query($insertJabHist);
                        if($exInsert)
                        {
                            $this->updatekepeg1($NRK,$isijab->KOLOK,$isijab->KLOGAD,'798981');
                        }
                    }
                }
                else if($JENHUKDIS == 11)
                {
                    //CEK DATA KOPANG TERAKHIR JABATAN
                    $getLastKopang = "SELECT * FROM (
                                        SELECT KOPANG FROM PERS_JABATAN_HIST WHERE NRK = '".$NRK."'
                                        AND TMT = (SELECT MAX(TMT) FROM PERS_JABATAN_HIST WHERE NRK='".$NRK."')
                                        UNION
                                        SELECT KOPANG FROM PERS_JABATANF_HIST WHERE NRK = '".$NRK."'
                                        AND TMT = (SELECT MAX(TMT) FROM PERS_JABATANF_HIST WHERE NRK='".$NRK."')
                                    )";
                    $exKopang = $this->db->query($getLastKopang)->row();
                    $valKopang = $exKopang->KOPANG;


                    $getKdJabatan = "SELECT KD FROM PERS_PEGAWAI1 WHERE NRK = '".$NRK."'";
                    $exKdJabatan = $this->db->query($getKdJabatan)->row();

                    
                        $valEselon='00';
                    
                    //var_dump($valEselon);exit;
                    $insertJabHist = "INSERT INTO PERS_JABATAN_HIST(NRK,TMT,KOLOK,KOJAB,KDSORT,TGAKHIR,KOPANG,ESELON,PEJTT,NOSK,TGSK,KREDIT,STATUS,USER_ID,TERM,TG_UPD,CKOJABF,KLOGAD,SPMU,TMTPENSIUN,NESELON2,JENIS_SK) 
                    VALUES ('".$NRK."',TO_DATE('".$TGSK."', 'DD-MM-YYYY'),'111111113','999913','3','','".$valKopang."','".$valEselon."',".$PEJTT.",UPPER(
                      '".$NOSK."'),TO_DATE('".$TGSK."', 'DD-MM-YYYY'),0,0,'".$USER_ID."','".$term."', SYSDATE,'','111111113','','','','')
                    ";

                    $exInsert = $this->db->query($insertJabHist);

                    if($exInsert){
                        $peg['kd'] = 'S';
                        $peg['kolok'] = '111111113';
                        $peg['kojab'] = '999913';
                        $peg['klogad'] = '111111113';
                        $peg['tmt'] = $TGSK;
                        $peg['user_id'] = $USER_ID;
                        $peg['term'] =$term;
                    $this->updatePegawai1($NRK, $peg);
                    }

                } //end if hukdis 11
                else if($JENHUKDIS == 12)
                {
                    //CEK DATA KOPANG TERAKHIR JABATAN
                    $getLastKopang = "SELECT * FROM (
                                        SELECT KOPANG FROM PERS_JABATAN_HIST WHERE NRK = '".$NRK."'
                                        AND TMT = (SELECT MAX(TMT) FROM PERS_JABATAN_HIST WHERE NRK='".$NRK."')
                                        UNION
                                        SELECT KOPANG FROM PERS_JABATANF_HIST WHERE NRK = '".$NRK."'
                                        AND TMT = (SELECT MAX(TMT) FROM PERS_JABATANF_HIST WHERE NRK='".$NRK."')
                                    )";
                    $exKopang = $this->db->query($getLastKopang)->row();
                    $valKopang = $exKopang->KOPANG;


                    $getKdJabatan = "SELECT KD FROM PERS_PEGAWAI1 WHERE NRK = '".$NRK."'";
                    $exKdJabatan = $this->db->query($getKdJabatan)->row();

                    
                        $valEselon='00';
                    

                    $insertJabHist = "INSERT INTO PERS_JABATAN_HIST(NRK,TMT,KOLOK,KOJAB,KDSORT,TGAKHIR,KOPANG,ESELON,PEJTT,NOSK,TGSK,KREDIT,STATUS,USER_ID,TERM,TG_UPD,CKOJABF,KLOGAD,SPMU,TMTPENSIUN,NESELON2,JENIS_SK) 
                    VALUES ('".$NRK."',TO_DATE('".$TGSK."', 'DD-MM-YYYY'),'111111114','999914','3','','".$valKopang."','".$valEselon."',".$PEJTT.",UPPER(
                      '".$NOSK."'),TO_DATE('".$TGSK."', 'DD-MM-YYYY'),0,0,'".$USER_ID."','".$term."', SYSDATE,'','111111114','','','','')
                    ";

                    $exInsert = $this->db->query($insertJabHist);

                    if($exInsert){
                        $peg['kd'] = 'S';
                        $peg['kolok'] = '111111114';
                        $peg['kojab'] = '999914';
                        $peg['klogad'] = '111111114';
                        $peg['tmt'] = $TGSK;
                        $peg['user_id'] = $USER_ID;
                        $peg['term'] =$term;
                    $this->updatePegawai1($NRK, $peg);
                    }

                } //end if hukdis 12

                $id = $this->db->query($sql);
            }
            else
            {
                $id=false;
            }
        
        return $id;
    }

    public function update_hukdis($data)
    {
            $NRK = $this->input->post('nrk');
            $TGSK = $this->input->post('tgsk');
            //$JENSK = $this->input->post('jensk');
            $NOSK = $this->input->post('nosk');
            $JENHUKDIS = $this->input->post('jenhukdis');
            $TGMULAI = $this->input->post('tgmulai');
            $TGAKHIR = $this->input->post('tgakhir');
            $PEJTT = $this->input->post('pejtt');
            $TMTMULAI_STOPTKD = $this->input->post('mulaistoptkd');
            $TMTAKHIR_STOPTKD = $this->input->post('akhirstoptkd');
            $JMLBLN_STOPTKD = $this->input->post('blnstoptkd');
            $KET = $this->input->post('ket');
            
            $USER_ID = $data['user_id'];
           
            $term = $this->input->ip_address();
            if($term == '0.0.0.0') {
            $ip = explode(',', $_SERVER['REMOTE_ADDR']);
            $term = $ip[0];
            }

            $cek = $this->getDataHukdis($NRK,$TGSK)->num_rows();

            if($cek == 1)
            {
        
                $sql = "UPDATE PERS_DISIPLIN_HIST SET NOSK = UPPER('".$NOSK."'), JENHUKDIS = '".$JENHUKDIS."', TGMULAI = TO_DATE('".$TGMULAI."', 'DD-MM-YYYY') , 
                        TGAKHIR = TO_DATE('".$TGAKHIR."', 'DD-MM-YYYY'), PEJTT = '".$PEJTT."', USER_ID = '".$USER_ID."', TERM = '".$term."', TG_UPD = SYSDATE, TMTMULAI_STOPTKD = TO_DATE('".$TMTMULAI_STOPTKD."', 'DD-MM-YYYY'), TMTAKHIR_STOPTKD = TO_DATE('".$TMTAKHIR_STOPTKD."', 'DD-MM-YYYY'), JMLBLN_STOPTKD = ".$JMLBLN_STOPTKD.", KET = UPPER('".$KET."')
                        WHERE NRK = '".$NRK."' AND TGSK = TO_DATE('".$TGSK."', 'DD-MM-YYYY')
                        ";

                 
           
                if($JENHUKDIS == '9' || $JENHUKDIS == '13')
                {

                    $getDataPangkatTurun = "SELECT TO_CHAR(TMT,'DD-MM-YYYY')TMT,KOPANG,GAPOK FROM PERS_PANGKAT_HIST WHERE NRK='".$NRK."' AND TGSK =TO_DATE('".$TGSK."','DD-MM-YYYY')";
                    $exgDPT = $this->db->query($getDataPangkatTurun)->row();
                    //var_dump($exgDPT);
                    //getPrimaryKeyPangkat
                    $tmtRiwTurun = $exgDPT->TMT;
                    $kopangTurun = $exgDPT->KOPANG;
                    $gapokTurun = $exgDPT->GAPOK;

                    $updatePangkatTurun = "UPDATE PERS_PANGKAT_HIST SET NOSK = UPPER('".$NOSK."'), USER_ID = '".$USER_ID."', TERM ='".$term."', TG_UPD = SYSDATE WHERE NRK ='".$NRK."' AND TMT=TO_DATE('".$tmtRiwTurun."','DD-MM-YYYY') AND KOPANG = '".$kopangTurun."'";
                    
                    $updPgkt = $this->db->query($updatePangkatTurun);

                    $updateGapokTurun = "UPDATE PERS_RB_GAPOK_HIST SET NOSK =UPPER('".$NOSK."'), USER_ID = '".$USER_ID."', TERM = '".$term."', TG_UPD = SYSDATE WHERE NRK = '".$NRK."' AND TMT = TO_DATE('".$tmtRiwTurun."','DD-MM-YYYY') AND GAPOK = '".$gapokTurun."'";

                    $updGapok = $this->db->query($updateGapokTurun);                

                }
                else if($JENHUKDIS==10)
                {
                    $cekDatajabDis = "SELECT * FROM PERS_JABATAN_HIST WHERE NRK='".$NRK."' AND TGSK=TO_DATE('".$TGSK."','DD-MM-YYYY') AND KOJAB='798981'";
                    $queJabDis = $this->db->query($cekDatajabDis);

                    if($queJabDis->num_rows()>0)
                    {
                        $isijbt=$queJabDis->row();
                        $insertJabHist="UPDATE PERS_JABATAN_HIST 
                                        SET KOPANG = '".$isijbt->KOPANG."', PEJTT = '".$PEJTT."',
                                            NOSK = UPPER('".$NOSK."'), TGSK = TO_DATE('".$TGSK."', 'DD-MM-YYYY'),  USER_ID = '".$USER_ID."', TERM = '".$term."',TG_UPD=SYSDATE
                                             
                                        WHERE NRK = '".$NRK."' 
                                        AND TMT = TO_DATE('".$TGMULAI."', 'DD-MM-YY') 
                                        AND KOLOK = '".$isijbt->KOLOK."' 
                                        AND KOJAB = '798981'"; 
                    }
                    else
                    {
                        $insertJabHist = "INSERT INTO PERS_JABATAN_HIST(NRK,TMT,KOLOK,KOJAB,KDSORT,TGAKHIR,KOPANG,ESELON,PEJTT,NOSK,TGSK,KREDIT,STATUS,USER_ID,
                                            TERM,TG_UPD,CKOJABF,KLOGAD,SPMU,TMTPENSIUN,NESELON2,JENIS_SK) 
                                        VALUES ('".$NRK."',TO_DATE('".$TGMULAI."', 'DD-MM-YYYY'),'".$isijab->KOLOK."','798981','0','','".$isijab->KOPANG."','00',".$PEJTT.",UPPER('".$NOSK."'),TO_DATE('".$TGSK."', 'DD-MM-YYYY'),0,0,'".$USER_ID."','".$term."', SYSDATE,'','".$isijab->KLOGAD."','".$isijab->SPMU."','','','')";
                       
                        
                    }
                    $exInsert = $this->db->query($insertJabHist);
                }
                else if($JENHUKDIS == 11)
                {
                    
                    //ambil riwayat jabatan yang terkena hukuman
                    $getRwyt="SELECT * FROM PERS_JABATAN_HIST WHERE KOLOK='111111113' AND KOJAB='999913' AND NRK = '".$NRK."'";
                    $exgetRwyt = $this->db->query($getRwyt)->row();

                    
                    $updateJabHist = "UPDATE PERS_JABATAN_HIST SET PEJTT ='".$PEJTT."',NOSK = UPPER('".$NOSK."'),USER_ID = '".$USER_ID."',TERM='".$term."',TG_UPD=SYSDATE WHERE NRK='".$NRK."' AND TMT ='".$exgetRwyt->TMT."' AND KOLOK='111111113' AND KOJAB ='999913'";


                    $exUpdate = $this->db->query($updateJabHist);

                }
                else if($JENHUKDIS == 12)
                {
                    
                    //ambil riwayat jabatan yang terkena hukuman
                    $getRwyt="SELECT * FROM PERS_JABATAN_HIST WHERE KOLOK='111111114' AND KOJAB='999914' AND NRK = '".$NRK."'";
                    $exgetRwyt = $this->db->query($getRwyt)->row();


                    $updateJabHist = "UPDATE PERS_JABATAN_HIST SET PEJTT ='".$PEJTT."',NOSK = UPPER('".$NOSK."'),USER_ID = '".$USER_ID."',TERM='".$term."',TG_UPD=SYSDATE WHERE NRK='".$NRK."' AND TMT ='".$exgetRwyt->TMT."' AND KOLOK='111111114' AND KOJAB ='999914'";


                    $exUpdate = $this->db->query($updateJabHist);

                }
                /*else
                {

                    $getDataPangkatTurun = "SELECT * FROM PERS_PANGKAT_HIST WHERE NRK='".$NRK."' AND TGSK =TO_DATE('".$TGSK."','DD-MM-YYYY')";
                    //var_dump($getDataPangkatTurun);
                    $exgDPT = $this->db->query($getDataPangkatTurun)->row();

                    //getPrimaryKeyPangkat
                    $tmtRiwTurun = $exgDPT->TMT;
                    $kopangTurun = $exgDPT->KOPANG;
                    $gapokTurun = $exgDPT->GAPOK;

                    $deletePangkatTurun = " DELETE FROM PERS_PANGKAT_HIST WHERE NRK ='".$NRK."' AND TMT=TO_DATE('".$tmtRiwTurun."','DD-MM-YYYY') AND KOPANG = '".$kopangTurun."'";

                    $dltPgkt = $this->db->query($deletePangkatTurun);

                    $deleteGapokTurun = "DELETE FROM PERS_RB_GAPOK_HIST WHERE NRK = '".$NRK."' AND TMT = TO_DATE('".$tmtRiwTurun."','DD-MM-YYYY') AND GAPOK = '".$gapokTurun."'";

                    $dltGapok = $this->db->query($deleteGapokTurun); 
                }*/
                $id = $this->db->query($sql);
            }
            else
            {
                $id=false;
            }

        return $id;
    }

    public function delete_flag_hukdis($NRK,$TGSK){
        //cek hukdis 11
        $cek  = "SELECT * FROM PERS_DISIPLIN_HIST WHERE NRK = '".$NRK."' AND TGSK =TO_DATE('".$TGSK."', 'YY-MM-DD') AND DELETED IS NULL";
        $excek = $this->db->query($cek)->row();
        $hukdis = $excek->JENHUKDIS;
        if($hukdis == 11)
        {
            //hapus riwayat jabatan struktural yang terkena hukuman
            $getDataRiwHukuman = "SELECT * FROM PERS_JABATAN_HIST WHERE KOLOK='111111113' AND KOJAB = '999913' AND NRK='".$NRK."' AND DELETED IS NULL";
            $exGetRiwHukuman = $this->db->query($getDataRiwHukuman);

            if($exGetRiwHukuman)
            {
                $hasilExGet = $exGetRiwHukuman->row();
                $exTMT = $hasilExGet->TMT;
                $deleteRiwHukuman = "UPDATE PERS_JABATAN_HIST SET DELETED='Y' WHERE NRK='".$NRK."' AND TMT='".$exTMT."' AND KOLOK='111111113' AND KOJAB ='999913'";
                $exdelete = $this->db->query($deleteRiwHukuman);
            }

            //ambil data terakhir sebelum terkena hukuman
            $getDataBfHukuman = "SELECT * FROM(
                                    SELECT NRK,TMT,KOLOK,KOJAB,KLOGAD,SPMU,'S' KD FROM PERS_JABATAN_HIST WHERE NRK='".$NRK."' AND TMT = (SELECT MAX(TMT) FROM PERS_JABATAN_HIST WHERE NRK='".$NRK."' AND DELETED IS NULL)
                                    UNION
                                    SELECT NRK,TMT,KOLOK,KOJAB,KLOGAD,SPMU,'F' KD FROM PERS_JABATANF_HIST 
                                    WHERE NRK='".$NRK."' AND TMT = (SELECT MAX(TMT) FROM PERS_JABATANF_HIST WHERE NRK='".$NRK."' AND DELETED IS NULL)
                                    ) JAB 
                                    WHERE KOLOK<>'111111113' AND KOJAB <>'999913'";

            $exGet = $this->db->query($getDataBfHukuman);

                if($exGet){
                    
                    $exGett = $exGet->row();

                    $peg['kd'] = $exGett->KD;
                    $peg['kolok'] = $exGett->KOLOK;
                    $peg['kojab'] = $exGett->KOJAB;
                    $peg['klogad'] = $exGett->KLOGAD;
                    $peg['tmt'] = $exGett->TMT;
                   
                $this->updatePegawai1($NRK, $peg);

                }
                else
                {
                    echo "no";
                }

        } //end if hukdis 11
        else if($hukdis == 12)
        {
            //hapus riwayat jabatan struktural yang terkena hukuman
            $getDataRiwHukuman = "SELECT * FROM PERS_JABATAN_HIST WHERE KOLOK='111111114' AND KOJAB = '999914' AND NRK='".$NRK."' AND DELETED IS NULL";
            $exGetRiwHukuman = $this->db->query($getDataRiwHukuman);

            if($exGetRiwHukuman)
            {
                $hasilExGet = $exGetRiwHukuman->row();
                $exTMT = $hasilExGet->TMT;
                $deleteRiwHukuman = "UPDATE PERS_JABATAN_HIST SET DELETED = 'Y' WHERE NRK='".$NRK."' AND TMT='".$exTMT."' AND KOLOK='111111114' AND KOJAB ='999914'";
                $exdelete = $this->db->query($deleteRiwHukuman);
            }

            //ambil data terakhir sebelum terkena hukuman
            $getDataBfHukuman = "SELECT * FROM(
                                    SELECT NRK,TMT,KOLOK,KOJAB,KLOGAD,SPMU,'S' KD FROM PERS_JABATAN_HIST WHERE NRK='".$NRK."' AND TMT = (SELECT MAX(TMT) FROM PERS_JABATAN_HIST WHERE NRK='".$NRK."' AND DELETED IS NULL)
                                    UNION
                                    SELECT NRK,TMT,KOLOK,KOJAB,KLOGAD,SPMU,'F' KD FROM PERS_JABATANF_HIST 
                                    WHERE NRK='".$NRK."' AND TMT = (SELECT MAX(TMT) FROM PERS_JABATANF_HIST WHERE NRK='".$NRK."' AND DELETED IS NULL)
                                    ) JAB 
                                    WHERE KOLOK<>'111111114' AND KOJAB <>'999914'";

            $exGet = $this->db->query($getDataBfHukuman);

                if($exGet){
                    
                    $exGett = $exGet->row();

                    $peg['kd'] = $exGett->KD;
                    $peg['kolok'] = $exGett->KOLOK;
                    $peg['kojab'] = $exGett->KOJAB;
                    $peg['klogad'] = $exGett->KLOGAD;
                    $peg['tmt'] = $exGett->TMT;
                    $peg['user_id'] = $USER_ID;
                    $peg['term'] =$term;
                $this->updatePegawai1($NRK, $peg);

                }
                else
                {
                    echo "no";
                }

        } //end if hukdis 12

        $sql = "UPDATE PERS_DISIPLIN_HIST SET DELETED='Y' WHERE NRK = '".$NRK."' AND TGSK =TO_DATE('".$TGSK."', 'YY-MM-DD')"; 

        $id = $this->db->query($sql);
        return $id;
    }

    public function delete_hukdis($NRK,$TGSK){
        //cek hukdis 11
        $cek  = "SELECT * FROM PERS_DISIPLIN_HIST WHERE NRK = '".$NRK."' AND TGSK =TO_DATE('".$TGSK."', 'YY-MM-DD')";
        $excek = $this->db->query($cek)->row();
        $hukdis = $excek->JENHUKDIS;
        if($hukdis == 11)
        {
            //hapus riwayat jabatan struktural yang terkena hukuman
            $getDataRiwHukuman = "SELECT * FROM PERS_JABATAN_HIST WHERE KOLOK='111111113' AND KOJAB = '999913' AND NRK='".$NRK."'";
            $exGetRiwHukuman = $this->db->query($getDataRiwHukuman);

            if($exGetRiwHukuman)
            {
                $hasilExGet = $exGetRiwHukuman->row();
                $exTMT = $hasilExGet->TMT;

                $user_id       = $this->session->userdata('logged_in')['id'];
                $qi="INSERT INTO DEL_PERS_JABATAN_HIST A
                    (
                    SELECT 
                        NRK,
                        TMT,
                        KOLOK,
                        KOJAB,
                        KDSORT,
                        TGAKHIR,
                        KOPANG,
                        ESELON,
                        PEJTT,
                        NOSK,
                        TGSK,
                        KREDIT,
                        STATUS,
                        USER_ID,
                        TERM,
                        TG_UPD,
                        CKOJABF,
                        TMTPENSIUN,
                        KLOGAD,
                        SPMU,
                        NESELON2,
                        JENIS_SK,
                        SYSDATE AS DELETE_DATE,
                        '$user_id' AS DELETE_BY
                    FROM PERS_JABATAN_HIST D
                    WHERE D.NRK='".$NRK."' AND D.TMT='".$exTMT."' AND D.KOLOK='111111113' AND D.KOJAB ='999913'
                    )";
                $rsi=$this->db->query($qi);
        
                $deleteRiwHukuman = "DELETE FROM PERS_JABATAN_HIST WHERE NRK='".$NRK."' AND TMT='".$exTMT."' AND KOLOK='111111113' AND KOJAB ='999913'";
                $exdelete = $this->db->query($deleteRiwHukuman);
            }

            //ambil data terakhir sebelum terkena hukuman
            $getDataBfHukuman = "SELECT * FROM(
                                    SELECT NRK,TMT,KOLOK,KOJAB,KLOGAD,SPMU,'S' KD FROM PERS_JABATAN_HIST WHERE NRK='".$NRK."' AND TMT = (SELECT MAX(TMT) FROM PERS_JABATAN_HIST WHERE NRK='".$NRK."')
                                    UNION
                                    SELECT NRK,TMT,KOLOK,KOJAB,KLOGAD,SPMU,'F' KD FROM PERS_JABATANF_HIST 
                                    WHERE NRK='".$NRK."' AND TMT = (SELECT MAX(TMT) FROM PERS_JABATANF_HIST WHERE NRK='".$NRK."')
                                    ) JAB 
                                    WHERE KOLOK<>'111111113' AND KOJAB <>'999913'";

            $exGet = $this->db->query($getDataBfHukuman);

                if($exGet){
                    
                    $exGett = $exGet->row();

                    $peg['kd'] = $exGett->KD;
                    $peg['kolok'] = $exGett->KOLOK;
                    $peg['kojab'] = $exGett->KOJAB;
                    $peg['klogad'] = $exGett->KLOGAD;
                    $peg['tmt'] = $exGett->TMT;
                    $peg['user_id'] = $this->session->userdata('logged_in')['id'];
                    
                    $termt = $this->input->ip_address();
                    if($termt == '0.0.0.0') {
                        $ip = explode(',', $_SERVER['REMOTE_ADDR']);
                        $termt = $ip[0];
                    }

                    $peg['term']=$termt;

                $this->updatePegawai1($NRK, $peg);

                }
                else
                {
                    echo "no";
                }

        } //end if hukdis 11
        else if($hukdis == 12)
        {
            //hapus riwayat jabatan struktural yang terkena hukuman
            $getDataRiwHukuman = "SELECT * FROM PERS_JABATAN_HIST WHERE KOLOK='111111114' AND KOJAB = '999914' AND NRK='".$NRK."'";
            $exGetRiwHukuman = $this->db->query($getDataRiwHukuman);

            if($exGetRiwHukuman)
            {
                $hasilExGet = $exGetRiwHukuman->row();
                $exTMT = $hasilExGet->TMT;

                $user_id       = $this->session->userdata('logged_in')['id'];
                $qi="INSERT INTO DEL_PERS_JABATAN_HIST A
                    (
                    SELECT 
                        NRK,
                        TMT,
                        KOLOK,
                        KOJAB,
                        KDSORT,
                        TGAKHIR,
                        KOPANG,
                        ESELON,
                        PEJTT,
                        NOSK,
                        TGSK,
                        KREDIT,
                        STATUS,
                        USER_ID,
                        TERM,
                        TG_UPD,
                        CKOJABF,
                        TMTPENSIUN,
                        KLOGAD,
                        SPMU,
                        NESELON2,
                        JENIS_SK,
                        SYSDATE AS DELETE_DATE,
                        '$user_id' AS DELETE_BY
                    FROM PERS_JABATAN_HIST D
                    WHERE D.NRK='".$NRK."' AND D.TMT='".$exTMT."' AND D.KOLOK='111111114' AND D.KOJAB ='999914'
                    )";
                $rsi=$this->db->query($qi);

                $deleteRiwHukuman = "DELETE FROM PERS_JABATAN_HIST WHERE NRK='".$NRK."' AND TMT='".$exTMT."' AND KOLOK='111111114' AND KOJAB ='999914'";
                $exdelete = $this->db->query($deleteRiwHukuman);
            }

            //ambil data terakhir sebelum terkena hukuman
            $getDataBfHukuman = "SELECT * FROM(
                                    SELECT NRK,TMT,KOLOK,KOJAB,KLOGAD,SPMU,'S' KD FROM PERS_JABATAN_HIST WHERE NRK='".$NRK."' AND TMT = (SELECT MAX(TMT) FROM PERS_JABATAN_HIST WHERE NRK='".$NRK."')
                                    UNION
                                    SELECT NRK,TMT,KOLOK,KOJAB,KLOGAD,SPMU,'F' KD FROM PERS_JABATANF_HIST 
                                    WHERE NRK='".$NRK."' AND TMT = (SELECT MAX(TMT) FROM PERS_JABATANF_HIST WHERE NRK='".$NRK."')
                                    ) JAB 
                                    WHERE KOLOK<>'111111114' AND KOJAB <>'999914'";

            $exGet = $this->db->query($getDataBfHukuman);

                if($exGet){
                    
                    $exGett = $exGet->row();

                    $peg['kd'] = $exGett->KD;
                    $peg['kolok'] = $exGett->KOLOK;
                    $peg['kojab'] = $exGett->KOJAB;
                    $peg['klogad'] = $exGett->KLOGAD;
                    $peg['tmt'] = $exGett->TMT;
                    $peg['user_id'] = $this->session->userdata('logged_in')['id'];
                    $termt = $this->input->ip_address();
                    if($termt == '0.0.0.0') {
                        $ip = explode(',', $_SERVER['REMOTE_ADDR']);
                        $termt = $ip[0];
                    }
                    $peg['term']=$termt;
                $this->updatePegawai1($NRK, $peg);

                }
                else
                {
                    echo "no";
                }

        } //end if hukdis 12

        $user_id       = $this->session->userdata('logged_in')['id'];
        $qi="INSERT INTO DEL_PERS_DISIPLIN_HIST A
            (
            SELECT 
                NRK,
                TGSK,
                NOSK,
                JENHUKDIS,
                TGMULAI,
                TGAKHIR,
                PEJTT,
                USER_ID,
                TERM,
                TG_UPD,
                TMTMULAI_STOPTKD,
                TMTAKHIR_STOPTKD,
                KET,
                JMLBLN_STOPTKD,
                STATUS_AKTIF,
                JENIS_SK,
                SYSDATE AS DELETE_DATE,
                '$user_id' AS DELETE_BY
            FROM PERS_DISIPLIN_HIST D
            WHERE D.NRK = '".$NRK."' AND D.TGSK =TO_DATE('".$TGSK."', 'YY-MM-DD')
            )";
        $rsi=$this->db->query($qi);

        $sql = "DELETE FROM PERS_DISIPLIN_HIST WHERE NRK = '".$NRK."' AND TGSK =TO_DATE('".$TGSK."', 'YY-MM-DD')"; 

        $id = $this->db->query($sql);
        return $id;
    }

    public function cekWaktuHukdis()
    {
        $sql = "SELECT NRK, TGAKHIR FROM PERS_DISIPLIN_HIST WHERE NRK = '178090' AND TGAKHIR > SYSDATE ";

        $query = $this->db->query($sql)->row();

        return $query;
    }
/*END HUKDIS*/

/*START HUKADMIN*/
    public function save_hukadmin($data)
    {
        $NRK = $this->input->post('nrk');
        $TGSK = $this->input->post('tgsk');
        
        $NOSK = $this->input->post('nosk');
        $JENHUKADM = $this->input->post('jenhukadm');

        $TGMULAI = $this->input->post('tgmulai');
        $TGAKHIR = $this->input->post('tgakhir');
        $TMTMULAI_STOPTKD = $this->input->post('mulaistoptkd');
        $TMTAKHIR_STOPTKD = $this->input->post('akhirstoptkd');
        $JMLBLN_STOPTKD = ($this->input->post('blnstoptkd')=="")?0:$this->input->post('blnstoptkd');
        $KET = $this->input->post('ket');
        
        $PEJTT = $this->input->post('pejtt');
        
        
        $USER_ID = $data['user_id'];
        $term = $this->input->ip_address();
        if($term == '0.0.0.0') {
            $ip = explode(',', $_SERVER['REMOTE_ADDR']);
            $term = $ip[0];
        }

        $cek="SELECT * FROM PERS_ADMIN_HIST WHERE NRK='".$NRK."' AND TGSK=TO_DATE('".$TGSK."','DD-MM-YYYY')";
        $excek = $this->db->query($cek);
        $num = $excek->num_rows();
        $id="";
        if($num == 0)
        {
            
                $sql = "INSERT INTO PERS_ADMIN_HIST(
                    NRK,TGSK,NOSK,JENHUKADM,PEJTT,USER_ID,TERM,TG_UPD,
                    TGMULAI,TGAKHIR,TMTMULAI_STOPTKD, TMTAKHIR_STOPTKD,JMLBLN_STOPTKD,KET
                    ) VALUES (
                    '".$NRK."',TO_DATE('".$TGSK."', 'DD-MM-YYYY'),'".$NOSK."',".$JENHUKADM.",".$PEJTT.",'".$USER_ID."','".$term."', SYSDATE,
                    TO_DATE('".$TGMULAI."', 'DD-MM-YYYY'),TO_DATE('".$TGAKHIR."', 'DD-MM-YYYY'),TO_DATE('".$TMTMULAI_STOPTKD."', 'DD-MM-YYYY'),TO_DATE('".$TMTAKHIR_STOPTKD."', 'DD-MM-YYYY'),".$JMLBLN_STOPTKD.",UPPER('".$KET."')
                    )";
            
          
            $id = $this->db->query($sql);
        }
    
        
        return $id;
    }

    public function update_hukadmin($data)
    {
            $NRK = $this->input->post('nrk');
            $TGSK = $this->input->post('tgsk');
            $NOSK = $this->input->post('nosk');
            $JENHUKADM = $this->input->post('jenhukadm');

            $TGMULAI = $this->input->post('tgmulai');
            $TGAKHIR = $this->input->post('tgakhir');
            $PEJTT = $this->input->post('pejtt');
            $TMTMULAI_STOPTKD = $this->input->post('mulaistoptkd');
            $TMTAKHIR_STOPTKD = $this->input->post('akhirstoptkd');
            $JMLBLN_STOPTKD = $this->input->post('blnstoptkd');
            $KET = $this->input->post('ket');
            
            $USER_ID = $data['user_id'];
            $term = $this->input->ip_address();
            if($term == '0.0.0.0') {
            $ip = explode(',', $_SERVER['REMOTE_ADDR']);
            $term = $ip[0];
        }
        
            $sql = "UPDATE PERS_ADMIN_HIST SET
                    NOSK = '".$NOSK."', JENHUKADM = '".$JENHUKADM."', PEJTT = '".$PEJTT."', USER_ID = '".$USER_ID."', TERM = '".$term."',TG_UPD = SYSDATE,
                    TGMULAI = TO_DATE('".$TGMULAI."', 'DD-MM-YYYY'),TGAKHIR = TO_DATE('".$TGAKHIR."', 'DD-MM-YYYY'),
                    TMTMULAI_STOPTKD = TO_DATE('".$TMTMULAI_STOPTKD."', 'DD-MM-YYYY'),TMTAKHIR_STOPTKD = TO_DATE('".$TMTAKHIR_STOPTKD."', 'DD-MM-YYYY'),
                    JMLBLN_STOPTKD = '".$JMLBLN_STOPTKD."',KET = UPPER('".$KET."')
                    WHERE NRK = '".$NRK."' AND TGSK = TO_DATE('".$TGSK."', 'DD-MM-YYYY')
                    ";
            /*$sql = "UPDATE PERS_ADMIN_HIST SET
                    NOSK = '".$NOSK."', JENHUKADM = '".$JENHUKADM."', PEJTT = '".$PEJTT."', USER_ID = '".$USER_ID."', TERM = '".$term."',TG_UPD = SYSDATE,
                    TGMULAI = TO_DATE('".$TGMULAI."', 'DD-MM-YYYY'),TGAKHIR = TO_DATE('".$TGAKHIR."', 'DD-MM-YYYY')
                    WHERE NRK = '".$NRK."' AND TGSK = TO_DATE('".$TGSK."', 'DD-MM-YYYY')
                    ";*/
        //echo $sql;
        
        $id = $this->db->query($sql);
        return $id;
    }

    public function delete_flag_hukadmin($NRK,$TGSK){
        $sql = "UPDATE PERS_ADMIN_HIST SET DELETED='Y' WHERE NRK = '".$NRK."' AND TGSK =TO_DATE('".$TGSK."', 'DD-MM-YYYY')"; 

        $id = $this->db->query($sql);
        return $id;
    }

    public function delete_hukadmin($NRK,$TGSK){
        $user_id       = $this->session->userdata('logged_in')['id'];
        $qi="INSERT INTO DEL_PERS_ADMIN_HIST A
            (
            SELECT 
                NRK,
                TGSK,
                NOSK,
                JENHUKADM,
                PEJTT,
                USER_ID,
                TERM,
                TG_UPD,
                SYSDATE AS DELETE_DATE,
                'bkd' AS DELETE_BY,
               TGMULAI,
               TGAKHIR,
                TMTMULAI_STOPTKD,TMTAKHIR_STOPTKD,KET,JMLBLN_STOPTKD
            FROM PERS_ADMIN_HIST D
            WHERE D.NRK = '".$NRK."' AND D.TGSK =TO_DATE('".$TGSK."', 'YYYY-MM-DD')
            )";
            
        $rsi=$this->db->query($qi);

        $sql = "DELETE FROM PERS_ADMIN_HIST WHERE NRK = '".$NRK."' AND TGSK =TO_DATE('".$TGSK."', 'YYYY-MM-DD')"; 

        $id = $this->db->query($sql);
        return $id;
    }
/*END HUKADMIN*/

/*START DP3*/
    public function save_dp3($data)
    {
        $NRK = $this->input->post('nrk');
        $TAHUN = $this->input->post('tahun');
        $SETIA = $this->input->post('setia');
        $PRESTASI = $this->input->post('prestasi');
        $TGGJAWAB = $this->input->post('tggjawab');
        $TAAT = $this->input->post('taat');
        $JUJUR = $this->input->post('jujur');
        $KERJASAMA = $this->input->post('kerjasama');
        $PRAKARSA = $this->input->post('prakarsa');
        $PIMPIN = $this->input->post('pimpin');
        $JUMLAH = $this->input->post('jumlah');
        $RATA = $this->input->post('rata');    
        
        $USER_ID = $data['user_id'];
        $term = $this->input->ip_address();
        if($term == '0.0.0.0') {
            $ip = explode(',', $_SERVER['REMOTE_ADDR']);
            $term = $ip[0];
        }
    
        $sql = "INSERT INTO PERS_DP3(NRK, TAHUN, SETIA, PRESTASI, TGGJAWAB, TAAT, JUJUR, KERJASAMA, PRAKARSA, PIMPIN, JUMLAH, RATA, USER_ID, TERM, TG_UPD) 
                VALUES ('".$NRK."','".$TAHUN."',".$SETIA.",".$PRESTASI.",".$TGGJAWAB.",".$TAAT.",".$JUJUR.",".$KERJASAMA.",".$PRAKARSA.",".$PIMPIN.",".$JUMLAH.",".$RATA.",
                '".$USER_ID."','".$term."', SYSDATE)"; 
        
        $id = $this->db->query($sql);
        return $id;
    }

    public function update_dp3($data)
    {
        $NRK = $this->input->post('nrk');
        $TAHUN = $this->input->post('tahun');
        $SETIA = $this->input->post('setia');
        $PRESTASI = $this->input->post('prestasi');
        $TGGJAWAB = $this->input->post('tggjawab');
        $TAAT = $this->input->post('taat');
        $JUJUR = $this->input->post('jujur');
        $KERJASAMA = $this->input->post('kerjasama');
        $PRAKARSA = $this->input->post('prakarsa');
        $PIMPIN = $this->input->post('pimpin');
        $JUMLAH = $this->input->post('jumlah');
        $RATA = $this->input->post('rata');    
        
        $USER_ID = $data['user_id'];
        $term = $this->input->ip_address();
        if($term == '0.0.0.0') {
            $ip = explode(',', $_SERVER['REMOTE_ADDR']);
            $term = $ip[0];
        }
    
        $sql = "UPDATE PERS_DP3 SET SETIA = '".$SETIA."', PRESTASI = '".$PRESTASI."', TGGJAWAB = '".$TGGJAWAB."', TAAT = '".$TAAT."', JUJUR = '".$JUJUR."', KERJASAMA = '".$KERJASAMA."', 
                PRAKARSA = '".$PRAKARSA."', PIMPIN = '".$PIMPIN."', JUMLAH = '".$JUMLAH."', RATA = '".$RATA."', USER_ID = '".$USER_ID."', TERM = '".$term."', TG_UPD = SYSDATE
                WHERE NRK = '".$NRK."' AND TAHUN = '".$TAHUN."'
                "; 
        
        $id = $this->db->query($sql);
        return $id;
    }

    public function delete_flag_dp3($NRK,$TAHUN){
        $sql = "UPDATE PERS_DP3 SET DELETED='Y' WHERE NRK = '".$NRK."' AND TAHUN = '".$TAHUN."'"; 

        $id = $this->db->query($sql);
        return $id;
    }

    public function delete_dp3($NRK,$TAHUN){
        $user_id       = $this->session->userdata('logged_in')['id'];
        $qi="INSERT INTO DEL_PERS_DP3 A
            (
            SELECT 
                NRK,
                TAHUN,
                SETIA,
                PRESTASI,
                TGGJAWAB,
                TAAT,
                JUJUR,
                KERJASAMA,
                PRAKARSA,
                PIMPIN,
                JUMLAH,
                RATA,
                USER_ID,
                TERM,
                TG_UPD,
                SYSDATE AS DELETE_DATE,
                '$user_id' AS DELETE_BY
            FROM PERS_DP3 D
            WHERE D.NRK = '".$NRK."' AND D.TAHUN = '".$TAHUN."'
            )";
        $rsi=$this->db->query($qi);

        $sql = "DELETE FROM PERS_DP3 WHERE NRK = '".$NRK."' AND TAHUN = '".$TAHUN."'"; 

        $id = $this->db->query($sql);
        return $id;
    }
/*END DP3*/

    /*START SKP*/
    public function save_skp($data)
    {
        

        $NRK = $this->input->post('nrk');
        $TAHUN = $this->input->post('tahun');
        $NRKPP = $this->input->post('nrkpp');
        $NRKPPtemp = $this->input->post('nrkpptemp');
        $NRKAPP = $this->input->post('nrkapp');
        $NRKAPPtemp = $this->input->post('nrkapptemp');
        $NILAI_SKP = $this->input->post('nilai_skp');
        $INPUT_SKP = $this->input->post('input_skp');
        $PELAYANAN = $this->input->post('pelayanan');
        $INTEGRITAS = $this->input->post('integritas');
        $KOMITMEN = $this->input->post('komitmen');
        $DISIPLIN = $this->input->post('disiplin');
        $KERJASAMA = $this->input->post('kerjasama');
        $KEPEMIMPINAN = $this->input->post('kepemimpinan');
        $JUMLAH = $this->input->post('jumlah');
        $RATA = $this->input->post('rata2');   
        $PRESTASI = $this->input->post('nilai_prestasi'); 
        $NPK = $this->input->post('nilai_perilaku');
        
        $USER_ID = $data['user_id'];
        

        $sqlcek = "SELECT * FROM PERS_SKP WHERE NRK='$NRK' and TAHUN ='$TAHUN'";
        $querycek = $this->db->query($sqlcek);
        $numcek = $querycek->num_rows();

        if($numcek>0)
        {
            $id="WARNING";
        }
        else
        {
            $sql = "INSERT INTO PERS_SKP(NRK, TAHUN, PELAYANAN, INTEGRITAS, KOMITMEN, DISIPLIN, KERJASAMA, KEPEMIMPINAN, JUMLAH, RATA2, NILAI_SKP, NILAI_PERILAKU, NILAI_PRESTASI, STATUS_VALIDASI, USERID_INPUT, TGUPD_INPUT, NRK_PEJABAT_PENILAI,NRK_ATASAN_PEJABAT_PENILAI,INPUT_SKP) 
                VALUES ('".$NRK."','".$TAHUN."',".$PELAYANAN.",".$INTEGRITAS.",".$KOMITMEN.",".$DISIPLIN.",".$KERJASAMA.",".$KEPEMIMPINAN.",".$JUMLAH.",".$RATA.",".$NILAI_SKP.",".$NPK.",".$PRESTASI.",'0',
                '".$USER_ID."', SYSDATE,'$NRKPPtemp','$NRKAPPtemp','$INPUT_SKP')"; 
            //die($sql);
            $query = $this->db->query($sql);

            if($query)
            {
                $id="SUCCESS";
            }
            else
            {
                $id="ERROR";
            }
        }
        //var_dump($id);
        
        //die($sql);
        
        return $id;
    }

    public function update_skp($data)
    {
        

        if($this->input->post('validator') != null)
        {
            $validator = $this->input->post('validator');
            $stat_validasi = $this->input->post('stat_validasi');
        }

        $NRK = $this->input->post('nrk');
        $TAHUN = $this->input->post('tahun');
        $NRKPP = $this->input->post('nrkpp');
        $NRKPPtemp = $this->input->post('nrkpptemp');
        $NRKAPP = $this->input->post('nrkapp');
        $NRKAPPtemp = $this->input->post('nrkapptemp');
        $NILAI_SKP = $this->input->post('nilai_skp');
        $INPUT_SKP = $this->input->post('input_skp');
        $PELAYANAN = $this->input->post('pelayanan');
        $INTEGRITAS = $this->input->post('integritas');
        $KOMITMEN = $this->input->post('komitmen');
        $DISIPLIN = $this->input->post('disiplin');
        $KERJASAMA = $this->input->post('kerjasama');
        $KEPEMIMPINAN = $this->input->post('kepemimpinan');
        $JUMLAH = $this->input->post('jumlah');
        $RATA = $this->input->post('rata2');   
        $PRESTASI = $this->input->post('nilai_prestasi'); 
        $NPK = $this->input->post('nilai_perilaku');
        
        $USER_ID = $data['user_id'];
        

        if($NRKPPtemp == "")
        {
            $NRKPPFIX = $NRKPP;
        }
        else
        {
            $NRKPPFIX = $NRKPPtemp;
        }

        if($NRKAPPtemp == "")
        {
            $NRKAPPFIX = $NRKAPP;
        }
        else
        {
            $NRKAPPFIX = $NRKAPPtemp;
        }
/*
        var_dump($NRKAPP);
        var_dump($NRKAPPtemp);exit;*/
        if($this->input->post('validator')!=null)
        {
            $sql = "UPDATE PERS_SKP SET  PELAYANAN = '$PELAYANAN', INTEGRITAS = '$INTEGRITAS', KOMITMEN = '$KOMITMEN', DISIPLIN = '$DISIPLIN', 
                KERJASAMA = '$KERJASAMA', KEPEMIMPINAN = '$KEPEMIMPINAN', JUMLAH = '$JUMLAH', RATA2 = '".$RATA."', NILAI_SKP = '$NILAI_SKP', NILAI_PERILAKU = '$NPK', NILAI_PRESTASI='$PRESTASI', STATUS_VALIDASI = '$stat_validasi',USERID_VALIDASI = '".$validator."',TGUPD_VALIDASI=SYSDATE,NRK_PEJABAT_PENILAI='$NRKPPFIX',NRK_ATASAN_PEJABAT_PENILAI = '$NRKAPPFIX',INPUT_SKP = '$INPUT_SKP'
                WHERE NRK = '".$NRK."' AND TAHUN = '".$TAHUN."'
                ";     
        }
        else
        {
            $sql = "UPDATE PERS_SKP SET  PELAYANAN = '$PELAYANAN', INTEGRITAS = '$INTEGRITAS', KOMITMEN = '$KOMITMEN', DISIPLIN = '$DISIPLIN', 
                KERJASAMA = '$KERJASAMA', KEPEMIMPINAN = '$KEPEMIMPINAN', JUMLAH = '$JUMLAH', RATA2 = '".$RATA."', NILAI_SKP = '$NILAI_SKP', NILAI_PERILAKU = '$NPK', NILAI_PRESTASI='$PRESTASI', STATUS_VALIDASI = '0',USERID_INPUT = '".$USER_ID."',TGUPD_INPUT=SYSDATE,NRK_PEJABAT_PENILAI='$NRKPPFIX',NRK_ATASAN_PEJABAT_PENILAI = '$NRKAPPFIX',INPUT_SKP = '$INPUT_SKP'
                WHERE NRK = '".$NRK."' AND TAHUN = '".$TAHUN."'
                ";     
        }
        
        
        
        $id = $this->db->query($sql);
        return $id;
    }

    public function delete_flag_skp($NRK,$TAHUN){
        $sql = "UPDATE PERS_DP3 SET DELETED='Y' WHERE NRK = '".$NRK."' AND TAHUN = '".$TAHUN."'"; 

        $id = $this->db->query($sql);
        return $id;
    }

    public function delete_skp($NRK,$TAHUN){
        $user_id       = $this->session->userdata('logged_in')['id'];
        $qi="INSERT INTO DEL_PERS_SKP A
            (
            SELECT 
                SYSDATE AS DELETE_DATE,
                '$user_id' AS DELETE_BY,
                NRK,
                TAHUN,
                PELAYANAN,
                INTEGRITAS,
                KOMITMEN,
                DISIPLIN,
                KERJASAMA,
                KEPEMIMPINAN,
                JUMLAH,
                RATA2,
                NILAI_SKP,
                NILAI_PERILAKU,
                NILAI_PRESTASI,
                STATUS_VALIDASI,
                USERID_INPUT,
                TGUPD_INPUT,
                USERID_VALIDASI,
                TGUPD_VALIDASI,
                NRK_PEJABAT_PENILAI,
                NRK_ATASAN_PEJABAT_PENILAI,
                INPUT_SKP
                
                
            FROM PERS_SKP D
            WHERE D.NRK = '".$NRK."' AND D.TAHUN = '".$TAHUN."'
            )";
        $rsi=$this->db->query($qi);

        $sql = "DELETE FROM PERS_SKP WHERE NRK = '".$NRK."' AND TAHUN = '".$TAHUN."'"; 

        $id = $this->db->query($sql);
        return $id;
    }
/*END skp*/

/*START ABSENSI*/
    public function save_absensi($data)
    {
            $NRK = $this->input->post('nrk');
            $tempTHBL = $this->input->post('thbl');
            $THBL = date('Ym',strtotime($tempTHBL));
            $NIP18 = $this->input->post('nip18');
            $NAMA_ABS = $this->input->post('nama_abs');
            $KLOGAD = $this->input->post('klogad');
            $NAKLOGAD = $this->input->post('naklogad');
            $NAGOL = $this->input->post('nagol');
            $ALFA = $this->input->post('alfa');
            $IZIN = $this->input->post('izin');
            $SAKIT = $this->input->post('sakit');
            $CUTI = $this->input->post('cuti');
            $JAMTERLAMBAT = $this->input->post('jamterlambat');
            $JAMPULANGCEPAT = $this->input->post('jampulangcepat');
            $KINERJA = $this->input->post('kinerja');
            $PERIODE = $this->input->post('periode');
            $D_PROSES = $this->input->post('d_proses');
            $E_PROSES = $this->input->post('e_proses');
            $CUTIAPENTING = $this->input->post('cutiapenting');
            $CUTIBESAR = $this->input->post('cutibesar');
            $CUTISAKIT = $this->input->post('cutisakit');
            $CUTIBERSALIN = $this->input->post('cutibersalin');

            $sql = "INSERT INTO PERS_TUNDA_ABSENSI(THBL,NRK,NIP18,NAMA_ABS,KLOGAD,NAKLOGAD,NAGOL,ALFA,IZIN,SAKIT,CUTI,
                JAMTERLAMBAT,JAMPULANGCEPAT,KINERJA,PERIODE,D_PROSES,E_PROSES,CUTIAPENTING,CUTIBESAR,CUTISAKIT,CUTIBERSALIN) 
                VALUES ('".$THBL."','".$NRK."','".$NIP18."','".$NAMA_ABS."','".$KLOGAD."','".$NAKLOGAD."','".$NAGOL."',
                    ".$ALFA.",".$IZIN.",".$SAKIT.",".$CUTI.",".$JAMTERLAMBAT.",".$JAMPULANGCEPAT.",".$KINERJA.",".$PERIODE.",TO_DATE('".$D_PROSES."', 'DD-MM-YYYY'),'".$E_PROSES."',".$CUTIAPENTING.",".$CUTIBESAR.",".$CUTISAKIT.",".$CUTIBERSALIN.")"; 
                        

        $id = $this->db->query($sql);
        return $id;
    }

    public function update_absensi($data)
    {
            $NRK = $this->input->post('nrk');
            $tempTHBL = $this->input->post('thbl');
                $THBL = date('Ym',strtotime($tempTHBL));
            $NIP18 = $this->input->post('nip18');
            $NAMA_ABS = $this->input->post('nama_abs');
            $KLOGAD = $this->input->post('klogad');
            $NAKLOGAD = $this->input->post('naklogad');
            $NAGOL = $this->input->post('nagol');
            $ALFA = $this->input->post('alfa');
            $IZIN = $this->input->post('izin');
            $SAKIT = $this->input->post('sakit');
            $CUTI = $this->input->post('cuti');
            $JAMTERLAMBAT = $this->input->post('jamterlambat');
            $JAMPULANGCEPAT = $this->input->post('jampulangcepat');
            $KINERJA = $this->input->post('kinerja');
            $PERIODE = $this->input->post('periode');
            $D_PROSES = $this->input->post('d_proses');
            $E_PROSES = $this->input->post('e_proses');
            $CUTIAPENTING = $this->input->post('cutiapenting');
            $CUTIBESAR = $this->input->post('cutibesar');
            $CUTISAKIT = $this->input->post('cutisakit');
            $CUTIBERSALIN = $this->input->post('cutibersalin');

            $sql = "UPDATE PERS_TUNDA_ABSENSI SET NIP18 = '".$NIP18."', NAMA_ABS = '".$NAMA_ABS."', KLOGAD = '".$KLOGAD."', NAKLOGAD = '".$NAKLOGAD."', NAGOL = '".$NAGOL."',
                    ALFA = '".$ALFA."', IZIN = '".$IZIN."', SAKIT = '".$SAKIT."', CUTI = '".$CUTI."', JAMTERLAMBAT = '".$JAMTERLAMBAT."', JAMPULANGCEPAT = '".$JAMPULANGCEPAT."', 
                    KINERJA = '".$KINERJA."', PERIODE = '".$PERIODE."', D_PROSES = TO_DATE('".$D_PROSES."', 'DD-MM-YYYY'), E_PROSES = '".$E_PROSES."', CUTIAPENTING = '".$CUTIAPENTING."', CUTIBESAR = '".$CUTIBESAR."',
                    CUTISAKIT = '".$CUTISAKIT."',CUTIBERSALIN = '".$CUTIBERSALIN."' 
                    WHERE NRK = '".$NRK."' AND THBL = '".$THBL."'
                ";                          
        
        $id = $this->db->query($sql);
        return $id;
    }

    public function delete_flag_absensi($NRK,$THBL){
        $sql = "UPDATE PERS_TUNDA_ABSENSI SET DELETED = 'Y' WHERE NRK = '".$NRK."' AND THBL = '".$THBL."'"; 

        $id = $this->db->query($sql);
        return $id;
    }

    public function delete_absensi($NRK,$THBL){
        $user_id       = $this->session->userdata('logged_in')['id'];
        $qi="INSERT INTO DEL_PERS_TUNDA_ABSENSI A
            (
            SELECT 
                THBL,
                NRK,
                NIP18,
                NAMA_ABS,
                KLOGAD,
                NAKLOGAD,
                NAGOL,
                ALFA,
                IZIN,
                SAKIT,
                CUTI,
                JAMTERLAMBAT,
                JAMPULANGCEPAT,
                KINERJA,
                PERIODE,
                D_PROSES,
                E_PROSES,
                CUTIAPENTING,
                CUTIBESAR,
                CUTISAKIT,
                CUTIBERSALIN,
                SYSDATE AS DELETE_DATE,
                '$user_id' AS DELETE_BY
            FROM PERS_TUNDA_ABSENSI D
            WHERE D.NRK = '".$NRK."' AND D.THBL = '".$THBL."'
            )";
        $rsi=$this->db->query($qi);

        $sql = "DELETE FROM PERS_TUNDA_ABSENSI WHERE NRK = '".$NRK."' AND THBL = '".$THBL."'"; 

        $id = $this->db->query($sql);
        return $id;
    }

/*END ABSENSI*/

/*START CUTI*/

    function getDataCuti($id,$id2)
    {
        $sql = "SELECT NRK FROM PERS_CUTI_HIST WHERE 
                NRK = '".$id."' AND 
                TMT = TO_DATE('".$id2."', 'DD-MM-YYYY') ";        

        $query = $this->db->query($sql);            
   
        return $query;
    }

    public function save_cuti($data)
    {
            $NRK = $this->input->post('nrk');
            $TMT = $this->input->post('tmt');
            $JENCUTI = $this->input->post('jencuti');
            $TGAKHIR = $this->input->post('tgakhir');
            $JENSK = $this->input->post('jensk');
            $NOSK = $this->input->post('nosk');
            $TGSK = $this->input->post('tgsk');
            $PEJTT = $this->input->post('pejtt');

            $USER_ID = $data['user_id'];
            
            $term=$this->input->ip_address();
            if($term == '0.0.0.0') {
            $ip = explode(',', $_SERVER['REMOTE_ADDR']);
            $term = $ip[0];
        }

            $cek = $this->getDataCuti($NRK,$TMT)->num_rows();

            if($cek == 0)
            {
                $sql = "INSERT INTO PERS_CUTI_HIST(NRK,TMT,JENCUTI,TGAKHIR,NOSK,TGSK,PEJTT,USER_ID,TERM,TG_UPD,JENIS_SK) 
                VALUES ('".$NRK."',TO_DATE('".$TMT."', 'DD-MM-YYYY'),'".$JENCUTI."',TO_DATE('".$TGAKHIR."', 'DD-MM-YYYY'),UPPER('".$NOSK."'),TO_DATE('".$TGSK."', 'DD-MM-YYYY'),'".$PEJTT."',
                    '".$USER_ID."','".$term."',SYSDATE,'".$JENSK."')"; 
        
                $id = $this->db->query($sql);

                if($JENCUTI == 6)
                {

                    $getpangkattrkhr = "SELECT KOPANG FROM PERS_PANGKAT_HIST 
                                        WHERE TMT = (
                                            SELECT
                                                MAX (tmt)
                                            FROM
                                                PERS_PANGKAT_HIST
                                            WHERE
                                                nrk = '".$NRK."'
                                        )
                                        AND
                                        nrk = '".$NRK."'";
                    $gtpgkt = $this->db->query($getpangkattrkhr)->row();

                    $valKopang = $gtpgkt->KOPANG;

                    $insertJabHist = "INSERT INTO PERS_JABATAN_HIST(NRK,TMT,KOLOK,KOJAB,KDSORT,TGAKHIR,KOPANG,ESELON,PEJTT,NOSK,TGSK,KREDIT,STATUS,USER_ID,TERM,TG_UPD,CKOJABF,KLOGAD,SPMU,TMTPENSIUN,NESELON2,JENIS_SK) 
                    VALUES ('".$NRK."',TO_DATE('".$TMT."', 'DD-MM-YYYY'),'111111115','999915','3','','".$valKopang."','00',".$PEJTT.",UPPER(
                      '".$NOSK."'),TO_DATE('".$TGSK."', 'DD-MM-YYYY'),0,0,'".$USER_ID."','".$term."', SYSDATE,'','111111115','','','','')
                    ";

                    $exInsert= $this->db->query($insertJabHist);


                    if($exInsert){
                        
                    $this->updatekepeg1($NRK,'111111115','111111115','999915');
                    }
                }
            }
            else
            {
                $id=false;
            }


            
        return $id;
    }

    public function update_cuti($data)
    {
            $NRK = $this->input->post('nrk');
            $TMT = $this->input->post('tmt');
            $JENCUTI = $this->input->post('jencuti');
            $TGAKHIR = $this->input->post('tgakhir');
            $JENSK = $this->input->post('jensk');
            $NOSK = $this->input->post('nosk');
            $TGSK = $this->input->post('tgsk');
            $PEJTT = $this->input->post('pejtt');

            $USER_ID = $data['user_id'];
          
            $term=$this->input->ip_address();
            if($term == '0.0.0.0') {
            $ip = explode(',', $_SERVER['REMOTE_ADDR']);
            $term = $ip[0];
        }

            $cek = $this->getDataCuti($NRK,$TMT)->num_rows();

            if($cek == 1)
            {
                $sql = "UPDATE PERS_CUTI_HIST SET JENCUTI = '".$JENCUTI."', TGAKHIR = TO_DATE('".$TGAKHIR."', 'DD-MM-YYYY'), NOSK = UPPER('".$NOSK."'), TGSK = TO_DATE('".$TGSK."', 'DD-MM-YYYY'), PEJTT = '".$PEJTT."', 
                        USER_ID = '".$USER_ID."', TERM = '".$term."', TG_UPD = SYSDATE, JENIS_SK='".$JENSK."'
                        WHERE NRK = '".$NRK."' AND TMT = TO_DATE('".$TMT."', 'DD-MM-YYYY')"; 
            
                $id = $this->db->query($sql);

                 if($JENCUTI == 6)
                {

                    $getpangkattrkhr = "SELECT KOPANG FROM PERS_PANGKAT_HIST 
                                        WHERE TMT = (
                                            SELECT
                                                MAX (tmt)
                                            FROM
                                                PERS_PANGKAT_HIST
                                            WHERE
                                                nrk = '".$NRK."'
                                        )
                                        AND
                                        nrk = '".$NRK."'";
                    $gtpgkt = $this->db->query($getpangkattrkhr)->row();

                    $valKopang = $gtpgkt->KOPANG;

                    $cek="SELECT * FROM PERS_JABATAN_HIST WHERE NRK='".$NRK."' AND TMT=TO_DATE('".$TMT."','DD-MM-YYYY')AND KOLOK='111111115' AND KOJAB ='999915'";
                    $cekk = $this->db->query($cek);

                    $insertJabHist="";

                    if($cekk->num_rows() == 0)
                    {
                        $insertJabHist = "INSERT INTO PERS_JABATAN_HIST(NRK,TMT,KOLOK,KOJAB,KDSORT,TGAKHIR,KOPANG,ESELON,PEJTT,NOSK,TGSK,KREDIT,STATUS,USER_ID,TERM,TG_UPD,CKOJABF,KLOGAD,SPMU,TMTPENSIUN,NESELON2,JENIS_SK) 
                        VALUES ('".$NRK."',TO_DATE('".$TMT."', 'DD-MM-YYYY'),'111111115','999915','3','','".$valKopang."','00',".$PEJTT.",UPPER(
                          '".$NOSK."'),TO_DATE('".$TGSK."', 'DD-MM-YYYY'),0,0,'".$USER_ID."','".$term."', SYSDATE,'','111111115','','','','')
                        ";

                       
                    }
                    else
                    {
                        $insertJabHist = "UPDATE PERS_JABATAN_HIST 
                                        SET KOPANG = '".$valKopang."',  
                                            KOLOK = '111111115',  
                                            KOJAB = '999915',  
                                            KLOGAD = '111111115',  SPMU = '',
                                            ESELON = '00',  PEJTT = '".$PEJTT."',
                                            NOSK = UPPER('".$NOSK."'), TGSK = TO_DATE('".$TGSK."', 'DD-MM-YYYY'), KREDIT = 0, USER_ID = '".$USER_ID."', TERM = '".$term."',TG_UPD=SYSDATE
                                             
                                        WHERE NRK = '".$NRK."' 
                                        AND TMT = TO_DATE('".$TMT."', 'DD-MM-YY') 
                                        AND KOLOK = '111111115' 
                                        AND KOJAB = '999915'"; 
                    }
                    //var_dump($insertJabHist);
                     $exInsert= $this->db->query($insertJabHist);    


                    if($exInsert){
                        $this->updatekepeg1($NRK,'111111115','111111115','999915');
                    }
                }
            }
            else
            {
                $id=false;
            }
        return $id;
    }

    public function delete_flag_cuti($NRK,$TMT){
        $sql = "UPDATE PERS_CUTI_HIST SET DELETED='Y' WHERE NRK = '".$NRK."' AND TMT = TO_DATE('".$TMT."', 'YY-MM-DD')"; 

        $id = $this->db->query($sql);
        return $id;
    }

    public function delete_cuti($NRK,$TMT){
        $user_id       = $this->session->userdata('logged_in')['id'];
        $qi="INSERT INTO DEL_PERS_CUTI_HIST A
            (
            SELECT 
                NRK,
                TMT,
                JENCUTI,
                TGAKHIR,
                NOSK,
                TGSK,
                PEJTT,
                USER_ID,
                TERM,
                TG_UPD,
                JENIS_SK,
                SYSDATE AS DELETE_DATE,
                '$user_id' AS DELETE_BY
            FROM PERS_CUTI_HIST D
            WHERE D.NRK = '".$NRK."' AND D.TMT = TO_DATE('".$TMT."', 'YY-MM-DD')
            )";
        $rsi=$this->db->query($qi);

        $sql = "DELETE FROM PERS_CUTI_HIST WHERE NRK = '".$NRK."' AND TMT = TO_DATE('".$TMT."', 'YY-MM-DD')"; 

        $id = $this->db->query($sql);
        return $id;
    }
/*END CUTI*/

/*START BATASAN*/
    public function save_batasan($data)
    {
        $NRK = $this->input->post('nrk');
        $TMT = $this->input->post('tmt');
        $JENUSAHA = $this->input->post('jenusaha');
        $TGSIZIN = $this->input->post('tgsizin');
        $NOSIZIN = $this->input->post('nosizin');
        $TGAKHIR = $this->input->post('tgakhir');
        $PEJTT = $this->input->post('pejtt');

        $USER_ID=$data['user_id'];
       
        $term=$this->input->ip_address();
        if($term == '0.0.0.0') {
            $ip = explode(',', $_SERVER['REMOTE_ADDR']);
            $term = $ip[0];
        }

        $sql = "INSERT INTO PERS_PEMBATASAN(NRK,TMT,JENUSAHA,TGSIZIN,NOSIZIN,TGAKHIR,PEJTT,USER_ID,TERM,TG_UPD) 
                VALUES ('".$NRK."',TO_DATE('".$TMT."', 'DD-MM-YYYY'),'".$JENUSAHA."',TO_DATE('".$TGSIZIN."', 'DD-MM-YYYY'),'".$NOSIZIN."',TO_DATE('".$TGAKHIR."', 'DD-MM-YYYY'),'".$PEJTT."',
                '".$USER_ID."','".$term."',SYSDATE)"; 
        
        $id = $this->db->query($sql);
        return $id;
    }

    public function update_batasan($data)
    {
        $NRK = $this->input->post('nrk');
        $TMT = $this->input->post('tmt');
        $JENUSAHA = $this->input->post('jenusaha');
        $TGSIZIN = $this->input->post('tgsizin');
        $NOSIZIN = $this->input->post('nosizin');
        $TGAKHIR = $this->input->post('tgakhir');
        $PEJTT = $this->input->post('pejtt');

        $USER_ID=$data['user_id'];
      
        $term=$this->input->ip_address();
        if($term == '0.0.0.0') {
            $ip = explode(',', $_SERVER['REMOTE_ADDR']);
            $term = $ip[0];
        }

        $sql = "UPDATE PERS_PEMBATASAN SET JENUSAHA = '".$JENUSAHA."', TGSIZIN = TO_DATE('".$TGSIZIN."', 'DD-MM-YYYY'), NOSIZIN = '".$NOSIZIN."', TGAKHIR = TO_DATE('".$TGAKHIR."', 'DD-MM-YYYY'), 
                PEJTT = '".$PEJTT."', USER_ID = '".$USER_ID."', TERM = '".$term."', TG_UPD = SYSDATE
                WHERE NRK = '".$NRK."' AND TMT = TO_DATE('".$TMT."', 'DD-MM-YYYY')";
        
        $id = $this->db->query($sql);
        return $id;
    }

    public function delete_flag_batasan($NRK,$TMT){
        $sql = "UPDATE PERS_PEMBATASAN SET DELETED='Y' WHERE NRK = '".$NRK."' AND TMT = TO_DATE('".$TMT."', 'YY-MM-DD')"; 

        $id = $this->db->query($sql);
        return $id;
    }

    public function delete_batasan($NRK,$TMT){
        $user_id       = $this->session->userdata('logged_in')['id'];
        $qi="INSERT INTO DEL_PERS_PEMBATASAN A
            (
            SELECT 
                NRK,
                TMT,
                JENUSAHA,
                TGSIZIN,
                NOSIZIN,
                TGAKHIR,
                PEJTT,
                USER_ID,
                TERM,
                TG_UPD,
                SYSDATE AS DELETE_DATE,
                '$user_id' AS DELETE_BY
            FROM PERS_PEMBATASAN D
            WHERE D.NRK = '".$NRK."' AND D.TMT = TO_DATE('".$TMT."', 'YY-MM-DD')
            )";
        $rsi=$this->db->query($qi);

        $sql = "DELETE FROM PERS_PEMBATASAN WHERE NRK = '".$NRK."' AND TMT = TO_DATE('".$TMT."', 'YY-MM-DD')"; 

        $id = $this->db->query($sql);
        return $id;
    }
/*END BATASAN*/

/*START SEMINAR*/
    public function save_seminar($data)
    {
            $NRK = $this->input->post('nrk');
            $TGMULAI = $this->input->post('tgmulai');
            $TGSELESAI = $this->input->post('tgselesai');
            $NASEMI = $this->input->post('nasemi');
            $KDSEMI = $this->input->post('kdsemi');
            $KDTEMA = $this->input->post('kdtema');
            $BADAN = $this->input->post('badan');
            $TEMPAT = $this->input->post('tempat');
            $KDPERAN = $this->input->post('kdperan');

            $USER_ID=$data['user_id'];
           
            $term=$this->input->ip_address();
            if($term == '0.0.0.0') {
            $ip = explode(',', $_SERVER['REMOTE_ADDR']);
            $term = $ip[0];
        }

            $sql = "INSERT INTO PERS_SEMINAR_HIST(NRK,TGMULAI,TGSELESAI,NASEMI,KDSEMI,KDTEMA,BADAN,TEMPAT,KDPERAN,USER_ID,TERM,TG_UPD) 
                VALUES ('".$NRK."',TO_DATE('".$TGMULAI."', 'DD-MM-YYYY'),TO_DATE('".$TGSELESAI."', 'DD-MM-YYYY'),'".$NASEMI."',".$KDSEMI.",'".$KDTEMA."','".$BADAN."','".$TEMPAT."','".$KDPERAN."',
                    '".$USER_ID."','".$term."',SYSDATE)"; 
        
        $id = $this->db->query($sql);
        return $id;
    }

    public function update_seminar($data)
    {
            $NRK = $this->input->post('nrk');
            $TGMULAI = $this->input->post('tgmulai');
            $TGSELESAI = $this->input->post('tgselesai');
            $NASEMI = $this->input->post('nasemi');
            $KDSEMI = $this->input->post('kdsemi');
            $KDTEMA = $this->input->post('kdtema');
            $BADAN = $this->input->post('badan');
            $TEMPAT = $this->input->post('tempat');
            $KDPERAN = $this->input->post('kdperan');

            $USER_ID=$data['user_id'];
           
            $term=$this->input->ip_address();
            if($term == '0.0.0.0') {
            $ip = explode(',', $_SERVER['REMOTE_ADDR']);
            $term = $ip[0];
        }

            $sql = "UPDATE PERS_SEMINAR_HIST SET TGSELESAI = TO_DATE('".$TGSELESAI."', 'DD-MM-YYYY'), NASEMI = '".$NASEMI."', KDSEMI = '".$KDSEMI."', KDTEMA = '".$KDTEMA."', BADAN = '".$BADAN."', 
                    TEMPAT = '".$TEMPAT."', KDPERAN = '".$KDPERAN."', USER_ID = '".$USER_ID."', TERM = '".$term."', TG_UPD = SYSDATE
                    WHERE NRK = '".$NRK."' AND TGMULAI = TO_DATE('".$TGMULAI."', 'DD-MM-YYYY')"; 
        
        $id = $this->db->query($sql);
        return $id;
    }

    public function delete_flag_seminar($NRK,$TGMULAI){
        $sql = "UPDATE PERS_SEMINAR_HIST SET DELETED='Y' WHERE NRK = '".$NRK."' AND TGMULAI = TO_DATE('".$TGMULAI."', 'YY-MM-DD')"; 

        $id = $this->db->query($sql);
        return $id;
    }

    public function delete_seminar($NRK,$TGMULAI){
        $user_id       = $this->session->userdata('logged_in')['id'];
        $qi="INSERT INTO DEL_PERS_SEMINAR_HIST A
            (
            SELECT 
                NRK,
                TGMULAI,
                TGSELESAI,
                NASEMI,
                KDSEMI,
                KDTEMA,
                BADAN,
                TEMPAT,
                KDPERAN,
                USER_ID,
                TERM,
                TG_UPD,
                SYSDATE AS DELETE_DATE,
                '$user_id' AS DELETE_BY
            FROM PERS_SEMINAR_HIST D
            WHERE D.NRK = '".$NRK."' AND D.TGMULAI = TO_DATE('".$TGMULAI."', 'YY-MM-DD')
            )";
        $rsi=$this->db->query($qi);

        $sql = "DELETE FROM PERS_SEMINAR_HIST WHERE NRK = '".$NRK."' AND TGMULAI = TO_DATE('".$TGMULAI."', 'YY-MM-DD')"; 

        $id = $this->db->query($sql);
        return $id;
    }
/*END SEMINAR*/

/*START TULISAN*/
    public function save_tulisan($data)
    {
            $NRK = $this->input->post('nrk');
            $TGPUBLIK = $this->input->post('tgpublik');
            $MEDPUBLIK = $this->input->post('medpublik');
            $JUDUL = $this->input->post('judul');
            $KDSIFAT = $this->input->post('kdsifat');
            $KDTEMA = $this->input->post('kdtema');
            $KDPERAN = $this->input->post('kdperan');
            $KDLINGKUP = $this->input->post('kdlingkup');
            $KDJUMKATA = $this->input->post('kdjumkata');

            $USER_ID=$data['user_id'];
          
            $term=$this->input->ip_address();
            if($term == '0.0.0.0') {
            $ip = explode(',', $_SERVER['REMOTE_ADDR']);
            $term = $ip[0];
        }

            $sql = "INSERT INTO PERS_TULISAN_HIST(NRK,TGPUBLIK,MEDPUBLIK,JUDUL,KDSIFAT,KDTEMA,KDLINGKUP,KDJUMKATA,KDPERAN,USER_ID,TERM,TG_UPD) 
                VALUES ('".$NRK."',TO_DATE('".$TGPUBLIK."', 'DD-MM-YYYY'),'".$MEDPUBLIK."','".$JUDUL."',".$KDSIFAT.",'".$KDTEMA."','".$KDLINGKUP."','".$KDJUMKATA."','".$KDPERAN."',
                    '".$USER_ID."','".$term."',SYSDATE)"; 
        
        $id = $this->db->query($sql);
        return $id;
    }

    public function update_tulisan($data)
    {
            $NRK = $this->input->post('nrk');
            $TGPUBLIK = $this->input->post('tgpublik');
            $MEDPUBLIK = $this->input->post('medpublik');
            $JUDUL = $this->input->post('judul');
            $KDSIFAT = $this->input->post('kdsifat');
            $KDTEMA = $this->input->post('kdtema');
            $KDPERAN = $this->input->post('kdperan');
            $KDLINGKUP = $this->input->post('kdlingkup');
            $KDJUMKATA = $this->input->post('kdjumkata');

            $USER_ID=$data['user_id'];
           
            $term=$this->input->ip_address();
            if($term == '0.0.0.0') {
            $ip = explode(',', $_SERVER['REMOTE_ADDR']);
            $term = $ip[0];
        }

            $sql = "UPDATE PERS_TULISAN_HIST SET MEDPUBLIK = '".$MEDPUBLIK."', JUDUL = '".$JUDUL."', KDSIFAT = '".$KDSIFAT."', KDTEMA = '".$KDTEMA."', KDLINGKUP = '".$KDLINGKUP."', 
                    KDJUMKATA = '".$KDJUMKATA."', KDPERAN = '".$KDPERAN."', USER_ID = '".$USER_ID."', TERM = '".$term."', TG_UPD = SYSDATE
                    WHERE NRK = '".$NRK."' AND TGPUBLIK = TO_DATE('".$TGPUBLIK."', 'DD-MM-YYYY')"; 
        
        $id = $this->db->query($sql);
        return $id;
    }

    public function delete_flag_tulisan($NRK,$TGPUBLISH){
        $sql = "UPDATE PERS_TULISAN_HIST SET DELETED='Y' WHERE NRK = '".$NRK."' AND TGPUBLIK = TO_DATE('".$TGPUBLISH."', 'YY-MM-DD')"; 

        $id = $this->db->query($sql);
        return $id;
    }

    public function delete_tulisan($NRK,$TGPUBLISH){
        $user_id       = $this->session->userdata('logged_in')['id'];
        $qi="INSERT INTO DEL_PERS_TULISAN_HIST A
            (
            SELECT 
                NRK,
                TGPUBLIK,
                JUDUL,
                KDTEMA,
                KDSIFAT,
                MEDPUBLIK,
                KDLINGKUP,
                KDJUMKATA,
                KDPERAN,
                USER_ID,
                TERM,
                TG_UPD,                
                SYSDATE AS DELETE_DATE,
                '$user_id' AS DELETE_BY
            FROM PERS_TULISAN_HIST D
            WHERE D.NRK = '".$NRK."' AND D.TGPUBLIK = TO_DATE('".$TGPUBLISH."', 'YY-MM-DD')
            )";
        $rsi=$this->db->query($qi);

        $sql = "DELETE FROM PERS_TULISAN_HIST WHERE NRK = '".$NRK."' AND TGPUBLIK = TO_DATE('".$TGPUBLISH."', 'YY-MM-DD')"; 

        $id = $this->db->query($sql);
        return $id;
    }
/*END TULISAN*/

/*START TUPOKSI*/

    function getNextTupoksi(){
        $this->ekin = $this->ci->load->database('ekin234', TRUE);

        $sql = "SELECT MAX(tupoksi_id)+1 tupoksi_id FROM ref_tupoksi";
        $query = $this->ekin->query($sql)->row();            

        return $query->tupoksi_id;
    }



    public function save_tupoksi($data)
    {
            $this->ekin = $this->ci->load->database('ekin234', TRUE);

            $TUPOKSI_ID = $this->getNextTupoksi();
            $KOLOK = $this->input->post('kolok');
            $KOJAB = $this->input->post('kojab');
            $NO_URUT = $this->input->post('no_urut');
            $URAIAN = $this->input->post('uraian');
            $TAHUN = $this->input->post('tahun');
            $DASAR_HUKUM = $this->input->post('dasar_hukum');
            $AKTIF = $this->input->post('aktif');
            

            $sql = "INSERT INTO ref_tupoksi(tupoksi_id,kolok,kojab,no_urut,uraian,tahun,dasar_hukum,aktif) 
                VALUES (".$TUPOKSI_ID.",'".$KOLOK."','".$KOJAB."',".$NO_URUT.",'".$URAIAN."',".$TAHUN.",'".$DASAR_HUKUM."','".$AKTIF."')"; 
            
        $id = $this->ekin->query($sql);
        return $id;
    }

    public function update_tupoksi($data)
    {
           $this->ekin = $this->ci->load->database('ekin234', TRUE);

            $TUPOKSI_ID = $this->input->post('tupoksi_id');
            $KOLOK = $this->input->post('kolok');
            $KOJAB = $this->input->post('kojab');
            $NO_URUT = $this->input->post('no_urut');
            $URAIAN = $this->input->post('uraian');
            $TAHUN = $this->input->post('tahun');
            $DASAR_HUKUM = $this->input->post('dasar_hukum');
            $AKTIF = $this->input->post('aktif');

            $sql = "UPDATE ref_tupoksi SET kolok = '".$KOLOK."', kojab = '".$KOJAB."', no_urut = ".$NO_URUT.", uraian = '".$URAIAN."', tahun = ".$TAHUN.",
            dasar_hukum = '".$DASAR_HUKUM."', aktif = '".$AKTIF."' WHERE tupoksi_id = ".$TUPOKSI_ID.""; 
            
        $id = $this->ekin->query($sql);
        return $id;
    }

    public function delete_flag_tupoksi($tupoksi_id){
         $this->ekin = $this->ci->load->database('ekin234', TRUE);

        $sql = "UPDATE ref_tupoksi SET DELETED='Y' WHERE tupoksi_id = ".$tupoksi_id.""; 

        $id = $this->ekin->query($sql);
        return $id;
    }

    public function delete_tupoksi($tupoksi_id){
         $this->ekin = $this->ci->load->database('ekin234', TRUE);

        $sql = "DELETE FROM ref_tupoksi WHERE tupoksi_id = ".$tupoksi_id.""; 

        $id = $this->ekin->query($sql);
        return $id;
    }
/*END TUPOKSI*/

/*START ALAMAT*/

    function getDataAlamatHist($id,$id2){
        $sql = "SELECT NRK FROM PERS_ALAMAT_HIST WHERE 
                NRK = '".$id."' AND 
                TGMULAI = TO_DATE('".$id2."', 'DD-MM-YYYY')";        

        $query = $this->db->query($sql);            
   
        return $query;
    }

    public function save_alamat($data)
    {
            $NRK = $this->input->post('nrk');
            $TGMULAI = $this->input->post('tgmulai');
            $ALAMAT_KTP = strtoupper($this->input->post('alamat_ktp'));
            $ALAMAT = strtoupper($this->input->post('alamat'));
            $RT = $this->input->post('rt');
            $RW = $this->input->post('rw');
            $KOWIL = $this->input->post('kowil');
            $KOCAM = $this->input->post('kocam');
            $KOKEL = $this->input->post('kokel');
            $PROP = $this->input->post('prop');

            $RT_KTP = $this->input->post('rt_ktp');
            $RW_KTP = $this->input->post('rw_ktp');
            $KOWIL_KTP = $this->input->post('kowil_ktp');
            $KOCAM_KTP = $this->input->post('kocam_ktp');
            $KOKEL_KTP = $this->input->post('kokel_ktp');
            $PROP_KTP = $this->input->post('prop_ktp');
            //$STAT = $this->input->post('stat_app');

            $USER_ID=$data['user_id'];
           
            $term=$this->input->ip_address();
            if($term == '0.0.0.0') {
            $ip = explode(',', $_SERVER['REMOTE_ADDR']);
            $term = $ip[0];
        }

            $cek = $this->getDataAlamatHist($NRK,$TGMULAI)->num_rows();

            if($cek == 0)
            {

                $peg['alamat'] = $ALAMAT;
                        $peg['rt'] = $RT;
                        $peg['rw'] = $RW;
                        $peg['kowil'] = $KOWIL;
                        $peg['kocam'] = $KOCAM;
                        $peg['kokel'] = $KOKEL;
                        $peg['prop'] = $PROP;

                        $peg['alamat_ktp'] = $ALAMAT_KTP;
                        $peg['rt_ktp'] = $RT_KTP;
                        $peg['rw_ktp'] = $RW_KTP;
                        $peg['kowil_ktp'] = $KOWIL_KTP;
                        $peg['kocam_ktp'] = $KOCAM_KTP;
                        $peg['kokel_ktp'] = $KOKEL_KTP;
                        $peg['prop_ktp'] = $PROP_KTP;
                        $this->updatePegawai2($NRK, $peg);


                $sql = "INSERT INTO PERS_ALAMAT_HIST(
                    NRK,TGMULAI,ALAMAT_KTP,ALAMAT,RT,RW,KOWIL,KOCAM,KOKEL,PROP,STAT_APP,USER_ID,TERM,TG_UPD,
                    RT_KTP,RW_KTP,KOWIL_KTP,KOCAM_KTP,KOKEL_KTP,PROP_KTP
                    ) VALUES (
                    '".$NRK."',TO_DATE('".$TGMULAI."', 'DD-MM-YYYY'),'".$ALAMAT_KTP."','".$ALAMAT."','".$RT."','".$RW."','".$KOWIL."','".$KOCAM."','".$KOKEL."','".$PROP."','1',
                    '".$USER_ID."','".$term."',SYSDATE,
                    '".$RT_KTP."','".$RW_KTP."','".$KOWIL_KTP."','".$KOCAM_KTP."','".$KOKEL_KTP."','".$PROP_KTP."'
                    )";
               
                $id = $this->db->query($sql);
                
            }
            else
            {
                $id=false;
            }

            
        return $id;
    }

    public function update_alamat($data)
    {
            $NRK = $this->input->post('nrk');
            $TGMULAI = $this->input->post('tgmulai');
            $ALAMAT = strtoupper($this->input->post('alamat'));
            $RT = $this->input->post('rt');
            $RW = $this->input->post('rw');
            $KOWIL = $this->input->post('kowil');
            $KOCAM = $this->input->post('kocam');
            $KOKEL = $this->input->post('kokel');
            $PROP = $this->input->post('prop');

            $ALAMAT_KTP = strtoupper($this->input->post('alamat_ktp'));
            $RT_KTP = $this->input->post('rt_ktp');
            $RW_KTP = $this->input->post('rw_ktp');
            $KOWIL_KTP = $this->input->post('kowil_ktp');
            $KOCAM_KTP = $this->input->post('kocam_ktp');
            $KOKEL_KTP = $this->input->post('kokel_ktp');
            $PROP_KTP = $this->input->post('prop_ktp');
            //$STAT = $this->input->post('stat_app');
            $USER_ID=$data['user_id'];
           
            $term=$this->input->ip_address();
            if($term == '0.0.0.0') {
            $ip = explode(',', $_SERVER['REMOTE_ADDR']);
            $term = $ip[0];
        }

           // $cek="SELECT * FROM PERS_ALAMAT_HIST WHERE NRK='".$NRK."' AND TGMULAI=TO_DATE('".$TGMULAI."', 'DD-MM-YYYY')";
            //$exCek=$this->db->query($cek)->row();

            $cek = $this->getDataAlamatHist($NRK,$TGMULAI)->num_rows();

            if($cek == 1)
            {
                    $sql = "UPDATE PERS_ALAMAT_HIST SET                         
                        ALAMAT = '".$ALAMAT."', 
                        RT = '".$RT."', 
                        RW = '".$RW."',                         
                        PROP = '".$PROP."', 
                        KOWIL = '".$KOWIL."', 
                        KOCAM = '".$KOCAM."',
                        KOKEL = '".$KOKEL."', 
                        ALAMAT_KTP = '".$ALAMAT_KTP."', 
                        RT_KTP = '".$RT_KTP."', 
                        RW_KTP = '".$RW_KTP."',                         
                        PROP_KTP = '".$PROP_KTP."', 
                        KOWIL_KTP = '".$KOWIL_KTP."', 
                        KOCAM_KTP = '".$KOCAM_KTP."',
                        KOKEL_KTP = '".$KOKEL_KTP."', 
                        USER_ID = '".$USER_ID."', 
                        TERM = '".$term."', 
                        TG_UPD = SYSDATE, 
                        STAT_APP='1' 
                        WHERE NRK = '".$NRK."' AND TGMULAI = TO_DATE('".$TGMULAI."', 'DD-MM-YYYY')";

                        /*if(//tidak ada perubahan
                           $exCek->ALAMAT_KTP == $ALAMAT_KTP &&
                           $exCek->ALAMAT == $ALAMAT && 
                           $exCek->RT == $RT &&
                           $exCek->RW == $RW &&
                           $exCek->KOWIL == $KOWIL &&
                           $exCek->KOCAM == $KOCAM &&
                           $exCek->KOKEL == $KOKEL &&
                           $exCek->PROP == $PROP
                           
                           )
                        {
                            $STAT=1;
                            $sql = "UPDATE PERS_ALAMAT_HIST SET ALAMAT_KTP = '".$ALAMAT_KTP."', ALAMAT = '".$ALAMAT."', RT = '".$RT."', RW = '".$RW."', KOWIL = '".$KOWIL."', KOCAM = '".$KOCAM."',KOKEL = '".$KOKEL."', PROP = '".$PROP."', USER_ID = '".$USER_ID."', TERM = '".$term."', TG_UPD = SYSDATE, STAT_APP='".$STAT."' WHERE NRK = '".$NRK."' AND TGMULAI = TO_DATE('".$TGMULAI."', 'DD-MM-YYYY')";
                        }
                        else //ada perubahan
                        {
                           $sql = "UPDATE PERS_ALAMAT_HIST SET ALAMAT_KTP = '".$ALAMAT_KTP."', ALAMAT = '".$ALAMAT."', RT = '".$RT."', RW = '".$RW."', KOWIL = '".$KOWIL."', KOCAM = '".$KOCAM."',KOKEL = '".$KOKEL."', PROP = '".$PROP."', USER_ID = '".$USER_ID."', TERM = '".$term."', TG_UPD = SYSDATE, STAT_APP='".$STAT."' WHERE NRK = '".$NRK."' AND TGMULAI = TO_DATE('".$TGMULAI."', 'DD-MM-YYYY')"; 
                        }*/

                        
                    
                    $id = $this->db->query($sql);
                    if($id)
                    {
                        /*if($STAT==1)
                        {*/
                            $peg['alamat'] = $ALAMAT;
                            $peg['rt'] = $RT;
                            $peg['rw'] = $RW;
                            $peg['kowil'] = $KOWIL;
                            $peg['kocam'] = $KOCAM;
                            $peg['kokel'] = $KOKEL;
                            $peg['prop'] = $PROP;   

                            $peg['alamat_ktp'] = $ALAMAT_KTP;
                            $peg['rt_ktp'] = $RT_KTP;
                            $peg['rw_ktp'] = $RW_KTP;
                            $peg['kowil_ktp'] = $KOWIL_KTP;
                            $peg['kocam_ktp'] = $KOCAM_KTP;
                            $peg['kokel_ktp'] = $KOKEL_KTP;
                            $peg['prop_ktp'] = $PROP_KTP;   

                            $this->updatePegawai2($NRK, $peg);
                        //}
                        
                    }
            }
            else
            {
                $id=false;
            }


             
        return $id;
    }

    public function delete_flag_alamat($NRK,$TGMULAI){
        $sql = "UPDATE PERS_ALAMAT_HIST SET DELETED='Y' WHERE NRK = '".$NRK."' AND TGMULAI = TO_DATE('".$TGMULAI."', 'YY-MM-DD')"; 


//
        $id = $this->db->query($sql);

         $cekdata = "SELECT * FROM PERS_ALAMAT_HIST WHERE NRK='115553' AND TGMULAI = (SELECT MAX(TGMULAI) FROM PERS_ALAMAT_HIST WHERE NRK='".$NRK."' AND DELETED IS NULL)";
         $excekdata = $this->db->query($cekdata);

         $num=$excekdata->num_rows();

         if($num>=1)
         {
            $extract = $excekdata->row();

            
            $alamat = $extract->ALAMAT;
            $rt = $extract->RT;
            $rw = $extract->RW;
            $kowil = $extract->KOWIL;
            $kocam = $extract->KOCAM;
            $kokel = $extract->KOKEL;
            $prop = $extract->PROP;
            

            $update = "UPDATE PERS_PEGAWAI2 SET  ALAMAT = '".$alamat."', RT = '".$rt."', RW = '".$rw."', KOWIL = '".$kowil."', KOCAM = '".$kocam."',KOKEL = '".$kokel."', PROP = '".$prop."' WHERE NRK = '".$NRK."'";

            $exupdate = $this->db->query($update);
         }


         
        return $id;
    }

    public function delete_alamat($NRK,$TGMULAI){
        $user_id       = $this->session->userdata('logged_in')['id'];
        $qi="INSERT INTO DEL_PERS_ALAMAT_HIST A
            (
            SELECT 
                NRK,
                TGMULAI,
                ALAMAT,
                RT,
                RW,
                USER_ID,
                TERM,
                TG_UPD,
                ALAMAT_KTP,
                STAT_APP,
                RT_KTP,
                RW_KTP,
                PROP_KTP,
                KOWIL_KTP,
                KOCAM_KTP,
                KOKEL_KTP,
                
                PROP,
                KOWIL,
                KOCAM,
                KOKEL,
                SYSDATE AS DELETE_DATE,
                '$user_id' AS DELETE_BY
            FROM PERS_ALAMAT_HIST D
            WHERE D.NRK = '".$NRK."' AND D.TGMULAI = TO_DATE('".$TGMULAI."', 'YY-MM-DD')
            )";
            //var_dump($qi);
        $rsi=$this->db->query($qi);

        $sql = "DELETE FROM PERS_ALAMAT_HIST WHERE NRK = '".$NRK."' AND TGMULAI = TO_DATE('".$TGMULAI."', 'YY-MM-DD')"; 


//
        $id = $this->db->query($sql);

         $cekdata = "SELECT * FROM PERS_ALAMAT_HIST WHERE NRK='115553' AND TGMULAI = (SELECT MAX(TGMULAI) FROM PERS_ALAMAT_HIST WHERE NRK='".$NRK."')";
         $excekdata = $this->db->query($cekdata);

         $num=$excekdata->num_rows();

         if($num>=1)
         {
            $extract = $excekdata->row();

            
            $alamat = $extract->ALAMAT;
            $rt = $extract->RT;
            $rw = $extract->RW;
            $kowil = $extract->KOWIL;
            $kocam = $extract->KOCAM;
            $kokel = $extract->KOKEL;
            $prop = $extract->PROP;
            

            $update = "UPDATE PERS_PEGAWAI2 SET  ALAMAT = '".$alamat."', RT = '".$rt."', RW = '".$rw."', KOWIL = '".$kowil."', KOCAM = '".$kocam."',KOKEL = '".$kokel."', PROP = '".$prop."' WHERE NRK = '".$NRK."'";

            $exupdate = $this->db->query($update);
         }


         
        return $id;
    }
/*END ALAMAT*/

/*START PENGHARGAAN*/
    function getDataPenghargaan($id,$id2){
        $sql = "SELECT NRK FROM PERS_PENGHARGAAN WHERE 
                NRK = '".$id."' AND 
                KDHARGA = '".$id2."'";        

        $query = $this->db->query($sql);            
   
        return $query;
    }

    public function save_penghargaan($data)
    {
            $NRK = $this->input->post('nrk');
            $KDHARGA = $this->input->post('kdharga'); 
           
            $TGSK = $this->input->post('tgsk');
            $NOSK = $this->input->post('nosk');
            $ASAL_HRG = $this->input->post('asal_hrg');
            $JNASAL = $this->input->post('jnasal');            

            $USER_ID=$data['user_id'];
            
            $term=$this->input->ip_address();
            if($term == '0.0.0.0') {
            $ip = explode(',', $_SERVER['REMOTE_ADDR']);
            $term = $ip[0];
        }

            $cek = $this->getDataPenghargaan($NRK,$KDHARGA)->num_rows();

            if($cek == 0)
            {
                $sql = "INSERT INTO PERS_PENGHARGAAN(NRK,KDHARGA,TGSK,NOSK,ASAL_HRG,JNASAL,USER_ID,TERM,TG_UPD) 
                VALUES ('".$NRK."','".$KDHARGA."',TO_DATE('".$TGSK."', 'DD-MM-YYYY'),UPPER('".$NOSK."'),UPPER('".$ASAL_HRG."'),'".$JNASAL."',
                    '".$USER_ID."','".$term."',SYSDATE)"; 
            
                 $id = $this->db->query($sql);
            }
            else
            {
                $id=false;
            }

            
        return $id;
    }

    public function update_penghargaan($data)
    {
            $NRK = $this->input->post('nrk');
            $KDHARGA = $this->input->post('kdharga');            
            $TGSK = $this->input->post('tgsk');
            
            $NOSK = $this->input->post('nosk');
            $ASAL_HRG = $this->input->post('asal_hrg');
            $JNASAL = $this->input->post('jnasal');            

            $USER_ID=$data['user_id'];
            
            $term=$this->input->ip_address();
            if($term == '0.0.0.0') {
            $ip = explode(',', $_SERVER['REMOTE_ADDR']);
            $term = $ip[0];
        }

            $cek = $this->getDataPenghargaan($NRK,$KDHARGA)->num_rows();

            if($cek == 1)
            {
                
                $sql = "UPDATE PERS_PENGHARGAAN SET TGSK = TO_DATE('".$TGSK."', 'DD-MM-YYYY'), NOSK = UPPER('".$NOSK."'), ASAL_HRG = UPPER('".$ASAL_HRG."'), JNASAL = '".$JNASAL."', 
                        USER_ID = '".$USER_ID."', TERM = '".$term."', TG_UPD = SYSDATE
                        WHERE NRK = '".$NRK."' AND KDHARGA = '".$KDHARGA."'"; 
            
                $id = $this->db->query($sql);
            }
            else
            {
                $id=false;
            }
        return $id;
    }

    public function delete_flag_penghargaan($NRK,$KDHARGA){
        $sql = "UPDATE PERS_PENGHARGAAN SET DELETED='Y' WHERE NRK = '".$NRK."' AND KDHARGA = '".$KDHARGA."'"; 

        $id = $this->db->query($sql);
        return $id;
    }

    public function delete_penghargaan($NRK,$KDHARGA){
        $user_id       = $this->session->userdata('logged_in')['id'];
        $qi="INSERT INTO DEL_PERS_PENGHARGAAN A
            (
            SELECT 
                NRK,
                KDHARGA,
                TGSK,
                NOSK,
                ASAL_HRG,
                USER_ID,
                TERM,
                TG_UPD,
                JNASAL,
                SYSDATE AS DELETE_DATE,
                '$user_id' AS DELETE_BY
            FROM PERS_PENGHARGAAN D
            WHERE D.NRK = '".$NRK."' AND D.KDHARGA = '".$KDHARGA."'
            )";
        $rsi=$this->db->query($qi);

        $sql = "DELETE FROM PERS_PENGHARGAAN WHERE NRK = '".$NRK."' AND KDHARGA = '".$KDHARGA."'"; 

        $id = $this->db->query($sql);
        return $id;
    }
/*END PENGHARGAAN*/

/*START FASILITAS*/
    public function save_fasilitas($data)
    {
            $NRK = $this->input->post('nrk');
            $JENFAS = $this->input->post('jenfas');
            $THDAPAT = $this->input->post('thdapat');
            $THSAMPAI = $this->input->post('thsampai');
            $INSTANSI = $this->input->post('instansi');
            $KETFAS = $this->input->post('ketfas');
            $KLOGAD = $this->input->post('klogad');
            $SPMU = $this->input->post('spmu');
            $KOWIL = $this->input->post('kowil');
            $KOCAM = $this->input->post('kocam');
            $KOKEL = $this->input->post('kokel');
            if($KOWIL == null)
            {
                $KOWIL = 0;
            }

            if($KOWIL == 0)
            {
                $KOCAM = null;
                $KOKEL = null;
            }

            $USER_ID=$data['user_id'];
           
            $term=$this->input->ip_address();
            if($term == '0.0.0.0') {
            $ip = explode(',', $_SERVER['REMOTE_ADDR']);
            $term = $ip[0];
        }

            $sql = "INSERT INTO PERS_KESRA (NRK,JENFAS,THDAPAT,THSAMPAI,INSTANSI,KETFAS,KOWIL,KOCAM,KOKEL,USER_ID,TERM,TG_UPD,KLOGAD,SPMU)
                    VALUES('".$NRK."', 
                            ".$JENFAS.",
                           '".$THDAPAT."',
                           '".$THSAMPAI."',
                           ".$INSTANSI.",
                           '".$KETFAS."',
                           ".$KOWIL.",
                           '".$KOCAM."',
                           '".$KOKEL."',
                           '".$USER_ID."','".$term."',SYSDATE,
                           '".$KLOGAD."','".$SPMU."'
                           )";
            //echo $sql;
        $id = $this->db->query($sql);
        return $id;
    }

    public function update_fasilitas($data)
    {
            $NRK = $this->input->post('nrk');
            $JENFAS = $this->input->post('jenfas');

            $THDAPAT = $this->input->post('thdapat');
            $THSAMPAI = $this->input->post('thsampai');
            $INSTANSI = $this->input->post('instansi');
            $KETFAS = $this->input->post('ketfas');
            $KLOGAD = $this->input->post('klogad');
            $SPMU = $this->input->post('spmu');
            $KOWIL = $this->input->post('kowil');            
            $KOCAM = $this->input->post('kocam');
            $KOKEL = $this->input->post('kokel');
           /* if($KOWIL == null)
            {
                $KOWIL = 0;
            }

            if($KOWIL == 0)
            {
                $KOCAM = null;
                $KOKEL = null;
            }*/

            $USER_ID=$data['user_id'];
            
            $term=$this->input->ip_address();
            if($term == '0.0.0.0') {
            $ip = explode(',', $_SERVER['REMOTE_ADDR']);
            $term = $ip[0];
        }

            $sql = "UPDATE PERS_KESRA SET THSAMPAI = '".$THSAMPAI."', INSTANSI = ".$INSTANSI.", KETFAS = '".$KETFAS."', KOWIL = ".$KOWIL.", KOCAM = '".$KOCAM."',
                    KOKEL = '".$KOKEL."', USER_ID = '".$USER_ID."', TERM = '".$term."', TG_UPD = SYSDATE,
                     KLOGAD='".$KLOGAD."', SPMU='".$SPMU."'
                    WHERE NRK = '".$NRK."' AND JENFAS = ".$JENFAS." AND THDAPAT ='".$THDAPAT."'"; 
            
        $id = $this->db->query($sql);
        return $id;
    }

    public function delete_flag_fasilitas($NRK,$JENFAS,$THDAPAT){
        $sql = "UPDATE PERS_KESRA SET DELETED='Y' WHERE NRK = '".$NRK."' AND JENFAS = ".$JENFAS." AND THDAPAT = '".$THDAPAT."'"; 

        $id = $this->db->query($sql);
        return $id;
    }

    public function delete_fasilitas($NRK,$JENFAS,$THDAPAT){
        $user_id       = $this->session->userdata('logged_in')['id'];
        $qi="INSERT INTO DEL_PERS_KESRA A
            (
            SELECT 
                NRK,
                JENFAS,
                THDAPAT,
                THSAMPAI,
                INSTANSI,
                KETFAS,
                KOWIL,
                KOCAM,
                KOKEL,
                USER_ID,
                TERM,
                TG_UPD,
                KLOGAD,
                SPMU,
                SYSDATE AS DELETE_DATE,
                '$user_id' AS DELETE_BY
            FROM PERS_KESRA D
            WHERE D.NRK = '".$NRK."' AND D.JENFAS = ".$JENFAS." AND D.THDAPAT = '".$THDAPAT."'
            )";
        $rsi=$this->db->query($qi);

        $sql = "DELETE FROM PERS_KESRA WHERE NRK = '".$NRK."' AND JENFAS = ".$JENFAS." AND THDAPAT = '".$THDAPAT."'"; 

        $id = $this->db->query($sql);
        return $id;
    }
/*END FASILITAS*/

/*START LP2P*/
    public function save_lp2p($data)
    {
            $thpajak = $this->input->post('thpajak');
            if($thpajak == null)
            {
                $thpajak=0;
            }
            $nrk = $this->input->post('nrk');
            $nip = $this->input->post('nip');
            $nip18 = $this->input->post('nip18');
            $nama = $this->input->post('nama');
            $kolok = $this->input->post('kolok');
            $nalok = $this->input->post('nalok');
            $gol = $this->input->post('gol');
            $ruang = $this->input->post('ruang');
            $tmtpangkat = $this->input->post('tmtpangkat');
            $najab = $this->input->post('najab');
            $tmteselon = $this->input->post('tmteselon');            
            $talhir = $this->input->post('talhir');
            $pathir = $this->input->post('pathir');
            $alamat = $this->input->post('alamat');
            $rtalamat = $this->input->post('rtalamat');
            $rwalamat = $this->input->post('rwalamat');
            $kelurahan = $this->input->post('nakel');
            $kecamatan = $this->input->post('nacam');
            $jenkel = $this->input->post('jenkel');
            $stawin = $this->input->post('stawin');
            $namisu = $this->input->post('namisu');
            $pekerjaan = $this->input->post('pekerjaan');
            $juan = $this->input->post('juan');
            if($juan == null)
            {
                $juan = 0;
            }
            $jiwa = $this->input->post('jiwa');
             if($jiwa == null)
            {
                $jiwa = 0;
            }
            $kdwewenang = $this->input->post('kdwewenang');
            $noform = $this->input->post('noform');
            $kode2 = $this->input->post('kode2');
            $kojab = $this->input->post('kojab');
            $kojabf = $this->input->post('kojabf');
            $kd = $this->input->post('kd');
            $eselon = $this->input->post('eselon');
            $spmu = $this->input->post('spmu');
            $klogad = $this->input->post('klogad');
            $induk = $this->input->post('induk');
            $thlapor = $this->input->post('thlapor');
            $pejabat = $this->input->post('pejabat');
           

            $sql = "INSERT INTO PERS_LP2P_HIST(THPAJAK,NRK,NIP,NIP18,NAMA,KOLOK,NALOK,GOL,RUANG,TMTPANGKAT, NAJAB, TMTESELON, TALHIR, PATHIR, ALAMAT, RTALAMAT, RWALAMAT, KELURAHAN, KECAMATAN, JENKEL, STAWIN, NAMISU, PEKERJAAN, JUAN, JIWA, KDWEWENANG,NOFORM,KODE2, TGUPD, KOJAB, KOJABF, KD, ESELON, SPMU, KLOGAD, KODUK, THLAPOR, PEJABAT) 
                    VALUES (".$thpajak.",'".$nrk."','".$nip."','".$nip18."','".$nama."','".$kolok."','".$nalok."','".$gol."','".$ruang."',TO_DATE('".$tmtpangkat."', 'DD-MM-YYYY'),'".$najab."',TO_DATE('".$tmteselon."', 'DD-MM-YYYY'),TO_DATE('".$talhir."', 'DD-MM-YYYY'),'".$pathir."','".$alamat."','".$rtalamat."','".$rwalamat."',
                    '".$kelurahan."','".$kecamatan."','".$jenkel."','".$stawin."','".$namisu."','".$pekerjaan."',".$juan.",".$jiwa.",'".$kdwewenang."','".$noform."','".$kode2."',SYSDATE,'".$kojab."','".$kojabf."','".$kd."','".$eselon."','".$spmu."','".$klogad."','".$koduk."','".$thlapor."',".$pejabat.")"; 
            
        $id = $this->db->query($sql);
        return $id;
    }

    public function update_lp2p()
    {
            $thpajak = $this->input->post('thpajak');
            if($thpajak == null)
            {
                $thpajak=0;
            }
            $nrk = $this->input->post('nrk');
            $nip = $this->input->post('nip');
            $nip18 = $this->input->post('nip18');
            $nama = $this->input->post('nama');
            $kolok = $this->input->post('kolok');
            $nalok = $this->input->post('nalok');
            $gol = $this->input->post('gol');
            $ruang = $this->input->post('ruang');
            $tmtpangkat = $this->input->post('tmtpangkat');
            $najab = $this->input->post('najab');
            $tmteselon = $this->input->post('tmteselon');            
            $talhir = $this->input->post('talhir');
            $pathir = $this->input->post('pathir');
            $alamat = $this->input->post('alamat');
            $rtalamat = $this->input->post('rtalamat');
            $rwalamat = $this->input->post('rwalamat');
            $kelurahan = $this->input->post('nakel');
            $kecamatan = $this->input->post('nacam');
            $jenkel = $this->input->post('jenkel');
            $stawin = $this->input->post('stawin');
            $namisu = $this->input->post('namisu');
            $pekerjaan = $this->input->post('pekerjaan');
            $juan = $this->input->post('juan');
            if($juan == null)
            {
                $juan = 0;
            }
            $jiwa = $this->input->post('jiwa');
            if($jiwa == null)
            {
                $jiwa = 0;
            }
            $kdwewenang = $this->input->post('kdwewenang');
            $noform = $this->input->post('noform');
            $kode2 = $this->input->post('kode2');
            $kojab = $this->input->post('kojab');
            $kojabf = $this->input->post('kojabf');
            $kd = $this->input->post('kd');
            $eselon = $this->input->post('eselon');
            $spmu = $this->input->post('spmu');
            $klogad = $this->input->post('klogad');
            $induk = $this->input->post('induk');
            $thlapor = $this->input->post('thlapor');
            $pejabat = $this->input->post('pejabat');
           

            $sql = "UPDATE PERS_LP2P_HIST SET TALHIR = TO_DATE('".$talhir."', 'DD-MM-YYYY') 
                    WHERE THPAJAK = '".$thpajak."' AND NRK = '".$nrk."'"; 
            
        $id = $this->db->query($sql);
        return $id;
    }

    public function delete_flag_lp2p($thpajak,$nrk){
        $sql = "UPDATE PERS_LP2P_HIST SET DELETED='Y' WHERE THPAJAK = '".$thpajak."' AND NRK = '".$nrk."'"; 

        $id = $this->db->query($sql);
        return $id;
    }

    public function delete_lp2p($thpajak,$nrk){
        $user_id       = $this->session->userdata('logged_in')['id'];
        $qi="INSERT INTO DEL_PERS_LP2P_HIST A
            (
            SELECT 
                THPAJAK NUMBER,
                NRK,
                NIP,
                NIP18,
                NAMA,
                KOLOK,
                NALOK,
                GOL,
                RUANG,
                TMTPANGKAT,
                NAJAB,
                TMTESELON,
                TALHIR,
                PATHIR,
                ALAMAT,
                RTALAMAT,
                RWALAMAT,
                KELURAHAN,
                KECAMATAN,
                JENKEL,
                STAWIN,
                NAMISU,
                PEKERJAAN,
                JUAN,
                JIWA,
                KDWEWENANG,
                NOFORM,
                KODE2,
                TGUPD,
                KOJAB,
                KOJABF,
                KD,
                ESELON,
                SPMU,
                KLOGAD,
                KODUK,
                THLAPOR,
                PEJABAT,
                SYSDATE AS DELETE_DATE,
                '$user_id' AS DELETE_BY
            FROM PERS_LP2P_HIST D
            WHERE D.NRK = '".$NRK."' AND D.TTHPAJAK = '".$thpajak."'
            )";
        $rsi=$this->db->query($qi);

        $sql = "DELETE FROM PERS_LP2P_HIST WHERE THPAJAK = '".$thpajak."' AND NRK = '".$nrk."'"; 

        $id = $this->db->query($sql);
        return $id;
    }
/*END LP2P*/

/* START LITSUS */
public function save_litsus($data)
{
            $nrk = $this->input->post('nrk');
            $tgl = $this->input->post('tgl');
            $dasar = $this->input->post('dasar');
            $keperluan = $this->input->post('keperluan');
            $hasil = $this->input->post('hasil');
            $pemeriksa_awal = $this->input->post('pemeriksa_awal');
            $pemeriksa_ulang = $this->input->post('pemeriksa_ulang');
            $kopang_pemeriksa = $this->input->post('kopang_pemeriksa');
            $noktp = $this->input->post('noktp');
            $bapak_tiri = $this->input->post('bapak_tiri');
            $ibu_tiri = $this->input->post('ibu_tiri');            
            $nomor_ct = $this->input->post('nomor_ct');
            $nomor_skhp = $this->input->post('nomor_skhp');
            $kota_litsus = $this->input->post('kota_litsus');
            
            $user_id=$data['user_id'];
            $term = $this->input->ip_address();
            if($term == '0.0.0.0') {
            $ip = explode(',', $_SERVER['REMOTE_ADDR']);
            $term = $ip[0];
        }
            

            $sql = "INSERT INTO PERS_LITSUS(NRK,TGL,DASAR,KEPERLUAN,HASIL,PEMERIKSA_AWAL,PEMERIKSA_ULANG,KOPANG_PEMERIKSA,NOKTP,
                    BAPAK_TIRI, IBU_TIRI, NOMOR_CT, NOMOR_SKHP, KOTA_LITSUS, USER_ID, TERM, TG_UPD) 
                    VALUES ('".$nrk."',TO_DATE('".$tgl."', 'DD-MM-YYYY'),'".$dasar."','".$keperluan."','".$hasil."','".$pemeriksa_awal."','".$pemeriksa_ulang."',
                            '".$kopang_pemeriksa."','".$noktp."','".$bapak_tiri."','".$ibu_tiri."','".$nomor_ct."','".$nomor_skhp."','".$kota_litsus."',
                            '".$user_id."','".$term."',SYSDATE)"; 
            
        $id = $this->db->query($sql);
        return $id;
}

/* START MAKALAH */
public function save_makalah($data)
{
            $nrk = $this->input->post('nrk');
            $noserta = $this->input->post('noserta');
            $setupok = $this->input->post('setupok');
            $nlayak = $this->input->post('nlayak');
            $nproblem = $this->input->post('nproblem');
            $aktualmas = $this->input->post('aktualmas');
            $total_topik = $this->input->post('total_topik');
            $rata_topik = $this->input->post('rata_topik');
            $npengemb = $this->input->post('npengemb');
            $iptek = $this->input->post('iptek');
            $visi = $this->input->post('visi');
            $total_wawasan = $this->input->post('total_wawasan');
            $rata_wawasan = $this->input->post('rata_wawasan');
            $sissaji = $this->input->post('sissaji');
            $asmateri = $this->input->post('asmateri');
            $alatbantu = $this->input->post('alatbantu');
            $sikap = $this->input->post('sikap');
            $bhslisan = $this->input->post('bhslisan');
            $total_teknik = $this->input->post('total_teknik');
            $rata_teknik = $this->input->post('rata_teknik');
            $relevans = $this->input->post('relevans');
            $sisorgan = $this->input->post('sisorgan');
            $bahasa = $this->input->post('bahasa');
            $total_tulis = $this->input->post('total_tulis');
            $rata_tulis = $this->input->post('rata_tulis');
            $total_seluruh = $this->input->post('total_seluruh');
            $rata_seluruh = $this->input->post('rata_seluruh');
            $tgl_makalah = $this->input->post('tgl_makalah');
            $npenilai = $this->input->post('npenilai');
            
            $user_id=$data['user_id'];
            $term = $this->input->ip_address();
            if($term == '0.0.0.0') {
            $ip = explode(',', $_SERVER['REMOTE_ADDR']);
            $term = $ip[0];
        }
            

            $sql = "INSERT INTO PERS_MKL_ASSES(NRK,NOSERTA,SETUPOK,NLAYAK,NPROBLEM,AKTUALMAS,TOTAL_TOPIK,RATA_TOPIK,NPENGEMB,
                                                IPTEK,VISI,TOTAL_WAWASAN,RATA_WAWASAN,SISSAJI,ASMATERI, ALATBANTU,SIKAP,BHSLISAN,
                                                TOTAL_TEKNIK,RATA_TEKNIK, RELEVANS,SISORGAN, BAHASA, TOTAL_TULIS, RATA_TULIS,
                                                 TOTAL_SELURUH, RATA_SELURUH, TGL_MAKALAH, NPENILAI, USER_ID, TERM, TG_UPD) 
                    VALUES ('".$nrk."','".$noserta."',".$setupok.",".$nlayak.",".$nproblem.",".$aktualmas.",".$total_topik.",
                        ".$rata_topik.",".$npengemb.",".$iptek.",".$visi.",".$total_wawasan.",".$rata_wawasan.",".$sissaji.",
                        ".$asmateri.",".$alatbantu.",".$sikap.",".$bhslisan.",".$total_teknik.",".$rata_teknik.",".$relevans.",
                        ".$sisorgan.",".$bahasa.",".$total_tulis.",".$rata_tulis.",".$total_seluruh.",".$rata_seluruh.",
                        TO_DATE('".$tgl_makalah."', 'DD-MM-YYYY'),'".$npenilai."','".$user_id."','".$term."',SYSDATE)"; 
           
        $id = $this->db->query($sql);
        return $id;
}

/* START TPA */
public function save_testtpa($data)
{
            $nrk = $this->input->post('nrk');
            $noserta = $this->input->post('noserta');
            $nilai_verbal = $this->input->post('nilai_verbal');
            $nilai_numeric = $this->input->post('nilai_numeric');
            $nilai_logic = $this->input->post('nilai_logic');
            $total_tpa = $this->input->post('total_tpa');
            $tgl_testtpa = $this->input->post('tgl_testtpa');
            
            $user_id=$data['user_id'];
            $term = $this->input->ip_address();
            if($term == '0.0.0.0') {
            $ip = explode(',', $_SERVER['REMOTE_ADDR']);
            $term = $ip[0];
        }
          

            $sql = "INSERT INTO PERS_TPA_ASSES(NRK,NOSERTA,NILAI_VERBAL,NILAI_NUMERIC,NILAI_LOGIC,TOTAL_TPA,TGL_TESTTPA, USER_ID, TERM, TG_UPD) 
                    VALUES ('".$nrk."','".$noserta."',".$nilai_verbal.",".$nilai_numeric.",".$nilai_logic.",".$total_tpa.",
                            TO_DATE('".$tgl_testtpa."', 'DD-MM-YYYY'),'".$user_id."','".$term."',SYSDATE)"; 
            
        $id = $this->db->query($sql);
        return $id;
}

/* START TP */
public function save_testtp($data)
{
            $nrk = $this->input->post('nrk');
            $noserta = $this->input->post('noserta');
            $intel = $this->input->post('intel');
            $nh_intel = $this->input->post('nh_intel');
            $konsep = $this->input->post('konsep');
            $nh_konsep = $this->input->post('nh_konsep');
            $alpermas = $this->input->post('alpermas');
            $nh_alpermas = $this->input->post('nh_alpermas');
            $mkomplek = $this->input->post('mkomplek');
            $nh_mkomplek = $this->input->post('nh_mkomplek');
            $kpraktis = $this->input->post('kpraktis');
            $nh_kpraktis = $this->input->post('nh_kpraktis');
            $wawasan = $this->input->post('wawasan');
            $nh_wawasan = $this->input->post('nh_wawasan');
            $total_cerdas= $this->input->post('total_cerdas');
            $motpres = $this->input->post('motpres');
            $nh_motpres = $this->input->post('nh_motpres');
            $efisien = $this->input->post('efisien');
            $nh_efisien = $this->input->post('nh_efisien');
            $integrit = $this->input->post('integrit');
            $nh_integrit = $this->input->post('nh_integrit');
            $stress = $this->input->post('stress');
            $nh_stress = $this->input->post('nh_stress');
            $proaktiv_tp = $this->input->post('proaktiv_tp');
            $nh_proaktiv_tp = $this->input->post('nh_proaktiv_tp');
            $krjsama = $this->input->post('krjsama');
            $nh_krjsama = $this->input->post('nh_krjsama');
            $total_sikapker = $this->input->post('total_sikapker');
            $daldiri = $this->input->post('daldiri');
            $nh_daldiri = $this->input->post('nh_daldiri');
            $psosial = $this->input->post('psosial');
            $nh_psosial = $this->input->post('nh_psosial');
            $komunika = $this->input->post('komunika');
            $nh_komunika = $this->input->post('nh_komunika');
            $percaya = $this->input->post('percaya');
            $nh_percaya = $this->input->post('nh_percaya');
            $total_pribadi = $this->input->post('total_pribadi');
            $pimpin_tp = $this->input->post('pimpin_tp');
            $nh_pimpin_tp = $this->input->post('nh_pimpin_tp');
            $prencana = $this->input->post('prencana');
            $nh_prencana = $this->input->post('nh_prencana');
            $kputusan = $this->input->post('kputusan');
            $nh_kputusan = $this->input->post('nh_kputusan');
            $waskat = $this->input->post('waskat');
            $nh_waskat = $this->input->post('nh_waskat');
            $mandiri = $this->input->post('mandiri');
            $nh_mandiri = $this->input->post('nh_mandiri');
            $negosia = $this->input->post('negosia');
            $nh_negosia = $this->input->post('nh_negosia');
            $total_manajer = $this->input->post('total_manajer');
            $total_tp = $this->input->post('total_tp');
            $tgl_testtp = $this->input->post('tgl_testtp');
            $katagori = $this->input->post('katagori');
            $rumpun = $this->input->post('rumpun');
            $iq = $this->input->post('iq');
            $saran1 = $this->input->post('saran1');
            $saran2 = $this->input->post('saran2');
            $saran3 = $this->input->post('saran3');
            $saran4 = $this->input->post('saran4');
            $saran5 = $this->input->post('saran5');
            $keadaan = $this->input->post('keadaan');
            
            $user_id=$data['user_id'];
            $term = $this->input->ip_address();
            if($term == '0.0.0.0') {
            $ip = explode(',', $_SERVER['REMOTE_ADDR']);
            $term = $ip[0];
        }
            

            $sql = "INSERT INTO PERS_TP_ASSES(NRK,NOSERTA, INTEL,NH_INTEL, KONSEP, NH_KONSEP, ALPERMAS, NH_ALPERMAS, MKOMPLEK, NH_MKOMPLEK,
                    KPRAKTIS, NH_KPRAKTIS, WAWASAN, NH_WAWASAN, TOTAL_CERDAS, MOTPRES, NH_MOTPRES, EFISIEN, NH_EFISIEN, INTEGRIT, NH_INTEGRIT, STRESS, NH_STRESS,
                    PROAKTIV_TP, NH_PROAKTIV_TP,KRJSAMA, NH_KRJSAMA, TOTAL_SIKAPKER, DALDIRI, NH_DALDIRI, PSOSIAL, NH_PSOSIAL, KOMUNIKA, NH_KOMUNIKA,
                    PERCAYA, NH_PERCAYA, TOTAL_PRIBADI, PIMPIN_TP, NH_PIMPIN_TP, PRENCANA, NH_PRENCANA, KPUTUSAN, NH_KPUTUSAN, WASKAT, NH_WASKAT,
                    MANDIRI, NH_MANDIRI, NEGOSIA, NH_NEGOSIA, TOTAL_MANAJER, TOTAL_TP, TGL_TESTTP, KATAGORI, RUMPUN, IQ, SARAN1, SARAN2, SARAN3, SARAN4, SARAN5, 
                    KEADAAN, USER_ID, TERM, TG_UPD) 
                    VALUES ('".$nrk."','".$noserta."',".$intel.",'".$nh_intel."',".$konsep.",'".$nh_konsep."',
                            ".$alpermas.",'".$nh_alpermas."',".$mkomplek.",'".$nh_mkomplek."',".$kpraktis.",'".$nh_kpraktis."',
                            ".$wawasan.",'".$nh_wawasan."',".$total_cerdas.",".$motpres.",'".$nh_motpres."',".$efisien.",'".$nh_efisien."',
                            ".$integrit.",'".$nh_integrit."',".$stress.",'".$nh_stress."',".$proaktiv_tp.",'".$nh_proaktiv_tp."',
                            ".$krjsama.",'".$nh_krjsama."',".$total_sikapker.",".$daldiri.",'".$nh_daldiri."',".$psosial.",'".$nh_psosial."',
                            ".$komunika.",'".$nh_komunika."',".$percaya.",'".$nh_percaya."',".$total_pribadi.",".$pimpin_tp.",'".$nh_pimpin_tp."',
                            ".$prencana.",'".$nh_prencana."',".$kputusan.",'".$nh_kputusan."',".$waskat.",'".$nh_waskat."',
                            ".$mandiri.",'".$nh_mandiri."',".$negosia.",'".$nh_negosia."',".$total_manajer.",".$total_tp.",
                            TO_DATE('".$tgl_testtp."', 'DD-MM-YYYY'),'".$katagori."','".$rumpun."',".$iq.",'".$saran1."','".$saran2."',
                            '".$saran3."','".$saran4."','".$saran5."','".$keadaan."','".$user_id."','".$term."',SYSDATE)"; 
            
        $id = $this->db->query($sql);
        return $id;
}

/*START ORGANISASI*/
    public function save_organisasi($data)
    {
            $NRK = $this->input->post('nrk');
            $DARI = $this->input->post('dari');
            $SAMPAI = $this->input->post('sampai');
            $SBLSSD = $this->input->post('sblssd');
            $NAORGANI = $this->input->post('naorgani');
            $KOTA = $this->input->post('kota');
            $KDDUDUK = $this->input->post('kdduduk');            

            $USER_ID=$data['user_id'];
          
            $term=$this->input->ip_address();
            if($term == '0.0.0.0') {
            $ip = explode(',', $_SERVER['REMOTE_ADDR']);
            $term = $ip[0];
        }

            $sql = "INSERT INTO PERS_ORGAN_HIST(NRK,DARI,SAMPAI,SBLSSD,NAORGANI,KOTA,KDDUDUK,USER_ID,TERM,TG_UPD) 
                VALUES ('".$NRK."',TO_DATE('".$DARI."', 'DD-MM-YYYY'),TO_DATE('".$SAMPAI."', 'DD-MM-YYYY'),'".$SBLSSD."','".$NAORGANI."','".$KOTA."','".$KDDUDUK."',
                    '".$USER_ID."','".$term."',SYSDATE)"; 
            
        $id = $this->db->query($sql);
        return $id;
    }

    public function update_organisasi($data)
    {
            $NRK = $this->input->post('nrk');
            $DARI = $this->input->post('dari');
            $SAMPAI = $this->input->post('sampai');
            $SBLSSD = $this->input->post('sblssd');
            $NAORGANI = $this->input->post('naorgani');
            $KOTA = $this->input->post('kota');
            $KDDUDUK = $this->input->post('kdduduk');

            $USER_ID=$data['user_id'];
           
            $term=$this->input->ip_address();
            if($term == '0.0.0.0') {
            $ip = explode(',', $_SERVER['REMOTE_ADDR']);
            $term = $ip[0];
        }

            $sql = "UPDATE PERS_ORGAN_HIST SET SAMPAI = TO_DATE('".$SAMPAI."', 'DD-MM-YYYY'), SBLSSD = '".$SBLSSD."', NAORGANI = '".$NAORGANI."', KOTA = '".$KOTA."', KDDUDUK = '".$KDDUDUK."', 
                    USER_ID = '".$USER_ID."', TERM = '".$term."', TG_UPD = SYSDATE 
                    WHERE NRK = '".$NRK."' AND DARI = TO_DATE('".$DARI."', 'DD-MM-YYYY')"; 
        
        $id = $this->db->query($sql);
        return $id;
    }

    public function delete_flag_organisasi($NRK,$DARI){
        $sql = "UPDATE PERS_ORGAN_HIST SET DELETED='Y' WHERE NRK = '".$NRK."' AND DARI = TO_DATE('".$DARI."', 'YYYY-MM-DD')"; 

        $id = $this->db->query($sql);
        return $id;
    }

    public function delete_organisasi($NRK,$DARI){
        $user_id       = $this->session->userdata('logged_in')['id'];
        $qi="INSERT INTO DEL_PERS_ORGAN_HIST A
            (
            SELECT 
                NRK,
                DARI,
                SBLSSD,
                NAORGANI,
                KDDUDUK,
                SAMPAI,
                KOTA,
                USER_ID,
                TERM,
                TG_UPD,
                SYSDATE AS DELETE_DATE,
                '$user_id' AS DELETE_BY
            FROM PERS_ORGAN_HIST D
            WHERE D.NRK = '".$NRK."' AND D.DARI = TO_DATE('".$DARI."', 'YYYY-MM-DD')
            )";
        $rsi=$this->db->query($qi);

        $sql = "DELETE FROM PERS_ORGAN_HIST WHERE NRK = '".$NRK."' AND DARI = TO_DATE('".$DARI."', 'YYYY-MM-DD')"; 

        $id = $this->db->query($sql);
        return $id;
    }
/*END ORGANISASI*/

/*START KELUARGA*/
   

    public function save_keluarga($data)
    {
        $NRK = $this->input->post('nrk');
        $STAWIN = $this->input->post('stawin');
        $NOKK = $this->input->post('nokk');
        $NIK = $this->input->post('nik');

        $HUBKEL = $this->input->post('hubkel');
        $NAMA = $this->input->post('nama');
        $JENKEL = $this->input->post('jenkel');
        $TEMHIR = $this->input->post('temhir');
        $TALHIR = $this->input->post('talhir');
        $TGNIKAH = $this->input->post('tgnikah');
        $TEMNIKAH = $this->input->post('temnikah');
        $STATTUN = $this->input->post('stattun');
        // var_dump($STATTUN)
        $KDKERJA = $this->input->post('kdkerja');
        $MATI = $this->input->post('mati');
        $UANGDUKA = $this->input->post('uangduka');
        if($UANGDUKA==null)
        {
            $UANGDUKA = '0';
        }

        $NOAKTENIKAH = $this->input->post('noaktenikah');
        $NOAKTECERAI = $this->input->post('noaktecerai');
        $TGAKTECERAI = $this->input->post('tgaktecerai');
        $NOSURATCERAI = $this->input->post('nosuratcerai');
        $TGSURATCERAI = $this->input->post('tgsuratcerai');
        $NOAKTIFSEK = $this->input->post('noaktifsek');
        $TGAKTIFSEK = $this->input->post('tgaktifsek');
        $NOSURATMATI = $this->input->post('nosuratmati');
        $TGSURATMATI = $this->input->post('tgsuratmati');
        $STAT = $this->input->post('stat_app');        

        $USER_ID=$data['user_id'];
      
        $term=$this->input->ip_address();
        if($term == '0.0.0.0') {
            $ip = explode(',', $_SERVER['REMOTE_ADDR']);
            $term = $ip[0];
        }

        $cek="SELECT * FROM PERS_KELUARGA WHERE NRK='".$NRK."' AND HUBKEL=".$HUBKEL."";
        $exCek=$this->db->query($cek);
        $num=$exCek->num_rows();

        $cekTun = "SELECT * FROM PERS_KELUARGA WHERE STATTUN IN(1,3) AND HUBKEL IN(10,11,12,13,14,15,16,17,18,19,21,22,23,24,25,26,27,28,29,31,32,33,34,35,36,37,38,39,41,42,43,44,45,46,47,48,49,50,51,52,53,54,55,56,57,58) AND NRK='".$NRK."'";
        
        if($num<1)
        {
            $sql = "INSERT INTO PERS_KELUARGA(
                NRK,NIK,HUBKEL,NAMA,JENKEL,TEMHIR,TALHIR,TGNIKAH,TEMNIKAH,
                STATTUN,KDKERJA,MATI,UANGDUKA,USER_ID,TERM,TG_UPD,
                NOAKTENIKAH,NOAKTECERAI,TGAKTECERAI,NOAKTIFSEK,TGAKTIFSEK,
                NOSURATMATI,TGSURATMATI,STAT_APP,INPUT_TUN,NO_SURAT_SKL,TG_SURAT_TUN,NOSURATCERAI,TGSURATCERAI
                )
                VALUES (
                '".$NRK."','".$NIK."','".$HUBKEL."',UPPER('".$NAMA."'),'".$JENKEL."',UPPER('".$TEMHIR."'),TO_DATE('".$TALHIR."', 'DD-MM-YYYY'),TO_DATE('".$TGNIKAH."', 'DD-MM-YYYY'),
                UPPER('".$TEMNIKAH."'),
                ".$STATTUN.",'".$KDKERJA."',TO_DATE('".$MATI."', 'DD-MM-YYYY'),'".$UANGDUKA."',
                '".$USER_ID."','".$term."',SYSDATE,
                '".$NOAKTENIKAH."','".$NOAKTECERAI."',TO_DATE('".$TGAKTECERAI."', 'DD-MM-YYYY'),
                '".$NOAKTIFSEK."',TO_DATE('".$TGAKTIFSEK."', 'DD-MM-YYYY'),
                '".$NOSURATMATI."',TO_DATE('".$TGSURATMATI."', 'DD-MM-YYYY'),'".$STAT."',0,'','','$NOSURATCERAI',TO_DATE('$TGSURATCERAI','DD-MM-YYYY'))";
            // echo $sql;
            $id = $this->db->query($sql);
            if($STAT==1)
            {
                $q1 = "UPDATE PERS_PEGAWAI1 SET STAWIN='$STAWIN' WHERE NRK='$NRK'";
            $this->db->query($q1);
                $q2 = "UPDATE PERS_PEGAWAI2 SET NOKK='$NOKK' WHERE NRK='$NRK'";
            $this->db->query($q2);
            }   
        }
        else
        {
            $id=false;
        }  
        return $id;
    }

    public function update_keluarga($data)
    {
        $NRK = $this->input->post('nrk');
        $STAWIN = $this->input->post('stawin');
        $NOKK = $this->input->post('nokk');
        $NIK = $this->input->post('nik');
        $HUBKEL = $this->input->post('hubkel');
        $NAMA = $this->input->post('nama');
        $JENKEL = $this->input->post('jenkel');
        $TEMHIR = $this->input->post('temhir');
        $TALHIR = $this->input->post('talhir');
        if($TALHIR !=null)
        {
            $TL=date('d-M-y',strtotime($TALHIR));   
        }
        else
        {
            $TL = $TALHIR;
        }

        $TGNIKAH = $this->input->post('tgnikah');
        if($TGNIKAH!=null)
        {
            $TN=date('d-M-y',strtotime($TGNIKAH));  
        }
        else
        {
            $TN=$TGNIKAH;
        }
        

        $TEMNIKAH = $this->input->post('temnikah');



        $STATTUN = $this->input->post('stattun');

        if($HUBKEL == 11 || $HUBKEL == 12 || $HUBKEL == 13 || $HUBKEL == 14 || $HUBKEL ==15 || $HUBKEL ==16 || $HUBKEL ==17 || $HUBKEL ==18 || $HUBKEL ==19 || $HUBKEL ==21 || $HUBKEL ==22 || $HUBKEL ==23 || $HUBKEL ==24 || $HUBKEL ==25 || $HUBKEL ==26 || $HUBKEL ==27 || $HUBKEL ==28 || $HUBKEL ==29 || $HUBKEL ==31 || $HUBKEL ==32 || $HUBKEL ==33 || $HUBKEL ==34 || $HUBKEL ==35 || $HUBKEL ==36 || $HUBKEL ==37 || $HUBKEL ==38 || $HUBKEL ==39 || $HUBKEL ==41 || $HUBKEL ==42 || $HUBKEL ==43 || $HUBKEL ==44 || $HUBKEL ==45 || $HUBKEL ==46 || $HUBKEL ==47 || $HUBKEL ==48 || $HUBKEL ==49 || $HUBKEL ==58 )
        {
        	$cekumur = "SELECT (FLOOR((SYSDATE-TO_DATE('".$TALHIR."','DD-MM-YYYY'))/365))UMUR from pers_keluarga where hubkel = '".$HUBKEL."' and nrk='".$NRK."' ";
        	$excumur = $this->db->query($cekumur)->row();


        
        	if($excumur->UMUR >= 21 && $STATTUN == 1)
        	{
            	$STATTUN =2;
            
        	}	
        }
        

        $KDKERJA = $this->input->post('kdkerja');
        $MATI = $this->input->post('mati');
        if($MATI !=null)
        {
            $STATTUN = 2;
        }
        $UANGDUKA = $this->input->post('uangduka');
        if($UANGDUKA==null)
        {
            $UANGDUKA = '0';
        }

        $NOAKTENIKAH = $this->input->post('noaktenikah');
        $NOAKTECERAI = $this->input->post('noaktecerai');
        $TGAKTECERAI = $this->input->post('tgaktecerai');

        $NOSURATCERAI = $this->input->post('nosuratcerai');
        $TGSURATCERAI = $this->input->post('tgsuratcerai');

        if($TGAKTECERAI !=null)
        {
            $TC=date('d-M-y',strtotime($TGAKTECERAI));
        }
        else
        {
            $TC=$TGAKTECERAI;
        }

        if($TGSURATCERAI !=null)
        {
            $TSC=date('d-M-y',strtotime($TGSURATCERAI));
        }
        else
        {
            $TSC=$TGSURATCERAI;
        }  

        $NOAKTIFSEK = $this->input->post('noaktifsek');
        $TGAKTIFSEK = $this->input->post('tgaktifsek');
        //var_dump($TGAKTIFSEK);
        if($TGAKTIFSEK !=null)
        {
            $TS=date('d-M-y',strtotime($TGAKTIFSEK));
        }
        else
        {
            $TS=$TGAKTIFSEK;
        }

        $NOSURATMATI = $this->input->post('nosuratmati');
        $TGSURATMATI = $this->input->post('tgsuratmati');
        if($TGSURATMATI !=null)
        {
            $TM=date('d-M-y',strtotime($TGSURATMATI));
        }
        else
        {
            $TM=$TGSURATMATI;
        }
        $STAT = $this->input->post('stat_app');
        $USER_ID=$data['user_id'];
        $term=$this->input->ip_address();
        if($term == '0.0.0.0') {
            $ip = explode(',', $_SERVER['REMOTE_ADDR']);
            $term = $ip[0];
        }

        $INPUT_TUN = $this->input->post('input_tun');
        if($INPUT_TUN == null)
        {
            $INPUT_TUN=0;
        }
        $NO_SURAT_SKL = $this->input->post('no_surat_skl');
        $TG_SURAT_TUN_POST = $this->input->post('tg_surat_tun');
        //var_dump($TG_SURAT_TUN_POST);
        $TG_SURAT_TUN;
        if($TG_SURAT_TUN_POST == '')
        {
            $TG_SURAT_TUN='';
        }
        else
        {
            $TG_SURAT_TUN =  date('d-M-y',strtotime($TG_SURAT_TUN_POST)); 
        }
        //var_dump($TG_SURAT_TUN);

        $cek="SELECT * FROM PERS_KELUARGA WHERE NRK='".$NRK."' AND HUBKEL=".$HUBKEL."";
        $exCek=$this->db->query($cek)->row();

        if($exCek->TALHIR !=null)
        {
            $DBTL = date('d-M-y',strtotime($exCek->TALHIR));    
        }
        else
        {
            $DBTL = $exCek->TALHIR;
        }
        
        if($exCek->TGNIKAH !=null)
        {
            $DBTN = date('d-M-y',strtotime($exCek->TGNIKAH));   
        }
        else
        {
            $DBTN = $exCek->TGNIKAH;
        }        
   
        if($exCek->TGAKTECERAI !=null)
        {
            $DBTC = date('d-M-y',strtotime($exCek->TGAKTECERAI));   
        }
        else
        {
            $DBTC = $exCek->TGAKTECERAI;
        }

        if($exCek->TGSURATCERAI !=null)
        {
            $DBTSC = date('d-M-y',strtotime($exCek->TGSURATCERAI));   
        }
        else
        {
            $DBTSC = $exCek->TGSURATCERAI;
        }
            
        if($exCek->TGAKTIFSEK !=null)
        {
            $DBTS = date('d-M-y',strtotime($exCek->TGAKTIFSEK));    
        }
        else
        {
            $DBTS = $exCek->TGAKTIFSEK;
        }

        if($exCek->TGSURATMATI !=null)
        {
            $DBTM = date('d-M-y',strtotime($exCek->TGSURATMATI));   
        }
        else
        {
            $DBTM = $exCek->TGSURATMATI;
        }
           
            if(//tidak ada perubahan
                
                $exCek->NIK == $NIK 
                && $exCek->NAMA == $NAMA 
                && $exCek->JENKEL == $JENKEL 
                && $exCek->TEMHIR == $TEMHIR 
                && $DBTL == $TL 
                && $DBTN == $TN 
                && $exCek->TEMNIKAH == $TEMNIKAH 
                && $exCek->STATTUN == $STATTUN 
                && $exCek->KDKERJA == $KDKERJA 
                && $exCek->MATI == $MATI 
                && $exCek->UANGDUKA == $UANGDUKA 
                && $exCek->NOAKTENIKAH == $NOAKTENIKAH 
                && $exCek->NOAKTECERAI == $NOAKTECERAI 
                && $DBTC == $TC 
                && $DBTSC == $TSC 
                && $exCek->NOAKTIFSEK == $NOAKTIFSEK 
                && $DBTS == $TS 
                && $exCek->NOSURATMATI == $NOSURATMATI 
                && $DBTM == $TM 
                
               )               
            {
                if($exCek->STAT_APP == 1 && $STAT == 2)
                {
                    $STAT=1;
                }   
                $sql = "UPDATE PERS_KELUARGA SET NAMA = UPPER('".$NAMA."'), NIK = '".$NIK."',JENKEL = '".$JENKEL."', TEMHIR = UPPER('".$TEMHIR."'), TALHIR = TO_DATE('".$TALHIR."', 'DD-MM-YYYY'), TGNIKAH = TO_DATE('".$TGNIKAH."', 'DD-MM-YYYY'),TEMNIKAH = UPPER('".$TEMNIKAH."'), STATTUN = '".$STATTUN."', MATI = TO_DATE('".$MATI."', 'DD-MM-YYYY'), UANGDUKA = '".$UANGDUKA."', USER_ID = '".$USER_ID."', TERM = '".$term."', TG_UPD = SYSDATE,NOAKTENIKAH = '".$NOAKTENIKAH."',NOAKTECERAI = '".$NOAKTECERAI."',TGAKTECERAI = TO_DATE('".$TGAKTECERAI."', 'DD-MM-YYYY'),NOAKTIFSEK = '".$NOAKTIFSEK."',
                    TGAKTIFSEK = TO_DATE('".$TGAKTIFSEK."', 'DD-MM-YYYY'),NOSURATMATI = '".$NOSURATMATI."',TGSURATMATI = TO_DATE('".$TGSURATMATI."', 'DD-MM-YYYY'),STAT_APP = '".$STAT."',
                    KDKERJA='$KDKERJA',TGSURATCERAI = TO_DATE('$TGSURATCERAI','DD-MM-YYYY'),NOSURATCERAI = '$NOSURATCERAI'
                    WHERE NRK = '".$NRK."' AND HUBKEL = '".$HUBKEL."'"; 
                    // echo $sql;exit;
               
            }
            else //ada perubahan (Riwayat BKD akses kesini)
            {
                
               $sql = "UPDATE PERS_KELUARGA SET
                    NAMA = UPPER('".$NAMA."'), NIK = '".$NIK."',JENKEL = '".$JENKEL."', TEMHIR = UPPER('".$TEMHIR."'), TALHIR = TO_DATE('".$TALHIR."', 'DD-MM-YYYY'), TGNIKAH = TO_DATE('".$TGNIKAH."', 'DD-MM-YYYY'),TEMNIKAH = UPPER('".$TEMNIKAH."'), STATTUN = '".$STATTUN."', MATI = TO_DATE('".$MATI."', 'DD-MM-YYYY'), UANGDUKA = '".$UANGDUKA."', USER_ID = '".$USER_ID."', TERM = '".$term."', TG_UPD = SYSDATE,NOAKTENIKAH = '".$NOAKTENIKAH."',NOAKTECERAI = '".$NOAKTECERAI."',TGAKTECERAI = TO_DATE('".$TGAKTECERAI."', 'DD-MM-YYYY'),NOSURATCERAI = '".$NOSURATCERAI."',TGSURATCERAI = TO_DATE('".$TGSURATCERAI."', 'DD-MM-YYYY'),NOAKTIFSEK = '".$NOAKTIFSEK."',TGAKTIFSEK = TO_DATE('".$TGAKTIFSEK."', 'DD-MM-YYYY'),NOSURATMATI = '".$NOSURATMATI."',TGSURATMATI = TO_DATE('".$TGSURATMATI."', 'DD-MM-YYYY'),STAT_APP = '".$STAT."', INPUT_TUN =".$INPUT_TUN.", NO_SURAT_SKL = '".$NO_SURAT_SKL."', TG_SURAT_TUN = TO_DATE('".$TG_SURAT_TUN."','DD-MM-YYYY'), 
                    KDKERJA='$KDKERJA'
                    WHERE NRK = '".$NRK."' AND HUBKEL = '".$HUBKEL."'";
                // echo $sql;exit;
                   
            }
     
        if($STAT == 1)
        {
            $q1 = "UPDATE PERS_PEGAWAI1 SET STAWIN='$STAWIN' WHERE NRK='$NRK'";
            $this->db->query($q1);
            $q2 = "UPDATE PERS_PEGAWAI2 SET NOKK='$NOKK' WHERE NRK='$NRK'";
            $this->db->query($q2);
        }
        //var_dump($sql);
        $id = $this->db->query($sql);
        return $id;
    }

    

    public function delete_flag_keluarga($NRK,$HUBKEL){
        $sql = "UPDATE PERS_KELUARGA SET DELETED='Y' WHERE NRK = '".$NRK."' AND HUBKEL = '".$HUBKEL."'"; 

        $id = $this->db->query($sql);
        return $id;
    }

    public function delete_keluarga($NRK,$HUBKEL){
        $user_id       = $this->session->userdata('logged_in')['id'];
        $qi="INSERT INTO DEL_PERS_KELUARGA A
            (
            SELECT 
                NRK,
                HUBKEL,
                NAMA,
                TEMHIR,
                TALHIR,
                TGNIKAH,
                TEMNIKAH,
                STATTUN,
                KDKERJA,
                JENKEL,
                MATI,
                UANGDUKA,
                USER_ID,
                TERM,
                TG_UPD,
                NOAKTENIKAH,
                NOAKTIFSEK,
                TGAKTIFSEK,
                NOSURATMATI,
                TGSURATMATI,
                NOAKTECERAI,
                TGAKTECERAI,
                STAT_APP,
                TG_SURAT_TUN,
                INPUT_TUN,
                NO_SURAT_SKL,
                NIK,
                SYSDATE AS DELETE_DATE,
                '$user_id' AS DELETE_BY,
                 TGSURATCERAI,
                NOSURATCERAI
            FROM PERS_KELUARGA D
            WHERE D.NRK = '".$NRK."' AND D.HUBKEL = '".$HUBKEL."'
            )";
        $rsi=$this->db->query($qi);

        $sql = "DELETE FROM PERS_KELUARGA WHERE NRK = '".$NRK."' AND HUBKEL = '".$HUBKEL."'"; 

        $id = $this->db->query($sql);
        return $id;
    }
/*END KELUARGA*/

    public function getTTBBNow($nrk)
    {
        $sql="SELECT
                (TTMASKER + TO_CHAR (SYSDATE, 'YYYY') - TO_CHAR (TMT, 'YYYY')) AS TTMSKNOW,
                (BBMASKER + TO_CHAR (SYSDATE, 'MM') - TO_CHAR (TMT, 'MM')) AS BBMSKNOW 
              FROM
                PERS_RB_GAPOK_HIST
              WHERE
                TMT=(SELECT MAX(TMT) FROM PERS_RB_GAPOK_HIST WHERE NRK='".$nrk."') 
              AND NRK='".$nrk."'";
        
        $id= $this->db->query($sql)->row();
        return $id;
    }

    public function getTTBBNowPg($nrk)
    {
        $sql="SELECT
                (TTMASKER + TO_CHAR (SYSDATE, 'YYYY') - TO_CHAR (TMT, 'YYYY')) AS TTMSKNOW,
                (BBMASKER + TO_CHAR (SYSDATE, 'MM') - TO_CHAR (TMT, 'MM')) AS BBMSKNOW,
                TO_CHAR(SYSDATE,'DD-MM-YYYY')AS DATENOW 
             FROM
                PERS_PANGKAT_HIST
            WHERE
                TMT=(SELECT MAX(TMT) FROM PERS_PANGKAT_HIST WHERE NRK='".$nrk."')
            AND NRK='".$nrk."'
        ";

        $id= $this->db->query($sql)->row();
        return $id;
    }

    public function getTTBBPgbyTMT($nrk,$tmt)
    {
        $tt = substr($tmt, 6,4);
        $bb= substr($tmt,3,2);
        
        $sql="SELECT
                (TTMASKER + ".$tt." - TO_CHAR (TMT, 'YYYY')) AS TTMSKTMT,
                (BBMASKER + ".$bb." - TO_CHAR (TMT, 'MM')) AS BBMSKTMT,
                TO_CHAR(TO_DATE('".$tmt."','DD-MM-YYYY'),'DD-MM-YYYY')AS DATENOW 
             FROM
                PERS_PANGKAT_HIST
            WHERE
                TMT=(SELECT MAX(TMT) FROM PERS_PANGKAT_HIST WHERE NRK='".$nrk."')
            AND NRK='".$nrk."'
        ";
        
        $id= $this->db->query($sql)->row();
        
        return $id;
    }


/*START CEK PEGAWAI 1*/
    public function getSPMU($kolok){
        $sql = "SELECT SPMU FROM PERS_KLOGAD3 WHERE KOLOK = '".$kolok."' AND ROWNUM <= 1";
       // echo $sql;
        $spm = $this->db->query($sql)->row();

        if($spm){
            return $spm->SPMU;          
        }else{
            return '';  
        }

        
    }

    

    public function updatePegawai1($nrk, $data){
        $kd=$data['kd'];
        $kolok = $data['kolok'];
        $spmu = $this->getSPMU($kolok);
        $kojab = $data['kojab'];
        $klogad = $data['klogad'];
        $tmt = $data['tmt'];
        $user_id = $data['user_id'];
        $term = $data['term'];        
            
            //START TMT TERAKHIR
            $sqlTMT = "SELECT NRK, to_char(MAX(TMT), 'DD-MM-YYYY') TMT FROM (
                            SELECT NRK, TMT FROM PERS_JABATANF_HIST WHERE NRK = '".$nrk."'
                            UNION 
                            SELECT NRK, TMT FROM PERS_JABATAN_HIST WHERE NRK = '".$nrk."'
                        ) JAB GROUP BY NRK";
            
            $checkTMT = $this->db->query($sqlTMT)->row();
            $lastTmt = $checkTMT->TMT;

            if (date('d-m-Y',strtotime($tmt)) >= date('d-m-Y',strtotime($lastTmt)) ) {
                $sql = "SELECT NRK FROM PERS_PEGAWAI1 WHERE NRK = '".$nrk."'";
                $peg = $this->db->query($sql)->row();

                if ($peg) {
                        $upd = "UPDATE PERS_PEGAWAI1 
                        SET KD='".$kd."',KOLOK = '".$kolok."' , SPMU = '".$spmu."' , KOJAB = '".$kojab."',KLOGAD = '".$klogad."',USER_ID =  '".$user_id."', TERM ='".$term."', TG_UPD = SYSDATE
                        WHERE nrk = '".$nrk."' ";
                       
                        $pegupd = $this->db->query($upd);

                        return $pegupd;
                }   
            }
            //END CEK TMT TERAKHIR
            
        return false;
    }

    public function updatePeg1PensiunMati($nrk, $data){
        
        $klogad = $data['klogad'];
        $tmt = $data['tmt'];
        
            
            $sql = "SELECT NRK FROM PERS_PEGAWAI1 WHERE NRK = '".$nrk."'";
            $peg = $this->db->query($sql)->row();

            if ($peg) {
                $upd='';
                if($klogad == '111111118')
                {
                    $upd = "UPDATE PERS_PEGAWAI1 
                    SET KDMATI='Y',TGMATI = TO_DATE('".$tmt."','DD-MM-YYYY') , TMTPENSIUN = TO_DATE('".$tmt."','DD-MM-YYYY')
                    WHERE nrk = '".$nrk."' ";
                }
                else if($klogad == '111111112' || $klogad =='111111113' || $klogad == '111111114')
                {
                    $upd = "UPDATE PERS_PEGAWAI1 
                    SET TMTPENSIUN = TO_DATE('".$tmt."','DD-MM-YYYY')
                    WHERE nrk = '".$nrk."' ";   
                }
                    
                   
                    $pegupd = $this->db->query($upd);

                    return $pegupd;
            }   
            
         return false;
    }


    public function updatePegawai2($nrk,$data)
    {
        $alamat = $data['alamat'];
        $rt = $data['rt'];
        $rw = $data['rw'];
        $kowil = $data['kowil'];
        $kocam = $data['kocam'];
        $kokel = $data['kokel'];
        $prop = $data['prop'];

        $alamat_ktp = $data['alamat_ktp'];
        $rt_ktp = $data['rt_ktp'];
        $rw_ktp = $data['rw_ktp'];
        $kowil_ktp = $data['kowil_ktp'];
        $kocam_ktp = $data['kocam_ktp'];
        $kokel_ktp = $data['kokel_ktp'];
        $prop_ktp = $data['prop_ktp'];


        $sql="SELECT NRK  FROM PERS_PEGAWAI2 WHERE NRK='".$nrk."' AND ROWNUM <=1";
        $peg = $this->db->query($sql);

            if ($peg->num_rows() > 0) {
                foreach ($peg->result() as $row)
                {
                    $upd = "UPDATE PERS_PEGAWAI2 
                            SET 
                                ALAMAT = UPPER('".$alamat."') , 
                                RT = '".$rt."' ,
                                RW = '".$rw."', 
                                KOWIL = '".$kowil."', 
                                KOCAM = '".$kocam."', 
                                KOKEL = '".$kokel."', 
                                PROP = '".$prop."',
                                ALAMAT_KTP = UPPER('".$alamat_ktp."') , 
                                RT_KTP = '".$rt_ktp."' ,
                                RW_KTP = '".$rw_ktp."', 
                                KOWIL_KTP = '".$kowil_ktp."', 
                                KOCAM_KTP = '".$kocam_ktp."', 
                                KOKEL_KTP = '".$kokel_ktp."', 
                                PROP_KTP = '".$prop_ktp."'  
                            WHERE nrk = '".$nrk."' ";
                    $pegupd = $this->db->query($upd);

                    return $pegupd;
                }
            }
            else
            {
                $user_id = $nrk;
                $term = $this->input->ip_address();
                if($term == '0.0.0.0') {
            $ip = explode(',', $_SERVER['REMOTE_ADDR']);
            $term = $ip[0];
        } 
                $upd = "INSERT INTO pers_pegawai2(nrk, karpeg, taspen,
                    alamat, rt, rw, kowil, kocam, kokel, prop,
                    alamat_ktp, rt_ktp, rw_ktp, kowil_ktp, kocam_ktp, kokel_ktp, prop_ktp,
                    aliran, noppen,
                    simpeda, darah, karsu, npwp, jendikcps, kodikcps, nippasif,
                    forpusat, thforpus, fordaerah, thfordrh,
                    nohp, nokk, email, notelp,
                    tinggi, berat, rambut,muka, kulit, cacat, kidal,
                    user_id,term,tg_upd)
                    VALUES ('$nrk', '', '',
                    UPPER('$alamat'), '$rt','$rw', '$kowil', '$kocam', '$kokel', '$prop',
                    UPPER('$alamat_ktp'), '$rt_ktp','$rw_ktp', '$kowil_ktp', '$kocam_ktp', '$kokel_ktp', '$prop_ktp',
                    '', '0',
                    '', '', '', '', '1', '0000', '',
                    '', '','','',
                    '', '', '', '',
                    '', '', '', '', '', '', '',
                    '$user_id','$term', SYSDATE)";
            }  
            $pegupd = $this->db->query($upd);
            return $pegupd;    
    }


/*END CEK PEGAWAI 2*/

    public function updateTitelPegawai($nrk,$data)
    {
        $titeldepan = $data['titeldepan'];
        $titelbelakang = $data['titel']; 

        $titel="SELECT TITELBELAKANG FROM PERS_PENDIDIKAN WHERE NRK='".$nrk."' AND JENDIK='1' AND SUBSTR(kodik, 0, 1) >= 4  ORDER BY TGIJAZAH ASC";
        $extitel = $this->db->query($titel);
       
        $tbelakang='';
        $numtb=$extitel->num_rows();

        
        if($numtb>=2)
        {
             $i=0;
            foreach ($extitel->result() as $value) 
            {
                $arr[$i] = $value->TITELBELAKANG;
                if($arr[$i]==null)
                {
                    $tbelakang=$tbelakang;
                }
                else
                {
                    $tbelakang = $tbelakang.", ".$arr[$i];
                }
                
                $i++;
            }
        }
        else
        {
            $tblkng = $extitel->row()->TITELBELAKANG;

            $tbelakang = ", ".$tblkng;
        }
        
        

        $titeldpn="SELECT TITELDEPAN FROM PERS_PENDIDIKAN WHERE NRK='".$nrk."' AND JENDIK='1' AND SUBSTR(kodik, 0, 1) >= 4 ORDER BY TGIJAZAH DESC";
        $extiteldepan = $this->db->query($titeldpn);
        
        $tdepan ="";
        $numtd=$extiteldepan->num_rows();
        
        
        if($numtd>=2)
        {
            $j=0;
            foreach ($extiteldepan->result() as $value) 
            {
                $arr[$j] = $value->TITELDEPAN;
                if($arr[$j]==null)
                {
                    $tdepan = $tdepan;    
                }
                else
                {
                    if($tdepan!=null)
                    {
                        $tdepan = $tdepan.",".$arr[$j];
                    }
                    else
                    {
                        $tdepan = $arr[$j];
                    }
                   
                }
                
                $j++;
            }
        }
        else
        {
            $tdpn=$extiteldepan->row()->TITELDEPAN;
            $tdepan=$tdpn;
        }

        $sql="SELECT NRK FROM PERS_PEGAWAI1 WHERE NRK='".$nrk."' AND ROWNUM <=1";
        $peg = $this->db->query($sql);

            if ($peg->num_rows() > 0) {
                foreach ($peg->result() as $row)
                {

                    $upnull = "UPDATE PERS_PEGAWAI1 SET TITELDEPAN = '', TITEL = ''
                            WHERE nrk = '".$nrk."' ";
                    $pegnull = $this->db->query($upnull);

                    $upd = "UPDATE PERS_PEGAWAI1 SET TITELDEPAN = '".$tdepan."', TITEL = '".$tbelakang."'
                            WHERE nrk = '".$nrk."' ";
                    $pegupd = $this->db->query($upd);

                    return $pegupd;
                }
            }
    }

    public function deleteFlagTitelPegawai($nrk,$data)
    {
        $titeldepan = $data['titeldepan'];
        $titelbelakang = $data['titel']; 
        $kodik = $data['kodik'];

        $titel="SELECT KODIK, TITELBELAKANG FROM PERS_PENDIDIKAN WHERE NRK='".$nrk."' AND JENDIK='1' AND KODIK>=4000 AND DELETED IS NULL ORDER BY TGIJAZAH ASC";
        $extitel = $this->db->query($titel);

        $delTitle=" SELECT KODIK,TITELBELAKANG FROM PERS_PENDIDIKAN WHERE NRK='".$nrk."' AND JENDIK='1' AND KODIK='".$kodik."' AND DELETED IS NULL ORDER BY TGIJAZAH ASC";
        $deleteTitle = $this->db->query($delTitle)->row();

        $cekKodik = $deleteTitle->KODIK;
        $cekTitel = $deleteTitle->TITELBELAKANG;
       
      
        $tbelakang='';
        $numtb=$extitel->num_rows();

    
        if($numtb>=2)
        {
             $i=0;
            foreach ($extitel->result() as $value) 
            {
                $array[$i] = $value->KODIK;
                $arr[$i] = $value->TITELBELAKANG;
                
                if($arr[$i]==null)
                {
                    $tbelakang=$tbelakang; 
                }
                else
                {
                    if($array[$i] == $cekKodik)
                    {
                        $tbelakang = $tbelakang;
                    }
                    else
                    {
                        $tbelakang = $tbelakang.", ".$arr[$i];
                    }
                }
                $i++;
            }
        }
        else
        {
            $tblkng = $extitel->row()->TITELBELAKANG;

            $tbelakang = ", ".$tblkng;
        }
        
        

        $titeldpn="SELECT KODIK, TITELDEPAN FROM PERS_PENDIDIKAN WHERE NRK='".$nrk."' AND JENDIK='1' AND KODIK>=4000 AND DELETED IS NULL ORDER BY TGIJAZAH DESC";
        $extiteldepan = $this->db->query($titeldpn);

        $delTitleD=" SELECT KODIK,TITELDEPAN FROM PERS_PENDIDIKAN WHERE NRK='".$nrk."' AND JENDIK='1' AND KODIK='".$kodik."' AND DELETED IS NULL ORDER BY TGIJAZAH ASC";
        $deleteTitleD = $this->db->query($delTitleD)->row();

        $cekKodikD = $deleteTitleD->KODIK;
        $cekTitelD = $deleteTitleD->TITELDEPAN;

        $tdepan ="";
        $numtd=$extiteldepan->num_rows();
        
        if($numtd>=2)
        {
            $j=0;
            foreach ($extiteldepan->result() as $value) 
            {
                $array[$j] = $value->KODIK;
                $arr[$j] = $value->TITELDEPAN;
                if($arr[$j]==null)
                {
                    $tdepan = $tdepan;    
                }
                else
                {
                    if($tdepan==null)
                    {
                        if($array[$j] == $cekKodik)
                        {
                            $tdepan = $tdepan;
                        }
                        else
                        {
                             $tdepan = $arr[$j];
                        }
                        
                        
                    }
                    else
                    {
                        if($array[$j] == $cekKodik)
                        {
                            $tdepan = $tdepan;
                        }
                        else
                        {
                             $tdepan = $tdepan.",".$arr[$j];
                        }
                       
                    }
                   
                }
                
                $j++;
            }
        }
        else
        {
            $tdpn=$extiteldepan->row()->TITELDEPAN;
            $tdepan=$tdpn;
        }

        $sql="SELECT NRK FROM PERS_PEGAWAI1 WHERE NRK='".$nrk."' AND ROWNUM <=1";
        $peg = $this->db->query($sql);

            if ($peg->num_rows() > 0) {
                foreach ($peg->result() as $row)
                {
                    $upnull = "UPDATE PERS_PEGAWAI1 SET TITELDEPAN = '', TITEL = ''
                            WHERE nrk = '".$nrk."' ";
                    $pegnull = $this->db->query($upnull);

                    $upd = "UPDATE PERS_PEGAWAI1 SET TITELDEPAN = '".$tdepan."', TITEL = '".$tbelakang."'
                            WHERE nrk = '".$nrk."' ";
                    $pegupd = $this->db->query($upd);

                    return $pegupd;
                }
            }
    }

    public function deleteTitelPegawai($nrk,$data)
    {
        $titeldepan = $data['titeldepan'];
        $titelbelakang = $data['titel']; 
        $kodik = $data['kodik'];

        $titel="SELECT KODIK, TITELBELAKANG FROM PERS_PENDIDIKAN WHERE NRK='".$nrk."' AND JENDIK='1' AND SUBSTR(kodik, 0, 1) >= 4 ORDER BY TGIJAZAH ASC";
        
        $extitel = $this->db->query($titel);

        $delTitle=" SELECT KODIK,TITELBELAKANG FROM PERS_PENDIDIKAN WHERE NRK='".$nrk."' AND JENDIK='1' AND KODIK='".$kodik."' ORDER BY TGIJAZAH ASC";
        $deleteTitle = $this->db->query($delTitle)->row();

        $cekKodik = $deleteTitle->KODIK;
        $cekTitel = $deleteTitle->TITELBELAKANG;
       
      
        $tbelakang='';
        $numtb=$extitel->num_rows();

    
        if($numtb>=2)
        {
             $i=0;
            foreach ($extitel->result() as $value) 
            {
                $array[$i] = $value->KODIK;
                $arr[$i] = $value->TITELBELAKANG;
                
                if($arr[$i]==null)
                {
                    $tbelakang=$tbelakang; 
                }
                else
                {
                    if($array[$i] == $cekKodik)
                    {
                        $tbelakang = $tbelakang;
                    }
                    else
                    {
                        $tbelakang = $tbelakang.", ".$arr[$i];
                    }
                }
                $i++;
            }
        }
        else
        {
            $tblkng = $extitel->row()->TITELBELAKANG;

            $tbelakang = ", ".$tblkng;
        }
        
        

        $titeldpn="SELECT KODIK, TITELDEPAN FROM PERS_PENDIDIKAN WHERE NRK='".$nrk."' AND JENDIK='1' AND SUBSTR(kodik, 0, 1) >= 4 ORDER BY TGIJAZAH DESC";
        $extiteldepan = $this->db->query($titeldpn);

        $delTitleD=" SELECT KODIK,TITELDEPAN FROM PERS_PENDIDIKAN WHERE NRK='".$nrk."' AND JENDIK='1' AND KODIK='".$kodik."' ORDER BY TGIJAZAH ASC";
        $deleteTitleD = $this->db->query($delTitleD)->row();

        $cekKodikD = $deleteTitleD->KODIK;
        $cekTitelD = $deleteTitleD->TITELDEPAN;

        $tdepan ="";
        $numtd=$extiteldepan->num_rows();
        
        if($numtd>=2)
        {
            $j=0;
            foreach ($extiteldepan->result() as $value) 
            {
                $array[$j] = $value->KODIK;
                $arr[$j] = $value->TITELDEPAN;
                if($arr[$j]==null)
                {
                    $tdepan = $tdepan;    
                }
                else
                {
                    if($tdepan==null)
                    {
                        if($array[$j] == $cekKodik)
                        {
                            $tdepan = $tdepan;
                        }
                        else
                        {
                             $tdepan = $arr[$j];
                        }
                        
                        
                    }
                    else
                    {
                        if($array[$j] == $cekKodik)
                        {
                            $tdepan = $tdepan;
                        }
                        else
                        {
                             $tdepan = $tdepan.",".$arr[$j];
                        }
                       
                    }
                   
                }
                
                $j++;
            }
        }
        else
        {
            $tdpn=$extiteldepan->row()->TITELDEPAN;
            $tdepan=$tdpn;
        }

        $sql="SELECT NRK FROM PERS_PEGAWAI1 WHERE NRK='".$nrk."' AND ROWNUM <=1";
        $peg = $this->db->query($sql);

            if ($peg->num_rows() > 0) {
                foreach ($peg->result() as $row)
                {
                    $upnull = "UPDATE PERS_PEGAWAI1 SET TITELDEPAN = '', TITEL = ''
                            WHERE nrk = '".$nrk."' ";
                    $pegnull = $this->db->query($upnull);

                    $upd = "UPDATE PERS_PEGAWAI1 SET TITELDEPAN = '".$tdepan."', TITEL = '".$tbelakang."'
                            WHERE nrk = '".$nrk."' ";
                    $pegupd = $this->db->query($upd);

                    return $pegupd;
                }
            }
    }

    function getNamaFromNRK($NRK)
    {
        $SQL = "SELECT NAMA FROM PERS_PEGAWAI1 WHERE NRK = '$NRK'";
        $QUERY = $this->db->query($SQL);
        $numrow = $QUERY->num_rows();
        $rs='';
        if($numrow == 1)
        {
            $rs = $QUERY->row()->NAMA;
        }
        else
        {
            $rs = '';
        }
        return $rs;
    }

    function getNamaFromNIP($NIP)
    {
        $SQL = "SELECT NRK,NAMA FROM PERS_PEGAWAI1 WHERE (NIP = '$NIP' OR NIP18 ='$NIP')";
        $QUERY = $this->db->query($SQL);
        $numrow = $QUERY->num_rows();
        $rs='';
        if($numrow == 1)
        {
            $rs = $QUERY->row();
        }
        else
        {
            $rs = '';
        }
        return $rs;
    }

    function getKeteranganSKP($nilai)
    {
        $sql = "SELECT KETERANGAN FROM PERS_BATASAN_NILAI_SKP WHERE '$nilai'>=NILAI_BAWAH AND '$nilai'<=NILAI_ATAS";
        $query = $this->db->query($sql);
        $rs = $query->row()->KETERANGAN;

        return $rs;
    }
    
}

?>
