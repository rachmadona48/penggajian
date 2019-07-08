<?php
	
	class Mtubkd extends CI_Model{

		public function get_all_permohonan($param){
			 $requestData = $this->input->post();

			$q="SELECT COUNT (A.ID_TRX_HDR) JML 
				FROM PERS_TRACKING A
				WHERE A.URUTAN = $param AND A.STATUS = 2";

			$rs = $this->db->query($q)->result();
        	$totalData = $rs[0]->JML;

			$sql = "SELECT ROWNUM,X.* FROM
					(
						SELECT ROWNUM AS RN, ID_TRACKING, ID_TRX_HDR,NO_SURAT_PERMOHONAN,TGL_SURAT_PERMOHONAN,ID_SOP,KET_PERMOHONAN,KET_JENIS_PERMOHONAN
						FROM
						(
							SELECT DISTINCT A.ID_TRACKING, A.ID_TRX_HDR,B.NO_SURAT_PERMOHONAN, TO_CHAR(B.TGL_SURAT_PERMOHONAN,'DD-MM-YYYY')TGL_SURAT_PERMOHONAN, B.ID_SOP,D.ID_PERMOHONAN, D.ID_JENIS_PERMOHONAN,E.KET_PERMOHONAN,F.KET_JENIS_PERMOHONAN FROM PERS_TRACKING A
							LEFT JOIN PERS_TRX_HDR B ON A.ID_TRX_HDR = B.ID_TRX_HDR
							LEFT JOIN PERS_TRX_DTL C ON A.ID_TRX_HDR = C.ID_TRX_HDR
							LEFT JOIN PERS_TRX_AJU D ON C.ID_TRX = D.ID_TRX
							LEFT JOIN PERS_REF_PERMOHONAN E ON E.ID_PERMOHONAN = D.ID_PERMOHONAN
							LEFT JOIN PERS_JENIS_PERMOHONAN F ON D.ID_JENIS_PERMOHONAN = F.ID_JENIS_PERMOHONAN
							WHERE A.URUTAN = $param AND A.STATUS = 2 AND B.ID_SOP = {$_SESSION['logged_in']['id_sop']}
							ORDER BY A.ID_TRX_HDR DESC
						) PRM 
					)X ";
			$sql.="WHERE 1=1";

			// echo $sql;

			if( !empty($requestData['search']['value']) ) {   // if there is a search parameter, $requestData['search']['value'] contains search parameter
            $sql.=" AND ( X.ID_TRX_HDR LIKE ('%".$requestData['search']['value']."%') ";    
            $sql.=" OR X.NO_SURAT_PERMOHONAN LIKE UPPER ('%".$requestData['search']['value']."%') ";
            $sql.=" OR X.KET_JENIS_PERMOHONAN LIKE UPPER ('%".$requestData['search']['value']."%') ";
            $sql.=" OR X.KET_PERMOHONAN LIKE UPPER ('%".$requestData['search']['value']."%') ";
            $sql.=" OR X.ID_SOP LIKE UPPER('%".$requestData['search']['value']."%') )";
			}

			$sql.=" AND RN > ".$requestData['start']."  AND ROWNUM <= ".$requestData['length'];

			$result = $this->db->query($sql);
			$totalFiltered = $result->num_rows();

            $dataaa=array();
			$no=$requestData['start']+1;
			foreach ($result->result() as $row)
	         {            
	             $nestedData = array();
	             $nestedData[] = $no;
                 /*<td><a id="detail_list_prm" onClick="detail_list_prm(<?php echo $row->ID_TRX_HDR ?>)">Detail</a></td>*/
	             $nestedData[] = $row->NO_SURAT_PERMOHONAN;
	             $nestedData[] = $row->TGL_SURAT_PERMOHONAN;
	             $nestedData[] = $row->KET_PERMOHONAN;
	             $nestedData[] = $row->KET_JENIS_PERMOHONAN;
	             
	             if($param == 4)
	             {
	             	$nestedData[] = "<button type='button' class='btn-block btn btn-warning btn-xs' onclick='lihatStatus(".$row->ID_TRX_HDR.",&#39;".$row->NO_SURAT_PERMOHONAN."&#39;)'>Alur Proses</button> <a id='detail_list_prm' onClick='detail_list_prm(&#39; $row->ID_TRX_HDR &#39;)' class='btn-block btn btn-success btn-xs'>Pegawai</a> 
	             		"; //<button type=\"button\" class=\"btn-block btn btn-info btn-xs\" onclick=\"cetakPerbal(".$row->ID_TRX_HDR.",3)\" id=\"cetak_perbal\">Cetak Perbal</button>";
	             }
	             else
	             {
	             	$nestedData[] = "<button type='button' class='btn btn-info btn-xs' onclick='lihatStatus(".$row->ID_TRX_HDR.",&#39;".$row->NO_SURAT_PERMOHONAN."&#39;)'>Alur Proses</button>&nbsp;<a id='detail_list_prm' onClick='detail_list_prm(&#39; $row->ID_TRX_HDR &#39;)'>Pegawai</a>";
	             }
	             
	             //$nestedData[]="-";
	             $nestedData[] = "<button type='button' class='btn btn-primary btn-xs' onclick='NoDisposisi(".$row->ID_TRX_HDR.")'>Kirim</button>";

	             /*$nestedData[] = '<button type="button" class="btn btn-primary btn-xs" onclick="setT2('.$row->ID_TRX_HDR.',&#39;'.$row->NO_SURAT_PERMOHONAN.'&#39;)">Lihat</button>';*/
	            
	             $dataaa[]=$nestedData;
	             $no++;
	         }
	         $json_data = array(
	            	/*"draw"            => intval( $requestData['draw'] ),*/
	           	"recordsTotal"    => intval( $totalData ),
	            "recordsFiltered" => intval( $totalFiltered ),
	             "data"            => $dataaa
	         );

			 return json_encode($json_data);
				//return $result;
		}

		public function get_all_permohonan2($param){
			 $requestData = $this->input->post();

			$q="SELECT COUNT (A.ID_TRX_HDR) JML 
				FROM PERS_TRACKING A
				WHERE A.URUTAN = $param AND A.STATUS = 2";

			$rs = $this->db->query($q)->result();
			// var_dump($rs);exit;
        	$totalData = $rs[0]->JML;

			// $sql = "SELECT ROWNUM,X.* FROM
			// 		(
			// 			SELECT ROWNUM AS RN, ID_TRACKING,ID_TRX_HDR, ID_TRX, ID AS URUTAN,NO_SURAT_PERMOHONAN,TGL_SURAT_PERMOHONAN,NO_SURAT_BH,TGL_SURAT_BH,ID_SOP,KET_PERMOHONAN,KET_JENIS_PERMOHONAN,
			// 					NO_PERBAL,
			// 					DIKERJAKAN,
			// 					DIPERIKSA,
			// 					DIEDARKAN,
			// 					DISETUJUI,
			// 					DIMAJUKAN,
			// 					HAL,
			// 					SIFAT,
			// 					LAMPIRAN,
			// 					PEMARAF,
			// 					TEMBUSAN,
			// 					DITETAPKAN,
			// 					DISERAHKAN
			// 			FROM
			// 			(
			// 				SELECT DISTINCT
			// 					A.ID_TRACKING,
			// 					A.ID_TRX_HDR,
			// 					B.NO_SURAT_PERMOHONAN,
			// 					TO_CHAR (
			// 						B.TGL_SURAT_PERMOHONAN,
			// 						'DD-MM-YYYY'
			// 					) TGL_SURAT_PERMOHONAN,
			// 					(
			// 						SELECT
			// 							NO_SURAT AS NO_SURAT_BH
			// 						FROM
			// 							PERS_TRACKING
			// 						WHERE
			// 							ID_TRX_HDR = A .ID_TRX_HDR
			// 						AND URUTAN = 5
			// 					) NO_SURAT_BH,
			// 					(
			// 						SELECT
			// 							TO_CHAR (TGL_SURAT, 'DD-MM-YYYY') AS TGL_SURAT_BH
			// 						FROM
			// 							PERS_TRACKING
			// 						WHERE
			// 							ID_TRX_HDR = A .ID_TRX_HDR
			// 						AND URUTAN = 5
			// 					) TGL_SURAT_BH,
			// 					B.ID_SOP,
			// 					D. ID,
			// 					D. ID_TRX,
			// 					D .ID_PERMOHONAN,
			// 					D .ID_JENIS_PERMOHONAN,
			// 					E .KET_PERMOHONAN,
			// 					F.KET_JENIS_PERMOHONAN,
			// 					TP.NO_PERBAL,
			// 					DIKERJAKAN,
			// 					DIPERIKSA,
			// 					DIEDARKAN,
			// 					DISETUJUI,
			// 					TO_CHAR (
			// 						TP.DIMAJUKAN,
			// 						'DD-MM-YYYY'
			// 					) DIMAJUKAN,
			// 					HAL,
			// 					SIFAT,
			// 					LAMPIRAN,
			// 					PEMARAF,
			// 					TEMBUSAN,
			// 					DITETAPKAN,
			// 					DISERAHKAN
			// 				FROM
			// 					PERS_TRACKING A
			// 				LEFT JOIN PERS_TRX_HDR B ON A .ID_TRX_HDR = B.ID_TRX_HDR
			// 				LEFT JOIN PERS_TRX_DTL C ON A .ID_TRX_HDR = C.ID_TRX_HDR
			// 				LEFT JOIN PERS_TRX_AJU D ON C.ID_TRX = D .ID_TRX
			// 				LEFT JOIN PERS_REF_PERMOHONAN E ON E .ID_PERMOHONAN = D .ID_PERMOHONAN
			// 				LEFT JOIN PERS_JENIS_PERMOHONAN F ON D .ID_JENIS_PERMOHONAN = F.ID_JENIS_PERMOHONAN
			// 				LEFT JOIN PERS_MASTER_KOJABF KF ON KF.KOJAB = D.ID_KOJABF
			// 		LEFT JOIN PERS_TRACKING_PERBAL TP ON A.ID_TRX_HDR = TP.ID_TRX_HDR
			// 				WHERE
			// 					A .URUTAN = $param
			// 				AND A .STATUS = 2
			// 				AND B .ID_SOP = {$_SESSION['logged_in']['id_sop']}
			// 			) PRM 
			// 		)X ";
			// $sql.="WHERE 1=1";

			$sql = "SELECT
				ROWNUM,
				X.*
			FROM
				(
					SELECT
						ROWNUM AS RN,
						BBS_SMNTR,
						ID_TRACKING,
						ID_TRX_HDR,
						ID AS URUTAN,
						NO_SURAT_PERMOHONAN,
						TGL_SURAT_PERMOHONAN,
						NO_SURAT_BH,
						TGL_SURAT_BH,
						ID_SOP,
						KET_PERMOHONAN,
						KET_JENIS_PERMOHONAN,
						NO_PERBAL,
						DIKERJAKAN,
						DIPERIKSA,
						DIEDARKAN,
						DISETUJUI,
						DIMAJUKAN,
						HAL,
						SIFAT,
						LAMPIRAN,
						PEMARAF,
						TEMBUSAN,
						DITETAPKAN,
						DISERAHKAN
					FROM
						(
							SELECT DISTINCT
								A .ID_TRACKING,
								A .ID_TRX_HDR,
								B.NO_SURAT_PERMOHONAN,
								TO_CHAR (
									B.TGL_SURAT_PERMOHONAN,
									'DD-MM-YYYY'
								) TGL_SURAT_PERMOHONAN,
								NO_SURAT AS NO_SURAT_BH,
								TGL_SURAT AS TGL_SURAT_BH,
								/*(
									SELECT
										NO_SURAT AS NO_SURAT_BH
									FROM
										PERS_TRACKING
									WHERE
										ID_TRX_HDR = A .ID_TRX_HDR
									AND URUTAN = 5
								) NO_SURAT_BH,
								(
									SELECT
										TO_CHAR (TGL_SURAT, 'DD-MM-YYYY') AS TGL_SURAT_BH
									FROM
										PERS_TRACKING
									WHERE
										ID_TRX_HDR = A .ID_TRX_HDR
									AND URUTAN = 5
								) TGL_SURAT_BH,*/
								B.ID_SOP,
								D . ID,
								D.BBS_SMNTR,
								D .ID_PERMOHONAN,
								D .ID_JENIS_PERMOHONAN,
								E .KET_PERMOHONAN,
								F.KET_JENIS_PERMOHONAN,
								TP.NO_PERBAL,
								DIKERJAKAN,
								DIPERIKSA,
								DIEDARKAN,
								DISETUJUI,
								TO_CHAR (TP.DIMAJUKAN, 'DD-MM-YYYY') DIMAJUKAN,
								HAL,
								SIFAT,
								LAMPIRAN,
								PEMARAF,
								TEMBUSAN,
								DITETAPKAN,
								DISERAHKAN
							FROM
								PERS_TRACKING A
							LEFT JOIN PERS_TRX_HDR B ON A .ID_TRX_HDR = B.ID_TRX_HDR
							LEFT JOIN PERS_TRX_DTL C ON A .ID_TRX_HDR = C.ID_TRX_HDR
							LEFT JOIN PERS_TRX_AJU D ON C.ID_TRX = D .ID_TRX
							LEFT JOIN PERS_REF_PERMOHONAN E ON E .ID_PERMOHONAN = D .ID_PERMOHONAN
							LEFT JOIN PERS_JENIS_PERMOHONAN F ON D .ID_JENIS_PERMOHONAN = F.ID_JENIS_PERMOHONAN
							LEFT JOIN PERS_MASTER_KOJABF KF ON KF.KOJAB = D .ID_KOJABF
							LEFT JOIN PERS_TRACKING_PERBAL TP ON A .ID_TRX_HDR = TP.ID_TRX_HDR
							WHERE
								A .URUTAN = $param
							AND A .STATUS = 2
							AND B.ID_SOP = {$_SESSION['logged_in']['id_sop']}
						) PRM
				) X
			WHERE
				1 = 1";
			// var_dump($sql);exit;
			// echo $sql;

			if( !empty($requestData['search']['value']) ) {   // if there is a search parameter, $requestData['search']['value'] contains search parameter
            $sql.=" AND ( X.ID_TRX_HDR LIKE ('%".$requestData['search']['value']."%') ";    
            $sql.=" OR X.NO_SURAT_PERMOHONAN LIKE UPPER ('%".$requestData['search']['value']."%') ";
            $sql.=" OR X.KET_JENIS_PERMOHONAN LIKE UPPER ('%".$requestData['search']['value']."%') ";
            $sql.=" OR X.KET_PERMOHONAN LIKE UPPER ('%".$requestData['search']['value']."%') ";
            $sql.=" OR X.ID_SOP LIKE UPPER('%".$requestData['search']['value']."%') )";
			}

			$sql.=" AND RN > ".$requestData['start']."  AND ROWNUM <= ".$requestData['length'];
			// var_dump($sql);exit;
			$result = $this->db->query($sql);
			$totalFiltered = $result->num_rows();

            $dataaa=array();
			$no=$requestData['start']+1;
			foreach ($result->result() as $row)
	         {            
	             $nestedData = array();
	             $nestedData[] = $no;
                 /*<td><a id="detail_list_prm" onClick="detail_list_prm(<?php echo $row->ID_TRX_HDR ?>)">Detail</a></td>*/
	             $nestedData[] = $row->NO_SURAT_PERMOHONAN;
	             $nestedData[] = $row->TGL_SURAT_PERMOHONAN;
	             // $nestedData[] = $row->NO_SURAT_BH;
	             // $nestedData[] = $row->TGL_SURAT_BH;
	             $nestedData[] = $row->KET_PERMOHONAN;
	             $nestedData[] = $row->KET_JENIS_PERMOHONAN;
	             
	             if($param == 4)
	             {
					 $nestedData[] = "<button type='button' class='btn btn-info btn-xs' onclick='cetakPerbal(".$row->ID_TRX_HDR.")'>Cetak</button>";

					 $nestedData[] = "<button type='button' class='btn btn-info btn-xs' id='alur_proses' onclick='lihatStatus(".$row->ID_TRX_HDR.",&#39;".$row->NO_SURAT_PERMOHONAN."&#39;)'>Alur Proses</button>&nbsp;
	             	<button type='button' class='btn btn-primary btn-xs' onClick='detail_list_prm(&#39; $row->ID_TRX_HDR &#39;)'>Pegawai</button>";
	             }
	             else if($param == 8)
				 {
					 $nestedData[] = "<button type='button' class='btn-block btn btn-warning btn-xs' onclick='editPerbal(".$row->ID_TRX_HDR.",&#39;".$row->TGL_SURAT_BH."&#39;,&#39;".$row->NO_PERBAL."&#39;,&#39;".$row->DIKERJAKAN."&#39;,&#39;".$row->DIPERIKSA."&#39;,&#39;".$row->DIEDARKAN."&#39;,&#39;".$row->DISETUJUI."&#39;,&#39;".$row->DIMAJUKAN."&#39;,&#39;".$row->HAL."&#39;,&#39;".$row->SIFAT."&#39;,&#39;".$row->LAMPIRAN."&#39;,&#39;".implode('|',json_decode($row->PEMARAF))."&#39;,&#39;".$row->TEMBUSAN."&#39;,&#39;".$row->DITETAPKAN."&#39;,&#39;".$row->DISERAHKAN."&#39;)'>Edit</button> <button type=\"button\" class=\"btn btn-block btn-info btn-xs\" onclick=\"cetakPerbal(".$row->ID_TRX_HDR.",".$row->BBS_SMNTR.")\">Cetak</button>";
					  //<a href='http://simpegdev.jakarta.go.id/subbid/cetakPerbal/cover/".$row->ID_TRX_HDR."' target='_blank' class='btn btn-block btn-danger btn-xs'>Cover Perbal</a> <a href='http://simpegdev.jakarta.go.id/subbid/cetakPerbal/isi/".$row->ID_TRX_HDR."/".((($row->KET_JENIS_PERMOHONAN == 'PENGANGKATAN KEMBALI') || ($row->KET_JENIS_PERMOHONAN == 'PEMBERHENTIAN') || ($row->KET_JENIS_PERMOHONAN == 'PEMBEBASAN SEMENTARA')) ? 1 : null)."3' target='_blank' class='btn btn-block btn-success btn-xs'>Isi Perbal</a>";

					 $nestedData[] = "<button type='button' class='btn btn-info btn-xs btn-block' onclick='lihatStatus(".$row->ID_TRX_HDR.",&#39;".$row->NO_SURAT_PERMOHONAN."&#39;)'>Alur Proses</button>
	             	<button type='button' class='btn btn-primary btn-xs btn-block' onClick='detail_list_prm(&#39; $row->ID_TRX_HDR &#39;)'>Pegawai</button>";
				 } else {
					 $nestedData[] = "";
					 $nestedData[] = "<button type='button' class='btn btn-block btn-info btn-xs' onclick='lihatStatus(".$row->ID_TRX_HDR.",&#39;".$row->NO_SURAT_PERMOHONAN."&#39;)'>Alur Proses</button>
	             	<button type='button' class='btn btn-block btn-primary btn-xs' onClick='detail_list_prm(&#39; $row->ID_TRX_HDR &#39;)'>Pegawai</button>";
	             }
	             
	             //$nestedData[]="-";
	             // $nestedData[] = "<button type='button' class='btn btn-primary btn-xs' onclick='NoDisposisi(".$row->ID_TRX_HDR.",".$row->ID_TRX.")'>Kirim</button>
	             // 				  <button type='button' class='btn btn-warning btn-xs' onclick='revisi(".$row->ID_TRACKING.",".$row->ID_TRX.",".$row->URUTAN.",".$row->ID_TRX_HDR.")' style='display:none'>Revisi</button>";
	             $nestedData[] = "<button type='button' class='btn btn-primary btn-xs' onclick='NoDisposisi(".$row->ID_TRX_HDR.",0)'>Kirim</button>
	             				  <button type='button' class='btn btn-warning btn-xs' onclick='revisi(".$row->ID_TRACKING.",".$row->URUTAN.",".$row->ID_TRX_HDR.")' style='display:none'>Revisi</button>";
	             /*$nestedData[] = '<button type="button" class="btn btn-primary btn-xs" onclick="setT2('.$row->ID_TRX_HDR.',&#39;'.$row->NO_SURAT_PERMOHONAN.'&#39;)">Lihat</button>';*/
	            
	             $dataaa[]=$nestedData;
	             $no++;
	         }
	         $json_data = array(
	            	/*"draw"            => intval( $requestData['draw'] ),*/
	           	"recordsTotal"    => intval( $totalData ),
	            "recordsFiltered" => intval( $totalFiltered ),
	             "data"            => $dataaa
	         );

			 return json_encode($json_data);
				//return $result;
		}
		
		//CEK FILE TERIMA 
		public function dataTrxDtl(){
			$requestData = $this->input->post();
			$id_trx_hdr = ($requestData['id_trx_hdr']>0)?$requestData['id_trx_hdr']:0;
			//var_dump($id_trx_hdr);exit;
			$q="SELECT COUNT (ID_TRX) JML 
				FROM PERS_TRX_DTL 
				WHERE ID_TRX_HDR = ".$id_trx_hdr."";

			$rs = $this->db->query($q)->result();
        	$totalData = $rs[0]->JML;


			$sql = "SELECT ROWNUM, X.* FROM
					(
						SELECT ROWNUM AS RN, ID_TRX_HDR, ID_TRX_DETAIL, ID_TRX, NO_SURAT_PERMOHONAN,NRK,NAMA
						FROM
						(
							SELECT DISTINCT
								A .ID_TRX_HDR,
								A .ID_TRX_DETAIL,
								A .ID_TRX,
								B.NO_SURAT_PERMOHONAN,
								C.NRK,
								D .NAMA
							FROM
								PERS_TRX_DTL A
							LEFT JOIN PERS_TRX_HDR B ON B.ID_TRX_HDR = A .ID_TRX_HDR
							LEFT JOIN PERS_TRX_AJU C ON A .ID_TRX = C.ID_TRX
							LEFT JOIN PERS_PEGAWAI1 D ON D .NRK = C.NRK
							WHERE 
							C.STATUS_APPROVAL=1
							AND	C.STATUS_BERJALAN=2
							AND 
							A .ID_TRX_HDR = ".$id_trx_hdr."
						)PRM
					)X ";
			//echo $sql;exit;
			$sql.="WHERE 1=1";

			if( !empty($requestData['search']['value']) ) {   // if there is a search parameter, $requestData['search']['value'] contains search parameter
            $sql.=" AND ( X.NRK LIKE ('%".$requestData['search']['value']."%') ";    
            
            $sql.=" OR X.NAMA LIKE UPPER('%".$requestData['search']['value']."%') )";
			}

			$sql.=" AND RN > ".$requestData['start']."  AND ROWNUM <= ".$requestData['length'];

			$query = $this->db->query($sql);
			$totalFiltered = $query->num_rows();
			//$totalFiltered = $totalData;
			//echo $sql;
			$dataaa=array();
			$no=$requestData['start']+1;
			foreach ($query->result() as $row)
			{
				$nestedData= array();
				$nestedData[] = $no;
				$nestedData[] = $row->NRK;
				$nestedData[] = $row->NAMA;
				$nestedData[] = '<a class="btn btn-primary btn-xs" data-toggle="modal" data-target="#myModal" id="test_btn" onclick="cekFile('.$row->ID_TRX_DETAIL.','.$row->NRK.',\''.$row->NAMA.'\','.$row->ID_TRX.');"> Cek file </a>';
				

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

		public function lihat_persyaratan_trx(){
			$where = $this->input->post();
			$id_trx = $where['ID_TRX'];

			$sql = "SELECT
					A.FILE_SYARAT,
					B.NRK,
					B.TGL_PERMOHONAN,
					B. ID_PERMOHONAN,
					B.ID_JENIS_PERMOHONAN,
					C.KET_SYARAT,
					A.ID_SYARAT
					FROM
						PERS_DTL_TRX_AJU A
					LEFT JOIN PERS_TRX_AJU B ON A .ID_TRX = B.ID_TRX
					LEFT JOIN PERS_SYARAT_DTL C ON C.ID_SYARAT_DTL = A.ID_SYARAT
					WHERE
						B.ID_TRX = '".$id_trx."'
						AND B.STATUS_APPROVAL = 1
					ORDER BY
						A.ID_SYARAT";

			$query = $this->db->query($sql);
			$no = 1;
			$table = "";

			foreach ($query->result() as $row)
			{
				$table .= "<tr>";
				$table .= "<td>".$no++."</td>";
				$table .= "<td>".$row->KET_SYARAT."</td>";
				if(!empty($row->FILE_SYARAT)){
					$table .= "<td id='ket_syarat'>Ada</td>";
					$table .= "<td class='text-center'><a href='".site_url('assets/file_permohonan/'.$row->NRK.'/'.$row->FILE_SYARAT)."' target='external'><i class='fa fa-external-link' aria-hidden='true'></i></a></td>";
				}else{
					$table .= "<td id='ket_syarat'>Tidak Ada</td>";
					$table .= "&nbsp;";
				}
				// $table .= "<td class='text-center'><a><i class='fa fa-files-o' aria-hidden='true'></i></a></td>";
				$table .= "</tr>";
				//$no++;
			}



			$json_data = array(

				"dataTable" => $table
			);

			$result = json_encode($json_data);

			return $result;
		}

		public function lihat_persyaratan_trx_k(){
			$where = $this->input->post();
			$id_trx = $where['ID_TRX'];
		
			$sql = "SELECT
					A.FILE_SYARAT,
					B.NRK,
					B.TGL_PERMOHONAN,
					B. ID_PERMOHONAN,
					B.ID_JENIS_PERMOHONAN,
					C.KET_SYARAT,
					C.ID_SYARAT
					FROM
						PERS_DTL_TRX_AJU A
					LEFT JOIN PERS_TRX_AJU B ON A .ID_TRX = B.ID_TRX
					LEFT JOIN PERS_SYARAT_PERMOHONAN C ON B.ID_PERMOHONAN = C.ID_PERMOHONAN AND B.ID_JENIS_PERMOHONAN = C.ID_JENIS_PERMOHONAN AND A .ID_SYARAT = C.ID_SYARAT
					WHERE
						B.ID_TRX = '".$id_trx."'
						AND B.STATUS_APPROVAL = 1
					ORDER BY
						C.ID_SYARAT";
			
			$query = $this->db->query($sql);
			$no = 1;
			$table = "";
			
			foreach ($query->result() as $row)
	        {            
	            $table .= "<tr>";
	            $table .= "<td>".$no++."</td>";
	            $table .= "<td>".$row->KET_SYARAT."</td>";
	            if(!empty($row->FILE_SYARAT)){
		            $table .= "<td id='ket_syarat'>Ada</td>";
		            $table .= "<td class='text-center'><a href='".site_url('assets/file_permohonan/'.$row->NRK.'/'.$row->FILE_SYARAT)."' target='external'><i class='fa fa-external-link' aria-hidden='true'></i></a></td>";
	        	}else{
	        		$table .= "<td id='ket_syarat'>Tidak Ada</td>";
		            $table .= "&nbsp;";
	        	}
	            // $table .= "<td class='text-center'><a><i class='fa fa-files-o' aria-hidden='true'></i></a></td>";
	            $table .= "</tr>";	            
	            //$no++;	            
	        }
	        


	        $json_data = array(
	        	
	            "dataTable" => $table
	        );

	        $result = json_encode($json_data);
	        
	        return $result;
		}


		public function get_all_data_dashboard($prm){
			if($prm = 'terima'){
				//query untuk terima
				$query = "SELECT * FROM ";
			}else{
				$query = "SELECT
							A .ID_TRX_TOLAK,
							A .TGL_TOLAK,
							A .KETERANGAN,
							B.ID_TRX,
							C.NRK,
							TO_CHAR(C.TGL_PERMOHONAN,'DD-MM-YYYY')TGL_PERMOHONAN,
							C.ID_PERMOHONAN,
							C.ID_JENIS_PERMOHONAN,
							D.NAMA,
							E.KET_JENIS_PERMOHONAN,
							F.KET_PERMOHONAN,
							I.GOL
							FROM
								PERS_TRX_TOLAK A
							LEFT JOIN PERS_TRX_DTL B ON A .ID_TRX = B.ID_TRX
							LEFT JOIN PERS_TRX_AJU C ON B.ID_TRX = C.ID_TRX
							LEFT JOIN PERS_PEGAWAI1 D ON C.NRK = D.NRK
							LEFT JOIN PERS_JENIS_PERMOHONAN E ON C.ID_PERMOHONAN = E.ID_PERMOHONAN AND C.ID_JENIS_PERMOHONAN = E.ID_JENIS_PERMOHONAN
							LEFT JOIN PERS_REF_PERMOHONAN F ON C.ID_PERMOHONAN = F.ID_PERMOHONAN
							LEFT JOIN PERS_RB_GAPOK_HIST H ON C.NRK = H.NRK
							LEFT JOIN PERS_PANGKAT_TBL I ON H.KOPANG=I.KOPANG
							WHERE H.TMT = (SELECT MAX(TMT) FROM PERS_RB_GAPOK_HIST WHERE NRK = C.NRK)
							AND C.STATUS_APPROVAL = 3
							AND C.ID = 3";
				$this->db->query($query);
				//$result = $this->db->query($sql);
				$dataaa=array();
				$no=1;
				foreach ($result->result() as $row)
		        {            
		            $nestedData = array();
		            $nestedData[] = $no;
		            $nestedData[] = $row->NRK;
		            $nestedData[] = $row->NAMA;
		            $nestedData[] = $row->TGL_TOLAK;
		            $nestedData[] = $row->KET_PERMOHONAN;
		            $nestedData[] = $row->KET_JENIS_PERMOHONAN;
		            $nestedData[] = $row->GOL;
		            $nestedData[] = "<a id='verifikasi' onClick='verifikasi_click(&#39;".$row->ID_TRX_TOLAK."&#39;);' data-toggle='modal' data-target='#myModal'>Cek Keterangan</a>";
		            //$nestedData['DT_RowId'] = "nomor_".$no;
		            
		            $dataaa[]=$nestedData;
		            $no++;
		        }
		        $json_data = array(
		           	/*"draw"            => intval( $requestData['draw'] ),*/
		            "data"            => $dataaa
		        );
			}
			return json_encode($json_data);
		}
		
		public function get_keterangan_tolak($id_trx_tolak){
			$query = "SELECT
							A .KETERANGAN
							FROM
								PERS_TRX_TOLAK A
							WHERE A .ID_TRX_DTL = $id_trx_tolak";
				//$this->db->query($query);
				$result = $this->db->query($sql);
		        return json_encode($result);
		}

		public function get_all_data_skpd(){
			$aoColumns = array(
	            0 => 'NRK',
	            1 => 'NAMA',
	            2 => 'TGL_PERMOHONAN',
	            3 => 'KET_PERMOHONAN',
	            4 => 'KET_JENIS_PERMOHONAN',
	            5 => 'GOLONGAN'
            );
			$requestData = $this->input->post();
			// var_dump($requestData);exit;
			/*$sql = "SELECT
						A .NRK,
						TO_CHAR(A.TGL_PERMOHONAN,'DD-MM-YYYY')TGL_PERMOHONAN,
						A .ID_JENIS_PERMOHONAN,
						A .ID_TRX,
						B.NAMA,
						C.KET_JENIS_PERMOHONAN,
						D .KET_PERMOHONAN,
						F.GOL
					FROM
						PERS_TRX_AJU A
					LEFT JOIN PERS_PEGAWAI1 B ON A .NRK = B.NRK
					LEFT JOIN PERS_JENIS_PERMOHONAN C ON A .ID_PERMOHONAN = C.ID_PERMOHONAN
					AND A .ID_JENIS_PERMOHONAN = C.ID_JENIS_PERMOHONAN
					LEFT JOIN PERS_REF_PERMOHONAN D ON A .ID_PERMOHONAN = D .ID_PERMOHONAN
					LEFT JOIN PERS_RB_GAPOK_HIST E ON A.NRK = E.NRK
					LEFT JOIN PERS_PANGKAT_TBL F ON E.KOPANG = F.KOPANG
					WHERE
						A .STATUS_APPROVAL = 2
						AND E.TMT = (SELECT MAX(TMT) FROM PERS_RB_GAPOK_HIST WHERE NRK = A.NRK)";*/

				$sql="SELECT
						A .ID_TRX_HDR,
						A .NO_SURAT_PERMOHONAN,
						A .TGL_SURAT_PERMOHONAN,
						A .ID_SOP,
						B.ID_TRX,
						C.NRK,
						TO_CHAR(C.TGL_PERMOHONAN,'DD-MM-YYYY')TGL_PERMOHONAN,
						C.ID_PERMOHONAN,
						C.ID_JENIS_PERMOHONAN,
						D.NAMA,
						E.KET_JENIS_PERMOHONAN,
						F.KET_PERMOHONAN,
						I.GOL
					FROM
						PERS_TRX_HDR A
					LEFT JOIN PERS_TRX_DTL B ON A .ID_TRX_HDR = B.ID_TRX_HDR
					LEFT JOIN PERS_TRX_AJU C ON B.ID_TRX = C.ID_TRX
					LEFT JOIN PERS_PEGAWAI1 D ON C.NRK = D.NRK
					LEFT JOIN PERS_JENIS_PERMOHONAN E ON C.ID_PERMOHONAN = E.ID_PERMOHONAN AND C.ID_JENIS_PERMOHONAN = E.ID_JENIS_PERMOHONAN
					LEFT JOIN PERS_REF_PERMOHONAN F ON C.ID_PERMOHONAN = F.ID_PERMOHONAN
					LEFT JOIN PERS_RB_GAPOK_HIST H ON C.NRK = H.NRK
					LEFT JOIN PERS_PANGKAT_TBL I ON H.KOPANG=I.KOPANG
					WHERE H.TMT = (SELECT MAX(TMT) FROM PERS_RB_GAPOK_HIST WHERE NRK = C.NRK)
					AND A.ID_TRX_HDR = ".$requestData['id_trx_hdr']."
					AND C.STATUS_APPROVAL = 1
					AND C.ID = 2";
			// var_dump($sql);exit;
			$result = $this->db->query($sql);
			$dataaa=array();
			$no=1;
			foreach ($result->result() as $row)
	        {            
	            $nestedData = array();
	            $nestedData[] = $no;
	            $nestedData[] = "<span id='id_trx_tbl' style='display:none'>".$row->ID_TRX."</span> &nbsp;".$row->NRK;
	            $nestedData[] = $row->NAMA;
	            $nestedData[] = $row->TGL_PERMOHONAN;
	            $nestedData[] = $row->KET_PERMOHONAN;
	            $nestedData[] = $row->KET_JENIS_PERMOHONAN;
	            $nestedData[] = $row->GOL;
	            $nestedData[] = "<a id='verifikasi' onClick='verifikasi_click(&#39;".$row->NRK."&#39;,".$row->ID_JENIS_PERMOHONAN.",".$no.");'>Cek File</a>";
	            $nestedData['DT_RowId'] = "nomor_".$no;
	            
	            $dataaa[]=$nestedData;
	            $no++;
	        }
	        $json_data = array(
	           	/*"draw"            => intval( $requestData['draw'] ),*/
	            "data"            => $dataaa
	        );

			return json_encode($json_data);
		}

		public function count_data($prm, $id_sop = null){
			//YG DI TERIMA DARI SKPD
			if($prm == 1)
			{
				//YG DI TERIMA DARI SKPD
				$sql = "SELECT COUNT (A.ID_TRX_HDR) TRX_TERIMA FROM PERS_TRACKING A LEFT JOIN PERS_TRX_HDR B ON A.ID_TRX_HDR = B.ID_TRX_HDR 
						WHERE URUTAN = 2 AND STATUS = 1 AND ID_SOP = {$id_sop}";
				// var_dump($sql);exit;
				/*$sql = "SELECT COUNT (A .ID_TRX_HDR) TRX_TERIMA
						FROM PERS_TRACKING A
						WHERE URUTAN = 2 AND STATUS = 1";*/
				$res = $this->db->query($sql);
				$result = $res->row();
			}
			//SEDANG PROSES DI TUBKD
			else if($prm == 2  ){
				$sql = "SELECT COUNT (A.ID_TRX_HDR) TRX_HDR FROM PERS_TRACKING A LEFT JOIN PERS_TRX_HDR B ON A.ID_TRX_HDR = B.ID_TRX_HDR 
						WHERE URUTAN = 2 AND STATUS = 2 AND ID_SOP = {$id_sop}";
				$res = $this->db->query($sql);
				$result = $res->row();
			}
			//YG DI TERIMA DARI BID PENGEMBANGAN
			else if($prm == 3  )
			{
				$sql = "SELECT COUNT (A.ID_TRX_HDR) TRX_TERIMA FROM PERS_TRACKING A LEFT JOIN PERS_TRX_HDR B ON A.ID_TRX_HDR = B.ID_TRX_HDR 
						WHERE URUTAN = 4 AND STATUS = 1 AND ID_SOP = {$id_sop}";
				/*$sql = "SELECT COUNT (A .ID_TRX_HDR) TRX_TERIMA
						FROM PERS_TRACKING A
						WHERE URUTAN = 4 AND STATUS = 1";*/
				$res = $this->db->query($sql);
				$result = $res->row();
			}
			//SEDANG DI PROSES DI TUBKD II
			else if($prm == 4  ){
				$sql = "SELECT COUNT (A.ID_TRX_HDR) TRX_HDR FROM PERS_TRACKING A LEFT JOIN PERS_TRX_HDR B ON A.ID_TRX_HDR = B.ID_TRX_HDR 
						WHERE URUTAN = 4 AND STATUS = 2 AND ID_SOP = {$id_sop}";
				//$sql = "SELECT COUNT (ID_TRX_HDR) TRX_HDR FROM PERS_TRACKING WHERE URUTAN = 4 AND STATUS = 2";
				$res = $this->db->query($sql);
				$result = $res->row();
			}
			//
			else if($prm == 5  )
			{
				$sql = "SELECT COUNT (A.ID_TRX_HDR) TRX_TERIMA FROM PERS_TRACKING A LEFT JOIN PERS_TRX_HDR B ON A.ID_TRX_HDR = B.ID_TRX_HDR 
						WHERE URUTAN = 6 AND STATUS = 1 AND ID_SOP = {$id_sop}";
				/*$sql = "SELECT COUNT (A .ID_TRX_HDR) TRX_TERIMA
						FROM PERS_TRACKING A
						WHERE URUTAN = 6 AND STATUS = 1";*/
				$res = $this->db->query($sql);
				$result = $res->row();
			}
			else if($prm == 6  ){
				$sql = "SELECT COUNT (A.ID_TRX_HDR) TRX_HDR FROM PERS_TRACKING A LEFT JOIN PERS_TRX_HDR B ON A.ID_TRX_HDR = B.ID_TRX_HDR 
						WHERE URUTAN = 6 AND STATUS = 2 AND ID_SOP = {$id_sop}";
				/*$sql = "SELECT COUNT (ID_TRX_HDR) TRX_HDR FROM PERS_TRACKING WHERE URUTAN = 6 AND STATUS = 2";*/
				$res = $this->db->query($sql);
				$result = $res->row();
			}
			else if($prm == 7  )
			{
				$sql = "SELECT COUNT (A.ID_TRX_HDR) TRX_TERIMA FROM PERS_TRACKING A LEFT JOIN PERS_TRX_HDR B ON A.ID_TRX_HDR = B.ID_TRX_HDR 
						WHERE URUTAN = 8 AND STATUS = 1 AND ID_SOP = {$id_sop}";
				/*$sql = "SELECT COUNT (A .ID_TRX_HDR) TRX_TERIMA
						FROM PERS_TRACKING A
						WHERE URUTAN = 8 AND STATUS = 1";*/
				$res = $this->db->query($sql);
				$result = $res->row();
			}
			else if($prm == 8  ){
				$sql = "SELECT COUNT (A.ID_TRX_HDR) TRX_HDR FROM PERS_TRACKING A LEFT JOIN PERS_TRX_HDR B ON A.ID_TRX_HDR = B.ID_TRX_HDR 
						WHERE URUTAN = 8 AND STATUS = 2 AND ID_SOP = {$id_sop}";
				/*$sql = "SELECT COUNT (ID_TRX_HDR) TRX_HDR FROM PERS_TRACKING WHERE URUTAN = 8 AND STATUS = 2";*/
				$res = $this->db->query($sql);
				$result = $res->row();
			}else if($prm == 9  ){
				$sql = "SELECT COUNT (A.ID_TRX_HDR) TRX_TERIMA FROM PERS_TRACKING A LEFT JOIN PERS_TRX_HDR B ON A.ID_TRX_HDR = B.ID_TRX_HDR 
						WHERE URUTAN = 9 AND STATUS = 1 AND ID_SOP = {$id_sop}";
				/*$sql = "SELECT COUNT (A .ID_TRX_HDR) TRX_TERIMA
						FROM PERS_TRACKING A
						WHERE URUTAN = 11 AND STATUS = 1";*/
				$res = $this->db->query($sql);
				$result = $res->row();
			}else if($prm == 10  ){
				$sql = "SELECT COUNT (A.ID_TRX_HDR) TRX_HDR FROM PERS_TRACKING A LEFT JOIN PERS_TRX_HDR B ON A.ID_TRX_HDR = B.ID_TRX_HDR 
						WHERE URUTAN = 9 AND STATUS = 2 AND ID_SOP = {$id_sop}";
				/*$sql = "SELECT COUNT (ID_TRX_HDR) TRX_HDR FROM PERS_TRACKING WHERE URUTAN = 11 AND STATUS = 2";*/
				$res = $this->db->query($sql);
				$result = $res->row();
			}else if($prm == 11  ){
				$sql = "SELECT COUNT (A.ID_TRX_HDR) TRX_TERIMA FROM PERS_TRACKING A LEFT JOIN PERS_TRX_HDR B ON A.ID_TRX_HDR = B.ID_TRX_HDR 
						WHERE URUTAN = 10 AND STATUS = 1 AND ID_SOP = {$id_sop}";
				/*$sql = "SELECT COUNT (A .ID_TRX_HDR) TRX_TERIMA
						FROM PERS_TRACKING A
						WHERE URUTAN = 13 AND STATUS = 1";*/
				$res = $this->db->query($sql);
				$result = $res->row();
			}else if($prm == 12  ){
				$sql = "SELECT COUNT (A.ID_TRX_HDR) TRX_HDR FROM PERS_TRACKING A LEFT JOIN PERS_TRX_HDR B ON A.ID_TRX_HDR = B.ID_TRX_HDR 
						WHERE URUTAN = 10 AND STATUS = 2 AND ID_SOP = {$id_sop}";
				/*$sql = "SELECT COUNT (ID_TRX_HDR) TRX_HDR FROM PERS_TRACKING WHERE URUTAN = 13 AND STATUS = 2";*/
				$res = $this->db->query($sql);
				$result = $res->row();
			}
			
			return $result;
		}

		public function count_data_p_bid_pengembangan(){
			$sql = "SELECT
						COUNT (ID_TRX_HDR) AS JML
					FROM PERS_TRACKING
					WHERE URUTAN = 2
					AND STATUS = 2";
			$res = $this->db->query($sql);
			$result = $res->row();

			return $result->JML;
		}

		/*public function count_data($prm){
			if($prm == 2){
				$sql = "SELECT COUNT(*) TRX_HDR FROM PERS_TRX_AJU WHERE STATUS_APPROVAL = 2";
				$res = $this->db->query($sql);
				$result = $res->row();
			}elseif($prm == 3){
				$sql = "SELECT COUNT(*) TRX_TOLAK FROM PERS_TRX_TOLAK";
				$res = $this->db->query($sql);
				$result = $res->row();
			}else{
				$sql = "SELECT COUNT(A.ID_TRX_HDR)TRX_TERIMA FROM PERS_TRX_HDR A
						LEFT JOIN PERS_TRX_DTL B ON A.ID_TRX_HDR = B.ID_TRX_HDR
						LEFT JOIN PERS_TRACKING C ON A.ID_TRX_HDR = C.ID_TRX_HDR 
						WHERE C.URUTAN = 2 AND C.STATUS = 1";
				$res = $this->db->query($sql);
				$result = $res->row();
			}
			return $result;
		}*/

		public function simpan_data(){
			$post = $this->input->post();
			// var_dump($post);exit;
			$no_terima = $post['no_terima'];
			$tgl_terima = $post['tgl_terima'];
			$id_trx_hdr = $post['id_trx_hdrp'];
			list($tgl, $bln, $thn) = explode("-", $post['tgl_terima']);
			$date = date('Y-m-d H:i:s');
			
			$sql = "UPDATE PERS_TRACKING SET STATUS = 1, NO_SURAT = UPPER('$no_terima') , TGL_SURAT = TO_DATE('".$thn."-".$bln."-".$tgl."', 'YYYY-MM-DD HH24:MI:SS'),TGL_UPDATE = SYSDATE WHERE ID_TRX_HDR = ".$id_trx_hdr." AND URUTAN = 2";
			// var_dump($sql);exit;
			$this->db->query($sql);
			$id_trx = "SELECT a.ID_TRX
					  FROM PERS_TRX_DTL A
					  LEFT JOIN PERS_TRX_AJU C ON A .ID_TRX = C.ID_TRX
					  WHERE C.STATUS_APPROVAL=1
						AND	C.STATUS_BERJALAN=2
						AND a.ID_TRX_HDR = $id_trx_hdr";
			$res = $this->db->query($id_trx);
			
			$array = array();
			foreach($res->result() as $row){
				$array[] = $row->ID_TRX;
			}
			
			for ($i=0; $i < count($array); $i++) { 
				$sql2 = "UPDATE PERS_TRX_AJU SET ID = 3, STATUS_BERJALAN = 2,TGL_UPDATE=SYSDATE WHERE ID_TRX = $array[$i]";
				$this->db->query($sql2);
			}
			$sql4 = "INSERT INTO PERS_TRACKING (ID_TRACKING, ID_TRX_HDR, URUTAN, STATUS,TGL_UPDATE) VALUES ((SELECT COUNT (*) + 1 FROM PERS_TRACKING), $id_trx_hdr, 3, 2,SYSDATE)";
			$this->db->query($sql4);
			
			$sql5 = "UPDATE PERS_TRACKING SET STATUS = 1,TGL_UPDATE=SYSDATE WHERE ID_TRX_HDR = ".$id_trx_hdr." AND URUTAN = 2";
			$this->db->query($sql5);

			return $this->db->affected_rows();

		}

		public function simpan_data2(){
			$post = $this->input->post();

			$no_terima = $post['no_terima'];
			list($tgl, $bln, $thn) = explode("-", $post['tgl_terima']);
			$id_trx_hdr = $post['id_trx_hdrp'];
			$date = date('Y-m-d H:i:s');
			
			$sql = "UPDATE PERS_TRACKING SET
					STATUS = 1,
					NO_SURAT = UPPER('$no_terima'),
					TGL_SURAT = TO_DATE('".$thn."-".$bln."-".$tgl."', 'YYYY-MM-DD HH24:MI:SS'),
					TGL_UPDATE = SYSDATE
					WHERE ID_TRX_HDR = ".$id_trx_hdr."
					AND URUTAN = 4";
			
			$this->db->query($sql);
			$id_trx = "SELECT a.ID_TRX
					  FROM PERS_TRX_DTL A
					  LEFT JOIN PERS_TRX_AJU C ON A .ID_TRX = C.ID_TRX
					  WHERE C.STATUS_APPROVAL=1
						AND	C.STATUS_BERJALAN=2
						AND a.ID_TRX_HDR = $id_trx_hdr";
			

			$res = $this->db->query($id_trx);
			
			$array = array();
			foreach($res->result() as $row){
				$array[] = $row->ID_TRX;
			}
			
			for ($i=0; $i < count($array); $i++) { 
				$sql2 = "UPDATE PERS_TRX_AJU SET ID = 5,TGL_UPDATE = SYSDATE  WHERE ID_TRX = $array[$i]";
				
				$this->db->query($sql2);
			}
			

			$sql3 = "INSERT INTO PERS_TRACKING (
					ID_TRACKING, ID_TRX_HDR, URUTAN, STATUS,TGL_UPDATE
					) VALUES (
					(SELECT COUNT (*) + 1 FROM PERS_TRACKING), (SELECT COUNT (*) FROM PERS_TRX_HDR), 5, 2,SYSDATE)";

			$sql3 = "INSERT INTO PERS_TRACKING (
					ID_TRACKING, ID_TRX_HDR, URUTAN, STATUS,TGL_UPDATE
					) VALUES (
					(SELECT COUNT (*) + 1 FROM PERS_TRACKING), ".$id_trx_hdr.", 5, 1, SYSDATE)";
			
			$this->db->query($sql3);

			for ($i=0; $i < count($array); $i++) { 
				$sql4 = "UPDATE PERS_TRX_AJU SET ID = 6,TGL_UPDATE = SYSDATE WHERE ID_TRX = $array[$i]";
				
				$this->db->query($sql4);
			}


			$sql5 = "INSERT INTO PERS_TRACKING (ID_TRACKING, ID_TRX_HDR, URUTAN, STATUS,TGL_UPDATE) VALUES ((SELECT COUNT (*) + 1 FROM PERS_TRACKING), ".$id_trx_hdr.", 6, 2,SYSDATE)";

			$this->db->query($sql5);
			
			$sql6 = "UPDATE PERS_TRACKING SET STATUS = 1,TGL_UPDATE=SYSDATE WHERE ID_TRX_HDR = ".$post['id_trx_hdrp']." AND URUTAN = 4";

			$this->db->query($sql6);

			return $this->db->affected_rows();
			
		}

		public function simpan_data3(){
			$post = $this->input->post();

			$no_terima = $post['no_terima'];
			list($tgl, $bln, $thn) = explode("-", $post['tgl_terima']);
			$no_bh = $post['no_bh'];
			$id_trx_hdr = $post['id_trx_hdrp'];
			$date = date('Y-m-d H:i:s');
			
			$sql = "UPDATE PERS_TRACKING SET STATUS = 1, NO_SURAT = UPPER('$no_terima'), TGL_SURAT = TO_DATE('".$thn."-".$bln."-".$tgl."', 'YYYY-MM-DD HH24:MI:SS'),TGL_UPDATE = SYSDATE WHERE ID_TRX_HDR = ".$id_trx_hdr." AND URUTAN = 6";
			
			
			$this->db->query($sql);
			
			$id_trx = "SELECT a.ID_TRX
					  FROM PERS_TRX_DTL A
					  LEFT JOIN PERS_TRX_AJU C ON A .ID_TRX = C.ID_TRX
					  WHERE C.STATUS_APPROVAL=1
						AND	C.STATUS_BERJALAN=2
						AND a.ID_TRX_HDR = $id_trx_hdr";
			$res = $this->db->query($id_trx);
			
			$array = array();
			foreach($res->result() as $row){
				$array[] = $row->ID_TRX;
			}
			
			for ($i=0; $i < count($array); $i++) { 
				$sql2 = "UPDATE PERS_TRX_AJU SET ID = 7,TGL_UPDATE = SYSDATE  WHERE ID_TRX = $array[$i]";
				
				$this->db->query($sql2);
			}
			

			$sql3 = "INSERT INTO PERS_TRACKING (ID_TRACKING, ID_TRX_HDR, URUTAN, STATUS,TGL_UPDATE) VALUES ((SELECT COUNT (*) + 1 FROM PERS_TRACKING), ".$id_trx_hdr.", 7, 1,SYSDATE)";
			
			$this->db->query($sql3);

			for ($i=0; $i < count($array); $i++) { 
				$sql4 = "UPDATE PERS_TRX_AJU SET ID = 8,TGL_UPDATE = SYSDATE WHERE ID_TRX = $array[$i]";
				
				$this->db->query($sql4);
			}

			$sql5 = "INSERT INTO PERS_TRACKING (ID_TRACKING, ID_TRX_HDR, URUTAN, STATUS,TGL_UPDATE) VALUES ((SELECT COUNT (*) + 1 FROM PERS_TRACKING), ".$id_trx_hdr.", 8, 2,SYSDATE)";
			
			$this->db->query($sql5);
			
		

			$sql6 = "UPDATE PERS_TRACKING SET NO_SURAT = UPPER('".$no_bh."'),TGL_SURAT = SYSDATE,TGL_UPDATE = SYSDATE WHERE ID_TRX_HDR = ".$post['id_trx_hdrp']." AND URUTAN = 5";
		
			$this->db->query($sql6);			

			return $this->db->affected_rows();
			
		}

		// public function get_id_trx_hdr()
		// {
		// 	$id_tracking = $this->input->post('ID_TRACKING');
		// 	$sql1 = "SELECT ID_TRX_HDR 
		// 			FROM PERS_TRACKING WHERE ID_TRACKING = '".$id_tracking."'";	
		// 	return $this->db->query($sql1)->row();
		// }

		public function revisi_tubkd4()
		{
			$id_tracking = $this->input->post('ID_TRACKING');
			$id_trx = $this->input->post('ID_TRX');
			// $id_tr = $id_tracking+1;
			$id_trx_hdr = $this->input->post('ID_TRX_HDR');
			$keterangan = $this->input->post('keterangan');
			$urutan = $this->input->post('URUTAN');
			$update_urutan = $urutan-1;

			$sql5 = "UPDATE PERS_TRX_AJU SET STATUS_APPROVAL = '2',ID = ".$update_urutan.",TGL_UPDATE = SYSDATE WHERE ID_TRX = '".$id_trx."'";
			
			$this->db->query($sql5);

			$sql6 = "UPDATE PERS_TRACKING SET STATUS = '4',TGL_UPDATE = SYSDATE WHERE ID_TRACKING = '".$id_tracking."'";
			
			$this->db->query($sql6);

			$sql = "INSERT INTO PERS_TRACKING (ID_TRACKING, ID_TRX_HDR, URUTAN, STATUS,KETERANGAN,TGL_UPDATE) VALUES ((SELECT MAX(ID_TRACKING) + 1 FROM PERS_TRACKING),".$id_trx_hdr.",".$update_urutan.",2,'".$keterangan."',SYSDATE)";
			
			return $this->db->query($sql);

		}

		public function simpan_data4(){
			$post = $this->input->post();
			// var_dump($post);exit;
			$no_terima = $post['no_terima'];
			// $tgl_terima = $post['tgl_terima'];
			$no_bu = $post['no_bu'];
			$id_trx_hdr = $post['id_trx_hdrp'];
			$notifikasi = $post['notifikasi'];
			// $id_trx = $post['ID_TRX'];
			// var_dump($id_trx);
			list($tgl, $bln, $thn) = explode("-", $post['tgl_terima']);
			$date = date('Y-m-d H:i:s');
			
			$sql = "UPDATE PERS_TRACKING SET STATUS = 1, NO_SURAT = UPPER('$no_terima'), TGL_SURAT = TO_DATE('".$thn."-".$bln."-".$tgl."', 'YYYY-MM-DD HH24:MI:SS'),TGL_UPDATE = SYSDATE WHERE ID_TRX_HDR = ".$id_trx_hdr." AND URUTAN = 8";
			$this->db->query($sql);
			
			// $id_trx = "SELECT a.ID_TRX
			// 		  FROM PERS_TRX_DTL A
			// 		  LEFT JOIN PERS_TRX_AJU C ON A .ID_TRX = C.ID_TRX
			// 		  WHERE C.STATUS_APPROVAL=1
			// 			AND	C.STATUS_BERJALAN=2
			// 			AND a.ID_TRX_HDR = $id_trx_hdr";
			// $res = $this->db->query($id_trx);
			
			// $array = array();
			// foreach($res->result() as $row){
			// 	$array[] = $row->ID_TRX;
			// }
			
			// for ($i=0; $i < count($array); $i++) { 
			// 	$sql2 = "UPDATE PERS_TRX_AJU SET ID = 9,TGL_UPDATE=SYSDATE  WHERE ID_TRX = $array[$i]";
				
			// 	$this->db->query($sql2);
			// }

			$sqlGetTrxHdr = "SELECT A.ID_TRX FROM PERS_TRX_AJU A LEFT JOIN PERS_TRX_DTL B ON A.ID_TRX = B.ID_TRX LEFT JOIN PERS_TRX_HDR C ON B.ID_TRX_HDR = C.ID_TRX_HDR WHERE B.ID_TRX_HDR = '{$id_trx_hdr}'";
			$resTrxHdr = $this->db->query($sqlGetTrxHdr);
			// var_dump($resTrxHdr->result());exit;

			foreach ($resTrxHdr->result() as $value) {
				$sql2 = "UPDATE PERS_TRX_AJU SET ID = 9,TGL_UPDATE=SYSDATE  WHERE ID_TRX = '{$value->ID_TRX}'";	
				$this->db->query($sql2);	
			}

			$sql3 = "INSERT INTO PERS_TRACKING (ID_TRACKING, ID_TRX_HDR, URUTAN, STATUS, KETERANGAN, TGL_UPDATE) VALUES ((SELECT MAX(ID_TRACKING) + 1 FROM PERS_TRACKING), ".$id_trx_hdr.", 9, 2,'".$notifikasi."',SYSDATE)";
			// var_dump($sql3);
			$this->db->query($sql3);

			$sql4 = "UPDATE PERS_TRACKING SET NO_SURAT = UPPER('".$no_bu."'),TGL_SURAT = SYSDATE,TGL_UPDATE = SYSDATE WHERE ID_TRX_HDR = ".$id_trx_hdr." AND URUTAN = 7";
			$this->db->query($sql4);			

			return $this->db->affected_rows();
			
		}

		public function simpan_data5(){
			$post = $this->input->post();
			// var_dump($post);exit;
			$no_terima = $post['no_terima'];
			// $tgl_terima = $post['tgl_terima'];
			// $no_bu = $post['no_bu'];
			$id_trx_hdr = $post['id_trx_hdrp'];
			$notifikasi = $post['notifikasi'];
			$id_trx = $post['ID_TRX'];
			// var_dump($id_trx);
			list($tgl, $bln, $thn) = explode("-", $post['tgl_terima']);
			$date = date('Y-m-d H:i:s');
			
			$sql = "UPDATE PERS_TRACKING SET STATUS = 1, NO_SURAT = UPPER('$no_terima'), TGL_SURAT = TO_DATE('".$thn."-".$bln."-".$tgl."', 'YYYY-MM-DD HH24:MI:SS'),TGL_UPDATE = SYSDATE WHERE ID_TRX_HDR = ".$id_trx_hdr." AND URUTAN = 9";
			$this->db->query($sql);
			
			// $id_trx = "SELECT a.ID_TRX
			// 		  FROM PERS_TRX_DTL A
			// 		  LEFT JOIN PERS_TRX_AJU C ON A .ID_TRX = C.ID_TRX
			// 		  WHERE C.STATUS_APPROVAL=1
			// 			AND	C.STATUS_BERJALAN=2
			// 			AND a.ID_TRX_HDR = $id_trx_hdr";
			// $res = $this->db->query($id_trx);
			
			// $array = array();
			// foreach($res->result() as $row){
			// 	$array[] = $row->ID_TRX;
			// }
			
			// for ($i=0; $i < count($array); $i++) { 
			// 	$sql2 = "UPDATE PERS_TRX_AJU SET ID = 9,TGL_UPDATE=SYSDATE  WHERE ID_TRX = $array[$i]";
				
			// 	$this->db->query($sql2);
			// }
			


			$sql2 = "UPDATE PERS_TRX_AJU SET ID = 12,TGL_UPDATE=SYSDATE  WHERE ID_TRX = '{$id_trx}'";	
			$this->db->query($sql2);

			$sql3 = "INSERT INTO PERS_TRACKING (ID_TRACKING, ID_TRX_HDR, URUTAN, STATUS, KETERANGAN, TGL_UPDATE) VALUES ((SELECT MAX(ID_TRACKING) + 1 FROM PERS_TRACKING), ".$id_trx_hdr.", 12, 2,'".$notifikasi."',SYSDATE)";
			// var_dump($sql3);
			$this->db->query($sql3);

			/*$sql4 = "UPDATE PERS_TRACKING SET NO_SURAT = UPPER('".$no_bu."'),TGL_SURAT = SYSDATE,TGL_UPDATE = SYSDATE WHERE ID_TRX_HDR = ".$id_trx_hdr." AND URUTAN = 7";
			$this->db->query($sql4);*/

			return $this->db->affected_rows();
			
		}

		public function updatePerbal($tbl, $data, $tgl_perbal, $dimajukan, $id_trx_hdr){
			$tgl_perbal_fix = "TO_DATE('$tgl_perbal', 'DD-MM-YYYY')";
			$dimajukan_fix = "TO_DATE('$dimajukan', 'DD-MM-YYYY')";
			$sql = "UPDATE {$tbl} SET DIKERJAKAN = '{$data['DIKERJAKAN']}', DIPERIKSA = '{$data['DIPERIKSA']}', DIEDARKAN = '{$data['DIEDARKAN']}', DISETUJUI = '{$data['DISETUJUI']}', DIMAJUKAN = {$dimajukan_fix}, HAL = '{$data['HAL']}', SIFAT = '{$data['SIFAT']}', LAMPIRAN = '{$data['LAMPIRAN']}', PEMARAF = '{$data['PEMARAF']}', TEMBUSAN = '{$data['TEMBUSAN']}', DISERAHKAN = '{$data['DISERAHKAN']}', NO_PERBAL = '{$data['NO_PERBAL']}', TGL_PERBAL = {$tgl_perbal_fix} WHERE ID_TRX_HDR = {$id_trx_hdr}";
			// var_dump($sql);exit;
			$this->db->query($sql);
			return $this->db->affected_rows();
		}





		public function getdataskpd(){
			$requestData = $this->input->post();
			// var_dump($requestData);exit;
			$aoColumns = array(
	            0 => 'NO',
	            1 => 'NRK',
	            2 => 'NO_SURAT_SKPD',
	            3 => 'TGL_SURAT_SKPD',
	            4 => 'AKSI',
	            5 => 'VALID'
	            //5 => 'KET_JENIS_PERMOHONAN'
            );
			

			$sql = "SELECT
						B. NRK,
						A. ID_TRX_SKPD,
						A .NO_SURAT_SKPD,
						TO_CHAR (
							A .TGL_SURAT_SKPD,
							'DD-MM-YYYY'
						) TGL_SURAT_SKPD,
						C .KET_PERMOHONAN,
						D .KET_JENIS_PERMOHONAN
					FROM
						PERS_TRX_SKPD A
					LEFT JOIN PERS_TRX_AJU B ON A .ID_TRX = B.ID_TRX
					LEFT JOIN PERS_REF_PERMOHONAN C ON A .ID_PERMOHONAN = C.ID_PERMOHONAN
					LEFT JOIN PERS_JENIS_PERMOHONAN D ON C.ID_PERMOHONAN = D .ID_PERMOHONAN
					AND A .ID_JENIS_PERMOHONAN = D .ID_JENIS_PERMOHONAN
					WHERE
						A .STATUS_APPROVAL_TU = 2
					AND A. ID_PERMOHONAN = ".$requestData['id_permohonan']."
					AND A. ID_JENIS_PERMOHONAN = ".$requestData['jenis_permohonan']."
					";
			// var_dump($sql);
			$query = $this->db->query($sql);
			$totalData = $query->num_rows();
			$totalFiltered = $totalData;

			$dataaa=array();
			$no=1;
			foreach ($query->result() as $row)
	        {   
	        	// var_dump($row);exit;
	        	$tgl = explode('-',$row->TGL_SURAT_SKPD);
	        	// var_dump($tgl);exit;
	            $nestedData= array();
	            $nestedData[] = $no;
	            $nestedData[] =  '<span id="id_trx_skpd">'.$row->ID_TRX_SKPD.'</span><input type="hidden" name="id_trx_skpd_post[]" value="'.$row->ID_TRX_SKPD.'">';
	            $nestedData[] = '<span id="table_nrk">'.$row->NRK.'</span><span style="display:none">~</span>';
	            $nestedData[] = '<span id="table_no_surat_skpd">'.$row->NO_SURAT_SKPD.'</span>';
	            $nestedData[] = '<span id="table_tgl_surat_skpd">'.$row->TGL_SURAT_SKPD.'</span>';
	            $nestedData[] = '<button class="btn btn-primary" data-toggle="modal" data-target="#myModal" id="test_btn" onclick="tes('.$row->NRK.',&#39;'.$row->NO_SURAT_SKPD.'&#39;,&#39;'.$tgl[0].'-'.$tgl[1].'-'.$tgl[2].'&#39;);"> Cek File </button>';
	            $nestedData[] = '<a onClick="valid_yes('.$row->ID_TRX_SKPD.')" id="valid_yes">Yes</a>/<a onClick="valid_no('.$row->ID_TRX_SKPD.')" id="valid_no">No</a>';
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

		public function get_jenis_permohonan(){
			$sql = "SELECT * FROM PERS_JENIS_PERMOHONAN";
			$query = $this->db->query($sql);
			return $query;
		}

		// public function getpgw(){
		// 	$requestData = $this->input->post();

		// 	// var_dump($requestData);exit;

		// 	$columns = array(
	 //            0 => 'NRK',
	 //            1 => 'NAMA'	          
  //           );
		// 	//$spm = $requestData['spm'];

		// 	// $sql = "SELECT A.NRK,B.NAMA FROM \"vw_jabatan_terakhir\" A
		// 	// 		LEFT JOIN PERS_PEGAWAI1 B ON A.NRK = B.NRK
		// 	// 		WHERE A.NRK='178090'";

		// 	$sql = "SELECT A.NRK, A.TGL_PERMOHONAN, B.NAMA FROM PERS_TRX_PERMOHONAN A LEFT JOIN PERS_PEGAWAI1 B ON A.NRK = B.NRK";

		// 	// $sql = "SELECT
		// 	// 			A .*,
		// 	// 			B.NAMA,
		// 	// 			B.SPMU,
		// 	// 			C.ALAMAT,
		// 	// 			C.RT,
		// 	// 			C.RW,
		// 	// 			D .NAKEL,
		// 	// 			E .KOCAM,
		// 	// 			E .NACAM,
		// 	// 			F.KOWIL,
		// 	// 			F.NAWIL,
		// 	// 			G .KET_SYARAT,
		// 	// 			H .ID_SYARAT,
		// 	// 			H .FILE_SYARAT
		// 	// 		FROM
		// 	// 			PERS_TRX_PERMOHONAN A
		// 	// 		LEFT JOIN PERS_SYARAT_PERMOHONAN G ON A .ID_PERMOHONAN = G .ID_PERMOHONAN
		// 	// 		AND A .ID_JENIS_PERMOHONAN = G .ID_JENIS_PERMOHONAN
		// 	// 		LEFT JOIN PERS_DETAIL_TRX_PERMOHONAN H ON A .ID_JENIS_PERMOHONAN = H .ID_JENIS_PERMOHONAN
		// 	// 		AND A .TGL_PERMOHONAN = H .TGL_PERMOHONAN
		// 	// 		AND G .ID_SYARAT = H .ID_SYARAT
		// 	// 		LEFT JOIN PERS_PEGAWAI1 B ON A .NRK = B.NRK
		// 	// 		LEFT JOIN PERS_PEGAWAI2 C ON A .NRK = C.NRK
		// 	// 		LEFT JOIN PERS_KOWIL_TBL F ON C.KOWIL = F.KOWIL
		// 	// 		LEFT JOIN PERS_KOCAM_TBL E ON E .KOWIL = F.KOWIL
		// 	// 		AND C.KOCAM = E .KOCAM
		// 	// 		LEFT JOIN PERS_KOKEL_TBL D ON D .KOWIL = F.KOWIL
		// 	// 		AND D .KOCAM = E .KOCAM
		// 	// 		AND C.KOKEL = D .KOKEL"; 

		// 	$query = $this->db->query($sql);
		// 	$totalData = $query->num_rows();
		// 	$dataaa=array();
		// 	$null = '&nbsp;';
		// 	//$no=1;
		// 	foreach ($query->result() as $row)
	 //        {            
	 //            // echo $row->TGL_PERMOHONAN;
	 //            $nestedData = array();
	 //            $nestedData[]  = "<input type='checkbox' name='primary_keys[]' id='checkbox' value='".$row->NRK."'>".$null."</input>";
	 //            // $nestedData[]  = "<input style='display:none' type='checkbox' name='tgl_permohonan[]' id='checkbox' value='".$row->TGL_PERMOHONAN."'>".$null."</input>";
	 //            $nestedData[] = "<span id='".$row->NRK."'>".$row->NRK."</span>";
	 //            $nestedData[] = "<span id='".$row->NAMA."'>".$row->NAMA."</span>";
	 //            $nestedData[] = "<span id='".$row->TGL_PERMOHONAN."'>".$row->TGL_PERMOHONAN."</span>";
	 //            // $nestedData[] = "<span style='display:none' id='".$row->ALAMAT."'>".$row->ALAMAT."</span>";
	 //            // $nestedData[] = "<span style='display:none' id='".$row->RT."'>".$row->RT."</span>";
	 //            // $nestedData[] = "<span style='display:none' id='".$row->RW."'>".$row->RW."</span>";
	 //            // $nestedData[] = "<span style='display:none' id='".$row->NAKEL."'>".$row->NAKEL."</span>";
	 //            // $nestedData[] = "<span style='display:none' id='".$row->NACAM."'>".$row->NACAM."</span>";
	 //            // $nestedData[] = "<span style='display:none' id='".$row->NAWIL."'>".$row->NAWIL."</span>";
	            
	 //            $dataaa[]=$nestedData;
	 //            //$no++;
	 //        }
	 //        //var_dump($data);exit;
	 //        $json_data = array(
	 //           	"draw"            => intval( $requestData['draw'] ),
	 //            "data"            => $dataaa
	 //        );

	 //        echo json_encode($json_data);
		// }

		public function getpgwwip($nrk){
			// var_dump($where);exit;
			$data = implode(",", $nrk);
			// $data1 = implode(",", $tgl_permohonan);
			$sql = "SELECT A.NRK, A.TGL_PERMOHONAN, B.NAMA FROM PERS_TRX_PERMOHONAN A LEFT JOIN PERS_PEGAWAI1 B ON A.NRK = B.NRK WHERE A.NRK IN (".$data.")";
			// echo $sql;
			/*$sql = "SELECT
						A .*,
						B.NAMA,
						B.SPMU,
						C.ALAMAT,
						C.RT,
						C.RW,
						D .NAKEL,
						E .KOCAM,
						E .NACAM,
						F.KOWIL,
						F.NAWIL,
						G .KET_SYARAT,
						H .ID_SYARAT,
						H .FILE_SYARAT
					FROM
						PERS_TRX_PERMOHONAN A
					LEFT JOIN PERS_SYARAT_PERMOHONAN G ON A .ID_PERMOHONAN = G .ID_PERMOHONAN
					AND A .ID_JENIS_PERMOHONAN = G .ID_JENIS_PERMOHONAN
					LEFT JOIN PERS_DETAIL_TRX_PERMOHONAN H ON A .ID_JENIS_PERMOHONAN = H .ID_JENIS_PERMOHONAN
					AND A .TGL_PERMOHONAN = H .TGL_PERMOHONAN
					AND G .ID_SYARAT = H .ID_SYARAT
					LEFT JOIN PERS_PEGAWAI1 B ON A .NRK = B.NRK
					LEFT JOIN PERS_PEGAWAI2 C ON A .NRK = C.NRK
					LEFT JOIN PERS_KOWIL_TBL F ON C.KOWIL = F.KOWIL
					LEFT JOIN PERS_KOCAM_TBL E ON E .KOWIL = F.KOWIL
					AND C.KOCAM = E .KOCAM
					LEFT JOIN PERS_KOKEL_TBL D ON D .KOWIL = F.KOWIL
					AND D .KOCAM = E .KOCAM
					AND C.KOKEL = D .KOKEL
					WHERE
						A .NRK = IN(".$data.")";*/
			// var_dump($test);exit;
			// $sql = "SELECT A.NRK,B.NAMA FROM \"vw_jabatan_terakhir\" A
			// 		LEFT JOIN PERS_PEGAWAI1 B ON A.NRK = B.NRK
			// 		WHERE A.NRK IN (".$data.") AND ROWNUM<=10";
			// echo $sql;exit;
			/*var_dump("SELECT A.NRK,B.NAMA FROM \"vw_jabatan_terakhir\" A
					LEFT JOIN PERS_PEGAWAI1 B ON A.NRK = B.NRK
					WHERE A.NRK IN (".$data.") AND ROWNUM<=10");exit;*/
			$query = $this->db->query($sql);
			
			$table = "";
			//$no = 1;
			foreach ($query->result() as $row)
	        {            
	            $table .= "<tr>";
	            //$table .= "<td id='".$no."'>".$no."</td>";
	            $table .= "<td id='table_nrk'>".$row->NRK."</td>";
	            $table .= "<td id='table_nama'>".$row->NAMA."</td>";
	            $table .= "<td id='table_tgl'>".$row->TGL_PERMOHONAN."</td>";
	            // $table .= "<td style='display:none' id='".$row->ALAMAT."'>".$row->ALAMAT."</td>";
	            // $table .= "<td style='display:none' id='".$row->RT."'>".$row->RT."</td>";
	            // $table .= "<td style='display:none' id='".$row->RW."'>".$row->RW."</td>";
	            // $table .= "<td style='display:none' id='".$row->NAKEL."'>".$row->NAKEL."</td>";
	            // $table .= "<td style='display:none' id='".$row->NACAM."'>".$row->NACAM."</td>";
	            // $table .= "<td style='display:none' id='".$row->NAWIL."'>".$row->NAWIL."</td>";
	            $table .= "<td id='deleteRow'><a><i class='fa fa-trash-o' aria-hidden='true'></i></a></td>";
	            $table .= "</tr>";	            
	            //$no++;	            
	        }
	        
	        $json_data = array(
	            "dataTable" => $table
	        );

	        $result = json_encode($json_data);
	        return $result;
		}

		public function get_permohonan(){
			$sql = "SELECT * FROM PERS_REF_PERMOHONAN";
			$query = $this->db->query($sql);
			foreach($query->result() as $row){
				$table = "<option value='".$row->ID_PERMOHONAN."'>".$row->KET_PERMOHONAN."</option>";
			}
			return $table;
			// $result = json_encode($table);
			// return $result;
			// return $query;
		}
		
		public function get_persyaratan_model(){
			$where = $this->input->post();
			$nrk_post = $where['NRK'];
			//$permohonan_post = $where['ID_PERMOHONAN'];
			$jenis_permohonan_post = $where['ID_JENIS_PERMOHONAN'];
			// var_dump($where);exit;
			// $sql = "SELECT * FROM PERS_DTL_TRX_AJU A LEFT JOIN PERS_SYARAT_PERMOHONAN B ON A.ID_SYARAT = B.ID_SYARAT WHERE A.NRK = '178090' AND A.ID_PERMOHONAN = '1'";
			$sql = "SELECT
					A.FILE_SYARAT,
					B.NRK,
					B.TGL_PERMOHONAN,
					B. ID_PERMOHONAN,
					B.ID_JENIS_PERMOHONAN,
					C.KET_SYARAT,
					C.ID_SYARAT
					FROM
						PERS_DTL_TRX_AJU A
					LEFT JOIN PERS_TRX_AJU B ON A .ID_TRX = B.ID_TRX
					LEFT JOIN PERS_SYARAT_PERMOHONAN C ON B.ID_PERMOHONAN = C.ID_PERMOHONAN AND B.ID_JENIS_PERMOHONAN = C.ID_JENIS_PERMOHONAN AND A .ID_SYARAT = C.ID_SYARAT
					WHERE
						B.NRK = '".$nrk_post."'
						AND B.ID_JENIS_PERMOHONAN = '".$jenis_permohonan_post."'
						AND B.STATUS_APPROVAL = 1
					ORDER BY
						C.ID_SYARAT";
			// var_dump($sql);exit;
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
		            $table .= "<td class='text-center'><a href='".site_url('assets/file_permohonan/'.$row->NRK.'/'.$row->FILE_SYARAT)."' target='external'><i class='fa fa-external-link' aria-hidden='true'></i></a></td>";
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

		public function verifikasi_file($nrk){
			$sql = "SELECT
					A .FILE_SYARAT
					FROM
						PERS_DTL_TRX_AJU A
					LEFT JOIN PERS_TRX_AJU B ON A .ID_TRX = B.ID_TRX
					LEFT JOIN PERS_SYARAT_PERMOHONAN C ON B.ID_PERMOHONAN = C.ID_PERMOHONAN
					AND B.ID_JENIS_PERMOHONAN = C.ID_JENIS_PERMOHONAN
					AND A .ID_SYARAT = C.ID_SYARAT
					WHERE
						B.NRK = '".$nrk."'";
			$query = $this->db->query($sql);
			$test = $query->result();
			// var_dump($query->num_rows());exit;
			$res = '';
			foreach ($query->result() as $value) {
				// var_dump($value);exit;

				if(is_null($value->FILE_SYARAT)){
					$res .= 'error ';
				}else{
					$res .= 'works ';
				}
			}

			$result = json_encode($res);
	        return $result;
			// var_dump($query->result());exit;
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
						F.ID_TRX
					FROM
						PERS_PEGAWAI1 A
					LEFT JOIN PERS_PEGAWAI2 B ON A .NRK = B.NRK
					LEFT JOIN LOKASI C ON B.KOWIL = C.KODE
		            LEFT JOIN LOKASI D ON B.KOCAM = D.KODE
		            LEFT JOIN LOKASI E ON B.KOKEL = E.KODE
					LEFT JOIN PERS_TRX_AJU F ON A .NRK = F.NRK
					WHERE
						A .NRK = '".$prm."'";
			$query1 = $this->db->query($sql2);
			// var_dump($query1->result());exit;
			foreach ($query1->result() as $res) {
				// $data = 'nrk'. $res->NRK; 
				$arrayName = array('id_trx' => $res->ID_TRX, 'nrk' => $res->NRK, 'nama' => $res->NAMA);
			}
			/*, 'alamat' => $res->ALAMAT, 'rt' => $res->RT, 
					'rw' => $res->RW, 'nama_wilayah' => $res->NAWIL, 'nama_kecamatan' => $res->NACAM, 'nama_kelurahan' => $res->NAKEL*/
			$result = json_encode($arrayName);
	        return $result;
		}

		public function insert_data($data){
			$count = $data['id_trx_skpd'];
			$no_surat = $data['no_surat_tu'];
			$status_approval = 2;
			
			$sql = array();
			$upd = array();
			for ($i=0; $i < count($count); $i++) { 
				
				$upd[$i] = "UPDATE PERS_TRX_SKPD SET STATUS_APPROVAL_TU = 1 WHERE ID_TRX_SKPD = ".$data['id_trx_skpd'][$i]."";
				$exupd[$i] = $this->db->query($upd[$i]);

				$date = date('Y-m-d H:i:s', time());
				$sql[$i] = "INSERT INTO PERS_TRX_TUBKD VALUES ((SELECT COUNT (*) + 1 FROM PERS_TRX_TUBKD), '".$no_surat."', TO_CHAR(TO_DATE('".$date."', 'YYYY-MM-DD HH24:MI:SS')), '".$data['id_trx_skpd'][$i]."', '".$status_approval."')";
				
				$exsql[$i] = $this->db->query($sql[$i]);
			}
			return count($count);	
		}

		public function update_data($data){
			$count = $data['id_trx_skpd'];
			
			$upd = array();
			for ($i=0; $i < count($count); $i++) { 
				
				$upd[$i] = "UPDATE PERS_TRX_SKPD SET STATUS_APPROVAL_TU = 3 WHERE ID_TRX_SKPD = ".$data['id_trx_skpd'][$i]."";
				$exupd[$i] = $this->db->query($upd[$i]);

			}
			return count($count);	
		}


		public function get_all_data_terima(){
			$aoColumns = array(
	            
	            0 => 'NO_PERMOHONAN',
	            1 => 'TGL_PERMOHONAN',
	            2 => 'KET_PERMOHONAN',
	            3 => 'KET_JENIS_PERMOHONAN'
	            
            );

			$q = "SELECT COUNT( A.ID_TRX_HDR) JML FROM PERS_TRX_HDR A
				LEFT JOIN PERS_TRACKING B ON A.ID_TRX_HDR = B.ID_TRX_HDR
				WHERE B.URUTAN = 2 AND B.STATUS = 1 ";

        	$rs = $this->db->query($q)->result();
        	$totalData = $rs[0]->JML;

			$requestData = $this->input->post();
			
			$sql = "SELECT ROWNUM, X.* 
					FROM
					(
						SELECT ROWNUM AS RN,ID_TRX_HDR,NO_SURAT_PERMOHONAN,TGL_SURAT_PERMOHONAN,KET_PERMOHONAN, KET_JENIS_PERMOHONAN
						FROM
						(
							SELECT DISTINCT A.ID_TRX_HDR,A.NO_SURAT_PERMOHONAN,TO_DATE(A.TGL_SURAT_PERMOHONAN,'DD-MM-YYYY')TGL_SURAT_PERMOHONAN,E.KET_PERMOHONAN,F.KET_JENIS_PERMOHONAN
							FROM PERS_TRX_HDR A
							LEFT JOIN PERS_TRACKING B ON A.ID_TRX_HDR = B.ID_TRX_HDR
							LEFT JOIN PERS_TRX_DTL C ON A.ID_TRX_HDR = C.ID_TRX_HDR
							LEFT JOIN PERS_TRX_AJU D ON C.ID_TRX = D.ID_TRX
							LEFT JOIN PERS_REF_PERMOHONAN E ON D.ID_PERMOHONAN = E.ID_PERMOHONAN
							LEFT JOIN PERS_JENIS_PERMOHONAN F ON D.ID_PERMOHONAN = F.ID_PERMOHONAN AND D.ID_JENIS_PERMOHONAN = F.ID_JENIS_PERMOHONAN 
							WHERE B.URUTAN = 2 AND B.STATUS = 1 
						)PRM
					)X ";
			

			$sql.="WHERE 1=1";
			if( !empty($requestData['search']['value']) ) {   // if there is a search parameter, $requestData['search']['value'] contains search parameter
            $sql.=" AND ( X.NO_SURAT_PERMOHONAN LIKE UPPER('%".$requestData['search']['value']."%') ";    
            $sql.=" OR X.KET_PERMOHONAN LIKE UPPER ('%".$requestData['search']['value']."%') ";
            $sql.=" OR X.TGL_SURAT_PERMOHONAN LIKE UPPER ('%".$requestData['search']['value']."%') ";
            $sql.=" OR X.KET_JENIS_PERMOHONAN LIKE UPPER('%".$requestData['search']['value']."%') )";
			}

			
			

            $sql.=" AND RN > ".$requestData['start']."  AND ROWNUM <= ".$requestData['length'];
            
           	$result = $this->db->query($sql);
            $totalFiltered = $result->num_rows();

			$dataaa=array();

			$no = $requestData['start']+1;
			foreach ($result->result() as $row)
	        {            
	            $nestedData = array();
	            $nestedData[] = $no;
	           
	            $nestedData[] = $row->NO_SURAT_PERMOHONAN;
	            $nestedData[] = $row->TGL_SURAT_PERMOHONAN;
	            $nestedData[] = $row->KET_PERMOHONAN;
	            $nestedData[] = $row->KET_JENIS_PERMOHONAN;
	            //$nestedData[] = '<button class="btn btn-primary btn-xs" data-toggle="modal" data-target="#myModal" id="test_btn" onclick="cekFile('.$row->ID_TRX_DETAIL.','.$row->NRK.',\''.$row->NAMA.'\','.$row->ID_TRX.');"> Cek file </button>';
	            //$nestedData[] = "-";
	            $nestedData[] = '<button type="button" class="btn btn-primary btn-xs" onclick="setT2('.$row->ID_TRX_HDR.',&#39;'.$row->NO_SURAT_PERMOHONAN.'&#39;)">Lihat</button>';

	            //$nestedData[] = "<a id='verifikasi' onClick='click_persyaratan(".$row->ID_TRX.");'>Lihat</a>";
	            //$nestedData['DT_RowId'] = "nomor_".$no;
	            
	            $dataaa[]=$nestedData;
	            $no++;
	        }
	        $json_data = array(
	           	/*"draw"            => intval( $requestData['draw'] ),*/
	           	"recordsTotal"    => intval( $totalData ),
            	"recordsFiltered" => intval( $totalFiltered ),
	            "data"            => $dataaa
	        );

			return json_encode($json_data);
		}



		public function get_all_data_terima2(){
			$aoColumns = array(
	            
	            0 => 'NO_PERMOHONAN',
	            1 => 'TGL_PERMOHONAN',
	            2 => 'KET_PERMOHONAN',
	            3 => 'KET_JENIS_PERMOHONAN'
	            
            );

			$q = "SELECT COUNT( A.ID_TRX_HDR) JML FROM PERS_TRX_HDR A
				LEFT JOIN PERS_TRACKING B ON A.ID_TRX_HDR = B.ID_TRX_HDR
				WHERE B.URUTAN = 4 AND B.STATUS = 1 ";

        	$rs = $this->db->query($q)->result();
        	$totalData = $rs[0]->JML;

			$requestData = $this->input->post();
			
			$sql = "SELECT ROWNUM, X.* 
					FROM
					(
						SELECT ROWNUM AS RN,ID_TRX_HDR,NO_SURAT_PERMOHONAN,TGL_SURAT_PERMOHONAN,KET_PERMOHONAN, KET_JENIS_PERMOHONAN
						FROM
						(
							SELECT DISTINCT A.ID_TRX_HDR,A.NO_SURAT_PERMOHONAN,TO_DATE(A.TGL_SURAT_PERMOHONAN,'DD-MM-YYYY')TGL_SURAT_PERMOHONAN,E.KET_PERMOHONAN,F.KET_JENIS_PERMOHONAN
							FROM PERS_TRX_HDR A
							LEFT JOIN PERS_TRACKING B ON A.ID_TRX_HDR = B.ID_TRX_HDR
							LEFT JOIN PERS_TRX_DTL C ON A.ID_TRX_HDR = C.ID_TRX_HDR
							LEFT JOIN PERS_TRX_AJU D ON C.ID_TRX = D.ID_TRX
							LEFT JOIN PERS_REF_PERMOHONAN E ON D.ID_PERMOHONAN = E.ID_PERMOHONAN
							LEFT JOIN PERS_JENIS_PERMOHONAN F ON D.ID_PERMOHONAN = F.ID_PERMOHONAN AND D.ID_JENIS_PERMOHONAN = F.ID_JENIS_PERMOHONAN 
							WHERE B.URUTAN = 4 AND B.STATUS = 1 
						)PRM
					)X ";
			

			$sql.="WHERE 1=1";
			if( !empty($requestData['search']['value']) ) {   // if there is a search parameter, $requestData['search']['value'] contains search parameter
            $sql.=" AND ( X.NO_SURAT_PERMOHONAN LIKE UPPER('%".$requestData['search']['value']."%') ";    
            $sql.=" OR X.KET_PERMOHONAN LIKE UPPER ('%".$requestData['search']['value']."%') ";
            $sql.=" OR X.TGL_SURAT_PERMOHONAN LIKE UPPER ('%".$requestData['search']['value']."%') ";
            $sql.=" OR X.KET_JENIS_PERMOHONAN LIKE UPPER('%".$requestData['search']['value']."%') )";
			}

			
			

            $sql.=" AND RN > ".$requestData['start']."  AND ROWNUM <= ".$requestData['length'];
            
           	$result = $this->db->query($sql);
            $totalFiltered = $result->num_rows();

			$dataaa=array();

			$no = $requestData['start']+1;
			foreach ($result->result() as $row)
	        {            
	            $nestedData = array();
	            $nestedData[] = $no;
	           
	            $nestedData[] = $row->NO_SURAT_PERMOHONAN;
	            $nestedData[] = $row->TGL_SURAT_PERMOHONAN;
	            $nestedData[] = $row->KET_PERMOHONAN;
	            $nestedData[] = $row->KET_JENIS_PERMOHONAN;
	            //$nestedData[] = '<button class="btn btn-primary btn-xs" data-toggle="modal" data-target="#myModal" id="test_btn" onclick="cekFile('.$row->ID_TRX_DETAIL.','.$row->NRK.',\''.$row->NAMA.'\','.$row->ID_TRX.');"> Cek file </button>';
	            //$nestedData[] = "-";
	            $nestedData[] = '<button type="button" class="btn btn-primary btn-xs" onclick="setT2('.$row->ID_TRX_HDR.',&#39;'.$row->NO_SURAT_PERMOHONAN.'&#39;)">Lihat</button>';

	            //$nestedData[] = "<a id='verifikasi' onClick='click_persyaratan(".$row->ID_TRX.");'>Lihat</a>";
	            //$nestedData['DT_RowId'] = "nomor_".$no;
	            
	            $dataaa[]=$nestedData;
	            $no++;
	        }
	        $json_data = array(
	           	/*"draw"            => intval( $requestData['draw'] ),*/
	           	"recordsTotal"    => intval( $totalData ),
            	"recordsFiltered" => intval( $totalFiltered ),
	            "data"            => $dataaa
	        );

			return json_encode($json_data);
		}


		public function get_all_data_terima3(){
			$aoColumns = array(
	            
	            0 => 'NO_PERMOHONAN',
	            1 => 'TGL_PERMOHONAN',
	            2 => 'NO_BIRO_HUKUM',
	            3 => 'TGL_BIRO_HUKUM',
	            4 => 'KET_PERMOHONAN',
	            5 => 'KET_JENIS_PERMOHONAN'
	            
            );

			$q = "SELECT COUNT( A.ID_TRX_HDR) JML FROM PERS_TRX_HDR A
				LEFT JOIN PERS_TRACKING B ON A.ID_TRX_HDR = B.ID_TRX_HDR
				WHERE B.URUTAN = 6 AND B.STATUS = 1 ";

        	$rs = $this->db->query($q)->result();
        	$totalData = $rs[0]->JML;

			$requestData = $this->input->post();
			
			$sql = "SELECT ROWNUM, X.* 
					FROM
					(
						SELECT ROWNUM AS RN,ID_TRX_HDR,NO_SURAT_PERMOHONAN,TGL_SURAT_PERMOHONAN,NO_BIRO_HUKUM,TGL_BIRO_HUKUM,KET_PERMOHONAN, KET_JENIS_PERMOHONAN
						FROM
						(
							SELECT DISTINCT
								A .ID_TRX_HDR,
								B.NO_SURAT_PERMOHONAN,
								TO_CHAR (
									B.TGL_SURAT_PERMOHONAN,
									'DD-MM-YYYY'
								) TGL_SURAT_PERMOHONAN,
								(SELECT NO_SURAT AS NO_SURAT_BH FROM PERS_TRACKING WHERE ID_TRX_HDR = A.ID_TRX_HDR AND URUTAN =5)NO_BIRO_HUKUM,
								(SELECT TO_CHAR(TGL_SURAT,'DD-MM-YYYY') AS TGL_SURAT_BH FROM PERS_TRACKING WHERE ID_TRX_HDR = A.ID_TRX_HDR AND URUTAN =5)TGL_BIRO_HUKUM,
								B.ID_SOP,
								D .ID_PERMOHONAN,
								D .ID_JENIS_PERMOHONAN,
								E .KET_PERMOHONAN,
								F.KET_JENIS_PERMOHONAN
							FROM
								PERS_TRACKING A
							LEFT JOIN PERS_TRX_HDR B ON A .ID_TRX_HDR = B.ID_TRX_HDR
							LEFT JOIN PERS_TRX_DTL C ON A .ID_TRX_HDR = C.ID_TRX_HDR
							LEFT JOIN PERS_TRX_AJU D ON C.ID_TRX = D .ID_TRX
							LEFT JOIN PERS_REF_PERMOHONAN E ON E .ID_PERMOHONAN = D .ID_PERMOHONAN
							LEFT JOIN PERS_JENIS_PERMOHONAN F ON D .ID_JENIS_PERMOHONAN = F.ID_JENIS_PERMOHONAN
							WHERE
								A .URUTAN = 6
							AND A .STATUS = 1
						)PRM
					)X ";
			

			$sql.="WHERE 1=1";
			if( !empty($requestData['search']['value']) ) {   // if there is a search parameter, $requestData['search']['value'] contains search parameter
            $sql.=" AND ( X.NO_SURAT_PERMOHONAN LIKE UPPER('%".$requestData['search']['value']."%') ";
            $sql.=" OR X.NO_BIRO_HUKUM LIKE UPPER ('%".$requestData['search']['value']."%') ";    
            $sql.=" OR X.KET_PERMOHONAN LIKE UPPER ('%".$requestData['search']['value']."%') ";
            $sql.=" OR X.TGL_SURAT_PERMOHONAN LIKE UPPER ('%".$requestData['search']['value']."%') ";
            $sql.=" OR X.KET_JENIS_PERMOHONAN LIKE UPPER('%".$requestData['search']['value']."%') )";
			}

			
			

            $sql.=" AND RN > ".$requestData['start']."  AND ROWNUM <= ".$requestData['length'];
            
           	$result = $this->db->query($sql);
            $totalFiltered = $result->num_rows();

			$dataaa=array();

			$no = $requestData['start']+1;
			foreach ($result->result() as $row)
	        {            
	            $nestedData = array();
	            $nestedData[] = $no;
	           
	            $nestedData[] = $row->NO_SURAT_PERMOHONAN;
	            $nestedData[] = $row->TGL_SURAT_PERMOHONAN;
	            $nestedData[] = $row->NO_BIRO_HUKUM;
	            $nestedData[] = $row->TGL_BIRO_HUKUM;
	            $nestedData[] = $row->KET_PERMOHONAN;
	            $nestedData[] = $row->KET_JENIS_PERMOHONAN;
	            //$nestedData[] = '<button class="btn btn-primary btn-xs" data-toggle="modal" data-target="#myModal" id="test_btn" onclick="cekFile('.$row->ID_TRX_DETAIL.','.$row->NRK.',\''.$row->NAMA.'\','.$row->ID_TRX.');"> Cek file </button>';
	            //$nestedData[] = "-";
	            $nestedData[] = '<button type="button" class="btn btn-primary btn-xs" onclick="setT2('.$row->ID_TRX_HDR.',&#39;'.$row->NO_SURAT_PERMOHONAN.'&#39;)">Lihat</button>';

	            //$nestedData[] = "<a id='verifikasi' onClick='click_persyaratan(".$row->ID_TRX.");'>Lihat</a>";
	            //$nestedData['DT_RowId'] = "nomor_".$no;
	            
	            $dataaa[]=$nestedData;
	            $no++;
	        }
	        $json_data = array(
	           	/*"draw"            => intval( $requestData['draw'] ),*/
	           	"recordsTotal"    => intval( $totalData ),
            	"recordsFiltered" => intval( $totalFiltered ),
	            "data"            => $dataaa
	        );

			return json_encode($json_data);
		}

		public function get_all_data_terima4(){
			$aoColumns = array(
	            
	            0 => 'NO_PERMOHONAN',
	            1 => 'TGL_PERMOHONAN',
	            2 => 'NO_BIRO_UMUM',
	            3 => 'TGL_BIRO_UMUM',
	            4 => 'KET_PERMOHONAN',
	            5 => 'KET_JENIS_PERMOHONAN'
	            
            );

			$q = "SELECT COUNT( A.ID_TRX_HDR) JML FROM PERS_TRX_HDR A
				LEFT JOIN PERS_TRACKING B ON A.ID_TRX_HDR = B.ID_TRX_HDR
				WHERE B.URUTAN = 8 AND B.STATUS = 1 ";

        	$rs = $this->db->query($q)->result();
        	$totalData = $rs[0]->JML;

			$requestData = $this->input->post();
			
			$sql = "SELECT ROWNUM, X.* 
					FROM
					(
						SELECT ROWNUM AS RN,ID_TRX_HDR,NO_SURAT_PERMOHONAN,TGL_SURAT_PERMOHONAN,NO_BIRO_UMUM,TGL_BIRO_UMUM,KET_PERMOHONAN, KET_JENIS_PERMOHONAN
						FROM
						(
							SELECT DISTINCT
							A .ID_TRX_HDR,
							B.NO_SURAT_PERMOHONAN,
							TO_CHAR (
								B.TGL_SURAT_PERMOHONAN,
								'DD-MM-YYYY'
							) TGL_SURAT_PERMOHONAN,
							(SELECT NO_SURAT AS NO_SURAT_BH FROM PERS_TRACKING WHERE ID_TRX_HDR = A.ID_TRX_HDR AND URUTAN =7)NO_BIRO_UMUM,
							(SELECT TO_CHAR(TGL_SURAT,'DD-MM-YYYY') AS TGL_SURAT_BH FROM PERS_TRACKING WHERE ID_TRX_HDR = A.ID_TRX_HDR AND URUTAN =7)TGL_BIRO_UMUM,
							B.ID_SOP,
							D .ID_PERMOHONAN,
							D .ID_JENIS_PERMOHONAN,
							E .KET_PERMOHONAN,
							F.KET_JENIS_PERMOHONAN
						FROM
							PERS_TRACKING A
						LEFT JOIN PERS_TRX_HDR B ON A .ID_TRX_HDR = B.ID_TRX_HDR
						LEFT JOIN PERS_TRX_DTL C ON A .ID_TRX_HDR = C.ID_TRX_HDR
						LEFT JOIN PERS_TRX_AJU D ON C.ID_TRX = D .ID_TRX
						LEFT JOIN PERS_REF_PERMOHONAN E ON E .ID_PERMOHONAN = D .ID_PERMOHONAN
						LEFT JOIN PERS_JENIS_PERMOHONAN F ON D .ID_JENIS_PERMOHONAN = F.ID_JENIS_PERMOHONAN
						WHERE
							A .URUTAN = 8
						AND A .STATUS = 1 
						)PRM
					)X ";
			

			$sql.="WHERE 1=1";
			if( !empty($requestData['search']['value']) ) {   // if there is a search parameter, $requestData['search']['value'] contains search parameter
            $sql.=" AND ( X.NO_SURAT_PERMOHONAN LIKE UPPER('%".$requestData['search']['value']."%') ";
            $sql.=" OR X.NO_BIRO_HUKUM LIKE UPPER ('%".$requestData['search']['value']."%') ";    
            $sql.=" OR X.KET_PERMOHONAN LIKE UPPER ('%".$requestData['search']['value']."%') ";
            $sql.=" OR X.TGL_SURAT_PERMOHONAN LIKE UPPER ('%".$requestData['search']['value']."%') ";
            $sql.=" OR X.KET_JENIS_PERMOHONAN LIKE UPPER('%".$requestData['search']['value']."%') )";
			}

			
			

            $sql.=" AND RN > ".$requestData['start']."  AND ROWNUM <= ".$requestData['length'];
            
           	$result = $this->db->query($sql);
            $totalFiltered = $result->num_rows();

			$dataaa=array();

			$no = $requestData['start']+1;
			foreach ($result->result() as $row)
	        {            
	            $nestedData = array();
	            $nestedData[] = $no;
	           
	            $nestedData[] = $row->NO_SURAT_PERMOHONAN;
	            $nestedData[] = $row->TGL_SURAT_PERMOHONAN;
	            $nestedData[] = $row->NO_BIRO_UMUM;
	            $nestedData[] = $row->TGL_BIRO_UMUM;
	            $nestedData[] = $row->KET_PERMOHONAN;
	            $nestedData[] = $row->KET_JENIS_PERMOHONAN;
	            //$nestedData[] = '<button class="btn btn-primary btn-xs" data-toggle="modal" data-target="#myModal" id="test_btn" onclick="cekFile('.$row->ID_TRX_DETAIL.','.$row->NRK.',\''.$row->NAMA.'\','.$row->ID_TRX.');"> Cek file </button>';
	            //$nestedData[] = "-";
	            $nestedData[] = '<button type="button" class="btn btn-primary btn-xs" onclick="setT2('.$row->ID_TRX_HDR.',&#39;'.$row->NO_SURAT_PERMOHONAN.'&#39;)">Lihat</button>';

	            //$nestedData[] = "<a id='verifikasi' onClick='click_persyaratan(".$row->ID_TRX.");'>Lihat</a>";
	            //$nestedData['DT_RowId'] = "nomor_".$no;
	            
	            $dataaa[]=$nestedData;
	            $no++;
	        }
	        $json_data = array(
	           	/*"draw"            => intval( $requestData['draw'] ),*/
	           	"recordsTotal"    => intval( $totalData ),
            	"recordsFiltered" => intval( $totalFiltered ),
	            "data"            => $dataaa
	        );

			return json_encode($json_data);
		}

		public function get_all_data_terima5(){
			$aoColumns = array(
	            
	            0 => 'NO_PERMOHONAN',
	            1 => 'TGL_PERMOHONAN',
	            2 => 'NO_ASISTEN_PEMERINTAHAN',
	            3 => 'TGL_ASISTEN_PEMERINTAHAN',
	            4 => 'KET_PERMOHONAN',
	            5 => 'KET_JENIS_PERMOHONAN'
	            
            );

			$q = "SELECT COUNT( A.ID_TRX_HDR) JML FROM PERS_TRX_HDR A
				LEFT JOIN PERS_TRACKING B ON A.ID_TRX_HDR = B.ID_TRX_HDR
				WHERE B.URUTAN = 8 AND B.STATUS = 1 ";

        	$rs = $this->db->query($q)->result();
        	$totalData = $rs[0]->JML;

			$requestData = $this->input->post();
			
			$sql = "SELECT ROWNUM, X.* 
					FROM
					(
						SELECT ROWNUM AS RN,ID_TRX_HDR,NO_SURAT_PERMOHONAN,TGL_SURAT_PERMOHONAN,NO_BIRO_UMUM,TGL_BIRO_UMUM,KET_PERMOHONAN, KET_JENIS_PERMOHONAN
						FROM
						(
							SELECT DISTINCT
							A .ID_TRX_HDR,
							B.NO_SURAT_PERMOHONAN,
							TO_CHAR (
								B.TGL_SURAT_PERMOHONAN,
								'DD-MM-YYYY'
							) TGL_SURAT_PERMOHONAN,
							(SELECT NO_SURAT AS NO_SURAT_BH FROM PERS_TRACKING WHERE ID_TRX_HDR = A.ID_TRX_HDR AND URUTAN =7)NO_BIRO_UMUM,
							(SELECT TO_CHAR(TGL_SURAT,'DD-MM-YYYY') AS TGL_SURAT_BH FROM PERS_TRACKING WHERE ID_TRX_HDR = A.ID_TRX_HDR AND URUTAN =7)TGL_BIRO_UMUM,
							B.ID_SOP,
							D .ID_PERMOHONAN,
							D .ID_JENIS_PERMOHONAN,
							E .KET_PERMOHONAN,
							F.KET_JENIS_PERMOHONAN
						FROM
							PERS_TRACKING A
						LEFT JOIN PERS_TRX_HDR B ON A .ID_TRX_HDR = B.ID_TRX_HDR
						LEFT JOIN PERS_TRX_DTL C ON A .ID_TRX_HDR = C.ID_TRX_HDR
						LEFT JOIN PERS_TRX_AJU D ON C.ID_TRX = D .ID_TRX
						LEFT JOIN PERS_REF_PERMOHONAN E ON E .ID_PERMOHONAN = D .ID_PERMOHONAN
						LEFT JOIN PERS_JENIS_PERMOHONAN F ON D .ID_JENIS_PERMOHONAN = F.ID_JENIS_PERMOHONAN
						WHERE
							A .URUTAN = 11
						AND A .STATUS = 1 
						)PRM
					)X ";
			

			$sql.="WHERE 1=1";
			if( !empty($requestData['search']['value']) ) {   // if there is a search parameter, $requestData['search']['value'] contains search parameter
            $sql.=" AND ( X.NO_SURAT_PERMOHONAN LIKE UPPER('%".$requestData['search']['value']."%') ";
            $sql.=" OR X.NO_BIRO_HUKUM LIKE UPPER ('%".$requestData['search']['value']."%') ";    
            $sql.=" OR X.KET_PERMOHONAN LIKE UPPER ('%".$requestData['search']['value']."%') ";
            $sql.=" OR X.TGL_SURAT_PERMOHONAN LIKE UPPER ('%".$requestData['search']['value']."%') ";
            $sql.=" OR X.KET_JENIS_PERMOHONAN LIKE UPPER('%".$requestData['search']['value']."%') )";
			}

			
			

            $sql.=" AND RN > ".$requestData['start']."  AND ROWNUM <= ".$requestData['length'];
            
           	$result = $this->db->query($sql);
            $totalFiltered = $result->num_rows();

			$dataaa=array();

			$no = $requestData['start']+1;
			foreach ($result->result() as $row)
	        {            
	            $nestedData = array();
	            $nestedData[] = $no;
	           
	            $nestedData[] = $row->NO_SURAT_PERMOHONAN;
	            $nestedData[] = $row->TGL_SURAT_PERMOHONAN;
	            $nestedData[] = $row->NO_BIRO_UMUM;
	            $nestedData[] = $row->TGL_BIRO_UMUM;
	            $nestedData[] = $row->KET_PERMOHONAN;
	            $nestedData[] = $row->KET_JENIS_PERMOHONAN;
	            //$nestedData[] = '<button class="btn btn-primary btn-xs" data-toggle="modal" data-target="#myModal" id="test_btn" onclick="cekFile('.$row->ID_TRX_DETAIL.','.$row->NRK.',\''.$row->NAMA.'\','.$row->ID_TRX.');"> Cek file </button>';
	            //$nestedData[] = "-";
	            $nestedData[] = '<button type="button" class="btn btn-primary btn-xs" onclick="setT2('.$row->ID_TRX_HDR.',&#39;'.$row->NO_SURAT_PERMOHONAN.'&#39;)">Lihat</button>';

	            //$nestedData[] = "<a id='verifikasi' onClick='click_persyaratan(".$row->ID_TRX.");'>Lihat</a>";
	            //$nestedData['DT_RowId'] = "nomor_".$no;
	            
	            $dataaa[]=$nestedData;
	            $no++;
	        }
	        $json_data = array(
	           	/*"draw"            => intval( $requestData['draw'] ),*/
	           	"recordsTotal"    => intval( $totalData ),
            	"recordsFiltered" => intval( $totalFiltered ),
	            "data"            => $dataaa
	        );

			return json_encode($json_data);
		}

		public function get_list_permohonan_baru_(){
			$sql = "SELECT A.NRK, TO_CHAR(A.TGL_PERMOHONAN, 'DD-MM-YYYY HH24:MI:SS') TGL_PERMOHONAN, A.ID_JENIS_PERMOHONAN, B.NAMA FROM PERS_TRX_AJU A LEFT JOIN PERS_PEGAWAI1 B ON A.NRK = B.NRK ORDER BY A.TGL_PERMOHONAN DESC";
			$res = $this->db->query($sql);
			$no = 1;
			$table = '';
			foreach ($res->result() as $value) {
				
				$table .= '<tr>';
				$table .= '<td>'.$no++.'</td>';
				$table .= '<td>'.$value->NRK.'</td>';
				$table .= '<td>'.$value->NAMA.'</td>';
				$table .= '<td>'.$value->TGL_PERMOHONAN.'</td>';
				$table .= '<td>'.$value->ID_JENIS_PERMOHONAN.'</td>';
				$table .= '<td>&nbsp;</td>';
				$table .= '</tr>';
				// $no++;
			}
			// var_dump($res->result());exit;
			return $table;
		}

		public function get_sop(){
			$sql = "SELECT ID_SOP, NM_SOP FROM MASTER_SOP";
			$res = $this->db->query($sql);
			$table = '';
			foreach($res->result() as $row)
			{
	            $table .= "<option value='".$row->ID_SOP."'>".$row->NM_SOP."</option>";
	        }
	        // var_dump($table);exit;
	        return $table;
		}

	}
