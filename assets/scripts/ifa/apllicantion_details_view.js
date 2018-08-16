
var open_update_nid_field = (function(){

	return {
		init: function(){
			var clicks = true;
			$('#update_nid').click(function(){
			    clicks = $(this).data('clicks');
			    if(clicks){
					$('.update_nid_h').removeClass('hidden');
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
				var national_id = $.trim($('#national_id_card_no').val());
				var application_no = $.trim($('#application_no_').val());
				var update_national_id = $.trim($('#update_national_id_card_no').val());
				var data ={
					oldnid : national_id,
					ifaid 	:application_no,
					newnid  :update_national_id,
				};
				
				if(update_national_id == ''){
					$('#update_nid_value_').addClass('has-error');
					return false;
				}else{
					$('#update_nid_value_').removeClass('has-error');
				}
				$.ajax({
		          type: "GET",
		          url: "/SalesForce/update/nid",
		          data: data,
		          datatype: 'json',
		          cache: false,
		          async: false,
		          success: function(result) {
		          	var data = JSON.parse(result);
		          	console.log(data);
		          	$('.set_hide_body').empty();
		          	$('.set_open_body').removeClass('hidden');
		          },
		          error:function(result){
		            alert("Some thing is Wrong");
		          }
		          });
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
	open_update_nid_field.init();
	update_nid_request.init();
	_reject_ifa.init();
});