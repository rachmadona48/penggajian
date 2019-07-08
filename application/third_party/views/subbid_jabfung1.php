<style type="text/css">
    .row .col-lg-3 h2{
        margin-top: 20%;
    }
</style>
<div class="row">
    <div class="col-lg-2">
        <h2>&nbsp;</h2>
    </div>    
    <div class="col-lg-3">
       
                <h2 align="center">PROSES</h2>
        
    </div>

    <div class="col-lg-3">
        
                <h2 align="center">TELAH DISETUJUI</h2>
        
    </div>

    <div class="col-lg-3">
        
                <h2 align="center">DITOLAK</h2>
        
    </div>
    <div class="col-lg-1"></div>
</div>
<div class="row">
    <div class="col-lg-2">
        <h2>TAHAP PERTAMA</h2>
    </div>    
    <div class="col-lg-3">
        <div class="widget style1 yellow-bg">
                <a href="<?php echo base_url('subbid/permohonan') ?>">
                    <div class="row" style="color:#fff">
                        <div class="col-xs-9 text-left">
                            <h3>PERMOHONAN DARI</h3>
                            <h3 class="font-bold">TU BKD</h3>
                              <h2><?php echo $jumlah_permohonan->TRX_HDR; ?></h2><b>PERMOHONAN</b>
                        </div>
                        <div class="col-xs-3">
                            <i class="fa fa-arrow-circle-right fa-3x" aria-hidden="true"></i>
                        </div>
                        
                    </div>
                </a>
        </div>
    </div>

    <div class="col-lg-3">
        <div class="widget style1 yellow-bg">
                <a href="<?php echo base_url('subbid/dashboard_terima') ?>">
                    <div class="row" style="color:#fff">
                        <div class="col-xs-9 text-left">
                            <h3 class="font-bold">BID PENGEMBANGAN</h3>
                            
                              <span><b><h2><?php echo $jumlah_permohonan_terima->TRX_TERIMA; ?></h2> PERMOHONAN </b> </span> 
                        </div>
                        <div class="col-xs-3">
                            <i class="fa fa-check fa-3x" aria-hidden="true"></i>
                        </div>
                        
                    </div>
                </a>
        </div>
    </div>

    <div class="col-lg-3">
        <div class="widget style1 yellow-bg">
                <a href="<?php echo base_url('subbid/dashboard_tolak') ?>">
                    <div class="row" style="color:#fff">
                        <div class="col-xs-9 text-left">
                            <h3 class="font-bold">BID PENGEMBANGAN</h3>
                            
                              <span><b><h2><?php echo $jumlah_permohonan_tolak->TRX_TOLAK; ?></h2> PERMOHONAN </b> </span> 
                        </div>
                        <div class="col-xs-3">
                            <i class="fa fa-remove fa-3x" aria-hidden="true"></i>
                        </div>
                        
                    </div>
                </a>
        </div>
    </div>
    <div class="col-lg-1"></div>
</div>
<div class="row">
    <div class="col-lg-2">
        <h2>TAHAP KEDUA</h2>
    </div>    
    <div class="col-lg-3">
        <div class="widget style1 red-bg">
                <a href="<?php echo base_url('subbid/permohonan2') ?>">
                    <div class="row" style="color:#fff">
                        <div class="col-xs-9 text-left">
                            <h3>PERMOHONAN DARI</h3>
                            <h3 class="font-bold">TU BKD</h3>
                              <span> <b><h2><?php echo $jumlah_permohonan2->TRX_HDR; ?></h2> PERMOHONAN </b></span> 
                        </div>
                        <div class="col-xs-3">
                            <i class="fa fa-arrow-circle-right fa-3x" aria-hidden="true"></i>
                        </div>
                        
                    </div>
                </a>
        </div>
    </div>

    <div class="col-lg-3">
        <div class="widget style1 red-bg">
                <a href="<?php echo base_url('subbid/dashboard_terima2') ?>">
                    <div class="row" style="color:#fff">
                        <div class="col-xs-9 text-left">
                            <h3 class="font-bold">BID PENGEMBANGAN</h3>
                            
                              <span><b><h2><?php echo $jumlah_permohonan_terima2->TRX_TERIMA; ?></h2> PERMOHONAN </b> </span> 
                        </div>
                        <div class="col-xs-3">
                            <i class="fa fa-check fa-3x" aria-hidden="true"></i>
                        </div>
                        
                    </div>
                </a>
        </div>
    </div>

    <div class="col-lg-3">
        <div class="widget style1 red-bg">
                <a href="<?php echo base_url('subbid/dashboard_tolak3') ?>">
                    <div class="row" style="color:#fff">
                        <div class="col-xs-9 text-left">
                            <h3 class="font-bold">BID PENGEMBANGAN</h3>
                            
                              <span><b><h2><?php echo $jumlah_permohonan_tolak2->TRX_TOLAK; ?></h2> PERMOHONAN </b> </span> 
                        </div>
                        <div class="col-xs-3">
                            <i class="fa fa-remove fa-3x" aria-hidden="true"></i>
                        </div>
                        
                    </div>
                </a>
        </div>
    </div>
    <div class="col-lg-1"></div>
</div>