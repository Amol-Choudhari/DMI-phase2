window.onload = function() {

	window.history.forward();
}

window.onunload = function() {
	//alert('yes');
null;
};

//setTimeout("preventBack()", 0);
window.onload = function() {

	window.history.forward();
}

window.onunload = function() {
	//alert('yes');
null;
};

//setTimeout("preventBack()", 0);

/**
 * CUSTOM JS VALIDATION ADDED FOR SECURITY AUDIT
 * By Aniket Ganvir dated 12th NOV 2020
 */
$(document).ready(function(){

	// DISABLE AUTOCOMPLETE
	$('input').attr('autocomplete', 'off');

	// SET MAXIMUM LENGTH FOR ALL INPUTS
	$("input[type='text']").attr('maxlength', '150');
	$("#mobileno").attr('maxlength', '10');
	$("textarea").attr('maxlength', '500');
	$("input[type='password']").attr('maxlength', '20'); // password field used in login, reset password
	$("input[type='number']").attr({'oninput': 'javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);', 'maxlength': '20'});
	// LOGIN FORM & FORGOT PASSSWORD FORM
	$("input[name='data[Dmi_user][email]']").attr('maxlength', '50'); // email
	$("input[name='data[Dmi_customer][customer_id]']").attr('maxlength', '50'); // company id / premises id
	$("#captchacode").attr('maxlength', '6'); // captcha

	// CLEAR INPUT FIELDS ON PAGE LOAD
	//$("input[name='data[Dmi_user][email]']").val('');
	$("#passwordValidation").val('');
	$("#captchacode").val('');
	$("input[name='data[Dmi_user][mobileno]']").val('');
	/* reset password DMI users, LIMS users*/
	$("input[name='data[Dmi_user][new_password]']").val('');
	$("input[name='data[Dmi_user][confirm_password]']").val('');


	//added new common script to validate somw special characters from the input fields
	//added on 17-02-2021 by Amol
	var specialChars = "<>();'\"\\=";
	//function to check special character in string
	var check = function(string){
		for(i = 0; i < specialChars.length;i++){
			if(string.indexOf(specialChars[i]) > -1){
				return true
			}
		}
		return false;
	}
	//check for text field
	$("input[type='text']").focusout(function(){

		var inputvalue = $(this).val();
		if(check(inputvalue) == false){
		// Code that needs to execute when none of the above is in the string
		}else{
			$.alert('You have entered invalid characters.');
			$(this).val('');
		}

	});
	//check for textarea
	$("textarea").focusout(function(){

		var inputvalue = $(this).val();
		if(check(inputvalue) == false){
		// Code that needs to execute when none of the above is in the string
		}else{
			$.alert('You have entered invalid characters.');
			$(this).val('');
		}
	});
	//check for email field
	$("input[type='email']").focusout(function(){

		var inputvalue = $(this).val();
		if(check(inputvalue) == false){
		// Code that needs to execute when none of the above is in the string
		}else{
			$.alert('You have entered invalid characters.');
			$(this).val('');
		}

	});
	//check for password field
	$("input[type='password']").focusout(function(){

		var inputvalue = $(this).val();
		if(check(inputvalue) == false){
		// Code that needs to execute when none of the above is in the string
		}else{
			$.alert('You have entered invalid characters.');
			$(this).val('');
		}

	});
	//check for search field
	$("input[type='search']").focusout(function(){

		var inputvalue = $(this).val();
		if(check(inputvalue) == false){
		// Code that needs to execute when none of the above is in the string
		}else{
			$.alert('You have entered invalid characters.');
			$(this).val('');
		}

	});


});
