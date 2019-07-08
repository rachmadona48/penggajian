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

$serverIP = $_SERVER["SERVER_ADDR"];
echo "Server IP is: <b>{$serverIP}</b>";
?>

<?php



date_default_timezone_set('Asia/Jakarta');
$date = date ('Y-m-d H-i-s');
$tgl = date('Y-m-d');
 
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
$query = ociparse($konek, $sql);
$result = ociexecute($query);
// var_dump($result);
$no =1;
while ($row =  oci_fetch_array($query)){

		// $nrk = ociresult($query,"NRK");
		// var_dump($row);
		// echo $row['NRK'];
		
		// echo "  ";
		$nrk = $row['NRK'];
		$tgska = $row['TGSK'];
		echo $nrk;
		echo "TO_DATE('".$tgska."','YYYY-MM-DD HH24:MI:SS')";
		// $karak = substr($nrk, 1,1);
		// echo " - ";
		// echo $karak;
		// echo " - ";
		// if($karak == 7){
		// 	echo "pass";
		// }elseif($karak == 8) {
		// 	echo "pass 2";
		// }else{
		// 	echo "tidak pass";
		// }
		// echo $nrk;
		// echo " karakter 1 dan 2 ";
		// echo " - ";
		// echo $karak;

$no++;
	}

// echo "update hukdis dan pangkat hist pada tanggal ";
// echo  $date;
?>

