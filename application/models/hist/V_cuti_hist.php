<?php 

 class V_cuti_hist extends CI_Model {

    var $title   = '';
    var $content = '';
    var $date    = '';
    var $table = 'PERS_CUTI_HIST';
    function __construct()
    {        
        parent::__construct();
        $this->load->library('session');
    }
    
     public function save($data)
    {
        $NRK = $data['NRK'];
        $TMT = $data['TMT'];
        $JENCUTI = $data['JENCUTI'];
        $TGAKHIR = $data['TGAKHIR'];
        $NOSK = $data['NOSK'];
        $TGSK = $data['TGSK'];
        $PEJTT = $data['PEJTT'];
        $user_id = $data['user_id']; 
        $term = $data['term'];
        $now = $data['tg_upd']; 
        
        $sql = "INSERT INTO PERS_CUTI_HIST(NRK,TMT,JENCUTI,TGAKHIR,NOSK,TGSK,PEJTT,USER_ID,TERM,TG_UPD) 
                VALUES ('".$NRK."',TO_DATE('".$TMT."', 'DD-MM-YYYY'),".$JENCUTI.", TO_DATE('".$TGAKHIR."','DD-MM-YYYY'),'".$NOSK."', TO_DATE('".$TGSK."','DD-MM-YYYY'),".$PEJTT.",'".$user_id."','".$term."', TO_DATE('".$now."','YYYY-MM-DD HH:MI:SS'))";

        $id = $this->db->query($sql);
        return $id;
    }

    public function get_by_id($id1,$id2)
    {
        $sql= "SELECT * FROM PERS_CUTI_HIST WHERE NRK = '".$id1."' AND TMT =TO_DATE('".$id2."','DD-MM-YYYY')";
        $id = $this->db->query($sql)->row();
        return $id;
    }

    public function update($data)
    {
        $NRK = $data['NRK'];
        $TMT = $data['TMT'];
        $JENCUTI = $data['JENCUTI'];
        $TGAKHIR = $data['TGAKHIR'];
        $NOSK = $data['NOSK'];
        $TGSK = $data['TGSK'];
        $PEJTT = $data['PEJTT'];
        $user_id = $data['user_id']; 
        $term = $data['term'];
        $now = $data['tg_upd']; 
        
        $sql = "UPDATE PERS_CUTI_HIST SET JENCUTI =".$JENCUTI.", TGAKHIR = TO_DATE('".$TGAKHIR."','DD-MM-YYYY'),NOSK = '".$NOSK."',TGSK = TO_DATE('".$TGSK."','DD-MM-YYYY'),PEJTT = ".$PEJTT.", user_id = '".$user_id."',term = '".$term."', tg_upd = TO_DATE('".$now."','YYYY-MM-DD HH:MI:SS') WHERE NRK = '".$NRK."' AND TMT=TO_DATE('".$TMT."','DD-MM-YYYY')";

         $id = $this->db->query($sql);
        return $id;

    }

    public function delete_by_id($id,$id2)
    {
        $sql="DELETE FROM PERS_CUTI_HIST WHERE NRK ='".$id."'AND TMT=TO_DATE('".$id2."','DD-MM-YYYY')";
         $que = $this->db->query($sql);
        return $que;
    }

    function getListJencuti($jencuti=""){
        $sql = "SELECT JENCUTI, KETERANGAN FROM PERS_JENCUTI_RPT ORDER BY JENCUTI ASC ";
        $id = $this->db->query($sql);

        $option = "";
        foreach($id->result() as $row){
            if($jencuti == $row->JENCUTI){
                $option .= "<option selected value=".$row->JENCUTI.">".$row->JENCUTI." - ".$row->KETERANGAN."</option>";
            }else{
                $option .= "<option value=".$row->JENCUTI.">".$row->JENCUTI." - ".$row->KETERANGAN."</option>";
            }            
        }

        return $option;
    }

    function getListPejtt($pejtt=""){
        $sql = "SELECT PEJTT, KETERANGAN FROM PERS_PEJTT_RPT ORDER BY PEJTT ASC";
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
 
   
}

?>