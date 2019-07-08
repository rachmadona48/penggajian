<?php if(!defined('BASEPATH'))exit('No direct script access allowed');

class format_uang {

	function rp_dafault($angka)
	{
     	$jadi = number_format($angka,0,',','.');
    	return $jadi;
	}

	function rp_format($angka)
	{
	    $jadi = "Rp. " .number_format($angka , 0 , "" , '.') . ",-";
	    return $jadi;
	}
} 



 