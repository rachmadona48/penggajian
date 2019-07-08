<style>
#tdata th:nth-child(0),th:nth-child(1), th:nth-child(2), th:nth-child(3),th:nth-child(4),th:nth-child(5),th:nth-child(6),th:nth-child(7)
{
  text-align:center !important;
}

a.btn-danger.dim {
  box-shadow: inset 0px 0px 0px #ea394c, 0px 5px 0px 0px #ea394c, 0px 10px 5px #999999;
}



[data-tooltip] {
    display: inline-block;
    position: relative;
 }
/* Tooltip styling */
[data-tooltip]:before {
    content: attr(data-tooltip);
    display: none;
    position: absolute;
    background: #000;
    color: #fff;
    padding: 4px 8px;
    font-size: 14px;
    line-height: 1.4;
    min-width: 100px;
    text-align: center;
    border-radius: 4px;
}
[data-tooltip-position="bottom"]:before {
    left: 50%;
    -ms-transform: translateX(-50%);
    -moz-transform: translateX(-50%);
    -webkit-transform: translateX(-50%);
    transform: translateX(-50%);
}

[data-tooltip-position="bottom"]:before {
    top: 100%;
    margin-top: 6px;
}

/* Tooltip arrow styling/placement */
[data-tooltip]:after {
    content: '';
    display: none;
    position: absolute;
    width: 0;
    height: 0;
    border-color: transparent;
    border-style: solid;
}
/* Dynamic horizontal centering for the tooltip */
[data-tooltip-position="bottom"]:after {
    left: 50%;
    margin-left: -6px;
}
/* Dynamic vertical centering for the tooltip */

[data-tooltip-position="bottom"]:after {
    top: 100%;
    border-width: 0 6px 6px;
    border-bottom-color: #000;
}

/* Show the tooltip when hovering */
[data-tooltip]:hover:before,
[data-tooltip]:hover:after {
    display: block;
    z-index: 30;
}


</style>
 <link href="<?php echo base_url(); ?>assets/inspinia/css/bootstrap.min.css" rel="stylesheet">
 <link href="<?php echo base_url(); ?>assets/inspinia/css/animate.css" rel="stylesheet">
 <link href="<?php echo base_url(); ?>assets/inspinia/css/style.css" rel="stylesheet">
<div class="row wrapper border-bottom white-bg page-heading">
	<div class="col-lg-10">
       
    </div>
    <div class="col-lg-2">
   &nbsp;
    </div>
</div>
          <div class="wrapper wrapper-content animated fadeInDown">
            <div class="ibox float-e-margins" style="margin-top: 10px">
              <div class="ibox-content">
                <div class="row">
                  <div class="col-md-12">
                  
                      <div>
                        <h3 class="no-margins">
                         
                          <div class="col-md-12">
                            <address style="font-size:11px;">
                              <span>
                                <p><?php echo $pergub; ?></p>
                              </span>
                              
                              <span>
                                 <p>THBL : &nbsp; <i><?php echo $thbl; ?></i></p>
                              </span>

                              <span>
                                 <p>SKPD : &nbsp; <i><?php echo $skpd; ?></i></p>
                              </span>

                              <span>
                                 <p>UKPD : &nbsp; <i><?php echo $nalokl; ?></i></p>
                              </span>

                              <span>
                                 <p>Jumlah pegawai : <i>&nbsp; <?php echo $count; ?></i></p>
                              </span>

                              <span>
                              <p>Jumlah TKD : <i>&nbsp; <?php echo $this->format_uang->rp_format($njtunda); ?></i></p>
                                 <!-- <p>Jumlah gaji : <i>&nbsp; <?php echo $sum_gj; ?></i></p> -->
                              </span>

                            </address>
                          </div>
                        </h3>
                      </div>
                      
                  </div>
                </div>
              </div>
            </div>
          </div>
                




 <!-- Custom and plugin javascript -->
<script src="<?php echo base_url(); ?>assets/inspinia/js/inspinia.js"></script>
<script src="<?php echo base_url(); ?>assets/inspinia/js/plugins/pace/pace.min.js"></script>
<!-- Custom and plugin javascript -->   
