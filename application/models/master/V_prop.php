<?php 

 class V_prop extends CI_Model {

    var $title   = '';
    var $content = '';
    var $date    = '';
    var $table = 'PERS_PROP_RPT';
    function __construct()
    {        
        parent::__construct();
    }    

   

    public function save($data)
    {
        $prop = $data['prop'];
        $keterangan = $data['keterangan'];
        $now = $data['tg_upd']; 
        
        $sql = "INSERT INTO pers_prop_rpt(prop,keterangan,tg_upd) 
                VALUES ('".$prop."','".$keterangan."', TO_DATE('".$now."', 'YYYY-MM-DD HH:MI:SS')) ";

        $id = $this->db->query($sql);
        return $id;
    }

    public function get_by_id($id)
    {
        $this->db->from($this->table);
        $this->db->where('PROP',$id);
        $query = $this->db->get();

        return $query->row();
    }

    public function update($data)
    {
        $prop=$data['prop'];
        $keterangan=$data['keterangan'];
        $now = $data['tg_upd'];
        
        $sql = "UPDATE pers_prop_rpt SET keterangan = '".$keterangan."',
                 tg_upd = TO_DATE('".$now."', 'YYYY-MM-DD HH:MI:SS') WHERE prop = '".$prop."'";

         $id = $this->db->query($sql);
        return $id;

    }

    public function delete_by_id($id)
    {
        $sql="DELETE FROM pers_prop_rpt WHERE prop ='".$id."'";
         $id = $this->db->query($sql);
        return $id;
    }
}

?>