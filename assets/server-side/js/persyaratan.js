$(document).ready(function(){
			load_tab_persyaratan();
			load_mekanisme();
			load_dasar_hukum();
			check_file();
			$("#batal_batal_CPNS_1, #batal_batal_CPNS_2, #batal_batal_CPNS_3, #batal_batal_PNS_1, #batal_batal_PNS_2, #batal_batal_PNS_3, #batal_batal_PAK_1, #batal_batal_PAK_2, #batal_batal_PAK_3, #batal_batal_IJZ_1, #batal_batal_IJZ_2, #batal_batal_IJZ_3,  #batal_batal_PGKT_1, #batal_batal_PGKT_2, #batal_batal_PGKT_3, #batal_batal_DP3_1, #batal_batal_DP3_2, #batal_batal_DP3_3, #batal_batal_SDIK_1, #batal_batal_SDIK_2, #batal_batal_SDIK_3, #batal_batal_SREK_1, #batal_batal_SREK_2, #batal_batal_SREK_3, #batal_batal_ADJ_1, #batal_batal_ADJ_2, #batal_batal_ADJ_3, #batal_batal_BSJ_1, #batal_batal_BSJ_2, #batal_batal_BSJ_3 #batal_batal_PAK_1, #batal_batal_PAK_2, #batal_batal_PAK_3, #batal_batal_PGKT_1, #batal_batal_PGKT_2, #batal_batal_PGKT_3,  #batal_batal_BUKTI_1, #batal_batal_BUKTI_2, #batal_batal_BUKTI_3").hide();
			$(".btn-group").hide();
			$(".CPNS_1, .CPNS_2, .CPNS_3, .PNS_1, .PNS_2, .PNS_3, .PAK_1, .PAK_2, .PAK_3, .IJZ_1, .IJZ_2, .IJZ_3,  .PGKT_1, .PGKT_2, .PGKT_3, .DP3_1, .DP3_2, .DP3_3, .SDIK_1, .SDIK_2, .SDIK_3, .SREK_1, .SREK_2, .SREK_3, .ADJ_1, .ADJ_2, .ADJ_3, .BSJ_1, .BSJ_2, .BSJ_3 .PAK_1, .PAK_2, .PAK_3, .PGKT_1, .PGKT_2, .PGKT_3,  .BUKTI_1, .BUKTI_2, .BUKTI_3").hide();
			//~$(".CPNS, .PNS, .PAK, .IJZ, .PGKT, .DP3, .SDIK, .SREK, .ADJ, .BSJ, .PAK, .PGKT, .BUKTI").hide();
			
			$('#jenis, #permohonan').on('change',function(){
				var jenis_val = $('#jenis').val();
				var permohonan_val = $('#permohonan').val();
				//~var init_syarat = ["CPNS", "PNS", "PAK", "IJZ", "PGKT", "DP3", "SDIK", "SREK", "ADJ", "BSJ", "PAK", "PGKT", "BUKTI"];
				//~var test = $('#pengangkatan').filter($('#batal_batal_CPNS').text());
				//~console.log(test);
				//~var count = init_syarat.length;
				//~console.log(init_syarat.length);
				//~$.each(count, function(i){
					//~console.log(init_syarat[count]);
					//~hide_batal_btn(init_syarat[count]);
				//~})
				load_tab_persyaratan();
				load_mekanisme();
				load_dasar_hukum()
				check_file();
				if(jenis_val == 1){
					$('#pengangkatan').show();
					$('#pengangkatan_kembali').hide();
					$('#pengangkatan_sementara').hide();
				}else if(jenis_val == 2){
					$('#pengangkatan').hide();
					$('#pengangkatan_kembali').show();
					$('#pembebasan_sementara').hide();
				}else if(jenis_val == 3){
					$('#pengangkatan').hide();
					$('#pengangkatan_kembali').hide();
					$('#pembebasan_sementara').show();
				}else{
					$('#pengangkatan').hide();
					$('#pengangkatan_kembali').hide();
					$('#pembebasan_sementara').hide();
				}
			})
			
			$('input[type=file]').on('change',function(){
				var init_syarat = $(this).attr('id');
				//~console.log($(this).attr('id'));
				//~$('#filename').show().text($(this).val());
				var test = this.files[0];
				if(!$(this).val()){
					//~console.log(this.files[0]);
					return false;
				}else{
					if(test.size > 3000000){
						$(this).val('');
						swal("Gagal!","File tidak di boleh melebihi 3MB.","error");
						//~$('#filename').show().text($(this).val());
						return false;
					}else{
						var split_init_syarat = init_syarat.split('_');
						//~console.log(split_init_syarat);
						//~return false;
						file_validation($(this).val(), test, split_init_syarat[0]);
					}
				}
			})
			
			//~$("#batal_batal_CPNS, #batal_batal_PNS, #batal_batal_PAK, #batal_batal_IJZ, #batal_batal_PGKT, #batal_batal_DP3, #batal_batal_SDIK, #batal_batal_SREK, #batal_batal_ADJ, #batal_batal_BSJ, #batal_batal_PAK, #batal_batal_PGKT").click(function(e){
				//~e.preventDefault();
				//~$("#status_status_CPNS, #status_status_PNS, #status_status_PAK, #status_status_IJZ, #status_status_PGKT, #status_status_DP3, #status_status_SDIK, #status_status_SREK, #status_status_ADJ, #status_status_BSJ, #status_status_PAK, #status_status_PGKT").show();
				//~$(".upCPNS, .upPNS, .upPAK, .upIJZ, .upPGKT, .upDP3, .upSDIK, .upSREK, .upADJ, .upBSJ, .upPAK, .upPGKT").hide();
				//~$(this).hide();
			//~})
		$('form').on('submit', function(e){
			e.preventDefault();
		})
			
        $('#btn_kirim').on('click', function(e){
            e.preventDefault();
            var valid = /false/gi
            var id_jenis_permohonan = $("#jenis").val();
            var id_permohonan = $("#permohonan").val();
            var url = "<?php echo base_url("index.php/permohonan/verify_from_server") ?>" + "/" + id_jenis_permohonan + "/" + id_permohonan;
            $.ajax({
	            url: url,
	            type: "POST",
	            data: {
					
				},
	            dataType: 'json',
	            success: function(data){
					//~console.log(valid.test(data))
					if(!valid.test(data)){
						insert_to_db();
						swal("Terima Kasih!","Data berhasil di simpan.","success");
						//~window.setTimeout(redirect, 1000);
			            //~function redirect(){
			                //~location.replace('<?php echo base_url("index.php/home/") ?>');    
			            //~}
						
						//~alert('Berhasil');
					}else{
						swal("Gagal!","Lengkapi semua file persyaratan.","error");
						return false;
						//~alert('Lengkapi semua file persyaratan');
					}
					//~console.log(data)
					//~insert_to_db()
					//~if(!data){
						//~return false;
					//~}else{
						//~insert_to_db()
						//~console.log(data)
					//~}
				},
	            error: function(xhr) {                              
	                
	            },
	            complete: function() {
					//~location.replace('<?php echo base_url("index.php/home/") ?>');              
	            }
	        });
	        window.setTimeout(redirect, 1981);
            function redirect(){
                location.replace('<?php echo base_url("index.php/home/") ?>');    
            }
            //~var sk_cpns_1 = $('#sk_cpns_1').val();
            //~if(!sk_cpns_1){
                //~alert('FC. SK CPNS(80%) Tidak boleh kosong !!!');
                //~return false;
            //~}else{
                //~tes_upload();    
            //~}
//~
            //~var sk_pns_1 = $('#sk_pns_1').val();
            //~if(!sk_pns_1){
                //~// $('errSk_pns_1').html('FC. SK PNS(100%) Tidak boleh kosong');
                //~alert('FC. SK PNS(100%) Tidak boleh kosong !!!');
                //~return false;
            //~}else{
                //~tes_upload();
            //~}
//~
//~
            //~var sk_pak_1 = $('#sk_pak_1').val();
            //~if(!sk_pak_1){
                //~alert('FC. SK PENETAPAN ANGKAT KREDIT(PAK) Tidak boleh kosong !!!');
                //~return false;
            //~}else{
                //~tes_upload(); 
            //~}
//~
            //~var ijazah_1 = $('#ijazah_1').val();
            //~if(!ijazah_1){
                //~alert('FC. IJAZAH TERAKHIR Tidak boleh kosong !!!');
                //~return false;
            //~}else{
                //~tes_upload(); 
            //~}
//~
            //~var sk_pgkt_1 = $('#sk_pgkt_1').val();
            //~if(sk_pgkt_1 == ""){
                //~alert('FC. SK PANGKAT TERAKHIR TIdak boleh kosong !!!');
                //~return false;
            //~}else{
                //~tes_upload(); 
            //~}
//~
            //~var dp3_1 = $('#dp3_1').val();
            //~if(dp3_1 == ""){
                //~alert('FC. DP3/SKP 1 TAHUN TERAKHIR Tidak boleh kosong !!!');
                //~return false;
            //~}else{
                //~tes_upload(); 
            //~}
//~
            //~var sdj_1 = $('#sdj_1').val();
            //~if(sdj_1 == ""){
                //~alert('FC. SERTIFIKAT DIKLAT JABFUNG Tidak boleh kosong !!!');
                //~return false;
            //~}else{
                //~tes_upload(); 
            //~}
//~
            //~var sr_1 = $('#sr_1').val();
            //~if(sr_1 == ""){
                //~alert('SURAT REKOMENDASI DARI INSTANSI PEMBINA Tidak boleh kosong !!!');
                //~return false;
            //~}else{
                //~tes_upload(); 
            //~}    
        })

        
        errmsg = "<?php echo $this->session->flashdata('errmsg'); ?>";
        if (errmsg !=''){
            swal({
                title: "Gagal!",
                text: "Data Gagal Diupload. "+errmsg,
                type: "error"
            });
        }

            //~onchangeJenis();
            

            //~$("#jenis").on("change", function(event) {
                //~event.preventDefault();
                    //~onchangeJenis();
            //~});

        });
        
        function load_mekanisme(){
			var id_kojabf = $("#ref_permohonan").val();
			var id_jenis_permohonan = $("#jenis").val();
			var id_permohonan = $("#permohonan").val();
			var url = "<?php echo base_url("index.php/permohonan/load_data_first") ?>";
			$.ajax({
	            url: url,
	            type: "POST",
	            data: {
					id_jenis_permohonan: id_jenis_permohonan, id_permohonan: id_permohonan, id_kojabf: id_kojabf, type: 1
				},
	            dataType: 'json',
	            success: function(data){
					if(!data){
						$("#mekanisme_tab").text('');
					}else{
						$("#mekanisme_tab").text(data.MEKANISME);
					}
				},
	            error: function(xhr) {                              
	                
	            },
	            complete: function() {              
	                
	            }
	        });
		}
		
		function load_tab_persyaratan(){
			var id_kojabf = $("#ref_permohonan").val();
			var id_jenis_permohonan = $("#jenis").val();
			var id_permohonan = $("#permohonan").val();
			var url = "<?php echo base_url("index.php/permohonan/get_data_for_tab") ?>";
			$.ajax({
	            url: url,
	            type: "POST",
	            data: {
					id_jenis_permohonan: id_jenis_permohonan, id_permohonan: id_permohonan, id_kojabf: id_kojabf
				},
	            dataType: 'json',
	            success: function(data){
					//~console.log(data);
					if(!data){
						$("#tab_persyaratan").after('');
					}else{
						$("#tab_persyaratan").after(data);
					}
					$(".btn-group").hide();
					
				},
	            error: function(xhr) {                              
	                
	            },
	            complete: function() {              
	                
	            }
	        });
		}
		
		function load_dasar_hukum(){
			var id_kojabf = $("#ref_permohonan").val();
			var id_jenis_permohonan = $("#jenis").val();
			var id_permohonan = $("#permohonan").val();
			var url = "<?php echo base_url("index.php/permohonan/load_data_first") ?>";
			$.ajax({
	            url: url,
	            type: "POST",
	            data: {
					id_jenis_permohonan: id_jenis_permohonan, id_permohonan: id_permohonan, id_kojabf: id_kojabf, type: 2
				},
	            dataType: 'json',
	            success: function(data){
					//~console.log(data);
					if(!data){
						$("#dasar_hukum_tab").text('');
					}else{
						$("#dasar_hukum_tab").text(data.DASAR_HUKUM);
					}
					
				},
	            error: function(xhr) {                              
	                
	            },
	            complete: function() {              
	                
	            }
	        });
		}
	
        
		function trigger_file_upload(init_syarat){
			$('#' + init_syarat).click();
		}
        
        function insert_to_db(){
			var id_jenis_permohonan = $("#jenis").val();
			var id_permohonan = $("#permohonan").val();
            var url = "<?php echo base_url("index.php/permohonan/insert_to_db") ?>";
			$.ajax({
	            url: url,
	            type: "POST",
	            data: {
					id_jenis_permohonan: id_jenis_permohonan, id_permohonan: id_permohonan, id_sop: id_jenis_permohonan
				},
	            dataType: 'json',
	            success: function(data){
					//~if(!data){
						//~return false;
					//~}else{
						//~insert_to_db()
						//~console.log(data)
					//~}
				},
	            error: function(xhr) {                              
	                
	            },
	            complete: function() {              
	                
	            }
	        });
		}
        
		function hide_batal_btn(init_syarat){
			var id_jenis_permohonan = $('#jenis').val();
			$("#status_" + init_syarat + "_" + id_jenis_permohonan).show();
			$(".up" + init_syarat + "_" + id_jenis_permohonan).hide();
			$("#batal_batal_" + init_syarat + "_" + id_jenis_permohonan).hide();
			//~return false;
		}	
        
        function check_file(){
			var id_jenis_permohonan = $('#jenis').val();
			var id_permohonan = $('#permohonan').val();
			var url = "<?php echo base_url("index.php/permohonan/check_if_file_exists") ?>";
			$.ajax({
	            url: url,
	            type: "POST",
	            data: {
					id_jenis_permohonan: id_jenis_permohonan, id_permohonan: id_permohonan
				},
	            dataType: 'json',
	            success: function(data){
					if(!data){
						return false;
					}else{
						//~console.log(data)
						$.each(data, function(i, item){
	//						console.log(data[i].split("@"));
							var split_array = data[i].split("@");
							var second_split = split_array[1].split(".");
							//~console.log(split_array)
							//~console.log(second_split[0]);
							$(".up" + second_split[0] + "_" + id_jenis_permohonan).hide();
							$("#batal_batal_" + second_split[0] + "_" + id_jenis_permohonan).hide();
							$("#status_" + second_split[0] + "_" + id_jenis_permohonan).show();
							$(".btn-group-" + second_split[0] + "_" + id_jenis_permohonan).show();
							$("#cek_file_" + second_split[0] + "_" + id_jenis_permohonan).attr('href','http://simpegdev.jakarta.go.id/'+data[i]+'');
							//~test(second_split[0], second_split[0], split_array[1]);
						})
	//					console.log(split_array);
					}
					//~console.log(split_array + ' ' + second_split);
				},
	            error: function(xhr) {                              
	                
	            },
	            complete: function() {              
	                
	            }
	        });
		}

		function showUpload(init_syarat){
			var id_jenis_permohonan = $('#jenis').val();
			//~console.log('#batal_batal_'+ init_syarat);
			//~$("#cek_file_" + init_syarat).remove();
			$("#status_" + init_syarat + "_" + id_jenis_permohonan).hide();
			$(".up" + init_syarat + "_" + id_jenis_permohonan).show();
			$("#batal_batal_" + init_syarat + "_" + id_jenis_permohonan).show();
		}

		function file_validation(prm, thisx, init_syarat){
			//~console.log(init_syarat + 'from file_validation');
			var ext = prm.split('.').pop().toLowerCase();
			//~console.log($(this).val());
			if($.inArray(ext, ['pdf','png','jpg','jpeg']) == -1) {
			    swal("Error!","Format tidak di dukung!.","error");
			}else{
				//~console.log(thisx);
				uploading(thisx, init_syarat);
			}
		}
		
		function test(init_syarat, split_array, data){
			//~console.log(split_array + ' ' + data);
			var id_jenis_permohonan = $('#jenis').val();
			$("#status_" + init_syarat + "_" + id_jenis_permohonan).show();
			$(".btn-group-" + init_syarat + "_" + id_jenis_permohonan).show();
			$("#cek_file_" + init_syarat + "_" + id_jenis_permohonan).attr('href','http://simpegdev.jakarta.go.id/assets/file_permohonan/'+split_array+'/'+data+'');
		}
		
		function uploading(thisx, init_syarat){
			//~console.log(init_syarat);
			//~return false;
			var formData = new FormData();
			//~console.log(value);
		    formData.append('file', thisx);
		    
		    //~$("#files").append($("#fileUploadProgressTemplate").tmpl());
		    //~$("#fileUploadError").addClass("hide");
		    var permohonan = $('#permohonan').val();
		    var jenis = $('#jenis').val();
		    
		    $.ajax({
		        url: '<?php echo base_url("index.php/permohonan/doaddaction")?>/' + init_syarat + '/' + permohonan + '/' + jenis,
		        type: 'POST',
		        xhr: function() {
		            var xhr = $.ajaxSettings.xhr();
		            if (xhr.upload) {
		                xhr.upload.addEventListener('progress', function(evt) {
							$("#batal_batal_" + init_syarat + "_" + jenis).hide();
							$(".up" + init_syarat + "_" + jenis).hide();
							$("." + init_syarat + "_" + jenis).show();
		                    var percent = (evt.loaded / evt.total) * 100;
		                    $("." + init_syarat + "_" + jenis).find(".progress-bar").width(percent + "%");
		                    $("." + init_syarat + "_" + jenis).find(".progress-bar").text(Math.round(percent) + "%");
		                }, false);
		            }
		            return xhr;
		        },
		        success: function(data) {
					$("." + init_syarat + "_" + jenis).hide();
					//$("#status_" + init_syarat).html("<h3>Berhasil di upload!</h3>").delay(2000).fadeOut(2200);
					var split_array = data.split("@");
					test(init_syarat, split_array[0], data);
					//~var url = "<?php echo base_url("assets/file_permohonan/") ?>/" + split_array[0] +"/"+ data;
					//~$("#status_" + init_syarat).show();
					//~$("#cek_file_" + init_syarat).attr('href','http://simpegdev.jakarta.go.id/assets/file_permohonan/'+split_array[0]+'/'+data+'');
					//~$(".batal_" + init_syarat).before("<a href='http://simpegdev.jakarta.go.id/assets/file_permohonan/"+split_array[0]+"/"+data+"' target='_blank' class='btn btn-success' id='cek_file_"+ init_syarat +"'>Cek file</a>");
					//~alert(data);
					//$('body').html(data);
					//~console.log(data)
		            //~$("#files").children().last().remove();
		            //~$("#files").append($("#fileUploadItemTemplate").tmpl(data));
		            //~$("#uploadFile").closest("form").trigger("reset");
		        },
		        error: function(data) {
					console.log('An error occured!');
		            //~$("#fileUploadError").removeClass("hide").text("An error occured!");
		            //~$("#files").children().last().remove();
		            //~$("#uploadFile").closest("form").trigger("reset");
		        },
		        data: formData,
		        //~data: {
					//~files : value 
				//~},
		        cache: false,
		        contentType: false,
		        processData: false
		    }, 'json');
		}
		
