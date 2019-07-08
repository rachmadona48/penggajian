<?php 

 class Mreportk extends CI_Model {

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


    function getDataPegawaiTes($where=""){
        $requestData = $this->input->post();

        $q = "SELECT
                    COUNT(NRK) AS jml
                FROM
                    PERS_PEGAWAI1";

        $rs = $this->db->query($q)->result();
        $totalData = $rs[0]->JML;

        $sql = "SELECT rownum, X.* FROM 
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
                        WHERE (PEG.KDMATI <> 'Y' OR (PEG.TMTPENSIUN > SYSDATE OR PEG.TMTPENSIUN IS NULL)) AND PEG.FLAG = '1'
                    ) PEGAWAI
                    WHERE ".$where." ORDER BY PEGAWAI.KOJAB ASC
                )X";
        //ECHO $sql;
        $query = $this->db->query($sql);
        $totalFiltered = $query->num_rows();
      //  $temp =$requestData['start']+$requestData['length'];

        $sql.=" WHERE RN > 0 AND RN <= 10 AND ROWNUM <= 10";
       // $sql.=" ORDER BY ". $columns[$requestData['order'][0]['column']]."   ".$requestData['order'][0]['dir']." ";  // adding length
       
        $query= $this->db->query($sql);

        $data = array();

        //$table = "<div class='animated fadeInUp'>";
        //$table .= "<table class='table table-bordered table-hovered' id='datapegawai' class='datapegawai'>";
        //$table .= "<thead>";
        //$table .= "<tr>";
        //$table .= "<td>No.</td><td>NRK</td><td>Nama</td><td>Jabatan</td><td>Lokasi Kerja</td><td>Aksi</td>";
        //$table .= "</tr>";
        //$table .= "</thead>";
       // $table .= "<tbody>";
        $no = 1;
        foreach ($query->result() as $row)
        {            
            /*$table .= "<tr>";
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
            $table .= "</tr>";*/
            $nestedData=array();
            $nestedData[] = $no;
            $nestedData[] = $row->NRK;
            $nestedData[] = $row->NAMA;
            $nestedData[] = $row->NAJABL;
            $nestedData[] = $row->NALOKL;
            $nestedData[] = "<div class='row'><div class='col-sm-12'>
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
                            </div></div>";
            $data[]=$nestedData;
            $no++;
        }
        $json_data = array(
          // "draw"            => intval( $requestData['draw'] ),
            "recordsTotal"    => intval( $totalData ),
            "recordsFiltered" => intval( $totalFiltered ),
            "data"            => $data
        );

        echo json_encode($json_data);
    }

    function getDataPegawaiV2($where="",$pendidikan="", $fasilitas=""){

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
                
        $sql .= "WHERE (PEG.KDMATI <> 'Y' OR (PEG.TMTPENSIUN > SYSDATE OR PEG.TMTPENSIUN IS NULL)) AND PEG.FLAG = '1'
                ) PEGAWAI
                WHERE ".$where." ORDER BY KOJAB ASC";

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
        $table .= "<table>";
       
        return $table;
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
        foreach ($query->result() as $row)
        {            
            $option .= "<option value='".$row->ESELON."'>".$row->NESELON2."</option>";
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
        foreach ($query->result() as $row)
        {
            $option .= "<option value='".$row->KOPANG."'>".$row->NAPANG2."</option>";
        }
        $option .= "</select>";
       
        return $option;
    }
    
    function getOptionLokasiKerja()
    {
        $sql= " SELECT KOLOK, NALOKL
                FROM PERS_LOKASI_TBL
                WHERE AKTIF = '1' 
                ORDER BY NALOKL ASC";
        $query = $this->db->query($sql);

        $option = "<select class='form-control chosen-param' name='kolok[]' id='kolok[]' data-placeholder='Pilih Lokasi Kerja...'>";
        $option .= "<option></option>";
        foreach ($query->result() as $row)
        {
            $option .= "<option value='".$row->KOLOK."'>".$row->NALOKL."</option>";
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

        $sql= " SELECT KOJAB, NAJABL 
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
                ORDER BY NAJABL ASC";
        $query = $this->db->query($sql);

        $option = "<select class='form-control chosen-param' name='jabatan[]' id='jabatan[]' data-placeholder='Pilih Jabatan...'>";
        $option .= "<option></option>";
        foreach ($query->result() as $row)
        {
            $option .= "<option value='".$row->KOJAB."'>".$row->NAJABL."</option>";
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
        foreach ($query->result() as $row)
        {
            $option .= "<option value='".$row->KOLOK."'>".$row->NALOKL."</option>";
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
        foreach ($query->result() as $row)
        {
            $option .= "<option value='".$row->KOJAB."'>".$row->NAJABL."</option>";
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
        foreach ($query->result() as $row)
        {
            $option .= "<option value='".$row->KOJAB."'>".$row->NAJABL."</option>";
        }
        $option .= "</select>";
       
        return $option;
    }

    function getOptionJenisKelamin()
    {        

        $option = "<select class='form-control chosen-param' name='jeniskelamin[]' id='jeniskelamin[]' data-placeholder='Pilih Jenis Kelamin...'>";
        $option .= "<option></option>";        
        $option .= "<option value='L'>Laki - laki</option>";
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
        foreach ($query->result() as $row)
        {
            $option .= "<option value='".$row->STAWIN."'>".$row->KETERANGAN."</option>";
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
        foreach ($query->result() as $row)
        {
            $option .= "<option value='".$row->AGAMA."'>".$row->KETERANGAN."</option>";
        }
        $option .= "</select>";
       
        return $option;
    }

    function getOptionStapeg()
    {        

        $option = "<select class='form-control chosen-param' name='stapeg[]' id='stapeg[]' data-placeholder='Pilih Status Pegawai...'>";
        $option .= "<option></option>";        
        $option .= "<option value='1'>CPNS</option>";
        $option .= "<option value='2'>PNS</option>";
        $option .= "</select>";
       
        return $option;
    }

    function getOptionStatusAktif()
    {        

        $option = "<select class='form-control chosen-param' name='statusaktif[]' id='statusaktif[]' data-placeholder='Pilih Status...'>";
        $option .= "<option></option>";        
        $option .= "<option value='1'>Aktif</option>";
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
        foreach ($query->result() as $row)
        {
            $option .= "<option value='".$row->KDUNIVER."'>".$row->NAUNIVER."</option>";
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
        for ($i=1; $i < 101; $i++) { 
            $option .= "<option value='".$i."'>".$i." tahun</option>";
        }
        $option .= "</select>";
       
        return $option;
    }

    function getOptionHukdis(){
        $sql= " SELECT JENHUKDIS, KETERANGAN
                FROM PERS_JENHUKDIS_RPT 
                ORDER BY KETERANGAN ASC";
        $query = $this->db->query($sql);

        $option = "<select class='form-control chosen-param' name='hukdis[]' id='hukdis[]' data-placeholder='Pilih Jenis Hukuman Disiplin...' >";
        $option .= "<option></option>";
        foreach ($query->result() as $row)
        {
            $option .= "<option value='".$row->JENHUKDIS."'>".$row->KETERANGAN."</option>";
        }
        $option .= "</select>";
       
        return $option;
    }

    public function getOptionUsia()
    {
        $option = "<select class='form-control chosen-param' name='usia[]' id='usia[]' data-placeholder='Pilih Jumlah Usia...'>";
        $option .= "<option></option>";        
        for ($i=15; $i < 101; $i++) { 
            $option .= "<option value='".$i."'>".$i." tahun</option>";
        }
        $option .= "</select>";
       
        return $option;
    }

    public function getOptionFasilitas()
    {
        $sql= " SELECT JENFAS, KETERANGAN
                FROM PERS_JENFAS_RPT 
                ORDER BY KETERANGAN ASC";
        $query = $this->db->query($sql);

        $option = "<select class='form-control chosen-param' name='jenfas[]' id='jenfas[]' data-placeholder='Pilih Jenis Jenis Fasilitas...' >";
        $option .= "<option></option>";
        foreach ($query->result() as $row)
        {
            $option .= "<option value='".$row->JENFAS."'>".$row->KETERANGAN."</option>";
        }
        $option .= "</select>";
       
        return $option;
    }

}

?>