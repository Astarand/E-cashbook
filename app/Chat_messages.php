<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chat_messages extends Model
{
    use HasFactory;
	protected $fillable = ['chat_message_id', 'to_user_id','from_user_id','chat_message','attached','c_qid','timestamp','status','created_at', 'updated_at'];
}
