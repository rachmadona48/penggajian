<?php 

 class V_pegawai1 extends CI_Model {

    var $title   = '';
    var $content = '';
    var $date    = '';

    function __construct()
    {        
        parent::__construct();
    }
    

    function get_data($whereid1)
    {

        $sql = "SELECT * FROM PERS_PEGAWAI1";        
        $sql .= " WHERE NRK = '".$whereid1."'";
                
        $query = $this->db->query($sql);
        return $query;
    }

    function insertData($data){

        if ($this->session->userdata('logged_in')) {            

            $session_data       = $this->session->userdata('logged_in');
            $user['id']         = $session_data['id'];
            $user['username']   = $session_data['username'];

            $NRK = $data['nrk'];
            $NIP = $data['nip'];
            $KLOGAD = $data['klogad'];
            $KKLOGAD = $data['kklogad'];
            $NAMA = $data['nama'];
            $TITEL = $data['titel'];
            $PATHIR = $data['pathir'];
            $TALHIR = $data['talhir'];
            $AGAMA = $data['agama'];
            $JENKEL = $data['jenkel'];
            $STAWIN = $data['stawin'];
            $STAPEG = $data['stapeg'];
            $JENPEG = $data['jenpeg'];
            $INDUK = $data['induk'];
            $MUANG = $data['muang'];
            $NOTUNGGU = $data['notunggu'];
            $TGTUNGGU = $data['tgtunggu'];
            $TGAKHTUNG = $data['tgakhtung'];
            $TBHTTMAS = $data['tbhttmas'];
            $TBHBBMAS = $data['tbhbbmas'];
            $TUNDA = $data['tunda'];
            $MPP = $data['mpp'];
            $TMT_STAPEG = $data['tmt_stapeg'];
            $NIP18 = $data['nip18'];
            $TMTPENSIUN = $data['tmtpensiun'];
            $KDMATI = $data['kdmati'];
            $TGLAMPP = $data['tglampp'];
            $TGLEMPP = $data['tglempp'];
            $X_PHOTO = $data['x_photo'];
            $PINDAHAN = $data['pindahan'];
            $TMTPINDAH = $data['tmtpindah'];
            $TG_UPD = date('Y-m-d h:i:s');
            $term="LOAD";      
        
        $sql = "INSERT INTO PERS_PEGAWAI1(NRK,NIP,KLOGAD,KKLOGAD,NAMA,TITEL,PATHIR,TALHIR,AGAMA,JENKEL,STAWIN,STAPEG,JENPEG,INDUK,MUANG,NOTUNGGU,TGTUNGGU,TBHTTMAS,TBHBBMAS,TUNDA,MPP,TMT_STAPEG,USER_ID,TERM,TG_UPD,NIP18,TMTPENSIUN,KDMATI,TGLAMPP,TGLEMPP,X_PHOTO,PINDAHAN,TMTPINDAH) 
                VALUES ('".$NRK."','".$NIP."','".$KLOGAD."','".$KKLOGAD."','".$NAMA."','".$TITEL."','".$PATHIR."',TO_DATE('".$TALHIR."','DD-MM-YYYY'),
                  ".$AGAMA.",'".$JENKEL."',".$STAWIN.",".$STAPEG.",".$JENPEG.",'".$INDUK."',TO_DATE('".$MUANG."','DD-MM-YYYY'),'".$NOTUNGGU."',TO_DATE('".$TGTUNGGU."','DD-MM-YYYY'),TO_DATE('".$TGAKHTUNG."','DD-MM-YYYY'),".$TBHTTMAS.",".$TBHBBMAS.",".$TUNDA.",'".$MPP."',TO_DATE('".$TMT_STAPEG."','DD-MM-YYYY'),'".$user['id']."','".$term."', TO_DATE('".$TG_UPD."', 'YYYY-MM-DD HH:MI:SS'),'".$NIP18."',TO_DATE('".$TMTPENSIUN."','DD-MM-YYYY'),'".$KDMATI."',TO_DATE('".$TGLAMPP."','DD-MM-YYYY'),TO_DATE('".$TGLEMPP."','DD-MM-YYYY'),'".$X_PHOTO."','".$PINDAHAN."',TO_DATE('".$TMTPINDAH."','DD-MM-YYYY')"; 

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

            $NRK = $data['nrk'];
            $NIP = $data['nip'];
            $KLOGAD = $data['klogad'];
            $KKLOGAD = $data['kklogad'];
            $NAMA = $data['nama'];
            $TITEL = $data['titel'];
            $PATHIR = $data['pathir'];
            $TALHIR = $data['talhir'];
            $AGAMA = ($data['agama'] == '' ? 0 : $data['agama']);
            $JENKEL = $data['jenkel'];
            $STAWIN = ($data['stawin'] == '' ? 0 : $data['stawin']);
            $STAPEG = ($data['stapeg'] == '' ? 0 : $data['stapeg']);
            $JENPEG = ($data['jenpeg'] == '' ? 0 : $data['jenpeg']);
            $INDUK = $data['induk'];
            $MUANG = $data['muang'];
            $NOTUNGGU = $data['notunggu'];
            $TGTUNGGU = $data['tgtunggu'];
            $TGAKHTUNG = $data['tgakhtung'];
            $TBHTTMAS = ($data['tbhttmas'] == '' ? 0 : $data['tbhttmas']);
            $TBHBBMAS = ($data['tbhbbmas'] == '' ? 0 : $data['tbhbbmas']);
            $TUNDA = ($data['tunda'] == '' ? 0 : $data['tunda']);
            $MPP = $data['mpp'];
             $TMT_STAPEG = $data['tmt_stapeg'];
            $NIP18 = $data['nip18'];
            $TMTPENSIUN = $data['tmtpensiun'];
            $KDMATI = $data['kdmati'];
            $TGLAMPP = $data['tglampp'];
            $TGLEMPP = $data['tglempp'];
            $X_PHOTO = $data['x_photo'];
            $PINDAHAN = $data['pindahan'];
            $TMTPINDAH = $data['tmtpindah'];
            $TG_UPD = date('Y-m-d h:i:s');
            $term="LOAD";    
          
              
        
        $sql = "UPDATE PERS_PEGAWAI1 SET NIP='".$NIP."',KLOGAD = '".$KLOGAD."',KKLOGAD = '".$KKLOGAD."', NAMA = '".$NAMA."',TITEL = '".$TITEL."',
                PATHIR = '".$PATHIR."',TALHIR = TO_DATE('".$TALHIR."','DD-MM-YYYY'),AGAMA = ".$AGAMA.",JENKEL = '".$JENKEL."',STAWIN = ".$STAWIN.",STAPEG = ".$STAPEG.",JENPEG = ".$JENPEG.",INDUK = '".$INDUK."',
                MUANG = TO_DATE('".$MUANG."','DD-MM-YYYY'),NOTUNGGU = '".$NOTUNGGU."',TGTUNGGU = TO_DATE('".$TGTUNGGU."','DD-MM-YYYY'),TGAKHTUNG = TO_DATE('".$TGAKHTUNG."','DD-MM-YYYY'),
                TBHTTMAS = ".$TBHTTMAS.",TBHBBMAS = ".$TBHBBMAS.",TUNDA = ".$TUNDA.",MPP = '".$MPP."',TMT_STAPEG = TO_DATE('".$TMT_STAPEG."','DD-MM-YYYY'),user_id='".$user['id']."',
                term='".$term."', TG_UPD = TO_DATE('".$TG_UPD."', 'YYYY-MM-DD HH:MI:SS'),NIP18 = '".$NIP18."',TMTPENSIUN =TO_DATE('".$TMTPENSIUN."','DD-MM-YYYY'),KDMATI = '".$KDMATI."',TGLAMPP = TO_DATE('".$TGLAMPP."','DD-MM-YYYY'),
                TGLEMPP = TO_DATE('".$TGLEMPP."','DD-MM-YYYY'),X_PHOTO = '".$X_PHOTO."',PINDAHAN = '".$PINDAHAN."', TMTPINDAH = TO_DATE('".$TMTPINDAH."','DD-MM-YYYY')
                WHERE NRK = '".$NRK."'";
       // echo $sql;
        $id = $this->db->query($sql);
        return $id;
        }else{
            redirect(base_url().'index.php/login', 'refresh');
        }  
    }


    function hapusData($id1){
        
        $sql = "DELETE FROM PERS_PEGAWAI1  WHERE NRK = '".$id1."'";

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

     function getListAgama($agama=""){
        $sql = "SELECT AGAMA, KETERANGAN FROM PERS_AGAMA_RPT";
        $id = $this->db->query($sql);

        $option = "";
        foreach($id->result() as $row){
            if($agama == $row->AGAMA){
                $option .= "<option selected value='".$row->AGAMA."'>".$row->AGAMA." - ".$row->KETERANGAN."</option>";
            }else{
                $option .= "<option value='".$row->AGAMA."'>".$row->AGAMA." - ".$row->KETERANGAN."</option>";
            }  
        }

        return $option;
    }

     function getListStawin($stawin=""){
        $sql = "SELECT STAWIN, KETERANGAN FROM PERS_STAWIN_RPT";
        $id = $this->db->query($sql);

        $option = "";
        foreach($id->result() as $row){
            if($stawin == $row->STAWIN){
                $option .= "<option selected value='".$row->STAWIN."'>".$row->STAWIN." - ".$row->KETERANGAN."</option>";
            }else{
                $option .= "<option value='".$row->STAWIN."'>".$row->STAWIN." - ".$row->KETERANGAN."</option>";
            }  
        }

        return $option;
    }

     function getListJenpeg($jenpeg=""){
        $sql = "SELECT JENPEG, KETERANGAN FROM PERS_JENPEG_RPT";
        $id = $this->db->query($sql);

        $option = "";
        foreach($id->result() as $row){
            if($jenpeg == $row->JENPEG){
                $option .= "<option selected value='".$row->JENPEG."'>".$row->JENPEG." - ".$row->KETERANGAN."</option>";
            }else{
                $option .= "<option value='".$row->JENPEG."'>".$row->JENPEG." - ".$row->KETERANGAN."</option>";
            }  
        }

        return $option;
    }

     function getListInduk($induk=""){
        $sql = "SELECT INDUK, NAMA_DEPT FROM PERS_INDUK_TBL";
        $id = $this->db->query($sql);

        $option = "";
        foreach($id->result() as $row){
            if($induk == $row->INDUK){
                $option .= "<option selected value='".$row->INDUK."'>".$row->INDUK." - ".$row->NAMA_DEPT."</option>";
            }else{
                $option .= "<option value='".$row->INDUK."'>".$row->INDUK." - ".$row->NAMA_DEPT."</option>";
            }  
        }

        return $option;
    }
    

}

?>