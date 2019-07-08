<?php 

 class V_jenpeg extends CI_Model {

    var $title   = '';
    var $content = '';
    var $date    = '';
    var $table = 'PERS_JENPEG_RPT';
    function __construct()
    {        
        parent::__construct();
    }    

    function getnextval(){        
        $sql = "SELECT COUNT(*) exist 
                FROM all_objects
                WHERE object_type = 'SEQUENCE'  AND lower(object_name) = lower('seq_pers_jenpeg_rpt')";
        $query = $this->db->query($sql)->row();

        if($query->EXIST <= 0){
            $create = "CREATE SEQUENCE seq_pers_jenpeg_rpt";
            $this->db->query($create);

            $sql = "SELECT seq_pers_jenpeg_rpt.nextval FROM dual";
            $query = $this->db->query($sql)->row();
        }else{
            $sql = "SELECT seq_pers_jenpeg_rpt.nextval FROM dual";
            $query = $this->db->query($sql)->row();
        }

        return $query->NEXTVAL;
    }

    function get_data($whereid = "")
    {

        $sql = "select jenpeg,keterangan from pers_jenpeg_rpt";        
        $sql .= " WHERE jenpeg = '".$whereid."' ";
                
        $query = $this->db->query($sql);
        return $query;
    }

    public function save($data)
    {
        $jenpeg = $data['jenpeg'];
        $keterangan = $data['keterangan'];
        $now = $data['tg_upd']; 
        
        $sql = "INSERT INTO pers_jenpeg_rpt(jenpeg,keterangan,tg_upd) 
                VALUES ('".$jenpeg."','".$keterangan."', TO_DATE('".$now."', 'YYYY-MM-DD HH:MI:SS')) ";

        $id = $this->db->query($sql);
        return $id;
    }

    public function get_by_id($id)
    {
        $this->db->from($this->table);
        $this->db->where('JENPEG',$id);
        $query = $this->db->get();

        return $query->row();
    }

    public function update($data)
    {
        $jenpeg=$data['jenpeg'];
        $keterangan=$data['keterangan'];
        $now = $data['tg_upd'];
        
        $sql = "UPDATE pers_jenpeg_rpt SET jenpeg = '".$jenpeg."', keterangan = '".$keterangan."',
                 tg_upd = TO_DATE('".$now."', 'YYYY-MM-DD HH:MI:SS') WHERE jenpeg = '".$jenpeg."'";

         $id = $this->db->query($sql);
        return $id;

    }

    public function delete_by_id($id)
    {
        $sql="DELETE FROM pers_jenpeg_rpt WHERE JENPEG ='".$id."'";
         $id = $this->db->query($sql);
        return $id;
    }
}

?>