<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\user;


class answer extends Model
{
    use HasFactory;
    public $timestamps=false;
    protected $fillable=['user_id','question_id','answer'];
}
