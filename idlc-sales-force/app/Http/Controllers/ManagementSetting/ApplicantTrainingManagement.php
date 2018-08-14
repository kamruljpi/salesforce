<?php

namespace App\Http\Controllers\ManagementSetting;

use App\ApprovedTrainee;
use App\Model\IfaManagement\IfaRegistration;
use App\Model\ManagementSetting\ApplicantTraining;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\ManagementSetting\TrainingSchedule;
use App\ManagementSetting\ApprovedExameen;
use DB;

class ApplicantTrainingManagement extends Controller
{
    public function applicantList($appStatus){
        return ApplicantTraining::orderBy('pre_addr_ps_id', 'ASC')->where(strtolower('application_status'), strtolower($appStatus))->where('application_status', 'InProgress')->get();
    }

    public function scheduledTraineeList(Request $req){
        return ApprovedTrainee::with('trainee')->where('training_schedule_id', $req->schedule_id)->get();
    }

    public function scheduledPassTraineeList(Request $req){
        $allPassTraineList =  ApprovedTrainee::with('pass_trainee')->where('training_schedule_id', $req->schedule_id)->where('training_status', 'TrainingPass')->get();
        $traineeList = [];
        foreach ($allPassTraineList as $allPassTraine){
            $exist = ApprovedExameen::where('applicant_no', $allPassTraine->applicant_no)->get();
            if(count($exist) == 0 || $exist == ''){
                array_push($traineeList, $allPassTraine);
            }
//            return $traineeList;
        }

//        return ApprovedTrainee::with('pass_trainee')->where('training_schedule_id', $req->schedule_id)->get();
//        return $traineeList;
        return $traineeList;
    }

    private function applicantConditionalList($scheduleId , $status){

        $applicants = [];
        $applicantIdList = [];
        $matchAppIds = [];

        $applicantList = DB::select("SELECT ir.*, atr.* FROM tbl_ifa_registrations ir left join approved_trainees atr on(atr.applicant_no = ir.application_no ) where ir.application_status = 'InProgress'");

        foreach ($applicantList as $key => $value) {
            if($value->training_schedule_id == $scheduleId)
                $matchAppIds[] = $value->application_no;
        }
        foreach ($applicantList as $key => $value) {

            if(!in_array($value->application_no, $matchAppIds)/*$value->application_no != $applicantId*/){
                if (!in_array($value->application_no, $applicantIdList))
                    array_push($applicants, $value);
                $applicantIdList[] = $value->application_no;
            }
        }
        return $applicants;
    }

    public function setTraineeSchedule(Request $request, $scheduleId)
    {
        foreach ($request->applicant_no as $appNo){
            if(isset($request->training_status[$appNo])) {
                if(count(ApprovedTrainee::where('applicant_no', $appNo)->where('training_schedule_id', $scheduleId)->get()) < 1){
                    $save = new ApprovedTrainee();
                    $save->training_schedule_id = $scheduleId;
                    $save->applicant_no = $appNo;
                    $save->training_required = isset($request->is_required[$appNo]) ? $request->is_required[$appNo] : 0;
                    $save->save();

                    $this->applicantTrainingStatus($appNo, 'InTraining');
                }
            }
        }

        return true;

    }

    public function applicantTrainingStatus($applicationNo, $status){

        return IfaRegistration::where('application_no', $applicationNo)->update(['training_status' => $status]);
    }

    public function scheduleTraineeView(Request $req){

        $trainees = ApprovedTrainee::with('trainee')->where('training_schedule_id', $req->schedule_id)->get();
        $schedule = TrainingSchedule::with('trainingName')->where('id', $req->schedule_id)->first();


        return view('management_setting.training_schedule.trainee_list', compact('trainees', 'schedule'));
    }

    public function traineeRemove(Request $req){
        ApprovedTrainee::where('applicant_no', $req->application_no)->where('training_schedule_id', $req->schedule_id)->delete();
        ApplicantTraining::where('application_no', $req->application_no)->update(['training_status' => 'Cancle']);

        \Session::flash('exam_status','Trainee removed successfully.');
        \Session::flash('alert-class','alert-danger');

        return redirect()->back();
    }

    public function scheduleTraineeAddView(Request $req){
        $schedule_id = $req->schedule_id;
        $applicants = $this->applicantConditionalList($schedule_id,'InProgress');

        return view('management_setting.training_schedule.add_trainee_training_schedule', compact('schedule_id','applicants'));
    }
    public function scheduleTraineeAddAction(Request $req){

        $this->setTraineeSchedule($req, $req->schedule_id);

        \Session::flash('exam_status','Trainee added successfully.');
        \Session::flash('alert-class','alert-success');

        return redirect()->route('schedule_trainee_view', $req->schedule_id);
    }

    public function trainingStatus(Request $req){

        foreach ($req->training_status as $applicant_no => $resStatus){

            $status = true;

//            if ($resStatus == 'TrainingFail')
//                ApprovedTrainee::where('training_schedule_id', $req->schedule_id)->where('applicant_no', $applicant_no)->update(['training_status' => 'fail']);
//            else
                ApprovedTrainee::where('training_schedule_id', $req->schedule_id)->where('applicant_no', $applicant_no)->update(['training_status' => $resStatus]);

            $trainingScheduleList = ApprovedTrainee::where('applicant_no', $applicant_no);

            foreach ($trainingScheduleList as $tarine){
                if($tarine->training_status != 'TrainingPass'){
                    $status = false;
                    break;
                }
            }

        if($status){
            ApplicantTraining::where('application_no', $applicant_no)->update(['training_status' => $resStatus]);

                $applicantDetails = ApplicantTraining::where('application_no', $applicant_no)->first();
                $mailPerInfo = [
                    'email' => $applicantDetails->email,
                    'name' => $applicantDetails->first_name.' '.$applicantDetails->middle_name.' '.$applicantDetails->last_name,
                    'subject' => 'Application Rejecttion',
                    'mobile_no' => $applicantDetails->mobile_no,
                    'application_number' => mt_rand(100000, 999999),
                ];        
                // SendingEmail::Send('emails.ifa_registration', $mailPerInfo);
            }
        }

        \Session::flash('exam_status','Training status successfully changed.');
        \Session::flash('alert-class','alert-success');

        return redirect()->back();

    }

}
