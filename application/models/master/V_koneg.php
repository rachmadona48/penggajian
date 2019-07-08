<?php 

 class V_koneg extends CI_Model {

    var $title   = '';
    var $content = '';
    var $date    = '';
    var $table = 'PERS_NEGARA_TBL';
    function __construct()
    {        
        parent::__construct();
    }    


    public function save($data)
    {
        $koneg = $data['koneg'];
        $naneg = $data['naneg'];
        $user_id = $data['user_id']; 
        $term=$data['term'];
        $now = $data['tg_upd']; 
        
        $sql = "INSERT INTO pers_negara_tbl(koneg,naneg,user_id,term,tg_upd) 
                VALUES ('".$koneg."','".$naneg."','".$user_id."','".$term."', TO_DATE('".$now."', 'YYYY-MM-DD HH:MI:SS')) ";

        $id = $this->db->query($sql);
        return $id;
    }

    public function get_by_id($id)
    {
        $this->db->from($this->table);
        $this->db->where('KONEG',$id);
        $query = $this->db->get();

        return $query->row();
    }

    public function update($data)
    {
        $koneg = $data['koneg'];
        $naneg = $data['naneg'];
        $user_id = $data['user_id']; 
        $term=$data['term'];
        $now = $data['tg_upd']; 
        $sql = "UPDATE pers_negara_tbl SET naneg = '".$naneg."', user_id = '".$user_id."',term = '".$term."',   
                 tg_upd = TO_DATE('".$now."', 'YYYY-MM-DD HH:MI:SS') WHERE koneg = '".$koneg."'";

         $id = $this->db->query($sql);
        return $id;

    }

    public function delete_by_id($id)
    {
        $sql="DELETE FROM pers_negara_tbl WHERE koneg ='".$id."'";
         $id = $this->db->query($sql);
        return $id;
    }
}

?>