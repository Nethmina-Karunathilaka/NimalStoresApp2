<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use App\Models\User;

class ProfileController extends Controller
{
    public function edit()
    {
        return view('profile.edit');
    }

    public function updateEmail(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email', 'unique:users,email,' . auth()->id()],
            'name' => ['required', 'string', 'max:255'],
        ]);

        $user = auth()->user();
        $user->email = $request->email;
        $user->name = $request->name;
        $user->save();

        return back()->with('success','Profile updated successfully.');
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => ['required'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = auth()->user();

        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'The current password does not match.']);
        }

        $user->password = Hash::make($request->password);
        $user->save();

        return back()->with('success', 'Password updated successfully.');
    }

    public function destroy(Request $request)
    {
        $user = auth()->user();

        // Optionally handle additional logic before deleting the account
        $user->delete();

        auth()->logout();

        return redirect('/')->with('success', 'Account deleted successfully.');
    }
}