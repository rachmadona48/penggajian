<?php

function tesSelect(){
	// Connects to the XE service (i.e. database) on the "localhost" machine
	$conn = oci_connect('simpegdev', 'simpegdev', '10.15.3.74:1521/dbpemerintah');
	if (!$conn) {
		$e = oci_error();
		trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
	}

	$stid = oci_parse($conn, 'SELECT * FROM PERS_PEGAWAI1 WHERE ROWNUM <= 1');
	oci_execute($stid);

	echo "<table border='1'>\n";
	while ($row = oci_fetch_array($stid, OCI_ASSOC+OCI_RETURN_NULLS)) {
		echo "<tr>\n";
		foreach ($row as $item) {
			echo "    <td>" . ($item !== null ? htmlentities($item, ENT_QUOTES) : "&nbsp;") . "</td>\n";
		}
		echo "</tr>\n";
	}
	echo "</table>\n";

}