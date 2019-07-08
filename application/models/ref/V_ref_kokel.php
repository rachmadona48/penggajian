<?php 

 class V_ref_kokel extends CI_Model {

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

        //return $rs;
        $option = "";
        foreach($rs as $row){
           
            $option .= "<option value='".$row->KOWIL."'>".$row->KOWIL." - ".$row->NAWIL."</option>";          
        }

        return $option;
    }

    function getListKocam($kowil,$kocam=""){
        $q="SELECT KOCAM,NACAM FROM  PERS_KOCAM_TBL WHERE KOWIL='".$kowil."'";
        $rs = $this->db->query($q)->result();
        //return $rs;
         $option = "<option></option>";
        foreach($rs as $row){
           
                $option .= "<option value='".$row->KOCAM."'>".$row->KOCAM." - ".$row->NACAM."</option>";
             
        }

        return $option;
        
    }
}

?>