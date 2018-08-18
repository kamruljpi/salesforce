@extends('layouts.dashboard')
@section('page_heading','Thana List Page')
@section('section')
<div class="col-sm-12 main_body">
	<!-- <div class="header">
		<div class="panel panel-default ">
			<div class="panel-heading">
				<center><h2>Thana List Page</h2></center>
			</div>
		</div>
	</div> -->

	<!-- <div class="panel-body"> -->
		<div class="col-sm-12">
			<div class="col-sm-2">
				<div class="form-group ">
					<a href="{{route('thanas_create_view')}}" class="btn btn-primary ">Add Thana
					<i class="fa fa-plus"></i></a>
				</div>
			</div>

			<div class="col-sm-8">
			    <div class="col-sm-10 form-group">
			        <input type="text" name="searchFld" class="form-control" placeholder="search">			        
			    </div>

			    <div class="col-sm-2">
			    	<button class="btn btn-default" type="button">
			            <i class="fa fa-search"></i>
			        </button>
			    </div>
			</div>
		</div>

		<div class="col-sm-12">
			<table class="table table-bordered table-striped">
				
				<thead>
				<th width="5%">Serial</th>
				<th width="15%">Division Name</th>
				<th width="15%">District Name</th>
				<th width="15%">Thana Name</th>
				<th width="15%">Status</th>
				<th width="10%">Action</th>	
				</thead>


				<tbody>
					@php($i =1 )
					@foreach($thanaDetails as $thanaValue)
						<tr>
							<td>{{$i++}}</td>
							<td>{{$thanaValue->division_name}}</td>
							<td>{{$thanaValue->district_name}}</td>
							<td>{{$thanaValue->thana_name}}</td>
							<td>
								{{($thanaValue->is_active == 1)? "Active":"Inactive"}}
							</td>
							<td>
								<table>
									<tbody>
										<tr>
											<td>
												<a href="{{route('thanas_edit_view')}}/{{$thanaValue->thana_id}}" class="btn btn-success">Edit</a>
											</td>
											<td>
												<form action="{{ route('thanas_destroy')}}/{{$thanaValue->thana_id}}" method="POST">
													{{ csrf_field() }}
													<input type="submit" value="Delete" class="btn btn-danger deleteButton">
												</form>
											</td>
										</tr>
									</tbody>
								</table>
							</td>
						</tr>
					@endforeach
				</tbody>
			</table>
			{{$thanaDetails->links()}}
		</div>
	<!-- </div> -->
</div>
@endsection