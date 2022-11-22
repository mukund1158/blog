<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Auth;

class PublicUserServices
{
    public function fetch()
    {
        $id = Auth::user()->id;
        $user = User::find($id);

        return $user;

        // return User::find(auth()->id());
    }

    public function store(array $data)
    {
        $userid = Auth::user()->id;
        $id = $data['id'];
        if ($userid == $id) {
            $users = User::find($id);
            $users->name = $data['name'];
            $users->email = $data['email'];
            $file = $data['avtar'];
            $extention = $file->extension();
            $filename = time().'.'.$extention;
            $file->storeAs('/public/upload/user', $filename);
            $users->image = $filename;
            $users->save();
        } else {
            return redirect('user.profile');
        }
    }
}
