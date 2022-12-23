
$('#actions_div').hide();

var status_id = $('#status_id').val();
if (status_id != null && status_id == 'saved') {
    $('#actions_div').show();
}

$('#save').on('shown.bs.modal', function () {
    $('#myInput').trigger('focus')
})


//call to login validations
$('#save_action').click(function (e) {
  
    if (validation() == false) { 
        e.preventDefault();
    } else {
        $('#misgrading_action_home').submit();
    }
});


function validation(){

    var misgrade_category=$("#misgrade_category").val();
    var misgrade_level=$("#misgrade_level").val();
    var misgrade_action=$("#misgrade_action").val();
    var reason =$("#reason").val();
 
    var value_return = 'true';


    if(misgrade_category==""){

        $("#error_misgrade_category").show().text("Please Select the misgrade category !");
        $("#misgrade_category").addClass("is-invalid");
        $("#misgrade_category").click(function(){$("#error_misgrade_category").hide().text;$("#misgrade_category").removeClass("is-invalid");});
        value_return = 'false';
    }

    if(misgrade_level==""){

        $("#error_misgrade_level").show().text("Please Select the misgrade level.");
        $("#misgrade_level").addClass("is-invalid");
        $("#misgrade_level").click(function(){$("#error_misgrade_level").hide().text;$("#misgrade_level").removeClass("is-invalid");});
        value_return = 'false';
    }

    if(misgrade_action==""){

        $("#error_misgrade_action").show().text("Please Select the misgrade action !");
        $("#misgrade_action").addClass("is-invalid");
        $("#misgrade_action").click(function(){$("#error_misgrade_action").hide().text;$("#misgrade_action").removeClass("is-invalid");});
        value_return = 'false';
    }

    if(reason==""){

        $("#error_reason").show().text("Please enter valid reason !");
        $("#reason").addClass("is-invalid");
        $("#reason").click(function(){$("#error_reason").hide().text;$("#reason").removeClass("is-invalid");});
        value_return = 'false';
    }

    if(value_return == 'false'){
        var msg = "Please check some fields are missing or not proper.";
        renderToast('error', msg);
        return false;
    }else{
   
    }
}