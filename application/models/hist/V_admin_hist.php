<?php 

 class V_admin_hist extends CI_Model {

    var $title   = '';
    var $content = '';
    var $date    = '';
    var $table = 'PERS_ADMIN_HIST';
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
        $JENHUKADM = $data['JENHUKADM'];
        $PEJTT = $data['PEJTT'];
        $user_id = $data['user_id']; 
        $term = $data['term'];
        $now = $data['tg_upd']; 
        
        $sql = "INSERT INTO PERS_ADMIN_HIST(NRK,TGSK,NOSK,JENHUKADM,PEJTT,USER_ID,TERM,TG_UPD) 
                VALUES ('".$NRK."',TO_DATE('".$TGSK."','DD-MM-YYYY'),'".$NOSK."',".$JENHUKADM.",".$PEJTT.",'".$user_id."','".$term."', TO_DATE('".$now."', 'YYYY-MM-DD HH:MI:SS')) ";

        $id = $this->db->query($sql);
        return $id;
    }

    public function get_by_id($id,$id2)
    {
        $sql= "SELECT * FROM PERS_ADMIN_HIST WHERE NRK = '".$id."' AND TGSK= TO_DATE('".$id2."','DD-MM-YYYY')";
		
        $id = $this->db->query($sql)->row();

        return $id;
    }

    public function update($data)
    {
        $NRK = $data['NRK'];
        $TGSK = $data['TGSK'];
        $NOSK = $data['NOSK'];
        $JENHUKADM = $data['JENHUKADM'];
        $PEJTT = $data['PEJTT'];
        $user_id = $data['user_id']; 
        $term = $data['term'];
        $now = $data['tg_upd'];
        
        $sql = "UPDATE PERS_ADMIN_HIST SET NOSK = '".$NOSK."',JENHUKADM = ".$JENHUKADM.",PEJTT = ".$PEJTT.", user_id = '".$user_id."',
                term = '".$term."', tg_upd = TO_DATE('".$now."', 'YYYY-MM-DD HH:MI:SS') WHERE NRK = '".$NRK."' AND TGSK=TO_DATE('".$TGSK."','DD-MM-YYYY')";
	
         $id = $this->db->query($sql);
        return $id;

    }

    public function delete_by_id($id,$id2)
    {
        $sql="DELETE FROM PERS_ADMIN_HIST WHERE NRK ='".$id."' AND TGSK=TO_DATE('".$id2."','DD-MM-YYYY')";
         $que = $this->db->query($sql);
        return $que;
    }

    function getListJenhukadm($jenhukadm=""){
        $sql = "SELECT JENHUKADM, KETERANGAN FROM PERS_JENHUKADM_RPT ";
        $id = $this->db->query($sql);

        $option = "";
        foreach($id->result() as $row){
            if($jenhukadm == $row->JENHUKADM){
                $option .= "<option selected value=".$row->JENHUKADM.">".$row->JENHUKADM." - ".$row->KETERANGAN."</option>";
            }else{
                $option .= "<option value=".$row->JENHUKADM.">".$row->JENHUKADM." - ".$row->KETERANGAN."</option>";
            }            
        }

        return $option;
    }
	
	function getListPejtt($pejtt=""){
        $sql = "SELECT PEJTT, KETERANGAN FROM PERS_PEJTT_RPT ORDER BY PEJTT ASC ";
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