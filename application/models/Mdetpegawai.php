<?php 

 class Mdetpegawai extends CI_Model {

    var $title   = '';
    var $content = '';
    var $date    = '';
    private $bt;
  

    function __construct()
    {        
        parent::__construct();

        $this->bt =& get_instance();
        $this->bt->load->database(); 
       // $this->db = $this->bt->load->database('29', TRUE);
        
    }

    function get_datahistduk($nrk,$thbl)
    {
        $sql = "SELECT 
                    NRK,
                    NIP,
                    NIP18,
                    NAMA,
                    PATHIR,
                    TO_CHAR (TALHIR, 'DD-MM-YYYY') TALHIR,
                    KLOGAD,
                    F_GET_NALOK (KLOGAD) NAKLOGAD,
                    KOLOK,
                    F_GET_NALOK (KOLOK) NALOKL,
                    KOJAB,
                    F_GET_NAJAB (KOLOK, KOJAB, KD) NAJABL,
                    JENKEL,
                    CASE
                        JENKEL WHEN 'L' THEN 'LAKI-LAKI'
                    ELSE 'PEREMPUAN'
                    END KET_JENKEL,
                    AGAMA,
                    F_GET_KETAGAMA(AGAMA) KET_AGAMA,
                    SPMU,
                    F_GET_NAMASPM(SPMU) NAMA_SPMU,
                    ESELON,
                    F_GET_NESELON(ESELON)NESELON,
                    MASKER,
                    STAPEG,
                    F_GET_STAPEG(STAPEG) KET_STAPEG,
                    UMUR,
                    STAWIN,
                    F_GET_STAWIN(STAWIN) KET_STAWIN,
                    KOPANG,
                    F_GET_GOL_BYKOPANG(KOPANG)GOLKOPANG,
                    F_GET_NAPANG(KOPANG)NAPANG 
                FROM PERS_DUK_PANGKAT_HISTDUK WHERE NRK ='$nrk' AND THBL = '$thbl'";
        $query = $this->db->query($sql);

        return $query;
    }
}

?>
