<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class Sisir_tkd {

	private $ci;
	private $ekin234;

	function __construct()
    {
        $this->ci =& get_instance();
        $this->ci->load->database(); 
        $this->ci->load->library('convert');
        $this->ekin234 = $this->ci->load->database('ekin234', TRUE);
    }    

    public function getDataSisirTkdTahap1($nrk){
        $sql = "SELECT a.thbl, a.nrk, a.nama, a.kolok, pers_lokasi_tbl.nalokl, a.kopang, a.eselon, a.pathir, a.talhir, a.kojab, a.spmu, a.kinerja, a.ntkd, a.njtundabersih, a.npotabsen,
				a.potcuti, a.ket, b.tkd_dinamis1, b.tkd_dinamis2, b.tkd_dinamis3, b.tkd_dinamis_total
				FROM pers_duk_pangkat_hist a
				INNER JOIN pers_lokasi_tbl ON a.kolok = pers_lokasi_tbl.kolok
				LEFT JOIN pers_duk_pangkat_hist_dinamis b ON a.nrk = b.nrk AND a.thbl = b.thbl
				WHERE a.nrk = '".$nrk."' AND a.thbl IN ('201501', '201502', '201503')
				";

        $query = $this->ekin234->query($sql);      

        $table = "
						<div class='ibox-content'>
						<div class='table-responsive'>
					<table class='table table-striped table-bordered table-hover  dataTables-example' >
                    <thead>
                    <tr>
                        <th style='width:10px'>No</th>
                        <th style='width:50px'>Tahun-Bulan</th>
                        <th style='width:50px'>Lokasi Kerja</th>
                        <th style='width:50px'>Jabatan</th>
                        <th style='width:50px'>Kinerja</th>
                        <th style='width:50px'>TKD Kotor</th>
                        <th style='width:50px'>Total Potongan<br>Cuti<br>Absensi</th>
                        <th style='width:50px'>TKD Statis</th>
                        <th style='width:50px'>TKD Dinamis Jan</th>
                        <th style='width:50px'>TKD Dinamis Feb</th>
                        <th>TKD Dinamis Mar</th>
                        <th>Total</th>
                        <th>Keterangan</th>
                    </tr>
                    </thead>
                    <tbody>";
        
        $no = 1;
        foreach($query->result() as $r){            
            $query1 = $this->ci->db->query("SELECT NALOKL FROM PERS_LOKASI_TBL WHERE KOLOK = '".$r->kolok."'");
            $rl = $query1->row();
			
          	$query2 = $this->ci->db->query("SELECT NAJABL,POINT FROM PERS_KOJAB_TBL WHERE KOLOK = '".$r->kolok."' AND KOJAB = '".$r->kojab."'");
          	$rj = $query2->row();     	
          	
            	if ($query2->num_rows() <= 0){        		
          		$query2 = $this->ci->db->query("SELECT NAJABL,POINT FROM PERS_KOJABF_TBL WHERE KOJAB = '".$r->kojab."'");
          		$rj = $query2->row();     	
          	}

            $potongan = floatval($r->potcuti) + floatval($r->npotabsen);
            $potongans = number_format($potongan,0,",",".");
            $ntkds = number_format($r->ntkd,0,",",".");
            $potcutis = number_format($r->potcuti,0,",",".");
            $npotabsens = number_format($r->npotabsen,0,",",".");
            $njtundabersihs = number_format($r->njtundabersih,0,",",".");
            $tkd_dinamis1s = number_format($r->tkd_dinamis1,0,",",".");
            $tkd_dinamis2s = number_format($r->tkd_dinamis2,0,",",".");
            $tkd_dinamis3s = number_format($r->tkd_dinamis3,0,",",".");
            $tkd_dinamis_totals = number_format($r->tkd_dinamis_total,0,",",".");
            $bulan   = $this->ci->convert->convertKeNamaBulan(substr($r->thbl,4,2)); // konversi menjadi nama bulan bahasa indonesia
            $tahun   = substr($r->thbl,0,4);
	
    		$table .= "<tr><td align=\"center\">".$no."</td>
                  <td>".$tahun." - ".$bulan."</td> 
                  <td>".$rl->NALOKL."<br>".$r->kolok."</td> 
                  <td>".$rj->NAJABL."<br>".$r->kojab."</td> 
                  <td align='right'>".$r->kinerja."</td>
                  <td align='right'>".$ntkds."</td> 
                  <td align='right' class=\"text-danger\"><strong><span  class=\"text-success\">".$potongans."</span></strong><br>".$potcutis."<br>".$npotabsens."</td>
                  <td align='right'>".$njtundabersihs."</td>
                  <td align='right'>".$tkd_dinamis1s."</td>
                  <td align='right'>".$tkd_dinamis2s."</td>
                  <td align='right'>".$tkd_dinamis3s."</td>
                  <td align='right'>".$tkd_dinamis_totals."</td>
                  <td>".$r->ket."</td>
                  </tr>";
            $no++;
        }       

        $table .= "</tbody>
                    <tfoot>
                    <tr>
                        <th>No</th>
                        <th>Tahun-Bulan</th>
                        <th>Lokasi Kerja</th>
                        <th>Jabatan</th>
                        <th>Kinerja</th>
                        <th>TKD Kotor</th>
                        <th>Total Potongan<br>Cuti<br>Absensi</th>
                        <th>TKD Statis</th>
                        <th>TKD Dinamis Jan</th>
                        <th>TKD Dinamis Feb</th>
                        <th>TKD Dinamis Mar</th>
                        <th>Total</th>
                        <th>Keterangan</th>
                    </tr>
                    </tfoot>
                    </table>
					</div>
					</div>";

        return $table;
    }


    public function getDataSisirTkdTahap2($nrk){
        $sql = "SELECT proses_tkd_tahap2.nrk, proses_tkd_tahap2.thbl, proses_tkd_tahap2.kolok, proses_tkd_tahap2.kojab, proses_tkd_tahap2.kd, proses_tkd_tahap2.tkd_ekin,proses_tkd_tahap2.kinerja, 
                proses_tkd_tahap2.ntkd, proses_tkd_tahap2.tahap1, proses_tkd_tahap2.npotabsen,proses_tkd_tahap2.potcuti, proses_tkd_tahap2.njtundabersih, proses_tkd_tahap2.ket
                FROM proses_tkd_tahap2
                WHERE proses_tkd_tahap2.nrk = '".$nrk."' AND thbl <='201512'
        ";

        $query = $this->ekin234->query($sql);      

        $table = "<table class=\"table table-striped table-bordered table-hover dataTables-example\" >
                    <thead>
                    <tr>
                        <th>No</th>
                        <th>Tahun-Bulan</th>
                        <th>Lokasi Kerja</th>
                        <th>Jabatan</th>
                        <th>Kinerja</th>
                        <th>TKD Kotor</th>
                        <th>TKD Tahap I</th>
                        <th>Total Potongan<br>Cuti<br>Absensi</th>
                        <th>TKD Tahap I Bersih</th>
                        <th>Keterangan</th>
                    </tr>
                    </thead>
                    <tbody>";
        
        $no = 1;
        foreach($query->result() as $r){            
            $query1 = $this->ci->db->query("SELECT NALOKL FROM PERS_LOKASI_TBL WHERE KOLOK = '".$r->kolok."'");
            $rl = $query1->row();
      
            $query2 = $this->ci->db->query("SELECT NAJABL,POINT FROM PERS_KOJAB_TBL WHERE KOLOK = '".$r->kolok."' AND KOJAB = '".$r->kojab."'");
            $rj = $query2->row();       
            
              if ($query2->num_rows() <= 0){            
              $query2 = $this->ci->db->query("SELECT NAJABL,POINT FROM PERS_KOJABF_TBL WHERE KOJAB = '".$r->kojab."'");
              $rj = $query2->row();       
            }

            $potongan = floatval($r->potcuti) + floatval($r->npotabsen);
            $potongans = number_format($potongan,0,",",".");
            $ntkds = number_format($r->ntkd,0,",",".");
            $tahap1s = number_format($r->tahap1,0,",",".");
            $potcutis = number_format($r->potcuti,0,",",".");
            $npotabsens = number_format($r->npotabsen,0,",",".");
            $njtundabersihs = number_format($r->njtundabersih,0,",",".");
            $bulan   = $this->ci->convert->convertKeNamaBulan(substr($r->thbl,4,2)); // konversi menjadi nama bulan bahasa indonesia
            $tahun   = substr($r->thbl,0,4);

            $table .= "<tr><td align=\"center\">".$no."</td>
                      <td>".$tahun." - ".$bulan."</td> 
                      <td>".$rl->NALOKL."<br>".$r->kolok."</td> 
                      <td>".$rj->NAJABL."<br>".$r->kojab."</td> 
                      <td align='right'>".$r->kinerja."</td>
                      <td align='right'>".$ntkds."</td> 
                      <td align='right'>".$tahap1s."</td> 
                      <td align='right' class=\"text-danger\"><strong><span  class=\"text-success\">".$potongans."</span></strong><br>".$potcutis."<br>".$npotabsens."</td>
                      <td align='right'>".$njtundabersihs."</td>
                     <td>".$r->ket."</td>
                          </tr>";
            $no++;
        }       

        $table .= "</tbody>
                    <tfoot>
                    <tr>
                        <th>No</th>
                        <th>Tahun-Bulan</th>
                        <th>Lokasi Kerja</th>
                        <th>Jabatan</th>
                        <th>Kinerja</th>
                        <th>TKD Kotor</th>
                        <th>TKD Tahap I</th>
                        <th>Total Potongan<br>Cuti<br>Absensi</th>
                        <th>TKD Tahap I Bersih</th>
                        <th>Keterangan</th>
                    </tr>
                    </tfoot>
                    </table>";

        return $table;
    }

    public function getDataTkdGuru($nrk){
        $sql = "SELECT proses_tkd_guru.nrk,proses_tkd_guru.thbl,proses_tkd_guru.kolok,proses_tkd_guru.kojab,proses_tkd_guru.kd,proses_tkd_guru.tkd_ekin,proses_tkd_guru.kinerja,
                proses_tkd_guru.ntkd,proses_tkd_guru.tahap1,proses_tkd_guru.npotabsen,proses_tkd_guru.potcuti,proses_tkd_guru.njtundabersih, proses_tkd_guru.ket
                FROM proses_tkd_guru
                WHERE proses_tkd_guru.nrk = '".$nrk."' AND thbl <='201512'
                ORDER by thbl, nrk
                ";

        $query = $this->ekin234->query($sql);      

        $table = "<table class=\"table table-striped table-bordered table-hover dataTables-example\" >
                    <thead>
                    <tr>
                        <th>No</th>
                        <th>Tahun-Bulan</th>
                        <th>Lokasi Kerja</th>
                        <th>Jabatan</th>
                        <th>Kinerja</th>
                        <th>TKD Kotor</th>
                        <th>TKD Tahap I</th>
                        <th>Total Potongan<br>Cuti<br>Absensi</th>
                        <th>TKD Tahap I Bersih</th>
                        <th>Keterangan</th>
                    </tr>
                    </thead>
                    <tbody>";
        
        $no = 1;
        foreach($query->result() as $r){            
            $query1 = $this->ci->db->query("SELECT NALOKL FROM PERS_LOKASI_TBL WHERE KOLOK = '".$r->kolok."'");
            $rl = $query1->row();
      
            $query2 = $this->ci->db->query("SELECT NAJABL,POINT FROM PERS_KOJAB_TBL WHERE KOLOK = '".$r->kolok."' AND KOJAB = '".$r->kojab."'");
            $rj = $query2->row();       
            
              if ($query2->num_rows() <= 0){            
              $query2 = $this->ci->db->query("SELECT NAJABL,POINT FROM PERS_KOJABF_TBL WHERE KOJAB = '".$r->kojab."'");
              $rj = $query2->row();       
            }

            $potongan = floatval($r->potcuti) + floatval($r->npotabsen);
            $potongans = number_format($potongan,0,",",".");
            $ntkds = number_format($r->ntkd,0,",",".");
            $tahap1s = number_format($r->tahap1,0,",",".");
            $potcutis = number_format($r->potcuti,0,",",".");
            $npotabsens = number_format($r->npotabsen,0,",",".");
            $njtundabersihs = number_format($r->njtundabersih,0,",",".");
            $bulan   = $this->ci->convert->convertKeNamaBulan(substr($r->thbl,4,2)); // konversi menjadi nama bulan bahasa indonesia
            $tahun   = substr($r->thbl,0,4);

            $table .= "<tr><td align=\"center\">".$no."</td>
                      <td>".$tahun." - ".$bulan."</td> 
                      <td>".$rl->NALOKL."<br>".$r->kolok."</td> 
                      <td>".$rj->NAJABL."<br>".$r->kojab."</td> 
                      <td align='right'>".$r->kinerja."</td>
                      <td align='right'>".$ntkds."</td> 
                      <td align='right'>".$tahap1s."</td> 
                      <td align='right' class=\"text-danger\"><strong><span  class=\"text-success\">".$potongans."</span></strong><br>".$potcutis."<br>".$npotabsens."</td>
                      <td align='right'>".$njtundabersihs."</td>
                     <td>".$r->ket."</td>
                          </tr>";
            $no++;
        }       

        $table .= "</tbody>
                    <tfoot>
                    <tr>
                        <th>No</th>
                        <th>Tahun-Bulan</th>
                        <th>Lokasi Kerja</th>
                        <th>Jabatan</th>
                        <th>Kinerja</th>
                        <th>TKD Kotor</th>
                        <th>TKD Tahap I</th>
                        <th>Total Potongan<br>Cuti<br>Absensi</th>
                        <th>TKD Tahap I Bersih</th>
                        <th>Keterangan</th>
                    </tr>
                    </tfoot>
                    </table>";

        return $table;
    }

    public function getDataGajiPegawai($nrk){
        $sql = "SELECT nrk, thbl, kolok, kojab, gol, masker, stapeg, kd, spmu, klogad, kpn, juan, jiwa, simpeda, gapok, tunjab, tunfung, njumbergaji, njumpotgaji, 
                npphgaji, nptlain, naskes,ntht, ntaspen, npberas, njumkot, ntunlai, ntberas, ntanak, ntistri, ntpphgaji, npbulat, njumbergaji, njumpotgaji
                FROM pers_duk_pangkat_histduk
                WHERE nrk = '".$nrk."'
                ";

        $query = $this->ekin234->query($sql);      

        $table = "<table class=\"table table-striped table-bordered table-hover dataTables-example\" >
                    <thead>
                    <tr>
                        <th>No</th>
                        <th>Tahun-Bulan</th>
                        <th>Lokasi Kerja / Jabatan</th>
                        <th>Gaji Pokok</th>
                        <th>Tunjangan
                        <br>Jabatan<br>Fungsional</th>
                        <th>Tunjangan<br>
                        Beras<br>
                        Anak<br>
                        Istri<br>
                        PPH</th>
                        <th>Gaji Kotor</th>
                        <th>Potongan<br>PPH<br>Askes<br>Taspen<br>THT<br>Lain2</th>
                        <th>Gaji Bersih</th>
                        <th>Detil</th>
                    </tr>
                    </thead>
                    <tbody>";
        
        $no = 1;
        foreach($query->result() as $r){            
            $query1 = $this->ci->db->query("SELECT NALOKL FROM PERS_LOKASI_TBL WHERE KOLOK = '".$r->kolok."'");
            $rl = $query1->row();
      
            $query2 = $this->ci->db->query("SELECT NAJABL,POINT FROM PERS_KOJAB_TBL WHERE KOLOK = '".$r->kolok."' AND KOJAB = '".$r->kojab."'");
            $rj = $query2->row();       
            
              if ($query2->num_rows() <= 0){            
              $query2 = $this->ci->db->query("SELECT NAJABL,POINT FROM PERS_KOJABF_TBL WHERE KOJAB = '".$r->kojab."'");
              $rj = $query2->row();       
            }

            $potongan=0;
            $potongan = floatval($r->npphgaji) + floatval($r->naskes) 
                        + floatval($r->ntaspen) + floatval($r->ntht) + floatval($r->nptlain) ;
            $gajikotor = floatval($r->gapok) + floatval($r->tunjab) 
                        + floatval($r->tunfung) + floatval($r->ntberas)
                        + floatval($r->ntanak) + floatval($r->ntistri);
            $tunja = floatval($r->tunjab) + floatval($r->tunfung);
            $tunj = floatval($r->ntberas) + floatval($r->ntanak) 
            + floatval($r->ntistri) + floatval($r->ntpphgaji);
            $potongans = number_format($potongan,0,",",".");
            $tunjs = number_format($tunj,0,",",".");
            $tunjas = number_format($tunja,0,",",".");
            $gajikotors = number_format($gajikotor,0,",",".");
            $npphgajis = number_format($r->npphgaji,0,",",".");
            $naskess = number_format($r->naskes,0,",",".");
            $ntaspens = number_format($r->ntaspen,0,",",".");
            $nthts = number_format($r->ntht,0,",",".");
            $nptlains = number_format($r->nptlain,0,",",".");
            $gapoks = number_format($r->gapok,0,",",".");
            $tunjabs = number_format($r->tunjab,0,",",".");
            $tunfungs = number_format($r->tunfung,0,",",".");
            $ntberass = number_format($r->ntberas,0,",",".");
            $ntanaks = number_format($r->ntanak,0,",",".");
            $ntistris = number_format($r->ntistri,0,",",".");
            $ntpphgajis = number_format($r->ntpphgaji,0,",",".");
            $njumbergajis = number_format($r->njumbergaji,0,",",".");
            $njumpotgajis = number_format($r->njumpotgaji,0,",",".");

            $bulan   = $this->ci->convert->convertKeNamaBulan(substr($r->thbl,4,2)); // konversi menjadi nama bulan bahasa indonesia
            $tahun   = substr($r->thbl,0,4);
    
            $table .= "<tr><td align=\"center\">$no</td>
                                <td>".$tahun." - ".$bulan."</td>                             
                                <td>".$rl->NALOKL."<br>".$r->kolok."<br>".$rj->NAJABL."<br>".$r->kojab."</td> 
                                <td align='right'>".$gapoks."</td>
                                <td align='right'><span  class=\"text-success\">".$tunjas."</span>
                                <br>$tunjabs<br>".$tunfungs."</td>
                                <td align='right'><span  class=\"text-success\">".$tunjs."</span>
                                <br>$ntberass<br>$ntanaks<br>$ntistris<br>".$ntpphgajis."</td>
                                <td align='right'>".$gajikotors."</td>
                                <td align='right' class=\"text-danger\"><span  class=\"text-success\">".$potongans."</span><br>".$npphgajis."
                                <br>".$naskess."<br>".$ntaspens."<br>".$nthts."<br>".$nptlains."</td>
                                <td align='right'><span  class=\"text-navy\"><strong>".$njumbergajis."</span></strong></td>
                                      <td align='center'><a href=\"#&id=".$r->nrk."\">
                                       <i class=\"fa fa-folder-open\"> </i></a></td>
                          </tr>";
            $no++;
        }       

        $table .= "</tbody>
                    <tfoot>
                    <tr>
                        <th>No</th>
                        <th>Tahun-Bulan</th>
                        <th>Lokasi Kerja / Jabatan</th>
                        <th>Gaji Pokok</th>
                        <th>Tunjangan
                        <br>Jabatan<br>Fungsional</th>
                        <th>Tunjangan<br>
                        Beras<br>
                        Anak<br>
                        Istri<br>
                        PPH</th>
                        <th>Gaji Kotor</th>
                        <th>Potongan<br>PPH<br>Askes<br>Taspen<br>THT<br>Lain2</th>
                        <th>Gaji Bersih</th>
                        <th>Detil</th>
                    </tr>
                    </tfoot>
                    </table>";

        return $table;
    }


}