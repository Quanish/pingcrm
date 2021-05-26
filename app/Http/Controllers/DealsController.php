<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;
use App\Models\Deal;

class DealsController extends Controller
{
    public function index()
    {
    	
    	$deal = Deal::all();
        return Inertia::render('Deals/Index',['test' => $deal]);
    }
 
}
