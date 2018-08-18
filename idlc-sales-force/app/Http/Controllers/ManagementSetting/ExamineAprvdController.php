<?php

namespace App\Http\Controllers\ManagementSetting;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\ManagementSetting\ApplicantTraining;
use Session;
use Hash;
use Mail;

class ExamineAprvdController extends Controller
{
    public function getPassedExamines(Request $request)
    {
        $examines = ApplicantTraining::with('pre_thana')->where('application_status', 'InProgress')->where('training_status', 'Pass')->get();

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
        $digits = 5;
        $orginalPass = rand(pow(10, $digits - 1), pow(10, $digits) - 1);
        $app_password = Hash::make($orginalPass);
//        return $password;

//        return $request->application_no;
        ApplicantTraining::where('application_no', $request->application_no)->update(['application_status' => 'Approved', 'app_password' => $app_password]);

        $applicantDetails = ApplicantTraining::where('application_no', $request->application_no)->first();

        try {
            $mailArr = [
                'receiver_email' => $applicantDetails->email,
                'receiver_full_name' => $applicantDetails->first_name . ' ' . $applicantDetails->middle_name . ' ' . $applicantDetails->last_name,
//                    'sender_email' => 'idlc_1@gmail.com',
                'sender_email' => $this->senderMail,
                'sender_full_name' => 'IDLC',
                'subject' => 'Approve IFA',
            ];

            Mail::send('emails.ifa_approval', ['user_name' => $applicantDetails->user_name, 'password' => $orginalPass, 'applicant_name' => $applicantDetails->first_name . ' ' . $applicantDetails->middle_name . ' ' . $applicantDetails->last_name], function ($m) use ($mailArr) {
                $m->from($mailArr['sender_email'], $mailArr['sender_full_name']);
                $m->to($mailArr['receiver_email'], $mailArr['receiver_full_name'])->subject($mailArr['subject']);
            });
        }catch (\Exception $ex){
        }

        Session::flash('aprvdRjct_status','Examine Approved successfully.');
        Session::flash('alert-class','alert-success');

        return redirect()->back();
    }
}
