<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Deal;

class AgreementsController extends Controller
{
    public function index()
    {
        return Inertia::render('Agreements/Index',[
        	'agreements' => Deal::all()->get(),
        ]);
    }
}
