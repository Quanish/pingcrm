<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;
use App\Models\Event;

class DashboardController extends Controller
{
    public function index()
    {
        return Inertia::render('Dashboard/Index', [
            'tasks' => Auth::user()->account
                ->tasks()
                ->where('user',Auth::user()->id)
                ->orWhere('audition',Auth::user()->id)
                ->orderBy('user')
                ->get()
                ->map
                ->only('title','id','status','deadline','created_at','type','description'),
            'events' => Event::with('user','task')->where('user',Auth::user()->id)->get(), 
        ]);
    }

}
