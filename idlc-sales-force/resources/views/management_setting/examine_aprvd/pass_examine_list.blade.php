@extends('layouts.dashboard')
@section('page_heading','Approval IFA List')


@section('section')

    @if(Session::has('aprvdRjct_status'))
        <div style="width:100%; text-align: center;" class="alert {{ Session::get('alert-class') }}">
            {{ Session::get('aprvdRjct_status') }}
        </div>
    @endif

    <div class="col-sm-12">

        <div class="col-sm-12" style="padding: 0px;">

            {{--<div class="col-sm-3" style="padding: 0px;">--}}
                {{--<div class="pull-left">--}}
                    {{--<a href="{{ route('exam_schedule_create_view')}}" class="btn btn-primary"><i class="fa fa-plus"></i> Create Exam Schedule</a>--}}
                {{--</div>--}}
            {{--</div>--}}
            {{--<div class="col-sm-9 col-sm-offset-2" style="padding: 0px;">--}}
                {{--<div class="input-group add-on" style="width:100%;">--}}
                    {{--<input class="form-control" placeholder="Search" name="srch-term" id="user_search" type="text">--}}
                    {{--<div class="input-group-btn pull-left">--}}
                        {{--<button class="btn btn-default" type="submit"><i class="glyphicon glyphicon-search"></i></button>--}}
                    {{--</div>--}}
                {{--</div>--}}
            {{--</div>--}}
        </div>

        <br>
        <br>

        <table class="table table-bordered table-striped" id="tblSearch">
            <thead>

            <tr>
                <th class="">Serial</th>
                <th class="">Examine Name</th>
                <!-- <th class="">Description</th> -->
                <th class="">Mobile No</th>
                <th class="">Email</th>
                <th class="">Thana</th>
                <th class="">Action</th>
            </tr>
            </thead>
            <tbody>
            @php($i=1)
            @foreach($examines as  $examine)
                <tr>
                    <td>{{$i++}}</td>
                    <td>{{ $examine->first_name }} {{ $examine->middle_name }} {{ $examine->last_name }}</td>
                    <td>{{ $examine->mobile_no }}</td>
                    <td>{{ $examine->email }}</td>
                    <td>{{ (count($examine->pre_thana)>0)? $examine->pre_thana->thana_name:''}}</td>
                    <td>
                        <a class="btn btn-success" href="{{ route('approved_pass_examine', $examine->application_no) }}">Approved</a>
                        <a class="btn btn-danger" href="{{ route('reject_pass_examine', $examine->application_no) }}">Reject</a>
                    </td>
                    {{--<td><a class="btn btn-danger" href="{{ route('reject_pass_examine', $examine->application_no) }}">Reject</a></td>--}}
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection