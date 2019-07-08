/** START FUNCTION DO NOT EDIT **/

function isset() {
  //  discuss at: http://phpjs.org/functions/isset/
  // original by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
  // improved by: FremyCompany
  // improved by: Onno Marsman
  // improved by: Rafał Kukawski
  //   example 1: isset( undefined, true);
  //   returns 1: false
  //   example 2: isset( 'Kevin van Zonneveld' );
  //   returns 2: true

  var a = arguments,
    l = a.length,
    i = 0,
    undef;

  if (l === 0) {
    throw new Error('Empty isset');
  }

  while (i !== l) {
    if (a[i] === undef || a[i] === null) {
      return false;
    }
    i++;
  }
  return true;
}

/** END FUNCTION DO NOT EDIT **/


/** START SETTING VALIDASI **/

    $(document).ready(function() {
        /** Generate a simple captcha **/
        function randomNumber(min, max) {
            return Math.floor(Math.random() * (max - min + 1) + min);
        };
        $('#captchaOperation').html([randomNumber(1, 25), '+', randomNumber(1, 25), '='].join(' '));

        $('#defaultForm').bootstrapValidator({
            /** live: 'disabled', **/
            message: 'This value is not valid',
            feedbackIcons: {
                valid: 'glyphicon glyphicon-ok',
                invalid: 'glyphicon glyphicon-remove',
                validating: 'glyphicon glyphicon-refresh'
            },
            fields: {            
                username: {
                    message: 'NRK anda salah',
                    validators: {
                        notEmpty: {
                            message: 'NRK tidak boleh kosong'
                        },                    
                        regexp: {
                            regexp: /^[a-zA-Z0-9\.]+$/,
                            message: 'NRK hanya boleh huruf/nomor/titik'
                        }
                    }
                },            
                password: {
                    validators: {
                        notEmpty: {
                            message: 'Password tidak boleh kosong'
                        },                    
                        different: {
                            field: 'username',
                            message: 'Password tidak boleh sama dengan username'
                        }
                    }
                },            
                captcha: {
                    validators: {
                        callback: {
                            message: 'Jawaban salah',
                            callback: function(value, validator) {
                                var items = $('#captchaOperation').html().split(' '), sum = parseInt(items[0]) + parseInt(items[2]);
                                return value == sum;
                            }
                        }
                    }
                }
            }
        });
    });

/** END SETTING VALIDASI **/

/** START SETTING FUNCTION EDIT THIS **/

    $(document).ready(function(){
        var today = new Date();
        var dd    = today.getDate();
        var mm    = ("0" + (today.getMonth() + 1)).slice(-2); 
        var yyyy  = today.getFullYear(); 

        if(isset(document.getElementById('data_4'))){

            /** Datepicker Month Year (Ex Feb 2015) **/
            $('#data_4 .input-group.date').datepicker({
                        changeyear: false,
                        minViewMode: 1,
                        keyboardNavigation: false,
                        forceParse: false,
                        autoclose: true,
                        todayHighlight: true,
                        format: 'M yyyy'                
                    });

        }
            
        if(isset(document.getElementById('data_5'))){
            /** Datepicker Date Month Year (Ex 10/12/2015) **/
            $('#data_5 .input-group.date').datepicker({
                        changeyear: false,                        
                        keyboardNavigation: false,
                        forceParse: false,
                        autoclose: true,
                        todayHighlight: true,
                        format: 'dd/mm/yyyy'
                    });
        }

        
        if(isset(document.getElementById('data_6'))){
            /** Datepicker Date Month Year (Ex 10/12/2015) **/
            $('#data_6 .input-group.date').datepicker({
                        changeyear: false,                        
                        keyboardNavigation: false,
                        forceParse: false,
                        autoclose: true,
                        todayHighlight: true,
                        format: 'dd/mm/yyyy'
                    });
        }

        if(isset(document.getElementById('data_7'))){
            /** Datepicker Date Month Year (Ex 10/12/2015) **/
            $('#data_7 .input-group.date').datepicker({
                        changeyear: false,                        
                        keyboardNavigation: false,
                        forceParse: false,
                        autoclose: true,
                        todayHighlight: true,
                        format: 'dd/mm/yyyy'
                    });
        }
            

    });    

/** END SETTING FUNCTION EDIT THIS **/


/** BLOCKUI **/
function blocklayar(){
  $.blockUI({                         
        message: '<img src="../../../assets/inspinia/img/galaxy.gif" width="90px" height="60px"/> </br></br>Please Wait...',
        css: { 
            border: 'none', 
            padding: '10px', 
            fontSize:'17px',
            backgroundColor: '#000', 
            '-webkit-border-radius': '10px', 
            '-moz-border-radius': '10px', 
            'border-radius': '10px', 
            opacity: .5, 
            color: '#fff' 
        } 
    }); 
}

function unblocklayar(){
  $.unblockUI();
}
/** BLOCKUI **/


