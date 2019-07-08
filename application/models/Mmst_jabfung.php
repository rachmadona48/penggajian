<?php

class Mmst_jabfung extends CI_Model {

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

    public function totJabFung(){
        $q = "SELECT
				COUNT(KOJAB) AS JML
			  FROM
				PERS_MASTER_KOJABF";

        $rs = $this->db->query($q)->row();

        return $rs->JML;
    }

    public function dataTingkat(){
        $q = "SELECT * FROM PERS_MASTER_TINGKAT";
        $rs = $this->db->query($q)->result();

        // return the result in json
        return $rs;
    }

    public function dataJenjab(){
        $q = "SELECT * FROM PERS_MASTER_JENJAB";
        $rs = $this->db->query($q)->result();

        // return the result in json
        return $rs;
    }

    public function dataJenjab1($tingkat){
        $q = "SELECT * FROM PERS_MASTER_JENJAB
              WHERE ID_TINGKAT='$tingkat'";
//        echo $q;
        $rs = $this->db->query($q)->result();

        // return the result in json
        return $rs;
    }

    public function dataGolru1($jenjab){
        $q = "SELECT A.KOPANG, B.GOL
              FROM PERS_MASTER_JENGOL A
              LEFT JOIN PERS_PANGKAT_TBL_NOW B ON A.KOPANG=B.KOPANG
              WHERE ID_JENJAB='$jenjab'";
//        echo $q;
        $rs = $this->db->query($q)->result();

        // return the result in json
        return $rs;
    }

    public function dataGolru(){
        $q = "SELECT KOPANG, GOL FROM PERS_PANGKAT_TBL_NOW";
        $rs = $this->db->query($q)->result();

        // return the result in json
        return $rs;
    }

    public function dataJabfungref(){
        //$q = "SELECT * FROM PERS_KOJABF_TBL";
        $q = "SELECT * FROM PERS_MASTER_KOJABF";
        $rs = $this->db->query($q)->result();

        // return the result in json
        return $rs;
    }

    public function dataJabfung($start, $temp, $length, $search){
        $q = "SELECT rownum, X.*
				FROM (
					SELECT rownum as rn,
						A.KOJAB,
						A.NAJABL,
						A.TINGKAT,
						A.JENJAB,
						A.GOLRU,
						A.USIA_PENSIUN,
                        A.USIA_PENGANGKATAN,
						B.NAJABL AS NM_JAB,
						C.NM_TINGKAT,
						D.NM_JENJAB,
						E.GOL
               		FROM PERS_MASTER_KOJABF A
               		LEFT JOIN PERS_KOJABF_TBL B ON B.KOJAB=A.KOJAB
               		LEFT JOIN PERS_MASTER_TINGKAT C ON C.ID_TINGKAT=A.TINGKAT
               		LEFT JOIN PERS_MASTER_JENJAB D ON D.ID_JENJAB=A.JENJAB
               		LEFT JOIN PERS_PANGKAT_TBL_NOW E ON E.KOPANG=A.GOLRU
                  	WHERE A.KOJAB LIKE '$search%'
                  	OR A.NAJABL LIKE '%$search%'
				  	ORDER BY KOJAB
				) X";
        $q .=" WHERE RN > ".$start." AND RN <= ".$temp." AND ROWNUM <= ".$length."";
//        echo $q;
        $rs = $this->db->query($q)->result();

        return $rs;
    }

    public function dataPermohonan()
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

}
?>