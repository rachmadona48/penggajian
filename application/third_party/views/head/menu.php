<nav class="navbar-default navbar-static-side" role="navigation">
	<div class="sidebar-collapse">
		<ul class="nav metismenu" id="side-menu">
			<li class="nav-header">
				<div class="dropdown profile-element"> <span>

					<?php 
						$linkImg = "assets/img/photo/".$id.".jpg";
						$img_small = "";
	                    if(file_exists($linkImg)){
	                        $img = base_url()."assets/img/photo/".$id.".jpg";
	                        $img_small = base_url()."assets/img/photo/".$id."_thumb.jpg";
	                    }else{
	                        $img = base_url()."assets/img/photo/profile_getProfile.jpg";  
	                        $img_small = base_url()."assets/img/photo/profile_getProfile.jpg";                                  
	                    }

					?>

					<a href="<?php echo $img; ?>" title="Image from Unsplash" data-gallery="">
						<img alt="image" class="img-box m-t-xs img-responsive" src="<?php echo $img_small; ?>" width="68px" height="68px" style="border-radius:10px;">
					</a>	
                    </span>
                    <!-- The Gallery as lightbox dialog, should be a child element of the document body -->
                            <div id="blueimp-gallery" class="blueimp-gallery">
                                <div class="slides"></div>
                                <h3 class="title"></h3>
                                <a class="prev">‹</a>
                                <a class="next">›</a>
                                <a class="close">×</a>
                                <a class="play-pause"></a>
                                <ol class="indicator"></ol>
                            </div>
                    <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                            <span class="clear"> <span class="block m-t-xs"> <strong class="font-bold"><?php echo $username; ?></strong>
                              <b class="caret"></b></span> </span> </a>
                    <ul class="dropdown-menu animated fadeInRight m-t-xs">
					 <li><a data-toggle="modal" class="" href="#modal-pass"><i class="fa fa-user"></i> Ubah Password</a></li>
						

					 <li><a data-toggle="modal" class="" href="#modal-upload"><i class="fa fa-file-image-o"></i> &nbsp;&nbsp;Upload Photo</a></li>
					 <li class="divider"></li>
