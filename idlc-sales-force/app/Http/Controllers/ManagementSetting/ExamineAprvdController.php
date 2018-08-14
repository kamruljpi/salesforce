<?php

namespace App\Http\Controllers\ManagementSetting;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\ManagementSetting\ApplicantTraining;
use Session;

class ExamineAprvdController extends Controller
{
    public function getPassedExamines(Request $request)
    {
        $examines = ApplicantTraining::where('application_status', 'InProgress')->where('training_status', 'Pass')->get();

        return view('management_setting.examine_aprvd.pass_examine_list', compact('examines'));
    }

    public function rejectPassExamine(Request $request)
    {
//        return $request->application_no;
        ApplicantTraining::where('application_no', $request->application_no)->update(['application_status' => 'Rejected']);

        Session::flash('aprvdRjct_status','Examine Rejected successfully.');
        Session::flash('alert-class','alert-danger');

        return redirect()->back();
    }

    public function approvedPassExamine(Request $request)
    {
//        return $request->application_no;
        ApplicantTraining::where('application_no', $request->application_no)->update(['application_status' => 'Approved']);

        Session::flash('aprvdRjct_status','Examine Approved successfully.');
        Session::flash('alert-class','alert-success');

        return redirect()->back();
    }
}
