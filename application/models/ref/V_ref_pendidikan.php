<?php 

 class V_ref_pendidikan extends CI_Model {

    var $title   = '';
    var $content = '';
    var $date    = '';

    function __construct()
    {        
        parent::__construct();
    }
    

    function getListJendik($jendik=""){
        $q="SELECT JENDIK,KETERANGAN FROM  PERS_JENDIK_RPT";
        $rs = $this->db->query($q)->result();

        return $rs;
    }
}

?>