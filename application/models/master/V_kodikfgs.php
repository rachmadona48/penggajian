<?php 

 class V_kodikfgs extends CI_Model {

    var $title   = '';
    var $content = '';
    var $date    = '';
    var $table = 'PERS_KODIKF_RPT';
    function __construct()
    {        
        parent::__construct();
    }    

    public function save($data)
    {
        $kodikf = $data['kodikf'];
        $keterangan = $data['keterangan'];
        $now = $data['tg_upd']; 
        
        $sql = "INSERT INTO pers_kodikf_rpt(kodikf,keterangan,tg_upd) 
                VALUES ('".$kodikf."','".$keterangan."', TO_DATE('".$now."', 'YYYY-MM-DD HH:MI:SS')) ";

        $id = $this->db->query($sql);
        return $id;
    }

    public function get_by_id($id)
    {
        $this->db->from($this->table);
        $this->db->where('KODIKF',$id);
        $query = $this->db->get();

        return $query->row();
    }

    public function update($data)
    {
        $kodikf=$data['kodikf'];
        $keterangan=$data['keterangan'];
        $now = $data['tg_upd'];
        
        $sql = "UPDATE pers_kodikf_rpt SET keterangan = '".$keterangan."',
                 tg_upd = TO_DATE('".$now."', 'YYYY-MM-DD HH:MI:SS') WHERE kodikf = '".$kodikf."'";

         $id = $this->db->query($sql);
        return $id;

    }

    public function delete_by_id($id)
    {
        $sql="DELETE FROM pers_kodikf_rpt WHERE kodikf ='".$id."'";
         $id = $this->db->query($sql);
        return $id;
    }
}

?>