<!--						<li><a href="#">Profile</a></li>-->
<!--						<li><a href="#">Contacts</a></li>-->
<!--						<li><a href="#">Mailbox</a></li>-->
<!--                        <li><a href="#">Logout</a></li>-->
                    </ul>

				</div>
				<div class="logo-element">
					SIMPEG
				</div>
			</li>
				<?php 
					echo $activemn;
				?>
	
			
			<li style="display:none;">
				<a href="#"><i class="fa fa-gears"></i> <span class="nav-label">Master Hist</span><span class="fa arrow"></span></a>
				<ul class="nav nav-second-level">
					<li><a href="<?php echo base_url(); ?>index.php/hist/admin_hist">Admin</a></li>
					<li><a href="<?php echo base_url(); ?>index.php/hist/alamat_hist">Alamat</a></li>
					<li><a href="<?php echo base_url(); ?>index.php/hist/disiplin_hist">Hukuman Disiplin</a></li>
					<li><a href="<?php echo base_url(); ?>index.php/hist/jabatan_hist">Jabatan Struktural</a></li>
					<li><a href="<?php echo base_url(); ?>index.php/hist/jabatanf_hist">Jabatan Fungsional</a></li>
					<li><a href="<?php echo base_url(); ?>index.php/hist/cuti_hist">Cuti</a></li>
					<!--<li><a href="#">Keluarga Pegawai</a></li>-->			
					<li><a href="<?php echo base_url(); ?>index.php/hist/kunjung_hist">Kunjungan</a></li>
					<li><a href="<?php echo base_url(); ?>index.php/hist/lp2p_hist">LP2P</a></li>
					<li><a href="<?php echo base_url(); ?>index.php/hist/organ_hist">Organisasi Pegawai</a></li>
					<li><a href="<?php echo base_url(); ?>index.php/hist/pangkat_hist">Pangkat Pegawai</a></li>
					<li><a href="<?php echo base_url(); ?>index.php/hist/pegawai1">Pegawai1</a></li>
					<li><a href="<?php echo base_url(); ?>index.php/hist/pegawai2">Pegawai2</a></li>
					<li><a href="<?php echo base_url(); ?>index.php/hist/pendidikan_hist">Pendidikan Pegawai</a></li>
					<li><a href="<?php echo base_url(); ?>index.php/hist/penghargaan_hist">Penghargaan</a></li>
					<li><a href="<?php echo base_url(); ?>index.php/hist/rb_gapok_hist">RB Gaji Pokok</a></li>
					<li><a href="<?php echo base_url(); ?>index.php/hist/seminar_hist">Seminar</a></li>
					<li><a href="<?php echo base_url(); ?>index.php/hist/tpp_ptt_hist">TPP PTT</a></li>
					<li><a href="<?php echo base_url(); ?>index.php/hist/tulisan_hist">Tulisan</a></li>
					<li><a href="<?php echo base_url(); ?>index.php/hist/tunda_absensi">Tunda Absensi</a></li>
				</ul>
			</li>
			<li style="display:none;">
				<a href="#"><i class="fa fa-gears"></i> <span class="nav-label">Master RPT/TBL</span><span class="fa arrow"></span></a>
				<ul class="nav nav-second-level">
					<li><a href="<?php echo base_url(); ?>index.php/master/agama">Agama</a></li>
					<li><a href="<?php echo base_url(); ?>index.php/master/eselon/rpt">Eselon RPT</a></li>
					<li><a href="<?php echo base_url(); ?>index.php/master/eselon">Eselon</a></li>
					<li><a href="<?php echo base_url(); ?>index.php/master/gajiptt">Gaji PTT</a></li>
					<li><a href="<?php echo base_url(); ?>index.php/master/gapok">Gaji Pokok</a></li>
					<li><a href="<?php echo base_url(); ?>index.php/master/hargaan">Hargaan</a></li>
					<li><a href="<?php echo base_url(); ?>index.php/master/hubkel">Hubungan Keluarga</a></li>
					<li><a href="<?php echo base_url(); ?>index.php/master/induk">Induk Departemen</a></li>
					<li><a href="<?php echo base_url(); ?>index.php/master/instansi">Instansi</a></li>
					<li><a href="<?php echo base_url(); ?>index.php/master/jencuti">Jenis Cuti</a></li>
					<li><a href="<?php echo base_url(); ?>index.php/master/jendik">Jenis Pendidikan</a></li>
					<li><a href="<?php echo base_url(); ?>index.php/master/jenfas">Jenis Fasilitas</a></li>
					<li><a href="<?php echo base_url(); ?>index.php/master/jenhukadm">Jenis Hukuman Administrasi</a></li>
					<li><a href="<?php echo base_url(); ?>index.php/master/jenhukdis">Jenis Hukuman Disiplin</a></li>
					<li><a href="<?php echo base_url(); ?>index.php/master/jenpeg">Jenis Pegawai</a></li>
					<li><a href="<?php echo base_url(); ?>index.php/master/jenrub">Jenis Rub</a></li>
					<li><a href="<?php echo base_url(); ?>index.php/master/jenusaha">Jenis Usaha</a></li>
					<li><a href="<?php echo base_url(); ?>index.php/master/klogad3">Klogad</a></li>
					<li><a href="<?php echo base_url(); ?>index.php/master/kocam">Kode Kecamatan</a></li>
					<li><a href="<?php echo base_url(); ?>index.php/master/kodikj">Kode Pendidikan Struktural</a></li>
					<li><a href="<?php echo base_url(); ?>index.php/master/kodikfgs">Kode Pendidikan Fungsional</a></li>
					<li><a href="<?php echo base_url(); ?>index.php/master/kojab">Kode Jabatan Struktural</a></li>
					<li><a href="<?php echo base_url(); ?>index.php/master/kojabf">Kode Jabatan Fungsional</a></li>
					<li><a href="<?php echo base_url(); ?>index.php/master/kowil">Kode Wilayah</a></li>
					<li><a href="<?php echo base_url(); ?>index.php/master/lokasi">Lokasi</a></li>
					<li><a href="<?php echo base_url(); ?>index.php/master/koneg">Kode Negara</a></li>
					<li><a href="<?php echo base_url(); ?>index.php/master/kopang">Kode Pangkat</a></li><!--pers_pangkat_tbl-->
					<li><a href="<?php echo base_url(); ?>index.php/master/kodik">Kode Pendidikan</a></li><!--pers_pdidikan_tbl-->
					<li><a href="<?php echo base_url(); ?>index.php/master/pejtt">Pejabat Tertinggi (PejTT)</a></li>
					<li><a href="<?php echo base_url(); ?>index.php/master/prop">Propinsi</a></li>
					<li><a href="<?php echo base_url(); ?>index.php/master/stapeg">Jenis Status Pegawai</a></li>
					<li><a href="<?php echo base_url(); ?>index.php/master/stattun">Jenis Status Tunjangan</a></li>
					<li><a href="<?php echo base_url(); ?>index.php/master/stawin">Jenis Status Kawin</a></li>
					<li><a href="<?php echo base_url(); ?>index.php/master/spmu">Kode SPMU</a></li>
					<li><a href="<?php echo base_url(); ?>index.php/master/tema">Jenis Tema</a></li>
					<li><a href="<?php echo base_url(); ?>index.php/master/uangduka">Jenis Uang Duka</a></li>
					<li><a href="<?php echo base_url(); ?>index.php/master/universitas">Universitas</a></li>
				</ul>
			</li>
            
			


			<!-- menu jalan sembunyi 
			<li class="<?php echo isset($activeHome) ? $activeHome : ''; ?>">
				<a href="<?php echo base_url(); ?>index.php"><i class="fa fa-th-large"></i> <span class="nav-label">Home</span></a>
			</li>
			<li class="<?php echo isset($activeProfile) ? $activeProfile : ''; ?>">
				<a href="<?php echo base_url(); ?>index.php/profile"><i class="fa fa-th-large"></i> <span class="nav-label">Profile</span></a>
			</li>
			<li class="<?php echo isset($activeDashboard) ? $activeDashboard : ''; ?>">
                <a href="#"><i class="fa fa-th-large"></i> <span class="nav-label">Dashboard</span></a>
            </li>
			<li class="<?php echo isset($activeMailbox) ? $activeMailbox : ''; ?>">
				<a href="#"><i class="fa fa-envelope"></i> <span class="nav-label">Mailbox</span> </a>
			</li>					
			<li class="<?php echo isset($activeIdentitas) ? $activeIdentitas : ''; ?>">
				<a href=""><i class="fa fa-table"></i> <span class="nav-label">Identitas</span><span class="fa arrow"></span></a>
				<ul class="nav nav-second-level collapse">
					<li><a href="<?php echo base_url(); ?>index.php/hist/datapokok">PNS / CPNS</a></li>
					<li><a href="#">Pegawai Tidak Tetap (PTT)</a></li>
				</ul>
			</li>
			-->



			<!-------------------------------------------------------------------------------------------------------->
			 <!--<li>
				<a href=""><i class="fa fa-cc-visa"></i> <span class="nav-label">Kinerja</span><span class="fa arrow"></span></a>
				<ul class="nav nav-second-level collapse">
					<li><a href="#">Capaian Perilaku</a></li>
					<li><a href="#">Rekapitulasi Penilaian Perilaku </a></li>
					<li><a href="#">Capaian Kinerja</a></li>
					<li><a href="#">Rekapitulasi Capaian Kinerja</a></li>
					<li>
						<a href="#">Serapan Anggaran <span class="fa arrow"></span></a>
						<ul class="nav nav-third-level">
							<li><a href="#">Belanja Langsung</a></li>
							<li><a href="#">Belanja Tidak Langsung</a></li>
							<li><a href="#">Belanja Bantuan</a></li>
							<li><a href="#">Rekapitulasi Serapan</a></li>
						</ul>
					</li>
				</ul>
			</li> -->
			<!-------------------------------------------------------------------------------------------------------->


			<!-- menu jalan sembunyi
			<li>
				<a href=""><i class="fa fa-table"></i> <span class="nav-label">Riwayat</span><span class="fa arrow"></span></a>
				<ul class="nav nav-second-level collapse">
					<li><a href="#">Jabatan</a></li>
					<li><a href="#">Gaji Pokok</a></li>
					<li><a href="#">Pangkat</a></li>
					<li><a href="#">Pendidikan</a></li>
					<li><a href="#">DP3</a></li>
					<li><a href="#">Hukuman Disiplin</a></li>
					<li><a href="#">Hukuman Administrasi</a></li>
					<li><a href="#">Absensi</a></li>
					<li><a href="#">Cuti</a></li>
					<li><a href="#">Pembatasan</a></li>
					<li><a href="#">Seminar</a></li>
					<li><a href="#">Tulisan</a></li>
					<li><a href="#">Alamat</a></li>
					<li><a href="#">Penghargaan</a></li>
					<li><a href="#">Fasilitas</a></li>
					<li><a href="#">Organisasi</a></li>
					<li><a href="#">Keluarga</a></li>
					<li><a href="#">LP2P</a></li>
					<li><a href="#">Litsus</a></li>
					<li><a href="#">Test TPA</a></li>
					<li><a href="#">Test TP</a></li>
					<li><a href="#">Makalah</a></li>
					<li><a href="#">Test Gabungan</a></li>
				</ul>
			</li>
			<li class="<?php echo isset($activeSisir) ? $activeSisir : ''; ?>">
				<a href="#"><i class="fa fa-table"></i> <span class="nav-label">Referensi Sisir TKD</span><span class="fa arrow"></span></a>
				<ul class="nav nav-second-level collapse">
					<li><a href="<?php echo base_url(); ?>index.php/sisirtkd/statisdinamis">TKD Statis, Dinamis, Tahap I dan II</a></li>
					<li><a href="<?php echo base_url(); ?>index.php/sisirtkd/tkdguru">TKD Guru</a></li>
					<li><a href="<?php echo base_url(); ?>index.php/sisirtkd/gapok">Gaji Pegawai</a></li>
				</ul>
			</li>
			<li class="<?php echo isset($activeReferensi) ? $activeReferensi : ''; ?>">
				<a href="<?php echo base_url(); ?>index.php/referensi"><i class="fa fa-table"></i> <span class="nav-label">Referensi</span></a>
			</li>
			-->


			<!-- tidak digunakan sementara-->

			<!--<li class="<?php echo isset($activeReferensia) ? $activeReferensia : ''; ?>">
				<a href="#"><i class="fa fa-table"></i> <span class="nav-label">Referensi</span><span class="fa arrow"></span></a>
				<ul class="nav nav-second-level collapse">
					<li><a href="<?php echo base_url(); ?>index.php/ref/ref_lokker">Lokasi Kerja</a></li>
					<li><a href="<?php echo base_url(); ?>index.php/ref/ref_klogad3">Lokasi Penempatan</a></li>
					<li><a href="<?php echo base_url(); ?>index.php/ref/ref_spmu">Lokasi Gaji</a></li>
					<li><a href="<?php echo base_url(); ?>index.php/ref/ref_pendidikan">Tingkat Pendidikan</a></li>
					<li><a href="<?php echo base_url(); ?>index.php/ref/ref_hubkel">Hubungan Keluarga</a></li>
					<li><a href="<?php echo base_url(); ?>index.php/ref/ref_jabatan">Jabatan Struktural</a></li>
					<li><a href="<?php echo base_url(); ?>index.php/ref/ref_jabatanf">Jabatan Fungsional</a></li>
					<li><a href="<?php echo base_url(); ?>index.php/ref/ref_pangkat">Pangkat</a></li>
					<li><a href="<?php echo base_url(); ?>index.php/ref/ref_gapok">Gaji Pokok</a></li>
					<li><a href="<?php echo base_url(); ?>index.php/ref/ref_jendik">Jenis Pendidikan</a></li>
					<li><a href="<?php echo base_url(); ?>index.php/ref/ref_jencuti">Jenis Cuti</a></li>
					<li><a href="<?php echo base_url(); ?>index.php/ref/ref_jenfas">Jenis Fasilitas</a></li>
					<li><a href="<?php echo base_url(); ?>index.php/ref/ref_jenhukadm">Jenis Hukuman Administrasi</a></li>
					<li><a href="<?php echo base_url(); ?>index.php/ref/ref_jenhukdis">Jenis Hukuman Disiplin</a></li>
					<li><a href="<?php echo base_url(); ?>index.php/ref/ref_jenpeg">Jenis Pegawai</a></li>
					<li><a href="<?php echo base_url(); ?>index.php/ref/ref_jenrub">Jenis Perubahan</a></li>
					<li><a href="<?php echo base_url(); ?>index.php/ref/ref_jenusaha">Jenis Usaha</a></li>
					<li><a href="<?php echo base_url(); ?>index.php/ref/ref_kdduduk">Jenis Kedudukan Organisasi</a></li>
					<li><a href="<?php echo base_url(); ?>index.php/ref/ref_kdkerja">Jenis Pekerjaan</a></li>
					<li><a href="<?php echo base_url(); ?>index.php/ref/ref_kdlingkup">Jenis Lingkup</a></li>
					<li><a href="<?php echo base_url(); ?>index.php/ref/ref_kdperans">Jenis Peran Seminar</a></li>
					<li><a href="<?php echo base_url(); ?>index.php/ref/ref_kdperant">Jenis Peran Penulis</a></li>
					<li><a href="<?php echo base_url(); ?>index.php/ref/ref_kdsemi">Jenis Seminar</a></li>
					<li><a href="<?php echo base_url(); ?>index.php/ref/ref_kdsifat">Jenis Sifat</a></li>
					<li><a href="<?php echo base_url(); ?>index.php/ref/ref_kodik">Kode Kelompok Pendidikan Formal</a></li>
					<li><a href="<?php echo base_url(); ?>index.php/ref/ref_kodikf">Kode Tingkat Pendidikan Formal</a></li>
					<li><a href="<?php echo base_url(); ?>index.php/ref/ref_kodikj">Kode Tingkat Pendidikan Penjenjangan</a></li>
					<li><a href="<?php echo base_url(); ?>index.php/ref/ref_induk">Instansi Induk</a></li>
					<li><a href="<?php echo base_url(); ?>index.php/ref/ref_hargaan">Penghargaan</a></li>
					<li><a href="<?php echo base_url(); ?>index.php/ref/ref_univer">Universitas</a></li>
					<li><a href="<?php echo base_url(); ?>index.php/ref/ref_negara">Negara</a></li>
					<li><a href="<?php echo base_url(); ?>index.php/ref/ref_tema">Tema</a></li>
					<li><a href="<?php echo base_url(); ?>index.php/ref/ref_kowil">Wilayah</a></li>
					<li><a href="<?php echo base_url(); ?>index.php/ref/ref_kocam">Kecamatan</a></li>
					<li><a href="<?php echo base_url(); ?>index.php/ref/ref_kokel">Kelurahan</a></li>
				</ul>
			</li>-->
			<!-- <li>
				<a href="#"><i class="fa fa-table"></i> <span class="nav-label">Referensi Ekinerja</span><span class="fa arrow"></span></a>
				<ul class="nav nav-second-level collapse">
					<li><a href="#">Master Aktifitas Kinerja</a></li>
					<li><a href="#">Master User Admin SKPD </a></li>
					<li><a href="#">Master SKPD </a></li>
					<li><a href="#">Master Struktur Organisasi </a></li>
				</ul>
			</li> -->
			<!-- <li>
				<a href="#"><i class="fa fa-picture-o"></i> <span class="nav-label">Gallery</span><span class="fa arrow"></span></a>
				<ul class="nav nav-second-level">
					<li><a href="#">Lightbox Gallery</a></li>
					<li><a href="#">Bootstrap Carusela</a></li>
				</ul>
			</li>	 -->		

		</ul>
	</div>
