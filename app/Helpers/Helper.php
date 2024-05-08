<?php

namespace App\Helpers;
use Illuminate\Support\Facades\Mail;
use DB;
use Auth;
use App\Notifications;
use DateTime;

class Helper{
    public static function SayHello()
    {
        return "SayHello";
    }
	
	public static function getProfileImage()
    {
		$uid   = Auth::user()->id;
		$utype 		=   Auth::user()->u_type;
		$imageName = "";
		if($utype == 1)
		{
			$imageName =  DB::table('ca_profiles')
								->select(DB::raw('ca_profiles.comp_logo'))
								->where('ca_profiles.userId','=',$uid)
								->get();
				
			$imageName = (isset($imageName[0]->comp_logo) && $imageName[0]->comp_logo !="")?$imageName[0]->comp_logo:"";
		}
		else if($utype == 2)
		{
			$imageName =  DB::table('company_profiles')
								->select(DB::raw('company_profiles.comp_logo'))
								->where('company_profiles.userId','=',$uid)
								->get();
				
			$imageName = (isset($imageName[0]->comp_logo) && $imageName[0]->comp_logo !="")?$imageName[0]->comp_logo:"";
		}
        
		
		return $imageName;
    }
	
	public static function addNotification($to_uid,$noti_title,$msg,$url)
    {
		$from_uid   = Auth::user()->id;
		$utype 		=   Auth::user()->u_type;
		if($utype == 2)
		{
			$caAssign =  DB::table('ca_assigns')
								->select(DB::raw('ca_assigns.ca_id'))
								//->leftJoin('users', 'users.id', '=', 'ca_assigns.comp_id')
								->where('ca_assigns.ca_id','=',$from_uid)
								->where('ca_assigns.ca_assign_status','=',1)
								->get();
				
			$to_uid = isset($caAssign[0]->ca_id)?$caAssign[0]->ca_id:$to_uid;
		}
        Notifications::create([
			'from_uid' => $from_uid,
			'to_uid' => $to_uid,
			'utype' => $utype,
			'noti_title' => $noti_title,
			'msg'  => $msg,
			'url'  => $url,
			'status' => 1
		]);
		
		return true;
    }
	
	public static function getNotification($from_uid) {
		
		$utype 		=   Auth::user()->u_type;
		$output = '';
		$data = DB::table('notifications')
			->select(DB::raw('notifications.*'))
			->where('notifications.to_uid', $from_uid)
			//->where('notifications.utype', $utype)
			->where('notifications.status', 1)
			->orderBy('created_at','desc')
			->limit(10)
			->get()->toArray();
		$array = array();
		foreach($data as $k=>$val)
		{
			$array[$val->id]['id'] = $val->id;
			$array[$val->id]['from_uid'] = $val->from_uid;
			$array[$val->id]['to_uid'] = $val->to_uid;
			$array[$val->id]['utype'] = $val->utype;
			$array[$val->id]['noti_title'] = $val->noti_title;
			$array[$val->id]['msg'] = $val->msg;
			$array[$val->id]['url_action'] = $val->url_action;
			$array[$val->id]['status'] = $val->status;
			$array[$val->id]['created_at'] = date("d M y", strtotime($val->created_at));

			if($utype ==1){
				$user =  DB::table('users')
							->select(DB::raw('users.name,users.avatar,company_profiles.comp_logo'))
							->leftJoin('company_profiles', 'users.id', '=', 'company_profiles.userId')
							->where('users.id', '=', $val->from_uid)
							->get();
				
			}else if($utype ==2){
				$user =  DB::table('users')
							->select(DB::raw('users.name,users.avatar,ca_profiles.comp_logo'))
							->leftJoin('ca_profiles', 'users.id', '=', 'ca_profiles.userId')
							->where('users.id', '=', $val->from_uid)
							->get();
			}
			$array[$val->id]['name'] = isset($user[0]->name)?$user[0]->name:"";
			$array[$val->id]['avatar'] = isset($user[0]->comp_logo)?'public/uploads/profile/'.$user[0]->comp_logo:"";
		}
		$data = json_decode(json_encode($array));
		
		return $data;
		/* foreach($data as $row)
		{
			return $row->rating;
		} */
	}
	
