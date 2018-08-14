var trainingScheduleValid = (function(){

	return {
		init: function(){
			var poupValue ;
			$('#schedule_submit').on('click',function(){

				var start_date = $('#start_date').val();
				var end_date = $('#end_date').val();
				var poupValue = $('#poupValue').val();

				if(start_date > end_date){
					$('.validation_error_msg').empty();
			        $('.alert-danger').hide();
			        $('.modal .alert-danger').show();
			        $('#unique_input_error').modal('show');
			        $('.validation_error_msg').append("Start date should be less then End Date");

					return false;
				}

			});

			if(poupValue){
				// $('.validation_error_msg').empty();
			        $('.alert-danger').hide();
			        $('.modal .alert-danger').show();
			        $('#unique_input_error').modal('show');
			        // $('.validation_error_msg').append("Start date should be less then End Date");
			}

			$('.modal_close').on('click',function(){
				$('.modal .alert-danger').hide();
				$('#unique_input_error').modal('hide');

				return true;
			});

			var update_lead = $('#update_lead').val();
			if(update_lead){
				$('.alert-danger').hide();
		        $('.modal .alert-danger').show();
		        $('#unique_input_error').modal('show');
			}
		}
	}
})();


$(document).ready(function(){
	trainingScheduleValid.init();
});