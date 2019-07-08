<?php

class Mmst_permohonanjabfung extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }

    public function totJabFung(){
        $q = "SELECT
				COUNT(KOJAB) AS JML
			  FROM
				PERS_MASTER_KOJABF";

        $rs = $this->db->query($q)->row();

        return $rs->JML;
    }

    public function dataPermohonan($start, $temp, $length, $search){
        $q = "SELECT rownum, X.*
				FROM (
					SELECT rownum as rn,
						ID_PERMOHONAN,
						KET_PERMOHONAN
               		FROM PERS_REF_PERMOHONAN
                  	WHERE KET_PERMOHONAN LIKE '%$search%'
				  	ORDER BY KET_PERMOHONAN
				) X";
        $q .=" WHERE RN > ".$start." AND RN <= ".$temp." AND ROWNUM <= ".$length."";
//        echo $q;
        $rs = $this->db->query($q)->result();

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

    public function dataTrxDtl(){
        $requestData = $this->input->post();
        $id_permohonan = ($requestData['id_permohonan']>0)?$requestData['id_permohonan']:0;

        $sql = "SELECT *
              FROM PERS_JENIS_PERMOHONAN
              WHERE ID_PERMOHONAN='$id_permohonan'";
//			echo $sql;
        $query = $this->db->query($sql);
        $totalData = $query->num_rows();
        $totalFiltered = $totalData;

        $dataaa=array();
        $no=1;
        foreach ($query->result() as $row)
        {
            $nestedData= array();
            $nestedData[] = $no;
            $nestedData[] = $row->KET_JENIS_PERMOHONAN;
            $nestedData[] = "<div class='col-sm-12' align='center'><button class='btn btn-outline btn-xs btn-success' title='edit' onclick='editDtl(".$row->ID_JENIS_PERMOHONAN.",$(this).parents(\"tr\"))'><i class='fa fa-pencil-square'></i></button></div>";

            $dataaa[]=$nestedData;
            $no++;
        }

        $json_data = array(
            "draw"            => intval( $requestData['draw'] ),
            "recordsTotal"    => intval( $totalData ),
            "recordsFiltered" => intval( $totalFiltered ),
            "data"            => $dataaa
        );

        return json_encode($json_data);
    }

    public function newIdHdr(){
        $q = "SELECT MAX(ID_PERMOHONAN) AS NID
              FROM PERS_REF_PERMOHONAN";
        $rs = $this->db->query($q)->row();

        // return the result in json
        return $rs->NID+1;
    }

    public function newIdDtl(){
        $q = "SELECT MAX(ID_JENIS_PERMOHONAN) AS NID
              FROM PERS_JENIS_PERMOHONAN";
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