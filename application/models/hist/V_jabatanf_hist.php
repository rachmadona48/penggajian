<?php 

 class V_jabatanf_hist extends CI_Model {

    var $title   = '';
    var $content = '';
    var $date    = '';

    function __construct()
    {        
        parent::__construct();
    }
    

    function get_data($whereid1, $whereid2, $whereid3)
    {

        $sql = "SELECT * FROM PERS_JABATANF_HIST";        
        $sql .= " WHERE NRK = '".$whereid1."' AND TMT ='".$whereid2."' AND KOJAB='".$whereid3."'";
                
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
            $KOLOK = $data['kolok'];
            $KOJAB = $data['kojab'];
            $KDSORT = $data['kdsort'];
            $TGAKHIR = $data['tgakhir'];
            $KOPANG = $data['kopang'];
            $PEJTT = $data['pejtt'];
            $NOSK = $data['nosk'];
            $TGSK = $data['tgsk'];
            $KREDIT = $data['kredit'];
            $STATUS = $data['status'];
            $TG_UPD = date('Y-m-d h:i:s');
            $term="LOAD";      
        
            $sql = "INSERT INTO PERS_JABATANF_HIST(NRK,TMT,KOLOK,KOJAB,KDSORT,TGAKHIR,KOPANG,PEJTT,NOSK,TGSK,KREDIT,STATUS,USER_ID,TERM,TG_UPD) 
                    VALUES ('".$NRK."',TO_DATE('".$TMT."', 'DD-MM-YYYY'),'".$KOLOK."','".$KOJAB."','".$KDSORT."',TO_DATE('".$TGAKHIR."', 'DD-MM-YYYY'),'".$KOPANG."',".$PEJTT.",
                      '".$NOSK."',TO_DATE('".$TGSK."', 'DD-MM-YYYY'),".$KREDIT.",".$STATUS.",'".$user['id']."','".$term."', TO_DATE('".$TG_UPD."', 'YYYY-MM-DD HH:MI:SS'))"; 

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
            $KOLOK = $data['kolok'];
            $KOJAB = $data['kojab'];
            $KDSORT = $data['kdsort'];
            $TGAKHIR = $data['tgakhir'];
            $KOPANG = $data['kopang'];
            $PEJTT = ($data['pejtt'] == '' ? 0 : $data['pejtt']);
            $NOSK = $data['nosk'];
            $TGSK = $data['tgsk'];
            $KREDIT = ($data['kredit'] == '' ? 0 : $data['kredit']);
            $STATUS = ($data['status'] == '' ? 0 : $data['status']);
            $TG_UPD = date('Y-m-d h:i:s');
            $term="LOAD";    
          
              
        
        $sql = "UPDATE PERS_JABATANF_HIST SET KOLOK='".$KOLOK."',KDSORT = '".$KDSORT."',TGAKHIR = TO_DATE('".$TGAKHIR."', 'DD-MM-YYYY'), KOPANG = '".$KOPANG."',PEJTT = ".$PEJTT.",
                NOSK = '".$NOSK."',TGSK = TO_DATE('".$TGSK."', 'DD-MM-YYYY'),KREDIT = ".$KREDIT.",STATUS = ".$STATUS.",user_id='".$user['id']."',
                term='".$term."', TG_UPD = TO_DATE('".$TG_UPD."', 'YYYY-MM-DD HH:MI:SS') 
                WHERE NRK = '".$NRK."' AND TMT =TO_DATE('".$TMT."', 'DD-MM-YYYY') AND KOJAB='".$KOJAB."'";

        $id = $this->db->query($sql);
        return $id;
        }else{
            redirect(base_url().'index.php/login', 'refresh');
        }  
    }


    function hapusData($id1,$id2,$id3){
        
        $sql = "DELETE FROM PERS_JABATANF_HIST WHERE NRK ='".$id1."' AND TMT='".$id2."' AND KOJAB='".$id3."'";
        $id = $this->db->query($sql);
       
        return $id;
    }


    function getListKolok($kolok=""){
        $sql = "SELECT KOLOK, NALOKL FROM PERS_LOKASI_TBL";
        $id = $this->db->query($sql);

        $option = "";
        foreach($id->result() as $row){
            if($kolok == $row->KOLOK){
                $option .= "<option selected value='".$row->KOLOK."'>".$row->KOLOK." - ".$row->NALOKL."</option>";
            }else{
                $option .= "<option value='".$row->KOLOK."'>".$row->KOLOK." - ".$row->NALOKL."</option>";
            }            
        }

        return $option;
    }

    function getListKojab($kojab=""){
        $sql = "SELECT KOJAB, NAJABL FROM PERS_KOJABF_TBL";
        $id = $this->db->query($sql);

        $option = "";
        foreach($id->result() as $row){
            if($kojab == $row->KOJAB){
                $option .= "<option selected value='".$row->KOJAB."'>".$row->KOJAB." - ".$row->NAJABL."</option>";
            }else{
                $option .= "<option value='".$row->KOJAB."'>".$row->KOJAB." - ".$row->NAJABL."</option>";
            }  
        }

        return $option;
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

}

?>