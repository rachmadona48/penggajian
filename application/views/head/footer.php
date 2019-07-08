<input id="user_activity" name="user_activity" type="hidden" value="active" />
<input id="user_loged_in" name="user_loged_in" type="hidden" value="true" />


                <!-- START FOOTER -->

                <div class="footer">
                    <div class="pull-right">
                        Design by <strong>Diskominfomas DKI Jakarta</strong>
                    </div>
                    <div>
                        <strong>Copyright</strong> BADAN KEPEGAWAIAN DAERAH - Pemprov DKI Jakarta &copy; <?php echo date('Y') ?>
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

            $(document).ready(function() {

                      // reset main timer i,e idle time to 0 on mouse move, keypress or reload
                window.onload = reset_main_timer;
                document.onmousemove = reset_main_timer;
                document.onkeypress = reset_main_timer;

                // create main_timer and sub_timer variable with 0 value, we will assign them setInterval object
                var main_timer = 0;
                var sub_timer = 0;

                // this will ensure that timer will start only when user is loged in
                var user_loged_in = $("#user_loged_in").val()

               // within dilog_set_interval function we have created object of setInterval and assigned it to main_timer.
               // within this we have again created an object of setInterval and assigned it to sub_timer. for the main_timer
               // value is set to 15000000 i,e 25 minute.note that if subtimer repeat itself after 5 minute we set user_activity
               // flag to inactive
                function dialog_set_interval(){
                    main_timer = setInterval(function(){
                        if(user_loged_in == "true"){
                            //$("#inactivity_warning").modal("show");
                            sub_timer = setInterval(function(){
                                $("#user_activity").val("inactive")
                            },1200000);

                            window.location ="<?php echo site_url(); ?>/login/logout";
                        }
                    },1200000);
                }
               // maintimer is set to 0 by calling the clearInterval function. note that clearInterval function takes
               // setInterval object as argument, which it then set to 0
                function reset_main_timer(){
                    clearInterval(main_timer);
                    dialog_set_interval();
                }


            });

        </script>

    </body>

	<!-- Piwik -->
<script type="text/javascript">
  var _paq = _paq || [];
  // tracker methods like "setCustomDimension" should be called before "trackPageView"
  _paq.push(['trackPageView']);
  _paq.push(['enableLinkTracking']);
  (function() {
    var u="//wsa.jakarta.go.id/";
    _paq.push(['setTrackerUrl', u+'piwik.php']);
    _paq.push(['setSiteId', '7']);
    var d=document, g=d.createElement('script'), s=d.getElementsByTagName('script')[0];
    g.type='text/javascript'; g.async=true; g.defer=true; g.src=u+'piwik.js'; s.parentNode.insertBefore(g,s);
  })();
</script>
<!-- End Piwik Code -->


</html>
