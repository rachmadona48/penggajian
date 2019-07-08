<?php 

 class V_hubkel extends CI_Model {

    var $title   = '';
    var $content = '';
    var $date    = '';
    var $table = 'PERS_HUBKEL_TBL';
    function __construct()
    {        
        parent::__construct();
        $this->load->library('session');
    }
    
     public function save($data)
    {
        $hubkel = $data['hubkel'];
        $nahubkel = $data['nahubkel'];
        $user_id = $data['user_id']; 
        $term = $data['term'];
        $now = $data['tg_upd']; 
        
        $sql = "INSERT INTO PERS_HUBKEL_TBL(HUBKEL,NAHUBKEL,USER_ID,TERM,TG_UPD) 
                VALUES ('".$hubkel."','".$nahubkel."','".$user_id."','".$term."', TO_DATE('".$now."', 'YYYY-MM-DD HH:MI:SS')) ";

        $id = $this->db->query($sql);
        return $id;
    }

    public function get_by_id($id)
    {
        $this->db->from($this->table);
        $this->db->where('HUBKEL',$id);
        $query = $this->db->get();
        return $query->row();
    }

    public function update($data)
    {
        $hubkel = $data['hubkel'];
        $nahubkel = $data['nahubkel'];
        $user_id = $data['user_id']; 
        $term = $data['term'];
        $now = $data['tg_upd'];
        
        $sql = "UPDATE pers_hubkel_tbl SET nahubkel = '".$nahubkel."', user_id = '".$user_id."',
                term = '".$term."', tg_upd = TO_DATE('".$now."', 'YYYY-MM-DD HH:MI:SS') WHERE hubkel = '".$hubkel."'";

         $id = $this->db->query($sql);
        return $id;

    }

    public function delete_by_id($id)
    {
        $sql="DELETE FROM PERS_HUBKEL_TBL WHERE hubkel ='".$id."'";
         $id = $this->db->query($sql);
        return $id;
    }
}

?>