<?php 

 class V_spmu extends CI_Model {

    var $title   = '';
    var $content = '';
    var $date    = '';
    var $table = 'PERS_TABEL_SPMU';
    function __construct()
    {        
        parent::__construct();
    }    

    function getnextval(){        
        $sql = "SELECT COUNT(*) exist 
                FROM all_objects
                WHERE object_type = 'SEQUENCE'  AND lower(object_name) = lower('seq_pers_spmu_rpt')";
        $query = $this->db->query($sql)->row();

        if($query->EXIST <= 0){
            $create = "CREATE SEQUENCE seq_pers_spmu_rpt";
            $this->db->query($create);

            $sql = "SELECT seq_pers_spmu_rpt.nextval FROM dual";
            $query = $this->db->query($sql)->row();
        }else{
            $sql = "SELECT seq_pers_spmu_rpt.nextval FROM dual";
            $query = $this->db->query($sql)->row();
        }

        return $query->NEXTVAL;
    }


    public function save($data)
    {
        $kode_spm = $data['kode_spm'];
        $nama = $data['nama'];
        $klogad_induk = $data['klogad_induk'];
        $tahun = $data['tahun'];
        $kdsort = $data['kdsort'];
        
        $sql = "INSERT INTO pers_tabel_spmu(kode_spm,nama,klogad_induk,tahun,kdsort) 
                VALUES ('".$kode_spm."','".$nama."','".$klogad_induk."','".$tahun."','".$kdsort."' ) ";

        $id = $this->db->query($sql);
        return $id;
    }

    public function get_by_id($id)
    {
        $this->db->from($this->table);
        $this->db->where('KODE_SPM',$id);
        $query = $this->db->get();

        return $query->row();
    }

    public function update($data)
    {
        $kode_spm = $data['kode_spm'];
        $nama = $data['nama'];
        $klogad_induk = $data['klogad_induk'];
        $tahun = $data['tahun'];
        $kdsort = $data['kdsort'];
        
        $sql = "UPDATE pers_tabel_spmu SET nama = '".$nama."',klogad_induk = '".$klogad_induk."',tahun = '".$tahun."',
                kdsort = '".$kdsort."' WHERE kode_spm = '".$kode_spm."'";

         $id = $this->db->query($sql);
        return $id;

    }

    public function delete_by_id($id)
    {
        $sql="DELETE FROM pers_tabel_spmu WHERE kode_spm ='".$id."'";
         $id = $this->db->query($sql);
        return $id;
    }
}

?>