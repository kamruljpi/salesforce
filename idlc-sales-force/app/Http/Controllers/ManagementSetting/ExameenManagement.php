<?php

namespace App\Http\Controllers\ManagementSetting;

use App\ManagementSetting\ApprovedExameen;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\IfaManagement\IfaRegistration;
use App\ManagementSetting\ExamSchedule;
use App\Model\ManagementSetting\ApplicantTraining;
use App\Model\ManagementSetting\TrainingSchedule;
use Session;
use Mail;

class ExameenManagement extends Controller
{
    public function setExameenSchedule(Request $request, $examScheeId){

        if(isset($request->applicant_no)) {
            foreach ($request->applicant_no as $appNo) {
                if (isset($request->exam_status[$appNo])) {
                    if (count(ApprovedExameen::where('applicant_no', $appNo)->where('exam_schedule_id', $examScheeId)->get()) < 1) {
                        $save = new ApprovedExameen();
                        $save->exam_schedule_id = $examScheeId;
                        $save->applicant_no = $appNo;
                        $save->save();

                        $this->applicantTrainingStatus($appNo, 'InExam');
                    }
                }
            }
        }

        return true;
    }

    public function applicantTrainingStatus($applicationNo, $status){

        return IfaRegistration::where('application_no', $applicationNo)->update(['training_status' => $status]);
    }

    public function scheduleExameenView(Request $req){
        $exameen = ApprovedExameen::with('exameen')->where('exam_schedule_id', $req->exam_schedule_id)->get();
        $schedule = ExamSchedule::with('examName')->where('id', $req->exam_schedule_id)->first();
       // return $schedule;
        return view('management_setting.exam_schedule.exameen_list', compact('exameen', 'schedule'));
    }


    public function exameenRemove(Request $req){

        ApprovedExameen::where('applicant_no', $req->application_no)->where('exam_schedule_id', $req->exam_schedule_id)->delete();
        ApplicantTraining::where('application_no', $req->application_no)->update(['training_status' => 'InTraining']);

        Session::flash('exam_status','Exameen removed successfully.');
        Session::flash('alert-class','alert-danger');

        return redirect()->back();

    }

    public function scheduleExameenUpdateView(Request $req){
        $schedule_id = $req->schedule_id;
        $trainingList = TrainingSchedule::with('trainingName')->where('is_complete', 0)->get();


        return view('management_setting.exam_schedule.add_exameen_exam_schedule', compact('trainingList', 'schedule_id'));
    }
    public function scheduleExameenUpdateAction(Request $req){

        $this->setExameenSchedule($req, $req->schedule_id);

        Session::flash('exam_status','Exam schedule successfully.');
        Session::flash('alert-class','alert-success');

        return redirect()->route('schedule_exameen_view', $req->schedule_id);
    }

    public function examStatus(Request $req){

//        $this->print_me($req->exam_status);
        if(isset($req->exam_status) && !empty($req->exam_status)){
            foreach ($req->exam_status as $applicant_no => $resStatus){
                if($resStatus != 'exam') {
                    ApplicantTraining::where('application_no', $applicant_no)->update(['training_status' => $resStatus]);
//                if ($resStatus == 'Pass') {
//                    ApplicantTraining::where('application_no', $applicant_no)->update(['application_status' => 'Approved']);
//                } else if ($resStatus == 'Fail') {
//                    ApplicantTraining::where('application_no', $applicant_no)->update(['application_status' => 'InProgress']);
//                }


                    $applicantDetails = ApplicantTraining::where('application_no', $applicant_no)->first();
//                $mailPerInfo = [
//                    'email' => $applicantDetails->email,
//                    'name' => $applicantDetails->first_name . ' ' . $applicantDetails->middle_name . ' ' . $applicantDetails->last_name,
//                    'subject' => 'Application Rejecttion',
//                    'mobile_no' => $applicantDetails->mobile_no,
//                    'application_number' => mt_rand(100000, 999999),
//                ];
                    // SendingEmail::Send('emails.ifa_registration', $mailPerInfo);
                    try {
                        $mailArr = [
                            'receiver_email' => $applicantDetails->email,
                            'receiver_full_name' => $applicantDetails->first_name . ' ' . $applicantDetails->middle_name . ' ' . $applicantDetails->last_name,
//                            'sender_email' => 'idlc_1@gmail.com',
                            'sender_email' => $this->senderMail,
                            'sender_full_name' => 'IDLC',
                            'subject' => 'Exam Result',
                        ];

                        Mail::send('emails.exam_status', ['exam_status' => $resStatus, 'applicant_name' => $applicantDetails->first_name . ' ' . $applicantDetails->middle_name . ' ' . $applicantDetails->last_name], function ($m) use ($mailArr) {
                            $m->from($mailArr['sender_email'], $mailArr['sender_full_name']);
                            $m->to($mailArr['receiver_email'], $mailArr['receiver_full_name'])->subject($mailArr['subject']);
                        });

                    }catch (\Exception $ex) {
                        Session::flash('exam_status','Mail Sending Fails. But The User Has Been Passed.');
                    }
                }
            }
            Session::flash('exam_status','Exam status successfully changed.');
            Session::flash('alert-class','alert-success');
        }else{
            Session::flash('exam_status','you can not save with blank data.');
        }
        return redirect()->back();
    }
}
