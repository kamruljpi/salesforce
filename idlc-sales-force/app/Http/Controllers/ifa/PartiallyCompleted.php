<?php

namespace App\Http\Controllers\ifa;

use App\ApprovedTrainee;
use App\Http\Controllers\Message\ActionMessage;
use App\Model\IfaManagement\IfaRegistration;
use App\Model\IfaManagement\FilterOption;
use App\Http\Controllers\Controller;
use App\Model\ManagementSetting\ApplicantTraining;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Validator;
use Auth;
use DB;
use App\Mylibs\SendingEmail;

class PartiallyCompleted extends Controller
{
    public function viewPartiallyCompleted(){

    	$getFilterOptionValue = FilterOption::get();

    	$getListValue = DB::table('tbl_ifa_registrations')
                            ->orderBy('application_no','DESC')
                            ->paginate(15);                            
    	return view('ifa.partialty_completed.partialtyCompleteList',compact('getListValue','getFilterOptionValue'));
    }

    public function viewApplicationDetails(Request $req){

        $application_details = ApplicantTraining::with('pre_district', 'pre_division', 'per_district', 'per_division', 'nationality_info',
            'bank', 'branch', 'user_type', 'premise_ownership', 'permise_ownership')
            ->where('application_no', $req->application_no)->first();

        $applicantTrainingDetails = DB::table('approved_trainees as atr')
                                    ->select('tn.name', 'ts.start_date', 'ts.end_date', 'atr.training_status')
                                    ->join('training_schedules as ts','atr.training_schedule_id','ts.id')
                                    ->join('tbl_training_name as tn','ts.training_name_id','tn.id_training_name')
                                    ->where('atr.applicant_no',$req->application_no)
                                    ->get();


        $applicantExamDetails = DB::table('approved_exameens as aex')
                                    ->select('exn.name','exs.date','exs.start_time','exs.end_time','aex.*')
                                    ->join('exam_schedules as exs','aex.exam_schedule_id','exs.id')
                                    ->join('tbl_exam_names as exn','exs.exam_name_id','exn.id_exam_name')
                                    ->where('aex.applicant_no',$req->application_no)
                                    ->get();
                                    
        // $this->print_me($applicantExamDetails);
        return view('ifa.application_deatils',compact('application_details', 'applicantTrainingDetails','applicantExamDetails'));
    }

    public function nidVaidate(Request $req){

        
        if($req->status == 'Valid'){ $appStatus = 'InProgress'; }
        else if($req->status == 'InValid'){ $appStatus = 'Rejected'; }

        ApplicantTraining::where('application_no', $req->application_no)->update(['nid_validation_status' => $req->status, 'application_status' => $appStatus]);

        $applicantDetails = ApplicantTraining::where('application_no', $req->application_no)->first();
        $mailPerInfo = [
            'email' => $applicantDetails->email,
            'name' => $applicantDetails->first_name.' '.$applicantDetails->middle_name.' '.$applicantDetails->last_name,
            'subject' => 'Application Rejecttion',
            'mobile_no' => $applicantDetails->mobile_no,
            'application_number' => mt_rand(100000, 999999),
        ];        
        // SendingEmail::Send('emails.ifa_registration', $mailPerInfo);

        return redirect()->back();
    }

    public function getIfaAllValue(Request $request){
    	return json_encode(IfaRegistration::get());


    }
    public function getIfaFilterValue(Request $request){

		$object = new IfaRegistration();
        if(!empty($request->sortbyValues) && empty($request->selectedOptionValues) && empty($request->formDateValues) && empty($request->toDateValues)){
            $data = $object->orderBy('application_no',$request->sortbyValues)                    
                    ->get();
        }
	 	else if(!empty($request->selectedOptionValues) && empty($request->formDateValues) && empty($request->toDateValues))
        {
            $data = $object->where('application_status',$request->selectedOptionValues)
                    ->orderBy('application_no',(!empty($request->sortbyValues) ? $request->sortbyValues : "ASC"))
                    ->get();
                
        }else if(!empty($request->selectedOptionValues) && !empty($request->formDateValues) && empty($request->toDateValues)){

            $data = $object->whereDate('created_at','>=',date($request->formDateValues))
                    ->whereDate('created_at','<=',Carbon::now()->format('Ymd'))
                    ->where('application_status',$request->selectedOptionValues)
                    ->orderBy('application_no',(!empty($request->sortbyValues) ? $request->sortbyValues : "ASC"))
                    ->get();

        }else if(empty($request->selectedOptionValues) && !empty($request->formDateValues) && !empty($request->toDateValues)){

            $data = $object->whereDate('created_at','>=',date($request->formDateValues))
                    ->whereDate('created_at','<=',date($request->toDateValues))
                    ->orderBy('application_no',(!empty($request->sortbyValues) ? $request->sortbyValues : "ASC"))
                    ->get();
        }else{

    	 	$data = $object->whereDate('created_at','>=',date($request->formDateValues))
    	 			->whereDate('created_at','<=',date($request->toDateValues))
    	 			->where('application_status',$request->selectedOptionValues)
    	 			->orderBy('application_no',(!empty($request->sortbyValues) ? $request->sortbyValues : "ASC"))
    	 			->get();
        }

    	return json_encode($data);
    }
}
