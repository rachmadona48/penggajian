<?php
    // echo "<pre>";
    // print_r($listmenu);
    // echo "</pre>";
?>

<div class="wrapper wrapper-content  animated fadeInRight">
    <div class="row">
        <div class="col-md-4">
            <div id="nestable-menu">
                <button type="button" data-action="expand-all" class="btn btn-white btn-sm">Expand All</button>
                <button type="button" data-action="collapse-all" class="btn btn-white btn-sm">Collapse All</button>
            </div>
            </div>
        </div>
    <div class="row">
        <div class="col-lg-6">
            <div class="ibox ">
                <div class="ibox-title">
                    <h5>Nestable List Menu</h5>
                </div>
                <div class="ibox-content">                    

                    <div class="dd" id="nestable">
                        <ol class="dd-list">
                            <?php 
                                foreach ($listmenu as $key => $value) {
                                    echo '<li class="dd-item" data-id="'.$value->id_menu.'">
                                            <div class="dd-handle">- '.$value->nama_menu.'</div>
                                        </li>';
                                }
                            ?>
                            <!-- <li class="dd-item" data-id="1">
                                <div class="dd-handle">1 - Lorem ipsum</div>
                            </li>
                            <li class="dd-item" data-id="2">
                                <div class="dd-handle">2 - Dolor sit</div>
                                <ol class="dd-list">
                                    <li class="dd-item" data-id="3">
                                        <div class="dd-handle">3 - Adipiscing elit</div>
                                    </li>
                                    <li class="dd-item" data-id="4">
                                        <div class="dd-handle">4 - Nonummy nibh</div>
                                    </li>
                                </ol>
                            </li>
                            <li class="dd-item" data-id="5">
                                <div class="dd-handle">5 - Consectetuer</div>
                                <ol class="dd-list">
                                    <li class="dd-item" data-id="6">
                                        <div class="dd-handle">6 - Aliquam erat</div>
                                    </li>
                                    <li class="dd-item" data-id="7">
                                        <div class="dd-handle">7 - Veniam quis</div>
                                    </li>
                                </ol>
                            </li>
                            <li class="dd-item" data-id="8">
                                <div class="dd-handle">8 - Tation ullamcorper</div>
                            </li>
                            <li class="dd-item" data-id="9">
                                <div class="dd-handle">9 - Ea commodo</div>
                            </li> -->
                        </ol>
                    </div>
                    <div class="m-t-md">
                        <h5>Serialised Output</h5>
                    </div>
                    <textarea id="nestable-output" class="form-control"></textarea>

                </div>
            </div>
        </div>
        
    </div>
</div>

<!-- END WIZARD -->

        <!-- Mainly scripts -->
        <script src="<?php echo base_url(); ?>assets/inspinia/js/jquery-2.1.1.js"></script>
        <script src="<?php echo base_url(); ?>assets/inspinia/js/bootstrap.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/inspinia/js/plugins/metisMenu/jquery.metisMenu.js"></script>
        <script src="<?php echo base_url(); ?>assets/inspinia/js/plugins/slimscroll/jquery.slimscroll.min.js"></script>
        <!-- Mainly scripts -->

        <!-- Nestable List -->
        <script src="<?php echo base_url(); ?>assets/inspinia/js/plugins/nestable/jquery.nestable.js"></script>
        <!-- Nestable List -->

        <!-- Custom and plugin javascript -->
        <script src="<?php echo base_url(); ?>assets/inspinia/js/inspinia.js"></script>
        <script src="<?php echo base_url(); ?>assets/inspinia/js/plugins/pace/pace.min.js"></script>
        <!-- Custom and plugin javascript -->

        <!-- Date Picker -->
        <script src="<?php echo base_url(); ?>assets/inspinia/js/plugins/datapicker/bootstrap-datepicker.js"></script>
        <!-- Date Picker -->

        <script type="text/javascript">
            /** NESTABLE FOR MENU **/

             $(document).ready(function(){

                 var updateOutput = function (e) {
                     var list = e.length ? e : $(e.target),
                             output = list.data('output');
                     if (window.JSON) {
                         output.val(window.JSON.stringify(list.nestable('serialize')));//, null, 2));
                     } else {
                         output.val('JSON browser support required for this demo.');
                     }
                 };
                 // activate Nestable for list 1
                 $('#nestable').nestable({
                     group: 1
                 }).on('change', updateOutput);     

                 // output initial serialised data
                 updateOutput($('#nestable').data('output', $('#nestable-output')));     

                 $('#nestable-menu').on('click', function (e) {
                     var target = $(e.target),
                             action = target.data('action');
                     if (action === 'expand-all') {
                         $('.dd').nestable('expandAll');
                     }
                     if (action === 'collapse-all') {
                         $('.dd').nestable('collapseAll');
                     }
                 });
             });

            /** END NESTABLE FOR MENU **/
        </script>