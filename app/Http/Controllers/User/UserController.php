<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\PublicUpdateRequest;
use App\Jobs\EmailJob;
use App\Services\PublicUserServices;
use Illuminate\Http\Request;

class UserController extends Controller
{
    // public $service;

    // public function __construct(PublicUserServices $service)
    // {
    //     $this->service = $service;
    // }

    public function __construct(
        public PublicUserServices $publicUserServices,
    ) {
    }

    public function profile()
    {
        $users = $this->publicUserServices->fetch();

        return view('user/profile', compact('users'));
    }

    public function edit()
    {
        $user = $this->publicUserServices->fetch();

        return view('user/editUser', compact('user'));
    }

    // UpdateRequest
    public function update(PublicUpdateRequest $request)
    {
        $data = $request->validated();
        $this->publicUserServices->store($data);

        return redirect('user/profile');
    }

    public function queue()
    {
        return view('queue');
    }

    public function sendMail(Request $request)
    {
        $data = $request->only('emails');
        $emails = explode(',', $data['emails']);

        foreach ($emails as $email) {
            dispatch(new EmailJob($email));
        }

        return redirect('queue')->with('success', 'Email processing start');
    }
}
