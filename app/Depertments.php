<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Depertments extends Model
{
    use HasFactory;
	protected $fillable = ['id', 'dept_name','created_at', 'updated_at'];
}
