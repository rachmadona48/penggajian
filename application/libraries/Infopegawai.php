<?php if (!defined('BASEPATH')) {
	exit('No direct script access allowed');
}

class Infopegawai {

	private $ci;
	private $ekin;

	function __construct() {
		$this->ci = &get_instance();
		$this->ci->load->database();
		$this->ci->load->library('session');

		//$this->ekin = $this->ci->load->database('ekin234', TRUE);
		// $this->ekine = $this->ci->load->database('ekinerja', TRUE);
		// $this->ekine16 = $this->ci->load->database('ekinerja16', TRUE);
	}

	function cekaksesmenu($idmenu, $ug) {
		$sql = "SELECT a.\"id_menu\",a.\"nama_menu\",b.\"menu_id\" from \"menu_master_gaji\" a
                left join \"menu_access_user_gaji\" b on a.\"id_menu\" = b.\"menu_id\"
                where a.\"status_aktif\" ='Y' and a.\"jenis_menu\" = '0'and b.\"act_view\" = 'Y' and b.\"user_group_id\"='$ug' and a.\"id_menu\"='$idmenu'";

		$query = $this->ci->db->query($sql);
		$num = $query->num_rows();
		return $num;

	}

	function getMaintenanceMode() {
		$q = "SELECT STATUS FROM MAINTENANCE_MODE";
		$r = $this->ci->db->query($q)->row();

		return $r->STATUS;
	}

	function getDataUser($id) {
		$sql = "SELECT * FROM \"menu_master_gaji\" WHERE \"user_id\"='" . $id . "'  ";
		$query = $this->ci->db->query($sql)->row();
		return $query;
	}

	function getMenu($id) {
		$sql = "SELECT * FROM \"menu_master_gaji\" WHERE \"id_menu\"='" . $id . "'  ";
		$query = $this->ci->db->query($sql);
		return $query;
	}

	function getDataMenu($id, $user_group_id, $jenis) {
		$sql = "SELECT a.\"menu_access_id\",a.\"menu_id\",a.\"user_group_id\",b.\"nama_menu\", b.\"link_menu\", b.\"status_aktif\", b.\"alias\", b.\"icon\"
                FROM \"menu_access_user_gaji\" a
                LEFT JOIN \"menu_master_gaji\" b ON a.\"menu_id\" = b.\"id_menu\"
                WHERE a.\"menu_id\" = '" . $id . "' AND b.\"status_aktif\"='Y' AND a.\"act_view\"='Y' AND a.\"user_group_id\" = '" . $user_group_id . "' AND b.\"jenis_menu\"='" . $jenis . "' ";
		// echo $sql;
		$query = $this->ci->db->query($sql);
		return $query;
	}

	function getListMenu() {
		$sql = "SELECT \"id_list\", \"nama_list\", \"aktif_list\", \"non_aktif_list\" FROM \"menu_list_gaji\" WHERE ROWNUM <= 1";
		$query = $this->ci->db->query($sql);
		return $query->result();
	}

	function getCountRespon() {
		$q1 = "SELECT COUNT(A.NRK) AS JML
                FROM PERS_PENDIDIKAN A
                LEFT JOIN PERS_UNIVER_TBL B ON A.UNIVER = B.KDUNIVER
                LEFT JOIN PERS_STATUS_APPROVAL C ON A.STAT_APP = C.KD_STATUS
                WHERE A.JENDIK = 1 AND A.STAT_APP = 2
                ORDER BY A.TGIJAZAH DESC";
		$r1 = $this->ci->db->query($q1)->row();

		$q2 = "SELECT COUNT(A.NRK) AS JML
                FROM PERS_PENDIDIKAN A
                LEFT JOIN PERS_STATUS_APPROVAL B ON A.STAT_APP = B.KD_STATUS
                WHERE JENDIK <> 1 AND STAT_APP = 2
                ORDER BY TGIJAZAH DESC";
		$r2 = $this->ci->db->query($q2)->row();

		$q3 = "SELECT COUNT(a.NRK) AS JML
                FROM PERS_ALAMAT_HIST a
                LEFT JOIN PERS_KOWIL_TBL b ON a.KOWIL = b.KOWIL
                LEFT JOIN PERS_KOCAM_TBL c ON a.KOCAM = c.KOCAM AND b.KOWIL = c.KOWIL
                LEFT JOIN PERS_KOKEL_TBL d ON a.KOKEL = d.KOKEL AND c.KOCAM = d.KOCAM AND b.KOWIL = d.KOWIL
                LEFT JOIN PERS_PROP_RPT e ON a.PROP = e.PROP
                LEFT JOIN PERS_STATUS_APPROVAL f on a.STAT_APP = f.KD_STATUS
                WHERE a.STAT_APP = 2 ORDER BY TGMULAI DESC
                ";
		$r3 = $this->ci->db->query($q3)->row();

		$q4 = "SELECT COUNT(a.NRK) AS JML
                FROM PERS_KELUARGA a
                LEFT JOIN PERS_HUBKEL_TBL b ON a.HUBKEL = b.HUBKEL
                LEFT JOIN PERS_STATTUN_RPT c ON a.STATTUN = c.STATTUN
                LEFT JOIN PERS_KDKERJA_RPT d ON a.KDKERJA = d.KDKERJA
                LEFT JOIN PERS_STATUS_APPROVAL e ON a.STAT_APP = e.KD_STATUS
                WHERE a.STAT_APP = 2 ORDER BY a.TG_UPD DESC
                ";
		$r4 = $this->ci->db->query($q4)->row();

		return $r1->JML + $r2->JML + $r3->JML + $r4->JML;
	}

	public function initialMenu($user_group_id, $alias, $jenis) {

		$listmenu = $this->getListMenu();
		$datam['listmenu'] = $listmenu;

		$itemAktifTemp = array();
		$itemNonAktifTemp = array();
		foreach ($listmenu as $key => $value) {
			$itemAktifTemp = json_decode($value->aktif_list);
			$itemNonAktifTemp = json_decode($value->non_aktif_list);
		}

		$html = '';
		if (count($itemAktifTemp) > 0) {
			$activeMenu = '';
			$stat = '';
			foreach ($itemAktifTemp as $key => $value) {
				//menu lvl 1
				//$menu = $this->getMenu($value->id)->row();
				$menu = $this->getDataMenu($value->id, $user_group_id, $jenis)->row();

				if (!$menu) {
					continue;
				}

				// $activeMenu=$menu->id_menu;
				if ($menu->alias == $alias) {
					$stat = "active";
				} else {
					$stat = "deactive";
				}

				if ($menu->icon == '') {
					$icon = 'fa-windows';
				} else {
					$icon = $menu->icon;
				}
				/*$html.='<li class="';
					                                    if($value->id==$activeMenu)
					                                    { echo "active"; }
				*/

				$html .= '<li class="' . $stat . '">';
				if ($menu->nama_menu == "Respon Persetujuan") {
					if ($this->getCountRespon() != 0) {
						$badge = ' <span class="label label-info pull-right">' . $this->getCountRespon() . '</span>';
					}
				} else {
					$badge = '<span class="fa arrow"></span>';
				}

				$html .= '

                                    <a href="' . base_url() . '' . $menu->link_menu . '"><i class="fa ' . $icon . '" title="' . $menu->nama_menu . '"></i>
                                     <span class="nav-label">' . $menu->nama_menu . '</span>' . $badge . '</a>';

				if (isset($value->children)) {
					if ($stat == 'active') {
						$html .= '<ul class="nav nav-second-level">';
					} else {
						$html .= '<ul class="nav nav-second-level collapse">';
					}

					foreach ($value->children as $key2 => $value2) {
						//menu lvl 2
						$menu2 = $this->getDataMenu($value2->id, $user_group_id, $jenis)->row();

						if (!$menu2) {
							continue;
						}

						$html .= '<li  class="';

						$html .= '">
                                        <a href="' . base_url() . '' . $menu2->link_menu . '"> <span class="nav-label">' . $menu2->nama_menu . '</span><span class="fa arrow"></span></a>';

						if (isset($value2->children)) {
							$html .= '<ul class="nav nav-second-level collapse">';
							foreach ($value2->children as $key3 => $value3) {
								//menu lvl 3
								$menu3 = $this->getDataMenu($value3->id, $user_group_id, $jenis)->row();

								if (!$menu3) {
									continue;
								}

								$html .= '<li class="';

								$html .= '<a href="' . base_url() . '' . $menu3->link_menu . '"></i> <span class="nav-label">' . $menu3->nama_menu . '></span><span class="fa arrow"></span></a>
                                        </li>';
							}
							$html .= '</ul>';
						}
						$html .= '</li>';
					}
					$html .= '</ul>';
				}

				$html .= '</li>';
			}

		}

		return $html;

	}

	public function getMenuAccessBy($user_group_id, $menu_id) {
		// ,\"act_delete_flag\"
		$sql = "  SELECT \"menu_id\",\"act_view\",\"act_insert\",\"act_update\",\"act_resetpass\",\"act_delete\",\"act_detail\",\"user_group_id\"
                FROM \"menu_access_user_gaji\"
                WHERE \"user_group_id\" = '" . $user_group_id . "' and \"menu_id\"='" . $menu_id . "'";
		$query = $this->ci->db->query($sql);
		return $query->row();
	}

	public function getRiwayatJabatanStruktural($nrk, $ug, $id) {

		$access['mnac'] = $this->getMenuAccessBy($ug, 301);
		$accIns = $access['mnac']->act_insert;
		$accUpd = $access['mnac']->act_update;
		$accDel = $access['mnac']->act_delete;
		// $accDelFlag=$access['mnac']->act_delete_flag;

		$sql = "SELECT
                a.NRK, to_char(a.TMT, 'YYYY-MM-DD') TMT, a.NOSK, to_char(a.TGSK, 'YYYY-MM-DD') TGSK, a.KOLOK, b.NALOKL,
                a.KOJAB, c.NAJABL, a.USER_ID, to_char(a.TG_UPD, 'DD-MM-YYYY HH24:MM:SS') TG_UPD, a.TERM, a.STATUS, a.USER_ID,d.NAPANG,d.GOL,a.ESELON,a.KLOGAD,a.SPMU,f.NALOKL as NAKLOGAD,g.NAMA AS NAMA_SPM,a.PEJTT,h.KETERANGAN as KET_PEJTT,to_char(a.TMTPENSIUN, 'YYYY-MM-DD') TMTPENSIUN,a.KREDIT,a.JENIS_SK,i.KETERANGAN AS KET_JENSK
                FROM PERS_JABATAN_HIST a
                LEFT JOIN PERS_LOKASI_TBL b ON a.KOLOK = b.KOLOK
                LEFT JOIN PERS_KOJAB_TBL c ON a.KOJAB = c.KOJAB AND a.KOLOK = c.KOLOK
                LEFT JOIN PERS_PANGKAT_TBL d ON a.KOPANG = d.KOPANG
                --LEFT JOIN PERS_PEGAWAI1 e ON a.NRK = e.NRK
                LEFT JOIN PERS_LOKASI_TBL f ON a.KLOGAD = f.KOLOK
                LEFT JOIN PERS_TABEL_SPMU g ON a.SPMU = g.KODE_SPM
                LEFT JOIN PERS_PEJTT_RPT h ON a.PEJTT = h.PEJTT
                LEFT JOIN PERS_JENSK i ON a.JENIS_SK = i.ID_JENSK
                WHERE a.NRK = '" . $nrk . "'

                ORDER BY a.TMT DESC, TG_UPD DESC";
// AND a.DELETED IS NULL
		$query = $this->ci->db->query($sql);

		$i = 1;

		$table = "<div class='ibox float-e-margins animated fadeInDown'>"; //START IBOX
		$table .= "<div class='ibox-title navy-bg'>
                        <h5>Riwayat Jabatan Struktural</h5>
                        <div class=\"ibox-tools\">
                            <a class=\"collapse-link\">
                                <i class=\"fa fa-chevron-up\"></i>
                            </a>
                            <a class=\"close-link\">
                                <i class=\"fa fa-times\"></i>
                            </a>
                        </div>
        </div>"; //IBOX TITLE
		$table .= "<div class='ibox-content'>"; //START IBOX CONTENT
		$table .= "<div id='_content_riwayat_" . $id . "' class='animated fadeInUp'>";
		if ($accIns == 'Y') {
			$table .= "<div class='pull-right'><button type='button' class='btn btn-primary btn-sm btn-block m-t' onClick='getForm(\"jabatan_hist\",\"tambah\");'><i class='fa fa-plus'></i> Tambah Data</button></div>";
		}
		$table .= "<table class='table table-striped table-bordered table-hover dataTables-example' width='99%'>";
		$table .= "<thead>";
		$table .= " <tr>
                        <th>No</th>
                        <th>TMT</th>
                        <th>Lokasi</th>
                        <th>Jabatan</th>
                        <th>Lokasi Gaji</th>
                        <th>SKPD</th>
                        <th>Pangkat (Gol)</th>
                        <th>Eselon</th>
                        <th>Jenis SK</th>
                        <th>No.SK <br/> <strong><small class='text-navy'>(Tgl. SK)</small></strong></th>
                        <th>Pejabat Penanda Tangan</th>

                        <th>Kredit</th>
                        <th>User ID <br/><strong><small class='text-navy'>(Tgl. Update)</small></strong></th>
                        <th>Aksi</th>
                    </tr>";
		$table .= "</thead>";
		$table .= "<tbody>";
		foreach ($query->result() as $row) {
			$table .= "<tr>";
			$table .= "<td>" . $i . "</td>";
			$tmt = date('d-m-Y', strtotime($row->TMT));
			$table .= "<td>" . $tmt . "</td>";
			if ($row->KOLOK == null) {
				$table .= "<td> - <br><strong><small class='text-success'>( - )</small></strong></td>";
			} else {
				$table .= "<td>" . $row->NALOKL . "<br><strong><small class='text-success'>(" . $row->KOLOK . ")</small></strong></td>";
			}

			if ($row->KOJAB == null) {
				$table .= "<td> - <br><strong><small class='text-success'>( - )</small></strong></td>";
			} else {
				$table .= "<td>" . $row->NAJABL . "<br><strong><small class='text-success'>(" . $row->KOJAB . ")</small></strong></td>";
			}

			if ($row->KLOGAD == null) {
				$table .= "<td> - <br><strong><small class='text-success'>( - )</small></strong></td>";
			} else {
				$table .= "<td>" . $row->NAKLOGAD . "<br><strong><small class='text-success'>(" . $row->KLOGAD . ")</small></strong></td>";
			}

			/*if($row->STATUS == 0){
				                        $status = "Aktif";
				                    }else{
				                        $status = "Tidak Aktif";
				                    }
			*/

			if ($row->SPMU == null) {
				$table .= "<td> - <br><strong><small class='text-success'>( - )</small></strong></td>";
			} else {
				$table .= "<td>" . $row->NAMA_SPM . "<br><strong><small class='text-success'>(" . $row->SPMU . ")</small></strong></td>";
			}

			$table .= "<td>" . $row->NAPANG . " (" . $row->GOL . " )</td>";
			$table .= "<td>" . $row->ESELON . "</td>";
			if ($row->JENIS_SK == null) {
				$table .= "<td> - </td>";
			} else {
				$table .= "<td>" . $row->KET_JENSK . "</td>";
			}

			$tgsk = date('d-m-Y', strtotime($row->TGSK));
			$table .= "<td>" . $row->NOSK . "<br><strong><small class='text-navy'>(" . $tgsk . ")</small></strong></td>";
			$table .= "<td>" . $row->KET_PEJTT . "</td>";

			if ($row->KREDIT == null) {
				$table .= "<td> 0 </td>";
			} else {
				$table .= "<td>" . $row->KREDIT . "</td>";
			}

			$table .= "<td>" . $row->USER_ID . "<br><strong><small class='text-navy'>(" . $row->TG_UPD . ")</small></strong></td>";
			$table .= "<td >";
			if ($accUpd == 'Y') {
				$table .= "<button type='button' class='btn btn-outline btn-xs btn-success' title='Edit' onClick='getForm(\"jabatan_hist\",\"update\",\"" . $row->NRK . "\",\"" . date('d-m-Y', strtotime($row->TMT)) . "\",\"" . $row->KOLOK . "\",\"" . $row->KOJAB . "\");'><i class='fa fa-pencil-square'></i></button> &nbsp;";
			}
			//     if($accDelFlag == 'Y'){
			// $table .="<button type='button' class='btn btn-outline btn-xs btn-danger' title='Hapus' onClick='confirmHapusDataFlag(\"jabatan_hist\",\"".$row->NRK."\",\"".date('d-m-Y', strtotime($row->TMT))."\",\"".$row->KOLOK."\",\"".$row->KOJAB."\");'><i class='fa fa-trash'></i></button> &nbsp;";
			//     }
			if ($accDel == 'Y') {
				$table .= "<button type='button' class='btn btn-outline btn-xs btn-danger' title='Hapus ' onClick='confirmHapusData(\"jabatan_hist\",\"" . $row->NRK . "\",\"" . date('d-m-Y', strtotime($row->TMT)) . "\",\"" . $row->KOLOK . "\",\"" . $row->KOJAB . "\");'><i class='fa fa-trash'></i></button>";
			}
			$table .= "</td>";

			$table .= "</tr>";
			$i++;
		}
		$table .= "</tbody>";
		$table .= "</table>";
		$table .= "</div>";
		$table .= "</div>"; //END IBOX CONTENT
		$table .= "</div>"; //END IBOX
		$table .= "<script src=\"" . base_url() . "assets/inspinia/js/inspinia.js\"></script>"; //END IBOX

		return $table;
	}

	public function getRiwayatJabatanStrukturalPeg($nrk, $ug, $id) {

		$access['mnac'] = $this->getMenuAccessBy($ug, 301);
		$accIns = $access['mnac']->act_insert;
		$accUpd = $access['mnac']->act_update;
		$accDel = $access['mnac']->act_delete;
		// $accDelFlag=$access['mnac']->act_delete_flag;

		$sql = "SELECT
                a.NRK, to_char(a.TMT, 'YYYY-MM-DD') TMT, a.NOSK, to_char(a.TGSK, 'YYYY-MM-DD') TGSK, a.KOLOK, b.NALOKL,
                a.KOJAB, c.NAJABL, a.USER_ID, to_char(a.TG_UPD, 'DD-MM-YYYY HH24:MM:SS') TG_UPD, a.TERM, a.STATUS, a.USER_ID,d.NAPANG,d.GOL,a.ESELON,a.KLOGAD,a.SPMU,f.NALOKL as NAKLOGAD,g.NAMA AS NAMA_SPM,a.PEJTT,h.KETERANGAN as KET_PEJTT,to_char(a.TMTPENSIUN, 'YYYY-MM-DD') TMTPENSIUN,a.KREDIT,a.JENIS_SK,i.KETERANGAN AS KET_JENSK
                FROM PERS_JABATAN_HIST a
                LEFT JOIN PERS_LOKASI_TBL b ON a.KOLOK = b.KOLOK
                LEFT JOIN PERS_KOJAB_TBL c ON a.KOJAB = c.KOJAB AND a.KOLOK = c.KOLOK
                LEFT JOIN PERS_PANGKAT_TBL d ON a.KOPANG = d.KOPANG
                --LEFT JOIN PERS_PEGAWAI1 e ON a.NRK = e.NRK
                LEFT JOIN PERS_LOKASI_TBL f ON a.KLOGAD = f.KOLOK
                LEFT JOIN PERS_TABEL_SPMU g ON a.SPMU = g.KODE_SPM
                LEFT JOIN PERS_PEJTT_RPT h ON a.PEJTT = h.PEJTT
                LEFT JOIN PERS_JENSK i ON a.JENIS_SK = i.ID_JENSK
                WHERE a.NRK = '" . $nrk . "'

                ORDER BY a.TMT DESC, a.KOLOK, a.KOJAB";
// AND a.DELETED IS NULL
		$query = $this->ci->db->query($sql);

		$i = 1;

		$table = "<div class='ibox float-e-margins animated fadeInDown'>"; //START IBOX
		$table .= "<div class='ibox-title navy-bg'>
                        <h5>Riwayat Jabatan Struktural</h5>
                        <div class=\"ibox-tools\">
                            <a class=\"collapse-link\">
                                <i class=\"fa fa-chevron-up\"></i>
                            </a>
                            <a class=\"close-link\">
                                <i class=\"fa fa-times\"></i>
                            </a>
                        </div>
        </div>"; //IBOX TITLE
		$table .= "<div class='ibox-content'>"; //START IBOX CONTENT
		$table .= "<div id='_content_riwayat_" . $id . "' class='animated fadeInUp'>";
		if ($accIns == 'Y') {
			$table .= "<div class='pull-right'><button type='button' class='btn btn-primary btn-sm btn-block m-t' onClick='getForm(\"jabatan_hist\",\"tambah\");'><i class='fa fa-plus'></i> Tambah Data</button></div>";
		}
		$table .= "<table class='table table-striped table-bordered table-hover dataTables-example' width='99%'>";
		$table .= "<thead>";
		$table .= " <tr>
                        <th>No</th>
                        <th>TMT</th>
                        <th>Lokasi Kerja</th>
                        <th>Jabatan</th>
                        <th>Lokasi Gaji</th>
                        <th>SKPD</th>
                        <th>Pangkat (Gol)</th>
                        <th>Eselon</th>
                        <th>Jenis SK</th>
                        <th>No SK<br/><strong><small class='text-navy'>(Tgl. SK)</small></strong></th>
                        <th>Pejabat Penanda Tangan</th>
                        <th>Kredit</th>

                    </tr>";
		$table .= "</thead>";
		$table .= "<tbody>";
		foreach ($query->result() as $row) {
			$table .= "<tr>";
			$table .= "<td>" . $i . "</td>";
			$tmt = date('d-m-Y', strtotime($row->TMT));
			$table .= "<td>" . $tmt . "</td>";
			$table .= "<td>" . $row->NALOKL . "</td>";
			$table .= "<td>" . $row->NAJABL . "</td>";
			$table .= "<td>" . $row->NAKLOGAD . "</td>";
			$table .= "<td>" . $row->NAMA_SPM . "</td>";
			$table .= "<td>" . $row->NAPANG . " (" . $row->GOL . " )</td>";
			$table .= "<td>" . $row->ESELON . "</td>";
			if ($row->JENIS_SK == null) {
				$table .= "<td> - </td>";
			} else {
				$table .= "<td>" . $row->KET_JENSK . "</td>";
			}
			$tgsk = date('d-m-Y', strtotime($row->TGSK));
			$table .= "<td>" . $row->NOSK . "<br><strong><small class='text-navy'>(" . $tgsk . ")</small></strong></td>";
			$table .= "<td>" . $row->KET_PEJTT . "</td>";

			if ($row->KREDIT == null) {
				$table .= "<td> 0 </td>";
			} else {
				$table .= "<td>" . $row->KREDIT . "</td>";
			}

			/* $table .= "<td >";
				                    if($accUpd == 'Y'){
				                $table.= "<button type='button' class='btn btn-outline btn-xs btn-success' title='Edit' onClick='getForm(\"jabatan_hist\",\"update\",\"".$row->NRK."\",\"".date('d-m-Y', strtotime($row->TMT))."\",\"".$row->KOLOK."\",\"".$row->KOJAB."\");'><i class='fa fa-pencil-square'></i></button> &nbsp;";
				                    }
				                    if($accDel == 'Y'){
				                $table .="<button type='button' class='btn btn-outline btn-xs btn-danger' title='Hapus' onClick='confirmHapusData(\"jabatan_hist\",\"".$row->NRK."\",\"".date('d-m-Y', strtotime($row->TMT))."\",\"".$row->KOLOK."\",\"".$row->KOJAB."\");'><i class='fa fa-trash'></i></button>";
				                    }
			*/

			$table .= "</tr>";
			$i++;
		}
		$table .= "</tbody>";
		$table .= "</table>";
		$table .= "</div>";
		$table .= "</div>"; //END IBOX CONTENT
		$table .= "</div>"; //END IBOX
		$table .= "<script src=\"" . base_url() . "assets/inspinia/js/inspinia.js\"></script>"; //END IBOX

		return $table;
	}

	public function getRiwayatJabatanFungsional($nrk, $ug, $id) {
		$access['mnac'] = $this->getMenuAccessBy($ug, 302);
		$accIns = $access['mnac']->act_insert;
		$accUpd = $access['mnac']->act_update;
		$accDel = $access['mnac']->act_delete;
		// $accDelFlag=$access['mnac']->act_delete_flag;

		$sql = "SELECT
                a.NRK, to_char(a.TMT, 'YYYY-MM-DD') TMT, a.NOSK, to_char(a.TGSK, 'YYYY-MM-DD') TGSK, a.KOLOK, b.NALOKL,
                a.KOJAB, c.NAJABL, a.USER_ID, to_char(a.TG_UPD, 'DD-MM-YYYY HH24:MM:SS') TG_UPD, a.TERM, a.STATUS, a.USER_ID,d.NAPANG,d.GOL,a.KLOGAD,e.NALOKL as NAKLOGAD,a.SPMU,f.NAMA as NAMA_SPM,g.KETERANGAN as KET_PEJTT,to_char(a.TMTPENSIUN, 'YYYY-MM-DD') TMTPENSIUN,a.KREDIT,a.JENIS_SK,h.KETERANGAN AS KET_JENSK
                FROM PERS_JABATANF_HIST a
                LEFT JOIN PERS_LOKASI_TBL b ON a.KOLOK = b.KOLOK
                LEFT JOIN PERS_KOJABF_TBL c ON a.KOJAB = c.KOJAB
                LEFT JOIN PERS_PANGKAT_TBL d on a.KOPANG = d.KOPANG
                LEFT JOIN PERS_LOKASI_TBL e on a.KLOGAD = e.KOLOK
                LEFT JOIN PERS_TABEL_SPMU f on a.SPMU = f.KODE_SPM
                LEFT JOIN PERS_PEJTT_RPT g on a.PEJTT = g.PEJTT
                LEFT JOIN PERS_JENSK h ON a.JENIS_SK = h.ID_JENSK
                WHERE a.NRK = '" . $nrk . "'

                ORDER BY a.TMT DESC, a.KOLOK, a.KOJAB";
// AND a.DELETED IS NULL
		$query = $this->ci->db->query($sql);

		$i = 1;

		$table = "<div class='ibox float-e-margins animated fadeInDown'>"; //START IBOX
		$table .= "<div class='ibox-title navy-bg'>
                        <h5>Riwayat Jabatan Fungsional</h5>
                        <div class=\"ibox-tools\">
                            <a class=\"collapse-link\">
                                <i class=\"fa fa-chevron-up\"></i>
                            </a>
                            <a class=\"close-link\">
                                <i class=\"fa fa-times\"></i>
                            </a>
                        </div>
        </div>"; //IBOX TITLE
		$table .= "<div class='ibox-content'>"; //START IBOX CONTENT
		$table .= "<div id='_content_riwayat_" . $id . "' class='animated fadeInUp'>";
		if ($accIns == 'Y') {
			$table .= "<div class='pull-right'><button type='button' class='btn btn-primary btn-sm btn-block m-t' onClick='getForm(\"jabatanf_hist\",\"tambah\");'><i class='fa fa-plus'></i> Tambah Data</button></div>";
		}
		$table .= "<table class='table table-striped table-bordered table-hover dataTables-example' width='99%'>";
		$table .= "<thead>";
		$table .= "    <tr>
                        <th>No</th>
                        <th>TMT</th>
                        <th>Lokasi</th>
                        <th>Jabatan</th>
                        <th>Lokasi Gaji</th>
                        <th>SKPD</th>
                        <th>Pangkat (Gol)</th>
                        <th>Jenis SK</th>
                        <th>No.SK <br/> <strong><small class='text-navy'>(Tgl. SK)</small></strong></th>
                        <th>Pejabat Penanda Tangan</th>
                        <th>TMT Pensiun </th>
                        <th>Kredit</th>
                        <th>User ID <br/><strong><small class='text-navy'>(Tgl. Update)</small></strong></th>
                        <th>Aksi</th>
                    </tr>";
		$table .= "</thead>";
		$table .= "<tbody>";
		foreach ($query->result() as $row) {
			$table .= "<tr>";
			$table .= "<td width='5px'>" . $i . "</td>";
			$tmt = date('d-m-Y', strtotime($row->TMT));
			$table .= "<td>" . $tmt . "</td>";

			if ($row->KOLOK == null) {
				$table .= "<td> - <br><strong><small class='text-success'>( - )</small></strong></td>";
			} else {
				$table .= "<td>" . $row->NALOKL . "<br><strong><small class='text-success'>(" . $row->KOLOK . ")</small></strong></td>";
			}

			if ($row->KOJAB == null) {
				$table .= "<td> - <br><strong><small class='text-success'>( - )</small></strong></td>";
			} else {
				$table .= "<td>" . $row->NAJABL . "<br><strong><small class='text-success'>(" . $row->KOJAB . ")</small></strong></td>";
			}

			if ($row->KLOGAD == null) {
				$table .= "<td> - <br><strong><small class='text-success'>( - )</small></strong></td>";
			} else {
				$table .= "<td>" . $row->NAKLOGAD . "<br><strong><small class='text-success'>(" . $row->KLOGAD . ")</small></strong></td>";
			}

			if ($row->SPMU == null) {
				$table .= "<td> - <br><strong><small class='text-success'>( - )</small></strong></td>";
			} else {
				$table .= "<td>" . $row->NAMA_SPM . "<br><strong><small class='text-success'>(" . $row->SPMU . ")</small></strong></td>";
			}

			$table .= "<td>" . $row->NAPANG . " (" . $row->GOL . " )</td>";
			if ($row->JENIS_SK == null) {
				$table .= "<td> - </td>";
			} else {
				$table .= "<td>" . $row->KET_JENSK . "</td>";
			}
			$tgsk = date('d-m-Y', strtotime($row->TGSK));

			$table .= "<td>" . $row->NOSK . "<br><strong><small class='text-navy'>(" . $tgsk . ")</small></strong></td>";

			/*if($row->STATUS == 0){
				                        $status = "Aktif";
				                    }else{
				                        $status = "Tidak Aktif";
				                    }
			*/
			$table .= "<td>" . $row->KET_PEJTT . "</td>";

			if ($row->TMTPENSIUN == null) {
				$table .= "<td> - </td>";
			} else {
				$table .= "<td>" . $row->TMTPENSIUN . "</td>";
			}
			$table .= "<td>" . $row->KREDIT . "</td>";
			$table .= "<td>" . $row->USER_ID . "<br><strong><small class='text-navy'>(" . $row->TG_UPD . ")</small></strong></td>";
			$table .= "<td >";
			if ($accUpd == 'Y') {
				$table .= "<button type='button' class='btn btn-outline btn-xs btn-success' title='Edit' onClick='getForm(\"jabatanf_hist\",\"update\",\"" . $row->NRK . "\",\"" . date('d-m-Y', strtotime($row->TMT)) . "\",\"" . $row->KOJAB . "\");'><i class='fa fa-pencil-square'></i></button> &nbsp;";
			}
			// if($accDelFlag == 'Y'){
			// $table .= "<button type='button' class='btn btn-outline btn-xs btn-danger' title='Hapus' onClick='confirmHapusDataFlag(\"jabatanf_hist\",\"".$row->NRK."\",\"".date('d-m-Y', strtotime($row->TMT))."\",\"".$row->KOJAB."\");'><i class='fa fa-trash'></i></button> &nbsp;";
			// }
			if ($accDel == 'Y') {
				$table .= "<button type='button' class='btn btn-outline btn-xs btn-danger' title='Hapus ' onClick='confirmHapusData(\"jabatanf_hist\",\"" . $row->NRK . "\",\"" . date('d-m-Y', strtotime($row->TMT)) . "\",\"" . $row->KOJAB . "\");'><i class='fa fa-trash'></i></button>";
			}
			$table .= "</td>";
			$table .= "</tr>";

			$i++;
		}
		$table .= "</tbody>";
		$table .= "</table>";
		$table .= "</div>";
		$table .= "</div>"; //END IBOX CONTENT
		$table .= "</div>"; //END IBOX
		$table .= "<script src=\"" . base_url() . "assets/inspinia/js/inspinia.js\"></script>"; //END IBOX

		return $table;
	}

	public function getRiwayatJabatanFungsionalPeg($nrk, $ug, $id) {
		$access['mnac'] = $this->getMenuAccessBy($ug, 302);
		$accIns = $access['mnac']->act_insert;
		$accUpd = $access['mnac']->act_update;
		$accDel = $access['mnac']->act_delete;
		// $accDelFlag=$access['mnac']->act_delete_flag;

		/*$sql = "SELECT
			                a.NRK, to_char(a.TMT, 'YYYY-MM-DD') TMT, a.NOSK, to_char(a.TGSK, 'YYYY-MM-DD') TGSK, a.KOLOK, b.NALOKL,
			                a.KOJAB, c.NAJABL, a.USER_ID, to_char(a.TG_UPD, 'DD-MM-YYYY HH24:MM:SS') TG_UPD, a.TERM, a.STATUS, a.USER_ID,d.NAPANG,d.GOL
			                FROM PERS_JABATANF_HIST a
			                LEFT JOIN PERS_LOKASI_TBL b ON a.KOLOK = b.KOLOK
			                LEFT JOIN PERS_KOJABF_TBL c ON a.KOJAB = c.KOJAB
			                LEFT JOIN PERS_PANGKAT_TBL d on a.KOPANG = d.KOPANG
			                WHERE a.NRK = '".$nrk."'
			                AND a.DELETED IS NULL
		*/

		$sql = "SELECT
                a.NRK, to_char(a.TMT, 'YYYY-MM-DD') TMT, a.NOSK, to_char(a.TGSK, 'YYYY-MM-DD') TGSK, a.KOLOK, b.NALOKL,
                a.KOJAB, c.NAJABL, a.USER_ID, to_char(a.TG_UPD, 'DD-MM-YYYY HH24:MM:SS') TG_UPD, a.TERM, a.STATUS, a.USER_ID,d.NAPANG,d.GOL,a.KLOGAD,e.NALOKL as NAKLOGAD,a.SPMU,f.NAMA as NAMA_SPM,g.KETERANGAN as KET_PEJTT,to_char(a.TMTPENSIUN, 'YYYY-MM-DD') TMTPENSIUN,a.KREDIT,a.JENIS_SK,h.KETERANGAN AS KET_JENSK
                FROM PERS_JABATANF_HIST a
                LEFT JOIN PERS_LOKASI_TBL b ON a.KOLOK = b.KOLOK
                LEFT JOIN PERS_KOJABF_TBL c ON a.KOJAB = c.KOJAB
                LEFT JOIN PERS_PANGKAT_TBL d on a.KOPANG = d.KOPANG
                LEFT JOIN PERS_LOKASI_TBL e on a.KLOGAD = e.KOLOK
                LEFT JOIN PERS_TABEL_SPMU f on a.SPMU = f.KODE_SPM
                LEFT JOIN PERS_PEJTT_RPT g on a.PEJTT = g.PEJTT
                LEFT JOIN PERS_JENSK h ON a.JENIS_SK = h.ID_JENSK
                WHERE a.NRK = '" . $nrk . "'

                ORDER BY a.TMT DESC, a.KOLOK, a.KOJAB";
		// AND a.DELETED IS NULL
		$query = $this->ci->db->query($sql);

		$i = 1;

		$table = "<div class='ibox float-e-margins animated fadeInDown'>"; //START IBOX
		$table .= "<div class='ibox-title navy-bg'>
                        <h5>Riwayat Jabatan Fungsional</h5>
                        <div class=\"ibox-tools\">
                            <a class=\"collapse-link\">
                                <i class=\"fa fa-chevron-up\"></i>
                            </a>
                            <a class=\"close-link\">
                                <i class=\"fa fa-times\"></i>
                            </a>
                        </div>
        </div>"; //IBOX TITLE
		$table .= "<div class='ibox-content'>"; //START IBOX CONTENT
		$table .= "<div id='_content_riwayat_" . $id . "' class='animated fadeInUp'>";
		if ($accIns == 'Y') {
			$table .= "<div class='pull-right'><button type='button' class='btn btn-primary btn-sm btn-block m-t' onClick='getForm(\"jabatanf_hist\",\"tambah\");'><i class='fa fa-plus'></i> Tambah Data</button></div>";
		}
		$table .= "<table id='tbl-grid' class='table table-striped table-bordered table-hover dataTables-example' width='99%'>";
		$table .= "<thead>";
		$table .= "    <tr>
                        <th>No</th>
                        <th>TMT</th>
                        <th>Lokasi Kerja</th>
                        <th>Jabatan</th>
                        <th>Lokasi Gaji</th>
                        <th>SKPD</th>
                        <th>Pangkat (Gol)</th>
                        <th>Jenis SK</th>
                        <th>No SK<br/><strong><small class='text-navy'>(Tgl. SK)</small></strong></th>
                        <th>Pejabat Penanda Tangan</th>
                        <th>Kredit</th>
                    </tr>";
		$table .= "</thead>";
		$table .= "<tbody>";
		foreach ($query->result() as $row) {
			$table .= "<tr>";
			$table .= "<td>" . $i . "</td>";
			$tmt = date('d-m-Y', strtotime($row->TMT));
			$table .= "<td>" . $tmt . "</td>";
			$table .= "<td>" . $row->NALOKL . "</td>";
			$table .= "<td>" . $row->NAJABL . "</td>";
			$table .= "<td>" . $row->NAKLOGAD . "</td>";
			$table .= "<td>" . $row->NAMA_SPM . "</td>";
			$table .= "<td>" . $row->NAPANG . " (" . $row->GOL . " )</td>";
			if ($row->JENIS_SK == null) {
				$table .= "<td> - </td>";
			} else {
				$table .= "<td>" . $row->KET_JENSK . "</td>";
			}

			$tgsk = date('d-m-Y', strtotime($row->TGSK));
			$table .= "<td>" . $row->NOSK . "<br><strong><small class='text-navy'>(" . $tgsk . ")</small></strong></td>";
			$table .= "<td>" . $row->KET_PEJTT . "</td>";
			$table .= "<td>" . $row->KREDIT . "</td>";
			/*$table .= "<td >";
				                if($accUpd == 'Y'){
				                $table .="<button type='button' class='btn btn-outline btn-xs btn-success' title='Edit' onClick='getForm(\"jabatanf_hist\",\"update\",\"".$row->NRK."\",\"".date('d-m-Y', strtotime($row->TMT))."\",\"".$row->KOJAB."\");'><i class='fa fa-pencil-square'></i></button> &nbsp;";
				                }
				                if($accDel == 'Y'){
				                $table .= "<button type='button' class='btn btn-outline btn-xs btn-danger' title='Hapus' onClick='confirmHapusData(\"jabatanf_hist\",\"".$row->NRK."\",\"".date('d-m-Y', strtotime($row->TMT))."\",\"".$row->KOJAB."\");'><i class='fa fa-trash'></i></button>";
				                }
			*/
			$table .= "</tr>";

			$i++;
		}
		$table .= "</tbody>";
		$table .= "</table>";
		$table .= "</div>";
		$table .= "</div>"; //END IBOX CONTENT
		$table .= "</div>"; //END IBOX
		$table .= "<script src=\"" . base_url() . "assets/inspinia/js/inspinia.js\"></script>"; //END IBOX
		//END IBOX

		return $table;
	}

	//pegawai
	public function getRiwayatPendidikanFormal($nrk, $ug, $id) {
		$access['mnac'] = $this->getMenuAccessBy($ug, 303);
		$accIns = $access['mnac']->act_insert;
		$accUpd = $access['mnac']->act_update;
		$accDel = $access['mnac']->act_delete;
		// $accDelFlag=$access['mnac']->act_delete_flag;

		/*$sql = "SELECT
			                A.NRK,  A.TGIJAZAH, A.NOIJAZAH, A.NASEK, A.UNIVER, B.NAUNIVER, A.USER_ID, A.TERM, A.TG_UPD , A.JENDIK,
			                A.KODIK, C.KET_STATUS, A.TG_UPD, A.USER_ID
			                FROM PERS_PENDIDIKAN A
			                LEFT JOIN PERS_UNIVER_TBL B ON A.UNIVER = B.KDUNIVER
			                LEFT JOIN PERS_STATUS_APPROVAL C ON A.STAT_APP = C.KD_STATUS
			                WHERE A.NRK = '".$nrk."' AND A.JENDIK = 1
			                AND a.DELETED IS NULL
		*/
		$sql = "SELECT
                    A .NRK,
                    TO_CHAR(A .TGIJAZAH,'DD-MM-YYYY') TGIJAZAH,
                    A .NOIJAZAH,
                    A .NASEK,
                    A .UNIVER,
                    B.NAUNIVER,
                    A .USER_ID,
                    A .TERM,
                    A .TG_UPD,
                    A .JENDIK,
                    A .KODIK,
                    C.KET_STATUS,
                    D.NADIK,
                    TO_CHAR(A.TG_UPD,'DD-MM-YYYY HH24:MM:SS') TG_UPD,
                    A.USER_ID
                FROM
                    PERS_PENDIDIKAN A
                LEFT JOIN PERS_UNIVER_TBL B ON A .UNIVER = B.KDUNIVER
                LEFT JOIN PERS_STATUS_APPROVAL C ON A .STAT_APP = C.KD_STATUS
                LEFT JOIN PERS_PDIDIKAN_TBL D ON A.JENDIK = D.JENDIK AND A.KODIK = D.KODIK
                WHERE
                    A .NRK = '" . $nrk . "'
                AND A .JENDIK = 1

                ORDER BY
                    A .TGIJAZAH DESC";
		// AND a.DELETED IS NULL

		$query = $this->ci->db->query($sql);

		$i = 1;

		$table = "<div class='ibox float-e-margins animated fadeInDown'>"; //START IBOX
		$table .= "<div class='ibox-title navy-bg'>
                        <h5>Riwayat Pendidikan Formal</h5>
                        <div class=\"ibox-tools\">
                            <a class=\"collapse-link\">
                                <i class=\"fa fa-chevron-up\"></i>
                            </a>
                            <a class=\"close-link\">
                                <i class=\"fa fa-times\"></i>
                            </a>
                        </div>
        </div>"; //IBOX TITLE
		$table .= "<div class='ibox-content'>"; //START IBOX CONTENT
		$table .= "<div id='_content_riwayat_" . $id . "' class='animated fadeInUp'>";
		if ($accIns == 'Y') {
			$table .= "<div class='pull-right'><button type='button' class='btn btn-primary btn-sm btn-block m-t' onClick='getForm(\"pendidikan_formal\",\"tambah\");'><i class='fa fa-plus'></i> Tambah Data</button></div>";
		}
		$table .= "<table class='table table-striped table-bordered table-hover dataTables-example' width='99%'>";
		$table .= "<thead>";
		$table .= " <tr>
                        <th>No</th>
                        <th>Jenjang</th>
                        <th>No Ijazah<br/><strong><small class='text-navy'>(Tgl. Ijazah)</small></strong></th>
                        <th>Nama Pendidikan</th>
                        <th>Nama Sekolah</th>

                    </tr>";
		$table .= "</thead>";
		$table .= "<tbody>";
		foreach ($query->result() as $row) {
			$table .= "<tr>";
			$table .= "<td>" . $i . "</td>";

			$kodik_temp = $row->KODIK;
			$sub_kodik = substr($kodik_temp, 0, 1);
			if ($sub_kodik != 4) {
				if ($sub_kodik == 1) {
					$table .= "<td> SD </td>";
				} else if ($sub_kodik == 2) {
					$table .= "<td> SMP </td>";
				} else if ($sub_kodik == 3) {
					$table .= "<td> SMA </td>";
				} else if ($sub_kodik == 5) {
					$table .= "<td> D3 </td>";
				} else if ($sub_kodik == 6) {
					$table .= "<td> S1 </td>";
				} else if ($sub_kodik == 8) {
					$table .= "<td> S2 </td>";
				} else if ($sub_kodik == 9) {
					$table .= "<td> S3 </td>";
				}
			} else {
				$sub_kodik2 = substr($kodik_temp, 0, 2);
				if ($sub_kodik2 == '40' || $sub_kodik2 == '41' || $sub_kodik2 == '42' || $sub_kodik2 == '43' || $sub_kodik2 == '44') {
					$table .= "<td> D1 </td>";
				} else if ($sub_kodik2 == '45' || $sub_kodik2 == '46' || $sub_kodik2 == '47' || $sub_kodik2 == '48' || $sub_kodik2 == '49') {
					$table .= "<td> D2 </td>";
				}
			}
			$tglijazah = date('d-m-Y', strtotime($row->TGIJAZAH));
			$table .= "<td>" . $row->NOIJAZAH . "<br><strong><small class='text-navy'>(" . $tglijazah . ")</small></strong></td>";
			$table .= "<td>" . $row->NADIK . "</td>";
			if ($row->NASEK != ' ') {
				$table .= "<td>" . $row->NASEK . "<br><strong><small class='text-success'>(" . $row->UNIVER . ")</small></strong></td>";
			} else if ($row->NASEK == ' ') {
				$table .= "<td>" . $row->NAUNIVER . "<br><strong><small class='text-success'>(" . $row->UNIVER . ")</small></strong></td>";
			}

			/*$table .= "<td>";
				                if($accUpd == 'Y')
				                {
				                    $table.= "<button type='button' class='btn btn-outline btn-xs btn-success' title='Edit' onClick='getForm(\"pendidikan_formal\",\"update\",\"".$row->NRK."\",\"".$row->JENDIK."\",\"".$row->KODIK."\");'><i class='fa fa-pencil-square'></i></button> &nbsp;";
				                }
				                if($accDel == 'Y')
				                {
				                    $table.= "<button type='button' class='btn btn-outline btn-xs btn-danger' title='Hapus' onClick='confirmHapusData(\"pendidikan_formal\",\"".$row->NRK."\",\"".$row->JENDIK."\",\"".$row->KODIK."\");'><i class='fa fa-trash'></i></button>";
				                }
			*/
			$table .= "</tr>";

			$i++;
		}
		$table .= "</tbody>";
		$table .= "</table>";
		$table .= "</div>";
		$table .= "</div>"; //END IBOX CONTENT
		$table .= "</div>"; //END IBOX
		$table .= "<script src=\"" . base_url() . "assets/inspinia/js/inspinia.js\"></script>"; //END IBOX

		return $table;
	}

	//bkd
	public function getRiwayatPendidikanFormal2($nrk, $ug, $id) {
		$access['mnac'] = $this->getMenuAccessBy($ug, 303);
		$accIns = $access['mnac']->act_insert;
		$accUpd = $access['mnac']->act_update;
		$accDel = $access['mnac']->act_delete;
		// $accDelFlag=$access['mnac']->act_delete_flag;
		/*$sql = "SELECT NRK, to_char(TGIJAZAH, 'YYYY-MM-DD') TGIJAZAH, NOIJAZAH, NASEK, UNIVER, USER_ID, TERM, to_char(TG_UPD, 'YYYY-MM-DD HH:MM:SS') TG_UPD , JENDIK, KODIK
	                FROM PERS_PENDIDIKAN
	                WHERE NRK = '".$nrk."' AND JENDIK = 1
*/

		$sql = "SELECT
                    A .NRK,
                    TO_CHAR(A .TGIJAZAH,'DD-MM-YYYY') TGIJAZAH,
                    A .NOIJAZAH,
                    A .NASEK,
                    A .UNIVER,
                    B.NAUNIVER,

                    A .TERM,

                    A .JENDIK,
                    A .KODIK,
                    C.KET_STATUS,
                    D.NADIK,
                    TO_CHAR(A.TG_UPD,'DD-MM-YYYY HH24:MI:SS') TG_UPD,
                    A.USER_ID
                FROM
                    PERS_PENDIDIKAN A
                LEFT JOIN PERS_UNIVER_TBL B ON A .UNIVER = B.KDUNIVER
                LEFT JOIN PERS_STATUS_APPROVAL C ON A .STAT_APP = C.KD_STATUS
                LEFT JOIN PERS_PDIDIKAN_TBL D ON A.JENDIK = D.JENDIK AND A.KODIK = D.KODIK
                WHERE
                    A .NRK = '" . $nrk . "'
                AND A .JENDIK = 1

                ORDER BY
                    A .TGIJAZAH DESC";
// AND a.DELETED IS NULL
		$query = $this->ci->db->query($sql);

		$i = 1;

		$table = "<div class='ibox float-e-margins animated fadeInDown'>"; //START IBOX
		$table .= "<div class='ibox-title navy-bg'>
                        <h5>Riwayat Pendidikan Formal</h5>
                        <div class=\"ibox-tools\">
                            <a class=\"collapse-link\">
                                <i class=\"fa fa-chevron-up\"></i>
                            </a>
                            <a class=\"close-link\">
                                <i class=\"fa fa-times\"></i>
                            </a>
                        </div>
        </div>"; //IBOX TITLE
		$table .= "<div class='ibox-content'>"; //START IBOX CONTENT
		$table .= "<div id='_content_riwayat_" . $id . "' class='animated fadeInUp'>";
		if ($accIns == 'Y') {
			$table .= "<div class='pull-right'><button type='button' class='btn btn-primary btn-sm btn-block m-t' onClick='getForm(\"pendidikan_formal_2\",\"tambah\");'><i class='fa fa-plus'></i> Tambah Data</button></div>";
		}
		$table .= "<table class='table table-striped table-bordered table-hover dataTables-example' width='99%'>";
		$table .= "<thead>";
		/*$table .= " <tr>
			                        <th>No</th>
			                        <th>Jenjang</th>
			                        <th>Nama Pendidikan</th>
			                        <th>Nama Sekolah</th>
			                        <th>Tgl. Ijazah</th>
			                        <th>No. Ijazah</th>
			                        <th>Status</th>
			                        <th>User ID <br/><strong><small class='text-navy'>(Tgl. Update)</small></strong></th>
			                        <th>Aksi</th>
		*/
		$table .= " <tr>
                        <th>No</th>
                        <th>Jenjang</th>
                        <th>No Ijazah<br/><strong><small class='text-navy'>(Tgl. Ijazah)</small></strong></th>
                        <th>Nama Pendidikan</th>
                        <th>Nama Sekolah</th>


                        <th>User ID <br/><strong><small class='text-navy'>(Tgl. Update)</small></strong></th>
                        <th>Aksi</th>
                    </tr>";
		$table .= "</thead>";
		$table .= "<tbody>";
		foreach ($query->result() as $row) {
			$table .= "<tr>";
			$table .= "<td>" . $i . "</td>";
			$kodik_temp = $row->KODIK;
			//var_dump($kodik_temp);
			$sub_kodik = substr($kodik_temp, 0, 1);
			//var_dump($sub_kodik);
			if ($sub_kodik != 4) {
				if ($sub_kodik == 1) {
					$table .= "<td> SD </td>";
				} else if ($sub_kodik == 2) {
					$table .= "<td> SMP </td>";
				} else if ($sub_kodik == 3) {
					$table .= "<td> SMA </td>";
				} else if ($sub_kodik == 5) {
					$table .= "<td> D3 </td>";
				} else if ($sub_kodik == 6) {
					$table .= "<td> S1 </td>";
				} else if ($sub_kodik == 7) {
					$table .= "<td> PROFESI </td>";
				} else if ($sub_kodik == 8) {
					$table .= "<td> S2 </td>";
				} else if ($sub_kodik == 9) {
					$table .= "<td> S3 </td>";
				} else if ($sub_kodik == 0) {
					$table .= "<td> - </td>";
				}
			} else {
				$sub_kodik2 = substr($kodik_temp, 0, 2);

				if ($sub_kodik2 == '40' || $sub_kodik2 == '41' || $sub_kodik2 == '42' || $sub_kodik2 == '43' || $sub_kodik2 == '44') {
					$table .= "<td> D1 </td>";
				} else if ($sub_kodik2 == '45' || $sub_kodik2 == '46' || $sub_kodik2 == '47' || $sub_kodik2 == '48' || $sub_kodik2 == '49') {
					$table .= "<td> D2 </td>";
				} else {
					$table .= "<td> - </td>";
				}
			}

			$tglijazah = date('d-m-Y', strtotime($row->TGIJAZAH));
			if ($row->NOIJAZAH != null && $row->TGIJAZAH != null) {
				$table .= "<td>" . $row->NOIJAZAH . "<br><strong><small class='text-navy'>(" . $tglijazah . ")</small></strong></td>";
			} else if ($row->NOIJAZAH == null && $row->TGIJAZAH != null) {
				$table .= "<td>-<br><strong><small class='text-navy'>(" . $tglijazah . ")</small></strong></td>";
			} else if ($row->NOIJAZAH != null && $row->TGIJAZAH == null) {
				$table .= "<td>" . $row->NOIJAZAH . "<br><strong><small class='text-navy'>(-)</small></strong></td>";
			} else {
				$table .= "<td>-<br><strong><small class='text-navy'>(-)</small></strong></td>";
			}

			$table .= "<td>" . $row->NADIK . "</td>";
			if ($row->NASEK != ' ') {
				$table .= "<td>" . $row->NASEK . "<br><strong><small class='text-success'>(" . $row->UNIVER . ")</small></strong></td>";
			} else if ($row->NASEK == ' ') {
				$table .= "<td>" . $row->NAUNIVER . "<br><strong><small class='text-success'>(" . $row->UNIVER . ")</small></strong></td>";
			}

			//$table .= "<td>".$row->KET_STATUS."</td>";
			$table .= "<td>" . $row->USER_ID . "<br><strong><small class='text-navy'>(" . $row->TG_UPD . ")</small></strong></td>";
			$table .= "<td>";
			if ($accUpd == 'Y') {
				$table .= "<button type='button' class='btn btn-outline btn-xs btn-success' title='Edit' onClick='getForm(\"pendidikan_formal_2\",\"update\",\"" . $row->NRK . "\",\"" . $row->JENDIK . "\",\"" . $row->KODIK . "\");'><i class='fa fa-pencil-square'></i></button> &nbsp;";
			}
			// if($accDelFlag == 'Y')
			// {
			//     $table.= "<button type='button' class='btn btn-outline btn-xs btn-danger' title='Hapus' onClick='confirmHapusDataFlag(\"pendidikan_formal\",\"".$row->NRK."\",\"".$row->JENDIK."\",\"".$row->KODIK."\");'><i class='fa fa-trash'></i></button> &nbsp;";
			// }
			if ($accDel == 'Y') {
				$table .= "<button type='button' class='btn btn-outline btn-xs btn-danger' title='Hapus ' onClick='confirmHapusData(\"pendidikan_formal\",\"" . $row->NRK . "\",\"" . $row->JENDIK . "\",\"" . $row->KODIK . "\");'><i class='fa fa-trash'></i></button>";
			}
			$table .= "</td>";
			$table .= "</tr>";

			$i++;
		}
		$table .= "</tbody>";
		$table .= "</table>";
		$table .= "</div>";
		$table .= "</div>"; //END IBOX CONTENT
		$table .= "</div>"; //END IBOX
		$table .= "<script src=\"" . base_url() . "assets/inspinia/js/inspinia.js\"></script>"; //END IBOX

		return $table;
	}

	public function getRequestPendidikanFormal($ug, $id) {
		$access['mnac'] = $this->getMenuAccessBy($ug, 303);

		$accUpd = $access['mnac']->act_update;
		// $accDelFlag=$access['mnac']->act_delete_flag;

		$sql = "SELECT A.NRK,  A.TGIJAZAH, A.NOIJAZAH, A.NASEK, A.UNIVER, B.NAUNIVER, A.USER_ID, A.TERM, A.TG_UPD , A.JENDIK, A.KODIK, A.STAT_APP,C.KET_STATUS
                FROM PERS_PENDIDIKAN A
                LEFT JOIN PERS_UNIVER_TBL B ON A.UNIVER = B.KDUNIVER
                LEFT JOIN PERS_STATUS_APPROVAL C ON A.STAT_APP = C.KD_STATUS
                WHERE A.JENDIK = 1 AND A.STAT_APP = 2

                ORDER BY A.TGIJAZAH DESC";
// AND A.DELETED IS NULL
		$query = $this->ci->db->query($sql);

		$i = 1;

		$table = "<div class='ibox float-e-margins animated fadeInDown'>"; //START IBOX
		$table .= "<div class='ibox-title navy-bg'>
                        <h5>Riwayat Pendidikan Formal</h5>
                        <div class=\"ibox-tools\">
                            <a class=\"collapse-link\">
                                <i class=\"fa fa-chevron-up\"></i>
                            </a>
                            <a class=\"close-link\">
                                <i class=\"fa fa-times\"></i>
                            </a>
                        </div>
        </div>"; //IBOX TITLE
		$table .= "<div class='ibox-content'>"; //START IBOX CONTENT
		$table .= "<div id='_content_riwayat_" . $id . "' class='animated fadeInUp'>";

		$table .= "<table class='table table-striped table-bordered table-hover dataTables-example' width='99%'>";
		$table .= "<thead>";
		$table .= " <tr>
                        <th>No</th><th>NRK</th><th>Tgl. Ijazah</th><th>No. Ijazah</th><th>Nama Pendidikan</th><th>STATUS</th><th>Aksi</th>
                    </tr>";
		$table .= "</thead>";
		$table .= "<tbody>";
		foreach ($query->result() as $row) {
			$table .= "<tr>";
			$table .= "<td width='5px'>" . $i . "</td>";
			$table .= "<td>" . $row->NRK . "</td>";
			$tglijazah = date('d-m-Y', strtotime($row->TGIJAZAH));
			$table .= "<td width='85px'>" . $tglijazah . "</td>";
			$table .= "<td>" . $row->NOIJAZAH . "</td>";
			if ($row->NASEK != ' ') {
				$table .= "<td>" . $row->NASEK . "<br><strong><small class='text-success'>(" . $row->UNIVER . ")</small></strong></td>";
			} else if ($row->NASEK == ' ') {
				$table .= "<td>" . $row->NAUNIVER . "<br><strong><small class='text-success'>(" . $row->UNIVER . ")</small></strong></td>";
			}
			$table .= "<td>" . $row->KET_STATUS . "</td>";
			$table .= "<td>";
			if ($accUpd == 'Y') {
				$table .= "<button type='button' class='btn btn-outline btn-xs btn-success' title='Edit' onClick='getForm(\"pendidikan_formal_2\",\"" . $row->NRK . "\",\"update\",\"" . $row->NRK . "\",\"" . $row->JENDIK . "\",\"" . $row->KODIK . "\");'><i class='fa fa-pencil-square'></i></button> &nbsp;";
			}

			$table .= "</td>";
			$table .= "</tr>";

			$i++;
		}
		$table .= "</tbody>";
		$table .= "</table>";
		$table .= "</div>";
		$table .= "</div>"; //END IBOX CONTENT
		$table .= "</div>"; //END IBOX

		return $table;
	}

	public function getRiwayatPendidikanNonFormal($nrk, $ug, $id) {
		$access['mnac'] = $this->getMenuAccessBy($ug, 304);
		$accIns = $access['mnac']->act_insert;
		$accUpd = $access['mnac']->act_update;
		$accDel = $access['mnac']->act_delete;
		// $accDelFlag=$access['mnac']->act_delete_flag;
		/*$sql = "SELECT A.NRK, A.TGIJAZAH, A.NOIJAZAH, A.NASEK, A.UNIVER, A.USER_ID, A.TERM, A.TG_UPD, A.JENDIK, A.KODIK, A.SELENGGARA, B.KET_STATUS,D.NADIK
	                FROM PERS_PENDIDIKAN A
	                LEFT JOIN PERS_STATUS_APPROVAL B ON A.STAT_APP = B.KD_STATUS
	                LEFT JOIN PERS_PDIDIKAN_TBL D ON A.JENDIK = D.JENDIK AND A.KODIK = D.KODIK
	                WHERE NRK = '".$nrk."' AND A.JENDIK <> 1
	                AND a.DELETED IS NULL
*/

		$sql = "SELECT A.NRK, TO_CHAR(A.TGIJAZAH,'DD-MM-YYYY') AS TGIJAZAH, A.NOIJAZAH, A.NASEK, A.UNIVER, A.USER_ID, A.TERM, A.TG_UPD, A.JENDIK, A.KODIK,
                A.SELENGGARA, B.KET_STATUS, TO_CHAR(A.TG_UPD,'DD-MM-YYYY HH24:MI:SS') AS TG_UPD, A.USER_ID,D.NADIK
                FROM PERS_PENDIDIKAN A
                LEFT JOIN PERS_STATUS_APPROVAL B ON A.STAT_APP = B.KD_STATUS
                LEFT JOIN PERS_PDIDIKAN_TBL D ON A.JENDIK = D.JENDIK AND A.KODIK = D.KODIK
                WHERE NRK = '" . $nrk . "' AND A.JENDIK <> 1

                ORDER BY TGIJAZAH DESC";
// AND a.DELETED IS NULL
		$query = $this->ci->db->query($sql);

		$i = 1;

		$table = "<div class='ibox float-e-margins animated fadeInDown'>"; //START IBOX
		$table .= "<div class='ibox-title navy-bg'>
                        <h5>Riwayat Jabatan Pendidikan Non-Formal</h5>
                        <div class=\"ibox-tools\">
                            <a class=\"collapse-link\">
                                <i class=\"fa fa-chevron-up\"></i>
                            </a>
                            <a class=\"close-link\">
                                <i class=\"fa fa-times\"></i>
                            </a>
                        </div>
        </div>"; //IBOX TITLE
		$table .= "<div class='ibox-content'>"; //START IBOX CONTENT
		$table .= "<div id='_content_riwayat_" . $id . "' class='animated fadeInUp'>";
		if ($accIns == 'Y') {
			$table .= "<div class='pull-right'><button type='button' class='btn btn-primary btn-sm btn-block m-t' onClick='getForm(\"pendidikan_nonformal\",\"tambah\");'><i class='fa fa-plus'></i> Tambah Data</button></div>";
		}
		$table .= "<table class='table table-striped table-bordered table-hover dataTables-example' width='99%'>";
		$table .= "<thead>";
		$table .= " <tr>
                        <th>No</th>


                        <th>No Ijazah<br/><strong><small class='text-navy'>(Tgl. Ijazah)</small></strong></th>
                        <th>Nama Pendidikan</th>
                        <th>Nama Lembaga</th>
                        <th>Penyelenggara</th>

                    </tr>";
		$table .= "</thead>";
		$table .= "<tbody>";
		foreach ($query->result() as $row) {
			$table .= "<tr>";
			$table .= "<td>" . $i . "</td>";
			$table .= "<td>" . $row->NOIJAZAH . "<br><strong><small class='text-navy'>(" . $row->TGIJAZAH . ")</small></strong></td>";
			$table .= "<td>" . $row->NADIK . "<br><strong></td>";
			$table .= "<td>" . $row->NASEK . "<br><strong></td>";
			$table .= "<td>" . $row->SELENGGARA . "</td>";

			//$table .= "<td>";
			/*if($accUpd == 'Y'){
	                    $table.= "<button type='button' class='btn btn-outline btn-xs btn-success' title='Edit' onClick='getForm(\"pendidikan_nonformal\",\"update\",\"".$row->NRK."\",\"".$row->JENDIK."\",\"".$row->KODIK."\");'><i class='fa fa-pencil-square'></i></button> &nbsp;";
	                }
	                if($accDel == 'Y'){
	                    $table.= "<button type='button' class='btn btn-outline btn-xs btn-danger' title='Hapus' onClick='confirmHapusData(\"pendidikan_nonformal\",\"".$row->NRK."\",\"".$row->JENDIK."\",\"".$row->KODIK."\");'><i class='fa fa-trash'></i></button>";
*/
			//$table.="</td>";
			$table .= "</tr>";

			$i++;
		}
		$table .= "</tbody>";
		$table .= "</table>";
		$table .= "</div>";
		$table .= "</div>"; //END IBOX CONTENT
		$table .= "</div>"; //END IBOX
		$table .= "<script src=\"" . base_url() . "assets/inspinia/js/inspinia.js\"></script>"; //END IBOX

		return $table;
	}

	//bkd
	public function getRiwayatPendidikanNonFormal2($nrk, $ug, $id) {
		$access['mnac'] = $this->getMenuAccessBy($ug, 304);
		$accIns = $access['mnac']->act_insert;
		$accUpd = $access['mnac']->act_update;
		$accDel = $access['mnac']->act_delete;
		// $accDelFlag=$access['mnac']->act_delete_flag;
		$sql = "SELECT A.NRK, TO_CHAR(A.TGIJAZAH,'DD-MM-YYYY') AS TGIJAZAH, A.NOIJAZAH, A.NASEK, A.UNIVER, A.USER_ID, A.TERM, A.TG_UPD, A.JENDIK, A.KODIK,
                A.SELENGGARA, B.KET_STATUS, TO_CHAR(A.TG_UPD,'DD-MM-YYYY HH24:MI:SS') AS TG_UPD, A.USER_ID,D.NADIK
                FROM PERS_PENDIDIKAN A
                LEFT JOIN PERS_STATUS_APPROVAL B ON A.STAT_APP = B.KD_STATUS
                LEFT JOIN PERS_PDIDIKAN_TBL D ON A.JENDIK = D.JENDIK AND A.KODIK = D.KODIK
                WHERE NRK = '" . $nrk . "' AND A.JENDIK <> 1

                ORDER BY TGIJAZAH DESC";
// AND a.DELETED IS NULL

		$query = $this->ci->db->query($sql);

		$i = 1;

		$table = "<div class='ibox float-e-margins animated fadeInDown'>"; //START IBOX
		$table .= "<div class='ibox-title navy-bg'>
                        <h5>Riwayat Pendidikan Non-Formal</h5>
                        <div class=\"ibox-tools\">
                            <a class=\"collapse-link\">
                                <i class=\"fa fa-chevron-up\"></i>
                            </a>
                            <a class=\"close-link\">
                                <i class=\"fa fa-times\"></i>
                            </a>
                        </div>
        </div>"; //IBOX TITLE
		$table .= "<div class='ibox-content'>"; //START IBOX CONTENT
		$table .= "<div id='_content_riwayat_" . $id . "' class='animated fadeInUp'>";
		if ($accIns == 'Y') {
			$table .= "<div class='pull-right'><button type='button' class='btn btn-primary btn-sm btn-block m-t' onClick='getForm(\"pendidikan_nonformal_2\",\"tambah\");'><i class='fa fa-plus'></i> Tambah Data</button></div>";
		}
		$table .= "<table class='table table-striped table-bordered table-hover dataTables-example' width='99%'>";
		$table .= "<thead>";
		/*$table .= " <tr>
			                        <th>No</th>
			                        <th>Tgl. Ijazah</th>
			                        <th>No. Ijazah</th>
			                        <th>Nama Pendidikan</th>
			                        <th>Nama Lembaga</th>
			                        <th>Penyelenggara</th>
			                        <th>Status</th>
			                        <th>User ID <br/><strong><small class='text-navy'>(Tgl. Update)</small></strong></th>
			                        <th>Aksi</th>
		*/
		$table .= " <tr>
                        <th>No</th>
                        <th>No Ijazah<br/><strong><small class='text-navy'>(Tgl. Ijazah)</small></strong></th>
                        <th>Nama Pendidikan</th>
                        <th>Nama Lembaga</th>
                        <th>Penyelenggara</th>
                        <th>User ID <br/><strong><small class='text-navy'>(Tgl. Update)</small></strong></th>
                        <th>Aksi</th>
                    </tr>";
		$table .= "</thead>";
		$table .= "<tbody>";
		foreach ($query->result() as $row) {
			$table .= "<tr>";
			$table .= "<td>" . $i . "</td>";
			$table .= "<td>" . $row->NOIJAZAH . "<br><strong><small class='text-navy'>(" . $row->TGIJAZAH . ")</small></strong></td>";
			$table .= "<td>" . $row->NADIK . "<br><strong><small class='text-success'>(" . $row->KODIK . ")</small></strong></td>";
			$table .= "<td>" . $row->NASEK . "<br><strong><small class='text-success'>(" . $row->UNIVER . ")</small></strong></td>";
			$table .= "<td>" . $row->SELENGGARA . "</td>";
			//$table .= "<td>".$row->KET_STATUS."</td>";
			$table .= "<td>" . $row->USER_ID . "<br><strong><small class='text-navy'>(" . $row->TG_UPD . ")</small></strong></td>";
			$table .= "<td>";
			if ($accUpd == 'Y') {
				$table .= "<button type='button' class='btn btn-outline btn-xs btn-success' title='Edit' onClick='getForm(\"pendidikan_nonformal_2\",\"update\",\"" . $row->NRK . "\",\"" . $row->JENDIK . "\",\"" . $row->KODIK . "\");'><i class='fa fa-pencil-square'></i></button> &nbsp;";
			}
			// if($accDelFlag == 'Y'){
			//     $table.= "<button type='button' class='btn btn-outline btn-xs btn-danger' title='Hapus' onClick='confirmHapusDataFlag(\"pendidikan_nonformal\",\"".$row->NRK."\",\"".$row->JENDIK."\",\"".$row->KODIK."\");'><i class='fa fa-trash'></i></button> &nbsp;";
			// }
			if ($accDel == 'Y') {
				$table .= "<button type='button' class='btn btn-outline btn-xs btn-danger' title='Hapus ' onClick='confirmHapusData(\"pendidikan_nonformal\",\"" . $row->NRK . "\",\"" . $row->JENDIK . "\",\"" . $row->KODIK . "\");'><i class='fa fa-trash'></i></button>";
			}
			$table .= "</td>";
			$table .= "</tr>";

			$i++;
		}
		$table .= "</tbody>";
		$table .= "</table>";
		$table .= "</div>";
		$table .= "</div>"; //END IBOX CONTENT
		$table .= "</div>"; //END IBOX
		$table .= "<script src=\"" . base_url() . "assets/inspinia/js/inspinia.js\"></script>"; //END IBOX

		return $table;
	}

	public function getRequestPendidikanNonFormal($ug, $id) {
		$access['mnac'] = $this->getMenuAccessBy($ug, 304);

		$accUpd = $access['mnac']->act_update;
		// $accDelFlag=$access['mnac']->act_delete_flag;

		$sql = "SELECT A.NRK, A.TGIJAZAH, A.NOIJAZAH, A.NASEK, A.UNIVER, A.USER_ID, A.TERM, A.TG_UPD, A.JENDIK, A.KODIK, A.SELENGGARA, A.STAT_APP, B.KET_STATUS
                FROM PERS_PENDIDIKAN A
                LEFT JOIN PERS_STATUS_APPROVAL B ON A.STAT_APP = B.KD_STATUS
                WHERE JENDIK <> 1 AND STAT_APP = 2

                ORDER BY TGIJAZAH DESC";
// AND A.DELETED IS NULL

		$query = $this->ci->db->query($sql);

		$i = 1;

		$table = "<div class='ibox float-e-margins animated fadeInDown'>"; //START IBOX
		$table .= "<div class='ibox-title navy-bg'>
                        <h5>Riwayat Pendidikan Non-Formal</h5>
                        <div class=\"ibox-tools\">
                            <a class=\"collapse-link\">
                                <i class=\"fa fa-chevron-up\"></i>
                            </a>
                            <a class=\"close-link\">
                                <i class=\"fa fa-times\"></i>
                            </a>
                        </div>
        </div>"; //IBOX TITLE
		$table .= "<div class='ibox-content'>"; //START IBOX CONTENT
		$table .= "<div id='_content_riwayat_" . $id . "' class='animated fadeInUp'>";

		$table .= "<table class='table table-striped table-bordered table-hover dataTables-example' width='99%'>";
		$table .= "<thead>";
		$table .= " <tr>
                        <th>No</th><th>NRK</th><th>Tgl. Ijazah</th><th>No. Ijazah</th><th>Nama Pendidikan</th><th>Penyelenggara</th><th>Status</th><th>Aksi</th>
                    </tr>";
		$table .= "</thead>";
		$table .= "<tbody>";
		foreach ($query->result() as $row) {
			$table .= "<tr>";
			$table .= "<td width='5px'>" . $i . "</td>";
			$table .= "<td>" . $row->NRK . "</td>";
			$tglijazah = date('d M Y', strtotime($row->TGIJAZAH));
			$table .= "<td width='130px'>" . $tglijazah . "</td>";
			$table .= "<td>" . $row->NOIJAZAH . "</td>";
			$table .= "<td>" . $row->NASEK . "<br><strong><small class='text-success'>(" . $row->UNIVER . ")</small></strong></td>";
			$table .= "<td>" . $row->SELENGGARA . "</td>";
			$table .= "<td>" . $row->KET_STATUS . "</td>";
			$table .= "<td>";
			if ($accUpd == 'Y') {
				$table .= "<button type='button' class='btn btn-outline btn-xs btn-success' title='Edit' onClick='getForm(\"pendidikan_nonformal_2\",\"" . $row->NRK . "\",\"update\",\"" . $row->NRK . "\",\"" . $row->JENDIK . "\",\"" . $row->KODIK . "\");'><i class='fa fa-pencil-square'></i></button> &nbsp;";
			}

			$table .= "</td>";
			$table .= "</tr>";

			$i++;
		}
		$table .= "</tbody>";
		$table .= "</table>";
		$table .= "</div>";
		$table .= "</div>"; //END IBOX CONTENT
		$table .= "</div>"; //END IBOX
		$table .= "<script src=\"" . base_url() . "assets/inspinia/js/inspinia.js\"></script>"; //END IBOX

		return $table;
	}

	public function getPegawai1($nrk) {
		$sql = "SELECT NRK, NAMA, KOLOK
                FROM PERS_PEGAWAI1
                WHERE NRK = '$nrk'";

		$r = $this->ci->db->query($sql)->row();
		return $r;
	}

	public function getStrukturPegawai($nrk, $thbl) {
		$sql = "SELECT DISTINCT vw.nrk_bawahan, peg.nama
                FROM vw_kepala_bawahan vw
                LEFT JOIN pegawai_new peg ON vw.nrk_bawahan = peg.nrk
                WHERE vw.nrk_atasan = '" . $nrk . "' AND vw.thbl = '" . $thbl . "'";

		$tahun = substr($thbl, 0, 4);

		if (intval($tahun) > 2015) {
			$query = $this->ekine16->query($sql);
		} else {
			$query = $this->ekine->query($sql);
		}

		$bawahan = "";

		foreach ($query->result() as $row) {
			$pht2 = "assets/img/photo/" . $row->nrk_bawahan . "_thumb.jpg";
			$img2 = (file_exists($pht2)) ? base_url() . $pht2 : base_url() . "assets/img/photo/profile_small.jpg";

			// $bawahan .= "<form style='display:none' method='POST' id=\"form_".$row->nrk_bawahan."\">
			//                 <input type='hidden' name='thbl' id='thbl_".$row->nrk_bawahan."' value='".$thbl."'>
			//                 <input type='hidden' name='nrk' id='nrk_".$row->nrk_bawahan."' value='".$row->nrk_bawahan."'>
			//             </form>
			//             <a data-toggle=\"tooltip\" data-placement=\"bottom\" title=\"".$row->nama."\">
			//                     <img alt=\"image\" class=\"img-circle\" src=\"$img2\" width=\"38px\" height=\"38px\">
			//                     </a>";
			$session = $this->ci->session->userdata('logged_in');
			if ($session['user_group'] == '11' || $session['user_group'] == '10' || $session['user_group'] == '2') {
				$bawahan .= "<form method='POST' id=\"form_" . $row->nrk_bawahan . "\"  action='" . site_url('riwayat') . "' style='float:left; margin-left:5px'>
                            <input type='hidden' name='thbl' id='thbl_" . $row->nrk_bawahan . "' value='" . $thbl . "'>
                            <input type='hidden' name='nrk' id='nrk_" . $row->nrk_bawahan . "' value='" . $row->nrk_bawahan . "'>
                            <img src='$img2' title=\"" . $row->nama . "\" class='img-circle m-t-xs img-responsive' onclick='document.getElementById(\"form_" . $row->nrk_bawahan . "\").submit();' style='cursor: pointer;'>
                            <input type='submit'  value='' class=\"img-circle\" style='display:none'>
                        </form>";
			} else {
				$bawahan .= "<a href=\"$img2\" title=\"" . $row->nama . "\" data-gallery=\"\">
                                <img title=\"" . $row->nrk_bawahan . "\" class=\"img-circle\" src=\"$img2\" width=\"38px\" height=\"38px\">
                            </a>";
			}
			//<a onClick=\"getProfile('".$row->nrk_bawahan."')\" data-toggle=\"tooltip\" data-placement=\"bottom\" title=\"".$row->nama."\"><img alt=\"image\" class=\"img-circle\" src=\"$img2\" width=\"38px\" height=\"38px\"></a>"
		}

		return $bawahan;
	}

	public function getAtasanPegawai($nrk, $thbl) {
		$sql = "SELECT nrk_atasan FROM vw_kepala_bawahan WHERE nrk_bawahan = '" . $nrk . "' AND thbl = '" . $thbl . "'";

		$query = $this->ekine16->query($sql);

		$atasan = "";

		foreach ($query->result() as $row) {
			$atasan = $row->nrk_atasan;
		}

		return $atasan;
	}

	public function getShowTupoksi($nrk) {
		$sql = "SELECT peg.nrk, peg.kolok, peg.kojab, reft.kolok,reft.kojab,reft.uraian
                FROM pegawai_new peg
                LEFT JOIN ref_tupoksi reft ON peg.kolok = reft.kolok AND peg.kojab = reft.kojab
                WHERE peg.nrk = '" . $nrk . "'";

		$query = $this->ekine16->query($sql);

		$uraian = "<ol>";

		foreach ($query->result() as $row) {
			$uraian .= "<li class=''>" . $row->uraian . "</li>";
		}

		$uraian .= "</ol>";

		return $uraian;

		//return $query->result();
	}

	public function getTupoksi($nrk) {
		$sql = "SELECT peg.nrk, peg.kolok, peg.kojab, reft.kolok,reft.kojab
                FROM pegawai_new peg
                LEFT JOIN ref_tupoksi reft ON peg.kolok = reft.kolok AND peg.kojab = reft.kojab
                WHERE peg.nrk = '" . $nrk . "'";
		// echo $sql;
		$query = $this->ekine16->query($sql);

		return $query->row();
	}

	public function getRefTupoksi($nrk, $ug, $id) {
		$access['mnac'] = $this->getMenuAccessBy($ug, 319);
		$accIns = $access['mnac']->act_insert;
		$accUpd = $access['mnac']->act_update;
		$accDel = $access['mnac']->act_delete;
		$sql = "SELECT peg.nrk,reft.tupoksi_id, peg.kolok, peg.klogad, peg.kojab, reft.no_urut,reft.uraian,reft.dasar_hukum
                FROM pegawai_new peg
                LEFT JOIN ref_tupoksi reft ON peg.kolok = reft.kolok AND peg.kojab = reft.kojab
                WHERE peg.nrk = '" . $nrk . "' ORDER BY reft.tupoksi_id DESC";
		$query = $this->ekine16->query($sql);

		$i = 1;

		$table = "<div class='ibox float-e-margins animated fadeInDown'>"; //START IBOX
		$table .= "<div class='ibox-title navy-bg'>Riwayat Tugas Pokok Dan Fungsi</div>"; //IBOX TITLE
		$table .= "<div class='ibox-content'>"; //START IBOX CONTENT
		$table .= "<div id='_content_riwayat_" . $id . "' class='animated fadeInUp'>";
		if ($accIns == 'Y') {
			$table .= "<div class='pull-right'><button type='button' class='btn btn-primary btn-sm btn-block m-t' onClick='getForm(\"tupoksi\",\"tambah\",\"" . $nrk . "\");'><i class='fa fa-plus'></i> Tambah Data</button></div>";
		}
		$table .= "<table class='table table-striped table-bordered table-hover dataTables-example' width='99%'>";
		//$table .= "<thead>";
		$table .= " <tr>
                        <th>No</th><th>Uraian</th>
                    </tr>";
//        $table .= "</thead>";
		//        $table .= "<tbody>";
		foreach ($query->result() as $row) {
			$table .= "<tr>";
			$table .= "<td>" . $i . "</td>";

			$table .= "<td>" . $row->uraian . "</td>";
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
		$table .= "</div>"; //END IBOX CONTENT
		$table .= "</div>"; //END IBOX

		return $table;
	}

	public function getMenuSelectHist() {
		$sql = "SELECT \"id\", \"nama_menu\" FROM \"menu_user_select_hist\" WHERE \"status\" = 'Y' ORDER BY \"id\" ASC";

		$query = $this->ci->db->query($sql);

		$option = "";

		foreach ($query->result() as $row) {
			$option .= "<option value='" . $row->id . "'>" . $row->nama_menu . "</option>";
		}

		return $option;
	}

	public function getMenuSelectHistNew($user_group) {
		$sql = "SELECT \"id_menu\", \"alias\", \"nama_menu\"
                  FROM \"menu_access_user_gaji\"
                  INNER JOIN \"menu_master_gaji\" ON \"menu_id\"=\"id_menu\"
                  WHERE \"act_view\" = 'Y'
                  AND \"jenis_menu\"='1'
                  AND \"link_menu\"='home'
                  AND \"status_aktif\"='Y'
                  AND \"user_group_id\"='$user_group'
                  ORDER BY \"id_menu\" ASC";
		//echo $sql;
		$query = $this->ci->db->query($sql);

		$option = "";
		// $option .= "<option onClick='toggle(this)' >&nbsp; Select All</option>";
		foreach ($query->result() as $row) {
			$option .= "<option value='" . $row->alias . "'>&nbsp; " . $row->nama_menu . "</option>";
		}

		// $option .= "
		//                 <script type='text/javascript'>

		//                     function toggle(pilih) {
		//                       checkboxes = document.getElementsByName('plh');
		//                       for(var i=0, n=checkboxes.length;i<n;i++) {
		//                         checkboxes[i].checked = pilih.checked;
		//                       }
		//                     }

		//                 </script>

		//             ";

		return $option;
	}

	public function getMenuSelectHistSelf($user_group) {
		$sql = "SELECT \"id_menu\", \"alias\", \"nama_menu\"
                  FROM \"menu_access_user_gaji\"
                  INNER JOIN \"menu_master_gaji\" ON \"menu_id\"=\"id_menu\"
                  WHERE \"act_view\" = 'Y'
                  AND (\"id_menu\"='319'
                        OR \"id_menu\"='315'
                        OR \"id_menu\"='303'
                        OR \"id_menu\"='304')
                  AND \"status_aktif\"='Y'
                  AND \"user_group_id\"='$user_group'
                  ORDER BY \"id_menu\" ASC";
		//echo $sql;
		$query = $this->ci->db->query($sql);

		$option = "";

		foreach ($query->result() as $row) {
			$selected = "";
			//pendidikan formal
			if ($row->alias == 'penform') {
				$q1 = "SELECT COUNT(A.NRK) AS JML
                        FROM PERS_PENDIDIKAN A
                        LEFT JOIN PERS_UNIVER_TBL B ON A.UNIVER = B.KDUNIVER
                        LEFT JOIN PERS_STATUS_APPROVAL C ON A.STAT_APP = C.KD_STATUS
                        WHERE A.JENDIK = 1 AND A.STAT_APP = 2
                        ORDER BY A.TGIJAZAH DESC";
				$r1 = $this->ci->db->query($q1)->row();
				if ($r1->JML > 0) {
					$selected = "selected";
				}
			}

			//pendidikan non formal
			if ($row->alias == 'pennform') {
				$q2 = "SELECT COUNT(A.NRK) AS JML
                        FROM PERS_PENDIDIKAN A
                        LEFT JOIN PERS_STATUS_APPROVAL B ON A.STAT_APP = B.KD_STATUS
                        WHERE JENDIK <> 1 AND STAT_APP <> 1
                        ORDER BY TGIJAZAH DESC";
				$r2 = $this->ci->db->query($q2)->row();
				if ($r2->JML > 0) {
					$selected = "selected";
				}
			}

			//alamat
			if ($row->alias == 'ala') {
				$q3 = "SELECT COUNT(a.NRK) AS JML
                        FROM PERS_ALAMAT_HIST a
                        LEFT JOIN PERS_KOWIL_TBL b ON a.KOWIL = b.KOWIL
                        LEFT JOIN PERS_KOCAM_TBL c ON a.KOCAM = c.KOCAM AND b.KOWIL = c.KOWIL
                        LEFT JOIN PERS_KOKEL_TBL d ON a.KOKEL = d.KOKEL AND c.KOCAM = d.KOCAM AND b.KOWIL = d.KOWIL
                        LEFT JOIN PERS_PROP_RPT e ON a.PROP = e.PROP
                        LEFT JOIN PERS_STATUS_APPROVAL f on a.STAT_APP = f.KD_STATUS
                        WHERE a.STAT_APP <> 1 ORDER BY TGMULAI DESC
                        ";
				$r3 = $this->ci->db->query($q3)->row();
				if ($r3->JML > 0) {
					$selected = "selected";
				}
			}

			//pendidikan non formal
			if ($row->alias == 'kel') {
				$q4 = "SELECT COUNT(a.NRK) AS JML
                        FROM PERS_KELUARGA a
                        LEFT JOIN PERS_HUBKEL_TBL b ON a.HUBKEL = b.HUBKEL
                        LEFT JOIN PERS_STATTUN_RPT c ON a.STATTUN = c.STATTUN
                        LEFT JOIN PERS_KDKERJA_RPT d ON a.KDKERJA = d.KDKERJA
                        LEFT JOIN PERS_STATUS_APPROVAL e ON a.STAT_APP = e.KD_STATUS
                        WHERE a.STAT_APP <> 1 ORDER BY a.TG_UPD DESC
                        ";
				$r4 = $this->ci->db->query($q4)->row();
				if ($r4->JML > 0) {
					$selected = "selected";
				}
			}
			$option .= "<option value='" . $row->alias . "' $selected>&nbsp; " . $row->nama_menu . "</option>";
		}

		return $option;
	}

	public function getRiwayatPangkat($nrk, $ug, $id) {
		$access['mnac'] = $this->getMenuAccessBy($ug, 305);
		$accIns = $access['mnac']->act_insert;
		$accUpd = $access['mnac']->act_update;
		$accDel = $access['mnac']->act_delete;
		// $accDelFlag=$access['mnac']->act_delete_flag;
		$sql = "SELECT KO.NRK,TO_CHAR(KO.TMT, 'DD-MM-YYYY') TMT, KO.NOSK, TO_CHAR(KO.TGSK, 'DD-MM-YYYY') TGSK, KO.KOPANG,
                KO.TTMASKER, KO.BBMASKER, TB.GOL, TB.NAPANG, KO.KOLOK, LO.NALOKL, KO.GAPOK, TO_CHAR(KO.TG_UPD, 'DD-MM-YYYY HH24:MI:SS') TG_UPD, KO.USER_ID,KO.KLOGAD,LG.NALOKL AS NAKLOGAD,KO.SPMU, SP.NAMA AS NAMA_SPM,f.KETERANGAN AS KET_PEJTT,g.KETERANGAN AS KET_JENRUB,KO.JENRUB
                FROM PERS_PANGKAT_HIST KO
                LEFT JOIN PERS_PANGKAT_TBL TB ON KO.KOPANG = TB.KOPANG
                LEFT JOIN PERS_LOKASI_TBL LO ON KO.KOLOK = LO.KOLOK
                LEFT JOIN PERS_LOKASI_TBL LG ON KO.KLOGAD = LG.KOLOK
                LEFT JOIN PERS_TABEL_SPMU SP ON KO.SPMU = SP.KODE_SPM
                LEFT JOIN PERS_PEJTT_RPT f ON KO.PEJTT = f.PEJTT
                LEFT JOIN PERS_JENRUB_RPT g ON KO.JENRUB = g.JENRUB
                WHERE KO.NRK = '" . $nrk . "'
                ORDER BY KO.TMT DESC";
		// AND KO.DELETED IS NULL

		$query = $this->ci->db->query($sql);

		$i = 1;

		$table = "<div class='ibox float-e-margins animated fadeInDown'>"; //START IBOX
		$table .= "<div class='ibox-title navy-bg'>
                        <h5>Riwayat Pangkat</h5>
                        <div class=\"ibox-tools\">
                            <a class=\"collapse-link\">
                                <i class=\"fa fa-chevron-up\"></i>
                            </a>
                            <a class=\"close-link\">
                                <i class=\"fa fa-times\"></i>
                            </a>
                        </div>
        </div>"; //IBOX TITLE
		$table .= "<div class='ibox-content'>"; //START IBOX CONTENT
		$table .= "<div id='_content_riwayat_" . $id . "' class='animated fadeInUp'>";
		if ($accIns == 'Y') {
			$table .= "<div class='pull-right'><button type='button' class='btn btn-primary btn-sm btn-block m-t' onClick='getForm(\"pangkat\",\"tambah\");'><i class='fa fa-plus'></i> Tambah Data</button></div>";
		}
		$table .= "<table class='table table-striped table-bordered table-hover dataTables-example' width='99%'>";
		$table .= "<thead>";
		$table .= " <tr>
                        <th>No</th>
                        <th>TMT</th>
                        <th>Perubahan</th>
                        <th>Pangkat (Gol)</th>
                        <th>Tahun Kerja Gol</th>
                        <th>Bulan Kerja Gol</th>
                        <th>Gaji Pokok (Rp.)</th>
                        <th>Lokasi Kerja</th>
                        <th>Lokasi Gaji</th>
                        <th>SKPD</th>
                         <th>No.SK <br/> <strong><small class='text-navy'>(Tgl. SK)</small></strong></th>
                        <th>Pejabat Penanda Tangan</th>
                        <th>User ID <br/><strong><small class='text-navy'>(Tgl. Update)</small></strong></th><th>Aksi</th>
                    </tr>";
		$table .= "</thead>";
		$table .= "<tbody>";
		foreach ($query->result() as $row) {
			$table .= "<tr>";
			$table .= "<td width='5px'>" . $i . "</td>";
//                    $tmt = date('d M Y', strtotime($row->TMT));
			$table .= "<td>" . $row->TMT . "</td>";
			if ($row->JENRUB == null) {
				$table .= "<td> - </td>";
			} else {
				$table .= "<td>" . $row->KET_JENRUB . "</td>";
			}

			$table .= "<td>" . $row->NAPANG . " <br/>(" . $row->GOL . " )</td>";
			$table .= "<td>" . $row->TTMASKER . "</td>";
			$table .= "<td>" . $row->BBMASKER . "</td>";
			$table .= "<td align='right'>" . number_format($row->GAPOK, 0, ',', '.') . "</td>";
			$table .= "<td>" . $row->NALOKL . "<br><strong><small class='text-success'>(" . $row->KOLOK . ")</small></strong></td>";
			if ($row->KLOGAD == null) {
				$table .= "<td> - <br><strong><small class='text-success'>( - )</small></strong></td>";
			} else {
				$table .= "<td>" . $row->NAKLOGAD . "<br><strong><small class='text-success'>(" . $row->KLOGAD . ")</small></strong></td>";
			}

			if ($row->SPMU == null) {
				$table .= "<td> - <br><strong><small class='text-success'>( - )</small></strong></td>";
			} else {
				$table .= "<td>" . $row->NAMA_SPM . "<br><strong><small class='text-success'>(" . $row->SPMU . ")</small></strong></td>";
			}

			$table .= "<td>" . $row->NOSK . "<br><strong><small class='text-navy'>(" . $row->TGSK . ")</small></strong></td>";
			$table .= "<td>" . $row->KET_PEJTT . "</td>";
			$table .= "<td>" . $row->USER_ID . "<br><strong><small class='text-navy'>(" . $row->TG_UPD . ")</small></strong></td>";
			$table .= "<td >";
			if ($accUpd == 'Y') {
				$table .= "<button type='button' class='btn btn-outline btn-xs btn-success' title='Edit' onClick='getForm(\"pangkat\",\"update\",\"" . $row->NRK . "\",\"" . date('d-m-Y', strtotime($row->TMT)) . "\",\"" . $row->KOPANG . "\");'><i class='fa fa-pencil-square'></i></button> &nbsp;";
			}
			// if($accDelFlag == 'Y'){
			//     $table.="<button type='button' class='btn btn-outline btn-xs btn-danger' title='Hapus' onClick='confirmHapusDataFlag(\"pangkat\",\"".$row->NRK."\",\"".date('d-m-Y', strtotime($row->TMT))."\",\"".$row->KOPANG."\");'><i class='fa fa-trash'></i></button>";
			// }
			if ($accDel == 'Y') {
				$table .= "<button type='button' class='btn btn-outline btn-xs btn-danger' title='Hapus ' onClick='confirmHapusData(\"pangkat\",\"" . $row->NRK . "\",\"" . date('d-m-Y', strtotime($row->TMT)) . "\",\"" . $row->KOPANG . "\");'><i class='fa fa-trash'></i></button>";
			}
			$table .= "</td>";
			$table .= "</tr>";

			$i++;
		}
		$table .= "</tbody>";
		$table .= "</table>";
		$table .= "</div>";
		$table .= "</div>"; //END IBOX CONTENT
		$table .= "</div>"; //END IBOX
		$table .= "<script src=\"" . base_url() . "assets/inspinia/js/inspinia.js\"></script>"; //END IBOX

		return $table;
	}

	public function getRiwayatPangkatPeg($nrk, $ug, $id) {
		$access['mnac'] = $this->getMenuAccessBy($ug, 305);
		$accIns = $access['mnac']->act_insert;
		$accUpd = $access['mnac']->act_update;
		$accDel = $access['mnac']->act_delete;
		// $accDelFlag=$access['mnac']->act_delete_flag;
		$sql = "SELECT KO.NRK,TO_CHAR(KO.TMT, 'DD-MM-YYYY') TMT, KO.NOSK, TO_CHAR(KO.TGSK, 'DD-MM-YYYY') TGSK, KO.KOPANG,
                KO.TTMASKER, KO.BBMASKER, TB.GOL, TB.NAPANG, KO.KOLOK, LO.NALOKL, KO.GAPOK, TO_CHAR(KO.TG_UPD, 'DD-MM-YYYY HH24:MI:SS') TG_UPD, KO.USER_ID,KO.KLOGAD,LG.NALOKL AS NAKLOGAD,KO.SPMU, SP.NAMA AS NAMA_SPM,f.KETERANGAN AS KET_PEJTT,g.KETERANGAN AS KET_JENRUB,KO.JENRUB
                FROM PERS_PANGKAT_HIST KO
                LEFT JOIN PERS_PANGKAT_TBL TB ON KO.KOPANG = TB.KOPANG
                LEFT JOIN PERS_LOKASI_TBL LO ON KO.KOLOK = LO.KOLOK
                LEFT JOIN PERS_LOKASI_TBL LG ON KO.KLOGAD = LG.KOLOK
                LEFT JOIN PERS_TABEL_SPMU SP ON KO.SPMU = SP.KODE_SPM
                LEFT JOIN PERS_PEJTT_RPT f ON KO.PEJTT = f.PEJTT
                LEFT JOIN PERS_JENRUB_RPT g ON KO.JENRUB = g.JENRUB
                WHERE KO.NRK = '" . $nrk . "'

                ORDER BY KO.TMT DESC";
		// AND KO.DELETED IS NULL

		$query = $this->ci->db->query($sql);

		$i = 1;

		$table = "<div class='ibox float-e-margins animated fadeInDown'>"; //START IBOX
		$table .= "<div class='ibox-title navy-bg'>
                        <h5>Riwayat Pangkat</h5>
                        <div class=\"ibox-tools\">
                            <a class=\"collapse-link\">
                                <i class=\"fa fa-chevron-up\"></i>
                            </a>
                            <a class=\"close-link\">
                                <i class=\"fa fa-times\"></i>
                            </a>
                        </div>
        </div>"; //IBOX TITLE
		$table .= "<div class='ibox-content'>"; //START IBOX CONTENT
		$table .= "<div id='_content_riwayat_" . $id . "' class='animated fadeInUp'>";
		if ($accIns == 'Y') {
			$table .= "<div class='pull-right'><button type='button' class='btn btn-primary btn-sm btn-block m-t' onClick='getForm(\"pangkat\",\"tambah\");'><i class='fa fa-plus'></i> Tambah Data</button></div>";
		}
		$table .= "<table class='table table-striped table-bordered table-hover dataTables-example' width='99%'>";
		$table .= "<thead>";
		$table .= " <tr>
                        <th>No</th>
                        <th>TMT</th>
                        <th>Perubahan</th>
                        <th>Pangkat (Gol)</th>
                        <th>Tahun Kerja Gol</th>
                        <th>Bulan Kerja Gol</th>
                        <th>Gaji Pokok (Rp.)</th>
                        <th>Lokasi Kerja</th>
                        <th>Lokasi Gaji</th>
                        <th>SKPD</th>
                        <th>No.SK <br/> <strong><small class='text-navy'>(Tgl. SK)</small></strong></th>
                        <th>Pejabat Penanda Tangan</th>
                    </tr>";
		$table .= "</thead>";
		$table .= "<tbody>";
		foreach ($query->result() as $row) {
			$table .= "<tr>";
			$table .= "<td>" . $i . "</td>";
//                    $tmt = date('d M Y', strtotime($row->TMT));
			$table .= "<td>" . $row->TMT . "</td>";
			if ($row->JENRUB == null) {
				$table .= "<td> - </td>";
			} else {
				$table .= "<td>" . $row->KET_JENRUB . "</td>";
			}

			$table .= "<td>" . $row->NAPANG . " <br/>(" . $row->GOL . " )</td>";
			$table .= "<td>" . $row->TTMASKER . "</td>";
			$table .= "<td>" . $row->BBMASKER . "</td>";
			$table .= "<td align='right'>" . number_format($row->GAPOK, 0, ',', '.') . "</td>";
			$table .= "<td>" . $row->NALOKL . "</td>";
			if ($row->KLOGAD == null) {
				$table .= "<td> - </td>";
			} else {
				$table .= "<td>" . $row->NAKLOGAD . "</td>";
			}

			if ($row->SPMU == null) {
				$table .= "<td> - </td>";
			} else {
				$table .= "<td>" . $row->NAMA_SPM . "<br></td>";
			}
			$table .= "<td>" . $row->NOSK . "<br><strong><small class='text-navy'>(" . $row->TGSK . ")</small></strong></td>";
			$table .= "<td>" . $row->KET_PEJTT . "</td>";

			/*$table .= "<td >";
				                if($accUpd == 'Y'){
				                    $table.="<button type='button' class='btn btn-outline btn-xs btn-success' title='Edit' onClick='getForm(\"pangkat\",\"update\",\"".$row->NRK."\",\"".date('d-m-Y', strtotime($row->TMT))."\",\"".$row->KOPANG."\");'><i class='fa fa-pencil-square'></i></button> &nbsp;";
				                }
				                if($accDel == 'Y'){
				                    $table.="<button type='button' class='btn btn-outline btn-xs btn-danger' title='Hapus' onClick='confirmHapusData(\"pangkat\",\"".$row->NRK."\",\"".date('d-m-Y', strtotime($row->TMT))."\",\"".$row->KOPANG."\");'><i class='fa fa-trash'></i></button>";
			*/
			$table .= "</td>";
			$table .= "</tr>";

			$i++;
		}
		$table .= "</tbody>";
		$table .= "</table>";
		$table .= "</div>";
		$table .= "</div>"; //END IBOX CONTENT
		$table .= "</div>"; //END IBOX
		$table .= "<script src=\"" . base_url() . "assets/inspinia/js/inspinia.js\"></script>"; //END IBOX

		return $table;
	}

	public function getRiwayatGapok($nrk, $ug, $id) {
		$access['mnac'] = $this->getMenuAccessBy($ug, 306);
		$accIns = $access['mnac']->act_insert;
		$accUpd = $access['mnac']->act_update;
		$accDel = $access['mnac']->act_delete;
		// $accDelFlag=$access['mnac']->act_delete_flag;

		$sql = "SELECT a.NRK, to_char(a.TMT, 'YYYY-MM-DD') TMT, a.NOSK, to_char(a.TGSK, 'DD-MM-YYYY') TGSK, a.KOPANG,a.TTMASKER, a.BBMASKER, b.NAPANG, b.GOL, a.GAPOK, a.KOLOK, c.NALOKL,d.KETERANGAN, to_char(a.TG_UPD, 'DD-MM-YYYY HH24:MI:SS') TG_UPD, a.USER_ID,a.KLOGAD,a.SPMU,e.NALOKL AS NAKLOGAD,f.NAMA AS NAMA_SPM,a.TAHUN_REFGAJI
                FROM PERS_RB_GAPOK_HIST a
                LEFT JOIN PERS_PANGKAT_TBL b ON a.KOPANG = b.KOPANG
                LEFT JOIN PERS_LOKASI_TBL c ON a.KOLOK = c.KOLOK
                LEFT JOIN PERS_JENRUB_RPT d on a.JENRUB = d.JENRUB
                LEFT JOIN PERS_LOKASI_TBL e on a.KLOGAD = e.KOLOK
                LEFT JOIN PERS_TABEL_SPMU f on a.SPMU = f.KODE_SPM

                WHERE a.NRK = '" . $nrk . "'

                ORDER BY a.TMT DESC,a.GAPOK DESC";
		// AND a.DELETED IS NULL

		$query = $this->ci->db->query($sql);

		$i = 1;

		$table = "<div class='ibox float-e-margins animated fadeInDown'>"; //START IBOX
		$table .= "<div class='ibox-title navy-bg'>
                        <h5>Riwayat Gaji Pokok</h5>
                        <div class=\"ibox-tools\">
                            <a class=\"collapse-link\">
                                <i class=\"fa fa-chevron-up\"></i>
                            </a>
                            <a class=\"close-link\">
                                <i class=\"fa fa-times\"></i>
                            </a>
                        </div>
        </div>"; //IBOX TITLE
		$table .= "<div class='ibox-content'>"; //START IBOX CONTENT
		$table .= "<div id='_content_riwayat_" . $id . "' class='animated fadeInUp'>";
		if ($accIns == 'Y') {
			$table .= "<div class='pull-right'><button type='button' class='btn btn-primary btn-sm btn-block m-t' onClick='getForm(\"gapok\",\"tambah\");'><i class='fa fa-plus'></i> Tambah Data</button></div>";
		}
		$table .= "<table class='table table-striped table-bordered table-hover dataTables-example' width='99%'>";
		$table .= "<thead>";
		$table .= " <tr>
                        <th>No</th>
                        <th>TMT</th>
                        <th>Perubahan</th>
                        <th>Pangkat (Gol)</th>
                        <th>Tahun Kerja Gol</th>
                        <th>Bulan Kerja Gol</th>
                        <th>Gaji Pokok (Rp.)</th>
                        <th>Tahun Ref. Gaji</th>
                        <th>Lokasi Kerja</th>
                        <th>Lokasi Gaji</th>
                        <th>SKPD</th>
                        <th>No.SK <br/> <strong><small class='text-navy'>(Tgl. SK)</small></strong></th>

                        <th>User ID <br/><strong><small class='text-navy'>(Tgl. Update)</small></strong></th>

                        <th>Aksi</th>
                    </tr>";
		$table .= "</thead>";
		$table .= "<tbody>";
		foreach ($query->result() as $row) {
			$table .= "<tr>";
			$table .= "<td width='5px'>" . $i . "</td>";
			$tmt = date('d-m-Y', strtotime($row->TMT));
			$table .= "<td width='85px'>" . $tmt . "</td>";

//                    $tgsk = date('d M Y', strtotime($row->TGSK));

			$table .= "<td>" . $row->KETERANGAN . "</td>";
			$table .= "<td>" . $row->NAPANG . " <br/>( " . $row->GOL . " )</td>";

			$table .= "<td>" . $row->TTMASKER . "</td>";
			$table .= "<td>" . $row->BBMASKER . "</td>";
			$table .= "<td align='right'>" . number_format($row->GAPOK, 0, ',', '.') . "</td>";
			if ($row->TAHUN_REFGAJI == null) {
				$table .= "<td> - </td>";
			} else {
				$table .= "<td>" . $row->TAHUN_REFGAJI . "</td>";
			}

			$table .= "<td>" . $row->NALOKL . "<br><strong><small class='text-success'>(" . $row->KOLOK . ")</small></strong></td>";
			if ($row->KLOGAD == null) {
				$table .= "<td> - <br><strong><small class='text-success'>( - )</small></strong></td>";
			} else {
				$table .= "<td>" . $row->NAKLOGAD . "<br><strong><small class='text-success'>(" . $row->KLOGAD . ")</small></strong></td>";
			}

			if ($row->SPMU == null) {
				$table .= "<td> - <br><strong><small class='text-success'>( - )</small></strong></td>";
			} else {
				$table .= "<td>" . $row->NAMA_SPM . "<br><strong><small class='text-success'>(" . $row->SPMU . ")</small></strong></td>";
			}

			$table .= "<td>" . $row->NOSK . "<br><strong><small class='text-navy'>(" . $row->TGSK . ")</small></strong></td>";

			$table .= "<td>" . $row->USER_ID . "<br><strong><small class='text-navy'>(" . $row->TG_UPD . ")</small></strong></td>";

			$table .= "<td>";
			if ($accUpd == 'Y') {
				$table .= "<button type='button' class='btn btn-outline btn-xs btn-success' title='Edit' onClick='getForm(\"gapok\",\"update\",\"" . $row->NRK . "\",\"" . $row->TMT . "\",\"" . $row->GAPOK . "\");'><i class='fa fa-pencil-square'></i></button> &nbsp;";
			}
			// if($accDelFlag == 'Y'){
			//     $table.="<button type='button' class='btn btn-outline btn-xs btn-danger' title='Hapus' onClick='confirmHapusDataFlag(\"gapok\",\"".$row->NRK."\",\"".$row->TMT."\",\"".$row->GAPOK."\",\"".$row->KOPANG."\");'><i class='fa fa-trash'></i></button> &nbsp;";
			// }
			if ($accDel == 'Y') {
				$table .= "<button type='button' class='btn btn-outline btn-xs btn-danger' title='Hapus ' onClick='confirmHapusData(\"gapok\",\"" . $row->NRK . "\",\"" . $row->TMT . "\",\"" . $row->GAPOK . "\",\"" . $row->KOPANG . "\");'><i class='fa fa-trash'></i></button>";
			}
			$table .= "</td>";
			$table .= "</tr>";

			$i++;
		}
		$table .= "</tbody>";
		$table .= "</table>";
		$table .= "</div>";
		$table .= "</div>"; //END IBOX CONTENT
		$table .= "</div>"; //END IBOX
		$table .= "<script src=\"" . base_url() . "assets/inspinia/js/inspinia.js\"></script>"; //END IBOX

		return $table;
	}

	public function getRiwayatGapokPeg($nrk, $ug, $id) {
		$access['mnac'] = $this->getMenuAccessBy($ug, 306);
		$accIns = $access['mnac']->act_insert;
		$accUpd = $access['mnac']->act_update;
		$accDel = $access['mnac']->act_delete;
		// $accDelFlag=$access['mnac']->act_delete_flag;

		$sql = "SELECT a.NRK, to_char(a.TMT, 'YYYY-MM-DD') TMT, a.NOSK, to_char(a.TGSK, 'DD-MM-YYYY') TGSK, a.KOPANG,a.TTMASKER, a.BBMASKER, b.NAPANG, b.GOL, a.GAPOK, a.KOLOK, c.NALOKL,d.KETERANGAN, to_char(a.TG_UPD, 'DD-MM-YYYY HH24:MI:SS') TG_UPD, a.USER_ID,a.KLOGAD,a.SPMU,e.NALOKL AS NAKLOGAD,f.NAMA AS NAMA_SPM,a.TAHUN_REFGAJI
                FROM PERS_RB_GAPOK_HIST a
                LEFT JOIN PERS_PANGKAT_TBL b ON a.KOPANG = b.KOPANG
                LEFT JOIN PERS_LOKASI_TBL c ON a.KOLOK = c.KOLOK
                LEFT JOIN PERS_JENRUB_RPT d on a.JENRUB = d.JENRUB
                LEFT JOIN PERS_LOKASI_TBL e on a.KLOGAD = e.KOLOK
                LEFT JOIN PERS_TABEL_SPMU f on a.SPMU = f.KODE_SPM

                WHERE a.NRK = '" . $nrk . "'

                ORDER BY a.TMT DESC,a.GAPOK DESC";

		$query = $this->ci->db->query($sql);

		$i = 1;

		$table = "<div class='ibox float-e-margins animated fadeInDown'>"; //START IBOX
		$table .= "<div class='ibox-title navy-bg'>
                        <h5>Riwayat Gaji Pokok</h5>
                        <div class=\"ibox-tools\">
                            <a class=\"collapse-link\">
                                <i class=\"fa fa-chevron-up\"></i>
                            </a>
                            <a class=\"close-link\">
                                <i class=\"fa fa-times\"></i>
                            </a>
                        </div>
        </div>"; //IBOX TITLE
		$table .= "<div class='ibox-content'>"; //START IBOX CONTENT
		$table .= "<div id='_content_riwayat_" . $id . "' class='animated fadeInUp'>";
		if ($accIns == 'Y') {
			$table .= "<div class='pull-right'><button type='button' class='btn btn-primary btn-sm btn-block m-t' onClick='getForm(\"gapok\",\"tambah\");'><i class='fa fa-plus'></i> Tambah Data</button></div>";
		}
		$table .= "<table class='table table-striped table-bordered table-hover dataTables-example' width='99%'>";
		$table .= "<thead>";
		$table .= " <tr>
                        <th>No</th>
                        <th>TMT</th>
                        <th>Perubahan</th>
                        <th>Pangkat</th>
                        <th>Golongan</th>
                        <th>Tahun Kerja Gol</th>
                        <th>Bulan Kerja Gol</th>
                        <th>Gaji Pokok (Rp.)</th>
                        <th>Tahun Ref. Gaji</th>
                        <th>Lokasi Kerja</th>
                        <th>Lokasi Gaji</th>
                        <th>SKPD</th>
                        <th>No.SK <br/> <strong><small class='text-navy'>(Tgl. SK)</small></strong></th>

                    </tr>";
		$table .= "</thead>";
		$table .= "<tbody>";
		foreach ($query->result() as $row) {
			$table .= "<tr>";
			$table .= "<td>" . $i . "</td>";
			$tmt = date('d-m-Y', strtotime($row->TMT));
			$table .= "<td>" . $tmt . "</td>";

//                    $tgsk = date('d M Y', strtotime($row->TGSK));

			$table .= "<td>" . $row->KETERANGAN . "</td>";
			$table .= "<td>" . $row->NAPANG . "</td>";
			$table .= "<td>" . $row->GOL . "</td>";
			$table .= "<td>" . $row->TTMASKER . "</td>";
			$table .= "<td>" . $row->BBMASKER . "</td>";
			$table .= "<td align='right'>" . number_format($row->GAPOK, 0, ',', '.') . "</td>";
			if ($row->TAHUN_REFGAJI == null) {
				$table .= "<td> - </td>";
			} else {
				$table .= "<td>" . $row->TAHUN_REFGAJI . "</td>";
			}

			$table .= "<td>" . $row->NALOKL . "</td>";
			if ($row->KLOGAD == null) {
				$table .= "<td> - </td>";
			} else {
				$table .= "<td>" . $row->NAKLOGAD . "</td>";
			}

			if ($row->SPMU == null) {
				$table .= "<td> - </td>";
			} else {
				$table .= "<td>" . $row->NAMA_SPM . "</td>";
			}
			$table .= "<td>" . $row->NOSK . "<br><strong><small class='text-navy'>(" . $row->TGSK . ")</small></strong></td>";

			$table .= "</tr>";

			$i++;
		}
		$table .= "</tbody>";
		$table .= "</table>";
		$table .= "</div>";
		$table .= "</div>"; //END IBOX CONTENT
		$table .= "</div>"; //END IBOX
		$table .= "<script src=\"" . base_url() . "assets/inspinia/js/inspinia.js\"></script>"; //END IBOX

		return $table;
	}

	public function getHukumanDisiplin($nrk, $ug, $id) {
		$access['mnac'] = $this->getMenuAccessBy($ug, 307);
		$accIns = $access['mnac']->act_insert;
		$accUpd = $access['mnac']->act_update;
		$accDel = $access['mnac']->act_delete;
		// $accDelFlag=$access['mnac']->act_delete_flag;

		$sql = "SELECT a.NRK, to_char(a.TGSK, 'YYYY-MM-DD') TGSK, a.NOSK, b.KETERANGAN,
                  to_char(a.TGMULAI, 'DD-MM-YYYY') TGMULAI, to_char(a.TGAKHIR, 'DD-MM-YYYY') TGAKHIR,
                  to_char(a.TG_UPD, 'DD-MM-YYYY HH24:MI:SS') TG_UPD,to_char(a.TMTMULAI_STOPTKD, 'DD-MM-YYYY') TMTMULAI_STOPTKD,to_char(a.TMTAKHIR_STOPTKD, 'DD-MM-YYYY') TMTAKHIR_STOPTKD,a.JMLBLN_STOPTKD, a.USER_ID,c.KETERANGAN AS KET_PEJTT,a.KET
                FROM PERS_DISIPLIN_HIST a
                LEFT JOIN PERS_JENHUKDIS_RPT b ON a.JENHUKDIS = b.JENHUKDIS
                LEFT JOIN PERS_PEJTT_RPT c ON a.PEJTT = c.PEJTT
                WHERE a.NRK = '" . $nrk . "'

                ORDER BY a.TGSK DESC";
		// AND a.DELETED IS NULL

		$query = $this->ci->db->query($sql);

		$i = 1;

		$table = "<div class='ibox float-e-margins animated fadeInDown'>"; //START IBOX
		$table .= "<div class='ibox-title navy-bg'>
                        <h5>Riwayat Hukuman Disiplin</h5>
                        <div class=\"ibox-tools\">
                            <a class=\"collapse-link\">
                                <i class=\"fa fa-chevron-up\"></i>
                            </a>
                            <a class=\"close-link\">
                                <i class=\"fa fa-times\"></i>
                            </a>
                        </div>
        </div>"; //IBOX TITLE
		$table .= "<div class='ibox-content'>"; //START IBOX CONTENT
		$table .= "<div id='_content_riwayat_" . $id . "' class='animated fadeInUp'>";
		if ($accIns == 'Y') {
			$table .= "<div class='pull-right'><button type='button' class='btn btn-primary btn-sm btn-block m-t' onClick='getForm(\"hukdis\",\"tambah\");'><i class='fa fa-plus'></i> Tambah Data</button></div>";
		}
		$table .= "<table class='table table-striped table-bordered table-hover dataTables-example' width='99%'>";
		$table .= "<thead>";
		$table .= " <tr>
                        <th>No</th>
                        <th>Jenis Hukuman</th>
                        <th>Tanggal Mulai</th>
                        <th>Tanggal Berakhir</th>
                        <th>No.SK <br/> <strong><small class='text-navy'>(Tgl. SK)</small></strong></th>
                        <th>Pejabat Penanda Tangan</th>
                        <th>TMT Stop TKD <br/> <strong><small class='text-navy'>(bulan)</small></strong></th>
                        <th>Ket. Stop TKD</th>
                        <th>User ID <br/><strong><small class='text-navy'>(Tgl. Update)</small></strong></th><th>Aksi</th>
                    </tr>";
		$table .= "</thead>";
		$table .= "<tbody>";
		foreach ($query->result() as $row) {
			$table .= "<tr>";
			$table .= "<td width='5px'>" . $i . "</td>";

			$table .= "<td>" . $row->KETERANGAN . "</td>";
//                    $mulai = date('d M Y', strtotime($row->TGMULAI));
			$table .= "<td>" . $row->TGMULAI . "</td>";
//                    $akhir = date('d M Y', strtotime($row->TGAKHIR));
			if ($row->TGAKHIR != null) {
				$table .= "<td>" . $row->TGAKHIR . "</td>";
			} else {
				$table .= "<td> - </td>";
			}

			$tgsk = date('d-m-Y', strtotime($row->TGSK));
			$table .= "<td>" . $row->NOSK . "<br><strong><small class='text-navy'>(" . $tgsk . ")</small></strong></td>";
			$table .= "<td>" . $row->KET_PEJTT . "</td>";

			if ($row->TMTMULAI_STOPTKD != null && $row->JMLBLN_STOPTKD != null) {
				$table .= "<td>" . $row->TMTMULAI_STOPTKD . " - " . $row->TMTAKHIR_STOPTKD . "<br><strong><small class='text-navy'>( " . $row->JMLBLN_STOPTKD . " )</small></strong></td>";
			} else if ($row->TMTMULAI_STOPTKD != null && ($row->JMLBLN_STOPTKD == null || $row->JMLBLN_STOPTKD == 0)) {
				$table .= "<td>" . $row->TMTMULAI_STOPTKD . "</td>";
			} else {
				$table .= "<td> - </td>";
			}

			if ($row->KET != null) {
				$table .= "<td>" . $row->KET . "</td>";
			} else {
				$table .= "<td> - </td>";
			}
			$table .= "<td>" . $row->USER_ID . "<br><strong><small class='text-navy'>(" . $row->TG_UPD . ")</small></strong></td>";
			$table .= "<td >";
			if ($accUpd == 'Y') {
				$table .= "<button type='button' class='btn btn-outline btn-xs btn-success' title='Edit' onClick='getForm(\"hukdis\",\"update\",\"" . $row->NRK . "\",\"" . $row->TGSK . "\");'><i class='fa fa-pencil-square'></i></button> &nbsp;";
			}
			// if($accDelFlag == 'Y'){
			//     $table.=    "<button type='button' class='btn btn-outline btn-xs btn-danger' title='Hapus' onClick='confirmHapusDataFlag(\"hukdis\",\"".$row->NRK."\",\"".$row->TGSK."\");'><i class='fa fa-trash'></i></button> &nbsp;";
			// }
			if ($accDel == 'Y') {
				$table .= "<button type='button' class='btn btn-outline btn-xs btn-danger' title='Hapus ' onClick='confirmHapusData(\"hukdis\",\"" . $row->NRK . "\",\"" . $row->TGSK . "\");'><i class='fa fa-trash'></i></button>";
			}
			$table .= "</td>";
			$table .= "</tr>";

			$i++;
		}
		$table .= "</tbody>";
		$table .= "</table>";
		$table .= "</div>";
		$table .= "</div>"; //END IBOX CONTENT
		$table .= "</div>"; //END IBOX
		$table .= "<script src=\"" . base_url() . "assets/inspinia/js/inspinia.js\"></script>"; //END IBOX

		return $table;
	}

	public function getHukumanDisiplinPeg($nrk, $ug, $id) {
		$access['mnac'] = $this->getMenuAccessBy($ug, 307);
		$accIns = $access['mnac']->act_insert;
		$accUpd = $access['mnac']->act_update;
		$accDel = $access['mnac']->act_delete;
		// $accDelFlag=$access['mnac']->act_delete_flag;

		/*$sql = "SELECT a.NRK, to_char(a.TGSK, 'YYYY-MM-DD') TGSK, a.NOSK, b.KETERANGAN,
			                  to_char(a.TGMULAI, 'DD-MM-YYYY') TGMULAI, to_char(a.TGAKHIR, 'DD-MM-YYYY') TGAKHIR,
			                  to_char(a.TG_UPD, 'DD-MM-YYYY HH24:MI:SS') TG_UPD, a.USER_ID
			                FROM PERS_DISIPLIN_HIST a
			                LEFT JOIN PERS_JENHUKDIS_RPT b ON a.JENHUKDIS = b.JENHUKDIS
			                WHERE a.NRK = '".$nrk."'

		*/

		$sql = "SELECT a.NRK, to_char(a.TGSK, 'YYYY-MM-DD') TGSK, a.NOSK, b.KETERANGAN,
                  to_char(a.TGMULAI, 'DD-MM-YYYY') TGMULAI, to_char(a.TGAKHIR, 'DD-MM-YYYY') TGAKHIR,
                  to_char(a.TG_UPD, 'DD-MM-YYYY HH24:MI:SS') TG_UPD,to_char(a.TMTMULAI_STOPTKD, 'DD-MM-YYYY') TMTMULAI_STOPTKD,to_char(a.TMTAKHIR_STOPTKD, 'DD-MM-YYYY') TMTAKHIR_STOPTKD,a.JMLBLN_STOPTKD, a.USER_ID,c.KETERANGAN AS KET_PEJTT,a.KET
                FROM PERS_DISIPLIN_HIST a
                LEFT JOIN PERS_JENHUKDIS_RPT b ON a.JENHUKDIS = b.JENHUKDIS
                LEFT JOIN PERS_PEJTT_RPT c ON a.PEJTT = c.PEJTT
                WHERE a.NRK = '" . $nrk . "'

                ORDER BY a.TGSK DESC";
		// AND a.DELETED IS NULL

		$query = $this->ci->db->query($sql);

		$i = 1;

		$table = "<div class='ibox float-e-margins animated fadeInDown'>"; //START IBOX
		$table .= "<div class='ibox-title navy-bg'>
                        <h5>Riwayat Hukuman Disiplin</h5>
                        <div class=\"ibox-tools\">
                            <a class=\"collapse-link\">
                                <i class=\"fa fa-chevron-up\"></i>
                            </a>
                            <a class=\"close-link\">
                                <i class=\"fa fa-times\"></i>
                            </a>
                        </div>
        </div>"; //IBOX TITLE
		$table .= "<div class='ibox-content'>"; //START IBOX CONTENT
		$table .= "<div id='_content_riwayat_" . $id . "' class='animated fadeInUp'>";
		if ($accIns == 'Y') {
			$table .= "<div class='pull-right'><button type='button' class='btn btn-primary btn-sm btn-block m-t' onClick='getForm(\"hukdis\",\"tambah\");'><i class='fa fa-plus'></i> Tambah Data</button></div>";
		}
		$table .= "<table class='table table-striped table-bordered table-hover dataTables-example' width='99%'>";
		$table .= "<thead>";
		$table .= " <tr>
                        <th>No</th>
                        <th>Jenis Hukuman</th>
                        <th>Tanggal Mulai</th>
                        <th>Tanggal Berakhir</th>
                        <th>No.SK <br/> <strong><small class='text-navy'>(Tgl. SK)</small></strong></th>
                        <th>Pejabat Penanda Tangan</th>
                        <th>TMT Stop TKD <br/> <strong><small class='text-navy'>(bulan)</small></strong></th>
                        <th>Ket. Stop TKD</th>
                    </tr>";
		$table .= "</thead>";
		$table .= "<tbody>";
		foreach ($query->result() as $row) {
			$table .= "<tr>";
			$table .= "<td width='5px'>" . $i . "</td>";

			$table .= "<td>" . $row->KETERANGAN . "</td>";
//                    $mulai = date('d M Y', strtotime($row->TGMULAI));
			$table .= "<td>" . $row->TGMULAI . "</td>";
//                    $akhir = date('d M Y', strtotime($row->TGAKHIR));
			if ($row->TGAKHIR != null) {
				$table .= "<td>" . $row->TGAKHIR . "</td>";
			} else {
				$table .= "<td> - </td>";
			}
			$tgsk = date('d-m-Y', strtotime($row->TGSK));
			$table .= "<td>" . $row->NOSK . "<br><strong><small class='text-navy'>(" . $tgsk . ")</small></strong></td>";
			$table .= "<td>" . $row->KET_PEJTT . "</td>";

			if ($row->TMTMULAI_STOPTKD != null && $row->JMLBLN_STOPTKD != null) {
				$table .= "<td>" . $row->TMTMULAI_STOPTKD . " - " . $row->TMTAKHIR_STOPTKD . "<br><strong><small class='text-navy'>( " . $row->JMLBLN_STOPTKD . " )</small></strong></td>";
			} else if ($row->TMTMULAI_STOPTKD != null && ($row->JMLBLN_STOPTKD == null || $row->JMLBLN_STOPTKD == 0)) {
				$table .= "<td>" . $row->TMTMULAI_STOPTKD . "</td>";
			} else {
				$table .= "<td> - </td>";
			}

			if ($row->KET != null) {
				$table .= "<td>" . $row->KET . "</td>";
			} else {
				$table .= "<td> - </td>";
			}
			$table .= "</tr>";

			$i++;
		}
		$table .= "</tbody>";
		$table .= "</table>";
		$table .= "</div>";
		$table .= "</div>"; //END IBOX CONTENT
		$table .= "</div>"; //END IBOX
		$table .= "<script src=\"" . base_url() . "assets/inspinia/js/inspinia.js\"></script>"; //END IBOX

		return $table;
	}

	public function getHukumanAdministrasi($nrk, $ug, $id) {
		$access['mnac'] = $this->getMenuAccessBy($ug, 308);
		$accIns = $access['mnac']->act_insert;
		$accUpd = $access['mnac']->act_update;
		$accDel = $access['mnac']->act_delete;
		// $accDelFlag=$access['mnac']->act_delete_flag;
		$sql = "SELECT
                  a.NRK, a.NOSK, to_char(a.TGSK, 'YYYY-MM-DD') TGSK , b.KETERANGAN,a.USER_ID,to_char(a.TG_UPD, 'DD-MM-YYYY HH24:MI:SS') TG_UPD,a.PEJTT,c.KETERANGAN AS KET_PEJTT,to_char(a.TGMULAI, 'YYYY-MM-DD') TGMULAI,to_char(a.TGAKHIR, 'YYYY-MM-DD') TGAKHIR,to_char(a.TMTMULAI_STOPTKD, 'DD-MM-YYYY') TMTMULAI_STOPTKD,to_char(a.TMTAKHIR_STOPTKD, 'DD-MM-YYYY') TMTAKHIR_STOPTKD,JMLBLN_STOPTKD,KET
                FROM PERS_ADMIN_HIST a
                LEFT JOIN PERS_JENHUKADM_RPT b ON a.JENHUKADM = b.JENHUKADM
                LEFT JOIN PERS_PEJTT_RPT c ON a.PEJTT =c.PEJTT
                WHERE a.NRK = '" . $nrk . "'

                ORDER BY TGSK DESC";
		// AND a.DELETED IS NULL

		$query = $this->ci->db->query($sql);

		$i = 1;

		$table = "<div class='ibox float-e-margins animated fadeInDown'>"; //START IBOX
		$table .= "<div class='ibox-title navy-bg'>
                        <h5>Riwayat Hukuman Administrasi</h5>
                        <div class=\"ibox-tools\">
                            <a class=\"collapse-link\">
                                <i class=\"fa fa-chevron-up\"></i>
                            </a>
                            <a class=\"close-link\">
                                <i class=\"fa fa-times\"></i>
                            </a>
                        </div>
        </div>"; //IBOX TITLE
		$table .= "<div class='ibox-content'>"; //START IBOX CONTENT
		$table .= "<div id='_content_riwayat_" . $id . "' class='animated fadeInUp'>";
		if ($accIns == 'Y') {
			$table .= "<div class='pull-right'><button type='button' class='btn btn-primary btn-sm btn-block m-t' onClick='getForm(\"hukadmin\",\"tambah\");'><i class='fa fa-plus'></i> Tambah Data</button></div>";
		}
		$table .= "<table class='table table-striped table-bordered table-hover dataTables-example' width='99%'>";
		$table .= "<thead>";
		$table .= " <tr>


                        <th>No</th>
                        <th>Jenis Hukuman</th>
                        <th>Tanggal Mulai</th>
                        <th>Tanggal Berakhir</th>
                        <th>No.SK <br/> <strong><small class='text-navy'>(Tgl. SK)</small></strong></th>
                        <th>Pejabat Penanda Tangan</th>
                        <th>TMT Stop TKD <br/> <strong><small class='text-navy'>(bulan)</small></strong></th>
                        <th>Ket. Stop TKD</th>
                        <th>User ID <br/><strong><small class='text-navy'>(Tgl. Update)</small></strong></th>
                        <th>Aksi</th>
                    </tr>";
		$table .= "</thead>";
		$table .= "<tbody>";
		foreach ($query->result() as $row) {
			$table .= "<tr>";
			$table .= "<td>" . $i . "</td>";
			$table .= "<td>" . $row->KETERANGAN . "</td>";
			$tgmulai = date('d-m-Y', strtotime($row->TGMULAI));
			$table .= "<td>" . $tgmulai . "</td>";
			if ($row->TGAKHIR == null) {
				$table .= "<td> </td>";
			} else {
				$tgakhir = date('d-m-Y', strtotime($row->TGAKHIR));
				$table .= "<td>" . $tgakhir . "</td>";
			}

			$tgsk = date('d-m-Y', strtotime($row->TGSK));
			$table .= "<td>" . $row->NOSK . "<br><strong><small class='text-navy'>(" . $tgsk . ")</small></strong></td>";
			$table .= "<td>" . $row->KET_PEJTT . "</td>";
			if ($row->TMTMULAI_STOPTKD != null && $row->JMLBLN_STOPTKD != null) {
				$table .= "<td>" . $row->TMTMULAI_STOPTKD . " - " . $row->TMTAKHIR_STOPTKD . "<br><strong><small class='text-navy'>( " . $row->JMLBLN_STOPTKD . " )</small></strong></td>";
			} else if ($row->TMTMULAI_STOPTKD != null && ($row->JMLBLN_STOPTKD == null || $row->JMLBLN_STOPTKD == 0)) {
				$table .= "<td>" . $row->TMTMULAI_STOPTKD . "</td>";
			} else {
				$table .= "<td> - </td>";
			}

			if ($row->KET != null) {
				$table .= "<td>" . $row->KET . "</td>";
			} else {
				$table .= "<td> - </td>";
			}

			$table .= "<td>" . $row->USER_ID . "<br><strong><small class='text-navy'>(" . $row->TG_UPD . ")</small></strong></td>";
			$table .= "<td >";
			if ($accUpd == 'Y') {
				$table .= "<button type='button' class='btn btn-outline btn-xs btn-success' title='Edit' onClick='getForm(\"hukadmin\",\"update\",\"" . $row->NRK . "\",\"" . $row->TGSK . "\");'><i class='fa fa-pencil-square'></i></button> &nbsp;";
			}
			if ($accDel == 'Y') {
				$table .= "<button type='button' class='btn btn-outline btn-xs btn-danger' title='Hapus' onClick='confirmHapusData(\"hukadmin\",\"" . $row->NRK . "\",\"" . $row->TGSK . "\");'><i class='fa fa-trash'></i></button>";
			}
			$table .= "</td>";
			$table .= "</tr>";

			$i++;
		}
		$table .= "</tbody>";
		$table .= "</table>";
		$table .= "</div>";
		$table .= "</div>"; //END IBOX CONTENT
		$table .= "</div>"; //END IBOX
		$table .= "<script src=\"" . base_url() . "assets/inspinia/js/inspinia.js\"></script>"; //END IBOX

		return $table;
	}

	public function getHukumanAdministrasiPeg($nrk, $ug, $id) {
		$access['mnac'] = $this->getMenuAccessBy($ug, 308);
		$accIns = $access['mnac']->act_insert;
		$accUpd = $access['mnac']->act_update;
		$accDel = $access['mnac']->act_delete;
		// $accDelFlag=$access['mnac']->act_delete_flag;
		$sql = "SELECT
                  a.NRK, a.NOSK, to_char(a.TGSK, 'YYYY-MM-DD') TGSK , b.KETERANGAN,a.USER_ID,to_char(a.TG_UPD, 'DD-MM-YYYY HH24:MI:SS') TG_UPD,a.PEJTT,c.KETERANGAN AS KET_PEJTT,to_char(a.TGMULAI, 'YYYY-MM-DD') TGMULAI,to_char(a.TGAKHIR, 'YYYY-MM-DD') TGAKHIR,to_char(a.TMTMULAI_STOPTKD, 'DD-MM-YYYY') TMTMULAI_STOPTKD,to_char(a.TMTAKHIR_STOPTKD, 'DD-MM-YYYY') TMTAKHIR_STOPTKD,JMLBLN_STOPTKD,KET
                FROM PERS_ADMIN_HIST a
                LEFT JOIN PERS_JENHUKADM_RPT b ON a.JENHUKADM = b.JENHUKADM
                LEFT JOIN PERS_PEJTT_RPT c ON a.PEJTT =c.PEJTT
                WHERE a.NRK = '" . $nrk . "'

                ORDER BY TGSK DESC";
		// AND a.DELETED IS NULL

		$query = $this->ci->db->query($sql);

		$i = 1;

		$table = "<div class='ibox float-e-margins animated fadeInDown'>"; //START IBOX
		$table .= "<div class='ibox-title navy-bg'>
                        <h5>Riwayat Hukuman Administrasi</h5>
                        <div class=\"ibox-tools\">
                            <a class=\"collapse-link\">
                                <i class=\"fa fa-chevron-up\"></i>
                            </a>
                            <a class=\"close-link\">
                                <i class=\"fa fa-times\"></i>
                            </a>
                        </div>
        </div>"; //IBOX TITLE
		$table .= "<div class='ibox-content'>"; //START IBOX CONTENT
		$table .= "<div id='_content_riwayat_" . $id . "' class='animated fadeInUp'>";
		if ($accIns == 'Y') {
			$table .= "<div class='pull-right'><button type='button' class='btn btn-primary btn-sm btn-block m-t' onClick='getForm(\"hukadmin\",\"tambah\");'><i class='fa fa-plus'></i> Tambah Data</button></div>";
		}
		$table .= "<table class='table table-striped table-bordered table-hover dataTables-example' width='99%'>";
		$table .= "<thead>";
		$table .= " <tr>


                        <th>No</th>
                        <th>Jenis Hukuman</th>
                        <th>Tanggal Mulai</th>
                        <th>Tanggal Berakhir</th>
                        <th>No.SK <br/> <strong><small class='text-navy'>(Tgl. SK)</small></strong></th>
                        <th>Pejabat Penanda Tangan</th>
                        <th>TMT Stop TKD <br/> <strong><small class='text-navy'>(bulan)</small></strong></th>
                        <th>Ket. Stop TKD</th>

                    </tr>";
		$table .= "</thead>";
		$table .= "<tbody>";
		foreach ($query->result() as $row) {
			$table .= "<tr>";
			$table .= "<td>" . $i . "</td>";
			$table .= "<td>" . $row->KETERANGAN . "</td>";
			$tgmulai = date('d-m-Y', strtotime($row->TGMULAI));
			$table .= "<td>" . $tgmulai . "</td>";
			if ($row->TGAKHIR == null) {
				$table .= "<td> </td>";
			} else {
				$tgakhir = date('d-m-Y', strtotime($row->TGAKHIR));
				$table .= "<td>" . $tgakhir . "</td>";
			}

			$tgsk = date('d-m-Y', strtotime($row->TGSK));
			$table .= "<td>" . $row->NOSK . "<br><strong><small class='text-navy'>(" . $tgsk . ")</small></strong></td>";
			$table .= "<td>" . $row->KET_PEJTT . "</td>";
			if ($row->TMTMULAI_STOPTKD != null && $row->JMLBLN_STOPTKD != null) {
				$table .= "<td>" . $row->TMTMULAI_STOPTKD . " - " . $row->TMTAKHIR_STOPTKD . "<br><strong><small class='text-navy'>( " . $row->JMLBLN_STOPTKD . " )</small></strong></td>";
			} else if ($row->TMTMULAI_STOPTKD != null && ($row->JMLBLN_STOPTKD == null || $row->JMLBLN_STOPTKD == 0)) {
				$table .= "<td>" . $row->TMTMULAI_STOPTKD . "</td>";
			} else {
				$table .= "<td> - </td>";
			}

			if ($row->KET != null) {
				$table .= "<td>" . $row->KET . "</td>";
			} else {
				$table .= "<td> - </td>";
			}

			/* $table .= "<td >";
				                if($accUpd == 'Y'){
				                    $table.=    "<button type='button' class='btn btn-outline btn-xs btn-success' title='Edit' onClick='getForm(\"hukadmin\",\"update\",\"".$row->NRK."\",\"".$row->TGSK."\");'><i class='fa fa-pencil-square'></i></button> &nbsp;";
				                }
				                if($accDel == 'Y'){
				                    $table.=    "<button type='button' class='btn btn-outline btn-xs btn-danger' title='Hapus' onClick='confirmHapusData(\"hukadmin\",\"".$row->NRK."\",\"".$row->TGSK."\");'><i class='fa fa-trash'></i></button>";
				                }
			*/
			$table .= "</tr>";

			$i++;
		}
		$table .= "</tbody>";
		$table .= "</table>";
		$table .= "</div>";
		$table .= "</div>"; //END IBOX CONTENT
		$table .= "</div>"; //END IBOX
		$table .= "<script src=\"" . base_url() . "assets/inspinia/js/inspinia.js\"></script>"; //END IBOX

		return $table;
	}

	public function getRiwayatDP3($nrk, $ug, $id) {
		$access['mnac'] = $this->getMenuAccessBy($ug, 309);
		$accIns = $access['mnac']->act_insert;
		$accUpd = $access['mnac']->act_update;
		$accDel = $access['mnac']->act_delete;
		// $accDelFlag=$access['mnac']->act_delete_flag;
		$sql = "SELECT a.NRK, a.TAHUN, a.SETIA, a.PRESTASI, a.TGGJAWAB, a.TAAT, a.JUJUR, a.KERJASAMA, a.PRAKARSA, a.PIMPIN, a.JUMLAH, a.RATA
                FROM PERS_DP3 a
                WHERE a.NRK = '" . $nrk . "'

                ORDER BY TAHUN DESC";
		// AND a.DELETED IS NULL

		$query = $this->ci->db->query($sql);

		$i = 1;

		$table = "<div class='ibox float-e-margins animated fadeInDown'>"; //START IBOX
		$table .= "<div class='ibox-title navy-bg'>
                        <h5>Riwayat DP3</h5>
                        <div class=\"ibox-tools\">
                            <a class=\"collapse-link\">
                                <i class=\"fa fa-chevron-up\"></i>
                            </a>
                            <a class=\"close-link\">
                                <i class=\"fa fa-times\"></i>
                            </a>
                        </div>
        </div>"; //IBOX TITLE
		$table .= "<div class='ibox-content'>"; //START IBOX CONTENT
		$table .= "<div id='_content_riwayat_" . $id . "' class='animated fadeInUp'>";
		if ($accIns == 'Y') {
			$table .= "<div class='pull-right'><button type='button' class='btn btn-primary btn-sm btn-block m-t' onClick='getForm(\"dp3\",\"tambah\");'><i class='fa fa-plus'></i> Tambah Data</button></div>";
		}
		$table .= "<table class='table table-striped table-bordered table-hover dataTables-example' width='99%'>";
		$table .= "<thead>";
		$table .= " <tr>
                        <th>No</th><th>Tahun</th><th>Kesetiaan</th><th>Prestasi</th><th>Tanggung Jawab</th><th>Ketaatan</th><th>Kejujuran</th><th>Kerjasama</th><th>Prakarsa</th><th>Kepemimpinan</th><th>Jumlah</th><th>Rata-rata</th><th>Aksi</th>
                    </tr>";
		$table .= "</thead>";
		$table .= "<tbody>";
		foreach ($query->result() as $row) {
			$table .= "<tr>";
			$table .= "<td width='5px'>" . $i . "</td>";
			$table .= "<td align='right'>" . $row->TAHUN . "</td>";
			$table .= "<td align='right'>" . $row->SETIA . "</td>";
			$table .= "<td align='right'>" . $row->PRESTASI . "</td>";
			$table .= "<td align='right'>" . $row->TGGJAWAB . "</td>";
			$table .= "<td align='right'>" . $row->TAAT . "</td>";
			$table .= "<td align='right'>" . $row->JUJUR . "</td>";
			$table .= "<td align='right'>" . $row->KERJASAMA . "</td>";
			$table .= "<td align='right'>" . $row->PRAKARSA . "</td>";
			$table .= "<td align='right'>" . $row->PIMPIN . "</td>";
			$table .= "<td align='right'>" . $row->JUMLAH . "</td>";
			$table .= "<td align='right'>" . $row->RATA . "</td>";
			$table .= "<td>";
			if ($accUpd == 'Y') {
				$table .= "<button type='button' class='btn btn-outline btn-xs btn-success' title='Edit' onClick='getForm(\"dp3\",\"update\",\"" . $row->NRK . "\",\"" . $row->TAHUN . "\");'><i class='fa fa-pencil-square'></i></button> &nbsp;";
			}
			// if($accDelFlag == 'Y'){
			//     $table.="<button type='button' class='btn btn-outline btn-xs btn-danger' title='Hapus' onClick='confirmHapusDataFlag(\"dp3\",\"".$row->NRK."\",\"".$row->TAHUN."\");'><i class='fa fa-trash'></i></button>";
			// }
			if ($accDel == 'Y') {
				$table .= "<button type='button' class='btn btn-outline btn-xs btn-danger' title='Hapus ' onClick='confirmHapusData(\"dp3\",\"" . $row->NRK . "\",\"" . $row->TAHUN . "\");'><i class='fa fa-trash'></i></button>";
			}
			$table .= "            </td>";
			$table .= "</tr>";

			$i++;
		}
		$table .= "</tbody>";
		$table .= "</table>";
		$table .= "</div>";
		$table .= "</div>"; //END IBOX CONTENT
		$table .= "</div>"; //END IBOX
		$table .= "<script src=\"" . base_url() . "assets/inspinia/js/inspinia.js\"></script>"; //END IBOX

		return $table;
	}

	public function getRiwayatSKP($nrk, $ug, $id) {

		$access['mnac'] = $this->getMenuAccessBy($ug, 25368);
		$accIns = $access['mnac']->act_insert;
		$accUpd = $access['mnac']->act_update;
		$accDel = $access['mnac']->act_delete;
		// $accDelFlag=$access['mnac']->act_delete_flag;
		$sql = "SELECT NRK,TAHUN,PELAYANAN,INTEGRITAS, KOMITMEN,DISIPLIN, KERJASAMA, KEPEMIMPINAN, JUMLAH,RATA2, NILAI_SKP,NILAI_PERILAKU,NILAI_PRESTASI,STATUS_VALIDASI, USERID_INPUT,
                TO_CHAR(TGUPD_INPUT,'DD-MM-YYYY HH24:MI:SS')TGUPD_INPUT,INPUT_SKP
                FROM pers_skp
                WHERE NRK='$nrk'

                ORDER BY TAHUN DESC";
		// AND a.DELETED IS NULL

		$query = $this->ci->db->query($sql);

		$i = 1;

		$table = "<div class='ibox float-e-margins animated fadeInDown'>"; //START IBOX
		$table .= "<div class='ibox-title navy-bg'>
                        <h5>Riwayat SKP</h5>
                        <div class=\"ibox-tools\">
                            <a class=\"collapse-link\">
                                <i class=\"fa fa-chevron-up\"></i>
                            </a>
                            <a class=\"close-link\">
                                <i class=\"fa fa-times\"></i>
                            </a>
                        </div>
        </div>"; //IBOX TITLE
		$table .= "<div class='ibox-content'>"; //START IBOX CONTENT
		$table .= "<div id='_content_riwayat_" . $id . "' class='animated fadeInUp'>";
		if ($accIns == 'Y') {
			$table .= "<div class='pull-right'><button type='button' class='btn btn-primary btn-sm btn-block m-t' onClick='getForm(\"skp\",\"tambah\");'><i class='fa fa-plus'></i> Tambah Data</button></div>";
		}
		$table .= "<table class='table table-striped table-bordered table-hover dataTables-example' width='99%'>";
		$table .= "<thead>";
		$table .= " <tr>
                        <th>No</th><th>Tahun</th><th>Nilai SKP</th><th>Nilai Perilaku</th><th>NILAI PRESTASI</th><th>Status Validasi</th><th>Aksi</th>
                    </tr>";
		$table .= "</thead>";
		$table .= "<tbody>";
		foreach ($query->result() as $row) {
			$hsl;
			if ($row->STATUS_VALIDASI == '1') {
				$hsl = 'AKTIF';
			} else {
				$hsl = 'BELUM VALIDASI';
			}
			$table .= "<tr>";
			$table .= "<td width='5px'>" . $i . "</td>";
			$table .= "<td align='right'>" . $row->TAHUN . "</td>";
			$table .= "<td align='right'>" . $row->INPUT_SKP . "</td>";
			$table .= "<td align='right'>" . $row->RATA2 . "</td>";
			$table .= "<td align='right'>" . $row->NILAI_PRESTASI . "</td>";
			$table .= "<td align='right'>" . $hsl . "</td>";

			$table .= "<td>";

			$table .= "<button type='button' class='btn btn-outline btn-xs btn-primary' title='Detail' onClick='getFormView(\"skp\",\"view\",\"" . $row->NRK . "\",\"" . $row->TAHUN . "\");'><i class='fa fa-bars'></i></button> &nbsp;";
			if ($accUpd == 'Y') {

				$table .= "<button type='button' class='btn btn-outline btn-xs btn-success' title='Edit' onClick='getForm(\"skp\",\"update\",\"" . $row->NRK . "\",\"" . $row->TAHUN . "\");'><i class='fa fa-pencil-square'></i></button> &nbsp;";

			}
			// if($accDelFlag == 'Y'){
			//     $table.="<button type='button' class='btn btn-outline btn-xs btn-danger' title='Hapus' onClick='confirmHapusDataFlag(\"dp3\",\"".$row->NRK."\",\"".$row->TAHUN."\");'><i class='fa fa-trash'></i></button>";
			// }
			if ($accDel == 'Y') {
				$table .= "<button type='button' class='btn btn-outline btn-xs btn-danger' title='Hapus ' onClick='confirmHapusData(\"skp\",\"" . $row->NRK . "\",\"" . $row->TAHUN . "\");'><i class='fa fa-trash'></i></button>";
			}
			$table .= "            </td>";
			$table .= "</tr>";

			$i++;
		}
		$table .= "</tbody>";
		$table .= "</table>";
		$table .= "</div>";
		$table .= "</div>"; //END IBOX CONTENT
		$table .= "</div>"; //END IBOX
		$table .= "<script src=\"" . base_url() . "assets/inspinia/js/inspinia.js\"></script>"; //END IBOX

		return $table;
	}

	public function getRiwayatAbsensi($nrk, $ug, $id) {
		$access['mnac'] = $this->getMenuAccessBy($ug, 310);
		$accIns = $access['mnac']->act_insert;
		$accUpd = $access['mnac']->act_update;
		$accDel = $access['mnac']->act_delete;
		// $accDelFlag=$access['mnac']->act_delete_flag;

		$sql = "SELECT a.NRK, a.THBL, a.KLOGAD, a.ALFA, a.IZIN, a.SAKIT, a.CUTI, a.JAMTERLAMBAT, a.JAMPULANGCEPAT, a.KINERJA, a.CUTIAPENTING, a.CUTIBESAR, a.CUTISAKIT, a.CUTIBERSALIN
                FROM PERS_TUNDA_ABSENSI a
                WHERE a.NRK = '" . $nrk . "'
                ORDER BY a.THBL DESC";
		// AND a.DELETED IS NULL

		$query = $this->ci->db->query($sql);

		$i = 1;

		$table = "<div class='ibox float-e-margins animated fadeInDown'>"; //START IBOX
		$table .= "<div class='ibox-title navy-bg'>
                        <h5>Riwayat Absensi</h5>
                        <div class=\"ibox-tools\">
                            <a class=\"collapse-link\">
                                <i class=\"fa fa-chevron-up\"></i>
                            </a>
                            <a class=\"close-link\">
                                <i class=\"fa fa-times\"></i>
                            </a>
                        </div>
        </div>"; //IBOX TITLE
		$table .= "<div class='ibox-content'>"; //START IBOX CONTENT
		$table .= "<div id='_content_riwayat_" . $id . "' class='animated fadeInUp'>";
		if ($accIns == 'Y') {
			$table .= "<div class='pull-right'><button type='button' class='btn btn-primary btn-sm btn-block m-t' onClick='getForm(\"absensi\",\"tambah\");'><i class='fa fa-plus'></i> Tambah Data</button></div>";
		}
		$table .= "<table class='table table-striped table-bordered table-hover dataTables-example' width='99%'>";
		$table .= "<thead>";
		$table .= " <tr>
                        <th>No</th><th>Bulan Tahun</th><th>Kehadiran</th><th>Kinerja</th><th>Cuti</th><th>Aksi</th>
                    </tr>";
		$table .= "</thead>";
		$table .= "<tbody>";
		foreach ($query->result() as $row) {
			$table .= "<tr>";
			$table .= "<td width='5px'>" . $i . "</td>";
			$tahun = substr($row->THBL, 0, 4);
			$bulan = substr($row->THBL, 4, 2);
			if ($bulan == '01') {
				$bln = "Jan";
			} elseif ($bulan == '02') {
				$bln = "Feb";
			} elseif ($bulan == '03') {
				$bln = "Mar";
			} elseif ($bulan == '04') {
				$bln = "Apr";
			} elseif ($bulan == '05') {
				$bln = "May";
			} elseif ($bulan == '06') {
				$bln = "Jun";
			} elseif ($bulan == '07') {
				$bln = "Jul";
			} elseif ($bulan == '08') {
				$bln = "Aug";
			} elseif ($bulan == '09') {
				$bln = "Sep";
			} elseif ($bulan == '10') {
				$bln = "Oct";
			} elseif ($bulan == '11') {
				$bln = "Nov";
			} elseif ($bulan == '12') {
				$bln = "Dec";
			} else {
				$bln = "-";
			}

			$table .= "<td>" . $bln . " " . $tahun . "</td>";
			$table .= "<td><table width='65%'><tr><td colspan='2'><span class='text-success'>Izin (" . $row->IZIN . ")</span><span class='text-navy'>  -  Sakit (" . $row->SAKIT . ")</span><span class='text-danger'>  -  Alfa (" . $row->ALFA . ")</span></td></tr>
                                      <tr><td><span class='text-danger'>Jam Terlambat (" . $row->JAMTERLAMBAT . ")</span></td><td><span class='text-success'>Jam Pulang Cepat (" . $row->JAMPULANGCEPAT . ")</span></td></tr>
                                </table>
                            </td>";
			$table .= "<td align='right'>" . $row->KINERJA . "</td>";
			$table .= "<td><table width='100%'><tr><td><span class='text-navy'> Cuti (" . $row->CUTI . ")</span><br><span class='text-success'>Cuti Penting (" . $row->CUTIAPENTING . ")</span><br><span class='text-navy'>Cuti Besar (" . $row->CUTIBESAR . ")</span><br><span class='text-success'>Cuti Sakit (" . $row->CUTISAKIT . ")</span><br><span class='text-navy'>Cuti Bersalin (" . $row->CUTIBERSALIN . ")</span></td></tr></table></td>";
			$table .= "<td >";
			if ($accUpd == 'Y') {
				$table .= " <button type='button' class='btn btn-outline btn-xs btn-success' title='Edit' onClick='getForm(\"absensi\",\"update\",\"" . $row->NRK . "\",\"" . $row->THBL . "\");'><i class='fa fa-pencil-square'></i></button>";
			}
			// if($accDelFlag == 'Y')
			// {
			// $table.="<button type='button' class='btn btn-outline btn-xs btn-danger' title='Hapus' onClick='confirmHapusDataFlag(\"absensi\",\"".$row->NRK."\",\"".$row->THBL."\");'><i class='fa fa-trash'></i></button>";
			// }
			if ($accDel == 'Y') {
				$table .= "<button type='button' class='btn btn-outline btn-xs btn-danger' title='Hapus ' onClick='confirmHapusData(\"absensi\",\"" . $row->NRK . "\",\"" . $row->THBL . "\");'><i class='fa fa-trash'></i></button>";
			}
			$table .= "          </td>";
			$table .= "</tr>";

			$i++;
		}
		$table .= "</tbody>";
		$table .= "</table>";
		$table .= "</div>";
		$table .= "</div>"; //END IBOX CONTENT
		$table .= "</div>"; //END IBOX
		$table .= "<script src=\"" . base_url() . "assets/inspinia/js/inspinia.js\"></script>"; //END IBOX

		return $table;
	}

	public function getRiwayatCuti($nrk, $ug, $id) {
		$access['mnac'] = $this->getMenuAccessBy($ug, 311);
		$accIns = $access['mnac']->act_insert;
		$accUpd = $access['mnac']->act_update;
		$accDel = $access['mnac']->act_delete;
		// $accDelFlag=$access['mnac']->act_delete_flag;

		$sql = "SELECT
                  a.NRK, to_char(a.TMT, 'YYYY-MM-DD') TMT, a.NOSK, to_char(a.TGSK, 'YYYY-MM-DD') TGSK, b.KETERANGAN,
                  to_char(a.TGAKHIR, 'DD-MM-YYYY') TGAKHIR, to_char(a.TG_UPD, 'DD-MM-YYYY HH24:MI:SS') TG_UPD,a.USER_ID,c.KETERANGAN AS KET_PEJTT
                FROM PERS_CUTI_HIST a
                LEFT JOIN PERS_JENCUTI_RPT b ON a.JENCUTI = b.JENCUTI
                LEFT JOIN PERS_PEJTT_RPT c ON a.PEJTT = c.PEJTT
                WHERE a.NRK = '" . $nrk . "'

                ORDER BY a.TMT DESC";
		// AND a.DELETED IS NULL

		$query = $this->ci->db->query($sql);

		$i = 1;

		$table = "<div class='ibox float-e-margins animated fadeInDown'>"; //START IBOX
		$table .= "<div class='ibox-title navy-bg'>
                        <h5>Riwayat Cuti</h5>
                        <div class=\"ibox-tools\">
                            <a class=\"collapse-link\">
                                <i class=\"fa fa-chevron-up\"></i>
                            </a>
                            <a class=\"close-link\">
                                <i class=\"fa fa-times\"></i>
                            </a>
                        </div>
        </div>"; //IBOX TITLE
		$table .= "<div class='ibox-content'>"; //START IBOX CONTENT
		$table .= "<div id='_content_riwayat_" . $id . "' class='animated fadeInUp'>";
		if ($accIns == 'Y') {
			$table .= "<div class='pull-right'><button type='button' class='btn btn-primary btn-sm btn-block m-t' onClick='getForm(\"cuti\",\"tambah\");'><i class='fa fa-plus'></i> Tambah Data</button></div>";
		}
		$table .= "<table class='table table-striped table-bordered table-hover dataTables-example' width='99%'>";
		$table .= "<thead>";
		$table .= " <tr>
                        <th>No</th>
                        <th>TMT</th>
                        <th>Jenis Cuti</th>
                        <th>Tanggal Berakhir</th>
                        <th>No.SK <br/> <strong><small class='text-navy'>(Tgl. SK)</small></strong></th>
                        <th>Pejabat Penanda Tangan</th>
                        <th>User ID <br/><strong><small class='text-navy'>(Tgl. Update)</small></strong></th>
                        <th>Aksi</th>
                    </tr>";
		$table .= "</thead>";
		$table .= "<tbody>";
		foreach ($query->result() as $row) {
			$table .= "<tr>";
			$table .= "<td width='5px'>" . $i . "</td>";
			$tmt = date('d-m-Y', strtotime($row->TMT));
			$table .= "<td width='85px'>" . $tmt . "</td>";

			$table .= "<td>" . $row->KETERANGAN . "</td>";
//                    $tgakhir = date('d M Y', strtotime($row->TGAKHIR));
			$table .= "<td width='85px'>" . $row->TGAKHIR . "</td>";

			$tgsk = date('d-m-Y', strtotime($row->TGSK));

			$table .= "<td>" . $row->NOSK . "<br><strong><small class='text-navy'>(" . $tgsk . ")</small></strong></td>";
			$table .= "<td>" . $row->KET_PEJTT . "</td>";
			$table .= "<td>" . $row->USER_ID . "<br><strong><small class='text-navy'>(" . $row->TG_UPD . ")</small></strong></td>";
			$table .= "<td>";
			if ($accUpd == 'Y') {
				$table .= "<button type='button' class='btn btn-outline btn-xs btn-success' title='Edit' onClick='getForm(\"cuti\",\"update\",\"" . $row->NRK . "\",\"" . $row->TMT . "\");'><i class='fa fa-pencil-square'></i></button> &nbsp;";
			}
			// if($accDelFlag == 'Y')
			// {
			//     $table.="<button type='button' class='btn btn-outline btn-xs btn-danger' title='Hapus' onClick='confirmHapusDataFlag(\"cuti\",\"".$row->NRK."\",\"".$row->TMT."\");'><i class='fa fa-trash'></i></button> &nbsp;";
			// }
			if ($accDel == 'Y') {
				$table .= "<button type='button' class='btn btn-outline btn-xs btn-danger' title='Hapus ' onClick='confirmHapusData(\"cuti\",\"" . $row->NRK . "\",\"" . $row->TMT . "\");'><i class='fa fa-trash'></i></button>";
			}
			$table .= "          </td>";
			$table .= "</tr>";

			$i++;
		}
		$table .= "</tbody>";
		$table .= "</table>";
		$table .= "</div>";
		$table .= "</div>"; //END IBOX CONTENT
		$table .= "</div>"; //END IBOX
		$table .= "<script src=\"" . base_url() . "assets/inspinia/js/inspinia.js\"></script>"; //END IBOX

		return $table;
	}

	public function getRiwayatCutiPeg($nrk, $ug, $id) {
		$access['mnac'] = $this->getMenuAccessBy($ug, 311);
		$accIns = $access['mnac']->act_insert;
		$accUpd = $access['mnac']->act_update;
		$accDel = $access['mnac']->act_delete;
		// $accDelFlag=$access['mnac']->act_delete_flag;

		$sql = "SELECT
                  a.NRK, to_char(a.TMT, 'YYYY-MM-DD') TMT, a.NOSK, to_char(a.TGSK, 'YYYY-MM-DD') TGSK, b.KETERANGAN,
                  to_char(a.TGAKHIR, 'DD-MM-YYYY') TGAKHIR, to_char(a.TG_UPD, 'DD-MM-YYYY HH24:MI:SS') TG_UPD,a.USER_ID,c.KETERANGAN AS KET_PEJTT
                FROM PERS_CUTI_HIST a
                LEFT JOIN PERS_JENCUTI_RPT b ON a.JENCUTI = b.JENCUTI
                LEFT JOIN PERS_PEJTT_RPT c ON a.PEJTT = c.PEJTT
                WHERE a.NRK = '" . $nrk . "'

                ORDER BY a.TMT DESC";
		// AND a.DELETED IS NULL

		$query = $this->ci->db->query($sql);

		$i = 1;

		$table = "<div class='ibox float-e-margins animated fadeInDown'>"; //START IBOX
		$table .= "<div class='ibox-title navy-bg'>
                        <h5>Riwayat Cuti</h5>
                        <div class=\"ibox-tools\">
                            <a class=\"collapse-link\">
                                <i class=\"fa fa-chevron-up\"></i>
                            </a>
                            <a class=\"close-link\">
                                <i class=\"fa fa-times\"></i>
                            </a>
                        </div>
        </div>"; //IBOX TITLE
		$table .= "<div class='ibox-content'>"; //START IBOX CONTENT
		$table .= "<div id='_content_riwayat_" . $id . "' class='animated fadeInUp'>";
		if ($accIns == 'Y') {
			$table .= "<div class='pull-right'><button type='button' class='btn btn-primary btn-sm btn-block m-t' onClick='getForm(\"cuti\",\"tambah\");'><i class='fa fa-plus'></i> Tambah Data</button></div>";
		}
		$table .= "<table class='table table-striped table-bordered table-hover dataTables-example' width='99%'>";
		$table .= "<thead>";
		$table .= " <tr>
                        <th>No</th><th>TMT</th><th>Jenis Cuti</th><th>Tanggal Berakhir</th><th>No.SK <br/> <strong><small class='text-navy'>(Tgl. SK)</small></strong></th>
                        <th>Pejabat Penanda Tangan</th>

                    </tr>";
		$table .= "</thead>";
		$table .= "<tbody>";
		foreach ($query->result() as $row) {
			$table .= "<tr>";
			$table .= "<td >" . $i . "</td>";
			$tmt = date('d-m-Y', strtotime($row->TMT));
			$table .= "<td >" . $tmt . "</td>";

			$table .= "<td>" . $row->KETERANGAN . "</td>";
//                    $tgakhir = date('d M Y', strtotime($row->TGAKHIR));
			$table .= "<td>" . $row->TGAKHIR . "</td>";
			$tgsk = date('d-m-Y', strtotime($row->TGSK));

			$table .= "<td>" . $row->NOSK . "<br><strong><small class='text-navy'>(" . $tgsk . ")</small></strong></td>";
			$table .= "<td>" . $row->KET_PEJTT . "</td>";

			$table .= "</tr>";

			$i++;
		}
		$table .= "</tbody>";
		$table .= "</table>";
		$table .= "</div>";
		$table .= "</div>"; //END IBOX CONTENT
		$table .= "</div>"; //END IBOX
		$table .= "<script src=\"" . base_url() . "assets/inspinia/js/inspinia.js\"></script>"; //END IBOX

		return $table;
	}

	public function getRiwayatPembatasan($nrk, $ug, $id) {
		$access['mnac'] = $this->getMenuAccessBy($ug, 312);
		$accIns = $access['mnac']->act_insert;
		$accUpd = $access['mnac']->act_update;
		$accDel = $access['mnac']->act_delete;
		// $accDelFlag=$access['mnac']->act_delete_flag;

		$sql = "SELECT a.NRK, to_char(a.TMT, 'YYYY-MM-DD') TMT, a.NOSIZIN, to_char(a.TGSIZIN, 'YYYY-MM-DD') TGSIZIN, b.KETERANGAN, to_char(a.TGAKHIR, 'YYYY-MM-DD') TGAKHIR
                FROM PERS_PEMBATASAN a
                LEFT JOIN PERS_JENUSAHA_RPT b ON a.JENUSAHA = b.JENUSAHA
                WHERE a.NRK = '" . $nrk . "'

                ORDER BY a.TMT DESC
                ";
		// AND a.DELETED IS NULL

		$query = $this->ci->db->query($sql);

		$i = 1;

		$table = "<div class='ibox float-e-margins animated fadeInDown'>"; //START IBOX
		$table .= "<div class='ibox-title navy-bg'>
                        <h5>Riwayat Pembatasan</h5>
                        <div class=\"ibox-tools\">
                            <a class=\"collapse-link\">
                                <i class=\"fa fa-chevron-up\"></i>
                            </a>
                            <a class=\"close-link\">
                                <i class=\"fa fa-times\"></i>
                            </a>
                        </div>
        </div>"; //IBOX TITLE
		$table .= "<div class='ibox-content'>"; //START IBOX CONTENT
		$table .= "<div id='_content_riwayat_" . $id . "' class='animated fadeInUp'>";
		if ($accIns == 'Y') {
			$table .= "<div class='pull-right'><button type='button' class='btn btn-primary btn-sm btn-block m-t' onClick='getForm(\"pembatasan\",\"tambah\");'><i class='fa fa-plus'></i> Tambah Data</button></div>";
		}
		$table .= "<table class='table table-striped table-bordered table-hover dataTables-example' width='99%'>";
		$table .= "<thead>";
		$table .= " <tr>
                        <th>No</th><th>TMT</th><th>No. Izin</th><th>Tgl. Izin</th><th>Jenis Usaha</th><th>Tanggal Berakhir</th><th>Aksi</th>
                    </tr>";
		$table .= "</thead>";
		$table .= "<tbody>";
		foreach ($query->result() as $row) {
			$table .= "<tr>";
			$table .= "<td width='5px'>" . $i . "</td>";
			$tmt = date('d M Y', strtotime($row->TMT));
			$table .= "<td width='85px'>" . $tmt . "</td>";
			$table .= "<td>" . $row->NOSIZIN . "</td>";
			$tgsk = date('d M Y', strtotime($row->TGSIZIN));
			$table .= "<td width='85px'>" . $tgsk . "</td>";
			$table .= "<td>" . $row->KETERANGAN . "</td>";
			$tgakhir = date('d M Y', strtotime($row->TGAKHIR));
			$table .= "<td width='85px'>" . $tgakhir . "</td>";
			$table .= "<td>";
			if ($accUpd == 'Y') {
				$table .= "<button type='button' class='btn btn-outline btn-xs btn-success' title='Edit' onClick='getForm(\"pembatasan\",\"update\",\"" . $row->NRK . "\",\"" . $row->TMT . "\");'><i class='fa fa-pencil-square'></i></button> &nbsp;";
			}
			// if($accDelFlag == 'Y'){
			//     $table.=    "<button type='button' class='btn btn-outline btn-xs btn-danger' title='Hapus' onClick='confirmHapusDataFlag(\"pembatasan\",\"".$row->NRK."\",\"".$row->TMT."\");'><i class='fa fa-trash'></i></button>";
			// }
			if ($accDel == 'Y') {
				$table .= "<button type='button' class='btn btn-outline btn-xs btn-danger' title='Hapus ' onClick='confirmHapusData(\"pembatasan\",\"" . $row->NRK . "\",\"" . $row->TMT . "\");'><i class='fa fa-trash'></i></button>";
			}
			$table .= "</td>";
			$table .= "</tr>";

			$i++;
		}
		$table .= "</tbody>";
		$table .= "</table>";
		$table .= "</div>";
		$table .= "</div>"; //END IBOX CONTENT
		$table .= "</div>"; //END IBOX
		$table .= "<script src=\"" . base_url() . "assets/inspinia/js/inspinia.js\"></script>"; //END IBOX

		return $table;
	}

	public function getRiwayatSeminar($nrk, $ug, $id) {
		$access['mnac'] = $this->getMenuAccessBy($ug, 313);
		$accIns = $access['mnac']->act_insert;
		$accUpd = $access['mnac']->act_update;
		$accDel = $access['mnac']->act_delete;
		// $accDelFlag=$access['mnac']->act_delete_flag;

		$sql = "SELECT a.NRK, to_char(a.TGMULAI, 'YYYY-MM-DD') TGMULAI, to_char(a.TGSELESAI, 'YYYY-MM-DD') TGSELESAI, a.NASEMI, b.KETERANGAN JENISSEMINAR, c.NATEMA, a.BADAN, a.TEMPAT, d.KETERANGAN PERAN
                FROM PERS_SEMINAR_HIST a
                LEFT JOIN PERS_KDSEMI_RPT b ON a.KDSEMI = b.KDSEMI
                LEFT JOIN PERS_TEMA_TBL c ON a.KDTEMA = c.KDTEMA
                LEFT JOIN PERS_KDPERANS_RPT d ON a.KDPERAN = d.KDPERAN
                WHERE a.NRK = '" . $nrk . "'

                ORDER BY TGMULAI DESC
                ";
		// AND a.DELETED IS NULL

		$query = $this->ci->db->query($sql);

		$i = 1;

		$table = "<div class='ibox float-e-margins animated fadeInDown'>"; //START IBOX
		$table .= "<div class='ibox-title navy-bg'>
                        <h5>Riwayat Seminar</h5>
                        <div class=\"ibox-tools\">
                            <a class=\"collapse-link\">
                                <i class=\"fa fa-chevron-up\"></i>
                            </a>
                            <a class=\"close-link\">
                                <i class=\"fa fa-times\"></i>
                            </a>
                        </div>
        </div>"; //IBOX TITLE
		$table .= "<div class='ibox-content'>"; //START IBOX CONTENT
		$table .= "<div id='_content_riwayat_" . $id . "' class='animated fadeInUp'>";
		if ($accIns == 'Y') {
			$table .= "<div class='pull-right'><button type='button' class='btn btn-primary btn-sm btn-block m-t' onClick='getForm(\"seminar\",\"tambah\");'><i class='fa fa-plus'></i> Tambah Data</button></div>";
		}
		$table .= "<table class='table table-striped table-bordered table-hover dataTables-example' width='99%'>";
		$table .= "<thead>";
		$table .= " <tr>
                        <th>No</th><th>Nama Seminar</th><th>Tema</th><th>Tgl. Laksana</th><th>Peran</th><th>Pelaksana</th><th>Tempat</th><th>Aksi</th>
                    </tr>";
		$table .= "</thead>";
		$table .= "<tbody>";
		foreach ($query->result() as $row) {
			$table .= "<tr>";
			$table .= "<td width='5px'>" . $i . "</td>";
			$table .= "<td>" . $row->NASEMI . "<br><span class='text-success'><strong>(" . $row->JENISSEMINAR . ")</strong></span></td>";
			$table .= "<td>" . $row->NATEMA . "</td>";
			$tgmulai = date('d M Y', strtotime($row->TGMULAI));
			$tgselesai = date('d M Y', strtotime($row->TGSELESAI));
			$table .= "<td width='185px'>" . $tgmulai . " s/d " . $tgselesai . "</td>";
			$table .= "<td>" . $row->PERAN . "</td>";
			$table .= "<td>" . $row->BADAN . "</td>";
			$table .= "<td>" . $row->TEMPAT . "</td>";
			$table .= "<td>";
			if ($accUpd == 'Y') {
				$table .= "<button type='button' class='btn btn-outline btn-xs btn-success' title='Edit' onClick='getForm(\"seminar\",\"update\",\"" . $row->NRK . "\",\"" . $row->TGMULAI . "\");'><i class='fa fa-pencil-square'></i></button> &nbsp;";
			}
			// if($accDelFlag == 'Y'){
			//     $table.="<button type='button' class='btn btn-outline btn-xs btn-danger' title='Hapus' onClick='confirmHapusDataFlag(\"seminar\",\"".$row->NRK."\",\"".$row->TGMULAI."\");'><i class='fa fa-trash'></i></button>";
			// }
			if ($accDel == 'Y') {
				$table .= "<button type='button' class='btn btn-outline btn-xs btn-danger' title='Hapus ' onClick='confirmHapusData(\"seminar\",\"" . $row->NRK . "\",\"" . $row->TGMULAI . "\");'><i class='fa fa-trash'></i></button>";
			}
			$table .= "</td>";
			$table .= "</tr>";

			$i++;
		}
		$table .= "</tbody>";
		$table .= "</table>";
		$table .= "</div>";
		$table .= "</div>"; //END IBOX CONTENT
		$table .= "</div>"; //END IBOX
		$table .= "<script src=\"" . base_url() . "assets/inspinia/js/inspinia.js\"></script>"; //END IBOX

		return $table;
	}

	public function getRiwayatTulisan($nrk, $ug, $id) {
		$access['mnac'] = $this->getMenuAccessBy($ug, 314);
		$accIns = $access['mnac']->act_insert;
		$accUpd = $access['mnac']->act_update;
		$accDel = $access['mnac']->act_delete;
		// $accDelFlag=$access['mnac']->act_delete_flag;

		$sql = "SELECT a.NRK, to_char(a.TGPUBLIK, 'YYYY-MM-DD') TGPUBLIK, a.JUDUL, b.NATEMA, c.KETERANGAN SIFAT, a.MEDPUBLIK, d.KETERANGAN LINGKUP, e.KETERANGAN JUMKATA, f.KETERANGAN PERAN
                FROM PERS_TULISAN_HIST a
                LEFT JOIN PERS_TEMA_TBL b ON a.KDTEMA = b.KDTEMA
                LEFT JOIN PERS_KDSIFAT_RPT c ON a.KDSIFAT = c.KDSIFAT
                LEFT JOIN PERS_KDLINGKUP_RPT d ON a.KDLINGKUP = d.KDLINGKUP
                LEFT JOIN PERS_KDJUMKATA_RPT e ON a.KDJUMKATA = e.KDJUMKATA
                LEFT JOIN PERS_KDPERANT_RPT f ON a.KDPERAN = f.KDPERAN
                WHERE a.NRK = '" . $nrk . "'

                ORDER BY TGPUBLIK DESC
                ";
		// AND a.DELETED IS NULL

		$query = $this->ci->db->query($sql);

		$i = 1;

		$table = "<div class='ibox float-e-margins animated fadeInDown'>"; //START IBOX
		$table .= "<div class='ibox-title navy-bg'>
                        <h5>Riwayat Tulisan</h5>
                        <div class=\"ibox-tools\">
                            <a class=\"collapse-link\">
                                <i class=\"fa fa-chevron-up\"></i>
                            </a>
                            <a class=\"close-link\">
                                <i class=\"fa fa-times\"></i>
                            </a>
                        </div>
        </div>"; //IBOX TITLE
		$table .= "<div class='ibox-content'>"; //START IBOX CONTENT
		$table .= "<div id='_content_riwayat_" . $id . "' class='animated fadeInUp'>";
		if ($accIns == 'Y') {
			$table .= "<div class='pull-right'><button type='button' class='btn btn-primary btn-sm btn-block m-t' onClick='getForm(\"tulisan\",\"tambah\");'><i class='fa fa-plus'></i> Tambah Data</button></div>";
		}
		$table .= "<table class='table table-striped table-bordered table-hover dataTables-example' width='99%'>";
		$table .= "<thead>";
		$table .= " <tr>
                        <th>No</th><th>Judul</th><th>Tema</th><th>Tgl. Publish</th><th>Media Publish</th><th>Peran</th><th>Sifat</th><th>Lingkup</th><th>Jumlah Kata</th><th>Aksi</th>
                    </tr>";
		$table .= "</thead>";
		$table .= "<tbody>";
		foreach ($query->result() as $row) {
			$table .= "<tr>";
			$table .= "<td width='5px'>" . $i . "</td>";
			$table .= "<td>" . $row->JUDUL . "</td>";
			$table .= "<td>" . $row->NATEMA . "</td>";
			$tgpublik = date('d M Y', strtotime($row->TGPUBLIK));
			$table .= "<td width='85px'>" . $tgpublik . "</td>";
			$table .= "<td>" . $row->MEDPUBLIK . "</td>";
			$table .= "<td>" . $row->PERAN . "</td>";
			$table .= "<td>" . $row->SIFAT . "</td>";
			$table .= "<td>" . $row->LINGKUP . "</td>";
			$table .= "<td>" . $row->JUMKATA . "</td>";
			$table .= "<td>";
			if ($accUpd == 'Y') {
				$table .= "<button type='button' class='btn btn-outline btn-xs btn-success' title='Edit' onClick='getForm(\"tulisan\",\"update\",\"" . $row->NRK . "\",\"" . $row->TGPUBLIK . "\");'><i class='fa fa-pencil-square'></i></button> &nbsp;";
			}
			// if($accDelFlag == 'Y'){
			// $table.="<button type='button' class='btn btn-outline btn-xs btn-danger' title='Hapus' onClick='confirmHapusDataFlag(\"tulisan\",\"".$row->NRK."\",\"".$row->TGPUBLIK."\");'><i class='fa fa-trash'></i></button>";
			// }
			if ($accDel == 'Y') {
				$table .= "<button type='button' class='btn btn-outline btn-xs btn-danger' title='Hapus ' onClick='confirmHapusData(\"tulisan\",\"" . $row->NRK . "\",\"" . $row->TGPUBLIK . "\");'><i class='fa fa-trash'></i></button>";
			}
			$table .= "</td>";
			$table .= "</tr>";

			$i++;
		}
		$table .= "</tbody>";
		$table .= "</table>";
		$table .= "</div>";
		$table .= "</div>"; //END IBOX CONTENT
		$table .= "</div>"; //END IBOX
		$table .= "<script src=\"" . base_url() . "assets/inspinia/js/inspinia.js\"></script>"; //END IBOX

		return $table;
	}

	public function getRiwayatAlamatPeg($nrk, $ug, $id) {
		$access['mnac'] = $this->getMenuAccessBy($ug, 315);
		$accIns = $access['mnac']->act_insert;
		$accUpd = $access['mnac']->act_update;
		$accDel = $access['mnac']->act_delete;
		// $accDelFlag=$access['mnac']->act_delete_flag;

		$peg1 = $this->getPegawai1($nrk);

		$kolokP1 = $peg1->KOLOK;
		$kdKolokP1 = substr($kolokP1, 0, 1);

		// $sql = "SELECT a.NRK, to_char(a.TGMULAI, 'YYYY-MM-DD') TGMULAI, a.ALAMAT_KTP, a.ALAMAT, a.RT, a.RW, f.KET_STATUS,b.NAWIL, c.NACAM, d.NAKEL, e.KETERANGAN PROP
		//         FROM PERS_ALAMAT_HIST a
		//         LEFT JOIN PERS_KOWIL_TBL b ON a.KOWIL = b.KOWIL
		//         LEFT JOIN PERS_KOCAM_TBL c ON a.KOCAM = c.KOCAM AND b.KOWIL = c.KOWIL
		//         LEFT JOIN PERS_KOKEL_TBL d ON a.KOKEL = d.KOKEL AND c.KOCAM = d.KOCAM AND b.KOWIL = d.KOWIL
		//         LEFT JOIN PERS_PROP_RPT e ON a.PROP = e.PROP
		//         LEFT JOIN PERS_STATUS_APPROVAL f on a.STAT_APP = f.KD_STATUS
		//         WHERE a.NRK = '".$nrk."' ORDER BY TGMULAI DESC
		//         ";

		$sql = "SELECT a.NRK, to_char(a.TGMULAI, 'YYYY-MM-DD') TGMULAI,
                a.ALAMAT, a.RT, a.RW,
                a.ALAMAT_KTP, a.RT_KTP, a.RW_KTP, j.KET_STATUS,
                b.NAMA AS NAWIL, c.NAMA AS NACAM, d.NAMA AS NAKEL, e.NAMA AS PROP,
                f.NAMA AS NAWIL_KTP, g.NAMA AS NACAM_KTP, h.NAMA AS NAKEL_KTP, i.NAMA AS PROP_KTP,to_char(a.TG_UPD, 'DD-MM-YYYY HH24:MI:SS') TG_UPD, a.USER_ID
                FROM PERS_ALAMAT_HIST a
                LEFT JOIN LOKASI b ON a.KOWIL = b.KODE
                LEFT JOIN LOKASI c ON a.KOCAM = c.KODE
                LEFT JOIN LOKASI d ON a.KOKEL = d.KODE
                LEFT JOIN LOKASI  e ON a.PROP = e.KODE
                LEFT JOIN LOKASI f ON a.KOWIL_KTP = f.KODE
                LEFT JOIN LOKASI g ON a.KOCAM_KTP = g.KODE
                LEFT JOIN LOKASI h ON a.KOKEL_KTP = h.KODE
                LEFT JOIN LOKASI  i ON a.PROP_KTP = i.KODE
                LEFT JOIN PERS_STATUS_APPROVAL j on a.STAT_APP = j.KD_STATUS
                WHERE a.NRK = '" . $nrk . "'

                ORDER BY TGMULAI DESC
                ";
		// AND a.DELETED IS NULL

		// echo $sql;exit;
		$query = $this->ci->db->query($sql);

		$i = 1;

		$table = "<div class='ibox float-e-margins animated fadeInDown'>"; //START IBOX
		$table .= "<div class='ibox-title navy-bg'>
                        <h5>Riwayat Alamat</h5>
                        <div class=\"ibox-tools\">
                            <a class=\"collapse-link\">
                                <i class=\"fa fa-chevron-up\"></i>
                            </a>
                            <a class=\"close-link\">
                                <i class=\"fa fa-times\"></i>
                            </a>
                        </div>
        </div>"; //IBOX TITLE
		$table .= "<div class='ibox-content'>"; //START IBOX CONTENT
		$table .= "<div id='_content_riwayat_" . $id . "' class='animated fadeInUp'>";
		if ($accIns == 'Y') {

			/*if($session_data['user_group'] == 10)
				            {
				                if($session_data['kowil'] == $kdKolokP1 || ( ($session_data['kowil'] == 11) && (substr($kolokP1, 0,2) == 11)))
				                {
				                    if(substr($kolokP1, 1,1) == 1  && $session_data['kowil'] == 1)
				                    {

				                    }
				                    else
				                    {
				                          $table .= "<div class='pull-right'><button type='button' class='btn btn-primary btn-sm btn-block m-t' onClick='getForm(\"alamat\");'><i class='fa fa-plus'></i> Tambah Data</button></div>";
				                    }

				                }
				            }
				            else
			*/
			$table .= "<div class='pull-right'><button type='button' class='btn btn-primary btn-sm btn-block m-t' onClick='getForm(\"alamat\");'><i class='fa fa-plus'></i> Tambah Data</button></div>";
			//}

		}

		$table .= "<table class='table table-hover table-bordered table-striped dataTables-example' width='99%'>";
		$table .= "<thead>";
		$table .= " <tr>
                        <th>No</th><th>Alamat Tempat Tinggal</th><th>Alamat KTP</th><th>Tgl. Mulai</th><th>User ID <br/><strong><small class='text-navy'>(Tgl. Update)</small></strong></th><th>Aksi</th>
                    </tr>";
		$table .= "</thead>";
		$table .= "<tbody>";
		foreach ($query->result() as $row) {
			$rt = "";
			if ($row->RT != '') {
				$rt = "RT. " . $row->RT;
			}
			$rw = "";
			if ($row->RW != '') {
				$rw = "RW. " . $row->RW;
			}
			$kel = "";
			if ($row->NAKEL != '') {
				$kel = "KEL. " . $row->NAKEL;
			}
			$kec = "";
			if ($row->NACAM != '') {
				$kec = "KEC. " . $row->NACAM;
			}
			$wil = "";
			if ($row->NAWIL != '') {
				$wil = $row->NAWIL;
			}
			$prop = "";
			if ($row->PROP != '') {
				$prop = $row->PROP;
			}

			$rt_ktp = "";
			if ($row->RT_KTP != '') {
				$rt_ktp = "RT. " . $row->RT_KTP;
			}
			$rw_ktp = "";
			if ($row->RW_KTP != '') {
				$rw_ktp = "RW. " . $row->RW_KTP;
			}
			$kel_ktp = "";
			if ($row->NAKEL_KTP != '') {
				$kel_ktp = "KEL. " . $row->NAKEL_KTP;
			}
			$kec_ktp = "";
			if ($row->NACAM_KTP != '') {
				$kec_ktp = "KEC. " . $row->NACAM_KTP;
			}
			$wil_ktp = "";
			if ($row->NAWIL_KTP != '') {
				$wil_ktp = $row->NAWIL_KTP . ", ";
			}
			$prop_ktp = "";
			if ($row->PROP_KTP != '') {
				$prop_ktp = $row->PROP_KTP;
			}

			$almt_domisili = $row->ALAMAT . "<br>" . $rt . " " . $rw . " " . $kel . " " . $kec . " " . $wil . " " . $prop;
			if ($row->ALAMAT_KTP == '') {
				$almt_ktp = $almt_domisili;
			} else {
				$almt_ktp = $row->ALAMAT_KTP . "<br>" . $rt_ktp . " " . $rw_ktp . " " . $kel_ktp . " " . $kec_ktp . " " . $wil_ktp . " " . $prop_ktp;
			}

			$table .= "<tr>";
			$table .= "<td>" . $i . "</td>";
			$table .= "<td>$almt_domisili</td>";

			$table .= "<td>$almt_ktp</td>";
			$tgmulai = date('d M Y', strtotime($row->TGMULAI));
			$table .= "<td>" . $tgmulai . "</td>";
			// $table .= "<td>".$row->KET_STATUS."</td>";
			$table .= "<td>" . $row->USER_ID . "<br><strong><small class='text-navy'>(" . $row->TG_UPD . ")</small></strong></td>";
			$table .= "<td >";
			if ($accUpd == 'Y') {
				$table .= "<button type='button' class='btn btn-outline btn-xs btn-success' title='Edit' onClick='getForm(\"alamat\",\"update\",\"" . $row->NRK . "\",\"" . $row->TGMULAI . "\");'><i class='fa fa-pencil-square'></i></button> &nbsp;";
			}
			// if($accDelFlag == 'Y')
			// {
			//     $table.="<button type='button' class='btn btn-outline btn-xs btn-danger' title='Hapus' onClick='confirmHapusDataFlag(\"alamat\",\"".$row->NRK."\",\"".$row->TGMULAI."\");'><i class='fa fa-trash'></i></button> &nbsp;";
			// }
			if ($accDel == 'Y') {
				$table .= "<button type='button' class='btn btn-outline btn-xs btn-danger' title='Hapus ' onClick='confirmHapusData(\"alamat\",\"" . $row->NRK . "\",\"" . $row->TGMULAI . "\");'><i class='fa fa-trash'></i></button>";
			}
			$table .= "</td>";
			$table .= "</tr>";

			$i++;
		}
		$table .= "</tbody>";
		$table .= "</table>";
		$table .= "</div>";
		$table .= "</div>"; //END IBOX CONTENT
		$table .= "</div>"; //END IBOX
		$table .= "<script src=\"" . base_url() . "assets/inspinia/js/inspinia.js\"></script>";

		return $table;
	}

	public function getRiwayatAlamatPeg2($nrk, $ug, $id) {

		$access['mnac'] = $this->getMenuAccessBy($ug, 315);
		$accIns = $access['mnac']->act_insert;
		$accUpd = $access['mnac']->act_update;
		$accDel = $access['mnac']->act_delete;

		// $accDelFlag=$access['mnac']->act_delete_flag;

		$peg1 = $this->getPegawai1($nrk);

		$kolokP1 = $peg1->KOLOK;
		$kdKolokP1 = substr($kolokP1, 0, 1);

		// $sql = "SELECT a.NRK, to_char(a.TGMULAI, 'YYYY-MM-DD') TGMULAI, a.ALAMAT_KTP, a.ALAMAT, a.RT, a.RW, f.KET_STATUS,b.NAWIL, c.NACAM, d.NAKEL, e.KETERANGAN PROP
		//         FROM PERS_ALAMAT_HIST a
		//         LEFT JOIN PERS_KOWIL_TBL b ON a.KOWIL = b.KOWIL
		//         LEFT JOIN PERS_KOCAM_TBL c ON a.KOCAM = c.KOCAM AND b.KOWIL = c.KOWIL
		//         LEFT JOIN PERS_KOKEL_TBL d ON a.KOKEL = d.KOKEL AND c.KOCAM = d.KOCAM AND b.KOWIL = d.KOWIL
		//         LEFT JOIN PERS_PROP_RPT e ON a.PROP = e.PROP
		//         LEFT JOIN PERS_STATUS_APPROVAL f on a.STAT_APP = f.KD_STATUS
		//         WHERE a.NRK = '".$nrk."' ORDER BY TGMULAI DESC
		//         ";

		$sql = "SELECT a.NRK, to_char(a.TGMULAI, 'YYYY-MM-DD') TGMULAI,
                a.ALAMAT, a.RT, a.RW,
                a.ALAMAT_KTP, a.RT_KTP, a.RW_KTP, j.KET_STATUS,
                b.NAMA AS NAWIL, c.NAMA AS NACAM, d.NAMA AS NAKEL, e.NAMA AS PROP,
                f.NAMA AS NAWIL_KTP, g.NAMA AS NACAM_KTP, h.NAMA AS NAKEL_KTP, i.NAMA AS PROP_KTP,to_char(a.TG_UPD, 'DD-MM-YYYY HH24:MI:SS') TG_UPD, a.USER_ID
                FROM PERS_ALAMAT_HIST a
                LEFT JOIN LOKASI b ON a.KOWIL = b.KODE
                LEFT JOIN LOKASI c ON a.KOCAM = c.KODE
                LEFT JOIN LOKASI d ON a.KOKEL = d.KODE
                LEFT JOIN LOKASI  e ON a.PROP = e.KODE
                LEFT JOIN LOKASI f ON a.KOWIL_KTP = f.KODE
                LEFT JOIN LOKASI g ON a.KOCAM_KTP = g.KODE
                LEFT JOIN LOKASI h ON a.KOKEL_KTP = h.KODE
                LEFT JOIN LOKASI  i ON a.PROP_KTP = i.KODE
                LEFT JOIN PERS_STATUS_APPROVAL j on a.STAT_APP = j.KD_STATUS
                WHERE a.NRK = '" . $nrk . "'

                ORDER BY TGMULAI DESC
                ";
		// AND a.DELETED IS NULL

		// echo $sql;exit;
		$query = $this->ci->db->query($sql);

		$i = 1;

		$table = "<div class='ibox float-e-margins animated fadeInDown'>"; //START IBOX
		$table .= "<div class='ibox-title navy-bg'>
                        <h5>Riwayat Alamat</h5>
                        <div class=\"ibox-tools\">
                            <a class=\"collapse-link\">
                                <i class=\"fa fa-chevron-up\"></i>
                            </a>
                            <a class=\"close-link\">
                                <i class=\"fa fa-times\"></i>
                            </a>
                        </div>
        </div>"; //IBOX TITLE
		$table .= "<div class='ibox-content'>"; //START IBOX CONTENT
		$table .= "<div id='_content_riwayat_" . $id . "' class='animated fadeInUp'>";
		if ($accIns == 'Y') {

			/*if($session_data['user_group'] == 10)
				            {
				                if($session_data['kowil'] == $kdKolokP1 || ( ($session_data['kowil'] == 11) && (substr($kolokP1, 0,2) == 11)))
				                {
				                    if(substr($kolokP1, 1,1) == 1  && $session_data['kowil'] == 1)
				                    {

				                    }
				                    else
				                    {
				                          $table .= "<div class='pull-right'><button type='button' class='btn btn-primary btn-sm btn-block m-t' onClick='getForm(\"alamat\");'><i class='fa fa-plus'></i> Tambah Data</button></div>";
				                    }

				                }
				            }
				            else
			*/
			$table .= "<div class='pull-right'><button type='button' class='btn btn-primary btn-sm btn-block m-t' onClick='getForm(\"alamat\");'><i class='fa fa-plus'></i> Tambah Data</button></div>";
			//}

		}

		$table .= "<table class='table table-hover table-bordered table-striped dataTables-example' width='99%'>";
		$table .= "<thead>";
		$table .= " <tr>
                        <th>No</th><th>Alamat Tempat Tinggal</th><th>Alamat KTP</th><th>Tgl. Mulai</th><th>Aksi</th>
                    </tr>";
		$table .= "</thead>";
		$table .= "<tbody>";
		foreach ($query->result() as $row) {
			$rt = "";
			if ($row->RT != '') {
				$rt = "RT. " . $row->RT;
			}
			$rw = "";
			if ($row->RW != '') {
				$rw = "RW. " . $row->RW;
			}
			$kel = "";
			if ($row->NAKEL != '') {
				$kel = "KEL. " . $row->NAKEL;
			}
			$kec = "";
			if ($row->NACAM != '') {
				$kec = "KEC. " . $row->NACAM;
			}
			$wil = "";
			if ($row->NAWIL != '') {
				$wil = $row->NAWIL;
			}
			$prop = "";
			if ($row->PROP != '') {
				$prop = $row->PROP;
			}

			$rt_ktp = "";
			if ($row->RT_KTP != '') {
				$rt_ktp = "RT. " . $row->RT_KTP;
			}
			$rw_ktp = "";
			if ($row->RW_KTP != '') {
				$rw_ktp = "RW. " . $row->RW_KTP;
			}
			$kel_ktp = "";
			if ($row->NAKEL_KTP != '') {
				$kel_ktp = "KEL. " . $row->NAKEL_KTP;
			}
			$kec_ktp = "";
			if ($row->NACAM_KTP != '') {
				$kec_ktp = "KEC. " . $row->NACAM_KTP;
			}
			$wil_ktp = "";
			if ($row->NAWIL_KTP != '') {
				$wil_ktp = $row->NAWIL_KTP . ", ";
			}
			$prop_ktp = "";
			if ($row->PROP_KTP != '') {
				$prop_ktp = $row->PROP_KTP;
			}

			$almt_domisili = $row->ALAMAT . "<br>" . $rt . " " . $rw . " " . $kel . " " . $kec . " " . $wil . " " . $prop;
			if ($row->ALAMAT_KTP == '') {
				$almt_ktp = $almt_domisili;
			} else {
				$almt_ktp = $row->ALAMAT_KTP . "<br>" . $rt_ktp . " " . $rw_ktp . " " . $kel_ktp . " " . $kec_ktp . " " . $wil_ktp . " " . $prop_ktp;
			}

			$table .= "<tr>";
			$table .= "<td>" . $i . "</td>";
			$table .= "<td>$almt_domisili</td>";

			$table .= "<td>$almt_ktp</td>";
			$tgmulai = date('d M Y', strtotime($row->TGMULAI));
			$table .= "<td>" . $tgmulai . "</td>";
			// $table .= "<td>".$row->KET_STATUS."</td>";

			$table .= "<td >";
			if ($accUpd == 'Y') {
				$table .= "<button type='button' class='btn btn-outline btn-xs btn-success' title='Edit' onClick='getForm(\"alamat\",\"update\",\"" . $row->NRK . "\",\"" . $row->TGMULAI . "\");'><i class='fa fa-pencil-square'></i></button> &nbsp;";
			}
			// if($accDelFlag == 'Y')
			// {
			//     $table.="<button type='button' class='btn btn-outline btn-xs btn-danger' title='Hapus' onClick='confirmHapusDataFlag(\"alamat\",\"".$row->NRK."\",\"".$row->TGMULAI."\");'><i class='fa fa-trash'></i></button> &nbsp;";
			// }
			if ($accDel == 'Y') {
				$table .= "<button type='button' class='btn btn-outline btn-xs btn-danger' title='Hapus ' onClick='confirmHapusData(\"alamat\",\"" . $row->NRK . "\",\"" . $row->TGMULAI . "\");'><i class='fa fa-trash'></i></button>";
			}
			$table .= "</td>";
			$table .= "</tr>";

			$i++;
		}
		$table .= "</tbody>";
		$table .= "</table>";
		$table .= "</div>";
		$table .= "</div>"; //END IBOX CONTENT
		$table .= "</div>"; //END IBOX
		$table .= "<script src=\"" . base_url() . "assets/inspinia/js/inspinia.js\"></script>";

		return $table;
	}

	public function getRiwayatAlamatPeg3($nrk, $ug, $id) {

		$access['mnac'] = $this->getMenuAccessBy($ug, 315);
		$accIns = $access['mnac']->act_insert;
		$accUpd = $access['mnac']->act_update;
		$accDel = $access['mnac']->act_delete;

		// $accDelFlag=$access['mnac']->act_delete_flag;

		$peg1 = $this->getPegawai1($nrk);

		$kolokP1 = $peg1->KOLOK;
		$kdKolokP1 = substr($kolokP1, 0, 1);

		// $sql = "SELECT a.NRK, to_char(a.TGMULAI, 'YYYY-MM-DD') TGMULAI, a.ALAMAT_KTP, a.ALAMAT, a.RT, a.RW, f.KET_STATUS,b.NAWIL, c.NACAM, d.NAKEL, e.KETERANGAN PROP
		//         FROM PERS_ALAMAT_HIST a
		//         LEFT JOIN PERS_KOWIL_TBL b ON a.KOWIL = b.KOWIL
		//         LEFT JOIN PERS_KOCAM_TBL c ON a.KOCAM = c.KOCAM AND b.KOWIL = c.KOWIL
		//         LEFT JOIN PERS_KOKEL_TBL d ON a.KOKEL = d.KOKEL AND c.KOCAM = d.KOCAM AND b.KOWIL = d.KOWIL
		//         LEFT JOIN PERS_PROP_RPT e ON a.PROP = e.PROP
		//         LEFT JOIN PERS_STATUS_APPROVAL f on a.STAT_APP = f.KD_STATUS
		//         WHERE a.NRK = '".$nrk."' ORDER BY TGMULAI DESC
		//         ";

		$sql = "SELECT a.NRK, to_char(a.TGMULAI, 'YYYY-MM-DD') TGMULAI,
                a.ALAMAT, a.RT, a.RW,
                a.ALAMAT_KTP, a.RT_KTP, a.RW_KTP, j.KET_STATUS,
                b.NAMA AS NAWIL, c.NAMA AS NACAM, d.NAMA AS NAKEL, e.NAMA AS PROP,
                f.NAMA AS NAWIL_KTP, g.NAMA AS NACAM_KTP, h.NAMA AS NAKEL_KTP, i.NAMA AS PROP_KTP,to_char(a.TG_UPD, 'DD-MM-YYYY HH24:MI:SS') TG_UPD, a.USER_ID
                FROM PERS_ALAMAT_HIST a
                LEFT JOIN LOKASI b ON a.KOWIL = b.KODE
                LEFT JOIN LOKASI c ON a.KOCAM = c.KODE
                LEFT JOIN LOKASI d ON a.KOKEL = d.KODE
                LEFT JOIN LOKASI  e ON a.PROP = e.KODE
                LEFT JOIN LOKASI f ON a.KOWIL_KTP = f.KODE
                LEFT JOIN LOKASI g ON a.KOCAM_KTP = g.KODE
                LEFT JOIN LOKASI h ON a.KOKEL_KTP = h.KODE
                LEFT JOIN LOKASI  i ON a.PROP_KTP = i.KODE
                LEFT JOIN PERS_STATUS_APPROVAL j on a.STAT_APP = j.KD_STATUS
                WHERE a.NRK = '" . $nrk . "'

                ORDER BY TGMULAI DESC
                ";
		// AND a.DELETED IS NULL

		// echo $sql;exit;
		$query = $this->ci->db->query($sql);

		$i = 1;

		$table = "<div class='ibox float-e-margins animated fadeInDown'>"; //START IBOX
		$table .= "<div class='ibox-title navy-bg'>
                        <h5>Riwayat Alamat</h5>
                        <div class=\"ibox-tools\">
                            <a class=\"collapse-link\">
                                <i class=\"fa fa-chevron-up\"></i>
                            </a>
                            <a class=\"close-link\">
                                <i class=\"fa fa-times\"></i>
                            </a>
                        </div>
        </div>"; //IBOX TITLE
		$table .= "<div class='ibox-content'>"; //START IBOX CONTENT
		$table .= "<div id='_content_riwayat_" . $id . "' class='animated fadeInUp'>";
		if ($accIns == 'Y') {

			/*if($session_data['user_group'] == 10)
				            {
				                if($session_data['kowil'] == $kdKolokP1 || ( ($session_data['kowil'] == 11) && (substr($kolokP1, 0,2) == 11)))
				                {
				                    if(substr($kolokP1, 1,1) == 1  && $session_data['kowil'] == 1)
				                    {

				                    }
				                    else
				                    {
				                          $table .= "<div class='pull-right'><button type='button' class='btn btn-primary btn-sm btn-block m-t' onClick='getForm(\"alamat\");'><i class='fa fa-plus'></i> Tambah Data</button></div>";
				                    }

				                }
				            }
				            else
			*/
			$table .= "<div class='pull-right'><button type='button' class='btn btn-primary btn-sm btn-block m-t' onClick='getForm(\"alamat\");'><i class='fa fa-plus'></i> Tambah Data</button></div>";
			//}

		}

		$table .= "<table class='table table-hover table-bordered table-striped dataTables-example' width='99%'>";
		$table .= "<thead>";
		$table .= " <tr>
                        <th>No</th><th>Alamat Tempat Tinggal</th><th>Alamat KTP</th><th>Tgl. Mulai</th>
                    </tr>";
		$table .= "</thead>";
		$table .= "<tbody>";
		foreach ($query->result() as $row) {
			$rt = "";
			if ($row->RT != '') {
				$rt = "RT. " . $row->RT;
			}
			$rw = "";
			if ($row->RW != '') {
				$rw = "RW. " . $row->RW;
			}
			$kel = "";
			if ($row->NAKEL != '') {
				$kel = "KEL. " . $row->NAKEL;
			}
			$kec = "";
			if ($row->NACAM != '') {
				$kec = "KEC. " . $row->NACAM;
			}
			$wil = "";
			if ($row->NAWIL != '') {
				$wil = $row->NAWIL;
			}
			$prop = "";
			if ($row->PROP != '') {
				$prop = $row->PROP;
			}

			$rt_ktp = "";
			if ($row->RT_KTP != '') {
				$rt_ktp = "RT. " . $row->RT_KTP;
			}
			$rw_ktp = "";
			if ($row->RW_KTP != '') {
				$rw_ktp = "RW. " . $row->RW_KTP;
			}
			$kel_ktp = "";
			if ($row->NAKEL_KTP != '') {
				$kel_ktp = "KEL. " . $row->NAKEL_KTP;
			}
			$kec_ktp = "";
			if ($row->NACAM_KTP != '') {
				$kec_ktp = "KEC. " . $row->NACAM_KTP;
			}
			$wil_ktp = "";
			if ($row->NAWIL_KTP != '') {
				$wil_ktp = $row->NAWIL_KTP . ", ";
			}
			$prop_ktp = "";
			if ($row->PROP_KTP != '') {
				$prop_ktp = $row->PROP_KTP;
			}

			$almt_domisili = $row->ALAMAT . "<br>" . $rt . " " . $rw . " " . $kel . " " . $kec . " " . $wil . " " . $prop;
			if ($row->ALAMAT_KTP == '') {
				$almt_ktp = $almt_domisili;
			} else {
				$almt_ktp = $row->ALAMAT_KTP . "<br>" . $rt_ktp . " " . $rw_ktp . " " . $kel_ktp . " " . $kec_ktp . " " . $wil_ktp . " " . $prop_ktp;
			}

			$table .= "<tr>";
			$table .= "<td>" . $i . "</td>";
			$table .= "<td>$almt_domisili</td>";

			$table .= "<td>$almt_ktp</td>";
			$tgmulai = date('d M Y', strtotime($row->TGMULAI));
			$table .= "<td>" . $tgmulai . "</td>";
			// $table .= "<td>".$row->KET_STATUS."</td>";

			$table .= "</tr>";

			$i++;
		}
		$table .= "</tbody>";
		$table .= "</table>";
		$table .= "</div>";
		$table .= "</div>"; //END IBOX CONTENT
		$table .= "</div>"; //END IBOX
		$table .= "<script src=\"" . base_url() . "assets/inspinia/js/inspinia.js\"></script>";

		return $table;
	}

	public function getRiwayatAlamatOld($nrk, $ug, $id) {
		$access['mnac'] = $this->getMenuAccessBy($ug, 315);
		$accIns = $access['mnac']->act_insert;
		$accUpd = $access['mnac']->act_update;
		$accDel = $access['mnac']->act_delete;
		// $accDelFlag=$access['mnac']->act_delete_flag;

		$sql = "SELECT
                  a.NRK, to_char(a.TGMULAI, 'YYYY-MM-DD') TGMULAI, a.ALAMAT_KTP,
                  a.ALAMAT, a.RT, a.RW, f.KET_STATUS,
                  b.NAWIL, c.NACAM, d.NAKEL, e.KETERANGAN PROP, to_char(a.TG_UPD, 'DD-MM-YYYY HH24:MI:SS') TG_UPD, a.USER_ID
                FROM PERS_ALAMAT_HIST a
                LEFT JOIN PERS_KOWIL_TBL b ON a.KOWIL = b.KOWIL
                LEFT JOIN PERS_KOCAM_TBL c ON a.KOCAM = c.KOCAM AND b.KOWIL = c.KOWIL
                LEFT JOIN PERS_KOKEL_TBL d ON a.KOKEL = d.KOKEL AND c.KOCAM = d.KOCAM AND b.KOWIL = d.KOWIL
                LEFT JOIN PERS_PROP_RPT e ON a.PROP = e.PROP
                LEFT JOIN PERS_STATUS_APPROVAL f on a.STAT_APP = f.KD_STATUS
                WHERE a.NRK = '" . $nrk . "'

                ORDER BY TGMULAI DESC
                ";
		// AND a.DELETED IS NULL

		$query = $this->ci->db->query($sql);

		$i = 1;

		$table = "<div class='ibox float-e-margins animated fadeInDown'>"; //START IBOX
		$table .= "<div class='ibox-title navy-bg'>
                        <h5>Riwayat Alamat</h5>
                        <div class=\"ibox-tools\">
                            <a class=\"collapse-link\">
                                <i class=\"fa fa-chevron-up\"></i>
                            </a>
                            <a class=\"close-link\">
                                <i class=\"fa fa-times\"></i>
                            </a>
                        </div>
        </div>"; //IBOX TITLE
		$table .= "<div class='ibox-content'>"; //START IBOX CONTENT
		$table .= "<div id='_content_riwayat_" . $id . "' class='animated fadeInUp'>";
		if ($accIns == 'Y') {
			$table .= "<div class='pull-right'><button type='button' class='btn btn-primary btn-sm btn-block m-t' onClick='getForm(\"alamat_2\");'><i class='fa fa-plus'></i> Tambah Data</button></div>";
		}
		$table .= "<table class='table table-striped table-bordered table-hover dataTables-example' width='99%'>";
//        $table .= "<thead>";
		$table .= " <tr>
                        <th>No</th>
                        <th>Alamat Tempat Tinggal</th>
                        <th>Alamat KTP</th>
                        <th>Tgl. Mulai</th>
                        <th>Status Approval</th>
                        <th>Tgl. Update</th>
                        <th>User ID</th>
                        <th>Aksi</th>
                    </tr>";
//        $table .= "</thead>";
		//        $table .= "<tbody>";
		foreach ($query->result() as $row) {
			$almt_domisili = $row->ALAMAT . "<br>RT " . $row->RT . " RW " . $row->RW . ", Kel. " . $row->NAKEL . ", Kec. " . $row->NACAM . "<br>" . $row->NAWIL . " - " . $row->PROP;
			if ($row->ALAMAT_KTP == '') {
				$almt_ktp = $almt_domisili;
			} else {
				$almt_ktp = $row->ALAMAT_KTP . "<br>RT " . $row->RT_KTP . " RW " . $row->RW_KTP . ", Kel. " . $row->NAKEL . ", Kec. " . $row->NACAM . "<br>" . $row->NAWIL . " - " . $row->PROP;
			}

			$table .= "<tr>";
			$table .= "<td width='5px'>" . $i . "</td>";
			$table .= "<td>$almt_domisili</td>";
			$table .= "<td>" . $row->ALAMAT_KTP . "</td>";
			$tgmulai = date('d-m-Y', strtotime($row->TGMULAI));
			$table .= "<td width='85px'>" . $tgmulai . "</td>";
			$table .= "<td>" . $row->KET_STATUS . "</td>";
			$table .= "<td>" . $row->TG_UPD . "</td>";
			$table .= "<td>" . $row->USER_ID . "</td>";
			$table .= "<td >";
			if ($accUpd == 'Y') {
				$table .= "<button type='button' class='btn btn-outline btn-xs btn-success' title='Edit' onClick='getForm(\"alamat_2\",\"update\",\"" . $row->NRK . "\",\"" . $row->TGMULAI . "\");'><i class='fa fa-pencil-square'></i></button> &nbsp;";
			}
			// if($accDelFlag == 'Y')
			// {
			//     $table.="<button type='button' class='btn btn-outline btn-xs btn-danger' title='Hapus' onClick='confirmHapusDataFlag(\"alamat\",\"".$row->NRK."\",\"".$row->TGMULAI."\");'><i class='fa fa-trash'></i></button>";
			// }
			if ($accDel == 'Y') {
				$table .= "<button type='button' class='btn btn-outline btn-xs btn-danger' title='Hapus ' onClick='confirmHapusData(\"alamat\",\"" . $row->NRK . "\",\"" . $row->TGMULAI . "\");'><i class='fa fa-trash'></i></button>";
			}
			$table .= "</td>";
			$table .= "</tr>";

			$i++;
		}
//        $table .= "</tbody>";
		$table .= "</table>";
		$table .= "</div>";
		$table .= "</div>"; //END IBOX CONTENT
		$table .= "</div>"; //END IBOX
		$table .= "<script src=\"" . base_url() . "assets/inspinia/js/inspinia.js\"></script>"; //END IBOX

		return $table;
	}

	public function getRiwayatAlamat($nrk, $ug, $id) {
		$access['mnac'] = $this->getMenuAccessBy($ug, 315);
		$accIns = $access['mnac']->act_insert;
		$accUpd = $access['mnac']->act_update;
		$accDel = $access['mnac']->act_delete;
		// $accDelFlag=$access['mnac']->act_delete_flag;

		$sql = "SELECT
                  a.NRK, to_char(a.TGMULAI, 'YYYY-MM-DD') TGMULAI,
                  a.ALAMAT, a.RT, a.RW, b.NAMA AS NAWIL, c.NAMA AS NACAM, d.NAMA AS NAKEL, e.NAMA AS prop, f.KET_STATUS,
                  a.ALAMAT_KTP, a.RT_KTP, a.RW_KTP, g.NAMA AS NAWIL_KTP, h.NAMA AS NACAM_KTP, i.NAMA AS NAKEL_KTP, j.NAMA AS PROP_KTP,
                  e.KETERANGAN PROP, to_char(a.TG_UPD, 'DD-MM-YYYY HH24:MI:SS') TG_UPD, a.USER_ID
                FROM PERS_ALAMAT_HIST a
                LEFT JOIN LOKASI b ON a.KOWIL = b.KODE
                LEFT JOIN LOKASI c ON a.KOCAM = c.KODE
                LEFT JOIN LOKASI d ON a.KOKEL = d.KODE
                LEFT JOIN LOKASI e ON a.PROP = d.KODE
                LEFT JOIN PERS_STATUS_APPROVAL f on a.STAT_APP = f.KD_STATUS
                LEFT JOIN LOKASI g ON a.KOWIL_KTP = g.KODE
                LEFT JOIN LOKASI h ON a.KOCAM_KTP = h.KODE
                LEFT JOIN LOKASI i ON a.KOKEL_KTP = i.KODE
                LEFT JOIN LOKASI j ON a.PROP_KTP = i.KODE
                WHERE a.NRK = '" . $nrk . "'

                ORDER BY TGMULAI DESC
                ";
		// AND a.DELETED IS NULL

		$query = $this->ci->db->query($sql);

		$i = 1;

		$table = "<div class='ibox float-e-margins animated fadeInDown'>"; //START IBOX
		$table .= "<div class='ibox-title navy-bg'>
                        <h5>Riwayat Alamat</h5>
                        <div class=\"ibox-tools\">
                            <a class=\"collapse-link\">
                                <i class=\"fa fa-chevron-up\"></i>
                            </a>
                            <a class=\"close-link\">
                                <i class=\"fa fa-times\"></i>
                            </a>
                        </div>
        </div>"; //IBOX TITLE
		$table .= "<div class='ibox-content'>"; //START IBOX CONTENT
		$table .= "<div id='_content_riwayat_" . $id . "' class='animated fadeInUp'>";
		if ($accIns == 'Y') {
			$table .= "<div class='pull-right'><button type='button' class='btn btn-primary btn-sm btn-block m-t' onClick='getForm(\"alamat_2\");'><i class='fa fa-plus'></i> Tambah Data</button></div>";
		}
		$table .= "<table class='table table-striped table-bordered table-hover dataTables-example' width='99%'>";
//        $table .= "<thead>";
		$table .= " <tr>
                        <th>No</th>
                        <th>Alamat Tempat Tinggal</th>
                        <th>Alamat KTP</th>
                        <th>Tgl. Mulai</th>
                        <th>Status Approval</th>
                        <th>Tgl. Update</th>
                        <th>User ID</th>
                        <th>Aksi</th>
                    </tr>";
//        $table .= "</thead>";
		//        $table .= "<tbody>";
		foreach ($query->result() as $row) {
			$almt_domisili = $row->ALAMAT . "<br>RT " . $row->RT . " RW " . $row->RW . ", Kel. " . $row->NAKEL . ", Kec. " . $row->NACAM . "<br>" . $row->NAWIL . " - " . $row->PROP;
			if ($row->ALAMAT_KTP == '') {
				$almt_ktp = $almt_domisili;
			} else {
				$almt_ktp = $row->ALAMAT_KTP . "<br>RT " . $row->RT_KTP . " RW " . $row->RW_KTP . ", Kel. " . $row->NAKEL_KTP . ", Kec. " . $row->NACAM_KTP . "<br>" . $row->NAWIL_KTP . " - " . $row->PROP;
			}

			$table .= "<tr>";
			$table .= "<td width='5px'>" . $i . "</td>";
			$table .= "<td>$almt_domisili</td>";
			$table .= "<td>" . $row->ALAMAT_KTP . "</td>";
			$tgmulai = date('d-m-Y', strtotime($row->TGMULAI));
			$table .= "<td width='85px'>" . $tgmulai . "</td>";
			$table .= "<td>" . $row->KET_STATUS . "</td>";
			$table .= "<td>" . $row->TG_UPD . "</td>";
			$table .= "<td>" . $row->USER_ID . "</td>";
			$table .= "<td >";
			if ($accUpd == 'Y') {
				$table .= "<button type='button' class='btn btn-outline btn-xs btn-success' title='Edit' onClick='getForm(\"alamat_2\",\"update\",\"" . $row->NRK . "\",\"" . $row->TGMULAI . "\");'><i class='fa fa-pencil-square'></i></button> &nbsp;";
			}
			// if($accDelFlag == 'Y')
			// {
			//     $table.="<button type='button' class='btn btn-outline btn-xs btn-danger' title='Hapus' onClick='confirmHapusDataFlag(\"alamat\",\"".$row->NRK."\",\"".$row->TGMULAI."\");'><i class='fa fa-trash'></i></button>";
			// }
			if ($accDel == 'Y') {
				$table .= "<button type='button' class='btn btn-outline btn-xs btn-danger' title='Hapus ' onClick='confirmHapusData(\"alamat\",\"" . $row->NRK . "\",\"" . $row->TGMULAI . "\");'><i class='fa fa-trash'></i></button>";
			}
			$table .= "</td>";
			$table .= "</tr>";

			$i++;
		}
//        $table .= "</tbody>";
		$table .= "</table>";
		$table .= "</div>";
		$table .= "</div>"; //END IBOX CONTENT
		$table .= "</div>"; //END IBOX
		$table .= "<script src=\"" . base_url() . "assets/inspinia/js/inspinia.js\"></script>"; //END IBOX

		return $table;
	}

	public function getRequestAlamat($ug, $id) {
		$access['mnac'] = $this->getMenuAccessBy($ug, 315);

		$accUpd = $access['mnac']->act_update;
		// $accDelFlag=$access['mnac']->act_delete_flag;

		$sql = "SELECT a.NRK, to_char(a.TGMULAI, 'YYYY-MM-DD') TGMULAI, a.ALAMAT_KTP, a.ALAMAT, a.RT, a.RW, a.STAT_APP, f.KET_STATUS,b.NAWIL, c.NACAM, d.NAKEL, e.KETERANGAN PROP
                FROM PERS_ALAMAT_HIST a
                LEFT JOIN PERS_KOWIL_TBL b ON a.KOWIL = b.KOWIL
                LEFT JOIN PERS_KOCAM_TBL c ON a.KOCAM = c.KOCAM AND b.KOWIL = c.KOWIL
                LEFT JOIN PERS_KOKEL_TBL d ON a.KOKEL = d.KOKEL AND c.KOCAM = d.KOCAM AND b.KOWIL = d.KOWIL
                LEFT JOIN PERS_PROP_RPT e ON a.PROP = e.PROP
                LEFT JOIN PERS_STATUS_APPROVAL f on a.STAT_APP = f.KD_STATUS
                WHERE a.STAT_APP = 2

                ORDER BY TGMULAI DESC
                ";
		// AND a.DELETED IS NULL

		$query = $this->ci->db->query($sql);

		$i = 1;

		$table = "<div class='ibox float-e-margins animated fadeInDown'>"; //START IBOX
		$table .= "<div class='ibox-title navy-bg'>
                        <h5>Riwayat Alamat</h5>
                        <div class=\"ibox-tools\">
                            <a class=\"collapse-link\">
                                <i class=\"fa fa-chevron-up\"></i>
                            </a>
                            <a class=\"close-link\">
                                <i class=\"fa fa-times\"></i>
                            </a>
                        </div>
        </div>"; //IBOX TITLE
		$table .= "<div class='ibox-content'>"; //START IBOX CONTENT
		$table .= "<div id='_content_riwayat_" . $id . "' class='animated fadeInUp'>";

		$table .= "<table class='table table-striped table-bordered table-hover dataTables-example' width='99%'>";
//        $table .= "<thead>";
		$table .= " <tr>
                        <th>No</th><th>NRK</th><th>Alamat KTP</th><th>Alamat</th><th>Tgl. Mulai</th><th>Status</th><th>Aksi</th>
                    </tr>";
//        $table .= "</thead>";
		//        $table .= "<tbody>";
		foreach ($query->result() as $row) {
			$table .= "<tr>";
			$table .= "<td width='5px'>" . $i . "</td>";
			$table .= "<td>" . $row->NRK . "</td>";
			$table .= "<td>" . $row->ALAMAT_KTP . "</td>";
			$table .= "<td>" . $row->ALAMAT . "<br>RT " . $row->RT . " RW " . $row->RW . ", Kel. " . $row->NAKEL . ", Kec. " . $row->NACAM . "<br>" . $row->NAWIL . " - " . $row->PROP . "</td>";
			$tgmulai = date('d M Y', strtotime($row->TGMULAI));
			$table .= "<td width='85px'>" . $tgmulai . "</td>";
			$table .= "<td>" . $row->KET_STATUS . "</td>";
			$table .= "<td >";
			if ($accUpd == 'Y') {
				$table .= "<button type='button' class='btn btn-outline btn-xs btn-success' title='Edit' onClick='getForm(\"alamat_2\",\"" . $row->NRK . "\",\"update\",\"" . $row->NRK . "\",\"" . $row->TGMULAI . "\");'><i class='fa fa-pencil-square'></i></button> &nbsp;";
			}

			$table .= "</td>";
			$table .= "</tr>";

			$i++;
		}
//        $table .= "</tbody>";
		$table .= "</table>";
		$table .= "</div>";
		$table .= "</div>"; //END IBOX CONTENT
		$table .= "</div>"; //END IBOX
		$table .= "<script src=\"" . base_url() . "assets/inspinia/js/inspinia.js\"></script>"; //END IBOX

		return $table;
	}

	public function getRiwayatPenghargaan($nrk, $ug, $id) {
		$access['mnac'] = $this->getMenuAccessBy($ug, 316);
		$accIns = $access['mnac']->act_insert;
		$accUpd = $access['mnac']->act_update;
		$accDel = $access['mnac']->act_delete;
		// $accDelFlag=$access['mnac']->act_delete_flag;

		$sql = "SELECT
                  a.NRK, a.KDHARGA, b.NAHARGA, a.TGSK, a.NOSK, a.ASAL_HRG,
                  to_char(a.TG_UPD,'DD-MM-YYYY HH24:MI:SS')TG_UPD, a.USER_ID
                FROM PERS_PENGHARGAAN a
                LEFT JOIN PERS_HARGAAN_TBL b ON a.KDHARGA = b.KDHARGA
                WHERE a.NRK = '" . $nrk . "'

                ORDER BY a.TGSK DESC
                ";
		// AND a.DELETED IS NULL

		$query = $this->ci->db->query($sql);

		$i = 1;

		$table = "<div class='ibox float-e-margins animated fadeInDown'>"; //START IBOX
		$table .= "<div class='ibox-title navy-bg'>
                        <h5>Riwayat Penghargaan</h5>
                        <div class=\"ibox-tools\">
                            <a class=\"collapse-link\">
                                <i class=\"fa fa-chevron-up\"></i>
                            </a>
                            <a class=\"close-link\">
                                <i class=\"fa fa-times\"></i>
                            </a>
                        </div>
        </div>"; //IBOX TITLE
		$table .= "<div class='ibox-content'>"; //START IBOX CONTENT
		$table .= "<div id='_content_riwayat_" . $id . "' class='animated fadeInUp'>";
		if ($accIns == 'Y') {
			$table .= "<div class='pull-right'><button type='button' class='btn btn-primary btn-sm btn-block m-t' onClick='getForm(\"penghargaan\",\"tambah\");'><i class='fa fa-plus'></i> Tambah Data</button></div>";
		}
		$table .= "<table class='table table-striped table-bordered table-hover dataTables-example' width='99%'>";
		$table .= "<thead>";
		$table .= " <tr>
                        <th>No</th>
                        <th>No.SK <br/> <strong><small class='text-navy'>(Tgl. SK)</small></strong></th>
                        <th>Nama Penghargaan</th>
                        <th>Asal Penghargaan</th>
                        <th>User ID <br/><strong><small class='text-navy'>(Tgl. Update)</small></strong></th>
                        <th>Aksi</th>
                    </tr>";
		$table .= "</thead>";
		$table .= "<tbody>";
		foreach ($query->result() as $row) {
			$table .= "<tr>";
			$table .= "<td width='5px'>" . $i . "</td>";

			$tgsk = date('d-m-Y', strtotime($row->TGSK));
			$table .= "<td>" . $row->NOSK . "<br><strong><small class='text-navy'>(" . $tgsk . ")</small></strong></td>";

			$table .= "<td>" . $row->NAHARGA . "</td>";
			$table .= "<td>" . $row->ASAL_HRG . "</td>";
			$TG_UPD = date('d-m-Y', strtotime($row->TG_UPD));
			$table .= "<td>" . $row->USER_ID . "<br><strong><small class='text-navy'>(" . $row->TG_UPD . ")</small></strong></td>";
			$table .= "<td >";
			if ($accUpd == 'Y') {
				$table .= "<button type='button' class='btn btn-outline btn-xs btn-success' title='Edit' onClick='getForm(\"penghargaan\",\"update\",\"" . $row->NRK . "\",\"" . $row->KDHARGA . "\");'><i class='fa fa-pencil-square'></i></button> &nbsp;";
			}
			// if($accDelFlag == 'Y')
			// {
			//     $table.="<button type='button' class='btn btn-outline btn-xs btn-danger' title='Hapus' onClick='confirmHapusDataFlag(\"penghargaan\",\"".$row->NRK."\",\"".$row->KDHARGA."\");'><i class='fa fa-trash'></i></button> &nbsp;";
			// }
			if ($accDel == 'Y') {
				$table .= "<button type='button' class='btn btn-outline btn-xs btn-danger' title='Hapus ' onClick='confirmHapusData(\"penghargaan\",\"" . $row->NRK . "\",\"" . $row->KDHARGA . "\");'><i class='fa fa-trash'></i></button>";
			}
			$table .= "</td>";
			$table .= "</tr>";

			$i++;
		}
		$table .= "</tbody>";
		$table .= "</table>";
		$table .= "</div>";
		$table .= "</div>"; //END IBOX CONTENT
		$table .= "</div>"; //END IBOX
		$table .= "<script src=\"" . base_url() . "assets/inspinia/js/inspinia.js\"></script>"; //END IBOX

		return $table;
	}

	public function getRiwayatPenghargaanPeg($nrk, $ug, $id) {
		$access['mnac'] = $this->getMenuAccessBy($ug, 316);
		$accIns = $access['mnac']->act_insert;
		$accUpd = $access['mnac']->act_update;
		$accDel = $access['mnac']->act_delete;
		// $accDelFlag=$access['mnac']->act_delete_flag;

		$sql = "SELECT
                  a.NRK, a.KDHARGA, b.NAHARGA, a.TGSK, a.NOSK, a.ASAL_HRG,
                  a.TG_UPD, a.USER_ID
                FROM PERS_PENGHARGAAN a
                LEFT JOIN PERS_HARGAAN_TBL b ON a.KDHARGA = b.KDHARGA
                WHERE a.NRK = '" . $nrk . "'

                ORDER BY a.TGSK DESC
                ";
		// AND a.DELETED IS NULL

		$query = $this->ci->db->query($sql);

		$i = 1;

		$table = "<div class='ibox float-e-margins animated fadeInDown'>"; //START IBOX
		$table .= "<div class='ibox-title navy-bg'>
                        <h5>Riwayat Penghargaan</h5>
                        <div class=\"ibox-tools\">
                            <a class=\"collapse-link\">
                                <i class=\"fa fa-chevron-up\"></i>
                            </a>
                            <a class=\"close-link\">
                                <i class=\"fa fa-times\"></i>
                            </a>
                        </div>
        </div>"; //IBOX TITLE
		$table .= "<div class='ibox-content'>"; //START IBOX CONTENT
		$table .= "<div id='_content_riwayat_" . $id . "' class='animated fadeInUp'>";
		if ($accIns == 'Y') {
			$table .= "<div class='pull-right'><button type='button' class='btn btn-primary btn-sm btn-block m-t' onClick='getForm(\"penghargaan\",\"tambah\");'><i class='fa fa-plus'></i> Tambah Data</button></div>";
		}
		$table .= "<table class='table table-striped table-bordered table-hover dataTables-example' width='99%'>";
		$table .= "<thead>";
		$table .= " <tr>
                        <th>No</th><th>No.SK <br/> <strong><small class='text-navy'>(Tgl. SK)</small></strong></th><th>Nama Penghargaan</th><th>Asal Penghargaan</th>
                    </tr>";
		$table .= "</thead>";
		$table .= "<tbody>";
		foreach ($query->result() as $row) {
			$table .= "<tr>";
			$table .= "<td width='5px'>" . $i . "</td>";
			$tgsk = date('d-m-Y', strtotime($row->TGSK));
			$table .= "<td>" . $row->NOSK . "<br><strong><small class='text-navy'>(" . $tgsk . ")</small></strong></td>";
			$table .= "<td>" . $row->NAHARGA . "</td>";
			$table .= "<td>" . $row->ASAL_HRG . "</td>";

			$table .= "</tr>";

			$i++;
		}
		$table .= "</tbody>";
		$table .= "</table>";
		$table .= "</div>";
		$table .= "</div>"; //END IBOX CONTENT
		$table .= "</div>"; //END IBOX
		$table .= "<script src=\"" . base_url() . "assets/inspinia/js/inspinia.js\"></script>"; //END IBOX

		return $table;
	}

	public function getRiwayatFasilitas($nrk, $ug, $id) {
		$access['mnac'] = $this->getMenuAccessBy($ug, 317);
		$accIns = $access['mnac']->act_insert;
		$accUpd = $access['mnac']->act_update;
		$accDel = $access['mnac']->act_delete;
		// $accDelFlag=$access['mnac']->act_delete_flag;

		$sql = "SELECT
                    a.NRK, a.JENFAS, c.KETERANGAN AS KET_FASILITAS, a.THDAPAT, a.THSAMPAI,B.KETERANGAN AS KET_INSTANSI,
                    TO_CHAR(a.TG_UPD,'DD-MM-YYYY HH24:MI:SS') TG_UPD, a.USER_ID
                 FROM PERS_KESRA a
                 LEFT JOIN PERS_JENFAS_RPT c ON a.JENFAS = c.JENFAS
                 LEFT JOIN PERS_INSTANSI_RPT B ON a.INSTANSI = b.INSTANSI
                 WHERE a.NRK = '" . $nrk . "'

                 ORDER BY a.THDAPAT DESC
               ";
		// AND a.DELETED IS NULL

		$query = $this->ci->db->query($sql);

		$i = 1;

		$table = "<div class='ibox float-e-margins animated fadeInDown'>"; //START IBOX
		$table .= "<div class='ibox-title navy-bg'>
                        <h5>Riwayat Fasilitas</h5>
                        <div class=\"ibox-tools\">
                            <a class=\"collapse-link\">
                                <i class=\"fa fa-chevron-up\"></i>
                            </a>
                            <a class=\"close-link\">
                                <i class=\"fa fa-times\"></i>
                            </a>
                        </div>
        </div>"; //IBOX TITLE
		$table .= "<div class='ibox-content'>"; //START IBOX CONTENT
		$table .= "<div id='_content_riwayat_" . $id . "' class='animated fadeInUp'>";
		if ($accIns == 'Y') {
			$table .= "<div class='pull-right'><button type='button' class='btn btn-primary btn-sm btn-block m-t' onClick='getForm(\"fasilitas\",\"tambah\");'><i class='fa fa-plus'></i> Tambah Data</button></div>";
		}
		$table .= "<table class='table table-striped table-bordered table-hover dataTables-example' width='99%'>";
		$table .= "<thead>";
		$table .= " <tr>
                         <th>No</th><th>Nama Fasilitas</th><th>Tahun Dapat</th><th>Tahun Sampai</th><th>Instansi</th><th>Tgl. Update</th><th>User ID</th><th>Aksi</th>
                     </tr>";
		$table .= "</thead>";
		$table .= "<tbody>";
		foreach ($query->result() as $row) {
			$table .= "<tr>";
			$table .= "<td width='5px'>" . $i . "</td>";
			$table .= "<td>" . $row->KET_FASILITAS . "</td>";
			$table .= "<td>" . $row->THDAPAT . "</td>";
			$table .= "<td>" . $row->THSAMPAI . "</td>";
			$table .= "<td>" . $row->KET_INSTANSI . "</td>";
			$table .= "<td>" . $row->TG_UPD . "</td>";
			$table .= "<td>" . $row->USER_ID . "</td>";
			$table .= "<td >";
			if ($accUpd == 'Y') {
				$table .= "<button type='button' class='btn btn-outline btn-xs btn-success' title='Edit' onClick='getForm(\"fasilitas\",\"update\",\"" . $row->NRK . "\",\"" . $row->JENFAS . "\",\"" . $row->THDAPAT . "\");'><i class='fa fa-pencil-square'></i></button> &nbsp;";
			}
			// if($accDelFlag == 'Y')
			// {
			//    $table.="<button type='button' class='btn btn-outline btn-xs btn-danger' title='Hapus' onClick='confirmHapusDataFlag(\"fasilitas\",\"".$row->NRK."\",\"".$row->JENFAS."\",\"".$row->THDAPAT."\");'><i class='fa fa-trash'></i></button>";
			// }
			if ($accDel == 'Y') {
				$table .= "<button type='button' class='btn btn-outline btn-xs btn-danger' title='Hapus ' onClick='confirmHapusData(\"fasilitas\",\"" . $row->NRK . "\",\"" . $row->JENFAS . "\",\"" . $row->THDAPAT . "\");'><i class='fa fa-trash'></i></button>";
			}
			$table .= " </td>";
			$table .= "</tr>";

			$i++;
		}
		$table .= "</tbody>";
		$table .= "</table>";
		$table .= "</div>";
		$table .= "</div>"; //END IBOX CONTENT
		$table .= "</div>"; //END IBOX
		$table .= "<script src=\"" . base_url() . "assets/inspinia/js/inspinia.js\"></script>"; //END IBOX

		return $table;
	}

	public function getRiwayatOrganisasi($nrk, $ug, $id) {
		$access['mnac'] = $this->getMenuAccessBy($ug, 318);
		$accIns = $access['mnac']->act_insert;
		$accUpd = $access['mnac']->act_update;
		$accDel = $access['mnac']->act_delete;
		// $accDelFlag=$access['mnac']->act_delete_flag;
		$sql = "SELECT a.NRK, COALESCE(to_char(a.DARI, 'YYYY-MM-DD'),'-') DARI, COALESCE(to_char(a.SAMPAI, 'YYYY-MM-DD'),'-') SAMPAI, a.NAORGANI, b.KETERANGAN, a.KOTA
                FROM PERS_ORGAN_HIST a
                LEFT JOIN PERS_KDDUDUK_RPT b ON a.KDDUDUK = b.KDDUDUK
                WHERE a.NRK = '" . $nrk . "'

                ORDER BY a.DARI DESC
                ";
		// AND a.DELETED IS NULL

		$query = $this->ci->db->query($sql);

		$i = 1;

		$table = "<div class='ibox float-e-margins animated fadeInDown'>"; //START IBOX
		$table .= "<div class='ibox-title navy-bg'>
                        <h5>Riwayat Organisasi</h5>
                        <div class=\"ibox-tools\">
                            <a class=\"collapse-link\">
                                <i class=\"fa fa-chevron-up\"></i>
                            </a>
                            <a class=\"close-link\">
                                <i class=\"fa fa-times\"></i>
                            </a>
                        </div>
        </div>"; //IBOX TITLE
		$table .= "<div class='ibox-content'>"; //START IBOX CONTENT
		$table .= "<div id='_content_riwayat_" . $id . "' class='animated fadeInUp'>";
		if ($accIns == 'Y') {
			$table .= "<div class='pull-right'><button type='button' class='btn btn-primary btn-sm btn-block m-t' onClick='getForm(\"organisasi\",\"tambah\");'><i class='fa fa-plus'></i> Tambah Data</button></div>";
		}
		$table .= "<table class='table table-striped table-bordered table-hover dataTables-example' width='99%'>";
		$table .= "<thead>";
		$table .= " <tr>
                        <th>No</th><th>Nama Organisasi</th><th>Tgl. Bergabung</th><th>Posisi</th><th>Kota</th><th>Aksi</th>
                    </tr>";
		$table .= "</thead>";
		$table .= "<tbody>";
		foreach ($query->result() as $row) {
			$table .= "<tr>";
			$table .= "<td width='5px'>" . $i . "</td>";
			$table .= "<td>" . $row->NAORGANI . "</td>";
			if ($row->DARI != '-') {
				$dari = date('d M Y', strtotime($row->DARI));
			} else {
				$dari = $row->DARI;
			}
			if ($row->SAMPAI != '-') {
				$sampai = date('d M Y', strtotime($row->SAMPAI));
			} else {
				$sampai = $row->SAMPAI;
			}

			$table .= "<td width='185px'>" . $dari . " s/d " . $sampai . "</td>";
			$table .= "<td>" . $row->KETERANGAN . "</td>";
			$table .= "<td>" . $row->KOTA . "</td>";
			$table .= "<td>";
			if ($accUpd == 'Y') {
				$table .= "<button type='button' class='btn btn-outline btn-xs btn-success' title='Edit' onClick='getForm(\"organisasi\",\"update\",\"" . $row->NRK . "\",\"" . $row->DARI . "\");'><i class='fa fa-pencil-square'></i></button> &nbsp;";
			}
			if ($accDel == 'Y') {
				$table .= "<button type='button' class='btn btn-outline btn-xs btn-danger' title='Hapus' onClick='confirmHapusData(\"organisasi\",\"" . $row->NRK . "\",\"" . $row->DARI . "\");'><i class='fa fa-trash'></i></button>";
			}
			$table .= "</td>";
			$table .= "</tr>";

			$i++;
		}
		$table .= "</tbody>";
		$table .= "</table>";
		$table .= "</div>";
		$table .= "</div>"; //END IBOX CONTENT
		$table .= "</div>"; //END IBOX
		$table .= "<script src=\"" . base_url() . "assets/inspinia/js/inspinia.js\"></script>"; //END IBOX

		return $table;
	}

	public function getRiwayatHubunganKeluarga($nrk, $ug, $id) {
		$access['mnac'] = $this->getMenuAccessBy($ug, 319);
		$accIns = $access['mnac']->act_insert;
		$accUpd = $access['mnac']->act_update;
		$accDel = $access['mnac']->act_delete;
		// $accDelFlag=$access['mnac']->act_delete_flag;

		$sql = "SELECT
                  a.NRK, a.HUBKEL, b.NAHUBKEL, a.NAMA, a.TEMHIR, to_char(a.TALHIR, 'YYYY-MM-DD') TALHIR,
                  a.TGNIKAH AS TGNIKAH1, to_char(a.TGNIKAH, 'YYYY-MM-DD') TGNIKAH, to_char(a.TGAKTECERAI, 'DD-MM-YYYY')TGAKTECERAI, to_char(a.TGSURATCERAI, 'DD-MM-YYYY')TGSURATCERAI, a.TEMNIKAH, c.KETERANGAN TUNJANGAN, d.KETERANGAN KERJAAN,
                  a.JENKEL, to_char(a.MATI, 'DD-MM-YYYY') MATI, a.UANGDUKA,e.KET_STATUS,
                  to_char(a.TG_UPD, 'DD-MM-YYYY HH24:MI:SS') TG_UPD, a.USER_ID
                FROM PERS_KELUARGA a
                LEFT JOIN PERS_HUBKEL_TBL b ON a.HUBKEL = b.HUBKEL
                LEFT JOIN PERS_STATTUN_RPT c ON a.STATTUN = c.STATTUN
                LEFT JOIN PERS_KDKERJA_RPT d ON a.KDKERJA = d.KDKERJA
                LEFT JOIN PERS_STATUS_APPROVAL e ON a.STAT_APP = e.KD_STATUS
                WHERE a.NRK = '" . $nrk . "'

                ORDER BY a.HUBKEL ASC
                ";
		// AND a.DELETED IS NULL

		$query = $this->ci->db->query($sql);

		$i = 1;

		$table = "<div class='ibox float-e-margins animated fadeInDown'>"; //START IBOX
		$table .= "<div class='ibox-title navy-bg'>
                        <h5>Riwayat Hubungan Keluarga</h5>
                        <div class=\"ibox-tools\">
                            <a class=\"collapse-link\">
                                <i class=\"fa fa-chevron-up\"></i>
                            </a>
                            <a class=\"close-link\">
                                <i class=\"fa fa-times\"></i>
                            </a>
                        </div>
        </div>"; //IBOX TITLE
		$table .= "<div class='ibox-content'>"; //START IBOX CONTENT
		$table .= "<div id='_content_riwayat_" . $id . "' class='animated fadeInUp'>";
		if ($accIns == 'Y') {
			$table .= "<div class='pull-right'><button type='button' class='btn btn-primary btn-sm btn-block m-t' onClick='getForm(\"keluarga\",\"tambah\");'><i class='fa fa-plus'></i> Tambah Data</button></div>";
		}
		$table .= "<table class='table table-hover table-striped table-bordered dataTables-example' width='99%'>";
		$table .= "<thead>";
		$table .= " <tr>
                        <th>No</th>
                        <th>Hubungan</th>
                        <th>Nama</th>
                        <th>TTL</th>
                        <th>Jenis Kelamin</th>
                        <th>Tunjangan</th>
                        <th>Pekerjaan</th>
                        <th>Tempat Nikah <br/><strong><small class='text-navy'>(Tgl. Nikah)</small></strong></th>
                        <th>Status Nikah</th>
                        <th>Meninggal Dunia</th>
                    </tr>";
		// <th>Meninggal Dunia ?<br><small>(Uang Duka)</small></th><th>Status Approval</th>
		$table .= "</thead>";
		$table .= "<tbody>";
		foreach ($query->result() as $row) {
			$stnikah = "";
			$tg = "";
			if ($row->TGNIKAH1 != "" && $row->TGAKTECERAI == "") {
				$stnikah = "MENIKAH";

			} else if ($row->TGNIKAH1 != "" && $row->TGAKTECERAI != "") {
				$stnikah = "CERAI";
				$tg = $row->TGAKTECERAI;
			} else if ($row->TGNIKAH1 == "" && $row->TGAKTECERAI == "") {
				$stnikah = "BELUM MENIKAH";

			}
			$table .= "<tr>";
			$table .= "<td width='5px'>" . $i . "</td>";
			$table .= "<td>" . $row->NAHUBKEL . "</td>";
			$table .= "<td>" . $row->NAMA . "</td>";
			$tgllahir = date('d M Y', strtotime($row->TALHIR));
			$table .= "<td>" . $row->TEMHIR . ", " . $tgllahir . "</td>";
			$table .= "<td>" . ($row->JENKEL == 'P' ? 'Perempuan' : 'Laki-laki') . "</td>";
			$table .= "<td>" . $row->TUNJANGAN . "</td>";
			$table .= "<td>" . $row->KERJAAN . "</td>";
			$tgnkh = date('d-m-Y', strtotime($row->TGNIKAH));

			if ($row->TGNIKAH == null && $row->TEMNIKAH == null) {
				$table .= "<td> - </td>";
			} else if ($row->TGNIKAH == null && $row->TEMNIKAH != null) {
				$table .= "<td>" . $row->TEMNIKAH . "<br/><strong><small class='text-navy'>(-)</small></strong></td>";
			} else {
				$table .= "<td>" . $row->TEMNIKAH . "<br/><strong><small class='text-navy'>(" . $tgnkh . ")</small></strong></td>";
			}

			$table .= "<td>" . $stnikah . "";
			if ($stnikah == "CERAI") {
				$table .= "<br/><strong><small class='text-navy'>(" . $tg . ")</small></strong></td>";
			} else {
				$table .= "</td>";
			}

			$table .= "<td>" . $row->MATI . "</td>";
			// $table .= "<td><span class='text-danger'>".$row->MATI."</span> <small>(".$row->UANGDUKA.")</small></td>";
			// $table .= "<td>".$row->KET_STATUS."</td>";
			/*$table .= "<td >";
	                if($accUpd == 'Y')
	                {
	                    $table.="<button type='button' class='btn btn-outline btn-xs btn-success' title='Edit' onClick='getForm(\"keluarga\",\"update\",\"".$row->NRK."\",\"".$row->HUBKEL."\");'><i class='fa fa-pencil-square'></i></button> &nbsp;";
	                }
	                if($accDel == 'Y')
	                {
	                    $table.="<button type='button' class='btn btn-outline btn-xs btn-danger' title='Hapus' onClick='confirmHapusData(\"keluarga\",\"".$row->NRK."\",\"".$row->HUBKEL."\");'><i class='fa fa-trash'></i></button>";
	                }
*/
			$table .= "</tr>";

			$i++;
		}
		$table .= "</tbody>";
		$table .= "</table>";
		$table .= "</div>";
		$table .= "</div>"; //END IBOX CONTENT
		$table .= "</div>"; //END IBOX
		$table .= "<script src=\"" . base_url() . "assets/inspinia/js/inspinia.js\"></script>"; //END IBOX

		return $table;
	}

	public function getRiwayatHubunganKeluarga2($nrk, $ug, $id, $session_data) {
		$access['mnac'] = $this->getMenuAccessBy($ug, 319);
		$accIns = $access['mnac']->act_insert;
		$accUpd = $access['mnac']->act_update;
		$accDel = $access['mnac']->act_delete;

		// $accDelFlag=$access['mnac']->act_delete_flag;

		$peg1 = $this->getPegawai1($nrk);

		$kolokP1 = $peg1->KOLOK;
		$kdKolokP1 = substr($kolokP1, 0, 1);

		$sql = "SELECT
                  a.NRK, a.HUBKEL, b.NAHUBKEL, a.NAMA, a.TEMHIR, to_char(a.TALHIR, 'YYYY-MM-DD') TALHIR,
                  a.TGNIKAH AS TGNIKAH1, to_char(a.TGNIKAH, 'YYYY-MM-DD') TGNIKAH, to_char(a.TGAKTECERAI, 'DD-MM-YYYY')TGAKTECERAI, to_char(a.TGSURATCERAI, 'DD-MM-YYYY')TGSURATCERAI, a.TEMNIKAH, c.KETERANGAN TUNJANGAN, d.KETERANGAN KERJAAN,
                  a.JENKEL, to_char(a.MATI, 'DD-MM-YYYY') MATI, a.UANGDUKA,e.KET_STATUS,
                  to_char(a.TG_UPD, 'DD-MM-YYYY HH24:MI:SS') TG_UPD, a.USER_ID
                FROM PERS_KELUARGA a
                LEFT JOIN PERS_HUBKEL_TBL b ON a.HUBKEL = b.HUBKEL
                LEFT JOIN PERS_STATTUN_RPT c ON a.STATTUN = c.STATTUN
                LEFT JOIN PERS_KDKERJA_RPT d ON a.KDKERJA = d.KDKERJA
                LEFT JOIN PERS_STATUS_APPROVAL e ON a.STAT_APP = e.KD_STATUS
                WHERE a.NRK = '" . $nrk . "'

                ORDER BY a.HUBKEL ASC
                ";
		// AND a.DELETED IS NULL

		$query = $this->ci->db->query($sql);

		$i = 1;

		$table = "<div class='ibox float-e-margins animated fadeInDown'>"; //START IBOX
		$table .= "<div class='ibox-title navy-bg'>
                        <h5>Riwayat Hubungan Keluarga</h5>
                        <div class=\"ibox-tools\">
                            <a class=\"collapse-link\">
                                <i class=\"fa fa-chevron-up\"></i>
                            </a>
                            <a class=\"close-link\">
                                <i class=\"fa fa-times\"></i>
                            </a>
                        </div>
        </div>"; //IBOX TITLE
		$table .= "<div class='ibox-content'>"; //START IBOX CONTENT
		$table .= "<div id='_content_riwayat_" . $id . "' class='animated fadeInUp'>";
		if ($accIns == 'Y') {
			if ($session_data['user_group'] == '10') {

				if ($session_data['kowil'] == $kdKolokP1 || (($session_data['kowil'] == 11) && (substr($kolokP1, 0, 2) == 11))) {
					if (substr($kolokP1, 1, 1) == 1 && $session_data['kowil'] == 1) {

					} else {
						$table .= "<div class='pull-right'><button type='button' class='btn btn-primary btn-sm btn-block m-t' onClick='getForm(\"keluarga_2\",\"tambah\");'><i class='fa fa-plus'></i> Tambah Data</button></div>";
					}

				} else {

				}
			} else if ($session_data['user_group'] == '2') {
				$table .= "<div class='pull-right'><button type='button' class='btn btn-primary btn-sm btn-block m-t' onClick='getForm(\"keluarga_2\",\"tambah\");'><i class='fa fa-plus'></i> Tambah Data</button></div>";
			} else {

			}

		}
		$table .= "<table class='table table-striped table-bordered table-hover dataTables-example' width='99%'>";
		$table .= "<thead>";
		/*$table .= " <tr>
			                        <th>No</th>
			                        <th>Hubungan</th>
			                        <th>Nama</th>
			                        <th>TTL</th>
			                        <th>Jenis Kelamin</th>
			                        <th>Tunjangan</th>
			                        <th>Pekerjaan</th>
			                        <th>Tempat Nikah <br/><strong><small class='text-navy'>(Tgl. Nikah)</small></strong></th>
			                        <th>Status Nikah</th>
			                        <th>Meninggal Dunia</th>
			                        <th>Status</th>
			                        <th>User ID <br/><strong><small class='text-navy'>(Tgl. Update)</small></strong></th>
			                        <th>Aksi</th>
		*/
		$table .= " <tr>
                        <th>No</th>
                        <th>Hubungan</th>
                        <th>Nama</th>
                        <th>TTL</th>
                        <th>Jenis Kelamin</th>
                        <th>Tunjangan</th>
                        <th>Pekerjaan</th>
                        <th>Tempat Nikah <br/><strong><small class='text-navy'>(Tgl. Nikah)</small></strong></th>
                        <th>Status Nikah</th>
                        <th>Meninggal Dunia</th>
                        <th>User ID <br/><strong><small class='text-navy'>(Tgl. Update)</small></strong></th>
                        <th>Aksi</th>
                    </tr>";
		$table .= "</thead>";
		$table .= "<tbody>";
		foreach ($query->result() as $row) {
			$stnikah = "";
			$tg = "";
			if ($row->TGNIKAH1 != "" && $row->TGAKTECERAI == "") {
				$stnikah = "MENIKAH";

			} else if ($row->TGNIKAH1 != "" && $row->TGAKTECERAI != "") {
				$stnikah = "CERAI";
				$tg = $row->TGAKTECERAI;
			} else if ($row->TGNIKAH1 == "" && $row->TGAKTECERAI == "") {
				$stnikah = "BELUM MENIKAH";

			}

			/* if ($row->MATI == ''){
				                $MATI = "-";
				            } else {
				                $MATI = "<span class='text-danger'>".$row->MATI."</span> <small>(".$row->UANGDUKA.")</small>";
			*/
			$table .= "<tr>";
			$table .= "<td width='5px'>" . $i . "</td>";
			$table .= "<td>" . $row->NAHUBKEL . "<br/><strong><small class='text-success'>(" . $row->HUBKEL . ")</small></strong></td>";
			$table .= "<td>" . $row->NAMA . "</td>";
			$tgllahir = date('d-m-Y', strtotime($row->TALHIR));
			$table .= "<td width='155px'>" . $row->TEMHIR . ", " . $tgllahir . "</td>";
			$table .= "<td>" . ($row->JENKEL == 'P' ? 'Perempuan' : 'Laki-laki') . "</td>";
			$table .= "<td>" . $row->TUNJANGAN . "</td>";
			$table .= "<td>" . $row->KERJAAN . "</td>";
			$tgnkh = date('d-m-Y', strtotime($row->TGNIKAH));

			if ($row->TGNIKAH == null && $row->TEMNIKAH == null) {
				$table .= "<td> - </td>";
			} else if ($row->TGNIKAH == null && $row->TEMNIKAH != null) {
				$table .= "<td>" . $row->TEMNIKAH . "<br/><strong><small class='text-navy'>(-)</small></strong></td>";
			} else {
				$table .= "<td>" . $row->TEMNIKAH . "<br/><strong><small class='text-navy'>(" . $tgnkh . ")</small></strong></td>";
			}

			$table .= "<td>" . $stnikah . "";
			if ($stnikah == "CERAI") {
				$table .= "<br/><strong><small class='text-navy'>(" . $tg . ")</small></strong></td>";
			} else {
				$table .= "</td>";
			}

			$table .= "<td>" . $row->MATI . "</td>";
			//$table .= "<td>".$row->KET_STATUS."</td>";
			$table .= "<td>" . $row->USER_ID . "<br><strong><small class='text-navy'>(" . $row->TG_UPD . ")</small></strong></td>";
			$table .= "<td>";

			if ($session_data['user_group'] == '2' || $session_data['user_group'] == '3' || $session_data['user_group'] == '11') {
				if ($accUpd == 'Y') {
					$table .= "<button type='button' class='btn btn-outline btn-xs btn-success' title='Edit' onClick='getForm(\"keluarga_2\",\"update\",\"" . $row->NRK . "\",\"" . $row->HUBKEL . "\");'><i class='fa fa-pencil-square'></i></button> &nbsp;";
				}
				// if($accDelFlag == 'Y')
				// {
				//     $table.="<button type='button' class='btn btn-outline btn-xs btn-danger' title='Hapus' onClick='confirmHapusDataFlag(\"keluarga\",\"".$row->NRK."\",\"".$row->HUBKEL."\");'><i class='fa fa-trash'></i></button> &nbsp;";
				// }
				if ($accDel == 'Y') {
					$table .= "<button type='button' class='btn btn-outline btn-xs btn-danger' title='Hapus ' onClick='confirmHapusData(\"keluarga\",\"" . $row->NRK . "\",\"" . $row->HUBKEL . "\");'><i class='fa fa-trash'></i></button>";
				}
			} else if ($session_data['user_group'] == '10') {

				if (substr($peg1->KOLOK, 0, 1) == $session_data['kowil']) {
					if (substr($peg1->KOLOK, 1, 1) == 1 && $session_data['kowil'] == 1) {

					} else {
						if ($accUpd == 'Y') {
							$table .= "<button type='button' class='btn btn-outline btn-xs btn-success' title='Edit' onClick='getForm(\"keluarga_2\",\"update\",\"" . $row->NRK . "\",\"" . $row->HUBKEL . "\");'><i class='fa fa-pencil-square'></i></button> &nbsp;";
						}
						// if($accDelFlag == 'Y')
						// {
						//     $table.="<button type='button' class='btn btn-outline btn-xs btn-danger' title='Hapus' onClick='confirmHapusDataFlag(\"keluarga\",\"".$row->NRK."\",\"".$row->HUBKEL."\");'><i class='fa fa-trash'></i></button> &nbsp;";
						// }
						if ($accDel == 'Y') {
							$table .= "<button type='button' class='btn btn-outline btn-xs btn-danger' title='Hapus ' onClick='confirmHapusData(\"keluarga\",\"" . $row->NRK . "\",\"" . $row->HUBKEL . "\");'><i class='fa fa-trash'></i></button>";
						}
					}
				} else if ((substr($peg1->KOLOK, 0, 2) == 11) && ($session_data['kowil'] == 11)) {
					if ($accUpd == 'Y') {
						$table .= "<button type='button' class='btn btn-outline btn-xs btn-success' title='Edit' onClick='getForm(\"keluarga_2\",\"update\",\"" . $row->NRK . "\",\"" . $row->HUBKEL . "\");'><i class='fa fa-pencil-square'></i></button> &nbsp;";
					}
					// if($accDelFlag == 'Y')
					// {
					//     $table.="<button type='button' class='btn btn-outline btn-xs btn-danger' title='Hapus' onClick='confirmHapusDataFlag(\"keluarga\",\"".$row->NRK."\",\"".$row->HUBKEL."\");'><i class='fa fa-trash'></i></button> &nbsp;";
					// }
					if ($accDel == 'Y') {
						$table .= "<button type='button' class='btn btn-outline btn-xs btn-danger' title='Hapus ' onClick='confirmHapusData(\"keluarga\",\"" . $row->NRK . "\",\"" . $row->HUBKEL . "\");'><i class='fa fa-trash'></i></button>";
					}
				}

			}

			$table .= "</td>";
			$table .= "</tr>";

			$i++;
		}
		$table .= "</tbody>";
		$table .= "</table>";
		$table .= "</div>";
		$table .= "</div>"; //END IBOX CONTENT
		$table .= "</div>"; //END IBOX
		$table .= "<script src=\"" . base_url() . "assets/inspinia/js/inspinia.js\"></script>"; //END IBOX

		return $table;
	}

	public function getRequestHubunganKeluarga($ug, $id) {
		$access['mnac'] = $this->getMenuAccessBy($ug, 319);

		$accUpd = $access['mnac']->act_update;
		// $accDelFlag=$access['mnac']->act_delete_flag;

		$sql = "SELECT a.NRK, a.HUBKEL, b.NAHUBKEL, a.NAMA, a.TEMHIR, to_char(a.TALHIR, 'YYYY-MM-DD') TALHIR, to_char(a.TGNIKAH, 'YYYY-MM-DD') TGNIKAH, a.TEMNIKAH, c.KETERANGAN TUNJANGAN, d.KETERANGAN KERJAAN, a.JENKEL, to_char(a.MATI, 'YYYY-MM-DD') MATI, a.UANGDUKA,a.STAT_APP,e.KET_STATUS
                FROM PERS_KELUARGA a
                LEFT JOIN PERS_HUBKEL_TBL b ON a.HUBKEL = b.HUBKEL
                LEFT JOIN PERS_STATTUN_RPT c ON a.STATTUN = c.STATTUN
                LEFT JOIN PERS_KDKERJA_RPT d ON a.KDKERJA = d.KDKERJA
                LEFT JOIN PERS_STATUS_APPROVAL e ON a.STAT_APP = e.KD_STATUS
                WHERE a.STAT_APP = 2

                ORDER BY a.TG_UPD DESC
                ";
		// AND a.DELETED IS NULL

		$query = $this->ci->db->query($sql);

		$i = 1;

		$table = "<div class='ibox float-e-margins animated fadeInDown'>"; //START IBOX
		$table .= "<div class='ibox-title navy-bg'>
                        <h5>Riwayat Hubungan Keluarga</h5>
                        <div class=\"ibox-tools\">
                            <a class=\"collapse-link\">
                                <i class=\"fa fa-chevron-up\"></i>
                            </a>
                            <a class=\"close-link\">
                                <i class=\"fa fa-times\"></i>
                            </a>
                        </div>
        </div>"; //IBOX TITLE
		$table .= "<div class='ibox-content'>"; //START IBOX CONTENT
		$table .= "<div id='_content_riwayat_" . $id . "' class='animated fadeInUp'>";

		$table .= "<table class='table table-striped table-bordered table-hover dataTables-example' width='99%'>";
		$table .= "<thead>";
		$table .= " <tr>
                        <th>No</th><th>NRK</th><th>Hubungan</th><th>Nama</th><th>TTL</th><th>Jenis Kelamin</th><th>Tunjangan</th><th>Pekerjaan</th><th>Tempat Nikah</th><th>Meninggal Dunia ?<br><small>(Uang Duka)</small></th><th>Status</th><th>Aksi</th>
                    </tr>";
		$table .= "</thead>";
		$table .= "<tbody>";
		foreach ($query->result() as $row) {
			$table .= "<tr>";
			$table .= "<td width='5px'>" . $i . "</td>";
			$table .= "<td>" . $row->NRK . "</td>";
			$table .= "<td>" . $row->NAHUBKEL . "</td>";
			$table .= "<td>" . $row->NAMA . "</td>";
			$tgllahir = date('d M Y', strtotime($row->TALHIR));
			$table .= "<td width='155px'>" . $row->TEMHIR . ", " . $tgllahir . "</td>";
			$table .= "<td>" . ($row->JENKEL == 'P' ? 'Perempuan' : 'Laki-laki') . "</td>";
			$table .= "<td>" . $row->TUNJANGAN . "</td>";
			$table .= "<td>" . $row->KERJAAN . "</td>";

			$table .= "<td>" . $row->TEMNIKAH . "</td>";
			$table .= "<td><span class='text-danger'>" . $row->MATI . "</span> <small>(" . $row->UANGDUKA . ")</small></td>";
			$table .= "<td>" . $row->KET_STATUS . "</td>";
			$table .= "<td >";
			if ($accUpd == 'Y') {
				$table .= "<button type='button' class='btn btn-outline btn-xs btn-success' title='Edit' onClick='getForm(\"keluarga_2\",\"" . $row->NRK . "\",\"update\",\"" . $row->NRK . "\",\"" . $row->HUBKEL . "\");'><i class='fa fa-pencil-square'></i></button> &nbsp;";
			}

			$table .= "</td>";
			$table .= "</tr>";

			$i++;
		}
		$table .= "</tbody>";
		$table .= "</table>";
		$table .= "</div>";
		$table .= "</div>"; //END IBOX CONTENT
		$table .= "</div>"; //END IBOX
		$table .= "<script src=\"" . base_url() . "assets/inspinia/js/inspinia.js\"></script>"; //END IBOX

		return $table;
	}

	public function getRiwayatLp2p($nrk, $ug, $id) {
		$access['mnac'] = $this->getMenuAccessBy($ug, 775);
		$accIns = $access['mnac']->act_insert;
		$accUpd = $access['mnac']->act_update;
		$accDel = $access['mnac']->act_delete;
		// $accDelFlag=$access['mnac']->act_delete_flag;

		$sql = "   SELECT THPAJAK, NRK, NIP, NIP18, NAMA, KOLOK, NALOK, GOL, RUANG, TMTPANGKAT, NAJAB, TMTESELON, TALHIR, PATHIR, ALAMAT,RTALAMAT,RWALAMAT,
                        KELURAHAN, KECAMATAN, JENKEL, STAWIN, NAMISU, PEKERJAAN, JUAN,JIWA, KDWEWENANG, NOFORM, KODE2,KOJAB, KOJABF, KD, ESELON, SPMU, KLOGAD,
                        KODUK, THLAPOR,PEJABAT
                    FROM PERS_LP2P_HIST
                    WHERE NRK = '" . $nrk . "'

                    ORDER BY THPAJAK DESC
                 ";
		// AND DELETED IS NULL

		$query = $this->ci->db->query($sql);

		$i = 1;

		$table = "<div class='ibox float-e-margins animated fadeInDown'>"; //START IBOX
		$table .= "<div class='ibox-title navy-bg'>
                        <h5>Riwayat LP2P</h5>
                        <div class=\"ibox-tools\">
                            <a class=\"collapse-link\">
                                <i class=\"fa fa-chevron-up\"></i>
                            </a>
                            <a class=\"close-link\">
                                <i class=\"fa fa-times\"></i>
                            </a>
                        </div>
        </div>"; //IBOX TITLE
		$table .= "<div class='ibox-content'>"; //START IBOX CONTENT
		$table .= "<div id='_content_riwayat_" . $id . "' class='animated fadeInUp'>";
		if ($accIns == 'Y') {
			$table .= "<div class='pull-right'><button type='button' class='btn btn-primary btn-sm btn-block m-t' onClick='getForm(\"lp2p\",\"tambah\");'><i class='fa fa-plus'></i> Tambah Data</button></div>";
		}
		$table .= "<table class='table table-striped table-bordered table-hover dataTables-example' width='99%'>";
		$table .= "<thead>";
		$table .= " <tr>
                         <th>No</th><th>NRK</th><th>NAMA</th><th>THPAJAK</th><th>ESELON</th><th>Aksi</th>
                     </tr>";
		$table .= "</thead>";
		$table .= "<tbody>";
		foreach ($query->result() as $row) {
			$table .= "<tr>";
			$table .= "<td width='5px'>" . $i . "</td>";
			$table .= "<td>" . $row->NRK . "</td>";
			$table .= "<td>" . $row->NAMA . "</td>";
			$table .= "<td>" . $row->THPAJAK . "</td>";
			$table .= "<td>" . $row->ESELON . "</td>";
			$table .= "<td >";
			if ($accUpd == 'Y') {
				$table .= "<button type='button' class='btn btn-outline btn-xs btn-success' title='Edit' onClick='getForm(\"lp2p\",\"update\",\"" . $row->THPAJAK . "\",\"" . $row->NRK . "\");'><i class='fa fa-pencil-square'></i></button> &nbsp";
			}
			// if($accDelFlag == 'Y')
			// {
			//       $table.="<button type='button' class='btn btn-outline btn-xs btn-danger' title='Hapus' onClick='confirmHapusDataFlag(\"lp2p\",\"".$row->THPAJAK."\",\"".$row->NRK."\");'><i class='fa fa-trash'></i></button>";
			// }
			if ($accDel == 'Y') {
				$table .= "<button type='button' class='btn btn-outline btn-xs btn-danger' title='Hapus ' onClick='confirmHapusData(\"lp2p\",\"" . $row->THPAJAK . "\",\"" . $row->NRK . "\");'><i class='fa fa-trash'></i></button>";
			}
			$table .= "</td>";
			$table .= "</tr>";

			$i++;
		}
		$table .= "</tbody>";
		$table .= "</table>";
		$table .= "</div>";
		$table .= "</div>"; //END IBOX CONTENT
		$table .= "</div>"; //END IBOX
		$table .= "<script src=\"" . base_url() . "assets/inspinia/js/inspinia.js\"></script>"; //END IBOX

		return $table;
	}

	public function getRiwayatLitsus($nrk, $ug, $id) {
		$access['mnac'] = $this->getMenuAccessBy($ug, 776);
		$accIns = $access['mnac']->act_insert;
		// $accDelFlag=$access['mnac']->act_delete_flag;

		$sql = "SELECT NRK, TGL, DASAR, KEPERLUAN, HASIL, PEMERIKSA_AWAL, PEMERIKSA_ULANG, KOPANG_PEMERIKSA, NOKTP, NOMOR_CT, NOMOR_SKHP, KOTA_LITSUS
                 FROM PERS_LITSUS a

                 WHERE NRK = '" . $nrk . "'

                 ORDER BY TGL DESC
                 ";
		// AND a.DELETED IS NULL

		$query = $this->ci->db->query($sql);

		$i = 1;

		$table = "<div class='ibox float-e-margins animated fadeInDown'>"; //START IBOX
		$table .= "<div class='ibox-title navy-bg'>
                        <h5>Riwayat Litsus</h5>
                        <div class=\"ibox-tools\">
                            <a class=\"collapse-link\">
                                <i class=\"fa fa-chevron-up\"></i>
                            </a>
                            <a class=\"close-link\">
                                <i class=\"fa fa-times\"></i>
                            </a>
                        </div>
        </div>"; //IBOX TITLE
		$table .= "<div class='ibox-content'>"; //START IBOX CONTENT
		$table .= "<div id='_content_riwayat_" . $id . "' class='animated fadeInUp'>";
		if ($accIns = "Y") {
			$table .= "<div class='pull-right'><button type='button' class='btn btn-primary btn-sm btn-block m-t' onClick='getForm(\"litsus\",\"tambah\");'><i class='fa fa-plus'></i> Tambah Data</button></div>";
		}
		$table .= "<table class='table table-striped table-bordered table-hover dataTables-example' width='99%'>";
		$table .= "<thead>";
		$table .= " <tr>
                         <th>No</th><th>NRK</th><th>Tgl</th><th>Dasar</th><th>Keperluan</th>
                     </tr>";
		$table .= "</thead>";
		$table .= "<tbody>";
		foreach ($query->result() as $row) {
			$table .= "<tr>";
			$table .= "<td width='5px'>" . $i . "</td>";
			$table .= "<td>" . $row->NRK . "</td>";
			$tgl = date('d M Y', strtotime($row->TGL));
			$table .= "<td>" . $tgl . "</td>";
			$table .= "<td>" . $row->DASAR . "</td>";
			$table .= "<td>" . $row->KEPERLUAN . "</td>";

			$table .= "</tr>";

			$i++;
		}
		$table .= "</tbody>";
		$table .= "</table>";
		$table .= "</div>";
		$table .= "</div>"; //END IBOX CONTENT
		$table .= "</div>"; //END IBOX
		$table .= "<script src=\"" . base_url() . "assets/inspinia/js/inspinia.js\"></script>"; //END IBOX

		return $table;
	}

	public function getRiwayatTpa($nrk, $ug, $id) {
		$access['mnac'] = $this->getMenuAccessBy($ug, 777);
		$accIns = $access['mnac']->act_insert;
		// $accDelFlag=$access['mnac']->act_delete_flag;

		$sql = "SELECT a.NOSERTA, to_char(a.TGL_TESTTPA, 'YYYY-MM-DD') TGL_TESTTPA, a.NILAI_VERBAL, a.NILAI_NUMERIC, a.NILAI_LOGIC, a.TOTAL_TPA
                FROM PERS_TPA_ASSES a
                WHERE a.NRK = '" . $nrk . "'

                ORDER BY a.TGL_TESTTPA DESC
                ";
		// AND a.DELETED IS NULL

		$query = $this->ci->db->query($sql);

		$i = 1;

		$table = "<div class='ibox float-e-margins animated fadeInDown'>"; //START IBOX
		$table .= "<div class='ibox-title navy-bg'>
                        <h5>Riwayat TPA</h5>
                        <div class=\"ibox-tools\">
                            <a class=\"collapse-link\">
                                <i class=\"fa fa-chevron-up\"></i>
                            </a>
                            <a class=\"close-link\">
                                <i class=\"fa fa-times\"></i>
                            </a>
                        </div>
        </div>"; //IBOX TITLE
		$table .= "<div class='ibox-content'>"; //START IBOX CONTENT
		$table .= "<div id='_content_riwayat_" . $id . "' class='animated fadeInUp'>";
		if ($accIns == 'Y') {
			$table .= "<div class='pull-right'><button type='button' class='btn btn-primary btn-sm btn-block m-t' onClick='getForm(\"tpa\",\"tambah\");'><i class='fa fa-plus'></i> Tambah Data</button></div>";
		}
		$table .= "<table class='table table-striped table-bordered table-hover dataTables-example' width='99%'>";
		$table .= "<thead>";
		$table .= " <tr>
                        <th>No</th><th>No. Peserta</th><th>Tgl. Test</th><th>Nilai Verbal</th><th>Nilai Numeric</th><th>Nilai Logic</th><th>Total TPA</th>
                    </tr>";
		$table .= "</thead>";
		$table .= "<tbody>";
		foreach ($query->result() as $row) {
			$table .= "<tr>";
			$table .= "<td width='5px'>" . $i . "</td>";
			$table .= "<td>" . $row->NOSERTA . "</td>";
			$tg_test = date('d M Y', strtotime($row->TGL_TESTTPA));
			$table .= "<td width='85px'>" . $tg_test . "</td>";
			$table .= "<td align='right'>" . $row->NILAI_VERBAL . "</td>";
			$table .= "<td align='right'>" . $row->NILAI_NUMERIC . "</td>";
			$table .= "<td align='right'>" . $row->NILAI_LOGIC . "</td>";
			$table .= "<td align='right'>" . $row->TOTAL_TPA . "</td>";

			$table .= "</tr>";

			$i++;
		}
		$table .= "</tbody>";
		$table .= "</table>";
		$table .= "</div>";
		$table .= "</div>"; //END IBOX CONTENT
		$table .= "</div>"; //END IBOX
		$table .= "<script src=\"" . base_url() . "assets/inspinia/js/inspinia.js\"></script>"; //END IBOX

		return $table;
	}

	public function getRiwayatTp($nrk, $ug, $id) {
		$access['mnac'] = $this->getMenuAccessBy($ug, 780);
		$accIns = $access['mnac']->act_insert;
		// $accDelFlag=$access['mnac']->act_delete_flag;

		$sql = "SELECT NRK, NOSERTA,INTEL,NH_INTEL,KONSEP,NH_KONSEP,ALPERMAS,NH_ALPERMAS,MKOMPLEK,NH_MKOMPLEK,KPRAKTIS,NH_KPRAKTIS,WAWASAN,NH_WAWASAN
                 TOTAL_CERDAS, MOTPRES, NH_MOTPRES, EFISIEN, NH_EFISIEN, INTEGRIT, NH_INTEGRIT, STRESS, NH_STRESS, PROAKTIV_TP, NH_PROAKTIV_TP, KRJSAMA,
                 NH_KRJSAMA,TOTAL_SIKAPKER,DALDIRI, NH_DALDIRI, PSOSIAL, NH_PSOSIAL, KOMUNIKA, NH_KOMUNIKA, PERCAYA, NH_PERCAYA, TOTAL_PRIBADI, PIMPIN_TP,
                 NH_PIMPIN_TP, PRENCANA, NH_PRENCANA, KPUTUSAN, NH_KPUTUSAN, WASKAT, NH_WASKAT, MANDIRI, NH_MANDIRI, NEGOSIA, NH_NEGOSIA, TOTAL_MANAJER,
                 TOTAL_TP, TGL_TESTTP, KATAGORI, RUMPUN, IQ, SARAN1, SARAN2, SARAN3, SARAN4, SARAN5, KEADAAN
                 FROM PERS_TP_ASSES
                 WHERE NRK = '" . $nrk . "'
                 ";
		// AND DELETED IS NULL

		$query = $this->ci->db->query($sql);

		$i = 1;

		$table = "<div class='ibox float-e-margins animated fadeInDown'>"; //START IBOX
		$table .= "<div class='ibox-title navy-bg'>
                        <h5>Riwayat TP</h5>
                        <div class=\"ibox-tools\">
                            <a class=\"collapse-link\">
                                <i class=\"fa fa-chevron-up\"></i>
                            </a>
                            <a class=\"close-link\">
                                <i class=\"fa fa-times\"></i>
                            </a>
                        </div>
        </div>"; //IBOX TITLE
		$table .= "<div class='ibox-content'>"; //START IBOX CONTENT
		$table .= "<div id='_content_riwayat_" . $id . "' class='animated fadeInUp'>";
		if ($accIns == 'Y') {
			$table .= "<div class='pull-right'><button type='button' class='btn btn-primary btn-sm btn-block m-t' onClick='getForm(\"tp\",\"tambah\");'><i class='fa fa-plus'></i> Tambah Data</button></div>";
		}
		$table .= "<table class='table table-striped table-bordered table-hover dataTables-example' width='99%'>";
		$table .= "<thead>";
		$table .= " <tr>
                         <th>No</th><th>No Serta</th><th>Total Cerdas</th><th>Total Sikapker</th><th>Total Pribadi</th><th>Total Manajer</th><th>Total TP</th><th>Tgl Testtp</th>
                     </tr>";
		$table .= "</thead>";
		$table .= "<tbody>";
		foreach ($query->result() as $row) {
			$table .= "<tr>";
			$table .= "<td width='5px'>" . $i . "</td>";
			$table .= "<td>" . $row->NOSERTA . "</td>";
			$table .= "<td>" . $row->TOTAL_CERDAS . "</td>";
			$table .= "<td>" . $row->TOTAL_SIKAPKER . "</td>";
			$table .= "<td>" . $row->TOTAL_PRIBADI . "</td>";
			$table .= "<td>" . $row->TOTAL_MANAJER . "</td>";
			$table .= "<td>" . $row->TOTAL_TP . "</td>";
			$tgl_testtp = date('d M Y', strtotime($row->TGL_TESTTP));
			$table .= "<td width='85px'>" . $tgl_testtp . "</td>";
			$table .= "</tr>";

			$i++;
		}
		$table .= "</tbody>";
		$table .= "</table>";
		$table .= "</div>";
		$table .= "</div>"; //END IBOX CONTENT
		$table .= "</div>"; //END IBOX
		$table .= "<script src=\"" . base_url() . "assets/inspinia/js/inspinia.js\"></script>"; //END IBOX

		return $table;
	}

	public function getRiwayatMakalah($nrk, $ug, $id) {
		$access['mnac'] = $this->getMenuAccessBy($ug, 781);
		$accIns = $access['mnac']->act_insert;
		// $accDelFlag=$access['mnac']->act_delete_flag;

		$sql = "SELECT * FROM PERS_MKL_ASSES
                 WHERE NRK = '" . $nrk . "'
                 ";
		// AND DELETED IS NULL

		$query = $this->ci->db->query($sql);

		$i = 1;

		$table = "<div class='ibox float-e-margins animated fadeInDown'>"; //START IBOX
		$table .= "<div class='ibox-title navy-bg'>
                        <h5>Riwayat Makalah</h5>
                        <div class=\"ibox-tools\">
                            <a class=\"collapse-link\">
                                <i class=\"fa fa-chevron-up\"></i>
                            </a>
                            <a class=\"close-link\">
                                <i class=\"fa fa-times\"></i>
                            </a>
                        </div>
        </div>"; //IBOX TITLE
		$table .= "<div class='ibox-content'>"; //START IBOX CONTENT
		$table .= "<div id='_content_riwayat_" . $id . "' class='animated fadeInUp'>";
		if ($accIns == 'Y') {
			$table .= "<div class='pull-right'><button type='button' class='btn btn-primary btn-sm btn-block m-t' onClick='getForm(\"makalah\",\"tambah\");'><i class='fa fa-plus'></i> Tambah Data</button></div>";
		}
		$table .= "<table class='table table-striped table-bordered table-hover dataTables-example' width='99%'>";
		$table .= "<thead>";
		$table .= " <tr>
                         <th>No</th><th>Nomor Serta</th><th>Total Topik</th><th>Total Wawasan</th><th>Total Teknik</th><th>Total Tulis</th><th>Total Seluruh</th>
                     </tr>";
		$table .= "</thead>";
		$table .= "<tbody>";
		foreach ($query->result() as $row) {
			$table .= "<tr>";
			$table .= "<td width='5px'>" . $i . "</td>";
			$table .= "<td>" . $row->NOSERTA . "</td>";
			$table .= "<td>" . $row->TOTAL_TOPIK . "</td>";
			$table .= "<td>" . $row->TOTAL_WAWASAN . "</td>";
			$table .= "<td>" . $row->TOTAL_TEKNIK . "</td>";
			$table .= "<td>" . $row->TOTAL_TULIS . "</td>";
			$table .= "<td>" . $row->TOTAL_SELURUH . "</td>";
			$table .= "</tr>";

			$i++;
		}
		$table .= "</tbody>";
		$table .= "</table>";
		$table .= "</div>";
		$table .= "</div>"; //END IBOX CONTENT
		$table .= "</div>"; //END IBOX
		$table .= "<script src=\"" . base_url() . "assets/inspinia/js/inspinia.js\"></script>"; //END IBOX

		return $table;
	}

	public function getRiwayatTestGabungan($nrk) {
		// $sql = "SELECT a.KDHARGA, b.NAHARGA, to_char(a.TGSK, 'YYYY-MM-DD') TGSK, a.NOSK, a.ASAL_HRG
		//         FROM PERS_PENGHARGAAN a
		//         LEFT JOIN PERS_HARGAAN_TBL b ON a.KDHARGA = b.KDHARGA
		//         WHERE a.NRK = '".$nrk."' ORDER BY a.TGSK DESC
		//         ";

		// $query = $this->ci->db->query($sql);

		$i = 1;

		$table = "<div id='_content_riwayat' class='animated fadeInUp'>Belum Ada Konten.";
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

	public function getMasterSPM() {
		$sql = "SELECT NAMA, KODE_SPM FROM PERS_TABEL_SPMU WHERE TAHUN = '2015' ORDER BY KDSORT ASC
                ";

		$query = $this->ci->db->query($sql);

		$option = "";

		foreach ($query->result() as $row) {
			$option .= "<option value='" . $row->KODE_SPM . "'>" . $row->NAMA . "</option>";
		}

		return $option;
	}

	public function getMasterTahunRefGaji($tahun = "") {
		$sql = "SELECT DISTINCT TAHUN FROM PERS_GAPOK_TBL_HIST ORDER BY TAHUN DESC
                ";

		$query = $this->ci->db->query($sql);

		$option = "";

		foreach ($query->result() as $row) {
			if ($tahun == $row->TAHUN) {
				$option .= "<option selected value='" . $row->TAHUN . "'>" . $row->TAHUN . "</option>";
			} else {
				$option .= "<option value='" . $row->TAHUN . "'>" . $row->TAHUN . "</option>";
			}
		}

		return $option;
	}

	public function getMaxTahunRefGaji() {
		$sql = "SELECT MAX (TAHUN) TAHUN FROM PERS_GAPOK_TBL_HIST";

		$query = $this->ci->db->query($sql)->row();

		return $query;
	}

	public function getKolokAktifJoin($kolok = "") {
		/*$sql="SELECT KOLOK,NALOK AS NALOKL from (
			                select a.kolok,a.nalok from PERS_KLOGAD3_NEW a
			                    UNION
			                select b. kolok,b.nalokl from pers_lokasi_tbl b where b. KOLOK LIKE '11111111%' AND b.KOLOK <> '111111111' AND b.KOLOK <> '111111119'
		*/

		$sql = "SELECT KOLOK, NALOKL FROM PERS_LOKASI_TBL
                WHERE AKTIF = '1' AND
                KOLOK NOT IN('111111111','111111119','222222222')
                ORDER BY NALOKL ASC";

		$query = $this->ci->db->query($sql);

		$option = "";

		foreach ($query->result() as $row) {
			if ($kolok == $row->KOLOK) {
				$option .= "<option selected value='" . $row->KOLOK . "'>" . $row->KOLOK . " - " . $row->NALOKL . "</option>";
			} else {
				$option .= "<option value='" . $row->KOLOK . "'>" . $row->KOLOK . " - " . $row->NALOKL . "</option>";
			}
		}

		return $option;
	}

	public function getKolokAktifJoinPensiunmati($kolok = "") {
		/*$sql="SELECT KOLOK,NALOK AS NALOKL from (
			                select a.kolok,a.nalok from PERS_KLOGAD3_NEW a
			                    UNION
			                select b. kolok,b.nalokl from pers_lokasi_tbl b where b. KOLOK LIKE '11111111%' AND b.KOLOK <> '111111111' AND b.KOLOK <> '111111119'
		*/

		$sql = "SELECT KOLOK, NALOKL FROM PERS_LOKASI_TBL
                WHERE AKTIF = '1' AND
                KOLOK IN('111111112','111111113','111111115','111111118')
                ORDER BY NALOKL ASC";

		$query = $this->ci->db->query($sql);

		$option = "";

		foreach ($query->result() as $row) {
			if ($kolok == $row->KOLOK) {
				$option .= "<option selected value='" . $row->KOLOK . "'>" . $row->KOLOK . " - " . $row->NALOKL . "</option>";
			} else {
				$option .= "<option value='" . $row->KOLOK . "'>" . $row->KOLOK . " - " . $row->NALOKL . "</option>";
			}
		}

		return $option;
	}

	public function cekAktifKolok($kolok) {
		$sql = "SELECT AKTIF FROM PERS_LOKASI_TBL WHERE KOLOK ='" . $kolok . "'";
		$query = $this->ci->db->query($sql);

		return $query->row();
	}

	public function getMasterKolok($kolok = "") {
		$sql = "SELECT KOLOK, NALOKL FROM PERS_LOKASI_TBL
                WHERE AKTIF = '1' AND
                KOLOK NOT IN('111111111','111111119','222222222')
                ORDER BY NALOKL ASC
                ";

		$query = $this->ci->db->query($sql);

		$option = "";

		foreach ($query->result() as $row) {
			if ($kolok == $row->KOLOK) {
				$option .= "<option selected value='" . $row->KOLOK . "'>" . $row->KOLOK . " - " . $row->NALOKL . "</option>";
			} else {
				$option .= "<option value='" . $row->KOLOK . "'>" . $row->KOLOK . " - " . $row->NALOKL . "</option>";
			}
		}

		return $option;
	}

	public function getMasterSPMU($spmu = "") {
		$sql = "SELECT KODE_SPM, NAMA FROM PERS_TABEL_SPMU ORDER BY KODE_SPM ASC
                ";

		$query = $this->ci->db->query($sql);

		$option = "";

		foreach ($query->result() as $row) {
			if ($spmu == $row->KODE_SPM) {
				$option .= "<option selected value='" . $row->KODE_SPM . "'>" . $row->KODE_SPM . " - " . $row->NAMA . "</option>";
			} else {
				$option .= "<option value='" . $row->KODE_SPM . "'>" . $row->KODE_SPM . " - " . $row->NAMA . "</option>";
			}
		}

		return $option;
	}

	public function getMasterKolokAll($kolok = "") {
		$sql = "SELECT KOLOK, NALOKL FROM PERS_LOKASI_TBL WHERE NALOKL NOT IN ('.') ORDER BY NALOKL ASC
                ";

		$query = $this->ci->db->query($sql);

		$option = "";

		foreach ($query->result() as $row) {
			if ($kolok == $row->KOLOK) {
				$option .= "<option selected value='" . $row->KOLOK . "'>" . $row->KOLOK . " - " . $row->NALOKL . "</option>";
			} else {
				$option .= "<option value='" . $row->KOLOK . "'>" . $row->KOLOK . " - " . $row->NALOKL . "</option>";
			}
		}

		return $option;
	}

	public function getMasterKolokAllWithReset($kolok = "") {
		$sql = "SELECT KOLOK, NALOKL FROM PERS_LOKASI_TBL WHERE NALOKL NOT IN ('.') ORDER BY NALOKL ASC
                ";

		$query = $this->ci->db->query($sql);

		$option = "";
		$option .= "<option value=''>-Pilih Lokasi Kerja-</option>";
		foreach ($query->result() as $row) {
			if ($kolok == $row->KOLOK) {
				$option .= "<option selected value='" . $row->KOLOK . "'>" . $row->KOLOK . " - " . $row->NALOKL . "</option>";
			} else {
				$option .= "<option value='" . $row->KOLOK . "'>" . $row->KOLOK . " - " . $row->NALOKL . "</option>";
			}
		}

		return $option;
	}

	public function getMasterKolokAllValue($kolok = "") {
		$sql = "SELECT KOLOK, NALOKL FROM PERS_LOKASI_TBL WHERE KOLOK = '" . $kolok . "' ORDER BY NALOKL ASC
                ";
		$query = $this->ci->db->query($sql);
		$option = "";

		foreach ($query->result() as $row) {
			if ($kolok == $row->KOLOK) {
				$option .= $row->KOLOK . " - " . $row->NALOKL;
			} else {
				$option .= $row->KOLOK . " - " . $row->NALOKL;
			}
		}

		return $option;
	}

	public function getMasterKolokAllValue2($kolok = "") {
		$sql = "SELECT KOLOK, NALOKL FROM PERS_LOKASI_TBL WHERE KOLOK = '" . $kolok . "' ORDER BY NALOKL ASC
                ";
		$query = $this->ci->db->query($sql);
		$option = "";

		foreach ($query->result() as $row) {
			if ($kolok == $row->KOLOK) {
				$option .= $row->NALOKL;
			} else {
				$option .= $row->NALOKL;
			}
		}

		return $option;
	}

	public function getMasterKlogadAllValue($klogad = "") {
		$sql = "SELECT KOLOK, NALOKL FROM PERS_LOKASI_TBL WHERE KOLOK = '" . $klogad . "' ORDER BY NALOKL ASC
                ";
		$query = $this->ci->db->query($sql);
		$option = "";

		foreach ($query->result() as $row) {
			if ($klogad == $row->KOLOK) {
				$option .= $row->KOLOK . " - " . $row->NALOKL;
			} else {
				$option .= $row->KOLOK . " - " . $row->NALOKL;
			}
		}

		return $option;
	}

	public function getMasterKlogadNama($klogad = "") {
		$sql = "SELECT KOLOK, NALOKL FROM PERS_LOKASI_TBL WHERE KOLOK = '" . $klogad . "' ORDER BY NALOKL ASC
                ";
		$query = $this->ci->db->query($sql);
		$option = "";

		foreach ($query->result() as $row) {
			if ($klogad == $row->KOLOK) {
				$option .= $row->NALOKL;
			} else {
				$option .= $row->NALOKL;
			}
		}

		return $option;
	}

	public function getMasterPejtt($pejtt = "") {
		$sql = "SELECT PEJTT, KETERANGAN FROM PERS_PEJTT_RPT ORDER BY PEJTT ASC
                ";

		$query = $this->ci->db->query($sql);

		$option = "";

		foreach ($query->result() as $row) {
			if ($pejtt == $row->PEJTT) {
				$option .= "<option selected value='" . $row->PEJTT . "'>" . $row->PEJTT . " - " . $row->KETERANGAN . "</option>";
			} else {
				$option .= "<option value='" . $row->PEJTT . "'>" . $row->PEJTT . " - " . $row->KETERANGAN . "</option>";
			}
		}

		return $option;
	}

	public function getMasterJenrub($jenrub = "") {
		$sql = "SELECT JENRUB, KETERANGAN FROM PERS_JENRUB_RPT ORDER BY JENRUB ASC
                ";

		$query = $this->ci->db->query($sql);

		$option = "";

		foreach ($query->result() as $row) {
			if ($jenrub == $row->JENRUB) {
				$option .= "<option selected value='" . $row->JENRUB . "'>" . $row->JENRUB . " - " . $row->KETERANGAN . "</option>";
			} else {
				$option .= "<option value='" . $row->JENRUB . "'>" . $row->JENRUB . " - " . $row->KETERANGAN . "</option>";
			}
		}

		return $option;
	}

	public function getMasterJenrubPangkat($jenrub = "") {
		$sql = "SELECT JENRUB, KETERANGAN FROM PERS_JENRUB_RPT WHERE JENRUB in(12,1,3,4,6,11,13,15) ORDER BY JENRUB ASC
                ";

		$query = $this->ci->db->query($sql);

		$option = "";

		foreach ($query->result() as $row) {
			if ($jenrub == $row->JENRUB) {
				$option .= "<option selected value='" . $row->JENRUB . "'>" . $row->JENRUB . " - " . $row->KETERANGAN . "</option>";
			} else {
				$option .= "<option value='" . $row->JENRUB . "'>" . $row->JENRUB . " - " . $row->KETERANGAN . "</option>";
			}
		}

		return $option;
	}

	public function getMasterJenrubPangkatPengabdian($jenrub = "") {
		$sql = "SELECT JENRUB, KETERANGAN FROM PERS_JENRUB_RPT WHERE JENRUB in('13') ORDER BY JENRUB ASC
                ";

		$query = $this->ci->db->query($sql);

		$option = "";

		foreach ($query->result() as $row) {
			if ($jenrub == $row->JENRUB) {
				$option .= "<option selected value='" . $row->JENRUB . "'>" . $row->JENRUB . " - " . $row->KETERANGAN . "</option>";
			} else {
				$option .= "<option value='" . $row->JENRUB . "'>" . $row->JENRUB . " - " . $row->KETERANGAN . "</option>";
			}
		}

		return $option;
	}

	public function getMasterJenrubPangkatPenerimaanDagun($jenrub = "") {
		$sql = "SELECT JENRUB, KETERANGAN FROM PERS_JENRUB_RPT WHERE JENRUB in('12') ORDER BY JENRUB ASC
                ";

		$query = $this->ci->db->query($sql);

		$option = "";

		foreach ($query->result() as $row) {
			if ($jenrub == $row->JENRUB) {
				$option .= "<option selected value='" . $row->JENRUB . "'>" . $row->JENRUB . " - " . $row->KETERANGAN . "</option>";
			} else {
				$option .= "<option value='" . $row->JENRUB . "'>" . $row->JENRUB . " - " . $row->KETERANGAN . "</option>";
			}
		}

		return $option;
	}

	public function getMasterJenrubGapok($jenrub = "") {
		$sql = "SELECT JENRUB, KETERANGAN FROM PERS_JENRUB_RPT WHERE JENRUB in(2,5,6,9,10,15,16) ORDER BY JENRUB ASC
                ";

		$query = $this->ci->db->query($sql);

		$option = "";

		foreach ($query->result() as $row) {
			if ($jenrub == $row->JENRUB) {
				$option .= "<option selected value='" . $row->JENRUB . "'>" . $row->JENRUB . " - " . $row->KETERANGAN . "</option>";
			} else {
				$option .= "<option value='" . $row->JENRUB . "'>" . $row->JENRUB . " - " . $row->KETERANGAN . "</option>";
			}
		}

		return $option;
	}

	public function getMasterKojabf($kojab = "") {
		$sql = "SELECT KOJAB, NAJABL FROM PERS_KOJABF_TBL ORDER BY NAJABL ASC
                ";

		$query = $this->ci->db->query($sql);

		$option = "";

		foreach ($query->result() as $row) {
			if ($kojab == $row->KOJAB) {
				$option .= "<option selected value='" . $row->KOJAB . "'> " . $row->KOJAB . " - " . $row->NAJABL . "</option>";
			} else {
				$option .= "<option value='" . $row->KOJAB . "'> " . $row->KOJAB . " - " . $row->NAJABL . "</option>";
			}
		}

		return $option;
	}

	public function getMasterKojab($kolok, $kojab = "") {
		$sql = "SELECT KOJAB, NAJABL FROM PERS_KOJAB_TBL WHERE KOLOK = '" . $kolok . "' ORDER BY NAJABL ASC
                ";

		$query = $this->ci->db->query($sql);

		$option = "<option value=''></option>";

		foreach ($query->result() as $row) {
			if ($kojab == $row->KOJAB) {
				$option .= "<option selected value='" . $row->KOJAB . "'>" . $row->KOJAB . " - " . $row->NAJABL . "</option>";
			} else {
				$option .= "<option value='" . $row->KOJAB . "'>" . $row->KOJAB . " - " . $row->NAJABL . "</option>";
			}
		}
		//var_dump($option);
		return $option;
	}

	public function getMasterKojabAktif($kolok, $kojab = "") {
		$sql = "SELECT KOJAB, NAJABL FROM PERS_KOJAB_TBL WHERE KOLOK = '" . $kolok . "' AND AKTIF='1' ORDER BY KDSORT ASC,KOJAB ASC
                ";

		$query = $this->ci->db->query($sql);

		$option = "<option value=''></option>";

		foreach ($query->result() as $row) {
			if ($kojab == $row->KOJAB) {
				$option .= "<option selected value='" . $row->KOJAB . "'>" . $row->KOJAB . " - " . $row->NAJABL . "</option>";
			} else {
				$option .= "<option value='" . $row->KOJAB . "'>" . $row->KOJAB . " - " . $row->NAJABL . "</option>";
			}
		}
		//var_dump($option);
		return $option;
	}

	public function getMasterKojabSF($kolok, $kojab = "") {
		$sql = "SELECT KOJAB, NAJABL FROM PERS_KOJAB_TBL WHERE KOLOK = '" . $kolok . "'
                UNION
                SELECT KOJAB, NAJABL FROM PERS_KOJABF_TBL
                ORDER BY NAJABL ASC
                ";

		$query = $this->ci->db->query($sql);

		$option = "<option value=''></option>";

		foreach ($query->result() as $row) {
			if ($kojab == $row->KOJAB) {
				$option .= "<option selected value='" . $row->KOJAB . "'>" . $row->KOJAB . " - " . $row->NAJABL . "</option>";
			} else {
				$option .= "<option value='" . $row->KOJAB . "'>" . $row->KOJAB . " - " . $row->NAJABL . "</option>";
			}
		}
		//var_dump($option);
		return $option;
	}

	public function getMasterKojabSFValue($kolok, $kojab = "") {
		$sql = "SELECT KOJAB, NAJABL FROM PERS_KOJAB_TBL WHERE KOLOK = '" . $kolok . "'
                UNION
                SELECT KOJAB, NAJABL FROM PERS_KOJABF_TBL
                ORDER BY NAJABL ASC
                ";

		$query = $this->ci->db->query($sql);
		$option = "";

		foreach ($query->result() as $row) {
			if ($kojab == $row->KOJAB) {
				$option .= $row->KOJAB . " - " . $row->NAJABL;
			}

		}
		return $option;
	}

	public function getMasterKojabSFNama($kolok, $kojab = "", $kd = "") {
		if ($kd == "S") {
			$sql = "SELECT KOJAB, NAJABL FROM PERS_KOJAB_TBL WHERE KOLOK = '" . $kolok . "' AND KOJAB = '" . $kojab . "'";
		} else {
			$sql = "SELECT KOJAB, NAJABL FROM PERS_KOJABF_TBL WHERE KOJAB = '" . $kojab . "'";
		}

		$query = $this->ci->db->query($sql);
		$option = "";

		foreach ($query->result() as $row) {
			if ($kojab == $row->KOJAB) {
				$option .= $row->NAJABL;
			}

		}
		return $option;
	}

	public function getMasterEselon() {
		$sql = "SELECT ESELON, NESELON FROM PERS_ESELON_TBL ORDER BY ESELON ASC
                ";

		$query = $this->ci->db->query($sql);

		$option = "";

		foreach ($query->result() as $row) {
			$option .= "<option value='" . $row->ESELON . "'>" . $row->ESELON . " - " . $row->NESELON . "</option>";
		}

		return $option;
	}

	public function getHistEselon($eselon = "") {
		$sql = "SELECT ESELON,NESELON,NESELON2 FROM PERS_ESELON_TBL ORDER BY ESELON ASC
                 ";

		$query = $this->ci->db->query($sql);

		$option = "";

		foreach ($query->result() as $row) {
			if ($eselon == $row->ESELON) {
				$option .= "<option selected value='" . $row->ESELON . "'>" . $row->ESELON . " - " . $row->NESELON2 . "</option>";
			} else {
				$option .= "<option value='" . $row->ESELON . "'>" . $row->ESELON . " - " . $row->NESELON2 . "</option>";
			}
		}

		return $option;
	}

	public function getHistEselonAdd($eselon = "") {
		$sql = "SELECT ESELON,NESELON,NESELON2 FROM PERS_ESELON_TBL WHERE ESELON!=' ' ORDER BY ESELON ASC
                 ";

		$query = $this->ci->db->query($sql);

		$option = "";

		foreach ($query->result() as $row) {
			if ($eselon == $row->ESELON) {
				$option .= "<option selected value='" . $row->ESELON . "'>" . $row->ESELON . " - " . $row->NESELON2 . "</option>";
			} else {
				$option .= "<option value='" . $row->ESELON . "'>" . $row->ESELON . " - " . $row->NESELON2 . "</option>";
			}
		}

		return $option;
	}

	public function getJenSKAdd() {
		$sql = "SELECT * FROM PERS_JENSK ORDER BY ID_JENSK ASC
                 ";

		$query = $this->ci->db->query($sql);

		$option = "";

		foreach ($query->result() as $row) {

			{
				$option .= "<option value='" . $row->ID_JENSK . "'>" . $row->ID_JENSK . " - " . $row->KETERANGAN . "</option>";
			}

			// if($eselon == $row->ESELON)
			// {
			//     $option .= "<option selected value='".$row->ID_JENSK."'>".$row->KETERANGAN."</option>";
			// }
			// else
			// {
			//     $option .= "<option value='".$row->ID_JENSK."'>".$row->KETERANGAN."</option>";
			// }

		}

		return $option;
	}

	public function getJenSK($jenis_sk = "") {
		$sql = "SELECT * FROM PERS_JENSK ORDER BY ID_JENSK ASC
                 ";
		// var_dump($sql);
		$query = $this->ci->db->query($sql);

		$option = "";

		foreach ($query->result() as $row) {
			if ($jenis_sk == $row->ID_JENSK) {
				$option .= "<option selected value='" . $row->ID_JENSK . "'>" . $row->ID_JENSK . " - " . $row->KETERANGAN . "</option>";
			} else {
				$option .= "<option value='" . $row->ID_JENSK . "'>" . $row->ID_JENSK . " - " . $row->KETERANGAN . "</option>";
			}
		}

		// var_dump($option);exit;
		return $option;
	}

	public function getMasterPangkat($kopang = "") {
		$sql = "SELECT KOPANG, GOL, NAPANG FROM PERS_PANGKAT_TBL ORDER BY KOPANG ASC
                ";

		$query = $this->ci->db->query($sql);

		$option = "";

		foreach ($query->result() as $row) {
			if ($kopang == $row->KOPANG) {
				$option .= "<option selected value='" . $row->KOPANG . "'>" . $row->KOPANG . " - " . $row->NAPANG . "</option>";
			} else {
				$option .= "<option value='" . $row->KOPANG . "'>" . $row->KOPANG . " - " . $row->NAPANG . "</option>";
			}
		}

		return $option;
	}

	public function getMasterPangkat2($kopang = "") {
		$sql = "SELECT KOPANG, GOL, NAPANG FROM PERS_PANGKAT_TBL WHERE KOPANG>=211 AND KOPANG<=245 ORDER BY KOPANG ASC
                ";

		$query = $this->ci->db->query($sql);

		$option = "";

		foreach ($query->result() as $row) {
			if ($kopang == $row->KOPANG) {
				$option .= "<option selected value='" . $row->KOPANG . "'>" . $row->KOPANG . " - " . $row->NAPANG . " ( " . $row->GOL . " ) </option>";
			} else {
				$option .= "<option value='" . $row->KOPANG . "'>" . $row->KOPANG . " - " . $row->NAPANG . " ( " . $row->GOL . " )</option>";
			}
		}

		return $option;
	}

	public function getPangkatTerakhir($nrk) {
		$sql = "SELECT KOPANG FROM VW_PANGKAT_TERAKHIR WHERE NRK='" . $nrk . "'";

		$query = $this->ci->db->query($sql)->row();

		return $query;
	}

	public function getMasterJendikForm($jendik) {
		$sql = "SELECT JENDIK, KETERANGAN FROM PERS_JENDIK_RPT WHERE JENDIK = 1 ORDER BY JENDIK ASC
                ";

		$query = $this->ci->db->query($sql);

		$option = "";

		foreach ($query->result() as $row) {
			if ($jendik == $row->JENDIK) {
				$option = "<option selected value='" . $row->JENDIK . "'>" . $row->JENDIK . " - " . $row->KETERANGAN . "</option>";
			} else {
				$option = "<option selected value='" . $row->JENDIK . "'>" . $row->JENDIK . " - " . $row->KETERANGAN . "</option>";
			}
		}

		return $option;
	}

	public function getMasterJendikNonForm($jendik) {
		$sql = "SELECT JENDIK, KETERANGAN FROM PERS_JENDIK_RPT WHERE JENDIK <> 1 ORDER BY JENDIK ASC
                ";

		$query = $this->ci->db->query($sql);

		$option = "";

		foreach ($query->result() as $row) {
			if ($jendik == $row->JENDIK) {
				$option .= "<option selected value='" . $row->JENDIK . "'>" . $row->JENDIK . " - " . $row->KETERANGAN . "</option>";
			} else {
				$option .= "<option value='" . $row->JENDIK . "'>" . $row->JENDIK . " - " . $row->KETERANGAN . "</option>";
			}
		}

		return $option;
	}

	public function getMasterUniver($univer) {
		$sql = "SELECT KDUNIVER, NAUNIVER FROM PERS_UNIVER_TBL ORDER BY KDUNIVER ASC
                ";

		$query = $this->ci->db->query($sql);

		$option = "";

		foreach ($query->result() as $row) {
			if ($univer == $row->KDUNIVER) {
				$option .= "<option selected value='" . $row->KDUNIVER . "'>" . $row->KDUNIVER . " - " . $row->NAUNIVER . "</option>";
			} else {
				$option .= "<option value='" . $row->KDUNIVER . "'>" . $row->KDUNIVER . " - " . $row->NAUNIVER . "</option>";
			}
		}

		return $option;
	}

	public function getMasterUniverDikti($univer) {
		$sql = "SELECT KDUNIVER,NAUNIVER FROM PERS_UNIVER_TBL WHERE KDUNIVER LIKE 'A%' OR KDUNIVER LIKE 'S%' OR KDUNIVER LIKE 'I%' OR KDUNIVER LIKE 'U%' ORDER BY KDUNIVER ASC
                ";

		$query = $this->ci->db->query($sql);

		$option = "";

		foreach ($query->result() as $row) {
			if ($univer == $row->KDUNIVER) {
				$option .= "<option selected value='" . $row->KDUNIVER . "'>" . $row->KDUNIVER . " - " . $row->NAUNIVER . "</option>";
			} else {
				$option .= "<option value='" . $row->KDUNIVER . "'>" . $row->KDUNIVER . " - " . $row->NAUNIVER . "</option>";
			}
		}

		return $option;
	}

	public function getMasterKodik($jendik, $kodik = "") {
		$sql = "SELECT KODIK, NADIK FROM PERS_PDIDIKAN_TBL WHERE JENDIK='" . $jendik . "' ORDER BY KODIK ASC
                ";

		$query = $this->ci->db->query($sql);

		$option = "";

		foreach ($query->result() as $row) {

			if ($kodik == $row->KODIK) {
				$option .= "<option selected value='" . $row->KODIK . "'>" . $row->KODIK . " - " . $row->NADIK . "</option>";
			} else {
				$option .= "<option value='" . $row->KODIK . "'>" . $row->KODIK . " - " . $row->NADIK . "</option>";
			}
		}

		return $option;
	}

	public function getMasterKodikByJenjang($jendik, $jenpdk, $kodik = "") {
		$sql = "";
		if ($jenpdk == 4) {
			$sql = "SELECT KODIK, NADIK FROM PERS_PDIDIKAN_TBL WHERE JENDIK='" . $jendik . "' AND (
                    KODIK LIKE '40%' OR
                    KODIK LIKE '41%' OR
                    KODIK LIKE '42%' OR
                    KODIK LIKE '43%' OR
                    KODIK LIKE '44%') ORDER BY KODIK ASC";
		} else if ($jenpdk == 10) {
			$sql = "SELECT KODIK, NADIK FROM PERS_PDIDIKAN_TBL WHERE JENDIK='" . $jendik . "' AND (
                    KODIK LIKE '45%' OR
                    KODIK LIKE '46%' OR
                    KODIK LIKE '47%' OR
                    KODIK LIKE '48%' OR
                    KODIK LIKE '49%') ORDER BY KODIK ASC";
		} else {
			$sql = "SELECT KODIK, NADIK FROM PERS_PDIDIKAN_TBL WHERE JENDIK='" . $jendik . "' AND KODIK LIKE '" . $jenpdk . "%' ORDER BY KODIK ASC
                ";
		}
		//echo $sql;

		$query = $this->ci->db->query($sql);

		$option = "";

		foreach ($query->result() as $row) {

			if ($kodik == $row->KODIK) {
				$option .= "<option selected value='" . $row->KODIK . "'>" . $row->KODIK . " - " . $row->NADIK . "</option>";
			} else {
				$option .= "<option value='" . $row->KODIK . "'>" . $row->KODIK . " - " . $row->NADIK . "</option>";
			}
		}

		return $option;
	}

	public function getMasaKerjaByKopang($kopang, $ttmasker = "") {
		$sql = "SELECT KOPANG, TTMASKER FROM PERS_GAPOK_TBL WHERE KOPANG = '" . $kopang . "' ORDER BY TTMASKER ASC";

		$query = $this->ci->db->query($sql);

		$option = "";

		foreach ($query->result() as $row) {
			if ($ttmasker == $row->TTMASKER) {
				$option .= "<option selected value='" . $row->TTMASKER . "'>" . $row->TTMASKER . "</option>";
			} else {
				$option .= "<option value='" . $row->TTMASKER . "'>" . $row->TTMASKER . "</option>";
			}
		}

		return $option;
	}

	public function getMaxMasaKerjaByKopang($kopang) {
		$sql = "SELECT MAX(TTMASKER) FROM PERS_GAPOK_TBL WHERE KOPANG = '" . $kopang . "'";

		$query = $this->ci->db->query($sql)->row();

		return $query;

	}

	public function getJenisHukdis($hukdis = "") {
		$sql = "SELECT JENHUKDIS, KETERANGAN FROM PERS_JENHUKDIS_RPT WHERE JENHUKDIS != 0 AND JENHUKDIS !=3 AND JENHUKDIS !=4 ORDER BY JENHUKDIS ASC";

		$query = $this->ci->db->query($sql);

		$option = "";

		foreach ($query->result() as $row) {
			if ($hukdis == $row->JENHUKDIS) {
				$option .= "<option selected value='" . $row->JENHUKDIS . "'>" . $row->KETERANGAN . "</option>";
			} else {
				$option .= "<option value='" . $row->JENHUKDIS . "'>" . $row->KETERANGAN . "</option>";
			}
		}

		return $option;
	}

	public function getJenisHukdisAll($hukdis = "") {
		$sql = "SELECT JENHUKDIS, KETERANGAN FROM PERS_JENHUKDIS_RPT ORDER BY JENHUKDIS ASC";

		$query = $this->ci->db->query($sql);

		$option = "";

		foreach ($query->result() as $row) {
			if ($hukdis == $row->JENHUKDIS) {
				$option .= "<option selected value='" . $row->JENHUKDIS . "'>" . $row->KETERANGAN . "</option>";
			} else {
				$option .= "<option value='" . $row->JENHUKDIS . "'>" . $row->KETERANGAN . "</option>";
			}
		}

		return $option;
	}

	public function getJenisCuti($jencuti = "") {
		$sql = "SELECT JENCUTI, KETERANGAN FROM PERS_JENCUTI_RPT ORDER BY KETERANGAN ASC";

		$query = $this->ci->db->query($sql);

		$option = "";

		foreach ($query->result() as $row) {
			if ($jencuti == $row->JENCUTI) {
				$option .= "<option selected value='" . $row->JENCUTI . "'>" . $row->KETERANGAN . "</option>";
			} else {
				$option .= "<option value='" . $row->JENCUTI . "'>" . $row->KETERANGAN . "</option>";
			}
		}

		return $option;
	}

	public function getJenisUsaha($jenusaha = "") {
		$sql = "SELECT JENUSAHA, KETERANGAN FROM PERS_JENUSAHA_RPT ORDER BY KETERANGAN ASC";

		$query = $this->ci->db->query($sql);

		$option = "";

		foreach ($query->result() as $row) {
			if ($jenusaha == $row->JENUSAHA) {
				$option .= "<option selected value='" . $row->JENUSAHA . "'>" . $row->KETERANGAN . "</option>";
			} else {
				$option .= "<option value='" . $row->JENUSAHA . "'>" . $row->KETERANGAN . "</option>";
			}
		}

		return $option;
	}

	public function getKodeSeminar($kdsemi = "") {
		$sql = "SELECT KDSEMI, KETERANGAN FROM PERS_KDSEMI_RPT ORDER BY KETERANGAN ASC";

		$query = $this->ci->db->query($sql);

		$option = "";

		foreach ($query->result() as $row) {
			if ($kdsemi == $row->KDSEMI) {
				$option .= "<option selected value='" . $row->KDSEMI . "'>" . $row->KETERANGAN . "</option>";
			} else {
				$option .= "<option value='" . $row->KDSEMI . "'>" . $row->KETERANGAN . "</option>";
			}
		}

		return $option;
	}

	public function getKodeTemaSeminardanTulisan($kdtema = "") {
		$sql = "SELECT KDTEMA, NATEMA FROM PERS_TEMA_TBL ORDER BY NATEMA ASC";

		$query = $this->ci->db->query($sql);

		$option = "";

		foreach ($query->result() as $row) {
			if ($kdtema == $row->KDTEMA) {
				$option .= "<option selected value='" . $row->KDTEMA . "'>" . $row->NATEMA . "</option>";
			} else {
				$option .= "<option value='" . $row->KDTEMA . "'>" . $row->NATEMA . "</option>";
			}
		}

		return $option;
	}

	public function getKodePeranSeminar($kdperan = "") {
		$sql = "SELECT KDPERAN, KETERANGAN FROM PERS_KDPERANS_RPT ORDER BY KETERANGAN ASC";

		$query = $this->ci->db->query($sql);

		$option = "";

		foreach ($query->result() as $row) {
			if ($kdperan == $row->KDPERAN) {
				$option .= "<option selected value='" . $row->KDPERAN . "'>" . $row->KETERANGAN . "</option>";
			} else {
				$option .= "<option value='" . $row->KDPERAN . "'>" . $row->KETERANGAN . "</option>";
			}
		}

		return $option;
	}

	public function getKodePeranTulisan($kdperan = "") {
		$sql = "SELECT KDPERAN, KETERANGAN FROM PERS_KDPERANT_RPT ORDER BY KETERANGAN ASC";

		$query = $this->ci->db->query($sql);

		$option = "";

		foreach ($query->result() as $row) {
			if ($kdperan == $row->KDPERAN) {
				$option .= "<option selected value='" . $row->KDPERAN . "'>" . $row->KETERANGAN . "</option>";
			} else {
				$option .= "<option value='" . $row->KDPERAN . "'>" . $row->KETERANGAN . "</option>";
			}
		}

		return $option;
	}

	public function getJenisHukadmin($hukadm = "") {
		$sql = "SELECT JENHUKADM, KETERANGAN FROM PERS_JENHUKADM_RPT ORDER BY KETERANGAN ASC";

		$query = $this->ci->db->query($sql);

		$option = "";

		foreach ($query->result() as $row) {
			if ($hukadm == $row->JENHUKADM) {
				$option .= "<option selected value='" . $row->JENHUKADM . "'>" . $row->KETERANGAN . "</option>";
			} else {
				$option .= "<option value='" . $row->JENHUKADM . "'>" . $row->KETERANGAN . "</option>";
			}
		}

		return $option;
	}

	public function getKodeSifatTulisan($kdsifat = "") {
		$sql = "SELECT KDSIFAT,KETERANGAN FROM PERS_KDSIFAT_RPT ORDER BY KETERANGAN ASC";

		$query = $this->ci->db->query($sql);

		$option = "";

		foreach ($query->result() as $row) {
			if ($kdsifat == $row->KDSIFAT) {
				$option .= "<option selected value='" . $row->KDSIFAT . "'>" . $row->KETERANGAN . "</option>";
			} else {
				$option .= "<option value='" . $row->KDSIFAT . "'>" . $row->KETERANGAN . "</option>";
			}
		}

		return $option;
	}

	public function getKodeLingkupTulisan($kdlingkup = "") {
		$sql = "SELECT KDLINGKUP,KETERANGAN FROM PERS_KDLINGKUP_RPT ORDER BY KETERANGAN ASC";

		$query = $this->ci->db->query($sql);

		$option = "";

		foreach ($query->result() as $row) {
			if ($kdlingkup == $row->KDLINGKUP) {
				$option .= "<option selected value='" . $row->KDLINGKUP . "'>" . $row->KETERANGAN . "</option>";
			} else {
				$option .= "<option value='" . $row->KDLINGKUP . "'>" . $row->KETERANGAN . "</option>";
			}
		}

		return $option;
	}

	public function getKodeJumlahKataTulisan($jumkata = "") {
		$sql = "SELECT KDJUMKATA,KETERANGAN FROM PERS_KDJUMKATA_RPT";

		$query = $this->ci->db->query($sql);

		$option = "";

		foreach ($query->result() as $row) {
			if ($jumkata == $row->KDJUMKATA) {
				$option .= "<option selected value='" . $row->KDJUMKATA . "'>" . $row->KETERANGAN . "</option>";
			} else {
				$option .= "<option value='" . $row->KDJUMKATA . "'>" . $row->KETERANGAN . "</option>";
			}
		}

		return $option;
	}

	public function getJenisPenghargaan($kdharga = "") {
		$sql = "SELECT KDHARGA, NAHARGA FROM PERS_HARGAAN_TBL WHERE KDHARGA NOT IN(38,39,40,71,81)";

		$query = $this->ci->db->query($sql);

		$option = "";

		foreach ($query->result() as $row) {
			if ($kdharga == $row->KDHARGA) {
				$option .= "<option selected value='" . $row->KDHARGA . "'>" . $row->NAHARGA . "</option>";
			} else {
				$option .= "<option value='" . $row->KDHARGA . "'>" . $row->NAHARGA . "</option>";
			}
		}

		return $option;
	}

	public function getKodeKedudukan($kdduduk = "") {
		$sql = "SELECT KDDUDUK, KETERANGAN FROM PERS_KDDUDUK_RPT";

		$query = $this->ci->db->query($sql);

		$option = "";

		foreach ($query->result() as $row) {
			if ($kdduduk == $row->KDDUDUK) {
				$option .= "<option selected value='" . $row->KDDUDUK . "'>" . $row->KETERANGAN . "</option>";
			} else {
				$option .= "<option value='" . $row->KDDUDUK . "'>" . $row->KETERANGAN . "</option>";
			}
		}

		return $option;
	}

	public function getKodeHubkel($hubkel = "") {
		$sql = "SELECT HUBKEL, NAHUBKEL FROM PERS_HUBKEL_TBL WHERE HUBKEL <50 OR HUBKEL > 57 ORDER BY HUBKEL ASC";

		$query = $this->ci->db->query($sql);

		$option = "";

		foreach ($query->result() as $row) {
			if ($hubkel == $row->HUBKEL) {
				$option .= "<option selected value='" . $row->HUBKEL . "'>" . $row->HUBKEL . ' - ' . $row->NAHUBKEL . "</option>";
			} else {
				$option .= "<option value='" . $row->HUBKEL . "'>" . $row->HUBKEL . ' - ' . $row->NAHUBKEL . "</option>";
			}
		}

		return $option;
	}

	public function getKodeHubkelAll($hubkel = "") {
		$sql = "SELECT HUBKEL, NAHUBKEL FROM PERS_HUBKEL_TBL ORDER BY HUBKEL ASC";

		$query = $this->ci->db->query($sql);

		$option = "";

		foreach ($query->result() as $row) {
			if ($hubkel == $row->HUBKEL) {
				$option .= "<option selected value='" . $row->HUBKEL . "'>" . $row->HUBKEL . ' - ' . $row->NAHUBKEL . "</option>";
			} else {
				$option .= "<option value='" . $row->HUBKEL . "'>" . $row->HUBKEL . ' - ' . $row->NAHUBKEL . "</option>";
			}
		}

		return $option;
	}

	public function getKodeStattun($stattun = "") {
		$sql = "SELECT STATTUN, KETERANGAN FROM PERS_STATTUN_RPT WHERE STATTUN <> 3 ORDER BY STATTUN ASC";

		$query = $this->ci->db->query($sql);

		$option = "";

		foreach ($query->result() as $row) {

			if ($stattun == $row->STATTUN) {

				$option .= "<option value='" . $row->STATTUN . "' selected>" . $row->STATTUN . " - " . $row->KETERANGAN . "</option>";
			} else {

				$option .= "<option value='" . $row->STATTUN . "'>" . $row->STATTUN . " - " . $row->KETERANGAN . "</option>";
			}
		}

		return $option;
	}

	public function getKodeStattunAll($stattun = "") {
		$sql = "SELECT STATTUN, KETERANGAN FROM PERS_STATTUN_RPT ORDER BY STATTUN ASC";

		$query = $this->ci->db->query($sql);

		$option = "";

		foreach ($query->result() as $row) {

			if ($stattun == $row->STATTUN) {

				$option .= "<option value='" . $row->STATTUN . "' selected>" . $row->STATTUN . " - " . $row->KETERANGAN . "</option>";
			} else {

				$option .= "<option value='" . $row->STATTUN . "'>" . $row->STATTUN . " - " . $row->KETERANGAN . "</option>";
			}
		}

		return $option;
	}

	public function getKodeStattunHanya2($stattun = "") {
		$sql = "SELECT STATTUN, KETERANGAN FROM PERS_STATTUN_RPT WHERE STATTUN = 2 ORDER BY STATTUN ASC";

		$query = $this->ci->db->query($sql);

		$option = "";

		foreach ($query->result() as $row) {

			if ($stattun == $row->STATTUN) {

				$option .= "<option value='" . $row->STATTUN . "' selected>" . $row->STATTUN . " - " . $row->KETERANGAN . "</option>";
			} else {

				$option .= "<option value='" . $row->STATTUN . "'>" . $row->STATTUN . " - " . $row->KETERANGAN . "</option>";
			}
		}

		return $option;
	}

	public function getKodeStattunHanya1($stattun = "") {
		$sql = "SELECT STATTUN, KETERANGAN FROM PERS_STATTUN_RPT WHERE STATTUN = 1 ORDER BY STATTUN ASC";

		$query = $this->ci->db->query($sql);

		$option = "";

		foreach ($query->result() as $row) {

			if ($stattun == $row->STATTUN) {

				$option .= "<option value='" . $row->STATTUN . "' selected>" . $row->STATTUN . " - " . $row->KETERANGAN . "</option>";
			} else {

				$option .= "<option value='" . $row->STATTUN . "'>" . $row->STATTUN . " - " . $row->KETERANGAN . "</option>";
			}
		}

		return $option;
	}

	public function getKodeStattunTanpa1($stattun = "") {
		$sql = "SELECT STATTUN, KETERANGAN FROM PERS_STATTUN_RPT WHERE STATTUN <> 1 ORDER BY STATTUN ASC";

		$query = $this->ci->db->query($sql);

		$option = "";

		foreach ($query->result() as $row) {

			if ($stattun == $row->STATTUN) {

				$option .= "<option value='" . $row->STATTUN . "' selected>" . $row->STATTUN . " - " . $row->KETERANGAN . "</option>";

			} else {

				$option .= "<option value='" . $row->STATTUN . "'>" . $row->STATTUN . " - " . $row->KETERANGAN . "</option>";
			}
		}

		return $option;
	}

	public function getKodeKerja($kdkerja = "") {
		$sql = "SELECT KDKERJA, KETERANGAN FROM PERS_KDKERJA_RPT ORDER BY KDKERJA ASC";

		$query = $this->ci->db->query($sql);

		$option = "";

		foreach ($query->result() as $row) {
			if ($kdkerja == $row->KDKERJA) {
				$option .= "<option selected value='" . $row->KDKERJA . "'>" . $row->KDKERJA . " - " . $row->KETERANGAN . "</option>";
			} else {
				$option .= "<option value='" . $row->KDKERJA . "'>" . $row->KDKERJA . " - " . $row->KETERANGAN . "</option>";
			}
		}

		return $option;
	}

	public function getUangDuka($uangduka = "") {
		$sql = "SELECT UANGDUKA, KETERANGAN FROM PERS_UANGDUKA_RPT ORDER BY UANGDUKA ASC";

		$query = $this->ci->db->query($sql);

		$option = "";

		foreach ($query->result() as $row) {
			if ($uangduka == $row->UANGDUKA) {
				$option .= "<option selected value='" . $row->UANGDUKA . "'>" . $row->KETERANGAN . "</option>";
			} else {
				$option .= "<option value='" . $row->UANGDUKA . "'>" . $row->KETERANGAN . "</option>";
			}
		}

		return $option;
	}

	public function getMasterFasilitas($jenfas = "") {
		$sql = "SELECT JENFAS, KETERANGAN FROM PERS_JENFAS_RPT ORDER BY JENFAS";

		$query = $this->ci->db->query($sql);

		$option = "";

		foreach ($query->result() as $row) {
			if ($jenfas == $row->JENFAS) {
				$option .= "<option selected value='" . $row->JENFAS . "'>" . $row->JENFAS . "-" . $row->KETERANGAN . "</option>";
			} else {
				$option .= "<option value='" . $row->JENFAS . "'>" . $row->JENFAS . "-" . $row->KETERANGAN . "</option>";
			}
		}

		return $option;
	}

	public function getMasterInstansi($instansi = "") {
		$sql = "SELECT INSTANSI, KETERANGAN FROM PERS_INSTANSI_RPT";

		$query = $this->ci->db->query($sql);

		$option = "";

		foreach ($query->result() as $row) {
			if ($instansi == $row->INSTANSI) {
				$option .= "<option selected value='" . $row->INSTANSI . "'>" . $row->INSTANSI . "-" . $row->KETERANGAN . "</option>";
			} else {
				$option .= "<option value='" . $row->INSTANSI . "'>" . $row->INSTANSI . "-" . $row->KETERANGAN . "</option>";
			}
		}

		return $option;
	}

	public function getMasterInstansi2($instansi = "") {
		$sql = "SELECT INSTANSI, KETERANGAN FROM PERS_INSTANSI_RPT";

		$query = $this->ci->db->query($sql);

		$option = "";

		foreach ($query->result() as $row) {
			if ($instansi == $row->INSTANSI) {
				$option .= "<option selected value='" . $row->INSTANSI . "'>" . $row->INSTANSI . "-" . $row->KETERANGAN . "</option>";
			} else if ('2' == $row->INSTANSI) {
				$option .= "<option selected value='" . $row->INSTANSI . "'>" . $row->INSTANSI . "-" . $row->KETERANGAN . "</option>";
			} else {
				$option .= "<option value='" . $row->INSTANSI . "'>" . $row->INSTANSI . "-" . $row->KETERANGAN . "</option>";
			}
		}

		return $option;
	}

	public function getWilayah($kowil = "") {
		$sql = "SELECT KOWIL, NAWIL FROM PERS_KOWIL_TBL";

		$query = $this->ci->db->query($sql);

		$option = "";

		foreach ($query->result() as $row) {
			if ($kowil == $row->KOWIL) {
				$option .= "<option selected value='" . $row->KOWIL . "'>" . $row->KOWIL . "-" . $row->NAWIL . "</option>";
			} else {
				$option .= "<option value='" . $row->KOWIL . "'>" . $row->KOWIL . "-" . $row->NAWIL . "</option>";
			}
		}

		return $option;
	}

	public function getWilayahNew($prop = '', $kowil = "") {
		$where = " WHERE ID_PROPINSI = '" . $prop . "' ";
		$sql = "SELECT ID,ID_PROPINSI, NAMA FROM PERS_REF_KABUPATENKOTA " . $where;

		$query = $this->ci->db->query($sql);

		$option = "";

		foreach ($query->result() as $row) {
			if ($kowil == $row->ID) {
				$option .= "<option selected value='" . $row->ID . "'>" . $row->NAMA . "</option>";
			} else {
				$option .= "<option value='" . $row->ID . "'>" . $row->NAMA . "</option>";
			}
		}

		return $option;
	}

	public function getWilayahNew2($prop, $kowil = "") {
		if ($prop != "") {
			$where = " WHERE SUBSTR(KODE,0,2) = '" . substr($prop, 0, 2) . "' ";
			$sql = 'SELECT KODE, NAMA FROM LOKASI
                WHERE SUBSTR(KODE,0,2) = \'' . substr($prop, 0, 2) . '\'
                AND KODE <> \'' . $prop . '\'
                AND KODE LIKE \'%.00.0000\'
                AND DELETED IS NULL
                ORDER BY NAMA ASC';
			// echo $sql;exit;
			$query = $this->ci->db->query($sql);

			$option = "";

			foreach ($query->result() as $row) {
				if ($kowil == $row->KODE) {
					$option .= "<option selected value='" . $row->KODE . "'>" . $row->NAMA . "</option>";
				} else {
					$option .= "<option value='" . $row->KODE . "'>" . $row->NAMA . "</option>";
				}
			}
		} else {
			$option = "<option value=''>Data tidak ditemukan</option>";
		}

		return $option;
	}

	public function getWilayahNew2Add($prop, $kowil = "") {
		if ($prop != "") {
			$where = " WHERE SUBSTR(KODE,0,2) = '" . substr($prop, 0, 2) . "' ";
			$sql = 'SELECT KODE, NAMA FROM LOKASI
                WHERE SUBSTR(KODE,0,2) = \'' . substr($prop, 0, 2) . '\'
                AND KODE <> \'' . $prop . '\'
                AND KODE LIKE \'%.00.0000\'
                AND DELETED IS NULL
                AND AKTIF = "Y"
                ORDER BY NAMA ASC';
			// echo $sql;exit;
			$query = $this->ci->db->query($sql);

			$option = "";

			foreach ($query->result() as $row) {
				if ($kowil == $row->KODE) {
					$option .= "<option selected value='" . $row->KODE . "'>" . $row->NAMA . "</option>";
				} else {
					$option .= "<option value='" . $row->KODE . "'>" . $row->NAMA . "</option>";
				}
			}
		} else {
			$option = "<option value=''>Data tidak ditemukan</option>";
		}

		return $option;
	}

	public function getWilayahNew3($prop = '', $wilayah = '') {

		$sql = 'SELECT KODE AS "id", NAMA AS "text"
                FROM LOKASI
                WHERE SUBSTR(KODE,0,2) = \'' . substr($prop, 0, 2) . '\'
                AND NAMA LIKE \'%' . strtoupper($wilayah) . '%\'
                AND KODE <> \'' . $prop . '\'
                AND KODE LIKE \'%.00.0000\'
                AND DELETED IS NULL
                ORDER BY NAMA ASC';
		// echo $sql;exit;
		$rs = $this->ci->db->query($sql)->result_array();

		// Make sure we have a result
		if ($rs) {
			$data = $rs;
		} else {
			$data[] = array('id' => '0', 'text' => 'Data tidak ditemukan');
		}

		return $data;
	}

	public function getKab($prov) {
		$sql = "SELECT PROPINSI,KABUPATEN_KOTA,NAMA
                FROM LOKASI
                WHERE PROPINSI = 11
                AND SUBSTR(KODE, 6, 11)='.00.0000'
                AND KABUPATEN_KOTA <> 0
                AND DELETED IS NULL
                ORDER BY KABUPATEN_KOTA ASC";

		$query = $this->ci->db->query($sql);

		$option = "";

		// foreach($query->result() as $row){
		//     if($kokec == $row->KOCAM)
		//     {
		//         $option .= "<option selected value='".$row->KOCAM."'>".$row->KOCAM."-".$row->NACAM."</option>";
		//     }
		//     else
		//     {
		//         $option .= "<option value='".$row->KOCAM."'>".$row->KOCAM."-".$row->NACAM."</option>";
		//     }
		// }

		return $option;
	}

	public function getKecamatan($kowil, $kokec = "") {
		$where = " WHERE KOWIL = '" . $kowil . "' ";
		$sql = "SELECT KOWIL, KOCAM, NACAM FROM PERS_KOCAM_TBL " . $where;

		$query = $this->ci->db->query($sql);

		$option = "";

		foreach ($query->result() as $row) {
			if ($kokec == $row->KOCAM) {
				$option .= "<option selected value='" . $row->KOCAM . "'>" . $row->KOCAM . "-" . $row->NACAM . "</option>";
			} else {
				$option .= "<option value='" . $row->KOCAM . "'>" . $row->KOCAM . "-" . $row->NACAM . "</option>";
			}
		}

		return $option;
	}

	public function getKecamatanNew($kowil, $kokec = "") {
		$where = " WHERE ID_KABUPATEN = '" . $kowil . "' ";
		$sql = "SELECT ID, NAMA FROM PERS_REF_KECAMATAN " . $where;

		$query = $this->ci->db->query($sql);

		$option = "";

		foreach ($query->result() as $row) {
			if ($kokec == $row->ID) {
				$option .= "<option selected value='" . $row->ID . "'>" . $row->NAMA . "</option>";
			} else {
				$option .= "<option value='" . $row->ID . "'>" . $row->NAMA . "</option>";
			}
		}

		return $option;
	}

	public function getKecamatanNew3($kowil = '', $nacam = '') {

		$sql = 'SELECT KODE AS "id", NAMA AS "text"
                FROM LOKASI
                WHERE SUBSTR(KODE,0,5) = \'' . substr($kowil, 0, 5) . '\'
                AND NAMA LIKE \'%' . strtoupper($nacam) . '%\'
                AND KODE <> \'' . $kowil . '\'
                AND KODE LIKE \'%0000\'
                AND DELETED IS NULL
                ORDER BY NAMA ASC';
		// echo $sql;exit;
		$rs = $this->ci->db->query($sql)->result_array();

		// Make sure we have a result
		if ($rs) {
			$data = $rs;
		} else {
			$data[] = array('id' => '0', 'text' => 'Data tidak ditemukan');
		}

		return $data;
	}

	public function getJenjangPendidikan($jenpdk = "") {
		$sql = "SELECT KODE_JENJANG, KETERANGAN FROM PERS_JENJANG_PENDIDIKAN ORDER by KODE_JENJANG";

		$query = $this->ci->db->query($sql);

		$option = "";

		foreach ($query->result() as $row) {
			if ($jenpdk == $row->KODE_JENJANG) {
				$option .= "<option selected value='" . $row->KODE_JENJANG . "'>" . $row->KODE_JENJANG . " - " . $row->KETERANGAN . "</option>";
			} else {
				$option .= "<option value='" . $row->KODE_JENJANG . "'>" . $row->KODE_JENJANG . " - " . $row->KETERANGAN . "</option>";
			}
		}

		return $option;
	}

	public function getJenpeg($stapeg, $jenpeg = "") {
		$where = "";
		if ($stapeg == "1") {
			$where = " WHERE JENPEG = '1' ";
		} else if ($stapeg == "2") {
			$where = " WHERE JENPEG = '1' OR JENPEG = '6' ";
		}

		$sql = "SELECT JENPEG, KETERANGAN FROM PERS_JENPEG_RPT " . $where;

		$query = $this->ci->db->query($sql);

		$option = "";

		foreach ($query->result() as $row) {
			if ($jenpeg == $row->JENPEG) {
				$option .= "<option selected value='" . $row->JENPEG . "'>" . $row->JENPEG . " - " . $row->KETERANGAN . "</option>";
			} else {
				$option .= "<option value='" . $row->JENPEG . "'>" . $row->JENPEG . " - " . $row->KETERANGAN . "</option>";
			}
		}

		return $option;
	}

	public function getKelurahan($kowil, $kocam, $kokel = "") {
		$where = " AND KOWIL = '" . $kowil . "' ";
		$where .= " AND KOCAM = '" . $kocam . "' ";
		$sql = "SELECT KOWIL, KOCAM, KOKEL, NAKEL FROM PERS_KOKEL_TBL WHERE 1=1 " . $where;

		$query = $this->ci->db->query($sql);

		$option = "";

		foreach ($query->result() as $row) {
			if ($kokel == $row->KOKEL) {
				$option .= "<option selected value='" . $row->KOKEL . "'>" . $row->KOKEL . "-" . $row->NAKEL . "</option>";
			} else {
				$option .= "<option value='" . $row->KOKEL . "'>" . $row->KOKEL . "-" . $row->NAKEL . "</option>";
			}
		}

		return $option;
	}

	public function getKecamatanNew2($kowil, $kokec = "") {
		if ($kowil != "") {
			$sql = 'SELECT KODE, NAMA FROM LOKASI
                    WHERE SUBSTR(KODE,0,5) = \'' . substr($kowil, 0, 5) . '\'
                    AND KODE <> \'' . $kowil . '\'
                    AND KODE LIKE \'%0000\'
                    AND DELETED IS NULL
                    AND ROWNUM <= 100
                    ORDER BY NAMA ASC';

			$query = $this->ci->db->query($sql);

			$option = "";

			foreach ($query->result() as $row) {
				if ($kokec == $row->KODE) {
					$option .= "<option selected value='" . $row->KODE . "'>" . $row->NAMA . "</option>";
				} else {
					$option .= "<option value='" . $row->KODE . "'>" . $row->NAMA . "</option>";
				}
			}
		} else {
			$option = "<option value=''>Data tidak ditemukan</option>";
		}

		return $option;
	}

	public function getKecamatanNew2Add($kowil, $kokec = "") {
		if ($kowil != "") {
			$sql = 'SELECT KODE, NAMA FROM LOKASI
                    WHERE SUBSTR(KODE,0,5) = \'' . substr($kowil, 0, 5) . '\'
                    AND KODE <> \'' . $kowil . '\'
                    AND KODE LIKE \'%0000\'
                    AND AKTIF="Y"
                    AND DELETED IS NULL
                    AND ROWNUM <= 100
                    ORDER BY NAMA ASC';

			$query = $this->ci->db->query($sql);

			$option = "";

			foreach ($query->result() as $row) {
				if ($kokec == $row->KODE) {
					$option .= "<option selected value='" . $row->KODE . "'>" . $row->NAMA . "</option>";
				} else {
					$option .= "<option value='" . $row->KODE . "'>" . $row->NAMA . "</option>";
				}
			}
		} else {
			$option = "<option value=''>Data tidak ditemukan</option>";
		}

		return $option;
	}

	public function getKelurahanNew($kocam = "", $kokel = "") {
		$where = " AND ID_KECAMATAN = '" . $kocam . "' ";
		$sql = "SELECT ID, ID_KECAMATAN, NAMA FROM PERS_REF_KELURAHANDESA WHERE 1=1 " . $where;

		$query = $this->ci->db->query($sql);

		$option = "";

		foreach ($query->result() as $row) {
			if ($kokel == $row->ID) {
				$option .= "<option selected value='" . $row->ID . "'>" . $row->NAMA . "</option>";
			} else {
				$option .= "<option value='" . $row->ID . "'>" . $row->NAMA . "</option>";
			}
		}

		return $option;
	}

	public function getKelurahanNew2($kocam = "", $kokel = "") {
		if ($kocam != "") {
			$sql = 'SELECT KODE, NAMA FROM LOKASI
                    WHERE SUBSTR(KODE,0,8) = \'' . substr($kocam, 0, 8) . '\'
                    AND KODE <> \'' . $kocam . '\'
                    AND KODE NOT LIKE \'%.0000\'
                    AND DELETED IS NULL
                    ORDER BY NAMA ASC';

			$query = $this->ci->db->query($sql);

			$option = "";

			foreach ($query->result() as $row) {
				if ($kokel == $row->KODE) {
					$option .= "<option selected value='" . $row->KODE . "'>" . $row->NAMA . "</option>";
				} else {
					$option .= "<option value='" . $row->KODE . "'>" . $row->NAMA . "</option>";
				}
			}
		} else {
			$option = "<option value=''>Data tidak ditemukan</option>";
		}

		return $option;
	}

	public function getKelurahanNew2Add($kocam = "", $kokel = "") {
		if ($kocam != "") {
			$sql = 'SELECT KODE, NAMA FROM LOKASI
                    WHERE SUBSTR(KODE,0,8) = \'' . substr($kocam, 0, 8) . '\'
                    AND KODE <> \'' . $kocam . '\'
                    AND KODE NOT LIKE \'%.0000\'
                    AND AKTIF="Y"
                    AND DELETED IS NULL
                    ORDER BY NAMA ASC';

			$query = $this->ci->db->query($sql);

			$option = "";

			foreach ($query->result() as $row) {
				if ($kokel == $row->KODE) {
					$option .= "<option selected value='" . $row->KODE . "'>" . $row->NAMA . "</option>";
				} else {
					$option .= "<option value='" . $row->KODE . "'>" . $row->NAMA . "</option>";
				}
			}
		} else {
			$option = "<option value=''>Data tidak ditemukan</option>";
		}

		return $option;
	}

	public function getKelurahanNew3($kocam = '', $nakel = '') {

		$sql = 'SELECT KODE AS "id", NAMA AS "text"
                FROM LOKASI
                WHERE SUBSTR(KODE,0,8) = \'' . substr($kocam, 0, 8) . '\'
                AND NAMA LIKE \'%' . strtoupper($nakel) . '%\'
                AND KODE <> \'' . $kocam . '\'
                AND KODE NOT LIKE \'%.0000\'
                AND DELETED IS NULL
                ORDER BY NAMA ASC';
		// echo $sql;exit;
		$rs = $this->ci->db->query($sql)->result_array();

		// Make sure we have a result
		if ($rs) {
			$data = $rs;
		} else {
			$data[] = array('id' => '0', 'text' => 'Data tidak ditemukan');
		}

		return $data;
	}

	public function getPropinsi($prop = "") {
		$sql = "SELECT PROP, KETERANGAN FROM PERS_PROP_RPT";

		$query = $this->ci->db->query($sql);

		$option = "";

		foreach ($query->result() as $row) {
			if ($prop == $row->PROP) {
				$option .= "<option selected value='" . $row->PROP . "'>" . $row->PROP . "-" . $row->KETERANGAN . "</option>";
			} else {
				$option .= "<option value='" . $row->PROP . "'>" . $row->PROP . "-" . $row->KETERANGAN . "</option>";
			}
		}

		return $option;
	}

	public function getPropinsiNew($prop = "") {
		$sql = "SELECT ID, NAMA FROM PERS_REF_PROPINSI";

		$query = $this->ci->db->query($sql);

		$option = "";

		foreach ($query->result() as $row) {
			if ($prop == $row->ID) {
				$option .= "<option selected value='" . $row->ID . "'>" . $row->NAMA . "</option>";
			} else {
				$option .= "<option value='" . $row->ID . "'>" . $row->NAMA . "</option>";
			}
		}

		return $option;
	}

	public function getPropinsiNew2($prop = "") {
		$sql = "SELECT KODE, NAMA
                FROM LOKASI
                WHERE SUBSTR(KODE,3,11) = '.00.00.0000'
                AND DELETED IS NULL
                ORDER BY NAMA ASC";

		$query = $this->ci->db->query($sql);

		$option = "";

		foreach ($query->result() as $row) {
			if ($prop == $row->KODE) {
				$option .= "<option selected value='" . $row->KODE . "'>" . $row->NAMA . "</option>";
			} else {
				$option .= "<option value='" . $row->KODE . "'>" . $row->NAMA . "</option>";
			}
		}

		return $option;
	}

	public function getPropinsiNew2Add($prop = "") {
		$sql = "SELECT KODE, NAMA
                FROM LOKASI
                WHERE SUBSTR(KODE,3,11) = '.00.00.0000' AND AKTIF='Y'
                AND DELETED IS NULL
                ORDER BY NAMA ASC";

		$query = $this->ci->db->query($sql);

		$option = "";

		foreach ($query->result() as $row) {
			if ($prop == $row->KODE) {
				$option .= "<option selected value='" . $row->KODE . "'>" . $row->NAMA . "</option>";
			} else {
				$option .= "<option value='" . $row->KODE . "'>" . $row->NAMA . "</option>";
			}
		}

		return $option;
	}

	public function getPropinsiNew3($prop = '') {
		$sql = 'SELECT KODE AS "id", NAMA AS "text"
                FROM LOKASI
                WHERE SUBSTR(KODE,3,11) = \'.00.00.0000\'
                AND DELETED IS NULL
                AND UPPER(NAMA) LIKE \'%' . strtoupper($prop) . '%\'
                ORDER BY NAMA ASC';
		// echo $sql;exit;

		$rs = $this->ci->db->query($sql)->result_array();

		// Make sure we have a result
		if ($rs) {
			$data = $rs;
		} else {
			$data[] = array('id' => '0', 'text' => 'Data tidak ditemukan');
		}

		return $data;
	}

	public function getStatApp($statapp = "") {
		$sql = "SELECT KD_STATUS, KET_STATUS FROM PERS_STATUS_APPROVAL";

		$query = $this->ci->db->query($sql);

		$option = "";

		foreach ($query->result() as $row) {
			if ($statapp == $row->KD_STATUS) {
				$option .= "<option selected value='" . $row->KD_STATUS . "'>" . $row->KD_STATUS . " - " . $row->KET_STATUS . "</option>";
			} else {
				$option .= "<option value='" . $row->KD_STATUS . "'>" . $row->KD_STATUS . " - " . $row->KET_STATUS . "</option>";
			}
		}

		return $option;
	}

	function getListStawin($stawin = "") {
		$sql = "SELECT STAWIN, KETERANGAN FROM PERS_STAWIN_RPT";
		$id = $this->ci->db->query($sql);

		$option = "";
		foreach ($id->result() as $row) {
			if ($stawin == $row->STAWIN) {
				$option .= "<option selected value='" . $row->STAWIN . "'>" . $row->STAWIN . " - " . $row->KETERANGAN . "</option>";
			} else {
				$option .= "<option value='" . $row->STAWIN . "'>" . $row->STAWIN . " - " . $row->KETERANGAN . "</option>";
			}
		}

		return $option;
	}

	function getListAgamaValue($agama = "") {
		$sql = "SELECT AGAMA, KETERANGAN FROM PERS_AGAMA_RPT";
		$id = $this->ci->db->query($sql);
		$option = "";
		foreach ($id->result() as $row) {
			if ($agama == $row->AGAMA) {
				$option = $row->KETERANGAN;
			}
		}
		return $option;
	}

	function getListStawinValue($stawin = "") {
		$sql = "SELECT STAWIN, KETERANGAN FROM PERS_STAWIN_RPT";
		$id = $this->ci->db->query($sql);
		$option = "";
		foreach ($id->result() as $row) {
			if ($stawin == $row->STAWIN) {
				$option = $row->KETERANGAN;
			}
		}

		return $option;
	}

	function getListStapegValue($stapeg = "") {
		$sql = "SELECT STAPEG, KETERANGAN FROM PERS_STAPEG_RPT";
		$id = $this->ci->db->query($sql);
		$option = "";
		foreach ($id->result() as $row) {
			if ($stapeg == $row->STAPEG) {
				$option = $row->KETERANGAN;
			}
		}

		return $option;
	}

	function getListJenpegValue($jenpeg = "") {
		$sql = "SELECT JENPEG, KETERANGAN FROM PERS_JENPEG_RPT WHERE JENPEG ='" . $jenpeg . "'";
		$id = $this->ci->db->query($sql);
		$option = "";
		foreach ($id->result() as $row) {
			if ($jenpeg == $row->JENPEG) {
				$option = $row->KETERANGAN;
			}
		}

		return $option;
	}

	function getListKowilValue($kowil = "") {
		$sql = "SELECT KODE AS KOWIL, NAMA AS NAWIL
                FROM LOKASI
                WHERE KODE ='" . $kowil . "'
                AND DELETED IS NULL";
		$id = $this->ci->db->query($sql);
		$option = "";
		foreach ($id->result() as $row) {
			if ($kowil == $row->KOWIL) {
				$option = $row->NAWIL;
			}
		}
		return $option;
	}

	// function getListKowilValue($kowil=""){
	//     $sql = "SELECT KOWIL, NAWIL FROM PERS_KOWIL_TBL WHERE KOWIL ='".$kowil."'";
	//     $id = $this->ci->db->query($sql);
	//    $option="";
	//     foreach($id->result() as $row){
	//         if($kowil == $row->KOWIL){
	//             $option = $row->NAWIL;
	//         }
	//     }
	//     return $option;
	// }

	function getListKocamValue($kocam = "", $kowil = "") {
		$sql = "SELECT KODE AS KOCAM, NAMA AS NACAM
                FROM LOKASI
                WHERE KODE ='" . $kocam . "'
                AND DELETED IS NULL";
		$id = $this->ci->db->query($sql);
		$option = "";
		foreach ($id->result() as $row) {
			if ($kocam == $row->KOCAM) {
				$option = $row->NACAM;
			}
		}

		return $option;
	}

	// function getListKocamValue($kocam="",$kowil=""){
	//     $sql = "SELECT KOCAM, NACAM FROM PERS_KOCAM_TBL WHERE KOWIL ='".$kowil."' AND KOCAM ='".$kocam."'";
	//     $id = $this->ci->db->query($sql);
	//    $option="";
	//     foreach($id->result() as $row){
	//         if($kocam == $row->KOCAM){
	//             $option = $row->NACAM;
	//         }
	//     }

	//     return $option;
	// }

	function getListKokelValue($kokel = "", $kowil = "", $kocam = "") {
		$sql = "SELECT KODE AS KOKEL, NAMA AS NAKEL
                FROM LOKASI
                WHERE KODE ='" . $kokel . "'
                AND DELETED IS NULL";
		$id = $this->ci->db->query($sql);
		$option = "";
		foreach ($id->result() as $row) {
			if ($kokel == $row->KOKEL) {
				$option = $row->NAKEL;
			}
		}

		return $option;
	}

	// function getListKokelValue($kokel="",$kowil="",$kocam=""){
	//     $sql = "SELECT KOKEL, NAKEL FROM PERS_KOKEL_TBL WHERE KOWIL ='".$kowil."' AND KOCAM ='".$kocam."' AND KOKEL ='".$kokel."'";
	//     $id = $this->ci->db->query($sql);
	//     $option="";
	//     foreach($id->result() as $row){
	//         if($kokel == $row->KOKEL){
	//             $option = $row->NAKEL;
	//         }
	//     }

	//     return $option;
	// }

	function getListPropValue($prop = "") {
		$sql = "SELECT PROP, KETERANGAN FROM PERS_PROP_RPT WHERE PROP = '" . $prop . "'";
		$id = $this->ci->db->query($sql);
		$option = "";
		foreach ($id->result() as $row) {
			if ($prop == $row->PROP) {
				$option = $row->KETERANGAN;
			}
		}
		return $option;
	}

	function getListJendikcpsValue($jendikcps = "") {
		$sql = "SELECT JENDIK, KETERANGAN FROM PERS_JENDIK_RPT";
		$id = $this->ci->db->query($sql);

		$option = "";
		foreach ($id->result() as $row) {
			if ($jendikcps == $row->JENDIK) {
				$option = $row->KETERANGAN;
			} else {
				$option = '-';
			}
		}
		return $option;
	}

	function getListJendikcpsValue2($jendikcps = "") {
		$sql = "SELECT JENDIK, KETERANGAN FROM PERS_JENDIK_RPT WHERE JENDIK='$jendikcps'";
		$id = $this->ci->db->query($sql)->row();

		if ($id) {
			$option = $id->KETERANGAN;
		} else {
			$option = "-";
		}

		return $option;
	}

	function getListKodikcps($kodikcps = "") {
		$sql = "SELECT KODIK, NADIK FROM PERS_PDIDIKAN_TBL";
		$id = $this->ci->db->query($sql);

		$option = "";
		foreach ($id->result() as $row) {
			//echo $kodikcps.":".$row->KODIK."<br>";
			if ($kodikcps == $row->KODIK) {
				$option = $row->NADIK;
			} else {
				$option = '-';
			}
		}

		return $option;
	}

	function getListKodikcps2($kodikcps = "") {
		$sql = "SELECT KODIK, NADIK FROM PERS_PDIDIKAN_TBL WHERE KODIK = '$kodikcps' ";
		$id = $this->ci->db->query($sql)->row();

		if ($id) {
			$option = $id->NADIK;
		} else {
			$option = "-";
		}

		return $option;
	}

	public function getLastPangkat($nrk, $kopang = "") {

		if ($kopang != "") {
			$where = "AND a.KOPANG = '" . $kopang . "' ";
		} else {
			$where = "";
		}

		$sql = "SELECT a.KOPANG, b.NAPANG, to_char(a.TMT, 'DD-MM-YYYY') TMT, a.NOSK, to_char(a.TGSK, 'DD-MM-YYYY') TGSK,b.GOL
                FROM PERS_PANGKAT_HIST a
                LEFT JOIN PERS_PANGKAT_TBL b ON a.KOPANG = b.KOPANG
                WHERE a.NRK = '" . $nrk . "' AND ROWNUM <= 1 $where
                ORDER BY a.TMT DESC
                ";

		$query = $this->ci->db->query($sql)->row();

		return $query;
	}

	public function getKojabHistBy($nrk, $tmt, $kolok, $kojab) {
		$sql = "SELECT a.NRK, to_char(a.TMT, 'DD-MM-YYYY') TMT, a.NOSK, to_char(a.TGSK, 'DD-MM-YYYY') TGSK, a.KOLOK, a.KOJAB, a.CKOJABF,
                a.KDSORT, a.KREDIT, a.STATUS, a.PEJTT, to_char(a.TGAKHIR, 'DD-MM-YYYY') TGAKHIR, a.ESELON, a.KOPANG, a.KLOGAD, a.SPMU, to_char(a.TMTPENSIUN, 'DD-MM-YYYY') TMTPENSIUN, A .JENIS_SK
                FROM PERS_JABATAN_HIST a
                WHERE a.NRK = '" . $nrk . "' AND a.TMT = TO_DATE('" . $tmt . "', 'DD-MM-YYYY') AND a.KOLOK = '" . $kolok . "' AND a.KOJAB = '" . $kojab . "'
                ORDER BY a.TMT DESC, a.KOLOK, a.KOJAB
                ";
		// var_dump($sql);exit;

		$query = $this->ci->db->query($sql)->row();

		return $query;
	}

	public function getKojabfHistBy($nrk, $tmt, $kojab) {
		$sql = "SELECT a.NRK, to_char(a.TMT, 'DD-MM-YYYY') TMT, a.NOSK, to_char(a.TGSK, 'DD-MM-YYYY') TGSK, a.KOLOK, a.KOJAB,
                a.KDSORT, a.KREDIT, a.STATUS, a.PEJTT, to_char(a.TGAKHIR, 'DD-MM-YYYY') TGAKHIR, a.KOPANG,a.KLOGAD, a.SPMU, to_char(a.TMTPENSIUN, 'DD-MM-YYYY') TMTPENSIUN, A .JENIS_SK
                FROM PERS_JABATANF_HIST a
                WHERE a.NRK = '" . $nrk . "' AND a.TMT = TO_DATE('" . $tmt . "', 'DD-MM-YYYY') AND a.KOJAB = '" . $kojab . "'
                ORDER BY a.TMT DESC, a.KOLOK, a.KOJAB
                ";
		// var_dump($sql);exit;
		$query = $this->ci->db->query($sql)->row();

		return $query;
	}

	public function getPendidikanHistBy($nrk, $jendik, $kodik) {
		/*$sql = "SELECT NRK, JENDIK, KODIK, NASEK, UNIVER, KOTSEK, to_char(TGIJAZAH, 'DD-MM-YYYY') TGIJAZAH, NOIJAZAH,
			                to_char(TGACCKOP, 'DD-MM-YYYY') TGACCKOP, NOACCKOP, to_char(TGMULAI, 'DD-MM-YYYY') TGMULAI,
			                to_char(TGAKHIR, 'DD-MM-YYYY') TGAKHIR, JUMJAM, SELENGGARA, ANGKATAN,TITELDEPAN,TITELBELAKANG,STAT_APP
			                FROM PERS_PENDIDIKAN WHERE NRK = '".$nrk."' AND JENDIK = '".$jendik."' AND KODIK = '".$kodik."'
		*/

		$sql = "SELECT NRK, JENDIK, KODIK, NASEK, UNIVER, KOTSEK, to_char(TGIJAZAH, 'DD-MM-YYYY') TGIJAZAH, NOIJAZAH,
                to_char(TGACCKOP, 'DD-MM-YYYY') TGACCKOP, NOACCKOP, to_char(TGMULAI, 'DD-MM-YYYY') TGMULAI,
                to_char(TGAKHIR, 'DD-MM-YYYY') TGAKHIR, JUMJAM, SELENGGARA, ANGKATAN,TITELDEPAN,TITELBELAKANG,STAT_APP,to_char(TG_STLU, 'DD-MM-YYYY') TG_STLU, NO_STLU,KD_STLU
                FROM PERS_PENDIDIKAN WHERE NRK = '" . $nrk . "' AND JENDIK = '" . $jendik . "' AND KODIK = '" . $kodik . "'
                ";

		$query = $this->ci->db->query($sql)->row();

		return $query;
	}

	public function getTitel($nrk) {
		$sql = "SELECT NRK, TITEL, TITELDEPAN
                FROM PERS_PEGAWAI1
                WHERE NRK = '" . $nrk . "'";
		$query = $this->ci->db->query($sql)->row();

		return $query;
	}

	public function getGapokHistBy($nrk, $tmt, $gapok) {
		$sql = "SELECT NRK, TMT, GAPOK, JENRUB, KOPANG, TTMASKER, BBMASKER, TTMASYAD, BBMASYAD, KOLOK, NOSK, TGSK,KLOGAD, SPMU,TAHUN_REFGAJI,JENIS_SK
                FROM PERS_RB_GAPOK_HIST
                WHERE NRK = '" . $nrk . "' AND GAPOK = '" . $gapok . "' AND TMT = TO_DATE('" . $tmt . "', 'YYYY-MM-DD')
                ORDER BY TMT DESC
                ";
		// var_dump($sql);exit;
		$query = $this->ci->db->query($sql)->row();

		return $query;
	}

	public function getHukdisHistBy($nrk, $tgsk) {
		$sql = "SELECT NRK, TGSK, NOSK, JENHUKDIS, TGMULAI, TGAKHIR, PEJTT,TMTMULAI_STOPTKD,TMTAKHIR_STOPTKD, JMLBLN_STOPTKD, KET, JENIS_SK
                FROM PERS_DISIPLIN_HIST WHERE NRK = '" . $nrk . "' AND TGSK = TO_DATE('" . $tgsk . "', 'YYYY-MM-DD')
                ";

		$query = $this->ci->db->query($sql)->row();
		//var_dump($sql);exit;
		return $query;
	}

	public function getHukadmHistBy($nrk, $tgsk) {
		$sql = "SELECT NRK, TGSK, NOSK, JENHUKADM, TGMULAI, TGAKHIR, PEJTT,TMTMULAI_STOPTKD,TMTAKHIR_STOPTKD,JMLBLN_STOPTKD,KET
                FROM PERS_ADMIN_HIST WHERE NRK = '" . $nrk . "' AND TGSK = TO_DATE('" . $tgsk . "', 'YYYY-MM-DD')
                ";

		$query = $this->ci->db->query($sql)->row();

		return $query;
	}

	public function getDp3HistBy($nrk, $tahun) {
		$sql = "SELECT NRK, TAHUN, SETIA, PRESTASI, TGGJAWAB, TAAT, JUJUR, KERJASAMA, PRAKARSA, PIMPIN, JUMLAH, RATA
                FROM PERS_DP3 WHERE NRK = '" . $nrk . "' AND TAHUN = '" . $tahun . "'
                ";

		$query = $this->ci->db->query($sql)->row();

		return $query;
	}

	public function getSKPHistBy($nrk, $tahun) {
		$sql = "SELECT
                    A.NRK,
                    A.TAHUN,
                    A.PELAYANAN,
                    F_KET_SKP(A.PELAYANAN) AS KETPELAYANAN,
                    A.INTEGRITAS,
                    F_KET_SKP(A.INTEGRITAS) AS KETINTEGRITAS,
                    A.KOMITMEN,
                    F_KET_SKP(A.KOMITMEN) AS KETKOMITMEN,
                    A.DISIPLIN,
                    F_KET_SKP(A.DISIPLIN) AS KETDISIPLIN,
                    A.KERJASAMA,
                    F_KET_SKP(A.KERJASAMA) AS KETKERJASAMA,
                    A.KEPEMIMPINAN,
                    F_KET_SKP(A.KEPEMIMPINAN) AS KETKEPEMIMPINAN,
                    A.JUMLAH,
                    A.RATA2,
                    F_KET_SKP(A.RATA2) AS KETRATA2,
                    A.NILAI_SKP,
                    A.NILAI_PERILAKU,
                    A.NILAI_PRESTASI,
                    F_KET_SKP(A.NILAI_PRESTASI) AS KETPRESTASI,
                    A.STATUS_VALIDASI,
                    A.USERID_INPUT,
                    A.TGUPD_INPUT,
                    A.NRK_PEJABAT_PENILAI,
                    F_GET_NAMA(A.NRK_PEJABAT_PENILAI)NAMA_PEJABAT_PENILAI,
                    A.NRK_ATASAN_PEJABAT_PENILAI,
                    F_GET_NAMA(A.NRK_ATASAN_PEJABAT_PENILAI)NAMA_ATASAN_PEJABAT_PENILAI,
                    A.INPUT_SKP
                FROM
                    PERS_SKP A
                WHERE
                    NRK = '$nrk'
                AND TAHUN = '$tahun'";

		$query = $this->ci->db->query($sql)->row();

		return $query;
	}

	public function getAbsensiHistBy($nrk, $thbl) {
		$sql = "SELECT THBL, NRK, NIP18, NAMA_ABS, KLOGAD, NAKLOGAD, NAGOL, ALFA, IZIN, SAKIT, CUTI, JAMPULANGCEPAT,
                JAMTERLAMBAT, KINERJA, PERIODE, D_PROSES, E_PROSES, CUTIAPENTING, CUTIBERSALIN, CUTIBESAR, CUTISAKIT
                FROM PERS_TUNDA_ABSENSI WHERE NRK = '" . $nrk . "' AND THBL = '" . $thbl . "'
                ";

		$query = $this->ci->db->query($sql)->row();

		return $query;
	}

	public function getCutiHistBy($nrk, $tmt) {
		$sql = "SELECT NRK, TMT, JENCUTI, TGAKHIR, NOSK, TGSK, PEJTT, JENIS_SK
                FROM PERS_CUTI_HIST WHERE NRK = '" . $nrk . "' AND TMT = TO_DATE('" . $tmt . "', 'YY-MM-DD')
                ";

		$query = $this->ci->db->query($sql)->row();

		return $query;
	}

	public function getPembatasanHistBy($nrk, $tmt) {
		$sql = "SELECT NRK, TMT, JENUSAHA, TGAKHIR, TGSIZIN, PEJTT, NOSIZIN
                FROM PERS_PEMBATASAN WHERE NRK = '" . $nrk . "' AND TMT = TO_DATE('" . $tmt . "', 'YY-MM-DD')
                ";

		$query = $this->ci->db->query($sql)->row();

		return $query;
	}

	public function getSeminarHistBy($nrk, $tgmulai) {
		$sql = "SELECT NRK, TGMULAI, TGSELESAI, NASEMI, KDSEMI, KDTEMA, BADAN, TEMPAT, KDPERAN
                FROM PERS_SEMINAR_HIST WHERE NRK = '" . $nrk . "' AND TGMULAI = TO_DATE('" . $tgmulai . "', 'YY-MM-DD')
                ";

		$query = $this->ci->db->query($sql)->row();

		return $query;
	}

	public function getTulisanHistBy($nrk, $tgpublik) {
		$sql = "SELECT NRK, TGPUBLIK, JUDUL, KDTEMA, KDSIFAT, KDPERAN, KDLINGKUP, KDJUMKATA, MEDPUBLIK
                FROM PERS_TULISAN_HIST WHERE NRK = '" . $nrk . "' AND TGPUBLIK = TO_DATE('" . $tgpublik . "', 'YY-MM-DD')
                ";

		$query = $this->ci->db->query($sql)->row();

		return $query;
	}

	public function getAlamatHistBy($nrk, $tgmulai) {
		$sql = "SELECT NRK, TGMULAI,
                ALAMAT, RT, RW, KOWIL, KOCAM, KOKEL, PROP,
                ALAMAT_KTP, RT_KTP, RW_KTP, KOWIL_KTP, KOCAM_KTP, KOKEL_KTP, PROP_KTP,
                STAT_APP
                FROM PERS_ALAMAT_HIST WHERE NRK = '" . $nrk . "' AND TGMULAI = TO_DATE('" . $tgmulai . "', 'YY-MM-DD')
                ";

		$query = $this->ci->db->query($sql)->row();

		return $query;
	}

	public function getPenghargaanHistBy($nrk, $kdharga) {
		$sql = "SELECT NRK, KDHARGA, TGSK, NOSK, ASAL_HRG, JNASAL
                FROM PERS_PENGHARGAAN WHERE NRK = '" . $nrk . "' AND KDHARGA = '" . $kdharga . "'
                ";

		$query = $this->ci->db->query($sql)->row();

		return $query;
	}

	public function getOrganisasiHistBy($nrk, $dari) {
		$sql = "SELECT NRK, DARI, SBLSSD, NAORGANI, KDDUDUK, SAMPAI, KOTA
                FROM PERS_ORGAN_HIST WHERE NRK = '" . $nrk . "' AND DARI = TO_DATE('" . $dari . "', 'YY-MM-DD')
                ";

		$query = $this->ci->db->query($sql)->row();

		return $query;
	}

	public function getFasilitasHistBy($nrk, $jenfas, $thdapat) {
		$sql = "SELECT NRK, JENFAS, THDAPAT, THSAMPAI, INSTANSI, KETFAS, KOWIL,KOCAM,KOKEL, KLOGAD, SPMU
                FROM PERS_KESRA WHERE NRK = '" . $nrk . "' AND JENFAS = " . $jenfas . " AND THDAPAT = '" . $thdapat . "'
                ";

		$query = $this->ci->db->query($sql)->row();

		return $query;
	}

	public function getKeluargaHistBy($nrk, $hubkel) {
		/*$sql = "SELECT NRK, HUBKEL, NAMA, TEMHIR, TO_CHAR(TALHIR,'DD-MM-YYYY')TALHIR, TEMNIKAH, TGNIKAH,
			                STATTUN, KDKERJA, JENKEL, MATI, UANGDUKA,
			                NIK, NOAKTENIKAH, NOAKTECERAI, TGAKTECERAI,
			                NOAKTIFSEK, TGAKTIFSEK, NOSURATMATI, TGSURATMATI,STAT_APP,NO_SURAT_SKL,TO_CHAR(TO_DATE(TG_SURAT_TUN,'DD-MM-YYYY'))TG_SURAT_TUN,(FLOOR((SYSDATE-TALHIR)/365))UMUR
			                FROM PERS_KELUARGA WHERE NRK = '".$nrk."' AND HUBKEL = '".$hubkel."'
			                ";
		*/
		$sql = "SELECT A.NRK, A.HUBKEL, A.NAMA, A.TEMHIR, TO_CHAR(A.TALHIR,'DD-MM-YYYY')TALHIR, A.TEMNIKAH, A.TGNIKAH,
                A.STATTUN, A.KDKERJA, A.JENKEL, A.MATI, A.UANGDUKA,
                A.NIK, A.NOAKTENIKAH, A.NOAKTECERAI, A.TGAKTECERAI,A.NOSURATCERAI,A.TGSURATCERAI,
                A.NOAKTIFSEK, A.TGAKTIFSEK, A.NOSURATMATI, A.TGSURATMATI,A.STAT_APP,A.NO_SURAT_SKL,TO_CHAR(TO_DATE(A.TG_SURAT_TUN,'DD-MM-YYYY'))TG_SURAT_TUN,(FLOOR((SYSDATE-A.TALHIR)/365))UMUR,B.NOPPEN
                FROM PERS_KELUARGA A
LEFT JOIN PERS_PEGAWAI2 B ON A.NRK = B.NRK
WHERE A.NRK = '" . $nrk . "' AND A.HUBKEL = '" . $hubkel . "'";

		$query = $this->ci->db->query($sql)->row();

		return $query;
	}

	public function getNIKpegawai($nrk) {
		$sql = "SELECT NOPPEN FROM PERS_PEGAWAI2 where NRK='" . $nrk . "'";

		$query = $this->ci->db->query($sql)->row();

		return $query;
	}

	public function getLP2PHistBy($thpajak, $nrk) {
		$sql = "SELECT THPAJAK, NRK, NIP, NIP18,NAMA,KOLOK, NALOK,GOL,RUANG,TMTPANGKAT,NAJAB,TMTESELON, TALHIR, PATHIR, ALAMAT, RTALAMAT,
                RWALAMAT,KELURAHAN,KECAMATAN,JENKEL, STAWIN,NAMISU, PEKERJAAN, JUAN, JIWA, KDWEWENANG,NOFORM,KODE2, KOJAB, KOJABF, KD, ESELON, SPMU, KLOGAD, KODUK, THLAPOR,PEJABAT
                FROM PERS_LP2P_HIST WHERE THPAJAK = '" . $thpajak . "' AND NRK = '" . $nrk . "'
                ";

		$query = $this->ci->db->query($sql)->row();

		return $query;
	}

	public function getLitsusHistBy($nrk, $tgl) {
		$sql = "SELECT NRK, TGL, DASAR, KEPERLUAN, HASIL, PEMERIKSA_AWAL, PEMERIKSA_ULANG, KOPANG_PEMERIKSA,NOKTP,BAPAK_TIRI, IBU_TIRI,
                NOMOR_CT, NOMOR_SKHP,KOTA_LITSUS
                FROM PERS_LITSUS WHERE NRK = '" . $nrk . " AND TGL = TO_DATE('" . $tgl . "', 'YY-MM-DD')
                ";

		$query = $this->ci->db->query($sql)->row();

		return $query;
	}

	public function getTupoksiBy($nrk, $tupoksi_id) {
		$sql = "SELECT tupoksi_id,kolok,kojab,no_urut,uraian,tahun,dasar_hukum,aktif
                FROM ref_tupoksi  WHERE tupoksi_id = " . $tupoksi_id . "
                ";

		$query = $this->ekine16->query($sql)->row();

		return $query;
	}

	public function getTotPegawai2() {
		$sql = "SELECT COUNT(NRK) AS TOTPEG
                FROM PERS_PEGAWAI1
                WHERE TMTPENSIUN IS NOT NULL
                OR KDMATI='Y'
                ";
		$query = $this->ci->db->query($sql)->row();

		return $query->TOTPEG;
	}

	public function getTotPegawai() {
		$thbl = date('Ym');
		$sql = "SELECT COUNT(NRK) AS TOTPEG
                FROM PERS_DUK_PANGKAT_HISTDUK
                WHERE THBL='$thbl'
                ";
		$query = $this->ci->db->query($sql)->row();

		return $query->TOTPEG;
	}

	public function getTotPegawaiPns() {
		$thbl = date('Ym');
		$sql = "SELECT COUNT(NRK) AS TOTPEG
                FROM PERS_DUK_PANGKAT_HISTDUK
                WHERE THBL='$thbl'
                AND STAPEG='1'";
		$query = $this->ci->db->query($sql)->row();

		return $query->TOTPEG;
	}

	public function getTotPegawaiCpns() {
		$thbl = date('Ym');
		$sql = "SELECT COUNT(NRK) AS TOTPEG
                FROM PERS_DUK_PANGKAT_HISTDUK
                WHERE THBL='$thbl'
                AND STAPEG='2'";
		$query = $this->ci->db->query($sql)->row();

		return $query->TOTPEG;
	}

	public function check_hukdis_database($nrk, $tipe) {
		if ($tipe == '3') {
			//$date_now = date('Y-m-d');
			//$sql = "SELECT * FROM SIMPEG.PERS_DISIPLIN_HIST WHERE JENHUKDIS = 8 AND NRK = {$nrk} AND TGAKHIR >= TO_DATE('".$date_now."', 'YY-MM-DD')";
			$sql = "SELECT COUNT(*) AS RES FROM PERS_DISIPLIN_HIST WHERE JENHUKDIS = 8 AND NRK = {$nrk} AND TGAKHIR >= SYSDATE";
		} elseif ($tipe == '4') {
			//$date_now = date('Y-m-d');
			//$sql = "SELECT * FROM SIMPEG.PERS_DISIPLIN_HIST WHERE JENHUKDIS = 8 AND NRK = {$nrk} AND TGAKHIR >= TO_DATE('".$date_now."', 'YY-MM-DD')";
			$sql = "SELECT COUNT(*) AS RES FROM PERS_DISIPLIN_HIST WHERE JENHUKDIS IN(9, 13) AND NRK = {$nrk} AND TGAKHIR >= SYSDATE";
		}
		$result = $this->ci->db->query($sql)->row();
		//$sql = "SELECT * FROM PERS_DISIPLIN_HIST WHERE NRK = {$nrk} AND {$date_now}";
		return $result;
	}

	function hakAksesModul($modul, $group) {
		// ,\"act_delete_flag\"
		$q = "SELECT \"alias\",\"act_view\",\"act_insert\",\"act_update\",\"act_resetpass\",\"act_delete\"
            FROM \"menu_access_user_gaji\" A
            LEFT JOIN \"menu_master_gaji\" B ON A.\"menu_id\"=B.\"id_menu\"
            WHERE \"id_menu\"='$modul'
            AND \"user_group_id\"='$group'";

		$r = $this->ci->db->query($q)->row();

		return $r;

	}

}