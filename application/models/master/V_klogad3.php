<?php 

 class V_klogad3 extends CI_Model {

    var $title   = '';
    var $content = '';
    var $date    = '';
    var $table = 'PERS_KLOGAD3';
    function __construct()
    {        
        parent::__construct();
    }    

    public function save($data)
    {
        $kolok = $data['kolok'];
        $nalok = $data['nalok'];
        $spmu = $data['spmu'];
        $aktif = $data['aktif'];
        $tahun = $data['tahun'];
        $kode_unit_sipkd = $data['kode_unit_sipkd']; 
        
        $sql = "INSERT INTO pers_klogad3(kolok,nalok,spmu,aktif,tahun,kode_unit_sipkd) 
                VALUES ('".$kolok."','".$nalok."','".$spmu."','".$aktif."','".$tahun."','".$kode_unit_sipkd."') ";

        $id = $this->db->query($sql);
        return $id;
    }

    public function get_by_id($id)
    {
        $this->db->from($this->table);
        $this->db->where('KOLOK',$id);
        $query = $this->db->get();

        return $query->row();
    }

    public function update($data)
    {
        $kolok = $data['kolok'];
        $nalok = $data['nalok'];
        $spmu = $data['spmu'];
        $aktif = $data['aktif'];
        $tahun = $data['tahun'];
        $kode_unit_sipkd = $data['kode_unit_sipkd']; 
        
        $sql = "UPDATE pers_klogad3 SET nalok = '".$nalok."', spmu = '".$spmu."', aktif = '".$aktif."', tahun = '".$tahun."', kode_unit_sipkd = '".$kode_unit_sipkd."'
                WHERE kolok = '".$kolok."'";

         $id = $this->db->query($sql);
        return $id;

    }

    public function delete_by_id($id)
    {
        $sql="DELETE FROM pers_klogad3 WHERE kolok ='".$id."'";
         $id = $this->db->query($sql);
        return $id;
    }
}

?>