	public static function invoice_num ($input, $pad_len = 7, $prefix = null) {
		if ($pad_len <= strlen($input))
			trigger_error('<strong>$pad_len</strong> cannot be less than or equal to the length of <strong>$input</strong> to generate invoice number', E_USER_ERROR);

		if (is_string($prefix))
			return sprintf("%s%s", $prefix, str_pad($input, $pad_len, "0", STR_PAD_LEFT));

		return str_pad($input, $pad_len, "0", STR_PAD_LEFT);
	}
	
	
	public static function dateCompare($toBeComparedDate)
    {
        //$toBeComparedDate = '2014-08-12';
		$today = (new DateTime())->format('d-m-Y'); 
		$expiry = (new DateTime($toBeComparedDate))->format('d-m-Y');

		if(strtotime($expiry) > strtotime($today)){
			return true;
		}else{
			return 0;
		}
    }
	
	public static function check_subscriber(){
		if(Auth::user() && (/*Auth::user()->u_type == 1 || */Auth::user()->u_type == 2)){
			$userId = Auth::user()->id;
			$chkUser = DB::table('users')
					->select(DB::raw('users.id,users.created_at'))	
					->where('users.id','=',Auth::user()->id)
					->where('users.u_type','=',Auth::user()->u_type)
					->get();
					
			$chkSubscription = DB::table('subscribers')
					->select(DB::raw('subscribers.id,subscribers.start_at,subscribers.end_at'))	
					->where('subscribers.uid','=',Auth::user()->id)
					->where('subscribers.utype','=',Auth::user()->u_type)
					->where('subscribers.status','=',1)
					->where('subscribers.payment_status','=',"SUCCESS")
					->orderBy('subscribers.id', 'DESC')->limit(1)
					->get();
			
			if(count($chkSubscription) == 0){
				//echo "Not subscribers";
				$start_at = date("d-m-Y",strtotime($chkUser[0]->created_at));
				$next_date = date('d-m-Y', strtotime($start_at. ' + 15 days'));
				
			}else if(count($chkSubscription) != 0){
				//echo "is subscribers";
				$start_at = date("d-m-Y",strtotime($chkSubscription[0]->start_at));
				$end_at = date("d-m-Y",strtotime($chkSubscription[0]->end_at));
				$next_date = $end_at;
			}
			$chkDate = self::dateCompare($next_date);
			//echo "<pre>";print_r($chkUser);
			//echo "<pre>";print_r($chkSubscription);exit;
			if($chkDate){
				//echo "yes";
				return true;
			}else{
				//echo "no";
				$update = DB::table('users')
					->where('id', $userId)
					->update(
						array(
							'isCaActive' => 0,
						)
					); 
				return 0;
			}
		}
		if(Auth::user() && (Auth::user()->u_type == 1)){
			$userId = Auth::user()->id;
			$chkUser = DB::table('users')
					->select(DB::raw('users.id,users.isCaActive'))	
					->where('users.id','=',$userId)
					->get();
			if($chkUser[0]->isCaActive == 1){
				return true;
			}else{
				return false;
			}
		}
		if(Auth::user() && (Auth::user()->u_type == 4)){
			$userId = Auth::user()->id;
			$chkAddedBy = DB::table('users')
					->select(DB::raw('users.ca_add_by'))	
					->where('users.id','=',$userId)
					->where('users.u_type','=',Auth::user()->u_type)
					->get();
					
			$chkUser = DB::table('users')
					->select(DB::raw('users.id,users.isCaActive'))	
					->where('users.id','=',$chkAddedBy[0]->ca_add_by)
					->get();
			if($chkUser[0]->isCaActive == 1){
				return true;
			}else{
				return false;
			}
			/*$chkAddedBy = DB::table('users')
					->select(DB::raw('users.ca_add_by,users.u_type'))	
					->where('users.id','=',Auth::user()->id)
					->where('users.u_type','=',Auth::user()->u_type)
					->get();
					
			$chkUser = DB::table('users')
					->select(DB::raw('users.id,users.u_type,users.created_at'))	
					->where('users.id','=',$chkAddedBy[0]->ca_add_by)
					->get();
					
			$chkSubscription = DB::table('subscribers')
					->select(DB::raw('subscribers.id,subscribers.start_at,subscribers.end_at'))	
					->where('subscribers.uid','=',$chkUser[0]->id)
					->where('subscribers.utype','=',$chkUser[0]->u_type)
					->where('subscribers.status','=',1)
					->where('subscribers.payment_status','=',"SUCCESS")
					->orderBy('subscribers.id', 'DESC')->limit(1)
					->get();			
			if(count($chkSubscription) == 0){
				//echo "Not subscribers";
				$start_at = date("d-m-Y",strtotime($chkUser[0]->created_at));
				$next_date = date('d-m-Y', strtotime($start_at. ' + 15 days'));
				
			}else if(count($chkSubscription) != 0){
				//echo "is subscribers";
				$start_at = date("d-m-Y",strtotime($chkSubscription[0]->start_at));
				$end_at = date("d-m-Y",strtotime($chkSubscription[0]->end_at));
				$next_date = $end_at;
			}
			$chkDate = self::dateCompare($next_date);
			if($chkDate){
				return true;
			}else{				 
				return 0;
			}*/
		}
		return true;
	}
	