</nav>

<!-- START PAGE-WRAPPER -->
<div id="page-wrapper" class="gray-bg" >

	<div class="row border-bottom">
        <nav class="navbar navbar-static-top" role="navigation" style="margin-bottom: 0">
        <div class="navbar-header">
            <a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#"><i class="fa fa-bars"></i></a>
            <?php 
            	if(isset($user_group)){
            		if($user_group > 1 && $user_group <5){            			
            			if(isset($inisial)){
            				$os = array("report", "referensi", "laporan","request","pegawai");
							if (in_array($inisial, $os)) {
								//PENCARIAN TIDAK DITAMPILKAN
							}else{
			?>
								<form role="search" class="navbar-form-custom" method="post" action="<?php echo site_url('riwayat/listPegawai'); ?>">
					                <div class="form-group ">
					                    <input type="hidden" style="margin-top:15px; width:200%; height:28px; border:2px solid #1ab394 !important;" placeholder="<?=$inisial?>Cari NRK atau NAMA atau NIP atau NIP18" value="<?php echo isset($nrk) ? $nrk : ''; ?>" class="form-control" name="nrkP" id="nrkP">
					                </div>
					            </form>
			<?php
							}
            			}else{
           	?>
           						<form role="search" class="navbar-form-custom" method="post" action="<?php echo site_url('riwayat/listPegawai'); ?>">
					                <div class="form-group ">
					                    <input type="hidden" style="margin-top:15px; width:200%; height:28px; border:2px solid #1ab394 !important;" placeholder="Cari NRK atau NAMA atau NIP atau NIP18" value="<?php echo isset($nrk) ? $nrk : ''; ?>" class="form-control" name="nrkP" id="nrkP">
					                </div>
					            </form>
           	<?php
            			}            			            
            		}
            	} 
            ?>
        </div>
            <ul class="nav navbar-top-links navbar-right">
                <li>
                    <span class="m-r-sm text-muted welcome-message">Selamat datang <?php echo $username; ?>.</span>
                </li>
                <li class="dropdown" style="display: none;">
                    <a class="dropdown-toggle count-info" data-toggle="dropdown" href="#">
                        <i class="fa fa-envelope"></i>  <span class="label label-warning">16</span>
                    </a>
                    <ul class="dropdown-menu dropdown-messages">
                        <li>
                            <div class="dropdown-messages-box">
                                <a href="#" class="pull-left">
                                    <!-- <img alt="image" class="img-circle" src="img/a7.jpg"> -->
                                </a>
                                <div class="media-body">
                                    <small class="pull-right">46h ago</small>
                                    <strong>Mike Loreipsum</strong> started following <strong>Monica Smith</strong>. <br>
                                    <small class="text-muted">3 days ago at 7:58 pm - 10.06.2014</small>
                                </div>
                            </div>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <div class="dropdown-messages-box">
                                <a href="#" class="pull-left">
                                    <!-- <img alt="image" class="img-circle" src="img/a4.jpg"> -->
                                </a>
                                <div class="media-body ">
                                    <small class="pull-right text-navy">5h ago</small>
                                    <strong>Chris Johnatan Overtunk</strong> started following <strong>Monica Smith</strong>. <br>
                                    <small class="text-muted">Yesterday 1:21 pm - 11.06.2014</small>
                                </div>
                            </div>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <div class="dropdown-messages-box">
                                <a href="#" class="pull-left">
                                    <!-- <img alt="image" class="img-circle" src="img/profile.jpg"> -->
                                </a>
                                <div class="media-body ">
                                    <small class="pull-right">23h ago</small>
                                    <strong>Monica Smith</strong> love <strong>Kim Smith</strong>. <br>
                                    <small class="text-muted">2 days ago at 2:30 am - 11.06.2014</small>
                                </div>
                            </div>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <div class="text-center link-block">
                                <a href="#">
                                    <i class="fa fa-envelope"></i> <strong>Read All Messages</strong>
                                </a>
                            </div>
                        </li>
                    </ul>
                </li>               
                <li>
                    <a href="<?php echo base_url(); ?>index.php/login/logout">
                        <i class="fa fa-sign-out"></i> Keluar
                    </a>
                </li>
                <?php 
                if ($this->session->userdata('logged_in')['user_group']=='2'):
                ?>
                <li class="dropdown">
                    <a class="dropdown-toggle count-info" data-toggle="dropdown" href="#" <?=($this->session->userdata('logged_in')['maintenance_mode']=='on')?'style="color:red;"':'';?>>
                        <i class="fa fa-tasks"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-alerts">
                        <li>
                            <div class="sidebar-title">
	                            <h3><i class="fa fa-gears"></i> Settings</h3>
	                        </div>
	                        <div class="setings-item">
	                    <span>
	                        Maintenance Mode
	                    </span>
	                            <div class="switch">
	                                <div class="onoffswitch">
	                                    <input type="checkbox" name="collapsemenu" class="onoffswitch-checkbox" id="mmode" onchange="mmode()" <?= ($this->session->userdata('logged_in')['maintenance_mode']=='on')?'checked':'';?>>
	                                    <label class="onoffswitch-label" for="mmode">
	                                        <span class="onoffswitch-inner"></span>
	                                        <span class="onoffswitch-switch"></span>
	                                    </label>
	                                </div>
	                            </div>
	                        </div>
                        </li>
                        
                    </ul>
                </li>                
            	<?php endif;?>
            </ul>

        </nav>
        </div>

