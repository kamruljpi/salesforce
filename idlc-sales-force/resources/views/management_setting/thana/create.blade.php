@extends('layouts.dashboard')
@section('page_heading','Create Thana')
@section('section')
<div class="col-sm-12 main_body">

	<!-- <div class="header">
		<div class="panel panel-default ">
			<div class="panel-heading">
				<center>
					<h2>Thana Add Page</h2>
				</center>
			</div>
		</div>
	</div> -->

	<!-- <div class="panel-body"> -->
		<div class="col-sm-12">
			<div class="col-sm-2">
				<div class="form-group ">
					<a href="{{route('thana_list_view')}}" class="btn btn-primary ">
					<i class="fa fa-arrow-left"></i> Beck</a>
				</div>
			</div>
		</div>
		<div class="col-sm-8 col-sm-offset-2">
			<div class="panel panel-default add_body">
				<div class="panel-body">
					<form action="{{route('thanas_store')}}" method="POST">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">
							<div class="form-group add_input{{ $errors->has('division_id') ? ' has-error' : ''}}">
								<label class="col-md-4 control-label">
									<span class="pull-right">Division Name</span>
								</label>
								<div class="col-md-6 select ">
										<select class="form-control" type="select" name="division_id" id="division_id_2">
											<option value="">Choose division</option>
											@foreach($divisionDetails as $divisionValue)
												<option value="{{$divisionValue->division_id}}">{{$divisionValue->division_name}}</option>
											@endforeach
									    </select>

									     @if($errors->has('division_id'))
											<span class="help-block">
												{{ $errors->first('division_id')}}
											</span>
										@endif
								</div>
							</div>

							<div class="form-group add_input{{ $errors->has('district_id') ? ' has-error' : ''}}">
								<label class="col-md-4 control-label">
									<span class="pull-right">District Name</span>
								</label>
								<div class="col-md-6 select ">
									<select class="form-control" type="select" name="district_id" id="district_id">
										<option value="3">Choose District</option>
								    </select>
								    
								    @if($errors->has('district_id'))
										<span class="help-block">
											{{ $errors->first('district_id')}}
										</span>
									@endif
								</div>
							</div>

							<div class="form-group add_input{{ $errors->has('thana_name') ? 
							 ' has-error' : ''}}">
								<label class="col-md-4 control-label">
									<span class="pull-right">Thana Name</span>
								</label>
								<div class="col-md-6">
									<input type="text" class="form-control  input_required" name="thana_name" value="{{ old('thana_name')  }}" placeholder="Thana name">
									@if($errors->has('thana_name'))
									<span class="help-block">
										{{ $errors->first('thana_name')}}
									</span>
									@endif
								</div>
							</div>							

							<div class="form-group add_input">
								<div class="col-md-3 col-md-offset-4">
									<div class="select">
										<select class="form-control" type="select" name="isActive" >
											<option  value="1" name="isActive" >Active</option>
											<option value="0" name="isActive" >Inactive</option>
									    </select>
									</div>
								</div>
							</div>
									
							<div class="form-group add_input">
								<div class="col-md-6 col-md-offset-4">
									<button type="submit" class="btn btn-primary" style="margin-right: 15px;">Submit
									</button>
								</div>
							</div>
					</form>
				</div>
			</div>
		</div>
	<!-- </div> -->
</div>
@endsection