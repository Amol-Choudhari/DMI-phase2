$(document).ready(function() {

    //to disable all last details fields
    $(".last_details_change :input").prop("disabled",true);

    function change_appl_validation(){

        var firm_name=$("#firm_name").val();
        var mobile_no=$("#mobile_no").val();
        var email_id=$("#email_id").val();
        var phone_no=$("#phone_no").val();
        var street_address=$("#street_address").val();
        var state=$("#state").val();
        var district=$("#district").val();
        var postal_code=$("#postal_code").val();
        var lab_name=$("#lab_name").val();
        var lab_type=$("#lab_type").val();
        var chemist_details_docs=$("#chemist_details_docs").val();
        var lab_equipped_docs=$("#lab_equipped_docs").val();
        var lab_consent_docs=$("#lab_consent_docs").val();
        var category=$("#category").val();
        var commodity=$("#commodity").val();
        var selected_commodity=$("#selected_commodity").val();
        var packing_types=$("#packing_types").val();
        var selected_packing_types=$("#selected_packing_types").val();

        var value_return = 'true';

        if(firm_name==""){				
            $("#error_firm_name").show().text("Please enter firm name");
            $("#firm_name").addClass("is-invalid");
            $("#firm_name").click(function(){$("#error_firm_name").hide().text; $("#firm_name").removeClass("is-invalid");});
            value_return = 'false';
        }
        if(mobile_no==""){				
            $("#error_mobile_no").show().text("Please enter mobile number");
            $("#mobile_no").addClass("is-invalid");
            $("#mobile_no").click(function(){$("#error_mobile_no").hide().text; $("#mobile_no").removeClass("is-invalid");});
            value_return = 'false';
        }
        if(email_id==""){				
            $("#error_email_id").show().text("Please enter email id");
            $("#email_id").addClass("is-invalid");
            $("#email_id").click(function(){$("#error_email_id").hide().text; $("#email_id").removeClass("is-invalid");});
            value_return = 'false';
        }
        if(phone_no==""){				
            $("#error_phone_no").show().text("Please enter phone number");
            $("#phone_no").addClass("is-invalid");
            $("#phone_no").click(function(){$("#error_phone_no").hide().text; $("#phone_no").removeClass("is-invalid");});
            value_return = 'false';
        }
        if(street_address==""){				
            $("#error_street_address").show().text("Please enter Street Address");
            $("#street_address").addClass("is-invalid");
            $("#street_address").click(function(){$("#error_street_address").hide().text; $("#street_address").removeClass("is-invalid");});
            value_return = 'false';
        }
        if(state==""){				
            $("#error_state").show().text("Please select state");
            $("#state").addClass("is-invalid");
            $("#state").click(function(){$("#error_state").hide().text; $("#state").removeClass("is-invalid");});
            value_return = 'false';
        }
        if(district==""){				
            $("#error_district").show().text("Please district state");
            $("#district").addClass("is-invalid");
            $("#district").click(function(){$("#error_district").hide().text; $("#district").removeClass("is-invalid");});
            value_return = 'false';
        }
        if(postal_code==""){				
            $("#error_postal_code").show().text("Please enter pin code");
            $("#postal_code").addClass("is-invalid");
            $("#postal_code").click(function(){$("#error_postal_code").hide().text; $("#postal_code").removeClass("is-invalid");});
            value_return = 'false';
        }
        if(lab_name==""){				
            $("#error_lab_name").show().text("Please enter Laboratory name");
            $("#lab_name").addClass("is-invalid");
            $("#lab_name").click(function(){$("#error_lab_name").hide().text; $("#lab_name").removeClass("is-invalid");});
            value_return = 'false';
        }
        if(lab_type==""){				
            $("#error_lab_type").show().text("Please enter Laboratory type");
            $("#lab_type").addClass("is-invalid");
            $("#lab_type").click(function(){$("#error_lab_type").hide().text; $("#lab_type").removeClass("is-invalid");});
            value_return = 'false';
        }
        if(chemist_details_docs==""){				
            $("#error_chemist_details_docs").show().text("Please select related file");
            $("#chemist_details_docs").addClass("is-invalid");
            $("#chemist_details_docs").click(function(){$("#error_chemist_details_docs").hide().text; $("#chemist_details_docs").removeClass("is-invalid");});
            value_return = 'false';
        }
        if(lab_equipped_docs==""){				
            $("#error_lab_equipped_docs").show().text("Please select related file");
            $("#lab_equipped_docs").addClass("is-invalid");
            $("#lab_equipped_docs").click(function(){$("#error_lab_equipped_docs").hide().text; $("#lab_equipped_docs").removeClass("is-invalid");});
            value_return = 'false';
        }
        if(lab_consent_docs==""){				
            $("#error_lab_consent_docs").show().text("Please select related file");
            $("#lab_consent_docs").addClass("is-invalid");
            $("#lab_consent_docs").click(function(){$("#error_lab_type").hide().text; $("#lab_consent_docs").removeClass("is-invalid");});
            value_return = 'false';
        }
        if(category==""){				
            $("#error_category").show().text("Please select Category");
            $("#category").addClass("is-invalid");
            $("#category").click(function(){$("#error_category").hide().text; $("#category").removeClass("is-invalid");});
            value_return = 'false';
        }
        if(commodity==""){				
            $("#error_commodity").show().text("Please select Commodity");
            $("#commodity").addClass("is-invalid");
            $("#commodity").click(function(){$("#error_commodity").hide().text; $("#commodity").removeClass("is-invalid");});
            value_return = 'false';
        }
        if(selected_commodity==""){				
            $("#error_selected_commodity").show().text("Please add commodities");
            $("#selected_commodity").addClass("is-invalid");
            $("#selected_commodity").click(function(){$("#error_selected_commodity").hide().text; $("#selected_commodity").removeClass("is-invalid");});
            value_return = 'false';
        }
        if(packing_types==""){				
            $("#error_packing_types").show().text("Please select packing type");
            $("#packing_types").addClass("is-invalid");
            $("#packing_types").click(function(){$("#error_packing_types").hide().text; $("#packing_types").removeClass("is-invalid");});
            value_return = 'false';
        }
        if(selected_packing_types==""){				
            $("#error_selected_packing_types").show().text("Please add packing type");
            $("#selected_packing_types").addClass("is-invalid");
            $("#selected_packing_types").click(function(){$("#error_selected_packing_types").hide().text; $("#selected_packing_types").removeClass("is-invalid");});
            value_return = 'false';
        }

        if(value_return == 'false')
		{
			var msg = "Please check some fields are missing or not proper.";
			renderToast('error', msg);
			return false;
		}
		else{
			exit();
			
		}

    }

    $("#chemist_details_docs").click(function(){
        file_browse_onclick('chemist_details_docs');
    });

    $("#lab_equipped_docs").click(function(){
        file_browse_onclick('lab_equipped_docs');
    });

    $("#lab_consent_docs").click(function(){
        file_browse_onclick('lab_consent_docs');
    });


    function file_browse_onclick(field_id){
	
		var selected_file = $('#'.concat(field_id)).val();
		var ext_type_array = ["jpg" , "pdf"];
		
		var get_file_size = $('#'.concat(field_id))[0].files[0].size;
		var get_file_ext = selected_file.split(".");
		
		var value_return = 'true';
		
		get_file_ext = get_file_ext[get_file_ext.length-1].toLowerCase();
		
		if(get_file_size > 2097152){

			$("#error_size_".concat(field_id)).show().text("Please select file below 2mb");
			$("#error_size_".concat(field_id)).addClass("is-invalid");
			$("#".concat(field_id)).click(function(){$("#error_size_".concat(field_id)).hide().text; $("#".concat(field_id)).removeClass("is-invalid");});
			$('#'.concat(field_id)).val('')
			value_return = 'false';
		}
		
		
		if (ext_type_array.lastIndexOf(get_file_ext) == -1){
		
			$("#error_type_".concat(field_id)).show().text("Please select file of jpg, pdf type only");
			$("#error_type_".concat(field_id)).addClass("is-invalid");
			$("#".concat(field_id)).click(function(){$("#error_type_".concat(field_id)).hide().text;$("#".concat(field_id)).removeClass("is-invalid");});
			$('#'.concat(field_id)).val('');
			value_return = 'false';
		}
		
		if(value_return == 'false')
		{
			return false;
		}
		else{
			exit();			
		}
		
	}


});