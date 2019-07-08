<?php

class Mpermohonan_inproses extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }

    public function dataHdr($id_permohonan,$id_jenis_permohonan,$id_kojabf){
        $q = "SELECT
				H.ID_SYARAT_HDR,
				MEKANISME,
				DASAR_HUKUM
			  FROM
				PERS_SYARAT_HDR H
			  WHERE ID_PERMOHONAN = '$id_permohonan'
			  AND ID_JENIS_PERMOHONAN = '$id_jenis_permohonan'
			  AND ID_KOJABF = '$id_kojabf'";

        $rs = $this->db->query($q)->row();

        return $rs;
    }

    public function totPermohonan(){
        $q="";
        if($this->session->userdata('logged_in')['user_group'] == 1)
        {
            $q = "SELECT
                COUNT(ID_TRX) AS JML
              FROM
                PERS_TRX_AJU
              WHERE
              NRK = '".$this->session->userdata('logged_in')['id']."'
                ";
        }
        else if($this->session->userdata('logged_in')['user_group'] == 5)
        {
            $getspmu = $this->get_spmu();
            $countspmu = count($getspmu);

            $queryspmu="";
            if($countspmu == 2)
            {
                $queryspmu = " AND (SPMU = '".$getspmu[0]."' OR SPMU ='".$getspmu[1]."')";
            }
            else if($countspmu == 1)
            {
                $queryspmu = "AND SPMU ='".$getspmu."'";
            }
            else
            {
                $queryspmu = '7=7';
            }

            $q = "SELECT COUNT(ID_TRX) AS JML FROM PERS_TRX_AJU WHERE 1=1 $queryspmu";


        }
        else
        {
            $q = "SELECT
                COUNT(ID_TRX) AS JML
              FROM
                PERS_TRX_AJU
              
                ";
        }
        

        $rs = $this->db->query($q)->row();

        return $rs->JML;
    }

    public function dataJabfungref(){
        $q = "SELECT * FROM PERS_KOJABF_TBL";
        $rs = $this->db->query($q)->result();

        // return the result in json
        return $rs;
    }

    public function dataPermohonan($start, $temp, $length, $search){

            if($this->session->userdata('logged_in')['user_group'] == 1)
            {
                $q = "SELECT rownum, X.*
                FROM (
                    SELECT
                        DISTINCT
                        -- ROWNUM AS rn,
                        A .ID_TRX_HDR,
                        A .NO_SURAT_PERMOHONAN,
                        A .ID_SOP,
                        TO_CHAR (
                            A .TGL_SURAT_PERMOHONAN,
                            'DD-MM-YYYY'
                        ) TGL_SURAT_PERMOHONAN,
                        C.TGL_PERMOHONAN AS FULLDATE,
                        C.ID_TRX,
                        TO_CHAR(
                            C.TGL_PERMOHONAN, 
                            'DD-MM-YYYY'
                        ) TGL_PERMOHONAN,
                        C.ID_JENIS_PERMOHONAN,
                        C.STATUS_APPROVAL,
                        C.STATUS_BERJALAN,
                        C.ID AS ID_DRI_AJU,
                        C.SPMU,
                        K.ID_SOP AS ID_MASTER_SOP,
                        L.KET_USER_PRIORITY,
                        RP.KET_PERMOHONAN,
                        D .KET_JENIS_PERMOHONAN,
                        -- E .NAJABL,
                        C.NRK,
                        P .NAMA,
                        G .GOL,
                        H.NAJABL,
                        I.NAJABL AS NEW_JAB
                    FROM
                        PERS_TRX_HDR A
                    LEFT JOIN PERS_TRX_DTL B ON A .ID_TRX_HDR = B.ID_TRX_HDR
                    RIGHT JOIN PERS_TRX_AJU C ON B.ID_TRX = C.ID_TRX
                    LEFT JOIN PERS_PEGAWAI1 P ON P .NRK = C.NRK
                    LEFT JOIN PERS_REF_PERMOHONAN RP ON RP.ID_PERMOHONAN = C.ID_PERMOHONAN
                    LEFT JOIN PERS_JENIS_PERMOHONAN D ON D .ID_JENIS_PERMOHONAN = C.ID_JENIS_PERMOHONAN
                    LEFT JOIN PERS_MASTER_KOJABF E ON E .KOJAB = C.ID_KOJABF
                    LEFT JOIN PERS_RB_GAPOK_HIST F ON C.NRK = F.NRK
                    LEFT JOIN PERS_PANGKAT_TBL G ON F.KOPANG = G .KOPANG
                    LEFT JOIN \"vw_jabatan_terakhir\" H ON C.NRK = H.NRK
                    LEFT JOIN PERS_KOJABF_TBL I ON C.ID_KOJABF = I.KOJAB
                    LEFT JOIN MASTER_DETAIL_SOP K ON C.ID = K.ID
                    LEFT JOIN MASTER_USER_PRIORITY L ON K.PELAKSANA = L.ID_USER_PRIORITY
                    WHERE
                        F .TMT = (
                            SELECT
                                MAX (TMT)
                            FROM
                                PERS_RB_GAPOK_HIST
                            WHERE
                                NRK = C .NRK
                        )
                    AND F .GAPOK = (
                        SELECT
                            MAX (GAPOK)
                        FROM
                            PERS_RB_GAPOK_HIST
                        WHERE
                            NRK = C .NRK
                        AND TMT = F .TMT
                    )
                    AND C.NRK = ".$this->session->userdata('logged_in')['id']."
                    ORDER BY FULLDATE DESC
                ) X";
                // $q .=" WHERE RN > ".$start." AND RN <= ".$temp." AND ROWNUM <= ".$length."";
                $q .=" WHERE ROWNUM <= ".$length."";
            }
            else
            {

                if($_SESSION['logged_in']['user_group'] == "5")
                {
                    $getspmu = $this->get_spmu();
                    $countspmu = count($getspmu);
       
                    $queryspmu="";
                    if($countspmu == 2)
                    {
                        $queryspmu = " AND (C.SPMU = '".$getspmu[0]."' OR C.SPMU ='".$getspmu[1]."')";
                    }
                    else
                    {
                        $queryspmu = "AND C.SPMU ='".$getspmu."'";
                    }    
                }
                else
                {
                    $queryspmu ="6=6";
                }
				
				//$spmu_query = ($_SESSION['logged_in']['user_group'] == "5" ? "AND C.SPMU = '{$get_spmu}'" : "");
                $q = "SELECT ROWNUM, Y.* FROM(

                SELECT ROWNUM AS rn, X.*
                FROM (
                    SELECT
                        DISTINCT
                        --ROWNUM AS rn,
                        A .ID_TRX_HDR,
                        A .NO_SURAT_PERMOHONAN,
                        A .ID_SOP,
                        TO_CHAR (
                            A .TGL_SURAT_PERMOHONAN,
                            'DD-MM-YYYY'
                        ) TGL_SURAT_PERMOHONAN,
                        C.ID_TRX,
                        TO_CHAR(
                            C.TGL_PERMOHONAN, 
                            'DD-MM-YYYY'
                        ) TGL_PERMOHONAN,
                        C.ID_JENIS_PERMOHONAN,
                        C.STATUS_APPROVAL,
                        C.STATUS_BERJALAN,
                        C.ID AS ID_DRI_AJU,
                        C.SPMU,
                        K.ID_SOP AS ID_MASTER_SOP,
                        L.KET_USER_PRIORITY,
                        RP.KET_PERMOHONAN,
                        D .KET_JENIS_PERMOHONAN,
                        C.NRK,
                        P .NAMA,
                        G .GOL,
                        H.NAJABL,
                        I.NAJABL AS NEW_JAB
                    FROM
                        PERS_TRX_HDR A
                    LEFT JOIN PERS_TRX_DTL B ON A .ID_TRX_HDR = B.ID_TRX_HDR
                    RIGHT JOIN PERS_TRX_AJU C ON B.ID_TRX = C.ID_TRX
                    LEFT JOIN PERS_PEGAWAI1 P ON P .NRK = C.NRK
                    LEFT JOIN PERS_REF_PERMOHONAN RP ON RP.ID_PERMOHONAN = C.ID_PERMOHONAN
                    LEFT JOIN PERS_JENIS_PERMOHONAN D ON D .ID_JENIS_PERMOHONAN = C.ID_JENIS_PERMOHONAN
                    LEFT JOIN PERS_MASTER_KOJABF E ON E .KOJAB = C.ID_KOJABF
                    LEFT JOIN PERS_RB_GAPOK_HIST F ON C.NRK = F.NRK
                    LEFT JOIN PERS_PANGKAT_TBL G ON F.KOPANG = G .KOPANG
                    LEFT JOIN \"vw_jabatan_terakhir\" H ON C.NRK = H.NRK
                    LEFT JOIN PERS_KOJABF_TBL I ON C.ID_KOJABF = I.KOJAB
                    LEFT JOIN MASTER_DETAIL_SOP K ON C.ID = K.ID
                    LEFT JOIN MASTER_USER_PRIORITY L ON K.PELAKSANA = L.ID_USER_PRIORITY
                    WHERE
                        F .TMT = (
                            SELECT
                                MAX (TMT)
                            FROM
                                PERS_RB_GAPOK_HIST
                            WHERE
                                NRK = C .NRK
                        )
                    AND F .GAPOK = (
                        SELECT
                            MAX (GAPOK)
                        FROM
                            PERS_RB_GAPOK_HIST
                        WHERE
                            NRK = C .NRK
                        AND TMT = F .TMT
                    )
                    {$queryspmu}
                    AND (C.NRK LIKE '$search%' OR P.NAMA LIKE '$search%' OR A.NO_SURAT_PERMOHONAN LIKE '$search%' OR G.GOL LIKE '$search%')
                    ORDER BY TGL_PERMOHONAN DESC
                ) X ) Y";
                 $q .=" WHERE RN > ".$start." AND RN <= ".$temp." AND ROWNUM <= ".$length."";
                //$q .=" WHERE ROWNUM <= ".$length."";
            }

        
        $rs = $this->db->query($q)->result();

        return $rs;
    }


	public function get_spmu(){
            $file = file_get_contents(base_url('assets/skpd.txt'));

            $pendidikan= array('C040','C041');
            $kesehatan = array('C030','C031');

            if($file)
            {
                $rows = explode("\n", $file);   
                array_shift($rows);

                foreach($rows as $row)
                {
                    $isi = explode('|',$row);
                    if(rtrim($isi[2]) == $_SESSION['logged_in']['id'])
                    {
                        if($_SESSION['logged_in']['id'] == '1.01.001')
                        {
                            return $pendidikan;
                        }
                        else if($_SESSION['logged_in']['id'] == '1.02.001')
                        {
                            return $kesehatan;
                        }
                        else
                        {
                            return $isi[0]; 
                        }

                    }
                }
            }
            
            
        }


    public function dataPermohonan2()
    {
        $q = "SELECT * FROM PERS_REF_PERMOHONAN";
        $rs = $this->db->query($q)->result();

        // return the result in json
        return $rs;
    }

    public function dataJnsPermohonan($id_permohonan)
    {
        $q = "SELECT *
              FROM PERS_JENIS_PERMOHONAN
              WHERE ID_PERMOHONAN='$id_permohonan'";
        $rs = $this->db->query($q)->result();

        // return the result in json
        return $rs;
    }

    public function dataJabFung2()
    {
        $q = "SELECT * FROM PERS_MASTER_KOJABF";
        $rs = $this->db->query($q)->result();

        // return the result in json
        return $rs;
    }

    public function dataInitSyarat($init_syarat)
    {
        $q = "SELECT COUNT(INIT_SYARAT) AS JML
            FROM PERS_SYARAT_DTL
            WHERE INIT_SYARAT='$init_syarat'";
        $rs = $this->db->query($q)->row();

        return $rs->JML;
    }

    public function newIdHdr(){
        $q = "SELECT MAX(ID_SYARAT_HDR) AS NID
              FROM PERS_SYARAT_HDR";
        $rs = $this->db->query($q)->row();

        // return the result in json
        return $rs->NID+1;
    }

    public function newIdDtl(){
        $q = "SELECT MAX(ID_SYARAT_DTL) AS NID
              FROM PERS_SYARAT_DTL";
        $rs = $this->db->query($q)->row();

        // return the result in json
        return $rs->NID+1;
    }

    public function tambah($tbl,$data)
    {
     //   $this->db->insert($tbl, $data);
       //echo $this->db->last_query();
        $x = array_keys($data);
        $y = implode(',', $x);
        $z = "'".implode("','", $data)."'";
        $q = "INSERT INTO $tbl ( $y ) VALUES ( $z )";
//        echo $q;
        $this->db->query($q);
        
        return $this->db->affected_rows();
    }

    public function ubah($tbl,$data,$pk)
    {
//        $this->db->update($tbl, $data, $id);
        $fields = "";
        foreach ($data as $k => $v) {
            $fields .= "$k = '$v',";
        }
        $fields = substr($fields,0,-1);

        $pks = "";
        foreach ($pk as $k => $v) {
            $pks .= "$k = '$v'";
        }

        $q = "UPDATE $tbl SET $fields WHERE $pks";
//        echo $q;
        $this->db->query($q);

        return $this->db->affected_rows();
    }

    public function hapus($tbl,$pk){
        $this->db->delete($tbl, $pk);

        return $this->db->affected_rows();
    }

    // public function dataTracking($id_trx)
    // {
    //    $sql = "SELECT NRK
    //             from PERS_TRX_AJU
    //             where ID_TRX = '".$id_trx."'";

    //     return $this->db->query($sql);
    // }

    public function dataTracking($id_trx)
    {
       $sql = $this->Model_umum->QuerySingleValue("SELECT b.NRK, c.NAMA
            from PERS_TRX_AJU b
            LEFT JOIN PERS_PEGAWAI1 c on b.NRK = c.NRK
            where b.ID_TRX = '".$id_trx."'" );

        return $sql;
    }

    // public function cek_status($id_trx)
    // {
    //     $sql = ("SELECT 
    //             URUTAN as URUTAN_TOLAK
    //             FROM PERS_TRX_TOLAK 
    //             WHERE ID_TRX = ".$id_trx."
    //         ");
    //     $rs = $this->db->query($sql)->row();
    //     return $rs;
    // }

    public function cek_status($id_trx)
    {
        $sql = $this->Model_umum->QuerySingleValue("SELECT 
                URUTAN as URUTAN_TOLAK,
                KETERANGAN
                FROM PERS_TRX_TOLAK 
                WHERE ID_TRX = ".$id_trx."
            ");
        return $sql;
    }

    public function dataTracking2($id_trx_hdr)
    {
       $sql = $this->Model_umum->QuerySingleValue("SELECT NO_SURAT_PERMOHONAN 
            from PERS_TRX_HDR
            where ID_TRX_HDR = '".$id_trx_hdr."'" );

        return $sql;
    }

    public function detail($id_trx_hdr){
        $sql = $this->Model_umum->QueryMultiValue
            ("SELECT 
                C .NO_SURAT,
                C .TGL_SURAT,
                A .ID_SOP,
                A .ID_TRX_HDR,
                B.DESKRIPSI_SOP,
                B.URUTAN,
                C.KETERANGAN,
                C.STATUS,
                C.NO_SURAT
            FROM
                PERS_TRX_HDR A
            LEFT JOIN MASTER_DETAIL_SOP B ON A .ID_SOP = B.ID_SOP
            LEFT JOIN PERS_TRACKING C ON A .ID_TRX_HDR = C.ID_TRX_HDR AND B.URUTAN = C.URUTAN
            WHERE
                A .ID_TRX_HDR = ".$id_trx_hdr."
            ORDER BY B.URUTAN ASC");
            // echo $sql;
        return $sql;
    }

    public function detailPgw($id_trx)
    {
        $sql = $this->Model_umum->QueryMultiValue
            ("SELECT
                A .ID_SOP,
                A .ID_TRX,
                B.DESKRIPSI_SOP,
                A.STATUS_APPROVAL as STATUS,
                B.URUTAN
            FROM
                PERS_TRX_AJU A
            LEFT JOIN MASTER_DETAIL_SOP B ON A .ID_SOP = B.ID_SOP
            WHERE
                A .ID_TRX = ".$id_trx."
            ORDER BY
                B.URUTAN ASC");

           

        return $sql;
    }

}
?>