<style>

    #form_upload .fileUpload {
        position: relative;
        overflow: hidden;
        margin: 10px;
        margin-top: 5px;
    }

    #form_upload .fileUpload input.upload {
        position: absolute;
        top: 0;
        right: 0;
        margin: 0;
        padding: 0;
        font-size: 20px;
        cursor: pointer;
        opacity: 0;
        filter: alpha(opacity=0);
    }

    #form_upload #uploadFile{
        background-color: #ffffff;
        background-image: none;
        border: 1px solid #e5e6e7;
        border-radius: 2px;
        color: inherit;
        /*display: block;*/
        font-size: 14px;
        padding: 6px 12px;
        transition: border-color 0.15s ease-in-out 0s, box-shadow 0.15s ease-in-out 0s;
        width: 80%;
    }
    
</style>


 <!-- START MODAL UPLOAD PHOTO -->
 <div id="modal-upload" class="modal fade" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog" >
        <div class="modal-content">
            <div class="modal-body">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <div class="row">

                    <div class="col-sm-12 b-r"><h3 class="m-t-none m-b">Upload Foto Anda</h3>                                
                        <form role="form" action="javascript:simpanfoto();" method="POST" id="form_upload" name="form_upload" enctype="multipart/form-data">
                            <input type="hidden" id="nrk_user" name="nrk_user" value="<?php echo isset($nrk) ? $nrk : $this->user['id']; ?>">
                            <input  id="uploadFile" name="namafile" placeholder="Choose File" disabled="disabled" />
                            <div class="fileUpload btn btn-primary">
                                <span>Upload</span>
                                <input id="uploadBtn" name="userfile" type="file" class="upload" />
                            </div>
                            <small id="m_allow" style="font-size:12px;font-weight:bold;margin-top:-5px">Format : JPG, JPEG, dan PNG<br>Ukuran File: 500 KB <br></small>
                            <small id="m_error" style="display:none;font-size:12px;color:red;margin-top:-5px">Format Salah (Format Yang Diizinkan : JPG, JPEG, dan PNG)</small>

                            <p class="text-center">                                    
                                <img id="blah" style="display:none;" src="#" alt="" width="170px" height="170px" />
                            </p>
                            
                            <input type="submit" class="pull-right btn btn-success" id="b_simpan" name="simpan" value="Simpan" style="display:none;" onClick="simpanfoto();"/>

                            <label class="label label-info msg"></label>
                            <label class="label label-info err text-danger"></label>
                        </form>
                        
                    </div>                            
            </div>
        </div>
        </div>
    </div>
