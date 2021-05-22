<?php

namespace App\Http\Controllers;

use App\Models\Group;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Request;
use Inertia\Inertia;

class GroupsController extends Controller
{
    public function index()
    {
    	return Inertia::render('Groups/Index',[
    		'groups' => Group::all(),
    	]);
    }
    public function store()
    {
    	Group::insert([
            'group_name' => Request::input('name'),
            'description' => Request::input('description'),
            'access' => 1,
        ]);
        return Inertia::render('Groups/Index',[
    		'groups' => Group::all(),
    	]);
    }
}