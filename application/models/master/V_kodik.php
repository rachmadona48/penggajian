<?php 

 class V_kodik extends CI_Model {

    var $title   = '';
    var $content = '';
    var $date    = '';
    var $table = 'PERS_KODIK_RPT';
    function __construct()
    {        
        parent::__construct();
    }    

    function getnextval(){        
        $sql = "SELECT COUNT(*) exist 
                FROM all_objects
                WHERE object_type = 'SEQUENCE'  AND lower(object_name) = lower('seq_pers_kodik_rpt')";
        $query = $this->db->query($sql)->row();

        if($query->EXIST <= 0){
            $create = "CREATE SEQUENCE seq_pers_kodik_rpt";
            $this->db->query($create);

            $sql = "SELECT seq_pers_kodik_rpt.nextval FROM dual";
            $query = $this->db->query($sql)->row();
        }else{
            $sql = "SELECT seq_pers_kodik_rpt.nextval FROM dual";
            $query = $this->db->query($sql)->row();
        }

        return $query->NEXTVAL;
    }


    public function save($data)
    {
        $kodik = $data['kodik'];
        $kodik = $data['kodikf'];
        $keterangan = $data['keterangan'];
        $now = $data['tg_upd']; 
        
        $sql = "INSERT INTO pers_kodik_rpt(kodik,kodikf,keterangan,tg_upd) 
                VALUES ('".$kodik."','".$kodikf."','".$keterangan."', TO_DATE('".$now."', 'YYYY-MM-DD HH:MI:SS')) ";

        $id = $this->db->query($sql);
        return $id;
    }

    public function get_by_id($id)
    {
        $this->db->from($this->table);
        $this->db->where('KODIK',$id);
        $query = $this->db->get();

        return $query->row();
    }

    public function update($data)
    {
        $kodik=$data['kodik'];
        $kodikf=$data['kodikf'];
        $keterangan=$data['keterangan'];
        $now = $data['tg_upd'];
        
        $sql = "UPDATE pers_kodik_rpt SET kodikf = '".$kodikf."', keterangan = '".$keterangan."',
                 tg_upd = TO_DATE('".$now."', 'YYYY-MM-DD HH:MI:SS') WHERE kodik = '".$kodik."'";

         $id = $this->db->query($sql);
        return $id;

    }

    public function delete_by_id($id)
    {
        $sql="DELETE FROM pers_kodik_rpt WHERE kodik ='".$id."'";
         $id = $this->db->query($sql);
        return $id;
    }
}

?>