</div>
 <!-- END MODAL UPLOAD PHOTO -->

 <!-- START MODAL UBAH PASSWORD -->
 <div id="modal-pass" class="modal fade" aria-hidden="true" data-backdrop="static" data-bv-submitbuttons="button[type='submit']" data-remote="true" data-toggle="validator">
    <div class="modal-dialog">
        <div class="modal-content">
        	 <form id="form_pass" name="form_pass" action="javascript:submit();" method="POST"  role="form">
	            <div class="modal-header">
			    	<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			    	<h4 class="modal-title" id="myModalLabel">Form Ubah Password</h4>
			    </div>
	            <div class="modal-body">
	                <div class="row">                                
	                    
	                    <label class="col-sm-4 control-label">Password Lama</label>
	                    <div class="row">
		                    <div class="input-group col-sm-6">
		                    	
		                  		<input type="password" id="oldpass" name="oldpass" placeholder="Password Lama" class="form-control" value="" onchange="cekPasswordBaru()">
		                  		
								<img src="<?php echo base_url(); ?>assets/img/eye.png" onmouseover="mouseoverPass(oldpass);" onmouseout="mouseoutPass(oldpass);">
						
		                  		<label class="msg text-success"></label>
		                  		<label class="msg3 text-success"></label>
								<label class="err3 text-danger"></label>
		                  	</div>

		                  	
		                    
		                </div>
	                    <div class="hr-line-dashed"></div> 
	                        	
	                    <label class="col-sm-4 control-label">Password Baru</label>
	                    <div class="input-group col-sm-6">
	                        <input type="password" id="newpass" name="newpass" placeholder="Password Baru" class="form-control" value="" onkeyup="cekPasswordBaru()" readonly="readonly">
	                        <img src="<?php echo base_url(); ?>assets/img/eye.png" onmouseover="mouseoverPass(newpass);" onmouseout="mouseoutPass(newpass);">
	                    </div>
	                    <div class="hr-line-dashed"></div> 
	                        	
	                    <label class="col-sm-4 control-label">Konfirmasi Password Baru</label>
	                    <div class="input-group col-sm-6">
	                  		<input type="password" id="cnewpass" name="cnewpass" placeholder="Konfirmasi Password Baru" class="form-control" value="" onkeyup="cekPasswordBaru()" readonly="readonly">
	                    	<img src="<?php echo base_url(); ?>assets/img/eye.png" onmouseover="mouseoverPass(cnewpass);" onmouseout="mouseoutPass(cnewpass);">
	                    	<label class="msg2 text-success"></label>
							<label class="err2 text-danger"></label>
						</div>
	                    <div class="hr-line-dashed"></div>                               
	            </div>
	        </div>
	        <div class="modal-footer">
				
				<button type="button" class="btn btn-danger" data-dismiss="modal">Tutup</button>
				<button type="submit" id="sub" class="btn btn-primary" disabled="true">Simpan</button>
			</div>
        </form>
        </div>

        
    </div>
