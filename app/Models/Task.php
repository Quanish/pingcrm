<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Task extends Model
{
    use SoftDeletes;
    protected $fillable = ['user','deadline','description','title','audition','status','type'];
    public function user()
    {
        return $this->belongsTo(User::class,'user','id');
    }
    public function audition(){
    	return $this->belongsTo(User::class,'audition','id');
    }
    public function comment()
    {
    	return $this->hasMany(Comment::class);
    }
    public function event()
    {
    	return $this->hasMany(Event::class);
    }
}