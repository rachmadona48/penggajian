<?php 

 class V_universitas extends CI_Model {

    var $title   = '';
    var $content = '';
    var $date    = '';
    var $table = 'PERS_UNIVER_TBL';
    function __construct()
    {        
        parent::__construct();
    }    


    public function save($data)
    {
        $kduniver = $data['kduniver'];
        $nauniver = $data['nauniver'];
        $user_id = $data['user_id']; 
        $term=$data['term'];
        $now = $data['tg_upd']; 
        
        $sql = "INSERT INTO pers_univer_tbl(kduniver,nauniver,user_id,term,tg_upd) 
                VALUES ('".$kduniver."','".$nauniver."','".$user_id."','".$term."', TO_DATE('".$now."', 'YYYY-MM-DD HH:MI:SS')) ";

        $id = $this->db->query($sql);
        return $id;
    }

    public function get_by_id($id)
    {
        $this->db->from($this->table);
        $this->db->where('KDUNIVER',$id);
        $query = $this->db->get();

        return $query->row();
    }

    public function update($data)
    {
        $kduniver = $data['kduniver'];
        $nauniver = $data['nauniver'];
        $user_id = $data['user_id']; 
        $term=$data['term'];
        $now = $data['tg_upd']; 
        $sql = "UPDATE pers_univer_tbl SET nauniver = '".$nauniver."', user_id = '".$user_id."',term = '".$term."',   
                 tg_upd = TO_DATE('".$now."', 'YYYY-MM-DD HH:MI:SS') WHERE kduniver = '".$kduniver."'";

         $id = $this->db->query($sql);
        return $id;

    }

    public function delete_by_id($id)
    {
        $sql="DELETE FROM pers_univer_tbl WHERE kduniver ='".$id."'";
         $id = $this->db->query($sql);
        return $id;
    }
}

?>