$(document).ready(function(){

});

jQuery(function() {

});


$('select[name=training_name]').on('change', function(){
    var training_id = $('select[name=training_name]').val();

    var root_url = window.location.protocol + "//" + window.location.host + "/";

    // $('#trainee_list  tbody tr').empty();
    $("#trainee_list  ").find("tr:gt(0)").remove();


    $.ajax({
        type: 'GET',
        url: baseURL+'/schedule/'+training_id+'/trainee/request',
        cache: false,
        async: false,
        success: function(result){
            console.log(result);

            if(result.length > 0){
                $('#selecetAllTraineDisplay').css("display", "block");
                $('#select_all_trainee_applicant').prop('checked', false);
            }
            else
                $('#selecetAllTraineDisplay').css("display", "none");

            $.each( result, function( key, value ) {
                console.log(value);
                if(value.pass_trainee != null){
                    $('#trainee_list tr:last').after('<tr>' +
                                '<td>'+(key+1)+'</td>'+
                                '<td>'+((value.pass_trainee.first_name == null)? '':value.pass_trainee.first_name)+' '+((value.pass_trainee.middle_name == null)? '':value.pass_trainee.middle_name)+' '+((value.pass_trainee.last_name == null)? '':value.pass_trainee.last_name)+'</td>'+
                                '<td>'+((value.pass_trainee.mobile_no == null)? '':value.pass_trainee.mobile_no)+'</td>'+
                                '<td>'+((value.pass_trainee.email == null)? '':value.pass_trainee.email)+'</td>'+
                                '<td>'+((value.pass_trainee.pre_addr_ps_id == null)? '':value.pass_trainee.pre_addr_ps_id)+'</td>'+
                                '<td>' +
                                    '<input class="trainint_applicant_no" type="checkbox" value="1" name="exam_status['+value.pass_trainee.application_no+']">' +
                                    '<input type="hidden" name="applicant_no[]" value="'+value.pass_trainee.application_no+'">'+
                                '</td>'+
                            '</tr>');
                }
            });
        },
        error: function(jqXHR, textStatus, errorThrown){
            if(jqXHR.status == 401)
                location.reload();
            else
                alert("Some thing is Wrong");
        },
    });
});




// $('#all_exameen_fail').on('click', function(){
//     $('input[value=Fail]').attr('checked', true);
// });
//
// $('#all_exameen_pass').on('click', function(){
//     $('input[value=Pass]').attr('checked', true);
// });

$('#all_exameen_fail').on('click', function(){
    $('.exameen_fail_status').prop('checked', true);
});

$('#all_exameen_pass').on('click', function(){
    $('.exameen_pass_status').prop('checked', true);
});

$('#select_all_trainee_applicant').on('click', function(){
    if($("#select_all_trainee_applicant").prop('checked') == true){
        $('.trainint_applicant_no').prop('checked', true);
    }
    else if($("#select_all_trainee_applicant").prop('checked') == false){
        $('.trainint_applicant_no').prop('checked', false);
    }
});


$('#all_trainee_fail').on('click', function(){
    $('.training_fail_status').prop('checked', true);
});

$('#all_trainee_pass').on('click', function(){
    $('.training_pass_status').prop('checked', true);
});
