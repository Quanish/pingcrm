<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;

class DocumentsController extends Controller
{
    public function index()
    {
        return Inertia::render('Documents/Index');
    }

}