</div>
 <!-- END MODAL UBAH PASSWORD -->
<!-- Mainly scripts --> 
		<script src="<?php echo base_url(); ?>assets/inspinia/js/jquery-2.1.1.js"></script>
        <script src="<?php echo base_url(); ?>assets/inspinia/js/bootstrap.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/inspinia/js/plugins/metisMenu/jquery.metisMenu.js"></script>
        <script src="<?php echo base_url(); ?>assets/inspinia/js/plugins/slimscroll/jquery.slimscroll.min.js"></script>
        <!-- Mainly scripts -->        


        <!-- Boostrap Validator -->
        <script type="text/javascript" src="<?php echo base_url(); ?>assets/inspinia/boostrapvalidator/js/bootstrapValidator.js"></script>
        <!-- jqueryForm -->
        <script src="<?php echo base_url(); ?>assets/js/jquery.form.js"></script>
        <!-- blueimp gallery -->
    	<script src="<?php echo base_url(); ?>assets/inspinia/js/plugins/blueimp/jquery.blueimp-gallery.min.js"></script>
        

        <!-- Custom and plugin javascript -->
<!--        <script src="--><?php //echo base_url(); ?><!--assets/inspinia/js/inspinia.js"></script>-->
<!--        <script src="--><?php //echo base_url(); ?><!--assets/inspinia/js/plugins/pace/pace.min.js"></script>-->
        <!-- Custom and plugin javascript -->   

 <script type="text/javascript">
 	$(document).ready(function(){
 		$('#form_pass').bootstrapValidator({
            live: 'enabled',
            excluded:'disabled',
            message: 'This value is not valid',
            feedbackIcons: {
                valid: 'glyphicon glyphicon-ok',
                invalid: 'glyphicon glyphicon-remove',
                validating: 'glyphicon glyphicon-refresh'
            },
            fields: {
                oldpass: {
                    validators: {
                        notEmpty: {
                            message: 'Field tidak boleh kosong'
                        }
                    }
                },newpass: {
                    validators: {
                        notEmpty: {
                            message: 'Field tidak boleh kosong'
                        }
                    }
                },cnewpass: {
                    validators: {
                        notEmpty: {
                            message: 'Field tidak boleh kosong'
                        }
                    }
                }
            }
        });

});



	    document.getElementById("uploadBtn").onchange = function () {
	        document.getElementById("uploadFile").value = this.value;

	        var ext = $('#uploadFile').val().split('.').pop().toLowerCase();
	        if($.inArray(ext, ['png','jpg','jpeg']) == -1) {
	            document.getElementById("m_allow").style.display="none";
	            document.getElementById("m_error").style.display="";
	            document.getElementById("blah").style.display="none";
	            document.getElementById("b_simpan").style.display="none";
	            document.getElementById("form_upload").reset();
	        }else{
	            document.getElementById("m_allow").style.display="none";
	            document.getElementById("m_error").style.display="none";
	            document.getElementById("blah").style.display="";
	            document.getElementById("b_simpan").style.display="";
	            readURL(this);
	        }
	    };

	    $(function() {

        $("#oldpass").on("change", function(event) {
            event.preventDefault();

            $.ajax({
                url: "<?php echo base_url(); ?>index.php/home/getDataUser",
                type: "post",
                data: {oldpass : $('#oldpass').val(), temppass : $('#temppass').val()},
                dataType: 'json',
                beforeSend: function() {
                     $('.msg').html('');
                     $('.err').html("");
                     $('#newpass').attr('readonly',true);
                     $('#cnewpass').attr('readonly',true);
                     $('.msg').html('<div class="sk-spinner sk-spinner-circle"><div class="sk-circle1 sk-circle"></div><div class="sk-circle2 sk-circle"></div><div class="sk-circle3 sk-circle"></div><div class="sk-circle4 sk-circle"></div><div class="sk-circle5 sk-circle"></div><div class="sk-circle6 sk-circle"></div><div class="sk-circle7 sk-circle"></div><div class="sk-circle8 sk-circle"></div><div class="sk-circle9 sk-circle"></div><div class="sk-circle10 sk-circle"></div><div class="sk-circle11 sk-circle"></div><div class="sk-circle12 sk-circle"></div></div>');
                },
                success: function(data) {
                    if(data.response=='COCOK')
                    {
                    	$('.msg3').html('COCOK');
                     	$('.err3').html("");
                     	$('#sub').attr('disabled',false);
                     	$('#newpass').attr('readonly',false);
                     	$('#cnewpass').attr('readonly',false);
                     	 // $('.msg').html('<div><div class="sk-spinner sk-spinner-pulse"></div></div>');
                    } 
                    else if(data.response=='KOSONG')
                    {
                    	$('.msg3').html('');
                     	$('.err3').html("HARAP DIISI");
                     	$('#sub').attr('disabled',true);
                     	$('#newpass').attr('readonly',true);
                     	$('#cnewpass').attr('readonly',true);
                     		 // $('.msg').html('<div><div class="sk-spinner sk-spinner-pulse"></div></div>');
                    }
                    else
                    {
                    	$('.msg3').html('');
                     	$('.err3').html("TIDAK COCOK");
                     	$('#sub').attr('disabled',true);
                     	$('#newpass').val('');
                     	$('#newpass').attr('readonly',true);
                     	$('#cnewpass').val('');
                     	$('#cnewpass').attr('readonly',true);
                     		 // $('.msg').html('<div><div class="sk-spinner sk-spinner-pulse"></div></div>');
                    }
                },
                error: function(xhr) {
                    alert("Terjadi kesalahan. Silahkan coba kembali");
                },
                complete: function() {
                   $('.msg').html('');
                }
            });
        });
    });

	    function mouseoverPass(obj) {
  			//var obj = document.getElementById('myPassword');
  			obj.type = "text";
		}

		function mouseoutPass(obj) {
  			//var obj = document.getElementById('myPassword');
		  	obj.type = "password";
		}

		function mmode(){
			mmode_val = ($('#mmode').is(':checked'))?'on':'off';
			// alert(mmode_val);
			$.post("<?php echo site_url('maintenance/setMode'); ?>",{
				mode : mmode_val 
			}, function(data, status){
		        // alert(data);
		        location.reload(true);
		    });
			
		}

	    function readURL(input) {

	        if (input.files && input.files[0]) {
	            var reader = new FileReader();

	            reader.onload = function (e) {
	                $('#blah').attr('src', e.target.result);
	            }

	            reader.readAsDataURL(input.files[0]);
	        }
	    }

	    function cekPasswordBaru()
	    {
	    	var passbaru = document.getElementById('newpass').value;
	    	var cpassbaru = document.getElementById('cnewpass').value;
	    	if((passbaru == '' && cpassbaru == '') || (passbaru!='' && cpassbaru==''))
	    	{
	    		$('.msg2').html('');
	    		$('.err2').html('');

	    	}
	    	else if(passbaru=='' && cpassbaru!='')
	    	{
	    		document.getElementById('cnewpass').value ='';
	    	}

	    	else
	    	{
	    		if(cpassbaru == passbaru)
		    	{
		    		$('.msg2').html('COCOK');
		    		$('.err2').html('');
		    		$('#sub').attr('disabled',false);
		    	}
		    	else
		    	{
		    		$('.msg2').html('');
		    		$('.err2').html("TIDAK COCOK");
		    		$('#sub').attr('disabled',true);
		    	}
	    	}
	    }

	    function simpanfoto(){
		    var userfile=$('#uploadBtn').val();

		    $('#form_upload').ajaxForm({
		     url:'<?php echo base_url("index.php/home/upload_file"); ?>',
		     type: 'post',
		     dataType: 'json',
		     data:{"userfile":userfile,nrk:$('#nrk_user').val()},
		     beforeSend: function() {
		        var percentVal = 'Mengupload 0%';
		        $('.msg').html(percentVal);
		     },
		     uploadProgress: function(event, position, total, percentComplete) {
		        var percentVal = 'Mengupload ' + percentComplete + '%';
		        $('.msg').html(percentVal);
		     },
		     beforeSubmit: function() {

		     },
		     complete: function(xhr) {
		        $('.msg').html('Mengupload file selesai!');
		     },
		     success: function(resp) {
		        if(resp.result == 'SUKSES'){
		        	$('#modal-upload').modal('hide');
		        	setTimeout(function () {
				        location.reload()
				    }, 100);
		        }else{
		        	$('.err').html("Photo gagal diupload, silahkan coba kembali.");
		        }
		     },
		    });
		}

		function submit(){
        $.ajax({
            url: '<?php echo base_url("index.php/home/gantiPassword"); ?>',
            type: "post",
            data: $('#form_pass').serialize(),
            dataType: 'json',
            beforeSend: function() {
                $('.msg').html('<div><div class="sk-spinner sk-spinner-rotating-plane"></div></div>');
                $('.err').html("");
            },
            success: function(data) {
                if(data.response == 'SUKSES'){
                    $('.msg').html('<small>Data berhasil disimpan.</small>');
                    $('.err').html('');

                    $('#myModal').modal('hide');
                   	window.location.href="<?php echo base_url("index.php/login/logout"); ?>";

                }else{
                    $('.msg').html('');
                    $('.err').html("<small>Data gagal disimpan, Key sudah digunakan.</small>");
                    //alert(data.hasil);
                }
            },
            error: function(xhr) {
                $('.msg').html('');
                $('.err').html("<small>Data gagal disimpan, silahkan coba kembali.</small>");
            },
            complete: function() {

            }
        });

		
    }





	</script>
