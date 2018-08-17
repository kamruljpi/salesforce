@extends('layouts.dashboard')
@section('page_heading','Ifa bulk upload')
@section('section')
<div class="col-sm-8 col-sm-offset-2">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3>
                IFA/Sales Agent Upload
            </h3>
        </div>
        <div class="panel-body">
            <form action="{{ route('sales_bulk_upload_action')}}" method="POST" role="form" enctype="multipart/form-data">
                {{csrf_field()}}
                    <div class="form-group row">
                        <label class="col-sm-3 control-label" for="bulkupload"> <span class="pull-right">Institution</span></label>
                        <div class="col-sm-4">
                            <select class="form-control selections" name="institution" id="institution">
                                <option value="0">Select Insititution</option>
                                <?php 
                                    if(isset($institutions) && !empty($institutions)){
                                        foreach ($institutions as $institution) {
                                            print '<option value="'.$institution->id_organization.'">'.$institution->organization_name.'</option>';
                                        }
                                    }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 control-label" for="bulkupload"> <span class="pull-right">IFA/Sales Agent :</span></label>
                        <div class="col-sm-5">
                            <input type="file" name="bulk" class="form-control-file" id="bulkupload">
                        </div>
                        <div class="col-sm-4">
                            <button type="submit" class="btn btn-primary" style="margin-right: 15px;">
                                <span class="pull-left">
                                    Upload
                                </span>
                            </button>
                        </div>
                    </div>
            </form>
            <div class="col-sm-12">
                <div class="form-group">
                    <label class="col-sm-4">
                        <span class="pull-right" style="padding-top: 8px">Preferred File Format :</span>
                    </label>
                    <div class="col-sm-6">
                        <a href="{{ asset('excel/ifa.xlsx')}}" class="btn btn-default">Download excel <i class="fa fa-download"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection