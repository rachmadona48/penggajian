<?php 

 class V_kunjung_hist extends CI_Model {

    var $title   = '';
    var $content = '';
    var $date    = '';
    var $table = 'PERS_KUNJUNG_HIST';
    function __construct()
    {        
        parent::__construct();
        $this->load->library('session');
    }
    
     public function save($data)
    {
        $NRK = $data['NRK'];
        $TGMULAI = $data['TGMULAI'];
        $KONEG = $data['KONEG'];
        $TUJUAN = $data['TUJUAN'];
        $TGAKHIR = $data['TGAKHIR'];
        $MEMBIAYAI = $data['MEMBIAYAI'];
        $user_id = $data['user_id']; 
        $term = $data['term'];
        $now = $data['tg_upd']; 
        
        $sql = "INSERT INTO PERS_KUNJUNG_HIST(NRK,TGMULAI,KONEG,TUJUAN,TGAKHIR,MEMBIAYAI,USER_ID,TERM,TG_UPD) 
                VALUES ('".$NRK."', TO_DATE('".$TGMULAI."','DD-MM-YYYY'),'".$KONEG."','".$TUJUAN."', TO_DATE('".$TGAKHIR."','DD-MM-YYYY'),".$MEMBIAYAI.",'".$user_id."','".$term."', TO_DATE('".$now."','YYYY-MM-DD HH:MI:SS'))";

        $id = $this->db->query($sql);
        return $id;
    }

    public function get_by_id($id1,$id2)
    {
        $sql= "SELECT * FROM PERS_KUNJUNG_HIST WHERE NRK = '".$id1."' AND TGMULAI= TO_DATE('".$id2."','DD-MM-YYYY')";
        $id = $this->db->query($sql)->row();
        return $id;
    }

    public function update($data)
    {
        $NRK = $data['NRK'];
        $TGMULAI = $data['TGMULAI'];
        $KONEG = $data['KONEG'];
        $TUJUAN = $data['TUJUAN'];
        $TGAKHIR = $data['TGAKHIR'];
        $MEMBIAYAI = $data['MEMBIAYAI'];
        $user_id = $data['user_id']; 
        $term = $data['term'];
        $now = $data['tg_upd'];
        
        $sql = "UPDATE PERS_KUNJUNG_HIST SET KONEG = '".$KONEG."',TUJUAN = '".$TUJUAN."',TGAKHIR = TO_DATE('".$TGAKHIR."','DD-MM-YYYY'),MEMBIAYAI = ".$MEMBIAYAI.", user_id = '".$user_id."',term = '".$term."', tg_upd = TO_DATE('".$now."','YYYY-MM-DD HH:MI:SS') WHERE NRK = '".$NRK."' AND TGMULAI=TO_DATE('".$TGMULAI."','DD-MM-YYYY')";

         $id = $this->db->query($sql);
        return $id;

    }

    public function delete_by_id($id1,$id2)
    {
        $sql="DELETE FROM PERS_KUNJUNG_HIST WHERE NRK ='".$id1."' AND TGMULAI=TO_DATE('".$id2."','DD-MM-YYYY')";
         $que = $this->db->query($sql);
        return $que;
    }

    function getListKoneg($koneg=""){
        $sql = "SELECT KONEG, NANEG FROM PERS_NEGARA_TBL ORDER BY KONEG ASC";
        $id = $this->db->query($sql);

        $option = "";
        foreach($id->result() as $row){
            if($koneg == $row->KONEG){
                $option .= "<option selected value='".$row->KONEG."'>".$row->KONEG." - ".$row->NANEG."</option>";
            }else{
                $option .= "<option value='".$row->KONEG."'>".$row->KONEG." - ".$row->NANEG."</option>";
            }            
        }

        return $option;
    }
    
}

?>