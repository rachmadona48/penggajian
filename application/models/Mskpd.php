<?php
	
	class Mskpd extends CI_Model{
		public function get_all_data(){
			$aoColumns = array(
	            0 => 'NRK',
	            1 => 'NAMA',
	            2 => 'TGL_PERMOHONAN',
	            3 => 'KET_PERMOHONAN',
	            4 => 'KET_JENIS_PERMOHONAN',
	            5 => 'GOLONGAN'
            );

            $q = "SELECT
                    COUNT(NRK) AS jml
                FROM
                    PERS_TRX_AJU
                WHERE STATUS_APPROVAL = 2";

        	$rs = $this->db->query($q)->result();
        	$totalData = $rs[0]->JML;

			$get_spmu = $this->get_spmu();

			$contentspmu;
			$queryspmu;
			if(count($get_spmu) == 2)
			{
				$contentspmu=" AND (I.SPMU = '".$get_spmu[0]."' OR I.SPMU = '".$get_spmu[1]."')";
			}
			else
			{
				$contentspmu=" AND I.SPMU = '{$get_spmu}'";	
			}
			$queryspmu = $contentspmu;
			$requestData = $this->input->post();
			
			$sql = "SELECT ROWNUM, X.* FROM
					(
						SELECT ROWNUM AS RN,NRK,TGL_PERMOHONAN,ID_PERMOHONAN,ID_JENIS_PERMOHONAN,ID_TRX,ID_SOP,NAMA,KET_JENIS_PERMOHONAN,KET_PERMOHONAN,GOL,ID_KOJABF,NAJABL,JENJAB,NM_JENJAB,SPMU
						FROM
						(
							SELECT
								DISTINCT
								A .NRK,
								TO_CHAR(A.TGL_PERMOHONAN,'DD-MM-YYYY')TGL_PERMOHONAN,
								A. ID_PERMOHONAN,
								A .ID_JENIS_PERMOHONAN,
								A .ID_TRX,
								A .ID_SOP,
								A.ID_KOJABF,
								G.NAJABL,
								B.NAMA,
								C.KET_JENIS_PERMOHONAN,
								D .KET_PERMOHONAN,
								F.GOL,
								G.JENJAB,
								H.NM_JENJAB,
								I.SPMU
							FROM
								PERS_TRX_AJU A
							LEFT JOIN PERS_PEGAWAI1 B ON A .NRK = B.NRK
							LEFT JOIN PERS_JENIS_PERMOHONAN C ON A .ID_PERMOHONAN = C.ID_PERMOHONAN
							AND A .ID_JENIS_PERMOHONAN = C.ID_JENIS_PERMOHONAN
							LEFT JOIN PERS_REF_PERMOHONAN D ON A .ID_PERMOHONAN = D .ID_PERMOHONAN
							LEFT JOIN PERS_RB_GAPOK_HIST E ON A.NRK = E.NRK
							LEFT JOIN PERS_PANGKAT_TBL F ON E.KOPANG = F.KOPANG
							LEFT JOIN PERS_MASTER_KOJABF G ON A.ID_KOJABF = G.KOJAB
							LEFT JOIN PERS_MASTER_JENJAB H ON G.JENJAB = H.ID_JENJAB
							LEFT JOIN PERS_KLOGAD3 I ON A.SPMU = I.SPMU
							WHERE
								A .STATUS_APPROVAL = 2
								AND E.TMT = (SELECT MAX(TMT) FROM PERS_RB_GAPOK_HIST WHERE NRK = A.NRK)
								AND E.GAPOK = (SELECT MAX(GAPOK) FROM PERS_RB_GAPOK_HIST WHERE NRK = A.NRK AND TMT = E.TMT)
								$queryspmu 
						)PRM
					)X ";
					
			$sql.="WHERE 1=1";
			if( !empty($requestData['search']['value']) ) {   // if there is a search parameter, $requestData['search']['value'] contains search parameter
            $sql.=" AND ( X.NRK LIKE ('%".$requestData['search']['value']."%') ";    
            $sql.=" OR X.NAMA LIKE UPPER ('%".$requestData['search']['value']."%') ";
            $sql.=" OR X.KET_JENIS_PERMOHONAN LIKE UPPER ('%".$requestData['search']['value']."%') ";
            $sql.=" OR X.KET_PERMOHONAN LIKE UPPER ('%".$requestData['search']['value']."%') ";
            $sql.=" OR X.GOL LIKE UPPER('%".$requestData['search']['value']."%') )";
			}
			
			$sql.=" ORDER BY X.TGL_PERMOHONAN DESC";
			$result = $this->db->query($sql);
			$totalFiltered = $result->num_rows();
			/*$temp = $requestData['start']+$requestData['length'];

            $sql.=" AND RN > ".$requestData['start']." AND RN<= ".$temp." AND ROWNUM <= ".$requestData['length'];*/
            // var_dump($sql);exit;
            $result = $this->db->query($sql);
			


			$dataaa=array();
			$no=$requestData['start']+1;
			foreach ($result->result() as $row)
	        {            
	            $nestedData = array();
	            $nestedData[] = $no;
	            $nestedData[] = "<span id='id_trx_tbl' style='display:none'>".$row->ID_TRX."</span> &nbsp;".$row->NRK;
	            //$nestedData[] = $row->NRK;
	            $nestedData[] = $row->NAMA;
	            $nestedData[] = $row->TGL_PERMOHONAN;
	            $nestedData[] = "<span id='id_ref' >".$row->KET_PERMOHONAN."</span> &nbsp;";
	            $nestedData[] = "<span id='id_jns' >".$row->KET_JENIS_PERMOHONAN."</span> &nbsp;";
	            // $nestedData[] = "<span id='id_jen' >".$row->NM_JENJAB."</span> &nbsp;";
	            $nestedData[] = "<span id='id_gol' >".$row->GOL."</span> &nbsp;";
	            $nestedData[] = "<span id='id_jab' >".$row->NAJABL."</span> &nbsp;";
	            
	            $nestedData[] = "<a id='verifikasi' onClick='verifikasi_click(&#39;".$row->NRK."&#39;,".$row->ID_PERMOHONAN.",".$row->ID_JENIS_PERMOHONAN.",".$no.",".$row->ID_TRX.");'>Verifikasi</a> <span style='display:none' id='id_sop'>".$row->ID_SOP."</span>";
	            $nestedData['DT_RowId'] = "nomor_".$no;
	            
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

		public function get_jabfung()
	    {
			$sql= "SELECT A.KOJAB, B.NAJABL FROM PERS_MASTER_KOJABF A LEFT JOIN PERS_KOJABF_TBL B ON A.KOJAB = B.KOJAB";
	        
	        $query = $this->db->query($sql);
	        $table="";

	        foreach($query->result() as $row)
	         {
	             $table.= "<option value='".$row->KOJAB."'>".$row->NAJABL."</option>";
	         }

	         return $table;
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
				WHERE B.URUTAN = 1 AND B.STATUS = 1 ";

        	$rs = $this->db->query($q)->result();
        	$totalData = $rs[0]->JML;

			$requestData = $this->input->post();
			$get_spmu = $this->get_spmu();
			$contentspmu;
			$queryspmu;
			if(count($get_spmu) == 2)
			{
				$contentspmu=" AND (D.SPMU = '".$get_spmu[0]."' OR D.SPMU = '".$get_spmu[1]."')";
			}
			else
			{
				$contentspmu=" AND D.SPMU = '{$get_spmu}'";	
			}
			$queryspmu = $contentspmu;
			//~ var_dump($get_spmu);exit;
			$sql = "SELECT ROWNUM, X.* 
					FROM
					(
						SELECT ROWNUM AS RN,ID_TRX_HDR,NO_SURAT_PERMOHONAN,TGL_SURAT_PERMOHONAN,KET_PERMOHONAN, KET_JENIS_PERMOHONAN, SPMU
						FROM
						(
							SELECT DISTINCT A.ID_TRX_HDR,A.NO_SURAT_PERMOHONAN,TO_DATE(A.TGL_SURAT_PERMOHONAN,'DD-MM-YYYY')TGL_SURAT_PERMOHONAN,E.KET_PERMOHONAN,F.KET_JENIS_PERMOHONAN,D.SPMU
							FROM PERS_TRX_HDR A
							LEFT JOIN PERS_TRACKING B ON A.ID_TRX_HDR = B.ID_TRX_HDR
							LEFT JOIN PERS_TRX_DTL C ON A.ID_TRX_HDR = C.ID_TRX_HDR
							LEFT JOIN PERS_TRX_AJU D ON C.ID_TRX = D.ID_TRX
							LEFT JOIN PERS_REF_PERMOHONAN E ON D.ID_PERMOHONAN = E.ID_PERMOHONAN
							LEFT JOIN PERS_JENIS_PERMOHONAN F ON D.ID_PERMOHONAN = F.ID_PERMOHONAN AND D.ID_JENIS_PERMOHONAN = F.ID_JENIS_PERMOHONAN 
							WHERE B.URUTAN = 1 AND B.STATUS = 1 $queryspmu
						)PRM
					)X ";
			

			$sql.="WHERE 1=1";
			if( !empty($requestData['search']['value']) ) {   // if there is a search parameter, $requestData['search']['value'] contains search parameter
            $sql.=" AND ( X.NO_SURAT_PERMOHONAN LIKE UPPER('%".$requestData['search']['value']."%') ";    
            $sql.=" OR X.KET_PERMOHONAN LIKE UPPER ('%".$requestData['search']['value']."%') ";
            $sql.=" OR X.TGL_SURAT_PERMOHONAN LIKE UPPER ('%".$requestData['search']['value']."%') ";
            $sql.=" OR X.KET_JENIS_PERMOHONAN LIKE UPPER('%".$requestData['search']['value']."%') )";
			}

			$result = $this->db->query($sql);
            $totalFiltered = $result->num_rows();
			

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
                 WHERE URUTAN = 1
                ";

        	$rs = $this->db->query($q)->result();
        	$totalData = $rs[0]->JML;
        	


			$requestData = $this->input->post();
			$get_spmu = $this->get_spmu();
			$contentspmu;
			$queryspmu;
			if(count($get_spmu) == 2)
			{
				$contentspmu=" AND (B.SPMU = '".$get_spmu[0]."' OR B.SPMU = '".$get_spmu[1]."')";
			}
			else
			{
				$contentspmu=" AND B.SPMU = '{$get_spmu}'";	
			}
			$queryspmu = $contentspmu;
			
			// var_dump($requestData);exit;
			$sql = "SELECT ROWNUM, X.* FROM
					(
						SELECT ROWNUM AS RN,NRK,NAMA,TGL_PERMOHONAN,TGL_TOLAK,KETERANGAN AS ALASAN,KET_JENIS_PERMOHONAN,KET_PERMOHONAN,SPMU
						FROM
						(
							
							SELECT A.ID_TRX,B.NRK,E.NAMA,TO_CHAR(B.TGL_PERMOHONAN,'DD-MM-YYYY')TGL_PERMOHONAN,TO_CHAR(A.TGL_TOLAK,'DD-MM-YYYY')TGL_TOLAK,A.KETERANGAN,C.KET_PERMOHONAN,D.KET_JENIS_PERMOHONAN,B.SPMU
							FROM PERS_TRX_TOLAK A
							LEFT JOIN PERS_TRX_AJU B ON A.ID_TRX = B.ID_TRX
							LEFT JOIN PERS_REF_PERMOHONAN C ON B.ID_PERMOHONAN = C.ID_PERMOHONAN
							LEFT JOIN PERS_JENIS_PERMOHONAN D ON B.ID_PERMOHONAN = D.ID_PERMOHONAN AND B.ID_JENIS_PERMOHONAN = D.ID_JENIS_PERMOHONAN
							LEFT JOIN PERS_PEGAWAI1 E ON B.NRK = E.NRK
							WHERE A.URUTAN = 1 $queryspmu
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
			$result = $this->db->query($sql);
			$totalFiltered = $result->num_rows();
            $sql.=" AND RN > ".$requestData['start']."  AND ROWNUM <= ".$requestData['length'];
            
			$result = $this->db->query($sql);
			


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

		public function get_data($data, $table_name){
			$requestData = '';

			$columns = array(
	            0 => 'NRK',
	            1 => 'NAMA',
	            2 => 'KOLOK',
	            3 => 'KOJAB'
            );
			//$no_surat = $data['no_surat'];
			/*if($table_name == 'PERS_ANGKAT_DLM_JABFUNG'){
				$sql = "
						SELECT
							a .NRK,
							a .NO_SURAT,
							a .TGL_SURAT,
							a .SK_CPNS,
							a .SK_PNS,
							a .SK_PAK,
							a .IJASAH,
							a .SK_PGKT_TERAKHIR,
							a .DP3_SKP,
							a .SERT_DIK_JABFUNG,
							a .SURAT_REKOMENDASI,
							b.NAMA,
							b.KOLOK,
							b.KOJAB
						FROM
							$table_name a
						LEFT JOIN PERS_PEGAWAI1 b ON a .NRK = b.NRK
						WHERE
							NO_SURAT = '$no_surat'";
				$query = $this->db->query($sql);
				return $query->result();
			}elseif($table_name == 'PERS_BBS_SMTR_JABFUNG'){
				$sql = "SELECT NRK, NO_SURAT, TGL_SURAT, SK_ANGKAT_DLM_JABFUNG, SK_PAK, IJASAH, DP3_SKP, SK_PGKT_TERAKHIR, BUKTI_BBS_SEMENTARA FROM ( SELECT * FROM y.PERS_PEGAWAI1 LEFT JOIN x.vw_jabatan_terakhir ON y.NRK = x.NRK ) $table_name WHERE NO_SURAT = '$no_surat'";
				$query = $this->db->query($sql);
				return $query->result();
			}elseif($table_name == 'PERS_ANGKAT_KBL_JABFUNG'){
				$sql = "SELECT NRK, TGL_SURAT, NO_SURAT, SK_ANGKAT_DLM_JABFUNG, SK_BBS_SEMENTARA_JABFUNG, SK_PAK, SK_PGKT_TERAKHIR, IJASAH, DP3_SKP, SURAT_REKOMENDASI FRELECT * FROM y.PERS_PEGAWAI1 LEFT JOIN x.vw_jabatan_terakhir ON y.NRK = x.NRK ) $table_name WHERE NO_SURAT = '$no_surat'";
				$query = $this->db->query($sql);
				return $query->result();
			}*/

			$sql = "SELECT NRK, NAMA, KOLOK, KOJAB FROM PERS_PEGAWAI1 WHERE SPMU = 'C180' AND ROWNUM < 5";
			$query = $this->db->query($sql);

			$dataaa=array();
			$no=1;
			foreach ($query->result() as $row)
	        {            
	            
	            $nestedData= array();
	            $nestedData[] = $no;
	            $nestedData[] = $row->NRK;
	            $nestedData[] = $row->NAMA;
	            $nestedData[] = $row->KOLOK;
	            $nestedData[] = $row->KOJAB;
	            
	            $dataaa[]=$nestedData;
	            $no++;
	        }
	        //var_dump($data);exit;
	        $json_data = array(
	             "draw"            => intval( $requestData['draw'] ),
	            //"recordsTotal"    => intval( $totalData ),
	            //"recordsFiltered" => intval( $totalFiltered ),
	            "data"            => $dataaa
	        );

	        echo json_encode($json_data);
		}

		public function get_all_data_by_filter(){
			// var_dump($this->input->post());exit;
			$get_spmu = $this->get_spmu();
			$aoColumns = array(
	            0 => 'NO',
	            1 => 'NRK',
	            2 => 'NAMA',
	            3 => 'TGL_PERMOHONAN',
	            4 => 'KET_PERMOHONAN',
	            5 => 'KET_JENIS_PERMOHONAN',
	            6 => 'GOLONGAN',
	            7 => 'KOJABF'
	            /*7 => 'aksi'*/
            );
			$requestData = $this->input->post();

			$q = "SELECT
                    COUNT(NRK) AS jml
                FROM
                    PERS_TRX_AJU
                WHERE STATUS_APPROVAL = 2";

        	$rs = $this->db->query($q)->result();
        	$totalData = $rs[0]->JML;

			$filter_pertama = $requestData['filter_pertama'];
			$filter_kedua = $requestData['filter_kedua'];
			$filter_ketiga = $requestData['filter_ketiga'];
			$filter_empat = $requestData['filter_empat'];
			$wh1="";
			$wh2="";
			$wh3="";
			$wh4="";
			if($filter_pertama != null ){
				$wh1 = 'AND A. ID_PERMOHONAN ='. $filter_pertama;
			}
			
			if($filter_kedua != null){
				$wh2 = ' AND A. ID_JENIS_PERMOHONAN = '. $filter_kedua;
			}

			if($filter_ketiga != null){
				$wh3 = ' AND F. KOPANG = '.$filter_ketiga;
			}

			if($filter_empat != null){
				$wh4 = ' AND A. ID_KOJABF  = '.$filter_empat;
			}


			/*elseif($filter_kedua = null){
				$value = 'AND ID_PERMOHONAN ='. $filter_pertama .' AND KOPANG ='. $filter_ketiga;
			}elseif($filter_ketiga == null){
				$value = 'ID_PERMOHONAN ='. $filter_pertama .' AND ID_JENIS_PERMOHONAN ='. $filter_kedua;
			}else{
				$value = 'ID_PERMOHONAN ='. $filter_pertama .' AND ID_JENIS_PERMOHONAN ='. $filter_kedua .' AND KOPANG = '. $filter_ketiga;
			}
			var_dump($value);exit;*/
			$sql = "SELECT ROWNUM, X.* FROM
					(
						SELECT ROWNUM AS RN,NRK,TGL_PERMOHONAN,ID_PERMOHONAN,ID_JENIS_PERMOHONAN,ID_TRX,ID_SOP,NAMA,KET_JENIS_PERMOHONAN,KET_PERMOHONAN,GOL,ID_KOJABF,NAJABL,JENJAB,NM_JENJAB,SPMU
						FROM
						(
							SELECT DISTINCT
								A .NRK,
								TO_CHAR(A.TGL_PERMOHONAN,'DD-MM-YYYY')TGL_PERMOHONAN,
								A. ID_PERMOHONAN,
								A .ID_JENIS_PERMOHONAN,
								A .ID_TRX,
								A .ID_SOP,
								A.ID_KOJABF,
								A.SPMU,
								G.NAJABL,
								B.NAMA,
								C.KET_JENIS_PERMOHONAN,
								D .KET_PERMOHONAN,
								F.GOL,
								G.JENJAB,
								H.NM_JENJAB
							FROM
								PERS_TRX_AJU A
							LEFT JOIN PERS_PEGAWAI1 B ON A .NRK = B.NRK
							LEFT JOIN PERS_JENIS_PERMOHONAN C ON A .ID_PERMOHONAN = C.ID_PERMOHONAN
							AND A .ID_JENIS_PERMOHONAN = C.ID_JENIS_PERMOHONAN
							LEFT JOIN PERS_REF_PERMOHONAN D ON A .ID_PERMOHONAN = D .ID_PERMOHONAN
							LEFT JOIN PERS_RB_GAPOK_HIST E ON A.NRK = E.NRK
							LEFT JOIN PERS_PANGKAT_TBL F ON E.KOPANG = F.KOPANG
							LEFT JOIN PERS_MASTER_KOJABF G ON A.ID_KOJABF = G.KOJAB
							LEFT JOIN PERS_MASTER_JENJAB H ON G.JENJAB = H.ID_JENJAB
							WHERE
								A .STATUS_APPROVAL = 2
								{$wh1}{$wh2}{$wh3}{$wh4} 
								AND E.TMT = (SELECT MAX(TMT) FROM PERS_RB_GAPOK_HIST WHERE NRK = A.NRK)
								AND E.GAPOK = (SELECT MAX(GAPOK) FROM PERS_RB_GAPOK_HIST WHERE NRK = A.NRK AND TMT = E.TMT)
								AND A.SPMU = '{$get_spmu}'
						)PRM
					)X ";
			/*$sql = "SELECT
						ROWNUM,X.*
					FROM
						(
							SELECT ROWNUM AS RN,NRK,TGL_PERMOHONAN,ID_JENIS_PERMOHONAN,ID_TRX,NAMA,KET_JENIS_PERMOHONAN,KET_PERMOHONAN,GOL,NAJABL,ID_SOP
							FROM
								(
									SELECT DISTINCT
										A .NRK,
										TO_CHAR (
											A .TGL_PERMOHONAN,
											'DD-MM-YYYY'
										) TGL_PERMOHONAN,
										A .ID_JENIS_PERMOHONAN,
										A .ID_TRX,
										A.ID_SOP,
										B.NAMA,
										C.KET_JENIS_PERMOHONAN,
										D .KET_PERMOHONAN,
										F.GOL,
										G.NAJABL
									FROM
										PERS_TRX_AJU A
									LEFT JOIN PERS_PEGAWAI1 B ON A .NRK = B.NRK
									LEFT JOIN PERS_JENIS_PERMOHONAN C ON A .ID_PERMOHONAN = C.ID_PERMOHONAN
									AND A .ID_JENIS_PERMOHONAN = C.ID_JENIS_PERMOHONAN
									LEFT JOIN PERS_REF_PERMOHONAN D ON A .ID_PERMOHONAN = D .ID_PERMOHONAN
									LEFT JOIN PERS_RB_GAPOK_HIST E ON A .NRK = E .NRK
									LEFT JOIN PERS_PANGKAT_TBL F ON E .KOPANG = F.KOPANG
									LEFT JOIN PERS_MASTER_KOJABF G ON A.ID_KOJABF = G.KOJAB
									WHERE
										A .STATUS_APPROVAL = 2
									".$wh1." 
									".$wh2." 
									".$wh3."
									".$wh4."
									AND E .TMT = (
										SELECT
											MAX (TMT)
										FROM
											PERS_RB_GAPOK_HIST
										WHERE
											NRK = A .NRK
									)
								) PRM
						) X ";*/

			$sql.="WHERE 1=1";

			if( !empty($requestData['search']['value']) ) {   // if there is a search parameter, $requestData['search']['value'] contains search parameter
            $sql.=" AND ( X.NRK LIKE ('%".$requestData['search']['value']."%') ";    
            $sql.=" OR X.NAMA LIKE UPPER ('%".$requestData['search']['value']."%') ";
            $sql.=" OR X.KET_JENIS_PERMOHONAN LIKE UPPER ('%".$requestData['search']['value']."%') ";
            $sql.=" OR X.KET_PERMOHONAN LIKE UPPER ('%".$requestData['search']['value']."%') ";
            $sql.=" OR X.GOL LIKE UPPER('%".$requestData['search']['value']."%') )";
			}

			
			$result = $this->db->query($sql);
			$totalFiltered = $result->num_rows();
			$dataaa=array();
			$no = $requestData['start']+1;

			foreach ($result->result() as $row)
	        {            
	            $nestedData = array();
	            $nestedData[] = $no;
	            $nestedData[] = "<span id='id_trx_tbl' style='display: none'>".$row->ID_TRX."</span>". $row->NRK;
	            $nestedData[] = $row->NAMA;
	            $nestedData[] = $row->TGL_PERMOHONAN;
	            $nestedData[] = $row->KET_PERMOHONAN;
	            $nestedData[] = $row->KET_JENIS_PERMOHONAN;
	            $nestedData[] = $row->GOL;
	            $nestedData[] = $row->NAJABL;
/*	            $nestedData[] = "<a id='verifikasi' onClick='verifikasi_click(&#39;".$row->NRK."&#39;,".$row->ID_JENIS_PERMOHONAN.",".$no.");'>Verifikasi</a>";*/
	            $nestedData[] = "<a id='verifikasi' onClick='verifikasi_click(&#39;".$row->NRK."&#39;,".$row->ID_PERMOHONAN.",".$row->ID_JENIS_PERMOHONAN.",".$no.",".$row->ID_TRX.");'>Verifikasi</a> <span style='display:none' id='id_sop'>".$row->ID_SOP."</span>";
	            $nestedData['DT_RowId'] = "nomor_".$no;
	            // $nestedData[] = '<input type="checkbox" name="check_check[]">';
	            
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

		public function count_data($prm){
			$get_spmu = $this->get_spmu();
			
			
			if(count($get_spmu) == 2)
			{
				if($prm == 2)
				{
					$sql = "SELECT COUNT(*) AS TRX_HDR FROM PERS_TRX_AJU
							WHERE (SPMU = '".$get_spmu[0]."' OR SPMU ='".$get_spmu[1]."') AND STATUS_APPROVAL = 2";
					
					$res = $this->db->query($sql);
					$result = $res->row();
				}
				else if($prm == 3)
				{
					$sql = "SELECT COUNT(A.ID_TRX) AS TRX_TOLAK FROM PERS_TRX_TOLAK A LEFT JOIN PERS_TRX_AJU B ON A.ID_TRX = B.ID_TRX
						WHERE A.URUTAN = 1 AND (B.SPMU = '".$get_spmu[0]."' OR B.SPMU ='".$get_spmu[1]."')";
					$res = $this->db->query($sql);
					$result = $res->row();
				}
				else
				{
					$sql = "SELECT COUNT( DISTINCT A.ID_TRX_HDR) AS TRX_TERIMA FROM PERS_TRX_HDR A
							LEFT JOIN PERS_TRACKING C ON A.ID_TRX_HDR = C.ID_TRX_HDR 
							LEFT JOIN PERS_TRX_DTL D ON A.ID_TRX_HDR = D.ID_TRX_HDR
							LEFT JOIN PERS_TRX_AJU E ON D.ID_TRX = E.ID_TRX
							WHERE C.URUTAN = 1 AND C.STATUS = 1 AND (E.SPMU = '".$get_spmu[0]."' OR E.SPMU ='".$get_spmu[1]."')";
					$res = $this->db->query($sql);
					$result = $res->row();
				}
			}
			else
			{
				if($prm == 2)
				{
					$sql = "SELECT COUNT(*) AS TRX_HDR FROM PERS_TRX_AJU
							WHERE SPMU = '{$get_spmu}' AND STATUS_APPROVAL = 2";
					
					$res = $this->db->query($sql);
					$result = $res->row();
				}
				else if($prm == 3)
				{
					$sql = "SELECT COUNT(A.ID_TRX) AS TRX_TOLAK FROM PERS_TRX_TOLAK A LEFT JOIN PERS_TRX_AJU B ON A.ID_TRX = B.ID_TRX
						WHERE A.URUTAN = 1 AND B.SPMU = '{$get_spmu}'";
					$res = $this->db->query($sql);
					$result = $res->row();
				}
				else
				{
					$sql = "SELECT COUNT(DISTINCT A.ID_TRX_HDR) AS TRX_TERIMA FROM PERS_TRX_HDR A
							LEFT JOIN PERS_TRACKING C ON A.ID_TRX_HDR = C.ID_TRX_HDR 
							LEFT JOIN PERS_TRX_DTL D ON A.ID_TRX_HDR = D.ID_TRX_HDR
							LEFT JOIN PERS_TRX_AJU E ON D.ID_TRX = E.ID_TRX
							WHERE C.URUTAN = 1 AND C.STATUS = 1 AND E.SPMU = '{$get_spmu}'";
					$res = $this->db->query($sql);
					$result = $res->row();
				}
			}


			
			//~ var_dump($result);exit;
			return $result;
		}

		public function simpan_data($data){
			// var_dump($data);exit;
			$no_surat_permohonan = $data['no_surat_permohonan'];
			list($date, $month, $year) = explode("-", $data['tgl_surat_permohonan']);
			$time = date("H:i:s");
			$id_sop = $data['id_trx'][0]['id_sop'];
			// var_dump($id_sop);exit;
			//$datetime = $tgl_surat_permohonan." ".strtotime($date);
			// var_dump($tgl_surat_permohonan." ".$time);exit;
			$sql = "INSERT INTO
					PERS_TRX_HDR (ID_TRX_HDR, NO_SURAT_PERMOHONAN, TGL_SURAT_PERMOHONAN, ID_SOP,TGL_UPDATE)
				VALUES ((SELECT COUNT (*) + 1 FROM PERS_TRX_HDR), UPPER('$no_surat_permohonan'), TO_DATE('".$year."-".$month."-".$date." ".$time."', 'YYYY-MM-DD HH24:MI:SS'), {$id_sop},SYSDATE)";
			// var_dump($sql);exit;
			$this->db->query($sql);
			
			for ($i=0; $i < count($data['id_trx']); $i++) { 
				if($data['id_trx'][$i]['_ket'] == 1){
					$sql2 = "INSERT INTO PERS_TRX_DTL (
								ID_TRX_DETAIL,
								ID_TRX_HDR,
								ID_TRX
							)
							VALUES
								(
									(
										SELECT
											COUNT (*) + 1
										FROM
											PERS_TRX_DTL
									),
									(
										SELECT
											COUNT (*)
										FROM
											PERS_TRX_HDR
									),
									".$data['id_trx'][$i]['id']."
								)";
					
					$this->db->query($sql2);
					
					$sql3 = "UPDATE PERS_TRX_AJU SET STATUS_APPROVAL = 1, STATUS_BERJALAN = 2, ID = 2,TGL_UPDATE = SYSDATE WHERE ID_TRX = ".$data['id_trx'][$i]['id']."";
					$this->db->query($sql3);
					
				}
				
			}
			$sql4 = "INSERT INTO PERS_TRACKING (
					ID_TRACKING, ID_TRX_HDR, URUTAN, STATUS, NO_SURAT, TGL_SURAT,TGL_UPDATE
					) VALUES (
					(SELECT COUNT (*) + 1 FROM PERS_TRACKING), (SELECT COUNT (*) FROM PERS_TRX_HDR), 1, 1, UPPER('$no_surat_permohonan'), TO_DATE('".$year."-".$month."-".$date." ".$time."', 'YYYY-MM-DD HH24:MI:SS'),SYSDATE)";
			$sql5 = "INSERT INTO PERS_TRACKING (ID_TRACKING, ID_TRX_HDR, URUTAN, STATUS,TGL_UPDATE) VALUES ((SELECT COUNT (*) + 1 FROM PERS_TRACKING), (SELECT COUNT (*) FROM PERS_TRX_HDR), 2, 2,SYSDATE)";

			
			$this->db->query($sql4);
			$this->db->query($sql5);

			
			return 1;
			
		}

        public function updateKeteranganFile($file_syarat, $id_trx, $id_syarat){
            $sql = "UPDATE PERS_DTL_TRX_AJU SET FILE_SYARAT = '".$file_syarat."' WHERE ID_TRX = '".$id_trx."' AND ID_SYARAT = '".$id_syarat."'";
            //var_dump($sql);exit;
            $result = $this->db->query($sql);
            return $result;
        }

		//CEK FILE TERIMA 
		public function dataTrxDtl(){
			$requestData = $this->input->post();
			$id_trx_hdr = ($requestData['id_trx_hdr']>0)?$requestData['id_trx_hdr']:0;

			$sql = "SELECT DISTINCT
						A.ID_TRX_HDR,
						A.ID_TRX_DETAIL,
						A.ID_TRX,
						B.NO_SURAT_PERMOHONAN,
						C.NRK,
						D.NAMA
						
						
					FROM
						PERS_TRX_DTL A
					LEFT JOIN PERS_TRX_HDR B ON B .ID_TRX_HDR = A.ID_TRX_HDR
					LEFT JOIN PERS_TRX_AJU C ON A .ID_TRX = C.ID_TRX
					
					LEFT JOIN PERS_PEGAWAI1 D ON D.NRK = C.NRK
					WHERE A.ID_TRX_HDR=$id_trx_hdr";
//			
			$query = $this->db->query($sql);
			$totalData = $query->num_rows();
			$totalFiltered = $totalData;

			$dataaa=array();
			$no=1;
			foreach ($query->result() as $row)
			{
				$nestedData= array();
				$nestedData[] = $no;
				$nestedData[] = $row->NRK;
				$nestedData[] = $row->NAMA;
				$nestedData[] = '<button class="btn btn-primary btn-xs" data-toggle="modal" data-target="#myModal" id="test_btn" onclick="cekFile('.$row->ID_TRX_DETAIL.','.$row->NRK.',\''.$row->NAMA.'\','.$row->ID_TRX.');"> Cek file </button>';
				

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

		//query untuk datatable modal
		public function getpgw(){
			$requestData = $this->input->post();
			$kopang = $requestData['KOPANG'];
			$jenis = $requestData['JENIS'];
			$mohon = $requestData['PERMOHONAN'];

			$columns = array(
	            0 => 'NRK',
	            1 => 'NAMA'	          
            );
			
			$sql = "SELECT A.NRK,A.ID_TRX,A.ID_PERMOHONAN,A.ID_JENIS_PERMOHONAN,A.TGL_PERMOHONAN,B.NAMA,D.GOL,D.NAPANG
					FROM
						PERS_TRX_AJU A
					LEFT JOIN PERS_PEGAWAI1 B ON A .NRK = B.NRK
					LEFT JOIN PERS_RB_GAPOK_HIST C ON A .NRK = C.NRK
					LEFT JOIN PERS_PANGKAT_TBL_NOW D ON C.KOPANG = D .KOPANG
					WHERE
						C.GAPOK = 
						(
							SELECT
								MAX (GAPOK)
							FROM
								PERS_RB_GAPOK_HIST
							WHERE
								NRK = A.NRK
						)
					AND C.KOPANG = '".$kopang."'
					AND A.TGL_PERMOHONAN = (
						SELECT
							MAX (TGL_PERMOHONAN)
						FROM
							PERS_TRX_AJU
						WHERE
							NRK = A .NRK AND
							ID_PERMOHONAN = ".$mohon." AND
						  ID_JENIS_PERMOHONAN = ".$jenis."
					)
					AND A.ID_PERMOHONAN = ".$mohon."
					AND A.ID_JENIS_PERMOHONAN = ".$jenis."
					AND A.STATUS_APPROVAL = 2";
			// $sql = "SELECT
			// 			A .*,
			// 			B.NAMA,
			// 			B.SPMU,
			// 			C.ALAMAT,
			// 			C.RT,
			// 			C.RW,
			// 			D .NAKEL,
			// 			E .KOCAM,
			// 			E .NACAM,
			// 			F.KOWIL,
			// 			F.NAWIL,
			// 			G .KET_SYARAT,
			// 			H .ID_SYARAT,
			// 			H .FILE_SYARAT
			// 		FROM
			// 			PERS_TRX_PERMOHONAN A
			// 		LEFT JOIN PERS_SYARAT_PERMOHONAN G ON A .ID_PERMOHONAN = G .ID_PERMOHONAN
			// 		AND A .ID_JENIS_PERMOHONAN = G .ID_JENIS_PERMOHONAN
			// 		LEFT JOIN PERS_DETAIL_TRX_PERMOHONAN H ON A .ID_JENIS_PERMOHONAN = H .ID_JENIS_PERMOHONAN
			// 		AND A .TGL_PERMOHONAN = H .TGL_PERMOHONAN
			// 		AND G .ID_SYARAT = H .ID_SYARAT
			// 		LEFT JOIN PERS_PEGAWAI1 B ON A .NRK = B.NRK
			// 		LEFT JOIN PERS_PEGAWAI2 C ON A .NRK = C.NRK
			// 		LEFT JOIN PERS_KOWIL_TBL F ON C.KOWIL = F.KOWIL
			// 		LEFT JOIN PERS_KOCAM_TBL E ON E .KOWIL = F.KOWIL
			// 		AND C.KOCAM = E .KOCAM
			// 		LEFT JOIN PERS_KOKEL_TBL D ON D .KOWIL = F.KOWIL
			// 		AND D .KOCAM = E .KOCAM
			// 		AND C.KOKEL = D .KOKEL"; 

			$query = $this->db->query($sql);
			$totalData = $query->num_rows();
			$dataaa=array();
			$null = '&nbsp;';
			//$no=1;
			foreach ($query->result() as $row)
	        {            
	            // echo $row->TGL_PERMOHONAN;
	            $nestedData = array();
	            // $nestedData[]  = "<input type='checkbox' name='primary_keys[]' id='checkbox' value='".$row->NRK."'>".$null."</input>";
	            // $nestedData[]  = "<input style='display:none' type='checkbox' name='tgl_permohonan[]' id='checkbox' value='".$row->TGL_PERMOHONAN."'>".$null."</input>";
	            $nestedData[] = "<span id='".$row->NRK."'>".$row->NRK."</span>";
	            $nestedData[] = "<span id='".$row->NAMA."'>".$row->NAMA."</span>";
	            $nestedData[] = "<span id='".$row->TGL_PERMOHONAN."'>".$row->TGL_PERMOHONAN."</span>";
	            $nestedData[] = "<input type='checkbox' name='terima[]' id='checkbox_checkbox'>";
	            // $nestedData[] = "<span style='display:none' id='".$row->ALAMAT."'>".$row->ALAMAT."</span>";
	            // $nestedData[] = "<span style='display:none' id='".$row->RT."'>".$row->RT."</span>";
	            // $nestedData[] = "<span style='display:none' id='".$row->RW."'>".$row->RW."</span>";
	            // $nestedData[] = "<span style='display:none' id='".$row->NAKEL."'>".$row->NAKEL."</span>";
	            // $nestedData[] = "<span style='display:none' id='".$row->NACAM."'>".$row->NACAM."</span>";
	            // $nestedData[] = "<span style='display:none' id='".$row->NAWIL."'>".$row->NAWIL."</span>";
	            
	            $dataaa[]=$nestedData;
	            //$no++;
	        }
	        $json_data = array(
	           	"draw"            => intval( $requestData['draw'] ),
	            "data"            => $dataaa
	        );

	        echo json_encode($json_data);
		}



		//DATATABLE PAGE
		public function getpgwwip($nrk,$permohonan,$jenis){
			
			$data = implode(",", $nrk);
			$sql = "SELECT A.NRK, A.TGL_PERMOHONAN, B.NAMA FROM PERS_TRX_AJU A LEFT JOIN PERS_PEGAWAI1 B ON A.NRK = B.NRK WHERE A.NRK IN (".$data.")
					AND A.ID_PERMOHONAN = ".$permohonan." AND A.ID_JENIS_PERMOHONAN = ".$jenis." AND A. STATUS_APPROVAL = 2 
					";
		
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
		
			// $sql = "SELECT A.NRK,B.NAMA FROM \"vw_jabatan_terakhir\" A
			// 		LEFT JOIN PERS_PEGAWAI1 B ON A.NRK = B.NRK
			// 		WHERE A.NRK IN (".$data.") AND ROWNUM<=10";
	
			
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

		public function get_jenis_permohonan($where = null){
			// $sql = "SELECT * FROM PERS_JENIS_PERMOHONAN WHERE ID_PERMOHONAN = '".$where."'";
			$sql = "SELECT * FROM PERS_JENIS_PERMOHONAN";
			$query = $this->db->query($sql);
			// foreach($query->result() as $row){
			// 	$table = "<option value='".$row->ID_JENIS_PERMOHONAN."'>".$row->KET_JENIS_PERMOHONAN."</option>";
			// }
			// $result = json_encode($table);
			// return $result;
			// return $table;
			return $query;
		}

		public function get_permohonan(){
			$sql = "SELECT * FROM PERS_REF_PERMOHONAN";
			$query = $this->db->query($sql);
			// foreach($query->result() as $row){
			// 	$table = "<option value='".$row->ID_PERMOHONAN."'>".$row->KET_PERMOHONAN."</option>";
			// }
			// return $table;
			// $result = json_encode($table);
			// return $result;
			return $query;
		}

		public function get_gol_pegawai(){
			$sql = "SELECT KOPANG, GOL, NAPANG FROM PERS_PANGKAT_TBL_NOW";
			$query = $this->db->query($sql);
			return $query;
		}
		
		Public function get_kojabf(){
			$sql = "SELECT ID_KOJABF,KET_KOJABF FROM PERS_MASTER_KOJABF";
			$query = $this->db->query($sql);
			return $query;
		}

		public function get_persyaratan_model(){
			$where = $this->input->post();
			$nrk_post = $where['NRK'];
			$permohonan_post = $where['ID_PERMOHONAN'];
			$jenis_permohonan_post = $where['ID_JENIS_PERMOHONAN'];

			$sql = "SELECT
					A.FILE_SYARAT,
					B.NRK,
					B.TGL_PERMOHONAN,
					B. ID_PERMOHONAN,
					B.ID_JENIS_PERMOHONAN,
					C.KET_SYARAT,
                    C.INIT_SYARAT,
					A.ID_SYARAT
					FROM
						PERS_DTL_TRX_AJU A
					LEFT JOIN PERS_TRX_AJU B ON A .ID_TRX = B.ID_TRX
					LEFT JOIN PERS_SYARAT_DTL C ON C.ID_SYARAT_DTL = A.ID_SYARAT
					WHERE
						B.NRK = '".$nrk_post."'
						AND B.ID_PERMOHONAN = '".$permohonan_post."'
						AND B.ID_JENIS_PERMOHONAN = '".$jenis_permohonan_post."'
						AND B.STATUS_APPROVAL = 2
					ORDER BY
						A.ID_SYARAT";
			// echo $sql;
			// var_dump($sql);exit;
			$query = $this->db->query($sql);
			$no = 1;
			$table = "";

			foreach ($query->result() as $row)
			{
				$table .= "<tr>";
				$table .= "<td>".$no++."</td>";
				$table .= "<td>".$row->KET_SYARAT."</td>";
				//~if(!empty($row->FILE_SYARAT)){
					//~$table .= "<td id='ket_syarat'>Ada</td>";
					//~$table .= "<td class='text-center'><a href='".site_url('assets/file_permohonan/'.$row->NRK.'/'.$row->FILE_SYARAT)."' target='external'><i class='fa fa-external-link' aria-hidden='true'></i></a></td>";
				//~}else{
					//~$table .= "<td id='ket_syarat'>Tidak Ada</td>";
					//~$table .= "&nbsp;";
				//~}
					$table .= "<td class='text-center'><a id='".$row->INIT_SYARAT."' href='".site_url('assets/file_permohonan/'.$row->NRK.'/'.$row->FILE_SYARAT)."' target='external'><i class='fa fa-external-link' aria-hidden='true'></i></a></td>";
					/*$table .= "<td id='ket_syarat".$row->INIT_SYARAT."' class='text-center'>
                                <span class='fileUpload btn btn-default' id='up".$row->INIT_SYARAT."'>
                                    <span class='glyphicon glyphicon-upload'></span> Unggah file
                                    <input type='file' id='".$row->INIT_SYARAT."_".$row->ID_SYARAT."'>
                                </span>
                                <span class='progress-".$row->INIT_SYARAT."'>
                                    <div class='progress progress-striped active'>
                                        <div style='width: 0%' aria-valuemax='100' aria-valuemin='0' aria-valuenow='0' role='progressbar' class='progress-bar progress-bar-success'>
                                        </div>
                                    </div>
                                </span>
                                <div class='btn-group text-center'>
                                  <button type='button' onClick='update_status_file(&#39;".$row->ID_SYARAT."&#39;,&#39;".$row->INIT_SYARAT."&#39;,1)' class='btn btn-success'>Benar</button>
                                  <button type='button' onClick='update_status_file(&#39;".$row->ID_SYARAT."&#39;,&#39;".$row->INIT_SYARAT."&#39;,0)' class='btn btn-danger'>Salah</button>
                                </div>
                                </td>";
					$table .= "&nbsp;";
                    $table .= "<script>
                                    $('.fileUpload').hide();
                                    $('#ket_syarat".$row->INIT_SYARAT." > .progress-".$row->INIT_SYARAT."').hide();
                                </script>";*/

				$table .= "</tr>";
				//$no++;
			}
            
            $table .= "<script>
                        function update_status_file(id_syarat, init_syarat, tipe){
                            //~console.log($('#id_trx').val());
                            if(tipe == 0){
                                //~check_file_exist(init_syarat);
                                $('#ket_syarat' + init_syarat + ' > .btn-group').hide()
                                $('#ket_syarat' + init_syarat + ' > #up' + init_syarat).show()
                            }else{
                                $('#ket_syarat' + init_syarat).text('File Benar').css({'color': '#6C7A89', 'text-align': 'center'});
                            }
                        }
                        
                        $('input[type=file]').on('change',function(){
                            var syarat = $(this).attr('id');
                            var test = this.files[0];
                            if(!$(this).val()){
                                //~console.log($(this).val());
                                //~console.log(this.files[0]);
                                return false;
                            }else{
                                if(test.size > 3000000){
                                    $(this).val('');
                                    swal('Gagal!','File tidak di boleh melebihi 3MB.','error');
                                    return false;
                                }else{
                                    var split_syarat = syarat.split('_');
                                    check_file_exist(split_syarat[0]);
                                    file_validation($(this).val(), test, split_syarat[0], split_syarat[1]);
                                }
                            }
                        })
                        
                        function file_validation(prm, thisx, init_syarat, id_syarat){
                            var ext = prm.split('.').pop().toLowerCase();
                            if($.inArray(ext, ['pdf','png','jpg','jpeg']) == -1) {
                                swal('Error!','Format tidak di dukung!.','error');
                            }else{
                                uploading(thisx, init_syarat, id_syarat);
                            }
                        }
                        
                        function check_file_exist(init_syarat){
                            var nrk = $('#nrk').val();
                            $.ajax({
                                url: '".base_url("index.php/skpd/check_file_from_skpd")."',
                                type: 'post',
                                data: {
                                    nrk: nrk, init_syarat: init_syarat, currentDate: new Date() 
                                },
                                dataType: 'json',
                                success: function(data){
                                    if(data != true || data != 1){
                                        return false;
                                    }
                                }
                            });
                        }
                        
                        function uploading(thisx, init_syarat, id_syarat){
                            var formData = new FormData();
                            formData.append('file', thisx);
                            var nrk = $('#nrk').val();
                            $.ajax({
                                url: '".base_url("index.php/skpd/upload_from_skpd")."' + '/' + init_syarat + '/' + nrk,
                                type: 'POST',
                                xhr: function() {
                                    var xhr = $.ajaxSettings.xhr();
                                    if (xhr.upload) {
                                        xhr.upload.addEventListener('progress', function(evt) {
                                            $('#up' + init_syarat).hide();
                                            $('#ket_syarat' + init_syarat + ' > .progress-' + init_syarat).show();
                                            var percent = (evt.loaded / evt.total) * 100;
                                            $('#ket_syarat' + init_syarat + ' > .progress-' + init_syarat).find('.progress-bar').width(percent + '%');
                                            $('#ket_syarat' + init_syarat + ' > .progress-' + init_syarat).find('.progress-bar').text(Math.round(percent) + '%');
                                        }, false);
                                    }
                                    return xhr;
                                },
                                success: function(data) {
                                    to_db(data, init_syarat, id_syarat);
                                    //console.log($('#tbl-grid3').closest('tr').find('td:eq(2)').attr('href'));
                                    $('a#' + init_syarat).attr('href', '".base_url("assets/file_permohonan/")."' + '/' + nrk + '/' + data);
                                    $('#ket_syarat' + init_syarat + ' > .progress-' + init_syarat).hide();
                                    $('#ket_syarat' + init_syarat).text('File Berhasil di Unggah').css({'color': '#6C7A89', 'text-align': 'center'});
                                },
                                error: function(data) {
                                    console.log('An error occured!');
                                },
                                data: formData,
                                //~data: {
                                    //~files : value 
                                //~},
                                cache: false,
                                contentType: false,
                                processData: false
                            }, 'json');
                        }
                        
                        function to_db(file_syarat, init_syarat, id_syarat){
                            var id_trx = $('#id_trx').val();
                            $.ajax({
                                url: '".base_url("index.php/skpd/update_keterangan_file")."',
                                type: 'post',
                                data: {
                                    file_syarat: file_syarat, id_trx: id_trx, id_syarat: id_syarat
                                },
                                dataType: 'json',
                                success: function(data){
                                    if(data == true){
        
                                    }
                                    //~console.log(data);
                                }
                            });
                        }
            </script>";

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
			$nrk_post = $where['NRK'];
			$permohonan_post = $where['ID_PERMOHONAN'];
			$jenis_permohonan_post = $where['ID_JENIS_PERMOHONAN'];
			
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
						AND B.ID_PERMOHONAN = '".$permohonan_post."'
						AND B.ID_JENIS_PERMOHONAN = '".$jenis_permohonan_post."'
						AND B.STATUS_APPROVAL = 2
					ORDER BY
						C.ID_SYARAT";
			// echo $sql;
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
			//echo $sql2;
			$query1 = $this->db->query($sql2);
			// var_dump($query1->result());exit;
			$arrayName = "";
			foreach ($query1->result() as $res) {
				// $data = 'nrk'. $res->NRK; 
				$arrayName = array('id_trx' => $res->ID_TRX, 'nrk' => ''.$res->NRK.'', 'nama' => $res->NAMA, 'alamat' => $res->ALAMAT, 'rt' => $res->RT, 
					'rw' => $res->RW, 'nama_wilayah' => $res->NAWIL, 'nama_kecamatan' => $res->NACAM, 'nama_kelurahan' => $res->NAKEL);
			}
			// var_dump($sql2);exit;
			$result = json_encode($arrayName);
	        return $result;
		}

		public function tolak_data($data){
			// var_dump($data);exit;
			$id_trx = $data['id_trx'];
			$tgl_tolak = $data['tgl_tolak'];
			$keterangan = $data['keterangan'];
			$sql1 = "UPDATE PERS_TRX_AJU SET STATUS_APPROVAL = 3,STATUS_BERJALAN = 3, STATUS_AKHIR='REJECT' WHERE ID_TRX = $id_trx";
			$this->db->query($sql1);
			$sql2 = "INSERT INTO PERS_TRX_TOLAK VALUES ((SELECT COUNT (*) + 1 FROM PERS_TRX_TOLAK),'".$id_trx."',TO_DATE('".$tgl_tolak."', 'YYYY-MM-DD HH24:MI:SS'),UPPER('".$keterangan."'),1)";

//			$q1 = "SELECT MAX(ID_TRACKING) AS ID_TRACKING FROM PERS_TRACKING";
//			$id_tracking=$this->db->query($q1)->row()->ID_TRACKING+1;
//			$q2 = "SELECT MAX(ID_TRX_HDR) AS ID_TRX_HDR FROM PERS_TRX_HDR";
//			$id_trx_hdr=$this->db->query($q2)->row()->ID_TRX_HDR+1;
//
//			$sql3 = "INSERT INTO PERS_TRACKING (ID_TRACKING, ID_TRX_HDR, URUTAN, STATUS) VALUES ($id_tracking, $id_trx_hdr, 1, 3)";
//
//			$this->db->query($sql3);
			return $this->db->query($sql2);
		}

		public function insert_data($data){
			
			$no_surat_skpd = $data['NO_SURAT_SKPD'];
			$tgl_surat_skpd = $data['TGL_SURAT_SKPD'];
			$status_approval_tu = $data['STATUS_APPROVAL_TU'];
			$id_trx = $data['ID_TRX'];
			$id_permohonan = $data['ID_PERMOHONAN'];
			$id_jenis_permohonan = $data['ID_JENIS_PERMOHONAN'];
			
				$upd = "UPDATE PERS_TRX_AJU SET STATUS_APPROVAL = 1 WHERE ID_TRX = ".$id_trx."";
				$exupd = $this->db->query($upd);

				$sql = "INSERT INTO PERS_TRX_SKPD VALUES ((SELECT COUNT (*) + 1 FROM PERS_TRX_SKPD),'".$no_surat_skpd."',TO_DATE('".$tgl_surat_skpd."', 'YYYY-MM-DD HH24:MI:SS'),'".$status_approval_tu."','".$id_trx."','".$id_permohonan."','".$id_jenis_permohonan."')";		
			
			return $this->db->query($sql);
		}

		public function update_data($data){
			$id_trx = $data['ID_TRX'];
			
			$upd = array();
			for ($i=0; $i < count($count); $i++) { 
				
				$upd = "UPDATE PERS_TRX_AJU SET STATUS_APPROVAL = 3 WHERE ID_TRX = ".$id_trx."";
				$exupd = $this->db->query($upd);

			}
			return count($count);	
		}

		public function get_list_permohonan_baru_(){
			$sql = "SELECT A.NRK, TO_CHAR(A.TGL_PERMOHONAN, 'DD-MM-YYYY HH24:MI:SS') TGL_PERMOHONAN, A.ID_JENIS_PERMOHONAN, B.NAMA, C.KET_JENIS_PERMOHONAN FROM PERS_TRX_AJU A LEFT JOIN PERS_PEGAWAI1 B ON A.NRK = B.NRK LEFT JOIN PERS_JENIS_PERMOHONAN C ON A .ID_JENIS_PERMOHONAN = C.ID_JENIS_PERMOHONAN ORDER BY A.TGL_PERMOHONAN DESC";
			$res = $this->db->query($sql);
			$no = 1;
			$table = '';
			foreach ($res->result() as $value) {
				// var_dump($value);exit;
				$table .= '<tr>';
				$table .= '<td>'.$no++.'</td>';
				$table .= '<td>'.$value->NRK.'</td>';
				$table .= '<td>'.$value->NAMA.'</td>';
				$table .= '<td>'.$value->TGL_PERMOHONAN.'</td>';
				$table .= '<td style="display:none">'.$value->ID_JENIS_PERMOHONAN.'</td>';
				$table .= '<td>'.$value->KET_JENIS_PERMOHONAN.'</td>';
				$table .= '<td><div style="cursor:pointer"><button class="btn btn-primary btn-xs" id="btn_detail" data-toggle="modal" data-target="#myModal"><i class="fa fa-external-link" aria-hidden="true"></i> List File</button></div></td>';
				$table .= '</tr>';
				// $no++;
			}
			// var_dump($res->result());exit;
			return $table;
		}

	}
