<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Log;

use Illuminate\Http\Request;
use App\Models\User; // Assuming User is your model class
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    // Show all users
    public function index()
    {
        return User::all();
    }

    // Show a single user
    public function show($id)
{
    $user = User::find($id);

    if ($user) {
        return $user;
    } else {
        return response()->json([
            'error' => 'User not found'
        ], 404);
    }
}

    // Create a new user
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8',
        ]);

        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->save();

        return response()->json([
            'message' => 'User created successfully',
            'user' => $user
        ]);
    }

    // Update a user
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,'.$id,
        ]);

        $user = User::find($id);

        if ($user->name === $request->name && $user->email === $request->email) {
            return response()->json([
                'message' => 'No changes detected',
                'user' => $user
            ], 200);
        }

        $user->name = $request->name;
        $user->email = $request->email;
        $user->save();

        return response()->json([
            'message' => 'User updated successfully',
            'user' => $user
        ], 200);
    }



    public function updatePassword(Request $request, $id)
{
    $request->validate([
        'password' => 'required|min:6|confirmed',
    ]);

    $user = User::find($id);

    if (!$user) {
        return response()->json([
            'error' => 'User not found',
        ], 404);
    }

    $user->password = Hash::make($request->password);
    $user->save();

    return response()->json([
        'message' => 'Password updated successfully',
    ]);
}

    // Delete a user
    public function destroy($id)
    {
        try {
            $user = User::findOrFail($id);
            $user->delete();

            return response()->json(['message' => 'User successfully deleted'], 200);
        }  catch (\Exception $e) {
            // Log the exception message for debugging purposes
            Log::error('Error deleting user: '.$e->getMessage());

            // Temporarily return the actual error message to help with debugging
            return response()->json(['message' => 'Error deleting user: '.$e->getMessage()], 500);
        }
    }


}
