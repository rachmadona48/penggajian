<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class Convert_bln_jasper {

    private $ci;
    private $ekin;

    function __construct()
    {
        $this->ci =& get_instance();
        $this->ci->load->database(); 

        // $this->ekin = $this->ci->load->database('ekinerja', TRUE);
    }

    public function konvert($thbl){
        $bln = substr($thbl, 4,2);

        if($bln == '01'){
            $bulan = 'januari';
        }elseif($bln == '02'){
            $bulan = 'februari';
        }elseif($bln == '03'){
            $bulan = 'maret';
        }elseif($bln == '04'){
            $bulan = 'april';
        }elseif($bln == '05'){
            $bulan = 'mei';
        }elseif($bln == '06'){
            $bulan = 'juni';
        }elseif($bln == '07'){
            $bulan = 'juli';
        }elseif($bln == '08'){
            $bulan = 'agustus';
        }elseif($bln == '09'){
            $bulan = 'september';
        }elseif($bln == '10'){
            $bulan = 'oktober';
        }elseif($bln == '11'){
            $bulan = 'november';
        }elseif($bln == '12'){
            $bulan = 'desember';
        }
        return $bulan;
    }

    


}