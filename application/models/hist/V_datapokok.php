<?php 

 class V_datapokok extends CI_Model {

    var $title   = '';
    var $content = '';
    var $date    = '';

    function __construct()
    {        
        parent::__construct();
    }

    function getKolok(){
        $q="SELECT kolok,nalokl FROM  pers_lokasi_tbl WHERE aktif = '1' order by nalokl";
        $rs = $this->db->query($q)->result();

        return $rs;
    }

     function getAll($kolok='', $thbl=''){
         $q = "SELECT pers_kojab_tbl.najabl, pers_duk_pangkat_histduk.nrk, pers_duk_pangkat_histduk.nama,
                      pers_duk_pangkat_histduk.pathir, pers_duk_pangkat_histduk.talhir, pers_duk_pangkat_histduk.eselon,
                      pers_duk_pangkat_histduk.kopang
		          FROM  pers_duk_pangkat_histduk LEFT OUTER JOIN
							  pers_kojab_tbl ON pers_duk_pangkat_histduk.kolok = pers_kojab_tbl.kolok AND
							  pers_duk_pangkat_histduk.kojab = pers_kojab_tbl.kojab
		          WHERE     (pers_duk_pangkat_histduk.klogad = '$kolok' and pers_duk_pangkat_histduk.thbl = '$thbl')
		          ORDER BY pers_duk_pangkat_histduk.klogad, pers_duk_pangkat_histduk.kojab, pers_duk_pangkat_histduk.eselon,
                      pers_duk_pangkat_histduk.kopang, pers_duk_pangkat_histduk.thbl";
         $rs = $this->db->query($q)->result();

         return $rs;
     }

    

}

?>