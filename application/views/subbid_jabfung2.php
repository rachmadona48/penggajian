<div class="row">
    <div class="col-lg-4">
        <div class="ibox float-e-margins text-center">
            <div class="ibox-title" style="background-color: #52bf90; color: #fff">
                <h3>PERMOHONAN TU I</h3>
            </div>
            <div class="ibox-content">
                <h2><?php echo $jumlah_permohonan->TRX_HDR; ?> PERMOHONAN</h2><br/>
                <a href="<?php echo base_url('subbid/permohonan') ?>" class="btn btn-primary btn-lg btn-block"><i class="fa fa-arrow-circle-right" aria-hidden="true"></i></a>                    
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="ibox float-e-margins text-center">
            <div class="ibox-title" style="background-color: #52bf90; color: #fff">
                <h3></i> PERMOHONAN DITOLAK</h3>
            </div>
            <div class="ibox-content">
                <h2><?php echo $jumlah_permohonan_tolak->TRX_TOLAK; ?> PERMOHONAN</h2><br/>
                <a href="<?php echo base_url('subbid/dashboard_tolak') ?>" class="btn btn-primary btn-lg btn-block"><i class="fa fa-times" aria-hidden="true"></i></a>                    
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="ibox float-e-margins text-center">
            <div class="ibox-title" style="background-color: #52bf90; color: #fff">
                <h3></i> PERMOHONAN DITERUSKAN</h3>
            </div>
            <div class="ibox-content">
                <h2><?php echo $jumlah_permohonan_terima->TRX_TERIMA; ?> PERMOHONAN</h2><br/>
                <a href="<?php echo base_url('subbid/dashboard_terima') ?>" class="btn btn-primary btn-lg btn-block"><i class="fa fa-check" aria-hidden="true"></i></a>                    
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-4">
        <div class="ibox float-e-margins text-center">
            <div class="ibox-title" style="background-color: #56d0c1; color: #fff">
                <h3>PERMOHONAN TU V</h3>
            </div>
            <div class="ibox-content">
                <h2><?php echo $jumlah_permohonan2->TRX_HDR; ?> PERMOHONAN</h2><br/>
                <a href="<?php echo base_url('subbid/permohonan2') ?>" class="btn btn-info btn-lg btn-block"><i class="fa fa-arrow-circle-right" aria-hidden="true"></i></a>                    
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="ibox float-e-margins text-center">
            <div class="ibox-title" style="background-color: #56d0c1; color: #fff">
                <h3></i> PERMOHONAN DITOLAK</h3>
            </div>
            <div class="ibox-content">
                <h2><?php echo $jumlah_permohonan_tolak2->TRX_TOLAK; ?> PERMOHONAN</h2><br/>
                <a href="<?php echo base_url('subbid/dashboard_tolak2') ?>" class="btn btn-info btn-lg btn-block"><i class="fa fa-times" aria-hidden="true"></i></a>                    
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="ibox float-e-margins text-center">
            <div class="ibox-title" style="background-color: #56d0c1; color: #fff">
                <h3></i> PERMOHONAN DITERUSKAN</h3>
            </div>
            <div class="ibox-content">
                <h2><?php echo $jumlah_permohonan_terima2->TRX_TERIMA; ?> PERMOHONAN</h2><br/>
                <a href="<?php echo base_url('subbid/dashboard_terima2') ?>" class="btn btn-info btn-lg btn-block"><i class="fa fa-check" aria-hidden="true"></i></a>                    
            </div>
        </div>
    </div>
</div>