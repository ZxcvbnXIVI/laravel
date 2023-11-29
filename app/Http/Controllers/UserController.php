<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return response()->json($users);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'UserName' => 'required|max:255',
            'UserType' => 'required|max:255',
            'EnrollmentDate' => 'required|date',
        ]);

        $user = User::create($validatedData);

        return response()->json(['success' => true, 'message' => 'User created successfully', 'user' => $user]);
    }

    public function show($id)
    {
        $user = User::findOrFail($id);
        return response()->json($user);
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'UserName' => 'required|max:255',
            'UserType' => 'required|max:255',
            'EnrollmentDate' => 'required|date',
        ]);

        $user = User::findOrFail($id);
        $user->update($validatedData);

        return response()->json(['success' => true, 'message' => 'User updated successfully', 'user' => $user]);
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return response()->json(['success' => true, 'message' => 'User deleted successfully']);
    }
}
