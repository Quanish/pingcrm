<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;
use App\Models\Deal;
use App\Models\User;
use App\Models\Organization;
use Illuminate\Http\Request;

class DealsController extends Controller
{
    public function index()
    {
    	$deals = Deal::with(['client'])->get();
    	
        foreach($deals as $deal) {
            $deal->user = User::card($deal->responsible_id);
        }
        
        return Inertia::render('Deals/Index',['test' => $deals]);
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
            'client_id' => $request->client_id ? $request->client_id : 0,
            'file_id' => $request->file_id ? $request->file_id : 0,
            'responsible_id' => Auth::user()->id,
            'comment' => $request->comment
        ]);
        
        
        if($request->to == 'deal') {
            return redirect('deals')->with([
                'success' => 'Сделка создана'
            ]);
        } else {
            return redirect('/organizations/'. $request->client_id.'/edit')->with([
                'success' => 'Сделка создана'
            ]);
        }
        
    }

    
}
