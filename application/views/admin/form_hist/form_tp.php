
<style type="text/css">
    .datepicker, .datepicker-dropdown{
        z-index: 999999999 !important;        
    }
    .pickerpicker .form-control-feedback {
        right: 100px !important;      
    }

    .pickerpicker .form-control-feedback {
        top: 0px !important;
    }

    .input-group[class*="col-"] {
        float: none;
        padding-left: -1px !important;
        padding-right: -1px !important;
    }
</style>

<form id="defaultForm2" name="defaultForm2" method="post" class="form-horizontal"  action="javascript:save();" data-bv-submitbuttons="button[type='submit']" data-remote="true" data-toggle="validator" role="form">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Form Riwayat TP</h4>
    </div>
    <div class="modal-body">
        
            <div class="row">
                <!-- START SIDE 1 -->
                <div class="col-md-6">
                    
    	            <div class="form-group pickerpicker">
    	              <label class="col-sm-4 control-label">NRK</label>
    	              <div class="input-group col-sm-6">
    	                      <input type="text" class="form-control" name="nrk" id="nrk"  value="<?php echo isset($nrk) ? $nrk : ''; ?>" readonly="true">  
                    </div>
    	            </div>


                    <div class="form-group pickerpicker">
                      <label class="col-sm-4 control-label">Nomor Serta</label>
                      <div class="input-group col-sm-6">
                         <input type="text" id="noserta" name="noserta" placeholder="Nomor Serta (numbers only)" maxlength="20" onkeypress="return numbersonly1(this, event)" class="form-control" value="<?php echo isset($infoTP->NOSERTA) ? $infoTP->NOSERTA : ''; ?>">
                      </div>
                    </div>

                    <div class="form-group pickerpicker">
                      <label class="col-sm-4 control-label">Intel</label>
                      <div class="input-group col-sm-6">
                         <input type="text" id="intel" name="intel" placeholder="Intel (numbers only 3 digit)" maxlength="3" onkeypress="return numbersonly1(this, event)" class="form-control" value="<?php echo isset($infoTP->INTEL) ? $infoTP->INTEL : ''; ?>">
                      </div>
                    </div>

                    <div class="form-group pickerpicker">
                      <label class="col-sm-4 control-label">NH Intel</label>
                      <div class="input-group col-sm-6">
                         <input type="text" id="nh_intel" name="nh_intel" placeholder="NH Intel" maxlength="2"  class="form-control" value="<?php echo isset($infoTP->NH_INTEL) ? $infoTP->NH_INTEL : ''; ?>">
                      </div>
                    </div>

                    <div class="form-group pickerpicker">
                      <label class="col-sm-4 control-label">Konsep</label>
                      <div class="input-group col-sm-6">
                         <input type="text" id="konsep" name="konsep" placeholder="Konsep (numbers only 3 digit)" maxlength="3" onkeypress="return numbersonly1(this, event)" class="form-control" value="<?php echo isset($infoTP->KONSEP) ? $infoTP->KONSEP : ''; ?>">
                      </div>
                    </div>

                    <div class="form-group pickerpicker">
                      <label class="col-sm-4 control-label">NH Konsep</label>
                      <div class="input-group col-sm-6">
                         <input type="text" id="nh_konsep" name="nh_konsep" placeholder="NH Konsep" maxlength="2"  class="form-control" value="<?php echo isset($infoTP->NH_KONSEP) ? $infoTP->NH_KONSEP : ''; ?>">
                      </div>
                    </div>

                    <div class="form-group pickerpicker">
                      <label class="col-sm-4 control-label">Alpermas</label>
                      <div class="input-group col-sm-6">
                         <input type="text" id="alpermas" name="alpermas" placeholder="Alpermas (numbers only)" maxlength="3" onkeypress="return numbersonly1(this, event)" class="form-control" value="<?php echo isset($infoTP->ALPERMAS) ? $infoTP->ALPERMAS : ''; ?>">
                      </div>
                    </div>

                    <div class="form-group pickerpicker">
                      <label class="col-sm-4 control-label">NH Alpermas</label>
                      <div class="input-group col-sm-6">
                         <input type="text" id="nh_alpermas" name="nh_alpermas" placeholder="NH Alpermas" maxlength="2"  class="form-control" value="<?php echo isset($infoTP->NH_ALPERMAS) ? $infoTP->NH_ALPERMAS : ''; ?>">
                      </div>
                    </div>

                    <div class="form-group pickerpicker">
                      <label class="col-sm-4 control-label">Mkomplek</label>
                      <div class="input-group col-sm-6">
                         <input type="text" id="mkomplek" name="mkomplek" placeholder="Mkomplek (numbers only)" maxlength="3" onkeypress="return numbersonly1(this, event)" class="form-control" value="<?php echo isset($infoTP->MKOMPLEK) ? $infoTP->MKOMPLEK : ''; ?>">
                      </div>
                    </div>

                    <div class="form-group pickerpicker">
                      <label class="col-sm-4 control-label">NH MKomplek</label>
                      <div class="input-group col-sm-6">
                         <input type="text" id="nh_mkomplek" name="nh_mkomplek" placeholder="NH mKomplek" maxlength="2"  class="form-control" value="<?php echo isset($infoTP->NH_MKOMPLEK) ? $infoTP->NH_MKOMPLEK : ''; ?>">
                      </div>
                    </div>

                    <div class="form-group pickerpicker">
                      <label class="col-sm-4 control-label">KPraktis</label>
                      <div class="input-group col-sm-6">
                         <input type="text" id="kpraktis" name="kpraktis" placeholder="KPraktis (numbers only)" maxlength="3" onkeypress="return numbersonly1(this, event)" class="form-control" value="<?php echo isset($infoTP->KPRAKTIS) ? $infoTP->KPRAKTIS : ''; ?>">
                      </div>
                    </div>

                    <div class="form-group pickerpicker">
                      <label class="col-sm-4 control-label">NH Praktis</label>
                      <div class="input-group col-sm-6">
                         <input type="text" id="nh_kpraktis" name="nh_kpraktis" placeholder="NH KPraktis" maxlength="2"  class="form-control" value="<?php echo isset($infoTP->NH_KPRAKTIS) ? $infoTP->NH_KPRAKTIS : ''; ?>">
                      </div>
                    </div>

                    <div class="form-group pickerpicker">
                      <label class="col-sm-4 control-label">Wawasan</label>
                      <div class="input-group col-sm-6">
                         <input type="text" id="wawasan" name="wawasan" placeholder="Wawasan (numbers only)" maxlength="3" onkeypress="return numbersonly1(this, event)" class="form-control" value="<?php echo isset($infoTP->WAWASAN) ? $infoTP->WAWASAN : ''; ?>">
                      </div>
                    </div>

                    <div class="form-group pickerpicker">
                      <label class="col-sm-4 control-label">NH Wawasan</label>
                      <div class="input-group col-sm-6">
                         <input type="text" id="nh_wawasan" name="nh_wawasan" placeholder="NH Wawasan" maxlength="2"  class="form-control" value="<?php echo isset($infoTP->NH_WAWASAN) ? $infoTP->NH_WAWASAN : ''; ?>">
                      </div>
                    </div>

                    <div class="form-group pickerpicker">
                      <label class="col-sm-4 control-label">Total Cerdas</label>
                      <div class="input-group col-sm-6">
                         <input type="text" id="total_cerdas" name="total_cerdas" placeholder="Total Cerdas (numbers only)" maxlength="4" onkeypress="return numbersonly1(this, event)" class="form-control" value="<?php echo isset($infoTP->TOTAL_CERDAS) ? $infoTP->TOTAL_CERDAS : ''; ?>">
                      </div>
                    </div>
                
                    <div class="form-group pickerpicker">
                      <label class="col-sm-4 control-label">Motpres</label>
                      <div class="input-group col-sm-6">
                         <input type="text" id="motpres" name="motpres" placeholder="Motpres (numbers only)" maxlength="3" onkeypress="return numbersonly1(this, event)" class="form-control" value="<?php echo isset($infoTP->MOTPRES) ? $infoTP->MOTPRES : ''; ?>">
                      </div>
                    </div>

                    <div class="form-group pickerpicker">
                      <label class="col-sm-4 control-label">NH Motpres</label>
                      <div class="input-group col-sm-6">
                         <input type="text" id="nh_motpres" name="nh_motpres" placeholder="NH Motpres" maxlength="2"  class="form-control" value="<?php echo isset($infoTP->NH_MOTPRES) ? $infoTP->NH_MOTPRES : ''; ?>">
                      </div>
                    </div>

                    <div class="form-group pickerpicker">
                      <label class="col-sm-4 control-label">Efisien</label>
                      <div class="input-group col-sm-6">
                         <input type="text" id="efisien" name="efisien" placeholder="Efisien (numbers only)" maxlength="3" onkeypress="return numbersonly1(this, event)" class="form-control" value="<?php echo isset($infoTP->EFISIEN) ? $infoTP->EFISIEN : ''; ?>">
                      </div>
                    </div>

                    <div class="form-group pickerpicker">
                      <label class="col-sm-4 control-label">NH Efisien</label>
                      <div class="input-group col-sm-6">
                         <input type="text" id="nh_efisien" name="nh_efisien" placeholder="NH Efisien" maxlength="2"  class="form-control" value="<?php echo isset($infoTP->NH_EFISIEN) ? $infoTP->NH_EFISIEN : ''; ?>">
                      </div>
                    </div>
                    
                    <div class="form-group pickerpicker">
                      <label class="col-sm-4 control-label">Integrit</label>
                      <div class="input-group col-sm-6">
                         <input type="text" id="integrit" name="integrit" placeholder="Integrit (numbers only)" maxlength="3" onkeypress="return numbersonly1(this, event)" class="form-control" value="<?php echo isset($infoTP->INTEGRIT) ? $infoTP->INTEGRIT : ''; ?>">
                      </div>
                    </div>

                    <div class="form-group pickerpicker">
                      <label class="col-sm-4 control-label">NH Integrit</label>
                      <div class="input-group col-sm-6">
                         <input type="text" id="nh_integrit" name="nh_integrit" placeholder="NH Integrit" maxlength="2"  class="form-control" value="<?php echo isset($infoTP->NH_INTEGRIT) ? $infoTP->NH_INTEGRIT : ''; ?>">
                      </div>
                    </div>

                    <div class="form-group pickerpicker">
                      <label class="col-sm-4 control-label">Stress</label>
                      <div class="input-group col-sm-6">
                         <input type="text" id="stress" name="stress" placeholder="Stress (numbers only)" maxlength="3" onkeypress="return numbersonly1(this, event)" class="form-control" value="<?php echo isset($infoTP->STRESS) ? $infoTP->STRESS : ''; ?>">
                      </div>
                    </div>

                    <div class="form-group pickerpicker">
                      <label class="col-sm-4 control-label">NH Stress</label>
                      <div class="input-group col-sm-6">
                         <input type="text" id="nh_stress" name="nh_stress" placeholder="NH Stress" maxlength="2"  class="form-control" value="<?php echo isset($infoTP->NH_STRESS) ? $infoTP->NH_STRESS : ''; ?>">
                      </div>
                    </div>

                    <div class="form-group pickerpicker">
                      <label class="col-sm-4 control-label">Proaktiv TP</label>
                      <div class="input-group col-sm-6">
                         <input type="text" id="proaktiv_tp" name="proaktiv_tp" placeholder="Proaktiv_tp (numbers only)" maxlength="3" onkeypress="return numbersonly1(this, event)" class="form-control" value="<?php echo isset($infoTP->PROAKTIV_TP) ? $infoTP->PROAKTIV_TP : ''; ?>">
                      </div>
                    </div>

                    <div class="form-group pickerpicker">
                      <label class="col-sm-4 control-label">NH Proaktiv_tp</label>
                      <div class="input-group col-sm-6">
                         <input type="text" id="nh_proaktiv_tp" name="nh_proaktiv_tp" placeholder="NH Proaktiv TP" maxlength="2"  class="form-control" value="<?php echo isset($infoTP->NH_PROAKTIV_TP) ? $infoTP->NH_PROAKTIV_TP : ''; ?>">
                      </div>
                    </div>

                    <div class="form-group pickerpicker">
                      <label class="col-sm-4 control-label">Krjsama</label>
                      <div class="input-group col-sm-6">
                         <input type="text" id="krjsama" name="krjsama" placeholder="Krjsama (numbers only)" maxlength="3" onkeypress="return numbersonly1(this, event)" class="form-control" value="<?php echo isset($infoTP->KRJSAMA) ? $infoTP->KRJSAMA : ''; ?>">
                      </div>
                    </div>

                    <div class="form-group pickerpicker">
                      <label class="col-sm-4 control-label">NH Krjsama</label>
                      <div class="input-group col-sm-6">
                         <input type="text" id="nh_krjsama" name="nh_krjsama" placeholder="NH Krjsama" maxlength="2"  class="form-control" value="<?php echo isset($infoTP->NH_KRJSAMA) ? $infoTP->NH_KRJSAMA : ''; ?>">
                      </div>
                    </div>

                    <div class="form-group pickerpicker">
                      <label class="col-sm-4 control-label">Total Sikapker</label>
                      <div class="input-group col-sm-6">
                         <input type="text" id="total_sikapker" name="total_sikapker" placeholder="Total Sikapker (numbers only)" maxlength="4" onkeypress="return numbersonly1(this, event)" class="form-control" value="<?php echo isset($infoTP->TOTAL_SIKAPKER) ? $infoTP->TOTAL_SIKAPKER : ''; ?>">
                      </div>
                    </div>
                
                    <div class="form-group pickerpicker">
                      <label class="col-sm-4 control-label">Daldiri</label>
                      <div class="input-group col-sm-6">
                         <input type="text" id="daldiri" name="daldiri" placeholder="Daldiri (numbers only)" maxlength="3" onkeypress="return numbersonly1(this, event)" class="form-control" value="<?php echo isset($infoTP->DALDIRI) ? $infoTP->DALDIRI : ''; ?>">
                      </div>
                    </div>

                    <div class="form-group pickerpicker">
                      <label class="col-sm-4 control-label">NH Daldiri</label>
                      <div class="input-group col-sm-6">
                         <input type="text" id="nh_daldiri" name="nh_daldiri" placeholder="NH Daldiri" maxlength="2"  class="form-control" value="<?php echo isset($infoTP->NH_DALDIRI) ? $infoTP->NH_DALDIRI : ''; ?>">
                      </div>
                    </div>

                    <div class="form-group pickerpicker">
                      <label class="col-sm-4 control-label">PSosial</label>
                      <div class="input-group col-sm-6">
                         <input type="text" id="psosial" name="psosial" placeholder="Psosial (numbers only)" maxlength="3" onkeypress="return numbersonly1(this, event)" class="form-control" value="<?php echo isset($infoTP->PSOSIAL) ? $infoTP->PSOSIAL : ''; ?>">
                      </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group pickerpicker">
                      <label class="col-sm-4 control-label">NH Psosial</label>
                      <div class="input-group col-sm-6">
                         <input type="text" id="nh_psosial" name="nh_psosial" placeholder="NH Psosial" maxlength="2"  class="form-control" value="<?php echo isset($infoTP->NH_PSOSIAL) ? $infoTP->NH_PSOSIAL : ''; ?>">
                      </div>
                    </div>

                    <div class="form-group pickerpicker">
                      <label class="col-sm-4 control-label">Komunika</label>
                      <div class="input-group col-sm-6">
                         <input type="text" id="komunika" name="komunika" placeholder="Komunika (numbers only)" maxlength="3" onkeypress="return numbersonly1(this, event)" class="form-control" value="<?php echo isset($infoTP->KOMUNIKA) ? $infoTP->KOMUNIKA : ''; ?>">
                      </div>
                    </div>

                    <div class="form-group pickerpicker">
                      <label class="col-sm-4 control-label">NH Komunika</label>
                      <div class="input-group col-sm-6">
                         <input type="text" id="nh_komunika" name="nh_komunika" placeholder="NH Komunika" maxlength="2"  class="form-control" value="<?php echo isset($infoTP->NH_KOMUNIKA) ? $infoTP->NH_KOMUNIKA : ''; ?>">
                      </div>
                    </div>

                    <div class="form-group pickerpicker">
                      <label class="col-sm-4 control-label">Percaya</label>
                      <div class="input-group col-sm-6">
                         <input type="text" id="percaya" name="percaya" placeholder="Percaya (numbers only)" maxlength="3" onkeypress="return numbersonly1(this, event)" class="form-control" value="<?php echo isset($infoTP->PERCAYA) ? $infoTP->PERCAYA : ''; ?>">
                      </div>
                    </div>

                    <div class="form-group pickerpicker">
                      <label class="col-sm-4 control-label">NH Percaya</label>
                      <div class="input-group col-sm-6">
                         <input type="text" id="nh_percaya" name="nh_percaya" placeholder="NH Percaya" maxlength="2"  class="form-control" value="<?php echo isset($infoTP->NH_PERCAYA) ? $infoTP->NH_PERCAYA : ''; ?>">
                      </div>
                    </div>

                    <div class="form-group pickerpicker">
                      <label class="col-sm-4 control-label">Total Pribadi</label>
                      <div class="input-group col-sm-6">
                         <input type="text" id="total_pribadi" name="total_pribadi" placeholder="Total Pribadi (numbers only)" maxlength="4" onkeypress="return numbersonly1(this, event)" class="form-control" value="<?php echo isset($infoTP->TOTAL_PRIBADI) ? $infoTP->TOTAL_PRIBADI : ''; ?>">
                      </div>
                    </div>
                
                    <div class="form-group pickerpicker">
                      <label class="col-sm-4 control-label">Pimpin TP</label>
                      <div class="input-group col-sm-6">
                         <input type="text" id="pimpin_tp" name="pimpin_tp" placeholder="Pimpin TP (numbers only)" maxlength="3" onkeypress="return numbersonly1(this, event)" class="form-control" value="<?php echo isset($infoTP->PIMPIN_TP) ? $infoTP->PIMPIN_TP : ''; ?>">
                      </div>
                    </div>

                    <div class="form-group pickerpicker">
                      <label class="col-sm-4 control-label">NH Pimpin TP</label>
                      <div class="input-group col-sm-6">
                         <input type="text" id="nh_pimpin_tp" name="nh_pimpin_tp" placeholder="NH Pimpin TP" maxlength="2"  class="form-control" value="<?php echo isset($infoTP->NH_PIMPIN_TP) ? $infoTP->NH_PIMPIN_TP : ''; ?>">
                      </div>
                    </div>

                    <div class="form-group pickerpicker">
                      <label class="col-sm-4 control-label">Prencana</label>
                      <div class="input-group col-sm-6">
                         <input type="text" id="prencana" name="prencana" placeholder="Prencana (numbers only)" maxlength="3" onkeypress="return numbersonly1(this, event)" class="form-control" value="<?php echo isset($infoTP->PRENCANA) ? $infoTP->PRENCANA : ''; ?>">
                      </div>
                    </div>

                    <div class="form-group pickerpicker">
                      <label class="col-sm-4 control-label">NH Prencana</label>
                      <div class="input-group col-sm-6">
                         <input type="text" id="nh_prencana" name="nh_prencana" placeholder="NH Prencana" maxlength="2"  class="form-control" value="<?php echo isset($infoTP->NH_PRENCANA) ? $infoTP->NH_PRENCANA : ''; ?>">
                      </div>
                    </div>

                    <div class="form-group pickerpicker">
                      <label class="col-sm-4 control-label">Keputusan</label>
                      <div class="input-group col-sm-6">
                         <input type="text" id="kputusan" name="kputusan" placeholder="Keputusan (numbers only)" maxlength="3" onkeypress="return numbersonly1(this, event)" class="form-control" value="<?php echo isset($infoTP->KPUTUSAN) ? $infoTP->KPUTUSAN : ''; ?>">
                      </div>
                    </div>

                    <div class="form-group pickerpicker">
                      <label class="col-sm-4 control-label">NH Keputusan</label>
                      <div class="input-group col-sm-6">
                         <input type="text" id="nh_kputusan" name="nh_kputusan" placeholder="NH Keputusan" maxlength="2"  class="form-control" value="<?php echo isset($infoTP->NH_KPUTUSAN) ? $infoTP->NH_KPUTUSAN : ''; ?>">
                      </div>
                    </div>

                    <div class="form-group pickerpicker">
                      <label class="col-sm-4 control-label">Waskat</label>
                      <div class="input-group col-sm-6">
                         <input type="text" id="waskat" name="waskat" placeholder="Waskat (numbers only)" maxlength="3" onkeypress="return numbersonly1(this, event)" class="form-control" value="<?php echo isset($infoTP->WASKAT) ? $infoTP->WASKAT : ''; ?>">
                      </div>
                    </div>

                    <div class="form-group pickerpicker">
                      <label class="col-sm-4 control-label">NH Waskat</label>
                      <div class="input-group col-sm-6">
                         <input type="text" id="nh_waskat" name="nh_waskat" placeholder="NH Waskat" maxlength="2"  class="form-control" value="<?php echo isset($infoTP->NH_WASKAT) ? $infoTP->NH_WASKAT : ''; ?>">
                      </div>
                    </div>

                    <div class="form-group pickerpicker">
                      <label class="col-sm-4 control-label">Mandiri</label>
                      <div class="input-group col-sm-6">
                         <input type="text" id="mandiri" name="mandiri" placeholder="Mandiri (numbers only)" maxlength="3" onkeypress="return numbersonly1(this, event)" class="form-control" value="<?php echo isset($infoTP->MANDIRI) ? $infoTP->MANDIRI : ''; ?>">
                      </div>
                    </div>

                    <div class="form-group pickerpicker">
                      <label class="col-sm-4 control-label">NH Mandiri</label>
                      <div class="input-group col-sm-6">
                         <input type="text" id="nh_mandiri" name="nh_mandiri" placeholder="NH Mandiri" maxlength="2"  class="form-control" value="<?php echo isset($infoTP->NH_MANDIRI) ? $infoTP->NH_MANDIRI : ''; ?>">
                      </div>
                    </div>

                    <div class="form-group pickerpicker">
                      <label class="col-sm-4 control-label">Negosia</label>
                      <div class="input-group col-sm-6">
                         <input type="text" id="negosia" name="negosia" placeholder="Negosia (numbers only)" maxlength="3" onkeypress="return numbersonly1(this, event)" class="form-control" value="<?php echo isset($infoTP->NEGOSIA) ? $infoTP->NEGOSIA : ''; ?>">
                      </div>
                    </div>

                    <div class="form-group pickerpicker">
                      <label class="col-sm-4 control-label">NH Negosia</label>
                      <div class="input-group col-sm-6">
                         <input type="text" id="nh_negosia" name="nh_negosia" placeholder="NH Negosia" maxlength="2"  class="form-control" value="<?php echo isset($infoTP->NH_NEGOSIA) ? $infoTP->NH_NEGOSIA : ''; ?>">
                      </div>
                    </div>

                    <div class="form-group pickerpicker">
                      <label class="col-sm-4 control-label">Total Manajer</label>
                      <div class="input-group col-sm-6">
                         <input type="text" id="total_manajer" name="total_manajer" placeholder="Total Manajer (numbers only)" maxlength="4" onkeypress="return numbersonly1(this, event)" class="form-control" value="<?php echo isset($infoTP->TOTAL_MANAJER) ? $infoTP->TOTAL_MANAJER : ''; ?>">
                      </div>
                    </div>

                    <div class="form-group pickerpicker">
                      <label class="col-sm-4 control-label">Total TP</label>
                      <div class="input-group col-sm-6">
                         <input type="text" id="total_tp" name="total_tp" placeholder="Total TP (numbers only)" maxlength="5" onkeypress="return numbersonly1(this, event)" class="form-control" value="<?php echo isset($infoTP->TOTAL_TP) ? $infoTP->TOTAL_TP : ''; ?>">
                      </div>
                    </div>

                    <div class="form-group pickerpicker" id="data_2">
                        <label class="col-sm-4 control-label">Tgl. Test TP</label>
                        <div class="input-group col-sm-7 date">
                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" id="tgl_testtp" name="tgl_testtp" placeholder="Tgl. Test TP" value="<?php echo isset($infoTP->TGL_TESTTP) ? $infoTP->TGL_TESTTP : '' ?>" class="form-control" readonly="true">
                        </div>
                    </div>

                    <div class="form-group pickerpicker">
                      <label class="col-sm-4 control-label">Kategori</label>
                      <div class="input-group col-sm-6">
                         <input type="text" id="katagori" name="katagori" placeholder="Kategori" maxlength="1"  class="form-control" value="<?php echo isset($infoTP->KATAGORI) ? $infoTP->KATAGORI : ''; ?>">
                      </div>
                    </div>

                    <div class="form-group pickerpicker">
                      <label class="col-sm-4 control-label">Rumpun</label>
                      <div class="input-group col-sm-6">
                         <input type="text" id="rumpu" name="rumpun" placeholder="Rumpun" maxlength="50"  class="form-control" value="<?php echo isset($infoTP->RUMPUN) ? $infoTP->RUMPUN : ''; ?>">
                      </div>
                    </div>

                    <div class="form-group pickerpicker">
                      <label class="col-sm-4 control-label">IQ</label>
                      <div class="input-group col-sm-6">
                         <input type="text" id="iq" name="iq" placeholder="IQ" maxlength="3" onkeypress="return numbersonly1(this, event)" class="form-control" value="<?php echo isset($infoTP->IQ) ? $infoTP->IQ : ''; ?>">
                      </div>
                    </div>

                    <div class="form-group pickerpicker">
                      <label class="col-sm-4 control-label">Saran 1</label>
                      <div class="input-group col-sm-6">
                         <input type="text" id="saran1" name="saran1" placeholder="Saran 1" maxlength="75" class="form-control" value="<?php echo isset($infoTP->SARAN1) ? $infoTP->SARAN1 : ''; ?>">
                      </div>
                    </div>

                    <div class="form-group pickerpicker">
                      <label class="col-sm-4 control-label">Saran 2</label>
                      <div class="input-group col-sm-6">
                         <input type="text" id="saran2" name="saran2" placeholder="Saran 2" maxlength="75" class="form-control" value="<?php echo isset($infoTP->SARAN2) ? $infoTP->SARAN2 : ''; ?>">
                      </div>
                    </div>

                    <div class="form-group pickerpicker">
                      <label class="col-sm-4 control-label">Saran 3</label>
                      <div class="input-group col-sm-6">
                         <input type="text" id="saran3" name="saran3" placeholder="Saran 3" maxlength="75" class="form-control" value="<?php echo isset($infoTP->SARAN3) ? $infoTP->SARAN3 : ''; ?>">
                      </div>
                    </div>

                    <div class="form-group pickerpicker">
                      <label class="col-sm-4 control-label">Saran 4</label>
                      <div class="input-group col-sm-6">
                         <input type="text" id="saran4" name="saran4" placeholder="Saran 4" maxlength="75" class="form-control" value="<?php echo isset($infoTP->SARAN4) ? $infoTP->SARAN4 : ''; ?>">
                      </div>
                    </div>

                    <div class="form-group pickerpicker">
                      <label class="col-sm-4 control-label">Saran 5</label>
                      <div class="input-group col-sm-6">
                         <input type="text" id="saran5" name="saran5" placeholder="Saran 5" maxlength="75" class="form-control" value="<?php echo isset($infoTP->SARAN5) ? $infoTP->SARAN5 : ''; ?>">
                      </div>
                    </div>

                    <div class="form-group pickerpicker">
                      <label class="col-sm-4 control-label">Keadaan</label>
                      <div class="input-group col-sm-6">
                         <input type="text" id="keadaan" name="keadaan" placeholder="Keadaan" maxlength="1" class="form-control" value="<?php echo isset($infoTP->KEADAAN) ? $infoTP->KEADAAN : ''; ?>">
                      </div>
                    </div>

                </div>
                
                <!-- END SIDE 1 -->            
            </div>                                                              
           
        
    </div>
    <div class="modal-footer">
          <span class="pull-left">
              <label class="msg text-success"></label>
              <label class="err text-danger"></label>
          </span>
          <button type="button" class="btn btn-danger" data-dismiss="modal">Tutup</button>
          <button type="submit" class="btn btn-primary">Simpan</button>
    </div>
