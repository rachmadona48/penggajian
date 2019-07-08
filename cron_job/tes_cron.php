<?php
	$nama= "simpeg08"; //username 
	$pass= "p102simp"; //passwordna 
	$database="SIMPEG"; //db schema yang mo dipake 
	$host = "10.15.34.29"; //letak db oracle 
	$port = "1521"; //port default oracle ################################## 
	$db = "(DESCRIPTION=(ADDRESS_LIST=(ADDRESS=(PROTOCOL=TCP)(HOST=$host)(PORT=$port))) (CONNECT_DATA=(SERVER=DEDICATED)(SERVICE_NAME=$database)))" ; 
	$konek = oci_connect($nama,$pass,$db) ; 
	if (!$konek) { 
		echo "koneksi gagal"; 
	}else{
		echo "koneksi sukses"; 
	}
?>

<?php
// $serverIP = $_SERVER["SERVER_ADDR"];
// echo "Server IP is: <b>{$serverIP}</b>";
?>

<?php

date_default_timezone_set('Asia/Jakarta');
$date = date ('Y-m-d H-i-s');
$tgl = date ('Y-m-d H:i:s');
$tahun = date ('Y');
 
// $sql = "SELECT NRK 
// 		FROM PERS_DISIPLIN_HIST
// 		WHERE TGMULAI IS NOT NULL
// 		AND TGAKHIR IS NOT NULL";

$sql = "SELECT NRK, TGMULAI, TGAKHIR, SYSDATE AS TGL_SEKARANG, KET, JENHUKDIS,NOSK,TGSK
		FROM PERS_DISIPLIN_HIST
		WHERE TGAKHIR IS NOT NULL
		AND TGAKHIR < SYSDATE
		AND JENHUKDIS NOT IN ('0','1','2','3','4','5')
		AND STATUS_AKTIF = 'AKTIF' ";
