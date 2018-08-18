<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Model\Lead\CreateLead;
use Illuminate\Http\Request;
use Carbon\Carbon;
use DB;

class MonthlyReportController extends Controller
{
    public static function totalLeadbyMonthCount(){
    	$curentYear = Carbon::now()->format('Y');
    	$data =[];
    	for ($i=1; $i <= 12 ; $i++) { 
    		$data[] = CreateLead::whereDate('created_at','>=',date('Y-m-d',strtotime('01-'.$i.'-'.$curentYear)))
                    ->whereDate('created_at','<=',date('Y-m-d',strtotime('31-'.$i.'-'.$curentYear)))
                    ->count();
    	}
    	return $data;
    }

    public static function highlyInterestedbyMonthCount(){
    	$curentYear = Carbon::now()->format('Y');
    	$data =[];
    	for ($i=1; $i <= 12 ; $i++) { 
    		$data[] = CreateLead::whereDate('created_at','>=',date('Y-m-d',strtotime('01-'.$i.'-'.$curentYear)))
                    ->whereDate('created_at','<=',date('Y-m-d',strtotime('31-'.$i.'-'.$curentYear)))
                    ->where('interest_label', 'highly_interested')
                    ->count();
    	}
    	return $data;
    }
    public static function notInterestedbyMonthCount(){
    	$curentYear = Carbon::now()->format('Y');
    	$data =[];
    	for ($i=1; $i <= 12 ; $i++) { 
    		$data[] = CreateLead::whereDate('created_at','>=',date('Y-m-d',strtotime('01-'.$i.'-'.$curentYear)))
                    ->whereDate('created_at','<=',date('Y-m-d',strtotime('31-'.$i.'-'.$curentYear)))
                    ->where('interest_label', 'highly_interested')
                    ->count();
    	}
    	return $data;
    }
    public static function mightInterestedbyMonthCount(){
    	$curentYear = Carbon::now()->format('Y');
    	$data =[];
    	for ($i=1; $i <= 12 ; $i++) { 
    		$data[] = CreateLead::whereDate('created_at','>=',date('Y-m-d',strtotime('01-'.$i.'-'.$curentYear)))
                    ->whereDate('created_at','<=',date('Y-m-d',strtotime('31-'.$i.'-'.$curentYear)))
                    ->where('interest_label', 'might_invest')
                    ->count();
    	}
    	return $data;
    }
}
