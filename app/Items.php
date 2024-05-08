<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Items extends Model
{
    use HasFactory;
	protected $fillable = ['id', 'added_by','item_type','item_name','base_unit','sec_unit','base_unit_other','item_cat','hsn_code','sac_code','item_bill_no','item_actual_no','item_date','selling_price','selling_tax','wholesale_price','wholesale_tax','purchase_price','purchase_tax','disc_sell','disc_sell_type','min_wholesale_quantity','item_tax','prod_desc','prod_image','created_at','updated_at'];
}
