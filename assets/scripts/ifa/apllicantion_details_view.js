
var open_update_nid_field = (function(){

	return {
		init: function(){
			var clicks = true;
			$('#update_nid').on('click',function(){

				clicks = $(this).data('clicks');

      		    if(clicks){
      				$('.update_nid_h').removeClass('hidden');
					var national_ids = $('#national_id_card_no').val();
					var application_nos = $('#application_no_').val();

					var datass = {
		    				oldnid : national_ids,
		    				ifaid 	:application_nos
		    			};

					$.ajax({
			          type: "GET",
			          url: baseURL+"/get/update/nid/value",
			          data: datass,
			          datatype: 'json',
			          cache: false,
			          async: false,
			          success: function(result) {
			          	var data = JSON.parse(result);
			          	if(data.length >= 1){
			          		$('.set_hide_body').empty();
			          		$('.set_open_body').removeClass('hidden');
			          	}		          	
			          },
			          error:function(result){
			            alert("Some thing is Wrong");
			          }
			          });
				}else{
	          		$('.update_nid_h').addClass('hidden');
      			}			
      			$(this).data("clicks", !clicks);		        		    
			});
		}
	}
})();

var update_nid_request = (function(){

	return {
		init: function(){
			$('#sent_update_request').on('click',function(){
				var national_id_card_no = $('#update_national_id_card_no').val();
				if(national_id_card_no == ''){
					$('#update_nid_value_').addClass('has-error');
					return false
				}
			    var valid_nid_len = [10,13,17];
			    var nid_len = national_id_card_no.length;
			    if(national_id_card_no == '' && national_id_card_no.length > 0) {
			    	$('#update_nid_value_').addClass('has-error');
			           $('.validation_error_msg').empty();
			           $('.alert-danger').hide();
			           $('.modal .alert-danger').show();
			           $('#unique_input_error').modal('show');
			           $('.validation_error_msg').append("You can not leave with empty Value.");
			    }else if($.inArray(nid_len, valid_nid_len) == -1 && national_id_card_no.length > 0)
			    {
			    	$('#update_nid_value_').addClass('has-error');
			        $('.validation_error_msg').empty();
			        $('.alert-danger').hide();
			        $('.modal .alert-danger').show();
			        $('#unique_input_error').modal('show');
			        $('.validation_error_msg').append("Only allowed 10,13,17 digit.");
			    }else if(!$.isNumeric(national_id_card_no) && national_id_card_no.length > 0)
			    {
			    	$('#update_nid_value_').addClass('has-error');
			        $('.validation_error_msg').empty();
			        $('.alert-danger').hide();
			        $('.modal .alert-danger').show();
			        $('#unique_input_error').modal('show');
			        $('.validation_error_msg').append("Only Number is allowed.");
			    }else{
			    	$('#update_nid_value_').removeClass('has-error');
	    			var national_id = $('#national_id_card_no').val();
	    			var application_no = $('#application_no_').val();
	    			var update_national_id = $('#update_national_id_card_no').val();
	    			var data ={
	    				oldnid : national_id,
	    				ifaid 	:application_no,
	    				newnid  :update_national_id,
	    			};

	    			$.ajax({
	    	          type: "GET",
	    	          url: baseURL+"/update/nid",
	    	          data: data,
	    	          datatype: 'json',
	    	          cache: false,
	    	          async: false,
	    	          success: function(result) {
	    	          	var data = JSON.parse(result);
	    	          	$('.set_hide_body').empty();
	    	          	$('.set_open_body').removeClass('hidden');
	    	          },
	    	          error:function(result){
	    	            alert("Some thing is Wrong");
	    	          }
	    	          });
			    }

				
			});
		}
	}
})();


var _reject_ifa = (function(){

	return {
		init: function(){
			$('#reject_ifa').on('click',function(){
				var rejection_remarks = $.trim($("#rejection_remarks").find(":selected").val());

				if(rejection_remarks == ''){
					$('.error_reject_ifa').addClass('has-error');
					return false;
				}else{
					$('.error_reject_ifa').removeClass('has-error');
				}
			});
		}
	}
})();
$(document).ready(function(){
    $('.update_nid_h').hide();
    // open_update_nid_field.init();
    update_nid_request.init();
    _reject_ifa.init();
});

$('#update_nid').click(function(){
    $('.update_nid_h').toggle();

    var national_ids = $('#national_id_card_no').val();
    var application_nos = $('#application_no_').val();

    var datass = {
        oldnid : national_ids,
        ifaid 	:application_nos
    };

    $.ajax({
        type: "GET",
        url: baseURL+"/get/update/nid/value",
        data: datass,
        datatype: 'json',
        cache: false,
        async: false,
        success: function(result) {
            var data = JSON.parse(result);
            if(data.length >= 1){
                $('.set_hide_body').empty();
                $('.set_open_body').removeClass('hidden');
            }
        },
        error:function(result){
            alert("Some thing is Wrong");
        }
    });
});