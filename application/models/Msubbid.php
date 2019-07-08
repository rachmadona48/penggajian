<?php
	
	class Msubbid extends CI_Model{

		public function getdatatubkdOld(){
			$requestData = $this->input->post();
			// var_dump($requestData['ID_PERMOHONAN']);
			$aoColumns = array(
	            0 => 'NO',
	            1 => 'NRK',
	            2 => 'NO_TU',
	            3 => 'TGL_TU',
	            4 => 'AKSI',
	            5 => 'VALID'
	            //5 => 'KET_JENIS_PERMOHONAN'
            );
			

			$sql = "SELECT
						A .ID_TRX_TU,
						A .NO_TU,
						TO_CHAR(A .TGL_TU, 'DD-MM-YYYY')TGL_TU,
						C.NRK
					FROM
						PERS_TRX_TUBKD A
					LEFT JOIN PERS_TRX_SKPD B ON A .ID_TRX_SKPD = B.ID_TRX_SKPD
					LEFT JOIN PERS_TRX_AJU C ON B.ID_TRX = C.ID_TRX
					WHERE
						A .STATUS_APPROVAL_SB = 2
					AND B.STATUS_APPROVAL_TU = 1";
			$query = $this->db->query($sql);
			$totalData = $query->num_rows();
			$totalFiltered = $totalData;

			$dataaa=array();
			$no=1;
			foreach ($query->result() as $row)
	        {   
	        	// var_dump($row);exit;
	        	$tgl = explode('-',$row->TGL_TU);
	        	// var_dump($tgl);exit;
	            $nestedData= array();
	            $nestedData[] = $no;
	            $nestedData[] =  '<span id="id_trx_tu">'.$row->ID_TRX_TU.'</span><input type="hidden" name="id_trx_tu_post[]" value="'.$row->ID_TRX_TU.'">';
	            $nestedData[] = '<span id="table_nrk">'.$row->NRK.'</span><span style="display:none">~</span>';
	            $nestedData[] = '<span id="table_no_tu">'.$row->NO_TU.'</span>';
	            $nestedData[] = '<span id="table_tgl_tu">'.$row->TGL_TU.'</span>';
	            $nestedData[] = '<button class="btn btn-primary" data-toggle="modal" data-target="#myModal" id="test_btn" onclick="tes('.$row->NRK.',&#39;'.$row->NO_TU.'&#39;,&#39;'.$tgl[0].'-'.$tgl[1].'-'.$tgl[2].'&#39;);"> cek File </button>';
	            // $nestedData[] = '<input type="checkbox" name="valid" id="valid" value="valid">
	            // <script type="text/javascript">
	            // 	$(document).ready(function(){
	            // 		$("#valid").click(function(){
	            // 			if($(this).is(":checked")){
	            // 				var id_trx_tu_post = $(this).closest("tr").children("td:eq(1)").text();
		           //  			//console.log(id_trx_skpd_post);
		           //  			// tes_forward(id_trx_skpd_post);
		           //  		}
	            // 		});
	            // 	});
	            // </script>';
	            $nestedData[] = '<a onClick="valid_yes('.$row->ID_TRX_TU.')" id="valid_yes">Yes</a>/<a onClick="valid_no('.$row->ID_TRX_TU.')" id="valid_no">No</a>';
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

		public function count_data($prm, $id_sop = null){
			if($prm == 1)
			{
				$sql = "SELECT COUNT (A.ID_TRX_HDR) TRX_TERIMA FROM PERS_TRACKING A LEFT JOIN PERS_TRX_HDR B ON A.ID_TRX_HDR = B.ID_TRX_HDR 
						WHERE URUTAN = 3 AND STATUS = 1 AND ID_SOP = {$id_sop}";
				/*$sql = "SELECT COUNT (A .ID_TRX_HDR) TRX_TERIMA
						FROM PERS_TRACKING A
						WHERE URUTAN = 3 AND STATUS = 1";*/
				$res = $this->db->query($sql);
				$result = $res->row();
			}
			else if($prm == 2){
				$sql = "SELECT COUNT (A.ID_TRX_HDR) TRX_HDR FROM PERS_TRACKING A LEFT JOIN PERS_TRX_HDR B ON A.ID_TRX_HDR = B.ID_TRX_HDR 
						WHERE URUTAN = 3 AND STATUS = 2 AND ID_SOP = {$id_sop}";
				/*$sql = "SELECT COUNT (ID_TRX_HDR) TRX_HDR FROM PERS_TRACKING WHERE URUTAN = 3 AND STATUS = 2";*/
				$res = $this->db->query($sql);
				$result = $res->row();
			}
			else if($prm == 3)
			{
				$sql = "SELECT COUNT (A.ID_TRX_HDR) TRX_TOLAK FROM PERS_TRACKING A LEFT JOIN PERS_TRX_HDR B ON A.ID_TRX_HDR = B.ID_TRX_HDR 
						WHERE URUTAN = 3 AND STATUS = 3 AND ID_SOP = {$id_sop}";
				// var_dump($sql);exit;
				/*$sql = "SELECT COUNT (A .ID_TRX_HDR) TRX_TOLAK
						FROM PERS_TRACKING A
						WHERE URUTAN = 3 AND STATUS = 3";*/
				$res = $this->db->query($sql);
				$result = $res->row();
			}
			else if($prm == 4)
			{
				$sql = "SELECT COUNT (A.ID_TRX_HDR) TRX_TERIMA FROM PERS_TRACKING A LEFT JOIN PERS_TRX_HDR B ON A.ID_TRX_HDR = B.ID_TRX_HDR 
						WHERE URUTAN = 9 AND STATUS = 1 AND ID_SOP = {$id_sop}";
				/*$sql = "SELECT COUNT (A .ID_TRX_HDR) TRX_TERIMA
						FROM PERS_TRACKING A
						WHERE URUTAN = 9 AND STATUS = 1";*/
				$res = $this->db->query($sql);
				$result = $res->row();
			}
			else if($prm == 5){
				$sql = "SELECT COUNT (A.ID_TRX_HDR) TRX_HDR FROM PERS_TRACKING A LEFT JOIN PERS_TRX_HDR B ON A.ID_TRX_HDR = B.ID_TRX_HDR 
						WHERE URUTAN = 9 AND STATUS = 2 AND ID_SOP = {$id_sop}";
				/*$sql = "SELECT COUNT (ID_TRX_HDR) TRX_HDR FROM PERS_TRACKING WHERE URUTAN = 9 AND STATUS = 2";*/
				$res = $this->db->query($sql);
				$result = $res->row();
			}
			else if($prm == 6)
			{
				$sql = "SELECT COUNT (A.ID_TRX_HDR) TRX_TOLAK FROM PERS_TRACKING A LEFT JOIN PERS_TRX_HDR B ON A.ID_TRX_HDR = B.ID_TRX_HDR 
						WHERE URUTAN = 9 AND STATUS = 3 AND ID_SOP = {$id_sop}";
				/*$sql = "SELECT COUNT (A .ID_TRX_HDR) TRX_TOLAK
						FROM PERS_TRACKING A
						WHERE URUTAN = 9 AND STATUS = 3";*/
				$res = $this->db->query($sql);
				$result = $res->row();
			}
			else if($prm == 7)
			{
				$sql = "SELECT COUNT (A .ID_TRX_HDR) TRX_TERIMA
						FROM PERS_TRACKING A
						WHERE URUTAN = 13 AND STATUS = 1";
				$res = $this->db->query($sql);
				$result = $res->row();
			}
			else if($prm == 8)
			{
				$sql = "SELECT COUNT (ID_TRX_HDR) TRX_HDR FROM PERS_TRACKING WHERE URUTAN = 13 AND STATUS = 2";
				$res = $this->db->query($sql);
				$result = $res->row();	
			}
			else if($prm == 9)
			{
				$sql = "SELECT COUNT (A .ID_TRX_HDR) TRX_TOLAK
						FROM PERS_TRACKING A
						WHERE URUTAN = 13 AND STATUS = 3";
				$res = $this->db->query($sql);
				$result = $res->row();
			}
			
			return $result;
		}

		public function getKlogad(){
			$sql = "SELECT KOLOK, NALOK FROM PERS_KLOGAD3_NEW";
			$res = $this->db->query($sql);
			$option = "<option value='null' selected disabled>Pilih Data</option>";
			foreach($res->result() as $row)
			{
				$option.= "<option value='".$row->KOLOK."'>".$row->NALOK."</option>";
			}
			return $option;
		}

		public function get_pemaraf_serta(){
			$sql = "SELECT * FROM MASTER_PEMARAF_SOP";
			$res = $this->db->query($sql);
			$option = null;
			foreach($res->result() as $row){
				$option .= "<option value='{$row->ID_PEMARAF}'>{$row->NAMA_PEMARAF}</option>";
			}
			return $option;
		}

		public function cloneSyarat($variable){
			$data = explode('_', $variable);
			// for ($a=0; $a < count($data); $a++) { 
				# code...
		        $getSyaratHDR = "SELECT ID_SYARAT_HDR FROM PERS_SYARAT_HDR WHERE ID_JENIS_PERMOHONAN = '{$data[0]}' AND ROWNUM = 1";
		        $resSyaratHDR = $this->db->query($getSyaratHDR)->row();
		        $getKetSyarat = "SELECT
		                            B.KET_SYARAT,
		                            B.INIT_SYARAT
		                        FROM
		                            PERS_SYARAT_HDR A
		                        LEFT JOIN PERS_SYARAT_DTL B ON
		                            A.ID_SYARAT_HDR = B.ID_SYARAT_HDR
		                        WHERE A.ID_SYARAT_HDR = '{$resSyaratHDR->ID_SYARAT_HDR}'";
		        $resKetSyarat = $this->db->query($getKetSyarat)->result();
		        $syrtHDR = "SELECT DASAR_HUKUM, MEKANISME FROM PERS_SYARAT_HDR WHERE ID_SYARAT_HDR = {$resSyaratHDR->ID_SYARAT_HDR}";
		        $resHDR = $this->db->query($syrtHDR)->row();
		        // var_dump($resHDR);
		        // var_dump($resKetSyarat);exit;
		        $count = 1;
		        $linecount = 0;
		        $file = fopen(base_url("assets/new_list.txt"), "r");
				while(!feof($file)){
					$line = fgets($file);
					if($line){
						$tmp_file[] = str_replace(' ', '', $line);;
						$linecount++;
					}
				}
				fclose($file);
				// var_dump($tmp_file);exit;
				foreach ($resKetSyarat as $value) {
					$resSyarat['ket_syarat'][] = $value->KET_SYARAT;
					$resSyarat['init_syarat'][] = $value->INIT_SYARAT;
				}
				for ($i=0; $i < count($tmp_file); $i++) {
					$getIdSyaratHDR = "SELECT MAX(ID_SYARAT_HDR) + 1 AS RES FROM PERS_SYARAT_HDR";
			        $resIdSyaratHDR = $this->db->query($getIdSyaratHDR)->row();
			        $id_syarat_hdr = $resIdSyaratHDR->RES;
		        	$sql = "INSERT INTO PERS_SYARAT_HDR (ID_SYARAT_HDR,ID_PERMOHONAN,ID_JENIS_PERMOHONAN,ID_KOJABF,DASAR_HUKUM,MEKANISME) VALUES ($id_syarat_hdr,1,'{$data[1]}','".trim($tmp_file[$i])."','{$resHDR->DASAR_HUKUM}','')";
		        	echo $sql.'<br/>';
		        	usleep(50000);
		        	// $this->db->query($sql);
		        	for ($x=1; $x < count($resSyarat['ket_syarat']); $x++) { 
						$getIdSyaratDTL = "SELECT MAX(ID_SYARAT_DTL) + 1 AS RES FROM PERS_SYARAT_DTL";
				        $resIdSyaratDTL = $this->db->query($getIdSyaratDTL)->row();
				        $id_syarat_dtl = $resIdSyaratDTL->RES;
			        	$sql1 = "INSERT INTO PERS_SYARAT_DTL (ID_SYARAT_DTL,ID_SYARAT_HDR,NO_SYARAT,KET_SYARAT,INIT_SYARAT) VALUES ($id_syarat_dtl,$id_syarat_hdr,$x,'".$resSyarat['ket_syarat'][$x]."','".$resSyarat['init_syarat'][$x]."')";
			        	echo $sql1.'<br/>';
			        	usleep(50000);
			        	// $this->db->query($sql1);
					}
				}
			// }
	    }

	    public function updateDasarHukum(){
			$linecount = 0;
	        $handle = fopen(base_url("assets/NAMAJABATANFUNGSIONALDETAIL4-DASARHUKUMJABFUNG.csv"), "r");
	        // var_dump($file);exit;
	        $row = 1;
	        while (($data = fgetcsv($handle,60,',')) !== FALSE) {
	        	// print_r($data);
	        	$sql = "UPDATE PERS_SYARAT_HDR SET DASAR_HUKUM = '{$data[1]}|{$data[2]}|{$data[3]}' WHERE ID_KOJABF LIKE '{$data[0]}%'";
	        	$this->db->query($sql);
		        // $num = count($data);
		        // echo "<p> $num fields in line $row: <br /></p>\n";
		        // $row++;
		        // for ($c=0; $c < $num; $c++) {
		        //     $kojab = $data[$c];
		        //     echo $kojab . "<br />\n";
		        // }
		        // print_r($data[1]);
		        // var_dump($sql);
		    }
		    fclose($handle);

	    }

		public function getAngkaKredit($id_trx){
			$sql = "SELECT
						A.KREDIT AS ANGKA_KREDIT,
						C.ANGKA_KREDIT AS ANGKA_KREDIT_BARU
					FROM
						PERS_JABATANF_HIST A
					LEFT JOIN PERS_TRX_AJU B ON
						A.NRK = B.NRK
					LEFT JOIN ANGKA_KREDIT_SOP C ON
						C.ID_TRX = B.ID_TRX
					WHERE
						B.ID_TRX = {$id_trx}";
			// $sql = "SELECT * FROM ANGKA_KREDIT_SOP WHERE ID_TRX = {$id_trx}";
			$res = $this->db->query($sql)->row();
			// var_dump($res);exit;
			return (is_null($res) ? 'NULL' : (!is_null($res->ANGKA_KREDIT_BARU) ? $res->ANGKA_KREDIT_BARU : $res->ANGKA_KREDIT));
		}

		public function simpanAngkaKredit($data){
			$check_sql = "SELECT COUNT(ID_TRX) AS RES FROM ANGKA_KREDIT_SOP WHERE ID_TRX = {$data['id_trx']}";
			$res_check = $this->db->query($check_sql)->row();
			if( (int) $res_check->RES == 0 ){
				$sql = "INSERT INTO ANGKA_KREDIT_SOP VALUES ((SELECT COUNT (*) + 1 AS AK FROM ANGKA_KREDIT_SOP), {$data['id_trx']}, {$data['angka_kredit']})";
			}else{
				$sql = "UPDATE ANGKA_KREDIT_SOP SET ANGKA_KREDIT = {$data['angka_kredit']} WHERE ID_TRX = {$data['id_trx']}";
			}
			$this->db->query($sql);
			return $this->db->affected_rows();
		}

		public function getdatatubkd(){
			$requestData = $this->input->post();
			// var_dump($requestData['ID_PERMOHONAN']);
			$id_sop = explode('_',$this->session->userdata['logged_in']['id_sop']);
			$wh_id_permohonan="";
			$wh_id_jns_permohonan="";
			$wh_id_kojabf="";
			if ($requestData['id_permohonan'] != ""){
				$wh_id_permohonan="AND C.ID_PERMOHONAN='".$requestData['id_permohonan']."'";
			}

			if ($requestData['id_jenis_permohonan'] != ""){
				$wh_id_jns_permohonan="AND C.ID_JENIS_PERMOHONAN='".$requestData['id_jenis_permohonan']."'";
			}

			if ($requestData['id_kojabf'] != ""){
				$wh_id_kojabf="AND C.ID_KOJABF='".$requestData['id_kojabf']."'";
			}

			$sql = "SELECT DISTINCT
						A .ID_TRX_HDR,
						A .NO_SURAT_PERMOHONAN,
						A.ID_SOP,
						TO_CHAR (
							A .TGL_SURAT_PERMOHONAN,
							'DD-MM-YYYY'
						) TGL_SURAT_PERMOHONAN,
						URUTAN,
						STATUS,
						C.ID_JENIS_PERMOHONAN,
						C.BBS_SMNTR,
						D.KET_JENIS_PERMOHONAN,
						E.NAJABL,
						T.ID_TRACKING,
						T.NO_SURAT,
						TO_CHAR (
							T.TGL_SURAT,
							'DD-MM-YYYY'
						) TGL_SURAT,
						TP.NO_PERBAL,
						DIKERJAKAN,
						DIPERIKSA,
						DIEDARKAN,
						DISETUJUI,
						TO_CHAR (
							TP.DIMAJUKAN,
							'DD-MM-YYYY'
						) DIMAJUKAN,
						HAL,
						SIFAT,
						LAMPIRAN,
						PEMARAF,
						TEMBUSAN,
						DITETAPKAN,
						DISERAHKAN
					FROM
						PERS_TRX_HDR A
					LEFT JOIN PERS_TRACKING T ON A .ID_TRX_HDR = T .ID_TRX_HDR
					LEFT JOIN PERS_TRX_DTL B ON A .ID_TRX_HDR = B.ID_TRX_HDR
					LEFT JOIN PERS_TRX_AJU C ON B.ID_TRX = C.ID_TRX
					LEFT JOIN PERS_JENIS_PERMOHONAN D ON D.ID_JENIS_PERMOHONAN = C.ID_JENIS_PERMOHONAN
					LEFT JOIN PERS_MASTER_KOJABF E ON E.KOJAB = C.ID_KOJABF
					LEFT JOIN PERS_TRACKING_PERBAL TP ON A .ID_TRX_HDR = TP.ID_TRX_HDR
					WHERE T.URUTAN=3
					AND A.ID_SOP = {$id_sop[1]}
					AND STATUS=2
					$wh_id_permohonan
					$wh_id_jns_permohonan
					$wh_id_kojabf
					";
//			AND C.ID_KOJABF='".$requestData['id_kojabf']."'
			// echo $sql;
			// var_dump($sql);exit;
			$query = $this->db->query($sql);
			$totalData = ((int)$query->num_rows() - 2);
			$totalFiltered = $totalData;

			$dataaa=array();
			$no=1;
			foreach ($query->result() as $row)
			{
				// var_dump($row);exit;
				$tgl = explode('-',$row->TGL_SURAT);
				// var_dump($tgl);exit;
				$nestedData= array();
				$nestedData[] = $no;
				$nestedData[] = "<span id='jenperm_".$no."'>{$row->KET_JENIS_PERMOHONAN}</span>";
				$nestedData[] = $row->NAJABL;
				$nestedData[] = $row->NO_SURAT_PERMOHONAN;
				$nestedData[] = $row->TGL_SURAT_PERMOHONAN;
				//Di hidden sesuai permintaan mas kikin kusumah
				/*$nestedData[] = $row->NO_SURAT;
				$nestedData[] = $row->TGL_SURAT;*/
				$nestedData[] = '
				<button type="button" class="btn btn-info btn-xs" id="alur_proses" onclick="lihatStatus('.$row->ID_TRX_HDR.',\''.$row->NO_SURAT_PERMOHONAN.'\')">Alur Proses</button>
				<button type="button" class="btn btn-primary btn-xs" onclick="setT2('.$row->ID_TRX_HDR.',\''.$row->NO_SURAT.'\')">Pegawai</button>
				';
				// var_dump($row->PEMARAF);exit;
				$pemaraf_serta = !is_null($row->PEMARAF) ? implode("|", json_decode($row->PEMARAF)) : null;
				$nestedData[] = ($row->PEMARAF == '')?'
				<button type="button" class="btn btn-success btn-xs" onclick="formPerbal('.$row->ID_TRX_HDR.')">Buat</button>':'
				<button type="button" class="btn btn-warning btn-xs" onclick="editPerbal('.$row->ID_TRX_HDR.',\''.$row->TGL_SURAT.'\',\''.$row->NO_PERBAL.'\',\''.$row->DIKERJAKAN.'\',\''.$row->DIPERIKSA.'\',\''.$row->DIEDARKAN.'\',\''.$row->DISETUJUI.'\',\''.$row->DIMAJUKAN.'\',\''.$row->HAL.'\',\''.$row->SIFAT.'\',\''.$row->LAMPIRAN.'\',\''.$pemaraf_serta.'\',\''.$row->TEMBUSAN.'\',\''.$row->DITETAPKAN.'\',\''.$row->DISERAHKAN.'\')">Edit</button>
				<button type="button" class="btn btn-info btn-xs" onclick="cetakPerbal('.$row->ID_TRX_HDR.','.$row->BBS_SMNTR.')">Cetak</button>';
				$nestedData[] = ($row->PEMARAF == '')?'
				<button type="button" class="btn btn-danger btn-xs" onclick="tolakHdr('.$row->ID_TRX_HDR.','.$row->ID_TRACKING.')">Tolak</button>':'
				<button type="button" class="btn btn-primary btn-xs" onclick="kirim('.$row->ID_TRX_HDR.','.$row->ID_TRACKING.')">Kirim</button>
				';//<button type="button" class="btn btn-info btn-xs" onclick="formSOP('.$row->ID_TRX_HDR.','.$row->ID_SOP.')">SOP</button>

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

		public function getdatatubkd2(){
			$requestData = $this->input->post();
			$id_sop = explode('_',$this->session->userdata['logged_in']['id_sop']);

			$wh_id_permohonan="";
			$wh_id_jns_permohonan="";
			$wh_id_kojabf="";
			if ($requestData['id_permohonan'] != ""){
				$wh_id_permohonan="AND C.ID_PERMOHONAN='".$requestData['id_permohonan']."'";
			}

			if ($requestData['id_jenis_permohonan'] != ""){
				$wh_id_jns_permohonan="AND C.ID_JENIS_PERMOHONAN='".$requestData['id_jenis_permohonan']."'";
			}

			if ($requestData['id_kojabf'] != ""){
				$wh_id_kojabf="AND C.ID_KOJABF='".$requestData['id_kojabf']."'";
			}

			$sql = "SELECT DISTINCT
						A .ID_TRX_HDR,
						A .NO_SURAT_PERMOHONAN,
						A.ID_SOP,
						TO_CHAR (
							A .TGL_SURAT_PERMOHONAN,
							'DD-MM-YYYY'
						) TGL_SURAT_PERMOHONAN,
						URUTAN,
						STATUS,
						C.ID_JENIS_PERMOHONAN,
						C.ID_KOJABF,
						D.KET_JENIS_PERMOHONAN,
						E.NAJABL,
						T.ID_TRACKING,
						T.URUTAN,
						T.KETERANGAN,
						T.NO_SURAT AS NO_SK,
						T.KREDIT,
						TO_CHAR (
							T.TGL_SURAT,
							'DD-MM-YYYY'
						) TGL_SK
					FROM
						PERS_TRX_HDR A
					LEFT JOIN PERS_TRACKING T ON A .ID_TRX_HDR = T .ID_TRX_HDR
					LEFT JOIN PERS_TRX_DTL B ON A .ID_TRX_HDR = B.ID_TRX_HDR
					LEFT JOIN PERS_TRX_AJU C ON B.ID_TRX = C.ID_TRX
					LEFT JOIN PERS_JENIS_PERMOHONAN D ON D.ID_JENIS_PERMOHONAN = C.ID_JENIS_PERMOHONAN
					LEFT JOIN PERS_MASTER_KOJABF E ON E.KOJAB = C.ID_KOJABF
					WHERE T.URUTAN=9
					AND A.ID_SOP = {$id_sop[1]}
					AND STATUS=2
					$wh_id_permohonan
					$wh_id_jns_permohonan
					$wh_id_kojabf
					";
//			AND C.ID_KOJABF='".$requestData['id_kojabf']."'
			// var_dump($sql);exit;
			 //echo $sql;exit;
			$query = $this->db->query($sql);
			$totalData = $query->num_rows();
			$totalFiltered = $totalData;

			$dataaa=array();
			$no=1;
			foreach ($query->result() as $row)
			{
				// var_dump($row);exit;
				$sebelumya=$row->URUTAN-1;
				$q="SELECT NO_SURAT,
						TO_CHAR (
							TGL_SURAT,
							'DD-MM-YYYY'
						) TGL_SURAT
					FROM PERS_TRACKING
					WHERE ID_TRX_HDR = ".$row->ID_TRX_HDR."
					AND URUTAN = ".$sebelumya;
//				echo $q;
				$srt = $this->db->query($q)->row();
				$tgl_surat="";
				$no_surat="";
				if ($srt){
					$tgl_surat=$srt->NO_SURAT;
					$no_surat=$srt->TGL_SURAT;
				}

				// var_dump($tgl);exit;
				$nestedData= array();
				$nestedData[] = $no;
				$nestedData[] = $row->KET_JENIS_PERMOHONAN;
				$nestedData[] = $row->NAJABL;
				$nestedData[] = $row->NO_SURAT_PERMOHONAN;
				$nestedData[] = $row->TGL_SURAT_PERMOHONAN;
				$nestedData[] = $tgl_surat;
				$nestedData[] = $no_surat;

				if($row->KETERANGAN !="" && $row->NO_SK ==""){
					$nestedData[] = '
					<button type="button" class="btn-block btn btn-info btn-xs" onclick="lihatStatus('.$row->ID_TRX_HDR.',\''.$row->NO_SURAT_PERMOHONAN.'\')">Alur Proses</button>
					<button type="button" class="btn-block btn btn-primary btn-xs" onclick="setT2('.$row->ID_TRX_HDR.',\''.$row->NO_SURAT_PERMOHONAN.'\')">Pegawai</button>
					<button type="button" class="btn-block btn btn-warning btn-xs" onclick="show_pesan('.$row->ID_TRACKING.')">Lihat Pesan</button>
					<button type="button" class="btn-block btn btn-info btn-xs" onclick="cetakPerbal('.$row->ID_TRX_HDR.','.$no.')">Cetak</button>
					';
				}elseif($row->NO_SK !=""){
					$nestedData[] = '
					<button type="button" class="btn btn-block btn-warning btn-xs" onclick="lihatStatus('.$row->ID_TRX_HDR.',\''.$row->NO_SURAT_PERMOHONAN.'\')">Alur Proses</button>
					<button type="button" class="btn btn-block btn-primary btn-xs" onclick="setT2('.$row->ID_TRX_HDR.',\''.$row->NO_SURAT_PERMOHONAN.'\')">Pegawai</button>
					<button type="button" class="btn btn-block btn-danger btn-xs" onclick="cetakPerbal('.$row->ID_TRX_HDR.','.$no.')">Cetak</button>
					';
				}else{
					$nestedData[] = '
					<button type="button" class="btn btn-block btn-warning btn-xs" onclick="lihatStatus('.$row->ID_TRX_HDR.',\''.$row->NO_SURAT_PERMOHONAN.'\')">Alur Proses</button>
					<button type="button" class="btn btn-block btn-primary btn-xs" onclick="setT2('.$row->ID_TRX_HDR.',\''.$row->NO_SURAT_PERMOHONAN.'\')">Pegawai</button>
					<button type="button" class="btn btn-block btn-danger btn-xs" onclick="cetakPerbal('.$row->ID_TRX_HDR.','.$no.')">Cetak</button>
					';
				}
				
//				$nestedData[] = '<button type="button" class="btn btn-primary btn-xs" onclick="setT2('.$row->ID_TRX_HDR.',\''.$no_surat.'\')">Detil</button>
//				<button type="button" class="btn btn-primary btn-xs" onclick="lihatStatus('.$row->ID_TRX_HDR.',\''.$no_surat.'\')">Alur</button>';

				$count_jml = function($data, $return = NULL){
					$res = $this->count_permohonan($data);
					//var_dump($res->JUMLAH);exit;
					$Jm = $res->JUMLAH;
					//var_dump($Jm);exit;
					if($Jm == 1){
						if($return == TRUE){
							return 'disabled';
						}else{
							return TRUE;
						}
					}
					else
					{
						return TRUE;
					}
				};

				// if($count_jml->JUMLAH > 1){
					$nestedData[] = ($row->NO_SK == '')?'
					<button type="button" class="btn btn-block btn-success btn-xs" onclick="formSK('.$row->ID_TRACKING.',\''.$row->NO_SK.'\',\''.$row->TGL_SK.'\',\''.$row->KREDIT.'\')">Buat</button>':'
					<button type="button" class="btn btn-block btn-warning btn-xs" onclick="formSK('.$row->ID_TRACKING.',\''.$row->NO_SK.'\',\''.$row->TGL_SK.'\',\''.$row->KREDIT.'\')">Edit</button>';
					//<button type="button" class="btn btn-block btn-success btn-xs" onclick="cetakSK('.$row->ID_TRX_HDR.')" '.$count_jml($row->ID_TRX_HDR).'>Cetak</button> ';
				// }else{
				// 	$nestedData[] = '<button type="button" class="btn btn-block btn-success btn-xs krg_dr_dua">&nbsp;</button>';
				// }
					
				if($count_jml($row->ID_TRX_HDR)){
					$nestedData[] = '<button type="button" class="btn btn-block btn-primary btn-xs" onclick="setujuAkhir('.$row->ID_TRX_HDR.','.$row->ID_TRACKING.','.$row->ID_KOJABF.')">Setuju</button>';
				}else{
					$nestedData[] = '<button type="button" class="btn btn-block btn-danger btn-xs" onclick="tolakHdr('.$row->ID_TRX_HDR.','.$row->ID_TRACKING.')">Tolak</button>';
				}
				/*$nestedData[] = ($row->NO_SK != '')?'
				<button type="button" class="btn btn-block btn-primary btn-xs" onclick="setujuAkhir('.$row->ID_TRX_HDR.','.$row->ID_TRACKING.','.$row->ID_KOJABF.')">Setuju</button>
				':'<button type="button" class="btn btn-block btn-danger btn-xs" onclick="tolakHdr('.$row->ID_TRX_HDR.','.$row->ID_TRACKING.')">Tolak</button>';*/
				//<button type="button" class="btn btn-info btn-xs" onclick="formSOP('.$row->ID_TRX_HDR.','.$row->ID_SOP.')">SOP</button>
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

		public function getdatatubkd3(){
			$requestData = $this->input->post();
			// var_dump($requestData['ID_PERMOHONAN']);

			$wh_id_permohonan="";
			$wh_id_jns_permohonan="";
			$wh_id_kojabf="";
			if ($requestData['id_permohonan'] != ""){
				$wh_id_permohonan="AND C.ID_PERMOHONAN='".$requestData['id_permohonan']."'";
			}

			if ($requestData['id_jenis_permohonan'] != ""){
				$wh_id_jns_permohonan="AND C.ID_JENIS_PERMOHONAN='".$requestData['id_jenis_permohonan']."'";
			}

			if ($requestData['id_kojabf'] != ""){
				$wh_id_kojabf="AND C.ID_KOJABF='".$requestData['id_kojabf']."'";
			}

			$sql = "SELECT DISTINCT
						A .ID_TRX_HDR,
						A .NO_SURAT_PERMOHONAN,
						A.ID_SOP,
						TO_CHAR (
							A .TGL_SURAT_PERMOHONAN,
							'DD-MM-YYYY'
						) TGL_SURAT_PERMOHONAN,
						URUTAN,
						STATUS,
						C.ID_JENIS_PERMOHONAN,
						C.ID_KOJABF,
						D.KET_JENIS_PERMOHONAN,
						E.NAJABL,
						T.ID_TRACKING,
						T.URUTAN,
						T.KETERANGAN,
						T.NO_SURAT AS NO_SK,
						T.KREDIT,
						TO_CHAR (
							T.TGL_SURAT,
							'DD-MM-YYYY'
						) TGL_SK
					FROM
						PERS_TRX_HDR A
					LEFT JOIN PERS_TRACKING T ON A .ID_TRX_HDR = T .ID_TRX_HDR
					LEFT JOIN PERS_TRX_DTL B ON A .ID_TRX_HDR = B.ID_TRX_HDR
					LEFT JOIN PERS_TRX_AJU C ON B.ID_TRX = C.ID_TRX
					LEFT JOIN PERS_JENIS_PERMOHONAN D ON D.ID_JENIS_PERMOHONAN = C.ID_JENIS_PERMOHONAN
					LEFT JOIN PERS_MASTER_KOJABF E ON E.KOJAB = C.ID_KOJABF
					WHERE T.URUTAN=11
					AND STATUS=2
					$wh_id_permohonan
					$wh_id_jns_permohonan
					$wh_id_kojabf
					";
//			AND C.ID_KOJABF='".$requestData['id_kojabf']."'
			// echo $sql;
			$query = $this->db->query($sql);
			$totalData = $query->num_rows();
			$totalFiltered = $totalData;

			$dataaa=array();
			$no=1;
			foreach ($query->result() as $row)
			{
				// var_dump($row);exit;
				$sebelumya=$row->URUTAN-1;
				$q="SELECT NO_SURAT,
						TO_CHAR (
							TGL_SURAT,
							'DD-MM-YYYY'
						) TGL_SURAT
					FROM PERS_TRACKING
					WHERE ID_TRX_HDR = ".$row->ID_TRX_HDR."
					AND URUTAN = ".$sebelumya;
//				echo $q;
				$srt = $this->db->query($q)->row();
				$tgl_surat="";
				$no_surat="";
				if ($srt){
					$tgl_surat=$srt->NO_SURAT;
					$no_surat=$srt->TGL_SURAT;
				}

				// var_dump($tgl);exit;
				$nestedData= array();
				$nestedData[] = $no;
				$nestedData[] = $row->KET_JENIS_PERMOHONAN;
				$nestedData[] = $row->NAJABL;
				$nestedData[] = $row->NO_SURAT_PERMOHONAN;
				$nestedData[] = $row->TGL_SURAT_PERMOHONAN;
				$nestedData[] = $no_surat;
				$nestedData[] = $tgl_surat;

				if($row->KETERANGAN !="" && $row->NO_SK ==""){
					$nestedData[] = '
					<button type="button" class="btn btn-info btn-xs" onclick="lihatStatus('.$row->ID_TRX_HDR.',\''.$row->NO_SURAT_PERMOHONAN.'\')">Alur Proses</button>&nbsp;
					<button type="button" class="btn btn-primary btn-xs" onclick="setT2('.$row->ID_TRX_HDR.',\''.$row->NO_SURAT_PERMOHONAN.'\')">Pegawai</button>
					<button type="button" class="btn btn-warning btn-xs" onclick="show_pesan('.$row->ID_TRACKING.')">Lihat Pesan</button>
					';
				}elseif($row->NO_SK !=""){
					$nestedData[] = '
					<button type="button" class="btn btn-info btn-xs" onclick="lihatStatus('.$row->ID_TRX_HDR.',\''.$row->NO_SURAT_PERMOHONAN.'\')">Alur Proses</button>&nbsp;
					<button type="button" class="btn btn-primary btn-xs" onclick="setT2('.$row->ID_TRX_HDR.',\''.$row->NO_SURAT_PERMOHONAN.'\')">Pegawai</button>
					';
				}else{
					$nestedData[] = '
					<button type="button" class="btn btn-info btn-xs" onclick="lihatStatus('.$row->ID_TRX_HDR.',\''.$row->NO_SURAT_PERMOHONAN.'\')">Alur Proses</button>&nbsp;
					<button type="button" class="btn btn-primary btn-xs" onclick="setT2('.$row->ID_TRX_HDR.',\''.$row->NO_SURAT_PERMOHONAN.'\')">Pegawai</button>
					';
				}
				
//				$nestedData[] = '<button type="button" class="btn btn-primary btn-xs" onclick="setT2('.$row->ID_TRX_HDR.',\''.$no_surat.'\')">Detil</button>
//				<button type="button" class="btn btn-primary btn-xs" onclick="lihatStatus('.$row->ID_TRX_HDR.',\''.$no_surat.'\')">Alur</button>';

				$nestedData[] = ($row->NO_SK == '')?'
				<button type="button" class="btn btn-success btn-xs" onclick="formSK('.$row->ID_TRACKING.',\''.$row->NO_SK.'\',\''.$row->TGL_SK.'\',\''.$row->KREDIT.'\')">Buat</button>':'
				<button type="button" class="btn btn-warning btn-xs" onclick="formSK('.$row->ID_TRACKING.',\''.$row->NO_SK.'\',\''.$row->TGL_SK.'\',\''.$row->KREDIT.'\')">Edit</button>';

				$nestedData[] = ($row->NO_SK != '')?'
				<button type="button" class="btn btn-primary btn-xs" onclick="setujuAkhir('.$row->ID_TRX_HDR.','.$row->ID_TRACKING.','.$row->ID_KOJABF.')">Setuju</button>
				':'<button type="button" class="btn btn-danger btn-xs" onclick="tolakHdr('.$row->ID_TRX_HDR.','.$row->ID_TRACKING.')">Tolak</button>';
				//<button type="button" class="btn btn-info btn-xs" onclick="formSOP('.$row->ID_TRX_HDR.','.$row->ID_SOP.')">SOP</button>

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

		public function dataTrxDtl($ak){
			// var_dump(is_bool($ak));exit;
			$requestData = $this->input->post();
			$id_trx_hdr = ($requestData['id_trx_hdr']>0)?$requestData['id_trx_hdr']:0;

			$sql = "SELECT
						DISTINCT A.ID_TRX_HDR,
						A.ID_TRX_DETAIL,
						A.ID_TRX,
						B.NO_SURAT_PERMOHONAN,
						C.NRK,
						D.NAMA,
						K.NAJABL,
						T.TGL_TOLAK,
						T.KETERANGAN AS KET_TOLAK,
						U.ANGKA_KREDIT
					FROM
						PERS_TRX_DTL A
					LEFT JOIN PERS_TRX_HDR B ON
						B . ID_TRX_HDR = A.ID_TRX_HDR
					LEFT JOIN PERS_TRX_AJU C ON
						A . ID_TRX = C.ID_TRX
					LEFT JOIN PERS_TRX_TOLAK T ON
						T . ID_TRX = C.ID_TRX
					LEFT JOIN PERS_PEGAWAI1 D ON
						D.NRK = C.NRK
					LEFT JOIN PERS_KOJABF_TBL K ON
						K.KOJAB = D.KOJAB
					LEFT JOIN ANGKA_KREDIT_SOP U ON
						U.ID_TRX = A.ID_TRX
					WHERE
						C.STATUS_APPROVAL = 1
						AND C.STATUS_BERJALAN = 2
						AND A.ID_TRX_HDR = $id_trx_hdr";
//			echo $sql;
			$query = $this->db->query($sql);
			$totalData = $query->num_rows();
			$totalFiltered = $totalData;

			$dataaa=array();
			$no=1;
			foreach ($query->result() as $row)
			{
				$q="SELECT GOL
					FROM PERS_PANGKAT_TBL_NOW
					WHERE KOPANG = (SELECT KOPANG FROM (
						SELECT KOPANG
						FROM PERS_JABATANF_HIST
						WHERE NRK='".$row->NRK."'
						ORDER BY TMT DESC
					) WHERE ROWNUM=1)";
//				echo $q;
				$gol = $this->db->query($q)->row();

				$nestedData= array();
				$nestedData[] = $no;
				$nestedData[] = $row->NRK;
				$nestedData[] = $row->NAMA;
//				$nestedData[] = ($gol)?$gol->GOL:'';
//				$nestedData[] = $row->NAJABL;
				$nestedData[] = '<button class="btn btn-primary btn-xs" data-toggle="modal" data-target="#myModal" id="test_btn" onclick="cekFile('.$row->ID_TRX_DETAIL.','.$row->NRK.',\''.$row->NAMA.'\','.$row->ID_TRX.');"> Cek file </button>';
				(is_bool($ak)?
					($nestedData[] = '<button class="btn btn-warning btn-xs" onClick="angka_kredit($(this).attr(\'id\'),'.$row->NRK.',\''.$row->NAMA.'\','.$row->ID_TRX.')" data-toggle="modal" data-target="#ak_modal" id="angka_kredit_'.$no++.'">Edit Angka Kredit</button>')
				:
				($nestedData[] = ($row->TGL_TOLAK == "")?'<button type="button" class="btn btn-danger btn-xs" onclick="tolakDtl('.$row->ID_TRX.')">Tolak</button>':'<span class="text-danger">Ditolak. '.$row->KET_TOLAK.'</span>'));

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

		public function dataTrxDtl2($id_trx_hdr){
			$sql = "SELECT DISTINCT
						A.ID_TRX_HDR,
						A.ID_TRX_DETAIL,
						A.ID_TRX,
						B.NO_SURAT_PERMOHONAN,
						C.NRK,
						D.NAMA,
						K.NAJABL,
						T.TGL_TOLAK,
						T.KETERANGAN AS KET_TOLAK
					FROM
						PERS_TRX_DTL A
					LEFT JOIN PERS_TRX_HDR B ON B .ID_TRX_HDR = A.ID_TRX_HDR
					LEFT JOIN PERS_TRX_AJU C ON A .ID_TRX = C.ID_TRX
					LEFT JOIN PERS_TRX_TOLAK T ON T .ID_TRX = C.ID_TRX
					LEFT JOIN PERS_PEGAWAI1 D ON D.NRK = C.NRK
					LEFT JOIN PERS_MASTER_KOJABF K ON K.KOJAB = D.KOJAB
					WHERE C.STATUS_APPROVAL=1
					AND	C.STATUS_BERJALAN=2
					AND A.ID_TRX_HDR=$id_trx_hdr";
			//var_dump($sql);exit;
			$rs = $this->db->query($sql)->result();
			return $rs;
		}

		public function getDitetapkan($data, $by_id = null){
			// var_dump($data);exit;
			if(!is_null($by_id)){
				$sql = "SELECT * FROM MASTER_DITETAPKAN_SOP WHERE SOP = {$data}";
			}else{
				$sql = "SELECT B.* FROM PERS_TRX_HDR A LEFT JOIN MASTER_DITETAPKAN_SOP B ON A.ID_SOP = B.SOP WHERE A.ID_TRX_HDR = {$data}";
			}
			// var_dump($sql);exit;
			return $this->db->query($sql)->row();
		}

		public function get_jenis_permohonan(){
			$sql = "SELECT * FROM PERS_JENIS_PERMOHONAN";
			$query = $this->db->query($sql);
			return $query;
		}

		public function get_kojabf(){
			$sql = "SELECT A.KOJAB, B. NAJABL
					FROM PERS_MASTER_KOJABF A
					LEFT JOIN PERS_KOJABF_TBL B ON A.KOJAB=B.KOJAB";
			$query = $this->db->query($sql);
			return $query;
		}

		public function dataSOP(){
			$sql = "SELECT *
					FROM MASTER_SOP";
			$query = $this->db->query($sql);
			return $query;
		}

		public function dataDtlSOP($id_trx_hdr){
			$sql = "SELECT ID,URUTAN,PELAKSANA,KET_USER_PRIORITY
					FROM PERS_TRX_HDR A
					LEFT JOIN MASTER_DETAIL_SOP B ON A.ID_SOP=B.ID_SOP
					LEFT JOIN MASTER_USER_PRIORITY C ON C.ID_USER_PRIORITY=B.PELAKSANA
					WHERE ID_TRX_HDR=$id_trx_hdr
					ORDER BY URUTAN";
			$query = $this->db->query($sql);
			return $query;
		}

		public function dataTracking($id_trx_hdr){
			$sql = "SELECT URUTAN,
						TO_CHAR (
							TGL_SURAT,
							'DD-MM-YYYY'
						) TGL_SURAT
					FROM PERS_TRACKING
					WHERE ID_TRX_HDR=$id_trx_hdr
					ORDER BY URUTAN";
			$query = $this->db->query($sql);
			return $query;
		}

		public function dataTracking1($id_trx_hdr,$urutan){
			$sql = "SELECT URUTAN,
						TO_CHAR (
							TGL_SURAT,
							'DD-MM-YYYY'
						) TGL_SURAT
					FROM PERS_TRACKING
					WHERE ID_TRX_HDR = $id_trx_hdr
					AND URUTAN = $urutan
					ORDER BY URUTAN";
			$r = $this->db->query($sql)->row();
			return $r;
		}

		public function dataLastTracking($id_trx_hdr){
			$sql = "SELECT MAX(URUTAN) AS URUTAN
					FROM PERS_TRACKING
					WHERE ID_TRX_HDR=$id_trx_hdr
					ORDER BY URUTAN";
			$rs = $this->db->query($sql)->row();
			return $rs->URUTAN;
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
		
		public function get_persyaratan_modelOld(){
			$where = $this->input->post();
			
			$nrk_post = $where['NRK'];
			$ref_prm = $where['ID_PERMOHONAN'];
			$jns_prm = $where['ID_JENIS'];
			$id_trx = $where['ID_TRX_TU'];
			
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
					LEFT JOIN PERS_SYARAT_PERMOHONAN C ON B.ID_PERMOHONAN = C.ID_PERMOHONAN
					AND B.ID_JENIS_PERMOHONAN = C.ID_JENIS_PERMOHONAN
					AND A .ID_SYARAT = C.ID_SYARAT
					WHERE
						B.NRK = '".$nrk_post."'
					AND B.ID_PERMOHONAN = ".$ref_prm."
					AND B.ID_JENIS_PERMOHONAN = ".$jns_prm."
					AND F.ID_TRX_TU = ".$id_trx."
					ORDER BY
						C.ID_SYARAT";
			
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

		public function get_persyaratan_model(){
			$where = $this->input->post();
			$id_trx = $where['id_trx'];

			$sql = "SELECT
						A .FILE_SYARAT,
						B.NRK,
						B.TGL_PERMOHONAN,
						B.ID_PERMOHONAN,
						B.ID_JENIS_PERMOHONAN,
						C.KET_SYARAT,
						A.ID_SYARAT
					FROM
						PERS_DTL_TRX_AJU A
					LEFT JOIN PERS_TRX_AJU B ON A .ID_TRX = B.ID_TRX
					LEFT JOIN PERS_SYARAT_DTL C ON C.ID_SYARAT_DTL = A.ID_SYARAT
					WHERE A.ID_TRX = ".$id_trx."
					ORDER BY
						A.ID_SYARAT";

//			echo $sql;
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

		public function get_persyaratan_model_k(){
			$where = $this->input->post();
			$id_trx = $where['id_trx'];

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
					LEFT JOIN PERS_SYARAT_PERMOHONAN C ON B.ID_PERMOHONAN = C.ID_PERMOHONAN
					AND B.ID_JENIS_PERMOHONAN = C.ID_JENIS_PERMOHONAN
					AND A .ID_SYARAT = C.ID_SYARAT
					WHERE A.ID_TRX = ".$id_trx."
					ORDER BY
						C.ID_SYARAT";

//			echo $sql;
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
						F.ID_TRX,
						G.ID_TRX_SKPD,
						H.ID_TRX_TU
					FROM
						PERS_PEGAWAI1 A
					LEFT JOIN PERS_PEGAWAI2 B ON A .NRK = B.NRK
					LEFT JOIN LOKASI C ON B.KOWIL = C.KODE
		            LEFT JOIN LOKASI D ON B.KOCAM = D.KODE
		            LEFT JOIN LOKASI E ON B.KOKEL = E.KODE
					LEFT JOIN PERS_TRX_AJU F ON A .NRK = F.NRK
					LEFT JOIN PERS_TRX_SKPD G ON F.ID_TRX = G.ID_TRX
					LEFT JOIN PERS_TRX_TUBKD H ON G.ID_TRX_SKPD = H.ID_TRX_SKPD
					WHERE
						A .NRK = '".$prm."'
						AND F.STATUS_APPROVAL = 1
						AND G.STATUS_APPROVAL_TU = 1
						AND H.STATUS_APPROVAL_SB = 2";
			
			$query1 = $this->db->query($sql2);
			
			foreach ($query1->result() as $res) {
			
				$arrayName = array('id_trx_tu' => $res->ID_TRX_TU, 'nrk' => $res->NRK, 'nama' => $res->NAMA);
			}
			
			$result = json_encode($arrayName);
	        return $result;
		}

		public function insert_data($data){
			
			$count = $data['id_trx_tu'];
			$no_surat = $data['no_surat_tu'];
			$tgl_surat = $data['tgl_surat'];
			$ref_prm = $data['ref_prm'];
			$jns_prm = $data['jns_prm'];
			$status_approval = 2;
			
			$sql = array();
			$upd = array();
			for ($i=0; $i < count($count); $i++) { 
				$upd[$i] = "UPDATE PERS_TRX_TUBKD SET STATUS_APPROVAL_SB = 1 WHERE ID_TRX_TU = ".$data['id_trx_tu'][$i]."";
				$exupd[$i] = $this->db->query($upd[$i]);

				$date = date('Y-m-d H:i:s', time());
				$sql[$i] = "INSERT INTO PERS_TRX_SUBBID
						  VALUES
						  (
							(
								SELECT COUNT (*) + 1 FROM PERS_TRX_SUBBID
							),
							TO_CHAR (TO_DATE ('".$tgl_surat."','DD-MM-YYYY')
							),
							'".$no_surat."',
							".$status_approval.",
							".$data['id_trx_tu'][$i].",
							".$ref_prm.",
							".$jns_prm."
						  )";
				$exsql[$i] = $this->db->query($sql[$i]);
			}
			return count($count);	
		}

		public function update_data($data){
			$count = $data['id_trx_tu'];
			
			$upd = array();
			for ($i=0; $i < count($count); $i++) { 
				
				$upd[$i] = "UPDATE PERS_TRX_TUBKD SET STATUS_APPROVAL_SB = 3 WHERE ID_TRX_TU = ".$data['id_trx_tu'][$i]."";
				$exupd[$i] = $this->db->query($upd[$i]);

			}
			return count($count);	
		}

		public function get_list_permohonan_baru_(){
			$sql = "SELECT A.NRK, TO_CHAR(A.TGL_PERMOHONAN, 'DD-MM-YYYY HH24:MI:SS') TGL_PERMOHONAN, A.ID_JENIS_PERMOHONAN, B.NAMA FROM PERS_TRX_AJU A LEFT JOIN PERS_PEGAWAI1 B ON A.NRK = B.NRK ORDER BY A.TGL_PERMOHONAN DESC";
			$res = $this->db->query($sql);
			$no = 1;
			$table = '';
			foreach ($res->result() as $value) {
				var_dump($value);exit;
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

		public function newIdTolak(){
			$q = "SELECT MAX(ID_TRX_TOLAK) AS NID
				  FROM PERS_TRX_TOLAK";
			$rs = $this->db->query($q)->row();

			// return the result in json
			return $rs->NID+1;
		}

		public function newIdTracking(){
			$q = "SELECT MAX(ID_TRACKING) AS NID
				  FROM PERS_TRACKING";
			$rs = $this->db->query($q)->row();

			// return the result in json
			return $rs->NID+1;
		}

		public function dataLastTrack($id_hdr){
			$q = "SELECT MAX(ID_TRACKING) AS ID
				  FROM PERS_TRACKING
				  WHERE ID_TRX_HDR=$id_hdr
				  ";
			$rs = $this->db->query($q)->row();

			// return the result in json
			return $rs->ID;
		}


		public function dataLastKojabF($nrk){
			$sql = "SELECT
						A.*,
						C.ANGKA_KREDIT
					FROM
						\"vw_jabatan_terakhir\" A
					LEFT JOIN PERS_TRX_AJU B ON
					A.NRK = B.NRK
					LEFT JOIN ANGKA_KREDIT_SOP C ON
					B.ID_TRX = C.ID_TRX  
					WHERE
						A.NRK = '{$nrk}'
					ORDER BY
						TMT DESC";
			/*$qjabf="SELECT *
                    FROM \"vw_jabatan_terakhir\"
                    WHERE NRK='$nrk'
                    ORDER BY TMT DESC";*/
			$rs = $this->db->query($sql)->row();

			if ($rs){
				return $rs;
			} else {
				return "";
			}

		}

		public function dataSK($id_tracking){
			$q = "SELECT
						A.NO_SURAT,
						TO_CHAR( A.TGL_SURAT, 'DD-MM-YYYY' ) AS TGL_SURAT,
						B.ID_TRX_HDR
					FROM
						PERS_TRACKING A
					LEFT JOIN PERS_TRX_HDR B ON
						A.ID_TRX_HDR = B.ID_TRX_HDR
					WHERE
						ID_TRACKING = {$id_tracking}";
			$rs = $this->db->query($q)->row();

			if ($rs){
				return $rs;
			} else {
				return "";
			}

		}

		public function countPegawai($id_trx_hdr){
			$query = "SELECT COUNT(ID_TRX) AS JML FROM PERS_TRX_DTL";
			$this->db->query($query)->row();
		}

		public function tambah($tbl,$data)
		{
			$x = array_keys($data);
			$y = implode(',', $x);
			$z = "'".implode("','", $data)."'";
			$q = "INSERT INTO $tbl ( $y ) VALUES ( $z )";
			$q = str_replace("'SYSDATE'","SYSDATE",$q);
//			echo $q;
			$this->db->query($q);

			return $this->db->affected_rows();
		}

		public function tambahKojabf($tbl,$data,$tgl_sk)
		{
			//ga kepake
				list($day, $month, $year) = explode('-', $tgl_sk);		
				$tgl_sk = $year."-".str_pad($month, 2, "0", STR_PAD_LEFT)."-".str_pad($day, 2, "0", STR_PAD_LEFT);

			$x = array_keys($data);
			$y = implode(',', $x);
			$z = "'".implode("','", $data)."'";
			$q = "INSERT INTO $tbl ( $y ) VALUES ( $z )";
			$q = str_replace("'SYSDATE'","TO_CHAR(TO_DATE(SYSDATE,'DD-MM-YYYY'))",$q);
			$q = str_replace("'SYSDATE_TG_UPD'","SYSDATE",$q);
			$q = str_replace("'tgl_sk'","TO_DATE('$tgl_sk', 'YYYY-MM-DD')",$q);
			$q = str_replace("'0'","0",$q);
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
//        	echo $q;
			$this->db->query($q);

			return $this->db->affected_rows();
		}

		public function ubahPerbal($tbl,$data,$pk,$tgl_perbal)
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
			$q = str_replace("'tgl_perbal'","TO_DATE('$tgl_perbal', 'DD-MM-YYYY')",$q);
//        echo $q;
			$this->db->query($q);

			return $this->db->affected_rows();
		}

		public function tambahPerbal($tbl,$data,$tgl_perbal,$dimajukan)
		{
			$x = array_keys($data);
			$y = implode(',', $x);
			$z = "'".implode("','", $data)."'";
			$q = "INSERT INTO $tbl ( $y ) VALUES ( $z )";
			$q = str_replace("'tgl_perbal'","TO_DATE('$tgl_perbal', 'DD-MM-YYYY')",$q);
			$q = str_replace("'dimajukan'","TO_DATE('$dimajukan', 'DD-MM-YYYY')",$q);
//			echo $q;
			$this->db->query($q);

			return $this->db->affected_rows();
		}

		public function dataTrackingPerbal($id_trx_hdr){
			$q="SELECT * FROM PERS_TRACKING_PERBAL WHERE ID_TRX_HDR=$id_trx_hdr";
			$rs=$this->db->query($q)->row();

			return $rs;
		}

		public function getPemarafSOP($id_pemaraf){
			$query = "SELECT NAMA_PEMARAF FROM MASTER_PEMARAF_SOP WHERE ID_PEMARAF IN({$id_pemaraf})";
			return $this->db->query($query)->result();
		}

		public function getTembusanSOP($id_tembusan){
			$arr = implode(',', $id_tembusan);
			if(!empty($arr)){
				$query = "SELECT NALOK FROM PERS_KLOGAD3_NEW WHERE KOLOK IN({$arr})";
				// var_dump($query);exit;
				return $this->db->query($query)->result();
			}else{
				return NULL;
			}
		}

		public function ubahSK($tbl,$data,$pk,$tgl_surat)
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
			$q = str_replace("'tgl_surat'","TO_DATE('$tgl_surat', 'DD-MM-YYYY')",$q);
//        echo $q;
			$this->db->query($q);

			return $this->db->affected_rows();
		}

		public function hapus($tbl,$pk){
			$this->db->delete($tbl, $pk);

			return $this->db->affected_rows();
		}

		public function get_pesanNotifikasi($id_tracking)
		{
			$sql = "SELECT KETERANGAN
					FROM PERS_TRACKING
					WHERE ID_TRACKING = '".$id_tracking."'
			";
			return $this->db->query($sql)->row();
		}

		public function count_permohonan($id_trx_hdr)
		{
			$sql ="SELECT
						COUNT( A.NRK ) AS JUMLAH
					FROM
						PERS_TRX_AJU A
					LEFT JOIN PERS_TRX_DTL B ON
						A.ID_TRX = B.ID_TRX
					LEFT JOIN PERS_TRX_HDR C ON
						B.ID_TRX_HDR = C.ID_TRX_HDR
					WHERE
						C.ID_TRX_HDR = {$id_trx_hdr}";
            return $this->db->query($sql)->row();
		}

		public function getIdJenisPermohonan($id_trx_hdr)
		{
			$sql ="SELECT
                        D.ID_JENIS_PERMOHONAN,
                        D.KET_JENIS_PERMOHONAN
                    FROM
                        PERS_TRX_DTL A
                    LEFT JOIN PERS_TRX_HDR B ON
                        A.ID_TRX_HDR = B.ID_TRX_HDR
                    LEFT JOIN PERS_TRX_AJU C ON
                        A.ID_TRX = C.ID_TRX
                    LEFT JOIN PERS_JENIS_PERMOHONAN D ON
                        C.ID_JENIS_PERMOHONAN = D.ID_JENIS_PERMOHONAN
                    WHERE A.ID_TRX_HDR = {$id_trx_hdr}";
            // var_dump($sql);exit;
            return $this->db->query($sql)->row();
		}

		public function getDasarHukum($nrk){
			if(!is_null($nrk)){
				$sql = "SELECT
						A.ID_JENIS_PERMOHONAN,
						B.DASAR_HUKUM
					FROM
						PERS_TRX_AJU A
					LEFT JOIN PERS_SYARAT_HDR B ON
						A.ID_KOJABF = B.ID_KOJABF
						AND A.ID_JENIS_PERMOHONAN = B.ID_JENIS_PERMOHONAN
					WHERE
						A.NRK = '{$nrk}'";
				// var_dump($sql);exit;
				return $this->db->query($sql)->row();
			}
		}

		public function getIsiPerbal($id_trx_hdr, $no_urutan = NULL)
		{
			if(!$no_urutan){
				$sql ="SELECT
							D.KOLOK,
							D.NRK,
							D.NIP18,
							D.NAMA,
							C.ID_TRX,
							E.GOL,
							F.NAPANG,
							G.NAJABL,
							H.NM_TINGKAT,
							I.TEMBUSAN
						FROM
							PERS_TRX_DTL A
						LEFT JOIN PERS_TRX_HDR B ON
							A.ID_TRX_HDR = B.ID_TRX_HDR
						LEFT JOIN PERS_TRX_AJU C ON
							A.ID_TRX = C.ID_TRX
						LEFT JOIN PERS_PEGAWAI1 D ON
							C.NRK = D.NRK
						LEFT JOIN VW_PANGKAT_TERAKHIR E ON
							C.NRK = E.NRK
						LEFT JOIN PERS_PANGKAT_TBL_NOW F ON
							E.KOPANG = F.KOPANG
						LEFT JOIN PERS_MASTER_KOJABF G ON
							C.ID_KOJABF = G.KOJAB
							AND E.KOPANG = G.GOLRU
						LEFT JOIN PERS_MASTER_TINGKAT H ON
							G.TINGKAT = H.ID_TINGKAT
						LEFT JOIN PERS_TRACKING_PERBAL I ON
							A.ID_TRX_HDR = I.ID_TRX_HDR
						WHERE
							A.ID_TRX_HDR = {$id_trx_hdr}";	
			}else{
				$sql = "SELECT * FROM (
											SELECT
												DISTINCT D.NRK,
												D.NIP18,
												D.NAMA,
												C.ID_TRX,
												C.TGL_PERMOHONAN,
												D.KOLOK,
												E.GOL,
												F.NAPANG,
												G.NAJABL,
												H.NM_TINGKAT,
												I.TEMBUSAN,
												J.NO_SURAT,
												J.KREDIT
											FROM
												PERS_TRX_DTL A
											LEFT JOIN PERS_TRX_HDR B ON
												A.ID_TRX_HDR = B.ID_TRX_HDR
											LEFT JOIN PERS_TRX_AJU C ON
												A.ID_TRX = C.ID_TRX
											LEFT JOIN PERS_PEGAWAI1 D ON
												C.NRK = D.NRK
											LEFT JOIN VW_PANGKAT_TERAKHIR E ON
												C.NRK = E.NRK
											LEFT JOIN PERS_PANGKAT_TBL_NOW F ON
												E.KOPANG = F.KOPANG
											LEFT JOIN PERS_MASTER_KOJABF G ON
												C.ID_KOJABF = G.KOJAB
												-- AND E.KOPANG = G.GOLRU
											LEFT JOIN PERS_MASTER_TINGKAT H ON
												G.TINGKAT = H.ID_TINGKAT
											LEFT JOIN PERS_TRACKING_PERBAL I ON
												A.ID_TRX_HDR = I.ID_TRX_HDR
											LEFT JOIN PERS_TRACKING J ON
												A.ID_TRX_HDR = J.ID_TRX_HDR
											WHERE
												A.ID_TRX_HDR = {$id_trx_hdr}
												AND J.URUTAN = {$no_urutan}
												ORDER BY C.ID_TRX ASC
											) WHERE ROWNUM = 1";
			}
			// var_dump($sql);exit;
			// $count = $this->db->query("SELECT
			// 			COUNT( A.NRK ) AS JMLH
			// 		FROM
			// 			PERS_TRX_AJU A
			// 		LEFT JOIN PERS_TRX_DTL B ON
			// 			A.ID_TRX = B.ID_TRX
			// 		WHERE
			// 			B.ID_TRX_HDR = {$id_trx_hdr}")->row();
			return $this->db->query($sql)->row();
			// if($count->JMLH == 1){
			// 	return $this->db->query($sql)->row();
			// }else{
			// 	return $this->db->query($sql)->result();
			// }
		}

		public function getDetailSK($id_trx_hdr, $tipe = null)
		{
			$getTmpData = $this->db->query("SELECT
								DISTINCT A.ID_JENIS_PERMOHONAN, D.KD
							FROM
								PERS_TRX_AJU A
							LEFT JOIN PERS_TRX_DTL B ON
								A.ID_TRX = B.ID_TRX
							LEFT JOIN PERS_TRX_HDR C ON
								B.ID_TRX_HDR = C.ID_TRX_HDR
							LEFT JOIN PERS_PEGAWAI1 D ON
								A.NRK = D.NRK
							WHERE C.ID_TRX_HDR = '{$id_trx_hdr}'")->row();
			// var_dump($getTmpData);exit;
			if($getTmpData->KD == "S"){
				$sql = "SELECT
							C.NRK,
							E.KOPANG,
							E.NAPANG,
							G.KOLOK,
							G.KOJAB,
							H.NAJABL AS JABATAN_LAMA,
							J.NASEK,
							J.KODIK,
							K.GOL,
							K.NAPANG,
							L.NADIK,
							M.NAJABL,
							N.ANGKA_KREDIT,
							O.NAMA,
							O.NIP18,
							TO_CHAR(O.TALHIR, 'DD-MM-YYYY') TALHIR
						FROM
							PERS_TRX_HDR A
						LEFT JOIN PERS_TRX_DTL B ON
							A.ID_TRX_HDR = B.ID_TRX_HDR
						LEFT JOIN PERS_TRX_AJU C ON
							B.ID_TRX = C.ID_TRX
						LEFT JOIN (
							SELECT
								MAX( C.TMT ) AS TMT, MAX( C.KOLOK ) AS KOLOK, C.NRK
							FROM
								PERS_TRX_DTL A
							LEFT JOIN PERS_TRX_AJU B ON
								A.ID_TRX = B.ID_TRX
							LEFT JOIN PERS_PANGKAT_HIST C ON 
								B.NRK = C.NRK
							GROUP BY C.NRK
						) D ON
							C.NRK = D.NRK
						INNER JOIN (
							SELECT
								A.TMT,
								A.NRK,
								A.KOPANG,
								B.NAPANG
							FROM
								PERS_PANGKAT_HIST A
							INNER JOIN PERS_PANGKAT_TBL_NOW B ON
								A.KOPANG = B.KOPANG
							LEFT JOIN PERS_TRX_AJU C ON
								A.NRK = C.NRK
						) E ON
							D.TMT = E.TMT AND D.NRK = E.NRK
						INNER JOIN (
							SELECT
								MAX( C.TMT ) AS TMT, C.NRK
							FROM
								PERS_TRX_DTL A
							LEFT JOIN PERS_TRX_AJU B ON
								A.ID_TRX = B.ID_TRX
							LEFT JOIN PERS_JABATAN_HIST C ON 
								B.NRK = C.NRK
							GROUP BY C.NRK
						) F ON
							C.NRK = F.NRK
						LEFT JOIN (
							SELECT
								KOLOK, KOJAB, TMT, NRK
							FROM PERS_JABATAN_HIST 
						) G ON
							C.NRK = G.NRK AND F.TMT = G.TMT
						LEFT JOIN PERS_KOJAB_TBL H ON
							G.KOLOK = H.KOLOK AND G.KOJAB = H.KOJAB
						LEFT JOIN (
							SELECT
								MAX( TGIJAZAH ) AS TGIJAZAH, NRK
							FROM
								PERS_PENDIDIKAN
							GROUP BY
								NRK	
						) I ON
							C.NRK = I.NRK
						LEFT JOIN PERS_PENDIDIKAN J ON
							I.TGIJAZAH = J.TGIJAZAH AND C.NRK = J.NRK
						LEFT JOIN PERS_PANGKAT_TBL_NOW K ON
							E.KOPANG = K.KOPANG
						LEFT JOIN PERS_PDIDIKAN_TBL L ON
							J.KODIK = L.KODIK AND J.JENDIK = L.JENDIK
						LEFT JOIN PERS_MASTER_KOJABF M ON
							C.ID_KOJABF = M.KOJAB AND K.KOPANG = M.GOLRU
						LEFT JOIN ANGKA_KREDIT_SOP N ON
							C.ID_TRX = N.ID_TRX
						LEFT JOIN PERS_PEGAWAI1 O ON
							C.NRK = O.NRK
						WHERE A.ID_TRX_HDR = '{$id_trx_hdr}'";
			}else{
				$sql = "SELECT
							C.NRK,
							E.KOPANG,
							E.NAPANG,
							G.KOLOK,
							G.KOJAB,
							H.NAJABL AS JABATAN_LAMA,
							J.NASEK,
							J.KODIK,
							K.GOL,
							K.NAPANG,
							L.NADIK,
							M.NAJABL,
							N.ANGKA_KREDIT,
							O.NAMA,
							O.NIP18,
							TO_CHAR( O.TALHIR, 'DD-MM-YYYY' ) TALHIR
						FROM
							PERS_TRX_HDR A
						LEFT JOIN PERS_TRX_DTL B ON
							A.ID_TRX_HDR = B.ID_TRX_HDR
						LEFT JOIN PERS_TRX_AJU C ON
							B.ID_TRX = C.ID_TRX
						LEFT JOIN(
								SELECT
									MAX( C.TMT ) AS TMT,
									MAX( C.KOLOK ) AS KOLOK,
									C.NRK
								FROM
									PERS_TRX_DTL A
								LEFT JOIN PERS_TRX_AJU B ON
									A.ID_TRX = B.ID_TRX
								LEFT JOIN PERS_PANGKAT_HIST C ON
									B.NRK = C.NRK
								GROUP BY
									C.NRK
							) D ON
							C.NRK = D.NRK
						INNER JOIN(
								SELECT
									A.TMT,
									A.NRK,
									A.KOPANG,
									B.NAPANG
								FROM
									PERS_PANGKAT_HIST A
								INNER JOIN PERS_PANGKAT_TBL_NOW B ON
									A.KOPANG = B.KOPANG
								LEFT JOIN PERS_TRX_AJU C ON
									A.NRK = C.NRK
							) E ON
							D.TMT = E.TMT
							AND D.NRK = E.NRK
						INNER JOIN(
								SELECT
									MAX( C.TMT ) AS TMT,
									C.NRK
								FROM
									PERS_TRX_DTL A
								LEFT JOIN PERS_TRX_AJU B ON
									A.ID_TRX = B.ID_TRX
								LEFT JOIN PERS_JABATANF_HIST C ON
									B.NRK = C.NRK
								GROUP BY
									C.NRK
							) F ON
							C.NRK = F.NRK
						LEFT JOIN(
								SELECT
									KOLOK,
									KOJAB,
									TMT,
									NRK
								FROM
									PERS_JABATANF_HIST
							) G ON
							C.NRK = G.NRK
							AND F.TMT = G.TMT
						LEFT JOIN PERS_KOJABF_TBL H ON
							G.KOJAB = H.KOJAB
						LEFT JOIN(
								SELECT
									MAX( TGIJAZAH ) AS TGIJAZAH,
									NRK
								FROM
									PERS_PENDIDIKAN
								GROUP BY
									NRK
							) I ON
							C.NRK = I.NRK
						LEFT JOIN PERS_PENDIDIKAN J ON
							I.TGIJAZAH = J.TGIJAZAH
							AND C.NRK = J.NRK
						LEFT JOIN PERS_PANGKAT_TBL_NOW K ON
							E.KOPANG = K.KOPANG
						LEFT JOIN PERS_PDIDIKAN_TBL L ON
							J.KODIK = L.KODIK
							AND J.JENDIK = L.JENDIK
						LEFT JOIN PERS_MASTER_KOJABF M ON
							C.ID_KOJABF = M.KOJAB
							AND K.KOPANG = M.GOLRU
						LEFT JOIN ANGKA_KREDIT_SOP N ON
							C.ID_TRX = N.ID_TRX
						LEFT JOIN PERS_PEGAWAI1 O ON
							C.NRK = O.NRK
						WHERE
							A.ID_TRX_HDR = '{$id_trx_hdr}'";
			}

			
			// var_dump($sql);exit;
			return $this->db->query($sql)->result();
		}

		public function getHeaderSK($id_trx_hdr)
		{
			$sql = "SELECT
						A.NO_SURAT,
						B.TEMBUSAN
					FROM
						PERS_TRACKING A
					LEFT JOIN PERS_TRACKING_PERBAL B ON
						A.ID_TRX_HDR = B.ID_TRX_HDR
					WHERE
						A.ID_TRX_HDR = 1
						AND A.URUTAN = 9";
			return $this->db->query($sql)->row();
		}

		public function count_data_perbal($id_trx_hdr)
		{
			$sql = "SELECT
							COUNT(*) AS JUMLAH
						FROM
							PERS_TRX_DTL A
						LEFT JOIN PERS_TRX_HDR B ON
							A.ID_TRX_HDR = B.ID_TRX_HDR
						LEFT JOIN PERS_TRX_AJU C ON
							A.ID_TRX = C.ID_TRX
						LEFT JOIN PERS_PEGAWAI1 D ON
							C.NRK = D.NRK
						LEFT JOIN VW_PANGKAT_TERAKHIR E ON
							C.NRK = E.NRK
						LEFT JOIN PERS_PANGKAT_TBL_NOW F ON
							E.KOPANG = F.KOPANG
						LEFT JOIN PERS_MASTER_KOJABF G ON
							C.ID_KOJABF = G.KOJAB
							AND E.KOPANG = G.GOLRU
						LEFT JOIN PERS_MASTER_TINGKAT H ON
							G.TINGKAT = H.ID_TINGKAT
						LEFT JOIN PERS_TRACKING_PERBAL I ON
							A.ID_TRX_HDR = I.ID_TRX_HDR
						WHERE
							A.ID_TRX_HDR = {$id_trx_hdr}
						AND
							C.STATUS_AKHIR IS NULL";
			// var_dump($sql);exit;
			return $this->db->query($sql)->row();
		}

		public function get_skpd_perbal($kolok)
		{
			
			// var_dump($_SESSION['logged_in']);exit;
			$sql = "SELECT
						A.NALOK,
						B.NAMA
					FROM
						PERS_KLOGAD3 A
					LEFT JOIN PERS_TABEL_SPMU B
						ON A.SPMU = B.KODE_SPM
					WHERE
						A.KOLOK = '{$kolok}'";
			// var_dump($sql);exit;
			return $this->db->query($sql)->row();
		}

		public function get_all_data_tolak(){
			$aoColumns = array(
	            0 => 'NRK',
	            1 => 'NAMA',
	            2 => 'TGL_PERMOHONAN',
	            3 => 'TGL_TOLAK',
	            4 => 'ALASAN',
	            5 => 'KET_PERMOHONAN',
	            6 => 'KET_JENIS_PERMOHONAN'
            );

            $q = "SELECT
                    COUNT(ID_TRX_TOLAK) AS jml
                FROM
                    PERS_TRX_TOLAK
                 WHERE URUTAN = 3
                ";

        	$rs = $this->db->query($q)->result();
        	$totalData = $rs[0]->JML;


			$requestData = $this->input->post();
			// var_dump($requestData);exit;
			$sql = "SELECT ROWNUM, X.* FROM
					(
						SELECT ROWNUM AS RN,NRK,NAMA,TGL_PERMOHONAN,TGL_TOLAK,KETERANGAN AS ALASAN,KET_JENIS_PERMOHONAN,KET_PERMOHONAN
						FROM
						(
							
							SELECT A.ID_TRX,B.NRK,E.NAMA,TO_CHAR(B.TGL_PERMOHONAN,'DD-MM-YYYY')TGL_PERMOHONAN,TO_CHAR(A.TGL_TOLAK,'DD-MM-YYYY')TGL_TOLAK,A.KETERANGAN,C.KET_PERMOHONAN,D.KET_JENIS_PERMOHONAN
							FROM PERS_TRX_TOLAK A
							LEFT JOIN PERS_TRX_AJU B ON A.ID_TRX = B.ID_TRX
							LEFT JOIN PERS_REF_PERMOHONAN C ON B.ID_PERMOHONAN = C.ID_PERMOHONAN
							LEFT JOIN PERS_JENIS_PERMOHONAN D ON B.ID_PERMOHONAN = D.ID_PERMOHONAN AND B.ID_JENIS_PERMOHONAN = D.ID_JENIS_PERMOHONAN
							LEFT JOIN PERS_PEGAWAI1 E ON B.NRK = E.NRK
							WHERE A.URUTAN = 3
						)PRM
					)X 
 
						";

			$sql.="WHERE 1=1";
			if( !empty($requestData['search']['value']) ) {   // if there is a search parameter, $requestData['search']['value'] contains search parameter
            $sql.=" AND ( X.NRK LIKE ('%".$requestData['search']['value']."%') ";    
            $sql.=" OR X.NAMA LIKE UPPER ('%".$requestData['search']['value']."%') ";
            $sql.=" OR X.KET_JENIS_PERMOHONAN LIKE UPPER ('%".$requestData['search']['value']."%') ";
            $sql.=" OR X.KET_PERMOHONAN LIKE UPPER ('%".$requestData['search']['value']."%') ";
            $sql.=" OR X.ALASAN LIKE UPPER('%".$requestData['search']['value']."%') )";
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
	            //$nestedData[] = "<span id='id_trx_tbl' style='display:none'>".$row->ID_TRX."</span> &nbsp;".$row->NRK;
	            $nestedData[] = $row->NRK;
	            $nestedData[] = $row->NAMA;
	            $nestedData[] = $row->TGL_PERMOHONAN;
	            $nestedData[] = $row->TGL_TOLAK;
	            $nestedData[] = $row->ALASAN;
	            $nestedData[] = $row->KET_PERMOHONAN;
	            $nestedData[] = $row->KET_JENIS_PERMOHONAN;
	            //$nestedData[] = "<a id='verifikasi' onClick='click_persyaratan(".$row->ID_TRX.");'>Lihat</a>";
	            //$nestedData['DT_RowId'] = "nomor_".$no;
	            
	            $dataaa[]=$nestedData;
	            $no++;
	        }
	        $json_data = array(
	           	/*"draw"            => intval( $requestData['draw'] ),*/
	           	"recordsTotal"    => intval( $totalData ),
            	"recordsFiltered" => $totalFiltered,
	            "data"            => $dataaa
	        );

			return json_encode($json_data);
		}

		public function get_all_data_tolak2(){
			$aoColumns = array(
	            0 => 'NRK',
	            1 => 'NAMA',
	            2 => 'TGL_PERMOHONAN',
	            3 => 'TGL_TOLAK',
	            4 => 'ALASAN',
	            5 => 'KET_PERMOHONAN',
	            6 => 'KET_JENIS_PERMOHONAN'
            );

            $q = "SELECT
                    COUNT(ID_TRX_TOLAK) AS jml
                FROM
                    PERS_TRX_TOLAK
                 WHERE URUTAN = 9
                ";

        	$rs = $this->db->query($q)->result();
        	$totalData = $rs[0]->JML;


			$requestData = $this->input->post();
			// var_dump($requestData);exit;
			$sql = "SELECT ROWNUM, X.* FROM
					(
						SELECT ROWNUM AS RN,NRK,NAMA,TGL_PERMOHONAN,TGL_TOLAK,KETERANGAN AS ALASAN,KET_JENIS_PERMOHONAN,KET_PERMOHONAN
						FROM
						(
							
							SELECT A.ID_TRX,B.NRK,E.NAMA,TO_CHAR(B.TGL_PERMOHONAN,'DD-MM-YYYY')TGL_PERMOHONAN,TO_CHAR(A.TGL_TOLAK,'DD-MM-YYYY')TGL_TOLAK,A.KETERANGAN,C.KET_PERMOHONAN,D.KET_JENIS_PERMOHONAN
							FROM PERS_TRX_TOLAK A
							LEFT JOIN PERS_TRX_AJU B ON A.ID_TRX = B.ID_TRX
							LEFT JOIN PERS_REF_PERMOHONAN C ON B.ID_PERMOHONAN = C.ID_PERMOHONAN
							LEFT JOIN PERS_JENIS_PERMOHONAN D ON B.ID_PERMOHONAN = D.ID_PERMOHONAN AND B.ID_JENIS_PERMOHONAN = D.ID_JENIS_PERMOHONAN
							LEFT JOIN PERS_PEGAWAI1 E ON B.NRK = E.NRK
							WHERE A.URUTAN = 9
						)PRM
					)X 
 
						";

			$sql.="WHERE 1=1";
			if( !empty($requestData['search']['value']) ) {   // if there is a search parameter, $requestData['search']['value'] contains search parameter
            $sql.=" AND ( X.NRK LIKE ('%".$requestData['search']['value']."%') ";    
            $sql.=" OR X.NAMA LIKE UPPER ('%".$requestData['search']['value']."%') ";
            $sql.=" OR X.KET_JENIS_PERMOHONAN LIKE UPPER ('%".$requestData['search']['value']."%') ";
            $sql.=" OR X.KET_PERMOHONAN LIKE UPPER ('%".$requestData['search']['value']."%') ";
            $sql.=" OR X.ALASAN LIKE UPPER('%".$requestData['search']['value']."%') )";
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
	            //$nestedData[] = "<span id='id_trx_tbl' style='display:none'>".$row->ID_TRX."</span> &nbsp;".$row->NRK;
	            $nestedData[] = $row->NRK;
	            $nestedData[] = $row->NAMA;
	            $nestedData[] = $row->TGL_PERMOHONAN;
	            $nestedData[] = $row->TGL_TOLAK;
	            $nestedData[] = $row->ALASAN;
	            $nestedData[] = $row->KET_PERMOHONAN;
	            $nestedData[] = $row->KET_JENIS_PERMOHONAN;
	            //$nestedData[] = "<a id='verifikasi' onClick='click_persyaratan(".$row->ID_TRX.");'>Lihat</a>";
	            //$nestedData['DT_RowId'] = "nomor_".$no;
	            
	            $dataaa[]=$nestedData;
	            $no++;
	        }
	        $json_data = array(
	           	/*"draw"            => intval( $requestData['draw'] ),*/
	           	"recordsTotal"    => intval( $totalData ),
            	"recordsFiltered" => $totalFiltered,
	            "data"            => $dataaa
	        );

			return json_encode($json_data);
		}

		public function get_all_data_tolak3(){
			$aoColumns = array(
	            0 => 'NRK',
	            1 => 'NAMA',
	            2 => 'TGL_PERMOHONAN',
	            3 => 'TGL_TOLAK',
	            4 => 'ALASAN',
	            5 => 'KET_PERMOHONAN',
	            6 => 'KET_JENIS_PERMOHONAN'
            );

            $q = "SELECT
                    COUNT(ID_TRX_TOLAK) AS jml
                FROM
                    PERS_TRX_TOLAK
                 WHERE URUTAN = 13
                ";

        	$rs = $this->db->query($q)->result();
        	$totalData = $rs[0]->JML;


			$requestData = $this->input->post();
			// var_dump($requestData);exit;
			$sql = "SELECT ROWNUM, X.* FROM
					(
						SELECT ROWNUM AS RN,NRK,NAMA,TGL_PERMOHONAN,TGL_TOLAK,KETERANGAN AS ALASAN,KET_JENIS_PERMOHONAN,KET_PERMOHONAN
						FROM
						(
							
							SELECT A.ID_TRX,B.NRK,E.NAMA,TO_CHAR(B.TGL_PERMOHONAN,'DD-MM-YYYY')TGL_PERMOHONAN,TO_CHAR(A.TGL_TOLAK,'DD-MM-YYYY')TGL_TOLAK,A.KETERANGAN,C.KET_PERMOHONAN,D.KET_JENIS_PERMOHONAN
							FROM PERS_TRX_TOLAK A
							LEFT JOIN PERS_TRX_AJU B ON A.ID_TRX = B.ID_TRX
							LEFT JOIN PERS_REF_PERMOHONAN C ON B.ID_PERMOHONAN = C.ID_PERMOHONAN
							LEFT JOIN PERS_JENIS_PERMOHONAN D ON B.ID_PERMOHONAN = D.ID_PERMOHONAN AND B.ID_JENIS_PERMOHONAN = D.ID_JENIS_PERMOHONAN
							LEFT JOIN PERS_PEGAWAI1 E ON B.NRK = E.NRK
							WHERE A.URUTAN = 13
						)PRM
					)X 
 
						";

			$sql.="WHERE 1=1";
			if( !empty($requestData['search']['value']) ) {   // if there is a search parameter, $requestData['search']['value'] contains search parameter
            $sql.=" AND ( X.NRK LIKE ('%".$requestData['search']['value']."%') ";    
            $sql.=" OR X.NAMA LIKE UPPER ('%".$requestData['search']['value']."%') ";
            $sql.=" OR X.KET_JENIS_PERMOHONAN LIKE UPPER ('%".$requestData['search']['value']."%') ";
            $sql.=" OR X.KET_PERMOHONAN LIKE UPPER ('%".$requestData['search']['value']."%') ";
            $sql.=" OR X.ALASAN LIKE UPPER('%".$requestData['search']['value']."%') )";
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
	            //$nestedData[] = "<span id='id_trx_tbl' style='display:none'>".$row->ID_TRX."</span> &nbsp;".$row->NRK;
	            $nestedData[] = $row->NRK;
	            $nestedData[] = $row->NAMA;
	            $nestedData[] = $row->TGL_PERMOHONAN;
	            $nestedData[] = $row->TGL_TOLAK;
	            $nestedData[] = $row->ALASAN;
	            $nestedData[] = $row->KET_PERMOHONAN;
	            $nestedData[] = $row->KET_JENIS_PERMOHONAN;
	            //$nestedData[] = "<a id='verifikasi' onClick='click_persyaratan(".$row->ID_TRX.");'>Lihat</a>";
	            //$nestedData['DT_RowId'] = "nomor_".$no;
	            
	            $dataaa[]=$nestedData;
	            $no++;
	        }
	        $json_data = array(
	           	/*"draw"            => intval( $requestData['draw'] ),*/
	           	"recordsTotal"    => intval( $totalData ),
            	"recordsFiltered" => $totalFiltered,
	            "data"            => $dataaa
	        );

			return json_encode($json_data);
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
				WHERE B.URUTAN = 3 AND B.STATUS = 1 ";

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
							WHERE B.URUTAN = 3 AND B.STATUS = 1 
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
				WHERE B.URUTAN = 9 AND B.STATUS = 1 ";

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
							WHERE B.URUTAN = 9 AND B.STATUS = 1 
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
	            2 => 'KET_PERMOHONAN',
	            3 => 'KET_JENIS_PERMOHONAN'
	            
            );

			$q = "SELECT COUNT( A.ID_TRX_HDR) JML FROM PERS_TRX_HDR A
				LEFT JOIN PERS_TRACKING B ON A.ID_TRX_HDR = B.ID_TRX_HDR
				WHERE B.URUTAN = 13 AND B.STATUS = 1 ";

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
							WHERE B.URUTAN = 13 AND B.STATUS = 1 
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
