<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        return view('users.login');
        //
    }

    public function signup()
    {
        return view('users.signup');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function store_user(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed|min:6',
            'address' => 'required',
            'phone' => 'required|numeric',
        ]);

        $data['password'] = bcrypt($data['password']);


        $user = User::create($data);
        //auth()->login($user);


        return redirect()->route('login')->with('message', 'User Created');
    }

    public function logout(Request $request)
    {
        auth()->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('message', 'You have beed logout');
    }

    public function authenticate(Request $request)
    {
        $formFields = $request->validate([
            'email' => ['required', 'email'],
            'password' => 'required'

        ]);

        if (auth()->attempt($formFields)) {
            $request->session()->regenerate();

            return redirect('/')->with('message', 'User Login');
        }

        return back()->withErrors(['email' => 'Invalid Credentials'])->onlyInput('email');
    }


    public function profile()
    {
        $user = User::find(auth()->id())->first();

        return view('users.profile', [
            'users' => $user,
        ]);
    }

    public function edit_profile()
    {

        $user = User::find(auth()->id())->first();

        return view('users.edit-profile', [
            'users' => $user,
        ]);
    }

    public function update_profile(Request $request)
    {

        $user = User::find(auth()->id())->first();

        $data = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'address' => 'required',
            'phone' => 'required|numeric',
            'password' => 'nullable|confirmed|min:6',
        ]);

        if (isset($data['password'])) {
            $data['password'] = bcrypt($data['password']);
        } else {
            unset($data['password']);
        }


        $user->update($data);

        return redirect()->route('profile')->with('success', 'Profile updated successfully.');
    }
}
