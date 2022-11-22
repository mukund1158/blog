<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Notifications\MyFirstNotification;
use Illuminate\Support\Facades\Notification as FacadesNotification;

// use Illuminate\Notifications\Notification;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // Role::create(['name'=>'super-admin']);
        // Role::create(['name'=>'admin']);
        // Role::create(['name'=>'user']);
        // $permission = Permission::create(['name'=>'fullRight']);
        // $permissions = Permission::create(['name'=>'viewOnly']);

        // $role = Role::findById(2);
        // $permission = Permission::findById(2);
        // $role->givePermissionTo($permission);
        // auth()->user()->assignRole('super-admin');
        // $user = auth()->user();
        // auth()->user()->givePermissionTO('edit');
        // $user->givePermissionTo('edit articles');
        // auth()->user()->assignRole(1);

        // return auth()->user()->getallPermissions();
        return view('home');
    }

    public function sendNotification()
    {
        $user = User::find(2);

        $details = [
            'greeting' => 'Hello, ' . $user->name,
            'body' => 'This is my first notification from blog',
            'thanks' => 'Thank you for using blog',
            'actionText' => 'Visit blog',
            'actionURL' => url('/'),
            'order_id' => 101,
        ];

        // FacadesNotification::send($user, new MyFirstNotification($details));

        $user->notify(new MyFirstNotification($details));

        dd('done');
    }
}
