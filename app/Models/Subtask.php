<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subtask extends Model
{
	protected $fillable = ['task_id','title','description','start','deadline','status'];
    use HasFactory;
}