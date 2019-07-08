<?php 

 class V_tema extends CI_Model {

    var $title   = '';
    var $content = '';
    var $date    = '';
    var $table = 'PERS_TEMA_TBL';
    function __construct()
    {        
        parent::__construct();
    }    


    public function save($data)
    {
        $kdtema = $data['kdtema'];
        $natema = $data['natema'];
        $user_id = $data['user_id']; 
        $term=$data['term'];
        $now = $data['tg_upd']; 
        
        $sql = "INSERT INTO pers_tema_tbl(kdtema,natema,user_id,term,tg_upd) 
                VALUES ('".$kdtema."','".$natema."','".$user_id."','".$term."', TO_DATE('".$now."', 'YYYY-MM-DD HH:MI:SS')) ";

        $id = $this->db->query($sql);
        return $id;
    }

    public function get_by_id($id)
    {
        $this->db->from($this->table);
        $this->db->where('KDTEMA',$id);
        $query = $this->db->get();

        return $query->row();
    }

    public function update($data)
    {
        $kdtema = $data['kdtema'];
        $natema = $data['natema'];
        $user_id = $data['user_id']; 
        $term=$data['term'];
        $now = $data['tg_upd']; 
        $sql = "UPDATE pers_tema_tbl SET natema = '".$natema."', user_id = '".$user_id."',term = '".$term."',   
                 tg_upd = TO_DATE('".$now."', 'YYYY-MM-DD HH:MI:SS') WHERE kdtema = '".$kdtema."'";

         $id = $this->db->query($sql);
        return $id;

    }

    public function delete_by_id($id)
    {
        $sql="DELETE FROM pers_tema_tbl WHERE kdtema ='".$id."'";
         $id = $this->db->query($sql);
        return $id;
    }
}

?>