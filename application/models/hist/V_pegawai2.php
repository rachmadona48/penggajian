<?php 

 class V_pegawai2 extends CI_Model {

    var $title   = '';
    var $content = '';
    var $date    = '';

    function __construct()
    {        
        parent::__construct();
    }
    

    function get_data($whereid1)
    {

        $sql = "SELECT * FROM PERS_PEGAWAI2";        
        $sql .= " WHERE NRK = '".$whereid1."'";
                
        $query = $this->db->query($sql);
        return $query;
    }

    function insertData($data){

        if ($this->session->userdata('logged_in')) {            

            $session_data       = $this->session->userdata('logged_in');
            $user['id']         = $session_data['id'];
            $user['username']   = $session_data['username'];

            $NRK = $data['NRK'];
            $KARPEG = $data['KARPEG'];
            $TASPEN = $data['TASPEN'];
            $SIMPEDA = $data['SIMPEDA'];
            $ALIRAN = $data['ALIRAN'];
            $ALAMAT = $data['ALAMAT'];
            $RT = $data['RT'];
            $RW = $data['RW'];
            $KOWIL = $data['KOWIL'];
            $KOCAM = $data['KOCAM'];
            $KOKEL = $data['KOKEL'];
            $PROP = $data['PROP'];
            $NOPPEN = $data['NOPPEN'];
            $DARAH = $data['DARAH'];
            $HUSBAKTI = $data['HUSBAKTI'];
            $KARSU = $data['KARSU'];
            $NPWP = $data['NPWP'];
            $JENDIKCPS = $data['JENDIKCPS'];
            $KODIKCPS = $data['KODIKCPS'];
            $NIPPASIF = $data['NIPPASIF'];
            $FORPUSAT = $data['FORPUSAT'];
            $THFORPUS = $data['THFORPUS'];
            $FORDAERAH = $data['FORDAERAH'];
            $THFORDRH = $data['THFORDRH'];
            $NOINPRES = $data['NOINPRES'];
            $TGSUMPAH = $data['TGSUMPAH'];
            $NOSUMPAH = $data['NOSUMPAH'];
            $PEJTTSUM = $data['PEJTTSUM'];
            $TINGGI = $data['TINGGI'];
            $BERAT = $data['BERAT'];
            $RAMBUT = $data['RAMBUT'];
            $MUKA = $data['MUKA'];
            $KULIT = $data['KULIT'];
            $CACAT = $data['CACAT'];
            $KIDAL = $data['KIDAL'];
            $TG_UPD = date('Y-m-d h:i:s');
            $term="LOAD";      
        
        $sql = "INSERT INTO PERS_PEGAWAI2(NRK,KARPEG,TASPEN,SIMPEDA,ALIRAN,ALAMAT,RT,RW,KOWIL,KOCAM,KOKEL,PROP,NOPPEN,DARAH,HUSBAKTI,KARSU,NPWP,JENDIKCPS,KODIKCPS,NIPPASIF,FORPUSAT,THFORPUS,FORDAERAH,THFORDRH,NOINPRES,TGSUMPAH,NOSUMPAH,PEJTTSUM,TINGGI,BERAT,RAMBUT,MUKA,KULIT,CACAT,KIDAL,USER_ID,TERM,TG_UPD) 
                VALUES ('".$NRK."','".$KARPEG."','".$TASPEN."','".$SIMPEDA."','".$ALIRAN."','".$ALAMAT."','".$RT."',".$RW.",
                  ".$KOWIL.",'".$KOCAM."','".$KOKEL."','".$PROP."','".$NOPPEN."','".$DARAH."','".$HUSBAKTI."','".$KARSU."','".$NPWP."',".$JENDIKCPS.",'".$KODIKCPS."','".$NIPPASIF."','".$FORPUSAT."','".$THFORPUS."','".$FORDRH."','".$NOINPRES."','".$TGSUMPAH."',".$PEJTTSUM.",".$TINGGI.",".$BERAT.",'".$RAMBUT."','".$MUKA."','".$KULIT."','".$CACAT."','".$KIDAL."','".$user['id']."','".$term."', TO_DATE('".$TG_UPD."', 'YYYY-MM-DD HH:MI:SS'))"; 

        $id = $this->db->query($sql);
        return $id;
        }else{
            redirect(base_url().'index.php/login', 'refresh');
        }  
    }

    function updateData($data){
        if ($this->session->userdata('logged_in')) {            

            $session_data       = $this->session->userdata('logged_in');
            $user['id']         = $session_data['id'];
            $user['username']   = $session_data['username'];

            $NRK = $data['NRK'];
            $KARPEG = $data['KARPEG'];
            $TASPEN = $data['TASPEN'];
            $SIMPEDA = $data['SIMPEDA'];
            $ALIRAN = $data['ALIRAN'];
            $ALAMAT = $data['ALAMAT'];
            $RT = $data['RT'];
            $RW = $data['RW'];
            $KOWIL = ($data['KOWIL'] == '' ? 0 : $data['KOWIL']);
            $KOCAM = $data['KOCAM'];
            $KOKEL = $data['KOKEL'];
            $PROP = $data['PROP'];
            $NOPPEN = $data['NOPPEN'];
            $DARAH = $data['DARAH'];
            $HUSBAKTI = $data['HUSBAKTI'];
            $KARSU = $data['KARSU'];
            $NPWP = $data['NPWP'];
            $JENDIKCPS = ($data['JENDIKCPS'] == '' ? 0 : $data['JENDIKCPS']);
            $KODIKCPS = $data['KODIKCPS'];
            $NIPPASIF = $data['NIPPASIF'];
            $FORPUSAT = $data['FORPUSAT'];
            $THFORPUS = $data['THFORPUS'];
            $FORDAERAH = $data['FORDAERAH'];
            $THFORDRH = $data['THFORDRH'];
            $NOINPRES = $data['NOINPRES'];
            $TGSUMPAH = $data['TGSUMPAH'];
            $NOSUMPAH = $data['NOSUMPAH'];
            $PEJTTSUM = ($data['PEJTTSUM'] == '' ? 0 : $data['PEJTTSUM']);
            $TINGGI = ($data['TINGGI'] == '' ? 0 : $data['TINGGI']);
            $BERAT = ($data['BERAT'] == '' ? 0 : $data['BERAT']);
            $RAMBUT = $data['RAMBUT'];
            $MUKA = $data['MUKA'];
            $KULIT = $data['KULIT'];
            $CACAT = $data['CACAT'];
            $KIDAL = $data['KIDAL'];
            $TG_UPD = date('Y-m-d h:i:s');
            $term="LOAD";    
          
              
        
        $sql = "UPDATE PERS_PEGAWAI2 SET KARPEG='".$KARPEG."',TASPEN = '".$TASPEN."',SIMPEDA = '".$SIMPEDA."', ALIRAN = '".$ALIRAN."',ALAMAT = '".$ALAMAT."',
                RT = '".$RT."',RW = '".$RW."',KOWIL = ".$KOWIL.",KOCAM = '".$KOCAM."',KOKEL = '".$KOKEL."',PROP = '".$PROP."',
                NOPPEN = '".$NOPPEN."',DARAH = '".$DARAH."',HUSBAKTI = '".$HUSBAKTI."',KARSU = '".$KARSU."',NPWP = '".$NPWP."',JENDIKCPS = ".$JENDIKCPS.",
                KODIKCPS = '".$KODIKCPS."',NIPPASIF = '".$NIPPASIF."',FORPUSAT = '".$FORPUSAT."',THFORPUS = '".$THFORPUS."',FORDAERAH = '".$FORDAERAH."',THFORDRH = '".$THFORDRH."',
                NOINPRES = '".$NOINPRES."',TGSUMPAH = '".$TGSUMPAH."',NOSUMPAH = '".$NOSUMPAH."',
                PEJTTSUM = ".$PEJTTSUM.",TINGGI = ".$TINGGI.",BERAT = ".$BERAT.",RAMBUT = '".$RAMBUT."',MUKA = '".$MUKA."',
                KULIT = '".$KULIT."',CACAT = '".$CACAT."',KIDAL = '".$KIDAL."',user_id='".$user['id']."',
                term='".$term."', TG_UPD = TO_DATE('".$TG_UPD."', 'YYYY-MM-DD HH:MI:SS') 
                WHERE NRK = '".$NRK."'";

        $id = $this->db->query($sql);
        return $id;
        }else{
            redirect(base_url().'index.php/login', 'refresh');
        }  
    }


    function hapusData($id){
        
        $sql = "DELETE FROM PERS_PEGAWAI2 WHERE WHERE NRK = '".$id."'";

        $id = $this->db->query($sql);
        return $id;
    }

    

}

?>