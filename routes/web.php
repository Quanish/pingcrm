<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\CalendarController;
use App\Http\Controllers\ContactsController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ImagesController;
use App\Http\Controllers\OrganizationsController;
use App\Http\Controllers\ReportsController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\FlatsController;
use App\Http\Controllers\ListController;
use App\Http\Controllers\TasksController;
use App\Http\Controllers\DealsController;
use App\Http\Controllers\MeetingsController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\GroupsController;
use App\Http\Controllers\MailController;
use App\Http\Controllers\DocumentsController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\SubtasksController;

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
//Documents

Route::get('documents',[DocumentsController::class,'index'])
->name('documents')
->middleware('auth');

Route::get('documents/create',[DocumentsController::class,'create'])
->name('documents.create')
->middleware('auth');

Route::post('documents/store',[DocumentsController::class,'store'])
->name('documents.store')
->middleware('auth');

//Groups

Route::get('groups',[GroupsController::class,'index'])
->name('groups')
->middleware('auth');

Route::get('groups/{group}',[GroupsController::class,'show'])
->name('groups.show')
->middleware('auth');


Route::post('groups',[GroupsController::class,'store'])
->name('groups.store')
->middleware('auth');

Route::post('groups/upload',[GroupsController::class,'upload'])
->name('upload')
->middleware('auth');

Route::post('groups/rename',[GroupsController::class,'rename'])
->name('rename')
->middleware('auth');

Route::post('groups/description',[GroupsController::class,'description'])
->name('description')
->middleware('auth');

// Auth

Route::get('login', [LoginController::class, 'showLoginForm'])
    ->name('login')
    ->middleware('guest');

Route::post('login', [LoginController::class, 'login'])
    ->name('login.attempt')
    ->middleware('guest');

Route::post('logout', [LoginController::class, 'logout'])
    ->name('logout');

// Dashboard

Route::get('/', [DashboardController::class, 'index'])
    ->name('dashboard')
    ->middleware('auth');

Route::post('/events/seen', [DashboardController::class, 'setEventSeen'])
    ->name('events.seen')
    ->middleware('auth');

// Users

Route::get('users', [UsersController::class, 'index'])
    ->name('users')
    ->middleware('remember', 'auth');

Route::get('users/create', [UsersController::class, 'create'])
    ->name('users.create')
    ->middleware('auth');

Route::post('users', [UsersController::class, 'store'])
    ->name('users.store')
    ->middleware('auth');

Route::get('users/{user}/edit', [UsersController::class, 'edit'])
    ->name('users.edit')
    ->middleware('auth');

Route::put('users/{user}', [UsersController::class, 'update'])
    ->name('users.update')
    ->middleware('auth');

Route::delete('users/{user}', [UsersController::class, 'destroy'])
    ->name('users.destroy')
    ->middleware('auth');

Route::put('users/{user}/restore', [UsersController::class, 'restore'])
    ->name('users.restore')
    ->middleware('auth');

// Organizations

Route::get('organizations', [OrganizationsController::class, 'index'])
    ->name('organizations')
    ->middleware('remember', 'auth');

Route::get('organizations/create', [OrganizationsController::class, 'create'])
    ->name('organizations.create')
    ->middleware('auth');

Route::post('organizations', [OrganizationsController::class, 'store'])
    ->name('organizations.store')
    ->middleware('auth');

Route::post('/organizations/status', [OrganizationsController::class, 'status'])
    ->name('organizations.status')
    ->middleware('auth');
    
Route::get('organizations/{organization}/edit', [OrganizationsController::class, 'edit'])
    ->name('organizations.edit')
    ->middleware('auth');

Route::put('organizations/{organization}', [OrganizationsController::class, 'update'])
    ->name('organizations.update')
    ->middleware('auth');

Route::delete('organizations/{organization}', [OrganizationsController::class, 'destroy'])
    ->name('organizations.destroy')
    ->middleware('auth');

Route::put('organizations/{organization}/restore', [OrganizationsController::class, 'restore'])
    ->name('organizations.restore')
    ->middleware('auth');

Route::post('organizations/{message}/{id}', [OrganizationsController::class, 'comment'])
    ->name('organizations.comment')
    ->middleware('auth');

// Contacts

Route::get('contacts', [ContactsController::class, 'index'])
    ->name('contacts')
    ->middleware('remember', 'auth');

Route::get('contacts/create', [ContactsController::class, 'create'])
    ->name('contacts.create')
    ->middleware('auth');

Route::post('contacts', [ContactsController::class, 'store'])
    ->name('contacts.store')
    ->middleware('auth');

Route::get('contacts/{contact}/edit', [ContactsController::class, 'edit'])
    ->name('contacts.edit')
    ->middleware('auth');

Route::put('contacts/{contact}', [ContactsController::class, 'update'])
    ->name('contacts.update')
    ->middleware('auth');

Route::delete('contacts/{contact}', [ContactsController::class, 'destroy'])
    ->name('contacts.destroy')
    ->middleware('auth');