	public static function convert_number_to_words(float $number) {

		$decimal = round($number - ($no = floor($number)), 2) * 100;
		$hundred = null;
		$digits_length = strlen($no);
		$i = 0;
		$str = array();
		$words = array(0 => '', 1 => 'one', 2 => 'two',
			3 => 'three', 4 => 'four', 5 => 'five', 6 => 'six',
			7 => 'seven', 8 => 'eight', 9 => 'nine',
			10 => 'ten', 11 => 'eleven', 12 => 'twelve',
			13 => 'thirteen', 14 => 'fourteen', 15 => 'fifteen',
			16 => 'sixteen', 17 => 'seventeen', 18 => 'eighteen',
			19 => 'nineteen', 20 => 'twenty', 30 => 'thirty',
			40 => 'forty', 50 => 'fifty', 60 => 'sixty',
			70 => 'seventy', 80 => 'eighty', 90 => 'ninety');
		$digits = array('', 'hundred','thousand','lakh', 'crore');
		while( $i < $digits_length ) {
			$divider = ($i == 2) ? 10 : 100;
			$number = floor($no % $divider);
			$no = floor($no / $divider);
			$i += $divider == 10 ? 1 : 2;
			if ($number) {
				$plural = (($counter = count($str)) && $number > 9) ? 's' : null;
				$hundred = ($counter == 1 && $str[0]) ? ' and ' : null;
				$str [] = ($number < 21) ? $words[$number].' '. $digits[$counter]. $plural.' '.$hundred:$words[floor($number / 10) * 10].' '.$words[$number % 10]. ' '.$digits[$counter].$plural.' '.$hundred;
			} else $str[] = null;
		}
		$Rupees = implode('', array_reverse($str));
		$paise = ($decimal > 0) ? "." . ($words[$decimal / 10] . " " . $words[$decimal % 10]) . ' Paise' : '';
		return ($Rupees ? $Rupees . 'Rupees ' : '') . $paise;
	}
	
