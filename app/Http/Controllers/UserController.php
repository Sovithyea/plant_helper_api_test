<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;

class UserController extends Controller
{
    public function index()
    {
        $user = User::all();

        return response()->json([
            $user
        ]);
    }

    public function store(StoreUserRequest $request)
    {
        $user = new User();

            $user->first_name = $request->first_name;
            $user->last_name = $request->last_name;
            $user->username = $request->username;
            $user->gender = $request->gender;
            $user->phone_number = $request->phone_number;
            $user->avatar = $request->image;
            $user->role = $request->role;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
        $user->save();
        
        return response()->json([
            'message' => 'Successfully create account.'
        ], 200);
    }

    public function show(User $user)
    {
        return response()->json([
            $user
        ]);
    }

    public function edit(User $user)
    {
        return response()->json([
            $user
        ]);
    }

    public function update(UpdateUserRequest $request, $id)
    {
        $user = User::find($id);

            $user->first_name = $request->first_name;
            $user->last_name = $request->last_name;
            $user->username = $request->username;
            $user->gender = $request->gender;
            $user->phone_number = $request->phone_number;
            $user->avatar = $request->avatar;
            $user->role = $request->role;
            $user->email = $request->email;

        $user->save();

        return response()->json([
            'message' => 'Update user succesfully'
        ], 200); 
    }

    public function delete(User $user)
    {
        $user->delete();

        return response()->json([
            'message' => 'Delete user succesfully'
        ], 200); 
    }
}