function tes_upload1()
        {
            var prm = $('#permohonan').val();
            var jns = $('#jenis').val();
            var nrk = $('#nrk').val();

            var sk_cpns_1 = $('#sk_cpns_1').val();
            var sk_pns_1 = $('#sk_pns_1').val();
            var sk_pak_1 = $('#sk_pak_1').val();
            var ijazah_1 = $('#ijazah_1').val();
            var sk_pgkt_1 = $('#sk_pgkt_1').val();
            var dp3_1 = $('#dp3_1').val();
            var sdj_1 = $('#sdj_1').val();
            var sr_1 = $('#sr_1').val();

            var sk_pdj_2 = $('#sk_pdj_2').val();
            var sk_psj_2 = $('#sk_psj_2').val();
            var sk_pak_2 = $('#sk_pak_2').val();
            var sk_pgkt_2 = $('#sk_pgkt_2').val();
            var ijazah_2 = $('#ijazah_2').val();
            var dp3_2 = $('#dp3_2').val();
            var sr_2 = $('#sr_2').val();

            var sk_pdj_3 = $('#sk_pdj_3').val();
            var sk_pak_3 = $('#sk_pak_3').val();
            var ijazah_3 = $('#ijazah_3').val();
            var dp3_3 = $('#dp3_3').val();
            var sk_pgkt_3 = $('#sk_pgkt_3').val();
            var bukti_3 = $('#bukti_3').val();

            
            $.ajax({
                    url: '<?php echo base_url("index.php/permohonan/doaddaction"); ?>/',
                    data: {
                        ID_PERMOHONAN : prm, ID_JENIS:jns, nrk:nrk, sk_cpns_1 : sk_cpns_1, sk_pns_1 : sk_pns_1, sk_pak_1 : sk_pak_1,ijazah_1:ijazah_1,
                        sk_pgkt_1 : sk_pgkt_1, dp3_1:dp3_1, sdj_1:sdj_1,sr_1:sr_1, sk_pdj_2:sk_pdj_2, sk_psj2 : sk_psj_2, sk_pak_2 : sk_pak_2,
                        sk_pgkt_2 : sk_pgkt_2, ijazah_2 :ijazah_2, dp3_2 : dp3_2, sr_2:sr_2, sk_pdj_3:sk_pdj_3, sk_pak_3 : sk_pak_3, ijazah_3 : ijazah_3,
                        dp3_3 : dp3_3, sk_pgkt_3:sk_pgkt_3, bukti_3 : bukti_3
                    },
                    type: 'post',
                    dataType: 'html',
                    // beforeSend: function() {                        
                    //     //$(".ibox-content").html(spinner);
                    // },
                    // success: function(data){
                    //     $('.ibox-content').html(data);
                    // }
                });
        }

        function tes_upload(){
        var url = "<?php echo $linkaction; ?>";

        $.ajax({
            url: url,
            type: "POST",
            // data: {'useridaa':$("#userid").val(),'usernameaa':$("#username").val()},
            data: $("#formUpload").serialize(),
            dataType: 'json',
            // success: function(data) {                               
                
            //     if(data.responeinsert == 'SUKSES'){
            //         alert("Sukses, "+data.test);                    
            //         // location.reload();
            //     }else{
            //         alert("GAGAL SIMPAN");
            //     }
            // },
            error: function(xhr) {                              
                
            },
            complete: function() {              
                
            }
        });
    }

        //~function readURL(input,id,eror,blah) 
        //~{
            //~$(id).val(input.value);
            //~//alert(a);
