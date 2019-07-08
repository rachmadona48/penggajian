<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class Infopegawai {

	private $ci;
	private $ekin;

	function __construct()
    {
        $this->ci =& get_instance();
        $this->ci->load->database(); 
        

        $this->ekin = $this->ci->load->database('ekin234', TRUE);
        $this->ekine = $this->ci->load->database('ekinerja', TRUE);
    }

    function getDataUser($id)
    {
        $sql="SELECT * FROM \"master_user\" WHERE \"user_id\"='".$id."'  ";
        $query = $this->ci->db->query($sql)->row();
        return $query;
    }

    function getMenu($id)
    {
        $sql="SELECT * FROM \"menu_master\" WHERE \"id_menu\"='".$id."'  ";
        $query = $this->ci->db->query($sql);
        return $query;
    }

    function getDataMenu($id,$user_group_id,$jenis)
    {
        $sql = "SELECT a.\"menu_access_id\",a.\"menu_id\",a.\"user_group_id\",b.\"nama_menu\", b.\"link_menu\", b.\"status_aktif\", b.\"alias\", b.\"icon\"
                FROM \"menu_access_user\" a
                LEFT JOIN \"menu_master\" b ON a.\"menu_id\" = b.\"id_menu\" 
                WHERE a.\"menu_id\" = '".$id."' AND b.\"status_aktif\"='Y' AND a.\"act_view\"='Y' AND a.\"user_group_id\" = '".$user_group_id."' AND b.\"jenis_menu\"='".$jenis."' ";
                // echo $sql;
        $query = $this->ci->db->query($sql);
        return $query;
    }

    function getListMenu()
    {                
        $sql = "SELECT \"id_list\", \"nama_list\", \"aktif_list\", \"non_aktif_list\" FROM \"menu_list\" WHERE ROWNUM <= 1";        
        $query = $this->ci->db->query($sql);
        return $query->result();
    } 
    

    public function initialMenu($user_group_id,$alias,$jenis)
    {
       
        
        $listmenu = $this->getListMenu();
        $datam['listmenu']=$listmenu;
                
                 
                    $itemAktifTemp = array(); $itemNonAktifTemp = array();
                    foreach ($listmenu as $key => $value)
                    {
                        $itemAktifTemp = json_decode($value->aktif_list);
                        $itemNonAktifTemp = json_decode($value->non_aktif_list);
                    }

                    
                    $html='';
                        if(count($itemAktifTemp) > 0)
                        {   
                            $activeMenu='';
                            $stat='';
                            foreach ($itemAktifTemp as $key => $value) 
                            { //menu lvl 1
                                //$menu = $this->getMenu($value->id)->row();
                                $menu = $this->getDataMenu($value->id,$user_group_id,$jenis)->row();

                                if (!$menu) {
                                    continue;
                                }
                                
                               // $activeMenu=$menu->id_menu;                                
                                if($menu->alias == $alias)
                                {
                                    $stat="active";
                                }
                                else
                                {
                                    $stat="deactive";
                                }

                                if($menu->icon == ''){
                                    $icon = 'fa-th-large';
                                } else {
                                    $icon = $menu->icon;
                                }
                                /*$html.='<li class="';
                                    if($value->id==$activeMenu)
                                    { echo "active"; } 
                                $html.= '">*/
                                

                                $html.='<li class="'.$stat.'">';
                                $html.= '

                                    <a href="'.site_url($menu->link_menu).'"><i class="fa '.$icon.'"></i>
                                     <span class="nav-label">'.$menu->nama_menu.'</span><span class="fa arrow"></span></a>';
   
                                    if(isset($value->children))
                                    {
                                $html.='<ul class="nav nav-second-level">';
                                        
                                        foreach ($value->children as $key2 => $value2) 
                                        { //menu lvl 2                        
                                            $menu2 = $this->getDataMenu($value2->id,$user_group_id,$jenis)->row(); 

                                            if (!$menu2) {
                                                continue;
                                            }
                                                
                                $html.='<li  class="';
                                            
                                $html.= '">
                                        <a href="'.site_url($menu2->link_menu).'"> <span class="nav-label">'.$menu2->nama_menu.'</span><span class="fa arrow"></span></a>';

                                            if(isset($value2->children))
                                            {
                                $html.='<ul class="nav nav-second-level">';
                                                foreach ($value2->children as $key3 => $value3) 
                                                { //menu lvl 3
                                                $menu3 = $this->getDataMenu($value3->id,$user_group_id,$jenis)->row();

                                                if (!$menu3) {
                                                    continue;
                                                }

                                $html.='<li class="';                                                
                                                
                                $html.='<a href="'.site_url($menu3->link_menu).'"></i> <span class="nav-label">'.$menu3->nama_menu.'></span><span class="fa arrow"></span></a>
                                        </li>';
                                                } 
                                $html.= '</ul>';
                                            } 
                                $html.='</li>';
                                        }
                            $html.='</ul>';
                                    }
                              
                            $html.=    '</li>';
                            }

                        }
                        
                    return $html;
                    
    }

    public function getMenuAccessBy($user_group_id,$menu_id)
    {
        $sql="  SELECT \"menu_id\",\"act_insert\",\"act_update\",\"act_delete\",\"act_detail\",\"user_group_id\" 
                FROM \"menu_access_user\"
                WHERE \"user_group_id\" = '".$user_group_id."' and \"menu_id\"=".$menu_id."";
        $query = $this->ci->db->query($sql);
        return $query->row();        
    }

    public function getRiwayatJabatanStruktural($nrk,$ug){
        
        $access['mnac'] = $this->getMenuAccessBy($ug,301);
        $accIns=$access['mnac']->act_insert;
        $accUpd=$access['mnac']->act_update;
        $accDel=$access['mnac']->act_delete;
       

    	$sql = "SELECT a.NRK, to_char(a.TMT, 'YYYY-MM-DD') TMT, a.NOSK, to_char(a.TGSK, 'YYYY-MM-DD') TGSK, a.KOLOK, b.NALOKL, a.KOJAB, c.NAJABL, a.USER_ID, to_char(a.TG_UPD, 'YYYY-MM-DD HH:MM:SS') TG_UPD, a.TERM, a.STATUS 
    			FROM PERS_JABATAN_HIST a
				LEFT JOIN PERS_LOKASI_TBL b ON a.KOLOK = b.KOLOK
				LEFT JOIN PERS_KOJAB_TBL c ON a.KOJAB = c.KOJAB AND a.KOLOK = c.KOLOK
				WHERE a.NRK = '".$nrk."' 
				ORDER BY a.TMT DESC, a.KOLOK, a.KOJAB";

    	$query = $this->ci->db->query($sql);    	

    	$i = 1;

        $table  = "<div id='_content_riwayat' class='animated fadeInUp'>";
        if($accIns == 'Y') { 
        $table .= "<div class='pull-right'><button type='button' class='btn btn-primary btn-sm btn-block m-t' onClick='getForm(\"jabatan_hist\",\"tambah\");'><i class='fa fa-plus'></i> Tambah Data</button></div>";
    	 } 
        $table .= "<table class='table table-striped table-bordered table-hover dataTables-example' width='99%'>";
    	$table .= "<thead>";
    	$table .= "	<tr>
                  		<th>No</th><th>TMT</th><th>No. SK</th><th>Tgl. SK</th><th>Lokasi</th><th>Jabatan</th><th>Status</th><th>Aksi</th>
                    </tr>";
    	$table .= "</thead>";
    	$table .= "<tbody>";
    	foreach($query->result() as $row){
    		$table .= "<tr>";
    			$table .= "<td width='5px'>".$i."</td>";
    				$tmt = date('d M Y', strtotime($row->TMT));
    			$table .= "<td width='85px'>".$tmt."</td>";
                $table .= "<td>".$row->NOSK."</td>";
                    $tgsk = date('d M Y', strtotime($row->TGSK));
                $table .= "<td width='85px'>".$tgsk."</td>";
    			$table .= "<td>".$row->NALOKL."<br><strong><small class='text-success'>(".$row->KOLOK.")</small></strong></td>";
    			$table .= "<td>".$row->NAJABL."<br><strong><small class='text-success'>(".$row->KOJAB.")</small></strong></td>";
                    if($row->STATUS == 0){
                        $status = "Aktif";
                    }else{
                        $status = "Tidak Aktif";
                    }
                $table .= "<td>".$status."</td>";
                $table .= "<td >";
                    if($accUpd == 'Y'){
                $table.= "<button type='button' class='btn btn-outline btn-xs btn-success' title='Edit' onClick='getForm(\"jabatan_hist\",\"update\",\"".$row->NRK."\",\"".date('d-m-Y', strtotime($row->TMT))."\",\"".$row->KOLOK."\",\"".$row->KOJAB."\");'><i class='fa fa-pencil-square'></i></button> &nbsp;";
                    }
                    if($accDel == 'Y'){                                
                $table .="<button type='button' class='btn btn-outline btn-xs btn-danger' title='Hapus' onClick='confirmHapusData(\"jabatan_hist\",\"".$row->NRK."\",\"".date('d-m-Y', strtotime($row->TMT))."\",\"".$row->KOLOK."\",\"".$row->KOJAB."\");'><i class='fa fa-trash'></i></button>";
                    }
                $table.="</td>";
                              		    			
    		$table .= "</tr>";
            $i++;
        }   	
    	$table .= "</tbody>";
    	$table .= "</table>";
        $table .= "</div>";

    	return $table;
    }

    public function getRiwayatJabatanFungsional($nrk,$ug){
        $access['mnac'] = $this->getMenuAccessBy($ug,302);
        $accIns=$access['mnac']->act_insert;
        $accUpd=$access['mnac']->act_update;
        $accDel=$access['mnac']->act_delete;

    	$sql = "SELECT a.NRK, to_char(a.TMT, 'YYYY-MM-DD') TMT, a.NOSK, to_char(a.TGSK, 'YYYY-MM-DD') TGSK, a.KOLOK, b.NALOKL, a.KOJAB, c.NAJABL, a.USER_ID, to_char(a.TG_UPD, 'YYYY-MM-DD HH:MM:SS') TG_UPD, a.TERM, a.STATUS 
				FROM PERS_JABATANF_HIST a
				LEFT JOIN PERS_LOKASI_TBL b ON a.KOLOK = b.KOLOK
				LEFT JOIN PERS_KOJABF_TBL c ON a.KOJAB = c.KOJAB 
				WHERE a.NRK = '".$nrk."'
				ORDER BY a.TMT DESC, a.KOLOK, a.KOJAB";

    	$query = $this->ci->db->query($sql);    	

    	$i = 1;

        $table  = "<div id='_content_riwayat' class='animated fadeInUp'>";
        if($accIns == 'Y'){
        $table .= "<div class='pull-right'><button type='button' class='btn btn-primary btn-sm btn-block m-t' onClick='getForm(\"jabatanf_hist\",\"tambah\");'><i class='fa fa-plus'></i> Tambah Data</button></div>";
    	}
        $table .= "<table class='table table-striped table-bordered table-hover dataTables-example' width='99%'>";
    	$table .= "<thead>";
    	$table .= "    <tr>
                        <th>No</th><th>TMT</th><th>No. SK</th><th>Tgl. SK</th><th>Lokasi</th><th>Jabatan</th><th>Status</th><th>Aksi</th>
                    </tr>";
        $table .= "</thead>";
        $table .= "<tbody>";
        foreach($query->result() as $row){
            $table .= "<tr>";
                $table .= "<td width='5px'>".$i."</td>";
                    $tmt = date('d M Y', strtotime($row->TMT));
                $table .= "<td width='85px'>".$tmt."</td>";
                $table .= "<td>".$row->NOSK."</td>";
                    $tgsk = date('d M Y', strtotime($row->TGSK));
                $table .= "<td width='85px'>".$tgsk."</td>";
                $table .= "<td>".$row->NALOKL."<br><strong><small class='text-success'>(".$row->KOLOK.")</small></strong></td>";
                $table .= "<td>".$row->NAJABL."<br><strong><small class='text-success'>(".$row->KOJAB.")</small></strong></td>";  
                 if($row->STATUS == 0){
                        $status = "Aktif";
                    }else{
                        $status = "Tidak Aktif";
                    }
                $table .= "<td>".$status."</td>"; 
                $table .= "<td >";
                if($accUpd == 'Y'){
                $table .="<button type='button' class='btn btn-outline btn-xs btn-success' title='Edit' onClick='getForm(\"jabatanf_hist\",\"update\",\"".$row->NRK."\",\"".date('d-m-Y', strtotime($row->TMT))."\",\"".$row->KOJAB."\");'><i class='fa fa-pencil-square'></i></button> &nbsp;"; 
                }
                if($accDel == 'Y'){                
                $table .= "<button type='button' class='btn btn-outline btn-xs btn-danger' title='Hapus' onClick='confirmHapusData(\"jabatanf_hist\",\"".$row->NRK."\",\"".date('d-m-Y', strtotime($row->TMT))."\",\"".$row->KOJAB."\");'><i class='fa fa-trash'></i></button>";
                }            
                $table .= "</td>";                            
            $table .= "</tr>";

            $i++;
        }
    	$table .= "</tbody>";
    	$table .= "</table>";
        $table .= "</div>";

    	return $table;
    }

    public function getRiwayatPendidikanFormal($nrk,$ug){
        $access['mnac'] = $this->getMenuAccessBy($ug,303);
        $accIns=$access['mnac']->act_insert;
        $accUpd=$access['mnac']->act_update;
        $accDel=$access['mnac']->act_delete;
    	/*$sql = "SELECT NRK, to_char(TGIJAZAH, 'YYYY-MM-DD') TGIJAZAH, NOIJAZAH, NASEK, UNIVER, USER_ID, TERM, to_char(TG_UPD, 'YYYY-MM-DD HH:MM:SS') TG_UPD , JENDIK, KODIK 
    			FROM PERS_PENDIDIKAN 
    			WHERE NRK = '".$nrk."' AND JENDIK = 1 
    			ORDER BY TGIJAZAH DESC"; */

        $sql = "SELECT A.NRK,  A.TGIJAZAH, A.NOIJAZAH, A.NASEK, A.UNIVER, B.NAUNIVER, A.USER_ID, A.TERM, A.TG_UPD , A.JENDIK, A.KODIK 
                FROM PERS_PENDIDIKAN A
                LEFT JOIN PERS_UNIVER_TBL B ON A.UNIVER = B.KDUNIVER
                WHERE A.NRK = '".$nrk."' AND A.JENDIK = 1 
                ORDER BY A.TGIJAZAH DESC";

    	$query = $this->ci->db->query($sql);    	

    	$i = 1;

        $table  = "<div id='_content_riwayat' class='animated fadeInUp'>";
        if($accIns == 'Y'){
            $table .= "<div class='pull-right'><button type='button' class='btn btn-primary btn-sm btn-block m-t' onClick='getForm(\"pendidikan_formal\",\"tambah\");'><i class='fa fa-plus'></i> Tambah Data</button></div>";
    	}
        $table .= "<table class='table table-striped table-bordered table-hover dataTables-example' width='99%'>";
    	$table .= "<thead>";
    	$table .= "	<tr>
                  		<th>No</th><th>Tgl. Ijazah</th><th>No. Ijazah</th><th>Nama Pendidikan</th><th>Aksi</th>
                    </tr>";
    	$table .= "</thead>";
    	$table .= "<tbody>";
    	foreach($query->result() as $row){
    		$table .= "<tr>";
    			$table .= "<td width='5px'>".$i."</td>";    			
    				$tglijazah = date('d M Y', strtotime($row->TGIJAZAH));			
    			$table .= "<td width='85px'>".$tglijazah."</td>";
    			$table .= "<td>".$row->NOIJAZAH."</td>";
                if($row->NASEK != ' ')
                {
                    $table .= "<td>".$row->NASEK."<br><strong><small class='text-success'>(".$row->UNIVER.")</small></strong></td>";
                }

                else if($row->NASEK == ' ')
                {
                    $table .= "<td>".$row->NAUNIVER."<br><strong><small class='text-success'>(".$row->UNIVER.")</small></strong></td>";
                }
    			
                $table .= "<td>";
                if($accUpd == 'Y')
                {
                    $table.= "<button type='button' class='btn btn-outline btn-xs btn-success' title='Edit' onClick='getForm(\"pendidikan_formal\",\"update\",\"".$row->NRK."\",\"".$row->JENDIK."\",\"".$row->KODIK."\");'><i class='fa fa-pencil-square'></i></button> &nbsp;";
                }
                if($accDel == 'Y')
                {                
                    $table.= "<button type='button' class='btn btn-outline btn-xs btn-danger' title='Hapus' onClick='confirmHapusData(\"pendidikan_formal\",\"".$row->NRK."\",\"".$row->JENDIK."\",\"".$row->KODIK."\");'><i class='fa fa-trash'></i></button>";
                }
                    $table.="</td>";
    		$table .= "</tr>";

    		$i++;
    	}
    	$table .= "</tbody>";
    	$table .= "</table>";
        $table .= "</div>";

    	return $table;
    }

    public function getRiwayatPendidikanNonFormal($nrk,$ug){
        $access['mnac'] = $this->getMenuAccessBy($ug,304);
        $accIns=$access['mnac']->act_insert;
        $accUpd=$access['mnac']->act_update;
        $accDel=$access['mnac']->act_delete;
    	$sql = "SELECT NRK, to_char(TGIJAZAH, 'YYYY-MM-DD') TGIJAZAH, NOIJAZAH, NASEK, UNIVER, USER_ID, TERM, to_char(TG_UPD, 'YYYY-MM-DD HH:MM:SS') TG_UPD, JENDIK, KODIK, SELENGGARA
    			FROM PERS_PENDIDIKAN 
    			WHERE NRK = '".$nrk."' AND JENDIK <> 1 
    			ORDER BY TGIJAZAH DESC";


    	$query = $this->ci->db->query($sql);    	

    	$i = 1;

        $table  = "<div id='_content_riwayat' class='animated fadeInUp'>";
        if($accIns == 'Y'){
            $table .= "<div class='pull-right'><button type='button' class='btn btn-primary btn-sm btn-block m-t' onClick='getForm(\"pendidikan_nonformal\",\"tambah\");'><i class='fa fa-plus'></i> Tambah Data</button></div>";
    	}
        $table .= "<table class='table table-striped table-bordered table-hover dataTables-example' width='99%'>";
    	$table .= "<thead>";
    	$table .= "	<tr>
                  		<th>No</th><th>Tgl. Ijazah</th><th>No. Ijazah</th><th>Nama Pendidikan</th><th>Penyelenggara</th><th>Aksi</th>
                    </tr>";
    	$table .= "</thead>";
    	$table .= "<tbody>";
    	foreach($query->result() as $row){
    		$table .= "<tr>";
    			$table .= "<td width='5px'>".$i."</td>";    	
    				$tglijazah = date('d M Y', strtotime($row->TGIJAZAH));			
    			$table .= "<td width='130px'>".$tglijazah."</td>";
    			$table .= "<td>".$row->NOIJAZAH."</td>";
    			$table .= "<td>".$row->NASEK."<br><strong><small class='text-success'>(".$row->UNIVER.")</small></strong></td>";   
                $table .= "<td>".$row->SELENGGARA."</td>";
                $table .= "<td>";
                if($accUpd == 'Y'){
                    $table.= "<button type='button' class='btn btn-outline btn-xs btn-success' title='Edit' onClick='getForm(\"pendidikan_nonformal\",\"update\",\"".$row->NRK."\",\"".$row->JENDIK."\",\"".$row->KODIK."\");'><i class='fa fa-pencil-square'></i></button> &nbsp;";
                }
                if($accDel == 'Y'){                
                    $table.= "<button type='button' class='btn btn-outline btn-xs btn-danger' title='Hapus' onClick='confirmHapusData(\"pendidikan_nonformal\",\"".$row->NRK."\",\"".$row->JENDIK."\",\"".$row->KODIK."\");'><i class='fa fa-trash'></i></button>";
                }
                $table.="</td>"; 			
    		$table .= "</tr>";

    		$i++;
    	}
    	$table .= "</tbody>";
    	$table .= "</table>";
        $table .= "</div>";

    	return $table;
    }

    public function getStrukturPegawai($nrk,$thbl){
    	$sql = "SELECT DISTINCT vw.nrk_bawahan, peg.nama
                FROM vw_kepala_bawahan vw
                LEFT JOIN pegawai_new peg ON vw.nrk_bawahan = peg.nrk
                WHERE vw.nrk_atasan = '".$nrk."' AND vw.thbl = '".$thbl."'";

    	$query = $this->ekine->query($sql);    	

    	$bawahan = "";
    	
    	foreach($query->result() as $row){
    		$pht2 = "assets/img/photo/".$row->nrk_bawahan.".jpg";    
			$img2 = (file_exists($pht2)) ? base_url().$pht2 : base_url()."assets/img/photo/profile_small.jpg" ;

			 $bawahan .= "<form style='display:none' method='POST' id=\"form_".$row->nrk_bawahan."\">
			 				<input type='hidden' name='thbl' id='thbl_".$row->nrk_bawahan."' value='".$thbl."'>
			 				<input type='hidden' name='nrk' id='nrk_".$row->nrk_bawahan."' value='".$row->nrk_bawahan."'>
			 			</form>
			 			<a onClick=\"getProfile('".$row->nrk_bawahan."')\" data-toggle=\"tooltip\" data-placement=\"bottom\" title=\"".$row->nama."\"><img alt=\"image\" class=\"img-circle\" src=\"$img2\" width=\"38px\" height=\"38px\"></a>";
    	}    	

    	return $bawahan;
    }

    public function getAtasanPegawai($nrk,$thbl){
        $sql = "SELECT nrk_atasan FROM vw_kepala_bawahan WHERE nrk_bawahan = '".$nrk."' AND thbl = '".$thbl."'";
        
        $query = $this->ekine->query($sql);      

        $atasan = "";
        
        foreach($query->result() as $row){
            $atasan = $row->nrk_atasan;
        }       

        return $atasan;
    }

    public function getShowTupoksi($nrk){
        $sql = "SELECT peg.nrk, peg.kolok, peg.kojab, reft.kolok,reft.kojab,reft.uraian
                FROM pegawai_new peg
                LEFT JOIN ref_tupoksi reft ON peg.kolok = reft.kolok AND peg.kojab = reft.kojab
                WHERE peg.nrk = '".$nrk."'";
              
        $query = $this->ekin->query($sql);

         $uraian = "<ol>";
        
        foreach($query->result() as $row){
            $uraian .= "<li class=''>".$row->uraian."</li>";
        }       

        $uraian .= "</ol>";

        return $uraian;

        
       //return $query->result();
    }

    public function getTupoksi($nrk){
        $sql = "SELECT peg.nrk, peg.kolok, peg.kojab, reft.kolok,reft.kojab
                FROM pegawai_new peg
                LEFT JOIN ref_tupoksi reft ON peg.kolok = reft.kolok AND peg.kojab = reft.kojab
                WHERE peg.nrk = '".$nrk."'";
               // echo $sql;
        $query = $this->ekin->query($sql);

        return $query->row();
    }

    public function getRefTupoksi($nrk,$ug){
        $access['mnac'] = $this->getMenuAccessBy($ug,319);
        $accIns=$access['mnac']->act_insert;
        $accUpd=$access['mnac']->act_update;
        $accDel=$access['mnac']->act_delete;
        $sql = "SELECT peg.nrk,reft.tupoksi_id, peg.kolok, peg.klogad, peg.kojab, reft.no_urut,reft.uraian,reft.dasar_hukum
                FROM pegawai_new peg
                LEFT JOIN ref_tupoksi reft ON peg.kolok = reft.kolok AND peg.kojab = reft.kojab
                WHERE peg.nrk = '".$nrk."' ORDER BY reft.tupoksi_id DESC";
        $query = $this->ekin->query($sql);   

        $i = 1;

        $table  = "<div id='_content_riwayat' class='animated fadeInUp'>";
        if($accIns == 'Y')
        {
        $table .= "<div class='pull-right'><button type='button' class='btn btn-primary btn-sm btn-block m-t' onClick='getForm(\"tupoksi\",\"tambah\",\"".$nrk."\");'><i class='fa fa-plus'></i> Tambah Data</button></div>";
        }
        $table .= "<table class='table table-striped table-bordered table-hover dataTables-example' width='99%'>";
        //$table .= "<thead>";
        $table .= " <tr>
                        <th>No</th><th>Uraian</th>
                    </tr>";
//        $table .= "</thead>";
//        $table .= "<tbody>";
        foreach($query->result() as $row){
            $table .= "<tr>";
                $table .= "<td>".$i."</td>";
                      
                $table .= "<td>".$row->uraian."</td>";   
                //$table .= "<td>".$row->dasar_hukum."</td>";
//                $table .= "<td >";
//                if($accUpd == 'Y')
//                {
//                    $table.="<button type='button' class='btn btn-outline btn-xs btn-success' title='Edit' onClick='getForm(\"tupoksi\",\"update\",\"".$row->nrk."\",\"".$row->tupoksi_id."\");'><i class='fa fa-pencil-square'></i></button> &nbsp;";
//                }
//                if($accDel == 'Y')
//                {
//                   $table.="<button type='button' class='btn btn-outline btn-xs btn-danger' title='Hapus' onClick='confirmHapusData(\"tupoksi\",\"".$row->nrk."\",\"".$row->tupoksi_id."\");'><i class='fa fa-trash'></i></button>";
//                }
//                $table.="</td>";
            $table .= "</tr>";

            $i++;
        }

//        $table .= "</tbody>";
        $table .= "</table>";
        $table .= "</div>";

        return $table;
    }

    public function getMenuSelectHist(){
        $sql = "SELECT \"id\", \"nama_menu\" FROM \"menu_user_select_hist\" WHERE \"status\" = 'Y' ORDER BY \"id\" ASC";

        $query = $this->ci->db->query($sql);        

        $option = "";
        
        foreach($query->result() as $row){
            $option .= "<option value='".$row->id."'>".$row->nama_menu."</option>";
        }

        return $option;
    }

    public function getMenuSelectHistNew($user_group){
        $sql = "SELECT \"id_menu\", \"alias\", \"nama_menu\"
                  FROM \"menu_access_user\"
                  INNER JOIN \"menu_master\" ON \"menu_id\"=\"id_menu\"
                  WHERE \"act_view\" = 'Y'
                  AND \"jenis_menu\"='1'
                  AND \"link_menu\"='home'
                  AND \"status_aktif\"='Y'
                  AND \"user_group_id\"='$user_group'
                  ORDER BY \"id_menu\" ASC";
        //echo $sql;
        $query = $this->ci->db->query($sql);

        $option = "";

        foreach($query->result() as $row){
            $option .= "<option value='".$row->alias."'>&nbsp; ".$row->nama_menu."</option>";
        }

        return $option;
    }

    public function getRiwayatPangkat($nrk,$ug){
        $access['mnac'] = $this->getMenuAccessBy($ug,305);
        $accIns=$access['mnac']->act_insert;
        $accUpd=$access['mnac']->act_update;
        $accDel=$access['mnac']->act_delete;
        $sql = "SELECT KO.NRK,to_char(KO.TMT, 'YYYY-MM-DD') TMT, KO.NOSK, to_char(KO.TGSK, 'YYYY-MM-DD') TGSK, KO.KOPANG, TB.GOL, TB.NAPANG, KO.KOLOK, LO.NALOKL, KO.GAPOK
                FROM PERS_PANGKAT_HIST KO
                LEFT JOIN PERS_PANGKAT_TBL TB ON KO.KOPANG = TB.KOPANG
                LEFT JOIN PERS_LOKASI_TBL LO ON KO.KOLOK = LO.KOLOK
                WHERE KO.NRK = '".$nrk."' ORDER BY KO.TMT DESC";


        $query = $this->ci->db->query($sql);        

        $i = 1;

        $table  = "<div id='_content_riwayat' class='animated fadeInUp'>";
        if($accIns == 'Y'){
            $table .= "<div class='pull-right'><button type='button' class='btn btn-primary btn-sm btn-block m-t' onClick='getForm(\"pangkat\",\"tambah\");'><i class='fa fa-plus'></i> Tambah Data</button></div>";
        }
        $table .= "<table class='table table-striped table-bordered table-hover dataTables-example' width='99%'>";
        $table .= "<thead>";
        $table .= " <tr>                        
                        <th>No</th><th>TMT</th><th>No. SK</th><th>Tgl. SK</th><th>Pangkat</th><th>Golongan</th><th>Gaji Pokok (Rp.)</th><th>Lokasi</th><th>Aksi</th>
                    </tr>";
        $table .= "</thead>";
        $table .= "<tbody>";
        foreach($query->result() as $row){
            $table .= "<tr>";
                $table .= "<td width='5px'>".$i."</td>";
                    $tmt = date('d M Y', strtotime($row->TMT));
                $table .= "<td width='85px'>".$tmt."</td>";
                $table .= "<td>".$row->NOSK."</td>";
                    $tgsk = date('d M Y', strtotime($row->TGSK));
                $table .= "<td width='85px'>".$tgsk."</td>";
                $table .= "<td>".$row->NAPANG."</td>";
                $table .= "<td>".$row->GOL."</td>";
                $table .= "<td align='right'>".number_format($row->GAPOK, 0, ',', '.')."</td>";
                $table .= "<td>".$row->NALOKL."<br><strong><small class='text-success'>(".$row->KOLOK.")</small></strong></td>";
                $table .= "<td >";
                if($accUpd == 'Y'){
                    $table.="<button type='button' class='btn btn-outline btn-xs btn-success' title='Edit' onClick='getForm(\"pangkat\",\"update\",\"".$row->NRK."\",\"".date('d-m-Y', strtotime($row->TMT))."\",\"".$row->KOPANG."\");'><i class='fa fa-pencil-square'></i></button> &nbsp;";
                }
                if($accDel == 'Y'){                
                    $table.="<button type='button' class='btn btn-outline btn-xs btn-danger' title='Hapus' onClick='confirmHapusData(\"pangkat\",\"".$row->NRK."\",\"".date('d-m-Y', strtotime($row->TMT))."\",\"".$row->KOPANG."\");'><i class='fa fa-trash'></i></button>";
                }            
                $table.= "</td>";
            $table .= "</tr>";

            $i++;
        }
        $table .= "</tbody>";
        $table .= "</table>";
        $table .= "</div>";

        return $table;
    }

    public function getRiwayatGapok($nrk,$ug){
        $access['mnac'] = $this->getMenuAccessBy($ug,306);
        $accIns=$access['mnac']->act_insert;
        $accUpd=$access['mnac']->act_update;
        $accDel=$access['mnac']->act_delete;

        $sql = "SELECT a.NRK, to_char(a.TMT, 'YYYY-MM-DD') TMT, a.NOSK, to_char(a.TGSK, 'YYYY-MM-DD') TGSK, a.KOPANG, b.NAPANG, b.GOL, a.GAPOK, a.KOLOK, c.NALOKL
                FROM PERS_RB_GAPOK_HIST a 
                LEFT JOIN PERS_PANGKAT_TBL b ON a.KOPANG = b.KOPANG
                LEFT JOIN PERS_LOKASI_TBL c ON a.KOLOK = c.KOLOK
                WHERE a.NRK = '".$nrk."' ORDER BY a.TMT DESC";


        $query = $this->ci->db->query($sql);        

        $i = 1;

        $table  = "<div id='_content_riwayat' class='animated fadeInUp'>";
        if($accIns == 'Y'){
        $table .= "<div class='pull-right'><button type='button' class='btn btn-primary btn-sm btn-block m-t' onClick='getForm(\"gapok\",\"tambah\");'><i class='fa fa-plus'></i> Tambah Data</button></div>";
        }
        $table .= "<table class='table table-striped table-bordered table-hover dataTables-example' width='99%'>";
        $table .= "<thead>";
        $table .= " <tr>                        
                        <th>No</th><th>TMT</th><th>No. SK</th><th>Tgl. SK</th><th>Pangkat</th><th>Golongan</th><th>Gaji Pokok (Rp.)</th><th>Lokasi</th><th>Aksi</th>
                    </tr>";
        $table .= "</thead>";
        $table .= "<tbody>";
        foreach($query->result() as $row){
            $table .= "<tr>";
                $table .= "<td width='5px'>".$i."</td>";
                    $tmt = date('d M Y', strtotime($row->TMT));
                $table .= "<td width='85px'>".$tmt."</td>";
                $table .= "<td>".$row->NOSK."</td>";
                    $tgsk = date('d M Y', strtotime($row->TGSK));
                $table .= "<td width='85px'>".$tgsk."</td>";
                $table .= "<td>".$row->NAPANG."</td>";
                $table .= "<td>".$row->GOL."</td>";
                $table .= "<td align='right'>".number_format($row->GAPOK, 0, ',', '.')."</td>";
                $table .= "<td>".$row->NALOKL."<br><strong><small class='text-success'>(".$row->KOLOK.")</small></strong></td>";                
                $table .= "<td>";
                if($accUpd == 'Y'){
                    $table.="<button type='button' class='btn btn-outline btn-xs btn-success' title='Edit' onClick='getForm(\"gapok\",\"update\",\"".$row->NRK."\",\"".$row->TMT."\",\"".$row->GAPOK."\");'><i class='fa fa-pencil-square'></i></button> &nbsp;";
                }
                if($accDel == 'Y'){
                    $table.="<button type='button' class='btn btn-outline btn-xs btn-danger' title='Hapus' onClick='confirmHapusData(\"gapok\",\"".$row->NRK."\",\"".$row->TMT."\",\"".$row->GAPOK."\",\"".$row->KOPANG."\");'><i class='fa fa-trash'></i></button>";
                }
                $table.="</td>";
            $table .= "</tr>";

            $i++;
        }
        $table .= "</tbody>";
        $table .= "</table>";
        $table .= "</div>";

        return $table;
    }

    public function getHukumanDisiplin($nrk,$ug){
        $access['mnac'] = $this->getMenuAccessBy($ug,307);
        $accIns=$access['mnac']->act_insert;
        $accUpd=$access['mnac']->act_update;
        $accDel=$access['mnac']->act_delete;

        $sql = "SELECT a.NRK, to_char(a.TGSK, 'YYYY-MM-DD') TGSK, a.NOSK, b.KETERANGAN, to_char(a.TGMULAI, 'YYYY-MM-DD') TGMULAI, to_char(a.TGAKHIR, 'YYYY-MM-DD') TGAKHIR
                FROM PERS_DISIPLIN_HIST a 
                LEFT JOIN PERS_JENHUKDIS_RPT b ON a.JENHUKDIS = b.JENHUKDIS
                WHERE a.NRK = '".$nrk."' ORDER BY a.TGMULAI DESC";


        $query = $this->ci->db->query($sql);        

        $i = 1;

        $table  = "<div id='_content_riwayat' class='animated fadeInUp'>";
        if($accIns == 'Y')
        {
            $table .= "<div class='pull-right'><button type='button' class='btn btn-primary btn-sm btn-block m-t' onClick='getForm(\"hukdis\",\"tambah\");'><i class='fa fa-plus'></i> Tambah Data</button></div>";
        }
        $table .= "<table class='table table-striped table-bordered table-hover dataTables-example' width='99%'>";
        $table .= "<thead>";
        $table .= " <tr>                        
                        <th>No</th><th>No. SK</th><th>Tgl. SK</th><th>Jenis Hukuman</th><th>Tanggal Mulai</th><th>Tanggal Berakhir</th><th>Aksi</th>
                    </tr>";
        $table .= "</thead>";
        $table .= "<tbody>";
        foreach($query->result() as $row){
            $table .= "<tr>";
                $table .= "<td width='5px'>".$i."</td>";                    
                $table .= "<td>".$row->NOSK."</td>";
                    $tgsk = date('d M Y', strtotime($row->TGSK));
                $table .= "<td width='85px'>".$tgsk."</td>";
                $table .= "<td>".$row->KETERANGAN."</td>";
                    $mulai = date('d M Y', strtotime($row->TGMULAI));
                $table .= "<td>".$mulai."</td>";              
                    $akhir = date('d M Y', strtotime($row->TGAKHIR));  
                $table .= "<td>".$akhir."</td>";
                $table .= "<td >";
                if($accUpd == 'Y'){
                    $table.=    "<button type='button' class='btn btn-outline btn-xs btn-success' title='Edit' onClick='getForm(\"hukdis\",\"update\",\"".$row->NRK."\",\"".$row->TGSK."\");'><i class='fa fa-pencil-square'></i></button> &nbsp;";
                }
                if($accDel == 'Y'){    
                    $table.=    "<button type='button' class='btn btn-outline btn-xs btn-danger' title='Hapus' onClick='confirmHapusData(\"hukdis\",\"".$row->NRK."\",\"".$row->TGSK."\");'><i class='fa fa-trash'></i></button>";
                }
                $table.="</td>";
            $table .= "</tr>";

            $i++;
        }
        $table .= "</tbody>";
        $table .= "</table>";
        $table .= "</div>";

        return $table;
    }

    public function getHukumanAdministrasi($nrk,$ug){
        $access['mnac'] = $this->getMenuAccessBy($ug,308);
        $accIns=$access['mnac']->act_insert;
        $accUpd=$access['mnac']->act_update;
        $accDel=$access['mnac']->act_delete;
        $sql = "SELECT a.NRK, a.NOSK, to_char(a.TGSK, 'YYYY-MM-DD') TGSK , b.KETERANGAN, to_char(a.TGMULAI, 'YYYY-MM-DD') TGMULAI, to_char(a.TGAKHIR, 'YYYY-MM-DD') TGAKHIR
                FROM PERS_ADMIN_HIST a 
                LEFT JOIN PERS_JENHUKADM_RPT b ON a.JENHUKADM = b.JENHUKADM
                WHERE a.NRK = '".$nrk."' ORDER BY TGSK DESC";


        $query = $this->ci->db->query($sql);        

        $i = 1;

        $table  = "<div id='_content_riwayat' class='animated fadeInUp'>";
        if($accIns == 'Y')
        {
            $table .= "<div class='pull-right'><button type='button' class='btn btn-primary btn-sm btn-block m-t' onClick='getForm(\"hukadmin\",\"tambah\");'><i class='fa fa-plus'></i> Tambah Data</button></div>";
        }
        $table .= "<table class='table table-striped table-bordered table-hover dataTables-example' width='99%'>";
        $table .= "<thead>";
        $table .= " <tr>                        
                        <th>No</th><th>No. SK</th><th>Tgl. SK</th><th>Jenis Hukuman</th><th>Tanggal Mulai</th><th>Tanggal Berakhir</th><th>Aksi</th>
                    </tr>";
        $table .= "</thead>";
        $table .= "<tbody>";
        foreach($query->result() as $row){
            $table .= "<tr>";
                $table .= "<td width='5px'>".$i."</td>";                    
                $table .= "<td>".$row->NOSK."</td>";
                    $tgsk = date('d M Y', strtotime($row->TGSK));
                $table .= "<td width='85px'>".$tgsk."</td>";
                $table .= "<td>".$row->KETERANGAN."</td>";
                $mulai = date('d M Y', strtotime($row->TGMULAI));
                $table .= "<td>".$mulai."</td>";
                $akhir = date('d M Y', strtotime($row->TGAKHIR));
                $table .= "<td>".$akhir."</td>";
                $table .= "<td >";
                if($accUpd == 'Y'){
                    $table.=    "<button type='button' class='btn btn-outline btn-xs btn-success' title='Edit' onClick='getForm(\"hukadmin\",\"update\",\"".$row->NRK."\",\"".$row->TGSK."\");'><i class='fa fa-pencil-square'></i></button> &nbsp;";
                }
                if($accDel == 'Y'){    
                    $table.=    "<button type='button' class='btn btn-outline btn-xs btn-danger' title='Hapus' onClick='confirmHapusData(\"hukadmin\",\"".$row->NRK."\",\"".$row->TGSK."\");'><i class='fa fa-trash'></i></button>";
                }
                $table.=    "</td>";
            $table .= "</tr>";

            $i++;
        }
        $table .= "</tbody>";
        $table .= "</table>";
        $table .= "</div>";

        return $table;
    }

    public function getRiwayatDP3($nrk,$ug){
        $access['mnac'] = $this->getMenuAccessBy($ug,309);
        $accIns=$access['mnac']->act_insert;
        $accUpd=$access['mnac']->act_update;
        $accDel=$access['mnac']->act_delete;
        $sql = "SELECT a.NRK, a.TAHUN, a.SETIA, a.PRESTASI, a.TGGJAWAB, a.TAAT, a.JUJUR, a.KERJASAMA, a.PRAKARSA, a.PIMPIN, a.JUMLAH, a.RATA 
                FROM PERS_DP3 a
                WHERE a.NRK = '".$nrk."'
                ORDER BY TAHUN DESC";


        $query = $this->ci->db->query($sql);        

        $i = 1;

        $table  = "<div id='_content_riwayat' class='animated fadeInUp'>";
        if($accIns == 'Y')
        {
            $table .= "<div class='pull-right'><button type='button' class='btn btn-primary btn-sm btn-block m-t' onClick='getForm(\"dp3\",\"tambah\");'><i class='fa fa-plus'></i> Tambah Data</button></div>";
        }
        $table .= "<table class='table table-striped table-bordered table-hover dataTables-example' width='99%'>";
        $table .= "<thead>";
        $table .= " <tr>                        
                        <th>No</th><th>Tahun</th><th>Kesetiaan</th><th>Prestasi</th><th>Tanggung Jawab</th><th>Ketaatan</th><th>Kejujuran</th><th>Kerjasama</th><th>Prakarsa</th><th>Kepemimpinan</th><th>Jumlah</th><th>Rata-rata</th><th>Aksi</th>
                    </tr>";
        $table .= "</thead>";
        $table .= "<tbody>";
        foreach($query->result() as $row){
            $table .= "<tr>";
                $table .= "<td width='5px'>".$i."</td>";                    
                $table .= "<td align='right'>".$row->TAHUN."</td>";
                $table .= "<td align='right'>".$row->SETIA."</td>";
                $table .= "<td align='right'>".$row->PRESTASI."</td>";
                $table .= "<td align='right'>".$row->TGGJAWAB."</td>";
                $table .= "<td align='right'>".$row->TAAT."</td>";
                $table .= "<td align='right'>".$row->JUJUR."</td>";
                $table .= "<td align='right'>".$row->KERJASAMA."</td>";
                $table .= "<td align='right'>".$row->PRAKARSA."</td>";
                $table .= "<td align='right'>".$row->PIMPIN."</td>";
                $table .= "<td align='right'>".$row->JUMLAH."</td>";
                $table .= "<td align='right'>".$row->RATA."</td>";
                $table .= "<td>";
                if($accUpd == 'Y'){
                    $table.= "<button type='button' class='btn btn-outline btn-xs btn-success' title='Edit' onClick='getForm(\"dp3\",\"update\",\"".$row->NRK."\",\"".$row->TAHUN."\");'><i class='fa fa-pencil-square'></i></button> &nbsp;";
                }
                if($accDel == 'Y'){
                    $table.="<button type='button' class='btn btn-outline btn-xs btn-danger' title='Hapus' onClick='confirmHapusData(\"dp3\",\"".$row->NRK."\",\"".$row->TAHUN."\");'><i class='fa fa-trash'></i></button>";
                }    
                $table.="            </td>";
            $table .= "</tr>";

            $i++;
        }
        $table .= "</tbody>";
        $table .= "</table>";
        $table .= "</div>";

        return $table;
    }

    public function getRiwayatAbsensi($nrk,$ug){
        $access['mnac'] = $this->getMenuAccessBy($ug,310);
        $accIns=$access['mnac']->act_insert;
        $accUpd=$access['mnac']->act_update;
        $accDel=$access['mnac']->act_delete;
       
        $sql = "SELECT a.NRK, a.THBL, a.KLOGAD, a.ALFA, a.IZIN, a.SAKIT, a.CUTI, a.JAMTERLAMBAT, a.JAMPULANGCEPAT, a.KINERJA, a.CUTIAPENTING, a.CUTIBESAR, a.CUTISAKIT, a.CUTIBERSALIN 
                FROM PERS_TUNDA_ABSENSI a
                WHERE a.NRK = '".$nrk."'
                ORDER BY a.THBL DESC";


        $query = $this->ci->db->query($sql);        

        $i = 1;

        $table  = "<div id='_content_riwayat' class='animated fadeInUp'>";
        if($accIns == 'Y')
        {
            $table .= "<div class='pull-right'><button type='button' class='btn btn-primary btn-sm btn-block m-t' onClick='getForm(\"absensi\",\"tambah\");'><i class='fa fa-plus'></i> Tambah Data</button></div>";
        }
        $table .= "<table class='table table-striped table-bordered table-hover dataTables-example' width='99%'>";
        $table .= "<thead>";
        $table .= " <tr>                        
                        <th>No</th><th>Bulan Tahun</th><th>Kehadiran</th><th>Kinerja</th><th>Cuti</th><th>Aksi</th>
                    </tr>";
        $table .= "</thead>";
        $table .= "<tbody>";
        foreach($query->result() as $row){
            $table .= "<tr>";
                $table .= "<td width='5px'>".$i."</td>";     
                    $tahun = substr($row->THBL, 0,4);
                    $bulan = substr($row->THBL, 4,2);
                    if($bulan=='01'){
                        $bln="Jan";
                    }elseif ($bulan=='02') {
                        $bln="Feb";
                    }elseif ($bulan=='03') {
                        $bln="Mar";
                    }elseif ($bulan=='04') {
                        $bln="Apr";
                    }elseif ($bulan=='05') {
                        $bln="May";
                    }elseif ($bulan=='06') {
                        $bln="Jun";
                    }elseif ($bulan=='07') {
                        $bln="Jul";
                    }elseif ($bulan=='08') {
                        $bln="Aug";
                    }elseif ($bulan=='09') {
                        $bln="Sep";
                    }elseif ($bulan=='10') {
                        $bln="Oct";
                    }elseif ($bulan=='11') {
                        $bln="Nov";
                    }elseif ($bulan=='12') {
                        $bln="Dec";
                    }else{
                        $bln = "-";
                    }

                $table .= "<td>".$bln." ".$tahun."</td>";  
                $table .= "<td><table width='65%'><tr><td colspan='2'><span class='text-success'>Izin (".$row->IZIN.")</span><span class='text-navy'>  -  Sakit (".$row->SAKIT.")</span><span class='text-danger'>  -  Alfa (".$row->ALFA.")</span></td></tr>
                                      <tr><td><span class='text-danger'>Jam Terlambat (".$row->JAMTERLAMBAT.")</span></td><td><span class='text-success'>Jam Pulang Cepat (".$row->JAMPULANGCEPAT.")</span></td></tr>
                                </table>
                            </td>";
                $table .= "<td align='right'>".$row->KINERJA."</td>";
                $table .= "<td><table width='100%'><tr><td><span class='text-navy'> Cuti (".$row->CUTI.")</span><br><span class='text-success'>Cuti Penting (".$row->CUTIAPENTING.")</span><br><span class='text-navy'>Cuti Besar (".$row->CUTIBESAR.")</span><br><span class='text-success'>Cuti Sakit (".$row->CUTISAKIT.")</span><br><span class='text-navy'>Cuti Bersalin (".$row->CUTIBERSALIN.")</span></td></tr></table></td>";                
                $table .= "<td >";
                if($accUpd == 'Y')
                {
                    $table.=" <button type='button' class='btn btn-outline btn-xs btn-success' title='Edit' onClick='getForm(\"absensi\",\"update\",\"".$row->NRK."\",\"".$row->THBL."\");'><i class='fa fa-pencil-square'></i></button>";
                } 
                if($accDel == 'Y')
                {
                $table.="<button type='button' class='btn btn-outline btn-xs btn-danger' title='Hapus' onClick='confirmHapusData(\"absensi\",\"".$row->NRK."\",\"".$row->THBL."\");'><i class='fa fa-trash'></i></button>";
                }
                $table.="          </td>";
            $table .= "</tr>";

            $i++;
        }
        $table .= "</tbody>";
        $table .= "</table>";
        $table .= "</div>";

        return $table;
    }

    public function getRiwayatCuti($nrk,$ug){
        $access['mnac'] = $this->getMenuAccessBy($ug,311);
        $accIns=$access['mnac']->act_insert;
        $accUpd=$access['mnac']->act_update;
        $accDel=$access['mnac']->act_delete;

        $sql = "SELECT a.NRK, to_char(a.TMT, 'YYYY-MM-DD') TMT, a.NOSK, to_char(a.TGSK, 'YYYY-MM-DD') TGSK, b.KETERANGAN, to_char(a.TGAKHIR, 'YYYY-MM-DD') TGAKHIR 
                FROM PERS_CUTI_HIST a
                LEFT JOIN PERS_JENCUTI_RPT b ON a.JENCUTI = b.JENCUTI
                WHERE a.NRK = '".$nrk."' ORDER BY a.TMT DESC";


        $query = $this->ci->db->query($sql);        

        $i = 1;

        $table  = "<div id='_content_riwayat' class='animated fadeInUp'>";
        if($accIns == 'Y'){
        $table .= "<div class='pull-right'><button type='button' class='btn btn-primary btn-sm btn-block m-t' onClick='getForm(\"cuti\",\"tambah\");'><i class='fa fa-plus'></i> Tambah Data</button></div>";
        }
        $table .= "<table class='table table-striped table-bordered table-hover dataTables-example' width='99%'>";
        $table .= "<thead>";
        $table .= " <tr>                        
                        <th>No</th><th>TMT</th><th>No. SK</th><th>Tgl. SK</th><th>Jenis Cuti</th><th>Tanggal Berakhir</th><th>Aksi</th>
                    </tr>";
        $table .= "</thead>";
        $table .= "<tbody>";
        foreach($query->result() as $row){
            $table .= "<tr>";
                $table .= "<td width='5px'>".$i."</td>";
                    $tmt = date('d M Y', strtotime($row->TMT));
                $table .= "<td width='85px'>".$tmt."</td>";
                $table .= "<td>".$row->NOSK."</td>";
                    $tgsk = date('d M Y', strtotime($row->TGSK));
                $table .= "<td width='85px'>".$tgsk."</td>";
                $table .= "<td>".$row->KETERANGAN."</td>";                
                    $tgakhir = date('d M Y', strtotime($row->TGAKHIR));
                $table .= "<td width='85px'>".$tgakhir."</td>";
                $table .= "<td>";
                if($accUpd == 'Y')
                {
                    $table.="<button type='button' class='btn btn-outline btn-xs btn-success' title='Edit' onClick='getForm(\"cuti\",\"update\",\"".$row->NRK."\",\"".$row->TMT."\");'><i class='fa fa-pencil-square'></i></button> &nbsp;";
                }
                if($accDel == 'Y')
                { 
                    $table.="<button type='button' class='btn btn-outline btn-xs btn-danger' title='Hapus' onClick='confirmHapusData(\"cuti\",\"".$row->NRK."\",\"".$row->TMT."\");'><i class='fa fa-trash'></i></button>";
                } 
                  $table.="          </td>";
            $table .= "</tr>";

            $i++;
        }
        $table .= "</tbody>";
        $table .= "</table>";
        $table .= "</div>";

        return $table;
    }

    public function getRiwayatPembatasan($nrk,$ug){
        $access['mnac'] = $this->getMenuAccessBy($ug,312);
        $accIns=$access['mnac']->act_insert;
        $accUpd=$access['mnac']->act_update;
        $accDel=$access['mnac']->act_delete;

        $sql = "SELECT a.NRK, to_char(a.TMT, 'YYYY-MM-DD') TMT, a.NOSIZIN, to_char(a.TGSIZIN, 'YYYY-MM-DD') TGSIZIN, b.KETERANGAN, to_char(a.TGAKHIR, 'YYYY-MM-DD') TGAKHIR
                FROM PERS_PEMBATASAN a 
                LEFT JOIN PERS_JENUSAHA_RPT b ON a.JENUSAHA = b.JENUSAHA
                WHERE a.NRK = '".$nrk."' ORDER BY a.TMT DESC
                ";


        $query = $this->ci->db->query($sql);        

        $i = 1;

        $table  = "<div id='_content_riwayat' class='animated fadeInUp'>";
        if($accIns == 'Y')
        {
            $table .= "<div class='pull-right'><button type='button' class='btn btn-primary btn-sm btn-block m-t' onClick='getForm(\"pembatasan\",\"tambah\");'><i class='fa fa-plus'></i> Tambah Data</button></div>";
        }
        $table .= "<table class='table table-striped table-bordered table-hover dataTables-example' width='99%'>";
        $table .= "<thead>";
        $table .= " <tr>                        
                        <th>No</th><th>TMT</th><th>No. Izin</th><th>Tgl. Izin</th><th>Jenis Usaha</th><th>Tanggal Berakhir</th><th>Aksi</th>
                    </tr>";
        $table .= "</thead>";
        $table .= "<tbody>";
        foreach($query->result() as $row){
            $table .= "<tr>";
                $table .= "<td width='5px'>".$i."</td>";
                    $tmt = date('d M Y', strtotime($row->TMT));
                $table .= "<td width='85px'>".$tmt."</td>";
                $table .= "<td>".$row->NOSIZIN."</td>";
                    $tgsk = date('d M Y', strtotime($row->TGSIZIN));
                $table .= "<td width='85px'>".$tgsk."</td>";
                $table .= "<td>".$row->KETERANGAN."</td>";                
                    $tgakhir = date('d M Y', strtotime($row->TGAKHIR));
                $table .= "<td width='85px'>".$tgakhir."</td>";
                $table .= "<td>";
                if($accUpd == 'Y'){
                    $table.=    "<button type='button' class='btn btn-outline btn-xs btn-success' title='Edit' onClick='getForm(\"pembatasan\",\"update\",\"".$row->NRK."\",\"".$row->TMT."\");'><i class='fa fa-pencil-square'></i></button> &nbsp;";
                }
                if($accDel == 'Y'){        
                    $table.=    "<button type='button' class='btn btn-outline btn-xs btn-danger' title='Hapus' onClick='confirmHapusData(\"pembatasan\",\"".$row->NRK."\",\"".$row->TMT."\");'><i class='fa fa-trash'></i></button>";
                }            
                $table.= "</td>";
            $table .= "</tr>";

            $i++;
        }
        $table .= "</tbody>";
        $table .= "</table>";
        $table .= "</div>";

        return $table;
    }

    public function getRiwayatSeminar($nrk,$ug){
        $access['mnac'] = $this->getMenuAccessBy($ug,313);
        $accIns=$access['mnac']->act_insert;
        $accUpd=$access['mnac']->act_update;
        $accDel=$access['mnac']->act_delete;

        $sql = "SELECT a.NRK, to_char(a.TGMULAI, 'YYYY-MM-DD') TGMULAI, to_char(a.TGSELESAI, 'YYYY-MM-DD') TGSELESAI, a.NASEMI, b.KETERANGAN JENISSEMINAR, c.NATEMA, a.BADAN, a.TEMPAT, d.KETERANGAN PERAN
                FROM PERS_SEMINAR_HIST a
                LEFT JOIN PERS_KDSEMI_RPT b ON a.KDSEMI = b.KDSEMI
                LEFT JOIN PERS_TEMA_TBL c ON a.KDTEMA = c.KDTEMA
                LEFT JOIN PERS_KDPERANS_RPT d ON a.KDPERAN = d.KDPERAN
                WHERE a.NRK = '".$nrk."' ORDER BY TGMULAI DESC
                ";


        $query = $this->ci->db->query($sql);        

        $i = 1;

        $table  = "<div id='_content_riwayat' class='animated fadeInUp'>";
        if($accIns == 'Y')
        {
        $table .= "<div class='pull-right'><button type='button' class='btn btn-primary btn-sm btn-block m-t' onClick='getForm(\"seminar\",\"tambah\");'><i class='fa fa-plus'></i> Tambah Data</button></div>";
        }
        $table .= "<table class='table table-striped table-bordered table-hover dataTables-example' width='99%'>";
        $table .= "<thead>";
        $table .= " <tr>                        
                        <th>No</th><th>Nama Seminar</th><th>Tema</th><th>Tgl. Laksana</th><th>Peran</th><th>Pelaksana</th><th>Tempat</th><th>Aksi</th>
                    </tr>";
        $table .= "</thead>";
        $table .= "<tbody>";
        foreach($query->result() as $row){
            $table .= "<tr>";
                $table .= "<td width='5px'>".$i."</td>";
                $table .= "<td>".$row->NASEMI."<br><span class='text-success'><strong>(".$row->JENISSEMINAR.")</strong></span></td>";                
                $table .= "<td>".$row->NATEMA."</td>";
                    $tgmulai = date('d M Y', strtotime($row->TGMULAI));
                    $tgselesai = date('d M Y', strtotime($row->TGSELESAI));
                $table .= "<td width='185px'>".$tgmulai." s/d ".$tgselesai."</td>";                                    
                $table .= "<td>".$row->PERAN."</td>";
                $table .= "<td>".$row->BADAN."</td>";
                $table .= "<td>".$row->TEMPAT."</td>";
                $table .= "<td>";
                if($accUpd == 'Y'){
                    $table.="<button type='button' class='btn btn-outline btn-xs btn-success' title='Edit' onClick='getForm(\"seminar\",\"update\",\"".$row->NRK."\",\"".$row->TGMULAI."\");'><i class='fa fa-pencil-square'></i></button> &nbsp;";
                }
                if($accDel == 'Y'){        
                    $table.="<button type='button' class='btn btn-outline btn-xs btn-danger' title='Hapus' onClick='confirmHapusData(\"seminar\",\"".$row->NRK."\",\"".$row->TGMULAI."\");'><i class='fa fa-trash'></i></button>";
                }            
                $table.=            "</td>";
            $table .= "</tr>";

            $i++;
        }
        $table .= "</tbody>";
        $table .= "</table>";
        $table .= "</div>";

        return $table;
    }

    public function getRiwayatTulisan($nrk,$ug){
        $access['mnac'] = $this->getMenuAccessBy($ug,314);
        $accIns=$access['mnac']->act_insert;
        $accUpd=$access['mnac']->act_update;
        $accDel=$access['mnac']->act_delete;

        $sql = "SELECT a.NRK, to_char(a.TGPUBLIK, 'YYYY-MM-DD') TGPUBLIK, a.JUDUL, b.NATEMA, c.KETERANGAN SIFAT, a.MEDPUBLIK, d.KETERANGAN LINGKUP, e.KETERANGAN JUMKATA, f.KETERANGAN PERAN
                FROM PERS_TULISAN_HIST a
                LEFT JOIN PERS_TEMA_TBL b ON a.KDTEMA = b.KDTEMA
                LEFT JOIN PERS_KDSIFAT_RPT c ON a.KDSIFAT = c.KDSIFAT
                LEFT JOIN PERS_KDLINGKUP_RPT d ON a.KDLINGKUP = d.KDLINGKUP
                LEFT JOIN PERS_KDJUMKATA_RPT e ON a.KDJUMKATA = e.KDJUMKATA
                LEFT JOIN PERS_KDPERANT_RPT f ON a.KDPERAN = f.KDPERAN
                WHERE a.NRK = '".$nrk."' ORDER BY TGPUBLIK DESC
                ";


        $query = $this->ci->db->query($sql);        

        $i = 1;

        $table  = "<div id='_content_riwayat' class='animated fadeInUp'>";
        if($accIns == 'Y')
        {
            $table .= "<div class='pull-right'><button type='button' class='btn btn-primary btn-sm btn-block m-t' onClick='getForm(\"tulisan\",\"tambah\");'><i class='fa fa-plus'></i> Tambah Data</button></div>";
        }
        $table .= "<table class='table table-striped table-bordered table-hover dataTables-example' width='99%'>";
        $table .= "<thead>";
        $table .= " <tr>                        
                        <th>No</th><th>Judul</th><th>Tema</th><th>Tgl. Publish</th><th>Media Publish</th><th>Peran</th><th>Sifat</th><th>Lingkup</th><th>Jumlah Kata</th><th>Aksi</th>
                    </tr>";
        $table .= "</thead>";
        $table .= "<tbody>";
        foreach($query->result() as $row){
            $table .= "<tr>";
                $table .= "<td width='5px'>".$i."</td>";
                $table .= "<td>".$row->JUDUL."</td>";                
                $table .= "<td>".$row->NATEMA."</td>";                    
                    $tgpublik = date('d M Y', strtotime($row->TGPUBLIK));
                $table .= "<td width='85px'>".$tgpublik."</td>";                                    
                $table .= "<td>".$row->MEDPUBLIK."</td>";
                $table .= "<td>".$row->PERAN."</td>";
                $table .= "<td>".$row->SIFAT."</td>";
                $table .= "<td>".$row->LINGKUP."</td>";
                $table .= "<td>".$row->JUMKATA."</td>";
                $table .= "<td>";
                if($accUpd == 'Y'){
                $table.=  "<button type='button' class='btn btn-outline btn-xs btn-success' title='Edit' onClick='getForm(\"tulisan\",\"update\",\"".$row->NRK."\",\"".$row->TGPUBLIK."\");'><i class='fa fa-pencil-square'></i></button> &nbsp;";
                }
                if($accDel == 'Y'){                
                $table.="<button type='button' class='btn btn-outline btn-xs btn-danger' title='Hapus' onClick='confirmHapusData(\"tulisan\",\"".$row->NRK."\",\"".$row->TGPUBLIK."\");'><i class='fa fa-trash'></i></button>";
                }            
                $table.="</td>";
            $table .= "</tr>";

            $i++;
        }
        $table .= "</tbody>";
        $table .= "</table>";
        $table .= "</div>";

        return $table;
    }

    public function getRiwayatAlamat($nrk,$ug){
        $access['mnac'] = $this->getMenuAccessBy($ug,301);
        $accIns=$access['mnac']->act_insert;
        $accUpd=$access['mnac']->act_update;
        $accDel=$access['mnac']->act_delete;

        $sql = "SELECT a.NRK, to_char(a.TGMULAI, 'YYYY-MM-DD') TGMULAI, a.ALAMAT_KTP, a.ALAMAT, a.RT, a.RW, b.NAWIL, c.NACAM, d.NAKEL, e.KETERANGAN PROP
                FROM PERS_ALAMAT_HIST a
                LEFT JOIN PERS_KOWIL_TBL b ON a.KOWIL = b.KOWIL
                LEFT JOIN PERS_KOCAM_TBL c ON a.KOCAM = c.KOCAM AND b.KOWIL = c.KOWIL
                LEFT JOIN PERS_KOKEL_TBL d ON a.KOKEL = d.KOKEL AND c.KOCAM = d.KOCAM AND b.KOWIL = d.KOWIL
                LEFT JOIN PERS_PROP_RPT e ON a.PROP = e.PROP
                WHERE a.NRK = '".$nrk."' ORDER BY TGMULAI DESC
                ";


        $query = $this->ci->db->query($sql);        

        $i = 1;

        $table  = "<div id='_content_riwayat' class='animated fadeInUp'>";
        if($accIns == 'Y')
        {
        $table .= "<div class='pull-right'><button type='button' class='btn btn-primary btn-sm btn-block m-t' onClick='getForm(\"alamat\");'><i class='fa fa-plus'></i> Tambah Data</button></div>";
        }
        $table .= "<table class='table table-striped table-bordered table-hover dataTables-example' width='99%'>";
//        $table .= "<thead>";
        $table .= " <tr>                        
                        <th>No</th><th>Alamat KTP</th><th>Alamat</th><th>Tgl. Mulai</th><th>Aksi</th>
                    </tr>";
//        $table .= "</thead>";
//        $table .= "<tbody>";
        foreach($query->result() as $row){
            $table .= "<tr>";
                $table .= "<td width='5px'>".$i."</td>";
            $table .= "<td>".$row->ALAMAT_KTP."</td>";
            $table .= "<td>".$row->ALAMAT."<br>RT ".$row->RT." RW ".$row->RW.", Kel. ".$row->NAKEL.", Kec. ".$row->NACAM."<br>".$row->NAWIL." - ".$row->PROP."</td>";
                    $tgmulai = date('d M Y', strtotime($row->TGMULAI));
                $table .= "<td width='85px'>".$tgmulai."</td>";        
                $table .= "<td >";
                if($accUpd == 'Y')
                {
                    $table.="<button type='button' class='btn btn-outline btn-xs btn-success' title='Edit' onClick='getForm(\"alamat\",\"update\",\"".$row->NRK."\",\"".$row->TGMULAI."\");'><i class='fa fa-pencil-square'></i></button> &nbsp;";
                }
                if($accDel == 'Y')
                { 
                    $table.="<button type='button' class='btn btn-outline btn-xs btn-danger' title='Hapus' onClick='confirmHapusData(\"alamat\",\"".$row->NRK."\",\"".$row->TGMULAI."\");'><i class='fa fa-trash'></i></button>";
                } 
                $table.="</td>";        
            $table .= "</tr>";

            $i++;
        }
//        $table .= "</tbody>";
        $table .= "</table>";
        $table .= "</div>";

        return $table;
    }

    public function getRiwayatPenghargaan($nrk,$ug){
        $access['mnac'] = $this->getMenuAccessBy($ug,316);
        $accIns=$access['mnac']->act_insert;
        $accUpd=$access['mnac']->act_update;
        $accDel=$access['mnac']->act_delete;

        $sql = "SELECT a.NRK, a.KDHARGA, b.NAHARGA, to_char(a.TGSK, 'YYYY-MM-DD') TGSK, a.NOSK, a.ASAL_HRG
                FROM PERS_PENGHARGAAN a
                LEFT JOIN PERS_HARGAAN_TBL b ON a.KDHARGA = b.KDHARGA
                WHERE a.NRK = '".$nrk."' ORDER BY a.TGSK DESC
                ";


        $query = $this->ci->db->query($sql);        

        $i = 1;

        $table  = "<div id='_content_riwayat' class='animated fadeInUp'>";
        if($accIns == 'Y')
        {
        $table .= "<div class='pull-right'><button type='button' class='btn btn-primary btn-sm btn-block m-t' onClick='getForm(\"penghargaan\",\"tambah\");'><i class='fa fa-plus'></i> Tambah Data</button></div>";
        }
        $table .= "<table class='table table-striped table-bordered table-hover dataTables-example' width='99%'>";
        $table .= "<thead>";
        $table .= " <tr>                        
                        <th>No</th><th>Nama Penghargaan</th><th>Tgl. SK</th><th>No. SK</th><th>Asal Penghargaan</th><th>Aksi</th>
                    </tr>";
        $table .= "</thead>";
        $table .= "<tbody>";
        foreach($query->result() as $row){
            $table .= "<tr>";
                $table .= "<td width='5px'>".$i."</td>";
                $table .= "<td>".$row->NAHARGA."</td>";                                
                    $tgsk = date('d M Y', strtotime($row->TGSK));
                $table .= "<td width='85px'>".$tgsk."</td>";                                    
                $table .= "<td>".$row->NOSK."</td>";
                $table .= "<td>".$row->ASAL_HRG."</td>";   
                $table .= "<td >";
                if($accUpd == 'Y')
                {
                    $table.="<button type='button' class='btn btn-outline btn-xs btn-success' title='Edit' onClick='getForm(\"penghargaan\",\"update\",\"".$row->NRK."\",\"".$row->KDHARGA."\");'><i class='fa fa-pencil-square'></i></button> &nbsp;";
                }
                if($accDel == 'Y')
                { 
                    $table.="<button type='button' class='btn btn-outline btn-xs btn-danger' title='Hapus' onClick='confirmHapusData(\"penghargaan\",\"".$row->NRK."\",\"".$row->KDHARGA."\");'><i class='fa fa-trash'></i></button>";
                } 
            $table.="</td>";             
            $table .= "</tr>";

            $i++;
        }
        $table .= "</tbody>";
        $table .= "</table>";
        $table .= "</div>";

        return $table;
    }

    public function getRiwayatFasilitas($nrk,$ug){
        $access['mnac'] = $this->getMenuAccessBy($ug,317);
        $accIns=$access['mnac']->act_insert;
        $accUpd=$access['mnac']->act_update;
        $accDel=$access['mnac']->act_delete;

         $sql = "SELECT a.NRK, a.JENFAS, c.KETERANGAN AS KET_FASILITAS, a.THDAPAT, a.THSAMPAI,B.KETERANGAN AS KET_INSTANSI
                 FROM PERS_KESRA a
                 LEFT JOIN PERS_JENFAS_RPT c ON a.JENFAS = c.JENFAS
                 LEFT JOIN PERS_INSTANSI_RPT B ON a.INSTANSI = b.INSTANSI
                 WHERE a.NRK = '".$nrk."' ORDER BY a.THDAPAT DESC
               ";


         $query = $this->ci->db->query($sql);        

        $i = 1;

         $table  = "<div id='_content_riwayat' class='animated fadeInUp'>";
         if($accIns == 'Y')
         {
         $table .= "<div class='pull-right'><button type='button' class='btn btn-primary btn-sm btn-block m-t' onClick='getForm(\"fasilitas\",\"tambah\");'><i class='fa fa-plus'></i> Tambah Data</button></div>";
         }
         $table .= "<table class='table table-striped table-bordered table-hover dataTables-example' width='99%'>";
         $table .= "<thead>";
         $table .= " <tr>                        
                         <th>No</th><th>Nama Fasilitas</th><th>Tahun Dapat</th><th>Tahun Sampai</th><th>Instansi</th><th>Aksi</th>
                     </tr>";
         $table .= "</thead>";
         $table .= "<tbody>";
         foreach($query->result() as $row){
             $table .= "<tr>";
                 $table .= "<td width='5px'>".$i."</td>";
                 $table .= "<td>".$row->KET_FASILITAS."</td>";                                
                 $table .= "<td>".$row->THDAPAT."</td>";                                    
                 $table .= "<td>".$row->THSAMPAI."</td>";
                 $table .= "<td>".$row->KET_INSTANSI."</td>";
                 $table .= "<td >";
                 if($accUpd == 'Y')
                 {
                    $table.="<button type='button' class='btn btn-outline btn-xs btn-success' title='Edit' onClick='getForm(\"fasilitas\",\"update\",\"".$row->NRK."\",\"".$row->JENFAS."\",\"".$row->THDAPAT."\");'><i class='fa fa-pencil-square'></i></button> &nbsp;";
                 }
                 if($accDel == 'Y')
                 {             
                    $table.="<button type='button' class='btn btn-outline btn-xs btn-danger' title='Hapus' onClick='confirmHapusData(\"fasilitas\",\"".$row->NRK."\",\"".$row->JENFAS."\",\"".$row->THDAPAT."\");'><i class='fa fa-trash'></i></button>";
                 }
             $table.= " </td>";                
             $table .= "</tr>";

             $i++;
         }
         $table .= "</tbody>";
         $table .= "</table>";
        $table .= "</div>";

        return $table;
    }

    public function getRiwayatOrganisasi($nrk,$ug){
        $access['mnac'] = $this->getMenuAccessBy($ug,318);
        $accIns=$access['mnac']->act_insert;
        $accUpd=$access['mnac']->act_update;
        $accDel=$access['mnac']->act_delete;
        $sql = "SELECT a.NRK, COALESCE(to_char(a.DARI, 'YYYY-MM-DD'),'-') DARI, COALESCE(to_char(a.SAMPAI, 'YYYY-MM-DD'),'-') SAMPAI, a.NAORGANI, b.KETERANGAN, a.KOTA
                FROM PERS_ORGAN_HIST a
                LEFT JOIN PERS_KDDUDUK_RPT b ON a.KDDUDUK = b.KDDUDUK
                WHERE a.NRK = '".$nrk."' ORDER BY a.DARI DESC
                ";


        $query = $this->ci->db->query($sql);        

        $i = 1;

        $table  = "<div id='_content_riwayat' class='animated fadeInUp'>";
        if($accIns == 'Y')
        {
        $table .= "<div class='pull-right'><button type='button' class='btn btn-primary btn-sm btn-block m-t' onClick='getForm(\"organisasi\",\"tambah\");'><i class='fa fa-plus'></i> Tambah Data</button></div>";
        }
        $table .= "<table class='table table-striped table-bordered table-hover dataTables-example' width='99%'>";
        $table .= "<thead>";
        $table .= " <tr>                        
                        <th>No</th><th>Nama Organisasi</th><th>Tgl. Bergabung</th><th>Posisi</th><th>Kota</th><th>Aksi</th>
                    </tr>";
        $table .= "</thead>";
        $table .= "<tbody>";
        foreach($query->result() as $row){
            $table .= "<tr>";
                $table .= "<td width='5px'>".$i."</td>";
                $table .= "<td>".$row->NAORGANI."</td>";                                
                    if($row->DARI != '-'){
                        $dari = date('d M Y', strtotime($row->DARI));
                    }else{
                        $dari = $row->DARI;
                    }
                    if($row->SAMPAI != '-'){
                        $sampai = date('d M Y', strtotime($row->SAMPAI));
                    }else{
                        $sampai = $row->SAMPAI;
                    }

                  
                $table .= "<td width='185px'>".$dari." s/d ".$sampai."</td>";                                    
                $table .= "<td>".$row->KETERANGAN."</td>";
                $table .= "<td>".$row->KOTA."</td>";     
                $table .= "<td>";
                if($accUpd == 'Y')
                 {
                    $table.="<button type='button' class='btn btn-outline btn-xs btn-success' title='Edit' onClick='getForm(\"organisasi\",\"update\",\"".$row->NRK."\",\"".$row->DARI."\");'><i class='fa fa-pencil-square'></i></button> &nbsp;";
                 }
                 if($accDel == 'Y')
                 {             
                    $table.="<button type='button' class='btn btn-outline btn-xs btn-danger' title='Hapus' onClick='confirmHapusData(\"organisasi\",\"".$row->NRK."\",\"".$row->DARI."\");'><i class='fa fa-trash'></i></button>";
                 }      
                $table.= "</td>";   
            $table .= "</tr>";

            $i++;
        }
        $table .= "</tbody>";
        $table .= "</table>";
        $table .= "</div>";

        return $table;
    }

    public function getRiwayatHubunganKeluarga($nrk,$ug){
        $access['mnac'] = $this->getMenuAccessBy($ug,319);
        $accIns=$access['mnac']->act_insert;
        $accUpd=$access['mnac']->act_update;
        $accDel=$access['mnac']->act_delete;

        $sql = "SELECT a.NRK, a.HUBKEL, b.NAHUBKEL, a.NAMA, a.TEMHIR, to_char(a.TALHIR, 'YYYY-MM-DD') TALHIR, to_char(a.TGNIKAH, 'YYYY-MM-DD') TGNIKAH, a.TEMNIKAH, c.KETERANGAN TUNJANGAN, d.KETERANGAN KERJAAN, a.JENKEL, to_char(a.MATI, 'YYYY-MM-DD') MATI, a.UANGDUKA
                FROM PERS_KELUARGA a
                LEFT JOIN PERS_HUBKEL_TBL b ON a.HUBKEL = b.HUBKEL
                LEFT JOIN PERS_STATTUN_RPT c ON a.STATTUN = c.STATTUN
                LEFT JOIN PERS_KDKERJA_RPT d ON a.KDKERJA = d.KDKERJA
                WHERE a.NRK = '".$nrk."' ORDER BY a.TG_UPD DESC
                ";


        $query = $this->ci->db->query($sql);        

        $i = 1;

        $table  = "<div id='_content_riwayat' class='animated fadeInUp'>";
        if($accIns == 'Y')
        {
        $table .= "<div class='pull-right'><button type='button' class='btn btn-primary btn-sm btn-block m-t' onClick='getForm(\"keluarga\",\"tambah\");'><i class='fa fa-plus'></i> Tambah Data</button></div>";
        }
        $table .= "<table class='table table-striped table-bordered table-hover dataTables-example' width='99%'>";
        $table .= "<thead>";
        $table .= " <tr>                        
                        <th>No</th><th>Hubungan</th><th>Nama</th><th>TTL</th><th>Jenis Kelamin</th><th>Tunjangan</th><th>Pekerjaan</th><th>Tempat Nikah</th><th>Meninggal Dunia ?<br><small>(Uang Duka)</small></th><th>Aksi</th>
                    </tr>";
        $table .= "</thead>";
        $table .= "<tbody>";
        foreach($query->result() as $row){
            $table .= "<tr>";
                $table .= "<td width='5px'>".$i."</td>";
                $table .= "<td>".$row->NAHUBKEL."</td>";
                $table .= "<td>".$row->NAMA."</td>";                                       
                    $tgllahir = date('d M Y', strtotime($row->TALHIR));
                $table .= "<td width='155px'>".$row->TEMHIR.", ".$tgllahir."</td>";
                $table .= "<td>".($row->JENKEL == 'P' ? 'Perempuan' : 'Laki-laki')."</td>";
                $table .= "<td>".$row->TUNJANGAN."</td>";
                $table .= "<td>".$row->KERJAAN."</td>";
                    
                $table .= "<td>".$row->TEMNIKAH."</td>";
                $table .= "<td><span class='text-danger'>".$row->MATI."</span> <small>(".$row->UANGDUKA.")</small></td>";
                $table .= "<td >";
                if($accUpd == 'Y')
                {
                    $table.="<button type='button' class='btn btn-outline btn-xs btn-success' title='Edit' onClick='getForm(\"keluarga\",\"update\",\"".$row->NRK."\",\"".$row->HUBKEL."\");'><i class='fa fa-pencil-square'></i></button> &nbsp;";
                } 
                if($accDel == 'Y')
                {   
                    $table.="<button type='button' class='btn btn-outline btn-xs btn-danger' title='Hapus' onClick='confirmHapusData(\"keluarga\",\"".$row->NRK."\",\"".$row->HUBKEL."\");'><i class='fa fa-trash'></i></button>";
                }            
                $table.= "</td>";
            $table .= "</tr>";

            $i++;
        }
        $table .= "</tbody>";
        $table .= "</table>";
        $table .= "</div>";

        return $table;
    }

    public function getRiwayatLp2p($nrk,$ug){
        $access['mnac'] = $this->getMenuAccessBy($ug,775);
        $accIns=$access['mnac']->act_insert;
        $accUpd=$access['mnac']->act_update;
        $accDel=$access['mnac']->act_delete;

         $sql = "	SELECT THPAJAK, NRK, NIP, NIP18, NAMA, KOLOK, NALOK, GOL, RUANG, TMTPANGKAT, NAJAB, TMTESELON, TALHIR, PATHIR, ALAMAT,RTALAMAT,RWALAMAT,
         				KELURAHAN, KECAMATAN, JENKEL, STAWIN, NAMISU, PEKERJAAN, JUAN,JIWA, KDWEWENANG, NOFORM, KODE2,KOJAB, KOJABF, KD, ESELON, SPMU, KLOGAD,
         				KODUK, THLAPOR,PEJABAT
                 	FROM PERS_LP2P_HIST
                	WHERE NRK = '".$nrk."' ORDER BY THPAJAK DESC
                 ";


         $query = $this->ci->db->query($sql);        

        $i = 1;

        $table  = "<div id='_content_riwayat' class='animated fadeInUp'>";
        if($accIns == 'Y')
        {
         $table .= "<div class='pull-right'><button type='button' class='btn btn-primary btn-sm btn-block m-t' onClick='getForm(\"lp2p\",\"tambah\");'><i class='fa fa-plus'></i> Tambah Data</button></div>";
        }
        $table .= "<table class='table table-striped table-bordered table-hover dataTables-example' width='99%'>";
        $table .= "<thead>";
        $table .= " <tr>                        
       	                 <th>No</th><th>NRK</th><th>NAMA</th><th>THPAJAK</th><th>ESELON</th><th>Aksi</th>
                     </tr>";
        $table .= "</thead>";
        $table .= "<tbody>";
        foreach($query->result() as $row){
             $table .= "<tr>";
                 $table .= "<td width='5px'>".$i."</td>";
                 $table .= "<td>".$row->NRK."</td>";                                
       	         $table .= "<td>".$row->NAMA."</td>";                                    
                 $table .= "<td>".$row->THPAJAK."</td>";
                 $table .= "<td>".$row->ESELON."</td>";     
                  $table .= "<td >";
                  if($accUpd == 'Y')
                  {
                        $table.="<button type='button' class='btn btn-outline btn-xs btn-success' title='Edit' onClick='getForm(\"lp2p\",\"update\",\"".$row->THPAJAK."\",\"".$row->NRK."\");'><i class='fa fa-pencil-square'></i></button> &nbsp";
                  }
                  if($accDel == 'Y')
                  {
                        $table.="<button type='button' class='btn btn-outline btn-xs btn-danger' title='Hapus' onClick='confirmHapusData(\"lp2p\",\"".$row->THPAJAK."\",\"".$row->NRK."\");'><i class='fa fa-trash'></i></button>";
                  }
                  $table.="</td>";           
             $table .= "</tr>";

             $i++;
        }
        $table .= "</tbody>";
        $table .= "</table>";
        $table .= "</div>";

        return $table;
    }

    public function getRiwayatLitsus($nrk,$ug){
        $access['mnac'] = $this->getMenuAccessBy($ug,776);
        $accIns=$access['mnac']->act_insert;
        

        $sql =  "SELECT NRK, TGL, DASAR, KEPERLUAN, HASIL, PEMERIKSA_AWAL, PEMERIKSA_ULANG, KOPANG_PEMERIKSA, NOKTP, NOMOR_CT, NOMOR_SKHP, KOTA_LITSUS
                 FROM PERS_LITSUS a
                 
                 WHERE NRK = '".$nrk."' ORDER BY TGL DESC
                 ";


         $query = $this->ci->db->query($sql);        

        $i = 1;

        $table  = "<div id='_content_riwayat' class='animated fadeInUp'>";
        if($accIns="Y")
         {
         $table .= "<div class='pull-right'><button type='button' class='btn btn-primary btn-sm btn-block m-t' onClick='getForm(\"litsus\",\"tambah\");'><i class='fa fa-plus'></i> Tambah Data</button></div>";
         }
         $table .= "<table class='table table-striped table-bordered table-hover dataTables-example' width='99%'>";
         $table .= "<thead>";
         $table .= " <tr>                        
                         <th>No</th><th>NRK</th><th>Tgl</th><th>Dasar</th><th>Keperluan</th>
                     </tr>";
         $table .= "</thead>";
         $table .= "<tbody>";
         foreach($query->result() as $row){
             $table .= "<tr>";
                 $table .= "<td width='5px'>".$i."</td>";
                 $table .= "<td>".$row->NRK."</td>";                                
                     $tgl = date('d M Y', strtotime($row->TGL));
                 $table .= "<td>".$tgl."</td>";                                    
                 $table .= "<td>".$row->DASAR."</td>";
                 $table .= "<td>".$row->KEPERLUAN."</td>";
                                
             $table .= "</tr>";

             $i++;
         }
         $table .= "</tbody>";
         $table .= "</table>";
        $table .= "</div>";

        return $table;
    }

    public function getRiwayatTpa($nrk,$ug){
        $access['mnac'] = $this->getMenuAccessBy($ug,777);
        $accIns=$access['mnac']->act_insert;
        
        $sql = "SELECT a.NOSERTA, to_char(a.TGL_TESTTPA, 'YYYY-MM-DD') TGL_TESTTPA, a.NILAI_VERBAL, a.NILAI_NUMERIC, a.NILAI_LOGIC, a.TOTAL_TPA
                FROM PERS_TPA_ASSES a
                WHERE a.NRK = '".$nrk."' ORDER BY a.TGL_TESTTPA DESC
                ";


        $query = $this->ci->db->query($sql);        

        $i = 1;

        $table  = "<div id='_content_riwayat' class='animated fadeInUp'>";
        if($accIns == 'Y')
        {
        $table .= "<div class='pull-right'><button type='button' class='btn btn-primary btn-sm btn-block m-t' onClick='getForm(\"tpa\",\"tambah\");'><i class='fa fa-plus'></i> Tambah Data</button></div>";
        }
        $table .= "<table class='table table-striped table-bordered table-hover dataTables-example' width='99%'>";
        $table .= "<thead>";
        $table .= " <tr>                        
                        <th>No</th><th>No. Peserta</th><th>Tgl. Test</th><th>Nilai Verbal</th><th>Nilai Numeric</th><th>Nilai Logic</th><th>Total TPA</th>
                    </tr>";
        $table .= "</thead>";
        $table .= "<tbody>";
        foreach($query->result() as $row){
            $table .= "<tr>";
                $table .= "<td width='5px'>".$i."</td>";
                $table .= "<td>".$row->NOSERTA."</td>";                                
                    $tg_test = date('d M Y', strtotime($row->TGL_TESTTPA));
                $table .= "<td width='85px'>".$tg_test."</td>";                                    
                $table .= "<td align='right'>".$row->NILAI_VERBAL."</td>";
                $table .= "<td align='right'>".$row->NILAI_NUMERIC."</td>";                
                $table .= "<td align='right'>".$row->NILAI_LOGIC."</td>";                
                $table .= "<td align='right'>".$row->TOTAL_TPA."</td>";
                
            $table .= "</tr>";

            $i++;
        }
        $table .= "</tbody>";
        $table .= "</table>";
        $table .= "</div>";

        return $table;
    }

    public function getRiwayatTp($nrk,$ug){
        $access['mnac'] = $this->getMenuAccessBy($ug,780);
        $accIns=$access['mnac']->act_insert;

         $sql = "SELECT NRK, NOSERTA,INTEL,NH_INTEL,KONSEP,NH_KONSEP,ALPERMAS,NH_ALPERMAS,MKOMPLEK,NH_MKOMPLEK,KPRAKTIS,NH_KPRAKTIS,WAWASAN,NH_WAWASAN
                 TOTAL_CERDAS, MOTPRES, NH_MOTPRES, EFISIEN, NH_EFISIEN, INTEGRIT, NH_INTEGRIT, STRESS, NH_STRESS, PROAKTIV_TP, NH_PROAKTIV_TP, KRJSAMA,
                 NH_KRJSAMA,TOTAL_SIKAPKER,DALDIRI, NH_DALDIRI, PSOSIAL, NH_PSOSIAL, KOMUNIKA, NH_KOMUNIKA, PERCAYA, NH_PERCAYA, TOTAL_PRIBADI, PIMPIN_TP,
                 NH_PIMPIN_TP, PRENCANA, NH_PRENCANA, KPUTUSAN, NH_KPUTUSAN, WASKAT, NH_WASKAT, MANDIRI, NH_MANDIRI, NEGOSIA, NH_NEGOSIA, TOTAL_MANAJER, 
                 TOTAL_TP, TGL_TESTTP, KATAGORI, RUMPUN, IQ, SARAN1, SARAN2, SARAN3, SARAN4, SARAN5, KEADAAN
                 FROM PERS_TP_ASSES
                 WHERE NRK = '".$nrk."'";

        $query = $this->ci->db->query($sql);        

        $i = 1;

        $table  = "<div id='_content_riwayat' class='animated fadeInUp'>.";
        if($accIns == 'Y')
        {
        $table .= "<div class='pull-right'><button type='button' class='btn btn-primary btn-sm btn-block m-t' onClick='getForm(\"tp\",\"tambah\");'><i class='fa fa-plus'></i> Tambah Data</button></div>";
        }
        $table .= "<table class='table table-striped table-bordered table-hover dataTables-example' width='99%'>";
        $table .= "<thead>";
         $table .= " <tr>                        
                         <th>No</th><th>No Serta</th><th>Total Cerdas</th><th>Total Sikapker</th><th>Total Pribadi</th><th>Total Manajer</th><th>Total TP</th><th>Tgl Testtp</th>
                     </tr>";
         $table .= "</thead>";
         $table .= "<tbody>";
         foreach($query->result() as $row){
             $table .= "<tr>";
                 $table .= "<td width='5px'>".$i."</td>";
                 $table .= "<td>".$row->NOSERTA."</td>"; 
                 $table .= "<td>".$row->TOTAL_CERDAS."</td>";
                 $table .= "<td>".$row->TOTAL_SIKAPKER."</td>";
                 $table .= "<td>".$row->TOTAL_PRIBADI."</td>";
                 $table .= "<td>".$row->TOTAL_MANAJER."</td>";
                 $table .= "<td>".$row->TOTAL_TP."</td>";                               
                     $tgl_testtp = date('d M Y', strtotime($row->TGL_TESTTP));
                 $table .= "<td width='85px'>".$tgl_testtp."</td>";                                                   
             $table .= "</tr>";

             $i++;
         }
         $table .= "</tbody>";
         $table .= "</table>";
        $table .= "</div>";

        return $table;
    }

    public function getRiwayatMakalah($nrk,$ug){
        $access['mnac'] = $this->getMenuAccessBy($ug,781);
        $accIns=$access['mnac']->act_insert;
        
         $sql = "SELECT * FROM PERS_MKL_ASSES 
                 WHERE NRK = '".$nrk."'";
        
        $query = $this->ci->db->query($sql);        

        $i = 1;

        $table  = "<div id='_content_riwayat' class='animated fadeInUp'>";
        if($accIns == 'Y')
        {
         $table .= "<div class='pull-right'><button type='button' class='btn btn-primary btn-sm btn-block m-t' onClick='getForm(\"makalah\",\"tambah\");'><i class='fa fa-plus'></i> Tambah Data</button></div>";
        }
         $table .= "<table class='table table-striped table-bordered table-hover dataTables-example' width='99%'>";
         $table .= "<thead>";
         $table .= " <tr>                        
                         <th>No</th><th>Nomor Serta</th><th>Total Topik</th><th>Total Wawasan</th><th>Total Teknik</th><th>Total Tulis</th><th>Total Seluruh</th>
                     </tr>";
         $table .= "</thead>";
         $table .= "<tbody>";
         foreach($query->result() as $row){
             $table .= "<tr>";
                 $table .= "<td width='5px'>".$i."</td>";
                 $table .= "<td>".$row->NOSERTA."</td>";                                                                   
                 $table .= "<td>".$row->TOTAL_TOPIK."</td>";
                 $table .= "<td>".$row->TOTAL_WAWASAN."</td>";
                 $table .= "<td>".$row->TOTAL_TEKNIK."</td>";
                 $table .= "<td>".$row->TOTAL_TULIS."</td>";      
                 $table .= "<td>".$row->TOTAL_SELURUH."</td>";          
             $table .= "</tr>";

             $i++;
         }
         $table .= "</tbody>";
         $table .= "</table>";
        $table .= "</div>";

        return $table;
    }

    public function getRiwayatTestGabungan($nrk){
        // $sql = "SELECT a.KDHARGA, b.NAHARGA, to_char(a.TGSK, 'YYYY-MM-DD') TGSK, a.NOSK, a.ASAL_HRG
        //         FROM PERS_PENGHARGAAN a
        //         LEFT JOIN PERS_HARGAAN_TBL b ON a.KDHARGA = b.KDHARGA
        //         WHERE a.NRK = '".$nrk."' ORDER BY a.TGSK DESC
        //         ";


        // $query = $this->ci->db->query($sql);        

        $i = 1;

        $table  = "<div id='_content_riwayat' class='animated fadeInUp'>Belum Ada Konten.";
        // $table .= "<table class='table table-striped table-bordered table-hover dataTables-example' width='99%'>";
        // $table .= "<thead>";
        // $table .= " <tr>                        
        //                 <th>No</th><th>Nama Penghargaan</th><th>Tgl. SK</th><th>No. SK</th><th>Asal Penghargaan</th>
        //             </tr>";
        // $table .= "</thead>";
        // $table .= "<tbody>";
        // foreach($query->result() as $row){
        //     $table .= "<tr>";
        //         $table .= "<td width='5px'>".$i."</td>";
        //         $table .= "<td>".$row->NAHARGA."</td>";                                
        //             $tgsk = date('d M Y', strtotime($row->TGSK));
        //         $table .= "<td width='85px'>".$tgsk."</td>";                                    
        //         $table .= "<td>".$row->NOSK."</td>";
        //         $table .= "<td>".$row->ASAL_HRG."</td>";                
        //     $table .= "</tr>";

        //     $i++;
        // }
        // $table .= "</tbody>";
        // $table .= "</table>";
        $table .= "</div>";

        return $table;
    }

    public function getMasterSPM(){ 
        $sql = "SELECT NAMA, KODE_SPM FROM PERS_TABEL_SPMU WHERE TAHUN = '2015' ORDER BY KDSORT ASC
                ";


        $query = $this->ci->db->query($sql);        

        $option  = "";
        
        foreach($query->result() as $row){            
            $option .= "<option value='".$row->KODE_SPM."'>".$row->NAMA."</option>";
        }
        
        return $option;
    }

    public function getMasterKolok($kolok=""){
        $sql = "SELECT KOLOK, NALOKL FROM PERS_LOKASI_TBL WHERE AKTIF = '1' ORDER BY NALOKL ASC
                ";


        $query = $this->ci->db->query($sql);        

        $option  = "";
        
        foreach($query->result() as $row){
            if($kolok == $row->KOLOK)
            {
                $option .= "<option selected value='".$row->KOLOK."'>".$row->KOLOK." - ".$row->NALOKL."</option>";
            }
            else
            {          
                $option .= "<option value='".$row->KOLOK."'>".$row->KOLOK." - ".$row->NALOKL."</option>";
            }
        }
        
        return $option;
    }

    public function getMasterKolokAll($kolok=""){
        $sql = "SELECT KOLOK, NALOKL FROM PERS_LOKASI_TBL ORDER BY NALOKL ASC
                ";


        $query = $this->ci->db->query($sql);        

        $option  = "";
        
        foreach($query->result() as $row){
            if($kolok == $row->KOLOK)
            {
                $option .= "<option selected value='".$row->KOLOK."'>".$row->KOLOK." - ".$row->NALOKL."</option>";
            }
            else
            {          
                $option .= "<option value='".$row->KOLOK."'>".$row->KOLOK." - ".$row->NALOKL."</option>";
            }
        }
        
        return $option;
    }

    public function getMasterKolokAllValue($kolok=""){
        $sql = "SELECT KOLOK, NALOKL FROM PERS_LOKASI_TBL WHERE KOLOK = '".$kolok."' ORDER BY NALOKL ASC
                ";
        $query = $this->ci->db->query($sql); 
        $option="";       

        foreach($query->result() as $row){
            if($kolok == $row->KOLOK)
            {
                $option.= $row->KOLOK." - ".$row->NALOKL;
            }
            else
            {          
                $option.= $row->KOLOK." - ".$row->NALOKL;
            }
        }
        
        return $option;
    }

    public function getMasterKolokAllValue2($kolok=""){
        $sql = "SELECT KOLOK, NALOKL FROM PERS_LOKASI_TBL WHERE KOLOK = '".$kolok."' ORDER BY NALOKL ASC
                ";
        $query = $this->ci->db->query($sql);
        $option="";

        foreach($query->result() as $row){
            if($kolok == $row->KOLOK)
            {
                $option.= $row->NALOKL;
            }
            else
            {
                $option.= $row->NALOKL;
            }
        }

        return $option;
    }

    public function getMasterKlogadAllValue($klogad=""){
        $sql = "SELECT KOLOK, NALOKL FROM PERS_LOKASI_TBL WHERE KOLOK = '".$klogad."' ORDER BY NALOKL ASC
                ";
        $query = $this->ci->db->query($sql);      
        $option="";  

        foreach($query->result() as $row){
            if($klogad == $row->KOLOK)
            {
                $option.= $row->KOLOK." - ".$row->NALOKL;
            }
            else
            {          
                $option.= $row->KOLOK." - ".$row->NALOKL;
            }
        }
        
        return $option;
    }

    public function getMasterKlogadNama($klogad=""){
        $sql = "SELECT KOLOK, NALOKL FROM PERS_LOKASI_TBL WHERE KOLOK = '".$klogad."' ORDER BY NALOKL ASC
                ";
        $query = $this->ci->db->query($sql);
        $option="";

        foreach($query->result() as $row){
            if($klogad == $row->KOLOK)
            {
                $option.= $row->NALOKL;
            }
            else
            {
                $option.= $row->NALOKL;
            }
        }

        return $option;
    }

    public function getMasterPejtt($pejtt=""){
        $sql = "SELECT PEJTT, KETERANGAN FROM PERS_PEJTT_RPT ORDER BY PEJTT ASC
                ";


        $query = $this->ci->db->query($sql);        

        $option  = "";
        
        foreach($query->result() as $row){
            if($pejtt == $row->PEJTT)
            {
                $option .= "<option selected value='".$row->PEJTT."'>".$row->KETERANGAN."</option>";
            }
            else
            {            
                $option .= "<option value='".$row->PEJTT."'>".$row->KETERANGAN."</option>";
            }
        }
        
        return $option;
    }

    public function getMasterJenrub($jenrub=""){
        $sql = "SELECT JENRUB, KETERANGAN FROM PERS_JENRUB_RPT ORDER BY JENRUB ASC
                ";


        $query = $this->ci->db->query($sql);        

        $option  = "";
        
        foreach($query->result() as $row){
            if($jenrub == $row->JENRUB)
            {
                $option .= "<option selected value='".$row->JENRUB."'>".$row->KETERANGAN."</option>";
            }
            else
            {            
                $option .= "<option value='".$row->JENRUB."'>".$row->KETERANGAN."</option>";
            }
        }
        
        return $option;
    }

    public function getMasterJenrubPangkat($jenrub=""){
        $sql = "SELECT JENRUB, KETERANGAN FROM PERS_JENRUB_RPT WHERE JENRUB<=4 OR JENRUB=10 ORDER BY JENRUB ASC
                ";


        $query = $this->ci->db->query($sql);        

        $option  = "";
        
        foreach($query->result() as $row){
            if($jenrub == $row->JENRUB)
            {
                $option .= "<option selected value='".$row->JENRUB."'>".$row->KETERANGAN."</option>";
            }
            else
            {            
                $option .= "<option value='".$row->JENRUB."'>".$row->KETERANGAN."</option>";
            }
        }
        
        return $option;
    }

        

    public function getMasterKojabf($kojab=""){
        $sql = "SELECT KOJAB, NAJABL FROM PERS_KOJABF_TBL ORDER BY NAJABL ASC
                ";

        $query = $this->ci->db->query($sql);        

        $option  = "";
        
        foreach($query->result() as $row){            
            if($kojab == $row->KOJAB)
            {
                $option .= "<option selected value='".$row->KOJAB."'> ".$row->KOJAB." - ".$row->NAJABL."</option>";
            }
            else
            {            
                $option .= "<option value='".$row->KOJAB."'> ".$row->KOJAB." - ".$row->NAJABL."</option>";
            }
        }
        
        return $option;
    }

    public function getMasterKojab($kolok,$kojab=""){
        $sql = "SELECT KOJAB, NAJABL FROM PERS_KOJAB_TBL WHERE KOLOK = '".$kolok."' ORDER BY NAJABL ASC
                ";

        $query = $this->ci->db->query($sql);        

        $option  = "<option value=''></option>";
        
        foreach($query->result() as $row){            
            if($kojab == $row->KOJAB)
            {
                $option .= "<option selected value='".$row->KOJAB."'>".$row->KOJAB." - ".$row->NAJABL."</option>";
            }
            else
            {            
                $option .= "<option value='".$row->KOJAB."'>".$row->KOJAB." - ".$row->NAJABL."</option>";
            }
        }
       //var_dump($option);
        return $option;
    }

    public function getMasterKojabSF($kolok,$kojab=""){
        $sql = "SELECT KOJAB, NAJABL FROM PERS_KOJAB_TBL WHERE KOLOK = '".$kolok."'
                UNION
                SELECT KOJAB, NAJABL FROM PERS_KOJABF_TBL
                ORDER BY NAJABL ASC
                ";

        $query = $this->ci->db->query($sql);

        $option  = "<option value=''></option>";

        foreach($query->result() as $row){
            if($kojab == $row->KOJAB)
            {
                $option .= "<option selected value='".$row->KOJAB."'>".$row->KOJAB." - ".$row->NAJABL."</option>";
            }
            else
            {
                $option .= "<option value='".$row->KOJAB."'>".$row->KOJAB." - ".$row->NAJABL."</option>";
            }
        }
        //var_dump($option);
        return $option;
    }

    public function getMasterKojabSFValue($kolok,$kojab=""){
        $sql = "SELECT KOJAB, NAJABL FROM PERS_KOJAB_TBL WHERE KOLOK = '".$kolok."'
                UNION
                SELECT KOJAB, NAJABL FROM PERS_KOJABF_TBL
                ORDER BY NAJABL ASC
                ";

        $query = $this->ci->db->query($sql);
        $option="";

        foreach($query->result() as $row){
            if($kojab == $row->KOJAB)
            {
                $option.= $row->KOJAB." - ".$row->NAJABL;
            }
            
        }
        return $option;
    }

    public function getMasterKojabSFNama($kolok,$kojab=""){
        $sql = "SELECT KOJAB, NAJABL FROM PERS_KOJAB_TBL WHERE KOLOK = '".$kolok."'
                UNION
                SELECT KOJAB, NAJABL FROM PERS_KOJABF_TBL
                ORDER BY NAJABL ASC
                ";

        $query = $this->ci->db->query($sql);
        $option="";

        foreach($query->result() as $row){
            if($kojab == $row->KOJAB)
            {
                $option.= $row->NAJABL;
            }

        }
        return $option;
    }

    public function getMasterEselon(){
        $sql = "SELECT ESELON, NESELON FROM PERS_ESELON_TBL ORDER BY ESELON ASC
                ";

        $query = $this->ci->db->query($sql);        

        $option  = "";
        
        foreach($query->result() as $row){            
            $option .= "<option value='".$row->ESELON."'>".$row->ESELON." - ".$row->NESELON."</option>";
        }
        
        return $option;
    }

    public function getHistEselon($eselon=""){
         $sql = "SELECT ESELON,NESELON,NESELON2 FROM PERS_ESELON_TBL ORDER BY ESELON ASC
                 ";

         $query = $this->ci->db->query($sql);        

         $option  = "";
        
         foreach($query->result() as $row){            
             if($eselon == $row->ESELON)
            {
                $option .= "<option selected value='".$row->ESELON."'>".$row->ESELON." - ".$row->NESELON2."</option>";
            }
            else
            {            
                $option .= "<option value='".$row->ESELON."'>".$row->ESELON." - ".$row->NESELON2."</option>";
            }
         }
        
         return $option;
    }

    public function getMasterPangkat($kopang=""){
        $sql = "SELECT KOPANG, GOL, NAPANG FROM PERS_PANGKAT_TBL ORDER BY KOPANG ASC
                ";

        $query = $this->ci->db->query($sql);        

        $option  = "";
        
        foreach($query->result() as $row){
            if($kopang == $row->KOPANG)
            {
                $option .= "<option selected value='".$row->KOPANG."'>".$row->KOPANG." - ".$row->NAPANG."</option>";
            }
            else
            {
                $option .= "<option value='".$row->KOPANG."'>".$row->KOPANG." - ".$row->NAPANG."</option>";
            }
        }
        
        return $option;
    }

    public function getMasterPangkat2($kopang=""){
        $sql = "SELECT KOPANG, GOL, NAPANG FROM PERS_PANGKAT_TBL WHERE KOPANG>=211 AND KOPANG<=245 ORDER BY KOPANG ASC
                ";

        $query = $this->ci->db->query($sql);        

        $option  = "";
        
        foreach($query->result() as $row){
            if($kopang == $row->KOPANG)
            {
                $option .= "<option selected value='".$row->KOPANG."'>".$row->KOPANG." - ".$row->NAPANG."</option>";
            }
            else
            {
                $option .= "<option value='".$row->KOPANG."'>".$row->KOPANG." - ".$row->NAPANG."</option>";
            }
        }
        
        return $option;
    }

    public function getMasterJendikForm($jendik){
        $sql = "SELECT JENDIK, KETERANGAN FROM PERS_JENDIK_RPT WHERE JENDIK = 1 ORDER BY JENDIK ASC
                ";

        $query = $this->ci->db->query($sql);        

        $option  = "";
        
        foreach($query->result() as $row){                        
            if($jendik == $row->JENDIK)
            {
                $option = "<option selected value='".$row->JENDIK."'>".$row->JENDIK." - ".$row->KETERANGAN."</option>";
            }
            else
            {
                $option = "<option selected value='".$row->JENDIK."'>".$row->JENDIK." - ".$row->KETERANGAN."</option>";
            }
        }
        
        return $option;
    }

    public function getMasterJendikNonForm($jendik){
        $sql = "SELECT JENDIK, KETERANGAN FROM PERS_JENDIK_RPT WHERE JENDIK <> 1 ORDER BY JENDIK ASC
                ";

        $query = $this->ci->db->query($sql);        

        $option  = "";
        
        foreach($query->result() as $row){            
            if($jendik == $row->JENDIK)
            {
                $option .= "<option selected value='".$row->JENDIK."'>".$row->JENDIK." - ".$row->KETERANGAN."</option>";
            }
            else
            {
                $option .= "<option value='".$row->JENDIK."'>".$row->JENDIK." - ".$row->KETERANGAN."</option>";
            }
        }
        
        return $option;
    }

    public function getMasterUniver($univer){
        $sql = "SELECT KDUNIVER, NAUNIVER FROM PERS_UNIVER_TBL ORDER BY KDUNIVER ASC
                ";

        $query = $this->ci->db->query($sql);        

        $option  = "";
        
        foreach($query->result() as $row){                        
            if($univer == $row->KDUNIVER)
            {
                $option .= "<option selected value='".$row->KDUNIVER."'>".$row->KDUNIVER." - ".$row->NAUNIVER."</option>";
            }
            else
            {
                $option .= "<option value='".$row->KDUNIVER."'>".$row->KDUNIVER." - ".$row->NAUNIVER."</option>";
            }
        }
        
        return $option;
    }

    public function getMasterKodik($jendik, $kodik = ""){
        $sql = "SELECT KODIK, NADIK FROM PERS_PDIDIKAN_TBL WHERE JENDIK='".$jendik."' ORDER BY KODIK ASC
                ";

        $query = $this->ci->db->query($sql);        

        $option  = "";
        
        foreach($query->result() as $row){            
            
            if($kodik == $row->KODIK)
            {
                $option .= "<option selected value='".$row->KODIK."'>".$row->KODIK." - ".$row->NADIK."</option>";
            }
            else
            {
                $option .= "<option value='".$row->KODIK."'>".$row->KODIK." - ".$row->NADIK."</option>";
            }
        }
        
        return $option;
    }

    public function getMasaKerjaByKopang($kopang,$ttmasker=""){
        $sql = "SELECT KOPANG, TTMASKER FROM PERS_GAPOK_TBL WHERE KOPANG = '".$kopang."' ORDER BY TTMASKER ASC";                

        $query = $this->ci->db->query($sql);        

        $option  = "";
        
        foreach($query->result() as $row){
            if($ttmasker == $row->TTMASKER)
            {
                $option .= "<option selected value='".$row->TTMASKER."'>".$row->TTMASKER."</option>";
            }
            else
            {
                $option .= "<option value='".$row->TTMASKER."'>".$row->TTMASKER."</option>";
            }
        }
        
        return $option;
    }

    public function getMaxMasaKerjaByKopang($kopang)
    {
        $sql="SELECT MAX(TTMASKER) FROM PERS_GAPOK_TBL WHERE KOPANG = '".$kopang."'";

        $query=$this->ci->db->query($sql)->row();

        return $query;

    }

    

    public function getJenisHukdis($hukdis=""){
        $sql = "SELECT JENHUKDIS, KETERANGAN FROM PERS_JENHUKDIS_RPT ORDER BY KETERANGAN ASC";                

        $query = $this->ci->db->query($sql);        

        $option  = "";
        
        foreach($query->result() as $row){
            if($hukdis == $row->JENHUKDIS)
            {
                $option .= "<option selected value='".$row->JENHUKDIS."'>".$row->KETERANGAN."</option>";
            }
            else
            {
                $option .= "<option value='".$row->JENHUKDIS."'>".$row->KETERANGAN."</option>";
            }
        }
        
        return $option;
    }

    public function getJenisCuti($jencuti=""){
        $sql = "SELECT JENCUTI, KETERANGAN FROM PERS_JENCUTI_RPT ORDER BY KETERANGAN ASC";

        $query = $this->ci->db->query($sql);        

        $option  = "";
        
        foreach($query->result() as $row){
            if($jencuti == $row->JENCUTI)
            {
                $option .= "<option selected value='".$row->JENCUTI."'>".$row->KETERANGAN."</option>";
            }
            else
            {
                $option .= "<option value='".$row->JENCUTI."'>".$row->KETERANGAN."</option>";
            }
        }
        
        return $option;
    }

    public function getJenisUsaha($jenusaha=""){
        $sql = "SELECT JENUSAHA, KETERANGAN FROM PERS_JENUSAHA_RPT ORDER BY KETERANGAN ASC";

        $query = $this->ci->db->query($sql);        

        $option  = "";
        
        foreach($query->result() as $row){
            if($jenusaha == $row->JENUSAHA)
            {
                $option .= "<option selected value='".$row->JENUSAHA."'>".$row->KETERANGAN."</option>";
            }
            else
            {
                $option .= "<option value='".$row->JENUSAHA."'>".$row->KETERANGAN."</option>";
            }
        }
        
        return $option;
    }

    public function getKodeSeminar($kdsemi=""){
        $sql = "SELECT KDSEMI, KETERANGAN FROM PERS_KDSEMI_RPT ORDER BY KETERANGAN ASC";

        $query = $this->ci->db->query($sql);        

        $option  = "";
        
        foreach($query->result() as $row){
            if($kdsemi == $row->KDSEMI)
            {
                $option .= "<option selected value='".$row->KDSEMI."'>".$row->KETERANGAN."</option>";
            }
            else
            {
                $option .= "<option value='".$row->KDSEMI."'>".$row->KETERANGAN."</option>";
            }
        }
        
        return $option;
    }

    public function getKodeTemaSeminardanTulisan($kdtema=""){
        $sql = "SELECT KDTEMA, NATEMA FROM PERS_TEMA_TBL ORDER BY NATEMA ASC";

        $query = $this->ci->db->query($sql);        

        $option  = "";
        
        foreach($query->result() as $row){
            if($kdtema == $row->KDTEMA)
            {
                $option .= "<option selected value='".$row->KDTEMA."'>".$row->NATEMA."</option>";
            }
            else
            {
                $option .= "<option value='".$row->KDTEMA."'>".$row->NATEMA."</option>";
            }
        }
        
        return $option;
    }

    public function getKodePeranSeminar($kdperan=""){
        $sql = "SELECT KDPERAN, KETERANGAN FROM PERS_KDPERANS_RPT ORDER BY KETERANGAN ASC";

        $query = $this->ci->db->query($sql);        

        $option  = "";
        
        foreach($query->result() as $row){
            if($kdperan == $row->KDPERAN)
            {
                $option .= "<option selected value='".$row->KDPERAN."'>".$row->KETERANGAN."</option>";
            }
            else
            {
                $option .= "<option value='".$row->KDPERAN."'>".$row->KETERANGAN."</option>";
            }
        }
        
        return $option;
    }

    public function getKodePeranTulisan($kdperan=""){
        $sql = "SELECT KDPERAN, KETERANGAN FROM PERS_KDPERANT_RPT ORDER BY KETERANGAN ASC";

        $query = $this->ci->db->query($sql);        

        $option  = "";
        
        foreach($query->result() as $row){
            if($kdperan == $row->KDPERAN)
            {
                $option .= "<option selected value='".$row->KDPERAN."'>".$row->KETERANGAN."</option>";
            }
            else
            {
                $option .= "<option value='".$row->KDPERAN."'>".$row->KETERANGAN."</option>";
            }
        }
        
        return $option;
    }

    public function getJenisHukadmin($hukadm=""){
        $sql = "SELECT JENHUKADM, KETERANGAN FROM PERS_JENHUKADM_RPT ORDER BY KETERANGAN ASC";                

        $query = $this->ci->db->query($sql);        

        $option  = "";
        
        foreach($query->result() as $row){
            if($hukadm == $row->JENHUKADM)
            {
                $option .= "<option selected value='".$row->JENHUKADM."'>".$row->KETERANGAN."</option>";
            }
            else
            {
                $option .= "<option value='".$row->JENHUKADM."'>".$row->KETERANGAN."</option>";
            }
        }
        
        return $option;
    }

    public function getKodeSifatTulisan($kdsifat=""){
        $sql = "SELECT KDSIFAT,KETERANGAN FROM PERS_KDSIFAT_RPT ORDER BY KETERANGAN ASC";

        $query = $this->ci->db->query($sql);        

        $option  = "";
        
        foreach($query->result() as $row){
            if($kdsifat == $row->KDSIFAT)
            {
                $option .= "<option selected value='".$row->KDSIFAT."'>".$row->KETERANGAN."</option>";
            }
            else
            {
                $option .= "<option value='".$row->KDSIFAT."'>".$row->KETERANGAN."</option>";
            }
        }
        
        return $option;
    }

    public function getKodeLingkupTulisan($kdlingkup=""){
        $sql = "SELECT KDLINGKUP,KETERANGAN FROM PERS_KDLINGKUP_RPT ORDER BY KETERANGAN ASC";

        $query = $this->ci->db->query($sql);        

        $option  = "";
        
        foreach($query->result() as $row){
            if($kdlingkup == $row->KDLINGKUP)
            {
                $option .= "<option selected value='".$row->KDLINGKUP."'>".$row->KETERANGAN."</option>";
            }
            else
            {
                $option .= "<option value='".$row->KDLINGKUP."'>".$row->KETERANGAN."</option>";
            }
        }
        
        return $option;
    }

    public function getKodeJumlahKataTulisan($jumkata=""){
        $sql = "SELECT KDJUMKATA,KETERANGAN FROM PERS_KDJUMKATA_RPT";                

        $query = $this->ci->db->query($sql);        

        $option  = "";
        
        foreach($query->result() as $row){
            if($jumkata == $row->KDJUMKATA)
            {
                $option .= "<option selected value='".$row->KDJUMKATA."'>".$row->KETERANGAN."</option>";
            }
            else
            {
                $option .= "<option value='".$row->KDJUMKATA."'>".$row->KETERANGAN."</option>";
            }
        }
        
        return $option;
    }

    public function getJenisPenghargaan($kdharga=""){
        $sql = "SELECT KDHARGA, NAHARGA FROM PERS_HARGAAN_TBL";

        $query = $this->ci->db->query($sql);        

        $option  = "";

        foreach($query->result() as $row){
            if($kdharga == $row->KDHARGA)
            {
                $option .= "<option selected value='".$row->KDHARGA."'>".$row->NAHARGA."</option>";
            }
            else
            {
                $option .= "<option value='".$row->KDHARGA."'>".$row->NAHARGA."</option>";
            }
        }
        
        return $option;
    }

    public function getKodeKedudukan($kdduduk=""){
        $sql = "SELECT KDDUDUK, KETERANGAN FROM PERS_KDDUDUK_RPT";

        $query = $this->ci->db->query($sql);        

        $option  = "";
        
        foreach($query->result() as $row){
            if($kdduduk == $row->KDDUDUK)
            {
                $option .= "<option selected value='".$row->KDDUDUK."'>".$row->KETERANGAN."</option>";
            }
            else
            {
                $option .= "<option value='".$row->KDDUDUK."'>".$row->KETERANGAN."</option>";
            }
        }
        
        return $option;
    }

    public function getKodeHubkel($hubkel=""){
        $sql = "SELECT HUBKEL, NAHUBKEL FROM PERS_HUBKEL_TBL ORDER BY HUBKEL ASC";

        $query = $this->ci->db->query($sql);        

        $option  = "";
        
        foreach($query->result() as $row){
            if($hubkel == $row->HUBKEL)
            {
                $option .= "<option selected value='".$row->HUBKEL."'>".$row->NAHUBKEL."</option>";
            }
            else
            {
                $option .= "<option value='".$row->HUBKEL."'>".$row->NAHUBKEL."</option>";
            }
        }
        
        return $option;
    }

    public function getKodeStattun($stattun=""){
        $sql = "SELECT STATTUN, KETERANGAN FROM PERS_STATTUN_RPT ORDER BY STATTUN ASC";

        $query = $this->ci->db->query($sql);        

        $option  = "";
        
        foreach($query->result() as $row){
            if($stattun == $row->STATTUN)
            {
                $option .= "<option selected value='".$row->STATTUN."'>".$row->KETERANGAN."</option>";
            }
            else
            {
                $option .= "<option value='".$row->STATTUN."'>".$row->KETERANGAN."</option>";
            }
        }
        
        return $option;
    }

     public function getKodeKerja($kdkerja=""){
        $sql = "SELECT KDKERJA, KETERANGAN FROM PERS_KDKERJA_RPT ORDER BY KDKERJA ASC";

        $query = $this->ci->db->query($sql);        

        $option  = "";
        
        foreach($query->result() as $row){
            if($kdkerja == $row->KDKERJA)
            {
                $option .= "<option selected value='".$row->KDKERJA."'>".$row->KETERANGAN."</option>";
            }
            else
            {
                $option .= "<option value='".$row->KDKERJA."'>".$row->KETERANGAN."</option>";
            }
        }
        
        return $option;
    }

    public function getUangDuka($uangduka=""){
        $sql = "SELECT UANGDUKA, KETERANGAN FROM PERS_UANGDUKA_RPT ORDER BY UANGDUKA ASC";

        $query = $this->ci->db->query($sql);        

        $option  = "";
        
        foreach($query->result() as $row){
            if($uangduka == $row->UANGDUKA)
            {
                $option .= "<option selected value='".$row->UANGDUKA."'>".$row->KETERANGAN."</option>";
            }
            else
            {
                $option .= "<option value='".$row->UANGDUKA."'>".$row->KETERANGAN."</option>";
            }
        }
        
        return $option;
    }

    public function getMasterFasilitas($jenfas=""){
        $sql = "SELECT JENFAS, KETERANGAN FROM PERS_JENFAS_RPT ORDER BY JENFAS";

        $query = $this->ci->db->query($sql);        

        $option  = "";
        
        foreach($query->result() as $row){
            if($jenfas == $row->JENFAS)
            {
                $option .= "<option selected value='".$row->JENFAS."'>".$row->JENFAS."-".$row->KETERANGAN."</option>";
            }
            else
            {
                $option .= "<option value='".$row->JENFAS."'>".$row->JENFAS."-".$row->KETERANGAN."</option>";
            }
        }
        
        return $option;
    }

    public function getMasterInstansi($instansi=""){
        $sql = "SELECT INSTANSI, KETERANGAN FROM PERS_INSTANSI_RPT";

        $query = $this->ci->db->query($sql);        

        $option  = "";
        
        foreach($query->result() as $row){
            if($instansi == $row->INSTANSI)
            {
                $option .= "<option selected value='".$row->INSTANSI."'>".$row->INSTANSI."-".$row->KETERANGAN."</option>";
            }
            else
            {
                $option .= "<option value='".$row->INSTANSI."'>".$row->INSTANSI."-".$row->KETERANGAN."</option>";
            }
        }
        
        return $option;
    }

    public function getMasterInstansi2($instansi=""){
        $sql = "SELECT INSTANSI, KETERANGAN FROM PERS_INSTANSI_RPT";

        $query = $this->ci->db->query($sql);

        $option  = "";

        foreach($query->result() as $row){
            if($instansi == $row->INSTANSI)
            {
                $option .= "<option selected value='".$row->INSTANSI."'>".$row->INSTANSI."-".$row->KETERANGAN."</option>";
            }
            else if('2' == $row->INSTANSI)
            {
                $option .= "<option selected value='".$row->INSTANSI."'>".$row->INSTANSI."-".$row->KETERANGAN."</option>";
            } else
            {
                $option .= "<option value='".$row->INSTANSI."'>".$row->INSTANSI."-".$row->KETERANGAN."</option>";
            }
        }

        return $option;
    }

    public function getWilayah($kowil=""){
        $sql = "SELECT KOWIL, NAWIL FROM PERS_KOWIL_TBL";

        $query = $this->ci->db->query($sql);        

        $option  = "";
        
        foreach($query->result() as $row){
            if($kowil == $row->KOWIL)
            {
                $option .= "<option selected value='".$row->KOWIL."'>".$row->KOWIL."-".$row->NAWIL."</option>";
            }
            else
            {
                $option .= "<option value='".$row->KOWIL."'>".$row->KOWIL."-".$row->NAWIL."</option>";
            }
        }
        
        return $option;
    }

    public function getKecamatan($kowil, $kokec=""){        
        $where = " WHERE KOWIL = '".$kowil."' ";        
        $sql = "SELECT KOWIL, KOCAM, NACAM FROM PERS_KOCAM_TBL ".$where;        

        $query = $this->ci->db->query($sql);        

        $option  = "";
        
        foreach($query->result() as $row){
            if($kokec == $row->KOCAM)
            {
                $option .= "<option selected value='".$row->KOCAM."'>".$row->KOCAM."-".$row->NACAM."</option>";
            }
            else
            {
                $option .= "<option value='".$row->KOCAM."'>".$row->KOCAM."-".$row->NACAM."</option>";
            }
        }
        
        return $option;
    }

    public function getKelurahan($kowil, $kocam, $kokel=""){        
        $where = " AND KOWIL = '".$kowil."' ";
        $where .= " AND KOCAM = '".$kocam."' ";
        $sql = "SELECT KOWIL, KOCAM, KOKEL, NAKEL FROM PERS_KOKEL_TBL WHERE 1=1 ".$where;

        $query = $this->ci->db->query($sql);        

        $option  = "";
        
        foreach($query->result() as $row){
            if($kokel == $row->KOKEL)
            {
                $option .= "<option selected value='".$row->KOKEL."'>".$row->KOKEL."-".$row->NAKEL."</option>";
            }
            else
            {
                $option .= "<option value='".$row->KOKEL."'>".$row->KOKEL."-".$row->NAKEL."</option>";
            }
        }
        
        return $option;
    }

    public function getPropinsi($prop=""){
        $sql = "SELECT PROP, KETERANGAN FROM PERS_PROP_RPT";

        $query = $this->ci->db->query($sql);        

        $option  = "";
        
        foreach($query->result() as $row){
            if($prop == $row->PROP)
            {
                $option .= "<option selected value='".$row->PROP."'>".$row->PROP."-".$row->KETERANGAN."</option>";
            }
            else
            {
                $option .= "<option value='".$row->PROP."'>".$row->PROP."-".$row->KETERANGAN."</option>";
            }
        }
        
        return $option;
    }

    function getListStawin($stawin=""){
         $sql = "SELECT STAWIN, KETERANGAN FROM PERS_STAWIN_RPT";
         $id = $this->ci->db->query($sql);
		 
         $option = "";
         foreach($id->result() as $row){
             if($stawin == $row->STAWIN){
                 $option .= "<option selected value='".$row->STAWIN."'>".$row->STAWIN." - ".$row->KETERANGAN."</option>";
             }else{
                 $option .= "<option value='".$row->STAWIN."'>".$row->STAWIN." - ".$row->KETERANGAN."</option>";
             }
         }

         return $option;
     }

     function getListAgamaValue($agama=""){
         $sql = "SELECT AGAMA, KETERANGAN FROM PERS_AGAMA_RPT";
         $id = $this->ci->db->query($sql);
		 $option="";
         foreach($id->result() as $row){
             if($agama == $row->AGAMA){
                 $option = $row->KETERANGAN;
         }
        }
         return $option;
     }

     function getListStawinValue($stawin=""){
         $sql = "SELECT STAWIN, KETERANGAN FROM PERS_STAWIN_RPT";
         $id = $this->ci->db->query($sql);
		 $option="";
         foreach($id->result() as $row){
             if($stawin == $row->STAWIN){
                 $option = $row->KETERANGAN;
             }
         }

         return $option;
     }

     function getListStapegValue($stapeg=""){
         $sql = "SELECT STAPEG, KETERANGAN FROM PERS_STAPEG_RPT";
         $id = $this->ci->db->query($sql);
		 $option="";
         foreach($id->result() as $row){
             if($stapeg == $row->STAPEG){
                 $option = $row->KETERANGAN;
             }
         }

         return $option;
     }

     function getListJenpegValue($jenpeg=""){
         $sql = "SELECT JENPEG, KETERANGAN FROM PERS_JENPEG_RPT WHERE JENPEG ='".$jenpeg."'";
         $id = $this->ci->db->query($sql);
		 $option="";
         foreach($id->result() as $row){
             if($jenpeg == $row->JENPEG){
                 $option = $row->KETERANGAN;
             }
         }

         return $option;
     }

     function getListKowilValue($kowil=""){
         $sql = "SELECT KOWIL, NAWIL FROM PERS_KOWIL_TBL WHERE KOWIL ='".$kowil."'";
         $id = $this->ci->db->query($sql);
		$option="";
         foreach($id->result() as $row){
             if($kowil == $row->KOWIL){
                 $option = $row->NAWIL;
             }
         }
         return $option;
     }

     function getListKocamValue($kocam="",$kowil=""){
         $sql = "SELECT KOCAM, NACAM FROM PERS_KOCAM_TBL WHERE KOWIL ='".$kowil."' AND KOCAM ='".$kocam."'";
         $id = $this->ci->db->query($sql);
		$option="";
         foreach($id->result() as $row){
             if($kocam == $row->KOCAM){
                 $option = $row->NACAM;
             }
         }

         return $option;
     }

     function getListKokelValue($kokel="",$kowil="",$kocam=""){
         $sql = "SELECT KOKEL, NAKEL FROM PERS_KOKEL_TBL WHERE KOWIL ='".$kowil."' AND KOCAM ='".$kocam."' AND KOKEL ='".$kokel."'";
         $id = $this->ci->db->query($sql);
		 $option="";
         foreach($id->result() as $row){
             if($kokel == $row->KOKEL){
                 $option = $row->NAKEL;
             }
         }

         return $option;
     }

     function getListPropValue($prop=""){
         $sql = "SELECT PROP, KETERANGAN FROM PERS_PROP_RPT WHERE PROP = '".$prop."'";
         $id = $this->ci->db->query($sql);
		 $option="";
         foreach($id->result() as $row){
             if($prop == $row->PROP){
                 $option = $row->KETERANGAN;
             }
         }
         return $option;
     }
	 
	 function getListJendikcpsValue($jendikcps=""){
         $sql = "SELECT JENDIK, KETERANGAN FROM PERS_JENDIK_RPT";
         $id = $this->ci->db->query($sql);

         $option = "";
         foreach($id->result() as $row){
             if($jendikcps == $row->JENDIK){
                 $option = $row->KETERANGAN;
             } else {
                 $option = '-';
             }
         }
		 return $option;
	 }
	 
	 function getListKodikcps($kodikcps=""){
         $sql = "SELECT KODIK, NADIK FROM PERS_PDIDIKAN_TBL";
         $id = $this->ci->db->query($sql);

         $option = "";
         foreach($id->result() as $row){
             if($kodikcps == $row->KODIK){
                 $option = $row->NADIK;
             } else {
                 $option = '-';
             }
         }

         return $option;
     }


    public function getLastPangkat($nrk,$kopang = ""){

        if($kopang != ""){
            $where = "AND a.KOPANG = '".$kopang."' ";
        }else{
            $where = "";
        }

        $sql = "SELECT a.KOPANG, b.NAPANG, to_char(a.TMT, 'DD-MM-YYYY') TMT, a.NOSK, to_char(a.TGSK, 'DD-MM-YYYY') TGSK
                FROM PERS_PANGKAT_HIST a 
                LEFT JOIN PERS_PANGKAT_TBL b ON a.KOPANG = b.KOPANG
                WHERE a.NRK = '".$nrk."' AND ROWNUM <= 1 $where 
                ORDER BY a.TMT DESC
                ";

        $query = $this->ci->db->query($sql)->row();        
        
        return $query;
    }

    public function getKojabHistBy($nrk,$tmt,$kolok,$kojab){
        $sql = "SELECT a.NRK, to_char(a.TMT, 'DD-MM-YYYY') TMT, a.NOSK, to_char(a.TGSK, 'DD-MM-YYYY') TGSK, a.KOLOK, a.KOJAB, a.CKOJABF,
                a.KDSORT, a.KREDIT, a.STATUS, a.PEJTT, to_char(a.TGAKHIR, 'DD-MM-YYYY') TGAKHIR, a.ESELON, a.KOPANG, a.KLOGAD, a.SPMU, to_char(a.TMTPENSIUN, 'DD-MM-YYYY') TMTPENSIUN
                FROM PERS_JABATAN_HIST a
                WHERE a.NRK = '".$nrk."' AND a.TMT = TO_DATE('".$tmt."', 'DD-MM-YYYY') AND a.KOLOK = '".$kolok."' AND a.KOJAB = '".$kojab."'
                ORDER BY a.TMT DESC, a.KOLOK, a.KOJAB
                ";

        $query = $this->ci->db->query($sql)->row();        
        
        return $query;
    }

    public function getKojabfHistBy($nrk,$tmt,$kojab){
        $sql = "SELECT a.NRK, to_char(a.TMT, 'DD-MM-YYYY') TMT, a.NOSK, to_char(a.TGSK, 'DD-MM-YYYY') TGSK, a.KOLOK, a.KOJAB,
                a.KDSORT, a.KREDIT, a.STATUS, a.PEJTT, to_char(a.TGAKHIR, 'DD-MM-YYYY') TGAKHIR, a.KOPANG,a.KLOGAD, a.SPMU, to_char(a.TMTPENSIUN, 'DD-MM-YYYY') TMTPENSIUN
                FROM PERS_JABATANF_HIST a
                WHERE a.NRK = '".$nrk."' AND a.TMT = TO_DATE('".$tmt."', 'DD-MM-YYYY') AND a.KOJAB = '".$kojab."'
                ORDER BY a.TMT DESC, a.KOLOK, a.KOJAB
                ";

        $query = $this->ci->db->query($sql)->row();        
        
        return $query;
    }

    public function getPendidikanHistBy($nrk,$jendik,$kodik){
        $sql = "SELECT NRK, JENDIK, KODIK, NASEK, UNIVER, KOTSEK, to_char(TGIJAZAH, 'DD-MM-YYYY') TGIJAZAH, NOIJAZAH,
                to_char(TGACCKOP, 'DD-MM-YYYY') TGACCKOP, NOACCKOP, to_char(TGMULAI, 'DD-MM-YYYY') TGMULAI, 
                to_char(TGAKHIR, 'DD-MM-YYYY') TGAKHIR, JUMJAM, SELENGGARA, ANGKATAN,TITELDEPAN,TITELBELAKANG
                FROM PERS_PENDIDIKAN WHERE NRK = '".$nrk."' AND JENDIK = '".$jendik."' AND KODIK = '".$kodik."'
                ";

        $query = $this->ci->db->query($sql)->row();        
        
        return $query;
    }

    public function getTitel($nrk)
    {
        $sql = "SELECT NRK, TITEL, TITELDEPAN 
                FROM PERS_PEGAWAI1
                WHERE NRK = '".$nrk."'";
        $query = $this->ci->db->query($sql)->row();        
        
        return $query;
    }

    public function getGapokHistBy($nrk,$tmt,$gapok){
        $sql = "SELECT NRK, TMT, GAPOK, JENRUB, KOPANG, TTMASKER, BBMASKER, TTMASYAD, BBMASYAD, KOLOK, NOSK, TGSK,KLOGAD, SPMU,TAHUN_REFGAJI
                FROM PERS_RB_GAPOK_HIST
                WHERE NRK = '".$nrk."' AND GAPOK = '".$gapok."' AND TMT = TO_DATE('".$tmt."', 'YYYY-MM-DD')
                ORDER BY TMT DESC
                ";

        $query = $this->ci->db->query($sql)->row();        
        
        return $query;
    }

    public function getHukdisHistBy($nrk,$tgsk){
        $sql = "SELECT NRK, TGSK, NOSK, JENHUKDIS, TGMULAI, TGAKHIR, PEJTT,TMTMULAI_STOPTKD,TMTAKHIR_STOPTKD, JMLBLN_STOPTKD, KET
                FROM PERS_DISIPLIN_HIST WHERE NRK = '".$nrk."' AND TGSK = TO_DATE('".$tgsk."', 'YYYY-MM-DD')
                ";

        $query = $this->ci->db->query($sql)->row();        
        
        return $query;
    }

    public function getHukadmHistBy($nrk,$tgsk){
        $sql = "SELECT NRK, TGSK, NOSK, JENHUKADM, TGMULAI, TGAKHIR, PEJTT,TMTMULAI_STOPTKD,TMTAKHIR_STOPTKD, JMLBLN_STOPTKD, KET
                FROM PERS_ADMIN_HIST WHERE NRK = '".$nrk."' AND TGSK = TO_DATE('".$tgsk."', 'YYYY-MM-DD')
                ";

        $query = $this->ci->db->query($sql)->row();        
        
        return $query;
    }

    public function getDp3HistBy($nrk,$tahun){
        $sql = "SELECT NRK, TAHUN, SETIA, PRESTASI, TGGJAWAB, TAAT, JUJUR, KERJASAMA, PRAKARSA, PIMPIN, JUMLAH, RATA 
                FROM PERS_DP3 WHERE NRK = '".$nrk."' AND TAHUN = '".$tahun."'
                ";

        $query = $this->ci->db->query($sql)->row();        
        
        return $query;
    }

    public function getAbsensiHistBy($nrk,$thbl){
        $sql = "SELECT THBL, NRK, NIP18, NAMA_ABS, KLOGAD, NAKLOGAD, NAGOL, ALFA, IZIN, SAKIT, CUTI, JAMPULANGCEPAT, 
                JAMTERLAMBAT, KINERJA, PERIODE, D_PROSES, E_PROSES, CUTIAPENTING, CUTIBERSALIN, CUTIBESAR, CUTISAKIT
                FROM PERS_TUNDA_ABSENSI WHERE NRK = '".$nrk."' AND THBL = '".$thbl."'
                ";

        $query = $this->ci->db->query($sql)->row();        
        
        return $query;
    }

    public function getCutiHistBy($nrk,$tmt){
        $sql = "SELECT NRK, TMT, JENCUTI, TGAKHIR, NOSK, TGSK, PEJTT
                FROM PERS_CUTI_HIST WHERE NRK = '".$nrk."' AND TMT = TO_DATE('".$tmt."', 'YY-MM-DD')
                ";

        $query = $this->ci->db->query($sql)->row();        
        
        return $query;
    }

    public function getPembatasanHistBy($nrk,$tmt){
        $sql = "SELECT NRK, TMT, JENUSAHA, TGAKHIR, TGSIZIN, PEJTT, NOSIZIN 
                FROM PERS_PEMBATASAN WHERE NRK = '".$nrk."' AND TMT = TO_DATE('".$tmt."', 'YY-MM-DD')
                ";

        $query = $this->ci->db->query($sql)->row();        
        
        return $query;
    }

    public function getSeminarHistBy($nrk,$tgmulai){
        $sql = "SELECT NRK, TGMULAI, TGSELESAI, NASEMI, KDSEMI, KDTEMA, BADAN, TEMPAT, KDPERAN
                FROM PERS_SEMINAR_HIST WHERE NRK = '".$nrk."' AND TGMULAI = TO_DATE('".$tgmulai."', 'YY-MM-DD')
                ";

        $query = $this->ci->db->query($sql)->row();        
        
        return $query;
    }

    public function getTulisanHistBy($nrk,$tgpublik){
        $sql = "SELECT NRK, TGPUBLIK, JUDUL, KDTEMA, KDSIFAT, KDPERAN, KDLINGKUP, KDJUMKATA, MEDPUBLIK
                FROM PERS_TULISAN_HIST WHERE NRK = '".$nrk."' AND TGPUBLIK = TO_DATE('".$tgpublik."', 'YY-MM-DD')
                ";

        $query = $this->ci->db->query($sql)->row();        
        
        return $query;
    }

    public function getAlamatHistBy($nrk,$tgmulai){
        $sql = "SELECT NRK, TGMULAI, ALAMAT_KTP, ALAMAT, RT, RW, KOWIL, KOCAM, KOKEL, PROP
                FROM PERS_ALAMAT_HIST WHERE NRK = '".$nrk."' AND TGMULAI = TO_DATE('".$tgmulai."', 'YY-MM-DD')
                ";

        $query = $this->ci->db->query($sql)->row();        
        
        return $query;
    }

    public function getPenghargaanHistBy($nrk,$kdharga){
        $sql = "SELECT NRK, KDHARGA, TGSK, NOSK, ASAL_HRG, JNASAL 
                FROM PERS_PENGHARGAAN WHERE NRK = '".$nrk."' AND KDHARGA = '".$kdharga."'
                ";

        $query = $this->ci->db->query($sql)->row();        
        
        return $query;
    }

    public function getOrganisasiHistBy($nrk,$dari){
        $sql = "SELECT NRK, DARI, SBLSSD, NAORGANI, KDDUDUK, SAMPAI, KOTA 
                FROM PERS_ORGAN_HIST WHERE NRK = '".$nrk."' AND DARI = TO_DATE('".$dari."', 'YY-MM-DD')
                ";

        $query = $this->ci->db->query($sql)->row();        
        
        return $query;
    }

    public function getFasilitasHistBy($nrk,$jenfas,$thdapat){
        $sql = "SELECT NRK, JENFAS, THDAPAT, THSAMPAI, INSTANSI, KETFAS, KOWIL,KOCAM,KOKEL, KLOGAD, SPMU
                FROM PERS_KESRA WHERE NRK = '".$nrk."' AND JENFAS = ".$jenfas." AND THDAPAT = '".$thdapat."'
                ";

        $query = $this->ci->db->query($sql)->row();        
        
        return $query;
    }

    public function getKeluargaHistBy($nrk,$hubkel){
        $sql = "SELECT NRK, HUBKEL, NAMA, TEMHIR, TALHIR, TEMNIKAH, TGNIKAH,
                STATTUN, KDKERJA, JENKEL, MATI, UANGDUKA,
                NIK, NOAKTENIKAH, NOAKTECERAI, TGAKTECERAI,
                NOAKTIFSEK, TGAKTIFSEK, NOSURATMATI, TGSURATMATI
                FROM PERS_KELUARGA WHERE NRK = '".$nrk."' AND HUBKEL = '".$hubkel."'
                ";

        $query = $this->ci->db->query($sql)->row();        
        
        return $query;
    }

    public function getLP2PHistBy($thpajak, $nrk){
        $sql = "SELECT THPAJAK, NRK, NIP, NIP18,NAMA,KOLOK, NALOK,GOL,RUANG,TMTPANGKAT,NAJAB,TMTESELON, TALHIR, PATHIR, ALAMAT, RTALAMAT, 
        		RWALAMAT,KELURAHAN,KECAMATAN,JENKEL, STAWIN,NAMISU, PEKERJAAN, JUAN, JIWA, KDWEWENANG,NOFORM,KODE2, KOJAB, KOJABF, KD, ESELON, SPMU, KLOGAD, KODUK, THLAPOR,PEJABAT
                FROM PERS_LP2P_HIST WHERE THPAJAK = '".$thpajak."' AND NRK = '".$nrk."'
                ";

        $query = $this->ci->db->query($sql)->row();        
        
        return $query;
    }

    public function getLitsusHistBy($nrk, $tgl){
        $sql = "SELECT NRK, TGL, DASAR, KEPERLUAN, HASIL, PEMERIKSA_AWAL, PEMERIKSA_ULANG, KOPANG_PEMERIKSA,NOKTP,BAPAK_TIRI, IBU_TIRI,
                NOMOR_CT, NOMOR_SKHP,KOTA_LITSUS
                FROM PERS_LITSUS WHERE NRK = '".$nrk." AND TGL = TO_DATE('".$tgl."', 'YY-MM-DD')
                ";

        $query = $this->ci->db->query($sql)->row();        
        
        return $query;
    }

    public function getTupoksiBy($nrk,$tupoksi_id){
        $sql = "SELECT tupoksi_id,kolok,kojab,no_urut,uraian,tahun,dasar_hukum,aktif
                FROM ref_tupoksi  WHERE tupoksi_id = ".$tupoksi_id."
                ";

        $query = $this->ekin->query($sql)->row();        
        
        return $query;
    }

   public function getTotPegawai2(){
       $sql = "SELECT COUNT(NRK) AS TOTPEG
                FROM PERS_PEGAWAI1
                WHERE TMTPENSIUN IS NOT NULL
                OR KDMATI='Y'
                ";
       $query = $this->ci->db->query($sql)->row();

       return $query->TOTPEG;
   }

    public function getTotPegawai(){
        $thbl=date('Ym');
        $sql = "SELECT COUNT(NRK) AS TOTPEG
                FROM PERS_DUK_PANGKAT_HISTDUK
                WHERE THBL='$thbl'
                ";
        $query = $this->ci->db->query($sql)->row();

        return $query->TOTPEG;
    }

    public function getTotPegawaiPns(){
        $thbl=date('Ym');
        $sql = "SELECT COUNT(NRK) AS TOTPEG
                FROM PERS_DUK_PANGKAT_HISTDUK
                WHERE THBL='$thbl'
                AND STAPEG='1'";
        $query = $this->ci->db->query($sql)->row();

        return $query->TOTPEG;
    }

    public function getTotPegawaiCpns(){
        $thbl=date('Ym');
        $sql = "SELECT COUNT(NRK) AS TOTPEG
                FROM PERS_DUK_PANGKAT_HISTDUK
                WHERE THBL='$thbl'
                AND STAPEG='2'";
        $query = $this->ci->db->query($sql)->row();

        return $query->TOTPEG;
    }


}