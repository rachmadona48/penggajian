<?php 

 class Mreport extends CI_Model {

    var $title   = '';
    var $content = '';
    var $date    = '';

    // private $ci;
    // private $ekin;

    function __construct()
    {        
        parent::__construct();

        // $this->ci =& get_instance();
        // $this->ci->load->database();     
    }     

    function getDataPegawai($where=""){

        $sql = "SELECT NRK, NAMA, KOLOK, NALOKL, KOJAB, NAJABL, ESELON, NESELON, KOPANG
                FROM
                (
                SELECT PEG.NRK, PEG.NAMA, JAB.KOLOK, JAB.NALOKL, JAB.KOJAB, JAB.NAJABL, JAB.ESELON, JAB.NESELON, JAB.KOPANG, PEG.JENKEL, PEG.KDMATI, PEG.FLAG, PEG.AGAMA, PEG.STAPEG, PEG.STAWIN, JABP.MAKERTHNREAL, JABP.MAKERBLNREAL, USIA.UMURTHNREAL, USIA.UMURBLNREAL, HD.JENHUKDIS
                FROM PERS_PEGAWAI1 PEG
                LEFT JOIN \"vw_jabatan_terakhir\" JAB ON PEG.NRK = JAB.NRK
                LEFT JOIN \"vw_jabatan_pertama\" JABP ON PEG.NRK = JABP.NRK
                LEFT JOIN \"vw_usia_pegawai\" USIA ON PEG.NRK = USIA.NRK
                LEFT JOIN \"vw_hukdis_terakhir\" HD ON PEG.NRK = HD.NRK
                WHERE (PEG.KDMATI <> 'Y' OR (PEG.TMTPENSIUN > SYSDATE OR PEG.TMTPENSIUN IS NULL)) AND PEG.FLAG = '1'
                ) PEGAWAI
                WHERE ".$where." ORDER BY KOJAB ASC";
        
        $query = $this->db->query($sql);

        $table = "<div class='animated fadeInUp'>";
        $table .= "<table class='table table-bordered table-hovered' id='datapegawai' class='datapegawai'>";
        $table .= "<thead>";
        $table .= "<tr>";
        $table .= "<td>No.</td><td>NRK</td><td>Nama</td><td>Jabatan</td><td>Lokasi Kerja</td><td>Aksi</td>";
        $table .= "</tr>";
        $table .= "</thead>";
        $table .= "<tbody>";
        $no = 1;
        foreach ($query->result() as $row)
        {            
            $table .= "<tr>";
            $table .= "<td>".$no."</td>";
            $table .= "<td>".$row->NRK."</td>";
            $table .= "<td>".$row->NAMA."</td>";
            $table .= "<td>".$row->NAJABL."</td>";
            $table .= "<td>".$row->NALOKL."</td>";
            $table .= "<td><div class='row'><div class='col-sm-12'>
                                    <div class='row'>
                                        <div class='col-sm-6' align='center'>
                                            <form method='post' action='".site_url('pegawai/doview')."'>
                                                <input type='hidden' name='nrk' id='nrk' value='".$row->NRK."'>
                                                <button class='btn btn-outline btn-xs btn-primary' data-toggle='tool-tip' data-placement='bottom' title='detail pegawai' type='submit' pull-right><i class='fa fa-user'></i></button>
                                            </form>
                                        </div>
                                        <div class='col-sm-6' align='center'>
                                            <form method='post' action='".site_url('riwayat')."'>
                                                <input type='hidden' name='nrkP' id='nrkP' value='".$row->NRK."'>
                                                <button class='btn btn-outline btn-xs btn-success' data-toggle='tool-tip' data-placement='bottom' title='riwayat pegawai' type='submit' pull-right><i class='fa fa-th-list'></i></button>
                                            </form>
                                        </div>

                                        
                                    </div>
                            </div></div></td>";
            $table .= "</tr>";
            $no++;
        }
        $table .= "</tbody>";
        $table .= "</table>";
        $table .= "</div>";
       
        return $table;
    }

    public function getLapDtPgw($valnrk="")
     {
         $sql = "SELECT NAMA,NIP18 FROM PERS_PEGAWAI1 WHERE NRK='".$valnrk."'
                ";

         $rs = $this->db->query($sql)->row();
         if ($rs){
             return $rs;
         } else {
             return '';
         }


     }

    function getDataPegawaiTes($where="",$staakt,$global){
        $requestData = $this->input->post();
        $columns = array(
            0 => 'NRK',
            1 => 'NAMA',
            2 => 'NAJABL',
            3 => 'NALOKL'
            );
        $q = "SELECT
                    COUNT(NRK) AS jml
                FROM
                    PERS_PEGAWAI1";

        $rs = $this->db->query($q)->result();
        $totalData = $rs[0]->JML;

        $where2=" AND ";
        if($global != "")
        {
            $where2.="(
                            PEGAWAI.NRK = '".$global."'
                            OR (PEGAWAI.NAMA) LIKE UPPER('%".$global."%')
                            OR PEGAWAI.NIP = '".$global."'
                            OR PEGAWAI.NIP18 = '".$global."'
                        )";
        }
        else
        {
            $where2.= "6=6";
        }

        if($staakt == 2)
        {

            $sql = "SELECT rownum, X.* FROM
                (
                    SELECT rownum as RN, NRK, NAMA, KOLOK, NALOKL, KOJAB, NAJABL, ESELON, NESELON, KOPANG,NIP,NIP18
                    FROM
                    (
                        SELECT DISTINCT PEG.NRK, PEG.NAMA, JAB.KOLOK, JAB.NALOKL, JAB.KOJAB, JAB.NAJABL, JAB.ESELON, JAB.NESELON, JAB.KOPANG, PEG.JENKEL, PEG.KDMATI, PEG.FLAG, PEG.AGAMA, PEG.STAPEG, PEG.STAWIN, JABP.MAKERTHNREAL, JABP.MAKERBLNREAL, USIA.UMURTHNREAL, USIA.UMURBLNREAL, HD.JENHUKDIS,PEG.NIP,PEG.NIP18
                        FROM PERS_PEGAWAI1 PEG
                        LEFT JOIN \"vw_jabatan_terakhir\" JAB ON PEG.NRK = JAB.NRK 
                        LEFT JOIN \"vw_jabatan_pertama\" JABP ON PEG.NRK = JABP.NRK
                        LEFT JOIN \"vw_usia_pegawai\" USIA ON PEG.NRK = USIA.NRK
                        LEFT JOIN \"vw_hukdis_terakhir\" HD ON PEG.NRK = HD.NRK
                        
                    ) PEGAWAI
                    WHERE ".$where.$where2."  ORDER BY PEGAWAI.KOJAB ASC
                )X";    
        }
        else if($staakt == 1)
        {
            /*$sql = "SELECT rownum, X.* FROM
                (
                    SELECT rownum as RN, NRK, NAMA, KOLOK, NALOKL, KOJAB, NAJABL, ESELON, NESELON, KOPANG
                    FROM
                    (
                        SELECT PEG.NRK, PEG.NAMA, JAB.KOLOK, JAB.NALOKL, JAB.KOJAB, JAB.NAJABL, JAB.ESELON, JAB.NESELON, JAB.KOPANG, PEG.JENKEL, PEG.KDMATI, PEG.FLAG, PEG.AGAMA, PEG.STAPEG, PEG.STAWIN, JABP.MAKERTHNREAL, JABP.MAKERBLNREAL, USIA.UMURTHNREAL, USIA.UMURBLNREAL, HD.JENHUKDIS
                        FROM PERS_PEGAWAI1 PEG
                        LEFT JOIN \"vw_jabatan_terakhir\" JAB ON PEG.NRK = JAB.NRK 
                        LEFT JOIN \"vw_jabatan_pertama\" JABP ON PEG.NRK = JABP.NRK
                        LEFT JOIN \"vw_usia_pegawai\" USIA ON PEG.NRK = USIA.NRK
                        LEFT JOIN \"vw_hukdis_terakhir\" HD ON PEG.NRK = HD.NRK
                        WHERE (PEG.KDMATI <> 'Y' OR (PEG.TMTPENSIUN > SYSDATE OR PEG.TMTPENSIUN IS NULL)) 
                        AND PEG.FLAG = '1'
                    ) PEGAWAI
                    WHERE ".$where." ORDER BY PEGAWAI.KOJAB ASC
                )X";*/

                $sql = "SELECT rownum, X.* FROM
                (
                    SELECT rownum as RN, NRK, NAMA, KOLOK, NALOKL, KOJAB, NAJABL, ESELON, NESELON, KOPANG,NIP,NIP18
                    FROM
                    (
                        SELECT DISTINCT PEG.NRK, PEG.NAMA, JAB.KOLOK, JAB.NALOKL, JAB.KOJAB, JAB.NAJABL, JAB.ESELON, JAB.NESELON, JAB.KOPANG, PEG.JENKEL, PEG.KDMATI, PEG.FLAG, PEG.AGAMA, PEG.STAPEG, PEG.STAWIN, JABP.MAKERTHNREAL, JABP.MAKERBLNREAL, USIA.UMURTHNREAL, USIA.UMURBLNREAL, HD.JENHUKDIS,PEG.NIP,PEG.NIP18
                        FROM PERS_PEGAWAI1 PEG
                        LEFT JOIN \"vw_jabatan_terakhir\" JAB ON PEG.NRK = JAB.NRK 
                        LEFT JOIN \"vw_jabatan_pertama\" JABP ON PEG.NRK = JABP.NRK
                        LEFT JOIN \"vw_usia_pegawai\" USIA ON PEG.NRK = USIA.NRK
                        LEFT JOIN \"vw_hukdis_terakhir\" HD ON PEG.NRK = HD.NRK
                        --WHERE (PEG.KDMATI <> 'Y' OR (PEG.TMTPENSIUN > SYSDATE OR PEG.TMTPENSIUN IS NULL)) 
                        WHERE ((PEG.KDMATI <> 'Y' OR PEG.KDMATI IS NULL) AND PEG.KLOGAD NOT LIKE '11111111%')
                    ) PEGAWAI
                    WHERE ".$where.$where2." ORDER BY PEGAWAI.KOJAB ASC
                )X";
        }
        else if($staakt==0)
        {
            /*$sql = "SELECT rownum, X.* FROM
                (
                    SELECT rownum as RN, NRK, NAMA, KOLOK, NALOKL, KOJAB, NAJABL, ESELON, NESELON, KOPANG
                    FROM
                    (
                        SELECT PEG.NRK, PEG.NAMA, JAB.KOLOK, JAB.NALOKL, JAB.KOJAB, JAB.NAJABL, JAB.ESELON, JAB.NESELON, JAB.KOPANG, PEG.JENKEL, PEG.KDMATI, PEG.FLAG, PEG.AGAMA, PEG.STAPEG, PEG.STAWIN, JABP.MAKERTHNREAL, JABP.MAKERBLNREAL, USIA.UMURTHNREAL, USIA.UMURBLNREAL, HD.JENHUKDIS
                        FROM PERS_PEGAWAI1 PEG
                        LEFT JOIN \"vw_jabatan_terakhir\" JAB ON PEG.NRK = JAB.NRK
                        LEFT JOIN \"vw_jabatan_pertama\" JABP ON PEG.NRK = JABP.NRK
                        LEFT JOIN \"vw_usia_pegawai\" USIA ON PEG.NRK = USIA.NRK
                        LEFT JOIN \"vw_hukdis_terakhir\" HD ON PEG.NRK = HD.NRK
                        WHERE PEG.KDMATI = 'Y' OR PEG.TMTPENSIUN <= SYSDATE OR PEG.FLAG <> '1'
                    ) PEGAWAI
                    WHERE ".$where." ORDER BY PEGAWAI.KOJAB ASC
                )X";*/

                $sql = "SELECT rownum, X.* FROM
                (
                    SELECT rownum as RN, NRK, NAMA, KOLOK, NALOKL, KOJAB, NAJABL, ESELON, NESELON, KOPANG,NIP,NIP18
                    FROM
                    (
                        SELECT DISTINCT PEG.NRK, PEG.NAMA, JAB.KOLOK, JAB.NALOKL, JAB.KOJAB, JAB.NAJABL, JAB.ESELON, JAB.NESELON, JAB.KOPANG, PEG.JENKEL, PEG.KDMATI, PEG.FLAG, PEG.AGAMA, PEG.STAPEG, PEG.STAWIN, JABP.MAKERTHNREAL, JABP.MAKERBLNREAL, USIA.UMURTHNREAL, USIA.UMURBLNREAL, HD.JENHUKDIS,PEG.NIP,PEG.NIP18
                        FROM PERS_PEGAWAI1 PEG
                        LEFT JOIN \"vw_jabatan_terakhir\" JAB ON PEG.NRK = JAB.NRK
                        LEFT JOIN \"vw_jabatan_pertama\" JABP ON PEG.NRK = JABP.NRK
                        LEFT JOIN \"vw_usia_pegawai\" USIA ON PEG.NRK = USIA.NRK
                        LEFT JOIN \"vw_hukdis_terakhir\" HD ON PEG.NRK = HD.NRK
                        --WHERE PEG.KDMATI = 'Y' OR PEG.TMTPENSIUN <= SYSDATE 
                        WHERE (PEG.KDMATI = 'Y'  OR PEG.KLOGAD LIKE '11111111%') 
                    ) PEGAWAI
                    WHERE ".$where.$where2." ORDER BY PEGAWAI.KOJAB ASC
                )X";
        }

        $sql.=" WHERE 1=1";


        if( !empty($requestData['search']['value']) ) {   // if there is a search parameter, $requestData['search']['value'] contains search parameter
            $sql.=" AND ( X.NRK LIKE ('%".$requestData['search']['value']."%') ";    
            $sql.=" OR X.NAMA LIKE UPPER ('%".$requestData['search']['value']."%') ";
            $sql.=" OR X.NAJABL LIKE UPPER ('%".$requestData['search']['value']."%') ";
            $sql.=" OR X.NALOKL LIKE UPPER('%".$requestData['search']['value']."%') )";
}

        //echo $sql;
        $query = $this->db->query($sql);
        $totalFiltered = $query->num_rows();
    
        $startrow = $requestData['start'];
        $endrow = $startrow + $requestData['length'];

        $sql.=" AND RN BETWEEN $startrow  AND $endrow";

        //$sql.=" AND RN > ".$requestData['start']."  AND ROWNUM <= ".$requestData['length'];
        
        $query= $this->db->query($sql);
        $totalFiltered2 = $query->num_rows();
        if ($totalFiltered2==0){
            $totalData =0;
        }
        $data = array();

    
        $no = $requestData['start']+1;
        foreach ($query->result() as $row)
        {            
            
            $nestedData=array();
            //$nestedData[] = $no;
            $nestedData[] = $row->NRK;
            $nestedData[] = $row->NAMA;
            $nestedData[] = $row->NAJABL;
            $nestedData[] = $row->NALOKL;
            $nestedData[] = "
                                    <div class='row'>
                                        <div class='col-sm-2' align='center'>
                                            <form method='post' action='".site_url('pegawai/doview2')."' target='_blank'>
                                                <input type='hidden' name='nrk' id='nrk' value='".$row->NRK."'>
                                                <button class='btn btn-outline btn-xs btn-primary' data-toggle='tool-tip' data-placement='bottom' title='detail pegawai' type='submit' pull-right><i class='fa fa-user'></i></button>
                                            </form>
                                        </div>
                                        <div class='col-sm-2' align='center'>
                                            <form method='post' action='".site_url('riwayat')."' target='_blank'>
                                                <input type='hidden' name='nrkP' id='nrkP' value='".$row->NRK."'>
                                                <button class='btn btn-outline btn-xs btn-success' data-toggle='tool-tip' data-placement='bottom' title='riwayat pegawai' type='submit' pull-right><i class='fa fa-history'></i></button>
                                            </form>
                                        </div>

                                        
                                    </div>
                            ";
            $data[]=$nestedData;
            $no++;
        }
        $json_data = array(
           "draw"            => intval( $requestData['draw'] ),
            "recordsTotal"    => intval( $totalData ),
            "recordsFiltered" => intval( $totalFiltered ),
            "data"            => $data
        );

        echo json_encode($json_data);
    }

    function queryDataPegawaiTes($where="",$staakt,$global){
        $requestData = $this->input->post();

        $where2=" AND ";
        if($global != "")
        {
            $where2.="(
                            PEGAWAI.NRK = '".$global."'
                            OR (PEGAWAI.NAMA) LIKE UPPER('%".$global."%')
                            
                        )";
        }
        else
        {
            $where2.= "6=6";
        }

        if($staakt == 2)
        {
            $sql = "SELECT rownum, X.* FROM
                (
                    SELECT rownum as RN, NRK, NAMA, KOLOK, NALOKL, KOJAB, NAJABL, ESELON, NESELON, KOPANG, GOL, NAPANG
                    FROM
                    (
                        SELECT DISTINCT PEG.NRK, PEG.NAMA, JAB.KOLOK, JAB.NALOKL, JAB.KOJAB, JAB.NAJABL, JAB.ESELON, JAB.NESELON, JAB.KOPANG, PG.GOL,PG.NAPANG,PEG.JENKEL, PEG.KDMATI, PEG.FLAG, PEG.AGAMA, PEG.STAPEG, PEG.STAWIN, JABP.MAKERTHNREAL, JABP.MAKERBLNREAL, USIA.UMURTHNREAL, USIA.UMURBLNREAL, HD.JENHUKDIS
                        FROM PERS_PEGAWAI1 PEG
                        LEFT JOIN \"vw_jabatan_terakhir\" JAB ON PEG.NRK = JAB.NRK 
                        LEFT JOIN \"vw_jabatan_pertama\" JABP ON PEG.NRK = JABP.NRK
                        LEFT JOIN \"vw_usia_pegawai\" USIA ON PEG.NRK = USIA.NRK
                        LEFT JOIN \"vw_hukdis_terakhir\" HD ON PEG.NRK = HD.NRK
                        LEFT JOIN PERS_PANGKAT_TBL PG ON JAB.KOPANG = PG.KOPANG
                    ) PEGAWAI
                    WHERE ".$where.$where2." ORDER BY PEGAWAI.KOJAB ASC
                )X";    
        }
        else if($staakt == 1)
        {
            /*$sql = "SELECT rownum, X.* FROM
                (
                    SELECT rownum as RN, NRK, NAMA, KOLOK, NALOKL, KOJAB, NAJABL, ESELON, NESELON, KOPANG,GOL, NAPANG
                    FROM
                    (
                        SELECT PEG.NRK, PEG.NAMA, JAB.KOLOK, JAB.NALOKL, JAB.KOJAB, JAB.NAJABL, JAB.ESELON, JAB.NESELON, JAB.KOPANG, PG.GOL,PG.NAPANG,PEG.JENKEL, PEG.KDMATI, PEG.FLAG, PEG.AGAMA, PEG.STAPEG, PEG.STAWIN, JABP.MAKERTHNREAL, JABP.MAKERBLNREAL, USIA.UMURTHNREAL, USIA.UMURBLNREAL, HD.JENHUKDIS
                        FROM PERS_PEGAWAI1 PEG
                        LEFT JOIN \"vw_jabatan_terakhir\" JAB ON PEG.NRK = JAB.NRK 
                        LEFT JOIN \"vw_jabatan_pertama\" JABP ON PEG.NRK = JABP.NRK
                        LEFT JOIN \"vw_usia_pegawai\" USIA ON PEG.NRK = USIA.NRK
                        LEFT JOIN \"vw_hukdis_terakhir\" HD ON PEG.NRK = HD.NRK
                        LEFT JOIN PERS_PANGKAT_TBL PG ON JAB.KOPANG = PG.KOPANG
                        WHERE (PEG.KDMATI <> 'Y' OR (PEG.TMTPENSIUN > SYSDATE OR PEG.TMTPENSIUN IS NULL)) AND PEG.FLAG = '1'
                    ) PEGAWAI
                    WHERE ".$where." ORDER BY PEGAWAI.KOJAB ASC
                )X";*/

            $sql = "SELECT rownum, X.* FROM
                (
                    SELECT rownum as RN, NRK, NAMA, KOLOK, NALOKL, KOJAB, NAJABL, ESELON, NESELON, KOPANG,GOL, NAPANG
                    FROM
                    (
                        SELECT DISTINCT PEG.NRK, PEG.NAMA, JAB.KOLOK, JAB.NALOKL, JAB.KOJAB, JAB.NAJABL, JAB.ESELON, JAB.NESELON, JAB.KOPANG, PG.GOL,PG.NAPANG,PEG.JENKEL, PEG.KDMATI, PEG.FLAG, PEG.AGAMA, PEG.STAPEG, PEG.STAWIN, JABP.MAKERTHNREAL, JABP.MAKERBLNREAL, USIA.UMURTHNREAL, USIA.UMURBLNREAL, HD.JENHUKDIS
                        FROM PERS_PEGAWAI1 PEG
                        LEFT JOIN \"vw_jabatan_terakhir\" JAB ON PEG.NRK = JAB.NRK 
                        LEFT JOIN \"vw_jabatan_pertama\" JABP ON PEG.NRK = JABP.NRK
                        LEFT JOIN \"vw_usia_pegawai\" USIA ON PEG.NRK = USIA.NRK
                        LEFT JOIN \"vw_hukdis_terakhir\" HD ON PEG.NRK = HD.NRK
                        LEFT JOIN PERS_PANGKAT_TBL PG ON JAB.KOPANG = PG.KOPANG
                        --WHERE (PEG.KDMATI <> 'Y' OR (PEG.TMTPENSIUN > SYSDATE OR PEG.TMTPENSIUN IS NULL)) 
                        WHERE ((PEG.KDMATI <> 'Y' OR PEG.KDMATI IS NULL) AND PEG.KLOGAD NOT LIKE '11111111%') 
                    ) PEGAWAI
                    WHERE ".$where.$where2." ORDER BY PEGAWAI.KOJAB ASC
                )X";
        }
        else if($staakt==0)
        {
            $sql = "SELECT rownum, X.* FROM
                (
                    SELECT rownum as RN, NRK, NAMA, KOLOK, NALOKL, KOJAB, NAJABL, ESELON, NESELON, KOPANG, GOL, NAPANG
                    FROM
                    (
                        SELECT DISTINCT PEG.NRK, PEG.NAMA, JAB.KOLOK, JAB.NALOKL, JAB.KOJAB, JAB.NAJABL, JAB.ESELON, JAB.NESELON, JAB.KOPANG, PG.GOL, PG.NAPANG, PEG.JENKEL, PEG.KDMATI, PEG.FLAG, PEG.AGAMA, PEG.STAPEG, PEG.STAWIN, JABP.MAKERTHNREAL, JABP.MAKERBLNREAL, USIA.UMURTHNREAL, USIA.UMURBLNREAL, HD.JENHUKDIS
                        FROM PERS_PEGAWAI1 PEG
                        LEFT JOIN \"vw_jabatan_terakhir\" JAB ON PEG.NRK = JAB.NRK
                        LEFT JOIN \"vw_jabatan_pertama\" JABP ON PEG.NRK = JABP.NRK
                        LEFT JOIN \"vw_usia_pegawai\" USIA ON PEG.NRK = USIA.NRK
                        LEFT JOIN \"vw_hukdis_terakhir\" HD ON PEG.NRK = HD.NRK
                        LEFT JOIN PERS_PANGKAT_TBL PG ON JAB.KOPANG = PG.KOPANG
                        --WHERE PEG.KDMATI = 'Y' OR PEG.TMTPENSIUN <= SYSDATE 
                        WHERE PEG.KDMATI = 'Y'  OR PEG.KLOGAD LIKE '11111111%' 
                    ) PEGAWAI
                    WHERE ".$where.$where2." ORDER BY PEGAWAI.KOJAB ASC
                )X";

            /*$sql = "SELECT rownum, X.* FROM
                (
                    SELECT rownum as RN, NRK, NAMA, KOLOK, NALOKL, KOJAB, NAJABL, ESELON, NESELON, KOPANG, GOL, NAPANG
                    FROM
                    (
                        SELECT PEG.NRK, PEG.NAMA, JAB.KOLOK, JAB.NALOKL, JAB.KOJAB, JAB.NAJABL, JAB.ESELON, JAB.NESELON, JAB.KOPANG, PG.GOL, PG.NAPANG PEG.JENKEL, PEG.KDMATI, PEG.FLAG, PEG.AGAMA, PEG.STAPEG, PEG.STAWIN, JABP.MAKERTHNREAL, JABP.MAKERBLNREAL, USIA.UMURTHNREAL, USIA.UMURBLNREAL, HD.JENHUKDIS
                        FROM PERS_PEGAWAI1 PEG
                        LEFT JOIN \"vw_jabatan_terakhir\" JAB ON PEG.NRK = JAB.NRK
                        LEFT JOIN \"vw_jabatan_pertama\" JABP ON PEG.NRK = JABP.NRK
                        LEFT JOIN \"vw_usia_pegawai\" USIA ON PEG.NRK = USIA.NRK
                        LEFT JOIN \"vw_hukdis_terakhir\" HD ON PEG.NRK = HD.NRK
                        LEFT JOIN PERS_PANGKAT_TBL PG ON JAB.KOPANG = PG.KOPANG
                        WHERE PEG.KDMATI = 'Y' OR PEG.TMTPENSIUN <= SYSDATE OR PEG.FLAG <> '1'
                    ) PEGAWAI
                    WHERE ".$where." ORDER BY PEGAWAI.KOJAB ASC
                )X";*/
        }

     // echo $sql;
        $query = $this->db->query($sql)->result();
       return $query;
       
    }

    function queryDataPegawaiV2($where="",$staakt="",$pendidikan="", $fasilitas="",$global)
    {
        $where2=" AND ";
        if($global != "")
        {
            $where2.="(
                            PEGAWAI.NRK = '".$global."'
                            OR (PEGAWAI.NAMA) LIKE UPPER('%".$global."%')
                            
                        )";
        }
        else
        {
            $where2.= "6=6";
        }

        $sql = "SELECT rownum, X.* FROM
                (
                        SELECT rownum as RN, NRK, NAMA, KOLOK, NALOKL, KOJAB, NAJABL, ESELON, NESELON, KOPANG,GOL, NAPANG,KODE_JENJANG
                        FROM
                        (
                        SELECT DISTINCT PEG.NRK, PEG.NAMA, JAB.KOLOK, JAB.NALOKL, JAB.KOJAB, JAB.NAJABL, JAB.ESELON, JAB.NESELON, JAB.KOPANG, PG.GOL, PG.NAPANG, PEG.JENKEL, PEG.KDMATI, PEG.FLAG, PEG.AGAMA, PEG.STAPEG, PEG.STAWIN, JABP.MAKERTHNREAL, JABP.MAKERBLNREAL, USIA.UMURTHNREAL, USIA.UMURBLNREAL, HD.JENHUKDIS,DIK_AK.KODIK,JDIK.KODE_JENJANG";



         if($pendidikan == 'nadik'){
             $sql .= ", DIK.UNIVER";
         }
         if ($fasilitas == 'jenfas') {
             $sql .= ", FAS.JENFAS";
         }

         $sql .= " FROM PERS_PEGAWAI1 PEG
                LEFT JOIN \"vw_jabatan_terakhir\" JAB ON PEG.NRK = JAB.NRK
                LEFT JOIN \"vw_jabatan_pertama\" JABP ON PEG.NRK = JABP.NRK
                LEFT JOIN \"vw_usia_pegawai\" USIA ON PEG.NRK = USIA.NRK
                LEFT JOIN \"vw_hukdis_terakhir\" HD ON PEG.NRK = HD.NRK
                LEFT JOIN PERS_PANGKAT_TBL PG ON JAB.KOPANG = PG.KOPANG
                 LEFT JOIN VW_PENDIDIKAN_TERAKHIR DIK_AK ON PEG.NRK = DIK_AK.NRK 
                LEFT JOIN PERS_JENJANG_PENDIDIKAN JDIK ON SUBSTR(DIK_AK.KODIK,0,1) = JDIK.KODE_JENJANG ";
         if($pendidikan == 'nadik'){
             $sql .= "
                            LEFT JOIN PERS_PENDIDIKAN DIK ON PEG.NRK = DIK.NRK ";
         }
         if ($fasilitas == 'jenfas') {
             $sql .= "
                            LEFT JOIN PERS_KESRA FAS ON PEG.NRK = FAS.NRK AND THSAMPAI >= TO_CHAR(SYSDATE,'YYYY') ";
         }
         //var_dump($staakt);
         if($staakt==2)
        {
            $sql .= ") PEGAWAI 
                WHERE ".$where.$where2." ORDER BY PEGAWAI.KOJAB ASC )X";
        }
        else if($staakt==1)
        {
            /*$sql .= "WHERE (PEG.KDMATI <> 'Y' OR (PEG.TMTPENSIUN > SYSDATE OR PEG.TMTPENSIUN IS NULL)) AND PEG.FLAG = '1'
                ) PEGAWAI 
                WHERE ".$where." ORDER BY PEGAWAI.KOJAB ASC )X";*/

            /*$sql .= "WHERE (PEG.KDMATI <> 'Y' OR (PEG.TMTPENSIUN > SYSDATE OR PEG.TMTPENSIUN IS NULL))
                ) PEGAWAI 
                WHERE ".$where.$where2." ORDER BY PEGAWAI.KOJAB ASC )X";*/
            $sql .= "WHERE ((PEG.KDMATI <> 'Y' OR PEG.KDMATI IS NULL) AND PEG.KLOGAD NOT LIKE '11111111%')
                ) PEGAWAI 
                WHERE ".$where.$where2." ORDER BY PEGAWAI.KOJAB ASC )X";
        }
        else if($staakt==0)
        {
            /*$sql .= "WHERE PEG.KDMATI = 'Y' OR PEG.TMTPENSIUN <= SYSDATE OR PEG.FLAG <> '1') PEGAWAI 
                WHERE ".$where.$where2." ORDER BY PEGAWAI.KOJAB ASC )X";*/

            $sql .= "WHERE (PEG.KDMATI = 'Y'  OR PEG.KLOGAD LIKE '11111111%')) PEGAWAI 
                WHERE ".$where.$where2." ORDER BY PEGAWAI.KOJAB ASC )X";
        }
        //echo $sql;
        $query = $this->db->query($sql)->result();
       return $query;
        
    }

    function getDataPegawaiV2($where="",$staakt="",$pendidikan="", $fasilitas=""){

        $sql = "SELECT NRK, NAMA, KOLOK, NALOKL, KOJAB, NAJABL, ESELON, NESELON, KOPANG
                FROM
                (
                SELECT PEG.NRK, PEG.NAMA, JAB.KOLOK, JAB.NALOKL, JAB.KOJAB, JAB.NAJABL, JAB.ESELON, JAB.NESELON, JAB.KOPANG, PEG.JENKEL, PEG.KDMATI, PEG.FLAG, PEG.AGAMA, PEG.STAPEG, PEG.STAWIN, JABP.MAKERTHNREAL, JABP.MAKERBLNREAL, USIA.UMURTHNREAL, USIA.UMURBLNREAL, HD.JENHUKDIS";
        if($pendidikan == 'nadik'){
            $sql .= ", DIK.UNIVER";
        }
        if ($fasilitas == 'jenfas') {
            $sql .= ", FAS.JENFAS";
        }
        
        $sql .= " FROM PERS_PEGAWAI1 PEG
                LEFT JOIN \"vw_jabatan_terakhir\" JAB ON PEG.NRK = JAB.NRK
                LEFT JOIN \"vw_jabatan_pertama\" JABP ON PEG.NRK = JABP.NRK
                LEFT JOIN \"vw_usia_pegawai\" USIA ON PEG.NRK = USIA.NRK
                LEFT JOIN \"vw_hukdis_terakhir\" HD ON PEG.NRK = HD.NRK";
                if($pendidikan == 'nadik'){
                    $sql .= " 
                            LEFT JOIN PERS_PENDIDIKAN DIK ON PEG.NRK = DIK.NRK ";    
                }
                if ($fasilitas == 'jenfas') {
                    $sql .= " 
                            LEFT JOIN PERS_KESRA FAS ON PEG.NRK = FAS.NRK AND THSAMPAI >= TO_CHAR(SYSDATE,'YYYY') ";    
                }
        
        if($staakt==2)
        {
            $sql .= ") PEGAWAI
                WHERE ".$where." ORDER BY KOJAB ASC";
        }
        else if($staakt==1)
        {
            /*$sql .= "WHERE (PEG.KDMATI <> 'Y' OR (PEG.TMTPENSIUN > SYSDATE OR PEG.TMTPENSIUN IS NULL)) AND PEG.FLAG = '1'
                ) PEGAWAI
                WHERE ".$where." ORDER BY KOJAB ASC";*/

            /*$sql .= "WHERE (PEG.KDMATI <> 'Y' OR (PEG.TMTPENSIUN > SYSDATE OR PEG.TMTPENSIUN IS NULL))
                ) PEGAWAI
                WHERE ".$where." ORDER BY KOJAB ASC";*/

            $sql .= "WHERE ((PEG.KDMATI <> 'Y' OR PEG.KDMATI IS NULL) AND PEG.KLOGAD NOT LIKE '11111111%')
                ) PEGAWAI
                WHERE ".$where." ORDER BY KOJAB ASC";

        }
        else if($staakt==0)
        {
            /*$sql .= "WHERE PEG.KDMATI = 'Y' OR PEG.TMTPENSIUN <= SYSDATE OR PEG.FLAG <> '1') PEGAWAI
                WHERE ".$where." ORDER BY KOJAB ASC";*/

            $sql .= "WHERE (PEG.KDMATI = 'Y' OR PEG.KLOGAD LIKE '11111111%')) PEGAWAI
                WHERE ".$where." ORDER BY KOJAB ASC";
        }
        

                // echo $sql; exit();
        
        $query = $this->db->query($sql);

        $table = "<table class='table table-bordered table-hovered' id='datapegawai'>";
        $table .= "<thead>";
        $table .= "<tr>";
        $table .= "<td>No.</td><td>NRK</td><td>Nama</td><td>Jabatan</td><td>Lokasi Kerja</td><td>Aksi</td>";
        $table .= "</tr>";
        $table .= "</thead>";
        $table .= "<tbody>";
        $no = 1;
        foreach ($query->result() as $row)
        {            
            $table .= "<tr>";
            $table .= "<td>".$no."</td>";
            $table .= "<td>".$row->NRK."</td>";
            $table .= "<td>".$row->NAMA."</td>";
            $table .= "<td>".$row->NAJABL."</td>";
            $table .= "<td>".$row->NALOKL."</td>";
            $table .= "<td><div class='row'><div class='col-sm-12'>
                                    <div class='row'>
                                        <div class='col-sm-2' align='center'>
                                            <form method='post' action='".site_url('pegawai/doview')."'>
                                                <input type='hidden' name='nrk' id='nrk' value='".$row->NRK."'>
                                                <button class='btn btn-outline btn-xs btn-primary' data-toggle='tool-tip' data-placement='bottom' title='detail pegawai' type='submit' pull-right><i class='fa fa-user'></i></button>
                                            </form>
                                        </div>
                                        <div class='col-sm-2' align='center'>
                                            <form method='post' action='".site_url('riwayat')."'>
                                                <input type='hidden' name='nrkP' id='nrkP' value='".$row->NRK."'>
                                                <button class='btn btn-outline btn-xs btn-success' data-toggle='tool-tip' data-placement='bottom' title='riwayat pegawai' type='submit' pull-right><i class='fa fa-th-list'></i></button>
                                            </form>
                                        </div>

                                        
                                    </div>
                            </div></div></td>";
            $table .= "</tr>";
            $no++;
        }
        $table .= "</tbody>";
        $table .= "<table>";
       
        return $table;
    }

     function getDataPegawaiV2Tes($where="",$staakt="",$pendidikan="", $fasilitas="", $global){

         $requestData = $this->input->post();

         $columns = array(
            0 => 'NRK',
            1 => 'NAMA',
            2 => 'NAJABL',
            3 => 'NALOKL'
            );

         $q = "SELECT
                    COUNT(NRK) AS jml
                FROM
                    PERS_PEGAWAI1";

         $rs = $this->db->query($q)->result();
         $totalData = $rs[0]->JML;

        $where2=" AND ";
        if($global != "")
        {
            $where2.="(
                            PEGAWAI.NRK = '".$global."'
                            OR (PEGAWAI.NAMA) LIKE UPPER('%".$global."%')
                            OR PEGAWAI.NIP = '".$global."'
                            OR PEGAWAI.NIP18 = '".$global."'
                        )";
        }
        else
        {
            $where2.= "6=6";
        }

         $sql = "SELECT rownum, X.* FROM
                (
                        SELECT rownum as RN, NRK, NAMA, KOLOK, NALOKL, KOJAB, NAJABL, ESELON, NESELON, KOPANG, KODE_JENJANG,NIP,NIP18
                        FROM
                        (
                        SELECT DISTINCT PEG.NRK, PEG.NAMA, PEG.NIP,PEG.NIP18,JAB.KOLOK, JAB.NALOKL, JAB.KOJAB, JAB.NAJABL, JAB.ESELON, JAB.NESELON, JAB.KOPANG, PEG.JENKEL, PEG.KDMATI, PEG.FLAG, PEG.AGAMA, PEG.STAPEG, PEG.STAWIN, JABP.MAKERTHNREAL, JABP.MAKERBLNREAL, USIA.UMURTHNREAL, USIA.UMURBLNREAL, HD.JENHUKDIS,DIK_AK.KODIK,JDIK.KODE_JENJANG";
         if($pendidikan == 'nadik'){
             $sql .= ", DIK.UNIVER";
         }
         if ($fasilitas == 'jenfas') {
             $sql .= ", FAS.JENFAS";
         }
         /*if ($jenjang_pendidikan == 'jenjdik') {
             $sql .= ", ";
         }*/

         $sql .= " FROM PERS_PEGAWAI1 PEG
                LEFT JOIN \"vw_jabatan_terakhir\" JAB ON PEG.NRK = JAB.NRK
                LEFT JOIN \"vw_jabatan_pertama\" JABP ON PEG.NRK = JABP.NRK
                LEFT JOIN \"vw_usia_pegawai\" USIA ON PEG.NRK = USIA.NRK
                LEFT JOIN \"vw_hukdis_terakhir\" HD ON PEG.NRK = HD.NRK
                LEFT JOIN \"VW_PENDIDIKAN_TERAKHIR\" DIK_AK ON PEG.NRK = DIK_AK.NRK 
                LEFT JOIN PERS_JENJANG_PENDIDIKAN JDIK ON SUBSTR(DIK_AK.KODIK,0,1) = JDIK.KODE_JENJANG ";
         if($pendidikan == 'nadik'){
             $sql .= "
                            LEFT JOIN PERS_PENDIDIKAN DIK ON PEG.NRK = DIK.NRK ";
         }
         if ($fasilitas == 'jenfas') {
             $sql .= "
                            LEFT JOIN PERS_KESRA FAS ON PEG.NRK = FAS.NRK AND THSAMPAI >= TO_CHAR(SYSDATE,'YYYY') ";
         }
         /*if ($jenjang_pendidikan == 'jenjdik') {
             $sql .= "
                            ";
         }*/

         if($staakt==2)
        {
            $sql .= ") PEGAWAI 
                WHERE ".$where.$where2." ORDER BY PEGAWAI.KOJAB ASC )X";
        }
        else if($staakt==1)
        {
            /*$sql .= "WHERE (PEG.KDMATI <> 'Y' OR (PEG.TMTPENSIUN > SYSDATE OR PEG.TMTPENSIUN IS NULL)) AND PEG.FLAG = '1'
                ) PEGAWAI 
                WHERE ".$where." ORDER BY PEGAWAI.KOJAB ASC )X";*/

            /*$sql .= "WHERE (PEG.KDMATI <> 'Y' OR (PEG.TMTPENSIUN > SYSDATE OR PEG.TMTPENSIUN IS NULL))
                ) PEGAWAI 
                WHERE ".$where.$where2." ORDER BY PEGAWAI.KOJAB ASC )X";*/

            $sql .= "WHERE ((PEG.KDMATI <> 'Y' OR PEG.KDMATI IS NULL) AND PEG.KLOGAD NOT LIKE '11111111%') 
                ) PEGAWAI 
                WHERE ".$where.$where2." ORDER BY PEGAWAI.KOJAB ASC )X";
        }
        else if($staakt==0)
        {
            /*$sql .= "WHERE PEG.KDMATI = 'Y' OR PEG.TMTPENSIUN <= SYSDATE OR PEG.FLAG <> '1') PEGAWAI 
                WHERE ".$where.$where2." ORDER BY PEGAWAI.KOJAB ASC )X";*/

            $sql .= "WHERE (PEG.KDMATI = 'Y'  OR PEG.KLOGAD LIKE '11111111%') ) PEGAWAI 
                WHERE ".$where.$where2." ORDER BY PEGAWAI.KOJAB ASC )X";
        }
        // echo $sql;

        $sql.=" WHERE 1=1";


        if( !empty($requestData['search']['value']) ) {   // if there is a search parameter, $requestData['search']['value'] contains search parameter
            $sql.=" AND ( X.NRK LIKE ('%".$requestData['search']['value']."%') ";    
            $sql.=" OR X.NAMA LIKE UPPER ('%".$requestData['search']['value']."%') ";
            $sql.=" OR X.NAJABL LIKE UPPER ('%".$requestData['search']['value']."%') ";
            $sql.=" OR X.NALOKL LIKE UPPER('%".$requestData['search']['value']."%') )";
        }

         //echo $sql;exit;
         $query = $this->db->query($sql);
         $totalFiltered = $query->num_rows();
         $startrow = $requestData['start'];
        $endrow = $startrow + $requestData['length'];

        $sql.=" AND RN BETWEEN $startrow  AND $endrow";
         //$sql.=" AND RN > ".$requestData['start']."  AND ROWNUM <= ".$requestData['length'];
        
         $query= $this->db->query($sql);
         $totalFiltered2 = $query->num_rows();
         if ($totalFiltered2==0){
             $totalData =0;
         }

         $data = array();

         $no = $requestData['start']+1;
         foreach ($query->result() as $row)
         {
             $nestedData=array();
         
             $nestedData[] = $row->NRK;
             $nestedData[] = $row->NAMA;
             $nestedData[] = $row->NAJABL;
             $nestedData[] = $row->NALOKL;
             $nestedData[] = "
                                    <div class='row'>
                                        <div class='col-sm-6' align='center'>
                                            <form method='post' action='".site_url('pegawai/doview2')."' target='_blank'>
                                                <input type='hidden' name='nrk' id='nrk' value='".$row->NRK."'>
                                                <button class='btn btn-outline btn-xs btn-primary' data-toggle='tool-tip' data-placement='bottom' title='detail pegawai' type='submit' pull-right><i class='fa fa-user'></i></button>
                                            </form>
                                        </div>
                                        <div class='col-sm-6' align='center'>
                                            <form method='post' action='".site_url('riwayat')."' target='_blank'>
                                                <input type='hidden' name='nrkP' id='nrkP' value='".$row->NRK."'>
                                                <button class='btn btn-outline btn-xs btn-success' data-toggle='tool-tip' data-placement='bottom' title='riwayat pegawai' type='submit' pull-right><i class='fa fa-th-list'></i></button>
                                            </form>
                                        </div>


                                    </div>
                            ";
             $data[]=$nestedData;
             $no++;
         }

         $json_data = array(
             "draw"            => intval( $requestData['draw'] ),
             "recordsTotal"    => intval( $totalData ),
             "recordsFiltered" => intval( $totalFiltered ),
             "data"            => $data
         );

         echo json_encode($json_data);
     }

     function queryBerkala($thbl="", $nrk,$spmu="")
     {
        if($spmu=="a")
        {
           $sql = "SELECT ROWNUM AS rn,nrk,nip18,nama,noskgol,TO_CHAR (talhir, 'dd-mm-yyyy') talhir,TO_CHAR (mugad, 'dd-mm-yyyy') mugad,TO_CHAR (tgijazah, 'dd-mm-yyyy') next_brkala,pathir,kodik,alamat || rt || rw || prop kolok,tunjab gjlama,tunfung gjbaru,masker,stapeg,mskgol,namisu as kantor,titel as hub_dinas FROM pers_duk_pangkat_bkala WHERE THBL='".$thbl."' AND NRK='".$nrk."' ORDER BY noskgol ASC";
        }
        else
        {
            $sql = "SELECT ROWNUM AS rn,nrk,nip18,nama,noskgol,TO_CHAR (talhir, 'dd-mm-yyyy') talhir,TO_CHAR (mugad, 'dd-mm-yyyy') mugad,TO_CHAR (tgijazah, 'dd-mm-yyyy') next_brkala,pathir,kodik,alamat || rt || rw || prop kolok,tunjab gjlama,tunfung gjbaru,masker,stapeg,mskgol,namisu as kantor,titel as hub_dinas FROM pers_duk_pangkat_bkala
                        WHERE THBL='".$thbl."' AND SPMU=UPPER('".$spmu."') AND NRK='".$nrk."' ORDER BY noskgol ASC";
        }
       
        $query = $this->db->query($sql);
        return $query->row();
     }



     function getDataPegawaiBerkala($where="",$jenis,$res,$res3,$v1,$v2,$v3,$v4,$v5,$v6,$v7,$valnrk){
        $requestData = $this->input->post();

        $getJenis = $jenis;

        $getRes = $res;
        if($res3=="")
        {
            $getRes3 = "a";    
        }
        else
        {
            $getRes3 = $res3;    
        }
        $getV1 = $v1;
        $getV2 = $v2;
        $getV3 = $v3;
        $getV4 = $v4;
        $getV5 = $v5;
        $getV6 = $v6;
        $getV7 = $v7;
        $getValnrk = $valnrk;

        $q = "SELECT
                    COUNT(NRK) AS jml
                FROM
                    PERS_PEGAWAI1";

        $rs = $this->db->query($q)->result();
        $totalData = $rs[0]->JML;


       
            $sql = "SELECT rownum, X.*
                    FROM
                    (
                        SELECT ROWNUM AS rn,nrk,nip18,nama,noskgol,TO_CHAR (talhir, 'dd-mm-yyyy') talhir,TO_CHAR (mugad, 'dd-mm-yyyy') mugad,TO_CHAR (tgijazah, 'dd-mm-yyyy') next_brkala,pathir,kodik,alamat || rt || rw || prop kolok,tunjab gjlama,tunfung gjbaru,masker,stapeg,mskgol,namisu as kantor,titel as hub_dinas
                        FROM pers_duk_pangkat_bkala
                        WHERE ".$where." ORDER BY klogad,noskgol
                    )X
                ";    
               //echo $sql;exit;
        $query = $this->db->query($sql);
        $totalFiltered = $query->num_rows();
        $temp =$requestData['start']+$requestData['length'];

        $sql.=" WHERE RN > ".$requestData['start']." AND RN <= ".$temp." AND ROWNUM <= ".$requestData['length'];
        //echo $sql;
        $query= $this->db->query($sql);

        $data = array();

    
        $no = 1;
        //$ur = "laporan/topdf";
        $ur = "laporan/cetakBerkalaNRK";

        foreach ($query->result() as $row)
        {            
            
            $nestedData=array();
            $nestedData[] = $no;
            $nestedData[] = $row->NRK;
            $nestedData[] = $row->NAMA;
            
            $nestedData[] = "
                                    <div class='row'>
                                        <div class='col-sm-4' align='center'>
                                            <form method='post' action='".site_url('pegawai/doview')."'>
                                                <input type='hidden' name='nrk' id='nrk' value='".$row->NRK."'>
                                                <button class='btn btn-outline btn-xs btn-primary' data-toggle='tool-tip' data-placement='bottom' title='detail pegawai' type='submit' pull-right><i class='fa fa-user'></i></button>
                                            </form>
                                        </div>
                                        <div class='col-sm-4' align='center'>
                                            <form method='post' action='".site_url('riwayat')."'>
                                                <input type='hidden' name='nrkP' id='nrkP' value='".$row->NRK."'>
                                                <button class='btn btn-outline btn-xs btn-success' data-toggle='tool-tip' data-placement='bottom' title='riwayat pegawai' type='submit' pull-right><i class='fa fa-th-list'></i></button>
                                            </form>
                                        </div>

                                        <div class='col-sm-4' align='center'>
                                            <form method='post' action='".site_url($ur)."' target='_blank'>                                  
                                                <input type='hidden' name='nrkP' id='nrkP' value='".$row->NRK."'>
                                                <input type='hidden' name='jns' id='jns' value='".$getJenis."'>
                                                <input type='hidden' name='res' id='res' value='".$getRes."'>
                                                <input type='hidden' name='res3' id='res3' value='".$getRes3."'>
                                                <input type='hidden' name='v1' id='v1' value='".$getV1."'>
                                                <input type='hidden' name='v2' id='v2' value='".$getV2."'>
                                                <input type='hidden' name='v3' id='v3' value='".$getV3."'>
                                                <input type='hidden' name='v4' id='v4' value='".$getV4."'>
                                                <input type='hidden' name='v5' id='v5' value='".$getV5."'>
                                                <input type='hidden' name='v6' id='v6' value='".$getV6."'>
                                                <input type='hidden' name='v7' id='v7' value='".$getV7."'>
                                                <input type='hidden' name='valnrk' id='valnrk' value='".$getValnrk."'>
                                                <button class='btn btn-outline btn-xs btn-danger' data-toggle='tool-tip' data-placement='bottom' title='print slip' type='submit' pull-right><i class='fa fa-file-pdf-o'></i></button>
                                            </form>
                                        </div>                                        
                                    </div>
                            ";
            $data[]=$nestedData;
            $no++;
        }
        $json_data = array(
           "draw"            => intval( $requestData['draw'] ),
            "recordsTotal"    => intval( $totalData ),
            "recordsFiltered" => intval( $totalFiltered ),
            "data"            => $data
        );

        echo json_encode($json_data);
    }



    function queryDPCP($thpensiun="",$nrk,$spmu)
     {

        if($spmu == "a")
        {
            //QUERY STRUKTUR ALAMAT LAMA
           /* $sql = "SELECT ROWNUM AS rn,A.NRK,A.KOLOK,B.NALOKL,A.KOPANG,TO_CHAR (A.TMTPANGKAT, 'DD-MM-YYYY') TMTPANGKAT,TO_CHAR (A.MUANG, 'DD-MM-YYYY') MUANG,
                            TO_CHAR (A.TALHIR, 'DD-MM-YYYY') TLHR,A.PATHIR,A.UNIVER,A.JENDIK,A.KODIK,A.KD,A.KOJAB,A.MASKER,SUBSTR(A.MASKER, 0, 2)THMASKER,SUBSTR(A.MASKER, 3, 2)BLMASKER,A.STAPEG,A.JENPEG,A.JENKEL,A.AGAMA,A.STAWIN,A.KLOGAD,A.SPMU,C.NAMA AS NAMA_SPMU,A.NIP,A.NAMA,A.GAPOK,A.GOL,TO_CHAR(A.MUGAD,'DD-MM-YYYY')MUGAD,A.JENRUB,A.MSKGOL,SUBSTR(A.MSKGOL, 0, 2)THGOL,SUBSTR(A.MSKGOL, 3, 2)BLGOL,A.NOSKGOL,TO_CHAR(A.TGSKGOL,'DD-MM-YYYY')TGSKGOL,
                        A.NOSKGAD,A.TGSKGAD,A.KOJABF,A.UMUR,A.NAMISU,A.KDKERJA,A.STATTUN,TO_CHAR(A.TMTPENSIUNYAD,'DD-MM-YYYY')TMTPENSIUNYAD,A.NIP18,A.TAHUN,A.ALAMAT,A.RT,A.RW,A.PROP,A.KOWIL,D.NAWIL,A.KOCAM,E.NACAM,A.KOKEL,F.NAKEL,G.KETERANGAN AS PROPINSI
                    FROM
                        PERS_DUK_PANGKAT_ALL A
                    LEFT JOIN PERS_LOKASI_TBL B ON A.KOLOK = B.KOLOK
                    LEFT JOIN PERS_TABEL_SPMU C ON A.SPMU = C.KODE_SPM
                    LEFT JOIN PERS_KOWIL_TBL D ON A.KOWIL = D.KOWIL
                    LEFT JOIN PERS_KOCAM_TBL E ON A.KOCAM = E.KOCAM AND D.KOWIL = E.KOWIL
                    LEFT JOIN PERS_KOKEL_TBL F ON A.KOKEL = F.KOKEL AND E.KOCAM = F.KOCAM AND D.KOWIL = F.KOWIL
                    LEFT JOIN PERS_PROP_RPT G ON A.PROP = G.PROP
                    WHERE
                        A.TAHUN = '".$thpensiun."' AND A.NRK ='".$nrk."'";*/

            //QUERY STRUKTUR ALAMAT BARU
             $sql = "SELECT ROWNUM AS rn,A.NRK,A.KOLOK,B.NALOKL,A.KOPANG,TO_CHAR (A.TMTPANGKAT, 'DD-MM-YYYY') TMTPANGKAT,TO_CHAR (A.MUANG, 'DD-MM-YYYY') MUANG,
                            TO_CHAR (A.TALHIR, 'DD-MM-YYYY') TLHR,A.PATHIR,A.UNIVER,A.JENDIK,A.KODIK,A.KD,A.KOJAB,A.MASKER,SUBSTR(A.MASKER, 0, 2)THMASKER,SUBSTR(A.MASKER, 3, 2)BLMASKER,A.STAPEG,A.JENPEG,A.JENKEL,A.AGAMA,A.STAWIN,A.KLOGAD,A.SPMU,C.NAMA AS NAMA_SPMU,A.NIP,A.NAMA,A.GAPOK,A.GOL,TO_CHAR(A.MUGAD,'DD-MM-YYYY')MUGAD,A.JENRUB,A.MSKGOL,SUBSTR(A.MSKGOL, 0, 2)THGOL,SUBSTR(A.MSKGOL, 3, 2)BLGOL,A.NOSKGOL,TO_CHAR(A.TGSKGOL,'DD-MM-YYYY')TGSKGOL,
                        A.NOSKGAD,A.TGSKGAD,A.KOJABF,A.UMUR,A.NAMISU,A.KDKERJA,A.STATTUN,TO_CHAR(A.TMTPENSIUNYAD,'DD-MM-YYYY')TMTPENSIUNYAD,A.NIP18,A.TAHUN,A.ALAMAT,A.RT,A.RW, TRIM(A .PROP) PROP,TRIM(A .KOWIL)KOWIL,D .NAMA AS NAWIL,TRIM(A .KOCAM)KOCAM,E .NAMA AS NACAM,TRIM(A .KOKEL) KOKEL,F.NAMA AS NAKEL,G .NAMA AS PROPINSI
                    FROM
                        PERS_DUK_PANGKAT_ALL A
                    LEFT JOIN PERS_LOKASI_TBL B ON A.KOLOK = B.KOLOK
                    LEFT JOIN PERS_TABEL_SPMU C ON A.SPMU = C.KODE_SPM
                    LEFT JOIN LOKASI D ON TRIM(A.KOWIL) = D.KODE
                    LEFT JOIN LOKASI E ON TRIM(A.KOCAM) = E.KODE
                    LEFT JOIN LOKASI F ON TRIM(A.KOKEL) = F.KODE
                    LEFT JOIN LOKASI G ON TRIM(A.PROP) = G.KODE
                    WHERE
                        A.TAHUN = '".$thpensiun."' AND A.NRK ='".$nrk."'";
        }
        else
        {
            //QUERY STRUKTUR ALAMAT LAMA
           /* $sql = "SELECT ROWNUM AS rn,A.NRK,A.KOLOK,B.NALOKL,A.KOPANG,TO_CHAR (A.TMTPANGKAT, 'DD-MM-YYYY') TMTPANGKAT,TO_CHAR (A.MUANG, 'DD-MM-YYYY') MUANG,
    						TO_CHAR (A.TALHIR, 'DD-MM-YYYY') TLHR,A.PATHIR,A.UNIVER,A.JENDIK,A.KODIK,A.KD,A.KOJAB,A.MASKER,SUBSTR(A.MASKER, 0, 2)THMASKER,SUBSTR(A.MASKER, 3, 2)BLMASKER,A.STAPEG,A.JENPEG,A.JENKEL,A.AGAMA,A.STAWIN,A.KLOGAD,A.SPMU,C.NAMA AS NAMA_SPMU,A.NIP,A.NAMA,A.GAPOK,A.GOL,TO_CHAR(A.MUGAD,'DD-MM-YYYY')MUGAD,A.JENRUB,A.MSKGOL,SUBSTR(A.MSKGOL, 0, 2)THGOL,SUBSTR(A.MSKGOL, 3, 2)BLGOL,A.NOSKGOL,TO_CHAR(A.TGSKGOL,'DD-MM-YYYY')TGSKGOL,
    					A.NOSKGAD,A.TGSKGAD,A.KOJABF,A.UMUR,A.NAMISU,A.KDKERJA,A.STATTUN,TO_CHAR(A.TMTPENSIUNYAD,'DD-MM-YYYY')TMTPENSIUNYAD,A.NIP18,A.TAHUN,A.ALAMAT,A.RT,A.RW,A.PROP,A.KOWIL,D.NAWIL,A.KOCAM,E.NACAM,A.KOKEL,F.NAKEL,G.KETERANGAN AS PROPINSI
    				FROM
    					PERS_DUK_PANGKAT_ALL A
    				LEFT JOIN PERS_LOKASI_TBL B ON A.KOLOK = B.KOLOK
    				LEFT JOIN PERS_TABEL_SPMU C ON A.SPMU = C.KODE_SPM
                    LEFT JOIN PERS_KOWIL_TBL D ON A.KOWIL = D.KOWIL
                    LEFT JOIN PERS_KOCAM_TBL E ON A.KOCAM = E.KOCAM AND D.KOWIL = E.KOWIL
                    LEFT JOIN PERS_KOKEL_TBL F ON A.KOKEL = F.KOKEL AND E.KOCAM = F.KOCAM AND D.KOWIL = F.KOWIL
                    LEFT JOIN PERS_PROP_RPT G ON A.PROP = G.PROP
    				WHERE
    					A.TAHUN = '".$thpensiun."' AND A.SPMU = UPPER('".$spmu."') AND A.NRK ='".$nrk."'AND A.NRK ='".$nrk."'";*/

            //QUERY STRUKTUR ALAMAT BARU
            $sql = "SELECT ROWNUM AS rn,A.NRK,A.KOLOK,B.NALOKL,A.KOPANG,TO_CHAR (A.TMTPANGKAT, 'DD-MM-YYYY') TMTPANGKAT,TO_CHAR (A.MUANG, 'DD-MM-YYYY') MUANG,
                            TO_CHAR (A.TALHIR, 'DD-MM-YYYY') TLHR,A.PATHIR,A.UNIVER,A.JENDIK,A.KODIK,A.KD,A.KOJAB,A.MASKER,SUBSTR(A.MASKER, 0, 2)THMASKER,SUBSTR(A.MASKER, 3, 2)BLMASKER,A.STAPEG,A.JENPEG,A.JENKEL,A.AGAMA,A.STAWIN,A.KLOGAD,A.SPMU,C.NAMA AS NAMA_SPMU,A.NIP,A.NAMA,A.GAPOK,A.GOL,TO_CHAR(A.MUGAD,'DD-MM-YYYY')MUGAD,A.JENRUB,A.MSKGOL,SUBSTR(A.MSKGOL, 0, 2)THGOL,SUBSTR(A.MSKGOL, 3, 2)BLGOL,A.NOSKGOL,TO_CHAR(A.TGSKGOL,'DD-MM-YYYY')TGSKGOL,
                        A.NOSKGAD,A.TGSKGAD,A.KOJABF,A.UMUR,A.NAMISU,A.KDKERJA,A.STATTUN,TO_CHAR(A.TMTPENSIUNYAD,'DD-MM-YYYY')TMTPENSIUNYAD,A.NIP18,A.TAHUN,A.ALAMAT,A.RT,A.RW,TRIM(A .PROP) PROP,TRIM(A .KOWIL)KOWIL,D .NAMA AS NAWIL,TRIM(A .KOCAM)KOCAM,E .NAMA AS NACAM,TRIM(A .KOKEL) KOKEL,F.NAMA AS NAKEL,G .NAMA AS PROPINSI
                    FROM
                        PERS_DUK_PANGKAT_ALL A
                    LEFT JOIN PERS_LOKASI_TBL B ON A.KOLOK = B.KOLOK
                    LEFT JOIN PERS_TABEL_SPMU C ON A.SPMU = C.KODE_SPM
                    LEFT JOIN LOKASI D ON TRIM(A.KOWIL) = D.KODE
                    LEFT JOIN LOKASI E ON TRIM(A.KOCAM) = E.KODE
                    LEFT JOIN LOKASI F ON TRIM(A.KOKEL) = F.KODE
                    LEFT JOIN LOKASI G ON TRIM(A.PROP) = G.KODE
                    WHERE
                        A.TAHUN = '".$thpensiun."' AND A.SPMU = UPPER('".$spmu."') AND A.NRK ='".$nrk."'AND A.NRK ='".$nrk."'";
        }

        $query = $this->db->query($sql);
        return $query->row();
     }

    function getDataPegawaiPensiun($where="",$jenis,$res,$res3,$v1,$v2,$v3,$v4,$v5,$v6,$v7,$valnrk){
        $requestData = $this->input->post();

        $getJenis = $jenis;

        $getRes = $res;
        $getRes3;
        if($res3=="")
        {
            $getRes3 = "a";    
        }
        else
        {
            $getRes3 = $res3;    
        }

        //var_dump($getRes3);exit;
        $getV1 = $v1;
        $getV2 = $v2;
        $getV3 = $v3;
        $getV4 = $v4;
        $getV5 = $v5;
        $getV6 = $v6;
        $getV7 = $v7;
        $getValnrk = $valnrk;

        $q = "SELECT
                    COUNT(NRK) AS jml
                FROM
                    PERS_PEGAWAI1";

        $rs = $this->db->query($q)->result();
        $totalData = $rs[0]->JML;


       
//            $sql = "SELECT rownum, X.*
//                    FROM
//                    (
//                        SELECT rownum as rn,nrk, nip18, nama, noskgol, TO_CHAR(talhir,'dd-mm-yyyy') talhir, TO_CHAR(mugad,'dd-mm-yyyy') mugad, pathir, kodik, alamat||rt||rw||prop kolok, tunjab gjlama, tunfung gjbaru, masker, stapeg, mskgol
//                        FROM pers_duk_pangkat_bkala
//                        WHERE ".$where." ORDER BY klogad,noskgol
//                    )X
//                ";

        $sql = "SELECT rownum, X.*
                    FROM
                    (
                        SELECT rownum as rn, NRK,NAMA from PERS_DUK_PANGKAT_ALL
                        WHERE ".$where."	
                    )X
                
                ";
        //echo $sql;

        $query = $this->db->query($sql);
        $totalFiltered = $query->num_rows();
        $temp =$requestData['start']+$requestData['length'];

        $sql.=" WHERE RN > ".$requestData['start']." AND RN <= ".$temp." AND ROWNUM <= ".$requestData['length'];
//        echo $sql;
        $query= $this->db->query($sql);

        $data = array();

    
        $no = 1;
        $ur;
        
        //$ur = "laporan/topdf2";
        $ur = "laporan/cetakDPCPNRK";

        foreach ($query->result() as $row)
        {            
            
            $nestedData=array();
            $nestedData[] = $no;
            $nestedData[] = $row->NRK;
            $nestedData[] = $row->NAMA;
            
            $nestedData[] = "
                                    <div class='row'>
                                        <div class='col-sm-4' align='center'>
                                            <form method='post' action='".site_url('pegawai/doview')."'>
                                                <input type='hidden' name='nrk' id='nrk' value='".$row->NRK."'>
                                                <button class='btn btn-outline btn-xs btn-primary' data-toggle='tool-tip' data-placement='bottom' title='detail pegawai' type='submit' pull-right><i class='fa fa-user'></i></button>
                                            </form>
                                        </div>
                                        <div class='col-sm-4' align='center'>
                                            <form method='post' action='".site_url('riwayat')."'>
                                                <input type='hidden' name='nrkP' id='nrkP' value='".$row->NRK."'>
                                                <button class='btn btn-outline btn-xs btn-success' data-toggle='tool-tip' data-placement='bottom' title='riwayat pegawai' type='submit' pull-right><i class='fa fa-th-list'></i></button>
                                            </form>
                                        </div>

                                        <div class='col-sm-4' align='center'>
                                            <form method='post' action='".site_url($ur)."' target='_blank'>                                  
                                                <input type='hidden' name='nrkP' id='nrkP' value='".$row->NRK."'>
                                                <input type='hidden' name='jns' id='jns' value='".$getJenis."'>
                                                <input type='hidden' name='res' id='res' value='".$getRes."'>
                                                <input type='hidden' name='res3' id='res3' value='".$getRes3."'>
                                                <input type='hidden' name='v1' id='v1' value='".$getV1."'>
                                                <input type='hidden' name='v2' id='v2' value='".$getV2."'>
                                                <input type='hidden' name='v3' id='v3' value='".$getV3."'>
                                                <input type='hidden' name='v4' id='v4' value='".$getV4."'>
                                                <input type='hidden' name='v5' id='v5' value='".$getV5."'>
                                                <input type='hidden' name='v6' id='v6' value='".$getV6."'>
                                                <input type='hidden' name='v7' id='v7' value='".$getV7."'>
                                                <input type='hidden' name='valnrk' id='valnrk' value='".$getValnrk."'>
                                                <button class='btn btn-outline btn-xs btn-danger' data-toggle='tool-tip' data-placement='bottom' title='print slip' type='submit' pull-right><i class='fa fa-file-pdf-o'></i></button>
                                            </form>
                                        </div>                                        
                                    </div>
                            ";
            $data[]=$nestedData;
            $no++;
        }
        $json_data = array(
           "draw"            => intval( $requestData['draw'] ),
            "recordsTotal"    => intval( $totalData ),
            "recordsFiltered" => intval( $totalFiltered ),
            "data"            => $data
        );

        echo json_encode($json_data);
    }

    function getAllDataPegawaiPensiun($where=""){
   
        $sql = "SELECT NRK from PERS_DUK_PANGKAT_ALL
                WHERE ".$where."    
                ";
        

        $query = $this->db->query($sql)->result();
        return $query;

    }

    function getAllDataPegawaiBerkala($where="")
    {
        $sql = "SELECT NRK FROM PERS_DUK_PANGKAT_BKALA
                WHERE ".$where."";

        $query = $this->db->query($sql)->result();
        return $query;
    }

    function getOptionEselon()
    {
        $sql= " SELECT ESELON, NESELON2
                FROM PERS_ESELON_TBL 
                WHERE ESELON <> '  ' 
                ORDER BY ESELON ASC";
        $query = $this->db->query($sql);

        $option = "<select class='form-control chosen-param' name='eselon[]' id='eselon[]' data-placeholder='Pilih Eselon...'>";
        $option .= "<option></option>";

        $i=1;
        $selected="";
        foreach ($query->result() as $row)
        {            
            if ($i==1) {
                $selected="selected";
            } else {
                $selected="";
            }
            $option .= "<option value='".$row->ESELON."' $selected>".$row->NESELON2."</option>";

            $i += 1;
        }
        $option .= "</select>";
       
        return $option;
    }

    function getOptionPangkat()
    {
        $sql= " SELECT KOPANG, GOL ||' - '|| NAPANG NAPANG, NAPANG NAPANG2
                FROM PERS_PANGKAT_TBL
                WHERE KOPANG >= '211' AND KOPANG <= '255' 
                ORDER BY KOPANG ASC";
        $query = $this->db->query($sql);

        $option = "<select class='form-control chosen-param' name='pangkat[]' id='pangkat[]' data-placeholder='Pilih Pangkat...'>";
        $option .= "<option></option>";

        $i=1;
        $selected="";
        foreach ($query->result() as $row)
        {
            if ($i==1) {
                $selected="selected";
            } else {
                $selected="";
            }

            $option .= "<option value='".$row->KOPANG."' $selected>".$row->NAPANG."</option>";

            $i += 1;
        }
        $option .= "</select>";
       
        return $option;
    }
    
    function getOptionLokasiKerja()
    {
        $sql= " SELECT DISTINCT nalokl 
            FROM  pers_lokasi_tbl 
            WHERE NALOKL != '.'  AND AKTIF = '1'
            ORDER BY nalokl ASC";
        $query = $this->db->query($sql);

        $option = "<select class='form-control chosen-param' name='kolok[]' id='kolok[]' data-placeholder='Pilih Lokasi Kerja...'>";
        $option .= "<option></option>";

        $i=1;
        $selected="";
        foreach ($query->result() as $row)
        {
            if ($i==1) {
                $selected="selected";
            } else {
                $selected="";
            }
            $option .= "<option value='".$row->NALOKL."' $selected>".$row->NALOKL."</option>";

            $i += 1;
        }
        $option .= "</select>";
       
        return $option;
    }

    // function getOptionJabatan()
    // {        

    //     $option = "<select class='form-control chosen-param' name='jabatan[]' id='jabatan[]' data-placeholder='Pilih Jenis Jabatan...'>";
    //     $option .= "<option></option>";        
    //     $option .= "<option value='F'>FUNGSIONAL</option>";
    //     $option .= "<option value='S'>STRUKTURAL</option>";
    //     $option .= "</select>";
       
    //     return $option;
    // }

    function getOptionJabatan()
    {        

        /*$sql= " SELECT KOJAB, NAJABL 
                FROM(
                    SELECT JAB.KOJAB, JAB.NAJABL 
                    FROM PERS_KOJAB_TBL JAB
                    INNER JOIN PERS_LOKASI_TBL LOK ON JAB.KOLOK = LOK.KOLOK
                    WHERE LOK.AKTIF = 1 AND JAB.AKTIF = 1 
                    GROUP BY JAB.KOJAB, JAB.NAJABL
                    UNION ALL
                    SELECT KOJAB, NAJABL 
                    FROM PERS_KOJABF_TBL 
                    GROUP BY KOJAB, NAJABL
                ) KOJABTBL
                ORDER BY NAJABL ASC";*/

        $sql="SELECT DISTINCT NAJABL 
                FROM(
                    SELECT TRIM(JAB.NAJABL)  AS NAJABL
                    FROM PERS_KOJAB_TBL JAB
                    INNER JOIN PERS_LOKASI_TBL LOK ON JAB.KOLOK = LOK.KOLOK
                    WHERE LOK.AKTIF = 1 
                    GROUP BY TRIM(JAB.NAJABL)
                    UNION ALL
                    SELECT DISTINCT NAJABL 
                    FROM PERS_KOJABF_TBL 
                ) KOJABTBL
                WHERE NAJABL NOT IN('.','A') 
        
                ORDER BY NAJABL ASC";
        $query = $this->db->query($sql);

        $option = "<select class='form-control chosen-param' name='jabatan[]' id='jabatan[]' data-placeholder='Pilih Jabatan...'>";
        $option .= "<option></option>";

        $i=1;
        $selected="";
        foreach ($query->result() as $row)
        {
            if ($i==1) {
                $selected="selected";
            } else {
                $selected="";
            }
            $option .= "<option value='".$row->NAJABL."' $selected>".$row->NAJABL."</option>";

            $i += 1;
        }
        $option .= "</select>";
       
        return $option;
    }

    function getOptionLokasiStruktural()
    {        

       $sql= " SELECT KOLOK, NALOKL
                FROM PERS_LOKASI_TBL
                WHERE AKTIF = '1' 
                ORDER BY NALOKL ASC";
        $query = $this->db->query($sql);

        $option = "<select class='form-control chosen-param' name='kolokS[]' id='kolokS[]' data-placeholder='Pilih Lokasi Kerja...' onchange='return getOptionJabatanStruktural(this);'>";
        $option .= "<option></option>";

        $i=1;
        $selected="";
        foreach ($query->result() as $row)
        {
            if ($i==1) {
                $selected="selected";
            } else {
                $selected="";
            }
            $option .= "<option value='".$row->KOLOK."' $selected>".$row->NALOKL."</option>";

            $i += 1;
        }
        $option .= "</select>";
       
        return $option;
    }

    function getOptionJabatanStruktural($kolok)
    {        

        $sql= " SELECT KOJAB, NAJABL
                FROM PERS_KOJAB_TBL
                WHERE KOLOK = '".$KOLOK."' 
                ORDER BY NAJABL ASC";
        $query = $this->db->query($sql);

        $option = "<select class='form-control chosen-param' name='kolokS[]' id='kolokS[]' data-placeholder='Pilih Nama Jabatan...' onchange='return getOptionJabatanStruktural();'>";
        $option .= "<option></option>";

        $i=1;
        $selected="";
        foreach ($query->result() as $row)
        {
            if ($i==1) {
                $selected="selected";
            } else {
                $selected="";
            }
            $option .= "<option value='".$row->KOJAB."' $selected>".$row->NAJABL."</option>";

            $i += 1;
        }
        $option .= "</select>";
       
        return $option;
    }

    function getOptionJabatanFungsional()
    {        

        $sql= " SELECT KOJAB, NAJABL
                FROM PERS_KOJAB_TBL                
                ORDER BY NAJABL ASC";
        $query = $this->db->query($sql);

        $option = "<select class='form-control chosen-param' name='kolokS[]' id='kolokS[]' data-placeholder='Pilih Nama Jabatan...' onchange='return getOptionJabatanStruktural();'>";
        $option .= "<option></option>";

        $i=1;
        $selected="";
        foreach ($query->result() as $row)
        {
            if ($i==1) {
                $selected="selected";
            } else {
                $selected="";
            }
            $option .= "<option value='".$row->KOJAB."' $selected>".$row->NAJABL."</option>";

            $i += 1;
        }
        $option .= "</select>";
       
        return $option;
    }

    function getOptionJenisKelamin()
    {        

        $option = "<select class='form-control chosen-param' name='jeniskelamin[]' id='jeniskelamin[]' data-placeholder='Pilih Jenis Kelamin...'>";
        $option .= "<option></option>";        
        $option .= "<option value='L' selected>Laki - laki</option>";
        $option .= "<option value='P'>Perempuan</option>";
        $option .= "</select>";
       
        return $option;
    }

    function getOptionStatusMenikah()
    {

        $sql= " SELECT STAWIN, KETERANGAN
                FROM PERS_STAWIN_RPT 
                ORDER BY KETERANGAN ASC";
        $query = $this->db->query($sql);

        $option = "<select class='form-control chosen-param' name='statuskawin[]' id='statuskawin[]' data-placeholder='Pilih Status Menikah...' >";
        $option .= "<option></option>";

        $i=1;
        $selected="";
        foreach ($query->result() as $row)
        {
            if ($i==1) {
                $selected="selected";
            } else {
                $selected="";
            }
            $option .= "<option value='".$row->STAWIN."' $selected>".$row->KETERANGAN."</option>";

            $i += 1;
        }
        $option .= "</select>";
       
        return $option;
    }

    function getOptionAgama()
    {        

        $sql= " SELECT AGAMA, KETERANGAN
                FROM PERS_AGAMA_RPT 
                ORDER BY KETERANGAN ASC";
        $query = $this->db->query($sql);

        $option = "<select class='form-control chosen-param' name='agama[]' id='agama[]' data-placeholder='Pilih Agama...' >";
        $option .= "<option></option>";

        $i=1;
        $selected="";
        foreach ($query->result() as $row)
        {
            if ($i==1) {
                $selected="selected";
            } else {
                $selected="";
            }
            $option .= "<option value='".$row->AGAMA."' $selected>".$row->KETERANGAN."</option>";

            $i += 1;
        }
        $option .= "</select>";
       
        return $option;
    }

    function getOptionStapeg()
    {        

        $option = "<select class='form-control chosen-param' name='stapeg[]' id='stapeg[]' data-placeholder='Pilih Status Pegawai...'>";
        $option .= "<option></option>";        
        $option .= "<option value='1' selected>CPNS</option>";
        $option .= "<option value='2'>PNS</option>";
        $option .= "</select>";
       
        return $option;
    }

    function getOptionStatusAktif()
    {        
        $option = "<select class='form-control chosen-param' name='statusaktif[]' id='statusaktif[]' data-placeholder='Pilih Status...'>";
        $option .= "<option></option>";        
        $option .= "<option value='1' selected>Aktif</option>";
        $option .= "<option value='0'>Tidak Aktif</option>";
        $option .= "</select>";
       
        return $option;
    }

    // function getOptionJenisPendidikan()
    // {        

    //     $option = "<select class='form-control chosen-param' name='jendik[]' id='jendik[]' data-placeholder='Pilih Jenis Pendidikan...'>";
    //     $option .= "<option></option>";        
    //     $option .= "<option value='aktif'>Pendidikan Formal</option>";
    //     $option .= "<option value='nonaktif'>Pendidikan Non Formal</option>";
    //     $option .= "</select>";
       
    //     return $option;
    // }

    function getOptionJenisPendidikan()
    {        
        $sql= " SELECT KDUNIVER, NAUNIVER
                FROM PERS_UNIVER_TBL 
                WHERE KDUNIVER <> '00000'
                ORDER BY NAUNIVER ASC";
        $query = $this->db->query($sql);

        $option = "<select class='form-control chosen-param' name='jendik[]' id='jendik[]' data-placeholder='Pilih Universitas Pendidikan...' >";
        $option .= "<option></option>";

        $i=1;
        $selected="";
        foreach ($query->result() as $row)
        {
            if ($i==1) {
                $selected="selected";
            } else {
                $selected="";
            }
            $option .= "<option value='".$row->KDUNIVER."' $selected>".$row->NAUNIVER."</option>";

            $i += 1;
        }
        $option .= "</select>";
       
        return $option;
    }

    function getOptionJenjangPendidikan()
    {        

        $sql= " SELECT KODE_JENJANG, KETERANGAN
                FROM PERS_JENJANG_PENDIDIKAN 
                ORDER BY KETERANGAN ASC";
        $query = $this->db->query($sql);

        $option = "<select class='form-control chosen-param' name='jenjdik[]' id='jenjdik[]' data-placeholder='Pilih Jenjang Pendidikan...' >";
        $option .= "<option></option>";

        $i=1;
        $selected="";
        foreach ($query->result() as $row)
        {
            if ($i==1) {
                $selected="selected";
            } else {
                $selected="";
            }
            $option .= "<option value='".$row->KODE_JENJANG."' $selected>".$row->KETERANGAN."</option>";

            $i += 1;
        }
        $option .= "</select>";
       
        return $option;
    }

    // function getOptionPendidikan($jendik)
    // {
    //     $sql= " SELECT AGAMA, KETERANGAN
    //             FROM PERS_AGAMA_RPT 
    //             ORDER BY KETERANGAN ASC";
    //     $query = $this->db->query($sql);

    //     $option = "<select class='form-control chosen-param' name='agama[]' id='agama[]' data-placeholder='Pilih Agama...' >";
    //     $option .= "<option></option>";
    //     foreach ($query->result() as $row)
    //     {
    //         $option .= "<option value='".$row->AGAMA."'>".$row->KETERANGAN."</option>";
    //     }
    //     $option .= "</select>";
       
    //     return $option;
    // }

    function getOptionMasaKerja()
    {        

        $option = "<select class='form-control chosen-param' name='masakerja[]' id='masakerja[]' data-placeholder='Pilih Masa Kerja (tahun)...'>";
        $option .= "<option></option>";        

        $selected="";
        for ($i=1; $i < 101; $i++) { 
            if ($i==1) {
                $selected="selected";
            } else {
                $selected="";
            }
            $option .= "<option value='".$i."' $selected>".$i." tahun</option>";
        }
        $option .= "</select>";
       
        return $option;
    }

    function getOptionHukdis(){
        $sql= " SELECT JENHUKDIS, KETERANGAN
                FROM PERS_JENHUKDIS_RPT 
                ORDER BY KETERANGAN ASC";
        $query = $this->db->query($sql);

        $option = "<select class='form-control chosen-param' name='hukdis[]' id='hukdis[]' data-placeholder='Pilih Jenis Hukuman Disiplin' >";
        $option .= "<option selected readonly value='all'>Semua Jenis Hukuman Disiplin</option>";

        $i=1;
        $selected="";
        foreach ($query->result() as $row)
        {
            if ($i==1) {
                $selected = "";
                //$selected="selected";
            } else {
                $selected="";
            }
            $option .= "<option value='".$row->JENHUKDIS."' $selected>".$row->KETERANGAN."</option>";

            $i += 1;
        }
        $option .= "</select>";
       
        return $option;
    }

    public function getOptionUsia()
    {
        /*$option = "<select class='form-control chosen-param' name='usia[]' id='usia[]' data-placeholder='Pilih Jumlah Usia...'>";
        $option .= "<option></option>";        
        for ($i=15; $i < 101; $i++) { 
            $option .= "<option value='".$i."'>".$i." tahun</option>";
        }
        $option .= "</select>";*/

        $option="<script type='text/javascript'>
            function numbersonly1(myfield, e, dec) 
            {   
                var key; 
                var keychar; 
                if (window.event)
                    key = window.event.keyCode; 
                else if (e) 
                    key = e.which; 
                else 
                    return true; 
                keychar = String.fromCharCode(key); 

                // control keys 
                if ((key==null) || (key==0) || (key==8) || (key==9) || (key==13) || (key==27) ) 
                return true; 

                // numbers 
                else if ((('0123456789').indexOf(keychar) > -1))
                 return true; 

                // decimal point jump 
                else if (dec && (keychar == '.')) 
                { 
                    myfield.form.elements[dec].focus(); return false; 
                } 
                else 
                    return false; 
            }
        </script>";

        $option .="<input type='text' class='form-control' name='usia1[]' id='usia1[]' onkeypress='return numbersonly1(this,event)' maxlength='2' style='width:30%' placeholder='ANGKA' value='29'>&nbsp; TAHUN &nbsp; - &nbsp;<input type='text' name='usia2[]' id='usia2[]' class='form-control' onkeypress='return numbersonly1(this,event)' maxlength='2' style='width:30%' placeholder='ANGKA' value='30'>&nbsp; TAHUN";

       
        return $option;
    }

    public function getOptionFasilitas()
    {
        $sql= " SELECT JENFAS, KETERANGAN
                FROM PERS_JENFAS_RPT 
                ORDER BY KETERANGAN ASC";
        $query = $this->db->query($sql);

        $option = "<select class='form-control chosen-param' name='jenfas[]' id='jenfas[]' data-placeholder='Pilih Jenis Fasilitas' >";
        $option .= "<option selected readonly value='all'>Semua Jenis Fasilitas</option>";

        $i=1;
        $selected="";
        foreach ($query->result() as $row)
        {
            if ($i==1) {
                $selected = "";
                //$selected="selected";
            } else {
                $selected="";
            }
            $option .= "<option value='".$row->JENFAS."' $selected>".$row->KETERANGAN."</option>";

            $i += 1;
        }
        $option .= "</select>";
       
        return $option;
    }

    public function getTahunBerkala($thbl="")
    {
        $sql="SELECT DISTINCT(THBL) THBL FROM PERS_DUK_PANGKAT_BKALA ORDER BY THBL DESC";

        $query = $this->db->query($sql);        

        $option  = "";
        
        foreach($query->result() as $row){
            if($thbl == $row->THBL)
            {
                $option .= "<option selected value='".$row->THBL."'>".$row->THBL."</option>";
            }
            else
            {          
                $option .= "<option value='".$row->THBL."'>".$row->THBL."</option>";
            }
        }
        
        return $option;       
    }

    public function getTahunPensiun($tahun="")
    {
        $sql="SELECT DISTINCT(TAHUN) TAHUN FROM PERS_DUK_PANGKAT_ALL WHERE TAHUN IS NOT NULL ORDER BY TAHUN DESC";

        $query = $this->db->query($sql);        

        $option  = "";
        
        foreach($query->result() as $row){
            if($tahun == $row->TAHUN)
            {
                $option .= "<option selected value='".$row->TAHUN."'>".$row->TAHUN."</option>";
            }
            else
            {          
                $option .= "<option value='".$row->TAHUN."'>".$row->TAHUN."</option>";
            }
        }
        
        return $option;       
    }

    public function getSpmuFromBkala($thbl)
    {
        
        $sql="SELECT BKL.SPMU,B.NAMA FROM 
                (
                    SELECT DISTINCT(SPMU) SPMU FROM PERS_DUK_PANGKAT_BKALA A WHERE THBL='".$thbl."' ORDER BY SPMU ASC) BKL
                    LEFT JOIN PERS_TABEL_SPMU B ON BKL.SPMU = B.KODE_SPM ORDER BY BKL.SPMU ASC
            ";

        $query = $this->db->query($sql);        

        $option  = "";
        $option .= "<option selected value=''>-</option>"; 
        foreach($query->result() as $row){
                     
                $option .= "<option value='".$row->SPMU."'>".$row->SPMU." - ".$row->NAMA."</option>";
            
        }
        
        return $option;       
    }

    public function getSpmuFromPensiun($tahun)
    {
        
        $sql="SELECT BKL.SPMU,B.NAMA FROM (
                SELECT DISTINCT(SPMU) SPMU FROM PERS_DUK_PANGKAT_ALL A WHERE TAHUN='".$tahun."' ORDER BY SPMU ASC) BKL
                LEFT JOIN PERS_TABEL_SPMU B ON BKL.SPMU = B.KODE_SPM ORDER BY BKL.SPMU ASC
            ";

        $query = $this->db->query($sql);        

        $option  = "";
        $option .= "<option selected value=''>-</option>"; 
        foreach($query->result() as $row){
                          
                $option .= "<option value='".$row->SPMU."'>".$row->SPMU." - ".$row->NAMA."</option>";
            
        }
        
        return $option;       
    }

}

?>