// echo $sql;
echo "Batching pengembalian hukdis"; echo " pada tanggal : "; echo $date; echo '<br>';
$query = ociparse($konek, $sql);
$result = ociexecute($query);
// var_dump($result);
while ($row =  oci_fetch_array($query)){

		// $nrk = ociresult($query,"NRK");
		// var_dump($row);
		// echo $row['NRK'];
		
		// echo "  ";
		$nrk = $row['NRK'];
		$noska = $row['NOSK'];
		$tgska = $row['TGSK'];
		// echo $nrk;

		
		// update histori disiplin
		$update = " UPDATE PERS_DISIPLIN_HIST SET STATUS_AKTIF = 'NON AKTIF', TG_UPD = SYSDATE
					WHERE NRK = '".$nrk."' 
					AND JENHUKDIS NOT IN ('0','1','2','3','4','5') ";
		
		// echo "update disiplin";
		// echo $update;
		// $query1 = oci_parse($konek, $update);
		// $result1 = oci_execute($query1) or die(oci_error());

		$sql1 = "SELECT A.BBMASKER AS BBMASKER_LAST, A.TTMASKER AS TTMASKER_LAST,A.KOPANG AS KOPANG_LAST, B.* 
					FROM
					(
						SELECT * FROM  
						(
						SELECT * FROM PERS_PANGKAT_HIST WHERE NRK = '".$nrk."' ORDER BY TG_UPD DESC
						) WHERE ROWNUM =1 ORDER BY TG_UPD ASC
					) A
					LEFT JOIN
					(
						SELECT * FROM
							(
								SELECT * FROM  
								(
								SELECT * FROM PERS_PANGKAT_HIST WHERE NRK = '".$nrk."' ORDER BY TG_UPD DESC
								) WHERE ROWNUM <3 ORDER BY TG_UPD ASC
							)
							WHERE ROWNUM =1
					)B ON A.NRK = B.NRK ";

		// echo "cek dari pangkat hist";
		// echo $sql1;
		
		$query1 = ociparse($konek, $sql1);
		$result1 = ociexecute($query1);
		// var_dump($konek);

		while ($row1 =  oci_fetch_array($query1)){
			$nrk1 = $row1['NRK'];
			$tmt = $row1['TMT'];
			$kopang = $row1['KOPANG'];
			$KOPANG_LAST = $row1['KOPANG_LAST'];
			$ttmasker = $row1['TTMASKER'];
			$bbmasker = $row1['BBMASKER'];
			$kolok = $row1['KOLOK'];
			$gapok = $row1['GAPOK'];
			$pejtt = $row1['PEJTT'];
			$nosk = $row1['NOSK'];
			$tgsk = $row1['TGSK'];
			$user = 'SYSTEM';
			$term = $row1['TERM'];

			$bbmasker_last = $row1['BBMASKER_LAST'];
			$ttmasker_last = $row1['TTMASKER_LAST'];
			$jenhukdis = $row['JENHUKDIS'];

			echo " masa hukuman: ";
			echo $jenhukdis;
			echo " - ";
			
			echo " cek golongan SEBELUMNYA: ";
			$cek_gol = substr($kopang, 1,1);
			echo $cek_gol;
			echo " - ";

			echo " cek golongan SEKARANG: ";
			$cek_gol_last = substr($KOPANG_LAST, 1,1);
			echo $cek_gol_last;
			echo " - ";

			if ($cek_gol_last == 1 && $cek_gol == 2){
				$kode = 6;
			}elseif ($cek_gol_last == 2 && $cek_gol == 3) {
				$kode = 5;
			}else{
				$kode = 0;
			}

			echo " kopang : ";
			echo $kopang;
			echo " - ";

			if($jenhukdis=9){
				// echo $ttmasker_last; echo $ttmasker_last; echo "1";
				$ttmasker_fix = ($ttmasker_last+1)-$kode;
			}else{
				// echo $ttmasker_last; echo $ttmasker_last; echo "3";
				$ttmasker_fix = ($ttmasker_last+3)-$kode;
			}

			

			$insert = " INSERT INTO PERS_PANGKAT_HIST (NRK,TMT,KOPANG,TTMASKER,BBMASKER,KOLOK,GAPOK,PEJTT,NOSK,TGSK,USER_ID,TERM,TG_UPD)
						VALUES ('".$nrk1."',TO_DATE('".$tgl."', 'YYYY-MM-DD HH24:MI:SS'),'".$kopang."','".$ttmasker_fix."','".$bbmasker_last."','".$kolok."','".$gapok."','".$pejtt."','".$noska."',TO_DATE('".$tgska."','YYYY-MM-DD HH24:MI:SS'),'".$user."','LOAD',TO_DATE('".$tgl."', 'YYYY-MM-DD HH24:MI:SS')) ";	
			// echo "insert pangkat hist :";
			// echo $insert;
			// $query2 = ociparse($konek, $insert);
			// $result2 = ociexecute($query2);
			

		}

		$gapok = "SELECT *
					FROM
					(
						SELECT NRK,TMT,GAPOK,JENRUB,KOPANG,TTMASKER,BBMASKER,KOLOK,NOSK,TGSK,TTMASYAD,BBMASYAD,TERM,TG_UPD,KLOGAD,SPMU,TAHUN_REFGAJI,JENIS_SK,USER_ID
						FROM PERS_RB_GAPOK_HIST 
						WHERE TAHUN_REFGAJI <= '".$tahun."'
						AND NRK = '".$nrk."' AND ROWNUM <=2 ORDER BY TMT ASC
					)
					WHERE ROWNUM=1 ";
		// echo "cek gapok";
		// echo $gapok;
		$query3 = ociparse($konek, $gapok);
		$result3 = ociexecute($query3);

		while ($row3 =  oci_fetch_array($query3)){
			echo " insert gapok :";
			$tmt3 		= $row3['TMT'];
			$gapok_lama3= $row3['GAPOK'];
			$jenrub3	= $row3['JENRUB'];
			$kopang3	= $row3['KOPANG'];
			$ttmasker3	= $row3['TTMASKER'];
			$bbmasker3	= $row3['BBMASKER'];
			$kolok3		= $row3['KOLOK'];
			$nosk3		= $row3['NOSK'];
			$tgsk3		= $row3['TGSK'];
			$ttmsyad3	= $row3['TTMASYAD'];
			$bbmsyad3	= $row3['BBMASYAD'];
			$usr_id3	= $row3['USER_ID'];
			$term3		= $row3['TERM'];
			$tgl_upd3	= $row3['TG_UPD'];
			$klogad3	= $row3['KLOGAD'];

			// $kopang_new	= $row3['KOPANG_TBL_HIST'];
			// $ttmskr_new = $row3['TTMSKER_TBL_HIST'];
			// $bbmskr_new = $row3['BBMSKER_TBL_HIST'];
			// $gapok_new3 = $row3['GAPOK_NEW'];
			// echo $nrk;
			// echo " - ";
			// echo $tmt3;
			// echo " - kopang3 :";
			// echo $kopang3;
			// echo " - ttmasker3 :";
			// echo $ttmasker3;
			// echo " - gapok_lama3 :";
			// echo $gapok_lama3;

			$gapok5 = "SELECT MIN(KOPANG) AS KOPANG_MIN, MIN(TTMASKER) AS TTMASKER_MIN,MIN(BBMASKER) AS BBMASKER_MIN, GAPOK 
		                FROM PERS_GAPOK_TBL
		                WHERE KOPANG='".$kopang3."' AND TTMASKER>".$ttmasker3." AND GAPOK>".$gapok_lama3." AND ROWNUM=1
		                GROUP BY GAPOK 
		                ORDER BY MIN(KOPANG), MIN(TTMASKER), MIN(BBMASKER) ASC ";
			// echo "cek gapok";
			// echo $gapok;
			$query5 = ociparse($konek, $gapok5);
			$result5 = ociexecute($query5);

			while ($row5 =  oci_fetch_array($query5)){
				$KOPANG_MIN = $row5['KOPANG_MIN'];
				$TTMASKER_MIN = $row5['TTMASKER_MIN'];
				$BBMASKER_MIN = $row5['BBMASKER_MIN'];
				$GAPOK = $row5['GAPOK'];

				echo "KOPANG_MIN : ";
				echo $KOPANG_MIN;
				echo " - TTMASKER_MIN : ";
				echo $TTMASKER_MIN;
				echo " - BBMASKER_MIN : ";
				echo $BBMASKER_MIN;
				echo " - GAPOK : ";
				echo $GAPOK;
				echo '<br>';
			}


			// $gapok_new = " INSERT INTO PERS_RB_GAPOK_HIST (NRK,TMT,GAPOK,JENRUB,KOPANG,TTMASKER,BBMASKER,KOLOK,NOSK,TGSK,TTMASYAD,BBMASYAD,USER_ID,TERM,TG_UPD)
			// 			VALUES ('".$nrk."','".$tgl."','".$gapok_new3."','".$jenrub3."','".$kopang3."','".$ttmskr_new."','".$bbmskr_new."','".$kolok3."','".$nosk3."','".$tgsk3."','".$ttmsyad3."','".$bbmsyad3."','SYSTEM','LOAD',SYSDATE) ";	
			// echo $gapok_new;
			// echo "insert gapok";
			// $query4 = ociparse($konek, $gapok_new);
			// $result4 = ociexecute($query4);
			


		}

	}

// echo "update hukdis dan pangkat hist pada tanggal ";
// echo  $date;
?>