	//Start send mail
	public static function emailTemplate($data) {
		$title = $data['title'];
		$subject = $data['subject'];
		$name = isset($data['comp_name'])?$data['comp_name']:$data['name'];
		$email = isset($data['comp_email'])?$data['comp_email']:$data['email'];
		$msg = $data['msg'];
		$files = isset($data['files'])?$data['files']:"";
		$body = '<html lang="en">
					<head>
					<title>'.$title.'</title>
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
							<h1 style="color: #1fa8b8;font-size: 50px;text-align: center;margin-bottom: 0;">'.$subject.'</h1>
							<div style="width: 141px;background: #f57e20;height: 2px;margin: 8px auto 0;"></div>
						</div>
						<div class="content-wraper" style="margin-top: 50px;display: block;padding: 0 30px;">
							<table cellpadding="0" cellspacing="0" border="0" width="100%">
								<tr>
									<td align="left" style="padding-bottom: 20px;"><b>Dear '.$name.',</b></td>
								</tr>
								
								<tr>
									<td style="padding-bottom: 5px;"><p style="text-align: left;margin: 0;font-weight:600;">'.$msg.'</p></td>
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
		//echo $body;exit;			
		$data_email = [
			'email' => $email
		];
		$sendMail = self::emailSendFunc($body,$data_email,$subject,$files);
		return $sendMail;		
	}
	
	public static function emailSendFunc($body,$data_email,$subject,$files=null) {
		$url = url()->current();
		if (str_contains($url, 'localhost')) { 
			Mail::send([], [], function ($message) use ($body,$data_email,$subject,$files) {
			  $message->to($data_email['email'])
				->subject($subject)
				->from(env('MAIL_FROM_ADDRESS'),env('MAIL_FROM_NAME'))
				->setBody($body, 'text/html');
				if(isset($files) && $files!="") {
					$message->attach($files->getRealPath(), array(
							'as' => $files->getClientOriginalName(),     
							'mime' => $files->getMimeType())
					);
				}
			});
		}else{
			Mail::send([], [], function ($message) use ($body,$data_email,$subject,$files) {
			  $message->to($data_email['email'])
				->subject($subject)
				->from(env('MAIL_FROM_ADDRESS'),env('MAIL_FROM_NAME'))
				->setBody($body, 'text/html');
				if(isset($files) && $files!="") {
					$message->attach($files->getRealPath(), array(
							'as' => $files->getClientOriginalName(),     
							'mime' => $files->getMimeType())
					);
				}
			});
		}
		return true;
	}
	//End send mail
	
