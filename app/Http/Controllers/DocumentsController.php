<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;
use App\Models\Document;

class DocumentsController extends Controller
{
    public function index()
    {
        return Inertia::render('Documents/Index',[
        	"documents" => Document::All(),
        ]);
    }
    public function create(){
    	return Inertia::render('Documents/Create');
    }

}