</form>

<script type="text/javascript">

$(document).ready(function(){

    $('#defaultForm2').bootstrapValidator({
        live: 'enabled',
        excluded : 'disabled',
        message: 'This value is not valid',
        feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
            //==============
            
            tgl_testtp: {
                validators: {
                   notEmpty: {
                        message: 'Tanggal tidak boleh kosong'
                    },
                    date: {
                        format: 'DD-MM-YYYY',
                        message: 'Date is not valid'
                    }
                }
            },
            nrk: {
                validators: {
                   notEmpty: {
                        message: 'NRK tidak boleh kosong'
                    } 
                }
            },
            noserta: {
                validators: {
                   notEmpty: {
                        message: 'Nomor Serta tidak boleh kosong'
                    } 
                }
            },
            intel: {
                validators: {
                   notEmpty: {
                        message: 'Intel tidak boleh kosong'
                    } 
                }
            },
            nh_intel: {
                validators: {
                   notEmpty: {
                        message: 'NH Intel tidak boleh kosong'
                    } 
                }
            },
            konsep: {
                validators: {
                   notEmpty: {
                        message: 'Konsep tidak boleh kosong'
                    } 
                }
            },
            nh_konsep: {
                validators: {
                   notEmpty: {
                        message: 'NH Konsep tidak boleh kosong'
                    } 
                }
            },
            alpermas: {
                validators: {
                   notEmpty: {
                        message: 'Alpermas tidak boleh kosong'
                    } 
                }
            },
            nh_alpermas: {
                validators: {
                   notEmpty: {
                        message: 'NH Alpermas tidak boleh kosong'
                    } 
                }
            },
            mkomplek: {
                validators: {
                   notEmpty: {
                        message: ' Mkomplek tidak boleh kosong'
                    } 
                }
            },
            nh_mkomplek: {
                validators: {
                   notEmpty: {
                        message: 'NH Mkomplek tidak boleh kosong'
                    } 
                }
            },
            kpraktis: {
                validators: {
                   notEmpty: {
                        message: 'KPraktis tidak boleh kosong'
                    } 
                }
            },
            nh_kpraktis: {
                validators: {
                   notEmpty: {
                        message: 'NH Kpraktis tidak boleh kosong'
                    } 
                }
            },
            wawasan: {
                validators: {
                   notEmpty: {
                        message: 'wawasan tidak boleh kosong'
                    } 
                }
            },
            nh_wawasan: {
                validators: {
                   notEmpty: {
                        message: 'NH Wawasan tidak boleh kosong'
                    } 
                }
            },
            total_cerdas: {
                validators: {
                   notEmpty: {
                        message: 'Total Cerdas tidak boleh kosong'
                    } 
                }
            },
            motpres: {
                validators: {
                   notEmpty: {
                        message: 'Motpres tidak boleh kosong'
                    } 
                }
            },
            nhmotpres: {
                validators: {
                   notEmpty: {
                        message: 'NH Motpres tidak boleh kosong'
                    } 
                }
            },
            efisien: {
                validators: {
                   notEmpty: {
                        message: 'Efisien tidak boleh kosong'
                    } 
                }
            },
            nh_efisien: {
                validators: {
                   notEmpty: {
                        message: 'NH Efisien tidak boleh kosong'
                    } 
                }
            },
            integrit: {
                validators: {
                   notEmpty: {
                        message: 'Integrit tidak boleh kosong'
                    } 
                }
            },
            nh_integrit: {
                validators: {
                   notEmpty: {
                        message: 'NH Integrit tidak boleh kosong'
                    } 
                }
            },
            stress: {
                validators: {
                   notEmpty: {
                        message: 'Stress tidak boleh kosong'
                    } 
                }
            },
            nh_stress: {
                validators: {
                   notEmpty: {
                        message: 'NH Stress tidak boleh kosong'
                    } 
                }
            },
            proaktiv_tp: {
                validators: {
                   notEmpty: {
                        message: 'Proaktiv TP tidak boleh kosong'
                    } 
                }
            },
            nh_proaktiv_tp: {
                validators: {
                   notEmpty: {
                        message: 'NH Proaktiv TP tidak boleh kosong'
                    } 
                }
            },
            krjsama: {
                validators: {
                   notEmpty: {
                        message: 'Kerja sama tidak boleh kosong'
                    } 
                }
            },
            nh_krjsama: {
                validators: {
                   notEmpty: {
                        message: 'NH Kerja Sama tidak boleh kosong'
                    } 
                }
            },
            total_sikapker: {
                validators: {
                   notEmpty: {
                        message: 'Total Sikapker tidak boleh kosong'
                    } 
                }
            },
            daldiri: {
                validators: {
                   notEmpty: {
                        message: 'Daldiri tidak boleh kosong'
                    } 
                }
            },
            nh_daldiri: {
                validators: {
                   notEmpty: {
                        message: 'NH Daldiri tidak boleh kosong'
                    } 
                }
            },
            psosial: {
                validators: {
                   notEmpty: {
                        message: 'Psosial tidak boleh kosong'
                    } 
                }
            },
            nh_psosial: {
                validators: {
                   notEmpty: {
                        message: 'NH Psosial tidak boleh kosong'
                    } 
                }
            },
            komunika: {
                validators: {
                   notEmpty: {
                        message: 'Komunika tidak boleh kosong'
                    } 
                }
            },
            nh_komunika: {
                validators: {
                   notEmpty: {
                        message: 'NH Komunika tidak boleh kosong'
                    } 
                }
            },
            percaya: {
                validators: {
                   notEmpty: {
                        message: 'Percaya tidak boleh kosong'
                    } 
                }
            },
            nh_percaya: {
                validators: {
                   notEmpty: {
                        message: 'NH Percaya tidak boleh kosong'
                    } 
                }
            },
            Kputusan: {
                validators: {
                   notEmpty: {
                        message: 'Keputusan tidak boleh kosong'
                    } 
                }
            },
            nh_kputusan: {
                validators: {
                   notEmpty: {
                        message: 'NH Keputusan Serta tidak boleh kosong'
                    } 
                }
            },
            waskat: {
                validators: {
                   notEmpty: {
                        message: 'Waskat tidak boleh kosong'
                    } 
                }
            },
            nh_waskat: {
                validators: {
                   notEmpty: {
                        message: 'NH Waskat tidak boleh kosong'
                    } 
                }
            },
            mandiri: {
                validators: {
                   notEmpty: {
                        message: 'Mandiri tidak boleh kosong'
                    } 
                }
            },
            nh_mandiri: {
                validators: {
                   notEmpty: {
                        message: 'NH Mandiri tidak boleh kosong'
                    } 
                }
            },
            negosia: {
                validators: {
                   notEmpty: {
                        message: 'Negosia tidak boleh kosong'
                    } 
                }
            },
            nh_negosia: {
                validators: {
                   notEmpty: {
                        message: 'NH negosia tidak boleh kosong'
                    } 
                }
            },
            total_manajer: {
                validators: {
                   notEmpty: {
                        message: 'Total Manajer tidak boleh kosong'
                    } 
                }
            },
            total_tp: {
                validators: {
                   notEmpty: {
                        message: 'Total TP tidak boleh kosong'
                    } 
                }
            },
            katagori: {
                validators: {
                   notEmpty: {
                        message: 'Kategori tidak boleh kosong'
                    } 
                }
            },
            rumpun: {
                validators: {
                   notEmpty: {
                        message: 'Rumpun tidak boleh kosong'
                    } 
                }
            },
            iq: {
                validators: {
                   notEmpty: {
                        message: 'IQ tidak boleh kosong'
                    } 
                }
            },
            keadaan: {
                validators: {
                   notEmpty: {
                        message: 'Keadaan tidak boleh kosong'
                    } 
                }
            }
            
          
            //==============
        }
    });

    
    $('#data_2 .input-group.date').datepicker({
        todayBtn: "linked",
        keyboardNavigation: false,
        forceParse: false,
        calendarWeeks: true,
        autoclose: true,
        format: "dd-mm-yyyy",
        endDate: new Date()
    }).on('changeDate', function(e) {
        $('#defaultForm2').bootstrapValidator('revalidateField', 'tgl_testtp');
        });

    

});

