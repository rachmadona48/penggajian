<?php 

 class V_rb_gapok_hist extends CI_Model {

    var $title   = '';
    var $content = '';
    var $date    = '';

    function __construct()
    {        
        parent::__construct();
    }
    

    function get_data($whereid1, $whereid2, $whereid3)
    {

        $sql = "SELECT * FROM PERS_RB_GAPOK_HIST";        
        $sql .= " WHERE NRK = '".$whereid1."' AND TMT ='".$whereid2."' AND GAPOK='".$whereid3."'";
                
        $query = $this->db->query($sql);
        return $query;
    }

    function insertData($data){

        if ($this->session->userdata('logged_in')) {            

            $session_data       = $this->session->userdata('logged_in');
            $user['id']         = $session_data['id'];
            $user['username']   = $session_data['username'];

            $NRK = $data['nrk'];
            $TMT = $data['tmt'];
            $GAPOK = $data['gapok'];
            $JENRUB = $data['jenrub'];
            $KOPANG = $data['kopang'];
            $TTMASKER = $data['ttmasker'];
            $BBMASKER = $data['bbmasker'];
            $KOLOK = $data['kolok'];
            $NOSK = $data['nosk'];
            $TGSK = $data['tgsk'];
            $TTMASYAD = $data['ttmasyad'];
            $BBMASYAD = $data['bbmasyad'];
            $TG_UPD = date('Y-m-d h:i:s');
            $term="LOAD";      
        
        $sql = "INSERT INTO PERS_RB_GAPOK_HIST(NRK,TMT,GAPOK,JENRUB,KOPANG,TTMASKER,BBMASKER,KOLOK,NOSK,TGSK,TTMASYAD,BBMASYAD,USER_ID,TERM,TG_UPD) 
                VALUES ('".$NRK."',TO_DATE('".$TMT."', 'DD-MM-YYYY'),".$GAPOK.",".$JENRUB.",'".$KOPANG."',".$TTMASKER.",".$BBMASKER.",".$KOLOK.",
                  '".$NOSK."',TO_DATE('".$TGSK."', 'DD-MM-YYYY'),".$TTMASYAD.",".$BBMASYAD.",'".$user['id']."','".$term."', TO_DATE('".$TG_UPD."', 'YYYY-MM-DD HH:MI:SS'))"; 

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
            $TMT = $data['tmt'];
            $GAPOK = ($data['gapok'] == '' ? 0 : $data['gapok']);
            $JENRUB = ($data['jenrub'] == '' ? 0 : $data['jenrub']);
            $KOPANG = $data['kopang'];
            $TTMASKER = ($data['ttmasker'] == '' ? 0 : $data['ttmasker']);
            $BBMASKER = ($data['bbmasker'] == '' ? 0 : $data['bbmasker']);
            $KOLOK = $data['kolok'];
            $NOSK = $data['nosk'];
            $TGSK = $data['tgsk'];
            $TTMASYAD = ($data['ttmasyad'] == '' ? 0 : $data['ttmasyad']);
            $BBMASYAD = ($data['bbmasyad'] == '' ? 0 : $data['bbmasyad']);
            $TG_UPD = date('Y-m-d h:i:s');
            $term="LOAD";      
          
              
        
        $sql = "UPDATE PERS_RB_GAPOK_HIST SET JENRUB=".$JENRUB.",KOPANG = '".$KOPANG."',TTMASKER = ".$TTMASKER.", BBMASKER = ".$BBMASKER.",KOLOK = '".$KOLOK."',NOSK = '".$NOSK."',TGSK = TO_DATE('".$TGSK."','DD-MM-YYYY'),TTMASYAD = ".$TTMASYAD.",BBMASYAD = ".$BBMASYAD.",user_id='".$user['id']."',
                term='".$term."', TG_UPD = TO_DATE('".$TG_UPD."', 'YYYY-MM-DD HH:MI:SS') 
                WHERE NRK = '".$NRK."' AND TMT =TO_DATE('".$TMT."','DD-MM-YYYY') AND GAPOK=".$GAPOK."";

        $id = $this->db->query($sql);
        return $id;
        }else{
            redirect(base_url().'index.php/login', 'refresh');
        }  
    }


    function hapusData($id1,$id2,$id3){
        
        $sql = "DELETE FROM PERS_RB_GAPOK_HIST WHERE WHERE NRK = '".$id1."' AND TMT =TO_DATE('".$$id2."', 'DD-MM-YY') AND GAPOK=".$id3."";

        $id = $this->db->query($sql);
        return $id;
    }

     function getListKopang($kopang=""){
        $sql = "SELECT KOPANG, NAPANG FROM PERS_PANGKAT_TBL";
        $id = $this->db->query($sql);

        $option = "";
        foreach($id->result() as $row){
            if($kopang == $row->KOPANG){
                $option .= "<option selected value='".$row->KOPANG."'>".$row->KOPANG." - ".$row->NAPANG."</option>";
            }else{
                $option .= "<option value='".$row->KOPANG."'>".$row->KOPANG." - ".$row->NAPANG."</option>";
            }  
        }

        return $option;
    }

     function getListKolok($kolok=""){
        $sql = "SELECT KOLOK, NALOKS FROM PERS_LOKASI_TBL";
        $id = $this->db->query($sql);

        $option = "";
        foreach($id->result() as $row){
            if($kolok == $row->KOLOK){
                $option .= "<option selected value='".$row->KOLOK."'>".$row->KOLOK." - ".$row->NALOKS."</option>";
            }else{
                $option .= "<option value='".$row->KOLOK."'>".$row->KOLOK." - ".$row->NALOKS."</option>";
            }  
        }

        return $option;
    }

     function getListJenrub($jenrub=""){
        $sql = "SELECT JENRUB, KETERANGAN FROM PERS_JENRUB_RPT";
        $id = $this->db->query($sql);

        $option = "";
        foreach($id->result() as $row){
            if($jenrub == $row->JENRUB){
                $option .= "<option selected value=".$row->JENRUB.">".$row->JENRUB." - ".$row->KETERANGAN."</option>";
            }else{
                $option .= "<option value='".$row->JENRUB."'>".$row->JENRUB." - ".$row->KETERANGAN."</option>";
            }  
        }

        return $option;
    }

}

?>