@extends('layouts.dashboard')
@section('page_heading','Training Schedule')
@section('section')
<div class="col-sm-12">

    @if(Session::has('exam_status'))
        <div style="width:100%; text-align: center;" class="alert {{ Session::get('alert-class') }}">
            {{ Session::get('exam_status') }}
        </div>
    @endif

	<div class="col-sm-12" style="padding: 0;">

        <div class="col-sm-3" style="padding: 0;">
            <div class="pull-left">
                <a href="{{ route('create_training_schedule_view')}}" class="btn btn-primary"><i class="fa fa-plus"></i> Create Training Schedule</a>
            </div>
        </div>
		<div class="col-sm-9" style="padding: 0;">
			<div class="input-group add-on" style="width:100%;">
		    	<input class="form-control" placeholder="Search" name="srch-term" id="user_search" type="text">
		    	<div class="input-group-btn pull-left">
		        <button class="btn btn-default" type="submit"><i class="glyphicon glyphicon-search"></i></button>
		    	</div>
		    </div>
		</div>
	</div>

    <br>
    <br>

    <table class="table table-bordered table-striped" id="tblSearch">
        <thead>
            <tr>
                <th class="">Serial</th>
                <th class="">Training Name</th>
                {{--<th class="">Schedule Name</th>--}}
                <th class="">Start Date Time</th>
                <th class="">End Date TIme</th>
                {{--<th class="">Start Time</th>--}}
                {{--<th class="">End Time</th>--}}
                <th class="">List</th>
                <th class="">Action</th>
            </tr>
        </thead>
        <tbody>
            @php($i=1)
            @foreach($trainingSchedule as  $sche)

                <tr>
                    <td>{{$i}}</td>
                    <td>{{ $sche->trainingName['name']  }}</td>
                    <!-- <td>{{ $sche->start_date }}</td> -->
                    <td>
                        @if(!empty($sche->start_date))
                        {{Carbon\Carbon::parse($sche->start_date)->format('d-m-Y g:i A')}}
                        @else
                        {{ $sche->start_date }}
                        @endif
                    </td>
                    <td>
                        @if(!empty($sche->end_date))
                        {{Carbon\Carbon::parse($sche->end_date)->format('d-m-Y g:i A')}}
                        @else
                        {{ $sche->end_date }}
                        @endif
                    </td>
                    <!-- <td>{{ $sche->end_date }}</td> -->
                    {{--<td>{{ $sche->start_time }}</td>--}}
                    {{--<td>{{ $sche->end_time }}</td>--}}
                    <td><a href="{{ route('schedule_trainee_view', $sche->id) }}">Trainees</a></td>
                    <td><a href="{{ route('update_training_schedule_view', $sche->id) }}">Update</a></td>
                </tr>
                @php($i++)
            @endforeach
        </tbody>
    </table>
</div>
@endsection