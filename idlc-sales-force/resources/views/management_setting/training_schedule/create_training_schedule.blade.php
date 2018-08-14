@extends('layouts.dashboard')
@section('page_heading','Create Training Schedule')
@section('section')
<?php 
    $object = new App\Http\Controllers\Lead\LeadDetailsView();
?>
    <div class=" col-sm-12 col-sm-offset-0 main_body">

        <!-- <div class="panel-body"> -->
        <div class="col-sm-12">
            <div class="col-sm-2">
                <div class="form-group ">
                    <a href="{{route('training_schedule_view')}}" class="btn btn-primary ">
                        <i class="fa fa-arrow-left"></i> Back</a>
                </div>
            </div>
        </div>
        <div class="col-sm-10 col-sm-offset-1">
            <div class="panel panel-default add_body">
                <div class="panel-body">
                    <form action="{{route('create_training_schedule_action')}}" method="POST">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">


                        <div class="form-group add_input{{ $errors->has('training_name') ? ' has-error' : ''}}">
                            <label class="col-md-4 control-label">
                                <span class="pull-right">Training Name</span>
                            </label>
                            <div class="col-md-6">
                                <div class="select">
                                    <select class="form-control" type="select" name="training_name_id">
                                        <option value="">Select Training Name</option>
                                        @foreach($trainingNames as $trainingName)
                                        <option <?php echo $object->valueCheck($trainingName->id_training_name,old('training_name_id'))?> value="{{ $trainingName->id_training_name }}">{{$trainingName->name}}</option>
                                        @endforeach

                                    </select>
                                    @if($errors->has('training_name_'))
                                        <span class="help-block">
                                            {{ $errors->first('training_name_')}}
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>


                        <div class="form-group add_input{{ $errors->has('start_dat') ? ' has-error' : ''}}">
                            <label class="col-md-4 control-label">
                                <span class="pull-right">Start date</span>
                            </label>
                            <div class="col-md-6">
                                <input type="date" name="start_date" class="form-control" value="{{ old('start_date')}}" id="start_date" data-date="" data-date-format="DD MMMM YYYY">
                                @if($errors->has('start_dat'))
                                    <span class="help-block">
                                        {{ $errors->first('start_dat')}}
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group add_input{{ $errors->has('end_dat') ? ' has-error' : ''}}">
                            <label class="col-md-4 control-label">
                                <span class="pull-right">End date</span>
                            </label>
                            <div class="col-md-6">
                                <input type="date" name="end_date" class="form-control" value="{{ old('end_date')}}" id="end_date" value="20-12-2017">
                                @if($errors->has('end_dat'))
                                    <span class="help-block">
                                        {{ $errors->first('end_dat')}}
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group add_input{{ $errors->has('start_time') ? ' has-error' : ''}}">
                            <label class="col-md-4 control-label">
                                <span class="pull-right">Start Time</span>
                            </label>
                            <div class="col-md-6">
                                <input type="time" name="start_time" class="form-control" value="{{ old('start_time')}}" id="start_time">
                                @if($errors->has('start_time'))
                                    <span class="help-block">
                                        {{ $errors->first('start_time')}}
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group add_input{{ $errors->has('end_time') ? ' has-error' : ''}}">
                            <label class="col-md-4 control-label">
                                <span class="pull-right">End Time</span>
                            </label>
                            <div class="col-md-6">
                                <input type="time" name="end_time" class="form-control" value="{{ old('end_time')}}" id="end_time">
                                @if($errors->has('end_time'))
                                    <span class="help-block">
                                        {{ $errors->first('end_time')}}
                                    </span>
                                @endif
                            </div>
                        </div>


                        <table class="table table-bordered table-striped" id="tblSearch">
                            <thead>
                                <tr>
                                    <th class="">Serial</th>
                                    <th class="">Name</th>
                                    <th class="">Mobile No.</th>
                                    <th class="">Email</th>
                                    <th class="">Area</th>
                                    <th class="">As Participant</th>
                                    {{--<th class="">Training Required</th>--}}
                                </tr>
                            </thead>
                            <tbody>
                                @php($i =1)
                                @foreach($applicants as $applicant)
                                <tr>
                                    <td>{{ $i }}</td>
                                    <td>
                                        {{ $applicant->first_name}} {{ $applicant->last_name}}
                                        <input type="hidden" name="applicant_no[]" value="{{ $applicant->application_no }}">
                                    </td>
                                    <td>{{ $applicant->mobile_no}}</td>
                                    <td>{{ $applicant->email}}</td>
                                    <td>{{ $applicant->pre_addr_ps_id }}</td>
                                    <td>
                                        <input class="trainint_applicant_no" type="checkbox" value="1" name="training_status[{{ $applicant->application_no }}]">
                                    </td>
                                    {{--<td>--}}
                                        <input type="hidden"  value="1" name="is_required[{{ $applicant->application_no }}]" checked>
                                    {{--</td>--}}
                                </tr>
                                @php($i++)
                                @endforeach
                            </tbody>
                        </table>
                        <div class="form-group add_input">
                            <div class="col-md-2 col-md-offset-10" style=" padding-bottom: 10px; padding-right: 0px; ">
                                <a style="width: 100%;" id="select_all_trainee_applicant" href="javascript:void(0)" class="btn btn-primary">Select All</a>
                            </div>
                            <div class="col-md-2 col-md-offset-10" style="padding-right: 0px;">
                                <button type="submit" class="btn btn-primary" style="width:100%" id="schedule_submit">Submit
                                </button>
                            </div>
                        </div>
                    </form>



            </div>
        </div>
    </div>

    <div class="modal fade" id="unique_input_error" role="dialog" style="padding-top: 180px;">
        <div class="modal-dialog">
          <div class="modal-content">
             <!-- <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div> --> 
            <div class="modal-body">
                <div class="validation_error_msg" style="padding:10px; border-radius: 5px; text-align: center;" >

                    @if(count($errors) > 0)
                        <div class="" role="alert">
                            @foreach($errors->all() as $error)
                                <input type="hidden" name="poupValue" value="{{ $error }}" id="poupValue">
                              <li style="list-style-type: none;"><span>{{ $error }}</span></li>
                            @endforeach
                        </div>
                    @endif
                </div>
                <!-- <div class="alert-success success_msg" style="padding:10px; border-radius: 5px; text-align: center;" >
                </div> -->
            </div>
            <div class="modal-footer">
                <center>
                    <button type="button" class="btn btn-default modal_close" data-dismiss="modal">
                    Close
                </button>
            </center>
            </div>
          </div>

        </div>
  </div>
@endsection