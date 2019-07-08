<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class Convert {	


       public function konversiBulan($bln){
          if ($bln=="01") return "Januari";
          elseif ($bln=="02") return "Februari";
          elseif ($bln=="03") return "Maret";
          elseif ($bln=="04") return "April";
          elseif ($bln=="05") return "Mei";
          elseif ($bln=="06") return "Juni";
          elseif ($bln=="07") return "Juli";
          elseif ($bln=="08") return "Agustus";
          elseif ($bln=="09") return "September";
          elseif ($bln=="10") return "Oktober";
          elseif ($bln=="11") return "November";
          elseif ($bln=="12") return "Desember";
        } 
    // fungsi untuk mengubah tanggal menjadi format bahasa indonesia, contoh: 14 Maret 2014 
    public function tgl_indo($tgl){
        $tanggal = substr($tgl,0,2);
        $bulan   = $this->convertKeNamaBulan(substr($tgl,3,2)); // konversi menjadi nama bulan bahasa indonesia
        //$bulan   = substr($tgl,3,2);
        $tahun   = substr($tgl,6,4);
          return $tanggal.' '.$bulan.' '.$tahun;
    }   



    public function convertNamaBulan($bulan){
        //Contoh : $bulan : Jan => Output : 01;
        switch ($bulan) {
            case 'Jan':
                return '01';
                break;
            case 'Feb':
                return '02';
                break;
            case 'Mar':
                return '03';
                break;
            case 'Apr':
                return '04';
                break;
            case 'May':
                return '05';
                break;
            case 'Jun':
                return '06';
                break;
            case 'Jul':
                return '07';
                break;
            case 'Aug':
                return '08';
                break;
            case 'Sep':
                return '09';
                break;
            case 'Oct':
                return '10';
                break;
            case 'Nov':
                return '11';
                break;
            case 'Dec':
                return '12';
                break;
            
            default:
                return date('m');
                break;
        }
    }

    public function convertKeNamaBulan($bulan){
        //Contoh : $bulan : 01 => Output : Januari;
        switch ($bulan) {
            case '01':
                return 'Januari';
                break;
            case '02':
                return 'Februari';
                break;
            case '03':
                return 'Maret';
                break;
            case '04':
                return 'April';
                break;
            case '05':
                return 'Mei';
                break;
            case '06':
                return 'Juni';
                break;
            case '07':
                return 'Juli';
                break;
            case '08':
                return 'Agustus';
                break;
            case '09':
                return 'September';
                break;
            case '10':
                return 'Oktober';
                break;
            case '11':
                return 'November';
                break;
            case '12':
                return 'Desember';
                break;
            
            default:
                return '';
                break;
        }
    }

    public function convertNamaBulanTahun($bulantahun){
        //Contoh : $bulantahun : Jan 2015 => Output : 201501;
        $temp = explode(' ', $bulantahun);
        $nbulan = isset($temp[0]) ? $temp[0] : date('m');
        $tahun = isset($temp[1]) ? $temp[1] : date('Y');

        $bulan = $this->convertNamaBulan($nbulan);
        $thbl = $tahun.$bulan;

        return $thbl;
    }

    

}