<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;


class AdminUserController extends Controller
{
  
    public function edit(User $user)
    {
        return view('admin.users.EditUser', compact('user'));
    }

    //change user
    public function update(Request $request, User $user)
    {
        $validatedData = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'points' => ['required', 'integer', 'min:0'],
        ]);

        $user->update($validatedData);

        return redirect()->route('admin.dashboard')->with('success', 'User updated successfully.');
    }

   //delete user
    public function destroy(User $user)
    {

        $user->delete();

        return redirect()->route('admin.dashboard')->with('success', 'User deleted successfully.');
    }
}