//~
            //~var ext = $(id).val().split('.').pop().toLowerCase();
            //~if($.inArray(ext, ['png','jpg','jpeg','pdf']) == -1) {
                //~$(eror).show();
                //~
                //~$(blah).hide();
            //~}else{
                //~
                //~$(eror).hide();
                //~$(blah).show();
//~
                //~if (input.files && input.files[0]) {
                    //~var reader = new FileReader();
//~
                    //~reader.onload = function (e) {
                        //~$(blah).attr('src', e.target.result);
                    //~}
//~
                    //~reader.readAsDataURL(input.files[0]);
                //~}
            //~}
        //~}



        function kirim_file(formid) {
                  
            var mohon = document.getElementById('permohonan').value;
            var cekJenis = document.getElementById('jenis').value;
            //alert (cekJenis);

            var dtbl;
            if(cekJenis == 1)
            {
                var a = document.getElementById('sk_cpns_1').value; 
                var b = document.getElementById('sk_pns_1').value;
                var c = document.getElementById('sk_pak_1').value;
                var d = document.getElementById('ijazah_1').value;
                var e = document.getElementById('sk_pgkt_1').value;
                var f = document.getElementById('dp3_1').value;
                var g = document.getElementById('sdj_1').value;
                var h = document.getElementById('sr_1').value;

            }
            else if(cekJenis == 2)
            {
                var a = document.getElementById('sk_cpns_1').value; 
                var b = document.getElementById('sk_pns_1').value;
                var c = document.getElementById('sk_pak_1').value;
                var d = document.getElementById('ijazah_1').value;
                var e = document.getElementById('sk_pgkt_1').value;
                var f = document.getElementById('dp3_1').value;
                var g = document.getElementById('sdj_1').value;
            }
            else
            {
                id_dtbl ='pembebasan_sementara';
            }
               
            }

            

            /*START CHOSEN*/
            var config = {
                  '.chosen-jenis'           : {no_results_text:'Oops, Data Tidak Ditemukan',width: "100%"},
                                }
                for (var selector in config) {
                  $(selector).chosen(config[selector]);
                }
            /*END CHOSEN*/

            //~function onchangeJenis()
            //~{
                //~var resJenis = document.getElementById('jenis').value;
                //~
                //~if(resJenis == 1)
                //~{
                    //~document.getElementById('pengangkatan').style.display = "";
                    //~document.getElementById('pengangkatan_kembali').style.display = "none";
                    //~document.getElementById('pembebasan_sementara').style.display = "none";
                //~}
                //~else if(resJenis == 2)
                //~{
                    //~document.getElementById('pengangkatan').style.display = "none";
                    //~document.getElementById('pengangkatan_kembali').style.display = "";
                    //~document.getElementById('pembebasan_sementara').style.display = "none";
                //~}
                //~else
                //~{
                    //~document.getElementById('pengangkatan').style.display = "none";
                    //~document.getElementById('pengangkatan_kembali').style.display = "none";
                    //~document.getElementById('pembebasan_sementara').style.display = "";
                //~}
            //~}

            function bigImg(x) {
                x.style.height = "450px";
                x.style.width = "auto";
            }

            function normalImg(x) {
                x.style.height = "170px";
                x.style.width = "auto";
            }

            function setNamaNip()
            {
                var valnrk = $('#valnrk').val();

                $.ajax({
                    url: '<?php echo base_url("index.php/laporan/getDtPgw"); ?>',
                    type: "post",
                    data: {
                        valnrk: valnrk
                    },
                    dataType: 'JSON',
                    beforeSend: function() {
                        $('.msg').html('');
                        $('.err').html("");
                    },
                    success: function(data) {
                        $('#value6').val(data.NAMA);
                        $('#value7').val(data.NIP18);
                    
                    },
                    error: function(xhr) {
                        $('.msg').html('');
                        $('.err').html("<small>Terjadi kesalahan</small>");
                    },
                    complete: function() {

                    }
                    
                });
            
            }

            
            function toggle() 
            {
                var ele = document.getElementById("formcol");
                var text = document.getElementById("displayText");

                if(ele.style.display != "none") 
                {
                    ele.style.display = "none";
                    text.innerHTML = "show";
                }

                else 
                {
                    ele.style.display = "";
                    text.innerHTML = "hide";
                }
            }
