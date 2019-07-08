

                <!-- START FOOTER -->

                <div class="footer">
                    <div class="pull-right">
                        Design by <strong>Diskominfomas DKI Jakarta</strong>
                    </div>
                    <div>
                        <strong>Copyright</strong> BADAN KEPEGAWAIAN DAERAH - Pemprov DKI Jakarta &copy; <?php echo date('Y')?>
                    </div>
                </div>                
                <!-- END FOOTER -->

            </div>
            <!-- END PAGE-WRAPPER -->
        </div>
        <!-- END WRAPPER -->        
        
        <!-- block UI -->
        <script src="<?php echo base_url(); ?>assets/inspinia/blockui/jquery.blockUI.js"></script>
        <!-- block UI -->

        <script type="text/javascript">
            // $(document).ready(function() { 
                
            //         $.blockUI({                         
            //             message: '<img src="<?php echo base_url(); ?>assets/inspinia/img/galaxy.gif" width="90px" height="60px"/> </br></br>Please Wait...', 
            //             css: { 
            //                 border: 'none', 
            //                 padding: '10px', 
            //                 fontSize:'17px',
            //                 backgroundColor: '#000', 
            //                 '-webkit-border-radius': '10px', 
            //                 '-moz-border-radius': '10px', 
            //                 'border-radius': '10px', 
            //                 opacity: .5, 
            //                 color: '#fff' 
            //             } 
            //         }); 
             
                    
            //         $(window).load(function(){
            //             $.unblockUI();
            //         });

            // });
            $('.navbar-minimalize').click(function(){
                if($('body').hasClass('body-small')){
                    $('.sidebar-collapse').slimScroll({
                        height: '100%',
                        railOpacity: 0.9
                    });
                    $('body').addClass('fixed-sidebar');
                }else{
                    $('.sidebar-collapse').slimscroll({destroy: true});
                    $('.sidebar-collapse').attr('style', '');
                    $('body').removeClass('fixed-sidebar');
                }
            })

        </script>

    </body>

</html>
