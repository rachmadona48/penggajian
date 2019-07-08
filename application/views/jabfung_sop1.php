<style type="text/css">
    .row .col-lg-3 h2{
        margin-top: 20%;
    }
</style>
<div class="row">
    <div class="col-lg-3">
        <h2>&nbsp;</h2>
    </div>    
    <div class="col-lg-4">
       
                <h2 align="center">PROSES</h2>
        
    </div>

    <div class="col-lg-4">
        
                <h2 align="center">TELAH DISETUJUI</h2>
        
    </div>
    <div class="col-lg-1"></div>
</div>
<div class="row">
    <div class="col-lg-3">
        <h2>TAHAP PERTAMA</h2>
    </div>    
    <div class="col-lg-4">
        <div class="widget style1 yellow-bg">
                <a href="<?php echo base_url('tubkd/permohonan') ?>">
                    <div class="row" style="color:#fff">
                        <div class="col-xs-9 text-left">
                            <h3>PERMOHONAN DARI</h3>
                            <h3 class="font-bold">SKPD</h2>
                              <span> <b><h2><?php echo $jumlah_permohonan->TRX_HDR; ?></h2> PERMOHONAN </b></span> 
                        </div>
                        <div class="col-xs-3">
                            <i class="fa fa-arrow-circle-right fa-5x" aria-hidden="true"></i>
                        </div>
                        
                    </div>
                </a>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="widget style1 yellow-bg">
                <a href="<?php echo base_url('tubkd/dashboard_terima') ?>">
                    <div class="row" style="color:#fff">
                        <div class="col-xs-9 text-left">
                            <h3>MENUJU</h3>
                            <h3 class="font-bold">BID PENGEMBANGAN</h2>
                              <span><b><h2><?php echo $jumlah_permohonan_terima->TRX_TERIMA; ?></h2> PERMOHONAN </b> </span> 
                        </div>
                        <div class="col-xs-3">
                            <i class="fa fa-check fa-5x" aria-hidden="true"></i>
                        </div>
                        
                    </div>
                </a>
        </div>
    </div>
    <div class="col-lg-1"></div>
</div>

<div class="row">
    <div class="col-lg-3">
        <h2>TAHAP KEDUA</h2>
    </div>    
    <div class="col-lg-4">
        <div class="widget style1 red-bg">
                <a href="<?php echo base_url('tubkd/permohonan_tahap2') ?>">
                    <div class="row" style="color:#fff">
                        <div class="col-xs-9 text-left">
                            <h3>PERMOHONAN DARI</h3>
                            <h3 class="font-bold">BID PENGEMBANGAN</h2>
                              <span> <b><h2><?php echo $jumlah_permohonan2->TRX_HDR; ?></h2> PERMOHONAN </b></span> 
                        </div>
                        <div class="col-xs-3">
                            <i class="fa fa-arrow-circle-right fa-5x" aria-hidden="true"></i>
                        </div>
                        
                    </div>
                </a>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="widget style1 red-bg">
                <a href="<?php echo base_url('tubkd/dashboard_terima2') ?>">
                    <div class="row" style="color:#fff">
                        <div class="col-xs-9 text-left">
                            <h3>MENUJU</h3>
                            <h3 class="font-bold">BIRO HUKUM</h2>
                              <span><b><h2><?php echo $jumlah_permohonan_terima2->TRX_TERIMA ?></h2> PERMOHONAN </b> </span> 
                        </div>
                        <div class="col-xs-3">
                            <i class="fa fa-check fa-5x" aria-hidden="true"></i>
                        </div>
                        
                    </div>
                </a>
        </div>
    </div>
    <div class="col-lg-1"></div>  
</div>

<div class="row">
    <div class="col-lg-3">
        <h2>TAHAP KETIGA</h2>
    </div>    
    <div class="col-lg-4">
        <div class="widget style1 lazur-bg">
                <a href="<?php echo base_url('tubkd/permohonan_tahap3') ?>">
                    <div class="row" style="color:#fff">
                        <div class="col-xs-9 text-left">
                            <h3>PERMOHONAN DARI</h3>
                            <h3 class="font-bold">BIRO HUKUM</h2>
                              <span> <b><h2><?php echo $jumlah_permohonan3->TRX_HDR; ?></h2> PERMOHONAN </b></span> 
                        </div>
                        <div class="col-xs-3">
                            <i class="fa fa-arrow-circle-right fa-5x" aria-hidden="true"></i>
                        </div>
                        
                    </div>
                </a>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="widget style1 lazur-bg">
                <a href="<?php echo base_url('tubkd/dashboard_terima3') ?>">
                    <div class="row" style="color:#fff">
                        <div class="col-xs-9 text-left">
                            <h3>MENUJU</h3>
                            <h3 class="font-bold">BIRO UMUM</h2>
                              <span><b><h2><?php echo $jumlah_permohonan_terima3->TRX_TERIMA ?></h2> PERMOHONAN </b> </span> 
                        </div>
                        <div class="col-xs-3">
                            <i class="fa fa-check fa-5x" aria-hidden="true"></i>
                        </div>
                        
                    </div>
                </a>
        </div>
    </div>
    <div class="col-lg-1"></div>  
</div>

<div class="row">
    <div class="col-lg-3">
        <h2>TAHAP KEEMPAT</h2>
    </div>    
    <div class="col-lg-4">
        <div class="widget style1 navy-bg">
                <a href="<?php echo base_url('tubkd/permohonan_tahap4') ?>">
                    <div class="row" style="color:#fff">
                        <div class="col-xs-9 text-left">
                            <h3>PERMOHONAN DARI</h3>
                            <h3 class="font-bold">BIRO UMUM</h2>
                              <span><b><h2> <?php echo $jumlah_permohonan4->TRX_HDR; ?></h2> PERMOHONAN </b></span> 
                        </div>
                        <div class="col-xs-3">
                            <i class="fa fa-arrow-circle-right fa-5x" aria-hidden="true"></i>
                        </div>
                        
                    </div>
                </a>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="widget style1 navy-bg">
                <a href="<?php echo base_url('tubkd/dashboard_terima4') ?>">
                    <div class="row" style="color:#fff">
                        <div class="col-xs-9 text-left">
                            <h3>MENUJU</h3>
                            <h3 class="font-bold">BID PENGEMBANGAN</h2>
                              <span><b><h2><?php echo $jumlah_permohonan_terima4->TRX_TERIMA ?></h2> PERMOHONAN </b> </span> 
                        </div>
                        <div class="col-xs-3">
                            <i class="fa fa-check fa-5x" aria-hidden="true"></i>
                        </div>
                        
                    </div>
                </a>
        </div>
    </div>
    <div class="col-lg-1"></div>  
</div>