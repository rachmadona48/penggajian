<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class Inforeferensi {

    private $ci;
    private $ekin;

    function __construct()
    {
        $this->ci =& get_instance();
        $this->ci->load->database();

        $this->ci->load->library('infopegawai'); 

        // $this->ekin = $this->ci->load->database('ekinerja', TRUE);
    }

    public function getMenuSelectRef(){
        $sql = "SELECT \"id\", \"nama_menu\" FROM \"menu_user_select_ref\" WHERE \"status\" = 'Y' ORDER BY \"nama_menu\" ASC";

        $query = $this->ci->db->query($sql);        

        $option = "";
        
        foreach($query->result() as $row){
            $option .= "<option value='".$row->id."'>".$row->nama_menu."</option>";
        }

        return $option;
    }

    public function getMenuSelectRefNew($user_group){
        $sql = "SELECT \"id_menu\", \"alias\", \"nama_menu\"
                  FROM \"menu_access_user\"
                  INNER JOIN \"menu_master\" ON \"menu_id\"=\"id_menu\"
                  WHERE \"act_view\" = 'Y'
                  AND \"jenis_menu\"='1'
                  AND \"link_menu\"='referensi'
                  AND \"status_aktif\"='Y'
                  AND \"user_group_id\"='$user_group'
                  ORDER BY \"id_menu\" ASC";
       // echo $sql;
        $query = $this->ci->db->query($sql);

        $option = "";

        foreach($query->result() as $row){
            $option .= "<option value='".$row->alias."'>".$row->nama_menu."</option>";
        }

        return $option;
    }
    
    public function getMenuSelectInfoNew($user_group){
        $sql = "SELECT \"id_menu\", \"alias\", \"nama_menu\"
                  FROM \"menu_access_user\"
                  INNER JOIN \"menu_master\" ON \"menu_id\"=\"id_menu\"
                  WHERE \"act_view\" = 'Y'
                  AND \"jenis_menu\"='1'
                  AND \"link_menu\"='informasi'
                  AND \"status_aktif\"='Y'
                  AND \"user_group_id\"='$user_group'
                  ORDER BY \"id_menu\" ASC";
//        echo $sql;
        $query = $this->ci->db->query($sql);

        $option = "";

        foreach($query->result() as $row){
            $option .= "<option value='".$row->alias."'>".$row->nama_menu."</option>";
        }

        return $option;
    }

    public function getReferensiKolok($id=""){
        $hak_akses = $this->ci->infopegawai->hakAksesModul('1455',$this->ci->session->userdata('logged_in')['user_group']);

        $sql = "SELECT KOLOK, NALOKS, NALOKL, KORAS, MAKAN_INS, TAHUN, AKTIF , KODE_UNIT_SIPKD 
                FROM PERS_LOKASI_TBL
                
                ";     
                // WHERE DELETED IS NULL   

        $query = $this->ci->db->query($sql);

        $i = 1;

        $table  = "<div id='_content_riwayat' class='animated fadeInUp'>";
        if ($hak_akses->act_insert == 'Y'){
           $table .= "<div class='pull-right'><button type='button' class='btn btn-primary btn-sm btn-block m-t' onClick='getForm(\"ref_kolok\",\"tambah\");'><i class='fa fa-plus'></i> Tambah Data</button></div>";
        }
        
        $table .= "<table class='table table-striped table-bordered table-hover dataTables-example pull-left' width='99%'>";
        $table .= "<thead>";
        $table .= " <tr>
                        <th>No</th>
                        <th>Kode Lokasi</th>
                        <th>Nama Lokasi Kerja</th>                        
                        <th>Koras</th>
                        <th>Makan Ins</th>
                        <th>Tahun</th>
                        <th>Kode Unit Sipkd</th>
                        <th>Aktif</th>
                        <th>Aksi</th>
                    </tr>";
        $table .= "</thead>";
        $table .= "<tbody>";
        foreach($query->result() as $row){
            $table .= "<tr>";
                $table .= "<td width='5px'>".$i."</td>";                    
                $table .= "<td>".$row->KOLOK."</td>";
                $table .= "<td>".$row->NALOKS." <br>( ".$row->NALOKL." )</td>";
                $table .= "<td>".$row->KORAS."</td>";
                $table .= "<td>".$row->MAKAN_INS."</td>";
                $table .= "<td>".$row->TAHUN."</td>";
                $table .= "<td>".$row->KODE_UNIT_SIPKD."</td>";
                    if($row->AKTIF == 1) {$aktif = 'Aktif';}else{$aktif = 'Tidak Aktif';}
                $table .= "<td>".$aktif."</td>";

                $ubah = "";
            if ($hak_akses->act_update == 'Y'){
                $ubah = "<button type='button' class='btn btn-outline btn-xs btn-success' title='Edit' onClick='getForm(\"ref_kolok\",\"edit\",\"".$row->KOLOK."\");'><i class='fa fa-pencil-square'></i></button> ";
            }

            // $hapus_flag = "";
            // if ($hak_akses->act_delete_flag == 'Y'){
            //     $hapus_flag = "<button type='button' class='btn btn-outline btn-xs btn-danger' title='Hapus' onClick='confirmHapusDataFlag(\"ref_kolok\",\"".$row->KOLOK."\");'><i class='fa fa-trash'></i></button>";
            // }

            $hapus = "";
            if ($hak_akses->act_delete == 'Y'){
                $hapus = "<button type='button' class='btn btn-outline btn-xs btn-danger' title='Hapus ' onClick='confirmHapusData(\"ref_kolok\",\"".$row->KOLOK."\");'><i class='fa fa-trash'></i></button>";
            }

                $table .= "<td >$ubah  $hapus</td>";
            $table .= "</tr>";

            $i++;
        }
        $table .= "</tbody>";
        $table .= "</table>";
        $table .= "</div>";

        return $table;

    }

    public function getReferensiKlogad3($id=""){
        $hak_akses = $this->ci->infopegawai->hakAksesModul('1456',$this->ci->session->userdata('logged_in')['user_group']);

        $sql = "SELECT KOLOK, NALOK, SPMU, TAHUN, AKTIF , KODE_UNIT_SIPKD 
                FROM PERS_KLOGAD3 
                ORDER BY KOLOK ASC";   
                // WHERE DELETED IS NULL     

        $query = $this->ci->db->query($sql);

        $i = 1;

        $table  = "<div id='_content_riwayat' class='animated fadeInUp'>";
        if ($hak_akses->act_insert == 'Y'){
           $table .= "<div class='pull-right'><button type='button' class='btn btn-primary btn-sm btn-block m-t' onClick='getForm(\"ref_klogad3\",\"tambah\");'><i class='fa fa-plus'></i> Tambah Data</button></div>";
        }
        
        $table .= "<table class='table table-striped table-bordered table-hover dataTables-example pull-left' width='99%'>";
        $table .= "<thead>";
        $table .= " <tr>
                        <th>No</th>
                        <th>Kode Lokasi</th>
                        <th>Nama Lokasi Kerja</th>                        
                        <th>SPMU</th>                        
                        <th>Tahun</th>
                        <th>Kode Unit Sipkd</th>
                        <th>Aktif</th>
                        <th>Aksi</th>
                    </tr>";
        $table .= "</thead>";
        $table .= "<tbody>";
        foreach($query->result() as $row){
            $table .= "<tr>";
                $table .= "<td width='5px'>".$i."</td>";                    
                $table .= "<td>".$row->KOLOK."</td>";
                $table .= "<td>".$row->NALOK."</td>";
                $table .= "<td>".$row->SPMU."</td>";                
                $table .= "<td>".$row->TAHUN."</td>";
                $table .= "<td>".$row->KODE_UNIT_SIPKD."</td>";
                    if($row->AKTIF == 1) {$aktif = 'Aktif';}else{$aktif = 'Tidak Aktif';}
                $table .= "<td>".$aktif."</td>";

                $ubah = "";
            if ($hak_akses->act_update == 'Y'){
                $ubah = "<button type='button' class='btn btn-outline btn-xs btn-success' title='Edit' onClick='getForm(\"ref_klogad3\",\"edit\",\"".$row->KOLOK."\");'><i class='fa fa-pencil-square'></i></button> ";
            }

            // $hapus_flag = "";
            // if ($hak_akses->act_delete_flag == 'Y'){
            //     $hapus_flag = "<button type='button' class='btn btn-outline btn-xs btn-danger' title='Hapus' onClick='confirmHapusDataFlag(\"ref_klogad3\",\"".$row->KOLOK."\");'><i class='fa fa-trash'></i></button>";
            // }

            $hapus = "";
            if ($hak_akses->act_delete == 'Y'){
                $hapus = "<button type='button' class='btn btn-outline btn-xs btn-danger' title='Hapus ' onClick='confirmHapusData(\"ref_klogad3\",\"".$row->KOLOK."\");'><i class='fa fa-trash'></i></button>";
            }

                $table .= "<td >$ubah  $hapus</td>";
            $table .= "</tr>";

            $i++;
        }
        $table .= "</tbody>";
        $table .= "</table>";
        $table .= "</div>";

        return $table;

    }

    public function getReferensiLokasiGaji($id=""){
        $hak_akses = $this->ci->infopegawai->hakAksesModul('1454',$this->ci->session->userdata('logged_in')['user_group']);

        $sql = "SELECT KODE_SPM, NAMA, KLOGAD_INDUK, TAHUN, KDSORT 
                FROM PERS_TABEL_SPMU 
                ORDER BY KODE_SPM ASC";
                // WHERE DELETED IS NULL        

        $query = $this->ci->db->query($sql);

        $i = 1;

        $table  = "<div id='_content_riwayat' class='animated fadeInUp'>";
        if ($hak_akses->act_insert == 'Y'){
           $table .= "<div class='pull-right'><button type='button' class='btn btn-primary btn-sm btn-block m-t' onClick='getForm(\"ref_spmu\",\"tambah\");'><i class='fa fa-plus'></i> Tambah Data</button></div>";
        }
        
        $table .= "<table class='table table-striped table-bordered table-hover dataTables-example pull-left' width='99%'>";
        $table .= "<thead>";
        $table .= " <tr>
                        <th>No</th>
                        <th>Kode SPM</th>
                        <th>Nama</th>                        
                        <th>Klogad Induk</th>
                        <th>Tahun</th>
                                 
                        <th>Aksi</th>
                    </tr>";
        $table .= "</thead>";
        $table .= "<tbody>";
        foreach($query->result() as $row){
            $table .= "<tr>";
                $table .= "<td width='5px'>".$i."</td>";
                $table .= "<td>".$row->KODE_SPM."</td>";
                $table .= "<td>".$row->NAMA."</td>";
                $table .= "<td>".$row->KLOGAD_INDUK."</td>";
                $table .= "<td>".$row->TAHUN."</td>";
                
                $ubah = "";
            if ($hak_akses->act_update == 'Y'){
                $ubah = "<button type='button' class='btn btn-outline btn-xs btn-success' title='Edit' onClick='getForm(\"ref_spmu\",\"edit\",\"".$row->KODE_SPM."\");'><i class='fa fa-pencil-square'></i></button> ";
            }

            // $hapus_flag = "";
            // if ($hak_akses->act_delete_flag == 'Y'){
            //     $hapus_flag = "<button type='button' class='btn btn-outline btn-xs btn-danger' title='Hapus' onClick='confirmHapusDataFlag(\"ref_spmu\",\"".$row->KODE_SPM."\");'><i class='fa fa-trash'></i></button>";
            // }

            $hapus = "";
            if ($hak_akses->act_delete == 'Y'){
                $hapus = "<button type='button' class='btn btn-outline btn-xs btn-danger' title='Hapus ' onClick='confirmHapusData(\"ref_spmu\",\"".$row->KODE_SPM."\");'><i class='fa fa-trash'></i></button>";
            }

                $table .= "<td >$ubah $hapus</td>";
            $table .= "</tr>";

            $i++;
        }
        $table .= "</tbody>";
        $table .= "</table>";
        $table .= "</div>";

        return $table;

    }

    public function getOptionJendik(){
        //$hak_akses = $this->ci->infopegawai->hakAksesModul('1462',$this->ci->session->userdata('logged_in')['user_group']);

        $sqlO = "SELECT JENDIK, KETERANGAN 
                FROM PERS_JENDIK_RPT
                ORDER BY JENDIK ASC"; 
                // WHERE DELETED IS NULL

        $queryO = $this->ci->db->query($sqlO);

        $option = "<div class='row' style='border-bottom:1px solid rgba(0,0,0,0.15);border-top:1px solid rgba(0,0,0,0.15);padding:3px;'><div class='form-group'>                        
                        <label class='col-sm-3 control-label'>Jenis Pendidikan</label>
                        <div class='col-sm-9'>
                            <select name='jendikO' id='jendikO' onChange='return jendik(this.value)' class='form-control chosen-option' tabindex='2'>";
        foreach($queryO->result() as $rowO){
            $option .= "<option value='".$rowO->JENDIK."'>".$rowO->KETERANGAN."</option>";
        }
        $option .= "        </select>
                        </div>
                    </div></div>";

        return $option;

    }

    public function getReferensiTingkatPendidikan($jendik='1'){
        $hak_akses = $this->ci->infopegawai->hakAksesModul('1462',$this->ci->session->userdata('logged_in')['user_group']);

        $sql = "SELECT PERS_PDIDIKAN_TBL.JENDIK,PERS_PDIDIKAN_TBL.KODIK, PERS_PDIDIKAN_TBL.NADIK, PERS_PDIDIKAN_TBL.USER_ID, PERS_PDIDIKAN_TBL.TERM, PERS_PDIDIKAN_TBL.TG_UPD, PERS_JENDIK_RPT.KETERANGAN
                FROM PERS_PDIDIKAN_TBL
                LEFT OUTER JOIN PERS_JENDIK_RPT ON PERS_PDIDIKAN_TBL.JENDIK = PERS_JENDIK_RPT.JENDIK
                WHERE PERS_PDIDIKAN_TBL.DELETED IS NULL
                AND PERS_JENDIK_RPT.JENDIK = '".$jendik."'
                ";                

        $query = $this->ci->db->query($sql);

        $i = 1;

        $table  = "<div id='_content_riwayat' class='animated fadeInUp'>";                
        if ($hak_akses->act_insert == 'Y'){
           $table .= "<div class='pull-right'><button type='button' class='btn btn-primary btn-sm btn-block m-t' onClick='getForm(\"ref_pendidikan\",\"tambah\");'><i class='fa fa-plus'></i> Tambah Data</button></div>";
        }
         
        $table .= "<table class='table table-striped table-bordered table-hover dataTables-example pull-left' width='99%'>";
        $table .= "<thead>";
        $table .= " <tr>
                        <th>No</th>
                        <th>Kode Pendidikan</th>
                        <th>Pendidikan</th>                        
                        <th>Aksi</th>
                    </tr>";
        $table .= "</thead>";
        $table .= "<tbody>";
        foreach($query->result() as $row){
            $table .= "<tr>";
                $table .= "<td width='5px'>".$i."</td>";
                $table .= "<td>".$row->KODIK."</td>";
                $table .= "<td>".$row->NADIK."</td>";                

                $ubah = "";
            if ($hak_akses->act_update == 'Y'){
                $ubah = "<button type='button' class='btn btn-outline btn-xs btn-success' title='Edit' onClick='getForm(\"ref_pendidikan\",\"edit\",\"".$row->KODIK."\",\"".$row->JENDIK."\");'><i class='fa fa-pencil-square'></i></button> ";
            }

            // $hapus_flag = "";
            // if ($hak_akses->act_delete_flag == 'Y'){
            //     $hapus_flag = "<button type='button' class='btn btn-outline btn-xs btn-danger' title='Hapus' onClick='confirmHapusDataFlag(\"ref_pendidikan\",\"".$row->KODIK."\",\"".$row->JENDIK."\");' ><i class='fa fa-trash'></i></button>";
            // }

            $hapus = "";
            if ($hak_akses->act_delete == 'Y'){
                $hapus = "<button type='button' class='btn btn-outline btn-xs btn-danger' title='Hapus ' onClick='confirmHapusData(\"ref_pendidikan\",\"".$row->KODIK."\",\"".$row->JENDIK."\");' ><i class='fa fa-trash'></i></button>";
            }

                $table .= "<td >$ubah $hapus</td>";
            $table .= "</tr>";

            $i++;
        }
        $table .= "</tbody>";
        $table .= "</table>";
        $table .= "</div>";


        return $table;

    }

    public function getReferensiHubkel(){
        $hak_akses = $this->ci->infopegawai->hakAksesModul('1430',$this->ci->session->userdata('logged_in')['user_group']);

        $sql = "SELECT HUBKEL, NAHUBKEL 
                FROM PERS_HUBKEL_TBL 
                ORDER BY HUBKEL ASC
                ";                
                // WHERE DELETED IS NULL

        $query = $this->ci->db->query($sql);

        $i = 1;

        $table  = "<div id='_content_riwayat' data-backdrop='static' class='animated fadeInUp'>";                
        if ($hak_akses->act_insert == 'Y'){
           $table .= "<div class='pull-right'><button type='button'  class='btn btn-primary btn-sm btn-block m-t' onClick='getForm(\"ref_hubkel\",\"tambah\");'><i class='fa fa-plus'></i> Tambah Data</button></div>";
        }
        
        $table .= "<table class='table table-striped table-bordered table-hover dataTables-example pull-left' width='99%'>";
        $table .= "<thead>";
        $table .= " <tr>
                        <th>No</th>
                        <th>Kode</th>
                        <th>Hubungan Keluarga</th>                        
                        <th>Aksi</th>
                    </tr>";
        $table .= "</thead>";
        $table .= "<tbody>";
        foreach($query->result() as $row){
            $table .= "<tr>";
                $table .= "<td width='5px'>".$i."</td>";
                $table .= "<td>".$row->HUBKEL."</td>";
                $table .= "<td>".$row->NAHUBKEL."</td>";                

                $ubah = "";
            if ($hak_akses->act_update == 'Y'){
                $ubah = "<button type='button' class='btn btn-outline btn-xs btn-success' title='Edit' onClick='getForm(\"ref_hubkel\",\"edit\",\"".$row->HUBKEL."\");'><i class='fa fa-pencil-square'></i></button> ";
            }

            // $hapus_flag = "";
            // if ($hak_akses->act_delete_flag == 'Y'){
            //     $hapus_flag = "<button type='button' class='btn btn-outline btn-xs btn-danger' title='Hapus' onClick='confirmHapusDataFlag(\"ref_hubkel\",\"".$row->HUBKEL."\");'><i class='fa fa-trash'></i></button>";
            // }

            $hapus = "";
            if ($hak_akses->act_delete == 'Y'){
                $hapus = "<button type='button' class='btn btn-outline btn-xs btn-danger' title='Hapus ' onClick='confirmHapusData(\"ref_hubkel\",\"".$row->HUBKEL."\");'><i class='fa fa-trash'></i></button>";
            }

                $table .= "<td >$ubah  $hapus</td>";
            $table .= "</tr>";

            $i++;
        }
        $table .= "</tbody>";
        $table .= "</table>";
        $table .= "</div>";

        return $table;

    }

    public function getOptionKolok(){
       // $hak_akses = $this->ci->infopegawai->hakAksesModul('1428',$this->ci->session->userdata('logged_in')['user_group']);

        $sqlO = "SELECT KOLOK, NALOK 
                FROM PERS_KLOGAD3    
                ORDER BY NALOK ASC";
                // WHERE DELETED IS NULL

        $queryO = $this->ci->db->query($sqlO);

         
        $option = "<div class='row' style='border-bottom:1px solid rgba(0,0,0,0.15); border-top:1px solid rgba(0,0,0,0.15);padding:3px;'><div class='form-group'>                        
                        <label class='col-sm-3 control-label'>Kode Lokasi </label>
                        <div class='col-sm-9'>
                            <select name='kolokO' id='kolokO' onChange='return kolok(this.value)' data-placeholder='Pilih Lokasi Kerja...' class='form-control chosen-klk' tabindex='2'>";
            $option .= "<option value=''></option>";
        foreach($queryO->result() as $rowO){
            $option .= "<option value='".$rowO->KOLOK."'>".$rowO->KOLOK." - ".$rowO->NALOK."</option>";
        }
        $option .= "        </select>
                        </div>
                    </div></div>

                    <script>var config = {
                  '.chosen-klk'           : {search_contains:true,no_results_text:'Oops, Data Tidak Ditemukan',width: '300px'},
                 
                }
                for (var selector in config) {
                  $(selector).chosen(config[selector]);
                }</script>
                    ";

        return $option;

    }


    public function getReferensiJabatan($kolok=""){
        $hak_akses = $this->ci->infopegawai->hakAksesModul('1433',$this->ci->session->userdata('logged_in')['user_group']);

        if($kolok != ""){
            $where = " AND lower(PERS_KOJAB_TBL.KOLOK) LIKE lower('%".$kolok."%') ";
        }else{
            $where = " AND PERS_KOJAB_TBL.KOLOK = '".$kolok."' ";
        }

        $sql = "SELECT PERS_KOJAB_TBL.KOLOK, PERS_KOJAB_TBL.KOJAB, PERS_KOJAB_TBL.NAJABS, PERS_KOJAB_TBL.NAJABL, PERS_KOJAB_TBL.ESELON,PERS_ESELON_TBL.NESELON AS NAMA_ESELON, PERS_KOJAB_TBL.PERINGKAT,
                PERS_KOJAB_TBL.KOLOK_SEKTORAL, PERS_KOJAB_TBL.TUNJAB,  PERS_KOJAB_TBL.TRANSPORT, PERS_KOJAB_TBL.JOB_CLASS1, PERS_KOJAB_TBL.JOB_CLASS2, 
                PERS_KOJAB_TBL.POINT, PERS_KOJAB_TBL.POINT_207,PERS_KOJAB_TBL.TAHAP1, PERS_KOJAB_TBL.TAHAP2, PERS_KOJAB_TBL.TAHUN, PERS_KOJAB_TBL.AKTIF,
                PERS_KOJAB_TBL.USER_ID, PERS_KOJAB_TBL.TERM,PERS_KOJAB_TBL.TG_UPD,PERS_KOJAB_TBL.PERINGKAT_409, PERS_KOJAB_TBL.POINT_409,PERS_KOJAB_TBL.TKD_409
                FROM PERS_KOJAB_TBL 
                LEFT JOIN PERS_LOKASI_TBL ON PERS_KOJAB_TBL.KOLOK = PERS_LOKASI_TBL.KOLOK
                LEFT JOIN PERS_ESELON_TBL ON PERS_KOJAB_TBL.ESELON = PERS_ESELON_TBL.ESELON
                WHERE 2= 2
                ".$where."
                ORDER BY PERS_KOJAB_TBL.KOLOK, PERS_KOJAB_TBL.KOJAB, PERS_KOJAB_TBL.ESELON
                ";                

        $query = $this->ci->db->query($sql);

        $i = 1;

        $table  = "<div id='_content_riwayat' class='animated fadeInUp'>";                
        if ($hak_akses->act_insert == 'Y'){
           $table .= "<div class='pull-right'><button type='button' class='btn btn-primary btn-sm btn-block m-t' onClick='getForm(\"ref_jabatan\",\"tambah\");'><i class='fa fa-plus'></i> Tambah Data</button></div>";
        }
        
        $table .= "<table class='table table-striped table-bordered table-hover dataTables-example pull-left' width='99%'>";
        $table .= "<thead>";
        $table .= " <tr>
                        <th>No</th>
                        <th>Nama Jabatan</th>                        
                        <th>Eselon</th>
                        <th>Peringkat(409)</th>
                        <th>Kolok Sektoral</th>                                 
                        <th>Tunjangan Jabatan</th>
                        <th>Tunjangan Transport</th>
                        <th>Job Class 1</th>                                    
                        <th>Job Class 2</th>
                        <th>Point(409)</th>
                        <th>TKD(409)</th>                                    
                        <th>Tahun</th>
                         <th>Aksi</th>
                    </tr>";
        $table .= "</thead>";
        $table .= "<tbody>";
        foreach($query->result() as $row){
            $table .= "<tr>";
                $table .= "<td width='5px'>".$i."</td>";
                $table .= "<td>".$row->NAJABS." <br>( ".$row->NAJABL." ) <br> <span class='text-success'><b>".$row->KOJAB."</b></span></td>";
                $table .= "<td>".$row->NAMA_ESELON."</td>";
                $table .= "<td>".$row->PERINGKAT_409."</td>";
                $table .= "<td>".$row->KOLOK_SEKTORAL."</td>";
                $table .= "<td>".$row->TUNJAB."</td>";
                $table .= "<td>".$row->TRANSPORT."</td>";
                $table .= "<td>".$row->JOB_CLASS1."</td>";
                $table .= "<td>".$row->JOB_CLASS2."</td>";
                $table .= "<td>".$row->POINT_409."</td>";
                $table .= "<td>".$row->TKD_409."</td>";
                $table .= "<td>".$row->TAHUN."</td>";

                $ubah = "";
            if ($hak_akses->act_update == 'Y'){
                $ubah = "<button type='button' class='btn btn-outline btn-xs btn-success' title='Edit' onClick='getForm(\"ref_jabatan\",\"edit\",\"".$row->KOLOK."\",\"".$row->KOJAB."\",\"".$row->ESELON."\");'><i class='fa fa-pencil-square'></i></button>";
            }

            // $hapus_flag = "";
            // if ($hak_akses->act_delete_flag == 'Y'){
            //     $hapus_flag = "<button type='button' class='btn btn-outline btn-xs btn-danger' title='Hapus' onClick='confirmHapusDataFlag(\"ref_jabatan\",\"".$row->KOLOK."\",\"".$row->KOJAB."\");'><i class='fa fa-trash'></i></button>";
            // }

            $hapus = "";
            if ($hak_akses->act_delete == 'Y'){
                $hapus = "<button type='button' class='btn btn-outline btn-xs btn-danger' title='Hapus ' onClick='confirmHapusData(\"ref_jabatan\",\"".$row->KOLOK."\",\"".$row->KOJAB."\");'><i class='fa fa-trash'></i></button>";
            }

                $table .= "<td >$ubah  $hapus</td>";
            $table .= "</tr>";

            $i++;
        }
        $table .= "</tbody>";
        $table .= "</table>";
        $table .= "</div>";

        return $table;

    }

    public function getReferensiJabatanf(){
        $hak_akses = $this->ci->infopegawai->hakAksesModul('1432',$this->ci->session->userdata('logged_in')['user_group']);

        $sql = "SELECT KOJAB, NAJABS, NAJABL, TUNFUNG, JOB_CLASS1, JOB_CLASS2, POINT, TUNJAB, POINT_207, PERINGKAT, TAHAP1, TAHAP2 
                FROM PERS_KOJABF_TBL
                ";                
                // WHERE DELETED IS NULL

        $query = $this->ci->db->query($sql);

        $i = 1;

        $table  = "<div id='_content_riwayat' class='animated fadeInUp'>";                
        if ($hak_akses->act_insert == 'Y'){
           $table .= "<div class='pull-right'><button type='button' class='btn btn-primary btn-sm btn-block m-t' onClick='getForm(\"ref_jabatanf\",\"tambah\");'><i class='fa fa-plus'></i> Tambah Data</button></div>";
        }
         
        $table .= "<table class='table table-striped table-bordered table-hover dataTables-example pull-left' width='99%'>";
        $table .= "<thead>";
        $table .= " <tr>
                        <th>No</th>                        
                        <th>Nama Jabatan</th>                        
                        <th>Tunjangan Fungsional</th>
                        <th>Job Class 1</th>
                        <th>Job Class 2</th>
                        <th>Point</th>
                        <th>Tunjangan Jabatan</th>
                        <th>Point(207)</th>
                        <th>Peringkat</th>
                        <th>Tahap 1</th>
                        <th>Tahap 2</th>                      
                        <th>Aksi</th>
                    </tr>";
        $table .= "</thead>";
        $table .= "<tbody>";
        foreach($query->result() as $row){
            $table .= "<tr>";
                $table .= "<td width='5px'>".$i."</td>";
                $table .= "<td>".$row->NAJABS." <br>( ".$row->NAJABL." ) <br> <span class='text-success'><b>".$row->KOJAB."</b></span></td>";
                $table .= "<td>".$row->TUNFUNG."</td>";
                $table .= "<td>".$row->JOB_CLASS1."</td>";
                $table .= "<td>".$row->JOB_CLASS2."</td>";
                $table .= "<td>".$row->POINT."</td>";
                $table .= "<td>".$row->TUNJAB."</td>";
                $table .= "<td>".$row->POINT_207."</td>";
                $table .= "<td>".$row->PERINGKAT."</td>";
                $table .= "<td>".$row->TAHAP1."</td>";
                $table .= "<td>".$row->TAHAP2."</td>";                

                $ubah = "";
            if ($hak_akses->act_update == 'Y'){
                $ubah = "<button type='button' class='btn btn-outline btn-xs btn-success' title='Edit' onClick='getForm(\"ref_jabatanf\",\"edit\",\"".$row->KOJAB."\");'><i class='fa fa-pencil-square'></i></button> ";
            }

            // $hapus_flag = "";
            // if ($hak_akses->act_delete_flag == 'Y'){
            //     $hapus_flag = "<button type='button' class='btn btn-outline btn-xs btn-danger' title='Hapus' onClick='confirmHapusDataFlag(\"ref_jabatanf\",\"".$row->KOJAB."\");'><i class='fa fa-trash'></i></button>";
            // }

            $hapus = "";
            if ($hak_akses->act_delete == 'Y'){
                $hapus = "<button type='button' class='btn btn-outline btn-xs btn-danger' title='Hapus ' onClick='confirmHapusData(\"ref_jabatanf\",\"".$row->KOJAB."\");'><i class='fa fa-trash'></i></button>";
            }

                $table .= "<td >$ubah  $hapus</td>";
            $table .= "</tr>";

            $i++;
        }
        $table .= "</tbody>";
        $table .= "</table>";
        $table .= "</div>";

        return $table;

    }

    public function getReferensiPangkat(){
        $hak_akses = $this->ci->infopegawai->hakAksesModul('1458',$this->ci->session->userdata('logged_in')['user_group']);

        $sql = "SELECT KOPANG, GOL, NAPANG, KOPANG_PNS 
                FROM PERS_PANGKAT_TBL
                ";                
                // WHERE DELETED IS NULL

        $query = $this->ci->db->query($sql);

        $i = 1;

        $table  = "<div id='_content_riwayat' class='animated fadeInUp'>";                
        if ($hak_akses->act_insert == 'Y'){
           $table .= "<div class='pull-right'><button type='button' class='btn btn-primary btn-sm btn-block m-t' onClick='getForm(\"ref_pangkat\",\"tambah\");'><i class='fa fa-plus'></i> Tambah Data</button></div>";
        }
         
        $table .= "<table class='table table-striped table-bordered table-hover dataTables-example pull-left' width='99%'>";
        $table .= "<thead>";
        $table .= " <tr>
                        <th>No</th>
                        <th>Kode Pangkat</th>
                        <th>Golongan</th>
                        <th>Pangkat</th>   
                        <th>Kopang PNS</th>                    
                        <th>Aksi</th>
                    </tr>";
        $table .= "</thead>";
        $table .= "<tbody>";
        foreach($query->result() as $row){
            $table .= "<tr>";
                $table .= "<td width='5px'>".$i."</td>";
                $table .= "<td>".$row->KOPANG."</td>";
                $table .= "<td>".$row->GOL."</td>";
                $table .= "<td>".$row->NAPANG."</td>";
                $table .= "<td>".$row->KOPANG_PNS."</td>";

                $ubah = "";
            if ($hak_akses->act_update == 'Y'){
                $ubah = "<button type='button' class='btn btn-outline btn-xs btn-success' title='Edit' onClick='getForm(\"ref_pangkat\",\"edit\",\"".$row->KOPANG."\");'><i class='fa fa-pencil-square'></i></button> ";
            }

            // $hapus_flag = "";
            // if ($hak_akses->act_delete_flag == 'Y'){
            //     $hapus_flag = "<button type='button' class='btn btn-outline btn-xs btn-danger' title='Hapus' onClick='confirmHapusDataFlag(\"ref_pangkat\",\"".$row->KOPANG."\");'><i class='fa fa-trash'></i></button>";
            // }

            $hapus = "";
            if ($hak_akses->act_delete == 'Y'){
                $hapus = "<button type='button' class='btn btn-outline btn-xs btn-danger' title='Hapus ' onClick='confirmHapusData(\"ref_pangkat\",\"".$row->KOPANG."\");'><i class='fa fa-trash'></i></button>";
            }

                $table .= "<td >$ubah  $hapus</td>";
            $table .= "</tr>";

            $i++;
        }
        $table .= "</tbody>";
        $table .= "</table>";
        $table .= "</div>";

        return $table;

    }

    public function getReferensiGajiPokok(){
        $hak_akses = $this->ci->infopegawai->hakAksesModul('1429',$this->ci->session->userdata('logged_in')['user_group']);

        $sql = "SELECT PERS_GAPOK_TBL.KOPANG, PERS_PANGKAT_TBL.GOL, PERS_PANGKAT_TBL.NAPANG, PERS_GAPOK_TBL.TTMASKER, PERS_GAPOK_TBL.BBMASKER, PERS_GAPOK_TBL.GAPOK, 
                PERS_GAPOK_TBL.USER_ID, PERS_GAPOK_TBL.TERM, PERS_GAPOK_TBL.TG_UPD 
                FROM PERS_GAPOK_TBL 
                INNER JOIN PERS_PANGKAT_TBL ON PERS_GAPOK_TBL.KOPANG = PERS_PANGKAT_TBL.KOPANG                   
                WHERE PERS_GAPOK_TBL.DELETED IS NULL
                ORDER BY PERS_GAPOK_TBL.GAPOK, PERS_GAPOK_TBL.TTMASKER
                ";                

        $query = $this->ci->db->query($sql);

        $i = 1;

        $table  = "<div id='_content_riwayat' class='animated fadeInUp'>";                
        if ($hak_akses->act_insert == 'Y'){
           $table .= "<div class='pull-right'><button type='button' class='btn btn-primary btn-sm btn-block m-t' onClick='getForm(\"ref_gapok\",\"tambah\");'><i class='fa fa-plus'></i> Tambah Data</button></div>";
        }
        
        $table .= "<table class='table table-striped table-bordered table-hover dataTables-example pull-left' width='99%'>";
        $table .= "<thead>";
        $table .= " <tr>
                        <th>No</th>
                        <th>Kode</th>
                        <th>Golongan</th>
                        <th>Pangkat</th>
                        <th>Masa Kerja</th>
                        <th>s/d Masa Kerja</th>
                        <th>Gaji Pokok (Rp)</th>                    
                        <th>Aksi</th>
                    </tr>";
        $table .= "</thead>";
        $table .= "<tbody>";
        foreach($query->result() as $row){
            $table .= "<tr>";
                $table .= "<td width='5px'>".$i."</td>";
                $table .= "<td>".$row->KOPANG."</td>";
                $table .= "<td>".$row->GOL."</td>";
                $table .= "<td>".$row->NAPANG."</td>";
                $table .= "<td align='right'>".$row->TTMASKER."</td>";
                $table .= "<td align='right'>".$row->BBMASKER."</td>";
                $table .= "<td align='right'>".number_format($row->GAPOK)."</td>";

                $ubah = "";
            if ($hak_akses->act_update == 'Y'){
                $ubah = "<button type='button' class='btn btn-outline btn-xs btn-success' title='Edit' onClick='getForm(\"ref_gapok\",\"edit\",\"".$row->KOPANG."\",\"".$row->TTMASKER."\",\"".$row->BBMASKER."\");'><i class='fa fa-pencil-square'></i></button>";
            }

            // $hapus_flag = "";
            // if ($hak_akses->act_delete_flag == 'Y'){
            //     $hapus_flag = "<button type='button' class='btn btn-outline btn-xs btn-danger' title='Hapus' onClick='confirmHapusDataFlag(\"ref_gapok\",\"".$row->KOPANG."\",\"".$row->TTMASKER."\",\"".$row->BBMASKER."\");'><i class='fa fa-trash'></i></button>";
            // }

            $hapus = "";
            if ($hak_akses->act_delete == 'Y'){
                $hapus = "<button type='button' class='btn btn-outline btn-xs btn-danger' title='Hapus ' onClick='confirmHapusData(\"ref_gapok\",\"".$row->KOPANG."\",\"".$row->TTMASKER."\",\"".$row->BBMASKER."\");'><i class='fa fa-trash'></i></button>";
            }

                $table .= "<td >$ubah  $hapus</td>";
            $table .= "</tr>";

            $i++;
        }
        $table .= "</tbody>";
        $table .= "</table>";
        $table .= "</div>";

        return $table;

    }

    public function getReferensiGajiPokokTabel(){
        $hak_akses = $this->ci->infopegawai->hakAksesModul('10510',$this->ci->session->userdata('logged_in')['user_group']);

        $sql = "SELECT
                    PERS_GAPOK_TBL_HIST.TAHUN,
                    PERS_GAPOK_TBL_HIST.KOPANG,
                    PERS_PANGKAT_TBL.GOL,
                    PERS_PANGKAT_TBL.NAPANG,
                    PERS_GAPOK_TBL_HIST.TTMASKER,
                    PERS_GAPOK_TBL_HIST.BBMASKER,
                    PERS_GAPOK_TBL_HIST.GAPOK,
                    PERS_GAPOK_TBL_HIST.USER_ID,
                    PERS_GAPOK_TBL_HIST.TERM,
                    PERS_GAPOK_TBL_HIST.TG_UPD
                FROM
                    PERS_GAPOK_TBL_HIST
                INNER JOIN PERS_PANGKAT_TBL ON PERS_GAPOK_TBL_HIST.KOPANG = PERS_PANGKAT_TBL.KOPANG
                --WHERE
                  --  PERS_GAPOK_TBL_HIST.DELETED IS NULL
                ORDER BY
                    PERS_GAPOK_TBL_HIST.TAHUN DESC,
                    PERS_GAPOK_TBL_HIST.KOPANG ASC,
                    PERS_GAPOK_TBL_HIST.TTMASKER ASC
                ";                

        $query = $this->ci->db->query($sql);

        $i = 1;

        $table  = "<div id='_content_riwayat' class='animated fadeInUp'>";                
        if ($hak_akses->act_insert == 'Y'){
           $table .= "<div class='pull-right'><button type='button' class='btn btn-primary btn-sm btn-block m-t' onClick='getForm(\"ref_gapok_tbl\",\"tambah\");'><i class='fa fa-plus'></i> Tambah Data</button></div>";
        }
        
        $table .= "<table class='table table-striped table-bordered table-hover dataTables-example pull-left' width='99%'>";
        $table .= "<thead>";
        $table .= " <tr>
                        <th>No</th>
                        <th>Tahun</th>
                        <th>Kode Pangkat</th>
                        <th>Golongan</th>
                        <th>Pangkat</th>
                        <th>Masa Kerja</th>
                        <th>s/d Masa Kerja</th>
                        <th>Gaji Pokok (Rp)</th>                    
                        <th>Aksi</th>
                    </tr>";
        $table .= "</thead>";
        $table .= "<tbody>";
        foreach($query->result() as $row){
            $table .= "<tr>";
                $table .= "<td width='5px'>".$i."</td>";
                $table .= "<td>".$row->TAHUN."</td>";
                $table .= "<td>".$row->KOPANG."</td>";
                $table .= "<td>".$row->GOL."</td>";
                $table .= "<td>".$row->NAPANG."</td>";
                $table .= "<td align='right'>".$row->TTMASKER."</td>";
                $table .= "<td align='right'>".$row->BBMASKER."</td>";
                $table .= "<td align='right'>".number_format($row->GAPOK)."</td>";

                $ubah = "";
            if ($hak_akses->act_update == 'Y'){
                $ubah = "<button type='button' class='btn btn-outline btn-xs btn-success' title='Edit' onClick='getForm(\"ref_gapok_tbl\",\"edit\",\"".$row->TAHUN."\",\"".$row->KOPANG."\",\"".$row->TTMASKER."\",\"".$row->BBMASKER."\");'><i class='fa fa-pencil-square'></i></button>";
            }

            // $hapus_flag = "";
            // if ($hak_akses->act_delete_flag == 'Y'){
            //     $hapus_flag = "<button type='button' class='btn btn-outline btn-xs btn-danger' title='Hapus' onClick='confirmHapusDataFlag(\"ref_gapok_tbl\",\"".$row->TAHUN."\",\"".$row->KOPANG."\",\"".$row->TTMASKER."\",\"".$row->BBMASKER."\");'><i class='fa fa-trash'></i></button>";
            // }

            $hapus = "";
            if ($hak_akses->act_delete == 'Y'){
                $hapus = "<button type='button' class='btn btn-outline btn-xs btn-danger' title='Hapus ' onClick='confirmHapusData(\"ref_gapok_tbl\",\"".$row->TAHUN."\",\"".$row->KOPANG."\",\"".$row->TTMASKER."\",\"".$row->BBMASKER."\");'><i class='fa fa-trash'></i></button>";
            }

                $table .= "<td >$ubah  $hapus</td>";
            $table .= "</tr>";

            $i++;
        }
        $table .= "</tbody>";
        $table .= "</table>";
        $table .= "</div>";

        return $table;

    }

    public function getReferensiJendik(){
        $hak_akses = $this->ci->infopegawai->hakAksesModul('1442',$this->ci->session->userdata('logged_in')['user_group']);

        $sql = "SELECT JENDIK, KETERANGAN 
                FROM PERS_JENDIK_RPT 
                ORDER BY JENDIK ASC                
                ";                
                // WHERE DELETED IS NULL

        $query = $this->ci->db->query($sql);

        $i = 1;

        $table  = "<div id='_content_riwayat' class='animated fadeInUp'>";                
        if ($hak_akses->act_insert == 'Y'){
           $table .= "<div class='pull-right'><button type='button' class='btn btn-primary btn-sm btn-block m-t' onClick='getForm(\"ref_jendik\",\"tambah\");'><i class='fa fa-plus'></i> Tambah Data</button></div>";
        }
        
        $table .= "<table class='table table-striped table-bordered table-hover dataTables-example pull-left' width='99%'>";
        $table .= "<thead>";
        $table .= " <tr>
                        <th>No</th>
                        <th>Kode Jenis</th>
                        <th>Keterangan</th>         
                        <th>Aksi</th>
                    </tr>";
        $table .= "</thead>";
        $table .= "<tbody>";
        foreach($query->result() as $row){
            $table .= "<tr>";
                $table .= "<td width='5px'>".$i."</td>";
                $table .= "<td>".$row->JENDIK."</td>";
                $table .= "<td>".$row->KETERANGAN."</td>";                

                $ubah = "";
            if ($hak_akses->act_update == 'Y'){
                $ubah = "<button type='button' class='btn btn-outline btn-xs btn-success' title='Edit' onClick='getForm(\"ref_jendik\",\"edit\",\"".$row->JENDIK."\");'><i class='fa fa-pencil-square'></i></button> ";
            }

            // $hapus_flag = "";
            // if ($hak_akses->act_delete_flag == 'Y'){
            //     $hapus_flag = "<button type='button' class='btn btn-outline btn-xs btn-danger' title='Hapus' onClick='confirmHapusDataFlag(\"ref_jendik\",\"".$row->JENDIK."\");'><i class='fa fa-trash'></i></button>";
            // }

            $hapus = "";
            if ($hak_akses->act_delete == 'Y'){
                $hapus = "<button type='button' class='btn btn-outline btn-xs btn-danger' title='Hapus ' onClick='confirmHapusData(\"ref_jendik\",\"".$row->JENDIK."\");'><i class='fa fa-trash'></i></button>";
            }

                $table .= "<td >$ubah  $hapus</td>";
            $table .= "</tr>";

            $i++;
        }
        $table .= "</tbody>";
        $table .= "</table>";
        $table .= "</div>";

        return $table;

    }

    public function getReferensiJenisCuti(){
        $hak_akses = $this->ci->infopegawai->hakAksesModul('1434',$this->ci->session->userdata('logged_in')['user_group']);

        $sql = "SELECT JENCUTI, KETERANGAN 
                FROM PERS_JENCUTI_RPT    
                ORDER BY JENCUTI ASC
                ";         
                // WHERE DELETED IS NULL       

        $query = $this->ci->db->query($sql);

        $i = 1;

        $table  = "<div id='_content_riwayat' class='animated fadeInUp'>";                
        if ($hak_akses->act_insert == 'Y'){
           $table .= "<div class='pull-right'><button type='button' class='btn btn-primary btn-sm btn-block m-t' onClick='getForm(\"ref_jencuti\",\"tambah\");'><i class='fa fa-plus'></i> Tambah Data</button></div>";
        }
        
        $table .= "<table class='table table-striped table-bordered table-hover dataTables-example pull-left' width='99%'>";
        $table .= "<thead>";
        $table .= " <tr>
                        <th>No</th>
                        <th>Kode Jenis</th>
                        <th>Keterangan</th>         
                        <th>Aksi</th>
                    </tr>";
        $table .= "</thead>";
        $table .= "<tbody>";
        foreach($query->result() as $row){
            $table .= "<tr>";
                $table .= "<td width='5px'>".$i."</td>";
                $table .= "<td>".$row->JENCUTI."</td>";
                $table .= "<td>".$row->KETERANGAN."</td>";    

                $ubah = "";
            if ($hak_akses->act_update == 'Y'){
                $ubah = "<button type='button' class='btn btn-outline btn-xs btn-success' title='Edit' onClick='getForm(\"ref_jencuti\",\"edit\",\"".$row->JENCUTI."\");'><i class='fa fa-pencil-square'></i></button>";
            }

            // $hapus_flag = "";
            // if ($hak_akses->act_delete_flag == 'Y'){
            //     $hapus_flag = "<button type='button' class='btn btn-outline btn-xs btn-danger' title='Hapus' onClick='confirmHapusDataFlag(\"ref_jencuti\",\"".$row->JENCUTI."\");'><i class='fa fa-trash'></i></button>";
            // }

            $hapus = "";
            if ($hak_akses->act_delete == 'Y'){
                $hapus = "<button type='button' class='btn btn-outline btn-xs btn-danger' title='Hapus ' onClick='confirmHapusData(\"ref_jencuti\",\"".$row->JENCUTI."\");'><i class='fa fa-trash'></i></button>";
            }

                $table .= "<td >$ubah  $hapus</td>";
            $table .= "</tr>";

            $i++;
        }
        $table .= "</tbody>";
        $table .= "</table>";
        $table .= "</div>";

        return $table;

    }

    public function getReferensiJenisFasilitas(){
        $hak_akses = $this->ci->infopegawai->hakAksesModul('1435',$this->ci->session->userdata('logged_in')['user_group']);

        $sql = "SELECT JENFAS, KETERANGAN 
                FROM PERS_JENFAS_RPT 
                ORDER BY JENFAS ASC
                ";               
                // WHERE DELETED IS NULL 

        $query = $this->ci->db->query($sql);

        $i = 1;

        $table  = "<div id='_content_riwayat' class='animated fadeInUp'>";   
        if ($hak_akses->act_insert == 'Y'){
           $table .= "<div class='pull-right'><button type='button' class='btn btn-primary btn-sm btn-block m-t' onClick='getForm(\"ref_jenfas\",\"tambah\");'><i class='fa fa-plus'></i> Tambah Data</button></div>";
        }             
        
        $table .= "<table class='table table-striped table-bordered table-hover dataTables-example pull-left' width='99%'>";
        $table .= "<thead>";
        $table .= " <tr>
                        <th>No</th>
                        <th>Kode Jenis</th>
                        <th>Keterangan</th>         
                        <th>Aksi</th>
                    </tr>";
        $table .= "</thead>";
        $table .= "<tbody>";
        foreach($query->result() as $row){
            $table .= "<tr>";
                $table .= "<td width='5px'>".$i."</td>";
                $table .= "<td>".$row->JENFAS."</td>";
                $table .= "<td>".$row->KETERANGAN."</td>";                

                $ubah = "";
            if ($hak_akses->act_update == 'Y'){
                $ubah = "<button type='button' class='btn btn-outline btn-xs btn-success' title='Edit' onClick='getForm(\"ref_jenfas\",\"edit\",\"".$row->JENFAS."\");'><i class='fa fa-pencil-square'></i></button> ";
            }

            // $hapus_flag = "";
            // if ($hak_akses->act_delete_flag == 'Y'){
            //     $hapus_flag = "<button type='button' class='btn btn-outline btn-xs btn-danger' title='Hapus' onClick='confirmHapusDataFlag(\"ref_jenfas\",\"".$row->JENFAS."\");'><i class='fa fa-trash'></i></button>";
            // }

            $hapus = "";
            if ($hak_akses->act_delete == 'Y'){
                $hapus = "<button type='button' class='btn btn-outline btn-xs btn-danger' title='Hapus ' onClick='confirmHapusData(\"ref_jenfas\",\"".$row->JENFAS."\");'><i class='fa fa-trash'></i></button>";
            }

                $table .= "<td >$ubah  $hapus</td>";
            $table .= "</tr>";

            $i++;
        }
        $table .= "</tbody>";
        $table .= "</table>";
        $table .= "</div>";

        return $table;

    }

    public function getReferensiHukAdmin(){
        $hak_akses = $this->ci->infopegawai->hakAksesModul('1436',$this->ci->session->userdata('logged_in')['user_group']);

        $sql = "SELECT JENHUKADM, KETERANGAN 
                FROM PERS_JENHUKADM_RPT 
                ORDER BY JENHUKADM ASC
                ";            
                // WHERE DELETED IS NULL    

        $query = $this->ci->db->query($sql);

        $i = 1;

        $table  = "<div id='_content_riwayat' class='animated fadeInUp'>";                
        if ($hak_akses->act_insert == 'Y'){
           $table .= "<div class='pull-right'><button type='button' class='btn btn-primary btn-sm btn-block m-t' onClick='getForm(\"ref_hukadm\",\"tambah\");'><i class='fa fa-plus'></i> Tambah Data</button></div>";
        }
        
        $table .= "<table class='table table-striped table-bordered table-hover dataTables-example pull-left' width='99%'>";
        $table .= "<thead>";
        $table .= " <tr>
                        <th>No</th>
                        <th>Kode Jenis</th>
                        <th>Keterangan</th>         
                        <th>Aksi</th>
                    </tr>";
        $table .= "</thead>";
        $table .= "<tbody>";
        foreach($query->result() as $row){
            $table .= "<tr>";
                $table .= "<td width='5px'>".$i."</td>";
                $table .= "<td>".$row->JENHUKADM."</td>";
                $table .= "<td>".$row->KETERANGAN."</td>";                

                $ubah = "";
            if ($hak_akses->act_update == 'Y'){
                $ubah = "<button type='button' class='btn btn-outline btn-xs btn-success' title='Edit' onClick='getForm(\"ref_hukadm\",\"edit\",\"".$row->JENHUKADM."\");'><i class='fa fa-pencil-square'></i></button> ";
            }

            // $hapus_flag = "";
            // if ($hak_akses->act_delete_flag == 'Y'){
            //     $hapus_flag = "<button type='button' class='btn btn-outline btn-xs btn-danger' title='Hapus' onClick='confirmHapusDataFlag(\"ref_hukadm\",\"".$row->JENHUKADM."\");'><i class='fa fa-trash'></i></button>";
            // }

            $hapus = "";
            if ($hak_akses->act_delete == 'Y'){
                $hapus = "<button type='button' class='btn btn-outline btn-xs btn-danger' title='Hapus ' onClick='confirmHapusData(\"ref_hukadm\",\"".$row->JENHUKADM."\");'><i class='fa fa-trash'></i></button>";
            }

                $table .= "<td >$ubah  $hapus</td>";
            $table .= "</tr>";

            $i++;
        }
        $table .= "</tbody>";
        $table .= "</table>";
        $table .= "</div>";

        return $table;

    }

    public function getReferensiHukDis(){
        $hak_akses = $this->ci->infopegawai->hakAksesModul('1437',$this->ci->session->userdata('logged_in')['user_group']);

        $sql = "SELECT JENHUKDIS, KETERANGAN,KET_LENGKAP,JENIS_HUKUMAN
                FROM PERS_JENHUKDIS_RPT
                ORDER BY JENHUKDIS ASC
                ";  
                // WHERE DELETED IS NULL


        $query = $this->ci->db->query($sql);

        $i = 1;

        $table  = "<div id='_content_riwayat' class='animated fadeInUp'>";                
        if ($hak_akses->act_insert == 'Y'){
           $table .= "<div class='pull-right'><button type='button' class='btn btn-primary btn-sm btn-block m-t' onClick='getForm(\"ref_hukdis\",\"tambah\");'><i class='fa fa-plus'></i> Tambah Data</button></div>";
        }
        
        $table .= "<table class='table table-striped table-bordered table-hover dataTables-example pull-left' width='99%'>";
        $table .= "<thead>";
        $table .= " <tr>
                        <th>No</th>
                        <th>Kode Jenis</th>
                        <th>Keterangan</th>
                        <th>Keterangan Lengkap</th>         
                        <th>Jenis Hukuman</th>
                        <th>Aksi</th>
                    </tr>";
        $table .= "</thead>";
        $table .= "<tbody>";
        foreach($query->result() as $row){
            $table .= "<tr>";
                $table .= "<td width='5px'>".$i."</td>";
                $table .= "<td>".$row->JENHUKDIS."</td>";
                $table .= "<td>".$row->KETERANGAN."</td>";
                $table .= "<td>".$row->KET_LENGKAP."</td>";
                $table .= "<td>".$row->JENIS_HUKUMAN."</td>";                

                $ubah = "";
            if ($hak_akses->act_update == 'Y'){
                $ubah = "<button type='button' class='btn btn-outline btn-xs btn-success' title='Edit' onClick='getForm(\"ref_hukdis\",\"edit\",\"".$row->JENHUKDIS."\");'><i class='fa fa-pencil-square'></i></button> ";
            }

            // $hapus_flag = "";
            // if ($hak_akses->act_delete_flag == 'Y'){
            //     $hapus_flag = "<button type='button' class='btn btn-outline btn-xs btn-danger' title='Hapus' onClick='confirmHapusDataFlag(\"ref_hukdis\",\"".$row->JENHUKDIS."\");'><i class='fa fa-trash'></i></button>";
            // }

            $hapus = "";
            if ($hak_akses->act_delete == 'Y'){
                $hapus = "<button type='button' class='btn btn-outline btn-xs btn-danger' title='Hapus ' onClick='confirmHapusData(\"ref_hukdis\",\"".$row->JENHUKDIS."\");'><i class='fa fa-trash'></i></button>";
            }

                $table .= "<td >$ubah  $hapus</td>";
            $table .= "</tr>";

            $i++;
        }
        $table .= "</tbody>";
        $table .= "</table>";
        $table .= "</div>";

        return $table;

    }

    public function getReferensiPegawai(){
        $hak_akses = $this->ci->infopegawai->hakAksesModul('1440',$this->ci->session->userdata('logged_in')['user_group']);

        $sql = "SELECT JENPEG, KETERANGAN 
                FROM PERS_JENPEG_RPT
                ORDER BY JENPEG ASC
                ";                
                // WHERE DELETED IS NULL

        $query = $this->ci->db->query($sql);

        $i = 1;

        $table  = "<div id='_content_riwayat' class='animated fadeInUp'>";                
        if ($hak_akses->act_insert == 'Y'){
           $table .= "<div class='pull-right'><button type='button' class='btn btn-primary btn-sm btn-block m-t' onClick='getForm(\"ref_pegawai\",\"tambah\");'><i class='fa fa-plus'></i> Tambah Data</button></div>";
        }
        
        $table .= "<table class='table table-striped table-bordered table-hover dataTables-example pull-left' width='99%'>";
        $table .= "<thead>";
        $table .= " <tr>
                        <th>No</th>
                        <th>Kode Jenis</th>
                        <th>Keterangan</th>         
                        <th>Aksi</th>
                    </tr>";
        $table .= "</thead>";
        $table .= "<tbody>";
        foreach($query->result() as $row){
            $table .= "<tr>";
                $table .= "<td width='5px'>".$i."</td>";
                $table .= "<td>".$row->JENPEG."</td>";
                $table .= "<td>".$row->KETERANGAN."</td>";                

                $ubah = "";
            if ($hak_akses->act_update == 'Y'){
                $ubah = "<button type='button' class='btn btn-outline btn-xs btn-success' title='Edit' onClick='getForm(\"ref_pegawai\",\"edit\",\"".$row->JENPEG."\");'><i class='fa fa-pencil-square'></i></button> ";
            }

            // $hapus_flag = "";
            // if ($hak_akses->act_delete_flag == 'Y'){
            //     $hapus_flag = "<button type='button' class='btn btn-outline btn-xs btn-danger' title='Hapus' onClick='confirmHapusDataFlag(\"ref_pegawai\",\"".$row->JENPEG."\");'><i class='fa fa-trash'></i></button>";
            // }

            $hapus = "";
            if ($hak_akses->act_delete == 'Y'){
                $hapus = "<button type='button' class='btn btn-outline btn-xs btn-danger' title='Hapus ' onClick='confirmHapusData(\"ref_pegawai\",\"".$row->JENPEG."\");'><i class='fa fa-trash'></i></button>";
            }

                $table .= "<td >$ubah  $hapus</td>";
            $table .= "</tr>";

            $i++;
        }
        $table .= "</tbody>";
        $table .= "</table>";
        $table .= "</div>";

        return $table;

    }

    public function getReferensiPejtt(){
        $hak_akses = $this->ci->infopegawai->hakAksesModul('1459',$this->ci->session->userdata('logged_in')['user_group']);

        $sql = "SELECT PEJTT, KETERANGAN 
                FROM PERS_PEJTT_RPT
                ORDER BY PEJTT ASC
                ";  
                // WHERE DELETED IS NULL              

        $query = $this->ci->db->query($sql);

        $i = 1;

        $table  = "<div id='_content_riwayat' class='animated fadeInUp'>";                
        if ($hak_akses->act_insert == 'Y'){
           $table .= "<div class='pull-right'><button type='button' class='btn btn-primary btn-sm btn-block m-t' onClick='getForm(\"ref_pejtt\",\"tambah\");'><i class='fa fa-plus'></i> Tambah Data</button></div>";
        }
        
        $table .= "<table class='table table-striped table-bordered table-hover dataTables-example pull-left' width='99%'>";
        $table .= "<thead>";
        $table .= " <tr>
                        <th>No</th>
                        <th>Pejtt</th>
                        <th>Keterangan</th>         
                        <th>Aksi</th>
                    </tr>";
        $table .= "</thead>";
        $table .= "<tbody>";
        foreach($query->result() as $row){
            $table .= "<tr>";
                $table .= "<td width='5px'>".$i."</td>";
                $table .= "<td>".$row->PEJTT."</td>";
                $table .= "<td>".$row->KETERANGAN."</td>";                

                $ubah = "";
            if ($hak_akses->act_update == 'Y'){
                $ubah = "<button type='button' class='btn btn-outline btn-xs btn-success' title='Edit' onClick='getForm(\"ref_pejtt\",\"edit\",\"".$row->PEJTT."\");'><i class='fa fa-pencil-square'></i></button> ";
            }

            // $hapus_flag = "";
            // if ($hak_akses->act_delete_flag == 'Y'){
            //     $hapus_flag = "<button type='button' class='btn btn-outline btn-xs btn-danger' title='Hapus' onClick='confirmHapusDataFlag(\"ref_pejtt\",\"".$row->PEJTT."\");'><i class='fa fa-trash'></i></button>";
            // }

            $hapus = "";
            if ($hak_akses->act_delete == 'Y'){
                $hapus = "<button type='button' class='btn btn-outline btn-xs btn-danger' title='Hapus ' onClick='confirmHapusData(\"ref_pejtt\",\"".$row->PEJTT."\");'><i class='fa fa-trash'></i></button>";
            }

                $table .= "<td >$ubah  $hapus</td>";
            $table .= "</tr>";

            $i++;
        }
        $table .= "</tbody>";
        $table .= "</table>";
        $table .= "</div>";

        return $table;

    }

    public function getReferensiPerubahan(){
        $hak_akses = $this->ci->infopegawai->hakAksesModul('1445',$this->ci->session->userdata('logged_in')['user_group']);

        $sql = "SELECT JENRUB, KETERANGAN 
                FROM PERS_JENRUB_RPT 
                
                ORDER BY JENRUB
                ";                

        $query = $this->ci->db->query($sql);

        $i = 1;

        $table  = "<div id='_content_riwayat' class='animated fadeInUp'>";                
        if ($hak_akses->act_insert == 'Y'){
           $table .= "<div class='pull-right'><button type='button' class='btn btn-primary btn-sm btn-block m-t' onClick='getForm(\"ref_jenrub\",\"tambah\");'><i class='fa fa-plus'></i> Tambah Data</button></div>";
        }
        
        $table .= "<table class='table table-striped table-bordered table-hover dataTables-example pull-left' width='99%'>";
        $table .= "<thead>";
        $table .= " <tr>
                        <th>No</th>
                        <th>Kode Jenis</th>
                        <th>Keterangan</th>         
                        <th>Aksi</th>
                    </tr>";
        $table .= "</thead>";
        $table .= "<tbody>";
        foreach($query->result() as $row){
            $table .= "<tr>";
                $table .= "<td width='5px'>".$i."</td>";
                $table .= "<td>".$row->JENRUB."</td>";
                $table .= "<td>".$row->KETERANGAN."</td>";                

                $ubah = "";
            if ($hak_akses->act_update == 'Y'){
                $ubah = "<button type='button' class='btn btn-outline btn-xs btn-success' title='Edit' onClick='getForm(\"ref_jenrub\",\"edit\",\"".$row->JENRUB."\");'><i class='fa fa-pencil-square'></i></button> ";
            }

            // $hapus_flag = "";
            // if ($hak_akses->act_delete_flag == 'Y'){
            //     $hapus_flag = "<button type='button' class='btn btn-outline btn-xs btn-danger' title='Hapus' onClick='confirmHapusDataFlag(\"ref_jenrub\",\"".$row->JENRUB."\");'><i class='fa fa-trash'></i></button>";
            // }

            $hapus = "";
            if ($hak_akses->act_delete == 'Y'){
                $hapus = "<button type='button' class='btn btn-outline btn-xs btn-danger' title='Hapus ' onClick='confirmHapusData(\"ref_jenrub\",\"".$row->JENRUB."\");'><i class='fa fa-trash'></i></button>";
            }

                $table .= "<td >$ubah  $hapus</td>";
            $table .= "</tr>";

            $i++;
        }
        $table .= "</tbody>";
        $table .= "</table>";
        $table .= "</div>";

        return $table;

    }

    public function getReferensiJenisUsaha(){
        $hak_akses = $this->ci->infopegawai->hakAksesModul('1448',$this->ci->session->userdata('logged_in')['user_group']);

        $sql = "SELECT JENUSAHA, KETERANGAN 
                FROM PERS_JENUSAHA_RPT
                ";    
                // WHERE DELETED IS NULL            

        $query = $this->ci->db->query($sql);

        $i = 1;

        $table  = "<div id='_content_riwayat' class='animated fadeInUp'>";                
        if ($hak_akses->act_insert == 'Y'){
           $table .= "<div class='pull-right'><button type='button' class='btn btn-primary btn-sm btn-block m-t' onClick='getForm(\"ref_jenusaha\",\"tambah\");'><i class='fa fa-plus'></i> Tambah Data</button></div>";
        }
        
        $table .= "<table class='table table-striped table-bordered table-hover dataTables-example pull-left' width='99%'>";
        $table .= "<thead>";
        $table .= " <tr>
                        <th>No</th>
                        <th>Kode Jenis</th>
                        <th>Keterangan</th>         
                        <th>Aksi</th>
                    </tr>";
        $table .= "</thead>";
        $table .= "<tbody>";
        foreach($query->result() as $row){
            $table .= "<tr>";
                $table .= "<td width='5px'>".$i."</td>";
                $table .= "<td>".$row->JENUSAHA."</td>";
                $table .= "<td>".$row->KETERANGAN."</td>";                

                $ubah = "";
            if ($hak_akses->act_update == 'Y'){
                $ubah = "<button type='button' class='btn btn-outline btn-xs btn-success' title='Edit' onClick='getForm(\"ref_jenusaha\",\"edit\",\"".$row->JENUSAHA."\");'><i class='fa fa-pencil-square'></i></button> ";
            }

            // $hapus_flag = "";
            // if ($hak_akses->act_delete_flag == 'Y'){
            //     $hapus_flag = "<button type='button' class='btn btn-outline btn-xs btn-danger' title='Hapus' onClick='confirmHapusDataFlag(\"ref_jenusaha\",\"".$row->JENUSAHA."\");'><i class='fa fa-trash'></i></button>";
            // }

            $hapus = "";
            if ($hak_akses->act_delete == 'Y'){
                $hapus = "<button type='button' class='btn btn-outline btn-xs btn-danger' title='Hapus ' onClick='confirmHapusData(\"ref_jenusaha\",\"".$row->JENUSAHA."\");'><i class='fa fa-trash'></i></button>";
            }

                $table .= "<td >$ubah  $hapus</td>";
            $table .= "</tr>";

            $i++;
        }
        $table .= "</tbody>";
        $table .= "</table>";
        $table .= "</div>";

        return $table;

    }

    public function getReferensiKddukanOrganisasi(){
        $hak_akses = $this->ci->infopegawai->hakAksesModul('1438',$this->ci->session->userdata('logged_in')['user_group']);

        $sql = "SELECT KDDUDUK, KETERANGAN 
                FROM PERS_KDDUDUK_RPT
                ORDER BY KDDUDUK ASC
                ";     
                // WHERE DELETED IS NULL           

        $query = $this->ci->db->query($sql);

        $i = 1;

        $table  = "<div id='_content_riwayat' class='animated fadeInUp'>";                
        if ($hak_akses->act_insert == 'Y'){
           $table .= "<div class='pull-right'><button type='button' class='btn btn-primary btn-sm btn-block m-t' onClick='getForm(\"ref_kdduduk\",\"tambah\");'><i class='fa fa-plus'></i> Tambah Data</button></div>";
        }
        
        $table .= "<table class='table table-striped table-bordered table-hover dataTables-example pull-left' width='99%'>";
        $table .= "<thead>";
        $table .= " <tr>
                        <th>No</th>
                        <th>Kode</th>
                        <th>Keterangan</th>         
                        <th>Aksi</th>
                    </tr>";
        $table .= "</thead>";
        $table .= "<tbody>";
        foreach($query->result() as $row){
            $table .= "<tr>";
                $table .= "<td width='5px'>".$i."</td>";
                $table .= "<td>".$row->KDDUDUK."</td>";
                $table .= "<td>".$row->KETERANGAN."</td>";                

                $ubah = "";
            if ($hak_akses->act_update == 'Y'){
                $ubah = "<button type='button' class='btn btn-outline btn-xs btn-success' title='Edit' onClick='getForm(\"ref_kdduduk\",\"edit\",\"".$row->KDDUDUK."\");'><i class='fa fa-pencil-square'></i></button> ";
            }

            // $hapus_flag = "";
            // if ($hak_akses->act_delete_flag == 'Y'){
            //     $hapus_flag = "<button type='button' class='btn btn-outline btn-xs btn-danger' title='Hapus' onClick='confirmHapusDataFlag(\"ref_kdduduk\",\"".$row->KDDUDUK."\");'><i class='fa fa-trash'></i></button>";
            // }

            $hapus = "";
            if ($hak_akses->act_delete == 'Y'){
                $hapus = "<button type='button' class='btn btn-outline btn-xs btn-danger' title='Hapus ' onClick='confirmHapusData(\"ref_kdduduk\",\"".$row->KDDUDUK."\");'><i class='fa fa-trash'></i></button>";
            }

                $table .= "<td >$ubah  $hapus</td>";
            $table .= "</tr>";

            $i++;
        }
        $table .= "</tbody>";
        $table .= "</table>";
        $table .= "</div>";

        return $table;

    }

    public function getReferensiPekerjaan(){
        $hak_akses = $this->ci->infopegawai->hakAksesModul('1441',$this->ci->session->userdata('logged_in')['user_group']);

        $sql = "SELECT KDKERJA, KETERANGAN 
                FROM PERS_KDKERJA_RPT
                ORDER BY KDKERJA
                ";    
                // WHERE DELETED IS NULL            

        $query = $this->ci->db->query($sql);

        $i = 1;

        $table  = "<div id='_content_riwayat' class='animated fadeInUp'>";                
        if ($hak_akses->act_insert == 'Y'){
           $table .= "<div class='pull-right'><button type='button' class='btn btn-primary btn-sm btn-block m-t' onClick='getForm(\"ref_kdkerja\",\"tambah\");'><i class='fa fa-plus'></i> Tambah Data</button></div>";
        }
        
        $table .= "<table class='table table-striped table-bordered table-hover dataTables-example pull-left' width='99%'>";
        $table .= "<thead>";
        $table .= " <tr>
                        <th>No</th>
                        <th>Kode</th>
                        <th>Keterangan</th>         
                        <th>Aksi</th>
                    </tr>";
        $table .= "</thead>";
        $table .= "<tbody>";
        foreach($query->result() as $row){
            $table .= "<tr>";
                $table .= "<td width='5px'>".$i."</td>";
                $table .= "<td>".$row->KDKERJA."</td>";
                $table .= "<td>".$row->KETERANGAN."</td>";                

                $ubah = "";
            if ($hak_akses->act_update == 'Y'){
                $ubah = "<button type='button' class='btn btn-outline btn-xs btn-success' title='Edit' onClick='getForm(\"ref_kdkerja\",\"edit\",\"".$row->KDKERJA."\");'><i class='fa fa-pencil-square'></i></button> ";
            }

            // $hapus_flag = "";
            // if ($hak_akses->act_delete_flag == 'Y'){
            //     $hapus_flag = "<button type='button' class='btn btn-outline btn-xs btn-danger' title='Hapus' onClick='confirmHapusDataFlag(\"ref_kdkerja\",\"".$row->KDKERJA."\");'><i class='fa fa-trash'></i></button>";
            // }

            $hapus = "";
            if ($hak_akses->act_delete == 'Y'){
                $hapus = "<button type='button' class='btn btn-outline btn-xs btn-danger' title='Hapus ' onClick='confirmHapusData(\"ref_kdkerja\",\"".$row->KDKERJA."\");'><i class='fa fa-trash'></i></button>";
            }

                $table .= "<td >$ubah  $hapus</td>";
            $table .= "</tr>";

            $i++;
        }
        $table .= "</tbody>";
        $table .= "</table>";
        $table .= "</div>";

        return $table;

    }

    public function getReferensiLingkup(){
        $hak_akses = $this->ci->infopegawai->hakAksesModul('1439',$this->ci->session->userdata('logged_in')['user_group']);

        $sql = "SELECT KDLINGKUP, KETERANGAN 
                FROM PERS_KDLINGKUP_RPT 
                ORDER BY KDLINGKUP
                ";            
                // WHERE DELETED IS NULL    

        $query = $this->ci->db->query($sql);

        $i = 1;

        $table  = "<div id='_content_riwayat' class='animated fadeInUp'>";                
        if ($hak_akses->act_insert == 'Y'){
           $table .= "<div class='pull-right'><button type='button' class='btn btn-primary btn-sm btn-block m-t' onClick='getForm(\"ref_kdlingkup\",\"tambah\");'><i class='fa fa-plus'></i> Tambah Data</button></div>";
        }
        
        $table .= "<table class='table table-striped table-bordered table-hover dataTables-example pull-left' width='99%'>";
        $table .= "<thead>";
        $table .= " <tr>
                        <th>No</th>
                        <th>Kode</th>
                        <th>Keterangan</th>         
                        <th>Aksi</th>
                    </tr>";
        $table .= "</thead>";
        $table .= "<tbody>";
        foreach($query->result() as $row){
            $table .= "<tr>";
                $table .= "<td width='5px'>".$i."</td>";
                $table .= "<td>".$row->KDLINGKUP."</td>";
                $table .= "<td>".$row->KETERANGAN."</td>";                

                $ubah = "";
            if ($hak_akses->act_update == 'Y'){
                $ubah = "<button type='button' class='btn btn-outline btn-xs btn-success' title='Edit' onClick='getForm(\"ref_kdlingkup\",\"edit\",\"".$row->KDLINGKUP."\");'><i class='fa fa-pencil-square'></i></button> ";
            }

            // $hapus_flag = "";
            // if ($hak_akses->act_delete_flag == 'Y'){
            //     $hapus_flag = "<button type='button' class='btn btn-outline btn-xs btn-danger' title='Hapus' onClick='confirmHapusDataFlag(\"ref_kdlingkup\",\"".$row->KDLINGKUP."\");'><i class='fa fa-trash'></i></button>";
            // }

            $hapus = "";
            if ($hak_akses->act_delete == 'Y'){
                $hapus = "<button type='button' class='btn btn-outline btn-xs btn-danger' title='Hapus ' onClick='confirmHapusData(\"ref_kdlingkup\",\"".$row->KDLINGKUP."\");'><i class='fa fa-trash'></i></button>";
            }

                $table .= "<td >$ubah  $hapus</td>";
            $table .= "</tr>";

            $i++;
        }
        $table .= "</tbody>";
        $table .= "</table>";
        $table .= "</div>";

        return $table;
    }

    public function getReferensiPeranSeminar(){
        $hak_akses = $this->ci->infopegawai->hakAksesModul('1444',$this->ci->session->userdata('logged_in')['user_group']);

        $sql = "SELECT KDPERAN, KETERANGAN 
                FROM PERS_KDPERANS_RPT 
                ORDER BY KDPERAN
                ";        
                // WHERE DELETED IS NULL        

        $query = $this->ci->db->query($sql);

        $i = 1;

        $table  = "<div id='_content_riwayat' class='animated fadeInUp'>";                
        if ($hak_akses->act_insert == 'Y'){
           $table .= "<div class='pull-right'><button type='button' class='btn btn-primary btn-sm btn-block m-t' onClick='getForm(\"ref_seminar\",\"tambah\");'><i class='fa fa-plus'></i> Tambah Data</button></div>";
        }
        
        $table .= "<table class='table table-striped table-bordered table-hover dataTables-example pull-left' width='99%'>";
        $table .= "<thead>";
        $table .= " <tr>
                        <th>No</th>
                        <th>Kode</th>
                        <th>Keterangan</th>         
                        <th>Aksi</th>
                    </tr>";
        $table .= "</thead>";
        $table .= "<tbody>";
        foreach($query->result() as $row){
            $table .= "<tr>";
                $table .= "<td width='5px'>".$i."</td>";
                $table .= "<td>".$row->KDPERAN."</td>";
                $table .= "<td>".$row->KETERANGAN."</td>";                

                $ubah = "";
            if ($hak_akses->act_update == 'Y'){
                $ubah = "<button type='button' class='btn btn-outline btn-xs btn-success' title='Edit' onClick='getForm(\"ref_seminar\",\"edit\",\"".$row->KDPERAN."\");'><i class='fa fa-pencil-square'></i></button>";
            }

            // $hapus_flag = "";
            // if ($hak_akses->act_delete_flag == 'Y'){
            //     $hapus_flag = "<button type='button' class='btn btn-outline btn-xs btn-danger' title='Hapus' onClick='confirmHapusDataFlag(\"ref_seminar\",\"".$row->KDPERAN."\");'><i class='fa fa-trash'></i></button>";
            // }

            $hapus = "";
            if ($hak_akses->act_delete == 'Y'){
                $hapus = "<button type='button' class='btn btn-outline btn-xs btn-danger' title='Hapus ' onClick='confirmHapusData(\"ref_seminar\",\"".$row->KDPERAN."\");'><i class='fa fa-trash'></i></button>";
            }

                $table .= "<td >$ubah  $hapus</td>";
            $table .= "</tr>";

            $i++;
        }
        $table .= "</tbody>";
        $table .= "</table>";
        $table .= "</div>";

        return $table;

    }

    public function getReferensiPeranPenulisan(){
        $hak_akses = $this->ci->infopegawai->hakAksesModul('1443',$this->ci->session->userdata('logged_in')['user_group']);

        $sql = "SELECT KDPERAN, KETERANGAN 
                FROM PERS_KDPERANT_RPT 
                ORDER BY KDPERAN
                ";            
                // WHERE DELETED IS NULL    

        $query = $this->ci->db->query($sql);

        $i = 1;

        $table  = "<div id='_content_riwayat' class='animated fadeInUp'>";                
        if ($hak_akses->act_insert == 'Y'){
           $table .= "<div class='pull-right'><button type='button' class='btn btn-primary btn-sm btn-block m-t' onClick='getForm(\"ref_peran\",\"tambah\");'><i class='fa fa-plus'></i> Tambah Data</button></div>";
        }
        
        $table .= "<table class='table table-striped table-bordered table-hover dataTables-example pull-left' width='99%'>";
        $table .= "<thead>";
        $table .= " <tr>
                        <th>No</th>
                        <th>Kode</th>
                        <th>Keterangan</th>         
                        <th>Aksi</th>
                    </tr>";
        $table .= "</thead>";
        $table .= "<tbody>";
        foreach($query->result() as $row){
            $table .= "<tr>";
                $table .= "<td width='5px'>".$i."</td>";
                $table .= "<td>".$row->KDPERAN."</td>";
                $table .= "<td>".$row->KETERANGAN."</td>";                

                $ubah = "";
            if ($hak_akses->act_update == 'Y'){
                $ubah = "<button type='button' class='btn btn-outline btn-xs btn-success' title='Edit' onClick='getForm(\"ref_peran\",\"edit\",\"".$row->KDPERAN."\");'><i class='fa fa-pencil-square'></i></button>";
            }

            // $hapus_flag = "";
            // if ($hak_akses->act_delete_flag == 'Y'){
            //     $hapus_flag = "<button type='button' class='btn btn-outline btn-xs btn-danger' title='Hapus' onClick='confirmHapusDataFlag(\"ref_peran\",\"".$row->KDPERAN."\");'><i class='fa fa-trash'></i></button>";
            // }

            $hapus = "";
            if ($hak_akses->act_delete == 'Y'){
                $hapus = "<button type='button' class='btn btn-outline btn-xs btn-danger' title='Hapus ' onClick='confirmHapusData(\"ref_peran\",\"".$row->KDPERAN."\");'><i class='fa fa-trash'></i></button>";
            }

                $table .= "<td >$ubah  $hapus</td>";
            $table .= "</tr>";

            $i++;
        }
        $table .= "</tbody>";
        $table .= "</table>";
        $table .= "</div>";

        return $table;

    }

    public function getReferensiJenisSeminar(){
        $hak_akses = $this->ci->infopegawai->hakAksesModul('1446',$this->ci->session->userdata('logged_in')['user_group']);

        $sql = "SELECT KDSEMI, KETERANGAN 
                FROM PERS_KDSEMI_RPT 
                ORDER BY KDSEMI ASC
                ";  
                // WHERE DELETED IS NULL              

        $query = $this->ci->db->query($sql);

        $i = 1;

        $table  = "<div id='_content_riwayat' class='animated fadeInUp'>";                
        if ($hak_akses->act_insert == 'Y'){
           $table .= "<div class='pull-right'><button type='button' class='btn btn-primary btn-sm btn-block m-t' onClick='getForm(\"ref_kdsemi\",\"tambah\");'><i class='fa fa-plus'></i> Tambah Data</button></div>";
        }
        
        $table .= "<table class='table table-striped table-bordered table-hover dataTables-example pull-left' width='99%'>";
        $table .= "<thead>";
        $table .= " <tr>
                        <th>No</th>
                        <th>Kode</th>
                        <th>Keterangan</th>         
                        <th>Aksi</th>
                    </tr>";
        $table .= "</thead>";
        $table .= "<tbody>";
        foreach($query->result() as $row){
            $table .= "<tr>";
                $table .= "<td width='5px'>".$i."</td>";
                $table .= "<td>".$row->KDSEMI."</td>";
                $table .= "<td>".$row->KETERANGAN."</td>";                

                $ubah = "";
            if ($hak_akses->act_update == 'Y'){
                $ubah = "<button type='button' class='btn btn-outline btn-xs btn-success' title='Edit' onClick='getForm(\"ref_kdsemi\",\"edit\",\"".$row->KDSEMI."\");'><i class='fa fa-pencil-square'></i></button> ";
            }

            // $hapus_flag = "";
            // if ($hak_akses->act_delete_flag == 'Y'){
            //     $hapus_flag = "<button type='button' class='btn btn-outline btn-xs btn-danger' title='Hapus' onClick='confirmHapusDataFlag(\"ref_kdsemi\",\"".$row->KDSEMI."\");'><i class='fa fa-trash'></i></button>";
            // }

            $hapus = "";
            if ($hak_akses->act_delete == 'Y'){
                $hapus = "<button type='button' class='btn btn-outline btn-xs btn-danger' title='Hapus ' onClick='confirmHapusData(\"ref_kdsemi\",\"".$row->KDSEMI."\");'><i class='fa fa-trash'></i></button>";
            }

                $table .= "<td >$ubah  $hapus</td>";
            $table .= "</tr>";

            $i++;
        }
        $table .= "</tbody>";
        $table .= "</table>";
        $table .= "</div>";

        return $table;

    }

    public function getReferensiJenisSifat(){
        $hak_akses = $this->ci->infopegawai->hakAksesModul('1447',$this->ci->session->userdata('logged_in')['user_group']);

        $sql = "SELECT KDSIFAT, KETERANGAN 
                FROM PERS_KDSIFAT_RPT
                ORDER BY KDSIFAT ASC
                ";     
                // WHERE DELETED IS NULL           

        $query = $this->ci->db->query($sql);

        $i = 1;

        $table  = "<div id='_content_riwayat' class='animated fadeInUp'>";                
        if ($hak_akses->act_insert == 'Y'){
           $table .= "<div class='pull-right'><button type='button' class='btn btn-primary btn-sm btn-block m-t' onClick='getForm(\"ref_kdsifat\",\"tambah\");'><i class='fa fa-plus'></i> Tambah Data</button></div>";
        }
        
        $table .= "<table class='table table-striped table-bordered table-hover dataTables-example pull-left' width='99%'>";
        $table .= "<thead>";
        $table .= " <tr>
                        <th>No</th>
                        <th>Kode</th>
                        <th>Keterangan</th>         
                        <th>Aksi</th>
                    </tr>";
        $table .= "</thead>";
        $table .= "<tbody>";
        foreach($query->result() as $row){
            $table .= "<tr>";
                $table .= "<td width='5px'>".$i."</td>";
                $table .= "<td>".$row->KDSIFAT."</td>";
                $table .= "<td>".$row->KETERANGAN."</td>";                

                $ubah = "";
            if ($hak_akses->act_update == 'Y'){
                $ubah = "<button type='button' class='btn btn-outline btn-xs btn-success' title='Edit' onClick='getForm(\"ref_kdsifat\",\"edit\",\"".$row->KDSIFAT."\");'><i class='fa fa-pencil-square'></i></button>";
            }

            // $hapus_flag = "";
            // if ($hak_akses->act_delete_flag == 'Y'){
            //     $hapus_flag = "<button type='button' class='btn btn-outline btn-xs btn-danger' title='Hapus' onClick='confirmHapusDataFlag(\"ref_kdsifat\",\"".$row->KDSIFAT."\");'><i class='fa fa-trash'></i></button>";
            // }

            $hapus = "";
            if ($hak_akses->act_delete == 'Y'){
                $hapus = "<button type='button' class='btn btn-outline btn-xs btn-danger' title='Hapus ' onClick='confirmHapusData(\"ref_kdsifat\",\"".$row->KDSIFAT."\");'><i class='fa fa-trash'></i></button>";
            }

                $table .= "<td >$ubah  $hapus</td>";
            $table .= "</tr>";

            $i++;
        }
        $table .= "</tbody>";
        $table .= "</table>";
        $table .= "</div>";

        return $table;

    }

    public function getReferensiKelompokKodik(){
        $hak_akses = $this->ci->infopegawai->hakAksesModul('1451',$this->ci->session->userdata('logged_in')['user_group']);

        $sql = "SELECT KODIK, KODIKF, KETERANGAN 
                FROM PERS_KODIK_RPT 
                ORDER BY KODIK,KODIKF ASC
                ";       
                // WHERE DELETED IS NULL         

        $query = $this->ci->db->query($sql);

        $i = 1;

        $table  = "<div id='_content_riwayat' class='animated fadeInUp'>";                
        if ($hak_akses->act_insert == 'Y'){
           $table .= "<div class='pull-right'><button type='button' class='btn btn-primary btn-sm btn-block m-t' onClick='getForm(\"ref_kodik\",\"tambah\");'><i class='fa fa-plus'></i> Tambah Data</button></div>";
        }
         
        $table .= "<table class='table table-striped table-bordered table-hover dataTables-example pull-left' width='99%'>";
        $table .= "<thead>";
        $table .= " <tr>
                        <th>No</th>
                        <th>Kode</th>
                        <th>Kode Jenis</th>
                        <th>Keterangan</th>         
                        <th>Aksi</th>
                    </tr>";
        $table .= "</thead>";
        $table .= "<tbody>";
        foreach($query->result() as $row){
            $table .= "<tr>";
                $table .= "<td width='5px'>".$i."</td>";
                $table .= "<td>".$row->KODIK."</td>";
                $table .= "<td>".$row->KODIKF."</td>";
                $table .= "<td>".$row->KETERANGAN."</td>";                

                $ubah = "";
            if ($hak_akses->act_update == 'Y'){
                $ubah = "<button type='button' class='btn btn-outline btn-xs btn-success' title='Edit' onClick='getForm(\"ref_kodik\",\"edit\",\"".$row->KODIK."\");'><i class='fa fa-pencil-square'></i></button> ";
            }

            // $hapus_flag = "";
            // if ($hak_akses->act_delete_flag == 'Y'){
            //     $hapus_flag = "<button type='button' class='btn btn-outline btn-xs btn-danger' title='Hapus' onClick='confirmHapusDataFlag(\"ref_kodik\",\"".$row->KODIK."\");'><i class='fa fa-trash'></i></button>";
            // }

            $hapus = "";
            if ($hak_akses->act_delete == 'Y'){
                $hapus = "<button type='button' class='btn btn-outline btn-xs btn-danger' title='Hapus ' onClick='confirmHapusData(\"ref_kodik\",\"".$row->KODIK."\");'><i class='fa fa-trash'></i></button>";
            }

                $table .= "<td >$ubah  $hapus</td>";
            $table .= "</tr>";

            $i++;
        }
        $table .= "</tbody>";
        $table .= "</table>";
        $table .= "</div>";

        return $table;

    }

    public function getReferensiTingkatKodik(){
        $hak_akses = $this->ci->infopegawai->hakAksesModul('1452',$this->ci->session->userdata('logged_in')['user_group']);

        $sql = "SELECT KODIKF, KETERANGAN 
                FROM PERS_KODIKF_RPT 
                ORDER BY KODIKF ASC
                ";             
                // WHERE DELETED IS NULL   

        $query = $this->ci->db->query($sql);

        $i = 1;

        $table  = "<div id='_content_riwayat' class='animated fadeInUp'>";                
        if ($hak_akses->act_insert == 'Y'){
           $table .= "<div class='pull-right'><button type='button' class='btn btn-primary btn-sm btn-block m-t' onClick='getForm(\"ref_kodikf\",\"tambah\");'><i class='fa fa-plus'></i> Tambah Data</button></div>";
        }
        
        $table .= "<table class='table table-striped table-bordered table-hover dataTables-example pull-left' width='99%'>";
        $table .= "<thead>";
        $table .= " <tr>
                        <th>No</th>
                        <th>Kode</th>                        
                        <th>Keterangan</th>         
                        <th>Aksi</th>
                    </tr>";
        $table .= "</thead>";
        $table .= "<tbody>";
        foreach($query->result() as $row){
            $table .= "<tr>";
                $table .= "<td width='5px'>".$i."</td>";
                $table .= "<td>".$row->KODIKF."</td>";                
                $table .= "<td>".$row->KETERANGAN."</td>";                

                $ubah = "";
            if ($hak_akses->act_update == 'Y'){
                $ubah = "<button type='button' class='btn btn-outline btn-xs btn-success' title='Edit' onClick='getForm(\"ref_kodikf\",\"edit\",\"".$row->KODIKF."\");'><i class='fa fa-pencil-square'></i></button>";
            }

            // $hapus_flag = "";
            // if ($hak_akses->act_delete_flag == 'Y'){
            //     $hapus_flag = "<button type='button' class='btn btn-outline btn-xs btn-danger' title='Hapus' onClick='confirmHapusDataFlag(\"ref_kodikf\",\"".$row->KODIKF."\");'><i class='fa fa-trash'></i></button>";
            // }

            $hapus = "";
            if ($hak_akses->act_delete == 'Y'){
                $hapus = "<button type='button' class='btn btn-outline btn-xs btn-danger' title='Hapus ' onClick='confirmHapusData(\"ref_kodikf\",\"".$row->KODIKF."\");'><i class='fa fa-trash'></i></button>";
            }

                $table .= "<td >$ubah  $hapus</td>";
            $table .= "</tr>";

            $i++;
        }
        $table .= "</tbody>";
        $table .= "</table>";
        $table .= "</div>";

        return $table;

    }

    public function getReferensiTingkatKodikJenjang(){
        $hak_akses = $this->ci->infopegawai->hakAksesModul('1453',$this->ci->session->userdata('logged_in')['user_group']);

        $sql = "SELECT KODIKJ, KETERANGAN 
                FROM PERS_KODIKJ_RPT 
                ORDER BY KODIKJ ASC
                ";   
                // WHERE DELETED IS NULL             

        $query = $this->ci->db->query($sql);

        $i = 1;

        $table  = "<div id='_content_riwayat' class='animated fadeInUp'>";                
        if ($hak_akses->act_insert == 'Y'){
           $table .= "<div class='pull-right'><button type='button' class='btn btn-primary btn-sm btn-block m-t' onClick='getForm(\"ref_kodikj\",\"tambah\");'><i class='fa fa-plus'></i> Tambah Data</button></div>";
        }
        
        $table .= "<table class='table table-striped table-bordered table-hover dataTables-example pull-left' width='99%'>";
        $table .= "<thead>";
        $table .= " <tr>
                        <th>No</th>
                        <th>Kode</th>                        
                        <th>Keterangan</th>         
                        <th>Aksi</th>
                    </tr>";
        $table .= "</thead>";
        $table .= "<tbody>";
        foreach($query->result() as $row){
            $table .= "<tr>";
                $table .= "<td width='5px'>".$i."</td>";
                $table .= "<td>".$row->KODIKJ."</td>";                
                $table .= "<td>".$row->KETERANGAN."</td>";                

                $ubah = "";
            if ($hak_akses->act_update == 'Y'){
                $ubah = "<button type='button' class='btn btn-outline btn-xs btn-success' title='Edit' onClick='getForm(\"ref_kodikj\",\"edit\",\"".$row->KODIKJ."\");'><i class='fa fa-pencil-square'></i></button>";
            }

            // $hapus_flag = "";
            // if ($hak_akses->act_delete_flag == 'Y'){
            //     $hapus_flag = "<button type='button' class='btn btn-outline btn-xs btn-danger' title='Hapus' onClick='confirmHapusDataFlag(\"ref_kodikj\",\"".$row->KODIKJ."\");'><i class='fa fa-trash'></i></button>";
            // }

            $hapus = "";
            if ($hak_akses->act_delete == 'Y'){
                $hapus = "<button type='button' class='btn btn-outline btn-xs btn-danger' title='Hapus ' onClick='confirmHapusData(\"ref_kodikj\",\"".$row->KODIKJ."\");'><i class='fa fa-trash'></i></button>";
            }

                $table .= "<td >$ubah  $hapus</td>";
            $table .= "</tr>";

            $i++;
        }
        $table .= "</tbody>";
        $table .= "</table>";
        $table .= "</div>";

        return $table;

    }

    public function getReferensiInduk(){
        $hak_akses = $this->ci->infopegawai->hakAksesModul('1431',$this->ci->session->userdata('logged_in')['user_group']);

        $sql = "SELECT INDUK, NAMA_DEPT  
                FROM PERS_INDUK_TBL 
                
                ORDER BY INDUK ASC
                "; 
                // WHERE DELETED IS NULL               

        $query = $this->ci->db->query($sql);

        $i = 1;

        $table  = "<div id='_content_riwayat' class='animated fadeInUp'>";                
        if ($hak_akses->act_insert == 'Y'){
           $table .= "<div class='pull-right'><button type='button' class='btn btn-primary btn-sm btn-block m-t' onClick='getForm(\"ref_induk\",\"tambah\");'><i class='fa fa-plus'></i> Tambah Data</button></div>";
        }
        
        $table .= "<table class='table table-striped table-bordered table-hover dataTables-example pull-left' width='99%'>";
        $table .= "<thead>";
        $table .= " <tr>
                        <th>No</th>
                        <th>Kode</th>                        
                        <th>Nama Departemen</th>         
                        <th>Aksi</th>
                    </tr>";
        $table .= "</thead>";
        $table .= "<tbody>";
        foreach($query->result() as $row){
            $table .= "<tr>";
                $table .= "<td width='5px'>".$i."</td>";
                $table .= "<td>".$row->INDUK."</td>";                
                $table .= "<td>".$row->NAMA_DEPT."</td>";                

                $ubah = "";
            if ($hak_akses->act_update == 'Y'){
                $ubah = "<button type='button' class='btn btn-outline btn-xs btn-success' title='Edit' onClick='getForm(\"ref_induk\",\"edit\",\"".$row->INDUK."\");'><i class='fa fa-pencil-square'></i></button>";
            }

            // $hapus_flag = "";
            // if ($hak_akses->act_delete_flag == 'Y'){
            //     $hapus_flag = "<button type='button' class='btn btn-outline btn-xs btn-danger' title='Hapus' onClick='confirmHapusDataFlag(\"ref_induk\",\"".$row->INDUK."\");'><i class='fa fa-trash'></i></button>";
            // }

            $hapus = "";
            if ($hak_akses->act_delete == 'Y'){
                $hapus = "<button type='button' class='btn btn-outline btn-xs btn-danger' title='Hapus ' onClick='confirmHapusData(\"ref_induk\",\"".$row->INDUK."\");'><i class='fa fa-trash'></i></button>";
            }

                $table .= "<td >$ubah  $hapus</td>";
            $table .= "</tr>";

            $i++;
        }
        $table .= "</tbody>";
        $table .= "</table>";
        $table .= "</div>";

        return $table;

    }

    public function getReferensiPenghargaan(){
        $hak_akses = $this->ci->infopegawai->hakAksesModul('1460',$this->ci->session->userdata('logged_in')['user_group']);

        $sql = "SELECT KDHARGA, NAHARGA 
                FROM PERS_HARGAAN_TBL
                ";   
                // WHERE DELETED IS NULL             

        $query = $this->ci->db->query($sql);

        $i = 1;

        $table  = "<div id='_content_riwayat' class='animated fadeInUp'>";                
        if ($hak_akses->act_insert == 'Y'){
           $table .= "<div class='pull-right'><button type='button' class='btn btn-primary btn-sm btn-block m-t' onClick='getForm(\"ref_penghargaan\",\"tambah\");'><i class='fa fa-plus'></i> Tambah Data</button></div>";
        }
         
        $table .= "<table class='table table-striped table-bordered table-hover dataTables-example pull-left' width='99%'>";
        $table .= "<thead>";
        $table .= " <tr>
                        <th>No</th>
                        <th>Kode</th>                        
                        <th>Penghargaan</th>         
                        <th>Aksi</th>
                    </tr>";
        $table .= "</thead>";
        $table .= "<tbody>";
        foreach($query->result() as $row){
            $table .= "<tr>";
                $table .= "<td width='5px'>".$i."</td>";
                $table .= "<td>".$row->KDHARGA."</td>";                
                $table .= "<td>".$row->NAHARGA."</td>";                

                $ubah = "";
            if ($hak_akses->act_update == 'Y'){
                $ubah = "<button type='button' class='btn btn-outline btn-xs btn-success' title='Edit' onClick='getForm(\"ref_penghargaan\",\"edit\",\"".$row->KDHARGA."\");'><i class='fa fa-pencil-square'></i></button>";
            }

            // $hapus_flag = "";
            // if ($hak_akses->act_delete_flag == 'Y'){
            //     $hapus_flag = "<button type='button' class='btn btn-outline btn-xs btn-danger' title='Hapus' onClick='confirmHapusDataFlag(\"ref_penghargaan\",\"".$row->KDHARGA."\");'><i class='fa fa-trash'></i></button>";
            // }

            $hapus = "";
            if ($hak_akses->act_delete == 'Y'){
                $hapus = "<button type='button' class='btn btn-outline btn-xs btn-danger' title='Hapus ' onClick='confirmHapusData(\"ref_penghargaan\",\"".$row->KDHARGA."\");'><i class='fa fa-trash'></i></button>";
            }

                $table .= "<td >$ubah  $hapus</td>";
            $table .= "</tr>";

            $i++;
        }
        $table .= "</tbody>";
        $table .= "</table>";
        $table .= "</div>";

        return $table;

    }

    public function getReferensiUniversitas(){
        $hak_akses = $this->ci->infopegawai->hakAksesModul('1463',$this->ci->session->userdata('logged_in')['user_group']);

        $sql = "SELECT KDUNIVER, NAUNIVER 
                FROM PERS_UNIVER_TBL
                ";         
                // WHERE DELETED IS NULL       

        $query = $this->ci->db->query($sql);

        $i = 1;

        $table  = "<div id='_content_riwayat' class='animated fadeInUp'>";                
        if ($hak_akses->act_insert == 'Y'){
           $table .= "<div class='pull-right'><button type='button' class='btn btn-primary btn-sm btn-block m-t' onClick='getForm(\"ref_universitas\",\"tambah\");'><i class='fa fa-plus'></i> Tambah Data</button></div>";
        }
        
        $table .= "<table class='table table-striped table-bordered table-hover dataTables-example pull-left' width='99%'>";
        $table .= "<thead>";
        $table .= " <tr>
                        <th>No</th>
                        <th>Kode</th>                        
                        <th>Universitas</th>         
                        <th>Aksi</th>
                    </tr>";
        $table .= "</thead>";
        $table .= "<tbody>";
        foreach($query->result() as $row){
            $table .= "<tr>";
                $table .= "<td width='5px'>".$i."</td>";
                $table .= "<td>".$row->KDUNIVER."</td>";                
                $table .= "<td>".$row->NAUNIVER."</td>";                

                $ubah = "";
            if ($hak_akses->act_update == 'Y'){
                $ubah = "<button type='button' class='btn btn-outline btn-xs btn-success' title='Edit' onClick='getForm(\"ref_universitas\",\"edit\",\"".$row->KDUNIVER."\");'><i class='fa fa-pencil-square'></i></button> ";
            }

            // $hapus_flag = "";
            // if ($hak_akses->act_delete_flag == 'Y'){
            //     $hapus_flag = "<button type='button' class='btn btn-outline btn-xs btn-danger' title='Hapus' onClick='confirmHapusDataFlag(\"ref_universitas\",\"".$row->KDUNIVER."\");'><i class='fa fa-trash'></i></button>";
            // }

            $hapus = "";
            if ($hak_akses->act_delete == 'Y'){
                $hapus = "<button type='button' class='btn btn-outline btn-xs btn-danger' title='Hapus ' onClick='confirmHapusData(\"ref_universitas\",\"".$row->KDUNIVER."\");'><i class='fa fa-trash'></i></button>";
            }

                $table .= "<td >$ubah  $hapus</td>";
            $table .= "</tr>";

            $i++;
        }
        $table .= "</tbody>";
        $table .= "</table>";
        $table .= "</div>";

        return $table;

    }

    public function getReferensiNegara(){
        $hak_akses = $this->ci->infopegawai->hakAksesModul('1457',$this->ci->session->userdata('logged_in')['user_group']);

        $sql = "SELECT KONEG, NANEG 
                FROM PERS_NEGARA_TBL
                ";    
                // WHERE DELETED IS NULL            

        $query = $this->ci->db->query($sql);

        $i = 1;

        $table  = "<div id='_content_riwayat' class='animated fadeInUp'>";                
        if ($hak_akses->act_insert == 'Y'){
           $table .= "<div class='pull-right'><button type='button' class='btn btn-primary btn-sm btn-block m-t' onClick='getForm(\"ref_negara\",\"tambah\");'><i class='fa fa-plus'></i> Tambah Data</button></div>";
        }
        
        $table .= "<table class='table table-striped table-bordered table-hover dataTables-example pull-left' width='99%'>";
        $table .= "<thead>";
        $table .= " <tr>
                        <th>No</th>
                        <th>Kode</th>                        
                        <th>Negara</th>         
                        <th>Aksi</th>
                    </tr>";
        $table .= "</thead>";
        $table .= "<tbody>";
        foreach($query->result() as $row){
            $table .= "<tr>";
                $table .= "<td width='5px'>".$i."</td>";
                $table .= "<td>".$row->KONEG."</td>";                
                $table .= "<td>".$row->NANEG."</td>";                

                $ubah = "";
            if ($hak_akses->act_update == 'Y'){
                $ubah = "<button type='button' class='btn btn-outline btn-xs btn-success' title='Edit' onClick='getForm(\"ref_negara\",\"edit\",\"".$row->KONEG."\");'><i class='fa fa-pencil-square'></i></button> ";
            }

            // $hapus_flag = "";
            // if ($hak_akses->act_delete_flag == 'Y'){
            //     $hapus_flag = "<button type='button' class='btn btn-outline btn-xs btn-danger' title='Hapus' onClick='confirmHapusDataFlag(\"ref_negara\",\"".$row->KONEG."\");'><i class='fa fa-trash'></i></button>";
            // }

            $hapus = "";
            if ($hak_akses->act_delete == 'Y'){
                $hapus = "<button type='button' class='btn btn-outline btn-xs btn-danger' title='Hapus ' onClick='confirmHapusData(\"ref_negara\",\"".$row->KONEG."\");'><i class='fa fa-trash'></i></button>";
            }

                $table .= "<td >$ubah  $hapus</td>";
            $table .= "</tr>";

            $i++;
        }
        $table .= "</tbody>";
        $table .= "</table>";
        $table .= "</div>";

        return $table;

    }

    public function getReferensiTema(){
        $hak_akses = $this->ci->infopegawai->hakAksesModul('1461',$this->ci->session->userdata('logged_in')['user_group']);

        $sql = "SELECT KDTEMA, NATEMA 
                FROM PERS_TEMA_TBL
                ";  
                // WHERE DELETED IS NULL              

        $query = $this->ci->db->query($sql);

        $i = 1;

        $table  = "<div id='_content_riwayat' class='animated fadeInUp'>";                
        if ($hak_akses->act_insert == 'Y'){
           $table .= "<div class='pull-right'><button type='button' class='btn btn-primary btn-sm btn-block m-t' onClick='getForm(\"ref_tema\",\"tambah\");'><i class='fa fa-plus'></i> Tambah Data</button></div>";
        }
        
        $table .= "<table class='table table-striped table-bordered table-hover dataTables-example pull-left' width='99%'>";
        $table .= "<thead>";
        $table .= " <tr>
                        <th>No</th>
                        <th>Kode</th>                        
                        <th>Nama Tema</th>         
                        <th>Aksi</th>
                    </tr>";
        $table .= "</thead>";
        $table .= "<tbody>";
        foreach($query->result() as $row){
            $table .= "<tr>";
                $table .= "<td width='5px'>".$i."</td>";
                $table .= "<td>".$row->KDTEMA."</td>";                
                $table .= "<td>".$row->NATEMA."</td>";                

                $ubah = "";
            if ($hak_akses->act_update == 'Y'){
                $ubah = "<button type='button' class='btn btn-outline btn-xs btn-success' title='Edit' onClick='getForm(\"ref_tema\",\"edit\",\"".$row->KDTEMA."\");'><i class='fa fa-pencil-square'></i></button> ";
            }

            // $hapus_flag = "";
            // if ($hak_akses->act_delete_flag == 'Y'){
            //     $hapus_flag = "<button type='button' class='btn btn-outline btn-xs btn-danger' title='Hapus' onClick='confirmHapusDataFlag(\"ref_tema\",\"".$row->KDTEMA."\");'><i class='fa fa-trash'></i></button>";
            // }

            $hapus = "";
            if ($hak_akses->act_delete == 'Y'){
                $hapus = "<button type='button' class='btn btn-outline btn-xs btn-danger' title='Hapus ' onClick='confirmHapusData(\"ref_tema\",\"".$row->KDTEMA."\");'><i class='fa fa-trash'></i></button>";
            }

                $table .= "<td >$ubah  $hapus</td>";
            $table .= "</tr>";

            $i++;
        }
        $table .= "</tbody>";
        $table .= "</table>";
        $table .= "</div>";

        return $table;

    }

    public function getReferensiWilayah(){
        $hak_akses = $this->ci->infopegawai->hakAksesModul('1464',$this->ci->session->userdata('logged_in')['user_group']);

        $sql = "SELECT KOWIL, NAWIL 
                FROM PERS_KOWIL_TBL
                ";                

        $query = $this->ci->db->query($sql);

        $i = 1;

        $table  = "<div id='_content_riwayat' class='animated fadeInUp'>";
        if ($hak_akses->act_insert == 'Y'){
           $table .= "<div class='pull-right'><button type='button' class='btn btn-primary btn-sm btn-block m-t' onClick='getForm(\"ref_wilayah\",\"tambah\");'><i class='fa fa-plus'></i> Tambah Data</button></div>";
        }
        
        $table .= "<table class='table table-striped table-bordered table-hover dataTables-example pull-left' width='99%'>";
        $table .= "<thead>";
        $table .= " <tr>
                        <th>No</th>
                        <th>Kode</th>                        
                        <th>Wilayah</th>         
                        <th>Aksi</th>
                    </tr>";
        $table .= "</thead>";
        $table .= "<tbody>";
        foreach($query->result() as $row){
            $table .= "<tr>";
                $table .= "<td width='5px'>".$i."</td>";
                $table .= "<td>".$row->KOWIL."</td>";                
                $table .= "<td>".$row->NAWIL."</td>";                

                $ubah = "";
            if ($hak_akses->act_update == 'Y'){
                $ubah = "<button type='button' class='btn btn-outline btn-xs btn-success' title='Edit' onClick='getForm(\"ref_wilayah\",\"edit\",\"".$row->KOWIL."\");'><i class='fa fa-pencil-square'></i></button> ";
            }

            // $hapus_flag = "";
            // if ($hak_akses->act_delete_flag == 'Y'){
            //     $hapus_flag = "<button type='button' class='btn btn-outline btn-xs btn-danger' title='Hapus' onClick='confirmHapusDataFlag(\"ref_wilayah\",\"".$row->KOWIL."\");'><i class='fa fa-trash'></i></button>";
            // }

            $hapus = "";
            if ($hak_akses->act_delete == 'Y'){
                $hapus = "<button type='button' class='btn btn-outline btn-xs btn-danger' title='Hapus ' onClick='confirmHapusData(\"ref_wilayah\",\"".$row->KOWIL."\");'><i class='fa fa-trash'></i></button>";
            }

                $table .= "<td >$ubah  $hapus</td>";
            $table .= "</tr>";

            $i++;
        }
        $table .= "</tbody>";
        $table .= "</table>";
        $table .= "</div>";

        return $table;

    }

    public function getReferensiKecamatan(){
        $hak_akses = $this->ci->infopegawai->hakAksesModul('1449',$this->ci->session->userdata('logged_in')['user_group']);

        $sql = "SELECT A.KOWIL,b.NAWIL, a.KOCAM, a.NACAM FROM PERS_KOCAM_TBL a
                LEFT JOIN PERS_KOWIL_TBL b ON a.KOWIL = b.KOWIL
                ";                

        $query = $this->ci->db->query($sql);

        $i = 1;

        $table  = "<div id='_content_riwayat' class='animated fadeInUp'>";                
        if ($hak_akses->act_insert == 'Y'){
           $table .= "<div class='pull-right'><button type='button' class='btn btn-primary btn-sm btn-block m-t' onClick='getForm(\"ref_kecamatan\",\"tambah\");'><i class='fa fa-plus'></i> Tambah Data</button></div>";
        }
        
        $table .= "<table class='table table-striped table-bordered table-hover dataTables-example pull-left' width='99%'>";
        $table .= "<thead>";
        $table .= " <tr>
                        <th>No</th>                        
                        <th>Kode</th>                        
                        <th>Kecamatan</th>         
                        <th>Wilayah</th> 
                        <th>Aksi</th>
                    </tr>";
        $table .= "</thead>";
        $table .= "<tbody>";
        foreach($query->result() as $row){
            $table .= "<tr>";
                $table .= "<td width='5px'>".$i."</td>";                
                $table .= "<td>".$row->KOCAM."</td>";
                $table .= "<td>".$row->NACAM."</td>";
                $table .= "<td>".$row->NAWIL."</td>";

                $ubah = "";
            if ($hak_akses->act_update == 'Y'){
                $ubah = "<button type='button' class='btn btn-outline btn-xs btn-success' title='Edit' onClick='getForm(\"ref_kecamatan\",\"edit\",\"".$row->KOCAM."\",\"".$row->KOWIL."\");'><i class='fa fa-pencil-square'></i></button>";
            }

            // $hapus_flag = "";
            // if ($hak_akses->act_delete_flag == 'Y'){
            //     $hapus_flag = "<button type='button' class='btn btn-outline btn-xs btn-danger' title='Hapus' onClick='confirmHapusDataFlag(\"ref_kecamatan\",\"".$row->KOCAM."\",\"".$row->KOWIL."\");'><i class='fa fa-trash'></i></button>";
            // }

            $hapus = "";
            if ($hak_akses->act_delete == 'Y'){
                $hapus = "<button type='button' class='btn btn-outline btn-xs btn-danger' title='Hapus ' onClick='confirmHapusData(\"ref_kecamatan\",\"".$row->KOCAM."\",\"".$row->KOWIL."\");'><i class='fa fa-trash'></i></button>";
            }

                $table .= "<td >$ubah  $hapus</td>";
            $table .= "</tr>";

            $i++;
        }
        $table .= "</tbody>";
        $table .= "</table>";
        $table .= "</div>";

        return $table;

    }

    public function getReferensiKelurahan2(){
        $hak_akses = $this->ci->infopegawai->hakAksesModul('1450',$this->ci->session->userdata('logged_in')['user_group']);

        $sql = "SELECT KEL.\"ID\",KEL.KODE AS KEL_KODE,PROV.KODE,PROV.PROPINSI,PROV.NAMA AS NM_PROV,KB.NAMA AS NM_KAB,KC.NAMA AS NM_KEC,KEL.NAMA AS KEL_NM
                FROM LOKASI PROV
                LEFT JOIN
                (
                    SELECT \"ID\",NAMA,PROPINSI,KABUPATEN_KOTA,KECAMATAN FROM LOKASI
                    WHERE KABUPATEN_KOTA <> 0
                    AND KECAMATAN = 0
                )KB ON PROV.PROPINSI = KB.PROPINSI
                LEFT JOIN
                (
                    SELECT \"ID\",NAMA,PROPINSI,KABUPATEN_KOTA,KECAMATAN FROM LOKASI
                    WHERE KECAMATAN <> 0
                    AND KELURAHAN = 0
                )KC ON PROV.PROPINSI = KC.PROPINSI AND KB.KABUPATEN_KOTA = KC.KABUPATEN_KOTA
                LEFT JOIN
                (
                    SELECT \"ID\",KODE,NAMA,PROPINSI,KABUPATEN_KOTA,KECAMATAN FROM LOKASI
                    WHERE KELURAHAN <> 0
                )KEL ON PROV.PROPINSI = KEL.PROPINSI AND KB.KABUPATEN_KOTA = KEL.KABUPATEN_KOTA AND KC.KECAMATAN = KEL.KECAMATAN
                WHERE 1=1
                AND SUBSTR(PROV.KODE, 3, 11)='.00.00.0000'
                ";
                // WHERE DELETED IS NULL

        $query = $this->ci->db->query($sql);

        // $i = 1;

        $table  = "<div id='_content_riwayat' class='animated fadeInUp'>";                
        if ($hak_akses->act_insert == 'Y'){
           $table .= "<div class='pull-right'><button type='button' class='btn btn-primary btn-sm btn-block m-t' onClick='getForm(\"ref_kecamatan\",\"tambah\");'><i class='fa fa-plus'></i> Tambah Data</button></div>";
        }
        
        $table .= "<table class='table table-striped table-bordered table-hover dataTables-example pull-left' width='99%'>";
        $table .= "<thead>";
        $table .= " <tr>
                        <th>No</th>                        
                               
                        
                    </tr>";
        $table .= "</thead>";
        $table .= "<tbody>";
        // foreach($query->result() as $row){
        //     $table .= "<tr>";
        //         $table .= "<td width='5px'>".$i."</td>";    
        //         // $table .= "<td>".$row->NAMA."</td>";
        //         // $table .= "<td>".$row->KODE."</td>";
        //     $table .= "</tr>";

            // $i++;
        // }
        $table .= "</tbody>";
        $table .= "</table>";
        $table .= "</div>";

        


        return $table;

    }

    public function getReferensiKelurahan1(){
        $hak_akses = $this->ci->infopegawai->hakAksesModul('1428',$this->ci->session->userdata('logged_in')['user_group']);

        $sql = "SELECT KEL.\"ID\",KEL.KODE AS KEL_KODE,PROV.KODE,PROV.PROPINSI,PROV.NAMA AS NM_PROV,KB.NAMA AS NM_KAB,KC.NAMA AS NM_KEC,KEL.NAMA AS KEL_NM
                FROM LOKASI PROV
                LEFT JOIN
                (
                    SELECT \"ID\",NAMA,PROPINSI,KABUPATEN_KOTA,KECAMATAN FROM LOKASI
                    WHERE KABUPATEN_KOTA <> 0
                    AND KECAMATAN = 0
                )KB ON PROV.PROPINSI = KB.PROPINSI
                LEFT JOIN
                (
                    SELECT \"ID\",NAMA,PROPINSI,KABUPATEN_KOTA,KECAMATAN FROM LOKASI
                    WHERE KECAMATAN <> 0
                    AND KELURAHAN = 0
                )KC ON PROV.PROPINSI = KC.PROPINSI AND KB.KABUPATEN_KOTA = KC.KABUPATEN_KOTA
                LEFT JOIN
                (
                    SELECT \"ID\",KODE,NAMA,PROPINSI,KABUPATEN_KOTA,KECAMATAN FROM LOKASI
                    WHERE KELURAHAN <> 0
                )KEL ON PROV.PROPINSI = KEL.PROPINSI AND KB.KABUPATEN_KOTA = KEL.KABUPATEN_KOTA AND KC.KECAMATAN = KEL.KECAMATAN
                WHERE 1=1
                AND SUBSTR(PROV.KODE, 3, 11)='.00.00.0000'
                ";             
                // WHERE DELETED IS NULL   

        $query = $this->ci->db->query($sql);

        $i = 1;

        $table  = "<div id='_content_riwayat' class='animated fadeInUp'>";                
        if ($hak_akses->act_insert == 'Y'){
           $table .= "<div class='pull-right'><button type='button' class='btn btn-primary btn-sm btn-block m-t' onClick='getForm(\"ref_kelurahan\",\"tambah\");'><i class='fa fa-plus'></i> Tambah Data</button></div>";
        }
        
        $table .= "<table class='table table-striped table-bordered table-hover dataTables-example pull-left' width='99%'>";
        $table .= "<thead>";
        $table .= " <tr>
                        <th>No</th>
                        <th>Kode</th>
                        <th>Kelurahan</th>
                        <th>Kecamatan</th>   
                        <th>Wilayah</th> 
                        <th>Provinsi</th>                                                                             
                        <th>Aksi</th>
                    </tr>";
        $table .= "</thead>";
        $table .= "<tbody>";
        foreach($query->result() as $row){
            $table .= "<tr>";
                $table .= "<td width='5px'>".$i."</td>";
                $table .= "<td>".$row->KEL_KODE."</td>";
                $table .= "<td>".$row->KEL_NM."</td>";
                $table .= "<td>".$row->NM_KEC."</td>";                
                $table .= "<td>".$row->NM_KAB."</td>"; 
                $table .= "<td>".$row->NM_PROV."</td>";                               

                $ubah = "";
            if ($hak_akses->act_update == 'Y'){
                $ubah = "<button type='button' class='btn btn-outline btn-xs btn-success' title='Edit' onClick='getForm(\"ref_kelurahan\",\"edit\",\"".$row->KEL_KODE."\",\"".$row->KEL_KODE."\",\"".$row->KEL_KODE."\");'><i class='fa fa-pencil-square'></i></button>";
            }

            // $hapus_flag = "";
            // if ($hak_akses->act_delete_flag == 'Y'){
            //     $hapus_flag = "<button type='button' class='btn btn-outline btn-xs btn-danger' title='Hapus' onClick='confirmHapusDataFlag(\"ref_kelurahan\",\"".$row->KEL_KODE."\",\"".$row->KEL_KODE."\",\"".$row->KEL_KODE."\");'><i class='fa fa-trash'></i></button>";
            // }

            $hapus = "";
            if ($hak_akses->act_delete == 'Y'){
                $hapus = "<button type='button' class='btn btn-outline btn-xs btn-danger' title='Hapus ' onClick='confirmHapusData(\"ref_kelurahan\",\"".$row->KEL_KODE."\",\"".$row->KEL_KODE."\",\"".$row->KEL_KODE."\");'><i class='fa fa-trash'></i></button>";
            }

                $table .= "<td >$ubah  $hapus</td>";
            $table .= "</tr>";

            $i++;
        }
        $table .= "</tbody>";
        $table .= "</table>";
        $table .= "</div>";

        return $table;

    }

    public function getReferensiKelurahan(){
        $hak_akses = $this->ci->infopegawai->hakAksesModul('1450',$this->ci->session->userdata('logged_in')['user_group']);
        
        $sql = "SELECT b.NAWIL, c.NACAM, a.* FROM PERS_KOKEL_TBL a
                LEFT JOIN PERS_KOWIL_TBL b ON a.KOWIL = b.KOWIL
                LEFT JOIN PERS_KOCAM_TBL c ON b.KOWIL = c.KOWIL AND a.KOCAM = c.KOCAM 
                ";                

        $query = $this->ci->db->query($sql);

        $i = 1;

        $table  = "<div id='_content_riwayat' class='animated fadeInUp'>";                
        if ($hak_akses->act_insert == 'Y'){
           $table .= "<div class='pull-right'><button type='button' class='btn btn-primary btn-sm btn-block m-t' onClick='getForm(\"ref_kelurahan\",\"tambah\");'><i class='fa fa-plus'></i> Tambah Data</button></div>";
        }
        
        $table .= "<table class='table table-striped table-bordered table-hover dataTables-example pull-left' width='99%'>";
        $table .= "<thead>";
        $table .= " <tr>
                        <th>No</th>
                        <th>Kode</th>
                        <th>Kelurahan</th>
                        <th>Kecamatan</th>   
                        <th>Wilayah</th>                                                                              
                        <th>Aksi</th>
                    </tr>";
        $table .= "</thead>";
        $table .= "<tbody>";
        foreach($query->result() as $row){
            $table .= "<tr>";
                $table .= "<td width='5px'>".$i."</td>";
                $table .= "<td>".$row->KOKEL."</td>";
                $table .= "<td>".$row->NAKEL."</td>";
                $table .= "<td>".$row->NACAM."</td>";                
                $table .= "<td>".$row->NAWIL."</td>";                                

                $ubah = "";
            if ($hak_akses->act_update == 'Y'){
                $ubah = "<button type='button' class='btn btn-outline btn-xs btn-success' title='Edit' onClick='getForm(\"ref_kelurahan\",\"edit\",\"".$row->KOKEL."\",\"".$row->KOWIL."\",\"".$row->KOCAM."\");'><i class='fa fa-pencil-square'></i></button>";
            }

            // $hapus_flag = "";
            // if ($hak_akses->act_delete_flag == 'Y'){
            //     $hapus_flag = "<button type='button' class='btn btn-outline btn-xs btn-danger' title='Hapus' onClick='confirmHapusDataFlag(\"ref_kelurahan\",\"".$row->KOKEL."\",\"".$row->KOWIL."\",\"".$row->KOCAM."\");'><i class='fa fa-trash'></i></button>";
            // }

            $hapus = "";
            if ($hak_akses->act_delete == 'Y'){
                $hapus = "<button type='button' class='btn btn-outline btn-xs btn-danger' title='Hapus ' onClick='confirmHapusData(\"ref_kelurahan\",\"".$row->KOKEL."\",\"".$row->KOWIL."\",\"".$row->KOCAM."\");'><i class='fa fa-trash'></i></button>";
            }

                $table .= "<td >$ubah  $hapus</td>";
            $table .= "</tr>";

            $i++;
        }
        $table .= "</tbody>";
        $table .= "</table>";
        $table .= "</div>";

        return $table;

    }

    public function getMasterProv($kowil=""){
        $sql = "SELECT PROPINSI,NAMA
                FROM LOKASI
                WHERE SUBSTR(KODE, 3, 11)='.00.00.0000'
                AND DELETED IS NULL
                ORDER BY PROPINSI ASC
                ";


        $query = $this->ci->db->query($sql);        

        $option  = "";
        
        foreach($query->result() as $row){
            if($kowil == $row->PROPINSI)
            {
                $option .= "<option selected value='".$row->PROPINSI."'>".$row->PROPINSI." - ".$row->NAMA."</option>";
            }
            else
            {          
                $option .= "<option value='".$row->PROPINSI."'>".$row->PROPINSI." - ".$row->NAMA."</option>";
            }
        }
        
        return $option;
    }

    public function getMasterKab($kab,$prov){
        $sql = "SELECT SUBSTR(KODE, 1, 5) AS KD,PROPINSI,KABUPATEN_KOTA,NAMA
                FROM LOKASI
                WHERE 1=1
                AND PROPINSI = '".$prov."'
                AND SUBSTR(KODE, 6, 11)='.00.0000'
                AND KABUPATEN_KOTA <> 0
                ORDER BY KABUPATEN_KOTA ASC
                ";
                // WHERE DELETED IS NULL


        $query = $this->ci->db->query($sql);        

        $option  = "";
        
        foreach($query->result() as $row){
            if($kab == $row->KABUPATEN_KOTA)
            {
                $option .= "<option selected value='".$row->KABUPATEN_KOTA."'>".$row->KABUPATEN_KOTA." - ".$row->NAMA."</option>";
            }
            else
            {          
                $option .= "<option value='".$row->KABUPATEN_KOTA."'>".$row->KABUPATEN_KOTA." - ".$row->NAMA."</option>";
            }
        }
        
        return $option;
    }

    public function getMasterKec($kec,$kab,$prov)
    {
        
        $sql = "SELECT
                    SUBSTR (KODE, 1, 8) AS KD,
                    KODE,
                    PROPINSI,
                    KABUPATEN_KOTA,
                    KECAMATAN,
                    NAMA
                FROM
                    LOKASI
                WHERE 1=1
                AND PROPINSI = '".$prov."'
                AND KABUPATEN_KOTA = '".$kab."'
                AND KECAMATAN <> 0
                AND KELURAHAN = 0
                ORDER BY
                    KECAMATAN ASC ";        
                    // WHERE DELETED IS NULL
        // echo $sql;
        $query = $this->ci->db->query($sql);        

        $option  = "";
        
        foreach($query->result() as $row){
            if($kec == $row->KECAMATAN){
                $option .= "<option selected value='".$row->KECAMATAN."'>".$row->KECAMATAN." - ".$row->NAMA."</option>";
            }else{          
                $option .= "<option value='".$row->KECAMATAN."'>".$row->KECAMATAN." - ".$row->NAMA."</option>";
            }
        }
        
        return $option;
    }

    public function getMasterKowil($kowil=""){
        $sql = "SELECT KOWIL, NAWIL FROM PERS_KOWIL_TBL
                ";


        $query = $this->ci->db->query($sql);        

        $option  = "";
        
        foreach($query->result() as $row){
            if($kowil == $row->KOWIL)
            {
                $option .= "<option selected value='".$row->KOWIL."'>".$row->KOWIL." - ".$row->NAWIL."</option>";
            }
            else
            {          
                $option .= "<option value='".$row->KOWIL."'>".$row->KOWIL." - ".$row->NAWIL."</option>";
            }
        }
        
        return $option;
    }



    public function getMasterKocam($kowil,$kocam=""){
        $sql = "SELECT KOCAM, NACAM FROM PERS_KOCAM_TBL WHERE KOWIL='".$kowil."'
                ";


        $query = $this->ci->db->query($sql);        

        $option  = "";
        
        foreach($query->result() as $row){
            if($kocam == $row->KOCAM)
            {
                $option .= "<option selected value='".$row->KOCAM."'>".$row->KOCAM." - ".$row->NACAM."</option>";
            }
            else
            {          
                $option .= "<option value='".$row->KOCAM."'>".$row->KOCAM." - ".$row->NACAM."</option>";
            }
        }
        
        return $option;
    }


    public function getReferensiAgama(){
        $hak_akses = $this->ci->infopegawai->hakAksesModul('1428',$this->ci->session->userdata('logged_in')['user_group']);

        $sql = "SELECT AGAMA, KETERANGAN 
                FROM PERS_AGAMA_RPT 
                ORDER BY AGAMA ASC
                ";
                // WHERE DELETED IS NULL

        $query = $this->ci->db->query($sql);

        $i = 1;

        $table  = "<div id='_content_riwayat' class='animated fadeInUp'>";
        if ($hak_akses->act_insert == 'Y'){
           $table .= "<div class='pull-right'><button type='button' class='btn btn-primary btn-sm btn-block m-t' onClick='getForm(\"ref_agama\",\"tambah\");'><i class='fa fa-plus'></i> Tambah Data</button></div>";
        }

        $table .= "<table class='table table-striped table-bordered table-hover dataTables-example pull-left' width='99%'>";
        $table .= "<thead>";
        $table .= " <tr>
                        <th>No</th>
                        <th>Agama</th>
                        <th>Keterangan</th>
                        <th>Aksi</th>
                    </tr>";
        $table .= "</thead>";
        $table .= "<tbody>";
        foreach($query->result() as $row){
            $table .= "<tr>";
            $table .= "<td width='5px'>".$i."</td>";
            $table .= "<td>".$row->AGAMA."</td>";
            $table .= "<td>".$row->KETERANGAN."</td>";

            $ubah = "";
            if ($hak_akses->act_update == 'Y'){
                $ubah = "<button type='button' class='btn btn-outline btn-xs btn-success' title='Edit' onClick='getForm(\"ref_agama\",\"edit\",\"".$row->AGAMA."\");'><i class='fa fa-pencil-square'></i></button>";
            }

            // $hapus_flag = "";
            // if ($hak_akses->act_delete_flag == 'Y'){
            //     $hapus_flag = "<button type='button' class='btn btn-outline btn-xs btn-danger' title='Hapus' onClick='confirmHapusDataFlag(\"ref_agama\",\"".$row->AGAMA."\",\"\",\"\");'><i class='fa fa-trash'></i></button>";
            // }

            $hapus = "";
            if ($hak_akses->act_delete == 'Y'){
                $hapus = "<button type='button' class='btn btn-outline btn-xs btn-danger' title='Hapus ' onClick='confirmHapusData(\"ref_agama\",\"".$row->AGAMA."\");'><i class='fa fa-trash'></i></button>";
            }

            $table .= "<td >$ubah  $hapus</td>";
            $table .= "</tr>";

            $i++;
        }
        $table .= "</tbody>";
        $table .= "</table>";
        $table .= "</div>";

        return $table;

    }

    public function getReferensiPersyaratan(){
        $hak_akses = $this->ci->infopegawai->hakAksesModul('1428',$this->ci->session->userdata('logged_in')['user_group']);

        $sql = "SELECT ID_SYARAT_HDR, KET_PERMOHONAN, KET_JENIS_PERMOHONAN, KET_KOJABF
                FROM PERS_SYARAT_HDR A
                LEFT JOIN PERS_REF_PERMOHONAN B ON B.ID_PERMOHONAN=A.ID_PERMOHONAN
                LEFT JOIN PERS_JENIS_PERMOHONAN C ON C.ID_JENIS_PERMOHONAN=A.ID_JENIS_PERMOHONAN
                LEFT JOIN PERS_MASTER_KOJABF D ON D.ID_KOJABF=A.ID_KOJABF
                ORDER BY KET_PERMOHONAN ASC
                ";
                // WHERE DELETED IS NULL

        $query = $this->ci->db->query($sql);

        $i = 1;

        $table  = "<div id='_content_riwayat' class='animated fadeInUp'>";
        if ($hak_akses->act_insert == 'Y'){
           $table .= "<div class='pull-right'><button type='button' class='btn btn-primary btn-sm btn-block m-t' onClick='getForm(\"ref_agama\",\"tambah\");'><i class='fa fa-plus'></i> Tambah Data</button></div>";
        }
        
        $table .= "<table class='table table-striped table-bordered table-hover dataTables-example pull-left' width='99%'>";
        $table .= "<thead>";
        $table .= " <tr>
                        <th>No</th>
                        <th>PERMOHONAN</th>
                        <th>JENIS PERMOHONAN</th>
                        <th>JABATAN</th>
                        <th>Aksi</th>
                    </tr>";
        $table .= "</thead>";
        $table .= "<tbody>";
        foreach($query->result() as $row){
            $table .= "<tr>";
            $table .= "<td width='5px'>".$i."</td>";
            $table .= "<td>".$row->KET_PERMOHONAN."</td>";
            $table .= "<td>".$row->KET_JENIS_PERMOHONAN."</td>";
            $table .= "<td>".$row->KET_KOJABF."</td>";

            $ubah = "";
            if ($hak_akses->act_update == 'Y'){
                $ubah = "<button type='button' class='btn btn-outline btn-xs btn-success' title='Edit' onClick='getForm(\"ref_syaratpermohonan\",\"edit\",\"".$row->ID_SYARAT_HDR."\");'><i class='fa fa-pencil-square'></i></button>";
            }

            // $hapus_flag = "";
            // if ($hak_akses->act_delete_flag == 'Y'){
            //     $hapus_flag = "<button type='button' class='btn btn-outline btn-xs btn-danger' title='Hapus' onClick='confirmHapusDataFlag(\"ref_syaratpermohonan\",\"".$row->ID_SYARAT_HDR."\");'><i class='fa fa-trash'></i></button>";
            // }

            $hapus = "";
            if ($hak_akses->act_delete == 'Y'){
                $hapus = "<button type='button' class='btn btn-outline btn-xs btn-danger' title='Hapus ' onClick='confirmHapusData(\"ref_syaratpermohonan\",\"".$row->ID_SYARAT_HDR."\");'><i class='fa fa-trash'></i></button>";
            }

            $table .= "<td >$ubah  $hapus</td>";
            $table .= "</tr>";

            $i++;
        }
        $table .= "</tbody>";
        $table .= "</table>";
        $table .= "</div>";

        return $table;

    }

    public function getReferensiJenSK(){
        $hak_akses = $this->ci->infopegawai->hakAksesModul('1428',$this->ci->session->userdata('logged_in')['user_group']);
        // $sql = "SELECT KOLOK, NALOKS, NALOKL, KORAS, MAKAN_INS, TAHUN, AKTIF , KODE_UNIT_SIPKD FROM PERS_LOKASI_TBL"; 
        $sql = "SELECT * 
                FROM PERS_JENSK 
                ORDER BY ID_JENSK ASC"; 
                // WHERE DELETED IS NULL       

        $query = $this->ci->db->query($sql);

        $i = 1;

        $table  = "<div id='_content_riwayat' class='animated fadeInUp'>";
        if ($hak_akses->act_insert == 'Y'){
           $table .= "<div class='pull-right'><button type='button' class='btn btn-primary btn-sm btn-block m-t' onClick='getForm(\"ref_sk\",\"tambah\");'><i class='fa fa-plus'></i> Tambah Data</button></div>";
        }
        
        $table .= "<table class='table table-striped table-bordered table-hover dataTables-example pull-left' width='99%'>";
        $table .= "<thead>";
        $table .= " <tr>
                        <th>No</th>
                        <th>Keterangan</th>
                        <th>Aksi</th>
                    </tr>";
        $table .= "</thead>";
        $table .= "<tbody>";
        foreach($query->result() as $row){
            $table .= "<tr>";
                $table .= "<td width='5px'>".$i."</td>";                    
                $table .= "<td>".$row->KETERANGAN."</td>";

                $ubah = "";
            if ($hak_akses->act_update == 'Y'){
                $ubah = "<button type='button' class='btn btn-outline btn-xs btn-success' title='Edit' onClick='getForm(\"ref_sk\",\"edit\",\"".$row->ID_JENSK."\");'><i class='fa fa-pencil-square'></i></button>";
            }

            // $hapus_flag = "";
            // if ($hak_akses->act_delete_flag == 'Y'){
            //     $hapus_flag = "<button type='button' class='btn btn-outline btn-xs btn-danger' title='Hapus' onClick='confirmHapusDataFlag(\"ref_sk\",\"".$row->ID_JENSK."\");'><i class='fa fa-trash'></i></button>";
            // }

            $hapus = "";
            if ($hak_akses->act_delete == 'Y'){
                $hapus = "<button type='button' class='btn btn-outline btn-xs btn-danger' title='Hapus ' onClick='confirmHapusData(\"ref_sk\",\"".$row->ID_JENSK."\");'><i class='fa fa-trash'></i></button>";
            }

                $table .= "<td >$ubah  $hapus</td>";
            $table .= "</tr>";

            $i++;
        }
        $table .= "</tbody>";
        $table .= "</table>";
        $table .= "</div>";

        return $table;

    }

    public function getKab($prov)
    {
        
        $sql = "SELECT SUBSTR(KODE, 1, 5) AS KD,PROPINSI,KABUPATEN_KOTA,NAMA
                FROM LOKASI
                WHERE 1=1
                AND PROPINSI = '".$prov."'
                AND SUBSTR(KODE, 6, 11)='.00.0000'
                AND KABUPATEN_KOTA <> 0
                ORDER BY KABUPATEN_KOTA ASC";  
                // WHERE DELETED IS NULL      

        $query = $this->ci->db->query($sql);        

        $option  = "";
        
        foreach($query->result() as $row){
            
                $option .= "<option value='".$row->KD."'>".$row->KABUPATEN_KOTA."-".$row->NAMA."</option>";
        }
        
        return $option;
    }

    public function getKec($prov,$kab)
    {
        
        $sql = "SELECT SUBSTR(KODE, 1, 8) AS KD,KODE,PROPINSI,KABUPATEN_KOTA,KECAMATAN,NAMA
                FROM LOKASI
                WHERE 1=1
                AND PROPINSI = '".$prov."'
                AND KECAMATAN <> 0
                AND KELURAHAN = 0000
                AND SUBSTR(KODE, 4, 2) = '".$kab."'
                ORDER BY KECAMATAN ASC";   
                // WHERE DELETED IS NULL     

        $query = $this->ci->db->query($sql);        

        $option  = "";
        
        foreach($query->result() as $row){
            
                $option .= "<option value='".$row->KD."'>".$row->KECAMATAN."-".$row->NAMA."</option>";
        }
        
        return $option;
    }


}