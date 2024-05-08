<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sales_values extends Model
{
    use HasFactory;
	protected $fillable = ['id','sid','uid','prod_id','quantity','rate','disc','disc_type','tax_amt','amount','tax_type','gst_rate','billing_type','prod_gov_fee','gst_trans','created_at','updated_at'];
}
