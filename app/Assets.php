<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Assets extends Model
{
    use HasFactory;
	protected $fillable = ['id', 'added_by','asset_name','branch_name','asset_cat','asset_sl_no','purchase_date','purchase_cost','warranty_period','opening_stock','opening_it_act','opening_comp_act','desc_it','desc_comp','created_at','updated_at'];
}