function numbersonly1(myfield, e, dec) 
{   
        var key; 
        var keychar; 
        if (window.event)
            key = window.event.keyCode; 
        else if (e) 
            key = e.which; 
        else 
            return true; 
        keychar = String.fromCharCode(key); 

        // control keys 
        if ((key==null) || (key==0) || (key==8) || (key==9) || (key==13) || (key==27) ) 
        return true; 

        // numbers 
        else if ((("0123456789").indexOf(keychar) > -1))
         return true; 

        // decimal point jump 
        else if (dec && (keychar == ".")) 
        { 
            myfield.form.elements[dec].focus(); return false; 
        } 
        else 
            return false; 
}

function save()
{
    var url;
    if(save_method == 'update')
    {
        url = "<?php echo site_url('home/ajax_update_testtp')?>";
    }
    else
    {
        url = "<?php echo site_url('home/ajax_add_testtp')?>";
    }

      $.ajax({
        url : url,
        type: "POST",
        data: $('#defaultForm2').serialize(),
        dataType: "JSON",
        beforeSend: function() {
            $('.msg').html('<div><div class="sk-spinner sk-spinner-rotating-plane"></div></div>');
            $('.err').html("");
        },
        success: function(data)
        {

           if(data.response == 'SUKSES'){
                $('.msg').html('<small>Data berhasil disimpan.</small>');
                $('.err').html('');

                $('#myModal').modal('hide');
                setTimeout(function () {
                    reload();
                }, 1000);

            }else{
                $('.msg').html('');
                $('.err').html("<small>Data gagal disimpan, silahkan coba kembali.</small>");
            }

        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error adding / update data');
        },
        complete: function() {

        }
    });
}
</script>