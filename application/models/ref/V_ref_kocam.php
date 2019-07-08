<?php 

 class V_ref_kocam extends CI_Model {

    var $title   = '';
    var $content = '';
    var $date    = '';

    function __construct()
    {        
        parent::__construct();
    }
    

    function getListKowil($kowil=""){
        $q="SELECT KOWIL,NAWIL FROM  PERS_KOWIL_TBL";
        $rs = $this->db->query($q)->result();

        return $rs;
    }
}

?>