<nav class="navbar-default navbar-static-side" role="navigation">
	<div class="sidebar-collapse">
		<ul class="nav" id="side-menu">
			<li class="nav-header">
				<div class="dropdown profile-element"> <span>

					<?php 
						$linkImg = "assets/img/photo/".$id.".jpg";
	                    if(file_exists($linkImg)){
	                        $img = base_url()."assets/img/photo/".$id.".jpg";                                    
	                    }else{
	                        $img = base_url()."assets/img/photo/profile_small.jpg";                                    
	                    }

					?>

					<img alt="image" class="img-box m-t-xs img-responsive" src="<?php echo $img; ?>" width="68px" height="68px" style="border-radius:10px;">
                    </span>
                    <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                            <span class="clear"> <span class="block m-t-xs"> <strong class="font-bold"><?php echo $username; ?></strong>
                              <b class="caret"></b></span> </span> </a>
                    <ul class="dropdown-menu animated fadeInRight m-t-xs">
					 <li><a href=""><i class="fa fa-user"></i> Ubah Password</a></li>
					 
					 <li class="divider"></li>
						<li><a href="#">Profile</a></li>
						<li><a href="#">Contacts</a></li>
						<li><a href="#">Mailbox</a></li>
                        <li><a href="#">Logout</a></li>
                    </ul>

				</div>
				<div class="logo-element">
					POSS+
				</div>
			</li>
			<li>
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
			<li>
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
            
			<li>
				<a href="#"><i class="fa fa-th-large"></i> <span class="nav-label">Home</span></a>
			</li>
			<li class="active">
				<a href="#"><i class="fa fa-th-large"></i> <span class="nav-label">Profile</span></a>
			</li>
			<li>
                <a href="#"><i class="fa fa-th-large"></i> <span class="nav-label">Dashboard</span></a>
            </li>
			<li>
				<a href="#"><i class="fa fa-envelope"></i> <span class="nav-label">Mailbox</span> </a>
			</li>					
			<li>
				<a href=""><i class="fa fa-table"></i> <span class="nav-label">Indentitas</span><span class="fa arrow"></span></a>
				<ul class="nav nav-second-level collapse">
					<li><a href="#">PNS / CPNS</a></li>
					<li><a href="#">Pegawai Tidak Tetap (PTT)</a></li>
				</ul>
			</li>
			<li>
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
			</li>
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
			<li>
				<a href="#"><i class="fa fa-table"></i> <span class="nav-label">Referensi</span><span class="fa arrow"></span></a>
				<ul class="nav nav-second-level collapse">
					<li><a href="#">Lokasi Kerja</a></li>
					<li><a href="#">Lokasi Penempatan</a></li>
					<li><a href="#">Lokasi Gaji</a></li>
					<li><a href="#">Tingkat Pendidikan</a></li>
					<li><a href="#">Hubungan Keluarga</a></li>
					<li><a href="#">Jabatan Struktural</a></li>
					<li><a href="#">Jabatan Fungsional</a></li>
					<li><a href="#">Pangkat</a></li>
					<li><a href="#">Gaji Pokok</a></li>
					<li><a href="#">Jenis Pendidikan</a></li>
					<li><a href="#">Jenis Cuti</a></li>
					<li><a href="#">Jenis Fasilitas</a></li>
					<li><a href="#">Jenis Hukuman Adminisitrasi</a></li>
					<li><a href="#">Jenis Hukuman Disiplin</a></li>
					<li><a href="#">Jenis Pegawai</a></li>
					<li><a href="#">Jenis Perubahan</a></li>
					<li><a href="#">Jenis Usaha</a></li>
					<li><a href="#">Jenis Kedudukan Organisasi</a></li>
					<li><a href="#">Jenis Pekerjaan</a></li>
					<li><a href="#">Jenis Lingkup</a></li>
					<li><a href="#">Jenis Peran Seminar</a></li>
					<li><a href="#">Jenis Peran Penulis</a></li>
					<li><a href="#">Jenis Seminar</a></li>
					<li><a href="#">Jenis Sifat</a></li>
					<li><a href="#">Kode Kelompok Pendidikan Formal</a></li>
					<li><a href="#">Kode Tingkat Pendidikan Formal</a></li>
					<li><a href="#">Kode Tingkat Pendidikan Penjenjangan</a></li>
					<li><a href="#">Instansi Induk</a></li>
					<li><a href="#">Penghargaan</a></li>
					<li><a href="#">Universitas</a></li>
					<li><a href="#">Negara</a></li>
					<li><a href="#">Tema</a></li>
					<li><a href="#">Wilayah</a></li>
					<li><a href="#">Kecamatan</a></li>
					<li><a href="#">Kelurahan</a></li>
				</ul>
			</li>
			<li>
				<a href="#"><i class="fa fa-table"></i> <span class="nav-label">Referensi Ekinerja</span><span class="fa arrow"></span></a>
				<ul class="nav nav-second-level collapse">
					<li><a href="#">Master Aktifitas Kinerja</a></li>
					<li><a href="#">Master User Admin SKPD </a></li>
					<li><a href="#">Master SKPD </a></li>
					<li><a href="#">Master Struktur Organisasi </a></li>
				</ul>
			</li>
			<li>
				<a href="#"><i class="fa fa-picture-o"></i> <span class="nav-label">Gallery</span><span class="fa arrow"></span></a>
				<ul class="nav nav-second-level">
					<li><a href="#">Lightbox Gallery</a></li>
					<li><a href="#">Bootstrap Carusela</a></li>
				</ul>
			</li>			

		</ul>
	</div>
</nav>

<!-- START PAGE-WRAPPER -->
<div id="page-wrapper" class="gray-bg">

	<div class="row border-bottom">
        <nav class="navbar navbar-static-top" role="navigation" style="margin-bottom: 0">
        <div class="navbar-header">
            <a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#"><i class="fa fa-bars"></i> </a>
            <form role="search" class="navbar-form-custom" method="post" action="search_results.html">
                <div class="form-group">
                    <input type="text" placeholder="Search for something..." class="form-control" name="top-search" id="top-search">
                </div>
            </form>
        </div>
            <ul class="nav navbar-top-links navbar-right">
                <li>
                    <span class="m-r-sm text-muted welcome-message">Welcome <?php echo $username; ?>.</span>
                </li>
                <li class="dropdown">
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
                <li class="dropdown">
                    <a class="dropdown-toggle count-info" data-toggle="dropdown" href="#">
                        <i class="fa fa-bell"></i>  <span class="label label-primary">8</span>
                    </a>
                    <ul class="dropdown-menu dropdown-alerts">
                        <li>
                            <a href="#">
                                <div>
                                    <i class="fa fa-envelope fa-fw"></i> You have 16 messages
                                    <span class="pull-right text-muted small">4 minutes ago</span>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="#">
                                <div>
                                    <i class="fa fa-twitter fa-fw"></i> 3 New Followers
                                    <span class="pull-right text-muted small">12 minutes ago</span>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="#">
                                <div>
                                    <i class="fa fa-upload fa-fw"></i> Server Rebooted
                                    <span class="pull-right text-muted small">4 minutes ago</span>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <div class="text-center link-block">
                                <a href="#">
                                    <strong>See All Alerts</strong>
                                    <i class="fa fa-angle-right"></i>
                                </a>
                            </div>
                        </li>
                    </ul>
                </li>


                <li>
                    <a href="<?php echo base_url(); ?>index.php/login/logout">
                        <i class="fa fa-sign-out"></i> Log out
                    </a>
                </li>
            </ul>

        </nav>
        </div>