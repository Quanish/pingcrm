<?php

namespace App\Http\Controllers;

use App\Models\Group;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Request;
use Illuminate\Http\Request as ObjectRequest;
use Inertia\Inertia;

class GroupsController extends Controller
{
    public function index()
    {
    	return Inertia::render('Groups/Index',[
    		'groups' => Group::all(),
    	]);
    }
    public function store(ObjectRequest $request)
    {   
    	$group = Group::create([
            'group_name' => $request->group_name,
            'description' => $request->description,
            'access' => 1,
        ]);

        return $this->show($group);    
    }

    

    public function show(Group $group){
        return Inertia::render('Groups/Show',[
            'group' => Group::find($group->id)
        ]);
    }
}