/* common input validations, added on 08/09/2022 by Shankhpal shende */

$(document).ready(function(){
	
	$(".allow_decimal").on("input", function(evt) {
		var self = $(this);
		self.val(self.val().replace(/[^0-9\.]/g, ''));
		if ((evt.which != 46 || self.val().indexOf('.') != -1) && (evt.which < 48 || evt.which > 57)) 
		{
			var xn = $(this).attr('id');
			$('#error_' + xn).html('Only alphabets allowed');
			$('#error_' + xn).css({"color":"#dc3545","box-shadow":"0 0 2px red!important","font-weight":"100","font-size":"13"});
		    
		}
		else{
			var xn = $(this).attr('id');
			$('#error_' + xn).html('');
			$(this).removeClass('invalid-fld');
			$(this).addClass('valid-fld');
		}
	  });
	// allow only aplhabetical characters
	$('.txtOnly').on('keypress', function(e){
		var k;
		document.all ? k = e.keyCode : k = e.which;
		if((k > 64 && k < 91) || (k > 96 && k < 123) || k == 8 || k == 32){

			var xn = $(this).attr('id');
			$('#error_' + xn).html('');
			$("#replica_charges").click(function(){$("#error_replica_charges").hide().text;
			$("#error_replica_charges").removeClass("is-invalid");});
			value_return = 'false';

		} else {

			var xn = $(this).attr('id');
			$('#error_' + xn).html('Only alphabets allowed');
			$('#error_' + xn).css({"color":"#dc3545","box-shadow":"0 0 2px red!important","font-weight":"100","font-size":"13"});
			$("#replica_charges").click(function(){$("#error_replica_charges").hide().text;
			$("#error_replica_charges").removeClass("is-invalid");});
			value_return = 'false';

		}
	});
    // allow only numerical values
	$('.numOnly').on('keypress', function(e){
		var k;
		document.all ? k = e.keyCode : k = e.which;
		if(k > 46 && k >= 48 && k <= 57){
			var xn = $(this).attr('id');
			$('#error_' + xn).html('');
			$(this).removeClass('invalid-fld');
			$(this).addClass('valid-fld');

		} else {
			var xn = $(this).attr('id');
			$('#error_' + xn).html('Only numeric values allowed');
            $('#error_' + xn).css({"color":"#dc3545","box-shadow":"0 0 2px red!important","font-weight":"100"});
			$(this).removeClass('valid-fld');
			$(this).addClass('invalid-fld');
			e.preventDefault();
			
		}
	});
    $('.numOnly').on('paste', (e) => {
	    var text = (e.originalEvent || e).clipboardData.getData('text/plain');
	    if(/^[a-zA-Z- ]*$/.test(text) == false) {

			var xn = e.target.id;
			$('#error_' + xn).html('Only numeric values allowed');
            $('#error_' + xn).css({"color":"#dc3545","box-shadow":"0 0 2px red!important","font-weight":"100"});
			$(this).removeClass('valid-fld');
			$(this).addClass('invalid-fld');
			e.preventDefault();

	    } else {

			var xn = e.target.id;
			$('#error_' + xn).html('');
			$(this).removeClass('valid-fld');
			$(this).addClass('invalid-fld');

	    }
	});

})
