@extends('layouts.dashboard')
@section('page_heading','Ifa bulk upload')
@section('section')

<div class="panel panel-default">
    <div class="panel-heading">
        <h3>
            IFA/Sales Agent Upload List
        </h3>
    </div>
    <div class="panel-body">
        <div class="row">
            <div class="col-sm-12">
                <table class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <?php
                        $title_key = ['name','mobile_number','email','nationality','dob','error'];

                        if(session('err_ifa_list')){
                            foreach(session('err_ifa_list') as $xkey => $xval){
                                foreach($xval as $xxkey => $xxval){
                                    if(in_array($xxkey, $title_key)){
                                        print '<th class="tablehead_'.$xxkey.'">'.str_replace("_"," ", $xxkey).'</th>';
                                    }
                                }
                                break;
                            }
                        }
                        ?>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $title_key = ['name','mobile_number','email','nationality','dob','error'];

                    if(session('err_ifa_list')){
                    foreach(session('err_ifa_list') as $xkey => $xval){
                    ?>
                    <tr>
                        <?php
                        foreach($xval as $xxkey => $xxval){
                            if(in_array($xxkey, $title_key)){
                                print '<td class="table_data_'.$xxkey.'">'.$xxval.'</td>';
                            }
                        }
                        ?>
                    </tr>
                    <?php
                    }
                    }
                    ?>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12" style="  padding: 0px;  padding-left: 20px; margin-right: 20px;">
                <div class="pull-right" style="margin-left: 20px;">
                    <form action="{{ route('bulkUploadActionfinal')}}" method="POST" role="form" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <textarea style="display: none;" name="upload_ifa_members">{{ $members_ifa_list }}</textarea>
                        <button type="submit" class="btn btn-primary ">Save</button>
                    </form>
                </div>
                <div class="pull-right">
                    <a href="http://localhost/SalesForce/lead/bulk/confirmation/cancle" class="btn btn-primary btn-danger">Cancel</a>
                </div>
            </div>
        </div>
    </div>
</div>
<style type="text/css">
    .alert-danger,.alert-success {
        color: #fff !important;
    }
</style>
@endsection