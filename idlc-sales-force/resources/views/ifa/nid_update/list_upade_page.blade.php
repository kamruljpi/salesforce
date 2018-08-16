@extends('layouts.dashboard')
@section('page_heading','NID Update List')
@section('section')
<div class="col-sm-12">
	<div class="col-sm-12">
		<div class="col-sm-2"></div>
		<div class="col-sm-10">
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
                <th class="">Applicant Name</th>
                <th class="">Email</th>
                <th class="">Old Nid</th>
                <th class="">New Nid</th>
                <th class="">Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach($getList as $value)
                <tr>
                    <td>{{$value->id}}</td>
                    <td>{{$value->first_name}} {{$value->middle_name}} {{$value->last_name}}</td>
                    <td>{{$value->email}}</td>
                    <td>{{$value->national_id_card_no}}</td>
                    <td>{{$value->new_nid}}</td>
                    <td>
                        <form action="{{route('update_nid_action_update')}}" method="post">
                            {{ csrf_field() }}
                        <input type="hidden" name="id" value="{{$value->application_no}}">
                        <input type="hidden" name="new_nid" value="{{$value->new_nid}}">
                            
                        <button type="submit" class="btn btn-default">Approved</button>
                        </form>
                        <form action="{{route('update_nid_action_reject')}}" method="post">
                            {{ csrf_field() }}
                        <input type="hidden" name="id" value="{{$value->id}}">
                            
                        <button type="submit" class="btn btn-default">Rejected</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection