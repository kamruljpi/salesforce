<div class="modal fade" id="unique_input_error" role="dialog" style="padding-top: 180px;">
        <div class="modal-dialog">
          <div class="modal-content">
             <!-- <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div> --> 
            <div class="modal-body">
                <div class="validation_error_msg" style="padding:10px; border-radius: 5px; text-align: center;" >

                    <!-- @if(count($errors) > 0)
                        <div class="" role="alert">
                            @foreach($errors->all() as $error)
                                <input type="hidden" name="poupValue" value="{{ $error }}" id="poupValue">
                              <li style="list-style-type: none;"><span>{{ $error }}</span></li>
                            @endforeach
                        </div>
                    @endif -->
                </div>
                <!-- <div class="alert-success success_msg" style="padding:10px; border-radius: 5px; text-align: center;" >
                </div> -->
            </div>
            <div class="modal-footer">
            	<!-- <form action="{{ route('lead_update_redirect')}}"> -->
	                <center>
	                    <button type="button" class="btn btn-default modal_close" data-dismiss="modal">
	                    Close
	                </button>
                <!-- </form> -->
            </center>
            </div>
          </div>

        </div>
  </div>