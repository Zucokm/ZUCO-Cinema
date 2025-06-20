<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\File;
use Illuminate\Validation\Rules\Password;

class RegisteredAdminController extends Controller
{
    public function create()
    {
        return view('admin.register');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $adminAttributes = $request->validate([
            'name'      => ['required'],
            'NRC'       => ['required'],
            'email'     => ['required', 'email', 'unique:admins,email'],
            'password'  => ['required', 'confirmed', Password::min(6)],
            'photo'     => ['required', File::types(['png', 'jpg', 'jpeg', 'webp', 'heic', 'JPG'])],
        ]);

        // Store photo in storage/app/public/admins/
        $photoPath = $request->file('photo')->store('admins', 'public');

        $admin = Admin::create([
            'name'      => $adminAttributes['name'],
            'NRC'       => $adminAttributes['NRC'],
            'email'     => $adminAttributes['email'],
            'password'  => Hash::make($adminAttributes['password']),
            'photo'     => $photoPath,
        ]);

        return redirect('/dashboard');
    }

    public function update(Request $request)
    {
    
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . Auth::id(),
        ]);

        $user = Auth::user(); 
        $user->name = $request->name;
        $user->email = $request->email;
        $user->save();

        return back()->with('success', 'Profile updated successfully!');
    }

    public function destroy()
    {
        $user = Auth::user();
        Auth::logout(); // Logout before deleting

        $user->delete(); // Delete user

        return redirect('/')->with('success', 'Your account has been deleted successfully.');
    }
}


