<?php 

 class V_kodikj extends CI_Model {

    var $title   = '';
    var $content = '';
    var $date    = '';
    var $table = 'PERS_KODIKJ_RPT';
    function __construct()
    {        
        parent::__construct();
    }    

    function getnextval(){        
        $sql = "SELECT COUNT(*) exist 
                FROM all_objects
                WHERE object_type = 'SEQUENCE'  AND lower(object_name) = lower('seq_pers_kodikj_rpt')";
        $query = $this->db->query($sql)->row();

        if($query->EXIST <= 0){
            $create = "CREATE SEQUENCE seq_pers_kodikj_rpt";
            $this->db->query($create);

            $sql = "SELECT seq_pers_kodikj_rpt.nextval FROM dual";
            $query = $this->db->query($sql)->row();
        }else{
            $sql = "SELECT seq_pers_kodikj_rpt.nextval FROM dual";
            $query = $this->db->query($sql)->row();
        }

        return $query->NEXTVAL;
    }

    
    public function save($data)
    {
        $kodikj = $data['kodikj'];
        $keterangan = $data['keterangan'];
        $now = $data['tg_upd']; 
        
        $sql = "INSERT INTO pers_kodikj_rpt(kodikj,keterangan,tg_upd) 
                VALUES ('".$kodikj."','".$keterangan."', TO_DATE('".$now."', 'YYYY-MM-DD HH:MI:SS')) ";

        $id = $this->db->query($sql);
        return $id;
    }

    public function get_by_id($id)
    {
        $this->db->from($this->table);
        $this->db->where('KODIKJ',$id);
        $query = $this->db->get();

        return $query->row();
    }

    public function update($data)
    {
        $kodikj=$data['kodikj'];
        $keterangan=$data['keterangan'];
        $now = $data['tg_upd'];
        
        $sql = "UPDATE pers_kodikj_rpt SET  keterangan = '".$keterangan."',tg_upd = TO_DATE('".$now."', 'YYYY-MM-DD HH:MI:SS') WHERE kodikj = '".$kodikj."'";

         $id = $this->db->query($sql);
        return $id;

    }

    public function delete_by_id($id)
    {
        $sql="DELETE FROM pers_kodikj_rpt WHERE kodikj ='".$id."'";
         $id = $this->db->query($sql);
        return $id;
    }
}

?>