	/*public static function slugify($text)
	{
	  // replace non letter or digits by -
	  $text = preg_replace('~[^\pL\d]+~u', '-', $text);

	  // transliterate
	  $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);

	  // remove unwanted characters
	  $text = preg_replace('~[^-\w]+~', '', $text);

	  // trim
	  $text = trim($text, '-');

	  // remove duplicate -
	  $text = preg_replace('~-+~', '-', $text);

	  // lowercase
	  $text = strtolower($text);

	  if (empty($text)) {
		return 'n-a';
	  }

	  return $text;
	}
	
	public static function getImage($image)
	{
		//echo $image ;exit;
		 $u_path = public_path().'/uploads/products/' ; 
		if ($image != null && file_exists($u_path . $image)) {
			$image_rec = $u_path . $image;
		} else {
			$image_rec = public_path().'/uploads/no-image.png' ;
		}
		return $image_rec;
	}
	
	public static function getCategoryTree($level = null, $prefix = '') {
		$rows = DB::table('categories')
			->select('id','parent_id','name')
			->where('parent_id', $level)
			->orderBy('id','asc')
			->get();
			//->result();

		$category = '';
		if (count($rows) > 0) {
			foreach ($rows as $row) {
				$category .= $prefix . $row->name . "<br>";
				// Append subcategories
				$category .= self::getCategoryTree($row->id, $prefix . '-');
			}
		}
		return $category;
	}
	
	public static function getCategoryMain($level = null, $prefix = '') {
		$rows = DB::table('categories')
			->select('id','parent_id','name','cat_slug')
			->where('parent_id', $level)
			->orderBy('name','asc')
			->take(6)
			->get();
			//->result();

		
		return $rows;
	}
	
	public static function get_rating($pid) {
		$data = DB::table('rating')
			//->select('AVG(rating) as rating')
			->select(DB::raw('avg(rating) as rating'))
			->where('pid', $pid)
			->get()->toArray();
			

		 foreach($data as $row)
		  {
		   return $row->rating;
		  }
	}
	
	public static function html_output_rating($productId)
	 {
			
		  
		  $output = '';
		  
		   $color = '';
		   $rating = static::get_rating($productId);
		   $output .= '
		   <ul class="align-items-center" data-rating="'.$rating.'" title="Average Rating - '.$rating.'">
		   ';
		   for($count = 1; $count <= 5; $count++)
		   {
			if($count <= $rating)
			{
			 $color = 'color:#ffcc00;';
			}
			else
			{
			 $color = 'color:#ccc;';
			}
			$uid = isset(Auth::user()->id)?Auth::user()->id:"";
			$output .= '<li title="'.$count.'" id="'.$productId.'-'.$count.'" data-index="'.$count.'" data-pid="'.$productId.'" data-rating="'.$rating.'" data-userId="'. $uid .'" class="str-active" style="cursor:pointer; '.$color.' font-size:24px;">&#9733;</li>';
		   }
		   $output .= '</ul>';
		   
		  
		  return $output;
	 }
	 
	 public static function html_output_rating_details($rating)
	 {
			
		  
		  $output = '';
		  
		   $color = '';
		   //$rating = static::get_rating($productId);
		   $output .= '
		   <ul class="align-items-center" data-rating="'.$rating.'" title="Average Rating - '.$rating.'">
		   ';
		   for($count = 1; $count <= 5; $count++)
		   {
			if($count <= $rating)
			{
			 $color = 'color:#ffcc00;';
			}
			else
			{
			 $color = 'color:#ccc;';
			}
			$uid = isset(Auth::user()->id)?Auth::user()->id:"";
			$output .= '<li title="'.$count.'" id="'.$count.'" data-index="'.$count.'" data-pid="" data-rating="'.$rating.'" data-userId="'. $uid .'" class="rating str-active" style="cursor:pointer; '.$color.' font-size:24px;">&#9733;</li>';
		   }
		   $output .= '</ul>';
		   
		  
		  return $output;
	 }
	 
	 public static function get_rating_seller($sid) {
		$data = DB::table('rating')
			//->select('AVG(rating) as rating')
			->select(DB::raw('avg(rating) as rating'))
			->leftJoin('products', 'rating.pid', '=', 'products.id')
			->where('products.user_id', $sid)
			->get()->toArray();
			

		 foreach($data as $row)
		  {
		   return $row->rating;
		  }
	}
	
	public static function html_output_rating_seller($sellerId)
	 {
			
		  
		  $output = '';
		  
		   $color = '';
		   $rating = static::get_rating_seller($sellerId);
		   $output .= '
		   <ul class="align-items-center" data-rating="'.$rating.'" title="Average Rating - '.$rating.'">
		   ';
		   for($count = 1; $count <= 5; $count++)
		   {
			if($count <= $rating)
			{
			 $color = 'color:#ffcc00;';
			}
			else
			{
			 $color = 'color:#ccc;';
			}
			$uid = isset(Auth::user()->id)?Auth::user()->id:"";
			$output .= '<li title="'.$count.'" id="'.$sellerId.'-'.$count.'" data-index="'.$count.'" data-pid="'.$sellerId.'" data-rating="'.$rating.'" data-userId="'. $uid .'" class="str-active" style="cursor:pointer; '.$color.' font-size:24px;">&#9733;</li>';
		   }
		   $output .= '</ul>';
		   
		  
		  return $output;
	 }

	public static function printCategoryTree() {
		echo $this->getCategoryTree();
	}
	
	public static function site_infos()
	{
		$siteInfos =  DB::table('site_infos')
						->select(DB::raw('site_infos.*'))
						->where('status','=',1)
						->get()->toArray();
		return $siteInfos;
	}*/
}


