<?php 

 class V_tulisan_hist extends CI_Model {

    var $title   = '';
    var $content = '';
    var $date    = '';

    function __construct()
    {        
        parent::__construct();
    }
    

    function get_data($whereid1, $whereid2)
    {

        $sql = "SELECT * FROM PERS_tulisan_HIST";        
        $sql .= " WHERE NRK = '".$whereid1."' AND tgpublik ='".$whereid2."'";
                
        $query = $this->db->query($sql);
        return $query;
    }

    function insertData($data){

        if ($this->session->userdata('logged_in')) {            

            $session_data       = $this->session->userdata('logged_in');
            $user['id']         = $session_data['id'];
            $user['username']   = $session_data['username'];

            $NRK = $data['nrk'];
            $TGPUBLIK = $data['tgpublik'];
            $JUDUL = $data['judul'];
            $KDTEMA = $data['kdtema'];
            $KDSIFAT = $data['kdsifat'];
            $MEDPUBLIK = $data['medpublik'];
            $KDLINGKUP = $data['kdlingkup'];
            $KDJUMKATA = $data['kdjumkata'];
            $KDPERAN = $data['kdperan'];
           
            $TG_UPD = date('Y-m-d h:i:s');
            $term="LOAD";      
        
        $sql = "INSERT INTO PERS_TULISAN_HIST(NRK,TGPUBLIK,JUDUL,KDTEMA,KDSIFAT,MEDPUBLIK,KDLINGKUP,KDJUMKATA,KDPERAN,USER_ID,TERM,TG_UPD) 
                VALUES ('".$NRK."',TO_DATE('".$TGPUBLIK."', 'DD-MM-YYYY'),'".$JUDUL."','".$KDTEMA."',".$KDSIFAT.",'".$MEDPUBLIK."',".$KDLINGKUP.",".$KDJUMKATA.",'".$KDPERAN."','".$user['id']."','".$term."', TO_DATE('".$TG_UPD."', 'YYYY-MM-DD HH:MI:SS'))"; 

        $id = $this->db->query($sql);
        return $id;
        }else{
            redirect(base_url().'index.php/login', 'refresh');
        }  
    }

    function updateData($data){
        if ($this->session->userdata('logged_in')) {            

            $session_data       = $this->session->userdata('logged_in');
            $user['id']         = $session_data['id'];
            $user['username']   = $session_data['username'];

            $NRK = $data['nrk'];
            $TGPUBLIK = $data['tgpublik'];
            $JUDUL = $data['judul'];
            $KDTEMA = $data['kdtema'];
            $KDSIFAT = ($data['kdsifat'] == '' ? 0 : $data['kdsifat']);
            $MEDPUBLIK = $data['medpublik'];
            $KDLINGKUP =  ($data['kdlingkup'] == '' ? 0 : $data['kdlingkup']);
            $KDJUMKATA =  ($data['kdjumkata'] == '' ? 0 : $data['kdjumkata']);
            $KDPERAN = $data['kdperan'];
           
            $TG_UPD = date('Y-m-d h:i:s');
            $term="LOAD";
          
              
        
        $sql = "UPDATE PERS_TULISAN_HIST SET JUDUL='".$JUDUL."',KDTEMA = '".$KDTEMA."',KDSIFAT = ".$KDSIFAT.", MEDPUBLIK = '".$MEDPUBLIK."',KDLINGKUP = ".$KDLINGKUP.",KDJUMKATA = ".$KDJUMKATA.",KDPERAN = '".$KDPERAN."',user_id='".$user['id']."',
                term='".$term."', TG_UPD = TO_DATE('".$TG_UPD."', 'YYYY-MM-DD HH:MI:SS') 
                WHERE NRK = '".$NRK."' AND TGPUBLIK =TO_DATE('".$TGPUBLIK."', 'DD-MM-YYYY')";

        $id = $this->db->query($sql);
        return $id;
        }else{
            redirect(base_url().'index.php/login', 'refresh');
        }  
    }


    function hapusData($id1,$id2){
        
        $sql = "DELETE FROM PERS_TULISAN_HIST WHERE WHERE NRK = '".$id1."' AND TGPUBLIK ='".$id2."'";

        $id = $this->db->query($sql);
        return $id;
    }

    
     function getListKdtema($kdtema=""){
        $sql = "SELECT KDTEMA, NATEMA FROM PERS_TEMA_TBL";
        $id = $this->db->query($sql);

        $option = "";
        foreach($id->result() as $row){
            if($kdtema == $row->KDTEMA){
                $option .= "<option selected value='".$row->KDTEMA."'>".$row->KDTEMA." - ".$row->NATEMA."</option>";
            }else{
                $option .= "<option value='".$row->KDTEMA."'>".$row->KDTEMA." - ".$row->NATEMA."</option>";
            }  
        }

        return $option;
    }

    function getListKdsifat($kdsifat=""){
        $sql = "SELECT KDSIFAT, KETERANGAN FROM PERS_KDSIFAT_RPT";
        $id = $this->db->query($sql);

        $option = "";
        foreach($id->result() as $row){
            if($kdsifat == $row->KDSIFAT){
                $option .= "<option selected value='".$row->KDSIFAT."'>".$row->KDSIFAT." - ".$row->KETERANGAN."</option>";
            }else{
                $option .= "<option value='".$row->KDSIFAT."'>".$row->KDSIFAT." - ".$row->KETERANGAN."</option>";
            }  
        }

        return $option;
    }

    function getListKdlingkup($kdlingkup=""){
        $sql = "SELECT KDLINGKUP, KETERANGAN FROM PERS_KDLINGKUP_RPT";
        $id = $this->db->query($sql);

        $option = "";
        foreach($id->result() as $row){
            if($kdlingkup == $row->KDLINGKUP){
                $option .= "<option selected value='".$row->KDLINGKUP."'>".$row->KDLINGKUP." - ".$row->KETERANGAN."</option>";
            }else{
                $option .= "<option value='".$row->KDLINGKUP."'>".$row->KDLINGKUP." - ".$row->KETERANGAN."</option>";
            }  
        }

        return $option;
    }

    function getListKdjumkata($kdjumkata=""){
        $sql = "SELECT KDJUMKATA, KETERANGAN FROM PERS_KDJUMKATA_RPT";
        $id = $this->db->query($sql);

        $option = "";
        foreach($id->result() as $row){
            if($kdjumkata == $row->KDJUMKATA){
                $option .= "<option selected value='".$row->KDJUMKATA."'>".$row->KDJUMKATA." - ".$row->KETERANGAN."</option>";
            }else{
                $option .= "<option value='".$row->KDJUMKATA."'>".$row->KDJUMKATA." - ".$row->KETERANGAN."</option>";
            }  
        }

        return $option;
    }

    function getListKdperan($kdperan=""){
        $sql = "SELECT KDPERAN, KETERANGAN FROM PERS_KDPERANT_RPT";
        $id = $this->db->query($sql);

        $option = "";
        foreach($id->result() as $row){
            if($kdperan == $row->KDPERAN){
                $option .= "<option selected value='".$row->KDPERAN."'>".$row->KDPERAN." - ".$row->KETERANGAN."</option>";
            }else{
                $option .= "<option value='".$row->KDPERAN."'>".$row->KDPERAN." - ".$row->KETERANGAN."</option>";
            }  
        }

        return $option;
    }
}

?>