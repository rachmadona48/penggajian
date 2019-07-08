<?php 

 class V_kopang extends CI_Model {

    var $title   = '';
    var $content = '';
    var $date    = '';
    var $table = 'PERS_PANGKAT_TBL';
    function __construct()
    {        
        parent::__construct();
    }    


    public function save($data)
    {
        $kopang = $data['kopang'];
        $gol = $data['gol'];
        $napang = $data['napang'];
        $user_id = $data['user_id']; 
        $kopang_pns = $data['kopang_pns'];
        $term=$data['term'];
        $now = $data['tg_upd']; 
        
        $sql = "INSERT INTO pers_pangkat_tbl(kopang,gol,napang,user_id,kopang_pns,term,tg_upd) 
                VALUES ('".$kopang."','".$gol."','".$napang."','".$user_id."','".$kopang_pns."','".$term."', TO_DATE('".$now."', 'YYYY-MM-DD HH:MI:SS')) ";

        $id = $this->db->query($sql);
        return $id;
    }

    public function get_by_id($id)
    {
        $this->db->from($this->table);
        $this->db->where('KOPANG',$id);
        $query = $this->db->get();

        return $query->row();
    }

    public function update($data)
    {
        $kopang = $data['kopang'];
        $gol = $data['gol'];
        $napang = $data['napang'];
        $user_id = $data['user_id']; 
        $kopang_pns = $data['kopang_pns'];
        $term=$data['term'];
        $now = $data['tg_upd']; 
        $sql = "UPDATE pers_pangkat_tbl SET gol = '".$gol."',napang = '".$napang."', user_id = '".$user_id."',kopang_pns = '".$kopang_pns."',term = '".$term."',   
                 tg_upd = TO_DATE('".$now."', 'YYYY-MM-DD HH:MI:SS') WHERE kopang = '".$kopang."'";

         $id = $this->db->query($sql);
        return $id;

    }

    public function delete_by_id($id)
    {
        $sql="DELETE FROM pers_pangkat_tbl WHERE kopang ='".$id."'";
         $id = $this->db->query($sql);
        return $id;
    }
}

?>