<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Support\Facades\App;

class quiz extends Model
{
    use HasFactory;
    use Sluggable;
    protected $fillable=['title','description','status','finished_at'];
    protected $dates=['finished_at'];

    public function my_result(){
        return $this->hasOne('App\Models\result')->where('user_id',auth()->user()->id);
    }

    public function getFinishedAtAttribute($date){
        return $date ? Carbon::parse($date) : null;
    }

    public function question(){
        return $this->hasMany('App\Models\question');
   }
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }
}
