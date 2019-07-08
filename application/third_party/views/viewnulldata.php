<html>
<!-- jqueryForm -->
<script type="text/javascript" src="<?php echo base_url(); ?>assets/inspinia/js/jquery-2.1.1.js"></script>
<script src="<?php echo base_url(); ?>assets/inspinia/js/plugins/sweetalert/sweetalert.min.js"></script>
<script src="<?php echo base_url(); ?>assets/inspinia/js/inspinia.js"></script>
<script src="<?php echo base_url(); ?>assets/inspinia/js/plugins/pace/pace.min.js"></script>

<script type="text/javascript">
    $(document).ready(function(){
        cekNullData();
        
         window.setTimeout(redirect, 2000);

        function redirect(){
           
            window.history.back();
        }
    });
    
    function cekNullData(){
               swal({  type:"error", title: "DATA TIDAK DITEMUKAN!",  text: "Akan tertutup dalam 2 detik.",timer: 2000, showConfirmButton: false});
            }   
</script>
</html>