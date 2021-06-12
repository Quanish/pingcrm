<?php

namespace App\Http\Controllers;

use App\Models\Organization;
use App\Models\Comment;
use App\Models\Contact;
use App\Models\User;
use App\Models\Deal;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Request;
use Illuminate\Http\Request as ObjectRequest;
use Inertia\Inertia;

class OrganizationsController extends Controller
{
    public function index()
    {
        return Inertia::render('Organizations/Index', [
            'filters' => Request::all('search', 'trashed'),
            'organizations' => Auth::user()->account->organizations()
                ->orderBy('name')
                ->filter(Request::only('search', 'trashed'))
                ->paginate()
                ->withQueryString()
                ->through(function ($organization) {
                    return [
                        'id' => $organization->id,
                        'name' => $organization->name,
                        'phone' => $organization->phone,
                        'city' => $organization->city,
                        'status' => $organization->status,
                        'deleted_at' => $organization->deleted_at,
                        'status'=> $organization->status, 
                        'stage' => $organization->stage,
                        'agreement' => $organization->agreement,
                        'responsible' => User::card($organization->responsible_id),
                    ];
                }),
        ]);
    }

    public function create()
    {
        return Inertia::render('Organizations/Create');
    }

    public function store(ObjectRequest $request)
    {
        $organization = Organization::create([
            'name' => $request->name,
            'email'  => ' ',
            'phone'  => ' ',
            'address'  => ' ',
            'city' => $request->city,
            'region'  => $request->region,
            'country'  => ' ',
            'status' => 1,
            'account_id' => 1,
            'postal_code' => ' ',
            'responsible_id' => Auth::user()->id, 
        ]);

        return $this->edit($organization);
    }

    public function edit(Organization $organization)
    {
        return Inertia::render('Organizations/Edit', [
            'organization' => [
                'id' => $organization->id,
                'name' => $organization->name,
                'email' => $organization->email,
                'phone' => $organization->phone,
                'address' => $organization->address,
                'city' => $organization->city,
                'region' => $organization->region,
                'country' => $organization->country,
                'status' => $organization->status,
                'postal_code' => $organization->postal_code,
                'deleted_at' => $organization->deleted_at,
                'contacts' => $organization->contacts()->orderByName()->get()->map->only('id', 'name', 'city', 'phone'),
                'deals' => Deal::where('client_id', $organization->id)->get(),
            ],
            'responsible' => User::card($organization->responsible_id),
            'comments' => $organization->comments()
        ]);
    }

    public function update(Organization $organization)
    {
        $organization->update(
            Request::validate([
                'name' => ['required', 'max:100'],
                'email' => ['nullable', 'max:50', 'email'],
                'phone' => ['nullable', 'max:50'],
                'address' => ['nullable', 'max:150'],
                'city' => ['nullable', 'max:50'],
                'region' => ['nullable', 'max:50'],
                'country' => ['nullable', 'max:2'],
                'postal_code' => ['nullable', 'max:25'],
            ])
        );

        return Redirect::back()->with('успешно', 'Данные обновлены.');
    }

    public function destroy(Organization $organization)
    {
        $organization->delete();

        return Redirect::back()->with('успешно', 'Клиент удален.');
    }

    public function restore(Organization $organization)
    {
        $organization->restore();

        return Redirect::back()->with('успешно', 'клиент восстановлен.');
    }

    public function comment(String $message,$id){
        /********* TODO */
        Comment::insert([
            'client_id' => $id,
            'user_id' => Auth::user()->id,
            'comment' => Comment::TEXT,
            ]);
            return Redirect::route('organizations')->with('успешно', 'Комментарий добавлен.');
    }

    public function status(ObjectRequest $request){ 

        return Organization::where('status', $request->status) 
                ->paginate()
                ->through(function ($organization) {
                    return [
                        'id' => $organization->id,
                        'name' => $organization->name,
                        'phone' => $organization->phone,
                        'city' => $organization->city,
                        'status' => $organization->status,
                        'deleted_at' => $organization->deleted_at,
                        'status'=> $organization->status, 
                        'stage' => $organization->stage,
                        'agreement' => $organization->agreement,
                        'responsible' => User::card($organization->responsible_id),
                    ];
                });
    }


    public function addContact(ObjectRequest $request) {
        $item = Organization::find($request->organization_id);

        if($item) {
            Contact::create([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'organization_id' => $request->organization_id,
                'account_id' => 1,
                'email' => $request->email,
                'phone' => $request->phone,
                'address' => $request->address,
                'city' => $request->city,
                'region' => $request->region,
                'country' => $request->country,
                'postal_code' => $request->postal_code,
            ]);
        }
        
        return redirect('/organizations/'. $request->organization_id.'/edit')->with([
            'success' => 'Контакт добавлен!'
        ]);
    }
}
