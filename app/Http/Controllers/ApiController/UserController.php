<?php

namespace App\Http\Controllers\ApiController;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $users = User::orderByDesc('created_at')->get();

        return $this->responseJson(UserResource::collection($users));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|string',
            'password' => 'required',
            'phone_number' => 'required|string',
            'address' => 'required|string',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'email_verified_at' => now(),
            'password' => Hash::make($request->password),
            'phone_number' => $request->phone_number,
            'address' => $request->address
        ]);

        return $this->responseJson([
            'message' => 'Successfully create user'
        ]);
    }

    public function show(User $user)
    {
        return $this->responseJson(new UserResource($user));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|string',
            'phone_number' => 'required|string',
            'address' => 'required|string',
        ]);

        $user->name = $request->name;
        $user->email = $request->email;
        $user->address = $request->address;
        $user->phone_number = $request->address;
        if ($request->password) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return $this->responseJson([
            'message' => 'Successfully update user'
        ]);
    }

    public function destroy(User $user)
    {
        $user->delete();

        return $this->responseJson([
            'message' => 'Successfully delete user'
        ]);
    }
}
