<?php 

 class Minformasi extends CI_Model {

    var $title   = '';
    var $content = '';
    var $date    = '';

    function __construct()
    {        
        parent::__construct();
    }    

    function getnextval($seqname){        
        $sql = "SELECT COUNT(*) exist 
                FROM all_objects
                WHERE object_type = 'SEQUENCE'  AND lower(object_name) = lower('".$seqname."')";
        $query = $this->db->query($sql)->row();

        if($query->EXIST <= 0){
            $create = "CREATE SEQUENCE ".$seqname;
            $this->db->query($create);

            $sql = "SELECT ".$seqname.".nextval FROM dual";
            $query = $this->db->query($sql)->row();
        }else{
            $sql = "SELECT ".$seqname.".nextval FROM dual";
            $query = $this->db->query($sql)->row();
        }

        return $query->NEXTVAL;
    }

    public function cekInformasiTerbaru()
    {
        $sql = "SELECT MIN (TO_DATE (SYSDATE, 'DD-MM-YYYY') - TO_DATE (TGL_UPDATE, 'DD-MM-YYYY')) AS TGBARU
                FROM PERS_INFORMASI
                WHERE JENIS_BERITA = 1 AND STATUS_BERITA = 1";
        $query = $this->db->query($sql)->row();

        return $query;
    }

    public function cekBeritaTerbaru()
    {
        $sql = "SELECT MIN (TO_DATE (SYSDATE, 'DD-MM-YYYY') - TO_DATE (TGL_UPDATE, 'DD-MM-YYYY')) AS TGBARU
                FROM PERS_INFORMASI
                WHERE JENIS_BERITA = 2 AND STATUS_BERITA = 1";
        $query = $this->db->query($sql)->row();

        return $query;
    }

    public function cekBanner()
    {
        $sql = "SELECT * from 
                (
                    select * from PERS_INFORMASI where JENIS_BERITA = 3 and STATUS_BERITA = 1 order by TGL_UPDATE desc
                ) where ROWNUM = 1";
        $query = $this->db->query($sql);
        $num = $query->num_rows();

        return $num;
    }
    public function showLastBanner()
    {
        $sql = "SELECT * from 
                (
                    select * from PERS_INFORMASI where JENIS_BERITA = 3 and STATUS_BERITA = 1 order by TGL_UPDATE desc
                ) where ROWNUM = 1";
        $query = $this->db->query($sql)->row();
        return $query;
    }

    public function getInformasi($id=""){

        $sql = "SELECT
                    ID,
                    BERITA,
                    USER_ID,
                    TERM,
                    TO_CHAR (
                        TGL_UPDATE,
                        'DD-MON-YY HH24:MI:SS'
                    ) TGL_UPDATE,
                    TGL_UPDATE AS TGSYSTEM,
                    STATUS_BERITA
                FROM
                    PERS_INFORMASI_GAJI
                WHERE
                    JENIS_BERITA = 1
                ORDER BY
                    TGSYSTEM DESC";        

        $query = $this->db->query($sql);

        $i = 1;

        $table  = "<div id='_content_riwayat' class='animated fadeInUp'>";
        $table .= "<div class='pull-right'><button type='button' class='btn btn-primary btn-sm btn-block m-t' onClick='getForm(\"ref_informasi\",\"tambah\");'><i class='fa fa-plus'></i> Tambah Data</button></div>";
        $table .= "<table class='table table-striped table-bordered table-hover dataTables-example pull-left' width='99%'>";
        $table .= "<thead>";
        $table .= " <tr>
                        <th>No</th>
                        <th>Berita</th>
                        <th>User Id</th>                        
                        <th>Tanggal Update</th>
                        <th>Status Berita</th>
                        <th>Aksi</th>
                    </tr>";
        $table .= "</thead>";
        $table .= "<tbody>";
        foreach($query->result() as $row){
            $table .= "<tr>";
                $table .= "<td width='5px'>".$i."</td>";                    
                $table .= "<td>".$row->BERITA."</td>";
                $table .= "<td>".$row->USER_ID."</td>";
                $table .= "<td>".$row->TGL_UPDATE."</td>";
                    if($row->STATUS_BERITA == 1) {$aktif = 'Aktif';}else{$aktif = 'Tidak Aktif';}
                $table .= "<td>".$aktif."</td>";
                $table .= "<td >
                                <button type='button' class='btn btn-outline btn-xs btn-success' title='Edit' onClick='getForm(\"ref_informasi\",\"edit\",".$row->ID.");'><i class='fa fa-pencil-square'></i></button> 
                                <button type='button' class='btn btn-outline btn-xs btn-danger' title='Hapus' onClick='confirmHapusData(\"info\",".$row->ID.");'><i class='fa fa-trash'></i></button>
                            </td>";
            $table .= "</tr>";

            $i++;
        }
        $table .= "</tbody>";
        $table .= "</table>";
        $table .= "</div>";

        return $table;

    }

    public function getNews($id=""){

        $sql = "SELECT
                    ID,
                    BERITA,
                    USER_ID,
                    TERM,
                    TO_CHAR (
                        TGL_UPDATE,
                        'DD-MON-YY HH24:MI:SS'
                    ) TGL_UPDATE,
                    TGL_UPDATE AS TGSYSTEM,
                    STATUS_BERITA
                FROM
                    PERS_INFORMASI_GAJI
                WHERE
                    JENIS_BERITA = 2
                ORDER BY
                    TGSYSTEM DESC";

        $query = $this->db->query($sql);

        $i = 1;

        $table  = "<div id='_content_riwayat' class='animated fadeInUp'>";
        $table .= "<div class='pull-right'><button type='button' class='btn btn-primary btn-sm btn-block m-t' onClick='getForm(\"ref_news\",\"tambah\");'><i class='fa fa-plus'></i> Tambah Data</button></div>";
        $table .= "<table class='table table-striped table-bordered table-hover dataTables-example pull-left' width='99%'>";
        $table .= "<thead>";
        $table .= " <tr>
                        <th>No</th>
                        <th>Berita</th>
                        <th>User Id</th>                        
                        <th>Tanggal Update</th>
                        <th>Status Berita</th>
                        <th>Aksi</th>
                    </tr>";
        $table .= "</thead>";
        $table .= "<tbody>";
        foreach($query->result() as $row){
            $table .= "<tr>";
                $table .= "<td width='5px'>".$i."</td>";                    
                $table .= "<td>".$row->BERITA."</td>";
                $table .= "<td>".$row->USER_ID."</td>";
                $table .= "<td>".$row->TGL_UPDATE."</td>";
                    if($row->STATUS_BERITA == 1) {$aktif = 'Aktif';}else{$aktif = 'Tidak Aktif';}
                $table .= "<td>".$aktif."</td>";
                $table .= "<td >
                                <button type='button' class='btn btn-outline btn-xs btn-success' title='Edit' onClick='getForm(\"ref_news\",\"edit\",".$row->ID.");'><i class='fa fa-pencil-square'></i></button> 
                                <button type='button' class='btn btn-outline btn-xs btn-danger' title='Hapus' onClick='confirmHapusData(\"news\",".$row->ID.");'><i class='fa fa-trash'></i></button>
                            </td>";
            $table .= "</tr>";

            $i++;
        }
        $table .= "</tbody>";
        $table .= "</table>";
        $table .= "</div>";

        return $table;

    }

    public function getBanner($id=""){

        $sql = "SELECT
                    ID,
                    BERITA,
                    USER_ID,
                    TERM,
                    TO_CHAR (
                        TGL_UPDATE,
                        'DD-MON-YY HH24:MI:SS'
                    ) TGL_UPDATE,
                    TGL_UPDATE AS TGSYSTEM,
                    STATUS_BERITA
                FROM
                    PERS_INFORMASI_GAJI
                WHERE
                    JENIS_BERITA = 3
                ORDER BY
                    TGSYSTEM DESC";

        $query = $this->db->query($sql);

        $i = 1;

        $table  = "<div id='_content_riwayat' class='animated fadeInUp'>";
        $table .= "<div class='pull-right'><button type='button' class='btn btn-primary btn-sm btn-block m-t' onClick='getForm(\"ref_banner\",\"tambah\");'><i class='fa fa-plus'></i> Tambah Data</button></div>";
        $table .= "<table class='table table-striped table-bordered table-hover dataTables-example pull-left' width='99%'>";
        $table .= "<thead>";
        $table .= " <tr>
                        <th>No</th>
                        <th>Berita</th>
                        <th>User Id</th>                        
                        <th>Tanggal Update</th>
                        <th>Status Berita</th>
                        <th>Aksi</th>
                    </tr>";
        $table .= "</thead>";
        $table .= "<tbody>";
        foreach($query->result() as $row){
            $table .= "<tr>";
                $table .= "<td width='5px'>".$i."</td>";                    
                $table .= "<td>".$row->BERITA."</td>";
                $table .= "<td>".$row->USER_ID."</td>";
                $table .= "<td>".$row->TGL_UPDATE."</td>";
                    if($row->STATUS_BERITA == 1) {$aktif = 'Aktif';}else{$aktif = 'Tidak Aktif';}
                $table .= "<td>".$aktif."</td>";
                $table .= "<td >
                                <button type='button' class='btn btn-outline btn-xs btn-success' title='Edit' onClick='getForm(\"ref_banner\",\"edit\",".$row->ID.");'><i class='fa fa-pencil-square'></i></button> 
                                <button type='button' class='btn btn-outline btn-xs btn-danger' title='Hapus' onClick='confirmHapusData(\"banner\",".$row->ID.");'><i class='fa fa-trash'></i></button>
                            </td>";
            $table .= "</tr>";

            $i++;
        }
        $table .= "</tbody>";
        $table .= "</table>";
        $table .= "</div>";

        return $table;

    }
    
    function getDataInfo($id1){
        $sql = "SELECT ID, BERITA, USER_ID, TERM, TGL_UPDATE, STATUS_BERITA FROM PERS_INFORMASI_GAJI WHERE JENIS_BERITA = 1 AND ID = {$id1}";        

        $query = $this->db->query($sql)->row();            

        return $query;
    }
    
    function getDataNews($id1){
        $sql = "SELECT ID, BERITA, USER_ID, TERM, TO_CHAR(TGL_UPDATE,'DD-MON-YY HH24:MI')  TGL_UPDATE, STATUS_BERITA FROM PERS_INFORMASI_GAJI WHERE JENIS_BERITA = 2 AND ID = {$id1}";        

        $query = $this->db->query($sql)->row();            

        return $query;
    }

    function getDataBanner($id1){
        $sql = "SELECT ID, BERITA, USER_ID, TERM, TGL_UPDATE, STATUS_BERITA FROM PERS_INFORMASI_GAJI WHERE JENIS_BERITA = 3 AND ID = {$id1}";        

        $query = $this->db->query($sql)->row();            

        return $query;
    }
    
    function getPengumumanBaru($jns_berita){
        
        $sql ="SELECT * FROM (
                    SELECT
                        ID,
                        BERITA,
                        USER_ID,
                        TERM,
                        TO_CHAR (
                            TGL_UPDATE,
                            'DD-MON-YY HH24:MI'
                        ) TGL_UPDATE,
                        TGL_UPDATE AS TGSYSTEM,
                        STATUS_BERITA, FLOOR(SYSDATE-TGL_UPDATE) AS HARI
                    FROM
                        PERS_INFORMASI_GAJI
                    WHERE
                        STATUS_BERITA = 1
                    AND JENIS_BERITA = {$jns_berita}
                    ORDER BY
                        TGSYSTEM DESC ) WHERE HARI<= 7";   
     
        $query = $this->db->query($sql);//->result();            

        return $query;
    }
    function getPengumuman($jns_berita){
        //$sql = "SELECT ID, BERITA, USER_ID, TERM, TO_CHAR(TGL_UPDATE,'DD-MON-YY HH24:MI')  TGL_UPDATE, TGL_UPDATE AS TGSYSTEM, STATUS_BERITA FROM PERS_INFORMASI WHERE STATUS_BERITA = 1 AND JENIS_BERITA = {$jns_berita} ORDER BY TGSYSTEM DESC";     
        // $sql ="SELECT * FROM (
        //             SELECT
        //                 ID,
        //                 BERITA,
        //                 USER_ID,
        //                 TERM,
        //                 TO_CHAR (
        //                     TGL_UPDATE,
        //                     'DD-MON-YY HH24:MI'
        //                 ) TGL_UPDATE,
        //                 TGL_UPDATE AS TGSYSTEM,
        //                 STATUS_BERITA, FLOOR(SYSDATE-TGL_UPDATE) AS HARI
        //             FROM
        //                 PERS_INFORMASI_GAJI
        //             WHERE
        //                 STATUS_BERITA = 1
        //             AND JENIS_BERITA = {$jns_berita}
        //             ORDER BY
        //                 TGSYSTEM DESC ) WHERE HARI> 7";


        $sql ="SELECT * FROM (
                    SELECT
                        ROWNUM as NO,
                        ID,
                        BERITA,
                        USER_ID,
                        TERM,
                        TO_CHAR (
                            TGL_UPDATE,
                            'DD-MON-YY HH24:MI'
                        ) TGL_UPDATE,
                        TGL_UPDATE AS TGSYSTEM,
                        STATUS_BERITA, FLOOR(SYSDATE-TGL_UPDATE) AS HARI
                    FROM
                        PERS_INFORMASI_GAJI
                    WHERE
                        STATUS_BERITA = 1
                    AND JENIS_BERITA = {$jns_berita}
                    ORDER BY
                        ID DESC
                    )
                WHERE ROWNUM <= 10";   
        // echo $sql;exit();
        $query = $this->db->query($sql);//->result();            

        return $query;
    }
    
    function simpan_info($data){
        // $namafile = $this->input->post('NAMAFILE');
        $informasi = $this->input->post('informasi');
        $urutan = $this->input->post('urutan');
        $status_informasi = $this->input->post('status');
        $user_id = $data['id_user'];
        $term=$this->input->ip_address();

        $sql1 = "SELECT COUNT(*) CT FROM PERS_INFORMASI_GAJI";
        $res = $this->db->query($sql1)->row();

        $sql2 = "SELECT max(ID)+1 NEWID FROM PERS_INFORMASI_GAJI";
        $res2 = $this->db->query($sql2)->row();
        $sql = '';
        if($res->CT == "0"){
            // $sql = "INSERT INTO PERS_INFORMASI_GAJI(ID,TGL_UPDATE,BERITA,USER_ID,TERM,JENIS_BERITA,STATUS_BERITA,FILEINFO) 
            //         VALUES (".$res->CT." + 1, SYSDATE, '".$informasi."','".$user_id."','".$term."', 1, '".$status_informasi."', '$namafile')";
            $sql = "INSERT INTO PERS_INFORMASI_GAJI(ID,TGL_UPDATE,BERITA,USER_ID,TERM,JENIS_BERITA,STATUS_BERITA) 
                    VALUES (".$res->CT." + 1, SYSDATE, '".$informasi."','".$user_id."','".$term."', 1, '".$status_informasi."')"; 
        }else{
            $sql = "INSERT INTO PERS_INFORMASI_GAJI(ID,TGL_UPDATE,BERITA,USER_ID,TERM,JENIS_BERITA,STATUS_BERITA) 
                    VALUES (".$res2->NEWID.", SYSDATE, '".$informasi."','".$user_id."','".$term."', 1, '".$status_informasi."')"; 
        }
        //var_dump($sql);
        $response = $this->db->query($sql);
        return $response;
    }
    
    function update_info($data){
        $informasi = $this->input->post('informasi');
        // $namafile = $this->input->post('NAMAFILE');
        $urutan = $this->input->post('urutan');
        $id_informasi = $this->input->post('id_informasi');
        $status = $this->input->post('status');
        $user_id = $data['id_user'];
        $term=$this->input->ip_address();

        
        $sql = "UPDATE PERS_INFORMASI_GAJI SET TGL_UPDATE = SYSDATE, BERITA='".$informasi."', TERM='".$term."', USER_ID = '".$user_id."', STATUS_BERITA='".$status."' WHERE ID = '".$id_informasi."'"; 
        //var_dump($sql);exit;
        $response = $this->db->query($sql);
        return $response;
    }
    
    function delete_info($data){
        //$id_informasi = $this->input->post('key');

        $user_id = $data['user_id'];

        $sql = "DELETE FROM PERS_INFORMASI_GAJI WHERE ID = ".$data.""; 
        $response = $this->db->query($sql);
        return $response;
    }
    
    
    function simpan_news($data){
        $news = $this->input->post('news');
        $status = $this->input->post('status');
        $user_id = $data['user_id'];
        $term=$this->input->ip_address();

        $sql1 = "SELECT COUNT(*) CT FROM PERS_INFORMASI_GAJI";
        $res = $this->db->query($sql1)->row();

        $sql2 = "SELECT max(ID)+1 NEWID FROM PERS_INFORMASI_GAJI";
        $res2 = $this->db->query($sql2)->row();
        $sql = '';
        if($res->CT == "0"){
            $sql = "INSERT INTO PERS_INFORMASI_GAJI(ID,TGL_UPDATE,BERITA,USER_ID,TERM,JENIS_BERITA,STATUS_BERITA) 
                    VALUES (".$res->CT." + 1, SYSDATE, '".$news."','".$user_id."','".$term."', 2, '".$status."')"; 
        }else{
            $sql = "INSERT INTO PERS_INFORMASI_GAJI(ID,TGL_UPDATE,BERITA,USER_ID,TERM,JENIS_BERITA,STATUS_BERITA) 
                    VALUES (".$res2->NEWID.", SYSDATE, '".$news."','".$user_id."','".$term."', 2, '".$status."')"; 
        }
        //var_dump($sql);
        $response = $this->db->query($sql);
        return $response;
    }
    
    function update_news($data){
        $news = $this->input->post('news');
        $id_news = $this->input->post('id_news');
        $status = $this->input->post('status');
        $user_id = $data['user_id'];
        $term=$this->input->ip_address();

        
        $sql = "UPDATE PERS_INFORMASI_GAJI SET TGL_UPDATE = SYSDATE, BERITA='".$news."', TERM='".$term."', USER_ID = '".$user_id."', STATUS_BERITA='".$status."' WHERE ID = '".$id_news."'"; 
        //var_dump($sql);exit;
        $response = $this->db->query($sql);
        return $response;
    }
    
    function delete_news($data){
        //$id_informasi = $this->input->post('key');

        $user_id = $data['user_id'];

        $sql = "DELETE FROM PERS_INFORMASI_GAJI WHERE ID = ".$data.""; 
        $response = $this->db->query($sql);
        return $response;
    }
    
    public function generatenewID()
    {
         $sql = "SELECT MAX(ID)+1 NEWID FROM PERS_INFORMASI_GAJI";
         $query = $this->db->query($sql);

         return $query->row();
    }


    function simpan_banner($data){
        if($this->input->post('informasi')=="")
        {
            if($this->input->post('NAMAFILE') == "")
            {
                $informasi="";
            }
            else
            {
                $informasi = $this->input->post('NAMAFILE');
            }
        }
        else
        {
            $informasi = $this->input->post('informasi');    
        }
        
        
        
        $urutan = $this->input->post('urutan');
        $status_informasi = $this->input->post('status');
        $user_id = $data['user_id'];
        $term=$this->input->ip_address();

        $sql1 = "SELECT COUNT(*) CT FROM PERS_INFORMASI";
        $res = $this->db->query($sql1)->row();

        $sql2 = "SELECT max(ID)+1 NEWID FROM PERS_INFORMASI";
        $res2 = $this->db->query($sql2)->row();
        $sql = '';
        if($res->CT == "0"){
            $sql = "INSERT INTO PERS_INFORMASI_GAJI(ID,TGL_UPDATE,BERITA,USER_ID,TERM,JENIS_BERITA,STATUS_BERITA) 
                    VALUES (".$res->CT." + 1, SYSDATE, '".$informasi."','".$user_id."','".$term."', 3, '".$status_informasi."')"; 
        }else{
            $sql = "INSERT INTO PERS_INFORMASI_GAJI(ID,TGL_UPDATE,BERITA,USER_ID,TERM,JENIS_BERITA,STATUS_BERITA) 
                    VALUES (".$res2->NEWID." , SYSDATE, '".$informasi."','".$user_id."','".$term."', 3, '".$status_informasi."')"; 
        }
        //die($sql);
        $response = $this->db->query($sql);
        return $response;
    }

     function update_banner($data){
        if($this->input->post('informasi')=="")
        {
            if($this->input->post('NAMAFILE') == "")
            {
                $informasi="";
            }
            else
            {
                $informasi = $this->input->post('NAMAFILE');
            }
        }
        else
        {
            $informasi = $this->input->post('informasi');    
        }
        
        $urutan = $this->input->post('urutan');
        $id_informasi = $this->input->post('id_banner');
        $status = $this->input->post('status');
        $user_id = $data['user_id'];
        $term=$this->input->ip_address();

        
        $sql = "UPDATE PERS_INFORMASI_GAJI SET TGL_UPDATE = SYSDATE, BERITA='".$informasi."', TERM='".$term."', USER_ID = '".$user_id."', STATUS_BERITA='".$status."' WHERE ID = '".$id_informasi."'"; 
        //var_dump($sql);exit;
        $response = $this->db->query($sql);
        return $response;
    }
    
    function delete_banner($data){
        //$id_informasi = $this->input->post('key');

        $user_id = $data['user_id'];

        $sql = "DELETE FROM PERS_INFORMASI_GAJI WHERE ID = ".$data.""; 
        $response = $this->db->query($sql);
        return $response;
    }
}
