<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;
use App\Models\Deal;
use App\Models\Organization;
use Illuminate\Http\Request;

class DealsController extends Controller
{
    public function index()
    {
    	$deal = Deal::with('client')->get();
        return Inertia::render('Deals/Index',['test' => $deal]);
    }
    
    public function create()
    {
    	return Organization::all();
    }
    
    public function store(Request $request)
    {
    	Deal::create([
            'name' => $request->title,
            'sum'  => $request->sum,
            'type' => $request->type,
            'status' => 2,
            'client_id' => $request->client_id ? $request->client_id['id'] : 0,
            'file_id' => $request->file_id ? $request->file_id : 0,
            'comment' => $request->comment
        ]);

        return redirect('deals')->with([
            'success' => 'Сделка создана'
        ]);
    }

    
}
