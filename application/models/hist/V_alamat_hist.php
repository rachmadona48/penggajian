<?php 

 class V_alamat_hist extends CI_Model {

    var $title   = '';
    var $content = '';
    var $date    = '';
    var $table = 'PERS_ALAMAT_HIST';
    function __construct()
    {        
        parent::__construct();
        $this->load->library('session');
    }
    
     public function save($data)
    {
        $NRK = $data['NRK'];
        $TGMULAI = $data['TGMULAI'];
        $ALAMAT = $data['ALAMAT'];
        $RT = $data['RT'];
        $RW = $data['RW'];
        $KOWIL = $data['KOWIL'];
        $KOCAM = $data['KOCAM'];
        $KOKEL = $data['KOKEL'];
        $PROP = $data['PROP'];
        $user_id = $data['user_id']; 
        $term = $data['term'];
        $now = $data['tg_upd']; 
        
        $sql = "INSERT INTO PERS_ALAMAT_HIST(NRK,TGMULAI,ALAMAT,RT,RW,KOWIL, KOCAM, KOKEL, PROP,USER_ID,TERM,TG_UPD) 
                VALUES ('".$NRK."',TO_DATE('".$TGMULAI."','DD-MM-YYYY'),'".$ALAMAT."','".$RT."','".$RW."',".$KOWIL.",'".$KOCAM."','".$KOKEL."','".$PROP."','".$user_id."','".$term."', TO_DATE('".$now."', 'YYYY-MM-DD HH:MI:SS')) ";

        $id = $this->db->query($sql);
        return $id;
    }

    public function get_by_id($id1,$id2)
    {
        $sql= "SELECT * FROM PERS_ALAMAT_HIST WHERE NRK = '".$id1."' AND TGMULAI = TO_DATE('".$id2."','DD-MM-YYYY')";
        //echo $sql;
        $id = $this->db->query($sql)->row();
        return $id;
    }

    public function update($data)
    {
        $NRK = $data['NRK'];
        $TGMULAI = $data['TGMULAI'];
        $ALAMAT = $data['ALAMAT'];
        $RT = $data['RT'];
        $RW = $data['RW'];
        $KOWIL = $data['KOWIL'];
        $KOCAM = $data['KOCAM'];
        $KOKEL = $data['KOKEL'];
        $PROP = $data['PROP'];
        $USER_ID = $data['user_id']; 
        $TERM = $data['term'];
        $NOW = $data['tg_upd'];
        
        $sql = "UPDATE PERS_ALAMAT_HIST SET ALAMAT = '".$ALAMAT."',RT = '".$RT."',RW = '".$RW."', KOWIL = ".$KOWIL.",KOCAM = '".$KOCAM."',KOKEL = '".$KOKEL."',PROP = '".$PROP."',USER_ID = '".$USER_ID."',TERM = '".$TERM."', TG_UPD = TO_DATE('".$NOW."', 'YYYY-MM-DD HH:MI:SS') WHERE NRK = '".$NRK."' AND TGMULAI=TO_DATE('".$TGMULAI."','DD-MM-YYYY')";

         $id = $this->db->query($sql);
        return $id;

    }

    public function delete_by_id($id1,$id2)
    {
        $sql="DELETE FROM PERS_ALAMAT_HIST WHERE NRK ='".$id1."' AND TGMULAI=TO_DATE('".$id2."','DD-MM-YYYY')";
         $que = $this->db->query($sql);
        return $que;
    }

    function getListKowil($kowil=""){
        $sql = "SELECT KOWIL, NAWIL FROM PERS_KOWIL_TBL ";
        $id = $this->db->query($sql);

        $option = "";
        foreach($id->result() as $row){
            if($kowil == $row->KOWIL){
                $option .= "<option selected value=".$row->KOWIL.">".$row->KOWIL." - '".$row->NAWIL."'</option>";
            }else{
                $option .= "<option value=".$row->KOWIL.">".$row->KOWIL." - ".$row->NAWIL."</option>";
            }            
        }

        return $option;
    }

    function getListKocam($kowil, $kocam=""){
        $sql = "SELECT KOCAM, NACAM FROM PERS_KOCAM_TBL WHERE KOWIL=".$kowil."";

        $id = $this->db->query($sql);
       // echo $id;
        $option = "";
        foreach($id->result() as $row){
            if($kocam == $row->KOCAM){
                $option .= "<option selected value=".$row->KOCAM.">".$row->KOCAM." - ".$row->NACAM."</option>";
            }else{
                $option .= "<option value=".$row->KOCAM.">".$row->KOCAM." - ".$row->NACAM."</option>";
            }            
        }

        return $option;
    }

    function getListKokel($kowil,$kocam,$kokel=""){
        $sql = "SELECT KOKEL, NAKEL FROM PERS_KOKEL_TBL WHERE KOWIL=".$kowil." AND KOCAM='".$kocam."'";
        $id = $this->db->query($sql);

        $option = "";
        foreach($id->result() as $row){
            if($kokel == $row->KOKEL){
                $option .= "<option selected value=".$row->KOKEL.">".$row->KOKEL." - ".$row->NAKEL."</option>";
            }else{
                $option .= "<option value=".$row->KOKEL.">".$row->KOKEL." - ".$row->NAKEL."</option>";
            }            
        }

        return $option;
    }

    function getListProp($prop=""){
        $sql = "SELECT PROP, KETERANGAN FROM PERS_PROP_RPT ORDER BY PROP ASC";
        $id = $this->db->query($sql);

        $option = "";
        foreach($id->result() as $row){
            if($prop == $row->PROP){
                $option .= "<option selected value=".$row->PROP.">".$row->PROP." - ".$row->KETERANGAN."</option>";
            }else{
                $option .= "<option value=".$row->PROP.">".$row->PROP." - ".$row->KETERANGAN."</option>";
            }            
        }

        return $option;
    }

   /* function getKetWilayah($kowil)
    {
        $sql="SELECT NAWIL FROM PERS_KOWIL_TBL WHERE KOWIL=".$kowil."";
        $id = $this->db->query($sql)->row();

        return $id->NAWIL;
    }

    function getKetCamat($kocam)
    {
        $sql="SELECT NACAM FROM PERS_KOCAM_TBL WHERE KOCAM=".$kocam."";
        $id = $this->db->query($sql)->row();

        return $id->NACAM;
    }

    function getKetLurah($kokel)
    {
        $sql="SELECT NAKEL FROM PERS_KOKEL_TBL WHERE KOKEL=".$kokel."";
        $id = $this->db->query($sql)->row();

        return $id->NAKEL;
    }

     function getKetProp($prop)
    {
        $sql="SELECT KETERANGAN FROM PERS_PROP_RPT WHERE PROP=".$prop."";
        $id = $this->db->query($sql)->row();

        return $id->KETERANGAN;
    }*/
}

?>