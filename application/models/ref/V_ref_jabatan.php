<?php 

 class V_ref_jabatan extends CI_Model {

    var $title   = '';
    var $content = '';
    var $date    = '';

    function __construct()
    {        
        parent::__construct();
    }
    

    function getListKolok($kolok=""){
        $q="SELECT KOLOK,NALOKL FROM  PERS_LOKASI_TBL";
        $rs = $this->db->query($q)->result();

        return $rs;
    }
}

?>