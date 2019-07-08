<?php 

 class V_jabatan_hist extends CI_Model {

    var $title   = '';
    var $content = '';
    var $date    = '';

    function __construct()
    {        
        parent::__construct();
    }
    

    function get_data($whereid1, $whereid2, $whereid3, $whereid4)
    {

        $sql = "SELECT * FROM PERS_JABATAN_HIST";        
        $sql .= " WHERE NRK = '".$whereid1."' AND TMT ='".$whereid2."' AND KOLOK ='".$whereid3."' AND KOJAB='".$whereid4."'";
                
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
            $ESELON = $data['eselon'];
            $PEJTT = $data['pejtt'];
            $NOSK = $data['nosk'];
            $TGSK = $data['tgsk'];
            $KREDIT = $data['kredit'];
            $STATUS = $data['status'];
            $TG_UPD = date('Y-m-d h:i:s');
            $CKOJABF = $data['ckojabf'];
            $term="LOAD";      
        
        $sql = "INSERT INTO PERS_JABATAN_HIST(NRK,TMT,KOLOK,KOJAB,KDSORT,TGAKHIR,KOPANG,ESELON,PEJTT,NOSK,TGSK,KREDIT,STATUS,USER_ID,TERM,TG_UPD,CKOJABF) 
                VALUES ('".$NRK."',TO_DATE('".$TMT."', 'DD-MM-YYYY'),'".$KOLOK."','".$KOJAB."','".$KDSORT."',TO_DATE('".$TGAKHIR."', 'DD-MM-YY'),'".$KOPANG."','".$ESELON."',".$PEJTT.",
                  '".$NOSK."',TO_DATE('".$TGSK."', 'DD-MM-YYYY'),".$KREDIT.",".$STATUS.",'".$user['id']."','".$term."', TO_DATE('".$TG_UPD."', 'YYYY-MM-DD HH:MI:SS'),'".$CKOJABF."')"; 
       // echo $sql;
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
            $ESELON = $data['eselon'];
            $PEJTT = ($data['pejtt'] == '' ? 0 : $data['pejtt']);
            $NOSK = $data['nosk'];
            $TGSK = $data['tgsk'];
            $KREDIT = ($data['kredit'] == '' ? 0 : $data['kredit']);
            $STATUS = ($data['status'] == '' ? 0 : $data['status']);
            $TG_UPD = date('Y-m-d h:i:s');
            $CKOJABF = $data['ckojabf'];
            $term="LOAD";    
          
              
        
        $sql = "UPDATE PERS_JABATAN_HIST SET KDSORT = '".$KDSORT."',TGAKHIR = TO_DATE('".$TGAKHIR."', 'DD-MM-YYYY'), KOPANG = '".$KOPANG."',ESELON = '".$ESELON."',PEJTT = ".$PEJTT.",
                NOSK = '".$NOSK."',TGSK = TO_DATE('".$TGSK."', 'DD-MM-YYYY'),KREDIT = ".$KREDIT.",STATUS = ".$STATUS.",user_id='".$user['id']."',
                term='".$term."', TG_UPD = TO_DATE('".$TG_UPD."', 'YYYY-MM-DD HH:MI:SS'), CKOJABF = '".$CKOJABF."'
                WHERE NRK = '".$NRK."' AND TMT =TO_DATE('".$TMT."', 'DD-MM-YYYY') AND KOLOK='".$KOLOK."' AND KOJAB='".$KOJAB."'";

        $id = $this->db->query($sql);
        return $id;
        }else{
            redirect(base_url().'index.php/login', 'refresh');
        }  
    }


    function hapusData($id1,$id2,$id3,$id4){
        
        $sql = "DELETE FROM PERS_JABATAN_HIST WHERE NRK = '".$id1."' AND TMT='".$id2."' AND KOLOK='".$id3."' AND KOJAB='".$id4."'";

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

    function getListKojab($kolok, $kojab=""){
        $sql = "SELECT KOJAB, NAJABL FROM PERS_KOJAB_TBL WHERE KOLOK = '".$kolok."'";
        $id = $this->db->query($sql);

        $option = "<option></option>";
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

    function getListEselon($eselon=""){
        $sql = "SELECT ESELON, NESELON FROM PERS_ESELON_TBL";
        $id = $this->db->query($sql);

        $option = "";
        foreach($id->result() as $row){
            if($eselon == $row->ESELON){
                $option .= "<option selected value='".$row->ESELON."'>".$row->ESELON." - ".$row->NESELON."</option>";
            }else{
                $option .= "<option value='".$row->ESELON."'>".$row->ESELON." - ".$row->NESELON."</option>";
            }  
        }

        return $option;
    }

    

}

?>