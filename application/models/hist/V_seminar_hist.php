<?php 

 class V_seminar_hist extends CI_Model {

    var $title   = '';
    var $content = '';
    var $date    = '';

    function __construct()
    {        
        parent::__construct();
    }
    

    function get_data($whereid1, $whereid2)
    {

        $sql = "SELECT * FROM PERS_SEMINAR_HIST";        
        $sql .= " WHERE NRK = '".$whereid1."' AND TGMULAI ='".$whereid2."'";
                
        $query = $this->db->query($sql);
        return $query;
    }

    function insertData($data){

        if ($this->session->userdata('logged_in')) {            

            $session_data       = $this->session->userdata('logged_in');
            $user['id']         = $session_data['id'];
            $user['username']   = $session_data['username'];

            $NRK = $data['nrk'];
            $TGMULAI = $data['tgmulai'];
            $TGSELESAI = $data['tgselesai'];
            $NASEMI = $data['nasemi'];
            $KDSEMI = $data['kdsemi'];
            $KDTEMA = $data['kdtema'];
            $BADAN = $data['badan'];
            $TEMPAT = $data['tempat'];
            $KDPERAN = $data['kdperan'];
            
            $TG_UPD = date('Y-m-d h:i:s');
            $term="LOAD";      
        
        $sql = "INSERT INTO PERS_SEMINAR_HIST(NRK,TGMULAI,TGSELESAI,NASEMI,KDSEMI,KDTEMA,BADAN,TEMPAT,KDPERAN,USER_ID,TERM,TG_UPD) 
                VALUES ('".$NRK."',TO_DATE('".$TGMULAI."','DD-MM-YYYY'),TO_DATE('".$TGSELESAI."','DD-MM-YYYY'),'".$NASEMI."',".$KDSEMI.",'".$KDTEMA."','".$BADAN."','".$TEMPAT."',
                  '".$KDPERAN."','".$user['id']."','".$term."', TO_DATE('".$TG_UPD."', 'YYYY-MM-DD HH:MI:SS'))"; 

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
            $TGMULAI = $data['tgmulai'];
            $TGSELESAI = $data['tgselesai'];
            $NASEMI = $data['nasemi'];
            $KDSEMI = ($data['kdsemi'] == '' ? 0 : $data['kdsemi']);
            $KDTEMA = $data['kdtema'];
            $BADAN = $data['badan'];
            $TEMPAT = $data['tempat'];
            $KDPERAN = $data['kdperan'];
            
            $TG_UPD = date('Y-m-d h:i:s');
            $term="LOAD";      
              
        
        $sql = "UPDATE PERS_SEMINAR_HIST SET TGSELESAI=TO_DATE('".$TGSELESAI."','DD-MM-YYYY'),NASEMI = '".$NASEMI."',KDSEMI = ".$KDSEMI.", KDTEMA = '".$KDTEMA."',BADAN = '".$BADAN."',
                TEMPAT = '".$TEMPAT."',KDPERAN = '".$KDPERAN."',user_id='".$user['id']."',term='".$term."', TG_UPD = TO_DATE('".$TG_UPD."', 'YYYY-MM-DD HH:MI:SS') 
                WHERE NRK = '".$NRK."' AND TGMULAI =TO_DATE('".$TGMULAI."','DD-MM-YYYY')";

        $id = $this->db->query($sql);
        return $id;
        }else{
            redirect(base_url().'index.php/login', 'refresh');
        }  
    }


    function hapusData($id1,$id2){
        
        $sql = "DELETE FROM PERS_SEMINAR_HIST WHERE WHERE NRK = '".$id1."' AND TGMULAI ='".$id2."'";

        $id = $this->db->query($sql);
        return $id;
    }

    function getListKdsemi($kdsemi=""){
        $sql = "SELECT KDSEMI, KETERANGAN FROM PERS_KDSEMI_RPT";
        $id = $this->db->query($sql);

        $option = "";
        foreach($id->result() as $row){
            if($kdsemi == $row->KDSEMI){
                $option .= "<option selected value='".$row->KDSEMI."'>".$row->KDSEMI." - ".$row->KETERANGAN."</option>";
            }else{
                $option .= "<option value='".$row->KDSEMI."'>".$row->KDSEMI." - ".$row->KETERANGAN."</option>";
            }  
        }

        return $option;
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

    function getListKdperan($kdperan=""){
        $sql = "SELECT KDPERAN, KETERANGAN FROM PERS_KDPERANS_RPT";
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