Route::put('contacts/{contact}/restore', [ContactsController::class, 'restore'])
    ->name('contacts.restore')
    ->middleware('auth');
// Flats

Route::get('flats', [FlatsController::class, 'index'])
    ->name('flats')
    ->middleware('auth');
//List

Route::get('list', [ListController::class, 'index'])
    ->name('list')
    ->middleware('auth');

//Tasks


Route::get('tasks', [TasksController::class, 'index'])
    ->name('tasks')
    ->middleware('auth');

Route::get('tasks/create', [TasksController::class, 'create'])
    ->name('tasks.create')
    ->middleware('auth');

Route::post('tasks', [TasksController::class, 'store'])
    ->name('tasks.store')
    ->middleware('auth');

Route::get('tasks/{task}/edit', [TasksController::class, 'edit'])
    ->name('tasks.edit')
    ->middleware('auth');

Route::put('tasks/{task}', [TasksController::class, 'update'])
    ->name('tasks.update')
    ->middleware('auth');

Route::delete('tasks/{task}', [TasksController::class, 'destroy'])
    ->name('tasks.destroy')
    ->middleware('auth');

Route::get('tasks/{task}', [TasksController::class, 'show'])
    ->name('tasks.show')
    ->middleware('auth');

Route::get('calendar', [CalendarController::class, 'calendar'])
    ->name('calendar')
    ->middleware('auth');

Route::put('tasks/',[TasksController::class, 'accept'])
->name('tasks.accept')
->middleware('auth');

Route::post('tasks/comment',[TasksController::class, 'comment'])
->name('tasks.comment')
->middleware('auth');

Route::get('dela',[TasksController::class,'dela'])
->name('tasks.dela')
->middleware('auth');

//Subtasks

Route::post('subtasks',[SubtasksController::class,'store'])
->name('subtasks.store')
->middleware('auth');

//Deals

Route::get('deals', [DealsController::class, 'index'])
    ->name('deals')
    ->middleware('auth');

Route::get('deals/create', [DealsController::class,'create'])
->name('deals.create')
->middleware('auth');

Route::post('deals/store', [DealsController::class,'store'])
->name('deals.store')
->middleware('auth');

Route::post('deals/update', [DealsController::class,'update'])
->name('deals.update')
->middleware('auth');
//Meetings

Route::get('meetings', [MeetingsController::class, 'index'])
    ->name('meetings')
    ->middleware('auth');

//Products

Route::get('products',[ProductsController::class,'index'])
    ->name('products')
    ->middleware('auth');

// Reports

Route::get('reports', [ReportsController::class, 'index'])
    ->name('reports')
    ->middleware('auth');

Route::get('reports/analytics',[ReportsController::class,'analytics'])
->name('reports.analytics')
->middleware('auth');

Route::get('reports/create',[ReportsController::class,'create'])
->name('reports.create')
->middleware('auth');

// SUBTASKS
Route::post('subtask/status',[SubtasksController::class,'status'])
->name('subtask.status')
->middleware('auth');


//Post

Route::get('post',[PostController::class,'index'])
->name('post')
->middleware('auth');
// Images

Route::get('/img/{path}', [ImagesController::class, 'show'])->where('path', '.*');

// Mail

Route::get('mail/{driver?}/{folder?}/{page?}', [MailController::class, 'index'])
    ->name('mail')  
    ->middleware('auth');

Route::get('axios/mail/{driver}/{folder?}/{page?}', [MailController::class, 'axiosIndex'])
    ->middleware('auth');

Route::post('axios/send-mail', [MailController::class, 'send_mail'])->name('mail.send')->middleware('auth');


// 500 error

Route::get('500', function () {
    // Force debug mode for this endpoint in the demo environment
    if (App::environment('demo')) {
        Config::set('app.debug', true);
    }

    echo $fail;
});

Route::resource('categories',CategoryController::class);

Route::get('get-users', [UsersController::class, 'getUsers']);
Route::get('plans', [UsersController::class, 'plans']);
Route::post('plans/save', [UsersController::class, 'savePlan']);
Route::post('save-users-to-group', [GroupsController::class, 'saveUsers']);

Route::post('add-contact', [OrganizationsController::class, 'addContact']);
Route::post('client-status', [OrganizationsController::class, 'changeStatus']);
Route::get('get-profile/{id}', [UsersController::class, 'getProfile']);
Route::post('deal-status', [DealsController::class, 'changeStatus']);
Route::post('edit-client', [OrganizationsController::class, 'editClient']);
Route::post('add-action', [OrganizationsController::class, 'addAction']);
Route::post('get-plans', [OrganizationsController::class, 'getPlans']);

// chat
Route::get('chat', [ChatController::class, 'index'])
    ->name('chat')
    ->middleware('auth');

Route::get('socket', [ChatController::class, 'chat'])
    ->name('socket')
    ->middleware('auth');

