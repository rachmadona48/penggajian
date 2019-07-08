<?php 

 class V_induk extends CI_Model {

    var $title   = '';
    var $content = '';
    var $date    = '';
    var $table = 'PERS_INDUK_TBL';
    function __construct()
    {        
        parent::__construct();
        $this->load->library('session');
    }
    
     public function save($data)
    {
        $induk = $data['induk'];
        $nama_dept = $data['nama_dept'];
        $user_id = $data['user_id']; 
        $term = $data['term'];
        $now = $data['tg_upd']; 
        
        $sql = "INSERT INTO PERS_INDUK_TBL(INDUK,NAMA_DEPT,USER_ID,TERM,TG_UPD) 
                VALUES ('".$induk."','".$nama_dept."','".$user_id."','".$term."', TO_DATE('".$now."', 'YYYY-MM-DD HH:MI:SS')) ";

        $id = $this->db->query($sql);
        return $id;
    }

    public function get_by_id($id)
    {
        $this->db->from($this->table);
        $this->db->where('INDUK',$id);
        $query = $this->db->get();
        return $query->row();
    }

    public function update($data)
    {
        $induk = $data['induk'];
        $nama_dept = $data['nama_dept'];
        $user_id = $data['user_id']; 
        $term = $data['term'];
        $now = $data['tg_upd'];
        
        $sql = "UPDATE PERS_INDUK_TBL SET nama_dept = '".$nama_dept."', user_id = '".$user_id."',
                term = '".$term."', tg_upd = TO_DATE('".$now."', 'YYYY-MM-DD HH:MI:SS') WHERE induk = '".$induk."'";

         $id = $this->db->query($sql);
        return $id;

    }

    public function delete_by_id($id)
    {
        $sql="DELETE FROM PERS_INDUK_TBL WHERE induk ='".$id."'";
         $id = $this->db->query($sql);
        return $id;
    }
}

?>