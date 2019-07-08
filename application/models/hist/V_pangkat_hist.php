<?php 

 class V_pangkat_hist extends CI_Model {

    var $title   = '';
    var $content = '';
    var $date    = '';

    function __construct()
    {        
        parent::__construct();
    }
    

    function get_data($id1, $id2, $id3)
    {

        $sql = "SELECT * FROM PERS_PANGKAT_HIST";        
        $sql .= " WHERE NRK = '".$id1."' AND TMT ='".$id2."' AND KOPANG='".$id3."'";
                
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
            $KOPANG = $data['kopang'];
            $TTMASKER = $data['ttmasker'];
            $BBMASKER = $data['bbmasker'];
            $KOLOK = $data['kolok'];
            $GAPOK = $data['gapok'];
            $PEJTT = $data['pejtt'];
            $NOSK = $data['nosk'];
            $TGSK = $data['tgsk'];
            $TG_UPD = date('Y-m-d h:i:s');
            $term="LOAD";      
        
        $sql = "INSERT INTO PERS_PANGKAT_HIST(NRK,TMT,KOPANG,TTMASKER,BBMASKER,KOLOK,GAPOK,PEJTT,NOSK,TGSK,USER_ID,TERM,TG_UPD) 
                VALUES ('".$NRK."',TO_DATE('".$TMT."', 'DD-MM-YYYY'),'".$KOPANG."',".$TTMASKER.",".$BBMASKER.",'".$KOLOK."',".$GAPOK.",".$PEJTT.",
                  '".$NOSK."',TO_DATE('".$TGSK."', 'DD-MM-YYYY'),'".$user['id']."','".$term."', TO_DATE('".$TG_UPD."', 'YYYY-MM-DD HH:MI:SS'))"; 

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
            $KOPANG = $data['kopang'];
            $TTMASKER = ($data['ttmasker'] == '' ? 0 : $data['ttmasker']);
            $BBMASKER = ($data['bbmasker'] == '' ? 0 : $data['bbmasker']);
            $KOLOK = $data['kolok'];
            $GAPOK = ($data['gapok'] == '' ? 0 : $data['gapok']);
            $PEJTT = ($data['pejtt'] == '' ? 0 : $data['pejtt']);
            $NOSK = $data['nosk'];
            $TGSK = $data['tgsk'];
            $TG_UPD = date('Y-m-d h:i:s');
            $term="LOAD";     
          
              
        
        $sql = "UPDATE PERS_PANGKAT_HIST SET TTMASKER=".$TTMASKER.",BBMASKER = ".$BBMASKER.",KOLOK = '".$KOLOK."', GAPOK = ".$GAPOK.",PEJTT = ".$PEJTT.",
                NOSK = '".$NOSK."',TGSK = TO_DATE('".$TGSK."', 'DD-MM-YY'),user_id='".$user['id']."',term='".$term."', TG_UPD = TO_DATE('".$TG_UPD."', 'YYYY-MM-DD HH:MI:SS') 
                WHERE NRK = '".$NRK."' AND TMT =TO_DATE('".$TMT."', 'DD-MM-YY') AND KOPANG='".$KOPANG."'";

        $id = $this->db->query($sql);
        return $id;
        }else{
            redirect(base_url().'index.php/login', 'refresh');
        }  
    }


    function hapusData($id1,$id2,$id3){
        
        $sql = "DELETE FROM PERS_PANGKAT_HIST WHERE  NRK = '".$id1."' AND TMT ='".$id2."' AND KOPANG='".$id3."'";
    
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
    
    function getListPejtt($pejtt=""){
        $sql = "SELECT PEJTT, KETERANGAN FROM PERS_PEJTT_RPT";
        $id = $this->db->query($sql);

        $option = "";
        foreach($id->result() as $row){
            if($pejtt == $row->PEJTT){
                $option .= "<option selected value=".$row->PEJTT.">".$row->PEJTT." - ".$row->KETERANGAN."</option>";
            }else{
                $option .= "<option value=".$row->PEJTT.">".$row->PEJTT." - ".$row->KETERANGAN."</option>";
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

}

?>