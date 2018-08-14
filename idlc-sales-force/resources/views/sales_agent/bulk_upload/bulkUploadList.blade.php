@extends('layouts.dashboard')
@section('page_heading','IFA Bulk Upload List')
@section('section')
    <style type="text/css"></style>
    <div class="modal fade" id="upload_image_modal" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                {{-- <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div> --}}
                <div class="modal-body">
                    <div class="form-group">
                        <label for="upload_picture">Upload Picture</label>
                        <input type="file" id="upload_picture" name="upload_picture">
                        <input type="hidden" id="upload_picture_applicant_id" name="upload_picture_applicant_id" value="">
                        <span class="help-block">Maximum file size 1024 kilobytes(1MB)</span>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default imageInputUploadBtn" data-dismiss="modal">Submit</button>
                </div>
            </div>

        </div>
    </div>
    <div class="row top-body">
        <!-- <div class="panel panel-default"> -->
        <!-- <div class="panel-body"> -->
        <div class="col-sm-12">
            <div class="form-group col-sm-3" id="error_1">
                <label class="col-sm-12 control-label">Organization</label>
                <select class="form-control" id="selectOrganizationOption">
                    <option value=""> Choose a Option</option>
                    @foreach($organizations as $organization)
                        <option value="{{$organization->id_organization}}">{{$organization->organization_name}}</option>
                    @endforeach
                </select>
            </div>

            <div class="col-sm-9">
                <br>
                <div class="input-group add-on" style="width:100%;">
                    <input class="form-control" placeholder="Search" name="srch-term" id="user_search" type="text">
                    <div class="input-group-btn pull-left">
                        <button class="btn btn-default" type="submit"><i class="glyphicon glyphicon-search"></i></button>
                    </div>
                </div>
            </div>


        </div>


        <!-- </div> -->
        <!-- </div> -->
    </div>
    <div class="col-sm-12">
        <br>
        <table class="table table-bordered table-striped" id="tblSearch">
            <thead>
            <tr>
                <th class="">Serial</th>
                <th class="">Applicant Name</th>
                <th class="">Mobile No.</th>
                <th class="">Email</th>
                <th class="">Brithday</th>
                <th class="">Image Uploaded</th>
                <th class="">Action</th>
            </tr>
            </thead>
            <tbody id="bulk_list_tbody">
            </tbody>
        </table>
        {{--<div class="pagination_body">--}}
            {{--{{$applicantBulkList->links()}}--}}
        {{--</div>--}}

        <div class="pagination-container">
            <nav>
                <ul class="pagination"></ul>
            </nav>
        </div>
        <!-- </div> -->
        <!-- </div> -->
    </div>
@endsection