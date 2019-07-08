<?php 

 class V_pendidikan_hist extends CI_Model {

    var $title   = '';
    var $content = '';
    var $date    = '';

    function __construct()
    {        
        parent::__construct();
    }
    

    function get_data($whereid1, $whereid2, $whereid3)
    {

        $sql = "SELECT * FROM PERS_PENDIDIKAN";        
        $sql .= " WHERE NRK = '".$whereid1."' AND JENDIK ='".$whereid2."' AND KODIK='".$whereid3."'";
                
        $query = $this->db->query($sql);
        return $query;
    }

    function insertData($data){

        if ($this->session->userdata('logged_in')) {            

            $session_data       = $this->session->userdata('logged_in');
            $user['id']         = $session_data['id'];
            $user['username']   = $session_data['username'];

            $NRK = $data['nrk'];
            $JENDIK = $data['jendik'];
            $KODIK = $data['kodik'];
            $NASEK = $data['nasek'];
            $UNIVER = $data['univer'];
            $KOTSEK = $data['kotsek'];
            $TGIJAZAH = $data['tgijazah'];
            $NOIJAZAH = $data['noijazah'];
            $TGACCKOP = $data['tgacckop'];
            $NOACCKOP = $data['noacckop'];
            $TGMULAI = $data['tgmulai'];
            $TGAKHIR = $data['tgakhir'];
            $JUMJAM = $data['jumjam'];
            $SELENGGARA = $data['selenggara'];
            $TG_UPD = date('Y-m-d h:i:s');
            $term="LOAD";  
            $ANGKATAN = $data['angkatan'];    
        
        $sql = "INSERT INTO PERS_PENDIDIKAN(NRK,JENDIK,KODIK,NASEK,UNIVER,KOTSEK,TGIJAZAH,NOIJAZAH,TGACCKOP,NOACCKOP,TGMULAI,TGAKHIR,JUMJAM,SELENGGARA,USER_ID,TERM,TG_UPD,ANGKATAN) 
                VALUES ('".$NRK."',".$JENDIK.",'".$KODIK."','".$NASEK."','".$UNIVER."','".$KOTSEK."',TO_DATE('".$TGIJAZAH."', 'DD-MM-YYYY'),'".$NOIJAZAH."',
                  TO_DATE('".$TGACCKOP."', 'DD-MM-YYYY'),TO_DATE('".$TGMULAI."', 'DD-MM-YYYY'),TO_DATE('".$TGAKHIR."', 'DD-MM-YYYY'),".$JUMJAM.",'".$SELENGGARA."','".$user['id']."','".$term."', TO_DATE('".$TG_UPD."', 'YYYY-MM-DD HH:MI:SS'),'".$ANGKATAN."')"; 

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
            $JENDIK = $data['jendik'];
            $KODIK = $data['kodik'];
            $NASEK = $data['nasek'];
            $UNIVER = $data['univer'];
            $KOTSEK = $data['kotsek'];
            $TGIJAZAH = $data['tgijazah'];
            $NOIJAZAH = $data['noijazah'];
            $TGACCKOP = $data['tgacckop'];
            $NOACCKOP = $data['noacckop'];
            $TGMULAI = $data['tgmulai'];
            $TGAKHIR = $data['tgakhir'];
            $JUMJAM = ($data['jumjam'] == '' ? 0 : $data['jumjam']);
            $SELENGGARA = $data['selenggara'];
            $TG_UPD = date('Y-m-d h:i:s');
            $term="LOAD";  
            $ANGKATAN = $data['angkatan'];     
          
              
        
        $sql = "UPDATE PERS_PENDIDIKAN SET NASEK='".$NASEK."',UNIVER = '".$UNIVER."',KOTSEK = '".$KOTSEK."', TGIJAZAH = '".$TGIJAZAH."',NOIJAZAH = ".$NOIJAZAH.",TGACCKOP = '".$TGACCKOP."',NOACCKOP = '".$NOACCKOP."',TGMULAI = '".$TGMULAI."',TGAKHIR = '".$TGAKHIR."',user_id='".$user['id']."',
                term='".$term."', TG_UPD = TO_DATE('".$TG_UPD."', 'YYYY-MM-DD HH:MI:SS'),ANGKATAN = '".$ANGKATAN."'
                WHERE NRK = '".$NRK."' AND JENDIK =".$JENDIK." AND KODIK='".$KODIK."'";

        $id = $this->db->query($sql);
        return $id;
        }else{
            redirect(base_url().'index.php/login', 'refresh');
        }  
    }


    function hapusData($id1,$id2,$id3){
        
        $sql = "DELETE FROM PERS_pendidikan_HIST WHERE WHERE NRK = '".$id1."' AND JENDIK =".$id2." AND KODIK='".$id3."'";

        $id = $this->db->query($sql);
        return $id;
    }

    
   /* function getListKodik($kodik=""){
        $sql = "SELECT KODIK, KETERANGAN FROM PERS_KODIK_RPT";
        $id = $this->db->query($sql);

        $option = "";
        foreach($id->result() as $row){
            if($kodik == $row->KODIK){
                $option .= "<option selected value='".$row->KODIK."'>".$row->KODIK." - ".$row->KETERANGAN."</option>";
            }else{
                $option .= "<option value='".$row->KODIK."'>".$row->KODIK." - ".$row->KETERANGAN."</option>";
            }            
        }

        return $option;
    }*/

     function getListJendik($jendik=""){
        $sql = "SELECT JENDIK, KETERANGAN FROM PERS_JENDIK_RPT";
        $id = $this->db->query($sql);

        $option = "";
        foreach($id->result() as $row){
            if($jendik == $row->JENDIK){
                $option .= "<option selected value='".$row->JENDIK."'>".$row->JENDIK." - ".$row->KETERANGAN."</option>";
            }else{
                $option .= "<option value='".$row->JENDIK."'>".$row->JENDIK." - ".$row->KETERANGAN."</option>";
            }            
        }

        return $option;
    }

    function getListUniver($univer=""){
        $sql = "SELECT KDUNIVER, NAUNIVER FROM PERS_UNIVER_TBL";
        $id = $this->db->query($sql);

        $option = "";
        foreach($id->result() as $row){
            if($univer == $row->KDUNIVER){
                $option .= "<option selected value='".$row->KDUNIVER."'>".$row->KDUNIVER." - ".$row->NAUNIVER."</option>";
            }else{
                $option .= "<option value='".$row->KDUNIVER."'>".$row->KDUNIVER." - ".$row->NAUNIVER."</option>";
            }            
        }

        return $option;
    }
}

?>