<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Report;
use App\Models\User;

class ReportsController extends Controller
{
    public function index()
    {
        return Inertia::render('Reports/Index',[
        	'reports' => Report::with('user')->get(),
        ]);
    }

    public function analytics()
    {
    	return Inertia::render('Reports/Analytics',[
    		'users' => User::all(),
    	]);
    }

    public function create()
    {
    	return Inertia::render('Reports/Create');
    }
}
