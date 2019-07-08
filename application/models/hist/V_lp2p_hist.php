<?php 

 class V_lp2p_hist extends CI_Model {

    var $title   = '';
    var $content = '';
    var $date    = '';

    function __construct()
    {        
        parent::__construct();
    }
    

    function get_data($whereid1, $whereid2)
    {

        $sql = "SELECT * FROM PERS_LP2P_HIST";        
        $sql .= " WHERE THPAJAK =".$whereid1." AND NRK ='".$whereid2."'";
                
        $query = $this->db->query($sql);
        return $query;
    }

    function insertData($data){

        if ($this->session->userdata('logged_in')) {            

            $session_data       = $this->session->userdata('logged_in');
            $user['id']         = $session_data['id'];
            $user['username']   = $session_data['username'];

            $THPAJAK = $data['THPAJAK'];            //1
            $NRK = $data['NRK'];
            $NIP = $data['NIP'];
            $NIP18 = $data['NIP18'];
            $NAMA = $data['NAMA'];
            $KOLOK = $data['KOLOK'];
            $NALOK = $data['NALOK'];
            $GOL = $data['GOL'];
            $RUANG = $data['RUANG'];
            $TMTPANGKAT = $data['TMTPANGKAT'];      //10
            $NAJAB = $data['NAJAB'];
            $TMTESELON = $data['TMTESELON'];
            $TALHIR = $data['TALHIR'];
            $PATHIR = $data['PATHIR'];
            $ALAMAT = $data['ALAMAT'];
            $RTALAMAT = $data['RTALAMAT'];
            $RWALAMAT = $data['RWALAMAT'];
            $KELURAHAN = $data['KELURAHAN'];
            $KECAMATAN = $data['KECAMATAN'];
            $JENKEL = $data['JENKEL'];              //20
            $STAWIN = $data['STAWIN'];
            $NAMISU = $data['NAMISU'];
            $PEKERJAAN = $data['PEKERJAAN'];
            $JUAN = $data['JUAN'];
            $JIWA = $data['JIWA'];
            $KDWEWENANG = $data['KDWEWENANG'];
            $NOFORM = $data['NOFORM'];
            $KODE2 = $data['KODE2'];
            $TGUPD = date('Y-m-d h:i:s');
            $KOJAB = $data['KOJAB'];                //30
            $KOJABF = $data['KOJABF'];
            $KD = $data['KD'];
            $ESELON = $data['ESELON'];
            $SPMU = $data['SPMU'];
            $KLOGAD = $data['KLOGAD'];
            $KODUK = $data['KODUK'];
            $THLAPOR = $data['THLAPOR'];
            $PEJABAT = $data['PEJABAT'];            //38
              
        
        $sql = "INSERT INTO PERS_LP2P_HIST(THPAJAK,NRK,NIP,NIP18,NAMA,KOLOK,NALOK,GOL,RUANG,TMTPANGKAT,NAJAB,TMTESELON,TALHIR,PATHIR,ALAMAT,RTALAMAT,RWALAMAT,KELURAHAN,KECAMATAN,JENKEL,
            STAWIN,NAMISU,PEKERJAAN,JUAN,JIWA,KDWEWENANG,NOFORM,KODE2,TGUPD,KOJAB,KOJABF,KD,ESELON,SPMU,KLOGAD,KODUK,THLAPOR,PEJABAT) 
                VALUES (".$THPAJAK.",'".$NRK."','".$NIP."','".$NIP18."','".$NAMA."','".$KOLOK."','".$NALOK."','".$GOL."',".$RUANG.",'".$TMTPANGKAT."',
                    '".$NAJAB."',".$TMTESELON.",".$TALHIR.",'".$PATHIR."','".$ALAMAT."','".$RTALAMAT."','".$RWALAMAT."','".$KELURAHAN."','".$KECAMATAN."',
                    '".$JENKEL."','".$STAWIN."','".$NAMISU."','".$PEKERJAAN."',".$JUAN.",".$JIWA.",'".$KDWEWENANG."','".$NOFORM."','".$KODE2."', 
                    TO_DATE('".$TGUPD."', 'YYYY-MM-DD HH:MI:SS'),'".$KOJAB."','".$KOJABF."','".$KD."','".$ESELON."','".$SPMU."','".$KLOGAD."','".$KODUK."','".$THLAPOR."',".$PEJABAT.")"; 

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

            $THPAJAK = $data['thpajak'];        //1
            $NRK = $data['nrk'];
            $NIP = $data['nip'];
            $NIP18 = $data['nip18'];
            $NAMA = $data['nama'];
            $KOLOK = $data['kolok'];
            $NALOK = $data['nalok'];
            $GOL = $data['gol'];
            $RUANG = $data['ruang'];
            $TMTPANGKAT = $data['tmtpangkat'];  //10
            $NAJAB = $data['najab'];
            $TMTESELON = $data['tmteselon'];
            $TALHIR = $data['talhir'];
            $PATHIR = $data['pathir'];
            $ALAMAT = $data['alamat'];
            $RTALAMAT = $data['rtalamat'];
            $RWALAMAT = $data['rwalamat'];
            $KELURAHAN = $data['kelurahan'];
            $KECAMATAN = $data['kecamatan'];
            $JENKEL = $data['jenkel'];          //20
            $STAWIN = $data['stawin'];
            $NAMISU = $data['namisu'];
            $PEKERJAAN = $data['pekerjaan'];
            $JUAN = ($data['juan'] == '' ? 0 : $data['juan']);
            $JIWA = ($data['jiwa'] == '' ? 0 : $data['jiwa']);
            $KDWEWENANG = $data['kdwewenang'];
            $NOFORM = $data['noform'];
            $KODE2 = $data['kode2'];
            $TGUPD = date('Y-m-d h:i:s');
            $KOJAB = $data['kojab'];            //30
            $KOJABF = $data['kojabf'];
            $KD = $data['kd'];
            $ESELON = $data['eselon'];
            $SPMU = $data['spmu'];
            $KLOGAD = $data['klogad'];
            $KODUK = $data['koduk'];
            $THLAPOR = $data['thlapor'];
            $PEJABAT = ($data['pejabat'] == '' ? 0 : $data['pejabat']); //38

              
        
        $sql = "UPDATE PERS_LP2P_HIST SET NIP='".$NIP."',NIP18 = '".$NIP18."',NAMA = '".$NAMA."', KOLOK = '".$KOLOK."',NALOK ='".$NALOK."',
                GOL = '".$GOL."',RUANG = '".$RUANG."',TMTPANGKAT = TO_DATE('".$TMTPANGKAT."','DD-MM-YYYY'),NAJAB = '".$NAJAB."',TMTESELON=TO_DATE('".$TMTESELON."','DD-MM-YYYY'),TALHIR=TO_DATE('".$TALHIR."','DD-MM-YYYY'),
                PATHIR='".$PATHIR."',ALAMAT='".$ALAMAT."',RTALAMAT='".$RTALAMAT."',RWALAMAT='".$RWALAMAT."',KELURAHAN='".$KELURAHAN."', KECAMATAN='".$KECAMATAN."',
                JENKEL='".$JENKEL."',STAWIN='".$STAWIN."',NAMISU='".$NAMISU."',PEKERJAAN='".$PEKERJAAN."',JUAN=".$JUAN.",JIWA=".$JIWA.",KDWEWENANG='".$KDWEWENANG."',
                NOFORM='".$NOFORM."',KODE2='".$KODE2."',TGUPD = TO_DATE('".$TGUPD."', 'YYYY-MM-DD HH:MI:SS'),KOJAB='".$KOJAB."',KOJABF='".$KOJABF."',
                KD='".$KD."',ESELON='".$ESELON."',SPMU='".$SPMU."',KLOGAD='".$KLOGAD."',THLAPOR='".$THLAPOR."',PEJABAT=".$PEJABAT." 
                WHERE THPAJAK = ".$THPAJAK." AND NRK ='".$NRK."'";

        $id = $this->db->query($sql);
        return $id;
        }else{
            redirect(base_url().'index.php/login', 'refresh');
        }  
    }


    function hapusData($id1,$id2){
        
        $sql = "DELETE FROM PERS_LP2P_HIST WHERE WHERE THPAJAK = ".$id1." AND NRK ='".$id2."'";

        $id = $this->db->query($sql);
        return $id;
    }

    function getListKolok($kolok=""){
        $sql = "SELECT KOLOK, NALOKS FROM PERS_LOKASI_TBL";
        $id = $this->db->query($sql);

        $option = "";
        foreach($id->result() as $row){
            if($kolok == $row->KOLOK){
                $option .= "<option selected value='".$row->KOLOK."'>".$row->KOLOK." - ".$row->NALOKS."</option>";
            }else{
                $option .= "<option value='".$row->KOLOK."'>".$row->KOLOK." - ".$row->NALOKS."</option>";
            }  
        }

        return $option;
    }

    function getListEselon($eselon=""){
        $sql = "SELECT ESELON, NESELON FROM PERS_ESELON_TBL";
        $id = $this->db->query($sql);

        $option = "";
        foreach($id->result() as $row){
            if($eselon == $row->ESELON){
                $option .= "<option selected value='".$row->ESELON."'>".$row->ESELON." - ".$row->NESELON."</option>";
            }else{
                $option .= "<option value='".$row->ESELON."'>".$row->ESELON." - ".$row->NESELON."</option>";
            }  
        }

        return $option;
    }

}

?>