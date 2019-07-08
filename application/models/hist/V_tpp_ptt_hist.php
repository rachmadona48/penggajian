<?php 

 class V_tpp_ptt_hist extends CI_Model {

    var $title   = '';
    var $content = '';
    var $date    = '';

    function __construct()
    {        
        parent::__construct();
    }
    

    function get_data($whereid1, $whereid2)
    {

        $sql = "SELECT * FROM PERS_TPP_PTT";        
        $sql .= " WHERE NPTT = '".$whereid1."' AND THBL ='".$whereid2."'";
                
        $query = $this->db->query($sql);
        return $query;
    }

    function insertData($data){

        if ($this->session->userdata('logged_in')) {            

            $session_data       = $this->session->userdata('logged_in');
            $user['id']         = $session_data['id'];
            $user['username']   = $session_data['username'];

            $NPTT = $data['nptt'];
            $THBL = $data['thbl'];
            $NAMA = $data['nama'];
            $KODEPDIDIK = $data['kodepdidik'];
            $KLOGAD = $data['klogad'];
            $KEAHLIAN = $data['keahlian'];
            $KINERJA = $data['kinerja'];
            $TPP = $data['tpp'];
            $POTKINERJA = $data['potkinerja'];
            $JMLSTLPOT = $data['jmlstlpot'];
            $PPH = $data['pph'];
            $TPPBERSIH = $data['tppbersih'];
            $TGLLAHIR = $data['tgllahir'];
            $SPMU = $data['spmu'];
            $TG_UPD = date('Y-m-d h:i:s');
            $UPLOAD = $data['upload'];
            $POTABSENSI = $data['potabsensi'];
            $JMLSTLABS = $data['jmlstlabs'];
            $GAJIBERSIH = $data['gaji_bersih'];
            $ALFA = $data['alfa'];
            $IZIN = $data['izin'];
               
        
        $sql = "INSERT INTO PERS_TPP_PTT(NPTT,THBL,NAMA,KODEPDIDIK,KLOGAD,KEAHLIAN,KINERJA,TPP,POTKINERJA,JMLSTLPOT,PPH,TPPBERSIH,USER_ID,TGLLAHIR,SPMU,TG_UPD,UPLOAD,POTABSENSI,JMLSTLABS,GAJI_BERSIH,ALFA,IZIN) 
                VALUES ('".$NPTT."','".$THBL."','".$NAMA."','".$KODEPDIDIK."','".$KLOGAD."','".$KEAHLIAN."',".$KINERJA.",".$TPP.",".$POTKINERJA.",".$JMLSTLPOT.",".$PPH.",".$TPPBERSIH.",'".$user['id']."',TO_DATE('".$TGLLAHIR."','DD-MM-YYYY'),'".$SPMU."', TO_DATE('".$TG_UPD."', 'YYYY-MM-DD HH:MI:SS'),".$UPLOAD.",".$POTABSENSI.",".$JMLSTLABS.",".$GAJIBERSIH.",".$ALFA.",".$IZIN.")"; 
          
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

            $NPTT = $data['nptt'];
            $THBL = $data['thbl'];
            $NAMA = $data['nama'];
            $KODEPDIDIK = $data['kodepdidik'];
            $KLOGAD = $data['klogad'];
            $KEAHLIAN = $data['keahlian'];
            $KINERJA = ($data['kinerja'] == '' ? 0 : $data['kinerja']);
            $TPP = ($data['tpp'] == '' ? 0 : $data['tpp']);
            $POTKINERJA = ($data['potkinerja'] == '' ? 0 : $data['potkinerja']);
            $JMLSTLPOT = ($data['jmlstlpot'] == '' ? 0 : $data['jmlstlpot']);
            $PPH = ($data['pph'] == '' ? 0 : $data['pph']);
            $TPPBERSIH =($data['tppbersih'] == '' ? 0 : $data['tppbersih']);
            $TGLLAHIR = $data['tgllahir'];
            $SPMU = $data['spmu'];
            $TG_UPD = date('Y-m-d h:i:s');
            $UPLOAD = ($data['upload'] == '' ? 0 : $data['upload']);
            $POTABSENSI = ($data['potabsensi'] == '' ? 0 : $data['potabsensi']);
            $JMLSTLABS =($data['jmlstlabs'] == '' ? 0 : $data['jmlstlabs']);
            $GAJIBERSIH = ($data['gaji_bersih'] == '' ? 0 : $data['gaji_bersih']);
            $ALFA = ($data['alfa'] == '' ? 0 : $data['alfa']);
            $IZIN = ($data['izin'] == '' ? 0 : $data['izin']); 
          
              
        
        $sql = "UPDATE PERS_TPP_PTT SET NAMA='".$NAMA."',KODEPDIDIK = '".$KODEPDIDIK."',KLOGAD = '".$KLOGAD."', KEAHLIAN = '".$KEAHLIAN."',KINERJA = ".$KINERJA.",
                TPP = ".$TPP.",POTKINERJA = ".$POTKINERJA.",JMLSTLPOT = ".$JMLSTLPOT.",PPH = ".$PPH.",TPPBERSIH=".$TPPBERSIH.",user_id='".$user['id']."',
                TGLLAHIR=TO_DATE('".$TGLLAHIR."','DD-MM-YYYY'), SPMU='".$SPMU."', TG_UPD = TO_DATE('".$TG_UPD."', 'YYYY-MM-DD HH:MI:SS'),UPLOAD = ".$UPLOAD.",POTABSENSI = ".$POTABSENSI.", 
                JMLSTLABS = ".$JMLSTLABS.",GAJI_BERSIH = ".$GAJIBERSIH.",ALFA = ".$ALFA.",IZIN = ".$IZIN."
                WHERE NPTT = '".$NPTT."' AND THBL ='".$THBL."'";

        $id = $this->db->query($sql);
        return $id;
        }else{
            redirect(base_url().'index.php/login', 'refresh');
        }  
    }


    function hapusData($id1,$id2){
        
        $sql = "DELETE FROM PERS_TPP_PTT WHERE NPTT = '".$id1."' AND THBL ='".$id2."'";
        
        $id = $this->db->query($sql);
        return $id;
    }

    function getListKlogad($klogad=""){
        $sql = "SELECT KOLOK, NALOK FROM PERS_KLOGAD3";
        $id = $this->db->query($sql);

        $option = "";
        foreach($id->result() as $row){
            if($klogad == $row->KOLOK){
                $option .= "<option selected value='".$row->KOLOK."'>".$row->KOLOK." - ".$row->NALOK."</option>";
            }else{
                $option .= "<option value='".$row->KOLOK."'>".$row->KOLOK." - ".$row->NALOK."</option>";
            }  
        }

        return $option;
    }

    function getListSPMU($spmu=""){
        $sql = "SELECT KODE_SPM, NAMA FROM PERS_TABEL_SPMU";
        $id = $this->db->query($sql);

        $option = "";
        foreach($id->result() as $row){
            if($spmu == $row->KODE_SPM){
                $option .= "<option selected value='".$row->KODE_SPM."'>".$row->KODE_SPM." - ".$row->NAMA."</option>";
            }else{
                $option .= "<option value='".$row->KODE_SPM."'>".$row->KODE_SPM." - ".$row->NAMA."</option>";
            }  
        }

        return $option;
    }


}

?>