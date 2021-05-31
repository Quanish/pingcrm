<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Task extends Model
{
<<<<<<< HEAD

	const NOT_STARTED = 0;
    const COMPLETED = 1;
    const IN_PROGRESS = 2;
    const ON_CONTROL = 3; 
	
=======
>>>>>>> 7c68938dd0ade07c26ee14c0b366c5bcd2a5ee6c
    use SoftDeletes;
    protected $fillable = ['user','deadline','description','title','audition','status','type', 'account_id'];
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
