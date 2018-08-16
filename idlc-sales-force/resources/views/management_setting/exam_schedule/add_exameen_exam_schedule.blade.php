@extends('layouts.dashboard')
@section('page_heading','Add Examine')
@section('section')
    <div class=" col-sm-12 col-sm-offset-0 main_body">

        <!-- <div class="panel-body"> -->
        <div class="col-sm-12">
            <div class="col-sm-2">
                <div class="form-group ">
                    <a href="{{route('schedule_exameen_view', $schedule_id)}}" class="btn btn-primary ">
                        <i class="fa fa-arrow-left"></i> Back</a>
                </div>
            </div>
            <div class="col-sm-4 col-sm-offset-5" style="display: none" id="selecetAllTraineDisplay">
                <br>
                <div style="text-align: right; font-size: 110%" class="col-sm-9"><b>Select / De-select All</b></div>
                <div class="col-sm-3" style="align-content: left"><input type="checkbox"  id="select_all_trainee_applicant"></div>
                {{--<input class="trainint_applicant_no" type="checkbox" value="1" name="">--}}
            </div>
        </div>
        <div class="col-sm-10 col-sm-offset-1">
            <div class="panel panel-default add_body">
                <div class="panel-body">
                    <form action="{{route('schedule_exameen_update_action', $schedule_id)}}" method="POST">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">




                        <div class="form-group add_input">
                            <label class="col-md-4 control-label">
                                <span class="pull-right">Training Schedule</span>
                            </label>
                            <div class="col-md-6">
                                <div class="select">
                                    <select class="form-control" type="select" name="training_name" >
                                        <option value="">Select a Schedule</option>
                                        @foreach($trainingList as $training)
                                            @if(isset($training->trainingName))
                                                <option value="{{ $training->id }}">{{ $training->trainingName->name }} ({{ $training->start_date }} - {{ $training->end_date }}) </option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>


                        <table class="table table-bordered table-striped" id="trainee_list" class="trainee_list">
                            <thead>
                            <tr>
                                <th class="">Serial</th>
                                <th class="">Name</th>
                                <th class="">Mobile No.</th>
                                <th class="">Email</th>
                                <th class="">Thana</th>
                                <th class="">As Participant</th>
                                {{--<th class="">Training Required</th>--}}
                            </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                        <div class="form-group add_input">
                            {{--<div class="col-md-2 col-md-offset-10" style=" padding-bottom: 10px; padding-right: 0px; ">--}}
                                {{--<a style="width: 100%;" id="select_all_trainee_applicant" href="javascript:void(0)" class="btn btn-primary">Select All</a>--}}
                            {{--</div>--}}
                            <div class="col-md-2 col-md-offset-10" style="padding-right: 0px;">
                                <button type="submit" class="btn btn-primary" style="width:100%">Add
                                </button>
                            </div>
                        </div>
                    </form>



                </div>
            </div>
            </div>
        </div>
@endsection