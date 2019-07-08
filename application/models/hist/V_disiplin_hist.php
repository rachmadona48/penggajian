<?php 

 class V_disiplin_hist extends CI_Model {

    var $title   = '';
    var $content = '';
    var $date    = '';
    var $table = 'PERS_DISIPLIN_HIST';
    function __construct()
    {        
        parent::__construct();
        $this->load->library('session');
    }
    
     public function save($data)
    {
        $NRK = $data['NRK'];
        $TGSK = $data['TGSK'];
        $NOSK = $data['NOSK'];
        $JENHUKDIS = $data['JENHUKDIS'];
        $TGMULAI = $data['TGMULAI'];
        $TGAKHIR = $data['TGAKHIR'];
        $PEJTT = $data['PEJTT'];
        $USER_ID = $data['user_id']; 
        $TERM = $data['term'];
        $NOW = $data['tg_upd']; 
        
        $sql = "INSERT INTO PERS_DISIPLIN_HIST(NRK,TGSK,NOSK,JENHUKDIS,TGMULAI,TGAKHIR,PEJTT,USER_ID,TERM,TG_UPD) 
                VALUES ('".$NRK."', TO_DATE('".$TGSK."','DD-MM-YY'),'".$NOSK."',".$JENHUKDIS.", TO_DATE('".$TGMULAI."','DD-MM-YYYY'), TO_DATE('".$TGAKHIR."', 'DD-MM-YYYY'),".$PEJTT.",'".$USER_ID."','".$TERM."', TO_DATE('".$NOW."','YYYY-MM-DD HH:MI:SS')) ";

        $id = $this->db->query($sql);
        return $id;
    }

    public function get_by_id($id,$id2)
    {
        $sql= "SELECT * FROM PERS_DISIPLIN_HIST WHERE NRK = '".$id."'AND TGSK=TO_DATE('".$id2."','DD-MM-YYYY')";
        $id = $this->db->query($sql)->row();
        return $id;
    }

    public function update($data)
    {
        $NRK = $data['NRK'];
        $TGSK = $data['TGSK'];
        $NOSK = $data['NOSK'];
        $JENHUKDIS = $data['JENHUKDIS'];
        $TGMULAI = $data['TGMULAI'];
        $TGAKHIR = $data['TGAKHIR'];
        $PEJTT = $data['PEJTT'];
        $USER_ID = $data['user_id']; 
        $TERM = $data['term'];
        $NOW = $data['tg_upd']; 
        
        $sql = "UPDATE PERS_DISIPLIN_HIST SET NOSK = '".$NOSK."',JENHUKDIS = ".$JENHUKDIS.",TGMULAI =TO_DATE('".$TGMULAI."','DD-MM-YYYY'),TGAKHIR =TO_DATE('".$TGAKHIR."','DD-MM-YYYY'),PEJTT = ".$PEJTT.", USER_ID = '".$USER_ID."',TERM = '".$TERM."', TG_UPD = TO_DATE('".$NOW."','YYYY-MM-DD HH:MI:SS') WHERE NRK = '".$NRK."' AND TGSK=TO_DATE('".$TGSK."','DD-MM-YYYY')";

         $id = $this->db->query($sql);
        return $id;

    }

    public function delete_by_id($id1,$id2)
    {
        $sql="DELETE FROM PERS_DISIPLIN_HIST WHERE NRK ='".$id1."' AND TGSK= TO_DATE('".$id2."', 'DD-MM-YYYY') ";
         $que = $this->db->query($sql);
        return $que;
    }

     function getListJenhukdis($jenhukdis=""){
        $sql = "SELECT JENHUKDIS, KETERANGAN FROM PERS_JENHUKDIS_RPT ORDER BY JENHUKDIS ASC";
        $id = $this->db->query($sql);

        $option = "";
        foreach($id->result() as $row){
            if($jenhukdis == $row->JENHUKDIS){
                $option .= "<option selected value='".$row->JENHUKDIS."'>".$row->JENHUKDIS." - ".$row->KETERANGAN."</option>";
            }else{
                $option .= "<option value='".$row->JENHUKDIS."'>".$row->JENHUKDIS." - ".$row->KETERANGAN."</option>";
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
                $option .= "<option selected value='".$row->PEJTT."'>".$row->PEJTT." - ".$row->KETERANGAN."</option>";
            }else{
                $option .= "<option value='".$row->PEJTT."'>".$row->PEJTT." - ".$row->KETERANGAN."</option>";
            }  
        }

        return $option;
    }

   
}

?>