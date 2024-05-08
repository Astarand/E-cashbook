<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
//use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use Redirect;
use DB;
use Auth;
use Validator;
use App\User;
use Helper;
use Image;
use Illuminate\Support\Facades\Cookie;

class ReminderController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function Index()
    {
		//$this->middleware('auth');
		return view('pages.superadmin.ca-reminder')->with([

		]);
    }
	
	public function userLists(Request $request)
    {
		$reminder_type = $request->reminder_type; 
		$user_type = $request->id; 
		$status = $request->customer_type; 
		$reminder_through = $request->reminder_through; 
					
		$result = User::query()
					->where('u_type', '=', $user_type) 
					->where('status', '=', $status) 
					->get();
		
		$array = array();
		foreach($result as $k=>$val)
		{
			$array[$val->id]['id'] = $val->id;
			$array[$val->id]['u_type'] = $val->u_type;
			if($val->u_type == 1){
				$company = DB::table('ca_profiles')
						->select(DB::raw('ca_profiles.comp_name'))					                 					
						->where('ca_profiles.userId','=',$val->id) 
						->get();
			}else if($val->u_type == 2){
				$company = DB::table('company_profiles')
					->select(DB::raw('company_profiles.comp_name'))					                 					
					->where('company_profiles.userId','=',$val->id) 
					->get();
			}
            $array[$val->id]['comp_name'] = isset($company[0]->comp_name)?$company[0]->comp_name:$val->name;
            $array[$val->id]['comp_phone'] = isset($company[0]->comp_phone)?$company[0]->comp_phone:$val->phone;
            $array[$val->id]['comp_email'] = isset($company[0]->comp_email)?$company[0]->comp_email:$val->email;
			
		}
		$result = json_decode(json_encode($array));
		
		$response = [];
		//echo "<pre>";print_r($result);exit;
		foreach($result as $row){
		   $response[] = array("id"=>$row->id, "name"=>$row->comp_name);
		}
		
		echo json_encode($response); 

    }
	
	public function sendReminder(Request $request)
    {
		
	}
	
	public function remider_mail(Request $request)
    {
		
	}
	
	public function company_task_list(Request $request)
    {
		$task_category = $request->task_category;
		$userId = Auth::user()->id;
		$tasks = DB::table('users')
						->select(DB::raw('users.name,users.u_type,task_managements.id,task_managements.company_id,task_managements.task_category'))					
						->leftJoin('task_managements', 'users.id', '=', 'task_managements.company_id')                   					
						->where('task_managements.added_by','=',$userId) 
						->where('task_managements.task_category','=',$task_category) 
						->get();
		$array = array();
		foreach($tasks as $k=>$val)
		{
			$array[$val->id]['id'] = $val->id;
			$array[$val->id]['u_type'] = $val->u_type;
			$array[$val->id]['task_category'] = $val->task_category;
			$company = DB::table('company_profiles')
						->select(DB::raw('company_profiles.comp_name'))					                 					
						->where('company_profiles.userId','=',$val->company_id) 
						->get();
            $array[$val->id]['comp_name'] = isset($company[0]->comp_name)?$company[0]->comp_name:$val->name;
			
		}
		$tasks = json_decode(json_encode($array));
		//echo "<pre>"; print_r($tasks);exit;
		return view('pages.ca.company-task-list')->with([
			'tasks'=>$tasks,
		]);  
    }
	
	public function send_bulk_message(Request $request)
    {
		$reminderText = trim($request->reminderText);
		$task_category = $request->task_category;
		
		if($reminderText ==""){
			$msg = array(
				'status' => 'error',
				'class' => 'err',
				'redirect' => url('/'),
				'message' => 'Message is required'
			);
			return response()->json($msg);
		}else if($task_category ==""){
			$msg = array(
				'status' => 'error',
				'class' => 'err',
				'redirect' => url('/'),
				'message' => 'Please select task category'
			);
			return response()->json($msg);
		}else{
			$userId = Auth::user()->id;
			$tasksToSend = DB::table('users')
						->select(DB::raw('users.name,users.email,users.u_type,task_managements.id,task_managements.company_id'))					
						->leftJoin('task_managements', 'users.id', '=', 'task_managements.company_id')                   					
						->where('task_managements.added_by','=',$userId) 
						->where('task_managements.task_category','=',$task_category) 
						->get();
			if( sizeof($tasksToSend) == 0 ) {
				$msg = array(
					'status' => 'error',
					'class' => 'err',
					'redirect' => url('/'),
					'message' => 'No task item for selected category'
				);
				return response()->json($msg);
			}
			
			$array = array();
			foreach($tasksToSend as $k=>$val)
			{
				$array[$val->id]['id'] = $val->id;
				$array[$val->id]['u_type'] = $val->u_type;
				$array[$val->id]['task_category'] = $task_category;
				$company = DB::table('company_profiles')
							->select(DB::raw('company_profiles.comp_name,company_profiles.comp_email'))					                 					
							->where('company_profiles.userId','=',$val->company_id) 
							->get();
				$comp_name = isset($company[0]->comp_name)?$company[0]->comp_name:$val->name;
				$email = isset($company[0]->comp_email)?$company[0]->comp_email:$val->email;
				$array[$val->id]['comp_name'] = $comp_name;
				$array[$val->id]['comp_email'] = $email;
				
				//Add notification
				$from_uid = Auth::user()->id;
				$to_uid = $val->company_id;
				$utype = Auth::user()->u_type;
				$noti_title = "CA Reminder";
				$msg = $reminderText;
				$url ="";
				$notifications = Helper::addNotification($to_uid,$noti_title,$msg,$url);
				//End notification
				
				//Start send mail
				$name = $comp_name;
				$email = $email;
				$body = '<html lang="en">
								<head>
								<title>Reminder Email</title>
								<meta charset="utf-8">
								<meta name="viewport" content="width=device-width, initial-scale=1">
								
								</head>
								<body style="margin: 0;padding: 0;font-family: Arial, Helvetica, sans-serif;">
									
								<div style="width: 100%;display: block;position: relative;">
									<div style="display: block;">
										<a href="">
											<img src="'.asset('public/assets/img/logo.png').'" alt="logo" style="margin: 0 auto;padding: 20px 0;height: auto;max-width: 100%;display: block;">
										</a>
									</div>
									
									<div class="main-wraper" style="max-width: 600px;margin: 0 auto;position: relative;">
									<div style="margin-top: 50px;display: block;">
										<h1 style="color: #1fa8b8;font-size: 50px;text-align: center;margin-bottom: 0;">Reminder From CA</h1>
										<div style="width: 141px;background: #f57e20;height: 2px;margin: 8px auto 0;"></div>
									</div>
									<div class="content-wraper" style="margin-top: 50px;display: block;padding: 0 30px;">
										<table cellpadding="0" cellspacing="0" border="0" width="100%">
											<tr>
												<td align="left" style="padding-bottom: 20px;"><b>Dear '.$name.',</b></td>
											</tr>
											
											<tr>
												<td style="padding-bottom: 5px;"><p style="text-align: left;margin: 0;font-weight:600;">Reminder from CA below:</p></td>
											</tr>
											
											<tr>
												<td style="padding-bottom: 5px;"><p style="text-align: left;margin: 0;font-weight:600;">'.$reminderText.'</p></td>
											</tr>
											
											<tr>
												<td style="padding-bottom: 5px;">
												<p style="text-align: left;margin: 0;font-weight:600;">
												
												</p>
												</td>
											</tr>
											
										</table>
										
									</div>
									
									
								</div>
								<div class="ft" style="background: #76bed0;display: block;">
										<p style="text-align: center;color: #ffffff;font-size: 14px;padding:5px 0;">Copyright © '.date("Y").' E-cashbook</p>
									</div>
								</div>    

								</body>
								</html> ';	
							
				$data_email = [
					'email' => $email
				];
				$emailSubject = "Reminder from CA";
				$sendMail = Helper::emailSendFunc($body,$data_email,$emailSubject);				
				//End send mail
				
			}
			
			if($notifications){
				$msg = array(
					'status' => 'success',
					'class' => 'succ',
					'redirect' => url('/'),
					'message' => 'Message sent successfully'
				);
				return response()->json($msg);
			}else{
				$msg = array(
					'status' => 'error',
					'class' => 'err',
					'redirect' => url('/'),
					'message' => 'Message send failed.Try again!'
				);
				return response()->json($msg);
			}
			$tasksToSend = json_decode(json_encode($array));
			
			
			echo "<pre>"; print_r($tasksToSend);exit;
		
		
		}
		
		
    }


}
