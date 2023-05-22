
var whichUser = $('#which_user').val();
var status_id = $('#status_id').val();

if(whichUser == 'applicant' || status_id == 'sent'){
    $("#reason").prop( "disabled", true );
}


$("#final_submit").click(function(){

    var customer_id = $("#customer_id_value").val();

    $.ajax({
        type: "POST",
        url: "../othermodules/final_send_notice",
        data: {customer_id:customer_id},
        beforeSend: function (xhr) {
            xhr.setRequestHeader('X-CSRF-Token', $('[name="_csrfToken"]').val());
        },
        success: function(response){
            response = response.match(/~([^']+)~/)[1];
            if($.trim(response)=='done'){
                $.alert({
                    content:"The Show Cause Notice is Sent To the Firms.",
                    onClose: function(){
                        location.replace("../othermodules/misgrading_home");
                      
                    }
                });
            }
        }
    });
});