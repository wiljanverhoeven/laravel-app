<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    
    public function edit()
    {
        try {
            $user = Auth::user();

            // redirect to login if not logged in
            if (!$user) {
                return redirect()->route('login')->with('error', 'You need to be logged in to access your profile.');
            }

            return view('profile.edit', [
                'user' => $user,
            ]);
        } catch (\Exception $e) {
            Log::error('Error displaying profile edit page: ' . $e->getMessage());
            return redirect()->route('home')->with('error', 'An error occurred while loading your profile.');
        }
    }

 
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        try {
            $user = Auth::user();

            if (!$user) {
                return redirect()->route('login')->with('error', 'You need to be logged in to update your profile.');
            }

            $validated = $request->validated();

            $user->fill([
                'name' => $validated['name'],
                'email' => $validated['email'],
            ]);

            if (!empty($validated['password'])) {
                $user->password = Hash::make($validated['password']);
            }

            if ($user->isDirty('email')) {
                $user->email_verified_at = null;
            }

            $user->save();

            return Redirect::route('profile.edit')->with('status', 'Profile updated successfully.');
        } catch (\Exception $e) {
            Log::error('Error updating profile: ' . $e->getMessage());
            return back()->with('error', 'An error occurred while updating your profile. Please try again.');
        }
    }

    public function destroy(Request $request)
    {
        try {
            Log::debug('Account deletion requested.');

            $user = Auth::user();

            if (!$user) {
                return redirect()->route('login')->with('error', 'You need to be logged in to delete your account.');
            }

            Log::debug('Deleting user: ' . $user->id);

            // Try force deleting and log
            $user->bookings()->delete();
            $result = $user->Delete(); 
            Log::debug('Deletion success: ' . ($result ? 'true' : 'false'));

            Auth::logout();

            return redirect('/')->with('status', 'Your account has been deleted successfully.');
        } catch (\Exception $e) {
            Log::error('Error deleting user account: ' . $e->getMessage());
            return redirect()->route('profile.edit')->with('error', 'An error occurred while deleting your account. Please try again.');
        }
    }

}
