<?php 

 class V_gapok extends CI_Model {

    var $title   = '';
    var $content = '';
    var $date    = '';
    var $table ='PERS_GAPOK_TBL';

    function __construct()
    {        
        parent::__construct();
        $this->load->library('session');
    }
    


   public function save($data)
    {
        $kopang = $data['KOPANG'];
        $ttmasker = $data['TTMASKER'];
        $bbmasker = $data['BBMASKER'];
        $gapok = $data['GAPOK'];
        $user_id = $data['user_id']; 
        $term=$data['term'];
        $now = $data['tg_upd'];
        
        $sql = "INSERT INTO PERS_GAPOK_TBL(KOPANG, TTMASKER, BBMASKER, GAPOK,USER_ID,TERM,TG_UPD) 
                VALUES ('".$kopang."',".$ttmasker.",".$bbmasker.",".$gapok.",'".$user_id."','".$term."', TO_DATE('".$now."', 'YYYY-MM-DD HH:MI:SS'))";

        $id = $this->db->query($sql);
        return $id;
    }

    public function get_by_id($id1,$id2,$id3)
    {
        $sql="SELECT * FROM PERS_GAPOK_TBL WHERE KOPANG='".$id1."' AND TTMASKER=".$id2."AND BBMASKER = ".$id3."";
        $id=$this->db->query($sql)->row();

        return $id;
    }

    public function update($data)
    {
        $kopang = $data['KOPANG'];
        $ttmasker = $data['TTMASKER'];
        $bbmasker = $data['BBMASKER'];
        $gapok = $data['GAPOK'];
        $user_id = $data['user_id']; 
        $term=$data['term'];
        $now = $data['tg_upd'];
        
        $sql = "UPDATE PERS_GAPOK_TBL SET GAPOK = ".$gapok.",USER_ID = '".$user_id."',TERM = '".$term."',
                 tg_upd = TO_DATE('".$now."', 'YYYY-MM-DD HH:MI:SS') WHERE KOPANG = '".$kopang."' AND TTMASKER = ".$ttmasker." AND BBMASKER = ".$bbmasker."";

         $id = $this->db->query($sql);
        return $id;

    }

    public function delete_by_id($id1,$id2,$id3)
    {
        $sql="DELETE FROM PERS_GAPOK_TBL WHERE KOPANG ='".$id1."' AND TTMASKER =".$id2." AND BBMASKER =".$id3."";
         $id = $this->db->query($sql);
        return $id;
    }

    

}

?>