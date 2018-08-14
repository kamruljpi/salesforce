@extends('layouts.dashboard')
@section('page_heading','Lead Details ')
@section('section')
<div class="row top-body">
    <div class="col-sm-10">
        <div class="form-group col-sm-3" id="error_1">
            <label class="col-sm-8 control-label">Lead Status</label>
                <select class="form-control" id="selectMenuOption">
                    <option value=""> Choose a option</option>
                    <option value="highly_interested"> Highly Interested</option>
                    <option value="might_invest"> Might Invest</option>
                    <option value="not_interested"> Not Interested</option>
                    <option value="unassigned"> Unassigned</option>
                    <option value="converted"> Converted</option>
                    <option value="pitched"> Pitched</option>
                    <option value="open_for_all"> Open</option>
                    <option value="assign_sales_agent"> Assigned</option>

                </select>
        </div>

        <div class="form-group col-sm-3 " id="error_2">
            <label class="col-sm-8 control-label">Order By </label>
                <select class="form-control" id="selectSortbyValue">
                    <option value="">--Select--</option>
                    <option value="ASC">ASC</option>
                    <option value="DESC">DESC</option>
                </select>
        </div>

        <div class="form-group col-sm-3" id="error_3">
            <label class="col-sm-4 control-label">
                From
            </label>
                <input type="date" name="date[from]" class="form-control" id="formDate">
        </div>

        <div class="form-group col-sm-3" id="error_4">
            <label class="col-sm-4 control-label">To</label>
                <input type="date" name="date[to]" class="form-control" id="toDate">
        </div>

    </div>

    <div class="col-sm-2">
        <div class="pull-left">
            <div class="form-group pull-right" style="padding-top: 25px;">
                <button class="btn btn-primary" id="search_lead">Search</button>
                <button class="btn btn-success" id="reset_btn">Reset</button>
            </div>
        </div>
    </div>
</div>
<div class="col-sm-2 hidden">
    <div class="pull-left">
        <a href="{{ route('add_lead_view')}}" class="btn btn-primary"><i class="fa fa-plus"></i> Add New Lead </a>
    </div>
</div>
<div class="col-sm-10">
    <div class="input-group add-on" style="width:100%;">
        <input class="form-control" placeholder="Search" name="srch-term" id="user_search" type="text">
        <div class="input-group-btn pull-left">
        <button class="btn btn-default" type="submit"><i class="glyphicon glyphicon-search"></i></button>
        </div>
    </div>
</div>
<br><br>
<div class="col-sm-12">
    <table class="table table-bordered table-striped" id="tblSearch">
        <thead>
            <tr>
                <th>Serial</th>
                <th>#Lead</th>
                <th>Name</th>
                <th>Contact No.</th>
                <th>Area</th>
                <th>Follow up date</th>
                <th>Lead Assign</th>
                <th>Action</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody id="lead_list_tbody">

            @php($i=1)
            @foreach($getCreateLead as $leadsValue)
                <tr>
                    <td>{{$i++}}</td>
                    <td>{{$leadsValue->id_create_lead}}</td>
                    <td>{{$leadsValue->personal_name}}</td>
                    <td>{{$leadsValue->contact_no}}</td>
                    <td>{{$leadsValue->area}}</td>
                    <td>
                        @if(!empty($leadsValue->follow_up_date))
                        {{Carbon\Carbon::parse($leadsValue->follow_up_date)->format('d-m-Y')}}
                        @else
                        {{ $leadsValue->follow_up_date }}
                        @endif
                    </td>
                    <td>{{ ucwords(str_replace('_', ' ', $leadsValue->lead_assign)) }}</td>

                    <td>{{$leadsValue->name}}</td>
                    <td>
                        <table>
                            <tbody>
                                <tr>
                                    <td>
                                        <a href="{{route('edit_create_lead')}}/{{$leadsValue->id_create_lead}}" class="btn btn-primary"> Edit</a>
                                    </td>

                                    <td>
                                        <a href="{{route('view_details_create_lead')}}/{{$leadsValue->id_create_lead}}" class="btn btn-success"> View</a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div class="pagination_body">
        {{$getCreateLead->links()}}
    </div>

    <div class="pagination-container">
        <nav>
            <ul class="pagination"></ul>
        </nav>
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