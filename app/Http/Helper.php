<?php

namespace App\Helpers;
use Illuminate\Support\Facades\Mail;
use DB;
use Auth;
use App\Notifications;

class Helper{
    public static function SayHello()
    {
        return "SayHello";
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
	
	public static function emailSendFunc($body,$data_email,$subject) {
		
		/*Mail::send([], [], function ($message) use ($body,$data_email,$subject) {
		  $message->to($data_email['email'])
			->subject($subject)
			->from(env('MAIL_FROM_ADDRESS'))
			->setBody($body, 'text/html');
		});*/
		return true;
	}
	
	
	
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


