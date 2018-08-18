@extends('layouts.dashboard')
@section('page_heading','Trainee List')
@section('section')

<div class="col-sm-12">

    @if(Session::has('exam_status'))
        {{--<div style="width:100%; text-align: center;" class="alert {{ Session::get('alert-class') }}">--}}
{{--            {{ Session::get('exam_status') }}--}}
        {{--</div>--}}

        @php
            $examStatus = Session::get('exam_status');
            echo "<script type='text/javascript'>alert('$examStatus');</script>";
        @endphp
    @endif

    <div class="col-sm-12 hidden" style="padding-left: 0px;">
        <h2 >Training Schedule</h2>
        <hr>
    </div>

    <div class="form-group ">
        <a href="{{route('training_schedule_view')}}" class="btn btn-primary ">
            <i class="fa fa-arrow-left"></i> Back</a>
    </div>

    <table class="table table-bordered table-striped hidden" id="tblSearch">
        <thead>
        <tr>
            <th class="">Training Name</th>
            <th class="">Start Date</th>
            <th class="">End date</th>
            <th class="">Time</th>
            <th class="">Description</th>
        </tr>
        </thead>
        <tbody>
            <tr>
                <td>{{ $schedule->trainingName->name }}</td>
                <td>{{ $schedule->start_date }}</td>
                <td>{{ $schedule->end_date }}</td>
                <td>{{ $schedule->start_time }} - {{ $schedule->end_time }}</td>
                <td>{{ $schedule->trainingName->description }}</td>
            </tr>

        </tbody>
    </table>

    <div class="col-sm-12" style="padding-left: 0px;">
        <h3 style="float: left;">{{ $schedule->trainingName->name }} (
            @if(isset($schedule->start_date) && !empty($schedule->start_date))
                    {{Carbon\Carbon::parse($schedule->start_date)->format('d-m-Y')
                 }}
            @endif
            {{(!empty($schedule->start_time) && !empty($schedule->end_time) ? '-':'')}}
            @if(isset($schedule->end_time) && !empty($schedule->end_time))
                    {{Carbon\Carbon::parse($schedule->end_time)->format('d-m-Y')
                 }}
            @endif
            )<!-- Trainee List --></h3>
            <div class="col-sm-3" style="  padding: 0px;  padding-left: 20px; margin-top: 20px;">
                <div class="pull-left">
                    <a href="{{ route('schedule_trainee_add_view', $schedule->id)}}" class="btn btn-primary"><i class="fa fa-plus"></i> Add Trainee</a>
                </div>
            </div>
        <hr style="float: left; width: 100%;">
    </div>
    <form action="{{ route('change_trainee_training_status_action', $schedule->id) }}" method="post">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <table class="table table-bordered table-striped tblSearch2" id="tblSearch">
        <thead>
            <tr>
                <th class="">Serial</th>
                <th class="">Name</th>
                {{--<th class="">Schedule Name</th>--}}
                <th class="">Mobile No</th>
                <th class="">Email</th>
                <th class="">Thana</th>
                <th class="">Training Status</th>
                <th class="">Action</th>
            </tr>
        </thead>
        <tbody>
        @php($i=1)
        @foreach($trainees as  $trainee)
            @if(isset($trainee->trainee))
                <tr>
                    <td>{{$i}}</td>
                    <td>{{ $trainee->trainee->first_name }} {{ $trainee->trainee->middle_name }} {{ $trainee->trainee->last_name }}</td>
                    <td>{{ $trainee->trainee->mobile_no }}</td>
                    <td>{{ $trainee->trainee->email }}</td>
                    <td>{{ (count($trainee->trainee->pre_thana)>0)? $trainee->trainee->pre_thana->thana_name:'' }}</td>

                        @if($trainee->trainee->training_status == 'InExam')
                            <td >
                                <label class="radio-inline">In Exam</label>
                                <input type="hidden" name="training_status[{{ $trainee->trainee->application_no }}]" value="exam">
                            </td>
                            <td></td>
                        @elseif($trainee->trainee->training_status == 'Pass' || $trainee->trainee->training_status == 'Fail')
                            <td >
                                <label class="radio-inline">{{ $trainee->trainee->training_status }} in Exam</label>
                                <input type="hidden" name="training_status[{{ $trainee->trainee->application_no }}]" value="exam">
                            </td>
                            <td></td>
                        @else
                            <td >
                                <label class="radio-inline">
                                    <input type="radio" class="training_pass_status" name="training_status[{{ $trainee->trainee->application_no }}]" value="TrainingPass"
                                           @if($trainee->training_status == 'TrainingPass')checked @endif>Complete
                                </label>
                                <label class="radio-inline">
                                    <input type="radio" class="training_fail_status" name="training_status[{{ $trainee->trainee->application_no }}]" value="TrainingFail" @if($trainee->training_status == 'TrainingFail')checked @endif>Incomplete
                                </label>
                            </td>
                            <td><a href="{{ route('trainee_remove_action', [$schedule->id, $trainee->trainee->application_no]) }}">Not Required</a></td>
                        @endif
                        {{--<label class="radio-inline">--}}
                            {{--<input type="radio" class="training_pass_status" name="training_status[{{ $trainee->trainee->application_no }}]" value="TrainingPass" --}}
                            {{--@if($trainee->trainee->training_status == 'TrainingingPass' || $trainee->trainee->training_status == 'Pass' || $trainee->trainee->training_status == 'Fail')checked @endif>Complete--}}
                        {{--</label>--}}
                        {{--<label class="radio-inline">--}}
                            {{--<input type="radio" class="training_fail_status" name="training_status[{{ $trainee->trainee->application_no }}]" value="TrainingFail" @if($trainee->trainee->training_status == 'TrainingFail')checked @endif>Incomplete--}}
                        {{--</label>--}}

                    {{--<td><a href="{{ route('trainee_remove_action', [$schedule->id, $trainee->trainee->application_no]) }}">Not Required</a></td>--}}
                </tr>
                @php($i++)
            @endif
        @endforeach
        </tbody>
    </table>
    <div class="col-sm-12" style="  padding: 0px;  padding-left: 20px; margin-top: 20px;">
            <div class="col-sm-12" style="  padding: 0px;  padding-left: 20px; margin-top: 20px; padding-bottom: 10px;">
                <div class="pull-right" style="">
                    <a id="all_trainee_fail" style="background: red; border: red;" href="javascript:void(0)" class="btn btn-primary">All Incomplete</a>
                </div>
                <div class="pull-right" style="padding-right: 15px; ">
                    <a id="all_trainee_pass" href="javascript:void(0)" class="btn btn-primary">All Complete</a>
                </div>
            </div>
            <div class="pull-right">
                <button type="submit"  class="btn btn-primary">Save</button>
            </div>
        </div>
    </form>
</div>
@endsection