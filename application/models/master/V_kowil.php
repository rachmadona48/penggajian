<?php 

 class V_kowil extends CI_Model {

    var $title   = '';
    var $content = '';
    var $date    = '';
    var $table = 'PERS_KOWIL_TBL';
    function __construct()
    {        
        parent::__construct();
    }    

    function getnextval(){        
        $sql = "SELECT COUNT(*) exist 
                FROM all_objects
                WHERE object_type = 'SEQUENCE'  AND lower(object_name) = lower('seq_pers_kowil_rpt')";
        $query = $this->db->query($sql)->row();

        if($query->EXIST <= 0){
            $create = "CREATE SEQUENCE seq_pers_kowil_rpt";
            $this->db->query($create);

            $sql = "SELECT seq_pers_kowil_rpt.nextval FROM dual";
            $query = $this->db->query($sql)->row();
        }else{
            $sql = "SELECT seq_pers_kowil_rpt.nextval FROM dual";
            $query = $this->db->query($sql)->row();
        }

        return $query->NEXTVAL;
    }


    public function save($data)
    {
        $kowil = $data['kowil'];
        $nawil = $data['nawil'];
        $user_id = $data['user_id']; 
        $term=$data['term'];
        $now = $data['tg_upd']; 
        
        $sql = "INSERT INTO pers_kowil_tbl(kowil,nawil,user_id,term,tg_upd) 
                VALUES ('".$kowil."','".$nawil."','".$user_id."','".$term."', TO_DATE('".$now."', 'YYYY-MM-DD HH:MI:SS')) ";

        $id = $this->db->query($sql);
        return $id;
    }

    public function get_by_id($id)
    {
        $this->db->from($this->table);
        $this->db->where('KOWIL',$id);
        $query = $this->db->get();

        return $query->row();
    }

    public function update($data)
    {
        $kowil = $data['kowil'];
        $nawil = $data['nawil'];
        $user_id = $data['user_id']; 
        $term=$data['term'];
        $now = $data['tg_upd']; 
        
        $sql = "UPDATE pers_kowil_tbl SET kowil = '".$kowil."', nawil = '".$nawil."',user_id='".$user_id."',
                 term='".$term."',tg_upd = TO_DATE('".$now."', 'YYYY-MM-DD HH:MI:SS') WHERE kowil = '".$kowil."'";

         $id = $this->db->query($sql);
        return $id;

    }

    public function delete_by_id($id)
    {
        $sql="DELETE FROM pers_kowil_tbl WHERE kowil ='".$id."'";
         $id = $this->db->query($sql);
        return $id;
    }
}

?>