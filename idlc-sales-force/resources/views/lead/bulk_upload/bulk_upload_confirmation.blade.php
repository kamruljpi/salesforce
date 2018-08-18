@extends('layouts.dashboard')
@section('page_heading','Lead List (Confirmation) ')
@section('section')

<div class="col-sm-12">
<br>
    <form action="{{ route('lead_bulk_upload_action') }}" method="POST">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">

        <table class="table table-bordered table-striped" id="tblSearch">
            <thead>
                <tr>
                    <th>Serial</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Contact No.</th>
                    <th>Area</th>
                </tr>
            </thead>
            <tbody id="lead_list_tbody">

                @php($i=1)
                {{-- {{ count($values['1']) }} --}}
                
                @foreach($values as $leadsValue)
                    
                    <tr>
                        <td>{{$i++}}</td>
                        <td><input style="border: none;" readonly type="text" name="personal_name[]" value="{{$leadsValue['personal_name']}}"></td>
                        <td><input style="border: none;" readonly type="text" name="contact_no[]" value="{{$leadsValue['contact_no']}}"></td>
                        <td><input style="border: none;" readonly type="text" name="email[]" value="{{$leadsValue['email']}}"></td>
                        <td><input style="border: none;" readonly type="text" name="area[]" value="{{$leadsValue['area']}}"></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="col-sm-12" style="  padding: 0px;  padding-left: 20px; ">
            <div class="pull-right" style="margin-left: 20px;">
                <button type="submit" class="btn btn-primary ">Save</button>
            </div>
            <div class="pull-right">
                {{-- <button type="submit" class="btn btn-primary btn-danger">Cancle</button> --}}
                <a href="{{ route('lead_bulk_upload_cancle') }}" class="btn btn-primary btn-danger">Cancle</a>
            </div>
        </div>
    </form>
    
</div>

<div class="modal fade" id="unique_input_error" role="dialog" style="padding-top: 180px;">
        <div class="modal-dialog">
          <div class="modal-content">
             <!-- <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div> --> 
            <div class="modal-body">
                <div class="validation_error_msg" style="padding:10px; border-radius: 5px; text-align: center;" >
                    <input type="hidden" name="" value="{{Session::has('update_lead')}}" id="update_lead">
                    @if(Session::has('update_lead'))
                        @include('widgets.alert', array('class'=>'', 'message'=> Session::get('update_lead') ))
                    @endif 
                </div>
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

@endsection