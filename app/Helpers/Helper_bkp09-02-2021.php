<?php

namespace App\Helpers;
use DB;
use Auth;

class Helper{
    public static function SayHello()
    {
        return "SayHello";
    }
	
	public static function slugify($text)
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

	public static function printCategoryTree() {
		echo $this->getCategoryTree();
	}
}


