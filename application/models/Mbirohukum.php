<?php
	
class Mbirohukum extends CI_Model
{
	public function getdatasubbid(){
		$requestData = $this->input->post();
		// var_dump($requestData);exit;
		$aoColumns = array(
            0 => 'NO',
            1 => 'NRK',
            2 => 'NO_SURAT_SUBBID',
            3 => 'TGL_SURAT_SUBBID',
            4 => 'AKSI',
            5 => 'VALID'
            //5 => 'KET_JENIS_PERMOHONAN'
        );
		

		$sql = "SELECT
					A.ID_TRX_SUBBID,
					A.TGL_SURAT_SUBBID,
					A.NO_SURAT_SUBBID,
					D.NRK
				FROM
					PERS_TRX_SUBBID A
				LEFT JOIN PERS_TRX_TUBKD B ON A.ID_TRX_TU = B.ID_TRX_TU
				LEFT JOIN PERS_TRX_SKPD C ON B.ID_TRX_SKPD = C.ID_TRX_SKPD
				LEFT JOIN PERS_TRX_AJU D ON C.ID_TRX= D.ID_TRX
				WHERE 
				A.STATUS_APPROVAL = 2
				AND B.STATUS_APPROVAL_SB = 1
				AND C.STATUS_APPROVAL_TU = 1
				AND D.STATUS_APPROVAL = 1";
		$query = $this->db->query($sql);
		$totalData = $query->num_rows();
		$totalFiltered = $totalData;

		$dataaa=array();
		$no=1;
		foreach ($query->result() as $row)
        {   
        	$tgl = explode('-',$row->TGL_SURAT_SUBBID);
        	
            $nestedData= array();
            $nestedData[] = $no;
            $nestedData[] =  '<span id="id_trx_subbid">'.$row->ID_TRX_SUBBID.'</span><input type="hidden" name="id_trx_subbid_post[]" value="'.$row->ID_TRX_SUBBID.'">';
            $nestedData[] = '<span id="table_nrk">'.$row->NRK.'</span><span style="display:none">~</span>';
            $nestedData[] = '<span id="table_no_surat_subbid">'.$row->NO_SURAT_SUBBID.'</span>';
            $nestedData[] = '<span id="table_tgl_surat_subbid">'.$row->TGL_SURAT_SUBBID.'</span>';
            $nestedData[] = '<button class="btn btn-primary" data-toggle="modal" data-target="#myModal" id="test_btn" onclick="tes('.$row->NRK.',&#39;'.$row->NO_SURAT_SUBBID.'&#39;,&#39;'.$tgl[0].'-'.$tgl[1].'-'.$tgl[2].'&#39;);"> cek File </button>';
            $nestedData[] = '<a onClick="valid_yes('.$row->ID_TRX_SUBBID.')" id="valid_yes">Yes</a>/<a onClick="valid_no('.$row->ID_TRX_SUBBID.')" id="valid_no">No</a>';
            //$nestedData[] = $row->KET_JENIS_PERMOHONAN;

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

	public function get_permohonan()
	{
		$sql = "SELECT * FROM PERS_REF_PERMOHONAN";
		$query = $this->db->query($sql);
			
		return $query;
	}

	public function get_jenis_permohonan($where)
	{
		$sql = "SELECT * FROM PERS_JENIS_PERMOHONAN WHERE ID_PERMOHONAN = '".$where."'";
			
		$query = $this->db->query($sql);
			
		return $query;
	}

	public function get_detail_pegawai($prm){

		$sql2 = "SELECT
					A .NRK,
					A .NAMA,
					B.ALAMAT,
					B.RT,
					B.RW,
					C.NAMA AS NAWIL,
						D.NAMA AS NACAM,
						E.NAMA AS NAKEL,
					I.ID_TRX_SUBBID
				FROM
					PERS_PEGAWAI1 A
				LEFT JOIN PERS_PEGAWAI2 B ON A .NRK = B.NRK
				LEFT JOIN LOKASI C ON B.KOWIL = C.KODE
		            LEFT JOIN LOKASI D ON B.KOCAM = D.KODE
		            LEFT JOIN LOKASI E ON B.KOKEL = E.KODE
				LEFT JOIN PERS_TRX_AJU F ON A .NRK = F.NRK
				LEFT JOIN PERS_TRX_SKPD G ON F.ID_TRX = G .ID_TRX
				LEFT JOIN PERS_TRX_TUBKD H ON G .ID_TRX_SKPD = H .ID_TRX_SKPD
				LEFT JOIN PERS_TRX_SUBBID I ON H .ID_TRX_TU = I.ID_TRX_TU
				WHERE
					A .NRK = '".$prm."'
				AND F.STATUS_APPROVAL = 1
				AND G .STATUS_APPROVAL_TU = 1
				AND H .STATUS_APPROVAL_SB = 1
				AND I.STATUS_APPROVAL = 2";
		$query1 = $this->db->query($sql2);
		// var_dump($query1->result());exit;
		foreach ($query1->result() as $res) {
			// $data = 'nrk'. $res->NRK; 
			$arrayName = array('id_trx_subbid' => $res->ID_TRX_SUBBID, 'nrk' => $res->NRK, 'nama' => $res->NAMA);
		}
		/*, 'alamat' => $res->ALAMAT, 'rt' => $res->RT, 
				'rw' => $res->RW, 'nama_wilayah' => $res->NAWIL, 'nama_kecamatan' => $res->NACAM, 'nama_kelurahan' => $res->NAKEL*/
		$result = json_encode($arrayName);
        return $result;
	}

	public function insert_data($data){
		
		$count = $data['id_trx_subbid'];
		$no_surat = $data['no_surat_bh'];
		$tgl_surat = $data['tgl_surat'];
		$ref_prm = $data['ref_prm'];
			$jns_prm = $data['jns_prm'];
		$status_approval = 2;
		
		$sql = array();
		$upd = array();
		for ($i=0; $i < count($count); $i++) { 
			$upd[$i] = "UPDATE PERS_TRX_SUBBID SET STATUS_APPROVAL = 1 WHERE ID_TRX_SUBBID = ".$data['id_trx_subbid'][$i]."";

			$exupd[$i] = $this->db->query($upd[$i]);

			$date = date('Y-m-d H:i:s', time());
			$sql[$i] = "INSERT INTO PERS_TRX_BH
						  VALUES
						  (
							(
								SELECT COUNT (*) + 1 FROM PERS_TRX_BH
							),
							TO_CHAR (TO_DATE ('".$tgl_surat."','DD-MM-YYYY')
							),
							'".$no_surat."',
							".$status_approval.",
							".$data['id_trx_subbid'][$i].",
							".$ref_prm.",
							".$jns_prm."
						  )";
			$exsql[$i] = $this->db->query($sql[$i]);
		}
		return count($count);
	}

	public function update_data($data){
			$count = $data['id_trx_subbid'];
			
			$upd = array();
			for ($i=0; $i < count($count); $i++) { 
				
				$upd[$i] = "UPDATE PERS_TRX_SUBBID SET STATUS_APPROVAL = 3 WHERE ID_TRX_SUBBID = ".$data['id_trx_subbid'][$i]."";
				$exupd[$i] = $this->db->query($upd[$i]);

			}
			return count($count);	
		}

	public function get_persyaratan_model(){
		$where = $this->input->post();
		
		$nrk_post = $where['NRK'];
		$ref_prm = $where['ID_PERMOHONAN'];
		$jns_prm = $where['ID_JENIS'];
		$id_trx = $where['ID_TRX_SUBBID'];
		// var_dump($where);exit;
		// $sql = "SELECT * FROM PERS_DTL_TRX_AJU A LEFT JOIN PERS_SYARAT_PERMOHONAN B ON A.ID_SYARAT = B.ID_SYARAT WHERE A.NRK = '178090' AND A.ID_PERMOHONAN = '1'";
		$sql = "SELECT
						A .FILE_SYARAT,
						B.NRK,
						B.TGL_PERMOHONAN,
						B.ID_PERMOHONAN,
						B.ID_JENIS_PERMOHONAN,
						C.KET_SYARAT,
						C.ID_SYARAT
					FROM
						PERS_DTL_TRX_AJU A
					LEFT JOIN PERS_TRX_AJU B ON A .ID_TRX = B.ID_TRX
					LEFT JOIN PERS_TRX_SKPD E ON E.ID_TRX = B.ID_TRX
					LEFT JOIN PERS_TRX_TUBKD F ON E.ID_TRX_SKPD = F.ID_TRX_SKPD
					LEFT JOIN PERS_TRX_SUBBID G ON F.ID_TRX_TU = G.ID_TRX_TU
					LEFT JOIN PERS_SYARAT_PERMOHONAN C ON B.ID_PERMOHONAN = C.ID_PERMOHONAN
					AND B.ID_JENIS_PERMOHONAN = C.ID_JENIS_PERMOHONAN
					AND A .ID_SYARAT = C.ID_SYARAT
					WHERE
						B.NRK = '".$nrk_post."'
					AND B.ID_PERMOHONAN = ".$ref_prm."
					AND B.ID_JENIS_PERMOHONAN = ".$jns_prm."
					AND G.ID_TRX_SUBBID = ".$id_trx."
					ORDER BY
						C.ID_SYARAT";
		// var_dump($sql);exit;
		// echo $sql;
		$query = $this->db->query($sql);
		$no = 1;
		$table = "";
		// var_dump(site_url('assets/file_permohonan'));exit;
		// var_dump($query->result());exit;
		foreach ($query->result() as $row)
        {            
            $table .= "<tr>";
            $table .= "<td>".$no++."</td>";
            $table .= "<td>".$row->KET_SYARAT."</td>";
            if(!empty($row->FILE_SYARAT)){
	            $table .= "<td id='ket_syarat'>Ada</td>";
	            $table .= "<td class='text-center'><a href='".site_url('assets/file_permohonan/'.$row->FILE_SYARAT)."' target='external'><i class='fa fa-external-link' aria-hidden='true'></i></a></td>";
        	}else{
        		$table .= "<td id='ket_syarat'>Tidak Ada</td>";
	            $table .= "&nbsp;";
        	}
            // $table .= "<td class='text-center'><a><i class='fa fa-files-o' aria-hidden='true'></i></a></td>";
            $table .= "</tr>";	            
            //$no++;	            
        }
        


        $json_data = array(
        	//"dataPegawai" => $arrayName,
            "dataTable" => $table
        );

        $result = json_encode($json_data);
        // var_dump($result);exit;
        return $result;
	}	
	
}