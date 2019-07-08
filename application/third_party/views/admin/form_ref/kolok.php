function kolok(id){
                    $.ajax({
                        url: "referensi/generateReferensi",
                        type: "post",
                        data: {id_referensi:$("#referensi_list").val(),kolok:id},
                        dataType: 'json',
                        beforeSend: function() {
                            $('#_content_referensi').removeAttr('class').attr('class', '');
                            var animation = 'fadeOutDown';
                            $('#_content_referensi').addClass('animated');
                            $('#_content_referensi').addClass(animation);
                            // return false;
                            $('#content_referensi').html('<div><img src="<?php echo base_url() ?>assets/inspinia/img/loading_bar.gif"></div>');
                            $('#checkproses').val('0');
                        },
                        success: function(data) {                                                                     
                            if(data.response == 'SUKSES'){                            
                                 $("#content_referensi").html(data.result);
                                 $('#checkproses').val('1');
                            }else{
                                 $("#content_referensi").html('');
                                 $('#checkproses').val('0');
                            }
                        },
                        error: function(xhr) {                              
                            if($('#checkproses').val() == 0){
                                $("#content_referensi").html("<small class='text-danger'>Silahkan Coba Kembali...</small>");
                            }
                        },
                        complete: function() {
                            $('.dataTables-example').dataTable({
                                // responsive: true,
                                "destroy" : true,
                                "scrollX": true
                            });

                            if($('#checkproses').val() == 0){
                                $("#content_referensi").html("<small class='text-danger'>Silahkan Coba Kembali...</small>");
                            }
                        }
                    });
            }