<?php 

 class V_tunda_absensi extends CI_Model {

    var $title   = '';
    var $content = '';
    var $date    = '';

    function __construct()
    {        
        parent::__construct();
    }
    

    function get_data($whereid1, $whereid2)
    {

        $sql = "SELECT * FROM PERS_TUNDA_ABSENSI";        
        $sql .= " WHERE THBL = '".$whereid1."' AND NRK ='".$whereid2."'";
                
        $query = $this->db->query($sql);
        return $query;
    }

    function insertData($data){

        if ($this->session->userdata('logged_in')) {            

            $session_data       = $this->session->userdata('logged_in');
            $user['id']         = $session_data['id'];
            $user['username']   = $session_data['username'];

            $THBL = $data['thbl'];
            $NRK = $data['nrk'];
            $NIP18 = $data['nip18'];
            $NAMA_ABS = $data['nama_abs'];
            $KLOGAD = $data['klogad'];
            $NAKLOGAD = $data['naklogad'];
            $NAGOL = $data['nagol'];
            $ALFA = $data['alfa'];
            $IZIN = $data['izin'];
            $SAKIT = $data['sakit'];
            $CUTI = $data['cuti'];
            $JAMTERLAMBAT = $data['jamterlambat'];
            $JAMPULANGCEPAT = $data['jampulangcepat'];
            $KINERJA = $data['kinerja'];
            $PERIODE = $data['periode'];
            $D_PROSES = $data['d_proses'];
            $E_PROSES = $data['e_proses'];
            $CUTIAPENTING = $data['cutiapenting'];
            $CUTIBESAR = $data['cutibesar'];   
            $CUTISAKIT = $data['cutisakit'];
            $CUTIBERSALIN = $data['cutibersalin'];
        
        $sql = "INSERT INTO PERS_TUNDA_ABSENSI(THBL,NRK,NIP18,NAMA_ABS,KLOGAD,NAKLOGAD,NAGOL,ALFA,IZIN,SAKIT,CUTI,JAMTERLAMBAT,JAMPULANGCEPAT,KINERJA,PERIODE,D_PROSES,E_PROSES,CUTIAPENTING,CUTIBESAR,CUTISAKIT,CUTIBERSALIN) 
                VALUES ('".$THBL."','".$NRK."','".$NIP18."','".$NAMA_ABS."','".$KLOGAD."','".$NAKLOGAD."','".$NAGOL."',".$ALFA.",".$IZIN.",".$SAKIT.",".$CUTI.",".$JAMTERLAMBAT.",".$JAMPULANGCEPAT.",".$KINERJA.",".$PERIODE.",'".$D_PROSES."','".$E_PROSES."',".$CUTIAPENTING.",".$CUTIBESAR.",".$CUTISAKIT.",".$CUTIBERSALIN.")"; 

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

            $THBL = $data['thbl'];
            $NRK = $data['nrk'];
            $NIP18 = $data['nip18'];
            $NAMA_ABS = $data['nama_abs'];
            $KLOGAD = $data['klogad'];
            $NAKLOGAD = $data['naklogad'];
            $NAGOL = $data['nagol'];
            $ALFA = ($data['alfa'] == '' ? 0 : $data['alfa']);
            $IZIN = ($data['izin'] == '' ? 0 : $data['izin']);
            $SAKIT = ($data['sakit'] == '' ? 0 : $data['sakit']);
            $CUTI = ($data['cuti'] == '' ? 0 : $data['cuti']);
            $JAMTERLAMBAT = ($data['jamterlambat'] == '' ? 0 : $data['jamterlambat']);
            $JAMPULANGCEPAT = ($data['jampulangcepat'] == '' ? 0 : $data['jampulangcepat']);
            $KINERJA = ($data['kinerja'] == '' ? 0 : $data['kinerja']);
            $PERIODE = ($data['periode'] == '' ? 0 : $data['periode']);
            $D_PROSES = $data['d_proses'];
            $E_PROSES = $data['e_proses'];
            $CUTIAPENTING = ($data['cutiapenting'] == '' ? 0 : $data['cutiapenting']);
            $CUTIBESAR = ($data['cutibesar'] == '' ? 0 : $data['cutibesar']);   
            $CUTISAKIT = ($data['cutisakit'] == '' ? 0 : $data['cutisakit']);
            $CUTIBERSALIN = ($data['cutibersalin'] == '' ? 0 : $data['cutibersalin']);
          
              
        
        $sql = "UPDATE PERS_TUNDA_ABSENSI SET NIP18='".$NIP18."',NAMA_ABS = '".$NAMA_ABS."',KLOGAD = '".$KLOGAD."', NAKLOGAD = '".$NAKLOGAD."',NAGOL ='".$NAGOL."',ALFA = ".$ALFA.",IZIN =".$IZIN.",SAKIT = ".$SAKIT.",CUTI = ".$CUTI.",JAMTERLAMBAT=".$JAMTERLAMBAT.",JAMPULANGCEPAT=".$JAMPULANGCEPAT.", KINERJA = ".$KINERJA.",PERIODE = ".$PERIODE.",D_PROSES = TO_DATE('".$D_PROSES."','DD-MM-YYYY'),E_PROSES = '".$E_PROSES."',CUTIAPENTING = ".$CUTIAPENTING.",CUTIBESAR = ".$CUTIBESAR.",CUTISAKIT = ".$CUTISAKIT.",CUTIBERSALIN = ".$CUTIBERSALIN." WHERE THBL = '".$THBL."' AND NRK ='".$NRK."'";
        
        $id = $this->db->query($sql);
        return $id;
        }else{
            redirect(base_url().'index.php/login', 'refresh');
        }  
    }


    function hapusData($id1,$id2){
        
        $sql = "DELETE FROM PERS_TUNDA_ABSENSI WHERE WHERE THBL = '".$id1."' AND NRK ='".$id2."'";

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

}

?>