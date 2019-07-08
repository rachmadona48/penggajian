$('.chosen').chosen({
    no_results_text: "No hemos encontrado resultados!",
	allow_single_deselect: true
});
$.validator.setDefaults({ ignore: ":hidden:not(select)" });
	$('form').validate({
        highlight: function(element) {
            $(element).closest('.form-group').addClass('has-error');
    },
    unhighlight: function(element) {
        $(element).closest('.form-group').removeClass('has-error');
    },
    errorElement: 'span',
    errorClass: 'help-block',
    errorPlacement: function(error, element) {
        if(element.parent('.input-group').length) {
            error.insertAfter(element.parent());
        } else {
            error.insertAfter(element);
        }
    }
});