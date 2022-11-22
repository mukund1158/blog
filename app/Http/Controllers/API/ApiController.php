<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ApiController extends Controller
{
    public function login(Request $request)
    {
        $user = User::where('email', $request->email)->first();
        if (! $user || ! Hash::check($request->password, $user->password)) {
            return response()->json(['status' => 500, 'message' => 'Email id and password are not valid']);
        }

        $token = $user->createToken('my-app-token')->accessToken;

        return response()->json(['user' => $user, 'token' => $token]);
    }

    public function listApiData($id = null)
    {
        try {
            $data = $id ? User::find($id) : User::paginate(5);

            return response()->json(['status' => 200, 'message' => 'Data retrieved  successfully', 'data' => $data]);
        } catch (\exception $ex) {
            return response()->json(['status' => 500, 'message' => $ex->getMessage(), 'data' => null]);
        }
    }

    public function store(Request $request)
    {
        try {
            $id = isset($request->id) ? $request->id : '';
            $users = $id ? User::find($id) : new User();
            $users->name = $request->name;
            $users->email = $request->email;
            if (! $id) {
                $users->password = Hash::make($request->password);
            }
            $users->role_id = $request->role_id;
            $users->save();

            return response()->json(['status' => 200, 'message' => 'User data Store successfully', 'data' => null]);
        } catch (\exception $ex) {
            return response()->json(['status' => 500, 'message' => $ex->getMessage(), 'data' => null]);
        }
    }

    public function delete($id)
    {
        try {
            User::find($id)->delete();

            return response()->json(['status' => 200, 'message' => 'User data deleted successfully', 'data' => null]);
        } catch(\Exception $ex) {
            return response()->json(['status' => 500, 'message' => $ex->getMessage(), 'data' => null]);
        }
    }
}
