<?php 

 class V_uangduka extends CI_Model {

    var $title   = '';
    var $content = '';
    var $date    = '';
    var $table = 'PERS_UANGDUKA_RPT';
    function __construct()
    {        
        parent::__construct();
    }    


    public function save($data)
    {
        $uangduka = $data['uangduka'];
        $keterangan = $data['keterangan'];
        $now = $data['tg_upd']; 
        
        $sql = "INSERT INTO pers_uangduka_rpt(uangduka,keterangan,tg_upd) 
                VALUES ('".$uangduka."','".$keterangan."', TO_DATE('".$now."', 'YYYY-MM-DD HH:MI:SS')) ";

        $id = $this->db->query($sql);
        return $id;
    }

    public function get_by_id($id)
    {
        $this->db->from($this->table);
        $this->db->where('UANGDUKA',$id);
        $query = $this->db->get();

        return $query->row();
    }

    public function update($data)
    {
        $uangduka=$data['uangduka'];
        $keterangan=$data['keterangan'];
        $now = $data['tg_upd'];
        
        $sql = "UPDATE pers_uangduka_rpt SET  keterangan = '".$keterangan."',
                 tg_upd = TO_DATE('".$now."', 'YYYY-MM-DD HH:MI:SS') WHERE uangduka = '".$uangduka."'";

         $id = $this->db->query($sql);
        return $id;

    }

    public function delete_by_id($id)
    {
        $sql="DELETE FROM pers_uangduka_rpt WHERE uangduka ='".$id."'";
         $id = $this->db->query($sql);
        return $id;
    }
}

?>