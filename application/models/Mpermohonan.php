<?php 

 class mpermohonan extends CI_Model {

    var $title   = '';
    var $content = '';
    var $date    = '';

    function __construct()
    {        
        parent::__construct(); 
    }

    function check_file_from_server($id_jenis_permohonan, $id_permohonan, $id_kojabf = null){
        // $sql = "SELECT ID_SYARAT, INIT_SYARAT FROM PERS_SYARAT_PERMOHONAN WHERE ID_JENIS_PERMOHONAN = {$id_jenis_permohonan} AND ID_PERMOHONAN = {$id_permohonan}";
        $sql = "SELECT A.ID_SYARAT_DTL, A.INIT_SYARAT FROM PERS_SYARAT_DTL A LEFT JOIN PERS_SYARAT_HDR B ON A.ID_SYARAT_HDR = B.ID_SYARAT_HDR WHERE B.ID_JENIS_PERMOHONAN = {$id_jenis_permohonan} AND B.ID_PERMOHONAN = {$id_permohonan} AND ID_KOJABF = {$id_kojabf}";
        // var_dump($sql);exit;
        //~$sql = "SELECT INIT_SYARAT FROM PERS_SYARAT_PERMOHONAN WHERE ID_JENIS_PERMOHONAN = 2";
        $res = $this->db->query($sql);
        return $res;
        //~return $array;
        //~var_dump($array[0]);exit;
    }
    
    function for_permohonan($id_kojabf, $permohonan, $id_jenis_permohonan){
        /*$sql = "SELECT A.ID_SYARAT_HDR, A.DASAR_HUKUM, A.MEKANISME, B.NO_SYARAT, B.KET_SYARAT, B.INIT_SYARAT FROM PERS_SYARAT_HDR A
                LEFT JOIN PERS_SYARAT_DTL B ON A.ID_SYARAT_HDR = B.ID_SYARAT_HDR
                WHERE A.ID_KOJABF = {$id_kojabf} AND A.ID_PERMOHONAN = {$permohonan} AND A.ID_JENIS_PERMOHONAN = {$id_jenis_permohonan}";*/
        //~if($type == 1){
            //~$sql = "SELECT MEKANISME FROM PERS_SYARAT_HDR WHERE ID_KOJABF = {$id_kojabf} AND ID_PERMOHONAN = {$permohonan} AND ID_JENIS_PERMOHONAN = {$id_jenis_permohonan}";
        //~}elseif($type == 2){
            //~$sql = "SELECT DASAR_HUKUM FROM PERS_SYARAT_HDR WHERE ID_KOJABF = {$id_kojabf} AND ID_PERMOHONAN = {$permohonan} AND ID_JENIS_PERMOHONAN = {$id_jenis_permohonan}";
        //~}

        if($id_kojabf <> null){
		    $sql = "SELECT A.DASAR_HUKUM, A.MEKANISME, B.KET_SYARAT, B.INIT_SYARAT FROM PERS_SYARAT_HDR A LEFT JOIN
		            PERS_SYARAT_DTL B ON A.ID_SYARAT_HDR = B.ID_SYARAT_HDR 
		            WHERE A.ID_KOJABF = {$id_kojabf} AND A.ID_PERMOHONAN = {$permohonan} AND A.ID_JENIS_PERMOHONAN = {$id_jenis_permohonan} ";
            // var_dump($sql);exit;
		    $result = $this->db->query($sql);
		    return $result->row();
        }
    }
    
    function for_tab_permohonan($id_jenis_permohonan, $permohonan, $id_kojabf){
    	if($id_kojabf <> null){
            $kopang = (int)$_SESSION['logged_in']['kopang'];
		    $sql = "SELECT A.DASAR_HUKUM, A.MEKANISME, B.KET_SYARAT, B.INIT_SYARAT FROM PERS_SYARAT_HDR A LEFT JOIN
		            PERS_SYARAT_DTL B ON A.ID_SYARAT_HDR = B.ID_SYARAT_HDR 
		            WHERE A.ID_KOJABF = {$id_kojabf} AND A.ID_PERMOHONAN = {$permohonan} AND A.ID_JENIS_PERMOHONAN = {$id_jenis_permohonan} ORDER BY B.ID_SYARAT_DTL";
            // var_dump($sql);exit;
		    $result = $this->db->query($sql);
		    $no = 1;
		    $res = "";
		    foreach($result->result() as $row){
		        $res .= "<tr>";
		        $res .= "<td>".$no++."</td>";
		        $res .= "<td>".$row->KET_SYARAT."</td>";
		        $res .= "<td>
		                    <div class='form-group'>
		                        <span class='fileUpload up".$row->INIT_SYARAT."_".$id_jenis_permohonan." btn btn-default' onClick='trigger_file_upload(&#39;".$row->INIT_SYARAT."&#39;)'>
		                            <span class='glyphicon glyphicon-upload'></span> Unggah file
		                            <input type='file' id='".$row->INIT_SYARAT."_".$id_jenis_permohonan."'/>
		                        </span>
		                        <button style='display:none' class='btn btn-warning' id='batal_batal_".$row->INIT_SYARAT."_".$id_jenis_permohonan."' onClick='hide_batal_btn(&#39;".$row->INIT_SYARAT."&#39;)'>Batal</button>
		                        
		                        <div class='progress progress-striped active ".$row->INIT_SYARAT."_".$id_jenis_permohonan."' style='display:none'>
		                            <div style='width: 0%' aria-valuemax='100' aria-valuemin='0' aria-valuenow='0' role='progressbar' class='progress-bar progress-bar-success'>
		                            </div>
		                        </div>
		                        
		                        <span id='status_".$row->INIT_SYARAT."_".$id_jenis_permohonan."'>
		                            <div class='btn-group btn-group-".$row->INIT_SYARAT."_".$id_jenis_permohonan."' style='display:none'>
		                                <a href='#' target='_blank' class='btn btn-success' id='cek_file_".$row->INIT_SYARAT."_".$id_jenis_permohonan."'>Cek file</a>
		                                <button class='btn btn-warning batal_".$row->INIT_SYARAT."_".$id_jenis_permohonan."' id='batal' onClick='showUpload(&#39;".$row->INIT_SYARAT."&#39;)'>Ubah File</button>
		                            </div>
		                        </span>
		                        <br/>
		                </td>";
		        $res .= "</tr>";
		        $res .= "<script type='text/javascript'>
		                    $('#batal_batal_".$row->INIT_SYARAT."_".$id_jenis_permohonan."').hide();
		                    $('.".$row->INIT_SYARAT."_".$id_jenis_permohonan."').hide();
		                    $('.btn-group').hide();
		                </script>'";
		    }
		    
		    $res .= "
		        <script type='text/javascript'>
		            check_file();
		        
		            $('input[type=file]').on('change',function(){
		                var init_syarat = $(this).attr('id');
		                //~console.log($(this).attr('id'));
		                //~$('#filename').show().text($(this).val());
		                var test = this.files[0];
		                if(!$(this).val()){
		                    //~console.log(this.files[0]);
		                    return false;
		                }else{
		                    if(test.size > 3000000){
		                        $(this).val('');
		                        swal('Gagal!','File tidak di boleh melebihi 3MB.','error');
		                        //~$('#filename').show().text($(this).val());
		                        return false;
		                    }else{
		                        var split_init_syarat = init_syarat.split('_');
		                        // console.log(split_init_syarat);
		                        $.ajax({
		                            url: '".base_url("index.php/permohonan/del_file")."',
		                            type: 'POST',
		                            data: {
		                                init_syarat: split_init_syarat[0]
		                            },
		                            dataType: 'json',
		                            success: function(data){
		                                if(data != 0){
		                                    swal('Gagal!', 'Terjadi error, silahkan ulangi kembali', 'error');
		                                    return false;
		                                }
		                            }
		                        })
		                        //~return false;
		                        file_validation($(this).val(), test, split_init_syarat[0]);
		                    }
		                }
		            })
		            
		            function check_file(){
                        var value_tmp = $('#ref_permohonan').val().split('@');
                        console.log(value_tmp[0]);
                        var id_kojabf = value_tmp[0];
		                var id_jenis_permohonan = $('#jenis').val();
		                var id_permohonan = $('#permohonan').val();
		                var url = '".base_url("index.php/permohonan/check_if_file_exists")."';
		                $.ajax({
		                    url: url,
		                    type: 'POST',
		                    data: {
		                        id_jenis_permohonan: id_jenis_permohonan, id_permohonan: id_permohonan, id_kojabf: id_kojabf
		                    },
		                    dataType: 'json',
		                    success: function(data){
		                        if(!data){
		                            return false;
		                        }else{
		                            $.each(data, function(i, item){
		                                var split_array = data[i].split('@');
		                                var second_split = split_array[1].split('.');
		                                $('.up' + second_split[0] + '_' + id_jenis_permohonan).css('display', 'none');
		                                $('#batal_batal_' + second_split[0] + '_' + id_jenis_permohonan).css('display', 'none');
		                                $('#status_' + second_split[0] + '_' + id_jenis_permohonan).show();
		                                $('.btn-group-' + second_split[0] + '_' + id_jenis_permohonan).show();
                                        var url = '".base_url()."';
		                                $('#cek_file_' + second_split[0] + '_' + id_jenis_permohonan).attr('href',url+split_array[0]+encodeURIComponent('@')+split_array[1]+'');
		                            })
		                        }
		                    },
		                    error: function(xhr) {                              
		                        
		                    },
		                    complete: function() {              
		                        
		                    }
		                });
		            }
		        </script>
		    ";
		    return json_encode($res);
		}
    }

    function get_spmu_pegawai(){
        $nrk = $_SESSION['logged_in']['nrk'];
        $check_user = $this->db->query("SELECT KD FROM PERS_PEGAWAI1 WHERE NRK = '{$_SESSION['logged_in']['nrk']}'")->row();
        if($check_user->KD == "S"){
            $pers_jabatan = 'PERS_JABATAN_HIST';
        }else{
            $pers_jabatan = 'PERS_JABATANF_HIST';
        }
        /*$sql = "SELECT
                    B.SPMU
                FROM
                    {$pers_jabatan} A
                LEFT JOIN PERS_KLOGAD3 B ON
                    A.KOLOK = B.KOLOK
                WHERE
                    A.NRK = '{$nrk}'
                    AND A.TMT = (
                        SELECT
                            MAX( TMT )
                        FROM
                            {$pers_jabatan}
                        WHERE NRK = '{$nrk}'
                        GROUP BY
                            NRK
                    )";*/
        $sql = "SELECT B.SPMU FROM PERS_PEGAWAI1 A LEFT JOIN PERS_KLOGAD3 B ON A.KLOGAD = B.KOLOK WHERE A.NRK = '{$nrk}'";
        $res = $this->db->query($sql)->row();
        //var_dump($res);exit;
        return $res->SPMU;
    }

    function insertMasterPermohonan($data)
    {
        /*$permohonan = $data['ID_PERMOHONAN'];
        $jenis = $data['ID_JENIS'];*/

        $permohonan = $data['permohonan'];
        $jenis = $data['jenis'];
        $nrk = $data['nrk'];
        $sop = $data['id_sop'];
        $id_kojabf = $data['id_kojabf'];
        $id_detail_sop = $data['id_detail_sop'];
        $bbs_smntr = $data['bbs_smntr'];
        $spmu_user = $data['spmu_user'];
        
        $sqlcek = "SELECT * FROM PERS_TRX_AJU WHERE NRK='".$nrk."' AND ID_PERMOHONAN = ".$permohonan." AND ID_JENIS_PERMOHONAN = ".$jenis."";
        
        $countCek = $this->db->query($sqlcek)->num_rows();

        if($countCek >=1)
        {
            // $x=0;
            // $getIdTrx = "SELECT ID_TRX FROM PERS_TRX_AJU WHERE NRK='".$nrk."' AND ID_PERMOHONAN = ".$permohonan." AND ID_JENIS_PERMOHONAN =".$jenis." AND TGL_PERMOHONAN = (SELECT MAX(TGL_PERMOHONAN) FROM PERS_TRX_AJU WHERE NRK='".$nrk."' AND ID_PERMOHONAN = ".$permohonan." AND ID_JENIS_PERMOHONAN=".$jenis.") ";
            
            // $exGIT = $this->db->query($getIdTrx)->row();
            
            // $getdetail = "SELECT * FROM PERS_DTL_TRX_AJU WHERE ID_TRX =".$exGIT->ID_TRX."";
            // $exGD = $this->db->query($getdetail);

            // //delete file di direktori
            // foreach($exGD->result() as $row)
            // {
            //     $trx = $row->ID_TRX;
            //     $sy = $row->ID_SYARAT;
            //     $file= $row->FILE_SYARAT;
            //     if ($file!=""){
            //         unlink("assets/file_permohonan/".$nrk."/".$file."");
                    
            //     }

            //     // $deleterow = "DELETE FROM PERS_DTL_TRX_AJU WHERE ID_TRX= ".$trx." AND ID_SYARAT = ".$sy."";
            //     // $exdelete = $this->db->query($deleterow);
            // }
            
            $queryKillData = "UPDATE PERS_TRX_AJU SET STATUS_APPROVAL = 3, TGL_UPDATE = SYSDATE WHERE NRK='".$nrk."' AND ID_PERMOHONAN = ".$permohonan." AND ID_JENIS_PERMOHONAN =".$jenis."";
            $exQuery = $this->db->query($queryKillData);

        }
        $sql1 = "INSERT INTO PERS_TRX_AJU(ID_TRX,NRK,TGL_PERMOHONAN,ID_PERMOHONAN,ID_JENIS_PERMOHONAN,STATUS_APPROVAL,ID_KOJABF,ID_SOP, ID, STATUS_BERJALAN, TGL_UPDATE,BBS_SMNTR, SPMU)
                 VALUES((select count(ID_TRX)+1 from PERS_TRX_AJU),'".$nrk."',SYSDATE,'".$permohonan."','".$jenis."',2,'".$id_kojabf."','".$sop."','".$id_detail_sop."', 2,SYSDATE,$bbs_smntr,'".$spmu_user."')
                ";
        // var_dump($sql1);exit;
        // echo $sql;
        $query = $this->db->query($sql1);
    }
    
    //elan gustiarti

    function setnama()
    {
        $sql="SELECT count(ID_TRX) ID_TRX FROM PERS_TRX_AJU";
        $query = $this->db->query($sql);

        return $query->row();
    }

    function insertPermohonan($syarat,$files)
    {
       // $sql2 = "INSERT INTO PERS_DETAIL_TRX_PERMOHONAN(NRK,TGL_PERMOHONAN,ID_PERMOHONAN,ID_JENIS_PERMOHONAN,ID_SYARAT,FILE_SYARAT)
       //          VALUES('$nrk',SYSDATE,'$permohonan','$jenis','$syarat','$files')";



        $sql2 = "INSERT INTO PERS_DTL_TRX_AJU(ID_TRX,ID_SYARAT,FILE_SYARAT)
                 VALUES((SELECT count(ID_TRX) IDTRX FROM PERS_TRX_AJU),'".$syarat."','".$files."')";
        // echo $sql2;
        $this->db->query($sql2);
    }     

    function cekJumlahSyarat($permohonan, $jenis)
    {
        //$sql = "SELECT COUNT(*) FROM PERS_SYARAT_PERMOHONAN WHERE ID_PERMOHONAN = ".$permohonan." AND ID_JENIS_PERMOHONAN = ".$jenis."";
        $sql =  "SELECT MAX(ID_SYARAT) FROM PERS_SYARAT_PERMOHONAN WHERE ID_PERMOHONAN = ".$permohonan." AND ID_JENIS_PERMOHONAN = ".$jenis."";
        $query = $this->db->query($sql);
        return $query->row();
    }

    function cek_fileBrankas($permohonan,$jenis,$nrk)
    {
        $sql =  "SELECT count(ID_TRX) From PERS_TRX_AJU WHERE NRK = ".$nrk." and ID_PERMOHONAN = ".$permohonan." and ID_JENIS_PERMOHONAN = ".$jenis."";
        $query = $this->db->query($sql);
        return $query->row();
    }
    
    function cekPerSyarat($permohonan,$jenis)
    {
        $sql = "SELECT ID_JENIS_PERMOHONAN,ID_SYARAT,INIT_SYARAT FROM PERS_SYARAT_PERMOHONAN WHERE ID_PERMOHONAN = ".$permohonan." AND ID_JENIS_PERMOHONAN = ".$jenis."";
        $query = $this->db->query($sql);
        return $query;
    }

    public function get_kojabf()
    {
        $sql = "SELECT * FROM PERS_MASTER_KOJABF";
        $query = $this->db->query($sql);
        $table="";
        foreach($query->result() as $row)
        {
            $table.= "<option value='".$row->ID_KOJABF."'>".$row->KET_KOJABF."</option>";
        }
            
        return $table;    
    }

     public function get_permohonan()
     {
         $sql = "SELECT * FROM PERS_REF_PERMOHONAN";
         $query = $this->db->query($sql);
         $table="";
         foreach($query->result() as $row)
         {
             $table.= "<option value='".$row->ID_PERMOHONAN."'>".$row->KET_PERMOHONAN."</option>";
         }

         return $table;
     }

     public function get_sop()
     {
        $kopang = (int)$_SESSION['logged_in']['kopang'];
        $check_user = $this->db->query("SELECT KD FROM PERS_PEGAWAI1 WHERE NRK = '{$_SESSION['logged_in']['nrk']}'")->row();
        /*if($check_user->KD == "S"){*/
            $sql = "SELECT A.ID_SOP FROM MASTER_SOP_JENJAB A LEFT JOIN PERS_MASTER_JENGOL B ON A.ID_JENJAB = B.ID_JENJAB WHERE B.KOPANG >= {$kopang} AND ROWNUM = 1";    
        /*}else{
            $sql = "SELECT A.ID_SOP FROM MASTER_SOP_JENJAB A LEFT JOIN PERS_MASTER_JENGOL B ON A.ID_JENJAB = B.ID_JENJAB WHERE B.KOPANG = {$kopang} AND ROWNUM = 1";
        }*/
        $result = $this->db->query($sql)->row();
        // if(is_null($_SESSION['logged_in']['id_sop']))
            $_SESSION['logged_in']['id_sop'] = $result->ID_SOP;
     }

     public function cek_riwayat_user()
     {
        return $this->db->query("SELECT kd FROM PERS_PEGAWAI1 WHERE NRK = '{$_SESSION['logged_in']['nrk']}'")->row();
     }

    public function get_jenis_permohonan($ID_PERMOHONAN, $new_user = null)
    {
        // var_dump($_SESSION['logged_in']['nrk']);exit;

        $sql = "SELECT * FROM PERS_JENIS_PERMOHONAN where ID_PERMOHONAN = '".$ID_PERMOHONAN."'";
        $query = $this->db->query($sql);
        $check_user = $this->db->query("SELECT KD FROM PERS_PEGAWAI1 WHERE NRK = '{$_SESSION['logged_in']['nrk']}'")->row();
        // var_dump($check_user->KD);exit;
        // $check_user = $this->db->query("SELECT kd FROM PERS_PEGAWAI1 WHERE NRK = '{$_SESSION['logged_in']['nrk']}'")->row();
        // var_dump($check_user);exit;
        $check_max_kopang = $this->db->query("SELECT MAX(KOPANG) AS MAX_KOPANG FROM PERS_PANGKAT_HIST WHERE NRK = '{$_SESSION['logged_in']['nrk']}'")->row();
        $check_min_kopang = $this->db->query("SELECT MIN(KOPANG) AS MIN_KOPANG FROM PERS_PANGKAT_HIST WHERE NRK = '{$_SESSION['logged_in']['nrk']}'")->row();
        $check_jabatanf_hist = $this->db->query("SELECT DISTINCT COUNT(*) AS jbtn FROM PERS_JABATANF_HIST WHERE NRK = '{$_SESSION['logged_in']['nrk']}'  ORDER BY TMT DESC")->row();
        $table="";
        foreach($query->result() as $row)
        {
            /*if($new_user){
                if((int)$row->ID_JENIS_PERMOHONAN != 4 && (int)$row->ID_JENIS_PERMOHONAN != 1){
                    $table.= "<option value='".$row->ID_JENIS_PERMOHONAN."' disabled>".$row->KET_JENIS_PERMOHONAN."</option>";
                }else{
                    $table.= "<option value='".$row->ID_JENIS_PERMOHONAN."'>".$row->KET_JENIS_PERMOHONAN."</option>";
                }
            }else{
                if((int)$row->ID_JENIS_PERMOHONAN != 4 && (int)$row->ID_JENIS_PERMOHONAN != 5 && (int)$row->ID_JENIS_PERMOHONAN != 6 && (int)$row->ID_JENIS_PERMOHONAN != 7 && (int)$row->ID_JENIS_PERMOHONAN != 2){
                    $table.= "<option value='".$row->ID_JENIS_PERMOHONAN."' disabled>".$row->KET_JENIS_PERMOHONAN."</option>";
                }else{
                    $table.= "<option value='".$row->ID_JENIS_PERMOHONAN."'>".$row->KET_JENIS_PERMOHONAN."</option>";
                }
            }*/
            $kd_user = str_replace(' ', '', $check_user->KD);
            if($kd_user == "S"){
                if((int)$check_jabatanf_hist->JBTN <> 0){
                    if((int)$row->ID_JENIS_PERMOHONAN == 3 || (int)$row->ID_JENIS_PERMOHONAN == 6){
                        $table.= "<option value='".$row->ID_JENIS_PERMOHONAN."'>".$row->KET_JENIS_PERMOHONAN."</option>";
                    }
                }elseif((int)$check_max_kopang->MAX_KOPANG <> (int)$check_min_kopang->MIN_KOPANG){
                    if((int)$row->ID_JENIS_PERMOHONAN == 5 || (int)$row->ID_JENIS_PERMOHONAN == 6){
                        $table.= "<option value='".$row->ID_JENIS_PERMOHONAN."'>".$row->KET_JENIS_PERMOHONAN."</option>";    
                    }
                }elseif((int)$check_max_kopang->MAX_KOPANG == (int)$check_min_kopang->MIN_KOPANG){
                    if((int)$row->ID_JENIS_PERMOHONAN == 1 || (int)$row->ID_JENIS_PERMOHONAN == 6){
                        $table.= "<option value='".$row->ID_JENIS_PERMOHONAN."'>".$row->KET_JENIS_PERMOHONAN."</option>";    
                    }
                }/*else{
                    if((int)$row->ID_JENIS_PERMOHONAN == 6){
                        $table.= "<option value='".$row->ID_JENIS_PERMOHONAN."'>".$row->KET_JENIS_PERMOHONAN."</option>";
                    }
                }*/
            }else{
                if((int)$row->ID_JENIS_PERMOHONAN <> 3 && (int)$row->ID_JENIS_PERMOHONAN <> 5 && (int)$row->ID_JENIS_PERMOHONAN <> 1 && (int)$row->ID_JENIS_PERMOHONAN <> 6)
                    $table.= "<option value='".$row->ID_JENIS_PERMOHONAN."'>".$row->KET_JENIS_PERMOHONAN."</option>";
            }
        }
        //echo $table;    
        return $table;    
    }

    public function get_jabfung()
    {
        $kopang = (int)$_SESSION['logged_in']['kopang'];
        $id_sop = (int)$_SESSION['logged_in']['id_sop'];
        $check_user = $this->db->query("SELECT kd FROM PERS_PEGAWAI1 WHERE NRK = '{$_SESSION['logged_in']['nrk']}'")->row();
        $check_max_kopang = $this->db->query("SELECT MAX(KOPANG) AS MAX_KOPANG FROM PERS_PANGKAT_HIST WHERE NRK = '{$_SESSION['logged_in']['nrk']}'")->row();
        $check_min_kopang = $this->db->query("SELECT MIN(KOPANG) AS MIN_KOPANG FROM PERS_PANGKAT_HIST WHERE NRK = '{$_SESSION['logged_in']['nrk']}'")->row();
        $check_jabatanf_hist = $this->db->query("SELECT DISTINCT COUNT(*) AS jbtn FROM PERS_JABATANF_HIST WHERE NRK = '{$_SESSION['logged_in']['nrk']}'  ORDER BY TMT DESC")->row();
        
        $kojab_now = $this->db->query("SELECT MAX(SUBSTR(KOJAB,1,5)) AS RES FROM PERS_JABATANF_HIST WHERE NRK = '{$_SESSION['logged_in']['nrk']}'")->row();
        
        $current_kojab = $kojab_now->RES;
        
        $kd_user = str_replace(' ', '', $check_user->KD);
       
        if($kd_user == "S"){
            if((int)$check_jabatanf_hist->JBTN <> 0){
                $sql = "SELECT
                        A .KOJAB,
                        A .NAJABL,
                        A .JENJAB,
                        A .GOLRU,
                        C.ID_SOP,
                        D .NAJABL AS NAJ,
                        E .GOL
                    FROM
                        PERS_MASTER_KOJABF A
                    LEFT JOIN MASTER_SOP_JENJAB C ON A .JENJAB = C.ID_JENJAB
                    LEFT JOIN PERS_KOJABF_TBL D ON A .KOJAB = D .KOJAB
                    LEFT JOIN PERS_PANGKAT_TBL E ON E .KOPANG = A .GOLRU
                    WHERE
                        A .GOLRU IN (
                            SELECT
                                KOPANG
                            FROM
                                PERS_PANGKAT_TBL_NOW
                            WHERE
                                KOPANG >= {$kopang}
                            AND ROWNUM = 1
                        )
                    AND A.KOJAB LIKE '{$current_kojab}%'
                    ORDER BY
                        A .KOJAB";    
                     //echo $sql;exit;   
            }else{
                $sql = "SELECT
                        A .KOJAB,
                        A .NAJABL,
                        A .JENJAB,
                        A .GOLRU,
                        C.ID_SOP,
                        D .NAJABL AS NAJ,
                        E .GOL
                    FROM
                        PERS_MASTER_KOJABF A
                    LEFT JOIN MASTER_SOP_JENJAB C ON A .JENJAB = C.ID_JENJAB
                    LEFT JOIN PERS_KOJABF_TBL D ON A .KOJAB = D .KOJAB
                    LEFT JOIN PERS_PANGKAT_TBL E ON E .KOPANG = A .GOLRU
                    WHERE
                        A .GOLRU IN (
                            SELECT
                                KOPANG
                            FROM
                                PERS_PANGKAT_TBL_NOW
                            WHERE
                                KOPANG = {$kopang}
                            AND ROWNUM = 1
                        )
                    AND A.KOJAB LIKE '{$current_kojab}%'
                    ORDER BY
                        A .KOJAB"; 
                      //echo $sql;exit;    
            }
        }else{
            $sql = "SELECT
                        A .KOJAB,
                        A .NAJABL,
                        A .JENJAB,
                        A .GOLRU,
                        C.ID_SOP,
                        D .NAJABL AS NAJ,
                        E .GOL
                    FROM
                        PERS_MASTER_KOJABF A
                    LEFT JOIN MASTER_SOP_JENJAB C ON A .JENJAB = C.ID_JENJAB
                    LEFT JOIN PERS_KOJABF_TBL D ON A .KOJAB = D .KOJAB
                    LEFT JOIN PERS_PANGKAT_TBL E ON E .KOPANG = A .GOLRU
                    WHERE
                        A .GOLRU IN (
                            SELECT
                                KOPANG
                            FROM
                                PERS_PANGKAT_TBL_NOW
                            WHERE
                                KOPANG > {$kopang}
                            AND ROWNUM = 1
                        )
                    AND A.KOJAB LIKE '{$current_kojab}%'
                    ORDER BY
                        A .KOJAB";  

        }    
       
        $query = $this->db->query($sql);
       
        $table="";
        
        //var_dump($query->result());
        foreach($query->result() as $row)
        {
            // if($row->KOJAB == $_SESSION['logged_in']['kojab']){
            //     $table .= "<option value='{$row->KOJAB}@{$row->ID_SOP}'>{$row->NAJ}</option>";
            // }else{
                // if($row->ID_SOP == 1){
                    $table .= "<option value='{$row->KOJAB}@{$row->ID_SOP}@{$row->GOLRU}'>{$row->NAJ} - {$row->GOL}</option>";    
                // }
            // }
        }
        
        return $table;
    }

    public function get_jabfunginpassing()
    {
        $kopang = (int)$_SESSION['logged_in']['kopang'];
        $id_sop = (int)$_SESSION['logged_in']['id_sop'];
        $check_user = $this->db->query("SELECT kd FROM PERS_PEGAWAI1 WHERE NRK = '{$_SESSION['logged_in']['nrk']}'")->row();
        $check_max_kopang = $this->db->query("SELECT MAX(KOPANG) AS MAX_KOPANG FROM PERS_PANGKAT_HIST WHERE NRK = '{$_SESSION['logged_in']['nrk']}'")->row();
        $check_min_kopang = $this->db->query("SELECT MIN(KOPANG) AS MIN_KOPANG FROM PERS_PANGKAT_HIST WHERE NRK = '{$_SESSION['logged_in']['nrk']}'")->row();
        $check_jabatanf_hist = $this->db->query("SELECT DISTINCT COUNT(*) AS jbtn FROM PERS_JABATANF_HIST WHERE NRK = '{$_SESSION['logged_in']['nrk']}'  ORDER BY TMT DESC")->row();
        
        $kojab_now = $this->db->query("SELECT MAX(SUBSTR(KOJAB,1,5)) AS RES FROM PERS_JABATANF_HIST WHERE NRK = '{$_SESSION['logged_in']['nrk']}'")->row();
        
        $current_kojab = $kojab_now->RES;
        
        $kd_user = str_replace(' ', '', $check_user->KD);
       
        
                $sql = "SELECT
                        A .KOJAB,
                        A .NAJABL,
                        A .JENJAB,
                        A .GOLRU,
                        C.ID_SOP,
                        D .NAJABL AS NAJ,
                        E .GOL
                    FROM
                        PERS_MASTER_KOJABF A
                    LEFT JOIN MASTER_SOP_JENJAB C ON A .JENJAB = C.ID_JENJAB
                    LEFT JOIN PERS_KOJABF_TBL D ON A .KOJAB = D .KOJAB
                    LEFT JOIN PERS_PANGKAT_TBL E ON E .KOPANG = A .GOLRU
                    WHERE
                        A .GOLRU IN (
                            SELECT
                                KOPANG
                            FROM
                                PERS_PANGKAT_TBL_NOW
                            WHERE
                                KOPANG >= {$kopang}
                            AND ROWNUM = 1
                        )
                    ORDER BY
                        A .KOJAB";    
            

        
       
        $query = $this->db->query($sql);
       
        $table="";
        
        //var_dump($query->result());
        foreach($query->result() as $row)
        {
            // if($row->KOJAB == $_SESSION['logged_in']['kojab']){
            //     $table .= "<option value='{$row->KOJAB}@{$row->ID_SOP}'>{$row->NAJ}</option>";
            // }else{
                // if($row->ID_SOP == 1){
                    $table .= "<option value='{$row->KOJAB}@{$row->ID_SOP}@{$row->GOLRU}'>{$row->NAJ} - {$row->GOL}</option>";    
                // }
            // }
        }
        
        return $table;
    }

    public function get_jabfungpertama()
    {
        $kopang = (int)$_SESSION['logged_in']['kopang'];
        $id_sop = (int)$_SESSION['logged_in']['id_sop'];
        $check_user = $this->db->query("SELECT kd FROM PERS_PEGAWAI1 WHERE NRK = '{$_SESSION['logged_in']['nrk']}'")->row();
        $check_max_kopang = $this->db->query("SELECT MAX(KOPANG) AS MAX_KOPANG FROM PERS_PANGKAT_HIST WHERE NRK = '{$_SESSION['logged_in']['nrk']}'")->row();
        $check_min_kopang = $this->db->query("SELECT MIN(KOPANG) AS MIN_KOPANG FROM PERS_PANGKAT_HIST WHERE NRK = '{$_SESSION['logged_in']['nrk']}'")->row();
        $check_jabatanf_hist = $this->db->query("SELECT DISTINCT COUNT(*) AS jbtn FROM PERS_JABATANF_HIST WHERE NRK = '{$_SESSION['logged_in']['nrk']}'  ORDER BY TMT DESC")->row();
        
        $kojab_now = $this->db->query("SELECT MAX(SUBSTR(KOJAB,1,5)) AS RES FROM PERS_JABATANF_HIST WHERE NRK = '{$_SESSION['logged_in']['nrk']}'")->row();
        
        $current_kojab = $kojab_now->RES;
        
        $kd_user = str_replace(' ', '', $check_user->KD);
       
        
                $sql = "SELECT
                        A .KOJAB,
                        A .NAJABL,
                        A .JENJAB,
                        A .GOLRU,
                        C.ID_SOP,
                        D .NAJABL AS NAJ,
                        E .GOL
                    FROM
                        PERS_MASTER_KOJABF A
                    LEFT JOIN MASTER_SOP_JENJAB C ON A .JENJAB = C.ID_JENJAB
                    LEFT JOIN PERS_KOJABF_TBL D ON A .KOJAB = D .KOJAB
                    LEFT JOIN PERS_PANGKAT_TBL E ON E .KOPANG = A .GOLRU
                    WHERE
                        A .GOLRU IN (
                            SELECT
                                KOPANG
                            FROM
                                PERS_PANGKAT_TBL_NOW
                            WHERE
                                KOPANG = {$kopang}
                            AND ROWNUM = 1
                        )
                    ORDER BY
                        A .KOJAB";    
            

        
       
        $query = $this->db->query($sql);
       
        $table="";
        
        //var_dump($query->result());
        foreach($query->result() as $row)
        {
            // if($row->KOJAB == $_SESSION['logged_in']['kojab']){
            //     $table .= "<option value='{$row->KOJAB}@{$row->ID_SOP}'>{$row->NAJ}</option>";
            // }else{
                // if($row->ID_SOP == 1){
                    $table .= "<option value='{$row->KOJAB}@{$row->ID_SOP}@{$row->GOLRU}'>{$row->NAJ} - {$row->GOL}</option>";    
                // }
            // }
        }
        
        return $table;
    }

    public function check_jabatanf_hist($data){
        $sql = "SELECT COUNT(NRK) AS RES FROM PERS_JABATANF_HIST WHERE NRK = {$data}";
        // var_dump($sql);exit;
        return $this->db->query($sql)->row();
    }

    public function ambil_jenjab($id_kojabf)
    {
        $sql = "SELECT A.*, B.ID_SOP
                FROM PERS_MASTER_KOJABF A
                LEFT JOIN MASTER_SOP_JENJAB B ON A.JENJAB = B.ID_JENJAB 
                WHERE A.KOJAB = '".$id_kojabf."' ";
        return $this->db->query($sql)->row();
    }

    public function detail_sop($id_sop)
    {
        $sql = "SELECT A.ID
                FROM MASTER_DETAIL_SOP A
                WHERE A.ID_SOP = '".$id_sop."' AND A.URUTAN = '1' ";
        return $this->db->query($sql)->row();
    }

    public function usia_pengangkatan($id_kojabf, $golru)
    {
        $sql = "SELECT A.*
                FROM PERS_MASTER_KOJABF A 
                WHERE A.KOJAB = '".$id_kojabf."' AND A.GOLRU = $golru";
        // var_dump($sql);exit;
        return $this->db->query($sql)->row();
    }

    public function usia_pegawai($nrk)
    {
        $sql = "SELECT A.TALHIR, FLOOR(MONTHS_BETWEEN(SYSDATE,A.TALHIR)/12) USIA
                FROM PERS_PEGAWAI1 A
                WHERE A.NRK = '".$nrk."' ";
        return $this->db->query($sql)->row();
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

   

}

?>
