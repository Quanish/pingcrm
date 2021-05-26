<?php

namespace App\Http\Controllers;

use Inertia\Inertia;

class AgreementsController extends Controller
{
    public function index()
    {
        return Inertia::render('Agreements/Index');
    }
}
