<?php

class Msyaratpermohonan extends CI_Model {

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

    public function get_syarat_wajib()
    {
        $query = "SELECT * FROM PERS_SYARAT_WAJIB_PERMOHONAN";

        $result = $this->db->query($query);

        $option = null;
        foreach($result->result() as $row){
            $option .= "<option value='".$row->ID_SYARAT_WAJIB."'>&nbsp; ".$row->KET_SYARAT_WAJIB."</option>";
        }

        return $option;
    }

    public function totPersyaratan($id_permohonan, $id_jenis_permohonan, $id_kojabf){
        $q = "SELECT
				COUNT(ID_SYARAT_DTL) AS JML
			  FROM
				PERS_SYARAT_HDR H, PERS_SYARAT_DTL D
			  WHERE H.ID_SYARAT_HDR=D.ID_SYARAT_HDR
			  AND ID_PERMOHONAN = '$id_permohonan'
			  AND ID_JENIS_PERMOHONAN = '$id_jenis_permohonan'
			  AND ID_KOJABF = '$id_kojabf'";

        $rs = $this->db->query($q)->row();

        return $rs->JML;
    }

    public function dataPersyaratan($id_permohonan, $id_jenis_permohonan, $id_kojabf, $golru, $start, $temp, $length){
        $q = "SELECT rownum, X.*
				FROM (
					SELECT rownum as rn,
						ID_SYARAT_DTL,
						NO_SYARAT,
						KET_SYARAT,
						INIT_SYARAT
               		FROM PERS_SYARAT_HDR H, PERS_SYARAT_DTL D
                  	WHERE H.ID_SYARAT_HDR=D.ID_SYARAT_HDR
				  	AND ID_PERMOHONAN = '$id_permohonan'
				  	AND ID_JENIS_PERMOHONAN = '$id_jenis_permohonan'
				  	AND ID_KOJABF = '$id_kojabf'
				  	ORDER BY NO_SYARAT
				) X";
        $q .=" WHERE RN > ".$start." AND RN <= ".$temp." AND ROWNUM <= ".$length."";
        // var_dump($q);
        $rs = $this->db->query($q)->result();

        return $rs;
    }

    public function get_master_syarat($key)
    {
        $query = "SELECT KET_SYARAT_WAJIB, INIT_SYARAT_WAJIB FROM PERS_SYARAT_WAJIB_PERMOHONAN WHERE ID_SYARAT_WAJIB = {$key}";
        return $this->db->query($query)->row();
    }

    public function dataPermohonan()
    {
        $q = "SELECT * FROM PERS_REF_PERMOHONAN";
        $rs = $this->db->query($q)->result();

        // return the result in json
        return $rs;
    }

    public function dataJnsPermohonan($id_permohonan,$req)
    {
        if($req!=null)
        {
            $q = "SELECT *
              FROM PERS_JENIS_PERMOHONAN
              WHERE ID_PERMOHONAN='$id_permohonan' AND KET_JENIS_PERMOHONAN LIKE UPPER ('%".$req."%')";
        }
        else
        {
            $q = "SELECT *
              FROM PERS_JENIS_PERMOHONAN
              WHERE ID_PERMOHONAN='$id_permohonan'";    
        }
        
        $rs = $this->db->query($q)->result();

        // return the result in json
        return $rs;
    }

    public function dataJabFung()
    {
        //var_dump($_GET['q']);exit;
        if(isset($_GET['q']))
        {
            $q = "SELECT A.*, B.GOL FROM PERS_MASTER_KOJABF A LEFT JOIN PERS_PANGKAT_TBL_NOW B ON A.GOLRU = B.KOPANG WHERe A.NAJABL LIKE UPPER('%".$_GET['q']."%')";
        }
        else
        {
            $q = "SELECT A.*, B.GOL FROM PERS_MASTER_KOJABF A LEFT JOIN PERS_PANGKAT_TBL_NOW B ON A.GOLRU = B.KOPANG";
        }
        
        $rs = $this->db->query($q)->result();

        // return the result in json
        return $rs;
    }

    public function dataInitSyarat($data)
    {

        $q = "SELECT COUNT(INIT_SYARAT) AS JML
            FROM PERS_SYARAT_DTL
            WHERE INIT_SYARAT='{$data['init_syarat']}'";
        // var_dump($q);exit;
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
        // var_dump(array_keys($data));exit;
     //   $this->db->insert($tbl, $data);
       //echo $this->db->last_query();

        $x = array_keys($data);
        $y = implode(',', $x);
        
        $z = "'".implode("','", $data)."'";
        
        $q = "INSERT INTO $tbl ( $y ) VALUES ( $z )";
        // var_dump($q);exit;
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
        // var_dump($q);exit;
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