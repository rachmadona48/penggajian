<?php 

 class V_kocam extends CI_Model {

    var $title   = '';
    var $content = '';
    var $date    = '';
    var $table = 'PERS_KOCAM_TBL';
    function __construct()
    {        
        parent::__construct();

            
    }        

    public function save($data)
    {
        $kowil=$data['KOWIL'];
        $kocam=$data['KOCAM'];
        $nacam=$data['NACAM'];
        $user_id = $data['user_id']; 
        $term=$data['term'];
        $now = $data['tg_upd'];
       
        
        $sql = "INSERT INTO PERS_KOCAM_TBL(KOWIL,KOCAM,NACAM,USER_ID,TERM,TG_UPD) 
                VALUES (".$kowil.",'".$kocam."','".$nacam."','".$user_id."','".$term."', TO_DATE('".$now."', 'YYYY-MM-DD HH:MI:SS'))";
               
        $id = $this->db->query($sql);
        return $id;
    }

    public function get_by_id($id1,$id2)
    {
        $sql = "SELECT * FROM PERS_KOCAM_TBL WHERE KOWIL = ".$id1." AND KOCAM = '".$id2."'";
        $id = $this->db->query($sql)->row();
        return $id;
    }

    public function update($data)
    {
        $kowil=$data['KOWIL'];
        $kocam=$data['KOCAM'];
        $nacam=$data['NACAM'];
        $user_id = $data['user_id']; 
        $term=$data['term'];
        $now = $data['tg_upd'];
        
        $sql = "UPDATE PERS_KOCAM_TBL SET  nacam = '".$nacam."',user_id = '".$user_id."',term = '".$term."',
                 tg_upd = TO_DATE('".$now."', 'YYYY-MM-DD HH:MI:SS') WHERE KOWIL = ".$kowil." AND KOCAM ='".$kocam."'";

         $id = $this->db->query($sql);
        return $id;

    }

    public function delete_by_id($id1,$id2)
    {
        $sql="DELETE FROM PERS_KOCAM_TBL WHERE KOWIL =".$id1." AND KOCAM ='".$id2."'";
         $id = $this->db->query($sql);
        return $id;
    }

}

?>