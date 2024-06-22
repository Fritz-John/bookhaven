<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\UserActivityLog;

class UserController extends Controller
{

    protected $userModel;

    public function __construct()
    {
        $this->userModel = new User();
    }

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
        $this->userModel->storeUser($request);

        return redirect()->route('login')->with('message', 'User Created');
    }

    public function logout(Request $request)
    {

        $this->userModel->logout($request);

        return redirect('/')->with('message', 'You have beed logout');
    }

    public function authenticate(Request $request)
    {
        $check_state = $this->userModel->login($request);

        if($check_state){
            return redirect('/')->with('message', 'User Login');
          
        }else{
            return redirect()->route('login')->withErrors(['email' => 'Invalid Credentials'])->onlyInput('email');
        }
           
    }


    public function profile()
    {
        $user = User::find(auth()->id());

        $logs = UserActivityLog::where('user_id', auth()->id())->latest()->get();

        return view('users.profile', [
            'users' => $user,
            'logs' =>  $logs
        ]);
    }

    public function edit_profile()
    {

        $user = User::find(auth()->id());

        return view('users.edit-profile', [
            'users' => $user,
        ]);
    }

    public function update_profile(Request $request)
    {
        $this->userModel->update_profile( $request);

       

        return redirect()->route('profile')->with('success', 'Profile updated successfully.');
    }
}
